-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2023 at 11:46 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `todolist`
--

-- --------------------------------------------------------

--
-- Table structure for table `all_todos`
--

CREATE TABLE `all_todos` (
  `id` bigint(20) NOT NULL,
  `title` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1- Incomplete\r\n2- completed',
  `user_id` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `all_todos`
--

INSERT INTO `all_todos` (`id`, `title`, `status`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Drink water in every 2 hour', 1, 15, '2023-03-15 08:58:45', '2023-03-15 10:32:15', NULL),
(2, 'Walk every morning', 1, 15, '2023-03-15 09:04:24', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(5000) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 'Pankaj sahu', 'pankaj@gmail.com', '$2y$10$GvZIlgqU6/JjVTSz8vPWVekaxjj7Cm64qChtmbn4dTNYLriK.RHl2', '2023-03-14 14:33:49', NULL, NULL),
(13, 'aman sahu', 'aman@gmail.com', '$2y$10$tIn5.qNqxovbRQt/FiDnD.LtxPM6W9.rVYh5F9gVgA5fSiova7dvG', '2023-03-14 14:45:25', NULL, NULL),
(15, 'Piyush', 'piyush@gmail.com', '$2y$10$7hdprns5P6ElZhJmLS5UeO5LZh7ecNIuSR5jrLAYLY3F/pLfJsANm', '2023-03-14 14:51:10', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `all_todos`
--
ALTER TABLE `all_todos`
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
-- AUTO_INCREMENT for table `all_todos`
--
ALTER TABLE `all_todos`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
