-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2022 at 10:08 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlinerentalsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `floors`
--

CREATE TABLE `floors` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `floors`
--

INSERT INTO `floors` (`id`, `name`, `slug`) VALUES
(1, 'floor1', 'floor1'),
(2, 'floor2', 'floor2'),
(3, 'floor3', 'floor3');

-- --------------------------------------------------------

--
-- Table structure for table `houses`
--

CREATE TABLE `houses` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `floor_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `price` double NOT NULL,
  `views` int(1) NOT NULL DEFAULT 0,
  `image` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `published` tinyint(1) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `houses`
--

INSERT INTO `houses` (`id`, `user_id`, `floor_id`, `title`, `slug`, `price`, `views`, `image`, `body`, `published`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'A1', 'a1', 20000, 0, 'banner.jpg', 'kitchen, 2 bathrooms, veranda', 1, '2022-05-10 17:47:32', '2022-05-10 14:17:42'),
(2, 1, 2, 'B1', 'b1', 20000, 0, 'banner.jpg', 'kitchen, 2 bathrooms, veranda', 1, '2022-05-10 17:47:36', '2022-05-10 14:17:42'),
(3, 1, 3, 'C1', 'c1', 20000, 0, 'banner.jpg', 'kitchen, 2 bathrooms, veranda', 1, '2022-05-10 17:47:39', '2022-05-10 14:17:42');

-- --------------------------------------------------------

--
-- Table structure for table `house_deposit_tenant`
--

CREATE TABLE `house_deposit_tenant` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `house_id` int(11) DEFAULT NULL,
  `deposit_amount` double NOT NULL,
  `mode_of_pay` varchar(200) NOT NULL,
  `pay_code` varchar(200) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `house_deposit_tenant`
--

INSERT INTO `house_deposit_tenant` (`id`, `user_id`, `house_id`, `deposit_amount`, `mode_of_pay`, `pay_code`, `created_at`) VALUES
(1, 7, 1, 40000, 'MPESA', 'CNUER234FF', '2022-05-10 15:18:29'),
(2, 7, 1, 40000, 'MPESA', 'cdss', '2022-05-10 15:28:46'),
(3, 8, 1, 40000, 'MPESA', 'CN34ERWSS', '2022-05-10 16:39:45'),
(4, 11, 1, 40000, 'MPESA', 'CNUE332', '2022-05-10 18:53:47'),
(5, 11, 1, 40000, 'MPESA', 'yfikfyl', '2022-05-10 19:20:34');

-- --------------------------------------------------------

--
-- Table structure for table `house_images`
--

CREATE TABLE `house_images` (
  `id` int(11) NOT NULL,
  `house_id` int(11) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `house_images`
--

INSERT INTO `house_images` (`id`, `house_id`, `image`, `description`) VALUES
(1, 1, 'banner.jpg', 'kitchen'),
(2, 2, 'banner.jpg', 'kitchen'),
(3, 1, 'banner.jpg', 'living room');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('manager','landlord') DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `role`, `password`, `created_at`, `updated_at`) VALUES
(1, 'lina', 'lina@gmail.com', 'landlord', 'f6f4deb7dad1c2e5e0b4d6569dc3c1c5', '2022-05-10 14:17:41', NULL),
(6, 'kasedevs', 'kasedevs@gmail.com', 'landlord', 'f34a96643a85ba0fa0f8a79bec1c2f90', '2022-05-10 14:49:38', '2022-05-10 14:49:38'),
(7, 'natasha sara', 'natasha@gmail.com', NULL, '6275e26419211d1f526e674d97110e15', '2022-05-10 15:18:10', '2022-05-10 15:18:10'),
(8, 'RUSSEL', 'rusel@gmail.com', NULL, 'a29eae626123ede7b7b9cd657169b6e2', '2022-05-10 16:37:22', '2022-05-10 16:37:22'),
(11, 'cardinal john', 'cardinal@gmail.com', NULL, '427023ff7e5f28a11e61fce0b4917b57', '2022-05-10 18:52:49', '2022-05-10 18:52:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `floors`
--
ALTER TABLE `floors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `houses`
--
ALTER TABLE `houses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `floor_id` (`floor_id`);

--
-- Indexes for table `house_deposit_tenant`
--
ALTER TABLE `house_deposit_tenant`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `house_id` (`house_id`);

--
-- Indexes for table `house_images`
--
ALTER TABLE `house_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `house_id` (`house_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `floors`
--
ALTER TABLE `floors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `houses`
--
ALTER TABLE `houses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `house_deposit_tenant`
--
ALTER TABLE `house_deposit_tenant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `house_images`
--
ALTER TABLE `house_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `houses`
--
ALTER TABLE `houses`
  ADD CONSTRAINT `houses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `houses_ibfk_2` FOREIGN KEY (`floor_id`) REFERENCES `floors` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `house_deposit_tenant`
--
ALTER TABLE `house_deposit_tenant`
  ADD CONSTRAINT `house_deposit_tenant_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `house_deposit_tenant_ibfk_2` FOREIGN KEY (`house_id`) REFERENCES `houses` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `house_images`
--
ALTER TABLE `house_images`
  ADD CONSTRAINT `house_images_ibfk_1` FOREIGN KEY (`house_id`) REFERENCES `houses` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
