<?php
class TranslateForm extends CFormModel {
	public $text;
	public $sourceLanguage = 'en';
	public $targetLanguage = 'ru';

	
	public function rules() {
		return array(
			array('text, sourceLanguage, targetLanguage', 'required'),
			array('sourceLanguage, targetLanguage', 'in', 'range' => array_merge(/*array(0), */array_keys($this->possibleLanguages()))),
			array('sourceLanguage', 'compare', 'compareAttribute' => 'targetLanguage', 'operator' => '!='),
			// array('source', 'type', 'type' => 'array'),
			// array('categories', 'multipleIn', 'range' => array_keys(VideoCategories =>  => getCategoriesForListBox())),
			// array('order', 'in', 'range' => array(YoutubeHelper =>  => RELEVANCE, YoutubeHelper =>  => PUBLISHED, YoutubeHelper =>  => VIEW_COUNT, YoutubeHelper =>  => RATING)),
			// array('order', 'default', 'value' => YoutubeHelper =>  => RELEVANCE),
			// array('query', 'filter', 'filter' => 'strtolower'),
			// array('query', 'filter', 'filter' => 'trim'),
		);
	}

	public function attributeLabels() {
		return array(
			'text' => 'Текст',
			'sourceLanguage' => 'Исходный язык',
			'targetLanguage' => 'Целевой язык',
		);
	}

	public function possibleLanguages() {
		return array(
			'en' => 'английский',
			'ru' => 'русский',
			'uk' => 'украинский',
			'de' => 'немецкий',
			'tr' => 'турецкий',
			'it' => 'итальянский',
			'pl' => 'польский',
			'cs' => 'чешский',
			'sr' => 'сербский',
			'es' => 'испанский',
			'be' => 'белорусский',
			'fr' => 'французский',
			'bg' => 'болгарский',
			'ro' => 'румынский',
		);
	}
}
