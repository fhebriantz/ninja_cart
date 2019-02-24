-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2019 at 08:33 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_apps-ninja_express`
--

-- --------------------------------------------------------

--
-- Table structure for table `nj_dt_order`
--

CREATE TABLE `nj_dt_order` (
  `id` int(13) NOT NULL,
  `id_order` int(13) NOT NULL,
  `id_product` int(13) UNSIGNED ZEROFILL NOT NULL,
  `price` bigint(30) NOT NULL,
  `qty` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nj_dt_order`
--

INSERT INTO `nj_dt_order` (`id`, `id_order`, `id_product`, `price`, `qty`) VALUES
(6, 1551038434, 0000000000005, 5000, 5),
(7, 1551038434, 0000000000002, 5000, 2),
(8, 1551038434, 0000000000001, 3000, 3);

-- --------------------------------------------------------

--
-- Table structure for table `nj_ms_coupon`
--

CREATE TABLE `nj_ms_coupon` (
  `id` int(11) NOT NULL,
  `coupon_code` varchar(50) NOT NULL,
  `coupon_name` varchar(256) NOT NULL,
  `nominal` int(11) NOT NULL,
  `type` enum('nominal','percentage') NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `is_active` tinyint(4) NOT NULL,
  `created_by` varchar(256) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(256) DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nj_ms_coupon`
--

INSERT INTO `nj_ms_coupon` (`id`, `coupon_code`, `coupon_name`, `nominal`, `type`, `start_date`, `end_date`, `is_active`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, 'GRATISONGKIR', 'Gratis Ongkir 5000', 5000, 'nominal', '2019-02-01 00:00:00', '2019-02-28 00:00:00', 1, 'Admin Default', '2019-02-24 10:04:35', NULL, '2019-02-24 10:04:35'),
(2, 'DISKON50', 'Diskon 50%', 50, 'percentage', '2019-02-01 00:00:00', '2019-02-28 00:00:00', 1, 'Admin Default', '2019-02-24 10:26:01', NULL, '2019-02-24 10:26:01');

-- --------------------------------------------------------

--
-- Table structure for table `nj_ms_customer`
--

CREATE TABLE `nj_ms_customer` (
  `id` int(13) UNSIGNED ZEROFILL NOT NULL,
  `id_cus` tinyint(4) NOT NULL,
  `fullname` varchar(256) NOT NULL,
  `email` varchar(256) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `address` text NOT NULL,
  `country` varchar(256) DEFAULT NULL,
  `city` varchar(256) DEFAULT NULL,
  `zipcode` varchar(15) DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL,
  `created_by` varchar(256) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(256) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nj_ms_customer`
--

INSERT INTO `nj_ms_customer` (`id`, `id_cus`, `fullname`, `email`, `phone_number`, `gender`, `address`, `country`, `city`, `zipcode`, `is_active`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(0000000000041, 1, 'felicia edwina', 'lutfi.febrianto@gmail.com', '879879898', 'Man', 'Kp Mekar Jaya No. 34\r\nKel. Rangga Mekar Kp. Mekar Jaya Rt. 01 Rw. 09  Kode Pos 16135', 'Indonesia', 'Kota Bogor', '98789', 1, 'Admin Default', '2019-02-24 11:00:34', NULL, '2019-02-24 11:00:34'),
(0000000000042, 2, 'asdd', NULL, '09809', 'Select Gender ...', 'asd', 'Select Counrtry ...', NULL, NULL, 1, 'Admin Default', '2019-02-24 12:25:29', NULL, '2019-02-24 12:25:29'),
(0000000000043, 3, 'Lutfi', NULL, '124', 'Select Gender ...', 'qwr', 'Select Counrtry ...', NULL, NULL, 1, 'Admin Default', '2019-02-24 12:28:21', NULL, '2019-02-24 12:28:21'),
(0000000000044, 4, 'f', NULL, '2', 'Select Gender ...', '3', 'Select Counrtry ...', NULL, NULL, 1, 'Admin Default', '2019-02-24 12:30:23', NULL, '2019-02-24 12:30:23');

-- --------------------------------------------------------

--
-- Table structure for table `nj_ms_product`
--

CREATE TABLE `nj_ms_product` (
  `id` int(13) NOT NULL,
  `product_name` varchar(256) NOT NULL,
  `product_price` bigint(20) NOT NULL,
  `sku` varchar(256) DEFAULT NULL,
  `image` varchar(256) DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL,
  `created_by` varchar(256) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(256) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nj_ms_product`
--

INSERT INTO `nj_ms_product` (`id`, `product_name`, `product_price`, `sku`, `image`, `is_active`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'Sabun', 3000, 'S1', 'sabun.jpg', 1, '1', '2019-02-20 03:53:29', NULL, '2019-02-20 04:01:53'),
(2, 'Odol', 5000, 'O1', 'odol.jpg', 1, '1', '2019-02-20 03:53:29', NULL, '2019-02-20 04:01:59'),
(3, 'Minyak', 3000, 'M1', 'minyak.jpg', 1, '1', '2019-02-20 03:53:29', NULL, '2019-02-20 04:02:04'),
(4, 'Rokok', 15000, 'R1', 'rokok.jpg', 1, '1', '2019-02-20 03:53:29', NULL, '2019-02-20 04:02:09'),
(5, 'Susu', 5000, 'S2', 'susu.jpg', 1, '1', '2019-02-20 03:53:29', NULL, '2019-02-20 04:02:12');

-- --------------------------------------------------------

--
-- Table structure for table `nj_ms_product_img`
--

CREATE TABLE `nj_ms_product_img` (
  `id` int(13) NOT NULL,
  `id_product` int(13) UNSIGNED ZEROFILL NOT NULL,
  `filename` varchar(256) NOT NULL,
  `full_path` text,
  `sort_number` tinyint(4) DEFAULT NULL,
  `is_cover` tinyint(4) NOT NULL,
  `is_active` tinyint(4) NOT NULL,
  `created_by` varchar(256) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(256) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nj_ms_shipment`
--

CREATE TABLE `nj_ms_shipment` (
  `id` int(13) UNSIGNED ZEROFILL NOT NULL,
  `shipment_type` varchar(50) NOT NULL,
  `price` bigint(20) NOT NULL,
  `is_active` tinyint(4) NOT NULL,
  `created_by` varchar(256) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(256) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nj_ms_user`
--

CREATE TABLE `nj_ms_user` (
  `id` int(11) NOT NULL,
  `id_usergroup` int(11) NOT NULL,
  `fullname` varchar(256) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(256) NOT NULL,
  `email` varchar(256) DEFAULT NULL,
  `phone_number` varchar(50) DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL,
  `created_by` varchar(256) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(256) DEFAULT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nj_ms_user`
--

INSERT INTO `nj_ms_user` (`id`, `id_usergroup`, `fullname`, `username`, `password`, `email`, `phone_number`, `is_active`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 1, 'Test Admin', 'test_admin', '8cb2237d0679ca88db6464eac60da96345513964', NULL, NULL, 1, 'SYSTEM', '2019-02-18 11:11:41', NULL, '2019-02-18 11:11:41');

-- --------------------------------------------------------

--
-- Table structure for table `nj_ms_usergroup`
--

CREATE TABLE `nj_ms_usergroup` (
  `id` int(11) NOT NULL,
  `usergroup` varchar(50) NOT NULL,
  `description` text,
  `is_active` tinyint(4) NOT NULL,
  `created_by` varchar(256) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(256) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nj_ms_usergroup`
--

INSERT INTO `nj_ms_usergroup` (`id`, `usergroup`, `description`, `is_active`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'cms_admin', 'Usergroup for administrator CMS ', 1, 'SYSTEM', '2019-02-18 04:10:38', NULL, '2019-02-18 04:10:38');

-- --------------------------------------------------------

--
-- Table structure for table `nj_tr_order`
--

CREATE TABLE `nj_tr_order` (
  `id` int(13) NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_customer` int(13) NOT NULL,
  `id_coupon` varchar(255) DEFAULT NULL,
  `total` bigint(20) NOT NULL,
  `discount_type` varchar(255) DEFAULT NULL,
  `discount` bigint(20) DEFAULT NULL,
  `grand_total` bigint(20) NOT NULL,
  `date_order` datetime NOT NULL,
  `is_active` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(256) NOT NULL,
  `updated_by` varchar(256) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nj_tr_order`
--

INSERT INTO `nj_tr_order` (`id`, `id_order`, `id_customer`, `id_coupon`, `total`, `discount_type`, `discount`, `grand_total`, `date_order`, `is_active`, `created_at`, `created_by`, `updated_by`, `updated_at`) VALUES
(27, 1551038434, 1, '1', 44000, 'nominal', 5000, 48000, '2019-02-24 18:00:34', 1, '2019-02-24 11:00:34', 'Admin Default', NULL, '2019-02-24 11:00:34'),
(28, 1551043528, 2, NULL, 0, NULL, NULL, 0, '2019-02-24 19:25:28', 1, '2019-02-24 12:25:29', 'Admin Default', NULL, '2019-02-24 12:25:29'),
(29, 1551043701, 3, NULL, 0, NULL, NULL, 0, '2019-02-24 19:28:21', 1, '2019-02-24 12:28:21', 'Admin Default', NULL, '2019-02-24 12:28:21'),
(30, 1551043823, 4, NULL, 0, NULL, NULL, 0, '2019-02-24 19:30:23', 1, '2019-02-24 12:30:23', 'Admin Default', NULL, '2019-02-24 12:30:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `nj_dt_order`
--
ALTER TABLE `nj_dt_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nj_ms_coupon`
--
ALTER TABLE `nj_ms_coupon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nj_ms_customer`
--
ALTER TABLE `nj_ms_customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nj_ms_product`
--
ALTER TABLE `nj_ms_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nj_ms_shipment`
--
ALTER TABLE `nj_ms_shipment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nj_ms_user`
--
ALTER TABLE `nj_ms_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nj_ms_usergroup`
--
ALTER TABLE `nj_ms_usergroup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nj_tr_order`
--
ALTER TABLE `nj_tr_order`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `nj_dt_order`
--
ALTER TABLE `nj_dt_order`
  MODIFY `id` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `nj_ms_coupon`
--
ALTER TABLE `nj_ms_coupon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `nj_ms_customer`
--
ALTER TABLE `nj_ms_customer`
  MODIFY `id` int(13) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `nj_ms_product`
--
ALTER TABLE `nj_ms_product`
  MODIFY `id` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `nj_ms_shipment`
--
ALTER TABLE `nj_ms_shipment`
  MODIFY `id` int(13) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nj_ms_user`
--
ALTER TABLE `nj_ms_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `nj_ms_usergroup`
--
ALTER TABLE `nj_ms_usergroup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `nj_tr_order`
--
ALTER TABLE `nj_tr_order`
  MODIFY `id` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
