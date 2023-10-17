-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2023 at 07:52 AM
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
  `nama_lengkap` varchar(256) NOT NULL,
  `jenis_kelamin` varchar(256) NOT NULL,
  `warga_negara` varchar(256) NOT NULL,
  `agama` varchar(256) NOT NULL,
  `status_kawin` varchar(256) NOT NULL,
  `no_telepon` varchar(256) NOT NULL,
  `foto_ktp` varchar(256) NOT NULL,
  `dokumen` varchar(256) NOT NULL,
  `video` varchar(256) NOT NULL,
  `init_vector` varbinary(16) NOT NULL,
  `enc_key` varbinary(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ki_aes`
--

INSERT INTO `ki_aes` (`id`, `id_pengguna`, `nama_lengkap`, `jenis_kelamin`, `warga_negara`, `agama`, `status_kawin`, `no_telepon`, `foto_ktp`, `dokumen`, `video`, `init_vector`, `enc_key`) VALUES
(1, 1, 'YkGM439DjoWrLc2Rh8NEEg==', '5VAwA8M0Z4Mx8MutiUIM6A==', '4vI/GZUqcHgGYZ0mCDk9Wg==', '3Z89iu9VJkjU7Qr/IIrWBQ==', '6zCRE+Kbeorx5AoKk+fLyQ==', 'kqQ+31qumA0Kdc+KMJUI1A==', 'BTctYjCrROCZiBBzCoLIfQ==', 'NUbqDjJ/j/bCiD0KHOhOQQ==', 'vtUFwVOd40LApfRWK8T2bw==', 0x672e901d3d859dba88030e45db2bc19d, 0x168d17a404144afeb8ab50cb0267ed1cce1a97f173d6ac15e5d6683db2bc450d),
(2, 1, 'vymx+QIzb3L76sW76J+TGw==', 'rj5W2v/itimGsRyKigqnJA==', 'eMrvQq3bu1Do6HszQ8j01A==', '2f2sb39RvD97slOwA6l5Kw==', 'lIXGuYJUCOiBj7NJ79pPiA==', 'j8i0MtCJyeuIrsg1cX81HQ==', '0Nhg2Fhx4s7f2G9C8ERifA==', 'B8y3JdKDswzNHacBuyInIQ==', 'xE6h75bitQRIudJH3JYfQA==', 0xcb9e2400cb4d91c15ac9572d5b6cef02, 0xa89d76f688f770dacb673120dbe2de74848125dcc587e976c8eb8e13b34cd1e0);

-- --------------------------------------------------------

--
-- Table structure for table `ki_des`
--

CREATE TABLE `ki_des` (
  `id` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `nama_lengkap` varchar(256) NOT NULL,
  `jenis_kelamin` varchar(256) NOT NULL,
  `warga_negara` varchar(256) NOT NULL,
  `agama` varchar(256) NOT NULL,
  `status_kawin` varchar(256) NOT NULL,
  `no_telepon` varchar(256) NOT NULL,
  `foto_ktp` varchar(256) NOT NULL,
  `dokumen` varchar(256) NOT NULL,
  `video` varchar(256) NOT NULL,
  `init_vector` varbinary(16) NOT NULL,
  `enc_key` varbinary(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ki_des`
--

INSERT INTO `ki_des` (`id`, `id_pengguna`, `nama_lengkap`, `jenis_kelamin`, `warga_negara`, `agama`, `status_kawin`, `no_telepon`, `foto_ktp`, `dokumen`, `video`, `init_vector`, `enc_key`) VALUES
(1, 1, '0A==', '0w==', '0g==', '1Q==', '1A==', '1w==', '183Fu4h/Gms=', '1c3aoctwBCI/Im5m', 'x8vVsck7B3xz', 0x2556de5b1508efcf, 0xbd03fa0b3811ee6a2abe3eca93ec447f9e29a941fa69214e691fda60f4614c4c),
(2, 1, 'AO+3NWMWanyE+UtYew==', 'Fe6oO2wRbX2Y/w==', 'KOW+M2MaamGX', 'KPi2PWA=', 'FO+7NA==', 'UbPobQ==', 'B+SuMyMVaW8=', 'BeSxKWAadyaO9ExP', 'F+K+OWJRdHjC', 0xb101e92c85b0afae, 0x74e18026d45974ae93c42f7bcb8fb38d2a6c4ecc321047dfbc76ca2b88e5b67e);

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

--
-- Dumping data for table `ki_pengguna`
--

INSERT INTO `ki_pengguna` (`id`, `username`, `password`, `katasandi`) VALUES
(1, 'admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 'admin'),
(2, 'san', '6b9cd7872ae634539ea1a99e1c4c16b41c9314c99192560ecf9c4bb846647655', 'san'),
(3, 'azizah', '8bf18ab6cfa4db5582b05d4e42be03822392f7c7b3b08737096f872ec886af6c', 'azizah'),
(4, 'ulima', '51719e5a02eba6831734b46bc49dd444734c6120383673991ae45583f45bc06d', 'ulima');

-- --------------------------------------------------------

--
-- Table structure for table `ki_rc4`
--

CREATE TABLE `ki_rc4` (
  `id` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `nama_lengkap` varchar(256) NOT NULL,
  `jenis_kelamin` varchar(256) NOT NULL,
  `warga_negara` varchar(256) NOT NULL,
  `agama` varchar(256) NOT NULL,
  `status_kawin` varchar(256) NOT NULL,
  `no_telepon` varchar(256) NOT NULL,
  `foto_ktp` varchar(256) NOT NULL,
  `dokumen` varchar(256) NOT NULL,
  `video` varchar(256) NOT NULL,
  `init_vector` varbinary(16) NOT NULL,
  `enc_key` varbinary(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ki_rc4`
--

INSERT INTO `ki_rc4` (`id`, `id_pengguna`, `nama_lengkap`, `jenis_kelamin`, `warga_negara`, `agama`, `status_kawin`, `no_telepon`, `foto_ktp`, `dokumen`, `video`, `init_vector`, `enc_key`) VALUES
(1, 1, '', '', '', '', '', '', '', '', '', '', 0x2c3c97cdf6fe687a7b788168d41af5c728e4fb965f7afd969be37467605122b3),
(2, 1, '', '', '', '', '', '', '', '', '', '', 0x9914aace4d9a905ed22c01a53c4b7f3dc02d350fc6ba5778a13ab0a59a681bcc);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ki_des`
--
ALTER TABLE `ki_des`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ki_pengguna`
--
ALTER TABLE `ki_pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ki_rc4`
--
ALTER TABLE `ki_rc4`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
