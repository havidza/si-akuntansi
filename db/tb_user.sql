-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: php8-database
-- Generation Time: May 25, 2023 at 11:04 AM
-- Server version: 8.0.29
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kendal_petaznt`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

DROP TABLE IF EXISTS `tb_user`;
CREATE TABLE `tb_user` (
  `id_user` bigint NOT NULL,
  `nama_user` varchar(120) DEFAULT NULL,
  `nik` varchar(16) DEFAULT NULL,
  `alamat_user` varchar(200) DEFAULT NULL,
  `phone_user` varchar(20) DEFAULT NULL,
  `email_user` varchar(65) DEFAULT NULL,
  `username_user` varchar(50) NOT NULL,
  `password_user` varchar(255) NOT NULL,
  `group_user` varchar(50) DEFAULT NULL COMMENT '100:admin helper;101:admin Verifikator;102:Petugas Entry Data;1000:Stakeholder',
  `tgl_registrasi` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `stat_aktif` varchar(1) NOT NULL DEFAULT 'N' COMMENT 'Y:Aktif;N:Tidak Aktif',
  `tgl_aktivasi` datetime DEFAULT NULL,
  `kd_opd` char(7) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama_user`, `nik`, `alamat_user`, `phone_user`, `email_user`, `username_user`, `password_user`, `group_user`, `tgl_registrasi`, `stat_aktif`, `tgl_aktivasi`, `kd_opd`) VALUES
(1, 'Kendal', '123123123123', 'Kendal', '6285865781363', NULL, 'mdatrial', '13df87041f42a3c408b621fa28ba2e82', '100', '2021-03-22 03:39:51', 'Y', NULL, NULL),
(2, 'MDS', NULL, 'Solo', '123', NULL, 'mds', '1f26ffadeaaa1e9011e92612600647fa', '100', '2021-03-23 06:35:02', 'Y', NULL, NULL),
(23, 'Stakeholder', NULL, 'Solo', '0812345678', NULL, 'stakeholder', '4f915cb3dcfb9dbfc7dff89f1f63e896', '1000', '2021-07-19 06:43:36', 'N', NULL, NULL),
(24, 'MD Operator', NULL, 'Solo', '0812345678', NULL, 'mdop', 'd9daecebab82cebee69c0b18899c0ce6', '101', '2021-11-02 16:19:06', 'N', NULL, NULL),
(27, 'bagas', NULL, 'bagas', 'bagas', NULL, 'bagas', 'fb27b33754035af6d9a006b51b186ca3', '100', '2022-06-16 03:55:51', 'N', NULL, NULL),
(28, 'a', NULL, 'a', '1', NULL, 'a', '53141dc889635e3f8593c7348efd6ac0', '100', '2022-10-31 08:24:52', 'N', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username_user` (`username_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
