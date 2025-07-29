-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 29, 2025 at 07:02 PM
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
-- Database: `ianp`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password_hash`) VALUES
(1, 'admin', '$2y$10$.UJkp2VrEjRTlQwNy/OxReY3JReE5FLAP9nw0YUc1hcZhnq2uypmu');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `message`, `created_at`) VALUES
(1, 'IAN ', 'ian@ian.ian', 'fdsafsda', '2025-05-16 10:37:24'),
(5, 'cristibne', 'fdsfsd@sdfsadf.fsdafsdaf', 'fsadfsdfsdfsdf', '2025-05-16 13:14:23'),
(9, 'Loida Purificacion', 'loidapurificacionvelena@gmail.com', 'asdf', '2025-07-25 11:24:18'),
(10, 'IAN PURIFICACION', 'purificacionvelena@gmail.com', 'asdf', '2025-07-25 11:24:28'),
(11, 'Joy Boy', 'loida@gmail.com', 'adsf', '2025-07-25 11:24:40'),
(12, 'Loida Purificacion', 'loidapurificacionvelena@gmail.com', 'asdf', '2025-07-25 11:24:45'),
(13, 'IAN PURIFI', 'rificacionvelena@gmail.com', 'asdff', '2025-07-25 11:24:58'),
(14, 'Loida Purificacion', 'loidapurificacio@gmail.com', 'asdf', '2025-07-25 11:25:07'),
(17, 'Joy Boy', 'loidapurificacionvelena@gmail.com', 'asdf', '2025-07-25 12:55:56');

-- --------------------------------------------------------

--
-- Table structure for table `inquire`
--

CREATE TABLE `inquire` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `subject` varchar(150) DEFAULT NULL,
  `message` text NOT NULL,
  `category` varchar(50) DEFAULT NULL,
  `preferred_contact` varchar(10) DEFAULT NULL,
  `priority` varchar(20) DEFAULT 'medium',
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL DEFAULT 'pending',
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inquire`
--

INSERT INTO `inquire` (`id`, `fullname`, `email`, `phone`, `subject`, `message`, `category`, `preferred_contact`, `priority`, `image`, `created_at`, `status`, `updated_at`) VALUES
(25, 'Ian Purificacion', 'purificacionian@gmail.com', '', 'HACKING', 'fasd', '', 'email', 'low', 'inquiry_1751437776_6864d1d00e59b.jpg', '2025-06-22 06:29:36', 'completed', '2025-06-22 14:39:35'),
(26, 'Joy Boy', 'loidapurificacionvelena@gmail.com', '+639916925190', 'HACKING', 'asdf', 'devops', 'email', 'high', 'inquiry_1751466285_6865412d8e0fb.png', '2025-06-28 14:24:45', 'pending', '2025-06-28 14:24:45'),
(27, 'Joy Boy', 'loidapurificacionvelena@gmail.com', '+639916925190', 'HACKING', 'asdf', 'qa', 'email', 'high', 'inquiry_1751466300_6865413cd32fb.png', '2025-06-22 14:25:00', 'pending', '2025-06-22 14:25:00'),
(28, 'Joy Boy', 'loidapurificacionvelena@gmail.com', '+639916925190', 'HACKING', 'asdf', 'devops', 'email', 'urgent', 'inquiry_1751466315_6865414bb73ce.jpg', '2025-06-15 14:25:15', 'pending', '2025-06-15 14:25:15'),
(29, 'Loida Purificacion', 'purificacionvelena@gmail.com', '+639916925190', 'HACKING NASA', 'asdf', 'qa', 'phone', 'high', 'inquiry_1751466337_68654161e7b33.png', '2025-06-28 14:25:37', 'pending', '2025-06-28 14:25:37'),
(30, 'Loida Purificacion', 'purificacionvelena@gmail.com', '+639916925190', 'Dog food', 'asdf', 'devops', 'email', 'medium', 'inquiry_1751466356_686541746b9da.jpg', '2025-06-28 14:25:56', 'pending', '2025-06-28 14:25:56'),
(31, 'Ian Purificacion', 'ian@example.com', '+639916925190', 'Dog food', 'asdf', 'devops', 'email', 'urgent', 'inquiry_1751466376_6865418804ff7.png', '2025-06-22 14:26:16', 'pending', '2025-06-22 14:26:16'),
(32, 'Loida Purificacion', 'loidapurificacionvelena@gmail.com', '09916925190', 'HACKING', 'asdf', 'devops', 'email', 'high', NULL, '2025-06-28 15:06:58', 'pending', '2025-06-28 15:06:58'),
(33, 'IAN PURIFICACION', 'ian@test.com', '', 'Dog food', 'please', 'support', 'email', 'urgent', 'inquiry_1751470751_6865529f1f594.jpg', '2025-06-28 15:39:11', 'pending', '2025-06-28 15:39:11'),
(34, 'IAN PURIFICACION', 'ian@test.com', '09916925190', 'Dog food', 'please', 'support', 'email', 'low', 'inquiry_1751470794_686552ca7f993.jpg', '2025-06-28 15:39:54', 'pending', '2025-06-28 15:43:27'),
(38, 'Loida Purificacion', 'loidapurificacionvelena@gmail.com', '+639916925190', 'HACKING', 'sadf', 'qa', 'email', 'urgent', 'inquiry_1752025813_686dcad5cdb70.jpg', '2025-07-09 01:50:13', 'pending', '2025-07-09 01:50:13'),
(39, 'Loida Purificacion', 'loidapurificacionvelena@gmail.com', '+639916925190', 'Dog food', 'sdf', 'devops', 'email', 'medium', 'inquiry_1752025834_686dcaea4f054.jpg', '2025-07-09 01:50:34', 'pending', '2025-07-09 01:50:34'),
(40, 'Loida Purificacion', 'loidapurificacionvelena@gmail.com', '+639916925190', 'Dog food', 'sdfasdff', 'devops', 'email', 'low', 'inquiry_1752025854_686dcafe02774.jpg', '2025-07-09 01:50:54', 'pending', '2025-07-09 01:50:54'),
(41, 'Loida Purificacion', 'loidapurificacionvelena@gmail.com', '+639916925190', 'Dog food', 'please faster', 'devops', 'email', 'urgent', 'inquiry_1753442601_68836929b3308.jpg', '2025-07-25 11:23:21', 'pending', '2025-07-25 11:23:21'),
(42, 'Loida Purificacion', 'loidapurificacionvelena@gmail.com', '+639916925190', 'Dog food', 'asdf', 'development', 'phone', 'high', 'inquiry_1753442793_688369e9d3e33.jpg', '2025-07-25 11:26:33', 'pending', '2025-07-25 11:26:33'),
(43, 'Loida Purificacion', 'loidapurificacionvelena@gmail.com', '+639916925190', 'Dog food', 'asdf', 'devops', 'phone', 'urgent', 'inquiry_1753442817_68836a01cfc83.jpg', '2025-07-25 11:26:57', 'pending', '2025-07-25 11:26:57'),
(48, 'Loidaloids', 'loidapurificacionvelena@gmail.com', '09916921234', 'asdf', 'asdfasdfasdf', 'support', 'phone', 'high', 'inquiry_1753778802_68888a72c20cc.jpg', '2025-07-29 08:46:42', 'completed', '2025-07-29 08:47:40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `role` varchar(10) NOT NULL DEFAULT 'user',
  `status` enum('active','inactive','pending') NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `full_name`, `phone`, `address`, `photo`, `role`, `status`, `created_at`, `updated_at`) VALUES
(5, 'marcus', 'marcus@gmail.com', '$2y$10$ppMVCCSmUEBig.5NRkY1zeCzbzVa8Xnea46Sq4pivZvXk02jteNz.', 'Marcus A', '09090001111', 'Cavite, Philippines', '685d090ae70e0_1750927626.jpg', 'user', 'active', '2025-06-26 08:47:06', '2025-06-26 08:47:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inquire`
--
ALTER TABLE `inquire`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idx_email` (`email`),
  ADD KEY `idx_username` (`username`),
  ADD KEY `idx_status` (`status`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `inquire`
--
ALTER TABLE `inquire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
