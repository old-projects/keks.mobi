<?php
class ImagesModule extends WebModule {

	public $cachePrefix = 'images_';
	public $statisticLifeTime = 600;
	public $imagesPerPage = 10;
	public $randomSetsOnMainPage = 15;
	
	/**
	 * Количество файлов в одной папке на сервере
	 */
	public $imagesBlockSize = 1000;

	public function init() {
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'images.models.*',
			'images.components.*',
		));
	}

	/**
	 * 
	 */
	public function beforeControllerAction($controller, $action) {
		if(parent::beforeControllerAction($controller, $action)) {
			$controller->headerImage = Yii::app()->theme->baseUrl.'/images/funny.png';
			$controller->headerLink = Yii::app()->createUrl('/'.$this->name);
			return true;
		} else
			return false;
	}

	/**
	 * Функция возвращает количество картинок, обеспечивая кэширование данных.
	 */
	public function getTotalImages() {
		$statistic = $this->getStatistic();
		return $statistic[0];
	}

	/**
	 * Функция возвращает объём картинок, записанных на диске, обеспечивая кэширование данных.
	 */
	public function getTotalImagesSize() {
		$statistic = $this->getStatistic();
		return $statistic[1];
	}

	/**
	 * Функция возвращает количество картинок(0) и общий объём (1)
	 */
	public function getStatistic() {
		if (($statistic = Yii::app()->cache->get($this->cachePrefix.'statistic')) === false) {
			$criteria = new CDbCriteria;
			$criteria->select = 'COUNT(*) as total_images, SUM(filesize) as total_images_size';
			$data = PoltavaImages::model()->find($criteria);
			$statistic = array($data->total_images, $data->total_images_size);
			Yii::app()->cache->set($this->cachePrefix.'statistic', $statistic, $this->statisticLifeTime);
		}
		return $statistic;
	}

	/**
	 * Заполнить sitemap ссылками
	 */
	public function fillSitemap(SitemapGenerator $generator) {
		$dataReader = Yii::app()->db->createCommand()
			->select('id')
			->from(PoltavaImagesSets::model()->tablename())
			->where('images_count > 0')
			->query();
		while (($set = $dataReader->read()) !== false) {
			$generator->addUrl($this, array('/'.$this->name.'/default/set', array('id' => $set['id'])));
		}
	}
	
}
