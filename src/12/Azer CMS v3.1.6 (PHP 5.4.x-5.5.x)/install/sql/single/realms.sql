CREATE TABLE `realms` (
  `id` int(32) NOT NULL auto_increment,
  `rname` varchar(84) default NULL,
  `type` varchar(84) default NULL,
  `oid` int(32) default NULL,
  `char_db` varchar(84) default NULL,
  `port` int(32) default NULL,
  `soap_port` int(32) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE='utf8mb4_unicode_ci' AUTO_INCREMENT=1;
