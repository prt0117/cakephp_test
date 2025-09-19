-- MySQL dump 10.13  Distrib 8.0.43, for Linux (x86_64)
--
-- Host: localhost    Database: db
-- ------------------------------------------------------
-- Server version	8.0.43-0ubuntu0.22.04.2

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
-- Table structure for table `utm_data`
--

DROP TABLE IF EXISTS `utm_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `utm_data` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `source` text NOT NULL,
  `medium` text NOT NULL,
  `campaign` text NOT NULL,
  `content` text,
  `term` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utm_data`
--

LOCK TABLES `utm_data` WRITE;
/*!40000 ALTER TABLE `utm_data` DISABLE KEYS */;
INSERT INTO `utm_data` VALUES (3,'google','cpc','summer','banner','video','2025-09-19 11:23:23','2025-09-19 11:23:23'),(4,'google','cpc','summer','banner','video','2025-09-19 11:23:23','2025-09-19 11:23:23'),(5,'google','cpc','summer','banner','video','2025-09-19 11:23:23','2025-09-19 11:23:23'),(6,'facebook','cpc','summer','banner','video','2025-09-19 11:23:23','2025-09-19 11:23:23'),(7,'facebook','cpc','summer','banner','video','2025-09-19 11:23:23','2025-09-19 11:23:23'),(8,'facebook','cpc2','summer','banner','video','2025-09-19 11:23:23','2025-09-19 11:23:23'),(9,'facebook','cpc2','summer','banner','video','2025-09-19 11:23:23','2025-09-19 11:23:23'),(10,'facebook','cpc3','summer','banner','video','2025-09-19 11:23:23','2025-09-19 11:23:23'),(11,'twitter','cpc','summer','banner','video','2025-09-19 11:23:23','2025-09-19 11:23:23'),(12,'twitter','cpc','summer','alpha','video','2025-09-19 11:23:23','2025-09-19 11:23:23'),(13,'twitter','cpc','winter',NULL,NULL,'2025-09-19 11:23:23','2025-09-19 11:23:23'),(14,'twitter','cpa','winter','gamma',NULL,'2025-09-19 11:23:23','2025-09-19 11:23:23'),(15,'twitter','cpa','winter','delta',NULL,'2025-09-19 11:23:23','2025-09-19 11:23:23'),(16,'google','cpc','winter','delta',NULL,'2025-09-19 11:23:23','2025-09-19 11:23:23'),(17,'google','cpc','winter','delta',NULL,'2025-09-19 11:23:23','2025-09-19 11:23:23'),(18,'google','cpc','winter','delta',NULL,'2025-09-19 11:23:23','2025-09-19 11:23:23'),(19,'google','cpc','winter','delta',NULL,'2025-09-19 11:23:23','2025-09-19 11:23:23'),(20,'google','cpc','winter','delta',NULL,'2025-09-19 11:23:23','2025-09-19 11:23:23'),(21,'google','cpc','winter','delta',NULL,'2025-09-19 11:23:23','2025-09-19 11:23:23'),(22,'google','cpc','winter','delta',NULL,'2025-09-19 11:23:23','2025-09-19 11:23:23'),(23,'google','cpc','spring','banner','video','2025-09-19 11:23:23','2025-09-19 11:23:23'),(24,'google','cpc','spring','banner','video','2025-09-19 11:23:23','2025-09-19 11:23:23'),(25,'google','cpc','spring','banner','video','2025-09-19 11:23:23','2025-09-19 11:23:23'),(26,'google','cpc','spring','banner','video','2025-09-19 11:23:23','2025-09-19 11:23:23'),(27,'google','cpc','spring','banner','video','2025-09-19 11:23:23','2025-09-19 11:23:23'),(28,'google','cpc','spring','banner','video','2025-09-19 11:23:23','2025-09-19 11:23:23'),(29,'google','cpc','spring','banner','video','2025-09-19 11:23:23','2025-09-19 11:23:23'),(30,'google','cpc','spring','banner','video','2025-09-19 11:23:23','2025-09-19 11:23:23'),(31,'google','cpc','spring','banner','video','2025-09-19 11:23:23','2025-09-19 11:23:23'),(32,'google','cpc','spring','banner','video','2025-09-19 11:23:23','2025-09-19 11:23:23'),(33,'google','cpc','autumn','delta',NULL,'2025-09-19 11:23:23','2025-09-19 11:23:23'),(34,'google','cpc','autumn','delta',NULL,'2025-09-19 11:23:23','2025-09-19 11:23:23'),(35,'google','cpc','autumn','delta',NULL,'2025-09-19 11:23:23','2025-09-19 11:23:23'),(36,'google','cpc','autumn','delta',NULL,'2025-09-19 11:23:23','2025-09-19 11:23:23'),(37,'google','cpc','autumn','delta',NULL,'2025-09-19 11:23:23','2025-09-19 11:23:23'),(38,'google','cpc','autumn','delta',NULL,'2025-09-19 11:23:23','2025-09-19 11:23:23'),(39,'google','cpc','autumn','delta',NULL,'2025-09-19 11:23:23','2025-09-19 11:23:23'),(40,'google','cpc','autumn','delta',NULL,'2025-09-19 11:23:23','2025-09-19 11:23:23'),(41,'google','cpc','autumn','delta',NULL,'2025-09-19 11:23:23','2025-09-19 11:23:23'),(42,'google','cpc','autumn','delta',NULL,'2025-09-19 11:23:23','2025-09-19 11:23:23');
/*!40000 ALTER TABLE `utm_data` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-09-19 12:16:00
