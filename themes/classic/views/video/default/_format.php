<?php /*<a href="<?=$this->createUrl('/video/video/index', array('id' => $data->video->id))?>">
	<div class="content">
		<?php if ($data->video->youtubeEntry !== false): ?>
			<img src="<?=$data->video->youtubeEntry->getThumbnailUrl(90)?>" width="54" height="40" class="tp"/> 
		<?php endif; ?>
		<span class="small"><?=(($widget->dataProvider->pagination->currentPage * $widget->dataProvider->pagination->pageSize) + $index + 1)?>.</span> <?=CHtml::encode($data->video->title)?> (<?= $data->video->duration > 3600 ? floor($data->video->duration / 3600).':'.date('i:s', $data->video->duration) : date('i:s', $data->video->duration) ?>)
		<span class="small">Качество: <span class="bold"><?= $data->format == VideosFormats::AUDIO ? 'аудио' : 'видео ('.$data->format.'p)' ?></span>, Скачиваний: <span class="bold"><?= $data->downloads_count ?></span>, Последнее: <span class="bold"><?= Yii::app()->dateFormatter->formatDateTime($data->download_last_time) ?></span></span>
	<br />
		<!-- <span class="small">
			<?php if (mb_strlen($data->video->description) > 100): ?>
				<?=CHtml::encode(mb_substr($data->video->description, 0, 100))?> ...
			<?php else: ?>
				<?=CHtml::encode($data->video->description)?>
			<?php endif; ?>
		</span> -->
	<!-- </div>
	<div class="content"> -->
		
	</div>
</a>
*/ ?>
<?php /*var_dump($data)*/ ?>

<a href="<?=$this->createUrl('/video/video/index', array('id' => $data->video->id))?>">
	<div class="content">
		<?php if ($data->video->youtubeEntry !== false): ?>
			<img src="<?=$data->video->youtubeEntry->getThumbnailUrl(90)?>" width="54" height="40" class="tp"/> 
		<?php endif; ?>
		<span class="small"><?=(($widget->dataProvider->pagination->currentPage * $widget->dataProvider->pagination->pageSize) + $index + 1)?>.</span> <?=CHtml::encode($data->video->title)?> (<?= $data->video->duration > 3600 ? floor($data->video->duration / 3600).':'.date('i:s', $data->video->duration) : date('i:s', $data->video->duration) ?>)
		<span class="small">Формат: <span class="bold"><?= $data->format ?></span>, Скачиваний: <span class="bold"><?= $data->downloads_count ?></span>, Последнее: <span class="bold"><?= Yii::app()->dateFormatter->formatDateTime($data->download_last_time) ?></span></span>
	<br />
		<!-- <span class="small">
			<?php if (mb_strlen($data->video->description) > 100): ?>
				<?=CHtml::encode(mb_substr($data->video->description, 0, 100))?> ...
			<?php else: ?>
				<?=CHtml::encode($data->video->description)?>
			<?php endif; ?>
		</span> -->
	<!-- </div>
	<div class="content"> -->
		
	</div>
</a>
<?php /*var_dump($data)*/ ?>
