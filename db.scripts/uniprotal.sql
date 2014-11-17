CREATE DATABASE  IF NOT EXISTS `uniprotal` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `uniprotal`;
-- MySQL dump 10.13  Distrib 5.5.37, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: uniprotal
-- ------------------------------------------------------
-- Server version	5.5.37-0ubuntu0.12.04.1

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
-- Table structure for table `TEACHERS_SUBJECTS`
--

DROP TABLE IF EXISTS `TEACHERS_SUBJECTS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TEACHERS_SUBJECTS` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TEACHER_ID` int(11) NOT NULL,
  `SUBJECT_ID` int(11) NOT NULL,
  `CREATED_ON` datetime DEFAULT NULL,
  `UPDATED_ON` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=dec8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TEACHERS_SUBJECTS`
--

LOCK TABLES `TEACHERS_SUBJECTS` WRITE;
/*!40000 ALTER TABLE `TEACHERS_SUBJECTS` DISABLE KEYS */;
INSERT INTO `TEACHERS_SUBJECTS` VALUES (59,10,2,NULL,NULL),(60,10,4,NULL,NULL);
/*!40000 ALTER TABLE `TEACHERS_SUBJECTS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `USERS`
--

DROP TABLE IF EXISTS `USERS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `USERS` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `USERNAME` varchar(45) NOT NULL,
  `PASSWORD` varchar(45) NOT NULL,
  `USERTYPE` enum('STUDENT','TEACHER','ADMIN') NOT NULL,
  `EMAIL` varchar(45) NOT NULL,
  `FIRST_NAME` varchar(45) DEFAULT NULL,
  `MIDDLE_NAME` varchar(45) DEFAULT NULL,
  `LAST_NAME` varchar(45) DEFAULT NULL,
  `GENDER` enum('MALE','FEMALE') DEFAULT NULL,
  `DATE_BIRTH` datetime DEFAULT NULL,
  `MARITAL_STAUS` enum('SINGAL','MARRIED','WIDOWED','DIVORCED') DEFAULT NULL,
  `ACADEMIC_YEAR` varchar(45) DEFAULT NULL,
  `REGISTRATION_NUMBER` varchar(45) DEFAULT NULL,
  `EMPLOYEE_NUMBER` varchar(45) DEFAULT NULL,
  `CREATED_ON` datetime DEFAULT NULL,
  `LAST_LOGIN` datetime DEFAULT NULL,
  `ACTIVE` enum('ACTIVE','DELETED','SUSPENDED') DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `USERS`
--

LOCK TABLES `USERS` WRITE;
/*!40000 ALTER TABLE `USERS` DISABLE KEYS */;
INSERT INTO `USERS` VALUES (1,'instructor','5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8','ADMIN','admin@gmail.com','Kumara','Gamage','Rathnay','MALE','2014-06-11 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,'ACTIVE'),(10,'teacher','8cb2237d0679ca88db6464eac60da96345513964','TEACHER','sfsd@sg.sfd','Sandaruwan','Kurana','Withana','MALE','2014-06-11 00:00:00',NULL,'N/A','N/A','sfdsfdsf','0000-00-00 00:00:00','0000-00-00 00:00:00','ACTIVE'),(11,'teacher1','8cb2237d0679ca88db6464eac60da96345513964','TEACHER','sfddsf@sdf.sdf','sfsdf','sfsdf','sdfdsfd','FEMALE','2014-06-11 00:00:00',NULL,'N/A','N/A','sdfsfdds','0000-00-00 00:00:00','0000-00-00 00:00:00','ACTIVE'),(13,'student','8cb2237d0679ca88db6464eac60da96345513964','STUDENT','anandafit@gmail.com','sdfdsf','sdf','sdf','MALE','2014-06-11 00:00:00',NULL,'2010','92-pr','N/A','0000-00-00 00:00:00','0000-00-00 00:00:00','ACTIVE'),(14,'sanjaya','8cb2237d0679ca88db6464eac60da96345513964','STUDENT','sanjaya@gmail.com','Sanjaya','Menaka','Kumara','MALE','1988-05-04 00:00:00',NULL,'2014','PGIS/SC/M.Sc/CSC/11/43','N/A','0000-00-00 00:00:00','0000-00-00 00:00:00','ACTIVE');
/*!40000 ALTER TABLE `USERS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `QUECTIONS`
--

DROP TABLE IF EXISTS `QUECTIONS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `QUECTIONS` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `EXAM_ID` int(4) DEFAULT NULL,
  `QUECTION_REFF_ID` int(11) DEFAULT NULL,
  `QUECTION` text,
  `CORRECT_ANSWERS` text,
  `ANSWERS` text,
  `TYPE` enum('MCQ','EASSAY') DEFAULT NULL,
  `MARKS` int(4) DEFAULT NULL,
  `CREATED_BY` varchar(45) DEFAULT NULL,
  `CREATED_ON` datetime DEFAULT NULL,
  `UPDATED_ON` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=dec8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `QUECTIONS`
--

LOCK TABLES `QUECTIONS` WRITE;
/*!40000 ALTER TABLE `QUECTIONS` DISABLE KEYS */;
INSERT INTO `QUECTIONS` VALUES (35,18,1,'lobortis. Class aptent taciti sociosqu ad litora?','Aliquam ornare','adipiscing;Mauris molestie; pharetra nibh;Aliquam ornare',NULL,NULL,NULL,NULL,NULL),(36,18,2,'et netus?','ornare egestas ligula','erat volutpat;Nulla dignissim. Maecenas;ornare egestas ligula;Nullam feugiat',NULL,NULL,NULL,NULL,NULL),(37,18,3,'ultricies sem magna nec?','dictum4','dictum1;dictum2;dictum3;dictum4',NULL,NULL,NULL,NULL,NULL),(38,19,1,'lobortis. Class aptent taciti sociosqu ad litora?','Aliquam ornare','adipiscing;Mauris molestie; pharetra nibh;Aliquam ornare',NULL,NULL,NULL,NULL,NULL),(39,19,2,'et netus?','ornare egestas ligula','erat volutpat;Nulla dignissim. Maecenas;ornare egestas ligula;Nullam feugiat',NULL,NULL,NULL,NULL,NULL),(40,19,3,'ultricies sem magna nec?','dictum4','dictum1;dictum2;dictum3;dictum4',NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `QUECTIONS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `STUDENTS_EXAMS`
--

DROP TABLE IF EXISTS `STUDENTS_EXAMS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `STUDENTS_EXAMS` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `USER_ID` int(11) NOT NULL,
  `EXAMS_ID` int(11) NOT NULL,
  `STATUS` enum('SUBSCRIBED','WRITING','REJECTED','SUBMITTED','MARKED') NOT NULL,
  `MARKS` int(11) DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `STUDENTS_EXAMS`
--

LOCK TABLES `STUDENTS_EXAMS` WRITE;
/*!40000 ALTER TABLE `STUDENTS_EXAMS` DISABLE KEYS */;
INSERT INTO `STUDENTS_EXAMS` VALUES (9,13,18,'MARKED',100);
/*!40000 ALTER TABLE `STUDENTS_EXAMS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ANSWERS`
--

DROP TABLE IF EXISTS `ANSWERS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ANSWERS` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ANSWER` text,
  `STUDENT_EXAM_ID` int(11) DEFAULT NULL,
  `QUECTION_ID` int(11) DEFAULT NULL,
  `MARKS` int(4) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=dec8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ANSWERS`
--

LOCK TABLES `ANSWERS` WRITE;
/*!40000 ALTER TABLE `ANSWERS` DISABLE KEYS */;
INSERT INTO `ANSWERS` VALUES (68,'Aliquam ornare',9,35,NULL),(69,'ornare egestas ligula',9,36,NULL),(70,'dictum4',9,37,NULL);
/*!40000 ALTER TABLE `ANSWERS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SUBJECTS`
--

DROP TABLE IF EXISTS `SUBJECTS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SUBJECTS` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TITLE` varchar(45) DEFAULT NULL,
  `CODE` varchar(45) DEFAULT NULL,
  `CREATED_ON` datetime DEFAULT NULL,
  `UPDATED_ON` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SUBJECTS`
--

LOCK TABLES `SUBJECTS` WRITE;
/*!40000 ALTER TABLE `SUBJECTS` DISABLE KEYS */;
INSERT INTO `SUBJECTS` VALUES (1,'Botany','botany',NULL,NULL),(2,'Chemistry','chemistry',NULL,NULL),(3,'Computer Science','computer-science',NULL,NULL),(4,'Geology','geology',NULL,NULL),(5,'Mathematics','mathematics',NULL,NULL),(6,'Molecular biology','molecular-biology',NULL,NULL),(7,'Physics','physics',NULL,NULL),(8,'Statistics','statistics',NULL,NULL),(9,'Zoology','zoology',NULL,NULL);
/*!40000 ALTER TABLE `SUBJECTS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `EXAMS`
--

DROP TABLE IF EXISTS `EXAMS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `EXAMS` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `YEAR` int(4) DEFAULT NULL,
  `SEMESTER` int(1) DEFAULT NULL,
  `SUBJECT_CODE` varchar(10) DEFAULT NULL,
  `CREATED_BY` int(11) DEFAULT NULL,
  `CREATED_ON` datetime DEFAULT NULL,
  `EXAM_DATE` datetime DEFAULT NULL,
  `DUE_DATE` datetime DEFAULT NULL,
  `TITLE` varchar(45) DEFAULT NULL,
  `UPDATED_ON` datetime DEFAULT NULL,
  `STATUS` enum('DRAFT','PUBLISHED','DELETED') DEFAULT NULL,
  `DESCRIPTION` text,
  `FILE_NAME` varchar(45) DEFAULT NULL,
  `EXAM_CODE` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `EXAMS`
--

LOCK TABLES `EXAMS` WRITE;
/*!40000 ALTER TABLE `EXAMS` DISABLE KEYS */;
INSERT INTO `EXAMS` VALUES (18,2014,1,'2',10,NULL,NULL,'2014-06-30 03:10:00','New Chemistry Class',NULL,'PUBLISHED','This is Chemistry paper',NULL,'chemistry-01'),(19,2014,1,'4',10,NULL,NULL,'2014-06-30 03:12:00','Geology good',NULL,'PUBLISHED','Geology exam',NULL,'Geology-0112');
/*!40000 ALTER TABLE `EXAMS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SUBJECTS_EXAMS`
--

DROP TABLE IF EXISTS `SUBJECTS_EXAMS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SUBJECTS_EXAMS` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `SUBJECTS_ID` int(11) DEFAULT NULL,
  `EXAMS_ID` int(11) DEFAULT NULL,
  `CREATED_ON` datetime DEFAULT NULL,
  `UPDATED_ON` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=dec8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SUBJECTS_EXAMS`
--

LOCK TABLES `SUBJECTS_EXAMS` WRITE;
/*!40000 ALTER TABLE `SUBJECTS_EXAMS` DISABLE KEYS */;
/*!40000 ALTER TABLE `SUBJECTS_EXAMS` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-07-14 21:29:40
