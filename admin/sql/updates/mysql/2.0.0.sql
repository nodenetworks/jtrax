ALTER TABLE #__jtrax CONVERT TO CHARACTER SET utf8mb4, COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `#__jtrax` 
  ADD `status_id` INT(11) NOT NULL DEFAULT 0 AFTER `code`,
  ADD `notes` TEXT NULL AFTER `status`;

CREATE TABLE `#__jtrax_statuses` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE=utf8mb4_unicode_ci;