<?php

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG', in_array($_SERVER['HTTP_HOST'], array('localhost', 'keks.local')) || isset($_GET['debug']));
$ip = explode('.', $_SERVER['REMOTE_ADDR']);
defined('YII_DEVELOPMENT') or define('YII_DEVELOPMENT', YII_DEBUG);//in_array(array_shift($ip), array('192', '168', '127', '10')));
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);

// change the following paths if necessary
$yii=dirname(__FILE__).'/yii/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

require_once($yii);
if (YII_DEBUG)
	Yii::beginProfile('All_page');
Yii::createWebApplication($config)->run();
if (YII_DEBUG)
	Yii::endProfile('All_page');
