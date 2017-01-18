<?php
$this->pageTitle = 'Тексты песен на keks.mobi';
$this->headerTitle = 'Тексты песен';
// $this->headerTitle = 'Музыка на <span class="small">keks</span>';
$this->headerHomeLink = true;
?>
<div class="content">
	<a href="<?= $this->createUrl('top') ?>">&#9656; Последние просмотренные</a><br />
</div>
<div class="tl"><div class="tl_right">Выбор исполнителя по первой букве</div></div>
<div class="content center">
	<?php foreach(array_merge($russian_letters, range('A', 'Z'), range(0, 9)) as $artist_letter): ?>
		<?php if (in_array($artist_letter, array('A', 0), true)): ?> <br /> <?php endif; ?>
		<a href="<?=$this->createUrl('artists', array('phrase' => $artist_letter))?>"><span class="button letter_box"><?= $artist_letter ?></span></a>
	<?php endforeach; ?>
</div>
<div class="tl"><div class="tl_right">Поиск трека/исполнителя</div></div>
<div class="content">
<?php $form = $this->beginWidget('ActiveForm', array('action' => $this->createUrl('search'), 'method' => 'get')); ?>

	<?php /*echo $form->errorSummary($model);*/ ?>
	
	<div class="row">
	<?php echo $form->label($model, 'query'); ?>: <br />
	<?php echo $form->textField($model, 'query'); ?>
	<?php echo $form->description($model, 'query'); ?>
	</div>

	<div class="row">
	<?php echo $form->label($model, 'language'); ?>: <br />
	<?php echo $form->dropdownList($model, 'language', array('rus' => 'русскоязычный', 'eng' => 'англоязычный')); ?>
	<?php echo $form->description($model, 'language'); ?>
	</div>

	<div class="row submit">
	<?php echo CHtml::submitButton('Найти'); ?>
	</div>
	<div class="small"></div>
	 
	<?php $this->endWidget(); ?>
</div>
<div class="tl"><div class="tl_right">Статистка</div></div>
<div class="content">
	Всего русскоязычных исполнителей - <span class="bold"><?= Yii::app()->numberFormatter->formatDecimal($total_russian_artists) ?></span>, песен - <span class="bold"><?= Yii::app()->numberFormatter->formatDecimal($total_russian_songs) ?></span><br />
	Всего англоязычных исполнителей - <span class="bold"><?= Yii::app()->numberFormatter->formatDecimal($total_english_artists) ?></span>, песен - <span class="bold"><?= Yii::app()->numberFormatter->formatDecimal($total_english_songs) ?></span><br />
</div>
