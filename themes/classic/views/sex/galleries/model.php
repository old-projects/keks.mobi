<?php
$this->pageTitle = 'Фотосессии модели '.CHtml::encode($model->name);
$this->menuButtons = array(
	'← В начало' => $this->createUrl('index'),
);
?>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider' => $dataProvider,
	'itemView'=>'_set',
	'ajaxUpdate' => false,
)); 
