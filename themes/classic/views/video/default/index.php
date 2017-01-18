<?php
$this->pageTitle = 'Видео на keks.mobi';
$this->headerTitle = 'Видео';
// $this->headerTitle = 'Видео на <a href="'.$this->createAbsoluteUrl('/').'">keks.mobi</a>';
$this->headerHomeLink = true;
// $free_space = disk_free_space(Yii::getPathOfAlias('webroot'));
// $total_space = disk_total_space(Yii::getPathOfAlias('webroot'));
// $free_percent = $free_space / $total_space * 100;
// var_dump($free_space, $total_space, $free_percent);
?>
<!-- <div class="content center notice">Все видеофайлы мы получаем с удалённого сервера и кодируем на нашем сервере в выбранный вами формат. Прошу отнестись с терпением, если перекодировка займёт долгое время. У нас есть очередь, которая обрабатывается параллельно несколькими программами перекодировки. Текущие задания очереди можно увидеть <a href="#tasks_count">внизу</a> данной страницы. </div> -->
<div class="content">
	
	<?php foreach ($standard_feeds_labels as $feed=>$label): ?>
		<?php if ($feed == 'recently_featured') continue; ?>
		<a href="<?= $this->createUrl('feed', array('type' => $feed)) ?>">&#9656; <?= $label ?></a><br />
	<?php endforeach; ?>
		<a href="<?= $this->createUrl('top') ?>">&#9656; Последние скачанные</a><br />
	<?php
	/*<a href="<?= $this->createUrl('feed', array('type' => 'most_viewed')) ?>">&#9656; Самые просматриваемые</a><br />
	<a href="<?= $this->createUrl('feed', array('type' => 'top_rated')) ?>">&#9656; Высоко оцененные</a><br />
	<a href="<?= $this->createUrl('feed', array('type' => 'recently_featured')) ?>">&#9656; Недавно размещённые</a><br />
	<a href="<?= $this->createUrl('feed', array('type' => 'watch_on_mobile')) ?>">&#9656; Для просмотра на телефоне</a><br />
	<a href="<?= $this->createUrl('feed', array('type' => 'most_discussed')) ?>">&#9656; Самые обсуждаемые</a><br />
	<a href="<?= $this->createUrl('feed', array('type' => 'top_favorites')) ?>">&#9656; Самые отмечаемые</a><br />
	<a href="<?= $this->createUrl('feed', array('type' => 'most_responded')) ?>">&#9656; Вызвавшие бурную реакцию</a><br />
	<a href="<?= $this->createUrl('feed', array('type' => 'most_recent')) ?>">&#9656; Самые последние</a><br />*/
	?>
</div>
<div class="tl"><div class="tl_right">Категории</div></div>
<?php foreach ($categories as $category): ?>
	<a href="<?=$this->createUrl('list', array('category_id' => $category->id))?>">
		<div class="content">
			&#10704; <?=$category->name?>
		</div>
	</a>
<?php endforeach; ?>
<div class="tl"><div class="tl_right">Поиск</div></div>
<div class="content">
<?php $form = $this->beginWidget('CActiveForm', array('action' => $this->createUrl('search'), 'method' => 'get')); ?>

	<?php /*echo $form->errorSummary($model);*/ ?>
	
	<div class="row">
	<?php echo $form->label($model, 'query'); ?>: <br />
	<?php echo $form->textField($model, 'query'); ?>
	</div>

	<div class="row submit">
	<?php echo CHtml::submitButton('Найти'); ?>
	</div>
	 
	<?php $this->endWidget(); ?>
<a href="<?=$this->createUrl('search', array('advanced' => true))?>">&#9656; Расширенный поиск</a>
</div>
<div class="tl"><div class="tl_right">Статистка</div></div>
<div class="content">
	Всего видео: <span class="bold"><?= Yii::app()->numberFormatter->formatDecimal($total_videos) ?></span><br />
	<?php /* Всего данных: <span class="bold"><?= $this->widget('application.components.FilesizeWidget', array('size' => $total_video_size)) ?></span><br /> */ ?>
	<span class="small">Статистика обновляется каждые десять минут.</span><br />
	<?php /*
	<?php if ($queue_tasks_count > 0): ?>
		Сейчас заданий в очереди: <span class="bold" id="tasks_count"><?= $queue_tasks_count ?></span>
	<?php else: ?>
		<span id="tasks_count">Очередь заданий пуста.</span>
	<?php endif; ?>
	*/ ?>
</div>
<?php /*
<?php if ($queue_tasks_count > 0): ?>
	<div class="tl"><div class="tl_right">Текущие задания очереди</div></div>
		<?php foreach ($queue_tasks as $i => $task): ?>
			<?= $this->renderPartial('_task', array('index' => $i, 'data' => $task)); ?>
		<?php endforeach; ?>
<?php endif; ?>
*/ ?>