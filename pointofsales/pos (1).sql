-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2025 at 07:55 AM
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
-- Database: `pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `cashiers`
--

CREATE TABLE `cashiers` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` varchar(50) NOT NULL DEFAULT 'Cashier'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cashiers`
--

INSERT INTO `cashiers` (`id`, `username`, `fullname`, `password`, `active`, `created_at`, `role`) VALUES
(1, 'timmy', 'Tim Zap', '$2y$10$9NGBEiqP49EhBzFDj8pAEOzsaIkNOnkj./E0eXo0MW8xna0AOZ8ne', 1, '2025-05-08 08:34:57', 'cashier'),
(4, '420Kael', 'Kimasd', '$2y$10$k3CPBCzOKGRBrXCXJoPZiOLiD98VERrZU20Ti0MBw7CojujjujehS', 1, '2025-05-08 08:37:13', 'cashier'),
(5, 'kimzap', 'asdwwer', '$2y$10$1mejqKc2jYKMM6ziG1TRBuBttYocqii00IGaaF11beGPB.ku/5yEC', 1, '2025-05-08 08:41:12', 'cashier');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `sort_order` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `sort_order`) VALUES
(3, 'Breakfast', 0),
(4, 'Beverages', 0),
(5, 'Pasta', 0),
(6, 'Sushi', 0),
(7, 'Side Dish', 0),
(8, 'Rice Bowl', 0),
(9, 'Meals', 0),
(10, 'Appetizers', 0),
(11, 'Group 9', 0),
(12, 'Group 10', 0),
(13, 'Group 11', 0),
(17, 'zapabta', 0);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `contact_person` varchar(255) DEFAULT NULL,
  `contact_position` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `contact_no` varchar(50) DEFAULT NULL,
  `email_address` varchar(255) DEFAULT NULL,
  `tin_number` varchar(50) DEFAULT NULL,
  `account_class` enum('Individual','Company') DEFAULT 'Individual',
  `active_flag` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `customer_name`, `contact_person`, `contact_position`, `address`, `contact_no`, `email_address`, `tin_number`, `account_class`, `active_flag`) VALUES
(6, 'Teresa Tangpus', 'Teresa Tangpus', '123123', '480 zone 7 Pantay Bata, Tanauan City', '09615491117', 'kimzaptangpus@gmail.com', '567686785878', 'Individual', 1),
(7, 'Kim Tangpus', 'Kim Tangpus', '31232', '480 zone 7 Pantay Bata, Tanauan City', '09615491117', 'kimzaptangpus@gmail.com', '90384756903824576', 'Company', 0),
(9, 'Trixia Pineda', 'Kim Tangpus', 'Owner', 'Pulilan Bulacan', '09289395133', 'tacp@gmail.com', '11234125', 'Individual', 1),
(10, 'timmy', '', '', '', '', '', '', '', 0),
(11, 'sdafsadfsadf', '', '', '', '', '', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `discount_type_id` int(11) NOT NULL,
  `value` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `discounts`
--

INSERT INTO `discounts` (`id`, `name`, `discount_type_id`, `value`) VALUES
(1, '20% off voucher', 1, 20.00),
(2, '-10000', 2, 10000.00),
(3, '30% off voucher', 1, 30.00),
(4, '500', 2, 500.00),
(5, 'asd', 1, 8970873.00);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `status` enum('held','completed') DEFAULT 'held',
  `customer_id` int(11) NOT NULL,
  `order_number` varchar(20) DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `cashier_id` int(11) DEFAULT NULL,
  `discount` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `created_at`, `status`, `customer_id`, `order_number`, `customer_name`, `cashier_id`, `discount`) VALUES
(2, '2025-05-08 13:38:07', '', 7, NULL, NULL, NULL, 0.00),
(3, '2025-05-08 13:39:27', '', 7, NULL, NULL, NULL, 0.00),
(4, '2025-05-08 13:40:16', '', 6, NULL, NULL, NULL, 0.00),
(5, '2025-05-08 13:40:20', '', 6, NULL, NULL, NULL, 0.00),
(6, '2025-05-08 13:47:34', '', 6, 'ORD68478', 'Teresa Tangpus', NULL, 0.00),
(7, '2025-05-08 13:47:50', '', 9, 'ORD95153', 'Trixia Pineda', NULL, 0.00),
(8, '2025-05-08 13:47:59', '', 7, 'ORD23930', 'Kim Tangpus', NULL, 0.00),
(9, '2025-05-08 13:53:48', '', 7, 'ORD26369', 'Kim Tangpus', NULL, 0.00),
(10, '2025-05-08 13:54:35', '', 7, 'ORD29886', 'Kim Tangpus', NULL, 0.00),
(11, '2025-05-08 14:07:31', '', 7, 'ORD75039', 'Kim Tangpus', NULL, 0.00),
(12, '2025-05-08 14:09:20', '', 7, 'ORD67560', 'Kim Tangpus', NULL, 0.00),
(13, '2025-05-08 14:09:47', '', 9, 'ORD82545', 'Trixia Pineda', NULL, 0.00),
(14, '2025-05-08 14:10:27', '', 6, 'ORD34920', 'Teresa Tangpus', NULL, 0.00),
(15, '2025-05-08 14:11:38', '', 6, 'ORD80770', 'Teresa Tangpus', NULL, 0.00),
(16, '2025-05-08 14:11:44', '', 7, 'ORD60940', 'Kim Tangpus', NULL, 0.00),
(17, '2025-05-08 14:12:03', '', 7, 'ORD48995', 'Kim Tangpus', NULL, 0.00),
(18, '2025-05-08 14:14:56', '', 7, 'ORD95073', 'Kim Tangpus', NULL, 0.00),
(19, '2025-05-08 14:17:52', '', 7, 'ORD93530', 'Kim Tangpus', NULL, 0.00),
(20, '2025-05-08 14:18:08', '', 6, 'ORD20815', 'Teresa Tangpus', NULL, 0.00),
(21, '2025-05-08 14:21:44', '', 7, 'ORD16690', 'Kim Tangpus', NULL, 0.00),
(22, '2025-05-08 14:21:56', '', 6, 'ORD17877', 'Teresa Tangpus', NULL, 0.00),
(23, '2025-05-08 14:23:37', '', 9, 'ORD30355', 'Trixia Pineda', NULL, 0.00),
(24, '2025-05-08 14:25:15', '', 6, 'ORD55486', 'Teresa Tangpus', NULL, 0.00),
(25, '2025-05-08 14:25:29', '', 7, 'ORD72408', 'Kim Tangpus', NULL, 0.00),
(26, '2025-05-08 14:27:20', '', 7, 'ORD56542', 'Kim Tangpus', NULL, 0.00),
(27, '2025-05-08 14:27:40', '', 6, 'ORD98427', 'Teresa Tangpus', NULL, 0.00),
(28, '2025-05-08 14:27:51', '', 6, 'ORD58739', 'Teresa Tangpus', NULL, 0.00),
(29, '2025-05-08 14:30:54', '', 6, 'ORD16525', 'Teresa Tangpus', NULL, 0.00),
(30, '2025-05-08 14:31:18', '', 7, 'ORD26594', 'Kim Tangpus', NULL, 0.00),
(31, '2025-05-08 14:31:33', '', 6, 'ORD42130', 'Teresa Tangpus', NULL, 0.00),
(32, '2025-05-08 14:32:47', '', 6, 'ORD77128', 'Teresa Tangpus', NULL, 0.00),
(33, '2025-05-08 14:33:55', '', 9, 'ORD76867', 'Trixia Pineda', NULL, 0.00),
(34, '2025-05-08 14:38:43', '', 9, 'ORD41564', 'Trixia Pineda', NULL, 0.00),
(35, '2025-05-08 14:39:19', '', 10, 'ORD55243', 'timmy', NULL, 0.00),
(36, '2025-05-08 14:40:11', '', 6, 'ORD44091', 'Teresa Tangpus', NULL, 0.00),
(37, '2025-05-08 14:41:43', '', 6, 'ORD56986', 'Teresa Tangpus', NULL, 0.00),
(38, '2025-05-08 14:41:55', '', 10, 'ORD89929', 'timmy', NULL, 0.00),
(39, '2025-05-08 17:32:02', '', 6, 'ORD93573', 'Teresa Tangpus', NULL, 0.00),
(40, '2025-05-09 20:13:49', '', 11, 'ORD38612', 'sdafsadfsadf', NULL, 0.00),
(41, '2025-05-09 20:53:17', '', 11, 'ORD15177', 'sdafsadfsadf', NULL, 0.00),
(42, '2025-05-09 21:00:05', '', 11, 'ORD78272', 'sdafsadfsadf', NULL, 0.00),
(43, '2025-05-09 21:46:24', '', 11, 'ORD15482', 'sdafsadfsadf', NULL, 0.00),
(44, '2025-05-09 21:58:32', '', 11, 'ORD56480', 'sdafsadfsadf', NULL, 0.00),
(45, '2025-05-09 22:02:03', '', 7, 'ORD33690', 'Kim Tangpus', NULL, 0.00),
(46, '2025-05-09 22:19:45', '', 11, 'ORD95074', 'sdafsadfsadf', NULL, 0.00),
(47, '2025-05-12 23:47:17', '', 10, 'ORD53606', 'timmy', NULL, 0.00),
(48, '2025-05-13 00:41:10', '', 7, 'ORD63932', 'Kim Tangpus', NULL, 0.00),
(49, '2025-05-13 16:03:24', '', 10, 'ORD23656', 'timmy', NULL, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `discount` decimal(10,2) DEFAULT 0.00,
  `amount` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_name`, `price`, `qty`, `discount`, `amount`) VALUES
(1, 2, 5, 'Extreme Hog Starter (P) 50KG', 5000.00, 1, 0.00, 5000.00),
(2, 2, 4, 'Extreme Hog Lactation (P) 50KG', 1700.00, 1, 0.00, 1700.00),
(3, 3, 4, 'Extreme Hog Lactation (P) 50KG', 1700.00, 2, 0.00, 3400.00),
(4, 3, 1, 'Extreme Gestation (P) 50KG', 1700.00, 1, 0.00, 1700.00),
(5, 3, 5, 'Extreme Hog Starter (P) 50KG', 5000.00, 1, 0.00, 5000.00),
(6, 3, 2, 'Extreme Hog Finisher (P) 50KG', 2000.00, 1, 0.00, 2000.00),
(7, 4, 4, 'Extreme Hog Lactation (P) 50KG', 1700.00, 1, 0.00, 1700.00),
(8, 4, 5, 'Extreme Hog Starter (P) 50KG', 5000.00, 2, 0.00, 10000.00),
(9, 4, 1, 'Extreme Gestation (P) 50KG', 1700.00, 1, 0.00, 1700.00),
(10, 5, 4, 'Extreme Hog Lactation (P) 50KG', 1700.00, 1, 0.00, 1700.00),
(11, 5, 5, 'Extreme Hog Starter (P) 50KG', 5000.00, 2, 0.00, 10000.00),
(12, 5, 1, 'Extreme Gestation (P) 50KG', 1700.00, 1, 0.00, 1700.00),
(13, 6, 5, 'Extreme Hog Starter (P) 50KG', 5000.00, 1, 0.00, 5000.00),
(14, 6, 4, 'Extreme Hog Lactation (P) 50KG', 1700.00, 1, 0.00, 1700.00),
(15, 7, 5, 'Extreme Hog Starter (P) 50KG', 5000.00, 1, 0.00, 5000.00),
(16, 7, 4, 'Extreme Hog Lactation (P) 50KG', 1700.00, 1, 0.00, 1700.00),
(17, 7, 2, 'Extreme Hog Finisher (P) 50KG', 2000.00, 1, 0.00, 2000.00),
(18, 8, 5, 'Extreme Hog Starter (P) 50KG', 5000.00, 1, 0.00, 5000.00),
(19, 8, 4, 'Extreme Hog Lactation (P) 50KG', 1700.00, 1, 0.00, 1700.00),
(20, 9, 4, 'Extreme Hog Lactation (P) 50KG', 1700.00, 1, 0.00, 1700.00),
(21, 9, 2, 'Extreme Hog Finisher (P) 50KG', 2000.00, 1, 0.00, 2000.00),
(22, 9, 5, 'Extreme Hog Starter (P) 50KG', 5000.00, 1, 0.00, 5000.00),
(23, 10, 2, 'Extreme Hog Finisher (P) 50KG', 2000.00, 1, 0.00, 2000.00),
(24, 10, 1, 'Extreme Gestation (P) 50KG', 1700.00, 1, 0.00, 1700.00),
(25, 10, 4, 'Extreme Hog Lactation (P) 50KG', 1700.00, 1, 0.00, 1700.00),
(26, 10, 5, 'Extreme Hog Starter (P) 50KG', 5000.00, 1, 0.00, 5000.00),
(27, 11, 2, 'Extreme Hog Finisher (P) 50KG', 2000.00, 1, 0.00, 2000.00),
(28, 11, 4, 'Extreme Hog Lactation (P) 50KG', 1700.00, 1, 0.00, 1700.00),
(29, 11, 5, 'Extreme Hog Starter (P) 50KG', 5000.00, 1, 0.00, 5000.00),
(30, 12, 4, 'Extreme Hog Lactation (P) 50KG', 1700.00, 1, 0.00, 1700.00),
(31, 12, 2, 'Extreme Hog Finisher (P) 50KG', 2000.00, 1, 0.00, 2000.00),
(32, 12, 5, 'Extreme Hog Starter (P) 50KG', 5000.00, 1, 0.00, 5000.00),
(33, 13, 4, 'Extreme Hog Lactation (P) 50KG', 1700.00, 2, 0.00, 3400.00),
(34, 13, 2, 'Extreme Hog Finisher (P) 50KG', 2000.00, 2, 0.00, 4000.00),
(35, 14, 5, 'Extreme Hog Starter (P) 50KG', 5000.00, 2, 0.00, 10000.00),
(36, 14, 2, 'Extreme Hog Finisher (P) 50KG', 2000.00, 1, 0.00, 2000.00),
(37, 14, 4, 'Extreme Hog Lactation (P) 50KG', 1700.00, 1, 0.00, 1700.00),
(38, 15, 5, 'Extreme Hog Starter (P) 50KG', 5000.00, 1, 0.00, 5000.00),
(39, 15, 4, 'Extreme Hog Lactation (P) 50KG', 1700.00, 1, 0.00, 1700.00),
(40, 16, 2, 'Extreme Hog Finisher (P) 50KG', 2000.00, 2, 0.00, 4000.00),
(41, 16, 5, 'Extreme Hog Starter (P) 50KG', 5000.00, 1, 0.00, 5000.00),
(42, 17, 4, 'Extreme Hog Lactation (P) 50KG', 1700.00, 1, 0.00, 1700.00),
(43, 17, 5, 'Extreme Hog Starter (P) 50KG', 5000.00, 1, 0.00, 5000.00),
(44, 18, 4, 'Extreme Hog Lactation (P) 50KG', 1700.00, 1, 0.00, 1700.00),
(45, 18, 2, 'Extreme Hog Finisher (P) 50KG', 2000.00, 1, 0.00, 2000.00),
(46, 18, 5, 'Extreme Hog Starter (P) 50KG', 5000.00, 1, 0.00, 5000.00),
(47, 19, 5, 'Extreme Hog Starter (P) 50KG', 5000.00, 1, 0.00, 5000.00),
(48, 19, 4, 'Extreme Hog Lactation (P) 50KG', 1700.00, 1, 0.00, 1700.00),
(49, 19, 2, 'Extreme Hog Finisher (P) 50KG', 2000.00, 1, 0.00, 2000.00),
(50, 19, 9, 'Fiesta Hog Grower (P) 50KG', 1700.00, 1, 0.00, 1700.00),
(51, 19, 8, 'Fiesta Hog Finisher (P) 50KG', 1700.00, 1, 0.00, 1700.00),
(52, 20, 5, 'Extreme Hog Starter (P) 50KG', 5000.00, 1, 0.00, 5000.00),
(53, 20, 4, 'Extreme Hog Lactation (P) 50KG', 1700.00, 1, 0.00, 1700.00),
(54, 21, 5, 'Extreme Hog Starter (P) 50KG', 5000.00, 1, 0.00, 5000.00),
(55, 21, 4, 'Extreme Hog Lactation (P) 50KG', 1700.00, 1, 0.00, 1700.00),
(56, 21, 2, 'Extreme Hog Finisher (P) 50KG', 2000.00, 1, 0.00, 2000.00),
(57, 22, 5, 'Extreme Hog Starter (P) 50KG', 5000.00, 1, 0.00, 5000.00),
(58, 22, 4, 'Extreme Hog Lactation (P) 50KG', 1700.00, 1, 0.00, 1700.00),
(59, 22, 2, 'Extreme Hog Finisher (P) 50KG', 2000.00, 1, 0.00, 2000.00),
(60, 23, 5, 'Extreme Hog Starter (P) 50KG', 5000.00, 1, 0.00, 5000.00),
(61, 23, 4, 'Extreme Hog Lactation (P) 50KG', 1700.00, 1, 0.00, 1700.00),
(62, 23, 2, 'Extreme Hog Finisher (P) 50KG', 2000.00, 1, 0.00, 2000.00),
(63, 24, 5, 'Extreme Hog Starter (P) 50KG', 5000.00, 1, 0.00, 5000.00),
(64, 24, 4, 'Extreme Hog Lactation (P) 50KG', 1700.00, 1, 0.00, 1700.00),
(65, 24, 2, 'Extreme Hog Finisher (P) 50KG', 2000.00, 1, 0.00, 2000.00),
(66, 24, 1, 'Extreme Gestation (P) 50KG', 1700.00, 1, 0.00, 1700.00),
(67, 25, 5, 'Extreme Hog Starter (P) 50KG', 5000.00, 1, 0.00, 5000.00),
(68, 25, 4, 'Extreme Hog Lactation (P) 50KG', 1700.00, 1, 0.00, 1700.00),
(69, 25, 1, 'Extreme Gestation (P) 50KG', 1700.00, 1, 0.00, 1700.00),
(70, 26, 5, 'Extreme Hog Starter (P) 50KG', 5000.00, 1, 0.00, 5000.00),
(71, 26, 4, 'Extreme Hog Lactation (P) 50KG', 1700.00, 1, 0.00, 1700.00),
(72, 26, 1, 'Extreme Gestation (P) 50KG', 1700.00, 2, 0.00, 3400.00),
(73, 27, 5, 'Extreme Hog Starter (P) 50KG', 5000.00, 1, 0.00, 5000.00),
(74, 27, 4, 'Extreme Hog Lactation (P) 50KG', 1700.00, 1, 0.00, 1700.00),
(75, 27, 2, 'Extreme Hog Finisher (P) 50KG', 2000.00, 1, 0.00, 2000.00),
(76, 28, 5, 'Extreme Hog Starter (P) 50KG', 5000.00, 1, 0.00, 5000.00),
(77, 28, 4, 'Extreme Hog Lactation (P) 50KG', 1700.00, 1, 0.00, 1700.00),
(78, 28, 2, 'Extreme Hog Finisher (P) 50KG', 2000.00, 3, 0.00, 6000.00),
(79, 29, 5, 'Extreme Hog Starter (P) 50KG', 5000.00, 1, 0.00, 5000.00),
(80, 29, 4, 'Extreme Hog Lactation (P) 50KG', 1700.00, 1, 0.00, 1700.00),
(81, 29, 1, 'Extreme Gestation (P) 50KG', 1700.00, 1, 0.00, 1700.00),
(82, 30, 5, 'Extreme Hog Starter (P) 50KG', 5000.00, 1, 0.00, 5000.00),
(83, 30, 4, 'Extreme Hog Lactation (P) 50KG', 1700.00, 1, 0.00, 1700.00),
(84, 31, 5, 'Extreme Hog Starter (P) 50KG', 5000.00, 1, 0.00, 5000.00),
(85, 31, 4, 'Extreme Hog Lactation (P) 50KG', 1700.00, 1, 0.00, 1700.00),
(86, 32, 1, 'Extreme Gestation (P) 50KG', 1700.00, 1, 0.00, 1700.00),
(87, 32, 2, 'Extreme Hog Finisher (P) 50KG', 2000.00, 1, 0.00, 2000.00),
(88, 32, 4, 'Extreme Hog Lactation (P) 50KG', 1700.00, 1, 0.00, 1700.00),
(89, 33, 5, 'Extreme Hog Starter (P) 50KG', 5000.00, 1, 0.00, 5000.00),
(90, 33, 4, 'Extreme Hog Lactation (P) 50KG', 1700.00, 2, 0.00, 3400.00),
(91, 34, 4, 'Extreme Hog Lactation (P) 50KG', 1700.00, 1, 0.00, 1700.00),
(92, 34, 2, 'Extreme Hog Finisher (P) 50KG', 2000.00, 2, 0.00, 4000.00),
(93, 34, 5, 'Extreme Hog Starter (P) 50KG', 5000.00, 1, 0.00, 5000.00),
(94, 35, 5, 'Extreme Hog Starter (P) 50KG', 5000.00, 1, 0.00, 5000.00),
(95, 35, 4, 'Extreme Hog Lactation (P) 50KG', 1700.00, 12, 0.00, 20400.00),
(96, 36, 5, 'Extreme Hog Starter (P) 50KG', 5000.00, 2, 0.00, 10000.00),
(97, 37, 1, 'Extreme Gestation (P) 50KG', 1700.00, 1, 0.00, 1700.00),
(98, 37, 2, 'Extreme Hog Finisher (P) 50KG', 2000.00, 1, 0.00, 2000.00),
(99, 37, 4, 'Extreme Hog Lactation (P) 50KG', 1700.00, 1, 0.00, 1700.00),
(100, 37, 5, 'Extreme Hog Starter (P) 50KG', 5000.00, 1, 0.00, 5000.00),
(101, 38, 5, 'Extreme Hog Starter (P) 50KG', 5000.00, 2, 0.00, 10000.00),
(102, 38, 4, 'Extreme Hog Lactation (P) 50KG', 1700.00, 1, 0.00, 1700.00),
(103, 38, 2, 'Extreme Hog Finisher (P) 50KG', 2000.00, 1, 0.00, 2000.00),
(104, 38, 1, 'Extreme Gestation (P) 50KG', 1700.00, 1, 0.00, 1700.00),
(105, 39, 5, 'Extreme Hog Starter (P) 50KG', 5000.00, 1, 0.00, 5000.00),
(106, 39, 4, 'Extreme Hog Lactation (P) 50KG', 1700.00, 1, 0.00, 1700.00),
(107, 40, 5, 'Extreme Hog Starter (P) 50KG', 5000.00, 1, 0.00, 5000.00),
(108, 40, 4, 'Extreme Hog Lactation (P) 50KG', 1700.00, 1, 0.00, 1700.00),
(109, 40, 1, 'Extreme Gestation (P) 50KG', 1700.00, 1, 0.00, 1700.00),
(110, 40, 27, 'Kiiiiim', 213123.00, 1, 0.00, 213123.00),
(111, 40, 22, 'Kiiim', 100.00, 1, 0.00, 100.00),
(112, 41, 4, 'Extreme Hog Lactation (P) 50KG', 1700.00, 1, 0.00, 1700.00),
(113, 41, 2, 'Extreme Hog Finisher (P) 50KG', 2000.00, 1, 0.00, 2000.00),
(114, 41, 5, 'Extreme Hog Starter (P) 50KG', 5000.00, 1, 0.00, 5000.00),
(115, 42, 1, 'Extreme Gestation (P) 50KG', 1700.00, 1, 0.00, 1700.00),
(116, 42, 2, 'Extreme Hog Finisher (P) 50KG', 2000.00, 1, 0.00, 2000.00),
(117, 42, 4, 'Extreme Hog Lactation (P) 50KG', 1700.00, 1, 0.00, 1700.00),
(118, 42, 5, 'Extreme Hog Starter (P) 50KG', 5000.00, 1, 0.00, 5000.00),
(119, 43, 5, 'Extreme Hog Starter (P) 50KG', 5000.00, 1, 0.00, 5000.00),
(120, 43, 4, 'Extreme Hog Lactation (P) 50KG', 1700.00, 1, 0.00, 1700.00),
(121, 43, 2, 'Extreme Hog Finisher (P) 50KG', 2000.00, 1, 0.00, 2000.00),
(122, 43, 1, 'Extreme Gestation (P) 50KG', 1700.00, 1, 0.00, 1700.00),
(123, 45, 2, 'Extreme Hog Finisher (P) 50KG', 2000.00, 1, NULL, 2000.00),
(124, 45, 1, 'Extreme Gestation (P) 50KG', 1700.00, 1, NULL, 1700.00),
(125, 45, 4, 'Extreme Hog Lactation (P) 50KG', 1700.00, 1, NULL, 1700.00),
(126, 45, 5, 'Extreme Hog Starter (P) 50KG', 5000.00, 1, NULL, 5000.00),
(127, 46, 5, 'Extreme Hog Starter (P) 50KG', 5000.00, 5, 5000.00, 20000.00),
(128, 47, 4, 'Extreme Hog Lactation (P) 50KG', 1700.00, 1, 713.00, 986.67),
(129, 47, 2, 'Extreme Hog Finisher (P) 50KG', 2000.00, 2, 713.00, 3286.67),
(130, 47, 5, 'Extreme Hog Starter (P) 50KG', 5000.00, 1, 713.00, 4286.67),
(131, 48, 1, 'Extreme Gestation (P) 50KG', 1700.00, 1, 99999999.99, -99999999.99),
(132, 48, 2, 'Extreme Hog Finisher (P) 50KG', 2000.00, 17, 99999999.99, -99999999.99),
(133, 49, 2, 'Extreme Hog Finisher (P) 50KG', 2000.00, 1, 1220.00, 780.00),
(134, 49, 4, 'Extreme Hog Lactation (P) 50KG', 1700.00, 6, 1220.00, 8980.00);

-- --------------------------------------------------------

--
-- Table structure for table `other_charges`
--

CREATE TABLE `other_charges` (
  `id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `charge` decimal(10,2) NOT NULL,
  `with_timer` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `other_charges`
--

INSERT INTO `other_charges` (`id`, `description`, `charge`, `with_timer`) VALUES
(1, 'asdasdasd123123', 2222.00, 0);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image_url`, `category`) VALUES
(1, 'Extreme Gestation (P) 50KG', 1700.00, 'images/whitetee.jpg', 'Pasta'),
(2, 'Extreme Hog Finisher (P) 50KG', 2000.00, 'images/whitetee.jpg', 'Group 11'),
(4, 'Extreme Hog Lactation (P) 50KG', 1700.00, 'https://via.placeholder.com/80', 'Breakfast'),
(5, 'Extreme Hog Starter (P) 50KG', 5000.00, 'https://via.placeholder.com/80', 'Breakfast'),
(6, 'Fiesta Brood Sow (M) 50KG', 1700.00, 'https://via.placeholder.com/80', 'Breakfast'),
(7, 'Fiesta Brood Sow (P) 50KG', 1700.00, 'https://via.placeholder.com/80', 'Pasta'),
(8, 'Fiesta Hog Finisher (P) 50KG', 1700.00, 'https://via.placeholder.com/80', 'Rice Bowl'),
(9, 'Fiesta Hog Grower (P) 50KG', 1700.00, 'https://via.placeholder.com/80', NULL),
(10, 'Fiesta Hog Lactation (M) 50KG', 1700.00, 'https://via.placeholder.com/80', NULL),
(11, 'Fiesta Lactation (P) 50KG', 1700.00, 'https://via.placeholder.com/80', NULL),
(12, 'Premium Customized Quail Layer Crumble', 1700.00, 'https://via.placeholder.com/80', NULL),
(13, 'Premium Fiesta HF (M)', 1700.00, 'https://via.placeholder.com/80', 'Breakfast'),
(14, 'Premium Fiesta HG (M)', 1700.00, 'https://via.placeholder.com/80', NULL),
(15, 'Urea Swire Red', 1700.00, 'https://via.placeholder.com/80', NULL),
(16, 'Vantage Hog Starter (P) 50KG', 1700.00, 'https://via.placeholder.com/80', NULL),
(17, 'Vantage Hog Grower (P) 50KG', 1700.00, 'https://via.placeholder.com/80', NULL),
(18, 'Vantage Hog Finisher (P) 50KG', 1700.00, 'https://via.placeholder.com/80', 'Side Dish'),
(19, 'Custom Layer Feed 50KG', 1700.00, 'https://via.placeholder.com/80', NULL),
(20, 'Poultry Booster Mix (P) 25KG', 1700.00, 'https://via.placeholder.com/80', NULL),
(21, 'zap', 0.00, 'images/whitetee.jpg', NULL),
(22, 'Kiiim', 100.00, 'images/whitetee.jpg', 'Appetizers'),
(27, 'Kiiiiim', 213123.00, 'images/whitetee.jpg', 'Breakfast');

-- --------------------------------------------------------

--
-- Table structure for table `storage_areas`
--

CREATE TABLE `storage_areas` (
  `id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `printer_location` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `storage_areas`
--

INSERT INTO `storage_areas` (`id`, `description`, `printer_location`, `updated_at`) VALUES
(1, 'bar', 'EPSON TM-T(180dpi) Receipt', '2025-05-13 06:53:17'),
(2, 'kitchen', 'EPSON TM-T(180dpi) Receipt', '2025-05-13 06:53:29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'cashier'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `name`, `role`) VALUES
(1, 'kimzap', '$2y$10$Wdf4ULWTUJI2O5Nqf1BaLeYG4G5yrUjqNc0mrnWQbezu9f9IsMixO', 'kimzaptangpus@gmail.com', 'kim tangpus', 'cashier');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cashiers`
--
ALTER TABLE `cashiers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_customer` (`customer_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `other_charges`
--
ALTER TABLE `other_charges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `storage_areas`
--
ALTER TABLE `storage_areas`
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
-- AUTO_INCREMENT for table `cashiers`
--
ALTER TABLE `cashiers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT for table `other_charges`
--
ALTER TABLE `other_charges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `storage_areas`
--
ALTER TABLE `storage_areas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_customer` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
