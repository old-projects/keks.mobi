<?php
$this->pageTitle = CHtml::encode($video->name);
$this->menuButtons=array(
	'← В начало' => $this->createUrl('index'),
	'← Перейти в категорию "'.CHtml::encode($video->category->name).'"' => $this->createUrl('list', array('category_id' => $video->category_id)),
);

?>
<div class="content">
	<div class="center"><a href="<?=$this->createUrl('video', array('id' => $video->id))?>"><img src="<?=$video->getThumbnailUrl()?>"/></a></div>
</div>
<div class="tl"><div class="tl_right">Скачать:</div></div>
<noindex>
<a href="<?=$this->createUrl('download', array('id' => $video->id))?>" rel="nofollow">
	<div class="content">
		<img src="<?=Yii::app()->theme->baseUrl?>/images/stawberry.png" class="tp"/> Скачать в формате 3gp (176x144)
		<span class="small"><?= $this->widget('application.components.FilesizeWidget', array('size' => $video->filesize)) ?></span>
	</div>
</a>
</noindex>
<div class="tl"><div class="tl_right">Похожие</div></div>
<div class="content center">
<?php foreach ($video->relatedVideos as $related_video): ?>
	<a href="<?= $this->createUrl('video', array('id' => $related_video->id)) ?>"><img src="<?= $related_video->getThumbnailUrl()?>"/></a>
<?php endforeach; ?>
</div>
