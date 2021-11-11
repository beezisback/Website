CREATE TABLE `store_categories` (
  `id` int(32) NOT NULL auto_increment,
  `cname` varchar(64) default NULL,
  `oid` int(32) default NULL,
  `realm` int(32) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE='utf8mb4_unicode_ci' AUTO_INCREMENT=2;

INSERT INTO `store_categories` VALUES (1, 'Vote Items', 1, 1);
INSERT INTO `store_categories` VALUES (2, 'V.I.P Items', 2, 1);