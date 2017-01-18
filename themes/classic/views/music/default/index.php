<?php
$this->pageTitle = 'Музыка на keks.mobi';
$this->headerTitle = 'Музыка';
// $this->headerTitle = 'Музыка на <span class="small">keks</span>';
$this->headerHomeLink = true;
?>
<div class="tl"><div class="tl_right">Категории</div></div>
<?php foreach ($categories as $category): ?>
	<a href="<?=$this->createUrl('category', array('category_id' => $category->id))?>">
		<div class="content">
			&#10704; <?=$category->name?>
		</div>
	</a>
<?php endforeach; ?>
<div class="tl"><div class="tl_right">Поиск исполнителя</div></div>
<div class="content center">
	<?php foreach(array_merge($russian_letters, range('A', 'Z'), range(0, 9)) as $artist_letter): ?>
		<?php if (in_array($artist_letter, array('A', 0), true)): ?> <br /> <?php endif; ?>
		<a href="<?=$this->createUrl('artist', array('letter' => $artist_letter))?>"><span class="button letter_box"><?= $artist_letter ?></span></a>
	<?php endforeach; ?>
</div>
<div class="tl"><div class="tl_right">Поиск трека</div></div>
<div class="content">
<?php $form = $this->beginWidget('CActiveForm', array('action' => $this->createUrl('search'), 'method' => 'get')); ?>

	<?php /*echo $form->errorSummary($model);*/ ?>
	
	<div class="row">
	<?php echo $form->label($model, 'title'); ?>: <br />
	<?php echo $form->textField($model, 'title'); ?>
	</div>

	<div class="row submit">
	<?php echo CHtml::submitButton('Найти'); ?>
	</div>
	 
	<?php $this->endWidget(); ?>
<a href="<?=$this->createUrl('search', array('advanced' => true))?>">&#9656; Расширенный поиск</a>
</div>
<div class="tl"><div class="tl_right">Статистка</div></div>
<div class="content">
	Всего треков: <span class="bold"><?= Yii::app()->numberFormatter->formatDecimal($total_tracks) ?></span><br />
	Всего данных: <span class="bold"><?= $this->widget('application.components.FilesizeWidget', array('size' => $total_tracks_size)) ?></span><br />
	<?php /*<span class="small">Статистика обновляется каждые десять минут.</span><br />*/ ?>
	<?php if ($queue_tasks_count > 0): ?>
		Сейчас заданий в очереди: <span class="bold"><?= $queue_tasks_count ?></span>
	<?php else: ?>
		Очередь заданий пуста.
	<?php endif; ?>
</div>
<?php if ($queue_tasks_count > 0): ?>
	<div class="tl"><div class="tl_right">Текущие задания очереди</div></div>
		<?php foreach ($queue_tasks as $i => $task): ?>
			<?= $this->renderPartial('_task', array('index' => $i, 'data' => $task)); ?>
		<?php endforeach; ?>
<?php endif; ?>