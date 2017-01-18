<?php
class TranslateModule extends WebModule {

	/**
	 * API ключ на яндексе
	 */
	public $yandexApiKey;

	public function init() {
		$this->setImport(array(
			'translate.models.*',
			'translate.components.*',
		));
	}

	public function beforeControllerAction($controller, $action) {
		if(parent::beforeControllerAction($controller, $action)) {
			$controller->headerImage = Yii::app()->theme->baseUrl.'/images/translate.png';
			$controller->headerLink = Yii::app()->createUrl('/'.$this->name);
			return true;
		} else
			return false;
	}
	
}
