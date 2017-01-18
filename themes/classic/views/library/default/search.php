<?php
$page_title = 'Поиск в библиотеке';
if (!empty($model->query)) {
	switch ($model->content) {
		default:
			$page_title = 'Поиск: '.CHtml::encode($model->query);
			break;
		case 'book':
			$page_title = 'Поиск книги: '.CHtml::encode($model->query);
			break;
		case 'author':
			$page_title = 'Поиск автора: '.CHtml::encode($model->query);
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
	<?php echo $form->label($model, 'content'); ?>: <br />
	<?php echo $form->dropdownList($model, 'content', array('all' => '---',  'author' => 'автора', 'book' => 'книгу')); ?>
	<?php echo $form->error($model,'content'); ?>
	</div>

	<div class="row submit">
	<?php echo CHtml::submitButton('Найти'); ?>
	</div>
	 
	<?php $this->endWidget(); ?>
</div>
<?php if (isset($dataProvider) || ($model->content == 'all' && !empty($model->query))): ?>
<div class="tl"><div class="tl_right"><?= 
	($model->content == 'author'
	? 'Найденные авторы'
	: ($model->content == 'book'
		? 'Найденные книги'
		: 'Результаты поиска')
	)?></div></div>
<?php if (isset($sorting_selector)): ?>
<div class="content center">Сортировка: <? $this->widget('SelectorWidget', array('selector' => $sorting_selector)) ?></div>
<?php endif; ?>

<?php switch ($model->content): ?>
<?php default: ?>
	<?php if ($authors_count > 0): ?>
		<a href="<?= $this->createUrl('search', array('SearchForm[query]' => $model->query, 'SearchForm[content]' => 'author'))?>">
			<div class="content successMessage">
				<img src="<?=Yii::app()->theme->baseUrl?>/images/man.24.png" class="tp"/>
				<?= Yii::t('lyrics', '{n} автор|{n} автора|{n} авторов|{n} автора', $authors_count) ?>
			</div>
		</a>
	<?php else: ?>
		<div class="content errorMessage">Подходящих авторов не найдено</div>
	<?php endif; ?>
	<?php if ($books_count > 0): ?>
		<a href="<?= $this->createUrl('search', array('SearchForm[query]' => $model->query, 'SearchForm[content]' => 'book'))?>">
			<div class="content successMessage">
				<img src="<?=Yii::app()->theme->baseUrl?>/images/track.24.png" class="tp"/>
				<?= Yii::t('lyrics', '{n} книга|{n} книги|{n} книг|{n} книги', $books_count) ?>
			</div>
		</a>
	<?php else: ?>
		<div class="content errorMessage">Подходящих книг не найдено</div>
	<?php endif; ?>
	<?php break; ?>
<?php case 'author': ?>
	<?php $this->widget('zii.widgets.CListView', array(
		'dataProvider' => $dataProvider,
		'itemView' => '_author',
		'ajaxUpdate' => false,
	));
	?>
	<?php break; ?>
<?php case 'book': ?>
	<?php $this->widget('zii.widgets.CListView', array(
		'dataProvider' => $dataProvider,
		'itemView' => '_book',
		// 'template' => "{items}",
		'ajaxUpdate' => false,
	));
	?>
	<?php break; ?>
<?php endswitch; ?>
<?php endif; ?>
