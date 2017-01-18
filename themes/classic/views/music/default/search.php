<?php
$page_title = 'Поиск музыки';
if (!empty($model->title) || !empty($model->artist)) {
	$page_title = 'Поиск: ';
	if (!empty($model->artist))
		$page_title .= CHtml::encode($model->artist);
	if (!empty($model->title))
		$page_title .= (!empty($model->artist) ? ' - ' : null).CHtml::encode($model->title);
}

$this->pageTitle = $page_title;
$this->menuButtons=array(
	'← В начало' => $this->createUrl('index'),
);
?>
<div class="tl"><div class="tl_right">Поиск</div></div>
<div class="content">
	<?php $form = $this->beginWidget('CActiveForm', array('method' => 'get', 'action' => $this->createUrl('search', array('advanced' => $model->scenario == 'advanced')))); ?>

	<?php /*echo $form->errorSummary($model);*/ ?>
	
	<div class="row">
	<?php echo $form->label($model, 'artist'); ?>: <br />
	<?php echo $form->textField($model, 'artist'); ?>
	<?php echo $form->error($model,'artist'); ?>
	</div>

	<div class="row">
	<?php echo $form->label($model, 'title'); ?>: <br />
	<?php echo $form->textField($model, 'title'); ?>
	<?php echo $form->error($model,'title'); ?>
	</div>

	<?php if ($model->scenario == 'advanced'): ?>
		<div class="row">
		<?php echo $form->label($model, 'category'); ?>: <br />
		<span class="small">Если не выбрана ни одна из категорий, поиск будет произведён по всем категориям.</span><br />
		<?php echo $form->dropDownList($model, 'category', array_merge(array('0' => 'Все категории'), $categories)); ?><br />
		<?php echo $form->error($model,'category'); ?>
		</div>

	<?php else: ?>
		<a href="<?=$this->createUrl('search', array('advanced' => true, 'SearchForm[artist]' => $model->artist, 'SearchForm[title]' => $model->title))?>">&#9656; Расширенный поиск</a>
	<?php endif; ?>
	
	<div class="row submit">
	<?php echo CHtml::submitButton('Найти'); ?>
	</div>
	 
	<?php $this->endWidget(); ?>
</div>
<?php if (isset($dataProvider)): ?>
<div class="tl"><div class="tl_right">Результаты</div></div>
<div class="content center">Сортировка: <? $this->widget('SelectorWidget', array('selector' => $sorting_selector)) ?></div>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider' => $dataProvider,
	'itemView'=>'_track',
	// 'template' => "{items}",
	'ajaxUpdate' => false,
));
?>
<?php endif; ?>
