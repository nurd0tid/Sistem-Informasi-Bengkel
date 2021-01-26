-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Jan 2021 pada 01.17
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bengkel`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `details`
--

CREATE TABLE `details` (
  `id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `motor` varchar(250) NOT NULL,
  `jenisbarang` varchar(250) NOT NULL,
  `price` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `tgl` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `details`
--

INSERT INTO `details` (`id`, `transaction_id`, `product_id`, `name`, `motor`, `jenisbarang`, `price`, `qty`, `tgl`) VALUES
(39, 42, 25, 'Service Ringan Karburator', '', '', 40000, 1, '2021-01-15 07:30:21'),
(40, 43, 24, 'Discpad', 'Vario Tekno', 'Original', 55000, 1, '2021-01-16 07:30:33'),
(41, 44, 24, 'Discpad', 'Vario Tekno', 'Original', 55000, 1, '2021-01-16 07:30:54'),
(42, 44, 25, 'Service Ringan Karburator', '', '', 40000, 1, '2021-01-16 07:30:54'),
(43, 45, 24, 'Discpad', 'Vario Tekno', 'Original', 55000, 2, '2021-01-16 07:58:55'),
(44, 46, 24, 'Discpad', 'Vario Tekno', 'Original', 55000, 1, '2021-01-16 09:22:37'),
(45, 46, 25, 'Service Ringan Karburator', '', '', 40000, 1, '2021-01-16 09:22:37'),
(46, 47, 24, 'Discpad', 'Vario Tekno', 'Original', 55000, 1, '2021-01-16 09:27:19'),
(47, 47, 25, 'Service Ringan Karburator', '', '', 40000, 1, '2021-01-16 09:27:19'),
(48, 48, 24, 'Discpad', 'Vario Tekno', 'Original', 55000, 1, '2021-01-24 21:48:34'),
(49, 48, 25, 'Service Ringan Karburator', '', '', 40000, 1, '2021-01-24 21:48:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `motor` varchar(250) DEFAULT NULL,
  `kodepart` varchar(250) DEFAULT NULL,
  `jenisbarang` enum('Biasa','Original') DEFAULT NULL,
  `price` int(11) NOT NULL,
  `type` enum('service','sparepart','','') NOT NULL,
  `stock` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `name`, `motor`, `kodepart`, `jenisbarang`, `price`, `type`, `stock`) VALUES
(24, 'Discpad', 'Vario Tekno', 'KVB', 'Original', 55000, 'sparepart', 6),
(25, 'Service Ringan Karburator', NULL, NULL, NULL, 40000, 'service', NULL),
(26, 'Joger', 'Mio', 'KVP', 'Original', 90000, 'sparepart', 9),
(27, 'j', 'yama', '333', 'Original', 998998, 'sparepart', 0),
(28, 'Discpad', 'M', 'KHP', 'Biasa', 90000, 'sparepart', 0),
(29, 'Discpad', 'R', 'ECF', 'Original', 90000, 'sparepart', 0),
(30, 'Discpad', 'eHwe', 'GFH', 'Original', 90000, 'sparepart', 0),
(31, 'Discpad', 'EHFEr', 'ghu', 'Original', 90000, 'sparepart', 0),
(32, 'Discpad', 'Yamaha', 'HFG', 'Original', 90000, 'sparepart', 0),
(33, 'Discpad', 'Yamaha', 'HFG', 'Original', 90000, 'sparepart', 0),
(34, 'Discpad', 'Yamaha', 'HFG', 'Original', 90000, 'sparepart', 0),
(35, 'Discpad', 'Yamaha', 'HFG', 'Original', 90000, 'sparepart', 0),
(36, 'Discpad', 'Yamaha', 'HFG', 'Original', 90000, 'sparepart', 0),
(37, 'Discpad - H', 'Yamaha', 'HFG', 'Original', 90000, 'sparepart', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `purchase`
--

CREATE TABLE `purchase` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `total` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `purchase_details`
--

CREATE TABLE `purchase_details` (
  `id` int(11) NOT NULL,
  `purchase_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `shop_info`
--

CREATE TABLE `shop_info` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `address` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `shop_info`
--

INSERT INTO `shop_info` (`id`, `name`, `address`) VALUES
(1, 'AVS PERKASA', 'Jl. Mencari Cinta Sejati');

-- --------------------------------------------------------

--
-- Struktur dari tabel `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `address` varchar(300) NOT NULL,
  `telephone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `address`, `telephone`) VALUES
(1, 'Jhon Doe', 'Jalan Raya Mangga 2', '08982819689'),
(2, 'Part One', 'Joglo', '08982819689');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `type` enum('sparepart','service') NOT NULL,
  `total` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `customer` varchar(100) DEFAULT NULL,
  `plat` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transactions`
--

INSERT INTO `transactions` (`id`, `type`, `total`, `date`, `customer`, `plat`) VALUES
(42, 'service', 40000, '2021-01-15 07:30:21', 'Balqis', 'E 6969 EAC'),
(43, 'sparepart', 55000, '2021-01-16 07:30:33', NULL, NULL),
(44, 'service', 95000, '2021-01-16 07:30:54', 'Aceng', '3332'),
(45, 'sparepart', 110000, '2021-01-16 07:58:55', NULL, NULL),
(46, 'service', 95000, '2021-01-16 09:22:37', 'Aia', 'B 7676 ECD'),
(47, 'service', 95000, '2021-01-16 09:27:19', 'Paman Gober', 'B 6969 AED'),
(48, 'service', 95000, '2021-01-24 21:48:34', 'sadsadsadsadsadads', '642423');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$3BbAWRAxBSMG8eWL1Q1XcORKVHb6Q0ARczZ8WdLzyYF3n68jK/QEC');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `details`
--
ALTER TABLE `details`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `purchase_details`
--
ALTER TABLE `purchase_details`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `shop_info`
--
ALTER TABLE `shop_info`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `details`
--
ALTER TABLE `details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `purchase`
--
ALTER TABLE `purchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `purchase_details`
--
ALTER TABLE `purchase_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `shop_info`
--
ALTER TABLE `shop_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
