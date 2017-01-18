ALTER TABLE `wc_prime_music_tracks`
CHANGE `downloads_count` `primemusic_downloads_count` int(10) unsigned NOT NULL AFTER `primemusic_id`,
CHANGE `category_id` `category_id` int(10) unsigned NOT NULL AFTER `primemusic_downloads_count`,
CHANGE `artist` `artist` varchar(255) COLLATE 'utf8_general_ci' NOT NULL AFTER `category_id`,
CHANGE `title` `title` varchar(255) COLLATE 'utf8_general_ci' NOT NULL AFTER `artist`,
CHANGE `filesize` `filesize` bigint(20) NOT NULL AFTER `title`,
COMMENT='';

ALTER TABLE `wc_prime_music_tracks`
ADD `downloads_count` int unsigned NOT NULL AFTER `filesize`,
CHANGE `download_last_time` `download_last_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' AFTER `downloads_count`,
COMMENT='';

ALTER TABLE `wc_prime_music_categories`
ADD `skipped` enum('0','1') COLLATE 'utf8_general_ci' NOT NULL,
COMMENT='';

UPDATE `wc_prime_music_categories` SET
`skipped` = 1
WHERE `id` = '8';
