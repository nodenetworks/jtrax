DROP TABLE IF EXISTS `#__jtrax`;
 
CREATE TABLE `#__jtrax` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datetime` date NOT NULL,
  `code` varchar(30) NOT NULL,
  `status_id` INT(11) NOT NULL DEFAULT 0,
  `status` varchar(50) NOT NULL,
  `notes` TEXT NULL,
  `published` tinyint(4) NOT NULL DEFAULT 1,
   PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `#__jtrax_statuses` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE=utf8mb4_unicode_ci;