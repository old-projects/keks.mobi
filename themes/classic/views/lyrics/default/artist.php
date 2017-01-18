<?php
$this->pageTitle = 'Исполнители на '.CHtml::encode($phrase);
$this->menuButtons = array(
	'← В начало' => $this->createUrl('index'),
);
if (mb_strlen($phrase) > 1) {
	$parent_phrase = mb_substr($phrase, 0, mb_strlen($phrase) - 1);
	$this->menuButtons['← Перейти к исполнителям на "'.$parent_phrase.'"'] = $this->createUrl('artists', array('phrase' => $parent_phrase, 'language' => $language_selector->selectedItem));
}
?>

<?php if (!in_array(mb_substr($phrase, 0, 1), $russian_letters)): ?>
	<div class="content">Архив: <? $this->widget('SelectorWidget', array('selector' => $language_selector)) ?></div>
<?php endif; ?>
<?php if (!empty($clarifying_phrases)): ?>
	<div class="content center">
		<span class="bold">Уточнить запрос</span><br />
	<?php foreach($clarifying_phrases as $phrase => $phrase_artists_count): ?>
		<a href="<?=$this->createUrl('artists', array('phrase' => $phrase, 'language' => $language_selector->selectedItem))?>"><span class="button letter_box" title="Исполнителей: <?=$phrase_artists_count?>"><?= $phrase ?></span></a>
	<?php endforeach; ?>
	</div>
<?php endif; ?>
<div class="content center">Сортировка: <? $this->widget('SelectorWidget', array('selector' => $sorting_selector)) ?></div>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider' => $dataProvider,
	'itemView'=>'_artist',
	// 'template' => "{items}{pager}",
	'ajaxUpdate' => false,
	'viewData' => array('language' => $language_selector->selectedItem),
)); 
