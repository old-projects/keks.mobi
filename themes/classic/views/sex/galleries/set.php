<?php
$this->pageTitle = 'Фотосессия: '.CHtml::encode($set->title);
$this->headerTitle = 'Эро-галерея';
$this->menuButtons=array(
	'← В начало' => $this->createUrl('index'),
);

?>
<?php if ($random_set !== false): ?>
<a href="<?=$this->createUrl('set', array('id' => $random_set->id))?>">
	<div class="content">
		<img src="<?=Yii::app()->theme->baseUrl?>/images/next.png" class="tp"/>
		Случайная фотосессия
	</div>
</a>
<?php endif; ?>

<div class="content center bold">
		<?= CHtml::encode($set->title) ?>
</div>
<div class="content">
	<?php if (count($set->models) > 0): ?>
		<span class="bold"><?= count($set->models) > 1 ? 'Модели' : 'Модель' ?>:</span>
		<?php foreach ($set->models as $i => $model): ?>
			<?php if ($i > 0): ?>
				-
			<?php endif; ?>
			<a href="<?= $this->createUrl('model', array('id' => $model->id)) ?>"><?= $model->name ?></a>
		<?php endforeach; ?>
		<br />
	<?php endif; ?>
	<?php if (count($set->tags) > 0): ?>
		<span class="bold"><?= count($set->tags) > 1 ? 'Теги' : 'Тег' ?>:</span>
		<?php foreach ($set->tags as $i => $tag): ?>
			<?php if ($i > 0): ?>
				-
			<?php endif; ?>
			<a href="<?= $this->createUrl('tag', array('name' => $tag->coedcherry_name)) ?>"><?= $tag->coedcherry_name ?></a>
		<?php endforeach; ?>
	<?php endif; ?>
</div>
<div class="content center">
	<?php foreach ($set->images as $image): ?>
		<a href="<?=$this->createUrl('image', array('id' => $image->id))?>">
			<img src="<?=$this->createUrl('thumbnail', array('id' => $image->id))?>"/><!-- <br /> -->
			<!-- <span class="small additional">(скачать)</span><br /> -->
		</a>
	<?php endforeach; ?>
</div>

<?php if ($random_set !== false): ?>
<a href="<?=$this->createUrl('set', array('id' => $random_set->id))?>">
	<div class="content">
		<img src="<?=Yii::app()->theme->baseUrl?>/images/next.png" class="tp"/>
		Случайная фотосессия
	</div>
</a>
<?php endif; ?>
