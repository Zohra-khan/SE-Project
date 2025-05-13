-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2025 at 11:17 AM
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
-- Database: `soidhaga-products`
--

-- --------------------------------------------------------

--
-- Table structure for table `card_info`
--

CREATE TABLE `card_info` (
  `id` int(11) NOT NULL,
  `cardholder_name` varchar(100) NOT NULL,
  `card_number` varchar(20) NOT NULL,
  `expiry_month` varchar(25) NOT NULL,
  `expiry_year` varchar(4) NOT NULL,
  `security_code` varchar(4) NOT NULL,
  `postal_code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `card_info`
--

INSERT INTO `card_info` (`id`, `cardholder_name`, `card_number`, `expiry_month`, `expiry_year`, `security_code`, `postal_code`) VALUES
(13, 'njonmo', '219123123123123', '03', '2027', '183', '6483'),
(14, 'mw', '017212341234123', '11', '2034', '7593', '5002');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `product_code` varchar(255) DEFAULT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `size` varchar(3) NOT NULL,
  `total_price` int(11) DEFAULT NULL,
  `session_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `product_code`, `price`, `quantity`, `size`, `total_price`, `session_id`) VALUES
(68, 'SKU:7218-RA1A-Default', 21990, 2, 'M', 21990, 'pb8u5q9pcr19jior0hu02c68vg');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `coupon_code` varchar(50) NOT NULL,
  `discount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`coupon_code`, `discount`) VALUES
('SEproj', 0.5);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `street_address` varchar(255) NOT NULL,
  `country` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `zip` int(11) NOT NULL,
  `payment_method` enum('credit card','paypal','cod') NOT NULL,
  `coupon_code` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `first_name`, `last_name`, `phone_number`, `email`, `street_address`, `country`, `city`, `state`, `zip`, `payment_method`, `coupon_code`) VALUES
(50, 'Zohra', 'Khan', '03006956787', 'fast@gmail.com', 'raza block', 'pakistan', 'lahore', 'lahore', 901, 'cod', 'SEproj'),
(51, 'new', 'khan', '03448695743', 'mjoljnlj@gmail.com', 'mjoln', 'nj', 'kl', 'nji', 786, 'cod', NULL),
(52, 'new', 'khan', '03448695743', 'mjoljnlj@gmail.com', 'mjoln', 'nj', 'kl', 'nji', 786, 'cod', 'SEproj'),
(53, 'new', 'khan', '03448695743', 'mjoljnlj@gmail.com', 'mjoln', 'nj', 'kl', 'nji', 549, 'cod', 'SEproj'),
(54, 'qeio', 'kjnjol', '03006956787', 'mcieo@gmail.com', 'cmwio8', 'mdewo', 'mjwek', 'wmk', 5400, 'paypal', 'SEproj'),
(55, 'new', 'khan', '03448695743', 'mfgiowrjmiwpf@gmail.com', 'cmwio8', 'nj', 'kl', 'nji', 786, 'cod', 'SEproj'),
(56, 'mion', 'kjnjol', '03006956787', 'mjoljnlj@gmail.com', 'cmwio8', 'nj', 'kl', 'nji', 786, 'credit card', 'SEproj'),
(57, 'mion', 'khan', '03448695743', 'mkwe@gmail.com', 'cmwio8', 'nj', 'mjwek', 'wmk', 6855, 'paypal', 'SEproj');

-- --------------------------------------------------------

--
-- Table structure for table `customer_care`
--

CREATE TABLE `customer_care` (
  `complaint_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `complaint` text NOT NULL,
  `response` text DEFAULT NULL,
  `is_responded` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `responded_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_care`
--

INSERT INTO `customer_care` (`complaint_id`, `first_name`, `last_name`, `email`, `complaint`, `response`, `is_responded`, `created_at`, `responded_at`) VALUES
(11, 'fme', 'mdksl', 'mkwe@gmail.com', 'k sd', NULL, 0, '2025-05-06 19:22:02', NULL),
(12, 'fme', 'mdksl', 'mkwe@gmail.com', 'k sd', NULL, 0, '2025-05-06 19:23:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `newsletter`
--

CREATE TABLE `newsletter` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `newsletter`
--

INSERT INTO `newsletter` (`id`, `email`) VALUES
(4, 'best@gmail.com'),
(10, 'cj@gmail.com'),
(5, 'fast@gmail.com'),
(3, 'happy@gmail.com'),
(1, 'l226976@lhr.nu.edu.pk'),
(9, 'mfgiowrjmiwpf@gmail.com'),
(8, 'mjoljnlj@gmail.com'),
(11, 'mkwe@gmail.com'),
(2, 'newmail@gmail.com'),
(7, 'sibgha@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `category` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `URL1` text NOT NULL,
  `URL2` text NOT NULL,
  `URL3` text NOT NULL,
  `URL4` text NOT NULL,
  `details` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`name`, `code`, `quantity`, `price`, `category`, `type`, `URL1`, `URL2`, `URL3`, `URL4`, `details`) VALUES
('Caela-7A', 'SKU: 7218-CA3A-Default', 1000, 20990, 'PrintKari', 'Lawn', 'caela-1.png', 'caela-2.png', 'caela-3.png', 'caela-4.png', '1.Top\n\nPrinted embroidered front\nPrinted embroidered back\nPrinted embroidered sleeves\nPrinted embroidered neck patti\n\n2.Bottom\n\nDyed cotton embroidered trouser\n\n3.Dupatta\n\nDyed voile embroidered dupatta with embroidered pallu border'),
('Elowen-5A', 'SKU: 7218-EO3A-Default', 1000, 22990, 'PrintKari', 'Cambric', 'elowen-1.png', 'elowen-2.png', 'elowen-3.png', 'elowen-4.png', '1.Top\r\n\r\nPrinted embroidered front\r\nPrinted embroidered back\r\nPrinted embroidered sleeves\r\nPrinted embroidered neck patti\r\n\r\n2.Bottom\r\n\r\nDyed cotton embroidered trouser\r\n\r\n3.Dupatta\r\n\r\nDyed voile embroidered dupatta with embroidered pallu border'),
('Hikari-7A', 'SKU: 7218-HI1A-Default', 1000, 20990, 'LawnKari', 'Lawn', 'hikari-1.png', 'hikari-2.png', 'hikari-3.png', 'hikari-4.png', '1. Top\r\n\r\nEmbroidered lawn front\r\nEmbroidered lawn back\r\nEmbroidered lawn sleeves\r\nEmbroidered lawn neck patti\r\n\r\n2. Bottom\r\n\r\nDyed cotton embroidered trouser\r\n\r\n3. Dupatta\r\n\r\nDyed voile embroidered dupatta with embroidered pallu border'),
('Kaori-8A', 'SKU: 7218-KA1A-Default', 1000, 21990, 'LawnKari', 'Lawn', 'kaori-1.png', 'kaori-2.png', 'kaori-3.png', 'kaori-4.png', '1. Top\r\n\r\nEmbroidered lawn front\r\nEmbroidered lawn back\r\nEmbroidered lawn sleeves\r\nEmbroidered lawn neck patti\r\n\r\n2. Bottom\r\n\r\nDyed cotton embroidered trouser\r\n\r\n3. Dupatta\r\n\r\nDyed voile embroidered dupatta with embroidered pallu border'),
('Liora-8A', 'SKU: 7218-LO3A-Default', 1000, 22990, 'PrintKari', 'Cambric', 'liora-1.png', 'liora-2.png', 'liora-3.png', 'liora-4.png', '1.Top\r\n\r\nPrinted embroidered front\r\nPrinted embroidered back\r\nPrinted embroidered sleeves\r\nPrinted embroidered neck patti\r\n\r\n2.Bottom\r\n\r\nDyed cotton embroidered trouser\r\n\r\n3.Dupatta\r\n\r\nDyed voile embroidered dupatta with embroidered pallu border'),
('Mei-9A', 'SKU: 7218-MA1A-Default', 1000, 22990, 'LawnKari', 'Lawn', 'mei-1.png', 'mei-2.png', 'mei-3.png', 'mei-4.png', '1. Top\r\n\r\nEmbroidered lawn front\r\nEmbroidered lawn back\r\nEmbroidered lawn sleeves\r\nEmbroidered lawn neck patti\r\n\r\n2. Bottom\r\n\r\nDyed cotton embroidered trouser\r\n\r\n3. Dupatta\r\n\r\nDyed voile embroidered dupatta with embroidered pallu border'),
('Mitsuki-6A', 'SKU: 7218-MI1A-Default', 1000, 17990, 'LawnKari', 'Lawn', 'mitsuki-1.png', 'mitsuki-2.png', 'mitsuki-3.png', 'mitsuki-4.png', '1. Top\r\n\r\nEmbroidered lawn front\r\nEmbroidered lawn back\r\nEmbroidered lawn sleeves\r\nEmbroidered lawn neck patti\r\n\r\n2. Bottom\r\n\r\nDyed cotton embroidered trouser\r\n\r\n3. Dupatta\r\n\r\nDyed voile embroidered dupatta with embroidered pallu border'),
('Mirelle-3A', 'SKU: 7218-MO3A-Default', 1000, 22990, 'PrintKari', 'Cambric', 'mirelle-1.png', 'mirelle-2.png', 'mirelle-3.png', 'mirelle-4.png', '1.Top\r\n\r\nPrinted embroidered front\r\nPrinted embroidered back\r\nPrinted embroidered sleeves\r\nPrinted embroidered neck patti\r\n\r\n2.Bottom\r\n\r\nDyed cotton embroidered trouser\r\n\r\n3.Dupatta\r\n\r\nDyed voile embroidered dupatta with embroidered pallu border'),
('Shizumi-4A', 'SKU: 7218-SH1A-Default', 1000, 20990, 'LawnKari', 'Lawn', 'shizumi-1.png', 'shizumi-2.png', 'shizumi-3.png', 'shizumi-4.png', '1. Top\r\n\r\nEmbroidered lawn front\r\nEmbroidered lawn back\r\nEmbroidered lawn sleeves\r\nEmbroidered lawn neck patti\r\n\r\n2. Bottom\r\n\r\nDyed cotton embroidered trouser\r\n\r\n3. Dupatta\r\n\r\nDyed voile embroidered dupatta with embroidered pallu border'),
('Solenya-3A', 'SKU: 7218-SO3A-Default', 1000, 22990, 'PrintKari', 'Cambric', 'solenya-1.png', 'solenya-2.png', 'solenya-3.png', 'solenya-4.png', '1.Top\r\n\r\nPrinted embroidered front\r\nPrinted embroidered back\r\nPrinted embroidered sleeves\r\nPrinted embroidered neck patti\r\n\r\n2.Bottom\r\n\r\nDyed cotton embroidered trouser\r\n\r\n3.Dupatta\r\n\r\nDyed voile embroidered dupatta with embroidered pallu border'),
('Sorae-4A', 'SKU: 7218-SR4A-Default', 1000, 22990, 'PrintKari', 'Cambric', 'soraye-1.png', 'soraye-2.png', 'soraye-3.png', 'soraye-4.png', '1.Top\r\n\r\nPrinted embroidered front\r\nPrinted embroidered back\r\nPrinted embroidered sleeves\r\nPrinted embroidered neck patti\r\n\r\n2.Bottom\r\n\r\nDyed cotton embroidered trouser\r\n\r\n3.Dupatta\r\n\r\nDyed voile embroidered dupatta with embroidered pallu border'),
('Umi-6A', 'SKU: 7218-UM1A-Default', 1000, 19990, 'LawnKari', 'Lawn', 'umi-1.png', 'umi-2.png', 'umi-3.png', 'umi-4.png', '1. Top\r\n\r\nEmbroidered lawn front\r\nEmbroidered lawn back\r\nEmbroidered lawn sleeves\r\nEmbroidered lawn neck patti\r\n\r\n2. Bottom\r\n\r\nDyed cotton embroidered trouser\r\n\r\n3. Dupatta\r\n\r\nDyed voile embroidered dupatta with embroidered pallu border'),
('Zephyra-9A', 'SKU: 7218-ZA3A-Default', 1000, 22990, 'PrintKari', 'Cambric', 'zephyr-1.png', 'zephyr-2.png', 'zephyr-4.png', 'zephyr-3.png', '1.Top\r\n\r\nPrinted embroidered front\r\nPrinted embroidered back\r\nPrinted embroidered sleeves\r\nPrinted embroidered neck patti\r\n\r\n2.Bottom\r\n\r\nDyed cotton embroidered trouser\r\n\r\n3.Dupatta\r\n\r\nDyed voile embroidered dupatta with embroidered pallu border'),
('Auristal-1A', 'SKU: BD18-AU3A-Default', 100, 220000, 'LuxuryKari', 'Silk', 'Auristal-1.png', 'Auristal-2.png', 'Auristal-3.png', 'Auristal-4.png', '1. Kameez\r\n\r\n- Heavily embroidered front and back\r\n- Handcrafted zardozi and sequin detailing\r\n- Intricately embroidered sleeves\r\n- Embellished neckline with stonework and gota patti\r\n\r\n2. Bottoms\r\n\r\n- Richly embroidered panelled Lehenga\r\n- Intricate zari, resham, and mirror embellishments\r\n- Can-can lining for added flare and volume\r\n\r\n3. Dupatta\r\n\r\n- Embroidered net or chiffon dupatta\r\n- Heavy borders on all sides\r\n- Delicate bootis and sequins scattered throughout'),
('Caelora-2A', 'SKU: BD18-CA3A-Default', 1000, 210000, 'LuxuryKari', 'Silk', 'Caelora-1.png', 'Caelora-2.png', 'Caelora-3.png', 'Caelora-4.png', '1. Kameez\n\n- Heavily embroidered front and back\n- Handcrafted zardozi and sequin detailing\n- Intricately embroidered sleeves\n- Embellished neckline with stonework and gota patti\n\n2. Bottoms\n\n- Richly embroidered panelled Lehenga\n- Intricate zari, resham, and mirror embellishments\n- Can-can lining for added flare and volume\n\n3. Dupatta\n\n- Embroidered net or chiffon dupatta\n- Heavy borders on all sides\n- Delicate bootis and sequins scattered throughout'),
('Elysora-6A', 'SKU: BD18-EL3A-Default', 100, 210000, 'LuxuryKari', 'Silk', 'Elysora-1.png', 'Elysora-2.png', 'Elysora-3.png', 'Elysora-4.png', '1. Kameez\r\n\r\n- Heavily embroidered front and back\r\n- Handcrafted zardozi and sequin detailing\r\n- Intricately embroidered sleeves\r\n- Embellished neckline with stonework and gota patti\r\n\r\n2. Bottoms\r\n\r\n- Richly embroidered panelled Lehenga\r\n- Intricate zari, resham, and mirror embellishments\r\n- Can-can lining for added flare and volume\r\n\r\n3. Dupatta\r\n\r\n- Embroidered net or chiffon dupatta\r\n- Heavy borders on all sides\r\n- Delicate bootis and sequins scattered throughout'),
('Lunavia-6A', 'SKU: BD18-LU3A-Default', 10, 210000, 'LuxuryKari', 'Silk', 'Lunavia-1.png', 'Lunavia-2.png', 'Lunavia-3.png', 'Lunavia-4.png', '. Kameez\r\n\r\n- Heavily embroidered front and back\r\n- Handcrafted zardozi and sequin detailing\r\n- Intricately embroidered sleeves\r\n- Embellished neckline with stonework and gota patti\r\n\r\n2. Bottoms\r\n\r\n- Richly embroidered panelled Lehenga\r\n- Intricate zari, resham, and mirror embellishments\r\n- Can-can lining for added flare and volume\r\n\r\n3. Dupatta\r\n\r\n- Embroidered net or chiffon dupatta\r\n- Heavy borders on all sides\r\n- Delicate bootis and sequins scattered throughout'),
('Marvessa-10A', 'SKU: BD18-MA3A-Default', 10, 190000, 'LuxuryKari', 'Silk', 'Marvessa-1.png', 'Marvessa-2.png', 'Marvessa-3.png', 'Marvessa-4.png', '1. Kameez\r\n\r\n- Heavily embroidered front and back\r\n- Handcrafted zardozi and sequin detailing\r\n- Intricately embroidered sleeves\r\n- Embellished neckline with stonework and gota patti\r\n\r\n2. Bottoms\r\n\r\n- Richly embroidered panelled Trouser\r\n- Intricate zari, resham, and mirror embellishments\r\n- Can-can lining for added flare and volume\r\n\r\n3. Dupatta\r\n\r\n- Embroidered net or chiffon dupatta\r\n- Heavy borders on all sides\r\n- Delicate bootis and sequins scattered throughout'),
('Opulisse-2A', 'SKU: BD18-OP3A-Default', 100, 220000, 'LuxuryKari', 'Silk', 'Opulisse-1.png', 'Opulisse-2.png', 'Opulisse-3.png', 'Opulisse-4.png', '1. Kameez\r\n\r\n- Heavily embroidered front and back\r\n- Handcrafted zardozi and sequin detailing\r\n- Intricately embroidered sleeves\r\n- Embellished neckline with stonework and gota patti\r\n\r\n2. Bottoms\r\n\r\n- Richly embroidered panelled Lehenga\r\n- Intricate zari, resham, and mirror embellishments\r\n- Can-can lining for added flare and volume\r\n\r\n3. Dupatta\r\n\r\n- Embroidered net or chiffon dupatta\r\n- Heavy borders on all sides\r\n- Delicate bootis and sequins scattered throughout'),
('Seraphine-4A', 'SKU: BD18-SR3A-Default', 10, 200000, 'LuxuryKari', 'Silk', 'Seraphine-1.png', 'Seraphine-2.png', 'Seraphine-3.png', 'Seraphine-4.png', '1. Kameez\r\n\r\n- Heavily embroidered front and back\r\n- Handcrafted zardozi and sequin detailing\r\n- Intricately embroidered sleeves\r\n- Embellished neckline with stonework and gota patti\r\n\r\n2. Bottoms\r\n\r\n- Richly embroidered panelled Sharara\r\n- Intricate zari, resham, and mirror embellishments\r\n- Can-can lining for added flare and volume\r\n\r\n3. Dupatta\r\n\r\n- Embroidered net or chiffon dupatta\r\n- Heavy borders on all sides\r\n- Delicate bootis and sequins scattered throughout'),
('Velisse-6A', 'SKU: BD18-VE3A-Default', 100, 190000, 'LuxuryKari', 'Silk', 'Velisse-1.png', 'Velisse-2.png', 'Velisse-3.png', 'Velisse-4.png', '1. Kameez\r\n\r\n- Heavily embroidered front and back\r\n- Handcrafted zardozi and sequin detailing\r\n- Intricately embroidered sleeves\r\n- Embellished neckline with stonework and gota patti\r\n\r\n2. Bottoms\r\n\r\n- Richly embroidered panelled Farshi Shalwar\r\n- Intricate zari, resham, and mirror embellishments\r\n- Can-can lining for added flare and volume\r\n\r\n3. Dupatta\r\n\r\n- Embroidered net or chiffon dupatta\r\n- Heavy borders on all sides\r\n- Delicate bootis and sequins scattered throughout'),
('Veloura-7A', 'SKU: BD18-VL7A-Default', 100, 230000, 'LuxuryKari', 'Silk', 'Veloura-1.png', 'Veloura-2.png', 'Veloura-3.png', 'Veloura-4.png', '1. Kameez\r\n\r\n- Heavily embroidered front and back\r\n- Handcrafted zardozi and sequin detailing\r\n- Intricately embroidered sleeves\r\n- Embellished neckline with stonework and gota patti\r\n\r\n2. Lehenga\r\n\r\n- Richly embroidered panelled lehenga\r\n- Intricate zari, resham, and mirror embellishments\r\n- Can-can lining for added flare and volume\r\n\r\n3. Dupatta\r\n\r\n- Embroidered net or chiffon dupatta\r\n- Heavy borders on all sides\r\n- Delicate bootis and sequins scattered throughout'),
('Amarin-7A', 'SKU:7218-AM3A-Default', 1000, 17990, 'PrintKari', 'Lawn', 'amarin-1.png', 'amarin-2.png', 'amarin-3.png', 'amarin-4.png', '1.Top\r\n\r\nPrinted embroidered front\r\nPrinted embroidered back\r\nPrinted embroidered sleeves\r\nPrinted embroidered neck patti\r\n\r\n2.Bottom\r\n\r\nDyed cotton embroidered trouser\r\n\r\n3.Dupatta\r\n\r\nDyed voile embroidered dupatta with embroidered pallu border'),
('Avenoir-6A', 'SKU:7218-AO3A-Default', 1000, 19990, 'PrintKari', 'Lawn', 'avenoir-1.png', 'avenoir-2.png', 'avenoir-3.png', 'avenoir-4.png', '1.Top\r\n\r\nPrinted embroidered front\r\nPrinted embroidered back\r\nPrinted embroidered sleeves\r\nPrinted embroidered neck patti\r\n\r\n2.Bottom\r\n\r\nDyed cotton embroidered trouser\r\n\r\n3.Dupatta\r\n\r\nDyed voile embroidered dupatta with embroidered pallu border'),
('Nozomi-5A', 'SKU:7218-NO1A-Default', 1000, 20990, 'LawnKari', 'Lawn', 'l1.jpg', 'l1-1-2.jpg', 'l1-1-3.jpg', 'l1-1-4.jpg', '1. Top\r\n\r\nEmbroidered lawn front\r\nEmbroidered lawn back\r\nEmbroidered lawn sleeves\r\nEmbroidered lawn neck patti\r\n\r\n2. Bottom\r\n\r\nDyed cotton embroidered trouser\r\n\r\n3. Dupatta\r\n\r\nDyed voile embroidered dupatta with embroidered pallu border'),
('Rai-3A', 'SKU:7218-RA1A-Default', 1000, 21990, 'LawnKari', 'Lawn', 'Rai-1.png', 'Rai-2.png', 'Rai-3.png', 'Rai-4.png', '1. Top\r\n\r\nEmbroidered lawn front\r\nEmbroidered lawn back\r\nEmbroidered lawn sleeves\r\nEmbroidered lawn neck patti\r\n\r\n2. Bottom\r\n\r\nDyed cotton embroidered trouser\r\n\r\n3. Dupatta\r\n\r\nDyed voile embroidered dupatta with embroidered pallu border');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `wishlist_id` int(11) NOT NULL,
  `product_id` varchar(255) DEFAULT NULL,
  `session_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`wishlist_id`, `product_id`, `session_id`) VALUES
(44, 'SKU: 7218-MI1A-Default', 'o6sjhbnp4o23nca51fm1cmaqia'),
(45, 'SKU:7218-AM3A-Default', 'o6sjhbnp4o23nca51fm1cmaqia');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `card_info`
--
ALTER TABLE `card_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `product_code` (`product_code`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`coupon_code`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `customer_care`
--
ALTER TABLE `customer_care`
  ADD PRIMARY KEY (`complaint_id`);

--
-- Indexes for table `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`wishlist_id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `card_info`
--
ALTER TABLE `card_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `customer_care`
--
ALTER TABLE `customer_care`
  MODIFY `complaint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `wishlist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `fk_cart_product` FOREIGN KEY (`product_code`) REFERENCES `products` (`code`) ON DELETE CASCADE;

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`code`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
