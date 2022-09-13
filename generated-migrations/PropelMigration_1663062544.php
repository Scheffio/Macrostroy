<?php
use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1663062544.
 * Generated on 2022-09-13 12:49:04 by valeria 
 */
class PropelMigration_1663062544 
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

ALTER TABLE `obj_subproject_version`

  CHANGE `version_created_by` `version_created_by` int unsigned NOT NULL;

ALTER TABLE `project_role`

  CHANGE `is_crud` `is_crud` tinyint unsigned DEFAULT false NOT NULL COMMENT 'Доступен ли CRUD объекта';

DROP INDEX `static_file_slug` ON `static_file`;

CREATE UNIQUE INDEX `static_file_slug` ON `static_file` (`url`(255));

ALTER TABLE `vol_material`

  CHANGE `version_created_by` `version_created_by` int unsigned NOT NULL;

CREATE INDEX `vol_material_ibfi_3` ON `vol_material` (`version_created_by`);

ALTER TABLE `vol_material` ADD CONSTRAINT `vol_material_ibfk_3`
    FOREIGN KEY (`version_created_by`)
    REFERENCES `users` (`id`);

ALTER TABLE `vol_material_version`

  CHANGE `version_created_by` `version_created_by` int unsigned NOT NULL;

ALTER TABLE `vol_technic`

  CHANGE `version_created_by` `version_created_by` int unsigned NOT NULL;

CREATE INDEX `vol_technic_ibfi_3` ON `vol_technic` (`version_created_by`);

ALTER TABLE `vol_technic` ADD CONSTRAINT `vol_technic_ibfk_3`
    FOREIGN KEY (`version_created_by`)
    REFERENCES `users` (`id`);

ALTER TABLE `vol_technic_version`

  CHANGE `version_created_by` `version_created_by` int unsigned NOT NULL;

ALTER TABLE `vol_work`

  CHANGE `version_created_by` `version_created_by` int unsigned NOT NULL;

CREATE INDEX `vol_work_ibfi_3` ON `vol_work` (`version_created_by`);

ALTER TABLE `vol_work` ADD CONSTRAINT `vol_work_ibfk_3`
    FOREIGN KEY (`version_created_by`)
    REFERENCES `users` (`id`);

ALTER TABLE `vol_work_material`

  CHANGE `version_created_by` `version_created_by` int unsigned NOT NULL;

CREATE INDEX `vol_work_material_ibfi_3` ON `vol_work_material` (`version_created_by`);

ALTER TABLE `vol_work_material` ADD CONSTRAINT `vol_work_material_ibfk_3`
    FOREIGN KEY (`version_created_by`)
    REFERENCES `users` (`id`);

ALTER TABLE `vol_work_material_version`

  CHANGE `version_created_by` `version_created_by` int unsigned NOT NULL;

ALTER TABLE `vol_work_technic`

  CHANGE `version_created_by` `version_created_by` int unsigned NOT NULL;

CREATE INDEX `vol_work_technic_ibfi_3` ON `vol_work_technic` (`version_created_by`);

ALTER TABLE `vol_work_technic` ADD CONSTRAINT `vol_work_technic_ibfk_3`
    FOREIGN KEY (`version_created_by`)
    REFERENCES `users` (`id`);

ALTER TABLE `vol_work_technic_version`

  CHANGE `version_created_by` `version_created_by` int unsigned NOT NULL;

ALTER TABLE `vol_work_version`

  CHANGE `version_created_by` `version_created_by` int unsigned NOT NULL;

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

ALTER TABLE `obj_subproject_version`

  CHANGE `version_created_by` `version_created_by` VARCHAR(100);

ALTER TABLE `project_role`

  CHANGE `is_crud` `is_crud` tinyint unsigned DEFAULT 0 NOT NULL COMMENT 'Доступен ли CRUD объекта';

DROP INDEX `static_file_slug` ON `static_file`;

CREATE UNIQUE INDEX `static_file_slug` ON `static_file` (`url`);

ALTER TABLE `vol_material` DROP FOREIGN KEY `vol_material_ibfk_3`;

DROP INDEX `vol_material_ibfi_3` ON `vol_material`;

ALTER TABLE `vol_material`

  CHANGE `version_created_by` `version_created_by` VARCHAR(100);

ALTER TABLE `vol_material_version`

  CHANGE `version_created_by` `version_created_by` VARCHAR(100);

ALTER TABLE `vol_technic` DROP FOREIGN KEY `vol_technic_ibfk_3`;

DROP INDEX `vol_technic_ibfi_3` ON `vol_technic`;

ALTER TABLE `vol_technic`

  CHANGE `version_created_by` `version_created_by` VARCHAR(100);

ALTER TABLE `vol_technic_version`

  CHANGE `version_created_by` `version_created_by` VARCHAR(100);

ALTER TABLE `vol_work` DROP FOREIGN KEY `vol_work_ibfk_3`;

DROP INDEX `vol_work_ibfi_3` ON `vol_work`;

ALTER TABLE `vol_work`

  CHANGE `version_created_by` `version_created_by` VARCHAR(100);

ALTER TABLE `vol_work_material` DROP FOREIGN KEY `vol_work_material_ibfk_3`;

DROP INDEX `vol_work_material_ibfi_3` ON `vol_work_material`;

ALTER TABLE `vol_work_material`

  CHANGE `version_created_by` `version_created_by` VARCHAR(100);

ALTER TABLE `vol_work_material_version`

  CHANGE `version_created_by` `version_created_by` VARCHAR(100);

ALTER TABLE `vol_work_technic` DROP FOREIGN KEY `vol_work_technic_ibfk_3`;

DROP INDEX `vol_work_technic_ibfi_3` ON `vol_work_technic`;

ALTER TABLE `vol_work_technic`

  CHANGE `version_created_by` `version_created_by` VARCHAR(100);

ALTER TABLE `vol_work_technic_version`

  CHANGE `version_created_by` `version_created_by` VARCHAR(100);

ALTER TABLE `vol_work_version`

  CHANGE `version_created_by` `version_created_by` VARCHAR(100);

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
EOT;

        return array(
            'default' => $connection_default,
        );
    }

}