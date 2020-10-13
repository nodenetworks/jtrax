DROP TABLE IF EXISTS `#__jtrax`;
 
CREATE TABLE `#__jtrax` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datetime` date NOT NULL,
  `code` varchar(30) NOT NULL,
  `status` varchar(50) NOT NULL,
  `published` tinyint(4) NOT NULL DEFAULT 1,
  `checked_out` int UNSIGNED NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `access` int UNSIGNED NOT NULL DEFAULT '0',
   PRIMARY KEY  (`id`),
   KEY `idx_access` (`access`),
   KEY `idx_checkout` (`checked_out`);
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE=utf8mb4_unicode_ci;

