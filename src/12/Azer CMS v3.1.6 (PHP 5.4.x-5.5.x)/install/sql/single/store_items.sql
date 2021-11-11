CREATE TABLE `store_items` (
  `sid` int(32) NOT NULL auto_increment,
  `name` varchar(64) default NULL,
  `display` varchar(64) default NULL,
  `item` varchar(128) default NULL,
  `ctype` int(32) default NULL,
  `cost` varchar(32) default NULL,
  `amount` int(32) default NULL,
  `parent_category` int(32) default NULL,
  PRIMARY KEY  (`sid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE='utf8mb4_unicode_ci' AUTO_INCREMENT=2;

INSERT INTO `store_items` VALUES (1, 'Hearthstone', '6948', '6948', 1, '0', 1, 1);
INSERT INTO `store_items` VALUES (2, 'Hearthstone', '6948', '6948', 2, '0', 1, 2);
