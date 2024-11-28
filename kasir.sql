-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 07, 2024 at 05:06 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kasir`
--

-- --------------------------------------------------------

--
-- Table structure for table `detailpenjualan`
--

CREATE TABLE `detailpenjualan` (
  `detail_id` int(11) NOT NULL,
  `penjualan_id` int(11) DEFAULT NULL,
  `produk_id` int(11) DEFAULT NULL,
  `kode_produk` varchar(15) NOT NULL,
  `jumlah_produk` int(11) DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detailpenjualan`
--

INSERT INTO `detailpenjualan` (`detail_id`, `penjualan_id`, `produk_id`, `kode_produk`, `jumlah_produk`, `subtotal`) VALUES
(34, 26, NULL, 'C.002', 4, NULL),
(35, 27, NULL, 'C.002', 3, NULL),
(38, 28, NULL, 'C.005', 5, NULL),
(39, 29, NULL, 'X.001', 1, NULL),
(40, 29, NULL, 'M.006', 1, NULL),
(41, 29, NULL, 'C.004', 4, NULL),
(42, 34, NULL, 'X.001', 5, 0.00),
(45, 35, NULL, 'C.003', 5, 115000.00),
(46, 35, NULL, 'X.001', 1, 15000.00),
(47, 35, NULL, 'C.008', 1, 24000.00),
(48, 36, NULL, 'C.002', 1, 22000.00),
(49, 37, NULL, 'X.001', 4, 20000.00),
(50, 38, NULL, 'M.005', 3, 24000.00),
(51, 38, NULL, 'M.006', 3, 36000.00),
(52, 39, NULL, 'M.006', 1, 12000.00),
(53, 41, NULL, 'C.008', 1, 24000.00),
(54, 41, NULL, 'C.006', 2, 48000.00),
(55, 42, NULL, 'X.001', 5, 25000.00),
(57, 50, NULL, 'H.002', 1, 500000.00),
(58, 30, NULL, 'X.001', 2, NULL),
(59, 30, NULL, 'X.001', 3, NULL),
(61, 51, NULL, 'X.001', 1, 5000.00),
(62, 51, NULL, 'G.003', 1, 17000.00),
(63, 52, NULL, '0', 1, 0.00),
(64, 52, NULL, '0', 1, 0.00),
(65, 52, NULL, 'X.001', 1, 5000.00),
(67, 53, NULL, 'C.001', 4, 88000.00),
(68, 54, NULL, 'C.003', 1, 23000.00),
(69, 55, NULL, 'K.001', 1, 13000.00),
(70, 56, NULL, 'C.006', 1, 24000.00),
(71, 56, NULL, 'H.002', 1, 500000.00),
(73, 57, NULL, 'C.006', 1, 24000.00),
(74, 57, NULL, 'C.008', 1, 24000.00),
(75, 58, NULL, 'RB001', 1, 15000.00),
(76, 58, NULL, 'RB003', 1, 16000.00),
(77, 59, NULL, 'RB010', 1, 18000.00),
(78, 60, NULL, 'RB008', 1, 16000.00),
(79, 60, NULL, 'RB008', 1, 16000.00),
(80, 64, NULL, 'RB009', 1, 22000.00),
(81, 68, NULL, 'RB011', 1, 17000.00),
(82, 68, NULL, 'RB012', 1, 19000.00),
(83, 70, NULL, 'M010', 3, 30000.00),
(84, 71, NULL, 'RB008', 1, 16000.00),
(85, 72, NULL, 'RB011', 1, 17000.00),
(86, 77, NULL, 'RB009', 1, 22000.00),
(87, 78, NULL, 'RB009', 1, 22000.00),
(88, 79, NULL, 'RB008', 1, 16000.00);

--
-- Triggers `detailpenjualan`
--
DELIMITER $$
CREATE TRIGGER `kurangi_stok_produk` AFTER INSERT ON `detailpenjualan` FOR EACH ROW BEGIN
    DECLARE stok_produk INT;

    -- Ambil jumlah stok produk sebelumnya
    SELECT stok INTO stok_produk FROM produk WHERE kode_produk = NEW.kode_produk;

    -- Kurangi jumlah stok produk dengan jumlah terjual
    UPDATE produk SET stok = stok_produk - NEW.jumlah_produk WHERE kode_produk = NEW.kode_produk;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_stok_after_sale` AFTER INSERT ON `detailpenjualan` FOR EACH ROW BEGIN
    DECLARE sold_quantity INT;
    
    -- Ambil jumlah produk yang terjual dari detailpenjualan
    SELECT jumlah_produk INTO sold_quantity FROM detailpenjualan WHERE detail_id = NEW.detail_id;
    
    -- Kurangi stok produk yang terjual
    UPDATE produk SET stok = stok - sold_quantity WHERE produk_id = NEW.produk_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `kode_kategori` varchar(15) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `kode_kategori`, `nama_kategori`) VALUES
(1, 'A.001', 'Makanan'),
(2, 'B.001', 'Minuman');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `pelanggan_id` int(11) NOT NULL,
  `nama_pelanggan` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `nomor_telepon` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`pelanggan_id`, `nama_pelanggan`, `alamat`, `nomor_telepon`) VALUES
(12, 'umum', 'majalengka', '08123456789'),
(13, 'firdhan', 'liangjulang', '08423474753');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `penjualan_id` int(11) NOT NULL,
  `tgl_penjualan` date DEFAULT NULL,
  `nama_user` varchar(255) NOT NULL,
  `bayar` decimal(10,2) NOT NULL,
  `total_harga` decimal(10,2) DEFAULT NULL,
  `pelanggan_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `produk_id` int(11) NOT NULL,
  `kode_produk` varchar(15) NOT NULL,
  `nama_produk` varchar(255) DEFAULT NULL,
  `kode_kategori` varchar(15) NOT NULL,
  `harga` decimal(10,2) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`produk_id`, `kode_produk`, `nama_produk`, `kode_kategori`, `harga`, `stok`) VALUES
(1, 'RB001', 'Roti Bakar Coklat', 'A.001', 15000.00, 50),
(2, 'RB002', 'Roti Bakar Keju', 'A.001', 17000.00, 30),
(3, 'RB003', 'Roti Bakar Selai Strawberry', 'A.001', 16000.00, 39),
(4, 'RB004', 'Roti Bakar Kacang', 'A.001', 18000.00, 25),
(5, 'RB005', 'Roti Bakar Pisang', 'A.001', 15000.00, 35),
(6, 'RB006', 'Roti Bakar Nutella', 'A.001', 19000.00, 20),
(7, 'RB007', 'Roti Bakar Coklat Kacang', 'A.001', 20000.00, 15),
(8, 'RB008', 'Roti Bakar Vanilla', 'A.001', 16000.00, 41),
(9, 'RB009', 'Roti Bakar Keju dan Coklat', 'A.001', 22000.00, 7),
(10, 'RB010', 'Roti Bakar Telur', 'A.001', 18000.00, 29),
(11, 'RB011', 'Roti Bakar Madu', 'A.001', 17000.00, 38),
(12, 'RB012', 'Roti Bakar Karamel', 'A.001', 19000.00, 24),
(13, 'RB013', 'Roti Bakar Durian', 'A.001', 25000.00, 20),
(14, 'RB014', 'Roti Bakar Matcha', 'A.001', 20000.00, 15),
(15, 'RB015', 'Roti Bakar Campur', 'A.001', 21000.00, 18),
(16, 'RB016', 'Roti Bakar Coklat Putih', 'A.001', 19000.00, 22),
(17, 'RB017', 'Roti Bakar Almond', 'A.001', 23000.00, 12),
(18, 'RB018', 'Roti Bakar Rasa Sosis', 'A.001', 20000.00, 15),
(19, 'RB019', 'Roti Bakar Durian', 'A.001', 18000.00, 25),
(20, 'RB020', 'Roti Bakar Kacang Merah', 'A.001', 22000.00, 10),
(21, 'M001', 'Teh Manis', 'B.001', 5000.00, 100),
(22, 'M002', 'Kopi Hitam', 'B.001', 15000.00, 50),
(23, 'M003', 'Jus Jeruk', 'B.001', 12000.00, 60),
(24, 'M004', 'Air Mineral', 'B.001', 3000.00, 200),
(25, 'M005', 'Susu Coklat', 'B.001', 10000.00, 80),
(26, 'M006', 'Es Teh', 'B.001', 7000.00, 70),
(27, 'M007', 'Jus Mangga', 'B.001', 13000.00, 40),
(28, 'M008', 'Minuman Soda', 'B.001', 8000.00, 90),
(29, 'M009', 'Kopi Susu', 'B.001', 12000.00, 50),
(30, 'M010', 'Es Kelapa', 'B.001', 10000.00, 27);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `nama_user` varchar(255) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `level` enum('admin','petugas','kasir') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `nama_user`, `username`, `password`, `level`) VALUES
(10, 'Admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(11, 'Petugas', 'petugas', 'afb91ef692fd08c445e8cb1bab2ccf9c', 'petugas');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detailpenjualan`
--
ALTER TABLE `detailpenjualan`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `PenjualanID` (`penjualan_id`),
  ADD KEY `ProdukID` (`produk_id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`pelanggan_id`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`penjualan_id`),
  ADD KEY `PelangganID` (`pelanggan_id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`produk_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detailpenjualan`
--
ALTER TABLE `detailpenjualan`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `pelanggan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `penjualan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `produk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
