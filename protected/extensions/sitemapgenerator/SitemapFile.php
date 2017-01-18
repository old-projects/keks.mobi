<?php
class SitemapFile {
	protected $_linksCount = 0;
	protected $_filename;
	protected $_resource;

	public function __construct($filename) {
		$this->_filename = $filename;
		$this->_resource = fopen($filename, 'w');
		$this->write('<?xml version="1.0" encoding="UTF-8"?>'
				.'<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'.PHP_EOL);
	}

	public function finish() {
		$this->write('</urlset>');
		fclose($this->_resource);
	}

	public function __destruct() {
		if (is_resource($this->_resource))
			fclose($this->_resource);
	}

	public function write($string) {
		return fwrite($this->_resource, $string);
	}

	public function writeUrl($string) {
		$this->_linksCount++;
		return $this->write($string);
	}

	public function getFilesize() {
		return filesize($this->_filename);
	}

	public function getLinksCount() {
		return $this->_linksCount;
	}
}
