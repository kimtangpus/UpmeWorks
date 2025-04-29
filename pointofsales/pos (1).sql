-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 29, 2025 at 12:44 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

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
(7, 'Kim Tangpus', 'Kim Tangpus', '31232', '480 zone 7 Pantay Bata, Tanauan City', '09615491117', 'kimzaptangpus@gmail.com', '90384756903824576', 'Individual', 0),
(9, 'Trixia Pineda', 'Kim Tangpus', 'Owner', 'Pulilan Bulacan', '09289395133', 'tacp@gmail.com', '11234125', 'Individual', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image_url`) VALUES
(1, 'Extreme Gestation (P) 50KG', 1700.00, 'images/whitetee.jpg'),
(2, 'Extreme Hog Finisher (P) 50KG', 1700.00, 'images/whitetee.jpg'),
(3, 'Extreme Hog Grower (P) 50KG', 1700.00, 'images/whitetee.jpg'),
(4, 'Extreme Hog Lactation (P) 50KG', 1700.00, 'https://via.placeholder.com/80'),
(5, 'Extreme Hog Starter (P) 50KG', 1700.00, 'https://via.placeholder.com/80'),
(6, 'Fiesta Brood Sow (M) 50KG', 1700.00, 'https://via.placeholder.com/80'),
(7, 'Fiesta Brood Sow (P) 50KG', 1700.00, 'https://via.placeholder.com/80'),
(8, 'Fiesta Hog Finisher (P) 50KG', 1700.00, 'https://via.placeholder.com/80'),
(9, 'Fiesta Hog Grower (P) 50KG', 1700.00, 'https://via.placeholder.com/80'),
(10, 'Fiesta Hog Lactation (M) 50KG', 1700.00, 'https://via.placeholder.com/80'),
(11, 'Fiesta Lactation (P) 50KG', 1700.00, 'https://via.placeholder.com/80'),
(12, 'Premium Customized Quail Layer Crumble', 1700.00, 'https://via.placeholder.com/80'),
(13, 'Premium Fiesta HF (M)', 1700.00, 'https://via.placeholder.com/80'),
(14, 'Premium Fiesta HG (M)', 1700.00, 'https://via.placeholder.com/80'),
(15, 'Urea Swire Red', 1700.00, 'https://via.placeholder.com/80'),
(16, 'Vantage Hog Starter (P) 50KG', 1700.00, 'https://via.placeholder.com/80'),
(17, 'Vantage Hog Grower (P) 50KG', 1700.00, 'https://via.placeholder.com/80'),
(18, 'Vantage Hog Finisher (P) 50KG', 1700.00, 'https://via.placeholder.com/80'),
(19, 'Custom Layer Feed 50KG', 1700.00, 'https://via.placeholder.com/80'),
(20, 'Poultry Booster Mix (P) 25KG', 1700.00, 'https://via.placeholder.com/80'),
(21, 'zap', 0.00, 'images/whitetee.jpg'),
(22, 'Kiiiiim', 123123.00, 'images/whitetee.jpg'),
(23, 'asdasd', 123.00, 'images/whitetee.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `name`) VALUES
(1, 'kimzap', '$2y$10$Wdf4ULWTUJI2O5Nqf1BaLeYG4G5yrUjqNc0mrnWQbezu9f9IsMixO', 'kimzaptangpus@gmail.com', 'kim tangpus');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
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
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
