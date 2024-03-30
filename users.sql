-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2024 at 04:20 PM
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
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `cmt_id` int(11) NOT NULL,
  `cmt` varchar(200) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `password` varchar(255) NOT NULL,
  `avatar` blob DEFAULT NULL,
  `gender` varchar(100) DEFAULT NULL,
  `bio` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `info`
--

INSERT INTO `info` (`id`, `uname`, `email`, `password`, `avatar`, `gender`, `bio`) VALUES
(4, '', 'rajanbhandari@gmail.com', '$2y$10$iwWGGvYJbWtvX5Z2DZltSO07tmH2S7Ulh0cRwohoUnkDmcUjhn7cq', NULL, NULL, NULL),
(6, '', 'ritukhwalapala@gmail.com', '$2y$10$gtzhPGAmIJf3VmJCk2aUt.WKxQbt45/tW7zridtBwD84EnmMOI/Ta', NULL, NULL, NULL),
(7, 'ritu', 'ritu@gmail.com', '$2y$10$0.awY8eRluE4/G7.lj2KvOyx/01ztcu.jRW4Wsx9qgxZI6i2rs/bm', 0x312e6a7067, 'female', ''),
(12, 'abc', 'abc@gmail.com', '$2y$10$RFPjEfxu9olZDOt3pXC4aemCrfAscLAjNqlLLuZ6AxljGTKdZo36e', NULL, NULL, NULL);

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
  `abstract` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `status` varchar(100) NOT NULL,
  `genre` varchar(100) NOT NULL,
  `language` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `cover_image`, `title`, `abstract`, `description`, `status`, `genre`, `language`, `user_id`, `created_at`, `updated_at`) VALUES
(16, 0x6a696e782e6a7067, 'solo leveling yo!!', 'nfz', 'nmbsfjg', 'completed', 'Adventure', 'English', 7, '2024-03-30 11:18:50', '2024-03-30 11:22:17');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `cmt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `g_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `info`
--
ALTER TABLE `info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `noti`
--
ALTER TABLE `noti`
  MODIFY `n_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
