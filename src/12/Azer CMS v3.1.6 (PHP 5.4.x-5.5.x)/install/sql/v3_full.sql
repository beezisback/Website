CREATE TABLE `acp_styles` (
  `id` int(32) NOT NULL auto_increment,
  `path` varchar(64) default NULL,
  `install` int(32) default NULL,
  `active` int(32) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE='utf8mb4_unicode_ci' AUTO_INCREMENT=1;

INSERT INTO `acp_styles` VALUES (1, 'v3-default', 1, 1);

CREATE TABLE `cart` (
  `id` int(32) NOT NULL auto_increment,
  `realm` int(32) default NULL,
  `account` varchar(84) default NULL,
  `character` varchar(84) default NULL,
  `item` int(32) default NULL,
  `parent` int(32) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE='utf8mb4_unicode_ci' AUTO_INCREMENT=1;

CREATE TABLE `clog` (
  `id` int(32) NOT NULL auto_increment,
  `title` varchar(64) default NULL,
  `author` varchar(64) default NULL,
  `body` longtext,
  `date` varchar(32) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE='utf8mb4_unicode_ci' AUTO_INCREMENT=1;

INSERT INTO `clog` VALUES (1, 'Test', 'Azer', 'Test Post', 'November 30, 2012');

CREATE TABLE `global` (
  `global_title` varchar(64) NOT NULL default '',
  `email_activation` int(32) default '0',
  `login` int(32) default NULL,
  `copyright` varchar(64) default NULL,
  `realmlist` varchar(64) default NULL,
  `server_email` varchar(64) default NULL,
  `domain` varchar(64) default NULL,
  `server_title` varchar(64) default NULL,
  `expansion` int(32) default NULL,
  PRIMARY KEY  (`global_title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE='utf8mb4_unicode_ci';

CREATE TABLE `login_log` (
  `id` int(32) NOT NULL auto_increment,
  `username` varchar(64) default NULL,
  `ip` varchar(64) default NULL,
  `date` varchar(64) default NULL,
  `status` varchar(32) default NULL,
  `lty` varchar(32) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE='utf8mb4_unicode_ci' AUTO_INCREMENT=1;

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

CREATE TABLE `shouts` (
  `id` int(32) NOT NULL auto_increment,
  `author` varchar(64) default NULL,
  `body` longtext,
  `date` varchar(64) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE='utf8mb4_unicode_ci' AUTO_INCREMENT=1;

CREATE TABLE `store_categories` (
  `id` int(32) NOT NULL auto_increment,
  `cname` varchar(64) default NULL,
  `oid` int(32) default NULL,
  `realm` int(32) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE='utf8mb4_unicode_ci' AUTO_INCREMENT=2;

INSERT INTO `store_categories` VALUES (1, 'Vote Items', 1, 1);
INSERT INTO `store_categories` VALUES (2, 'V.I.P Items', 2, 1);

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

CREATE TABLE `styles` (
  `id` int(32) NOT NULL auto_increment,
  `path` varchar(64) default NULL,
  `install` int(32) default NULL,
  `active` int(32) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE='utf8mb4_unicode_ci' AUTO_INCREMENT=1;

INSERT INTO `styles` VALUES (1, 'v3-default', 1, 1);

CREATE TABLE `vip_log` (
  `id` int(32) NOT NULL auto_increment,
  `body` longtext,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE='utf8mb4_unicode_ci' AUTO_INCREMENT=1;

CREATE TABLE `vote_logs` (
  `id` int(32) NOT NULL auto_increment,
  `user` varchar(84) default NULL,
  `site_name` varchar(64) default NULL,
  `site_id` int(32) default NULL,
  `site_cost` varchar(32) default NULL,
  `date` varchar(84) default NULL,
  `timer` varchar(64) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE='utf8mb4_unicode_ci' AUTO_INCREMENT=1;

CREATE TABLE `vote_sites` (
  `id` int(32) NOT NULL auto_increment,
  `site_name` varchar(64) default NULL,
  `site_url` varchar(84) default NULL,
  `site_img` varchar(255) default NULL,
  `site_cost` varchar(32) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE='utf8mb4_unicode_ci' AUTO_INCREMENT=1;