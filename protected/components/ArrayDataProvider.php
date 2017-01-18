<?php
class ArrayDataProvider extends CArrayDataProvider {
	protected function fetchData()
	{
		$itemCount = $this->getPagination()->getItemCount();
		$result = parent::fetchData();
		$this->getPagination()->setItemCount($itemCount);
		return $result;
	}
}