<?php
class SearchForm extends CFormModel {
	public $query;
	public $categories = array();
	public $order;

	
	public function rules() {
		return array(
			array('query', 'required'),
			array('categories', 'type', 'type' => 'array'),
			array('categories', 'multipleIn', 'range' => array_keys(VideoCategories::getCategoriesForListBox())),
			array('order', 'in', 'range' => array(YoutubeHelper::RELEVANCE, YoutubeHelper::PUBLISHED, YoutubeHelper::VIEW_COUNT, YoutubeHelper::RATING)),
			array('order', 'default', 'value' => YoutubeHelper::RELEVANCE),
			array('query', 'filter', 'filter' => 'strtolower'),
			array('query', 'filter', 'filter' => 'trim'),
		);
	}

	public function attributeLabels() {
		return array(
			'query' => 'Запрос',
			'categories' => 'Категории',
			'order' => 'Сортировка',
		);
	}

	public function orderLabels() {
		return array(
			YoutubeHelper::RELEVANCE => 'По релевантности',
			YoutubeHelper::PUBLISHED => 'По дате',
			YoutubeHelper::VIEW_COUNT => 'По популярности',
			YoutubeHelper::RATING => 'По рейтингу',
		);
	}

	public function multipleIn($attribute, $params) {
		$diff = array_diff_key($this->$attribute, $params['range']);
		if (!empty($diff))
			$this->addError($attribute, 'Значание поля '.$attribute.' неверно!');
	}

}