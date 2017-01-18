<?php
return array(
	'basePath' => dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'import' => array(
		'ext.worker.*',
	),
	'components' => array(
		'worker' => array(
			'class'=>'WorkerDaemon',
			'servers'=>array('127.0.0.1', '4730'),
		),
		'router' => array(
			'class' => 'WorkerRouter',
			'routes' => array(
				'reverse' => 'application.controllers.gearman',
			),
		),
	),
);