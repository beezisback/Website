-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL version:             7.0.0.4153
-- Date/time:                    2012-06-19 17:10:14
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;


-- Dumping structure for table heaven.vote_log
CREATE TABLE IF NOT EXISTS `vote_log` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `site` int(32) DEFAULT NULL,
  `type` varchar(32) DEFAULT NULL,
  `user` varchar(64) DEFAULT NULL,
  `cost` int(32) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table heaven.vote_log: ~0 rows (approximately)
/*!40000 ALTER TABLE `vote_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `vote_log` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
