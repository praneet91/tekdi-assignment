-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2017 at 07:50 PM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tekdi`
--

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `country_id` int(11) NOT NULL,
  `country_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`country_id`, `country_name`) VALUES
(1, 'India'),
(2, 'USA'),
(3, 'Canada'),
(4, 'France');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL,
  `country` int(11) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `about` varchar(255) DEFAULT NULL,
  `birthday` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `country`, `name`, `email`, `mobile`, `about`, `birthday`) VALUES
(1, 1, 'Praneet Shrivastava', 'praneet@gmail.com', '1124455454', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '1997-01-01'),
(2, 2, 'Nitin Sharma', 'raj@gmail.com', '5645454454', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '2017-03-20'),
(3, 1, 'Jaydeep Kothari', 'jaydeep@gmail.com', '1545454544', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '2017-03-20'),
(4, 3, 'Test1', 'test1@gmail.com', '4545645454', 'Test demo', '2009-01-27'),
(5, 1, 'Test2', 'test2@gmail.com', '4548645545', 'Demo', '2017-03-29'),
(6, 4, 'Demo', 'demo@gmail.com', '4864545454', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.\r\n', '2017-03-20'),
(7, 1, 'Demo2', 'demo2@gmail.com', '5845646545', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '2017-03-20'),
(8, 4, 'Demo3', 'demo3@gmail.com', '5346854545', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '2017-03-20'),
(9, 1, 'Demo44', 'demo4@gmail.com', '5545455544', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '2017-03-21'),
(10, 3, 'Praneet1', 'praneet1@gmail.com', '4454545454', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '2017-03-21'),
(11, 3, 'Praneet2', 'praneet2@gmail.com', '4154545454', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '2017-03-14'),
(12, 2, 'praneet3', 'praneet3@gmail.com', '4545454444', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '2017-03-20'),
(13, 3, 'praneet4', 'praneet4@gmail.com', '5454445455', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '2017-03-20'),
(14, 1, 'praneet5', 'praneet5@gmail.com', '5454545545', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '2017-03-20'),
(15, 1, 'Praneet6', 'praneet6@gmail.com', '5484545444', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '2017-03-29'),
(16, 3, 'Demo145', 'demo145@gmail.com', '4546445445', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '2017-03-20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`), ADD KEY `country` (`country`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`country`) REFERENCES `countries` (`country_id`),
ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`country`) REFERENCES `countries` (`country_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
