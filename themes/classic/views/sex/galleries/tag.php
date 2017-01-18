<?php
$this->pageTitle = 'Фотосессии по тегу '.CHtml::encode($tag->coedcherry_name);
$this->menuButtons = array(
	'← В начало' => $this->createUrl('index'),
);
?>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider' => $dataProvider,
	'itemView'=>'_set',
	'ajaxUpdate' => false,
)); 
