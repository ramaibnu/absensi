-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2024 at 11:47 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kary`
--

-- --------------------------------------------------------

--
-- Table structure for table `keys`
--

CREATE TABLE `keys` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `key` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT 0,
  `is_private_key` tinyint(1) NOT NULL DEFAULT 0,
  `ip_addresses` text DEFAULT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `limits`
--

CREATE TABLE `limits` (
  `id` int(11) NOT NULL,
  `uri` varchar(255) NOT NULL,
  `count` int(10) NOT NULL,
  `hour_started` int(11) NOT NULL,
  `api_key` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `uri` varchar(255) NOT NULL,
  `method` varchar(6) NOT NULL,
  `params` text DEFAULT NULL,
  `api_key` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `time` int(11) NOT NULL,
  `rtime` float DEFAULT NULL,
  `authorized` varchar(1) NOT NULL,
  `response_code` smallint(3) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tb_agama`
--

CREATE TABLE `tb_agama` (
  `id_agama` int(11) NOT NULL,
  `agama` varchar(50) NOT NULL,
  `ket_agama` varchar(1000) NOT NULL,
  `stat_agama` char(1) NOT NULL DEFAULT 'T',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_agama`
--

INSERT INTO `tb_agama` (`id_agama`, `agama`, `ket_agama`, `stat_agama`, `tgl_buat`, `tgl_edit`, `id_user`) VALUES
(1, 'BUDDHA', '-', 'T', '2021-11-07 17:00:00', '1970-01-01 00:00:00', 1),
(2, 'HINDU', '-', 'T', '2021-11-07 17:00:00', '1970-01-01 00:00:00', 1),
(3, 'ISLAM', '-', 'T', '2021-11-07 17:00:00', '1970-01-01 00:00:00', 1),
(4, 'KATHOLIK', '-', 'T', '2021-11-07 17:00:00', '1970-01-01 00:00:00', 1),
(5, 'KHONGHUCU', '-', 'T', '2021-11-07 17:00:00', '1970-01-01 00:00:00', 1),
(6, 'KRISTEN', '-', 'T', '2021-11-07 17:00:00', '1970-01-01 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_alamat`
--

CREATE TABLE `tb_alamat` (
  `id_alamat` int(11) NOT NULL,
  `id_personal` int(11) NOT NULL,
  `alamat` varchar(200) NOT NULL DEFAULT '',
  `rt` char(5) NOT NULL DEFAULT '',
  `rw` char(5) NOT NULL DEFAULT '',
  `kel` char(32) NOT NULL DEFAULT '',
  `kec` char(16) NOT NULL DEFAULT '',
  `kab` char(8) NOT NULL DEFAULT '',
  `prov` char(4) NOT NULL DEFAULT '',
  `stat_alamat` char(1) NOT NULL DEFAULT 'T',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_alamat_ktp`
--

CREATE TABLE `tb_alamat_ktp` (
  `id_alamat_ktp` int(11) NOT NULL,
  `id_personal` int(11) NOT NULL,
  `alamat_ktp` varchar(100) NOT NULL DEFAULT '',
  `rt_ktp` char(5) NOT NULL DEFAULT '',
  `rw_ktp` char(5) NOT NULL DEFAULT '',
  `kel_ktp` varchar(12) NOT NULL DEFAULT '',
  `kec_ktp` varchar(9) NOT NULL DEFAULT '',
  `kab_ktp` varchar(6) NOT NULL DEFAULT '',
  `prov_ktp` varchar(3) NOT NULL DEFAULT '',
  `kode_pos_ktp` int(11) NOT NULL DEFAULT 0,
  `ket_alamat_ktp` varchar(50) NOT NULL DEFAULT '',
  `stat_alamat_ktp` char(1) NOT NULL DEFAULT '',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_alamat_ktp`
--

INSERT INTO `tb_alamat_ktp` (`id_alamat_ktp`, `id_personal`, `alamat_ktp`, `rt_ktp`, `rw_ktp`, `kel_ktp`, `kec_ktp`, `kab_ktp`, `prov_ktp`, `kode_pos_ktp`, `ket_alamat_ktp`, `stat_alamat_ktp`, `tgl_buat`, `tgl_edit`, `id_user`) VALUES
(1, 1, 'JL. GERILYA NO. 45', '046', '000', '6472061003', '6472061', '6472', '64', 0, '', 'T', '2024-05-12 22:01:26', '2024-05-12 22:01:26', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_alasan_nonaktif`
--

CREATE TABLE `tb_alasan_nonaktif` (
  `id_alasan_nonaktif` int(11) NOT NULL,
  `alasan_nonaktif` varchar(200) NOT NULL DEFAULT '',
  `ket_alasan_nonaktif` varchar(1000) NOT NULL DEFAULT '',
  `stat_alasan_nonaktif` char(1) NOT NULL DEFAULT 'T',
  `stat_upload_berkas` char(1) NOT NULL DEFAULT 'T',
  `stat_blacklist` char(1) NOT NULL DEFAULT 'F',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_alasan_nonaktif`
--

INSERT INTO `tb_alasan_nonaktif` (`id_alasan_nonaktif`, `alasan_nonaktif`, `ket_alasan_nonaktif`, `stat_alasan_nonaktif`, `stat_upload_berkas`, `stat_blacklist`, `tgl_buat`, `tgl_edit`, `id_user`) VALUES
(1, 'RESIGN', '', 'T', 'T', 'F', '2023-08-01 09:00:00', '2023-08-01 09:00:00', 1),
(2, 'RESIGN TANPA IZIN', '', 'T', 'F', 'F', '2023-08-01 09:00:00', '2023-08-01 09:00:00', 1),
(3, 'SAKIT BERKEPANJANGAN', '', 'T', 'T', 'F', '2023-08-01 09:00:00', '2023-08-01 09:00:00', 1),
(4, 'PENSIUN/PENSIUN DINI', '', 'T', 'T', 'F', '2023-08-01 09:00:00', '2023-08-01 09:00:00', 1),
(5, 'KESALAHAN BERAT', '', 'T', 'T', 'T', '2023-08-01 09:00:00', '2023-08-01 09:00:00', 1),
(6, 'MUTASI', '', 'T', 'T', 'F', '2023-08-01 09:00:00', '2023-08-01 09:00:00', 1),
(7, 'SELESAI KONTRAK', '', 'T', 'F', 'F', '2023-11-02 14:04:00', '2023-11-02 14:04:00', 1),
(8, 'MENINGGAL DUNIA', '', 'T', 'T', 'F', '2024-01-12 14:06:44', '2024-01-12 14:06:44', 59),
(9, 'PEMUTUSAN HUBUNGAN KERJA (PHK)', '', 'T', 'T', 'T', '2024-01-12 14:06:45', '2024-01-12 14:06:45', 59),
(10, 'TIDAK LULUS PROBATION', '', 'T', 'T', 'F', '2024-02-10 08:49:52', '2024-02-10 08:49:52', 59);

-- --------------------------------------------------------

--
-- Table structure for table `tb_apikey`
--

CREATE TABLE `tb_apikey` (
  `auth_apikey` varchar(100) NOT NULL DEFAULT '',
  `stat_apikey` char(1) NOT NULL DEFAULT 'T',
  `apikey` varchar(250) NOT NULL,
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_att`
--

CREATE TABLE `tb_att` (
  `id_att` int(11) NOT NULL,
  `id_finger` varchar(10) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_att`
--

INSERT INTO `tb_att` (`id_att`, `id_finger`, `type`, `datetime`) VALUES
(1, '51021149', 1, '2024-05-12 11:43:44'),
(2, '505242173', 1, '2024-05-12 11:49:35'),
(3, '51021149', 1, '2024-05-16 06:26:33'),
(5, '505242173', 1, '2024-05-12 11:49:35');

-- --------------------------------------------------------

--
-- Table structure for table `tb_audit`
--

CREATE TABLE `tb_audit` (
  `id_audit` int(11) NOT NULL,
  `id_user` int(11) NOT NULL DEFAULT 0,
  `jenis_proses` varchar(50) NOT NULL DEFAULT '',
  `data_proses` varchar(200) NOT NULL DEFAULT '',
  `nama_data` varchar(500) NOT NULL DEFAULT '',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_bank`
--

CREATE TABLE `tb_bank` (
  `id_bank` int(11) NOT NULL,
  `bank` varchar(50) NOT NULL DEFAULT '',
  `ket_bank` varchar(1000) NOT NULL,
  `stat_bank` char(1) NOT NULL DEFAULT 'T',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_bank`
--

INSERT INTO `tb_bank` (`id_bank`, `bank`, `ket_bank`, `stat_bank`, `tgl_buat`, `tgl_edit`, `id_user`) VALUES
(1, '-', '', 'T', '2023-04-15 22:56:14', '2023-04-15 22:56:14', 1),
(2, 'BRI UNIT KAUBUN', '', 'T', '2023-04-15 22:56:14', '2023-04-15 22:56:14', 1),
(3, 'MANDIRI', '', 'T', '2023-04-15 22:56:14', '2023-04-15 22:56:14', 1),
(4, 'BRI UNIT LAMASI', '', 'T', '2023-04-15 22:56:14', '2023-04-15 22:56:14', 1),
(5, 'BRI LOA JANAN', '', 'T', '2023-04-15 22:56:14', '2023-04-15 22:56:14', 1),
(6, 'BNI UGM YOGYA', '', 'T', '2023-04-15 22:56:14', '2023-04-15 22:56:14', 1),
(7, 'BCA KCP AHMAD YANI', '', 'T', '2023-04-15 22:56:14', '2023-04-15 22:56:14', 1),
(8, 'MANDIRI KCP SANGATTA', '', 'T', '2023-04-15 22:56:14', '2023-04-15 22:56:14', 1),
(9, 'BCA KCP KETAPANG', '', 'T', '2023-04-15 22:56:14', '2023-04-15 22:56:14', 1),
(10, 'BNI BONTANG', '', 'T', '2023-04-15 22:56:14', '2023-04-15 22:56:14', 1),
(11, 'BRI SIMPEDES', '', 'T', '2023-04-15 22:56:14', '2023-04-15 22:56:14', 1),
(12, 'Bank BPD DIY', '', 'T', '2023-04-15 22:56:14', '2023-04-15 22:56:14', 1),
(13, 'BRI', '', 'T', '2023-04-15 22:56:14', '2023-04-15 22:56:14', 1),
(14, 'BCA', '', 'T', '2023-04-15 22:56:14', '2023-04-15 22:56:14', 1),
(15, 'BCA SAMARINDA', '', 'T', '2023-04-15 22:56:14', '2023-04-15 22:56:14', 1),
(16, 'BRI KAUBUN', '', 'T', '2023-04-15 22:56:14', '2023-04-15 22:56:14', 1),
(17, 'CIMB NIAGA', '', 'T', '2023-04-15 22:56:14', '2023-04-15 22:56:14', 1),
(18, 'BCA CIANJUR', '', 'T', '2023-04-15 22:56:14', '2023-04-15 22:56:14', 1),
(19, 'BNI', '', 'T', '2023-04-15 22:56:14', '2023-04-15 22:56:14', 1),
(20, 'BRI KCP RAPAK', '', 'T', '2023-04-15 22:56:14', '2023-04-15 22:56:14', 1),
(21, 'BRI UNIT SP2 SEBULU', '', 'T', '2023-04-15 22:56:14', '2023-04-15 22:56:14', 1),
(22, 'BRI UNIT PASAR KEMAKMURAN KOTABARU', '', 'T', '2023-04-15 22:56:14', '2023-04-15 22:56:14', 1),
(23, 'Bri Britama', '', 'T', '2023-04-15 22:56:14', '2023-04-15 22:56:14', 1),
(24, 'Britama', '', 'T', '2023-04-15 22:56:14', '2023-04-15 22:56:14', 1),
(25, 'Bank Ganesha', '', 'T', '2023-04-15 22:56:14', '2023-04-15 22:56:14', 1),
(26, 'Bank BNI', '', 'T', '2023-04-15 22:56:14', '2023-04-15 22:56:14', 1),
(27, 'Bank BRI', '', 'T', '2023-04-15 22:56:14', '2023-04-15 22:56:14', 1),
(28, 'Bank BCA', '', 'T', '2023-04-15 22:56:14', '2023-04-15 22:56:14', 1),
(29, 'Bank Mandiri', '', 'T', '2023-04-15 22:56:14', '2023-04-15 22:56:14', 1),
(30, 'Bank Kaltimtara', '', 'T', '2023-04-15 22:56:14', '2023-04-15 22:56:14', 1),
(31, 'Payrol Jakarta', '', 'T', '2023-04-15 22:56:14', '2023-04-15 22:56:14', 1),
(32, 'Bank Simas Gold', '', 'T', '2023-04-15 22:56:14', '2023-04-15 22:56:14', 1),
(33, 'Bank Sinarmas', '', 'T', '2023-04-15 22:56:14', '2023-04-15 22:56:14', 1),
(34, 'Bank BRI ', '', 'T', '2023-04-15 22:56:14', '2023-04-15 22:56:14', 1),
(35, 'Bank BNI 1946', '', 'T', '2023-04-15 22:56:14', '2023-04-15 22:56:14', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_bank_kary`
--

CREATE TABLE `tb_bank_kary` (
  `id_bank_kary` int(11) NOT NULL,
  `id_personal` int(11) NOT NULL DEFAULT 0,
  `id_bank` int(11) NOT NULL DEFAULT 0,
  `no_rek` varchar(150) NOT NULL DEFAULT '',
  `nama_pemilik` varchar(250) NOT NULL DEFAULT '',
  `stat_bank_kary` char(1) NOT NULL DEFAULT 'T',
  `ket_bank_kary` varchar(1000) DEFAULT NULL,
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_bank_kary`
--

INSERT INTO `tb_bank_kary` (`id_bank_kary`, `id_personal`, `id_bank`, `no_rek`, `nama_pemilik`, `stat_bank_kary`, `ket_bank_kary`, `tgl_buat`, `tgl_edit`, `id_user`) VALUES
(1, 1, 15, '07834534555', 'IHFAN NOIFARA', 'T', '', '2024-05-12 22:04:10', '2024-05-12 22:04:10', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_depart`
--

CREATE TABLE `tb_depart` (
  `id_depart` int(11) NOT NULL,
  `kd_depart` char(8) NOT NULL DEFAULT '',
  `depart` varchar(100) NOT NULL,
  `ket_depart` varchar(300) NOT NULL,
  `stat_depart` char(1) NOT NULL DEFAULT 'T',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0,
  `id_perusahaan` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_depart`
--

INSERT INTO `tb_depart` (`id_depart`, `kd_depart`, `depart`, `ket_depart`, `stat_depart`, `tgl_buat`, `tgl_edit`, `id_user`, `id_perusahaan`) VALUES
(4, 'SI', 'SISTEM INTEGRASI', '', 'T', '2024-05-12 21:55:48', '2024-05-12 21:55:48', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_doc_pengesahan_pjo`
--

CREATE TABLE `tb_doc_pengesahan_pjo` (
  `id_doc_pengesahaan_pjo` int(11) NOT NULL,
  `id_pjo` int(11) NOT NULL DEFAULT 0,
  `no_doc_pengesahaan_pjo` varchar(100) NOT NULL DEFAULT '',
  `url_doc_pengesahaan_pjo` varchar(200) NOT NULL DEFAULT '',
  `tgl_aktif` date NOT NULL DEFAULT '1970-01-01',
  `tgl_akhir` date NOT NULL DEFAULT '1970-01-01',
  `alasan_nonaktif` varchar(1000) NOT NULL,
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_ec`
--

CREATE TABLE `tb_ec` (
  `id_ec` int(11) NOT NULL,
  `id_personal` int(11) NOT NULL DEFAULT 0,
  `nama_ec` varchar(100) NOT NULL DEFAULT '',
  `hp_ec` varchar(20) NOT NULL DEFAULT '0',
  `hp_ec_2` varchar(20) NOT NULL DEFAULT '0',
  `relasi_ec` varchar(100) NOT NULL DEFAULT '',
  `ket_ec` varchar(1000) NOT NULL DEFAULT '',
  `stat_ec` char(1) NOT NULL DEFAULT 'T',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_ec`
--

INSERT INTO `tb_ec` (`id_ec`, `id_personal`, `nama_ec`, `hp_ec`, `hp_ec_2`, `relasi_ec`, `ket_ec`, `stat_ec`, `tgl_buat`, `tgl_edit`, `id_user`) VALUES
(392, 1, 'WAHYUNI', '082155553600', '0', 'ISTRI', '', 'T', '2024-05-12 22:04:10', '2024-05-12 22:04:10', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_error`
--

CREATE TABLE `tb_error` (
  `id_error` int(11) NOT NULL,
  `email_error` varchar(200) NOT NULL DEFAULT '',
  `ip_error` varchar(200) NOT NULL DEFAULT '',
  `ip_akses` varchar(200) NOT NULL DEFAULT '',
  `msg_error` varchar(500) NOT NULL DEFAULT '',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_error`
--

INSERT INTO `tb_error` (`id_error`, `email_error`, `ip_error`, `ip_akses`, `msg_error`, `tgl_buat`) VALUES
(1, 'syarif.mamardi@ungguldinamika.co.id', '10.81.200.2', '10.81.200.2', 'Sandi anda salah, kesempatan tinggal 4x', '2024-05-12 23:23:16'),
(2, 'ihfan.noifara@ungguldinamika.co.id', '10.81.200.2', '10.81.200.2', 'Sandi anda salah, kesempatan tinggal 4x', '2024-05-17 16:18:31'),
(3, 'kadek.ferliyawan@ungguldinamika.co.id', '10.81.200.2', '10.81.200.2', 'Mencoba akses aplikasi yang tidak diizinkan | TEMP', '2024-05-17 16:20:38'),
(4, 'kadek.ferliyawan@ungguldinamika.co.id', '192.168.158.72', '192.168.158.72', 'Kode Captcha Salah', '2024-05-17 16:47:53'),
(5, 'kadek.ferliyawan@ungguldinamika.co.id', '192.168.158.72', '192.168.158.72', 'Kode Captcha Salah', '2024-05-17 16:48:12'),
(6, 'kadek.ferliyawan@ungguldinamika.co.id', '192.168.158.72', '192.168.158.72', 'Kode Captcha Salah', '2024-05-17 16:48:24'),
(7, 'm.fahrizal@ungguldinamika.co.id', '192.168.158.74', '192.168.158.74', 'User tidak aktif', '2024-05-17 16:55:12'),
(8, 'm.fahrizal@ungguldinamika.co.id', '192.168.158.74', '192.168.158.74', 'User tidak aktif', '2024-05-17 16:55:35'),
(9, 'm.fahrizal@ungguldinamika.co.id', '192.168.158.74', '192.168.158.74', 'Kode Captcha Salah', '2024-05-17 16:55:52'),
(10, 'm.fahrizal@ungguldinamika.co.id', '192.168.158.74', '192.168.158.74', 'User tidak aktif', '2024-05-17 16:56:05'),
(11, 'm.fahrizal@ungguldinamika.co.id', '192.168.158.74', '192.168.158.74', 'User tidak aktif', '2024-05-17 16:56:40'),
(12, 'ihfan.noifara@ungguldinamika.co.id', '192.168.120.16', '192.168.120.16', 'Kode Captcha Salah', '2024-05-19 10:53:52');

-- --------------------------------------------------------

--
-- Table structure for table `tb_filependukung`
--

CREATE TABLE `tb_filependukung` (
  `id_file_pendukung` int(11) NOT NULL,
  `id_personal` int(11) NOT NULL,
  `nama_file` varchar(500) NOT NULL DEFAULT '',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_grade`
--

CREATE TABLE `tb_grade` (
  `id_grade` int(11) NOT NULL,
  `grade` int(11) NOT NULL DEFAULT 0,
  `id_level` int(11) NOT NULL DEFAULT 0,
  `ket_grade` varchar(2000) NOT NULL,
  `stat_grade` varchar(20) NOT NULL,
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0,
  `id_perusahaan` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_grade`
--

INSERT INTO `tb_grade` (`id_grade`, `grade`, `id_level`, `ket_grade`, `stat_grade`, `tgl_buat`, `tgl_edit`, `id_user`, `id_perusahaan`) VALUES
(20, 6, 1, '', 'T', '2024-05-12 21:57:06', '2024-05-12 21:57:06', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_ip_blacklist`
--

CREATE TABLE `tb_ip_blacklist` (
  `id_ip_blacklist` int(11) NOT NULL,
  `ip_address` varchar(100) NOT NULL DEFAULT '',
  `back_log` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `email_user` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_izin_perusahaan`
--

CREATE TABLE `tb_izin_perusahaan` (
  `id_izin_perusahaan` int(11) NOT NULL,
  `id_m_perusahaan` int(11) NOT NULL DEFAULT 0,
  `no_izin_perusahaan` varchar(100) NOT NULL DEFAULT '',
  `tgl_mulai_izin` date NOT NULL DEFAULT '1970-01-01',
  `tgl_akhir_izin` date NOT NULL DEFAULT '1970-01-01',
  `url_izin_perusahaan` varchar(500) NOT NULL,
  `ket_izin_perusahaan` varchar(1000) NOT NULL,
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_izin_tambang`
--

CREATE TABLE `tb_izin_tambang` (
  `id_izin_tambang` int(11) NOT NULL,
  `id_kary` int(11) NOT NULL DEFAULT 0,
  `id_jenis_izin_tambang` int(11) NOT NULL DEFAULT 0,
  `no_reg` varchar(50) NOT NULL,
  `tgl_expired` date NOT NULL DEFAULT '1970-01-01',
  `id_sim_kary` int(11) NOT NULL DEFAULT 0,
  `url_izin_tambang` varchar(1000) NOT NULL,
  `ket_izin_tambang` varchar(1000) NOT NULL,
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tb_izin_tambang_area`
--

CREATE TABLE `tb_izin_tambang_area` (
  `id_area` int(11) NOT NULL,
  `area` varchar(250) NOT NULL DEFAULT '',
  `stat_area` char(1) NOT NULL DEFAULT 'T',
  `ket_area` varchar(2000) NOT NULL DEFAULT '',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_izin_tambang_area`
--

INSERT INTO `tb_izin_tambang_area` (`id_area`, `area`, `stat_area`, `ket_area`, `tgl_buat`, `tgl_edit`, `id_user`) VALUES
(1, 'UMUM', 'T', '', '2023-10-27 09:08:00', '2023-10-27 09:08:00', 1),
(2, 'PIT AREA', 'T', '', '2023-10-27 09:08:00', '2023-10-27 09:08:00', 1),
(3, 'PORT', 'T', '', '2023-10-27 09:08:00', '2023-10-27 09:08:00', 1),
(4, 'CPP 33', 'T', '', '2023-10-27 09:08:00', '2023-10-27 09:08:00', 1),
(5, 'GUDANG HANDAK', 'T', '', '2023-10-27 09:08:00', '2023-10-27 09:08:00', 1),
(6, 'QUARRY', 'T', '', '2023-10-27 09:08:00', '2023-10-27 09:08:00', 1),
(7, 'AREA PELEDAKAN', 'T', '', '2023-10-27 09:08:00', '2023-10-27 09:08:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_izin_tambang_detail_area`
--

CREATE TABLE `tb_izin_tambang_detail_area` (
  `id_izin_tambang_detail_area` int(11) NOT NULL,
  `id_izin_tambang` int(11) NOT NULL DEFAULT 0,
  `id_area` int(11) NOT NULL DEFAULT 0,
  `stat_izin_tambang_area` char(1) NOT NULL DEFAULT 'T',
  `ket_izin_tambang_area` varchar(2000) NOT NULL DEFAULT '',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_izin_tambang_unit`
--

CREATE TABLE `tb_izin_tambang_unit` (
  `id_izin_tambang_unit` int(11) NOT NULL,
  `id_izin_tambang` int(11) NOT NULL DEFAULT 0,
  `id_unit` int(11) NOT NULL DEFAULT 0,
  `id_tipe_akses_unit` int(11) NOT NULL DEFAULT 0,
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_jenis_izin_tambang`
--

CREATE TABLE `tb_jenis_izin_tambang` (
  `id_jenis_izin_tambang` int(11) NOT NULL,
  `kode_jenis_izin_tambang` char(8) NOT NULL DEFAULT '',
  `jenis_izin_tambang` varchar(100) NOT NULL DEFAULT '',
  `ket_jenis_izin_tambang` varchar(2500) NOT NULL DEFAULT '',
  `stat_jenis_izin_tambang` char(1) NOT NULL DEFAULT 'T',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0,
  `id_perusahaan` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_jenis_izin_tambang`
--

INSERT INTO `tb_jenis_izin_tambang` (`id_jenis_izin_tambang`, `kode_jenis_izin_tambang`, `jenis_izin_tambang`, `ket_jenis_izin_tambang`, `stat_jenis_izin_tambang`, `tgl_buat`, `tgl_edit`, `id_user`, `id_perusahaan`) VALUES
(1, 'MP', 'MINE PERMIT', '', 'T', '1970-01-01 00:00:00', '1970-01-01 00:00:00', 1, 0),
(2, 'SP', 'SIMPER', '', 'T', '1970-01-01 00:00:00', '1970-01-01 00:00:00', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_jenis_perusahaan`
--

CREATE TABLE `tb_jenis_perusahaan` (
  `id_jenis_perusahaan` int(11) NOT NULL,
  `jenis_perusahaan` varchar(100) NOT NULL,
  `no_jenis_perusahaan` char(10) NOT NULL,
  `ket_jenis_perusahaan` varchar(1000) NOT NULL,
  `stat_jenis_perusahaan` char(1) NOT NULL DEFAULT 'T',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_jenis_perusahaan`
--

INSERT INTO `tb_jenis_perusahaan` (`id_jenis_perusahaan`, `jenis_perusahaan`, `no_jenis_perusahaan`, `ket_jenis_perusahaan`, `stat_jenis_perusahaan`, `tgl_buat`, `tgl_edit`, `id_user`) VALUES
(1, 'OWNER', '1', '', 'T', '2023-04-18 00:00:00', '2023-04-18 00:00:00', 1),
(2, 'CONTRACTOR', '2', '', 'T', '1970-01-01 00:00:00', '1970-01-01 00:00:00', 1),
(3, 'SUBCONTRACTOR', '3', '', 'T', '1970-01-01 00:00:00', '1970-01-01 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_jenis_sertifikasi`
--

CREATE TABLE `tb_jenis_sertifikasi` (
  `id_jenis_sertifikasi` int(11) NOT NULL,
  `kode_jenis_sertifikasi` varchar(15) NOT NULL,
  `jenis_sertifikasi` varchar(225) NOT NULL,
  `beranda` char(1) NOT NULL,
  `ket_jenis_sertifikasi` varchar(50) NOT NULL,
  `stat_jenis_sertifikasi` char(1) NOT NULL DEFAULT 'T',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_jenis_sertifikasi`
--

INSERT INTO `tb_jenis_sertifikasi` (`id_jenis_sertifikasi`, `kode_jenis_sertifikasi`, `jenis_sertifikasi`, `beranda`, `ket_jenis_sertifikasi`, `stat_jenis_sertifikasi`, `tgl_buat`, `tgl_edit`, `id_user`) VALUES
(1, 'POP', 'PENGAWAS OPERASIONAL PERTAMA', 'T', '-', 'T', '1970-01-01 00:00:00', '1970-01-01 00:00:00', 1),
(2, 'POM', 'PENGAWAS OPERASIONAL MADYA', 'T', '-', 'T', '1970-01-01 00:00:00', '1970-01-01 00:00:00', 1),
(3, 'POU', 'PENGAWAS OPERASIONAL UTAMA', 'T', '-', 'T', '1970-01-01 00:00:00', '1970-01-01 00:00:00', 1),
(6, 'P3KTK', 'PETUGAS P3K DI TEMPAT KERJA', 'F', '', 'T', '2023-09-07 08:00:00', '2023-09-07 08:00:00', 1),
(7, 'AK3U', 'AHLI K3 UMUM', 'F', '', 'T', '2023-09-07 08:00:00', '2023-09-07 08:00:00', 1),
(8, 'PPCUB', 'PETUGAS PENGUJI CONTOH UJI BATUBARA', 'F', '', 'T', '2023-09-07 08:00:00', '2023-09-07 08:00:00', 1),
(9, 'PVTB', 'PETUGAS VERIFIKASI TEKNIS BATUBARA', 'F', '', 'T', '2023-09-07 08:00:00', '2023-09-07 08:00:00', 1),
(10, 'PMCUB', 'PETUGAS PENGAMBIL CONTOH UJI BATUBARA', 'F', '-', 'T', '2023-10-09 17:29:00', '2023-10-09 17:29:00', 1),
(11, 'AD', 'ACQUIRE & DATABASE', 'F', '-', 'T', '2023-12-02 10:53:05', '2023-12-02 10:53:05', 59),
(12, 'AM', 'ADVACE MINESCAPE 7 / 2021', 'F', '-', 'T', '2023-12-02 10:53:33', '2023-12-02 10:53:33', 59),
(13, 'AEFBDA', 'ADVANCE EXCEL FOR BUSINESS AND DATA ANALYSIS', 'F', '-', 'T', '2023-12-02 10:53:33', '2023-12-02 10:53:33', 59),
(14, 'AK', 'AHLI KEPELABUHANAN', 'F', '-', 'T', '2023-12-02 10:53:33', '2023-12-02 10:53:33', 59),
(15, 'AKL', 'AK3 LISTRIK ', 'F', '-', 'T', '2023-12-02 10:53:33', '2023-12-02 10:53:33', 59),
(16, 'AKOG', 'AK3 OPERATOR GENSET', 'F', '-', 'T', '2023-12-02 10:53:33', '2023-12-02 10:53:33', 59),
(17, 'AB', 'ALIGNMENT & BALANCING', 'F', '-', 'T', '2023-12-02 10:53:33', '2023-12-02 10:53:33', 59),
(18, 'APB', 'ANALISIS DAN PENGUJIAN BATUBARA', 'F', '-', 'T', '2023-12-02 10:53:33', '2023-12-02 10:53:33', 59),
(19, 'AP', 'ANALISIS PROKSIMAT (BNSP)', 'F', '-', 'T', '2023-12-02 10:53:33', '2023-12-02 10:53:33', 59),
(20, 'AIISO', 'AUDIT INTERNAL ISO 45001:2018', 'F', '-', 'T', '2023-12-02 10:53:33', '2023-12-02 10:53:33', 59),
(21, 'ASML', 'AUDITOR SML, ISO 14000', 'F', '-', 'T', '2023-12-02 10:53:33', '2023-12-02 10:53:33', 59),
(22, 'BLM', 'BERTHING AND LOADING MASTER', 'F', '-', 'T', '2023-12-02 10:53:41', '2023-12-02 10:53:41', 59),
(23, 'CEMTC', 'CARA EFEKTIF MENGELOLA TRAINING CENTER', 'F', '-', 'T', '2023-12-02 10:53:41', '2023-12-02 10:53:41', 59),
(24, 'CCM', 'COACHING, COUNSELING & MENTORING', 'F', '-', 'T', '2023-12-02 10:53:41', '2023-12-02 10:53:41', 59),
(25, 'CSK', 'COMMUNICATION SKILL', 'F', '-', 'T', '2023-12-02 10:53:41', '2023-12-02 10:53:41', 59),
(26, 'CB', 'COMPENSATION AND BENEFIT', 'F', '-', 'T', '2023-12-02 10:53:41', '2023-12-02 10:53:41', 59),
(27, 'CBRS', 'COMPETENCY BASED RECRUITMENT & SELECTION', 'F', '-', 'T', '2023-12-02 10:53:41', '2023-12-02 10:53:41', 59),
(28, 'CS', 'CONFINED SPACE', 'F', '-', 'T', '2023-12-02 10:53:41', '2023-12-02 10:53:41', 59),
(29, 'DMPS', 'DECISION MAKING & PROBLEM SOLVING', 'F', '-', 'T', '2023-12-02 10:53:41', '2023-12-02 10:53:41', 59),
(30, 'DP', 'DESAIN PRESENTASI', 'F', '-', 'T', '2023-12-02 10:53:41', '2023-12-02 10:53:41', 59),
(31, 'DJUT', 'DIKLAT & UJI KOMPETENSI JURU UKUR TAMBANG', 'F', '-', 'T', '2023-12-02 10:53:41', '2023-12-02 10:53:41', 59),
(32, 'GTP', 'DIKLAT GEOLOGI TEKNIK PERTAMBANGAN', 'F', '-', 'T', '2023-12-02 10:53:46', '2023-12-02 10:53:46', 59),
(33, 'HP', 'DIKLAT HIDROLOGI PERTAMBANGAN', 'F', '-', 'T', '2023-12-02 10:53:46', '2023-12-02 10:53:46', 59),
(34, 'IKT', 'DIKLAT INVESTIGASI KECELAKAAN TAMBANG', 'F', '-', 'T', '2023-12-02 10:53:46', '2023-12-02 10:53:46', 59),
(35, 'PP', 'DIKLAT PENGELOLA PELEDAKAN (KJL 1)', 'F', '-', 'T', '2023-12-02 10:53:46', '2023-12-02 10:53:46', 59),
(36, 'DC', 'DOCUMENT CONTROL', 'F', '-', 'T', '2023-12-02 10:53:46', '2023-12-02 10:53:46', 59),
(37, 'DHSAFCRE', 'DRILL HOLES SPACING ANALYSIS FOR COAL RESOURCES EVALUATION', 'F', '-', 'T', '2023-12-02 10:53:46', '2023-12-02 10:53:46', 59),
(38, 'DRP', 'DRONE PEMETAAN', 'F', '-', 'T', '2023-12-02 10:53:46', '2023-12-02 10:53:46', 59),
(39, 'ETHIT', 'EFECTIVE TRAINING & HIGH IMPACT TRAINING', 'F', '-', 'T', '2023-12-02 10:53:46', '2023-12-02 10:53:46', 59),
(40, 'ECS', 'EFFECTIVE COMMUNICATION SKILL', 'F', '-', 'T', '2023-12-02 10:53:46', '2023-12-02 10:53:46', 59),
(41, 'ERT', 'ERT-BANTUAN HIDUP DASAR', 'F', '-', 'T', '2023-12-02 10:53:46', '2023-12-02 10:53:46', 59),
(42, 'EPSDB', 'ESTIMASI PELAPORAN SUMBER DAYA BATUBARA', 'F', '-', 'T', '2023-12-02 10:53:51', '2023-12-02 10:53:51', 59),
(43, 'EDW', 'EXPLORATION DATA WAREHOUSE (EDW) MINERBA', 'F', '-', 'T', '2023-12-02 10:53:51', '2023-12-02 10:53:51', 59),
(44, 'GM', 'GADA MADYA', 'F', '-', 'T', '2023-12-02 10:53:51', '2023-12-02 10:53:51', 59),
(45, 'GP', 'GADA PRATAMA', 'F', '-', 'T', '2023-12-02 10:53:51', '2023-12-02 10:53:51', 59),
(46, 'GU', 'GADA UTAMA', 'F', '-', 'T', '2023-12-02 10:53:51', '2023-12-02 10:53:51', 59),
(47, 'GEB', 'GEOLOGI & EKEPLORASI BATUBARA', 'F', '-', 'T', '2023-12-02 10:53:51', '2023-12-02 10:53:51', 59),
(48, 'GEOS', 'GEOSTATISTIK', 'F', '-', 'T', '2023-12-02 10:53:51', '2023-12-02 10:53:51', 59),
(49, 'GLP', 'GOOD LABORATORY PRACTICE', 'F', '-', 'T', '2023-12-02 10:53:51', '2023-12-02 10:53:51', 59),
(50, 'HIPN', 'HUBUNGAN INDUSTRIAL DAN PERSELISIHAN DAN NEGOSIASI', 'F', '-', 'T', '2023-12-02 10:53:51', '2023-12-02 10:53:51', 59),
(51, 'IISO', 'IMPLEMENTASI ISO 45001:2018', 'F', '-', 'T', '2023-12-02 10:53:51', '2023-12-02 10:53:51', 59),
(52, 'IK3L', 'IMPLEMENTASI K3 DI LABORATORIUM', 'F', '-', 'T', '2023-12-02 10:53:57', '2023-12-02 10:53:57', 59),
(53, 'ISMKP', 'IMPLEMENTASI SMKP MINERBA', 'F', '-', 'T', '2023-12-02 10:53:57', '2023-12-02 10:53:57', 59),
(54, 'ISMRISO', 'IMPLEMENTASI STANDARD MANAGEMENT RESIKO ISO 31000:2009', 'F', '-', 'T', '2023-12-02 10:53:57', '2023-12-02 10:53:57', 59),
(55, 'IPPMK', 'IMPLEMENTASI PROGRAM PPM MASA KINI', 'F', '-', 'T', '2023-12-02 10:53:57', '2023-12-02 10:53:57', 59),
(56, 'IAISO', 'INTERNAL AUDIT ISO/IEC 17025:2017', 'F', '-', 'T', '2023-12-02 10:53:57', '2023-12-02 10:53:57', 59),
(57, 'IAISPS', 'INTERNAL AUDITOR ISPS', 'F', '-', 'T', '2023-12-02 10:53:57', '2023-12-02 10:53:57', 59),
(58, 'JLK', 'JURU LEDAK KELAS II', 'F', '-', 'T', '2023-12-02 10:53:57', '2023-12-02 10:53:57', 59),
(59, 'JUT', 'JURU UKUR TAMBANG', 'F', '-', 'T', '2023-12-02 10:53:57', '2023-12-02 10:53:57', 59),
(60, 'K3M', 'K3 MECHANIC', 'F', '-', 'T', '2023-12-02 10:53:57', '2023-12-02 10:53:57', 59),
(61, 'K3OPK', 'K3 OPERATOR PRODUKSI KELAS I', 'F', '-', 'T', '2023-12-02 10:53:57', '2023-12-02 10:53:57', 59),
(62, 'KNL', 'KNOWLEDGE (BEARING)', 'F', '-', 'T', '2023-12-02 10:54:02', '2023-12-02 10:54:02', 59),
(63, 'KKBSM', 'KUANTITAS & KUALITAS BATUBARA DAN STOCKPILE MANAGEMENT', 'F', '-', 'T', '2023-12-02 10:54:02', '2023-12-02 10:54:02', 59),
(64, 'LSS', 'LEAN SIX SIGMA', 'F', '-', 'T', '2023-12-02 10:54:02', '2023-12-02 10:54:02', 59),
(65, 'MP', 'MAINTENANCE PLANNING', 'F', '-', 'T', '2023-12-02 10:54:02', '2023-12-02 10:54:02', 59),
(66, 'MMNT', 'MANAGEMENT PERALATAN LAB & EVALUASI PERFORMA ALAT UKUR', 'F', '-', 'T', '2023-12-02 10:54:02', '2023-12-02 10:54:02', 59),
(67, 'PBK', 'PELATIHAN BEKERJA DI KETINGGIAN SERTIFIKASI KEMNAKER', 'F', '-', 'T', '2023-12-02 10:54:02', '2023-12-02 10:54:02', 59),
(68, 'PPP', 'PENDAMPINGAN PROGRAM PPM', 'F', '-', 'T', '2023-12-02 10:54:02', '2023-12-02 10:54:02', 59),
(69, 'PPVIP', 'PENGAMANAN DAN PELAYANAN VIP/VVIP', 'F', '-', 'T', '2023-12-02 10:54:02', '2023-12-02 10:54:02', 59),
(70, 'PB', 'PENGAPALAN BATUBARA', 'F', '-', 'T', '2023-12-02 10:54:02', '2023-12-02 10:54:02', 59),
(71, 'PPMP', 'PERBAIKAN PRODUKTIVITAS MELALUI PENINGKATAS KUALITAS & PENGHEMATAN BIAYA', 'F', '-', 'T', '2023-12-02 10:54:02', '2023-12-02 10:54:02', 59),
(72, 'PT', 'PERENCANAAN TAMBANG', 'F', '-', 'T', '2023-12-02 10:54:07', '2023-12-02 10:54:07', 59),
(73, 'PAK3K', 'PERPANJANGAN AHLI K3 KEBAKARAN', 'F', '-', 'T', '2023-12-02 10:54:07', '2023-12-02 10:54:07', 59),
(74, 'PTT', 'PROCUREMENT TRAINING (BNSP)', 'F', '-', 'T', '2023-12-02 10:54:07', '2023-12-02 10:54:07', 59),
(75, 'MPP', 'PROGRAM MASA PERSIAPAN PENSIUN (MPP)', 'F', '-', 'T', '2023-12-02 10:54:07', '2023-12-02 10:54:07', 59),
(76, 'PM', 'PROJECT MANAGEMENT', 'F', '-', 'T', '2023-12-02 10:54:07', '2023-12-02 10:54:07', 59),
(77, 'PL', 'PROPER LINGKUNGAN', 'F', '-', 'T', '2023-12-02 10:54:07', '2023-12-02 10:54:07', 59),
(78, 'QAL', 'QUALITY ASSURANCE LABORATORY', 'F', '-', 'T', '2023-12-02 10:54:07', '2023-12-02 10:54:07', 59),
(79, 'RS', 'RECRUITMENT & SELECTION', 'F', '-', 'T', '2023-12-02 10:54:07', '2023-12-02 10:54:07', 59),
(80, 'RM', 'RISK MANAGEMENT', 'F', '-', 'T', '2023-12-02 10:54:07', '2023-12-02 10:54:07', 59),
(81, 'SPAB', 'SAMPLING PREPARASI DAN ANALISA BATUBARA', 'F', '-', 'T', '2023-12-02 10:54:07', '2023-12-02 10:54:07', 59),
(82, 'CPI', 'SERTIFIKASI COMPETENT PERSON INDONESIA', 'F', '-', 'T', '2023-12-02 10:54:12', '2023-12-02 10:54:12', 59),
(83, 'PPPA', 'SERTIFIKASI PENANGGUNGJAWAB PENGENDALIAN PENCEMARAN AIR', 'F', '-', 'T', '2023-12-02 10:54:12', '2023-12-02 10:54:12', 59),
(84, 'PFSO', 'SERTIFIKASI PFSO', 'F', '-', 'T', '2023-12-02 10:54:12', '2023-12-02 10:54:12', 59),
(85, 'CHCS', 'SERTIFKASI CHCS - BNSP', 'F', '-', 'T', '2023-12-02 10:54:12', '2023-12-02 10:54:12', 59),
(86, 'SPP', 'SISTEM PENYALIRAN TAMBANG', 'F', '-', 'T', '2023-12-02 10:54:12', '2023-12-02 10:54:12', 59),
(87, 'SSU', 'STRUKTUR SKALA UPAH BASED ON PERMENAKERTRANS NO 1 TAHUN 2017', 'F', '-', 'T', '2023-12-02 10:54:12', '2023-12-02 10:54:12', 59),
(88, 'SB', 'STUDI BANDING UNTUK MEMAHAMI PROGRAM COMDEV', 'F', '-', 'T', '2023-12-02 10:54:12', '2023-12-02 10:54:12', 59),
(89, 'SDP', 'SUPERVISORY DEVELOPMENT PROGRAM', 'F', '-', 'T', '2023-12-02 10:54:12', '2023-12-02 10:54:12', 59),
(90, 'TEHQC', 'TEKNIK EVALUASI HASIL QC LAB & KOMPETENSI ANALIS', 'F', '-', 'T', '2023-12-02 10:54:12', '2023-12-02 10:54:12', 59),
(91, 'TKSM', 'TEKNIK KALIBRASI SUHU/MASSA', 'F', '-', 'T', '2023-12-02 10:54:12', '2023-12-02 10:54:12', 59),
(92, 'TSIM', 'TEKNIK SUPERVISI DAN INSPEKSI MUTU', 'F', '-', 'T', '2023-12-02 10:54:17', '2023-12-02 10:54:17', 59),
(93, 'TK3L', 'TEKNISI K3 LISTRIK', 'F', '-', 'T', '2023-12-02 10:54:17', '2023-12-02 10:54:17', 59),
(94, 'TCS', 'TRAINING & CERTIFIED SCAFFOLDING', 'F', '-', 'T', '2023-12-02 10:54:17', '2023-12-02 10:54:17', 59),
(95, 'TASMKP', 'TRAINING AUDIT SMKP', 'F', '-', 'T', '2023-12-02 10:54:17', '2023-12-02 10:54:17', 59),
(96, 'TA', 'TRAINING AUDITING', 'F', '-', 'T', '2023-12-02 10:54:17', '2023-12-02 10:54:17', 59),
(97, 'TAC3D', 'TRAINING AUTOCAD CIVIL 3D', 'F', '-', 'T', '2023-12-02 10:54:17', '2023-12-02 10:54:17', 59),
(98, 'TB', 'TRAINING BUDGETING', 'F', '-', 'T', '2023-12-02 10:54:17', '2023-12-02 10:54:17', 59),
(99, 'TCQCA', 'TRAINING COAL QUALITY CONTROL & ASSURANCE', 'F', '-', 'T', '2023-12-02 10:54:17', '2023-12-02 10:54:17', 59),
(100, 'TJPAT', 'TRAINING DIKLAT DAN SERTIFIKAT JURU PENGEBORAN AIR TANAH', 'F', '-', 'T', '2023-12-02 10:54:17', '2023-12-02 10:54:17', 59),
(101, 'TFO', 'TRAINING FO SPLICING & OTDR', 'F', '-', 'T', '2023-12-02 10:54:17', '2023-12-02 10:54:17', 59),
(102, 'TGDMG', 'TRAINING GEOLOGI DATABASE & MODELING GEOLOGI (UPGAREDING)', 'F', '-', 'T', '2023-12-02 10:54:22', '2023-12-02 10:54:22', 59),
(103, 'TISMKP', 'TRAINING IMPLEMENTASI SMKP', 'F', '-', 'T', '2023-12-02 10:54:22', '2023-12-02 10:54:22', 59),
(104, 'TK3KK', 'TRAINING K3 KEBAKARAN KELAS C', 'F', '-', 'T', '2023-12-02 10:54:22', '2023-12-02 10:54:22', 59),
(105, 'TM', 'TRAINING MINES', 'F', '-', 'T', '2023-12-02 10:54:22', '2023-12-02 10:54:22', 59),
(106, 'TNSI', 'TRAINING NEGOTIATION SKILL & IMPLEMENTATION', 'F', '-', 'T', '2023-12-02 10:54:22', '2023-12-02 10:54:22', 59),
(107, 'TNI', 'TRAINING NETWORK INFRASTRUKTUR', 'F', '-', 'T', '2023-12-02 10:54:22', '2023-12-02 10:54:22', 59),
(108, 'TOT', 'TRAINING OF TRAINER (TOT)', 'F', '-', 'T', '2023-12-02 10:54:22', '2023-12-02 10:54:22', 59),
(109, 'TPJSA', 'TRAINING PEMBUATAN JSA', 'F', '-', 'T', '2023-12-02 10:54:22', '2023-12-02 10:54:22', 59),
(110, 'TPD', 'TRAINING PENGOPERASIAN DRONE', 'F', '-', 'T', '2023-12-02 10:54:22', '2023-12-02 10:54:22', 59),
(111, 'TPRKAB', 'TRAINING PENYUSUNAN RKAB PERUSAHAAN TAMBANG ', 'F', '-', 'T', '2023-12-02 10:54:22', '2023-12-02 10:54:22', 59),
(112, 'TR', 'TRAINING REVALIDASI (LOAD TO BARGE)', 'F', '-', 'T', '2023-12-02 10:54:29', '2023-12-02 10:54:29', 59),
(113, 'TK3OG', 'TRAINING SERTIFIKASI K3 OPERATOR GENSET (KELAS 1)', 'F', '-', 'T', '2023-12-02 10:54:29', '2023-12-02 10:54:29', 59),
(114, 'TSS', 'TRAINING SPRAY SCHEDULER', 'F', '-', 'T', '2023-12-02 10:54:29', '2023-12-02 10:54:29', 59),
(115, 'TT', 'TRAINING TRANSHIPMENT (PENGAPALAN BATUBARA)', 'F', '-', 'T', '2023-12-02 10:54:29', '2023-12-02 10:54:29', 59),
(116, 'TUPJD', 'TRAINING UJI PENYEGARAN JURU LEDAK UNTUK PENGAJUAN KARTU IZIN MELEDAKKAN ANGKATAN 1', 'F', '-', 'T', '2023-12-02 10:54:29', '2023-12-02 10:54:29', 59),
(117, 'TWMCH', 'TRAINING WORKSHOP MANAGEMENT COAL HAULING', 'F', '-', 'T', '2023-12-02 10:54:29', '2023-12-02 10:54:29', 59),
(118, 'TOMWB', 'TRAINING/SEMINAR OPERASIONAL DAN MAINTENANCE WEIGHT BRIDGE', 'F', '-', 'T', '2023-12-02 10:54:29', '2023-12-02 10:54:29', 59),
(119, 'UIKT', 'UJI KOMPETENSI INVESTIGASI DAN KECELAKAAN TAMBANG', 'F', '-', 'T', '2023-12-02 10:54:29', '2023-12-02 10:54:29', 59),
(120, 'UTPPH', 'UMPIRE TEST UNTUK PENYELESAIAN PERBEDAAN HASIL ANALISIS BATUBARA', 'F', '-', 'T', '2023-12-02 10:54:29', '2023-12-02 10:54:29', 59),
(121, 'VCPI', 'VERIFIKASI CPI', 'F', '-', 'T', '2023-12-02 10:54:29', '2023-12-02 10:54:29', 59),
(122, 'WS4G', 'WELDING SERTIFIKASI - 4G (KELAS II)', 'F', '-', 'T', '2023-12-02 10:54:29', '2023-12-02 10:54:29', 59),
(123, 'WESDM', 'WORKSHOP ESDM (TERKAIT PERATURAN UPDATE)', 'F', '-', 'T', '2023-12-02 10:54:29', '2023-12-02 10:54:29', 59),
(124, 'WGC', 'WORKSHOP GEOLOGI & CONVENTION (IAGI/PERHAPI/GEOSERVICE)', 'F', '-', 'T', '2023-12-02 10:54:29', '2023-12-02 10:54:29', 59),
(125, 'WHGP', 'WORKSHOP HIDROLOGI & GEOTECHNICAL PERTAMBANGAN', 'F', '-', 'T', '2023-12-02 10:54:38', '2023-12-02 10:54:38', 59),
(126, 'CHCO', 'Sertifkasi CHCO - BNSP', 'F', '-', 'T', '2023-12-02 14:32:42', '2023-12-02 14:32:42', 59),
(127, 'PPM', 'Pekerja Peledakan Madya', 'F', '-', 'T', '2023-12-03 10:25:15', '2023-12-03 10:25:15', 59),
(128, 'PPPU', 'Penanggung Jawab Pengendalian Pencemaran Udara', 'F', '-', 'T', '2023-12-03 10:53:45', '2023-12-03 10:53:45', 59),
(129, 'PAPLB3', 'PEMANTAUAN & ANALISIS PENGELOLAAN LIMBAH B3', 'F', '-', 'T', '2023-12-03 10:58:56', '2023-12-03 10:58:56', 59),
(130, 'PKB', 'PENGUJIAN KAYU BUNDAR', 'F', '-', 'T', '2023-12-03 11:09:39', '2023-12-03 11:09:39', 59),
(131, 'PHT', 'PERENCANAAN HUTAN', 'F', '-', 'T', '2023-12-03 11:14:34', '2023-12-03 11:14:34', 59),
(132, 'PPSDM KEBTKE', 'LEMBAGA SERTIFIKASI KOMPETENSI PPSDM KEBTKE', 'F', '-', 'T', '2023-12-03 11:40:24', '2023-12-03 11:40:24', 59),
(133, 'OPLBBB', 'OPERASIONAL PENGELOLAAN LIMBAH BAHAN BERBAHAYA DAN BERACUN', 'F', '-', 'T', '2023-12-04 08:01:26', '2023-12-04 08:01:26', 59),
(134, 'OHSPI', 'KESELAMATAN DAN KESEHATAN KERJA INDUSTRI PELABUHAN', 'F', '-', 'T', '2023-12-04 09:07:34', '2023-12-04 09:07:34', 59),
(135, 'SFK2', 'SERTIFIKASI FORKLIFT KELAS 2', 'F', '-', 'T', '2023-12-04 09:09:16', '2023-12-04 09:09:16', 59),
(136, 'IHTSGK1', 'IHT SERTIFIKASI GENSET KELAS 1', 'F', '-', 'T', '2023-12-04 11:38:36', '2023-12-04 11:38:36', 59),
(137, 'PJOPPU', 'PENANGGUNG JAWAB OPERASIONAL INSTALASI PENGENDALIAN PENCEMARAN UDARA', 'F', '-', 'T', '2023-12-06 11:13:40', '2023-12-06 11:13:40', 59),
(138, 'SDC', 'SAFETY DRIVING CLINIC', 'F', '-', 'T', '2023-12-08 14:25:37', '2023-12-08 14:25:37', 59),
(139, 'CHKKBPRM', 'Coal Handling & Kontrol Kualitas Batubara Peringkat Rendah & Menengah', 'F', '-', 'T', '2023-12-08 16:42:47', '2023-12-08 16:42:47', 59),
(140, 'AKI', 'AKADEMI KEPELABUHAN - INAPORTNET', 'F', '-', 'T', '2023-12-08 16:42:47', '2024-04-04 11:17:26', 59),
(141, 'CSCM', 'Coal Supply Chain Management', 'F', '-', 'T', '2023-12-08 16:42:50', '2023-12-08 16:42:50', 59),
(142, 'PFSO', 'Port Facility Security Officer', 'F', '-', 'T', '2023-12-08 16:52:40', '2023-12-08 16:52:40', 59),
(143, 'JLNTPBPK', 'JURU LEDAK NON TAMBANG & PENGELOLAAN BAHAN PELEDAK KOMERSIAL', 'F', '-', 'T', '2023-12-10 07:53:30', '2023-12-10 07:53:30', 59),
(144, 'PPOP', 'PEMBEKALAN PENGAWAS OPERASIONAL PERTAMA (POP)', 'F', '-', 'T', '2023-12-10 09:24:30', '2023-12-10 09:24:30', 59),
(145, 'PPOM', 'PEMBEKALAN PENGAWAS OPERASIONAL MADYA (POM)', 'F', '-', 'T', '2023-12-10 09:24:30', '2023-12-10 09:24:30', 59),
(146, 'PPOU', 'PEMBEKALAN PENGAWAS OPERASIONAL UTAMA (POU)', 'F', '-', 'T', '2023-12-10 09:24:31', '2023-12-10 09:24:31', 59),
(147, 'LJOP', 'LAYANAN JASA DAN OPERASIONAL PELABUHAN', 'F', '-', 'T', '2023-12-10 15:18:44', '2023-12-10 15:18:44', 59),
(148, 'LFA', 'LOGICAL FRAMEWORK APPROACH', 'F', '-', 'T', '2023-12-10 16:22:21', '2023-12-10 16:22:21', 59),
(150, 'IDDC', 'Indonesia Defensive Driving Center (IDDC)', 'F', '-', 'T', '2024-02-01 16:39:53', '2024-02-01 16:39:53', 59),
(172, 'ANT1', 'Ahli Nautika Tingkat 1', 'F', '-', 'T', '1970-01-01 00:00:00', '1970-01-01 00:00:00', 27),
(173, 'ORPT', 'Oil Recovery & Pollution TrainingÂ ', 'F', '-', 'T', '1970-01-01 00:00:00', '1970-01-01 00:00:00', 27),
(174, 'ISMC13', 'International Safety Management Code (ISM Code) Session 1 & 3Â ', 'F', '-', 'T', '1970-01-01 00:00:00', '1970-01-01 00:00:00', 27),
(175, 'ISM', 'ISM CodeÂ , Full session ', 'F', '-', 'T', '1970-01-01 00:00:00', '1970-01-01 00:00:00', 27),
(176, 'ISAC', 'Internal Safety AuditorÂ  for ISM Code', 'F', '-', 'T', '1970-01-01 00:00:00', '1970-01-01 00:00:00', 27),
(177, 'CSO', 'Company Security Officer (CSO)Â ', 'F', '-', 'T', '1970-01-01 00:00:00', '1970-01-01 00:00:00', 27),
(178, 'IAISPS', 'Internal AuditorÂ  for ISPS CodeÂ ', 'F', '-', 'T', '1970-01-01 00:00:00', '1970-01-01 00:00:00', 27),
(179, 'MS', 'Marine Surveyor', 'F', '-', 'T', '1970-01-01 00:00:00', '1970-01-01 00:00:00', 27),
(180, 'EFIATCI14001', 'Environmental Familiarizations &Â  Internal Audit Training Course covering ISO 14001-2004', 'F', '-', 'T', '1970-01-01 00:00:00', '1970-01-01 00:00:00', 27),
(181, 'OFTIATC18000', 'OH&S Familiarizations Training & Internal Audit Training Course Covering OHSAS 18001/ASNZ 4801', 'F', '-', 'T', '1970-01-01 00:00:00', '1970-01-01 00:00:00', 27),
(182, 'QSSEFIATC', 'Quality , Safety , Security & Environmental Familiarizations and Internal Audit Training Course', 'F', '-', 'T', '1970-01-01 00:00:00', '1970-01-01 00:00:00', 27),
(183, 'GAIMLC', 'General Awareness & Implications of Maritime Labour Convention (2006 ) Code', 'F', '-', 'T', '1970-01-01 00:00:00', '1970-01-01 00:00:00', 27),
(184, 'IMS5CFLWS', 'IMS 5 â€“ CompetentÂ  Front Line Worksite Supervisor', 'F', '-', 'T', '1970-01-01 00:00:00', '1970-01-01 00:00:00', 27),
(185, 'RSS', 'Rigging and Slinging Safety', 'F', '-', 'T', '1970-01-01 00:00:00', '1970-01-01 00:00:00', 27),
(186, 'BRS', 'Basic Rigging and Slinging', 'F', '-', 'T', '1970-01-01 00:00:00', '1970-01-01 00:00:00', 27),
(187, 'OWD', 'Open Water Diver', 'F', '-', 'T', '1970-01-01 00:00:00', '1970-01-01 00:00:00', 27),
(188, 'AD', 'Advance Diver', 'F', '-', 'T', '1970-01-01 00:00:00', '1970-01-01 00:00:00', 27),
(189, 'UDPO', 'Unlimited Dynamic Positioning Operator (DPO)', 'F', '-', 'T', '1970-01-01 00:00:00', '1970-01-01 00:00:00', 27),
(190, 'GOR', 'General Operator Radio', 'F', '-', 'T', '1970-01-01 00:00:00', '1970-01-01 00:00:00', 27),
(191, 'GMDSSC', 'GMDSS Certificate', 'F', '-', 'T', '1970-01-01 00:00:00', '1970-01-01 00:00:00', 27),
(192, 'FCSCFUV', 'Full Comply SOLAS Certification For Unlimited Voyage', 'F', '-', 'T', '1970-01-01 00:00:00', '1970-01-01 00:00:00', 27);

-- --------------------------------------------------------

--
-- Table structure for table `tb_jenis_usaha`
--

CREATE TABLE `tb_jenis_usaha` (
  `id_jenis_usaha` int(11) NOT NULL,
  `jenis_usaha` varchar(100) NOT NULL DEFAULT '',
  `ket_jenis_usaha` varchar(1000) NOT NULL DEFAULT '',
  `stat_jenis_usaha` char(1) NOT NULL DEFAULT '',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_jenis_usaha`
--

INSERT INTO `tb_jenis_usaha` (`id_jenis_usaha`, `jenis_usaha`, `ket_jenis_usaha`, `stat_jenis_usaha`, `tgl_buat`, `tgl_edit`, `id_user`) VALUES
(1, 'PENAMBANGAN', '', 'T', '1970-01-01 00:00:00', '1970-01-01 00:00:00', 1),
(2, 'PENAMBANGAN', '', 'T', '1970-01-01 00:00:00', '1970-01-01 00:00:00', 1),
(3, 'PENAMBANGAN', '', 'T', '1970-01-01 00:00:00', '1970-01-01 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_jml_kary`
--

CREATE TABLE `tb_jml_kary` (
  `id_perusahaan` int(11) NOT NULL,
  `jml` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_jml_kary`
--

INSERT INTO `tb_jml_kary` (`id_perusahaan`, `jml`) VALUES
(1, 639),
(2, 0),
(3, 0),
(4, 0),
(5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_karyawan`
--

CREATE TABLE `tb_karyawan` (
  `id_kary` int(11) NOT NULL,
  `id_personal` int(11) NOT NULL DEFAULT 0,
  `id_perkerjaan` int(11) NOT NULL DEFAULT 0,
  `no_acr` bigint(20) NOT NULL DEFAULT 0,
  `no_nik` varchar(50) NOT NULL,
  `doh` date NOT NULL DEFAULT '1970-01-01',
  `tgl_aktif` date NOT NULL DEFAULT '1970-01-01',
  `id_depart` int(11) NOT NULL DEFAULT 0,
  `id_section` int(11) NOT NULL DEFAULT 0,
  `id_posisi` int(11) NOT NULL DEFAULT 0,
  `id_grade` int(11) NOT NULL DEFAULT 0,
  `id_level` int(11) NOT NULL DEFAULT 0,
  `id_lokker` int(11) NOT NULL DEFAULT 0,
  `id_lokterima` int(11) NOT NULL,
  `id_poh` int(11) NOT NULL,
  `id_roster` int(11) NOT NULL,
  `id_klasifikasi` int(11) NOT NULL DEFAULT 0,
  `paybase` varchar(15) NOT NULL DEFAULT '',
  `statpajak` char(3) NOT NULL DEFAULT '',
  `id_tipe` int(11) NOT NULL DEFAULT 0,
  `id_stat_tinggal` int(11) DEFAULT NULL,
  `email_kantor` varchar(200) NOT NULL DEFAULT '',
  `tgl_permanen` date NOT NULL DEFAULT '1970-01-01',
  `id_stat_perjanjian` int(11) NOT NULL,
  `tgl_nonaktif` date NOT NULL DEFAULT '1970-01-01',
  `alasan_nonaktif` varchar(2000) NOT NULL DEFAULT '',
  `url_foto` varchar(2000) DEFAULT NULL,
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL,
  `id_m_perusahaan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_karyawan`
--

INSERT INTO `tb_karyawan` (`id_kary`, `id_personal`, `id_perkerjaan`, `no_acr`, `no_nik`, `doh`, `tgl_aktif`, `id_depart`, `id_section`, `id_posisi`, `id_grade`, `id_level`, `id_lokker`, `id_lokterima`, `id_poh`, `id_roster`, `id_klasifikasi`, `paybase`, `statpajak`, `id_tipe`, `id_stat_tinggal`, `email_kantor`, `tgl_permanen`, `id_stat_perjanjian`, `tgl_nonaktif`, `alasan_nonaktif`, `url_foto`, `tgl_buat`, `tgl_edit`, `id_user`, `id_m_perusahaan`) VALUES
(1, 1, 0, 0, '51021149', '2021-10-30', '2021-10-30', 4, 1, 1557, 20, 1, 2, 3, 61, 3, 7, '2', '2', 2, 1, 'ihfan.noifara@ungguldinamika.co.id', '1970-01-01', 0, '1970-01-01', '', '20240512221029-FOTO.jpg', '2024-05-12 22:01:29', '2024-05-12 22:10:32', 1, 1),
(2, 2, 0, 0, '505242173', '2021-10-30', '2021-10-30', 4, 1, 1557, 20, 1, 2, 3, 61, 3, 7, '2', '2', 2, 1, 'ihfan.noifara@ungguldinamika.co.id', '1970-01-01', 0, '1970-01-01', '', '20240512221029-FOTO.jpg', '2024-05-12 22:01:29', '2024-05-12 22:10:32', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_karyawan_nonaktif`
--

CREATE TABLE `tb_karyawan_nonaktif` (
  `id_kary_nonaktif` int(11) NOT NULL,
  `id_kary` int(11) NOT NULL,
  `tgl_nonaktif` date NOT NULL DEFAULT '1970-01-01',
  `id_alasan_nonaktif` int(11) NOT NULL DEFAULT 0,
  `ket_nonaktif` varchar(2000) NOT NULL DEFAULT '',
  `url_berkas_nonaktif` varchar(1000) NOT NULL DEFAULT '',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_keluarga`
--

CREATE TABLE `tb_keluarga` (
  `id_keluarga` int(11) NOT NULL,
  `id_personal` int(11) NOT NULL DEFAULT 0,
  `nik_pasangan` varchar(50) NOT NULL DEFAULT '0',
  `nama_pasangan` varchar(100) DEFAULT NULL,
  `nama_ibu_pasangan` varchar(100) DEFAULT NULL,
  `nama_ayah_pasangan` varchar(100) DEFAULT NULL,
  `tmp_lahir_pasangan` varchar(100) DEFAULT NULL,
  `tgl_lahir_pasangan` date NOT NULL DEFAULT '1970-01-01',
  `jk_pasangan` varchar(1) DEFAULT NULL,
  `no_bpjs_pasangan` varchar(30) DEFAULT NULL,
  `no_eli_pasangan` varchar(30) DEFAULT NULL,
  `hp_pasangan` varchar(20) DEFAULT NULL,
  `stat_pasangan` char(1) NOT NULL DEFAULT 'T',
  `stat_bpjs_pasangan` char(1) NOT NULL DEFAULT 'T',
  `nik_anak_1` varchar(50) NOT NULL DEFAULT '0',
  `nama_anak_1` varchar(100) DEFAULT NULL,
  `nama_ibu_anak_1` varchar(100) DEFAULT NULL,
  `nama_ayah_anak_1` varchar(100) DEFAULT NULL,
  `tmp_lahir_anak_1` varchar(100) DEFAULT NULL,
  `tgl_lahir_anak_1` date NOT NULL DEFAULT '1970-01-01',
  `jk_anak_1` varchar(1) DEFAULT NULL,
  `no_bpjs_anak_1` varchar(30) DEFAULT NULL,
  `no_eli_anak_1` varchar(30) DEFAULT NULL,
  `hp_anak_1` varchar(20) DEFAULT NULL,
  `stat_anak_1` char(1) NOT NULL DEFAULT 'T',
  `stat_bpjs_anak_1` char(1) NOT NULL DEFAULT 'T',
  `nik_anak_2` varchar(50) NOT NULL DEFAULT '0',
  `nama_anak_2` varchar(100) DEFAULT NULL,
  `nama_ibu_anak_2` varchar(100) DEFAULT NULL,
  `nama_ayah_anak_2` varchar(100) DEFAULT NULL,
  `tmp_lahir_anak_2` varchar(100) DEFAULT NULL,
  `tgl_lahir_anak_2` date NOT NULL DEFAULT '1970-01-01',
  `jk_anak_2` varchar(1) DEFAULT NULL,
  `no_bpjs_anak_2` varchar(30) DEFAULT NULL,
  `no_eli_anak_2` varchar(30) DEFAULT NULL,
  `hp_anak_2` varchar(20) DEFAULT NULL,
  `stat_anak_2` char(1) NOT NULL DEFAULT 'T',
  `stat_bpjs_anak_2` char(1) NOT NULL DEFAULT 'T',
  `nik_anak_3` varchar(50) NOT NULL DEFAULT '0',
  `nama_anak_3` varchar(100) DEFAULT NULL,
  `nama_ibu_anak_3` varchar(100) DEFAULT NULL,
  `nama_ayah_anak_3` varchar(100) DEFAULT NULL,
  `tmp_lahir_anak_3` varchar(100) DEFAULT NULL,
  `tgl_lahir_anak_3` date NOT NULL DEFAULT '1970-01-01',
  `jk_anak_3` varchar(1) DEFAULT NULL,
  `no_bpjs_anak_3` varchar(30) DEFAULT NULL,
  `no_eli_anak_3` varchar(30) DEFAULT NULL,
  `hp_anak_3` varchar(20) DEFAULT NULL,
  `stat_anak_3` char(1) NOT NULL DEFAULT 'T',
  `stat_bpjs_anak_3` char(1) NOT NULL DEFAULT 'T',
  `nik_anak_4` varchar(50) NOT NULL DEFAULT '0',
  `nama_anak_4` varchar(100) DEFAULT NULL,
  `nama_ibu_anak_4` varchar(100) DEFAULT NULL,
  `nama_ayah_anak_4` varchar(100) DEFAULT NULL,
  `tmp_lahir_anak_4` varchar(100) DEFAULT NULL,
  `tgl_lahir_anak_4` date NOT NULL DEFAULT '1970-01-01',
  `jk_anak_4` varchar(1) DEFAULT NULL,
  `no_bpjs_anak_4` varchar(30) DEFAULT NULL,
  `no_eli_anak_4` varchar(30) DEFAULT NULL,
  `hp_anak_4` varchar(20) DEFAULT NULL,
  `stat_anak_4` char(1) NOT NULL DEFAULT 'T',
  `stat_bpjs_anak_4` char(1) NOT NULL DEFAULT 'T',
  `nik_anak_5` varchar(50) NOT NULL DEFAULT '0',
  `nama_anak_5` varchar(100) DEFAULT NULL,
  `nama_ibu_anak_5` varchar(100) DEFAULT NULL,
  `nama_ayah_anak_5` varchar(100) DEFAULT NULL,
  `tmp_lahir_anak_5` varchar(100) DEFAULT NULL,
  `tgl_lahir_anak_5` date NOT NULL DEFAULT '1970-01-01',
  `jk_anak_5` varchar(1) DEFAULT NULL,
  `no_bpjs_anak_5` varchar(30) DEFAULT NULL,
  `no_eli_anak_5` varchar(30) DEFAULT NULL,
  `hp_anak_5` varchar(20) DEFAULT NULL,
  `stat_anak_5` char(1) NOT NULL DEFAULT 'T',
  `stat_bpjs_anak_5` char(1) NOT NULL DEFAULT 'T',
  `nik_anak_6` varchar(50) NOT NULL DEFAULT '0',
  `nama_anak_6` varchar(100) DEFAULT NULL,
  `nama_ibu_anak_6` varchar(100) DEFAULT NULL,
  `nama_ayah_anak_6` varchar(100) DEFAULT NULL,
  `tmp_lahir_anak_6` varchar(100) DEFAULT NULL,
  `tgl_lahir_anak_6` date NOT NULL DEFAULT '1970-01-01',
  `jk_anak_6` varchar(1) DEFAULT NULL,
  `no_bpjs_anak_6` varchar(30) DEFAULT NULL,
  `no_eli_anak_6` varchar(30) DEFAULT NULL,
  `hp_anak_6` varchar(20) DEFAULT NULL,
  `stat_anak_6` char(1) NOT NULL DEFAULT 'T',
  `stat_bpjs_anak_6` char(1) NOT NULL DEFAULT 'T',
  `nik_anak_7` varchar(50) NOT NULL DEFAULT '0',
  `nama_anak_7` varchar(100) DEFAULT NULL,
  `nama_ibu_anak_7` varchar(100) DEFAULT NULL,
  `nama_ayah_anak_7` varchar(100) DEFAULT NULL,
  `tmp_lahir_anak_7` varchar(100) DEFAULT NULL,
  `tgl_lahir_anak_7` date NOT NULL DEFAULT '1970-01-01',
  `jk_anak_7` varchar(1) DEFAULT NULL,
  `no_bpjs_anak_7` varchar(30) DEFAULT NULL,
  `no_eli_anak_7` varchar(30) DEFAULT NULL,
  `hp_anak_7` varchar(20) DEFAULT NULL,
  `stat_anak_7` char(1) NOT NULL DEFAULT 'T',
  `stat_bpjs_anak_7` char(1) NOT NULL DEFAULT 'T',
  `nik_anak_8` varchar(50) NOT NULL DEFAULT '0',
  `nama_anak_8` varchar(100) DEFAULT NULL,
  `nama_ibu_anak_8` varchar(100) DEFAULT NULL,
  `nama_ayah_anak_8` varchar(100) DEFAULT NULL,
  `tmp_lahir_anak_8` varchar(100) DEFAULT NULL,
  `tgl_lahir_anak_8` date NOT NULL DEFAULT '1970-01-01',
  `jk_anak_8` varchar(1) DEFAULT NULL,
  `no_bpjs_anak_8` varchar(30) DEFAULT NULL,
  `no_eli_anak_8` varchar(30) DEFAULT NULL,
  `hp_anak_8` varchar(20) DEFAULT NULL,
  `stat_anak_8` char(1) NOT NULL DEFAULT 'T',
  `stat_bpjs_anak_8` char(1) NOT NULL DEFAULT 'T',
  `nik_anak_9` varchar(50) NOT NULL DEFAULT '0',
  `nama_anak_9` varchar(100) DEFAULT NULL,
  `nama_ibu_anak_9` varchar(100) DEFAULT NULL,
  `nama_ayah_anak_9` varchar(100) DEFAULT NULL,
  `tmp_lahir_anak_9` varchar(100) DEFAULT NULL,
  `tgl_lahir_anak_9` date NOT NULL DEFAULT '1970-01-01',
  `jk_anak_9` varchar(1) DEFAULT NULL,
  `no_bpjs_anak_9` varchar(30) DEFAULT NULL,
  `no_eli_anak_9` varchar(30) DEFAULT NULL,
  `hp_anak_9` varchar(20) DEFAULT NULL,
  `stat_anak_9` char(1) NOT NULL DEFAULT 'T',
  `stat_bpjs_anak_9` char(1) NOT NULL DEFAULT 'T',
  `nik_anak_10` varchar(50) NOT NULL DEFAULT '0',
  `nama_anak_10` varchar(100) DEFAULT NULL,
  `nama_ibu_anak_10` varchar(100) DEFAULT NULL,
  `nama_ayah_anak_10` varchar(100) DEFAULT NULL,
  `tmp_lahir_anak_10` varchar(100) DEFAULT NULL,
  `tgl_lahir_anak_10` date NOT NULL DEFAULT '1970-01-01',
  `jk_anak_10` varchar(1) DEFAULT NULL,
  `no_bpjs_anak_10` varchar(30) DEFAULT NULL,
  `no_eli_anak_10` varchar(30) DEFAULT NULL,
  `hp_anak_10` varchar(20) DEFAULT NULL,
  `stat_anak_10` char(1) NOT NULL DEFAULT 'T',
  `stat_bpjs_anak_10` char(1) NOT NULL DEFAULT 'T',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_keluarga`
--

INSERT INTO `tb_keluarga` (`id_keluarga`, `id_personal`, `nik_pasangan`, `nama_pasangan`, `nama_ibu_pasangan`, `nama_ayah_pasangan`, `tmp_lahir_pasangan`, `tgl_lahir_pasangan`, `jk_pasangan`, `no_bpjs_pasangan`, `no_eli_pasangan`, `hp_pasangan`, `stat_pasangan`, `stat_bpjs_pasangan`, `nik_anak_1`, `nama_anak_1`, `nama_ibu_anak_1`, `nama_ayah_anak_1`, `tmp_lahir_anak_1`, `tgl_lahir_anak_1`, `jk_anak_1`, `no_bpjs_anak_1`, `no_eli_anak_1`, `hp_anak_1`, `stat_anak_1`, `stat_bpjs_anak_1`, `nik_anak_2`, `nama_anak_2`, `nama_ibu_anak_2`, `nama_ayah_anak_2`, `tmp_lahir_anak_2`, `tgl_lahir_anak_2`, `jk_anak_2`, `no_bpjs_anak_2`, `no_eli_anak_2`, `hp_anak_2`, `stat_anak_2`, `stat_bpjs_anak_2`, `nik_anak_3`, `nama_anak_3`, `nama_ibu_anak_3`, `nama_ayah_anak_3`, `tmp_lahir_anak_3`, `tgl_lahir_anak_3`, `jk_anak_3`, `no_bpjs_anak_3`, `no_eli_anak_3`, `hp_anak_3`, `stat_anak_3`, `stat_bpjs_anak_3`, `nik_anak_4`, `nama_anak_4`, `nama_ibu_anak_4`, `nama_ayah_anak_4`, `tmp_lahir_anak_4`, `tgl_lahir_anak_4`, `jk_anak_4`, `no_bpjs_anak_4`, `no_eli_anak_4`, `hp_anak_4`, `stat_anak_4`, `stat_bpjs_anak_4`, `nik_anak_5`, `nama_anak_5`, `nama_ibu_anak_5`, `nama_ayah_anak_5`, `tmp_lahir_anak_5`, `tgl_lahir_anak_5`, `jk_anak_5`, `no_bpjs_anak_5`, `no_eli_anak_5`, `hp_anak_5`, `stat_anak_5`, `stat_bpjs_anak_5`, `nik_anak_6`, `nama_anak_6`, `nama_ibu_anak_6`, `nama_ayah_anak_6`, `tmp_lahir_anak_6`, `tgl_lahir_anak_6`, `jk_anak_6`, `no_bpjs_anak_6`, `no_eli_anak_6`, `hp_anak_6`, `stat_anak_6`, `stat_bpjs_anak_6`, `nik_anak_7`, `nama_anak_7`, `nama_ibu_anak_7`, `nama_ayah_anak_7`, `tmp_lahir_anak_7`, `tgl_lahir_anak_7`, `jk_anak_7`, `no_bpjs_anak_7`, `no_eli_anak_7`, `hp_anak_7`, `stat_anak_7`, `stat_bpjs_anak_7`, `nik_anak_8`, `nama_anak_8`, `nama_ibu_anak_8`, `nama_ayah_anak_8`, `tmp_lahir_anak_8`, `tgl_lahir_anak_8`, `jk_anak_8`, `no_bpjs_anak_8`, `no_eli_anak_8`, `hp_anak_8`, `stat_anak_8`, `stat_bpjs_anak_8`, `nik_anak_9`, `nama_anak_9`, `nama_ibu_anak_9`, `nama_ayah_anak_9`, `tmp_lahir_anak_9`, `tgl_lahir_anak_9`, `jk_anak_9`, `no_bpjs_anak_9`, `no_eli_anak_9`, `hp_anak_9`, `stat_anak_9`, `stat_bpjs_anak_9`, `nik_anak_10`, `nama_anak_10`, `nama_ibu_anak_10`, `nama_ayah_anak_10`, `tmp_lahir_anak_10`, `tgl_lahir_anak_10`, `jk_anak_10`, `no_bpjs_anak_10`, `no_eli_anak_10`, `hp_anak_10`, `stat_anak_10`, `stat_bpjs_anak_10`, `tgl_buat`, `tgl_edit`, `id_user`) VALUES
(3, 1560, '0', NULL, NULL, NULL, NULL, '1970-01-01', NULL, NULL, NULL, NULL, 'T', 'T', '', 'GRAYSON INNOSENSIUS. GULTOM', 'ELLY WINDUWATI SINAGA', 'ROMMEL FRANSISKUS GULTOM', 'KUTAI TIMUR', '2013-07-06', 'L', '', '', '', 'T', 'T', '', 'FARREL IGNASIUS GULTOM', 'ELLY WINDUWATI SINAGA', 'ROMMEL FRANSISKUS GULTOM', 'KUTAI TIMUR', '2015-07-25', 'L', '', '', '', 'T', '', '0', NULL, NULL, NULL, NULL, '1970-01-01', NULL, NULL, NULL, NULL, 'T', 'T', '0', NULL, NULL, NULL, NULL, '1970-01-01', NULL, NULL, NULL, NULL, 'T', 'T', '0', NULL, NULL, NULL, NULL, '1970-01-01', NULL, NULL, NULL, NULL, 'T', 'T', '0', NULL, NULL, NULL, NULL, '1970-01-01', NULL, NULL, NULL, NULL, 'T', 'T', '0', NULL, NULL, NULL, NULL, '1970-01-01', NULL, NULL, NULL, NULL, 'T', 'T', '0', NULL, NULL, NULL, NULL, '1970-01-01', NULL, NULL, NULL, NULL, 'T', 'T', '0', NULL, NULL, NULL, NULL, '1970-01-01', NULL, NULL, NULL, NULL, 'T', 'T', '0', NULL, NULL, NULL, NULL, '1970-01-01', NULL, NULL, NULL, NULL, 'T', 'T', '2024-05-11 10:00:51', '2024-05-11 10:03:22', 60),
(4, 1, '65645345345345', 'WAHYUNI', 'HJ. SULEHA ALM', 'H. BAHARUDDIN, ALM', 'SAMARINDA', '1984-08-27', 'P', '', '', '', 'T', 'T', '676734534534578', 'IHSAN RAZAK RAMADHAN', 'WAHYUNI', 'IHFAN NOIFARA', 'SAMARINDA', '2006-10-10', 'L', '', '', '08323423444234', 'T', '', '0', NULL, NULL, NULL, NULL, '1970-01-01', NULL, NULL, NULL, NULL, 'T', 'T', '0', NULL, NULL, NULL, NULL, '1970-01-01', NULL, NULL, NULL, NULL, 'T', 'T', '0', NULL, NULL, NULL, NULL, '1970-01-01', NULL, NULL, NULL, NULL, 'T', 'T', '0', NULL, NULL, NULL, NULL, '1970-01-01', NULL, NULL, NULL, NULL, 'T', 'T', '0', NULL, NULL, NULL, NULL, '1970-01-01', NULL, NULL, NULL, NULL, 'T', 'T', '0', NULL, NULL, NULL, NULL, '1970-01-01', NULL, NULL, NULL, NULL, 'T', 'T', '0', NULL, NULL, NULL, NULL, '1970-01-01', NULL, NULL, NULL, NULL, 'T', 'T', '0', NULL, NULL, NULL, NULL, '1970-01-01', NULL, NULL, NULL, NULL, 'T', 'T', '0', NULL, NULL, NULL, NULL, '1970-01-01', NULL, NULL, NULL, NULL, 'T', 'T', '2024-05-12 22:03:17', '2024-05-12 22:04:03', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_klasifikasi`
--

CREATE TABLE `tb_klasifikasi` (
  `id_klasifikasi` int(11) NOT NULL,
  `klasifikasi` varchar(50) NOT NULL,
  `ket_klasifikasi` varchar(1000) NOT NULL,
  `stat_klasifikasi` char(1) NOT NULL DEFAULT 'T',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_klasifikasi`
--

INSERT INTO `tb_klasifikasi` (`id_klasifikasi`, `klasifikasi`, `ket_klasifikasi`, `stat_klasifikasi`, `tgl_buat`, `tgl_edit`, `id_user`) VALUES
(1, 'MANAGEMENT', '-', 'T', '2021-11-07 17:00:00', '1970-01-01 00:00:00', 1),
(2, 'PROFESIONAL', '-', 'T', '2021-11-07 17:00:00', '1970-01-01 00:00:00', 1),
(3, 'TEKNISI', '-', 'T', '2021-11-07 17:00:00', '1970-01-01 00:00:00', 1),
(4, 'ADMINISTRASI', '-', 'T', '2021-11-07 17:00:00', '1970-01-01 00:00:00', 1),
(7, 'TERAMPIL', '', 'T', '2021-11-07 17:00:00', '1970-01-01 00:00:00', 1),
(8, 'TIDAK TERAMPIL', '', 'T', '2021-11-07 17:00:00', '1970-01-01 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kontrak_karyawan`
--

CREATE TABLE `tb_kontrak_karyawan` (
  `id_kontrak_kary` int(11) NOT NULL,
  `id_kary` int(11) NOT NULL DEFAULT 0,
  `id_stat_perjanjian` int(11) NOT NULL DEFAULT 0,
  `tgl_mulai` date NOT NULL DEFAULT '1970-01-01',
  `tgl_akhir` date NOT NULL DEFAULT '1970-01-01',
  `ket_kontrak` varchar(1000) NOT NULL DEFAULT '0',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_kontrak_karyawan`
--

INSERT INTO `tb_kontrak_karyawan` (`id_kontrak_kary`, `id_kary`, `id_stat_perjanjian`, `tgl_mulai`, `tgl_akhir`, `ket_kontrak`, `tgl_buat`, `tgl_edit`, `id_user`) VALUES
(1, 1, 1, '2022-10-30', '1970-01-01', '', '2024-05-12 22:01:31', '2024-05-12 22:01:31', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kontrak_perusahaan`
--

CREATE TABLE `tb_kontrak_perusahaan` (
  `id_kontrak_perusahaan` int(11) NOT NULL,
  `id_m_perusahaan` int(11) NOT NULL DEFAULT 0,
  `id_perusahaan` int(11) NOT NULL DEFAULT 0,
  `no_kontrak_perusahaan` varchar(50) NOT NULL DEFAULT '',
  `ket_kontrak_perusahaan` varchar(1000) NOT NULL DEFAULT '',
  `tgl_mulai` date NOT NULL DEFAULT '1970-01-01',
  `tgl_akhir` date NOT NULL DEFAULT '1970-01-01',
  `url_doc_kontrak_perusahaan` varchar(500) NOT NULL DEFAULT '',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_ktp`
--

CREATE TABLE `tb_ktp` (
  `id_ktp` int(11) NOT NULL,
  `id_personal` int(11) NOT NULL DEFAULT 0,
  `url_ktp` varchar(1000) NOT NULL DEFAULT '',
  `stat_ktp` char(1) NOT NULL DEFAULT 'T',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_langgar`
--

CREATE TABLE `tb_langgar` (
  `id_langgar` int(11) NOT NULL,
  `id_kary` int(11) NOT NULL DEFAULT 0,
  `tgl_langgar` date NOT NULL DEFAULT '1970-01-01',
  `tgl_punishment` date NOT NULL DEFAULT '1970-01-01',
  `id_langgar_jenis` int(11) NOT NULL DEFAULT 0,
  `ket_langgar` varchar(2500) NOT NULL DEFAULT '',
  `url_langgar` varchar(1000) NOT NULL DEFAULT '',
  `tgl_akhir_langgar` date NOT NULL DEFAULT '1970-01-01',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_langgar`
--

INSERT INTO `tb_langgar` (`id_langgar`, `id_kary`, `tgl_langgar`, `tgl_punishment`, `id_langgar_jenis`, `ket_langgar`, `url_langgar`, `tgl_akhir_langgar`, `tgl_buat`, `tgl_edit`, `id_user`) VALUES
(1, 1, '2024-05-01', '2024-05-06', 2, 'Mangkir 1 Hari', '20240512221607-LGR.pdf', '2024-08-05', '2024-05-12 22:16:11', '2024-05-12 22:16:11', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_langgar_jenis`
--

CREATE TABLE `tb_langgar_jenis` (
  `id_langgar_jenis` int(11) NOT NULL,
  `kode_langgar_jenis` char(8) NOT NULL DEFAULT '',
  `langgar_jenis` varchar(100) NOT NULL DEFAULT '',
  `stat_langgar_jenis` char(1) NOT NULL DEFAULT 'T',
  `ket_langgar_jenis` varchar(2500) NOT NULL DEFAULT '',
  `durasi_langgar_jenis` int(11) NOT NULL DEFAULT 0,
  `jenis_durasi` varchar(20) NOT NULL,
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_langgar_jenis`
--

INSERT INTO `tb_langgar_jenis` (`id_langgar_jenis`, `kode_langgar_jenis`, `langgar_jenis`, `stat_langgar_jenis`, `ket_langgar_jenis`, `durasi_langgar_jenis`, `jenis_durasi`, `tgl_buat`, `tgl_edit`, `id_user`) VALUES
(1, 'ST', 'Surat Teguran', 'T', '', 3, 'month', '2023-10-05 00:00:00', '2023-10-05 00:00:00', 1),
(2, 'SP1', 'Surat Peringatan 1', 'T', '', 6, 'month', '2023-10-09 18:29:00', '2023-10-09 18:29:00', 1),
(3, 'SP2', 'Surat Peringatan 2', 'T', '', 6, 'month', '2023-10-09 18:29:00', '2023-10-09 18:29:00', 1),
(4, 'SP3', 'Surat Peringatan 3', 'T', '', 6, 'month', '2023-10-09 18:29:00', '2023-10-09 18:29:00', 1),
(5, 'SPT', 'Surat Peringatan Pertama & Terakhir', 'T', '', 6, 'month', '2023-10-09 18:29:00', '2023-10-09 18:29:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_level`
--

CREATE TABLE `tb_level` (
  `id_level` int(11) NOT NULL,
  `kd_level` varchar(10) NOT NULL,
  `level` varchar(100) NOT NULL,
  `ket_level` varchar(1000) NOT NULL,
  `stat_level` char(1) NOT NULL DEFAULT 'T',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0,
  `id_perusahaan` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_level`
--

INSERT INTO `tb_level` (`id_level`, `kd_level`, `level`, `ket_level`, `stat_level`, `tgl_buat`, `tgl_edit`, `id_user`, `id_perusahaan`) VALUES
(1, 'OFC', 'OFFICER', '', 'T', '2024-05-12 21:56:50', '2024-05-12 21:56:50', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_log`
--

CREATE TABLE `tb_log` (
  `id_log` int(11) NOT NULL,
  `user_log` char(200) NOT NULL,
  `tgl_log` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `ip_address_log` varchar(100) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_log`
--

INSERT INTO `tb_log` (`id_log`, `user_log`, `tgl_log`, `ip_address_log`) VALUES
(1, 'ihfan.noifara@ungguldinamika.co.id', '2024-05-12 14:33:28', '::1'),
(2, 'ihfan.noifara@ungguldinamika.co.id', '2024-05-12 15:32:18', '::1'),
(3, 'ihfan.noifara@ungguldinamika.co.id', '2024-05-12 15:34:37', '::1'),
(4, 'ihfan.noifara@ungguldinamika.co.id', '2024-05-12 21:50:36', '::1'),
(5, 'syarif.mamardi@ungguldinamika.co.id', '2024-05-12 23:23:23', '10.81.200.2'),
(6, 'ihfan.noifara@ungguldinamika.co.id', '2024-05-17 16:18:40', '10.81.200.2'),
(7, 'ihfan.noifara@ungguldinamika.co.id', '2024-05-17 16:21:09', '10.81.200.2'),
(8, 'kadek.ferliyawan@ungguldinamika.co.id', '2024-05-17 16:48:41', '192.168.158.72'),
(9, 'kadek.ferliyawan@ungguldinamika.co.id', '2024-05-17 16:57:07', '192.168.158.74'),
(10, 'kadek.ferliyawan@ungguldinamika.co.id', '2024-05-18 15:12:37', '192.168.158.72'),
(11, 'ihfan.noifara@ungguldinamika.co.id', '2024-05-18 15:13:16', '192.168.158.43'),
(12, 'ihfan.noifara@ungguldinamika.co.id', '2024-05-19 10:54:18', '192.168.120.16');

-- --------------------------------------------------------

--
-- Table structure for table `tb_lokasi_pjo`
--

CREATE TABLE `tb_lokasi_pjo` (
  `id_lokasi_pjo` int(11) NOT NULL,
  `lokasi_pjo` varchar(50) NOT NULL,
  `ket_lokasi_pjo` varchar(1000) NOT NULL,
  `stat_lokasi_pjo` char(1) NOT NULL DEFAULT 'T',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_lokasi_pjo`
--

INSERT INTO `tb_lokasi_pjo` (`id_lokasi_pjo`, `lokasi_pjo`, `ket_lokasi_pjo`, `stat_lokasi_pjo`, `tgl_buat`, `tgl_edit`, `id_user`) VALUES
(1, 'SITE', '', 'T', '1970-01-01 00:00:00', '1970-01-01 00:00:00', 1),
(2, 'PORT', '', 'T', '1970-01-01 00:00:00', '1970-01-01 00:00:00', 1),
(3, 'HAULING', '', 'T', '1970-01-01 00:00:00', '1970-01-01 00:00:00', 1),
(4, 'KM 33', '', 'T', '1970-01-01 00:00:00', '1970-01-01 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_lokker`
--

CREATE TABLE `tb_lokker` (
  `id_lokker` int(11) NOT NULL,
  `kd_lokker` varchar(10) NOT NULL DEFAULT '',
  `lokker` varchar(100) NOT NULL,
  `ket_lokker` varchar(1000) NOT NULL,
  `stat_lokker` char(1) NOT NULL DEFAULT 'T',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_lokker`
--

INSERT INTO `tb_lokker` (`id_lokker`, `kd_lokker`, `lokker`, `ket_lokker`, `stat_lokker`, `tgl_buat`, `tgl_edit`, `id_user`) VALUES
(1, 'PORT', 'PORT AREA', 'PT. SCCI', 'T', '2023-04-15 22:43:46', '2023-10-01 21:40:58', 1),
(2, 'KAL', 'KALIORANG', '', 'T', '2023-04-15 22:43:46', '2023-04-15 22:43:46', 1),
(4, 'SGT', 'SANGATTA', '', 'T', '2023-04-15 22:43:46', '2023-04-15 22:43:46', 1),
(5, 'PGD', 'PENGADAN', '', 'T', '2023-04-15 22:43:46', '2023-04-15 22:43:46', 1),
(6, 'CP33', 'CPP KM 33', '', 'T', '2023-04-15 22:43:46', '2023-04-15 22:43:46', 1),
(7, 'BLU', 'BLOK UTARA', '', 'T', '2023-04-15 22:43:46', '2023-06-24 14:55:24', 1),
(9, 'PIT', 'PIT AREA', '', 'T', '2023-04-15 22:43:46', '2023-04-15 22:43:46', 1),
(13, 'ALRE', 'ALL AREA', '', 'T', '2023-08-18 11:20:27', '2023-08-18 11:20:27', 7),
(14, 'KBN', 'KAUBUN', '', 'T', '2023-09-05 08:38:31', '2023-09-05 08:38:49', 33),
(16, 'KAL SKL', 'SANGKULIRANG KALIORANG', 'AKTIF', 'T', '2023-09-08 15:47:47', '2023-09-08 15:49:19', 49),
(19, 'KLM', 'KELAMPAIAN', '', 'T', '2023-10-25 15:02:43', '2023-10-25 15:02:43', 102),
(20, 'ASM', 'AREA PORT', '', 'T', '2023-11-07 13:19:55', '2023-11-07 13:20:36', 105),
(21, 'KM22', 'KM 22', '', 'T', '2023-11-13 15:11:18', '2023-11-13 15:11:18', 27),
(22, 'MGSHP', 'MEGASHOP', '', 'T', '2023-11-13 15:11:29', '2023-11-13 15:11:29', 27),
(23, 'WKSPTR', 'WORKSHOP TRACK', '', 'T', '2023-11-13 15:11:42', '2023-11-13 15:11:42', 27),
(24, 'WKSHPKPP', 'WORKSHOP KPP', 'WORKSHOP PT KPP', 'T', '2023-11-13 15:12:06', '2023-11-13 15:12:06', 27),
(25, 'KM19', 'KM 19', '', 'T', '2023-11-13 15:12:16', '2023-11-13 15:12:16', 27),
(26, 'OFFKPP', 'OFFICE KPP', 'OFFICE PT KPP', 'T', '2023-11-13 15:12:40', '2023-11-13 15:12:40', 27),
(27, 'BPP', 'BALIKPAPAN', 'Mess Balikpapan', 'T', '2024-03-20 08:40:04', '2024-03-20 08:40:04', 24);

-- --------------------------------------------------------

--
-- Table structure for table `tb_lokterima`
--

CREATE TABLE `tb_lokterima` (
  `id_lokterima` int(11) NOT NULL,
  `kd_lokterima` varchar(10) NOT NULL DEFAULT '',
  `lokterima` varchar(100) NOT NULL DEFAULT '',
  `jenis_lokasi` varchar(20) NOT NULL DEFAULT '',
  `ket_lokterima` varchar(1000) NOT NULL,
  `stat_lokterima` char(1) NOT NULL DEFAULT 'T',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0,
  `id_perusahaan` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_lokterima`
--

INSERT INTO `tb_lokterima` (`id_lokterima`, `kd_lokterima`, `lokterima`, `jenis_lokasi`, `ket_lokterima`, `stat_lokterima`, `tgl_buat`, `tgl_edit`, `id_user`, `id_perusahaan`) VALUES
(1, 'LRSU', 'RING I (KALIORANG/KARANGAN/KAUBUN/SANGKULIRANG)', 'LOKAL', '', 'T', '2023-04-15 22:37:37', '2023-04-15 22:37:37', 1, 0),
(2, 'LRDA', 'RING II (DAERAH KUTIM SELAIN DALAM RING I)', 'LOKAL', '', 'T', '2023-04-15 22:37:37', '2023-04-15 22:37:37', 1, 0),
(3, 'LRTA', 'RING III (DI LUAR KUTIM DAN DIDALAM KALTIM)', 'NONLOKAL', '', 'T', '2023-04-15 22:37:37', '2023-04-15 22:37:37', 1, 0),
(4, 'NLLK', 'RING IV (NASIONAL)', 'NONLOKAL', '', 'T', '2023-04-15 22:37:37', '2023-04-15 22:37:37', 1, 0),
(16, 'NSSL', 'NASIONAL', 'NONLOKAL', '', 'T', '2023-10-12 02:00:00', '2023-10-12 02:00:00', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_master`
--

CREATE TABLE `tb_master` (
  `id_master` int(11) NOT NULL,
  `kd_master` varchar(10) NOT NULL,
  `nama_master` varchar(200) NOT NULL,
  `jenis_master` varchar(50) NOT NULL,
  `ket_master` varchar(1000) NOT NULL,
  `stat_master` char(1) NOT NULL DEFAULT 'T',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_master`
--

INSERT INTO `tb_master` (`id_master`, `kd_master`, `nama_master`, `jenis_master`, `ket_master`, `stat_master`, `tgl_buat`, `tgl_edit`, `id_user`) VALUES
(1, 'RPTO', 'REPORT TO', 'APPROVAL', '', 'T', '2023-04-16 07:39:18', '2023-04-16 07:39:18', 1),
(2, 'MGRTO', 'MANAGER ONE UP', 'APPROVAL', '', 'T', '2023-04-16 07:39:18', '2023-04-16 07:39:18', 1),
(3, 'APP3', 'APPROVAL 3', 'APPROVAL', '', 'T', '2023-04-16 07:39:18', '2023-04-16 07:39:18', 1),
(4, 'APP4', 'APPROVAL 4', 'APPROVAL', '', 'T', '2023-04-16 07:39:18', '2023-04-16 07:39:18', 1),
(5, 'APP5', 'APPROVAL 5', 'APPROVAL', '', 'T', '2023-04-16 07:39:18', '2023-04-16 07:39:18', 1),
(6, 'SMI', 'Suami', 'HUBUNGAN', '', 'T', '2023-04-16 07:39:18', '2023-04-16 07:39:18', 1),
(7, 'IST', 'Istri', 'HUBUNGAN', '', 'T', '2023-04-16 07:39:18', '2023-04-16 07:39:18', 1),
(8, 'ANK1', 'Anak Ke 1', 'HUBUNGAN', '', 'T', '2023-04-16 07:39:18', '2023-04-16 07:39:18', 1),
(9, 'ANK2', 'Anak Ke 2', 'HUBUNGAN', '', 'T', '2023-04-16 07:39:18', '2023-04-16 07:39:18', 1),
(10, 'ANK3', 'Anak Ke 3', 'HUBUNGAN', '', 'T', '2023-04-16 07:39:18', '2023-04-16 07:39:18', 1),
(11, 'ANK4', 'Anak Ke 4', 'HUBUNGAN', '', 'T', '2023-04-16 07:39:18', '2023-04-16 07:39:18', 1),
(12, 'ANK5', 'Anak Ke 5', 'HUBUNGAN', '', 'T', '2023-04-16 07:39:18', '2023-04-16 07:39:18', 1),
(13, 'ANK6', 'Anak Ke 6', 'HUBUNGAN', '', 'T', '2023-04-16 07:39:18', '2023-04-16 07:39:18', 1),
(14, 'ANK7', 'Anak Ke 7', 'HUBUNGAN', '', 'T', '2023-04-16 07:39:18', '2023-04-16 07:39:18', 1),
(15, 'AZC', 'ASTRAZENECA', 'JENIS VAKSIN', '', 'T', '2023-04-16 07:39:18', '2023-04-16 07:39:18', 1),
(16, 'MDR', 'MODERNA', 'JENIS VAKSIN', '', 'T', '2023-04-16 07:39:18', '2023-04-16 07:39:18', 1),
(17, 'PFZ', 'PFIZER', 'JENIS VAKSIN', '', 'T', '2023-04-16 07:39:18', '2023-04-16 07:39:18', 1),
(18, 'SNP', 'SINOPHARM', 'JENIS VAKSIN', '', 'T', '2023-04-16 07:39:18', '2023-04-16 07:39:18', 1),
(19, 'SNV', 'SINOVAC', 'JENIS VAKSIN', '', 'T', '2023-04-16 07:39:18', '2023-04-16 07:39:18', 1),
(20, 'V1', 'VAKSIN 1', 'VAKSIN', '', 'T', '2023-04-16 07:39:18', '2023-04-16 07:39:18', 1),
(21, 'V2', 'VAKSIN 2', 'VAKSIN', '', 'T', '2023-04-16 07:39:18', '2023-04-16 07:39:18', 1),
(22, 'VB1', 'BOOSTER 1', 'VAKSIN', '', 'T', '2023-04-16 07:39:18', '2023-04-16 07:39:18', 1),
(23, 'VB2', 'BOOSTER 2', 'VAKSIN', '', 'T', '2023-04-16 07:39:18', '2023-04-16 07:39:18', 1),
(24, 'BUD', 'BUDDHA', 'AGAMA', '', 'T', '2023-04-16 07:39:18', '2023-04-16 07:39:18', 1),
(25, 'HIN', 'HINDU', 'AGAMA', '', 'T', '2023-04-16 07:39:18', '2023-04-16 07:39:18', 1),
(26, 'ISL', 'ISLAM', 'AGAMA', '', 'T', '2023-04-16 07:39:18', '2023-04-16 07:39:18', 1),
(27, 'KAT', 'KATHOLIK', 'AGAMA', '', 'T', '2023-04-16 07:39:18', '2023-04-16 07:39:18', 1),
(28, 'KHO', 'KHONGHUCU', 'AGAMA', '', 'T', '2023-04-16 07:39:18', '2023-04-16 07:39:18', 1),
(29, 'KRS', 'KRISTEN', 'AGAMA', '', 'T', '2023-04-16 07:39:18', '2023-04-16 07:39:18', 1),
(30, 'NS', 'NON STAFF', 'STAFF', '', 'T', '2023-04-16 07:39:18', '2023-04-16 07:39:18', 1),
(31, 'SF', 'STAFF', 'STAFF', '', 'T', '2023-04-16 07:39:18', '2023-04-16 07:39:18', 1),
(32, 'cvx', 'COVOVAX', 'JENIS VAKSIN', '', 'T', '2023-04-16 07:39:18', '2023-04-16 07:39:18', 1),
(33, 'CRV', 'CORONAVAC', 'JENIS VAKSIN', '', 'T', '2023-04-16 07:39:18', '2023-04-16 07:39:18', 1),
(34, 'BFM', 'BIOFARMA', 'JENIS VAKSIN', '', 'T', '2023-04-16 07:39:18', '2023-04-16 07:39:18', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_mcu`
--

CREATE TABLE `tb_mcu` (
  `id_mcu` int(11) NOT NULL,
  `id_personal` int(11) NOT NULL DEFAULT 0,
  `id_mcu_jenis` int(5) NOT NULL DEFAULT 0,
  `tgl_mcu` date NOT NULL,
  `ket_mcu` varchar(2500) NOT NULL,
  `hasil_follow_up` varchar(2500) NOT NULL,
  `tgl_follow_up` date NOT NULL DEFAULT '1970-01-01',
  `tgl_akhir` date NOT NULL DEFAULT '1970-01-01',
  `url_file` varchar(500) NOT NULL,
  `stat_mcu` char(1) NOT NULL DEFAULT 'T',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_perusahaan` int(11) NOT NULL DEFAULT 0,
  `id_user` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_mcu_jenis`
--

CREATE TABLE `tb_mcu_jenis` (
  `id_mcu_jenis` int(11) NOT NULL,
  `mcu_jenis` varchar(100) NOT NULL DEFAULT '',
  `stat_mcu_jenis` char(1) NOT NULL DEFAULT 'T',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_mcu_jenis`
--

INSERT INTO `tb_mcu_jenis` (`id_mcu_jenis`, `mcu_jenis`, `stat_mcu_jenis`, `tgl_buat`, `tgl_edit`, `id_user`) VALUES
(1, 'FIT TO WORK', 'T', '1970-01-01 00:00:00', '1970-01-01 00:00:00', 1),
(2, 'FIT WITH NOTE', 'T', '1970-01-01 00:00:00', '1970-01-01 00:00:00', 1),
(6, 'UNFIT', 'T', '1970-01-01 00:00:00', '1970-01-01 00:00:00', 59);

-- --------------------------------------------------------

--
-- Table structure for table `tb_menu`
--

CREATE TABLE `tb_menu` (
  `IdMenu` int(11) NOT NULL,
  `NamaMenu` varchar(200) NOT NULL,
  `StatMenu` varchar(200) NOT NULL,
  `UnggahFile` char(1) NOT NULL DEFAULT '',
  `BukaFile` char(1) NOT NULL DEFAULT '',
  `TglJamBuat` datetime NOT NULL,
  `TglLastEdit` datetime NOT NULL,
  `IdUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_menu`
--

INSERT INTO `tb_menu` (`IdMenu`, `NamaMenu`, `StatMenu`, `UnggahFile`, `BukaFile`, `TglJamBuat`, `TglLastEdit`, `IdUser`) VALUES
(1, 'ADMINISTRATOR', 'AKTIF', 'Y', 'Y', '2022-04-17 06:59:29', '2022-04-17 06:59:30', 1),
(2, 'PERUSAHAAN', 'AKTIF', 'Y', 'Y', '2022-04-20 13:05:51', '2022-04-20 13:05:51', 1),
(3, 'KARYAWAN', 'AKTIF', 'Y', 'Y', '2022-04-28 22:57:31', '2022-04-28 22:57:31', 1),
(4, 'ALL', 'AKTIF', 'Y', 'Y', '2022-04-28 23:40:47', '2022-04-28 23:40:47', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_modul`
--

CREATE TABLE `tb_modul` (
  `IdModul` int(11) NOT NULL,
  `IdParent` int(11) NOT NULL,
  `NamaModule` varchar(250) NOT NULL,
  `UrlModule` varchar(250) NOT NULL,
  `LabelMenu` varchar(250) NOT NULL,
  `TbModule` varchar(250) NOT NULL,
  `IconModule` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_modul`
--

INSERT INTO `tb_modul` (`IdModul`, `IdParent`, `NamaModule`, `UrlModule`, `LabelMenu`, `TbModule`, `IconModule`) VALUES
(1, 0, 'Shortcut', 'datashortcut', 'Shortcut', '---', 'icon-arrow-up-right'),
(2, 1, 'Tambah Data', 'new', 'Tambah Karyawan', 'tambahdata', ''),
(3, 0, 'Data Perusahaan', 'dataperusahaan', 'Data Perusahaan', '', 'icon-home'),
(4, 3, 'Perusahaan', 'perusahaan', 'Perusahaan', 'perusahaan', ''),
(5, 3, 'Struktur Perusahaan', 'struktur', 'Struktur Perusahaan', 'struktur', ''),
(6, 0, 'Data Pekerjaan', 'datapekerjaan', 'Data Pekerjaan', '---', 'icon-share-2'),
(7, 6, 'Departemen', 'departemen', 'Departemen', 'departemen', ''),
(8, 6, 'Posisi', 'posisi', 'Posisi', 'posisi', ''),
(9, 6, 'Level', 'level', 'Level', 'level', ''),
(10, 6, 'Golongan', 'tipe', 'Golongan', 'golongan', ''),
(11, 0, 'Data Daerah', 'datadaerah', 'Data Daerah', '---', 'icon-map'),
(12, 11, 'Lokasi Kerja', 'lokasikerja', 'Lokasi Kerja', 'lokasikerja', ''),
(13, 11, 'Point of Hire', 'poh', 'Point of Hire', 'pointofhire', ''),
(14, 0, 'Data SIMPER', 'datasimper', 'Data SIMPER', '---', 'icon-check-square'),
(15, 14, 'Unit', 'unit', 'Unit', 'unit', ''),
(16, 0, 'Data Karyawan', 'datakaryawan', 'Data Karyawan', '---', 'icon-users'),
(17, 16, 'Karyawan', 'karyawan', 'Karyawan', 'Karyawan', ''),
(18, 16, 'Non-Aktif Karyawan', 'NonaktifKary', 'Non-Aktif Karyawan', 'nonaktifkaryawan', ''),
(19, 0, 'SIMPER/MP', 'datizin', 'SIMPER/MP', '---', 'icon-arrow-up-right'),
(20, 19, 'Pengajuan Izin', 'pengajuansm', 'Pengajuan Izin', 'Pengajuansm', ''),
(22, 0, 'Data Pelanggaran', 'datalanggar', 'Data Pelanggaran', '---', 'icon-alert-triangle'),
(23, 22, 'Pelanggaran', 'pelanggaran', 'Pelanggaran', 'pelanggaran', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_modul_role_menu`
--

CREATE TABLE `tb_modul_role_menu` (
  `id_modul_role_menu` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `id_modul_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_modul_role_menu`
--

INSERT INTO `tb_modul_role_menu` (`id_modul_role_menu`, `id_menu`, `id_modul_role`) VALUES
(1, 2, 3),
(2, 2, 4),
(3, 2, 5),
(4, 3, 1),
(5, 3, 2),
(6, 3, 6),
(7, 3, 7),
(8, 3, 8),
(9, 3, 9),
(10, 3, 10),
(11, 3, 11),
(12, 3, 12),
(13, 3, 13),
(14, 3, 14),
(15, 3, 15),
(16, 3, 16),
(17, 3, 17),
(18, 3, 18),
(19, 1, 1),
(20, 1, 2),
(21, 1, 3),
(22, 1, 4),
(23, 1, 5),
(24, 1, 6),
(25, 1, 7),
(26, 1, 8),
(27, 1, 9),
(28, 1, 10),
(29, 1, 11),
(30, 1, 12),
(31, 1, 13),
(32, 1, 14),
(33, 1, 15),
(34, 1, 16),
(35, 1, 17),
(36, 1, 18),
(44, 4, 1),
(45, 4, 2),
(46, 4, 3),
(47, 4, 4),
(48, 4, 5),
(49, 4, 6),
(50, 4, 7),
(51, 4, 8),
(52, 4, 9),
(53, 4, 10),
(54, 4, 11),
(55, 4, 12),
(56, 4, 13),
(57, 4, 14),
(58, 4, 15),
(59, 4, 16),
(60, 4, 17),
(61, 4, 18),
(71, 1, 22),
(72, 3, 22),
(73, 4, 22),
(74, 1, 23),
(75, 3, 23),
(76, 4, 23);

-- --------------------------------------------------------

--
-- Table structure for table `tb_m_jenis_usaha`
--

CREATE TABLE `tb_m_jenis_usaha` (
  `id_m_jenis_usaha` int(11) NOT NULL,
  `id_m_perusahaan` int(11) NOT NULL DEFAULT 0,
  `id_jenis_usaha` int(11) NOT NULL DEFAULT 0,
  `stat_m_jenis_usaha` char(1) NOT NULL DEFAULT 'T',
  `tgl_buat` date NOT NULL DEFAULT '1970-01-01',
  `tgl_edit` date NOT NULL DEFAULT '1970-01-01',
  `id_user` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_m_perusahaan`
--

CREATE TABLE `tb_m_perusahaan` (
  `id_m_perusahaan` int(11) NOT NULL,
  `id_parent` int(11) NOT NULL DEFAULT 0,
  `id_perusahaan` int(11) NOT NULL DEFAULT 0,
  `nama_m_perusahaan` varchar(200) NOT NULL,
  `id_jenis_perusahaan` int(11) NOT NULL DEFAULT 0,
  `stat_m_perusahaan` char(1) NOT NULL DEFAULT 'T',
  `url_rk3l` varchar(500) NOT NULL,
  `tgl_buat` datetime NOT NULL,
  `tgl_edit` datetime NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_m_perusahaan`
--

INSERT INTO `tb_m_perusahaan` (`id_m_perusahaan`, `id_parent`, `id_perusahaan`, `nama_m_perusahaan`, `id_jenis_perusahaan`, `stat_m_perusahaan`, `url_rk3l`, `tgl_buat`, `tgl_edit`, `id_user`) VALUES
(1, 0, 1, 'PT UNGGUL DINAMIKA UTAMA', 2, 'T', '', '2023-06-12 08:42:43', '2023-08-13 13:46:15', 1),
(173, 1, 85, 'PT GDSK', 3, 'T', '', '2023-06-12 08:42:43', '2023-06-12 08:42:43', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_paybase`
--

CREATE TABLE `tb_paybase` (
  `id_paybase` int(11) NOT NULL,
  `kd_paybase` varchar(10) NOT NULL,
  `paybase` varchar(100) NOT NULL,
  `ket_paybase` varchar(1000) NOT NULL,
  `stat_paybase` char(1) NOT NULL DEFAULT 'T',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_perusahaan` int(11) NOT NULL DEFAULT 0,
  `id_user` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_paybase`
--

INSERT INTO `tb_paybase` (`id_paybase`, `kd_paybase`, `paybase`, `ket_paybase`, `stat_paybase`, `tgl_buat`, `tgl_edit`, `id_perusahaan`, `id_user`) VALUES
(1, 'JKT', 'Jakarta', '-', 'T', '2021-11-15 11:59:40', '1970-01-01 00:00:00', 1, 1),
(2, 'STE', 'Site', '-', 'T', '2021-11-15 11:59:56', '1970-01-01 00:00:00', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pekerjaan`
--

CREATE TABLE `tb_pekerjaan` (
  `id_pekerjaan` int(11) NOT NULL,
  `id_depart` int(11) NOT NULL DEFAULT 0,
  `id_section` int(11) NOT NULL DEFAULT 0,
  `id_posisi` int(11) NOT NULL DEFAULT 0,
  `id_grade` int(11) NOT NULL DEFAULT 0,
  `id_level` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pendidikan`
--

CREATE TABLE `tb_pendidikan` (
  `id_pendidikan` int(11) NOT NULL,
  `pendidikan` varchar(200) NOT NULL DEFAULT '',
  `ket_pendidikan` varchar(1000) NOT NULL DEFAULT '',
  `stat_pendidikan` char(1) NOT NULL DEFAULT 'T',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_pendidikan`
--

INSERT INTO `tb_pendidikan` (`id_pendidikan`, `pendidikan`, `ket_pendidikan`, `stat_pendidikan`, `tgl_buat`, `tgl_edit`, `id_user`) VALUES
(1, 'SD', '', 'T', '2022-10-02 00:00:00', '2022-10-02 00:00:00', 1),
(2, 'SMP', '', 'T', '2022-10-02 00:00:00', '2022-10-02 00:00:00', 1),
(4, 'SMA/K', '', 'T', '2022-10-02 00:00:00', '2022-10-02 00:00:00', 1),
(8, 'PAKET C', '', 'T', '2022-10-02 00:00:00', '2022-10-02 00:00:00', 1),
(9, 'DIPLOMA 1', '', 'T', '2022-10-02 00:00:00', '2022-10-02 00:00:00', 1),
(10, 'DIPLOMA 2', '', 'T', '2022-10-02 00:00:00', '2022-10-02 00:00:00', 1),
(11, 'DIPLOMA 3', '', 'T', '2022-10-02 00:00:00', '2022-10-02 00:00:00', 1),
(12, 'DIPLOMA 4', '', 'T', '2022-10-02 00:00:00', '2022-10-02 00:00:00', 1),
(13, 'STRATA 1', '', 'T', '2022-10-02 00:00:00', '2022-10-02 00:00:00', 1),
(14, 'STRATA 2', '', 'T', '0000-00-00 00:00:00', '2022-10-02 00:00:00', 1),
(15, 'STRATA 3', '', 'T', '0000-00-00 00:00:00', '2022-10-02 00:00:00', 1),
(16, 'TIDAK TAMAT SD', '', 'T', '2023-11-02 18:32:00', '2023-11-02 18:32:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_personal`
--

CREATE TABLE `tb_personal` (
  `id_personal` int(11) NOT NULL,
  `no_ktp` varchar(50) NOT NULL,
  `no_kk` varchar(50) NOT NULL,
  `nama_lengkap` varchar(200) NOT NULL,
  `nama_alias` varchar(200) NOT NULL,
  `jk` varchar(15) NOT NULL DEFAULT '',
  `tmp_lahir` varchar(100) NOT NULL DEFAULT '',
  `tgl_lahir` date NOT NULL DEFAULT '1970-01-01',
  `id_stat_nikah` int(11) NOT NULL DEFAULT 0,
  `id_agama` int(11) NOT NULL DEFAULT 0,
  `warga_negara` char(5) NOT NULL DEFAULT '',
  `email_pribadi` varchar(100) NOT NULL DEFAULT '',
  `hp_1` varchar(15) NOT NULL DEFAULT '',
  `hp_2` varchar(15) NOT NULL DEFAULT '',
  `nama_ibu` varchar(100) NOT NULL,
  `stat_ibu` char(1) NOT NULL DEFAULT 'H',
  `nama_ayah` varchar(100) NOT NULL,
  `stat_ayah` char(1) NOT NULL DEFAULT 'H',
  `no_bpjstk` varchar(25) NOT NULL,
  `no_bpjskes` varchar(25) NOT NULL,
  `no_bpjspensiun` varchar(25) NOT NULL,
  `no_equity` varchar(25) NOT NULL,
  `no_npwp` varchar(25) NOT NULL,
  `id_pendidikan` int(11) NOT NULL DEFAULT 0,
  `nama_sekolah` varchar(200) NOT NULL,
  `fakultas` varchar(200) NOT NULL,
  `jurusan` varchar(200) NOT NULL,
  `url_pendukung` varchar(200) NOT NULL,
  `tgl_buat` datetime NOT NULL,
  `tgl_edit` datetime NOT NULL,
  `id_user` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_personal`
--

INSERT INTO `tb_personal` (`id_personal`, `no_ktp`, `no_kk`, `nama_lengkap`, `nama_alias`, `jk`, `tmp_lahir`, `tgl_lahir`, `id_stat_nikah`, `id_agama`, `warga_negara`, `email_pribadi`, `hp_1`, `hp_2`, `nama_ibu`, `stat_ibu`, `nama_ayah`, `stat_ayah`, `no_bpjstk`, `no_bpjskes`, `no_bpjspensiun`, `no_equity`, `no_npwp`, `id_pendidikan`, `nama_sekolah`, `fakultas`, `jurusan`, `url_pendukung`, `tgl_buat`, `tgl_edit`, `id_user`) VALUES
(1, '6472040710840004', '6472040710840004', 'IHFAN NOIFARA', '', 'LK', 'SAMARINDA', '1984-10-07', 2, 3, 'WNI', 'ihf4nnoifara@gmail.com', '082155553600', '0', 'WAHYUNI', 'H', 'ZAM ZAM', 'H', '', '', '', '', '', 9, 'GHANESA COLLEGE', '', 'PROGRAMMER', '20240512221454-SUPPORT.pdf', '2024-05-12 22:01:25', '2024-05-12 22:15:00', 1),
(2, '6472040710840004', '6472040710840004', 'YEREMIA SIBURIAN', '', 'LK', 'SAMARINDA', '1984-10-07', 2, 3, 'WNI', 'ihf4nnoifara@gmail.com', '082155553600', '0', 'WAHYUNI', 'H', 'ZAM ZAM', 'H', '', '', '', '', '', 9, 'GHANESA COLLEGE', '', 'PROGRAMMER', '20240512221454-SUPPORT.pdf', '2024-05-12 22:01:25', '2024-05-12 22:15:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_perusahaan`
--

CREATE TABLE `tb_perusahaan` (
  `id_perusahaan` int(11) NOT NULL,
  `id_parent` int(11) NOT NULL DEFAULT 0,
  `kode_perusahaan` varchar(10) NOT NULL DEFAULT '',
  `nama_perusahaan` varchar(100) NOT NULL DEFAULT '',
  `alamat_perusahaan` varchar(1000) NOT NULL DEFAULT '',
  `kel_perusahaan` varchar(12) NOT NULL DEFAULT '',
  `kec_perusahaan` varchar(9) NOT NULL DEFAULT '',
  `kab_perusahaan` varchar(6) NOT NULL DEFAULT '',
  `prov_perusahaan` varchar(3) NOT NULL DEFAULT '',
  `kodepos_perusahaan` int(7) NOT NULL DEFAULT 0,
  `telp_perusahaan` varchar(10) NOT NULL DEFAULT '',
  `email_perusahaan` varchar(100) NOT NULL DEFAULT '',
  `website_perusahaan` varchar(100) NOT NULL DEFAULT '',
  `npwp_perusahaan` varchar(20) NOT NULL DEFAULT '',
  `stat_perusahaan` char(1) NOT NULL DEFAULT 'T',
  `ket_perusahaan` varchar(1000) NOT NULL DEFAULT '',
  `kegiatan` varchar(1000) NOT NULL DEFAULT '',
  `url_rk3l` varchar(250) NOT NULL DEFAULT '',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_perusahaan`
--

INSERT INTO `tb_perusahaan` (`id_perusahaan`, `id_parent`, `kode_perusahaan`, `nama_perusahaan`, `alamat_perusahaan`, `kel_perusahaan`, `kec_perusahaan`, `kab_perusahaan`, `prov_perusahaan`, `kodepos_perusahaan`, `telp_perusahaan`, `email_perusahaan`, `website_perusahaan`, `npwp_perusahaan`, `stat_perusahaan`, `ket_perusahaan`, `kegiatan`, `url_rk3l`, `tgl_buat`, `tgl_edit`, `id_user`) VALUES
(1, 0, 'PT. UNGGUL', 'PT UNGGUL DINAMIKA UTAMA', 'Kaliorang', '6404051001', '6404051', '6404', '64', 0, '', '', '', '', 'T', '', '', '', '2023-06-12 08:30:23', '2023-06-12 08:30:23', 1),
(85, 0, 'PT GDSK', 'PT GDSK', 'Kaliorang', '6404051001', '6404051', '6404', '64', 0, '', '', '', '', 'T', '', '', '', '1970-01-01 00:00:00', '1970-01-01 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pjo_perusahaan`
--

CREATE TABLE `tb_pjo_perusahaan` (
  `id_pjo_perusahaan` int(11) NOT NULL,
  `id_m_perusahaan` int(11) NOT NULL DEFAULT 0,
  `id_lokasi` int(11) NOT NULL DEFAULT 0,
  `id_karyawan` int(11) NOT NULL DEFAULT 0,
  `no_pengesahan_pjo` varchar(100) NOT NULL,
  `tgl_aktif_pjo` date NOT NULL DEFAULT '1970-01-01',
  `tgl_akhir_pjo` date NOT NULL DEFAULT '1970-01-01',
  `url_pengesahan_pjo` varchar(1000) NOT NULL,
  `ket_pjo` varchar(1000) NOT NULL,
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_poh`
--

CREATE TABLE `tb_poh` (
  `id_poh` int(11) NOT NULL,
  `kd_poh` varchar(10) NOT NULL,
  `poh` varchar(100) NOT NULL,
  `ket_poh` varchar(1000) NOT NULL,
  `stat_poh` char(1) NOT NULL DEFAULT 'T',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_poh`
--

INSERT INTO `tb_poh` (`id_poh`, `kd_poh`, `poh`, `ket_poh`, `stat_poh`, `tgl_buat`, `tgl_edit`, `id_user`) VALUES
(1, 'AMB', 'AMBON', '', 'T', '2023-04-15 22:51:19', '2023-06-24 14:59:49', 1),
(2, 'BAC', 'BANDA ACEH', '', 'T', '2023-04-15 22:51:19', '2023-04-15 22:51:19', 1),
(3, 'BALI', 'BALI', '', 'T', '2023-04-15 22:51:19', '2023-06-24 14:59:55', 1),
(4, 'BDG', 'BANDUNG', '', 'T', '2023-04-15 22:51:19', '2023-04-15 22:51:19', 1),
(5, 'BGL', 'BENGALON', '', 'T', '2023-04-15 22:51:19', '2023-04-15 22:51:19', 1),
(6, 'BGR', 'BOGOR', '', 'T', '2023-04-15 22:51:19', '2023-04-15 22:51:19', 1),
(7, 'BIMA', 'BIMA', '', 'T', '2023-04-15 22:51:19', '2023-04-15 22:51:19', 1),
(8, 'BJB', 'BANJARBARU', '', 'T', '2023-04-15 22:51:19', '2023-04-15 22:51:19', 1),
(9, 'BJM', 'BANJARMASIN', '', 'T', '2023-04-15 22:51:19', '2023-04-15 22:51:19', 1),
(10, 'BKS', 'BEKASI', '', 'T', '2023-04-15 22:51:19', '2023-04-15 22:51:19', 1),
(11, 'BLM', 'BANDAR LAMPUNG', '', 'T', '2023-04-15 22:51:19', '2023-04-15 22:51:19', 1),
(12, 'BPN', 'BALIKPAPAN', '', 'T', '2023-04-15 22:51:19', '2023-04-15 22:51:19', 1),
(13, 'BTG', 'BONTANG', '', 'T', '2023-04-15 22:51:19', '2023-04-15 22:51:19', 1),
(14, 'BYW', 'BANYUWANGI', '', 'T', '2023-04-15 22:51:19', '2023-04-15 22:51:19', 1),
(15, 'CLP', 'CILACAP', '', 'T', '2023-04-15 22:51:19', '2023-04-15 22:51:19', 1),
(16, 'CRB', 'CIREBON', '', 'T', '2023-04-15 22:51:19', '2023-04-15 22:51:19', 1),
(17, 'DPK', 'DEPOK', '', 'T', '2023-04-15 22:51:19', '2023-04-15 22:51:19', 1),
(18, 'JKT', 'JAKARTA', '', 'T', '2023-04-15 22:51:19', '2023-04-15 22:51:19', 1),
(19, 'JMB', 'JAMBI', '', 'T', '2023-04-15 22:51:19', '2023-04-15 22:51:19', 1),
(20, 'JBR', 'JEMBER', '', 'T', '2023-04-15 22:51:19', '2023-04-15 22:51:19', 1),
(21, 'KBN', 'KEBUMEN', '', 'T', '2023-04-15 22:51:19', '2023-04-15 22:51:19', 1),
(22, 'KDR', 'KEDIRI', '', 'T', '2023-04-15 22:51:19', '2023-04-15 22:51:19', 1),
(23, 'KND', 'KENDARI', '', 'T', '2023-04-15 22:51:19', '2023-04-15 22:51:19', 1),
(24, 'KNG', 'KUNINGAN', '', 'T', '2023-04-15 22:51:19', '2023-04-15 22:51:19', 1),
(25, 'KPG', 'KUPANG', '', 'T', '2023-04-15 22:51:19', '2023-04-15 22:51:19', 1),
(26, 'KRA', 'KARANGANYAR', '', 'T', '2023-04-15 22:51:19', '2023-04-15 22:51:19', 1),
(27, 'KTP', 'KETAPANG', '', 'T', '2023-04-15 22:51:19', '2023-04-15 22:51:19', 1),
(28, 'LBM', 'LOKAL - BUKIT MAKMUR', '', 'T', '2023-04-15 22:51:19', '2023-04-15 22:51:19', 1),
(29, 'LKB', 'LOKAL - KAUBUN', '', 'T', '2023-04-15 22:51:19', '2023-04-15 22:51:19', 1),
(30, 'LKL', 'LOKAL', '', 'T', '2023-04-15 22:51:19', '2023-04-15 22:51:19', 1),
(31, 'LKLG', 'LOKAL - KALIORANG', '', 'T', '2023-04-15 22:51:19', '2023-04-15 22:51:19', 1),
(32, 'LKRG', 'LOKAL - KARANGAN', '', 'T', '2023-04-15 22:51:19', '2023-04-15 22:51:19', 1),
(33, 'LMB', 'LOMBOK', '', 'T', '2023-04-15 22:51:19', '2023-04-15 22:51:19', 1),
(34, 'LPG', 'LAMPUNG', '', 'T', '2023-04-15 22:51:19', '2023-04-15 22:51:19', 1),
(35, 'LPGD', 'LOKAL - PENGADAN', '', 'T', '2023-04-15 22:51:19', '2023-04-15 22:51:19', 1),
(36, 'LSLG', 'LOKAL - SELANGKAU', '', 'T', '2023-04-15 22:51:19', '2023-04-15 22:51:19', 1),
(37, 'MDM', 'MADIUN', '', 'T', '2023-04-15 22:51:19', '2023-04-15 22:51:19', 1),
(38, 'MDN', 'MEDAN', '', 'T', '2023-04-15 22:51:19', '2023-04-15 22:51:19', 1),
(39, 'MKS', 'MAKASSAR', '', 'T', '2023-04-15 22:51:19', '2023-04-15 22:51:19', 1),
(40, 'MLG', 'MALANG', '', 'T', '2023-04-15 22:51:19', '2023-04-15 22:51:19', 1),
(41, 'MLK', 'MELAK', '', 'T', '2023-04-15 22:51:19', '2023-04-15 22:51:19', 1),
(42, 'MMJ', 'MAMUJU', '', 'T', '2023-04-15 22:51:19', '2023-04-15 22:51:19', 1),
(43, 'MND', 'MANADO', '', 'T', '2023-04-15 22:51:19', '2023-04-15 22:51:19', 1),
(44, 'MTR', 'MATARAM', '', 'T', '2023-04-15 22:51:19', '2023-04-15 22:51:19', 1),
(45, 'PALU', 'PALU', '', 'T', '2023-04-15 22:51:19', '2023-04-15 22:51:19', 1),
(46, 'PATI', 'PATI', '', 'T', '2023-04-15 22:51:19', '2023-04-15 22:51:19', 1),
(47, 'PBLG', 'PURBALINGGA', '', 'T', '2023-04-15 22:51:19', '2023-04-15 22:51:19', 1),
(48, 'PDB', 'PADANG BATUNG', '', 'T', '2023-04-15 22:51:19', '2023-04-15 22:51:19', 1),
(49, 'PDG', 'PADANG', '', 'T', '2023-04-15 22:51:19', '2023-04-15 22:51:19', 1),
(50, 'PKL', 'PEKALONGAN', '', 'T', '2023-04-15 22:51:19', '2023-04-15 22:51:19', 1),
(51, 'PLK', 'PALANGKARAYA', '', 'T', '2023-04-15 22:51:19', '2023-04-15 22:51:19', 1),
(52, 'PLM', 'PALEMBANG', '', 'T', '2023-04-15 22:51:19', '2023-04-15 22:51:19', 1),
(53, 'PLP', 'PALOPO', '', 'T', '2023-04-15 22:51:19', '2023-04-15 22:51:19', 1),
(54, 'PML', 'PEMALANG', '', 'T', '2023-04-15 22:51:19', '2023-04-15 22:51:19', 1),
(55, 'PTK', 'PONTIANAK', '', 'T', '2023-04-15 22:51:19', '2023-04-15 22:51:19', 1),
(56, 'RIAU', 'RIAU', '', 'T', '2023-04-15 22:51:19', '2023-04-15 22:51:19', 1),
(57, 'SBY', 'SURABAYA', '', 'T', '2023-04-15 22:51:19', '2023-04-15 22:51:19', 1),
(58, 'SDJ', 'SIDOARJO', '', 'T', '2023-04-15 22:51:19', '2023-04-15 22:51:19', 1),
(59, 'SGT', 'SANGATTA', '', 'T', '2023-04-15 22:51:19', '2023-04-15 22:51:19', 1),
(60, 'SKJ', 'SUKOHARJO', '', 'T', '2023-04-15 22:51:19', '2023-04-15 22:51:19', 1),
(61, 'SMD', 'SAMARINDA', 'PT. SCCI', 'T', '2023-04-15 22:51:19', '2023-10-01 21:44:28', 1),
(62, 'SMR', 'SEMARANG', '', 'T', '2023-04-15 22:51:19', '2023-04-15 22:51:19', 1),
(63, 'TGR', 'TENGGARONG', '', 'T', '2023-04-15 22:51:19', '2023-04-15 22:51:19', 1),
(64, 'TGT', 'TANAH GROGOT', '', 'T', '2023-04-15 22:51:19', '2023-04-15 22:51:19', 1),
(65, 'TRG', 'TANGERANG', '', 'T', '2023-04-15 22:51:19', '2023-04-15 22:51:19', 1),
(66, 'TRJU', 'TORAJA UTARA', '', 'T', '2023-04-15 22:51:19', '2023-04-15 22:51:19', 1),
(67, 'YGY', 'YOGYAKARTA', '', 'T', '1970-01-01 00:00:00', '2023-10-25 12:05:52', 1),
(70, 'KLG', 'KALIORANG', '', 'T', '2023-08-23 10:56:47', '2023-09-05 08:39:40', 7),
(72, 'SKL', 'SANGKULIRANG', 'AKTIF', 'T', '2023-09-08 15:51:45', '2023-09-08 15:51:45', 49),
(73, 'KLT', 'KALIMANTAN TIMUR', '', 'T', '2023-09-10 10:36:15', '2023-09-10 10:36:15', 53),
(75, 'TRK', 'TARAKAN', '', 'T', '2023-10-12 02:43:07', '2023-10-12 02:43:07', 1),
(76, 'KTG', 'KATINGAN', '', 'T', '2023-10-12 02:44:01', '2023-10-12 02:44:01', 1),
(77, 'PRW', 'PURWAKARTA', '', 'T', '2023-10-12 02:45:22', '2023-10-12 02:45:22', 1),
(78, 'MUT', 'MUARA TEWEH', '', 'T', '2023-10-12 02:46:04', '2023-10-12 02:46:04', 1),
(79, 'BGU', 'BENGKULU', '', 'T', '2023-10-12 02:47:31', '2023-10-12 02:47:31', 1),
(80, 'STG', 'SALATIGA', '', 'T', '2023-10-25 13:29:08', '2023-10-25 13:29:08', 102),
(81, 'SBM', 'SUKABUMI', '', 'T', '2023-10-25 13:31:34', '2023-10-25 13:31:34', 102),
(82, 'GRS', 'GRESIK', '', 'T', '2023-10-25 13:32:00', '2023-10-25 13:32:00', 102),
(83, 'BLG', 'BULUNGAN', '', 'T', '2023-10-25 13:32:31', '2023-10-25 13:32:31', 102),
(84, 'SBW', 'SUMBAWA', '', 'T', '2023-10-25 13:32:44', '2023-10-25 13:32:44', 102),
(85, 'SLM', 'SLEMAN', '', 'T', '2023-10-25 14:41:24', '2023-10-25 14:41:24', 102),
(86, 'LWK', 'LUWUK', '', 'T', '2023-10-25 14:41:33', '2023-10-25 14:41:33', 102),
(87, 'TTR', 'TANA TORAJA', '', 'T', '2023-10-25 14:41:46', '2023-10-25 14:41:46', 102),
(88, 'TLG', 'TULUNGAGUNG', '', 'T', '2023-10-25 14:42:07', '2023-10-25 14:42:07', 102),
(89, 'PSR', 'PASER', '', 'T', '2023-10-25 14:42:55', '2023-10-25 14:42:55', 102),
(90, 'BLR', 'BLORA', '', 'T', '2023-10-25 14:43:06', '2023-10-25 14:43:06', 102),
(91, 'ENRK', 'ENREKANG', '', 'T', '2023-10-25 14:43:24', '2023-10-25 14:43:24', 102),
(92, 'PBR', 'PROBOLINGGO', '', 'T', '2023-10-25 14:43:35', '2023-10-25 14:43:35', 102),
(93, 'SOLO', 'SOLO', '', 'T', '2023-10-25 14:43:42', '2023-10-25 14:43:42', 102),
(94, 'MRS', 'MAROS', '', 'T', '2023-10-25 14:43:50', '2023-10-25 14:43:50', 102),
(95, 'BLT', 'BLITAR', '', 'T', '2023-10-25 14:46:47', '2023-10-25 14:46:47', 102),
(96, 'WNG', 'WONOGIRI', '', 'T', '2023-10-25 14:47:04', '2023-10-25 14:47:04', 102),
(97, 'MW', 'MUARA WAHAU', '', 'T', '2024-01-03 09:27:05', '2024-01-03 09:27:05', 24),
(98, 'TPN', 'TAPIN', '', 'T', '2024-01-08 14:16:16', '2024-01-08 14:16:16', 59),
(99, 'LRH', 'LOREH', '', 'T', '2024-01-08 14:18:08', '2024-01-08 14:18:08', 59),
(100, 'KTT', 'KUTAI TIMUR', '', 'T', '2024-01-08 14:18:28', '2024-01-08 14:18:28', 59),
(101, 'BRT', 'BARITO TIMUR', '', 'T', '2024-01-08 14:19:47', '2024-01-08 14:19:47', 59),
(102, 'BHT', 'BUHUT', '', 'T', '2024-01-08 14:19:56', '2024-01-08 14:19:56', 59),
(103, 'MUB', 'MUARA BAKAH', '', 'T', '2024-01-08 14:21:05', '2024-01-08 14:21:05', 59),
(104, 'TNB', 'TANAH BUMBU', '', 'T', '2024-01-08 14:22:39', '2024-01-08 14:22:39', 59),
(105, 'TNL', 'TANAH LAUT', '', 'T', '2024-01-08 14:23:44', '2024-01-08 14:23:44', 59),
(106, 'PKNBR', 'PEKANBARU', '', 'T', '2024-02-17 08:21:09', '2024-02-17 08:21:09', 24),
(107, 'BR', 'BERAU', '', 'T', '2024-02-17 08:36:43', '2024-02-17 08:36:43', 24),
(108, 'DMP', 'DOMPU', '', 'T', '2024-04-20 10:40:08', '2024-04-20 10:40:08', 59);

-- --------------------------------------------------------

--
-- Table structure for table `tb_posisi`
--

CREATE TABLE `tb_posisi` (
  `id_posisi` int(11) NOT NULL,
  `posisi` varchar(150) NOT NULL,
  `id_depart` char(5) NOT NULL DEFAULT '',
  `ket_posisi` varchar(1000) NOT NULL,
  `stat_posisi` char(1) NOT NULL DEFAULT '',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0,
  `id_perusahaan` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_posisi`
--

INSERT INTO `tb_posisi` (`id_posisi`, `posisi`, `id_depart`, `ket_posisi`, `stat_posisi`, `tgl_buat`, `tgl_edit`, `id_user`, `id_perusahaan`) VALUES
(1557, 'PROGRAMMER DEVELOPMENT', '4', '', 'T', '2024-05-12 21:56:32', '2024-05-12 21:56:32', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_roster`
--

CREATE TABLE `tb_roster` (
  `id_roster` int(11) NOT NULL,
  `kd_roster` varchar(10) NOT NULL DEFAULT '',
  `roster` varchar(100) NOT NULL DEFAULT '',
  `jml_hari_onsite` int(4) NOT NULL DEFAULT 0,
  `jml_hari_offsite` int(4) NOT NULL DEFAULT 0,
  `ket_roster` varchar(1000) NOT NULL DEFAULT '',
  `stat_roster` char(1) NOT NULL DEFAULT 'T',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(5) NOT NULL DEFAULT 0,
  `id_perusahaan` int(5) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_roster`
--

INSERT INTO `tb_roster` (`id_roster`, `kd_roster`, `roster`, `jml_hari_onsite`, `jml_hari_offsite`, `ket_roster`, `stat_roster`, `tgl_buat`, `tgl_edit`, `id_user`, `id_perusahaan`) VALUES
(1, '62W', '6 - 2 WEEK', 42, 14, '', 'T', '2023-04-15 11:00:00', '2023-04-13 14:16:31', 1, 1),
(2, '102W', '10 - 2 WEEK', 70, 14, '', 'T', '2023-04-15 11:00:00', '2023-04-13 13:28:54', 1, 1),
(3, '82W', '8 - 2 WEEK', 56, 14, '', 'T', '1970-01-01 00:00:00', '1970-01-01 00:00:00', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_sanksi`
--

CREATE TABLE `tb_sanksi` (
  `id_sanksi` int(11) NOT NULL,
  `kd_sanksi` varchar(10) NOT NULL DEFAULT '',
  `sanksi` varchar(100) NOT NULL DEFAULT '',
  `jml_hari_berlaku` int(5) NOT NULL,
  `ket_sanksi` varchar(1000) NOT NULL DEFAULT '',
  `stat_sanksi` char(1) NOT NULL DEFAULT 'T',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_sanksi`
--

INSERT INTO `tb_sanksi` (`id_sanksi`, `kd_sanksi`, `sanksi`, `jml_hari_berlaku`, `ket_sanksi`, `stat_sanksi`, `tgl_buat`, `tgl_edit`, `id_user`) VALUES
(1, 'ST', 'SURAT TEGURAN', 30, '', 'T', '1970-01-01 00:00:00', '1970-01-01 00:00:00', 1),
(2, 'SP1', 'SURAT PERINGATAN KE 1', 90, '', 'T', '1970-01-01 00:00:00', '2023-04-13 10:04:57', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_section`
--

CREATE TABLE `tb_section` (
  `id_section` int(11) NOT NULL,
  `kd_section` varchar(8) NOT NULL,
  `section` varchar(100) NOT NULL,
  `id_depart` int(11) NOT NULL DEFAULT 0,
  `ket_section` varchar(300) NOT NULL,
  `stat_section` char(1) NOT NULL DEFAULT 'T',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0,
  `id_perusahaan` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_section`
--

INSERT INTO `tb_section` (`id_section`, `kd_section`, `section`, `id_depart`, `ket_section`, `stat_section`, `tgl_buat`, `tgl_edit`, `id_user`, `id_perusahaan`) VALUES
(1, 'IT', 'IT', 4, '', 'T', '2024-05-12 21:56:10', '2024-05-12 21:56:10', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_sertifikasi_kary`
--

CREATE TABLE `tb_sertifikasi_kary` (
  `id_sertifikasi` int(11) NOT NULL,
  `id_personal` int(11) NOT NULL DEFAULT 0,
  `id_jenis_sertifikasi` int(11) NOT NULL DEFAULT 0,
  `no_sertifikasi` varchar(100) NOT NULL DEFAULT '0',
  `lembaga` varchar(225) NOT NULL DEFAULT '-',
  `tgl_sertifikasi` date NOT NULL DEFAULT '1970-01-01',
  `tgl_berakhir_sertifikasi` date NOT NULL DEFAULT '1970-01-01',
  `file_sertifikasi` varchar(500) NOT NULL,
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tb_sim`
--

CREATE TABLE `tb_sim` (
  `id_sim` int(11) NOT NULL,
  `sim` varchar(50) NOT NULL,
  `ket_sim` varchar(1000) NOT NULL,
  `stat_sim` char(1) NOT NULL DEFAULT 'T',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_sim`
--

INSERT INTO `tb_sim` (`id_sim`, `sim`, `ket_sim`, `stat_sim`, `tgl_buat`, `tgl_edit`, `id_user`) VALUES
(2, 'SIM A', '-', 'T', '2021-11-07 17:00:00', '2023-06-24 15:01:49', 1),
(3, 'SIM B I', '-', 'T', '2021-11-07 17:00:00', '2023-05-23 00:00:00', 1),
(4, 'SIM B II', '-', 'T', '2021-11-07 17:00:00', '2023-05-23 00:00:00', 1),
(5, 'SIM A UMUM', '-', 'T', '2021-11-07 17:00:00', '2023-05-23 00:00:00', 1),
(6, 'SIM B I UMUM', '-', 'T', '2021-11-07 17:00:00', '2023-05-23 00:00:00', 1),
(7, 'SIM B II UMUM', '-', 'T', '2021-11-07 17:00:00', '2023-05-23 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_sim_karyawan`
--

CREATE TABLE `tb_sim_karyawan` (
  `id_sim_kary` int(11) NOT NULL,
  `id_personal` int(11) NOT NULL DEFAULT 0,
  `id_sim` int(11) NOT NULL DEFAULT 0,
  `tgl_exp_sim` date NOT NULL DEFAULT '1970-01-01',
  `ket_sim_kary` varchar(1000) NOT NULL DEFAULT '',
  `url_file` varchar(1000) NOT NULL DEFAULT '',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_sio_perusahaan`
--

CREATE TABLE `tb_sio_perusahaan` (
  `id_sio_perusahaan` int(11) NOT NULL,
  `id_m_perusahaan` int(11) NOT NULL DEFAULT 0,
  `no_sio_perusahaan` varchar(50) NOT NULL DEFAULT '',
  `tgl_mulai_sio` date NOT NULL DEFAULT '1970-01-01',
  `tgl_akhir_sio` date NOT NULL DEFAULT '1970-01-01',
  `url_sio` varchar(500) NOT NULL DEFAULT '',
  `ket_sio` varchar(1000) NOT NULL DEFAULT '',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_statpajak`
--

CREATE TABLE `tb_statpajak` (
  `id_statpajak` int(11) NOT NULL,
  `kd_statpajak` varchar(10) NOT NULL,
  `stat_pajak` varchar(100) NOT NULL,
  `ket_pajak` varchar(1000) NOT NULL,
  `stat_aktif_pajak` char(1) NOT NULL DEFAULT 'T',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_statpajak`
--

INSERT INTO `tb_statpajak` (`id_statpajak`, `kd_statpajak`, `stat_pajak`, `ket_pajak`, `stat_aktif_pajak`, `tgl_buat`, `tgl_edit`, `id_user`) VALUES
(1, 'K0', 'K0', '-', 'T', '2021-11-07 17:00:00', '1970-01-01 00:00:00', 1),
(2, 'K1', 'K1', '-', 'T', '2021-11-07 17:00:00', '1970-01-01 00:00:00', 1),
(3, 'K2', 'K2', '-', 'T', '2021-11-07 17:00:00', '1970-01-01 00:00:00', 1),
(4, 'K3', 'K3', '-', 'T', '2021-11-07 17:00:00', '1970-01-01 00:00:00', 1),
(5, 'TK0', 'TK0', '-', 'T', '2021-11-07 17:00:00', '1970-01-01 00:00:00', 1),
(6, 'TK1', 'TK1', '-', 'T', '2022-01-24 10:15:58', '1970-01-01 00:00:00', 1),
(7, 'TK2', 'TK2', '-', 'T', '2022-01-24 10:16:18', '1970-01-01 00:00:00', 1),
(8, 'TK3', 'TK3', '-', 'T', '2022-01-24 10:16:39', '1970-01-01 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_stat_nikah`
--

CREATE TABLE `tb_stat_nikah` (
  `id_stat_nikah` int(11) NOT NULL,
  `kode_stat_nikah` varchar(20) NOT NULL,
  `stat_nikah` varchar(50) NOT NULL,
  `ket_nikah` varchar(1000) NOT NULL,
  `stat_aktif_nikah` char(1) NOT NULL DEFAULT 'T',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_stat_nikah`
--

INSERT INTO `tb_stat_nikah` (`id_stat_nikah`, `kode_stat_nikah`, `stat_nikah`, `ket_nikah`, `stat_aktif_nikah`, `tgl_buat`, `tgl_edit`, `id_user`) VALUES
(1, 'BKW', 'BELUM KAWIN', '-', 'T', '2021-11-07 17:00:00', '1970-01-01 00:00:00', 1),
(2, 'KWN', 'KAWIN', '-', 'T', '2021-11-07 17:00:00', '1970-01-01 00:00:00', 1),
(7, 'CRH', 'CERAI HIDUP', '', 'T', '2023-09-07 07:55:00', '2023-09-07 07:55:00', 1),
(8, 'CRM', 'CERAI MATI', '', 'T', '2023-09-07 07:55:00', '2023-09-07 07:55:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_stat_perjanjian`
--

CREATE TABLE `tb_stat_perjanjian` (
  `id_stat_perjanjian` int(11) NOT NULL,
  `stat_perjanjian` varchar(50) NOT NULL,
  `ket_stat_perjanjian` varchar(200) NOT NULL,
  `stat_stat_perjanjian` char(1) NOT NULL DEFAULT 'T',
  `stat_waktu` char(1) NOT NULL DEFAULT 'T',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_stat_perjanjian`
--

INSERT INTO `tb_stat_perjanjian` (`id_stat_perjanjian`, `stat_perjanjian`, `ket_stat_perjanjian`, `stat_stat_perjanjian`, `stat_waktu`, `tgl_buat`, `tgl_edit`, `id_user`) VALUES
(1, 'PKWTT PERMANEN', '-', 'T', 'F', '2021-11-08 12:53:25', '2023-04-13 07:56:07', 1),
(3, 'PKWTT PROBATION', '-', 'T', 'T', '2021-11-15 11:36:04', '2023-04-13 07:56:07', 1),
(13, 'PKWT', '', 'T', 'T', '2023-06-07 14:29:34', '2023-06-07 14:29:34', 1),
(14, 'PKWT KHUSUS', '-', 'T', 'T', '2023-10-12 07:00:00', '2023-10-12 07:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_stat_tinggal`
--

CREATE TABLE `tb_stat_tinggal` (
  `id_stat_tinggal` int(11) NOT NULL,
  `stat_tinggal` varchar(20) NOT NULL DEFAULT '',
  `ket_stat_tinggal` varchar(1000) NOT NULL DEFAULT '',
  `status_tinggal` char(1) NOT NULL DEFAULT 'T',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_stat_tinggal`
--

INSERT INTO `tb_stat_tinggal` (`id_stat_tinggal`, `stat_tinggal`, `ket_stat_tinggal`, `status_tinggal`, `tgl_buat`, `tgl_edit`, `id_user`) VALUES
(1, 'RESIDENCE', '', 'T', '1970-01-01 00:00:00', '1970-01-01 00:00:00', 1),
(2, 'NON RESIDENCE', '', 'T', '1970-01-01 00:00:00', '1970-01-01 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_tipe`
--

CREATE TABLE `tb_tipe` (
  `id_tipe` int(11) NOT NULL,
  `tipe` varchar(50) NOT NULL,
  `ket_tipe` varchar(200) NOT NULL,
  `stat_tipe` char(1) NOT NULL DEFAULT 'T',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_tipe`
--

INSERT INTO `tb_tipe` (`id_tipe`, `tipe`, `ket_tipe`, `stat_tipe`, `tgl_buat`, `tgl_edit`, `id_user`) VALUES
(1, 'NON STAFF', '-', 'T', '2021-11-07 14:44:13', '2023-10-21 17:28:33', 1),
(2, 'STAFF', 'STAFF', 'T', '2021-11-07 14:43:41', '2023-09-08 10:32:33', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_tipe_akses_unit`
--

CREATE TABLE `tb_tipe_akses_unit` (
  `id_tipe_akses_unit` int(11) NOT NULL,
  `kode_tipe_akses_unit` char(5) NOT NULL,
  `tipe_akses_unit` varchar(50) NOT NULL DEFAULT '',
  `ket_tipe_akses_unit` varchar(1000) NOT NULL DEFAULT '',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_tipe_akses_unit`
--

INSERT INTO `tb_tipe_akses_unit` (`id_tipe_akses_unit`, `kode_tipe_akses_unit`, `tipe_akses_unit`, `ket_tipe_akses_unit`, `tgl_buat`, `tgl_edit`, `id_user`) VALUES
(1, 'P', 'PROBATION', '', '1970-01-01 00:00:00', '1970-01-01 00:00:00', 1),
(2, 'F', 'FULL', '', '1970-01-01 00:00:00', '1970-01-01 00:00:00', 1),
(3, 'R', 'RESTRICTED', '', '1970-01-01 00:00:00', '1970-01-01 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_unit`
--

CREATE TABLE `tb_unit` (
  `id_unit` int(11) NOT NULL,
  `kode_unit` char(10) NOT NULL DEFAULT '',
  `unit` varchar(100) NOT NULL DEFAULT '',
  `stat_unit` char(2) NOT NULL DEFAULT 'T',
  `ket_unit` varchar(1000) NOT NULL DEFAULT '',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_unit`
--

INSERT INTO `tb_unit` (`id_unit`, `kode_unit`, `unit`, `stat_unit`, `ket_unit`, `tgl_buat`, `tgl_edit`, `id_user`) VALUES
(1, 'LV', 'LIGHT VEHICLE', 'T', 'IN ASM 001', '2023-05-23 00:00:00', '2023-11-25 14:20:09', 1),
(27, 'ELF', 'ELF', 'T', 'IN ASM 002', '2023-11-12 09:10:46', '2023-12-13 16:06:58', 60),
(30, 'BUS', 'BUS', 'T', '', '2023-12-02 11:06:42', '2023-12-02 11:06:42', 60),
(31, 'DT', 'DUMP TRUCK', 'T', '', '2023-12-05 09:10:54', '2023-12-05 09:10:54', 77),
(32, 'WT', 'WATER TRUCK', 'T', '', '2023-12-05 11:55:03', '2023-12-05 11:55:03', 32),
(33, 'MG', 'MOTOR GRADER', 'T', '', '2023-12-05 11:55:14', '2023-12-05 11:55:14', 32),
(34, 'LBT', 'LOW BOY TRAILER', 'T', '', '2023-12-05 15:43:02', '2023-12-05 15:43:02', 32),
(35, 'AD', 'ASPHALT DISTRIBUTOR', 'T', '', '2023-12-05 15:43:30', '2023-12-05 15:43:30', 32),
(36, 'EXC PC200', 'EXCAVATOR PC200', 'T', '', '2023-12-06 10:38:06', '2023-12-15 14:31:16', 32),
(37, 'BHL', 'BACKHOE LOADER', 'T', '', '2023-12-06 10:38:36', '2023-12-06 10:38:36', 32),
(38, 'WL', 'WHEEL LOADER', 'T', '', '2023-12-06 10:38:55', '2023-12-06 10:38:55', 32),
(39, 'VR', 'VIBRO ROLLER', 'T', '', '2023-12-06 11:50:58', '2023-12-06 11:50:58', 32),
(40, 'FT', 'FUEL TRUCK', 'T', '', '2023-12-07 14:37:24', '2023-12-07 14:37:24', 32),
(41, 'MH', 'MANHAUL', 'T', '', '2023-12-07 14:43:39', '2023-12-07 14:43:39', 32),
(42, 'DT10R', 'DUMP TRUCK 10R', 'T', '', '2023-12-07 15:28:31', '2023-12-07 15:28:31', 32),
(43, 'DT6R', 'DUMP TRUCK 6R', 'T', '', '2023-12-07 15:28:51', '2023-12-07 15:28:51', 32),
(44, 'LT', 'LIGHT TRUCK', 'T', '', '2023-12-08 11:12:18', '2023-12-08 11:12:18', 24),
(45, 'FK', 'FORKLIFT', 'T', '', '2023-12-10 08:55:01', '2023-12-10 08:55:01', 24),
(46, 'EXC PC300', 'EXCAVATOR PC300', 'T', '', '2023-12-15 14:31:52', '2023-12-15 14:31:52', 32),
(47, 'EXC PC400', 'EXCAVATOR PC400', 'T', '', '2023-12-15 14:32:28', '2023-12-15 14:32:28', 32),
(51, 'DT610R', 'DUMP TRUCK 6 10 R', 'T', '', '2024-01-12 08:30:32', '2024-01-12 08:30:32', 24),
(52, 'EX', 'EXCAVATOR', 'T', '', '2024-01-12 08:30:48', '2024-01-12 08:30:48', 24),
(53, 'CP', 'COMPACTOR', 'T', '', '2024-01-12 08:31:10', '2024-01-12 08:31:10', 24);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(100) NOT NULL,
  `email_user` varchar(150) NOT NULL,
  `tgl_aktif` date NOT NULL DEFAULT '1970-01-01',
  `tgl_exp` date NOT NULL DEFAULT '1970-01-01',
  `sesi` longtext NOT NULL,
  `token` longtext NOT NULL,
  `id_menu` int(5) NOT NULL DEFAULT 0,
  `stat_user` char(1) NOT NULL DEFAULT 'T',
  `akses_apps` varchar(50) NOT NULL,
  `pic_user` longtext NOT NULL,
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_buat` int(11) NOT NULL DEFAULT 0,
  `id_m_perusahaan` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama_user`, `email_user`, `tgl_aktif`, `tgl_exp`, `sesi`, `token`, `id_menu`, `stat_user`, `akses_apps`, `pic_user`, `tgl_buat`, `tgl_edit`, `id_buat`, `id_m_perusahaan`) VALUES
(1, 'Ihfan Noifara', 'ihfan.noifara@ungguldinamika.co.id', '2023-06-12', '2025-06-11', '1312ddb877d682d6cbddbb7178a5eaba', '', 4, 'T', 'ALL', '', '2023-06-12 11:40:17', '2024-04-21 13:55:08', 0, 1),
(39, 'Ihfan Noifara', 'ihf4n.unggul@gmail.com', '2023-08-24', '2024-04-17', 'e10adc3949ba59abbe56e057f20f883e', '', 4, 'T', 'ALL', '', '2023-08-24 07:56:36', '2023-08-24 07:56:36', 1, 1),
(50, 'Wahyu Trihantoro', 'wahyu.trihantoro@ungguldinamika.co.id', '2023-09-06', '2025-04-17', '9eec5f52b003d50487f31f35a63592f3', '', 4, 'T', 'ALL', '', '2023-09-06 08:21:43', '2023-09-06 08:28:16', 1, 1),
(51, 'Hambali', 'hambali@ungguldinamika.co.id', '2023-09-06', '2025-04-17', 'e10adc3949ba59abbe56e057f20f883e', '', 4, 'T', 'ALL', '', '2023-09-06 08:32:15', '2023-09-06 08:32:15', 1, 1),
(110, 'Syarif Mamardi', 'syarif.mamardi@ungguldinamika.co.id', '2024-05-12', '2030-05-12', 'e10adc3949ba59abbe56e057f20f883e', '', 4, 'T', 'ALL', '', '2024-05-12 22:18:25', '2024-05-12 22:18:25', 1, 1),
(111, 'Kadek Devis Ferliyawan', 'kadek.ferliyawan@ungguldinamika.co.id', '2024-05-17', '2025-05-17', 'e10adc3949ba59abbe56e057f20f883e', '', 4, 'T', 'ALL', '', '2024-05-17 16:20:24', '2024-05-17 16:20:24', 1, 1),
(112, 'User', 'user@ungguldinamika.co.id', '2024-05-19', '2030-05-19', 'e10adc3949ba59abbe56e057f20f883e', '', 4, 'T', 'ALL', '', '2024-05-19 10:56:05', '2024-05-19 10:56:05', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_vaksin_jenis`
--

CREATE TABLE `tb_vaksin_jenis` (
  `id_vaksin_jenis` int(11) NOT NULL,
  `vaksin_jenis` varchar(100) NOT NULL,
  `stat_vaksin_jenis` char(1) NOT NULL DEFAULT 'T',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_vaksin_jenis`
--

INSERT INTO `tb_vaksin_jenis` (`id_vaksin_jenis`, `vaksin_jenis`, `stat_vaksin_jenis`, `tgl_buat`, `tgl_edit`, `id_user`) VALUES
(7, 'Vaksin 1', 'T', '1970-01-01 00:00:00', '1970-01-01 00:00:00', 1),
(8, 'Vaksin 2', 'T', '1970-01-01 00:00:00', '1970-01-01 00:00:00', 1),
(9, 'Booster 1', 'T', '1970-01-01 00:00:00', '1970-01-01 00:00:00', 1),
(10, 'Booster 2', 'T', '1970-01-01 00:00:00', '1970-01-01 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_vaksin_kary`
--

CREATE TABLE `tb_vaksin_kary` (
  `id_vaksin` int(11) NOT NULL,
  `id_personal` int(11) NOT NULL DEFAULT 0,
  `id_vaksin_jenis` int(11) NOT NULL DEFAULT 0,
  `tgl_vaksin` date NOT NULL,
  `id_vaksin_nama` int(11) NOT NULL DEFAULT 0,
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_vaksin_kary`
--

INSERT INTO `tb_vaksin_kary` (`id_vaksin`, `id_personal`, `id_vaksin_jenis`, `tgl_vaksin`, `id_vaksin_nama`, `tgl_buat`, `tgl_edit`, `id_user`) VALUES
(1, 1, 7, '2021-05-12', 7, '2024-05-12 22:13:44', '2024-05-12 22:13:44', 1),
(2, 1, 8, '2021-10-28', 7, '2024-05-12 22:14:16', '2024-05-12 22:14:16', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_vaksin_nama`
--

CREATE TABLE `tb_vaksin_nama` (
  `id_vaksin_nama` int(11) NOT NULL,
  `vaksin_nama` varchar(100) NOT NULL,
  `stat_vaksin_nama` char(1) NOT NULL DEFAULT 'T',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_vaksin_nama`
--

INSERT INTO `tb_vaksin_nama` (`id_vaksin_nama`, `vaksin_nama`, `stat_vaksin_nama`, `tgl_buat`, `tgl_edit`, `id_user`) VALUES
(7, 'Sinovac', 'T', '1970-01-01 00:00:00', '1970-01-01 00:00:00', 1),
(8, 'AstraZeneca', 'T', '1970-01-01 00:00:00', '1970-01-01 00:00:00', 1),
(9, 'Sinopharm', 'T', '1970-01-01 00:00:00', '1970-01-01 00:00:00', 1),
(10, 'Moderna', 'T', '1970-01-01 00:00:00', '1970-01-01 00:00:00', 1),
(11, 'Pfizer', 'T', '1970-01-01 00:00:00', '1970-01-01 00:00:00', 1),
(12, 'Novavax', 'T', '1970-01-01 00:00:00', '1970-01-01 00:00:00', 1),
(13, 'CoronaVac', 'T', '1970-01-01 00:00:00', '1970-01-01 00:00:00', 59),
(14, 'Biofarma', 'T', '1970-01-01 00:00:00', '1970-01-01 00:00:00', 59),
(15, 'Shinopharm', 'T', '1970-01-01 00:00:00', '1970-01-01 00:00:00', 59);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_alasan_nonaktif`
-- (See below for the actual view)
--
CREATE TABLE `vw_alasan_nonaktif` (
`id_alasan_nonaktif` int(1)
,`alasan_nonaktif` int(1)
,`ket_alasan_nonaktif` int(1)
,`stat_alasan_nonaktif` int(1)
,`stat_upload_berkas` int(1)
,`tgl_buat` int(1)
,`tgl_edit` int(1)
,`auth_alasan_nonaktif` int(1)
,`id_user` int(1)
,`nama_user` int(1)
,`email_user` int(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_audit`
-- (See below for the actual view)
--
CREATE TABLE `vw_audit` (
`id_audit` int(1)
,`id_user` int(1)
,`jenis_proses` int(1)
,`data_proses` int(1)
,`nama_data` int(1)
,`tgl_edit` int(1)
,`tgl_buat` int(1)
,`nama_user` int(1)
,`email_user` int(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_bank`
-- (See below for the actual view)
--
CREATE TABLE `vw_bank` (
`id_bank` int(1)
,`bank` int(1)
,`ket_bank` int(1)
,`stat_bank` int(1)
,`tgl_buat` int(1)
,`tgl_edit` int(1)
,`id_user` int(1)
,`auth_bank` int(1)
,`nama_user` int(1)
,`email_user` int(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_bank_kary`
-- (See below for the actual view)
--
CREATE TABLE `vw_bank_kary` (
`id_bank_kary` int(1)
,`id_personal` int(1)
,`id_bank` int(1)
,`bank` int(1)
,`no_rek` int(1)
,`nama_pemilik` int(1)
,`stat_bank_kary` int(1)
,`ket_bank_kary` int(1)
,`tgl_buat` int(1)
,`tgl_edit` int(1)
,`id_user` int(1)
,`auth_personal` int(1)
,`auth_bank_kary` int(1)
,`nama_user` int(1)
,`email_user` int(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_depart`
-- (See below for the actual view)
--
CREATE TABLE `vw_depart` (
`id_depart` int(1)
,`kd_depart` int(1)
,`depart` int(1)
,`ket_depart` int(1)
,`stat_depart` int(1)
,`tgl_buat` int(1)
,`tgl_edit` int(1)
,`id_user` int(1)
,`auth_depart` int(1)
,`nama_user` int(1)
,`email_user` int(1)
,`id_perusahaan` int(1)
,`id_parent` int(1)
,`kode_perusahaan` int(1)
,`nama_perusahaan` int(1)
,`auth_perusahaan` int(1)
,`id_m_perusahaan` int(1)
,`id_m_parent` int(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_dprt`
-- (See below for the actual view)
--
CREATE TABLE `vw_dprt` (
`id_depart` int(1)
,`kd_depart` int(1)
,`depart` int(1)
,`ket_depart` int(1)
,`stat_depart` int(1)
,`tgl_buat` int(1)
,`tgl_edit` int(1)
,`id_user` int(1)
,`auth_depart` int(1)
,`nama_user` int(1)
,`email_user` int(1)
,`id_perusahaan` int(1)
,`id_parent` int(1)
,`kode_perusahaan` int(1)
,`nama_perusahaan` int(1)
,`auth_perusahaan` int(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_ec`
-- (See below for the actual view)
--
CREATE TABLE `vw_ec` (
`id_ec` int(1)
,`id_personal` int(1)
,`nama_ec` int(1)
,`hp_ec` int(1)
,`hp_ec_2` int(1)
,`relasi_ec` int(1)
,`stat_ec` int(1)
,`ket_ec` int(1)
,`tgl_buat` int(1)
,`tgl_edit` int(1)
,`id_user` int(1)
,`auth_personal` int(1)
,`auth_ec` int(1)
,`nama_user` int(1)
,`email_user` int(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_grade`
-- (See below for the actual view)
--
CREATE TABLE `vw_grade` (
`id_grade` int(1)
,`grade` int(1)
,`ket_grade` int(1)
,`stat_grade` int(1)
,`tgl_buat` int(1)
,`tgl_edit` int(1)
,`id_user` int(1)
,`id_level` int(1)
,`kd_level` int(1)
,`level` int(1)
,`auth_grade` int(1)
,`nama_user` int(1)
,`email_user` int(1)
,`id_perusahaan` int(1)
,`id_parent` int(1)
,`kode_perusahaan` int(1)
,`nama_perusahaan` int(1)
,`auth_level` int(1)
,`auth_perusahaan` int(1)
,`id_m_perusahaan` int(1)
,`id_m_parent` int(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_grd`
-- (See below for the actual view)
--
CREATE TABLE `vw_grd` (
`id_grade` int(1)
,`grade` int(1)
,`ket_grade` int(1)
,`stat_grade` int(1)
,`tgl_buat` int(1)
,`tgl_edit` int(1)
,`id_user` int(1)
,`id_level` int(1)
,`kd_level` int(1)
,`level` int(1)
,`auth_grade` int(1)
,`nama_user` int(1)
,`email_user` int(1)
,`id_perusahaan` int(1)
,`id_parent` int(1)
,`kode_perusahaan` int(1)
,`nama_perusahaan` int(1)
,`auth_level` int(1)
,`auth_perusahaan` int(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_ip_blacklist`
-- (See below for the actual view)
--
CREATE TABLE `vw_ip_blacklist` (
`id_ip_blacklist` int(1)
,`ip_address` int(1)
,`back_log` int(1)
,`tgl_buat` int(1)
,`email_user` int(1)
,`auth_email_user` int(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_izin_perusahaan`
-- (See below for the actual view)
--
CREATE TABLE `vw_izin_perusahaan` (
`id_izin_perusahaan` int(1)
,`id_m_perusahaan` int(1)
,`no_izin_perusahaan` int(1)
,`tgl_mulai_izin` int(1)
,`tgl_akhir_izin` int(1)
,`url_izin_perusahaan` int(1)
,`ket_izin_perusahaan` int(1)
,`tgl_buat` int(1)
,`tgl_edit` int(1)
,`id_user` int(1)
,`auth_izin_perusahaan` int(1)
,`auth_m_perusahaan` int(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_izin_tambang`
-- (See below for the actual view)
--
CREATE TABLE `vw_izin_tambang` (
`id_izin_tambang` int(1)
,`id_kary` int(1)
,`id_personal` int(1)
,`no_acr` int(1)
,`no_nik` int(1)
,`nama_lengkap` int(1)
,`id_depart` int(1)
,`kd_depart` int(1)
,`depart` int(1)
,`id_posisi` int(1)
,`posisi` int(1)
,`id_jenis_izin_tambang` int(1)
,`jenis_izin_tambang` int(1)
,`no_reg` int(1)
,`tgl_expired` int(1)
,`url_izin_tambang` int(1)
,`id_m_perusahaan` int(1)
,`stat_izin_tambang` int(1)
,`ket_izin_tambang` int(1)
,`id_sim_kary` int(1)
,`id_sim` int(1)
,`sim` int(1)
,`tgl_exp_sim` int(1)
,`tgl_buat` int(1)
,`tgl_edit` int(1)
,`id_user` int(1)
,`auth_karyawan` int(1)
,`auth_izin_tambang` int(1)
,`nama_user` int(1)
,`email_user` int(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_izin_unit`
-- (See below for the actual view)
--
CREATE TABLE `vw_izin_unit` (
`id_izin_tambang` int(1)
,`id_kary` int(1)
,`id_personal` int(1)
,`no_acr` int(1)
,`no_nik` int(1)
,`id_depart` int(1)
,`kd_depart` int(1)
,`depart` int(1)
,`id_posisi` int(1)
,`posisi` int(1)
,`no_reg` int(1)
,`tgl_expired` int(1)
,`ket_izin_tambang` int(1)
,`id_izin_tambang_unit` int(1)
,`id_unit` int(1)
,`kode_unit` int(1)
,`unit` int(1)
,`id_tipe_akses_unit` int(1)
,`kode_tipe_akses_unit` int(1)
,`tipe_akses_unit` int(1)
,`auth_karyawan` int(1)
,`auth_izin_tambang` int(1)
,`nama_user` int(1)
,`email_user` int(1)
,`id_perusahaan` int(1)
,`kode_perusahaan` int(1)
,`nama_perusahaan` int(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_jenis_sertifikasi`
-- (See below for the actual view)
--
CREATE TABLE `vw_jenis_sertifikasi` (
`id_jenis_sertifikasi` int(1)
,`kode_jenis_sertifikasi` int(1)
,`jenis_sertifikasi` int(1)
,`beranda` int(1)
,`ket_jenis_sertifikasi` int(1)
,`stat_jenis_sertifikasi` int(1)
,`tgl_buat` int(1)
,`tgl_edit` int(1)
,`id_user` int(1)
,`auth_jenis_sertifikasi` int(1)
,`nama_user` int(1)
,`email_user` int(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_jml_karyawan`
-- (See below for the actual view)
--
CREATE TABLE `vw_jml_karyawan` (
`id_kary` int(1)
,`no_acr` int(1)
,`doh` int(1)
,`bulan_now` int(1)
,`tahun_now` int(1)
,`bulan_doh` int(1)
,`tahun_doh` int(1)
,`id_m_perusahaan` int(1)
,`id_parent` int(1)
,`id_perusahaan` int(1)
,`kode_perusahaan` int(1)
,`nama_perusahaan` int(1)
,`tgl_nonaktif` int(1)
,`tgl_buat` int(1)
,`stat_m_perusahaan` int(1)
,`id_lokterima` int(1)
,`jenis_lokasi` int(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_karyawan`
-- (See below for the actual view)
--
CREATE TABLE `vw_karyawan` (
`id_kary` int(1)
,`id_personal` int(1)
,`id_perkerjaan` int(1)
,`no_acr` int(1)
,`no_nik` int(1)
,`doh` int(1)
,`tgl_aktif` int(1)
,`id_lokker` int(1)
,`id_lokterima` int(1)
,`id_level` int(1)
,`id_poh` int(1)
,`id_roster` int(1)
,`id_klasifikasi` int(1)
,`klasifikasi` int(1)
,`paybase` int(1)
,`statpajak` int(1)
,`id_tipe` int(1)
,`id_stat_tinggal` int(1)
,`tgl_permanen` int(1)
,`tgl_nonaktif` int(1)
,`tgl_buat` int(1)
,`tgl_edit` int(1)
,`id_user` int(1)
,`id_m_perusahaan` int(1)
,`no_ktp` int(1)
,`no_kk` int(1)
,`nama_lengkap` int(1)
,`nama_alias` int(1)
,`jk` int(1)
,`tmp_lahir` int(1)
,`tgl_lahir` int(1)
,`id_stat_nikah` int(1)
,`kode_stat_nikah` int(1)
,`stat_nikah` int(1)
,`id_agama` int(1)
,`warga_negara` int(1)
,`email_pribadi` int(1)
,`hp_1` int(1)
,`nama_ibu` int(1)
,`stat_ibu` int(1)
,`nama_ayah` int(1)
,`stat_ayah` int(1)
,`no_bpjstk` int(1)
,`no_bpjskes` int(1)
,`no_bpjspensiun` int(1)
,`no_equity` int(1)
,`no_npwp` int(1)
,`id_pendidikan` int(1)
,`nama_sekolah` int(1)
,`fakultas` int(1)
,`jurusan` int(1)
,`id_depart` int(1)
,`id_section` int(1)
,`id_posisi` int(1)
,`id_grade` int(1)
,`kd_depart` int(1)
,`depart` int(1)
,`kd_section` int(1)
,`section` int(1)
,`posisi` int(1)
,`grade` int(1)
,`kd_level` int(1)
,`level` int(1)
,`kd_lokker` int(1)
,`lokker` int(1)
,`kd_lokterima` int(1)
,`lokterima` int(1)
,`kd_poh` int(1)
,`poh` int(1)
,`kd_roster` int(1)
,`roster` int(1)
,`tipe` int(1)
,`auth_personal` int(1)
,`auth_karyawan` int(1)
,`auth_perusahaan` int(1)
,`auth_m_perusahaan` int(1)
,`id_parent` int(1)
,`id_perusahaan` int(1)
,`email_kantor` int(1)
,`agama` int(1)
,`nama_m_perusahaan` int(1)
,`stat_m_perusahaan` int(1)
,`kode_perusahaan` int(1)
,`nama_perusahaan` int(1)
,`url_pendukung` int(1)
,`usia` int(1)
,`lama_bekerja` int(1)
,`jenis_lokasi` int(1)
,`stat_tinggal` int(1)
,`url_foto` int(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_karyawan_nonaktif`
-- (See below for the actual view)
--
CREATE TABLE `vw_karyawan_nonaktif` (
`id_kary_nonaktif` int(1)
,`id_kary` int(1)
,`no_ktp` int(1)
,`no_nik` int(1)
,`nama_lengkap` int(1)
,`depart` int(1)
,`posisi` int(1)
,`tgl_nonaktif` int(1)
,`id_alasan_nonaktif` int(1)
,`alasan_nonaktif` int(1)
,`ket_nonaktif` int(1)
,`url_berkas_nonaktif` int(1)
,`tgl_buat` int(1)
,`tgl_edit` int(1)
,`id_user` int(1)
,`nama_user` int(1)
,`email_user` int(1)
,`auth_kary_nonaktif` int(1)
,`id_perusahaan` int(1)
,`id_m_perusahaan` int(1)
,`auth_karyawan` int(1)
,`auth_m_perusahaan` int(1)
,`auth_perusahaan` int(1)
,`nama_m_perusahaan` int(1)
,`kode_perusahaan` int(1)
,`nama_perusahaan` int(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_karyawan_sertifikasi`
-- (See below for the actual view)
--
CREATE TABLE `vw_karyawan_sertifikasi` (
`id_kary` int(1)
,`id_personal` int(1)
,`no_acr` int(1)
,`no_nik` int(1)
,`id_depart` int(1)
,`id_posisi` int(1)
,`id_level` int(1)
,`kd_depart` int(1)
,`depart` int(1)
,`posisi` int(1)
,`kd_level` int(1)
,`level` int(1)
,`tgl_nonaktif` int(1)
,`id_jenis_sertifikasi` int(1)
,`no_sertifikasi` int(1)
,`tgl_sertifikasi` int(1)
,`tgl_berakhir_sertifikasi` int(1)
,`file_sertifikasi` int(1)
,`kode_jenis_sertifikasi` int(1)
,`jenis_sertifikasi` int(1)
,`beranda` int(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_karyawan_terbaru`
-- (See below for the actual view)
--
CREATE TABLE `vw_karyawan_terbaru` (
`id_kary` int(1)
,`id_personal` int(1)
,`no_ktp` int(1)
,`no_nik` int(1)
,`nama_lengkap` int(1)
,`id_depart` int(1)
,`kd_depart` int(1)
,`depart` int(1)
,`tgl_buat` int(1)
,`id_user` int(1)
,`nama_user` int(1)
,`email_user` int(1)
,`id_m_perusahaan` int(1)
,`id_perusahaan` int(1)
,`id_parent` int(1)
,`kode_perusahaan` int(1)
,`nama_perusahaan` int(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_klasifikasi`
-- (See below for the actual view)
--
CREATE TABLE `vw_klasifikasi` (
`id_klasifikasi` int(1)
,`klasifikasi` int(1)
,`ket_klasifikasi` int(1)
,`stat_klasifikasi` int(1)
,`tgl_buat` int(1)
,`tgl_edit` int(1)
,`id_user` int(1)
,`nama_user` int(1)
,`email_user` int(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_kontrak_karyawan`
-- (See below for the actual view)
--
CREATE TABLE `vw_kontrak_karyawan` (
`id_kontrak_kary` int(1)
,`id_kary` int(1)
,`id_stat_perjanjian` int(1)
,`stat_perjanjian` int(1)
,`stat_waktu` int(1)
,`tgl_mulai` int(1)
,`tgl_akhir` int(1)
,`ket_kontrak` int(1)
,`tgl_buat` int(1)
,`tgl_edit` int(1)
,`id_user` int(1)
,`no_acr` int(1)
,`no_nik` int(1)
,`depart` int(1)
,`posisi` int(1)
,`nama_user` int(1)
,`email_user` int(1)
,`id_perusahaan` int(1)
,`id_m_perusahaan` int(1)
,`nama_m_perusahaan` int(1)
,`nama_perusahaan` int(1)
,`kode_perusahaan` int(1)
,`auth_karyawan` int(1)
,`auth_kontrak_kary` int(1)
,`auth_perusahaan` int(1)
,`auth_m_perusahaan` int(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_kontrak_perusahaan`
-- (See below for the actual view)
--
CREATE TABLE `vw_kontrak_perusahaan` (
`id_kontrak_perusahaan` int(1)
,`id_m_perusahaan` int(1)
,`no_kontrak_perusahaan` int(1)
,`tgl_mulai_kontrak` int(1)
,`tgl_akhir_kontrak` int(1)
,`url_doc_kontrak_perusahaan` int(1)
,`ket_kontrak_perusahaan` int(1)
,`tgl_buat` int(1)
,`tgl_edit` int(1)
,`id_user` int(1)
,`auth_kontrak_perusahaan` int(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_kry`
-- (See below for the actual view)
--
CREATE TABLE `vw_kry` (
`id_kary` int(1)
,`id_personal` int(1)
,`no_acr` int(1)
,`no_nik` int(1)
,`id_m_perusahaan` int(1)
,`no_ktp` int(1)
,`no_kk` int(1)
,`nama_lengkap` int(1)
,`nama_alias` int(1)
,`jk` int(1)
,`id_depart` int(1)
,`id_posisi` int(1)
,`kd_depart` int(1)
,`depart` int(1)
,`posisi` int(1)
,`auth_personal` int(1)
,`auth_karyawan` int(1)
,`auth_perusahaan` int(1)
,`auth_m_perusahaan` int(1)
,`id_perusahaan` int(1)
,`nama_m_perusahaan` int(1)
,`kode_perusahaan` int(1)
,`nama_perusahaan` int(1)
,`url_pendukung` int(1)
,`tgl_nonaktif` int(1)
,`tgl_buat` int(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_ktp`
-- (See below for the actual view)
--
CREATE TABLE `vw_ktp` (
`id_ktp` int(1)
,`id_personal` int(1)
,`no_ktp` int(1)
,`nama_lengkap` int(1)
,`url_ktp` int(1)
,`stat_ktp` int(1)
,`tgl_buat` int(1)
,`tgl_edit` int(1)
,`id_user` int(1)
,`auth_personal` int(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_langgar`
-- (See below for the actual view)
--
CREATE TABLE `vw_langgar` (
`id_langgar` int(1)
,`id_kary` int(1)
,`id_personal` int(1)
,`no_acr` int(1)
,`no_ktp` int(1)
,`no_nik` int(1)
,`nama_lengkap` int(1)
,`doh` int(1)
,`tgl_aktif` int(1)
,`depart` int(1)
,`section` int(1)
,`posisi` int(1)
,`poh` int(1)
,`level` int(1)
,`tipe` int(1)
,`tgl_langgar` int(1)
,`tgl_punishment` int(1)
,`id_langgar_jenis` int(1)
,`kode_langgar_jenis` int(1)
,`langgar_jenis` int(1)
,`durasi_langgar_jenis` int(1)
,`jenis_durasi` int(1)
,`url_langgar` int(1)
,`ket_langgar` int(1)
,`tgl_akhir_langgar` int(1)
,`tgl_buat` int(1)
,`tgl_edit` int(1)
,`id_user` int(1)
,`id_m_perusahaan` int(1)
,`kode_perusahaan` int(1)
,`nama_m_perusahaan` int(1)
,`auth_kary` int(1)
,`auth_personal` int(1)
,`auth_m_per` int(1)
,`nama_user` int(1)
,`email_user` int(1)
,`auth_langgar` int(1)
,`auth_langgar_jenis` int(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_langgar_jenis`
-- (See below for the actual view)
--
CREATE TABLE `vw_langgar_jenis` (
`id_langgar_jenis` int(1)
,`kode_langgar_jenis` int(1)
,`langgar_jenis` int(1)
,`stat_langgar_jenis` int(1)
,`ket_langgar_jenis` int(1)
,`durasi_langgar_jenis` int(1)
,`jenis_durasi` int(1)
,`tgl_buat` int(1)
,`tgl_edit` int(1)
,`id_user` int(1)
,`nama_user` int(1)
,`email_user` int(1)
,`auth_langgar_jenis` int(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_level`
-- (See below for the actual view)
--
CREATE TABLE `vw_level` (
`id_level` int(1)
,`kd_level` int(1)
,`level` int(1)
,`ket_level` int(1)
,`stat_level` int(1)
,`tgl_buat` int(1)
,`tgl_edit` int(1)
,`id_user` int(1)
,`auth_level` int(1)
,`nama_user` int(1)
,`email_user` int(1)
,`id_perusahaan` int(1)
,`id_parent` int(1)
,`kode_perusahaan` int(1)
,`nama_perusahaan` int(1)
,`auth_perusahaan` int(1)
,`auth_m_perusahaan` int(1)
,`id_m_perusahaan` int(1)
,`id_m_parent` int(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_lokker`
-- (See below for the actual view)
--
CREATE TABLE `vw_lokker` (
`id_lokker` int(1)
,`kd_lokker` int(1)
,`lokker` int(1)
,`ket_lokker` int(1)
,`stat_lokker` int(1)
,`tgl_buat` int(1)
,`tgl_edit` int(1)
,`id_user` int(1)
,`auth_lokker` int(1)
,`nama_user` int(1)
,`email_user` int(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_lokterima`
-- (See below for the actual view)
--
CREATE TABLE `vw_lokterima` (
`id_lokterima` int(1)
,`kd_lokterima` int(1)
,`lokterima` int(1)
,`jenis_lokasi` int(1)
,`ket_lokterima` int(1)
,`stat_lokterima` int(1)
,`tgl_buat` int(1)
,`tgl_edit` int(1)
,`id_user` int(1)
,`auth_lokterima` int(1)
,`nama_user` int(1)
,`email_user` int(1)
,`id_perusahaan` int(1)
,`id_parent` int(1)
,`kode_perusahaan` int(1)
,`nama_perusahaan` int(1)
,`auth_perusahaan` int(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_loktrm`
-- (See below for the actual view)
--
CREATE TABLE `vw_loktrm` (
`id_lokterima` int(1)
,`kd_lokterima` int(1)
,`lokterima` int(1)
,`ket_lokterima` int(1)
,`stat_lokterima` int(1)
,`tgl_buat` int(1)
,`tgl_edit` int(1)
,`id_user` int(1)
,`auth_lokterima` int(1)
,`nama_user` int(1)
,`email_user` int(1)
,`id_perusahaan` int(1)
,`id_parent` int(1)
,`kode_perusahaan` int(1)
,`nama_perusahaan` int(1)
,`auth_perusahaan` int(1)
,`id_m_perusahaan` int(1)
,`id_m_parent` int(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_lvl`
-- (See below for the actual view)
--
CREATE TABLE `vw_lvl` (
`id_level` int(1)
,`kd_level` int(1)
,`level` int(1)
,`ket_level` int(1)
,`stat_level` int(1)
,`tgl_buat` int(1)
,`tgl_edit` int(1)
,`id_user` int(1)
,`auth_level` int(1)
,`nama_user` int(1)
,`email_user` int(1)
,`id_perusahaan` int(1)
,`id_parent` int(1)
,`kode_perusahaan` int(1)
,`nama_perusahaan` int(1)
,`auth_perusahaan` int(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_mcu`
-- (See below for the actual view)
--
CREATE TABLE `vw_mcu` (
`id_mcu` int(1)
,`id_personal` int(1)
,`no_ktp` int(1)
,`no_kk` int(1)
,`nama_lengkap` int(1)
,`id_mcu_jenis` int(1)
,`mcu_jenis` int(1)
,`tgl_mcu` int(1)
,`ket_mcu` int(1)
,`url_file` int(1)
,`tgl_buat` int(1)
,`tgl_edit` int(1)
,`id_user` int(1)
,`nama_user` int(1)
,`email_user` int(1)
,`auth_personal` int(1)
,`auth_mcu` int(1)
,`id_m_perusahaan` int(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_menu`
-- (See below for the actual view)
--
CREATE TABLE `vw_menu` (
`IdMenu` int(1)
,`NamaMenu` int(1)
,`StatMenu` int(1)
,`tgl_buat` int(1)
,`tgl_edit` int(1)
,`id_user` int(1)
,`auth_menu` int(1)
,`nama_user` int(1)
,`email_user` int(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_modul_role_menu`
-- (See below for the actual view)
--
CREATE TABLE `vw_modul_role_menu` (
`id_modul_role_menu` int(1)
,`id_menu` int(1)
,`NamaMenu` int(1)
,`StatMenu` int(1)
,`BukaFile` int(1)
,`id_modul_role` int(1)
,`IdParent` int(1)
,`NamaModule` int(1)
,`UrlModule` int(1)
,`LabelMenu` int(1)
,`IconModule` int(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_m_per`
-- (See below for the actual view)
--
CREATE TABLE `vw_m_per` (
`id_m_perusahaan` int(1)
,`id_parent` int(1)
,`id_perusahaan` int(1)
,`nama_m_perusahaan` int(1)
,`id_jenis_perusahaan` int(1)
,`jenis_perusahaan` int(1)
,`no_jenis_perusahaan` int(1)
,`stat_m_perusahaan` int(1)
,`tgl_buat` int(1)
,`tgl_edit` int(1)
,`id_user` int(1)
,`kode_perusahaan` int(1)
,`nama_perusahaan` int(1)
,`auth_parent` int(1)
,`auth_perusahaan` int(1)
,`auth_m_perusahaan` int(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_m_perusahaan`
-- (See below for the actual view)
--
CREATE TABLE `vw_m_perusahaan` (
`id_m_perusahaan` int(1)
,`id_parent` int(1)
,`id_perusahaan` int(1)
,`nama_m_perusahaan` int(1)
,`url_rk3l` int(1)
,`id_jenis_perusahaan` int(1)
,`jenis_perusahaan` int(1)
,`no_jenis_perusahaan` int(1)
,`stat_m_perusahaan` int(1)
,`tgl_buat` int(1)
,`tgl_edit` int(1)
,`id_user` int(1)
,`kode_perusahaan` int(1)
,`nama_perusahaan` int(1)
,`nama_user` int(1)
,`email_user` int(1)
,`auth_parent` int(1)
,`auth_perusahaan` int(1)
,`auth_m_perusahaan` int(1)
,`id_izin_perusahaan` int(1)
,`no_izin_perusahaan` int(1)
,`tgl_mulai_izin` int(1)
,`tgl_akhir_izin` int(1)
,`url_izin_perusahaan` int(1)
,`ket_izin_perusahaan` int(1)
,`stat_perusahaan` int(1)
,`kegiatan` int(1)
,`ket_perusahaan` int(1)
,`id_sio_perusahaan` int(1)
,`no_sio_perusahaan` int(1)
,`tgl_mulai_sio` int(1)
,`tgl_akhir_sio` int(1)
,`url_sio` int(1)
,`ket_sio` int(1)
,`id_kontrak_perusahaan` int(1)
,`no_kontrak_perusahaan` int(1)
,`tgl_mulai_kontrak` int(1)
,`tgl_akhir_kontrak` int(1)
,`ket_kontrak_perusahaan` int(1)
,`url_doc_kontrak_perusahaan` int(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_m_prs`
-- (See below for the actual view)
--
CREATE TABLE `vw_m_prs` (
`id_m_perusahaan` int(1)
,`id_parent` int(1)
,`id_perusahaan` int(1)
,`nama_m_perusahaan` int(1)
,`url_rk3l` int(1)
,`id_jenis_perusahaan` int(1)
,`jenis_perusahaan` int(1)
,`no_jenis_perusahaan` int(1)
,`stat_m_perusahaan` int(1)
,`tgl_buat` int(1)
,`tgl_edit` int(1)
,`id_user` int(1)
,`kode_perusahaan` int(1)
,`nama_perusahaan` int(1)
,`nama_user` int(1)
,`email_user` int(1)
,`auth_parent` int(1)
,`auth_perusahaan` int(1)
,`auth_m_perusahaan` int(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_pekerjaan`
-- (See below for the actual view)
--
CREATE TABLE `vw_pekerjaan` (
`id_pekerjaan` int(1)
,`id_depart` int(1)
,`id_section` int(1)
,`id_posisi` int(1)
,`id_grade` int(1)
,`id_level` int(1)
,`kd_depart` int(1)
,`depart` int(1)
,`kd_section` int(1)
,`section` int(1)
,`posisi` int(1)
,`grade` int(1)
,`kd_level` int(1)
,`level` int(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_personal`
-- (See below for the actual view)
--
CREATE TABLE `vw_personal` (
`id_personal` int(1)
,`no_ktp` int(1)
,`no_kk` int(1)
,`nama_lengkap` int(1)
,`nama_alias` int(1)
,`jk` int(1)
,`tmp_lahir` int(1)
,`tgl_lahir` int(1)
,`id_stat_nikah` int(1)
,`kode_stat_nikah` int(1)
,`stat_nikah` int(1)
,`id_agama` int(1)
,`agama` int(1)
,`warga_negara` int(1)
,`email_pribadi` int(1)
,`hp_1` int(1)
,`hp_2` int(1)
,`nama_ibu` int(1)
,`stat_ibu` int(1)
,`nama_ayah` int(1)
,`stat_ayah` int(1)
,`no_bpjstk` int(1)
,`no_bpjskes` int(1)
,`no_bpjspensiun` int(1)
,`no_equity` int(1)
,`no_npwp` int(1)
,`tgl_buat` int(1)
,`tgl_edit` int(1)
,`id_user` int(1)
,`id_ec` int(1)
,`nama_ec` int(1)
,`hp_ec` int(1)
,`hp_ec_2` int(1)
,`relasi_ec` int(1)
,`ket_ec` int(1)
,`stat_ec` int(1)
,`id_alamat_ktp` int(1)
,`rt_ktp` int(1)
,`rw_ktp` int(1)
,`kel_ktp` int(1)
,`kec_ktp` int(1)
,`kab_ktp` int(1)
,`prov_ktp` int(1)
,`stat_alamat_ktp` int(1)
,`auth_personal` int(1)
,`url_pendukung` int(1)
,`usia` int(1)
,`id_pendidikan` int(1)
,`nama_sekolah` int(1)
,`fakultas` int(1)
,`jurusan` int(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_perusahaan`
-- (See below for the actual view)
--
CREATE TABLE `vw_perusahaan` (
`id_perusahaan` int(1)
,`kode_perusahaan` int(1)
,`nama_perusahaan` int(1)
,`alamat_perusahaan` int(1)
,`kel_perusahaan` int(1)
,`kec_perusahaan` int(1)
,`kab_perusahaan` int(1)
,`prov_perusahaan` int(1)
,`kodepos_perusahaan` int(1)
,`telp_perusahaan` int(1)
,`email_perusahaan` int(1)
,`website_perusahaan` int(1)
,`npwp_perusahaan` int(1)
,`ket_perusahaan` int(1)
,`stat_perusahaan` int(1)
,`kegiatan` int(1)
,`tgl_buat` int(1)
,`tgl_edit` int(1)
,`id_user` int(1)
,`auth_perusahaan` int(1)
,`nama_user` int(1)
,`email_user` int(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_pjo_perusahaan`
-- (See below for the actual view)
--
CREATE TABLE `vw_pjo_perusahaan` (
`id_pjo_perusahaan` int(1)
,`id_m_perusahaan` int(1)
,`no_pengesahan_pjo` int(1)
,`id_perusahaan` int(1)
,`nama_m_perusahaan` int(1)
,`jenis_perusahaan` int(1)
,`kode_perusahaan` int(1)
,`nama_perusahaan` int(1)
,`id_lokasi` int(1)
,`tgl_aktif_pjo` int(1)
,`tgl_akhir_pjo` int(1)
,`url_pengesahan_pjo` int(1)
,`id_karyawan` int(1)
,`id_personal` int(1)
,`no_nik` int(1)
,`nama_lengkap` int(1)
,`no_ktp` int(1)
,`tgl_buat` int(1)
,`tgl_edit` int(1)
,`id_user` int(1)
,`auth_pjo_perusahaan` int(1)
,`auth_perusahaan` int(1)
,`auth_m_perusahaan` int(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_poh`
-- (See below for the actual view)
--
CREATE TABLE `vw_poh` (
`id_poh` int(1)
,`kd_poh` int(1)
,`poh` int(1)
,`ket_poh` int(1)
,`stat_poh` int(1)
,`tgl_buat` int(1)
,`tgl_edit` int(1)
,`id_user` int(1)
,`auth_poh` int(1)
,`nama_user` int(1)
,`email_user` int(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_posisi`
-- (See below for the actual view)
--
CREATE TABLE `vw_posisi` (
`id_posisi` int(1)
,`posisi` int(1)
,`ket_posisi` int(1)
,`stat_posisi` int(1)
,`tgl_buat` int(1)
,`tgl_edit` int(1)
,`id_user` int(1)
,`id_depart` int(1)
,`kd_depart` int(1)
,`depart` int(1)
,`auth_posisi` int(1)
,`nama_user` int(1)
,`email_user` int(1)
,`id_perusahaan` int(1)
,`id_parent` int(1)
,`kode_perusahaan` int(1)
,`nama_perusahaan` int(1)
,`auth_depart` int(1)
,`auth_perusahaan` int(1)
,`id_m_perusahaan` int(1)
,`id_m_parent` int(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_prs_all`
-- (See below for the actual view)
--
CREATE TABLE `vw_prs_all` (
`id_perusahaan` int(1)
,`kode_perusahaan` int(1)
,`nama_perusahaan` int(1)
,`alamat_perusahaan` int(1)
,`kel_perusahaan` int(1)
,`kec_perusahaan` int(1)
,`kab_perusahaan` int(1)
,`prov_perusahaan` int(1)
,`kodepos_perusahaan` int(1)
,`telp_perusahaan` int(1)
,`email_perusahaan` int(1)
,`website_perusahaan` int(1)
,`npwp_perusahaan` int(1)
,`ket_perusahaan` int(1)
,`stat_perusahaan` int(1)
,`kegiatan` int(1)
,`tgl_buat` int(1)
,`tgl_edit` int(1)
,`id_user` int(1)
,`auth_perusahaan` int(1)
,`nama_user` int(1)
,`email_user` int(1)
,`prov` int(1)
,`kab` int(1)
,`kec` int(1)
,`kel` int(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_pss`
-- (See below for the actual view)
--
CREATE TABLE `vw_pss` (
`id_posisi` int(1)
,`posisi` int(1)
,`ket_posisi` int(1)
,`stat_posisi` int(1)
,`tgl_buat` int(1)
,`tgl_edit` int(1)
,`id_user` int(1)
,`id_depart` int(1)
,`kd_depart` int(1)
,`depart` int(1)
,`auth_posisi` int(1)
,`nama_user` int(1)
,`email_user` int(1)
,`id_perusahaan` int(1)
,`id_parent` int(1)
,`kode_perusahaan` int(1)
,`nama_perusahaan` int(1)
,`auth_depart` int(1)
,`auth_perusahaan` int(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_roster`
-- (See below for the actual view)
--
CREATE TABLE `vw_roster` (
`id_roster` int(1)
,`kd_roster` int(1)
,`roster` int(1)
,`jml_hari_onsite` int(1)
,`jml_hari_offsite` int(1)
,`ket_roster` int(1)
,`stat_roster` int(1)
,`tgl_buat` int(1)
,`tgl_edit` int(1)
,`id_user` int(1)
,`auth_roster` int(1)
,`nama_user` int(1)
,`email_user` int(1)
,`id_perusahaan` int(1)
,`id_parent` int(1)
,`kode_perusahaan` int(1)
,`nama_perusahaan` int(1)
,`auth_perusahaan` int(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_sanksi`
-- (See below for the actual view)
--
CREATE TABLE `vw_sanksi` (
`id_sanksi` int(1)
,`kd_sanksi` int(1)
,`sanksi` int(1)
,`jml_hari_berlaku` int(1)
,`ket_sanksi` int(1)
,`stat_sanksi` int(1)
,`tgl_buat` int(1)
,`tgl_edit` int(1)
,`id_user` int(1)
,`auth_sanksi` int(1)
,`nama_user` int(1)
,`email_user` int(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_section`
-- (See below for the actual view)
--
CREATE TABLE `vw_section` (
`id_section` int(1)
,`kd_section` int(1)
,`section` int(1)
,`ket_section` int(1)
,`stat_section` int(1)
,`tgl_buat` int(1)
,`tgl_edit` int(1)
,`id_user` int(1)
,`id_depart` int(1)
,`kd_depart` int(1)
,`depart` int(1)
,`auth_section` int(1)
,`nama_user` int(1)
,`email_user` int(1)
,`id_perusahaan` int(1)
,`id_parent` int(1)
,`kode_perusahaan` int(1)
,`nama_perusahaan` int(1)
,`auth_depart` int(1)
,`auth_perusahaan` int(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_sertifikasi`
-- (See below for the actual view)
--
CREATE TABLE `vw_sertifikasi` (
`id_sertifikasi` int(1)
,`id_personal` int(1)
,`no_ktp` int(1)
,`no_kk` int(1)
,`jk` int(1)
,`tmp_lahir` int(1)
,`tgl_lahir` int(1)
,`id_jenis_sertifikasi` int(1)
,`kode_jenis_sertifikasi` int(1)
,`jenis_sertifikasi` int(1)
,`no_sertifikasi` int(1)
,`lembaga` int(1)
,`tgl_sertifikasi` int(1)
,`tgl_berakhir_sertifikasi` int(1)
,`file_sertifikasi` int(1)
,`tgl_buat` int(1)
,`tgl_edit` int(1)
,`id_user` int(1)
,`auth_sertifikat` int(1)
,`auth_personal` int(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_sim`
-- (See below for the actual view)
--
CREATE TABLE `vw_sim` (
`id_sim` int(1)
,`sim` int(1)
,`stat_sim` int(1)
,`ket_sim` int(1)
,`tgl_buat` int(1)
,`tgl_edit` int(1)
,`id_user` int(1)
,`auth_sim` int(1)
,`nama_user` int(1)
,`email_user` int(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_sim_karyawan`
-- (See below for the actual view)
--
CREATE TABLE `vw_sim_karyawan` (
`id_sim_kary` int(1)
,`id_personal` int(1)
,`id_karyawan` int(1)
,`no_ktp` int(1)
,`nama_lengkap` int(1)
,`tmp_lahir` int(1)
,`tgl_lahir` int(1)
,`id_sim` int(1)
,`tgl_exp_sim` int(1)
,`ket_sim_kary` int(1)
,`url_file` int(1)
,`tgl_buat` int(1)
,`tgl_edit` int(1)
,`id_user` int(1)
,`sim` int(1)
,`auth_sim_kary` int(1)
,`auth_personal` int(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_sio_perusahaan`
-- (See below for the actual view)
--
CREATE TABLE `vw_sio_perusahaan` (
`id_sio_perusahaan` int(1)
,`id_m_perusahaan` int(1)
,`no_sio_perusahaan` int(1)
,`tgl_mulai_sio` int(1)
,`tgl_akhir_sio` int(1)
,`url_sio` int(1)
,`ket_sio` int(1)
,`tgl_buat` int(1)
,`tgl_edit` int(1)
,`id_user` int(1)
,`auth_sio_perusahaan` int(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_stat_perjanjian`
-- (See below for the actual view)
--
CREATE TABLE `vw_stat_perjanjian` (
`id_stat_perjanjian` int(1)
,`stat_perjanjian` int(1)
,`ket_stat_perjanjian` int(1)
,`stat_stat_perjanjian` int(1)
,`stat_waktu` int(1)
,`tgl_buat` int(1)
,`tgl_edit` int(1)
,`id_user` int(1)
,`auth_stat_perjanjian` int(1)
,`nama_user` int(1)
,`email_user` int(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_tipe`
-- (See below for the actual view)
--
CREATE TABLE `vw_tipe` (
`id_tipe` int(1)
,`tipe` int(1)
,`ket_tipe` int(1)
,`stat_tipe` int(1)
,`tgl_buat` int(1)
,`tgl_edit` int(1)
,`id_user` int(1)
,`auth_tipe` int(1)
,`nama_user` int(1)
,`email_user` int(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_unit`
-- (See below for the actual view)
--
CREATE TABLE `vw_unit` (
`id_unit` int(1)
,`kode_unit` int(1)
,`unit` int(1)
,`stat_unit` int(1)
,`ket_unit` int(1)
,`tgl_buat` int(1)
,`tgl_edit` int(1)
,`id_user` int(1)
,`auth_unit` int(1)
,`nama_user` int(1)
,`email_user` int(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_user`
-- (See below for the actual view)
--
CREATE TABLE `vw_user` (
`id_user` int(1)
,`nama_user` int(1)
,`email_user` int(1)
,`tgl_aktif` int(1)
,`tgl_exp` int(1)
,`sesi` int(1)
,`id_menu` int(1)
,`NamaMenu` int(1)
,`akses_apps` int(1)
,`stat_user` int(1)
,`pic_user` int(1)
,`tgl_buat` int(1)
,`tgl_edit` int(1)
,`id_buat` int(1)
,`auth_user` int(1)
,`id_m_perusahaan` int(1)
,`id_parent` int(1)
,`id_perusahaan` int(1)
,`jenis_perusahaan` int(1)
,`no_jenis_perusahaan` int(1)
,`kode_perusahaan` int(1)
,`nama_perusahaan` int(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_vaksin_kary`
-- (See below for the actual view)
--
CREATE TABLE `vw_vaksin_kary` (
`id_kary` int(1)
,`id_personal` int(1)
,`no_acr` int(1)
,`no_nik` int(1)
,`no_ktp` int(1)
,`no_kk` int(1)
,`nama_lengkap` int(1)
,`nama_alias` int(1)
,`depart` int(1)
,`section` int(1)
,`posisi` int(1)
,`level` int(1)
,`tipe` int(1)
,`stat_tinggal` int(1)
,`id_vaksin_jenis` int(1)
,`vaksin_jenis` int(1)
,`id_vaksin` int(1)
,`tgl_vaksin` int(1)
,`id_vaksin_nama` int(1)
,`vaksin_nama` int(1)
,`tgl_buat` int(1)
,`tgl_edit` int(1)
,`id_user` int(1)
,`nama_user` int(1)
,`email_user` int(1)
,`auth_personal` int(1)
,`auth_vaksin` int(1)
);

-- --------------------------------------------------------

--
-- Structure for view `vw_alasan_nonaktif`
--
DROP TABLE IF EXISTS `vw_alasan_nonaktif`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_alasan_nonaktif`  AS SELECT 1 AS `id_alasan_nonaktif`, 1 AS `alasan_nonaktif`, 1 AS `ket_alasan_nonaktif`, 1 AS `stat_alasan_nonaktif`, 1 AS `stat_upload_berkas`, 1 AS `tgl_buat`, 1 AS `tgl_edit`, 1 AS `auth_alasan_nonaktif`, 1 AS `id_user`, 1 AS `nama_user`, 1 AS `email_user``email_user`  ;

-- --------------------------------------------------------

--
-- Structure for view `vw_audit`
--
DROP TABLE IF EXISTS `vw_audit`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_audit`  AS SELECT 1 AS `id_audit`, 1 AS `id_user`, 1 AS `jenis_proses`, 1 AS `data_proses`, 1 AS `nama_data`, 1 AS `tgl_edit`, 1 AS `tgl_buat`, 1 AS `nama_user`, 1 AS `email_user``email_user`  ;

-- --------------------------------------------------------

--
-- Structure for view `vw_bank`
--
DROP TABLE IF EXISTS `vw_bank`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_bank`  AS SELECT 1 AS `id_bank`, 1 AS `bank`, 1 AS `ket_bank`, 1 AS `stat_bank`, 1 AS `tgl_buat`, 1 AS `tgl_edit`, 1 AS `id_user`, 1 AS `auth_bank`, 1 AS `nama_user`, 1 AS `email_user``email_user`  ;

-- --------------------------------------------------------

--
-- Structure for view `vw_bank_kary`
--
DROP TABLE IF EXISTS `vw_bank_kary`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_bank_kary`  AS SELECT 1 AS `id_bank_kary`, 1 AS `id_personal`, 1 AS `id_bank`, 1 AS `bank`, 1 AS `no_rek`, 1 AS `nama_pemilik`, 1 AS `stat_bank_kary`, 1 AS `ket_bank_kary`, 1 AS `tgl_buat`, 1 AS `tgl_edit`, 1 AS `id_user`, 1 AS `auth_personal`, 1 AS `auth_bank_kary`, 1 AS `nama_user`, 1 AS `email_user``email_user`  ;

-- --------------------------------------------------------

--
-- Structure for view `vw_depart`
--
DROP TABLE IF EXISTS `vw_depart`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_depart`  AS SELECT 1 AS `id_depart`, 1 AS `kd_depart`, 1 AS `depart`, 1 AS `ket_depart`, 1 AS `stat_depart`, 1 AS `tgl_buat`, 1 AS `tgl_edit`, 1 AS `id_user`, 1 AS `auth_depart`, 1 AS `nama_user`, 1 AS `email_user`, 1 AS `id_perusahaan`, 1 AS `id_parent`, 1 AS `kode_perusahaan`, 1 AS `nama_perusahaan`, 1 AS `auth_perusahaan`, 1 AS `id_m_perusahaan`, 1 AS `id_m_parent``id_m_parent`  ;

-- --------------------------------------------------------

--
-- Structure for view `vw_dprt`
--
DROP TABLE IF EXISTS `vw_dprt`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_dprt`  AS SELECT 1 AS `id_depart`, 1 AS `kd_depart`, 1 AS `depart`, 1 AS `ket_depart`, 1 AS `stat_depart`, 1 AS `tgl_buat`, 1 AS `tgl_edit`, 1 AS `id_user`, 1 AS `auth_depart`, 1 AS `nama_user`, 1 AS `email_user`, 1 AS `id_perusahaan`, 1 AS `id_parent`, 1 AS `kode_perusahaan`, 1 AS `nama_perusahaan`, 1 AS `auth_perusahaan``auth_perusahaan`  ;

-- --------------------------------------------------------

--
-- Structure for view `vw_ec`
--
DROP TABLE IF EXISTS `vw_ec`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_ec`  AS SELECT 1 AS `id_ec`, 1 AS `id_personal`, 1 AS `nama_ec`, 1 AS `hp_ec`, 1 AS `hp_ec_2`, 1 AS `relasi_ec`, 1 AS `stat_ec`, 1 AS `ket_ec`, 1 AS `tgl_buat`, 1 AS `tgl_edit`, 1 AS `id_user`, 1 AS `auth_personal`, 1 AS `auth_ec`, 1 AS `nama_user`, 1 AS `email_user``email_user`  ;

-- --------------------------------------------------------

--
-- Structure for view `vw_grade`
--
DROP TABLE IF EXISTS `vw_grade`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_grade`  AS SELECT 1 AS `id_grade`, 1 AS `grade`, 1 AS `ket_grade`, 1 AS `stat_grade`, 1 AS `tgl_buat`, 1 AS `tgl_edit`, 1 AS `id_user`, 1 AS `id_level`, 1 AS `kd_level`, 1 AS `level`, 1 AS `auth_grade`, 1 AS `nama_user`, 1 AS `email_user`, 1 AS `id_perusahaan`, 1 AS `id_parent`, 1 AS `kode_perusahaan`, 1 AS `nama_perusahaan`, 1 AS `auth_level`, 1 AS `auth_perusahaan`, 1 AS `id_m_perusahaan`, 1 AS `id_m_parent``id_m_parent`  ;

-- --------------------------------------------------------

--
-- Structure for view `vw_grd`
--
DROP TABLE IF EXISTS `vw_grd`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_grd`  AS SELECT 1 AS `id_grade`, 1 AS `grade`, 1 AS `ket_grade`, 1 AS `stat_grade`, 1 AS `tgl_buat`, 1 AS `tgl_edit`, 1 AS `id_user`, 1 AS `id_level`, 1 AS `kd_level`, 1 AS `level`, 1 AS `auth_grade`, 1 AS `nama_user`, 1 AS `email_user`, 1 AS `id_perusahaan`, 1 AS `id_parent`, 1 AS `kode_perusahaan`, 1 AS `nama_perusahaan`, 1 AS `auth_level`, 1 AS `auth_perusahaan``auth_perusahaan`  ;

-- --------------------------------------------------------

--
-- Structure for view `vw_ip_blacklist`
--
DROP TABLE IF EXISTS `vw_ip_blacklist`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_ip_blacklist`  AS SELECT 1 AS `id_ip_blacklist`, 1 AS `ip_address`, 1 AS `back_log`, 1 AS `tgl_buat`, 1 AS `email_user`, 1 AS `auth_email_user``auth_email_user`  ;

-- --------------------------------------------------------

--
-- Structure for view `vw_izin_perusahaan`
--
DROP TABLE IF EXISTS `vw_izin_perusahaan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_izin_perusahaan`  AS SELECT 1 AS `id_izin_perusahaan`, 1 AS `id_m_perusahaan`, 1 AS `no_izin_perusahaan`, 1 AS `tgl_mulai_izin`, 1 AS `tgl_akhir_izin`, 1 AS `url_izin_perusahaan`, 1 AS `ket_izin_perusahaan`, 1 AS `tgl_buat`, 1 AS `tgl_edit`, 1 AS `id_user`, 1 AS `auth_izin_perusahaan`, 1 AS `auth_m_perusahaan``auth_m_perusahaan`  ;

-- --------------------------------------------------------

--
-- Structure for view `vw_izin_tambang`
--
DROP TABLE IF EXISTS `vw_izin_tambang`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_izin_tambang`  AS SELECT 1 AS `id_izin_tambang`, 1 AS `id_kary`, 1 AS `id_personal`, 1 AS `no_acr`, 1 AS `no_nik`, 1 AS `nama_lengkap`, 1 AS `id_depart`, 1 AS `kd_depart`, 1 AS `depart`, 1 AS `id_posisi`, 1 AS `posisi`, 1 AS `id_jenis_izin_tambang`, 1 AS `jenis_izin_tambang`, 1 AS `no_reg`, 1 AS `tgl_expired`, 1 AS `url_izin_tambang`, 1 AS `id_m_perusahaan`, 1 AS `stat_izin_tambang`, 1 AS `ket_izin_tambang`, 1 AS `id_sim_kary`, 1 AS `id_sim`, 1 AS `sim`, 1 AS `tgl_exp_sim`, 1 AS `tgl_buat`, 1 AS `tgl_edit`, 1 AS `id_user`, 1 AS `auth_karyawan`, 1 AS `auth_izin_tambang`, 1 AS `nama_user`, 1 AS `email_user``email_user`  ;

-- --------------------------------------------------------

--
-- Structure for view `vw_izin_unit`
--
DROP TABLE IF EXISTS `vw_izin_unit`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_izin_unit`  AS SELECT 1 AS `id_izin_tambang`, 1 AS `id_kary`, 1 AS `id_personal`, 1 AS `no_acr`, 1 AS `no_nik`, 1 AS `id_depart`, 1 AS `kd_depart`, 1 AS `depart`, 1 AS `id_posisi`, 1 AS `posisi`, 1 AS `no_reg`, 1 AS `tgl_expired`, 1 AS `ket_izin_tambang`, 1 AS `id_izin_tambang_unit`, 1 AS `id_unit`, 1 AS `kode_unit`, 1 AS `unit`, 1 AS `id_tipe_akses_unit`, 1 AS `kode_tipe_akses_unit`, 1 AS `tipe_akses_unit`, 1 AS `auth_karyawan`, 1 AS `auth_izin_tambang`, 1 AS `nama_user`, 1 AS `email_user`, 1 AS `id_perusahaan`, 1 AS `kode_perusahaan`, 1 AS `nama_perusahaan``nama_perusahaan`  ;

-- --------------------------------------------------------

--
-- Structure for view `vw_jenis_sertifikasi`
--
DROP TABLE IF EXISTS `vw_jenis_sertifikasi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_jenis_sertifikasi`  AS SELECT 1 AS `id_jenis_sertifikasi`, 1 AS `kode_jenis_sertifikasi`, 1 AS `jenis_sertifikasi`, 1 AS `beranda`, 1 AS `ket_jenis_sertifikasi`, 1 AS `stat_jenis_sertifikasi`, 1 AS `tgl_buat`, 1 AS `tgl_edit`, 1 AS `id_user`, 1 AS `auth_jenis_sertifikasi`, 1 AS `nama_user`, 1 AS `email_user``email_user`  ;

-- --------------------------------------------------------

--
-- Structure for view `vw_jml_karyawan`
--
DROP TABLE IF EXISTS `vw_jml_karyawan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_jml_karyawan`  AS SELECT 1 AS `id_kary`, 1 AS `no_acr`, 1 AS `doh`, 1 AS `bulan_now`, 1 AS `tahun_now`, 1 AS `bulan_doh`, 1 AS `tahun_doh`, 1 AS `id_m_perusahaan`, 1 AS `id_parent`, 1 AS `id_perusahaan`, 1 AS `kode_perusahaan`, 1 AS `nama_perusahaan`, 1 AS `tgl_nonaktif`, 1 AS `tgl_buat`, 1 AS `stat_m_perusahaan`, 1 AS `id_lokterima`, 1 AS `jenis_lokasi``jenis_lokasi`  ;

-- --------------------------------------------------------

--
-- Structure for view `vw_karyawan`
--
DROP TABLE IF EXISTS `vw_karyawan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_karyawan`  AS SELECT 1 AS `id_kary`, 1 AS `id_personal`, 1 AS `id_perkerjaan`, 1 AS `no_acr`, 1 AS `no_nik`, 1 AS `doh`, 1 AS `tgl_aktif`, 1 AS `id_lokker`, 1 AS `id_lokterima`, 1 AS `id_level`, 1 AS `id_poh`, 1 AS `id_roster`, 1 AS `id_klasifikasi`, 1 AS `klasifikasi`, 1 AS `paybase`, 1 AS `statpajak`, 1 AS `id_tipe`, 1 AS `id_stat_tinggal`, 1 AS `tgl_permanen`, 1 AS `tgl_nonaktif`, 1 AS `tgl_buat`, 1 AS `tgl_edit`, 1 AS `id_user`, 1 AS `id_m_perusahaan`, 1 AS `no_ktp`, 1 AS `no_kk`, 1 AS `nama_lengkap`, 1 AS `nama_alias`, 1 AS `jk`, 1 AS `tmp_lahir`, 1 AS `tgl_lahir`, 1 AS `id_stat_nikah`, 1 AS `kode_stat_nikah`, 1 AS `stat_nikah`, 1 AS `id_agama`, 1 AS `warga_negara`, 1 AS `email_pribadi`, 1 AS `hp_1`, 1 AS `nama_ibu`, 1 AS `stat_ibu`, 1 AS `nama_ayah`, 1 AS `stat_ayah`, 1 AS `no_bpjstk`, 1 AS `no_bpjskes`, 1 AS `no_bpjspensiun`, 1 AS `no_equity`, 1 AS `no_npwp`, 1 AS `id_pendidikan`, 1 AS `nama_sekolah`, 1 AS `fakultas`, 1 AS `jurusan`, 1 AS `id_depart`, 1 AS `id_section`, 1 AS `id_posisi`, 1 AS `id_grade`, 1 AS `kd_depart`, 1 AS `depart`, 1 AS `kd_section`, 1 AS `section`, 1 AS `posisi`, 1 AS `grade`, 1 AS `kd_level`, 1 AS `level`, 1 AS `kd_lokker`, 1 AS `lokker`, 1 AS `kd_lokterima`, 1 AS `lokterima`, 1 AS `kd_poh`, 1 AS `poh`, 1 AS `kd_roster`, 1 AS `roster`, 1 AS `tipe`, 1 AS `auth_personal`, 1 AS `auth_karyawan`, 1 AS `auth_perusahaan`, 1 AS `auth_m_perusahaan`, 1 AS `id_parent`, 1 AS `id_perusahaan`, 1 AS `email_kantor`, 1 AS `agama`, 1 AS `nama_m_perusahaan`, 1 AS `stat_m_perusahaan`, 1 AS `kode_perusahaan`, 1 AS `nama_perusahaan`, 1 AS `url_pendukung`, 1 AS `usia`, 1 AS `lama_bekerja`, 1 AS `jenis_lokasi`, 1 AS `stat_tinggal`, 1 AS `url_foto``url_foto`  ;

-- --------------------------------------------------------

--
-- Structure for view `vw_karyawan_nonaktif`
--
DROP TABLE IF EXISTS `vw_karyawan_nonaktif`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_karyawan_nonaktif`  AS SELECT 1 AS `id_kary_nonaktif`, 1 AS `id_kary`, 1 AS `no_ktp`, 1 AS `no_nik`, 1 AS `nama_lengkap`, 1 AS `depart`, 1 AS `posisi`, 1 AS `tgl_nonaktif`, 1 AS `id_alasan_nonaktif`, 1 AS `alasan_nonaktif`, 1 AS `ket_nonaktif`, 1 AS `url_berkas_nonaktif`, 1 AS `tgl_buat`, 1 AS `tgl_edit`, 1 AS `id_user`, 1 AS `nama_user`, 1 AS `email_user`, 1 AS `auth_kary_nonaktif`, 1 AS `id_perusahaan`, 1 AS `id_m_perusahaan`, 1 AS `auth_karyawan`, 1 AS `auth_m_perusahaan`, 1 AS `auth_perusahaan`, 1 AS `nama_m_perusahaan`, 1 AS `kode_perusahaan`, 1 AS `nama_perusahaan``nama_perusahaan`  ;

-- --------------------------------------------------------

--
-- Structure for view `vw_karyawan_sertifikasi`
--
DROP TABLE IF EXISTS `vw_karyawan_sertifikasi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_karyawan_sertifikasi`  AS SELECT 1 AS `id_kary`, 1 AS `id_personal`, 1 AS `no_acr`, 1 AS `no_nik`, 1 AS `id_depart`, 1 AS `id_posisi`, 1 AS `id_level`, 1 AS `kd_depart`, 1 AS `depart`, 1 AS `posisi`, 1 AS `kd_level`, 1 AS `level`, 1 AS `tgl_nonaktif`, 1 AS `id_jenis_sertifikasi`, 1 AS `no_sertifikasi`, 1 AS `tgl_sertifikasi`, 1 AS `tgl_berakhir_sertifikasi`, 1 AS `file_sertifikasi`, 1 AS `kode_jenis_sertifikasi`, 1 AS `jenis_sertifikasi`, 1 AS `beranda``beranda`  ;

-- --------------------------------------------------------

--
-- Structure for view `vw_karyawan_terbaru`
--
DROP TABLE IF EXISTS `vw_karyawan_terbaru`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_karyawan_terbaru`  AS SELECT 1 AS `id_kary`, 1 AS `id_personal`, 1 AS `no_ktp`, 1 AS `no_nik`, 1 AS `nama_lengkap`, 1 AS `id_depart`, 1 AS `kd_depart`, 1 AS `depart`, 1 AS `tgl_buat`, 1 AS `id_user`, 1 AS `nama_user`, 1 AS `email_user`, 1 AS `id_m_perusahaan`, 1 AS `id_perusahaan`, 1 AS `id_parent`, 1 AS `kode_perusahaan`, 1 AS `nama_perusahaan``nama_perusahaan`  ;

-- --------------------------------------------------------

--
-- Structure for view `vw_klasifikasi`
--
DROP TABLE IF EXISTS `vw_klasifikasi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_klasifikasi`  AS SELECT 1 AS `id_klasifikasi`, 1 AS `klasifikasi`, 1 AS `ket_klasifikasi`, 1 AS `stat_klasifikasi`, 1 AS `tgl_buat`, 1 AS `tgl_edit`, 1 AS `id_user`, 1 AS `nama_user`, 1 AS `email_user``email_user`  ;

-- --------------------------------------------------------

--
-- Structure for view `vw_kontrak_karyawan`
--
DROP TABLE IF EXISTS `vw_kontrak_karyawan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_kontrak_karyawan`  AS SELECT 1 AS `id_kontrak_kary`, 1 AS `id_kary`, 1 AS `id_stat_perjanjian`, 1 AS `stat_perjanjian`, 1 AS `stat_waktu`, 1 AS `tgl_mulai`, 1 AS `tgl_akhir`, 1 AS `ket_kontrak`, 1 AS `tgl_buat`, 1 AS `tgl_edit`, 1 AS `id_user`, 1 AS `no_acr`, 1 AS `no_nik`, 1 AS `depart`, 1 AS `posisi`, 1 AS `nama_user`, 1 AS `email_user`, 1 AS `id_perusahaan`, 1 AS `id_m_perusahaan`, 1 AS `nama_m_perusahaan`, 1 AS `nama_perusahaan`, 1 AS `kode_perusahaan`, 1 AS `auth_karyawan`, 1 AS `auth_kontrak_kary`, 1 AS `auth_perusahaan`, 1 AS `auth_m_perusahaan``auth_m_perusahaan`  ;

-- --------------------------------------------------------

--
-- Structure for view `vw_kontrak_perusahaan`
--
DROP TABLE IF EXISTS `vw_kontrak_perusahaan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_kontrak_perusahaan`  AS SELECT 1 AS `id_kontrak_perusahaan`, 1 AS `id_m_perusahaan`, 1 AS `no_kontrak_perusahaan`, 1 AS `tgl_mulai_kontrak`, 1 AS `tgl_akhir_kontrak`, 1 AS `url_doc_kontrak_perusahaan`, 1 AS `ket_kontrak_perusahaan`, 1 AS `tgl_buat`, 1 AS `tgl_edit`, 1 AS `id_user`, 1 AS `auth_kontrak_perusahaan``auth_kontrak_perusahaan`  ;

-- --------------------------------------------------------

--
-- Structure for view `vw_kry`
--
DROP TABLE IF EXISTS `vw_kry`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_kry`  AS SELECT 1 AS `id_kary`, 1 AS `id_personal`, 1 AS `no_acr`, 1 AS `no_nik`, 1 AS `id_m_perusahaan`, 1 AS `no_ktp`, 1 AS `no_kk`, 1 AS `nama_lengkap`, 1 AS `nama_alias`, 1 AS `jk`, 1 AS `id_depart`, 1 AS `id_posisi`, 1 AS `kd_depart`, 1 AS `depart`, 1 AS `posisi`, 1 AS `auth_personal`, 1 AS `auth_karyawan`, 1 AS `auth_perusahaan`, 1 AS `auth_m_perusahaan`, 1 AS `id_perusahaan`, 1 AS `nama_m_perusahaan`, 1 AS `kode_perusahaan`, 1 AS `nama_perusahaan`, 1 AS `url_pendukung`, 1 AS `tgl_nonaktif`, 1 AS `tgl_buat``tgl_buat`  ;

-- --------------------------------------------------------

--
-- Structure for view `vw_ktp`
--
DROP TABLE IF EXISTS `vw_ktp`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_ktp`  AS SELECT 1 AS `id_ktp`, 1 AS `id_personal`, 1 AS `no_ktp`, 1 AS `nama_lengkap`, 1 AS `url_ktp`, 1 AS `stat_ktp`, 1 AS `tgl_buat`, 1 AS `tgl_edit`, 1 AS `id_user`, 1 AS `auth_personal``auth_personal`  ;

-- --------------------------------------------------------

--
-- Structure for view `vw_langgar`
--
DROP TABLE IF EXISTS `vw_langgar`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_langgar`  AS SELECT 1 AS `id_langgar`, 1 AS `id_kary`, 1 AS `id_personal`, 1 AS `no_acr`, 1 AS `no_ktp`, 1 AS `no_nik`, 1 AS `nama_lengkap`, 1 AS `doh`, 1 AS `tgl_aktif`, 1 AS `depart`, 1 AS `section`, 1 AS `posisi`, 1 AS `poh`, 1 AS `level`, 1 AS `tipe`, 1 AS `tgl_langgar`, 1 AS `tgl_punishment`, 1 AS `id_langgar_jenis`, 1 AS `kode_langgar_jenis`, 1 AS `langgar_jenis`, 1 AS `durasi_langgar_jenis`, 1 AS `jenis_durasi`, 1 AS `url_langgar`, 1 AS `ket_langgar`, 1 AS `tgl_akhir_langgar`, 1 AS `tgl_buat`, 1 AS `tgl_edit`, 1 AS `id_user`, 1 AS `id_m_perusahaan`, 1 AS `kode_perusahaan`, 1 AS `nama_m_perusahaan`, 1 AS `auth_kary`, 1 AS `auth_personal`, 1 AS `auth_m_per`, 1 AS `nama_user`, 1 AS `email_user`, 1 AS `auth_langgar`, 1 AS `auth_langgar_jenis``auth_langgar_jenis`  ;

-- --------------------------------------------------------

--
-- Structure for view `vw_langgar_jenis`
--
DROP TABLE IF EXISTS `vw_langgar_jenis`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_langgar_jenis`  AS SELECT 1 AS `id_langgar_jenis`, 1 AS `kode_langgar_jenis`, 1 AS `langgar_jenis`, 1 AS `stat_langgar_jenis`, 1 AS `ket_langgar_jenis`, 1 AS `durasi_langgar_jenis`, 1 AS `jenis_durasi`, 1 AS `tgl_buat`, 1 AS `tgl_edit`, 1 AS `id_user`, 1 AS `nama_user`, 1 AS `email_user`, 1 AS `auth_langgar_jenis``auth_langgar_jenis`  ;

-- --------------------------------------------------------

--
-- Structure for view `vw_level`
--
DROP TABLE IF EXISTS `vw_level`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_level`  AS SELECT 1 AS `id_level`, 1 AS `kd_level`, 1 AS `level`, 1 AS `ket_level`, 1 AS `stat_level`, 1 AS `tgl_buat`, 1 AS `tgl_edit`, 1 AS `id_user`, 1 AS `auth_level`, 1 AS `nama_user`, 1 AS `email_user`, 1 AS `id_perusahaan`, 1 AS `id_parent`, 1 AS `kode_perusahaan`, 1 AS `nama_perusahaan`, 1 AS `auth_perusahaan`, 1 AS `auth_m_perusahaan`, 1 AS `id_m_perusahaan`, 1 AS `id_m_parent``id_m_parent`  ;

-- --------------------------------------------------------

--
-- Structure for view `vw_lokker`
--
DROP TABLE IF EXISTS `vw_lokker`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_lokker`  AS SELECT 1 AS `id_lokker`, 1 AS `kd_lokker`, 1 AS `lokker`, 1 AS `ket_lokker`, 1 AS `stat_lokker`, 1 AS `tgl_buat`, 1 AS `tgl_edit`, 1 AS `id_user`, 1 AS `auth_lokker`, 1 AS `nama_user`, 1 AS `email_user``email_user`  ;

-- --------------------------------------------------------

--
-- Structure for view `vw_lokterima`
--
DROP TABLE IF EXISTS `vw_lokterima`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_lokterima`  AS SELECT 1 AS `id_lokterima`, 1 AS `kd_lokterima`, 1 AS `lokterima`, 1 AS `jenis_lokasi`, 1 AS `ket_lokterima`, 1 AS `stat_lokterima`, 1 AS `tgl_buat`, 1 AS `tgl_edit`, 1 AS `id_user`, 1 AS `auth_lokterima`, 1 AS `nama_user`, 1 AS `email_user`, 1 AS `id_perusahaan`, 1 AS `id_parent`, 1 AS `kode_perusahaan`, 1 AS `nama_perusahaan`, 1 AS `auth_perusahaan``auth_perusahaan`  ;

-- --------------------------------------------------------

--
-- Structure for view `vw_loktrm`
--
DROP TABLE IF EXISTS `vw_loktrm`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_loktrm`  AS SELECT 1 AS `id_lokterima`, 1 AS `kd_lokterima`, 1 AS `lokterima`, 1 AS `ket_lokterima`, 1 AS `stat_lokterima`, 1 AS `tgl_buat`, 1 AS `tgl_edit`, 1 AS `id_user`, 1 AS `auth_lokterima`, 1 AS `nama_user`, 1 AS `email_user`, 1 AS `id_perusahaan`, 1 AS `id_parent`, 1 AS `kode_perusahaan`, 1 AS `nama_perusahaan`, 1 AS `auth_perusahaan`, 1 AS `id_m_perusahaan`, 1 AS `id_m_parent``id_m_parent`  ;

-- --------------------------------------------------------

--
-- Structure for view `vw_lvl`
--
DROP TABLE IF EXISTS `vw_lvl`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_lvl`  AS SELECT 1 AS `id_level`, 1 AS `kd_level`, 1 AS `level`, 1 AS `ket_level`, 1 AS `stat_level`, 1 AS `tgl_buat`, 1 AS `tgl_edit`, 1 AS `id_user`, 1 AS `auth_level`, 1 AS `nama_user`, 1 AS `email_user`, 1 AS `id_perusahaan`, 1 AS `id_parent`, 1 AS `kode_perusahaan`, 1 AS `nama_perusahaan`, 1 AS `auth_perusahaan``auth_perusahaan`  ;

-- --------------------------------------------------------

--
-- Structure for view `vw_mcu`
--
DROP TABLE IF EXISTS `vw_mcu`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_mcu`  AS SELECT 1 AS `id_mcu`, 1 AS `id_personal`, 1 AS `no_ktp`, 1 AS `no_kk`, 1 AS `nama_lengkap`, 1 AS `id_mcu_jenis`, 1 AS `mcu_jenis`, 1 AS `tgl_mcu`, 1 AS `ket_mcu`, 1 AS `url_file`, 1 AS `tgl_buat`, 1 AS `tgl_edit`, 1 AS `id_user`, 1 AS `nama_user`, 1 AS `email_user`, 1 AS `auth_personal`, 1 AS `auth_mcu`, 1 AS `id_m_perusahaan``id_m_perusahaan`  ;

-- --------------------------------------------------------

--
-- Structure for view `vw_menu`
--
DROP TABLE IF EXISTS `vw_menu`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_menu`  AS SELECT 1 AS `IdMenu`, 1 AS `NamaMenu`, 1 AS `StatMenu`, 1 AS `tgl_buat`, 1 AS `tgl_edit`, 1 AS `id_user`, 1 AS `auth_menu`, 1 AS `nama_user`, 1 AS `email_user``email_user`  ;

-- --------------------------------------------------------

--
-- Structure for view `vw_modul_role_menu`
--
DROP TABLE IF EXISTS `vw_modul_role_menu`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_modul_role_menu`  AS SELECT 1 AS `id_modul_role_menu`, 1 AS `id_menu`, 1 AS `NamaMenu`, 1 AS `StatMenu`, 1 AS `BukaFile`, 1 AS `id_modul_role`, 1 AS `IdParent`, 1 AS `NamaModule`, 1 AS `UrlModule`, 1 AS `LabelMenu`, 1 AS `IconModule``IconModule`  ;

-- --------------------------------------------------------

--
-- Structure for view `vw_m_per`
--
DROP TABLE IF EXISTS `vw_m_per`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_m_per`  AS SELECT 1 AS `id_m_perusahaan`, 1 AS `id_parent`, 1 AS `id_perusahaan`, 1 AS `nama_m_perusahaan`, 1 AS `id_jenis_perusahaan`, 1 AS `jenis_perusahaan`, 1 AS `no_jenis_perusahaan`, 1 AS `stat_m_perusahaan`, 1 AS `tgl_buat`, 1 AS `tgl_edit`, 1 AS `id_user`, 1 AS `kode_perusahaan`, 1 AS `nama_perusahaan`, 1 AS `auth_parent`, 1 AS `auth_perusahaan`, 1 AS `auth_m_perusahaan``auth_m_perusahaan`  ;

-- --------------------------------------------------------

--
-- Structure for view `vw_m_perusahaan`
--
DROP TABLE IF EXISTS `vw_m_perusahaan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_m_perusahaan`  AS SELECT 1 AS `id_m_perusahaan`, 1 AS `id_parent`, 1 AS `id_perusahaan`, 1 AS `nama_m_perusahaan`, 1 AS `url_rk3l`, 1 AS `id_jenis_perusahaan`, 1 AS `jenis_perusahaan`, 1 AS `no_jenis_perusahaan`, 1 AS `stat_m_perusahaan`, 1 AS `tgl_buat`, 1 AS `tgl_edit`, 1 AS `id_user`, 1 AS `kode_perusahaan`, 1 AS `nama_perusahaan`, 1 AS `nama_user`, 1 AS `email_user`, 1 AS `auth_parent`, 1 AS `auth_perusahaan`, 1 AS `auth_m_perusahaan`, 1 AS `id_izin_perusahaan`, 1 AS `no_izin_perusahaan`, 1 AS `tgl_mulai_izin`, 1 AS `tgl_akhir_izin`, 1 AS `url_izin_perusahaan`, 1 AS `ket_izin_perusahaan`, 1 AS `stat_perusahaan`, 1 AS `kegiatan`, 1 AS `ket_perusahaan`, 1 AS `id_sio_perusahaan`, 1 AS `no_sio_perusahaan`, 1 AS `tgl_mulai_sio`, 1 AS `tgl_akhir_sio`, 1 AS `url_sio`, 1 AS `ket_sio`, 1 AS `id_kontrak_perusahaan`, 1 AS `no_kontrak_perusahaan`, 1 AS `tgl_mulai_kontrak`, 1 AS `tgl_akhir_kontrak`, 1 AS `ket_kontrak_perusahaan`, 1 AS `url_doc_kontrak_perusahaan``url_doc_kontrak_perusahaan`  ;

-- --------------------------------------------------------

--
-- Structure for view `vw_m_prs`
--
DROP TABLE IF EXISTS `vw_m_prs`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_m_prs`  AS SELECT 1 AS `id_m_perusahaan`, 1 AS `id_parent`, 1 AS `id_perusahaan`, 1 AS `nama_m_perusahaan`, 1 AS `url_rk3l`, 1 AS `id_jenis_perusahaan`, 1 AS `jenis_perusahaan`, 1 AS `no_jenis_perusahaan`, 1 AS `stat_m_perusahaan`, 1 AS `tgl_buat`, 1 AS `tgl_edit`, 1 AS `id_user`, 1 AS `kode_perusahaan`, 1 AS `nama_perusahaan`, 1 AS `nama_user`, 1 AS `email_user`, 1 AS `auth_parent`, 1 AS `auth_perusahaan`, 1 AS `auth_m_perusahaan``auth_m_perusahaan`  ;

-- --------------------------------------------------------

--
-- Structure for view `vw_pekerjaan`
--
DROP TABLE IF EXISTS `vw_pekerjaan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_pekerjaan`  AS SELECT 1 AS `id_pekerjaan`, 1 AS `id_depart`, 1 AS `id_section`, 1 AS `id_posisi`, 1 AS `id_grade`, 1 AS `id_level`, 1 AS `kd_depart`, 1 AS `depart`, 1 AS `kd_section`, 1 AS `section`, 1 AS `posisi`, 1 AS `grade`, 1 AS `kd_level`, 1 AS `level``level`  ;

-- --------------------------------------------------------

--
-- Structure for view `vw_personal`
--
DROP TABLE IF EXISTS `vw_personal`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_personal`  AS SELECT 1 AS `id_personal`, 1 AS `no_ktp`, 1 AS `no_kk`, 1 AS `nama_lengkap`, 1 AS `nama_alias`, 1 AS `jk`, 1 AS `tmp_lahir`, 1 AS `tgl_lahir`, 1 AS `id_stat_nikah`, 1 AS `kode_stat_nikah`, 1 AS `stat_nikah`, 1 AS `id_agama`, 1 AS `agama`, 1 AS `warga_negara`, 1 AS `email_pribadi`, 1 AS `hp_1`, 1 AS `hp_2`, 1 AS `nama_ibu`, 1 AS `stat_ibu`, 1 AS `nama_ayah`, 1 AS `stat_ayah`, 1 AS `no_bpjstk`, 1 AS `no_bpjskes`, 1 AS `no_bpjspensiun`, 1 AS `no_equity`, 1 AS `no_npwp`, 1 AS `tgl_buat`, 1 AS `tgl_edit`, 1 AS `id_user`, 1 AS `id_ec`, 1 AS `nama_ec`, 1 AS `hp_ec`, 1 AS `hp_ec_2`, 1 AS `relasi_ec`, 1 AS `ket_ec`, 1 AS `stat_ec`, 1 AS `id_alamat_ktp`, 1 AS `rt_ktp`, 1 AS `rw_ktp`, 1 AS `kel_ktp`, 1 AS `kec_ktp`, 1 AS `kab_ktp`, 1 AS `prov_ktp`, 1 AS `stat_alamat_ktp`, 1 AS `auth_personal`, 1 AS `url_pendukung`, 1 AS `usia`, 1 AS `id_pendidikan`, 1 AS `nama_sekolah`, 1 AS `fakultas`, 1 AS `jurusan``jurusan`  ;

-- --------------------------------------------------------

--
-- Structure for view `vw_perusahaan`
--
DROP TABLE IF EXISTS `vw_perusahaan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_perusahaan`  AS SELECT 1 AS `id_perusahaan`, 1 AS `kode_perusahaan`, 1 AS `nama_perusahaan`, 1 AS `alamat_perusahaan`, 1 AS `kel_perusahaan`, 1 AS `kec_perusahaan`, 1 AS `kab_perusahaan`, 1 AS `prov_perusahaan`, 1 AS `kodepos_perusahaan`, 1 AS `telp_perusahaan`, 1 AS `email_perusahaan`, 1 AS `website_perusahaan`, 1 AS `npwp_perusahaan`, 1 AS `ket_perusahaan`, 1 AS `stat_perusahaan`, 1 AS `kegiatan`, 1 AS `tgl_buat`, 1 AS `tgl_edit`, 1 AS `id_user`, 1 AS `auth_perusahaan`, 1 AS `nama_user`, 1 AS `email_user``email_user`  ;

-- --------------------------------------------------------

--
-- Structure for view `vw_pjo_perusahaan`
--
DROP TABLE IF EXISTS `vw_pjo_perusahaan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_pjo_perusahaan`  AS SELECT 1 AS `id_pjo_perusahaan`, 1 AS `id_m_perusahaan`, 1 AS `no_pengesahan_pjo`, 1 AS `id_perusahaan`, 1 AS `nama_m_perusahaan`, 1 AS `jenis_perusahaan`, 1 AS `kode_perusahaan`, 1 AS `nama_perusahaan`, 1 AS `id_lokasi`, 1 AS `tgl_aktif_pjo`, 1 AS `tgl_akhir_pjo`, 1 AS `url_pengesahan_pjo`, 1 AS `id_karyawan`, 1 AS `id_personal`, 1 AS `no_nik`, 1 AS `nama_lengkap`, 1 AS `no_ktp`, 1 AS `tgl_buat`, 1 AS `tgl_edit`, 1 AS `id_user`, 1 AS `auth_pjo_perusahaan`, 1 AS `auth_perusahaan`, 1 AS `auth_m_perusahaan``auth_m_perusahaan`  ;

-- --------------------------------------------------------

--
-- Structure for view `vw_poh`
--
DROP TABLE IF EXISTS `vw_poh`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_poh`  AS SELECT 1 AS `id_poh`, 1 AS `kd_poh`, 1 AS `poh`, 1 AS `ket_poh`, 1 AS `stat_poh`, 1 AS `tgl_buat`, 1 AS `tgl_edit`, 1 AS `id_user`, 1 AS `auth_poh`, 1 AS `nama_user`, 1 AS `email_user``email_user`  ;

-- --------------------------------------------------------

--
-- Structure for view `vw_posisi`
--
DROP TABLE IF EXISTS `vw_posisi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_posisi`  AS SELECT 1 AS `id_posisi`, 1 AS `posisi`, 1 AS `ket_posisi`, 1 AS `stat_posisi`, 1 AS `tgl_buat`, 1 AS `tgl_edit`, 1 AS `id_user`, 1 AS `id_depart`, 1 AS `kd_depart`, 1 AS `depart`, 1 AS `auth_posisi`, 1 AS `nama_user`, 1 AS `email_user`, 1 AS `id_perusahaan`, 1 AS `id_parent`, 1 AS `kode_perusahaan`, 1 AS `nama_perusahaan`, 1 AS `auth_depart`, 1 AS `auth_perusahaan`, 1 AS `id_m_perusahaan`, 1 AS `id_m_parent``id_m_parent`  ;

-- --------------------------------------------------------

--
-- Structure for view `vw_prs_all`
--
DROP TABLE IF EXISTS `vw_prs_all`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_prs_all`  AS SELECT 1 AS `id_perusahaan`, 1 AS `kode_perusahaan`, 1 AS `nama_perusahaan`, 1 AS `alamat_perusahaan`, 1 AS `kel_perusahaan`, 1 AS `kec_perusahaan`, 1 AS `kab_perusahaan`, 1 AS `prov_perusahaan`, 1 AS `kodepos_perusahaan`, 1 AS `telp_perusahaan`, 1 AS `email_perusahaan`, 1 AS `website_perusahaan`, 1 AS `npwp_perusahaan`, 1 AS `ket_perusahaan`, 1 AS `stat_perusahaan`, 1 AS `kegiatan`, 1 AS `tgl_buat`, 1 AS `tgl_edit`, 1 AS `id_user`, 1 AS `auth_perusahaan`, 1 AS `nama_user`, 1 AS `email_user`, 1 AS `prov`, 1 AS `kab`, 1 AS `kec`, 1 AS `kel``kel`  ;

-- --------------------------------------------------------

--
-- Structure for view `vw_pss`
--
DROP TABLE IF EXISTS `vw_pss`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_pss`  AS SELECT 1 AS `id_posisi`, 1 AS `posisi`, 1 AS `ket_posisi`, 1 AS `stat_posisi`, 1 AS `tgl_buat`, 1 AS `tgl_edit`, 1 AS `id_user`, 1 AS `id_depart`, 1 AS `kd_depart`, 1 AS `depart`, 1 AS `auth_posisi`, 1 AS `nama_user`, 1 AS `email_user`, 1 AS `id_perusahaan`, 1 AS `id_parent`, 1 AS `kode_perusahaan`, 1 AS `nama_perusahaan`, 1 AS `auth_depart`, 1 AS `auth_perusahaan``auth_perusahaan`  ;

-- --------------------------------------------------------

--
-- Structure for view `vw_roster`
--
DROP TABLE IF EXISTS `vw_roster`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_roster`  AS SELECT 1 AS `id_roster`, 1 AS `kd_roster`, 1 AS `roster`, 1 AS `jml_hari_onsite`, 1 AS `jml_hari_offsite`, 1 AS `ket_roster`, 1 AS `stat_roster`, 1 AS `tgl_buat`, 1 AS `tgl_edit`, 1 AS `id_user`, 1 AS `auth_roster`, 1 AS `nama_user`, 1 AS `email_user`, 1 AS `id_perusahaan`, 1 AS `id_parent`, 1 AS `kode_perusahaan`, 1 AS `nama_perusahaan`, 1 AS `auth_perusahaan``auth_perusahaan`  ;

-- --------------------------------------------------------

--
-- Structure for view `vw_sanksi`
--
DROP TABLE IF EXISTS `vw_sanksi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_sanksi`  AS SELECT 1 AS `id_sanksi`, 1 AS `kd_sanksi`, 1 AS `sanksi`, 1 AS `jml_hari_berlaku`, 1 AS `ket_sanksi`, 1 AS `stat_sanksi`, 1 AS `tgl_buat`, 1 AS `tgl_edit`, 1 AS `id_user`, 1 AS `auth_sanksi`, 1 AS `nama_user`, 1 AS `email_user``email_user`  ;

-- --------------------------------------------------------

--
-- Structure for view `vw_section`
--
DROP TABLE IF EXISTS `vw_section`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_section`  AS SELECT 1 AS `id_section`, 1 AS `kd_section`, 1 AS `section`, 1 AS `ket_section`, 1 AS `stat_section`, 1 AS `tgl_buat`, 1 AS `tgl_edit`, 1 AS `id_user`, 1 AS `id_depart`, 1 AS `kd_depart`, 1 AS `depart`, 1 AS `auth_section`, 1 AS `nama_user`, 1 AS `email_user`, 1 AS `id_perusahaan`, 1 AS `id_parent`, 1 AS `kode_perusahaan`, 1 AS `nama_perusahaan`, 1 AS `auth_depart`, 1 AS `auth_perusahaan``auth_perusahaan`  ;

-- --------------------------------------------------------

--
-- Structure for view `vw_sertifikasi`
--
DROP TABLE IF EXISTS `vw_sertifikasi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_sertifikasi`  AS SELECT 1 AS `id_sertifikasi`, 1 AS `id_personal`, 1 AS `no_ktp`, 1 AS `no_kk`, 1 AS `jk`, 1 AS `tmp_lahir`, 1 AS `tgl_lahir`, 1 AS `id_jenis_sertifikasi`, 1 AS `kode_jenis_sertifikasi`, 1 AS `jenis_sertifikasi`, 1 AS `no_sertifikasi`, 1 AS `lembaga`, 1 AS `tgl_sertifikasi`, 1 AS `tgl_berakhir_sertifikasi`, 1 AS `file_sertifikasi`, 1 AS `tgl_buat`, 1 AS `tgl_edit`, 1 AS `id_user`, 1 AS `auth_sertifikat`, 1 AS `auth_personal``auth_personal`  ;

-- --------------------------------------------------------

--
-- Structure for view `vw_sim`
--
DROP TABLE IF EXISTS `vw_sim`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_sim`  AS SELECT 1 AS `id_sim`, 1 AS `sim`, 1 AS `stat_sim`, 1 AS `ket_sim`, 1 AS `tgl_buat`, 1 AS `tgl_edit`, 1 AS `id_user`, 1 AS `auth_sim`, 1 AS `nama_user`, 1 AS `email_user``email_user`  ;

-- --------------------------------------------------------

--
-- Structure for view `vw_sim_karyawan`
--
DROP TABLE IF EXISTS `vw_sim_karyawan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_sim_karyawan`  AS SELECT 1 AS `id_sim_kary`, 1 AS `id_personal`, 1 AS `id_karyawan`, 1 AS `no_ktp`, 1 AS `nama_lengkap`, 1 AS `tmp_lahir`, 1 AS `tgl_lahir`, 1 AS `id_sim`, 1 AS `tgl_exp_sim`, 1 AS `ket_sim_kary`, 1 AS `url_file`, 1 AS `tgl_buat`, 1 AS `tgl_edit`, 1 AS `id_user`, 1 AS `sim`, 1 AS `auth_sim_kary`, 1 AS `auth_personal``auth_personal`  ;

-- --------------------------------------------------------

--
-- Structure for view `vw_sio_perusahaan`
--
DROP TABLE IF EXISTS `vw_sio_perusahaan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_sio_perusahaan`  AS SELECT 1 AS `id_sio_perusahaan`, 1 AS `id_m_perusahaan`, 1 AS `no_sio_perusahaan`, 1 AS `tgl_mulai_sio`, 1 AS `tgl_akhir_sio`, 1 AS `url_sio`, 1 AS `ket_sio`, 1 AS `tgl_buat`, 1 AS `tgl_edit`, 1 AS `id_user`, 1 AS `auth_sio_perusahaan``auth_sio_perusahaan`  ;

-- --------------------------------------------------------

--
-- Structure for view `vw_stat_perjanjian`
--
DROP TABLE IF EXISTS `vw_stat_perjanjian`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_stat_perjanjian`  AS SELECT 1 AS `id_stat_perjanjian`, 1 AS `stat_perjanjian`, 1 AS `ket_stat_perjanjian`, 1 AS `stat_stat_perjanjian`, 1 AS `stat_waktu`, 1 AS `tgl_buat`, 1 AS `tgl_edit`, 1 AS `id_user`, 1 AS `auth_stat_perjanjian`, 1 AS `nama_user`, 1 AS `email_user``email_user`  ;

-- --------------------------------------------------------

--
-- Structure for view `vw_tipe`
--
DROP TABLE IF EXISTS `vw_tipe`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_tipe`  AS SELECT 1 AS `id_tipe`, 1 AS `tipe`, 1 AS `ket_tipe`, 1 AS `stat_tipe`, 1 AS `tgl_buat`, 1 AS `tgl_edit`, 1 AS `id_user`, 1 AS `auth_tipe`, 1 AS `nama_user`, 1 AS `email_user``email_user`  ;

-- --------------------------------------------------------

--
-- Structure for view `vw_unit`
--
DROP TABLE IF EXISTS `vw_unit`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_unit`  AS SELECT 1 AS `id_unit`, 1 AS `kode_unit`, 1 AS `unit`, 1 AS `stat_unit`, 1 AS `ket_unit`, 1 AS `tgl_buat`, 1 AS `tgl_edit`, 1 AS `id_user`, 1 AS `auth_unit`, 1 AS `nama_user`, 1 AS `email_user``email_user`  ;

-- --------------------------------------------------------

--
-- Structure for view `vw_user`
--
DROP TABLE IF EXISTS `vw_user`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_user`  AS SELECT 1 AS `id_user`, 1 AS `nama_user`, 1 AS `email_user`, 1 AS `tgl_aktif`, 1 AS `tgl_exp`, 1 AS `sesi`, 1 AS `id_menu`, 1 AS `NamaMenu`, 1 AS `akses_apps`, 1 AS `stat_user`, 1 AS `pic_user`, 1 AS `tgl_buat`, 1 AS `tgl_edit`, 1 AS `id_buat`, 1 AS `auth_user`, 1 AS `id_m_perusahaan`, 1 AS `id_parent`, 1 AS `id_perusahaan`, 1 AS `jenis_perusahaan`, 1 AS `no_jenis_perusahaan`, 1 AS `kode_perusahaan`, 1 AS `nama_perusahaan``nama_perusahaan`  ;

-- --------------------------------------------------------

--
-- Structure for view `vw_vaksin_kary`
--
DROP TABLE IF EXISTS `vw_vaksin_kary`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_vaksin_kary`  AS SELECT 1 AS `id_kary`, 1 AS `id_personal`, 1 AS `no_acr`, 1 AS `no_nik`, 1 AS `no_ktp`, 1 AS `no_kk`, 1 AS `nama_lengkap`, 1 AS `nama_alias`, 1 AS `depart`, 1 AS `section`, 1 AS `posisi`, 1 AS `level`, 1 AS `tipe`, 1 AS `stat_tinggal`, 1 AS `id_vaksin_jenis`, 1 AS `vaksin_jenis`, 1 AS `id_vaksin`, 1 AS `tgl_vaksin`, 1 AS `id_vaksin_nama`, 1 AS `vaksin_nama`, 1 AS `tgl_buat`, 1 AS `tgl_edit`, 1 AS `id_user`, 1 AS `nama_user`, 1 AS `email_user`, 1 AS `auth_personal`, 1 AS `auth_vaksin``auth_vaksin`  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `keys`
--
ALTER TABLE `keys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `limits`
--
ALTER TABLE `limits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_agama`
--
ALTER TABLE `tb_agama`
  ADD PRIMARY KEY (`id_agama`),
  ADD KEY `agama` (`agama`);

--
-- Indexes for table `tb_alamat`
--
ALTER TABLE `tb_alamat`
  ADD PRIMARY KEY (`id_alamat`);

--
-- Indexes for table `tb_alamat_ktp`
--
ALTER TABLE `tb_alamat_ktp`
  ADD PRIMARY KEY (`id_alamat_ktp`);

--
-- Indexes for table `tb_alasan_nonaktif`
--
ALTER TABLE `tb_alasan_nonaktif`
  ADD PRIMARY KEY (`id_alasan_nonaktif`);

--
-- Indexes for table `tb_apikey`
--
ALTER TABLE `tb_apikey`
  ADD PRIMARY KEY (`auth_apikey`),
  ADD KEY `apikey` (`apikey`);

--
-- Indexes for table `tb_att`
--
ALTER TABLE `tb_att`
  ADD PRIMARY KEY (`id_att`);

--
-- Indexes for table `tb_audit`
--
ALTER TABLE `tb_audit`
  ADD PRIMARY KEY (`id_audit`);

--
-- Indexes for table `tb_bank`
--
ALTER TABLE `tb_bank`
  ADD PRIMARY KEY (`id_bank`);

--
-- Indexes for table `tb_bank_kary`
--
ALTER TABLE `tb_bank_kary`
  ADD PRIMARY KEY (`id_bank_kary`);

--
-- Indexes for table `tb_depart`
--
ALTER TABLE `tb_depart`
  ADD PRIMARY KEY (`id_depart`),
  ADD KEY `FK_tb_depart_tb_perusahaan` (`id_perusahaan`);

--
-- Indexes for table `tb_doc_pengesahan_pjo`
--
ALTER TABLE `tb_doc_pengesahan_pjo`
  ADD PRIMARY KEY (`id_doc_pengesahaan_pjo`),
  ADD KEY `no_doc_pengesahaan_pjo` (`no_doc_pengesahaan_pjo`);

--
-- Indexes for table `tb_ec`
--
ALTER TABLE `tb_ec`
  ADD KEY `idec` (`id_ec`);

--
-- Indexes for table `tb_error`
--
ALTER TABLE `tb_error`
  ADD PRIMARY KEY (`id_error`);

--
-- Indexes for table `tb_filependukung`
--
ALTER TABLE `tb_filependukung`
  ADD PRIMARY KEY (`id_file_pendukung`);

--
-- Indexes for table `tb_grade`
--
ALTER TABLE `tb_grade`
  ADD PRIMARY KEY (`id_grade`),
  ADD KEY `FK_tb_grade_tb_perusahaan` (`id_perusahaan`);

--
-- Indexes for table `tb_ip_blacklist`
--
ALTER TABLE `tb_ip_blacklist`
  ADD PRIMARY KEY (`id_ip_blacklist`);

--
-- Indexes for table `tb_izin_perusahaan`
--
ALTER TABLE `tb_izin_perusahaan`
  ADD PRIMARY KEY (`id_izin_perusahaan`),
  ADD KEY `FK_tb_izin_perusahaan_tb_m_perusahaan` (`id_m_perusahaan`);

--
-- Indexes for table `tb_izin_tambang`
--
ALTER TABLE `tb_izin_tambang`
  ADD PRIMARY KEY (`id_izin_tambang`);

--
-- Indexes for table `tb_izin_tambang_area`
--
ALTER TABLE `tb_izin_tambang_area`
  ADD PRIMARY KEY (`id_area`);

--
-- Indexes for table `tb_izin_tambang_detail_area`
--
ALTER TABLE `tb_izin_tambang_detail_area`
  ADD PRIMARY KEY (`id_izin_tambang_detail_area`);

--
-- Indexes for table `tb_izin_tambang_unit`
--
ALTER TABLE `tb_izin_tambang_unit`
  ADD PRIMARY KEY (`id_izin_tambang_unit`);

--
-- Indexes for table `tb_jenis_izin_tambang`
--
ALTER TABLE `tb_jenis_izin_tambang`
  ADD PRIMARY KEY (`id_jenis_izin_tambang`);

--
-- Indexes for table `tb_jenis_perusahaan`
--
ALTER TABLE `tb_jenis_perusahaan`
  ADD PRIMARY KEY (`id_jenis_perusahaan`);

--
-- Indexes for table `tb_jenis_sertifikasi`
--
ALTER TABLE `tb_jenis_sertifikasi`
  ADD PRIMARY KEY (`id_jenis_sertifikasi`),
  ADD KEY `kode_sertifikasi` (`kode_jenis_sertifikasi`);

--
-- Indexes for table `tb_jenis_usaha`
--
ALTER TABLE `tb_jenis_usaha`
  ADD PRIMARY KEY (`id_jenis_usaha`);

--
-- Indexes for table `tb_jml_kary`
--
ALTER TABLE `tb_jml_kary`
  ADD PRIMARY KEY (`id_perusahaan`);

--
-- Indexes for table `tb_karyawan`
--
ALTER TABLE `tb_karyawan`
  ADD PRIMARY KEY (`id_kary`);

--
-- Indexes for table `tb_karyawan_nonaktif`
--
ALTER TABLE `tb_karyawan_nonaktif`
  ADD PRIMARY KEY (`id_kary_nonaktif`);

--
-- Indexes for table `tb_keluarga`
--
ALTER TABLE `tb_keluarga`
  ADD PRIMARY KEY (`id_keluarga`);

--
-- Indexes for table `tb_klasifikasi`
--
ALTER TABLE `tb_klasifikasi`
  ADD PRIMARY KEY (`id_klasifikasi`),
  ADD KEY `agama` (`klasifikasi`);

--
-- Indexes for table `tb_kontrak_karyawan`
--
ALTER TABLE `tb_kontrak_karyawan`
  ADD PRIMARY KEY (`id_kontrak_kary`);

--
-- Indexes for table `tb_kontrak_perusahaan`
--
ALTER TABLE `tb_kontrak_perusahaan`
  ADD PRIMARY KEY (`id_kontrak_perusahaan`),
  ADD KEY `FK_tb_kontrak_perusahaan_tb_m_perusahaan` (`id_m_perusahaan`);

--
-- Indexes for table `tb_ktp`
--
ALTER TABLE `tb_ktp`
  ADD PRIMARY KEY (`id_ktp`),
  ADD KEY `id_personal` (`id_personal`);

--
-- Indexes for table `tb_langgar`
--
ALTER TABLE `tb_langgar`
  ADD PRIMARY KEY (`id_langgar`);

--
-- Indexes for table `tb_langgar_jenis`
--
ALTER TABLE `tb_langgar_jenis`
  ADD PRIMARY KEY (`id_langgar_jenis`);

--
-- Indexes for table `tb_level`
--
ALTER TABLE `tb_level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indexes for table `tb_log`
--
ALTER TABLE `tb_log`
  ADD PRIMARY KEY (`id_log`);

--
-- Indexes for table `tb_lokasi_pjo`
--
ALTER TABLE `tb_lokasi_pjo`
  ADD PRIMARY KEY (`id_lokasi_pjo`),
  ADD KEY `agama` (`lokasi_pjo`);

--
-- Indexes for table `tb_lokker`
--
ALTER TABLE `tb_lokker`
  ADD PRIMARY KEY (`id_lokker`);

--
-- Indexes for table `tb_lokterima`
--
ALTER TABLE `tb_lokterima`
  ADD PRIMARY KEY (`id_lokterima`);

--
-- Indexes for table `tb_master`
--
ALTER TABLE `tb_master`
  ADD PRIMARY KEY (`id_master`);

--
-- Indexes for table `tb_mcu`
--
ALTER TABLE `tb_mcu`
  ADD PRIMARY KEY (`id_mcu`);

--
-- Indexes for table `tb_mcu_jenis`
--
ALTER TABLE `tb_mcu_jenis`
  ADD PRIMARY KEY (`id_mcu_jenis`);

--
-- Indexes for table `tb_menu`
--
ALTER TABLE `tb_menu`
  ADD PRIMARY KEY (`IdMenu`);

--
-- Indexes for table `tb_modul`
--
ALTER TABLE `tb_modul`
  ADD PRIMARY KEY (`IdModul`);

--
-- Indexes for table `tb_modul_role_menu`
--
ALTER TABLE `tb_modul_role_menu`
  ADD PRIMARY KEY (`id_modul_role_menu`);

--
-- Indexes for table `tb_m_jenis_usaha`
--
ALTER TABLE `tb_m_jenis_usaha`
  ADD PRIMARY KEY (`id_m_jenis_usaha`);

--
-- Indexes for table `tb_m_perusahaan`
--
ALTER TABLE `tb_m_perusahaan`
  ADD PRIMARY KEY (`id_m_perusahaan`);

--
-- Indexes for table `tb_paybase`
--
ALTER TABLE `tb_paybase`
  ADD PRIMARY KEY (`id_paybase`);

--
-- Indexes for table `tb_pekerjaan`
--
ALTER TABLE `tb_pekerjaan`
  ADD PRIMARY KEY (`id_pekerjaan`);

--
-- Indexes for table `tb_pendidikan`
--
ALTER TABLE `tb_pendidikan`
  ADD PRIMARY KEY (`id_pendidikan`);

--
-- Indexes for table `tb_personal`
--
ALTER TABLE `tb_personal`
  ADD PRIMARY KEY (`id_personal`);

--
-- Indexes for table `tb_perusahaan`
--
ALTER TABLE `tb_perusahaan`
  ADD PRIMARY KEY (`id_perusahaan`);

--
-- Indexes for table `tb_pjo_perusahaan`
--
ALTER TABLE `tb_pjo_perusahaan`
  ADD PRIMARY KEY (`id_pjo_perusahaan`);

--
-- Indexes for table `tb_poh`
--
ALTER TABLE `tb_poh`
  ADD PRIMARY KEY (`id_poh`);

--
-- Indexes for table `tb_posisi`
--
ALTER TABLE `tb_posisi`
  ADD PRIMARY KEY (`id_posisi`);

--
-- Indexes for table `tb_roster`
--
ALTER TABLE `tb_roster`
  ADD PRIMARY KEY (`id_roster`);

--
-- Indexes for table `tb_sanksi`
--
ALTER TABLE `tb_sanksi`
  ADD PRIMARY KEY (`id_sanksi`),
  ADD KEY `kd_sanksi` (`kd_sanksi`);

--
-- Indexes for table `tb_section`
--
ALTER TABLE `tb_section`
  ADD PRIMARY KEY (`id_section`);

--
-- Indexes for table `tb_sertifikasi_kary`
--
ALTER TABLE `tb_sertifikasi_kary`
  ADD PRIMARY KEY (`id_sertifikasi`) USING BTREE;

--
-- Indexes for table `tb_sim`
--
ALTER TABLE `tb_sim`
  ADD PRIMARY KEY (`id_sim`),
  ADD KEY `agama` (`sim`);

--
-- Indexes for table `tb_sim_karyawan`
--
ALTER TABLE `tb_sim_karyawan`
  ADD PRIMARY KEY (`id_sim_kary`);

--
-- Indexes for table `tb_sio_perusahaan`
--
ALTER TABLE `tb_sio_perusahaan`
  ADD PRIMARY KEY (`id_sio_perusahaan`),
  ADD KEY `no_sio` (`no_sio_perusahaan`),
  ADD KEY `FK_tb_sio_perusahaan_tb_m_perusahaan` (`id_m_perusahaan`);

--
-- Indexes for table `tb_statpajak`
--
ALTER TABLE `tb_statpajak`
  ADD PRIMARY KEY (`id_statpajak`);

--
-- Indexes for table `tb_stat_nikah`
--
ALTER TABLE `tb_stat_nikah`
  ADD PRIMARY KEY (`id_stat_nikah`),
  ADD KEY `agama` (`stat_nikah`);

--
-- Indexes for table `tb_stat_perjanjian`
--
ALTER TABLE `tb_stat_perjanjian`
  ADD PRIMARY KEY (`id_stat_perjanjian`);

--
-- Indexes for table `tb_stat_tinggal`
--
ALTER TABLE `tb_stat_tinggal`
  ADD PRIMARY KEY (`id_stat_tinggal`);

--
-- Indexes for table `tb_tipe`
--
ALTER TABLE `tb_tipe`
  ADD PRIMARY KEY (`id_tipe`);

--
-- Indexes for table `tb_tipe_akses_unit`
--
ALTER TABLE `tb_tipe_akses_unit`
  ADD PRIMARY KEY (`id_tipe_akses_unit`);

--
-- Indexes for table `tb_unit`
--
ALTER TABLE `tb_unit`
  ADD PRIMARY KEY (`id_unit`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `tb_vaksin_jenis`
--
ALTER TABLE `tb_vaksin_jenis`
  ADD PRIMARY KEY (`id_vaksin_jenis`),
  ADD KEY `agama` (`vaksin_jenis`);

--
-- Indexes for table `tb_vaksin_kary`
--
ALTER TABLE `tb_vaksin_kary`
  ADD PRIMARY KEY (`id_vaksin`);

--
-- Indexes for table `tb_vaksin_nama`
--
ALTER TABLE `tb_vaksin_nama`
  ADD PRIMARY KEY (`id_vaksin_nama`),
  ADD KEY `agama` (`vaksin_nama`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `keys`
--
ALTER TABLE `keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `limits`
--
ALTER TABLE `limits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_agama`
--
ALTER TABLE `tb_agama`
  MODIFY `id_agama` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_alamat`
--
ALTER TABLE `tb_alamat`
  MODIFY `id_alamat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_alamat_ktp`
--
ALTER TABLE `tb_alamat_ktp`
  MODIFY `id_alamat_ktp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_alasan_nonaktif`
--
ALTER TABLE `tb_alasan_nonaktif`
  MODIFY `id_alasan_nonaktif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_att`
--
ALTER TABLE `tb_att`
  MODIFY `id_att` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_audit`
--
ALTER TABLE `tb_audit`
  MODIFY `id_audit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tb_bank`
--
ALTER TABLE `tb_bank`
  MODIFY `id_bank` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `tb_bank_kary`
--
ALTER TABLE `tb_bank_kary`
  MODIFY `id_bank_kary` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_depart`
--
ALTER TABLE `tb_depart`
  MODIFY `id_depart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_doc_pengesahan_pjo`
--
ALTER TABLE `tb_doc_pengesahan_pjo`
  MODIFY `id_doc_pengesahaan_pjo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_ec`
--
ALTER TABLE `tb_ec`
  MODIFY `id_ec` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=393;

--
-- AUTO_INCREMENT for table `tb_error`
--
ALTER TABLE `tb_error`
  MODIFY `id_error` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tb_filependukung`
--
ALTER TABLE `tb_filependukung`
  MODIFY `id_file_pendukung` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_grade`
--
ALTER TABLE `tb_grade`
  MODIFY `id_grade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tb_ip_blacklist`
--
ALTER TABLE `tb_ip_blacklist`
  MODIFY `id_ip_blacklist` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_izin_perusahaan`
--
ALTER TABLE `tb_izin_perusahaan`
  MODIFY `id_izin_perusahaan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_izin_tambang`
--
ALTER TABLE `tb_izin_tambang`
  MODIFY `id_izin_tambang` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_izin_tambang_area`
--
ALTER TABLE `tb_izin_tambang_area`
  MODIFY `id_area` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_izin_tambang_detail_area`
--
ALTER TABLE `tb_izin_tambang_detail_area`
  MODIFY `id_izin_tambang_detail_area` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_izin_tambang_unit`
--
ALTER TABLE `tb_izin_tambang_unit`
  MODIFY `id_izin_tambang_unit` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_jenis_izin_tambang`
--
ALTER TABLE `tb_jenis_izin_tambang`
  MODIFY `id_jenis_izin_tambang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_jenis_perusahaan`
--
ALTER TABLE `tb_jenis_perusahaan`
  MODIFY `id_jenis_perusahaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_jenis_sertifikasi`
--
ALTER TABLE `tb_jenis_sertifikasi`
  MODIFY `id_jenis_sertifikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=193;

--
-- AUTO_INCREMENT for table `tb_jenis_usaha`
--
ALTER TABLE `tb_jenis_usaha`
  MODIFY `id_jenis_usaha` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_karyawan`
--
ALTER TABLE `tb_karyawan`
  MODIFY `id_kary` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_karyawan_nonaktif`
--
ALTER TABLE `tb_karyawan_nonaktif`
  MODIFY `id_kary_nonaktif` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_keluarga`
--
ALTER TABLE `tb_keluarga`
  MODIFY `id_keluarga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_klasifikasi`
--
ALTER TABLE `tb_klasifikasi`
  MODIFY `id_klasifikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_kontrak_karyawan`
--
ALTER TABLE `tb_kontrak_karyawan`
  MODIFY `id_kontrak_kary` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_kontrak_perusahaan`
--
ALTER TABLE `tb_kontrak_perusahaan`
  MODIFY `id_kontrak_perusahaan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_ktp`
--
ALTER TABLE `tb_ktp`
  MODIFY `id_ktp` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_langgar`
--
ALTER TABLE `tb_langgar`
  MODIFY `id_langgar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_langgar_jenis`
--
ALTER TABLE `tb_langgar_jenis`
  MODIFY `id_langgar_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_level`
--
ALTER TABLE `tb_level`
  MODIFY `id_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_log`
--
ALTER TABLE `tb_log`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tb_lokasi_pjo`
--
ALTER TABLE `tb_lokasi_pjo`
  MODIFY `id_lokasi_pjo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_lokker`
--
ALTER TABLE `tb_lokker`
  MODIFY `id_lokker` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tb_lokterima`
--
ALTER TABLE `tb_lokterima`
  MODIFY `id_lokterima` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tb_master`
--
ALTER TABLE `tb_master`
  MODIFY `id_master` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tb_mcu`
--
ALTER TABLE `tb_mcu`
  MODIFY `id_mcu` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_mcu_jenis`
--
ALTER TABLE `tb_mcu_jenis`
  MODIFY `id_mcu_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_menu`
--
ALTER TABLE `tb_menu`
  MODIFY `IdMenu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_modul`
--
ALTER TABLE `tb_modul`
  MODIFY `IdModul` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tb_modul_role_menu`
--
ALTER TABLE `tb_modul_role_menu`
  MODIFY `id_modul_role_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `tb_m_jenis_usaha`
--
ALTER TABLE `tb_m_jenis_usaha`
  MODIFY `id_m_jenis_usaha` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_m_perusahaan`
--
ALTER TABLE `tb_m_perusahaan`
  MODIFY `id_m_perusahaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=174;

--
-- AUTO_INCREMENT for table `tb_paybase`
--
ALTER TABLE `tb_paybase`
  MODIFY `id_paybase` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_pekerjaan`
--
ALTER TABLE `tb_pekerjaan`
  MODIFY `id_pekerjaan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_pendidikan`
--
ALTER TABLE `tb_pendidikan`
  MODIFY `id_pendidikan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tb_personal`
--
ALTER TABLE `tb_personal`
  MODIFY `id_personal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_perusahaan`
--
ALTER TABLE `tb_perusahaan`
  MODIFY `id_perusahaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `tb_pjo_perusahaan`
--
ALTER TABLE `tb_pjo_perusahaan`
  MODIFY `id_pjo_perusahaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `tb_poh`
--
ALTER TABLE `tb_poh`
  MODIFY `id_poh` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `tb_posisi`
--
ALTER TABLE `tb_posisi`
  MODIFY `id_posisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1558;

--
-- AUTO_INCREMENT for table `tb_roster`
--
ALTER TABLE `tb_roster`
  MODIFY `id_roster` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_sanksi`
--
ALTER TABLE `tb_sanksi`
  MODIFY `id_sanksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_section`
--
ALTER TABLE `tb_section`
  MODIFY `id_section` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_sertifikasi_kary`
--
ALTER TABLE `tb_sertifikasi_kary`
  MODIFY `id_sertifikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2714;

--
-- AUTO_INCREMENT for table `tb_sim`
--
ALTER TABLE `tb_sim`
  MODIFY `id_sim` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_sim_karyawan`
--
ALTER TABLE `tb_sim_karyawan`
  MODIFY `id_sim_kary` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=719;

--
-- AUTO_INCREMENT for table `tb_sio_perusahaan`
--
ALTER TABLE `tb_sio_perusahaan`
  MODIFY `id_sio_perusahaan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_statpajak`
--
ALTER TABLE `tb_statpajak`
  MODIFY `id_statpajak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_stat_nikah`
--
ALTER TABLE `tb_stat_nikah`
  MODIFY `id_stat_nikah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_stat_perjanjian`
--
ALTER TABLE `tb_stat_perjanjian`
  MODIFY `id_stat_perjanjian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tb_stat_tinggal`
--
ALTER TABLE `tb_stat_tinggal`
  MODIFY `id_stat_tinggal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_tipe`
--
ALTER TABLE `tb_tipe`
  MODIFY `id_tipe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_tipe_akses_unit`
--
ALTER TABLE `tb_tipe_akses_unit`
  MODIFY `id_tipe_akses_unit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_unit`
--
ALTER TABLE `tb_unit`
  MODIFY `id_unit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `tb_vaksin_jenis`
--
ALTER TABLE `tb_vaksin_jenis`
  MODIFY `id_vaksin_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_vaksin_kary`
--
ALTER TABLE `tb_vaksin_kary`
  MODIFY `id_vaksin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_vaksin_nama`
--
ALTER TABLE `tb_vaksin_nama`
  MODIFY `id_vaksin_nama` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_depart`
--
ALTER TABLE `tb_depart`
  ADD CONSTRAINT `FK_tb_depart_tb_perusahaan` FOREIGN KEY (`id_perusahaan`) REFERENCES `tb_perusahaan` (`id_perusahaan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_grade`
--
ALTER TABLE `tb_grade`
  ADD CONSTRAINT `FK_tb_grade_tb_perusahaan` FOREIGN KEY (`id_perusahaan`) REFERENCES `tb_perusahaan` (`id_perusahaan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_izin_perusahaan`
--
ALTER TABLE `tb_izin_perusahaan`
  ADD CONSTRAINT `FK_tb_izin_perusahaan_tb_m_perusahaan` FOREIGN KEY (`id_m_perusahaan`) REFERENCES `tb_m_perusahaan` (`id_m_perusahaan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_kontrak_perusahaan`
--
ALTER TABLE `tb_kontrak_perusahaan`
  ADD CONSTRAINT `FK_tb_kontrak_perusahaan_tb_m_perusahaan` FOREIGN KEY (`id_m_perusahaan`) REFERENCES `tb_m_perusahaan` (`id_m_perusahaan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_sio_perusahaan`
--
ALTER TABLE `tb_sio_perusahaan`
  ADD CONSTRAINT `FK_tb_sio_perusahaan_tb_m_perusahaan` FOREIGN KEY (`id_m_perusahaan`) REFERENCES `tb_m_perusahaan` (`id_m_perusahaan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
