-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: db_kary
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.27-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `keys`
--

DROP TABLE IF EXISTS `keys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `keys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `key` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT 0,
  `is_private_key` tinyint(1) NOT NULL DEFAULT 0,
  `ip_addresses` text DEFAULT NULL,
  `date_created` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `keys`
--

LOCK TABLES `keys` WRITE;
/*!40000 ALTER TABLE `keys` DISABLE KEYS */;
/*!40000 ALTER TABLE `keys` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `limits`
--

DROP TABLE IF EXISTS `limits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `limits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uri` varchar(255) NOT NULL,
  `count` int(10) NOT NULL,
  `hour_started` int(11) NOT NULL,
  `api_key` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `limits`
--

LOCK TABLES `limits` WRITE;
/*!40000 ALTER TABLE `limits` DISABLE KEYS */;
/*!40000 ALTER TABLE `limits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS `logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uri` varchar(255) NOT NULL,
  `method` varchar(6) NOT NULL,
  `params` text DEFAULT NULL,
  `api_key` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `time` int(11) NOT NULL,
  `rtime` float DEFAULT NULL,
  `authorized` varchar(1) NOT NULL,
  `response_code` smallint(3) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logs`
--

LOCK TABLES `logs` WRITE;
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_agama`
--

DROP TABLE IF EXISTS `tb_agama`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_agama` (
  `id_agama` int(11) NOT NULL AUTO_INCREMENT,
  `agama` varchar(50) NOT NULL,
  `ket_agama` varchar(1000) NOT NULL,
  `stat_agama` char(1) NOT NULL DEFAULT 'T',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_agama`),
  KEY `agama` (`agama`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_agama`
--

LOCK TABLES `tb_agama` WRITE;
/*!40000 ALTER TABLE `tb_agama` DISABLE KEYS */;
INSERT INTO `tb_agama` VALUES (1,'BUDDHA','-','T','2021-11-07 17:00:00','1970-01-01 00:00:00',1),(2,'HINDU','-','T','2021-11-07 17:00:00','1970-01-01 00:00:00',1),(3,'ISLAM','-','T','2021-11-07 17:00:00','1970-01-01 00:00:00',1),(4,'KATHOLIK','-','T','2021-11-07 17:00:00','1970-01-01 00:00:00',1),(5,'KHONGHUCU','-','T','2021-11-07 17:00:00','1970-01-01 00:00:00',1),(6,'KRISTEN','-','T','2021-11-07 17:00:00','1970-01-01 00:00:00',1);
/*!40000 ALTER TABLE `tb_agama` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_alamat`
--

DROP TABLE IF EXISTS `tb_alamat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_alamat` (
  `id_alamat` int(11) NOT NULL AUTO_INCREMENT,
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
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_alamat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_alamat`
--

LOCK TABLES `tb_alamat` WRITE;
/*!40000 ALTER TABLE `tb_alamat` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_alamat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_alamat_ktp`
--

DROP TABLE IF EXISTS `tb_alamat_ktp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_alamat_ktp` (
  `id_alamat_ktp` int(11) NOT NULL AUTO_INCREMENT,
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
  `id_user` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_alamat_ktp`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_alamat_ktp`
--

LOCK TABLES `tb_alamat_ktp` WRITE;
/*!40000 ALTER TABLE `tb_alamat_ktp` DISABLE KEYS */;
INSERT INTO `tb_alamat_ktp` VALUES (1,1,'JL. GERILYA NO. 45','046','000','6472061003','6472061','6472','64',0,'','T','2024-05-12 22:01:26','2024-05-12 22:01:26',1);
/*!40000 ALTER TABLE `tb_alamat_ktp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_alasan_nonaktif`
--

DROP TABLE IF EXISTS `tb_alasan_nonaktif`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_alasan_nonaktif` (
  `id_alasan_nonaktif` int(11) NOT NULL AUTO_INCREMENT,
  `alasan_nonaktif` varchar(200) NOT NULL DEFAULT '',
  `ket_alasan_nonaktif` varchar(1000) NOT NULL DEFAULT '',
  `stat_alasan_nonaktif` char(1) NOT NULL DEFAULT 'T',
  `stat_upload_berkas` char(1) NOT NULL DEFAULT 'T',
  `stat_blacklist` char(1) NOT NULL DEFAULT 'F',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_alasan_nonaktif`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_alasan_nonaktif`
--

LOCK TABLES `tb_alasan_nonaktif` WRITE;
/*!40000 ALTER TABLE `tb_alasan_nonaktif` DISABLE KEYS */;
INSERT INTO `tb_alasan_nonaktif` VALUES (1,'RESIGN','','T','T','F','2023-08-01 09:00:00','2023-08-01 09:00:00',1),(2,'RESIGN TANPA IZIN','','T','F','F','2023-08-01 09:00:00','2023-08-01 09:00:00',1),(3,'SAKIT BERKEPANJANGAN','','T','T','F','2023-08-01 09:00:00','2023-08-01 09:00:00',1),(4,'PENSIUN/PENSIUN DINI','','T','T','F','2023-08-01 09:00:00','2023-08-01 09:00:00',1),(5,'KESALAHAN BERAT','','T','T','T','2023-08-01 09:00:00','2023-08-01 09:00:00',1),(6,'MUTASI','','T','T','F','2023-08-01 09:00:00','2023-08-01 09:00:00',1),(7,'SELESAI KONTRAK','','T','F','F','2023-11-02 14:04:00','2023-11-02 14:04:00',1),(8,'MENINGGAL DUNIA','','T','T','F','2024-01-12 14:06:44','2024-01-12 14:06:44',59),(9,'PEMUTUSAN HUBUNGAN KERJA (PHK)','','T','T','T','2024-01-12 14:06:45','2024-01-12 14:06:45',59),(10,'TIDAK LULUS PROBATION','','T','T','F','2024-02-10 08:49:52','2024-02-10 08:49:52',59);
/*!40000 ALTER TABLE `tb_alasan_nonaktif` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_apikey`
--

DROP TABLE IF EXISTS `tb_apikey`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_apikey` (
  `auth_apikey` varchar(100) NOT NULL DEFAULT '',
  `stat_apikey` char(1) NOT NULL DEFAULT 'T',
  `apikey` varchar(250) NOT NULL,
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`auth_apikey`),
  KEY `apikey` (`apikey`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_apikey`
--

LOCK TABLES `tb_apikey` WRITE;
/*!40000 ALTER TABLE `tb_apikey` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_apikey` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_att`
--

DROP TABLE IF EXISTS `tb_att`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_att` (
  `id_att` int(11) NOT NULL AUTO_INCREMENT,
  `id_finger` varchar(10) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`id_att`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_att`
--

LOCK TABLES `tb_att` WRITE;
/*!40000 ALTER TABLE `tb_att` DISABLE KEYS */;
INSERT INTO `tb_att` VALUES (1,'51021149',1,'2024-05-12 11:43:44'),(2,'505242173',1,'2024-05-12 11:49:35'),(3,'51021149',1,'2024-05-16 06:26:33'),(5,'505242173',1,'2024-05-12 11:49:35'),(7,'50721056',15,'2023-01-04 09:59:53'),(8,'50721056',15,'2023-01-04 10:00:53'),(9,'50721056',15,'2023-01-04 10:12:16'),(10,'50422279',15,'2023-01-04 10:20:01'),(11,'50122197',15,'2023-01-04 10:53:50'),(12,'50721056',15,'2023-01-04 10:58:24'),(13,'50721056',15,'2023-01-04 11:29:24'),(14,'50721056',15,'2023-01-04 11:52:11'),(15,'50721056',15,'2023-01-04 12:47:38'),(16,'50721056',15,'2023-01-04 12:49:04'),(17,'50721056',15,'2023-01-04 13:02:00'),(18,'50122197',15,'2023-01-04 13:14:21'),(19,'50122197',15,'2023-01-04 13:29:00'),(20,'50721056',15,'2023-01-04 13:31:13'),(21,'50721056',15,'2023-01-04 13:35:13'),(22,'51122447',15,'2023-01-04 13:47:27'),(23,'50721056',15,'2023-01-04 15:32:05'),(24,'50721056',15,'2023-01-04 16:22:36'),(25,'50322251',15,'2023-01-06 13:31:43'),(26,'50322251',15,'2023-01-06 14:07:21'),(27,'50122197',15,'2023-01-06 14:07:53'),(28,'50721056',15,'2023-01-06 14:12:11'),(29,'50422279',15,'2023-01-06 16:40:07'),(30,'50721056',15,'2023-01-06 16:40:11'),(31,'50122197',15,'2023-01-06 16:52:04'),(32,'51021149',1,'2024-06-11 20:05:00'),(33,'51021149',1,'2024-06-12 08:12:00'),(34,'51021149',1,'2024-06-20 08:12:00'),(35,'505242173',15,'2024-06-12 08:52:04');
/*!40000 ALTER TABLE `tb_att` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_attfix`
--

DROP TABLE IF EXISTS `tb_attfix`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_attfix` (
  `id_att` int(11) NOT NULL AUTO_INCREMENT,
  `nik` varchar(15) DEFAULT NULL,
  `date` date NOT NULL,
  `in` time DEFAULT NULL,
  `out` time DEFAULT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_att`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_attfix`
--

LOCK TABLES `tb_attfix` WRITE;
/*!40000 ALTER TABLE `tb_attfix` DISABLE KEYS */;
INSERT INTO `tb_attfix` VALUES (85,'50721056','2023-01-04','00:00:00','12:47:38',1,NULL),(86,'51021149','2024-06-11','20:05:00','08:12:00',1,NULL),(87,'51021149','2024-06-12','00:00:00','00:00:00',0,NULL),(88,'505242173','2024-06-12','08:52:04','00:00:00',1,NULL);
/*!40000 ALTER TABLE `tb_attfix` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_audit`
--

DROP TABLE IF EXISTS `tb_audit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_audit` (
  `id_audit` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL DEFAULT 0,
  `jenis_proses` varchar(50) NOT NULL DEFAULT '',
  `data_proses` varchar(200) NOT NULL DEFAULT '',
  `nama_data` varchar(500) NOT NULL DEFAULT '',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  PRIMARY KEY (`id_audit`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_audit`
--

LOCK TABLES `tb_audit` WRITE;
/*!40000 ALTER TABLE `tb_audit` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_audit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_bank`
--

DROP TABLE IF EXISTS `tb_bank`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_bank` (
  `id_bank` int(11) NOT NULL AUTO_INCREMENT,
  `bank` varchar(50) NOT NULL DEFAULT '',
  `ket_bank` varchar(1000) NOT NULL,
  `stat_bank` char(1) NOT NULL DEFAULT 'T',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_bank`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_bank`
--

LOCK TABLES `tb_bank` WRITE;
/*!40000 ALTER TABLE `tb_bank` DISABLE KEYS */;
INSERT INTO `tb_bank` VALUES (1,'-','','T','2023-04-15 22:56:14','2023-04-15 22:56:14',1),(2,'BRI UNIT KAUBUN','','T','2023-04-15 22:56:14','2023-04-15 22:56:14',1),(3,'MANDIRI','','T','2023-04-15 22:56:14','2023-04-15 22:56:14',1),(4,'BRI UNIT LAMASI','','T','2023-04-15 22:56:14','2023-04-15 22:56:14',1),(5,'BRI LOA JANAN','','T','2023-04-15 22:56:14','2023-04-15 22:56:14',1),(6,'BNI UGM YOGYA','','T','2023-04-15 22:56:14','2023-04-15 22:56:14',1),(7,'BCA KCP AHMAD YANI','','T','2023-04-15 22:56:14','2023-04-15 22:56:14',1),(8,'MANDIRI KCP SANGATTA','','T','2023-04-15 22:56:14','2023-04-15 22:56:14',1),(9,'BCA KCP KETAPANG','','T','2023-04-15 22:56:14','2023-04-15 22:56:14',1),(10,'BNI BONTANG','','T','2023-04-15 22:56:14','2023-04-15 22:56:14',1),(11,'BRI SIMPEDES','','T','2023-04-15 22:56:14','2023-04-15 22:56:14',1),(12,'Bank BPD DIY','','T','2023-04-15 22:56:14','2023-04-15 22:56:14',1),(13,'BRI','','T','2023-04-15 22:56:14','2023-04-15 22:56:14',1),(14,'BCA','','T','2023-04-15 22:56:14','2023-04-15 22:56:14',1),(15,'BCA SAMARINDA','','T','2023-04-15 22:56:14','2023-04-15 22:56:14',1),(16,'BRI KAUBUN','','T','2023-04-15 22:56:14','2023-04-15 22:56:14',1),(17,'CIMB NIAGA','','T','2023-04-15 22:56:14','2023-04-15 22:56:14',1),(18,'BCA CIANJUR','','T','2023-04-15 22:56:14','2023-04-15 22:56:14',1),(19,'BNI','','T','2023-04-15 22:56:14','2023-04-15 22:56:14',1),(20,'BRI KCP RAPAK','','T','2023-04-15 22:56:14','2023-04-15 22:56:14',1),(21,'BRI UNIT SP2 SEBULU','','T','2023-04-15 22:56:14','2023-04-15 22:56:14',1),(22,'BRI UNIT PASAR KEMAKMURAN KOTABARU','','T','2023-04-15 22:56:14','2023-04-15 22:56:14',1),(23,'Bri Britama','','T','2023-04-15 22:56:14','2023-04-15 22:56:14',1),(24,'Britama','','T','2023-04-15 22:56:14','2023-04-15 22:56:14',1),(25,'Bank Ganesha','','T','2023-04-15 22:56:14','2023-04-15 22:56:14',1),(26,'Bank BNI','','T','2023-04-15 22:56:14','2023-04-15 22:56:14',1),(27,'Bank BRI','','T','2023-04-15 22:56:14','2023-04-15 22:56:14',1),(28,'Bank BCA','','T','2023-04-15 22:56:14','2023-04-15 22:56:14',1),(29,'Bank Mandiri','','T','2023-04-15 22:56:14','2023-04-15 22:56:14',1),(30,'Bank Kaltimtara','','T','2023-04-15 22:56:14','2023-04-15 22:56:14',1),(31,'Payrol Jakarta','','T','2023-04-15 22:56:14','2023-04-15 22:56:14',1),(32,'Bank Simas Gold','','T','2023-04-15 22:56:14','2023-04-15 22:56:14',1),(33,'Bank Sinarmas','','T','2023-04-15 22:56:14','2023-04-15 22:56:14',1),(34,'Bank BRI ','','T','2023-04-15 22:56:14','2023-04-15 22:56:14',1),(35,'Bank BNI 1946','','T','2023-04-15 22:56:14','2023-04-15 22:56:14',1);
/*!40000 ALTER TABLE `tb_bank` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_bank_kary`
--

DROP TABLE IF EXISTS `tb_bank_kary`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_bank_kary` (
  `id_bank_kary` int(11) NOT NULL AUTO_INCREMENT,
  `id_personal` int(11) NOT NULL DEFAULT 0,
  `id_bank` int(11) NOT NULL DEFAULT 0,
  `no_rek` varchar(150) NOT NULL DEFAULT '',
  `nama_pemilik` varchar(250) NOT NULL DEFAULT '',
  `stat_bank_kary` char(1) NOT NULL DEFAULT 'T',
  `ket_bank_kary` varchar(1000) DEFAULT NULL,
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_bank_kary`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_bank_kary`
--

LOCK TABLES `tb_bank_kary` WRITE;
/*!40000 ALTER TABLE `tb_bank_kary` DISABLE KEYS */;
INSERT INTO `tb_bank_kary` VALUES (1,1,15,'07834534555','IHFAN NOIFARA','T','','2024-05-12 22:04:10','2024-05-12 22:04:10',1);
/*!40000 ALTER TABLE `tb_bank_kary` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_depart`
--

DROP TABLE IF EXISTS `tb_depart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_depart` (
  `id_depart` int(11) NOT NULL AUTO_INCREMENT,
  `kd_depart` char(8) NOT NULL DEFAULT '',
  `depart` varchar(100) NOT NULL,
  `ket_depart` varchar(300) NOT NULL,
  `stat_depart` char(1) NOT NULL DEFAULT 'T',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0,
  `id_perusahaan` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_depart`),
  KEY `FK_tb_depart_tb_perusahaan` (`id_perusahaan`),
  CONSTRAINT `FK_tb_depart_tb_perusahaan` FOREIGN KEY (`id_perusahaan`) REFERENCES `tb_perusahaan` (`id_perusahaan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_depart`
--

LOCK TABLES `tb_depart` WRITE;
/*!40000 ALTER TABLE `tb_depart` DISABLE KEYS */;
INSERT INTO `tb_depart` VALUES (4,'SI','SISTEM INTEGRASI','','T','2024-05-12 21:55:48','2024-05-12 21:55:48',1,1);
/*!40000 ALTER TABLE `tb_depart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_doc_pengesahan_pjo`
--

DROP TABLE IF EXISTS `tb_doc_pengesahan_pjo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_doc_pengesahan_pjo` (
  `id_doc_pengesahaan_pjo` int(11) NOT NULL AUTO_INCREMENT,
  `id_pjo` int(11) NOT NULL DEFAULT 0,
  `no_doc_pengesahaan_pjo` varchar(100) NOT NULL DEFAULT '',
  `url_doc_pengesahaan_pjo` varchar(200) NOT NULL DEFAULT '',
  `tgl_aktif` date NOT NULL DEFAULT '1970-01-01',
  `tgl_akhir` date NOT NULL DEFAULT '1970-01-01',
  `alasan_nonaktif` varchar(1000) NOT NULL,
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_doc_pengesahaan_pjo`),
  KEY `no_doc_pengesahaan_pjo` (`no_doc_pengesahaan_pjo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_doc_pengesahan_pjo`
--

LOCK TABLES `tb_doc_pengesahan_pjo` WRITE;
/*!40000 ALTER TABLE `tb_doc_pengesahan_pjo` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_doc_pengesahan_pjo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_ec`
--

DROP TABLE IF EXISTS `tb_ec`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_ec` (
  `id_ec` int(11) NOT NULL AUTO_INCREMENT,
  `id_personal` int(11) NOT NULL DEFAULT 0,
  `nama_ec` varchar(100) NOT NULL DEFAULT '',
  `hp_ec` varchar(20) NOT NULL DEFAULT '0',
  `hp_ec_2` varchar(20) NOT NULL DEFAULT '0',
  `relasi_ec` varchar(100) NOT NULL DEFAULT '',
  `ket_ec` varchar(1000) NOT NULL DEFAULT '',
  `stat_ec` char(1) NOT NULL DEFAULT 'T',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0,
  KEY `idec` (`id_ec`)
) ENGINE=InnoDB AUTO_INCREMENT=393 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_ec`
--

LOCK TABLES `tb_ec` WRITE;
/*!40000 ALTER TABLE `tb_ec` DISABLE KEYS */;
INSERT INTO `tb_ec` VALUES (392,1,'WAHYUNI','082155553600','0','ISTRI','','T','2024-05-12 22:04:10','2024-05-12 22:04:10',1);
/*!40000 ALTER TABLE `tb_ec` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_error`
--

DROP TABLE IF EXISTS `tb_error`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_error` (
  `id_error` int(11) NOT NULL AUTO_INCREMENT,
  `email_error` varchar(200) NOT NULL DEFAULT '',
  `ip_error` varchar(200) NOT NULL DEFAULT '',
  `ip_akses` varchar(200) NOT NULL DEFAULT '',
  `msg_error` varchar(500) NOT NULL DEFAULT '',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  PRIMARY KEY (`id_error`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_error`
--

LOCK TABLES `tb_error` WRITE;
/*!40000 ALTER TABLE `tb_error` DISABLE KEYS */;
INSERT INTO `tb_error` VALUES (1,'syarif.mamardi@ungguldinamika.co.id','10.81.200.2','10.81.200.2','Sandi anda salah, kesempatan tinggal 4x','2024-05-12 23:23:16'),(2,'ihfan.noifara@ungguldinamika.co.id','10.81.200.2','10.81.200.2','Sandi anda salah, kesempatan tinggal 4x','2024-05-17 16:18:31'),(3,'kadek.ferliyawan@ungguldinamika.co.id','10.81.200.2','10.81.200.2','Mencoba akses aplikasi yang tidak diizinkan | TEMP','2024-05-17 16:20:38'),(4,'kadek.ferliyawan@ungguldinamika.co.id','192.168.158.72','192.168.158.72','Kode Captcha Salah','2024-05-17 16:47:53'),(5,'kadek.ferliyawan@ungguldinamika.co.id','192.168.158.72','192.168.158.72','Kode Captcha Salah','2024-05-17 16:48:12'),(6,'kadek.ferliyawan@ungguldinamika.co.id','192.168.158.72','192.168.158.72','Kode Captcha Salah','2024-05-17 16:48:24'),(7,'m.fahrizal@ungguldinamika.co.id','192.168.158.74','192.168.158.74','User tidak aktif','2024-05-17 16:55:12'),(8,'m.fahrizal@ungguldinamika.co.id','192.168.158.74','192.168.158.74','User tidak aktif','2024-05-17 16:55:35'),(9,'m.fahrizal@ungguldinamika.co.id','192.168.158.74','192.168.158.74','Kode Captcha Salah','2024-05-17 16:55:52'),(10,'m.fahrizal@ungguldinamika.co.id','192.168.158.74','192.168.158.74','User tidak aktif','2024-05-17 16:56:05'),(11,'m.fahrizal@ungguldinamika.co.id','192.168.158.74','192.168.158.74','User tidak aktif','2024-05-17 16:56:40'),(12,'ihfan.noifara@ungguldinamika.co.id','192.168.120.16','192.168.120.16','Kode Captcha Salah','2024-05-19 10:53:52');
/*!40000 ALTER TABLE `tb_error` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_filependukung`
--

DROP TABLE IF EXISTS `tb_filependukung`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_filependukung` (
  `id_file_pendukung` int(11) NOT NULL AUTO_INCREMENT,
  `id_personal` int(11) NOT NULL,
  `nama_file` varchar(500) NOT NULL DEFAULT '',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_file_pendukung`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_filependukung`
--

LOCK TABLES `tb_filependukung` WRITE;
/*!40000 ALTER TABLE `tb_filependukung` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_filependukung` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_grade`
--

DROP TABLE IF EXISTS `tb_grade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_grade` (
  `id_grade` int(11) NOT NULL AUTO_INCREMENT,
  `grade` int(11) NOT NULL DEFAULT 0,
  `id_level` int(11) NOT NULL DEFAULT 0,
  `ket_grade` varchar(2000) NOT NULL,
  `stat_grade` varchar(20) NOT NULL,
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0,
  `id_perusahaan` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_grade`),
  KEY `FK_tb_grade_tb_perusahaan` (`id_perusahaan`),
  CONSTRAINT `FK_tb_grade_tb_perusahaan` FOREIGN KEY (`id_perusahaan`) REFERENCES `tb_perusahaan` (`id_perusahaan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_grade`
--

LOCK TABLES `tb_grade` WRITE;
/*!40000 ALTER TABLE `tb_grade` DISABLE KEYS */;
INSERT INTO `tb_grade` VALUES (20,6,1,'','T','2024-05-12 21:57:06','2024-05-12 21:57:06',1,1);
/*!40000 ALTER TABLE `tb_grade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_ip_blacklist`
--

DROP TABLE IF EXISTS `tb_ip_blacklist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_ip_blacklist` (
  `id_ip_blacklist` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(100) NOT NULL DEFAULT '',
  `back_log` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `email_user` varchar(200) NOT NULL,
  PRIMARY KEY (`id_ip_blacklist`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_ip_blacklist`
--

LOCK TABLES `tb_ip_blacklist` WRITE;
/*!40000 ALTER TABLE `tb_ip_blacklist` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_ip_blacklist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_izin_perusahaan`
--

DROP TABLE IF EXISTS `tb_izin_perusahaan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_izin_perusahaan` (
  `id_izin_perusahaan` int(11) NOT NULL AUTO_INCREMENT,
  `id_m_perusahaan` int(11) NOT NULL DEFAULT 0,
  `no_izin_perusahaan` varchar(100) NOT NULL DEFAULT '',
  `tgl_mulai_izin` date NOT NULL DEFAULT '1970-01-01',
  `tgl_akhir_izin` date NOT NULL DEFAULT '1970-01-01',
  `url_izin_perusahaan` varchar(500) NOT NULL,
  `ket_izin_perusahaan` varchar(1000) NOT NULL,
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_izin_perusahaan`),
  KEY `FK_tb_izin_perusahaan_tb_m_perusahaan` (`id_m_perusahaan`),
  CONSTRAINT `FK_tb_izin_perusahaan_tb_m_perusahaan` FOREIGN KEY (`id_m_perusahaan`) REFERENCES `tb_m_perusahaan` (`id_m_perusahaan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_izin_perusahaan`
--

LOCK TABLES `tb_izin_perusahaan` WRITE;
/*!40000 ALTER TABLE `tb_izin_perusahaan` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_izin_perusahaan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_izin_tambang`
--

DROP TABLE IF EXISTS `tb_izin_tambang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_izin_tambang` (
  `id_izin_tambang` int(11) NOT NULL AUTO_INCREMENT,
  `id_kary` int(11) NOT NULL DEFAULT 0,
  `id_jenis_izin_tambang` int(11) NOT NULL DEFAULT 0,
  `no_reg` varchar(50) NOT NULL,
  `tgl_expired` date NOT NULL DEFAULT '1970-01-01',
  `id_sim_kary` int(11) NOT NULL DEFAULT 0,
  `url_izin_tambang` varchar(1000) NOT NULL,
  `ket_izin_tambang` varchar(1000) NOT NULL,
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_izin_tambang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_izin_tambang`
--

LOCK TABLES `tb_izin_tambang` WRITE;
/*!40000 ALTER TABLE `tb_izin_tambang` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_izin_tambang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_izin_tambang_area`
--

DROP TABLE IF EXISTS `tb_izin_tambang_area`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_izin_tambang_area` (
  `id_area` int(11) NOT NULL AUTO_INCREMENT,
  `area` varchar(250) NOT NULL DEFAULT '',
  `stat_area` char(1) NOT NULL DEFAULT 'T',
  `ket_area` varchar(2000) NOT NULL DEFAULT '',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_area`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_izin_tambang_area`
--

LOCK TABLES `tb_izin_tambang_area` WRITE;
/*!40000 ALTER TABLE `tb_izin_tambang_area` DISABLE KEYS */;
INSERT INTO `tb_izin_tambang_area` VALUES (1,'UMUM','T','','2023-10-27 09:08:00','2023-10-27 09:08:00',1),(2,'PIT AREA','T','','2023-10-27 09:08:00','2023-10-27 09:08:00',1),(3,'PORT','T','','2023-10-27 09:08:00','2023-10-27 09:08:00',1),(4,'CPP 33','T','','2023-10-27 09:08:00','2023-10-27 09:08:00',1),(5,'GUDANG HANDAK','T','','2023-10-27 09:08:00','2023-10-27 09:08:00',1),(6,'QUARRY','T','','2023-10-27 09:08:00','2023-10-27 09:08:00',1),(7,'AREA PELEDAKAN','T','','2023-10-27 09:08:00','2023-10-27 09:08:00',1);
/*!40000 ALTER TABLE `tb_izin_tambang_area` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_izin_tambang_detail_area`
--

DROP TABLE IF EXISTS `tb_izin_tambang_detail_area`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_izin_tambang_detail_area` (
  `id_izin_tambang_detail_area` int(11) NOT NULL AUTO_INCREMENT,
  `id_izin_tambang` int(11) NOT NULL DEFAULT 0,
  `id_area` int(11) NOT NULL DEFAULT 0,
  `stat_izin_tambang_area` char(1) NOT NULL DEFAULT 'T',
  `ket_izin_tambang_area` varchar(2000) NOT NULL DEFAULT '',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_izin_tambang_detail_area`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_izin_tambang_detail_area`
--

LOCK TABLES `tb_izin_tambang_detail_area` WRITE;
/*!40000 ALTER TABLE `tb_izin_tambang_detail_area` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_izin_tambang_detail_area` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_izin_tambang_unit`
--

DROP TABLE IF EXISTS `tb_izin_tambang_unit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_izin_tambang_unit` (
  `id_izin_tambang_unit` int(11) NOT NULL AUTO_INCREMENT,
  `id_izin_tambang` int(11) NOT NULL DEFAULT 0,
  `id_unit` int(11) NOT NULL DEFAULT 0,
  `id_tipe_akses_unit` int(11) NOT NULL DEFAULT 0,
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_izin_tambang_unit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_izin_tambang_unit`
--

LOCK TABLES `tb_izin_tambang_unit` WRITE;
/*!40000 ALTER TABLE `tb_izin_tambang_unit` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_izin_tambang_unit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_jadwal`
--

DROP TABLE IF EXISTS `tb_jadwal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_jadwal` (
  `id_jadwal` int(11) NOT NULL AUTO_INCREMENT,
  `nik` varchar(100) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `kode_shift` varchar(100) DEFAULT NULL,
  `id_kat` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_jadwal`)
) ENGINE=InnoDB AUTO_INCREMENT=808 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_jadwal`
--

LOCK TABLES `tb_jadwal` WRITE;
/*!40000 ALTER TABLE `tb_jadwal` DISABLE KEYS */;
INSERT INTO `tb_jadwal` VALUES (1,'50721056','2023-01-04','D',NULL),(2,'51021149','2024-06-10','D',NULL),(3,'51021149','2024-06-11','N',NULL),(4,'51021149','2024-06-12','O',NULL),(5,'51021149','2024-06-13','N',NULL),(6,'51021149','2024-06-14','N',NULL),(7,'51021149','2024-06-15','O',NULL),(8,'505242173','2024-06-10','N',NULL),(9,'505242173','2024-06-11','O',NULL),(10,'505242173','2024-06-12','D',NULL),(11,'505242173','2024-06-13','N',NULL),(12,'505242173','2024-06-14','O',NULL),(13,'505242173','2024-06-15','D',NULL),(14,'51021149','2024-07-01','D',NULL),(15,'51021149','2024-07-02','N',NULL),(16,'51021149','2024-07-03','O',NULL),(17,'51021149','2024-07-04','D',NULL),(18,'51021149','2024-07-05','N',NULL),(19,'51021149','2024-07-06','O',NULL),(20,'505242173','2024-07-01','N',NULL),(21,'505242173','2024-07-02','O',NULL),(22,'505242173','2024-07-03','D',NULL),(23,'505242173','2024-07-04','N',NULL),(24,'505242173','2024-07-05','O',NULL),(25,'505242173','2024-07-06','D',NULL),(26,'51021149','2024-06-01','D',NULL),(27,'51021149','2024-06-02','N',NULL),(28,'51021149','2024-06-03','O',NULL),(29,'51021149','2024-06-04','N',NULL),(30,'51021149','2024-06-05','O',NULL),(31,'505242173','2024-06-01','N',NULL),(32,'505242173','2024-06-02','D',NULL),(33,'505242173','2024-06-03','N',NULL),(34,'505242173','2024-06-04','O',NULL),(35,'505242173','2024-06-05','D',NULL),(36,'51021149','2024-08-01','D',NULL),(37,'51021149','2024-08-02','D',NULL),(38,'51021149','2024-08-03','D',NULL),(39,'51021149','2024-08-04','D',NULL),(40,'51021149','2024-08-05','D',NULL),(41,'51021149','2024-08-06','D',NULL),(42,'51021149','2024-08-07','D',NULL),(43,'51021149','2024-08-08','D',NULL),(44,'51021149','2024-08-09','O',NULL),(45,'51021149','2024-08-10','D',NULL),(46,'505242173','2024-08-01','N',NULL),(47,'505242173','2024-08-02','N',NULL),(48,'505242173','2024-08-03','N',NULL),(49,'505242173','2024-08-04','N',NULL),(50,'505242173','2024-08-05','O',NULL),(51,'505242173','2024-08-06','N',NULL),(52,'505242173','2024-08-07','D',NULL),(53,'505242173','2024-08-08','D',NULL),(54,'505242173','2024-08-09','D',NULL),(55,'505242173','2024-08-10','D',NULL),(776,'51021149','2024-08-01','D',NULL),(777,'51021149','2024-08-02','N',NULL),(778,'51021149','2024-08-03','O',NULL),(779,'505242173','2024-08-01','O',NULL),(780,'505242173','2024-08-02','N',NULL),(781,'505242173','2024-08-03','N',NULL),(782,'51021149','2024-08-01','D',NULL),(783,'51021149','2024-08-02','N',NULL),(784,'51021149','2024-08-03','O',NULL),(785,'51021149','2024-08-04','D',NULL),(786,'51021149','2024-08-05','N',NULL),(787,'51021149','2024-08-06','O',NULL),(788,'51021149','2024-08-07','D',NULL),(789,'51021149','2024-08-08','N',NULL),(790,'51021149','2024-08-09','O',NULL),(791,'51021149','2024-08-10','D',NULL),(792,'505242173','2024-08-01','N',NULL),(793,'505242173','2024-08-02','O',NULL),(794,'505242173','2024-08-03','D',NULL),(795,'505242173','2024-08-04','N',NULL),(796,'505242173','2024-08-05','O',NULL),(797,'505242173','2024-08-06','D',NULL),(798,'505242173','2024-08-07','N',NULL),(799,'505242173','2024-08-08','O',NULL),(800,'505242173','2024-08-09','D',NULL),(801,'505242173','2024-08-10','N',NULL),(802,'51021149','2024-06-15','D',NULL),(803,'51021149','2024-06-16','N',NULL),(804,'505242173','2024-06-15','N',NULL),(805,'505242173','2024-06-16','O',NULL),(806,'50721056','2024-06-15','O',NULL),(807,'50721056','2024-06-16','N',NULL);
/*!40000 ALTER TABLE `tb_jadwal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_jenis_izin_tambang`
--

DROP TABLE IF EXISTS `tb_jenis_izin_tambang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_jenis_izin_tambang` (
  `id_jenis_izin_tambang` int(11) NOT NULL AUTO_INCREMENT,
  `kode_jenis_izin_tambang` char(8) NOT NULL DEFAULT '',
  `jenis_izin_tambang` varchar(100) NOT NULL DEFAULT '',
  `ket_jenis_izin_tambang` varchar(2500) NOT NULL DEFAULT '',
  `stat_jenis_izin_tambang` char(1) NOT NULL DEFAULT 'T',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0,
  `id_perusahaan` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_jenis_izin_tambang`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_jenis_izin_tambang`
--

LOCK TABLES `tb_jenis_izin_tambang` WRITE;
/*!40000 ALTER TABLE `tb_jenis_izin_tambang` DISABLE KEYS */;
INSERT INTO `tb_jenis_izin_tambang` VALUES (1,'MP','MINE PERMIT','','T','1970-01-01 00:00:00','1970-01-01 00:00:00',1,0),(2,'SP','SIMPER','','T','1970-01-01 00:00:00','1970-01-01 00:00:00',1,0);
/*!40000 ALTER TABLE `tb_jenis_izin_tambang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_jenis_perusahaan`
--

DROP TABLE IF EXISTS `tb_jenis_perusahaan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_jenis_perusahaan` (
  `id_jenis_perusahaan` int(11) NOT NULL AUTO_INCREMENT,
  `jenis_perusahaan` varchar(100) NOT NULL,
  `no_jenis_perusahaan` char(10) NOT NULL,
  `ket_jenis_perusahaan` varchar(1000) NOT NULL,
  `stat_jenis_perusahaan` char(1) NOT NULL DEFAULT 'T',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_jenis_perusahaan`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_jenis_perusahaan`
--

LOCK TABLES `tb_jenis_perusahaan` WRITE;
/*!40000 ALTER TABLE `tb_jenis_perusahaan` DISABLE KEYS */;
INSERT INTO `tb_jenis_perusahaan` VALUES (1,'OWNER','1','','T','2023-04-18 00:00:00','2023-04-18 00:00:00',1),(2,'CONTRACTOR','2','','T','1970-01-01 00:00:00','1970-01-01 00:00:00',1),(3,'SUBCONTRACTOR','3','','T','1970-01-01 00:00:00','1970-01-01 00:00:00',1);
/*!40000 ALTER TABLE `tb_jenis_perusahaan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_jenis_sertifikasi`
--

DROP TABLE IF EXISTS `tb_jenis_sertifikasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_jenis_sertifikasi` (
  `id_jenis_sertifikasi` int(11) NOT NULL AUTO_INCREMENT,
  `kode_jenis_sertifikasi` varchar(15) NOT NULL,
  `jenis_sertifikasi` varchar(225) NOT NULL,
  `beranda` char(1) NOT NULL,
  `ket_jenis_sertifikasi` varchar(50) NOT NULL,
  `stat_jenis_sertifikasi` char(1) NOT NULL DEFAULT 'T',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_jenis_sertifikasi`),
  KEY `kode_sertifikasi` (`kode_jenis_sertifikasi`)
) ENGINE=InnoDB AUTO_INCREMENT=193 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_jenis_sertifikasi`
--

LOCK TABLES `tb_jenis_sertifikasi` WRITE;
/*!40000 ALTER TABLE `tb_jenis_sertifikasi` DISABLE KEYS */;
INSERT INTO `tb_jenis_sertifikasi` VALUES (1,'POP','PENGAWAS OPERASIONAL PERTAMA','T','-','T','1970-01-01 00:00:00','1970-01-01 00:00:00',1),(2,'POM','PENGAWAS OPERASIONAL MADYA','T','-','T','1970-01-01 00:00:00','1970-01-01 00:00:00',1),(3,'POU','PENGAWAS OPERASIONAL UTAMA','T','-','T','1970-01-01 00:00:00','1970-01-01 00:00:00',1),(6,'P3KTK','PETUGAS P3K DI TEMPAT KERJA','F','','T','2023-09-07 08:00:00','2023-09-07 08:00:00',1),(7,'AK3U','AHLI K3 UMUM','F','','T','2023-09-07 08:00:00','2023-09-07 08:00:00',1),(8,'PPCUB','PETUGAS PENGUJI CONTOH UJI BATUBARA','F','','T','2023-09-07 08:00:00','2023-09-07 08:00:00',1),(9,'PVTB','PETUGAS VERIFIKASI TEKNIS BATUBARA','F','','T','2023-09-07 08:00:00','2023-09-07 08:00:00',1),(10,'PMCUB','PETUGAS PENGAMBIL CONTOH UJI BATUBARA','F','-','T','2023-10-09 17:29:00','2023-10-09 17:29:00',1),(11,'AD','ACQUIRE & DATABASE','F','-','T','2023-12-02 10:53:05','2023-12-02 10:53:05',59),(12,'AM','ADVACE MINESCAPE 7 / 2021','F','-','T','2023-12-02 10:53:33','2023-12-02 10:53:33',59),(13,'AEFBDA','ADVANCE EXCEL FOR BUSINESS AND DATA ANALYSIS','F','-','T','2023-12-02 10:53:33','2023-12-02 10:53:33',59),(14,'AK','AHLI KEPELABUHANAN','F','-','T','2023-12-02 10:53:33','2023-12-02 10:53:33',59),(15,'AKL','AK3 LISTRIK ','F','-','T','2023-12-02 10:53:33','2023-12-02 10:53:33',59),(16,'AKOG','AK3 OPERATOR GENSET','F','-','T','2023-12-02 10:53:33','2023-12-02 10:53:33',59),(17,'AB','ALIGNMENT & BALANCING','F','-','T','2023-12-02 10:53:33','2023-12-02 10:53:33',59),(18,'APB','ANALISIS DAN PENGUJIAN BATUBARA','F','-','T','2023-12-02 10:53:33','2023-12-02 10:53:33',59),(19,'AP','ANALISIS PROKSIMAT (BNSP)','F','-','T','2023-12-02 10:53:33','2023-12-02 10:53:33',59),(20,'AIISO','AUDIT INTERNAL ISO 45001:2018','F','-','T','2023-12-02 10:53:33','2023-12-02 10:53:33',59),(21,'ASML','AUDITOR SML, ISO 14000','F','-','T','2023-12-02 10:53:33','2023-12-02 10:53:33',59),(22,'BLM','BERTHING AND LOADING MASTER','F','-','T','2023-12-02 10:53:41','2023-12-02 10:53:41',59),(23,'CEMTC','CARA EFEKTIF MENGELOLA TRAINING CENTER','F','-','T','2023-12-02 10:53:41','2023-12-02 10:53:41',59),(24,'CCM','COACHING, COUNSELING & MENTORING','F','-','T','2023-12-02 10:53:41','2023-12-02 10:53:41',59),(25,'CSK','COMMUNICATION SKILL','F','-','T','2023-12-02 10:53:41','2023-12-02 10:53:41',59),(26,'CB','COMPENSATION AND BENEFIT','F','-','T','2023-12-02 10:53:41','2023-12-02 10:53:41',59),(27,'CBRS','COMPETENCY BASED RECRUITMENT & SELECTION','F','-','T','2023-12-02 10:53:41','2023-12-02 10:53:41',59),(28,'CS','CONFINED SPACE','F','-','T','2023-12-02 10:53:41','2023-12-02 10:53:41',59),(29,'DMPS','DECISION MAKING & PROBLEM SOLVING','F','-','T','2023-12-02 10:53:41','2023-12-02 10:53:41',59),(30,'DP','DESAIN PRESENTASI','F','-','T','2023-12-02 10:53:41','2023-12-02 10:53:41',59),(31,'DJUT','DIKLAT & UJI KOMPETENSI JURU UKUR TAMBANG','F','-','T','2023-12-02 10:53:41','2023-12-02 10:53:41',59),(32,'GTP','DIKLAT GEOLOGI TEKNIK PERTAMBANGAN','F','-','T','2023-12-02 10:53:46','2023-12-02 10:53:46',59),(33,'HP','DIKLAT HIDROLOGI PERTAMBANGAN','F','-','T','2023-12-02 10:53:46','2023-12-02 10:53:46',59),(34,'IKT','DIKLAT INVESTIGASI KECELAKAAN TAMBANG','F','-','T','2023-12-02 10:53:46','2023-12-02 10:53:46',59),(35,'PP','DIKLAT PENGELOLA PELEDAKAN (KJL 1)','F','-','T','2023-12-02 10:53:46','2023-12-02 10:53:46',59),(36,'DC','DOCUMENT CONTROL','F','-','T','2023-12-02 10:53:46','2023-12-02 10:53:46',59),(37,'DHSAFCRE','DRILL HOLES SPACING ANALYSIS FOR COAL RESOURCES EVALUATION','F','-','T','2023-12-02 10:53:46','2023-12-02 10:53:46',59),(38,'DRP','DRONE PEMETAAN','F','-','T','2023-12-02 10:53:46','2023-12-02 10:53:46',59),(39,'ETHIT','EFECTIVE TRAINING & HIGH IMPACT TRAINING','F','-','T','2023-12-02 10:53:46','2023-12-02 10:53:46',59),(40,'ECS','EFFECTIVE COMMUNICATION SKILL','F','-','T','2023-12-02 10:53:46','2023-12-02 10:53:46',59),(41,'ERT','ERT-BANTUAN HIDUP DASAR','F','-','T','2023-12-02 10:53:46','2023-12-02 10:53:46',59),(42,'EPSDB','ESTIMASI PELAPORAN SUMBER DAYA BATUBARA','F','-','T','2023-12-02 10:53:51','2023-12-02 10:53:51',59),(43,'EDW','EXPLORATION DATA WAREHOUSE (EDW) MINERBA','F','-','T','2023-12-02 10:53:51','2023-12-02 10:53:51',59),(44,'GM','GADA MADYA','F','-','T','2023-12-02 10:53:51','2023-12-02 10:53:51',59),(45,'GP','GADA PRATAMA','F','-','T','2023-12-02 10:53:51','2023-12-02 10:53:51',59),(46,'GU','GADA UTAMA','F','-','T','2023-12-02 10:53:51','2023-12-02 10:53:51',59),(47,'GEB','GEOLOGI & EKEPLORASI BATUBARA','F','-','T','2023-12-02 10:53:51','2023-12-02 10:53:51',59),(48,'GEOS','GEOSTATISTIK','F','-','T','2023-12-02 10:53:51','2023-12-02 10:53:51',59),(49,'GLP','GOOD LABORATORY PRACTICE','F','-','T','2023-12-02 10:53:51','2023-12-02 10:53:51',59),(50,'HIPN','HUBUNGAN INDUSTRIAL DAN PERSELISIHAN DAN NEGOSIASI','F','-','T','2023-12-02 10:53:51','2023-12-02 10:53:51',59),(51,'IISO','IMPLEMENTASI ISO 45001:2018','F','-','T','2023-12-02 10:53:51','2023-12-02 10:53:51',59),(52,'IK3L','IMPLEMENTASI K3 DI LABORATORIUM','F','-','T','2023-12-02 10:53:57','2023-12-02 10:53:57',59),(53,'ISMKP','IMPLEMENTASI SMKP MINERBA','F','-','T','2023-12-02 10:53:57','2023-12-02 10:53:57',59),(54,'ISMRISO','IMPLEMENTASI STANDARD MANAGEMENT RESIKO ISO 31000:2009','F','-','T','2023-12-02 10:53:57','2023-12-02 10:53:57',59),(55,'IPPMK','IMPLEMENTASI PROGRAM PPM MASA KINI','F','-','T','2023-12-02 10:53:57','2023-12-02 10:53:57',59),(56,'IAISO','INTERNAL AUDIT ISO/IEC 17025:2017','F','-','T','2023-12-02 10:53:57','2023-12-02 10:53:57',59),(57,'IAISPS','INTERNAL AUDITOR ISPS','F','-','T','2023-12-02 10:53:57','2023-12-02 10:53:57',59),(58,'JLK','JURU LEDAK KELAS II','F','-','T','2023-12-02 10:53:57','2023-12-02 10:53:57',59),(59,'JUT','JURU UKUR TAMBANG','F','-','T','2023-12-02 10:53:57','2023-12-02 10:53:57',59),(60,'K3M','K3 MECHANIC','F','-','T','2023-12-02 10:53:57','2023-12-02 10:53:57',59),(61,'K3OPK','K3 OPERATOR PRODUKSI KELAS I','F','-','T','2023-12-02 10:53:57','2023-12-02 10:53:57',59),(62,'KNL','KNOWLEDGE (BEARING)','F','-','T','2023-12-02 10:54:02','2023-12-02 10:54:02',59),(63,'KKBSM','KUANTITAS & KUALITAS BATUBARA DAN STOCKPILE MANAGEMENT','F','-','T','2023-12-02 10:54:02','2023-12-02 10:54:02',59),(64,'LSS','LEAN SIX SIGMA','F','-','T','2023-12-02 10:54:02','2023-12-02 10:54:02',59),(65,'MP','MAINTENANCE PLANNING','F','-','T','2023-12-02 10:54:02','2023-12-02 10:54:02',59),(66,'MMNT','MANAGEMENT PERALATAN LAB & EVALUASI PERFORMA ALAT UKUR','F','-','T','2023-12-02 10:54:02','2023-12-02 10:54:02',59),(67,'PBK','PELATIHAN BEKERJA DI KETINGGIAN SERTIFIKASI KEMNAKER','F','-','T','2023-12-02 10:54:02','2023-12-02 10:54:02',59),(68,'PPP','PENDAMPINGAN PROGRAM PPM','F','-','T','2023-12-02 10:54:02','2023-12-02 10:54:02',59),(69,'PPVIP','PENGAMANAN DAN PELAYANAN VIP/VVIP','F','-','T','2023-12-02 10:54:02','2023-12-02 10:54:02',59),(70,'PB','PENGAPALAN BATUBARA','F','-','T','2023-12-02 10:54:02','2023-12-02 10:54:02',59),(71,'PPMP','PERBAIKAN PRODUKTIVITAS MELALUI PENINGKATAS KUALITAS & PENGHEMATAN BIAYA','F','-','T','2023-12-02 10:54:02','2023-12-02 10:54:02',59),(72,'PT','PERENCANAAN TAMBANG','F','-','T','2023-12-02 10:54:07','2023-12-02 10:54:07',59),(73,'PAK3K','PERPANJANGAN AHLI K3 KEBAKARAN','F','-','T','2023-12-02 10:54:07','2023-12-02 10:54:07',59),(74,'PTT','PROCUREMENT TRAINING (BNSP)','F','-','T','2023-12-02 10:54:07','2023-12-02 10:54:07',59),(75,'MPP','PROGRAM MASA PERSIAPAN PENSIUN (MPP)','F','-','T','2023-12-02 10:54:07','2023-12-02 10:54:07',59),(76,'PM','PROJECT MANAGEMENT','F','-','T','2023-12-02 10:54:07','2023-12-02 10:54:07',59),(77,'PL','PROPER LINGKUNGAN','F','-','T','2023-12-02 10:54:07','2023-12-02 10:54:07',59),(78,'QAL','QUALITY ASSURANCE LABORATORY','F','-','T','2023-12-02 10:54:07','2023-12-02 10:54:07',59),(79,'RS','RECRUITMENT & SELECTION','F','-','T','2023-12-02 10:54:07','2023-12-02 10:54:07',59),(80,'RM','RISK MANAGEMENT','F','-','T','2023-12-02 10:54:07','2023-12-02 10:54:07',59),(81,'SPAB','SAMPLING PREPARASI DAN ANALISA BATUBARA','F','-','T','2023-12-02 10:54:07','2023-12-02 10:54:07',59),(82,'CPI','SERTIFIKASI COMPETENT PERSON INDONESIA','F','-','T','2023-12-02 10:54:12','2023-12-02 10:54:12',59),(83,'PPPA','SERTIFIKASI PENANGGUNGJAWAB PENGENDALIAN PENCEMARAN AIR','F','-','T','2023-12-02 10:54:12','2023-12-02 10:54:12',59),(84,'PFSO','SERTIFIKASI PFSO','F','-','T','2023-12-02 10:54:12','2023-12-02 10:54:12',59),(85,'CHCS','SERTIFKASI CHCS - BNSP','F','-','T','2023-12-02 10:54:12','2023-12-02 10:54:12',59),(86,'SPP','SISTEM PENYALIRAN TAMBANG','F','-','T','2023-12-02 10:54:12','2023-12-02 10:54:12',59),(87,'SSU','STRUKTUR SKALA UPAH BASED ON PERMENAKERTRANS NO 1 TAHUN 2017','F','-','T','2023-12-02 10:54:12','2023-12-02 10:54:12',59),(88,'SB','STUDI BANDING UNTUK MEMAHAMI PROGRAM COMDEV','F','-','T','2023-12-02 10:54:12','2023-12-02 10:54:12',59),(89,'SDP','SUPERVISORY DEVELOPMENT PROGRAM','F','-','T','2023-12-02 10:54:12','2023-12-02 10:54:12',59),(90,'TEHQC','TEKNIK EVALUASI HASIL QC LAB & KOMPETENSI ANALIS','F','-','T','2023-12-02 10:54:12','2023-12-02 10:54:12',59),(91,'TKSM','TEKNIK KALIBRASI SUHU/MASSA','F','-','T','2023-12-02 10:54:12','2023-12-02 10:54:12',59),(92,'TSIM','TEKNIK SUPERVISI DAN INSPEKSI MUTU','F','-','T','2023-12-02 10:54:17','2023-12-02 10:54:17',59),(93,'TK3L','TEKNISI K3 LISTRIK','F','-','T','2023-12-02 10:54:17','2023-12-02 10:54:17',59),(94,'TCS','TRAINING & CERTIFIED SCAFFOLDING','F','-','T','2023-12-02 10:54:17','2023-12-02 10:54:17',59),(95,'TASMKP','TRAINING AUDIT SMKP','F','-','T','2023-12-02 10:54:17','2023-12-02 10:54:17',59),(96,'TA','TRAINING AUDITING','F','-','T','2023-12-02 10:54:17','2023-12-02 10:54:17',59),(97,'TAC3D','TRAINING AUTOCAD CIVIL 3D','F','-','T','2023-12-02 10:54:17','2023-12-02 10:54:17',59),(98,'TB','TRAINING BUDGETING','F','-','T','2023-12-02 10:54:17','2023-12-02 10:54:17',59),(99,'TCQCA','TRAINING COAL QUALITY CONTROL & ASSURANCE','F','-','T','2023-12-02 10:54:17','2023-12-02 10:54:17',59),(100,'TJPAT','TRAINING DIKLAT DAN SERTIFIKAT JURU PENGEBORAN AIR TANAH','F','-','T','2023-12-02 10:54:17','2023-12-02 10:54:17',59),(101,'TFO','TRAINING FO SPLICING & OTDR','F','-','T','2023-12-02 10:54:17','2023-12-02 10:54:17',59),(102,'TGDMG','TRAINING GEOLOGI DATABASE & MODELING GEOLOGI (UPGAREDING)','F','-','T','2023-12-02 10:54:22','2023-12-02 10:54:22',59),(103,'TISMKP','TRAINING IMPLEMENTASI SMKP','F','-','T','2023-12-02 10:54:22','2023-12-02 10:54:22',59),(104,'TK3KK','TRAINING K3 KEBAKARAN KELAS C','F','-','T','2023-12-02 10:54:22','2023-12-02 10:54:22',59),(105,'TM','TRAINING MINES','F','-','T','2023-12-02 10:54:22','2023-12-02 10:54:22',59),(106,'TNSI','TRAINING NEGOTIATION SKILL & IMPLEMENTATION','F','-','T','2023-12-02 10:54:22','2023-12-02 10:54:22',59),(107,'TNI','TRAINING NETWORK INFRASTRUKTUR','F','-','T','2023-12-02 10:54:22','2023-12-02 10:54:22',59),(108,'TOT','TRAINING OF TRAINER (TOT)','F','-','T','2023-12-02 10:54:22','2023-12-02 10:54:22',59),(109,'TPJSA','TRAINING PEMBUATAN JSA','F','-','T','2023-12-02 10:54:22','2023-12-02 10:54:22',59),(110,'TPD','TRAINING PENGOPERASIAN DRONE','F','-','T','2023-12-02 10:54:22','2023-12-02 10:54:22',59),(111,'TPRKAB','TRAINING PENYUSUNAN RKAB PERUSAHAAN TAMBANG ','F','-','T','2023-12-02 10:54:22','2023-12-02 10:54:22',59),(112,'TR','TRAINING REVALIDASI (LOAD TO BARGE)','F','-','T','2023-12-02 10:54:29','2023-12-02 10:54:29',59),(113,'TK3OG','TRAINING SERTIFIKASI K3 OPERATOR GENSET (KELAS 1)','F','-','T','2023-12-02 10:54:29','2023-12-02 10:54:29',59),(114,'TSS','TRAINING SPRAY SCHEDULER','F','-','T','2023-12-02 10:54:29','2023-12-02 10:54:29',59),(115,'TT','TRAINING TRANSHIPMENT (PENGAPALAN BATUBARA)','F','-','T','2023-12-02 10:54:29','2023-12-02 10:54:29',59),(116,'TUPJD','TRAINING UJI PENYEGARAN JURU LEDAK UNTUK PENGAJUAN KARTU IZIN MELEDAKKAN ANGKATAN 1','F','-','T','2023-12-02 10:54:29','2023-12-02 10:54:29',59),(117,'TWMCH','TRAINING WORKSHOP MANAGEMENT COAL HAULING','F','-','T','2023-12-02 10:54:29','2023-12-02 10:54:29',59),(118,'TOMWB','TRAINING/SEMINAR OPERASIONAL DAN MAINTENANCE WEIGHT BRIDGE','F','-','T','2023-12-02 10:54:29','2023-12-02 10:54:29',59),(119,'UIKT','UJI KOMPETENSI INVESTIGASI DAN KECELAKAAN TAMBANG','F','-','T','2023-12-02 10:54:29','2023-12-02 10:54:29',59),(120,'UTPPH','UMPIRE TEST UNTUK PENYELESAIAN PERBEDAAN HASIL ANALISIS BATUBARA','F','-','T','2023-12-02 10:54:29','2023-12-02 10:54:29',59),(121,'VCPI','VERIFIKASI CPI','F','-','T','2023-12-02 10:54:29','2023-12-02 10:54:29',59),(122,'WS4G','WELDING SERTIFIKASI - 4G (KELAS II)','F','-','T','2023-12-02 10:54:29','2023-12-02 10:54:29',59),(123,'WESDM','WORKSHOP ESDM (TERKAIT PERATURAN UPDATE)','F','-','T','2023-12-02 10:54:29','2023-12-02 10:54:29',59),(124,'WGC','WORKSHOP GEOLOGI & CONVENTION (IAGI/PERHAPI/GEOSERVICE)','F','-','T','2023-12-02 10:54:29','2023-12-02 10:54:29',59),(125,'WHGP','WORKSHOP HIDROLOGI & GEOTECHNICAL PERTAMBANGAN','F','-','T','2023-12-02 10:54:38','2023-12-02 10:54:38',59),(126,'CHCO','Sertifkasi CHCO - BNSP','F','-','T','2023-12-02 14:32:42','2023-12-02 14:32:42',59),(127,'PPM','Pekerja Peledakan Madya','F','-','T','2023-12-03 10:25:15','2023-12-03 10:25:15',59),(128,'PPPU','Penanggung Jawab Pengendalian Pencemaran Udara','F','-','T','2023-12-03 10:53:45','2023-12-03 10:53:45',59),(129,'PAPLB3','PEMANTAUAN & ANALISIS PENGELOLAAN LIMBAH B3','F','-','T','2023-12-03 10:58:56','2023-12-03 10:58:56',59),(130,'PKB','PENGUJIAN KAYU BUNDAR','F','-','T','2023-12-03 11:09:39','2023-12-03 11:09:39',59),(131,'PHT','PERENCANAAN HUTAN','F','-','T','2023-12-03 11:14:34','2023-12-03 11:14:34',59),(132,'PPSDM KEBTKE','LEMBAGA SERTIFIKASI KOMPETENSI PPSDM KEBTKE','F','-','T','2023-12-03 11:40:24','2023-12-03 11:40:24',59),(133,'OPLBBB','OPERASIONAL PENGELOLAAN LIMBAH BAHAN BERBAHAYA DAN BERACUN','F','-','T','2023-12-04 08:01:26','2023-12-04 08:01:26',59),(134,'OHSPI','KESELAMATAN DAN KESEHATAN KERJA INDUSTRI PELABUHAN','F','-','T','2023-12-04 09:07:34','2023-12-04 09:07:34',59),(135,'SFK2','SERTIFIKASI FORKLIFT KELAS 2','F','-','T','2023-12-04 09:09:16','2023-12-04 09:09:16',59),(136,'IHTSGK1','IHT SERTIFIKASI GENSET KELAS 1','F','-','T','2023-12-04 11:38:36','2023-12-04 11:38:36',59),(137,'PJOPPU','PENANGGUNG JAWAB OPERASIONAL INSTALASI PENGENDALIAN PENCEMARAN UDARA','F','-','T','2023-12-06 11:13:40','2023-12-06 11:13:40',59),(138,'SDC','SAFETY DRIVING CLINIC','F','-','T','2023-12-08 14:25:37','2023-12-08 14:25:37',59),(139,'CHKKBPRM','Coal Handling & Kontrol Kualitas Batubara Peringkat Rendah & Menengah','F','-','T','2023-12-08 16:42:47','2023-12-08 16:42:47',59),(140,'AKI','AKADEMI KEPELABUHAN - INAPORTNET','F','-','T','2023-12-08 16:42:47','2024-04-04 11:17:26',59),(141,'CSCM','Coal Supply Chain Management','F','-','T','2023-12-08 16:42:50','2023-12-08 16:42:50',59),(142,'PFSO','Port Facility Security Officer','F','-','T','2023-12-08 16:52:40','2023-12-08 16:52:40',59),(143,'JLNTPBPK','JURU LEDAK NON TAMBANG & PENGELOLAAN BAHAN PELEDAK KOMERSIAL','F','-','T','2023-12-10 07:53:30','2023-12-10 07:53:30',59),(144,'PPOP','PEMBEKALAN PENGAWAS OPERASIONAL PERTAMA (POP)','F','-','T','2023-12-10 09:24:30','2023-12-10 09:24:30',59),(145,'PPOM','PEMBEKALAN PENGAWAS OPERASIONAL MADYA (POM)','F','-','T','2023-12-10 09:24:30','2023-12-10 09:24:30',59),(146,'PPOU','PEMBEKALAN PENGAWAS OPERASIONAL UTAMA (POU)','F','-','T','2023-12-10 09:24:31','2023-12-10 09:24:31',59),(147,'LJOP','LAYANAN JASA DAN OPERASIONAL PELABUHAN','F','-','T','2023-12-10 15:18:44','2023-12-10 15:18:44',59),(148,'LFA','LOGICAL FRAMEWORK APPROACH','F','-','T','2023-12-10 16:22:21','2023-12-10 16:22:21',59),(150,'IDDC','Indonesia Defensive Driving Center (IDDC)','F','-','T','2024-02-01 16:39:53','2024-02-01 16:39:53',59),(172,'ANT1','Ahli Nautika Tingkat 1','F','-','T','1970-01-01 00:00:00','1970-01-01 00:00:00',27),(173,'ORPT','Oil Recovery & Pollution TrainingÂ ','F','-','T','1970-01-01 00:00:00','1970-01-01 00:00:00',27),(174,'ISMC13','International Safety Management Code (ISM Code) Session 1 & 3Â ','F','-','T','1970-01-01 00:00:00','1970-01-01 00:00:00',27),(175,'ISM','ISM CodeÂ , Full session ','F','-','T','1970-01-01 00:00:00','1970-01-01 00:00:00',27),(176,'ISAC','Internal Safety AuditorÂ  for ISM Code','F','-','T','1970-01-01 00:00:00','1970-01-01 00:00:00',27),(177,'CSO','Company Security Officer (CSO)Â ','F','-','T','1970-01-01 00:00:00','1970-01-01 00:00:00',27),(178,'IAISPS','Internal AuditorÂ  for ISPS CodeÂ ','F','-','T','1970-01-01 00:00:00','1970-01-01 00:00:00',27),(179,'MS','Marine Surveyor','F','-','T','1970-01-01 00:00:00','1970-01-01 00:00:00',27),(180,'EFIATCI14001','Environmental Familiarizations &Â  Internal Audit Training Course covering ISO 14001-2004','F','-','T','1970-01-01 00:00:00','1970-01-01 00:00:00',27),(181,'OFTIATC18000','OH&S Familiarizations Training & Internal Audit Training Course Covering OHSAS 18001/ASNZ 4801','F','-','T','1970-01-01 00:00:00','1970-01-01 00:00:00',27),(182,'QSSEFIATC','Quality , Safety , Security & Environmental Familiarizations and Internal Audit Training Course','F','-','T','1970-01-01 00:00:00','1970-01-01 00:00:00',27),(183,'GAIMLC','General Awareness & Implications of Maritime Labour Convention (2006 ) Code','F','-','T','1970-01-01 00:00:00','1970-01-01 00:00:00',27),(184,'IMS5CFLWS','IMS 5 â€“ CompetentÂ  Front Line Worksite Supervisor','F','-','T','1970-01-01 00:00:00','1970-01-01 00:00:00',27),(185,'RSS','Rigging and Slinging Safety','F','-','T','1970-01-01 00:00:00','1970-01-01 00:00:00',27),(186,'BRS','Basic Rigging and Slinging','F','-','T','1970-01-01 00:00:00','1970-01-01 00:00:00',27),(187,'OWD','Open Water Diver','F','-','T','1970-01-01 00:00:00','1970-01-01 00:00:00',27),(188,'AD','Advance Diver','F','-','T','1970-01-01 00:00:00','1970-01-01 00:00:00',27),(189,'UDPO','Unlimited Dynamic Positioning Operator (DPO)','F','-','T','1970-01-01 00:00:00','1970-01-01 00:00:00',27),(190,'GOR','General Operator Radio','F','-','T','1970-01-01 00:00:00','1970-01-01 00:00:00',27),(191,'GMDSSC','GMDSS Certificate','F','-','T','1970-01-01 00:00:00','1970-01-01 00:00:00',27),(192,'FCSCFUV','Full Comply SOLAS Certification For Unlimited Voyage','F','-','T','1970-01-01 00:00:00','1970-01-01 00:00:00',27);
/*!40000 ALTER TABLE `tb_jenis_sertifikasi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_jenis_usaha`
--

DROP TABLE IF EXISTS `tb_jenis_usaha`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_jenis_usaha` (
  `id_jenis_usaha` int(11) NOT NULL AUTO_INCREMENT,
  `jenis_usaha` varchar(100) NOT NULL DEFAULT '',
  `ket_jenis_usaha` varchar(1000) NOT NULL DEFAULT '',
  `stat_jenis_usaha` char(1) NOT NULL DEFAULT '',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_jenis_usaha`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_jenis_usaha`
--

LOCK TABLES `tb_jenis_usaha` WRITE;
/*!40000 ALTER TABLE `tb_jenis_usaha` DISABLE KEYS */;
INSERT INTO `tb_jenis_usaha` VALUES (1,'PENAMBANGAN','','T','1970-01-01 00:00:00','1970-01-01 00:00:00',1),(2,'PENAMBANGAN','','T','1970-01-01 00:00:00','1970-01-01 00:00:00',1),(3,'PENAMBANGAN','','T','1970-01-01 00:00:00','1970-01-01 00:00:00',1);
/*!40000 ALTER TABLE `tb_jenis_usaha` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_jml_kary`
--

DROP TABLE IF EXISTS `tb_jml_kary`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_jml_kary` (
  `id_perusahaan` int(11) NOT NULL,
  `jml` int(11) NOT NULL,
  PRIMARY KEY (`id_perusahaan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_jml_kary`
--

LOCK TABLES `tb_jml_kary` WRITE;
/*!40000 ALTER TABLE `tb_jml_kary` DISABLE KEYS */;
INSERT INTO `tb_jml_kary` VALUES (1,639),(2,0),(3,0),(4,0),(5,0);
/*!40000 ALTER TABLE `tb_jml_kary` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_karyawan`
--

DROP TABLE IF EXISTS `tb_karyawan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_karyawan` (
  `id_kary` int(11) NOT NULL AUTO_INCREMENT,
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
  `id_m_perusahaan` int(11) NOT NULL,
  PRIMARY KEY (`id_kary`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_karyawan`
--

LOCK TABLES `tb_karyawan` WRITE;
/*!40000 ALTER TABLE `tb_karyawan` DISABLE KEYS */;
INSERT INTO `tb_karyawan` VALUES (1,1,0,0,'51021149','2021-10-30','2021-10-30',4,1,1557,20,1,2,3,61,3,7,'2','2',2,1,'ihfan.noifara@ungguldinamika.co.id','1970-01-01',0,'1970-01-01','','20240512221029-FOTO.jpg','2024-05-12 22:01:29','2024-05-12 22:10:32',1,1),(2,2,0,0,'505242173','2021-10-30','2021-10-30',4,1,1558,20,1,2,3,61,3,7,'2','2',2,1,'ihfan.noifara@ungguldinamika.co.id','1970-01-01',0,'1970-01-01','','20240512221029-FOTO.jpg','2024-05-12 22:01:29','2024-05-12 22:10:32',1,1),(3,3,0,0,'50721056','2021-10-30','2021-10-30',4,1,1558,20,1,2,3,61,3,7,'2','2',2,1,'ihfan.noifara@ungguldinamika.co.id','1970-01-01',0,'1970-01-01','','20240512221029-FOTO.jpg','2024-05-12 22:01:29','2024-05-12 22:10:32',1,1);
/*!40000 ALTER TABLE `tb_karyawan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_karyawan_nonaktif`
--

DROP TABLE IF EXISTS `tb_karyawan_nonaktif`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_karyawan_nonaktif` (
  `id_kary_nonaktif` int(11) NOT NULL AUTO_INCREMENT,
  `id_kary` int(11) NOT NULL,
  `tgl_nonaktif` date NOT NULL DEFAULT '1970-01-01',
  `id_alasan_nonaktif` int(11) NOT NULL DEFAULT 0,
  `ket_nonaktif` varchar(2000) NOT NULL DEFAULT '',
  `url_berkas_nonaktif` varchar(1000) NOT NULL DEFAULT '',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_kary_nonaktif`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_karyawan_nonaktif`
--

LOCK TABLES `tb_karyawan_nonaktif` WRITE;
/*!40000 ALTER TABLE `tb_karyawan_nonaktif` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_karyawan_nonaktif` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_kat_absensi`
--

DROP TABLE IF EXISTS `tb_kat_absensi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_kat_absensi` (
  `id_kat_absensi` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kat` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_kat_absensi`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_kat_absensi`
--

LOCK TABLES `tb_kat_absensi` WRITE;
/*!40000 ALTER TABLE `tb_kat_absensi` DISABLE KEYS */;
INSERT INTO `tb_kat_absensi` VALUES (0,'TIDAK MASUK'),(1,'MASUK');
/*!40000 ALTER TABLE `tb_kat_absensi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_keluarga`
--

DROP TABLE IF EXISTS `tb_keluarga`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_keluarga` (
  `id_keluarga` int(11) NOT NULL AUTO_INCREMENT,
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
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_keluarga`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_keluarga`
--

LOCK TABLES `tb_keluarga` WRITE;
/*!40000 ALTER TABLE `tb_keluarga` DISABLE KEYS */;
INSERT INTO `tb_keluarga` VALUES (3,1560,'0',NULL,NULL,NULL,NULL,'1970-01-01',NULL,NULL,NULL,NULL,'T','T','','GRAYSON INNOSENSIUS. GULTOM','ELLY WINDUWATI SINAGA','ROMMEL FRANSISKUS GULTOM','KUTAI TIMUR','2013-07-06','L','','','','T','T','','FARREL IGNASIUS GULTOM','ELLY WINDUWATI SINAGA','ROMMEL FRANSISKUS GULTOM','KUTAI TIMUR','2015-07-25','L','','','','T','','0',NULL,NULL,NULL,NULL,'1970-01-01',NULL,NULL,NULL,NULL,'T','T','0',NULL,NULL,NULL,NULL,'1970-01-01',NULL,NULL,NULL,NULL,'T','T','0',NULL,NULL,NULL,NULL,'1970-01-01',NULL,NULL,NULL,NULL,'T','T','0',NULL,NULL,NULL,NULL,'1970-01-01',NULL,NULL,NULL,NULL,'T','T','0',NULL,NULL,NULL,NULL,'1970-01-01',NULL,NULL,NULL,NULL,'T','T','0',NULL,NULL,NULL,NULL,'1970-01-01',NULL,NULL,NULL,NULL,'T','T','0',NULL,NULL,NULL,NULL,'1970-01-01',NULL,NULL,NULL,NULL,'T','T','0',NULL,NULL,NULL,NULL,'1970-01-01',NULL,NULL,NULL,NULL,'T','T','2024-05-11 10:00:51','2024-05-11 10:03:22',60),(4,1,'65645345345345','WAHYUNI','HJ. SULEHA ALM','H. BAHARUDDIN, ALM','SAMARINDA','1984-08-27','P','','','','T','T','676734534534578','IHSAN RAZAK RAMADHAN','WAHYUNI','IHFAN NOIFARA','SAMARINDA','2006-10-10','L','','','08323423444234','T','','0',NULL,NULL,NULL,NULL,'1970-01-01',NULL,NULL,NULL,NULL,'T','T','0',NULL,NULL,NULL,NULL,'1970-01-01',NULL,NULL,NULL,NULL,'T','T','0',NULL,NULL,NULL,NULL,'1970-01-01',NULL,NULL,NULL,NULL,'T','T','0',NULL,NULL,NULL,NULL,'1970-01-01',NULL,NULL,NULL,NULL,'T','T','0',NULL,NULL,NULL,NULL,'1970-01-01',NULL,NULL,NULL,NULL,'T','T','0',NULL,NULL,NULL,NULL,'1970-01-01',NULL,NULL,NULL,NULL,'T','T','0',NULL,NULL,NULL,NULL,'1970-01-01',NULL,NULL,NULL,NULL,'T','T','0',NULL,NULL,NULL,NULL,'1970-01-01',NULL,NULL,NULL,NULL,'T','T','0',NULL,NULL,NULL,NULL,'1970-01-01',NULL,NULL,NULL,NULL,'T','T','2024-05-12 22:03:17','2024-05-12 22:04:03',1);
/*!40000 ALTER TABLE `tb_keluarga` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_klasifikasi`
--

DROP TABLE IF EXISTS `tb_klasifikasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_klasifikasi` (
  `id_klasifikasi` int(11) NOT NULL AUTO_INCREMENT,
  `klasifikasi` varchar(50) NOT NULL,
  `ket_klasifikasi` varchar(1000) NOT NULL,
  `stat_klasifikasi` char(1) NOT NULL DEFAULT 'T',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_klasifikasi`),
  KEY `agama` (`klasifikasi`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_klasifikasi`
--

LOCK TABLES `tb_klasifikasi` WRITE;
/*!40000 ALTER TABLE `tb_klasifikasi` DISABLE KEYS */;
INSERT INTO `tb_klasifikasi` VALUES (1,'MANAGEMENT','-','T','2021-11-07 17:00:00','1970-01-01 00:00:00',1),(2,'PROFESIONAL','-','T','2021-11-07 17:00:00','1970-01-01 00:00:00',1),(3,'TEKNISI','-','T','2021-11-07 17:00:00','1970-01-01 00:00:00',1),(4,'ADMINISTRASI','-','T','2021-11-07 17:00:00','1970-01-01 00:00:00',1),(7,'TERAMPIL','','T','2021-11-07 17:00:00','1970-01-01 00:00:00',1),(8,'TIDAK TERAMPIL','','T','2021-11-07 17:00:00','1970-01-01 00:00:00',1);
/*!40000 ALTER TABLE `tb_klasifikasi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_kontrak_karyawan`
--

DROP TABLE IF EXISTS `tb_kontrak_karyawan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_kontrak_karyawan` (
  `id_kontrak_kary` int(11) NOT NULL AUTO_INCREMENT,
  `id_kary` int(11) NOT NULL DEFAULT 0,
  `id_stat_perjanjian` int(11) NOT NULL DEFAULT 0,
  `tgl_mulai` date NOT NULL DEFAULT '1970-01-01',
  `tgl_akhir` date NOT NULL DEFAULT '1970-01-01',
  `ket_kontrak` varchar(1000) NOT NULL DEFAULT '0',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_kontrak_kary`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_kontrak_karyawan`
--

LOCK TABLES `tb_kontrak_karyawan` WRITE;
/*!40000 ALTER TABLE `tb_kontrak_karyawan` DISABLE KEYS */;
INSERT INTO `tb_kontrak_karyawan` VALUES (1,1,1,'2022-10-30','1970-01-01','','2024-05-12 22:01:31','2024-05-12 22:01:31',1);
/*!40000 ALTER TABLE `tb_kontrak_karyawan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_kontrak_perusahaan`
--

DROP TABLE IF EXISTS `tb_kontrak_perusahaan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_kontrak_perusahaan` (
  `id_kontrak_perusahaan` int(11) NOT NULL AUTO_INCREMENT,
  `id_m_perusahaan` int(11) NOT NULL DEFAULT 0,
  `id_perusahaan` int(11) NOT NULL DEFAULT 0,
  `no_kontrak_perusahaan` varchar(50) NOT NULL DEFAULT '',
  `ket_kontrak_perusahaan` varchar(1000) NOT NULL DEFAULT '',
  `tgl_mulai` date NOT NULL DEFAULT '1970-01-01',
  `tgl_akhir` date NOT NULL DEFAULT '1970-01-01',
  `url_doc_kontrak_perusahaan` varchar(500) NOT NULL DEFAULT '',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_kontrak_perusahaan`),
  KEY `FK_tb_kontrak_perusahaan_tb_m_perusahaan` (`id_m_perusahaan`),
  CONSTRAINT `FK_tb_kontrak_perusahaan_tb_m_perusahaan` FOREIGN KEY (`id_m_perusahaan`) REFERENCES `tb_m_perusahaan` (`id_m_perusahaan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_kontrak_perusahaan`
--

LOCK TABLES `tb_kontrak_perusahaan` WRITE;
/*!40000 ALTER TABLE `tb_kontrak_perusahaan` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_kontrak_perusahaan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_ktp`
--

DROP TABLE IF EXISTS `tb_ktp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_ktp` (
  `id_ktp` int(11) NOT NULL AUTO_INCREMENT,
  `id_personal` int(11) NOT NULL DEFAULT 0,
  `url_ktp` varchar(1000) NOT NULL DEFAULT '',
  `stat_ktp` char(1) NOT NULL DEFAULT 'T',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_ktp`),
  KEY `id_personal` (`id_personal`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_ktp`
--

LOCK TABLES `tb_ktp` WRITE;
/*!40000 ALTER TABLE `tb_ktp` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_ktp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_langgar`
--

DROP TABLE IF EXISTS `tb_langgar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_langgar` (
  `id_langgar` int(11) NOT NULL AUTO_INCREMENT,
  `id_kary` int(11) NOT NULL DEFAULT 0,
  `tgl_langgar` date NOT NULL DEFAULT '1970-01-01',
  `tgl_punishment` date NOT NULL DEFAULT '1970-01-01',
  `id_langgar_jenis` int(11) NOT NULL DEFAULT 0,
  `ket_langgar` varchar(2500) NOT NULL DEFAULT '',
  `url_langgar` varchar(1000) NOT NULL DEFAULT '',
  `tgl_akhir_langgar` date NOT NULL DEFAULT '1970-01-01',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_langgar`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_langgar`
--

LOCK TABLES `tb_langgar` WRITE;
/*!40000 ALTER TABLE `tb_langgar` DISABLE KEYS */;
INSERT INTO `tb_langgar` VALUES (1,1,'2024-05-01','2024-05-06',2,'Mangkir 1 Hari','20240512221607-LGR.pdf','2024-08-05','2024-05-12 22:16:11','2024-05-12 22:16:11',1);
/*!40000 ALTER TABLE `tb_langgar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_langgar_jenis`
--

DROP TABLE IF EXISTS `tb_langgar_jenis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_langgar_jenis` (
  `id_langgar_jenis` int(11) NOT NULL AUTO_INCREMENT,
  `kode_langgar_jenis` char(8) NOT NULL DEFAULT '',
  `langgar_jenis` varchar(100) NOT NULL DEFAULT '',
  `stat_langgar_jenis` char(1) NOT NULL DEFAULT 'T',
  `ket_langgar_jenis` varchar(2500) NOT NULL DEFAULT '',
  `durasi_langgar_jenis` int(11) NOT NULL DEFAULT 0,
  `jenis_durasi` varchar(20) NOT NULL,
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_langgar_jenis`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_langgar_jenis`
--

LOCK TABLES `tb_langgar_jenis` WRITE;
/*!40000 ALTER TABLE `tb_langgar_jenis` DISABLE KEYS */;
INSERT INTO `tb_langgar_jenis` VALUES (1,'ST','Surat Teguran','T','',3,'month','2023-10-05 00:00:00','2023-10-05 00:00:00',1),(2,'SP1','Surat Peringatan 1','T','',6,'month','2023-10-09 18:29:00','2023-10-09 18:29:00',1),(3,'SP2','Surat Peringatan 2','T','',6,'month','2023-10-09 18:29:00','2023-10-09 18:29:00',1),(4,'SP3','Surat Peringatan 3','T','',6,'month','2023-10-09 18:29:00','2023-10-09 18:29:00',1),(5,'SPT','Surat Peringatan Pertama & Terakhir','T','',6,'month','2023-10-09 18:29:00','2023-10-09 18:29:00',1);
/*!40000 ALTER TABLE `tb_langgar_jenis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_level`
--

DROP TABLE IF EXISTS `tb_level`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_level` (
  `id_level` int(11) NOT NULL AUTO_INCREMENT,
  `kd_level` varchar(10) NOT NULL,
  `level` varchar(100) NOT NULL,
  `ket_level` varchar(1000) NOT NULL,
  `stat_level` char(1) NOT NULL DEFAULT 'T',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0,
  `id_perusahaan` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_level`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_level`
--

LOCK TABLES `tb_level` WRITE;
/*!40000 ALTER TABLE `tb_level` DISABLE KEYS */;
INSERT INTO `tb_level` VALUES (1,'OFC','OFFICER','','T','2024-05-12 21:56:50','2024-05-12 21:56:50',1,1);
/*!40000 ALTER TABLE `tb_level` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_log`
--

DROP TABLE IF EXISTS `tb_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_log` (
  `id_log` int(11) NOT NULL AUTO_INCREMENT,
  `user_log` char(200) NOT NULL,
  `tgl_log` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `ip_address_log` varchar(100) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_log`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_log`
--

LOCK TABLES `tb_log` WRITE;
/*!40000 ALTER TABLE `tb_log` DISABLE KEYS */;
INSERT INTO `tb_log` VALUES (1,'ihfan.noifara@ungguldinamika.co.id','2024-05-12 14:33:28','::1'),(2,'ihfan.noifara@ungguldinamika.co.id','2024-05-12 15:32:18','::1'),(3,'ihfan.noifara@ungguldinamika.co.id','2024-05-12 15:34:37','::1'),(4,'ihfan.noifara@ungguldinamika.co.id','2024-05-12 21:50:36','::1'),(5,'syarif.mamardi@ungguldinamika.co.id','2024-05-12 23:23:23','10.81.200.2'),(6,'ihfan.noifara@ungguldinamika.co.id','2024-05-17 16:18:40','10.81.200.2'),(7,'ihfan.noifara@ungguldinamika.co.id','2024-05-17 16:21:09','10.81.200.2'),(8,'kadek.ferliyawan@ungguldinamika.co.id','2024-05-17 16:48:41','192.168.158.72'),(9,'kadek.ferliyawan@ungguldinamika.co.id','2024-05-17 16:57:07','192.168.158.74'),(10,'kadek.ferliyawan@ungguldinamika.co.id','2024-05-18 15:12:37','192.168.158.72'),(11,'ihfan.noifara@ungguldinamika.co.id','2024-05-18 15:13:16','192.168.158.43'),(12,'ihfan.noifara@ungguldinamika.co.id','2024-05-19 10:54:18','192.168.120.16');
/*!40000 ALTER TABLE `tb_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_lokasi_pjo`
--

DROP TABLE IF EXISTS `tb_lokasi_pjo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_lokasi_pjo` (
  `id_lokasi_pjo` int(11) NOT NULL AUTO_INCREMENT,
  `lokasi_pjo` varchar(50) NOT NULL,
  `ket_lokasi_pjo` varchar(1000) NOT NULL,
  `stat_lokasi_pjo` char(1) NOT NULL DEFAULT 'T',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_lokasi_pjo`),
  KEY `agama` (`lokasi_pjo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_lokasi_pjo`
--

LOCK TABLES `tb_lokasi_pjo` WRITE;
/*!40000 ALTER TABLE `tb_lokasi_pjo` DISABLE KEYS */;
INSERT INTO `tb_lokasi_pjo` VALUES (1,'SITE','','T','1970-01-01 00:00:00','1970-01-01 00:00:00',1),(2,'PORT','','T','1970-01-01 00:00:00','1970-01-01 00:00:00',1),(3,'HAULING','','T','1970-01-01 00:00:00','1970-01-01 00:00:00',1),(4,'KM 33','','T','1970-01-01 00:00:00','1970-01-01 00:00:00',1);
/*!40000 ALTER TABLE `tb_lokasi_pjo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_lokker`
--

DROP TABLE IF EXISTS `tb_lokker`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_lokker` (
  `id_lokker` int(11) NOT NULL AUTO_INCREMENT,
  `kd_lokker` varchar(10) NOT NULL DEFAULT '',
  `lokker` varchar(100) NOT NULL,
  `ket_lokker` varchar(1000) NOT NULL,
  `stat_lokker` char(1) NOT NULL DEFAULT 'T',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_lokker`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_lokker`
--

LOCK TABLES `tb_lokker` WRITE;
/*!40000 ALTER TABLE `tb_lokker` DISABLE KEYS */;
INSERT INTO `tb_lokker` VALUES (1,'PORT','PORT AREA','PT. SCCI','T','2023-04-15 22:43:46','2023-10-01 21:40:58',1),(2,'KAL','KALIORANG','','T','2023-04-15 22:43:46','2023-04-15 22:43:46',1),(4,'SGT','SANGATTA','','T','2023-04-15 22:43:46','2023-04-15 22:43:46',1),(5,'PGD','PENGADAN','','T','2023-04-15 22:43:46','2023-04-15 22:43:46',1),(6,'CP33','CPP KM 33','','T','2023-04-15 22:43:46','2023-04-15 22:43:46',1),(7,'BLU','BLOK UTARA','','T','2023-04-15 22:43:46','2023-06-24 14:55:24',1),(9,'PIT','PIT AREA','','T','2023-04-15 22:43:46','2023-04-15 22:43:46',1),(13,'ALRE','ALL AREA','','T','2023-08-18 11:20:27','2023-08-18 11:20:27',7),(14,'KBN','KAUBUN','','T','2023-09-05 08:38:31','2023-09-05 08:38:49',33),(16,'KAL SKL','SANGKULIRANG KALIORANG','AKTIF','T','2023-09-08 15:47:47','2023-09-08 15:49:19',49),(19,'KLM','KELAMPAIAN','','T','2023-10-25 15:02:43','2023-10-25 15:02:43',102),(20,'ASM','AREA PORT','','T','2023-11-07 13:19:55','2023-11-07 13:20:36',105),(21,'KM22','KM 22','','T','2023-11-13 15:11:18','2023-11-13 15:11:18',27),(22,'MGSHP','MEGASHOP','','T','2023-11-13 15:11:29','2023-11-13 15:11:29',27),(23,'WKSPTR','WORKSHOP TRACK','','T','2023-11-13 15:11:42','2023-11-13 15:11:42',27),(24,'WKSHPKPP','WORKSHOP KPP','WORKSHOP PT KPP','T','2023-11-13 15:12:06','2023-11-13 15:12:06',27),(25,'KM19','KM 19','','T','2023-11-13 15:12:16','2023-11-13 15:12:16',27),(26,'OFFKPP','OFFICE KPP','OFFICE PT KPP','T','2023-11-13 15:12:40','2023-11-13 15:12:40',27),(27,'BPP','BALIKPAPAN','Mess Balikpapan','T','2024-03-20 08:40:04','2024-03-20 08:40:04',24);
/*!40000 ALTER TABLE `tb_lokker` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_lokterima`
--

DROP TABLE IF EXISTS `tb_lokterima`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_lokterima` (
  `id_lokterima` int(11) NOT NULL AUTO_INCREMENT,
  `kd_lokterima` varchar(10) NOT NULL DEFAULT '',
  `lokterima` varchar(100) NOT NULL DEFAULT '',
  `jenis_lokasi` varchar(20) NOT NULL DEFAULT '',
  `ket_lokterima` varchar(1000) NOT NULL,
  `stat_lokterima` char(1) NOT NULL DEFAULT 'T',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0,
  `id_perusahaan` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_lokterima`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_lokterima`
--

LOCK TABLES `tb_lokterima` WRITE;
/*!40000 ALTER TABLE `tb_lokterima` DISABLE KEYS */;
INSERT INTO `tb_lokterima` VALUES (1,'LRSU','RING I (KALIORANG/KARANGAN/KAUBUN/SANGKULIRANG)','LOKAL','','T','2023-04-15 22:37:37','2023-04-15 22:37:37',1,0),(2,'LRDA','RING II (DAERAH KUTIM SELAIN DALAM RING I)','LOKAL','','T','2023-04-15 22:37:37','2023-04-15 22:37:37',1,0),(3,'LRTA','RING III (DI LUAR KUTIM DAN DIDALAM KALTIM)','NONLOKAL','','T','2023-04-15 22:37:37','2023-04-15 22:37:37',1,0),(4,'NLLK','RING IV (NASIONAL)','NONLOKAL','','T','2023-04-15 22:37:37','2023-04-15 22:37:37',1,0),(16,'NSSL','NASIONAL','NONLOKAL','','T','2023-10-12 02:00:00','2023-10-12 02:00:00',1,0);
/*!40000 ALTER TABLE `tb_lokterima` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_m_jenis_usaha`
--

DROP TABLE IF EXISTS `tb_m_jenis_usaha`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_m_jenis_usaha` (
  `id_m_jenis_usaha` int(11) NOT NULL AUTO_INCREMENT,
  `id_m_perusahaan` int(11) NOT NULL DEFAULT 0,
  `id_jenis_usaha` int(11) NOT NULL DEFAULT 0,
  `stat_m_jenis_usaha` char(1) NOT NULL DEFAULT 'T',
  `tgl_buat` date NOT NULL DEFAULT '1970-01-01',
  `tgl_edit` date NOT NULL DEFAULT '1970-01-01',
  `id_user` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_m_jenis_usaha`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_m_jenis_usaha`
--

LOCK TABLES `tb_m_jenis_usaha` WRITE;
/*!40000 ALTER TABLE `tb_m_jenis_usaha` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_m_jenis_usaha` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_m_perusahaan`
--

DROP TABLE IF EXISTS `tb_m_perusahaan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_m_perusahaan` (
  `id_m_perusahaan` int(11) NOT NULL AUTO_INCREMENT,
  `id_parent` int(11) NOT NULL DEFAULT 0,
  `id_perusahaan` int(11) NOT NULL DEFAULT 0,
  `nama_m_perusahaan` varchar(200) NOT NULL,
  `id_jenis_perusahaan` int(11) NOT NULL DEFAULT 0,
  `stat_m_perusahaan` char(1) NOT NULL DEFAULT 'T',
  `url_rk3l` varchar(500) NOT NULL,
  `tgl_buat` datetime NOT NULL,
  `tgl_edit` datetime NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_m_perusahaan`)
) ENGINE=InnoDB AUTO_INCREMENT=174 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_m_perusahaan`
--

LOCK TABLES `tb_m_perusahaan` WRITE;
/*!40000 ALTER TABLE `tb_m_perusahaan` DISABLE KEYS */;
INSERT INTO `tb_m_perusahaan` VALUES (1,0,1,'PT UNGGUL DINAMIKA UTAMA',2,'T','','2023-06-12 08:42:43','2023-08-13 13:46:15',1),(173,1,85,'PT GDSK',3,'T','','2023-06-12 08:42:43','2023-06-12 08:42:43',1);
/*!40000 ALTER TABLE `tb_m_perusahaan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_master`
--

DROP TABLE IF EXISTS `tb_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_master` (
  `id_master` int(11) NOT NULL AUTO_INCREMENT,
  `kd_master` varchar(10) NOT NULL,
  `nama_master` varchar(200) NOT NULL,
  `jenis_master` varchar(50) NOT NULL,
  `ket_master` varchar(1000) NOT NULL,
  `stat_master` char(1) NOT NULL DEFAULT 'T',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_master`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_master`
--

LOCK TABLES `tb_master` WRITE;
/*!40000 ALTER TABLE `tb_master` DISABLE KEYS */;
INSERT INTO `tb_master` VALUES (1,'RPTO','REPORT TO','APPROVAL','','T','2023-04-16 07:39:18','2023-04-16 07:39:18',1),(2,'MGRTO','MANAGER ONE UP','APPROVAL','','T','2023-04-16 07:39:18','2023-04-16 07:39:18',1),(3,'APP3','APPROVAL 3','APPROVAL','','T','2023-04-16 07:39:18','2023-04-16 07:39:18',1),(4,'APP4','APPROVAL 4','APPROVAL','','T','2023-04-16 07:39:18','2023-04-16 07:39:18',1),(5,'APP5','APPROVAL 5','APPROVAL','','T','2023-04-16 07:39:18','2023-04-16 07:39:18',1),(6,'SMI','Suami','HUBUNGAN','','T','2023-04-16 07:39:18','2023-04-16 07:39:18',1),(7,'IST','Istri','HUBUNGAN','','T','2023-04-16 07:39:18','2023-04-16 07:39:18',1),(8,'ANK1','Anak Ke 1','HUBUNGAN','','T','2023-04-16 07:39:18','2023-04-16 07:39:18',1),(9,'ANK2','Anak Ke 2','HUBUNGAN','','T','2023-04-16 07:39:18','2023-04-16 07:39:18',1),(10,'ANK3','Anak Ke 3','HUBUNGAN','','T','2023-04-16 07:39:18','2023-04-16 07:39:18',1),(11,'ANK4','Anak Ke 4','HUBUNGAN','','T','2023-04-16 07:39:18','2023-04-16 07:39:18',1),(12,'ANK5','Anak Ke 5','HUBUNGAN','','T','2023-04-16 07:39:18','2023-04-16 07:39:18',1),(13,'ANK6','Anak Ke 6','HUBUNGAN','','T','2023-04-16 07:39:18','2023-04-16 07:39:18',1),(14,'ANK7','Anak Ke 7','HUBUNGAN','','T','2023-04-16 07:39:18','2023-04-16 07:39:18',1),(15,'AZC','ASTRAZENECA','JENIS VAKSIN','','T','2023-04-16 07:39:18','2023-04-16 07:39:18',1),(16,'MDR','MODERNA','JENIS VAKSIN','','T','2023-04-16 07:39:18','2023-04-16 07:39:18',1),(17,'PFZ','PFIZER','JENIS VAKSIN','','T','2023-04-16 07:39:18','2023-04-16 07:39:18',1),(18,'SNP','SINOPHARM','JENIS VAKSIN','','T','2023-04-16 07:39:18','2023-04-16 07:39:18',1),(19,'SNV','SINOVAC','JENIS VAKSIN','','T','2023-04-16 07:39:18','2023-04-16 07:39:18',1),(20,'V1','VAKSIN 1','VAKSIN','','T','2023-04-16 07:39:18','2023-04-16 07:39:18',1),(21,'V2','VAKSIN 2','VAKSIN','','T','2023-04-16 07:39:18','2023-04-16 07:39:18',1),(22,'VB1','BOOSTER 1','VAKSIN','','T','2023-04-16 07:39:18','2023-04-16 07:39:18',1),(23,'VB2','BOOSTER 2','VAKSIN','','T','2023-04-16 07:39:18','2023-04-16 07:39:18',1),(24,'BUD','BUDDHA','AGAMA','','T','2023-04-16 07:39:18','2023-04-16 07:39:18',1),(25,'HIN','HINDU','AGAMA','','T','2023-04-16 07:39:18','2023-04-16 07:39:18',1),(26,'ISL','ISLAM','AGAMA','','T','2023-04-16 07:39:18','2023-04-16 07:39:18',1),(27,'KAT','KATHOLIK','AGAMA','','T','2023-04-16 07:39:18','2023-04-16 07:39:18',1),(28,'KHO','KHONGHUCU','AGAMA','','T','2023-04-16 07:39:18','2023-04-16 07:39:18',1),(29,'KRS','KRISTEN','AGAMA','','T','2023-04-16 07:39:18','2023-04-16 07:39:18',1),(30,'NS','NON STAFF','STAFF','','T','2023-04-16 07:39:18','2023-04-16 07:39:18',1),(31,'SF','STAFF','STAFF','','T','2023-04-16 07:39:18','2023-04-16 07:39:18',1),(32,'cvx','COVOVAX','JENIS VAKSIN','','T','2023-04-16 07:39:18','2023-04-16 07:39:18',1),(33,'CRV','CORONAVAC','JENIS VAKSIN','','T','2023-04-16 07:39:18','2023-04-16 07:39:18',1),(34,'BFM','BIOFARMA','JENIS VAKSIN','','T','2023-04-16 07:39:18','2023-04-16 07:39:18',1);
/*!40000 ALTER TABLE `tb_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_mcu`
--

DROP TABLE IF EXISTS `tb_mcu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_mcu` (
  `id_mcu` int(11) NOT NULL AUTO_INCREMENT,
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
  `id_user` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_mcu`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_mcu`
--

LOCK TABLES `tb_mcu` WRITE;
/*!40000 ALTER TABLE `tb_mcu` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_mcu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_mcu_jenis`
--

DROP TABLE IF EXISTS `tb_mcu_jenis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_mcu_jenis` (
  `id_mcu_jenis` int(11) NOT NULL AUTO_INCREMENT,
  `mcu_jenis` varchar(100) NOT NULL DEFAULT '',
  `stat_mcu_jenis` char(1) NOT NULL DEFAULT 'T',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_mcu_jenis`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_mcu_jenis`
--

LOCK TABLES `tb_mcu_jenis` WRITE;
/*!40000 ALTER TABLE `tb_mcu_jenis` DISABLE KEYS */;
INSERT INTO `tb_mcu_jenis` VALUES (1,'FIT TO WORK','T','1970-01-01 00:00:00','1970-01-01 00:00:00',1),(2,'FIT WITH NOTE','T','1970-01-01 00:00:00','1970-01-01 00:00:00',1),(6,'UNFIT','T','1970-01-01 00:00:00','1970-01-01 00:00:00',59);
/*!40000 ALTER TABLE `tb_mcu_jenis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_menu`
--

DROP TABLE IF EXISTS `tb_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_menu` (
  `IdMenu` int(11) NOT NULL AUTO_INCREMENT,
  `NamaMenu` varchar(200) NOT NULL,
  `StatMenu` varchar(200) NOT NULL,
  `UnggahFile` char(1) NOT NULL DEFAULT '',
  `BukaFile` char(1) NOT NULL DEFAULT '',
  `TglJamBuat` datetime NOT NULL,
  `TglLastEdit` datetime NOT NULL,
  `IdUser` int(11) NOT NULL,
  PRIMARY KEY (`IdMenu`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_menu`
--

LOCK TABLES `tb_menu` WRITE;
/*!40000 ALTER TABLE `tb_menu` DISABLE KEYS */;
INSERT INTO `tb_menu` VALUES (1,'ADMINISTRATOR','AKTIF','Y','Y','2022-04-17 06:59:29','2022-04-17 06:59:30',1),(2,'PERUSAHAAN','AKTIF','Y','Y','2022-04-20 13:05:51','2022-04-20 13:05:51',1),(3,'KARYAWAN','AKTIF','Y','Y','2022-04-28 22:57:31','2022-04-28 22:57:31',1),(4,'ALL','AKTIF','Y','Y','2022-04-28 23:40:47','2022-04-28 23:40:47',1);
/*!40000 ALTER TABLE `tb_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_modul`
--

DROP TABLE IF EXISTS `tb_modul`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_modul` (
  `IdModul` int(11) NOT NULL AUTO_INCREMENT,
  `IdParent` int(11) NOT NULL,
  `NamaModule` varchar(250) NOT NULL,
  `UrlModule` varchar(250) NOT NULL,
  `LabelMenu` varchar(250) NOT NULL,
  `TbModule` varchar(250) NOT NULL,
  `IconModule` varchar(250) NOT NULL,
  PRIMARY KEY (`IdModul`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_modul`
--

LOCK TABLES `tb_modul` WRITE;
/*!40000 ALTER TABLE `tb_modul` DISABLE KEYS */;
INSERT INTO `tb_modul` VALUES (1,0,'Shortcut','datashortcut','Shortcut','---','icon-arrow-up-right'),(2,1,'Tambah Data','new','Tambah Karyawan','tambahdata',''),(3,0,'Data Perusahaan','dataperusahaan','Data Perusahaan','','icon-home'),(4,3,'Perusahaan','perusahaan','Perusahaan','perusahaan',''),(5,3,'Struktur Perusahaan','struktur','Struktur Perusahaan','struktur',''),(6,0,'Data Pekerjaan','datapekerjaan','Data Pekerjaan','---','icon-share-2'),(7,6,'Departemen','departemen','Departemen','departemen',''),(8,6,'Posisi','posisi','Posisi','posisi',''),(9,6,'Level','level','Level','level',''),(10,6,'Golongan','tipe','Golongan','golongan',''),(11,0,'Data Daerah','datadaerah','Data Daerah','---','icon-map'),(12,11,'Lokasi Kerja','lokasikerja','Lokasi Kerja','lokasikerja',''),(13,11,'Point of Hire','poh','Point of Hire','pointofhire',''),(14,0,'Data SIMPER','datasimper','Data SIMPER','---','icon-check-square'),(15,14,'Unit','unit','Unit','unit',''),(16,0,'Data Karyawan','datakaryawan','Data Karyawan','---','icon-users'),(17,16,'Karyawan','karyawan','Karyawan','Karyawan',''),(18,16,'Non-Aktif Karyawan','NonaktifKary','Non-Aktif Karyawan','nonaktifkaryawan',''),(19,0,'SIMPER/MP','datizin','SIMPER/MP','---','icon-arrow-up-right'),(20,19,'Pengajuan Izin','pengajuansm','Pengajuan Izin','Pengajuansm',''),(22,0,'Data Pelanggaran','datalanggar','Data Pelanggaran','---','icon-alert-triangle'),(23,22,'Pelanggaran','pelanggaran','Pelanggaran','pelanggaran','');
/*!40000 ALTER TABLE `tb_modul` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_modul_role_menu`
--

DROP TABLE IF EXISTS `tb_modul_role_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_modul_role_menu` (
  `id_modul_role_menu` int(11) NOT NULL AUTO_INCREMENT,
  `id_menu` int(11) NOT NULL,
  `id_modul_role` int(11) NOT NULL,
  PRIMARY KEY (`id_modul_role_menu`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_modul_role_menu`
--

LOCK TABLES `tb_modul_role_menu` WRITE;
/*!40000 ALTER TABLE `tb_modul_role_menu` DISABLE KEYS */;
INSERT INTO `tb_modul_role_menu` VALUES (1,2,3),(2,2,4),(3,2,5),(4,3,1),(5,3,2),(6,3,6),(7,3,7),(8,3,8),(9,3,9),(10,3,10),(11,3,11),(12,3,12),(13,3,13),(14,3,14),(15,3,15),(16,3,16),(17,3,17),(18,3,18),(19,1,1),(20,1,2),(21,1,3),(22,1,4),(23,1,5),(24,1,6),(25,1,7),(26,1,8),(27,1,9),(28,1,10),(29,1,11),(30,1,12),(31,1,13),(32,1,14),(33,1,15),(34,1,16),(35,1,17),(36,1,18),(44,4,1),(45,4,2),(46,4,3),(47,4,4),(48,4,5),(49,4,6),(50,4,7),(51,4,8),(52,4,9),(53,4,10),(54,4,11),(55,4,12),(56,4,13),(57,4,14),(58,4,15),(59,4,16),(60,4,17),(61,4,18),(71,1,22),(72,3,22),(73,4,22),(74,1,23),(75,3,23),(76,4,23);
/*!40000 ALTER TABLE `tb_modul_role_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_paybase`
--

DROP TABLE IF EXISTS `tb_paybase`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_paybase` (
  `id_paybase` int(11) NOT NULL AUTO_INCREMENT,
  `kd_paybase` varchar(10) NOT NULL,
  `paybase` varchar(100) NOT NULL,
  `ket_paybase` varchar(1000) NOT NULL,
  `stat_paybase` char(1) NOT NULL DEFAULT 'T',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_perusahaan` int(11) NOT NULL DEFAULT 0,
  `id_user` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_paybase`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_paybase`
--

LOCK TABLES `tb_paybase` WRITE;
/*!40000 ALTER TABLE `tb_paybase` DISABLE KEYS */;
INSERT INTO `tb_paybase` VALUES (1,'JKT','Jakarta','-','T','2021-11-15 11:59:40','1970-01-01 00:00:00',1,1),(2,'STE','Site','-','T','2021-11-15 11:59:56','1970-01-01 00:00:00',1,1);
/*!40000 ALTER TABLE `tb_paybase` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_pekerjaan`
--

DROP TABLE IF EXISTS `tb_pekerjaan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_pekerjaan` (
  `id_pekerjaan` int(11) NOT NULL AUTO_INCREMENT,
  `id_depart` int(11) NOT NULL DEFAULT 0,
  `id_section` int(11) NOT NULL DEFAULT 0,
  `id_posisi` int(11) NOT NULL DEFAULT 0,
  `id_grade` int(11) NOT NULL DEFAULT 0,
  `id_level` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_pekerjaan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_pekerjaan`
--

LOCK TABLES `tb_pekerjaan` WRITE;
/*!40000 ALTER TABLE `tb_pekerjaan` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_pekerjaan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_pendidikan`
--

DROP TABLE IF EXISTS `tb_pendidikan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_pendidikan` (
  `id_pendidikan` int(11) NOT NULL AUTO_INCREMENT,
  `pendidikan` varchar(200) NOT NULL DEFAULT '',
  `ket_pendidikan` varchar(1000) NOT NULL DEFAULT '',
  `stat_pendidikan` char(1) NOT NULL DEFAULT 'T',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_pendidikan`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_pendidikan`
--

LOCK TABLES `tb_pendidikan` WRITE;
/*!40000 ALTER TABLE `tb_pendidikan` DISABLE KEYS */;
INSERT INTO `tb_pendidikan` VALUES (1,'SD','','T','2022-10-02 00:00:00','2022-10-02 00:00:00',1),(2,'SMP','','T','2022-10-02 00:00:00','2022-10-02 00:00:00',1),(4,'SMA/K','','T','2022-10-02 00:00:00','2022-10-02 00:00:00',1),(8,'PAKET C','','T','2022-10-02 00:00:00','2022-10-02 00:00:00',1),(9,'DIPLOMA 1','','T','2022-10-02 00:00:00','2022-10-02 00:00:00',1),(10,'DIPLOMA 2','','T','2022-10-02 00:00:00','2022-10-02 00:00:00',1),(11,'DIPLOMA 3','','T','2022-10-02 00:00:00','2022-10-02 00:00:00',1),(12,'DIPLOMA 4','','T','2022-10-02 00:00:00','2022-10-02 00:00:00',1),(13,'STRATA 1','','T','2022-10-02 00:00:00','2022-10-02 00:00:00',1),(14,'STRATA 2','','T','0000-00-00 00:00:00','2022-10-02 00:00:00',1),(15,'STRATA 3','','T','0000-00-00 00:00:00','2022-10-02 00:00:00',1),(16,'TIDAK TAMAT SD','','T','2023-11-02 18:32:00','2023-11-02 18:32:00',1);
/*!40000 ALTER TABLE `tb_pendidikan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_pengajuan`
--

DROP TABLE IF EXISTS `tb_pengajuan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_pengajuan` (
  `id_pengajuan` int(11) NOT NULL AUTO_INCREMENT,
  `tipe` int(11) DEFAULT NULL COMMENT '1. SPL\r\n2. Cuti',
  `nik` varchar(100) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time_start` time DEFAULT NULL,
  `time_end` time DEFAULT NULL,
  `atasan` varchar(100) DEFAULT NULL,
  `status_doc` int(11) DEFAULT 0,
  `ket` varchar(100) DEFAULT NULL,
  `nm_file` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_pengajuan`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_pengajuan`
--

LOCK TABLES `tb_pengajuan` WRITE;
/*!40000 ALTER TABLE `tb_pengajuan` DISABLE KEYS */;
INSERT INTO `tb_pengajuan` VALUES (1,1,'51021149','2024-06-20','19:00:00','21:00:00','505242173',1,'SPL',NULL),(2,2,'505242173','2024-06-25',NULL,NULL,'51021149',0,'CUTI TAHUNAN',NULL),(3,2,'51021149','2024-06-22','00:00:00','00:00:00','505242173',1,'CUTI BERSAMA',NULL),(4,2,'50721056','2024-06-15','00:00:00','00:00:00','505242173',0,'IZIN CUTI ACARA KELUARGA',NULL),(5,2,'50721056','2024-06-20','00:00:00','00:00:00','505242173',0,'UBAH SHIFT DARI PAGI KE MALAM',NULL),(6,2,'505242173','2024-06-22','00:00:00','00:00:00','505242173',0,'test','IDT7521231232.pdf'),(7,2,'51021149','2024-06-29','00:00:00','00:00:00','505242173',0,'test',NULL);
/*!40000 ALTER TABLE `tb_pengajuan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_personal`
--

DROP TABLE IF EXISTS `tb_personal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_personal` (
  `id_personal` int(11) NOT NULL AUTO_INCREMENT,
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
  `id_user` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_personal`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_personal`
--

LOCK TABLES `tb_personal` WRITE;
/*!40000 ALTER TABLE `tb_personal` DISABLE KEYS */;
INSERT INTO `tb_personal` VALUES (1,'6472040710840004','6472040710840004','IHFAN NOIFARA','','LK','SAMARINDA','1984-10-07',2,3,'WNI','ihf4nnoifara@gmail.com','082155553600','0','WAHYUNI','H','ZAM ZAM','H','','','','','',9,'GHANESA COLLEGE','','PROGRAMMER','20240512221454-SUPPORT.pdf','2024-05-12 22:01:25','2024-05-12 22:15:00',1),(2,'6472040710840004','6472040710840004','YEREMIA SIBURIAN','','LK','SAMARINDA','1984-10-07',2,3,'WNI','ihf4nnoifara@gmail.com','082155553600','0','WAHYUNI','H','ZAM ZAM','H','','','','','',9,'GHANESA COLLEGE','','PROGRAMMER','20240512221454-SUPPORT.pdf','2024-05-12 22:01:25','2024-05-12 22:15:00',1),(3,'6472040710840004','6472040710840004','TESTER KARYAWAN','','LK','SAMARINDA','1984-10-07',2,3,'WNI','ihf4nnoifara@gmail.com','082155553600','0','WAHYUNI','H','ZAM ZAM','H','','','','','',9,'GHANESA COLLEGE','','PROGRAMMER','20240512221454-SUPPORT.pdf','2024-05-12 22:01:25','2024-05-12 22:15:00',1);
/*!40000 ALTER TABLE `tb_personal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_perusahaan`
--

DROP TABLE IF EXISTS `tb_perusahaan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_perusahaan` (
  `id_perusahaan` int(11) NOT NULL AUTO_INCREMENT,
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
  `id_user` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_perusahaan`)
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_perusahaan`
--

LOCK TABLES `tb_perusahaan` WRITE;
/*!40000 ALTER TABLE `tb_perusahaan` DISABLE KEYS */;
INSERT INTO `tb_perusahaan` VALUES (1,0,'PT. UNGGUL','PT UNGGUL DINAMIKA UTAMA','Kaliorang','6404051001','6404051','6404','64',0,'','','','','T','','','','2023-06-12 08:30:23','2023-06-12 08:30:23',1),(85,0,'PT GDSK','PT GDSK','Kaliorang','6404051001','6404051','6404','64',0,'','','','','T','','','','1970-01-01 00:00:00','1970-01-01 00:00:00',1);
/*!40000 ALTER TABLE `tb_perusahaan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_pjo_perusahaan`
--

DROP TABLE IF EXISTS `tb_pjo_perusahaan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_pjo_perusahaan` (
  `id_pjo_perusahaan` int(11) NOT NULL AUTO_INCREMENT,
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
  `id_user` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_pjo_perusahaan`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_pjo_perusahaan`
--

LOCK TABLES `tb_pjo_perusahaan` WRITE;
/*!40000 ALTER TABLE `tb_pjo_perusahaan` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_pjo_perusahaan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_poh`
--

DROP TABLE IF EXISTS `tb_poh`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_poh` (
  `id_poh` int(11) NOT NULL AUTO_INCREMENT,
  `kd_poh` varchar(10) NOT NULL,
  `poh` varchar(100) NOT NULL,
  `ket_poh` varchar(1000) NOT NULL,
  `stat_poh` char(1) NOT NULL DEFAULT 'T',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_poh`)
) ENGINE=InnoDB AUTO_INCREMENT=109 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_poh`
--

LOCK TABLES `tb_poh` WRITE;
/*!40000 ALTER TABLE `tb_poh` DISABLE KEYS */;
INSERT INTO `tb_poh` VALUES (1,'AMB','AMBON','','T','2023-04-15 22:51:19','2023-06-24 14:59:49',1),(2,'BAC','BANDA ACEH','','T','2023-04-15 22:51:19','2023-04-15 22:51:19',1),(3,'BALI','BALI','','T','2023-04-15 22:51:19','2023-06-24 14:59:55',1),(4,'BDG','BANDUNG','','T','2023-04-15 22:51:19','2023-04-15 22:51:19',1),(5,'BGL','BENGALON','','T','2023-04-15 22:51:19','2023-04-15 22:51:19',1),(6,'BGR','BOGOR','','T','2023-04-15 22:51:19','2023-04-15 22:51:19',1),(7,'BIMA','BIMA','','T','2023-04-15 22:51:19','2023-04-15 22:51:19',1),(8,'BJB','BANJARBARU','','T','2023-04-15 22:51:19','2023-04-15 22:51:19',1),(9,'BJM','BANJARMASIN','','T','2023-04-15 22:51:19','2023-04-15 22:51:19',1),(10,'BKS','BEKASI','','T','2023-04-15 22:51:19','2023-04-15 22:51:19',1),(11,'BLM','BANDAR LAMPUNG','','T','2023-04-15 22:51:19','2023-04-15 22:51:19',1),(12,'BPN','BALIKPAPAN','','T','2023-04-15 22:51:19','2023-04-15 22:51:19',1),(13,'BTG','BONTANG','','T','2023-04-15 22:51:19','2023-04-15 22:51:19',1),(14,'BYW','BANYUWANGI','','T','2023-04-15 22:51:19','2023-04-15 22:51:19',1),(15,'CLP','CILACAP','','T','2023-04-15 22:51:19','2023-04-15 22:51:19',1),(16,'CRB','CIREBON','','T','2023-04-15 22:51:19','2023-04-15 22:51:19',1),(17,'DPK','DEPOK','','T','2023-04-15 22:51:19','2023-04-15 22:51:19',1),(18,'JKT','JAKARTA','','T','2023-04-15 22:51:19','2023-04-15 22:51:19',1),(19,'JMB','JAMBI','','T','2023-04-15 22:51:19','2023-04-15 22:51:19',1),(20,'JBR','JEMBER','','T','2023-04-15 22:51:19','2023-04-15 22:51:19',1),(21,'KBN','KEBUMEN','','T','2023-04-15 22:51:19','2023-04-15 22:51:19',1),(22,'KDR','KEDIRI','','T','2023-04-15 22:51:19','2023-04-15 22:51:19',1),(23,'KND','KENDARI','','T','2023-04-15 22:51:19','2023-04-15 22:51:19',1),(24,'KNG','KUNINGAN','','T','2023-04-15 22:51:19','2023-04-15 22:51:19',1),(25,'KPG','KUPANG','','T','2023-04-15 22:51:19','2023-04-15 22:51:19',1),(26,'KRA','KARANGANYAR','','T','2023-04-15 22:51:19','2023-04-15 22:51:19',1),(27,'KTP','KETAPANG','','T','2023-04-15 22:51:19','2023-04-15 22:51:19',1),(28,'LBM','LOKAL - BUKIT MAKMUR','','T','2023-04-15 22:51:19','2023-04-15 22:51:19',1),(29,'LKB','LOKAL - KAUBUN','','T','2023-04-15 22:51:19','2023-04-15 22:51:19',1),(30,'LKL','LOKAL','','T','2023-04-15 22:51:19','2023-04-15 22:51:19',1),(31,'LKLG','LOKAL - KALIORANG','','T','2023-04-15 22:51:19','2023-04-15 22:51:19',1),(32,'LKRG','LOKAL - KARANGAN','','T','2023-04-15 22:51:19','2023-04-15 22:51:19',1),(33,'LMB','LOMBOK','','T','2023-04-15 22:51:19','2023-04-15 22:51:19',1),(34,'LPG','LAMPUNG','','T','2023-04-15 22:51:19','2023-04-15 22:51:19',1),(35,'LPGD','LOKAL - PENGADAN','','T','2023-04-15 22:51:19','2023-04-15 22:51:19',1),(36,'LSLG','LOKAL - SELANGKAU','','T','2023-04-15 22:51:19','2023-04-15 22:51:19',1),(37,'MDM','MADIUN','','T','2023-04-15 22:51:19','2023-04-15 22:51:19',1),(38,'MDN','MEDAN','','T','2023-04-15 22:51:19','2023-04-15 22:51:19',1),(39,'MKS','MAKASSAR','','T','2023-04-15 22:51:19','2023-04-15 22:51:19',1),(40,'MLG','MALANG','','T','2023-04-15 22:51:19','2023-04-15 22:51:19',1),(41,'MLK','MELAK','','T','2023-04-15 22:51:19','2023-04-15 22:51:19',1),(42,'MMJ','MAMUJU','','T','2023-04-15 22:51:19','2023-04-15 22:51:19',1),(43,'MND','MANADO','','T','2023-04-15 22:51:19','2023-04-15 22:51:19',1),(44,'MTR','MATARAM','','T','2023-04-15 22:51:19','2023-04-15 22:51:19',1),(45,'PALU','PALU','','T','2023-04-15 22:51:19','2023-04-15 22:51:19',1),(46,'PATI','PATI','','T','2023-04-15 22:51:19','2023-04-15 22:51:19',1),(47,'PBLG','PURBALINGGA','','T','2023-04-15 22:51:19','2023-04-15 22:51:19',1),(48,'PDB','PADANG BATUNG','','T','2023-04-15 22:51:19','2023-04-15 22:51:19',1),(49,'PDG','PADANG','','T','2023-04-15 22:51:19','2023-04-15 22:51:19',1),(50,'PKL','PEKALONGAN','','T','2023-04-15 22:51:19','2023-04-15 22:51:19',1),(51,'PLK','PALANGKARAYA','','T','2023-04-15 22:51:19','2023-04-15 22:51:19',1),(52,'PLM','PALEMBANG','','T','2023-04-15 22:51:19','2023-04-15 22:51:19',1),(53,'PLP','PALOPO','','T','2023-04-15 22:51:19','2023-04-15 22:51:19',1),(54,'PML','PEMALANG','','T','2023-04-15 22:51:19','2023-04-15 22:51:19',1),(55,'PTK','PONTIANAK','','T','2023-04-15 22:51:19','2023-04-15 22:51:19',1),(56,'RIAU','RIAU','','T','2023-04-15 22:51:19','2023-04-15 22:51:19',1),(57,'SBY','SURABAYA','','T','2023-04-15 22:51:19','2023-04-15 22:51:19',1),(58,'SDJ','SIDOARJO','','T','2023-04-15 22:51:19','2023-04-15 22:51:19',1),(59,'SGT','SANGATTA','','T','2023-04-15 22:51:19','2023-04-15 22:51:19',1),(60,'SKJ','SUKOHARJO','','T','2023-04-15 22:51:19','2023-04-15 22:51:19',1),(61,'SMD','SAMARINDA','PT. SCCI','T','2023-04-15 22:51:19','2023-10-01 21:44:28',1),(62,'SMR','SEMARANG','','T','2023-04-15 22:51:19','2023-04-15 22:51:19',1),(63,'TGR','TENGGARONG','','T','2023-04-15 22:51:19','2023-04-15 22:51:19',1),(64,'TGT','TANAH GROGOT','','T','2023-04-15 22:51:19','2023-04-15 22:51:19',1),(65,'TRG','TANGERANG','','T','2023-04-15 22:51:19','2023-04-15 22:51:19',1),(66,'TRJU','TORAJA UTARA','','T','2023-04-15 22:51:19','2023-04-15 22:51:19',1),(67,'YGY','YOGYAKARTA','','T','1970-01-01 00:00:00','2023-10-25 12:05:52',1),(70,'KLG','KALIORANG','','T','2023-08-23 10:56:47','2023-09-05 08:39:40',7),(72,'SKL','SANGKULIRANG','AKTIF','T','2023-09-08 15:51:45','2023-09-08 15:51:45',49),(73,'KLT','KALIMANTAN TIMUR','','T','2023-09-10 10:36:15','2023-09-10 10:36:15',53),(75,'TRK','TARAKAN','','T','2023-10-12 02:43:07','2023-10-12 02:43:07',1),(76,'KTG','KATINGAN','','T','2023-10-12 02:44:01','2023-10-12 02:44:01',1),(77,'PRW','PURWAKARTA','','T','2023-10-12 02:45:22','2023-10-12 02:45:22',1),(78,'MUT','MUARA TEWEH','','T','2023-10-12 02:46:04','2023-10-12 02:46:04',1),(79,'BGU','BENGKULU','','T','2023-10-12 02:47:31','2023-10-12 02:47:31',1),(80,'STG','SALATIGA','','T','2023-10-25 13:29:08','2023-10-25 13:29:08',102),(81,'SBM','SUKABUMI','','T','2023-10-25 13:31:34','2023-10-25 13:31:34',102),(82,'GRS','GRESIK','','T','2023-10-25 13:32:00','2023-10-25 13:32:00',102),(83,'BLG','BULUNGAN','','T','2023-10-25 13:32:31','2023-10-25 13:32:31',102),(84,'SBW','SUMBAWA','','T','2023-10-25 13:32:44','2023-10-25 13:32:44',102),(85,'SLM','SLEMAN','','T','2023-10-25 14:41:24','2023-10-25 14:41:24',102),(86,'LWK','LUWUK','','T','2023-10-25 14:41:33','2023-10-25 14:41:33',102),(87,'TTR','TANA TORAJA','','T','2023-10-25 14:41:46','2023-10-25 14:41:46',102),(88,'TLG','TULUNGAGUNG','','T','2023-10-25 14:42:07','2023-10-25 14:42:07',102),(89,'PSR','PASER','','T','2023-10-25 14:42:55','2023-10-25 14:42:55',102),(90,'BLR','BLORA','','T','2023-10-25 14:43:06','2023-10-25 14:43:06',102),(91,'ENRK','ENREKANG','','T','2023-10-25 14:43:24','2023-10-25 14:43:24',102),(92,'PBR','PROBOLINGGO','','T','2023-10-25 14:43:35','2023-10-25 14:43:35',102),(93,'SOLO','SOLO','','T','2023-10-25 14:43:42','2023-10-25 14:43:42',102),(94,'MRS','MAROS','','T','2023-10-25 14:43:50','2023-10-25 14:43:50',102),(95,'BLT','BLITAR','','T','2023-10-25 14:46:47','2023-10-25 14:46:47',102),(96,'WNG','WONOGIRI','','T','2023-10-25 14:47:04','2023-10-25 14:47:04',102),(97,'MW','MUARA WAHAU','','T','2024-01-03 09:27:05','2024-01-03 09:27:05',24),(98,'TPN','TAPIN','','T','2024-01-08 14:16:16','2024-01-08 14:16:16',59),(99,'LRH','LOREH','','T','2024-01-08 14:18:08','2024-01-08 14:18:08',59),(100,'KTT','KUTAI TIMUR','','T','2024-01-08 14:18:28','2024-01-08 14:18:28',59),(101,'BRT','BARITO TIMUR','','T','2024-01-08 14:19:47','2024-01-08 14:19:47',59),(102,'BHT','BUHUT','','T','2024-01-08 14:19:56','2024-01-08 14:19:56',59),(103,'MUB','MUARA BAKAH','','T','2024-01-08 14:21:05','2024-01-08 14:21:05',59),(104,'TNB','TANAH BUMBU','','T','2024-01-08 14:22:39','2024-01-08 14:22:39',59),(105,'TNL','TANAH LAUT','','T','2024-01-08 14:23:44','2024-01-08 14:23:44',59),(106,'PKNBR','PEKANBARU','','T','2024-02-17 08:21:09','2024-02-17 08:21:09',24),(107,'BR','BERAU','','T','2024-02-17 08:36:43','2024-02-17 08:36:43',24),(108,'DMP','DOMPU','','T','2024-04-20 10:40:08','2024-04-20 10:40:08',59);
/*!40000 ALTER TABLE `tb_poh` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_posisi`
--

DROP TABLE IF EXISTS `tb_posisi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_posisi` (
  `id_posisi` int(11) NOT NULL AUTO_INCREMENT,
  `posisi` varchar(150) NOT NULL,
  `id_depart` char(5) NOT NULL DEFAULT '',
  `ket_posisi` varchar(1000) NOT NULL,
  `stat_posisi` char(1) NOT NULL DEFAULT '',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0,
  `id_perusahaan` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_posisi`)
) ENGINE=InnoDB AUTO_INCREMENT=1559 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_posisi`
--

LOCK TABLES `tb_posisi` WRITE;
/*!40000 ALTER TABLE `tb_posisi` DISABLE KEYS */;
INSERT INTO `tb_posisi` VALUES (1557,'PROGRAMMER DEVELOPMENT','4','','T','2024-05-12 21:56:32','2024-05-12 21:56:32',1,1),(1558,'IT SUPPORT','4','','T','2024-05-12 21:56:32','2024-05-12 21:56:32',1,1);
/*!40000 ALTER TABLE `tb_posisi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_roster`
--

DROP TABLE IF EXISTS `tb_roster`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_roster` (
  `id_roster` int(11) NOT NULL AUTO_INCREMENT,
  `kd_roster` varchar(10) NOT NULL DEFAULT '',
  `roster` varchar(100) NOT NULL DEFAULT '',
  `jml_hari_onsite` int(4) NOT NULL DEFAULT 0,
  `jml_hari_offsite` int(4) NOT NULL DEFAULT 0,
  `ket_roster` varchar(1000) NOT NULL DEFAULT '',
  `stat_roster` char(1) NOT NULL DEFAULT 'T',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(5) NOT NULL DEFAULT 0,
  `id_perusahaan` int(5) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_roster`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_roster`
--

LOCK TABLES `tb_roster` WRITE;
/*!40000 ALTER TABLE `tb_roster` DISABLE KEYS */;
INSERT INTO `tb_roster` VALUES (1,'62W','6 - 2 WEEK',42,14,'','T','2023-04-15 11:00:00','2023-04-13 14:16:31',1,1),(2,'102W','10 - 2 WEEK',70,14,'','T','2023-04-15 11:00:00','2023-04-13 13:28:54',1,1),(3,'82W','8 - 2 WEEK',56,14,'','T','1970-01-01 00:00:00','1970-01-01 00:00:00',1,1);
/*!40000 ALTER TABLE `tb_roster` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_sanksi`
--

DROP TABLE IF EXISTS `tb_sanksi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_sanksi` (
  `id_sanksi` int(11) NOT NULL AUTO_INCREMENT,
  `kd_sanksi` varchar(10) NOT NULL DEFAULT '',
  `sanksi` varchar(100) NOT NULL DEFAULT '',
  `jml_hari_berlaku` int(5) NOT NULL,
  `ket_sanksi` varchar(1000) NOT NULL DEFAULT '',
  `stat_sanksi` char(1) NOT NULL DEFAULT 'T',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_sanksi`),
  KEY `kd_sanksi` (`kd_sanksi`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_sanksi`
--

LOCK TABLES `tb_sanksi` WRITE;
/*!40000 ALTER TABLE `tb_sanksi` DISABLE KEYS */;
INSERT INTO `tb_sanksi` VALUES (1,'ST','SURAT TEGURAN',30,'','T','1970-01-01 00:00:00','1970-01-01 00:00:00',1),(2,'SP1','SURAT PERINGATAN KE 1',90,'','T','1970-01-01 00:00:00','2023-04-13 10:04:57',1);
/*!40000 ALTER TABLE `tb_sanksi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_section`
--

DROP TABLE IF EXISTS `tb_section`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_section` (
  `id_section` int(11) NOT NULL AUTO_INCREMENT,
  `kd_section` varchar(8) NOT NULL,
  `section` varchar(100) NOT NULL,
  `id_depart` int(11) NOT NULL DEFAULT 0,
  `ket_section` varchar(300) NOT NULL,
  `stat_section` char(1) NOT NULL DEFAULT 'T',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0,
  `id_perusahaan` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_section`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_section`
--

LOCK TABLES `tb_section` WRITE;
/*!40000 ALTER TABLE `tb_section` DISABLE KEYS */;
INSERT INTO `tb_section` VALUES (1,'IT','IT',4,'','T','2024-05-12 21:56:10','2024-05-12 21:56:10',1,1);
/*!40000 ALTER TABLE `tb_section` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_sertifikasi_kary`
--

DROP TABLE IF EXISTS `tb_sertifikasi_kary`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_sertifikasi_kary` (
  `id_sertifikasi` int(11) NOT NULL AUTO_INCREMENT,
  `id_personal` int(11) NOT NULL DEFAULT 0,
  `id_jenis_sertifikasi` int(11) NOT NULL DEFAULT 0,
  `no_sertifikasi` varchar(100) NOT NULL DEFAULT '0',
  `lembaga` varchar(225) NOT NULL DEFAULT '-',
  `tgl_sertifikasi` date NOT NULL DEFAULT '1970-01-01',
  `tgl_berakhir_sertifikasi` date NOT NULL DEFAULT '1970-01-01',
  `file_sertifikasi` varchar(500) NOT NULL,
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_sertifikasi`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2714 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_sertifikasi_kary`
--

LOCK TABLES `tb_sertifikasi_kary` WRITE;
/*!40000 ALTER TABLE `tb_sertifikasi_kary` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_sertifikasi_kary` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_shift`
--

DROP TABLE IF EXISTS `tb_shift`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_shift` (
  `id_shift` int(11) NOT NULL AUTO_INCREMENT,
  `kode_shift` varchar(100) DEFAULT NULL,
  `nama_shift` varchar(100) DEFAULT NULL,
  `jam_masuk` time DEFAULT NULL,
  `jam_pulang` time DEFAULT NULL,
  PRIMARY KEY (`id_shift`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_shift`
--

LOCK TABLES `tb_shift` WRITE;
/*!40000 ALTER TABLE `tb_shift` DISABLE KEYS */;
INSERT INTO `tb_shift` VALUES (1,'D','Dayshift','09:00:00','17:00:00'),(2,'N','Nightshift','21:00:00','09:00:00'),(3,'TRV','Travel',NULL,NULL),(4,'RC','Rooster Cuti',NULL,NULL),(5,'O','Offsite',NULL,NULL);
/*!40000 ALTER TABLE `tb_shift` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_sim`
--

DROP TABLE IF EXISTS `tb_sim`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_sim` (
  `id_sim` int(11) NOT NULL AUTO_INCREMENT,
  `sim` varchar(50) NOT NULL,
  `ket_sim` varchar(1000) NOT NULL,
  `stat_sim` char(1) NOT NULL DEFAULT 'T',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_sim`),
  KEY `agama` (`sim`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_sim`
--

LOCK TABLES `tb_sim` WRITE;
/*!40000 ALTER TABLE `tb_sim` DISABLE KEYS */;
INSERT INTO `tb_sim` VALUES (2,'SIM A','-','T','2021-11-07 17:00:00','2023-06-24 15:01:49',1),(3,'SIM B I','-','T','2021-11-07 17:00:00','2023-05-23 00:00:00',1),(4,'SIM B II','-','T','2021-11-07 17:00:00','2023-05-23 00:00:00',1),(5,'SIM A UMUM','-','T','2021-11-07 17:00:00','2023-05-23 00:00:00',1),(6,'SIM B I UMUM','-','T','2021-11-07 17:00:00','2023-05-23 00:00:00',1),(7,'SIM B II UMUM','-','T','2021-11-07 17:00:00','2023-05-23 00:00:00',1);
/*!40000 ALTER TABLE `tb_sim` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_sim_karyawan`
--

DROP TABLE IF EXISTS `tb_sim_karyawan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_sim_karyawan` (
  `id_sim_kary` int(11) NOT NULL AUTO_INCREMENT,
  `id_personal` int(11) NOT NULL DEFAULT 0,
  `id_sim` int(11) NOT NULL DEFAULT 0,
  `tgl_exp_sim` date NOT NULL DEFAULT '1970-01-01',
  `ket_sim_kary` varchar(1000) NOT NULL DEFAULT '',
  `url_file` varchar(1000) NOT NULL DEFAULT '',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_sim_kary`)
) ENGINE=InnoDB AUTO_INCREMENT=719 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_sim_karyawan`
--

LOCK TABLES `tb_sim_karyawan` WRITE;
/*!40000 ALTER TABLE `tb_sim_karyawan` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_sim_karyawan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_sio_perusahaan`
--

DROP TABLE IF EXISTS `tb_sio_perusahaan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_sio_perusahaan` (
  `id_sio_perusahaan` int(11) NOT NULL AUTO_INCREMENT,
  `id_m_perusahaan` int(11) NOT NULL DEFAULT 0,
  `no_sio_perusahaan` varchar(50) NOT NULL DEFAULT '',
  `tgl_mulai_sio` date NOT NULL DEFAULT '1970-01-01',
  `tgl_akhir_sio` date NOT NULL DEFAULT '1970-01-01',
  `url_sio` varchar(500) NOT NULL DEFAULT '',
  `ket_sio` varchar(1000) NOT NULL DEFAULT '',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_sio_perusahaan`),
  KEY `no_sio` (`no_sio_perusahaan`),
  KEY `FK_tb_sio_perusahaan_tb_m_perusahaan` (`id_m_perusahaan`),
  CONSTRAINT `FK_tb_sio_perusahaan_tb_m_perusahaan` FOREIGN KEY (`id_m_perusahaan`) REFERENCES `tb_m_perusahaan` (`id_m_perusahaan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_sio_perusahaan`
--

LOCK TABLES `tb_sio_perusahaan` WRITE;
/*!40000 ALTER TABLE `tb_sio_perusahaan` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_sio_perusahaan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_stat_nikah`
--

DROP TABLE IF EXISTS `tb_stat_nikah`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_stat_nikah` (
  `id_stat_nikah` int(11) NOT NULL AUTO_INCREMENT,
  `kode_stat_nikah` varchar(20) NOT NULL,
  `stat_nikah` varchar(50) NOT NULL,
  `ket_nikah` varchar(1000) NOT NULL,
  `stat_aktif_nikah` char(1) NOT NULL DEFAULT 'T',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_stat_nikah`),
  KEY `agama` (`stat_nikah`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_stat_nikah`
--

LOCK TABLES `tb_stat_nikah` WRITE;
/*!40000 ALTER TABLE `tb_stat_nikah` DISABLE KEYS */;
INSERT INTO `tb_stat_nikah` VALUES (1,'BKW','BELUM KAWIN','-','T','2021-11-07 17:00:00','1970-01-01 00:00:00',1),(2,'KWN','KAWIN','-','T','2021-11-07 17:00:00','1970-01-01 00:00:00',1),(7,'CRH','CERAI HIDUP','','T','2023-09-07 07:55:00','2023-09-07 07:55:00',1),(8,'CRM','CERAI MATI','','T','2023-09-07 07:55:00','2023-09-07 07:55:00',1);
/*!40000 ALTER TABLE `tb_stat_nikah` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_stat_perjanjian`
--

DROP TABLE IF EXISTS `tb_stat_perjanjian`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_stat_perjanjian` (
  `id_stat_perjanjian` int(11) NOT NULL AUTO_INCREMENT,
  `stat_perjanjian` varchar(50) NOT NULL,
  `ket_stat_perjanjian` varchar(200) NOT NULL,
  `stat_stat_perjanjian` char(1) NOT NULL DEFAULT 'T',
  `stat_waktu` char(1) NOT NULL DEFAULT 'T',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_stat_perjanjian`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_stat_perjanjian`
--

LOCK TABLES `tb_stat_perjanjian` WRITE;
/*!40000 ALTER TABLE `tb_stat_perjanjian` DISABLE KEYS */;
INSERT INTO `tb_stat_perjanjian` VALUES (1,'PKWTT PERMANEN','-','T','F','2021-11-08 12:53:25','2023-04-13 07:56:07',1),(3,'PKWTT PROBATION','-','T','T','2021-11-15 11:36:04','2023-04-13 07:56:07',1),(13,'PKWT','','T','T','2023-06-07 14:29:34','2023-06-07 14:29:34',1),(14,'PKWT KHUSUS','-','T','T','2023-10-12 07:00:00','2023-10-12 07:00:00',1);
/*!40000 ALTER TABLE `tb_stat_perjanjian` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_stat_tinggal`
--

DROP TABLE IF EXISTS `tb_stat_tinggal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_stat_tinggal` (
  `id_stat_tinggal` int(11) NOT NULL AUTO_INCREMENT,
  `stat_tinggal` varchar(20) NOT NULL DEFAULT '',
  `ket_stat_tinggal` varchar(1000) NOT NULL DEFAULT '',
  `status_tinggal` char(1) NOT NULL DEFAULT 'T',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_stat_tinggal`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_stat_tinggal`
--

LOCK TABLES `tb_stat_tinggal` WRITE;
/*!40000 ALTER TABLE `tb_stat_tinggal` DISABLE KEYS */;
INSERT INTO `tb_stat_tinggal` VALUES (1,'RESIDENCE','','T','1970-01-01 00:00:00','1970-01-01 00:00:00',1),(2,'NON RESIDENCE','','T','1970-01-01 00:00:00','1970-01-01 00:00:00',1);
/*!40000 ALTER TABLE `tb_stat_tinggal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_statpajak`
--

DROP TABLE IF EXISTS `tb_statpajak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_statpajak` (
  `id_statpajak` int(11) NOT NULL AUTO_INCREMENT,
  `kd_statpajak` varchar(10) NOT NULL,
  `stat_pajak` varchar(100) NOT NULL,
  `ket_pajak` varchar(1000) NOT NULL,
  `stat_aktif_pajak` char(1) NOT NULL DEFAULT 'T',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_statpajak`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_statpajak`
--

LOCK TABLES `tb_statpajak` WRITE;
/*!40000 ALTER TABLE `tb_statpajak` DISABLE KEYS */;
INSERT INTO `tb_statpajak` VALUES (1,'K0','K0','-','T','2021-11-07 17:00:00','1970-01-01 00:00:00',1),(2,'K1','K1','-','T','2021-11-07 17:00:00','1970-01-01 00:00:00',1),(3,'K2','K2','-','T','2021-11-07 17:00:00','1970-01-01 00:00:00',1),(4,'K3','K3','-','T','2021-11-07 17:00:00','1970-01-01 00:00:00',1),(5,'TK0','TK0','-','T','2021-11-07 17:00:00','1970-01-01 00:00:00',1),(6,'TK1','TK1','-','T','2022-01-24 10:15:58','1970-01-01 00:00:00',1),(7,'TK2','TK2','-','T','2022-01-24 10:16:18','1970-01-01 00:00:00',1),(8,'TK3','TK3','-','T','2022-01-24 10:16:39','1970-01-01 00:00:00',1);
/*!40000 ALTER TABLE `tb_statpajak` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_tipe`
--

DROP TABLE IF EXISTS `tb_tipe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_tipe` (
  `id_tipe` int(11) NOT NULL AUTO_INCREMENT,
  `tipe` varchar(50) NOT NULL,
  `ket_tipe` varchar(200) NOT NULL,
  `stat_tipe` char(1) NOT NULL DEFAULT 'T',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_tipe`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_tipe`
--

LOCK TABLES `tb_tipe` WRITE;
/*!40000 ALTER TABLE `tb_tipe` DISABLE KEYS */;
INSERT INTO `tb_tipe` VALUES (1,'NON STAFF','-','T','2021-11-07 14:44:13','2023-10-21 17:28:33',1),(2,'STAFF','STAFF','T','2021-11-07 14:43:41','2023-09-08 10:32:33',1);
/*!40000 ALTER TABLE `tb_tipe` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_tipe_akses_unit`
--

DROP TABLE IF EXISTS `tb_tipe_akses_unit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_tipe_akses_unit` (
  `id_tipe_akses_unit` int(11) NOT NULL AUTO_INCREMENT,
  `kode_tipe_akses_unit` char(5) NOT NULL,
  `tipe_akses_unit` varchar(50) NOT NULL DEFAULT '',
  `ket_tipe_akses_unit` varchar(1000) NOT NULL DEFAULT '',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_tipe_akses_unit`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_tipe_akses_unit`
--

LOCK TABLES `tb_tipe_akses_unit` WRITE;
/*!40000 ALTER TABLE `tb_tipe_akses_unit` DISABLE KEYS */;
INSERT INTO `tb_tipe_akses_unit` VALUES (1,'P','PROBATION','','1970-01-01 00:00:00','1970-01-01 00:00:00',1),(2,'F','FULL','','1970-01-01 00:00:00','1970-01-01 00:00:00',1),(3,'R','RESTRICTED','','1970-01-01 00:00:00','1970-01-01 00:00:00',1);
/*!40000 ALTER TABLE `tb_tipe_akses_unit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_unit`
--

DROP TABLE IF EXISTS `tb_unit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_unit` (
  `id_unit` int(11) NOT NULL AUTO_INCREMENT,
  `kode_unit` char(10) NOT NULL DEFAULT '',
  `unit` varchar(100) NOT NULL DEFAULT '',
  `stat_unit` char(2) NOT NULL DEFAULT 'T',
  `ket_unit` varchar(1000) NOT NULL DEFAULT '',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_unit`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_unit`
--

LOCK TABLES `tb_unit` WRITE;
/*!40000 ALTER TABLE `tb_unit` DISABLE KEYS */;
INSERT INTO `tb_unit` VALUES (1,'LV','LIGHT VEHICLE','T','IN ASM 001','2023-05-23 00:00:00','2023-11-25 14:20:09',1),(27,'ELF','ELF','T','IN ASM 002','2023-11-12 09:10:46','2023-12-13 16:06:58',60),(30,'BUS','BUS','T','','2023-12-02 11:06:42','2023-12-02 11:06:42',60),(31,'DT','DUMP TRUCK','T','','2023-12-05 09:10:54','2023-12-05 09:10:54',77),(32,'WT','WATER TRUCK','T','','2023-12-05 11:55:03','2023-12-05 11:55:03',32),(33,'MG','MOTOR GRADER','T','','2023-12-05 11:55:14','2023-12-05 11:55:14',32),(34,'LBT','LOW BOY TRAILER','T','','2023-12-05 15:43:02','2023-12-05 15:43:02',32),(35,'AD','ASPHALT DISTRIBUTOR','T','','2023-12-05 15:43:30','2023-12-05 15:43:30',32),(36,'EXC PC200','EXCAVATOR PC200','T','','2023-12-06 10:38:06','2023-12-15 14:31:16',32),(37,'BHL','BACKHOE LOADER','T','','2023-12-06 10:38:36','2023-12-06 10:38:36',32),(38,'WL','WHEEL LOADER','T','','2023-12-06 10:38:55','2023-12-06 10:38:55',32),(39,'VR','VIBRO ROLLER','T','','2023-12-06 11:50:58','2023-12-06 11:50:58',32),(40,'FT','FUEL TRUCK','T','','2023-12-07 14:37:24','2023-12-07 14:37:24',32),(41,'MH','MANHAUL','T','','2023-12-07 14:43:39','2023-12-07 14:43:39',32),(42,'DT10R','DUMP TRUCK 10R','T','','2023-12-07 15:28:31','2023-12-07 15:28:31',32),(43,'DT6R','DUMP TRUCK 6R','T','','2023-12-07 15:28:51','2023-12-07 15:28:51',32),(44,'LT','LIGHT TRUCK','T','','2023-12-08 11:12:18','2023-12-08 11:12:18',24),(45,'FK','FORKLIFT','T','','2023-12-10 08:55:01','2023-12-10 08:55:01',24),(46,'EXC PC300','EXCAVATOR PC300','T','','2023-12-15 14:31:52','2023-12-15 14:31:52',32),(47,'EXC PC400','EXCAVATOR PC400','T','','2023-12-15 14:32:28','2023-12-15 14:32:28',32),(51,'DT610R','DUMP TRUCK 6 10 R','T','','2024-01-12 08:30:32','2024-01-12 08:30:32',24),(52,'EX','EXCAVATOR','T','','2024-01-12 08:30:48','2024-01-12 08:30:48',24),(53,'CP','COMPACTOR','T','','2024-01-12 08:31:10','2024-01-12 08:31:10',24);
/*!40000 ALTER TABLE `tb_unit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_user`
--

DROP TABLE IF EXISTS `tb_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
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
  `id_m_perusahaan` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_user`
--

LOCK TABLES `tb_user` WRITE;
/*!40000 ALTER TABLE `tb_user` DISABLE KEYS */;
INSERT INTO `tb_user` VALUES (1,'Ihfan Noifara','ihfan.noifara@ungguldinamika.co.id','2023-06-12','2025-06-11','1312ddb877d682d6cbddbb7178a5eaba','',4,'T','ALL','','2023-06-12 11:40:17','2024-04-21 13:55:08',0,1),(39,'Ihfan Noifara','ihf4n.unggul@gmail.com','2023-08-24','2024-04-17','e10adc3949ba59abbe56e057f20f883e','',4,'T','ALL','','2023-08-24 07:56:36','2023-08-24 07:56:36',1,1),(50,'Wahyu Trihantoro','wahyu.trihantoro@ungguldinamika.co.id','2023-09-06','2025-04-17','9eec5f52b003d50487f31f35a63592f3','',4,'T','ALL','','2023-09-06 08:21:43','2023-09-06 08:28:16',1,1),(51,'Hambali','hambali@ungguldinamika.co.id','2023-09-06','2025-04-17','e10adc3949ba59abbe56e057f20f883e','',4,'T','ALL','','2023-09-06 08:32:15','2023-09-06 08:32:15',1,1),(110,'Syarif Mamardi','syarif.mamardi@ungguldinamika.co.id','2024-05-12','2030-05-12','e10adc3949ba59abbe56e057f20f883e','',4,'T','ALL','','2024-05-12 22:18:25','2024-05-12 22:18:25',1,1),(111,'Kadek Devis Ferliyawan','kadek.ferliyawan@ungguldinamika.co.id','2024-05-17','2025-05-17','e10adc3949ba59abbe56e057f20f883e','',4,'T','ALL','','2024-05-17 16:20:24','2024-05-17 16:20:24',1,1),(112,'User','user@ungguldinamika.co.id','2024-05-19','2030-05-19','e10adc3949ba59abbe56e057f20f883e','',4,'T','ALL','','2024-05-19 10:56:05','2024-05-19 10:56:05',1,1);
/*!40000 ALTER TABLE `tb_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_vaksin_jenis`
--

DROP TABLE IF EXISTS `tb_vaksin_jenis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_vaksin_jenis` (
  `id_vaksin_jenis` int(11) NOT NULL AUTO_INCREMENT,
  `vaksin_jenis` varchar(100) NOT NULL,
  `stat_vaksin_jenis` char(1) NOT NULL DEFAULT 'T',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_vaksin_jenis`),
  KEY `agama` (`vaksin_jenis`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_vaksin_jenis`
--

LOCK TABLES `tb_vaksin_jenis` WRITE;
/*!40000 ALTER TABLE `tb_vaksin_jenis` DISABLE KEYS */;
INSERT INTO `tb_vaksin_jenis` VALUES (7,'Vaksin 1','T','1970-01-01 00:00:00','1970-01-01 00:00:00',1),(8,'Vaksin 2','T','1970-01-01 00:00:00','1970-01-01 00:00:00',1),(9,'Booster 1','T','1970-01-01 00:00:00','1970-01-01 00:00:00',1),(10,'Booster 2','T','1970-01-01 00:00:00','1970-01-01 00:00:00',1);
/*!40000 ALTER TABLE `tb_vaksin_jenis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_vaksin_kary`
--

DROP TABLE IF EXISTS `tb_vaksin_kary`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_vaksin_kary` (
  `id_vaksin` int(11) NOT NULL AUTO_INCREMENT,
  `id_personal` int(11) NOT NULL DEFAULT 0,
  `id_vaksin_jenis` int(11) NOT NULL DEFAULT 0,
  `tgl_vaksin` date NOT NULL,
  `id_vaksin_nama` int(11) NOT NULL DEFAULT 0,
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_vaksin`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_vaksin_kary`
--

LOCK TABLES `tb_vaksin_kary` WRITE;
/*!40000 ALTER TABLE `tb_vaksin_kary` DISABLE KEYS */;
INSERT INTO `tb_vaksin_kary` VALUES (1,1,7,'2021-05-12',7,'2024-05-12 22:13:44','2024-05-12 22:13:44',1),(2,1,8,'2021-10-28',7,'2024-05-12 22:14:16','2024-05-12 22:14:16',1);
/*!40000 ALTER TABLE `tb_vaksin_kary` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_vaksin_nama`
--

DROP TABLE IF EXISTS `tb_vaksin_nama`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_vaksin_nama` (
  `id_vaksin_nama` int(11) NOT NULL AUTO_INCREMENT,
  `vaksin_nama` varchar(100) NOT NULL,
  `stat_vaksin_nama` char(1) NOT NULL DEFAULT 'T',
  `tgl_buat` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `tgl_edit` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `id_user` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_vaksin_nama`),
  KEY `agama` (`vaksin_nama`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_vaksin_nama`
--

LOCK TABLES `tb_vaksin_nama` WRITE;
/*!40000 ALTER TABLE `tb_vaksin_nama` DISABLE KEYS */;
INSERT INTO `tb_vaksin_nama` VALUES (7,'Sinovac','T','1970-01-01 00:00:00','1970-01-01 00:00:00',1),(8,'AstraZeneca','T','1970-01-01 00:00:00','1970-01-01 00:00:00',1),(9,'Sinopharm','T','1970-01-01 00:00:00','1970-01-01 00:00:00',1),(10,'Moderna','T','1970-01-01 00:00:00','1970-01-01 00:00:00',1),(11,'Pfizer','T','1970-01-01 00:00:00','1970-01-01 00:00:00',1),(12,'Novavax','T','1970-01-01 00:00:00','1970-01-01 00:00:00',1),(13,'CoronaVac','T','1970-01-01 00:00:00','1970-01-01 00:00:00',59),(14,'Biofarma','T','1970-01-01 00:00:00','1970-01-01 00:00:00',59),(15,'Shinopharm','T','1970-01-01 00:00:00','1970-01-01 00:00:00',59);
/*!40000 ALTER TABLE `tb_vaksin_nama` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `vw_alasan_nonaktif`
--

DROP TABLE IF EXISTS `vw_alasan_nonaktif`;
/*!50001 DROP VIEW IF EXISTS `vw_alasan_nonaktif`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_alasan_nonaktif` AS SELECT 
 1 AS `id_alasan_nonaktif`,
 1 AS `alasan_nonaktif`,
 1 AS `ket_alasan_nonaktif`,
 1 AS `stat_alasan_nonaktif`,
 1 AS `stat_upload_berkas`,
 1 AS `tgl_buat`,
 1 AS `tgl_edit`,
 1 AS `auth_alasan_nonaktif`,
 1 AS `id_user`,
 1 AS `nama_user`,
 1 AS `email_user`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_audit`
--

DROP TABLE IF EXISTS `vw_audit`;
/*!50001 DROP VIEW IF EXISTS `vw_audit`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_audit` AS SELECT 
 1 AS `id_audit`,
 1 AS `id_user`,
 1 AS `jenis_proses`,
 1 AS `data_proses`,
 1 AS `nama_data`,
 1 AS `tgl_edit`,
 1 AS `tgl_buat`,
 1 AS `nama_user`,
 1 AS `email_user`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_bank`
--

DROP TABLE IF EXISTS `vw_bank`;
/*!50001 DROP VIEW IF EXISTS `vw_bank`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_bank` AS SELECT 
 1 AS `id_bank`,
 1 AS `bank`,
 1 AS `ket_bank`,
 1 AS `stat_bank`,
 1 AS `tgl_buat`,
 1 AS `tgl_edit`,
 1 AS `id_user`,
 1 AS `auth_bank`,
 1 AS `nama_user`,
 1 AS `email_user`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_bank_kary`
--

DROP TABLE IF EXISTS `vw_bank_kary`;
/*!50001 DROP VIEW IF EXISTS `vw_bank_kary`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_bank_kary` AS SELECT 
 1 AS `id_bank_kary`,
 1 AS `id_personal`,
 1 AS `id_bank`,
 1 AS `bank`,
 1 AS `no_rek`,
 1 AS `nama_pemilik`,
 1 AS `stat_bank_kary`,
 1 AS `ket_bank_kary`,
 1 AS `tgl_buat`,
 1 AS `tgl_edit`,
 1 AS `id_user`,
 1 AS `auth_personal`,
 1 AS `auth_bank_kary`,
 1 AS `nama_user`,
 1 AS `email_user`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_depart`
--

DROP TABLE IF EXISTS `vw_depart`;
/*!50001 DROP VIEW IF EXISTS `vw_depart`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_depart` AS SELECT 
 1 AS `id_depart`,
 1 AS `kd_depart`,
 1 AS `depart`,
 1 AS `ket_depart`,
 1 AS `stat_depart`,
 1 AS `tgl_buat`,
 1 AS `tgl_edit`,
 1 AS `id_user`,
 1 AS `auth_depart`,
 1 AS `nama_user`,
 1 AS `email_user`,
 1 AS `id_perusahaan`,
 1 AS `id_parent`,
 1 AS `kode_perusahaan`,
 1 AS `nama_perusahaan`,
 1 AS `auth_perusahaan`,
 1 AS `id_m_perusahaan`,
 1 AS `id_m_parent`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_dprt`
--

DROP TABLE IF EXISTS `vw_dprt`;
/*!50001 DROP VIEW IF EXISTS `vw_dprt`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_dprt` AS SELECT 
 1 AS `id_depart`,
 1 AS `kd_depart`,
 1 AS `depart`,
 1 AS `ket_depart`,
 1 AS `stat_depart`,
 1 AS `tgl_buat`,
 1 AS `tgl_edit`,
 1 AS `id_user`,
 1 AS `auth_depart`,
 1 AS `nama_user`,
 1 AS `email_user`,
 1 AS `id_perusahaan`,
 1 AS `id_parent`,
 1 AS `kode_perusahaan`,
 1 AS `nama_perusahaan`,
 1 AS `auth_perusahaan`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_ec`
--

DROP TABLE IF EXISTS `vw_ec`;
/*!50001 DROP VIEW IF EXISTS `vw_ec`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_ec` AS SELECT 
 1 AS `id_ec`,
 1 AS `id_personal`,
 1 AS `nama_ec`,
 1 AS `hp_ec`,
 1 AS `hp_ec_2`,
 1 AS `relasi_ec`,
 1 AS `stat_ec`,
 1 AS `ket_ec`,
 1 AS `tgl_buat`,
 1 AS `tgl_edit`,
 1 AS `id_user`,
 1 AS `auth_personal`,
 1 AS `auth_ec`,
 1 AS `nama_user`,
 1 AS `email_user`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_grade`
--

DROP TABLE IF EXISTS `vw_grade`;
/*!50001 DROP VIEW IF EXISTS `vw_grade`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_grade` AS SELECT 
 1 AS `id_grade`,
 1 AS `grade`,
 1 AS `ket_grade`,
 1 AS `stat_grade`,
 1 AS `tgl_buat`,
 1 AS `tgl_edit`,
 1 AS `id_user`,
 1 AS `id_level`,
 1 AS `kd_level`,
 1 AS `level`,
 1 AS `auth_grade`,
 1 AS `nama_user`,
 1 AS `email_user`,
 1 AS `id_perusahaan`,
 1 AS `id_parent`,
 1 AS `kode_perusahaan`,
 1 AS `nama_perusahaan`,
 1 AS `auth_level`,
 1 AS `auth_perusahaan`,
 1 AS `id_m_perusahaan`,
 1 AS `id_m_parent`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_grd`
--

DROP TABLE IF EXISTS `vw_grd`;
/*!50001 DROP VIEW IF EXISTS `vw_grd`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_grd` AS SELECT 
 1 AS `id_grade`,
 1 AS `grade`,
 1 AS `ket_grade`,
 1 AS `stat_grade`,
 1 AS `tgl_buat`,
 1 AS `tgl_edit`,
 1 AS `id_user`,
 1 AS `id_level`,
 1 AS `kd_level`,
 1 AS `level`,
 1 AS `auth_grade`,
 1 AS `nama_user`,
 1 AS `email_user`,
 1 AS `id_perusahaan`,
 1 AS `id_parent`,
 1 AS `kode_perusahaan`,
 1 AS `nama_perusahaan`,
 1 AS `auth_level`,
 1 AS `auth_perusahaan`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_ip_blacklist`
--

DROP TABLE IF EXISTS `vw_ip_blacklist`;
/*!50001 DROP VIEW IF EXISTS `vw_ip_blacklist`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_ip_blacklist` AS SELECT 
 1 AS `id_ip_blacklist`,
 1 AS `ip_address`,
 1 AS `back_log`,
 1 AS `tgl_buat`,
 1 AS `email_user`,
 1 AS `auth_email_user`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_izin_perusahaan`
--

DROP TABLE IF EXISTS `vw_izin_perusahaan`;
/*!50001 DROP VIEW IF EXISTS `vw_izin_perusahaan`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_izin_perusahaan` AS SELECT 
 1 AS `id_izin_perusahaan`,
 1 AS `id_m_perusahaan`,
 1 AS `no_izin_perusahaan`,
 1 AS `tgl_mulai_izin`,
 1 AS `tgl_akhir_izin`,
 1 AS `url_izin_perusahaan`,
 1 AS `ket_izin_perusahaan`,
 1 AS `tgl_buat`,
 1 AS `tgl_edit`,
 1 AS `id_user`,
 1 AS `auth_izin_perusahaan`,
 1 AS `auth_m_perusahaan`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_izin_tambang`
--

DROP TABLE IF EXISTS `vw_izin_tambang`;
/*!50001 DROP VIEW IF EXISTS `vw_izin_tambang`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_izin_tambang` AS SELECT 
 1 AS `id_izin_tambang`,
 1 AS `id_kary`,
 1 AS `id_personal`,
 1 AS `no_acr`,
 1 AS `no_nik`,
 1 AS `nama_lengkap`,
 1 AS `id_depart`,
 1 AS `kd_depart`,
 1 AS `depart`,
 1 AS `id_posisi`,
 1 AS `posisi`,
 1 AS `id_jenis_izin_tambang`,
 1 AS `jenis_izin_tambang`,
 1 AS `no_reg`,
 1 AS `tgl_expired`,
 1 AS `url_izin_tambang`,
 1 AS `id_m_perusahaan`,
 1 AS `stat_izin_tambang`,
 1 AS `ket_izin_tambang`,
 1 AS `id_sim_kary`,
 1 AS `id_sim`,
 1 AS `sim`,
 1 AS `tgl_exp_sim`,
 1 AS `tgl_buat`,
 1 AS `tgl_edit`,
 1 AS `id_user`,
 1 AS `auth_karyawan`,
 1 AS `auth_izin_tambang`,
 1 AS `nama_user`,
 1 AS `email_user`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_izin_unit`
--

DROP TABLE IF EXISTS `vw_izin_unit`;
/*!50001 DROP VIEW IF EXISTS `vw_izin_unit`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_izin_unit` AS SELECT 
 1 AS `id_izin_tambang`,
 1 AS `id_kary`,
 1 AS `id_personal`,
 1 AS `no_acr`,
 1 AS `no_nik`,
 1 AS `id_depart`,
 1 AS `kd_depart`,
 1 AS `depart`,
 1 AS `id_posisi`,
 1 AS `posisi`,
 1 AS `no_reg`,
 1 AS `tgl_expired`,
 1 AS `ket_izin_tambang`,
 1 AS `id_izin_tambang_unit`,
 1 AS `id_unit`,
 1 AS `kode_unit`,
 1 AS `unit`,
 1 AS `id_tipe_akses_unit`,
 1 AS `kode_tipe_akses_unit`,
 1 AS `tipe_akses_unit`,
 1 AS `auth_karyawan`,
 1 AS `auth_izin_tambang`,
 1 AS `nama_user`,
 1 AS `email_user`,
 1 AS `id_perusahaan`,
 1 AS `kode_perusahaan`,
 1 AS `nama_perusahaan`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_jenis_sertifikasi`
--

DROP TABLE IF EXISTS `vw_jenis_sertifikasi`;
/*!50001 DROP VIEW IF EXISTS `vw_jenis_sertifikasi`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_jenis_sertifikasi` AS SELECT 
 1 AS `id_jenis_sertifikasi`,
 1 AS `kode_jenis_sertifikasi`,
 1 AS `jenis_sertifikasi`,
 1 AS `beranda`,
 1 AS `ket_jenis_sertifikasi`,
 1 AS `stat_jenis_sertifikasi`,
 1 AS `tgl_buat`,
 1 AS `tgl_edit`,
 1 AS `id_user`,
 1 AS `auth_jenis_sertifikasi`,
 1 AS `nama_user`,
 1 AS `email_user`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_jml_karyawan`
--

DROP TABLE IF EXISTS `vw_jml_karyawan`;
/*!50001 DROP VIEW IF EXISTS `vw_jml_karyawan`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_jml_karyawan` AS SELECT 
 1 AS `id_kary`,
 1 AS `no_acr`,
 1 AS `doh`,
 1 AS `bulan_now`,
 1 AS `tahun_now`,
 1 AS `bulan_doh`,
 1 AS `tahun_doh`,
 1 AS `id_m_perusahaan`,
 1 AS `id_parent`,
 1 AS `id_perusahaan`,
 1 AS `kode_perusahaan`,
 1 AS `nama_perusahaan`,
 1 AS `tgl_nonaktif`,
 1 AS `tgl_buat`,
 1 AS `stat_m_perusahaan`,
 1 AS `id_lokterima`,
 1 AS `jenis_lokasi`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_karyawan`
--

DROP TABLE IF EXISTS `vw_karyawan`;
/*!50001 DROP VIEW IF EXISTS `vw_karyawan`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_karyawan` AS SELECT 
 1 AS `id_kary`,
 1 AS `id_personal`,
 1 AS `id_perkerjaan`,
 1 AS `no_acr`,
 1 AS `no_nik`,
 1 AS `doh`,
 1 AS `tgl_aktif`,
 1 AS `id_lokker`,
 1 AS `id_lokterima`,
 1 AS `id_level`,
 1 AS `id_poh`,
 1 AS `id_roster`,
 1 AS `id_klasifikasi`,
 1 AS `klasifikasi`,
 1 AS `paybase`,
 1 AS `statpajak`,
 1 AS `id_tipe`,
 1 AS `id_stat_tinggal`,
 1 AS `tgl_permanen`,
 1 AS `tgl_nonaktif`,
 1 AS `tgl_buat`,
 1 AS `tgl_edit`,
 1 AS `id_user`,
 1 AS `id_m_perusahaan`,
 1 AS `no_ktp`,
 1 AS `no_kk`,
 1 AS `nama_lengkap`,
 1 AS `nama_alias`,
 1 AS `jk`,
 1 AS `tmp_lahir`,
 1 AS `tgl_lahir`,
 1 AS `id_stat_nikah`,
 1 AS `kode_stat_nikah`,
 1 AS `stat_nikah`,
 1 AS `id_agama`,
 1 AS `warga_negara`,
 1 AS `email_pribadi`,
 1 AS `hp_1`,
 1 AS `nama_ibu`,
 1 AS `stat_ibu`,
 1 AS `nama_ayah`,
 1 AS `stat_ayah`,
 1 AS `no_bpjstk`,
 1 AS `no_bpjskes`,
 1 AS `no_bpjspensiun`,
 1 AS `no_equity`,
 1 AS `no_npwp`,
 1 AS `id_pendidikan`,
 1 AS `nama_sekolah`,
 1 AS `fakultas`,
 1 AS `jurusan`,
 1 AS `id_depart`,
 1 AS `id_section`,
 1 AS `id_posisi`,
 1 AS `id_grade`,
 1 AS `kd_depart`,
 1 AS `depart`,
 1 AS `kd_section`,
 1 AS `section`,
 1 AS `posisi`,
 1 AS `grade`,
 1 AS `kd_level`,
 1 AS `level`,
 1 AS `kd_lokker`,
 1 AS `lokker`,
 1 AS `kd_lokterima`,
 1 AS `lokterima`,
 1 AS `kd_poh`,
 1 AS `poh`,
 1 AS `kd_roster`,
 1 AS `roster`,
 1 AS `tipe`,
 1 AS `auth_personal`,
 1 AS `auth_karyawan`,
 1 AS `auth_perusahaan`,
 1 AS `auth_m_perusahaan`,
 1 AS `id_parent`,
 1 AS `id_perusahaan`,
 1 AS `email_kantor`,
 1 AS `agama`,
 1 AS `nama_m_perusahaan`,
 1 AS `stat_m_perusahaan`,
 1 AS `kode_perusahaan`,
 1 AS `nama_perusahaan`,
 1 AS `url_pendukung`,
 1 AS `usia`,
 1 AS `lama_bekerja`,
 1 AS `jenis_lokasi`,
 1 AS `stat_tinggal`,
 1 AS `url_foto`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_karyawan_nonaktif`
--

DROP TABLE IF EXISTS `vw_karyawan_nonaktif`;
/*!50001 DROP VIEW IF EXISTS `vw_karyawan_nonaktif`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_karyawan_nonaktif` AS SELECT 
 1 AS `id_kary_nonaktif`,
 1 AS `id_kary`,
 1 AS `no_ktp`,
 1 AS `no_nik`,
 1 AS `nama_lengkap`,
 1 AS `depart`,
 1 AS `posisi`,
 1 AS `tgl_nonaktif`,
 1 AS `id_alasan_nonaktif`,
 1 AS `alasan_nonaktif`,
 1 AS `ket_nonaktif`,
 1 AS `url_berkas_nonaktif`,
 1 AS `tgl_buat`,
 1 AS `tgl_edit`,
 1 AS `id_user`,
 1 AS `nama_user`,
 1 AS `email_user`,
 1 AS `auth_kary_nonaktif`,
 1 AS `id_perusahaan`,
 1 AS `id_m_perusahaan`,
 1 AS `auth_karyawan`,
 1 AS `auth_m_perusahaan`,
 1 AS `auth_perusahaan`,
 1 AS `nama_m_perusahaan`,
 1 AS `kode_perusahaan`,
 1 AS `nama_perusahaan`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_karyawan_sertifikasi`
--

DROP TABLE IF EXISTS `vw_karyawan_sertifikasi`;
/*!50001 DROP VIEW IF EXISTS `vw_karyawan_sertifikasi`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_karyawan_sertifikasi` AS SELECT 
 1 AS `id_kary`,
 1 AS `id_personal`,
 1 AS `no_acr`,
 1 AS `no_nik`,
 1 AS `id_depart`,
 1 AS `id_posisi`,
 1 AS `id_level`,
 1 AS `kd_depart`,
 1 AS `depart`,
 1 AS `posisi`,
 1 AS `kd_level`,
 1 AS `level`,
 1 AS `tgl_nonaktif`,
 1 AS `id_jenis_sertifikasi`,
 1 AS `no_sertifikasi`,
 1 AS `tgl_sertifikasi`,
 1 AS `tgl_berakhir_sertifikasi`,
 1 AS `file_sertifikasi`,
 1 AS `kode_jenis_sertifikasi`,
 1 AS `jenis_sertifikasi`,
 1 AS `beranda`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_karyawan_terbaru`
--

DROP TABLE IF EXISTS `vw_karyawan_terbaru`;
/*!50001 DROP VIEW IF EXISTS `vw_karyawan_terbaru`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_karyawan_terbaru` AS SELECT 
 1 AS `id_kary`,
 1 AS `id_personal`,
 1 AS `no_ktp`,
 1 AS `no_nik`,
 1 AS `nama_lengkap`,
 1 AS `id_depart`,
 1 AS `kd_depart`,
 1 AS `depart`,
 1 AS `tgl_buat`,
 1 AS `id_user`,
 1 AS `nama_user`,
 1 AS `email_user`,
 1 AS `id_m_perusahaan`,
 1 AS `id_perusahaan`,
 1 AS `id_parent`,
 1 AS `kode_perusahaan`,
 1 AS `nama_perusahaan`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_klasifikasi`
--

DROP TABLE IF EXISTS `vw_klasifikasi`;
/*!50001 DROP VIEW IF EXISTS `vw_klasifikasi`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_klasifikasi` AS SELECT 
 1 AS `id_klasifikasi`,
 1 AS `klasifikasi`,
 1 AS `ket_klasifikasi`,
 1 AS `stat_klasifikasi`,
 1 AS `tgl_buat`,
 1 AS `tgl_edit`,
 1 AS `id_user`,
 1 AS `nama_user`,
 1 AS `email_user`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_kontrak_karyawan`
--

DROP TABLE IF EXISTS `vw_kontrak_karyawan`;
/*!50001 DROP VIEW IF EXISTS `vw_kontrak_karyawan`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_kontrak_karyawan` AS SELECT 
 1 AS `id_kontrak_kary`,
 1 AS `id_kary`,
 1 AS `id_stat_perjanjian`,
 1 AS `stat_perjanjian`,
 1 AS `stat_waktu`,
 1 AS `tgl_mulai`,
 1 AS `tgl_akhir`,
 1 AS `ket_kontrak`,
 1 AS `tgl_buat`,
 1 AS `tgl_edit`,
 1 AS `id_user`,
 1 AS `no_acr`,
 1 AS `no_nik`,
 1 AS `depart`,
 1 AS `posisi`,
 1 AS `nama_user`,
 1 AS `email_user`,
 1 AS `id_perusahaan`,
 1 AS `id_m_perusahaan`,
 1 AS `nama_m_perusahaan`,
 1 AS `nama_perusahaan`,
 1 AS `kode_perusahaan`,
 1 AS `auth_karyawan`,
 1 AS `auth_kontrak_kary`,
 1 AS `auth_perusahaan`,
 1 AS `auth_m_perusahaan`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_kontrak_perusahaan`
--

DROP TABLE IF EXISTS `vw_kontrak_perusahaan`;
/*!50001 DROP VIEW IF EXISTS `vw_kontrak_perusahaan`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_kontrak_perusahaan` AS SELECT 
 1 AS `id_kontrak_perusahaan`,
 1 AS `id_m_perusahaan`,
 1 AS `no_kontrak_perusahaan`,
 1 AS `tgl_mulai_kontrak`,
 1 AS `tgl_akhir_kontrak`,
 1 AS `url_doc_kontrak_perusahaan`,
 1 AS `ket_kontrak_perusahaan`,
 1 AS `tgl_buat`,
 1 AS `tgl_edit`,
 1 AS `id_user`,
 1 AS `auth_kontrak_perusahaan`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_kry`
--

DROP TABLE IF EXISTS `vw_kry`;
/*!50001 DROP VIEW IF EXISTS `vw_kry`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_kry` AS SELECT 
 1 AS `id_kary`,
 1 AS `id_personal`,
 1 AS `no_acr`,
 1 AS `no_nik`,
 1 AS `id_m_perusahaan`,
 1 AS `no_ktp`,
 1 AS `no_kk`,
 1 AS `nama_lengkap`,
 1 AS `nama_alias`,
 1 AS `jk`,
 1 AS `id_depart`,
 1 AS `id_posisi`,
 1 AS `kd_depart`,
 1 AS `depart`,
 1 AS `posisi`,
 1 AS `auth_personal`,
 1 AS `auth_karyawan`,
 1 AS `auth_perusahaan`,
 1 AS `auth_m_perusahaan`,
 1 AS `id_perusahaan`,
 1 AS `nama_m_perusahaan`,
 1 AS `kode_perusahaan`,
 1 AS `nama_perusahaan`,
 1 AS `url_pendukung`,
 1 AS `tgl_nonaktif`,
 1 AS `tgl_buat`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_ktp`
--

DROP TABLE IF EXISTS `vw_ktp`;
/*!50001 DROP VIEW IF EXISTS `vw_ktp`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_ktp` AS SELECT 
 1 AS `id_ktp`,
 1 AS `id_personal`,
 1 AS `no_ktp`,
 1 AS `nama_lengkap`,
 1 AS `url_ktp`,
 1 AS `stat_ktp`,
 1 AS `tgl_buat`,
 1 AS `tgl_edit`,
 1 AS `id_user`,
 1 AS `auth_personal`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_langgar`
--

DROP TABLE IF EXISTS `vw_langgar`;
/*!50001 DROP VIEW IF EXISTS `vw_langgar`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_langgar` AS SELECT 
 1 AS `id_langgar`,
 1 AS `id_kary`,
 1 AS `id_personal`,
 1 AS `no_acr`,
 1 AS `no_ktp`,
 1 AS `no_nik`,
 1 AS `nama_lengkap`,
 1 AS `doh`,
 1 AS `tgl_aktif`,
 1 AS `depart`,
 1 AS `section`,
 1 AS `posisi`,
 1 AS `poh`,
 1 AS `level`,
 1 AS `tipe`,
 1 AS `tgl_langgar`,
 1 AS `tgl_punishment`,
 1 AS `id_langgar_jenis`,
 1 AS `kode_langgar_jenis`,
 1 AS `langgar_jenis`,
 1 AS `durasi_langgar_jenis`,
 1 AS `jenis_durasi`,
 1 AS `url_langgar`,
 1 AS `ket_langgar`,
 1 AS `tgl_akhir_langgar`,
 1 AS `tgl_buat`,
 1 AS `tgl_edit`,
 1 AS `id_user`,
 1 AS `id_m_perusahaan`,
 1 AS `kode_perusahaan`,
 1 AS `nama_m_perusahaan`,
 1 AS `auth_kary`,
 1 AS `auth_personal`,
 1 AS `auth_m_per`,
 1 AS `nama_user`,
 1 AS `email_user`,
 1 AS `auth_langgar`,
 1 AS `auth_langgar_jenis`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_langgar_jenis`
--

DROP TABLE IF EXISTS `vw_langgar_jenis`;
/*!50001 DROP VIEW IF EXISTS `vw_langgar_jenis`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_langgar_jenis` AS SELECT 
 1 AS `id_langgar_jenis`,
 1 AS `kode_langgar_jenis`,
 1 AS `langgar_jenis`,
 1 AS `stat_langgar_jenis`,
 1 AS `ket_langgar_jenis`,
 1 AS `durasi_langgar_jenis`,
 1 AS `jenis_durasi`,
 1 AS `tgl_buat`,
 1 AS `tgl_edit`,
 1 AS `id_user`,
 1 AS `nama_user`,
 1 AS `email_user`,
 1 AS `auth_langgar_jenis`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_level`
--

DROP TABLE IF EXISTS `vw_level`;
/*!50001 DROP VIEW IF EXISTS `vw_level`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_level` AS SELECT 
 1 AS `id_level`,
 1 AS `kd_level`,
 1 AS `level`,
 1 AS `ket_level`,
 1 AS `stat_level`,
 1 AS `tgl_buat`,
 1 AS `tgl_edit`,
 1 AS `id_user`,
 1 AS `auth_level`,
 1 AS `nama_user`,
 1 AS `email_user`,
 1 AS `id_perusahaan`,
 1 AS `id_parent`,
 1 AS `kode_perusahaan`,
 1 AS `nama_perusahaan`,
 1 AS `auth_perusahaan`,
 1 AS `auth_m_perusahaan`,
 1 AS `id_m_perusahaan`,
 1 AS `id_m_parent`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_lokker`
--

DROP TABLE IF EXISTS `vw_lokker`;
/*!50001 DROP VIEW IF EXISTS `vw_lokker`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_lokker` AS SELECT 
 1 AS `id_lokker`,
 1 AS `kd_lokker`,
 1 AS `lokker`,
 1 AS `ket_lokker`,
 1 AS `stat_lokker`,
 1 AS `tgl_buat`,
 1 AS `tgl_edit`,
 1 AS `id_user`,
 1 AS `auth_lokker`,
 1 AS `nama_user`,
 1 AS `email_user`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_lokterima`
--

DROP TABLE IF EXISTS `vw_lokterima`;
/*!50001 DROP VIEW IF EXISTS `vw_lokterima`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_lokterima` AS SELECT 
 1 AS `id_lokterima`,
 1 AS `kd_lokterima`,
 1 AS `lokterima`,
 1 AS `jenis_lokasi`,
 1 AS `ket_lokterima`,
 1 AS `stat_lokterima`,
 1 AS `tgl_buat`,
 1 AS `tgl_edit`,
 1 AS `id_user`,
 1 AS `auth_lokterima`,
 1 AS `nama_user`,
 1 AS `email_user`,
 1 AS `id_perusahaan`,
 1 AS `id_parent`,
 1 AS `kode_perusahaan`,
 1 AS `nama_perusahaan`,
 1 AS `auth_perusahaan`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_loktrm`
--

DROP TABLE IF EXISTS `vw_loktrm`;
/*!50001 DROP VIEW IF EXISTS `vw_loktrm`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_loktrm` AS SELECT 
 1 AS `id_lokterima`,
 1 AS `kd_lokterima`,
 1 AS `lokterima`,
 1 AS `ket_lokterima`,
 1 AS `stat_lokterima`,
 1 AS `tgl_buat`,
 1 AS `tgl_edit`,
 1 AS `id_user`,
 1 AS `auth_lokterima`,
 1 AS `nama_user`,
 1 AS `email_user`,
 1 AS `id_perusahaan`,
 1 AS `id_parent`,
 1 AS `kode_perusahaan`,
 1 AS `nama_perusahaan`,
 1 AS `auth_perusahaan`,
 1 AS `id_m_perusahaan`,
 1 AS `id_m_parent`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_lvl`
--

DROP TABLE IF EXISTS `vw_lvl`;
/*!50001 DROP VIEW IF EXISTS `vw_lvl`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_lvl` AS SELECT 
 1 AS `id_level`,
 1 AS `kd_level`,
 1 AS `level`,
 1 AS `ket_level`,
 1 AS `stat_level`,
 1 AS `tgl_buat`,
 1 AS `tgl_edit`,
 1 AS `id_user`,
 1 AS `auth_level`,
 1 AS `nama_user`,
 1 AS `email_user`,
 1 AS `id_perusahaan`,
 1 AS `id_parent`,
 1 AS `kode_perusahaan`,
 1 AS `nama_perusahaan`,
 1 AS `auth_perusahaan`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_m_per`
--

DROP TABLE IF EXISTS `vw_m_per`;
/*!50001 DROP VIEW IF EXISTS `vw_m_per`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_m_per` AS SELECT 
 1 AS `id_m_perusahaan`,
 1 AS `id_parent`,
 1 AS `id_perusahaan`,
 1 AS `nama_m_perusahaan`,
 1 AS `id_jenis_perusahaan`,
 1 AS `jenis_perusahaan`,
 1 AS `no_jenis_perusahaan`,
 1 AS `stat_m_perusahaan`,
 1 AS `tgl_buat`,
 1 AS `tgl_edit`,
 1 AS `id_user`,
 1 AS `kode_perusahaan`,
 1 AS `nama_perusahaan`,
 1 AS `auth_parent`,
 1 AS `auth_perusahaan`,
 1 AS `auth_m_perusahaan`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_m_perusahaan`
--

DROP TABLE IF EXISTS `vw_m_perusahaan`;
/*!50001 DROP VIEW IF EXISTS `vw_m_perusahaan`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_m_perusahaan` AS SELECT 
 1 AS `id_m_perusahaan`,
 1 AS `id_parent`,
 1 AS `id_perusahaan`,
 1 AS `nama_m_perusahaan`,
 1 AS `url_rk3l`,
 1 AS `id_jenis_perusahaan`,
 1 AS `jenis_perusahaan`,
 1 AS `no_jenis_perusahaan`,
 1 AS `stat_m_perusahaan`,
 1 AS `tgl_buat`,
 1 AS `tgl_edit`,
 1 AS `id_user`,
 1 AS `kode_perusahaan`,
 1 AS `nama_perusahaan`,
 1 AS `nama_user`,
 1 AS `email_user`,
 1 AS `auth_parent`,
 1 AS `auth_perusahaan`,
 1 AS `auth_m_perusahaan`,
 1 AS `id_izin_perusahaan`,
 1 AS `no_izin_perusahaan`,
 1 AS `tgl_mulai_izin`,
 1 AS `tgl_akhir_izin`,
 1 AS `url_izin_perusahaan`,
 1 AS `ket_izin_perusahaan`,
 1 AS `stat_perusahaan`,
 1 AS `kegiatan`,
 1 AS `ket_perusahaan`,
 1 AS `id_sio_perusahaan`,
 1 AS `no_sio_perusahaan`,
 1 AS `tgl_mulai_sio`,
 1 AS `tgl_akhir_sio`,
 1 AS `url_sio`,
 1 AS `ket_sio`,
 1 AS `id_kontrak_perusahaan`,
 1 AS `no_kontrak_perusahaan`,
 1 AS `tgl_mulai_kontrak`,
 1 AS `tgl_akhir_kontrak`,
 1 AS `ket_kontrak_perusahaan`,
 1 AS `url_doc_kontrak_perusahaan`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_m_prs`
--

DROP TABLE IF EXISTS `vw_m_prs`;
/*!50001 DROP VIEW IF EXISTS `vw_m_prs`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_m_prs` AS SELECT 
 1 AS `id_m_perusahaan`,
 1 AS `id_parent`,
 1 AS `id_perusahaan`,
 1 AS `nama_m_perusahaan`,
 1 AS `url_rk3l`,
 1 AS `id_jenis_perusahaan`,
 1 AS `jenis_perusahaan`,
 1 AS `no_jenis_perusahaan`,
 1 AS `stat_m_perusahaan`,
 1 AS `tgl_buat`,
 1 AS `tgl_edit`,
 1 AS `id_user`,
 1 AS `kode_perusahaan`,
 1 AS `nama_perusahaan`,
 1 AS `nama_user`,
 1 AS `email_user`,
 1 AS `auth_parent`,
 1 AS `auth_perusahaan`,
 1 AS `auth_m_perusahaan`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_mcu`
--

DROP TABLE IF EXISTS `vw_mcu`;
/*!50001 DROP VIEW IF EXISTS `vw_mcu`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_mcu` AS SELECT 
 1 AS `id_mcu`,
 1 AS `id_personal`,
 1 AS `no_ktp`,
 1 AS `no_kk`,
 1 AS `nama_lengkap`,
 1 AS `id_mcu_jenis`,
 1 AS `mcu_jenis`,
 1 AS `tgl_mcu`,
 1 AS `ket_mcu`,
 1 AS `url_file`,
 1 AS `tgl_buat`,
 1 AS `tgl_edit`,
 1 AS `id_user`,
 1 AS `nama_user`,
 1 AS `email_user`,
 1 AS `auth_personal`,
 1 AS `auth_mcu`,
 1 AS `id_m_perusahaan`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_menu`
--

DROP TABLE IF EXISTS `vw_menu`;
/*!50001 DROP VIEW IF EXISTS `vw_menu`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_menu` AS SELECT 
 1 AS `IdMenu`,
 1 AS `NamaMenu`,
 1 AS `StatMenu`,
 1 AS `tgl_buat`,
 1 AS `tgl_edit`,
 1 AS `id_user`,
 1 AS `auth_menu`,
 1 AS `nama_user`,
 1 AS `email_user`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_modul_role_menu`
--

DROP TABLE IF EXISTS `vw_modul_role_menu`;
/*!50001 DROP VIEW IF EXISTS `vw_modul_role_menu`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_modul_role_menu` AS SELECT 
 1 AS `id_modul_role_menu`,
 1 AS `id_menu`,
 1 AS `NamaMenu`,
 1 AS `StatMenu`,
 1 AS `BukaFile`,
 1 AS `id_modul_role`,
 1 AS `IdParent`,
 1 AS `NamaModule`,
 1 AS `UrlModule`,
 1 AS `LabelMenu`,
 1 AS `IconModule`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_pekerjaan`
--

DROP TABLE IF EXISTS `vw_pekerjaan`;
/*!50001 DROP VIEW IF EXISTS `vw_pekerjaan`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_pekerjaan` AS SELECT 
 1 AS `id_pekerjaan`,
 1 AS `id_depart`,
 1 AS `id_section`,
 1 AS `id_posisi`,
 1 AS `id_grade`,
 1 AS `id_level`,
 1 AS `kd_depart`,
 1 AS `depart`,
 1 AS `kd_section`,
 1 AS `section`,
 1 AS `posisi`,
 1 AS `grade`,
 1 AS `kd_level`,
 1 AS `level`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_personal`
--

DROP TABLE IF EXISTS `vw_personal`;
/*!50001 DROP VIEW IF EXISTS `vw_personal`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_personal` AS SELECT 
 1 AS `id_personal`,
 1 AS `no_ktp`,
 1 AS `no_kk`,
 1 AS `nama_lengkap`,
 1 AS `nama_alias`,
 1 AS `jk`,
 1 AS `tmp_lahir`,
 1 AS `tgl_lahir`,
 1 AS `id_stat_nikah`,
 1 AS `kode_stat_nikah`,
 1 AS `stat_nikah`,
 1 AS `id_agama`,
 1 AS `agama`,
 1 AS `warga_negara`,
 1 AS `email_pribadi`,
 1 AS `hp_1`,
 1 AS `hp_2`,
 1 AS `nama_ibu`,
 1 AS `stat_ibu`,
 1 AS `nama_ayah`,
 1 AS `stat_ayah`,
 1 AS `no_bpjstk`,
 1 AS `no_bpjskes`,
 1 AS `no_bpjspensiun`,
 1 AS `no_equity`,
 1 AS `no_npwp`,
 1 AS `tgl_buat`,
 1 AS `tgl_edit`,
 1 AS `id_user`,
 1 AS `id_ec`,
 1 AS `nama_ec`,
 1 AS `hp_ec`,
 1 AS `hp_ec_2`,
 1 AS `relasi_ec`,
 1 AS `ket_ec`,
 1 AS `stat_ec`,
 1 AS `id_alamat_ktp`,
 1 AS `rt_ktp`,
 1 AS `rw_ktp`,
 1 AS `kel_ktp`,
 1 AS `kec_ktp`,
 1 AS `kab_ktp`,
 1 AS `prov_ktp`,
 1 AS `stat_alamat_ktp`,
 1 AS `auth_personal`,
 1 AS `url_pendukung`,
 1 AS `usia`,
 1 AS `id_pendidikan`,
 1 AS `nama_sekolah`,
 1 AS `fakultas`,
 1 AS `jurusan`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_perusahaan`
--

DROP TABLE IF EXISTS `vw_perusahaan`;
/*!50001 DROP VIEW IF EXISTS `vw_perusahaan`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_perusahaan` AS SELECT 
 1 AS `id_perusahaan`,
 1 AS `kode_perusahaan`,
 1 AS `nama_perusahaan`,
 1 AS `alamat_perusahaan`,
 1 AS `kel_perusahaan`,
 1 AS `kec_perusahaan`,
 1 AS `kab_perusahaan`,
 1 AS `prov_perusahaan`,
 1 AS `kodepos_perusahaan`,
 1 AS `telp_perusahaan`,
 1 AS `email_perusahaan`,
 1 AS `website_perusahaan`,
 1 AS `npwp_perusahaan`,
 1 AS `ket_perusahaan`,
 1 AS `stat_perusahaan`,
 1 AS `kegiatan`,
 1 AS `tgl_buat`,
 1 AS `tgl_edit`,
 1 AS `id_user`,
 1 AS `auth_perusahaan`,
 1 AS `nama_user`,
 1 AS `email_user`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_pjo_perusahaan`
--

DROP TABLE IF EXISTS `vw_pjo_perusahaan`;
/*!50001 DROP VIEW IF EXISTS `vw_pjo_perusahaan`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_pjo_perusahaan` AS SELECT 
 1 AS `id_pjo_perusahaan`,
 1 AS `id_m_perusahaan`,
 1 AS `no_pengesahan_pjo`,
 1 AS `id_perusahaan`,
 1 AS `nama_m_perusahaan`,
 1 AS `jenis_perusahaan`,
 1 AS `kode_perusahaan`,
 1 AS `nama_perusahaan`,
 1 AS `id_lokasi`,
 1 AS `tgl_aktif_pjo`,
 1 AS `tgl_akhir_pjo`,
 1 AS `url_pengesahan_pjo`,
 1 AS `id_karyawan`,
 1 AS `id_personal`,
 1 AS `no_nik`,
 1 AS `nama_lengkap`,
 1 AS `no_ktp`,
 1 AS `tgl_buat`,
 1 AS `tgl_edit`,
 1 AS `id_user`,
 1 AS `auth_pjo_perusahaan`,
 1 AS `auth_perusahaan`,
 1 AS `auth_m_perusahaan`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_poh`
--

DROP TABLE IF EXISTS `vw_poh`;
/*!50001 DROP VIEW IF EXISTS `vw_poh`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_poh` AS SELECT 
 1 AS `id_poh`,
 1 AS `kd_poh`,
 1 AS `poh`,
 1 AS `ket_poh`,
 1 AS `stat_poh`,
 1 AS `tgl_buat`,
 1 AS `tgl_edit`,
 1 AS `id_user`,
 1 AS `auth_poh`,
 1 AS `nama_user`,
 1 AS `email_user`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_posisi`
--

DROP TABLE IF EXISTS `vw_posisi`;
/*!50001 DROP VIEW IF EXISTS `vw_posisi`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_posisi` AS SELECT 
 1 AS `id_posisi`,
 1 AS `posisi`,
 1 AS `ket_posisi`,
 1 AS `stat_posisi`,
 1 AS `tgl_buat`,
 1 AS `tgl_edit`,
 1 AS `id_user`,
 1 AS `id_depart`,
 1 AS `kd_depart`,
 1 AS `depart`,
 1 AS `auth_posisi`,
 1 AS `nama_user`,
 1 AS `email_user`,
 1 AS `id_perusahaan`,
 1 AS `id_parent`,
 1 AS `kode_perusahaan`,
 1 AS `nama_perusahaan`,
 1 AS `auth_depart`,
 1 AS `auth_perusahaan`,
 1 AS `id_m_perusahaan`,
 1 AS `id_m_parent`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_prs_all`
--

DROP TABLE IF EXISTS `vw_prs_all`;
/*!50001 DROP VIEW IF EXISTS `vw_prs_all`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_prs_all` AS SELECT 
 1 AS `id_perusahaan`,
 1 AS `kode_perusahaan`,
 1 AS `nama_perusahaan`,
 1 AS `alamat_perusahaan`,
 1 AS `kel_perusahaan`,
 1 AS `kec_perusahaan`,
 1 AS `kab_perusahaan`,
 1 AS `prov_perusahaan`,
 1 AS `kodepos_perusahaan`,
 1 AS `telp_perusahaan`,
 1 AS `email_perusahaan`,
 1 AS `website_perusahaan`,
 1 AS `npwp_perusahaan`,
 1 AS `ket_perusahaan`,
 1 AS `stat_perusahaan`,
 1 AS `kegiatan`,
 1 AS `tgl_buat`,
 1 AS `tgl_edit`,
 1 AS `id_user`,
 1 AS `auth_perusahaan`,
 1 AS `nama_user`,
 1 AS `email_user`,
 1 AS `prov`,
 1 AS `kab`,
 1 AS `kec`,
 1 AS `kel`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_pss`
--

DROP TABLE IF EXISTS `vw_pss`;
/*!50001 DROP VIEW IF EXISTS `vw_pss`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_pss` AS SELECT 
 1 AS `id_posisi`,
 1 AS `posisi`,
 1 AS `ket_posisi`,
 1 AS `stat_posisi`,
 1 AS `tgl_buat`,
 1 AS `tgl_edit`,
 1 AS `id_user`,
 1 AS `id_depart`,
 1 AS `kd_depart`,
 1 AS `depart`,
 1 AS `auth_posisi`,
 1 AS `nama_user`,
 1 AS `email_user`,
 1 AS `id_perusahaan`,
 1 AS `id_parent`,
 1 AS `kode_perusahaan`,
 1 AS `nama_perusahaan`,
 1 AS `auth_depart`,
 1 AS `auth_perusahaan`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_roster`
--

DROP TABLE IF EXISTS `vw_roster`;
/*!50001 DROP VIEW IF EXISTS `vw_roster`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_roster` AS SELECT 
 1 AS `id_roster`,
 1 AS `kd_roster`,
 1 AS `roster`,
 1 AS `jml_hari_onsite`,
 1 AS `jml_hari_offsite`,
 1 AS `ket_roster`,
 1 AS `stat_roster`,
 1 AS `tgl_buat`,
 1 AS `tgl_edit`,
 1 AS `id_user`,
 1 AS `auth_roster`,
 1 AS `nama_user`,
 1 AS `email_user`,
 1 AS `id_perusahaan`,
 1 AS `id_parent`,
 1 AS `kode_perusahaan`,
 1 AS `nama_perusahaan`,
 1 AS `auth_perusahaan`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_sanksi`
--

DROP TABLE IF EXISTS `vw_sanksi`;
/*!50001 DROP VIEW IF EXISTS `vw_sanksi`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_sanksi` AS SELECT 
 1 AS `id_sanksi`,
 1 AS `kd_sanksi`,
 1 AS `sanksi`,
 1 AS `jml_hari_berlaku`,
 1 AS `ket_sanksi`,
 1 AS `stat_sanksi`,
 1 AS `tgl_buat`,
 1 AS `tgl_edit`,
 1 AS `id_user`,
 1 AS `auth_sanksi`,
 1 AS `nama_user`,
 1 AS `email_user`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_section`
--

DROP TABLE IF EXISTS `vw_section`;
/*!50001 DROP VIEW IF EXISTS `vw_section`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_section` AS SELECT 
 1 AS `id_section`,
 1 AS `kd_section`,
 1 AS `section`,
 1 AS `ket_section`,
 1 AS `stat_section`,
 1 AS `tgl_buat`,
 1 AS `tgl_edit`,
 1 AS `id_user`,
 1 AS `id_depart`,
 1 AS `kd_depart`,
 1 AS `depart`,
 1 AS `auth_section`,
 1 AS `nama_user`,
 1 AS `email_user`,
 1 AS `id_perusahaan`,
 1 AS `id_parent`,
 1 AS `kode_perusahaan`,
 1 AS `nama_perusahaan`,
 1 AS `auth_depart`,
 1 AS `auth_perusahaan`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_sertifikasi`
--

DROP TABLE IF EXISTS `vw_sertifikasi`;
/*!50001 DROP VIEW IF EXISTS `vw_sertifikasi`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_sertifikasi` AS SELECT 
 1 AS `id_sertifikasi`,
 1 AS `id_personal`,
 1 AS `no_ktp`,
 1 AS `no_kk`,
 1 AS `jk`,
 1 AS `tmp_lahir`,
 1 AS `tgl_lahir`,
 1 AS `id_jenis_sertifikasi`,
 1 AS `kode_jenis_sertifikasi`,
 1 AS `jenis_sertifikasi`,
 1 AS `no_sertifikasi`,
 1 AS `lembaga`,
 1 AS `tgl_sertifikasi`,
 1 AS `tgl_berakhir_sertifikasi`,
 1 AS `file_sertifikasi`,
 1 AS `tgl_buat`,
 1 AS `tgl_edit`,
 1 AS `id_user`,
 1 AS `auth_sertifikat`,
 1 AS `auth_personal`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_sim`
--

DROP TABLE IF EXISTS `vw_sim`;
/*!50001 DROP VIEW IF EXISTS `vw_sim`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_sim` AS SELECT 
 1 AS `id_sim`,
 1 AS `sim`,
 1 AS `stat_sim`,
 1 AS `ket_sim`,
 1 AS `tgl_buat`,
 1 AS `tgl_edit`,
 1 AS `id_user`,
 1 AS `auth_sim`,
 1 AS `nama_user`,
 1 AS `email_user`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_sim_karyawan`
--

DROP TABLE IF EXISTS `vw_sim_karyawan`;
/*!50001 DROP VIEW IF EXISTS `vw_sim_karyawan`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_sim_karyawan` AS SELECT 
 1 AS `id_sim_kary`,
 1 AS `id_personal`,
 1 AS `id_karyawan`,
 1 AS `no_ktp`,
 1 AS `nama_lengkap`,
 1 AS `tmp_lahir`,
 1 AS `tgl_lahir`,
 1 AS `id_sim`,
 1 AS `tgl_exp_sim`,
 1 AS `ket_sim_kary`,
 1 AS `url_file`,
 1 AS `tgl_buat`,
 1 AS `tgl_edit`,
 1 AS `id_user`,
 1 AS `sim`,
 1 AS `auth_sim_kary`,
 1 AS `auth_personal`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_sio_perusahaan`
--

DROP TABLE IF EXISTS `vw_sio_perusahaan`;
/*!50001 DROP VIEW IF EXISTS `vw_sio_perusahaan`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_sio_perusahaan` AS SELECT 
 1 AS `id_sio_perusahaan`,
 1 AS `id_m_perusahaan`,
 1 AS `no_sio_perusahaan`,
 1 AS `tgl_mulai_sio`,
 1 AS `tgl_akhir_sio`,
 1 AS `url_sio`,
 1 AS `ket_sio`,
 1 AS `tgl_buat`,
 1 AS `tgl_edit`,
 1 AS `id_user`,
 1 AS `auth_sio_perusahaan`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_stat_perjanjian`
--

DROP TABLE IF EXISTS `vw_stat_perjanjian`;
/*!50001 DROP VIEW IF EXISTS `vw_stat_perjanjian`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_stat_perjanjian` AS SELECT 
 1 AS `id_stat_perjanjian`,
 1 AS `stat_perjanjian`,
 1 AS `ket_stat_perjanjian`,
 1 AS `stat_stat_perjanjian`,
 1 AS `stat_waktu`,
 1 AS `tgl_buat`,
 1 AS `tgl_edit`,
 1 AS `id_user`,
 1 AS `auth_stat_perjanjian`,
 1 AS `nama_user`,
 1 AS `email_user`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_tipe`
--

DROP TABLE IF EXISTS `vw_tipe`;
/*!50001 DROP VIEW IF EXISTS `vw_tipe`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_tipe` AS SELECT 
 1 AS `id_tipe`,
 1 AS `tipe`,
 1 AS `ket_tipe`,
 1 AS `stat_tipe`,
 1 AS `tgl_buat`,
 1 AS `tgl_edit`,
 1 AS `id_user`,
 1 AS `auth_tipe`,
 1 AS `nama_user`,
 1 AS `email_user`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_unit`
--

DROP TABLE IF EXISTS `vw_unit`;
/*!50001 DROP VIEW IF EXISTS `vw_unit`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_unit` AS SELECT 
 1 AS `id_unit`,
 1 AS `kode_unit`,
 1 AS `unit`,
 1 AS `stat_unit`,
 1 AS `ket_unit`,
 1 AS `tgl_buat`,
 1 AS `tgl_edit`,
 1 AS `id_user`,
 1 AS `auth_unit`,
 1 AS `nama_user`,
 1 AS `email_user`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_user`
--

DROP TABLE IF EXISTS `vw_user`;
/*!50001 DROP VIEW IF EXISTS `vw_user`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_user` AS SELECT 
 1 AS `id_user`,
 1 AS `nama_user`,
 1 AS `email_user`,
 1 AS `tgl_aktif`,
 1 AS `tgl_exp`,
 1 AS `sesi`,
 1 AS `id_menu`,
 1 AS `NamaMenu`,
 1 AS `akses_apps`,
 1 AS `stat_user`,
 1 AS `pic_user`,
 1 AS `tgl_buat`,
 1 AS `tgl_edit`,
 1 AS `id_buat`,
 1 AS `auth_user`,
 1 AS `id_m_perusahaan`,
 1 AS `id_parent`,
 1 AS `id_perusahaan`,
 1 AS `jenis_perusahaan`,
 1 AS `no_jenis_perusahaan`,
 1 AS `kode_perusahaan`,
 1 AS `nama_perusahaan`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_vaksin_kary`
--

DROP TABLE IF EXISTS `vw_vaksin_kary`;
/*!50001 DROP VIEW IF EXISTS `vw_vaksin_kary`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_vaksin_kary` AS SELECT 
 1 AS `id_kary`,
 1 AS `id_personal`,
 1 AS `no_acr`,
 1 AS `no_nik`,
 1 AS `no_ktp`,
 1 AS `no_kk`,
 1 AS `nama_lengkap`,
 1 AS `nama_alias`,
 1 AS `depart`,
 1 AS `section`,
 1 AS `posisi`,
 1 AS `level`,
 1 AS `tipe`,
 1 AS `stat_tinggal`,
 1 AS `id_vaksin_jenis`,
 1 AS `vaksin_jenis`,
 1 AS `id_vaksin`,
 1 AS `tgl_vaksin`,
 1 AS `id_vaksin_nama`,
 1 AS `vaksin_nama`,
 1 AS `tgl_buat`,
 1 AS `tgl_edit`,
 1 AS `id_user`,
 1 AS `nama_user`,
 1 AS `email_user`,
 1 AS `auth_personal`,
 1 AS `auth_vaksin`*/;
SET character_set_client = @saved_cs_client;

--
-- Dumping routines for database 'db_kary'
--

--
-- Final view structure for view `vw_alasan_nonaktif`
--

/*!50001 DROP VIEW IF EXISTS `vw_alasan_nonaktif`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_alasan_nonaktif` AS select 1 AS `id_alasan_nonaktif`,1 AS `alasan_nonaktif`,1 AS `ket_alasan_nonaktif`,1 AS `stat_alasan_nonaktif`,1 AS `stat_upload_berkas`,1 AS `tgl_buat`,1 AS `tgl_edit`,1 AS `auth_alasan_nonaktif`,1 AS `id_user`,1 AS `nama_user`,1 AS `email_user` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_audit`
--

/*!50001 DROP VIEW IF EXISTS `vw_audit`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_audit` AS select 1 AS `id_audit`,1 AS `id_user`,1 AS `jenis_proses`,1 AS `data_proses`,1 AS `nama_data`,1 AS `tgl_edit`,1 AS `tgl_buat`,1 AS `nama_user`,1 AS `email_user` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_bank`
--

/*!50001 DROP VIEW IF EXISTS `vw_bank`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_bank` AS select 1 AS `id_bank`,1 AS `bank`,1 AS `ket_bank`,1 AS `stat_bank`,1 AS `tgl_buat`,1 AS `tgl_edit`,1 AS `id_user`,1 AS `auth_bank`,1 AS `nama_user`,1 AS `email_user` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_bank_kary`
--

/*!50001 DROP VIEW IF EXISTS `vw_bank_kary`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_bank_kary` AS select 1 AS `id_bank_kary`,1 AS `id_personal`,1 AS `id_bank`,1 AS `bank`,1 AS `no_rek`,1 AS `nama_pemilik`,1 AS `stat_bank_kary`,1 AS `ket_bank_kary`,1 AS `tgl_buat`,1 AS `tgl_edit`,1 AS `id_user`,1 AS `auth_personal`,1 AS `auth_bank_kary`,1 AS `nama_user`,1 AS `email_user` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_depart`
--

/*!50001 DROP VIEW IF EXISTS `vw_depart`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_depart` AS select 1 AS `id_depart`,1 AS `kd_depart`,1 AS `depart`,1 AS `ket_depart`,1 AS `stat_depart`,1 AS `tgl_buat`,1 AS `tgl_edit`,1 AS `id_user`,1 AS `auth_depart`,1 AS `nama_user`,1 AS `email_user`,1 AS `id_perusahaan`,1 AS `id_parent`,1 AS `kode_perusahaan`,1 AS `nama_perusahaan`,1 AS `auth_perusahaan`,1 AS `id_m_perusahaan`,1 AS `id_m_parent` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_dprt`
--

/*!50001 DROP VIEW IF EXISTS `vw_dprt`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_dprt` AS select 1 AS `id_depart`,1 AS `kd_depart`,1 AS `depart`,1 AS `ket_depart`,1 AS `stat_depart`,1 AS `tgl_buat`,1 AS `tgl_edit`,1 AS `id_user`,1 AS `auth_depart`,1 AS `nama_user`,1 AS `email_user`,1 AS `id_perusahaan`,1 AS `id_parent`,1 AS `kode_perusahaan`,1 AS `nama_perusahaan`,1 AS `auth_perusahaan` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_ec`
--

/*!50001 DROP VIEW IF EXISTS `vw_ec`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_ec` AS select 1 AS `id_ec`,1 AS `id_personal`,1 AS `nama_ec`,1 AS `hp_ec`,1 AS `hp_ec_2`,1 AS `relasi_ec`,1 AS `stat_ec`,1 AS `ket_ec`,1 AS `tgl_buat`,1 AS `tgl_edit`,1 AS `id_user`,1 AS `auth_personal`,1 AS `auth_ec`,1 AS `nama_user`,1 AS `email_user` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_grade`
--

/*!50001 DROP VIEW IF EXISTS `vw_grade`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_grade` AS select 1 AS `id_grade`,1 AS `grade`,1 AS `ket_grade`,1 AS `stat_grade`,1 AS `tgl_buat`,1 AS `tgl_edit`,1 AS `id_user`,1 AS `id_level`,1 AS `kd_level`,1 AS `level`,1 AS `auth_grade`,1 AS `nama_user`,1 AS `email_user`,1 AS `id_perusahaan`,1 AS `id_parent`,1 AS `kode_perusahaan`,1 AS `nama_perusahaan`,1 AS `auth_level`,1 AS `auth_perusahaan`,1 AS `id_m_perusahaan`,1 AS `id_m_parent` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_grd`
--

/*!50001 DROP VIEW IF EXISTS `vw_grd`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_grd` AS select 1 AS `id_grade`,1 AS `grade`,1 AS `ket_grade`,1 AS `stat_grade`,1 AS `tgl_buat`,1 AS `tgl_edit`,1 AS `id_user`,1 AS `id_level`,1 AS `kd_level`,1 AS `level`,1 AS `auth_grade`,1 AS `nama_user`,1 AS `email_user`,1 AS `id_perusahaan`,1 AS `id_parent`,1 AS `kode_perusahaan`,1 AS `nama_perusahaan`,1 AS `auth_level`,1 AS `auth_perusahaan` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_ip_blacklist`
--

/*!50001 DROP VIEW IF EXISTS `vw_ip_blacklist`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_ip_blacklist` AS select 1 AS `id_ip_blacklist`,1 AS `ip_address`,1 AS `back_log`,1 AS `tgl_buat`,1 AS `email_user`,1 AS `auth_email_user` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_izin_perusahaan`
--

/*!50001 DROP VIEW IF EXISTS `vw_izin_perusahaan`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_izin_perusahaan` AS select 1 AS `id_izin_perusahaan`,1 AS `id_m_perusahaan`,1 AS `no_izin_perusahaan`,1 AS `tgl_mulai_izin`,1 AS `tgl_akhir_izin`,1 AS `url_izin_perusahaan`,1 AS `ket_izin_perusahaan`,1 AS `tgl_buat`,1 AS `tgl_edit`,1 AS `id_user`,1 AS `auth_izin_perusahaan`,1 AS `auth_m_perusahaan` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_izin_tambang`
--

/*!50001 DROP VIEW IF EXISTS `vw_izin_tambang`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_izin_tambang` AS select 1 AS `id_izin_tambang`,1 AS `id_kary`,1 AS `id_personal`,1 AS `no_acr`,1 AS `no_nik`,1 AS `nama_lengkap`,1 AS `id_depart`,1 AS `kd_depart`,1 AS `depart`,1 AS `id_posisi`,1 AS `posisi`,1 AS `id_jenis_izin_tambang`,1 AS `jenis_izin_tambang`,1 AS `no_reg`,1 AS `tgl_expired`,1 AS `url_izin_tambang`,1 AS `id_m_perusahaan`,1 AS `stat_izin_tambang`,1 AS `ket_izin_tambang`,1 AS `id_sim_kary`,1 AS `id_sim`,1 AS `sim`,1 AS `tgl_exp_sim`,1 AS `tgl_buat`,1 AS `tgl_edit`,1 AS `id_user`,1 AS `auth_karyawan`,1 AS `auth_izin_tambang`,1 AS `nama_user`,1 AS `email_user` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_izin_unit`
--

/*!50001 DROP VIEW IF EXISTS `vw_izin_unit`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_izin_unit` AS select 1 AS `id_izin_tambang`,1 AS `id_kary`,1 AS `id_personal`,1 AS `no_acr`,1 AS `no_nik`,1 AS `id_depart`,1 AS `kd_depart`,1 AS `depart`,1 AS `id_posisi`,1 AS `posisi`,1 AS `no_reg`,1 AS `tgl_expired`,1 AS `ket_izin_tambang`,1 AS `id_izin_tambang_unit`,1 AS `id_unit`,1 AS `kode_unit`,1 AS `unit`,1 AS `id_tipe_akses_unit`,1 AS `kode_tipe_akses_unit`,1 AS `tipe_akses_unit`,1 AS `auth_karyawan`,1 AS `auth_izin_tambang`,1 AS `nama_user`,1 AS `email_user`,1 AS `id_perusahaan`,1 AS `kode_perusahaan`,1 AS `nama_perusahaan` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_jenis_sertifikasi`
--

/*!50001 DROP VIEW IF EXISTS `vw_jenis_sertifikasi`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_jenis_sertifikasi` AS select 1 AS `id_jenis_sertifikasi`,1 AS `kode_jenis_sertifikasi`,1 AS `jenis_sertifikasi`,1 AS `beranda`,1 AS `ket_jenis_sertifikasi`,1 AS `stat_jenis_sertifikasi`,1 AS `tgl_buat`,1 AS `tgl_edit`,1 AS `id_user`,1 AS `auth_jenis_sertifikasi`,1 AS `nama_user`,1 AS `email_user` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_jml_karyawan`
--

/*!50001 DROP VIEW IF EXISTS `vw_jml_karyawan`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_jml_karyawan` AS select 1 AS `id_kary`,1 AS `no_acr`,1 AS `doh`,1 AS `bulan_now`,1 AS `tahun_now`,1 AS `bulan_doh`,1 AS `tahun_doh`,1 AS `id_m_perusahaan`,1 AS `id_parent`,1 AS `id_perusahaan`,1 AS `kode_perusahaan`,1 AS `nama_perusahaan`,1 AS `tgl_nonaktif`,1 AS `tgl_buat`,1 AS `stat_m_perusahaan`,1 AS `id_lokterima`,1 AS `jenis_lokasi` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_karyawan`
--

/*!50001 DROP VIEW IF EXISTS `vw_karyawan`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_karyawan` AS select 1 AS `id_kary`,1 AS `id_personal`,1 AS `id_perkerjaan`,1 AS `no_acr`,1 AS `no_nik`,1 AS `doh`,1 AS `tgl_aktif`,1 AS `id_lokker`,1 AS `id_lokterima`,1 AS `id_level`,1 AS `id_poh`,1 AS `id_roster`,1 AS `id_klasifikasi`,1 AS `klasifikasi`,1 AS `paybase`,1 AS `statpajak`,1 AS `id_tipe`,1 AS `id_stat_tinggal`,1 AS `tgl_permanen`,1 AS `tgl_nonaktif`,1 AS `tgl_buat`,1 AS `tgl_edit`,1 AS `id_user`,1 AS `id_m_perusahaan`,1 AS `no_ktp`,1 AS `no_kk`,1 AS `nama_lengkap`,1 AS `nama_alias`,1 AS `jk`,1 AS `tmp_lahir`,1 AS `tgl_lahir`,1 AS `id_stat_nikah`,1 AS `kode_stat_nikah`,1 AS `stat_nikah`,1 AS `id_agama`,1 AS `warga_negara`,1 AS `email_pribadi`,1 AS `hp_1`,1 AS `nama_ibu`,1 AS `stat_ibu`,1 AS `nama_ayah`,1 AS `stat_ayah`,1 AS `no_bpjstk`,1 AS `no_bpjskes`,1 AS `no_bpjspensiun`,1 AS `no_equity`,1 AS `no_npwp`,1 AS `id_pendidikan`,1 AS `nama_sekolah`,1 AS `fakultas`,1 AS `jurusan`,1 AS `id_depart`,1 AS `id_section`,1 AS `id_posisi`,1 AS `id_grade`,1 AS `kd_depart`,1 AS `depart`,1 AS `kd_section`,1 AS `section`,1 AS `posisi`,1 AS `grade`,1 AS `kd_level`,1 AS `level`,1 AS `kd_lokker`,1 AS `lokker`,1 AS `kd_lokterima`,1 AS `lokterima`,1 AS `kd_poh`,1 AS `poh`,1 AS `kd_roster`,1 AS `roster`,1 AS `tipe`,1 AS `auth_personal`,1 AS `auth_karyawan`,1 AS `auth_perusahaan`,1 AS `auth_m_perusahaan`,1 AS `id_parent`,1 AS `id_perusahaan`,1 AS `email_kantor`,1 AS `agama`,1 AS `nama_m_perusahaan`,1 AS `stat_m_perusahaan`,1 AS `kode_perusahaan`,1 AS `nama_perusahaan`,1 AS `url_pendukung`,1 AS `usia`,1 AS `lama_bekerja`,1 AS `jenis_lokasi`,1 AS `stat_tinggal`,1 AS `url_foto` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_karyawan_nonaktif`
--

/*!50001 DROP VIEW IF EXISTS `vw_karyawan_nonaktif`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_karyawan_nonaktif` AS select 1 AS `id_kary_nonaktif`,1 AS `id_kary`,1 AS `no_ktp`,1 AS `no_nik`,1 AS `nama_lengkap`,1 AS `depart`,1 AS `posisi`,1 AS `tgl_nonaktif`,1 AS `id_alasan_nonaktif`,1 AS `alasan_nonaktif`,1 AS `ket_nonaktif`,1 AS `url_berkas_nonaktif`,1 AS `tgl_buat`,1 AS `tgl_edit`,1 AS `id_user`,1 AS `nama_user`,1 AS `email_user`,1 AS `auth_kary_nonaktif`,1 AS `id_perusahaan`,1 AS `id_m_perusahaan`,1 AS `auth_karyawan`,1 AS `auth_m_perusahaan`,1 AS `auth_perusahaan`,1 AS `nama_m_perusahaan`,1 AS `kode_perusahaan`,1 AS `nama_perusahaan` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_karyawan_sertifikasi`
--

/*!50001 DROP VIEW IF EXISTS `vw_karyawan_sertifikasi`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_karyawan_sertifikasi` AS select 1 AS `id_kary`,1 AS `id_personal`,1 AS `no_acr`,1 AS `no_nik`,1 AS `id_depart`,1 AS `id_posisi`,1 AS `id_level`,1 AS `kd_depart`,1 AS `depart`,1 AS `posisi`,1 AS `kd_level`,1 AS `level`,1 AS `tgl_nonaktif`,1 AS `id_jenis_sertifikasi`,1 AS `no_sertifikasi`,1 AS `tgl_sertifikasi`,1 AS `tgl_berakhir_sertifikasi`,1 AS `file_sertifikasi`,1 AS `kode_jenis_sertifikasi`,1 AS `jenis_sertifikasi`,1 AS `beranda` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_karyawan_terbaru`
--

/*!50001 DROP VIEW IF EXISTS `vw_karyawan_terbaru`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_karyawan_terbaru` AS select 1 AS `id_kary`,1 AS `id_personal`,1 AS `no_ktp`,1 AS `no_nik`,1 AS `nama_lengkap`,1 AS `id_depart`,1 AS `kd_depart`,1 AS `depart`,1 AS `tgl_buat`,1 AS `id_user`,1 AS `nama_user`,1 AS `email_user`,1 AS `id_m_perusahaan`,1 AS `id_perusahaan`,1 AS `id_parent`,1 AS `kode_perusahaan`,1 AS `nama_perusahaan` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_klasifikasi`
--

/*!50001 DROP VIEW IF EXISTS `vw_klasifikasi`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_klasifikasi` AS select 1 AS `id_klasifikasi`,1 AS `klasifikasi`,1 AS `ket_klasifikasi`,1 AS `stat_klasifikasi`,1 AS `tgl_buat`,1 AS `tgl_edit`,1 AS `id_user`,1 AS `nama_user`,1 AS `email_user` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_kontrak_karyawan`
--

/*!50001 DROP VIEW IF EXISTS `vw_kontrak_karyawan`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_kontrak_karyawan` AS select 1 AS `id_kontrak_kary`,1 AS `id_kary`,1 AS `id_stat_perjanjian`,1 AS `stat_perjanjian`,1 AS `stat_waktu`,1 AS `tgl_mulai`,1 AS `tgl_akhir`,1 AS `ket_kontrak`,1 AS `tgl_buat`,1 AS `tgl_edit`,1 AS `id_user`,1 AS `no_acr`,1 AS `no_nik`,1 AS `depart`,1 AS `posisi`,1 AS `nama_user`,1 AS `email_user`,1 AS `id_perusahaan`,1 AS `id_m_perusahaan`,1 AS `nama_m_perusahaan`,1 AS `nama_perusahaan`,1 AS `kode_perusahaan`,1 AS `auth_karyawan`,1 AS `auth_kontrak_kary`,1 AS `auth_perusahaan`,1 AS `auth_m_perusahaan` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_kontrak_perusahaan`
--

/*!50001 DROP VIEW IF EXISTS `vw_kontrak_perusahaan`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_kontrak_perusahaan` AS select 1 AS `id_kontrak_perusahaan`,1 AS `id_m_perusahaan`,1 AS `no_kontrak_perusahaan`,1 AS `tgl_mulai_kontrak`,1 AS `tgl_akhir_kontrak`,1 AS `url_doc_kontrak_perusahaan`,1 AS `ket_kontrak_perusahaan`,1 AS `tgl_buat`,1 AS `tgl_edit`,1 AS `id_user`,1 AS `auth_kontrak_perusahaan` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_kry`
--

/*!50001 DROP VIEW IF EXISTS `vw_kry`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_kry` AS select 1 AS `id_kary`,1 AS `id_personal`,1 AS `no_acr`,1 AS `no_nik`,1 AS `id_m_perusahaan`,1 AS `no_ktp`,1 AS `no_kk`,1 AS `nama_lengkap`,1 AS `nama_alias`,1 AS `jk`,1 AS `id_depart`,1 AS `id_posisi`,1 AS `kd_depart`,1 AS `depart`,1 AS `posisi`,1 AS `auth_personal`,1 AS `auth_karyawan`,1 AS `auth_perusahaan`,1 AS `auth_m_perusahaan`,1 AS `id_perusahaan`,1 AS `nama_m_perusahaan`,1 AS `kode_perusahaan`,1 AS `nama_perusahaan`,1 AS `url_pendukung`,1 AS `tgl_nonaktif`,1 AS `tgl_buat` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_ktp`
--

/*!50001 DROP VIEW IF EXISTS `vw_ktp`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_ktp` AS select 1 AS `id_ktp`,1 AS `id_personal`,1 AS `no_ktp`,1 AS `nama_lengkap`,1 AS `url_ktp`,1 AS `stat_ktp`,1 AS `tgl_buat`,1 AS `tgl_edit`,1 AS `id_user`,1 AS `auth_personal` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_langgar`
--

/*!50001 DROP VIEW IF EXISTS `vw_langgar`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_langgar` AS select 1 AS `id_langgar`,1 AS `id_kary`,1 AS `id_personal`,1 AS `no_acr`,1 AS `no_ktp`,1 AS `no_nik`,1 AS `nama_lengkap`,1 AS `doh`,1 AS `tgl_aktif`,1 AS `depart`,1 AS `section`,1 AS `posisi`,1 AS `poh`,1 AS `level`,1 AS `tipe`,1 AS `tgl_langgar`,1 AS `tgl_punishment`,1 AS `id_langgar_jenis`,1 AS `kode_langgar_jenis`,1 AS `langgar_jenis`,1 AS `durasi_langgar_jenis`,1 AS `jenis_durasi`,1 AS `url_langgar`,1 AS `ket_langgar`,1 AS `tgl_akhir_langgar`,1 AS `tgl_buat`,1 AS `tgl_edit`,1 AS `id_user`,1 AS `id_m_perusahaan`,1 AS `kode_perusahaan`,1 AS `nama_m_perusahaan`,1 AS `auth_kary`,1 AS `auth_personal`,1 AS `auth_m_per`,1 AS `nama_user`,1 AS `email_user`,1 AS `auth_langgar`,1 AS `auth_langgar_jenis` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_langgar_jenis`
--

/*!50001 DROP VIEW IF EXISTS `vw_langgar_jenis`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_langgar_jenis` AS select 1 AS `id_langgar_jenis`,1 AS `kode_langgar_jenis`,1 AS `langgar_jenis`,1 AS `stat_langgar_jenis`,1 AS `ket_langgar_jenis`,1 AS `durasi_langgar_jenis`,1 AS `jenis_durasi`,1 AS `tgl_buat`,1 AS `tgl_edit`,1 AS `id_user`,1 AS `nama_user`,1 AS `email_user`,1 AS `auth_langgar_jenis` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_level`
--

/*!50001 DROP VIEW IF EXISTS `vw_level`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_level` AS select 1 AS `id_level`,1 AS `kd_level`,1 AS `level`,1 AS `ket_level`,1 AS `stat_level`,1 AS `tgl_buat`,1 AS `tgl_edit`,1 AS `id_user`,1 AS `auth_level`,1 AS `nama_user`,1 AS `email_user`,1 AS `id_perusahaan`,1 AS `id_parent`,1 AS `kode_perusahaan`,1 AS `nama_perusahaan`,1 AS `auth_perusahaan`,1 AS `auth_m_perusahaan`,1 AS `id_m_perusahaan`,1 AS `id_m_parent` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_lokker`
--

/*!50001 DROP VIEW IF EXISTS `vw_lokker`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_lokker` AS select 1 AS `id_lokker`,1 AS `kd_lokker`,1 AS `lokker`,1 AS `ket_lokker`,1 AS `stat_lokker`,1 AS `tgl_buat`,1 AS `tgl_edit`,1 AS `id_user`,1 AS `auth_lokker`,1 AS `nama_user`,1 AS `email_user` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_lokterima`
--

/*!50001 DROP VIEW IF EXISTS `vw_lokterima`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_lokterima` AS select 1 AS `id_lokterima`,1 AS `kd_lokterima`,1 AS `lokterima`,1 AS `jenis_lokasi`,1 AS `ket_lokterima`,1 AS `stat_lokterima`,1 AS `tgl_buat`,1 AS `tgl_edit`,1 AS `id_user`,1 AS `auth_lokterima`,1 AS `nama_user`,1 AS `email_user`,1 AS `id_perusahaan`,1 AS `id_parent`,1 AS `kode_perusahaan`,1 AS `nama_perusahaan`,1 AS `auth_perusahaan` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_loktrm`
--

/*!50001 DROP VIEW IF EXISTS `vw_loktrm`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_loktrm` AS select 1 AS `id_lokterima`,1 AS `kd_lokterima`,1 AS `lokterima`,1 AS `ket_lokterima`,1 AS `stat_lokterima`,1 AS `tgl_buat`,1 AS `tgl_edit`,1 AS `id_user`,1 AS `auth_lokterima`,1 AS `nama_user`,1 AS `email_user`,1 AS `id_perusahaan`,1 AS `id_parent`,1 AS `kode_perusahaan`,1 AS `nama_perusahaan`,1 AS `auth_perusahaan`,1 AS `id_m_perusahaan`,1 AS `id_m_parent` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_lvl`
--

/*!50001 DROP VIEW IF EXISTS `vw_lvl`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_lvl` AS select 1 AS `id_level`,1 AS `kd_level`,1 AS `level`,1 AS `ket_level`,1 AS `stat_level`,1 AS `tgl_buat`,1 AS `tgl_edit`,1 AS `id_user`,1 AS `auth_level`,1 AS `nama_user`,1 AS `email_user`,1 AS `id_perusahaan`,1 AS `id_parent`,1 AS `kode_perusahaan`,1 AS `nama_perusahaan`,1 AS `auth_perusahaan` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_m_per`
--

/*!50001 DROP VIEW IF EXISTS `vw_m_per`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_m_per` AS select 1 AS `id_m_perusahaan`,1 AS `id_parent`,1 AS `id_perusahaan`,1 AS `nama_m_perusahaan`,1 AS `id_jenis_perusahaan`,1 AS `jenis_perusahaan`,1 AS `no_jenis_perusahaan`,1 AS `stat_m_perusahaan`,1 AS `tgl_buat`,1 AS `tgl_edit`,1 AS `id_user`,1 AS `kode_perusahaan`,1 AS `nama_perusahaan`,1 AS `auth_parent`,1 AS `auth_perusahaan`,1 AS `auth_m_perusahaan` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_m_perusahaan`
--

/*!50001 DROP VIEW IF EXISTS `vw_m_perusahaan`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_m_perusahaan` AS select 1 AS `id_m_perusahaan`,1 AS `id_parent`,1 AS `id_perusahaan`,1 AS `nama_m_perusahaan`,1 AS `url_rk3l`,1 AS `id_jenis_perusahaan`,1 AS `jenis_perusahaan`,1 AS `no_jenis_perusahaan`,1 AS `stat_m_perusahaan`,1 AS `tgl_buat`,1 AS `tgl_edit`,1 AS `id_user`,1 AS `kode_perusahaan`,1 AS `nama_perusahaan`,1 AS `nama_user`,1 AS `email_user`,1 AS `auth_parent`,1 AS `auth_perusahaan`,1 AS `auth_m_perusahaan`,1 AS `id_izin_perusahaan`,1 AS `no_izin_perusahaan`,1 AS `tgl_mulai_izin`,1 AS `tgl_akhir_izin`,1 AS `url_izin_perusahaan`,1 AS `ket_izin_perusahaan`,1 AS `stat_perusahaan`,1 AS `kegiatan`,1 AS `ket_perusahaan`,1 AS `id_sio_perusahaan`,1 AS `no_sio_perusahaan`,1 AS `tgl_mulai_sio`,1 AS `tgl_akhir_sio`,1 AS `url_sio`,1 AS `ket_sio`,1 AS `id_kontrak_perusahaan`,1 AS `no_kontrak_perusahaan`,1 AS `tgl_mulai_kontrak`,1 AS `tgl_akhir_kontrak`,1 AS `ket_kontrak_perusahaan`,1 AS `url_doc_kontrak_perusahaan` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_m_prs`
--

/*!50001 DROP VIEW IF EXISTS `vw_m_prs`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_m_prs` AS select 1 AS `id_m_perusahaan`,1 AS `id_parent`,1 AS `id_perusahaan`,1 AS `nama_m_perusahaan`,1 AS `url_rk3l`,1 AS `id_jenis_perusahaan`,1 AS `jenis_perusahaan`,1 AS `no_jenis_perusahaan`,1 AS `stat_m_perusahaan`,1 AS `tgl_buat`,1 AS `tgl_edit`,1 AS `id_user`,1 AS `kode_perusahaan`,1 AS `nama_perusahaan`,1 AS `nama_user`,1 AS `email_user`,1 AS `auth_parent`,1 AS `auth_perusahaan`,1 AS `auth_m_perusahaan` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_mcu`
--

/*!50001 DROP VIEW IF EXISTS `vw_mcu`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_mcu` AS select 1 AS `id_mcu`,1 AS `id_personal`,1 AS `no_ktp`,1 AS `no_kk`,1 AS `nama_lengkap`,1 AS `id_mcu_jenis`,1 AS `mcu_jenis`,1 AS `tgl_mcu`,1 AS `ket_mcu`,1 AS `url_file`,1 AS `tgl_buat`,1 AS `tgl_edit`,1 AS `id_user`,1 AS `nama_user`,1 AS `email_user`,1 AS `auth_personal`,1 AS `auth_mcu`,1 AS `id_m_perusahaan` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_menu`
--

/*!50001 DROP VIEW IF EXISTS `vw_menu`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_menu` AS select 1 AS `IdMenu`,1 AS `NamaMenu`,1 AS `StatMenu`,1 AS `tgl_buat`,1 AS `tgl_edit`,1 AS `id_user`,1 AS `auth_menu`,1 AS `nama_user`,1 AS `email_user` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_modul_role_menu`
--

/*!50001 DROP VIEW IF EXISTS `vw_modul_role_menu`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_modul_role_menu` AS select 1 AS `id_modul_role_menu`,1 AS `id_menu`,1 AS `NamaMenu`,1 AS `StatMenu`,1 AS `BukaFile`,1 AS `id_modul_role`,1 AS `IdParent`,1 AS `NamaModule`,1 AS `UrlModule`,1 AS `LabelMenu`,1 AS `IconModule` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_pekerjaan`
--

/*!50001 DROP VIEW IF EXISTS `vw_pekerjaan`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_pekerjaan` AS select 1 AS `id_pekerjaan`,1 AS `id_depart`,1 AS `id_section`,1 AS `id_posisi`,1 AS `id_grade`,1 AS `id_level`,1 AS `kd_depart`,1 AS `depart`,1 AS `kd_section`,1 AS `section`,1 AS `posisi`,1 AS `grade`,1 AS `kd_level`,1 AS `level` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_personal`
--

/*!50001 DROP VIEW IF EXISTS `vw_personal`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_personal` AS select 1 AS `id_personal`,1 AS `no_ktp`,1 AS `no_kk`,1 AS `nama_lengkap`,1 AS `nama_alias`,1 AS `jk`,1 AS `tmp_lahir`,1 AS `tgl_lahir`,1 AS `id_stat_nikah`,1 AS `kode_stat_nikah`,1 AS `stat_nikah`,1 AS `id_agama`,1 AS `agama`,1 AS `warga_negara`,1 AS `email_pribadi`,1 AS `hp_1`,1 AS `hp_2`,1 AS `nama_ibu`,1 AS `stat_ibu`,1 AS `nama_ayah`,1 AS `stat_ayah`,1 AS `no_bpjstk`,1 AS `no_bpjskes`,1 AS `no_bpjspensiun`,1 AS `no_equity`,1 AS `no_npwp`,1 AS `tgl_buat`,1 AS `tgl_edit`,1 AS `id_user`,1 AS `id_ec`,1 AS `nama_ec`,1 AS `hp_ec`,1 AS `hp_ec_2`,1 AS `relasi_ec`,1 AS `ket_ec`,1 AS `stat_ec`,1 AS `id_alamat_ktp`,1 AS `rt_ktp`,1 AS `rw_ktp`,1 AS `kel_ktp`,1 AS `kec_ktp`,1 AS `kab_ktp`,1 AS `prov_ktp`,1 AS `stat_alamat_ktp`,1 AS `auth_personal`,1 AS `url_pendukung`,1 AS `usia`,1 AS `id_pendidikan`,1 AS `nama_sekolah`,1 AS `fakultas`,1 AS `jurusan` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_perusahaan`
--

/*!50001 DROP VIEW IF EXISTS `vw_perusahaan`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_perusahaan` AS select 1 AS `id_perusahaan`,1 AS `kode_perusahaan`,1 AS `nama_perusahaan`,1 AS `alamat_perusahaan`,1 AS `kel_perusahaan`,1 AS `kec_perusahaan`,1 AS `kab_perusahaan`,1 AS `prov_perusahaan`,1 AS `kodepos_perusahaan`,1 AS `telp_perusahaan`,1 AS `email_perusahaan`,1 AS `website_perusahaan`,1 AS `npwp_perusahaan`,1 AS `ket_perusahaan`,1 AS `stat_perusahaan`,1 AS `kegiatan`,1 AS `tgl_buat`,1 AS `tgl_edit`,1 AS `id_user`,1 AS `auth_perusahaan`,1 AS `nama_user`,1 AS `email_user` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_pjo_perusahaan`
--

/*!50001 DROP VIEW IF EXISTS `vw_pjo_perusahaan`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_pjo_perusahaan` AS select 1 AS `id_pjo_perusahaan`,1 AS `id_m_perusahaan`,1 AS `no_pengesahan_pjo`,1 AS `id_perusahaan`,1 AS `nama_m_perusahaan`,1 AS `jenis_perusahaan`,1 AS `kode_perusahaan`,1 AS `nama_perusahaan`,1 AS `id_lokasi`,1 AS `tgl_aktif_pjo`,1 AS `tgl_akhir_pjo`,1 AS `url_pengesahan_pjo`,1 AS `id_karyawan`,1 AS `id_personal`,1 AS `no_nik`,1 AS `nama_lengkap`,1 AS `no_ktp`,1 AS `tgl_buat`,1 AS `tgl_edit`,1 AS `id_user`,1 AS `auth_pjo_perusahaan`,1 AS `auth_perusahaan`,1 AS `auth_m_perusahaan` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_poh`
--

/*!50001 DROP VIEW IF EXISTS `vw_poh`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_poh` AS select 1 AS `id_poh`,1 AS `kd_poh`,1 AS `poh`,1 AS `ket_poh`,1 AS `stat_poh`,1 AS `tgl_buat`,1 AS `tgl_edit`,1 AS `id_user`,1 AS `auth_poh`,1 AS `nama_user`,1 AS `email_user` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_posisi`
--

/*!50001 DROP VIEW IF EXISTS `vw_posisi`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_posisi` AS select 1 AS `id_posisi`,1 AS `posisi`,1 AS `ket_posisi`,1 AS `stat_posisi`,1 AS `tgl_buat`,1 AS `tgl_edit`,1 AS `id_user`,1 AS `id_depart`,1 AS `kd_depart`,1 AS `depart`,1 AS `auth_posisi`,1 AS `nama_user`,1 AS `email_user`,1 AS `id_perusahaan`,1 AS `id_parent`,1 AS `kode_perusahaan`,1 AS `nama_perusahaan`,1 AS `auth_depart`,1 AS `auth_perusahaan`,1 AS `id_m_perusahaan`,1 AS `id_m_parent` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_prs_all`
--

/*!50001 DROP VIEW IF EXISTS `vw_prs_all`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_prs_all` AS select 1 AS `id_perusahaan`,1 AS `kode_perusahaan`,1 AS `nama_perusahaan`,1 AS `alamat_perusahaan`,1 AS `kel_perusahaan`,1 AS `kec_perusahaan`,1 AS `kab_perusahaan`,1 AS `prov_perusahaan`,1 AS `kodepos_perusahaan`,1 AS `telp_perusahaan`,1 AS `email_perusahaan`,1 AS `website_perusahaan`,1 AS `npwp_perusahaan`,1 AS `ket_perusahaan`,1 AS `stat_perusahaan`,1 AS `kegiatan`,1 AS `tgl_buat`,1 AS `tgl_edit`,1 AS `id_user`,1 AS `auth_perusahaan`,1 AS `nama_user`,1 AS `email_user`,1 AS `prov`,1 AS `kab`,1 AS `kec`,1 AS `kel` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_pss`
--

/*!50001 DROP VIEW IF EXISTS `vw_pss`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_pss` AS select 1 AS `id_posisi`,1 AS `posisi`,1 AS `ket_posisi`,1 AS `stat_posisi`,1 AS `tgl_buat`,1 AS `tgl_edit`,1 AS `id_user`,1 AS `id_depart`,1 AS `kd_depart`,1 AS `depart`,1 AS `auth_posisi`,1 AS `nama_user`,1 AS `email_user`,1 AS `id_perusahaan`,1 AS `id_parent`,1 AS `kode_perusahaan`,1 AS `nama_perusahaan`,1 AS `auth_depart`,1 AS `auth_perusahaan` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_roster`
--

/*!50001 DROP VIEW IF EXISTS `vw_roster`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_roster` AS select 1 AS `id_roster`,1 AS `kd_roster`,1 AS `roster`,1 AS `jml_hari_onsite`,1 AS `jml_hari_offsite`,1 AS `ket_roster`,1 AS `stat_roster`,1 AS `tgl_buat`,1 AS `tgl_edit`,1 AS `id_user`,1 AS `auth_roster`,1 AS `nama_user`,1 AS `email_user`,1 AS `id_perusahaan`,1 AS `id_parent`,1 AS `kode_perusahaan`,1 AS `nama_perusahaan`,1 AS `auth_perusahaan` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_sanksi`
--

/*!50001 DROP VIEW IF EXISTS `vw_sanksi`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_sanksi` AS select 1 AS `id_sanksi`,1 AS `kd_sanksi`,1 AS `sanksi`,1 AS `jml_hari_berlaku`,1 AS `ket_sanksi`,1 AS `stat_sanksi`,1 AS `tgl_buat`,1 AS `tgl_edit`,1 AS `id_user`,1 AS `auth_sanksi`,1 AS `nama_user`,1 AS `email_user` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_section`
--

/*!50001 DROP VIEW IF EXISTS `vw_section`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_section` AS select 1 AS `id_section`,1 AS `kd_section`,1 AS `section`,1 AS `ket_section`,1 AS `stat_section`,1 AS `tgl_buat`,1 AS `tgl_edit`,1 AS `id_user`,1 AS `id_depart`,1 AS `kd_depart`,1 AS `depart`,1 AS `auth_section`,1 AS `nama_user`,1 AS `email_user`,1 AS `id_perusahaan`,1 AS `id_parent`,1 AS `kode_perusahaan`,1 AS `nama_perusahaan`,1 AS `auth_depart`,1 AS `auth_perusahaan` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_sertifikasi`
--

/*!50001 DROP VIEW IF EXISTS `vw_sertifikasi`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_sertifikasi` AS select 1 AS `id_sertifikasi`,1 AS `id_personal`,1 AS `no_ktp`,1 AS `no_kk`,1 AS `jk`,1 AS `tmp_lahir`,1 AS `tgl_lahir`,1 AS `id_jenis_sertifikasi`,1 AS `kode_jenis_sertifikasi`,1 AS `jenis_sertifikasi`,1 AS `no_sertifikasi`,1 AS `lembaga`,1 AS `tgl_sertifikasi`,1 AS `tgl_berakhir_sertifikasi`,1 AS `file_sertifikasi`,1 AS `tgl_buat`,1 AS `tgl_edit`,1 AS `id_user`,1 AS `auth_sertifikat`,1 AS `auth_personal` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_sim`
--

/*!50001 DROP VIEW IF EXISTS `vw_sim`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_sim` AS select 1 AS `id_sim`,1 AS `sim`,1 AS `stat_sim`,1 AS `ket_sim`,1 AS `tgl_buat`,1 AS `tgl_edit`,1 AS `id_user`,1 AS `auth_sim`,1 AS `nama_user`,1 AS `email_user` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_sim_karyawan`
--

/*!50001 DROP VIEW IF EXISTS `vw_sim_karyawan`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_sim_karyawan` AS select 1 AS `id_sim_kary`,1 AS `id_personal`,1 AS `id_karyawan`,1 AS `no_ktp`,1 AS `nama_lengkap`,1 AS `tmp_lahir`,1 AS `tgl_lahir`,1 AS `id_sim`,1 AS `tgl_exp_sim`,1 AS `ket_sim_kary`,1 AS `url_file`,1 AS `tgl_buat`,1 AS `tgl_edit`,1 AS `id_user`,1 AS `sim`,1 AS `auth_sim_kary`,1 AS `auth_personal` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_sio_perusahaan`
--

/*!50001 DROP VIEW IF EXISTS `vw_sio_perusahaan`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_sio_perusahaan` AS select 1 AS `id_sio_perusahaan`,1 AS `id_m_perusahaan`,1 AS `no_sio_perusahaan`,1 AS `tgl_mulai_sio`,1 AS `tgl_akhir_sio`,1 AS `url_sio`,1 AS `ket_sio`,1 AS `tgl_buat`,1 AS `tgl_edit`,1 AS `id_user`,1 AS `auth_sio_perusahaan` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_stat_perjanjian`
--

/*!50001 DROP VIEW IF EXISTS `vw_stat_perjanjian`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_stat_perjanjian` AS select 1 AS `id_stat_perjanjian`,1 AS `stat_perjanjian`,1 AS `ket_stat_perjanjian`,1 AS `stat_stat_perjanjian`,1 AS `stat_waktu`,1 AS `tgl_buat`,1 AS `tgl_edit`,1 AS `id_user`,1 AS `auth_stat_perjanjian`,1 AS `nama_user`,1 AS `email_user` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_tipe`
--

/*!50001 DROP VIEW IF EXISTS `vw_tipe`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_tipe` AS select 1 AS `id_tipe`,1 AS `tipe`,1 AS `ket_tipe`,1 AS `stat_tipe`,1 AS `tgl_buat`,1 AS `tgl_edit`,1 AS `id_user`,1 AS `auth_tipe`,1 AS `nama_user`,1 AS `email_user` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_unit`
--

/*!50001 DROP VIEW IF EXISTS `vw_unit`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_unit` AS select 1 AS `id_unit`,1 AS `kode_unit`,1 AS `unit`,1 AS `stat_unit`,1 AS `ket_unit`,1 AS `tgl_buat`,1 AS `tgl_edit`,1 AS `id_user`,1 AS `auth_unit`,1 AS `nama_user`,1 AS `email_user` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_user`
--

/*!50001 DROP VIEW IF EXISTS `vw_user`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_user` AS select 1 AS `id_user`,1 AS `nama_user`,1 AS `email_user`,1 AS `tgl_aktif`,1 AS `tgl_exp`,1 AS `sesi`,1 AS `id_menu`,1 AS `NamaMenu`,1 AS `akses_apps`,1 AS `stat_user`,1 AS `pic_user`,1 AS `tgl_buat`,1 AS `tgl_edit`,1 AS `id_buat`,1 AS `auth_user`,1 AS `id_m_perusahaan`,1 AS `id_parent`,1 AS `id_perusahaan`,1 AS `jenis_perusahaan`,1 AS `no_jenis_perusahaan`,1 AS `kode_perusahaan`,1 AS `nama_perusahaan` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_vaksin_kary`
--

/*!50001 DROP VIEW IF EXISTS `vw_vaksin_kary`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_vaksin_kary` AS select 1 AS `id_kary`,1 AS `id_personal`,1 AS `no_acr`,1 AS `no_nik`,1 AS `no_ktp`,1 AS `no_kk`,1 AS `nama_lengkap`,1 AS `nama_alias`,1 AS `depart`,1 AS `section`,1 AS `posisi`,1 AS `level`,1 AS `tipe`,1 AS `stat_tinggal`,1 AS `id_vaksin_jenis`,1 AS `vaksin_jenis`,1 AS `id_vaksin`,1 AS `tgl_vaksin`,1 AS `id_vaksin_nama`,1 AS `vaksin_nama`,1 AS `tgl_buat`,1 AS `tgl_edit`,1 AS `id_user`,1 AS `nama_user`,1 AS `email_user`,1 AS `auth_personal`,1 AS `auth_vaksin` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-06-15 17:20:49
