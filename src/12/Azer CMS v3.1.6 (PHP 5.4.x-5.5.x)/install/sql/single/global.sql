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
