-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 02, 2013 at 01:59 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `kfs`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin'),
(2, 'coh', 'coh');

-- --------------------------------------------------------

--
-- Table structure for table `advertisement`
--

CREATE TABLE IF NOT EXISTS `advertisement` (
  `adID` int(10) NOT NULL AUTO_INCREMENT,
  `advertisementName` varchar(50) NOT NULL,
  `advertisementDesc` varchar(500) NOT NULL,
  `date_added` date NOT NULL,
  UNIQUE KEY `adID` (`adID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `advertisement`
--

INSERT INTO `advertisement` (`adID`, `advertisementName`, `advertisementDesc`, `date_added`) VALUES
(5, 'Valentines', '', '2013-09-29'),
(6, 'Valentines banner', '', '2013-09-29'),
(7, 'Christmas', '', '2013-09-29');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `catid` int(10) NOT NULL AUTO_INCREMENT,
  `catname` varchar(50) NOT NULL,
  `catdesc` varchar(150) NOT NULL,
  PRIMARY KEY (`catid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=46 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`catid`, `catname`, `catdesc`) VALUES
(44, 'Box', ''),
(45, 'Centerpiece', '');

-- --------------------------------------------------------

--
-- Table structure for table `orderstatus`
--

CREATE TABLE IF NOT EXISTS `orderstatus` (
  `orderstatusid` int(10) NOT NULL AUTO_INCREMENT,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`orderstatusid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `orderstatus`
--

INSERT INTO `orderstatus` (`orderstatusid`, `status`) VALUES
(1, 'Pending'),
(2, 'Processing'),
(3, 'Delivered'),
(4, 'Cancel');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE IF NOT EXISTS `packages` (
  `packID` int(10) NOT NULL AUTO_INCREMENT,
  `packagename` varchar(50) NOT NULL,
  `packagedesc` varchar(500) NOT NULL,
  `date_added` date NOT NULL,
  PRIMARY KEY (`packID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`packID`, `packagename`, `packagedesc`, `date_added`) VALUES
(6, 'Wedding', '', '2013-10-01'),
(7, 'Mothers Day', '', '2013-10-01');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `pid` int(10) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(50) NOT NULL,
  `price` varchar(20) NOT NULL,
  `date_added` date NOT NULL,
  `category` varchar(100) NOT NULL,
  `details` varchar(100) NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pid`, `product_name`, `price`, `date_added`, `category`, `details`) VALUES
(1, 'white rose', '300', '2013-06-27', 'Vase', 'half dozen of white rose in vase'),
(2, 'red rose', '500', '2013-07-23', 'Bouquet', 'asdfasdfasdfasdf'),
(19, 'red roses', '500', '2013-10-01', 'Centerpiece', 'fafafafafaf'),
(17, 'testing', '234', '2013-09-29', 'Vase', 'sdfasdf'),
(11, 'spring flowers', '300', '2013-09-16', 'Basket', 'good for centerpiiece'),
(15, 'red roses', '1000', '2013-09-17', 'Box', 'half dozen of red roses in vase with red ribbon cake'),
(16, 'spring flowers', '500', '2013-09-17', 'Centerpiece', 'assorted flowers in a vase');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE IF NOT EXISTS `reservation` (
  `resid` int(10) NOT NULL AUTO_INCREMENT,
  `senderusername` varchar(50) NOT NULL,
  `senderfname` varchar(50) NOT NULL,
  `sendercontact` int(10) NOT NULL,
  `senderemail` varchar(50) NOT NULL,
  `receivername` varchar(50) NOT NULL,
  `receivercontact` varchar(20) NOT NULL,
  `receiveradd` varchar(500) NOT NULL,
  `cardmessage` varchar(500) NOT NULL,
  `datetodeliver` date NOT NULL,
  `timetodeliver` time NOT NULL,
  `pid` int(10) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `productdesc` varchar(250) NOT NULL,
  `price` int(10) NOT NULL,
  `date_added` datetime NOT NULL,
  `refnumber` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`resid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`resid`, `senderusername`, `senderfname`, `sendercontact`, `senderemail`, `receivername`, `receivercontact`, `receiveradd`, `cardmessage`, `datetodeliver`, `timetodeliver`, `pid`, `product_name`, `productdesc`, `price`, `date_added`, `refnumber`, `status`) VALUES
(1, 'coh', 'marco barangan', 2147483647, 'barangan.marco@yahoo.com', 'asdfasdff', '3234234234', 'adsfasdfkaksjdf.sdkflasdkf;lk,asdf', 'lakdsfakadskadsfkjadsf', '2013-11-02', '11:11:00', 16, 'spring flowers', 'assorted flowers in a vase', 500, '2013-10-01 14:52:49', '9393j3r9f9h', 'Processing'),
(2, 'mark', 'mark pogi', 2147483647, 'mharck_07@yahoo.com', 'asdfasdfasdfasdfasdfasd', 'adsfasdfasdfasdf', 'lalaladladlads', ',.adflasdfl;amds;flas', '2013-10-18', '11:11:00', 16, 'spring flowers', 'assorted flowers in a vase', 500, '2013-10-01 15:31:49', '234234', 'Processing');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `userid` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `address` varchar(500) NOT NULL,
  `bdate` date NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `date_added` date NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `username`, `password`, `fname`, `address`, `bdate`, `email`, `contact`, `date_added`) VALUES
(9, 'nene', 'nene', 'nene magalpok', 'asdflll ooekkdfl;kadf;m', '2013-09-04', 'sdfasdfadsf@yahoo.com', '0983736272', '0000-00-00'),
(6, 'coh', 'coh', 'marco barangan', 'blk 11 lot 5 ciudad real subdivion, san jose del monte bulacan', '2008-06-11', 'barangan.marco@yahoo.com', '09487266733', '2013-06-27'),
(16, 'barugo', 'barugo', 'barugo magalpo', 'bankers village,quirino hi way,caloocan city', '1979-10-24', 'barugo@yahoo.com', '09098383833', '2013-09-27'),
(23, 'mark', 'mark', 'mark pogi', 'Secret', '1993-10-20', 'mharck_07@yahoo.com', '09284458239', '2013-09-29');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
