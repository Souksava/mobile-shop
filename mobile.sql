-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 19, 2020 at 10:14 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mobile`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bimg_path` varchar(1000) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brand_id`, `brand_name`, `bimg_path`) VALUES
(8, 'JBL', 'img_5e75f7dc927c4.png'),
(9, 'Sony', 'img_5e75f7e6e0c1b.png'),
(10, 'BOSE', 'img_5e75f7ef56948.png'),
(11, 'GARMIN', 'img_5e75f7fc2f69f.jpeg'),
(13, 'Jabra', 'img_5e75f80805044.jpg'),
(14, 'Huawei', 'img_5e75f814c6986.png'),
(15, 'Marshall', 'img_5e75f820d8c91.png'),
(16, 'Logitech', 'img_5e75f8abe026b.png'),
(17, 'B&O', 'img_5e75f8b44f1ad.png'),
(19, 'SUUNTO', 'img_5e75f8c5ec0d7.png'),
(20, 'harman', 'img_5e75f8d001edf.jpg'),
(22, 'CORSAIR', 'img_5e75f8da6cc2e.png'),
(23, 'beyerdynamic', 'img_5e75f8e652922.jpg'),
(24, 'SteelSeries', 'img_5e75f8f33a69a.png'),
(25, 'plantronics', 'img_5e75f91cb1ea0.png'),
(26, 'GoPro', 'img_5e75f927380a9.jpg'),
(27, 'fitbit', 'img_5e75f93973e31.png'),
(28, 'SoundPEATS', 'img_5e75f94528e28.webp'),
(29, 'Fobase', 'img_5e75f95267c55.jpeg'),
(30, 'Bowers & Wikins', 'img_5e75f95ba501f.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `categorydetail`
--

CREATE TABLE `categorydetail` (
  `cated_id` int(11) NOT NULL,
  `cated_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categorydetail`
--

INSERT INTO `categorydetail` (`cated_id`, `cated_name`) VALUES
(2, 'ຫູຟັງ True Wireless'),
(3, 'ຫູຟັງ Headphone'),
(4, 'ຫູຟັງອອກກຳລັງກາຍ'),
(5, 'ຫູຟັງໄຮ້ສາຍ'),
(6, 'ຫູຟັງ In-ear'),
(7, 'ຫູຟັງ Earbud'),
(8, 'ຫູຟັງບູທູດ'),
(9, 'ຫູຟັງ Call Center'),
(10, 'ລຳໂພງໄຮ້ສາຍ (Wireless)'),
(11, 'ລຳໂພງບ້ານ'),
(12, 'ລຳໂພງພົກພາ'),
(13, 'ລຳໂພງຄອມພິວເຕີ'),
(14, 'ລຳໂພງອະເນກປະສົງ'),
(15, 'ລຳໂພງອັດສະລິຍະ'),
(16, 'Finess Tracker'),
(17, 'Sport Watch'),
(18, 'ສາຍສາກ ແລະ ອຸປະກອນສາກໄຟ'),
(19, 'ແບັດເຕີລີສຳຮອງ');

-- --------------------------------------------------------

--
-- Table structure for table `credit_card`
--

CREATE TABLE `credit_card` (
  `card_id` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `ac_no` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ac_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `img_path` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `credit_card`
--

INSERT INTO `credit_card` (`card_id`, `ac_no`, `ac_name`, `img_path`) VALUES
('BCEL ONE', '0000 12312 3242 35232', 'Souksavath PHONGPHAYOSITH', 'img_5ebd6b886b515.png'),
('STBank', '0000 12312 32423523', 'Souksavath PHONGPHAYOSITH', 'img_5ebd6e208e4b0.png');

-- --------------------------------------------------------

--
-- Table structure for table `cupon`
--

CREATE TABLE `cupon` (
  `cupon_key` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `qty` int(11) DEFAULT NULL,
  `price` decimal(11,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cupon`
--

INSERT INTO `cupon` (`cupon_key`, `qty`, `price`) VALUES
('1', 0, '50000.00'),
('sdfsdfsdf', 5, '13000.00');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `cus_id` int(11) NOT NULL,
  `cus_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cus_surname` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tel` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tel_app` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pass` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fb_id` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`cus_id`, `cus_name`, `cus_surname`, `gender`, `address`, `tel`, `email`, `tel_app`, `pass`, `fb_id`) VALUES
(1, 'ບຸນນະກອນ', 'ໄຊທິລາດ', 'ຊາຍ', 'ບ້ານ ພະຂາວ ເມືອງໄຊເສດຖາ ນະຄອນຫຼວງວຽງຈັນ', '020-5555-6666', 'bon@hotmail.com', '020-2222-33333', '123', NULL),
(2, 'ບຸນພິທັກ', 'ໄຊປັນຍາ', 'ຍິງ', 'ບ້ານ ດົງໂດກ ເມືອງໄຊທານີ ນະຄອນຫຼວງວຽງຈັນ', '020-2333-1111', 'boun@hotmail.com', '020-3333-1111', '123', NULL),
(3, 'ເພັດສະພົນ', 'ແກ້ວປະເສີດ', 'ຊາຍ', 'ບ້ານ ສີໄຄທົ່ງ ເມືອງ ສີໂຄດຕະຄອງ ນະຄອນຫຼວງວຽງຈັນ', '020-1123-2323', 'phet@hotmail.com', '020-444123-12313', '123', NULL),
(7, 'souksavath', 'phongphayosith', 'ຊາຍ', 'M & N Building, Ground floor, Room No.70/101-103, Souphanouvong Avenue, Khounta Thong,Sikhotabong District, Vientiane, Laos', '+856 20 5232 9555', 'souksavath@hotmail.com', '', '123', NULL),
(13, '学生苏克', NULL, NULL, NULL, NULL, 'souksavath.52221881@gmail.com', NULL, NULL, '528564037803218'),
(14, 'ລູກຄ້າທົ່ວໄປ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `emp_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `emp_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emp_surname` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `address` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tel` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pass` varchar(24) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `work_start` date DEFAULT NULL,
  `end_work` date DEFAULT NULL,
  `img_path` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`emp_id`, `emp_name`, `emp_surname`, `gender`, `dob`, `address`, `tel`, `email`, `pass`, `status`, `work_start`, `end_work`, `img_path`) VALUES
('002', 'admin', 'GAME GADGET', 'ຍິງ', '2020-02-07', '', '020-5555-6633', 'admin@hotmail.com', '123', 1, '2020-02-07', '2020-02-07', 'img_5e6e14cc17c7a.ico'),
('124', 'USER', 'GAME GADGET', 'ຍິງ', '2020-02-05', 'Lao Airlines Building 7th Floor, Manthatourath Road, Xiengyeun Village, Chantabouly District, Vientiane Capital, Lao P.D.R (Headquarter)', '+856 20 5232 9555', 'user@hotmail.com', '123', 2, '2020-02-19', '2020-02-25', 'img_5e6e14da16665.ico');

-- --------------------------------------------------------

--
-- Table structure for table `imports`
--

CREATE TABLE `imports` (
  `imp_id` int(11) NOT NULL,
  `imp_bill` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `sup_id` int(11) DEFAULT NULL,
  `emp_id` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pro_id` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `price` decimal(11,2) DEFAULT NULL,
  `imp_date` date DEFAULT NULL,
  `imp_time` time DEFAULT NULL,
  `note` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `imports`
--

INSERT INTO `imports` (`imp_id`, `imp_bill`, `order_id`, `sup_id`, `emp_id`, `pro_id`, `qty`, `price`, `imp_date`, `imp_time`, `note`) VALUES
(1, '1', 2, 1, '124', '1093025000002', 1, '90000.00', '2020-04-02', '18:42:31', ''),
(2, '1001', 2, 1, '124', '1093025000002', 6, '90000.00', '2020-03-08', '17:54:02', ''),
(3, '1', 2, 1, '124', '1145018000002', 10, '90000.00', '2020-05-08', '17:54:28', ''),
(4, '1', 2, 1, '124', '1093025000002', 1, '90000.00', '2020-06-09', '16:25:37', ''),
(5, '1', 2, 1, '124', '1679005000003', 4, '10000.00', '2020-07-09', '16:26:09', ''),
(6, '1001', 2, 1, '124', '1093025000002', 1, '90000.00', '2020-05-14', '21:56:51', '');

-- --------------------------------------------------------

--
-- Table structure for table `listimports`
--

CREATE TABLE `listimports` (
  `imp_id` int(11) NOT NULL,
  `imp_bill` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `sup_id` int(11) DEFAULT NULL,
  `emp_id` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pro_id` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `price` decimal(11,2) DEFAULT NULL,
  `imp_date` date DEFAULT NULL,
  `imp_time` time DEFAULT NULL,
  `note` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `listorderdetail`
--

CREATE TABLE `listorderdetail` (
  `detail_id` int(11) NOT NULL,
  `pro_id` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `price` decimal(11,2) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `emp_id` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `listselldetail2`
--

CREATE TABLE `listselldetail2` (
  `detail_id` int(11) NOT NULL,
  `pro_id` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `emp_id` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orderdetail`
--

CREATE TABLE `orderdetail` (
  `detail_id` int(11) NOT NULL,
  `pro_id` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `price` decimal(11,2) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orderdetail`
--

INSERT INTO `orderdetail` (`detail_id`, `pro_id`, `qty`, `price`, `order_id`) VALUES
(1, '1093025000002', 1, '90000.00', 2),
(2, '1093025000002', 2, '30000.00', 3),
(3, '1145018000002', 3, '700000.00', 3),
(4, '1816002000001', 8, '90000.00', 3),
(5, '1093016000002', 1, '5000.00', 4),
(6, '1740002000002', 1, '90000.00', 5);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `emp_id` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sup_id` int(11) DEFAULT NULL,
  `amount` decimal(11,2) DEFAULT NULL,
  `order_date` date DEFAULT NULL,
  `order_time` time DEFAULT NULL,
  `status` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `img_path` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seen1` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seen2` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_accept` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `emp_id`, `sup_id`, `amount`, `order_date`, `order_time`, `status`, `img_path`, `seen1`, `seen2`, `user_accept`) VALUES
(1, '124', 2, '1030000.00', '2020-03-01', '13:15:44', 'ອະນຸມັດ', NULL, 'SEEN', 'SEEN', NULL),
(2, '124', 1, '90000.00', '2020-04-02', '18:29:29', 'ອະນຸມັດ', NULL, 'SEEN', 'SEEN', NULL),
(3, '124', 2, '2880000.00', '2020-04-08', '18:30:45', 'ອະນຸມັດ', NULL, 'SEEN', 'SEEN', NULL),
(4, '124', 1, '5000.00', '2020-05-13', '12:50:44', 'ອະນຸມັດ', NULL, 'SEEN', 'NOTSEEN', NULL),
(5, '124', 1, '90000.00', '2020-05-14', '20:08:13', 'ຍັງບໍ່ອະນຸມັດ', NULL, 'SEEN', 'NOTSEEN', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `pro_id` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `pro_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `price` decimal(11,2) DEFAULT NULL,
  `cated_id` int(11) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `promotion` decimal(11,2) DEFAULT NULL,
  `qtyalert` int(11) DEFAULT NULL,
  `img_path` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`pro_id`, `pro_name`, `qty`, `price`, `cated_id`, `unit_id`, `brand_id`, `promotion`, `qtyalert`, `img_path`) VALUES
('1093016000002', 'Kilburn II Portable', 3, '3000000.00', 10, 1, 15, '200000.00', 10, 'img_5e6e300ed7b5d.jpg'),
('1093025000002', 'Stockwell II', 0, '2400000.00', 10, 1, 15, '150000.00', 10, 'img_5e6e4e5177042.jpg'),
('1095126000011', 'Flip 5 Portable', 10, '1200000.00', 10, 1, 8, '100000.00', 10, 'img_5e6e4ec2dd941.jpg'),
('1145018000002', 'B&W PX7 Noise', 5, '5100000.00', 3, 13, 30, '30000.00', 0, 'img_5e6e51db3f72a.jpg'),
('1298052000002', 'Plantronics BackBeat Fit 3200 ', 9, '1500000.00', 2, 13, 8, '0.00', 10, 'img_5e6e52b26db6d.jpg'),
('1679005000003', '7', 12, '5100000.00', 17, 1, 19, '0.00', 10, 'img_5e6f567a67869.jpg'),
('1740002000002', 'SoundPeats TrueCapsule', 9, '300000.00', 2, 13, 28, '0.00', 10, 'img_5e6e4f8227fdd.jpg'),
('1740005000002', 'SoundPeats TrueAir', 19, '420000.00', 2, 10, 28, '0.00', 10, 'img_5e6e52598fd7d.jpg'),
('1816002000001', 'GTO', 9, '420000.00', 17, 1, 29, '0.00', 10, 'img_5e6e508657c29.jpg'),
('1889002000005', 'Watch GT2', 10, '1900000.00', 17, 1, 14, '0.00', 10, 'img_5e6e50ce2bf37.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `rate`
--

CREATE TABLE `rate` (
  `rate_id` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rate_buy` decimal(11,2) DEFAULT NULL,
  `rate_sell` decimal(11,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `rate`
--

INSERT INTO `rate` (`rate_id`, `rate_buy`, `rate_sell`) VALUES
('LAK', '1.00', '1.00'),
('USD', '9000.00', '9000.00'),
('THB', '300.00', '300.00');

-- --------------------------------------------------------

--
-- Table structure for table `sell`
--

CREATE TABLE `sell` (
  `sell_id` int(11) NOT NULL,
  `emp_id` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cus_id` int(11) DEFAULT NULL,
  `sell_date` date DEFAULT NULL,
  `sell_time` time DEFAULT NULL,
  `amount` decimal(11,2) DEFAULT NULL,
  `status_cash` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `img_path` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sell_type` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cupon_key` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cupon_price` decimal(11,2) DEFAULT NULL,
  `note` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sell`
--

INSERT INTO `sell` (`sell_id`, `emp_id`, `cus_id`, `sell_date`, `sell_time`, `amount`, `status_cash`, `img_path`, `sell_type`, `cupon_key`, `cupon_price`, `note`) VALUES
(1, '124', 14, '2020-05-14', '20:42:59', '2800000.00', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', '0', '0.00', '-'),
(2, '124', 14, '2020-06-14', '20:50:57', '2800000.00', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', '0', '0.00', '-'),
(3, '124', 14, '2020-04-14', '21:00:44', '2800000.00', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', '0', '0.00', '-'),
(4, '124', 14, '2020-05-14', '21:04:18', '2800000.00', 'ເງິນໂອນ', 'img_5ebd4fe20593c.jpg', 'ໜ້າຮ້ານ', '0', '0.00', '-'),
(5, '124', 14, '2020-02-14', '21:08:47', '2250000.00', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', '0', '0.00', '-'),
(6, '124', 14, '2020-05-14', '21:09:52', '2250000.00', 'ເງິນໂອນ', 'img_5ebd5130619d0.jpg', 'ໜ້າຮ້ານ', '0', '0.00', '-'),
(7, '124', 14, '2020-05-14', '23:21:30', '5070000.00', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', '0', '0.00', '-'),
(8, '124', 14, '2020-05-18', '20:23:15', '2800000.00', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', '0', '0.00', '-');

-- --------------------------------------------------------

--
-- Table structure for table `selldetail`
--

CREATE TABLE `selldetail` (
  `detail_id` int(11) NOT NULL,
  `pro_id` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `price` decimal(11,2) DEFAULT NULL,
  `promotion` decimal(11,2) DEFAULT NULL,
  `sell_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `selldetail`
--

INSERT INTO `selldetail` (`detail_id`, `pro_id`, `qty`, `price`, `promotion`, `sell_id`) VALUES
(1, '1093016000002', 1, '2800000.00', '200000.00', 2),
(2, '1093016000002', 1, '2800000.00', '200000.00', 4),
(3, '1093025000002', 1, '2250000.00', '150000.00', 5),
(4, '1093025000002', 1, '2250000.00', '150000.00', 6),
(5, '1145018000002', 1, '5070000.00', '30000.00', 7),
(6, '1093016000002', 1, '2800000.00', '200000.00', 8);

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

CREATE TABLE `shop` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tel` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `img_path` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `img_title` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_shop` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `shop`
--

INSERT INTO `shop` (`id`, `name`, `address`, `tel`, `email`, `img_path`, `img_title`, `date_shop`) VALUES
(1, 'Bee Mobile Shop', 'ບ້ານ ໂສກປ່າຫຼວງ ເມືອງຫາດຊາຍຟອງ ນະຄອນຫຼວງວຽງຈັນ', '+856 20 5232 9555', 'GAME_GADGET@hotmail.com', 'img_5eba65fa19c9d.jpeg', 'img_5eba65fa1a1eb.jpeg', '2002-02-01');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `name`) VALUES
(1, 'ເຈົ້າຂອງຮ້ານ'),
(2, 'ພະນັກງານຂາຍ'),
(3, 'ປິດການໃຊ້ງານ');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `sup_id` int(11) NOT NULL,
  `company` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tel` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fax` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`sup_id`, `company`, `tel`, `fax`, `address`, `email`) VALUES
(1, 'ສັນຕິພາບ ຄອມພິວເຕີ2', '2020-5555-6633', '2+856 20 5464 9656', '2Lao Airlines Building 7th Floor, Manthatourath Road, Xiengyeun Village, Chantabouly District, Vientiane Capital, Lao P.D.R (Headquarter)', '2bie_domonclup@hotmail.com'),
(2, 'Jiro Computer', '+856 20 5232 9555', '+856 20 5464 9656', 'Lao Airlines Building 7th Floor, Manthatourath Road, Xiengyeun Village, Chantabouly District, Vientiane Capital, Lao P.D.R (Headquarter)', 'Robert@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `unit_id` int(11) NOT NULL,
  `unit_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`unit_id`, `unit_name`) VALUES
(1, 'ໜ່ວຍ'),
(7, 'ເສັ້ນ'),
(8, 'ກ້ອນ'),
(9, 'ກັບ'),
(10, 'ກ່ອງ'),
(11, 'ຖົງ'),
(12, 'ຊອງ'),
(13, 'ອັນ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `categorydetail`
--
ALTER TABLE `categorydetail`
  ADD PRIMARY KEY (`cated_id`);

--
-- Indexes for table `credit_card`
--
ALTER TABLE `credit_card`
  ADD PRIMARY KEY (`card_id`);

--
-- Indexes for table `cupon`
--
ALTER TABLE `cupon`
  ADD PRIMARY KEY (`cupon_key`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`cus_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`emp_id`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `imports`
--
ALTER TABLE `imports`
  ADD PRIMARY KEY (`imp_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `sup_id` (`sup_id`),
  ADD KEY `emp_id` (`emp_id`),
  ADD KEY `pro_id` (`pro_id`);

--
-- Indexes for table `listimports`
--
ALTER TABLE `listimports`
  ADD PRIMARY KEY (`imp_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `sup_id` (`sup_id`),
  ADD KEY `emp_id` (`emp_id`),
  ADD KEY `pro_id` (`pro_id`);

--
-- Indexes for table `listorderdetail`
--
ALTER TABLE `listorderdetail`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `pro_id` (`pro_id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- Indexes for table `listselldetail2`
--
ALTER TABLE `listselldetail2`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `pro_id` (`pro_id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- Indexes for table `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `pro_id` (`pro_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `emp_id` (`emp_id`),
  ADD KEY `sup_id` (`sup_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`pro_id`),
  ADD KEY `cated_id` (`cated_id`),
  ADD KEY `unit_id` (`unit_id`),
  ADD KEY `brand_id` (`brand_id`);

--
-- Indexes for table `sell`
--
ALTER TABLE `sell`
  ADD PRIMARY KEY (`sell_id`),
  ADD KEY `cus_id` (`cus_id`);

--
-- Indexes for table `selldetail`
--
ALTER TABLE `selldetail`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `pro_id` (`pro_id`),
  ADD KEY `sell_id` (`sell_id`);

--
-- Indexes for table `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`sup_id`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`unit_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `categorydetail`
--
ALTER TABLE `categorydetail`
  MODIFY `cated_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `cus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `imports`
--
ALTER TABLE `imports`
  MODIFY `imp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `listimports`
--
ALTER TABLE `listimports`
  MODIFY `imp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `listorderdetail`
--
ALTER TABLE `listorderdetail`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `listselldetail2`
--
ALTER TABLE `listselldetail2`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `orderdetail`
--
ALTER TABLE `orderdetail`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `selldetail`
--
ALTER TABLE `selldetail`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `shop`
--
ALTER TABLE `shop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `sup_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`status`) REFERENCES `status` (`id`);

--
-- Constraints for table `imports`
--
ALTER TABLE `imports`
  ADD CONSTRAINT `imports_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `imports_ibfk_2` FOREIGN KEY (`sup_id`) REFERENCES `suppliers` (`sup_id`),
  ADD CONSTRAINT `imports_ibfk_3` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`emp_id`),
  ADD CONSTRAINT `imports_ibfk_4` FOREIGN KEY (`pro_id`) REFERENCES `product` (`pro_id`);

--
-- Constraints for table `listimports`
--
ALTER TABLE `listimports`
  ADD CONSTRAINT `listimports_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `listimports_ibfk_2` FOREIGN KEY (`sup_id`) REFERENCES `suppliers` (`sup_id`),
  ADD CONSTRAINT `listimports_ibfk_3` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`emp_id`),
  ADD CONSTRAINT `listimports_ibfk_4` FOREIGN KEY (`pro_id`) REFERENCES `product` (`pro_id`);

--
-- Constraints for table `listorderdetail`
--
ALTER TABLE `listorderdetail`
  ADD CONSTRAINT `listorderdetail_ibfk_1` FOREIGN KEY (`pro_id`) REFERENCES `product` (`pro_id`),
  ADD CONSTRAINT `listorderdetail_ibfk_2` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`emp_id`);

--
-- Constraints for table `listselldetail2`
--
ALTER TABLE `listselldetail2`
  ADD CONSTRAINT `listselldetail2_ibfk_1` FOREIGN KEY (`pro_id`) REFERENCES `product` (`pro_id`),
  ADD CONSTRAINT `listselldetail2_ibfk_2` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`emp_id`);

--
-- Constraints for table `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD CONSTRAINT `orderdetail_ibfk_1` FOREIGN KEY (`pro_id`) REFERENCES `product` (`pro_id`),
  ADD CONSTRAINT `orderdetail_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`emp_id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`sup_id`) REFERENCES `suppliers` (`sup_id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`cated_id`) REFERENCES `categorydetail` (`cated_id`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`unit_id`) REFERENCES `unit` (`unit_id`),
  ADD CONSTRAINT `product_ibfk_3` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`brand_id`);

--
-- Constraints for table `sell`
--
ALTER TABLE `sell`
  ADD CONSTRAINT `sell_ibfk_1` FOREIGN KEY (`cus_id`) REFERENCES `customers` (`cus_id`);

--
-- Constraints for table `selldetail`
--
ALTER TABLE `selldetail`
  ADD CONSTRAINT `selldetail_ibfk_1` FOREIGN KEY (`pro_id`) REFERENCES `product` (`pro_id`),
  ADD CONSTRAINT `selldetail_ibfk_2` FOREIGN KEY (`sell_id`) REFERENCES `sell` (`sell_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
