-- MySQL dump 10.14  Distrib 5.5.53-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: localhost
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
-- Table structure for table `anonymized_data`
--
CREATE DATABASE OCDXGroup1;
USE OCDXGroup1;

DROP TABLE IF EXISTS `anonymized_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `anonymized_data` (
  `anonymized_data_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Indicated whether anyting has been excluded, removed or altered in the dataset in order to protect the identities, integrity and rights of participants.',
  `label` varchar(100) DEFAULT NULL COMMENT 'Indicates oversight type, choose one: IRB, REB, REC',
  `research_object_id` int(10) NOT NULL,
  PRIMARY KEY (`anonymized_data_id`),
  KEY `research_object_id_idx` (`research_object_id`),
  CONSTRAINT `anonymized_data_research_object_key` FOREIGN KEY (`research_object_id`) REFERENCES `research_object` (`research_object_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `dates`
--

DROP TABLE IF EXISTS `dates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dates` (
  `date` datetime DEFAULT NULL,
  `dates_id` int(10) NOT NULL AUTO_INCREMENT,
  `label` varchar(100) DEFAULT NULL,
  `research_object_id` int(10) NOT NULL,
  PRIMARY KEY (`dates_id`),
  KEY `research_object_id_idx` (`research_object_id`),
  CONSTRAINT `dates_research_objects_key` FOREIGN KEY (`research_object_id`) REFERENCES `research_object` (`research_object_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `files`
--

DROP TABLE IF EXISTS `files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `files` (
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `format` varchar(20) NOT NULL,
  `abstract` varchar(500) DEFAULT NULL,
  `size` int(11) NOT NULL,
  `url` varchar(100) NOT NULL,
  `checksum` varchar(50) NOT NULL,
  `research_object_id` int(10) NOT NULL,
  `created_on` datetime NOT NULL,
  PRIMARY KEY (`file_id`),
  KEY `research_object_id_idx` (`research_object_id`),
  KEY `manifest_files_index` (`name`,`format`,`abstract`(255),`size`,`url`,`checksum`,`created_on`,`research_object_id`),
  CONSTRAINT `files_research_objects_key` FOREIGN KEY (`research_object_id`) REFERENCES `research_object` (`research_object_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `locations`
--

DROP TABLE IF EXISTS `locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `locations` (
  `location_id` int(10) NOT NULL AUTO_INCREMENT,
  `URL` varchar(100) DEFAULT NULL,
  `comment` varchar(500) DEFAULT NULL,
  `research_object_id` int(10) NOT NULL,
  PRIMARY KEY (`location_id`),
  KEY `research_object_id_idx` (`research_object_id`),
  CONSTRAINT `locations_research_objects_key` FOREIGN KEY (`research_object_id`) REFERENCES `research_object` (`research_object_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `manifest`
--

DROP TABLE IF EXISTS `manifest`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `manifest` (
  `manifest_id` int(10) NOT NULL AUTO_INCREMENT,
  `standards_versions` varchar(64) NOT NULL COMMENT 'Declaration of start for a record using ocdxManifest schema v.1',
  `date_created` datetime NOT NULL,
  `comment` varchar(500) DEFAULT NULL,
  `user_id` int(10) NOT NULL,
  `title` varchar(50) NOT NULL,
  PRIMARY KEY (`manifest_id`),
  KEY `user_id_fk` (`user_id`),
  KEY `manifest_files_index` (`manifest_id`,`standards_versions`,`date_created`,`comment`(255),`user_id`,`title`),
  CONSTRAINT `user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=202 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `publication`
--

DROP TABLE IF EXISTS `publication`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `publication` (
  `publication_id` int(10) NOT NULL AUTO_INCREMENT,
  `publication` varchar(100) DEFAULT NULL,
  `research_object_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`publication_id`),
  KEY `publication_research_objects_key_idx` (`research_object_id`),
  CONSTRAINT `publication_research_objects_key` FOREIGN KEY (`research_object_id`) REFERENCES `research_object` (`research_object_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `research_object`
--

DROP TABLE IF EXISTS `research_object`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `research_object` (
  `title` varchar(50) NOT NULL COMMENT 'A one sentence for the dataset. If a title is not given, provide one sentence that describes the dataset contents. Whenever possible copy from source.',
  `abstract` varchar(500) NOT NULL COMMENT 'A complete summary of the dataset ',
  `research_object_id` int(10) NOT NULL AUTO_INCREMENT,
  `oversight` tinyint(1) NOT NULL COMMENT 'Was institutional oversight applied to date collection and/or analysis',
  `oversight_type` varchar(30) DEFAULT NULL,
  `informed_consent` varchar(100) NOT NULL,
  `privacy_considerations` varchar(100) NOT NULL,
  `provenance` varchar(100) NOT NULL COMMENT 'A brief description of what the data set does ',
  `permissions` varchar(100) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `manifest_id` int(10) NOT NULL,
  PRIMARY KEY (`research_object_id`),
  KEY `manifest_id_idx` (`manifest_id`),
  KEY `manifest_files_index` (`research_object_id`,`manifest_id`),
  CONSTRAINT `research_objects_manifest_key` FOREIGN KEY (`manifest_id`) REFERENCES `manifest` (`manifest_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=143 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `researcher_contributed_to_research_object`
--

DROP TABLE IF EXISTS `researcher_contributed_to_research_object`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `researcher_contributed_to_research_object` (
  `researcher_id` int(10) NOT NULL,
  `research_object_id` int(10) NOT NULL,
  `contributed_on` datetime NOT NULL,
  KEY `researcher_id_fk` (`researcher_id`),
  KEY `research_object_id_fk` (`research_object_id`),
  CONSTRAINT `researcher_id_fk` FOREIGN KEY (`researcher_id`) REFERENCES `researchers` (`researcher_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `research_object_id_fk` FOREIGN KEY (`research_object_id`) REFERENCES `research_object` (`research_object_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `researchers`
--

DROP TABLE IF EXISTS `researchers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `researchers` (
  `researcher_id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `role` varchar(50) DEFAULT NULL,
  `type` varchar(50) NOT NULL COMMENT 'Educational institutions; Government; NGO; Individual; Private for profit entity, No Assertion.',
  `contact` varchar(50) NOT NULL,
  PRIMARY KEY (`researcher_id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) DEFAULT NULL,
  `hashed_password` varchar(200) DEFAULT NULL,
  `created_on` datetime NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=317 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping routines for database 'OCDXGroup1'
--
/*!50003 DROP PROCEDURE IF EXISTS `pDeleteFile` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES' */ ;
DELIMITER ;;
CREATE PROCEDURE `pDeleteFile`(`file_id_in` INT(11))
BEGIN
    DECLARE file VARCHAR(100) DEFAULT '';
    SELECT name INTO file
    FROM files
    WHERE files.file_id = file_id_in;
    DELETE FROM files
    WHERE files.file_id = file_id_in;
    SELECT file;
  END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `pDeleteManifest` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES' */ ;
DELIMITER ;;
CREATE PROCEDURE `pDeleteManifest`(IN manifest_id_in INT)
BEGIN
	DELETE FROM `OCDXGroup1`.`manifest`
	WHERE manifest_id = manifest_id_in;
	END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `pGetUserByUserName` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'IGNORE_SPACE,STRICT_TRANS_TABLES' */ ;
DELIMITER ;;
CREATE PROCEDURE `pGetUserByUserName`(IN user_input VARCHAR(30))
BEGIN
	SELECT user_id,username,hashed_password
	FROM users
	WHERE username = user_input;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `pInsertAnonymizedData` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES' */ ;
DELIMITER ;;
CREATE PROCEDURE `pInsertAnonymizedData`(IN research_object_id_in INT(10), IN label_in VARCHAR(100))
BEGIN
	INSERT INTO `OCDXGroup1`.`anonymized_data`
	(`label`,
	`research_object_id`)
	VALUES
	(label_in,
	research_object_id_in);
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `pInsertDate` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES' */ ;
DELIMITER ;;
CREATE PROCEDURE `pInsertDate`(IN research_object_id_in INT(10), IN date_in DATETIME, IN label_in VARCHAR(100))
BEGIN
	INSERT INTO `OCDXGroup1`.`dates`
	(`date`,
	`label`,
	`research_object_id`)
	VALUES
	(date_in,
	label_in,
	research_object_id_in);
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `pInsertFile` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES' */ ;
DELIMITER ;;
CREATE PROCEDURE `pInsertFile`(IN fileName VARCHAR(50),IN format VARCHAR(20), IN abstract VARCHAR(500), IN size INT(11), IN url VARCHAR(100), IN  checksum VARCHAR(50), IN research_id INT(10))
BEGIN
INSERT INTO files(file_id,name,format,abstract,size,url,checksum,research_object_id,created_on)
VALUES (DEFAULT,fileName,format,abstract,size,url,checksum,research_id,NOW());
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `pInsertLocation` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES' */ ;
DELIMITER ;;
CREATE PROCEDURE `pInsertLocation`(IN research_object_id_in INT(10), IN url_in VARCHAR(100), IN comment_in VARCHAR(500))
BEGIN
	INSERT INTO `OCDXGroup1`.`locations`
	(`URL`,
	`comment`,
	`research_object_id`)
	VALUES
	(url_in,
	comment_in,
	research_object_id_in);
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `pInsertManifest` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES' */ ;
DELIMITER ;;
CREATE PROCEDURE `pInsertManifest`(IN standards_versions_in VARCHAR(64), IN comment_in VARCHAR(500),
	IN user_id_in INT(10), IN title_in VARCHAR(50))
BEGIN
		INSERT INTO `OCDXGroup1`.`manifest`
		(`standards_versions`,
		`date_created`,
		`comment`,
		`user_id`,
		`title`)
		VALUES
		(standards_versions_in,
		NOW(),
		comment_in,
		user_id_in,
		title_in);

        SELECT LAST_INSERT_ID() AS 'id';
	END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `pInsertPublication` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES' */ ;
DELIMITER ;;
CREATE PROCEDURE `pInsertPublication`(IN research_object_id_in INT(10), IN publication_in VARCHAR(100))
BEGIN
	INSERT INTO `OCDXGroup1`.`publication`
	(`publication`,
	`research_object_id`)
	VALUES
	(publication_in,
	research_object_id_in);
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `pInsertResearcher` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES' */ ;
DELIMITER ;;
CREATE PROCEDURE `pInsertResearcher`(IN name_in VARCHAR(100), IN role_in VARCHAR(50),
                                                           IN type_IN VARCHAR(50), IN contact_in VARCHAR(50))
BEGIN
    INSERT INTO `OCDXGroup1`.`researchers`
    (`researcher_id`,
     `name`,
     `role`,
     `type`,
     `contact`)
    VALUES
      (DEFAULT,
       name_in,
       role_in,
       type_in,
       contact_in);
  END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `pInsertResearchObject` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES' */ ;
DELIMITER ;;
CREATE PROCEDURE `pInsertResearchObject`(IN title_in VARCHAR(50), IN abstract_in VARCHAR(500), IN oversight_in TINYINT(1),
	IN oversight_type_in VARCHAR(30), IN informed_consent_in VARCHAR(100), IN privacy_considerations_in VARCHAR(100), IN provenance_in VARCHAR(100),
    IN permissions_in VARCHAR(100), IN manifest_id_in INT(10))
BEGIN
		INSERT INTO `OCDXGroup1`.`research_object`
		(`research_object_id`,
      `title`,
		`abstract`,
		`oversight`,
		`oversight_type`,
		`informed_consent`,
		`privacy_considerations`,
		`provenance`,
		`permissions`,
		`date`,
		`manifest_id`)
		VALUES
		(DEFAULT ,
      title_in,
		abstract_in,
		oversight_in,
		oversight_type_in,
		informed_consent_in,
		privacy_considerations_in,
		provenance_in,
		permissions_in,
		NOW(),
		manifest_id_in);

        SELECT LAST_INSERT_ID() AS 'id';
	END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `pInsertUser` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES' */ ;
DELIMITER ;;
CREATE PROCEDURE `pInsertUser`(IN username varchar(30),IN hashed_password VARCHAR(200))
BEGIN
	INSERT INTO users
	VALUES(DEFAULT,username,hashed_password,NOW());
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `pSearchByUsername` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES' */ ;
DELIMITER ;;
CREATE PROCEDURE `pSearchByUsername`(`username_in` VARCHAR(30))
BEGIN
    SELECT   manifest.manifest_id,manifest.standards_versions, manifest.date_created, manifest.comment AS 'description', manifest.user_id, manifest.title,
		files.file_id,files.name, files.format, files.abstract, files.size, files.url, files.checksum, files.created_on,
        users.user_id, users.username
    FROM OCDXGroup1.manifest
		INNER JOIN OCDXGroup1.research_object
			ON manifest.manifest_id = research_object.manifest_id
		INNER JOIN OCDXGroup1.files
			ON research_object.research_object_id = files.research_object_id
		INNER JOIN OCDXGroup1.users
			ON manifest.user_id = users.user_id
    WHERE users.username LIKE CONCAT('%',username_in,'%');
  END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `pSearchManifest` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES' */ ;
DELIMITER ;;
CREATE PROCEDURE `pSearchManifest`(IN search VARCHAR(100))
BEGIN
    SELECT  manifest.manifest_id,manifest.standards_versions AS 'title', manifest.comment AS 'description',users.username,manifest.date_created
    FROM OCDXGroup1.manifest
      INNER JOIN OCDXGroup1.users
        ON manifest.user_id = users.user_id
    WHERE manifest.title LIKE CONCAT('%',search,'%') OR manifest.comment LIKE CONCAT('%',search,'%');
  END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `pSelectManifestAndFiles` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES' */ ;
DELIMITER ;;
CREATE PROCEDURE `pSelectManifestAndFiles`(`manifest_id_in` INT(10))
BEGIN
    SELECT  manifest.standards_versions, manifest.date_created, manifest.comment, users.username, manifest.title,
		files.file_id,files.name, files.format, files.abstract, files.size, files.url, files.checksum, files.created_on
    FROM OCDXGroup1.manifest
		INNER JOIN OCDXGroup1.research_object
			ON manifest.manifest_id = research_object.manifest_id
		LEFT OUTER JOIN OCDXGroup1.files
			ON research_object.research_object_id = files.research_object_id
		INNER JOIN OCDXGroup1.users
			ON manifest.user_id = users.user_id
	WHERE manifest.manifest_id = `manifest_id_in`;
  END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `pSelectRecentlyAdded` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES' */ ;
DELIMITER ;;
CREATE PROCEDURE `pSelectRecentlyAdded`()
BEGIN
    SELECT  manifest_id,standards_versions,date_created,comment,title,username
    FROM OCDXGroup1.manifest
      INNER JOIN users
      ON manifest.user_id = users.user_id
    ORDER BY manifest.date_created DESC LIMIT 4;
  END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `pSumBytes` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES' */ ;
DELIMITER ;;
CREATE PROCEDURE `pSumBytes`()
BEGIN
    SELECT  SUM(files.size) AS 'Sum' FROM OCDXGroup1.files WHERE DATE(files.created_on) = CURRENT_DATE;
  END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `pUpdateManifest` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES' */ ;
DELIMITER ;;
CREATE PROCEDURE `pUpdateManifest`(`standards_versions_in` VARCHAR(64), `comment_in` VARCHAR(500),
                                   `title_in` VARCHAR(50), `manifestid_in` INT)
BEGIN
    UPDATE `OCDXGroup1`.`manifest`
    SET `standards_versions` = standards_versions_in,
     `comment` = comment_in,
     `title` = title_in
    WHERE manifest_id = manifestid_in;
  END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

CREATE USER public IDENTIFIED BY 'P@ssword';
GRANT EXECUTE ON OCDXGroup1.* to 'public'@'%';
flush privileges;