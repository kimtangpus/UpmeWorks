-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2025 at 10:04 AM
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
  `contact_no` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `user_id`, `user_name`, `remarks`, `subtotal`, `discount`, `vat`, `withholding`, `grand_total`, `created_at`, `invoice_date`, `due_date`, `reference_no`, `address`, `contact_no`) VALUES
(1, 1, NULL, '', 12100.00, 0.00, 0.00, 0.00, 12100.00, '2025-04-16 06:37:46', NULL, NULL, NULL, NULL, NULL),
(2, 1, NULL, '', 400.00, 0.00, 0.00, 0.00, 400.00, '2025-04-16 06:40:04', NULL, NULL, NULL, NULL, NULL),
(3, 1, NULL, '', 329868.00, 0.00, 1.00, 0.00, 369452.16, '2025-04-16 06:42:26', NULL, NULL, NULL, NULL, NULL),
(4, 1, NULL, '', 28400.86, 0.00, 0.00, 0.00, 28400.86, '2025-04-16 06:47:15', NULL, NULL, NULL, NULL, NULL),
(5, 1, NULL, '', 28400.86, 0.00, 0.00, 0.00, 28400.86, '2025-04-16 06:47:55', NULL, NULL, NULL, NULL, NULL),
(6, 1, NULL, '', 28400.86, 0.00, 0.00, 0.00, 28400.86, '2025-04-16 06:49:02', NULL, NULL, NULL, NULL, NULL),
(7, 1, NULL, 'asdasdasdasdasdasdasdasd', 28400.86, 0.00, 1.00, 0.00, 31808.96, '2025-04-16 06:49:19', NULL, NULL, NULL, NULL, NULL),
(8, 1, NULL, 'asdasdasdasdasdasdasdasdasdwwwww', 28400.86, 0.00, 1.00, 1.00, 31240.95, '2025-04-16 06:49:34', NULL, NULL, NULL, NULL, NULL),
(9, 1, NULL, 'pabile', 65967.00, 500.00, 1.00, 1.00, 72063.70, '2025-04-16 06:54:26', NULL, NULL, NULL, NULL, NULL),
(10, 1, NULL, 'pabile nga ule', 75867.00, 500.00, 1.00, 1.00, 82953.70, '2025-04-16 06:55:11', NULL, NULL, NULL, NULL, NULL),
(11, 1, NULL, 'asdasd', 100.00, 50.00, 1.00, 1.00, 60.00, '2025-04-16 07:25:26', NULL, NULL, NULL, NULL, NULL),
(12, 1, NULL, 'kim', 9900.00, 100.00, 1.00, 1.00, 10790.00, '2025-04-16 07:27:14', NULL, NULL, NULL, NULL, NULL),
(13, 1, NULL, 'kim', 9900.00, 100.00, 1.00, 1.00, 10790.00, '2025-04-16 07:27:27', NULL, NULL, NULL, NULL, NULL),
(14, 1, NULL, '2323', 122247.18, 299.00, 1.00, 1.00, 134172.90, '2025-04-16 07:28:38', NULL, NULL, NULL, NULL, NULL),
(15, 1, NULL, '2323333', 30870.50, 800.00, 1.00, 1.00, 33157.55, '2025-04-16 07:29:41', NULL, NULL, NULL, NULL, NULL),
(16, 1, NULL, 'pabile lods', 9800.00, 99.00, 1.00, 1.00, 10681.00, '2025-04-16 07:38:46', NULL, NULL, NULL, NULL, NULL),
(17, 1, 'kim', 'asdasd', 25277.00, 1000.00, 1.00, 1.00, 26804.70, '2025-04-16 07:41:51', '2025-04-16', '0000-00-00', '2', 'tanauan', NULL),
(18, 1, 'kim', 'wala naman', 71165.00, 12000.00, 1.00, 1.00, 66281.50, '2025-04-16 07:45:36', '2025-04-16', '2025-04-24', '1', 'tanauan city', NULL),
(19, 1, 'asd', 'asdasdasdad', 8800.00, 33.00, 1.00, 1.00, 9647.00, '2025-04-16 07:50:25', '2025-04-16', '2025-04-17', '25', 'tatataa', NULL),
(20, 1, 'kim', 'asdasdas', 400.00, 23.00, 1.00, 1.00, 417.00, '2025-04-16 08:03:12', '2025-04-16', '2025-04-17', '222', 'tanauan', '09615491117');

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
  `amount` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoiceitems`
--

INSERT INTO `invoiceitems` (`id`, `invoice_id`, `item_name`, `quantity`, `price`, `amount`) VALUES
(1, 6, 'Wireless Mouse', 23, 1234.82, '28400.859999999997'),
(2, 7, 'Wireless Mouse', 23, 1234.82, '28400.859999999997'),
(3, 8, 'Wireless Mouse', 23, 1234.82, '28400.859999999997'),
(4, 9, 'Black Hoodie', 33, 1999.00, '65967'),
(5, 10, 'Bluetooth Speaker', 33, 100.00, '3300'),
(6, 10, 'Laptop Stand', 44, 1233.00, '54252'),
(7, 10, 'USB-C Hub', 55, 333.00, '18315'),
(8, 11, 'Bluetooth Speaker', 1, 100.00, '0'),
(9, 13, 'Bluetooth Speaker', 99, 100.00, '0'),
(10, 14, 'Wireless Mouse', 99, 1234.82, '122247.18'),
(11, 15, 'Wireless Mouse', 25, 1234.82, '30870.5'),
(12, 16, 'Bluetooth Speaker', 98, 100.00, '9800'),
(13, NULL, 'Bluetooth Speaker', 23, 100.00, '2300'),
(14, NULL, 'Denim Jacket', 23, 999.00, '22977'),
(15, NULL, 'Bluetooth Speaker', 12, 100.00, '1200'),
(16, NULL, 'Black Hoodie', 35, 1999.00, '69965'),
(17, 19, 'Bluetooth Speaker', 88, 100.00, '8800'),
(18, 20, 'Bluetooth Speaker', 4, 100.00, '400');

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
  `user_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `item_name`, `quantity`, `price`, `item_type`, `order_date`, `user_name`) VALUES
(12, 2, 'Bluetooth Speaker', 1, 100.00, 'product', '2025-04-08 03:32:15', 'Kiiiiim'),
(13, 1, 'Laptop Stand', 1, 1233.00, 'product', '2025-04-08 03:32:27', 'kim tangpus'),
(14, 1, 'Bluetooth Speaker', 5, 100.00, 'product', '2025-04-16 06:24:32', 'kim tangpus'),
(15, 1, 'Bluetooth Speaker', 1, 100.00, 'product', '2025-04-16 06:26:16', 'kim tangpus'),
(16, 1, 'Laptop Stand', 1, 1233.00, 'product', '2025-04-16 06:26:16', 'kim tangpus'),
(17, 1, 'USB-C Hub', 1, 333.00, 'product', '2025-04-16 06:26:16', 'kim tangpus'),
(18, 1, 'Wireless Mouse', 1, 1234.82, 'product', '2025-04-16 06:26:16', 'kim tangpus'),
(19, 1, 'Smartwatch', 1, 444.00, 'product', '2025-04-16 06:26:16', 'kim tangpus'),
(20, 1, 'Bluetooth Speaker', 1, 100.00, 'product', '2025-04-16 06:35:27', 'kim tangpus'),
(21, 1, 'Wireless Mouse', 13, 1234.82, 'product', '2025-04-16 06:35:27', 'kim tangpus'),
(22, 1, 'Bluetooth Speaker', 1, 100.00, 'product', '2025-04-16 06:37:46', 'kim tangpus'),
(23, 1, 'Bluetooth Speaker', 1, 100.00, 'product', '2025-04-16 06:40:04', 'kim tangpus'),
(24, 1, 'Bluetooth Speaker', 1, 100.00, 'product', '2025-04-16 06:42:26', 'kim tangpus'),
(25, 1, 'Laptop Stand', 99, 1233.00, 'product', '2025-04-16 06:42:26', 'kim tangpus'),
(26, 1, 'Black Hoodie', 99, 1999.00, 'clothing', '2025-04-16 06:42:26', 'kim tangpus'),
(27, 1, 'Bluetooth Speaker', 1, 100.00, 'product', '2025-04-16 06:43:03', 'kim tangpus'),
(28, 1, 'Laptop Stand', 99, 1233.00, 'product', '2025-04-16 06:43:03', 'kim tangpus'),
(29, 1, 'Black Hoodie', 99, 1999.00, 'clothing', '2025-04-16 06:43:03', 'kim tangpus'),
(30, 1, 'Laptop Stand', 23, 1233.00, 'product', '2025-04-16 06:43:39', 'kim tangpus'),
(31, 1, 'Bluetooth Speaker', 12, 100.00, 'product', '2025-04-16 06:44:13', 'kim tangpus'),
(32, 1, 'Black Hoodie', 33, 1999.00, 'clothing', '2025-04-16 06:44:13', 'kim tangpus'),
(33, 1, 'Wireless Mouse', 23, 1234.82, 'product', '2025-04-16 06:49:02', 'kim tangpus'),
(34, 1, 'Wireless Mouse', 23, 1234.82, NULL, '2025-04-16 06:49:19', 'kim tangpus'),
(35, 1, 'Wireless Mouse', 23, 1234.82, NULL, '2025-04-16 06:49:34', 'kim tangpus'),
(36, 1, 'Black Hoodie', 33, 1999.00, 'clothing', '2025-04-16 06:54:26', 'kim tangpus'),
(37, 1, 'Bluetooth Speaker', 33, 100.00, 'product', '2025-04-16 06:55:11', 'kim tangpus'),
(38, 1, 'Laptop Stand', 44, 1233.00, 'product', '2025-04-16 06:55:11', 'kim tangpus'),
(39, 1, 'USB-C Hub', 55, 333.00, 'product', '2025-04-16 06:55:11', 'kim tangpus'),
(40, 1, 'Bluetooth Speaker', 1, 100.00, 'product', '2025-04-16 07:25:26', 'kim tangpus'),
(41, 1, 'Bluetooth Speaker', 99, 100.00, 'product', '2025-04-16 07:27:27', 'kim tangpus'),
(42, 1, 'Wireless Mouse', 99, 1234.82, 'product', '2025-04-16 07:28:38', 'kim tangpus'),
(43, 1, 'Wireless Mouse', 25, 1234.82, 'product', '2025-04-16 07:29:41', 'kim tangpus'),
(44, 1, 'Bluetooth Speaker', 98, 100.00, 'product', '2025-04-16 07:38:46', 'kim tangpus'),
(45, 1, 'Bluetooth Speaker', 23, 100.00, 'product', '2025-04-16 07:41:51', 'kim tangpus'),
(46, 1, 'Denim Jacket', 23, 999.00, 'clothing', '2025-04-16 07:41:51', 'kim tangpus'),
(47, 1, 'Bluetooth Speaker', 12, 100.00, 'product', '2025-04-16 07:45:36', 'kim tangpus'),
(48, 1, 'Black Hoodie', 35, 1999.00, 'clothing', '2025-04-16 07:45:36', 'kim tangpus'),
(49, 1, 'Bluetooth Speaker', 88, 100.00, 'product', '2025-04-16 07:50:25', 'kim tangpus'),
(50, 1, 'Bluetooth Speaker', 4, 100.00, 'product', '2025-04-16 08:03:12', 'kim tangpus');

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
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `name`) VALUES
(1, 'kimzap', '$2y$10$BV0NI7lgvAv7x5I8q4WQBeC6IkxQeU.1X8Nhvat3aS/wd73y3w6n.', 'kimzaptangpus@gmail.com', 'kim tangpus'),
(2, 'timmy', '$2y$10$O/2h1F2.DbjP4R/Ae1kQPeEIrOGZXspCdlrwr8EDEIU38KsKzZh..', 'timm@gmail.com', 'Kiiiiim');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `clothing`
--
ALTER TABLE `clothing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `invoiceitems`
--
ALTER TABLE `invoiceitems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

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
