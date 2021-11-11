CREATE TABLE `cart` (
  `id` int(32) NOT NULL auto_increment,
  `realm` int(32) default NULL,
  `account` varchar(84) default NULL,
  `character` varchar(84) default NULL,
  `item` int(32) default NULL,
  `parent` int(32) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE='utf8mb4_unicode_ci' AUTO_INCREMENT=1;

