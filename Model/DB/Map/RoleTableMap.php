<?php

namespace DB\Map;

use DB\Role;
use DB\RoleQuery;
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
 * This class defines the structure of the 'role' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class RoleTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'DB.Map.RoleTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'role';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'Role';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\DB\\Role';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'DB.Role';

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
    public const COL_ID = 'role.id';

    /**
     * the column name for the name field
     */
    public const COL_NAME = 'role.name';

    /**
     * the column name for the object_viewer field
     */
    public const COL_OBJECT_VIEWER = 'role.object_viewer';

    /**
     * the column name for the manage_objects field
     */
    public const COL_MANAGE_OBJECTS = 'role.manage_objects';

    /**
     * the column name for the manage_volumes field
     */
    public const COL_MANAGE_VOLUMES = 'role.manage_volumes';

    /**
     * the column name for the manage_history field
     */
    public const COL_MANAGE_HISTORY = 'role.manage_history';

    /**
     * the column name for the manage_users field
     */
    public const COL_MANAGE_USERS = 'role.manage_users';

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
        self::TYPE_COLNAME       => [RoleTableMap::COL_ID, RoleTableMap::COL_NAME, RoleTableMap::COL_OBJECT_VIEWER, RoleTableMap::COL_MANAGE_OBJECTS, RoleTableMap::COL_MANAGE_VOLUMES, RoleTableMap::COL_MANAGE_HISTORY, RoleTableMap::COL_MANAGE_USERS, ],
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
        self::TYPE_COLNAME       => [RoleTableMap::COL_ID => 0, RoleTableMap::COL_NAME => 1, RoleTableMap::COL_OBJECT_VIEWER => 2, RoleTableMap::COL_MANAGE_OBJECTS => 3, RoleTableMap::COL_MANAGE_VOLUMES => 4, RoleTableMap::COL_MANAGE_HISTORY => 5, RoleTableMap::COL_MANAGE_USERS => 6, ],
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
        'Role.Id' => 'ID',
        'id' => 'ID',
        'role.id' => 'ID',
        'RoleTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'Name' => 'NAME',
        'Role.Name' => 'NAME',
        'name' => 'NAME',
        'role.name' => 'NAME',
        'RoleTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'ObjectViewer' => 'OBJECT_VIEWER',
        'Role.ObjectViewer' => 'OBJECT_VIEWER',
        'objectViewer' => 'OBJECT_VIEWER',
        'role.objectViewer' => 'OBJECT_VIEWER',
        'RoleTableMap::COL_OBJECT_VIEWER' => 'OBJECT_VIEWER',
        'COL_OBJECT_VIEWER' => 'OBJECT_VIEWER',
        'object_viewer' => 'OBJECT_VIEWER',
        'role.object_viewer' => 'OBJECT_VIEWER',
        'ManageObjects' => 'MANAGE_OBJECTS',
        'Role.ManageObjects' => 'MANAGE_OBJECTS',
        'manageObjects' => 'MANAGE_OBJECTS',
        'role.manageObjects' => 'MANAGE_OBJECTS',
        'RoleTableMap::COL_MANAGE_OBJECTS' => 'MANAGE_OBJECTS',
        'COL_MANAGE_OBJECTS' => 'MANAGE_OBJECTS',
        'manage_objects' => 'MANAGE_OBJECTS',
        'role.manage_objects' => 'MANAGE_OBJECTS',
        'ManageVolumes' => 'MANAGE_VOLUMES',
        'Role.ManageVolumes' => 'MANAGE_VOLUMES',
        'manageVolumes' => 'MANAGE_VOLUMES',
        'role.manageVolumes' => 'MANAGE_VOLUMES',
        'RoleTableMap::COL_MANAGE_VOLUMES' => 'MANAGE_VOLUMES',
        'COL_MANAGE_VOLUMES' => 'MANAGE_VOLUMES',
        'manage_volumes' => 'MANAGE_VOLUMES',
        'role.manage_volumes' => 'MANAGE_VOLUMES',
        'ManageHistory' => 'MANAGE_HISTORY',
        'Role.ManageHistory' => 'MANAGE_HISTORY',
        'manageHistory' => 'MANAGE_HISTORY',
        'role.manageHistory' => 'MANAGE_HISTORY',
        'RoleTableMap::COL_MANAGE_HISTORY' => 'MANAGE_HISTORY',
        'COL_MANAGE_HISTORY' => 'MANAGE_HISTORY',
        'manage_history' => 'MANAGE_HISTORY',
        'role.manage_history' => 'MANAGE_HISTORY',
        'ManageUsers' => 'MANAGE_USERS',
        'Role.ManageUsers' => 'MANAGE_USERS',
        'manageUsers' => 'MANAGE_USERS',
        'role.manageUsers' => 'MANAGE_USERS',
        'RoleTableMap::COL_MANAGE_USERS' => 'MANAGE_USERS',
        'COL_MANAGE_USERS' => 'MANAGE_USERS',
        'manage_users' => 'MANAGE_USERS',
        'role.manage_users' => 'MANAGE_USERS',
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
        $this->setName('role');
        $this->setPhpName('Role');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\DB\\Role');
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
        return $withPrefix ? RoleTableMap::CLASS_DEFAULT : RoleTableMap::OM_CLASS;
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
     * @return array (Role object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = RoleTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = RoleTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + RoleTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = RoleTableMap::OM_CLASS;
            /** @var Role $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            RoleTableMap::addInstanceToPool($obj, $key);
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
            $key = RoleTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = RoleTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Role $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                RoleTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(RoleTableMap::COL_ID);
            $criteria->addSelectColumn(RoleTableMap::COL_NAME);
            $criteria->addSelectColumn(RoleTableMap::COL_OBJECT_VIEWER);
            $criteria->addSelectColumn(RoleTableMap::COL_MANAGE_OBJECTS);
            $criteria->addSelectColumn(RoleTableMap::COL_MANAGE_VOLUMES);
            $criteria->addSelectColumn(RoleTableMap::COL_MANAGE_HISTORY);
            $criteria->addSelectColumn(RoleTableMap::COL_MANAGE_USERS);
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
            $criteria->removeSelectColumn(RoleTableMap::COL_ID);
            $criteria->removeSelectColumn(RoleTableMap::COL_NAME);
            $criteria->removeSelectColumn(RoleTableMap::COL_OBJECT_VIEWER);
            $criteria->removeSelectColumn(RoleTableMap::COL_MANAGE_OBJECTS);
            $criteria->removeSelectColumn(RoleTableMap::COL_MANAGE_VOLUMES);
            $criteria->removeSelectColumn(RoleTableMap::COL_MANAGE_HISTORY);
            $criteria->removeSelectColumn(RoleTableMap::COL_MANAGE_USERS);
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
        return Propel::getServiceContainer()->getDatabaseMap(RoleTableMap::DATABASE_NAME)->getTable(RoleTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Role or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Role object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(RoleTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \DB\Role) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(RoleTableMap::DATABASE_NAME);
            $criteria->add(RoleTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = RoleQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            RoleTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                RoleTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the role table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return RoleQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Role or Criteria object.
     *
     * @param mixed $criteria Criteria or Role object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(RoleTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Role object
        }

        if ($criteria->containsKey(RoleTableMap::COL_ID) && $criteria->keyContainsValue(RoleTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.RoleTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = RoleQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
