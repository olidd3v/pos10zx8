-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2022 at 08:07 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pod`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_name`, `category_desc`, `date`) VALUES
('KAT001', 'tes kat', 'tes kat', '2022-07-10 03:01:46');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `product_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `product_qty` int(11) NOT NULL DEFAULT '0',
  `sale_price` int(20) NOT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `product_name`, `category_id`, `product_desc`, `product_qty`, `sale_price`, `date`) VALUES
('PDC001', 'tes kat', 'KAT001', 'tes kat', 18, 10000, '2022-07-10 03:01:57'),
('PDC002', 'tes produk 2', 'KAT001', 'tes produk 2', 75, 1500, '2022-07-10 06:08:25'),
('PDC003', 'tes 333', 'KAT001', 'tes 33', 10, 1003, '2022-07-11 23:15:20');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_data`
--

CREATE TABLE `purchase_data` (
  `id` int(11) NOT NULL,
  `transaction_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price_item` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subtotal` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_retur`
--

CREATE TABLE `purchase_retur` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sales_retur_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `total_price` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `total_item` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_return` enum('1','0') COLLATE utf8_unicode_ci NOT NULL,
  `desc_retur` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_transaction`
--

CREATE TABLE `purchase_transaction` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `total_price` int(20) NOT NULL,
  `total_item` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `supplier_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales_data`
--

CREATE TABLE `sales_data` (
  `id` int(11) NOT NULL,
  `sales_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price_item` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subtotal` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales_transaction`
--

CREATE TABLE `sales_transaction` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_cash` tinyint(1) NOT NULL,
  `total_price` int(100) NOT NULL,
  `total_item` int(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `judul_app` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_telp` varchar(255) NOT NULL,
  `deskripsi_toko` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `judul_app`, `alamat`, `no_telp`, `deskripsi_toko`, `foto`) VALUES
(1, 'Judul App1', 'Alamat App1', '081239121', 'Deskripsi Toko1', '6a.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `supplier_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `supplier_phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `supplier_address` text COLLATE utf8_unicode_ci NOT NULL,
  `date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `supplier_name`, `supplier_phone`, `supplier_address`, `date`) VALUES
('SUP001', 'tes supplier', '08882222', 'tes supplier', '2022-07-10 04:29:11');

-- --------------------------------------------------------

--
-- Table structure for table `trans`
--

CREATE TABLE `trans` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `total` int(11) NOT NULL,
  `dibayar` int(11) NOT NULL,
  `kembalian` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `photo_profile` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` int(1) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `photo_profile`, `password`, `role`, `name`) VALUES
(1, 'alan', 'admin@admin.com', '', '21232f297a57a5a743894a0e4a801fc3', 1, 'Alan'),
(3, 'kasir', 'kasir@kasir.com', NULL, 'c7911af3adbd12a035b289556d96470a', 0, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `id_2` (`id`);

--
-- Indexes for table `purchase_data`
--
ALTER TABLE `purchase_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_retur`
--
ALTER TABLE `purchase_retur`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `id_2` (`id`);

--
-- Indexes for table `purchase_transaction`
--
ALTER TABLE `purchase_transaction`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `id_2` (`id`);

--
-- Indexes for table `sales_data`
--
ALTER TABLE `sales_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_transaction`
--
ALTER TABLE `sales_transaction`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `trans`
--
ALTER TABLE `trans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `purchase_data`
--
ALTER TABLE `purchase_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sales_data`
--
ALTER TABLE `sales_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `trans`
--
ALTER TABLE `trans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
