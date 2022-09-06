
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- static_file
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `static_file`;

CREATE TABLE `static_file`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `file_name` VARCHAR(255) NOT NULL,
    `content_type` VARCHAR(255) NOT NULL,
    `file` LONGBLOB NOT NULL,
    `headers` JSON,
    `url` VARCHAR(255),
    PRIMARY KEY (`id`),
    UNIQUE INDEX `static_file_slug` (`url`(255))
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- user_role
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `user_role`;

CREATE TABLE `user_role`
(
    `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID роли',
    `name` VARCHAR(255) NOT NULL COMMENT 'Наименование',
    `object_viewer` TINYINT(1) DEFAULT 0 NOT NULL COMMENT 'Просмотр объектов (все, конкретные)',
    `manage_objects` TINYINT(1) DEFAULT 0 NOT NULL COMMENT 'CRUD объектов (все, конкретные)',
    `manage_volumes` TINYINT(1) DEFAULT 0 NOT NULL COMMENT 'CRUD объёмов (все, никакие)',
    `manage_history` TINYINT(1) DEFAULT 0 NOT NULL COMMENT 'Управление историей',
    `manage_users` TINYINT(1) DEFAULT 0 NOT NULL COMMENT 'CRUD учетными записями',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- project_role2
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `project_role`;

CREATE TABLE `project_role`
(
    `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID роли проекта',
    `lvl` int unsigned DEFAULT 1 NOT NULL COMMENT 'Уровень доступа;( 1 - проекта; 2 - подпроект; 3 - группа; 4 - дом; 5 - этап )',
    `is_crud` tinyint unsigned DEFAULT false NOT NULL COMMENT 'Доступен ли CRUD объекта',
    `object_id` int unsigned NOT NULL COMMENT 'ID объекта (проект, подпроект, группа, дом, этап)',
    `user_id` int unsigned NOT NULL COMMENT 'ID пользователя',
    PRIMARY KEY (`id`),
    INDEX `user_id` (`user_id`),
    CONSTRAINT `project_role_ibfk_3`
        FOREIGN KEY (`user_id`)
            REFERENCES `users` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- obj_project
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `obj_project`;

CREATE TABLE `obj_project`
(
    `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID проекта',
    `name` VARCHAR(255) NOT NULL COMMENT 'Наименование',
    `status` set('in_process','completed','deleted') DEFAULT 'in_process' NOT NULL COMMENT 'Статус (в процессе, завершен, удален)',
    `is_public` TINYINT(1) DEFAULT 1 NOT NULL COMMENT 'Доступ (публичный, приватный)',
    `is_available` TINYINT(1) DEFAULT 1 NOT NULL COMMENT 'Доступ (доступный, удаленный)',
    `version` INTEGER DEFAULT 0,
    `version_created_at` TIMESTAMP NULL,
    `version_created_by` VARCHAR(100),
    `version_comment` VARCHAR(255),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- obj_subproject
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `obj_subproject`;

CREATE TABLE `obj_subproject`
(
    `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID подпроекта',
    `name` VARCHAR(255) NOT NULL COMMENT 'Наименование',
    `status` set('in_process','completed','deleted') DEFAULT 'in_process' NOT NULL COMMENT 'Статус (в процессе, завершен, удален)',
    `is_public` TINYINT(1) DEFAULT 1 NOT NULL COMMENT 'Доступ (публичный, приватный)',
    `is_available` TINYINT(1) DEFAULT 1 NOT NULL COMMENT 'Доступ (доступный, удаленный)',
    `project_id` int unsigned NOT NULL COMMENT 'ID проекта',
    `version` INTEGER DEFAULT 0,
    `version_created_at` TIMESTAMP NULL,
    `version_created_by` VARCHAR(100),
    `version_comment` VARCHAR(255),
    PRIMARY KEY (`id`),
    INDEX `project_id` (`project_id`),
    CONSTRAINT `subproject_ibfk_1`
        FOREIGN KEY (`project_id`)
            REFERENCES `obj_project` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- obj_group
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `obj_group`;

CREATE TABLE `obj_group`
(
    `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID группы',
    `name` VARCHAR(255) NOT NULL COMMENT 'Наименование',
    `status` set('in_process','completed','deleted') DEFAULT 'in_process' NOT NULL COMMENT 'Статус (в процессе, завершен, удален)',
    `is_public` TINYINT(1) DEFAULT 1 NOT NULL COMMENT 'Доступ (публичный, приватный)',
    `is_available` TINYINT(1) DEFAULT 1 NOT NULL COMMENT 'Доступ (доступный, удаленный)',
    `subproject_id` int unsigned NOT NULL COMMENT 'ID подпроекта',
    `version` INTEGER DEFAULT 0,
    `version_created_at` TIMESTAMP NULL,
    `version_created_by` VARCHAR(100),
    `version_comment` VARCHAR(255),
    PRIMARY KEY (`id`),
    INDEX `subproject_id` (`subproject_id`),
    CONSTRAINT `groups_ibfk_1`
        FOREIGN KEY (`subproject_id`)
            REFERENCES `obj_subproject` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- obj_house
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `obj_house`;

CREATE TABLE `obj_house`
(
    `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID дома',
    `name` VARCHAR(255) NOT NULL COMMENT 'Наименование',
    `status` set('in_process','completed','deleted') DEFAULT 'in_process' NOT NULL COMMENT 'Статус (в процессе, завершен, удален)',
    `is_public` TINYINT(1) DEFAULT 1 NOT NULL COMMENT 'Доступ (публичный, приватный)',
    `is_available` TINYINT(1) DEFAULT 1 NOT NULL COMMENT 'Доступ (доступный, удаленный)',
    `group_id` int unsigned NOT NULL COMMENT 'Id группы',
    `version` INTEGER DEFAULT 0,
    `version_created_at` TIMESTAMP NULL,
    `version_created_by` VARCHAR(100),
    `version_comment` VARCHAR(255),
    PRIMARY KEY (`id`),
    INDEX `group_id` (`group_id`),
    CONSTRAINT `house_ibfk_1`
        FOREIGN KEY (`group_id`)
            REFERENCES `obj_group` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- obj_stage
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `obj_stage`;

CREATE TABLE `obj_stage`
(
    `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID этапа',
    `name` VARCHAR(255) NOT NULL COMMENT 'Наименование',
    `status` set('in_process','completed','deleted') DEFAULT 'in_process' NOT NULL COMMENT 'Статус (в процессе, завершен, удален)',
    `is_public` TINYINT(1) DEFAULT 1 NOT NULL COMMENT 'Доступ (публичный, приватный)',
    `is_available` TINYINT(1) DEFAULT 1 NOT NULL COMMENT 'Доступ (доступный, удаленный)',
    `house_id` int unsigned NOT NULL COMMENT 'ID дома',
    `version` INTEGER DEFAULT 0,
    `version_created_at` TIMESTAMP NULL,
    `version_created_by` VARCHAR(100),
    `version_comment` VARCHAR(255),
    PRIMARY KEY (`id`),
    INDEX `house_id` (`house_id`),
    CONSTRAINT `stage_ibfk_1`
        FOREIGN KEY (`house_id`)
            REFERENCES `obj_house` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- obj_stage_work
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `obj_stage_work`;

CREATE TABLE `obj_stage_work`
(
    `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID работы этапа',
    `price` decimal(19,2) unsigned NOT NULL COMMENT 'Стоимость',
    `amount` decimal(19,2) unsigned NOT NULL COMMENT 'Кол-во',
    `is_available` TINYINT(1) DEFAULT 1 NOT NULL COMMENT 'Доступ (доступный, удаленный)',
    `work_id` int unsigned NOT NULL COMMENT 'ID работы',
    `stage_id` int unsigned NOT NULL COMMENT 'ID этапа',
    `version` INTEGER DEFAULT 0,
    `version_created_at` TIMESTAMP NULL,
    `version_created_by` VARCHAR(100),
    `version_comment` VARCHAR(255),
    PRIMARY KEY (`id`),
    INDEX `stage_work_ibfi_5` (`work_id`),
    INDEX `stage_work_ibfi_6` (`stage_id`),
    CONSTRAINT `stage_work_ibfk_5`
        FOREIGN KEY (`work_id`)
            REFERENCES `vol_work` (`id`),
    CONSTRAINT `stage_work_ibfk_6`
        FOREIGN KEY (`stage_id`)
            REFERENCES `obj_stage` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- obj_stage_material
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `obj_stage_material`;

CREATE TABLE `obj_stage_material`
(
    `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID материала работы на этапе',
    `price` decimal(19,2) unsigned NOT NULL COMMENT 'Стоимость',
    `amount` decimal(19,2) unsigned NOT NULL COMMENT 'Кол-во',
    `is_available` TINYINT(1) DEFAULT 1 NOT NULL COMMENT 'Доступ (доступный, удаленный)',
    `material_id` int unsigned NOT NULL COMMENT 'ID материала',
    `stage_work_id` int unsigned NOT NULL COMMENT 'ID работы этапа',
    `version` INTEGER DEFAULT 0,
    `version_created_at` TIMESTAMP NULL,
    `version_created_by` VARCHAR(100),
    `version_comment` VARCHAR(255),
    PRIMARY KEY (`id`),
    INDEX `material_id` (`material_id`),
    INDEX `stage_work_id` (`stage_work_id`),
    CONSTRAINT `stage_material_ibfk_1`
        FOREIGN KEY (`material_id`)
            REFERENCES `vol_material` (`id`),
    CONSTRAINT `stage_material_ibfk_2`
        FOREIGN KEY (`stage_work_id`)
            REFERENCES `obj_stage_work` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- obj_stage_technic
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `obj_stage_technic`;

CREATE TABLE `obj_stage_technic`
(
    `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID техники работы',
    `price` decimal(19,2) unsigned NOT NULL COMMENT 'Стоимость',
    `amount` decimal(19,2) unsigned NOT NULL COMMENT 'Кол-во',
    `is_available` TINYINT(1) DEFAULT 1 NOT NULL COMMENT 'Доступ (доступный, удаленный)',
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
            REFERENCES `obj_stage_work` (`id`),
    CONSTRAINT `stage_technic_ibfk_2`
        FOREIGN KEY (`technic_id`)
            REFERENCES `vol_technic` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- vol_material
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `vol_material`;

CREATE TABLE `vol_material`
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
            REFERENCES `vol_unit` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- vol_technic
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `vol_technic`;

CREATE TABLE `vol_technic`
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
    PRIMARY KEY (`id`),
    INDEX `unit_id` (`unit_id`),
    CONSTRAINT `technic_ibfk_1`
        FOREIGN KEY (`unit_id`)
            REFERENCES `vol_unit` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- vol_work
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `vol_work`;

CREATE TABLE `vol_work`
(
    `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID работы',
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
    CONSTRAINT `work_ibfk_1`
        FOREIGN KEY (`unit_id`)
            REFERENCES `vol_unit` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- vol_work_material
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `vol_work_material`;

CREATE TABLE `vol_work_material`
(
    `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID материала работы',
    `amount` decimal(19,2) unsigned NOT NULL COMMENT 'Кол-во',
    `work_id` int unsigned NOT NULL COMMENT 'ID работы',
    `material_id` int unsigned NOT NULL COMMENT 'ID материала',
    PRIMARY KEY (`id`),
    INDEX `work_id` (`work_id`),
    INDEX `material_id` (`material_id`),
    CONSTRAINT `work_material_ibfk_1`
        FOREIGN KEY (`work_id`)
            REFERENCES `vol_work` (`id`),
    CONSTRAINT `work_material_ibfk_2`
        FOREIGN KEY (`material_id`)
            REFERENCES `vol_material` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- vol_work_technic
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `vol_work_technic`;

CREATE TABLE `vol_work_technic`
(
    `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID техники работы',
    `amount` decimal(19,2) unsigned NOT NULL COMMENT 'Кол-во',
    `work_id` int unsigned NOT NULL COMMENT 'ID работы',
    `technic_id` int unsigned NOT NULL COMMENT 'ID техники',
    PRIMARY KEY (`id`),
    INDEX `work_id` (`work_id`),
    INDEX `technic_id` (`technic_id`),
    CONSTRAINT `work_technic_ibfk_1`
        FOREIGN KEY (`work_id`)
            REFERENCES `vol_work` (`id`),
    CONSTRAINT `work_technic_ibfk_2`
        FOREIGN KEY (`technic_id`)
            REFERENCES `vol_technic` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- vol_unit
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `vol_unit`;

CREATE TABLE `vol_unit`
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
    `is_available` TINYINT(1) DEFAULT 1 NOT NULL COMMENT 'Доступ (доступный, удаленный)',
    PRIMARY KEY (`id`),
    UNIQUE INDEX `email` (`email`),
    INDEX `role_id` (`role_id`),
    CONSTRAINT `users_ibfk_1`
        FOREIGN KEY (`role_id`)
            REFERENCES `user_role` (`id`)
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
-- obj_project_version
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `obj_project_version`;

CREATE TABLE `obj_project_version`
(
    `id` int unsigned NOT NULL COMMENT 'ID проекта',
    `name` VARCHAR(255) NOT NULL COMMENT 'Наименование',
    `status` set('in_process','completed','deleted') DEFAULT 'in_process' NOT NULL COMMENT 'Статус (в процессе, завершен, удален)',
    `is_public` TINYINT(1) DEFAULT 1 NOT NULL COMMENT 'Доступ (публичный, приватный)',
    `is_available` TINYINT(1) DEFAULT 1 NOT NULL COMMENT 'Доступ (доступный, удаленный)',
    `version` INTEGER DEFAULT 0 NOT NULL,
    `version_created_at` TIMESTAMP NULL,
    `version_created_by` VARCHAR(100),
    `version_comment` VARCHAR(255),
    `obj_subproject_ids` TEXT,
    `obj_subproject_versions` TEXT,
    PRIMARY KEY (`id`,`version`),
    CONSTRAINT `obj_project_version_fk_09ccc9`
        FOREIGN KEY (`id`)
            REFERENCES `obj_project` (`id`)
            ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- obj_subproject_version
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `obj_subproject_version`;

CREATE TABLE `obj_subproject_version`
(
    `id` int unsigned NOT NULL COMMENT 'ID подпроекта',
    `name` VARCHAR(255) NOT NULL COMMENT 'Наименование',
    `status` set('in_process','completed','deleted') DEFAULT 'in_process' NOT NULL COMMENT 'Статус (в процессе, завершен, удален)',
    `is_public` TINYINT(1) DEFAULT 1 NOT NULL COMMENT 'Доступ (публичный, приватный)',
    `is_available` TINYINT(1) DEFAULT 1 NOT NULL COMMENT 'Доступ (доступный, удаленный)',
    `project_id` int unsigned NOT NULL COMMENT 'ID проекта',
    `version` INTEGER DEFAULT 0 NOT NULL,
    `version_created_at` TIMESTAMP NULL,
    `version_created_by` VARCHAR(100),
    `version_comment` VARCHAR(255),
    `project_id_version` INTEGER DEFAULT 0,
    `obj_group_ids` TEXT,
    `obj_group_versions` TEXT,
    PRIMARY KEY (`id`,`version`),
    CONSTRAINT `obj_subproject_version_fk_7c9664`
        FOREIGN KEY (`id`)
            REFERENCES `obj_subproject` (`id`)
            ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- obj_group_version
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `obj_group_version`;

CREATE TABLE `obj_group_version`
(
    `id` int unsigned NOT NULL COMMENT 'ID группы',
    `name` VARCHAR(255) NOT NULL COMMENT 'Наименование',
    `status` set('in_process','completed','deleted') DEFAULT 'in_process' NOT NULL COMMENT 'Статус (в процессе, завершен, удален)',
    `is_public` TINYINT(1) DEFAULT 1 NOT NULL COMMENT 'Доступ (публичный, приватный)',
    `is_available` TINYINT(1) DEFAULT 1 NOT NULL COMMENT 'Доступ (доступный, удаленный)',
    `subproject_id` int unsigned NOT NULL COMMENT 'ID подпроекта',
    `version` INTEGER DEFAULT 0 NOT NULL,
    `version_created_at` TIMESTAMP NULL,
    `version_created_by` VARCHAR(100),
    `version_comment` VARCHAR(255),
    `subproject_id_version` INTEGER DEFAULT 0,
    `obj_house_ids` TEXT,
    `obj_house_versions` TEXT,
    PRIMARY KEY (`id`,`version`),
    CONSTRAINT `obj_group_version_fk_663c1c`
        FOREIGN KEY (`id`)
            REFERENCES `obj_group` (`id`)
            ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- obj_house_version
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `obj_house_version`;

CREATE TABLE `obj_house_version`
(
    `id` int unsigned NOT NULL COMMENT 'ID дома',
    `name` VARCHAR(255) NOT NULL COMMENT 'Наименование',
    `status` set('in_process','completed','deleted') DEFAULT 'in_process' NOT NULL COMMENT 'Статус (в процессе, завершен, удален)',
    `is_public` TINYINT(1) DEFAULT 1 NOT NULL COMMENT 'Доступ (публичный, приватный)',
    `is_available` TINYINT(1) DEFAULT 1 NOT NULL COMMENT 'Доступ (доступный, удаленный)',
    `group_id` int unsigned NOT NULL COMMENT 'Id группы',
    `version` INTEGER DEFAULT 0 NOT NULL,
    `version_created_at` TIMESTAMP NULL,
    `version_created_by` VARCHAR(100),
    `version_comment` VARCHAR(255),
    `group_id_version` INTEGER DEFAULT 0,
    `obj_stage_ids` TEXT,
    `obj_stage_versions` TEXT,
    PRIMARY KEY (`id`,`version`),
    CONSTRAINT `obj_house_version_fk_21140d`
        FOREIGN KEY (`id`)
            REFERENCES `obj_house` (`id`)
            ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- obj_stage_version
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `obj_stage_version`;

CREATE TABLE `obj_stage_version`
(
    `id` int unsigned NOT NULL COMMENT 'ID этапа',
    `name` VARCHAR(255) NOT NULL COMMENT 'Наименование',
    `status` set('in_process','completed','deleted') DEFAULT 'in_process' NOT NULL COMMENT 'Статус (в процессе, завершен, удален)',
    `is_public` TINYINT(1) DEFAULT 1 NOT NULL COMMENT 'Доступ (публичный, приватный)',
    `is_available` TINYINT(1) DEFAULT 1 NOT NULL COMMENT 'Доступ (доступный, удаленный)',
    `house_id` int unsigned NOT NULL COMMENT 'ID дома',
    `version` INTEGER DEFAULT 0 NOT NULL,
    `version_created_at` TIMESTAMP NULL,
    `version_created_by` VARCHAR(100),
    `version_comment` VARCHAR(255),
    `house_id_version` INTEGER DEFAULT 0,
    `obj_stage_work_ids` TEXT,
    `obj_stage_work_versions` TEXT,
    PRIMARY KEY (`id`,`version`),
    CONSTRAINT `obj_stage_version_fk_7cef42`
        FOREIGN KEY (`id`)
            REFERENCES `obj_stage` (`id`)
            ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- obj_stage_work_version
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `obj_stage_work_version`;

CREATE TABLE `obj_stage_work_version`
(
    `id` int unsigned NOT NULL COMMENT 'ID работы этапа',
    `price` decimal(19,2) unsigned NOT NULL COMMENT 'Стоимость',
    `amount` decimal(19,2) unsigned NOT NULL COMMENT 'Кол-во',
    `is_available` TINYINT(1) DEFAULT 1 NOT NULL COMMENT 'Доступ (доступный, удаленный)',
    `work_id` int unsigned NOT NULL COMMENT 'ID работы',
    `stage_id` int unsigned NOT NULL COMMENT 'ID этапа',
    `version` INTEGER DEFAULT 0 NOT NULL,
    `version_created_at` TIMESTAMP NULL,
    `version_created_by` VARCHAR(100),
    `version_comment` VARCHAR(255),
    `work_id_version` INTEGER DEFAULT 0,
    `stage_id_version` INTEGER DEFAULT 0,
    `obj_stage_material_ids` TEXT,
    `obj_stage_material_versions` TEXT,
    `obj_stage_technic_ids` TEXT,
    `obj_stage_technic_versions` TEXT,
    PRIMARY KEY (`id`,`version`),
    CONSTRAINT `obj_stage_work_version_fk_614452`
        FOREIGN KEY (`id`)
            REFERENCES `obj_stage_work` (`id`)
            ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- obj_stage_material_version
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `obj_stage_material_version`;

CREATE TABLE `obj_stage_material_version`
(
    `id` int unsigned NOT NULL COMMENT 'ID материала работы на этапе',
    `price` decimal(19,2) unsigned NOT NULL COMMENT 'Стоимость',
    `amount` decimal(19,2) unsigned NOT NULL COMMENT 'Кол-во',
    `is_available` TINYINT(1) DEFAULT 1 NOT NULL COMMENT 'Доступ (доступный, удаленный)',
    `material_id` int unsigned NOT NULL COMMENT 'ID материала',
    `stage_work_id` int unsigned NOT NULL COMMENT 'ID работы этапа',
    `version` INTEGER DEFAULT 0 NOT NULL,
    `version_created_at` TIMESTAMP NULL,
    `version_created_by` VARCHAR(100),
    `version_comment` VARCHAR(255),
    `material_id_version` INTEGER DEFAULT 0,
    `stage_work_id_version` INTEGER DEFAULT 0,
    PRIMARY KEY (`id`,`version`),
    CONSTRAINT `obj_stage_material_version_fk_68f469`
        FOREIGN KEY (`id`)
            REFERENCES `obj_stage_material` (`id`)
            ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- obj_stage_technic_version
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `obj_stage_technic_version`;

CREATE TABLE `obj_stage_technic_version`
(
    `id` int unsigned NOT NULL COMMENT 'ID техники работы',
    `price` decimal(19,2) unsigned NOT NULL COMMENT 'Стоимость',
    `amount` decimal(19,2) unsigned NOT NULL COMMENT 'Кол-во',
    `is_available` TINYINT(1) DEFAULT 1 NOT NULL COMMENT 'Доступ (доступный, удаленный)',
    `technic_id` int unsigned NOT NULL COMMENT 'ID техники',
    `stage_work_id` int unsigned NOT NULL COMMENT 'ID работы этапа',
    `version` INTEGER DEFAULT 0 NOT NULL,
    `version_created_at` TIMESTAMP NULL,
    `version_created_by` VARCHAR(100),
    `version_comment` VARCHAR(255),
    `stage_work_id_version` INTEGER DEFAULT 0,
    `technic_id_version` INTEGER DEFAULT 0,
    PRIMARY KEY (`id`,`version`),
    CONSTRAINT `obj_stage_technic_version_fk_63bbbc`
        FOREIGN KEY (`id`)
            REFERENCES `obj_stage_technic` (`id`)
            ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- vol_material_version
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `vol_material_version`;

CREATE TABLE `vol_material_version`
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
    `obj_stage_material_ids` TEXT,
    `obj_stage_material_versions` TEXT,
    PRIMARY KEY (`id`,`version`),
    CONSTRAINT `vol_material_version_fk_d64a59`
        FOREIGN KEY (`id`)
            REFERENCES `vol_material` (`id`)
            ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- vol_technic_version
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `vol_technic_version`;

CREATE TABLE `vol_technic_version`
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
    `obj_stage_technic_ids` TEXT,
    `obj_stage_technic_versions` TEXT,
    PRIMARY KEY (`id`,`version`),
    CONSTRAINT `vol_technic_version_fk_e379d9`
        FOREIGN KEY (`id`)
            REFERENCES `vol_technic` (`id`)
            ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- vol_work_version
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `vol_work_version`;

CREATE TABLE `vol_work_version`
(
    `id` int unsigned NOT NULL COMMENT 'ID работы',
    `name` VARCHAR(255) NOT NULL COMMENT 'Наименование',
    `price` decimal(19,2) unsigned NOT NULL COMMENT 'Стоимость',
    `is_available` TINYINT(1) DEFAULT 1 NOT NULL COMMENT 'Доступ (доступный, удаленный)',
    `unit_id` int unsigned NOT NULL COMMENT 'ID ед. измерения',
    `version` INTEGER DEFAULT 0 NOT NULL,
    `version_created_at` TIMESTAMP NULL,
    `version_created_by` VARCHAR(100),
    `version_comment` VARCHAR(255),
    `obj_stage_work_ids` TEXT,
    `obj_stage_work_versions` TEXT,
    PRIMARY KEY (`id`,`version`),
    CONSTRAINT `vol_work_version_fk_b92c65`
        FOREIGN KEY (`id`)
            REFERENCES `vol_work` (`id`)
            ON DELETE CASCADE
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
