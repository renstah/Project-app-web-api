-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.20 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             9.2.0.4956
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for speet
CREATE DATABASE IF NOT EXISTS `speet` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `speet`;


-- Dumping structure for table speet.category
CREATE TABLE IF NOT EXISTS `category` (
  `CategoryID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
  PRIMARY KEY (`CategoryID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table speet.category_item
CREATE TABLE IF NOT EXISTS `category_item` (
  `CategoryItemID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL DEFAULT '0',
  `CategoryID` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`CategoryItemID`),
  KEY `FK_category_item_category` (`CategoryID`),
  CONSTRAINT `FK_category_item_category` FOREIGN KEY (`CategoryID`) REFERENCES `category` (`CategoryID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table speet.event
CREATE TABLE IF NOT EXISTS `event` (
  `EventID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
  `Date_Start` datetime NOT NULL,
  `Date_End` datetime DEFAULT NULL,
  `Latitude` decimal(9,6) DEFAULT NULL,
  `Longitude` decimal(9,6) DEFAULT NULL,
  `Age_Min` tinyint(4) DEFAULT NULL,
  `Age_Max` tinyint(4) DEFAULT NULL,
  `CreatorID` int(11) unsigned NOT NULL,
  `CategoryID` int(11) unsigned NOT NULL,
  `GenderID` tinyint(4) unsigned NOT NULL,
  `Created_DateTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`EventID`),
  KEY `FK_event_gender` (`GenderID`),
  KEY `FK_event_category_item` (`CategoryID`),
  KEY `FK_event_user` (`CreatorID`),
  CONSTRAINT `FK_event_category_item` FOREIGN KEY (`CategoryID`) REFERENCES `category_item` (`CategoryItemID`),
  CONSTRAINT `FK_event_gender` FOREIGN KEY (`GenderID`) REFERENCES `gender` (`GenderID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_event_user` FOREIGN KEY (`CreatorID`) REFERENCES `user` (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table speet.event_users
CREATE TABLE IF NOT EXISTS `event_users` (
  `EventID` int(11) unsigned NOT NULL,
  `UserID` int(11) unsigned NOT NULL,
  PRIMARY KEY (`EventID`,`UserID`),
  KEY `FK_event_users_user` (`UserID`),
  CONSTRAINT `FK_event_users_event` FOREIGN KEY (`EventID`) REFERENCES `event` (`EventID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_event_users_user` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table speet.gender
CREATE TABLE IF NOT EXISTS `gender` (
  `GenderID` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`GenderID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table speet.user
CREATE TABLE IF NOT EXISTS `user` (
  `UserID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
  `Social_Token` varchar(50) NOT NULL,
  `DateOfBirth` date NOT NULL,
  `GenderID` tinyint(4) unsigned NOT NULL,
  `Created_DateTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`UserID`),
  KEY `FK_user_gender` (`GenderID`),
  CONSTRAINT `FK_user_gender` FOREIGN KEY (`GenderID`) REFERENCES `gender` (`GenderID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
