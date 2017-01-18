<?php
$this->pageTitle = 'Библиотека на keks.mobi';
$this->headerTitle = 'Библиотека';
// $this->headerTitle = 'Музыка на <span class="small">keks</span>';
$this->headerHomeLink = true;
?>
<div class="content">
	<a href="<?= $this->createUrl('recentlyReaded') ?>">&#9656; Последние прочитанные</a><br />
</div>
<div class="tl"><div class="tl_right">Жанры</div></div>
<?php foreach ($genres as $genre): ?>
	<a href="<?=$this->createUrl('genre', array('id' => $genre->id))?>">
		<div class="content">
			&#10704; <?=$genre->name?>
		</div>
	</a>
<?php endforeach; ?>
<div class="tl"><div class="tl_right">Поиск автора/произведения</div></div>
<div class="content">
<?php $form = $this->beginWidget('ActiveForm', array('action' => $this->createUrl('search'), 'method' => 'get')); ?>

	<?php /*echo $form->errorSummary($model);*/ ?>
	
	<div class="row">
	<?php echo $form->label($model, 'query'); ?>: <br />
	<?php echo $form->textField($model, 'query'); ?>
	<?php echo $form->description($model, 'query'); ?>
	</div>

	<div class="row submit">
	<?php echo CHtml::submitButton('Найти'); ?>
	</div>
	<div class="small"></div>
	 
	<?php $this->endWidget(); ?>
</div>
<div class="tl"><div class="tl_right">Статистка</div></div>
<div class="content">
	Всего авторов - <span class="bold"><?= Yii::app()->numberFormatter->formatDecimal($total_authors) ?></span><br />
	Всего книг - <span class="bold"><?= Yii::app()->numberFormatter->formatDecimal($total_books) ?></span><br />
</div>
