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
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'Facturas','web','2021-05-24 21:02:41','2021-05-24 21:02:41'),(2,'Lista de facturas','web','2021-05-24 21:02:41','2021-05-24 21:02:41'),(3,'Facturas pagadas','web','2021-05-24 21:02:41','2021-05-24 21:02:41'),(4,'Facturas pagadas parcialmente','web','2021-05-24 21:02:41','2021-05-24 21:02:41'),(5,'Facturas no pagadas','web','2021-05-24 21:02:41','2021-05-24 21:02:41'),(6,'Archivo de facturas','web','2021-05-24 21:02:41','2021-05-24 21:02:41'),(7,'Informes','web','2021-05-24 21:02:41','2021-05-24 21:02:41'),(8,'Informe de facturas','web','2021-05-24 21:02:41','2021-05-24 21:02:41'),(9,'Informe de clientes','web','2021-05-24 21:02:41','2021-05-24 21:02:41'),(10,'Usuarios','web','2021-05-24 21:02:41','2021-05-24 21:02:41'),(11,'Lista de usuarios','web','2021-05-24 21:02:41','2021-05-24 21:02:41'),(12,'Permisos de usuarios','web','2021-05-24 21:02:41','2021-05-24 21:02:41'),(13,'Ajustes','web','2021-05-24 21:02:41','2021-05-24 21:02:41'),(14,'Productos','web','2021-05-24 21:02:41','2021-05-24 21:02:41'),(15,'Secciones','web','2021-05-24 21:02:41','2021-05-24 21:02:41'),(16,'Agregar factura','web','2021-05-24 21:02:41','2021-05-24 21:02:41'),(17,'Eliminar factura','web','2021-05-24 21:02:41','2021-05-24 21:02:41'),(18,'EXCEL exportacion','web','2021-05-24 21:02:41','2021-05-24 21:02:41'),(19,'Cambiar estado de pago','web','2021-05-24 21:02:41','2021-05-24 21:02:41'),(20,'Modificar factura','web','2021-05-24 21:02:41','2021-05-24 21:02:41'),(21,'Archivar factura','web','2021-05-24 21:02:41','2021-05-24 21:02:41'),(22,'Imprimir factura','web','2021-05-24 21:02:41','2021-05-24 21:02:41'),(23,'Agregar adjunto','web','2021-05-24 21:02:41','2021-05-24 21:02:41'),(24,'Eliminar adjunto','web','2021-05-24 21:02:41','2021-05-24 21:02:41'),(25,'Agregar usuario','web','2021-05-24 21:02:41','2021-05-24 21:02:41'),(26,'Modificar usuario','web','2021-05-24 21:02:41','2021-05-24 21:02:41'),(27,'Eliminar usuario','web','2021-05-24 21:02:41','2021-05-24 21:02:41'),(28,'Mostrar roles','web','2021-05-24 21:02:42','2021-05-24 21:02:42'),(29,'Agregar role','web','2021-05-24 21:02:42','2021-05-24 21:02:42'),(30,'Modificar role','web','2021-05-24 21:02:42','2021-05-24 21:02:42'),(31,'Eliminar role','web','2021-05-24 21:02:42','2021-05-24 21:02:42'),(32,'Agregar producto','web','2021-05-24 21:02:42','2021-05-24 21:02:42'),(33,'Modificar producto','web','2021-05-24 21:02:42','2021-05-24 21:02:42'),(34,'Eliminar producto','web','2021-05-24 21:02:42','2021-05-24 21:02:42'),(35,'Agregar seccion','web','2021-05-24 21:02:42','2021-05-24 21:02:42'),(36,'Modificar seccion','web','2021-05-24 21:02:42','2021-05-24 21:02:42'),(37,'Eliminar seccion','web','2021-05-24 21:02:42','2021-05-24 21:02:42'),(38,'Notificaciones','web','2021-05-24 21:02:42','2021-05-24 21:02:42');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-06-13 22:26:31
