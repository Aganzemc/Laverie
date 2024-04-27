-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 15, 2022 at 12:00 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laveriedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `client_id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `adresse` varchar(50) DEFAULT NULL,
  `date_nais` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`client_id`, `nom`, `prenom`, `adresse`, `date_nais`) VALUES
(1, 'Kish Jonathan', 'Jonathan', 'Bukavu', '2000-12-15'),
(2, 'Joseph Kalebe', 'Kalebe', 'Bukavu', '2010-12-16'),
(3, 'Benjamin Bahati', 'Bahati', 'bukavu', '2005-02-05'),
(4, 'Moise Ngoy', 'Moise', 'Bukavu/Ndandere', '2000-10-15');

-- --------------------------------------------------------

--
-- Table structure for table `depenses`
--

CREATE TABLE `depenses` (
  `depense_id` int(11) NOT NULL,
  `user_id` int(1) NOT NULL,
  `designation` text NOT NULL DEFAULT 'non definie',
  `montant` decimal(12,2) NOT NULL,
  `date_reg` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `depenses`
--

INSERT INTO `depenses` (`depense_id`, `user_id`, `designation`, `montant`, `date_reg`) VALUES
(6, 3, 'Transport', '5.00', '2022-08-14 15:40:58'),
(16, 3, 'Electricite', '10.00', '2022-08-15 12:52:05'),
(19, 3, 'Resideso', '19.00', '2022-09-23 09:35:26'),
(23, 3, 'snel', '6.00', '2022-08-31 01:21:38');

-- --------------------------------------------------------

--
-- Table structure for table `logins`
--

CREATE TABLE `logins` (
  `login_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `login_key` text NOT NULL,
  `login_start` datetime NOT NULL DEFAULT current_timestamp(),
  `login_end` datetime DEFAULT NULL,
  `login_status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logins`
--

INSERT INTO `logins` (`login_id`, `user_id`, `login_key`, `login_start`, `login_end`, `login_status`) VALUES
(1, 2, 'log_427744263', '2022-08-19 12:20:16', '2022-08-19 12:22:40', 0),
(2, 1, 'log_646645007', '2022-08-19 12:22:49', '2022-08-19 15:25:32', 0),
(3, 2, 'log_121511386', '2022-08-19 14:41:11', '2022-08-19 14:44:06', 0),
(4, 3, 'log_250790372', '2022-08-19 14:44:15', '2022-08-23 09:48:20', 0),
(5, 1, 'log_426817298', '2022-08-19 15:25:32', '2022-08-19 15:25:50', 0),
(6, 2, 'log_487592893', '2022-08-22 16:11:12', '2022-08-22 16:16:32', 0),
(7, 1, 'log_915895628', '2022-08-22 16:16:40', '2022-08-22 16:31:26', 0),
(8, 2, 'log_883558604', '2022-08-22 16:24:02', '2022-08-22 16:34:22', 0),
(9, 3, 'log_918665098', '2022-08-23 09:32:09', '2022-08-23 09:48:20', 0),
(10, 3, 'log_167006610', '2022-08-23 09:35:14', '2022-08-23 09:48:20', 0),
(11, 3, 'log_374345786', '2022-08-23 09:47:39', '2022-08-23 09:48:20', 0),
(12, 3, 'log_626766186', '2022-08-23 09:48:20', '2022-08-23 09:53:12', 0),
(13, 1, 'log_696472956', '2022-08-23 09:52:04', '2022-08-23 10:10:21', 0),
(14, 2, 'log_926117411', '2022-08-23 10:04:54', '2022-08-23 10:08:05', 0),
(15, 2, 'log_340345384', '2022-08-23 10:36:05', '2022-08-23 10:45:17', 0),
(16, 2, 'log_200274150', '2022-08-23 10:46:02', '2022-08-23 11:33:34', 0),
(17, 3, 'log_619959963', '2022-08-23 12:35:25', '2022-08-23 13:15:41', 0),
(18, 3, 'log_555113830', '2022-08-23 13:15:44', '2022-08-23 13:34:21', 0),
(19, 2, 'log_409782145', '2022-08-23 13:18:57', '2022-08-23 13:36:19', 0),
(20, 2, 'log_824482235', '2022-08-23 13:38:25', '2022-08-23 13:42:16', 0),
(21, 2, 'log_301017730', '2022-08-23 13:42:27', '2022-08-23 13:45:21', 0),
(22, 3, 'log_369112832', '2022-08-23 13:43:32', '2022-08-23 13:45:32', 0),
(23, 1, 'log_834444577', '2022-08-23 13:44:24', '2022-08-23 13:45:41', 0),
(24, 2, 'log_390673398', '2022-08-24 23:39:22', '2022-08-25 00:20:34', 0),
(25, 2, 'log_236936426', '2022-08-25 00:20:42', '2022-08-25 02:33:40', 0),
(26, 3, 'log_682352169', '2022-08-25 01:28:24', '2022-08-25 02:33:29', 0),
(27, 2, 'log_984439028', '2022-08-25 02:34:12', '2022-08-25 02:36:21', 0),
(28, 2, 'log_275696017', '2022-08-26 23:17:30', '2022-08-26 23:18:39', 0),
(29, 2, 'log_828781961', '2022-08-26 23:19:21', '2022-08-27 02:24:39', 0),
(30, 3, 'log_370592671', '2022-08-27 02:24:47', '2022-08-27 02:26:23', 0),
(31, 3, 'log_141944194', '2022-08-29 13:49:15', '2022-08-29 13:49:23', 0),
(32, 1, 'log_954748451', '2022-08-29 13:49:32', '2022-08-29 16:04:48', 0),
(33, 3, 'log_146613437', '2022-08-29 13:57:43', '2022-08-29 16:04:37', 0),
(34, 2, 'log_430003450', '2022-08-30 12:45:27', '2022-08-30 13:08:28', 0),
(35, 3, 'log_406930976', '2022-08-30 13:31:22', '2022-08-30 13:31:55', 0),
(36, 3, 'log_434034377', '2022-08-31 00:46:11', '2022-08-31 03:13:47', 0),
(37, 3, 'log_787997277', '2022-09-01 21:41:13', '2022-09-01 23:37:50', 0),
(38, 2, 'log_129051640', '2022-09-01 21:43:34', '2022-09-01 23:37:58', 0),
(39, 1, 'log_949484578', '2022-09-01 23:38:12', '2022-09-01 23:39:46', 0),
(40, 3, 'log_169397001', '2022-09-12 10:02:04', '2022-09-12 10:14:18', 0),
(41, 3, 'log_950543934', '2022-09-12 10:18:04', '2022-09-12 10:24:34', 0),
(42, 1, 'log_678737295', '2022-09-12 10:25:33', '2022-09-12 11:16:06', 0),
(43, 3, 'log_286629207', '2022-09-12 10:27:47', '2022-09-12 10:28:34', 0),
(44, 3, 'log_595761975', '2022-09-12 10:55:47', '2022-09-12 10:58:21', 0),
(45, 3, 'log_378025682', '2022-09-12 10:58:47', '2022-09-12 10:58:50', 0),
(46, 3, 'log_142157443', '2022-09-12 11:00:12', '2022-09-15 07:21:46', 0),
(47, 2, 'log_289969550', '2022-09-12 11:16:16', '2022-09-15 07:21:03', 0),
(48, 1, 'log_911939914', '2022-09-15 07:21:11', '2022-09-15 07:21:17', 0),
(49, 2, 'log_400879713', '2022-09-15 07:21:22', '2022-09-15 07:21:25', 0),
(50, 1, 'log_512467254', '2022-09-15 07:21:53', '2022-09-15 08:39:41', 0),
(51, 2, 'log_970756330', '2022-09-15 08:51:26', '2022-09-15 09:01:06', 0),
(52, 1, 'log_879861001', '2022-09-15 09:01:24', '2022-09-15 09:07:47', 0),
(53, 3, 'log_652560982', '2022-09-15 09:02:45', '2022-09-15 09:23:50', 0),
(54, 1, 'log_834141777', '2022-09-15 09:08:46', '2022-09-15 09:57:26', 0),
(55, 3, 'log_957896200', '2022-09-15 09:24:03', '2022-09-15 09:24:05', 0),
(56, 2, 'log_119920329', '2022-09-15 09:26:22', '2022-09-15 09:29:52', 0),
(57, 3, 'log_574184575', '2022-09-15 09:30:04', NULL, 1),
(58, 2, 'log_950183490', '2022-09-15 10:10:21', NULL, 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `monthly_repport`
-- (See below for the actual view)
--
CREATE TABLE `monthly_repport` (
`input` decimal(34,2)
,`month` int(2)
,`year` int(4)
);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `montant` decimal(12,2) NOT NULL,
  `user_id` int(11) NOT NULL,
  `record_id` int(11) NOT NULL,
  `payment_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `montant`, `user_id`, `record_id`, `payment_date`) VALUES
(1, '9.50', 3, 2, '2022-08-13 00:00:00'),
(2, '10.59', 3, 1, '2022-08-13 00:00:00'),
(3, '12.35', 3, 3, '2022-08-13 00:00:00'),
(4, '42.50', 3, 4, '2022-08-14 00:00:00'),
(5, '68.75', 3, 5, '2022-08-14 00:00:00'),
(6, '95.50', 3, 6, '2022-08-15 00:00:00'),
(7, '11.27', 3, 7, '2022-08-15 00:00:00'),
(8, '11.20', 3, 8, '2022-08-15 00:00:00'),
(9, '14.30', 3, 9, '2022-08-27 00:00:00'),
(10, '16.80', 3, 10, '2022-08-27 00:00:00'),
(11, '11.10', 3, 11, '2022-08-27 00:00:00'),
(12, '19.15', 3, 12, '2022-09-29 16:44:56'),
(13, '29.15', 3, 13, '2022-09-01 22:45:21');

-- --------------------------------------------------------

--
-- Table structure for table `rapport_payment`
--

CREATE TABLE `rapport_payment` (
  `rapport_payment_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `manquant` decimal(12,2) NOT NULL,
  `excedant` decimal(12,2) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rapport_payment`
--

INSERT INTO `rapport_payment` (`rapport_payment_id`, `payment_id`, `manquant`, `excedant`, `description`) VALUES
(1, 1, '0.00', '0.20', ''),
(2, 2, '0.00', '0.04', ''),
(3, 3, '0.00', '0.00', ''),
(4, 4, '0.00', '0.00', ''),
(5, 5, '0.00', '0.00', ''),
(6, 6, '0.00', '0.50', ''),
(7, 7, '0.00', '0.02', ''),
(8, 8, '0.05', '0.00', ''),
(9, 9, '0.00', '0.00', ''),
(10, 10, '0.00', '0.00', ''),
(11, 11, '0.00', '0.00', ''),
(12, 12, '0.00', '0.00', ''),
(13, 13, '0.00', '0.00', '');

-- --------------------------------------------------------

--
-- Table structure for table `records`
--

CREATE TABLE `records` (
  `record_id` int(11) NOT NULL,
  `client_id` int(5) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nombre_hab` int(5) DEFAULT 1,
  `date_depot` date DEFAULT curdate(),
  `date_recupe` date DEFAULT NULL,
  `recupere` tinyint(1) DEFAULT 0,
  `reg_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `records`
--

INSERT INTO `records` (`record_id`, `client_id`, `user_id`, `nombre_hab`, `date_depot`, `date_recupe`, `recupere`, `reg_date`) VALUES
(1, 1, 2, 3, '2022-08-13', '2022-08-15', 1, '2022-08-13 02:15:23'),
(2, 1, 2, 3, '2022-08-13', '2022-08-15', 1, '2022-08-13 02:21:13'),
(3, 2, 1, 4, '2022-08-13', '2022-08-15', 1, '2022-08-13 08:21:48'),
(4, 3, 2, 10, '2022-08-14', '2022-08-16', 1, '2022-08-14 01:53:23'),
(5, 2, 2, 15, '2022-08-14', '2022-08-16', 1, '2022-08-14 01:58:04'),
(6, 2, 2, 19, '2022-08-15', '2022-08-17', 1, '2022-08-15 01:15:46'),
(7, 1, 2, 3, '2022-08-15', '2022-08-17', 1, '2022-08-15 12:59:34'),
(8, 3, 2, 3, '2022-08-15', '2022-08-17', 1, '2022-08-15 14:00:44'),
(9, 1, 2, 4, '2022-08-16', '2022-08-18', 1, '2022-08-16 03:00:27'),
(10, 1, 2, 5, '2022-08-18', '2022-08-20', 1, '2022-08-18 07:46:10'),
(11, 3, 2, 4, '2022-08-27', '2022-08-29', 1, '2022-08-27 01:27:00'),
(12, 1, 2, 6, '2022-08-27', '2022-08-29', 1, '2022-08-27 02:23:17'),
(13, 2, 2, 9, '2022-09-01', '2022-09-03', 1, '2022-09-01 21:44:01'),
(14, 4, 2, 3, '2022-09-15', '2022-09-17', 0, '2022-09-15 07:13:39'),
(15, 4, 2, 5, '2022-09-15', '2022-09-17', 0, '2022-09-15 10:40:59');

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `type_id` int(11) NOT NULL,
  `type_name` varchar(20) NOT NULL DEFAULT 'coton',
  `type_price` varchar(20) NOT NULL DEFAULT '0.00',
  `type_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`type_id`, `type_name`, `type_price`, `type_active`) VALUES
(1, 'coton', '3.75', 1),
(2, 'nilon', '1.80', 1),
(3, 'jeans', '5.00', 0),
(4, 'cuir', '3.00', 0),
(5, 'laine', '1.50', 0),
(6, 'mousse', '2.00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(20) CHARACTER SET latin1 NOT NULL DEFAULT 'user',
  `password` varchar(200) CHARACTER SET latin1 NOT NULL DEFAULT password(1234),
  `avatar` text DEFAULT 'images/users/img_default.png',
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `access` varchar(20) DEFAULT 'editor',
  `date_reg` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `avatar`, `active`, `access`, `date_reg`) VALUES
(1, 'admin', '*A4B6157319038724E3560894F7F932C8886EBFCF', 'images/users/av_1626217317.png', 1, 'admin', '2021-04-09 23:09:32'),
(2, 'user', '*A4B6157319038724E3560894F7F932C8886EBFCF', 'images/users/av_1660563811.png', 1, 'editor', '2021-08-07 02:03:39'),
(3, 'caisse', '*A4B6157319038724E3560894F7F932C8886EBFCF', 'images/users/av_1663225486.png', 1, 'caisse', '2022-08-09 22:49:51'),
(4, 'Louise', '*A4B6157319038724E3560894F7F932C8886EBFCF', 'images/users/av_1660803644.png', 0, 'editor', '2022-08-18 08:16:24');

-- --------------------------------------------------------

--
-- Table structure for table `vetements`
--

CREATE TABLE `vetements` (
  `vetement_id` int(11) NOT NULL,
  `record_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `vetement_num` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vetements`
--

INSERT INTO `vetements` (`vetement_id`, `record_id`, `type_id`, `vetement_num`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 1),
(3, 1, 3, 1),
(4, 2, 1, 2),
(5, 2, 2, 1),
(6, 3, 1, 1),
(7, 3, 2, 2),
(8, 3, 3, 1),
(9, 4, 1, 6),
(10, 4, 3, 4),
(11, 5, 1, 5),
(12, 5, 3, 10),
(13, 6, 3, 19),
(14, 7, 1, 3),
(15, 8, 1, 3),
(16, 9, 1, 2),
(17, 9, 2, 1),
(18, 9, 3, 1),
(19, 10, 1, 4),
(20, 10, 2, 1),
(21, 11, 1, 2),
(22, 11, 2, 2),
(23, 12, 1, 1),
(24, 12, 2, 3),
(25, 12, 3, 2),
(26, 13, 1, 5),
(27, 13, 2, 3),
(28, 13, 3, 1),
(29, 14, 1, 1),
(30, 14, 2, 2),
(31, 15, 1, 4),
(32, 15, 2, 1);

-- --------------------------------------------------------

--
-- Structure for view `monthly_repport`
--
DROP TABLE IF EXISTS `monthly_repport`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `monthly_repport`  AS SELECT sum(`payments`.`montant`) AS `input`, month(`payments`.`payment_date`) AS `month`, year(`payments`.`payment_date`) AS `year` FROM `payments` GROUP BY year(`payments`.`payment_date`), month(`payments`.`payment_date`) union select sum(`depenses`.`montant`) AS `output`,month(`depenses`.`date_reg`) AS `month`,year(`depenses`.`date_reg`) AS `year` from `depenses` group by year(`depenses`.`date_reg`),month(`depenses`.`date_reg`)  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `depenses`
--
ALTER TABLE `depenses`
  ADD PRIMARY KEY (`depense_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `logins`
--
ALTER TABLE `logins`
  ADD PRIMARY KEY (`login_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `record_id` (`record_id`);

--
-- Indexes for table `rapport_payment`
--
ALTER TABLE `rapport_payment`
  ADD PRIMARY KEY (`rapport_payment_id`),
  ADD KEY `payment_id` (`payment_id`);

--
-- Indexes for table `records`
--
ALTER TABLE `records`
  ADD PRIMARY KEY (`record_id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `receptioniste` (`user_id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vetements`
--
ALTER TABLE `vetements`
  ADD PRIMARY KEY (`vetement_id`),
  ADD KEY `gestion_id` (`record_id`),
  ADD KEY `habit_id` (`type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `depenses`
--
ALTER TABLE `depenses`
  MODIFY `depense_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `logins`
--
ALTER TABLE `logins`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `rapport_payment`
--
ALTER TABLE `rapport_payment`
  MODIFY `rapport_payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `records`
--
ALTER TABLE `records`
  MODIFY `record_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vetements`
--
ALTER TABLE `vetements`
  MODIFY `vetement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `depenses`
--
ALTER TABLE `depenses`
  ADD CONSTRAINT `depenses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `logins`
--
ALTER TABLE `logins`
  ADD CONSTRAINT `logins_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `payments_ibfk_2` FOREIGN KEY (`record_id`) REFERENCES `records` (`record_id`);

--
-- Constraints for table `rapport_payment`
--
ALTER TABLE `rapport_payment`
  ADD CONSTRAINT `rapport_payment_ibfk_1` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`payment_id`);

--
-- Constraints for table `records`
--
ALTER TABLE `records`
  ADD CONSTRAINT `records_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`),
  ADD CONSTRAINT `records_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `vetements`
--
ALTER TABLE `vetements`
  ADD CONSTRAINT `vetements_ibfk_1` FOREIGN KEY (`record_id`) REFERENCES `records` (`record_id`),
  ADD CONSTRAINT `vetements_ibfk_2` FOREIGN KEY (`type_id`) REFERENCES `types` (`type_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
