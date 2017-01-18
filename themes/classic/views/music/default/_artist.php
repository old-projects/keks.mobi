<a href="<?=$this->createUrl('/music/default/search', array('SearchForm[artist]' => $data->artist))?>">
	<div class="content">
		<img src="<?=Yii::app()->theme->baseUrl?>/images/track.24.png" class="tp"/> <span class="small"><?=(($widget->dataProvider->pagination->currentPage * $widget->dataProvider->pagination->pageSize) + $index + 1)?>.</span> <?=CHtml::encode($data->artist)?> <span class="small">(<?= Yii::t('music', '{n} трек|{n} трека|{n} треков|{n} трека', $data->count) ?>)</span>
	</div>
</a>
