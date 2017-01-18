<?php
$this->menuButtons = array(
	'← В начало' => $this->createUrl('default/index'),
);
$artists = array();
foreach (isset($song->artists) ? $song->artists : array($song->artist) as $artist) {
	$artists[] = $artist->name;
	$this->menuButtons['← Вернуться к исполнителю "'.CHtml::encode($artist->name).'"'] = $this->createUrl('/lyrics/artist/index', array('id' => $artist->id, 'language' => $language));
}
$this->pageTitle = CHtml::encode(implode(' & ', $artists)).' - '.CHtml::encode($song->title);
$this->headerTitle = CHtml::encode(implode(' & ', $artists)).' - '.CHtml::encode($song->title);
?>
<div class="content center bold" id="top">
	Текст песни <?= $song->title ?><?= (!empty($translation) ? ' и её перевод' : null)?>
</div>
<div class="content">
	<?= nl2br($lyrics); ?>
</div>
<div class="content center"><a href="#top">↑ Наверх ↑</a></div>
<?php if (!empty($translation)): ?>
	<div class="content">
		<div class="center bold">Перевод</div>
		<?= nl2br($translation); ?>
	</div>
	<div class="content center"><a href="#top">↑ Наверх ↑</a></div>
<?php endif; ?>
