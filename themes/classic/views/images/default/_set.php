<a href="<?=$this->createUrl('set', array('id' => $data->id))?>">
	<div class="content">
		<img src="<?=Yii::app()->baseUrl?>/screenshots/64/<?=PoltavaImages::calculateImageFilename($data->mainImage->id, 'jpg')?>" class="tp"/> <span class="small"><?=(($widget->dataProvider->pagination->currentPage * $widget->dataProvider->pagination->pageSize) + $index + 1)?>.</span> <?=CHtml::encode($data->title)?>
	</div>
</a>
