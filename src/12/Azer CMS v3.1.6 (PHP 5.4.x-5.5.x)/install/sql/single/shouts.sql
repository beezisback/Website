CREATE TABLE `shouts` (
  `id` int(32) NOT NULL auto_increment,
  `author` varchar(64) default NULL,
  `body` longtext,
  `date` varchar(64) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE='utf8mb4_unicode_ci' AUTO_INCREMENT=1;
