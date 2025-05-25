-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2025 at 06:22 PM
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
  `city` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `address` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `postal_code` varchar(20) NOT NULL,
  `orders_created_at` datetime NOT NULL,
  `payment_method` enum('Credit Card','PayPal','Bank Transfer','Cash on delivery') NOT NULL
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
  `product_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `product_images` varchar(255) DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `brand` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `original_price` decimal(10,2) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `star` decimal(2,1) DEFAULT 0.0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_images`, `description`, `brand`, `original_price`, `price`, `stock`, `star`) VALUES
(16933, ' Apple Watch Series 10', 'https://www.apple.com/v/apple-watch-series-10/d/images/meta/apple-watch-series-10__esijfewqry82_og.png', 'Series 10 is a major milestone for Apple Watch. It features our biggest and most advanced display yet,3 showing more information onscreen than ever. With Apple’s first wide-angle OLED Display, the screen is brighter when viewed from an angle, making it easier to read with a quick glance.', 'Apple', 1500.00, 1350.00, 999, 4.0),
(27643, 'Adidas', 'https://www.totalgymnasticsdirect.com/Cache/Images/Adidas-Entrada-22-Track-Jacket-Team-Navy-Blue-400x400.jpg.webp', 'The three stripes are Adidas\'s identity mark, having been used on the company\'s clothing and shoe designs as a marketing aid. The branding, which Adidas bought in 1952 from Finnish sports company Karhu Sports for the equivalent of €1,600 and two bottles of whiskey,became so successful that Dassler described Adidas as \"The three stripes company\".', 'Adidas', 300.00, 260.00, 999, 3.7),
(41516, 'Samsung SSD 980 PRO', 'https://upload.wikimedia.org/wikipedia/commons/7/75/Samsung_980_PRO_PCIe_4.0_NVMe_SSD_1TB-top_PNr%C2%B00915.jpg', 'Powered by Samsung in-house controller for pcie® 4.0 SSD, the 980 PRO is optimized for speed. It delivers read speeds up to 7,000 MB/s, making it 2 times faster than PCIe® 3.0 SSDs and 12.7 times faster than SATA SSDs. The 980 PRO achieves max speeds on PCIe® 4.0 and may vary in other environments.', 'Samsung', 999.00, 642.00, 999, 4.5),
(50465, 'Durex', 'https://st4.depositphotos.com/1063437/21893/i/450/depositphotos_218934674-stock-photo-poznan-pol-sep-2018-products.jpg', 'Durex is a British brand of condoms and personal lubricants owned by Reckitt Benckiser and currently led by Ben Wilson.It was initially developed in London under the purview of the London Rubber Company and British Latex Products Ltd, where it was manufactured between 1932 and 1994.', 'Durex', 700.00, 660.00, 999, 5.0),
(75966, 'Acer Nitro AN515', 'https://s.yimg.com/zp/MerchandiseImages/387C4AD3AB-SP-11389424.jpg', 'Acer Nitro 5 Gaming Laptop, 9th Gen Intel Core i5-9300H, NVIDIA GeForce GTX 1650, 15.6\" Full HD IPS Display, 8GB DDR4, 256GB NVMe SSD, Wi-Fi 6, Backlit Keyboard, Alexa Built-in, AN515-54-5812.', 'Acer', 48500.00, 45000.00, 999, 4.3),
(91625, 'Razer Basilisk Ultimate', 'https://assets2.razerzone.com/images/pnx.assets/08f14e963f0f7935f138ac2d2c5387f9/basilisk-ultimate-gallery-3.jpg', 'The new and improved Razer Basilisk Ultimate is the most customizable wireless mouse perfect for FPS games. It comes with 11 programmable buttons, a tilt click scroll wheel paired with a dial to adjust the scroll wheel resistance.', 'Razer', 750.00, 640.00, 999, 4.9),
(93038, 'iphone16 pro', 'https://www.apple.com/v/iphone-16-pro/d/images/meta/iphone-16-pro_overview__ejy873nl8yi6_og.png?202412122331a', 'Splash, Water, and Dust Resistant3\r\nRated IP68 (maximum depth of 6 meters up to 30 minutes) under IEC standard 60529', 'Apple', 0.00, 1000.00, 999, 4.5),
(93586, 'Nvidia RTX 5060', 'https://www.overclockers.co.uk/blog/wp-content/uploads/2025/01/ordering-rtx-50-twitter-1536x864.png', 'The Nvidia GeForce RTX 5060 is a mid-range desktop graphics card utilizing the GB206 chip based on the Blackwell architecture. The 5060 offers 8 GB GDDR7 graphics memory with a 128-bit memory bus.', 'Nvidia', 999.00, 655.00, 999, 2.7);

-- --------------------------------------------------------

--
-- Table structure for table `user_accounts`
--

CREATE TABLE `user_accounts` (
  `user_id` bigint(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `token_expiry` datetime DEFAULT NULL,
  `account_registered_at` datetime NOT NULL DEFAULT current_timestamp(),
  `last_login_time` datetime DEFAULT NULL,
  `first_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_accounts`
--

INSERT INTO `user_accounts` (`user_id`, `username`, `password`, `email`, `token`, `token_expiry`, `account_registered_at`, `last_login_time`, `first_name`, `last_name`) VALUES
(219273716, 'Test456', '$2y$10$jCrH3TMWJIyn9AgPHgarhO7SieUGRdkWeqG.U8rvhtqv8uBQoJTgW', 'Test456@gmail.com', NULL, NULL, '2024-12-27 14:35:21', '2025-03-25 14:18:18', '', ''),
(4845727533474930302, 'Test123', '$2y$10$wsi0q/wuRyOZ6K9L2.UJ3OI320seI/D1Nj8v2t6yc0PgqPU05r.Wu', 'Test123@gmail.com', NULL, NULL, '2024-12-28 14:41:01', '2025-04-22 11:46:19', 'Douglas', 'McGee');

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
-- Indexes for table `user_accounts`
--
ALTER TABLE `user_accounts`
  ADD PRIMARY KEY (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
