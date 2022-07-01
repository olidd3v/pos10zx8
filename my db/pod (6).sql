-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2022 at 08:37 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
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
  `id` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `category_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_name`, `category_desc`, `date`) VALUES
('KAT1', 'Kipas Angin', 'Kipas Angin', '2016-05-22 16:18:05'),
('LAMP', 'Lampu', 'Lampu', '2016-05-25 13:27:13'),
('TV', 'TV', 'TV', '2016-05-25 13:26:56');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `product_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `product_qty` int(11) NOT NULL DEFAULT 0,
  `sale_price` int(20) NOT NULL,
  `date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `product_name`, `category_id`, `product_desc`, `product_qty`, `sale_price`, `date`) VALUES
('12312', 'asd', 'KAT1', 'asdas', 9, 12, '2022-06-29 23:50:59'),
('5656', '5415', 'LAMP', '545', 100, 1000000, '2022-07-01 01:02:25'),
('MAS10', 'Maspion', 'KAT1', 'Maspion Kipas Baru', 74, 120000, '2016-05-26 14:27:15'),
('PHIL001', 'Philip Lampu', 'LAMP', 'Philip 12watt', 0, 80000, '2016-05-26 16:00:13'),
('SAM100', 'Samsung TV', 'TV', 'TV 52inc', 121, 6200000, '2016-05-26 15:58:15'),
('SAM2100', 'Samsung 2100', 'KAT1', 'Samsung Kipas', 14, 210000, '2016-05-29 14:26:41'),
('TOS10', 'Toshiba 21', 'TV', '', 89, 1600000, '2016-05-26 14:28:21');

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
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `purchase_data`
--

INSERT INTO `purchase_data` (`id`, `transaction_id`, `product_id`, `category_id`, `quantity`, `price_item`, `subtotal`, `date`) VALUES
(1, 'A123AS', 'SAM2100', 'KAT1', '1', '100', '100', '2022-06-30 03:02:52'),
(3, 'RETP1656559092', 'SAM2100', 'KAT1', '10', '100', '1000', '2022-06-30 03:57:14'),
(5, 'RETP1656561471', 'SAM2100', 'KAT1', '2', '100', '200', '2022-06-30 04:03:34'),
(7, 'TES111', 'SAM100', 'TV', '50', '3000', '150000', '2022-06-30 04:10:52'),
(8, 'RETP1656561959', 'SAM2100', 'KAT1', '5', '100', '500', '2022-06-30 05:51:36'),
(12, 'XXX', 'SAM2100', 'KAT1', '1', '100000', '100000', '2022-06-30 09:42:46'),
(13, 'TES333', 'SAM2100', 'KAT1', '10', '100', '1000', '2022-07-01 04:31:58'),
(16, 'RETP1656650967', 'SAM2100', 'KAT1', '10', '100', '1000', '2022-07-01 04:50:30'),
(17, 'RETP1656568446', 'SAM2100', 'KAT1', '1', '100', '100', '2022-07-01 05:39:46'),
(18, 'RETP1656568416', 'SAM100', 'TV', '13', '3000', '39000', '2022-07-01 05:40:04'),
(20, 'RETP1656654032', 'SAM2100', 'KAT1', '1', '100', '100', '2022-07-01 05:40:44'),
(23, 'RETP1656654381', 'SAM2100', 'KAT1', '10', '100', '1000', '2022-07-01 05:46:28'),
(24, 'RETP1656654057', 'SAM2100', 'KAT1', '1', '100000', '100000', '2022-07-01 05:49:54'),
(26, 'RETP1656657393', 'SAM2100', 'KAT1', '10', '100', '1000', '2022-07-01 06:37:28');

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
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `purchase_retur`
--

INSERT INTO `purchase_retur` (`id`, `sales_retur_id`, `total_price`, `total_item`, `is_return`, `date`) VALUES
('RETP1656568416', 'TES111', '39000', '13', '1', '2022-07-01 05:40:04'),
('RETP1656568446', 'A123AS', '100', '1', '1', '2022-07-01 05:39:46'),
('RETP1656650967', 'TES333', '1000', '10', '1', '2022-07-01 05:39:17'),
('RETP1656654032', 'A123AS', '100', '1', '1', '2022-07-01 05:40:44'),
('RETP1656654057', 'XXX', '100000', '1', '1', '2022-07-01 05:49:54'),
('RETP1656654381', 'TES333', '1000', '10', '0', '2022-07-01 00:46:21'),
('RETP1656657393', 'TES333', '1000', '10', '1', '2022-07-01 06:37:28');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_transaction`
--

CREATE TABLE `purchase_transaction` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `total_price` int(20) NOT NULL,
  `total_item` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `supplier_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `purchase_transaction`
--

INSERT INTO `purchase_transaction` (`id`, `total_price`, `total_item`, `date`, `supplier_id`) VALUES
('A123AS', 100, 1, '2022-06-30 03:02:52', 'SUP002'),
('TES111', 150000, 50, '2022-06-30 04:10:52', 'SUP001'),
('TES333', 1000, 10, '2022-07-01 04:32:38', 'SUP001'),
('XXX', 100000, 1, '2022-06-30 09:42:46', 'SUP001');

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
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sales_data`
--

INSERT INTO `sales_data` (`id`, `sales_id`, `product_id`, `category_id`, `quantity`, `price_item`, `subtotal`, `date`) VALUES
(1, 'OUT1656556726', 'SAM2100', 'KAT1', '1', '210000', '210000', '2022-06-30 02:39:08'),
(2, 'OUT1656556909', 'SAM2100', 'KAT1', '1', '210000', '210000', '2022-06-30 02:42:47'),
(3, 'OUT1656564638', 'SAM2100', 'KAT1', '1', '210000', '210000', '2022-06-30 04:50:49'),
(4, 'OUT1656564671', '12312', 'KAT1', '1', '12', '12', '2022-06-30 04:51:19'),
(5, 'OUT1656564789', 'SAM2100', 'KAT1', '1', '210000', '210000', '2022-06-30 04:54:23'),
(6, 'OUT1656565193', 'SAM2100', 'KAT1', '1', '210000', '210000', '2022-06-30 05:00:04'),
(7, 'OUT1656565440', 'SAM2100', 'KAT1', '1', '210000', '210000', '2022-06-30 05:04:13'),
(8, 'OUT1656569375', 'SAM2100', 'KAT1', '1', '210000', '210000', '2022-06-30 06:09:44'),
(9, 'OUT1656569421', 'SAM2100', 'KAT1', '1', '210000', '210000', '2022-06-30 06:10:32'),
(10, 'OUT1656571757', '12312', 'KAT1', '1', '12', '12', '2022-06-30 06:49:25'),
(11, 'OUT1656582552', '12312', 'KAT1', '1', '12', '12', '2022-06-30 09:49:26'),
(12, 'OUT1656585993', 'SAM2100', 'KAT1', '1', '210000', '210000', '2022-06-30 10:46:44');

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
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sales_transaction`
--

INSERT INTO `sales_transaction` (`id`, `customer_id`, `is_cash`, `total_price`, `total_item`, `date`) VALUES
('OUT1656556726', 'tes', 1, 210000, 1, '2022-06-30 02:39:08'),
('OUT1656556909', 'tess', 1, 210000, 1, '2022-06-30 02:42:47'),
('OUT1656564638', 'asd', 1, 210000, 1, '2022-06-30 04:50:49'),
('OUT1656564671', '123123', 1, 12, 1, '2022-06-30 04:51:19'),
('OUT1656564789', '3', 1, 210000, 1, '2022-06-30 04:54:23'),
('OUT1656565193', 'asd', 1, 210000, 1, '2022-06-30 05:00:03'),
('OUT1656565440', 'asd', 1, 210000, 1, '2022-06-30 05:04:13'),
('OUT1656569375', 'asdas', 1, 210000, 1, '2022-06-30 06:09:44'),
('OUT1656569421', '123', 1, 210000, 1, '2022-06-30 06:10:32'),
('OUT1656571757', 'tasdasd', 1, 12, 1, '2022-06-30 06:49:25'),
('OUT1656582552', 'xxx', 1, 12, 1, '2022-06-30 09:49:26'),
('OUT1656585993', '74', 1, 210000, 1, '2022-06-30 10:46:44');

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
('SUP001', 'Alan New', '081751261251', 'Kalibata City', '2016-05-20 17:00:00'),
('SUP002', 'Made', '', 'Made', '2016-05-25 14:45:17'),
('SUP003', 'tes', '123123', 'asdas', '2022-06-27 11:30:29');

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

--
-- Dumping data for table `trans`
--

INSERT INTO `trans` (`id`, `code`, `total`, `dibayar`, `kembalian`) VALUES
(1, 'OUT1656556726', 210000, 250000, 40000),
(2, 'OUT1656556909', 210000, 250000, 40000),
(3, 'OUT1656564638', 210000, 250000, 40000),
(4, 'OUT1656564671', 12, 13, 1),
(5, 'OUT1656564789', 210000, 250000, 40000),
(6, 'OUT1656565193', 210000, 250000, 40000),
(7, 'OUT1656565440', 210000, 250000, 40000),
(8, 'OUT1656569375', 210000, 250000, 40000),
(9, 'OUT1656569421', 210000, 250000, 40000),
(10, 'OUT1656571757', 12, 13, 1),
(11, 'OUT1656582430', 12, 13, 1),
(12, 'OUT1656582462', 210000, 250000, 40000),
(13, 'OUT1656582552', 12, 13, 1),
(14, 'OUT1656585993', 210000, 250000, 40000);

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
  `role` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `photo_profile`, `password`, `role`) VALUES
(1, 'alan', 'admin@admin.com', '', '21232f297a57a5a743894a0e4a801fc3', 1),
(3, 'kasir', 'kasir@kasir.com', NULL, 'c7911af3adbd12a035b289556d96470a', 0);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `sales_data`
--
ALTER TABLE `sales_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `trans`
--
ALTER TABLE `trans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
