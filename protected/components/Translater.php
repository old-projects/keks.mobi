<?php
class Translater {
	/**
	 * Переводит текст с одного на другой язык с помощью яндекса.
	 * @param string/array $text Текст для перевода
	 * @param string $sourceLanguage Исходный язык. {Может быть false, тогда направление будут определено автоматически и записано в параметр.}
	 * @param string $targetLanguage Целевой язык.
	 * @param string $apiKey Ключ api
	 */
	static public function yandexTranslate($text, $sourceLanguage, $targetLanguage, $apiKey) {
		if (!is_array($text))
			$text = array($text);
		array_walk($text, function($text) {
			return urlencode($text);
		});
		$url = 'https://translate.yandex.net/api/v1.5/tr.json/translate?key='.$apiKey.'&lang='.($sourceLanguage !== false ? $sourceLanguage.'-' : null).$targetLanguage.'&text='.implode('&text=', $text);
		// +echo $url;
		// return false;
		$data = json_decode(file_get_contents($url), true);

		if ($data['code'] != 200)
			throw new RuntimeException('Invalid response code: '.$data['code']);
		// list($sourceLanguage) = explode('-', $data['lang']);
		if (count($data['text']) == 1)
			return $data['text'][0];
		else 
			return $data['text'];
	}
}
