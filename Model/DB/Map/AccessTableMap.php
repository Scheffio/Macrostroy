<?php

namespace DB\Map;

use DB\Access;
use DB\AccessQuery;
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
 * This class defines the structure of the 'access' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class AccessTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'DB.Map.AccessTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'access';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'Access';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\DB\\Access';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'DB.Access';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 6;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 6;

    /**
     * the column name for the role_id field
     */
    public const COL_ROLE_ID = 'access.role_id';

    /**
     * the column name for the object_viewer field
     */
    public const COL_OBJECT_VIEWER = 'access.object_viewer';

    /**
     * the column name for the manage_objects field
     */
    public const COL_MANAGE_OBJECTS = 'access.manage_objects';

    /**
     * the column name for the manage_volumes field
     */
    public const COL_MANAGE_VOLUMES = 'access.manage_volumes';

    /**
     * the column name for the manage_history field
     */
    public const COL_MANAGE_HISTORY = 'access.manage_history';

    /**
     * the column name for the manage_users field
     */
    public const COL_MANAGE_USERS = 'access.manage_users';

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
        self::TYPE_PHPNAME       => ['RoleId', 'ObjectViewer', 'ManageObjects', 'ManageVolumes', 'ManageHistory', 'ManageUsers', ],
        self::TYPE_CAMELNAME     => ['roleId', 'objectViewer', 'manageObjects', 'manageVolumes', 'manageHistory', 'manageUsers', ],
        self::TYPE_COLNAME       => [AccessTableMap::COL_ROLE_ID, AccessTableMap::COL_OBJECT_VIEWER, AccessTableMap::COL_MANAGE_OBJECTS, AccessTableMap::COL_MANAGE_VOLUMES, AccessTableMap::COL_MANAGE_HISTORY, AccessTableMap::COL_MANAGE_USERS, ],
        self::TYPE_FIELDNAME     => ['role_id', 'object_viewer', 'manage_objects', 'manage_volumes', 'manage_history', 'manage_users', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, ]
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
        self::TYPE_PHPNAME       => ['RoleId' => 0, 'ObjectViewer' => 1, 'ManageObjects' => 2, 'ManageVolumes' => 3, 'ManageHistory' => 4, 'ManageUsers' => 5, ],
        self::TYPE_CAMELNAME     => ['roleId' => 0, 'objectViewer' => 1, 'manageObjects' => 2, 'manageVolumes' => 3, 'manageHistory' => 4, 'manageUsers' => 5, ],
        self::TYPE_COLNAME       => [AccessTableMap::COL_ROLE_ID => 0, AccessTableMap::COL_OBJECT_VIEWER => 1, AccessTableMap::COL_MANAGE_OBJECTS => 2, AccessTableMap::COL_MANAGE_VOLUMES => 3, AccessTableMap::COL_MANAGE_HISTORY => 4, AccessTableMap::COL_MANAGE_USERS => 5, ],
        self::TYPE_FIELDNAME     => ['role_id' => 0, 'object_viewer' => 1, 'manage_objects' => 2, 'manage_volumes' => 3, 'manage_history' => 4, 'manage_users' => 5, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'RoleId' => 'ROLE_ID',
        'Access.RoleId' => 'ROLE_ID',
        'roleId' => 'ROLE_ID',
        'access.roleId' => 'ROLE_ID',
        'AccessTableMap::COL_ROLE_ID' => 'ROLE_ID',
        'COL_ROLE_ID' => 'ROLE_ID',
        'role_id' => 'ROLE_ID',
        'access.role_id' => 'ROLE_ID',
        'ObjectViewer' => 'OBJECT_VIEWER',
        'Access.ObjectViewer' => 'OBJECT_VIEWER',
        'objectViewer' => 'OBJECT_VIEWER',
        'access.objectViewer' => 'OBJECT_VIEWER',
        'AccessTableMap::COL_OBJECT_VIEWER' => 'OBJECT_VIEWER',
        'COL_OBJECT_VIEWER' => 'OBJECT_VIEWER',
        'object_viewer' => 'OBJECT_VIEWER',
        'access.object_viewer' => 'OBJECT_VIEWER',
        'ManageObjects' => 'MANAGE_OBJECTS',
        'Access.ManageObjects' => 'MANAGE_OBJECTS',
        'manageObjects' => 'MANAGE_OBJECTS',
        'access.manageObjects' => 'MANAGE_OBJECTS',
        'AccessTableMap::COL_MANAGE_OBJECTS' => 'MANAGE_OBJECTS',
        'COL_MANAGE_OBJECTS' => 'MANAGE_OBJECTS',
        'manage_objects' => 'MANAGE_OBJECTS',
        'access.manage_objects' => 'MANAGE_OBJECTS',
        'ManageVolumes' => 'MANAGE_VOLUMES',
        'Access.ManageVolumes' => 'MANAGE_VOLUMES',
        'manageVolumes' => 'MANAGE_VOLUMES',
        'access.manageVolumes' => 'MANAGE_VOLUMES',
        'AccessTableMap::COL_MANAGE_VOLUMES' => 'MANAGE_VOLUMES',
        'COL_MANAGE_VOLUMES' => 'MANAGE_VOLUMES',
        'manage_volumes' => 'MANAGE_VOLUMES',
        'access.manage_volumes' => 'MANAGE_VOLUMES',
        'ManageHistory' => 'MANAGE_HISTORY',
        'Access.ManageHistory' => 'MANAGE_HISTORY',
        'manageHistory' => 'MANAGE_HISTORY',
        'access.manageHistory' => 'MANAGE_HISTORY',
        'AccessTableMap::COL_MANAGE_HISTORY' => 'MANAGE_HISTORY',
        'COL_MANAGE_HISTORY' => 'MANAGE_HISTORY',
        'manage_history' => 'MANAGE_HISTORY',
        'access.manage_history' => 'MANAGE_HISTORY',
        'ManageUsers' => 'MANAGE_USERS',
        'Access.ManageUsers' => 'MANAGE_USERS',
        'manageUsers' => 'MANAGE_USERS',
        'access.manageUsers' => 'MANAGE_USERS',
        'AccessTableMap::COL_MANAGE_USERS' => 'MANAGE_USERS',
        'COL_MANAGE_USERS' => 'MANAGE_USERS',
        'manage_users' => 'MANAGE_USERS',
        'access.manage_users' => 'MANAGE_USERS',
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
        $this->setName('access');
        $this->setPhpName('Access');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\DB\\Access');
        $this->setPackage('DB');
        $this->setUseIdGenerator(false);
        // columns
        $this->addForeignPrimaryKey('role_id', 'RoleId', 'INTEGER' , 'role', 'id', true, null, null);
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
        $this->addRelation('Role', '\\DB\\Role', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':role_id',
    1 => ':id',
  ),
), null, null, null, false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('RoleId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('RoleId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('RoleId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('RoleId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('RoleId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('RoleId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('RoleId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? AccessTableMap::CLASS_DEFAULT : AccessTableMap::OM_CLASS;
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
     * @return array (Access object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = AccessTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = AccessTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + AccessTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = AccessTableMap::OM_CLASS;
            /** @var Access $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            AccessTableMap::addInstanceToPool($obj, $key);
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
            $key = AccessTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = AccessTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Access $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                AccessTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(AccessTableMap::COL_ROLE_ID);
            $criteria->addSelectColumn(AccessTableMap::COL_OBJECT_VIEWER);
            $criteria->addSelectColumn(AccessTableMap::COL_MANAGE_OBJECTS);
            $criteria->addSelectColumn(AccessTableMap::COL_MANAGE_VOLUMES);
            $criteria->addSelectColumn(AccessTableMap::COL_MANAGE_HISTORY);
            $criteria->addSelectColumn(AccessTableMap::COL_MANAGE_USERS);
        } else {
            $criteria->addSelectColumn($alias . '.role_id');
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
            $criteria->removeSelectColumn(AccessTableMap::COL_ROLE_ID);
            $criteria->removeSelectColumn(AccessTableMap::COL_OBJECT_VIEWER);
            $criteria->removeSelectColumn(AccessTableMap::COL_MANAGE_OBJECTS);
            $criteria->removeSelectColumn(AccessTableMap::COL_MANAGE_VOLUMES);
            $criteria->removeSelectColumn(AccessTableMap::COL_MANAGE_HISTORY);
            $criteria->removeSelectColumn(AccessTableMap::COL_MANAGE_USERS);
        } else {
            $criteria->removeSelectColumn($alias . '.role_id');
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
        return Propel::getServiceContainer()->getDatabaseMap(AccessTableMap::DATABASE_NAME)->getTable(AccessTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Access or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Access object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(AccessTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \DB\Access) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(AccessTableMap::DATABASE_NAME);
            $criteria->add(AccessTableMap::COL_ROLE_ID, (array) $values, Criteria::IN);
        }

        $query = AccessQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            AccessTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                AccessTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the access table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return AccessQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Access or Criteria object.
     *
     * @param mixed $criteria Criteria or Access object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AccessTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Access object
        }


        // Set the correct dbName
        $query = AccessQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
