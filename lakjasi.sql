-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2023 at 02:18 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lakjasi`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `id` int(255) UNSIGNED NOT NULL,
  `email_pengguna` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `hashlink` varchar(255) NOT NULL,
  `no_whatsapp` bigint(20) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `role` int(1) NOT NULL,
  `status_active` int(1) NOT NULL,
  `updated_at` date DEFAULT NULL,
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`id`, `email_pengguna`, `nama`, `password`, `hashlink`, `no_whatsapp`, `tanggal_lahir`, `role`, `status_active`, `updated_at`, `created_at`) VALUES
(14, 'admin@gmail.com', 'Admin', '$2y$10$B31bwTGFO2YHtMAG2Pw0E.jbp.nrb6E8lSMvmzTo6jaa9VUOXO7O.', '', 6281936666423, '2023-01-03', 1, 1, '2023-01-20', '2023-01-03'),
(23, 'fajar.indrawan26@gmail.com', 'Fajar Indrawan', '$2y$10$nRQaZtBObuEKs0CvtE6Lkegzte5zfQRcPkTU/fNRiKOAFB0B2rhRW', '', 6281936666423, '2023-02-09', 2, 1, '2023-02-09', '2023-02-09'),
(24, 'fiqri@gmail.com', 'Fiqri Baihaqi', '$2y$10$9CYxbJ1iKkVrz4ruqAFKjunifUhlWN3V0n4IWgda5Fyob2PINjiL.', '', 6281252227930, '2023-02-20', 2, 1, '2023-02-20', '2023-02-20'),
(25, 'bisma@gmail.com', 'Ardiansyah Bisma', '$2y$10$cu5BfNfQ12nHsTtvJsUFeOqblvvocV9QJKuMGimPRKed6hpL2Nfr6', '', 6285815243464, '2023-02-20', 2, 1, '2023-02-20', '2023-02-20');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(13, '2022-10-11-040728', 'App\\Database\\Migrations\\Pelaporan', 'default', 'App', 1673166093, 1),
(14, '2022-10-11-040747', 'App\\Database\\Migrations\\StatusPelaporan', 'default', 'App', 1673166093, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pelaporan`
--

CREATE TABLE `pelaporan` (
  `id_laporan` int(255) UNSIGNED NOT NULL,
  `id_akun` int(255) UNSIGNED NOT NULL,
  `lat` varchar(255) NOT NULL,
  `long` varchar(255) NOT NULL,
  `lokasifoto` varchar(128) NOT NULL,
  `tanggal_pelaporan` datetime NOT NULL,
  `foto` varchar(255) NOT NULL,
  `tingkat_rusak` varchar(64) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `status_pelaporan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `pelaporan`
--

INSERT INTO `pelaporan` (`id_laporan`, `id_akun`, `lat`, `long`, `lokasifoto`, `tanggal_pelaporan`, `foto`, `tingkat_rusak`, `keterangan`, `status_pelaporan`) VALUES
(22, 14, '-7.3836575', '112.6317722', '7°25\'58.69\"S,112°34\'38.5\"E', '2023-03-03 00:50:00', '1677779527_3d6b5ac3780f131c192e.jpg', 'Rusak Berat', 'deres', 'Laporan Diterima'),
(25, 14, '-7.3181003', '112.7271187', '7°16\'40.43\"S,112°44\'7.44\"E', '2023-03-03 15:34:00', '1677832449_efc31f4c34601763b19b.jpg', 'Rusak Ringan', '', 'Laporan Diterima');

-- --------------------------------------------------------

--
-- Table structure for table `status_pelaporan`
--

CREATE TABLE `status_pelaporan` (
  `id` int(255) UNSIGNED NOT NULL,
  `id_pelaporan` int(255) UNSIGNED NOT NULL,
  `status_pelaporan` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `status_pelaporan`
--

INSERT INTO `status_pelaporan` (`id`, `id_pelaporan`, `status_pelaporan`, `created_at`, `updated_at`) VALUES
(61, 22, 'Laporan Telah Dikirim', '2023-03-03 00:52:07', '2023-03-03 00:52:07'),
(62, 22, 'Laporan Diterima', '2023-03-03 01:10:38', '2023-03-03 01:10:38'),
(67, 25, 'Laporan Telah Dikirim', '2023-03-03 15:34:09', '2023-03-03 15:34:09'),
(68, 25, 'Laporan Diterima', '2023-03-03 15:34:19', '2023-03-03 15:34:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelaporan`
--
ALTER TABLE `pelaporan`
  ADD PRIMARY KEY (`id_laporan`),
  ADD KEY `pelaporan_id_akun_foreign` (`id_akun`);

--
-- Indexes for table `status_pelaporan`
--
ALTER TABLE `status_pelaporan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status_pelaporan_id_pelaporan_foreign` (`id_pelaporan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pelaporan`
--
ALTER TABLE `pelaporan`
  MODIFY `id_laporan` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `status_pelaporan`
--
ALTER TABLE `status_pelaporan`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pelaporan`
--
ALTER TABLE `pelaporan`
  ADD CONSTRAINT `pelaporan_id_akun_foreign` FOREIGN KEY (`id_akun`) REFERENCES `akun` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `status_pelaporan`
--
ALTER TABLE `status_pelaporan`
  ADD CONSTRAINT `status_pelaporan_id_pelaporan_foreign` FOREIGN KEY (`id_pelaporan`) REFERENCES `pelaporan` (`id_laporan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
