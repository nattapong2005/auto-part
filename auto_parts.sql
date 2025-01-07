-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2025 at 07:12 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `auto_parts`
--

-- --------------------------------------------------------

--
-- Table structure for table `parts`
--

CREATE TABLE `parts` (
  `id` bigint(20) NOT NULL,
  `img` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(40) NOT NULL,
  `stock` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parts`
--

INSERT INTO `parts` (`id`, `img`, `name`, `description`, `stock`) VALUES
(1, '', 'โค้ง', 'โค้ง', 0),
(2, '', 'ลิ้ม', 'ลิ้ม', 0),
(3, '', 'ปากนกแก้ว', 'ปากนกแก้ว', 0);

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `dates` datetime NOT NULL,
  `status` enum('pending','approved','rejected') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `user_id`, `dates`, `status`) VALUES
(1, 1, '2025-01-07 18:41:32', 'pending'),
(2, 1, '2025-01-07 18:45:11', 'pending'),
(3, 1, '2025-01-07 18:53:17', 'pending'),
(4, 1, '2025-01-07 18:54:07', 'pending'),
(5, 1, '2025-01-07 18:54:16', 'pending'),
(6, 1, '2025-01-07 18:56:37', 'pending'),
(7, 1, '2025-01-07 18:57:30', 'pending'),
(8, 1, '2025-01-07 18:57:44', 'pending'),
(9, 1, '2025-01-07 18:58:36', 'pending'),
(10, 1, '2025-01-07 19:01:09', 'pending'),
(11, 1, '2025-01-07 19:06:59', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `request_details`
--

CREATE TABLE `request_details` (
  `id` bigint(20) NOT NULL,
  `request_id` int(11) NOT NULL,
  `part_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request_details`
--

INSERT INTO `request_details` (`id`, `request_id`, `part_id`, `amount`) VALUES
(1, 3, 1, 5),
(2, 4, 2, 5),
(3, 5, 3, 5),
(4, 6, 1, 2),
(5, 7, 1, 2),
(6, 8, 1, 1),
(7, 9, 1, 2),
(8, 10, 1, 1),
(9, 11, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `name` varchar(40) NOT NULL,
  `lastname` varchar(40) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `lastname`, `username`, `password`, `role`) VALUES
(1, 'test', 'kub', 'test', '202cb962ac59075b964b07152d234b70', 'user'),
(2, 'admin', 'kub', 'admin', '202cb962ac59075b964b07152d234b70', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `parts`
--
ALTER TABLE `parts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request_details`
--
ALTER TABLE `request_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `parts`
--
ALTER TABLE `parts`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `request_details`
--
ALTER TABLE `request_details`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
