<?php
$this->pageTitle = 'Популярные песни';
$this->menuButtons = array(
	'← В начало' => $this->createUrl('index'),
);
?>
<div class="content">Архив: <? $this->widget('SelectorWidget', array('selector' => $language_selector)) ?></div>
<div class="content center">Сортировка: <? $this->widget('SelectorWidget', array('selector' => $sorting_selector)) ?></div>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider' => $dataProvider,
	'itemView'=>'_song',
	// 'template' => "{items}{pager}",
	'ajaxUpdate' => false,
	'viewData' => array('language' => $language_selector->selectedItem),
)); 
