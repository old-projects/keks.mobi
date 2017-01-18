<?php
class SitemapGeneratorCommand extends ConsoleCommand {
	/**
	 * Информация о домене/папке для генерации абсолютных ссылок
	 */
	public $hostInfo = 'http://keks.mobi';
	public $baseUrl = '';

	public function actionIndex(array $modules) {
		Yii::app()->request->hostInfo = $this->hostInfo;
		Yii::app()->request->baseUrl = $this->baseUrl;

		$generator = Yii::app()->sitemapGenerator;
		echo 'Updating sitemap ...'.PHP_EOL;
		echo "\t".'Selected modules: '.implode(',', $modules).PHP_EOL;
		// подключаем модули
		foreach ($modules as $module) {
			$generator->addFiller(Yii::app()->getModule($module));
		}
		$sitemap_files = $generator->buildSitemap();

		echo 'Generated index: '.$generator->indexFilePath.' ('.round(filesize(Yii::getPathOfAlias('webroot').$generator->indexFilePath) / 1024, 2).' kb)'.PHP_EOL;
		echo 'Generated sitemaps('.count($sitemap_files).'):'.PHP_EOL;
		foreach ($sitemap_files as $sitemap_file) {
			echo "\t".$sitemap_file.' ('.round(filesize(Yii::getPathOfAlias('webroot').$sitemap_file) / 1024, 2).' kb)'.PHP_EOL;
		}
	}
}
