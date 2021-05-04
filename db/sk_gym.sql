-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Bulan Mei 2021 pada 10.50
-- Versi server: 10.4.10-MariaDB
-- Versi PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sk_gym`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `kodeadmin` varchar(25) NOT NULL,
  `useradmin` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `namaadmin` varchar(50) DEFAULT NULL,
  `akses` varchar(15) DEFAULT NULL COMMENT '''ADMIN'', ''STAFF''',
  `statusadmin` int(1) DEFAULT NULL COMMENT '1 = aktif, 2 = tidak',
  `dateaddadmin` datetime DEFAULT NULL,
  `dateupdadmin` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `tbl_admin`
--

INSERT INTO `tbl_admin` (`kodeadmin`, `useradmin`, `password`, `namaadmin`, `akses`, `statusadmin`, `dateaddadmin`, `dateupdadmin`) VALUES
('ADMIN001', 'admin', 'eyJpdiI6IjlHTTJtM25NQ2ZWRDhTWXlnZHh0Q0E9PSIsInZhbHVlIjoiNVB5YVdTME03WDNrUm5HaGdzTzlNUT09IiwibWFjIjoiYzcxODI0MTg3MmI5NzNmODlmZTljNWZkNjczYjg5NDAzN2ExMDk2MDZiODFlYjcyOTdmOWY1MTZhMTNmZDU0NCJ9', 'Admin Sistem', 'ADMIN', 1, '2020-12-22 04:56:00', '2020-12-22 08:05:00'),
('ADMIN002', 'dwita', 'eyJpdiI6IlJBSmNteCtqdHRzWCtyM1BydTVIR0E9PSIsInZhbHVlIjoiWHJnUVJuVDJ5cjNDeDB6a3pjMEFGUT09IiwibWFjIjoiZThlMjYxZjYwZTVkMGZlMjViNTgwMTM0ZDQ4YTNhY2NlNWVmMGM5Njk3Y2Q2ODgwMzQ1ZWMzN2RhNDZmNWVlOCJ9', 'Dwita Karisma', 'STAFF', 1, '2021-05-04 08:06:00', '2021-05-04 08:06:00'),
('ADMIN003', 'lanang', 'eyJpdiI6IkhLNHYwZjR0dVV3Q2dCenROTDlucFE9PSIsInZhbHVlIjoibWg1eUpYa2U3ZmF5R2M3anlZOTlZQT09IiwibWFjIjoiYmEzNWExNjIzNjVmZWI0YThmYzRjOTg1MGQyN2RlMjdjN2RlMDlhZDY4M2RmNzJkZmY5ZmRlOWUwMjcwMWI3MSJ9', 'Lanang Trisna', 'STAFF', 1, '2021-05-04 08:07:00', '2021-05-04 08:09:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_alat_gym`
--

CREATE TABLE `tbl_alat_gym` (
  `kodealatgym` varchar(25) NOT NULL,
  `kodeadmin` varchar(25) DEFAULT NULL,
  `namaalatgym` varchar(100) DEFAULT NULL,
  `keteranganalatgym` text DEFAULT NULL,
  `gambaralatgym` varchar(100) DEFAULT NULL,
  `statusalatgym` int(11) DEFAULT NULL COMMENT '1 = aktif, 2 = tidak',
  `dateaddalatgym` datetime DEFAULT NULL,
  `dateupdalatgym` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_anggota`
--

CREATE TABLE `tbl_anggota` (
  `kodeanggota` varchar(25) NOT NULL,
  `useranggota` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `namaanggota` varchar(50) DEFAULT NULL,
  `noteleponanggota` varchar(15) DEFAULT NULL,
  `alamatanggota` varchar(50) DEFAULT NULL,
  `emailanggota` varchar(50) DEFAULT NULL,
  `tanggalaktifsampai` date DEFAULT NULL COMMENT 'tanggal aktif sampai kapan anggotanya.',
  `statusanggota` int(1) DEFAULT NULL COMMENT '0  = pending, 1 = aktif, 2 = tidak aktif',
  `gambaranggota` varchar(100) DEFAULT NULL,
  `dateaddanggota` datetime DEFAULT NULL,
  `dateupdanggota` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_informasi`
--

CREATE TABLE `tbl_informasi` (
  `kodeinformasi` varchar(25) NOT NULL,
  `kodeadmin` varchar(25) DEFAULT NULL,
  `judulinformasi` varchar(100) DEFAULT NULL,
  `isiinformasi` text DEFAULT NULL,
  `gambarinformasi` varchar(100) DEFAULT NULL,
  `statusinformasi` int(1) DEFAULT NULL COMMENT '1= aktif , 2 = tidak',
  `dateaddinformasi` datetime DEFAULT NULL,
  `dateupdinformasi` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_konfirmasi`
--

CREATE TABLE `tbl_konfirmasi` (
  `kodekonfirmasi` varchar(25) NOT NULL,
  `kodeanggota` varchar(25) DEFAULT NULL,
  `norek` varchar(50) DEFAULT NULL,
  `bank` varchar(50) DEFAULT NULL,
  `an` varchar(50) DEFAULT NULL,
  `gambarbukti` varchar(100) DEFAULT NULL,
  `statuskonfirmasi` int(11) DEFAULT NULL COMMENT '0 = pending, 1 =  valid, 2 =gagal',
  `keterangangagal` text DEFAULT NULL,
  `tanggalkonfirmasi` date DEFAULT NULL,
  `dateaddkonfirmasi` datetime DEFAULT NULL,
  `dateupdkonfirmasi` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kunjungan`
--

CREATE TABLE `tbl_kunjungan` (
  `kodekunjungan` varchar(25) DEFAULT NULL,
  `kodeanggota` varchar(25) DEFAULT NULL,
  `kodeadmin` varchar(25) DEFAULT NULL,
  `dateaddkunjungan` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`kodeadmin`) USING BTREE;

--
-- Indeks untuk tabel `tbl_alat_gym`
--
ALTER TABLE `tbl_alat_gym`
  ADD PRIMARY KEY (`kodealatgym`);

--
-- Indeks untuk tabel `tbl_anggota`
--
ALTER TABLE `tbl_anggota`
  ADD PRIMARY KEY (`kodeanggota`);

--
-- Indeks untuk tabel `tbl_informasi`
--
ALTER TABLE `tbl_informasi`
  ADD PRIMARY KEY (`kodeinformasi`);

--
-- Indeks untuk tabel `tbl_konfirmasi`
--
ALTER TABLE `tbl_konfirmasi`
  ADD PRIMARY KEY (`kodekonfirmasi`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
