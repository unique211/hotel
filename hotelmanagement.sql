-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 28, 2019 at 07:03 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotelmanagement`
--
CREATE DATABASE IF NOT EXISTS `hotelmanagement` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `hotelmanagement`;

-- --------------------------------------------------------

--
-- Table structure for table `advanceallocateroom`
--

CREATE TABLE `advanceallocateroom` (
  `id` int(11) NOT NULL,
  `advanceid` int(11) NOT NULL,
  `visterid` int(11) NOT NULL,
  `roomid` int(11) NOT NULL,
  `roomrate` decimal(10,2) NOT NULL,
  `checkintime` datetime NOT NULL,
  `checkouttime` datetime NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `advancebooking`
--

CREATE TABLE `advancebooking` (
  `id` int(11) NOT NULL,
  `visiterid` int(11) NOT NULL,
  `men` int(11) DEFAULT NULL,
  `woman` int(11) DEFAULT NULL,
  `child` int(11) DEFAULT NULL,
  `noofday` int(11) NOT NULL,
  `advancebooktime` datetime NOT NULL,
  `checkintime` datetime NOT NULL,
  `checkouttime` datetime NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `advancepayment` decimal(10,2) NOT NULL,
  `mode` varchar(50) NOT NULL,
  `remark` varchar(255) NOT NULL,
  `canclellation_amt` decimal(10,2) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `allocateroom`
--

CREATE TABLE `allocateroom` (
  `id` int(11) NOT NULL,
  `visitercheckinid` int(11) NOT NULL,
  `visterid` int(11) NOT NULL,
  `roomid` int(11) NOT NULL,
  `roomrate` decimal(10,2) NOT NULL,
  `checkintime` datetime NOT NULL,
  `checkouttime` datetime NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `checkoutid` int(1) DEFAULT NULL,
  `invoiceid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `allocateroom`
--

INSERT INTO `allocateroom` (`id`, `visitercheckinid`, `visterid`, `roomid`, `roomrate`, `checkintime`, `checkouttime`, `status`, `created_at`, `updated_at`, `checkoutid`, `invoiceid`) VALUES
(1, 1, 1, 1, '100.00', '2019-11-09 04:06:40', '2019-11-10 04:06:40', 0, '2019-11-09 10:39:43', '2019-11-09 05:07:47', 1, 1),
(2, 2, 1, 1, '100.00', '2019-11-15 05:52:52', '2019-11-19 06:07:16', 1, '2019-11-15 07:12:29', '2019-11-15 07:12:29', NULL, NULL),
(3, 2, 1, 4, '1500.00', '2019-11-15 05:52:52', '2019-11-19 06:07:16', 1, '2019-11-15 07:12:29', '2019-11-15 07:12:29', NULL, NULL),
(6, 6, 2, 5, '10.00', '2019-11-18 12:23:52', '2019-11-20 12:23:52', 0, '2019-11-18 11:01:08', '2019-11-18 01:24:34', 2, NULL),
(7, 6, 2, 9, '10.00', '2019-11-18 12:23:52', '2019-11-20 12:23:52', 0, '2019-11-18 11:01:08', '2019-11-18 01:24:34', 2, NULL),
(8, 7, 2, 8, '10.00', '2019-11-18 05:10:31', '2019-11-21 05:10:31', 0, '2019-11-18 11:42:23', '2019-11-18 06:11:20', 14, NULL),
(9, 7, 2, 18, '10.00', '2019-11-18 05:10:31', '2019-11-21 05:10:31', 0, '2019-11-18 11:42:24', '2019-11-18 06:11:20', 14, NULL),
(10, 7, 2, 19, '10.00', '2019-11-18 05:10:31', '2019-11-21 05:10:31', 0, '2019-11-18 11:42:24', '2019-11-18 06:11:20', 14, NULL),
(11, 8, 3, 5, '10.00', '2019-11-18 05:19:55', '2019-11-22 05:19:55', 0, '2019-12-27 04:32:32', '2019-11-18 06:20:41', 15, 2),
(12, 8, 3, 10, '10.00', '2019-11-18 05:19:55', '2019-11-22 05:19:55', 0, '2019-12-27 04:32:32', '2019-11-18 06:20:41', 15, 2),
(13, 8, 3, 8, '10.00', '2019-11-18 05:19:55', '2019-11-22 05:19:55', 0, '2019-12-27 04:32:32', '2019-11-18 06:20:41', 15, 2),
(14, 9, 2, 3, '10.00', '2019-11-19 09:19:30', '2019-11-22 09:19:30', 0, '2019-11-19 03:52:37', '2019-11-18 22:20:09', 16, NULL),
(15, 9, 2, 8, '10.00', '2019-11-19 09:19:30', '2019-11-22 09:19:30', 0, '2019-11-19 03:52:37', '2019-11-18 22:20:09', 16, NULL),
(16, 9, 2, 6, '10.00', '2019-11-19 09:19:30', '2019-11-22 09:19:30', 0, '2019-11-19 03:52:37', '2019-11-18 22:20:09', 16, NULL),
(17, 10, 2, 10, '10.00', '2019-11-24 11:44:09', '2019-11-27 11:00:09', 0, '2019-11-23 10:41:28', '2019-11-23 03:11:47', 19, NULL),
(18, 10, 2, 3, '10.00', '2019-11-24 11:44:09', '2019-11-27 11:00:09', 0, '2019-11-23 10:41:28', '2019-11-23 03:11:47', 19, NULL),
(19, 10, 2, 6, '10.00', '2019-11-24 11:44:09', '2019-11-27 11:00:09', 0, '2019-11-23 10:41:28', '2019-11-23 03:11:47', 19, NULL),
(20, 11, 3, 21, '500.00', '2019-12-03 11:58:55', '2019-12-12 11:58:55', 0, '2019-12-27 04:32:32', '2019-12-03 01:02:05', 21, 2),
(21, 13, 3, 4, '1500.00', '2019-12-16 09:23:32', '2019-12-25 09:23:32', 0, '2019-12-27 04:32:32', '2019-12-15 22:27:40', 21, 2),
(22, 14, 3, 1, '100.00', '2019-12-26 10:23:39', '2019-12-27 10:23:39', 0, '2019-12-27 04:32:32', '2019-12-25 23:25:09', 21, 2),
(23, 14, 3, 20, '150.00', '2019-12-26 10:23:39', '2019-12-27 10:23:39', 0, '2019-12-27 04:32:32', '2019-12-25 23:25:09', 21, 2),
(25, 16, 6, 4, '1500.00', '2019-12-26 06:14:14', '2019-12-27 06:14:14', 0, '2019-12-26 12:45:26', '2019-12-26 07:14:41', 22, NULL),
(26, 17, 6, 4, '1500.00', '2019-12-26 06:15:31', '2019-12-27 06:15:31', 0, '2019-12-27 06:39:19', '2019-12-26 07:16:39', NULL, NULL),
(27, 17, 6, 3, '10.00', '2019-12-26 06:15:31', '2019-12-27 06:15:31', 0, '2019-12-27 06:48:52', '2019-12-26 07:16:39', 25, NULL),
(28, 18, 6, 1, '100.00', '2019-12-27 11:52:48', '2019-12-28 11:52:48', 0, '2019-12-27 06:39:23', '2019-12-27 00:53:25', NULL, NULL),
(29, 19, 3, 1, '100.00', '2019-12-27 12:26:46', '2019-12-28 12:26:33', 0, '2019-12-27 11:04:17', '2019-12-27 01:27:09', 27, 3),
(30, 20, 3, 3, '10.00', '2019-12-27 12:29:21', '2019-12-29 12:29:21', 0, '2019-12-27 11:04:17', '2019-12-27 01:29:52', 28, 3),
(31, 20, 3, 17, '10.00', '2019-12-27 12:29:21', '2019-12-29 12:29:21', 0, '2019-12-27 11:04:16', '2019-12-27 01:29:52', 27, 3),
(32, 20, 3, 7, '10.00', '2019-12-27 12:29:21', '2019-12-29 12:29:21', 0, '2019-12-27 11:04:16', '2019-12-27 01:29:52', 27, 3),
(35, 22, 3, 2, '100.00', '2019-12-27 12:56:58', '2019-12-28 12:56:58', 0, '2019-12-27 11:04:16', '2019-12-27 01:57:49', 29, 3),
(41, 25, 10, 3, '10.00', '2019-12-27 15:56:23', '2019-12-28 15:56:23', 0, '2019-12-27 10:30:56', '2019-12-27 04:57:16', 30, NULL),
(42, 25, 10, 16, '10.00', '2019-12-27 15:56:23', '2019-12-28 15:56:23', 1, '2019-12-27 04:57:16', '2019-12-27 04:57:16', NULL, NULL),
(43, 25, 10, 6, '10.00', '2019-12-27 15:56:23', '2019-12-28 15:56:23', 0, '2019-12-27 10:30:57', '2019-12-27 04:57:16', 30, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `allocate_service`
--

CREATE TABLE `allocate_service` (
  `id` int(11) NOT NULL,
  `roomid` int(11) NOT NULL,
  `visterid` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `allocate_service`
--

INSERT INTO `allocate_service` (`id`, `roomid`, `visterid`, `status`, `created_at`, `updated_at`) VALUES
(3, 8, 2, 0, '2019-11-19 03:52:37', '2019-11-18 06:11:48'),
(4, 8, 3, 0, '2019-11-18 12:06:06', '2019-11-18 06:21:57'),
(5, 5, 3, 0, '2019-11-18 12:06:06', '2019-11-18 06:22:08'),
(6, 3, 6, 0, '2019-12-27 06:48:52', '2019-12-26 23:04:32'),
(7, 1, 6, 0, '2019-12-27 06:37:05', '2019-12-27 00:54:36'),
(8, 3, 3, 0, '2019-12-27 07:06:30', '2019-12-27 01:31:02'),
(9, 7, 3, 0, '2019-12-27 07:03:06', '2019-12-27 01:31:15'),
(10, 3, 10, 0, '2019-12-27 10:30:56', '2019-12-27 05:00:27');

-- --------------------------------------------------------

--
-- Table structure for table `allocate_servicedetalis`
--

CREATE TABLE `allocate_servicedetalis` (
  `id` int(11) NOT NULL,
  `allocate_sid` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `serviceid` int(11) NOT NULL,
  `rate` decimal(10,2) NOT NULL,
  `qty` int(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `allocate_servicedetalis`
--

INSERT INTO `allocate_servicedetalis` (`id`, `allocate_sid`, `datetime`, `serviceid`, `rate`, `qty`, `created_at`, `updated_at`) VALUES
(6, 3, '2019-11-18 05:11:27', 2, '45.00', 12, '2019-11-18 06:11:48', '2019-11-18 06:11:48'),
(7, 4, '2019-11-18 05:21:32', 1, '21.00', 12, '2019-11-18 06:21:57', '2019-11-18 06:21:57'),
(8, 5, '2019-11-18 05:21:32', 1, '21.00', 1, '2019-11-18 06:22:08', '2019-11-18 06:22:08'),
(9, 6, '2019-12-27 10:04:18', 1, '21.00', 12, '2019-12-26 23:04:32', '2019-12-26 23:04:32'),
(10, 6, '2019-12-27 10:04:18', 2, '45.00', 1, '2019-12-26 23:04:32', '2019-12-26 23:04:32'),
(11, 7, '2019-12-27 11:54:08', 2, '45.00', 12, '2019-12-27 00:54:36', '2019-12-27 00:54:36'),
(12, 8, '2019-12-27 12:30:36', 1, '21.00', 122, '2019-12-27 01:31:03', '2019-12-27 01:31:03'),
(13, 8, '2019-12-27 12:30:36', 2, '45.00', 1, '2019-12-27 01:31:03', '2019-12-27 01:31:03'),
(14, 9, '2019-12-27 12:30:36', 2, '45.00', 1, '2019-12-27 01:31:15', '2019-12-27 01:31:15'),
(15, 10, '2019-12-27 03:57:39', 1, '21.00', 121, '2019-12-27 05:00:27', '2019-12-27 05:00:27');

-- --------------------------------------------------------

--
-- Table structure for table `categorys`
--

CREATE TABLE `categorys` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `capacity` int(11) NOT NULL,
  `rate` decimal(10,2) NOT NULL,
  `descroption` varchar(100) DEFAULT '',
  `status` int(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categorys`
--

INSERT INTO `categorys` (`id`, `name`, `capacity`, `rate`, `descroption`, `status`, `created_at`, `updated_at`) VALUES
(2, 'cate8', 120, '100.00', NULL, 1, '2019-12-07 11:35:35', '2019-12-07 06:05:35'),
(3, 'cat123', 3, '1500.00', 'sdffd', 1, '2019-11-15 06:29:49', '2019-11-15 06:29:49'),
(4, 'cat1234', 150, '10.00', 'dfgdfg', 1, '2019-11-15 06:30:18', '2019-11-15 06:30:18'),
(5, 'cate811', 12, '150.00', NULL, 1, '2019-12-09 11:28:08', '2019-12-09 05:58:08'),
(6, 'cate6', 12, '12.00', '1', 1, '2019-11-15 22:21:59', '2019-11-15 22:21:59'),
(7, 'cate8', 4, '130.00', 'sd', 1, '2019-11-23 09:27:52', '2019-11-23 03:57:52'),
(8, 'cate81', 2, '500.00', 'desc', 1, '2019-12-07 11:28:48', '2019-12-07 05:58:48'),
(9, 'rakesh123', 1, '122.00', NULL, 1, '2019-12-07 06:15:18', '2019-12-07 06:15:18'),
(10, 'category9', 10, '100.00', 'sdcsd', 1, '2019-12-26 04:47:19', '2019-12-25 23:17:19'),
(11, 'cate1', 11, '10.00', 'sd', 1, '2019-12-25 23:20:52', '2019-12-25 23:20:52');

-- --------------------------------------------------------

--
-- Table structure for table `changetime`
--

CREATE TABLE `changetime` (
  `id` int(11) NOT NULL,
  `chanegtimeing` varchar(100) CHARACTER SET utf8 NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `currency` varchar(50) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `changetime`
--

INSERT INTO `changetime` (`id`, `chanegtimeing`, `created_at`, `updated_at`, `currency`) VALUES
(1, '11:11:02', '2019-11-25 04:07:02', '2019-11-24 22:31:23', '₹');

-- --------------------------------------------------------

--
-- Table structure for table `Checkin_master`
--

CREATE TABLE `Checkin_master` (
  `id` int(11) NOT NULL,
  `visiterid` int(11) NOT NULL,
  `men` int(11) NOT NULL,
  `woman` int(11) NOT NULL,
  `child` int(11) NOT NULL,
  `noofday` int(11) NOT NULL,
  `checkintime` datetime NOT NULL,
  `checkouttime` datetime NOT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `advancepayment` decimal(10,2) DEFAULT NULL,
  `mode` varchar(50) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Checkin_master`
--

INSERT INTO `Checkin_master` (`id`, `visiterid`, `men`, `woman`, `child`, `noofday`, `checkintime`, `checkouttime`, `amount`, `advancepayment`, `mode`, `remark`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, 12, 1, '2019-11-09 04:06:40', '2019-11-10 04:06:40', '100.00', '100.00', 'Cash', 'wrfd', 1, '2019-11-09 05:07:47', '2019-11-09 05:07:47'),
(2, 1, 1, 0, 0, 4, '2019-11-15 05:52:52', '2019-11-19 06:07:16', '3200.00', '0.00', NULL, NULL, 1, '2019-11-15 07:12:28', '2019-11-15 07:12:28'),
(6, 2, 1, 0, 0, 2, '2019-11-18 12:23:52', '2019-11-20 12:23:52', '40.00', '10.00', 'Cash', 'asds', 0, '2019-11-18 11:32:10', '2019-11-18 01:24:34'),
(7, 2, 1, 0, 0, 3, '2019-11-18 05:10:31', '2019-11-21 05:10:31', '90.00', '10.00', 'Cash', 'asdsds', 0, '2019-11-18 11:42:22', '2019-11-18 06:11:20'),
(8, 3, 1, 0, 0, 4, '2019-11-18 05:19:55', '2019-11-22 05:19:55', '120.00', '100.00', 'Cash', 'adsdsds', 0, '2019-11-18 12:06:06', '2019-11-18 06:20:41'),
(9, 2, 1, 0, 0, 3, '2019-11-19 09:19:30', '2019-11-22 09:19:30', '90.00', '10.00', 'Card', 'asdsd', 0, '2019-11-19 03:52:37', '2019-11-18 22:20:09'),
(10, 2, 1, 0, 0, 4, '2019-11-24 11:44:09', '2019-11-27 11:00:09', '120.00', '10.00', 'Cash', 'asdsa', 0, '2019-11-23 10:41:28', '2019-11-23 03:11:47'),
(12, 3, 5, 0, 0, 25, '2019-12-03 12:20:07', '2019-12-27 12:20:07', '12500.00', '0.00', NULL, NULL, 0, '2019-12-07 12:44:14', '2019-12-03 01:26:39'),
(13, 3, 1, 10, 0, 10, '2019-12-16 09:23:32', '2019-12-25 09:23:32', '15000.00', '10.00', 'Card', 'sddf', 0, '2019-12-26 05:19:00', '2019-12-15 22:27:39'),
(14, 3, 1, 0, 0, 1, '2019-12-26 10:23:39', '2019-12-27 10:23:39', '250.00', '10.00', 'Cash', 'asdda', 0, '2019-12-26 05:17:19', '2019-12-25 23:25:09'),
(16, 6, 5, 2, 0, 1, '2019-12-26 06:14:14', '2019-12-27 06:14:14', '1500.00', '0.00', NULL, NULL, 0, '2019-12-26 12:45:26', '2019-12-26 07:14:41'),
(17, 6, 7, 0, 0, 1, '2019-12-26 06:15:31', '2019-12-27 06:15:31', '1510.00', '0.00', NULL, NULL, 0, '2019-12-27 06:48:52', '2019-12-26 07:16:39'),
(18, 6, 5, 10, 2, 1, '2019-12-27 11:52:48', '2019-12-28 11:52:48', '100.00', '10.00', 'Cash', NULL, 0, '2019-12-27 06:53:21', '2019-12-27 00:53:25'),
(19, 3, 2, 0, 0, 2, '2019-12-27 12:26:46', '2019-12-28 12:26:33', '200.00', '0.00', NULL, NULL, 0, '2019-12-27 07:03:01', '2019-12-27 01:27:09'),
(20, 3, 11, 0, 0, 3, '2019-12-27 12:29:21', '2019-12-29 12:29:21', '90.00', '10.00', 'Card', 'sddsds', 0, '2019-12-27 07:34:59', '2019-12-27 01:29:52'),
(22, 3, 2, 2, 0, 2, '2019-12-27 12:56:58', '2019-12-28 12:56:58', '200.00', '0.00', NULL, NULL, 0, '2019-12-27 07:34:59', '2019-12-27 01:57:48'),
(25, 10, 1, 0, 10, 1, '2019-12-27 15:56:23', '2019-12-28 15:56:23', '30.00', '10.00', 'Cash', 'dsfsf', 1, '2019-12-27 04:57:16', '2019-12-27 04:57:16');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(11) NOT NULL,
  `vid` int(11) NOT NULL,
  `doc_name` varchar(255) NOT NULL,
  `docproff_no` varchar(30) DEFAULT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `vid`, `doc_name`, `docproff_no`, `filename`, `created_at`, `updated_at`) VALUES
(73, 4, 'AdharCard', '1', '5deb9551bd3c1_1575720273.jpeg', '2019-12-09 06:45:05', '2019-12-09 06:45:05'),
(81, 7, 'AdharCard', '121', '5e0449ce66314_1577339342.png', '2019-12-26 00:32:49', '2019-12-26 00:32:49'),
(90, 8, 'AdharCard', '21', '5e057f410bcdd_1577418561.png', '2019-12-26 22:19:29', '2019-12-26 22:19:29'),
(94, 9, 'AdharCard', '121', '5e05ae8b357b6_1577430667.png', '2019-12-27 01:41:40', '2019-12-27 01:41:40'),
(95, 3, 'AdharCard', '12', '5e05b2512f319_1577431633.png', '2019-12-27 01:57:34', '2019-12-27 01:57:34'),
(100, 6, 'AdharCard', '1212', '5e04ab7c1cc42_1577364348.png', '2019-12-27 04:14:04', '2019-12-27 04:14:04');

-- --------------------------------------------------------

--
-- Table structure for table `extra_service`
--

CREATE TABLE `extra_service` (
  `id` int(11) NOT NULL,
  `servicename` varchar(100) NOT NULL,
  `unit` varchar(100) NOT NULL,
  `rate` decimal(10,2) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `extra_service`
--

INSERT INTO `extra_service` (`id`, `servicename`, `unit`, `rate`, `status`, `created_at`, `updated_at`) VALUES
(1, 'service2', '12', '21.00', 1, '2019-12-27 04:33:58', '2019-12-26 23:03:58'),
(2, 'service1', '14', '45.00', 1, '2019-12-27 04:34:03', '2019-12-26 23:04:03'),
(3, 'new service', '12', '12.00', 1, '2019-12-27 03:44:06', '2019-12-27 03:44:06');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_detalis`
--

CREATE TABLE `invoice_detalis` (
  `id` int(11) NOT NULL,
  `invoiceid` int(11) NOT NULL,
  `roomid` int(11) NOT NULL,
  `categoryid` int(11) NOT NULL,
  `checkoutid` int(11) NOT NULL,
  `checkintime` varchar(100) NOT NULL,
  `checkoutime` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_detalis`
--

INSERT INTO `invoice_detalis` (`id`, `invoiceid`, `roomid`, `categoryid`, `checkoutid`, `checkintime`, `checkoutime`, `created_at`, `updated_at`) VALUES
(2, 1, 1, 2, 100, '2019-11-09 04:06:40', '2019-11-10 04:06:40', '2019-11-09 05:09:58', '2019-11-09 05:09:58'),
(3, 2, 20, 5, 21, '2019-12-26 10:23:39', '2019-12-27 11:11:02', '2019-12-26 23:02:32', '2019-12-26 23:02:32'),
(4, 2, 1, 2, 21, '2019-12-26 10:23:39', '2019-12-27 11:11:02', '2019-12-26 23:02:32', '2019-12-26 23:02:32'),
(5, 2, 4, 3, 21, '2019-12-26 10:23:39', '2019-12-27 11:11:02', '2019-12-26 23:02:32', '2019-12-26 23:02:32'),
(6, 2, 21, 8, 21, '2019-12-26 10:23:39', '2019-12-27 11:11:02', '2019-12-26 23:02:32', '2019-12-26 23:02:32'),
(7, 2, 8, 4, 15, '2019-11-18 05:19:55', '2019-11-22 05:19:55', '2019-12-26 23:02:32', '2019-12-26 23:02:32'),
(8, 2, 10, 4, 15, '2019-11-18 05:19:55', '2019-11-22 05:19:55', '2019-12-26 23:02:32', '2019-12-26 23:02:32'),
(9, 2, 5, 4, 15, '2019-11-18 05:19:55', '2019-11-22 05:19:55', '2019-12-26 23:02:32', '2019-12-26 23:02:32'),
(15, 3, 2, 2, 100, '2019-12-27 12:29:21', '2019-12-28 11:11:02', '2019-12-27 06:35:43', '2019-12-27 06:35:43'),
(16, 3, 7, 4, 10, '2019-12-27 12:26:46', '2019-12-28 11:11:02', '2019-12-27 06:35:43', '2019-12-27 06:35:43'),
(17, 3, 17, 4, 10, '2019-12-27 12:26:46', '2019-12-28 11:11:02', '2019-12-27 06:35:43', '2019-12-27 06:35:43'),
(18, 3, 3, 4, 10, '2019-12-27 12:29:21', '2019-12-28 11:11:02', '2019-12-27 06:35:43', '2019-12-27 06:35:43'),
(19, 3, 1, 2, 100, '2019-12-27 12:26:46', '2019-12-28 11:11:02', '2019-12-27 06:35:43', '2019-12-27 06:35:43');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_master`
--

CREATE TABLE `invoice_master` (
  `id` int(11) NOT NULL,
  `invoiceno` varchar(30) NOT NULL,
  `invoicedate` date NOT NULL,
  `checkout_roomno` int(11) DEFAULT NULL,
  `visiterid` int(11) NOT NULL,
  `totalamt` decimal(10,2) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `paidamt` decimal(10,2) NOT NULL,
  `paymentmode` varchar(30) DEFAULT NULL,
  `remark` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_master`
--

INSERT INTO `invoice_master` (`id`, `invoiceno`, `invoicedate`, `checkout_roomno`, `visiterid`, `totalamt`, `status`, `paidamt`, `paymentmode`, `remark`, `created_at`, `updated_at`) VALUES
(1, '12', '2019-10-29', NULL, 1, '688.00', 1, '100.00', 'Cash', 'qseds', '2019-11-09 10:39:58', '2019-11-09 05:09:58'),
(2, '1212', '2019-12-27', NULL, 3, '2643.00', 1, '12.00', 'Cash', '12', '2019-12-26 23:02:32', '2019-12-26 23:02:32'),
(3, '12121', '2019-12-18', NULL, 3, '2882.00', 1, '212.00', 'Cash', 'sddfsf', '2019-12-27 12:05:43', '2019-12-27 06:35:43');

-- --------------------------------------------------------

--
-- Table structure for table `login_master`
--

CREATE TABLE `login_master` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `userid` varchar(100) NOT NULL,
  `password` varchar(40) NOT NULL,
  `role` varchar(50) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_master`
--

INSERT INTO `login_master` (`id`, `uid`, `userid`, `password`, `role`, `status`, `created_at`, `updated_at`) VALUES
(3, 5, 'admin', '123456', 'Admin', 1, '2019-10-23 03:54:25', '2019-10-22 07:08:23'),
(4, 6, 'sagar', '123', 'Admin', 1, '2019-12-15 22:32:47', '2019-12-15 22:32:47');

-- --------------------------------------------------------

--
-- Table structure for table `room_master`
--

CREATE TABLE `room_master` (
  `id` int(11) NOT NULL,
  `roomno` int(11) NOT NULL,
  `roomname` varchar(100) DEFAULT NULL,
  `categoryid` int(11) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room_master`
--

INSERT INTO `room_master` (`id`, `roomno`, `roomname`, `categoryid`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 1121, 'rakesh123', 2, 'w', 1, '2019-12-27 10:19:25', '2019-12-07 06:27:50'),
(2, 111, 'rmmm', 2, 'ss', 1, '2019-12-27 07:34:59', '2019-11-15 06:22:50'),
(3, 101, 'room101', 4, 'asds', 1, '2019-12-27 10:30:56', '2019-11-15 06:34:30'),
(4, 105, 'asdsasds', 3, NULL, 1, '2019-12-27 10:19:25', '2019-11-15 06:35:49'),
(5, 112, NULL, 4, NULL, 1, '2019-12-27 10:18:35', '2019-11-16 07:29:27'),
(6, 113, NULL, 4, NULL, 1, '2019-12-27 10:30:57', '2019-11-16 07:29:50'),
(7, 114, NULL, 4, NULL, 1, '2019-12-27 07:03:06', '2019-11-16 07:29:56'),
(8, 115, NULL, 4, NULL, 1, '2019-11-19 03:52:37', '2019-11-16 07:30:35'),
(9, 116, NULL, 4, NULL, 1, '2019-11-18 11:01:08', '2019-11-16 07:31:13'),
(10, 117, NULL, 4, NULL, 1, '2019-11-23 10:41:28', '2019-11-16 07:31:22'),
(11, 118, NULL, 4, NULL, 1, '2019-11-16 07:31:30', '2019-11-16 07:31:30'),
(12, 119, NULL, 4, NULL, 1, '2019-11-16 07:33:20', '2019-11-16 07:33:20'),
(13, 120, NULL, 4, NULL, 1, '2019-11-16 07:33:29', '2019-11-16 07:33:29'),
(14, 121, NULL, 4, NULL, 1, '2019-11-16 07:33:37', '2019-11-16 07:33:37'),
(15, 122, NULL, 4, NULL, 1, '2019-11-16 07:33:42', '2019-11-16 07:33:42'),
(16, 123, NULL, 4, NULL, 2, '2019-12-27 10:27:16', '2019-11-16 07:33:49'),
(17, 124, NULL, 4, NULL, 1, '2019-12-27 07:03:01', '2019-11-16 07:33:58'),
(18, 125, NULL, 4, NULL, 1, '2019-11-18 11:42:24', '2019-11-16 07:34:05'),
(19, 126, NULL, 4, NULL, 1, '2019-11-18 11:42:24', '2019-11-16 07:34:14'),
(20, 132, NULL, 5, NULL, 1, '2019-12-27 10:19:25', '2019-12-09 05:58:20'),
(21, 5012, 'Delux', 8, NULL, 1, '2019-12-16 04:01:40', '2019-12-15 22:31:40'),
(22, 500, 'sagar', 8, NULL, 1, '2019-12-07 12:44:14', '2019-12-07 06:33:47');

-- --------------------------------------------------------

--
-- Table structure for table `user_management`
--

CREATE TABLE `user_management` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `mobileno` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_management`
--

INSERT INTO `user_management` (`id`, `username`, `mobileno`, `email`, `role`, `status`, `created_at`, `updated_at`) VALUES
(5, 'admin123', '7989696322', 'sddsd@gmail.com', 'Admin', 1, '2019-12-18 04:36:26', '2019-12-17 23:06:26'),
(6, 'sagar', '7989696321', 'abcd@gmail.com', 'Admin', 1, '2019-12-15 22:32:47', '2019-12-15 22:32:47');

-- --------------------------------------------------------

--
-- Table structure for table `visiter_master`
--

CREATE TABLE `visiter_master` (
  `id` int(11) NOT NULL,
  `visitername` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `address2` varchar(100) DEFAULT NULL,
  `street` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `postalcode` decimal(6,0) NOT NULL,
  `state` varchar(100) NOT NULL,
  `mobileno` varchar(10) NOT NULL,
  `emailid` varchar(50) DEFAULT NULL,
  `profilepicture` varchar(255) NOT NULL,
  `c_detalis` varchar(10) DEFAULT NULL,
  `c_name` varchar(50) DEFAULT NULL,
  `desighnation` varchar(50) DEFAULT NULL,
  `c_url` varchar(100) DEFAULT NULL,
  `c_contactno` varchar(10) DEFAULT NULL,
  `c_emailid` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `visiter_master`
--

INSERT INTO `visiter_master` (`id`, `visitername`, `lastname`, `address`, `address2`, `street`, `city`, `postalcode`, `state`, `mobileno`, `emailid`, `profilepicture`, `c_detalis`, `c_name`, `desighnation`, `c_url`, `c_contactno`, `c_emailid`, `created_at`, `updated_at`) VALUES
(3, 'ajaz', 'khan1123', 'fdgfd', 'fdgfd', 'fdgfd', 'fdgfd', '10', 'sdfds', '9632587410', 'abc@gmail.com', '5deb954a55381_1575720266.png', NULL, NULL, NULL, NULL, NULL, NULL, '2019-12-27 07:27:34', '2019-12-27 01:57:34'),
(4, 'new', 'dfgdg', 'fdgfd', 'fdgfd', 'fdgfd', 'fdgfd', '10', 'sdfds', '9632584561', 'abcd@gmail.com', '5deb954a55381_1575720266.png', NULL, NULL, NULL, NULL, NULL, NULL, '2019-12-09 12:15:05', '2019-12-09 06:45:05'),
(6, 'sagar', 'moravdiya', 'rajkot', NULL, 'fdad', 'rajkot', '360020', 'gujrat', '9874563211', 'abc@gmail.com', '5deb954a55381_1575720266.png', NULL, NULL, NULL, NULL, NULL, NULL, '2019-12-27 09:44:04', '2019-12-27 04:14:04'),
(7, 'ravi', 'aaasd', 'rajkot', 'null', 'ass', 'rajkot', '360020', 'rajkot', '3698521470', NULL, '5e0449d11a4c6_1577339345.png', NULL, NULL, NULL, NULL, NULL, NULL, '2019-12-26 06:02:49', '2019-12-26 00:32:49'),
(8, 'ramesh', 'ads', 'rajkot', 'fdgfd', 'fdgfd', 'fdgfd', '10', 'sdfds', '9632587411', 'abcd@gmail.com', '5e057f3a12319_1577418554.png', NULL, NULL, NULL, NULL, NULL, NULL, '2019-12-26 22:19:29', '2019-12-26 22:19:29'),
(9, 'ravi', 'asdsd', 'rajkot', NULL, 'sads', 'rajkot', '360020', 'gujrat', '7896541230', 'abc@gmail.com', '5e05ae8272040_1577430658.png', NULL, NULL, NULL, NULL, NULL, NULL, '2019-12-27 01:41:40', '2019-12-27 01:41:40'),
(10, 'rakesh', 'dfgdg', 'fdgfd', 'fdgfd', 'fdgfd', 'fdgfd', '10', 'sdfds', '9632587401', 'abcd@gmail.com', '5e05d96c6fca5_1577441644.png', NULL, NULL, NULL, NULL, NULL, NULL, '2019-12-27 10:26:37', '2019-12-27 04:56:37');

-- --------------------------------------------------------

--
-- Table structure for table `vistercheckout_master`
--

CREATE TABLE `vistercheckout_master` (
  `id` int(11) NOT NULL,
  `visterid` int(11) NOT NULL,
  `visternam` varchar(100) NOT NULL,
  `checkintime` datetime NOT NULL,
  `checkouttime` datetime NOT NULL,
  `totalamout` decimal(10,2) NOT NULL,
  `mode` varchar(100) DEFAULT NULL,
  `transactiondetal` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vistercheckout_master`
--

INSERT INTO `vistercheckout_master` (`id`, `visterid`, `visternam`, `checkintime`, `checkouttime`, `totalamout`, `mode`, `transactiondetal`, `created_at`, `updated_at`) VALUES
(1, 1, 'rakesh', '2019-11-09 04:06:40', '2019-11-10 04:06:40', '100.00', 'Case', '122', '2019-11-09 05:09:15', '2019-11-09 05:09:15'),
(4, 2, 'rakesh123', '2019-11-18 12:23:52', '2019-11-20 12:23:52', '40.00', 'Paytam', '1212', '2019-11-18 05:36:17', '2019-11-18 05:36:17'),
(5, 2, 'rakesh123', '2019-11-18 12:23:52', '2019-11-22 12:23:52', '80.00', 'Case', '2132', '2019-11-18 05:39:32', '2019-11-18 05:39:32'),
(6, 2, 'rakesh123', '2019-11-18 12:23:52', '2019-11-23 12:23:52', '100.00', 'Case', '12323', '2019-11-18 05:40:22', '2019-11-18 05:40:22'),
(7, 2, 'rakesh123', '2019-11-18 12:23:52', '2019-11-21 12:23:52', '60.00', 'Case', '123', '2019-11-18 05:40:57', '2019-11-18 05:40:57'),
(8, 2, 'rakesh123', '2019-11-18 12:23:52', '2019-11-20 12:23:52', '40.00', 'Case', '12', '2019-11-18 05:43:03', '2019-11-18 05:43:03'),
(9, 2, 'rakesh123', '2019-11-18 12:23:52', '2019-11-21 12:23:52', '60.00', 'Case', '121', '2019-11-18 05:45:06', '2019-11-18 05:45:06'),
(10, 2, 'rakesh123', '2019-11-18 12:23:52', '2019-11-20 12:23:52', '40.00', 'Case', '123', '2019-11-18 05:47:35', '2019-11-18 05:47:35'),
(11, 2, 'rakesh123', '2019-11-18 12:23:52', '2019-11-20 12:23:52', '40.00', 'Card', '1232', '2019-11-18 05:49:56', '2019-11-18 05:49:56'),
(12, 2, 'rakesh123', '2019-11-18 12:23:52', '2019-11-21 12:23:52', '60.00', 'Case', '12312', '2019-11-18 06:00:36', '2019-11-18 06:00:36'),
(13, 2, 'rakesh123', '2019-11-18 12:23:52', '2019-11-20 12:23:52', '40.00', 'Case', '123232', '2019-11-18 06:02:09', '2019-11-18 06:02:09'),
(14, 2, 'rakesh123', '2019-11-18 05:10:31', '2019-11-22 05:10:31', '120.00', 'Case', '12323', '2019-11-18 06:12:21', '2019-11-18 06:12:21'),
(15, 3, 'ajaz', '2019-11-18 05:19:55', '2019-11-22 05:19:55', '80.00', 'Case', '1212', '2019-11-18 06:36:06', '2019-11-18 06:36:06'),
(16, 2, 'rakesh123', '2019-11-19 09:19:30', '2019-11-25 09:19:30', '180.00', 'Card', '121', '2019-11-18 22:22:37', '2019-11-18 22:22:37'),
(17, 2, 'rakesh123', '2019-11-24 11:44:09', '2019-11-27 11:00:09', '120.00', 'Case', '12', '2019-11-23 04:47:41', '2019-11-23 04:47:41'),
(18, 2, 'rakesh123', '2019-11-24 11:44:09', '2019-11-27 11:00:09', '120.00', 'Case', '12', '2019-11-23 05:09:35', '2019-11-23 05:09:35'),
(19, 2, 'rakesh123', '2019-11-24 11:44:09', '2019-11-27 11:00:09', '120.00', 'Case', '12', '2019-11-23 05:11:28', '2019-11-23 05:11:28'),
(20, 3, 'ajaz', '2019-12-03 12:20:07', '2019-12-04 12:20:07', '1000.00', 'Case', 'asd', '2019-12-07 07:14:14', '2019-12-07 07:14:14'),
(21, 3, 'ajaz', '2019-12-26 10:23:39', '2019-12-27 11:11:02', '4500.00', 'Card', '121', '2019-12-25 23:47:19', '2019-12-25 23:47:19'),
(22, 6, 'sagar', '2019-12-26 06:14:14', '2019-12-26 11:11:02', '1500.00', NULL, NULL, '2019-12-26 07:15:26', '2019-12-26 07:15:26'),
(23, 6, 'sagar', '2019-12-26 06:15:31', '2019-12-28 11:11:02', '5140.00', 'Case', NULL, '2019-12-27 01:07:05', '2019-12-27 01:07:05'),
(24, 6, 'sagar', '2019-12-27 11:52:48', '2019-12-28 11:11:02', '5140.00', 'Card', NULL, '2019-12-27 01:14:54', '2019-12-27 01:14:54'),
(25, 6, 'sagar', '2019-12-26 06:15:31', '2019-12-28 11:11:02', '5467.00', 'Case', '12', '2019-12-27 01:18:52', '2019-12-27 01:18:52'),
(26, 6, 'sagar', '2019-12-27 11:52:48', '2019-12-28 11:11:02', '5140.00', 'Card', '12', '2019-12-27 01:23:21', '2019-12-27 01:23:21'),
(27, 3, 'ajaz', '2019-12-27 12:26:46', '2019-12-28 11:11:02', '165.00', 'Case', NULL, '2019-12-27 01:32:47', '2019-12-27 01:32:47'),
(28, 3, 'ajaz', '2019-12-27 12:29:21', '2019-12-28 11:11:02', '2617.00', 'Card', '121', '2019-12-27 01:36:29', '2019-12-27 01:36:29'),
(29, 3, 'ajaz', '2019-12-27 12:29:21', '2019-12-28 11:11:02', '100.00', 'Case', '12332', '2019-12-27 02:04:57', '2019-12-27 02:04:57'),
(30, 10, 'rakesh', '2019-12-27 15:56:23', '2019-12-27 16:00:33', '2561.00', 'Case', '12331', '2019-12-27 05:00:54', '2019-12-27 05:00:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advanceallocateroom`
--
ALTER TABLE `advanceallocateroom`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `advancebooking`
--
ALTER TABLE `advancebooking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `allocateroom`
--
ALTER TABLE `allocateroom`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `allocate_service`
--
ALTER TABLE `allocate_service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `allocate_servicedetalis`
--
ALTER TABLE `allocate_servicedetalis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categorys`
--
ALTER TABLE `categorys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `changetime`
--
ALTER TABLE `changetime`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Checkin_master`
--
ALTER TABLE `Checkin_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `extra_service`
--
ALTER TABLE `extra_service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_detalis`
--
ALTER TABLE `invoice_detalis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_master`
--
ALTER TABLE `invoice_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_master`
--
ALTER TABLE `login_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_master`
--
ALTER TABLE `room_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_management`
--
ALTER TABLE `user_management`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visiter_master`
--
ALTER TABLE `visiter_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vistercheckout_master`
--
ALTER TABLE `vistercheckout_master`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advanceallocateroom`
--
ALTER TABLE `advanceallocateroom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `advancebooking`
--
ALTER TABLE `advancebooking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `allocateroom`
--
ALTER TABLE `allocateroom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `allocate_service`
--
ALTER TABLE `allocate_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `allocate_servicedetalis`
--
ALTER TABLE `allocate_servicedetalis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `categorys`
--
ALTER TABLE `categorys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `changetime`
--
ALTER TABLE `changetime`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Checkin_master`
--
ALTER TABLE `Checkin_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `extra_service`
--
ALTER TABLE `extra_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `invoice_detalis`
--
ALTER TABLE `invoice_detalis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `invoice_master`
--
ALTER TABLE `invoice_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `login_master`
--
ALTER TABLE `login_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `room_master`
--
ALTER TABLE `room_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `user_management`
--
ALTER TABLE `user_management`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `visiter_master`
--
ALTER TABLE `visiter_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `vistercheckout_master`
--
ALTER TABLE `vistercheckout_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
