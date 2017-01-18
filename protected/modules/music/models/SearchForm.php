<?php
class SearchForm extends CFormModel {

	public $artist;
	public $title;
	public $category = 0;
	public $order;

	
	public function rules() {
		return array(
			array('title, artist', 'default', 'value' => null),
			// array('category', 'type', 'type' => 'array'),
			array('category', 'in', 'range' => array_merge(array(0), array_keys(PrimeMusicCategories::getCategoriesForListBox()))),
			// array('order', 'in', 'range' => array(YoutubeHelper::RELEVANCE, YoutubeHelper::PUBLISHED, YoutubeHelper::VIEW_COUNT, YoutubeHelper::RATING)),
			// array('order', 'default', 'value' => YoutubeHelper::RELEVANCE),
			// array('query', 'filter', 'filter' => 'strtolower'),
			// array('query', 'filter', 'filter' => 'trim'),
		);
	}

	public function attributeLabels() {
		return array(
			'artist' => 'Исполнитель',
			'title' => 'Трек',
			'category' => 'Категория',
			// 'order' => 'Сортировка',
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