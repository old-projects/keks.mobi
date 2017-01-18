
<a href="<?=$this->createUrl('video/index', array('id' => $data->relatedVideo->id))?>">
	<div class="content">
		<img src="<?=Yii::app()->theme->baseUrl?>/images/<?=($data->phase > 1 ? 'processing' : 'awaiting')?>.png" class="tp"/>
		<span class="bold"><?= $data->relatedVideo->title ?></span>
		<?php if ($data->phase > 1): ?>(<?= $data->phase - 1 ?>/4<?= ($data->progress > -1 ? ' на '.$data->progress.'%' : null) ?>)<?php endif; ?>
		<span class="small"><?=($data->format == VideosFormats::AUDIO ? 'аудио' : 'видео '.$data->format.'p')?> в очереди с <?= Yii::app()->dateFormatter->formatDateTime($data->date); ?></span>
	</div>
</a>
