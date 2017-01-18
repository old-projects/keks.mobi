<?php
class VideoModule extends WebModule {
	public $cachePrefix = 'video_';
	public $videosPerPage = 10;
	public $queueTemplate = 'youtube:{id}:{format}';
	public $relatedVideosLimit = 3;
	public $statisticLifeTime = 600;
	public $markVideo = false;

	public $metadata = array(
		'artist' => null,
		'title' => '{title}',
		'album' => 'Видео на keks.mobi',
		'genre' => 'Аудио из видеоролика',
		'copyright' => 'Только для ознакомления',
		'encoded_by' => 'keks.mobi encoder',
	);

	/**
	 * Максимальное количество видео, которое будет запрашиваться с yt в каждом фиде.
	 */
	public $maxVideos = 500;
	/**
	 * Размер блока форматов. Используется для деления файлов форматов на каталоги.
	 */
	public $formatBlockSize = 1000;


	public function init() {
		$this->setImport(array(
			'video.models.*',
			'video.components.*',
		));
	}

	/**
	 * 
	 */
	public function beforeControllerAction($controller, $action) {
		if(parent::beforeControllerAction($controller, $action)) {
			$controller->headerImage = Yii::app()->theme->baseUrl.'/images/video.png';
			$controller->headerLink = Yii::app()->createUrl('/'.$this->name);
			return true;
		} else
			return false;
	}

	public function getAllowedFormats() {
		return array(
			YoutubeHelper::MOBILE_144,
			YoutubeHelper::MOBILE_240,
			YoutubeHelper::MP4_360,
		);
	}

	/**
	 * Функция возвращает количество видео файлов, находящихся в бд, обеспечивая кэширование данных.
	 */
	public function getTotalVideos() {
		if (($total_videos = Yii::app()->cache->get($this->cachePrefix.'total_videos')) === false) {
			$total_videos = Videos::model()->count();
			Yii::app()->cache->set($this->cachePrefix.'total_videos', $total_videos, $this->statisticLifeTime);
		}
		return $total_videos;
	}

	// /**
	//  * Функция возвращает объём видео файлов, записанных на диске, обеспечивая кэширование данных.
	//  */
	// public function getTotalVideoSize() {
	// 	if (($total_video_size = Yii::app()->cache->get($this->cachePrefix.'total_video_size')) === false) {
	// 		$criteria = new CDbCriteria;
	// 		$criteria->select = 'SUM(filesize) as total_video_size';
	// 		$stat = VideosFormats::model()->find($criteria);
	// 		$total_video_size = $stat->total_video_size;
	// 		Yii::app()->cache->set($this->cachePrefix.'total_video_size', $total_video_size, $this->statisticLifeTime);
	// 	}
	// 	return $total_video_size;
	// }

	/**
	 * Заполнить sitemap ссылками
	 */
	public function fillSitemap(SitemapGenerator $generator) {
		$dataReader = Yii::app()->db->createCommand()
			->select('id')
			->from(Videos::model()->tablename())
			// ->where('images_count > 0')
			->query();
		while (($video = $dataReader->read()) !== false) {
			$generator->addUrl($this, array('/'.$this->name.'/video/index', array('id' => $video['id'])));
		}
	}
	
}
