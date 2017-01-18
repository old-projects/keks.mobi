<?php
$this->pageTitle = CHtml::encode($track->artist).' - '.CHtml::encode($track->title);
$this->menuButtons=array(
	'← В начало' => $this->createUrl('default/index'),
	'← Перейти в категорию "'.CHtml::encode($track->category->name).'"' => $this->createUrl('default/category', array('category_id' => $track->category_id)),
);

// $labels = array(
// 	VideosFormats::MOBILE_144 => 'В формате 3gp (176x144)',
// 	VideosFormats::MP4_240 => 'В формате mp4 (320x240)',
// 	VideosFormats::MP4_360 => 'В формате mp4 (640x360)',
// 	VideosFormats::AUDIO => 'Скачать аудиодорожку (без видео)',
// );
?>
<div class="content">
	Исполнитель: <span class="bold"><?= CHtml::encode($track->artist) ?></span><br />
	Трек: <span class="bold"><?= CHtml::encode($track->title) ?></span><br />
	Длительность: <span class="bold"><?=$track->duration > 3600 
		? 	floor($track->duration / 3600).':'.date('i:s', $track->duration)
		: ((int)date('i', $track->duration).' мин. '.(int)date('s', $track->duration).' сек.')
	?></span><br />
</div>
<div class="tl"><div class="tl_right">Скачать:</div></div>
<noindex>
<a href="<?=$this->createUrl('download', array('id' => $track->id))?>" rel="nofollow">
	<div class="content">
		<img src="<?=Yii::app()->theme->baseUrl?>/images/track.16.png" class="tp"/> Скачать в формате mp3
		<span class="small">
			<?= $this->widget('application.components.FilesizeWidget', array('size' => $track->filesize)) ?>
			<?= $track->bitrate ?>кб/с
			<?php if ($task !== null): ?>
			<span class="bold">[подготовка, <?= $task->phase > EncodingQueue::PENDING ? 'шаг '.($task->phase - 1).' из 4'.($task->progress != -1 ? ' выполнен на '.$task->progress.'%' : null) : 'в очереди' ?>]</span><br />
			<?php endif; ?>
		</span>
	</div>
</a>
</noindex>
<a href="<?=$this->createUrl('/video/default/search', array('SearchForm[query]' => $track->artist.' - '.$track->title))?>">
	<div class="content">
		<img src="<?=Yii::app()->theme->baseUrl?>/images/video_track.16.png" class="tp"/> Найти видеоклип к треку
		<span class="small">(бывает не всегда)</span>
	</div>
</a>
