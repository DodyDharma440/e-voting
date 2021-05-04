-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2021 at 10:48 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `evoting_smk`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_pemilihan`
--

CREATE TABLE `data_pemilihan` (
  `pemilihan_id` int(11) NOT NULL,
  `kandidat_id_pilihan` int(11) NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `kandidat`
--

CREATE TABLE `kandidat` (
  `kandidat_id` int(11) NOT NULL,
  `no_urut` int(11) NOT NULL,
  `pasangan` varchar(100) NOT NULL,
  `jabatan` enum('Calon Ketua OSIS - Calon Wakil Ketua OSIS','Calon Ketua MPK - Calon Wakil Ketua MPK','Calon Ketua PKS - Calon Wakil Ketua PKS') NOT NULL,
  `nm_calon` varchar(300) NOT NULL,
  `nm_calon_wakil` varchar(300) NOT NULL,
  `kls_calon` int(11) NOT NULL,
  `kls_calon_wakil` int(11) NOT NULL,
  `foto_calon` varchar(250) NOT NULL,
  `foto_calon_wakil` varchar(250) NOT NULL,
  `visi` varchar(1000) NOT NULL,
  `misi` varchar(10000) NOT NULL,
  `dibuat` datetime NOT NULL,
  `diganti` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `kelas_id` int(11) NOT NULL,
  `tingkat` enum('X','XI','XII','Guru & Staff') NOT NULL,
  `nama_kelas` varchar(250) NOT NULL,
  `anggota` varchar(250) NOT NULL,
  `sudah_memilih` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pelaksanaan`
--

CREATE TABLE `pelaksanaan` (
  `pelaksanaan_id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `no_induk` varchar(100) NOT NULL,
  `nama` varchar(300) NOT NULL,
  `kelas_id_user` int(11) NOT NULL,
  `no_a` int(11) NOT NULL,
  `level` enum('pemilih','admin') NOT NULL,
  `status` enum('Belum Memilih','Sudah Memilih') NOT NULL,
  `password` varchar(1000) NOT NULL,
  `dibuat` datetime NOT NULL,
  `diganti` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `no_induk`, `nama`, `kelas_id_user`, `no_a`, `level`, `status`, `password`, `dibuat`, `diganti`) VALUES
(1, 'admin', 'Admin E-Voting 1', 0, 0, 'admin', 'Belum Memilih', '$2y$10$o329u6c9YiWWhgGRHSBYzucJ.8e1/1bO.9pLvkk8xLx5Jh/ygC0Mi', '2020-12-25 13:43:15', '2021-02-06 21:47:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_pemilihan`
--
ALTER TABLE `data_pemilihan`
  ADD PRIMARY KEY (`pemilihan_id`),
  ADD KEY `kandidat_id_pilihan` (`kandidat_id_pilihan`);

--
-- Indexes for table `kandidat`
--
ALTER TABLE `kandidat`
  ADD PRIMARY KEY (`kandidat_id`),
  ADD KEY `kls_calon` (`kls_calon`),
  ADD KEY `kls_calon_wakil` (`kls_calon_wakil`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`kelas_id`);

--
-- Indexes for table `pelaksanaan`
--
ALTER TABLE `pelaksanaan`
  ADD PRIMARY KEY (`pelaksanaan_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_pemilihan`
--
ALTER TABLE `data_pemilihan`
  MODIFY `pemilihan_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kandidat`
--
ALTER TABLE `kandidat`
  MODIFY `kandidat_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `kelas_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pelaksanaan`
--
ALTER TABLE `pelaksanaan`
  MODIFY `pelaksanaan_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
