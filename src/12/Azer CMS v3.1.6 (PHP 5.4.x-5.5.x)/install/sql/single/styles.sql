CREATE TABLE `styles` (
  `id` int(32) NOT NULL auto_increment,
  `path` varchar(64) default NULL,
  `install` int(32) default NULL,
  `active` int(32) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE='utf8mb4_unicode_ci' AUTO_INCREMENT=1;

INSERT INTO `styles` VALUES (1, 'v3-default', 1, 1);
