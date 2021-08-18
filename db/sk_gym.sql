-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2021 at 12:31 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Table structure for table `tbl_admin`
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
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`kodeadmin`, `useradmin`, `password`, `namaadmin`, `akses`, `statusadmin`, `dateaddadmin`, `dateupdadmin`) VALUES
('ADMIN001', 'admin', 'eyJpdiI6IjlHTTJtM25NQ2ZWRDhTWXlnZHh0Q0E9PSIsInZhbHVlIjoiNVB5YVdTME03WDNrUm5HaGdzTzlNUT09IiwibWFjIjoiYzcxODI0MTg3MmI5NzNmODlmZTljNWZkNjczYjg5NDAzN2ExMDk2MDZiODFlYjcyOTdmOWY1MTZhMTNmZDU0NCJ9', 'Admin Sistem', 'ADMIN', 1, '2020-12-22 04:56:00', '2020-12-22 08:05:00'),
('ADMIN002', 'dwita', 'eyJpdiI6IlJBSmNteCtqdHRzWCtyM1BydTVIR0E9PSIsInZhbHVlIjoiWHJnUVJuVDJ5cjNDeDB6a3pjMEFGUT09IiwibWFjIjoiZThlMjYxZjYwZTVkMGZlMjViNTgwMTM0ZDQ4YTNhY2NlNWVmMGM5Njk3Y2Q2ODgwMzQ1ZWMzN2RhNDZmNWVlOCJ9', 'Dwita Karisma', 'STAFF', 1, '2021-05-04 08:06:00', '2021-05-04 08:06:00'),
('ADMIN003', 'lanang', 'eyJpdiI6IkhLNHYwZjR0dVV3Q2dCenROTDlucFE9PSIsInZhbHVlIjoibWg1eUpYa2U3ZmF5R2M3anlZOTlZQT09IiwibWFjIjoiYmEzNWExNjIzNjVmZWI0YThmYzRjOTg1MGQyN2RlMjdjN2RlMDlhZDY4M2RmNzJkZmY5ZmRlOWUwMjcwMWI3MSJ9', 'Lanang Trisna', 'STAFF', 1, '2021-05-04 08:07:00', '2021-05-04 08:09:00'),
('ADMIN004', 'tata', 'eyJpdiI6IkpWR21zamVDNy9IVGxUVWZGWUM2NVE9PSIsInZhbHVlIjoiRlFvRUMyMmtZNnJERHp1dmY5Q2FWQT09IiwibWFjIjoiZWU0ZjcxYThkMGE2OGI3MTNhM2UwNWRhMjc5MjdmOGZkMGQ0OGM1YzllZjZiMDQ3YTQ2YWJkZGIwYTE1YjQyZiJ9', 'Tata Hermawan', 'STAFF', 1, '2021-05-10 05:13:00', '2021-05-10 05:13:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_alat_gym`
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
-- Dumping data for table `tbl_alat_gym`
--

INSERT INTO `tbl_alat_gym` (`kodealatgym`, `kodeadmin`, `namaalatgym`, `keteranganalatgym`, `gambaralatgym`, `statusalatgym`, `dateaddalatgym`, `dateupdalatgym`) VALUES
('20210510-ALATGYM001', 'ADMIN004', 'Advance Door Gym Peralatan Fitness', '<p>membentuk otot kaki dan tangan, sangat bagus untuk anda yg ingin mendapatkan body yang bagus</p>', 'pic_1620630399_10096611_1.jpg', 1, '2021-05-10 06:59:00', '2021-08-18 09:32:00'),
('20210510-ALATGYM002', 'ADMIN001', 'Treadmill', '<p><span style=\"color: rgb(32, 33, 36); font-family: arial, sans-serif;\">Sama halnya seperti lari di luar ruangan,&nbsp;</span><b style=\"color: rgb(32, 33, 36); font-family: arial, sans-serif;\">manfaat treadmill</b><span style=\"color: rgb(32, 33, 36); font-family: arial, sans-serif;\">&nbsp;juga dapat menstabilkan peredaran darah, menguatkan jantung, mempertahankan keseimbangan metabolisme tubuh agar tetap prima, serta mampu mempertahankan kekuatan otot.</span><br></p>', 'pic_1620630242_t900b-treadmill.jpg', 1, '2021-05-10 07:04:00', '2021-05-10 07:04:00'),
('20210813-ALATGYM003', '', 'Dumbbell', '<p>Bisa digunakan untuk melatih semua kelompok otot&nbsp;</p>', 'pic_1629126123_shutterstock_151938761.jpg', 2, '2021-08-13 04:38:00', '2021-08-16 15:02:00'),
('20210818-ALATGYM004', 'ADMIN004', 'Dumbbell', NULL, 'pic_1629278709_shutterstock_151938761.jpg', 1, '2021-08-18 09:25:00', '2021-08-18 09:32:00'),
('20210818-ALATGYM005', 'ADMIN001', 'Barbell', '<p>digunakan untuk melatih kelompok otot besar, seperti dada, bahu, punggung dan kaki</p>', 'pic_1629280530_Bilancere150-510x340.jpg', 1, '2021-08-18 09:55:00', '2021-08-18 09:55:00'),
('20210818-ALATGYM006', 'ADMIN001', 'Cable Row Machine', '<p>dapat melatih otot punggung bagian tengah</p>', 'pic_1629280926_seated-cable-row-machine-500x500.jpg', 1, '2021-08-18 10:02:00', '2021-08-18 10:02:00'),
('20210818-ALATGYM007', 'ADMIN001', 'Cable Crossover Machine', 'dapat melatih otot dada bagian tengah', 'pic_1629281496_BTM-005-Cable-Crossover.jpg', 1, '2021-08-18 10:11:00', '2021-08-18 10:11:00'),
('20210818-ALATGYM008', 'ADMIN001', 'Leg Press Machine', '<p>fokus untuk melatih otot paha</p>', 'pic_1629281954_leg-press-loaded.jpeg', 1, '2021-08-18 10:19:00', '2021-08-18 10:19:00'),
('20210818-ALATGYM009', 'ADMIN001', 'Abs Machine', '<p>alat ini digunakan untuk melatih otot perut</p>', 'pic_1629282201_hammer-abs-machine-500x500.jpg', 1, '2021-08-18 10:23:00', '2021-08-18 10:23:00'),
('20210818-ALATGYM010', 'ADMIN001', 'Tricep Pushdown Machine', '<p>dapat melatih otot tangan bagian belakang atau tricep</p>', 'pic_1629282539_ProductImage.png', 1, '2021-08-18 10:28:00', '2021-08-18 10:28:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_anggota`
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
  `alasanditolak` varchar(255) DEFAULT NULL,
  `statusanggota` int(1) DEFAULT NULL COMMENT '0  = pending, 1 = aktif, 2 = ditolak, 5 = tidak aktif',
  `gambaranggota` varchar(100) DEFAULT NULL,
  `dateaddanggota` datetime DEFAULT NULL,
  `dateupdanggota` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_anggota`
--

INSERT INTO `tbl_anggota` (`kodeanggota`, `useranggota`, `password`, `namaanggota`, `noteleponanggota`, `alamatanggota`, `jk`, `tanggalaktifsampai`, `alasanditolak`, `statusanggota`, `gambaranggota`, `dateaddanggota`, `dateupdanggota`) VALUES
('20210510-ANGGOTA001', 'saputrasetyawan.d@gmail.com', 'eyJpdiI6IjUrcUI0ZlN4UzloY3Q5ZDBDSUVWTEE9PSIsInZhbHVlIjoiUXYrd1pPbkhlVCt1MkRjdFpoQ1VnQT09IiwibWFjIjoiZDQzMTIxZGFiMTA0YWEzNjJlYjkwMDMyYzk5N2I1YzI0NGNkYmZmYjRiNTY4ZTFjMjVlNGQxNWEzZjRhOWU0MCJ9', 'Saputra Setyawan', '08636677384', 'Jalan Tukad Batanghari XII No. 10B', 'L', NULL, NULL, 1, 'pic_1620722535_Andri_Andri.jpg', '2021-05-10 09:01:00', '2021-06-23 04:13:00'),
('20210510-ANGGOTA002', 'arka@gmail.com', 'eyJpdiI6Ims0NDA1dTl1eGNNbERUZTVYRWNQaGc9PSIsInZhbHVlIjoiUkNjS3FZZU5IU0JTaGhEUWdBQ1doQT09IiwibWFjIjoiNTkwNWI4OTY2OGJmMmE3MDBjZWM0ZGJmZDA4OWFjNzExODliZDdhMjZmNDBiNjI2NjNmZTFhYzBmYmEzODFlMCJ9', 'Putu Arka Ardian', '08563735581', 'Jalan Pulau Biru No 68', 'L', NULL, NULL, 1, 'pic_1620637426_userbaby.jpeg', '2021-05-10 09:03:00', '2021-05-10 09:03:00'),
('20210511-ANGGOTA003', 'chandra@gmail.com', 'eyJpdiI6InVFbGJpT05TTFFDN0R6TGs5NVhqR2c9PSIsInZhbHVlIjoiRzJ6Zy82b3IyRWUza1lWMUZzcFk0QT09IiwibWFjIjoiMzYyZDYwMDNlMmY5OTYwYmNiNjljZTZkYWJhNGY3ZWMzNTExM2I3ZDcyYTcxMzM2NGIyMzVhZGNhOWFiZDM1NCJ9', 'Ni Nyoman Chandra Dewi', '085900753356', 'Jalan Campuan Asri Blok BB no 67', 'P', NULL, NULL, 1, 'pic_1620722511_images.jpg', '2021-05-11 08:41:00', '2021-06-23 04:08:00'),
('20210517-ANGGOTA004', 'curlylazy@gmail.com', 'eyJpdiI6IitEY1NPYURPMlJVWVJXeEkxSjN4T1E9PSIsInZhbHVlIjoiemkzOHcwbEtWbDRlMC82eGFsNDRTQT09IiwibWFjIjoiMzc2Mzg0M2ViMGY4ZWYzOWE3M2VjMDViZTgwM2U1NDhmMmU5YmZiZWQwYTdiY2FmYjc3NzZhN2U1NDQwN2NhMyJ9', 'Curly Frans Sanjaya', '081337457875', 'Jalan Jayagiri XXI No. 4C', 'L', '2021-07-17', 'gunakan photo yang lebih jelas', 1, 'pic_1621310651_peop.png', '2021-05-17 07:38:00', '2021-06-23 04:04:00'),
('20210609-ANGGOTA005', 'kresnak3@gmail.com', 'eyJpdiI6ImxoakNNTUNoR2dEMHZHYjh3cUlRd2c9PSIsInZhbHVlIjoiSUJWSXJKQWZzTHNEanFTVGptenNRdz09IiwibWFjIjoiMTQ5ZDMyZmUzZTc3NzEwZDNmNmRlMTc4YTBjMjc1YjYxNzExOTJkNzc5ZTZmOThmNThhMjZmMDE1YWI1YzQ4ZCJ9', 'Kresna Kristiadi', '085900213792', 'Jalan Jayagiri IX No. 11A', 'L', '2021-07-09', '', 1, 'pic_1623235719_07batik-kawung.png', '2021-06-09 10:48:00', '2021-06-23 04:07:00'),
('20210625-ANGGOTA006', 'kresnak26@gmail.com', 'eyJpdiI6InhTR1JZbzY0TGNCRXFDYlRrWC9FZmc9PSIsInZhbHVlIjoiK2hsVVFGQ0JYS1ROcURnRFA0WFI0dz09IiwibWFjIjoiODUwZTE0MTBhNjE5NDM3NWNhN2M4N2ExNzU4ZDk5ODU2ZmY0MWMwZDE4M2Y0ODEzOGNiYjBkNzZjMGJkY2EzMCJ9', 'Kresna Kristiadi', '085900213792', 'Jalan Jayagiri IX No. 11A', 'L', NULL, '', 1, 'pic_1624585076_07batik-kawung.png', '2021-06-25 01:37:00', '2021-08-15 03:47:00'),
('20210812-ANGGOTA007', 'putuadi26@gmail.com', 'eyJpdiI6IlBzZVljZUU4Z1lhSktkc0pDL0FFK2c9PSIsInZhbHVlIjoiaHlyNVAySXdsSCtLRkx1WW1rR3NZZz09IiwibWFjIjoiMjgyYmVjMzJkZTViNDU3ZGQ5NWFkMzUzZjQ5MzgwMjJhM2UwY2ZkMmQwZmQ1NGJlNGU2YTE2ZTQwMTE1YTNhMCJ9', 'Putu Adi', '085900485685', 'Jalan Tukad Musi X No. 12A', 'L', NULL, '', 1, '', '2021-08-12 07:28:00', '2021-08-12 07:32:00'),
('20210812-ANGGOTA008', 'bagusedi30@gmail.com', 'eyJpdiI6Ikc0TlhSc3huekhoQmlReUFOdHJ6bkE9PSIsInZhbHVlIjoiWGM0K1FlQktyNjkveGxwMjEzQWU1dz09IiwibWFjIjoiMmM0MzNkMTBiZjdhNzRhZjE1ZjIyZjY1ZTY0NjkyZDM5NjUzNzQ5MWFjNDA5OTVlYjg0OWQ2ZDE0YmM0NGQxYyJ9', 'Nyoman Bagus Edi', '081338250450', 'Jalan Tukad Badung IX No. 10B', 'L', NULL, '', 1, '', '2021-08-12 07:36:00', '2021-08-12 07:36:00'),
('20210812-ANGGOTA009', 'ayudevi27@gmail.com', 'eyJpdiI6InIrNTI2OGlQNDZoZGpLYk95a0UyMWc9PSIsInZhbHVlIjoiWWEzdGdDNHFMRHN1Tmd3S3NjYldDdz09IiwibWFjIjoiNDAzZDdhZWFhZDllZTEwNmZmNTVkZmQxMzMyYzFkZjJkYjQwNGM3ZWVlYjcyY2ZhMDhjOGZlODI3YmZmYzA1OCJ9', 'Putri Ayu Devi', '081337500380', 'Jalan Tukad Petanu XX No. 15C', 'P', NULL, '', 1, '', '2021-08-12 07:39:00', '2021-08-12 07:39:00'),
('20210812-ANGGOTA010', 'dewicahyani40@gmail.com', 'eyJpdiI6IjcyZmhtUVJFLzZ0ZjlocTR2SnVzeHc9PSIsInZhbHVlIjoib1R1V2VPdjVkQ0RadzVzcEpIQytIdz09IiwibWFjIjoiMzVjMmIyMjQzNWE0MmI1NTIzMTM5YTY5ODc5YWJjNTYwYzNjMjYyMjA5NmY3N2RmNTMzMmM3ZGJhOGNlOGZlMCJ9', 'Putu Dewi Cahyani', '085900750935', 'Jalan Jayagiri I No. 20A', 'P', NULL, '', 1, '', '2021-08-12 07:41:00', '2021-08-12 07:42:00'),
('20210812-ANGGOTA011', 'chandragun35@gmail.com', 'eyJpdiI6InVTWWQ0N1FrQnB0Y0xMYXNhOGRBZHc9PSIsInZhbHVlIjoiWXA2Q0dBUDJ2S3RmdDljOUFaNXRWUT09IiwibWFjIjoiYjFkODlmMzU0NTIyZDJmMjE3MjViNTMxNmVkZDc4MjMwYWVkYjc2ZmJiNTZhNjIwZjg3NDAzOTU4YjczMTQwYiJ9', 'Chandra Gunawan', '081338600455', 'Jalan Tukad Musi XI No. 15B', 'L', NULL, '', 1, '', '2021-08-12 07:44:00', '2021-08-12 07:44:00'),
('20210812-ANGGOTA012', 'hadistwn@gmail.com', 'eyJpdiI6IlRtbGJBalpkaTZZMWVxelRycjA0WUE9PSIsInZhbHVlIjoiUWlGMHlFWVNhbTVNenNWd3gyaDZzdz09IiwibWFjIjoiOGMzZDAyNDdhNTdiZTE1MmE2YzliYTBlODE0MDAxZTZmMzk2MjRjOTg0MThlNmYyZTM0MjYzYzk3NmY1MzU3ZiJ9', 'Hadi Setiawan', '081338355675', 'Jalan Tukad Badung XI No. 10A', 'L', NULL, '', 1, '', '2021-08-12 07:47:00', '2021-08-12 07:47:00'),
('20210812-ANGGOTA013', 'ayuchndewi@gmail.com', 'eyJpdiI6IjJualc4M2hnS1QyKzhGbnowQmVNMkE9PSIsInZhbHVlIjoidlBGclRmM0tDRm1TSnZjMzFkejJ1dz09IiwibWFjIjoiYzljYjE0MjdkYzZmZjMzNGZlZjM1NWExNmUzYTFhZmQ1N2EyNGNhY2M4Y2VhZDYzNWM0YjliOTZiYjQyMDExMyJ9', 'Ayu Chandra Dewi', '081337800550', 'Jalan Pendidikan X No. 11B', 'P', NULL, '', 1, '', '2021-08-12 07:51:00', '2021-08-12 07:51:00'),
('20210812-ANGGOTA014', 'gdputra@gmail.com', 'eyJpdiI6InBEMi9QNVhUZmdlTmdacXVIamRNeEE9PSIsInZhbHVlIjoianhld2lOcFFLNFM0enA5UEphem9yQT09IiwibWFjIjoiOTEzNWM1MWRjODFiZmFlYTM5YTIyOGI3MjAwNjBhN2IyYTI0NTAxYTMzNTEzNzQ1Y2RkM2MyNmQ1MjI2YmNjZSJ9', 'Gede Dharma Putra', '085700150350', 'Jalan Tukad Pancoran XX No. 12A', 'L', NULL, '', 1, '', '2021-08-12 08:13:00', '2021-08-12 08:14:00'),
('20210812-ANGGOTA015', 'sukmaptr20@gmail.com', 'eyJpdiI6Im9oQ3dmRUxRSXB6M2JLUWNPYUxkQWc9PSIsInZhbHVlIjoiYS9xUGxpYnFYWC9vZXBzQWJQSkNXUT09IiwibWFjIjoiZWMyNjM3M2UwYWQ0MmQ1OTBmNmRmZmIxYTJjMzIyMWI4YmNhMTlhZWU5YjhmNmM2ZWNjNTBlMjcyYTFmODJmMyJ9', 'Made Sukma Putri', '085700235645', 'Jalan Pendidikan IX No. 9B', 'P', NULL, '', 1, '', '2021-08-12 08:16:00', '2021-08-12 08:16:00'),
('20210812-ANGGOTA016', 'herusanjaya@gmail.com', 'eyJpdiI6ImdxdWpsbk1wMXp4b3ZDb2I5TkI0L3c9PSIsInZhbHVlIjoiYi9vZGlXNUNDeTVaVktzWGpTell0QT09IiwibWFjIjoiYTRhZmQ2NzM3NDViNmZmMzYwZGRmN2Q4YjAzYzRkZjQ1NmM1NWI4ZjU0MmZlNjkwNjk5YmU2YTc1NGEzNDg1NiJ9', 'Heru Putra Sanjaya', '085700850670', 'Jalan Tukad Balian VI No. 3A', 'L', NULL, '', 1, '', '2021-08-12 08:19:00', '2021-08-12 08:19:00'),
('20210812-ANGGOTA017', 'devirenata@gmail.com', 'eyJpdiI6ImdiQjRTMXhNQURKQTg4Q2h2MTdKeWc9PSIsInZhbHVlIjoiRTZGcGFpL1NGU3dENEhVTUhMZEdFQT09IiwibWFjIjoiZjk4ZmMwZmY0MmZkYzI5YWM4Yzg4ZTY3Zjg1MmZlYTc5NDcxMjEyNDQ3YTc0ZGQwYTdmNWYxZjVkY2YyZDdmNyJ9', 'Cok Devi Renata', '085700455895', 'Jalan Tukad Balian X No. 6C', 'P', NULL, '', 1, '', '2021-08-12 08:21:00', '2021-08-12 08:22:00'),
('20210812-ANGGOTA018', 'firdausfame20@gmail.com', 'eyJpdiI6Inhnck1qNWVkM1loT0pEZHBsNjJCd0E9PSIsInZhbHVlIjoiRnF4UFN4alAyWDEwdWlncjgvQjNhdz09IiwibWFjIjoiYmQxZmY1N2EwYjYzNmYxZmFmOGQwNjUxNmEyOTI1MmFkNDFmOTUxNTg0NzM3ZmRiOGUxZjE1MTdmNzQxYmQzMiJ9', 'Firdaus Chandra Fame', '081338575787', 'Jalan Tukad Pancoran XII No. 8A', 'L', NULL, '', 1, '', '2021-08-12 08:25:00', '2021-08-12 08:25:00'),
('20210812-ANGGOTA019', 'jokodayat@gmail.com', 'eyJpdiI6Ik5ZcFFMbVBPT2t0VDc2TXdBOHNsU0E9PSIsInZhbHVlIjoiMkl0L1M3dGh1ZmhramJyMGRtM3orZz09IiwibWFjIjoiYjhjMDMyZWQ1ZGIzMTMyNjYxYjg3ZDI0MmM5ZTg2ZmQ0NTdiNGVmZjI2N2Q4ZGVkZTEzMjM1MjgwNjZjZjY3YSJ9', 'Joko Dayat', '081338790870', 'Jalan Tukad Petanu XII No. 15D', 'L', NULL, '', 1, '', '2021-08-12 08:28:00', '2021-08-12 08:28:00'),
('20210812-ANGGOTA020', 'dayudev30@gmail.com', 'eyJpdiI6IkY0QlVCLzRQSU51M1pjU2FxZ084bXc9PSIsInZhbHVlIjoiWEtzSW1qRENicUtJOE1OaTU1ZTYrdz09IiwibWFjIjoiYTg1OWUwNDhjMmQxOGEzZjk0OTg0ODU3NDUwZTk0ZTkwNzg2NDJkNzJlODVhOWZjMjZkNzM0OGE1NjEzZjgzZCJ9', 'Dayu Devi Maharani', '081337245935', 'Jalan Pendidikan VI No. 4B', 'P', NULL, '', 1, '', '2021-08-12 08:30:00', '2021-08-12 08:30:00'),
('20210812-ANGGOTA021', 'yudiantara69@gmail.com', 'eyJpdiI6InFocXp0OGdQOUkrYmEwRDRxS0VqY1E9PSIsInZhbHVlIjoiTURoN2RPNmhOcUdHbFJuL1E3YmVxdz09IiwibWFjIjoiMjAzMTBjMzM1YjNmNjk0MzZjMGFjN2Y1YmQ4MTAxM2M1MzdjMTljNzZiOGRjOGNhZDJlY2QyOTJmMWY4ZjEwZSJ9', 'Putu Yudi Antara', '085600780670', 'Jalan Tukad Batanghari XIV No. 7B', 'L', NULL, '', 1, '', '2021-08-12 08:32:00', '2021-08-12 08:32:00'),
('20210812-ANGGOTA022', 'wimasantr@gmail.com', 'eyJpdiI6ImdZQS9lcmt5eENFUWpUOC9hdkJkekE9PSIsInZhbHVlIjoiT0d5ZFdKUGIwNk0xQitLbEJPYWNyZz09IiwibWFjIjoiZTFjMWZkNzNlNDE3NmQ5NTBkZGViYzhmYjZhMDM4NTk1Zjk1NGU0NjdmNzNjYTVlNjcyOTJlNTMzYmRiYThmYSJ9', 'Kadek Wimas Antari', '085900230540', 'Jalan Pendidikan II No. 2A', 'P', NULL, '', 1, '', '2021-08-12 08:35:00', '2021-08-12 08:35:00'),
('20210812-ANGGOTA023', 'hermanngntg15@gmail.com', 'eyJpdiI6Ijd2am9oZ21aMHF4VlRBbnlFMkN1U3c9PSIsInZhbHVlIjoiRWdEekRwQ2VXR2pLMks2YU0vOU9TZz09IiwibWFjIjoiZGM2NTBkMzY0OGY4YWQ2MTU3MGJiNjI0N2VmODMzZDEyZjQwZWZiMDAwM2Y3MDdlOWRiZGVkNmM0YWE3NDhmYyJ9', 'Herman Frans Ngantung', '081335420840', 'Jalan Jayagiri XV No. 10C', 'L', NULL, '', 1, '', '2021-08-12 08:38:00', '2021-08-12 08:38:00'),
('20210812-ANGGOTA024', 'gddeny05@gmail.com', 'eyJpdiI6IkpWdnd4YXdiUzhHTFE4UDZUd2ZWb2c9PSIsInZhbHVlIjoiaXlKSHgyMDV1aE5sd0I2TmQ4cGpWdz09IiwibWFjIjoiYjZmYTVhZmY2YWJiOGJlMjk4MGE2MzVmYzU3NDU3ODczOTQ4ZmRmZDZhYTllMzFlOTBkZjljYWFiM2M3N2FjYyJ9', 'Gede Deny Arimbawa', '085600575454', 'Jalan Tukad Pancoran IX No. 14B', 'L', NULL, '', 1, '', '2021-08-12 08:47:00', '2021-08-12 08:47:00'),
('20210815-ANGGOTA025', 'wirya30@gmail.com', 'eyJpdiI6IllUNVlnd0NxdlMzWWE2YlJWWEhzRXc9PSIsInZhbHVlIjoiSXQ0TU16RmhvcTdycDR2UlVrcGNTZz09IiwibWFjIjoiNWVmOThiOWMwMjgwNjI3ODZkNTc4YjU0MDU2NWFjZWFmMWVlOTI1MTcxZmY3ZDQ2ZDM1MmI0ZjEwOGY4YjQzMiJ9', 'Putu Wirya Atmaja', '081337575250', 'Jalan Tukad Batanghari VI No. 1A', 'L', NULL, '', 1, '', '2021-08-15 03:39:00', '2021-08-15 03:40:00'),
('20210815-ANGGOTA026', 'diptarhrj@gmail.com', 'eyJpdiI6Imhicit2WHBtRHR1aVpqczlxS0UxSVE9PSIsInZhbHVlIjoiQkQ3Wi9FTTFRS1VGVkJmTk91SUxJZz09IiwibWFjIjoiMGU4NDg1Y2I5NGYwNTcwNjU1MGU3NTMxYWY0NjBjNzZhYWVhMDQ5MTY2OGFlZDJiMzMxNjg3NWJlNWZmNTY2ZiJ9', 'Komang Dipta Raharja', '085800350850', 'Jalan Tukad Musi IV No. 20A', 'L', NULL, '', 1, '', '2021-08-15 03:41:00', '2021-08-15 03:42:00'),
('20210815-ANGGOTA027', 'henrycpt10@gmail.com', 'eyJpdiI6IlVpQTYyaGhXREZLOWpMOUlkZFlLSkE9PSIsInZhbHVlIjoiTFhiVkVIdGc1eW1lR0ZhMU5DUUJBUT09IiwibWFjIjoiOWQ1ODE4OWQ5YWYyOTI0MTc4MjYyOTVhOTNiZWNhOTk0NWQxMTU4MTg2MTdhMmQ5NGIzZjQ4ZmZlNjVjNjBlNCJ9', 'Henry Cipta Sanjaya', '085800420680', 'Jalan Tukad Petanu XV No. 16B', 'L', NULL, '', 1, '', '2021-08-15 03:44:00', '2021-08-15 03:44:00'),
('20210815-ANGGOTA028', 'dewijayanthi@gmail.com', 'eyJpdiI6ImpDQWMwOThiMkE0K09SaXh2SkVabUE9PSIsInZhbHVlIjoiWnZUSERJa2dyRHhrTEthNmgxVFI5Zz09IiwibWFjIjoiM2M3ZThkY2NkNDJiMGJlN2NmNGEzYTk2NTJkNjNiYmJjOTQ2YWY5NmRlNWEzYmM2NmFlMzdhOWQ2YThkNmYzMiJ9', 'Ni Putu Dewi Jayanthi', '083600340740', 'Jalan Tukad Balian XII No. 18A', 'P', NULL, '', 1, '', '2021-08-15 03:46:00', '2021-08-15 03:47:00'),
('20210815-ANGGOTA029', 'aryajaya35@gmail.com', 'eyJpdiI6ImJ4dEVnL2RXRVhoRmNyU0xPK2VOZ1E9PSIsInZhbHVlIjoiS1k0WmMzYXNDUG1SY25CRzY1V3pqQT09IiwibWFjIjoiMWQ3NTQwZjk0YmFmYjNhMGMyM2Q0YTRlNWNkOGQxOGFkNWRmOGYwYTliOTExN2RlOTFlNjg4ZmNhNzNhZmU1OCJ9', 'Gede Arya Jaya', '083600260790', 'Jalan Tukad Balian VII No. 17C', 'L', NULL, '', 1, '', '2021-08-15 03:49:00', '2021-08-15 03:50:00'),
('20210815-ANGGOTA030', 'megawdny20@gmail.com', 'eyJpdiI6InJmQlJadTZHb2lZUnNBcFRQVy9hZ2c9PSIsInZhbHVlIjoickxyMVUxQlF0THBKM3paOVBObmp2QT09IiwibWFjIjoiZTE3YTAzMWVhNzQ5NGI2NzE0YWQyZThkYTA4NGU2Y2UxOGU2YjM1ZGYzNDg3NDgyZThhOTI1NDlhOWIyOWE3MyJ9', 'Ketut Mega Widnyana', '083600890580', 'Jalan Tukad Badung V No. 18B', 'L', NULL, '', 1, '', '2021-08-15 03:54:00', '2021-08-15 03:55:00'),
('20210815-ANGGOTA031', 'fransiskus40@gmail.com', 'eyJpdiI6IkR0YmVheUdUTlpNNTc2bkgxd1BOT0E9PSIsInZhbHVlIjoia3VBY20rQ3A4czJRWWFnV2lkcGRuZz09IiwibWFjIjoiYmQ4MTdmZmEzNzdhYzZjNDUyMGM1MTBmZDU5MzRiMzRjM2YzNWUxOGRhODY4ZTFjN2U1YTU3MWI2MGZiNGQ1NCJ9', 'Fransiskus Hutabarat', '085600345675', 'Jalan Tukad Pakerisan VII No. 19A', 'L', NULL, '', 1, '', '2021-08-15 05:13:00', '2021-08-15 05:13:00'),
('20210815-ANGGOTA032', 'deviindrwr@gmail.com', 'eyJpdiI6ImxIMW5KUWNWOGpBV055d0hNaFUycVE9PSIsInZhbHVlIjoiVU9XNUpWZ21YKzBRY29hNXA3NUg4UT09IiwibWFjIjoiZTUyZjk0MTg3NmQzZWM1NmY4ZjY3NDczMGZhYjNiNDM4Njc0MWYxM2Q2MTczMWQ2OTFhNzYzYWMyM2MzMGVlMiJ9', 'Devi Indrawari', '089300620730', 'Jalan Tukad Pakerisan X No. 10', 'P', NULL, '', 1, '', '2021-08-15 05:15:00', '2021-08-15 05:15:00'),
('20210815-ANGGOTA033', 'haristwn66@gmail.com', 'eyJpdiI6Im9DdEdSdXFsQjh6azN2ektLNkJnUnc9PSIsInZhbHVlIjoibkZibkhYL05Ed3ZBV3plTlVRbmtlZz09IiwibWFjIjoiYjFlZGYzOGRjNTZkNzZiNjNiYmE0YmQ1NWVlYzVlYWNmNDBjNDBlMzQ0NmFhNmFlYzg2NWVjYWM2MmRiMjI0MiJ9', 'Komang Hari Setiawan', '089300755865', 'Jalan Tukad Pakerisan V No. 12', 'L', NULL, '', 1, '', '2021-08-15 05:16:00', '2021-08-15 05:16:00'),
('20210815-ANGGOTA034', 'juliartwn10@gmail.com', 'eyJpdiI6IklCT2VhYjFMeCtMd1hNR0lNVnpTS3c9PSIsInZhbHVlIjoia2FoL0JWMkVFTnZOV3psRHVoVzAydz09IiwibWFjIjoiMjBlOTRhMTk1MWEzMTUwZDA2OTEyNDFiMmZhMjc0ZGRjM2E2YTk0NmEzM2NmZDI0NTY3NTdlZmY4YzdmOWJiOCJ9', 'Nyoman Juli Artawan', '089300430950', 'Jalan Tukad Pakerisan XI No. 14A', 'L', NULL, '', 1, '', '2021-08-15 05:18:00', '2021-08-15 05:18:00'),
('20210815-ANGGOTA035', 'adinugraha5@gmail.com', 'eyJpdiI6InYrMDZTOVZpQmV5QysvNHRiWG5qNVE9PSIsInZhbHVlIjoiSTM0TDJ3VnJTUXFoVWdadmNMbDlWUT09IiwibWFjIjoiMzI4NDE5ZDhiNWJjNmMwYzJkMjg0NWRmZWQwMWVmMzE1ZWJkZGI5MTJkZWU5YWFjMmYzNzY1M2E2Zjc4MDk2ZSJ9', 'Nyoman Adi Nugraha', '089300560765', 'Jalan Tukad Pakerisan II No. 4B', 'L', NULL, '', 1, '', '2021-08-15 05:20:00', '2021-08-15 05:20:00'),
('20210815-ANGGOTA036', 'arigautama15@gmail.com', 'eyJpdiI6Im9EUVZ0d09ydE93d2VodGt3M0VNOFE9PSIsInZhbHVlIjoid01PYlp4RENSdWpkdHJKY3c2M3grUT09IiwibWFjIjoiNDE0MWJlYmM5YTMxNWY1YzhjMGM3OWFmY2VhZjkzMTMxODVlZGRkNzNhMWNlNjEyNDRlYjZhMGIwZmVkOWFjMyJ9', 'Gede Ari Gautama', '085600420530', 'Jalan Jayagiri XIII No. 20C', 'L', NULL, '', 1, '', '2021-08-15 05:22:00', '2021-08-15 05:22:00'),
('20210815-ANGGOTA037', 'edingrh30@gmail.com', 'eyJpdiI6Ik1qZVFPSThJd0ZFMjR6ODh2QmxXRnc9PSIsInZhbHVlIjoiN1B6SWhnVzl0R0FPSC8xV2ZncXhSUT09IiwibWFjIjoiNWMwNWI5YjhjOGE3YWJlMTIyMzUzNmY2MzE4YzJlOTI2YTA1ZWQyYmZmM2E5ODg5MmQxODE1OTQ1MTViMDQwMiJ9', 'Komang Edi Nugraha', '085700510210', 'Jalan Jayagiri XVI No. 10', 'L', NULL, '', 1, '', '2021-08-15 05:24:00', '2021-08-15 05:24:00'),
('20210815-ANGGOTA038', 'ktekaprwntr@gmail.com', 'eyJpdiI6IkVZMGNYUkIzZzJNL2w1akxVT2lsQ0E9PSIsInZhbHVlIjoiekdyYlpjbTRRcGhORXJGQ2s2LzRndz09IiwibWFjIjoiNzlmODVkYzI1YTZjMjRmNzg1YWRkMjBiOWUxZDI2YzYwMmU3OTVhNGQzMzVlMGY4NzkwNmMzNjQ0NjM3ZWJjNyJ9', 'Ketut Eka Purwantara', '089300750570', 'Jalan Tukad Pancoran II No. 28A', 'L', NULL, '', 1, '', '2021-08-15 05:26:00', '2021-08-15 05:26:00'),
('20210815-ANGGOTA039', 'denyerlng@gmail.com', 'eyJpdiI6ImhHNEJCRVh4OVFRQllkRGJZTE9QYVE9PSIsInZhbHVlIjoieHFxNkRyU21iYkVsU1NVWENnK0YyQT09IiwibWFjIjoiODFiMzYyNmY0YjEwNDgyODI4N2YxNjdlMGUxNThiNWMyNDBkMTc1MmNlNDhmN2VhMmJlMDEwY2ZjOGM5N2NlOCJ9', 'Ngurah Deny Erlangga', '089700560980', 'Jalan Tukad Musi XV No. 16B', 'L', NULL, '', 1, '', '2021-08-15 05:28:00', '2021-08-15 05:29:00'),
('20210815-ANGGOTA040', 'henyptr35@gmail.com', 'eyJpdiI6Ii96RjBtUnhkNEVzRXRxRzFyN1Ywa2c9PSIsInZhbHVlIjoiWmFnTUhDOGtoUmo1Y1lER2hFZ1gvdz09IiwibWFjIjoiZGE5ZTRiMzdhZTNiNWIwMmVkNzM0ZGY0NTFlZGFjODk0M2YyYjJmYzBiMzcwNWIyYzA5ZWVkMmU0ZDBiZGFlMiJ9', 'Heny Putri Wijaya', '089700565785', 'Jalan Tukad Musi II No. 15', 'P', NULL, '', 1, '', '2021-08-15 05:30:00', '2021-08-15 05:31:00'),
('20210815-ANGGOTA041', 'kdksaputra06@gmail.com', 'eyJpdiI6InZ2L3RGUHAwTDJZaFgzV3V5N2JtS0E9PSIsInZhbHVlIjoidVFuOUpxZVJ4MFIxOExOd2VYdTlsQT09IiwibWFjIjoiODg2ZTk1ZTcyNGZlNDg2ZDAwZmZiN2U4YWRmMmZlMDQyYzQ2MWNmYzZiMTMwYjkzMWU2ODM2ZmIxMDNmOGVmMyJ9', 'Kadek Saputra', '089700530540', 'Jalan Tukad Petanu VI No. 12C', 'L', NULL, '', 1, '', '2021-08-15 05:54:00', '2021-08-15 05:54:00'),
('20210815-ANGGOTA042', 'agungmartin33@gmail.com', 'eyJpdiI6InZDbDlJUUZTakVFOWVRVGNISUVJb1E9PSIsInZhbHVlIjoiNGxvd1dFTHhNaEtKbE4rcFZBNjAvQT09IiwibWFjIjoiZDQ5YjUxNjE3MzAyZjU2MzdkY2ZjYzFhMGM5MjE4MWQxMWQ3YTgzNTliZWI4YmIyNmVjMDJmMTdmMGUxOTBkNSJ9', 'Agung Martin Sanjaya', '085800320390', 'Jalan Waturenggong V No. 10', 'L', NULL, '', 1, '', '2021-08-15 05:57:00', '2021-08-15 05:57:00'),
('20210815-ANGGOTA043', 'krisnadwpyn@gmail.com', 'eyJpdiI6ImhRNnpMdEtwVHNJTUlaOVE0b2dXOGc9PSIsInZhbHVlIjoiVkhpRGNDMlVGaTI3akozOUVMSEdpdz09IiwibWFjIjoiYWFkMmUzY2FlODY0Njg0YmRiZjhlNDA5MjFiYTFlODBhMzEyMTQxYzEzM2I5MjlmYzgxMjc5MGFjOTUxZDJlYyJ9', 'Gede Krisna Dwipayana', '085800470630', 'Jalan Waturenggong X No. 15', 'L', NULL, '', 1, '', '2021-08-15 05:59:00', '2021-08-15 05:59:00'),
('20210815-ANGGOTA044', 'chandrakusuma22@gmail.com', 'eyJpdiI6IkVERXIyajVITXozZDdEcU1WQlhTYWc9PSIsInZhbHVlIjoiRW9QM2JBVXU0REJpcmZONGkwemdRQT09IiwibWFjIjoiNzBlZTAxZDAyNTkxMDdjYzUyNjkwOWFhZDQwMDQ3M2ZiN2YyOGI4YTJjNjFhOTA1ZjI5Y2U1NjE3ZTE2NTVjYiJ9', 'Ketut Chandra Kusumadewi', '085800720940', 'Jalan Waturenggong XI No. 2B', 'P', NULL, '', 1, '', '2021-08-15 06:00:00', '2021-08-15 06:01:00'),
('20210815-ANGGOTA045', 'kmgarydwntr@gmail.com', 'eyJpdiI6IjFKK2Qvc1ozQWFmMlQ0cHpJU0thMmc9PSIsInZhbHVlIjoiT0ZDZzk2SXV4dExiUDFyOTR6WjIyZz09IiwibWFjIjoiMzY0ZjJjNzQ0ZjdjYmI1MWI2NGE3NjMxMmI4MWMzODA4YWM0OGFiMjYzMjI4ZTU5YzNmMzAzNTUwNWQzMmM2NCJ9', 'Komang Ary Dewantara', '089500425635', 'Jalan Waturenggong II No. 12A', 'L', NULL, '', 1, '', '2021-08-15 06:02:00', '2021-08-15 06:03:00'),
('20210815-ANGGOTA046', 'daniwira40@gmail.com', 'eyJpdiI6Im5uRHlac2ViT3lQRDFHYTdpTHVjd2c9PSIsInZhbHVlIjoiT0NqK0ZlNldhV3dFU0ovWHFFSkVWUT09IiwibWFjIjoiNjA3OGQ5MTBmNDQ4NTg5YWI2ZDYzM2Q1MWEwZWFiODZkMTgxNzkxOTRjZmZkMmMzYTNkN2NjY2Y4NWI1ZDU1YiJ9', 'Dani Wiranugraha', '089500680970', 'Jalan Waturenggong VII No. 1B', 'L', NULL, '', 1, '', '2021-08-15 06:04:00', '2021-08-15 06:04:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_informasi`
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
-- Dumping data for table `tbl_informasi`
--

INSERT INTO `tbl_informasi` (`kodeinformasi`, `kodeadmin`, `judulinformasi`, `isiinformasi`, `statusinformasi`, `dateaddinformasi`, `dateupdinformasi`) VALUES
('20210510-INFORMASI001', 'ADMIN001', 'Pengumuman Jam Buka', '<p>untuk jam buka selanjutnya kami mulai buka dari jam 6 pagi sampai dengan jam 9 malam, dimohon pengertiannya.</p>', 1, '2021-05-10 08:17:00', '2021-06-09 11:08:00'),
('20210518-INFORMASI002', 'ADMIN001', 'Pendaftaran Bisa Dimulai Sejak Bulan Mei', '<p><span style=\"color: rgb(32, 33, 36); font-family: arial, sans-serif;\">Sudah disebutkan di muka, pengertian&nbsp;</span><b style=\"color: rgb(32, 33, 36); font-family: arial, sans-serif;\">lorem</b><span style=\"color: rgb(32, 33, 36); font-family: arial, sans-serif;\">&nbsp;ipsum adalah sebuah template/teks standar yang difungsikan untuk menempatkan elemen grafis atau untuk membingkai penempatan/penataan huruf (typesetting) di dalam sebuah layout grafis, artikel, dan bisa juga digunakan pada sebuah presentasi</span><br></p>', 1, '2021-05-18 09:01:00', '2021-06-12 01:36:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_konfirmasi`
--

CREATE TABLE `tbl_konfirmasi` (
  `kodekonfirmasi` varchar(25) NOT NULL,
  `kodeanggota` varchar(25) DEFAULT NULL,
  `norek` varchar(50) DEFAULT NULL,
  `bank` varchar(50) DEFAULT NULL,
  `an` varchar(50) DEFAULT NULL,
  `gambarbukti` varchar(100) DEFAULT NULL,
  `alasangagal` varchar(100) DEFAULT NULL,
  `statuskonfirmasi` int(11) DEFAULT NULL COMMENT '0 = pending, 1 =  valid, 2 =gagal',
  `keterangangagal` text DEFAULT NULL,
  `tanggalkonfirmasi` date DEFAULT NULL,
  `dateaddkonfirmasi` datetime DEFAULT NULL,
  `dateupdkonfirmasi` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_konfirmasi`
--

INSERT INTO `tbl_konfirmasi` (`kodekonfirmasi`, `kodeanggota`, `norek`, `bank`, `an`, `gambarbukti`, `alasangagal`, `statuskonfirmasi`, `keterangangagal`, `tanggalkonfirmasi`, `dateaddkonfirmasi`, `dateupdkonfirmasi`) VALUES
('20210518-KONFIRMASI001', '20210517-ANGGOTA004', '909090909', 'BCA', 'Chandra Dewi Puteri', 'pic_1621322927_buktisedatu.jpg', 'bukti pembayaran tidak sesuai', 1, NULL, '2021-05-18', '2021-05-18 07:28:00', '2021-05-18 08:42:00'),
('20210518-KONFIRMASI002', '20210517-ANGGOTA004', '909090909', 'BNI', 'Curly Da Lazy', 'pic_1621327481_buktisedatu.jpg', '', 1, NULL, '2021-05-18', '2021-05-18 08:44:00', '2021-05-18 08:44:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kunjungan`
--

CREATE TABLE `tbl_kunjungan` (
  `kodekunjungan` varchar(25) DEFAULT NULL,
  `kodeanggota` varchar(25) DEFAULT NULL,
  `kodeadmin` varchar(25) DEFAULT NULL,
  `waktudatang` datetime DEFAULT NULL,
  `waktupulang` datetime DEFAULT NULL,
  `dateaddkunjungan` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_kunjungan`
--

INSERT INTO `tbl_kunjungan` (`kodekunjungan`, `kodeanggota`, `kodeadmin`, `waktudatang`, `waktupulang`, `dateaddkunjungan`) VALUES
('20210609-KUNJUNGAN001', '20210609-ANGGOTA005', 'ADMIN003', '2021-06-09 10:55:17', NULL, '2021-06-09 10:55:00'),
('20210609-KUNJUNGAN002', '20210609-ANGGOTA005', 'ADMIN003', NULL, '2021-06-09 10:55:34', '2021-06-09 10:55:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`kodeadmin`) USING BTREE;

--
-- Indexes for table `tbl_alat_gym`
--
ALTER TABLE `tbl_alat_gym`
  ADD PRIMARY KEY (`kodealatgym`);

--
-- Indexes for table `tbl_anggota`
--
ALTER TABLE `tbl_anggota`
  ADD PRIMARY KEY (`kodeanggota`);

--
-- Indexes for table `tbl_informasi`
--
ALTER TABLE `tbl_informasi`
  ADD PRIMARY KEY (`kodeinformasi`);

--
-- Indexes for table `tbl_konfirmasi`
--
ALTER TABLE `tbl_konfirmasi`
  ADD PRIMARY KEY (`kodekonfirmasi`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
