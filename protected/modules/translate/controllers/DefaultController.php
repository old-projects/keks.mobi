<?php
class DefaultController extends Controller {

	public function actionIndex() {
		$model = new TranslateForm;
		if (isset($_GET['TranslateForm'])) {
			$model->attributes = $_GET['TranslateForm'];
			if ($model->validate()) {
				$source_language = $model->sourceLanguage;
				try {
					$result_text = Translater::yandexTranslate($model->text, $source_language, $model->targetLanguage, $this->module->yandexApiKey);
				} catch (RuntimeException $e) {
					throw new CHttpException(500, 'An error occured while translating.', $e);
				}
			}
		}
		$this->render('index', array(
			'model' => $model,
			'result_text' => isset($result_text) ? $result_text : null,
		));
	}
	
}
