<a href="<?=$this->createUrl('set', array('id' => $data->id))?>">
	<div class="content">
		<img src="<?=$this->createUrl('thumbnail', array('id' => $data->mainImage->id, 'small' => true))?>" class="tp"/> <span class="small"><?=(($widget->dataProvider->pagination->currentPage * $widget->dataProvider->pagination->pageSize) + $index + 1)?>.</span> <?=CHtml::encode($data->title)?>
	</div>
</a>
