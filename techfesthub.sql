-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 04, 2020 at 05:55 PM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `techfesthub`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `category_description` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `category_description`, `created`) VALUES
(1, 'Python', 'Python is an interpreted, high-level, general-purpose programming language.Python is an interpreted, high-level, general-purpose programming language. Created by Guido van Rossum. ', '2020-06-21 16:27:10'),
(2, 'JavaScript', 'JavaScript, often abbreviated as JS, is a programming language that conforms to the ECMAScript specification. JavaScript is high-level, often just-in-time compiled, and multi-paradigm.', '2020-06-21 16:28:02'),
(3, 'Django', 'Django is a Python-based free and open-source web framework that follows the model-template-view architectural pattern.', '2020-06-21 18:14:23'),
(4, 'Flask', 'Flask is a micro web framework written in Python. It is classified as a microframework because it does not require particular tools or libraries.', '2020-06-21 18:15:07'),
(5, 'PHP', 'PHP is a popular general-purpose scripting language that is especially suited to web development. It was originally created by Danish-Canadian programmer Rasmus Lerdorf in 1994.', '2020-06-21 18:20:54'),
(6, 'C Language', 'C is a general-purpose, procedural computer programming language supporting structured programming, lexical variable scope, and recursion, with a static type system.', '2020-07-04 23:05:02'),
(7, 'C++', 'C++ is a general-purpose programming language created by Bjarne Stroustrup as an extension of the C programming language, or &quot;C with Classes&quot;.', '2020-07-04 23:12:32');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_description` text COLLATE utf8mb4_bin NOT NULL,
  `comment_thread_id` int(11) NOT NULL,
  `comment_by` int(11) NOT NULL,
  `comment_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`comment_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `threads`
--

DROP TABLE IF EXISTS `threads`;
CREATE TABLE IF NOT EXISTS `threads` (
  `thread_id` int(11) NOT NULL AUTO_INCREMENT,
  `thread_title` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `thread_description` text COLLATE utf8mb4_bin NOT NULL,
  `thread_category_id` int(11) NOT NULL,
  `thread_user_id` int(11) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`thread_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(40) COLLATE utf8mb4_bin NOT NULL,
  `user_email` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `user_password` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `user_pic` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `user_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `threads`
--
ALTER TABLE `threads` ADD FULLTEXT KEY `thread_title` (`thread_title`,`thread_description`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
