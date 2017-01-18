<?php
class Selector extends CComponent {
	/**
	 * An array
	 */
	public $items;
	/**
	 * A get parameter that contains selected item
	 */
	public $param = 'sort';
	/**
	 * If null, will be used the first item from items
	 */
	public $defaultItem;

	private $_selectedItem;

	/**
	 * Constructor
	 * @param array $items An array of items
	 * @param string $param A get parameter
	 */
	public function __construct($items = array(), $param = null) {
		$this->items = $items;
		if ($param !== null)
			$this->param = $param;
	}

	/**
	 * Get selected item.
	 */
	public function getSelectedItem() {
		if ($this->_selectedItem !== null)
			return $this->_selectedItem;


		if ($this->defaultItem !== null) {
			$this->_selectedItem = $this->defaultItem;
		} else {
			$keys = array_keys($this->items);
			$this->_selectedItem = array_shift($keys);
		}

		if (isset($_GET[$this->param]) && is_string($_GET[$this->param]) && isset($this->items[$_GET[$this->param]]))
			$this->_selectedItem = $_GET[$this->param];
		return $this->_selectedItem;
	}

	/**
	 * Makes link with selected item
	 */
	public function makeLink($item) {
		return array(Yii::app()->controller->route, array_merge($_GET, array($this->param => $item)));
	}
}