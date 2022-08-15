
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- groups
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `groups`;

CREATE TABLE `groups`
(
    `id` int unsigned NOT NULL COMMENT 'ID группы',
    `name` VARCHAR(255) NOT NULL COMMENT 'Наименование',
    `status` set('in_process','completed','deleted') DEFAULT 'in_process' NOT NULL COMMENT 'Статус (в процессе, завершен, удален)	',
    `is_available` TINYINT(1) DEFAULT 1 NOT NULL COMMENT 'Доступ (открытый, приватный)',
    `subproject_id` int unsigned NOT NULL COMMENT 'ID подпроекта',
    PRIMARY KEY (`id`),
    INDEX `subproject_id` (`subproject_id`),
    CONSTRAINT `groups_ibfk_2`
        FOREIGN KEY (`subproject_id`)
        REFERENCES `subproject` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- house
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `house`;

CREATE TABLE `house`
(
    `id` int unsigned NOT NULL COMMENT 'ID дома',
    `name` VARCHAR(255) NOT NULL COMMENT 'Наименование',
    `status` set('in_process','completed','deleted') DEFAULT 'in_process' NOT NULL COMMENT '	Статус (в процессе, завершен, удален)	',
    `is_available` TINYINT(1) DEFAULT 1 NOT NULL COMMENT 'Доступ (открытый, приватный)',
    `group_id` int unsigned NOT NULL COMMENT 'ID группы',
    PRIMARY KEY (`id`),
    INDEX `group_id` (`group_id`),
    CONSTRAINT `house_ibfk_2`
        FOREIGN KEY (`group_id`)
        REFERENCES `groups` (`id`)
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
    `price` DECIMAL(19,2) NOT NULL COMMENT 'Стоимость',
    `is_available` TINYINT(1) DEFAULT 1 NOT NULL COMMENT 'Доступ (доступный, удаленный)',
    `unit_id` int unsigned NOT NULL COMMENT 'ID ед.измерения',
    PRIMARY KEY (`id`),
    INDEX `unit_id` (`unit_id`),
    CONSTRAINT `material_ibfk_1`
        FOREIGN KEY (`unit_id`)
        REFERENCES `unit` (`id`)
        ON UPDATE RESTRICT
        ON DELETE RESTRICT
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- project
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `project`;

CREATE TABLE `project`
(
    `id` int unsigned NOT NULL COMMENT 'ID проекта',
    `name` VARCHAR(255) NOT NULL COMMENT 'Наименование',
    `status` set('in_process','completed','deleted') DEFAULT 'in_process' NOT NULL COMMENT 'Статус (в процессе, завершен, удален)',
    `is_available` TINYINT(1) DEFAULT 1 NOT NULL COMMENT 'Доступ (открытый, приватный)',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- stage
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `stage`;

CREATE TABLE `stage`
(
    `id` int unsigned NOT NULL COMMENT 'ID этап',
    `name` VARCHAR(255) NOT NULL COMMENT 'Наименование',
    `status` set('in_process','completed','deleted') DEFAULT 'in_process' NOT NULL COMMENT 'Статус (в процессе, завершен, удален)',
    `is_available` TINYINT(1) DEFAULT 1 NOT NULL COMMENT '	Доступ (открытый, приватный)',
    `house_id` int unsigned COMMENT 'ID дома',
    PRIMARY KEY (`id`),
    INDEX `house_id` (`house_id`),
    CONSTRAINT `stage_ibfk_2`
        FOREIGN KEY (`house_id`)
        REFERENCES `house` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- stage_material
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `stage_material`;

CREATE TABLE `stage_material`
(
    `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID связи',
    `price` decimal(19,2) unsigned NOT NULL COMMENT 'Стоимость',
    `amount` decimal(19,2) unsigned NOT NULL COMMENT 'Кол-во',
    `material_id` int unsigned NOT NULL COMMENT 'ID материала',
    `stage_id` int unsigned NOT NULL COMMENT 'ID этапа',
    PRIMARY KEY (`id`),
    INDEX `material_id` (`material_id`),
    INDEX `stage_id` (`stage_id`),
    CONSTRAINT `stage_material_ibfk_1`
        FOREIGN KEY (`material_id`)
        REFERENCES `material` (`id`),
    CONSTRAINT `stage_material_ibfk_2`
        FOREIGN KEY (`stage_id`)
        REFERENCES `stage` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- stage_technic
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `stage_technic`;

CREATE TABLE `stage_technic`
(
    `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID связь',
    `price` DECIMAL(19,2) NOT NULL COMMENT 'Стоимость',
    `amount` DECIMAL(19,2) NOT NULL COMMENT 'Кол-во',
    `technic_id` int unsigned NOT NULL COMMENT 'ID техники',
    `stage_id` int unsigned NOT NULL COMMENT 'ID этапа',
    PRIMARY KEY (`id`),
    INDEX `stage_id` (`stage_id`),
    INDEX `technic_id` (`technic_id`),
    CONSTRAINT `stage_technic_ibfk_1`
        FOREIGN KEY (`stage_id`)
        REFERENCES `stage` (`id`),
    CONSTRAINT `stage_technic_ibfk_2`
        FOREIGN KEY (`technic_id`)
        REFERENCES `technic` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- stage_work
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `stage_work`;

CREATE TABLE `stage_work`
(
    `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID связь',
    `price` DECIMAL(19,2) NOT NULL COMMENT 'Стоимость',
    `amount` DECIMAL(19,2) NOT NULL COMMENT 'Кол-во',
    `work_id` int unsigned NOT NULL COMMENT 'ID работы',
    `stage_id` int unsigned NOT NULL COMMENT 'ID этапа',
    PRIMARY KEY (`id`),
    INDEX `work_id` (`work_id`),
    INDEX `stage_id` (`stage_id`),
    CONSTRAINT `stage_work_ibfk_1`
        FOREIGN KEY (`work_id`)
        REFERENCES `work` (`id`),
    CONSTRAINT `stage_work_ibfk_2`
        FOREIGN KEY (`stage_id`)
        REFERENCES `stage` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- subproject
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `subproject`;

CREATE TABLE `subproject`
(
    `id` int unsigned NOT NULL COMMENT 'ID подпроекта',
    `name` VARCHAR(255) NOT NULL COMMENT 'Наименование',
    `status` set('in_process','completed','deleted') DEFAULT 'in_process' NOT NULL COMMENT 'Статус (в процессе, завершен, удален)',
    `is_available` TINYINT(1) DEFAULT 1 NOT NULL COMMENT 'Доступ (открытый, приватный)',
    `project_id` int unsigned COMMENT 'ID проекта',
    PRIMARY KEY (`id`),
    INDEX `project_id` (`project_id`),
    CONSTRAINT `subproject_ibfk_2`
        FOREIGN KEY (`project_id`)
        REFERENCES `project` (`id`)
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
    `unit_id` int unsigned NOT NULL COMMENT 'ID ед.измерения',
    PRIMARY KEY (`id`),
    INDEX `unit_id` (`unit_id`),
    CONSTRAINT `technic_ibfk_1`
        FOREIGN KEY (`unit_id`)
        REFERENCES `unit` (`id`)
        ON UPDATE RESTRICT
        ON DELETE RESTRICT
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- unit
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `unit`;

CREATE TABLE `unit`
(
    `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID ед.измерения',
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
    `password` VARCHAR(255) NOT NULL,
    `username` VARCHAR(100),
    `status` tinyint unsigned DEFAULT 0 NOT NULL,
    `verified` tinyint unsigned DEFAULT 0 NOT NULL,
    `resettable` tinyint unsigned DEFAULT 1 NOT NULL,
    `roles_mask` int unsigned DEFAULT 0 NOT NULL,
    `registered` int unsigned NOT NULL,
    `last_login` int unsigned,
    `force_logout` mediumint unsigned DEFAULT 0 NOT NULL,
    `is_available` TINYINT(1) DEFAULT 1 NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `email` (`email`)
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
) ENGINE=MyISAM;

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
) ENGINE=MyISAM;

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
) ENGINE=MyISAM;

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
    `id` int unsigned NOT NULL,
    `name` VARCHAR(255) NOT NULL COMMENT 'Наименование',
    `price` DECIMAL(19,2) NOT NULL COMMENT 'Стоимость',
    `is_available` TINYINT(1) DEFAULT 1 NOT NULL COMMENT 'Доступ (доступный, удаленный)',
    `unit_id` int unsigned NOT NULL COMMENT 'ID ед.измерения',
    PRIMARY KEY (`id`),
    INDEX `unit_id` (`unit_id`),
    CONSTRAINT `work_ibfk_1`
        FOREIGN KEY (`unit_id`)
        REFERENCES `unit` (`id`)
        ON UPDATE RESTRICT
        ON DELETE RESTRICT
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- work_material
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `work_material`;

CREATE TABLE `work_material`
(
    `id` int unsigned NOT NULL COMMENT 'ID связи',
    `material_id` int unsigned NOT NULL COMMENT 'ID материала',
    `work_id` int unsigned NOT NULL COMMENT 'ID работы',
    `amount` decimal(19,2) unsigned NOT NULL COMMENT 'Кол-во',
    PRIMARY KEY (`id`),
    INDEX `material_id` (`material_id`),
    INDEX `work_id` (`work_id`),
    CONSTRAINT `work_material_ibfk_1`
        FOREIGN KEY (`material_id`)
        REFERENCES `material` (`id`),
    CONSTRAINT `work_material_ibfk_2`
        FOREIGN KEY (`work_id`)
        REFERENCES `work` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- work_technic
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `work_technic`;

CREATE TABLE `work_technic`
(
    `id` int unsigned NOT NULL COMMENT 'ID связи',
    `technic_id` int unsigned NOT NULL COMMENT 'ID техники',
    `work_id` int unsigned NOT NULL COMMENT 'ID работы',
    `amount` decimal(19,2) unsigned NOT NULL COMMENT 'Кол-во',
    PRIMARY KEY (`id`),
    INDEX `technic_id` (`technic_id`),
    INDEX `work_id` (`work_id`),
    CONSTRAINT `work_technic_ibfk_1`
        FOREIGN KEY (`technic_id`)
        REFERENCES `technic` (`id`),
    CONSTRAINT `work_technic_ibfk_2`
        FOREIGN KEY (`work_id`)
        REFERENCES `work` (`id`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
