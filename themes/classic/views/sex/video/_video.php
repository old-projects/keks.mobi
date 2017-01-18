<a href="<?=$this->createUrl('video', array('id' => $data->id))?>">
	<div class="content">
		<img src="<?=$data->getThumbnailUrl()?>" class="tp"/> <span class="small"><?=($data->id)?>.</span> <?=CHtml::encode($data->name)?>
	</div>
</a>
