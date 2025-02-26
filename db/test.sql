-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2025 at 05:08 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders_info`
--

CREATE TABLE `orders_info` (
  `orders_id` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `postal_code` varchar(20) NOT NULL,
  `orders_created_at` datetime NOT NULL,
  `payment_method` enum('Credit Card','PayPal','Bank Transfer','Cash') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orders_info`
--

INSERT INTO `orders_info` (`orders_id`, `country`, `city`, `address`, `postal_code`, `orders_created_at`, `payment_method`) VALUES
('ORD-2025-02-322691-631907', 'United States', 'California', 'one apple park way cupertino ca united states', '95014', '2025-02-23 17:03:28', 'PayPal');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `products_name` varchar(255) NOT NULL,
  `products_image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `original_price` decimal(10,2) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock_quantity` int(11) NOT NULL,
  `product_star` decimal(2,1) DEFAULT 0.0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `products_name`, `products_image`, `description`, `original_price`, `price`, `stock_quantity`, `product_star`) VALUES
(41516, 'Samsung SSD 990 PRO', 'https://farm66.static.flickr.com/65535/52505350197_3e0819ecc8_b.jpg', 'Secure victory with 990 PRO\'s expanded 4TB capacity, empowering you with a random read speed of up to 1,600K IOPS. Witness faster loading times on your PC and PlayStation® 5, as it breathes life into your games.', 999.00, 100.00, 999, 4.5),
(93038, 'iphone16 pro', 'https://www.apple.com/v/iphone-16-pro/d/images/meta/iphone-16-pro_overview__ejy873nl8yi6_og.png?202412122331a', 'Splash, Water, and Dust Resistant3\nRated IP68 (maximum depth of 6 meters up to 30 minutes) under IEC standard 60529', 999.00, 100.00, 999, 5.0),
(93586, 'Nvidia RTX 5060', 'https://www.overclockers.co.uk/blog/wp-content/uploads/2024/12/NVIDIA-5060-Rumour-Overclockers-UK-Blog-Feature-Image-Bottom-Text-Blog-1600x900Light-TextTwitter-.png', 'The Nvidia GeForce RTX 5060 is a mid-range desktop graphics card utilizing the GB206 chip based on the Blackwell architecture. The 5060 offers 8 GB GDDR7 graphics memory with a 128-bit memory bus.', 999.00, 100.00, 999, 5.0);

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `user_id` bigint(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `token_expiry` datetime DEFAULT NULL,
  `account_registered_at` datetime NOT NULL DEFAULT current_timestamp(),
  `last_login_time` datetime DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`user_id`, `username`, `password`, `email`, `token`, `token_expiry`, `account_registered_at`, `last_login_time`, `first_name`, `last_name`) VALUES
(219273716, 'Test456', '$2y$10$3qGnRaAkhIGgXmykYSsSH.PldMHBo04BGkZj260Bfey9F78ZW5he2', 'Test456@yahoo.com', NULL, NULL, '2024-12-27 14:35:21', '2025-02-26 16:30:49', NULL, NULL),
(3253652496792670337, 'Test789', '$2y$10$Wl7OBBlrq8PtvrxfWr27Zuq4eoadSoVkgAwG2RSPFumcn7Bf2wAFa', 'Test789@icloud.com', NULL, NULL, '2024-12-28 14:41:58', '2025-02-26 16:30:05', NULL, NULL),
(4845727533474930302, 'Test123', '$2y$10$llpH5dn.MyYyIXOsk.1H0ueebvX.y7YDJUupZuCTx8UlDA/qv943K', 'Test123@gmail.com', NULL, NULL, '2024-12-28 14:41:01', '2025-02-26 16:30:27', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders_info`
--
ALTER TABLE `orders_info`
  ADD PRIMARY KEY (`orders_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98858;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `user_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8964933552502346846;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
