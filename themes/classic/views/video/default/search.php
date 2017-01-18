<?php
$this->pageTitle = (!empty($model->query) ? 'Поиск: '.CHtml::encode($model->query) : 'Поиск видео');
$this->menuButtons=array(
	'← В начало' => $this->createUrl('index'),
);
?>
<div class="tl"><div class="tl_right">Поиск</div></div>
<div class="content">
	<?php $form = $this->beginWidget('CActiveForm', array('method' => 'get', 'action' => $this->createUrl('search', array('advanced' => $model->scenario == 'advanced')))); ?>

	<?php /*echo $form->errorSummary($model);*/ ?>
	
	<div class="row">
	<?php echo $form->label($model, 'query'); ?>: <br />
	<?php echo $form->textField($model, 'query'); ?>
	<?php echo $form->error($model,'query'); ?>
	</div>

	<?php if ($model->scenario == 'advanced'): ?>
		<div class="row">
		<?php echo $form->label($model, 'categories'); ?>: <br />
		<span class="small">Если не выбрана ни одна из категорий, поиск будет произведён по всем категориям.</span><br />
		<?php echo $form->listBox($model, 'categories', $categories, array('multiple'=>true)); ?><br />
		<?php echo $form->error($model,'categories'); ?>
		</div>

		<div class="row">
		<?php echo $form->label($model, 'order'); ?>: <br />
		<?php echo $form->dropDownList($model, 'order', $model->orderLabels()); ?><br />
		<?php echo $form->error($model,'order'); ?>
		</div>
	<?php else: ?>
		<a href="<?=$this->createUrl('search', array('advanced' => true, 'SearchForm[query]' => $model->query))?>">&#9656; Расширенный поиск</a>
	<?php endif; ?>
	
	<div class="row submit">
	<?php echo CHtml::submitButton('Найти'); ?>
	</div>
	 
	<?php $this->endWidget(); ?>
</div>
<?php if ($allVideosCount > 0): ?>
<div class="tl"><div class="tl_right">Результаты (<?=$allVideosCount?> всего)</div></div>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider' => $dataProvider,
	'itemView'=>'_video',
	'template' => "{items}",
	'enablePagination' => false,
	'ajaxUpdate' => false,
	'viewData' => array('startIndex' => $startIndex),
));
$this->widget('CLinkPager',array('pages' => $pager)); ?>
<?php endif; ?>
