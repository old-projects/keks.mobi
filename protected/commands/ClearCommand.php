<?php
/**
 * Команда удаления старых данных
 */
class ClearCommand extends ConsoleCommand {

	// public function init() {
	// 	parent::init();
		
	// }

	public function actionEncodedFiles($hours = 12, $sure = false) {
		echo 'Deleting encoded but not downloaded videos ...'.PHP_EOL;
		if ($hours < 2 && $sure != true)
			$this->terminate('Add flag "--sure"!');
		$deleted_files = $freed_space = 0;
		$criteria = new CDbCriteria;
		$criteria->order = 'date ASC';
		$criteria->condition = 'phase = 5 AND date < SUBDATE(NOW(), INTERVAL '.$hours.' DAY_HOUR)';
		foreach (EncodingQueue::model()->findAll($criteria) as $task) {
			echo "\t".'['.$task->id.'] date:'.$task->date;
			if (file_exists(Yii::getPathOfAlias('webroot').$task->source_file)) {
				$deleted_files ++;
				$freed_space += $source_filesize = filesize(Yii::getPathOfAlias('webroot').$task->source_file);
				echo "\t".$task->source_file.'('.round($source_filesize / 1024 / 1024, 2).'мб)';
				Yii::app()->filesystem->deleteFile(Yii::getPathOfAlias('webroot').$task->source_file);
			}

			if ($task->target_file != $task->source_file && file_exists(Yii::getPathOfAlias('webroot').$task->target_file)) {
				$deleted_files ++;
				$freed_space += $target_filesize = filesize(Yii::getPathOfAlias('webroot').$task->target_file);
				echo "\t".$task->target_file.'('.round($target_filesize / 1024 / 1024, 2).'мб)';
				Yii::app()->filesystem->deleteFile(Yii::getPathOfAlias('webroot').$task->target_file);
			}
			$task->delete();
			echo PHP_EOL;
		}

		echo 'Deleted files: '.$deleted_files.' ('.round($freed_space / 1024 / 1024, 2).'мб)'.PHP_EOL;
	}

	/**
	 * Удаляет форматы, которые были скачаны очень давно
	 */
	public function actionOldVideos($hours = 24, $sure = false) {
		echo 'Deleting old videos ...'.PHP_EOL;
		if ($hours < 2 && $sure != true)
			$this->terminate('Add flag "--sure"!');
		$deleted_formats = $deleted_files = $freed_space = 0;
		$criteria = new CDbCriteria;
		$criteria->order = 'download_last_time ASC';
		$criteria->condition = '/*downloads_count = 0 AND */download_last_time < SUBDATE(NOW(), INTERVAL '.$hours.' DAY_HOUR) AND encode_time < SUBDATE(NOW(), INTERVAL '.$hours.' DAY_HOUR)';

		foreach (VideosFormats::model()->findAll($criteria) as $format) {
			echo "\t".'[video '.$format->video_id.']';
			echo "\t".($format->format == VideosFormats::AUDIO ? 'audio' : 'video:'.$format->format.'p');
			echo "\t".$format->download_last_time;
			echo "\t".'downloads:'.$format->downloads_count;
			$format_filename = Yii::getPathOfAlias('webroot').Yii::app()->downloadsManager->filesDirectory.$format->filename;
			// echo $format_filename;
			if (file_exists($format_filename)) {
				$deleted_files++;
				$freed_space += $format_filesize = filesize($format_filename);
				echo "\t".round($format_filesize / 1024 / 1024, 2).'мб';
				Yii::app()->filesystem->deleteFile($format_filename);
			}
			echo PHP_EOL;
			$deleted_formats++;
			$format->delete();
		}
		echo 'Deleted formats: '.$deleted_formats."\t".'Deleted files: '.$deleted_files.' ('.round($freed_space / 1024 / 1024, 2).'мб)'.PHP_EOL;
	}

	/**
	 * Удаляет музыку, которая была скачана очень давно
	 */
	public function actionOldMusic($hours = 24, $sure = false) {
		Yii::import('application.modules.music.models.*');
		echo 'Deleting old music ...'.PHP_EOL;
		if ($hours < 2 && $sure != true)
			$this->terminate('Add flag "--sure"!');
		$processed_tracks = $deleted_files = $freed_space = 0;
		$criteria = new CDbCriteria;
		$criteria->order = 'download_last_time ASC';
		$criteria->condition = 'downloaded > 0 AND download_last_time < SUBDATE(NOW(), INTERVAL '.$hours.' DAY_HOUR)';

		foreach (PrimeMusicTracks::model()->findAll($criteria) as $track) {
			echo "\t".'[track '.$track->id.']';
			echo "\t".$track->download_last_time;
			echo "\t".'downloads:'.$track->downloads_count;
			$track_filename = Yii::getPathOfAlias('webroot').Yii::app()->downloadsManager->filesDirectory.$track->filename;
			if (file_exists($track_filename)) {
				$deleted_files++;
				$freed_space += $track_filesize = filesize($track_filename);
				echo "\t".round($track_filesize / 1024 / 1024, 2).'мб';
				Yii::app()->filesystem->deleteFile($track_filename);
			}
			echo PHP_EOL;
			$processed_tracks++;
			$track->downloaded = 0;
			$track->save();
		}
		echo 'Processed tracks: '.$processed_tracks."\t".'Deleted files: '.$deleted_files.' ('.round($freed_space / 1024 / 1024, 2).'мб)'.PHP_EOL;
	}

}
