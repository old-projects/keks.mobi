<?php

class DefaultController extends Controller {

	public function actionIndex() {
		$criteria = new CDbCriteria;
		$criteria->order = 'rand()';;
		$this->render('index', array(
			'total_images' => $this->module->getTotalImages(),
			'total_images_size' => $this->module->getTotalImagesSize(),
			'random_sets' => PoltavaImagesSets::getRandomSets($this->module->randomSetsOnMainPage),
		));
	}

	/**
	 * Просмотр в виде списка
	 */
	public function actionList() {
		$sorting_labels = array(
			'add_time' => 'по дате добавления',
			'views_count' => 'по популярности',
			'view_last_time' => 'по дате последнего просмотра',
			'images_count' => 'по количеству изображений',
		);
		$sorting_selector = new Selector($sorting_labels);

		$criteria = new CDbCriteria;
		$criteria->condition = 'images_count > 0';
		$criteria->order = $sorting_selector->selectedItem.' DESC';
		$dataProvider=new CActiveDataProvider('PoltavaImagesSets', array(
			'criteria' => $criteria,
			'pagination' => array(
				'pageSize' => $this->module->imagesPerPage,
			),
		));
		$this->render('list', array(
			'dataProvider' => $dataProvider,
			'sorting_selector' => $sorting_selector,
			));
	}

	/**
	 * Просмотр сета
	 */
	public function actionSet($id) {
		if (!is_numeric($id) || ($set = PoltavaImagesSets::model()->findByPk($id)) == null) 
			throw new CHttpException(404, 'Invalid set ID.');
		Yii::app()->downloadsManager->ensureLinkExists('/images', '/images');

		if (!Yii::app()->user->isBot()) {
			$set->views_count ++;
			$set->view_last_time = new CDbExpression('NOW()');
			$set->save();
		}
		
		$this->render('set', array(
			'set' => $set,
		));
	}

	public function actionRand() {
		$sets = PoltavaImagesSets::getRandomSets(1);
		if (empty($sets)) {
			$this->redirect($this->createUrl('index'));	
		}
		$set = $sets[0];
		$this->redirect($this->createUrl('set', array('id' => $set->id)));
	}
}