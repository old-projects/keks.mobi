<?php
class TrackController extends Controller {

	public $track;

	public function beforeAction($action) {
		if (parent::beforeAction($action)) {
			if (!isset($_GET['id']))
				throw new CHttpException(404, 'Track id is empty.');
			if (($this->track = PrimeMusicTracks::model()->findByPk($_GET['id'])) === null)
				throw new CHttpException(404, 'Invalid track ID.');
			return true;
		}
		return false;
	}

	public function actionIndex() {
		// $tasks = array();
		// foreach (EncodingQueue::model()->findAll('id LIKE :id', array(':id' => EncodingQueue::calculateTaskId('video', $this->video->id, '%'))) as $task) {
		// 	list(,, $format) = explode(':', $task->id);
		// 	if ($task->phase == EncodingQueue::ENCODED) {
		// 		$video_format = VideosFormats::transformTaskToFormat($this->video, $task);
		// 		if ($video_format === null)
		// 			$this->setFlash(($format == VideosFormats::AUDIO ? 'Аудио' : 'Видео ('.$format.')').' было готово к скачиванию, но ныне недоступно!');
		// 		else
		// 			$this->setFlash(($format == VideosFormats::AUDIO ? 'Аудио' : 'Видео ('.$format.')').' готово к скачиванию!');
		// 	} else
		// 		$tasks[$format] = $task;
		// }

		// $formats = array();
		// foreach ($this->video->formats as $format) {
		// 	$formats[$format->format] = $format;
		// }

		if (($task = EncodingQueue::model()->find('id LIKE :id', array(':id' => EncodingQueue::calculateTaskId('music', $this->track->id, $this->track->bitrate)))) !== null) {
			if ($task->phase == EncodingQueue::ENCODED) {
				$track = PrimeMusicTracks::handleFinishedTask($this->track, $task);
				$this->setFlash('Трек готов к скачиванию!');
				$task = null;
			}
		}

		$this->render('index', array(
			'track' => $this->track,
			'task' => $task,
			// 'formats' => $formats,
			));
	}

	public function actionDownload() {
		if (Yii::app()->user->isBot()) 
			throw new CHttpException(403, 'Unavailable for bot.');
		
		// ready
		if (file_exists(Yii::getPathOfAlias('webroot').Yii::app()->downloadsManager->filesDirectory.$this->track->getFilename()) && $this->track->getTask() === null) {
			if (!$this->track->downloaded)
				$this->track->downloaded = 1;
			$this->track->downloads_count++;
			$this->track->download_last_time = new CDbExpression('NOW()');
			$this->track->save();
			try {
				Yii::app()->downloadsManager->ensureLinkExists($this->track->getFilename(), $this->track->getDownloadFilename());
			} catch (RuntimeException $e) {
				throw new CHttpException(500, 'На сервере произошла ошибка.', $e);
			}
			$this->redirect(Yii::app()->baseUrl.Yii::app()->downloadsManager->linksDirectory.$this->track->getDownloadFilename());
		}  else {
			if ($this->track->downloaded) {
				$this->track->downloaded = 0;
				$this->track->save();
			}

			if (($task = $this->track->getTask()) !== null) { // processing
				if ($task->phase == EncodingQueue::ENCODED) {
					$track = PrimeMusicTracks::handleFinishedTask($this->track, $task);
					$this->redirect($this->createUrl('download', array('id' => $this->track->id)));
				} else {
					Yii::app()->encoder->ensureEncoderRunning();
					$this->setFlash('Трек подготавливается к скачиванию ...');
					$phaseLabels = $task->phaseLabels();
					$this->setFlash('Этап: '.$phaseLabels[$task->phase].($task->phase > EncodingQueue::PENDING ? ' ('.($task->phase - 1).' из 4)'.($task->progress != -1 ? ' выполнен на '.$task->progress.'%' : null) : null));
					$this->redirect($this->createUrl('index', array('id' => $this->track->id)));
				}
			}  else { // not ready
				Yii::app()->filesystem->ensureFreeSpace(Yii::getPathOfAlias('webroot'));
				try {
				$this->track->addFileToQueue();
				} catch (RuntimeException $e) {
					throw new CHttpException(404, 'Возникла ошибка. Трек не может быть загружен');
				}
				$this->setFlash('Трек добавлен в очередь на подготовку.');
				$this->redirect($this->createUrl('index', array('id' => $this->track->id)));
			}
		}
	}

	public function actionRelated() {
		$relatedVideos = Yii::app()->youtubeHelper->getRelatedFeed($this->video->youtube_id);
		$this->render('related', array(
			'video' => $this->video,
			'related_videos' => $relatedVideos,
			));
	}
}
