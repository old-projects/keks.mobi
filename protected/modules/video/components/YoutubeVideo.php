<?php
class YoutubeVideo extends StdClass {

	/**
	 * Стандартные поля видео, унаследованные он Zend_Gdata_Youtube_VideoEntry
	 */
	public $title;
	public $id;
	public $updated;
	public $description;
	public $category;
	public $tags;
	public $watchUrl;
	public $flashUrl;
	public $duration;
	public $viewCount;
	public $ratingInfo;
	public $geoLocation;
	public $recorded;
	public $thumbnails = array();

	/**
	 * Кука ютьюба, необходимая для скачивания
	 */
	private $_visitor_cookie;
	/**
	 * Список форматов видео
	 */
	private $_formats;

	const
		LOW = 90,
		MIDDLE = 180,
		HIGH = 360;

	public function getThumbnailUrl($quality) {
		$q = array_filter($this->thumbnails, function($value) use ($quality) {
			// var_dump($value);
			// exit;
			return ($value->height == $quality);
		});
		if (empty($q))
			throw new RuntimeException('Invalid thumbnail quality "'.$quality.'"');
		$url = $q[array_rand($q)]->url;
		if (!preg_match('~^http(s)?\:\/\/i(?<server>[0-9]+)?\.ytimg\.com\/vi\/(?<path>.+)$~u', $url, $url_parts))
			throw new RuntimeException('Invalid thumbnail url "'.$url.'"');
		// var_dump($url_parts);
		// if (substr($url, 0, strlen('http://i.ytimg.com/vi/')) != 'http://i.ytimg.com/vi/' && substr($url, 0, strlen('https://i.ytimg.com/vi/')) != 'https://i.ytimg.com/vi/')
			// throw new RuntimeException('Invalid thumbnail url "'.$url.'"');
		// return str_replace(array('http://i.ytimg.com/vi/', 'https://i.ytimg.com/vi/'), Yii::app()->baseUrl.'/screens/video/', $url);
		return Yii::app()->baseUrl.'/screens/video/'.$url_parts['path'];
	}

	public function getAvailableFormats() {
		Yii::trace('Getting video\'s download links...'.$this->id);
		$video_watch_url = 'http://www.youtube.com/watch?v='.$this->id;
		$page = HttpHelper::getUrlContents($video_watch_url, array(CURLOPT_HEADER => true));
		list($headers, $output) = preg_split("~\r?\n\r?\n~", $page, 2);

		if (!preg_match('~VISITOR_INFO1_LIVE\=(.{11})\;~s', $headers, $visitor_cookie)) {
			Yii::log($page);
			throw new RuntimeException('Can not parse cookie!');
		}

		$this->_visitor_cookie = $visitor_cookie[1];

		$page = str_replace('\u0026', '&', $page);
		if (!preg_match('~"url_encoded_fmt_stream_map"\: "([^"]+)"~msu', $page, $links)) {
			Yii::log($page);
			throw new RuntimeException('Can not parse available formats!');
		}

		$this->_formats = array();
		foreach (explode(',', $links[1]) as $format) {
			parse_str($format, $format_data);
			$this->_formats[$format_data['itag']] = YoutubeVideoFormat::createFromArray($format_data);
		}
		return $this->_formats;
	}

	/**
	 * Возвращает прямую ссылку на скачивание видео файла.
	 * Ссылка действует только для IP, с которого вызывалась функция getAvailableFormats()
	 */
	public function getDirectDownloadLink($itag) {
		if (empty($this->_formats))
			$this->getAvailableFormats();
		if (!isset($this->_formats[$itag]))
			throw new RuntimeException('Invalid ITAG!');

		// var_dump($this->_formats[$itag]->getDownloadUrl());
		$page = HttpHelper::getUrlContents($this->_formats[$itag]->getDownloadUrl(), array(
			CURLOPT_COOKIE => 'VISITOR_INFO1_LIVE='.$this->_visitor_cookie,
			CURLOPT_HEADER => true,
			CURLOPT_NOBODY => true,
		));

		if (!preg_match("~Location\: ([^\r\n]+)\r?\n~", $page, $link)) {
			// если перенаправления нет
			if (stripos($page, 'Content-Type: video/') !== false)
				return $this->_formats[$itag]->getDownloadUrl();

			Yii::log($page);
			// exit($page);
			throw new RuntimeException('Can not parse direct link!');
		}
		return $link[1];
	}
}