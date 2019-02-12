-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 12, 2019 at 09:16 AM
-- Server version: 5.7.19
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lamassui_sales`
--

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `company_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `specialty_id` int(11) NOT NULL,
  `client_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `company_name`, `specialty_id`, `client_name`, `client_phone`, `address`, `email`, `created_at`, `updated_at`) VALUES
(1, 'Rosoleen Beauty Center', 2, 'Mr. Ahmad Sami', '07731288079', 'Baghdad - Karada 52st', 'hiags15@gmail.com', '2017-12-22 09:13:12', '2018-01-21 07:03:52'),
(2, 'Ward Beauty Center', 2, 'Mr. Hussam Al Shahrestani', '07715611349', 'Baghdad - Karada Al-wathiq', 'hussam.alshahrestani@gmail.com', '2017-12-22 09:45:08', '2018-01-21 07:04:09'),
(3, 'Iraq Wings (2)', 6, 'Mr. Mohammed Abdalsalam', '07715542175', 'Baghdad - Al-Arasat St', 'nasa.travels1@gmail.com', '2017-12-22 09:56:41', '2018-01-23 07:05:56'),
(4, 'Iraq Wings (1)', 6, 'Mr. Mustafa Mohammed', '07800225444', 'Baghdad - Al-Arasat St', 'nasa.travels1@gmail.com', '2017-12-23 06:38:46', '2018-01-23 07:05:40'),
(5, 'Julphar', 1, 'Dr. Hussain', '07901464762', 'Baghdad - Karada 52st', 'hussein.qasim.h@gmail.com', '2018-01-09 05:06:48', '2018-01-09 05:06:48'),
(6, 'Bank Audi', 4, 'Mr. Marwan A. Tofiq', '07707958747', 'Baghdad - Al-Jadria', 'Marwan.Tofiq@banqueaudi.com', '2018-01-15 10:13:45', '2018-01-21 07:05:04'),
(7, 'Al-Awal office', 1, 'Mr. Ali', '07719908748', 'Baghdad - Al-Senaa St.', 'none@none.com', '2018-01-20 05:30:12', '2018-01-21 07:05:19'),
(8, 'Al-Alam Bank', 4, 'Mrs. Ghada', '07807699697', 'Baghdad - Al-Ferdoos Square', 'none@none.com', '2018-01-20 05:40:48', '2018-01-21 07:05:40'),
(9, 'Joe Raad', 2, 'Mr. Zaher', '07727771773', 'Baghdad - Al-Harthiya', 'none@none.com', '2018-01-20 05:44:16', '2018-01-21 07:06:10'),
(10, 'Al-Massal', 6, 'Mr. Basim', '07901553177', 'Baghdad - outer Karada', 'none@none.com', '2018-01-20 05:47:24', '2018-01-21 07:06:27'),
(11, 'Al-Luma', 6, 'Mrs. Luma', '07809124305', 'Baghdad - outer Karada', 'none@none.com', '2018-01-20 05:55:37', '2018-01-21 07:06:40'),
(12, 'Ajead office', 1, 'Dr. Anas', '07701761842', 'Baghdad - Palestine St.', 'dr.anasalbak@gmail.com', '2018-01-20 06:03:12', '2018-01-29 06:48:02'),
(13, 'Al-Khyrat group', 16, 'Mr. Majid', '07905109050', 'Baghdad - Al-Mansur', 'none@none.com', '2018-01-20 06:05:42', '2018-01-21 07:07:00'),
(14, 'Nabd Al-Rafedain', 16, 'Mr. Abdul Rahman', '07717727712', 'Baghdad - Al-Mansur (Mass Building)', 'none@none.com', '2018-01-20 06:08:57', '2018-01-21 07:07:20'),
(15, 'Al-Mumaz office', 1, 'Dr.Taha', '07905977727', 'Baghdad - Al-Harthiya', 'none@none.com', '2018-01-20 06:13:13', '2018-01-20 06:13:13'),
(16, 'Al-Jwar office', 1, 'Dr. Mohamed Waleed', '07715129381', 'Baghdad - Al-Saadoon St.', 'Mwm_ms@yahoo.com', '2018-01-20 06:16:34', '2018-01-22 05:48:19'),
(17, 'Al-Aridh', 11, 'Mr. Husam Ghalayani', '07702578260', 'Baghdad - Al-Mansur', 'none@none.com', '2018-01-20 06:19:08', '2018-01-24 04:51:29'),
(18, 'Siemens', 1, 'Mr. Musaab', '07905267618', 'Baghdad - Al-Senaa St.', 'none@none.com', '2018-01-20 07:04:37', '2018-01-21 07:07:40'),
(19, 'Ardh Al-Mawada', 1, 'Mr. Riyadh', '00000000000', 'Baghdad - Bab Al-Moatham', 'none@none.com', '2018-01-20 07:08:51', '2018-01-21 07:07:57'),
(20, 'Sajad Al-Anbari (Jewelery)', 12, 'Mr. Omar', '00000000000', 'Baghdad - Al-Mansur (Mass Building)', 'none@none.com', '2018-01-20 07:11:57', '2018-01-21 07:10:34'),
(21, 'Mawared Al-Mosawaqoon', 18, 'Mr. Ayad', '07809500000', 'none', 'none@none.com', '2018-01-20 07:21:32', '2018-01-21 07:11:13'),
(22, 'Al-Taif', 19, 'Mr. Ridha', '07704447275', 'Baghdad - Inner Karada', 'none@none.com', '2018-01-20 07:27:44', '2018-01-21 07:13:43'),
(23, 'Tulip office', 1, 'Dr. Ali Ghalib', '00000000000', 'Baghdad - Al-Mansur', 'none@none.com', '2018-01-20 07:33:06', '2018-01-29 06:47:43'),
(24, 'Silver Cosmetic', 13, 'Mr. Ahmed', '07906136627', 'Baghdad - Al-Mansur (Al-Mansur Mall)', 'none@none.com', '2018-01-20 07:36:25', '2018-01-21 07:14:22'),
(25, 'Al-Nakheel school', 9, 'Dr.Amer', '07902153838', 'Baghdad - Al-Aameriya', 'none@none.com', '2018-01-20 07:39:41', '2018-01-21 04:57:42'),
(26, 'Home (wallpaper)', 12, 'none', '07710787971', 'Baghdad - Karada 42st', 'none@none.com', '2018-01-20 07:41:37', '2018-01-21 04:14:11'),
(27, 'Enjaz', 20, 'Mr. Mohamed Falah', '07827833148', 'Baghdad - Inner Karada', 'none@none.com', '2018-01-20 07:52:53', '2018-01-21 07:14:04'),
(28, 'Al-Khasaki (sweets)', 12, 'Mr. Sajad', '00000000000', 'Baghdad - Al-Mansur', 'none@none.com', '2018-01-20 07:55:46', '2018-01-22 08:28:56'),
(29, 'Alaq Al-Rafedain', 16, 'Mr. Taha', '07811195855', 'Baghdad - Al-Mansur', 'none@none.com', '2018-01-20 07:58:25', '2018-01-21 07:14:53'),
(30, 'Tabebkm', 1, 'Mr. Omar', '07804299010', 'Baghdad - Al-Mansur', 'none@none.com', '2018-01-20 08:00:04', '2018-01-21 07:15:04'),
(31, 'Al-Ufooq Al-Jadeed', 11, 'Dr.Mayada', '07811893652', 'Baghdad - outer Karada', 'none@none.com', '2018-01-20 08:02:12', '2018-01-22 08:29:18'),
(32, 'Nadharty Center', 2, 'Dr.Hanan', '07713400384', 'Baghdad - Hay Al-Adel', 'none@none.com', '2018-01-20 08:04:24', '2018-01-20 08:04:24'),
(33, 'Prestige', 11, 'Mr. Husam', '00000000000', 'Baghdad - Al-Arasat St', 'none@none.com', '2018-01-20 08:08:25', '2018-01-21 07:15:21'),
(34, 'Today Radio', 21, 'Mr. Hayman', '00000000000', 'Baghdad - outer Karada', 'none@none.com', '2018-01-20 08:12:52', '2018-01-21 07:19:34'),
(35, 'Dr. Ali', 1, 'Dr.Ali', '00000000000', 'none', 'none@none.com', '2018-01-20 08:14:28', '2018-01-24 04:49:50'),
(36, 'Ebtikar', 20, 'Mr. Ali Anwar', '00000000000', 'none', 'none@none.com', '2018-01-20 08:16:02', '2018-01-24 04:49:35'),
(37, 'Beauty Princes', 13, 'Mr. Khalid', '07803332222', 'Baghdad - Al-Mansur', 'none@none.com', '2018-01-20 08:18:11', '2018-01-21 07:17:41'),
(38, 'Al-Roshem', 16, 'Noor Aldeen', '00000000000', 'none', 'none@none.com', '2018-01-20 08:27:55', '2018-01-20 08:27:55'),
(39, 'Al-Qifaf office', 1, 'Mr. Ahmed Zulam', '07704715207', 'Baghdad - Bab Al-Moatham', 'sales2@alqiffaf.com', '2018-01-20 08:30:02', '2018-01-29 06:51:06'),
(40, 'Wahat Al-Zaytoon', 1, 'Mr. Saad', '00000000000', 'none', 'none@none.com', '2018-01-20 08:31:04', '2018-01-21 07:16:44'),
(41, 'Al-Mumaz office', 1, 'Dr. Ahmed Al-Azawi', '00000000000', 'Baghdad - Al-Harthiya', 'none@none.com', '2018-01-20 08:32:57', '2018-01-24 04:49:21'),
(42, 'Al-Tawasil', 6, 'Mr. Maytham Esa', '00000000000', 'Baghdad - Al-Mansur', 'none@none.com', '2018-01-20 08:35:00', '2018-01-21 07:18:15'),
(43, 'Nasma Company (Food)', 12, 'Mr. Saif', '00000000000', 'Baghdad - Jamila', 'none@none.com', '2018-01-20 08:40:04', '2018-01-21 07:17:05'),
(44, 'Mazaya Rest.', 7, 'Mr. Hussain', '00000000000', 'Baghdad - Al-Mansur', 'none@none.com', '2018-01-20 08:41:18', '2018-01-21 07:18:35'),
(45, 'Beauty Princes Center', 2, 'Mr. Rasool , Mr. Dhyaa', '00000000000', 'Baghdad - Al-Mansur', 'none@none.com', '2018-01-20 08:43:36', '2018-01-24 04:56:21'),
(46, 'Al-Rahebat Pharmacy', 22, 'Mr. Salwan', '00000000000', 'Baghdad - Inner Karada', 'none@none.com', '2018-01-20 08:58:39', '2018-01-21 07:18:44'),
(47, 'Maya Beauty', 2, 'Mrs. Maya', '00000000000', 'Baghdad - Al-Mansur', 'none@none.com', '2018-01-20 08:59:36', '2018-01-21 07:18:23'),
(48, 'Chocolate Bar (sweets)', 12, 'Mr. Mohamed', '07713458844', 'Baghdad - Al-Mansur', 'none@none.com', '2018-01-20 09:01:48', '2018-01-27 08:13:13'),
(49, 'Kaser AL-Jamal', 2, 'Dr. Osama', '00000000000', 'Baghdad - Al-Mansur', 'none@none.com', '2018-01-20 09:03:19', '2018-01-24 04:49:03'),
(50, 'Al-Qaswaa Group', 17, 'Mr. Mohamed', '00000000000', 'Baghdad - Karada', 'none@none.com', '2018-01-20 09:05:40', '2018-01-21 07:17:52'),
(51, 'Royal Man', 2, 'Mr. Ali', '00000000000', 'Baghdad - Al-Jadria', 'none@none.com', '2018-01-20 09:06:59', '2018-01-21 07:19:08'),
(52, 'Qube Cafe', 7, 'Mr. Ahmed', '00000000000', 'Baghdad - Al-Harthiya (Al-Harthiya Mall)', 'none@none.com', '2018-01-20 09:08:44', '2018-01-21 07:18:02'),
(53, 'Atlas Airline', 6, 'Mr. Mustafa', '00000000000', 'Baghdad - Al-Mansur', 'none@none.com', '2018-01-20 09:18:57', '2018-01-21 07:16:36'),
(54, 'Al-Rwad Institute', 9, 'Mr. Loay', '07710204448', 'Baghdad - Al-Mansur (Hay Dragh)', 'none@none.com', '2018-01-21 04:07:00', '2018-01-21 07:16:24'),
(55, 'Al-Aqmar School', 9, 'Mr. Zaher', '07711100007', 'none', 'none@none.com', '2018-01-21 04:16:33', '2018-01-21 07:16:12'),
(56, 'Asheq Baghdad School', 9, 'none', '07819999925', 'none', 'none@none.com', '2018-01-21 04:17:48', '2018-01-21 04:17:48'),
(57, 'Fly Baghdad Airline', 6, 'Mr. Ali', '00000000000', 'none', 'none@none.com', '2018-01-21 04:18:43', '2018-01-21 07:16:01'),
(58, 'Classic Burger Rest.', 7, 'Mr. Zaid', '07806666657', 'Baghdad - Al-Harthiya (Al-Harthiya Mall)', 'none@none.com', '2018-01-21 04:22:19', '2018-01-21 07:15:50'),
(59, 'Zain Al-Iraq Bank', 4, 'Mrs. Afan', '00000000000', 'Baghdad - Al-Arasat St', 'none@none.com', '2018-01-21 04:24:31', '2018-01-24 08:24:42'),
(60, 'Tablya Rest.', 7, 'Mr. Zaid', '07806666657', 'Baghdad - Al-Harthiya (Al-Harthiya Mall)', 'none@none.com', '2018-01-21 04:29:36', '2018-01-21 07:15:29'),
(62, 'Turquaz', 13, 'Mr. Hamza', '07812504780', 'Baghdad - Al-Mansur', 'none@none.com', '2018-01-22 08:34:47', '2018-01-28 05:22:49'),
(63, 'Ibn Al-Nafees', 13, 'Mr.Ahmed Al-Shemari', '00000000000', 'Baghdad - Al-Mansur', 'none@none.com', '2018-01-22 08:37:02', '2018-01-22 08:37:02'),
(64, 'Baghdad Endodontic Society', 3, 'Dr. Ghaith', '07901368148', 'Baghdad - Al-Mansur', 'none@none.com', '2018-01-22 09:14:23', '2018-01-22 09:20:53'),
(66, 'Al-Naqel Automotive Company', 15, 'Mr. Ali', '07733334133', 'Baghdad - Al-Mansur', 'none@none.com', '2018-01-23 04:27:45', '2018-01-29 06:47:01'),
(67, 'St Al-Sham Rest.', 7, 'Mr. Ali cha cha', '07822224436', 'Baghdad - Al-Mansur', 'none@none.com', '2018-01-23 05:25:07', '2018-01-27 05:19:07'),
(68, 'Yaqoot Al-Hadhara Company', 1, 'Mr. Haytham', '07704576735', 'Baghdad - Al-Harthiya', 'none@none.com', '2018-01-23 09:05:43', '2018-01-27 05:23:06'),
(69, 'Al-Enaya Al-Sehia Office', 1, 'Dr. Taha', '07905977727', 'Baghdad - Al-Harthiya', 'taha.abeed@gmail.com', '2018-01-24 04:46:11', '2018-01-25 03:58:03'),
(70, 'Lucy Beauty Center', 2, 'Mrs. Rosol', '07901759131', 'Baghdad - Al-Mansur', 'none@none.com', '2018-01-24 09:28:25', '2018-01-24 09:28:25'),
(71, 'Al-Muhamadi Jewelry', 12, 'Mr. Taha Al-Muhamadi', '00000000000', 'Al-Anbar', 'none@none.com', '2018-01-25 04:31:32', '2018-01-25 04:31:32'),
(72, 'Dr. Ziyad Clinic', 3, 'Dr. Zyad Esam', '07822802267', 'Baghdad - Hay Al-Jamiaa', 'none@none.com', '2018-01-25 07:44:26', '2018-01-25 08:17:00'),
(73, 'Al-Rafedain Clinic', 3, 'Dr. Munir', '00000000000', 'Baghdad - Al-Mansur', 'none@none.com', '2018-01-27 07:29:03', '2018-01-27 07:29:03'),
(74, 'United Tamara', 1, 'Mrs. Tamara', '00000000000', 'Baghdad', 'none@none.com', '2018-01-29 06:18:57', '2018-01-29 06:46:39'),
(75, 'Al-Rasheed Collage', 23, 'none', '00000000000', 'Baghdad - Hay Al-Jihad', 'none@none.com', '2018-01-30 03:45:40', '2018-01-30 03:45:40');

-- --------------------------------------------------------

--
-- Table structure for table `debt`
--

DROP TABLE IF EXISTS `debt`;
CREATE TABLE IF NOT EXISTS `debt` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `debt_name_id` int(11) NOT NULL,
  `amount` decimal(7,2) NOT NULL,
  `remaining` decimal(7,2) NOT NULL,
  `date` timestamp NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `debt`
--

INSERT INTO `debt` (`id`, `debt_name_id`, `amount`, `remaining`, `date`, `note`, `created_at`, `updated_at`) VALUES
(3, 4, '3571.00', '0.00', '2018-01-16 21:00:00', 'Printing Debt December 2017', '2018-01-27 08:54:30', '2018-02-01 04:20:13'),
(4, 2, '200.00', '0.00', '2018-01-29 21:00:00', 'none', '2018-01-31 04:01:14', '2018-02-01 04:49:27'),
(7, 3, '1000.00', '1000.00', '2018-01-31 21:00:00', 'nonoe', '2018-02-01 06:25:41', '2018-02-01 09:33:17');

-- --------------------------------------------------------

--
-- Table structure for table `debt_name`
--

DROP TABLE IF EXISTS `debt_name`;
CREATE TABLE IF NOT EXISTS `debt_name` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `debt_name`
--

INSERT INTO `debt_name` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'Majeed Abid', '2018-01-27 05:58:42', '2018-01-27 05:59:26'),
(2, 'Ameen Majeed', '2018-01-27 05:59:07', '2018-01-27 05:59:07'),
(3, 'Zainab Majeed', '2018-01-27 05:59:52', '2018-01-27 05:59:52'),
(4, 'Baidaa Hameed', '2018-01-27 06:00:14', '2018-01-27 06:00:14');

-- --------------------------------------------------------

--
-- Table structure for table `debt_paid`
--

DROP TABLE IF EXISTS `debt_paid`;
CREATE TABLE IF NOT EXISTS `debt_paid` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `debt_id` int(11) NOT NULL,
  `debt_name_id` int(11) NOT NULL,
  `amount` decimal(7,2) NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `debt_paid`
--

INSERT INTO `debt_paid` (`id`, `debt_id`, `debt_name_id`, `amount`, `note`, `created_at`, `updated_at`) VALUES
(1, 7, 3, '100.00', 'nonoe', '2018-02-01 08:54:16', '2018-02-01 08:54:16'),
(2, 7, 3, '200.00', 'nonoe', '2018-02-01 08:55:24', '2018-02-01 08:55:24'),
(3, 7, 3, '100.00', 'nonoe', '2018-02-01 09:33:03', '2018-02-01 09:33:03');

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

DROP TABLE IF EXISTS `delivery`;
CREATE TABLE IF NOT EXISTS `delivery` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `delivery_type_id` int(11) NOT NULL,
  `amount` decimal(7,2) NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`id`, `delivery_type_id`, `amount`, `note`, `delivery_date`, `created_at`, `updated_at`) VALUES
(2, 1, '100.00', '', '2018-01-21 00:00:00', '2018-01-22 08:05:39', '2018-01-22 08:49:30'),
(3, 4, '24.00', '', '2018-01-21 00:00:00', '2018-01-22 08:50:59', '2018-01-22 08:51:06'),
(4, 1, '100.00', '70$ Bane Bawi \r\n$30 Abo Mustafa', '2018-01-25 00:00:00', '2018-01-27 05:08:56', '2018-01-27 05:11:10'),
(5, 1, '210.00', 'To Al-Enaya Al-Sehia Office', '2018-01-28 00:00:00', '2018-01-28 04:59:17', '2018-01-28 04:59:17');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_type`
--

DROP TABLE IF EXISTS `delivery_type`;
CREATE TABLE IF NOT EXISTS `delivery_type` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `delivery_type`
--

INSERT INTO `delivery_type` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'Bane Bawi Delivery Company', '2018-01-22 03:53:51', '2018-01-22 03:55:07'),
(2, 'Al-Rafedain Delivery Company', '2018-01-22 03:54:39', '2018-02-03 04:25:47'),
(3, 'Taha Delivery Company', '2018-01-22 03:55:27', '2018-01-22 03:55:27'),
(4, 'Tawseel Baghdad Delivery Company', '2018-01-22 03:55:50', '2018-01-22 03:55:50'),
(5, 'Sama Al-Nahrain Delivery Company', '2018-01-22 03:57:29', '2018-01-22 03:57:29');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
CREATE TABLE IF NOT EXISTS `department` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'Development', '2017-12-13 06:03:01', '2017-12-13 06:03:01'),
(2, 'Designer', '2017-12-13 06:03:24', '2017-12-23 07:02:19'),
(3, 'Management', '2017-12-21 12:34:04', '2017-12-21 12:34:04'),
(4, 'Sales', '2017-12-21 16:42:42', '2017-12-21 16:42:42'),
(5, 'Social Media', '2017-12-21 16:47:18', '2017-12-21 16:47:18'),
(6, 'Accountant', '2018-01-22 04:57:00', '2018-01-22 04:57:00'),
(7, 'Lawyer', '2018-01-25 05:39:46', '2018-01-25 05:39:46'),
(8, 'Delevery', '2018-01-30 08:35:18', '2018-01-30 08:35:18');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
CREATE TABLE IF NOT EXISTS `employee` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `full_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `basic_salary` decimal(7,2) NOT NULL,
  `department_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `full_name`, `basic_salary`, `department_id`, `start_date`, `created_at`, `updated_at`) VALUES
(1, 'Zainab Majeed Adib', '500.00', 3, '2017-04-01', '2017-12-22 05:23:35', '2018-01-25 05:13:35'),
(2, 'Ali Bahjat Qasim', '900.00', 1, '2017-05-01', '2017-12-22 05:24:21', '2018-01-25 05:23:51'),
(3, 'Waleed Ismaeel Ibrahim', '800.00', 2, '2017-06-01', '2017-12-22 05:25:16', '2017-12-22 05:25:16'),
(4, 'Abdullah Basim Khudhair', '800.00', 1, '2017-11-01', '2017-12-22 05:25:57', '2018-01-22 06:35:50'),
(5, 'Emad Amir', '600.00', 5, '2017-09-21', '2017-12-22 05:27:11', '2017-12-22 05:27:11'),
(6, 'Nuha Alattar', '650.00', 2, '2017-09-01', '2017-12-22 05:27:52', '2018-01-22 06:36:06'),
(7, 'Hamed Hazim Ali', '900.00', 2, '2017-10-21', '2017-12-22 05:28:46', '2018-01-31 05:05:42'),
(8, 'Sara Ezaldeen', '500.00', 4, '2017-09-01', '2017-12-22 05:29:13', '2017-12-22 05:29:13'),
(9, 'Usama', '1000.00', 3, '2017-02-01', '2018-01-22 06:34:26', '2018-01-22 06:35:28'),
(10, 'Batool Shaban', '600.00', 6, '2018-01-20', '2018-01-22 06:39:05', '2018-01-22 06:39:05'),
(11, 'Amal Sleman', '75.00', 7, '2017-01-01', '2018-01-25 05:40:37', '2018-01-25 05:40:37'),
(12, 'Alaa Delevery', '120.00', 8, '2018-01-30', '2018-01-30 08:35:35', '2018-01-30 08:35:35');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

DROP TABLE IF EXISTS `expenses`;
CREATE TABLE IF NOT EXISTS `expenses` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `expenses_type_id` int(11) NOT NULL,
  `amount` decimal(7,2) NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `expenses_type_id`, `amount`, `note`, `date`, `created_at`, `updated_at`) VALUES
(1, 12, '100.00', 'Earthlink, No. 5884 , 21-1-2018 beginning Date', '2018-01-20 21:00:00', '2018-01-23 07:25:38', '2018-01-31 04:51:36'),
(5, 7, '200.00', 'Ali - $170 SutterStock No.1767\r\n$10 freepik Website', '2018-01-23 21:00:00', '2018-01-25 04:56:15', '2018-01-31 08:58:33'),
(6, 7, '1000.00', 'Emad - 300 Al-Rafedain Clinic\r\n200 Previous debts\r\n300 Dr. Ziyad Clinic\r\n200 Lamassu Page \r\nInvoice No. 1971\r\nInvoice No.1781', '2018-01-26 21:00:00', '2018-01-27 07:25:01', '2018-01-31 08:58:49'),
(7, 9, '200.00', '5% on Invoice, Islamic Bank Invoice $4000', '2018-01-15 21:00:00', '2018-01-27 08:56:52', '2018-01-31 04:52:51'),
(8, 10, '38.00', 'Cleaning & others', '2018-01-21 21:00:00', '2018-01-27 08:58:49', '2018-01-27 08:58:49'),
(9, 11, '29.00', 'Zainab Card', '2018-01-26 21:00:00', '2018-01-27 09:04:36', '2018-01-31 05:12:40'),
(10, 10, '16.00', 'tea, Nescafe & Others', '2018-01-28 21:00:00', '2018-01-29 06:06:43', '2018-01-29 06:07:52'),
(11, 10, '150.00', 'Al-Ameer Show , No.201\r\nElectrical Materials', '2018-01-28 21:00:00', '2018-01-29 06:23:28', '2018-01-29 06:24:29'),
(12, 12, '100.00', 'Smart Waves, Paid at 30-1-2018', '2018-01-29 21:00:00', '2018-01-30 06:03:19', '2018-01-31 04:50:27'),
(13, 13, '100.00', 'Authority Checking Fees', '2018-01-29 21:00:00', '2018-01-31 05:07:08', '2018-01-31 05:34:54'),
(14, 10, '500.00', 'Labtop ASUS to Emad $490 + $10 transportation Fees\r\nNo.2821', '2018-01-30 21:00:00', '2018-01-31 07:57:06', '2018-01-31 08:56:44');

-- --------------------------------------------------------

--
-- Table structure for table `expenses_type`
--

DROP TABLE IF EXISTS `expenses_type`;
CREATE TABLE IF NOT EXISTS `expenses_type` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expenses_type`
--

INSERT INTO `expenses_type` (`id`, `title`, `note`, `created_at`, `updated_at`) VALUES
(4, 'Rent', '$1300', '2017-12-23 16:49:47', '2018-01-31 04:53:12'),
(7, 'Master Card', 'None', '2018-01-25 03:22:52', '2018-01-25 03:22:52'),
(9, 'Commission', 'None', '2018-01-27 08:55:21', '2018-01-31 04:52:59'),
(10, 'Office', '$100', '2018-01-27 08:58:11', '2018-01-31 04:52:12'),
(11, 'Mobile Card', 'None', '2018-01-27 09:02:57', '2018-01-31 05:12:07'),
(12, 'Internet', '$200', '2018-01-30 06:02:49', '2018-01-31 04:52:01'),
(13, 'Others', 'None', '2018-01-31 05:34:41', '2018-01-31 05:34:41');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_transaction`
--

DROP TABLE IF EXISTS `invoice_transaction`;
CREATE TABLE IF NOT EXISTS `invoice_transaction` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) NOT NULL,
  `amount` decimal(7,2) NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoice_transaction`
--

INSERT INTO `invoice_transaction` (`id`, `invoice_id`, `amount`, `note`, `user_id`, `created_at`, `updated_at`) VALUES
(3, 3, '0.00', 'First Paid', 6, '2018-01-15 10:20:31', '2018-01-15 10:20:31'),
(5, 5, '0.00', 'First Paid', 11, '2018-01-22 05:52:26', '2018-01-22 05:52:26'),
(6, 6, '0.00', 'First Paid', 11, '2018-01-22 09:23:43', '2018-01-22 09:23:43'),
(7, 7, '0.00', 'First Paid', 11, '2018-01-22 09:24:41', '2018-01-22 09:24:41'),
(9, 9, '0.00', 'First Paid', 11, '2018-01-23 04:29:51', '2018-01-23 04:29:51'),
(10, 10, '0.00', 'First Paid', 11, '2018-01-23 04:54:55', '2018-01-23 04:54:55'),
(12, 7, '50.00', 'paid at 23-1-2018', 11, '2018-01-23 08:53:55', '2018-01-23 08:53:55'),
(13, 6, '3604.00', 'paid at 23-1-2018', 11, '2018-01-23 08:54:42', '2018-01-23 08:54:42'),
(14, 12, '0.00', 'First Paid', 11, '2018-01-23 08:57:31', '2018-01-23 08:57:31'),
(15, 13, '200.00', 'First Paid', 11, '2018-01-23 09:14:53', '2018-01-23 09:14:53'),
(16, 13, '1000.00', 'paid at 23-1-2018', 11, '2018-01-23 09:38:25', '2018-01-23 09:38:25'),
(17, 14, '0.00', 'First Paid', 11, '2018-01-24 09:20:47', '2018-01-24 09:20:47'),
(18, 15, '0.00', 'First Paid', 11, '2018-01-24 09:33:17', '2018-01-24 09:33:17'),
(19, 16, '0.00', 'First Paid', 11, '2018-01-24 09:34:15', '2018-01-24 09:34:15'),
(20, 17, '0.00', 'First Paid', 11, '2018-01-25 04:26:06', '2018-01-25 04:26:06'),
(21, 18, '0.00', 'First Paid', 11, '2018-01-25 04:32:33', '2018-01-25 04:32:33'),
(22, 19, '600.00', 'First Paid', 11, '2018-01-25 07:49:18', '2018-01-25 07:49:18'),
(25, 22, '525.00', 'First Paid', 11, '2018-01-27 05:56:20', '2018-01-27 05:56:20'),
(26, 23, '0.00', 'First Paid', 11, '2018-01-28 05:21:25', '2018-01-28 05:21:25'),
(27, 5, '680.00', 'Paid at 28-1-2018', 11, '2018-01-28 09:09:36', '2018-01-28 09:09:36'),
(28, 24, '0.00', 'First Paid', 11, '2018-01-29 06:20:11', '2018-01-29 06:20:11'),
(29, 23, '1100.00', 'paid at 29-1-2018', 11, '2018-01-29 09:11:31', '2018-01-29 09:11:31'),
(30, 25, '0.00', 'First Paid', 11, '2018-01-30 03:47:15', '2018-01-30 03:47:15'),
(31, 26, '0.00', 'First Paid', 11, '2018-01-30 08:18:42', '2018-01-30 08:18:42'),
(32, 17, '500.00', 'None', 11, '2018-01-31 06:31:06', '2018-01-31 06:31:06'),
(33, 27, '0.00', 'First Paid', 11, '2018-01-31 06:53:41', '2018-01-31 06:53:41');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

DROP TABLE IF EXISTS `item`;
CREATE TABLE IF NOT EXISTS `item` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `quantity` int(11) NOT NULL DEFAULT '1',
  `amount` decimal(7,2) NOT NULL,
  `sales_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=119 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `title`, `description`, `quantity`, `amount`, `sales_id`, `created_at`, `updated_at`) VALUES
(3, 'Business card', '350 gm with Spot', 3200, '0.10', 3, '2018-01-15 10:20:31', '2018-01-15 10:20:31'),
(11, 'Poster & Logo Design', 'None', 1, '50.00', 7, '2018-01-22 09:24:41', '2018-01-22 09:24:41'),
(24, 'business Card', 'None', 1000, '0.10', 9, '2018-01-23 04:57:46', '2018-01-23 04:57:46'),
(36, 'Notebook', 'None', 1000, '4.50', 6, '2018-01-23 08:13:30', '2018-01-23 08:13:30'),
(37, 'acrylic shield', 'None', 60, '22.00', 6, '2018-01-23 08:13:30', '2018-01-23 08:13:30'),
(38, 'Pen', 'None', 1000, '0.40', 6, '2018-01-23 08:13:30', '2018-01-23 08:13:30'),
(39, 'Badges', 'None', 1000, '0.99', 6, '2018-01-23 08:13:30', '2018-01-23 08:13:30'),
(50, 'Cataloge', '28 inside paper 170gm + Cover 200gm  with selevon cover ( 200$ Paid in 2017 , Invoice 780)', 1000, '2.30', 13, '2018-01-24 08:19:14', '2018-01-24 08:19:14'),
(57, 'Brochure', 'Brochure 350 gm with spot', 1000, '0.35', 15, '2018-01-24 09:33:17', '2018-01-24 09:33:17'),
(58, 'Business Card', '500 gm with spot', 1000, '0.10', 15, '2018-01-24 09:33:17', '2018-01-24 09:33:17'),
(68, 'Brochure', 'JULMENTIN 2X Master Brochure 350 gm with spot A4 (8 Pages) with spot & land shipping', 200, '0.80', 14, '2018-01-25 04:11:47', '2018-01-25 04:11:47'),
(69, 'Brochure', 'JULMENTIN 2X Leave Behind 1 ( Page 1,2,3,8 from Master Brochure ) 350 gm with spot A4 (4 Pages) with spot & land shipping', 4000, '0.40', 14, '2018-01-25 04:11:47', '2018-01-25 04:11:47'),
(70, 'Brochure', 'JULMENTIN 2X Leave Behind 2 ( Page 1,4,5,8 from Master\r\nBrochure ) 350 gm with spot A4 (4 Pages) with spot & land shipping', 4000, '0.40', 14, '2018-01-25 04:11:47', '2018-01-25 04:11:47'),
(71, 'Brochure', 'JULMENTIN 2X Leave Behind 3 ( Page 1,6,7,8 from Master\r\nBrochure ) 350 gm with spot A4 (4 Pages) with spot & land shipping', 4000, '0.40', 14, '2018-01-25 04:11:47', '2018-01-25 04:11:47'),
(72, 'Brochure', 'JULMENTIN TID Adult Brochure 350 gm with spot A4 (4 Pages) with spot & land shipping', 5000, '0.40', 14, '2018-01-25 04:11:47', '2018-01-25 04:11:47'),
(73, 'Brochure', 'JULMENTIN TID Pediatric Brochure 350 gm with spot A4 (4 Pages) with spot & land shipping', 4000, '0.40', 14, '2018-01-25 04:11:47', '2018-01-25 04:11:47'),
(76, 'Business Card', '500 gm with spot', 1000, '0.10', 18, '2018-01-25 04:32:33', '2018-01-25 04:32:33'),
(80, 'xxx', 'None', 1, '100.00', 20, '2018-01-26 12:55:57', '2018-01-26 12:55:57'),
(81, 'Facebook Design and Manging', 'Facebook Design & Managing - 300$ MasterCard , Design 300$', 1, '600.00', 19, '2018-01-26 18:50:55', '2018-01-26 18:50:55'),
(89, 'business Card', '21Card , Each Name 200Card', 21, '25.00', 22, '2018-01-27 05:56:20', '2018-01-27 05:56:20'),
(90, 'Brochures Progesta', 'A4 - 4pages with spot', 1000, '0.68', 5, '2018-01-27 06:27:57', '2018-01-27 06:27:57'),
(91, 'System', 'Booking System - New Clients - Reservation - Point - SMS', 1, '900.00', 16, '2018-01-27 07:53:51', '2018-01-27 07:53:51'),
(96, 'Table Paper 1', 'None', 10000, '0.06', 12, '2018-01-27 08:08:25', '2018-01-27 08:08:25'),
(97, 'Table Paper Design', 'None', 1, '50.00', 12, '2018-01-27 08:08:25', '2018-01-27 08:08:25'),
(104, 'Paper bags', 'Dimension 36*30*15', 1000, '1.85', 23, '2018-01-28 08:15:50', '2018-01-28 08:15:50'),
(105, 'Envelope', 'Small Envelope , Dimension 22.5*10', 1000, '0.50', 23, '2018-01-28 08:15:50', '2018-01-28 08:15:50'),
(106, 'business Card', 'Free', 1000, '0.00', 23, '2018-01-28 08:15:50', '2018-01-28 08:15:50'),
(111, 'Prochures', 'A4* 3 Trifold Brochure , 350gm with spot .', 1000, '0.85', 10, '2018-01-29 04:42:37', '2018-01-29 04:42:37'),
(112, 'Role Up', '85*200 with small Base', 1, '50.00', 10, '2018-01-29 04:42:37', '2018-01-29 04:42:37'),
(113, 'Pen', 'Pen With Logo', 1000, '1.50', 24, '2018-01-29 06:20:11', '2018-01-29 06:20:11'),
(115, 'Cup', 'With Logo Printing', 1000, '2.30', 26, '2018-01-30 08:18:42', '2018-01-30 08:18:42'),
(116, 'Brochure', 'A4* 3 Trifold Brochure , 350gm with spot .', 1000, '0.85', 25, '2018-01-31 05:15:47', '2018-01-31 05:15:47'),
(117, 'Certificate', 'A4 2-Sides', 1000, '0.50', 17, '2018-01-31 06:31:40', '2018-01-31 06:31:40'),
(118, 'Facebook Video', 'None', 1, '100.00', 27, '2018-01-31 06:53:41', '2018-01-31 06:53:41');

-- --------------------------------------------------------

--
-- Table structure for table `last_update`
--

DROP TABLE IF EXISTS `last_update`;
CREATE TABLE IF NOT EXISTS `last_update` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `last_update`
--

INSERT INTO `last_update` (`id`, `date`) VALUES
(1, '2018-01-31 15:00:01');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_11_29_102100_create_clients', 1),
(4, '2017_11_29_104615_create_item', 1),
(5, '2017_11_29_104753_create_employee', 1),
(6, '2017_11_29_104931_create_month_salary', 1),
(7, '2017_11_29_105419_create_delevery', 1),
(8, '2017_11_29_105649_create_delivery_type', 1),
(9, '2017_11_29_105827_create_outside_printing', 1),
(10, '2017_11_29_110524_create_printing_company', 1),
(11, '2017_11_29_110818_create_inside_printing', 1),
(12, '2017_11_29_111008_create_debt', 1),
(13, '2017_11_29_111026_create_debt_paid', 1),
(14, '2017_11_29_192447_create_sales_type', 2),
(15, '2017_11_29_192621_create_department', 2),
(16, '2017_12_05_070730_create_sales', 2),
(17, '2017_12_05_071551_create_promotion_item', 2),
(18, '2017_12_05_071725_create_expenses', 2),
(19, '2017_12_05_071906_create_expenses_type', 2),
(20, '2017_12_12_185020_create_payment_method', 3),
(21, '2017_12_14_114825_create_printing_method', 4),
(22, '2017_12_14_115025_create_printing_type_method', 4),
(23, '2017_12_15_145511_create_promotion_type_method', 5),
(24, '2017_09_22_185801_create_role_user_table', 6),
(25, '2017_09_22_192445_create_roles_table', 6),
(26, '2017_12_16_221355_create_debt_type', 7),
(27, '2017_12_18_102529_create_invoice_trasaction', 8);

-- --------------------------------------------------------

--
-- Table structure for table `month_salary`
--

DROP TABLE IF EXISTS `month_salary`;
CREATE TABLE IF NOT EXISTS `month_salary` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `bonas` decimal(7,2) NOT NULL DEFAULT '0.00',
  `bonas_note` text COLLATE utf8mb4_unicode_ci,
  `subtract` decimal(7,2) NOT NULL DEFAULT '0.00',
  `subtract_note` text COLLATE utf8mb4_unicode_ci,
  `salary_date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `month_salary`
--

INSERT INTO `month_salary` (`id`, `bonas`, `bonas_note`, `subtract`, `subtract_note`, `salary_date`, `employee_id`, `created_at`, `updated_at`) VALUES
(2, '0.00', NULL, '0.00', NULL, '2018-01-30', 3, '2018-01-30 06:28:03', '2018-01-30 06:28:03'),
(3, '0.00', NULL, '0.00', NULL, '2018-01-31', 2, '2018-01-31 03:44:17', '2018-01-31 03:44:17'),
(4, '0.00', NULL, '0.00', NULL, '2018-01-31', 4, '2018-01-31 03:44:36', '2018-01-31 03:44:36'),
(5, '0.00', NULL, '0.00', NULL, '2018-01-31', 5, '2018-01-31 03:45:00', '2018-01-31 06:16:50'),
(6, '0.00', NULL, '80.00', NULL, '2018-01-31', 6, '2018-01-31 03:45:37', '2018-01-31 03:45:37'),
(7, '0.00', NULL, '0.00', NULL, '2018-01-31', 7, '2018-01-31 03:45:57', '2018-01-31 05:05:52'),
(8, '50.00', NULL, '300.00', NULL, '2018-01-31', 10, '2018-01-31 03:46:20', '2018-01-31 06:17:41'),
(9, '0.00', NULL, '0.00', NULL, '2018-01-31', 1, '2018-01-31 03:47:36', '2018-01-31 03:47:36'),
(10, '0.00', '', '0.00', '', '2018-01-31', 8, '2018-01-31 05:06:02', '2018-02-01 03:10:30');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('eng.zainab901@gmail.com', '$2y$10$9n9XIyZrWqvN536hRBNVM.tuTTbI7R4gIEZO.WfBQayahXG8M2Qb2', '2018-01-14 07:22:30'),
('abdullabasim91@gmail.com', '$2y$10$7GC0L/rpu9S7q8/v/J8qUuL1kvvzKk7Tt/QED5ULgzxzeQgdwAfdy', '2018-01-14 07:23:52');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'Cash', '2017-12-22 20:18:31', '2017-12-22 20:18:31');

-- --------------------------------------------------------

--
-- Table structure for table `printing`
--

DROP TABLE IF EXISTS `printing`;
CREATE TABLE IF NOT EXISTS `printing` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `printing_company_id` int(11) NOT NULL,
  `amount` decimal(7,2) NOT NULL,
  `exchange_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `note` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `printing`
--

INSERT INTO `printing` (`id`, `printing_company_id`, `amount`, `exchange_date`, `note`, `created_at`, `updated_at`) VALUES
(1, 1, '455.00', '2018-01-26 21:00:00', 'No.1443, Invoice Date 17-1-2017', '2018-01-27 08:33:33', '2018-01-27 08:33:33'),
(2, 2, '5000.00', '2018-01-30 21:00:00', 'All Print Jan', '2018-01-31 06:36:26', '2018-01-31 06:36:26');

-- --------------------------------------------------------

--
-- Table structure for table `printing_company`
--

DROP TABLE IF EXISTS `printing_company`;
CREATE TABLE IF NOT EXISTS `printing_company` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `printing_company_type_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `printing_company`
--

INSERT INTO `printing_company` (`id`, `title`, `printing_company_type_id`, `created_at`, `updated_at`) VALUES
(1, 'Visual Dimension Company', 1, '2018-01-23 06:40:30', '2018-01-23 06:40:30'),
(2, 'Talal Turkia', 2, '2018-01-31 06:34:59', '2018-01-31 06:34:59');

-- --------------------------------------------------------

--
-- Table structure for table `printing_type`
--

DROP TABLE IF EXISTS `printing_type`;
CREATE TABLE IF NOT EXISTS `printing_type` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `printing_type`
--

INSERT INTO `printing_type` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'Inside Country', '2017-12-14 12:03:14', '2017-12-14 12:03:14'),
(2, 'Outside Country', '2017-12-14 12:03:14', '2017-12-14 12:03:14');

-- --------------------------------------------------------

--
-- Table structure for table `promotion_item`
--

DROP TABLE IF EXISTS `promotion_item`;
CREATE TABLE IF NOT EXISTS `promotion_item` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `amount` decimal(7,2) NOT NULL,
  `exchange_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `note` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `promotion_item`
--

INSERT INTO `promotion_item` (`id`, `amount`, `exchange_date`, `note`, `created_at`, `updated_at`) VALUES
(1, '2010.00', '2018-01-23 21:00:00', 'Invoice No. 1293\r\n2000$ To Turkey \r\n10$ Exchange Price\r\n(First Paid)', '2018-01-24 06:18:12', '2018-01-24 08:34:16');

-- --------------------------------------------------------

--
-- Table structure for table `promotion_item_company`
--

DROP TABLE IF EXISTS `promotion_item_company`;
CREATE TABLE IF NOT EXISTS `promotion_item_company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `promotion_item_company`
--

INSERT INTO `promotion_item_company` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'test', '2018-02-03 05:31:07', '2018-02-03 05:31:07');

-- --------------------------------------------------------

--
-- Table structure for table `promotion_type`
--

DROP TABLE IF EXISTS `promotion_type`;
CREATE TABLE IF NOT EXISTS `promotion_type` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'Allow user to create,update,delete DB record', '2017-12-16 06:08:46', '2017-12-16 06:08:46'),
(2, 'Accountant', 'Allow user to just  Enter data and print invoice', '2017-12-16 06:09:15', '2017-12-16 06:09:15'),
(3, 'Finance Head', 'Allow user to Enter data ,Edit ,Delete and print invoice ', '2017-12-16 06:09:15', '2017-12-16 06:09:15');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
CREATE TABLE IF NOT EXISTS `role_user` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id`, `role_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 5, '2017-12-16 03:14:10', '2017-12-16 03:14:10'),
(16, 2, 4, '2017-12-16 05:27:38', '2017-12-16 05:27:38'),
(18, 1, 6, '2017-12-21 08:37:35', '2017-12-21 08:37:35'),
(19, 2, 7, '2017-12-21 09:13:19', '2017-12-21 09:13:19'),
(21, 1, 8, '2017-12-23 06:08:50', '2017-12-23 06:08:50'),
(24, 2, 10, '2017-12-25 04:23:54', '2017-12-25 04:23:54'),
(28, 3, 9, '2017-12-25 06:41:43', '2017-12-25 06:41:43'),
(35, 1, 1, '2018-01-20 03:01:03', '2018-01-20 03:01:03'),
(37, 1, 12, '2018-01-20 04:53:37', '2018-01-20 04:53:37'),
(38, 1, 11, '2018-01-20 05:50:48', '2018-01-20 05:50:48');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

DROP TABLE IF EXISTS `sales`;
CREATE TABLE IF NOT EXISTS `sales` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `sales_type_id` int(11) NOT NULL,
  `discount` decimal(7,2) NOT NULL DEFAULT '0.00',
  `total_amount` decimal(7,2) NOT NULL,
  `paid_amount` decimal(7,2) NOT NULL,
  `remaining_amount` decimal(7,2) NOT NULL DEFAULT '0.00',
  `paid_date` date DEFAULT NULL,
  `payment_id` int(11) NOT NULL,
  `sales_employee_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_issue` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `client_id`, `sales_type_id`, `discount`, `total_amount`, `paid_amount`, `remaining_amount`, `paid_date`, `payment_id`, `sales_employee_id`, `user_id`, `date_issue`, `created_at`, `updated_at`) VALUES
(3, 6, 4, '0.00', '320.00', '0.00', '320.00', '2018-01-30', 1, 1, 6, '2018-01-15', '2018-01-15 10:20:31', '2018-01-15 10:20:31'),
(5, 16, 4, '0.00', '680.00', '680.00', '0.00', '2018-02-01', 1, 1, 11, '2018-01-22', '2018-01-22 05:52:26', '2018-01-28 09:09:36'),
(6, 64, 5, '0.00', '7208.00', '3604.00', '3604.00', '2018-01-31', 1, 1, 11, '2018-01-23', '2018-01-22 09:23:43', '2018-01-23 08:54:42'),
(7, 64, 3, '0.00', '50.00', '50.00', '0.00', '2018-01-31', 1, 1, 11, '2018-01-23', '2018-01-22 09:24:41', '2018-01-23 08:53:55'),
(9, 66, 4, '0.00', '100.00', '0.00', '100.00', '2018-01-31', 1, 1, 11, '2018-01-23', '2018-01-23 04:29:51', '2018-01-23 04:57:46'),
(10, 12, 4, '0.00', '900.00', '0.00', '900.00', '2018-01-31', 1, 1, 11, '2018-01-23', '2018-01-23 04:54:55', '2018-01-29 04:42:37'),
(12, 48, 4, '0.00', '650.00', '0.00', '650.00', '2018-01-31', 1, 1, 11, '2018-01-23', '2018-01-23 08:57:31', '2018-01-27 08:08:25'),
(13, 68, 4, '0.00', '2300.00', '1000.00', '1300.00', '2018-01-31', 1, 1, 11, '2018-01-24', '2018-01-23 09:14:53', '2018-01-24 08:19:14'),
(14, 5, 4, '0.00', '8496.00', '4248.00', '4248.00', '2018-01-31', 1, 1, 11, '2018-01-25', '2018-01-24 09:20:47', '2018-01-25 04:11:47'),
(15, 70, 4, '0.00', '450.00', '0.00', '450.00', '2018-01-31', 1, 1, 11, '2018-01-24', '2018-01-24 09:33:17', '2018-01-24 09:33:17'),
(16, 70, 7, '0.00', '900.00', '600.00', '300.00', '2018-01-31', 1, 1, 11, '2018-01-25', '2018-01-24 09:34:15', '2018-01-27 07:53:51'),
(17, 25, 4, '0.00', '500.00', '0.00', '500.00', '2018-01-31', 1, 1, 11, '2018-01-25', '2018-01-25 04:26:06', '2018-01-31 06:31:40'),
(18, 71, 4, '0.00', '100.00', '0.00', '100.00', '2018-01-31', 1, 1, 11, '2018-01-25', '2018-01-25 04:32:33', '2018-01-25 04:32:33'),
(19, 72, 6, '0.00', '600.00', '600.00', '0.00', '2018-01-31', 1, 1, 1, '2018-01-25', '2018-01-25 07:49:18', '2018-01-26 18:50:55'),
(22, 39, 4, '0.00', '525.00', '525.00', '0.00', NULL, 1, 1, 11, '2018-01-27', '2018-01-27 05:56:20', '2018-01-27 05:56:20'),
(23, 62, 4, '0.00', '2350.00', '1100.00', '1250.00', '2018-01-31', 1, 1, 11, '2018-01-28', '2018-01-28 05:21:25', '2018-01-29 09:11:31'),
(24, 74, 5, '0.00', '1500.00', '0.00', '1500.00', '2018-01-31', 1, 1, 11, '2018-01-29', '2018-01-29 06:20:11', '2018-01-29 06:20:11'),
(25, 16, 4, '0.00', '850.00', '0.00', '850.00', '2018-01-31', 1, 1, 11, '2018-01-30', '2018-01-30 03:47:15', '2018-01-31 05:15:47'),
(26, 64, 5, '0.00', '2300.00', '0.00', '2300.00', '2018-01-31', 1, 1, 11, '2018-01-30', '2018-01-30 08:18:42', '2018-02-01 03:36:27'),
(27, 72, 6, '0.00', '100.00', '0.00', '100.00', '2018-01-31', 1, 1, 11, '2018-01-31', '2018-01-31 06:53:41', '2018-01-31 06:53:41');

-- --------------------------------------------------------

--
-- Table structure for table `sales_type`
--

DROP TABLE IF EXISTS `sales_type`;
CREATE TABLE IF NOT EXISTS `sales_type` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales_type`
--

INSERT INTO `sales_type` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'Application', '2017-12-22 04:06:49', '2017-12-22 04:06:49'),
(2, 'Website', '2017-12-22 04:07:24', '2017-12-22 04:07:24'),
(3, 'Design', '2017-12-22 04:07:53', '2017-12-22 04:07:53'),
(4, 'Printing', '2017-12-22 04:08:09', '2017-12-22 04:08:09'),
(5, 'Promotion Item', '2017-12-22 04:08:30', '2017-12-22 04:08:30'),
(6, 'Facebook', '2017-12-22 04:08:49', '2017-12-22 04:08:49'),
(7, 'Booking System', '2018-01-24 09:29:51', '2018-01-25 04:15:31'),
(8, 'Annual Amount Website', '2018-01-25 04:20:02', '2018-01-25 04:20:37'),
(9, 'Annual Amount Application', '2018-01-25 04:20:30', '2018-01-25 04:20:30');

-- --------------------------------------------------------

--
-- Table structure for table `specialty`
--

DROP TABLE IF EXISTS `specialty`;
CREATE TABLE IF NOT EXISTS `specialty` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(191) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `specialty`
--

INSERT INTO `specialty` (`id`, `title`) VALUES
(1, 'Scientific Bureau'),
(2, 'Beauty Center'),
(3, 'Clinic'),
(4, 'Bank'),
(5, 'Financial Transfer Company'),
(6, 'Travel & Tourism Company'),
(7, 'Restaurant'),
(8, 'Café'),
(9, 'Private School'),
(10, 'University'),
(11, 'Organizing conferences & event'),
(12, 'Shop'),
(13, 'Cosmetic'),
(14, 'Legal Office'),
(15, 'Cars Company'),
(16, 'Contracting Company'),
(17, 'Generator Company'),
(18, 'Medical Equipment Company'),
(19, 'Money Transfer Company'),
(20, 'Information Technology'),
(21, 'Radio'),
(22, 'Pharmacy'),
(23, 'Collage');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `picture`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'abdullah khudhair', 'abdullabasim91@gmail.com', '$2y$10$mHyuU3Gvcpez.itGvVnLX.2qtpObXOANyzsrFMnuI.683TlxDyl9.', '99378282191.jpg', '2kZ4pf0Nbijc8YhWekonOqiQcngoYocYOTsgmMNBFD4wgNSjZNCzyfAuedUa', '2017-12-15 17:01:27', '2018-01-20 03:01:03'),
(6, 'Zainab Majeed', 'eng.zainab901@gmail.com', '$2y$10$vnibA47kiKsuQliGZY1NI..Eh92yHAq3BBarNlRme5udlHerWTCU.', '6010409423lamass-logo.jpg', '29mgThXwQEsl1UEDozIPMSNFNapxp2ar47mQCQd9CHuuJmmpUKMCSqNRVQ1d', '2017-12-21 08:37:35', '2018-01-06 08:13:52'),
(8, 'Ahmad K. Mohammed', 'it2000@gmail.com', '$2y$10$BkAwIHCgEbxGy6kbKbRv/.fRVM9Mvdck94we1tX3LhJJ9Ai1dHZGS', '1666651871Lamassu---Logo-1.png', 'c4EJ5XFJ32HGI2unvZkd7CM68j7fBkGBLl0J10k63nX8vIQV3Ax4xEKLkD6F', '2017-12-21 09:20:52', '2017-12-23 06:08:50'),
(9, 'Emad Amaer', 'emad.amaer@lamassu-iq.com', '$2y$10$yAcMa4U61XfDD6tYGoeK4uivYkE5.CCfDQ.qPvfvItERfdbuBtHSm', '0748925812BC68D99D-2554-4536-95EA-184A9862F1F2.jpeg', 'dvRSGBkbCDVfDJWO7qaveSI2psZ9mvVOiNrCbqgVYD5JwnFqKdHtmjYI5ug2', '2017-12-25 03:36:25', '2017-12-25 07:14:48'),
(10, 'Sara Ezaldeen', 'sara.sales@lamassu-iq.com', '$2y$10$wGHixwM7FBGgZ.X5XqsDlOW4O8oAVy4B8HIZ..Y2/noTXRxWsMALW', '7144521902lamassu-web-backgraund (1)-min.jpg', NULL, '2017-12-25 04:23:54', '2017-12-25 04:23:54'),
(11, 'Batuol Shaban', 'batuol92@yahoo.com', '$2y$10$Xx2ytayy/3uqi/D38sdsF.okmk8Ej0T3zvsIVl4ofzOjKkO75kgHa', '5196195691ggg.jpg', 'hkNf25qWODimXGQRxdqgPSC3SGVi5ktKZylwXxXGrKyFNU9fz7MsUA1PKMzT', '2018-01-20 04:10:10', '2018-01-21 05:24:52'),
(12, 'Ali Bahjat', 'alibahjat2006@gmail.com', '$2y$10$9OmDPqRs5pMcWCeZlA1RO.3OEXVpBHiHPaXKOQoN5AuE0yfseRNPe', '6195190022zain.png', 'fBip4Ufj55ThewOBcuxDrTRNR17e8Ahcs3w0qzK2vBFT9INVCJJp28Jt0Uhb', '2018-01-20 04:53:37', '2018-01-20 04:53:37');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
