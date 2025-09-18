DROP TABLE IF EXISTS `#__jtrax`;
DROP TABLE IF EXISTS `#__jtrax_statuses`;
 
CREATE TABLE `#__jtrax` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datetime` date NOT NULL,
  `code` varchar(30) NOT NULL,
  `status_id` int(11) NOT NULL DEFAULT 0,
  `details` varchar(50) NOT NULL,
  `notes` text DEFAULT NULL,
  `published` tinyint(4) NOT NULL DEFAULT 1,
   PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `#__jtrax_statuses` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `title` varchar(255) NOT NULL,
	`ordering` int(11) NOT NULL DEFAULT 0,
	`published` int(4) NOT NULL DEFAULT 1,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE=utf8mb4_unicode_ci;

INSERT INTO `#__jtrax_statuses` (`id`, `title`, `ordering`, `published`) VALUES
(1, 'Repair order received', 0, 1),
(2, 'Repair in progress', 0, 1),
(3, 'Awaiting spare parts delivery', 0, 1),
(4, 'Repair complete. Ready for collection.', 0, 1),
(5, 'Unable to repair.', 0, 1);