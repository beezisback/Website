CREATE TABLE `store_log` (
  `id` int(32) NOT NULL auto_increment,
  `body` varchar(84) default NULL,
  `eid` varchar(64) default NULL,
  `acc_id` int(32) default NULL,
  `char_id` int(32) default NULL,
  `date` varchar(84) default NULL,
  `trs_id` varchar(255) default NULL,
  `prc_items` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE='utf8mb4_unicode_ci' AUTO_INCREMENT=1;