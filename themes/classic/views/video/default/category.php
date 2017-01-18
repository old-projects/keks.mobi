<?php
$this->pageTitle = CHtml::encode($category->name).'. '.$feed_selector->items[$feed_selector->selectedItem];
$this->headerTitle = $feed_selector->items[$feed_selector->selectedItem].' '.mb_strtolower($time_selector->items[$time_selector->selectedItem]).' в категории '.CHtml::encode($category->name);
$this->menuButtons=array(
	'← В начало' => $this->createUrl('index'),
);
?>
<div class="content center"><? $this->widget('SelectorWidget', array('selector' => $feed_selector)) ?></div>
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
