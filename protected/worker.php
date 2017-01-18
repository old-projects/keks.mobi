<?php

// change the following paths if necessary
$yii=dirname(__FILE__).'/../yii/framework/yii.php';
$config=dirname(__FILE__).'/config/worker.php';

require_once($yii);
require_once('extensions/worker/WorkerApplication.php');

Yii::createApplication('WorkerApplication', $config)->run();
