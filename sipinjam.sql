-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2021 at 06:29 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sipinjam`
--

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id` int(255) NOT NULL,
  `id_siswa` int(255) NOT NULL,
  `id_sarpras` int(255) NOT NULL,
  `id_sekolah` int(255) NOT NULL,
  `total` int(255) NOT NULL,
  `tgl_awal` date NOT NULL,
  `tgl_akhir` date NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id`, `id_siswa`, `id_sarpras`, `id_sekolah`, `total`, `tgl_awal`, `tgl_akhir`, `status`) VALUES
(1, 1, 1, 1, 1, '2021-06-12', '2021-06-14', 'done'),
(2, 1, 1, 1, 1, '2021-06-12', '2021-06-13', 'n'),
(3, 1, 4, 1, 10, '2021-06-12', '2021-06-13', 'done'),
(4, 1, 2, 1, 2, '2021-06-12', '2021-06-15', 'n'),
(5, 6, 8, 1, 1, '2021-06-15', '2021-06-16', 'y'),
(6, 6, 10, 1, 2, '2021-06-15', '2021-06-17', 'y'),
(7, 6, 1, 1, 3, '2021-06-16', '2021-06-16', 'y'),
(8, 6, 9, 1, 2, '2021-06-11', '2021-06-12', 'y'),
(9, 6, 10, 1, 11, '2021-06-24', '2021-06-01', 'y'),
(10, 6, 1, 1, 12, '2021-06-02', '2021-06-02', 'y');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `id` int(255) NOT NULL,
  `id_sarpras` int(255) NOT NULL,
  `total_sarpras` int(255) NOT NULL,
  `rating` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`id`, `id_sarpras`, `total_sarpras`, `rating`) VALUES
(1, 1, 3, 1),
(2, 9, 2, 1),
(3, 10, 11, 1),
(4, 1, 12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sarpras`
--

CREATE TABLE `sarpras` (
  `id` int(255) NOT NULL,
  `sarpras` varchar(255) NOT NULL,
  `total_sarpras` varchar(255) NOT NULL,
  `id_admin` varchar(255) NOT NULL,
  `id_sekolah` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sarpras`
--

INSERT INTO `sarpras` (`id`, `sarpras`, `total_sarpras`, `id_admin`, `id_sekolah`) VALUES
(1, 'Proyektor', '5', '1', '1'),
(2, 'LCD', '10', '1', '1'),
(3, 'LCD', '2', '1', '4'),
(4, 'Kursi Guru', '20', '1', '1'),
(5, 'Meja Guru', '10', '1', '5'),
(6, 'Ruangan Kelas', '5', '1', '5'),
(7, 'Lapangan Basket', '1', '1', '6'),
(8, 'lapangan basket', '2', '1', '1'),
(9, 'papan tulis', '10', '1', '1'),
(10, 'spidol', '20', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `sekolah`
--

CREATE TABLE `sekolah` (
  `id` int(255) NOT NULL,
  `nama_sekolah` varchar(255) NOT NULL,
  `id_admin` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sekolah`
--

INSERT INTO `sekolah` (`id`, `nama_sekolah`, `id_admin`) VALUES
(1, 'SMA 1 Gedangan', 1),
(4, 'SMKN 1 Surabaya', 1),
(5, 'SMA 2 Surabaya', 1),
(6, 'SMA 1 Mojokerto', 1);

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id` int(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_admin` varchar(255) NOT NULL,
  `id_sekolah` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id`, `email`, `username`, `password`, `id_admin`, `id_sekolah`) VALUES
(1, 'ringgo@gmail.com', 'Ringgo Yanwar', 'ringgo123', '1', '1'),
(2, 'gamal@gmail.com', 'Gamal', 'gamal123', '1', '1'),
(3, 'imam@gmail.com', 'Imam', '12345678', '1', '1'),
(4, 'fauzi@gmail.com', 'Fauzi Achmad', '12345678', '1', '4'),
(5, 'rifqi@gmail.com', 'Rifqi', 'rifqi123', '1', '5'),
(6, 'putri@gmail.com', 'Putri Lestari ', 'putri123', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `email`, `username`, `password`) VALUES
(1, 'admin', 'dianbudi@gmail.com', 'Dian Budi', 'dian123'),
(2, 'administrator', 'esareynor99@gmail.com', 'Rachman Esa', 'esa123'),
(3, 'admin', 'ringgk@gail.com', 'ringgoyanwar', 'ringgo123');

-- --------------------------------------------------------

--
-- Table structure for table `web_settings`
--

CREATE TABLE `web_settings` (
  `id` int(255) NOT NULL,
  `item` varchar(255) NOT NULL,
  `item_desc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `web_settings`
--

INSERT INTO `web_settings` (`id`, `item`, `item_desc`) VALUES
(1, 'title', 'SIPinjam');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sarpras`
--
ALTER TABLE `sarpras`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sekolah`
--
ALTER TABLE `sekolah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `web_settings`
--
ALTER TABLE `web_settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sarpras`
--
ALTER TABLE `sarpras`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sekolah`
--
ALTER TABLE `sekolah`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `web_settings`
--
ALTER TABLE `web_settings`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
