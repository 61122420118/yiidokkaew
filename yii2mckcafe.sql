-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 29, 2021 at 09:36 AM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yii2mckcafe`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `name`, `status`) VALUES
(1, 'อเมริกาโน่', 0),
(2, 'ลาเต้', 0);

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1639741137),
('m130524_201442_init', 1639741139),
('m190124_110200_add_verification_token_column_to_user_table', 1639741139);

-- --------------------------------------------------------

--
-- Table structure for table `price`
--

CREATE TABLE `price` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `price`
--

INSERT INTO `price` (`id`, `name`, `status`) VALUES
(1, '25 บาท', 0),
(2, '30 บาท', 0),
(3, '35 บาท', 0),
(4, '40 บาท', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

CREATE TABLE `sale` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `user` int(11) NOT NULL,
  `create_at` datetime NOT NULL,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sale`
--

INSERT INTO `sale` (`id`, `date`, `user`, `create_at`, `update_at`) VALUES
(14, '2021-12-25', 1, '2021-12-20 16:52:40', '2021-12-20 09:52:40'),
(15, '2021-12-18', 1, '2021-12-20 16:54:18', '2021-12-20 09:54:18'),
(23, '2021-12-23', 1, '2021-12-23 17:27:25', '2021-12-23 10:27:25'),
(24, '2021-12-23', 1, '2021-12-23 22:14:36', '2021-12-23 15:14:36'),
(25, '2021-12-24', 1, '2021-12-24 08:14:43', '2021-12-24 01:14:43'),
(26, '2021-12-31', 1, '2021-12-27 15:02:03', '2021-12-27 08:02:03');

-- --------------------------------------------------------

--
-- Table structure for table `sale_detail`
--

CREATE TABLE `sale_detail` (
  `id` int(11) NOT NULL,
  `sale_id` int(11) NOT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `price_id` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `note` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sale_detail`
--

INSERT INTO `sale_detail` (`id`, `sale_id`, `menu_id`, `unit_id`, `price_id`, `amount`, `note`) VALUES
(63, 6, 1, 2, 2, 100, 'rrty'),
(64, 6, 2, 2, 1, 50, 'rrty'),
(65, 7, 1, 1, 1, 12, 'sasaass'),
(66, 8, 1, 1, 1, 4, ''),
(67, 9, 1, 2, 1, 11, '4202'),
(68, 10, 1, 1, 1, 52, 'gfhfgh'),
(69, 11, 1, 1, 1, 56, 'gfdfsdf'),
(70, 12, 1, 1, 1, NULL, 'sfdgfdh'),
(71, 13, 1, 2, 1, 56, 'sfsdf'),
(72, 14, 1, 1, 1, 56, ''),
(73, 15, 1, 1, 1, 78, ''),
(74, 16, 1, 1, 1, 11, ''),
(75, 17, 1, 2, 1, 10, ''),
(76, 18, 1, 1, 1, 56, 'wertuyutu'),
(77, 19, 1, 1, 1, 1, ''),
(78, 20, 1, 1, 1, 45, 'sasaass'),
(79, 21, 1, 1, 1, 11, ''),
(102, 22, 1, 2, 1, 10, ''),
(103, 22, 1, 2, 2, 20, ''),
(104, 22, 2, 1, 2, 20, ''),
(109, 23, 1, 1, 1, 10, ''),
(110, 23, 1, 2, 1, 10, ''),
(111, 23, 2, 1, 2, 10, ''),
(112, 23, 2, 2, 2, 10, ''),
(113, 23, 2, 1, 1, 5, ''),
(114, 23, 2, 2, 1, 5, ''),
(117, 24, 1, 3, 2, 10, ''),
(118, 24, 2, 2, 2, 3, ''),
(119, 24, 1, 2, 2, 20, ''),
(133, 25, 1, 1, 3, 10, ''),
(134, 25, 2, 3, 3, 10, ''),
(135, 25, 2, 2, 4, 10, ''),
(136, 25, 1, 4, 4, 10, 'เอิร์ธ'),
(137, 25, 2, 1, 2, 10, ''),
(138, 26, 1, 1, 2, 20, ''),
(139, 26, 2, 2, 3, 10, ''),
(140, 26, 1, 4, 2, 10, '');

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`id`, `name`, `status`) VALUES
(1, 'เย็น/โอน', 0),
(2, 'ร้อน/โอน', 0),
(3, 'เย็น/เงินสด', 0),
(4, 'ร้อน/เงินสด', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
(1, 'admin', '9QE94zc74NaeKGHt4cV8pRExswLi-xAK', '$2y$13$vsKnD4x3/p6DZHwvqi6au.2rXK6tFEgvrBmPXsHXHu8PPwkzMWJF.', NULL, 'admin@admin.com', 10, 1639741186, 1639741186, 'MM83zUp5eHm3XlWkITxWP7q4y7sjBJYC_1639741186');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `price`
--
ALTER TABLE `price`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale_detail`
--
ALTER TABLE `sale_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `price`
--
ALTER TABLE `price`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sale`
--
ALTER TABLE `sale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `sale_detail`
--
ALTER TABLE `sale_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
