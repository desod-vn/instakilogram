-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: database:3306
-- Generation Time: May 13, 2022 at 01:48 PM
-- Server version: 8.0.29
-- PHP Version: 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `docker`
--

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int NOT NULL,
  `src` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'public',
  `description` text,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `src`, `level`, `description`, `email`, `created_at`) VALUES
(1, 'src/uploads/posts/favicon-2112259047.png', 'pulic', 'ád', '', '2022-05-05 05:16:24'),
(2, 'src/uploads/posts/favicon-1691258553.png', 'pulic', 'ád', '', '2022-05-05 05:45:47'),
(3, 'src/uploads/posts/favicon-1318541201.png', 'pulic', 'ád', '', '2022-05-05 05:45:57'),
(4, 'src/uploads/posts/favicons-removebg-preview-1251318275.png', 'logged', 'ádasdsax', '', '2022-05-05 05:47:36'),
(8, 'src/uploads/posts/278977520_558433495641747_4882793388850233874_n-2076371826.jpg', 'logged', 'aaa', '', '2022-05-05 06:27:13'),
(9, 'src/uploads/posts/278977520_558433495641747_4882793388850233874_n-1478530859.jpg', 'logged', 'aaa', '', '2022-05-05 06:27:21'),
(10, 'src/uploads/posts/278977520_558433495641747_4882793388850233874_n-1272336183.jpg', 'logged', 'aaa', '', '2022-05-05 06:27:33'),
(11, 'src/uploads/posts/278977520_558433495641747_4882793388850233874_n-206524457.jpg', 'logged', 'aaa', '', '2022-05-05 06:27:38'),
(12, 'src/uploads/posts/278977520_558433495641747_4882793388850233874_n-2046281185.jpg', 'logged', 'aaa', '', '2022-05-05 06:27:39'),
(13, 'src/uploads/posts/278977520_558433495641747_4882793388850233874_n-1983288891.jpg', 'logged', 'aaa', '', '2022-05-05 06:27:40'),
(15, 'src/uploads/posts/278977520_558433495641747_4882793388850233874_n-1626556151.jpg', 'logged', 'aaa', '', '2022-05-05 06:27:42'),
(16, 'src/uploads/posts/278977520_558433495641747_4882793388850233874_n-1388295524.jpg', 'logged', 'aaa', '', '2022-05-05 06:27:42'),
(17, 'src/uploads/posts/278977520_558433495641747_4882793388850233874_n-420233567.jpg', 'logged', 'aaa', '', '2022-05-05 06:27:43'),
(18, 'src/uploads/posts/278977520_558433495641747_4882793388850233874_n-412921803.jpg', 'logged', 'aaa', '', '2022-05-05 06:27:44'),
(19, 'src/uploads/posts/278977520_558433495641747_4882793388850233874_n-1774293177.jpg', 'logged', 'aaa', '', '2022-05-05 06:27:44'),
(21, 'src/uploads/posts/278977520_558433495641747_4882793388850233874_n-1590010844.jpg', 'logged', 'aaa', '', '2022-05-05 06:27:45'),
(22, 'src/uploads/posts/278977520_558433495641747_4882793388850233874_n-635545890.jpg', 'logged', 'aaa', '', '2022-05-05 06:27:45'),
(35, 'src/uploads/posts/278977520_558433495641747_4882793388850233874_n-985311475.jpg', 'logged', 'aaa', '', '2022-05-05 06:28:04'),
(42, 'src/uploads/posts/278977520_558433495641747_4882793388850233874_n-2139308632.jpg', 'logged', 'aaa', '', '2022-05-05 06:28:05'),
(44, 'src/uploads/posts/278977520_558433495641747_4882793388850233874_n-1522472434.jpg', 'logged', 'aaa', '', '2022-05-05 06:28:37'),
(46, 'src/uploads/posts/favicons-removebg-preview-1789194911.png', 'private', 'a', 'admin@gmail.com', '2022-05-05 06:58:37'),
(47, 'src/uploads/posts/favicons-removebg-preview-80650824.png', 'private', 'a', 'admin@gmail.com', '2022-05-05 06:58:44'),
(57, 'src/uploads/posts/5.jpg', 'public', '', 'dungnov@gmail.com', '2022-05-12 06:36:26'),
(58, 'src/uploads/posts/3-2101515906.jpg', 'public', 'public image', 'dungnov@gmail.com', '2022-05-12 09:03:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
