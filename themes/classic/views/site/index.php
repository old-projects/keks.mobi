<?php
$this->pageTitle = 'Keks.Mobi';
$this->counters = '<script type="text/javascript" src="http://mobtop.ru/c/70449.js"></script><noscript><a href="http://mobtop.ru/in/70449"><img src="http://mobtop.ru/70449.gif" alt="MobTop.Ru - рейтинг мобильных сайтов"/></a></noscript>';
?>
<a href="<?=$this->createUrl('/video')?>">
	<div class="content">
		<img src="<?=Yii::app()->theme->baseUrl?>/images/video.24.png" class="tp"/> Видео <span class="small">(<?=$total_videos?> видео)</span> <!-- <span class="small">video.keks.mobi</span> -->
	</div>
</a>
<hr/>
<?php /*<a href="<?=$this->createUrl('/music')?>">
	<div class="content">
		<img src="<?=Yii::app()->theme->baseUrl?>/images/music.24.png" class="tp"/> Музыка <span class="small">(<?= $this->widget('application.components.FilesizeWidget', array('size' => $total_tracks_size)) ?> / <?= Yii::t('music', '{n} трек|{n} трека|{n} треков|{n} трека', $total_tracks) ?>)</span><!--  <span class="small">music.keks.mobi</span> -->
	</div>
</a>
<hr/> */ ?>
<a href="<?=$this->createUrl('/lyrics')?>">
	<div class="content">
		<img src="<?=Yii::app()->theme->baseUrl?>/images/lyrics.24.png" class="tp"/> Тексты песен <span class="small">(<?= Yii::t('lyrics', '{n} исполнитель|{n} исполнителя|{n} исполнителей|{n} исполнителя', $total_lyrics_artists) ?> / <?= Yii::t('lyrics', '{n} песня|{n} песни|{n} песен|{n} песни', $total_lyrics_songs) ?>) <!-- <span class="small">lyrics.keks.mobi</span> -->
	</div>
</a>
<hr/>
<a href="http://pilotka.mobi/?from=keks.mobi">
	<div class="content">
		<img src="<?=Yii::app()->theme->baseUrl?>/images/stawberry.24.png" class="tp"/> Клубничка <!-- <span class="small">sex.keks.mobi</span> -->
	</div>
</a>
<hr/>
<a href="<?=$this->createUrl('/images')?>">
	<div class="content">
		<img src="<?=Yii::app()->theme->baseUrl?>/images/funny.24.png" class="tp"/> Приколы <span class="small">(<?= $this->widget('application.components.FilesizeWidget', array('size' => $total_images_size)) ?> / <?= Yii::t('images', '{n} картинка|{n} картинки|{n} картинок|{n} картинки', $total_images) ?>)</span><!--  <span class="small">images.keks.mobi</span> -->
	</div>
</a>
<?php if (YII_DEVELOPMENT): ?>
<hr/>
<a href="<?=$this->createUrl('/films')?>">
	<div class="content">
		<img src="<?=Yii::app()->theme->baseUrl?>/images/films.24.png" class="tp"/> Фильмы <span class="small">films.keks.mobi</span>
	</div>
</a>
<hr/>
<a href="<?=$this->createUrl('/library')?>">
	<div class="content">
		<img src="<?=Yii::app()->theme->baseUrl?>/images/library.24.png" class="tp"/> Библиотека <span class="small">(<?= Yii::t('library', '{n} книга|{n} книги|{n} книг|{n} книги', 25959) ?>)</span><!--  <span class="small">images.keks.mobi</span> -->
	</div>
</a>
<div class="tl"><div class="tl_right">Сервисы</div></div>
<a href="<?=$this->createUrl('/photo')?>">
	<div class="content">
		<img src="<?=Yii::app()->theme->baseUrl?>/images/photo.24.png" class="tp"/> Редактор фото <!--  <span class="small">images.keks.mobi</span> -->
	</div>
</a>
<hr/>
<a href="<?=$this->createUrl('/translate')?>">
	<div class="content">
		<img src="<?=Yii::app()->theme->baseUrl?>/images/translate.24.png" class="tp"/> Переводчик <!--  <span class="small">images.keks.mobi</span> -->
	</div>
</a>
<?php endif; ?>
