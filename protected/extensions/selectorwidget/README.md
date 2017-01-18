yii-selectorwidget
==================

How to use
==================
1. Put files in protected/extensions/selectorwidget/
2. In config/main.php put following lines
```php
	'import' => array(
		...
		'ext.selectorwidget.*',
	),
```

3. In controller:
```php
	$sorting_labels = array(
		'id' => 'по дате добавления',
		'downloads_count' => 'по количеству скачиваний',
		'download_last_time' => 'по дате последнего скачивания',
		'filesize' => 'по размеру файла',
	);
	$sorting_selector = new Selector($sorting_labels);
	
	$criteria = new CDbCriteria;
	$criteria->order = $sorting_selector->selectedItem.' DESC';
	... // retrieving data from database
	
	$this->render('index', array(
		...
		'sorting_selector' => $sorting_selector,
	));
```

4. In template:
```php
	<div class="row centered">Сортировка: <? $this->widget('SelectorWidget', array('selector' => $sorting_selector)) ?></div>	
```

5. Enjoy.
