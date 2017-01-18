<?php
class Encoder extends CApplicationComponent {

	public $idTemplate = '{prefix}:{id}:{format}';
	public $maxRunningThreads = 1;

	public function ensureEncoderRunning() {
		// return 0;
		echo $this->scriptName;
		$pid = system('pgrep -f '.escapeshellarg($this->scriptName.' start'));
		// var_dump($pid);
		// exit;
		if (empty($pid)) {
			Yii::app()->filesystem->ensureFileWritable($this->logFile);
			Yii::app()->filesystem->ensureFileWritable($this->errorLogFile);
			$this->startEncoder();
		}

	}

	public function getScriptName() {
		return dirname(dirname(__FILE__)).'/yiic encoder';
	}

	public function getLogFile($postfix = null) {
		return dirname(dirname(__FILE__)).'/runtime/encoder.log';
	}

	public function getErrorLogFile($postfix = null) {
		return dirname(dirname(__FILE__)).'/runtime/encoder.error.log';
	}

	protected function startEncoder() {
		Yii::log('Starting encoder ...');
		$cmd = $this->scriptName.' start --maxRunningThreads='.$this->maxRunningThreads.' >>'.$this->logFile.' 2>>'.$this->errorLogFile.' &';
		// var_dump($cmd);
		// exit;
		exec($cmd);
		Yii::log($cmd);
	}

	/**
	 * Удостоверяется в том, что папка временных файлой существует и доступна для записи
	 */
	static public function ensureTmpDirWritable() {
		$dir = Yii::getPathOfAlias('webroot').'/tmp';

		if (file_exists($dir) && !is_dir($dir))
			throw new RuntimeException('"'.$dir.'" must be a directory!');

		if (!is_dir($dir) && !mkdir($dir, 0777, true))
			throw new RuntimeException('Can not create "'.$dir.'"!');
			
		if (!is_writable($dir) && !chmod($dir, 0777))
			throw new RuntimeException('Can not chmod "'.$dir.'"!');
	}
}