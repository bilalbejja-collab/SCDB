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
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint unsigned NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES ('014c7126-4835-4702-b5ff-71f81637b3a4','App\\Notifications\\NewInvoice','App\\User',1,'{\"id\":29,\"title\":\"Se ha a\\u00f1adido nueva factura por: \",\"user\":\"bilalbejja\"}','2021-06-06 17:40:06','2021-06-06 17:39:17','2021-06-06 17:40:06'),('0cf0ec88-96a0-45ee-b43f-49db610ba132','App\\Notifications\\NewInvoice','App\\User',1,'{\"id\":36,\"title\":\"Se ha a\\u00f1adido nueva factura por: \",\"user\":\"bilalbejja\"}',NULL,'2021-06-09 21:18:57','2021-06-09 21:18:57'),('0d483ff6-ca83-48d0-8d7f-4d7e5028a62c','App\\Notifications\\NewInvoice','App\\User',1,'{\"id\":11,\"title\":\"Se ha a\\u00f1adido nueva factura por: \",\"user\":\"bilalbejja\"}','2021-06-03 15:57:58','2021-06-03 15:47:05','2021-06-03 15:57:58'),('17944817-3e8b-4b82-9473-03366c768d03','App\\Notifications\\NewInvoice','App\\User',1,'{\"id\":23,\"title\":\"Se ha a\\u00f1adido nueva factura por: \",\"user\":\"bilalbejja\"}','2021-06-05 15:00:46','2021-06-05 15:00:33','2021-06-05 15:00:46'),('1b373f51-c2bf-4914-8b09-82615e956f48','App\\Notifications\\NewInvoice','App\\User',1,'{\"id\":17,\"title\":\"Se ha a\\u00f1adido nueva factura por: \",\"user\":\"bilalbejja\"}','2021-06-05 21:38:39','2021-06-05 10:30:17','2021-06-05 21:38:39'),('28e2ec76-e1a2-492d-a3f1-0a09ec9bc0ac','App\\Notifications\\NewInvoice','App\\User',1,'{\"id\":16,\"title\":\"Se ha a\\u00f1adido nueva factura por: \",\"user\":\"bilalbejja\"}','2021-06-05 13:02:43','2021-06-04 21:57:41','2021-06-05 13:02:43'),('2c6ad3c1-229a-4b83-9e9d-c8ee7ce4cb60','App\\Notifications\\NewInvoice','App\\User',1,'{\"id\":26,\"title\":\"Se ha a\\u00f1adido nueva factura por: \",\"user\":\"bilalbejja\"}','2021-06-06 17:22:16','2021-06-06 17:18:48','2021-06-06 17:22:16'),('3b21045e-3978-4bc9-9878-42753cb03fca','App\\Notifications\\NewInvoice','App\\User',1,'{\"id\":27,\"title\":\"Se ha a\\u00f1adido nueva factura por: \",\"user\":\"bilalbejja\"}','2021-06-06 17:31:06','2021-06-06 17:30:22','2021-06-06 17:31:06'),('3c8c8fea-d78f-4e7e-a670-ad80376e15f5','App\\Notifications\\NewInvoice','App\\User',1,'{\"id\":28,\"title\":\"Se ha a\\u00f1adido nueva factura por: \",\"user\":\"bilalbejja\"}','2021-06-06 17:36:00','2021-06-06 17:35:04','2021-06-06 17:36:00'),('5eebeda0-0a82-41e0-a566-1a803a4d5128','App\\Notifications\\NewInvoice','App\\User',1,'{\"id\":9,\"title\":\"Se ha a\\u00f1adido nueva factura por: \",\"user\":\"bilal\"}','2021-06-02 22:20:48','2021-06-02 22:19:36','2021-06-02 22:20:48'),('735772ad-cd88-4022-a802-b932935b2316','App\\Notifications\\NewInvoice','App\\User',1,'{\"id\":34,\"title\":\"Se ha a\\u00f1adido nueva factura por: \",\"user\":\"bilalbejja\"}','2021-06-07 21:10:43','2021-06-07 21:10:26','2021-06-07 21:10:43'),('7939161e-dfaf-40a1-846f-8af6d9316dc7','App\\Notifications\\NewInvoice','App\\User',1,'{\"id\":12,\"title\":\"Se ha a\\u00f1adido nueva factura por: \",\"user\":\"bilalbejja\"}','2021-06-03 16:06:50','2021-06-03 16:06:00','2021-06-03 16:06:50'),('7bf44609-f022-463c-af7e-fc826ffc76a9','App\\Notifications\\NewInvoice','App\\User',1,'{\"id\":32,\"title\":\"Se ha a\\u00f1adido nueva factura por: \",\"user\":\"bilalbejja\"}','2021-06-06 18:10:33','2021-06-06 18:09:19','2021-06-06 18:10:33'),('7d150b55-786d-4592-84ca-0443a88a41ca','App\\Notifications\\NewInvoice','App\\User',1,'{\"id\":19,\"title\":\"Se ha a\\u00f1adido nueva factura por: \",\"user\":\"bilalbejja\"}','2021-06-05 14:44:35','2021-06-05 14:44:20','2021-06-05 14:44:35'),('83a1fc24-150f-4939-b1d7-ed7989d59e05','App\\Notifications\\NewInvoice','App\\User',1,'{\"id\":8,\"title\":\"Se ha a\\u00f1adido nueva factura por: \",\"user\":\"bilal\"}','2021-06-02 22:15:10','2021-06-02 22:09:39','2021-06-02 22:15:10'),('9d72b200-ac13-4034-b113-0ba429e99489','App\\Notifications\\NewInvoice','App\\User',1,'{\"id\":25,\"title\":\"Se ha a\\u00f1adido nueva factura por: \",\"user\":\"bilalbejja\"}','2021-06-06 16:29:37','2021-06-06 16:28:41','2021-06-06 16:29:37'),('9d9c3782-785f-4856-a548-5995a01400e5','App\\Notifications\\NewInvoice','App\\User',1,'{\"id\":10,\"title\":\"Se ha a\\u00f1adido nueva factura por: \",\"user\":\"bilal\"}','2021-06-03 15:54:03','2021-06-02 22:22:33','2021-06-03 15:54:03'),('afd597f0-2bd8-4dc8-998a-7ace1109db75','App\\Notifications\\NewInvoice','App\\User',1,'{\"id\":21,\"title\":\"Se ha a\\u00f1adido nueva factura por: \",\"user\":\"bilalbejja\"}','2021-06-05 14:52:17','2021-06-05 14:52:08','2021-06-05 14:52:17'),('b3b4b988-d2b3-407c-ab6b-904763edb725','App\\Notifications\\NewInvoice','App\\User',1,'{\"id\":35,\"title\":\"Se ha a\\u00f1adido nueva factura por: \",\"user\":\"bilalbejja\"}','2021-06-08 13:04:45','2021-06-08 13:01:34','2021-06-08 13:04:45'),('bb697597-f1e2-487e-afc7-c5b5c5860e1c','App\\Notifications\\NewInvoice','App\\User',1,'{\"id\":20,\"title\":\"Se ha a\\u00f1adido nueva factura por: \",\"user\":\"bilalbejja\"}','2021-06-05 14:48:11','2021-06-05 14:47:58','2021-06-05 14:48:11'),('be8d65de-f76c-4f6c-b21a-bf35ee362566','App\\Notifications\\NewInvoice','App\\User',1,'{\"id\":24,\"title\":\"Se ha a\\u00f1adido nueva factura por: \",\"user\":\"bilalbejja\"}','2021-06-05 20:32:54','2021-06-05 20:32:32','2021-06-05 20:32:54'),('bed59f88-6e6e-4950-b795-4a494964aad4','App\\Notifications\\NewInvoice','App\\User',1,'{\"id\":15,\"title\":\"Se ha a\\u00f1adido nueva factura por: \",\"user\":\"bilalbejja\"}','2021-06-05 14:36:00','2021-06-04 21:57:18','2021-06-05 14:36:00'),('bfba6f7b-0c4d-493d-af73-c96379af636a','App\\Notifications\\NewInvoice','App\\User',1,'{\"id\":31,\"title\":\"Se ha a\\u00f1adido nueva factura por: \",\"user\":\"bilalbejja\"}','2021-06-06 17:57:43','2021-06-06 17:56:30','2021-06-06 17:57:43'),('c4125e56-0aac-45f4-91d6-341285830301','App\\Notifications\\NewInvoice','App\\User',1,'{\"id\":30,\"title\":\"Se ha a\\u00f1adido nueva factura por: \",\"user\":\"bilalbejja\"}','2021-06-06 17:46:33','2021-06-06 17:45:00','2021-06-06 17:46:33'),('c5b519b7-8e08-4365-a8d2-13cd3a4316b4','App\\Notifications\\NewInvoice','App\\User',1,'{\"id\":5,\"title\":\"Se ha a\\u00f1adido nueva factura por: \",\"user\":\"bilalbejja\"}','2021-06-01 21:31:29','2021-06-01 16:22:34','2021-06-01 21:31:29'),('d4991d89-ba8b-4d76-af67-934f0561fff3','App\\Notifications\\NewInvoice','App\\User',1,'{\"id\":6,\"title\":\"Se ha a\\u00f1adido nueva factura por: \",\"user\":\"bilal\"}','2021-06-02 22:02:39','2021-06-02 21:59:05','2021-06-02 22:02:39'),('e6c22dbb-695b-481b-a25a-e3da45c9bb01','App\\Notifications\\NewInvoice','App\\User',1,'{\"id\":14,\"title\":\"Se ha a\\u00f1adido nueva factura por: \",\"user\":\"bilalbejja\"}','2021-06-05 13:17:32','2021-06-04 21:40:30','2021-06-05 13:17:32'),('e9dd94ac-9508-42d1-a763-554eaeb77519','App\\Notifications\\NewInvoice','App\\User',1,'{\"id\":18,\"title\":\"Se ha a\\u00f1adido nueva factura por: \",\"user\":\"bilalbejja\"}','2021-06-08 21:32:38','2021-06-05 10:33:09','2021-06-08 21:32:38'),('ee36b85b-25e7-4fb7-8b17-66a3c274b3c5','App\\Notifications\\NewInvoice','App\\User',1,'{\"id\":22,\"title\":\"Se ha a\\u00f1adido nueva factura por: \",\"user\":\"bilalbejja\"}','2021-06-05 20:37:15','2021-06-05 14:57:48','2021-06-05 20:37:15'),('f38b8645-3dcb-412c-89fd-a50afbb7ac7b','App\\Notifications\\NewInvoice','App\\User',1,'{\"id\":13,\"title\":\"Se ha a\\u00f1adido nueva factura por: \",\"user\":\"bilalbejja\"}','2021-06-05 13:13:10','2021-06-04 21:38:43','2021-06-05 13:13:10'),('f3e8ae00-f906-43df-b4e1-5aa6dbf55932','App\\Notifications\\NewInvoice','App\\User',1,'{\"id\":33,\"title\":\"Se ha a\\u00f1adido nueva factura por: \",\"user\":\"bilalbejja\"}','2021-06-07 09:34:08','2021-06-07 09:15:13','2021-06-07 09:34:08'),('fc309699-932a-4c91-95ee-e341c706ad65','App\\Notifications\\NewInvoice','App\\User',1,'{\"id\":7,\"title\":\"Se ha a\\u00f1adido nueva factura por: \",\"user\":\"bilal\"}','2021-06-02 22:09:09','2021-06-02 22:03:31','2021-06-02 22:09:09');
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
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
