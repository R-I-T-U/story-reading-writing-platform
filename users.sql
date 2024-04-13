-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 13, 2024 at 09:30 AM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `users`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `cmt_id` int NOT NULL AUTO_INCREMENT,
  `cmt` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `post_id` int NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`cmt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

DROP TABLE IF EXISTS `genre`;
CREATE TABLE IF NOT EXISTS `genre` (
  `g_id` int NOT NULL AUTO_INCREMENT,
  `g_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`g_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`g_id`, `g_name`) VALUES
(1, 'Adventure'),
(2, 'Comedy'),
(3, 'Horror'),
(4, 'Mystery'),
(5, 'Paranormal'),
(6, 'Science fiction');

-- --------------------------------------------------------

--
-- Table structure for table `info`
--

DROP TABLE IF EXISTS `info`;
CREATE TABLE IF NOT EXISTS `info` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uname` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `avatar` blob,
  `gender` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `bio` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `info`
--

INSERT INTO `info` (`id`, `uname`, `email`, `password`, `avatar`, `gender`, `bio`) VALUES
(4, '', 'rajanbhandari@gmail.com', '$2y$10$iwWGGvYJbWtvX5Z2DZltSO07tmH2S7Ulh0cRwohoUnkDmcUjhn7cq', NULL, NULL, NULL),
(6, '', 'ritukhwalapala@gmail.com', '$2y$10$gtzhPGAmIJf3VmJCk2aUt.WKxQbt45/tW7zridtBwD84EnmMOI/Ta', NULL, NULL, NULL),
(13, 'ritu', 'ritu@gmail.com', '$2y$10$DDiQqu0JG8Z7wl5.c2CPzONRbOD4TZP1XfiRN5UpU749pO7Yk5x2G', 0x6a696e782e6a7067, 'female', '');

-- --------------------------------------------------------

--
-- Table structure for table `noti`
--

DROP TABLE IF EXISTS `noti`;
CREATE TABLE IF NOT EXISTS `noti` (
  `n_id` int NOT NULL AUTO_INCREMENT,
  `cmt_id` int NOT NULL,
  `cmt` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `postId` int NOT NULL,
  `userId` int NOT NULL,
  PRIMARY KEY (`n_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cover_image` blob NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `abstract` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `status` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `genre` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `state` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `cover_image`, `title`, `abstract`, `description`, `status`, `genre`, `user_id`, `created_at`, `updated_at`, `state`) VALUES
(18, 0x41736c2e6a7067, 'helo', 'jn', 'hb', 'pending', 'Adventure', 13, '2024-04-13 09:18:30', '2024-04-13 09:18:30', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
