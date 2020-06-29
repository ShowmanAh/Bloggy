-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2020 at 01:52 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php_cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `creater` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `creater`, `created_at`, `updated_at`) VALUES
(8, 'CSS', 'ali@gmail.com', '2020-04-16 16:36:45', NULL),
(9, 'HTML', 'ali@gmail.com', '2020-04-16 16:36:59', NULL),
(10, 'training', 'aya@gmail.com', '2020-04-16 22:36:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `post_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `author`, `comment`, `status`, `post_id`, `created_at`, `updated_at`) VALUES
(2, 'ali@gmail.com', 'lhlkkhk', 1, 3, '2020-04-15 18:55:34', '2020-04-15 20:55:34'),
(3, 'ali@gmail.com', 'hgjjjjjjjjjjj', 0, 3, '2020-04-15 18:58:33', '2020-04-15 20:58:33');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `describtion` varchar(1000) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `category`, `author`, `image`, `describtion`, `created_at`, `updated_at`) VALUES
(3, 'hhhhh', 'CSS', 'ali@gmail.com', '11.jpg', 'PHPjgjkg', '2020-04-15 03:22:07', '2020-04-15 05:22:07'),
(6, 'jk', 'CSS', 'ali@gmail.com', '4.png', 'PHPfjkkkkkkkkkk', '2020-04-16 16:29:36', '2020-04-16 18:29:36'),
(9, 'jk', 'CSS', 'ali@gmail.com', '1.jpg', 'jffffffffffffffffffff', '2020-04-16 16:45:56', '2020-04-16 18:45:56');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `avatar`, `password`, `admin`, `created_at`, `updated_at`) VALUES
(23, 'ali', 'ali@gmail.com', '', '$2y$10$o8oYCLeSMhNGqfKR./p4...KNWFTVY1MirQPNjtYhrwgO5hQ8DrkS', 1, '2020-04-11 01:13:55', '2020-04-11 03:13:55'),
(40, 'showman', 'show1@gmail.com', 'linked.png', '$2y$10$C9ScMGCQmQK/q/Loc8y95e7q3cwfa6rgkGyECTZjNQGLksM2JSzOq', 1, '2020-04-15 23:50:34', '2020-04-16 01:50:34'),
(42, 'omar', 'omar@gmail.com', 'a.jpg', '$2y$10$tQwe32Yru/y8FSHBR56IX.dcw59QlhCIBTEif/sJt18QGPuPkk0iK', 1, '2020-04-16 00:05:47', '2020-04-16 02:05:47'),
(49, 'aya', 'aya@gmail.com', 'a.jpg', '$2y$10$Bf1IYXAFsKL5/U8D/7IsZOr2pP9JOy1PWCs7.BogO3QXl6E/Y6M5u', 0, '2020-04-16 16:17:59', '2020-04-16 18:17:59'),
(51, 'amira', 'amira@gmail.com', 'c.png', '$2y$10$C9/f7EJF4fOn7EJwoWmGeOq10cpKAGn/qf2TVSUi/plnpxn2vh8AG', 0, '2020-04-16 22:35:37', '2020-04-17 00:35:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts` (`post_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `posts` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
