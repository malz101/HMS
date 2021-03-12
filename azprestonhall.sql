-- MySQL dump 10.13  Distrib 5.7.28, for Linux (x86_64)
--
-- Host: localhost    Database: azprestonhall
-- ------------------------------------------------------
-- Server version	5.7.28-0ubuntu0.19.04.2

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
-- Table structure for table `admin`
--
DROP DATABASE IF EXISTS azprestonhall;
CREATE DATABASE azprestonhall;
USE azprestonhall;
DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `id_num` varchar(10) NOT NULL,
  `cluster_name` varchar(20) NOT NULL DEFAULT 'NOT ASSIGNED',
  `room_num` varchar(4) NOT NULL DEFAULT 'NONE',
  `position` enum('Resident Advisor','Student Services and Development Manager','Hall Chair','Deputy Hall Chair','Operations Manager','Courier Attendant') NOT NULL,
  `full_name` varchar(30) NOT NULL,
  PRIMARY KEY (`id_num`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES ('500004432','NOT ASSIGNED','NONE','Resident Advisor','John Doe');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `feedback` (
  `issueID` int(11) NOT NULL,
  `feedbackID` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`feedbackID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feedback`
--

LOCK TABLES `feedback` WRITE;
/*!40000 ALTER TABLE `feedback` DISABLE KEYS */;
INSERT INTO `feedback` VALUES (1,1),(1,2),(2,3),(3,4),(3,5),(3,6),(3,7),(7,8);
/*!40000 ALTER TABLE `feedback` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `feedback_comments`
--

DROP TABLE IF EXISTS `feedback_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `feedback_comments` (
  `issueID` int(11) NOT NULL,
  `feedbackID` int(11) NOT NULL,
  `comment` varchar(250) NOT NULL,
  `sender` varchar(30) NOT NULL DEFAULT 'ANONYMOUS',
  `isRead` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feedback_comments`
--

LOCK TABLES `feedback_comments` WRITE;
/*!40000 ALTER TABLE `feedback_comments` DISABLE KEYS */;
INSERT INTO `feedback_comments` VALUES (1,1,'Request Received','ANONYMOUS',0),(1,2,'Thank you, the plunger was delivered','ANONYMOUS',0),(2,3,'The plumber had attended to the issue','ANONYMOUS',0),(3,6,'I have received no response about the leaking pipe in my household kitchen','620117676',0),(3,7,'Apologies, we will send a plumber in 3 days','John Doe',0),(7,8,'Our food started to rot','620117676',0);
/*!40000 ALTER TABLE `feedback_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `feedback_date`
--

DROP TABLE IF EXISTS `feedback_date`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `feedback_date` (
  `issueID` int(11) NOT NULL,
  `feedbackID` int(11) NOT NULL,
  `date` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feedback_date`
--

LOCK TABLES `feedback_date` WRITE;
/*!40000 ALTER TABLE `feedback_date` DISABLE KEYS */;
INSERT INTO `feedback_date` VALUES (1,1,'11 25 2019'),(1,2,'11 26 2019'),(2,3,'12 01 2019'),(3,6,'11 25 2019'),(3,7,'11 25 2019'),(7,8,'11 27 2019');
/*!40000 ALTER TABLE `feedback_date` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `issues`
--

DROP TABLE IF EXISTS `issues`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `issues` (
  `issueID` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(10) NOT NULL,
  `HMemberIDnum` varchar(10) DEFAULT NULL,
  `classification` enum('PLUMBING','ELECTRICAL','ROOM FIXTURES','FURNITURE','ADMINISTRATIVE','APPLIANCE','INFRASTRUCTURE') NOT NULL,
  `status` enum('PENDING','FIXING','FOLLOW UP','RESOLVED') NOT NULL DEFAULT 'PENDING',
  `description` varchar(250) NOT NULL,
  PRIMARY KEY (`issueID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `issues`
--

LOCK TABLES `issues` WRITE;
/*!40000 ALTER TABLE `issues` DISABLE KEYS */;
INSERT INTO `issues` VALUES (1,'11 24 2019',NULL,'ROOM FIXTURES','RESOLVED','The visitors bathroom has no plunger','The Hall',NULL,NULL),(2,'11 24 2019',NULL,'INFRASTRUCTURE','PENDING','The water fountain is not pushing water at reasonable pressure','The Hall',NULL,NULL),(3,'11 24 2019','620117676','PLUMBING','PENDING','The pipe in the kitch keeps running even though it is turned off','Los Matadores','10B1','B'),(4,'11 27 2019','620117676','ELECTRICAL','PENDING','The light bulb in the bathroom is not working','Los Matadores','10B1','B'),(5,'11 27 2019','620117679','APPLIANCE','PENDING','The microwave stopped working','La Maison','20A4','A'),(6,'11 27 2019','620125555','FURNITURE','FIXING','The closet door fell off','Shamrock','50D4','D'),(7,'11 27 2019','620117676','APPLIANCE','RESOLVED','The refrigerator is leaking','Los Matadores','10B1','B');
/*!40000 ALTER TABLE `issues` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login` (
  `username` varchar(10) NOT NULL,
  `password` varchar(8) NOT NULL DEFAULT 'password',
  `type` enum('admin','mtnpersonnel','resident')
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login`
--

LOCK TABLES `login` WRITE;
/*!40000 ALTER TABLE `login` DISABLE KEYS */;
INSERT INTO `login` VALUES ('620117676',SHA2('password',256),'resident');
INSERT INTO 'login' VALUES ('620117679',SHA2('helpme',256),'resident');
INSERT INTO 'login' VALUES ('500004432',SHA2('admin',256),'admin');

/*!40000 ALTER TABLE `login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `loginA`
--

DROP TABLE IF EXISTS `loginA`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `loginA` (
  `username` varchar(10) NOT NULL,
  `password` varchar(8) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loginA`
--

LOCK TABLES `loginA` WRITE;
/*!40000 ALTER TABLE `loginA` DISABLE KEYS */;
INSERT INTO `loginA` VALUES ('500004432','admin');
/*!40000 ALTER TABLE `loginA` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resident`
--

DROP TABLE IF EXISTS `resident`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `resident` (
  `IDnum` varchar(10) NOT NULL,
  `cluster_name` varchar(20) NOT NULL,
  `household` varchar(1) NOT NULL,
  `room_num` varchar(4) DEFAULT NULL,
  PRIMARY KEY (`IDnum`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resident`
--

LOCK TABLES `resident` WRITE;
/*!40000 ALTER TABLE `resident` DISABLE KEYS */;
INSERT INTO `resident` VALUES ('620117676','Los Matadores','B','10B1'),('620117677','Los Matadores','B','10B1'),('620117678','Los Matadores','C','10C4'),('620117679','La Maison','A','20A4'),('620125555','Shamrock','D','50D4');
/*!40000 ALTER TABLE `resident` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-11-27 20:42:13
