<?php
class HttpHelper {
	/**
	 * Получить страницу по url.
	 * При получении пустого результата выполнит запрос ещё раз.
	 */
	static public function getUrlContents($url, array $config = array()) {
		// echo '[debug] retrieving url: '.$url.PHP_EOL;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		curl_setopt_array($ch, $config);

		$result = curl_exec($ch);
		if ($result === false) {
			$error = curl_error($ch);
			$errno = curl_errno($ch);
			if ($errno == CURLE_GOT_NOTHING)
				return static::getUrlContents($url);
			else
				throw new RuntimeException('Curl error ('.$errno.') "'.$error.'"');
		}
		curl_close($ch);
		return $result;
	}

	/**
	 * Послать POST-запрос
	 * @param string $url URL страницы-обработчика запроса
	 * @param array $data Массив полей запроса (param=>value, foo=>bar, ...)
	 * @param array $config Массив настроек CURL
	 * @return string Результат curl_exec()
	 */
	static public function performPostRequest($url, array $data = array(), array $config = array()) {
		// echo '[debug] performing post request: '.$url.PHP_EOL;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

		curl_setopt_array($ch, $config);

		$result = curl_exec($ch);
		if ($result === false) {
			$error = curl_error($ch);
			$errno = curl_errno($ch);
			throw new RuntimeException('Curl error ('.$errno.') "'.$error.'"');
			// if ($errno == CURLE_GOT_NOTHING)
			// 	return static::getUrlContents($url);
			// else
			// 	throw new RuntimeException('Curl error ('.$errno.') "'.$error.'"');
		}
		curl_close($ch);
		return $result;
	}
}
