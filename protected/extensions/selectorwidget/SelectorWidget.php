<?php
class SelectorWidget extends CWidget {
	public $_selector;

	public function run() {
		if ($this->_selector === null)
			throw new RuntimeException('No one Selector assigned!');

		$c = count($this->_selector->items);
		$i = 0;
		foreach ($this->_selector->items as $key => $label) {
			if ($this->_selector->selectedItem == $key)
				echo '<span class="bold">'.$label.'</span>';
			else
				echo '<a href="'.call_user_func_array(array($this->controller, 'createUrl'), $this->_selector->makeLink($key)).'">'.$label.'</a>';
			if (++$i < $c)
				echo ' | ';
		}
	}

	public function setSelector(Selector $selector) {
		$this->_selector = $selector;
	}

	public function getSelector() {
		return $this->_selector;
	}
}