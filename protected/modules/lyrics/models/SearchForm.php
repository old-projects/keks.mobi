<?php
class SearchForm extends CFormModel {

	// public $artist;
	public $query;
	public $language;
	public $content = 'all';
	// public $category = 0;
	// public $order;

	
	public function rules() {
		return array(
			array('query', 'required'),
			array('language', 'in', 'range' => array('eng', 'rus')),
			array('content', 'in', 'range' => array('all', 'artist', 'song')),
			// array('order', 'in', 'range' => array(YoutubeHelper::RELEVANCE, YoutubeHelper::PUBLISHED, YoutubeHelper::VIEW_COUNT, YoutubeHelper::RATING)),
			// array('order', 'default', 'value' => YoutubeHelper::RELEVANCE),
			// array('query', 'filter', 'filter' => 'strtolower'),
			// array('query', 'filter', 'filter' => 'trim'),
			array('language', 'default', 'value' => 'eng'),
		);
	}

	public function attributeLabels() {
		return array(
			// 'artist' => 'Исполнитель',
			'query' => 'Запрос',
			'language' => 'Архив',
			'content' => 'Что ищем',
			// 'order' => 'Сортировка',
		);
	}

	public function attributeDescriptions()
	{
		return array(
			'query' => 'Укажите либо название песни, либо имя исполнителя.',
			'language' => 'В русскоязычном архиве есть также некоторое количество англоязычных песен с переводом.',
		);
	}

	// public function beforeValidate() {
	// 	if (parent::beforeValidate()) {

	// 		$attributes = array('title', 'artist');
	// 		$labels = array();
	// 		foreach ($attributes as $attribute) {
	// 			$attribute = trim($attribute);
	// 			var_dump($this->$attribute);
	// 			if (!empty($this->$attribute)) {
	// 				return true;
	// 			}
	// 			$labels[] = $this->getAttributeLabel($attribute);
	// 		}

	// 		$this->addError($attributes[0], 'Хотя бы одно из полей '.implode(', ', $labels).' должно быть заполнено!');
	// 		return false;
	// 	} else
	// 		return false;
	// }

}