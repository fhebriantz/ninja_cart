-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2019 at 01:00 PM
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
-- Table structure for table `nj_ms_customer`
--

CREATE TABLE `nj_ms_customer` (
  `id` int(13) UNSIGNED ZEROFILL NOT NULL,
  `fullname` varchar(256) NOT NULL,
  `email` varchar(256) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `address` text NOT NULL,
  `country` varchar(256) NOT NULL,
  `province` varchar(255) NOT NULL COMMENT 'provinsi',
  `regency` varchar(255) NOT NULL COMMENT 'kabupaten/kota',
  `district` varchar(255) NOT NULL COMMENT 'kecamatan',
  `village` varchar(255) NOT NULL COMMENT 'kelurahan',
  `zipcode` varchar(15) NOT NULL,
  `is_active` tinyint(4) NOT NULL,
  `created_by` varchar(256) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(256) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nj_ms_customer`
--

INSERT INTO `nj_ms_customer` (`id`, `fullname`, `email`, `phone_number`, `gender`, `address`, `country`, `province`, `regency`, `district`, `village`, `zipcode`, `is_active`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(0000000000001, 'Lutfi', 'a@a.com', '456456', 'Man', 'Bogor Mekar Jaya', 'Indonesia', '', '', '', '', '1613', 1, 'Admin Default', '2019-02-24 21:53:58', NULL, '2019-02-24 21:53:58'),
(0000000000002, 'Lutfi', 'a@a.com', '456456', 'Man', 'Bogor Mekar Jaya', 'Indonesia', 'JAWA TIMUR', 'regency', 'district', 'village', '1613', 1, 'Admin Default', '2019-02-25 20:52:07', NULL, '2019-02-25 20:52:07'),
(0000000000003, 'Lutfi', 'a@a.com', '456456', 'Man', 'Bogor Mekar Jaya', 'Indonesia', '35', '3516', '3516130', '2147483647', '16133', 1, 'Admin Default', '2019-02-26 02:36:04', NULL, '2019-02-26 02:36:04'),
(0000000000005, 'Lutfi', 'a@a.com', '456456', 'Man', 'Bogor Mekar Jaya', 'Indonesia', '11', '1118', '1118010', '1118010015', '1613', 1, 'Admin Default', '2019-02-26 19:53:00', NULL, '2019-02-26 19:53:00'),
(0000000000006, 'Lutfi', 'a@a.com', '456456', 'Man', 'Bogor Mekar Jaya', 'Indonesia', '13', '1312', '1312040', '1312040001', '1613', 1, 'Admin Default', '2019-02-27 02:08:33', NULL, '2019-02-27 02:08:33'),
(0000000000007, 'Lutfi', 'a@a.com', '456456', 'Man', 'Bogor Mekar Jaya', 'Indonesia', '13', '1312', '1312040', '1312040001', '1613', 1, 'Admin Default', '2019-02-27 02:09:27', NULL, '2019-02-27 02:09:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `nj_ms_customer`
--
ALTER TABLE `nj_ms_customer`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `nj_ms_customer`
--
ALTER TABLE `nj_ms_customer`
  MODIFY `id` int(13) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
