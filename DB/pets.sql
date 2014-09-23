-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 23, 2014 at 05:07 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pets`
--

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE IF NOT EXISTS `ads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desc` text,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(45) DEFAULT NULL,
  `country` int(11) DEFAULT NULL,
  `city` int(11) DEFAULT NULL,
  `pet_id` int(11) DEFAULT NULL,
  `time_added` int(11) DEFAULT NULL,
  `date_added` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pet_id_idx` (`pet_id`),
  KEY `user_id_idx` (`user_id`),
  KEY `country_id_idx` (`country`),
  KEY `city_id_idx` (`city`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE IF NOT EXISTS `cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `country` int(11) DEFAULT NULL,
  `key` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `country_id_idx` (`country`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `key` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key_UNIQUE` (`key`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `attempts` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `login_attempts`
--

INSERT INTO `login_attempts` (`id`, `user_id`, `attempts`, `time`) VALUES
(1, 0, 8, 1411213997);

--
-- Triggers `login_attempts`
--
DROP TRIGGER IF EXISTS `uau_users`;
DELIMITER //
CREATE TRIGGER `uau_users` AFTER UPDATE ON `login_attempts`
 FOR EACH ROW BEGIN

IF NEW.attempts >= 7 THEN

UPDATE `users` SET `is_blocked` = '1' 
WHERE `id` = NEW.user_id;

END IF;

END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `pass_return`
--

CREATE TABLE IF NOT EXISTS `pass_return` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `sent` int(11) NOT NULL,
  `last_time` int(11) NOT NULL,
  `last_date` int(11) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pets`
--

CREATE TABLE IF NOT EXISTS `pets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pet_name` varchar(45) DEFAULT NULL,
  `pet_cat` int(11) DEFAULT NULL,
  `pet_var` int(11) DEFAULT NULL,
  `time_added` int(11) DEFAULT NULL,
  `date_added` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pet_name_UNIQUE` (`pet_name`),
  KEY `cat_id_idx` (`pet_cat`),
  KEY `var_id_idx` (`pet_var`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pets_categories`
--

CREATE TABLE IF NOT EXISTS `pets_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(45) DEFAULT NULL,
  `time_added` int(11) DEFAULT NULL,
  `date_added` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cat_name_UNIQUE` (`cat_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pets_variations`
--

CREATE TABLE IF NOT EXISTS `pets_variations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `var_name` varchar(45) DEFAULT NULL,
  `time_added` int(11) DEFAULT NULL,
  `date_added` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pets_variationscol_UNIQUE` (`var_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(150) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `fname` varchar(45) DEFAULT NULL,
  `lname` varchar(45) DEFAULT NULL,
  `country` int(11) DEFAULT NULL,
  `city` int(11) DEFAULT NULL,
  `is_blocked` tinyint(4) NOT NULL,
  `time_added` int(11) DEFAULT NULL,
  `date_added` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `country_id_idx` (`country`),
  KEY `city_id_idx` (`city`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `username`, `fname`, `lname`, `country`, `city`, `is_blocked`, `time_added`, `date_added`) VALUES
(1, 'hellboyon@gmail.com', '9a57acad6a57183e32968f137dcdb4b2', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(3, 'celicalderon@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'asdasd', NULL, NULL, NULL, NULL, 0, 1411383863, 2091);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ads`
--
ALTER TABLE `ads`
  ADD CONSTRAINT `ads_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `ads_ibfk_2` FOREIGN KEY (`country`) REFERENCES `countries` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `ads_ibfk_3` FOREIGN KEY (`city`) REFERENCES `cities` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `ads_ibfk_4` FOREIGN KEY (`pet_id`) REFERENCES `pets` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_ibfk_2` FOREIGN KEY (`country`) REFERENCES `countries` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `pets`
--
ALTER TABLE `pets`
  ADD CONSTRAINT `pets_ibfk_1` FOREIGN KEY (`pet_cat`) REFERENCES `pets_categories` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `pets_ibfk_2` FOREIGN KEY (`pet_var`) REFERENCES `pets_variations` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`country`) REFERENCES `countries` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`city`) REFERENCES `cities` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
