CREATE TABLE `clog` (
  `id` int(32) NOT NULL auto_increment,
  `title` varchar(64) default NULL,
  `author` varchar(64) default NULL,
  `body` longtext,
  `date` varchar(32) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE='utf8mb4_unicode_ci' AUTO_INCREMENT=1;

INSERT INTO `clog` VALUES (1, 'Test', 'Azer', 'Test Post', 'November 30, 2012');