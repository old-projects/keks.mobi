<?php
class ConsoleCommand extends CConsoleCommand {
	public function init() {
		Yii::setPathOfAlias('webroot', dirname(dirname(dirname(__FILE__))));
		Yii::setPathOfAlias('application', dirname(dirname(__FILE__)));
		mb_internal_encoding('utf-8');
		ignore_user_abort(true);
		set_time_limit(0);
	}

	/**
	 * Закончить выполнение скрипта выводом ошибки
	 * @param string $message Сообщение ошибки
	 * @params Переменные для вывода через var_dump
	 */
	public function terminate($message) {
		echo '[error] '.$message.PHP_EOL;
		$args = func_get_args();
		array_shift($args);
		if (!empty($args))
			call_user_func_array('var_dump', $args);
		Yii::app()->end();
	}

	/**
	 * Получить страницу по url.
	 * При получении пустого результата выполнит запрос ещё раз.
	 */
	public function getUrlContents($url) {
		// echo '[debug] retrieving url: '.$url.PHP_EOL;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$result = curl_exec($ch);
		if ($result === false) {
			$error = curl_error($ch);
			$errno = curl_errno($ch);
			if ($errno == CURLE_GOT_NOTHING)
				return $this->getUrlContents($url);
			else
				throw new RuntimeException('Curl error ('.$errno.') "'.$error.'"');
		}
		curl_close($ch);
		return $result;
	}

	public function convertToCp($string) {
		return mb_convert_encoding($string, 'cp1251', 'utf-8');
	}

	public function convertToUnicode($string) {
		return mb_convert_encoding($string, 'utf-8', 'cp1251');
	}
}