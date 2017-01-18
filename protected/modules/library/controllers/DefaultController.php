<?php

class DefaultController extends Controller {

	public function actionIndex() {
		$model = new SearchForm;

		$this->render('index', array(
			'model' => $model,
			'total_authors' => $this->module->totalAuthors,
			'total_books' => $this->module->totalBooks,
			'genres' => LibrusecGenres::model()->main()->findAll(),
		));
	}

	/**
	 * Поиск треков
	 */
	public function actionSearch() {
		$model = new SearchForm(isset($_GET['advanced']) && (bool)$_GET['advanced'] ? 'advanced' : null);
		if (isset($_GET['SearchForm'])) {
			$model->attributes = $_GET['SearchForm'];
			if ($model->validate()) {
				if (/*!empty($model->artist) || */!empty($model->query)) {

					switch ($model->content) {
						default:

							// количество авторов
							$criteria = new CDbCriteria;
							$criteria->condition = 'full_name LIKE "%'.$model->query.'%"';
							$authors_count = LibrusecAuthors::model()->count($criteria);

							$criteria = new CDbCriteria;
							$criteria->condition = 'title LIKE "%'.$model->query.'%"';
							$books_count = LibrusecBooks::model()->count($criteria);


							break;
						case 'author':

							$criteria = new CDbCriteria;
							// $criteria->with = 'artist';
							// if ($model->category > 0)
							// 	$criteria->condition = 'category_id = '.$model->category;
							// if (!empty($model->artist))
							// 	$criteria->condition .= (!empty($criteria->condition) ? ' AND ' : null).'artist.name LIKE "%'.$model->artist.'%"';
							$criteria->condition = 'full_name LIKE "%'.$model->query.'%"';
							// $criteria->scopes = array('alphabetically', 'filled');
							$dataProvider = new CActiveDataProvider('LibrusecAuthors', array(
								'criteria' => $criteria,
								'pagination' => array(
									'pageSize' => $this->module->authorsPerPage,
								),
							));
							break;
						case 'book':
							$sorting_labels = array(
								'title' => 'по имени',
								// 'views_count' => 'по количеству просмотров',
								// 'view_last_time' => 'по последнему просмотру',
							);

							$sorting_selector = new Selector($sorting_labels);

							$criteria = new CDbCriteria;
							// $criteria->with = 'artist';
							// if ($model->category > 0)
							// 	$criteria->condition = 'category_id = '.$model->category;
							// if (!empty($model->artist))
							// 	$criteria->condition .= (!empty($criteria->condition) ? ' AND ' : null).'artist.name LIKE "%'.$model->artist.'%"';
							$criteria->condition = 'title LIKE "%'.$model->query.'%"';

							$criteria->order = $sorting_selector->selectedItem.' '.($sorting_selector->selectedItem == 'title' ? 'ASC' : 'DESC');
							// $criteria->scopes = 'active';
							$dataProvider = new CActiveDataProvider('LibrusecBooks', array(
								'criteria' => $criteria,
								'pagination' => array(
									'pageSize' => $this->module->booksPerPage,
								),
							));
							break;
					}
				}
			}
		}
		$this->render('search', array(
			'model' => $model,
			'dataProvider' => (isset($dataProvider) ? $dataProvider : null),
			'authors_count' => (isset($authors_count) ? $authors_count : null),
			'books_count' => (isset($books_count) ? $books_count : null),
			'sorting_selector' => (isset($sorting_selector) ? $sorting_selector : null),
		));
	}
	
}