<?php
$serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
$serviceContainer->initDatabaseMaps(array (
  'default' => 
  array (
    0 => '\\DB\\Map\\GroupsTableMap',
    1 => '\\DB\\Map\\HouseTableMap',
    2 => '\\DB\\Map\\MaterialTableMap',
    3 => '\\DB\\Map\\ProjectTableMap',
    4 => '\\DB\\Map\\StageMaterialTableMap',
    5 => '\\DB\\Map\\StageTableMap',
    6 => '\\DB\\Map\\StageTechnicTableMap',
    7 => '\\DB\\Map\\StageWorkTableMap',
    8 => '\\DB\\Map\\SubprojectTableMap',
    9 => '\\DB\\Map\\TechnicTableMap',
    10 => '\\DB\\Map\\UnitTableMap',
    11 => '\\DB\\Map\\UnitVersionTableMap',
    12 => '\\DB\\Map\\UsersConfirmationsTableMap',
    13 => '\\DB\\Map\\UsersRememberedTableMap',
    14 => '\\DB\\Map\\UsersResetsTableMap',
    15 => '\\DB\\Map\\UsersTableMap',
    16 => '\\DB\\Map\\UsersThrottlingTableMap',
    17 => '\\DB\\Map\\WorkMaterialTableMap',
    18 => '\\DB\\Map\\WorkTableMap',
    19 => '\\DB\\Map\\WorkTechnicTableMap',
  ),
));
