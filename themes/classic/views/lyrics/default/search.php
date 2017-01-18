<?php
$page_title = 'Поиск песен';
if (!empty($model->query)) {
	switch ($model->content) {
		default:
			$page_title = 'Поиск: '.CHtml::encode($model->query);
			break;
		case 'song':
			$page_title = 'Поиск песни: '.CHtml::encode($model->query);
			break;
		case 'artist':
			$page_title = 'Поиск исполнителя: '.CHtml::encode($model->query);
			break;
	}
}

$this->pageTitle = $page_title;
$this->menuButtons = array(
	'← В начало' => $this->createUrl('index'),
);
?>
<div class="tl"><div class="tl_right">Поиск</div></div>
<div class="content">
	<?php $form = $this->beginWidget('ActiveForm', array('method' => 'get', 'action' => $this->createUrl('search', array('advanced' => $model->scenario == 'advanced')))); ?>

	<?php /*echo $form->errorSummary($model);*/ ?>

	<div class="row">
	<?php echo $form->label($model, 'query'); ?>: <br />
	<?php echo $form->textField($model, 'query'); ?>
	<?php echo $form->description($model, 'query'); ?>
	<?php echo $form->error($model,'query'); ?>
	</div>

	<div class="row">
	<?php echo $form->label($model, 'language'); ?>: <br />
	<?php echo $form->dropdownList($model, 'language', array('rus' => 'русскоязычный', 'eng' => 'англоязычный')); ?>
	<?php echo $form->description($model, 'language'); ?>
	<?php echo $form->error($model,'language'); ?>
	</div>

	<div class="row">
	<?php echo $form->label($model, 'content'); ?>: <br />
	<?php echo $form->dropdownList($model, 'content', array('all' => '---',  'artist' => 'исполнителя', 'song' => 'песню')); ?>
	<?php echo $form->error($model,'content'); ?>
	</div>

	<div class="row submit">
	<?php echo CHtml::submitButton('Найти'); ?>
	</div>
	 
	<?php $this->endWidget(); ?>
</div>
<?php if (isset($dataProvider) || ($model->content == 'all' && !empty($model->query))): ?>
<div class="tl"><div class="tl_right"><?= 
	($model->content == 'artist'
	? 'Найденные исполнители'
	: ($model->content == 'song'
		? 'Найденные песни'
		: 'Результаты поиска')
	)?></div></div>
<?php if (isset($sorting_selector)): ?>
<div class="content center">Сортировка: <? $this->widget('SelectorWidget', array('selector' => $sorting_selector)) ?></div>
<?php endif; ?>

<?php switch ($model->content): ?>
<?php default: ?>
	<?php if ($artists_count > 0): ?>
		<a href="<?= $this->createUrl('search', array('SearchForm[query]' => $model->query, 'SearchForm[language]' => $model->language, 'SearchForm[content]' => 'artist'))?>">
			<div class="content successMessage">
				<img src="<?=Yii::app()->theme->baseUrl?>/images/man.24.png" class="tp"/>
				<?= Yii::t('lyrics', '{n} исполнитель|{n} исполнителя|{n} исполнителей|{n} исполнителя', $artists_count) ?>
			</div>
		</a>
	<?php else: ?>
		<div class="content errorMessage">Подходящих исполнителей не найдено</div>
	<?php endif; ?>
	<?php if ($songs_count > 0): ?>
		<a href="<?= $this->createUrl('search', array('SearchForm[query]' => $model->query, 'SearchForm[language]' => $model->language, 'SearchForm[content]' => 'song'))?>">
			<div class="content successMessage">
				<img src="<?=Yii::app()->theme->baseUrl?>/images/track.24.png" class="tp"/>
				<?= Yii::t('lyrics', '{n} песня|{n} песни|{n} песен|{n} песни', $songs_count) ?>
			</div>
		</a>
	<?php else: ?>
		<div class="content errorMessage">Подходящих песен не найдено</div>
	<?php endif; ?>
	<?php break; ?>
<?php case 'artist': ?>
	<?php $this->widget('zii.widgets.CListView', array(
		'dataProvider' => $dataProvider,
		'itemView' => '_artist',
		'ajaxUpdate' => false,
		'viewData' => array('language' => $model->language),
	));
	?>
	<?php break; ?>
<?php case 'song': ?>
	<?php $this->widget('zii.widgets.CListView', array(
		'dataProvider' => $dataProvider,
		'itemView' => '_song',
		// 'template' => "{items}",
		'ajaxUpdate' => false,
		'viewData' => array('language' => $model->language),
	));
	?>
	<?php break; ?>
<?php endswitch; ?>
<?php endif; ?>
