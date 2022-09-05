<?php

namespace DB\Map;

use DB\VolWork;
use DB\VolWorkQuery;
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
 * This class defines the structure of the 'vol_work' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class VolWorkTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'DB.Map.VolWorkTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'vol_work';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'VolWork';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\DB\\VolWork';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'DB.VolWork';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 9;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 9;

    /**
     * the column name for the id field
     */
    public const COL_ID = 'vol_work.id';

    /**
     * the column name for the name field
     */
    public const COL_NAME = 'vol_work.name';

    /**
     * the column name for the price field
     */
    public const COL_PRICE = 'vol_work.price';

    /**
     * the column name for the is_available field
     */
    public const COL_IS_AVAILABLE = 'vol_work.is_available';

    /**
     * the column name for the unit_id field
     */
    public const COL_UNIT_ID = 'vol_work.unit_id';

    /**
     * the column name for the version field
     */
    public const COL_VERSION = 'vol_work.version';

    /**
     * the column name for the version_created_at field
     */
    public const COL_VERSION_CREATED_AT = 'vol_work.version_created_at';

    /**
     * the column name for the version_created_by field
     */
    public const COL_VERSION_CREATED_BY = 'vol_work.version_created_by';

    /**
     * the column name for the version_comment field
     */
    public const COL_VERSION_COMMENT = 'vol_work.version_comment';

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
        self::TYPE_PHPNAME       => ['Id', 'Name', 'Price', 'IsAvailable', 'UnitId', 'Version', 'VersionCreatedAt', 'VersionCreatedBy', 'VersionComment', ],
        self::TYPE_CAMELNAME     => ['id', 'name', 'price', 'isAvailable', 'unitId', 'version', 'versionCreatedAt', 'versionCreatedBy', 'versionComment', ],
        self::TYPE_COLNAME       => [VolWorkTableMap::COL_ID, VolWorkTableMap::COL_NAME, VolWorkTableMap::COL_PRICE, VolWorkTableMap::COL_IS_AVAILABLE, VolWorkTableMap::COL_UNIT_ID, VolWorkTableMap::COL_VERSION, VolWorkTableMap::COL_VERSION_CREATED_AT, VolWorkTableMap::COL_VERSION_CREATED_BY, VolWorkTableMap::COL_VERSION_COMMENT, ],
        self::TYPE_FIELDNAME     => ['id', 'name', 'price', 'is_available', 'unit_id', 'version', 'version_created_at', 'version_created_by', 'version_comment', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, ]
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
        self::TYPE_PHPNAME       => ['Id' => 0, 'Name' => 1, 'Price' => 2, 'IsAvailable' => 3, 'UnitId' => 4, 'Version' => 5, 'VersionCreatedAt' => 6, 'VersionCreatedBy' => 7, 'VersionComment' => 8, ],
        self::TYPE_CAMELNAME     => ['id' => 0, 'name' => 1, 'price' => 2, 'isAvailable' => 3, 'unitId' => 4, 'version' => 5, 'versionCreatedAt' => 6, 'versionCreatedBy' => 7, 'versionComment' => 8, ],
        self::TYPE_COLNAME       => [VolWorkTableMap::COL_ID => 0, VolWorkTableMap::COL_NAME => 1, VolWorkTableMap::COL_PRICE => 2, VolWorkTableMap::COL_IS_AVAILABLE => 3, VolWorkTableMap::COL_UNIT_ID => 4, VolWorkTableMap::COL_VERSION => 5, VolWorkTableMap::COL_VERSION_CREATED_AT => 6, VolWorkTableMap::COL_VERSION_CREATED_BY => 7, VolWorkTableMap::COL_VERSION_COMMENT => 8, ],
        self::TYPE_FIELDNAME     => ['id' => 0, 'name' => 1, 'price' => 2, 'is_available' => 3, 'unit_id' => 4, 'version' => 5, 'version_created_at' => 6, 'version_created_by' => 7, 'version_comment' => 8, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'VolWork.Id' => 'ID',
        'id' => 'ID',
        'volWork.id' => 'ID',
        'VolWorkTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'vol_work.id' => 'ID',
        'Name' => 'NAME',
        'VolWork.Name' => 'NAME',
        'name' => 'NAME',
        'volWork.name' => 'NAME',
        'VolWorkTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'vol_work.name' => 'NAME',
        'Price' => 'PRICE',
        'VolWork.Price' => 'PRICE',
        'price' => 'PRICE',
        'volWork.price' => 'PRICE',
        'VolWorkTableMap::COL_PRICE' => 'PRICE',
        'COL_PRICE' => 'PRICE',
        'vol_work.price' => 'PRICE',
        'IsAvailable' => 'IS_AVAILABLE',
        'VolWork.IsAvailable' => 'IS_AVAILABLE',
        'isAvailable' => 'IS_AVAILABLE',
        'volWork.isAvailable' => 'IS_AVAILABLE',
        'VolWorkTableMap::COL_IS_AVAILABLE' => 'IS_AVAILABLE',
        'COL_IS_AVAILABLE' => 'IS_AVAILABLE',
        'is_available' => 'IS_AVAILABLE',
        'vol_work.is_available' => 'IS_AVAILABLE',
        'UnitId' => 'UNIT_ID',
        'VolWork.UnitId' => 'UNIT_ID',
        'unitId' => 'UNIT_ID',
        'volWork.unitId' => 'UNIT_ID',
        'VolWorkTableMap::COL_UNIT_ID' => 'UNIT_ID',
        'COL_UNIT_ID' => 'UNIT_ID',
        'unit_id' => 'UNIT_ID',
        'vol_work.unit_id' => 'UNIT_ID',
        'Version' => 'VERSION',
        'VolWork.Version' => 'VERSION',
        'version' => 'VERSION',
        'volWork.version' => 'VERSION',
        'VolWorkTableMap::COL_VERSION' => 'VERSION',
        'COL_VERSION' => 'VERSION',
        'vol_work.version' => 'VERSION',
        'VersionCreatedAt' => 'VERSION_CREATED_AT',
        'VolWork.VersionCreatedAt' => 'VERSION_CREATED_AT',
        'versionCreatedAt' => 'VERSION_CREATED_AT',
        'volWork.versionCreatedAt' => 'VERSION_CREATED_AT',
        'VolWorkTableMap::COL_VERSION_CREATED_AT' => 'VERSION_CREATED_AT',
        'COL_VERSION_CREATED_AT' => 'VERSION_CREATED_AT',
        'version_created_at' => 'VERSION_CREATED_AT',
        'vol_work.version_created_at' => 'VERSION_CREATED_AT',
        'VersionCreatedBy' => 'VERSION_CREATED_BY',
        'VolWork.VersionCreatedBy' => 'VERSION_CREATED_BY',
        'versionCreatedBy' => 'VERSION_CREATED_BY',
        'volWork.versionCreatedBy' => 'VERSION_CREATED_BY',
        'VolWorkTableMap::COL_VERSION_CREATED_BY' => 'VERSION_CREATED_BY',
        'COL_VERSION_CREATED_BY' => 'VERSION_CREATED_BY',
        'version_created_by' => 'VERSION_CREATED_BY',
        'vol_work.version_created_by' => 'VERSION_CREATED_BY',
        'VersionComment' => 'VERSION_COMMENT',
        'VolWork.VersionComment' => 'VERSION_COMMENT',
        'versionComment' => 'VERSION_COMMENT',
        'volWork.versionComment' => 'VERSION_COMMENT',
        'VolWorkTableMap::COL_VERSION_COMMENT' => 'VERSION_COMMENT',
        'COL_VERSION_COMMENT' => 'VERSION_COMMENT',
        'version_comment' => 'VERSION_COMMENT',
        'vol_work.version_comment' => 'VERSION_COMMENT',
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
        $this->setName('vol_work');
        $this->setPhpName('VolWork');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\DB\\VolWork');
        $this->setPackage('DB');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 255, null);
        $this->addColumn('price', 'Price', 'DECIMAL', true, 19, null);
        $this->addColumn('is_available', 'IsAvailable', 'BOOLEAN', true, 1, true);
        $this->addForeignKey('unit_id', 'UnitId', 'INTEGER', 'vol_unit', 'id', true, null, null);
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
        $this->addRelation('VolUnit', '\\DB\\VolUnit', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':unit_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('ObjStageWork', '\\DB\\ObjStageWork', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':work_id',
    1 => ':id',
  ),
), null, null, 'ObjStageWorks', false);
        $this->addRelation('VolWorkMaterial', '\\DB\\VolWorkMaterial', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':work_id',
    1 => ':id',
  ),
), null, null, 'VolWorkMaterials', false);
        $this->addRelation('VolWorkTechnic', '\\DB\\VolWorkTechnic', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':work_id',
    1 => ':id',
  ),
), null, null, 'VolWorkTechnics', false);
        $this->addRelation('VolWorkVersion', '\\DB\\VolWorkVersion', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':id',
    1 => ':id',
  ),
), 'CASCADE', null, 'VolWorkVersions', false);
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
     * Method to invalidate the instance pool of all tables related to vol_work     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool(): void
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        VolWorkVersionTableMap::clearInstancePool();
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
        return $withPrefix ? VolWorkTableMap::CLASS_DEFAULT : VolWorkTableMap::OM_CLASS;
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
     * @return array (VolWork object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = VolWorkTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = VolWorkTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + VolWorkTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = VolWorkTableMap::OM_CLASS;
            /** @var VolWork $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            VolWorkTableMap::addInstanceToPool($obj, $key);
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
            $key = VolWorkTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = VolWorkTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var VolWork $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                VolWorkTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(VolWorkTableMap::COL_ID);
            $criteria->addSelectColumn(VolWorkTableMap::COL_NAME);
            $criteria->addSelectColumn(VolWorkTableMap::COL_PRICE);
            $criteria->addSelectColumn(VolWorkTableMap::COL_IS_AVAILABLE);
            $criteria->addSelectColumn(VolWorkTableMap::COL_UNIT_ID);
            $criteria->addSelectColumn(VolWorkTableMap::COL_VERSION);
            $criteria->addSelectColumn(VolWorkTableMap::COL_VERSION_CREATED_AT);
            $criteria->addSelectColumn(VolWorkTableMap::COL_VERSION_CREATED_BY);
            $criteria->addSelectColumn(VolWorkTableMap::COL_VERSION_COMMENT);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.price');
            $criteria->addSelectColumn($alias . '.is_available');
            $criteria->addSelectColumn($alias . '.unit_id');
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
            $criteria->removeSelectColumn(VolWorkTableMap::COL_ID);
            $criteria->removeSelectColumn(VolWorkTableMap::COL_NAME);
            $criteria->removeSelectColumn(VolWorkTableMap::COL_PRICE);
            $criteria->removeSelectColumn(VolWorkTableMap::COL_IS_AVAILABLE);
            $criteria->removeSelectColumn(VolWorkTableMap::COL_UNIT_ID);
            $criteria->removeSelectColumn(VolWorkTableMap::COL_VERSION);
            $criteria->removeSelectColumn(VolWorkTableMap::COL_VERSION_CREATED_AT);
            $criteria->removeSelectColumn(VolWorkTableMap::COL_VERSION_CREATED_BY);
            $criteria->removeSelectColumn(VolWorkTableMap::COL_VERSION_COMMENT);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.name');
            $criteria->removeSelectColumn($alias . '.price');
            $criteria->removeSelectColumn($alias . '.is_available');
            $criteria->removeSelectColumn($alias . '.unit_id');
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
        return Propel::getServiceContainer()->getDatabaseMap(VolWorkTableMap::DATABASE_NAME)->getTable(VolWorkTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a VolWork or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or VolWork object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(VolWorkTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \DB\VolWork) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(VolWorkTableMap::DATABASE_NAME);
            $criteria->add(VolWorkTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = VolWorkQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            VolWorkTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                VolWorkTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the vol_work table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return VolWorkQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a VolWork or Criteria object.
     *
     * @param mixed $criteria Criteria or VolWork object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(VolWorkTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from VolWork object
        }

        if ($criteria->containsKey(VolWorkTableMap::COL_ID) && $criteria->keyContainsValue(VolWorkTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.VolWorkTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = VolWorkQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
