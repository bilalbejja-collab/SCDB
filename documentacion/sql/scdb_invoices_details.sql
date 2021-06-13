-- MySQL dump 10.13  Distrib 8.0.20, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: scdb
-- ------------------------------------------------------
-- Server version	8.0.20

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `invoices_details`
--

DROP TABLE IF EXISTS `invoices_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `invoices_details` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `invoice_id` bigint unsigned NOT NULL,
  `invoice_number` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `section` varchar(999) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value_status` int NOT NULL,
  `payment_date` date DEFAULT NULL,
  `remaining_amount` decimal(8,2) DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `user` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `invoices_details_invoice_id_foreign` (`invoice_id`),
  CONSTRAINT `invoices_details_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoices_details`
--

LOCK TABLES `invoices_details` WRITE;
/*!40000 ALTER TABLE `invoices_details` DISABLE KEYS */;
INSERT INTO `invoices_details` VALUES (1,25,'FACT13','PREST2','2','no pagada',2,NULL,NULL,NULL,'bilalbejja','2021-06-06 16:28:41','2021-06-06 16:28:41'),(11,25,'FACT13','PREST2','2','pagada parcialmente',3,'2021-06-06',500.00,NULL,'bilalbejja','2021-06-06 17:03:22','2021-06-06 17:03:22'),(12,25,'FACT13','PREST2','2','pagada parcialmente',3,'2021-06-06',-100.00,NULL,'bilalbejja','2021-06-06 17:04:09','2021-06-06 17:04:09'),(13,26,'FACT14','PREST1','1','no pagada',2,NULL,NULL,NULL,'bilalbejja','2021-06-06 17:18:48','2021-06-06 17:18:48'),(14,26,'FACT14','PREST1','1','pagada parcialmente',3,'2021-06-06',1500.00,NULL,'bilalbejja','2021-06-06 17:20:19','2021-06-06 17:20:19'),(16,26,'FACT14','PREST1','1','pagada parcialmente',3,'2021-06-06',0.00,NULL,'bilalbejja','2021-06-06 17:24:39','2021-06-06 17:24:39'),(17,26,'FACT14','PREST1','1','pagada parcialmente',3,'2021-06-06',0.00,NULL,'bilalbejja','2021-06-06 17:25:25','2021-06-06 17:25:25'),(18,26,'FACT14','PREST1','1','pagada parcialmente',3,'2021-06-06',0.00,NULL,'bilalbejja','2021-06-06 17:25:50','2021-06-06 17:25:50'),(19,26,'FACT14','PREST1','1','pagada parcialmente',3,'2021-06-06',0.00,NULL,'bilalbejja','2021-06-06 17:26:35','2021-06-06 17:26:35'),(20,26,'FACT14','PREST1','1','pagada parcialmente',3,'2021-06-06',0.00,NULL,'bilalbejja','2021-06-06 17:26:55','2021-06-06 17:26:55'),(21,26,'FACT14','PREST1','1','pagada parcialmente',3,'2021-06-06',0.00,NULL,'bilalbejja','2021-06-06 17:27:43','2021-06-06 17:27:43'),(22,26,'FACT14','PREST1','1','pagada parcialmente',3,'2021-06-06',0.00,NULL,'bilalbejja','2021-06-06 17:27:59','2021-06-06 17:27:59'),(23,26,'FACT14','PREST1','1','pagada parcialmente',3,'2021-06-06',0.00,NULL,'bilalbejja','2021-06-06 17:28:06','2021-06-06 17:28:06'),(24,27,'FACT20','PREST3','3','no pagada',2,NULL,NULL,NULL,'bilalbejja','2021-06-06 17:30:22','2021-06-06 17:30:22'),(25,27,'FACT20','PREST3','3','pagada parcialmente',3,'2021-06-06',100.00,NULL,'bilalbejja','2021-06-06 17:30:58','2021-06-06 17:30:58'),(26,27,'FACT20','PREST3','3','pagada parcialmente',3,'2021-06-06',0.00,NULL,'bilalbejja','2021-06-06 17:31:39','2021-06-06 17:31:39'),(27,27,'FACT20','PREST3','3','pagada parcialmente',3,'2021-06-06',0.00,NULL,'bilalbejja','2021-06-06 17:33:43','2021-06-06 17:33:43'),(28,27,'FACT20','PREST3','3','pagada parcialmente',2,'2021-06-06',0.00,NULL,'bilalbejja','2021-06-06 17:33:43','2021-06-06 17:33:43'),(29,28,'FACT15','PREST4','4','no pagada',2,NULL,NULL,NULL,'bilalbejja','2021-06-06 17:35:04','2021-06-06 17:35:04'),(30,28,'FACT15','PREST4','4','pagada parcialmente',3,'2021-06-06',100.00,NULL,'bilalbejja','2021-06-06 17:35:47','2021-06-06 17:35:47'),(31,28,'FACT15','PREST4','4','pagada',2,'2021-06-06',0.00,NULL,'bilalbejja','2021-06-06 17:35:47','2021-06-06 17:35:47'),(32,29,'FACT17','PREST4','4','no pagada',2,NULL,NULL,NULL,'bilalbejja','2021-06-06 17:39:17','2021-06-06 17:39:17'),(33,29,'FACT17','PREST4','4','pagada parcialmente',3,'2021-06-06',600.00,NULL,'bilalbejja','2021-06-06 17:39:53','2021-06-06 17:39:53'),(34,29,'FACT17','PREST4','4','pagada parcialmente',3,'2021-06-06',200.00,NULL,'bilalbejja','2021-06-06 17:40:28','2021-06-06 17:40:28'),(35,29,'FACT17','PREST4','4','pagada parcialmente',3,'2021-06-06',0.00,NULL,'bilalbejja','2021-06-06 17:41:20','2021-06-06 17:41:20'),(36,29,'FACT17','PREST4','4','pagada parcialmente',3,'2021-06-06',0.00,NULL,'bilalbejja','2021-06-06 17:42:23','2021-06-06 17:42:23'),(37,29,'FACT17','PREST4','4','pagada',2,'2021-06-06',0.00,NULL,'bilalbejja','2021-06-06 17:42:23','2021-06-06 17:42:23'),(38,30,'FACT19','PREST6','6','no pagada',2,NULL,NULL,NULL,'bilalbejja','2021-06-06 17:45:00','2021-06-06 17:45:00'),(39,30,'FACT19','PREST6','6','pagada parcialmente',3,'2021-06-06',5710.00,NULL,'bilalbejja','2021-06-06 17:46:20','2021-06-06 17:46:20'),(40,30,'FACT19','PREST6','6','pagada parcialmente',3,'2021-06-06',1710.00,NULL,'bilalbejja','2021-06-06 17:47:13','2021-06-06 17:47:13'),(41,30,'FACT19','PREST6','6','pagada parcialmente',3,'2021-06-06',0.00,NULL,'bilalbejja','2021-06-06 17:48:16','2021-06-06 17:48:16'),(42,30,'FACT19','PREST6','6','pagada',2,'2021-06-06',0.00,NULL,'bilalbejja','2021-06-06 17:53:49','2021-06-06 17:53:49'),(43,31,'FACT21','PREST4','4','no pagada',2,NULL,NULL,NULL,'bilalbejja','2021-06-06 17:56:30','2021-06-06 17:56:30'),(44,31,'FACT21','PREST4','4','pagada parcialmente',3,'2021-06-06',550.00,NULL,'bilalbejja','2021-06-06 17:57:00','2021-06-06 17:57:00'),(45,31,'FACT21','PREST4','4','pagada parcialmente',3,'2021-06-06',350.00,NULL,'bilalbejja','2021-06-06 17:57:32','2021-06-06 17:57:32'),(47,31,'FACT21','PREST4','4','pagada parcialmente',3,'2021-06-06',0.00,NULL,'bilalbejja','2021-06-06 18:00:11','2021-06-06 18:00:11'),(48,32,'FACT22','PREST4','4','no pagada',2,NULL,NULL,NULL,'bilalbejja','2021-06-06 18:09:19','2021-06-06 18:09:19'),(76,32,'FACT22','PREST4','4','pagada parcialmente',3,'2021-06-06',260.00,NULL,'bilalbejja','2021-06-06 19:21:14','2021-06-06 19:21:14'),(77,32,'FACT22','PREST4','4','pagada',1,'2021-06-06',0.00,NULL,'bilalbejja','2021-06-06 19:21:35','2021-06-06 19:21:35'),(78,33,'FACT23','PREST1','1','no pagada',2,NULL,NULL,NULL,'bilalbejja','2021-06-07 09:15:13','2021-06-07 09:15:13'),(79,33,'FACT23','PREST1','1','pagada parcialmente',3,'2021-06-07',260.00,NULL,'bilalbejja','2021-06-07 09:33:26','2021-06-07 09:33:26'),(80,33,'FACT23','PREST1','1','pagada',1,'2021-06-07',0.00,NULL,'bilalbejja','2021-06-07 09:34:02','2021-06-07 09:34:02'),(81,34,'FACT30','PREST2','2','no pagada',2,NULL,NULL,NULL,'bilalbejja','2021-06-07 21:10:26','2021-06-07 21:10:26'),(82,34,'FACT30','PREST2','2','pagada',1,'2021-06-09',0.00,NULL,'bilalbejja','2021-06-07 21:11:50','2021-06-07 21:11:50'),(83,35,'FACT40','PREST2','2','no pagada',2,NULL,NULL,NULL,'bilalbejja','2021-06-08 13:01:34','2021-06-08 13:01:34'),(84,36,'FACT41','PREST2','2','no pagada',2,NULL,NULL,NULL,'bilalbejja','2021-06-09 21:18:57','2021-06-09 21:18:57');
/*!40000 ALTER TABLE `invoices_details` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-06-13 22:26:29
