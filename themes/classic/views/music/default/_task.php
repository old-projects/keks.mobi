
<a href="<?=$this->createUrl('track/index', array('id' => $data->relatedTrack->id))?>">
	<div class="content">
		<img src="<?=Yii::app()->theme->baseUrl?>/images/<?=($data->phase > 1 ? 'processing' : 'awaiting')?>.png" class="tp"/>
		<span class="bold"><?= $data->relatedTrack->title ?></span>
		<?php if ($data->phase > 1): ?>(<?= $data->phase - 1 ?>/4<?= ($data->progress > -1 ? ' на '.$data->progress.'%' : null) ?>)<?php endif; ?>
		<span class="small">в очереди с <?= Yii::app()->dateFormatter->formatDateTime($data->date); ?></span>
	</div>
</a>
