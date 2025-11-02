
-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2025 at 12:11 PM
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
-- Database: `travels`
--

-- --------------------------------------------------------

--
-- Table structure for table `catogries`
--

CREATE TABLE `catogries` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `imgurl` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `catogries`
--

INSERT INTO `catogries` (`id`, `title`, `imgurl`, `description`) VALUES
(8, 'الغردقة', '1.jpg', 'سياحة'),
(9, 'سيوة', '2.jpeg', 'ترفيه'),
(10, 'دهب', '2.jpg', 'سياحة');

-- --------------------------------------------------------

--
-- Table structure for table `hotel`
--

CREATE TABLE `hotel` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `imgurl` varchar(255) NOT NULL,
  `rate` int(11) NOT NULL,
  `infomation_packeg` varchar(255) NOT NULL,
  `information_hotel` varchar(255) NOT NULL,
  `prisenightday` int(11) DEFAULT NULL,
  `catogry_id` int(11) DEFAULT NULL,
  `price_type` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hotel`
--

INSERT INTO `hotel` (`id`, `title`, `imgurl`, `rate`, `infomation_packeg`, `information_hotel`, `prisenightday`, `catogry_id`, `price_type`) VALUES
(1, 'سيليا', 'uploads/9.jpg', 1, 'يوجد عرض علي الاقامة الكاملة', 'شامل كل الخدمات', 1000, 8, 'Night'),
(2, 'ترفيل', 'uploads/1761337965_5c409ccf.jpg', 4, 'عرض علي اقامة كاملة', 'شامل كل الخدمات', 1300, 9, 'Night'),
(3, 'سياحي', 'uploads/1761340099_b5fd4a54.jpg', 3, 'عرض علي اقامة كاملة', 'شامل كل الخدمات', 1300, 10, 'Day');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `imgurl` varchar(255) NOT NULL,
  `hotel_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `packegs`
--

CREATE TABLE `packegs` (
  `id` int(11) NOT NULL,
  `name_packge` varchar(255) NOT NULL,
  `information_room` varchar(255) NOT NULL,
  `periods` varchar(255) NOT NULL,
  `accommodation_type` varchar(255) NOT NULL,
  `Transportations` varchar(255) NOT NULL,
  `price_night` float NOT NULL,
  `hotel_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `packegs`
--

INSERT INTO `packegs` (`id`, `name_packge`, `information_room`, `periods`, `accommodation_type`, `Transportations`, `price_night`, `hotel_id`) VALUES
(1, 'الاقامه الكاملة', 'غرفة مفردة', '3 ايام', 'نصف اقامة', 'باص', 1500, 7),
(2, 'اقامة كاملة', 'غرفة مفردة', '3ايام', 'فندق', 'طيران', 1300, 2),
(3, 'اقامة كاملة', 'غرفة مفردة', '2يومين', 'فندق', 'سيارة', 1000, 3);

-- --------------------------------------------------------

--
-- Table structure for table `reserve`
--

CREATE TABLE `reserve` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `packag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(55) NOT NULL,
  `natid` varchar(55) NOT NULL,
  `phone` varchar(55) NOT NULL,
  `role` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `natid`, `phone`, `role`) VALUES
(2, 'فاطمة محمد ابراهيم', '4545456657678879', '01001922197', 'Customer'),
(3, 'فاطمة مجمد', '1234567311235', '01203455002', 'Customer'),
(4, 'فاطمة محمد', '2334568965322', '010233467865432', 'Hotel Owner');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `catogries`
--
ALTER TABLE `catogries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hotel`
--
ALTER TABLE `hotel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `catogry_id` (`catogry_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hotel_id` (`hotel_id`);

--
-- Indexes for table `packegs`
--
ALTER TABLE `packegs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hotel_id` (`hotel_id`);

--
-- Indexes for table `reserve`
--
ALTER TABLE `reserve`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `packag_id` (`packag_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `catogries`
--
ALTER TABLE `catogries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `hotel`
--
ALTER TABLE `hotel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `packegs`
--
ALTER TABLE `packegs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hotel`
--
ALTER TABLE `hotel`
  ADD CONSTRAINT `hotel_ibfk_1` FOREIGN KEY (`catogry_id`) REFERENCES `catogries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`hotel_id`) REFERENCES `hotel` (`id`);

--
-- Constraints for table `reserve`
--
ALTER TABLE `reserve`
  ADD CONSTRAINT `reserve_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `reserve_ibfk_2` FOREIGN KEY (`packag_id`) REFERENCES `packegs` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;