<?php
class CacheCommand extends CConsoleCommand {
	public function actionDelete($args) {
		if (!isset($args[0]))
			throw new RuntimeException('Cache key is required!');

		if ((Yii::app()->cache->get($args[0])) !== false) {
			echo 'Deleting "'.$args[0].'" from cache'.PHP_EOL;
			Yii::app()->cache->delete($args[0]);
		}
	}
}