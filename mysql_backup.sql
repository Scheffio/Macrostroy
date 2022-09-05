-- MySQL dump 10.13  Distrib 8.0.29, for Linux (x86_64)
--
-- Host: localhost    Database: macrostroy_db
-- ------------------------------------------------------
-- Server version	8.0.29-0ubuntu0.20.04.3

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
-- Table structure for table `obj_group`
--

DROP TABLE IF EXISTS `obj_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `obj_group` (
  `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID группы',
  `name` varchar(255) NOT NULL COMMENT 'Наименование',
  `status` set('in_process','completed','deleted') NOT NULL DEFAULT 'in_process' COMMENT 'Статус (в процессе, завершен, удален)',
  `is_public` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Доступ (публичный, приватный)',
  `is_available` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Доступ (доступный, удаленный)',
  `subproject_id` int unsigned NOT NULL COMMENT 'ID подпроекта',
  `version` int DEFAULT '0',
  `version_created_at` timestamp NULL DEFAULT NULL,
  `version_created_by` varchar(100) DEFAULT NULL,
  `version_comment` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subproject_id` (`subproject_id`),
  CONSTRAINT `groups_ibfk_1` FOREIGN KEY (`subproject_id`) REFERENCES `obj_subproject` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `obj_group`
--

LOCK TABLES `obj_group` WRITE;
/*!40000 ALTER TABLE `obj_group` DISABLE KEYS */;
INSERT INTO `obj_group` VALUES (1,'PutTestGroup','deleted',0,0,3,3,'2022-09-05 10:15:01','12','delete');
/*!40000 ALTER TABLE `obj_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `obj_group_version`
--

DROP TABLE IF EXISTS `obj_group_version`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `obj_group_version` (
  `id` int unsigned NOT NULL COMMENT 'ID группы',
  `name` varchar(255) NOT NULL COMMENT 'Наименование',
  `status` set('in_process','completed','deleted') NOT NULL DEFAULT 'in_process' COMMENT 'Статус (в процессе, завершен, удален)',
  `is_public` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Доступ (публичный, приватный)',
  `is_available` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Доступ (доступный, удаленный)',
  `subproject_id` int unsigned NOT NULL COMMENT 'ID подпроекта',
  `version` int NOT NULL DEFAULT '0',
  `version_created_at` timestamp NULL DEFAULT NULL,
  `version_created_by` varchar(100) DEFAULT NULL,
  `version_comment` varchar(255) DEFAULT NULL,
  `subproject_id_version` int DEFAULT '0',
  `obj_house_ids` text,
  `obj_house_versions` text,
  PRIMARY KEY (`id`,`version`),
  CONSTRAINT `obj_group_version_fk_663c1c` FOREIGN KEY (`id`) REFERENCES `obj_group` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `obj_group_version`
--

LOCK TABLES `obj_group_version` WRITE;
/*!40000 ALTER TABLE `obj_group_version` DISABLE KEYS */;
INSERT INTO `obj_group_version` VALUES (1,'GroupTest1','in_process',1,1,3,1,'2022-09-05 09:27:12','12','insert',1,NULL,NULL),(1,'PutTestGroup','in_process',1,1,3,2,'2022-09-05 09:38:42','12','update',2,'| 1 |','| 2 |'),(1,'PutTestGroup','deleted',0,0,3,3,'2022-09-05 10:15:01','12','delete',2,'| 1 |','| 4 |');
/*!40000 ALTER TABLE `obj_group_version` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `obj_house`
--

DROP TABLE IF EXISTS `obj_house`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `obj_house` (
  `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID дома',
  `name` varchar(255) NOT NULL COMMENT 'Наименование',
  `status` set('in_process','completed','deleted') NOT NULL DEFAULT 'in_process' COMMENT 'Статус (в процессе, завершен, удален)',
  `is_public` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Доступ (публичный, приватный)',
  `is_available` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Доступ (доступный, удаленный)',
  `group_id` int unsigned NOT NULL COMMENT 'Id группы',
  `version` int DEFAULT '0',
  `version_created_at` timestamp NULL DEFAULT NULL,
  `version_created_by` varchar(100) DEFAULT NULL,
  `version_comment` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `group_id` (`group_id`),
  CONSTRAINT `house_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `obj_group` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `obj_house`
--

LOCK TABLES `obj_house` WRITE;
/*!40000 ALTER TABLE `obj_house` DISABLE KEYS */;
INSERT INTO `obj_house` VALUES (1,'PutTestHouse','deleted',0,0,1,4,'2022-09-05 10:14:26','12','delete');
/*!40000 ALTER TABLE `obj_house` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `obj_house_version`
--

DROP TABLE IF EXISTS `obj_house_version`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `obj_house_version` (
  `id` int unsigned NOT NULL COMMENT 'ID дома',
  `name` varchar(255) NOT NULL COMMENT 'Наименование',
  `status` set('in_process','completed','deleted') NOT NULL DEFAULT 'in_process' COMMENT 'Статус (в процессе, завершен, удален)',
  `is_public` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Доступ (публичный, приватный)',
  `is_available` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Доступ (доступный, удаленный)',
  `group_id` int unsigned NOT NULL COMMENT 'Id группы',
  `version` int NOT NULL DEFAULT '0',
  `version_created_at` timestamp NULL DEFAULT NULL,
  `version_created_by` varchar(100) DEFAULT NULL,
  `version_comment` varchar(255) DEFAULT NULL,
  `group_id_version` int DEFAULT '0',
  `obj_stage_ids` text,
  `obj_stage_versions` text,
  PRIMARY KEY (`id`,`version`),
  CONSTRAINT `obj_house_version_fk_21140d` FOREIGN KEY (`id`) REFERENCES `obj_house` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `obj_house_version`
--

LOCK TABLES `obj_house_version` WRITE;
/*!40000 ALTER TABLE `obj_house_version` DISABLE KEYS */;
INSERT INTO `obj_house_version` VALUES (1,'HouseTest1','in_process',1,1,1,1,'2022-09-05 09:27:44','12','insert',1,NULL,NULL),(1,'PutTestGroup','in_process',1,1,1,2,'2022-09-05 09:38:16','12','update',1,'| 1 |','| 1 |'),(1,'PutTestHouse','in_process',1,1,1,3,'2022-09-05 09:38:59','12','update',2,'| 1 |','| 1 |'),(1,'PutTestHouse','deleted',0,0,1,4,'2022-09-05 10:14:26','12','delete',2,'| 1 | 2 |','| 3 | 2 |');
/*!40000 ALTER TABLE `obj_house_version` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `obj_project`
--

DROP TABLE IF EXISTS `obj_project`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `obj_project` (
  `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID проекта',
  `name` varchar(255) NOT NULL COMMENT 'Наименование',
  `status` set('in_process','completed','deleted') NOT NULL DEFAULT 'in_process' COMMENT 'Статус (в процессе, завершен, удален)',
  `is_public` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Доступ (публичный, приватный)',
  `is_available` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Доступ (доступный, удаленный)',
  `version` int DEFAULT '0',
  `version_created_at` timestamp NULL DEFAULT NULL,
  `version_created_by` varchar(100) DEFAULT NULL,
  `version_comment` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `obj_project`
--

LOCK TABLES `obj_project` WRITE;
/*!40000 ALTER TABLE `obj_project` DISABLE KEYS */;
INSERT INTO `obj_project` VALUES (1,'NewNameProject','deleted',0,0,3,'2022-08-31 12:53:32','12','delete'),(2,'ProjectName2','in_process',1,1,1,'2022-09-01 12:41:15','12','insert'),(3,'PutTestProject','deleted',0,0,3,'2022-09-05 10:15:01','12','delete'),(4,'Project3','in_process',1,1,1,'2022-09-05 10:21:35','12','insert');
/*!40000 ALTER TABLE `obj_project` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `obj_project_version`
--

DROP TABLE IF EXISTS `obj_project_version`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `obj_project_version` (
  `id` int unsigned NOT NULL COMMENT 'ID проекта',
  `name` varchar(255) NOT NULL COMMENT 'Наименование',
  `status` set('in_process','completed','deleted') NOT NULL DEFAULT 'in_process' COMMENT 'Статус (в процессе, завершен, удален)',
  `is_public` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Доступ (публичный, приватный)',
  `is_available` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Доступ (доступный, удаленный)',
  `version` int NOT NULL DEFAULT '0',
  `version_created_at` timestamp NULL DEFAULT NULL,
  `version_created_by` varchar(100) DEFAULT NULL,
  `version_comment` varchar(255) DEFAULT NULL,
  `obj_subproject_ids` text,
  `obj_subproject_versions` text,
  PRIMARY KEY (`id`,`version`),
  CONSTRAINT `obj_project_version_fk_09ccc9` FOREIGN KEY (`id`) REFERENCES `obj_project` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `obj_project_version`
--

LOCK TABLES `obj_project_version` WRITE;
/*!40000 ALTER TABLE `obj_project_version` DISABLE KEYS */;
INSERT INTO `obj_project_version` VALUES (1,'ProjectName','in_process',1,1,1,'2022-08-31 12:40:23','12','insert',NULL,NULL),(1,'NewNameProject','in_process',1,1,2,'2022-08-31 12:52:17','12','update',NULL,NULL),(1,'NewNameProject','deleted',0,0,3,'2022-08-31 12:53:32','12','delete',NULL,NULL),(2,'ProjectName2','in_process',1,1,1,'2022-09-01 12:41:15','12','insert',NULL,NULL),(3,'ProjectName3','in_process',1,1,1,'2022-09-05 09:26:12','12','insert',NULL,NULL),(3,'PutTestProject','in_process',1,1,2,'2022-09-05 09:37:06','12','update','| 3 |','| 1 |'),(3,'PutTestProject','deleted',0,0,3,'2022-09-05 10:15:01','12','delete','| 3 |','| 3 |'),(4,'Project3','in_process',1,1,1,'2022-09-05 10:21:35','12','insert',NULL,NULL);
/*!40000 ALTER TABLE `obj_project_version` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `obj_stage`
--

DROP TABLE IF EXISTS `obj_stage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `obj_stage` (
  `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID этапа',
  `name` varchar(255) NOT NULL COMMENT 'Наименование',
  `status` set('in_process','completed','deleted') NOT NULL DEFAULT 'in_process' COMMENT 'Статус (в процессе, завершен, удален)',
  `is_public` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Доступ (публичный, приватный)',
  `is_available` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Доступ (доступный, удаленный)',
  `house_id` int unsigned NOT NULL COMMENT 'ID дома',
  `version` int DEFAULT '0',
  `version_created_at` timestamp NULL DEFAULT NULL,
  `version_created_by` varchar(100) DEFAULT NULL,
  `version_comment` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `house_id` (`house_id`),
  CONSTRAINT `stage_ibfk_1` FOREIGN KEY (`house_id`) REFERENCES `obj_house` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `obj_stage`
--

LOCK TABLES `obj_stage` WRITE;
/*!40000 ALTER TABLE `obj_stage` DISABLE KEYS */;
INSERT INTO `obj_stage` VALUES (1,'PutTestStage','deleted',0,0,1,3,'2022-09-05 10:14:26','12','delete'),(2,'StageTest2','deleted',0,0,1,2,'2022-09-05 10:04:50','12','delete');
/*!40000 ALTER TABLE `obj_stage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `obj_stage_material`
--

DROP TABLE IF EXISTS `obj_stage_material`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `obj_stage_material` (
  `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID материала работы на этапе',
  `price` decimal(19,2) unsigned NOT NULL COMMENT 'Стоимость',
  `amount` decimal(19,2) unsigned NOT NULL COMMENT 'Кол-во',
  `is_available` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Доступ (доступный, удаленный)',
  `material_id` int unsigned NOT NULL COMMENT 'ID материала',
  `stage_work_id` int unsigned NOT NULL COMMENT 'ID работы этапа',
  `version` int DEFAULT '0',
  `version_created_at` timestamp NULL DEFAULT NULL,
  `version_created_by` varchar(100) DEFAULT NULL,
  `version_comment` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `material_id` (`material_id`),
  KEY `stage_work_id` (`stage_work_id`),
  CONSTRAINT `stage_material_ibfk_1` FOREIGN KEY (`material_id`) REFERENCES `vol_material` (`id`),
  CONSTRAINT `stage_material_ibfk_2` FOREIGN KEY (`stage_work_id`) REFERENCES `obj_stage_work` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `obj_stage_material`
--

LOCK TABLES `obj_stage_material` WRITE;
/*!40000 ALTER TABLE `obj_stage_material` DISABLE KEYS */;
/*!40000 ALTER TABLE `obj_stage_material` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `obj_stage_material_version`
--

DROP TABLE IF EXISTS `obj_stage_material_version`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `obj_stage_material_version` (
  `id` int unsigned NOT NULL COMMENT 'ID материала работы на этапе',
  `price` decimal(19,2) unsigned NOT NULL COMMENT 'Стоимость',
  `amount` decimal(19,2) unsigned NOT NULL COMMENT 'Кол-во',
  `is_available` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Доступ (доступный, удаленный)',
  `material_id` int unsigned NOT NULL COMMENT 'ID материала',
  `stage_work_id` int unsigned NOT NULL COMMENT 'ID работы этапа',
  `version` int NOT NULL DEFAULT '0',
  `version_created_at` timestamp NULL DEFAULT NULL,
  `version_created_by` varchar(100) DEFAULT NULL,
  `version_comment` varchar(255) DEFAULT NULL,
  `material_id_version` int DEFAULT '0',
  `stage_work_id_version` int DEFAULT '0',
  PRIMARY KEY (`id`,`version`),
  CONSTRAINT `obj_stage_material_version_fk_68f469` FOREIGN KEY (`id`) REFERENCES `obj_stage_material` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `obj_stage_material_version`
--

LOCK TABLES `obj_stage_material_version` WRITE;
/*!40000 ALTER TABLE `obj_stage_material_version` DISABLE KEYS */;
/*!40000 ALTER TABLE `obj_stage_material_version` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `obj_stage_technic`
--

DROP TABLE IF EXISTS `obj_stage_technic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `obj_stage_technic` (
  `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID техники работы',
  `price` decimal(19,2) unsigned NOT NULL COMMENT 'Стоимость',
  `amount` decimal(19,2) unsigned NOT NULL COMMENT 'Кол-во',
  `is_available` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Доступ (доступный, удаленный)',
  `technic_id` int unsigned NOT NULL COMMENT 'ID техники',
  `stage_work_id` int unsigned NOT NULL COMMENT 'ID работы этапа',
  `version` int DEFAULT '0',
  `version_created_at` timestamp NULL DEFAULT NULL,
  `version_created_by` varchar(100) DEFAULT NULL,
  `version_comment` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `stage_work_id` (`stage_work_id`),
  KEY `technic_id` (`technic_id`),
  CONSTRAINT `stage_technic_ibfk_1` FOREIGN KEY (`stage_work_id`) REFERENCES `obj_stage_work` (`id`),
  CONSTRAINT `stage_technic_ibfk_2` FOREIGN KEY (`technic_id`) REFERENCES `vol_technic` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `obj_stage_technic`
--

LOCK TABLES `obj_stage_technic` WRITE;
/*!40000 ALTER TABLE `obj_stage_technic` DISABLE KEYS */;
/*!40000 ALTER TABLE `obj_stage_technic` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `obj_stage_technic_version`
--

DROP TABLE IF EXISTS `obj_stage_technic_version`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `obj_stage_technic_version` (
  `id` int unsigned NOT NULL COMMENT 'ID техники работы',
  `price` decimal(19,2) unsigned NOT NULL COMMENT 'Стоимость',
  `amount` decimal(19,2) unsigned NOT NULL COMMENT 'Кол-во',
  `is_available` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Доступ (доступный, удаленный)',
  `technic_id` int unsigned NOT NULL COMMENT 'ID техники',
  `stage_work_id` int unsigned NOT NULL COMMENT 'ID работы этапа',
  `version` int NOT NULL DEFAULT '0',
  `version_created_at` timestamp NULL DEFAULT NULL,
  `version_created_by` varchar(100) DEFAULT NULL,
  `version_comment` varchar(255) DEFAULT NULL,
  `stage_work_id_version` int DEFAULT '0',
  `technic_id_version` int DEFAULT '0',
  PRIMARY KEY (`id`,`version`),
  CONSTRAINT `obj_stage_technic_version_fk_63bbbc` FOREIGN KEY (`id`) REFERENCES `obj_stage_technic` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `obj_stage_technic_version`
--

LOCK TABLES `obj_stage_technic_version` WRITE;
/*!40000 ALTER TABLE `obj_stage_technic_version` DISABLE KEYS */;
/*!40000 ALTER TABLE `obj_stage_technic_version` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `obj_stage_version`
--

DROP TABLE IF EXISTS `obj_stage_version`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `obj_stage_version` (
  `id` int unsigned NOT NULL COMMENT 'ID этапа',
  `name` varchar(255) NOT NULL COMMENT 'Наименование',
  `status` set('in_process','completed','deleted') NOT NULL DEFAULT 'in_process' COMMENT 'Статус (в процессе, завершен, удален)',
  `is_public` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Доступ (публичный, приватный)',
  `is_available` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Доступ (доступный, удаленный)',
  `house_id` int unsigned NOT NULL COMMENT 'ID дома',
  `version` int NOT NULL DEFAULT '0',
  `version_created_at` timestamp NULL DEFAULT NULL,
  `version_created_by` varchar(100) DEFAULT NULL,
  `version_comment` varchar(255) DEFAULT NULL,
  `house_id_version` int DEFAULT '0',
  `obj_stage_work_ids` text,
  `obj_stage_work_versions` text,
  PRIMARY KEY (`id`,`version`),
  CONSTRAINT `obj_stage_version_fk_7cef42` FOREIGN KEY (`id`) REFERENCES `obj_stage` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `obj_stage_version`
--

LOCK TABLES `obj_stage_version` WRITE;
/*!40000 ALTER TABLE `obj_stage_version` DISABLE KEYS */;
INSERT INTO `obj_stage_version` VALUES (1,'StageTest1','in_process',1,1,1,1,'2022-09-05 09:28:15','12','insert',1,NULL,NULL),(1,'PutTestStage','in_process',1,1,1,2,'2022-09-05 09:39:13','12','update',3,NULL,NULL),(1,'PutTestStage','deleted',0,0,1,3,'2022-09-05 10:14:26','12','delete',3,NULL,NULL),(2,'StageTest2','in_process',1,1,1,1,'2022-09-05 09:53:31','12','insert',3,NULL,NULL),(2,'StageTest2','deleted',0,0,1,2,'2022-09-05 10:04:50','12','delete',3,NULL,NULL);
/*!40000 ALTER TABLE `obj_stage_version` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `obj_stage_work`
--

DROP TABLE IF EXISTS `obj_stage_work`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `obj_stage_work` (
  `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID работы этапа',
  `price` decimal(19,2) unsigned NOT NULL COMMENT 'Стоимость',
  `amount` decimal(19,2) unsigned NOT NULL COMMENT 'Кол-во',
  `is_available` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Доступ (доступный, удаленный)',
  `work_id` int unsigned NOT NULL COMMENT 'ID работы',
  `stage_id` int unsigned NOT NULL COMMENT 'ID этапа',
  `version` int DEFAULT '0',
  `version_created_at` timestamp NULL DEFAULT NULL,
  `version_created_by` varchar(100) DEFAULT NULL,
  `version_comment` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `stage_work_ibfi_5` (`work_id`),
  KEY `stage_work_ibfi_6` (`stage_id`),
  CONSTRAINT `stage_work_ibfk_5` FOREIGN KEY (`work_id`) REFERENCES `vol_work` (`id`),
  CONSTRAINT `stage_work_ibfk_6` FOREIGN KEY (`stage_id`) REFERENCES `obj_stage` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `obj_stage_work`
--

LOCK TABLES `obj_stage_work` WRITE;
/*!40000 ALTER TABLE `obj_stage_work` DISABLE KEYS */;
/*!40000 ALTER TABLE `obj_stage_work` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `obj_stage_work_version`
--

DROP TABLE IF EXISTS `obj_stage_work_version`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `obj_stage_work_version` (
  `id` int unsigned NOT NULL COMMENT 'ID работы этапа',
  `price` decimal(19,2) unsigned NOT NULL COMMENT 'Стоимость',
  `amount` decimal(19,2) unsigned NOT NULL COMMENT 'Кол-во',
  `is_available` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Доступ (доступный, удаленный)',
  `work_id` int unsigned NOT NULL COMMENT 'ID работы',
  `stage_id` int unsigned NOT NULL COMMENT 'ID этапа',
  `version` int NOT NULL DEFAULT '0',
  `version_created_at` timestamp NULL DEFAULT NULL,
  `version_created_by` varchar(100) DEFAULT NULL,
  `version_comment` varchar(255) DEFAULT NULL,
  `work_id_version` int DEFAULT '0',
  `stage_id_version` int DEFAULT '0',
  `obj_stage_material_ids` text,
  `obj_stage_material_versions` text,
  `obj_stage_technic_ids` text,
  `obj_stage_technic_versions` text,
  PRIMARY KEY (`id`,`version`),
  CONSTRAINT `obj_stage_work_version_fk_614452` FOREIGN KEY (`id`) REFERENCES `obj_stage_work` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `obj_stage_work_version`
--

LOCK TABLES `obj_stage_work_version` WRITE;
/*!40000 ALTER TABLE `obj_stage_work_version` DISABLE KEYS */;
/*!40000 ALTER TABLE `obj_stage_work_version` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `obj_subproject`
--

DROP TABLE IF EXISTS `obj_subproject`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `obj_subproject` (
  `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID подпроекта',
  `name` varchar(255) NOT NULL COMMENT 'Наименование',
  `status` set('in_process','completed','deleted') NOT NULL DEFAULT 'in_process' COMMENT 'Статус (в процессе, завершен, удален)',
  `is_public` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Доступ (публичный, приватный)',
  `is_available` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Доступ (доступный, удаленный)',
  `project_id` int unsigned NOT NULL COMMENT 'ID проекта',
  `version` int DEFAULT '0',
  `version_created_at` timestamp NULL DEFAULT NULL,
  `version_created_by` varchar(100) DEFAULT NULL,
  `version_comment` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`),
  CONSTRAINT `subproject_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `obj_project` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `obj_subproject`
--

LOCK TABLES `obj_subproject` WRITE;
/*!40000 ALTER TABLE `obj_subproject` DISABLE KEYS */;
INSERT INTO `obj_subproject` VALUES (1,'NewSubproject','in_process',1,1,1,1,'2022-09-01 10:53:04','12','insert'),(2,'NewSubproject2','in_process',1,1,2,1,'2022-09-01 12:56:03','12','insert'),(3,'PutTestSubproject','deleted',0,0,3,3,'2022-09-05 10:15:01','12','delete');
/*!40000 ALTER TABLE `obj_subproject` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `obj_subproject_version`
--

DROP TABLE IF EXISTS `obj_subproject_version`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `obj_subproject_version` (
  `id` int unsigned NOT NULL COMMENT 'ID подпроекта',
  `name` varchar(255) NOT NULL COMMENT 'Наименование',
  `status` set('in_process','completed','deleted') NOT NULL DEFAULT 'in_process' COMMENT 'Статус (в процессе, завершен, удален)',
  `is_public` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Доступ (публичный, приватный)',
  `is_available` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Доступ (доступный, удаленный)',
  `project_id` int unsigned NOT NULL COMMENT 'ID проекта',
  `version` int NOT NULL DEFAULT '0',
  `version_created_at` timestamp NULL DEFAULT NULL,
  `version_created_by` varchar(100) DEFAULT NULL,
  `version_comment` varchar(255) DEFAULT NULL,
  `project_id_version` int DEFAULT '0',
  `obj_group_ids` text,
  `obj_group_versions` text,
  PRIMARY KEY (`id`,`version`),
  CONSTRAINT `obj_subproject_version_fk_7c9664` FOREIGN KEY (`id`) REFERENCES `obj_subproject` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `obj_subproject_version`
--

LOCK TABLES `obj_subproject_version` WRITE;
/*!40000 ALTER TABLE `obj_subproject_version` DISABLE KEYS */;
INSERT INTO `obj_subproject_version` VALUES (1,'NewSubproject','in_process',1,1,1,1,'2022-09-01 10:53:04','12','insert',3,NULL,NULL),(2,'NewSubproject2','in_process',1,1,1,1,'2022-09-01 12:56:03',NULL,'insert',3,NULL,NULL),(3,'SubprojectTest1','in_process',1,1,3,1,'2022-09-05 09:26:46','12','insert',1,NULL,NULL),(3,'PutTestSubproject','in_process',1,1,3,2,'2022-09-05 09:37:48','12','update',2,'| 1 |','| 1 |'),(3,'PutTestSubproject','deleted',0,0,3,3,'2022-09-05 10:15:01','12','delete',2,'| 1 |','| 3 |');
/*!40000 ALTER TABLE `obj_subproject_version` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_role`
--

DROP TABLE IF EXISTS `project_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `project_role` (
  `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID роли проекта',
  `lvl` int unsigned NOT NULL DEFAULT '1' COMMENT 'Уровень доступа;( 1 - проекта; 2 - подпроект; 3 - группа; 4 - дом; 5 - этап )',
  `is_crud` tinyint unsigned NOT NULL DEFAULT '0' COMMENT 'Доступен ли CRUD объекта',
  `object_id` int unsigned NOT NULL COMMENT 'ID объекта (проект, подпроект, группа, дом, этап)',
  `user_id` int unsigned NOT NULL COMMENT 'ID пользователя',
  `project_id` int unsigned NOT NULL COMMENT 'ID проекта',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `project_id` (`project_id`),
  CONSTRAINT `project_role_ibfk_23` FOREIGN KEY (`project_id`) REFERENCES `obj_project` (`id`),
  CONSTRAINT `project_role_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_role`
--

LOCK TABLES `project_role` WRITE;
/*!40000 ALTER TABLE `project_role` DISABLE KEYS */;
INSERT INTO `project_role` VALUES (1,1,1,2,15,2),(4,2,1,2,17,2),(7,2,1,1,17,1),(8,1,0,2,17,2);
/*!40000 ALTER TABLE `project_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `propel_migration`
--

DROP TABLE IF EXISTS `propel_migration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `propel_migration` (
  `version` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `propel_migration`
--

LOCK TABLES `propel_migration` WRITE;
/*!40000 ALTER TABLE `propel_migration` DISABLE KEYS */;
INSERT INTO `propel_migration` VALUES (1661943879),(1661953065),(1661953852);
/*!40000 ALTER TABLE `propel_migration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `static_file`
--

DROP TABLE IF EXISTS `static_file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `static_file` (
  `id` int NOT NULL AUTO_INCREMENT,
  `file_name` varchar(255) NOT NULL,
  `content_type` varchar(255) NOT NULL,
  `file` longblob NOT NULL,
  `headers` json DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `static_file_slug` (`url`),
  CONSTRAINT `static_file_chk_1` CHECK (json_valid(`headers`))
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `static_file`
--

LOCK TABLES `static_file` WRITE;
/*!40000 ALTER TABLE `static_file` DISABLE KEYS */;
/*!40000 ALTER TABLE `static_file` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_role`
--

DROP TABLE IF EXISTS `user_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_role` (
  `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID роли',
  `name` varchar(255) NOT NULL COMMENT 'Наименование',
  `object_viewer` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Просмотр объектов (все, конкретные)',
  `manage_objects` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'CRUD объектов (все, конкретные)',
  `manage_volumes` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'CRUD объёмов (все, никакие)',
  `manage_history` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Управление историей',
  `manage_users` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'CRUD учетными записями',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_role`
--

LOCK TABLES `user_role` WRITE;
/*!40000 ALTER TABLE `user_role` DISABLE KEYS */;
INSERT INTO `user_role` VALUES (1,'По умолчанию',0,0,0,0,0),(2,'Администратор',1,1,1,1,1),(3,'Просмотр',1,0,0,0,0),(4,'CRUD объектов',1,1,0,1,0),(5,'CRUD объемов',1,0,1,1,0);
/*!40000 ALTER TABLE `user_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(249) NOT NULL,
  `phone` varchar(11) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `status` tinyint unsigned NOT NULL DEFAULT '0',
  `role_id` int unsigned DEFAULT NULL COMMENT 'ID роли',
  `verified` tinyint unsigned NOT NULL DEFAULT '0',
  `resettable` tinyint unsigned NOT NULL DEFAULT '1',
  `roles_mask` int unsigned NOT NULL DEFAULT '0',
  `registered` int unsigned NOT NULL,
  `last_login` int unsigned DEFAULT NULL,
  `force_logout` mediumint unsigned NOT NULL DEFAULT '0',
  `is_available` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Доступ (доступный, удаленный)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (12,'me@artemy.net',NULL,'$2y$10$ulGCUMmSuJFG8fnywJHN5OAGRYsl4dMQy/KVdJxReWpJPPF460MKm','Artemy',0,2,1,1,0,1661160115,1662369876,1,1),(13,'this@artemy.net',NULL,'$2y$10$/BMJHVxfam5v6djudvn6feFYjERwlgcLiMb8Q3D5eCZjuaRZRfXkG','Timur',0,1,1,1,0,1661162813,1661955056,0,0),(14,'scheffio@bk.ru',NULL,'$2y$10$R0HMdKrqDNsDmjZupdp9feUei2Nni.7AEaeHuNWTes7hnVijaKgoS','Scheffio',0,2,1,1,0,1661249739,1662374696,2,1),(15,'scheffio1@bk.ru',NULL,'$2y$10$2tTfRY84RZVskI0QedaY0uEFgQiwmupFqGmy0hIxOvRwsJ/HVLFSe','Ivan',0,3,1,1,0,1661250790,NULL,0,1),(16,'scheffio2@bk.ru',NULL,'$2y$10$YfZfIF5aji5OUHe7Dh6eYeFh92xm9npdkAVSPB2Tm0NZHmmjgr9Ue','Petrovich',0,4,1,1,0,1661250794,NULL,0,1),(17,'scheffio3@bk.ru',NULL,'$2y$10$D/MJVxhSEaRLNFxtS4I3pOzOKirnFppSYOb3LIHkiK6qtkhlFlDmO','Mammy',0,5,1,1,0,1661250800,NULL,0,1),(18,'scheffio4@bk.ru',NULL,'$2y$10$cBmYIJBgmqa5VnahpPBRTOlzX6RLvRtTqiYtNV1Pwpa8M2/tRw0TO','Dodo',0,1,1,1,0,1661250838,NULL,0,1),(19,'scheffio5@bk.ru',NULL,'$2y$10$jVkJdpzhz5cAZaylOuc9cuKBYsIZtfh9d.2vtFG344x2kSAmgLMOW','Bubl',0,1,1,1,0,1661250868,NULL,0,1),(20,'scheffio6@bk.ru',NULL,'$2y$10$ZteOgPemdWRv4iJOElLCfOo1IF6y82YhG1JHex522W/24wIKYZwDa','Tor',0,1,1,1,0,1661250873,NULL,0,1),(21,'test@artemy.net',NULL,'$2y$10$7PKHkf/ejfvWjO4ypTlMKukM/jeR38ZOCuTm11hGMW.e7lyRMrgfC','SweetNick',0,1,0,1,0,1661256274,NULL,0,1),(22,'tes1t@artemy.net',NULL,'$2y$10$AC8jgP2nSjHmGV2NKzH6y.efsxJO.tNj6cilIBR1mu0sbvU0FBiHO','NickDick',0,1,0,1,0,1661256292,NULL,0,1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_confirmations`
--

DROP TABLE IF EXISTS `users_confirmations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users_confirmations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `email` varchar(249) NOT NULL,
  `selector` varchar(16) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expires` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `selector` (`selector`),
  KEY `email_expires` (`email`,`expires`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_confirmations`
--

LOCK TABLES `users_confirmations` WRITE;
/*!40000 ALTER TABLE `users_confirmations` DISABLE KEYS */;
/*!40000 ALTER TABLE `users_confirmations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_remembered`
--

DROP TABLE IF EXISTS `users_remembered`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users_remembered` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user` int unsigned NOT NULL,
  `selector` varchar(24) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expires` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `selector` (`selector`),
  KEY `user` (`user`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_remembered`
--

LOCK TABLES `users_remembered` WRITE;
/*!40000 ALTER TABLE `users_remembered` DISABLE KEYS */;
INSERT INTO `users_remembered` VALUES (1,13,'_uZyRRs0G4bpqLjg_pU4oCd5','$2y$10$CWMnQZIiJLWTJF7vjOPYIesGWd7O.lT7kD5qmf.kIOxlrc8C9zfZS',1693512656),(2,12,'7F2jiwswraQK5gfV2xRyNnUF','$2y$10$O64hSVACEPRr.Zut1xCycOjy.UxUiPMzmMiDExRGwKaIt3zpMzGum',1693594578),(3,12,'EfnFtkBJIQjKhBLrXWcHiywC','$2y$10$95GNaH2pny3erP0IWWrWNeqBR.PH8QaBybqSBXZ20Ui4guxSeSvAa',1693923180),(4,14,'PIwi5pmUq8_lt1hj8hlnmRnB','$2y$10$fZchPwHvg0WxksHQ6hderutLifBcSpTmZ0eSVLnJBvvBhmP0uG9Em',1693932296);
/*!40000 ALTER TABLE `users_remembered` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_resets`
--

DROP TABLE IF EXISTS `users_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users_resets` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user` int unsigned NOT NULL,
  `selector` varchar(20) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expires` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `selector` (`selector`),
  KEY `user_expires` (`user`,`expires`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_resets`
--

LOCK TABLES `users_resets` WRITE;
/*!40000 ALTER TABLE `users_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `users_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_throttling`
--

DROP TABLE IF EXISTS `users_throttling`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users_throttling` (
  `bucket` varchar(44) NOT NULL,
  `tokens` float unsigned NOT NULL,
  `replenished_at` int unsigned NOT NULL,
  `expires_at` int unsigned NOT NULL,
  PRIMARY KEY (`bucket`),
  KEY `expires_at` (`expires_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_throttling`
--

LOCK TABLES `users_throttling` WRITE;
/*!40000 ALTER TABLE `users_throttling` DISABLE KEYS */;
INSERT INTO `users_throttling` VALUES ('_mQqixpaRHHDDBWUyMklhcEGC6ap0sfHLBIDD2zROrQ',74,1661955056,1662495056),('7A0Cg5zpZ12o-f6rNEkibYgdCUn_GxiOIEUZAjAXufo',74,1662365579,1662905579),('iCblImb3auUxCvmW4SGnPkdoq6bnoQ9gsvujuuCZuB0',74,1662374696,1662914696);
/*!40000 ALTER TABLE `users_throttling` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vol_material`
--

DROP TABLE IF EXISTS `vol_material`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vol_material` (
  `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID материала',
  `name` varchar(255) NOT NULL COMMENT 'Наименование',
  `price` decimal(19,2) unsigned NOT NULL COMMENT 'Стоимость',
  `is_available` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Доступ (доступный, удаленный)',
  `unit_id` int unsigned NOT NULL COMMENT 'ID ед. измерения',
  `version` int DEFAULT '0',
  `version_created_at` timestamp NULL DEFAULT NULL,
  `version_created_by` varchar(100) DEFAULT NULL,
  `version_comment` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `unit_id` (`unit_id`),
  CONSTRAINT `material_ibfk_1` FOREIGN KEY (`unit_id`) REFERENCES `vol_unit` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vol_material`
--

LOCK TABLES `vol_material` WRITE;
/*!40000 ALTER TABLE `vol_material` DISABLE KEYS */;
/*!40000 ALTER TABLE `vol_material` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vol_material_version`
--

DROP TABLE IF EXISTS `vol_material_version`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vol_material_version` (
  `id` int unsigned NOT NULL COMMENT 'ID материала',
  `name` varchar(255) NOT NULL COMMENT 'Наименование',
  `price` decimal(19,2) unsigned NOT NULL COMMENT 'Стоимость',
  `is_available` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Доступ (доступный, удаленный)',
  `unit_id` int unsigned NOT NULL COMMENT 'ID ед. измерения',
  `version` int NOT NULL DEFAULT '0',
  `version_created_at` timestamp NULL DEFAULT NULL,
  `version_created_by` varchar(100) DEFAULT NULL,
  `version_comment` varchar(255) DEFAULT NULL,
  `obj_stage_material_ids` text,
  `obj_stage_material_versions` text,
  PRIMARY KEY (`id`,`version`),
  CONSTRAINT `vol_material_version_fk_d64a59` FOREIGN KEY (`id`) REFERENCES `vol_material` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vol_material_version`
--

LOCK TABLES `vol_material_version` WRITE;
/*!40000 ALTER TABLE `vol_material_version` DISABLE KEYS */;
/*!40000 ALTER TABLE `vol_material_version` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vol_technic`
--

DROP TABLE IF EXISTS `vol_technic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vol_technic` (
  `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID техники',
  `name` varchar(255) NOT NULL COMMENT 'Наименование',
  `price` decimal(19,2) unsigned NOT NULL COMMENT 'Стоимость',
  `is_available` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Доступ (доступный, удаленный)',
  `unit_id` int unsigned NOT NULL COMMENT 'ID ед. измерения',
  `version` int DEFAULT '0',
  `version_created_at` timestamp NULL DEFAULT NULL,
  `version_created_by` varchar(100) DEFAULT NULL,
  `version_comment` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `unit_id` (`unit_id`),
  CONSTRAINT `technic_ibfk_1` FOREIGN KEY (`unit_id`) REFERENCES `vol_unit` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vol_technic`
--

LOCK TABLES `vol_technic` WRITE;
/*!40000 ALTER TABLE `vol_technic` DISABLE KEYS */;
/*!40000 ALTER TABLE `vol_technic` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vol_technic_version`
--

DROP TABLE IF EXISTS `vol_technic_version`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vol_technic_version` (
  `id` int unsigned NOT NULL COMMENT 'ID техники',
  `name` varchar(255) NOT NULL COMMENT 'Наименование',
  `price` decimal(19,2) unsigned NOT NULL COMMENT 'Стоимость',
  `is_available` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Доступ (доступный, удаленный)',
  `unit_id` int unsigned NOT NULL COMMENT 'ID ед. измерения',
  `version` int NOT NULL DEFAULT '0',
  `version_created_at` timestamp NULL DEFAULT NULL,
  `version_created_by` varchar(100) DEFAULT NULL,
  `version_comment` varchar(255) DEFAULT NULL,
  `obj_stage_technic_ids` text,
  `obj_stage_technic_versions` text,
  PRIMARY KEY (`id`,`version`),
  CONSTRAINT `vol_technic_version_fk_e379d9` FOREIGN KEY (`id`) REFERENCES `vol_technic` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vol_technic_version`
--

LOCK TABLES `vol_technic_version` WRITE;
/*!40000 ALTER TABLE `vol_technic_version` DISABLE KEYS */;
/*!40000 ALTER TABLE `vol_technic_version` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vol_unit`
--

DROP TABLE IF EXISTS `vol_unit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vol_unit` (
  `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID ед. измерения',
  `name` varchar(255) NOT NULL COMMENT 'Наименование',
  `is_available` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Доступ (доступный, удаленный)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vol_unit`
--

LOCK TABLES `vol_unit` WRITE;
/*!40000 ALTER TABLE `vol_unit` DISABLE KEYS */;
/*!40000 ALTER TABLE `vol_unit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vol_work`
--

DROP TABLE IF EXISTS `vol_work`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vol_work` (
  `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID работы',
  `name` varchar(255) NOT NULL COMMENT 'Наименование',
  `price` decimal(19,2) unsigned NOT NULL COMMENT 'Стоимость',
  `is_available` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Доступ (доступный, удаленный)',
  `unit_id` int unsigned NOT NULL COMMENT 'ID ед. измерения',
  `version` int DEFAULT '0',
  `version_created_at` timestamp NULL DEFAULT NULL,
  `version_created_by` varchar(100) DEFAULT NULL,
  `version_comment` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `unit_id` (`unit_id`),
  CONSTRAINT `work_ibfk_1` FOREIGN KEY (`unit_id`) REFERENCES `vol_unit` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vol_work`
--

LOCK TABLES `vol_work` WRITE;
/*!40000 ALTER TABLE `vol_work` DISABLE KEYS */;
/*!40000 ALTER TABLE `vol_work` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vol_work_material`
--

DROP TABLE IF EXISTS `vol_work_material`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vol_work_material` (
  `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID материала работы',
  `amount` decimal(19,2) unsigned NOT NULL COMMENT 'Кол-во',
  `work_id` int unsigned NOT NULL COMMENT 'ID работы',
  `material_id` int unsigned NOT NULL COMMENT 'ID материала',
  PRIMARY KEY (`id`),
  KEY `work_id` (`work_id`),
  KEY `material_id` (`material_id`),
  CONSTRAINT `work_material_ibfk_1` FOREIGN KEY (`work_id`) REFERENCES `vol_work` (`id`),
  CONSTRAINT `work_material_ibfk_2` FOREIGN KEY (`material_id`) REFERENCES `vol_material` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vol_work_material`
--

LOCK TABLES `vol_work_material` WRITE;
/*!40000 ALTER TABLE `vol_work_material` DISABLE KEYS */;
/*!40000 ALTER TABLE `vol_work_material` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vol_work_technic`
--

DROP TABLE IF EXISTS `vol_work_technic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vol_work_technic` (
  `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID техники работы',
  `amount` decimal(19,2) unsigned NOT NULL COMMENT 'Кол-во',
  `work_id` int unsigned NOT NULL COMMENT 'ID работы',
  `technic_id` int unsigned NOT NULL COMMENT 'ID техники',
  PRIMARY KEY (`id`),
  KEY `work_id` (`work_id`),
  KEY `technic_id` (`technic_id`),
  CONSTRAINT `work_technic_ibfk_1` FOREIGN KEY (`work_id`) REFERENCES `vol_work` (`id`),
  CONSTRAINT `work_technic_ibfk_2` FOREIGN KEY (`technic_id`) REFERENCES `vol_technic` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vol_work_technic`
--

LOCK TABLES `vol_work_technic` WRITE;
/*!40000 ALTER TABLE `vol_work_technic` DISABLE KEYS */;
/*!40000 ALTER TABLE `vol_work_technic` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vol_work_version`
--

DROP TABLE IF EXISTS `vol_work_version`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vol_work_version` (
  `id` int unsigned NOT NULL COMMENT 'ID работы',
  `name` varchar(255) NOT NULL COMMENT 'Наименование',
  `price` decimal(19,2) unsigned NOT NULL COMMENT 'Стоимость',
  `is_available` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Доступ (доступный, удаленный)',
  `unit_id` int unsigned NOT NULL COMMENT 'ID ед. измерения',
  `version` int NOT NULL DEFAULT '0',
  `version_created_at` timestamp NULL DEFAULT NULL,
  `version_created_by` varchar(100) DEFAULT NULL,
  `version_comment` varchar(255) DEFAULT NULL,
  `obj_stage_work_ids` text,
  `obj_stage_work_versions` text,
  PRIMARY KEY (`id`,`version`),
  CONSTRAINT `vol_work_version_fk_b92c65` FOREIGN KEY (`id`) REFERENCES `vol_work` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vol_work_version`
--

LOCK TABLES `vol_work_version` WRITE;
/*!40000 ALTER TABLE `vol_work_version` DISABLE KEYS */;
/*!40000 ALTER TABLE `vol_work_version` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed
