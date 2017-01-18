<?php
class DbDumpCommand extends CConsoleCommand {
	public function run($args) {
		Yii::import('ext.yii-database-dumper.SDatabaseDumper');
		$dumper = new SDatabaseDumper;
		
		// Get path to new backup file
		$file = dirname(dirname(__FILE__)).'/backups/dump.sql';
		
		// Gzip dump
		if(function_exists('gzencode') && false)
			file_put_contents($file.'.gz', gzencode($dumper->getDump()));
		else
			file_put_contents($file, $dumper->getDump());
	}
}