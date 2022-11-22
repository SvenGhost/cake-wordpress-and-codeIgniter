-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2022 at 04:13 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cake`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_type` varchar(255) NOT NULL,
  `product_price` varchar(255) NOT NULL,
  `product_recipe` text NOT NULL,
  `created_at` datetime NOT NULL,
  `last_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `product_type`, `product_price`, `product_recipe`, `created_at`, `last_updated`) VALUES
(2, 'Cake 2', 'Low Sugar', '25.00', 'Cras nec cursus ex. Aenean elit eros, porttitor in sollicitudin et, laoreet vel leo. Fusce fermentum lorem cursus, elementum turpis sit amet, hendrerit orci. ', '2022-11-11 12:43:54', '2022-11-11 12:43:54'),
(3, 'Cake 3', 'Sugar Less', '45.00', 'Cras nec cursus ex. Aenean elit eros, porttitor in sollicitudin et, laoreet vel leo. Fusce fermentum lorem cursus, elementum turpis sit amet, hendrerit orci. ', '2022-11-11 12:43:54', '2022-11-11 12:43:54'),
(8, 'Cake 4', 'Sugar', '32.00', 'test going on', '2022-11-11 13:09:56', '0000-00-00 00:00:00'),
(9, 'Cake 4', 'Sugar', '32.00', 'test going on', '2022-11-11 13:15:22', '0000-00-00 00:00:00'),
(11, 'Cake 4', 'Sugar', '32.00', 'test going on', '2022-11-11 15:35:59', '0000-00-00 00:00:00'),
(12, 'Cake 4', 'Sugar', '32.00', 'test going on', '2022-11-11 15:36:23', '0000-00-00 00:00:00'),
(13, 'Cake 4', 'Sugar', '32.00', 'test going on', '2022-11-11 15:36:48', '0000-00-00 00:00:00'),
(14, 'Cake 4', 'Sugar', '32.00', 'test going on', '2022-11-11 15:38:36', '0000-00-00 00:00:00'),
(15, 'Cake 4', 'Sugar', '32.00', 'test going on', '2022-11-11 15:38:43', '0000-00-00 00:00:00'),
(16, 'Cake 4', 'Sugar', '32.00', 'test going on', '2022-11-11 15:39:17', '0000-00-00 00:00:00'),
(17, 'Cake 4', 'Sugar', '32.00', 'test going on', '2022-11-11 15:39:48', '0000-00-00 00:00:00'),
(18, 'Cake 4', 'Sugar', '32.00', 'test going on', '2022-11-11 15:40:12', '0000-00-00 00:00:00'),
(19, 'Cake 4', 'Sugar', '32.00', 'test going on', '2022-11-11 15:40:20', '0000-00-00 00:00:00'),
(20, 'Cake 4', 'Sugar', '32.00', 'test going on', '2022-11-11 15:41:23', '0000-00-00 00:00:00'),
(21, 'Cake 4', 'Sugar', '32.00', 'test going on', '2022-11-11 15:41:47', '0000-00-00 00:00:00'),
(22, 'Cake 4', 'Sugar', '32.00', 'test going on', '2022-11-11 15:41:56', '0000-00-00 00:00:00'),
(24, 'Cake New 55566677777', 'Sugar4555', '32555.00', 'test going on asdf sadf dsafsad fa dsfdsafdsaf', '2022-11-11 16:04:49', '2022-11-11 16:08:06');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL COMMENT 'Stores id from product table which is unique',
  `image_name` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image_name`, `created_at`) VALUES
(14, 21, '335.jpg', '2022-11-11 15:41:47'),
(15, 21, '556.png', '2022-11-11 15:41:47'),
(16, 22, '3351.jpg', '2022-11-11 15:41:56'),
(17, 22, '5561.png', '2022-11-11 15:41:56'),
(18, 23, '334.jpg', '2022-11-11 16:03:21'),
(19, 23, '3352.jpg', '2022-11-11 16:03:21'),
(20, 23, '5562.png', '2022-11-11 16:03:21'),
(21, 23, '667.png', '2022-11-11 16:03:21'),
(22, 24, '3341.jpg', '2022-11-11 16:04:49'),
(23, 24, '3353.jpg', '2022-11-11 16:04:49'),
(24, 24, '5563.png', '2022-11-11 16:04:49'),
(25, 24, '6671.png', '2022-11-11 16:04:49'),
(26, 24, '3342.jpg', '2022-11-11 16:07:01'),
(27, 24, '3354.jpg', '2022-11-11 16:07:01'),
(28, 24, '5564.png', '2022-11-11 16:07:01'),
(29, 24, '6672.png', '2022-11-11 16:07:01'),
(30, 24, '3343.jpg', '2022-11-11 16:07:48'),
(31, 24, '3355.jpg', '2022-11-11 16:07:48'),
(32, 24, '5565.png', '2022-11-11 16:07:48'),
(33, 24, '6673.png', '2022-11-11 16:07:48'),
(34, 24, '3344.jpg', '2022-11-11 16:08:06'),
(35, 24, '3356.jpg', '2022-11-11 16:08:06'),
(36, 24, '5566.png', '2022-11-11 16:08:06'),
(37, 24, '6674.png', '2022-11-11 16:08:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
