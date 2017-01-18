<?php
class YoutubeVideoThumbnail {
	public $time;
	public $url;
	public $height;
	public $width;

	static public function createFromArray(array $data) {
		$format = new self;
		$format->time = $data['time'];
		$format->url = $data['url'];
		$format->height = $data['height'];
		$format->width = $data['width'];
		return $format;
	}
}
