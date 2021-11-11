CREATE TABLE `vote_sites` (
  `id` int(32) NOT NULL auto_increment,
  `site_name` varchar(64) default NULL,
  `site_url` varchar(84) default NULL,
  `site_img` varchar(255) default NULL,
  `site_cost` varchar(32) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE='utf8mb4_unicode_ci' AUTO_INCREMENT=1;