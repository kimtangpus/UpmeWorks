-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2025 at 08:10 AM
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
-- Database: `orderingapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `clothing_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clothing`
--

CREATE TABLE `clothing` (
  `id` int(11) NOT NULL,
  `item_name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clothing`
--

INSERT INTO `clothing` (`id`, `item_name`, `description`, `image`, `price`) VALUES
(1, 'Classic White Tee', 'A breathable cotton t-shirt perfect for everyday wear.', 'whitetee.jpg', 1000.00),
(2, 'Denim Jacket', 'A stylish, durable denim jacket with silver buttons and front pockets.', 'denim jacket.jpg', 999.00),
(3, 'Black Hoodie', 'A warm hoodie made of fleece, ideal for casual and active wear.', 'blcakhoodie.jpg', 1999.00),
(4, 'Slim Fit Jeans', 'Blue washed jeans with a comfortable slim fit design.', 'slimfitjeans.jpg', 989.00),
(5, 'Floral Dress', 'A flowy floral dress perfect for summer or spring outings.', 'floraldress.jpg', 2999.00),
(6, 'Chino Shorts', 'Lightweight and breathable khaki shorts for warm weather.', 'chinoshorts.jpg', 1899.00),
(7, 'Leather Jacket', 'Premium black leather jacket with zipped pockets and a soft lining.', 'leatherjacket.jpg', 10000.00),
(8, 'Striped Polo Shirt', 'Smart-casual polo shirt with navy and white stripes.', 'striped.jpg', 3000.00),
(9, 'Maxi Skirt', 'Elegant maxi skirt in pastel color with elastic waistband.', 'maxiskirt.jpg', 299.00),
(10, 'Puffer Vest', 'Quilted puffer vest for layering in colder temperatures.', 'puffer.jpg', 799.00);

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  `vat` decimal(10,2) DEFAULT NULL,
  `withholding` decimal(10,2) DEFAULT NULL,
  `grand_total` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `invoice_date` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `reference_no` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `contact_no` varchar(100) DEFAULT NULL,
  `salesman` varchar(100) DEFAULT NULL,
  `pricelist` varchar(50) DEFAULT NULL,
  `po_ref_no` varchar(100) DEFAULT NULL,
  `ship_to` varchar(255) DEFAULT NULL,
  `ship_address` text DEFAULT NULL,
  `credit_term` varchar(50) DEFAULT NULL,
  `delivery_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `user_id`, `user_name`, `remarks`, `subtotal`, `discount`, `vat`, `withholding`, `grand_total`, `created_at`, `invoice_date`, `due_date`, `reference_no`, `address`, `contact_no`, `salesman`, `pricelist`, `po_ref_no`, `ship_to`, `ship_address`, `credit_term`, `delivery_date`) VALUES
(1, 1, NULL, '', 12100.00, 0.00, 0.00, 0.00, 12100.00, '2025-04-16 06:37:46', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 1, NULL, '', 400.00, 0.00, 0.00, 0.00, 400.00, '2025-04-16 06:40:04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 1, NULL, '', 329868.00, 0.00, 1.00, 0.00, 369452.16, '2025-04-16 06:42:26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 1, NULL, '', 28400.86, 0.00, 0.00, 0.00, 28400.86, '2025-04-16 06:47:15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 1, NULL, '', 28400.86, 0.00, 0.00, 0.00, 28400.86, '2025-04-16 06:47:55', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 1, NULL, '', 28400.86, 0.00, 0.00, 0.00, 28400.86, '2025-04-16 06:49:02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 1, NULL, 'asdasdasdasdasdasdasdasd', 28400.86, 0.00, 1.00, 0.00, 31808.96, '2025-04-16 06:49:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 1, NULL, 'asdasdasdasdasdasdasdasdasdwwwww', 28400.86, 0.00, 1.00, 1.00, 31240.95, '2025-04-16 06:49:34', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 1, NULL, 'pabile', 65967.00, 500.00, 1.00, 1.00, 72063.70, '2025-04-16 06:54:26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 1, NULL, 'pabile nga ule', 75867.00, 500.00, 1.00, 1.00, 82953.70, '2025-04-16 06:55:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 1, NULL, 'asdasd', 100.00, 50.00, 1.00, 1.00, 60.00, '2025-04-16 07:25:26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 1, NULL, 'kim', 9900.00, 100.00, 1.00, 1.00, 10790.00, '2025-04-16 07:27:14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 1, NULL, 'kim', 9900.00, 100.00, 1.00, 1.00, 10790.00, '2025-04-16 07:27:27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 1, NULL, '2323', 122247.18, 299.00, 1.00, 1.00, 134172.90, '2025-04-16 07:28:38', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 1, NULL, '2323333', 30870.50, 800.00, 1.00, 1.00, 33157.55, '2025-04-16 07:29:41', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 1, NULL, 'pabile lods', 9800.00, 99.00, 1.00, 1.00, 10681.00, '2025-04-16 07:38:46', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 1, 'kim', 'asdasd', 25277.00, 1000.00, 1.00, 1.00, 26804.70, '2025-04-16 07:41:51', '2025-04-16', '0000-00-00', '2', 'tanauan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 1, 'kim', 'wala naman', 71165.00, 12000.00, 1.00, 1.00, 66281.50, '2025-04-16 07:45:36', '2025-04-16', '2025-04-24', '1', 'tanauan city', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 1, 'asd', 'asdasdasdad', 8800.00, 33.00, 1.00, 1.00, 9647.00, '2025-04-16 07:50:25', '2025-04-16', '2025-04-17', '25', 'tatataa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 1, 'kim', 'asdasdas', 400.00, 23.00, 1.00, 1.00, 417.00, '2025-04-16 08:03:12', '2025-04-16', '2025-04-17', '222', 'tanauan', '09615491117', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 1, '', '', 1234.82, 0.00, 0.00, 0.00, 1234.82, '2025-04-22 04:24:57', '2025-04-22', '0000-00-00', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 1, 'asd', 'asdsd', 7800.00, 1000.00, 1.00, 1.00, 7580.00, '2025-04-22 04:30:33', '2025-04-22', '0000-00-00', 'dasd', 'dasd', 'asd', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 1, 'asd', 'asdsd', 0.00, 1000.00, 1.00, 1.00, -1000.00, '2025-04-22 04:33:38', '2025-04-22', '0000-00-00', 'dasd', 'dasd', 'asd', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24, 1, 'asd', 'asdsd', 0.00, 1000.00, 1.00, 1.00, -1000.00, '2025-04-22 04:33:57', '2025-04-22', '0000-00-00', 'dasd', 'dasd', 'asd', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(25, 1, 'asd', 'asdsd', 0.00, 1000.00, 1.00, 1.00, -1000.00, '2025-04-22 04:35:30', '2025-04-22', '0000-00-00', 'dasd', 'dasd', 'asd', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(26, 1, 'kim', 'weqwe', 7800.00, 1000.00, 1.00, 1.00, 7580.00, '2025-04-22 04:36:52', '2025-04-22', '0000-00-00', 'asd', 'ddsasd', 'asd', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(27, 1, 'kim', 'weqwe', 7800.00, 1000.00, 1.00, 1.00, 7580.00, '2025-04-22 04:39:53', '2025-04-22', '0000-00-00', 'asd', 'ddsasd', 'asd', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(28, 1, 'kim', 'weqwe', 7800.00, 1000.00, 1.00, 1.00, 7580.00, '2025-04-22 04:40:25', '2025-04-22', '0000-00-00', 'asd', 'ddsasd', 'asd', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(29, 1, 'kim', 'weqwe', 7800.00, 1000.00, 1.00, 1.00, 7580.00, '2025-04-22 04:40:27', '2025-04-22', '0000-00-00', 'asd', 'ddsasd', 'asd', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(30, 1, 'kim', 'weqwe', 7800.00, 1000.00, 1.00, 1.00, 7580.00, '2025-04-22 04:43:00', '2025-04-22', '0000-00-00', 'asd', 'ddsasd', 'asd', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(31, 1, 'kim', 'weqwe', 7800.00, 1000.00, 1.00, 1.00, 7580.00, '2025-04-22 04:44:02', '2025-04-22', '0000-00-00', 'asd', 'ddsasd', 'asd', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(32, 1, 'kim', 'weqwe', 7800.00, 1000.00, 1.00, 1.00, 7580.00, '2025-04-22 04:47:44', '2025-04-22', '0000-00-00', 'asd', 'ddsasd', 'asd', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(33, 1, 'kim tangpus', 'nothing', 185077.20, 5000.00, 1.00, 1.00, 198584.92, '2025-04-22 04:49:30', '2025-04-22', '0000-00-00', '1234', 'tanauan city', '09615491117', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(34, 1, '', '', 100.00, 0.00, 0.00, 0.00, 100.00, '2025-04-22 05:08:45', '2025-04-22', '0000-00-00', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(35, 1, 'kim tangpus', '', 0.00, 0.00, 1.00, 0.00, 0.00, '2025-04-22 05:12:10', '2025-04-22', '0000-00-00', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(36, 1, 'kim tangpus', '', 0.00, 0.00, 1.00, 0.00, 0.00, '2025-04-22 05:13:46', '2025-04-22', '2025-04-24', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(37, 1, 'kim tangpus', 'Array', 0.00, 0.00, 1.00, 0.00, 0.00, '2025-04-22 05:14:32', '2025-04-22', '2025-04-23', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(38, 1, 'kim tangpus', 'Array', 0.00, 0.00, 1.00, 0.00, 0.00, '2025-04-22 07:47:51', '2025-04-22', '0000-00-00', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(39, 1, 'kim tangpus', 'Array', 0.00, 0.00, 1.00, 0.00, 0.00, '2025-04-22 07:48:38', '2025-04-22', '0000-00-00', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(40, 1, 'kim tangpus', 'Array', 0.00, 0.00, 1.00, 0.00, 0.00, '2025-04-22 07:51:51', '2025-04-22', '2025-04-23', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(41, 1, '', 'asasdfsdfsad', 111080.00, 0.00, 1.00, 0.00, 124409.60, '2025-04-22 08:42:33', '2025-04-22', '2025-04-24', '232', '2323', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(42, 1, '', '', 0.00, 0.00, 0.00, 0.00, 0.00, '2025-04-22 08:43:00', '2025-04-22', '0000-00-00', '', '', 'asdasd323123', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(43, 1, 'kim tangpus', 'Array', 0.00, 0.00, 1.00, 0.00, 0.00, '2025-04-22 08:46:32', '2025-04-22', '0000-00-00', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(44, 1, 'kim tangpus', '12323123', 4366.82, 0.00, 1.00, 0.00, 4890.84, '2025-04-22 08:48:27', '2025-04-22', '2025-05-09', '3333', '123', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(45, 1, 'kim tangpus', '', 0.00, 0.00, 0.00, 0.00, 0.00, '2025-04-22 08:48:58', '2025-04-22', '0000-00-00', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(46, 1, 'kim tangpus', '', 100.00, 0.00, 0.00, 0.00, 100.00, '2025-04-22 08:50:24', '2025-04-22', '0000-00-00', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(47, 1, 'kim tangpus', '', 1234.82, 0.00, 0.00, 0.00, 1234.82, '2025-04-22 09:11:50', '2025-04-22', '0000-00-00', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(48, 1, 'kim tangpus', '', 1233.00, 0.00, 0.00, 0.00, 1233.00, '2025-04-22 09:15:25', '2025-04-22', '0000-00-00', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(49, 1, 'kim tangpus', '', 1233.00, 0.00, 0.00, 0.00, 1233.00, '2025-04-23 04:26:23', '2025-04-23', '0000-00-00', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(50, 1, 'kim tangpus', '', 100.00, 0.00, 0.00, 0.00, 100.00, '2025-04-23 04:28:28', '2025-04-23', '2025-04-24', '', '3', '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(51, 1, 'kim tangpus', '', 100.00, 0.00, 0.00, 0.00, 100.00, '2025-04-23 04:28:42', '2025-04-23', '0000-00-00', '', '555', '322', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(52, 2, 'Kiiiiim', '', 100.00, 0.00, 0.00, 0.00, 100.00, '2025-04-23 04:30:12', '2025-04-23', '0000-00-00', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(53, 1, NULL, 'nothing', 100.00, 0.00, 1.00, 0.00, 112.00, '2025-04-23 05:00:58', '2025-04-23', '2025-04-24', '', 'tanauan', '0961', '', '', '625', 'kim', 'tanauan', 'Cash', '2025-04-30'),
(54, 1, NULL, 'asdasd', 999.00, 0.00, 0.00, 0.00, 999.00, '2025-04-23 05:14:35', '2025-04-23', '2025-04-24', '33333', 'sdasdasd', 'asda', '', '', '33', '323', '3231', 'Debit', '2025-04-25'),
(55, 1, NULL, '', 0.00, 0.00, 0.00, 0.00, 0.00, '2025-04-23 05:19:10', '2025-04-23', '0000-00-00', '', '', '', '', '', '', '', '', 'Credit', '0000-00-00'),
(56, 1, 'kimzap', '', 0.00, 0.00, 0.00, 0.00, 0.00, '2025-04-23 05:19:58', '2025-04-23', '0000-00-00', '', '', '', '', '', '', '', '', 'Credit', '0000-00-00'),
(57, 1, 'kim tangpus', '', 0.00, 0.00, 0.00, 0.00, 0.00, '2025-04-23 05:20:39', '2025-04-23', '0000-00-00', '', '', '', '', '', '', '', '', 'Credit', '0000-00-00'),
(58, 1, 'kim tangpus', 'na', 43155.00, 0.00, 1.00, 0.00, 48333.60, '2025-04-23 05:21:25', '2025-04-23', '2025-04-24', '700', 'tanauan', '0961', '', '', '700', 'kim', 'tanauan', 'Credit', '2025-04-25'),
(59, 1, 'kim tangpus', '', 100.00, 0.00, 0.00, 0.00, 100.00, '2025-04-23 05:23:40', '2025-04-23', '0000-00-00', '', '', '', '', '', '', '', '', 'Credit', '0000-00-00'),
(60, 1, 'kim tangpus', '', 100.00, 0.00, 0.00, 0.00, 100.00, '2025-04-23 05:24:13', '2025-04-23', '0000-00-00', '', '', '', 'Tim', '', '', '', '', 'Credit', '0000-00-00'),
(61, 1, 'kim tangpus', '', 100.00, 0.00, 0.00, 0.00, 100.00, '2025-04-23 05:24:36', '2025-04-23', '0000-00-00', '', '', '', 'Tim', 'COD', '', '', '', 'Credit', '0000-00-00'),
(62, 1, 'kim tangpus', '', 100.00, 0.00, 0.00, 0.00, 100.00, '2025-04-23 06:27:50', '2025-04-23', '0000-00-00', '', '', '', 'Kim', 'COD', '', '', '', 'Credit', '0000-00-00'),
(63, 1, 'kim tangpus', '', 0.00, 20.00, 0.00, 0.00, -20.00, '2025-04-23 06:29:18', '2025-04-23', '0000-00-00', '', '', '', 'Kim', 'COD', '', '', '', 'Credit', '0000-00-00'),
(64, 1, 'kim tangpus', '', 100.00, 20.00, 0.00, 0.00, 80.00, '2025-04-23 06:29:31', '2025-04-23', '0000-00-00', '', '', '', 'Kim', 'COD', '', '', '', 'Credit', '0000-00-00'),
(65, 1, 'kim tangpus', '', 1233.00, 0.00, 0.00, 0.00, 1233.00, '2025-04-23 06:30:39', '2025-04-23', '0000-00-00', '', '', '', 'Kim', 'COD', '', '', '', 'Credit', '0000-00-00'),
(66, 1, 'kim tangpus', '', 0.00, 0.00, 0.00, 0.00, 0.00, '2025-04-23 06:30:48', '2025-04-23', '2025-04-26', '', '', '', 'Kim', 'COD', '', '', '', 'Credit', '0000-00-00'),
(67, 1, 'kim tangpus', 'asdasd', 1233.00, 0.00, 0.00, 0.00, 1233.00, '2025-04-23 16:34:37', '2025-04-23', '0000-00-00', '', '', '', 'Kim', 'COD', '', '', '', 'Credit', '0000-00-00'),
(68, 1, 'kim tangpus', '', 2300.00, 0.00, 0.00, 0.00, 2300.00, '2025-04-23 16:42:53', '2025-04-23', '0000-00-00', '', '', '', 'Kim', 'COD', '', '', '', 'Credit', '0000-00-00'),
(69, 1, 'kim tangpus', '', 0.00, 0.00, 0.00, 0.00, 0.00, '2025-04-23 16:44:53', '2025-04-23', '0000-00-00', '', '', '', 'Kim', 'COD', '', '', '', 'Credit', '0000-00-00'),
(70, 1, 'kim tangpus', '', 100.00, 0.00, 0.00, 0.00, 100.00, '2025-04-23 16:45:11', '2025-04-23', '0000-00-00', '', '', '', 'Kim', 'COD', '', '', '', 'Credit', '0000-00-00'),
(71, 1, 'kim tangpus', '', 2300.00, 0.00, 0.00, 0.00, 2300.00, '2025-04-23 16:45:43', '2025-04-23', '0000-00-00', '', '', '', 'Kim', 'COD', '', '', '', 'Credit', '0000-00-00'),
(72, 1, 'kim tangpus', '', 1233.00, 0.00, 0.00, 0.00, 1233.00, '2025-04-23 16:46:05', '2025-04-23', '0000-00-00', '', '', '', 'Kim', 'COD', '', '', '', 'Credit', '0000-00-00'),
(73, 1, 'kim tangpus', '', 1233.00, 0.00, 0.00, 0.00, 1233.00, '2025-04-24 04:51:14', '2025-04-24', '0000-00-00', '', '', '', 'Kim', 'COD', '', '', '', 'Credit', '0000-00-00'),
(74, 1, 'kim tangpus', '', 0.00, 0.00, 0.00, 0.00, 0.00, '2025-04-24 04:52:48', '2025-04-24', '0000-00-00', '', '', '', 'Kim', 'COD', '', '', '', 'Credit', '0000-00-00'),
(75, 1, 'kim tangpus', '', 0.00, 0.00, 0.00, 0.00, 0.00, '2025-04-24 04:53:42', '2025-04-24', '0000-00-00', '', '', '', 'Kim', 'COD', '', '', '', 'Credit', '0000-00-00'),
(76, 1, 'kim tangpus', '', 4400.00, 0.00, 0.00, 0.00, 4400.00, '2025-04-24 04:54:06', '2025-04-24', '0000-00-00', '', 'tanauan', '0961', 'Kim', 'COD', '', '', '', 'Credit', '0000-00-00'),
(77, 1, 'kim tangpus', '', 0.00, 0.00, 0.00, 0.00, 0.00, '2025-04-24 04:55:29', '2025-04-24', '2025-04-25', '', 'tanauan', '0961', 'Kim', 'Debit', '', 'kim', 'tanauan', 'Credit', '2025-04-29'),
(78, 1, 'kim tangpus', '', 0.00, 0.00, 0.00, 0.00, 0.00, '2025-04-24 04:58:25', '2025-04-24', '2025-04-25', '', 'tanauan', '0961', 'Kim', 'Debit', '', 'kim', 'tanauan', 'Credit', '2025-04-29'),
(79, 1, 'kim tangpus', '', 0.00, 0.00, 0.00, 0.00, 0.00, '2025-04-24 04:58:28', '2025-04-24', '2025-04-25', '', 'tanauan', '0961', 'Kim', 'COD', '', 'kim', 'tanauan', 'Credit', '2025-04-29'),
(80, 1, 'kim tangpus', '', 0.00, 0.00, 0.00, 0.00, 0.00, '2025-04-24 04:58:35', '2025-04-24', '2025-04-25', '', 'tanauan', '0961', 'Kim', 'Debit', '', 'kim', 'tanauan', 'Credit', '2025-04-29'),
(81, 1, 'kim tangpus', '', 333.00, 0.00, 0.00, 0.00, 333.00, '2025-04-24 04:59:31', '2025-04-24', '2025-04-25', '', '', '', 'Kim', 'COD', '', '', '', 'Credit', '2025-04-26'),
(82, 1, 'kim tangpus', 'sdqwe', 3331.00, 0.00, 0.00, 0.00, 3331.00, '2025-04-24 05:09:20', '2025-04-24', '2025-04-25', '2333', 'tanauan', '0961', 'Kim', 'Debit', '121', 'kim', 'tanauan', 'Credit', '2025-04-29'),
(83, 1, 'kim tangpus', 'kim tangpus', 115445.00, 7000.00, 1.00, 0.00, 122298.40, '2025-04-24 05:13:10', '2025-04-24', '2025-04-25', '2333', 'tanauan', '0961', 'Kim', 'COD', '121', 'kim', 'tanauan', 'Credit', '2025-04-25'),
(84, 1, 'kim tangpus', '', 64823.00, 0.00, 0.00, 0.00, 64823.00, '2025-04-24 05:16:21', '2025-04-24', '2025-04-25', '232', 'tanauan', '0961', 'Kim', 'COD', '625', 'kim', 'tanauan', 'Credit', '2025-04-30'),
(85, 1, 'kim tangpus', '', 3100.00, 0.00, 0.00, 0.00, 3100.00, '2025-04-24 05:17:08', '2025-04-24', '0000-00-00', '', '', '', 'Kim', 'COD', '', '', '', 'Credit', '0000-00-00'),
(86, 1, 'kim tangpus', '', 7398.00, 0.00, 1.00, 0.00, 8285.76, '2025-04-24 05:17:16', '2025-04-24', '0000-00-00', '', '', '', 'Kim', 'COD', '', '', '', 'Credit', '0000-00-00'),
(87, 1, 'kim tangpus', '', 71910.00, 5000.00, 0.00, 0.00, 66910.00, '2025-04-24 05:19:22', '2025-04-24', '0000-00-00', '', '', '', 'Kim', 'COD', '', '', '', 'Credit', '0000-00-00'),
(88, 1, 'kim tangpus', '', 98640.00, 8000.00, 0.00, 0.00, 90640.00, '2025-04-24 05:20:27', '2025-04-24', '0000-00-00', '', '', '', 'Kim', 'COD', '', '', '', 'Credit', '0000-00-00'),
(89, 1, 'kim tangpus', '', 110970.00, 0.00, 1.00, 0.00, 124286.40, '2025-04-24 05:22:06', '2025-04-24', '0000-00-00', '', '', '', 'Kim', 'COD', '', '', '', 'Credit', '0000-00-00'),
(90, 1, 'kim tangpus', '', 1233.00, 0.00, 1.00, 0.00, 1380.96, '2025-04-24 05:22:23', '2025-04-24', '0000-00-00', '', '', '', 'Kim', 'COD', '', '', '', 'Credit', '0000-00-00'),
(91, 1, 'kim tangpus', '', 110970.00, 0.00, 0.00, 0.00, 110970.00, '2025-04-24 05:22:36', '2025-04-24', '0000-00-00', '', '', '', 'Kim', 'COD', '', '', '', 'Credit', '0000-00-00'),
(92, 1, 'kim tangpus', '', 1233.00, 500.00, 1.00, 0.00, 880.96, '2025-04-24 05:22:48', '2025-04-24', '0000-00-00', '', '', '', 'Kim', 'COD', '', '', '', 'Credit', '0000-00-00'),
(93, 1, 'kim tangpus', '', 1233.00, 0.00, 1.00, 0.00, 1380.96, '2025-04-24 05:23:06', '2025-04-24', '0000-00-00', '', '', '', 'Kim', 'COD', '', '', '', 'Credit', '0000-00-00'),
(94, 1, 'kim tangpus', '', 1233.00, 0.00, 0.00, 0.00, 1233.00, '2025-04-24 05:23:16', '2025-04-24', '0000-00-00', '', '', '', 'Kim', 'COD', '', '', '', 'Credit', '0000-00-00'),
(95, 1, 'kim tangpus', '', 1233.00, 0.00, 0.00, 0.00, 1233.00, '2025-04-24 05:23:40', '2025-04-24', '0000-00-00', '', '', '', 'Kim', 'COD', '', '', '', 'Credit', '0000-00-00'),
(96, 1, 'kim tangpus', 'cvbnvcbnvbm', 1200.00, 0.00, 1.00, 0.00, 1344.00, '2025-04-24 05:28:37', '2025-04-24', '2025-04-25', '2333', 'tanauan', '0961', 'Kim', 'COD', '121', 'kim', 'tanauan', 'Credit', '2025-04-25'),
(97, 1, 'kim tangpus', '', 43155.00, 0.00, 1.00, 0.00, 48333.60, '2025-04-24 05:41:27', '2025-04-24', '0000-00-00', '', '', '', 'Kim', 'COD', '', '', '', 'Credit', '0000-00-00'),
(98, 1, 'kim tangpus', '', 444.00, 0.00, 0.00, 0.00, 444.00, '2025-04-24 05:54:18', '2025-04-24', '0000-00-00', '', '', '', 'Kim', 'COD', '', '', '', 'Credit', '0000-00-00'),
(99, 1, 'kim tangpus', '', 28359.00, 0.00, 1.00, 0.00, 31762.08, '2025-04-24 05:54:34', '2025-04-24', '0000-00-00', '', '', '', 'Kim', 'COD', '', '', '', 'Credit', '0000-00-00'),
(100, 1, 'kim tangpus', '', 1233.00, 0.00, 0.00, 0.00, 1233.00, '2025-04-24 05:54:48', '2025-04-24', '0000-00-00', '', '', '', 'Kim', 'COD', '', '', '', 'Credit', '0000-00-00'),
(101, 1, 'kim tangpus', '', 0.00, 0.00, 1.00, 0.00, 0.00, '2025-04-24 05:59:23', '2025-04-24', '0000-00-00', '', '', '', 'Kim', 'COD', '', '', '', 'Credit', '0000-00-00'),
(102, 1, 'kim tangpus', '', 1233.00, 0.00, 1.00, 0.00, 1380.96, '2025-04-24 05:59:28', '2025-04-24', '0000-00-00', '', '', '', 'Kim', 'COD', '', '', '', 'Credit', '0000-00-00'),
(103, 1, 'kim tangpus', '', 100.00, 0.00, 0.00, 0.00, 100.00, '2025-04-24 06:03:33', '2025-04-24', '0000-00-00', '', '', '', 'Kim', 'COD', '', '', '', 'Credit', '0000-00-00'),
(104, 2, 'Kiiiiim', 'asd', 1233.00, 0.00, 1.00, 0.00, 1380.96, '2025-04-24 06:06:56', '2025-04-24', '2025-04-25', '', 'tanauan', '0961', 'Kim', 'Debit', '625', 'kim', 'asdasd', 'Cash', '2025-04-25'),
(105, 2, 'Kiiiiim', '', 100.00, 0.00, 0.00, 0.00, 100.00, '2025-04-24 06:09:04', '2025-04-24', '0000-00-00', '', '', '', 'Kim', 'COD', '', '', '', 'Credit', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `invoiceitems`
--

CREATE TABLE `invoiceitems` (
  `id` int(11) NOT NULL,
  `invoice_id` int(11) DEFAULT NULL,
  `item_name` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `amount` varchar(100) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `site` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoiceitems`
--

INSERT INTO `invoiceitems` (`id`, `invoice_id`, `item_name`, `quantity`, `price`, `amount`, `remarks`, `site`) VALUES
(1, 6, 'Wireless Mouse', 23, 1234.82, '28400.859999999997', NULL, NULL),
(2, 7, 'Wireless Mouse', 23, 1234.82, '28400.859999999997', NULL, NULL),
(3, 8, 'Wireless Mouse', 23, 1234.82, '28400.859999999997', NULL, NULL),
(4, 9, 'Black Hoodie', 33, 1999.00, '65967', NULL, NULL),
(5, 10, 'Bluetooth Speaker', 33, 100.00, '3300', NULL, NULL),
(6, 10, 'Laptop Stand', 44, 1233.00, '54252', NULL, NULL),
(7, 10, 'USB-C Hub', 55, 333.00, '18315', NULL, NULL),
(8, 11, 'Bluetooth Speaker', 1, 100.00, '0', NULL, NULL),
(9, 13, 'Bluetooth Speaker', 99, 100.00, '0', NULL, NULL),
(10, 14, 'Wireless Mouse', 99, 1234.82, '122247.18', NULL, NULL),
(11, 15, 'Wireless Mouse', 25, 1234.82, '30870.5', NULL, NULL),
(12, 16, 'Bluetooth Speaker', 98, 100.00, '9800', NULL, NULL),
(13, NULL, 'Bluetooth Speaker', 23, 100.00, '2300', NULL, NULL),
(14, NULL, 'Denim Jacket', 23, 999.00, '22977', NULL, NULL),
(15, NULL, 'Bluetooth Speaker', 12, 100.00, '1200', NULL, NULL),
(16, NULL, 'Black Hoodie', 35, 1999.00, '69965', NULL, NULL),
(17, 19, 'Bluetooth Speaker', 88, 100.00, '8800', NULL, NULL),
(18, 20, 'Bluetooth Speaker', 4, 100.00, '400', NULL, NULL),
(19, 21, 'Wireless Mouse', 1, 1234.82, '1234.82', NULL, NULL),
(20, 22, 'Bluetooth Speaker', 78, 100.00, '7800', NULL, NULL),
(21, 26, 'Bluetooth Speaker', 78, 100.00, '7800', NULL, NULL),
(22, 27, 'Bluetooth Speaker', 78, 100.00, '7800', NULL, NULL),
(23, 28, 'Bluetooth Speaker', 78, 100.00, '7800', NULL, NULL),
(24, 29, 'Bluetooth Speaker', 78, 100.00, '7800', NULL, NULL),
(25, 30, 'Bluetooth Speaker', 78, 100.00, '7800', NULL, NULL),
(26, 31, 'Bluetooth Speaker', 78, 100.00, '7800', NULL, NULL),
(27, 32, 'Bluetooth Speaker', 78, 100.00, '7800', NULL, NULL),
(28, 33, 'Wireless Mouse', 60, 1234.82, '74089.2', NULL, NULL),
(29, 33, 'Classic White Tee', 99, 1000.00, '99000', NULL, NULL),
(30, 33, 'Denim Jacket', 12, 999.00, '11988', NULL, NULL),
(31, 34, 'Bluetooth Speaker', 1, 100.00, '100', NULL, NULL),
(32, 41, 'Laptop Stand', 89, 1233.00, '109737', NULL, NULL),
(33, 41, 'Bluetooth Speaker', 1, 100.00, '100', NULL, NULL),
(34, 41, 'Smartwatch', 1, 444.00, '444', NULL, NULL),
(35, 41, 'Puffer Vest', 1, 799.00, '799', NULL, NULL),
(36, 44, 'Wireless Mouse', 1, 1234.82, '1234.82', NULL, NULL),
(37, 44, 'Laptop Stand', 1, 1233.00, '1233', NULL, NULL),
(38, 44, 'Chino Shorts', 1, 1899.00, '1899', NULL, NULL),
(39, 46, 'Bluetooth Speaker', 1, 100.00, '100', NULL, NULL),
(40, 47, 'Wireless Mouse', 1, 1234.82, '1234.82', NULL, NULL),
(41, 48, 'Laptop Stand', 1, 1233.00, '1233', NULL, NULL),
(42, 49, 'Laptop Stand', 1, 1233.00, '1233', NULL, NULL),
(43, 50, 'Bluetooth Speaker', 1, 100.00, '100', NULL, NULL),
(44, 51, 'Bluetooth Speaker', 1, 100.00, '100', NULL, NULL),
(45, 52, 'Bluetooth Speaker', 1, 100.00, '100', NULL, NULL),
(46, 53, 'Bluetooth Speaker', 1, 100.00, '100', NULL, NULL),
(47, 54, 'Denim Jacket', 1, 999.00, '999', NULL, NULL),
(48, 58, 'Laptop Stand', 35, 1233.00, '43155', NULL, NULL),
(49, 59, 'Bluetooth Speaker', 1, 100.00, '100', NULL, NULL),
(50, 60, 'Bluetooth Speaker', 1, 100.00, '100', NULL, NULL),
(51, 61, 'Bluetooth Speaker', 1, 100.00, '100', NULL, NULL),
(52, 62, 'Bluetooth Speaker', 1, 100.00, '100', NULL, NULL),
(53, 64, 'Bluetooth Speaker', 1, 100.00, '100', NULL, NULL),
(54, 65, 'Laptop Stand', 1, 1233.00, '1233', NULL, NULL),
(55, 67, 'Laptop Stand', 1, 1233.00, '1233', 'asdasd', 'HO-MAIN'),
(56, 68, 'Bluetooth Speaker', 23, 100.00, '2300', 'addddd', 'HO-MAIN'),
(57, 70, 'Bluetooth Speaker', 1, 100.00, '100', '', 'HO-MAIN'),
(58, 71, 'Bluetooth Speaker', 23, 100.00, '2300', 'asdasdwdqwe', 'HO-MAIN'),
(59, 72, 'Laptop Stand', 1, 1233.00, '1233', '', 'HO-MAIN'),
(60, 73, 'Laptop Stand', 1, 1233.00, '1233', '', 'HO-MAIN'),
(61, 76, 'Bluetooth Speaker', 44, 100.00, '4400', '', 'HO-MAIN'),
(62, 81, 'USB-C Hub', 1, 333.00, '333', '', 'HO-MAIN'),
(63, 82, 'Bluetooth Speaker', 1, 100.00, '100', '123', 'HO-MAIN'),
(64, 82, 'USB-C Hub', 1, 333.00, '333', '332', 'HO-MAIN'),
(65, 82, 'Denim Jacket', 1, 999.00, '999', '123', 'HO-MAIN'),
(66, 82, 'Chino Shorts', 1, 1899.00, '1899', 'zxczv', 'HO-MAIN'),
(67, 83, 'Bluetooth Speaker', 55, 100.00, '5500', '2ed', 'HO-MAIN'),
(68, 83, 'Black Hoodie', 55, 1999.00, '109945', 'asdasd', 'HO-MAIN'),
(69, 84, 'Bluetooth Speaker', 33, 100.00, '3300', '', 'HO-MAIN'),
(70, 84, 'Puffer Vest', 77, 799.00, '61523', '', 'HO-MAIN'),
(71, 85, 'Bluetooth Speaker', 31, 100.00, '3100', '', 'HO-MAIN'),
(72, 86, 'Laptop Stand', 6, 1233.00, '7398', '', 'HO-MAIN'),
(73, 87, 'Puffer Vest', 90, 799.00, '71910', '', 'HO-MAIN'),
(74, 88, 'Laptop Stand', 80, 1233.00, '98640', '', 'HO-MAIN'),
(75, 89, 'Laptop Stand', 90, 1233.00, '110970', '', 'HO-MAIN'),
(76, 90, 'Laptop Stand', 1, 1233.00, '1233', '', 'HO-MAIN'),
(77, 91, 'Laptop Stand', 90, 1233.00, '110970', '', 'HO-MAIN'),
(78, 92, 'Laptop Stand', 1, 1233.00, '1233', '', 'HO-MAIN'),
(79, 93, 'Laptop Stand', 1, 1233.00, '1233', '', 'HO-MAIN'),
(80, 94, 'Laptop Stand', 1, 1233.00, '1233', '', 'HO-MAIN'),
(81, 95, 'Laptop Stand', 1, 1233.00, '1233', '', 'HO-MAIN'),
(82, 96, 'Bluetooth Speaker', 12, 100.00, '1200', 'asfgsdfgfdgjgkjl', 'HO-MAIN'),
(83, 97, 'Laptop Stand', 35, 1233.00, '43155', '', 'HO-MAIN'),
(84, 98, 'Smartwatch', 1, 444.00, '444', '', 'HO-MAIN'),
(85, 99, 'Laptop Stand', 23, 1233.00, '28359', '', 'HO-MAIN'),
(86, 100, 'Laptop Stand', 1, 1233.00, '1233', '', 'HO-MAIN'),
(87, 102, 'Laptop Stand', 1, 1233.00, '1233', '', 'HO-MAIN'),
(88, 103, 'Bluetooth Speaker', 1, 100.00, '100', '', 'HO-MAIN'),
(89, 104, 'Laptop Stand', 1, 1233.00, '1233', '2gds ', 'HO-MAIN'),
(90, 105, 'Bluetooth Speaker', 1, 100.00, '100', '', 'HO-MAIN');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `item_name` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `item_type` varchar(50) DEFAULT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_name` varchar(255) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `site` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `item_name`, `quantity`, `price`, `item_type`, `order_date`, `user_name`, `remarks`, `site`) VALUES
(12, 2, 'Bluetooth Speaker', 1, 100.00, 'product', '2025-04-08 03:32:15', 'Kiiiiim', NULL, NULL),
(13, 1, 'Laptop Stand', 1, 1233.00, 'product', '2025-04-08 03:32:27', 'kim tangpus', NULL, NULL),
(14, 1, 'Bluetooth Speaker', 5, 100.00, 'product', '2025-04-16 06:24:32', 'kim tangpus', NULL, NULL),
(15, 1, 'Bluetooth Speaker', 1, 100.00, 'product', '2025-04-16 06:26:16', 'kim tangpus', NULL, NULL),
(16, 1, 'Laptop Stand', 1, 1233.00, 'product', '2025-04-16 06:26:16', 'kim tangpus', NULL, NULL),
(17, 1, 'USB-C Hub', 1, 333.00, 'product', '2025-04-16 06:26:16', 'kim tangpus', NULL, NULL),
(18, 1, 'Wireless Mouse', 1, 1234.82, 'product', '2025-04-16 06:26:16', 'kim tangpus', NULL, NULL),
(19, 1, 'Smartwatch', 1, 444.00, 'product', '2025-04-16 06:26:16', 'kim tangpus', NULL, NULL),
(20, 1, 'Bluetooth Speaker', 1, 100.00, 'product', '2025-04-16 06:35:27', 'kim tangpus', NULL, NULL),
(21, 1, 'Wireless Mouse', 13, 1234.82, 'product', '2025-04-16 06:35:27', 'kim tangpus', NULL, NULL),
(22, 1, 'Bluetooth Speaker', 1, 100.00, 'product', '2025-04-16 06:37:46', 'kim tangpus', NULL, NULL),
(23, 1, 'Bluetooth Speaker', 1, 100.00, 'product', '2025-04-16 06:40:04', 'kim tangpus', NULL, NULL),
(24, 1, 'Bluetooth Speaker', 1, 100.00, 'product', '2025-04-16 06:42:26', 'kim tangpus', NULL, NULL),
(25, 1, 'Laptop Stand', 99, 1233.00, 'product', '2025-04-16 06:42:26', 'kim tangpus', NULL, NULL),
(26, 1, 'Black Hoodie', 99, 1999.00, 'clothing', '2025-04-16 06:42:26', 'kim tangpus', NULL, NULL),
(27, 1, 'Bluetooth Speaker', 1, 100.00, 'product', '2025-04-16 06:43:03', 'kim tangpus', NULL, NULL),
(28, 1, 'Laptop Stand', 99, 1233.00, 'product', '2025-04-16 06:43:03', 'kim tangpus', NULL, NULL),
(29, 1, 'Black Hoodie', 99, 1999.00, 'clothing', '2025-04-16 06:43:03', 'kim tangpus', NULL, NULL),
(30, 1, 'Laptop Stand', 23, 1233.00, 'product', '2025-04-16 06:43:39', 'kim tangpus', NULL, NULL),
(31, 1, 'Bluetooth Speaker', 12, 100.00, 'product', '2025-04-16 06:44:13', 'kim tangpus', NULL, NULL),
(32, 1, 'Black Hoodie', 33, 1999.00, 'clothing', '2025-04-16 06:44:13', 'kim tangpus', NULL, NULL),
(33, 1, 'Wireless Mouse', 23, 1234.82, 'product', '2025-04-16 06:49:02', 'kim tangpus', NULL, NULL),
(34, 1, 'Wireless Mouse', 23, 1234.82, NULL, '2025-04-16 06:49:19', 'kim tangpus', NULL, NULL),
(35, 1, 'Wireless Mouse', 23, 1234.82, NULL, '2025-04-16 06:49:34', 'kim tangpus', NULL, NULL),
(36, 1, 'Black Hoodie', 33, 1999.00, 'clothing', '2025-04-16 06:54:26', 'kim tangpus', NULL, NULL),
(37, 1, 'Bluetooth Speaker', 33, 100.00, 'product', '2025-04-16 06:55:11', 'kim tangpus', NULL, NULL),
(38, 1, 'Laptop Stand', 44, 1233.00, 'product', '2025-04-16 06:55:11', 'kim tangpus', NULL, NULL),
(39, 1, 'USB-C Hub', 55, 333.00, 'product', '2025-04-16 06:55:11', 'kim tangpus', NULL, NULL),
(40, 1, 'Bluetooth Speaker', 1, 100.00, 'product', '2025-04-16 07:25:26', 'kim tangpus', NULL, NULL),
(41, 1, 'Bluetooth Speaker', 99, 100.00, 'product', '2025-04-16 07:27:27', 'kim tangpus', NULL, NULL),
(42, 1, 'Wireless Mouse', 99, 1234.82, 'product', '2025-04-16 07:28:38', 'kim tangpus', NULL, NULL),
(43, 1, 'Wireless Mouse', 25, 1234.82, 'product', '2025-04-16 07:29:41', 'kim tangpus', NULL, NULL),
(44, 1, 'Bluetooth Speaker', 98, 100.00, 'product', '2025-04-16 07:38:46', 'kim tangpus', NULL, NULL),
(45, 1, 'Bluetooth Speaker', 23, 100.00, 'product', '2025-04-16 07:41:51', 'kim tangpus', NULL, NULL),
(46, 1, 'Denim Jacket', 23, 999.00, 'clothing', '2025-04-16 07:41:51', 'kim tangpus', NULL, NULL),
(47, 1, 'Bluetooth Speaker', 12, 100.00, 'product', '2025-04-16 07:45:36', 'kim tangpus', NULL, NULL),
(48, 1, 'Black Hoodie', 35, 1999.00, 'clothing', '2025-04-16 07:45:36', 'kim tangpus', NULL, NULL),
(49, 1, 'Bluetooth Speaker', 88, 100.00, 'product', '2025-04-16 07:50:25', 'kim tangpus', NULL, NULL),
(50, 1, 'Bluetooth Speaker', 4, 100.00, 'product', '2025-04-16 08:03:12', 'kim tangpus', NULL, NULL),
(51, 1, 'Wireless Mouse', 1, 1234.82, 'product', '2025-04-22 04:24:57', 'kim tangpus', NULL, NULL),
(52, 1, 'Bluetooth Speaker', 78, 100.00, 'product', '2025-04-22 04:30:33', 'kim tangpus', NULL, NULL),
(53, 1, 'Bluetooth Speaker', 78, 100.00, 'product', '2025-04-22 04:36:52', 'kim tangpus', NULL, NULL),
(54, 1, 'Bluetooth Speaker', 78, 100.00, NULL, '2025-04-22 04:39:53', 'kim tangpus', NULL, NULL),
(55, 1, 'Bluetooth Speaker', 78, 100.00, NULL, '2025-04-22 04:40:25', 'kim tangpus', NULL, NULL),
(56, 1, 'Bluetooth Speaker', 78, 100.00, NULL, '2025-04-22 04:40:27', 'kim tangpus', NULL, NULL),
(57, 1, 'Bluetooth Speaker', 78, 100.00, NULL, '2025-04-22 04:43:00', 'kim tangpus', NULL, NULL),
(58, 1, 'Bluetooth Speaker', 78, 100.00, NULL, '2025-04-22 04:44:02', 'kim tangpus', NULL, NULL),
(59, 1, 'Bluetooth Speaker', 78, 100.00, NULL, '2025-04-22 04:47:44', 'kim tangpus', NULL, NULL),
(60, 1, 'Wireless Mouse', 60, 1234.82, 'product', '2025-04-22 04:49:30', 'kim tangpus', NULL, NULL),
(61, 1, 'Classic White Tee', 99, 1000.00, 'clothing', '2025-04-22 04:49:30', 'kim tangpus', NULL, NULL),
(62, 1, 'Denim Jacket', 12, 999.00, 'clothing', '2025-04-22 04:49:30', 'kim tangpus', NULL, NULL),
(63, 1, 'Bluetooth Speaker', 1, 100.00, 'product', '2025-04-22 05:08:45', 'kim tangpus', NULL, NULL),
(64, 1, 'Laptop Stand', 89, 1233.00, 'product', '2025-04-22 08:42:33', 'kim tangpus', NULL, NULL),
(65, 1, 'Bluetooth Speaker', 1, 100.00, 'product', '2025-04-22 08:42:33', 'kim tangpus', NULL, NULL),
(66, 1, 'Smartwatch', 1, 444.00, 'product', '2025-04-22 08:42:33', 'kim tangpus', NULL, NULL),
(67, 1, 'Puffer Vest', 1, 799.00, 'clothing', '2025-04-22 08:42:33', 'kim tangpus', NULL, NULL),
(68, 1, 'Wireless Mouse', 1, 1234.82, 'product', '2025-04-22 08:48:27', 'kim tangpus', NULL, NULL),
(69, 1, 'Laptop Stand', 1, 1233.00, 'product', '2025-04-22 08:48:27', 'kim tangpus', NULL, NULL),
(70, 1, 'Chino Shorts', 1, 1899.00, 'clothing', '2025-04-22 08:48:27', 'kim tangpus', NULL, NULL),
(71, 1, 'Bluetooth Speaker', 1, 100.00, 'product', '2025-04-22 08:50:24', 'kim tangpus', NULL, NULL),
(72, 1, 'Wireless Mouse', 1, 1234.82, 'product', '2025-04-22 09:11:50', 'kim tangpus', NULL, NULL),
(73, 1, 'Laptop Stand', 1, 1233.00, 'product', '2025-04-22 09:15:25', 'kim tangpus', NULL, NULL),
(74, 1, 'Laptop Stand', 1, 1233.00, 'product', '2025-04-23 04:26:23', 'kim tangpus', NULL, NULL),
(75, 1, 'Bluetooth Speaker', 1, 100.00, 'product', '2025-04-23 04:28:28', 'kim tangpus', NULL, NULL),
(76, 1, 'Bluetooth Speaker', 1, 100.00, 'product', '2025-04-23 04:28:42', 'kim tangpus', NULL, NULL),
(77, 2, 'Bluetooth Speaker', 1, 100.00, 'product', '2025-04-23 04:30:12', 'Kiiiiim', NULL, NULL),
(78, 1, 'Bluetooth Speaker', 1, 100.00, 'product', '2025-04-23 05:00:58', NULL, NULL, NULL),
(79, 1, 'Denim Jacket', 1, 999.00, 'clothing', '2025-04-23 05:14:35', NULL, NULL, NULL),
(80, 1, 'Laptop Stand', 35, 1233.00, 'product', '2025-04-23 05:21:25', 'kim tangpus', NULL, NULL),
(81, 1, 'Bluetooth Speaker', 1, 100.00, 'product', '2025-04-23 05:23:40', 'kim tangpus', NULL, NULL),
(82, 1, 'Bluetooth Speaker', 1, 100.00, 'product', '2025-04-23 05:24:13', 'kim tangpus', NULL, NULL),
(83, 1, 'Bluetooth Speaker', 1, 100.00, 'product', '2025-04-23 05:24:36', 'kim tangpus', NULL, NULL),
(84, 1, 'Bluetooth Speaker', 1, 100.00, 'product', '2025-04-23 06:27:50', 'kim tangpus', NULL, NULL),
(85, 1, 'Bluetooth Speaker', 1, 100.00, 'product', '2025-04-23 06:29:31', 'kim tangpus', NULL, NULL),
(86, 1, 'Laptop Stand', 1, 1233.00, 'product', '2025-04-23 06:30:39', 'kim tangpus', NULL, NULL),
(87, 1, 'Laptop Stand', 1, 1233.00, 'product', '2025-04-23 16:34:37', 'kim tangpus', 'asdasd', 'HO-MAIN'),
(88, 1, 'Bluetooth Speaker', 23, 100.00, 'product', '2025-04-23 16:42:53', 'kim tangpus', 'addddd', 'HO-MAIN'),
(89, 1, 'Bluetooth Speaker', 1, 100.00, 'product', '2025-04-23 16:45:11', 'kim tangpus', '', 'HO-MAIN'),
(90, 1, 'Bluetooth Speaker', 23, 100.00, 'product', '2025-04-23 16:45:43', 'kim tangpus', 'asdasdwdqwe', 'HO-MAIN'),
(91, 1, 'Laptop Stand', 1, 1233.00, 'product', '2025-04-23 16:46:05', 'kim tangpus', '', 'HO-MAIN'),
(92, 1, 'Laptop Stand', 1, 1233.00, 'product', '2025-04-24 04:51:14', 'kim tangpus', '', 'HO-MAIN'),
(93, 1, 'Bluetooth Speaker', 44, 100.00, 'product', '2025-04-24 04:54:06', 'kim tangpus', '', 'HO-MAIN'),
(94, 1, 'USB-C Hub', 1, 333.00, 'product', '2025-04-24 04:59:31', 'kim tangpus', '', 'HO-MAIN'),
(95, 1, 'Bluetooth Speaker', 1, 100.00, 'product', '2025-04-24 05:09:20', 'kim tangpus', '123', 'HO-MAIN'),
(96, 1, 'USB-C Hub', 1, 333.00, 'product', '2025-04-24 05:09:20', 'kim tangpus', '332', 'HO-MAIN'),
(97, 1, 'Denim Jacket', 1, 999.00, 'clothing', '2025-04-24 05:09:20', 'kim tangpus', '123', 'HO-MAIN'),
(98, 1, 'Chino Shorts', 1, 1899.00, 'clothing', '2025-04-24 05:09:20', 'kim tangpus', 'zxczv', 'HO-MAIN'),
(99, 1, 'Bluetooth Speaker', 55, 100.00, 'product', '2025-04-24 05:13:10', 'kim tangpus', '2ed', 'HO-MAIN'),
(100, 1, 'Black Hoodie', 55, 1999.00, 'clothing', '2025-04-24 05:13:10', 'kim tangpus', 'asdasd', 'HO-MAIN'),
(101, 1, 'Bluetooth Speaker', 33, 100.00, 'product', '2025-04-24 05:16:21', 'kim tangpus', '', 'HO-MAIN'),
(102, 1, 'Puffer Vest', 77, 799.00, 'clothing', '2025-04-24 05:16:21', 'kim tangpus', '', 'HO-MAIN'),
(103, 1, 'Bluetooth Speaker', 31, 100.00, 'product', '2025-04-24 05:17:08', 'kim tangpus', '', 'HO-MAIN'),
(104, 1, 'Laptop Stand', 6, 1233.00, 'product', '2025-04-24 05:17:16', 'kim tangpus', '', 'HO-MAIN'),
(105, 1, 'Puffer Vest', 90, 799.00, 'clothing', '2025-04-24 05:19:22', 'kim tangpus', '', 'HO-MAIN'),
(106, 1, 'Laptop Stand', 80, 1233.00, 'product', '2025-04-24 05:20:27', 'kim tangpus', '', 'HO-MAIN'),
(107, 1, 'Laptop Stand', 90, 1233.00, 'product', '2025-04-24 05:22:06', 'kim tangpus', '', 'HO-MAIN'),
(108, 1, 'Laptop Stand', 1, 1233.00, 'product', '2025-04-24 05:22:23', 'kim tangpus', '', 'HO-MAIN'),
(109, 1, 'Laptop Stand', 90, 1233.00, 'product', '2025-04-24 05:22:36', 'kim tangpus', '', 'HO-MAIN'),
(110, 1, 'Laptop Stand', 1, 1233.00, 'product', '2025-04-24 05:22:48', 'kim tangpus', '', 'HO-MAIN'),
(111, 1, 'Laptop Stand', 1, 1233.00, 'product', '2025-04-24 05:23:06', 'kim tangpus', '', 'HO-MAIN'),
(112, 1, 'Laptop Stand', 1, 1233.00, 'product', '2025-04-24 05:23:16', 'kim tangpus', '', 'HO-MAIN'),
(113, 1, 'Laptop Stand', 1, 1233.00, 'product', '2025-04-24 05:23:40', 'kim tangpus', '', 'HO-MAIN'),
(114, 1, 'Bluetooth Speaker', 12, 100.00, 'product', '2025-04-24 05:28:37', 'kim tangpus', 'asfgsdfgfdgjgkjl', 'HO-MAIN'),
(115, 1, 'Laptop Stand', 35, 1233.00, 'product', '2025-04-24 05:41:27', 'kim tangpus', '', 'HO-MAIN'),
(116, 1, 'Smartwatch', 1, 444.00, 'product', '2025-04-24 05:54:18', 'kim tangpus', '', 'HO-MAIN'),
(117, 1, 'Laptop Stand', 23, 1233.00, 'product', '2025-04-24 05:54:34', 'kim tangpus', '', 'HO-MAIN'),
(118, 1, 'Laptop Stand', 1, 1233.00, 'product', '2025-04-24 05:54:48', 'kim tangpus', '', 'HO-MAIN'),
(119, 1, 'Laptop Stand', 1, 1233.00, 'product', '2025-04-24 05:59:28', 'kim tangpus', '', 'HO-MAIN'),
(120, 1, 'Bluetooth Speaker', 1, 100.00, 'product', '2025-04-24 06:03:33', 'kim tangpus', '', 'HO-MAIN'),
(121, 2, 'Laptop Stand', 1, 1233.00, 'product', '2025-04-24 06:06:56', 'Kiiiiim', '2gds ', 'HO-MAIN'),
(122, 2, 'Bluetooth Speaker', 1, 100.00, 'product', '2025-04-24 06:09:04', 'Kiiiiim', '', 'HO-MAIN');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `item_name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `item_name`, `description`, `image`, `price`) VALUES
(1, 'Wireless Mouse', 'A sleek and ergonomic wireless mouse with long battery life.', 'mouse.jpg', 1234.82),
(2, 'Bluetooth Speaker', 'Portable Bluetooth speaker with deep bass and water resistance.', 'speaker.jpg', 100.00),
(3, 'Laptop Stand', 'Adjustable aluminum laptop stand for better posture and cooling.', 'laptopstand.jpg', 1233.00),
(4, 'USB-C Hub', 'Multiport USB-C hub with HDMI, USB 3.0, and SD card support.', 'usbhub.jpg', 333.00),
(5, 'Noise-Canceling Headphones', 'Over-ear headphones with active noise cancellation and long battery life.', 'headphones.jpg', 411.00),
(6, 'Mechanical Keyboard', 'RGB backlit mechanical keyboard with customizable keys.', 'keyboard.jpg', 22.00),
(7, 'Smartwatch', 'Fitness-focused smartwatch with heart rate monitor and GPS.', 'watch.jpg', 444.00),
(8, 'Webcam', 'HD webcam with built-in microphone and privacy cover.', 'webcam.jpg', 122.00);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `tin` varchar(20) DEFAULT NULL,
  `business_style` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `name`, `tin`, `business_style`) VALUES
(1, 'kimzap', '$2y$10$BV0NI7lgvAv7x5I8q4WQBeC6IkxQeU.1X8Nhvat3aS/wd73y3w6n.', 'kimzaptangpus@gmail.com', 'kim tangpus', '1234', 'Auto Shop'),
(2, 'timmy', '$2y$10$O/2h1F2.DbjP4R/Ae1kQPeEIrOGZXspCdlrwr8EDEIU38KsKzZh..', 'timm@gmail.com', 'Kiiiiim', '5678', 'Store');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `clothing_id` (`clothing_id`);

--
-- Indexes for table `clothing`
--
ALTER TABLE `clothing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoiceitems`
--
ALTER TABLE `invoiceitems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT for table `clothing`
--
ALTER TABLE `clothing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `invoiceitems`
--
ALTER TABLE `invoiceitems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_3` FOREIGN KEY (`clothing_id`) REFERENCES `clothing` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
