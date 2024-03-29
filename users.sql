-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2024 at 09:16 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
-- Table structure for table `chapter`
--

CREATE TABLE `chapter` (
  `chap_id` int(11) NOT NULL,
  `chap_title` varchar(255) NOT NULL,
  `chap_description` text NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chapter`
--

INSERT INTO `chapter` (`chap_id`, `chap_title`, `chap_description`, `post_id`, `user_id`) VALUES
(1, 'jinx', 'While most look at Jinx and see only a mad woman wielding an array of dangerous weapons, a few remember her as a relatively innocent girl froJinx first gained notoriety through her anonymous “pranks” on the citizens of Piltover… particularly those with connections to the wealthy merchant clans. These pranks ranged from the moderately annoying to the criminally dangerous. She blocked streets on Progress Day, with a stampede of exotic animals freed from Count Mei’s menagerie. She disrupted trade for weeks when she lined the city’s iconic bridges with adorably destructive flame chompers. Once, she even managed to move every street sign in town to new and utterly confusing locations.\r\n', 1, 2),
(2, 'sample', 'this is testing .......', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `cmt_id` int(11) NOT NULL,
  `cmt` varchar(200) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`cmt_id`, `cmt`, `post_id`, `user_id`) VALUES
(1, 'helo', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `g_id` int(11) NOT NULL,
  `g_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

CREATE TABLE `info` (
  `id` int(11) NOT NULL,
  `uname` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `info`
--

INSERT INTO `info` (`id`, `uname`, `email`, `password`) VALUES
(2, '', 'abc@gmail.com', '$2y$10$NdYJmyGcfOKEhykS4wuKyeo30RqO59md47ID7hVN4j6Wa/Xku5z.S'),
(4, '', 'rajanbhandari@gmail.com', '$2y$10$iwWGGvYJbWtvX5Z2DZltSO07tmH2S7Ulh0cRwohoUnkDmcUjhn7cq'),
(6, '', 'ritukhwalapala@gmail.com', '$2y$10$gtzhPGAmIJf3VmJCk2aUt.WKxQbt45/tW7zridtBwD84EnmMOI/Ta'),
(7, 'ritu', 'ritu@gmail.com', '$2y$10$uXylhxlAaaiOtDrN07hgN.wpU1aj47oPl2RJJRf8358p6GtOmzNBS');

-- --------------------------------------------------------

--
-- Table structure for table `noti`
--

CREATE TABLE `noti` (
  `n_id` int(11) NOT NULL,
  `cmt_id` int(11) NOT NULL,
  `cmt` varchar(200) NOT NULL,
  `postId` int(11) NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `cover_image` blob NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `genre` varchar(100) NOT NULL,
  `language` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `cover_image`, `title`, `description`, `genre`, `language`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 0x6a696e782e6a7067, 'jinx', 'While most look at Jinx and see only a mad woman wielding an array of dangerous weapons, a few remember her as a relatively innocent girl froJinx first gained notoriety through her anonymous “pranks” on the citizens of Piltover… particularly those with connections to the wealthy merchant clans. These pranks ranged from the moderately annoying to the criminally dangerous. She blocked streets on Progress Day, with a stampede of exotic animals freed from Count Mei’s menagerie. She disrupted trade for weeks when she lined the city’s iconic bridges with adorably destructive flame chompers. Once, she even managed to move every street sign in town to new and utterly confusing locations.\r\n', 'Adventure', 'English', 2, '2024-03-26 20:18:20', '2024-03-26 20:18:20'),
(2, 0x41736c2e6a7067, 'solo leveling', 'They reach an iron-mesh platform attached to a collimated series of rails angled down toward the ocean and docks below. Hundreds of ships throng the wide channel, moored in the shadow of the titanic form of the Sun Gates that allow sea transit from east to west. Some are just passing through, whil', 'Paranormal', 'English', 2, '2024-03-26 20:18:56', '2024-03-26 20:18:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chapter`
--
ALTER TABLE `chapter`
  ADD PRIMARY KEY (`chap_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`cmt_id`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`g_id`);

--
-- Indexes for table `info`
--
ALTER TABLE `info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `noti`
--
ALTER TABLE `noti`
  ADD PRIMARY KEY (`n_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chapter`
--
ALTER TABLE `chapter`
  MODIFY `chap_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `cmt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `g_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `info`
--
ALTER TABLE `info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `noti`
--
ALTER TABLE `noti`
  MODIFY `n_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
