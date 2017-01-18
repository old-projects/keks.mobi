<?php
$this->pageTitle = $this->headerTitle = 'Ошибка #'.$code;
$this->headerImage = Yii::app()->theme->baseUrl.'/images/error.png';
$this->headerHomeLink = true;
// $this->headerLink = $this->createUrl('/video');
?>
<div class="content">
	<?=$message?>
</div>
