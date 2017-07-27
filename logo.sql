-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2015 at 07:26 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ajaicorp_logo`
--

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `productId` int(11) NOT NULL AUTO_INCREMENT,
  `sku` varchar(50) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `color` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `costPrice` int(100) NOT NULL,
  `sellingPrice` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `rdate` varchar(50) DEFAULT NULL,
  `mdate` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`productId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productId`, `sku`, `name`, `color`, `type`, `costPrice`, `sellingPrice`, `quantity`, `rdate`, `mdate`) VALUES
(1, 'isdd19', 'Interlude', 'purple', 'short gown', 0, 4500, 1, '08/06/2015', NULL),
(2, 'isdd12', 'Interlude', 'orange', 'short gown', 0, 5500, 1, '08/06/2015', NULL),
(3, 'isdd43', 'Interlude', 'light purple', 'short gown', 0, 5500, 1, '08/06/2015', NULL),
(4, 'ISDD37', 'INTERLUDE', 'WINE/FLOURED', 'SHORT GOWN', 0, 7500, 1, '08/06/2015', NULL),
(5, 'LDG13', 'iNTERLUDE', 'YELLOW', 'SHORT GOWN', 0, 6500, 1, '08/06/2015', NULL),
(6, 'ldg8', 'Interlude', 'multi coloured', 'short gown', 0, 6500, 1, '08/06/2015', NULL),
(7, 'ldg17', 'interlude', 'light purple', 'short gown', 0, 6500, 1, '08/06/2015', NULL),
(8, 'bdd1', 'Interlude', 'blue/black', 'gown', 0, 5000, 1, '08/06/2015', NULL),
(9, 'ldg4', 'Interlude', 'light blue', 'short gown', 0, 6500, 1, '08/06/2015', NULL),
(10, 'sdd2', 'Elden Court', 'multi coloured', 'Short gown', 0, 5000, 1, '08/06/2015', NULL),
(11, 'lg36', 'Maison', 'black sequence', 'Long gown', 0, 5500, 1, '08/06/2015', NULL),
(12, 'lg018', 'Season Design', 'pattern multi', 'long gown', 0, 3500, 1, '08/06/2015', NULL),
(13, 'BTA88', 'T-WONDER', 'RED', 'UNKNOWN', 0, 2500, 1, '08/06/2015', NULL),
(14, 'JA/MAY', 'NO NAME', 'CHECK MULTI', 'UNKNOWN', 0, 4000, 1, '08/06/2015', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `userId` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` varchar(50) NOT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `username`, `password`, `level`) VALUES
(1, 'admin', 'admin', 'Administrator');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
