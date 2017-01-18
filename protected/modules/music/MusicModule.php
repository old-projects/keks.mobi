<?php
class MusicModule extends WebModule {

	public $cachePrefix = 'music_';
	public $statisticLifeTime = 600;
	public $tracksPerPage = 10;

	public $metadata = array(
		'artist' => '{artist}',
		'title' => '{title}',
		'album' => 'Музыка на keks.mobi',
		'genre' => '{category_name}',
		'copyright' => 'Только для ознакомления',
		'encoded_by' => 'keks.mobi encoder',
	);

	/**
	 * Количество файлов в одной папке на сервере
	 */
	public $tracksBlockSize = 1000;

	public function init() {
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'music.models.*',
			'music.components.*',
		));
	}

	/**
	 * 
	 */
	public function beforeControllerAction($controller, $action) {
		if(parent::beforeControllerAction($controller, $action)) {
			$controller->headerImage = Yii::app()->theme->baseUrl.'/images/music.png';
			$controller->headerLink = Yii::app()->createUrl('/'.$this->name);
			return true;
		} else
			return false;
	}

	/**
	 * Функция возвращает количество аудио файлов, находящихся в бд, обеспечивая кэширование данных.
	 */
	public function getTotalTracks() {
		if (($total_tracks = Yii::app()->cache->get($this->cachePrefix.'total_tracks')) === false) {
			$total_tracks = PrimeMusicTracks::model()->count();
			Yii::app()->cache->set($this->cachePrefix.'total_tracks', $total_tracks, $this->statisticLifeTime);
		}
		return $total_tracks;
	}

	/**
	 * Функция возвращает объём аудио файлов, записанных на диске, обеспечивая кэширование данных.
	 */
	public function getTotalTracksSize() {
		if (($total_tracks_size = Yii::app()->cache->get($this->cachePrefix.'total_tracks_size')) === false) {
			$criteria = new CDbCriteria;
			$criteria->select = 'SUM(filesize) as total_tracks_size';
			$stat = PrimeMusicTracks::model()->find($criteria);
			$total_tracks_size = $stat->total_tracks_size;
			Yii::app()->cache->set($this->cachePrefix.'total_tracks_size', $total_tracks_size, $this->statisticLifeTime);
		}
		return $total_tracks_size;
	}

	public function getCyrillicLetters() {
		// return array('а', 'б', 'в', 'г', 'д', 'e', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у',  'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ь', 'ю', 'я');
		return array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ь', 'Ю', 'Я');
	}

	public function getSortingLabels() {
		return array(
			'update_time' => 'по дате добавления',
			'downloads_count' => 'по количеству скачиваний',
			'download_last_time' => 'по дате последнего скачивания',
			'filesize' => 'по размеру файла',
			'duration' => 'по длительности',
		);	
	}

	/**
	 * Заполнить sitemap ссылками
	 */
	public function fillSitemap(SitemapGenerator $generator) {
		$dataReader = Yii::app()->db->createCommand()
			->select('id')
			->from(PrimeMusicTracks::model()->tablename())
			->query();
		while (($track = $dataReader->read()) !== false) {
			$generator->addUrl($this, array('/'.$this->name.'/track/index', array('id' => $track['id'])));
		}
	}

}
