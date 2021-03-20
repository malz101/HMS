-- MySQL dump 10.13  Distrib 5.7.28, for Linux (x86_64)
--
-- Host: localhost    Database: azprestonhall
-- ------------------------------------------------------
-- Server version	5.7.28-0ubuntu0.19.04.2

--
-- Table structure for table `admin`
--
DROP DATABASE IF EXISTS azhms;
CREATE DATABASE azhms;
USE azhms;
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id_num` varchar(10) NOT NULL,
  `cluster_name` varchar(20) NOT NULL DEFAULT 'NOT ASSIGNED',
  `room_num` varchar(4) NOT NULL DEFAULT 'NONE',
  `position` enum('Resident Advisor','Student Services and Development Manager','Hall Chair','Deputy Hall Chair','Operations Manager','Courier Attendant') NOT NULL,
  `full_name` varchar(30) NOT NULL,
  PRIMARY KEY (`id_num`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--
LOCK TABLES `admin` WRITE;
INSERT INTO `admin` VALUES ('500004432','NOT ASSIGNED','NONE','Resident Advisor','John Doe');
UNLOCK TABLES;


--
-- Table structure for table `feedback`
--
DROP TABLE IF EXISTS `feedback`;
CREATE TABLE `feedback` (
  `issueID` int NOT NULL,
  `sender` varchar(10) NOT NULL DEFAULT 'ANONYMOUS',
  `comment` varchar(250) NOT NULL,
  `date` date NOT NULL,
  `isRead` int NOT NULL DEFAULT '0'
  
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--
LOCK TABLES `feedback` WRITE;
INSERT INTO `feedback` VALUES (1,'ANONYMOUS','Request Received','2019-09-01',0);
INSERT INTO `feedback` VALUES (1,'ANONYMOUS','Thank you, the plunger was delivered','2019-09-01',0);
INSERT INTO `feedback` VALUES (2,'ANONYMOUS','The plumber had attended to the issue','2019-10-11',0);
INSERT INTO `feedback` VALUES (3,'620117676','I have received no response about the leaking pipe in my household kitchen','2019-12-08',0);
INSERT INTO `feedback` VALUES (3,'620117676','Apologies, we will send a plumber in 3 days','2019-11-10',0);
INSERT INTO `feedback` VALUES (7,'620117676', 'Our food started to rot','2019-12-02',0);
UNLOCK TABLES;


--
-- Table structure for table `issues`
--
DROP TABLE IF EXISTS `issues`;
CREATE TABLE `issues` (
  `issueID` int NOT NULL AUTO_INCREMENT,
  `date` varchar(10) NOT NULL,
  `HMemberIDnum` varchar(10) DEFAULT NULL,
  `classification` enum('PLUMBING','ELECTRICAL','ROOM FIXTURES','FURNITURE','ADMINISTRATIVE','APPLIANCE','INFRASTRUCTURE') NOT NULL,
  `status` enum('PENDING','FIXING','FOLLOW UP','RESOLVED') NOT NULL DEFAULT 'PENDING',
  `description` varchar(250) NOT NULL,
  PRIMARY KEY (`issueID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `issues`
--
LOCK TABLES `issues` WRITE;
INSERT INTO `issues` VALUES (1,'11 24 2019',NULL,'ROOM FIXTURES','RESOLVED','The visitors bathroom has no plunger');
INSERT INTO `issues` VALUES (2,'11 24 2019',NULL,'INFRASTRUCTURE','PENDING','The water fountain is not pushing water at reasonable pressure');
INSERT INTO `issues` VALUES (3,'11 24 2019','620117676','PLUMBING','PENDING','The pipe in the kitch keeps running even though it is turned off');
INSERT INTO `issues` VALUES (4,'11 27 2019','620117676','ELECTRICAL','PENDING','The light bulb in the bathroom is not working'); 
INSERT INTO `issues` VALUES (5,'11 27 2019','620117679','APPLIANCE','PENDING','The microwave stopped working'); 
INSERT INTO `issues` VALUES (6,'11 27 2019','620125555','FURNITURE','FIXING','The closet door fell off');
INSERT INTO `issues` VALUES (7,'11 27 2019','620117676','APPLIANCE','RESOLVED','The refrigerator is leaking');
UNLOCK TABLES;



--
-- Table structure for table `login`
--
DROP TABLE IF EXISTS `login`;
CREATE TABLE `login` (
  `id` varchar(10) NOT NULL,
  `password` varchar(64) NOT NULL DEFAULT 'password',
  `type` enum('admin','mtnpersonnel','resident'),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--
LOCK TABLES `login` WRITE;
INSERT INTO `login` VALUES ('620117676',SHA2('password',256),'resident');
INSERT INTO `login` VALUES ('620117679',SHA2('helpme',256),'resident');
INSERT INTO `login` VALUES ('500004432',SHA2('admin',256),'admin');
UNLOCK TABLES;



--
-- Table structure for table `resident`
--
DROP TABLE IF EXISTS `resident`;
CREATE TABLE `resident` (
  `IDnum` varchar(10) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `cluster_name` varchar(20) NOT NULL,
  `household` varchar(1) NOT NULL,
  `room_num` varchar(4) DEFAULT NULL,
  PRIMARY KEY (`IDnum`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `resident`
--
LOCK TABLES `resident` WRITE;
INSERT INTO `resident` VALUES ('620117676','Mark','Lewis','Los Matadores','B','10B1');
INSERT INTO `resident` VALUES ('620117677','Stacy','Brown','Los Matadores','B','10B1');
INSERT INTO `resident` VALUES ('620117678','Keisha','Reynolds','Los Matadores','C','10C4');
INSERT INTO `resident` VALUES ('620117679','Jeremy','Doe','La Maison','A','20A4');
INSERT INTO `resident` VALUES ('620125555','Sue','Chin','Shamrock','D','50D4');

UNLOCK TABLES;
-- Dump completed on 2019-11-27 20:42:13