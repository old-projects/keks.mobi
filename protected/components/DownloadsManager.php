<?php
class DownloadsManager extends CApplicationComponent {

	/**
	 * Каталоги с файлами и с ссылками на файлы.
	 * Должны быть в webroot.
	 */
	public $filesDirectory = '/files';
	public $linksDirectory = '/download';
	public $screenshotsDirectory = '/screenshots';

	/**
	 * Публикует ссылку на filename.
	 * @param string $filename Месторасположения файла относитель files/
	 * @todo Выяснить, почему нельзя создать относительную ссылку (target_file) в другом каталоге.
	 */
	public function ensureLinkExists($filename, $link) {
		$file_filename = Yii::getPathOfAlias('webroot').$this->filesDirectory.$filename;
		$link_filename = Yii::getPathOfAlias('webroot').$this->linksDirectory.$link;
		// $target_file = rtrim(str_repeat('../', count(explode('/', $filename)) - 1), '/').$this->filesDirectory.$filename;
		// var_dump($file_filename, $link_filename, $target_file, realpath($target_file), file_exists($link_filename));
		if (file_exists($link_filename)) {
			if (readlink($link_filename) != $file_filename) {
				if (!unlink($link_filename)) {
					throw new RuntimeException('Can not delete invalid link '.$link.'!');
				}
			}
		} else {
			// var_dump($file_filename, $link_filename);
			Yii::app()->filesystem->ensureDirWritable(dirname($link_filename));
			if (!symlink($file_filename, $link_filename)) {
				throw new RuntimeException('Can not create link '.$link.'!');
			}
		}
	}

}
