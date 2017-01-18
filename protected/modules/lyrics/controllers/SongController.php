<?php
class SongController extends Controller {

	public $song;
	public $language;

	public function beforeAction($action) {
		if (parent::beforeAction($action)) {
			if (!isset($_GET['language']))
				throw new CHttpException(404, 'Language is empty.');
			if (!in_array($this->language = $_GET['language'], array('rus', 'eng')))
				throw new CHttpException(404, 'Invalid language.');

			$database_model = $this->language == 'eng' ? 'LyricsNetSongs' : 'MuzotonSongs';

			if (!isset($_GET['id']))
				throw new CHttpException(404, 'Song id is empty.');
			if (($this->song = $database_model::model()->findByPk($_GET['id'])) === null)
				throw new CHttpException(404, 'Invalid song ID.');
			return true;
		}
		return false;
	}

	public function actionIndex() {

		if (!function_exists('gzdecode')) {
			function gzdecode($data) {
				return gzinflate(substr($data,10,-8));
			}
		}

		if (!Yii::app()->user->isBot()) {
			$this->song->views_count++;
			$this->song->view_last_time = new CDbExpression('NOW()');
			$this->song->save();
		}
		
		if ($this->song->skipped)
			$this->redirect($this->createUrl('/lyrics'));

		$lyrics_file = Yii::getPathOfAlias('webroot').Yii::app()->downloadsManager->filesDirectory.$this->song->path.'.txt.gz';
		if (!file_exists($lyrics_file))
			throw new CHttpException(500, 'Lyrics doesn\'t exist!');
		$lyrics = gzdecode(file_get_contents($lyrics_file));

		$translation_file = Yii::getPathOfAlias('webroot').Yii::app()->downloadsManager->filesDirectory.$this->song->path.'.translation.txt.gz';
		if (file_exists($translation_file)) {
			$translation = gzdecode(file_get_contents($translation_file));
		}
			

		$this->render('index', array(
			'song' => $this->song,
			'lyrics' => $lyrics,
			'translation' => isset($translation) ? $translation : null,
			'language' => $this->language,
			));
	}

}
