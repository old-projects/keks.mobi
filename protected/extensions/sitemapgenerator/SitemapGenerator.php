<?php
/**
 * Компонент обрабатывает все страницы каждого модуля
 */
class SitemapGenerator extends CApplicationComponent {

	/**
	 * Максимальный размер каждого sitemap-файла в байтах.
	 * Согласно sitemaps.org максимальный разме - 10 мб
	 */
	public $maxSitemapSize = 9437184; // 9 * 1024 * 1024

	/**
	 * Максимальные количество ссылок в каждом sitemap-файла.
	 * Согласно sitemaps.org максимальное количество - 10 000
	 */
	public $maxSitemapLinks = 9000;

	/**
	 * Путь до файла индекса. 
	 * Будет создан в webroot.
	 */
	public $indexFilePath = '/sitemap_index.xml';

	/**
	 * Путь до файла sitemap, в котором будет сохранена информация из каждного отдельного источника. 
	 * Будет создан в webroot.
	 * Путь проходит через функцию sprintf(), в которую передаются ещё id модуля(%s) и номер файла sitemap(%d).
	 */
	public $sitemapFileMask = '/sitemap.%s.%d.xml';

	/**
	 * Наполнители sitemap.xml
	 */
	protected $_fillers;

	/**
	 * Содержит список созданных sitemap-файлов
	 */
	protected $_sitemapFiles = array(); 

	/**
	 * Текущий наполнитель
	 * @var SitemapFiller
	 */
	protected $_currentFiller;

	/**
	 * Текущий sitemap-файл
	 * @var SitemapFile
	 */
	protected $_currentFile;

	/**
	 * Номер текущего sitemap-файла
	 * @var int
	 */
	protected $_currentFileNumber;

	/**
	 * 
	 */
	public function init() {
		parent::init();
		Yii::import('ext.sitemapgenerator.*');
	}

	/**
	 * Добавить наполнителя sitemap в список
	 */
	public function addFiller(SitemapFiller $filler) {
		$this->_fillers[$filler->sitemapId] = $filler;
	}

	/**
	 * Построить sitemap-файлы, индекс и сохранить
	 * @return array Список созданных файлов в webroot
	 */
	public function buildSitemap() {
		foreach ($this->_fillers as $filler_id => $filler) {
			$this->_currentFiller = $filler;
			$this->_currentFileNumber = 0;
			$filler->fillSitemap($this);
			$this->_currentFile->finish();
			$this->_currentFile = null;
		}
		// строим индекс
		$index_xml = '<?xml version="1.0" encoding="UTF-8"?>'
		.'<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'.PHP_EOL;
		foreach ($this->_sitemapFiles as $sitemap_file) {
			$index_xml .= '<sitemap><loc>'.Yii::app()->createAbsoluteUrl($sitemap_file).'</loc></sitemap>'.PHP_EOL;
		}
		$index_xml .= '</sitemapindex>';
		file_put_contents(Yii::getPathOfAlias('webroot').$this->indexFilePath, $index_xml);
		return $this->_sitemapFiles;
	}

	/**
	 * Добавляет ссылку в sitemap
	 * @param $filler SitemapFiller Наполнитель
	 * @param $route URL передаётся в функцию app()->createAbsoluteUrl()
	 * @param float $priority Приоритет от 0.1 до 1
	 */
	public function addUrl(SitemapFiller $filler, array $route, $priority = 0.5, $lastmod = null) {
		if ($this->_currentFiller != $filler)
			throw new RuntimeException('The current filler is not "'.$filler->id.'"');

		if ($this->_currentFile === null || $this->_currentFile->getFilesize() >= $this->maxSitemapSize || $this->_currentFile->getLinksCount() >= $this->maxSitemapLinks) {

			if ($this->_currentFile !== null) {
				$this->_currentFile->finish();
				$this->_currentFileNumber++;
			}
			// var_dump($this->_currentFileNumber);
			$sitemap_filename = $this->generateSitemapFilename($this->_currentFiller->id, $this->_currentFileNumber);
			$this->_currentFile = new SitemapFile(Yii::getPathOfAlias('webroot').$sitemap_filename);
			$this->_sitemapFiles[] = $sitemap_filename;
		}
		
		$xml = '<url><loc>'.call_user_func_array(array(Yii::app(), 'createAbsoluteUrl'), $route).'</loc><priority>'.$priority.'</priority></url>';
		$this->_currentFile->writeUrl($xml.PHP_EOL);

	}

	/**
	 * Возвращает путь до файла sitemap от webroot
	 */
	public function generateSitemapFilename($filler_id, $number) {
		return sprintf($this->sitemapFileMask, $filler_id, $number);
	}
}
