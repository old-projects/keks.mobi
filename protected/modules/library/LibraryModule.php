<?php
class LibraryModule extends CWebModule {

	/**
	 * Префикс для ключа кэша
	 */
	public $cachePrefix = 'library';
	/**
	 * Время жизни статистики в кэши
	 */
	public $statisticLifeTime = 600;

	/**
	 * Количество книг на странице
	 */
	public $booksPerPage = 10;
	/**
	 * Количество авторов на странице
	 */
	public $authorsPerPage = 10;
	/**
	 * Количество файлов в одной папке на сервере
	 */
	public $booksPerBlock = 1000;

	public function init() {
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'library.models.*',
			'library.components.*',
		));
	}

	public function beforeControllerAction($controller, $action) {
		if(parent::beforeControllerAction($controller, $action)) {
			$controller->headerImage = Yii::app()->theme->baseUrl.'/images/library.png';
			$controller->headerLink = Yii::app()->createUrl('/'.$this->name);
			return true;
		} else
			return false;
	}

	/**
	 * Функция возвращает количество авторов, обеспечивая кэширование данных.
	 */
	public function getTotalAuthors() {
		$cache_key = $this->cachePrefix.'_total_authors';
		if (($total_authors = Yii::app()->cache->get($cache_key)) === false) {
			$total_authors = LibrusecAuthors::model()->count();
			Yii::app()->cache->set($cache_key, $total_authors, $this->statisticLifeTime);
		}
		return $total_authors;
	}

	/**
	 * Функция возвращает количество книг, обеспечивая кэширование данных.
	 */
	public function getTotalBooks() {
		$cache_key = $this->cachePrefix.'_total_books';
		if (($total_books = Yii::app()->cache->get($cache_key)) === false) {
			$total_books = LibrusecBooks::model()->count();
			Yii::app()->cache->set($cache_key, $total_books, $this->statisticLifeTime);
		}
		return $total_books;
	}
	
}
