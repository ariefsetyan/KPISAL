-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Sep 2019 pada 07.22
-- Versi server: 10.3.16-MariaDB
-- Versi PHP: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mynotescode`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `no_pirt` varchar(11) NOT NULL,
  `nama_pemilik` varchar(50) NOT NULL,
  `alamat_rumah` varchar(50) NOT NULL,
  `telp` varchar(15) NOT NULL,
  `nama_produk` varchar(50) NOT NULL,
  `nama_perusahaan` varchar(50) NOT NULL,
  `alamat_perusahaan` varchar(50) NOT NULL,
  `tanggal_penyuluhan` date NOT NULL,
  `tempat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`no_pirt`, `nama_pemilik`, `alamat_rumah`, `telp`, `nama_produk`, `nama_perusahaan`, `alamat_perusahaan`, `tanggal_penyuluhan`, `tempat`) VALUES
('11012016001', 'Rizaldi Maulidia Achmad', 'jalan dharmahusada', '085733145666', 'susu murni surabaya', 'PT.susu', 'jalan prapen indah surabaya', '2019-09-02', 'Kantor Dinas Kesehatan Surabaya'),
('11012016002', 'Shinta Nur Rahma', 'jalan jojoran', '089987262516', 'teh pocinki', 'PT.TEH', 'jalan ngagel jaya', '2019-08-15', 'Kantor Dinas Kesehatan Surabaya'),
('15410100181', 'daffa', 'amerika', '8123456', 'kripik singkong', 'pt. Kripik', 'swiss', '2019-07-08', 'kantor dinas kesehatan surabaya');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`no_pirt`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
