<?php
class Theme extends CTheme {
	public function controller() {
		return Yii::app()->controller;
	}

	public function __get($name) {
		if (isset($this->controller()->$name))
			return $this->controller()->$name;
		elseif (isset(parent::$name))
			return parent::$name;
		else
			return parent::__get($name);
	}

	public function __set($name, $value) {
		if (isset($this->controller()->$name))
			$this->controller()->$name = $value;
		elseif (isset(parent::$name))
			parent::$name = $value;
		else
			return parent::__set($name, $value);
	}

	public function createUrl($route,$params=array(),$ampersand='&') {
		return $this->controller->createUrl($route, $params, $ampersand);
	}
}