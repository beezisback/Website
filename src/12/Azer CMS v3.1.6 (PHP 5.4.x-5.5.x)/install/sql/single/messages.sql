CREATE TABLE `messages` (
  `id` int(32) NOT NULL auto_increment,
  `title` varchar(84) default NULL,
  `body` longtext,
  `sender` varchar(64) default NULL,
  `user` varchar(64) default NULL,
  `date` varchar(64) default NULL,
  `unread` int(32) default '1',
  `inbox_copy` int(32) default '1',
  `outbox_copy` int(32) default '1',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE='utf8mb4_unicode_ci' AUTO_INCREMENT=1;