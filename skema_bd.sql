-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2023 at 11:41 AM
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
(1, 1, 'eMxmySb0gKgP5ZYLFBMMZw==', 'eMxmySb0gKgP5ZYLFBMMZw==', 'eMxmySb0gKgP5ZYLFBMMZw==', 'eMxmySb0gKgP5ZYLFBMMZw==', 'eMxmySb0gKgP5ZYLFBMMZw==', 'eMxmySb0gKgP5ZYLFBMMZw==', 'LMssLA8mmP5fovx+zSRAvIZMcNECL7ORthAamY62Z+4=', 'ooKn7mQAcvzerJFTPI7CwA==', 'OSOPLsGafVsgLPy568vXa0QUOWle2xe0DiC8mjrejDA=', 0x2db32df20a1c710e31cb8329b88a3ade, 0xc73366e7fec8bcaba21840940fb22651c4095667f3241c44f947715f6f368d5a),
(2, 1, '0biYj+l7Rbn969t3uAOLnQ==', 'TY3HsaaPO1Dbrt3O1q5l8g==', 'm1hVlHzUnSpge12RJbQEXA==', 'FlaYE5V8eFoDIyYsk4Awkw==', 'HhdZghe9oKYKjGuge++ndQ==', 'BvapG8+LZiZIRjnxN/8jlQ==', '6tRfo2G75czIxMc+V4MNVHvZ0oZ1aAUwqXVYE4BB8H0=', 'fWnLXOR1KRK4k2rXJlzzGw==', 'oBjIrzau+d5B/HbCY6TRgXPOpmrtjqD4k7vTAByMvW8=', 0xc34b856516067f80ece1bf80893cbaa4, 0x1b9fb7ef0ccd3736d7cd33532d6e47d3063c1108891d350382c86428c0e0021b),
(3, 2, 'lR8h8Ng+pgKtsV6nqy36Ig==', 'lR8h8Ng+pgKtsV6nqy36Ig==', 'lR8h8Ng+pgKtsV6nqy36Ig==', 'lR8h8Ng+pgKtsV6nqy36Ig==', 'lR8h8Ng+pgKtsV6nqy36Ig==', 'lR8h8Ng+pgKtsV6nqy36Ig==', 'jCLHNDtlLj2jqwO+/4F+Ww==', '5dPlP9xUyxRgTQtZ4OIkBw==', 'HJlPXw4JeS/xickNuUg6qQ==', 0xa45b5b299bd33f0a59eb1479d1555352, 0x2b2b99feef02753df84b137861c82e8ab91838fed33e7e11959b0479eb53352f),
(4, 2, 'm4bf1cihIrArBrxwVhT4AQ==', '1Xe1YyYGF2rtPdq96J+cpg==', 'ASiN+NGWTOLloreTs1s9FQ==', 'd+mbWA3gy427ocC3Rrw+Pw==', 'gR7j/Gbxd5nN0HTAcvF+Lg==', 'NeXPV/e4MovzBrgIEkiyGQ==', 'GHqp8qyRDk7Ay9UT4LsitQ==', 'jPCfrMyx4ncX9nulvJmOZQ==', '1r+i0AadkGEbRGBPQ32dmA==', 0x756e14db5f2d37501d0a1f61c145dce2, 0xba00d999f773fdf7631abdd4bb0f45293d251f8eab64736d760163ef8bdf90e9);

-- --------------------------------------------------------

--
-- Table structure for table `ki_akses_data`
--

CREATE TABLE `ki_akses_data` (
  `id` int(11) NOT NULL,
  `id_pengakses` int(11) NOT NULL,
  `id_data` int(11) NOT NULL,
  `init_vector` varbinary(16) NOT NULL,
  `enc_key` varbinary(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ki_akses_data`
--

INSERT INTO `ki_akses_data` (`id`, `id_pengakses`, `id_data`, `init_vector`, `enc_key`) VALUES
(1, 1, 4, 0x756e14db5f2d37501d0a1f61c145dce2, 0xba00d999f773fdf7631abdd4bb0f45293d251f8eab64736d760163ef8bdf90e9);

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
(1, 1, '2A==', '2A==', '2A==', '2A==', '2A==', '2A==', '6Qe9P/Xc9P16fUyTolVuQav0W0qt', '5CuObOWppKApYQzP6B8=', '9gO+Uvfe9/58fkSWqlRrQabtH1e6eg==', 0xb055632dc00a500b, 0x941dabac889e9467ffc5209bc2a43c4f908088b1e6323e3c43394becf92324c8),
(2, 1, 'yMaBazJsy4GDSpgUJg==', 'zsPMdj1w', 'xc2HYzA=', 'xceLYzA=', '3MaNag==', 'mZo=', '4O+rMGw3icXHGdRLbbUaFIA=', '7cOYYxtk1ZDfU4AILA==', '/+uoXW41isbBGtxOZaheCZdP', 0x6a73863f0901a139, 0x68a5bebba6214fb1d6ac31b2226c7a8b591ce0bffa8ce4446989e93aa838e8),
(3, 2, 'Wg==', 'Wg==', 'Wg==', 'Wg==', 'Wg==', 'Wg==', 'aqOQz0KQvtonHeR/hA==', 'Z4+QnFza45lp', 'daeTokCSvdkhAqBikx4=', 0x0b96ce4af4a0d576, 0xfd7d2fcb01bca3b312f136c2f7eab10804e4dd5ae49017b7d206392839575e28);

-- --------------------------------------------------------

--
-- Table structure for table `ki_minta_akses`
--

CREATE TABLE `ki_minta_akses` (
  `id` int(11) NOT NULL,
  `id_pemohon` int(11) NOT NULL,
  `status_akses` tinyint(4) NOT NULL,
  `id_dimohon` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ki_minta_akses`
--

INSERT INTO `ki_minta_akses` (`id`, `id_pemohon`, `status_akses`, `id_dimohon`) VALUES
(1, 1, 1, 2);

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
(1, 1, '?', '?', '?', '?', '?', '?', '?2I??r??Je?H%7r??]', '?z????y[?F', '?6J??p??Lf?I 7?K?J?', 0x6b695f726334, 0x342c39362c33322c37302c36372c3139392c3133362c3232302c3230352c3132),
(2, 1, '????ů?=c˓?', '????ʳ', '?????', '?????', '????', '??', '??屛??Jy0?̂?j?O', '???????azӏ?', '???ܙ??I3?Ɋ?.?X', 0x6b695f726334, 0x36332c3132382c34312c36302c3131302c3136322c37372c352c3132362c3135),
(3, 2, '>', '>', '>', '>', '>', '>', 'ݜ????=???V?', '??????~?', 'ٟ????>???K?d', 0x6b695f726334, 0x3130382c31382c3137342c37382c36322c372c3135332c31352c37312c34362c),
(4, 2, '?,?', '?,?', '?\"?K', '?(?K', '?(?J', '?u?[', '?\0?X?p', '?\n?K?', '??5B?m?', 0x6b695f726334, 0x33342c3130382c33322c3138322c3130332c3137312c35322c3135342c39392c);

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
-- Indexes for table `ki_akses_data`
--
ALTER TABLE `ki_akses_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pengakses` (`id_pengakses`,`id_data`),
  ADD KEY `id_data` (`id_data`);

--
-- Indexes for table `ki_des`
--
ALTER TABLE `ki_des`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pengguna` (`id_pengguna`);

--
-- Indexes for table `ki_minta_akses`
--
ALTER TABLE `ki_minta_akses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pemohon` (`id_pemohon`,`id_dimohon`),
  ADD KEY `id_dimohon` (`id_dimohon`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ki_akses_data`
--
ALTER TABLE `ki_akses_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ki_des`
--
ALTER TABLE `ki_des`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ki_minta_akses`
--
ALTER TABLE `ki_minta_akses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ki_pengguna`
--
ALTER TABLE `ki_pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ki_rc4`
--
ALTER TABLE `ki_rc4`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
