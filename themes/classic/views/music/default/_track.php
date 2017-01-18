<a href="<?=$this->createUrl('/music/track/index', array('id' => $data->id))?>">
	<div class="content">
		<img src="<?=Yii::app()->theme->baseUrl?>/images/track.24.png" class="tp"/> <span class="small"><?=(($widget->dataProvider->pagination->currentPage * $widget->dataProvider->pagination->pageSize) + $index + 1)?>.</span> <?=CHtml::encode($data->artist)?> - <?=CHtml::encode($data->title)?> (<?= $data->duration > 3600 ? floor($data->duration / 3600).':'.date('i:s', $data->duration) : date('i:s', $data->duration) ?>) <span class="small"><?= $this->widget('application.components.FilesizeWidget', array('size' => $data->filesize)) ?></span><br />
	</div>
</a>
