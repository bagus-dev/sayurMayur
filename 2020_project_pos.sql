-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Sep 2020 pada 12.55
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.6

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
-- Struktur dari tabel `tbl_barang`
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
-- Dumping data untuk tabel `tbl_barang`
--

INSERT INTO `tbl_barang` (`barang_id`, `barang_gambar`, `barang_nama`, `barang_harpok`, `barang_harjul`, `barang_harjul_grosir`, `barang_stok`, `barang_tgl_input`, `barang_tgl_last_update`, `barang_kategori_id`, `barang_satuan_id`, `barang_user_id`) VALUES
('BR000001', 'BR000001.jpg', 'Bayam', 15000, 20000, 17000, 15, '2016-11-22 23:30:50', '2020-07-29 20:13:56', 1, 4, 1),
('BR000002', 'BR000002.jpg', 'Kangkung', 16000, 20000, 18000, 9, '2016-11-22 23:32:02', '2020-07-29 20:14:12', 1, 4, 1),
('BR000003', 'BR000003.jpg', 'Genjer', 16000, 22000, 18500, 18, '2016-11-22 23:33:08', NULL, 1, 4, 1),
('BR000004', 'BR000004.jpg', 'Buncis', 10000, 50000, 222, 1, '2020-07-29 05:36:35', '2020-07-29 20:09:45', 1, 4, 1),
('BR000005', 'BR000005.jpg', 'Timun', 22222, 2222, 2222, 1, '2020-07-30 12:37:06', NULL, 1, 4, 1),
('BR000006', 'BR000006.jpg', 'Merica', 33, 2, 2, 1, '2020-08-01 07:25:56', NULL, 2, 5, 1),
('BR000007', 'BR000007.jpg', 'Cabai', 2, 20000, 17000, 2, '2020-08-01 07:26:07', NULL, 2, 1, 1),
('BR000008', 'BR000008.jpg', 'Jahe', 2, 3333, 33333, 222, '2020-08-01 07:26:19', NULL, 2, 4, 1),
('BR000009', 'BR000009.jpg', 'Lengkuas', 33, 3333, 17000, 3, '2020-08-01 07:26:29', NULL, 2, 5, 1),
('BR000010', 'BR000010.jpg', 'Kunyit', 222, 22, 2, 1, '2020-08-01 07:26:42', NULL, 2, 1, 1),
('BR000011', 'BR000011.jpg', ' Singkong', 15000, 20000, 18000, 20, '2020-09-03 08:28:25', NULL, 1, 4, 1),
('BR000012', 'BR000012.jpg', ' Pare', 5000, 8000, 7000, 20, '2020-09-03 08:30:27', NULL, 1, 4, 1),
('BR000013', 'BR000013.jpg', ' Seledri', 3000, 5000, 4000, 20, '2020-09-03 08:30:59', NULL, 1, 4, 1),
('BR000014', 'BR000014.jpg', ' Kemangi', 4000, 6000, 5000, 20, '2020-09-03 08:31:38', NULL, 1, 4, 1),
('BR000015', 'BR000015.jpg', ' Terong', 10000, 16000, 14000, 20, '2020-09-03 08:32:13', NULL, 1, 4, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_beli`
--

CREATE TABLE `tbl_beli` (
  `beli_nofak` varchar(15) NOT NULL,
  `beli_tanggal` timestamp NULL DEFAULT current_timestamp(),
  `beli_diskon` int(11) NOT NULL,
  `beli_total` double DEFAULT NULL,
  `beli_jml_uang` double DEFAULT NULL,
  `beli_kembalian` double DEFAULT NULL,
  `beli_user_id` int(11) DEFAULT NULL,
  `beli_suplier_id` int(11) NOT NULL,
  `beli_suplier_nama` varchar(45) NOT NULL,
  `beli_keterangan` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_beli`
--

INSERT INTO `tbl_beli` (`beli_nofak`, `beli_tanggal`, `beli_diskon`, `beli_total`, `beli_jml_uang`, `beli_kembalian`, `beli_user_id`, `beli_suplier_id`, `beli_suplier_nama`, `beli_keterangan`) VALUES
('SM2008080001', '2020-08-08 00:41:51', 0, 100000, 500000, 400000, 1, 3, 'asd', 'eceran'),
('SM2008080002', '2020-08-08 00:42:30', 0, 400000, 600000, 200000, 1, 1, 'Umum', 'eceran'),
('SM2008080003', '2020-08-08 00:43:33', 0, 440000, 1000000, 560000, 1, 1, 'Umum', 'eceran');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_cart_beli`
--

CREATE TABLE `tbl_cart_beli` (
  `c_beli_id` int(11) NOT NULL,
  `c_beli_user_id` int(11) NOT NULL,
  `c_beli_barang_id` varchar(15) NOT NULL,
  `c_beli_barang_nama` varchar(45) NOT NULL,
  `c_beli_barang_satuan` varchar(30) NOT NULL,
  `c_beli_barang_harpok` double NOT NULL,
  `c_beli_barang_harjul` double NOT NULL,
  `c_beli_qty` int(11) NOT NULL,
  `c_beli_diskon` double NOT NULL,
  `c_beli_total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_cart_jual`
--

CREATE TABLE `tbl_cart_jual` (
  `c_jual_id` int(11) NOT NULL,
  `c_jual_user_id` int(11) NOT NULL,
  `c_jual_barang_id` varchar(15) NOT NULL,
  `c_jual_barang_nama` varchar(45) NOT NULL,
  `c_jual_barang_satuan` varchar(30) NOT NULL,
  `c_jual_barang_harpok` double NOT NULL,
  `c_jual_barang_harjul` double NOT NULL,
  `c_jual_qty` int(11) NOT NULL,
  `c_jual_diskon` double NOT NULL,
  `c_jual_total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_checkout`
--

CREATE TABLE `tbl_checkout` (
  `id` int(11) NOT NULL,
  `no_invoice` varchar(20) NOT NULL,
  `barang_id` varchar(15) NOT NULL,
  `kuantitas` int(7) NOT NULL,
  `subtotal` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `customer_id` int(11) NOT NULL,
  `customer_nama` varchar(35) DEFAULT NULL,
  `customer_alamat` varchar(60) DEFAULT NULL,
  `customer_notelp` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_customer`
--

INSERT INTO `tbl_customer` (`customer_id`, `customer_nama`, `customer_alamat`, `customer_notelp`) VALUES
(1, 'Umum', 'Umum', 'Umum'),
(4, 'zxc', 'zxc', '456');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_detail_beli`
--

CREATE TABLE `tbl_detail_beli` (
  `d_beli_id` int(11) NOT NULL,
  `d_beli_nofak` varchar(15) DEFAULT NULL,
  `d_beli_barang_id` varchar(15) DEFAULT NULL,
  `d_beli_barang_nama` varchar(150) DEFAULT NULL,
  `d_beli_barang_satuan` varchar(30) DEFAULT NULL,
  `d_beli_barang_harpok` double DEFAULT NULL,
  `d_beli_barang_harjul` double DEFAULT NULL,
  `d_beli_qty` int(11) DEFAULT NULL,
  `d_beli_diskon` double DEFAULT NULL,
  `d_beli_total` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_detail_beli`
--

INSERT INTO `tbl_detail_beli` (`d_beli_id`, `d_beli_nofak`, `d_beli_barang_id`, `d_beli_barang_nama`, `d_beli_barang_satuan`, `d_beli_barang_harpok`, `d_beli_barang_harjul`, `d_beli_qty`, `d_beli_diskon`, `d_beli_total`) VALUES
(52, 'SM2008080001', 'BR000001', 'Sayur bayam', 'Pcs', 15000, 20000, 5, 0, 100000),
(53, 'SM2008080002', 'BR000001', 'Sayur bayam', 'Pcs', 15000, 20000, 10, 0, 200000),
(54, 'SM2008080002', 'BR000002', 'Sayur enak', 'Bks', 16000, 20000, 10, 0, 200000),
(55, 'SM2008080003', 'BR000003', 'Klem Kabel IKK No 9', 'Bks', 16000, 22000, 20, 0, 440000);

--
-- Trigger `tbl_detail_beli`
--
DELIMITER $$
CREATE TRIGGER `stock_plus` AFTER INSERT ON `tbl_detail_beli` FOR EACH ROW BEGIN
	UPDATE tbl_barang SET barang_stok = barang_stok + NEW.d_beli_qty
    WHERE barang_id = NEW.d_beli_barang_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_detail_jual`
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
-- Dumping data untuk tabel `tbl_detail_jual`
--

INSERT INTO `tbl_detail_jual` (`d_jual_id`, `d_jual_nofak`, `d_jual_barang_id`, `d_jual_barang_nama`, `d_jual_barang_satuan`, `d_jual_barang_harpok`, `d_jual_barang_harjul`, `d_jual_qty`, `d_jual_diskon`, `d_jual_total`) VALUES
(38, 'SM2008070001', 'BR000001', 'Sayur bayam', 'Pcs', 15000, 20000, 1, 0, 20000),
(39, 'SM2008070001', 'BR000007', ' asdadasds', 'Bks', 2, 20000, 2, 0, 40000),
(40, 'SM2008070002', 'BR000002', 'Sayur enak', 'Bks', 16000, 20000, 1, 0, 20000),
(41, 'SM2008070002', 'BR000003', 'Klem Kabel IKK No 9', 'Bks', 16000, 22000, 1, 0, 22000),
(42, 'SM2008070002', 'BR000004', 'Sayur', 'Dus', 10000, 50000, 1, 0, 50000),
(43, 'SM2008070003', 'BR000005', ' asd', 'Kg', 22222, 2222, 1, 0, 2222),
(44, 'SM2008070004', 'BR000006', ' asd', 'aa', 33, 2, 1, 0, 2),
(45, 'SM2008070005', 'BR000007', ' asdadasds', 'Bks', 2, 20000, 1, 0, 20000),
(46, 'SM2008070006', 'BR000007', ' asdadasds', 'Bks', 2, 20000, 1, 0, 20000),
(47, 'SM2008070007', 'BR000007', ' asdadasds', 'Bks', 2, 20000, 1, 0, 20000),
(48, 'SM2008080001', 'BR000001', 'Sayur bayam', 'Pcs', 15000, 20000, 1, 0, 20000),
(49, 'SM2008080002', 'BR000007', ' asdadasds', 'Bks', 2, 20000, 15, 0, 300000);

--
-- Trigger `tbl_detail_jual`
--
DELIMITER $$
CREATE TRIGGER `stock_min` AFTER INSERT ON `tbl_detail_jual` FOR EACH ROW BEGIN
	UPDATE tbl_barang SET barang_stok = barang_stok - NEW.d_jual_qty
    WHERE barang_id = NEW.d_jual_barang_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_diskon`
--

CREATE TABLE `tbl_diskon` (
  `diskon_id` int(11) NOT NULL,
  `diskon_harga` int(11) NOT NULL,
  `diskon_persen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_diskon`
--

INSERT INTO `tbl_diskon` (`diskon_id`, `diskon_harga`, `diskon_persen`) VALUES
(2, 100000, 20),
(6, 50000, 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_invoice`
--

CREATE TABLE `tbl_invoice` (
  `no_invoice` varchar(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cara_bayar` int(1) NOT NULL,
  `tempat_kirim` int(11) NOT NULL,
  `waktu_kirim` int(11) NOT NULL,
  `detail_kirim` text NOT NULL,
  `jenis_bayar` int(1) NOT NULL,
  `total_bayar` int(10) NOT NULL,
  `bukti_transfer` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  `waktu_ditambahkan` datetime NOT NULL,
  `waktu_validasi` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_jual`
--

CREATE TABLE `tbl_jual` (
  `jual_nofak` varchar(15) NOT NULL,
  `jual_tanggal` timestamp NULL DEFAULT current_timestamp(),
  `jual_diskon` int(11) NOT NULL,
  `jual_total` double DEFAULT NULL,
  `jual_jml_uang` double DEFAULT NULL,
  `jual_kembalian` double DEFAULT NULL,
  `jual_user_id` int(11) DEFAULT NULL,
  `jual_customer_id` int(11) NOT NULL,
  `jual_customer_nama` varchar(45) NOT NULL,
  `jual_keterangan` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_jual`
--

INSERT INTO `tbl_jual` (`jual_nofak`, `jual_tanggal`, `jual_diskon`, `jual_total`, `jual_jml_uang`, `jual_kembalian`, `jual_user_id`, `jual_customer_id`, `jual_customer_nama`, `jual_keterangan`) VALUES
('SM2008070001', '2020-08-06 17:00:00', 0, 60000, 300000, 240000, 1, 1, 'Umum', 'eceran'),
('SM2008070002', '2020-08-06 17:00:00', 0, 92000, 500000, 408000, 1, 1, 'Umum', 'eceran'),
('SM2008070003', '2020-08-06 17:00:00', 222, 2000, 2000, 0, 1, 1, 'Umum', 'eceran'),
('SM2008070004', '2020-08-06 17:00:00', 0, 2, 4, 2, 1, 1, 'Umum', 'eceran'),
('SM2008070005', '2020-08-06 17:00:00', 0, 20000, 30000, 10000, 1, 1, 'Umum', 'eceran'),
('SM2008070006', '2020-08-06 17:00:00', 0, 20000, 30000, 10000, 1, 1, 'Umum', 'eceran'),
('SM2008070007', '2020-08-06 17:00:00', 0, 20000, 20000, 0, 1, 4, 'zxc', 'eceran'),
('SM2008080001', '2020-08-07 17:00:00', 0, 20000, 30000, 10000, 1, 1, 'Umum', 'eceran'),
('SM2008080002', '2020-08-07 17:00:00', 0, 300000, 400000, 100000, 1, 1, 'Umum', 'eceran');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kategori`
--

CREATE TABLE `tbl_kategori` (
  `kategori_id` int(11) NOT NULL,
  `kategori_nama` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_kategori`
--

INSERT INTO `tbl_kategori` (`kategori_id`, `kategori_nama`) VALUES
(1, 'Sayur'),
(2, 'Bumbu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_keranjang`
--

CREATE TABLE `tbl_keranjang` (
  `id` int(10) NOT NULL,
  `barang_id` varchar(15) NOT NULL,
  `total_kuantitas` int(7) NOT NULL,
  `total_harga` int(10) NOT NULL,
  `ip_address` varchar(20) NOT NULL,
  `waktu_ditambahkan` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_ongkir`
--

CREATE TABLE `tbl_ongkir` (
  `ongkir_id` int(11) NOT NULL,
  `ongkir_lokasi` text NOT NULL,
  `ongkir_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_ongkir`
--

INSERT INTO `tbl_ongkir` (`ongkir_id`, `ongkir_lokasi`, `ongkir_harga`) VALUES
(1, 'Kramat', 5000),
(2, 'Serdang', 3000),
(4, 'Taktakan', 7000),
(5, 'Legok', 10000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_role`
--

CREATE TABLE `tbl_role` (
  `role_id` int(11) NOT NULL,
  `role_nama` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_role`
--

INSERT INTO `tbl_role` (`role_id`, `role_nama`) VALUES
(1, 'Superadmin'),
(2, 'Admin'),
(3, 'Kasir'),
(4, 'Customer');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_satuan`
--

CREATE TABLE `tbl_satuan` (
  `satuan_id` int(11) NOT NULL,
  `satuan_nama` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_satuan`
--

INSERT INTO `tbl_satuan` (`satuan_id`, `satuan_nama`) VALUES
(1, 'Bks'),
(2, 'Dus'),
(3, 'Pcs'),
(4, 'Kg'),
(5, 'aa');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_suplier`
--

CREATE TABLE `tbl_suplier` (
  `suplier_id` int(11) NOT NULL,
  `suplier_nama` varchar(35) DEFAULT NULL,
  `suplier_alamat` varchar(60) DEFAULT NULL,
  `suplier_notelp` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_suplier`
--

INSERT INTO `tbl_suplier` (`suplier_id`, `suplier_nama`, `suplier_alamat`, `suplier_notelp`) VALUES
(1, 'Umum', 'Umum', 'Umum'),
(3, 'asd', 'asd', '098');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `user_nama` varchar(35) DEFAULT NULL,
  `user_nohp` varchar(13) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_username` varchar(30) DEFAULT NULL,
  `user_password` varchar(128) DEFAULT NULL,
  `user_role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_nama`, `user_nohp`, `user_email`, `user_username`, `user_password`, `user_role_id`) VALUES
(1, 'Mochamad Natsir', '', '', 'superadmin', '$2y$10$afqzZuBiOvmCHJDjCE8Tc.oH2d7vZz9G1pHHcUdUuNRAjA/uyEYp6', 1),
(3, 'Handoko Adji Pangestu', '', '', 'admin', '$2y$10$PssETE4hc5Njym9wudpTMu1F9kBe.kdkKXxLqKsTRLvdTmxITlXSi', 2),
(11, 'zxc', '', '', 'zxc', '9bb319215b59ada160c2d56d14ddd677', 4),
(17, 'Handoko Adji Pangestu', '089650574913', 'handokoadjipangestu@gmail.com', 'handoko', '$2y$10$qGdcqEniLEBP.DWVJC.CGOptRJheKVgj55Ird8WaZWVCJkH7DI5CO', 4),
(18, 'Bagus Puji Rahardjo', '089507456916', 'bagus.rahardjo6@gmail.com', 'bagus', '$2y$10$rz7wKeDP1VRRVe3e.pwC.OOH.N6Lp/ByeXh3zuewznifqKhvNqhp6', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_waktu`
--

CREATE TABLE `tbl_waktu` (
  `waktu_id` int(11) NOT NULL,
  `waktu_nama` varchar(20) NOT NULL,
  `waktu_awal` varchar(20) NOT NULL,
  `waktu_akhir` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_waktu`
--

INSERT INTO `tbl_waktu` (`waktu_id`, `waktu_nama`, `waktu_awal`, `waktu_akhir`) VALUES
(1, 'Pagi', '06:00', '08:00'),
(2, 'Siang', '12:00', '02:00'),
(3, 'Sore', '03:00', '18:00');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD PRIMARY KEY (`barang_id`),
  ADD KEY `barang_user_id` (`barang_user_id`),
  ADD KEY `barang_kategori_id` (`barang_kategori_id`),
  ADD KEY `tbl_barang_ibfk_3` (`barang_satuan_id`);

--
-- Indeks untuk tabel `tbl_beli`
--
ALTER TABLE `tbl_beli`
  ADD PRIMARY KEY (`beli_nofak`),
  ADD KEY `jual_user_id` (`beli_user_id`);

--
-- Indeks untuk tabel `tbl_cart_beli`
--
ALTER TABLE `tbl_cart_beli`
  ADD PRIMARY KEY (`c_beli_id`);

--
-- Indeks untuk tabel `tbl_cart_jual`
--
ALTER TABLE `tbl_cart_jual`
  ADD PRIMARY KEY (`c_jual_id`);

--
-- Indeks untuk tabel `tbl_checkout`
--
ALTER TABLE `tbl_checkout`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indeks untuk tabel `tbl_detail_beli`
--
ALTER TABLE `tbl_detail_beli`
  ADD PRIMARY KEY (`d_beli_id`),
  ADD KEY `d_jual_barang_id` (`d_beli_barang_id`),
  ADD KEY `d_jual_nofak` (`d_beli_nofak`);

--
-- Indeks untuk tabel `tbl_detail_jual`
--
ALTER TABLE `tbl_detail_jual`
  ADD PRIMARY KEY (`d_jual_id`),
  ADD KEY `d_jual_barang_id` (`d_jual_barang_id`),
  ADD KEY `d_jual_nofak` (`d_jual_nofak`);

--
-- Indeks untuk tabel `tbl_diskon`
--
ALTER TABLE `tbl_diskon`
  ADD PRIMARY KEY (`diskon_id`);

--
-- Indeks untuk tabel `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
  ADD PRIMARY KEY (`no_invoice`);

--
-- Indeks untuk tabel `tbl_jual`
--
ALTER TABLE `tbl_jual`
  ADD PRIMARY KEY (`jual_nofak`),
  ADD KEY `jual_user_id` (`jual_user_id`);

--
-- Indeks untuk tabel `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indeks untuk tabel `tbl_keranjang`
--
ALTER TABLE `tbl_keranjang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_ongkir`
--
ALTER TABLE `tbl_ongkir`
  ADD PRIMARY KEY (`ongkir_id`);

--
-- Indeks untuk tabel `tbl_role`
--
ALTER TABLE `tbl_role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indeks untuk tabel `tbl_satuan`
--
ALTER TABLE `tbl_satuan`
  ADD PRIMARY KEY (`satuan_id`);

--
-- Indeks untuk tabel `tbl_suplier`
--
ALTER TABLE `tbl_suplier`
  ADD PRIMARY KEY (`suplier_id`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indeks untuk tabel `tbl_waktu`
--
ALTER TABLE `tbl_waktu`
  ADD PRIMARY KEY (`waktu_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_checkout`
--
ALTER TABLE `tbl_checkout`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_detail_beli`
--
ALTER TABLE `tbl_detail_beli`
  MODIFY `d_beli_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT untuk tabel `tbl_detail_jual`
--
ALTER TABLE `tbl_detail_jual`
  MODIFY `d_jual_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT untuk tabel `tbl_diskon`
--
ALTER TABLE `tbl_diskon`
  MODIFY `diskon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  MODIFY `kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_keranjang`
--
ALTER TABLE `tbl_keranjang`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_ongkir`
--
ALTER TABLE `tbl_ongkir`
  MODIFY `ongkir_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tbl_role`
--
ALTER TABLE `tbl_role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_satuan`
--
ALTER TABLE `tbl_satuan`
  MODIFY `satuan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tbl_suplier`
--
ALTER TABLE `tbl_suplier`
  MODIFY `suplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `tbl_waktu`
--
ALTER TABLE `tbl_waktu`
  MODIFY `waktu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD CONSTRAINT `tbl_barang_ibfk_2` FOREIGN KEY (`barang_kategori_id`) REFERENCES `tbl_kategori` (`kategori_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_barang_ibfk_3` FOREIGN KEY (`barang_satuan_id`) REFERENCES `tbl_satuan` (`satuan_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_detail_beli`
--
ALTER TABLE `tbl_detail_beli`
  ADD CONSTRAINT `tbl_detail_beli_ibfk_1` FOREIGN KEY (`d_beli_nofak`) REFERENCES `tbl_beli` (`beli_nofak`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_detail_jual`
--
ALTER TABLE `tbl_detail_jual`
  ADD CONSTRAINT `tbl_detail_jual_ibfk_2` FOREIGN KEY (`d_jual_nofak`) REFERENCES `tbl_jual` (`jual_nofak`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_jual`
--
ALTER TABLE `tbl_jual`
  ADD CONSTRAINT `tbl_jual_ibfk_1` FOREIGN KEY (`jual_user_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
