-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 04 Feb 2019 pada 04.51
-- Versi Server: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kpi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kpi`
--

CREATE TABLE `tb_kpi` (
  `kpi_id` int(11) NOT NULL,
  `kpi` varchar(50) NOT NULL,
  `kpi_name` varchar(50) NOT NULL,
  `level` int(11) NOT NULL,
  `weight` double NOT NULL,
  `pic` varchar(50) NOT NULL,
  `target` int(11) DEFAULT NULL,
  `remarks` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kpi_name`
--

CREATE TABLE `tb_kpi_name` (
  `kpi_name` varchar(50) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `finish_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kpi_score`
--

CREATE TABLE `tb_kpi_score` (
  `kpi` varchar(50) NOT NULL,
  `kpi_name` varchar(50) NOT NULL,
  `month` int(11) NOT NULL,
  `skor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kpi_structure`
--

CREATE TABLE `tb_kpi_structure` (
  `kpi` varchar(50) NOT NULL,
  `kpi_name` varchar(50) NOT NULL,
  `kpi_parent` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pegawai`
--

CREATE TABLE `tb_pegawai` (
  `id_pegawai` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jabatan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_pegawai`
--

INSERT INTO `tb_pegawai` (`id_pegawai`, `password`, `nama`, `jabatan`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'VP'),
('G1010', '3af73c3481c33430c92200785eb1643d', 'Fahmiko Purnama Putra', 'VP');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_kpi`
--
ALTER TABLE `tb_kpi`
  ADD PRIMARY KEY (`kpi_id`),
  ADD KEY `fk_kpi_name` (`kpi_name`);

--
-- Indexes for table `tb_kpi_name`
--
ALTER TABLE `tb_kpi_name`
  ADD PRIMARY KEY (`kpi_name`),
  ADD KEY `fk_pegawai_create` (`created_by`);

--
-- Indexes for table `tb_pegawai`
--
ALTER TABLE `tb_pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_kpi`
--
ALTER TABLE `tb_kpi`
  MODIFY `kpi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_kpi_name`
--
ALTER TABLE `tb_kpi_name`
  ADD CONSTRAINT `fk_pegawai_create` FOREIGN KEY (`created_by`) REFERENCES `tb_pegawai` (`id_pegawai`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
