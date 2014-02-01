-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 01, 2014 at 08:03 PM
-- Server version: 5.5.35
-- PHP Version: 5.3.10-1ubuntu3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `flowershop`
--
CREATE DATABASE `flowershop` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `flowershop`;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `cart_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `flower_id` int(11) NOT NULL,
  `cart_status` int(11) NOT NULL,
  PRIMARY KEY (`cart_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  `category_type` int(11) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_type`) VALUES
(1, 'vase', 1),
(2, 'weeee', 2);

-- --------------------------------------------------------

--
-- Table structure for table `flower`
--

CREATE TABLE IF NOT EXISTS `flower` (
  `flower_id` int(11) NOT NULL AUTO_INCREMENT,
  `category` int(11) NOT NULL,
  `flower_name` varchar(255) NOT NULL,
  `flower_description` text NOT NULL,
  `flower_price` int(11) NOT NULL,
  `flower_type` int(11) NOT NULL,
  `flower_category` int(11) NOT NULL,
  `flower_status` int(11) NOT NULL,
  PRIMARY KEY (`flower_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `flower`
--

INSERT INTO `flower` (`flower_id`, `category`, `flower_name`, `flower_description`, `flower_price`, `flower_type`, `flower_category`, `flower_status`) VALUES
(1, 1, 'Gumamela', 'Gumamela is a Philippine flower.', 1000, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `flower_image`
--

CREATE TABLE IF NOT EXISTS `flower_image` (
  `flower_img_id` int(11) NOT NULL AUTO_INCREMENT,
  `flower_img_name` varchar(255) NOT NULL,
  `flower_id` int(11) NOT NULL,
  `flower_main` int(11) NOT NULL,
  PRIMARY KEY (`flower_img_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `flower_image`
--

INSERT INTO `flower_image` (`flower_img_id`, `flower_img_name`, `flower_id`, `flower_main`) VALUES
(1, 'bedee5c9efe2385cc74e388eceab01c4.jpg', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(111) NOT NULL,
  `flower_id` int(11) NOT NULL,
  `payment` int(11) NOT NULL,
  `receiver` varchar(255) NOT NULL,
  `receiver_no` varchar(255) NOT NULL,
  `delivery_date` datetime NOT NULL,
  `quantity` int(11) NOT NULL,
  `receiver_address` varchar(255) NOT NULL,
  `card_message` text NOT NULL,
  `order_status` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `suggestions` text NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `flower_id`, `payment`, `receiver`, `receiver_no`, `delivery_date`, `quantity`, `receiver_address`, `card_message`, `order_status`, `order_date`, `suggestions`) VALUES
(1, 1, 1, 0, 'Keanna', '09055872181', '2014-01-01 01:59:00', 15, 'asd', 'asdasdasd', 4, '2014-01-20', 'asdasdasd'),
(2, 1, 1, 0, 'asdasd', '1233123123', '0000-00-00 00:00:00', 23, 'asdasdasd', 'asdasd', 1, '2014-01-25', 'asdasdasd');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_name` varchar(255) NOT NULL,
  PRIMARY KEY (`payment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_level` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_address` text NOT NULL,
  `user_birthday` date NOT NULL,
  `user_favorite` int(11) NOT NULL,
  `user_status` int(11) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_level`, `user_name`, `user_password`, `user_email`, `user_address`, `user_birthday`, `user_favorite`, `user_status`) VALUES
(1, 1, 'Keanna', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'admin@flowershop.com', 'Purok 9, Brgy Aguisan, Himamaylan City, Negros Occidental', '1990-05-01', 1, 0),
(2, 0, 'Juan Dela Cruz', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'juan@delacruz.com', '', '0000-00-00', 0, 0),
(3, 0, 'Jaylord Ferrer', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'simplyniceweb@gmail.com', '', '0000-00-00', 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
