<?php
interface SitemapFiller {
	public function fillSitemap(SitemapGenerator $generator);
	public function getSitemapId();
}
