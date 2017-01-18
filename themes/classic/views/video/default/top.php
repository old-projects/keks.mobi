<?php
$this->pageTitle = 'Самые скачиваемые';
$this->menuButtons=array(
	'← В начало' => $this->createUrl('index'),
);
?>
<div class="content center"><? $this->widget('SelectorWidget', array('selector' => $sorting_selector)) ?></div>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider' => $dataProvider,
	'itemView'=>'_format',
	// 'template' => "{items}",
	// 'enablePagination' => false,
	'ajaxUpdate' => false,
	// 'viewData' => array('startIndex' => $startIndex),
)); 
?>
