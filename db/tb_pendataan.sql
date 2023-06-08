-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2023 at 10:49 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `akuntansi`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_pendataan`
--

CREATE TABLE `tb_pendataan` (
  `id_pendataan` int(11) NOT NULL,
  `judul` varchar(250) DEFAULT NULL,
  `jenis` int(11) DEFAULT NULL COMMENT '1 = pengeluaran, 2 = pemasukan, 3 = aset',
  `tgl_kasus` date DEFAULT NULL,
  `nominal` decimal(16,2) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `lampiran` varchar(100) DEFAULT NULL,
  `tgl_entri` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_pendataan`
--
ALTER TABLE `tb_pendataan`
  ADD PRIMARY KEY (`id_pendataan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_pendataan`
--
ALTER TABLE `tb_pendataan`
  MODIFY `id_pendataan` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
