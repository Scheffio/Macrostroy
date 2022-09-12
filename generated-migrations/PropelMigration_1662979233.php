<?php
use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1662979233.
 * Generated on 2022-09-12 13:40:33 by root 
 */
class PropelMigration_1662979233 
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

ALTER TABLE `vol_work_material`

  ADD `is_available` TINYINT(1) DEFAULT 1 NOT NULL COMMENT 'Доступ (доступный, удаленный)' AFTER `amount`;

ALTER TABLE `vol_work_material_version`

  ADD `is_available` TINYINT(1) DEFAULT 1 NOT NULL COMMENT 'Доступ (доступный, удаленный)' AFTER `amount`;

ALTER TABLE `vol_work_technic`

  ADD `is_available` TINYINT(1) DEFAULT 1 NOT NULL COMMENT 'Доступ (доступный, удаленный)' AFTER `amount`;

ALTER TABLE `vol_work_technic_version`

  ADD `is_available` TINYINT(1) DEFAULT 1 NOT NULL COMMENT 'Доступ (доступный, удаленный)' AFTER `amount`;

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

ALTER TABLE `project_role`

  CHANGE `is_crud` `is_crud` tinyint unsigned DEFAULT 0 NOT NULL COMMENT 'Доступен ли CRUD объекта';

DROP INDEX `static_file_slug` ON `static_file`;

CREATE UNIQUE INDEX `static_file_slug` ON `static_file` (`url`);

ALTER TABLE `vol_work_material`

  DROP `is_available`;

ALTER TABLE `vol_work_material_version`

  DROP `is_available`;

ALTER TABLE `vol_work_technic`

  DROP `is_available`;

ALTER TABLE `vol_work_technic_version`

  DROP `is_available`;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
EOT;

        return array(
            'default' => $connection_default,
        );
    }

}