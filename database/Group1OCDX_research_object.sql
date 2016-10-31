-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: localhost    Database: Group1OCDX
-- ------------------------------------------------------
-- Server version	5.5.53-MariaDB

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
-- Table structure for table `research_object`
--

DROP TABLE IF EXISTS `research_object`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `research_object` (
  `title` varchar(20) DEFAULT NULL COMMENT 'A one sentence for the dataset. If a title is not given, provide one sentence that describes the dataset contents. Whenever possible copy from source.',
  `abstract` varchar(100) NOT NULL COMMENT 'A complete summary of the dataset ',
  `research_object_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `oversight` tinyint(1) NOT NULL COMMENT 'Was institutional oversight applied to date collection and/or analysis',
  `oversight_type` varchar(30) DEFAULT NULL,
  `informed_consent` varchar(100) NOT NULL,
  `privacy_considerations` varchar(100) NOT NULL,
  `provenance` varchar(100) NOT NULL COMMENT 'A brief description of what the data set does ',
  `permissions` varchar(100) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `manifest_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`research_object_id`),
  KEY `manifest_id_idx` (`manifest_id`),
  CONSTRAINT `research_objects_manifest_key` FOREIGN KEY (`manifest_id`) REFERENCES `manifest` (`manifest_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-10-31  0:22:14
