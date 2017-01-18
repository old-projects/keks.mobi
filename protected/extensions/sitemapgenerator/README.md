yii-sitemapgenerator
==========

SitemapGenerator - an Yii component that helps make sitemap.xml.

How to use
==========
1. Extract tarball or clone git repository into directory *ext.sitemapgenerator* 
2. Add few lines in main config

```
'sitemapGenerator' => array(
			'class' => 'ext.sitemapgenerator.SitemapGenerator',
		),
```

3. 
```
	$generator = Yii::app()->sitemapGenerator;
	echo 'Updating sitemap ...'.PHP_EOL;
	echo "\t".'Selected modules: '.implode(',', $modules).PHP_EOL;
	// подключаем модули
	foreach ($fillers as $filler) {
		$generator->addFiller(Yii::app()->getModule($module));
	}
	$sitemap_files = $generator->buildSitemap();
```
