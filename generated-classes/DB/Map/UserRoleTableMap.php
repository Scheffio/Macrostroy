<?php

namespace DB\Map;

use DB\UserRole;
use DB\UserRoleQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'user_role' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class UserRoleTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'DB.Map.UserRoleTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'user_role';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'UserRole';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\DB\\UserRole';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'DB.UserRole';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 7;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 7;

    /**
     * the column name for the id field
     */
    public const COL_ID = 'user_role.id';

    /**
     * the column name for the name field
     */
    public const COL_NAME = 'user_role.name';

    /**
     * the column name for the object_viewer field
     */
    public const COL_OBJECT_VIEWER = 'user_role.object_viewer';

    /**
     * the column name for the manage_objects field
     */
    public const COL_MANAGE_OBJECTS = 'user_role.manage_objects';

    /**
     * the column name for the manage_volumes field
     */
    public const COL_MANAGE_VOLUMES = 'user_role.manage_volumes';

    /**
     * the column name for the manage_history field
     */
    public const COL_MANAGE_HISTORY = 'user_role.manage_history';

    /**
     * the column name for the manage_users field
     */
    public const COL_MANAGE_USERS = 'user_role.manage_users';

    /**
     * The default string format for model objects of the related table
     */
    public const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     *
     * @var array<string, mixed>
     */
    protected static $fieldNames = [
        self::TYPE_PHPNAME       => ['Id', 'Name', 'ObjectViewer', 'ManageObjects', 'ManageVolumes', 'ManageHistory', 'ManageUsers', ],
        self::TYPE_CAMELNAME     => ['id', 'name', 'objectViewer', 'manageObjects', 'manageVolumes', 'manageHistory', 'manageUsers', ],
        self::TYPE_COLNAME       => [UserRoleTableMap::COL_ID, UserRoleTableMap::COL_NAME, UserRoleTableMap::COL_OBJECT_VIEWER, UserRoleTableMap::COL_MANAGE_OBJECTS, UserRoleTableMap::COL_MANAGE_VOLUMES, UserRoleTableMap::COL_MANAGE_HISTORY, UserRoleTableMap::COL_MANAGE_USERS, ],
        self::TYPE_FIELDNAME     => ['id', 'name', 'object_viewer', 'manage_objects', 'manage_volumes', 'manage_history', 'manage_users', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, ]
    ];

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     *
     * @var array<string, mixed>
     */
    protected static $fieldKeys = [
        self::TYPE_PHPNAME       => ['Id' => 0, 'Name' => 1, 'ObjectViewer' => 2, 'ManageObjects' => 3, 'ManageVolumes' => 4, 'ManageHistory' => 5, 'ManageUsers' => 6, ],
        self::TYPE_CAMELNAME     => ['id' => 0, 'name' => 1, 'objectViewer' => 2, 'manageObjects' => 3, 'manageVolumes' => 4, 'manageHistory' => 5, 'manageUsers' => 6, ],
        self::TYPE_COLNAME       => [UserRoleTableMap::COL_ID => 0, UserRoleTableMap::COL_NAME => 1, UserRoleTableMap::COL_OBJECT_VIEWER => 2, UserRoleTableMap::COL_MANAGE_OBJECTS => 3, UserRoleTableMap::COL_MANAGE_VOLUMES => 4, UserRoleTableMap::COL_MANAGE_HISTORY => 5, UserRoleTableMap::COL_MANAGE_USERS => 6, ],
        self::TYPE_FIELDNAME     => ['id' => 0, 'name' => 1, 'object_viewer' => 2, 'manage_objects' => 3, 'manage_volumes' => 4, 'manage_history' => 5, 'manage_users' => 6, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'UserRole.Id' => 'ID',
        'id' => 'ID',
        'userRole.id' => 'ID',
        'UserRoleTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'user_role.id' => 'ID',
        'Name' => 'NAME',
        'UserRole.Name' => 'NAME',
        'name' => 'NAME',
        'userRole.name' => 'NAME',
        'UserRoleTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'user_role.name' => 'NAME',
        'ObjectViewer' => 'OBJECT_VIEWER',
        'UserRole.ObjectViewer' => 'OBJECT_VIEWER',
        'objectViewer' => 'OBJECT_VIEWER',
        'userRole.objectViewer' => 'OBJECT_VIEWER',
        'UserRoleTableMap::COL_OBJECT_VIEWER' => 'OBJECT_VIEWER',
        'COL_OBJECT_VIEWER' => 'OBJECT_VIEWER',
        'object_viewer' => 'OBJECT_VIEWER',
        'user_role.object_viewer' => 'OBJECT_VIEWER',
        'ManageObjects' => 'MANAGE_OBJECTS',
        'UserRole.ManageObjects' => 'MANAGE_OBJECTS',
        'manageObjects' => 'MANAGE_OBJECTS',
        'userRole.manageObjects' => 'MANAGE_OBJECTS',
        'UserRoleTableMap::COL_MANAGE_OBJECTS' => 'MANAGE_OBJECTS',
        'COL_MANAGE_OBJECTS' => 'MANAGE_OBJECTS',
        'manage_objects' => 'MANAGE_OBJECTS',
        'user_role.manage_objects' => 'MANAGE_OBJECTS',
        'ManageVolumes' => 'MANAGE_VOLUMES',
        'UserRole.ManageVolumes' => 'MANAGE_VOLUMES',
        'manageVolumes' => 'MANAGE_VOLUMES',
        'userRole.manageVolumes' => 'MANAGE_VOLUMES',
        'UserRoleTableMap::COL_MANAGE_VOLUMES' => 'MANAGE_VOLUMES',
        'COL_MANAGE_VOLUMES' => 'MANAGE_VOLUMES',
        'manage_volumes' => 'MANAGE_VOLUMES',
        'user_role.manage_volumes' => 'MANAGE_VOLUMES',
        'ManageHistory' => 'MANAGE_HISTORY',
        'UserRole.ManageHistory' => 'MANAGE_HISTORY',
        'manageHistory' => 'MANAGE_HISTORY',
        'userRole.manageHistory' => 'MANAGE_HISTORY',
        'UserRoleTableMap::COL_MANAGE_HISTORY' => 'MANAGE_HISTORY',
        'COL_MANAGE_HISTORY' => 'MANAGE_HISTORY',
        'manage_history' => 'MANAGE_HISTORY',
        'user_role.manage_history' => 'MANAGE_HISTORY',
        'ManageUsers' => 'MANAGE_USERS',
        'UserRole.ManageUsers' => 'MANAGE_USERS',
        'manageUsers' => 'MANAGE_USERS',
        'userRole.manageUsers' => 'MANAGE_USERS',
        'UserRoleTableMap::COL_MANAGE_USERS' => 'MANAGE_USERS',
        'COL_MANAGE_USERS' => 'MANAGE_USERS',
        'manage_users' => 'MANAGE_USERS',
        'user_role.manage_users' => 'MANAGE_USERS',
    ];

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function initialize(): void
    {
        // attributes
        $this->setName('user_role');
        $this->setPhpName('UserRole');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\DB\\UserRole');
        $this->setPackage('DB');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 255, null);
        $this->addColumn('object_viewer', 'ObjectViewer', 'BOOLEAN', true, 1, false);
        $this->addColumn('manage_objects', 'ManageObjects', 'BOOLEAN', true, 1, false);
        $this->addColumn('manage_volumes', 'ManageVolumes', 'BOOLEAN', true, 1, false);
        $this->addColumn('manage_history', 'ManageHistory', 'BOOLEAN', true, 1, false);
        $this->addColumn('manage_users', 'ManageUsers', 'BOOLEAN', true, 1, false);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Users', '\\DB\\Users', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':role_id',
    1 => ':id',
  ),
), null, null, 'Userss', false);
    }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array $row Resultset row.
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string|null The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): ?string
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array $row Resultset row.
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param bool $withPrefix Whether to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass(bool $withPrefix = true): string
    {
        return $withPrefix ? UserRoleTableMap::CLASS_DEFAULT : UserRoleTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array $row Row returned by DataFetcher->fetch().
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array (UserRole object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = UserRoleTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = UserRoleTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + UserRoleTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = UserRoleTableMap::OM_CLASS;
            /** @var UserRole $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            UserRoleTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array<object>
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher): array
    {
        $results = [];

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = UserRoleTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = UserRoleTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var UserRole $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                UserRoleTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria Object containing the columns to add.
     * @param string|null $alias Optional table alias
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return void
     */
    public static function addSelectColumns(Criteria $criteria, ?string $alias = null): void
    {
        if (null === $alias) {
            $criteria->addSelectColumn(UserRoleTableMap::COL_ID);
            $criteria->addSelectColumn(UserRoleTableMap::COL_NAME);
            $criteria->addSelectColumn(UserRoleTableMap::COL_OBJECT_VIEWER);
            $criteria->addSelectColumn(UserRoleTableMap::COL_MANAGE_OBJECTS);
            $criteria->addSelectColumn(UserRoleTableMap::COL_MANAGE_VOLUMES);
            $criteria->addSelectColumn(UserRoleTableMap::COL_MANAGE_HISTORY);
            $criteria->addSelectColumn(UserRoleTableMap::COL_MANAGE_USERS);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.object_viewer');
            $criteria->addSelectColumn($alias . '.manage_objects');
            $criteria->addSelectColumn($alias . '.manage_volumes');
            $criteria->addSelectColumn($alias . '.manage_history');
            $criteria->addSelectColumn($alias . '.manage_users');
        }
    }

    /**
     * Remove all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be removed as they are only loaded on demand.
     *
     * @param Criteria $criteria Object containing the columns to remove.
     * @param string|null $alias Optional table alias
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return void
     */
    public static function removeSelectColumns(Criteria $criteria, ?string $alias = null): void
    {
        if (null === $alias) {
            $criteria->removeSelectColumn(UserRoleTableMap::COL_ID);
            $criteria->removeSelectColumn(UserRoleTableMap::COL_NAME);
            $criteria->removeSelectColumn(UserRoleTableMap::COL_OBJECT_VIEWER);
            $criteria->removeSelectColumn(UserRoleTableMap::COL_MANAGE_OBJECTS);
            $criteria->removeSelectColumn(UserRoleTableMap::COL_MANAGE_VOLUMES);
            $criteria->removeSelectColumn(UserRoleTableMap::COL_MANAGE_HISTORY);
            $criteria->removeSelectColumn(UserRoleTableMap::COL_MANAGE_USERS);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.name');
            $criteria->removeSelectColumn($alias . '.object_viewer');
            $criteria->removeSelectColumn($alias . '.manage_objects');
            $criteria->removeSelectColumn($alias . '.manage_volumes');
            $criteria->removeSelectColumn($alias . '.manage_history');
            $criteria->removeSelectColumn($alias . '.manage_users');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap(): TableMap
    {
        return Propel::getServiceContainer()->getDatabaseMap(UserRoleTableMap::DATABASE_NAME)->getTable(UserRoleTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a UserRole or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or UserRole object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ?ConnectionInterface $con = null): int
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UserRoleTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \DB\UserRole) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(UserRoleTableMap::DATABASE_NAME);
            $criteria->add(UserRoleTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = UserRoleQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            UserRoleTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                UserRoleTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the user_role table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return UserRoleQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a UserRole or Criteria object.
     *
     * @param mixed $criteria Criteria or UserRole object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UserRoleTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from UserRole object
        }

        if ($criteria->containsKey(UserRoleTableMap::COL_ID) && $criteria->keyContainsValue(UserRoleTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.UserRoleTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = UserRoleQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
