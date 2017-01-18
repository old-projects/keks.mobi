<?php
$this->pageTitle = 'Обратная связь';
$this->menuButtons = array(
	'← В начало' => $this->createAbsoluteUrl('/'),
);
?>
<div class="content">

<?php $form=$this->beginWidget('ActiveForm', array(
	'id' => 'contact-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?><br />
		<?php echo $form->textField($model,'name'); ?><br />
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?><br />
		<?php echo $form->textField($model,'email'); ?><br />
		<?php echo $form->description($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'body'); ?><br />
		<?php echo $form->textArea($model,'body',array('rows'=>6, 'cols'=>30)); ?><br />
		<?php echo $form->error($model,'body'); ?>
	</div>

	<?php if(CCaptcha::checkRequirements()): ?>
	<div class="row">
		<?php echo $form->labelEx($model,'verifyCode'); ?>
		<div>
		<?php $this->widget('CCaptcha', array('showRefreshButton' => true, 'buttonLabel' => '<br />[Не вижу код!]')); ?><br />
		<?php echo $form->textField($model,'verifyCode'); ?>
		</div>
		<?php echo $form->description($model,'verifyCode'); ?>
	</div>
	<?php endif; ?>

	<div class="buttons">
		<?php echo CHtml::submitButton('Отправить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
