<?php
use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1659954731.
 * Generated on 2022-08-08 13:32:11 by root 
 */
class PropelMigration_1659954731 
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

ALTER TABLE `groups`

  DROP `do_create`;

CREATE INDEX `users_ibfi_3` ON `groups` (`user_id`);

ALTER TABLE `groups` ADD CONSTRAINT `users_ibfk_3`
    FOREIGN KEY (`user_id`)
    REFERENCES `users` (`id`)
    ON UPDATE RESTRICT
    ON DELETE RESTRICT;

ALTER TABLE `groups_version`

  ADD `subproject_id_version` INTEGER DEFAULT 0 AFTER `version`,

  ADD `user_id_version` INTEGER DEFAULT 0 AFTER `subproject_id_version`,

  ADD `house_ids` TEXT AFTER `user_id_version`,

  ADD `house_versions` TEXT AFTER `house_ids`,

  DROP `do_create`;

ALTER TABLE `house`

  ADD `user_id` int unsigned NOT NULL AFTER `group_id`,

  ADD `version` INTEGER DEFAULT 0 AFTER `user_id`;

CREATE INDEX `users_ibfi_3` ON `house` (`user_id`);

ALTER TABLE `house` ADD CONSTRAINT `users_ibfk_3`
    FOREIGN KEY (`user_id`)
    REFERENCES `users` (`id`)
    ON UPDATE RESTRICT
    ON DELETE RESTRICT;

ALTER TABLE `house_version`

  ADD `user_id` int unsigned NOT NULL AFTER `group_id`,

  ADD `user_id_version` INTEGER DEFAULT 0 AFTER `group_id_version`,

  DROP `version_created_at`;

ALTER TABLE `material`

  ADD `version` INTEGER DEFAULT 0 AFTER `unit_id`;

ALTER TABLE `material_version`

  DROP `version_created_at`;

ALTER TABLE `project`

  ADD `version` INTEGER DEFAULT 0 AFTER `is_available`;

ALTER TABLE `project_version`

  DROP `version_created_at`;

ALTER TABLE `stage`

  ADD `version` INTEGER DEFAULT 0 AFTER `house_id`;

ALTER TABLE `stage_material`

  ADD `version` INTEGER DEFAULT 0 AFTER `stage_id`;

ALTER TABLE `stage_material_version`

  DROP `version_created_at`;

ALTER TABLE `stage_technic`

  ADD `version` INTEGER DEFAULT 0 AFTER `stage_id`;

ALTER TABLE `stage_technic_version`

  DROP `version_created_at`;

ALTER TABLE `stage_version`

  DROP `version_created_at`;

ALTER TABLE `stage_work`

  ADD `version` INTEGER DEFAULT 0 AFTER `stage_id`;

ALTER TABLE `stage_work_version`

  DROP `version_created_at`;

ALTER TABLE `subproject`

  ADD `version` INTEGER DEFAULT 0 AFTER `project_id`;

ALTER TABLE `subproject_version`

  DROP `version_created_at`;

ALTER TABLE `technic`

  ADD `version` INTEGER DEFAULT 0 AFTER `unit_id`;

ALTER TABLE `technic_version`

  DROP `version_created_at`;

ALTER TABLE `unit`

  ADD `version` INTEGER DEFAULT 0 AFTER `is_available`;

ALTER TABLE `unit_version`

  DROP `version_created_at`;

ALTER TABLE `users`

  ADD `version` INTEGER DEFAULT 0 AFTER `is_available`;

ALTER TABLE `users_confirmations`

  ADD `version` INTEGER DEFAULT 0 AFTER `expires`;

ALTER TABLE `users_confirmations_version`

  DROP `version_created_at`;

ALTER TABLE `users_remembered`

  ADD `version` INTEGER DEFAULT 0 AFTER `expires`;

ALTER TABLE `users_remembered_version`

  DROP `version_created_at`;

ALTER TABLE `users_resets`

  ADD `version` INTEGER DEFAULT 0 AFTER `expires`;

ALTER TABLE `users_resets_version`

  DROP `version_created_at`;

ALTER TABLE `users_throttling`

  ADD `version` INTEGER DEFAULT 0 AFTER `expires_at`;

ALTER TABLE `users_throttling_version`

  DROP `version_created_at`;

ALTER TABLE `users_version`

  ADD `groups_ids` TEXT AFTER `version`,

  ADD `groups_versions` TEXT AFTER `groups_ids`,

  ADD `house_ids` TEXT AFTER `groups_versions`,

  ADD `house_versions` TEXT AFTER `house_ids`,

  DROP `version_created_at`;

ALTER TABLE `work`

  ADD `version` INTEGER DEFAULT 0 AFTER `unit_id`;

ALTER TABLE `work_material`

  ADD `version` INTEGER DEFAULT 0 AFTER `amount`;

ALTER TABLE `work_material_version`

  DROP `version_created_at`;

ALTER TABLE `work_technic`

  ADD `version` INTEGER DEFAULT 0 AFTER `amount`;

ALTER TABLE `work_technic_version`

  DROP `version_created_at`;

ALTER TABLE `work_version`

  DROP `version_created_at`;

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

ALTER TABLE `groups` DROP FOREIGN KEY `users_ibfk_3`;

DROP INDEX `users_ibfi_3` ON `groups`;

ALTER TABLE `groups`

  ADD `do_create` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `subproject_id`;

ALTER TABLE `groups_version`

  ADD `do_create` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `subproject_id`,

  DROP `subproject_id_version`,

  DROP `user_id_version`,

  DROP `house_ids`,

  DROP `house_versions`;

ALTER TABLE `house` DROP FOREIGN KEY `users_ibfk_3`;

DROP INDEX `users_ibfi_3` ON `house`;

ALTER TABLE `house`

  DROP `user_id`,

  DROP `version`;

ALTER TABLE `house_version`

  ADD `version_created_at` TIMESTAMP NULL AFTER `version`,

  DROP `user_id`,

  DROP `user_id_version`;

ALTER TABLE `material`

  DROP `version`;

ALTER TABLE `material_version`

  ADD `version_created_at` TIMESTAMP NULL AFTER `version`;

ALTER TABLE `project`

  DROP `version`;

ALTER TABLE `project_version`

  ADD `version_created_at` TIMESTAMP NULL AFTER `version`;

ALTER TABLE `stage`

  DROP `version`;

ALTER TABLE `stage_material`

  DROP `version`;

ALTER TABLE `stage_material_version`

  ADD `version_created_at` TIMESTAMP NULL AFTER `version`;

ALTER TABLE `stage_technic`

  DROP `version`;

ALTER TABLE `stage_technic_version`

  ADD `version_created_at` TIMESTAMP NULL AFTER `version`;

ALTER TABLE `stage_version`

  ADD `version_created_at` TIMESTAMP NULL AFTER `version`;

ALTER TABLE `stage_work`

  DROP `version`;

ALTER TABLE `stage_work_version`

  ADD `version_created_at` TIMESTAMP NULL AFTER `version`;

ALTER TABLE `subproject`

  DROP `version`;

ALTER TABLE `subproject_version`

  ADD `version_created_at` TIMESTAMP NULL AFTER `version`;

ALTER TABLE `technic`

  DROP `version`;

ALTER TABLE `technic_version`

  ADD `version_created_at` TIMESTAMP NULL AFTER `version`;

ALTER TABLE `unit`

  DROP `version`;

ALTER TABLE `unit_version`

  ADD `version_created_at` TIMESTAMP NULL AFTER `version`;

ALTER TABLE `users`

  DROP `version`;

ALTER TABLE `users_confirmations`

  DROP `version`;

ALTER TABLE `users_confirmations_version`

  ADD `version_created_at` TIMESTAMP NULL AFTER `version`;

ALTER TABLE `users_remembered`

  DROP `version`;

ALTER TABLE `users_remembered_version`

  ADD `version_created_at` TIMESTAMP NULL AFTER `version`;

ALTER TABLE `users_resets`

  DROP `version`;

ALTER TABLE `users_resets_version`

  ADD `version_created_at` TIMESTAMP NULL AFTER `version`;

ALTER TABLE `users_throttling`

  DROP `version`;

ALTER TABLE `users_throttling_version`

  ADD `version_created_at` TIMESTAMP NULL AFTER `version`;

ALTER TABLE `users_version`

  ADD `version_created_at` TIMESTAMP NULL AFTER `version`,

  DROP `groups_ids`,

  DROP `groups_versions`,

  DROP `house_ids`,

  DROP `house_versions`;

ALTER TABLE `work`

  DROP `version`;

ALTER TABLE `work_material`

  DROP `version`;

ALTER TABLE `work_material_version`

  ADD `version_created_at` TIMESTAMP NULL AFTER `version`;

ALTER TABLE `work_technic`

  DROP `version`;

ALTER TABLE `work_technic_version`

  ADD `version_created_at` TIMESTAMP NULL AFTER `version`;

ALTER TABLE `work_version`

  ADD `version_created_at` TIMESTAMP NULL AFTER `version`;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
EOT;

        return array(
            'default' => $connection_default,
        );
    }

}