<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
$config = array(
	'basePath' => dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name' => 'Keks.Mobi',
	'theme' => 'classic',
	'language' => 'ru',

	// preloading 'log' component
	'preload' => array('log'),

	// autoloading model and component classes
	'import' => array(
		'application.models.*',
		'application.components.*',
		'ext.sitemapgenerator.SitemapFiller',
		'ext.selectorwidget.*',
	),

	'modules'=>array(
		'video' => array(
			'videosPerPage' => 10,
			'markVideo' => true,
		),
		// 'music',
		'images',
		'library',
		'lyrics',
		// 'translate' => array(
		// 	'yandexApiKey' => 'trnsl.1.1.20130501T213535Z.58f5dd1aaaa7a58d.da857f47560ab6fe9f849accf5b77af89e9f64ef',
		// ),
		// uncomment the following to enable the Gii tool
		'gii' => array(
			'class' => 'system.gii.GiiModule',
			'password' => '123',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters' => array('127.0.0.1','::1'),
			'generatorPaths' => array(
				'application.gii',
			),
		),
	),

	// application components
	'components' => array(
		'youtubeHelper' => array(
			'class' => 'application.modules.video.components.YoutubeHelper',
			'cacheKey' => 'fileCache',
		),
		'onlineCounter' => array(
			'class' => 'application.components.OnlineCounter',
		),
		'externalVisitorsCounter' => array(
			'class' => 'application.components.ExternalVisitorsCounter',
		),
		'filesystem' => array(
			'class' => 'application.components.FileSystem',
		),
		'encoder' => array(
			'class' => 'application.components.Encoder',
			'maxRunningThreads' => 5,
		),
		'downloadsManager' => array(
			'class' => 'application.components.DownloadsManager',
		),
		'user' => array(
			'class' => 'application.components.WebUser',
			'allowAutoLogin' => true,
		),
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName' => false,
			'caseSensitive' => true,
			// 'rules'=>array(
			// 	'<controller:\w+>/<id:\d+>'=>'<controller>/view',
			// 	'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
			// 	'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			// ),
		),
		'db' => require dirname(__FILE__).'/database.php',
		'errorHandler' => array(
			// use 'site/error' action to display errors
			'errorAction' =>'site/error',
		),
		'log' => array(
			'class' => 'CLogRouter',
			'routes' => array(
				array(
					'class' => 'CFileLogRoute',
					'levels' => 'error, warning',
				),
				array(
					'class' => 'CProfileLogRoute',
					'filter' => 'CLogFilter',
				),
				array(
					'class' => 'CWebLogRoute',
					'levels' => 'error, warning, info, trace',
					'enabled' => YII_DEVELOPMENT,
				),
			),
		),
		'themeManager' => array(
			'themeClass' => 'application.components.Theme',
		),
		'cache' => array(
			// 'class' => 'CDummyCache',
			'class' => 'system.caching.CMemCache',
			'useMemcached' => true,
			'servers' => array(
				array('host' => '127.0.0.1', 'port' => 11211),
			),
		),
		'fileCache' => array(
			'class' => 'CDummyCache',
			'class' => 'system.caching.CFileCache',
		),
		'clientScript' => array(
			'scriptMap' => array(
				'jquery.js' => false,
				'jquery.ba-bbq.js' => false,
				'jquery.min.js' => false,
				'jquery.ba-bbq.min.js' => false,
				'jquery.yiiactiveform.js' => false,
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params' => require dirname(__FILE__).'/params.php',
);

// if (YII_DEBUG)
// 	$config['components']['cache'] = array('class' => 'CDummyCache');

return $config;
