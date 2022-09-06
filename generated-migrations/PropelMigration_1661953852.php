<?php
use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1661953852.
 * Generated on 2022-08-31 16:50:52 by valeria 
 */
class PropelMigration_1661953852 
{
    public $comment = '';

    public function preUp(MigrationManager $manager)
    {
        // add the pre-migration code here
    }

    public function postUp(MigrationManager $manager)
    {
        // add the post-migration code here
    }

    public function preDown(MigrationManager $manager)
    {
        // add the pre-migration code here
    }

    public function postDown(MigrationManager $manager)
    {
        // add the post-migration code here
    }

    /**
     * Get the SQL statements for the Up migration
     *
     * @return array list of the SQL strings to execute for the Up migration
     *               the keys being the datasources
     */
    public function getUpSQL()
    {
        $connection_default = <<< 'EOT'

# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

DROP INDEX `static_file_slug` ON `static_file`;

CREATE UNIQUE INDEX `static_file_slug` ON `static_file` (`url`(255));

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

CREATE TABLE `project_role2`
(
    `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID роли проекта',
    `lvl` int unsigned DEFAULT 1 NOT NULL COMMENT 'Уровень доступа;( 1 - проекта; 2 - подпроект; 3 - группа; 4 - дом; 5 - этап )',
    `is_crud` tinyint unsigned DEFAULT false NOT NULL COMMENT 'Доступен ли CRUD объекта',
    `object_id` int unsigned NOT NULL COMMENT 'ID объекта (проект, подпроект, группа, дом, этап)',
    `user_id` int unsigned NOT NULL COMMENT 'ID пользователя',
    `project_id` int unsigned NOT NULL COMMENT 'ID проекта',
    PRIMARY KEY (`id`),
    INDEX `user_id` (`user_id`),
    INDEX `project_id` (`project_id`),
    CONSTRAINT `project_role_ibfk_3`
        FOREIGN KEY (`user_id`)
        REFERENCES `users` (`id`),
    CONSTRAINT `project_role_ibfk_23`
        FOREIGN KEY (`project_id`)
        REFERENCES `obj_project` (`id`)
) ENGINE=InnoDB;

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

CREATE TABLE `users_throttling`
(
    `bucket` VARCHAR(44) NOT NULL,
    `tokens` float unsigned NOT NULL,
    `replenished_at` int unsigned NOT NULL,
    `expires_at` int unsigned NOT NULL,
    PRIMARY KEY (`bucket`),
    INDEX `expires_at` (`expires_at`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
EOT;

        return array(
            'default' => $connection_default,
        );
    }

    /**
     * Get the SQL statements for the Down migration
     *
     * @return array list of the SQL strings to execute for the Down migration
     *               the keys being the datasources
     */
    public function getDownSQL()
    {
        $connection_default = <<< 'EOT'

# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `user_role`;

DROP TABLE IF EXISTS `project_role2`;

DROP TABLE IF EXISTS `users`;

DROP TABLE IF EXISTS `users_confirmations`;

DROP TABLE IF EXISTS `users_remembered`;

DROP TABLE IF EXISTS `users_resets`;

DROP TABLE IF EXISTS `users_throttling`;

DROP INDEX `static_file_slug` ON `static_file`;

CREATE UNIQUE INDEX `static_file_slug` ON `static_file` (`url`);

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
EOT;

        return array(
            'default' => $connection_default,
        );
    }

}