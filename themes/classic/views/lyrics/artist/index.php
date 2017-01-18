<?php
$this->pageTitle = 'Исполнитель '.CHtml::encode($artist->name);
$this->menuButtons=array(
	'← В начало' => $this->createUrl('default/index'),
);
?>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider' => $dataProvider,
	'itemView' => '/default/_song',
	// 'template' => "{items}",
	'ajaxUpdate' => false,
	'viewData' => array('language' => $language),
));
?>