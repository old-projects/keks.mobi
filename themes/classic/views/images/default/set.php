<?php
$this->pageTitle = 'Приколы';
$this->menuButtons=array(
	'← В начало' => $this->createUrl('index'),
);

?>
<a href="<?=$this->createUrl('rand')?>">
	<div class="content">
		<img src="<?=Yii::app()->theme->baseUrl?>/images/next.png" class="tp"/>
		Далее
	</div>
</a>
<div class="content center bold">
		<?= CHtml::encode($set->title) ?>
	</div>
<div class="content center">
	<?php foreach ($set->images as $image): ?>
		<a href="<?=Yii::app()->baseUrl.Yii::app()->downloadsManager->linksDirectory.PoltavaImages::calculateImageFilename($image->id, 'jpg')?>">
			<img src="<?=Yii::app()->baseUrl?>/screenshots/176<?=PoltavaImages::calculateImageFilename($image->id, 'jpg')?>"/><br />
			<span class="small additional">(открыть, <?= $this->widget('application.components.FilesizeWidget', array('size' => $image->filesize))?>)</span><br />
		</a>
	<?php endforeach; ?>
</div>

<?php if (count($set->images) > 1): ?>
<a href="<?=$this->createUrl('rand')?>">
<div class="content">
	Далее
	<img src="<?=Yii::app()->theme->baseUrl?>/images/next.png" class="tp"/>
</div>
</a>
<?php endif; ?>
