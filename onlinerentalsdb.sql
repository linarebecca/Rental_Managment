-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2022 at 03:02 AM
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
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
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

INSERT INTO `houses` (`id`, `user_id`, `title`, `slug`, `price`, `views`, `image`, `body`, `published`, `created_at`, `updated_at`) VALUES
(6, 1, 'A1', 'a1', 5000000, 0, 'kitchen2.jpg', '5 BEDROOM HOUSE', 1, '2022-06-05 01:44:34', '2022-06-04 16:14:23'),
(7, 1, 'A2', 'a2', 3000000, 0, 'image2.jpg', '4 BEDROOMSrgg', 1, '2022-06-05 01:44:32', '2022-06-04 07:33:09'),
(8, 1, 'A3', 'a3', 3000000, 0, 'image3.jpg', '2 BEDROMS', 1, '2022-05-19 18:54:31', '2022-05-19 18:51:55'),
(9, 1, 'B1', 'b1', 480999, 0, 'living3.jpg', '5 BEDROM', 1, '2022-05-19 18:54:34', '2022-05-19 18:53:10'),
(10, 1, 'B2', 'b2', 23456789, 0, 'living2.jpg', '3 BEDROOMS', 1, '2022-05-19 18:54:39', '2022-05-19 18:53:42'),
(11, 1, 'B3', 'b3', 23456789, 0, 'living1.jpg', '2 BEDROOMS', 1, '2022-06-05 01:44:39', '2022-05-19 18:54:17'),
(12, 1, 'G3', 'g3', 5678, 0, 'pecdicure_image.jpg', '5R7FYRSDGRUHDUFXCVJCVBJJFHVJNXJVCJBV', 1, '2022-06-03 16:09:36', '2022-06-02 13:33:41'),
(13, 1, 'B4', 'b4', 55555555555, 0, 'student.jpg', 'KITCHEN', 1, '2022-06-05 01:44:42', '2022-06-03 15:27:12'),
(14, 1, 'manager house', 'manager-house', 2737, 0, 'living3.jpg', 'eudgsjhbdjb', 1, '2022-06-05 01:44:45', '2022-06-04 16:09:19');

-- --------------------------------------------------------

--
-- Table structure for table `house_deposit_tenant`
--

CREATE TABLE `house_deposit_tenant` (
  `dep_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `house_slug` varchar(200) NOT NULL,
  `deposit_amount` double NOT NULL,
  `mode_of_pay` varchar(200) NOT NULL,
  `pay_code` varchar(200) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `house_deposit_tenant`
--

INSERT INTO `house_deposit_tenant` (`dep_id`, `user_id`, `house_slug`, `deposit_amount`, `mode_of_pay`, `pay_code`, `created_at`) VALUES
(1, 17, 'a1', 10000000, 'MPESA', 'BHDBHFBHD', '2022-06-05 02:42:34'),
(2, 18, 'a2', 6000000, 'MPESA', 'WHEYGX66', '2022-06-05 03:31:14');

-- --------------------------------------------------------

--
-- Table structure for table `house_floors`
--

CREATE TABLE `house_floors` (
  `id` int(11) NOT NULL,
  `house_id` int(11) DEFAULT NULL,
  `floor_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `house_floors`
--

INSERT INTO `house_floors` (`id`, `house_id`, `floor_id`) VALUES
(8, 6, 1),
(9, 7, 1),
(10, 8, 1),
(11, 9, 2),
(12, 10, 2),
(13, 11, 2),
(14, 12, 2),
(15, 13, 3),
(20, 14, 2);

-- --------------------------------------------------------

--
-- Table structure for table `house_images`
--

CREATE TABLE `house_images` (
  `room_id` int(11) NOT NULL,
  `house_slug` varchar(255) DEFAULT NULL,
  `room_image` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `house_images`
--

INSERT INTO `house_images` (`room_id`, `house_slug`, `room_image`, `description`) VALUES
(7, 'a1', 'kitchen1.jpg', 'KITCHEN'),
(8, 'a2', 'kitchen3.jpg', 'KITCHENUPDATED2'),
(9, 'b1', 'kitchen4.jpg', 'KITCHEN'),
(10, 'b2', 'living1.jpg', 'LIVING ROOM'),
(11, 'g3', 'image3.jpg', 'Bathroon'),
(12, 'a1', 'living2.jpg', 'manageral111'),
(13, 'a1', 'image2.jpg', 'Living Room');

-- --------------------------------------------------------

--
-- Table structure for table `monthly_payments`
--

CREATE TABLE `monthly_payments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `house_slug` varchar(200) NOT NULL,
  `amount` double NOT NULL,
  `mode_of_pay` varchar(200) NOT NULL,
  `pay_code` varchar(200) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `monthly_payments`
--

INSERT INTO `monthly_payments` (`id`, `user_id`, `house_slug`, `amount`, `mode_of_pay`, `pay_code`, `created_at`) VALUES
(1, 17, 'a1', 5000000, 'CASH', 'cash', '2022-06-05 02:52:31'),
(2, 17, 'a1', 5000000, 'CARD', 'YFFYJGFVYG', '2022-06-05 02:52:46'),
(3, 17, 'a1', 5000000, 'CASH', 'cash', '2022-06-05 03:23:16'),
(4, 18, 'a2', 3000000, 'CARD', 'SDFDFDF3E23', '2022-06-05 03:38:19'),
(5, 18, 'a2', 3000000, 'MPESA', 'HVDVFDFD', '2022-06-05 03:43:15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('manager','landlord','tenant') DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `username`, `mobile`, `email`, `role`, `password`, `created_at`, `updated_at`) VALUES
(1, 'lina fuilwa', 'lina', '0756443322', 'lina@gmail.com', 'landlord', 'f6f4deb7dad1c2e5e0b4d6569dc3c1c5', '2022-05-15 13:54:59', NULL),
(2, 'rebeca', 'rebeca', '074666666', 'rebeca@gmail.com', 'manager', '708a65c007259f302db570f607cfa897', '2022-05-15 13:54:59', NULL),
(5, 'brianna', 'brianna', '0766554433', 'briana@gmail.com', 'tenant', '0c8566f4a4d5dd19216514da8add3cf2', '2022-05-19 09:39:19', '2022-05-19 09:39:19'),
(6, 'Rael kasembeli', 'rael', '0748665935', 'recho@gmail.com', 'tenant', '8a37222f50184c7cf4a624058042273b', '2022-05-19 10:13:00', '2022-05-19 10:13:00'),
(7, 'jane', 'Jane', '0766554433', 'jane@gmail.com', 'tenant', '5844a15e76563fedd11840fd6f40ea7b', '2022-05-19 10:17:02', '2022-05-19 10:17:02'),
(8, 'ben', 'ben', '074866543322', 'ben@gmail.com', 'tenant', '7fe4771c008a22eb763df47d19e2c6aa', '2022-05-19 10:28:45', '2022-05-19 10:28:45'),
(9, 'Bisco', 'bisco', '0766554433', 'bisco@gmail.com', 'tenant', '273b5bed2dec4e72aba5e1d9e75010ac', '2022-05-19 11:16:28', '2022-05-19 11:16:28'),
(10, 'madre', 'madre', '0766554433', 'madre@gmail.com', 'tenant', '2309f522cab926b42f4463fc656bd87f', '2022-05-19 11:18:36', '2022-05-19 11:18:36'),
(11, 'sara mwali', 'sarafina', '0766554433', 'sarafina@gmail.com', 'tenant', '06e4915edfdce87df85f183d6c9d8db3', '2022-05-19 12:08:47', '2022-05-19 12:08:47'),
(12, '', 'etrdugy', '', 'g@gmail.com', 'manager', 'c1ebb4933e06ce5617483f665e26627c', '2022-05-19 17:23:34', '2022-05-19 17:23:34'),
(13, 'Jeff Koinange', 'jeff', '0766554433', 'jk@gmail.com', 'tenant', '166ee015c0e0934a8781e0c86a197c6e', '2022-05-19 17:26:37', '2022-05-19 17:26:37'),
(14, 'sasha naututu', 'sashafears', '0766554433', 'sasha@gmail.com', 'tenant', '3687f22975bf842732b4a0abc6203732', '2022-05-24 08:43:08', '2022-05-24 08:43:08'),
(15, 'Euhster', 'Euhster', '0766554433', 'eusta@gmail.com', 'tenant', 'a848046ed611d3528a90c9f2bbce51c5', '2022-05-25 15:45:35', '2022-05-25 15:45:35'),
(16, 'test tenant', 'tester', '0766554433', 'test@gmail.com', 'tenant', 'f5d1278e8109edd94e1e4197e04873b9', '2022-06-04 07:43:34', '2022-06-04 07:43:34'),
(17, 'Barack Obama', 'obama', '074866543322', 'obama@gmail.com', 'tenant', 'a40c0ee90451a127cc66eef339c378cd', '2022-06-05 02:41:34', '2022-06-05 02:41:34'),
(18, 'Sharon Riziki', 'riziki', '0766554433', 'riziki@gmail.com', 'tenant', '338306bc1a7f608e54a35fc31417c113', '2022-06-05 03:30:52', '2022-06-05 03:30:52');

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
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `house_deposit_tenant`
--
ALTER TABLE `house_deposit_tenant`
  ADD PRIMARY KEY (`dep_id`),
  ADD UNIQUE KEY `house_slug` (`house_slug`);

--
-- Indexes for table `house_floors`
--
ALTER TABLE `house_floors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `house_id` (`house_id`),
  ADD KEY `floor_id` (`floor_id`);

--
-- Indexes for table `house_images`
--
ALTER TABLE `house_images`
  ADD PRIMARY KEY (`room_id`),
  ADD KEY `house_slug` (`house_slug`);

--
-- Indexes for table `monthly_payments`
--
ALTER TABLE `monthly_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `floors`
--
ALTER TABLE `floors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `houses`
--
ALTER TABLE `houses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `house_deposit_tenant`
--
ALTER TABLE `house_deposit_tenant`
  MODIFY `dep_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `house_floors`
--
ALTER TABLE `house_floors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `house_images`
--
ALTER TABLE `house_images`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `monthly_payments`
--
ALTER TABLE `monthly_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `houses`
--
ALTER TABLE `houses`
  ADD CONSTRAINT `houses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `house_floors`
--
ALTER TABLE `house_floors`
  ADD CONSTRAINT `house_floors_ibfk_1` FOREIGN KEY (`house_id`) REFERENCES `houses` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `house_floors_ibfk_2` FOREIGN KEY (`floor_id`) REFERENCES `floors` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `house_images`
--
ALTER TABLE `house_images`
  ADD CONSTRAINT `house_images_ibfk_1` FOREIGN KEY (`house_slug`) REFERENCES `houses` (`slug`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
