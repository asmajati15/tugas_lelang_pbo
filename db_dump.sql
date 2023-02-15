-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2023 at 05:29 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_dump`
--

-- --------------------------------------------------------

--
-- Table structure for table `history_lelang`
--

CREATE TABLE `history_lelang` (
  `id_history` int(11) NOT NULL,
  `id_lelang` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `penawaran_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `history_lelang`
--

INSERT INTO `history_lelang` (`id_history`, `id_lelang`, `id_user`, `penawaran_harga`) VALUES
(1, 2, NULL, 2000000),
(2, 3, NULL, 15000),
(3, 1, NULL, 15000),
(4, 7, NULL, 11000),
(5, 7, NULL, 12000);

--
-- Triggers `history_lelang`
--
DELIMITER $$
CREATE TRIGGER `INSERTTTTT` AFTER INSERT ON `history_lelang` FOR EACH ROW UPDATE tb_lelang SET harga_akhir = NEW.penawaran_harga WHERE id_lelang = NEW.id_lelang AND status = 1
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `VALIDATEEE` BEFORE INSERT ON `history_lelang` FOR EACH ROW IF NEW.penawaran_harga > (SELECT harga_akhir FROM tb_lelang WHERE id_lelang = NEW.id_lelang) THEN
    UPDATE tb_lelang SET tb_lelang.harga_akhir = new.penawaran_harga WHERE tb_lelang.id_lelang = NEW.id_lelang AND STATUS=1;
    ELSE
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Price must be greater than the previous record.';
  END IF
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_barang`
--

CREATE TABLE `tb_barang` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `tgl` date NOT NULL,
  `harga_awal` int(11) NOT NULL,
  `deskripsi_barang` text NOT NULL,
  `status_barang` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_barang`
--

INSERT INTO `tb_barang` (`id_barang`, `nama_barang`, `tgl`, `harga_awal`, `deskripsi_barang`, `status_barang`, `created_at`, `updated_at`) VALUES
(1, 'CANDI BOROBUDUR', '2023-02-16', 12000, 'apa weee', 1, NULL, NULL),
(2, 'CANDI KESEMEK', '2023-02-17', 1000000, 'APAAJAAA', 1, NULL, NULL),
(3, 'CANDI PRAMBANAN', '2023-02-18', 12000, 'SHFUHSU', 1, NULL, NULL),
(5, 'CANDI SUKUH', '2023-02-17', 1000, 'AHFAJ', 1, '2023-02-14 20:34:56', '2023-02-14 20:34:56'),
(6, 'CANDI CETHO', '2023-02-18', 15000, 'SHNFJA', 1, '2023-02-14 20:42:21', '2023-02-14 20:42:21'),
(7, 'aa', '2023-02-15', 10000, 'as', 0, '2023-02-14 21:16:26', '2023-02-14 21:18:29');

--
-- Triggers `tb_barang`
--
DELIMITER $$
CREATE TRIGGER `INSERTTT` AFTER INSERT ON `tb_barang` FOR EACH ROW INSERT INTO tb_lelang (id_barang,tgl_lelang,harga_akhir,id_user,id_petugas,status) VALUES(NEW.id_barang,NULL,NEW.harga_awal,0,NULL,1)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update` AFTER UPDATE ON `tb_barang` FOR EACH ROW UPDATE tb_lelang
SET tb_lelang.status = NEW.status_barang
WHERE tb_lelang.id_barang = NEW.id_barang
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_lelang`
--

CREATE TABLE `tb_lelang` (
  `id_lelang` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `tgl_lelang` date DEFAULT NULL,
  `harga_akhir` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_petugas` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_lelang`
--

INSERT INTO `tb_lelang` (`id_lelang`, `id_barang`, `tgl_lelang`, `harga_akhir`, `id_user`, `id_petugas`, `status`) VALUES
(1, 1, NULL, 15000, 1, NULL, 1),
(2, 2, NULL, 2000000, 1, NULL, 1),
(3, 3, NULL, 15000, 1, NULL, 1),
(5, 5, NULL, 1000, 0, NULL, 1),
(6, 6, NULL, 15000, 0, NULL, 1),
(7, 7, NULL, 11000, 0, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_masyarakat`
--

CREATE TABLE `tb_masyarakat` (
  `id_user` int(11) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `telp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_masyarakat`
--

INSERT INTO `tb_masyarakat` (`id_user`, `nama_lengkap`, `username`, `password`, `telp`) VALUES
(1, 'Panjul', 'panjul', '$2a$12$RIG2azwhpfmwFFVlA7rvouZGYv6a38jIKrw1vasrRXR2fNHTkYpaK', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `history_lelang`
--
ALTER TABLE `history_lelang`
  ADD PRIMARY KEY (`id_history`),
  ADD KEY `id_lelang` (`id_lelang`,`id_user`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `tb_lelang`
--
ALTER TABLE `tb_lelang`
  ADD PRIMARY KEY (`id_lelang`),
  ADD KEY `id_barang` (`id_barang`,`id_user`,`id_petugas`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tb_masyarakat`
--
ALTER TABLE `tb_masyarakat`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `history_lelang`
--
ALTER TABLE `history_lelang`
  MODIFY `id_history` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_barang`
--
ALTER TABLE `tb_barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_lelang`
--
ALTER TABLE `tb_lelang`
  MODIFY `id_lelang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_masyarakat`
--
ALTER TABLE `tb_masyarakat`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
