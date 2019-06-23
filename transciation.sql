-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2019 at 09:48 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `paypalpayment`
--

-- --------------------------------------------------------

--
-- Table structure for table `transciation`
--

CREATE TABLE `transciation` (
  `id` bigint(20) NOT NULL,
  `payId` varchar(60) NOT NULL,
  `state` varchar(35) NOT NULL,
  `status` varchar(35) NOT NULL,
  `email` varchar(50) NOT NULL,
  `first_name` varchar(180) NOT NULL,
  `last_name` varchar(180) NOT NULL,
  `payerId` varchar(45) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `totalCurrency` varchar(15) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `invoiceNumber` varchar(155) NOT NULL,
  `saleId` varchar(255) NOT NULL,
  `stateComplete` varchar(35) NOT NULL,
  `transactionFee` decimal(10,2) NOT NULL,
  `transactionFeeCurrency` varchar(15) NOT NULL,
  `createTime` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `transciation`
--
ALTER TABLE `transciation`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transciation`
--
ALTER TABLE `transciation`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
