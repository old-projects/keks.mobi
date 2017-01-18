<?php
$this->pageTitle = 'Переводчик на keks.mobi';
$this->headerTitle = 'Переводчик';
// $this->headerTitle = 'Переводчик на <a href="'.$this->createAbsoluteUrl('/').'">keks.mobi</a>';
$this->headerHomeLink = true;
?>
<!-- <div class="tl"><div class="tl_right">Поиск трека</div></div> -->
<div class="content">
<?php $form = $this->beginWidget('CActiveForm', array('action' => $this->createUrl('index'), 'method' => 'get')); ?>

	<?php echo $form->errorSummary($model); ?>
	
	<div class="row">
	<?php echo $form->label($model, 'text'); ?>: <br />
	<?php echo $form->textarea($model, 'text'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'sourceLanguage'); ?>: <br />
		<?php echo $form->dropDownList($model, 'sourceLanguage', $model->possibleLanguages()); ?><br />
		<?php echo $form->error($model, 'sourceLanguage'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'targetLanguage'); ?>: <br />
		<?php echo $form->dropDownList($model, 'targetLanguage', $model->possibleLanguages()); ?><br />
		<?php echo $form->error($model, 'targetLanguage'); ?>
	</div>

	<div class="row submit">
	<?php echo CHtml::submitButton('Перевести'); ?>
	</div>
	 
	<?php $this->endWidget(); ?>
</div>
<!-- <div class="small">Перевод возможен только если исходный или целевой язык русский.</div> -->
<?php if (!empty($result_text)): ?>
	<div class="tl"><div class="tl_right">Результат</div></div>
	<?= CHtml::textarea('result_text', $result_text); ?>
<?php endif; ?>