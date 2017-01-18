<?php 
$artists = array();
foreach (isset($data->artists) ? $data->artists : array($data->artist) as $artist) 
	$artists[] = $artist->name;
?>
<a href="<?=$this->createUrl('/lyrics/song/index', array('id' => $data->id, 'language' => $language))?>">
	<div class="content">
		<img src="<?=Yii::app()->theme->baseUrl?>/images/track.24.png" class="tp"/> <span class="small"><?=(($widget->dataProvider->pagination->currentPage * $widget->dataProvider->pagination->pageSize) + $index + 1)?>.</span> <?=CHtml::encode(implode(' & ', $artists))?> - <?=CHtml::encode($data->title)?></span><br />
	</div>
</a>
