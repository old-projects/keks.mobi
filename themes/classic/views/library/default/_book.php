<?php 
$authors = array();
foreach ($data->authors as $author) 
	$authors[] = $author->full_name;
?>
<a href="<?=$this->createUrl('book', array('id' => $data->id))?>">
	<div class="content">
		<img src="<?=Yii::app()->theme->baseUrl?>/images/track.24.png" class="tp"/> <span class="small"><?=(($widget->dataProvider->pagination->currentPage * $widget->dataProvider->pagination->pageSize) + $index + 1)?>.</span> <?=CHtml::encode(implode(' & ', $authors))?> - <?=CHtml::encode($data->title)?></span><br />
	</div>
</a>
