ALTER TABLE `#__jtrax` CONVERT TO CHARACTER SET utf8mb4, COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `#__jtrax` 
  ADD `status_id` INT(11) NOT NULL DEFAULT 0 AFTER `code`,
  ADD `notes` TEXT NULL AFTER `status`,
  ADD `published` tinyint(4) NOT NULL DEFAULT 1 AFTER `notes`;

ALTER TABLE `#__jtrax` RENAME COLUMN `status` TO `details`;

CREATE TABLE `#__jtrax_statuses` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(255) NOT NULL,
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
