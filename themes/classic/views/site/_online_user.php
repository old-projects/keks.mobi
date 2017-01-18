<?php 
list($user_agent) = explode('/', $data->user_agent);
?>
<div class="content">
	<span class="small"><?=(($widget->dataProvider->pagination->currentPage * $widget->dataProvider->pagination->pageSize) + $index + 1)?>.</span>
	<span class="bold"><?=Yii::app()->dateFormatter->formatDateTime($data->refresh_last_time, null)?></span> - <?=CHtml::encode($detailed ? $data->user_agent : $user_agent)?><?php if (Yii::app()->user->isMobile($data->user_agent)): ?><img src="<?=Yii::app()->theme->baseUrl?>/images/phone.16.png" alt="mobile user"/><?php endif; ?><?php if (Yii::app()->user->isTouchScreenMobile($data->user_agent)): ?><img src="<?=Yii::app()->theme->baseUrl?>/images/finger.16.png" alt="touch screen"/><?php endif; ?><br />
	Количество переходов: <span class="bold"><?=$data->refreshes_count?></span><br />
	<?php if ($detailed): ?>
		IP: <?=$data->address?><br />
		Начал ходить с: <?=Yii::app()->dateFormatter->formatDateTime($data->start_time)?><br />
		Страница: <a href="<?=$data->query?>"><?=$data->query?></a><br />
		<?php if (!empty($data->referrer)): ?>
			Реферер: <a href="<?=$data->referrer?>"><?=$data->referrer?></a><br />
		<?php endif; ?>
	<?php endif; ?>
</div>
