<?php
class WebModule extends CWebModule implements SitemapFiller {
	public function getSitemapId() {
		return $this->name;
	}

	public function fillSitemap(SitemapGenerator $generator) {
		throw new RuntimeException('WebModule must implement method "'.__METHOD__.'".');
	}

}
