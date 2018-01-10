-- MySQL dump 10.16  Distrib 10.1.29-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: u487508290_aaaaa
-- ------------------------------------------------------
-- Server version	10.1.29-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cocheras`
--

DROP TABLE IF EXISTS `cocheras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cocheras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ReservadoDiscEmbar` tinyint(1) NOT NULL DEFAULT '0',
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `piso` int(11) NOT NULL,
  `ocupada` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cocheras`
--

/*!40000 ALTER TABLE `cocheras` DISABLE KEYS */;
INSERT INTO `cocheras` VALUES (1,1,'102',1,0),(2,1,'283',1,0),(3,1,'197',1,0),(4,0,'151',1,0),(5,0,'127',1,1),(6,0,'387',1,0),(7,0,'372',2,0),(8,0,'420',2,1),(9,0,'199',2,0),(10,0,'448',2,0),(11,0,'259',2,0),(12,0,'428',2,0),(13,0,'261',3,0),(14,0,'285',3,0),(15,0,'396',3,0),(16,0,'175',3,0),(17,0,'388',3,0),(18,0,'296',3,0);
/*!40000 ALTER TABLE `cocheras` ENABLE KEYS */;

--
-- Table structure for table `empleados`
--

DROP TABLE IF EXISTS `empleados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empleados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `turno` int(11) NOT NULL,
  `sexo` int(11) NOT NULL,
  `perfil` int(11) NOT NULL,
  `suspendido` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `turno` (`turno`),
  KEY `sexo` (`sexo`),
  KEY `perfil` (`perfil`),
  CONSTRAINT `empleados_ibfk_1` FOREIGN KEY (`turno`) REFERENCES `turnos` (`id`),
  CONSTRAINT `empleados_ibfk_2` FOREIGN KEY (`sexo`) REFERENCES `sexos` (`id`),
  CONSTRAINT `empleados_ibfk_3` FOREIGN KEY (`perfil`) REFERENCES `perfiles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empleados`
--

/*!40000 ALTER TABLE `empleados` DISABLE KEYS */;
INSERT INTO `empleados` VALUES (1,'Vladimir001@estacionamiento.com','25021544',1,1,2,0),(2,'Jorge001@estacionamiento.com','45678921',2,1,1,0),(3,'Dulce001@estacionamiento.com','42512354',3,2,1,0),(4,'suspendido001@estacionamiento.com','suspendido001@estacionamiento.com',1,1,1,1);
/*!40000 ALTER TABLE `empleados` ENABLE KEYS */;

--
-- Table structure for table `logueos`
--

DROP TABLE IF EXISTS `logueos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logueos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empleado` int(11) DEFAULT NULL,
  `fecha` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `empleado` (`empleado`),
  CONSTRAINT `logueos_ibfk_1` FOREIGN KEY (`empleado`) REFERENCES `empleados` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=188 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logueos`
--

/*!40000 ALTER TABLE `logueos` DISABLE KEYS */;
INSERT INTO `logueos` VALUES (1,1,'2017-11-26 17:10:06'),(2,2,'2017-11-26 17:10:06'),(3,3,'2017-11-26 17:10:06'),(4,1,'2017-11-26 17:10:06'),(5,2,'2017-11-26 17:10:06'),(6,3,'2017-11-26 17:10:06'),(7,1,'2017-11-26 17:14:27'),(8,3,'2017-11-26 17:50:44'),(9,1,'2017-11-26 14:59:36'),(10,1,'2017-11-26 16:10:48'),(11,1,'2017-11-26 16:25:06'),(12,1,'2017-11-26 16:26:57'),(13,1,'2017-11-26 16:27:20'),(14,1,'2017-11-26 16:27:26'),(15,1,'2017-11-26 16:27:32'),(16,1,'2017-11-26 16:27:51'),(17,1,'2017-11-26 16:28:23'),(18,1,'2017-11-26 16:28:35'),(19,1,'2017-11-26 16:28:42'),(20,1,'2017-11-26 16:28:45'),(21,1,'2017-11-26 16:29:29'),(22,1,'2017-11-26 16:29:40'),(23,1,'2017-11-26 16:30:50'),(24,1,'2017-11-26 16:31:42'),(25,1,'2017-11-26 16:32:05'),(26,1,'2017-11-26 16:35:12'),(27,1,'2017-11-26 16:35:28'),(28,1,'2017-11-26 16:37:28'),(29,1,'2017-11-26 16:44:19'),(30,1,'2017-11-26 16:48:47'),(31,1,'2017-11-26 16:50:24'),(32,1,'2017-11-26 16:51:27'),(33,1,'2017-11-26 16:52:58'),(34,1,'2017-11-26 16:53:36'),(35,1,'2017-11-26 16:55:06'),(36,1,'2017-11-26 16:56:02'),(37,1,'2017-11-26 16:56:22'),(38,1,'2017-11-26 16:59:44'),(39,1,'2017-11-26 17:02:01'),(40,1,'2017-11-26 17:03:37'),(41,1,'2017-11-26 17:04:12'),(42,1,'2017-11-26 17:05:39'),(43,1,'2017-11-26 17:06:09'),(44,1,'2017-11-26 17:06:59'),(45,1,'2017-11-26 17:10:08'),(46,1,'2017-11-26 17:10:45'),(47,1,'2017-11-26 17:11:38'),(48,1,'2017-11-26 17:11:52'),(49,1,'2017-11-26 17:12:37'),(50,2,'2017-11-26 17:14:10'),(51,1,'2017-11-26 17:14:36'),(52,1,'2017-11-26 17:15:33'),(53,1,'2017-11-26 17:15:51'),(54,1,'2017-11-26 17:16:08'),(55,1,'2017-11-26 17:18:16'),(56,1,'2017-11-26 17:18:32'),(57,1,'2017-11-26 17:20:08'),(58,1,'2017-11-26 17:20:19'),(59,1,'2017-11-26 17:21:02'),(60,1,'2017-11-26 17:22:25'),(61,1,'2017-11-26 18:14:37'),(62,1,'2017-11-26 18:15:36'),(63,1,'2017-11-26 18:15:48'),(64,1,'2017-11-26 18:17:07'),(65,1,'2017-11-26 18:19:27'),(66,1,'2017-11-26 18:20:56'),(67,1,'2017-11-26 18:23:40'),(68,1,'2017-11-26 18:24:33'),(69,1,'2017-11-26 18:26:42'),(70,1,'2017-11-26 18:26:54'),(71,1,'2017-11-26 18:29:46'),(72,1,'2017-11-26 18:30:54'),(73,1,'2017-11-26 18:36:16'),(74,1,'2017-11-26 18:37:37'),(75,1,'2017-11-26 18:37:49'),(76,1,'2017-11-26 18:54:57'),(77,1,'2017-11-26 18:55:57'),(78,1,'2017-11-26 18:56:20'),(79,1,'2017-11-26 18:56:57'),(80,1,'2017-11-26 18:57:11'),(81,1,'2017-11-26 18:57:30'),(82,1,'2017-11-26 19:03:58'),(83,1,'2017-11-26 19:04:20'),(84,1,'2017-11-26 19:05:22'),(85,1,'2017-11-26 19:05:42'),(86,1,'2017-11-26 19:06:17'),(87,1,'2017-11-26 19:07:48'),(88,1,'2017-11-26 19:09:20'),(89,1,'2017-11-26 19:29:01'),(90,1,'2017-11-27 10:14:22'),(91,1,'2017-11-27 10:17:49'),(92,1,'2017-11-27 10:34:06'),(93,1,'2017-11-27 11:15:34'),(94,1,'2017-11-27 11:17:10'),(95,1,'2017-11-27 11:19:26'),(96,1,'2017-11-27 11:20:16'),(97,1,'2017-11-27 11:20:42'),(98,1,'2017-11-27 11:22:13'),(99,1,'2017-11-27 11:31:27'),(100,1,'2017-11-27 12:04:10'),(101,1,'2017-11-27 12:08:36'),(102,1,'2017-11-27 12:09:52'),(103,1,'2017-11-27 12:11:17'),(104,1,'2017-11-27 12:28:28'),(105,1,'2017-11-27 12:28:47'),(106,1,'2017-11-27 12:43:49'),(107,1,'2017-11-27 12:50:27'),(108,1,'2017-11-27 15:50:26'),(109,1,'2017-11-27 18:54:12'),(110,1,'2017-11-27 19:01:33'),(111,1,'2017-11-27 19:19:40'),(112,2,'2017-11-27 19:36:34'),(113,1,'2017-11-27 19:48:21'),(114,1,'2017-11-27 20:12:50'),(115,1,'2017-11-27 21:57:15'),(116,1,'2017-11-27 22:01:04'),(117,1,'2017-11-27 22:02:12'),(118,1,'2017-11-27 22:02:46'),(119,1,'2017-11-28 13:20:24'),(120,2,'2017-11-28 13:25:32'),(121,2,'2017-11-28 13:26:20'),(122,2,'2017-11-28 13:36:35'),(123,2,'2017-11-28 13:36:40'),(124,1,'2017-11-28 13:36:43'),(125,1,'2017-11-28 13:37:05'),(126,2,'2017-11-28 13:37:08'),(127,1,'2017-11-28 13:37:19'),(128,1,'2017-11-28 13:37:24'),(129,1,'2017-11-28 13:37:33'),(130,2,'2017-11-28 13:37:52'),(131,1,'2017-11-28 13:46:58'),(132,2,'2017-11-28 13:49:49'),(133,2,'2017-11-28 13:51:52'),(134,1,'2017-11-28 13:52:03'),(135,1,'2017-11-28 14:04:53'),(136,2,'2017-11-28 16:06:54'),(137,1,'2017-11-28 21:06:51'),(138,1,'2017-11-29 11:14:08'),(139,2,'2017-11-29 13:06:22'),(140,1,'2017-11-29 13:19:24'),(141,1,'2017-11-29 13:19:49'),(142,1,'2017-11-29 13:19:56'),(143,1,'2017-11-29 13:20:11'),(144,1,'2017-11-29 13:42:00'),(145,1,'2017-11-29 17:00:21'),(146,1,'2017-11-29 21:13:12'),(147,1,'2017-11-30 11:30:43'),(148,1,'2017-11-30 13:58:58'),(149,1,'2017-12-01 10:27:42'),(150,1,'2017-12-01 11:55:34'),(151,1,'2017-12-01 15:24:17'),(152,2,'2017-12-01 15:25:33'),(153,1,'2017-12-01 15:25:59'),(154,1,'2017-12-01 15:44:10'),(155,1,'2017-12-01 16:09:55'),(156,1,'2017-12-01 16:12:53'),(157,1,'2017-12-01 16:33:33'),(158,1,'2017-12-01 19:01:33'),(159,2,'2017-12-01 19:15:55'),(160,1,'2017-12-01 19:16:04'),(161,2,'2017-12-01 19:16:26'),(162,1,'2017-12-01 19:19:07'),(163,2,'2017-12-02 11:21:23'),(164,1,'2017-12-02 11:21:32'),(165,2,'2017-12-02 11:23:12'),(166,1,'2017-12-02 11:23:44'),(167,1,'2017-12-04 14:00:21'),(168,1,'2017-12-04 14:15:54'),(169,1,'2017-12-05 18:59:41'),(170,1,'2017-12-06 11:51:13'),(171,3,'2017-12-06 12:57:01'),(172,3,'2017-12-06 12:57:10'),(173,3,'2017-12-06 13:02:01'),(174,2,'2017-12-06 13:04:55'),(175,1,'2017-12-06 13:42:09'),(176,1,'2017-12-06 13:43:53'),(177,1,'2017-12-06 13:52:22'),(178,1,'2017-12-06 13:59:47'),(179,2,'2017-12-06 14:13:50'),(180,1,'2017-12-06 14:14:00'),(181,2,'2017-12-06 15:46:47'),(182,1,'2017-12-06 15:52:38'),(183,1,'2017-12-07 15:59:21'),(184,1,'2017-12-07 16:44:21'),(185,1,'2017-12-09 09:35:02'),(186,1,'2017-12-09 09:40:37'),(187,1,'2017-12-09 09:41:02');
/*!40000 ALTER TABLE `logueos` ENABLE KEYS */;

--
-- Table structure for table `perfiles`
--

DROP TABLE IF EXISTS `perfiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `perfiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perfiles`
--

/*!40000 ALTER TABLE `perfiles` DISABLE KEYS */;
INSERT INTO `perfiles` VALUES (2,'admin'),(1,'user');
/*!40000 ALTER TABLE `perfiles` ENABLE KEYS */;

--
-- Table structure for table `sexos`
--

DROP TABLE IF EXISTS `sexos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sexos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sexos`
--

/*!40000 ALTER TABLE `sexos` DISABLE KEYS */;
INSERT INTO `sexos` VALUES (2,'Femenino'),(1,'Masculino');
/*!40000 ALTER TABLE `sexos` ENABLE KEYS */;

--
-- Table structure for table `turnos`
--

DROP TABLE IF EXISTS `turnos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `turnos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `turnos`
--

/*!40000 ALTER TABLE `turnos` DISABLE KEYS */;
INSERT INTO `turnos` VALUES (1,'mañana'),(3,'noche'),(2,'tarde');
/*!40000 ALTER TABLE `turnos` ENABLE KEYS */;

--
-- Table structure for table `vehiculos`
--

DROP TABLE IF EXISTS `vehiculos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehiculos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patente` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Color` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Marca` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Foto` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `IDEmpleadoIngreso` int(11) DEFAULT NULL,
  `HoraDeEntrada` datetime NOT NULL,
  `Cochera` int(11) NOT NULL,
  `IDEmpleadoSalida` int(11) DEFAULT NULL,
  `HoraDeSalida` datetime DEFAULT NULL,
  `importe` decimal(19,2) DEFAULT NULL,
  `tiempo_seg` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDEmpleadoIngreso` (`IDEmpleadoIngreso`),
  KEY `IDEmpleadoSalida` (`IDEmpleadoSalida`),
  KEY `Cochera` (`Cochera`),
  CONSTRAINT `vehiculos_ibfk_1` FOREIGN KEY (`IDEmpleadoIngreso`) REFERENCES `empleados` (`id`) ON DELETE SET NULL,
  CONSTRAINT `vehiculos_ibfk_2` FOREIGN KEY (`IDEmpleadoSalida`) REFERENCES `empleados` (`id`) ON DELETE SET NULL,
  CONSTRAINT `vehiculos_ibfk_3` FOREIGN KEY (`Cochera`) REFERENCES `cocheras` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=348 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehiculos`
--

/*!40000 ALTER TABLE `vehiculos` DISABLE KEYS */;
INSERT INTO `vehiculos` VALUES (1,'ABC123','Rojo','Peugeot','1_ABC123.png',1,'2017-10-31 13:12:05',2,1,'2017-12-01 20:26:46',5340.00,2704481),(6,'ABC129','Gris','Peugeot','1_ABC129.png',3,'2017-10-31 23:09:12',3,1,'2017-11-28 15:56:21',4720.00,2393229),(7,'67046-223','Purple','Mazda','675998924-4',2,'2016-12-26 15:11:20',3,1,'2017-11-26 14:38:09',56980.00,28942009),(19,'62175-152','Puce','Buick','373938037-3',1,'2017-04-23 03:38:31',3,1,'2017-11-26 14:43:21',37000.00,18788690),(28,'42291-600','Pink','Ford','700446980-8',2,'2017-06-09 00:25:12',5,1,'2017-11-28 16:03:12',29360.00,14917080),(31,'61589-5311','Violet','Mazda','535857582-0',3,'2017-06-11 11:16:56',5,1,'2017-11-28 15:51:28',28940.00,14704472),(36,'63736-072','Turquoise','Kia','263406978-2',3,'2017-04-29 02:48:37',6,1,'2017-11-26 14:45:40',35980.00,18273423),(49,'0115-2122','Indigo','BMW','462915191-5',2,'2017-04-29 22:31:49',6,1,'2017-11-26 14:43:46',35830.00,18202317),(69,'59779-912','Goldenrod','Nissan','354109186-X',1,'2017-03-25 18:18:16',6,1,'2017-11-26 14:43:57',41820.00,21241541),(308,'ABC 882','Rojo','Peugeot','Placeholder',1,'2017-11-28 15:17:27',4,1,'2017-11-28 15:50:53',0.00,2006),(309,'IEJ 284','Azul','Peugeot','Placeholder',1,'2017-11-28 15:20:20',3,1,'2017-11-28 15:48:44',0.00,1704),(313,'LKJS 492','Blanco','Peugeot','Placeholder',2,'2017-11-28 16:08:33',4,2,'2017-11-28 16:09:06',0.00,33),(339,'ASD 435','Rojo','Peugeot','Placeholder',1,'2017-12-06 12:26:31',4,1,'2017-12-06 14:12:05',10.00,6334),(342,'ASD 435','Rojo','Peugeot','Placeholder',1,'2017-12-06 14:05:20',4,1,'2017-12-06 14:12:05',10.00,6334),(343,'ASD 123','Rojo','Peugeot','Placeholder',1,'2017-12-06 14:29:03',1,1,'2017-12-06 14:33:47',0.00,284),(347,'AUY 853','Rojo','Peugeot','Placeholder',1,'2017-12-09 10:24:55',8,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `vehiculos` ENABLE KEYS */;

--
-- Dumping routines for database 'u487508290_aaaaa'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-12-09 15:47:21
