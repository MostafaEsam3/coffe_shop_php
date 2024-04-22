-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Apr 04, 2024 at 12:10 AM
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
-- Database: `cafephp`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`) VALUES
(1, 'cat1', '2024-03-24 02:02:49'),
(2, 'cat2', '2024-03-24 02:02:49'),
(3, 'cat3', '2024-03-24 02:03:06'),
(4, 'cat4', '2024-03-24 02:03:06'),
(5, 'cat5', '2024-03-24 02:03:06'),
(6, 'cat6', '2024-03-24 02:03:06'),
(7, 'vegitables', '2024-04-03 23:52:54');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total` double NOT NULL,
  `status` int(11) NOT NULL COMMENT '1 => processing\r\n2 => out of delivery\r\n3 => Done',
  `notes` varchar(100) NOT NULL,
  `room_id` int(11) NOT NULL,
  `created_by` enum('admin','me') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total`, `status`, `notes`, `room_id`, `created_by`, `created_at`) VALUES
(10, 4, 700, 4, 'extra suger please', 1, 'admin', '2024-03-30 11:06:53'),
(11, 4, 700, 4, 'aya7aga', 3, 'admin', '2024-04-01 16:38:49'),
(19, 4, 0, 2, '', 2, 'admin', '2024-04-03 14:17:55'),
(20, 4, 0, 2, '', 2, 'admin', '2024-04-03 14:18:54'),
(21, 4, 0, 2, '', 2, 'admin', '2024-04-03 14:19:03'),
(23, 4, 1200, 4, 'my product', 2, 'me', '2024-04-03 23:50:32'),
(24, 4, 1375, 3, 'This order will be go on monday', 1, 'admin', '2024-04-04 00:00:28');

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

CREATE TABLE `order_products` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `order_products`
--

INSERT INTO `order_products` (`id`, `order_id`, `product_id`, `quantity`, `total`) VALUES
(25, 10, 3, 1, 300),
(26, 10, 4, 1, 400),
(27, 11, 3, 1, 400),
(28, 11, 4, 1, 400),
(29, 19, 3, 2, 0),
(30, 20, 4, 2, 0),
(31, 20, 3, 2, 0),
(32, 21, 3, 2, 0),
(33, 21, 4, 2, 0),
(34, 23, 3, 1, 300),
(35, 23, 4, 1, 400),
(36, 23, 5, 1, 500),
(37, 24, 4, 2, 800),
(38, 24, 5, 1, 500),
(39, 24, 7, 3, 75);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` double NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `image` varchar(100) NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `quantity`, `image`, `category_id`, `created_at`) VALUES
(1, 'product1', 100, 0, 'download.jpeg', 1, '2024-03-24 01:03:44'),
(2, 'product2', 200, 0, 'download.jpg', 2, '2024-03-24 01:03:44'),
(3, 'product3', 300, 25, 'Screenshot 2024-01-02 010931.png', 3, '2024-03-24 01:03:44'),
(4, 'product4', 400, 33, 'Screenshot 2024-01-07 040343.png', 4, '2024-03-24 01:03:44'),
(5, 'product5', 500, 48, 'Screenshot 2024-01-07 195836.png', 5, '2024-03-24 01:03:44'),
(7, 'sugar', 25, 12, 'sugar.jpeg', 2, '2024-04-03 23:55:36');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `name`) VALUES
(1, 'room1'),
(2, 'room2'),
(3, 'room4');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `room_id` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `token` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `is_admin`, `room_id`, `image`, `created_at`, `token`) VALUES
(4, 'khairy', 'sonbaty1937@gmail.com', '$2y$10$buh9b43fL5eC1ZQaw/BBW.W.Vdv1Bs4IoXXN./hSFADjhnQSqv3WK', 0, 1, 'image.png', '2024-03-30 10:53:40', ''),
(5, 'mahmoud', 'eng.ahmedkamal357@gmail.com', '$2y$10$M3E0eHkyQVzYoeAYXozFKuYTanBnH2MGGdVlVE9GEy7ubLb45nOma', 1, 2, 'image.png', '2024-03-30 10:53:40', ''),
(7, 'kamona', 'ahmed.ka51197@gmail.com', '$2y$10$53nBs/fHTUTAutrSNXzXnesg4ntcKnqSxXCEu.KZgrsR.zfSbtdW6', 0, 2, 'Screenshot (47).png', '2024-04-04 00:05:11', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `room_id` (`room_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `order_products`
--
ALTER TABLE `order_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);

--
-- Constraints for table `order_products`
--
ALTER TABLE `order_products`
  ADD CONSTRAINT `order_products_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_products_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
