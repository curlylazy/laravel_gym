-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Bulan Mei 2021 pada 11.04
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
('ADMIN003', 'lanang', 'eyJpdiI6IkhLNHYwZjR0dVV3Q2dCenROTDlucFE9PSIsInZhbHVlIjoibWg1eUpYa2U3ZmF5R2M3anlZOTlZQT09IiwibWFjIjoiYmEzNWExNjIzNjVmZWI0YThmYzRjOTg1MGQyN2RlMjdjN2RlMDlhZDY4M2RmNzJkZmY5ZmRlOWUwMjcwMWI3MSJ9', 'Lanang Trisna', 'STAFF', 1, '2021-05-04 08:07:00', '2021-05-04 08:09:00'),
('ADMIN004', 'tata', 'eyJpdiI6IkpWR21zamVDNy9IVGxUVWZGWUM2NVE9PSIsInZhbHVlIjoiRlFvRUMyMmtZNnJERHp1dmY5Q2FWQT09IiwibWFjIjoiZWU0ZjcxYThkMGE2OGI3MTNhM2UwNWRhMjc5MjdmOGZkMGQ0OGM1YzllZjZiMDQ3YTQ2YWJkZGIwYTE1YjQyZiJ9', 'Tata Hermawan', 'STAFF', 1, '2021-05-10 05:13:00', '2021-05-10 05:13:00');

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

--
-- Dumping data untuk tabel `tbl_alat_gym`
--

INSERT INTO `tbl_alat_gym` (`kodealatgym`, `kodeadmin`, `namaalatgym`, `keteranganalatgym`, `gambaralatgym`, `statusalatgym`, `dateaddalatgym`, `dateupdalatgym`) VALUES
('20210510-ALATGYM001', 'admin', 'Advance Door Gym Peralatan Fitness', '<p>membentuk otot kaki dan tangan, sangat bagus untuk anda yg ingin mendapatkan body yang bagus</p>', 'pic_1620630399_10096611_1.jpg', 1, '2021-05-10 06:59:00', '2021-05-10 07:06:00'),
('20210510-ALATGYM002', 'ADMIN001', 'Treadmill', '<p><span style=\"color: rgb(32, 33, 36); font-family: arial, sans-serif;\">Sama halnya seperti lari di luar ruangan,&nbsp;</span><b style=\"color: rgb(32, 33, 36); font-family: arial, sans-serif;\">manfaat treadmill</b><span style=\"color: rgb(32, 33, 36); font-family: arial, sans-serif;\">&nbsp;juga dapat menstabilkan peredaran darah, menguatkan jantung, mempertahankan keseimbangan metabolisme tubuh agar tetap prima, serta mampu mempertahankan kekuatan otot.</span><br></p>', 'pic_1620630242_t900b-treadmill.jpg', 1, '2021-05-10 07:04:00', '2021-05-10 07:04:00');

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
  `jk` varchar(1) DEFAULT NULL,
  `tanggalaktifsampai` date DEFAULT NULL COMMENT 'tanggal aktif sampai kapan anggotanya.',
  `statusanggota` int(1) DEFAULT NULL COMMENT '0  = pending, 1 = aktif, 2 = tidak aktif',
  `gambaranggota` varchar(100) DEFAULT NULL,
  `dateaddanggota` datetime DEFAULT NULL,
  `dateupdanggota` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_anggota`
--

INSERT INTO `tbl_anggota` (`kodeanggota`, `useranggota`, `password`, `namaanggota`, `noteleponanggota`, `alamatanggota`, `jk`, `tanggalaktifsampai`, `statusanggota`, `gambaranggota`, `dateaddanggota`, `dateupdanggota`) VALUES
('20210510-ANGGOTA001', 'saputrastyawan.d@gmail.com', 'eyJpdiI6IjJBb0hrOFFGdkRlbGVCZUZOK2JMamc9PSIsInZhbHVlIjoienZOenJCTzVnUzNPVHlGMlRWRVY4QT09IiwibWFjIjoiMDc0OGUyZTBiZjkwNDZkZjMzZjk2N2NmNDhmYzIxYzAyMzJhZTdiNWEwNzZkODk5MzZjOGI0ODdjNzE2NjE3ZSJ9', 'Saputra Styawan', '08636677384', 'Jalan Campuan Asri Blok BB no 67', 'L', NULL, 1, 'pic_1620722535_Andri_Andri.jpg', '2021-05-10 09:01:00', '2021-05-11 08:42:00'),
('20210510-ANGGOTA002', 'arka@gmail.com', 'eyJpdiI6Ims0NDA1dTl1eGNNbERUZTVYRWNQaGc9PSIsInZhbHVlIjoiUkNjS3FZZU5IU0JTaGhEUWdBQ1doQT09IiwibWFjIjoiNTkwNWI4OTY2OGJmMmE3MDBjZWM0ZGJmZDA4OWFjNzExODliZDdhMjZmNDBiNjI2NjNmZTFhYzBmYmEzODFlMCJ9', 'Putu Arka Ardian', '08563735581', 'Jalan Pulau Biru No 68', 'L', NULL, 1, 'pic_1620637426_userbaby.jpeg', '2021-05-10 09:03:00', '2021-05-10 09:03:00'),
('20210511-ANGGOTA003', 'chandra@gmail.com', 'eyJpdiI6ImR5a01laDNJSE55RlROZDNOQTFzMFE9PSIsInZhbHVlIjoiVEhwamczem0wTFBiODhSLy9uT0ROZz09IiwibWFjIjoiZTgwM2FmMjM2ZWI0YjExYWQzZTdmMDJhZDZiMmZhYzA5MmFiNDU4OTdhYjM5YjJhMzJmZGNkN2YwNmFhZWY5YiJ9', 'Ni Nyoman Chandra Dewi', '08563735581', 'Jalan Campuan Asri Blok BB no 67', 'L', NULL, 1, 'pic_1620722511_images.jpg', '2021-05-11 08:41:00', '2021-05-11 08:41:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_informasi`
--

CREATE TABLE `tbl_informasi` (
  `kodeinformasi` varchar(25) NOT NULL,
  `kodeadmin` varchar(25) DEFAULT NULL,
  `judulinformasi` varchar(100) DEFAULT NULL,
  `isiinformasi` text DEFAULT NULL,
  `statusinformasi` int(1) DEFAULT NULL COMMENT '1= aktif , 2 = tidak',
  `dateaddinformasi` datetime DEFAULT NULL,
  `dateupdinformasi` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_informasi`
--

INSERT INTO `tbl_informasi` (`kodeinformasi`, `kodeadmin`, `judulinformasi`, `isiinformasi`, `statusinformasi`, `dateaddinformasi`, `dateupdinformasi`) VALUES
('20210510-INFORMASI001', 'ADMIN001', 'Pengunguman Jam Buka', '<p>untuk jam buka selanjutnya kami mulai buka dari jam 9 pagi sampai dengan jam 5 sore, dimohon pengertiannya.</p>', 1, '2021-05-10 08:17:00', '2021-05-10 08:41:00');

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
