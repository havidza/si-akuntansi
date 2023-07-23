-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 23, 2023 at 11:58 AM
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
-- Table structure for table `tb_pendataan_log`
--

CREATE TABLE `tb_pendataan_log` (
  `id_pendataan` int(11) NOT NULL,
  `judul` varchar(250) DEFAULT NULL,
  `jenis` int(11) DEFAULT NULL COMMENT '1 = pengeluaran, 2 = pemasukan, 3 = aset',
  `tgl_kasus` date DEFAULT NULL,
  `nominal` decimal(16,2) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `lampiran` varchar(100) DEFAULT NULL,
  `tgl_entri` datetime DEFAULT NULL,
  `user` varchar(50) DEFAULT NULL,
  `aksi` varchar(50) DEFAULT NULL,
  `tgl_aksi` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
