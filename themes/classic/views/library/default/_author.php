<a href="<?=$this->createUrl('author', array('id' => $data->id))?>">
	<div class="content">
		<img src="<?=Yii::app()->theme->baseUrl?>/images/man.24.png" class="tp"/> <span class="small"><?=(($widget->dataProvider->pagination->currentPage * $widget->dataProvider->pagination->pageSize) + $index + 1)?>.</span> <?=CHtml::encode($data->name)?> <span class="small">(<?= Yii::t('library', '{n} книга|{n} книги|{n} книг|{n} книги', $data->books_count) ?>)</span>
	</div>
</a>
