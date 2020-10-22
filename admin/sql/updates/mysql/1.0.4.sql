# com_jtrax
ALTER TABLE `#__jtrax` ADD `catid` int(11) NOT NULL DEFAULT '0';
ALTER TABLE `#__jtrax` ADD COLUMN `checked_out` int(11) unsigned NOT NULL DEFAULT '0';
ALTER TABLE `#__jtrax` ADD COLUMN `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00';
ALTER TABLE `#__jtrax` ADD COLUMN `access` int(10) unsigned NOT NULL DEFAULT '0';
ALTER TABLE `#__jtrax` ADD KEY `idx_access` (`access`);
ALTER TABLE `#__jtrax` ADD KEY `idx_checkout` (`checked_out`);
ALTER TABLE `#__jtrax` ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE=utf8mb4_unicode_ci;