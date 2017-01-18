<?php
$this->pageTitle = CHtml::encode($feeds[$feed]).' '.mb_strtolower($time_selector->items[$time_selector->selectedItem]);
$this->menuButtons=array(
	'← В начало' => $this->createUrl('index'),
);
?>
<div class="content center"><? $this->widget('SelectorWidget', array('selector' => $time_selector)) ?></div>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider' => $dataProvider,
	'itemView'=>'_video',
	'template' => "{items}",
	'enablePagination' => false,
	'ajaxUpdate' => false,
	'viewData' => array('startIndex' => $startIndex),
)); 
$this->widget('CLinkPager',array('pages' => $pager));
