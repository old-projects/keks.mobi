<?php
class FilesizeWidget extends CWidget {
	public $size = 0;

	public function run() {
		$s = array('б', 'кб', 'мб', 'гб', 'тб', 'пб');
		if ($this->size == 0)
			return '0 '.$s[0];
		$e = floor(log($this->size)/log(1024));
		$output = sprintf('%.2f '.$s[$e], ($this->size/pow(1024, floor($e))));
		return $output;
	}

	public function __toString() {
		return $this->run();
	}
}
