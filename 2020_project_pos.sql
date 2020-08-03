-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2020 at 09:56 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `2020_project_pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_barang`
--

CREATE TABLE `tbl_barang` (
  `barang_id` varchar(15) NOT NULL,
  `barang_gambar` varchar(128) NOT NULL,
  `barang_nama` varchar(150) DEFAULT NULL,
  `barang_harpok` double DEFAULT NULL,
  `barang_harjul` double DEFAULT NULL,
  `barang_harjul_grosir` double DEFAULT NULL,
  `barang_stok` int(11) DEFAULT 0,
  `barang_tgl_input` timestamp NULL DEFAULT current_timestamp(),
  `barang_tgl_last_update` datetime DEFAULT NULL,
  `barang_kategori_id` int(11) DEFAULT NULL,
  `barang_satuan_id` int(11) NOT NULL,
  `barang_user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_barang`
--

INSERT INTO `tbl_barang` (`barang_id`, `barang_gambar`, `barang_nama`, `barang_harpok`, `barang_harjul`, `barang_harjul_grosir`, `barang_stok`, `barang_tgl_input`, `barang_tgl_last_update`, `barang_kategori_id`, `barang_satuan_id`, `barang_user_id`) VALUES
('BR000001', 'BR000001.png', 'Sayur bayam', 15000, 20000, 17000, 2, '2016-11-22 23:30:50', '2020-07-29 20:13:56', 11, 3, 1),
('BR000002', 'default.png', 'Sayur enak', 16000, 20000, 18000, 2, '2016-11-22 23:32:02', '2020-07-29 20:14:12', 11, 1, 1),
('BR000003', 'default.png', 'Klem Kabel IKK No 9', 16000, 22000, 18500, 2, '2016-11-22 23:33:08', NULL, 11, 1, 1),
('BR000004', 'BR000004.png', 'Sayur', 10000, 50000, 222, 2, '2020-07-29 05:36:35', '2020-07-29 20:09:45', 37, 2, 1),
('BR000005', 'default.png', ' asd', 22222, 2222, 2222, 2, '2020-07-30 12:37:06', NULL, 38, 4, 1),
('BR000006', 'default.png', ' asd', 33, 2, 2, 2, '2020-08-01 07:25:56', NULL, 37, 5, 1),
('BR000007', 'default.png', ' asdadasds', 2, 20000, 17000, 22, '2020-08-01 07:26:07', NULL, 37, 1, 1),
('BR000008', 'default.png', ' hjkhjk', 2, 3333, 33333, 222, '2020-08-01 07:26:19', NULL, 37, 4, 1),
('BR000009', 'default.png', ' asdzxc', 33, 3333, 17000, 3, '2020-08-01 07:26:29', NULL, 37, 5, 1),
('BR000010', 'default.png', ' asdasd', 222, 22, 2, 1, '2020-08-01 07:26:42', NULL, 35, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_beli`
--

CREATE TABLE `tbl_beli` (
  `beli_nofak` varchar(15) DEFAULT NULL,
  `beli_tanggal` date DEFAULT NULL,
  `beli_suplier_id` int(11) DEFAULT NULL,
  `beli_user_id` int(11) DEFAULT NULL,
  `beli_kode` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_detail_beli`
--

CREATE TABLE `tbl_detail_beli` (
  `d_beli_id` int(11) NOT NULL,
  `d_beli_nofak` varchar(15) DEFAULT NULL,
  `d_beli_barang_id` varchar(15) DEFAULT NULL,
  `d_beli_harga` double DEFAULT NULL,
  `d_beli_jumlah` int(11) DEFAULT NULL,
  `d_beli_total` double DEFAULT NULL,
  `d_beli_kode` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_detail_jual`
--

CREATE TABLE `tbl_detail_jual` (
  `d_jual_id` int(11) NOT NULL,
  `d_jual_nofak` varchar(15) DEFAULT NULL,
  `d_jual_barang_id` varchar(15) DEFAULT NULL,
  `d_jual_barang_nama` varchar(150) DEFAULT NULL,
  `d_jual_barang_satuan` varchar(30) DEFAULT NULL,
  `d_jual_barang_harpok` double DEFAULT NULL,
  `d_jual_barang_harjul` double DEFAULT NULL,
  `d_jual_qty` int(11) DEFAULT NULL,
  `d_jual_diskon` double DEFAULT NULL,
  `d_jual_total` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_detail_jual`
--

INSERT INTO `tbl_detail_jual` (`d_jual_id`, `d_jual_nofak`, `d_jual_barang_id`, `d_jual_barang_nama`, `d_jual_barang_satuan`, `d_jual_barang_harpok`, `d_jual_barang_harjul`, `d_jual_qty`, `d_jual_diskon`, `d_jual_total`) VALUES
(1, '241116000001', 'BR000001', 'Klem Kabel IKK No 7', 'Bks', 15000, 20000, 1, 0, 20000),
(2, '241116000002', 'BR000002', 'Klem Kabel IKK No 8', 'Bks', 16000, 20000, 1, 0, 20000),
(3, '241116000003', 'BR000003', 'Klem Kabel IKK No 9', 'Bks', 16000, 22000, 1, 0, 22000),
(4, '241116000004', 'BR000045', 'Stok Kontak Omi KK', 'PCS', 5700, 10000, 1, 0, 10000),
(5, '241116000005', 'BR000005', 'Klem kabel dms No 6', 'Bks', 3000, 5000, 1, 0, 5000),
(6, '241116000006', 'BR000006', 'Klem kabel dms No 7', 'Bks', 3500, 6000, 1, 0, 6000),
(7, '241116000007', 'BR000008', 'Klem kabel dms No 9', 'Bks', 4500, 8000, 1, 0, 8000),
(8, '241116000008', 'BR000010', 'Klem kabel Steel No 6', 'Bks', 3100, 6000, 1, 0, 6000),
(9, '241116000008', 'BR000011', 'Klem kabel Steel No 7', 'Bks', 3400, 7000, 1, 0, 7000),
(10, '241116000009', 'BR000013', 'Klem kabel Steel No 9', 'Bks', 5000, 6000, 1, 0, 6000),
(11, '251116000001', 'BR000043', 'Saklar Engkel Omi KK', 'PCS', 4500, 10000, 1, 0, 10000),
(12, '251116000001', 'BR000038', 'Saklar Arde Visalux 2L', 'PCS', 8200, 9000, 1, 0, 9000),
(13, '291116000001', 'BR000043', 'Saklar Engkel Omi KK', 'PCS', 4500, 10000, 1, 0, 10000),
(14, '291116000001', 'BR000056', 'Antena Digital HD 12', 'PCS', 66000, 95000, 1, 0, 95000),
(15, '291116000002', 'BR000030', 'MCB Sheineder 20A SNI', 'PCS', 47500, 70000, 1, 2000, 68000),
(16, '291116000003', 'BR000012', 'Klem kabel Steel No 8', 'Bks', 4200, 8000, 1, 0, 8000),
(17, '291116000004', 'BR000032', 'Saklar Engkel Visalux B', 'PCS', 7250, 10000, 1, 0, 10000),
(18, '291116000005', 'BR000045', 'Stok Kontak Omi KK', 'PCS', 5700, 10000, 1, 0, 10000),
(19, '291116000006', 'BR000024', 'Stop Kontak Sheineder B', 'PCS', 16000, 20000, 1, 0, 20000),
(20, '291116000006', 'BR000038', 'Saklar Arde Visalux 2L', 'PCS', 8200, 9000, 1, 0, 9000),
(22, '240117000001', 'BR000043', 'Saklar Engkel Omi KK', 'PCS', 4500, 10000, 1, 0, 10000),
(23, '240117000002', 'BR000043', 'Saklar Engkel Omi KK', 'PCS', 4500, 10000, 1, 0, 10000),
(24, '290317000001', 'BR000034', 'Stop Kontak Visalux B', 'PCS', 10250, 12000, 1, 0, 12000),
(25, '290317000001', 'BR000043', 'Saklar Engkel Omi KK', 'PCS', 4500, 10000, 1, 0, 10000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_diskon`
--

CREATE TABLE `tbl_diskon` (
  `diskon_id` int(11) NOT NULL,
  `diskon_harga` int(11) NOT NULL,
  `diskon_persen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_diskon`
--

INSERT INTO `tbl_diskon` (`diskon_id`, `diskon_harga`, `diskon_persen`) VALUES
(2, 100000, 20),
(6, 50000, 10);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jual`
--

CREATE TABLE `tbl_jual` (
  `jual_nofak` varchar(15) NOT NULL,
  `jual_tanggal` timestamp NULL DEFAULT current_timestamp(),
  `jual_total` double DEFAULT NULL,
  `jual_jml_uang` double DEFAULT NULL,
  `jual_kembalian` double DEFAULT NULL,
  `jual_user_id` int(11) DEFAULT NULL,
  `jual_keterangan` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_jual`
--

INSERT INTO `tbl_jual` (`jual_nofak`, `jual_tanggal`, `jual_total`, `jual_jml_uang`, `jual_kembalian`, `jual_user_id`, `jual_keterangan`) VALUES
('240117000001', '2017-01-24 15:07:07', 10000, 20000, 10000, 1, 'eceran'),
('240117000002', '2017-01-24 15:07:26', 10000, 20000, 10000, 1, 'eceran'),
('241116000001', '2016-11-24 17:42:06', 20000, 20000, 0, 1, 'eceran'),
('241116000002', '2016-11-24 17:49:58', 20000, 20000, 0, 1, 'eceran'),
('241116000003', '2016-11-24 17:55:48', 22000, 22000, 0, 1, 'eceran'),
('241116000004', '2016-11-24 17:59:38', 10000, 10000, 0, 1, 'eceran'),
('241116000005', '2016-11-24 18:21:24', 5000, 20000, 15000, 1, 'eceran'),
('241116000006', '2016-11-24 18:27:01', 6000, 7000, 1000, 1, 'eceran'),
('241116000007', '2016-11-24 18:29:43', 8000, 10000, 2000, 1, 'eceran'),
('241116000008', '2016-11-24 18:32:01', 13000, 15000, 2000, 1, 'eceran'),
('241116000009', '2016-11-24 19:47:50', 6000, 7000, 1000, 1, 'grosir'),
('251116000001', '2016-11-25 22:07:15', 19000, 60000, 41000, 1, 'eceran'),
('290317000001', '2017-03-29 13:35:49', 22000, 56000, 34000, 1, 'eceran'),
('291116000001', '2016-11-29 19:11:48', 105000, 120000, 15000, 1, 'eceran'),
('291116000002', '2016-11-29 19:49:20', 68000, 70000, 2000, 1, 'eceran'),
('291116000003', '2016-11-29 19:57:17', 8000, 10000, 2000, 1, 'eceran'),
('291116000004', '2016-11-29 19:58:35', 10000, 12000, 2000, 1, 'eceran'),
('291116000005', '2016-11-29 22:10:10', 10000, 10000, 0, 1, 'eceran'),
('291116000006', '2016-11-29 22:23:40', 29000, 30000, 1000, 1, 'eceran');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kategori`
--

CREATE TABLE `tbl_kategori` (
  `kategori_id` int(11) NOT NULL,
  `kategori_nama` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_kategori`
--

INSERT INTO `tbl_kategori` (`kategori_id`, `kategori_nama`) VALUES
(5, 'Omi'),
(7, 'Sheineder'),
(8, 'Fonic'),
(9, 'Steel'),
(10, 'DMS'),
(11, 'IKK'),
(12, 'Voxel'),
(13, 'Antena'),
(14, 'Kabel Antena'),
(15, 'Power Supply'),
(16, 'RCA'),
(17, 'AC Cord'),
(18, 'Jack Antena '),
(19, 'Esenze'),
(20, 'Augen'),
(21, 'Itami'),
(22, 'Steker'),
(23, 'Pallas'),
(24, 'Stanco'),
(25, 'Flapon'),
(26, 'T Dos dan Rolen'),
(27, 'Tekong'),
(28, 'Maspion'),
(29, 'Kompos Gas'),
(30, 'Miyako'),
(31, 'Uticon'),
(32, 'Sekai'),
(33, 'Regancy'),
(34, 'Amasco'),
(35, 'Enter'),
(36, 'Licons'),
(37, 'Philips'),
(38, 'Nissan'),
(39, 'AMC');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ongkir`
--

CREATE TABLE `tbl_ongkir` (
  `ongkir_id` int(11) NOT NULL,
  `ongkir_lokasi` text NOT NULL,
  `ongkir_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_ongkir`
--

INSERT INTO `tbl_ongkir` (`ongkir_id`, `ongkir_lokasi`, `ongkir_harga`) VALUES
(4, 'Serang', 10000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_role`
--

CREATE TABLE `tbl_role` (
  `role_id` int(11) NOT NULL,
  `role_nama` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_role`
--

INSERT INTO `tbl_role` (`role_id`, `role_nama`) VALUES
(1, 'Superadmin'),
(2, 'Admin'),
(3, 'Kasir'),
(4, 'Customer');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_satuan`
--

CREATE TABLE `tbl_satuan` (
  `satuan_id` int(11) NOT NULL,
  `satuan_nama` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_satuan`
--

INSERT INTO `tbl_satuan` (`satuan_id`, `satuan_nama`) VALUES
(1, 'Bks'),
(2, 'Dus'),
(3, 'Pcs'),
(4, 'Kg'),
(5, 'aa');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_suplier`
--

CREATE TABLE `tbl_suplier` (
  `suplier_id` int(11) NOT NULL,
  `suplier_nama` varchar(35) DEFAULT NULL,
  `suplier_alamat` varchar(60) DEFAULT NULL,
  `suplier_notelp` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_suplier`
--

INSERT INTO `tbl_suplier` (`suplier_id`, `suplier_nama`, `suplier_alamat`, `suplier_notelp`) VALUES
(1, 'Handenbosd', 'Depak', '123123'),
(3, 'asd', 'asd', '098');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `user_nama` varchar(35) DEFAULT NULL,
  `user_alamat` text NOT NULL,
  `user_username` varchar(30) DEFAULT NULL,
  `user_password` varchar(128) DEFAULT NULL,
  `user_role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_nama`, `user_alamat`, `user_username`, `user_password`, `user_role_id`) VALUES
(1, 'Mochamad Natsir', 'Jl. Raya Cilegon No.Km. 5, Taman, Drangong, Kec. Taktakan, Kota Serang, Banten 42162', 'superadmin', '$2y$10$afqzZuBiOvmCHJDjCE8Tc.oH2d7vZz9G1pHHcUdUuNRAjA/uyEYp6', 1),
(3, 'Handoko Adji Pangestu', 'Jl. Raya Jakarta No.Km. 5, Taman, Drangong, Kec. Cipocok Jaya, Kota Serang, Banten 42122', 'admin', '$2y$10$PssETE4hc5Njym9wudpTMu1F9kBe.kdkKXxLqKsTRLvdTmxITlXSi', 2),
(11, 'zxc', 'zxc', 'zxc', '9bb319215b59ada160c2d56d14ddd677', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD PRIMARY KEY (`barang_id`),
  ADD KEY `barang_user_id` (`barang_user_id`),
  ADD KEY `barang_kategori_id` (`barang_kategori_id`),
  ADD KEY `tbl_barang_ibfk_3` (`barang_satuan_id`);

--
-- Indexes for table `tbl_beli`
--
ALTER TABLE `tbl_beli`
  ADD PRIMARY KEY (`beli_kode`),
  ADD KEY `beli_user_id` (`beli_user_id`),
  ADD KEY `beli_suplier_id` (`beli_suplier_id`),
  ADD KEY `beli_id` (`beli_kode`);

--
-- Indexes for table `tbl_detail_beli`
--
ALTER TABLE `tbl_detail_beli`
  ADD PRIMARY KEY (`d_beli_id`),
  ADD KEY `d_beli_barang_id` (`d_beli_barang_id`),
  ADD KEY `d_beli_nofak` (`d_beli_nofak`),
  ADD KEY `d_beli_kode` (`d_beli_kode`);

--
-- Indexes for table `tbl_detail_jual`
--
ALTER TABLE `tbl_detail_jual`
  ADD PRIMARY KEY (`d_jual_id`),
  ADD KEY `d_jual_barang_id` (`d_jual_barang_id`),
  ADD KEY `d_jual_nofak` (`d_jual_nofak`);

--
-- Indexes for table `tbl_diskon`
--
ALTER TABLE `tbl_diskon`
  ADD PRIMARY KEY (`diskon_id`);

--
-- Indexes for table `tbl_jual`
--
ALTER TABLE `tbl_jual`
  ADD PRIMARY KEY (`jual_nofak`),
  ADD KEY `jual_user_id` (`jual_user_id`);

--
-- Indexes for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indexes for table `tbl_ongkir`
--
ALTER TABLE `tbl_ongkir`
  ADD PRIMARY KEY (`ongkir_id`);

--
-- Indexes for table `tbl_role`
--
ALTER TABLE `tbl_role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `tbl_satuan`
--
ALTER TABLE `tbl_satuan`
  ADD PRIMARY KEY (`satuan_id`);

--
-- Indexes for table `tbl_suplier`
--
ALTER TABLE `tbl_suplier`
  ADD PRIMARY KEY (`suplier_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_detail_beli`
--
ALTER TABLE `tbl_detail_beli`
  MODIFY `d_beli_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_detail_jual`
--
ALTER TABLE `tbl_detail_jual`
  MODIFY `d_jual_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tbl_diskon`
--
ALTER TABLE `tbl_diskon`
  MODIFY `diskon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  MODIFY `kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `tbl_ongkir`
--
ALTER TABLE `tbl_ongkir`
  MODIFY `ongkir_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_role`
--
ALTER TABLE `tbl_role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_satuan`
--
ALTER TABLE `tbl_satuan`
  MODIFY `satuan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_suplier`
--
ALTER TABLE `tbl_suplier`
  MODIFY `suplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD CONSTRAINT `tbl_barang_ibfk_2` FOREIGN KEY (`barang_kategori_id`) REFERENCES `tbl_kategori` (`kategori_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_barang_ibfk_3` FOREIGN KEY (`barang_satuan_id`) REFERENCES `tbl_satuan` (`satuan_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_beli`
--
ALTER TABLE `tbl_beli`
  ADD CONSTRAINT `tbl_beli_ibfk_1` FOREIGN KEY (`beli_user_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_beli_ibfk_2` FOREIGN KEY (`beli_suplier_id`) REFERENCES `tbl_suplier` (`suplier_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_detail_beli`
--
ALTER TABLE `tbl_detail_beli`
  ADD CONSTRAINT `tbl_detail_beli_ibfk_1` FOREIGN KEY (`d_beli_barang_id`) REFERENCES `tbl_barang` (`barang_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_detail_beli_ibfk_2` FOREIGN KEY (`d_beli_kode`) REFERENCES `tbl_beli` (`beli_kode`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_detail_jual`
--
ALTER TABLE `tbl_detail_jual`
  ADD CONSTRAINT `tbl_detail_jual_ibfk_2` FOREIGN KEY (`d_jual_nofak`) REFERENCES `tbl_jual` (`jual_nofak`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_jual`
--
ALTER TABLE `tbl_jual`
  ADD CONSTRAINT `tbl_jual_ibfk_1` FOREIGN KEY (`jual_user_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
