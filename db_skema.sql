-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2023 at 04:23 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `buat_belajar`
--

-- --------------------------------------------------------

--
-- Table structure for table `ki_aes`
--

CREATE TABLE `ki_aes` (
  `id` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `nama_lengkap` varchar(128) NOT NULL,
  `jenis_kelamin` varchar(128) NOT NULL,
  `warga_negara` varchar(128) NOT NULL,
  `agama` varchar(128) NOT NULL,
  `status_kawin` varchar(128) NOT NULL,
  `no_telepon` varchar(128) NOT NULL,
  `foto_ktp` varchar(128) NOT NULL,
  `dokumen` varchar(128) NOT NULL,
  `video` varchar(128) NOT NULL,
  `init_vector` varbinary(16) NOT NULL,
  `enc_key` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ki_des`
--

CREATE TABLE `ki_des` (
  `id` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `nama_lengkap` varchar(128) NOT NULL,
  `jenis_kelamin` varchar(128) NOT NULL,
  `warga_negara` varchar(128) NOT NULL,
  `agama` varchar(128) NOT NULL,
  `status_kawin` varchar(128) NOT NULL,
  `no_telepon` varchar(128) NOT NULL,
  `foto_ktp` varchar(128) NOT NULL,
  `dokumen` varchar(128) NOT NULL,
  `video` varchar(128) NOT NULL,
  `init_vector` varbinary(16) NOT NULL,
  `enc_key` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ki_pengguna`
--

CREATE TABLE `ki_pengguna` (
  `id` int(11) NOT NULL,
  `username` varchar(16) NOT NULL,
  `password` varchar(256) NOT NULL,
  `katasandi` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ki_rc4`
--

CREATE TABLE `ki_rc4` (
  `id` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `nama_lengkap` varchar(128) NOT NULL,
  `jenis_kelamin` varchar(128) NOT NULL,
  `warga_negara` varchar(128) NOT NULL,
  `agama` varchar(128) NOT NULL,
  `status_kawin` varchar(128) NOT NULL,
  `no_telepon` varchar(128) NOT NULL,
  `foto_ktp` varchar(128) NOT NULL,
  `dokumen` varchar(128) NOT NULL,
  `video` varchar(128) NOT NULL,
  `init_vector` varbinary(16) NOT NULL,
  `enc_key` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ki_aes`
--
ALTER TABLE `ki_aes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pengguna` (`id_pengguna`);

--
-- Indexes for table `ki_des`
--
ALTER TABLE `ki_des`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pengguna` (`id_pengguna`);

--
-- Indexes for table `ki_pengguna`
--
ALTER TABLE `ki_pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ki_rc4`
--
ALTER TABLE `ki_rc4`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pengguna` (`id_pengguna`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ki_aes`
--
ALTER TABLE `ki_aes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ki_des`
--
ALTER TABLE `ki_des`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ki_pengguna`
--
ALTER TABLE `ki_pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ki_rc4`
--
ALTER TABLE `ki_rc4`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
