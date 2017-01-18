<a href="<?=$this->createUrl('/lyrics/artist/index', array('id' => $data->id, 'language' => $language))?>">
	<div class="content">
		<img src="<?=Yii::app()->theme->baseUrl?>/images/man.24.png" class="tp"/> <span class="small"><?=(($widget->dataProvider->pagination->currentPage * $widget->dataProvider->pagination->pageSize) + $index + 1)?>.</span> <?=CHtml::encode($data->name)?> <span class="small">(<?= Yii::t('lyrics', '{n} песня|{n} песни|{n} песен|{n} песни', $data->songs_count) ?>)</span>
	</div>
</a>
