<?php
$referrer = $data->referrer;
if (parse_url($data->referrer, PHP_URL_HOST) == $server_name)
	$referrer = substr($referrer, strlen($host_info));
?>
		<tr>
			<td class="centered"><?= (($widget->dataProvider->pagination->currentPage * $widget->dataProvider->pagination->pageSize) + $index + 1) ?></td>
			<td><span class="bold"><?= Yii::app()->dateFormatter->formatDateTime($data->refresh_last_time, null) ?></span></td>
			<td class="centered"><?= $data->refreshes_count ?></td>
			<td>
				<?php if (Yii::app()->user->isMobile($data->user_agent)): ?>
				<img src="<?=Yii::app()->theme->baseUrl?>/images/phone.16.png" alt="mobile user"/>
				<?php endif; ?>
				<?php if (Yii::app()->user->isTouchScreenMobile($data->user_agent)): ?>
				<img src="<?=Yii::app()->theme->baseUrl?>/images/finger.16.png" alt="touch screen"/>
				<?php endif; ?>
				<?= CHtml::encode($data->user_agent) ?>
			</td>
			<td><?= $data->address ?></td>
			<td>
				<?= (strtotime($data->start_time) > strtotime('today') 
				? Yii::app()->dateFormatter->formatDateTime($data->start_time, null)
				: Yii::app()->dateFormatter->formatDateTime($data->start_time)) ?>
			</td>
			<td><a href="<?= $data->query ?>"><?= CHtml::encode($data->query) ?></a></td>
			<td><a href="<?= $referrer ?>"><?= CHtml::encode($referrer) ?></a></td>
			<td><a href="<?= $data->external_referrer ?>"><?= CHtml::encode($data->external_referrer) ?></a></td>
			<td><?= ($data->is_bot ? 'БОТ' : null)?> <?= ($data->address == $user_host_address && $data->user_agent == $user_agent ? 'ВЫ' : null)?></td>
		</tr>
