-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Värd: localhost
-- Skapad: 17 juli 2011 kl 01:21
-- Serverversion: 5.5.8
-- PHP-version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databas: `webwow`
--

-- --------------------------------------------------------

--
-- Struktur för tabell `accounts_more`
--

CREATE TABLE IF NOT EXISTS `accounts_more` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `acc_login` varchar(55) COLLATE latin1_general_ci NOT NULL,
  `vp` bigint(55) NOT NULL DEFAULT '0',
  `question_id` int(11) NOT NULL,
  `answer` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `dp` bigint(55) NOT NULL DEFAULT '0',
  `gmlevel` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`,`acc_login`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci COMMENT='Account Information' AUTO_INCREMENT=2595 ;

--
-- Data i tabell `accounts_more`
--

INSERT INTO `accounts_more` (`id`, `acc_login`, `vp`, `question_id`, `answer`, `dp`, `gmlevel`) VALUES
(2590, 'ADMIN', 9000, 2, 'yourmom', 9000, 3),
(2591, 'MEOX', 100, 2, 'Sollefte', 89, 3),
(2592, 'IAMNUMBERFOUR', 192992, 3, 'woff', 100004, 1),
(2593, 'TEST', 1, 2, 'se', 69, NULL),
(2594, 'SMS', 10, 2, 'sda', 1, NULL);

-- --------------------------------------------------------

--
-- Struktur för tabell `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `poster` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `content` text COLLATE latin1_general_ci NOT NULL,
  `newsid` int(11) NOT NULL,
  `timepost` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `datepost` varchar(100) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci COMMENT='News Comments Database' AUTO_INCREMENT=150 ;

--
-- Data i tabell `comments`
--


-- --------------------------------------------------------

--
-- Struktur för tabell `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `content` longtext COLLATE latin1_general_ci NOT NULL,
  `iconid` int(11) NOT NULL,
  `timepost` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `datepost` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `author` varchar(50) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci COMMENT='Website News' AUTO_INCREMENT=98 ;

--
-- Data i tabell `news`
--

INSERT INTO `news` (`id`, `title`, `content`, `iconid`, `timepost`, `datepost`, `author`) VALUES
(95, 'Welcome!', '<p>Testing my new Cataclysm Theme for Web-WoW! <img src="img/smilies/smile.png" width="15" height="15" alt="smile" /></p>', 0, '1299865425', 'March 11, 2011', 'admin'),
(96, 'We are using Jeutie''s Blizzlike Repack', '<p>Trinity Core has been updated to the latest revision. (bdc75eb856cd)\r\n\r\nGundrak fixes\r\n\r\n&nbsp; &nbsp; Fixed the bridge inside Gundrak.\r\n\r\nUlduar fixes\r\n\r\n&nbsp; &nbsp; The Rare Cache of Winter will correctly spawn after the Hodir encounter.\r\n\r\nTrial of the Crusader fixes\r\n\r\n&nbsp; &nbsp; Updated some flags and factions for the Argent Coliseum Floor.\r\n\r\nIcecrown Citadel fixes\r\n\r\n&nbsp; &nbsp; Added script for the Val''kyr Protector.\r\n&nbsp; &nbsp; Added script for the Val''kyr Guardian.\r\n\r\nThe Ruby Sanctum fixes\r\n\r\n&nbsp; &nbsp; Updated all templates of the creatures within The Ruby Sanctum.\r\n&nbsp; &nbsp; Added the base instance script for The Ruby Sanctum.\r\n&nbsp; &nbsp; Added script for Baltharus the Warborn.\r\n&nbsp; &nbsp; Added script for General Zarithrian.\r\n&nbsp; &nbsp; Added script for Saviana Ragefire.\r\n\r\nQuest fixes\r\n\r\n&nbsp; &nbsp; Fixed the Going Bearback quest.\r\n&nbsp; &nbsp; Fixed the Massacre at Light''s Point quest.\r\n&nbsp; &nbsp; Fixed the Projections and Plans quest.\r\n&nbsp; &nbsp; Fixed the A Righteous Sermon quest.\r\n&nbsp; &nbsp; Fixed the The Stave of Equinex quest.\r\n&nbsp; &nbsp; Fixed the The Prophecy of Akida quest.\r\n\r\nSpell fixes\r\n\r\n&nbsp; &nbsp; Fixed the Eradication spell.\r\n&nbsp; &nbsp; Fixed the Haunt spell.\r\n&nbsp; &nbsp; Fixed the Anti-Magic Zone spell.\r\n&nbsp; &nbsp; Fixed the Skeletal Gryphon Escape spell.\r\n&nbsp; &nbsp; Fixed the Item: Druid T10 Restoration 4P set bonus spell.\r\n&nbsp; &nbsp; Fixed the Omen of Clarity spell.\r\n&nbsp; &nbsp; Fixed the Unholy Blight spell.\r\n&nbsp; &nbsp; Fixed the Blade Barrier spell.\r\n&nbsp; &nbsp; Fixed the Magic Rooster mount.\r\n\r\nNPC fixes\r\n\r\n&nbsp; &nbsp; Added script for the Grimscale Murloc NPC.\r\n&nbsp; &nbsp; Added script for the Priest of Rhunok NPC.\r\n&nbsp; &nbsp; Added script for the Iron Rune-Weaver NPC.\r\n&nbsp; &nbsp; Added script for the Shadow Adept NPC.\r\n&nbsp; &nbsp; Added script for the Plagued Proto-Dragon NPC.\r\n&nbsp; &nbsp; Added script for the Grom''tor, Son of Oronok NPC.\r\n&nbsp; &nbsp; Added script for the Coilskar Commander NPC.\r\n&nbsp; &nbsp; Added script for the Onslaught Warhorse NPC.\r\n&nbsp; &nbsp; Added script for the Beryl Treasure Hunter NPC.\r\n&nbsp; &nbsp; Added script for the Stormpeak Wyrm NPC.\r\n&nbsp; &nbsp; Added script for the Ysondre NPC.\r\n&nbsp; &nbsp; Added script for the Emeriss NPC.\r\n&nbsp; &nbsp; Added script for the Taerar NPC.\r\n&nbsp; &nbsp; Added script for the Lethon NPC.\r\n&nbsp; &nbsp; Added missing spawns of the Black Blood of Draenor NPC.\r\n&nbsp; &nbsp; Updated Naxxramas NPC''s pathing.\r\n&nbsp; &nbsp; Updated Pit Of Saron NPC''s pathing.\r\n&nbsp; &nbsp; Updated wildhammer stronghold NPC''s pathing.\r\n\r\nMisc. fixes\r\n\r\n&nbsp; &nbsp; Further optimization to the Dungeon Finder.\r\n&nbsp; &nbsp; Fixed the City Defender achievement.\r\n&nbsp; &nbsp; Re-factored various code regarding auras.\r\n&nbsp; &nbsp; Re-factored various code regarding transports\r\n&nbsp; &nbsp; Various exploit fixes.\r\n&nbsp; &nbsp; Various crash fixes.\r\n&nbsp; &nbsp; Various typo fixes.\r\n</p>', 0, '1309875986', 'July 5, 2011', 'MeoX'),
(97, 'Welcome to AuraWoW.com', '<p>We have just launched our Blizzlike realm with x3 rates.</p>', 0, '1310410012', 'July 11, 2011', 'MeoX');

-- --------------------------------------------------------

--
-- Struktur för tabell `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `link` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `description` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `position` int(11) NOT NULL DEFAULT '1' COMMENT '1 for default 2 for below',
  `orderby` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci COMMENT='Website URL database' AUTO_INCREMENT=85 ;

--
-- Data i tabell `pages`
--

INSERT INTO `pages` (`id`, `title`, `link`, `description`, `position`, `orderby`) VALUES
(82, 'Forum', './#', '', 1, 1),
(83, 'Connection Guide', './quest.php?name=connection_guide', '', 1, 4),
(84, 'Donate[|]2', './quest.php?name=donate', '', 1, 3);

-- --------------------------------------------------------

--
-- Struktur för tabell `paypal_data`
--

CREATE TABLE IF NOT EXISTS `paypal_data` (
  `id` bigint(21) NOT NULL AUTO_INCREMENT,
  `login` varchar(55) COLLATE latin1_general_ci NOT NULL,
  `txnid` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `amount` bigint(21) NOT NULL,
  `who` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `whendon` bigint(100) NOT NULL DEFAULT '0',
  `comment` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci COMMENT='PayPal Information' AUTO_INCREMENT=222 ;

--
-- Data i tabell `paypal_data`
--


-- --------------------------------------------------------

--
-- Struktur för tabell `shop`
--

CREATE TABLE IF NOT EXISTS `shop` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sep` varchar(3) COLLATE latin1_general_ci NOT NULL DEFAULT '0',
  `name` text COLLATE latin1_general_ci NOT NULL,
  `itemid` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `color` tinytext COLLATE latin1_general_ci NOT NULL,
  `cat` varchar(20) COLLATE latin1_general_ci NOT NULL DEFAULT '0',
  `sort` varchar(10) COLLATE latin1_general_ci NOT NULL DEFAULT '0',
  `cost` varchar(11) COLLATE latin1_general_ci NOT NULL DEFAULT '0',
  `charges` varchar(11) COLLATE latin1_general_ci NOT NULL DEFAULT '0',
  `donateorvote` int(5) NOT NULL DEFAULT '0' COMMENT '0 is vote 1 is donation item',
  `description` varchar(255) COLLATE latin1_general_ci DEFAULT 'No Description',
  `custom` varchar(3) COLLATE latin1_general_ci NOT NULL DEFAULT '0',
  `realm` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci COMMENT='Donation Shop' AUTO_INCREMENT=68 ;

--
-- Data i tabell `shop`
--

INSERT INTO `shop` (`id`, `sep`, `name`, `itemid`, `color`, `cat`, `sort`, `cost`, `charges`, `donateorvote`, `description`, `custom`, `realm`) VALUES
(46, '1', 'Mounts', '0', '', '2', '0', '0', '0', 1, 'No Description', '0', 1),
(48, '1', 'Companions', '0', '', '4', '0', '0', '0', 1, 'No Description', '0', 1),
(49, '0', 'Celestial Steed', '54811', '4', '2', '2', '10', '1', 1, 'This is a 280% speed horse mount.', '0', 1),
(50, '0', 'X-53 Touring Rocket', '54860', '4', '2', '3', '10', '1', 1, 'This is a 280% speed duo-seat rocket mount.', '0', 1),
(54, '0', 'Swift Zhevra', '37719', '4', '2', '1', '10', '1', 1, 'This is a 100% speed Zhevra mount.', '0', 1),
(55, '0', 'Lil'' Phylactery', '49693', '3', '4', '1', '5', '1', 1, 'This is a rare companion.', '0', 1),
(56, '0', 'Lil'' XT', '54847', '3', '4', '2', '5', '1', 1, 'This is a rare companion.', '0', 1),
(57, '0', 'Pandaren Monk', '49665', '3', '4', '3', '5', '1', 1, 'This is a rare companion.', '0', 1),
(58, '0', 'Wind Rider Cub', '49663', '3', '4', '4', '5', '1', 1, 'This is a rare companion.', '0', 1),
(59, '0', 'Gryphon Hatcheling', '49662', '3', '4', '5', '5', '1', 1, 'This is a rare companion.', '0', 1),
(64, '0', 'Reins of the Black Proto-Drake', '44164', '4', '2', '4', '15', '1', 1, 'This is a 310% speed Proto-Drake mount.', '0', 1),
(65, '0', 'Reins of the Plagued Proto-Drake', '44175', '4', '2', '5', '15', '1', 1, 'This is a 310% speed Proto-Drake mount.', '0', 1),
(66, '0', 'Deadly Gladiator''s Frostwyrm', '46708', '4', '2', '6', '15', '1', 1, 'This is a 310% speed Frostwyrm mount.', '0', 1),
(67, '0', 'Black Qiraji Resonating Crystal', '21176', '5', '2', '7', '10', '1', 1, 'This is a 100% speed Qiraji mount.', '0', 1);

-- --------------------------------------------------------

--
-- Struktur för tabell `shoutbox`
--

CREATE TABLE IF NOT EXISTS `shoutbox` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user` varchar(25) NOT NULL DEFAULT 'anonimous',
  `message` varchar(255) NOT NULL DEFAULT '',
  `ip` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Shoutbox Database' AUTO_INCREMENT=598 ;

--
-- Data i tabell `shoutbox`
--

INSERT INTO `shoutbox` (`id`, `date`, `user`, `message`, `ip`) VALUES
(590, '2011-03-11 18:54:29', 'admin', 'This is your shoutbox. GM''s will have a GM tag.', '127.0.0.1'),
(591, '2011-07-04 19:29:37', 'MeoX', 'Testing if it works for me :>', '127.0.0.1'),
(594, '2011-07-11 21:17:50', 'iamnumberfour', 'Hello, nice site template man! :D \n\nCould you help me setting this up if I bought it? ', '127.0.0.1'),
(593, '2011-07-11 15:16:06', 'meox', 'Trying to see how this works :>', '127.0.0.1'),
(595, '2011-07-11 21:22:15', 'meox', 'Yes, I could help you through Teamviewer, Msn or Skype :)', '127.0.0.1'),
(596, '2011-07-11 21:26:13', 'iamnumberfour', 'Sweet man! \n\nI''ll add you on msn as soon as possible...', '127.0.0.1'),
(597, '2011-07-12 22:32:31', 'sms', 'Nihihihiihi', '81.230.245.149');

-- --------------------------------------------------------

--
-- Struktur för tabell `vote_costs`
--

CREATE TABLE IF NOT EXISTS `vote_costs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `start_itemlevel` int(10) NOT NULL DEFAULT '0',
  `end_itemlevel` int(10) NOT NULL,
  `points` int(100) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci COMMENT='Vote Shop Costs' AUTO_INCREMENT=15 ;

--
-- Data i tabell `vote_costs`
--

INSERT INTO `vote_costs` (`id`, `start_itemlevel`, `end_itemlevel`, `points`) VALUES
(2, 50, 100, 20),
(1, 1, 50, 10),
(3, 100, 120, 30),
(4, 120, 150, 40),
(5, 150, 180, 50),
(6, 180, 190, 60),
(7, 190, 199, 70),
(8, 200, 210, 80),
(9, 210, 230, 90),
(10, 230, 240, 100),
(11, 240, 250, 110),
(12, 250, 260, 120),
(13, 260, 270, 130),
(14, 271, 280, 140);

-- --------------------------------------------------------

--
-- Struktur för tabell `vote_data`
--

CREATE TABLE IF NOT EXISTS `vote_data` (
  `id` bigint(21) NOT NULL AUTO_INCREMENT,
  `userid` bigint(21) NOT NULL,
  `siteid` bigint(21) NOT NULL,
  `timevoted` bigint(21) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci COMMENT='Voting Data' AUTO_INCREMENT=5467 ;

--
-- Data i tabell `vote_data`
--

INSERT INTO `vote_data` (`id`, `userid`, `siteid`, `timevoted`) VALUES
(5458, 8, 2, 1310546028),
(5457, 8, 1, 1310546027),
(5459, 8, 3, 1310546028),
(5460, 8, 4, 1310546028),
(5461, 8, 5, 1310546029),
(5462, 8, 10, 1310546030),
(5463, 8, 9, 1310546030),
(5464, 8, 8, 1310546030),
(5465, 8, 7, 1310546031),
(5466, 8, 6, 1310546032);

-- --------------------------------------------------------

--
-- Struktur för tabell `vote_items`
--

CREATE TABLE IF NOT EXISTS `vote_items` (
  `entry` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `Quality` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `ItemLevel` smallint(5) unsigned NOT NULL DEFAULT '0',
  `show` enum('yes','no') NOT NULL DEFAULT 'yes',
  `realm` tinyint(4) NOT NULL,
  `custom` tinyint(4) NOT NULL,
  PRIMARY KEY (`entry`),
  KEY `idx_name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED COMMENT='Vote Shop Items';

--
-- Data i tabell `vote_items`
--

INSERT INTO `vote_items` (`entry`, `name`, `Quality`, `ItemLevel`, `show`, `realm`, `custom`) VALUES
(49646, 'Core Hound Pup', 3, 120, 'yes', 1, 0),
(41133, 'Unhatched Mr. Chilly', 3, 120, 'yes', 1, 0),
(34492, 'Rocket Chicken', 3, 120, 'yes', 1, 0),
(32588, 'Banana Charm', 3, 120, 'yes', 1, 0),
(23712, 'Hippogryph Hatchling', 3, 120, 'yes', 1, 0),
(22114, 'Pink Murloc Egg', 3, 120, 'yes', 1, 0),
(20371, 'Blue Murloc Egg', 3, 120, 'yes', 1, 0),
(39286, 'Frosty''s Collar', 3, 120, 'yes', 1, 0),
(38050, 'Soul-Trader Beacon', 3, 120, 'yes', 1, 0),
(35226, 'X-51 Nether-Rocket X-TREME', 4, 240, 'yes', 1, 0),
(38576, 'Big Battle Bear', 4, 180, 'yes', 1, 0),
(49284, 'Swift Spectral Tiger', 4, 180, 'yes', 1, 0),
(23720, 'Riding Turtle', 4, 180, 'yes', 1, 0),
(46802, 'Heavy Murloc Egg', 3, 120, 'yes', 1, 0),
(54069, 'Blazing Hippogryph', 4, 240, 'yes', 1, 0),
(13582, 'Zergling Leash', 3, 120, 'yes', 1, 0),
(56806, 'Mini Thor', 3, 120, 'yes', 1, 0),
(13584, 'Diablo Stone', 3, 120, 'yes', 1, 0),
(25535, 'Netherwhelp''s Collar', 3, 120, 'yes', 1, 0),
(13583, 'Panda Collar', 3, 120, 'yes', 1, 0),
(35227, 'Goblin Weather Machine - Prototype 01-B', 4, 100, 'yes', 1, 0),
(34499, 'Paper Flying Machine Kit', 3, 100, 'yes', 1, 0),
(33223, 'Fishing Chair', 3, 100, 'yes', 1, 0),
(43599, 'Big Blizzard Bear', 3, 180, 'yes', 1, 0),
(30360, 'Lurky''s Egg', 3, 120, 'yes', 1, 0),
(45180, 'Murkimus'' Little Spear', 3, 120, 'yes', 1, 0),
(44819, 'Baby Blizzard Bear', 0, 120, 'yes', 1, 0),
(49362, 'Onyxian Whelpling', 0, 120, 'yes', 1, 0),
(46767, 'Warbot Ignition Key', 3, 120, 'yes', 1, 0),
(46765, 'Blue War Fuel', 3, 100, 'yes', 1, 0),
(46766, 'Red War Fuel', 3, 100, 'yes', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `onebip_data`
--

CREATE TABLE IF NOT EXISTS `onebip_data` (
  `id` bigint(21) NOT NULL AUTO_INCREMENT,
  `payment_id` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `onebip_user` bigint(20) NOT NULL DEFAULT '0',
  `item_code` bigint(10) NOT NULL DEFAULT '0',
  `login` varchar(55) COLLATE latin1_general_ci NOT NULL,
  `country` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `currency` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `price` bigint(10) NOT NULL DEFAULT '0',
  `tax` bigint(10) NOT NULL DEFAULT '0',
  `commission` bigint(10) NOT NULL DEFAULT '0',
  `amount` bigint(10) NOT NULL DEFAULT '0',
  `original_price` bigint(10) NOT NULL DEFAULT '0',
  `original_currency` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comment` text COLLATE latin1_general_ci,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=12313 ;

--
-- Dumping data for table `onebip_data`
--

