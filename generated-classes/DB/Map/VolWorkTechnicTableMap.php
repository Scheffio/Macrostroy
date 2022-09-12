<?php

namespace DB\Map;

use DB\VolWorkTechnic;
use DB\VolWorkTechnicQuery;
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
 * This class defines the structure of the 'vol_work_technic' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class VolWorkTechnicTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'DB.Map.VolWorkTechnicTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'vol_work_technic';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'VolWorkTechnic';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\DB\\VolWorkTechnic';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'DB.VolWorkTechnic';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 8;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 8;

    /**
     * the column name for the id field
     */
    public const COL_ID = 'vol_work_technic.id';

    /**
     * the column name for the amount field
     */
    public const COL_AMOUNT = 'vol_work_technic.amount';

    /**
     * the column name for the work_id field
     */
    public const COL_WORK_ID = 'vol_work_technic.work_id';

    /**
     * the column name for the technic_id field
     */
    public const COL_TECHNIC_ID = 'vol_work_technic.technic_id';

    /**
     * the column name for the version field
     */
    public const COL_VERSION = 'vol_work_technic.version';

    /**
     * the column name for the version_created_at field
     */
    public const COL_VERSION_CREATED_AT = 'vol_work_technic.version_created_at';

    /**
     * the column name for the version_created_by field
     */
    public const COL_VERSION_CREATED_BY = 'vol_work_technic.version_created_by';

    /**
     * the column name for the version_comment field
     */
    public const COL_VERSION_COMMENT = 'vol_work_technic.version_comment';

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
        self::TYPE_PHPNAME       => ['Id', 'Amount', 'WorkId', 'TechnicId', 'Version', 'VersionCreatedAt', 'VersionCreatedBy', 'VersionComment', ],
        self::TYPE_CAMELNAME     => ['id', 'amount', 'workId', 'technicId', 'version', 'versionCreatedAt', 'versionCreatedBy', 'versionComment', ],
        self::TYPE_COLNAME       => [VolWorkTechnicTableMap::COL_ID, VolWorkTechnicTableMap::COL_AMOUNT, VolWorkTechnicTableMap::COL_WORK_ID, VolWorkTechnicTableMap::COL_TECHNIC_ID, VolWorkTechnicTableMap::COL_VERSION, VolWorkTechnicTableMap::COL_VERSION_CREATED_AT, VolWorkTechnicTableMap::COL_VERSION_CREATED_BY, VolWorkTechnicTableMap::COL_VERSION_COMMENT, ],
        self::TYPE_FIELDNAME     => ['id', 'amount', 'work_id', 'technic_id', 'version', 'version_created_at', 'version_created_by', 'version_comment', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
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
        self::TYPE_PHPNAME       => ['Id' => 0, 'Amount' => 1, 'WorkId' => 2, 'TechnicId' => 3, 'Version' => 4, 'VersionCreatedAt' => 5, 'VersionCreatedBy' => 6, 'VersionComment' => 7, ],
        self::TYPE_CAMELNAME     => ['id' => 0, 'amount' => 1, 'workId' => 2, 'technicId' => 3, 'version' => 4, 'versionCreatedAt' => 5, 'versionCreatedBy' => 6, 'versionComment' => 7, ],
        self::TYPE_COLNAME       => [VolWorkTechnicTableMap::COL_ID => 0, VolWorkTechnicTableMap::COL_AMOUNT => 1, VolWorkTechnicTableMap::COL_WORK_ID => 2, VolWorkTechnicTableMap::COL_TECHNIC_ID => 3, VolWorkTechnicTableMap::COL_VERSION => 4, VolWorkTechnicTableMap::COL_VERSION_CREATED_AT => 5, VolWorkTechnicTableMap::COL_VERSION_CREATED_BY => 6, VolWorkTechnicTableMap::COL_VERSION_COMMENT => 7, ],
        self::TYPE_FIELDNAME     => ['id' => 0, 'amount' => 1, 'work_id' => 2, 'technic_id' => 3, 'version' => 4, 'version_created_at' => 5, 'version_created_by' => 6, 'version_comment' => 7, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'VolWorkTechnic.Id' => 'ID',
        'id' => 'ID',
        'volWorkTechnic.id' => 'ID',
        'VolWorkTechnicTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'vol_work_technic.id' => 'ID',
        'Amount' => 'AMOUNT',
        'VolWorkTechnic.Amount' => 'AMOUNT',
        'amount' => 'AMOUNT',
        'volWorkTechnic.amount' => 'AMOUNT',
        'VolWorkTechnicTableMap::COL_AMOUNT' => 'AMOUNT',
        'COL_AMOUNT' => 'AMOUNT',
        'vol_work_technic.amount' => 'AMOUNT',
        'WorkId' => 'WORK_ID',
        'VolWorkTechnic.WorkId' => 'WORK_ID',
        'workId' => 'WORK_ID',
        'volWorkTechnic.workId' => 'WORK_ID',
        'VolWorkTechnicTableMap::COL_WORK_ID' => 'WORK_ID',
        'COL_WORK_ID' => 'WORK_ID',
        'work_id' => 'WORK_ID',
        'vol_work_technic.work_id' => 'WORK_ID',
        'TechnicId' => 'TECHNIC_ID',
        'VolWorkTechnic.TechnicId' => 'TECHNIC_ID',
        'technicId' => 'TECHNIC_ID',
        'volWorkTechnic.technicId' => 'TECHNIC_ID',
        'VolWorkTechnicTableMap::COL_TECHNIC_ID' => 'TECHNIC_ID',
        'COL_TECHNIC_ID' => 'TECHNIC_ID',
        'technic_id' => 'TECHNIC_ID',
        'vol_work_technic.technic_id' => 'TECHNIC_ID',
        'Version' => 'VERSION',
        'VolWorkTechnic.Version' => 'VERSION',
        'version' => 'VERSION',
        'volWorkTechnic.version' => 'VERSION',
        'VolWorkTechnicTableMap::COL_VERSION' => 'VERSION',
        'COL_VERSION' => 'VERSION',
        'vol_work_technic.version' => 'VERSION',
        'VersionCreatedAt' => 'VERSION_CREATED_AT',
        'VolWorkTechnic.VersionCreatedAt' => 'VERSION_CREATED_AT',
        'versionCreatedAt' => 'VERSION_CREATED_AT',
        'volWorkTechnic.versionCreatedAt' => 'VERSION_CREATED_AT',
        'VolWorkTechnicTableMap::COL_VERSION_CREATED_AT' => 'VERSION_CREATED_AT',
        'COL_VERSION_CREATED_AT' => 'VERSION_CREATED_AT',
        'version_created_at' => 'VERSION_CREATED_AT',
        'vol_work_technic.version_created_at' => 'VERSION_CREATED_AT',
        'VersionCreatedBy' => 'VERSION_CREATED_BY',
        'VolWorkTechnic.VersionCreatedBy' => 'VERSION_CREATED_BY',
        'versionCreatedBy' => 'VERSION_CREATED_BY',
        'volWorkTechnic.versionCreatedBy' => 'VERSION_CREATED_BY',
        'VolWorkTechnicTableMap::COL_VERSION_CREATED_BY' => 'VERSION_CREATED_BY',
        'COL_VERSION_CREATED_BY' => 'VERSION_CREATED_BY',
        'version_created_by' => 'VERSION_CREATED_BY',
        'vol_work_technic.version_created_by' => 'VERSION_CREATED_BY',
        'VersionComment' => 'VERSION_COMMENT',
        'VolWorkTechnic.VersionComment' => 'VERSION_COMMENT',
        'versionComment' => 'VERSION_COMMENT',
        'volWorkTechnic.versionComment' => 'VERSION_COMMENT',
        'VolWorkTechnicTableMap::COL_VERSION_COMMENT' => 'VERSION_COMMENT',
        'COL_VERSION_COMMENT' => 'VERSION_COMMENT',
        'version_comment' => 'VERSION_COMMENT',
        'vol_work_technic.version_comment' => 'VERSION_COMMENT',
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
        $this->setName('vol_work_technic');
        $this->setPhpName('VolWorkTechnic');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\DB\\VolWorkTechnic');
        $this->setPackage('DB');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('amount', 'Amount', 'DECIMAL', true, 19, null);
        $this->addForeignKey('work_id', 'WorkId', 'INTEGER', 'vol_work', 'id', true, null, null);
        $this->addForeignKey('technic_id', 'TechnicId', 'INTEGER', 'vol_technic', 'id', true, null, null);
        $this->addColumn('version', 'Version', 'INTEGER', false, null, 0);
        $this->addColumn('version_created_at', 'VersionCreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('version_created_by', 'VersionCreatedBy', 'VARCHAR', false, 100, null);
        $this->addColumn('version_comment', 'VersionComment', 'VARCHAR', false, 255, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('VolWork', '\\DB\\VolWork', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':work_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('VolTechnic', '\\DB\\VolTechnic', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':technic_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('VolWorkTechnicVersion', '\\DB\\VolWorkTechnicVersion', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':id',
    1 => ':id',
  ),
), 'CASCADE', null, 'VolWorkTechnicVersions', false);
    }

    /**
     *
     * Gets the list of behaviors registered for this table
     *
     * @return array<string, array> Associative array (name => parameters) of behaviors
     */
    public function getBehaviors(): array
    {
        return [
            'versionable' => ['version_column' => 'version', 'version_table' => '', 'log_created_at' => 'true', 'log_created_by' => 'true', 'log_comment' => 'true', 'version_created_at_column' => 'version_created_at', 'version_created_by_column' => 'version_created_by', 'version_comment_column' => 'version_comment', 'indices' => 'false'],
        ];
    }

    /**
     * Method to invalidate the instance pool of all tables related to vol_work_technic     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool(): void
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        VolWorkTechnicVersionTableMap::clearInstancePool();
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
        return $withPrefix ? VolWorkTechnicTableMap::CLASS_DEFAULT : VolWorkTechnicTableMap::OM_CLASS;
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
     * @return array (VolWorkTechnic object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = VolWorkTechnicTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = VolWorkTechnicTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + VolWorkTechnicTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = VolWorkTechnicTableMap::OM_CLASS;
            /** @var VolWorkTechnic $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            VolWorkTechnicTableMap::addInstanceToPool($obj, $key);
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
            $key = VolWorkTechnicTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = VolWorkTechnicTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var VolWorkTechnic $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                VolWorkTechnicTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(VolWorkTechnicTableMap::COL_ID);
            $criteria->addSelectColumn(VolWorkTechnicTableMap::COL_AMOUNT);
            $criteria->addSelectColumn(VolWorkTechnicTableMap::COL_WORK_ID);
            $criteria->addSelectColumn(VolWorkTechnicTableMap::COL_TECHNIC_ID);
            $criteria->addSelectColumn(VolWorkTechnicTableMap::COL_VERSION);
            $criteria->addSelectColumn(VolWorkTechnicTableMap::COL_VERSION_CREATED_AT);
            $criteria->addSelectColumn(VolWorkTechnicTableMap::COL_VERSION_CREATED_BY);
            $criteria->addSelectColumn(VolWorkTechnicTableMap::COL_VERSION_COMMENT);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.amount');
            $criteria->addSelectColumn($alias . '.work_id');
            $criteria->addSelectColumn($alias . '.technic_id');
            $criteria->addSelectColumn($alias . '.version');
            $criteria->addSelectColumn($alias . '.version_created_at');
            $criteria->addSelectColumn($alias . '.version_created_by');
            $criteria->addSelectColumn($alias . '.version_comment');
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
            $criteria->removeSelectColumn(VolWorkTechnicTableMap::COL_ID);
            $criteria->removeSelectColumn(VolWorkTechnicTableMap::COL_AMOUNT);
            $criteria->removeSelectColumn(VolWorkTechnicTableMap::COL_WORK_ID);
            $criteria->removeSelectColumn(VolWorkTechnicTableMap::COL_TECHNIC_ID);
            $criteria->removeSelectColumn(VolWorkTechnicTableMap::COL_VERSION);
            $criteria->removeSelectColumn(VolWorkTechnicTableMap::COL_VERSION_CREATED_AT);
            $criteria->removeSelectColumn(VolWorkTechnicTableMap::COL_VERSION_CREATED_BY);
            $criteria->removeSelectColumn(VolWorkTechnicTableMap::COL_VERSION_COMMENT);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.amount');
            $criteria->removeSelectColumn($alias . '.work_id');
            $criteria->removeSelectColumn($alias . '.technic_id');
            $criteria->removeSelectColumn($alias . '.version');
            $criteria->removeSelectColumn($alias . '.version_created_at');
            $criteria->removeSelectColumn($alias . '.version_created_by');
            $criteria->removeSelectColumn($alias . '.version_comment');
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
        return Propel::getServiceContainer()->getDatabaseMap(VolWorkTechnicTableMap::DATABASE_NAME)->getTable(VolWorkTechnicTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a VolWorkTechnic or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or VolWorkTechnic object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(VolWorkTechnicTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \DB\VolWorkTechnic) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(VolWorkTechnicTableMap::DATABASE_NAME);
            $criteria->add(VolWorkTechnicTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = VolWorkTechnicQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            VolWorkTechnicTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                VolWorkTechnicTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the vol_work_technic table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return VolWorkTechnicQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a VolWorkTechnic or Criteria object.
     *
     * @param mixed $criteria Criteria or VolWorkTechnic object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(VolWorkTechnicTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from VolWorkTechnic object
        }

        if ($criteria->containsKey(VolWorkTechnicTableMap::COL_ID) && $criteria->keyContainsValue(VolWorkTechnicTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.VolWorkTechnicTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = VolWorkTechnicQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
