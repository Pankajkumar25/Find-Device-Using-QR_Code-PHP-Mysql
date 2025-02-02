-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 31, 2022 at 04:03 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `qr_spic`
--

-- --------------------------------------------------------

--
-- Table structure for table `mail`
--

CREATE TABLE IF NOT EXISTS `mail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_email` varchar(100) NOT NULL,
  `subject` varchar(500) NOT NULL,
  `msg` varchar(1000) NOT NULL,
  `footer` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `mail`
--

INSERT INTO `mail` (`id`, `from_email`, `subject`, `msg`, `footer`) VALUES
(1, 'spicindia@gmail.com', 'testing mail', 'hello ', 'spic');

-- --------------------------------------------------------

--
-- Table structure for table `qr`
--

CREATE TABLE IF NOT EXISTS `qr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL,
  `email_id` varchar(100) NOT NULL,
  `mobile_number` int(11) NOT NULL,
  `number_of_ticket` int(11) NOT NULL,
  `qr_path` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `qr`
--

INSERT INTO `qr` (`id`, `user_name`, `email_id`, `mobile_number`, `number_of_ticket`, `qr_path`) VALUES
(42, '9879', 'gurcharanit@gmail.com', 79, 87, 'testd03d0e3f332a367b1ca3e4a5704275f5.png'),
(41, '9879', 'gurcharanit@gmail.com', 79, 76, 'test3da6585ced1b2693c287572ce845ecb4.png'),
(40, 'oiu', 'gurcharanit@gmail.com', 987, 7, 'testebc6b57cc4b14c70955c12f8618055d8.png'),
(39, 'oiu', 'gurcharanit@gmail.com', 9879789, 7, 'test4da3fa2ed2b9efee00fe8a3c7202bc5f.png'),
(38, 'SDAHK', 'gurcharanit@gmail.com', 9879789, 7, 'test257f865e99f66e698d09676372a939ea.png'),
(37, 'SDAHK', 'gurcharanit@gmail.com', 9879789, 7, 'test257f865e99f66e698d09676372a939ea.png'),
(35, 'gurcharan singh', 'gurcharanit@gmail.com', 2147483647, 6, 'test6f03501d72fbc13d053931aca787b028.png'),
(36, 'SDAHK', 'gurcharanit@gmail.com', 9879789, 7, 'test257f865e99f66e698d09676372a939ea.png'),
(43, 'gurcharan singh', 'gurcharanit@gmail.com', 2147483647, 3, 'testd03d0e3f332a367b1ca3e4a5704275f5.png'),
(44, 'asdiuyiu', 'test@gmail.com', 8798797, 9898, 'testd03d0e3f332a367b1ca3e4a5704275f5.png'),
(45, '9879779', 'test@gmail.com', 987987, 8979, 'test16ae057915ec2556658a4d88d411b835.png'),
(46, '897979', 'test@gmail.com', 987987, 9087879, 'test16ae057915ec2556658a4d88d411b835.png'),
(47, 'test', 'test@gmail.com', 2147483647, 9887666, 'testbf3604b714a7af527b4bafad410077f6.png');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
