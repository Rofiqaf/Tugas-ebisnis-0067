-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2024 at 09:20 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sipp_sawung_ci4`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_pt`
--

CREATE TABLE `data_pt` (
  `kode_pt` varchar(10) NOT NULL,
  `nama_pt` varchar(25) NOT NULL,
  `alamat_pt` text NOT NULL,
  `telepon_pt` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_pt`
--

INSERT INTO `data_pt` (`kode_pt`, `nama_pt`, `alamat_pt`, `telepon_pt`) VALUES
('PT001', 'GANESHA INDONESIA', 'Kota Semarang', '024 8507770'),
('PT002', 'MUSTIKA JAYA LESTARI', 'Kota Semarang', '0247667117'),
('PT003', 'TRISULA BINTANG UTAMA', 'Kota Semarang', '0811-1112-130'),
('PT004', 'CIOMAS ADISATWA', 'Kabupaten Karanganyar', '0271 784384'),
('PT005', 'ASputra Perkasa Makmur', 'Jakarta Selatan, DKI Jakarta', '0813-1438-808'),
('PT006', 'AMANAH MITRA BROILER', 'Kota Malang', '087756858811');

-- --------------------------------------------------------

--
-- Table structure for table `levels`
--

CREATE TABLE `levels` (
  `kode_levels` varchar(10) NOT NULL,
  `nama_levels` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `levels`
--

INSERT INTO `levels` (`kode_levels`, `nama_levels`) VALUES
('1', 'Super Admin'),
('2', 'Admin Penjualan'),
('3', 'Admin Pembelian'),
('4', 'Pemilik');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `kode_pembelian` varchar(99) NOT NULL,
  `tanggal_pembelian` date NOT NULL,
  `supplier` varchar(25) NOT NULL,
  `kode_produk_dibeli` varchar(10) NOT NULL,
  `produk_dibeli` varchar(25) NOT NULL,
  `detail_ekor` text NOT NULL,
  `detail_kg` text NOT NULL,
  `jml_ekor` int(99) NOT NULL,
  `jml_kg` double NOT NULL,
  `harga` double NOT NULL,
  `harga_total` double NOT NULL,
  `bukti` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `kode_penjualan` varchar(99) NOT NULL,
  `no_perbulan` int(11) NOT NULL,
  `bulan` int(11) NOT NULL,
  `tanggal_penjualan` date NOT NULL,
  `customer` varchar(25) NOT NULL,
  `kode_produk_dijual` varchar(10) NOT NULL,
  `produk` varchar(25) NOT NULL,
  `detail_ekor` text NOT NULL,
  `detail_kg` text NOT NULL,
  `ekor` int(99) NOT NULL,
  `kg` double NOT NULL,
  `harga` double NOT NULL,
  `totalHarga` double NOT NULL,
  `bayar` double NOT NULL,
  `kembalian` double NOT NULL,
  `status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `kode_produk` varchar(10) NOT NULL,
  `nama_produk` varchar(25) NOT NULL,
  `harga_beliperkg` double NOT NULL,
  `harga_jualperkg` double NOT NULL,
  `stok_perkg` double NOT NULL,
  `stok_perekor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`kode_produk`, `nama_produk`, `harga_beliperkg`, `harga_jualperkg`, `stok_perkg`, `stok_perekor`) VALUES
('P001', 'Ayam Broiler', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `kode_supplier` varchar(10) NOT NULL,
  `nama_supplier` varchar(25) NOT NULL,
  `alamat_supplier` text NOT NULL,
  `telepon_supplier` varchar(13) NOT NULL,
  `sprkode_pt` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`kode_supplier`, `nama_supplier`, `alamat_supplier`, `telepon_supplier`, `sprkode_pt`) VALUES
('AMB-001', 'Roji', 'Kalirandu, Petarukan, Pemalang', '087781819898', 'PT006'),
('CA-001', 'Erwin', 'Padek, Ulujami, Pemalang', '085677321199', 'PT004'),
('GI-001', 'Sutono', 'Kaliprahu, Ulujami, Pemalang', '085677335455', 'PT001'),
('GI-002', 'Masruri', 'Kemuning, Ampelgading, Pemalang', '085589896751', 'PT001'),
('GI-003', 'Abdul Syukur', 'Kemuning', '081223422299', 'PT001'),
('MJL-001', 'Agus', 'Gerbang Krep, Sragi, Pekalongan', '089956718088', 'PT002'),
('MJL-002', 'Kamid', 'Karang Brei, Bodeh, Pemalang', '082367679990', 'PT002'),
('TBU-001', 'Wagio', 'Kajen, Pekalongan', '087785851111', 'PT003'),
('TBU-002', 'Devita', 'Kulu, Karanganyar, Pekalongan', '08562218809', 'PT003');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `kode_user` varchar(10) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `level` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`kode_user`, `username`, `password`, `nama`, `level`) VALUES
('1', 'super', 'super', 'Super Admin', 'Super Admin'),
('2', 'penjualan', 'penjualan', 'Admin Penjualan', 'Admin Penjualan'),
('3', 'pembelian', 'pembelian', 'Admin Pembelian', 'Admin Pembelian'),
('4', 'pemilik', 'pemilik', 'Pemilik Usaha', 'Pemilik');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_pt`
--
ALTER TABLE `data_pt`
  ADD PRIMARY KEY (`kode_pt`);

--
-- Indexes for table `levels`
--
ALTER TABLE `levels`
  ADD PRIMARY KEY (`kode_levels`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`kode_pembelian`),
  ADD UNIQUE KEY `kode_pembelian` (`kode_pembelian`),
  ADD UNIQUE KEY `kode_pembelian_2` (`kode_pembelian`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`kode_penjualan`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`kode_produk`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`kode_supplier`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`kode_user`),
  ADD UNIQUE KEY `username` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
