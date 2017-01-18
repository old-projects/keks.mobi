<?php
class FileSystem extends CApplicationComponent {
	/**
	 * Количество свободного места (%), которое должно существовать
	 */
	public $freeSpacePercent = 10;

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
		if (file_exists($link_filename)) {
			if (readlink($link_filename) != $file_filename) {
				if (!unlink($link_filename)) {
					throw new RuntimeException('Can not delete invalid link '.$link.'!');
				}
			}
		} else {
			$this->ensureDirWritable(dirname($link_filename));
			if (!symlink($file_filename, $link_filename)) {
				throw new RuntimeException('Can not create link '.$link.'!');
			}
		}
	}

	/**
	 * Удостоверяется в том, что папка существует и доступна для записи
	 */
	public function ensureDirWritable($dir) {
		if (file_exists($dir) && !is_dir($dir))
			throw new RuntimeException('"'.$dir.'" must be a directory!');

		if (!is_dir($dir) && !mkdir($dir, 0777, true))
			throw new RuntimeException('Can not create "'.$dir.'"!');
			
		if (!is_writable($dir) && !chmod($dir, 0777))
			throw new RuntimeException('Can not chmod "'.$dir.'"!');
	}

	/**
	 * Удостоверяется в том, что файл существует и доступен для записи
	 */
	public function ensureFileWritable($file) {
		if (file_exists($file) && !is_file($file))
			throw new RuntimeException('"'.$file.'" must be a file!');

		if (!is_file($file) && !touch($file))
			throw new RuntimeException('Can not create "'.$file.'"!');
			
		if (!is_writable($file) && !chmod($file, 0666))
			throw new RuntimeException('Can not chmod "'.$file.'"!');
	}

	/**
	 * Удостоверяется в том, что папка существует и доступна для записи
	 */
	public function ensureFreeSpace($dir) {
		if (!file_exists($dir) || !is_dir($dir))
			throw new RuntimeException('"'.$dir.'" must be a directory!');

		$free_space = disk_free_space($dir);
		$total_space = disk_total_space($dir);
		$free_percent = ($free_space / $total_space * 100);

		if ($free_percent < $this->freeSpacePercent)
			throw new RuntimeException('No more available disk space!');
		
	}

	/**
	 * Удостоверяется в том, что файл удалён
	 */
	public function deleteFile($file) {
		if (!file_exists($file))
			throw new RuntimeException('"'.$file.'" doesn\'t exist!');

		if (!unlink($file))
			throw new RuntimeException('Can not delete "'.$file.'"!');
	}
}