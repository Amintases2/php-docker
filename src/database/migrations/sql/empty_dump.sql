-- MySQL dump 10.13  Distrib 8.0.37, for Linux (aarch64)
--
-- Host: db    Database: rebbdevel
-- ------------------------------------------------------
-- Server version	8.4.1

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
-- Table structure for table `advstep`
--

DROP TABLE IF EXISTS `advstep`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `advstep` (
  `code_AdvanceStep` char(1) NOT NULL,
  `Symbol` char(1) NOT NULL,
  `Name` varchar(8) NOT NULL,
  PRIMARY KEY (`code_AdvanceStep`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `advstep`
--

LOCK TABLES `advstep` WRITE;
/*!40000 ALTER TABLE `advstep` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `advstep` VALUES ('a','%','Percent'),('b','₽','Currency');
/*!40000 ALTER TABLE `advstep` ENABLE KEYS */;
UNLOCK TABLES;
commit;
