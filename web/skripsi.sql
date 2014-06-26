-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 26, 2014 at 03:34 PM
-- Server version: 5.5.27-log
-- PHP Version: 5.4.24

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `skripsi`
--

-- --------------------------------------------------------

--
-- Table structure for table `iqrf_device`
--

CREATE TABLE IF NOT EXISTS `iqrf_device` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `node_address` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `iqrf_device`
--

INSERT INTO `iqrf_device` (`id`, `timestamp`, `node_address`) VALUES
(1, '2013-12-29 12:46:11', 7),
(2, '2013-12-29 12:59:33', 8),
(3, '2013-12-29 12:59:33', 9);

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE IF NOT EXISTS `profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `profile_name` varchar(60) NOT NULL,
  `iqrf_node` int(11) NOT NULL DEFAULT '0',
  `iqrf_temperature` int(11) NOT NULL DEFAULT '27',
  `xbee_atmy` int(11) NOT NULL DEFAULT '2',
  `xbee_relay1` tinyint(1) NOT NULL DEFAULT '0',
  `xbee_relay2` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `full_name` varchar(60) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(64) NOT NULL,
  `superuser` tinyint(1) NOT NULL DEFAULT '0',
  `logged_in` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `timestamp`, `full_name`, `username`, `password`, `superuser`, `logged_in`) VALUES
(1, '0000-00-00 00:00:00', 'Guntur D Putra', 'gtrdp', '7694f4a66316e53c8cdd9d9954bd611d', 1, 0),
(2, '0000-00-00 00:00:00', 'Administrator', 'admin', '7694f4a66316e53c8cdd9d9954bd611d', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `xbee_device`
--

CREATE TABLE IF NOT EXISTS `xbee_device` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `atmy` int(11) NOT NULL,
  `relay1` tinyint(1) NOT NULL DEFAULT '0',
  `relay2` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `xbee_device`
--

INSERT INTO `xbee_device` (`id`, `timestamp`, `atmy`, `relay1`, `relay2`) VALUES
(1, '2013-12-29 12:46:25', 5, 0, 0),
(2, '2013-12-29 13:00:45', 2, 0, 0),
(3, '2013-12-29 13:00:45', 3, 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
