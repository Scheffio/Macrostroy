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
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `groups` (
  `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID группы',
  `name` varchar(255) NOT NULL COMMENT 'Наименование',
  `status` set('in_process','completed','deleted') NOT NULL DEFAULT 'in_process' COMMENT 'Статус (в процессе, завершен, удален)	',
  `is_available` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Доступ (публичный, приватный)',
  `subproject_id` int unsigned NOT NULL COMMENT 'ID подпроекта',
  `version` int DEFAULT '0',
  `version_created_at` timestamp NULL DEFAULT NULL,
  `version_created_by` varchar(100) DEFAULT NULL,
  `version_comment` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subproject_id` (`subproject_id`),
  CONSTRAINT `groups_ibfk_1` FOREIGN KEY (`subproject_id`) REFERENCES `subproject` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups_version`
--

DROP TABLE IF EXISTS `groups_version`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `groups_version` (
  `id` int unsigned NOT NULL COMMENT 'ID группы',
  `name` varchar(255) NOT NULL COMMENT 'Наименование',
  `status` set('in_process','completed','deleted') NOT NULL DEFAULT 'in_process' COMMENT 'Статус (в процессе, завершен, удален)	',
  `is_available` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Доступ (публичный, приватный)',
  `subproject_id` int unsigned NOT NULL COMMENT 'ID подпроекта',
  `version` int NOT NULL DEFAULT '0',
  `version_created_at` timestamp NULL DEFAULT NULL,
  `version_created_by` varchar(100) DEFAULT NULL,
  `version_comment` varchar(255) DEFAULT NULL,
  `subproject_id_version` int DEFAULT '0',
  `house_ids` text,
  `house_versions` text,
  PRIMARY KEY (`id`,`version`),
  CONSTRAINT `groups_version_fk_48de95` FOREIGN KEY (`id`) REFERENCES `groups` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups_version`
--

LOCK TABLES `groups_version` WRITE;
/*!40000 ALTER TABLE `groups_version` DISABLE KEYS */;
/*!40000 ALTER TABLE `groups_version` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `house`
--

DROP TABLE IF EXISTS `house`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `house` (
  `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID дома',
  `name` varchar(255) NOT NULL COMMENT 'Наименование',
  `status` set('in_process','completed','deleted') NOT NULL DEFAULT 'in_process' COMMENT 'Статус (в процессе, завершен, удален)	',
  `is_available` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Доступ (публичный, приватный)',
  `group_id` int unsigned NOT NULL COMMENT 'Id группы',
  `version` int DEFAULT '0',
  `version_created_at` timestamp NULL DEFAULT NULL,
  `version_created_by` varchar(100) DEFAULT NULL,
  `version_comment` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `group_id` (`group_id`),
  CONSTRAINT `house_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `house`
--

LOCK TABLES `house` WRITE;
/*!40000 ALTER TABLE `house` DISABLE KEYS */;
/*!40000 ALTER TABLE `house` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `house_version`
--

DROP TABLE IF EXISTS `house_version`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `house_version` (
  `id` int unsigned NOT NULL COMMENT 'ID дома',
  `name` varchar(255) NOT NULL COMMENT 'Наименование',
  `status` set('in_process','completed','deleted') NOT NULL DEFAULT 'in_process' COMMENT 'Статус (в процессе, завершен, удален)	',
  `is_available` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Доступ (публичный, приватный)',
  `group_id` int unsigned NOT NULL COMMENT 'Id группы',
  `version` int NOT NULL DEFAULT '0',
  `version_created_at` timestamp NULL DEFAULT NULL,
  `version_created_by` varchar(100) DEFAULT NULL,
  `version_comment` varchar(255) DEFAULT NULL,
  `group_id_version` int DEFAULT '0',
  `stage_ids` text,
  `stage_versions` text,
  PRIMARY KEY (`id`,`version`),
  CONSTRAINT `house_version_fk_fa1e78` FOREIGN KEY (`id`) REFERENCES `house` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `house_version`
--

LOCK TABLES `house_version` WRITE;
/*!40000 ALTER TABLE `house_version` DISABLE KEYS */;
/*!40000 ALTER TABLE `house_version` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `material`
--

DROP TABLE IF EXISTS `material`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `material` (
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
  CONSTRAINT `material_ibfk_1` FOREIGN KEY (`unit_id`) REFERENCES `unit` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `material`
--

LOCK TABLES `material` WRITE;
/*!40000 ALTER TABLE `material` DISABLE KEYS */;
/*!40000 ALTER TABLE `material` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `material_version`
--

DROP TABLE IF EXISTS `material_version`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `material_version` (
  `id` int unsigned NOT NULL COMMENT 'ID материала',
  `name` varchar(255) NOT NULL COMMENT 'Наименование',
  `price` decimal(19,2) unsigned NOT NULL COMMENT 'Стоимость',
  `is_available` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Доступ (доступный, удаленный)',
  `unit_id` int unsigned NOT NULL COMMENT 'ID ед. измерения',
  `version` int NOT NULL DEFAULT '0',
  `version_created_at` timestamp NULL DEFAULT NULL,
  `version_created_by` varchar(100) DEFAULT NULL,
  `version_comment` varchar(255) DEFAULT NULL,
  `stage_material_ids` text,
  `stage_material_versions` text,
  `work_material_ids` text,
  `work_material_versions` text,
  PRIMARY KEY (`id`,`version`),
  CONSTRAINT `material_version_fk_8d347e` FOREIGN KEY (`id`) REFERENCES `material` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `material_version`
--

LOCK TABLES `material_version` WRITE;
/*!40000 ALTER TABLE `material_version` DISABLE KEYS */;
/*!40000 ALTER TABLE `material_version` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project`
--

DROP TABLE IF EXISTS `project`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `project` (
  `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID проекта',
  `name` varchar(255) NOT NULL COMMENT 'Наименование',
  `status` set('in_process','completed','deleted') NOT NULL DEFAULT 'in_process' COMMENT 'Статус (в процессе, завершен, удален)',
  `is_available` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Доступ (пуличный, приватный)',
  `version` int DEFAULT '0',
  `version_created_at` timestamp NULL DEFAULT NULL,
  `version_created_by` varchar(100) DEFAULT NULL,
  `version_comment` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project`
--

LOCK TABLES `project` WRITE;
/*!40000 ALTER TABLE `project` DISABLE KEYS */;
INSERT INTO `project` VALUES (1,'TestProject','in_process',1,1,'2022-08-24 07:34:31','1','insert');
/*!40000 ALTER TABLE `project` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_role`
--

DROP TABLE IF EXISTS `project_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `project_role` (
  `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID роли проекта',
  `lvl` int unsigned NOT NULL DEFAULT '1' COMMENT 'Уровень( 1 - проекта;2 - подпроект;3 - группа;4 - дом;5 - этап )',
  `is_crud` tinyint(1) DEFAULT NULL COMMENT 'Доступен ли CRUD объекта',
  `object_id` int unsigned NOT NULL COMMENT 'ID объекта (проект, подпроект, группа, дом, этап)',
  `user_id` int unsigned NOT NULL COMMENT 'ID пользователя',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `project_role_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_role`
--

LOCK TABLES `project_role` WRITE;
/*!40000 ALTER TABLE `project_role` DISABLE KEYS */;
INSERT INTO `project_role` VALUES (3,1,0,1,3);
/*!40000 ALTER TABLE `project_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_version`
--

DROP TABLE IF EXISTS `project_version`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `project_version` (
  `id` int unsigned NOT NULL COMMENT 'ID проекта',
  `name` varchar(255) NOT NULL COMMENT 'Наименование',
  `status` set('in_process','completed','deleted') NOT NULL DEFAULT 'in_process' COMMENT 'Статус (в процессе, завершен, удален)',
  `is_available` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Доступ (пуличный, приватный)',
  `version` int NOT NULL DEFAULT '0',
  `version_created_at` timestamp NULL DEFAULT NULL,
  `version_created_by` varchar(100) DEFAULT NULL,
  `version_comment` varchar(255) DEFAULT NULL,
  `subproject_ids` text,
  `subproject_versions` text,
  PRIMARY KEY (`id`,`version`),
  CONSTRAINT `project_version_fk_186d55` FOREIGN KEY (`id`) REFERENCES `project` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_version`
--

LOCK TABLES `project_version` WRITE;
/*!40000 ALTER TABLE `project_version` DISABLE KEYS */;
INSERT INTO `project_version` VALUES (1,'TestProject','in_process',1,1,'2022-08-24 07:34:31','1','insert',NULL,NULL);
/*!40000 ALTER TABLE `project_version` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role` (
  `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID роли',
  `name` varchar(255) NOT NULL COMMENT 'Наименование',
  `object_viewer` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Просмотр объектов (все, конкретные)',
  `manage_objects` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'CRUD объектов (все, конкретные)',
  `manage_volumes` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'CRUD объёмов (все, никакие)',
  `manage_history` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Управление историей',
  `manage_users` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'CRUD учетными записями',
  PRIMARY KEY (`id`),
  UNIQUE KEY `object_viewer` (`object_viewer`,`manage_objects`,`manage_volumes`,`manage_history`,`manage_users`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (1,'По умолчанию',0,0,0,0,0),(5,'Админ',1,1,1,1,1),(11,'Бухгалтер',1,0,1,0,0),(12,'CRUD',1,1,1,1,0),(15,'СуперБух',1,0,1,0,1);
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stage`
--

DROP TABLE IF EXISTS `stage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stage` (
  `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID этапа',
  `name` varchar(255) NOT NULL COMMENT 'Наименование',
  `status` set('in_process','completed','deleted') NOT NULL DEFAULT 'in_process' COMMENT 'Статус (в процессе, завершен, удален)	',
  `is_available` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Доступ (публичный, приватный)',
  `house_id` int unsigned NOT NULL COMMENT 'ID дома',
  `version` int DEFAULT '0',
  `version_created_at` timestamp NULL DEFAULT NULL,
  `version_created_by` varchar(100) DEFAULT NULL,
  `version_comment` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `house_id` (`house_id`),
  CONSTRAINT `stage_ibfk_1` FOREIGN KEY (`house_id`) REFERENCES `house` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stage`
--

LOCK TABLES `stage` WRITE;
/*!40000 ALTER TABLE `stage` DISABLE KEYS */;
/*!40000 ALTER TABLE `stage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stage_material`
--

DROP TABLE IF EXISTS `stage_material`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stage_material` (
  `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID материала работы на этапе',
  `price` decimal(19,2) unsigned NOT NULL COMMENT 'Стоимость',
  `amount` decimal(19,2) unsigned NOT NULL COMMENT 'Кол-во',
  `is_available` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Доступ (доступный, удаленный)',
  `stage_work_id` int unsigned NOT NULL COMMENT 'ID работы этапа',
  `material_id` int unsigned NOT NULL COMMENT 'ID материала',
  `version` int DEFAULT '0',
  `version_created_at` timestamp NULL DEFAULT NULL,
  `version_created_by` varchar(100) DEFAULT NULL,
  `version_comment` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `material_id` (`material_id`),
  KEY `stage_work_id` (`stage_work_id`),
  CONSTRAINT `stage_material_ibfk_1` FOREIGN KEY (`material_id`) REFERENCES `material` (`id`),
  CONSTRAINT `stage_material_ibfk_2` FOREIGN KEY (`stage_work_id`) REFERENCES `stage_work` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stage_material`
--

LOCK TABLES `stage_material` WRITE;
/*!40000 ALTER TABLE `stage_material` DISABLE KEYS */;
/*!40000 ALTER TABLE `stage_material` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stage_material_version`
--

DROP TABLE IF EXISTS `stage_material_version`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stage_material_version` (
  `id` int unsigned NOT NULL COMMENT 'ID материала работы на этапе',
  `price` decimal(19,2) unsigned NOT NULL COMMENT 'Стоимость',
  `amount` decimal(19,2) unsigned NOT NULL COMMENT 'Кол-во',
  `is_available` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Доступ (доступный, удаленный)',
  `stage_work_id` int unsigned NOT NULL COMMENT 'ID работы этапа',
  `material_id` int unsigned NOT NULL COMMENT 'ID материала',
  `version` int NOT NULL DEFAULT '0',
  `version_created_at` timestamp NULL DEFAULT NULL,
  `version_created_by` varchar(100) DEFAULT NULL,
  `version_comment` varchar(255) DEFAULT NULL,
  `material_id_version` int DEFAULT '0',
  `stage_work_id_version` int DEFAULT '0',
  PRIMARY KEY (`id`,`version`),
  CONSTRAINT `stage_material_version_fk_b671c9` FOREIGN KEY (`id`) REFERENCES `stage_material` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stage_material_version`
--

LOCK TABLES `stage_material_version` WRITE;
/*!40000 ALTER TABLE `stage_material_version` DISABLE KEYS */;
/*!40000 ALTER TABLE `stage_material_version` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stage_technic`
--

DROP TABLE IF EXISTS `stage_technic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stage_technic` (
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
  CONSTRAINT `stage_technic_ibfk_1` FOREIGN KEY (`stage_work_id`) REFERENCES `stage_work` (`id`),
  CONSTRAINT `stage_technic_ibfk_2` FOREIGN KEY (`technic_id`) REFERENCES `technic` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stage_technic`
--

LOCK TABLES `stage_technic` WRITE;
/*!40000 ALTER TABLE `stage_technic` DISABLE KEYS */;
/*!40000 ALTER TABLE `stage_technic` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stage_technic_version`
--

DROP TABLE IF EXISTS `stage_technic_version`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stage_technic_version` (
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
  CONSTRAINT `stage_technic_version_fk_2072b7` FOREIGN KEY (`id`) REFERENCES `stage_technic` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stage_technic_version`
--

LOCK TABLES `stage_technic_version` WRITE;
/*!40000 ALTER TABLE `stage_technic_version` DISABLE KEYS */;
/*!40000 ALTER TABLE `stage_technic_version` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stage_version`
--

DROP TABLE IF EXISTS `stage_version`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stage_version` (
  `id` int unsigned NOT NULL COMMENT 'ID этапа',
  `name` varchar(255) NOT NULL COMMENT 'Наименование',
  `status` set('in_process','completed','deleted') NOT NULL DEFAULT 'in_process' COMMENT 'Статус (в процессе, завершен, удален)	',
  `is_available` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Доступ (публичный, приватный)',
  `house_id` int unsigned NOT NULL COMMENT 'ID дома',
  `version` int NOT NULL DEFAULT '0',
  `version_created_at` timestamp NULL DEFAULT NULL,
  `version_created_by` varchar(100) DEFAULT NULL,
  `version_comment` varchar(255) DEFAULT NULL,
  `house_id_version` int DEFAULT '0',
  PRIMARY KEY (`id`,`version`),
  CONSTRAINT `stage_version_fk_203498` FOREIGN KEY (`id`) REFERENCES `stage` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stage_version`
--

LOCK TABLES `stage_version` WRITE;
/*!40000 ALTER TABLE `stage_version` DISABLE KEYS */;
/*!40000 ALTER TABLE `stage_version` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stage_work`
--

DROP TABLE IF EXISTS `stage_work`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stage_work` (
  `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID работы этапа',
  `stage_id` int unsigned NOT NULL COMMENT 'ID этапа',
  `work_id` int unsigned NOT NULL COMMENT 'ID работы',
  `price` decimal(19,2) unsigned NOT NULL COMMENT 'Стоимость',
  `amount` decimal(19,2) unsigned NOT NULL COMMENT 'Кол-во',
  `is_available` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Доступ (доступный, удаленный)',
  `version` int DEFAULT '0',
  `version_created_at` timestamp NULL DEFAULT NULL,
  `version_created_by` varchar(100) DEFAULT NULL,
  `version_comment` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stage_work`
--

LOCK TABLES `stage_work` WRITE;
/*!40000 ALTER TABLE `stage_work` DISABLE KEYS */;
/*!40000 ALTER TABLE `stage_work` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stage_work_version`
--

DROP TABLE IF EXISTS `stage_work_version`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stage_work_version` (
  `id` int unsigned NOT NULL COMMENT 'ID работы этапа',
  `stage_id` int unsigned NOT NULL COMMENT 'ID этапа',
  `work_id` int unsigned NOT NULL COMMENT 'ID работы',
  `price` decimal(19,2) unsigned NOT NULL COMMENT 'Стоимость',
  `amount` decimal(19,2) unsigned NOT NULL COMMENT 'Кол-во',
  `is_available` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Доступ (доступный, удаленный)',
  `version` int NOT NULL DEFAULT '0',
  `version_created_at` timestamp NULL DEFAULT NULL,
  `version_created_by` varchar(100) DEFAULT NULL,
  `version_comment` varchar(255) DEFAULT NULL,
  `stage_material_ids` text,
  `stage_material_versions` text,
  `stage_technic_ids` text,
  `stage_technic_versions` text,
  PRIMARY KEY (`id`,`version`),
  CONSTRAINT `stage_work_version_fk_7e51cc` FOREIGN KEY (`id`) REFERENCES `stage_work` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stage_work_version`
--

LOCK TABLES `stage_work_version` WRITE;
/*!40000 ALTER TABLE `stage_work_version` DISABLE KEYS */;
/*!40000 ALTER TABLE `stage_work_version` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subproject`
--

DROP TABLE IF EXISTS `subproject`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subproject` (
  `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID подпроекта',
  `name` varchar(255) NOT NULL COMMENT 'Наименование',
  `status` set('in_process','completed','deleted') NOT NULL DEFAULT 'in_process' COMMENT 'Статус (в процессе, завершен, удален)',
  `is_available` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Доступ (публичный, приватный)',
  `project_id` int unsigned NOT NULL COMMENT 'ID проекта',
  `version` int DEFAULT '0',
  `version_created_at` timestamp NULL DEFAULT NULL,
  `version_created_by` varchar(100) DEFAULT NULL,
  `version_comment` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`),
  CONSTRAINT `subproject_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subproject`
--

LOCK TABLES `subproject` WRITE;
/*!40000 ALTER TABLE `subproject` DISABLE KEYS */;
/*!40000 ALTER TABLE `subproject` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subproject_version`
--

DROP TABLE IF EXISTS `subproject_version`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subproject_version` (
  `id` int unsigned NOT NULL COMMENT 'ID подпроекта',
  `name` varchar(255) NOT NULL COMMENT 'Наименование',
  `status` set('in_process','completed','deleted') NOT NULL DEFAULT 'in_process' COMMENT 'Статус (в процессе, завершен, удален)',
  `is_available` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Доступ (публичный, приватный)',
  `project_id` int unsigned NOT NULL COMMENT 'ID проекта',
  `version` int NOT NULL DEFAULT '0',
  `version_created_at` timestamp NULL DEFAULT NULL,
  `version_created_by` varchar(100) DEFAULT NULL,
  `version_comment` varchar(255) DEFAULT NULL,
  `project_id_version` int DEFAULT '0',
  `groups_ids` text,
  `groups_versions` text,
  PRIMARY KEY (`id`,`version`),
  CONSTRAINT `subproject_version_fk_03348b` FOREIGN KEY (`id`) REFERENCES `subproject` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subproject_version`
--

LOCK TABLES `subproject_version` WRITE;
/*!40000 ALTER TABLE `subproject_version` DISABLE KEYS */;
/*!40000 ALTER TABLE `subproject_version` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `technic`
--

DROP TABLE IF EXISTS `technic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `technic` (
  `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID техники',
  `name` varchar(255) NOT NULL COMMENT 'Наименование',
  `price` decimal(19,2) unsigned NOT NULL COMMENT 'Стоимость',
  `is_available` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Доступ (доступный, удаленный)',
  `unit_id` int unsigned NOT NULL COMMENT 'ID ед. измерения',
  `version` int DEFAULT '0',
  `version_created_at` timestamp NULL DEFAULT NULL,
  `version_created_by` varchar(100) DEFAULT NULL,
  `version_comment` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `technic`
--

LOCK TABLES `technic` WRITE;
/*!40000 ALTER TABLE `technic` DISABLE KEYS */;
/*!40000 ALTER TABLE `technic` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `technic_version`
--

DROP TABLE IF EXISTS `technic_version`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `technic_version` (
  `id` int unsigned NOT NULL COMMENT 'ID техники',
  `name` varchar(255) NOT NULL COMMENT 'Наименование',
  `price` decimal(19,2) unsigned NOT NULL COMMENT 'Стоимость',
  `is_available` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Доступ (доступный, удаленный)',
  `unit_id` int unsigned NOT NULL COMMENT 'ID ед. измерения',
  `version` int NOT NULL DEFAULT '0',
  `version_created_at` timestamp NULL DEFAULT NULL,
  `version_created_by` varchar(100) DEFAULT NULL,
  `version_comment` varchar(255) DEFAULT NULL,
  `stage_technic_ids` text,
  `stage_technic_versions` text,
  `work_technic_ids` text,
  `work_technic_versions` text,
  PRIMARY KEY (`id`,`version`),
  CONSTRAINT `technic_version_fk_9f10cd` FOREIGN KEY (`id`) REFERENCES `technic` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `technic_version`
--

LOCK TABLES `technic_version` WRITE;
/*!40000 ALTER TABLE `technic_version` DISABLE KEYS */;
/*!40000 ALTER TABLE `technic_version` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unit`
--

DROP TABLE IF EXISTS `unit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `unit` (
  `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID ед. измерения',
  `name` varchar(255) NOT NULL COMMENT 'Наименование',
  `is_available` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Доступ (доступный, удаленный)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unit`
--

LOCK TABLES `unit` WRITE;
/*!40000 ALTER TABLE `unit` DISABLE KEYS */;
/*!40000 ALTER TABLE `unit` ENABLE KEYS */;
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
  `role_id` int unsigned NOT NULL DEFAULT '1' COMMENT 'ID роли',
  `verified` tinyint unsigned NOT NULL DEFAULT '0',
  `resettable` tinyint unsigned NOT NULL DEFAULT '1',
  `roles_mask` int unsigned NOT NULL DEFAULT '0',
  `registered` int unsigned NOT NULL,
  `last_login` int unsigned DEFAULT NULL,
  `force_logout` mediumint unsigned NOT NULL DEFAULT '0',
  `is_available` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'me@artemy.net',NULL,'$2y$10$UeCL67hVly4fBYHOQpQiDuFJe1oKibOUhInL1V2JsC0sOm0ucbScm','Artemy1',0,5,1,1,0,1661160115,1661523830,0,1),(3,'this@artemy.net',NULL,'$2y$10$/BMJHVxfam5v6djudvn6feFYjERwlgcLiMb8Q3D5eCZjuaRZRfXkG','Timur',0,12,1,1,0,1661162813,NULL,0,0),(11,'scheffio@bk.ru',NULL,'$2y$10$tqUE4Aa5B7og7mu9v8qp1.PO2FiPwAp.eBfAqM/g.Dg6/B4LmkNM6','Scheffio',0,5,1,1,0,1661249739,1661756449,1,1),(16,'scheffio1@bk.ru',NULL,'$2y$10$2tTfRY84RZVskI0QedaY0uEFgQiwmupFqGmy0hIxOvRwsJ/HVLFSe','Ivan',0,1,1,1,0,1661250790,NULL,0,1),(17,'scheffio2@bk.ru',NULL,'$2y$10$YfZfIF5aji5OUHe7Dh6eYeFh92xm9npdkAVSPB2Tm0NZHmmjgr9Ue','Petrovich',0,1,1,1,0,1661250794,NULL,0,1),(18,'scheffio3@bk.ru',NULL,'$2y$10$D/MJVxhSEaRLNFxtS4I3pOzOKirnFppSYOb3LIHkiK6qtkhlFlDmO','Mammy',0,1,1,1,0,1661250800,NULL,0,1),(19,'scheffio4@bk.ru',NULL,'$2y$10$cBmYIJBgmqa5VnahpPBRTOlzX6RLvRtTqiYtNV1Pwpa8M2/tRw0TO','Dodo',0,1,1,1,0,1661250838,NULL,0,1),(20,'scheffio5@bk.ru',NULL,'$2y$10$jVkJdpzhz5cAZaylOuc9cuKBYsIZtfh9d.2vtFG344x2kSAmgLMOW','Bubl',0,12,1,1,0,1661250868,NULL,0,1),(21,'scheffio6@bk.ru',NULL,'$2y$10$ZteOgPemdWRv4iJOElLCfOo1IF6y82YhG1JHex522W/24wIKYZwDa','Tor',0,11,1,1,0,1661250873,NULL,0,1),(30,'test@artemy.net',NULL,'$2y$10$7PKHkf/ejfvWjO4ypTlMKukM/jeR38ZOCuTm11hGMW.e7lyRMrgfC','SweetNick',0,1,0,1,0,1661256274,NULL,0,1),(31,'tes1t@artemy.net',NULL,'$2y$10$AC8jgP2nSjHmGV2NKzH6y.efsxJO.tNj6cilIBR1mu0sbvU0FBiHO','NickDick',0,5,0,1,0,1661256292,NULL,0,1),(67,'qwe@artemy.net',NULL,'$2y$10$D.Np4FpAH.C0iQ5ln.OoTelnt37fPX3r/svLxd0pSYsNphXzdCFHu','nick',0,5,1,1,0,1661506678,NULL,1,1),(70,'trash@artemy.net',NULL,'$2y$10$N2hoSUlh3MUubSIA0LUNBeP07zoX9AhJHvOTix5kyvKKI/y8gk0vu','nick',0,5,1,1,0,1661516527,NULL,1,1),(71,'rewrer@artemy.net',NULL,'$2y$10$G0cCpk7SYNWBzvDJTdTpauccjVfo/Nl71OkkEkGkkTUA5K9N5jI/.','chroeojtm',0,5,0,1,0,1661523322,NULL,0,1);
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
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_confirmations`
--

LOCK TABLES `users_confirmations` WRITE;
/*!40000 ALTER TABLE `users_confirmations` DISABLE KEYS */;
INSERT INTO `users_confirmations` VALUES (2,9,'scheffio@bk.ru','JJyDXYGBxpSyJIRY','$2y$10$tQSMgmEh1kgzzau2.bzDX.rcvX3Hstk6ulxZiZSAylQN54NfTMMmm',1661336077),(3,12,'test@artemy.net','xbMbBExUpTroGaHh','$2y$10$pjtyccG4nguhXGnsmpBmL.YBMGRNfcOMArwD0reGuzim7gLpaxZn2',1661336293),(7,22,'123@artemy.net','LJjjsvCn8jKv0pQ5','$2y$10$tomEit3nf/cFE2S79gJqAu2OWLb5wpjqAC9w9AKy62TgY7nqjVHR2',1661337540),(9,26,'test@artemy.net','CqZgHrgIB1_ilLTt','$2y$10$eJUu9IRfUztv/9wgIjzRVOGbg5B65xDt5juCVWah1IgAPS0t3GzhG',1661338271),(11,30,'test@artemy.net','BMYCiximfRbEj9Uv','$2y$10$YWBWA/mrLwDYK17FPbQKFOLc3mKvG42rgIjdC2W6oJ9QXeXEEbUDK',1661342674),(12,31,'tes1t@artemy.net','Ps1Lo9nFdgteUyfe','$2y$10$p/gXVwcr.mx8sH5oGVoXLORYaRp/G94Ms3z8AxeL.EU4JhDTHt5NK',1661342692),(13,32,'111@artemy.net','_aVcVcQEol8e_Xij','$2y$10$SSmsg8Wo/PHULWgQ.13eYONJKUBMA6UvZluUJpbFgInD6AdiBSBqu',1661590979),(14,34,'1111@artemy.net','GHULYGMLSPgPJ-8v','$2y$10$ifl4ONMl4eYisPKJgW7Z7e1aoPX08FBrmC0vGMQ30sEzkQB1tnwxq',1661591018),(15,36,'11111@artemy.net','H2Tu8EvQRL1EPKjD','$2y$10$IUjjsA0XbWyStoVW6FNkeuS4mXcHOTTHP/RoUlyM4.uFGM3lpMlxG',1661591057),(16,42,'111111@artemy.net','U4z-Mf9thr3RQeWG','$2y$10$ZrXZy0TnFql6ZDYjtQ9zH.Y9oaD9vbZSHg7zZka3Hty4i2MUvWBEW',1661591150),(17,43,'11111811@artemy.net','r7QgC2FuUwFVwX5-','$2y$10$wOvAqSfr2kcuqwphjqjdkeCaYFO42MOyWDO2sj/ZHsFSpIZDNhj2G',1661591608),(18,45,'111111811@artemy.net','u7CQw2RiVdTWHN3T','$2y$10$0qqzSBMyN1wYxKGYyrnz/eUzizQEpqbc2qjdM/.Kg3SW8sezLQju6',1661591644),(19,49,'111111123811@artemy.net','EMHbbhiwMtP149W_','$2y$10$PhwgcTDcRp0L8ujCD4oicuUD4lxsKuzeH5j0VJg82Oa1II./MRxv2',1661592061),(20,51,'4343@artemy.net','Zz8K7wLQq61liMi2','$2y$10$AzxMKtLXYiYTSTiG0OrrIO0kKsWReGSrseoWJDm8tvVmpYrUjjXfq',1661592178),(21,53,'4333343@artemy.net','UgP--pBuO4OC7EAP','$2y$10$7B/3gL95W2wCpwlqOTIui.JUtc1Ox1Wntn/wQibK2EhPuEW9V7gsC',1661592306),(22,56,'3333@artemy.net','WOxlmAHzG36AtiDv','$2y$10$VJpgld1PL5TaBVazLQxU5O8d0rzDLim2FNi8L.Y1tEjfdeRIdyrBS',1661592403),(23,58,'1212354@artemy.net','vXnOSLEK_ZhOqcPq','$2y$10$CjTK.BmHWkffIMiEqD09PO/ffp4cRolwsaUVmogVJnfJgS6bUK5q6',1661592428),(24,59,'1212354344@artemy.net','sqKFD_8TL7R-ybeW','$2y$10$w3WygDQXTJ14x..SPzvLNONgFKupFKv5MZ3wsi8.pOPQYMcvdgO3K',1661592441),(25,60,'121233354344@artemy.net','G1p3RslJcl84Sqyb','$2y$10$3Edoubv3WG/zQXVD1FIJM.aziOqxknWDOH/MM8iIMM6c7br0O6Hzi',1661592537),(26,62,'121233333354344@artemy.net','IZTas8LBWYqBw-LQ','$2y$10$vw0eY5mik0tb0YyfCGaA8OmvFD2vPuiopO95DRcmr.bCQf64hIcUO',1661592551),(27,63,'qwe@artemy.net','vcHFRRDalYSWFy3n','$2y$10$TTR8GPKKcv7wzGKBrdSAauP1Xf.Z681lz9kLkAyHV45yixj8zUKFe',1661592794),(28,65,'qwree@artemy.net','o-j5Hrq3XvnWcxl-','$2y$10$W1rgXU1wEhQxgqSXHLFgquXvPRWi4WxZlSvtMZ29rEIw8YEGReepC',1661592824),(32,71,'rewrer@artemy.net','wMEl8Zg_X08YMpa_','$2y$10$xRyY7GRhFLiluIY/uqVWSOKC8XxoMDtxXVie4x9oTrBNUpBHp1S2S',1661609722);
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
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_remembered`
--

LOCK TABLES `users_remembered` WRITE;
/*!40000 ALTER TABLE `users_remembered` DISABLE KEYS */;
INSERT INTO `users_remembered` VALUES (1,1,'rrUu8G1NK2sCfMSUA7r68GKw','$2y$10$ecL5sBL.UhpxHIJAqUD/Eek1oJHZwAVXiSABOgBQcyVEm7DPazFFC',1692725939),(2,1,'pmOOKny6hbmsvSczNEF4CJh8','$2y$10$5qsS.7oeHlx.t7BWH/6/PeUSn17t0nVq0X2BljZ4y6FDLBS6AAAmu',1692803042),(4,1,'hsHrGtOJ5w6jmR7MJULhvnoo','$2y$10$ecqsH09hFHHGo/uUIZ3JYu/iGyVd.NM63dPpGtfOR0BUV60Roii12',1692804687),(5,1,'7ZrvxvXzhqy_y8_yTVmW-aEI','$2y$10$DaCXmc.pZmXKGGGotQf9o.TxdD9z0zZe2ZG855xXNzJ3rqdx9VkKS',1692806569),(7,11,'NFhuGI_RghHmdG7oEE_xwjH6','$2y$10$AfFLfN20FelfwbYUP8jHyeGFTtj/kzl0bBg1Q6nbjFxbB6uvMID7G',1692807525),(8,1,'HWNVq_G52_tbbf9hEvcj9ujN','$2y$10$kabUFwZ4p1v5Ghx3tE5iXeSNpocgPb66T8Za7TD0bu/pb3lItOSD6',1692807588),(9,1,'zaI86KooiA8FTvyF8YiyJx9e','$2y$10$3JnuBqe7LBInjE6VG9XU3Oi/vRq7SUm7HQbBoVYtHDykirK8/1Jja',1692904742),(10,1,'YdEMaJjSIDiSQ1-RW0K2YpOg','$2y$10$8Mt9y5DnqMdthbqfVOHDnuJsTwob/xps21M9ZCYnehm6CEjByHH32',1692904845),(11,11,'7Ot1vhSJqEJ-Stqk2dvyulSz','$2y$10$qvKTakE5nqWnuO0iWiSVmuVvwIfT7WMZxbBcFaPPGyXmNoDZufPNe',1692904995),(12,11,'3VpUOM8RD-3hTtZOIokuZX1W','$2y$10$njdCWxc7mVKtNkMP22LYx.8CyR12GDh6IE8M6TS0.A5eyAYtn596O',1692905046),(13,1,'DSc7ldlGA2z87jftqdP_Pn1x','$2y$10$hnOFM0fzFn.9v08Vh14cXOIGAYBoBeKj3H5Mc8zgIqL4hIG0J8ove',1692993131),(14,1,'x4G2vwEoX44uhglcxblErcze','$2y$10$Vz9urhEavVT1Rwrfm9pBQO5PjwonwZ/v3BltyWL2R1IVgLdyxHwxS',1692993282),(15,1,'nZiNThkQ_HwgHHTW1aLSXkFG','$2y$10$DAt6yLJPE3ZYAVnJAxqqXuy2c.bSqAUbdYsjSaz9G/yTND56.mMOq',1693062208),(18,1,'ktGq2KTiFrvnh-nmJCwAejX6','$2y$10$1Azc0pCMX80bv.WGdxcFNuM/UXJqCFVeHLBm4XN5Dsi.MwNFjdzLW',1693064935),(20,11,'aYFoG0dS0e_dGveMPvzd0U8o','$2y$10$wrWvrCS2IZ6dKkjSRuo2UOdb0tb7wPJq4vC.vexCN8pVzWj3dhCl2',1693077801),(21,1,'7Y8lpnkUnyg_Clu_F77m2EQJ','$2y$10$eVXqhkEzTdCx8ZnlHoj9guW9XXp0Z02AxOMQWI2WjDGZSZTOUBk0m',1693077897),(22,1,'49izt3CBVRFaarCjy9gDwhaO','$2y$10$XiVWAf4s.H6pqv9cTQ5Pye.xsieuiVyFsAz.er7I9ig5MPQNQ4htC',1693079167),(23,1,'aC4HXqT7hEItV8ZfLRva7qVM','$2y$10$IYmOyBmG1RHYUi87VFEoteyZe1xsrKSGBfmdtiW1.yjddyWb.saWK',1693079240),(24,11,'26Xcd4A2F-8KvZDGPga06sRM','$2y$10$HLsK2ZhP8OZt9Yftkp1CceDSGW9D9RgjU0h2oBKM2AUJV8pH.pcaO',1693109140);
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_resets`
--

LOCK TABLES `users_resets` WRITE;
/*!40000 ALTER TABLE `users_resets` DISABLE KEYS */;
INSERT INTO `users_resets` VALUES (1,1,'xp50HlgCnIoSZdxR7iok','$2y$10$QM4DxLm7Jt8FLU53nAiw2OSUrAcZIf1fbOczh12f59rlfI6MY7q86',1661251342),(2,1,'QmL-5q7jh-2Kewz_69Gz','$2y$10$kwVLn.wC2lUyNlM9MNXwSu/LBc84.xYuRkGxg4rEY6wHHTYeYfagy',1661251397);
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
INSERT INTO `users_throttling` VALUES ('_mQqixpaRHHDDBWUyMklhcEGC6ap0sfHLBIDD2zROrQ',73.5861,1661523750,1662063750),('7A0Cg5zpZ12o-f6rNEkibYgdCUn_GxiOIEUZAjAXufo',73.4878,1661523322,1662063322),('KrEftCD27DvKBROANjGQCDYnoQbQ7wzMKTUIIQp1HXc',74,1661551540,1662091540),('YHFVhIgVkyTYvYYLEm1IVu0ncEACKgXlymrlokjJntE',4,1661523324,1661955324);
/*!40000 ALTER TABLE `users_throttling` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `work`
--

DROP TABLE IF EXISTS `work`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `work` (
  `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID работы',
  `name` varchar(255) NOT NULL COMMENT 'Наименование',
  `price` decimal(19,2) unsigned NOT NULL COMMENT 'Стоимость',
  `amount` decimal(19,2) unsigned NOT NULL COMMENT 'Кол-во',
  `is_available` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Доступ (доступный, удаленный)',
  `unit_id` int unsigned NOT NULL COMMENT 'ID ед. измерения',
  `version` int DEFAULT '0',
  `version_created_at` timestamp NULL DEFAULT NULL,
  `version_created_by` varchar(100) DEFAULT NULL,
  `version_comment` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `unit_id` (`unit_id`),
  CONSTRAINT `work_ibfk_1` FOREIGN KEY (`unit_id`) REFERENCES `unit` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `work`
--

LOCK TABLES `work` WRITE;
/*!40000 ALTER TABLE `work` DISABLE KEYS */;
/*!40000 ALTER TABLE `work` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `work_material`
--

DROP TABLE IF EXISTS `work_material`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `work_material` (
  `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID материала работы',
  `work_id` int unsigned NOT NULL COMMENT 'ID работы',
  `material_id` int unsigned NOT NULL COMMENT 'ID материала',
  `amount` decimal(19,2) unsigned NOT NULL COMMENT 'Кол-во',
  `is_available` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Доступ (доступный, удаленный)',
  `version` int DEFAULT '0',
  `version_created_at` timestamp NULL DEFAULT NULL,
  `version_created_by` varchar(100) DEFAULT NULL,
  `version_comment` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `work_id` (`work_id`),
  KEY `material_id` (`material_id`),
  CONSTRAINT `work_material_ibfk_1` FOREIGN KEY (`work_id`) REFERENCES `work` (`id`),
  CONSTRAINT `work_material_ibfk_2` FOREIGN KEY (`material_id`) REFERENCES `material` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `work_material`
--

LOCK TABLES `work_material` WRITE;
/*!40000 ALTER TABLE `work_material` DISABLE KEYS */;
/*!40000 ALTER TABLE `work_material` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `work_material_version`
--

DROP TABLE IF EXISTS `work_material_version`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `work_material_version` (
  `id` int unsigned NOT NULL COMMENT 'ID материала работы',
  `work_id` int unsigned NOT NULL COMMENT 'ID работы',
  `material_id` int unsigned NOT NULL COMMENT 'ID материала',
  `amount` decimal(19,2) unsigned NOT NULL COMMENT 'Кол-во',
  `is_available` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Доступ (доступный, удаленный)',
  `version` int NOT NULL DEFAULT '0',
  `version_created_at` timestamp NULL DEFAULT NULL,
  `version_created_by` varchar(100) DEFAULT NULL,
  `version_comment` varchar(255) DEFAULT NULL,
  `work_id_version` int DEFAULT '0',
  `material_id_version` int DEFAULT '0',
  PRIMARY KEY (`id`,`version`),
  CONSTRAINT `work_material_version_fk_747b8b` FOREIGN KEY (`id`) REFERENCES `work_material` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `work_material_version`
--

LOCK TABLES `work_material_version` WRITE;
/*!40000 ALTER TABLE `work_material_version` DISABLE KEYS */;
/*!40000 ALTER TABLE `work_material_version` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `work_technic`
--

DROP TABLE IF EXISTS `work_technic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `work_technic` (
  `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID техники работы',
  `work_id` int unsigned NOT NULL COMMENT 'ID работы',
  `technic_id` int unsigned NOT NULL COMMENT 'ID техники',
  `amount` decimal(19,2) unsigned NOT NULL COMMENT 'Кол-во',
  `is_available` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Доступ (доступный, удаленный)',
  `version` int DEFAULT '0',
  `version_created_at` timestamp NULL DEFAULT NULL,
  `version_created_by` varchar(100) DEFAULT NULL,
  `version_comment` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `work_id` (`work_id`),
  KEY `technic_id` (`technic_id`),
  CONSTRAINT `work_technic_ibfk_1` FOREIGN KEY (`work_id`) REFERENCES `work` (`id`),
  CONSTRAINT `work_technic_ibfk_2` FOREIGN KEY (`technic_id`) REFERENCES `technic` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `work_technic`
--

LOCK TABLES `work_technic` WRITE;
/*!40000 ALTER TABLE `work_technic` DISABLE KEYS */;
/*!40000 ALTER TABLE `work_technic` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `work_technic_version`
--

DROP TABLE IF EXISTS `work_technic_version`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `work_technic_version` (
  `id` int unsigned NOT NULL COMMENT 'ID техники работы',
  `work_id` int unsigned NOT NULL COMMENT 'ID работы',
  `technic_id` int unsigned NOT NULL COMMENT 'ID техники',
  `amount` decimal(19,2) unsigned NOT NULL COMMENT 'Кол-во',
  `is_available` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Доступ (доступный, удаленный)',
  `version` int NOT NULL DEFAULT '0',
  `version_created_at` timestamp NULL DEFAULT NULL,
  `version_created_by` varchar(100) DEFAULT NULL,
  `version_comment` varchar(255) DEFAULT NULL,
  `work_id_version` int DEFAULT '0',
  `technic_id_version` int DEFAULT '0',
  PRIMARY KEY (`id`,`version`),
  CONSTRAINT `work_technic_version_fk_b0d0da` FOREIGN KEY (`id`) REFERENCES `work_technic` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `work_technic_version`
--

LOCK TABLES `work_technic_version` WRITE;
/*!40000 ALTER TABLE `work_technic_version` DISABLE KEYS */;
/*!40000 ALTER TABLE `work_technic_version` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `work_version`
--

DROP TABLE IF EXISTS `work_version`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `work_version` (
  `id` int unsigned NOT NULL COMMENT 'ID работы',
  `name` varchar(255) NOT NULL COMMENT 'Наименование',
  `price` decimal(19,2) unsigned NOT NULL COMMENT 'Стоимость',
  `amount` decimal(19,2) unsigned NOT NULL COMMENT 'Кол-во',
  `is_available` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Доступ (доступный, удаленный)',
  `unit_id` int unsigned NOT NULL COMMENT 'ID ед. измерения',
  `version` int NOT NULL DEFAULT '0',
  `version_created_at` timestamp NULL DEFAULT NULL,
  `version_created_by` varchar(100) DEFAULT NULL,
  `version_comment` varchar(255) DEFAULT NULL,
  `work_material_ids` text,
  `work_material_versions` text,
  `work_technic_ids` text,
  `work_technic_versions` text,
  PRIMARY KEY (`id`,`version`),
  CONSTRAINT `work_version_fk_40cf0f` FOREIGN KEY (`id`) REFERENCES `work` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `work_version`
--

LOCK TABLES `work_version` WRITE;
/*!40000 ALTER TABLE `work_version` DISABLE KEYS */;
/*!40000 ALTER TABLE `work_version` ENABLE KEYS */;
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
