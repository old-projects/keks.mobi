<?php
class ArtistController extends Controller {

	public $artist;
	public $language;

	public function beforeAction($action) {
		if (parent::beforeAction($action)) {
			if (!isset($_GET['language']))
				throw new CHttpException(404, 'Language is empty.');
			if (!in_array($this->language = $_GET['language'], array('rus', 'eng')))
				throw new CHttpException(404, 'Invalid language.');

			$database_model = $this->language == 'eng' ? 'LyricsNetArtists' : 'MuzotonArtists';

			if (!isset($_GET['id']))
				throw new CHttpException(404, 'Artist id is empty.');
			if (($this->artist = $database_model::model()->findByPk($_GET['id'])) === null)
				throw new CHttpException(404, 'Invalid artist ID.');


			return true;
		}
		return false;
	}

	public function actionIndex() {
		$dataProvider = new CArrayDataProvider($this->artist->songs, array(
			// 'criteria' => $criteria,
			'pagination' => array(
				'pageSize' => $this->module->songsPerPage,
			),
		));
		$this->render('index', array(
			'dataProvider' => $dataProvider,
			'artist' => $this->artist,
			'language' => $this->language,
			));
	}

}
