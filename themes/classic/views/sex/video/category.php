<?php
$this->pageTitle = CHtml::encode($category->name);
$this->menuButtons = array(
	'← В начало' => $this->createUrl('index'),
);
?>
<div class="content center">Сортировка: <? $this->widget('SelectorWidget', array('selector' => $sorting_selector)) ?></div>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider' => $dataProvider,
	'itemView'=>'_video',
	'template' => "{items}{pager}",
	'ajaxUpdate' => false,
)); 
