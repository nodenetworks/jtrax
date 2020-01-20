DROP TABLE IF EXISTS `#__jtrax`;
 
CREATE TABLE `#__jtrax` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datetime` date NOT NULL,
  `code` varchar(30) NOT NULL,
  `status` varchar(50) NOT NULL,
  `published` tinyint(4) NOT NULL DEFAULT 1,
   PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;