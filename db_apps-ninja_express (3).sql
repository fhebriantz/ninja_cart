-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2019 at 11:33 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

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
(1, 1001, 0000000000001, 3000, 2),
(2, 1001, 0000000000002, 5000, 3),
(3, 1001, 0000000000004, 15000, 1);

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

-- --------------------------------------------------------

--
-- Table structure for table `nj_ms_customer`
--

CREATE TABLE `nj_ms_customer` (
  `id` int(13) UNSIGNED ZEROFILL NOT NULL,
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
  `update_by` varchar(256) DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nj_ms_customer`
--

INSERT INTO `nj_ms_customer` (`id`, `fullname`, `email`, `phone_number`, `gender`, `address`, `country`, `city`, `zipcode`, `is_active`, `created_by`, `created_at`, `update_by`, `update_at`) VALUES
(0000000000001, 'Lutfi', NULL, NULL, NULL, 'Bogor', NULL, NULL, NULL, 1, '1', '2019-02-20 03:56:08', NULL, '2019-02-20 03:56:08');

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
  `update_by` varchar(256) DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nj_ms_product`
--

INSERT INTO `nj_ms_product` (`id`, `product_name`, `product_price`, `sku`, `image`, `is_active`, `created_by`, `created_at`, `update_by`, `update_at`) VALUES
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
  `update_by` varchar(256) DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
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
  `update_by` varchar(256) DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
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
  `update_by` varchar(256) DEFAULT NULL,
  `update_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nj_ms_user`
--

INSERT INTO `nj_ms_user` (`id`, `id_usergroup`, `fullname`, `username`, `password`, `email`, `phone_number`, `is_active`, `created_by`, `created_at`, `update_by`, `update_at`) VALUES
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
  `modified_by` varchar(256) DEFAULT NULL,
  `modified_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nj_ms_usergroup`
--

INSERT INTO `nj_ms_usergroup` (`id`, `usergroup`, `description`, `is_active`, `created_by`, `created_at`, `modified_by`, `modified_at`) VALUES
(1, 'cms_admin', 'Usergroup for administrator CMS ', 1, 'SYSTEM', '2019-02-18 04:10:38', NULL, '2019-02-18 04:10:38');

-- --------------------------------------------------------

--
-- Table structure for table `nj_tr_order`
--

CREATE TABLE `nj_tr_order` (
  `id` int(13) UNSIGNED ZEROFILL NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_customer` int(13) UNSIGNED ZEROFILL NOT NULL,
  `date_order` datetime NOT NULL,
  `is_active` tinyint(4) NOT NULL,
  `created_by` varchar(256) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_by` varchar(256) DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nj_tr_order`
--

INSERT INTO `nj_tr_order` (`id`, `id_order`, `id_customer`, `date_order`, `is_active`, `created_by`, `created_at`, `update_by`, `update_at`) VALUES
(0000000000001, 1001, 0000000000001, '2019-02-20 00:00:00', 1, '1', '2019-02-20 03:56:39', NULL, '2019-02-20 04:15:04');

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
  MODIFY `id` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `nj_ms_coupon`
--
ALTER TABLE `nj_ms_coupon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nj_ms_customer`
--
ALTER TABLE `nj_ms_customer`
  MODIFY `id` int(13) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` int(13) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
