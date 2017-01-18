<?php
class VideoSearch  {
	

	public $query;
	public $categories = array();
	public $order;

	public function rules() {
		return array(
			array('query', 'required'),
			array('categories', 'exist', 'className' => 'VideoCategories', 'attributeName' => 'id'),
			array('order', 'in', 'range' => array(self::RELEVANCE, self::PUBLISHED, self::VIEW_COUNT, self::RATING)),
		);
	}


}