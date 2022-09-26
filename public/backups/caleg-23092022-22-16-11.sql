-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: caleg
-- ------------------------------------------------------
-- Server version	10.4.24-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `agenda`
--

DROP TABLE IF EXISTS `agenda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `agenda` (
  `id_agenda` int(6) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `nama_agenda` varchar(100) NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `id_caleg` int(4) NOT NULL,
  PRIMARY KEY (`id_agenda`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agenda`
--

LOCK TABLES `agenda` WRITE;
/*!40000 ALTER TABLE `agenda` DISABLE KEYS */;
INSERT INTO `agenda` VALUES (5,'2022-08-31','14:02:00','Serangan Berapi','Gedung',5),(7,'2022-09-07','00:15:00','SERANGAN FAJAR','Gedung Sate',6),(8,'2022-09-01','11:05:00','Kunjungan ke DPR RI','Gedung DPR RI',5),(9,'2022-08-28','13:11:00','Tawuran','Jln Perjuangan',7),(10,'2022-12-31','00:00:00','Kunjungan ke gunung berapi','gunung krakatau',9);
/*!40000 ALTER TABLE `agenda` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caleg`
--

DROP TABLE IF EXISTS `caleg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caleg` (
  `id_caleg` int(4) NOT NULL AUTO_INCREMENT,
  `nama_caleg` varchar(100) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `id_legislatif` int(4) NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `id_partai` int(4) NOT NULL,
  `aktif` enum('Y','N') NOT NULL DEFAULT 'N',
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `id_session` varchar(100) DEFAULT NULL,
  `reset_token` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_caleg`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caleg`
--

LOCK TABLES `caleg` WRITE;
/*!40000 ALTER TABLE `caleg` DISABLE KEYS */;
INSERT INTO `caleg` VALUES (5,'PDIP','PDIP',14,'Jawa Barat, Cirebon','0897840536','PDIP@gmail.com',19,'Y','PDIP','$2y$10$m2fjNGI5ih.1HSFPkhYD1eXbsfv1J1XBa4ixhBodN0l5wqx/lQ/xC','images/5JrQ2FwFIe8wdjP6PxrVuGGqAYS3hXhLe7VCoCT0.png','fBkcdHDKWt7sXX3UCv4wTh2eRBL1BXGDvJND8EM7oU8YH12dLRLeYgOCcQ42','NzqIt4RECIYtefQFmo25yxxArgCLjLudtuIKVaTWCBqtR2jpIfYDlShPCKUX'),(6,'PKS','PKS',13,'Jawa Barat, Cirebon','0897805369','PKS@gmail.com',20,'Y','PKS','$2y$10$Odbldni9p5UafyIcHHlYJOnxocD0.BIoWLpVpq6HELyqpucYapvny','images/i9Zl8oVaL2FWUj8bwim3hhfVr1ozMctxR9mF0Txc.png','','zfY3PH0h6tz9RFyAlaGTxI4U3drnQXeqQmPlturTHDtO3T9KaePl2JKcOMJV'),(7,'Gerindra','Gerindra',14,'Jakarta Barat','0897840512','gerindra@gmail.com',21,'Y','GERINDRA','$2y$10$AjHi/DhijmOaQUGiDJ0wk.7e.K8GjS65UtRj/SHI9LPeVAAlFfX2m','images/pRImkhmkKZuBW0bSBE8Fa4OTc7qger1xQNQSicgs.jpg','7W7QOmPT378wYm8u7WeXFYqetbRvNqSXHVu8zfFUDlZ8r5IwRPWoGMnkfxdi',''),(8,'Golkar','Golkar',14,'Jogja, Malioboro','08974123122','golkar@gmail.com',22,'Y','GOLKAR','$2y$10$p4VaIBhas3jn75lQ4hlCx.GpfKzDv2vwAaATN6uGpUaUZkbndWzO6','images/6V3PQTj2nlj7LTs0Mtj4dwsv3TGFcfQ5U9fuAiGd.png','',''),(9,'PKB','PKB',12,'Cikarang, Jakarta, Jawa Barat','08742342315','PKB@gmail.com',23,'Y','PKB','$2y$10$1jVAx/dm.4BaeSUFIpkVK.MYIeijWxOtJYFmRd69Y2EJRIS7lRkjC','images/EvC4Nu11J23VN5FMfwfxUffWG91xqos2xWH9wIxm.png','',''),(10,'Nasdem','Nasdem',12,'Yogyakarta','08473234231','nasdem@gmail.com',24,'Y','NASDEM','$2y$10$orMjEw2RqGdU1tzGh9/5C.AJKeYuEO.GWFyoMmnDUCPu43I1e4aBC','images/n6UUgteVyBrvgFp55f9WDipOcUHPQuANUY4pi6KI.png','',''),(11,'Berkarya','Berkarya',12,'Jakarta Barat, Lorem','0813574375','berkarya@gmail.com',25,'Y','BERKARYA','$2y$10$0/xpvgOzaV5MDv46e1G4K.IbEWTAFISJ1zI2CpnZPnh8iNRp4pW72','images/VuRrvYrqnErhxbb4nrzVjcXZw7bAHtCEnHWQBtIZ.png','',''),(12,'Perindo','Perindo',14,'Evakuasi no 7 cirebon jabar','08473452345','perindo@gmail.com',26,'Y','PERINDO','$2y$10$DQioO.gwfynuFhh2BWmL4OzOhaywcFkHKIym.Tl1Z70dx64T7oItS','images/JFy3AAbCyzdJlfYEl2XlQN4l3FxQJD34yUokWzM6.jpg','',''),(13,'PPP','PPP',12,'Jalan Kalitanjung no 7, Jawa Barat, Cirebon','0895734532','PPP@gmail.com',27,'Y','PPP','$2y$10$EhyM5.Pbk9gfDAd.v2kZIOnm0LnV2XG.Xj6V5omPWcm4BqtZeCYAu','images/eGVMeMvpfUANIbdz1y8IHrhobd1ErBTZoN7oFmrW.png','',''),(14,'PAN','PAN',13,'Sigasina, tokyo, japan','0847252345','PAN@gmail.com',28,'Y','PAN','$2y$10$BHdMIye5bwRFGEBxKdNVBeX47yVeeemi6K/QEZfEXQP/3y0eXI2M2','images/ubywc2IW98koFGpytM0An8WO1LNxKCmbchphlj5t.png','',''),(21,'Iqro Negoro','Iqro Negoro',13,'Jalan Fatahillah no 7','8978405369','iqronegoro0@gmail.com',22,'Y','iqronegoro','$2y$10$ywQ/ts9FTT1xL3/cf9.ItuxrwaQHEf0X0.fTxbXgJBd0.T5pWkzOy','1663818648.png',NULL,'DRKOPEpv8YAQbXnXOZMxa40OKC4z3FjLKetpc3gRjvugWp6xSUajU9IFUPct');
/*!40000 ALTER TABLE `caleg` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `config`
--

DROP TABLE IF EXISTS `config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_caleg` int(4) NOT NULL,
  `API_KEY` varchar(255) DEFAULT NULL,
  `device_id` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `config`
--

LOCK TABLES `config` WRITE;
/*!40000 ALTER TABLE `config` DISABLE KEYS */;
INSERT INTO `config` VALUES (3,5,'710b80ee88a701f2d769b351a036916f706ea568','7803','csjagatgenius@gmail.com','yuofgxgqvrdwnqot');
/*!40000 ALTER TABLE `config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `daftar_isu`
--

DROP TABLE IF EXISTS `daftar_isu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `daftar_isu` (
  `id_isu` int(11) NOT NULL AUTO_INCREMENT,
  `id_caleg` int(4) NOT NULL,
  `jenis` enum('L','O') NOT NULL DEFAULT 'L',
  `dampak` enum('P','N') NOT NULL DEFAULT 'P',
  `tanggal` date NOT NULL,
  `id_kecamatan` int(11) NOT NULL,
  `id_relawan` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`images`)),
  `tanggapi` varchar(255) NOT NULL DEFAULT 'N',
  `tanggapan` text NOT NULL DEFAULT 'Belum Di Tanggapi',
  PRIMARY KEY (`id_isu`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `daftar_isu`
--

LOCK TABLES `daftar_isu` WRITE;
/*!40000 ALTER TABLE `daftar_isu` DISABLE KEYS */;
/*!40000 ALTER TABLE `daftar_isu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dapil`
--

DROP TABLE IF EXISTS `dapil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dapil` (
  `id_dapil` int(4) NOT NULL AUTO_INCREMENT,
  `nama_dapil` varchar(100) NOT NULL,
  PRIMARY KEY (`id_dapil`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dapil`
--

LOCK TABLES `dapil` WRITE;
/*!40000 ALTER TABLE `dapil` DISABLE KEYS */;
INSERT INTO `dapil` VALUES (2,'Dapil 1');
/*!40000 ALTER TABLE `dapil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `desa`
--

DROP TABLE IF EXISTS `desa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `desa` (
  `id_desa` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `nama_desa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_kecamatan` int(11) NOT NULL,
  `dpt` int(10) NOT NULL,
  `tps` int(6) NOT NULL,
  `suara` int(6) NOT NULL,
  PRIMARY KEY (`id_desa`)
) ENGINE=InnoDB AUTO_INCREMENT=452 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `desa`
--

LOCK TABLES `desa` WRITE;
/*!40000 ALTER TABLE `desa` DISABLE KEYS */;
INSERT INTO `desa` VALUES (1,'Arjawinangun','Desa',1,0,0,0),(2,'Bulak','Desa',1,0,0,0),(30,'Geyongan','Desa',1,0,0,0),(31,'Jungjang  Wetan','Desa',1,0,0,0),(32,'Jungjang','Desa',1,0,0,0),(33,'Karangsambung','Desa',1,0,0,0),(34,'Kebonturi','Desa',1,0,0,0),(35,'Rawagatel','Desa',1,0,0,0),(36,'Sende','Desa',1,0,0,0),(37,'Tegalgubug','Desa',1,0,0,0),(38,'Tegalgubug Lor','Desa',1,0,0,0),(39,'Astanajapura','Desa',2,0,0,0),(40,'Buntet','Desa',2,0,0,0),(41,'Japura Kidul','Desa',2,0,0,0),(42,'Japurabakti','Desa',2,0,0,0),(43,'Kanci','Desa',2,0,0,0),(44,'Kanci Kulon','Desa',2,0,0,0),(45,'Kendal','Desa',2,0,0,0),(46,'Mertapada Kulon','Desa',2,0,0,0),(47,'Mertapada Wetan','Desa',2,0,0,0),(48,'Munjul','Desa',2,0,0,0),(49,'Sidamulya','Desa',2,0,0,0),(50,'Babakan','Desa',3,0,0,0),(51,'Babakangebang','Desa',3,0,0,0),(52,'Bojonggebang','Desa',3,0,0,0),(53,'Cangkuang','Desa',3,0,0,0),(54,'Gembongan','Desa',3,0,0,0),(55,'Gembonganmekar','Desa',3,0,0,0),(56,'Karangwangun','Desa',3,0,0,0),(57,'Kudukeras','Desa',3,0,0,0),(58,'Kudumulya','Desa',3,0,0,0),(59,'Pakusamben','Desa',3,0,0,0),(60,'Serang Kulon','Desa',3,0,0,0),(61,'Serang Wetan','Desa',3,0,0,0),(62,'Sumber Kidul','Desa',3,0,0,0),(63,'Sumber Lor','Desa',3,0,0,0),(64,'Beber','Desa',4,0,0,0),(65,'Ciawigajah','Desa',4,0,0,0),(66,'Cikancas','Desa',4,0,0,0),(67,'Cipinang','Desa',4,0,0,0),(68,'Halimpu','Desa',4,0,0,0),(69,'Kondangsari','Desa',4,0,0,0),(70,'Patapan','Desa',4,0,0,0),(71,'Sindanghayu','Desa',4,0,0,0),(72,'Sindangkasih','Desa',4,0,0,0),(73,'Wanayasa','Desa',4,0,0,0),(74,'Bojongnegara','Desa',5,0,0,0),(75,'Ciledug Kulon','Desa',5,0,0,0),(76,'Ciledug Lor','Desa',5,0,0,0),(77,'Ciledug Tengah','Desa',5,0,0,0),(78,'Ciledug Wetan','Desa',5,0,0,0),(79,'Damarguna','Desa',5,0,0,0),(80,'Jatiseeng','Desa',5,0,0,0),(81,'Jatiseeng Kidul','Desa',5,0,0,0),(82,'Leuweunggajah','Desa',5,0,0,0),(83,'Tenjomaya','Desa',5,0,0,0),(84,'Babakan','Desa',6,0,0,0),(85,'Bringin','Desa',6,0,0,0),(86,'Budur','Desa',6,0,0,0),(87,'Ciwaringin','Desa',6,0,0,0),(88,'Galagamba','Desa',6,0,0,0),(89,'Gintung Kidul','Desa',6,0,0,0),(90,'Gintung Tengah','Desa',6,0,0,0),(91,'Gintungranjeng','Desa',6,0,0,0),(92,'Cikeduk','Desa',7,0,0,0),(93,'Depok','Desa',7,0,0,0),(94,'Getasan','Desa',7,0,0,0),(95,'Karangwangi','Desa',7,0,0,0),(96,'Kasugengan Kidul','Desa',7,0,0,0),(97,'Kasugengan Lor','Desa',7,0,0,0),(98,'Keduanan','Desa',7,0,0,0),(99,'Kejuden','Desa',7,0,0,0),(100,'Warugede','Desa',7,0,0,0),(101,'Warujaya','Desa',7,0,0,0),(102,'Warukawung','Desa',7,0,0,0),(103,'Waruroyom','Desa',7,0,0,0),(104,'Balad','Desa',8,0,0,0),(105,'Bobos','Desa',8,0,0,0),(106,'Cangkoak','Desa',8,0,0,0),(107,'Cikalahang','Desa',8,0,0,0),(108,'Cipanas','Desa',8,0,0,0),(109,'Cisaat','Desa',8,0,0,0),(110,'Dukupuntang','Desa',8,0,0,0),(111,'Girinata','Desa',8,0,0,0),(112,'Kedongdong Kidul','Desa',8,0,0,0),(113,'Kepunduan','Desa',8,0,0,0),(114,'Mandala','Desa',8,0,0,0),(115,'Sindangjawa','Desa',8,0,0,0),(116,'Sindangmekar','Desa',8,0,0,0),(117,'Dompyong Kulon','Desa',9,0,0,0),(118,'Dompyong Wetan','Desa',9,0,0,0),(119,'Gagasari','Desa',9,0,0,0),(120,'Gebang','Desa',9,0,0,0),(121,'Gebangilir','Desa',9,0,0,0),(122,'Gebangkulon','Desa',9,0,0,0),(123,'Gebangmekar','Desa',9,0,0,0),(124,'Gebangudik','Desa',9,0,0,0),(125,'Kalimaro','Desa',9,0,0,0),(126,'Kalimekar','Desa',9,0,0,0),(127,'Kalipasung','Desa',9,0,0,0),(128,'Melakasari','Desa',9,0,0,0),(129,'Pelayangan','Desa',9,0,0,0),(130,'Bayalangu Kidul','Desa',10,0,0,0),(131,'Bayalangu Lor','Desa',10,0,0,0),(132,'Gegesik Kidul','Desa',10,0,0,0),(133,'Gegesik Kulon','Desa',10,0,0,0),(134,'Gegesik Lor','Desa',10,0,0,0),(135,'Gegesik Wetan','Desa',10,0,0,0),(136,'Jagapura Kidul','Desa',10,0,0,0),(137,'Jagapura Kulon','Desa',10,0,0,0),(138,'Jagapura Lor','Desa',10,0,0,0),(139,'Jagapura Wetan','Desa',10,0,0,0),(140,'Kedungdalem','Desa',10,0,0,0),(141,'Panunggul','Desa',10,0,0,0),(142,'Sibubut','Desa',10,0,0,0),(143,'Slendra','Desa',10,0,0,0),(144,'Cupang','Desa',11,0,0,0),(145,'Cikeusal','Desa',11,0,0,0),(146,'Gempol','Desa',11,0,0,0),(147,'Kedungbunder','Desa',11,0,0,0),(148,'Kempek','Desa',11,0,0,0),(149,'Palimanan Barat','Desa',11,0,0,0),(150,'Walahar','Desa',11,0,0,0),(151,'Winong','Desa',11,0,0,0),(152,'Durajaya','Desa',12,0,0,0),(153,'Greged','Desa',12,0,0,0),(154,'Gumulunglebak','Desa',12,0,0,0),(155,'Gumulungtonggoh','Desa',12,0,0,0),(156,'Jatipancur','Desa',12,0,0,0),(157,'Kamarang','Desa',12,0,0,0),(158,'Kamarang Lebak','Desa',12,0,0,0),(159,'Lebakmekar','Desa',12,0,0,0),(160,'Nanggela','Desa',12,0,0,0),(161,'Sindangkempeng','Desa',12,0,0,0),(162,'Adidharma','Desa',13,0,0,0),(163,'Astana','Desa',13,0,0,0),(164,'Babadan','Desa',13,0,0,0),(165,'Buyut','Desa',13,0,0,0),(166,'Grogol','Desa',13,0,0,0),(167,'Jadimulya','Desa',13,0,0,0),(168,'Jatimerta','Desa',13,0,0,0),(169,'Kalisapu','Desa',13,0,0,0),(170,'Klayan','Desa',13,0,0,0),(171,'Mayung','Desa',13,0,0,0),(172,'Mertasinga','Desa',13,0,0,0),(173,'Pasindangan','Desa',13,0,0,0),(174,'Sambeng','Desa',13,0,0,0),(175,'Sirnabaya','Desa',13,0,0,0),(176,'Wanakaya','Desa',13,0,0,0),(177,'Bakung Kidul','Desa',14,0,0,0),(178,'Bakung Lor','Desa',14,0,0,0),(179,'Bojong Lor','Desa',14,0,0,0),(180,'Bojong Wetan','Desa',14,0,0,0),(181,'Jamblang','Desa',14,0,0,0),(182,'Orimalang','Desa',14,0,0,0),(183,'Sitiwinangun','Desa',14,0,0,0),(184,'Wangunharja','Desa',14,0,0,0),(185,'Guwa Kidul','Desa',15,0,0,0),(186,'Guwa Lor','Desa',15,0,0,0),(187,'Kalideres','Desa',15,0,0,0),(188,'Kaliwedi Kidul','Desa',15,0,0,0),(189,'Kaliwedi Lor','Desa',15,0,0,0),(190,'Prajawinangun Kulon','Desa',15,0,0,0),(191,'Prajawinangun Wetan','Desa',15,0,0,0),(192,'Ujungsemi','Desa',15,0,0,0),(193,'Wargabinangun','Desa',15,0,0,0),(194,'Bungko','Desa',16,0,0,0),(195,'Bungko Lor','Desa',16,0,0,0),(196,'Dukuh','Desa',16,0,0,0),(197,'Grogol','Desa',16,0,0,0),(198,'Kapetakan','Desa',16,0,0,0),(199,'Karangkendal','Desa',16,0,0,0),(200,'Kertasura','Desa',16,0,0,0),(201,'Pegagan Kidul','Desa',16,0,0,0),(202,'Pegagan Lor','Desa',16,0,0,0),(203,'Kalimeang','Desa',17,0,0,0),(204,'Karangmalang','Desa',17,0,0,0),(205,'Karangmekar','Desa',17,0,0,0),(206,'Karangsembung','Desa',17,0,0,0),(207,'Karangsuwung','Desa',17,0,0,0),(208,'Karangtengah','Desa',17,0,0,0),(209,'Kubangkarang','Desa',17,0,0,0),(210,'Tambelang','Desa',17,0,0,0),(211,'Blender','Desa',18,0,0,0),(212,'Jatipiring','Desa',18,0,0,0),(213,'Karanganyar','Desa',18,0,0,0),(214,'Karangasem','Desa',18,0,0,0),(215,'Karangwangi','Desa',18,0,0,0),(216,'Karangwareng','Desa',18,0,0,0),(217,'Kubangdeleg','Desa',18,0,0,0),(218,'Seuseupan','Desa',18,0,0,0),(219,'Sumurkondang','Desa',18,0,0,0),(220,'Kalikoa','Desa',19,0,0,0),(221,'Kedawung','Desa',19,0,0,0),(222,'Kedungdawa','Desa',19,0,0,0),(223,'Kedungjaya','Desa',19,0,0,0),(224,'Kertawinangun','Desa',19,0,0,0),(225,'Pilangsari','Desa',19,0,0,0),(226,'Sutawinangun','Desa',19,0,0,0),(227,'Tuk','Desa',19,0,0,0),(228,'Bangodua','Desa',20,0,0,0),(229,'Danawinangun','Desa',20,0,0,0),(230,'Jemaras Kidul','Desa',20,0,0,0),(231,'Jemaras Lor','Desa',20,0,0,0),(232,'Klangenan','Desa',20,0,0,0),(233,'Kreyo','Desa',20,0,0,0),(234,'Pekantingan','Desa',20,0,0,0),(235,'Serang','Desa',20,0,0,0),(236,'Slangit','Desa',20,0,0,0),(237,'Asem','Desa',21,0,0,0),(238,'Belawa','Desa',21,0,0,0),(239,'Cipeujeuh Kulon','Desa',21,0,0,0),(240,'Cipeujeuh Wetan','Desa',21,0,0,0),(241,'Lemahabang','Desa',21,0,0,0),(242,'Lemahabang Kulon','Desa',21,0,0,0),(243,'Leuwidingding','Desa',21,0,0,0),(244,'Picungpugur','Desa',21,0,0,0),(245,'Sarajaya','Desa',21,0,0,0),(246,'Sigong','Desa',21,0,0,0),(247,'Sindanglaut','Desa',21,0,0,0),(248,'Tuk Karangsuwung','Desa',21,0,0,0),(249,'Wangkelang','Desa',21,0,0,0),(250,'Ambulu','Desa',22,0,0,0),(251,'Astanalanggar','Desa',22,0,0,0),(252,'Barisan','Desa',22,0,0,0),(253,'Kalirahayu','Desa',22,0,0,0),(254,'Kalisari','Desa',22,0,0,0),(255,'Losari Kidul','Desa',22,0,0,0),(256,'Losari Lor','Desa',22,0,0,0),(257,'Mulyasari','Desa',22,0,0,0),(258,'Panggangsari','Desa',22,0,0,0),(259,'Tawangsari','Desa',22,0,0,0),(260,'Bandengan','Desa',23,0,0,0),(261,'Banjarwangunan','Desa',23,0,0,0),(262,'Citemu','Desa',23,0,0,0),(263,'Luwung','Desa',23,0,0,0),(264,'Mundumesigit','Desa',23,0,0,0),(265,'Mundupesisir','Desa',23,0,0,0),(266,'Pamengkang','Desa',23,0,0,0),(267,'Penpen','Desa',23,0,0,0),(268,'Setupatok','Desa',23,0,0,0),(269,'Sinarancang','Desa',23,0,0,0),(270,'Suci','Desa',23,0,0,0),(271,'Waruduwur','Desa',23,0,0,0),(272,'Babakan Losari','Desa',24,0,0,0),(273,'Babakan Losari Lor','Desa',24,0,0,0),(274,'Dukuhwidara','Desa',24,0,0,0),(275,'Kalibuntu','Desa',24,0,0,0),(276,'Kalimukti','Desa',24,0,0,0),(277,'Pabedilan Kaler','Desa',24,0,0,0),(278,'Pabedilan Kidul','Desa',24,0,0,0),(279,'Pabedilan Kulon','Desa',24,0,0,0),(280,'Pabedilan Wetan','Desa',24,0,0,0),(281,'Pasuruan','Desa',24,0,0,0),(282,'Sidaresmi','Desa',24,0,0,0),(283,'Silihasih','Desa',24,0,0,0),(284,'Tersana','Desa',24,0,0,0),(285,'Hulubanteng','Desa',25,0,0,0),(286,'Hulubanteng Lor','Desa',25,0,0,0),(287,'Jatirenggang','Desa',25,0,0,0),(288,'Pabuaran Kidul','Desa',25,0,0,0),(289,'Pabuaran Lor','Desa',25,0,0,0),(290,'Pabuaran Wetan','Desa',25,0,0,0),(291,'Sukadana','Desa',25,0,0,0),(292,'Balerante','Desa',26,0,0,0),(293,'Beberan','Desa',26,0,0,0),(294,'Cengkuang','Desa',26,0,0,0),(295,'Ciawi','Desa',26,0,0,0),(296,'Cilukrak','Desa',26,0,0,0),(297,'Kepuh','Desa',26,0,0,0),(298,'Lungbenda','Desa',26,0,0,0),(299,'Palimanan Timur','Desa',26,0,0,0),(300,'Panongan','Desa',26,0,0,0),(301,'Pegagan','Desa',26,0,0,0),(302,'Semplo','Desa',26,0,0,0),(303,'Tegalkarang','Desa',26,0,0,0),(304,'Astanamukti','Desa',27,0,0,0),(305,'Bendungan','Desa',27,0,0,0),(306,'Beringin','Desa',27,0,0,0),(307,'Ender','Desa',27,0,0,0),(308,'Getrakmoyan','Desa',27,0,0,0),(309,'Japura Lor','Desa',27,0,0,0),(310,'Pangenan','Desa',27,0,0,0),(311,'Pangarengan','Desa',27,0,0,0),(312,'Rawaurip','Desa',27,0,0,0),(313,'Gujeg','Desa',28,0,0,0),(314,'Kalianyar','Desa',28,0,0,0),(315,'Karanganyar','Desa',28,0,0,0),(316,'Kroya','Desa',28,0,0,0),(317,'Lemahtamba','Desa',28,0,0,0),(318,'Panguragan','Desa',28,0,0,0),(319,'Panguragan Kulon','Desa',28,0,0,0),(320,'Panguragan Lor','Desa',28,0,0,0),(321,'Panguragan Wetan','Desa',28,0,0,0),(322,'Cigobang','Desa',29,0,0,0),(323,'Cigobangwangi','Desa',29,0,0,0),(324,'Cilengkrang','Desa',29,0,0,0),(325,'Cilengkranggirang','Desa',29,0,0,0),(326,'Pasaleman','Desa',29,0,0,0),(327,'Tanjunganom','Desa',29,0,0,0),(328,'Tonjong','Desa',29,0,0,0),(329,'Cangkring','Desa',30,0,0,0),(330,'Gamel','Desa',30,0,0,0),(331,'Kaliwulu','Desa',30,0,0,0),(332,'Panembahan','Desa',30,0,0,0),(333,'Pangkalan','Desa',30,0,0,0),(334,'Sarabau','Desa',30,0,0,0),(335,'Tegalsari','Desa',30,0,0,0),(336,'Trusmi Kulon','Desa',30,0,0,0),(337,'Trusmi Wetan','Desa',30,0,0,0),(338,'Wotgali','Desa',30,0,0,0),(339,'Bodelor','Desa',31,0,0,0),(340,'Bodesari','Desa',31,0,0,0),(341,'Cempaka','Desa',31,0,0,0),(342,'Danamulya','Desa',31,0,0,0),(343,'Gombang','Desa',31,0,0,0),(344,'Karangasem','Desa',31,0,0,0),(345,'Karangmulya','Desa',31,0,0,0),(346,'Kebarepan','Desa',31,0,0,0),(347,'Kedungsana','Desa',31,0,0,0),(348,'Lurah','Desa',31,0,0,0),(349,'Marikangen','Desa',31,0,0,0),(350,'Pamijahan','Desa',31,0,0,0),(351,'Pasanggrahan','Desa',31,0,0,0),(352,'Plumbon','Desa',31,0,0,0),(353,'Purbawinangun','Desa',31,0,0,0),(354,'Karangwuni','Desa',32,0,0,0),(355,'Kertawangun','Desa',32,0,0,0),(356,'Panambangan','Desa',32,0,0,0),(357,'Panongan','Desa',32,0,0,0),(358,'Panongan Lor','Desa',32,0,0,0),(359,'Putat','Desa',32,0,0,0),(360,'Sedong Kidul','Desa',32,0,0,0),(361,'Sedong Lor','Desa',32,0,0,0),(362,'Winduhaji','Desa',32,0,0,0),(363,'Windujaya','Desa',32,0,0,0),(364,'Matangaji','Desa',33,0,0,0),(365,'Sidawangi','Desa',33,0,0,0),(366,'Babakan','Kelurahan',33,0,0,0),(367,'Gegunung','Kelurahan',33,0,0,0),(368,'Kaliwadas','Kelurahan',33,0,0,0),(369,'Kemantren','Kelurahan',33,0,0,0),(370,'Kenanga','Kelurahan',33,0,0,0),(371,'Pasalakan','Kelurahan',33,0,0,0),(372,'Pejambon','Kelurahan',33,0,0,0),(373,'Perbutulan','Kelurahan',33,0,0,0),(374,'Sendang','Kelurahan',33,0,0,0),(375,'Sumber','Kelurahan',33,0,0,0),(376,'Tukmudal','Kelurahan',33,0,0,0),(377,'Watubelah','Kelurahan',33,0,0,0),(378,'Karangreja','Desa',34,0,0,0),(379,'Keraton','Desa',34,0,0,0),(380,'Muara','Desa',34,0,0,0),(381,'Purwawinangun','Desa',34,0,0,0),(382,'Surakarta','Desa',34,0,0,0),(383,'Suranenggala','Desa',34,0,0,0),(384,'Suranenggala Kidul','Desa',34,0,0,0),(385,'Suranenggala Lor','Desa',34,0,0,0),(386,'Suranenggala Kulon','Desa',34,0,0,0),(387,'Bojong Kulon','Desa',35,0,0,0),(388,'Bunder','Desa',35,0,0,0),(389,'Gintung Lor','Desa',35,0,0,0),(390,'Jatianom','Desa',35,0,0,0),(391,'Jatipura','Desa',35,0,0,0),(392,'Kedongdong','Desa',35,0,0,0),(393,'Kejiwan','Desa',35,0,0,0),(394,'Luwungkencana','Desa',35,0,0,0),(395,'Susukan','Desa',35,0,0,0),(396,'Tangkil','Desa',35,0,0,0),(397,'Ujunggebang','Desa',35,0,0,0),(398,'Wiyong','Desa',35,0,0,0),(399,'Ciawiasih','Desa',36,0,0,0),(400,'Ciawijapura','Desa',36,0,0,0),(401,'Curug','Desa',36,0,0,0),(402,'Curug Wetan','Desa',36,0,0,0),(403,'Kaligawe','Desa',36,0,0,0),(404,'Kaligawe Wetan','Desa',36,0,0,0),(405,'Karangmanggu','Desa',36,0,0,0),(406,'Pasawahan','Desa',36,0,0,0),(407,'Sampih','Desa',36,0,0,0),(408,'Susukanagung','Desa',36,0,0,0),(409,'Susukanlebak','Desa',36,0,0,0),(410,'Susukantonggoh','Desa',36,0,0,0),(411,'Wilulang','Desa',36,0,0,0),(412,'Cempaka','Desa',37,0,0,0),(413,'Ciperna','Desa',37,0,0,0),(414,'Cirebon Girang','Desa',37,0,0,0),(415,'Kecomberan','Desa',37,0,0,0),(416,'Kepongpongan','Desa',37,0,0,0),(417,'Kerandon','Desa',37,0,0,0),(418,'Kubang','Desa',37,0,0,0),(419,'Sampiran','Desa',37,0,0,0),(420,'Sarwadadi','Desa',37,0,0,0),(421,'Wanasaba Kidul','Desa',37,0,0,0),(422,'Wanasaba Lor','Desa',37,0,0,0),(423,'Astapada','Desa',38,0,0,0),(424,'Battembat','Desa',38,0,0,0),(425,'Dawuan','Desa',38,0,0,0),(426,'Gesik','Desa',38,0,0,0),(427,'Kalibaru','Desa',38,0,0,0),(428,'Kalitengah','Desa',38,0,0,0),(429,'Kemlakagede','Desa',38,0,0,0),(430,'Palir','Desa',38,0,0,0),(431,'Ambit','Desa',39,0,0,0),(432,'Cibogo','Desa',39,0,0,0),(433,'Cikulak','Desa',39,0,0,0),(434,'Cikulak Kidul','Desa',39,0,0,0),(435,'Cisaat','Desa',39,0,0,0),(436,'Ciuyah','Desa',39,0,0,0),(437,'Gunungsari','Desa',39,0,0,0),(438,'Karangsari','Desa',39,0,0,0),(439,'Mekarsari','Desa',39,0,0,0),(440,'Waledasem','Desa',39,0,0,0),(441,'Waleddesa','Desa',39,0,0,0),(442,'Waledkota','Desa',39,0,0,0),(443,'Karangsari','Desa',40,0,0,0),(444,'Kertasari','Desa',40,0,0,0),(445,'Megu Cilik','Desa',40,0,0,0),(446,'Megu Gede','Desa',40,0,0,0),(447,'Setu Kulon','Desa',40,0,0,0),(448,'Setu Wetan','Desa',40,0,0,0),(449,'Tegalwangi','Desa',40,7600,21,569),(450,'Weru Kidul','Desa',40,0,0,0),(451,'Weru Lor','Desa',40,0,0,0);
/*!40000 ALTER TABLE `desa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detail_dapil`
--

DROP TABLE IF EXISTS `detail_dapil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detail_dapil` (
  `id_detail` int(6) NOT NULL AUTO_INCREMENT,
  `id_kecamatan` int(4) NOT NULL,
  `id_dapil` int(4) NOT NULL,
  PRIMARY KEY (`id_detail`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_dapil`
--

LOCK TABLES `detail_dapil` WRITE;
/*!40000 ALTER TABLE `detail_dapil` DISABLE KEYS */;
INSERT INTO `detail_dapil` VALUES (3,3,2),(4,6,2),(5,40,2);
/*!40000 ALTER TABLE `detail_dapil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detail_suara`
--

DROP TABLE IF EXISTS `detail_suara`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detail_suara` (
  `id_detail` int(11) NOT NULL AUTO_INCREMENT,
  `id_desa` int(11) NOT NULL,
  `id_caleg` int(11) NOT NULL,
  `id_partai` int(11) NOT NULL,
  `suara_2024` int(11) NOT NULL,
  `suara_2019` int(11) NOT NULL,
  PRIMARY KEY (`id_detail`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_suara`
--

LOCK TABLES `detail_suara` WRITE;
/*!40000 ALTER TABLE `detail_suara` DISABLE KEYS */;
INSERT INTO `detail_suara` VALUES (11,1,5,19,500,20),(12,2,5,19,3423,354),(13,234,7,23,6343,234),(14,45,12,25,2435,6354);
/*!40000 ALTER TABLE `detail_suara` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `donasi`
--

DROP TABLE IF EXISTS `donasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `donasi` (
  `id_donasi` int(6) NOT NULL AUTO_INCREMENT,
  `jumlah` int(6) NOT NULL,
  `donatur` varchar(100) NOT NULL,
  `id_caleg` int(4) NOT NULL,
  `tgl_donasi` date NOT NULL,
  `bukti_tf` varchar(100) NOT NULL,
  PRIMARY KEY (`id_donasi`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `donasi`
--

LOCK TABLES `donasi` WRITE;
/*!40000 ALTER TABLE `donasi` DISABLE KEYS */;
INSERT INTO `donasi` VALUES (2,500000,'ajiz',4,'2022-03-04','logo_kop.png');
/*!40000 ALTER TABLE `donasi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dukungan`
--

DROP TABLE IF EXISTS `dukungan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dukungan` (
  `id_dukungan` int(6) NOT NULL AUTO_INCREMENT,
  `pesan` text NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `id_caleg` int(4) NOT NULL,
  PRIMARY KEY (`id_dukungan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dukungan`
--

LOCK TABLES `dukungan` WRITE;
/*!40000 ALTER TABLE `dukungan` DISABLE KEYS */;
/*!40000 ALTER TABLE `dukungan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `galery`
--

DROP TABLE IF EXISTS `galery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `galery` (
  `id_galery` int(6) NOT NULL AUTO_INCREMENT,
  `judul` varchar(100) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `publish` enum('Y','N') NOT NULL,
  `id_caleg` int(4) NOT NULL,
  PRIMARY KEY (`id_galery`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `galery`
--

LOCK TABLES `galery` WRITE;
/*!40000 ALTER TABLE `galery` DISABLE KEYS */;
INSERT INTO `galery` VALUES (1,'Kunjungan kerja','logo_pks.png','N',0);
/*!40000 ALTER TABLE `galery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jawaban`
--

DROP TABLE IF EXISTS `jawaban`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jawaban` (
  `id_jawaban` int(6) NOT NULL AUTO_INCREMENT,
  `id_survey` int(4) NOT NULL,
  `id_pertanyaan` int(6) NOT NULL,
  `id_caleg` int(4) NOT NULL,
  PRIMARY KEY (`id_jawaban`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jawaban`
--

LOCK TABLES `jawaban` WRITE;
/*!40000 ALTER TABLE `jawaban` DISABLE KEYS */;
/*!40000 ALTER TABLE `jawaban` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kabupaten`
--

DROP TABLE IF EXISTS `kabupaten`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kabupaten` (
  `id_kabupaten` int(4) NOT NULL AUTO_INCREMENT,
  `nama_kabupaten` varchar(100) NOT NULL,
  PRIMARY KEY (`id_kabupaten`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kabupaten`
--

LOCK TABLES `kabupaten` WRITE;
/*!40000 ALTER TABLE `kabupaten` DISABLE KEYS */;
INSERT INTO `kabupaten` VALUES (1,'Cirebon Kab'),(2,'Kota Cirebon'),(3,'Indramayu');
/*!40000 ALTER TABLE `kabupaten` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kecamatan`
--

DROP TABLE IF EXISTS `kecamatan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kecamatan` (
  `id_kecamatan` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_kecamatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `wilayah` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_kabupaten` int(4) NOT NULL,
  PRIMARY KEY (`id_kecamatan`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kecamatan`
--

LOCK TABLES `kecamatan` WRITE;
/*!40000 ALTER TABLE `kecamatan` DISABLE KEYS */;
INSERT INTO `kecamatan` VALUES (1,'Arjawinangun','<iframe width=\"600\" height=\"500\" id=\"gmap_canvas\" src=\"https://maps.google.com/maps?q=arjawinangun&t=&z=13&ie=UTF8&iwloc=&output=embed\" frameborder=\"0\" scrolling=\"no\" marginheight=\"0\" marginwidth=\"0\"></iframe>',1),(2,'Astanajapura','',1),(3,'Babakan','',1),(4,'Beber','',1),(5,'Ciledug Cirebon Timur','',1),(6,'Ciwaringin','',1),(7,'Depok','',1),(8,'Dukupuntang','',1),(9,'Gebang','',1),(10,'Gegesik','',1),(11,'Gempol','',1),(12,'Greged Greget','',1),(13,'Gunung Jati Cirebon Utara','',1),(14,'Jamblang','',1),(15,'Kaliwedi','',1),(16,'Kapetakan','',1),(17,'Karangsembung','',1),(18,'Karangwareng','',1),(19,'Kedawung Cirebon Barat','',1),(20,'Klangenan','',1),(21,'Lemahabang','',1),(22,'Losari','',1),(23,'Mundu','',1),(24,'Pabedilan','',1),(25,'Pabuaran','',1),(26,'Palimanan','',1),(27,'Pangenan','',1),(28,'Panguragan','',1),(29,'Pasaleman','',1),(30,'Plered','',1),(31,'Plumbon','',1),(32,'Sedong','',1),(33,'Sumber','',1),(34,'Suranenggala','',1),(35,'Susukan','',1),(36,'Susukan Lebak','',1),(37,'Talun Cirebon Selatan','',1),(38,'Tengah Tani','',1),(39,'Waled','',1),(40,'Weru','',1);
/*!40000 ALTER TABLE `kecamatan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `legislatif`
--

DROP TABLE IF EXISTS `legislatif`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `legislatif` (
  `id_legislatif` int(4) NOT NULL AUTO_INCREMENT,
  `nama_legislatif` varchar(100) NOT NULL,
  PRIMARY KEY (`id_legislatif`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `legislatif`
--

LOCK TABLES `legislatif` WRITE;
/*!40000 ALTER TABLE `legislatif` DISABLE KEYS */;
INSERT INTO `legislatif` VALUES (12,'DPRD'),(13,'DPD'),(14,'DPR RI');
/*!40000 ALTER TABLE `legislatif` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link`
--

DROP TABLE IF EXISTS `link`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `link` (
  `id_link` int(4) NOT NULL AUTO_INCREMENT,
  `url` text NOT NULL,
  `id_medsos` int(4) NOT NULL,
  `id_caleg` int(4) NOT NULL,
  PRIMARY KEY (`id_link`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `link`
--

LOCK TABLES `link` WRITE;
/*!40000 ALTER TABLE `link` DISABLE KEYS */;
/*!40000 ALTER TABLE `link` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medsos`
--

DROP TABLE IF EXISTS `medsos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `medsos` (
  `id_medsos` int(4) NOT NULL AUTO_INCREMENT,
  `id_caleg` int(4) NOT NULL,
  `nama_medsos` varchar(100) NOT NULL,
  `link_medsos` varchar(255) NOT NULL,
  `logo` varchar(100) NOT NULL,
  PRIMARY KEY (`id_medsos`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medsos`
--

LOCK TABLES `medsos` WRITE;
/*!40000 ALTER TABLE `medsos` DISABLE KEYS */;
INSERT INTO `medsos` VALUES (19,5,'PDIP 1','facebook.com','images/tZka78tNBVThHC6lXaTJFN9rEo5vbg1ESivXoCmW.jpg'),(20,5,'PDIP 2','','images/5KVHI7vGExoaPO6cNm1ZgVCi5aqz26wsKaM1yGfN.png'),(21,14,'PAN 1','','images/wb8Q9uDHCWakBBYaht9dEbCAyHDi5jwTJ371Rz0H.png'),(24,5,'PDIP Perjuangan Sejahtera','','images/eHDILd8ukjJcEWnMhoRM1W3qUbI8vCXzNmAPi3NS.jpg');
/*!40000 ALTER TABLE `medsos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `news` (
  `id_news` int(6) NOT NULL AUTO_INCREMENT,
  `judul` varchar(100) NOT NULL,
  `isi_berita` text NOT NULL,
  `tgl_publish` date NOT NULL,
  `id_caleg` int(4) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `aktif` enum('Y','N') NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id_news`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` VALUES (2,'Kebakaran Jenggo','Lorem ipsum, dolor sit amet consectetur adipi\r\nicing elit. Odio molestiae assumenda ut eaque vero quam. Cumque, veniam a enim asperiores ullam magnam atque eum possimus tempora dolor saepe maiores voluptates dolore ex consequuntur officia, sed eaque. Accusamus quae id ratione voluptatibus unde ipsam, illo rem nemo debitis ea velit libero tempore necessitatibus aliquam incidunt vel cupiditate, molestias eligendi commodi labore consectetur reprehenderit eos esse voluptatum? Saepe maiores aperiam, ducimus sequi doloremque nisi? Dicta nemo labore inventore dolores aut numquam quasi, consectetur doloremque neque nulla quod esse, reprehenderit cum maxime expedita exercitationem. Qui nulla amet enim saepe, itaque dignissimos vitae ullam consectetur expedita. Dolore nesciunt culpa quae laboriosam illum hic dicta autem itaque error dignissimos, vitae commodi fuga? Ea iusto atque mollitia odit sunt similique nam modi cumque laborum perferendis ducimus, sapiente facilis esse quisquam vitae tempora dolorum voluptas accusantium excepturi eveniet reprehenderit saepe ad. Dolore neque iste odit, eveniet, laboriosam culpa ab eligendi ex possimus omnis consequatur asperiores nulla dignissimos doloremque doloribus earum sit, dicta maxime cumque fugit! Dolore quod vero dicta aliquid et repellendus. Animi, voluptates. Vel nemo culpa officia blanditiis atque voluptates, laudantium ipsa distinctio architecto nesciunt enim pariatur rerum excepturi! Voluptatibus aliquid corrupti dicta. Repudiandae, rerum deserunt.','2022-09-07',5,'images/btEXdhJZftDedACKp0gdp4B8gsyPpci5sbKsw6Bz.jpg','N'),(3,'Program Kemenangan','Lorem','2022-09-09',7,'images/fXUrxuesgRNmDDVv29qvtbP7FUk68fXOhIxnPo7N.jpg','N'),(5,'PKS Membangun Negeri','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris scelerisque a sem quis pharetra. Donec auctor ut dui sed accumsan. Nulla eget ornare tellus. Praesent eget diam quam. Vivamus consectetur finibus massa, venenatis vulputate nulla iaculis in. Nulla nec urna eget quam lacinia maximus. Etiam id dolor enim. Suspendisse porttitor diam ac orci condimentum, nec varius orci pulvinar.\r\n\r\nPraesent rhoncus vestibulum velit vel pellentesque. Suspendisse potenti. Nam augue massa, facilisis vitae augue sit amet, semper venenatis sem. Praesent rutrum, sapien eu vulputate mollis, urna mauris dignissim nibh, a faucibus urna diam vel lectus. Donec ac dolor at nisi placerat condimentum. Nulla nulla ligula, tincidunt nec leo vel, semper maximus libero. Pellentesque id blandit nisi, et eleifend turpis. Nunc congue libero ligula, ut maximus ex pharetra sed. Quisque sagittis lacinia libero, sit amet varius nisl auctor ut. Nullam accumsan non enim sit amet scelerisque. Aliquam dictum ultricies blandit. Morbi at efficitur orci. Maecenas ac dolor dictum, aliquam libero non, congue lorem. Nulla lectus est, ultrices nec eleifend vitae, fermentum nec nibh.\r\n\r\nPhasellus eu placerat odio, eget consequat tellus. Donec sed elit a ligula aliquet egestas nec ac turpis. Vestibulum suscipit mauris ex, eu accumsan sem auctor sed. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cras pellentesque dignissim orci, at viverra odio aliquet eu. Interdum et malesuada fames ac ante ipsum primis in faucibus. Integer porta tristique lorem eget commodo. Morbi non nisl in sapien imperdiet finibus vitae vel sapien. Fusce aliquet quis risus in porttitor. Interdum et malesuada fames ac ante ipsum primis in faucibus. In viverra, odio sed aliquam porttitor, ex ligula lacinia dolor, vel feugiat tellus orci a arcu. Etiam egestas odio sit amet rutrum tincidunt.\r\n\r\nProin feugiat, diam in posuere tincidunt, elit metus imperdiet arcu, a volutpat turpis lorem sit amet nibh. Nullam lacinia metus ac semper laoreet. In suscipit erat risus, et pretium quam pulvinar non. In hac habitasse platea dictumst. Mauris lobortis egestas semper. Aliquam a placerat ipsum, sit amet consectetur quam. Phasellus molestie lectus sed ligula pellentesque, nec accumsan mauris volutpat. Sed nec mi nec nisl tristique tempus eu quis lorem. Nunc venenatis fringilla dolor nec cursus. Donec eget hendrerit nisl. Aenean ante orci, pulvinar ut ultrices quis, bibendum ut nunc. Proin vel iaculis tortor, sed porttitor tellus. Vivamus at enim et augue malesuada suscipit condimentum id augue. Proin purus tellus, facilisis vel cursus ut, dapibus vulputate massa.\r\n\r\nNam porta massa at dui tristique, a dapibus felis suscipit. Aliquam condimentum est nec velit viverra, non fermentum sem vestibulum. Vestibulum id lacinia sapien, tincidunt fermentum dui. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Quisque a mattis leo. Nunc pellentesque eget mauris sit amet luctus. Proin sollicitudin neque eu ligula porttitor, vitae fermentum lacus iaculis. Proin ultrices diam a neque feugiat, ac egestas metus euismod.','2022-09-14',6,'images/vhiZPov4ZOPKu37Bh34WrTBB6LNzgf9a01t420IW.png','N'),(7,'Gerindra Bisa','Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quod voluptatum corrupti, amet fuga voluptatem dolores officia beatae laboriosam tenetur quibusdam! Ad, sequi alias amet vero quos officiis illum fugit suscipit enim! Voluptas ut animi commodi asperiores ipsa corrupti suscipit hic accusamus. Obcaecati id quas minima libero nam maxime dolor, doloribus praesentium deleniti commodi ipsa velit illum autem quae, reprehenderit a corrupti! Praesentium illum quis vero, hic aliquam alias quidem nulla sapiente, ipsa architecto aperiam aspernatur molestias ex maiores quae minus. In magni sed ducimus voluptate iste voluptatum fugit laborum repellat fugiat recusandae, veniam neque ipsam at error expedita explicabo dolorem!','2022-09-14',7,'images/iTJshxAOpF6bM7IV4jXXiP4nlW6TAGet0ggadO6R.jpg','N');
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `partai`
--

DROP TABLE IF EXISTS `partai`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `partai` (
  `id_partai` int(4) NOT NULL AUTO_INCREMENT,
  `nama_partai` varchar(100) NOT NULL,
  `no_urut` int(4) NOT NULL,
  `warna` varchar(50) NOT NULL,
  `logo` varchar(100) NOT NULL,
  PRIMARY KEY (`id_partai`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `partai`
--

LOCK TABLES `partai` WRITE;
/*!40000 ALTER TABLE `partai` DISABLE KEYS */;
INSERT INTO `partai` VALUES (19,'PDIP',1,'#ff0000','images/qOdfoHNxwodiVAyp06gqaSp4ms9pwYaBIRWZTdis.png'),(20,'PKS',2,'#f76c22','images/nr0Zq6wQHmWZpopborj4sEujm5UEmVlXATn41wlw.png'),(21,'Gerindra',3,'#ffdd00','images/S2dSN7Md423VPz0FGVTmQFvK0Uw7WZgJGHfAVf0u.jpg'),(22,'Golkar',4,'#fff71a','images/wraf8RPfOnsRnwxxUvqY9Lk3cVaTIfrUPJ9GQZJD.png'),(23,'PKB',5,'#00e608','images/E9CSfOOeysCJVFg5si4qqXrkfs5sv6HmFpoghCWz.png'),(24,'Nasional Demokrat',6,'#0015b3','images/8SMliy9CRCnXK5Oknl3cB5VemUROVjJVOshMpu0f.png'),(25,'Berkarya',7,'#f3ff4d','images/V3Y74XsV4O4Uy1NdGem1cUv9o2F5F53gVnzC3xlh.png'),(26,'Perindo',8,'#1a40ff','images/3KZDUmjZxw9dhODrYL9HH4hqeChfH9bx26TVPLis.jpg'),(27,'Persatuan Pembangunan',9,'#00b806','images/BBUler6ET5GM4chOxoU0nu6vtU215WFqh0fMpSDW.png'),(28,'Amanat Nasional',10,'#0010f0','images/ihnTO2lCcYX6vZgPwzH7XHV8KJaBHXQUOIZefqTc.png');
/*!40000 ALTER TABLE `partai` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pertanyaan`
--

DROP TABLE IF EXISTS `pertanyaan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pertanyaan` (
  `id_pertanyaan` int(6) NOT NULL AUTO_INCREMENT,
  `nama_pertanyaan` text NOT NULL,
  `id_variabel` int(4) NOT NULL,
  PRIMARY KEY (`id_pertanyaan`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pertanyaan`
--

LOCK TABLES `pertanyaan` WRITE;
/*!40000 ALTER TABLE `pertanyaan` DISABLE KEYS */;
INSERT INTO `pertanyaan` VALUES (1,'Apakah anda mengenal caleg dengan nama diatas',1),(2,'Menurut anda jika beliau terplih anda mewakili aspirasi anda ',1);
/*!40000 ALTER TABLE `pertanyaan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pesan`
--

DROP TABLE IF EXISTS `pesan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pesan` (
  `id_pesan` int(6) NOT NULL AUTO_INCREMENT,
  `pesan` text NOT NULL,
  `aktif` enum('Y','N') NOT NULL DEFAULT 'N',
  `tanggal` date NOT NULL,
  PRIMARY KEY (`id_pesan`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pesan`
--

LOCK TABLES `pesan` WRITE;
/*!40000 ALTER TABLE `pesan` DISABLE KEYS */;
INSERT INTO `pesan` VALUES (2,'Selamat bergabung ya','Y','2022-06-07'),(3,'Selamat Lebaran ya...','N','2022-06-07'),(4,'Selamat hari jadi PKS Ya... kawan','N','2022-06-07');
/*!40000 ALTER TABLE `pesan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `program`
--

DROP TABLE IF EXISTS `program`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `program` (
  `id_program` int(4) NOT NULL AUTO_INCREMENT,
  `id_caleg` int(4) NOT NULL,
  `judul_program` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `foto` varchar(100) NOT NULL,
  PRIMARY KEY (`id_program`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `program`
--

LOCK TABLES `program` WRITE;
/*!40000 ALTER TABLE `program` DISABLE KEYS */;
INSERT INTO `program` VALUES (2,5,'Serangan Fajar','Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus iusto vel ullam? Laboriosam, nostrum cupiditate aspernatur accusamus explicabo architecto excepturi dolores omnis deleniti cumque, natus maiores ullam quos odio corrupti dignissimos consequuntur eligendi. Vel tenetur id veritatis optio molestiae dignissimos natus magnam, placeat eveniet! Ipsam, quibusdam fugiat commodi ullam porro veritatis eveniet minus exercitationem hic eius nam impedit, enim velit consectetur, accusamus placeat provident cum voluptatibus. Consectetur nesciunt aperiam omnis. At repellat sunt rem aliquam dignissimos, provident ducimus numquam officia, non deserunt ut labore neque? At, soluta modi maxime nesciunt, a commodi veniam iure libero iste, fuga natus quam minus.','images/hhlpVQC2FviWT5Ymu2Rm7lYKCgtRQSUB5pl7sBrG.png');
/*!40000 ALTER TABLE `program` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `relawan`
--

DROP TABLE IF EXISTS `relawan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `relawan` (
  `id_relawan` int(6) NOT NULL AUTO_INCREMENT,
  `nik` varchar(50) NOT NULL,
  `nama_relawan` varchar(100) NOT NULL,
  `jabatan` enum('0','1','2') NOT NULL DEFAULT '0',
  `upline` int(11) NOT NULL DEFAULT 1,
  `id_desa` int(6) NOT NULL,
  `saksi` enum('Y','N') NOT NULL DEFAULT 'N',
  `foto_ktp` varchar(100) NOT NULL,
  `id_caleg` int(4) NOT NULL,
  `status` enum('1','2','3') NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `loyalis` enum('1','2','3') NOT NULL DEFAULT '1',
  `blokir` enum('Y','N') NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id_relawan`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `relawan`
--

LOCK TABLES `relawan` WRITE;
/*!40000 ALTER TABLE `relawan` DISABLE KEYS */;
INSERT INTO `relawan` VALUES (5,'123456789','Iqro Negoro','0',1,1,'N','images/cU9vf4yzNOZHjP6UzCZh68AzgtKvwqiR7nUqx3Ea.png',5,'1','08978405369','iqronegoro0@gmail.com','iqronegoro','$2y$10$qpjjh1vZ85.Md8kuPgm2Q.ZMbPZ3sPddITYx4zEJ1IyDV0chzLSgK','3','N'),(7,'2147483647','Ibnu Syawal Aliefian','0',1,43,'N','images/fXQPHJ3xVdJI55Y1TYXiAaEaPHLql3lH14UCVb3l.png',5,'1','082162941198','superglidingogre0571@gmail.com','ibnusyawalaliefian','$2y$10$00LUY8y2EBaJIki1obRnXuk6V0rgIbOxAt0vrakf1lFX8hhD3xfAu','1','N'),(14,'342342352345','Alwan','0',1,1,'N','images/A8lW3aC2j7coplcnrrsV9NLl3f39s9uWWxp0i4Rf.png',5,'1','087869607882','alwanrabbae@gmail.com','alwan','$2y$10$Iwrh35dw9I9wc/x05CDvOOwIWX5ysZtztbqPthJd4DXfwQIf3usyO','1','N');
/*!40000 ALTER TABLE `relawan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rk_bank`
--

DROP TABLE IF EXISTS `rk_bank`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rk_bank` (
  `id_bank` int(11) NOT NULL AUTO_INCREMENT,
  `nama_bank` varchar(255) NOT NULL,
  `nomor_bank` varchar(255) NOT NULL,
  `pemilik_bank` varchar(255) NOT NULL,
  `saldo_bank` bigint(20) NOT NULL,
  PRIMARY KEY (`id_bank`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rk_bank`
--

LOCK TABLES `rk_bank` WRITE;
/*!40000 ALTER TABLE `rk_bank` DISABLE KEYS */;
INSERT INTO `rk_bank` VALUES (16,'BRI Syariah','001','An Upin',0),(22,'KAS TEAM PEMENANGAN','002','an. Susanti',0);
/*!40000 ALTER TABLE `rk_bank` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rk_kategori`
--

DROP TABLE IF EXISTS `rk_kategori`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rk_kategori` (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `kode_kategori` int(6) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `jenis_transaksi` varchar(25) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rk_kategori`
--

LOCK TABLES `rk_kategori` WRITE;
/*!40000 ALTER TABLE `rk_kategori` DISABLE KEYS */;
INSERT INTO `rk_kategori` VALUES (1,100,'Donasi Relawan','Pemasukan'),(2,101,'Bantuan Partai','Pemasukan'),(3,103,'Donasi caleg','Pemasukan'),(4,151,'Biaya Spanduk','Pengeluaran'),(5,152,'Transport rapat relawan','Pengeluaran');
/*!40000 ALTER TABLE `rk_kategori` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rk_pemilih`
--

DROP TABLE IF EXISTS `rk_pemilih`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rk_pemilih` (
  `id_pemilih` int(15) NOT NULL AUTO_INCREMENT,
  `id_caleg` int(4) NOT NULL,
  `nik` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jk` varchar(10) NOT NULL,
  `tps` int(4) NOT NULL,
  `id_desa` int(4) NOT NULL,
  `relawan` enum('Y','T') NOT NULL,
  `saksi` enum('Y','T') NOT NULL,
  `tgl_data` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_users` int(4) NOT NULL,
  PRIMARY KEY (`id_pemilih`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rk_pemilih`
--

LOCK TABLES `rk_pemilih` WRITE;
/*!40000 ALTER TABLE `rk_pemilih` DISABLE KEYS */;
INSERT INTO `rk_pemilih` VALUES (55,5,'4327841','Iqro Negoro','Cirebon, Jawa Barat, Indonesia','2022-09-08','Laki-Laki',121213,1,'Y','Y','2022-09-08 04:00:42',24),(56,7,'9876543210','Erik','Bandung, Indonesia','2022-09-08','Laki-Laki',545454,32,'T','Y','2022-09-08 04:01:36',25),(57,9,'98765432102','Ibnu Syawal Aliefian','Cirebon, Jawa Barat, Indonesia','2022-09-16','Laki-Laki',33443,332,'Y','Y','2022-09-08 04:02:32',25),(58,8,'643912','Bilqis','Cirebon, Jawa Barat, Indonesia','2022-09-19','Perempuan',23122534,44,'Y','Y','2022-09-08 04:03:46',24),(59,10,'12345678','Aqilah','Quisquam omnis facil','2022-09-08','Perempuan',6768,1,'T','T','2022-09-08 04:05:03',24),(63,6,'012834018234','Erik De','Cirebon12II1312K123','2022-09-16','Perempuan',12,33,'T','T','2022-09-08 07:49:16',25),(64,6,'234413254563','Iqro Negoro','Cirebon, Jawa Barat, Indonesia','2022-09-09','Laki-Laki',12,1,'Y','Y','2022-09-09 11:24:14',25),(65,5,'43278411238102','Nadila Vira','Bandung, Indonesia','2022-09-09','Perempuan',32,44,'Y','Y','2022-09-09 11:32:41',25),(66,5,'2147483647','Ibnu Syawal Aliefian','Cirebon, Jawa Barat, Indonesia','2022-09-17','Laki-Laki',2,1,'Y','Y','2022-09-10 02:11:34',25),(67,5,'9876543210','Negro','Bandung, Indonesia','2022-09-10','Laki-Laki',21,450,'Y','Y','2022-09-10 02:16:28',25);
/*!40000 ALTER TABLE `rk_pemilih` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rk_transaksi`
--

DROP TABLE IF EXISTS `rk_transaksi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rk_transaksi` (
  `id_transaksi` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_transaksi` date NOT NULL,
  `jenis_transaksi` enum('Pengeluaran','Pemasukan') NOT NULL,
  `id_kategori` int(4) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `id_bank` int(4) NOT NULL,
  `id_users` int(4) NOT NULL DEFAULT 107,
  `create_data` datetime NOT NULL DEFAULT current_timestamp(),
  `hutang` int(6) NOT NULL,
  `bayar_hutang` int(6) NOT NULL,
  `penggajian` int(6) NOT NULL,
  `alumni` int(6) NOT NULL,
  `siswa` int(6) NOT NULL,
  PRIMARY KEY (`id_transaksi`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rk_transaksi`
--

LOCK TABLES `rk_transaksi` WRITE;
/*!40000 ALTER TABLE `rk_transaksi` DISABLE KEYS */;
INSERT INTO `rk_transaksi` VALUES (1,'2022-04-11','Pemasukan',3,2000000,'donasi Ibu Netty',22,107,'2022-04-11 13:35:30',0,0,0,0,0);
/*!40000 ALTER TABLE `rk_transaksi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `saksi`
--

DROP TABLE IF EXISTS `saksi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `saksi` (
  `id_saksi` int(11) NOT NULL AUTO_INCREMENT,
  `nama_relawan` varchar(255) NOT NULL,
  `id_caleg` int(11) NOT NULL,
  PRIMARY KEY (`id_saksi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `saksi`
--

LOCK TABLES `saksi` WRITE;
/*!40000 ALTER TABLE `saksi` DISABLE KEYS */;
/*!40000 ALTER TABLE `saksi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `survey`
--

DROP TABLE IF EXISTS `survey`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `survey` (
  `id_survey` int(6) NOT NULL AUTO_INCREMENT,
  `nama_survey` varchar(100) NOT NULL,
  `mulai_tanggal` date NOT NULL,
  `sampai_tanggal` date NOT NULL,
  `id_caleg` int(4) NOT NULL,
  `id_variabel` int(4) NOT NULL,
  PRIMARY KEY (`id_survey`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `survey`
--

LOCK TABLES `survey` WRITE;
/*!40000 ALTER TABLE `survey` DISABLE KEYS */;
INSERT INTO `survey` VALUES (3,'Survey Gedung','2022-08-29','2022-08-30',5,1),(4,'Survey Tempat Partai','2022-09-09','2022-09-15',7,1),(5,'Survey Alat Partai','2022-09-14','2022-09-15',6,1);
/*!40000 ALTER TABLE `survey` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `temp`
--

DROP TABLE IF EXISTS `temp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `temp` (
  `id_temp` int(6) NOT NULL AUTO_INCREMENT,
  `id_kabupaten` int(4) NOT NULL,
  `id_dapil` varchar(6) NOT NULL,
  PRIMARY KEY (`id_temp`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `temp`
--

LOCK TABLES `temp` WRITE;
/*!40000 ALTER TABLE `temp` DISABLE KEYS */;
INSERT INTO `temp` VALUES (8,1,'99'),(9,1,'99'),(10,2,'99'),(11,3,'99');
/*!40000 ALTER TABLE `temp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id_users` int(4) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `nama_lengkap` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `no_telp` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `level` varchar(20) COLLATE latin1_general_ci NOT NULL DEFAULT 'user',
  `blokir` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `warna` varchar(50) COLLATE latin1_general_ci NOT NULL DEFAULT '#4e73df',
  `id_session` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `foto_user` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `reset_token` varchar(100) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_users`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (24,'finance','21232f297a57a5a743894a0e4a801fc3','ical calita','csjagatgenius@gmail.com','0231 8897789','admin','N','#4e73df','d41d8cd98f00b204e9800998ecf8427e-20210801192823','marketing1.jpg',''),(25,'admin','$2y$10$cRv0cd2QYmUNJdrIYhna3.69FwKbDNoIVLoQNi8RXEjJ6oC2IMQwO','Iqro Negoro','iqronegoro0@gmail.com','08978405369','superadmin','N','#4e73df','9srQyIO5LSt0AosV6ZfSSApCoXbzIO73ib87TkjaW6z8WLYKIlfh02URTf4O','images/Vdba33qATA5WsOh8oXciQen5dwBXX3Z1k4AWgU3p.jpg','JjsGn0F34BnY2zpyD34KDDdchPtEwjH3TPtyiup3GgX6mQpLixEe8ECu8bBg');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `variabel`
--

DROP TABLE IF EXISTS `variabel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `variabel` (
  `id_variabel` int(4) NOT NULL AUTO_INCREMENT,
  `id_caleg` int(4) NOT NULL,
  `nama_variabel` varchar(100) NOT NULL,
  PRIMARY KEY (`id_variabel`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `variabel`
--

LOCK TABLES `variabel` WRITE;
/*!40000 ALTER TABLE `variabel` DISABLE KEYS */;
INSERT INTO `variabel` VALUES (1,5,'Survey Awal Caleg'),(4,6,'Survey Gedung');
/*!40000 ALTER TABLE `variabel` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-09-23 22:16:12
