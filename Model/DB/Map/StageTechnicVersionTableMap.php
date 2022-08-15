<?php

namespace DB\Map;

use DB\StageTechnicVersion;
use DB\StageTechnicVersionQuery;
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
 * This class defines the structure of the 'stage_technic_version' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class StageTechnicVersionTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'DB.Map.StageTechnicVersionTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'stage_technic_version';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\DB\\StageTechnicVersion';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'DB.StageTechnicVersion';

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
    public const COL_ID = 'stage_technic_version.id';

    /**
     * the column name for the price field
     */
    public const COL_PRICE = 'stage_technic_version.price';

    /**
     * the column name for the amount field
     */
    public const COL_AMOUNT = 'stage_technic_version.amount';

    /**
     * the column name for the technic_id field
     */
    public const COL_TECHNIC_ID = 'stage_technic_version.technic_id';

    /**
     * the column name for the stage_id field
     */
    public const COL_STAGE_ID = 'stage_technic_version.stage_id';

    /**
     * the column name for the version field
     */
    public const COL_VERSION = 'stage_technic_version.version';

    /**
     * the column name for the stage_id_version field
     */
    public const COL_STAGE_ID_VERSION = 'stage_technic_version.stage_id_version';

    /**
     * the column name for the technic_id_version field
     */
    public const COL_TECHNIC_ID_VERSION = 'stage_technic_version.technic_id_version';

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
        self::TYPE_PHPNAME       => ['Id', 'Price', 'Amount', 'TechnicId', 'StageId', 'Version', 'StageIdVersion', 'TechnicIdVersion', ],
        self::TYPE_CAMELNAME     => ['id', 'price', 'amount', 'technicId', 'stageId', 'version', 'stageIdVersion', 'technicIdVersion', ],
        self::TYPE_COLNAME       => [StageTechnicVersionTableMap::COL_ID, StageTechnicVersionTableMap::COL_PRICE, StageTechnicVersionTableMap::COL_AMOUNT, StageTechnicVersionTableMap::COL_TECHNIC_ID, StageTechnicVersionTableMap::COL_STAGE_ID, StageTechnicVersionTableMap::COL_VERSION, StageTechnicVersionTableMap::COL_STAGE_ID_VERSION, StageTechnicVersionTableMap::COL_TECHNIC_ID_VERSION, ],
        self::TYPE_FIELDNAME     => ['id', 'price', 'amount', 'technic_id', 'stage_id', 'version', 'stage_id_version', 'technic_id_version', ],
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
        self::TYPE_PHPNAME       => ['Id' => 0, 'Price' => 1, 'Amount' => 2, 'TechnicId' => 3, 'StageId' => 4, 'Version' => 5, 'StageIdVersion' => 6, 'TechnicIdVersion' => 7, ],
        self::TYPE_CAMELNAME     => ['id' => 0, 'price' => 1, 'amount' => 2, 'technicId' => 3, 'stageId' => 4, 'version' => 5, 'stageIdVersion' => 6, 'technicIdVersion' => 7, ],
        self::TYPE_COLNAME       => [StageTechnicVersionTableMap::COL_ID => 0, StageTechnicVersionTableMap::COL_PRICE => 1, StageTechnicVersionTableMap::COL_AMOUNT => 2, StageTechnicVersionTableMap::COL_TECHNIC_ID => 3, StageTechnicVersionTableMap::COL_STAGE_ID => 4, StageTechnicVersionTableMap::COL_VERSION => 5, StageTechnicVersionTableMap::COL_STAGE_ID_VERSION => 6, StageTechnicVersionTableMap::COL_TECHNIC_ID_VERSION => 7, ],
        self::TYPE_FIELDNAME     => ['id' => 0, 'price' => 1, 'amount' => 2, 'technic_id' => 3, 'stage_id' => 4, 'version' => 5, 'stage_id_version' => 6, 'technic_id_version' => 7, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'StageTechnicVersion.Id' => 'ID',
        'id' => 'ID',
        'stageTechnicVersion.id' => 'ID',
        'StageTechnicVersionTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'stage_technic_version.id' => 'ID',
        'Price' => 'PRICE',
        'StageTechnicVersion.Price' => 'PRICE',
        'price' => 'PRICE',
        'stageTechnicVersion.price' => 'PRICE',
        'StageTechnicVersionTableMap::COL_PRICE' => 'PRICE',
        'COL_PRICE' => 'PRICE',
        'stage_technic_version.price' => 'PRICE',
        'Amount' => 'AMOUNT',
        'StageTechnicVersion.Amount' => 'AMOUNT',
        'amount' => 'AMOUNT',
        'stageTechnicVersion.amount' => 'AMOUNT',
        'StageTechnicVersionTableMap::COL_AMOUNT' => 'AMOUNT',
        'COL_AMOUNT' => 'AMOUNT',
        'stage_technic_version.amount' => 'AMOUNT',
        'TechnicId' => 'TECHNIC_ID',
        'StageTechnicVersion.TechnicId' => 'TECHNIC_ID',
        'technicId' => 'TECHNIC_ID',
        'stageTechnicVersion.technicId' => 'TECHNIC_ID',
        'StageTechnicVersionTableMap::COL_TECHNIC_ID' => 'TECHNIC_ID',
        'COL_TECHNIC_ID' => 'TECHNIC_ID',
        'technic_id' => 'TECHNIC_ID',
        'stage_technic_version.technic_id' => 'TECHNIC_ID',
        'StageId' => 'STAGE_ID',
        'StageTechnicVersion.StageId' => 'STAGE_ID',
        'stageId' => 'STAGE_ID',
        'stageTechnicVersion.stageId' => 'STAGE_ID',
        'StageTechnicVersionTableMap::COL_STAGE_ID' => 'STAGE_ID',
        'COL_STAGE_ID' => 'STAGE_ID',
        'stage_id' => 'STAGE_ID',
        'stage_technic_version.stage_id' => 'STAGE_ID',
        'Version' => 'VERSION',
        'StageTechnicVersion.Version' => 'VERSION',
        'version' => 'VERSION',
        'stageTechnicVersion.version' => 'VERSION',
        'StageTechnicVersionTableMap::COL_VERSION' => 'VERSION',
        'COL_VERSION' => 'VERSION',
        'stage_technic_version.version' => 'VERSION',
        'StageIdVersion' => 'STAGE_ID_VERSION',
        'StageTechnicVersion.StageIdVersion' => 'STAGE_ID_VERSION',
        'stageIdVersion' => 'STAGE_ID_VERSION',
        'stageTechnicVersion.stageIdVersion' => 'STAGE_ID_VERSION',
        'StageTechnicVersionTableMap::COL_STAGE_ID_VERSION' => 'STAGE_ID_VERSION',
        'COL_STAGE_ID_VERSION' => 'STAGE_ID_VERSION',
        'stage_id_version' => 'STAGE_ID_VERSION',
        'stage_technic_version.stage_id_version' => 'STAGE_ID_VERSION',
        'TechnicIdVersion' => 'TECHNIC_ID_VERSION',
        'StageTechnicVersion.TechnicIdVersion' => 'TECHNIC_ID_VERSION',
        'technicIdVersion' => 'TECHNIC_ID_VERSION',
        'stageTechnicVersion.technicIdVersion' => 'TECHNIC_ID_VERSION',
        'StageTechnicVersionTableMap::COL_TECHNIC_ID_VERSION' => 'TECHNIC_ID_VERSION',
        'COL_TECHNIC_ID_VERSION' => 'TECHNIC_ID_VERSION',
        'technic_id_version' => 'TECHNIC_ID_VERSION',
        'stage_technic_version.technic_id_version' => 'TECHNIC_ID_VERSION',
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
        $this->setName('stage_technic_version');
        $this->setPhpName('StageTechnicVersion');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\DB\\StageTechnicVersion');
        $this->setPackage('DB');
        $this->setUseIdGenerator(false);
        // columns
        $this->addForeignPrimaryKey('id', 'Id', 'INTEGER' , 'stage_technic', 'id', true, null, null);
        $this->addColumn('price', 'Price', 'DECIMAL', true, 19, null);
        $this->addColumn('amount', 'Amount', 'DECIMAL', true, 19, null);
        $this->addColumn('technic_id', 'TechnicId', 'INTEGER', true, null, null);
        $this->addColumn('stage_id', 'StageId', 'INTEGER', true, null, null);
        $this->addPrimaryKey('version', 'Version', 'INTEGER', true, null, 0);
        $this->addColumn('stage_id_version', 'StageIdVersion', 'INTEGER', false, null, 0);
        $this->addColumn('technic_id_version', 'TechnicIdVersion', 'INTEGER', false, null, 0);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('StageTechnic', '\\DB\\StageTechnic', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':id',
    1 => ':id',
  ),
), 'CASCADE', null, null, false);
    }

    /**
     * Adds an object to the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database. In some cases you may need to explicitly add objects
     * to the cache in order to ensure that the same objects are always returned by find*()
     * and findPk*() calls.
     *
     * @param \DB\StageTechnicVersion $obj A \DB\StageTechnicVersion object.
     * @param string|null $key Key (optional) to use for instance map (for performance boost if key was already calculated externally).
     *
     * @return void
     */
    public static function addInstanceToPool(StageTechnicVersion $obj, ?string $key = null): void
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (null === $key) {
                $key = serialize([(null === $obj->getId() || is_scalar($obj->getId()) || is_callable([$obj->getId(), '__toString']) ? (string) $obj->getId() : $obj->getId()), (null === $obj->getVersion() || is_scalar($obj->getVersion()) || is_callable([$obj->getVersion(), '__toString']) ? (string) $obj->getVersion() : $obj->getVersion())]);
            } // if key === null
            self::$instances[$key] = $obj;
        }
    }

    /**
     * Removes an object from the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database.  In some cases -- especially when you override doDelete
     * methods in your stub classes -- you may need to explicitly remove objects
     * from the cache in order to prevent returning objects that no longer exist.
     *
     * @param mixed $value A \DB\StageTechnicVersion object or a primary key value.
     *
     * @return void
     */
    public static function removeInstanceFromPool($value): void
    {
        if (Propel::isInstancePoolingEnabled() && null !== $value) {
            if (is_object($value) && $value instanceof \DB\StageTechnicVersion) {
                $key = serialize([(null === $value->getId() || is_scalar($value->getId()) || is_callable([$value->getId(), '__toString']) ? (string) $value->getId() : $value->getId()), (null === $value->getVersion() || is_scalar($value->getVersion()) || is_callable([$value->getVersion(), '__toString']) ? (string) $value->getVersion() : $value->getVersion())]);

            } elseif (is_array($value) && count($value) === 2) {
                // assume we've been passed a primary key";
                $key = serialize([(null === $value[0] || is_scalar($value[0]) || is_callable([$value[0], '__toString']) ? (string) $value[0] : $value[0]), (null === $value[1] || is_scalar($value[1]) || is_callable([$value[1], '__toString']) ? (string) $value[1] : $value[1])]);
            } elseif ($value instanceof Criteria) {
                self::$instances = [];

                return;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or \DB\StageTechnicVersion object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value, true)));
                throw $e;
            }

            unset(self::$instances[$key]);
        }
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null && $row[TableMap::TYPE_NUM == $indexType ? 5 + $offset : static::translateFieldName('Version', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return serialize([(null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]), (null === $row[TableMap::TYPE_NUM == $indexType ? 5 + $offset : static::translateFieldName('Version', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 5 + $offset : static::translateFieldName('Version', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 5 + $offset : static::translateFieldName('Version', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 5 + $offset : static::translateFieldName('Version', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 5 + $offset : static::translateFieldName('Version', TableMap::TYPE_PHPNAME, $indexType)])]);
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
            $pks = [];

        $pks[] = (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
        ];
        $pks[] = (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 5 + $offset
                : self::translateFieldName('Version', TableMap::TYPE_PHPNAME, $indexType)
        ];

        return $pks;
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
        return $withPrefix ? StageTechnicVersionTableMap::CLASS_DEFAULT : StageTechnicVersionTableMap::OM_CLASS;
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
     * @return array (StageTechnicVersion object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = StageTechnicVersionTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = StageTechnicVersionTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + StageTechnicVersionTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = StageTechnicVersionTableMap::OM_CLASS;
            /** @var StageTechnicVersion $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            StageTechnicVersionTableMap::addInstanceToPool($obj, $key);
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
            $key = StageTechnicVersionTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = StageTechnicVersionTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var StageTechnicVersion $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                StageTechnicVersionTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(StageTechnicVersionTableMap::COL_ID);
            $criteria->addSelectColumn(StageTechnicVersionTableMap::COL_PRICE);
            $criteria->addSelectColumn(StageTechnicVersionTableMap::COL_AMOUNT);
            $criteria->addSelectColumn(StageTechnicVersionTableMap::COL_TECHNIC_ID);
            $criteria->addSelectColumn(StageTechnicVersionTableMap::COL_STAGE_ID);
            $criteria->addSelectColumn(StageTechnicVersionTableMap::COL_VERSION);
            $criteria->addSelectColumn(StageTechnicVersionTableMap::COL_STAGE_ID_VERSION);
            $criteria->addSelectColumn(StageTechnicVersionTableMap::COL_TECHNIC_ID_VERSION);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.price');
            $criteria->addSelectColumn($alias . '.amount');
            $criteria->addSelectColumn($alias . '.technic_id');
            $criteria->addSelectColumn($alias . '.stage_id');
            $criteria->addSelectColumn($alias . '.version');
            $criteria->addSelectColumn($alias . '.stage_id_version');
            $criteria->addSelectColumn($alias . '.technic_id_version');
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
            $criteria->removeSelectColumn(StageTechnicVersionTableMap::COL_ID);
            $criteria->removeSelectColumn(StageTechnicVersionTableMap::COL_PRICE);
            $criteria->removeSelectColumn(StageTechnicVersionTableMap::COL_AMOUNT);
            $criteria->removeSelectColumn(StageTechnicVersionTableMap::COL_TECHNIC_ID);
            $criteria->removeSelectColumn(StageTechnicVersionTableMap::COL_STAGE_ID);
            $criteria->removeSelectColumn(StageTechnicVersionTableMap::COL_VERSION);
            $criteria->removeSelectColumn(StageTechnicVersionTableMap::COL_STAGE_ID_VERSION);
            $criteria->removeSelectColumn(StageTechnicVersionTableMap::COL_TECHNIC_ID_VERSION);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.price');
            $criteria->removeSelectColumn($alias . '.amount');
            $criteria->removeSelectColumn($alias . '.technic_id');
            $criteria->removeSelectColumn($alias . '.stage_id');
            $criteria->removeSelectColumn($alias . '.version');
            $criteria->removeSelectColumn($alias . '.stage_id_version');
            $criteria->removeSelectColumn($alias . '.technic_id_version');
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
        return Propel::getServiceContainer()->getDatabaseMap(StageTechnicVersionTableMap::DATABASE_NAME)->getTable(StageTechnicVersionTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a StageTechnicVersion or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or StageTechnicVersion object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(StageTechnicVersionTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \DB\StageTechnicVersion) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(StageTechnicVersionTableMap::DATABASE_NAME);
            // primary key is composite; we therefore, expect
            // the primary key passed to be an array of pkey values
            if (count($values) == count($values, COUNT_RECURSIVE)) {
                // array is not multi-dimensional
                $values = [$values];
            }
            foreach ($values as $value) {
                $criterion = $criteria->getNewCriterion(StageTechnicVersionTableMap::COL_ID, $value[0]);
                $criterion->addAnd($criteria->getNewCriterion(StageTechnicVersionTableMap::COL_VERSION, $value[1]));
                $criteria->addOr($criterion);
            }
        }

        $query = StageTechnicVersionQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            StageTechnicVersionTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                StageTechnicVersionTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the stage_technic_version table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return StageTechnicVersionQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a StageTechnicVersion or Criteria object.
     *
     * @param mixed $criteria Criteria or StageTechnicVersion object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(StageTechnicVersionTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from StageTechnicVersion object
        }


        // Set the correct dbName
        $query = StageTechnicVersionQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
