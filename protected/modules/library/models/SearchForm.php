<?php
class SearchForm extends CFormModel {

	// public $artist;
	public $query;
	public $content = 'all';
	// public $category = 0;
	// public $order;

	
	public function rules() {
		return array(
			array('query', 'required'),
			array('content', 'in', 'range' => array('all', 'author', 'book')),
			// array('order', 'in', 'range' => array(YoutubeHelper::RELEVANCE, YoutubeHelper::PUBLISHED, YoutubeHelper::VIEW_COUNT, YoutubeHelper::RATING)),
			// array('order', 'default', 'value' => YoutubeHelper::RELEVANCE),
			// array('query', 'filter', 'filter' => 'strtolower'),
			// array('query', 'filter', 'filter' => 'trim'),
		);
	}

	public function attributeLabels() {
		return array(
			// 'artist' => 'Исполнитель',
			'query' => 'Запрос',
			'content' => 'Что ищем',
			// 'order' => 'Сортировка',
		);
	}

	public function attributeDescriptions()
	{
		return array(
			'query' => 'Укажите либо автора, либо название книги.',
		);
	}
}
