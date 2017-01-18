#!/bin/sh
rsync -azv --exclude .git \
	--exclude assets \
	--exclude tmp \
	--exclude protected/runtime \
	--exclude files \
	--exclude screenshots \
	--exclude protected/config/database.php \
	--exclude download \
	./ 46.102.243.169:/var/www/keks.mobi/public_html/
#	./ 94.242.199.90:/var/www/keks.mobi/public_html/
