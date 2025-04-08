-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2025 at 05:39 AM
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
(13, 1, 'Laptop Stand', 1, 1233.00, 'product', '2025-04-08 03:32:27', 'kim tangpus');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `clothing`
--
ALTER TABLE `clothing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
