CREATE TABLE `login_log` (
  `id` int(32) NOT NULL auto_increment,
  `username` varchar(64) default NULL,
  `ip` varchar(64) default NULL,
  `date` varchar(64) default NULL,
  `status` varchar(32) default NULL,
  `lty` varchar(32) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE='utf8mb4_unicode_ci' AUTO_INCREMENT=1;