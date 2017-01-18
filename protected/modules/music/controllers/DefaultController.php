<?php

class DefaultController extends Controller {

	public function actionIndex() {
		$model = new SearchForm;

		$queue_tasks_count = EncodingQueue::model()->count('phase != :lashPhase AND id LIKE "music:%"', array(':lashPhase' => EncodingQueue::ENCODED));
		$queue_tasks = EncodingQueue::model()->running('music')->findAll();
		
		$this->render('index', array(
			'categories' => PrimeMusicCategories::model()->findAll('skipped = "0"'),
			'model' => $model,
			'russian_letters' => $this->module->getCyrillicLetters(),

			'total_tracks' => $this->module->getTotalTracks(),
			'total_tracks_size' => $this->module->getTotalTracksSize(),

			'queue_tasks_count' => $queue_tasks_count,
			'queue_tasks' => $queue_tasks,
		));
	}

	/**
	 * Просмотр категории
	 */
	public function actionCategory($category_id) {
		if (!is_numeric($category_id) || ($category = PrimeMusicCategories::model()->findByPk($category_id)) == null) 
			throw new CHttpException(404, 'Invalid category ID.');

		$sorting_selector = new Selector($this->module->getSortingLabels());
		$sorting_selector->defaultItem = 'downloads_count';
		
		$criteria = new CDbCriteria;
		$criteria->condition = 'category_id = '.$category_id;
		$criteria->order = $sorting_selector->selectedItem.' DESC';
		$dataProvider=new CActiveDataProvider('PrimeMusicTracks', array(
			'criteria' => $criteria,
			'pagination' => array(
				'pageSize' => $this->module->tracksPerPage,
			),
		));
		$this->render('category', array(
			'category' => $category,
			'dataProvider' => $dataProvider,
			'sorting_selector' => $sorting_selector,
			));
	}

	/**
	 * Поиск по артисту
	 */
	public function actionArtist($letter) {
		if (!in_array($letter, array_merge($this->module->getCyrillicLetters(), range('a', 'z'), range(0, 9)))) {
			throw new CHttpException(404, 'Invalid letter');
		}

		$sorting_labels = array(
			'artist' => 'по имени',
			'count' => 'по количеству треков',
		);

		$sorting_selector = new Selector($sorting_labels);
		
		$criteria = new CDbCriteria;
		$criteria->select = 'artist, count(artist) as count';
		$criteria->condition = 'artist LIKE "'.$letter.'%"';
		$criteria->group = 'artist';
		$criteria->order = $sorting_selector->selectedItem.' '.($sorting_selector->selectedItem == 'artist' ? 'ASC' : 'DESC');
		$dataProvider=new CActiveDataProvider('PrimeMusicTracks', array(
			'criteria' => $criteria,
			'pagination' => array(
				'pageSize' => $this->module->tracksPerPage,
			),
		));
		$this->render('artist', array(
			'letter' => $letter,
			'dataProvider' => $dataProvider,
			'sorting_selector' => $sorting_selector,
			));
	}

	/**
	 * Поиск треков
	 */
	public function actionSearch() {
		$model = new SearchForm(isset($_GET['advanced']) && (bool)$_GET['advanced'] ? 'advanced' : null);
		$categories = PrimeMusicCategories::getCategoriesForListBox();
		if (isset($_GET['SearchForm'])) {
			$model->attributes = $_GET['SearchForm'];
			if ($model->validate()) {
				if (!empty($model->artist) || !empty($model->title)) {
					$sorting_selector = new Selector($this->module->getSortingLabels());
					$sorting_selector->defaultItem = 'downloads_count';
					
					$criteria = new CDbCriteria;
					if ($model->category > 0)
						$criteria->condition = 'category_id = '.$model->category;
					if (!empty($model->artist))
						$criteria->condition .= (!empty($criteria->condition) ? ' AND ' : null).'artist LIKE "%'.$model->artist.'%"';
					if (!empty($model->title))
						$criteria->condition .= (!empty($criteria->condition) ? ' AND ' : null).'title LIKE "%'.$model->title.'%"';

					$criteria->order = $sorting_selector->selectedItem.' DESC';

					$dataProvider = new CActiveDataProvider('PrimeMusicTracks', array(
						'criteria' => $criteria,
						'pagination' => array(
							'pageSize' => $this->module->tracksPerPage,
						),
					));
				}
			}
		}
		$this->render('search', array(
			'model' => $model,
			'categories' => $categories,
			'dataProvider' => (isset($dataProvider) ? $dataProvider : null),
			'sorting_selector' => (isset($sorting_selector) ? $sorting_selector : null),
		));
	}
	
}