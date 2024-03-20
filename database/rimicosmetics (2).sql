-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 17, 2024 at 01:21 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rimicosmetics`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `created_at`, `status`) VALUES
(4, 'Biscuit', '2024-03-06 20:19:08', 1),
(5, 'Minerals', '2024-03-06 20:22:34', 1),
(6, 'Minerals', '2024-03-06 20:22:38', 1),
(8, 'Good', '2024-03-06 20:47:18', 1),
(10, 'Sweet', '2024-03-16 22:08:27', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pos`
--

CREATE TABLE `pos` (
  `id` int(11) NOT NULL,
  `reference` varchar(255) DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `customer_phone` varchar(255) DEFAULT NULL,
  `payment_type` varchar(255) DEFAULT NULL,
  `amount_paid` double DEFAULT NULL,
  `total` double NOT NULL,
  `tax` double NOT NULL DEFAULT 0,
  `discount` double NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pos`
--

INSERT INTO `pos` (`id`, `reference`, `customer_name`, `customer_phone`, `payment_type`, `amount_paid`, `total`, `tax`, `discount`, `created_at`) VALUES
(1, '65f17733935b1', '', '', 'cash', 34, 34, 12, 20, '2024-03-13 09:51:47'),
(2, '65f17793b99cd', '', '', 'cash', 2000, 2230.2, 9, 9, '2024-03-13 09:53:23'),
(3, '65f177d88efe7', 'Yahaya', 'Usmanu', 'cash', 200, 2616.98, 5, 4, '2024-03-13 09:54:32'),
(4, '65f307a719029', '', '', 'cash', 30.57, 30.57, 12, 20, '2024-03-14 14:20:23'),
(5, '65f313307a55e', '', '', 'cash', 526.71, 526.71, 0, 6, '2024-03-14 15:09:36'),
(6, '65f6199630664', 'Malam Hamisu', '33223332', 'cash', 500, 550, 0, 0, '2024-03-16 22:13:42'),
(7, '65f61acc91957', 'Yahaya', '233322', 'cash', 572, 572, 0, 0, '2024-03-16 22:18:52'),
(8, '65f61b845dc09', '', '', 'cash', 147.4, 147.4, 0, 20, '2024-03-16 22:21:56');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `stock` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `cost_price` int(11) DEFAULT NULL,
  `sell_price` int(11) DEFAULT NULL,
  `tax` varchar(255) DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `cat_id` int(11) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `code`, `stock`, `image`, `cost_price`, `sell_price`, `tax`, `discount`, `status`, `created_at`, `cat_id`, `description`) VALUES
(1, 'Buiscuit', '397255', 108, NULL, 12, 11, '', 0, 1, '2024-03-07 03:04:53', 4, NULL),
(2, 'Kunun aya', '758030', 4, 'adnet logo  gradient.jpg', 33, 33, '12', 20, 1, '2024-03-07 03:06:35', 6, ' '),
(3, 'Buiscuit', '427759', 10, 'person-placeholder-300x300.jpg', 12, 1, '', 0, 1, '2024-03-07 10:49:52', 4, NULL),
(4, 'Applicationaaa', '337805', 11, 'person-placeholder-300x300.jpg', 12, 222, '1', 1, 1, '2024-03-11 11:25:44', 8, ' '),
(6, 'Milkose', '673676', 89, 'Screenshot 2024-02-29 013143.png', 100, 110, '0', 0, 1, '2024-03-16 22:11:40', 10, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_order`
--

CREATE TABLE `product_order` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` double NOT NULL,
  `quantity` int(11) DEFAULT 1,
  `tax` double DEFAULT 0,
  `discount` double DEFAULT 0,
  `product_code` varchar(255) DEFAULT NULL,
  `reference` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_order`
--

INSERT INTO `product_order` (`id`, `product_id`, `price`, `quantity`, `tax`, `discount`, `product_code`, `reference`, `created_at`) VALUES
(3, 2, 33, 1, 12, 20, '758030', '65f17733935b1', '2024-03-15 01:12:29'),
(4, 3, 1, 1, 0, 0, '427759', '65f17733935b1', '2024-03-15 01:12:29'),
(5, 1, 11, 6, 2, 3, '397255', '65f17793b99cd', '2024-03-15 01:12:29'),
(6, 2, 33, 5, 4, 5, '758030', '65f17793b99cd', '2024-03-15 01:12:29'),
(7, 3, 1, 4, 2, 0, '427759', '65f17793b99cd', '2024-03-15 01:12:29'),
(8, 4, 222, 9, 1, 1, '337805', '65f17793b99cd', '2024-03-15 01:12:29'),
(9, 2, 33, 1, 3, 3, '758030', '65f177d88efe7', '2024-03-15 01:12:29'),
(10, 1, 11, 11, 0, 0, '397255', '65f177d88efe7', '2024-03-15 01:12:29'),
(11, 3, 1, 3, 1, 0, '427759', '65f177d88efe7', '2024-03-15 01:12:29'),
(12, 4, 222, 1, 1, 1, '337805', '65f177d88efe7', '2024-03-15 01:12:29'),
(13, 2, 33, 1, 12, 20, '758030', '65f307a719029', '2024-03-15 01:12:29'),
(14, 3, 1, 1, 0, 0, '427759', '65f307a719029', '2024-03-15 01:12:29'),
(15, 2, 33, 3, 0, 3, '758030', '65f313307a55e', '2024-03-15 01:12:29'),
(16, 4, 222, 2, 0, 3, '337805', '65f313307a55e', '2024-03-15 01:12:29'),
(17, 6, 110, 5, 0, 0, NULL, '65f6199630664', '2024-03-16 22:13:42'),
(18, 6, 110, 5, 0, 0, '673676', '65f61acc91957', '2024-03-16 22:18:52'),
(19, 1, 11, 2, 0, 0, '397255', '65f61acc91957', '2024-03-16 22:18:52'),
(20, 2, 33, 1, 0, 20, '758030', '65f61b845dc09', '2024-03-16 22:21:56'),
(21, 6, 110, 1, 0, 0, '673676', '65f61b845dc09', '2024-03-16 22:21:56'),
(22, 1, 11, 1, 0, 0, '397255', '65f61b845dc09', '2024-03-16 22:21:56');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `username`, `email`, `password`, `created_at`) VALUES
(1, 'Shuraihu Usman', 'rimi', 'usman@gmail.com', '$2y$10$uB7PEi.v7XoyKogLwuTA8OjlKAiW.t2q6CC6RbOywA/XDO5cCa6iW', '2024-03-05 10:14:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pos`
--
ALTER TABLE `pos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_product_category` (`cat_id`);

--
-- Indexes for table `product_order`
--
ALTER TABLE `product_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pos`
--
ALTER TABLE `pos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product_order`
--
ALTER TABLE `product_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_product_category` FOREIGN KEY (`cat_id`) REFERENCES `category` (`id`);

--
-- Constraints for table `product_order`
--
ALTER TABLE `product_order`
  ADD CONSTRAINT `product_order_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
