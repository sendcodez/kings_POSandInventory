-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2023 at 03:24 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

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
(2, 'Bread', 'Bread');

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

--
-- Dumping data for table `archieve_products`
--

INSERT INTO `archieve_products` (`id`, `category_id`, `name`, `description`, `price`, `status`, `image`) VALUES
(115, 5, 'Okinawa', 'Okinawa', 75, 1, '1685174460_whitechoco.jpg'),
(116, 7, 'Mango ', 'mango', 50, 1, '1685188200_juice.jpg');

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

--
-- Dumping data for table `archieve_users`
--

INSERT INTO `archieve_users` (`id`, `name`, `username`, `password`, `type`) VALUES
(6, 'juan dela cruz', 'juan', 'a94652aa97c7211ba8954dd15a3cf838', 2);

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
(6, 'Coffee', 'Coffee'),
(7, 'Fruit Juice', 'Fruit Juice'),
(8, 'Pasta', 'Pasta'),
(9, 'Iced Coffee', 'Cold'),
(10, 'Hot Coffee', 'Hot '),
(11, 'Cake', 'Cake'),
(12, 'Combo', 'Combo'),
(13, 'Premium Coffee', 'premium'),
(14, 'PROMOS', 'CHRISTMAS'),
(21, 'joyjoy', 'joyjoy');

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
  `cost` varchar(255) NOT NULL,
  `qty` int(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `stocks` int(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `expiration_date` date NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ingredients`
--

INSERT INTO `ingredients` (`id`, `category_id`, `name`, `cost`, `qty`, `total`, `stocks`, `unit`, `expiration_date`, `status`) VALUES
(25, 7, 'Okinawa Powder', '0', 0, '0', 1500, 'grams', '2025-09-09', 1),
(26, 7, 'Wintermelon Powder', '0', 0, '0', 1611, '', '2023-09-04', 1),
(27, 9, 'Orange Juice', '0', 0, '0', 1000, '', '2023-06-15', 1),
(28, 9, 'Mango', '0', 0, '0', 7222, '', '2025-09-22', 1),
(29, 7, 'Chocolate Powder', '0', 0, '0', 1000, '', '2023-06-08', 1),
(30, 10, 'Coffee', '0', 0, '0', 1000, '', '2023-07-26', 1),
(31, 7, 'Matcha', '0', 0, '0', 3000, '', '2023-08-12', 1),
(32, 9, 'Four Season Powder', '0', 0, '0', 2000, '', '2023-08-04', 1),
(33, 10, 'Italian Coffee', '0', 0, '0', 2000, '', '2023-07-26', 1),
(34, 10, 'kopi', '0', 0, '0', 3000, 'ml', '2025-11-11', 1),
(35, 6, 'try', '0', 0, '0', 200, '', '2023-10-07', 1),
(36, 10, 'expi', '0', 0, '0', 2310, 'ml', '2025-02-02', 1),
(38, 9, 'Juicy', '0', 0, '0', 200, '', '2024-09-01', 1),
(39, 9, 'dsdasd', '0', 0, '0', 100, '', '2024-09-09', 1),
(40, 9, 'amoycanton', '0', 0, '0', 1115, 'grams', '2025-09-22', 1),
(41, 8, 'tetete', '0', 0, '0', 502, 'grams', '2025-09-09', 1),
(42, 9, 'tetete', '0', 0, '0', 2222, 'grams', '2025-02-22', 1),
(43, 8, 'Milky Milky', '100', 23, '0', 1090, 'ml', '2025-09-09', 1),
(44, 10, 'nescafestick', '80', 20, '1600', 1909, 'ml', '2026-09-20', 1),
(45, 6, 'sysyrup', '100.69', 54, '5437.26', 1111, 'grams', '2025-01-01', 1),
(46, 8, 'NON-FAT', '120', 4, '480', 4000, 'ml', '2023-10-21', 1);

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
  `void` int(255) NOT NULL,
  `payment_mode` varchar(255) NOT NULL DEFAULT 'cash'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `ref_no`, `total_amount`, `amount_tendered`, `customer_name`, `date_created`, `user`, `void`, `payment_mode`) VALUES
(113, '966612543918', 75, 100, 'Alexandra Marie Sy', '2023-05-27 16:01:48', 'admin', 0, 'gcash'),
(114, '811308032006', 180, 200, 'Mary Joy Casiquin', '2023-05-27 19:54:43', 'admin', 0, 'cash'),
(115, '090135129158', 150, 200, 'Justine reyes', '2023-05-27 19:55:07', 'admin', 0, 'cash'),
(116, '446669742575', 405, 500, 'Anne Cruz', '2023-05-27 19:56:22', 'admin', 0, 'cash'),
(117, '809034472957', 225, 300, 'John Mark', '2023-05-27 19:58:20', 'staff', 0, 'gcash'),
(118, '740168921756', 400, 400, 'Catherine Sino', '2023-05-28 10:36:05', 'admin', 0, 'gcash'),
(119, '105190357259', 635, 700, 'Marco PJ ', '2023-05-28 10:41:57', 'admin', 0, 'gcash'),
(121, '576431897487', 315, 400, 'Jay Ivan', '2023-05-28 10:44:26', 'admin', 0, 'cash'),
(122, '649249101594', 750, 800, 'Julie Senerado', '2023-05-28 16:24:08', 'admin', 0, 'cash'),
(123, '962949058874', 250, 500, 'Maria Abbigail', '2023-05-29 13:48:23', 'admin', 0, 'gcash'),
(124, '902447434192', 620, 1000, 'Jay mark ', '2023-05-29 13:49:43', 'staff', 0, 'cash'),
(125, '976449350159', 200, 200, 'Marco Jose', '2023-05-29 13:51:24', 'staff', 0, 'cash'),
(126, '366014162454', 250, 250, 'Justine', '2023-05-30 13:46:28', 'admin', 0, 'gcash'),
(127, '982209449365', 380, 380, 'Felise Viloria', '2023-05-30 13:55:05', 'admin', 0, 'cash'),
(128, '775609241264', 285, 300, 'Arianna G', '2023-05-30 13:57:30', 'admin', 0, 'cash'),
(129, '058767504477', 95, 100, 'Mj Casiquin', '2023-05-30 14:33:18', 'admin', 0, 'cash'),
(131, '691231050595', 95, 100, 'alex', '2023-09-19 11:20:53', 'admin', 0, 'cash'),
(132, '285999233871', 1185, 1000, 'rine', '2023-09-19 11:22:01', 'admin', 0, 'gcash'),
(133, '736962570409', 200, 200, 'mimi', '2023-09-19 12:02:48', 'admin', 0, 'gcash'),
(134, '120125917141', 200, 200, 'mimi', '2023-09-19 12:02:48', 'admin', 0, 'gcash'),
(135, '647073298321', 500, 500, 'hhe', '2023-09-19 12:03:23', 'admin', 0, 'gcash'),
(136, '105891614008', 500, 500, 'hhe', '2023-09-19 12:03:23', 'admin', 0, 'gcash'),
(137, '443616942323', 225, 400, 'gege', '2023-09-19 12:05:15', 'admin', 0, 'gcash'),
(138, '129715608640', 300, 300, 'sdvsd', '2023-09-19 12:05:39', 'admin', 0, 'gcash'),
(139, '801136032226', 300, 300, 'sdvsd', '2023-09-19 12:05:39', 'admin', 0, 'gcash'),
(140, '767097231689', 150, 200, 'dcsvdv', '2023-09-19 12:06:03', 'admin', 0, 'gcash'),
(141, '927020093445', 300, 300, 'ef', '2023-09-19 12:06:44', 'admin', 0, 'gcash'),
(142, '149614472079', 75, 100, 'df', '2023-09-19 12:08:10', 'admin', 0, 'gcash'),
(143, '942940049252', 75, 100, 'df', '2023-09-19 12:08:10', 'admin', 0, 'gcash'),
(144, '887262379938', 800, 1000, 'hahaha', '2023-09-19 12:15:45', 'admin', 0, 'gcash'),
(145, '439535032545', 800, 1000, 'sys', '2023-09-19 12:17:00', 'admin', 0, 'gcash'),
(146, '004103291473', 300, 300, 'gfg', '2023-09-19 12:19:26', 'admin', 0, 'gcash'),
(147, '344131700312', 300, 300, 'gfg', '2023-09-19 12:19:26', 'admin', 0, 'gcash'),
(148, '007550479160', 100, 0, 'assad', '2023-09-19 12:20:11', 'admin', 0, 'gcash'),
(149, '522413099780', 100, 100, 'hehehe', '2023-09-19 12:25:17', 'admin', 0, 'gcash'),
(150, '258265483715', 1125, 1500, 'noynoy', '2023-09-19 13:41:44', 'admin', 0, 'gcash'),
(151, '538278281619', 200, 11, 'testtttt', '2023-09-19 13:47:30', 'admin', 0, 'gcash'),
(152, '874678088763', 100, 400, 'test', '2023-09-19 13:51:57', 'admin', 0, 'gcash'),
(153, '153353767469', 100, 0, 'jghgh', '2023-09-19 13:52:07', 'admin', 0, 'gcash'),
(154, '199724215425', 100, 0, 't', '2023-09-19 13:52:33', 'admin', 0, 'gcash'),
(155, '207071863928', 100, 200, 'mwemwemwe', '2023-09-19 13:55:10', 'admin', 0, 'gcash'),
(156, '598854480834', 1200, 2500, 'ssss', '2023-09-19 13:55:42', 'admin', 0, 'gcash'),
(157, '988378428212', 100, 200, 'ss', '2023-09-19 14:18:51', 'admin', 0, 'gcash'),
(158, '998181577518', 300, 0, '', '2023-09-19 14:56:12', 'admin', 0, 'gcash'),
(159, '173978703208', 300, 0, '', '2023-09-19 14:56:12', 'admin', 0, 'gcash'),
(160, '654374787103', 100, 0, 'sss', '2023-09-19 15:02:18', 'admin', 0, 'gcash'),
(161, '514535813538', 100, 0, 'sss', '2023-09-19 15:02:19', 'admin', 0, 'gcash'),
(162, '633265749420', 76, 100, 'ss', '2023-09-19 17:06:46', 'admin', 0, 'gcash'),
(163, '171932475286', 65, 100, 'aa', '2023-10-03 12:52:27', 'admin', 0, 'gcash'),
(164, '337742629120', 100, 300, 'dfgsdfgsdf', '2023-10-03 13:16:50', 'admin', 0, 'gcash'),
(165, '990496775480', 95, 100, 'ssd', '2023-10-03 13:48:59', 'admin', 0, 'gcash'),
(166, '426855842220', 120, 1000, 'sasdaweqwe', '2023-10-03 14:38:49', 'admin', 0, 'gcash'),
(167, '569196341372', 65, 1000, 'cvcvc', '2023-10-06 18:56:30', 'admin', 0, 'cash'),
(168, '316152716706', 100, 1000, 'boss G', '2023-10-06 19:11:42', 'staff', 0, 'gcash'),
(169, '790397456796', 300, 300, 'hkljkm,.m.,jpio', '2023-10-06 23:11:48', 'admin', 0, 'gcash'),
(170, '034056862225', 200, 200, 'cashcash', '2023-10-07 01:25:38', 'cashier1', 0, 'gcash'),
(171, '984761341107', 65, 100, 'gsdass', '2023-10-07 01:25:59', 'cashier1', 0, 'cash'),
(172, '562307776787', 95, 100, 'sddasdsdweqweq', '2023-10-07 01:26:31', 'cashier2', 0, 'gcash'),
(173, '810560952048', 85, 100, 'ssssssss', '2023-10-07 01:26:45', 'cashier2', 0, 'gcash'),
(174, '375191056203', 200, 200, 'aaa', '2023-10-11 03:11:08', 'staff', 0, 'cash'),
(175, '602461156046', 100, 300, 'bb', '2023-10-11 03:15:46', 'staff', 0, 'gcash'),
(176, '030284993788', 100, 300, 'bb', '2023-10-11 03:15:46', 'staff', 0, 'gcash'),
(177, '259389589088', 260, 300, 'cvc', '2023-10-11 03:17:48', 'staff', 0, 'cash'),
(178, '556805039259', 400, 1000, 'l', '2023-10-11 04:58:15', 'staff', 0, 'cash'),
(179, '871586221943', 65, 100, 'plplpl', '2023-10-11 05:05:05', 'cashier2', 0, 'cash');

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
(213, 162, 122, 1, 95, 95),
(214, 163, 121, 1, 65, 65),
(215, 164, 118, 1, 100, 100),
(216, 165, 122, 1, 95, 95),
(217, 166, 126, 1, 120, 120),
(218, 167, 121, 1, 65, 65),
(219, 168, 124, 1, 100, 100),
(220, 169, 118, 3, 100, 300),
(221, 170, 118, 1, 100, 100),
(222, 170, 120, 1, 100, 100),
(223, 171, 121, 1, 65, 65),
(224, 172, 119, 1, 95, 95),
(225, 173, 117, 1, 85, 85),
(226, 174, 118, 2, 100, 200),
(227, 175, 118, 1, 100, 100),
(228, 176, 118, 1, 100, 100),
(229, 177, 121, 4, 65, 260),
(230, 178, 118, 4, 100, 400),
(231, 179, 121, 1, 65, 65);

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
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0=Unavailable,1=Available',
  `image` varchar(255) NOT NULL,
  `expiration_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `description`, `price`, `status`, `image`, `expiration_date`) VALUES
(117, 5, 'Wintermelon', 'wintermelon', 85, 1, '1685188200_kape.jpg', '2023-05-27'),
(118, 10, 'Amerikano', 'amerikano', 100, 1, '1685188380_hot coffee.jpg', '2023-05-27'),
(119, 9, 'White Chocolate ', 'white chocolate', 95, 1, '1685241480_348825790_790031692652606_5186885915670577889_n.jpg', '2023-05-27'),
(120, 5, 'Matcha', 'matcha', 100, 1, '1685241240_4.jpg', '2023-05-28'),
(121, 7, 'Four Season ', '4 season', 65, 1, '1685241660_4season.jpg', '2023-05-28'),
(122, 13, 'Italian Coffee', 'strong, bitter coffee', 95, 1, '1685425380_hot coffee.jpg', '2023-05-30'),
(129, 7, 'Test', 'dsdsds', 11111, 1, '1696316100_speed.jpg', '2023-10-03');

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
(104, 117, 26, 100),
(105, 118, 30, 20),
(107, 120, 31, 45),
(108, 121, 32, 30),
(109, 122, 33, 15),
(114, 129, 46, 0);

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
  `type` tinyint(1) NOT NULL DEFAULT 3 COMMENT '1=Admin,2=Staff',
  `status` varchar(255) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `type`, `status`) VALUES
(1, 'admin', 'admin', '0192023a7bbd73250516f069df18b500', 1, 'active'),
(5, 'staff', 'staff', 'de9bf5643eabf80f4a56fda3bbb84483', 2, 'active'),
(7, 'Joy', 'joycasiquin', 'c2c8e798aecbc26d86e4805114b03c51', 2, 'active'),
(8, 'cashier1', 'cashier1', '136989baac262ea3f560297aab280c8d', 2, 'active'),
(9, 'cashier2', 'cashier2', '0060e5ef773960fd63b2a7d9a35bd8eb', 2, 'active'),
(10, 'test', 'test', 'cc03e747a6afbbcbf8be7668acfebee5', 2, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `user_log`
--

CREATE TABLE `user_log` (
  `id` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `log_in` datetime NOT NULL DEFAULT current_timestamp(),
  `log_out` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_log`
--

INSERT INTO `user_log` (`id`, `user_id`, `log_in`, `log_out`) VALUES
(3, 1, '2023-10-03 10:48:08', '2023-10-03 10:48:11'),
(4, 5, '2023-10-03 10:48:22', '2023-10-03 10:48:34'),
(5, 1, '2023-10-03 10:48:53', '2023-10-03 10:48:57'),
(6, 1, '2023-10-03 10:49:24', '2023-10-06 13:10:40'),
(7, 1, '2023-10-06 12:52:01', '2023-10-06 13:10:40'),
(8, 5, '2023-10-06 13:10:45', '2023-10-06 13:12:03'),
(9, 1, '2023-10-06 13:12:06', '2023-10-06 17:57:03'),
(10, 1, '2023-10-06 16:13:21', '2023-10-06 17:57:03'),
(11, 1, '2023-10-06 16:17:45', '2023-10-06 17:57:03'),
(12, 5, '2023-10-06 17:57:11', '2023-10-06 19:15:16'),
(13, 1, '2023-10-06 19:15:19', '2023-10-06 19:15:55'),
(14, 5, '2023-10-06 19:15:59', '2023-10-06 19:16:16'),
(15, 1, '2023-10-06 19:16:24', '2023-10-06 19:16:55'),
(16, 5, '2023-10-06 19:17:01', '2023-10-06 19:18:29'),
(17, 1, '2023-10-06 19:18:32', '2023-10-06 19:20:58'),
(18, 5, '2023-10-06 19:21:03', '2023-10-06 19:21:50'),
(19, 1, '2023-10-06 19:21:54', '2023-10-06 19:22:02'),
(20, 5, '2023-10-06 19:22:07', '2023-10-06 19:22:42'),
(21, 5, '2023-10-06 19:22:50', '2023-10-06 19:23:30'),
(22, 1, '2023-10-06 19:23:39', '2023-10-06 19:23:55'),
(23, 5, '2023-10-06 19:24:00', '2023-10-06 19:24:13'),
(24, 1, '2023-10-06 19:24:18', '2023-10-06 19:25:07'),
(25, 8, '2023-10-06 19:25:11', '2023-10-06 19:26:06'),
(26, 9, '2023-10-06 19:26:12', '2023-10-06 19:34:17'),
(27, 8, '2023-10-06 19:34:25', '2023-10-06 19:36:18'),
(28, 9, '2023-10-06 19:36:23', '2023-10-06 21:12:33'),
(29, 1, '2023-10-06 21:12:46', '2023-10-06 21:17:39'),
(30, 8, '2023-10-06 21:17:48', '2023-10-06 21:18:11'),
(31, 1, '2023-10-06 21:18:21', '2023-10-06 22:01:14'),
(32, 1, '2023-10-06 21:28:12', '2023-10-06 22:01:14'),
(33, 1, '2023-10-06 22:01:45', '2023-10-06 22:01:57'),
(34, 9, '2023-10-06 22:02:04', '2023-10-06 22:05:33'),
(35, 1, '2023-10-06 22:05:19', '2023-10-06 22:10:41'),
(36, 9, '2023-10-06 22:05:45', '2023-10-06 22:08:46'),
(37, 5, '2023-10-06 22:09:51', '2023-10-06 22:10:22'),
(38, 1, '2023-10-06 22:10:28', '2023-10-06 22:10:41'),
(39, 1, '2023-10-06 22:10:51', '2023-10-06 22:22:53'),
(40, 1, '2023-10-06 22:23:43', '2023-10-08 10:59:56'),
(41, 1, '2023-10-08 10:59:30', '2023-10-08 10:59:56'),
(42, 5, '2023-10-08 11:00:02', '2023-10-08 11:00:58'),
(43, 1, '2023-10-08 11:01:03', '2023-10-10 21:09:21'),
(44, 1, '2023-10-09 07:17:05', '2023-10-10 21:09:21'),
(45, 1, '2023-10-10 21:09:14', '2023-10-10 21:09:21'),
(46, 5, '2023-10-10 21:09:36', '2023-10-10 21:10:25'),
(47, 1, '2023-10-10 21:10:29', '2023-10-10 21:10:36'),
(48, 5, '2023-10-10 21:10:41', '2023-10-10 21:19:30'),
(49, 1, '2023-10-10 21:22:16', '2023-10-10 21:22:27'),
(50, 5, '2023-10-10 21:22:32', '2023-10-10 21:22:55'),
(51, 1, '2023-10-10 21:23:06', '2023-10-10 21:36:33'),
(52, 5, '2023-10-10 21:36:42', '2023-10-10 21:38:29'),
(53, 1, '2023-10-10 21:38:34', '2023-10-10 21:39:30'),
(54, 5, '2023-10-10 21:39:35', '2023-10-10 23:04:32'),
(55, 9, '2023-10-10 23:04:41', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `void`
--

CREATE TABLE `void` (
  `void_id` int(255) NOT NULL,
  `user` varchar(255) NOT NULL,
  `void_amount` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `void`
--

INSERT INTO `void` (`void_id`, `user`, `void_amount`, `date`) VALUES
(1, 'staff', '', '2023-10-11 04:28:37'),
(2, 'staff', '', '0000-00-00 00:00:00'),
(3, '', '', '0000-00-00 00:00:00');

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
-- Indexes for table `user_log`
--
ALTER TABLE `user_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id_fk` (`user_id`);

--
-- Indexes for table `void`
--
ALTER TABLE `void`
  ADD PRIMARY KEY (`void_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `archieve_categories`
--
ALTER TABLE `archieve_categories`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `archieve_products`
--
ALTER TABLE `archieve_products`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `categories_inventory`
--
ALTER TABLE `categories_inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=232;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `product_ingredients`
--
ALTER TABLE `product_ingredients`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

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
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_log`
--
ALTER TABLE `user_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `void`
--
ALTER TABLE `void`
  MODIFY `void_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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

--
-- Constraints for table `user_log`
--
ALTER TABLE `user_log`
  ADD CONSTRAINT `user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
