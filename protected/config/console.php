<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name' => 'Keks.Mobi',

	// preloading 'log' component
	'preload' => array('log'),

	'import' => array(
		'application.modules.video.models.*',
		'application.models.EncodingQueue',
		'application.components.ConsoleCommand',
		'application.components.WebModule',
		'ext.sitemapgenerator.SitemapFiller',
	),

	'modules' => array(
		'images',
		'video',
		'music',
		'lyrics',
	),

	// application components
	'components' => array(
		'db' => require dirname(__FILE__).'/database.php',
		'log' => array(
			'class' => 'CLogRouter',
			'routes' => array(
				array(
					'class' => 'CFileLogRoute',
					'levels' => 'error, warning',
				),
			),
		),
		'cache' => array(
			'class' => 'system.caching.CMemCache',
			'useMemcached' => true,
			'servers' => array(
				array('host' => 'localhost', 'port' => 11211),
			),
		),
		'downloadsManager' => array(
			'class' => 'application.components.DownloadsManager',
		),
		'encoder' => array(
			'class' => 'application.components.Encoder',
		),
		'filesystem' => array(
			'class' => 'application.components.FileSystem',
		),
		'sitemapGenerator' => array(
			'class' => 'ext.sitemapgenerator.SitemapGenerator',
		),
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName' => false,
			'caseSensitive' => true,
		),
		// 'request' => array(
		// 	'hostInfo' => 'http://keks.mobi',
		// 	'baseUrl' => '',
		// ),
	),

	'params' => require dirname(__FILE__).'/params.php',
);