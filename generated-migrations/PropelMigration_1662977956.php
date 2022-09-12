<?php
use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1662977956.
 * Generated on 2022-09-12 13:19:16 by root 
 */
class PropelMigration_1662977956 
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

ALTER TABLE `project_role`

  CHANGE `is_crud` `is_crud` tinyint unsigned DEFAULT false NOT NULL COMMENT 'Доступен ли CRUD объекта';

DROP INDEX `static_file_slug` ON `static_file`;

CREATE UNIQUE INDEX `static_file_slug` ON `static_file` (`url`(255));

ALTER TABLE `vol_material_version`

  ADD `vol_work_material_ids` TEXT AFTER `obj_stage_material_versions`,

  ADD `vol_work_material_versions` TEXT AFTER `vol_work_material_ids`;

ALTER TABLE `vol_technic_version`

  ADD `vol_work_technic_ids` TEXT AFTER `obj_stage_technic_versions`,

  ADD `vol_work_technic_versions` TEXT AFTER `vol_work_technic_ids`;

ALTER TABLE `vol_work_material`

  ADD `version` INTEGER DEFAULT 0 AFTER `material_id`,

  ADD `version_created_at` TIMESTAMP NULL AFTER `version`,

  ADD `version_created_by` VARCHAR(100) AFTER `version_created_at`,

  ADD `version_comment` VARCHAR(255) AFTER `version_created_by`;

ALTER TABLE `vol_work_technic`

  ADD `version` INTEGER DEFAULT 0 AFTER `technic_id`,

  ADD `version_created_at` TIMESTAMP NULL AFTER `version`,

  ADD `version_created_by` VARCHAR(100) AFTER `version_created_at`,

  ADD `version_comment` VARCHAR(255) AFTER `version_created_by`;

ALTER TABLE `vol_work_version`

  ADD `vol_work_material_ids` TEXT AFTER `obj_stage_work_versions`,

  ADD `vol_work_material_versions` TEXT AFTER `vol_work_material_ids`,

  ADD `vol_work_technic_ids` TEXT AFTER `vol_work_material_versions`,

  ADD `vol_work_technic_versions` TEXT AFTER `vol_work_technic_ids`;

CREATE TABLE `vol_work_material_version`
(
    `id` int unsigned NOT NULL COMMENT 'ID материала работы',
    `amount` decimal(19,2) unsigned NOT NULL COMMENT 'Кол-во',
    `work_id` int unsigned NOT NULL COMMENT 'ID работы',
    `material_id` int unsigned NOT NULL COMMENT 'ID материала',
    `version` INTEGER DEFAULT 0 NOT NULL,
    `version_created_at` TIMESTAMP NULL,
    `version_created_by` VARCHAR(100),
    `version_comment` VARCHAR(255),
    `work_id_version` INTEGER DEFAULT 0,
    `material_id_version` INTEGER DEFAULT 0,
    PRIMARY KEY (`id`,`version`),
    CONSTRAINT `vol_work_material_version_fk_c76e40`
        FOREIGN KEY (`id`)
        REFERENCES `vol_work_material` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE `vol_work_technic_version`
(
    `id` int unsigned NOT NULL COMMENT 'ID техники работы',
    `amount` decimal(19,2) unsigned NOT NULL COMMENT 'Кол-во',
    `work_id` int unsigned NOT NULL COMMENT 'ID работы',
    `technic_id` int unsigned NOT NULL COMMENT 'ID техники',
    `version` INTEGER DEFAULT 0 NOT NULL,
    `version_created_at` TIMESTAMP NULL,
    `version_created_by` VARCHAR(100),
    `version_comment` VARCHAR(255),
    `work_id_version` INTEGER DEFAULT 0,
    `technic_id_version` INTEGER DEFAULT 0,
    PRIMARY KEY (`id`,`version`),
    CONSTRAINT `vol_work_technic_version_fk_3ecfb8`
        FOREIGN KEY (`id`)
        REFERENCES `vol_work_technic` (`id`)
        ON DELETE CASCADE
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

DROP TABLE IF EXISTS `vol_work_material_version`;

DROP TABLE IF EXISTS `vol_work_technic_version`;

ALTER TABLE `project_role`

  CHANGE `is_crud` `is_crud` tinyint unsigned DEFAULT 0 NOT NULL COMMENT 'Доступен ли CRUD объекта';

DROP INDEX `static_file_slug` ON `static_file`;

CREATE UNIQUE INDEX `static_file_slug` ON `static_file` (`url`);

ALTER TABLE `vol_material_version`

  DROP `vol_work_material_ids`,

  DROP `vol_work_material_versions`;

ALTER TABLE `vol_technic_version`

  DROP `vol_work_technic_ids`,

  DROP `vol_work_technic_versions`;

ALTER TABLE `vol_work_material`

  DROP `version`,

  DROP `version_created_at`,

  DROP `version_created_by`,

  DROP `version_comment`;

ALTER TABLE `vol_work_technic`

  DROP `version`,

  DROP `version_created_at`,

  DROP `version_created_by`,

  DROP `version_comment`;

ALTER TABLE `vol_work_version`

  DROP `vol_work_material_ids`,

  DROP `vol_work_material_versions`,

  DROP `vol_work_technic_ids`,

  DROP `vol_work_technic_versions`;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
EOT;

        return array(
            'default' => $connection_default,
        );
    }

}