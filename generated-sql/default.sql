
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- access
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `access`;

CREATE TABLE `access`
(
    `role_id` int unsigned NOT NULL COMMENT 'ID роли',
    `object_viewer` TINYINT(1) DEFAULT 0 NOT NULL COMMENT 'Просмотр объектов (все, конкретные)',
    `manage_objects` TINYINT(1) DEFAULT 0 NOT NULL COMMENT 'CRUD объектов (все, конкретные)',
    `manage_volumes` TINYINT(1) DEFAULT 0 NOT NULL COMMENT 'CRUD объёмов (все, никакие)',
    `manage_history` TINYINT(1) DEFAULT 0 NOT NULL COMMENT 'Управление историей',
    `manage_users` TINYINT(1) DEFAULT 0 NOT NULL COMMENT 'CRUD учетными записями',
    PRIMARY KEY (`role_id`),
    CONSTRAINT `access_ibfk_1`
        FOREIGN KEY (`role_id`)
        REFERENCES `role` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- groups
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `groups`;

CREATE TABLE `groups`
(
    `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID группы',
    `name` VARCHAR(255) NOT NULL COMMENT 'Наименование',
    `status` set('in_process','completed','deleted') DEFAULT 'in_process' NOT NULL COMMENT 'Статус (в процессе, завершен, удален)	',
    `is_available` TINYINT(1) DEFAULT 1 NOT NULL COMMENT 'Доступ (публичный, приватный)',
    `subproject_id` int unsigned NOT NULL COMMENT 'ID подпроекта',
    `version` INTEGER DEFAULT 0,
    `version_created_at` TIMESTAMP NULL,
    `version_created_by` VARCHAR(100),
    `version_comment` VARCHAR(255),
    PRIMARY KEY (`id`),
    INDEX `subproject_id` (`subproject_id`),
    CONSTRAINT `groups_ibfk_1`
        FOREIGN KEY (`subproject_id`)
        REFERENCES `subproject` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- groups_version
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `groups_version`;

CREATE TABLE `groups_version`
(
    `id` int unsigned NOT NULL COMMENT 'ID группы',
    `name` VARCHAR(255) NOT NULL COMMENT 'Наименование',
    `status` set('in_process','completed','deleted') DEFAULT 'in_process' NOT NULL COMMENT 'Статус (в процессе, завершен, удален)	',
    `is_available` TINYINT(1) DEFAULT 1 NOT NULL COMMENT 'Доступ (публичный, приватный)',
    `subproject_id` int unsigned NOT NULL COMMENT 'ID подпроекта',
    `version` INTEGER DEFAULT 0 NOT NULL,
    `version_created_at` TIMESTAMP NULL,
    `version_created_by` VARCHAR(100),
    `version_comment` VARCHAR(255),
    `subproject_id_version` INTEGER DEFAULT 0,
    `house_ids` TEXT,
    `house_versions` TEXT,
    PRIMARY KEY (`id`,`version`),
    CONSTRAINT `groups_version_fk_48de95`
        FOREIGN KEY (`id`)
        REFERENCES `groups` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- house
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `house`;

CREATE TABLE `house`
(
    `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID дома',
    `name` VARCHAR(255) NOT NULL COMMENT 'Наименование',
    `status` set('in_process','completed','deleted') DEFAULT 'in_process' NOT NULL COMMENT 'Статус (в процессе, завершен, удален)	',
    `is_available` TINYINT(1) DEFAULT 1 NOT NULL COMMENT 'Доступ (публичный, приватный)',
    `group_id` int unsigned NOT NULL COMMENT 'Id группы',
    `version` INTEGER DEFAULT 0,
    `version_created_at` TIMESTAMP NULL,
    `version_created_by` VARCHAR(100),
    `version_comment` VARCHAR(255),
    PRIMARY KEY (`id`),
    INDEX `group_id` (`group_id`),
    CONSTRAINT `house_ibfk_1`
        FOREIGN KEY (`group_id`)
        REFERENCES `groups` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- house_version
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `house_version`;

CREATE TABLE `house_version`
(
    `id` int unsigned NOT NULL COMMENT 'ID дома',
    `name` VARCHAR(255) NOT NULL COMMENT 'Наименование',
    `status` set('in_process','completed','deleted') DEFAULT 'in_process' NOT NULL COMMENT 'Статус (в процессе, завершен, удален)	',
    `is_available` TINYINT(1) DEFAULT 1 NOT NULL COMMENT 'Доступ (публичный, приватный)',
    `group_id` int unsigned NOT NULL COMMENT 'Id группы',
    `version` INTEGER DEFAULT 0 NOT NULL,
    `version_created_at` TIMESTAMP NULL,
    `version_created_by` VARCHAR(100),
    `version_comment` VARCHAR(255),
    `group_id_version` INTEGER DEFAULT 0,
    `stage_ids` TEXT,
    `stage_versions` TEXT,
    PRIMARY KEY (`id`,`version`),
    CONSTRAINT `house_version_fk_fa1e78`
        FOREIGN KEY (`id`)
        REFERENCES `house` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- material
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `material`;

CREATE TABLE `material`
(
    `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID материала',
    `name` VARCHAR(255) NOT NULL COMMENT 'Наименование',
    `price` decimal(19,2) unsigned NOT NULL COMMENT 'Стоимость',
    `is_available` TINYINT(1) DEFAULT 1 NOT NULL COMMENT 'Доступ (доступный, удаленный)',
    `unit_id` int unsigned NOT NULL COMMENT 'ID ед. измерения',
    `version` INTEGER DEFAULT 0,
    `version_created_at` TIMESTAMP NULL,
    `version_created_by` VARCHAR(100),
    `version_comment` VARCHAR(255),
    PRIMARY KEY (`id`),
    INDEX `unit_id` (`unit_id`),
    CONSTRAINT `material_ibfk_1`
        FOREIGN KEY (`unit_id`)
        REFERENCES `unit` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- material_version
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `material_version`;

CREATE TABLE `material_version`
(
    `id` int unsigned NOT NULL COMMENT 'ID материала',
    `name` VARCHAR(255) NOT NULL COMMENT 'Наименование',
    `price` decimal(19,2) unsigned NOT NULL COMMENT 'Стоимость',
    `is_available` TINYINT(1) DEFAULT 1 NOT NULL COMMENT 'Доступ (доступный, удаленный)',
    `unit_id` int unsigned NOT NULL COMMENT 'ID ед. измерения',
    `version` INTEGER DEFAULT 0 NOT NULL,
    `version_created_at` TIMESTAMP NULL,
    `version_created_by` VARCHAR(100),
    `version_comment` VARCHAR(255),
    `stage_material_ids` TEXT,
    `stage_material_versions` TEXT,
    `work_material_ids` TEXT,
    `work_material_versions` TEXT,
    PRIMARY KEY (`id`,`version`),
    CONSTRAINT `material_version_fk_8d347e`
        FOREIGN KEY (`id`)
        REFERENCES `material` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- project
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `project`;

CREATE TABLE `project`
(
    `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID проекта',
    `name` VARCHAR(255) NOT NULL COMMENT 'Наименование',
    `status` set('in_process','completed','deleted') DEFAULT 'in_process' NOT NULL COMMENT 'Статус (в процессе, завершен, удален)',
    `is_available` TINYINT(1) DEFAULT 1 NOT NULL COMMENT 'Доступ (пуличный, приватный)',
    `version` INTEGER DEFAULT 0,
    `version_created_at` TIMESTAMP NULL,
    `version_created_by` VARCHAR(100),
    `version_comment` VARCHAR(255),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- project_role
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `project_role`;

CREATE TABLE `project_role`
(
    `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID роли проекта',
    `lvl` tinyint unsigned DEFAULT 1 NOT NULL COMMENT 'Уровень
( 1 - проекта;
2 - подпроект;
3 - группа;
4 - дом;
5 - этап )',
    `role_id` int unsigned NOT NULL COMMENT 'ID роли',
    `project_id` int unsigned NOT NULL COMMENT 'ID проекта',
    `object_id` int unsigned NOT NULL COMMENT 'ID объекта (проект, подпроект, группа, дом, этап)',
    `user_id` int unsigned NOT NULL COMMENT 'ID пользователя',
    `version` INTEGER DEFAULT 0,
    `version_created_at` TIMESTAMP NULL,
    `version_created_by` VARCHAR(100),
    `version_comment` VARCHAR(255),
    PRIMARY KEY (`id`),
    INDEX `role_id` (`role_id`),
    INDEX `project_id` (`project_id`),
    INDEX `user_id` (`user_id`),
    CONSTRAINT `project_role_ibfk_1`
        FOREIGN KEY (`role_id`)
        REFERENCES `role` (`id`),
    CONSTRAINT `project_role_ibfk_2`
        FOREIGN KEY (`project_id`)
        REFERENCES `project` (`id`),
    CONSTRAINT `project_role_ibfk_3`
        FOREIGN KEY (`user_id`)
        REFERENCES `users` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- project_role_version
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `project_role_version`;

CREATE TABLE `project_role_version`
(
    `id` int unsigned NOT NULL COMMENT 'ID роли проекта',
    `lvl` tinyint unsigned DEFAULT 1 NOT NULL COMMENT 'Уровень
( 1 - проекта;
2 - подпроект;
3 - группа;
4 - дом;
5 - этап )',
    `role_id` int unsigned NOT NULL COMMENT 'ID роли',
    `project_id` int unsigned NOT NULL COMMENT 'ID проекта',
    `object_id` int unsigned NOT NULL COMMENT 'ID объекта (проект, подпроект, группа, дом, этап)',
    `user_id` int unsigned NOT NULL COMMENT 'ID пользователя',
    `version` INTEGER DEFAULT 0 NOT NULL,
    `version_created_at` TIMESTAMP NULL,
    `version_created_by` VARCHAR(100),
    `version_comment` VARCHAR(255),
    `project_id_version` INTEGER DEFAULT 0,
    PRIMARY KEY (`id`,`version`),
    CONSTRAINT `project_role_version_fk_c3a605`
        FOREIGN KEY (`id`)
        REFERENCES `project_role` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- project_version
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `project_version`;

CREATE TABLE `project_version`
(
    `id` int unsigned NOT NULL COMMENT 'ID проекта',
    `name` VARCHAR(255) NOT NULL COMMENT 'Наименование',
    `status` set('in_process','completed','deleted') DEFAULT 'in_process' NOT NULL COMMENT 'Статус (в процессе, завершен, удален)',
    `is_available` TINYINT(1) DEFAULT 1 NOT NULL COMMENT 'Доступ (пуличный, приватный)',
    `version` INTEGER DEFAULT 0 NOT NULL,
    `version_created_at` TIMESTAMP NULL,
    `version_created_by` VARCHAR(100),
    `version_comment` VARCHAR(255),
    `project_role_ids` TEXT,
    `project_role_versions` TEXT,
    `subproject_ids` TEXT,
    `subproject_versions` TEXT,
    PRIMARY KEY (`id`,`version`),
    CONSTRAINT `project_version_fk_186d55`
        FOREIGN KEY (`id`)
        REFERENCES `project` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- role
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `role`;

CREATE TABLE `role`
(
    `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID роли',
    `name` VARCHAR(255) NOT NULL COMMENT 'Наименование',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- stage
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `stage`;

CREATE TABLE `stage`
(
    `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID этапа',
    `name` VARCHAR(255) NOT NULL COMMENT 'Наименование',
    `status` set('in_process','completed','deleted') DEFAULT 'in_process' NOT NULL COMMENT 'Статус (в процессе, завершен, удален)	',
    `is_available` TINYINT(1) DEFAULT 1 NOT NULL COMMENT 'Доступ (публичный, приватный)',
    `house_id` int unsigned NOT NULL COMMENT 'ID дома',
    `version` INTEGER DEFAULT 0,
    `version_created_at` TIMESTAMP NULL,
    `version_created_by` VARCHAR(100),
    `version_comment` VARCHAR(255),
    PRIMARY KEY (`id`),
    INDEX `house_id` (`house_id`),
    CONSTRAINT `stage_ibfk_1`
        FOREIGN KEY (`house_id`)
        REFERENCES `house` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- stage_material
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `stage_material`;

CREATE TABLE `stage_material`
(
    `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID материала работы на этапе',
    `price` decimal(19,2) unsigned NOT NULL COMMENT 'Стоимость',
    `amount` decimal(19,2) unsigned NOT NULL COMMENT 'Кол-во',
    `is_available` TINYINT(1) DEFAULT 1 NOT NULL COMMENT 'Доступ (публичный, приватный)',
    `stage_work_id` int unsigned NOT NULL COMMENT 'ID работы этапа',
    `material_id` int unsigned NOT NULL COMMENT 'ID материала',
    `version` INTEGER DEFAULT 0,
    `version_created_at` TIMESTAMP NULL,
    `version_created_by` VARCHAR(100),
    `version_comment` VARCHAR(255),
    PRIMARY KEY (`id`),
    INDEX `material_id` (`material_id`),
    INDEX `stage_work_id` (`stage_work_id`),
    CONSTRAINT `stage_material_ibfk_1`
        FOREIGN KEY (`material_id`)
        REFERENCES `material` (`id`),
    CONSTRAINT `stage_material_ibfk_2`
        FOREIGN KEY (`stage_work_id`)
        REFERENCES `stage_work` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- stage_material_version
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `stage_material_version`;

CREATE TABLE `stage_material_version`
(
    `id` int unsigned NOT NULL COMMENT 'ID материала работы на этапе',
    `price` decimal(19,2) unsigned NOT NULL COMMENT 'Стоимость',
    `amount` decimal(19,2) unsigned NOT NULL COMMENT 'Кол-во',
    `is_available` TINYINT(1) DEFAULT 1 NOT NULL COMMENT 'Доступ (публичный, приватный)',
    `stage_work_id` int unsigned NOT NULL COMMENT 'ID работы этапа',
    `material_id` int unsigned NOT NULL COMMENT 'ID материала',
    `version` INTEGER DEFAULT 0 NOT NULL,
    `version_created_at` TIMESTAMP NULL,
    `version_created_by` VARCHAR(100),
    `version_comment` VARCHAR(255),
    `material_id_version` INTEGER DEFAULT 0,
    `stage_work_id_version` INTEGER DEFAULT 0,
    PRIMARY KEY (`id`,`version`),
    CONSTRAINT `stage_material_version_fk_b671c9`
        FOREIGN KEY (`id`)
        REFERENCES `stage_material` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- stage_technic
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `stage_technic`;

CREATE TABLE `stage_technic`
(
    `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID техники работы',
    `price` decimal(19,2) unsigned NOT NULL COMMENT 'Стоимость',
    `amount` decimal(19,2) unsigned NOT NULL COMMENT 'Кол-во',
    `is_available` TINYINT(1) DEFAULT 1 NOT NULL COMMENT 'Доступ (публичный, приватный)',
    `technic_id` int unsigned NOT NULL COMMENT 'ID техники',
    `stage_work_id` int unsigned NOT NULL COMMENT 'ID работы этапа',
    `version` INTEGER DEFAULT 0,
    `version_created_at` TIMESTAMP NULL,
    `version_created_by` VARCHAR(100),
    `version_comment` VARCHAR(255),
    PRIMARY KEY (`id`),
    INDEX `stage_work_id` (`stage_work_id`),
    INDEX `technic_id` (`technic_id`),
    CONSTRAINT `stage_technic_ibfk_1`
        FOREIGN KEY (`stage_work_id`)
        REFERENCES `stage_work` (`id`),
    CONSTRAINT `stage_technic_ibfk_2`
        FOREIGN KEY (`technic_id`)
        REFERENCES `technic` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- stage_technic_version
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `stage_technic_version`;

CREATE TABLE `stage_technic_version`
(
    `id` int unsigned NOT NULL COMMENT 'ID техники работы',
    `price` decimal(19,2) unsigned NOT NULL COMMENT 'Стоимость',
    `amount` decimal(19,2) unsigned NOT NULL COMMENT 'Кол-во',
    `is_available` TINYINT(1) DEFAULT 1 NOT NULL COMMENT 'Доступ (публичный, приватный)',
    `technic_id` int unsigned NOT NULL COMMENT 'ID техники',
    `stage_work_id` int unsigned NOT NULL COMMENT 'ID работы этапа',
    `version` INTEGER DEFAULT 0 NOT NULL,
    `version_created_at` TIMESTAMP NULL,
    `version_created_by` VARCHAR(100),
    `version_comment` VARCHAR(255),
    `stage_work_id_version` INTEGER DEFAULT 0,
    `technic_id_version` INTEGER DEFAULT 0,
    PRIMARY KEY (`id`,`version`),
    CONSTRAINT `stage_technic_version_fk_2072b7`
        FOREIGN KEY (`id`)
        REFERENCES `stage_technic` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- stage_version
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `stage_version`;

CREATE TABLE `stage_version`
(
    `id` int unsigned NOT NULL COMMENT 'ID этапа',
    `name` VARCHAR(255) NOT NULL COMMENT 'Наименование',
    `status` set('in_process','completed','deleted') DEFAULT 'in_process' NOT NULL COMMENT 'Статус (в процессе, завершен, удален)	',
    `is_available` TINYINT(1) DEFAULT 1 NOT NULL COMMENT 'Доступ (публичный, приватный)',
    `house_id` int unsigned NOT NULL COMMENT 'ID дома',
    `version` INTEGER DEFAULT 0 NOT NULL,
    `version_created_at` TIMESTAMP NULL,
    `version_created_by` VARCHAR(100),
    `version_comment` VARCHAR(255),
    `house_id_version` INTEGER DEFAULT 0,
    PRIMARY KEY (`id`,`version`),
    CONSTRAINT `stage_version_fk_203498`
        FOREIGN KEY (`id`)
        REFERENCES `stage` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- stage_work
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `stage_work`;

CREATE TABLE `stage_work`
(
    `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID работы этапа',
    `stage_id` int unsigned NOT NULL COMMENT 'ID этапа',
    `work_id` int unsigned NOT NULL COMMENT 'ID работы',
    `price` decimal(19,2) unsigned NOT NULL COMMENT 'Стоимость',
    `amount` decimal(19,2) unsigned NOT NULL COMMENT 'Кол-во',
    `version` INTEGER DEFAULT 0,
    `version_created_at` TIMESTAMP NULL,
    `version_created_by` VARCHAR(100),
    `version_comment` VARCHAR(255),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- stage_work_version
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `stage_work_version`;

CREATE TABLE `stage_work_version`
(
    `id` int unsigned NOT NULL COMMENT 'ID работы этапа',
    `stage_id` int unsigned NOT NULL COMMENT 'ID этапа',
    `work_id` int unsigned NOT NULL COMMENT 'ID работы',
    `price` decimal(19,2) unsigned NOT NULL COMMENT 'Стоимость',
    `amount` decimal(19,2) unsigned NOT NULL COMMENT 'Кол-во',
    `version` INTEGER DEFAULT 0 NOT NULL,
    `version_created_at` TIMESTAMP NULL,
    `version_created_by` VARCHAR(100),
    `version_comment` VARCHAR(255),
    `stage_material_ids` TEXT,
    `stage_material_versions` TEXT,
    `stage_technic_ids` TEXT,
    `stage_technic_versions` TEXT,
    PRIMARY KEY (`id`,`version`),
    CONSTRAINT `stage_work_version_fk_7e51cc`
        FOREIGN KEY (`id`)
        REFERENCES `stage_work` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- subproject
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `subproject`;

CREATE TABLE `subproject`
(
    `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID подпроекта',
    `name` VARCHAR(255) NOT NULL COMMENT 'Наименование',
    `status` set('in_process','completed','deleted') DEFAULT 'in_process' NOT NULL COMMENT 'Статус (в процессе, завершен, удален)',
    `is_available` TINYINT(1) DEFAULT 1 NOT NULL COMMENT 'Доступ (публичный, приватный)',
    `project_id` int unsigned NOT NULL COMMENT 'ID проекта',
    `version` INTEGER DEFAULT 0,
    `version_created_at` TIMESTAMP NULL,
    `version_created_by` VARCHAR(100),
    `version_comment` VARCHAR(255),
    PRIMARY KEY (`id`),
    INDEX `project_id` (`project_id`),
    CONSTRAINT `subproject_ibfk_1`
        FOREIGN KEY (`project_id`)
        REFERENCES `project` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- subproject_version
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `subproject_version`;

CREATE TABLE `subproject_version`
(
    `id` int unsigned NOT NULL COMMENT 'ID подпроекта',
    `name` VARCHAR(255) NOT NULL COMMENT 'Наименование',
    `status` set('in_process','completed','deleted') DEFAULT 'in_process' NOT NULL COMMENT 'Статус (в процессе, завершен, удален)',
    `is_available` TINYINT(1) DEFAULT 1 NOT NULL COMMENT 'Доступ (публичный, приватный)',
    `project_id` int unsigned NOT NULL COMMENT 'ID проекта',
    `version` INTEGER DEFAULT 0 NOT NULL,
    `version_created_at` TIMESTAMP NULL,
    `version_created_by` VARCHAR(100),
    `version_comment` VARCHAR(255),
    `project_id_version` INTEGER DEFAULT 0,
    `groups_ids` TEXT,
    `groups_versions` TEXT,
    PRIMARY KEY (`id`,`version`),
    CONSTRAINT `subproject_version_fk_03348b`
        FOREIGN KEY (`id`)
        REFERENCES `subproject` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- technic
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `technic`;

CREATE TABLE `technic`
(
    `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID техники',
    `name` VARCHAR(255) NOT NULL COMMENT 'Наименование',
    `price` decimal(19,2) unsigned NOT NULL COMMENT 'Стоимость',
    `is_available` TINYINT(1) DEFAULT 1 NOT NULL COMMENT 'Доступ (доступный, удаленный)',
    `unit_id` int unsigned NOT NULL COMMENT 'ID ед. измерения',
    `version` INTEGER DEFAULT 0,
    `version_created_at` TIMESTAMP NULL,
    `version_created_by` VARCHAR(100),
    `version_comment` VARCHAR(255),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- technic_version
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `technic_version`;

CREATE TABLE `technic_version`
(
    `id` int unsigned NOT NULL COMMENT 'ID техники',
    `name` VARCHAR(255) NOT NULL COMMENT 'Наименование',
    `price` decimal(19,2) unsigned NOT NULL COMMENT 'Стоимость',
    `is_available` TINYINT(1) DEFAULT 1 NOT NULL COMMENT 'Доступ (доступный, удаленный)',
    `unit_id` int unsigned NOT NULL COMMENT 'ID ед. измерения',
    `version` INTEGER DEFAULT 0 NOT NULL,
    `version_created_at` TIMESTAMP NULL,
    `version_created_by` VARCHAR(100),
    `version_comment` VARCHAR(255),
    `stage_technic_ids` TEXT,
    `stage_technic_versions` TEXT,
    `work_technic_ids` TEXT,
    `work_technic_versions` TEXT,
    PRIMARY KEY (`id`,`version`),
    CONSTRAINT `technic_version_fk_9f10cd`
        FOREIGN KEY (`id`)
        REFERENCES `technic` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- unit
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `unit`;

CREATE TABLE `unit`
(
    `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID ед. измерения',
    `name` VARCHAR(255) NOT NULL COMMENT 'Наименование',
    `is_available` TINYINT(1) DEFAULT 1 NOT NULL COMMENT 'Доступ (доступный, удаленный)',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- users
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users`
(
    `id` int unsigned NOT NULL AUTO_INCREMENT,
    `email` VARCHAR(249) NOT NULL,
    `phone` VARCHAR(11),
    `password` VARCHAR(255) NOT NULL,
    `username` VARCHAR(100),
    `status` tinyint unsigned DEFAULT 0 NOT NULL,
    `role_id` int unsigned COMMENT 'ID роли',
    `verified` tinyint unsigned DEFAULT 0 NOT NULL,
    `resettable` tinyint unsigned DEFAULT 1 NOT NULL,
    `roles_mask` int unsigned DEFAULT 0 NOT NULL,
    `registered` int unsigned NOT NULL,
    `last_login` int unsigned,
    `force_logout` mediumint unsigned DEFAULT 0 NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `email` (`email`),
    INDEX `role_id` (`role_id`),
    CONSTRAINT `users_ibfk_1`
        FOREIGN KEY (`role_id`)
        REFERENCES `role` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- users_confirmations
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `users_confirmations`;

CREATE TABLE `users_confirmations`
(
    `id` int unsigned NOT NULL AUTO_INCREMENT,
    `user_id` int unsigned NOT NULL,
    `email` VARCHAR(249) NOT NULL,
    `selector` VARCHAR(16) NOT NULL,
    `token` VARCHAR(255) NOT NULL,
    `expires` int unsigned NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `selector` (`selector`),
    INDEX `email_expires` (`email`, `expires`),
    INDEX `user_id` (`user_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- users_remembered
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `users_remembered`;

CREATE TABLE `users_remembered`
(
    `id` bigint unsigned NOT NULL AUTO_INCREMENT,
    `user` int unsigned NOT NULL,
    `selector` VARCHAR(24) NOT NULL,
    `token` VARCHAR(255) NOT NULL,
    `expires` int unsigned NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `selector` (`selector`),
    INDEX `user` (`user`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- users_resets
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `users_resets`;

CREATE TABLE `users_resets`
(
    `id` bigint unsigned NOT NULL AUTO_INCREMENT,
    `user` int unsigned NOT NULL,
    `selector` VARCHAR(20) NOT NULL,
    `token` VARCHAR(255) NOT NULL,
    `expires` int unsigned NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `selector` (`selector`),
    INDEX `user_expires` (`user`, `expires`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- users_throttling
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `users_throttling`;

CREATE TABLE `users_throttling`
(
    `bucket` VARCHAR(44) NOT NULL,
    `tokens` float unsigned NOT NULL,
    `replenished_at` int unsigned NOT NULL,
    `expires_at` int unsigned NOT NULL,
    PRIMARY KEY (`bucket`),
    INDEX `expires_at` (`expires_at`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- work
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `work`;

CREATE TABLE `work`
(
    `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID работы',
    `name` VARCHAR(255) NOT NULL COMMENT 'Наименование',
    `price` decimal(19,2) unsigned NOT NULL COMMENT 'Стоимость',
    `amount` decimal(19,2) unsigned NOT NULL COMMENT 'Кол-во',
    `is_available` TINYINT(1) DEFAULT 1 NOT NULL COMMENT 'Доступ (доступный, удаленный)',
    `unit_id` int unsigned NOT NULL COMMENT 'ID ед. измерения',
    `version` INTEGER DEFAULT 0,
    `version_created_at` TIMESTAMP NULL,
    `version_created_by` VARCHAR(100),
    `version_comment` VARCHAR(255),
    PRIMARY KEY (`id`),
    INDEX `unit_id` (`unit_id`),
    CONSTRAINT `work_ibfk_1`
        FOREIGN KEY (`unit_id`)
        REFERENCES `unit` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- work_material
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `work_material`;

CREATE TABLE `work_material`
(
    `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID материала работы',
    `work_id` int unsigned NOT NULL COMMENT 'ID работы',
    `material_id` int unsigned NOT NULL COMMENT 'ID материала',
    `amount` decimal(19,2) unsigned NOT NULL COMMENT 'Кол-во',
    `version` INTEGER DEFAULT 0,
    `version_created_at` TIMESTAMP NULL,
    `version_created_by` VARCHAR(100),
    `version_comment` VARCHAR(255),
    PRIMARY KEY (`id`),
    INDEX `work_id` (`work_id`),
    INDEX `material_id` (`material_id`),
    CONSTRAINT `work_material_ibfk_1`
        FOREIGN KEY (`work_id`)
        REFERENCES `work` (`id`),
    CONSTRAINT `work_material_ibfk_2`
        FOREIGN KEY (`material_id`)
        REFERENCES `material` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- work_material_version
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `work_material_version`;

CREATE TABLE `work_material_version`
(
    `id` int unsigned NOT NULL COMMENT 'ID материала работы',
    `work_id` int unsigned NOT NULL COMMENT 'ID работы',
    `material_id` int unsigned NOT NULL COMMENT 'ID материала',
    `amount` decimal(19,2) unsigned NOT NULL COMMENT 'Кол-во',
    `version` INTEGER DEFAULT 0 NOT NULL,
    `version_created_at` TIMESTAMP NULL,
    `version_created_by` VARCHAR(100),
    `version_comment` VARCHAR(255),
    `work_id_version` INTEGER DEFAULT 0,
    `material_id_version` INTEGER DEFAULT 0,
    PRIMARY KEY (`id`,`version`),
    CONSTRAINT `work_material_version_fk_747b8b`
        FOREIGN KEY (`id`)
        REFERENCES `work_material` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- work_technic
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `work_technic`;

CREATE TABLE `work_technic`
(
    `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID техники работы',
    `work_id` int unsigned NOT NULL COMMENT 'ID работы',
    `technic_id` int unsigned NOT NULL COMMENT 'ID техники',
    `amount` decimal(19,2) unsigned NOT NULL COMMENT 'Кол-во',
    `version` INTEGER DEFAULT 0,
    `version_created_at` TIMESTAMP NULL,
    `version_created_by` VARCHAR(100),
    `version_comment` VARCHAR(255),
    PRIMARY KEY (`id`),
    INDEX `work_id` (`work_id`),
    INDEX `technic_id` (`technic_id`),
    CONSTRAINT `work_technic_ibfk_1`
        FOREIGN KEY (`work_id`)
        REFERENCES `work` (`id`),
    CONSTRAINT `work_technic_ibfk_2`
        FOREIGN KEY (`technic_id`)
        REFERENCES `technic` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- work_technic_version
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `work_technic_version`;

CREATE TABLE `work_technic_version`
(
    `id` int unsigned NOT NULL COMMENT 'ID техники работы',
    `work_id` int unsigned NOT NULL COMMENT 'ID работы',
    `technic_id` int unsigned NOT NULL COMMENT 'ID техники',
    `amount` decimal(19,2) unsigned NOT NULL COMMENT 'Кол-во',
    `version` INTEGER DEFAULT 0 NOT NULL,
    `version_created_at` TIMESTAMP NULL,
    `version_created_by` VARCHAR(100),
    `version_comment` VARCHAR(255),
    `work_id_version` INTEGER DEFAULT 0,
    `technic_id_version` INTEGER DEFAULT 0,
    PRIMARY KEY (`id`,`version`),
    CONSTRAINT `work_technic_version_fk_b0d0da`
        FOREIGN KEY (`id`)
        REFERENCES `work_technic` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- work_version
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `work_version`;

CREATE TABLE `work_version`
(
    `id` int unsigned NOT NULL COMMENT 'ID работы',
    `name` VARCHAR(255) NOT NULL COMMENT 'Наименование',
    `price` decimal(19,2) unsigned NOT NULL COMMENT 'Стоимость',
    `amount` decimal(19,2) unsigned NOT NULL COMMENT 'Кол-во',
    `is_available` TINYINT(1) DEFAULT 1 NOT NULL COMMENT 'Доступ (доступный, удаленный)',
    `unit_id` int unsigned NOT NULL COMMENT 'ID ед. измерения',
    `version` INTEGER DEFAULT 0 NOT NULL,
    `version_created_at` TIMESTAMP NULL,
    `version_created_by` VARCHAR(100),
    `version_comment` VARCHAR(255),
    `work_material_ids` TEXT,
    `work_material_versions` TEXT,
    `work_technic_ids` TEXT,
    `work_technic_versions` TEXT,
    PRIMARY KEY (`id`,`version`),
    CONSTRAINT `work_version_fk_40cf0f`
        FOREIGN KEY (`id`)
        REFERENCES `work` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
