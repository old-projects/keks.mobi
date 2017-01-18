<a href="<?=$this->createUrl('model', array('id' => $data->id))?>">
	<div class="content">
		 <span class="small"><?=(($widget->dataProvider->pagination->currentPage * $widget->dataProvider->pagination->pageSize) + $index + 1)?>.</span> <?=CHtml::encode($data->name)?>
	</div>
</a>
