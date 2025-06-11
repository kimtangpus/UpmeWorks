-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2025 at 10:29 AM
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
-- Database: `products`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `rank` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `total_buyers` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `rating_score` varchar(20) NOT NULL,
  `rating_percentage` int(11) NOT NULL,
  `status` enum('Active','Archived') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `rank`, `name`, `image`, `total_buyers`, `price`, `stock`, `rating_score`, `rating_percentage`, `status`) VALUES
(1, 1, 'Sweater', '', 12990, 1234.82, 231, 'Perfect', 10, 'Archived'),
(2, 2, 'Givenchy Sweater', '', 12990, 1234.82, 0, 'Very Good', 80, 'Active'),
(3, 3, 'Givenchy Sweater', '', 12990, 1234.82, 432, 'Good', 60, 'Active'),
(4, 11, 'Givenchy Sweater', '', 450, 399.99, 5, '4.8', 96, 'Active'),
(5, 12, 'Givenchy Sweater', '', 730, 349.99, 0, '4.6', 92, 'Active'),
(6, 13, 'Givenchy Sweater', '', 1500, 379.99, 23, '4.7', 94, 'Active'),
(7, 14, 'Givenchy Sweater', '', 1200, 299.99, 7, '4.3', 86, 'Active'),
(8, 15, 'Givenchy Sweater', '', 290, 449.99, 2, '4.5', 90, 'Active'),
(9, 16, 'Givenchy Sweater', '', 350, 424.99, 9, '4.4', 88, 'Active'),
(10, 17, 'Givenchy Sweater', '', 600, 319.99, 0, '4.9', 20, 'Active'),
(11, 18, 'Givenchy Sweater', '', 980, 389.99, 20, '4.6', 61, 'Active'),
(12, 19, 'Givenchy Sweater', '', 410, 399.99, 3, '4.2', 100, 'Active'),
(13, 20, 'kim', '', 170, 459.99, 0, '4.8', 96, 'Active'),
(16, 0, '', 'uploads/698d80f9b048a84d27dd4ff343c72a12_1741166308.jpg', 0, 0.00, 0, '', 0, 'Active'),
(17, 0, '', 'uploads/698d80f9b048a84d27dd4ff343c72a12_1741166346.jpg', 0, 0.00, 0, '', 0, ''),
(18, 0, 'asd', 'uploads/698d80f9b048a84d27dd4ff343c72a12.jpg', 3123, 232.00, 323, '', 23123, 'Archived'),
(19, 0, 'adasd', 'uploads/698d80f9b048a84d27dd4ff343c72a12_1741166863.jpg', 888888, 2323.00, 333, '', 10, 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
