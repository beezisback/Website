CREATE TABLE `news` (
  `id` int(32) NOT NULL auto_increment,
  `title` varchar(64) default NULL,
  `author` varchar(64) default NULL,
  `body` longtext,
  `date` varchar(32) default NULL,
  `avatar` varchar(150) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE='utf8mb4_unicode_ci' AUTO_INCREMENT=1; 

INSERT INTO `news` VALUES (1, 'Welcome to Azer CMS V3.0', 'Azer', 'First Post.', 'November 30, 2012', 'a3');