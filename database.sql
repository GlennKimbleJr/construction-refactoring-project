-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Table structure for table `bid_contactors`
--

DROP TABLE IF EXISTS `bid_contactors`;
CREATE TABLE IF NOT EXISTS `bid_contactors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `category` tinytext NOT NULL,
  `status` tinytext NOT NULL,
  `win` tinytext NOT NULL,
  `email` tinytext NOT NULL,
  `score` tinytext NOT NULL,
  `company` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first` tinytext NOT NULL,
  `last` tinytext NOT NULL,
  `street` tinytext NOT NULL,
  `city` tinytext NOT NULL,
  `state` tinytext NOT NULL,
  `zone` tinytext NOT NULL,
  `email` tinytext NOT NULL,
  `officephone` tinytext NOT NULL,
  `cellphone` tinytext NOT NULL,
  `fax` tinytext NOT NULL,
  `type` tinytext NOT NULL,
  `company` tinytext NOT NULL,
  `zip` tinytext NOT NULL,
  `zone2` tinytext NOT NULL,
  `zone3` tinytext NOT NULL,
  `zone4` tinytext NOT NULL,
  `zone5` tinytext NOT NULL,
  `zone6` tinytext NOT NULL,
  `zone7` tinytext NOT NULL,
  `zone8` tinytext NOT NULL,
  `zone9` tinytext NOT NULL,
  `score_per` tinytext NOT NULL,
  `bid_per` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

DROP TABLE IF EXISTS `project`;
CREATE TABLE IF NOT EXISTS `project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` tinytext NOT NULL,
  `bidduedate` tinytext NOT NULL,
  `completedate` tinytext NOT NULL,
  `zone` tinytext NOT NULL,
  `plans` text NOT NULL,
  `location` tinytext NOT NULL,
  `planuser` tinytext NOT NULL,
  `planpass` tinytext NOT NULL,
  `owner_name` tinytext NOT NULL,
  `owner_phone` tinytext NOT NULL,
  `super_name` tinytext NOT NULL,
  `super_phone` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Table structure for table `super`
--

DROP TABLE IF EXISTS `super`;
CREATE TABLE IF NOT EXISTS `super` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` tinytext NOT NULL,
  `phone` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

DROP TABLE IF EXISTS `type`;
CREATE TABLE IF NOT EXISTS `type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

-- --------------------------------------------------------

--
-- Table structure for table `zone`
--

DROP TABLE IF EXISTS `zone`;
CREATE TABLE IF NOT EXISTS `zone` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
