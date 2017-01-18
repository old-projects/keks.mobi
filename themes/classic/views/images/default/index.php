<?php
$this->pageTitle = 'Приколы на keks.mobi';
$this->headerTitle = 'Приколы';
// $this->headerTitle = 'Приколы на <a href="'.$this->createAbsoluteUrl('/').'">keks.mobi</a>';
$this->headerHomeLink = true;
?>
<a href="<?=$this->createUrl('rand')?>">
	<div class="content">
		<img src="<?=Yii::app()->theme->baseUrl?>/images/next.png" class="tp"/>
		Случайная картинка
	</div>
</a>
<div class="content center">
	<?php if (count($random_sets) > 0): ?>
		<?php foreach ($random_sets as $set): ?>
			<a href="<?=$this->createUrl('set', array('id' => $set->id))?>">
				<img src="<?=Yii::app()->baseUrl?>/screenshots/64<?=PoltavaImages::calculateImageFilename($set->mainImage->id, 'jpg')?>"/>
			</a>
		<?php endforeach; ?>
	<?php else: ?>
	<span class="bold">Сетов нет</span>
	<?php endif; ?>
</div>
<a href="<?=$this->createUrl('list')?>">
	<div class="content">
		В виде списка
	</div>
</a>
	<?php
	/*<a href="<?= $this->createUrl('feed', array('type' => 'most_viewed')) ?>">&#9656; Самые просматриваемые</a><br />
	<a href="<?= $this->createUrl('feed', array('type' => 'top_rated')) ?>">&#9656; Высоко оцененные</a><br />
	<a href="<?= $this->createUrl('feed', array('type' => 'recently_featured')) ?>">&#9656; Недавно размещённые</a><br />
	<a href="<?= $this->createUrl('feed', array('type' => 'watch_on_mobile')) ?>">&#9656; Для просмотра на телефоне</a><br />
	<a href="<?= $this->createUrl('feed', array('type' => 'most_discussed')) ?>">&#9656; Самые обсуждаемые</a><br />
	<a href="<?= $this->createUrl('feed', array('type' => 'top_favorites')) ?>">&#9656; Самые отмечаемые</a><br />
	<a href="<?= $this->createUrl('feed', array('type' => 'most_responded')) ?>">&#9656; Вызвавшие бурную реакцию</a><br />
	<a href="<?= $this->createUrl('feed', array('type' => 'most_recent')) ?>">&#9656; Самые последние</a><br />*/
/*
	?>
<div class="tl"><div class="tl_right">Категории</div></div>
<?php foreach ($categories as $category): ?>
	<a href="<?=$this->createUrl('list', array('category_id' => $category->id))?>">
		<div class="content">
			&#10704; <?=$category->name?> (<?= $category->countVideos ?>)
		</div>
	</a>
<?php endforeach; ?>
<?php
<div class="tl"><div class="tl_right">Поиск</div></div>
<div class="content">
<?php $form = $this->beginWidget('CActiveForm', array('action' => $this->createUrl('search'), 'method' => 'get')); ?>
	
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
*/
?>
<div class="tl"><div class="tl_right">Статистка</div></div>
<div class="content">
	Всего картинок: <span class="bold"><?= Yii::app()->numberFormatter->formatDecimal($total_images) ?></span><br />
	Всего данных: <span class="bold"><?= $this->widget('application.components.FilesizeWidget', array('size' => $total_images_size)) ?></span><br />
</div>