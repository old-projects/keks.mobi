<?php
class YoutubeVideoFormat {
	public $itag;
	public $type;
	public $quality;
	public $signature;
	public $url;

	static public function createFromArray(array $data) {
		// var_dump($data);
		$format = new self;
		$format->itag = $data['itag'];
		$format->type = $data['type'];
		$format->quality = $data['quality'];
		$format->signature = $data['sig'];
		$format->url = $data['url'];
		return $format;
	}

	public function getDownloadUrl() {
		return $this->url.'&signature='.$this->signature;
	}
}
