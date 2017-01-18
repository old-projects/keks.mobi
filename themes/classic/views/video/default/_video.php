<a href="<?=$this->createUrl('/video/default/retrieve', array('id' => $data->id))?>">
	<div class="content">
		<img src="<?=$data->getThumbnailUrl(90)?>" width="54" height="40" class="tp"/> <span class="small"><?=($startIndex+$index+1)?>.</span> <?=CHtml::encode($data->title)?> (<?= $data->duration > 3600 ? floor($data->duration / 3600).':'.date('i:s', $data->duration) : date('i:s', $data->duration) ?>)
		<span class="small">
			<?php if (mb_strlen($data->description) > 100): ?>
				<?=CHtml::encode(mb_substr($data->description, 0, 100))?> ...
			<?php else: ?>
				<?=CHtml::encode($data->description)?>
			<?php endif; ?>
		</span>
	</div>
</a>
<?php /*var_dump($data)*/ ?>
