<?php
$this->pageTitle = 'Все фотосессии';
$this->menuButtons = array(
	'← В начало' => $this->createUrl('index'),
);
?>
<div class="content center">Сортировка: <? $this->widget('SelectorWidget', array('selector' => $sorting_selector)) ?></div>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider' => $dataProvider,
	'itemView'=>'_set',
	'ajaxUpdate' => false,
)); 
