-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 22, 2020 at 01:24 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop_cart`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pay` int(1) NOT NULL DEFAULT 0,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `pro_id`, `user_id`, `pay`, `date`) VALUES
(4, 2, 2, 0, '2020-10-21 22:16:33'),
(5, 2, 2, 0, '2020-10-21 22:16:36'),
(6, 5, 2, 0, '2020-10-21 22:16:40'),
(7, 4, 2, 0, '2020-10-21 22:16:43'),
(9, 2, 3, 0, '2020-10-21 23:01:35'),
(10, 3, 3, 0, '2020-10-21 23:01:38'),
(11, 2, 1, 0, '2020-10-21 23:07:47'),
(12, 2, 1, 0, '2020-10-21 23:07:50'),
(13, 4, 1, 0, '2020-10-21 23:07:53'),
(14, 5, 1, 0, '2020-10-21 23:07:55'),
(15, 6, 1, 0, '2020-10-21 23:08:04');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(21) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `date`) VALUES
(1, 'car', '2020-10-21 09:23:44'),
(2, 'T-shirt', '2020-10-21 09:26:49'),
(3, 'Pants', '2020-10-21 09:27:05'),
(4, 'Jacket', '2020-10-21 09:27:18'),
(5, 'Shoes ', '2020-10-21 09:27:35');

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

CREATE TABLE `discount` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `cat_id_if` int(11) NOT NULL,
  `num_buy` int(11) NOT NULL,
  `cat_id_discount` int(11) NOT NULL,
  `num_discount` int(11) NOT NULL,
  `type_discount` varchar(11) NOT NULL,
  `expired` date NOT NULL,
  `state` int(1) NOT NULL DEFAULT 1,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `discount`
--

INSERT INTO `discount` (`id`, `name`, `cat_id_if`, `num_buy`, `cat_id_discount`, `num_discount`, `type_discount`, `expired`, `state`, `date`) VALUES
(2, 'all Shoes 10%', 5, 0, 5, 10, 'percentage', '2020-10-31', 1, '2020-10-21 16:16:58'),
(3, 'Buy two t-shirts and get a jacket half its price', 2, 2, 4, 50, 'percentage', '2020-10-31', 1, '2020-10-21 22:00:08');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(21) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `price` decimal(6,2) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `cat_id`, `price`, `date`) VALUES
(1, 'test product', 1, '10.99', '2020-10-21 12:10:55'),
(2, 'T-shirt', 2, '10.99', '2020-10-21 12:22:16'),
(3, 'Pants', 3, '14.99', '2020-10-21 12:22:53'),
(4, 'Jacket ', 4, '19.99', '2020-10-21 12:23:26'),
(5, 'Shoes ', 5, '24.99', '2020-10-21 12:25:19'),
(6, 'car GTA', 1, '100.50', '2020-10-21 12:48:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_in_cart` (`pro_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discount`
--
ALTER TABLE `discount`
  ADD PRIMARY KEY (`id`),
  ADD KEY `if_cat_to_discount` (`cat_id_if`),
  ADD KEY `discount_cat_to_discount` (`cat_id_discount`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cat_of_product` (`cat_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `discount`
--
ALTER TABLE `discount`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `product_in_cart` FOREIGN KEY (`pro_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `discount`
--
ALTER TABLE `discount`
  ADD CONSTRAINT `discount_cat_to_discount` FOREIGN KEY (`cat_id_discount`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `if_cat_to_discount` FOREIGN KEY (`cat_id_if`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `cat_of_product` FOREIGN KEY (`cat_id`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
