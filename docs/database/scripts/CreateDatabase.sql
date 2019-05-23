CREATE DATABASE  IF NOT EXISTS `tpi` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */;
USE `tpi`;
-- MySQL dump 10.13  Distrib 8.0.15, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: tpi
-- ------------------------------------------------------
-- Server version	8.0.15

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `courts`
--

DROP TABLE IF EXISTS `courts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `courts` (
  `IdCourt` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(45) NOT NULL,
  `Desc` longtext,
  `Deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`IdCourt`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `courts`
--

LOCK TABLES `courts` WRITE;
/*!40000 ALTER TABLE `courts` DISABLE KEYS */;
INSERT INTO `courts` VALUES (1,'Court1','Le premier Court',0),(2,'Court 2','Le deuxième court modifié',1),(3,'Court 3','',0),(4,'Test','',0),(5,'Court 4','',0);
/*!40000 ALTER TABLE `courts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `preferences`
--

DROP TABLE IF EXISTS `preferences`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `preferences` (
  `Updated` datetime NOT NULL,
  `BeginTime` datetime NOT NULL,
  `EndTime` datetime NOT NULL,
  `NbReservationsByUser` int(11) NOT NULL,
  PRIMARY KEY (`Updated`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `preferences`
--

LOCK TABLES `preferences` WRITE;
/*!40000 ALTER TABLE `preferences` DISABLE KEYS */;
INSERT INTO `preferences` VALUES ('2019-05-22 09:46:50','2000-00-00 08:00:00','2000-00-00 21:00:00',2);
/*!40000 ALTER TABLE `preferences` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `reservations` (
  `IdCourt` int(11) NOT NULL,
  `Nickname` varchar(20) NOT NULL,
  `Date` datetime NOT NULL,
  PRIMARY KEY (`IdCourt`,`Nickname`,`Date`),
  KEY `UserReservation_idx` (`Nickname`),
  CONSTRAINT `CourtReservation` FOREIGN KEY (`IdCourt`) REFERENCES `courts` (`IdCourt`),
  CONSTRAINT `UserReservation` FOREIGN KEY (`Nickname`) REFERENCES `users` (`Nickname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservations`
--

LOCK TABLES `reservations` WRITE;
/*!40000 ALTER TABLE `reservations` DISABLE KEYS */;
INSERT INTO `reservations` VALUES (1,'Test','2010-04-02 15:28:22'),(1,'Test','2019-05-28 09:00:00'),(1,'Test','2019-05-28 13:00:00'),(1,'Test','2019-05-29 07:00:00'),(1,'Test','2019-05-29 10:00:00'),(1,'Test','2019-05-29 12:00:00'),(1,'Test','2019-05-30 10:00:00'),(2,'Test','2010-04-02 13:00:00'),(1,'Test2','2010-04-02 16:00:00'),(2,'Test3','2010-04-02 16:00:00'),(1,'Titi','2019-06-05 11:00:00'),(3,'Titi','2019-05-27 14:00:00');
/*!40000 ALTER TABLE `reservations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `roles` (
  `Code` int(11) NOT NULL,
  `Label` varchar(255) NOT NULL,
  PRIMARY KEY (`Code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Admin'),(2,'User');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tokens`
--

DROP TABLE IF EXISTS `tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tokens` (
  `Nickname` varchar(20) NOT NULL,
  `ValidateTill` datetime NOT NULL,
  `Code` varchar(20) NOT NULL,
  PRIMARY KEY (`Nickname`),
  UNIQUE KEY `Code_UNIQUE` (`Code`),
  CONSTRAINT `UserToken` FOREIGN KEY (`Nickname`) REFERENCES `users` (`Nickname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tokens`
--

LOCK TABLES `tokens` WRITE;
/*!40000 ALTER TABLE `tokens` DISABLE KEYS */;
INSERT INTO `tokens` VALUES ('asd','2019-05-23 08:44:41','xc7Gh7zfMrIaMbHRKRhf'),('asdfxy','2019-05-23 08:45:44','IjgeDGJKoNkRwOPd9l7x'),('Test','2010-04-02 00:00:00','ASDVYSDFADSF'),('Test2','2019-05-14 15:50:12','asdasdfasdf'),('Test3','2019-05-14 15:56:40','etlhurXWo2uVQXCOs2z9'),('Test36','2019-05-23 08:43:37','LNmYSPjPIsqCImKgyqrr'),('Test4','2019-05-15 14:43:30','j3rFfX4D7KLcQrOCLz0l'),('Test5','2019-05-15 15:04:31','mAvZo7wYW3lulnmXlWgJ'),('Test54','2019-05-23 08:16:44','awXLL6KURvAiD3wfpPzK'),('Test6','2019-05-15 16:17:55','OC4QaDb2RYtlYNKtVMdJ'),('Test7','2019-05-15 16:20:20','hn9ZAiQRa0NQhUKGaxfr'),('Titi','2019-05-17 08:40:19','9O3J1vTo5X0Eectg2JB1'),('Toto','2019-05-15 16:28:33','Ox2ZHvp2hNe6JM6W1kTU'),('UnTest','2019-05-22 14:52:14','cGYZN8uTWy5757QNjUNC');
/*!40000 ALTER TABLE `tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `users` (
  `Nickname` varchar(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Firstname` varchar(255) NOT NULL,
  `Password` varchar(42) NOT NULL,
  `Phone` varchar(14) NOT NULL,
  `email` varchar(255) NOT NULL,
  `IsConfirmed` tinyint(4) DEFAULT NULL,
  `CodeRole` int(11) NOT NULL,
  PRIMARY KEY (`Nickname`),
  UNIQUE KEY `Nickname_UNIQUE` (`Nickname`),
  UNIQUE KEY `Phone_UNIQUE` (`Phone`),
  KEY `RoleUser_idx` (`CodeRole`),
  CONSTRAINT `RoleUser` FOREIGN KEY (`CodeRole`) REFERENCES `roles` (`Code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('asd','','','f6889fc97e14b42dec11a8c183ea791c5465b658','','loic.brnnd@eduge.ch',0,2),('asdfxy','Burnand','','f6889fc97e14b42dec11a8c183ea791c5465b658','1231','loic.brnnd@eduge.ch',0,2),('Test','Burnand','Loic','f6889fc97e14b42dec11a8c183ea791c5465b658','0767786644','burnand@loic.com',1,1),('Test2','toto','test','f6889fc97e14b42dec11a8c183ea791c5465b658','0767786642','toto@test.com',1,2),('Test3','Burnand2','Loic','f6889fc97e14b42dec11a8c183ea791c5465b658','0767756644','loic@burnand.com',1,1),('Test36','Burnand','','f6889fc97e14b42dec11a8c183ea791c5465b658','0781234522','loic.brnnd@eduge.ch',0,2),('Test4','Burnand','','Super','0767796633','loic.brnnd@eduge.ch',1,2),('Test5','Test','','Super','0783109122','loic.brnnd@eduge.ch',0,2),('Test54','Burnand','','f6889fc97e14b42dec11a8c183ea791c5465b658','0981273144','loic.brnnd@eduge.ch',0,2),('Test6','Burnand','','Super','0783109121','loicburnand@gmail.com',NULL,2),('Test7','Burnand','','Super','0783109120','loicburnand@gmail.com',0,2),('Titi','Test','','f6889fc97e14b42dec11a8c183ea791c5465b658','09321313','loicburnand@gmail.com',1,2),('Toto','Burna','','Super','04912352','loic.brnnd@eduge.ch',0,2),('UnTest','Burnand','','f6889fc97e14b42dec11a8c183ea791c5465b658','0983123322','loic.brnnd@eduge.ch',0,2);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

CREATE USER 'Admin'@'127.0.0.1' IDENTIFIED BY 'root';
GRANT SELECT, INSERT, UPDATE, DELETE ON tpi.* TO 'Admin'@'localhost';
CREATE USER 'Admin'@'127.0.0.1' IDENTIFIED BY 'root';
GRANT SELECT, INSERT, UPDATE, DELETE ON tpi.* TO 'Admin'@'localhost';

FLUSH PRIVILEGES;

-- Dump completed on 2019-05-23 15:16:05
