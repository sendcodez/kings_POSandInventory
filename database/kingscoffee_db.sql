-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 20, 2023 at 04:43 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kingscoffee_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `archieve_categories`
--

CREATE TABLE `archieve_categories` (
  `id` int(30) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `archieve_categories`
--

INSERT INTO `archieve_categories` (`id`, `name`, `description`) VALUES
(2, 'Bread', 'Bread'),
(6, 'Coffee', 'Coffee');

-- --------------------------------------------------------

--
-- Table structure for table `archieve_products`
--

CREATE TABLE `archieve_products` (
  `id` int(30) NOT NULL,
  `category_id` int(30) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` float NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `archieve_users`
--

CREATE TABLE `archieve_users` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `type` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(30) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`) VALUES
(5, 'Milktea', 'Milktea'),
(7, 'Fruit Juice', 'Fruit Juice'),
(8, 'Pasta', 'Pasta'),
(9, 'Iced Coffee', 'Cold'),
(10, 'Hot Coffee', 'Hot '),
(11, 'Cake', 'Cake'),
(12, 'Combo', 'Combo'),
(13, 'Premium Coffee', 'premium'),
(14, 'PROMOS', 'CHRISTMAS');

-- --------------------------------------------------------

--
-- Table structure for table `categories_inventory`
--

CREATE TABLE `categories_inventory` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories_inventory`
--

INSERT INTO `categories_inventory` (`id`, `name`, `description`) VALUES
(6, 'Syrup', 'syrup'),
(7, 'Powder', 'Powder'),
(8, 'Milk', 'milk'),
(9, 'Juice', 'juice'),
(10, 'Coffee', 'Coffee');

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

CREATE TABLE `ingredients` (
  `id` int(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `stocks` int(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `expiration_date` date NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ingredients`
--

INSERT INTO `ingredients` (`id`, `category_id`, `name`, `stocks`, `unit`, `expiration_date`, `status`) VALUES
(25, 7, 'Okinawa Powder', 1500, 'grams', '2025-09-09', 1),
(26, 7, 'Wintermelon Powder', 1611, '', '2023-09-04', 1),
(27, 9, 'Orange Juice', 1000, '', '2023-06-15', 1),
(28, 9, 'Mango', 7222, '', '2025-09-22', 1),
(29, 7, 'Chocolate Powder', 1000, '', '2023-06-08', 1),
(30, 10, 'Coffee', 1000, '', '2023-07-26', 1),
(31, 7, 'Matcha', 3000, '', '2023-08-12', 1),
(32, 9, 'Four Season Powder', 2000, '', '2023-08-04', 1),
(33, 10, 'Italian Coffee', 2000, '', '2023-07-26', 1),
(34, 10, 'kopi', 3000, 'ml', '2025-11-11', 1),
(35, 6, 'try', 200, '', '2023-10-07', 1),
(36, 10, 'expi', 2310, 'ml', '2025-02-02', 1),
(38, 9, 'Juicy', 200, '', '2024-09-01', 1),
(39, 9, 'dsdasd', 100, '', '2024-09-09', 1),
(40, 9, 'amoycanton', 1115, 'grams', '2025-09-22', 1),
(41, 8, 'tetete', 502, 'grams', '2025-09-09', 1),
(42, 9, 'tetete', 2222, 'grams', '2025-02-22', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `ref_no` varchar(50) NOT NULL,
  `total_amount` float NOT NULL,
  `amount_tendered` float NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `user` varchar(255) NOT NULL,
  `payment_mode` varchar(255) NOT NULL DEFAULT 'cash'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `ref_no`, `total_amount`, `amount_tendered`, `customer_name`, `date_created`, `user`, `payment_mode`) VALUES
(113, '966612543918', 75, 100, 'Alexandra Marie Sy', '2023-05-27 16:01:48', 'admin', 'gcash'),
(114, '811308032006', 180, 200, 'Mary Joy Casiquin', '2023-05-27 19:54:43', 'admin', 'cash'),
(115, '090135129158', 150, 200, 'Justine reyes', '2023-05-27 19:55:07', 'admin', 'cash'),
(116, '446669742575', 405, 500, 'Anne Cruz', '2023-05-27 19:56:22', 'admin', 'cash'),
(117, '809034472957', 225, 300, 'John Mark', '2023-05-27 19:58:20', 'staff', 'gcash'),
(118, '740168921756', 400, 400, 'Catherine Sino', '2023-05-28 10:36:05', 'admin', 'gcash'),
(119, '105190357259', 635, 700, 'Marco PJ ', '2023-05-28 10:41:57', 'admin', 'gcash'),
(121, '576431897487', 315, 400, 'Jay Ivan', '2023-05-28 10:44:26', 'admin', 'cash'),
(122, '649249101594', 750, 800, 'Julie Senerado', '2023-05-28 16:24:08', 'admin', 'cash'),
(123, '962949058874', 250, 500, 'Maria Abbigail', '2023-05-29 13:48:23', 'admin', 'gcash'),
(124, '902447434192', 620, 1000, 'Jay mark ', '2023-05-29 13:49:43', 'staff', 'cash'),
(125, '976449350159', 200, 200, 'Marco Jose', '2023-05-29 13:51:24', 'staff', 'cash'),
(126, '366014162454', 250, 250, 'Justine', '2023-05-30 13:46:28', 'admin', 'gcash'),
(127, '982209449365', 380, 380, 'Felise Viloria', '2023-05-30 13:55:05', 'admin', 'cash'),
(128, '775609241264', 285, 300, 'Arianna G', '2023-05-30 13:57:30', 'admin', 'cash'),
(129, '058767504477', 95, 100, 'Mj Casiquin', '2023-05-30 14:33:18', 'admin', 'cash'),
(131, '691231050595', 95, 100, 'alex', '2023-09-19 11:20:53', 'admin', 'cash'),
(132, '285999233871', 1185, 1000, 'rine', '2023-09-19 11:22:01', 'admin', 'gcash'),
(133, '736962570409', 200, 200, 'mimi', '2023-09-19 12:02:48', 'admin', 'gcash'),
(134, '120125917141', 200, 200, 'mimi', '2023-09-19 12:02:48', 'admin', 'gcash'),
(135, '647073298321', 500, 500, 'hhe', '2023-09-19 12:03:23', 'admin', 'gcash'),
(136, '105891614008', 500, 500, 'hhe', '2023-09-19 12:03:23', 'admin', 'gcash'),
(137, '443616942323', 225, 400, 'gege', '2023-09-19 12:05:15', 'admin', 'gcash'),
(138, '129715608640', 300, 300, 'sdvsd', '2023-09-19 12:05:39', 'admin', 'gcash'),
(139, '801136032226', 300, 300, 'sdvsd', '2023-09-19 12:05:39', 'admin', 'gcash'),
(140, '767097231689', 150, 200, 'dcsvdv', '2023-09-19 12:06:03', 'admin', 'gcash'),
(141, '927020093445', 300, 300, 'ef', '2023-09-19 12:06:44', 'admin', 'gcash'),
(142, '149614472079', 75, 100, 'df', '2023-09-19 12:08:10', 'admin', 'gcash'),
(143, '942940049252', 75, 100, 'df', '2023-09-19 12:08:10', 'admin', 'gcash'),
(144, '887262379938', 800, 1000, 'hahaha', '2023-09-19 12:15:45', 'admin', 'gcash'),
(145, '439535032545', 800, 1000, 'sys', '2023-09-19 12:17:00', 'admin', 'gcash'),
(146, '004103291473', 300, 300, 'gfg', '2023-09-19 12:19:26', 'admin', 'gcash'),
(147, '344131700312', 300, 300, 'gfg', '2023-09-19 12:19:26', 'admin', 'gcash'),
(148, '007550479160', 100, 0, 'assad', '2023-09-19 12:20:11', 'admin', 'gcash'),
(149, '522413099780', 100, 100, 'hehehe', '2023-09-19 12:25:17', 'admin', 'gcash'),
(150, '258265483715', 1125, 1500, 'noynoy', '2023-09-19 13:41:44', 'admin', 'gcash'),
(151, '538278281619', 200, 11, 'testtttt', '2023-09-19 13:47:30', 'admin', 'gcash'),
(152, '874678088763', 100, 400, 'test', '2023-09-19 13:51:57', 'admin', 'gcash'),
(153, '153353767469', 100, 0, 'jghgh', '2023-09-19 13:52:07', 'admin', 'gcash'),
(154, '199724215425', 100, 0, 't', '2023-09-19 13:52:33', 'admin', 'gcash'),
(155, '207071863928', 100, 200, 'mwemwemwe', '2023-09-19 13:55:10', 'admin', 'gcash'),
(156, '598854480834', 1200, 2500, 'ssss', '2023-09-19 13:55:42', 'admin', 'gcash'),
(157, '988378428212', 100, 200, 'ss', '2023-09-19 14:18:51', 'admin', 'gcash'),
(158, '998181577518', 300, 0, '', '2023-09-19 14:56:12', 'admin', 'gcash'),
(159, '173978703208', 300, 0, '', '2023-09-19 14:56:12', 'admin', 'gcash'),
(160, '654374787103', 100, 0, 'sss', '2023-09-19 15:02:18', 'admin', 'gcash'),
(161, '514535813538', 100, 0, 'sss', '2023-09-19 15:02:19', 'admin', 'gcash'),
(162, '633265749420', 76, 100, 'ss', '2023-09-19 17:06:46', 'admin', 'gcash');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(30) NOT NULL,
  `order_id` int(30) NOT NULL,
  `product_id` int(30) NOT NULL,
  `qty` int(30) NOT NULL,
  `price` float NOT NULL,
  `amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `qty`, `price`, `amount`) VALUES
(130, 113, 115, 1, 75, 75),
(131, 114, 117, 1, 85, 85),
(132, 114, 119, 1, 95, 95),
(133, 115, 116, 3, 50, 150),
(134, 116, 119, 1, 95, 95),
(135, 116, 117, 1, 85, 85),
(136, 116, 118, 1, 100, 100),
(137, 116, 115, 1, 75, 75),
(138, 116, 116, 1, 50, 50),
(139, 117, 118, 1, 100, 100),
(140, 117, 116, 1, 50, 50),
(141, 117, 115, 1, 75, 75),
(142, 118, 120, 4, 100, 400),
(143, 119, 121, 2, 65, 130),
(144, 119, 116, 1, 50, 50),
(145, 119, 118, 1, 100, 100),
(146, 119, 120, 1, 100, 100),
(147, 119, 117, 1, 85, 85),
(148, 119, 115, 1, 75, 75),
(149, 119, 119, 1, 95, 95),
(150, 120, 115, 1, 75, 75),
(151, 120, 117, 1, 85, 85),
(152, 121, 121, 1, 65, 65),
(153, 121, 116, 1, 50, 50),
(154, 121, 120, 1, 100, 100),
(155, 121, 118, 1, 100, 100),
(156, 122, 116, 15, 50, 750),
(157, 123, 120, 1, 100, 100),
(158, 123, 115, 2, 75, 150),
(159, 124, 120, 1, 100, 100),
(160, 124, 115, 1, 75, 75),
(161, 124, 119, 1, 95, 95),
(162, 124, 117, 1, 85, 85),
(163, 124, 121, 1, 65, 65),
(164, 124, 116, 2, 50, 100),
(165, 124, 118, 1, 100, 100),
(166, 125, 120, 1, 100, 100),
(167, 125, 118, 1, 100, 100),
(168, 126, 118, 2, 100, 200),
(169, 126, 116, 1, 50, 50),
(170, 127, 122, 4, 95, 380),
(171, 128, 122, 3, 95, 285),
(172, 129, 122, 1, 95, 95),
(173, 130, 118, 2, 100, 200),
(174, 131, 122, 1, 95, 95),
(175, 132, 119, 8, 95, 760),
(176, 132, 117, 5, 85, 425),
(177, 133, 120, 2, 100, 200),
(178, 134, 120, 2, 100, 200),
(179, 135, 120, 5, 100, 500),
(180, 136, 120, 5, 100, 500),
(181, 137, 115, 3, 75, 225),
(182, 138, 115, 4, 75, 300),
(183, 139, 115, 4, 75, 300),
(184, 140, 115, 2, 75, 150),
(185, 141, 115, 4, 75, 300),
(186, 142, 115, 1, 75, 75),
(187, 143, 115, 1, 75, 75),
(188, 144, 124, 8, 100, 800),
(189, 145, 124, 8, 100, 800),
(190, 146, 124, 3, 100, 300),
(191, 147, 124, 3, 100, 300),
(192, 148, 124, 1, 100, 100),
(193, 149, 125, 1, 100, 100),
(194, 150, 123, 4, 100, 400),
(195, 150, 124, 1, 100, 100),
(196, 150, 116, 2, 50, 100),
(197, 150, 125, 1, 100, 100),
(198, 150, 115, 3, 75, 225),
(199, 150, 120, 2, 100, 200),
(200, 151, 118, 1, 100, 100),
(201, 151, 123, 1, 100, 100),
(202, 152, 118, 1, 100, 100),
(203, 153, 118, 1, 100, 100),
(204, 154, 118, 1, 100, 100),
(205, 155, 118, 1, 100, 100),
(206, 156, 124, 9, 100, 900),
(207, 156, 123, 3, 100, 300),
(208, 157, 118, 1, 100, 100),
(209, 158, 118, 3, 100, 300),
(210, 159, 118, 3, 100, 300),
(211, 160, 118, 1, 100, 100),
(212, 161, 118, 1, 100, 100),
(213, 162, 122, 1, 95, 95);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(30) NOT NULL,
  `category_id` int(30) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `price` float NOT NULL,
  `quantity` int(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0=Unavailable,1=Available',
  `image` varchar(255) NOT NULL,
  `expiration_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `description`, `price`, `quantity`, `status`, `image`, `expiration_date`) VALUES
(115, 5, 'Okinawa', 'Okinawa', 75, 0, 1, '1685174460_whitechoco.jpg', '2023-05-27'),
(116, 7, 'Mango ', 'mango', 50, 0, 1, '1685188200_juice.jpg', '2023-05-27'),
(117, 5, 'Wintermelon', 'wintermelon', 85, 0, 1, '1685188200_kape.jpg', '2023-05-27'),
(118, 10, 'Amerikano', 'amerikano', 100, 0, 1, '1685188380_hot coffee.jpg', '2023-05-27'),
(119, 9, 'White Chocolate ', 'white chocolate', 95, 0, 1, '1685241480_348825790_790031692652606_5186885915670577889_n.jpg', '2023-05-27'),
(120, 5, 'Matcha', 'matcha', 100, 0, 1, '1685241240_4.jpg', '2023-05-28'),
(121, 7, 'Four Season ', '4 season', 65, 0, 1, '1685241660_4season.jpg', '2023-05-28'),
(122, 13, 'Italian Coffee', 'strong, bitter coffee', 95, 0, 1, '1685425380_hot coffee.jpg', '2023-05-30'),
(123, 9, 'Barista Drink', 'Barista Drink', 100, 0, 1, '1695096660_aba.jpg', '2023-09-19'),
(124, 9, 'kkopi', 'kkopi', 100, 0, 1, '1695096900_gordon.jpg', '2023-09-19'),
(125, 9, 'try', 'try', 100, 0, 1, '1695097440_tilapia.jpg', '2023-09-19');

-- --------------------------------------------------------

--
-- Table structure for table `product_ingredients`
--

CREATE TABLE `product_ingredients` (
  `id` int(255) NOT NULL,
  `product_id` int(255) NOT NULL,
  `ingredients_id` int(255) NOT NULL,
  `measurement` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_ingredients`
--

INSERT INTO `product_ingredients` (`id`, `product_id`, `ingredients_id`, `measurement`) VALUES
(102, 115, 25, 30),
(103, 116, 28, 65),
(104, 117, 26, 100),
(105, 118, 30, 20),
(107, 120, 31, 45),
(108, 121, 32, 30),
(109, 122, 33, 15),
(110, 124, 34, 50),
(111, 125, 35, 50);

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` int(255) NOT NULL,
  `order_items_id` int(255) NOT NULL,
  `product_ingredients_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `cover_img` text NOT NULL,
  `about_content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`id`, `name`, `email`, `contact`, `cover_img`, `about_content`) VALUES
(1, 'Simple Cafe Billing System', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 3 COMMENT '1=Admin,2=Staff'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `type`) VALUES
(1, 'admin', 'admin', '0192023a7bbd73250516f069df18b500', 1),
(5, 'staff', 'staff', 'de9bf5643eabf80f4a56fda3bbb84483', 2),
(6, 'juan dela cruz', 'juan', 'a94652aa97c7211ba8954dd15a3cf838', 2),
(7, 'Joy', 'joycasiquin', 'c2c8e798aecbc26d86e4805114b03c51', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `archieve_categories`
--
ALTER TABLE `archieve_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `archieve_products`
--
ALTER TABLE `archieve_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories_inventory`
--
ALTER TABLE `categories_inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_ingredients`
--
ALTER TABLE `product_ingredients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_id` (`product_id`),
  ADD KEY `ingredients_id_fk` (`ingredients_id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_id` (`order_items_id`),
  ADD KEY `product_ingredients_id` (`product_ingredients_id`);

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `archieve_categories`
--
ALTER TABLE `archieve_categories`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `archieve_products`
--
ALTER TABLE `archieve_products`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `categories_inventory`
--
ALTER TABLE `categories_inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=214;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT for table `product_ingredients`
--
ALTER TABLE `product_ingredients`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD CONSTRAINT `category_id` FOREIGN KEY (`category_id`) REFERENCES `categories_inventory` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_ingredients`
--
ALTER TABLE `product_ingredients`
  ADD CONSTRAINT `ingredients_id_fk` FOREIGN KEY (`ingredients_id`) REFERENCES `ingredients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stocks`
--
ALTER TABLE `stocks`
  ADD CONSTRAINT `order_items_id` FOREIGN KEY (`order_items_id`) REFERENCES `order_items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_ingredients_id` FOREIGN KEY (`product_ingredients_id`) REFERENCES `product_ingredients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
