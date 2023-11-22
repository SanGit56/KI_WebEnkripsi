-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2023 at 02:10 AM
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
(2, 1, 'vymx+QIzb3L76sW76J+TGw==', 'rj5W2v/itimGsRyKigqnJA==', 'eMrvQq3bu1Do6HszQ8j01A==', '2f2sb39RvD97slOwA6l5Kw==', 'lIXGuYJUCOiBj7NJ79pPiA==', 'j8i0MtCJyeuIrsg1cX81HQ==', '0Nhg2Fhx4s7f2G9C8ERifA==', 'B8y3JdKDswzNHacBuyInIQ==', 'xE6h75bitQRIudJH3JYfQA==', 0xcb9e2400cb4d91c15ac9572d5b6cef02, 0xa89d76f688f770dacb673120dbe2de74848125dcc587e976c8eb8e13b34cd1e0),
(3, 2, 'zE2BZbHnAqqMWzoGILCF2w==', 'amaANPlFFr6J7dakQpNNLA==', 'jpTQzmGCIpfiFdkzBUzWlg==', '5RQVjBXaT2716Sq0591Z1w==', 'KOQn/aRcQWrTO5d9XoV/Rw==', 'wgNHHTZRRmgxIYv4C6pYrQ==', 'EjoKwQMqmFXDjiPna8MByA==', 'gX5qzqp3OLiONfc4VPvJnw==', 'VGjVqN5K+42YBGCVzIbXnA==', 0x182edb7206bb1298a88283a9ec729e0a, 0xb5fae338b8cc733dd707299c739071f683d692349cd49b06597ff772fad1f041),
(4, 1, 'gV/NHAPRr1L4WxSdzqS9wg==', 'AMEh45Z+2FLzYqhJ/s8v4A==', 'Lj1LsdtAZBHZ+8waOFGnFQ==', 'uXm0/UgWlnzv68N5mmOd3Q==', 'x5UP45l7mQk6hHCXO8MVIw==', 'hHQyNcEacY0XcqHlmAIS2Q==', 'LbVCRaS1F0vC9RGq8r17Qw==', 'AAgqzBodc9YK1hh1LTkNbg==', 'hIxdf3ZdZYlB4F4pDGN0xA==', 0x849cfd0b76d1bebb6f98b31314095a3e, 0xf366d06fb6f49f232b96bb3e7b8e287f3e6f0df53c1b864d0bb8da4942d0c1a9),
(5, 2, 'eq6lDYFeRifBE3Mh1+6pSA==', 'dCDG6cmZCCeUQW9Fh543KA==', 'RBkK4n/L+hmjMhairY/yug==', '/R5kWvsm2czKsU33KNgRKQ==', 'ep46lt7YKQt/GRV8T3eXmA==', 'TB3OJdJyzqZgXF+wMk5N9Q==', 'jiR12C9T/157YzHgR8axpg==', 'xwqlntIbd5837ebIlMnvaw==', 'us4EZIxmWxBj+2TxduwS3Q==', 0x349f56e4c9dd557b38b8bb641c037bda, 0xb54d755deca51410e636af00c848b755ebea9ac47209f666b03306560a13177e),
(6, 2, 'IiO4pwEGa+Azd5cB5O6g8A==', 'C2mGTLHeH4Hz9GZ2mk+JMA==', '1ZDZTL9WZ29Fu5N7eE6Few==', '5qaEJH+twiIuAv20LKJyQA==', 'wQ4Z1MwYwVWq92gxRYQVJw==', 'slymeA1WWePrvTjryjbYjQ==', 'XI4OqZII+7NRYKys0LAzAg==', 'mOlyBPBPPPZ32FNnEYMZwg==', 'VZjsYd5lgElwliDsJZO3DQ==', 0xe566dbd3a0719b1c078e069bd0abf54b, 0xb556b5c3f0d6580f49f39d39465426f98b105f9562510f63bebc9ffb02c77f95),
(7, 2, 'rLP+NCBK6dBwf+SS5DI2Kw==', 'FvVPhNLG6StjG6z//vl7jg==', 'IzjCcwDyOeKOHmenk04fRw==', 'NgffrkCu6hiLR4qtuLHntA==', '1Fb0TcS2IeIFreud44AndA==', 'fK8vZ4MQbaQixFUdaYFBew==', 'Ew86muoMjepORtC3O9I96Q==', 'Vly7QFuGReJgEvMSeGB/GQ==', 'rPde85qLHYQmvBCyW5Sv+A==', 0x1ff2fcd6972298e08eb4bae6d88026, 0xa8ca369798bd9e4223aff02976eb474dd085964084a8d7d611cc438b2c59855d),
(8, 3, 'D1rng/ZtZ8zOPENqhgO15A==', 'RZ3sw4lV4ZA41PgRO2BSVA==', 'Rk+86EV1FMfs1i6naNJm5g==', 'tFjIqQvtQsEAti3uink/aA==', 'sxND5Ylais50kfFRO1DFJQ==', '680Cl2+t0NyGl4iTNHsxHA==', '91Dbvq1+DKR6h8B9PxW1XQ==', 'SHVMZuLeIwRPdLKYqrea7A==', 'xkQULoKw5pAsqMP4t9cswA==', 0xf13c9649f5f43882283cbd86dbdf8503, 0x99c9b50bbc601999fea99ac9309eb6d1c613bd87ca14774d5f9d20f1d94ae4),
(9, 3, 'ZDsAKPAtAO6fjDIl29c+Cw==', 'IEZfGyCNMg3kN79BscyVtg==', '1vKRkvHQgqhT/gpy9VHluQ==', 'D1s9v8QV/957ICokMEvbCQ==', 'j8F29XsWkknfT3AzGZ0LYw==', 'ZCoAx0Z0lDKOfvQtd/ijeA==', '+lz9LY9m5+EFqivfNi7Xeg2ukrLCusUUSHlWYrcKF8k=', 'Le0B3ONoJrn7iuuj/BO2XQ==', 'O3T+3/Mnw3mw8vynbS5izRiKwgU6HoGg2ArDKaWojTs=', 0x62bb40eafe5724bb6e814c719b6c6d9c, 0xf49637dbf5db8133d38838c3c92dae03df58cbae6c546d69e56e0c3cd0a80672),
(12, 1, 'GF1f7jWXaLspeYr4NnQA4g==', '7XKwBqg4TV3jD6tpmPnyjQ==', 'BDm9pLEGNDc3RG/Y3SbylA==', 'uCSoxszHaSykAenQ0irCow==', 'Ju2xNIxPL9fTFtKzj9o1NQ==', '07lKpg+9DhZ8uxezKjfT9g==', '8sN8Oh6b0XZOwOcj3Io40LlzdC+Xj9PaFAzcb29I5rA=', 'NNFdQsojhUPB68476H5B+A==', 'whFHQ/6pTQcPEMYNVcaTR9jhDgouCxHXQ0rLCz87Ibs=', 0xf48dca6a84e0b8fd293400096d434aac, 0x13ad64aabe8861aafc1f4d9d8fca5ee148e21e7d8a4ae103308114d21ad03782),
(13, 1, 'KAHzf0EoMnLeTqIqMwJrYA==', 'Z1oSECo3kBOtO+LD24ddHg==', 'HQ9AZzHr7Lo6ikzUhTcDNw==', 'riWTUo1kCf0Orfi54TWqdw==', 'aTbBlOq6FJUnz97Z4g0WzQ==', 'GUrwBmKm/2OCak6hTK1k6A==', 'nqv7/r1voIjir/kOQPlAdbWXknFkE7j5MCO829PgT4k=', 'RhRB0JDc+gzsR+es2JR2Sw==', 'hoAF4KZVvb4hjxWtiR88BSIVlCELb6S1APCOqdgDWv8=', 0x170ddf2d47c5224832c50ec1cdd6ff77, 0x511a12f59b0812c20fda38947c55e9fa018faff3929f58ce437355784d561c),
(14, 2, 'uY6i0Kti/Rt+ybeVcDyalg==', 'uY6i0Kti/Rt+ybeVcDyalg==', 'uY6i0Kti/Rt+ybeVcDyalg==', 'uY6i0Kti/Rt+ybeVcDyalg==', 'uY6i0Kti/Rt+ybeVcDyalg==', 'uY6i0Kti/Rt+ybeVcDyalg==', 'lO4NbauFUquJ3Lga2ESyIjwm5QsfXQvIU1ZUotZB9Sc=', 'z2M6eAR9t0hLtXe1Wi/MDQ==', 'hhvvOn75NRynMYfoEjSZ59/eVYiPIJL4p+tt+ML0Ulo=', 0xdaed1cab8fc945728fbd90535f37a8da, 0xb5b8133d51819480ae8b1c1328e6a82b0b909433acafc425324f360098b85b94);

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
(5, 7, 13, 0x170ddf2d47c5224832c50ec1cdd6ff77, 0x511a12f59b0812c20fda38947c55e9fa018faff3929f58ce437355784d561c),
(6, 8, 13, 0x170ddf2d47c5224832c50ec1cdd6ff77, 0x511a12f59b0812c20fda38947c55e9fa018faff3929f58ce437355784d561c),
(11, 4, 14, 0xdaed1cab8fc945728fbd90535f37a8da, 0xb5b8133d51819480ae8b1c1328e6a82b0b909433acafc425324f360098b85b94);

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
(2, 1, 'AO+3NWMWanyE+UtYew==', 'Fe6oO2wRbX2Y/w==', 'KOW+M2MaamGX', 'KPi2PWA=', 'FO+7NA==', 'UbPobQ==', 'B+SuMyMVaW8=', 'BeSxKWAadyaO9ExP', 'F+K+OWJRdHjC', 0xb101e92c85b0afae, 0x74e18026d45974ae93c42f7bcb8fb38d2a6c4ecc321047dfbc76ca2b88e5b67e),
(3, 2, 'yw==', 'yQ==', '0g==', 'xw==', '0w==', '3w==', '14fRCedi7ys=', '1YfOE6Rt8WKiZAP6', 'x4HBA6Ym8jzu', 0xba4cc16e92bec001, 0x0eef6adf3adf63281772f0b3046f3e54dd4b5e25c89623fdf8a658843b02f7ae),
(4, 2, 'cg==', 'YA==', 'dw==', 'dQ==', 'dA==', 'ew==', 'ddWhKhuE8TE=', 'd9W+MFiL73jZYn9w', 'ZdOxIFrA7CaV', 0xa4f73162c76ac62f, 0x8f86ef36d8f811830c4f52733f83854a218e6fd0df03f4b4681ec8d0d6cad39b),
(5, 2, 'tPUt2yKa4A==', 'o/Upyg==', 'qf46wCWR9DSl', 'qeMyziY=', 'ovUy2iY=', '8KhvnHnHsw==', 'pv8qwGWe9zo=', 'pP812iaR6XO8ykAV', 'tvk6yiTa6i3w', 0xc15e323be7358c35, 0x4c71d78d03da59ec20f6d21e8c50da106189e0b5302ff8b459dfd5e82ca81433),
(6, 3, 'tA9EWw==', 'sAU=', 'rQA=', 'uwlIVyI=', 'uAtFVS4=', '6lYRAg==', 'vAFdVW1fPCg=', 'vgFCTy5QImGibnOA', 'rAdNXywbIT/u', 0x55156db55fa82ed4, 0x00491ea47243c915d244d5ea1e73219860af847e4d49269fe5eca017deda570d),
(7, 3, '3Q==', '2w==', 'yQ==', '3g==', '2A==', '1Q==', '5WM+nSkaRVrqt8fYoQ/m4ynJKlGM', '6E8NzjlvFQe5q4eE60U=', '+mc98CsYRlnstM/dqQ7j4yTQbkybnQ==', 0xd143885b2c42937c, 0x4cabed65767cf166718240414cab8acd3b59085fbc0885778bb9c2ac8a038698),
(8, 1, 'Pw==', 'Pg==', 'PQ==', 'Jg==', 'JQ==', 'JA==', 'Dm3PsgXAVA7dVRdEHkRGwNhoWb7M', 'A0H84RW1BFOOSVcYVA4=', 'EWnM3wfCVw3bVh9BFkVDwNVxHaPbMA==', 0xcc398357ef66994c, 0x8cefa106eb0ce99d3c468d28eb6a6eb47d78561caa7410d57d9394f82335b13c);

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
(4, 1, 1, 2),
(5, 2, 0, 3),
(6, 3, 0, 4),
(7, 4, 1, 1),
(8, 2, 1, 1);

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
(2, 1, '', '', '', '', '', '', '', '', '', '', 0x9914aace4d9a905ed22c01a53c4b7f3dc02d350fc6ba5778a13ab0a59a681bcc),
(3, 2, '', '', '', '', '', '', '', '', '', '', 0x1953d6852034ce567957dc8d962a579d06128e68329bc5370bf84e77dcad4e75),
(4, 1, '', '', '', '', '', '', '', '', '', '', 0x4d1af5073b7d479324c4144d39401803cd54b6cc68df019051983a7d36d2a75b),
(5, 2, '', '', '', '', '', '', '', '', '', '', 0x95878d047dbcc8b34676a1ca38116a7562f7ff72c7bde1fcf4c58adf541139f3),
(6, 2, '', '', '', '', '', '', '', '', '', '', 0xc37f16e0d8f41e1730abd0da7233bf7ebbe8352f6c4b26a228ca3f9a21d182),
(7, 2, '', '', '', '', '', '', '', '', '', '', 0xe94a218f618ce19047a263252f23da8a2ee8c9849d869d1dbda06e0ea7d7ed5f),
(8, 3, '', '', '', '', '', '', '', '', '', '', 0xd5b17b2bd87fa00a902a534eddd7961a1a3b7b2646aa1d2a0403d735cf92f915),
(9, 3, '', '', '', '', '', '', '', '', '', '', 0x98eb3e1aad8f2e23599145da0447ae6629c0f9c54cb7b4cb9b690d80d1846a4d),
(10, 1, '', '', '', '', '', '', '', '', '', '', 0x8fd0501857b90d3b51a13e1f81b0345fc5a5c24367f971daeabee2181d00ac23),
(11, 1, '', '', '', '', '', '', '', '', '', '', 0x8fd0501857b90d3b51a13e1f81b0345fc5a5c24367f971daeabee2181d00ac23),
(12, 1, '', '', '', '', '', '', '', '', '', '', 0x5e2cfa11e71a9ccce1a2e488d34652c358a0dab07fe409c0c1ca0e52f4d24292),
(13, 2, '', '', '', '', '', '', '', '', '', '', 0x850ddf3053ab6cf77cf961d1016cc6ffdffe9ef61ea3d29749313b248a23062a);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `ki_akses_data`
--
ALTER TABLE `ki_akses_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `ki_des`
--
ALTER TABLE `ki_des`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `ki_minta_akses`
--
ALTER TABLE `ki_minta_akses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `ki_pengguna`
--
ALTER TABLE `ki_pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ki_rc4`
--
ALTER TABLE `ki_rc4`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
