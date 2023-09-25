-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 13, 2023 at 10:24 AM
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
-- Database: `db_simasjid`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_agenda`
--

CREATE TABLE `tb_agenda` (
  `id_kegiatan` int(11) NOT NULL,
  `nama_kegiatan` varchar(50) NOT NULL,
  `plk_kegiatan` varchar(30) NOT NULL,
  `tmp_kegiatan` varchar(30) NOT NULL,
  `tgl_kegiatan` date NOT NULL,
  `wkt_kegiatan` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_agenda`
--

INSERT INTO `tb_agenda` (`id_kegiatan`, `nama_kegiatan`, `plk_kegiatan`, `tmp_kegiatan`, `tgl_kegiatan`, `wkt_kegiatan`) VALUES
(5, 'kajian abu syukri daud', 'remaja masjid', 'halaman masjid', '2023-05-31', '06:00:00'),
(32, 'Kajian Abu Laot', 'Remaja Masjid', 'Masjid Pango', '2023-11-02', '04:00:00'),
(37, 'Rateb Seribe', 'MPTTI', 'Halaman Mesjid', '2023-07-28', '20:00:00'),
(38, 'tess kegiatan', 'tes', 'tes', '2023-07-25', '08:44:00'),
(42, 'Makan Makan', 'Panita', 'MAsjid', '2023-08-23', '14:09:00'),
(43, 'Rateb', 'Petugas ', 'Halaman Masjid', '2023-08-10', '20:00:00'),
(44, 'dscsds', 'cscsdc', 'sdcds', '2023-08-23', '06:43:00'),
(45, 'csdsd', 'cdscsdc', 'sdcsdcs', '2023-08-23', '02:43:00'),
(48, 'dssddsadadas', 'ff', 'dfff', '2023-09-07', '12:32:00'),
(49, 'dscscs', 'cdsscscdds', 'cssd', '2023-09-17', '13:32:00'),
(50, 'sadsa', 'dadasdd', 'asds', '2023-12-09', '20:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_comment`
--

CREATE TABLE `tb_comment` (
  `id_comment` int(12) NOT NULL,
  `content` varchar(255) NOT NULL,
  `content_admin` varchar(255) NOT NULL,
  `email` varchar(30) NOT NULL,
  `created_by` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at_admin` datetime NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_comment`
--

INSERT INTO `tb_comment` (`id_comment`, `content`, `content_admin`, `email`, `created_by`, `created_at`, `created_at_admin`, `status`) VALUES
(66, 'Kapan acara maulid? ', 'minggu depan', 'rizkiauliacut37@gmail.com', 'Rizki Aulia', '2023-08-28 17:06:16', '2023-08-29 00:06:59', 'dibalas'),
(67, 'dimana acara nya', '', 'rizkiauliacut37@gmail.com', 'Rizki Aulia', '2023-08-28 17:06:31', '0000-00-00 00:00:00', 'belum'),
(68, 'tes', '', 'rizkiauliacut37@gmail.com', 'Rizki Aulia', '2023-08-29 02:24:10', '0000-00-00 00:00:00', 'belum'),
(69, 'saxaxa', 'sdcdsdcsccasasasca', 'rizkiaulia2002@gmail.com', 'rizki', '2023-09-01 16:23:06', '2023-09-03 15:07:14', 'dibalas');

-- --------------------------------------------------------

--
-- Table structure for table `tb_donasi`
--

CREATE TABLE `tb_donasi` (
  `id_donasi` int(11) NOT NULL,
  `nama_bank` varchar(30) NOT NULL,
  `no_rek` varchar(50) DEFAULT NULL,
  `atas_nama` varchar(50) DEFAULT NULL,
  `jml` int(10) DEFAULT NULL,
  `bukti` varchar(150) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_kas`
--

CREATE TABLE `tb_kas` (
  `id_kas` int(12) NOT NULL,
  `tanggal` date NOT NULL,
  `ket` varchar(255) NOT NULL,
  `kas_masuk` int(11) NOT NULL,
  `kas_keluar` int(11) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_kas`
--

INSERT INTO `tb_kas` (`id_kas`, `tanggal`, `ket`, `kas_masuk`, `kas_keluar`, `status`) VALUES
(1, '2023-06-30', 'Saldo Awal', 1500000, 0, 'Masuk'),
(2, '2023-06-29', 'Pembayar listrik Masjid', 0, 2000000, 'Keluar'),
(3, '2023-06-30', 'Pembelian Mic', 0, 4000000, 'Keluar'),
(4, '2023-06-30', 'Beli Aqua', 4500000, 0, 'Masuk'),
(6, '2023-07-01', 'Biaya Perawatan AC', 0, 950000, 'Keluar'),
(8, '2023-07-01', 'Uang Bantuan Dari Ketua Dprk', 10000000, 0, 'Masuk'),
(10, '2023-07-18', 'Cair Proposal', 3000000, 0, 'Masuk'),
(11, '2023-08-05', 'Infak MAsjid', 9000000, 0, 'Masuk'),
(12, '2023-08-17', 'Biaya Perawatan AC', 0, 5000000, 'Keluar');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kelompok_qurban`
--

CREATE TABLE `tb_kelompok_qurban` (
  `id_kelompok` int(11) NOT NULL,
  `id_tahun` int(11) NOT NULL,
  `nama_kelompok` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_kelompok_qurban`
--

INSERT INTO `tb_kelompok_qurban` (`id_kelompok`, `id_tahun`, `nama_kelompok`) VALUES
(17, 9, 'Kelompok 1'),
(31, 9, 'Kelompok 2');

-- --------------------------------------------------------

--
-- Table structure for table `tb_nikah`
--

CREATE TABLE `tb_nikah` (
  `id_nikah` int(11) NOT NULL,
  `nama_pengantin_p` varchar(30) NOT NULL,
  `nama_pengantin_w` varchar(30) NOT NULL,
  `nama_penghulu` varchar(30) NOT NULL,
  `nama_wali` varchar(30) NOT NULL,
  `nama_qori` varchar(50) NOT NULL,
  `tgl_nikah` date NOT NULL,
  `jam_nikah` time NOT NULL,
  `bukti_dp` varchar(100) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `status` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `created_by` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_nikah`
--

INSERT INTO `tb_nikah` (`id_nikah`, `nama_pengantin_p`, `nama_pengantin_w`, `nama_penghulu`, `nama_wali`, `nama_qori`, `tgl_nikah`, `jam_nikah`, `bukti_dp`, `no_hp`, `status`, `email`, `created_by`, `created_at`) VALUES
(2, 'Khatamin', 'Husna', 'Linggard', 'rizkan', 'rozi', '2023-08-09', '20:00:00', '', '', 'aktif', '', '', '0000-00-00 00:00:00'),
(4, 'Reza', 'Miftahul Jannah', 'Dolah', 'Hasbi', 'Ridha', '2023-08-17', '10:00:00', '', '', 'aktif', '', '', '0000-00-00 00:00:00'),
(15, 'Rizki Aulia', 'Ampon', 'Linggard', 'Bagok', 'asd', '2023-07-21', '17:46:00', '', '', 'aktif', '', '', '0000-00-00 00:00:00'),
(167, 'Mursin', 'Putri', '-', 'Fauzi', '-', '2023-08-31', '08:00:00', '1693242249_f24e5841d841afd70d3d.jpg', '086521618276', 'aktif', 'rizkiauliacut37@gmail.com', 'Rizki Aulia', '2023-08-28 17:03:49'),
(172, 'Rizki', 'Wilda', 'Abdul Rahman', 'Fauzi', 'Fauzannur', '2023-08-31', '10:00:00', '1693242253_de2e4f075753645d0de8.jpg', '086521618276', 'aktif', 'rizkiauliacut37@gmail.com', 'Rizki Aulia', '2023-08-28 17:03:55'),
(202, 'bb', 'bb', '-', 'bb', '-', '2023-09-13', '15:12:00', '1693556021_34dc8e10b797802b9d71.jpg', 'bb', 'aktif', 'rizkiauliacut37@gmail.com', 'Rizki Aulia', '2023-09-01 08:13:11'),
(203, 'reza', 'helem kuneng', '-', 'jannah', '-', '2023-09-15', '21:26:00', '1693578501_99caccce211ed3c766f4.jpg', '08362612672', 'aktif', 'auliareza2029@gmail.com', 'Reza Aulia', '2023-09-01 14:28:18'),
(210, 'sadsadadasdasda', 'dassa', '-', 'adadssa', '-', '2023-09-08', '23:12:00', '1693584769_1be776b8c7c702029a35.jpg', 'sada', 'aktif', 'rizkiaulia2002@gmail.com', 'rizki', '2023-09-01 16:12:49'),
(211, 'cssacas', 'saasa', '-', 'csac', '-', '2023-09-02', '23:14:00', '1693585001_3d34614a037a1603d1d8.jpg', 'casasc', 'aktif', 'rizkiaulia2002@gmail.com', 'rizki', '2023-09-01 16:16:41'),
(212, 'sadwdqw', 'qwqdwdqwq', '-', 'wdqwdwqdq', '-', '2023-09-04', '09:49:00', '1693795812_bce3f5d4352c19dec811.jpg', 'dqdqwwqqw', 'pending', 'rizkiauliacut37@gmail.com', 'Rizki Aulia', '2023-09-04 02:50:11');

-- --------------------------------------------------------

--
-- Table structure for table `tb_peserta_kelompok`
--

CREATE TABLE `tb_peserta_kelompok` (
  `id_peserta` int(11) NOT NULL,
  `id_kelompok` int(11) NOT NULL,
  `nama_peserta` varchar(100) DEFAULT NULL,
  `biaya` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_peserta_kelompok`
--

INSERT INTO `tb_peserta_kelompok` (`id_peserta`, `id_kelompok`, `nama_peserta`, `biaya`) VALUES
(55, 17, 'Rivaldi ', 3000000),
(56, 17, 'Ikram', 3000000),
(57, 31, 'Rozi', 90000000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_peserta_pribadi`
--

CREATE TABLE `tb_peserta_pribadi` (
  `id_peserta_p` int(11) NOT NULL,
  `id_tahun` int(11) NOT NULL,
  `nama_peserta` varchar(30) NOT NULL,
  `biaya` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_peserta_pribadi`
--

INSERT INTO `tb_peserta_pribadi` (`id_peserta_p`, `id_tahun`, `nama_peserta`, `biaya`) VALUES
(11, 9, 'Rozi', 3000000),
(12, 13, 'Atun', 3000000),
(13, 13, 'Jokrori', 4000000),
(16, 9, 'Ikram', 9000000),
(17, 9, 'Rivaldi ', 8000000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_setting`
--

CREATE TABLE `tb_setting` (
  `id` int(1) NOT NULL,
  `nama_masjid` varchar(100) NOT NULL,
  `id_kota` varchar(5) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `rek` varchar(30) NOT NULL,
  `logo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_setting`
--

INSERT INTO `tb_setting` (`id`, `nama_masjid`, `id_kota`, `alamat`, `rek`, `logo`) VALUES
(1, 'Masjid Al Ikhlas', '0119', 'Jl. Mesjid,  Desa Pango Raya, Kec. Ulee Kareng', 'BSI (1120194773) A.N Pengurus ', '1691303130_fad0c7fcfa8587eb1e24.png');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tahun`
--

CREATE TABLE `tb_tahun` (
  `id_tahun` int(11) NOT NULL,
  `tahun_h` varchar(4) DEFAULT NULL,
  `tahun_m` year(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_tahun`
--

INSERT INTO `tb_tahun` (`id_tahun`, `tahun_h`, `tahun_m`) VALUES
(9, '1444', 2023),
(13, '1445', 2024);

-- --------------------------------------------------------

--
-- Table structure for table `tb_users`
--

CREATE TABLE `tb_users` (
  `id_users` int(12) NOT NULL,
  `nama_users` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_users`
--

INSERT INTO `tb_users` (`id_users`, `nama_users`, `email`, `password`, `level`) VALUES
(13, 'Admin', 'admin@gmail.com', '$2y$10$A5yU1OUEnpypC.zQQ23orOj2fqj0cCitgKW2dPmHYTmws1ePBmCEW', 1),
(15, 'Admin 1', 'admin1@gmail.com', '$2y$10$uPWEHOSvzT49zzg9sqiU5OwCCG9uARufAIbProw9Vou07alRwc.xS', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_users_android`
--

CREATE TABLE `tb_users_android` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_users_android`
--

INSERT INTO `tb_users_android` (`id_user`, `nama`, `email`, `created_at`) VALUES
(7, 'rizki', 'rizkiaulia2002@gmail.com', '2023-08-25 16:13:38'),
(8, 'Ayu', 'nurulrahayunasir@gmail.com', '2023-08-25 17:46:31'),
(9, 'rozi', 'simasjid.id@gmail.com', '2023-08-26 16:14:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_agenda`
--
ALTER TABLE `tb_agenda`
  ADD PRIMARY KEY (`id_kegiatan`);

--
-- Indexes for table `tb_comment`
--
ALTER TABLE `tb_comment`
  ADD PRIMARY KEY (`id_comment`);

--
-- Indexes for table `tb_donasi`
--
ALTER TABLE `tb_donasi`
  ADD PRIMARY KEY (`id_donasi`);

--
-- Indexes for table `tb_kas`
--
ALTER TABLE `tb_kas`
  ADD PRIMARY KEY (`id_kas`);

--
-- Indexes for table `tb_kelompok_qurban`
--
ALTER TABLE `tb_kelompok_qurban`
  ADD PRIMARY KEY (`id_kelompok`),
  ADD KEY `id_tahun` (`id_tahun`);

--
-- Indexes for table `tb_nikah`
--
ALTER TABLE `tb_nikah`
  ADD PRIMARY KEY (`id_nikah`);

--
-- Indexes for table `tb_peserta_kelompok`
--
ALTER TABLE `tb_peserta_kelompok`
  ADD PRIMARY KEY (`id_peserta`),
  ADD KEY `id_kelompok` (`id_kelompok`);

--
-- Indexes for table `tb_peserta_pribadi`
--
ALTER TABLE `tb_peserta_pribadi`
  ADD PRIMARY KEY (`id_peserta_p`),
  ADD KEY `id_tahun` (`id_tahun`);

--
-- Indexes for table `tb_setting`
--
ALTER TABLE `tb_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_tahun`
--
ALTER TABLE `tb_tahun`
  ADD PRIMARY KEY (`id_tahun`);

--
-- Indexes for table `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`id_users`);

--
-- Indexes for table `tb_users_android`
--
ALTER TABLE `tb_users_android`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_agenda`
--
ALTER TABLE `tb_agenda`
  MODIFY `id_kegiatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `tb_comment`
--
ALTER TABLE `tb_comment`
  MODIFY `id_comment` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `tb_donasi`
--
ALTER TABLE `tb_donasi`
  MODIFY `id_donasi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_kas`
--
ALTER TABLE `tb_kas`
  MODIFY `id_kas` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tb_kelompok_qurban`
--
ALTER TABLE `tb_kelompok_qurban`
  MODIFY `id_kelompok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tb_nikah`
--
ALTER TABLE `tb_nikah`
  MODIFY `id_nikah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=218;

--
-- AUTO_INCREMENT for table `tb_peserta_kelompok`
--
ALTER TABLE `tb_peserta_kelompok`
  MODIFY `id_peserta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `tb_peserta_pribadi`
--
ALTER TABLE `tb_peserta_pribadi`
  MODIFY `id_peserta_p` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tb_setting`
--
ALTER TABLE `tb_setting`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_tahun`
--
ALTER TABLE `tb_tahun`
  MODIFY `id_tahun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `id_users` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tb_users_android`
--
ALTER TABLE `tb_users_android`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_kelompok_qurban`
--
ALTER TABLE `tb_kelompok_qurban`
  ADD CONSTRAINT `tb_kelompok_qurban_ibfk_1` FOREIGN KEY (`id_tahun`) REFERENCES `tb_tahun` (`id_tahun`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_peserta_kelompok`
--
ALTER TABLE `tb_peserta_kelompok`
  ADD CONSTRAINT `tb_peserta_kelompok_ibfk_1` FOREIGN KEY (`id_kelompok`) REFERENCES `tb_kelompok_qurban` (`id_kelompok`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_peserta_pribadi`
--
ALTER TABLE `tb_peserta_pribadi`
  ADD CONSTRAINT `tb_peserta_pribadi_ibfk_1` FOREIGN KEY (`id_tahun`) REFERENCES `tb_tahun` (`id_tahun`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
