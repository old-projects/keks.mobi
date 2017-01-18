<?php
$this->pageTitle = $this->headerTitle = 'Похожие на '.CHtml::encode($video->title);
$this->menuButtons=array(
	'← В начало' => $this->createUrl('default/index'),
	'← Вернуться к видео "'.CHtml::encode($video->title).'"' => $this->createUrl('index', array('id' => $video->id)),
);
?>
<?php if (count($related_videos) == 0): ?>
	<div class="content">Связанных видео не обнаружено!</div>
<?php endif; ?>
<?php foreach ($related_videos as $i => $related_video): ?>
		<?php $this->renderPartial('/default/_video', array('index' => $i, 'data' => $related_video, 'startIndex' => 0)); ?>
<?php endforeach; ?>