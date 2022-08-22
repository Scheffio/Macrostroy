<?php

namespace DB\Map;

use DB\WorkTechnicVersion;
use DB\WorkTechnicVersionQuery;
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
 * This class defines the structure of the 'work_technic_version' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class WorkTechnicVersionTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'DB.Map.WorkTechnicVersionTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'work_technic_version';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'WorkTechnicVersion';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\DB\\WorkTechnicVersion';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'DB.WorkTechnicVersion';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 10;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 10;

    /**
     * the column name for the id field
     */
    public const COL_ID = 'work_technic_version.id';

    /**
     * the column name for the work_id field
     */
    public const COL_WORK_ID = 'work_technic_version.work_id';

    /**
     * the column name for the technic_id field
     */
    public const COL_TECHNIC_ID = 'work_technic_version.technic_id';

    /**
     * the column name for the amount field
     */
    public const COL_AMOUNT = 'work_technic_version.amount';

    /**
     * the column name for the version field
     */
    public const COL_VERSION = 'work_technic_version.version';

    /**
     * the column name for the version_created_at field
     */
    public const COL_VERSION_CREATED_AT = 'work_technic_version.version_created_at';

    /**
     * the column name for the version_created_by field
     */
    public const COL_VERSION_CREATED_BY = 'work_technic_version.version_created_by';

    /**
     * the column name for the version_comment field
     */
    public const COL_VERSION_COMMENT = 'work_technic_version.version_comment';

    /**
     * the column name for the work_id_version field
     */
    public const COL_WORK_ID_VERSION = 'work_technic_version.work_id_version';

    /**
     * the column name for the technic_id_version field
     */
    public const COL_TECHNIC_ID_VERSION = 'work_technic_version.technic_id_version';

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
        self::TYPE_PHPNAME       => ['Id', 'WorkId', 'TechnicId', 'Amount', 'Version', 'VersionCreatedAt', 'VersionCreatedBy', 'VersionComment', 'WorkIdVersion', 'TechnicIdVersion', ],
        self::TYPE_CAMELNAME     => ['id', 'workId', 'technicId', 'amount', 'version', 'versionCreatedAt', 'versionCreatedBy', 'versionComment', 'workIdVersion', 'technicIdVersion', ],
        self::TYPE_COLNAME       => [WorkTechnicVersionTableMap::COL_ID, WorkTechnicVersionTableMap::COL_WORK_ID, WorkTechnicVersionTableMap::COL_TECHNIC_ID, WorkTechnicVersionTableMap::COL_AMOUNT, WorkTechnicVersionTableMap::COL_VERSION, WorkTechnicVersionTableMap::COL_VERSION_CREATED_AT, WorkTechnicVersionTableMap::COL_VERSION_CREATED_BY, WorkTechnicVersionTableMap::COL_VERSION_COMMENT, WorkTechnicVersionTableMap::COL_WORK_ID_VERSION, WorkTechnicVersionTableMap::COL_TECHNIC_ID_VERSION, ],
        self::TYPE_FIELDNAME     => ['id', 'work_id', 'technic_id', 'amount', 'version', 'version_created_at', 'version_created_by', 'version_comment', 'work_id_version', 'technic_id_version', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, ]
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
        self::TYPE_PHPNAME       => ['Id' => 0, 'WorkId' => 1, 'TechnicId' => 2, 'Amount' => 3, 'Version' => 4, 'VersionCreatedAt' => 5, 'VersionCreatedBy' => 6, 'VersionComment' => 7, 'WorkIdVersion' => 8, 'TechnicIdVersion' => 9, ],
        self::TYPE_CAMELNAME     => ['id' => 0, 'workId' => 1, 'technicId' => 2, 'amount' => 3, 'version' => 4, 'versionCreatedAt' => 5, 'versionCreatedBy' => 6, 'versionComment' => 7, 'workIdVersion' => 8, 'technicIdVersion' => 9, ],
        self::TYPE_COLNAME       => [WorkTechnicVersionTableMap::COL_ID => 0, WorkTechnicVersionTableMap::COL_WORK_ID => 1, WorkTechnicVersionTableMap::COL_TECHNIC_ID => 2, WorkTechnicVersionTableMap::COL_AMOUNT => 3, WorkTechnicVersionTableMap::COL_VERSION => 4, WorkTechnicVersionTableMap::COL_VERSION_CREATED_AT => 5, WorkTechnicVersionTableMap::COL_VERSION_CREATED_BY => 6, WorkTechnicVersionTableMap::COL_VERSION_COMMENT => 7, WorkTechnicVersionTableMap::COL_WORK_ID_VERSION => 8, WorkTechnicVersionTableMap::COL_TECHNIC_ID_VERSION => 9, ],
        self::TYPE_FIELDNAME     => ['id' => 0, 'work_id' => 1, 'technic_id' => 2, 'amount' => 3, 'version' => 4, 'version_created_at' => 5, 'version_created_by' => 6, 'version_comment' => 7, 'work_id_version' => 8, 'technic_id_version' => 9, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'WorkTechnicVersion.Id' => 'ID',
        'id' => 'ID',
        'workTechnicVersion.id' => 'ID',
        'WorkTechnicVersionTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'work_technic_version.id' => 'ID',
        'WorkId' => 'WORK_ID',
        'WorkTechnicVersion.WorkId' => 'WORK_ID',
        'workId' => 'WORK_ID',
        'workTechnicVersion.workId' => 'WORK_ID',
        'WorkTechnicVersionTableMap::COL_WORK_ID' => 'WORK_ID',
        'COL_WORK_ID' => 'WORK_ID',
        'work_id' => 'WORK_ID',
        'work_technic_version.work_id' => 'WORK_ID',
        'TechnicId' => 'TECHNIC_ID',
        'WorkTechnicVersion.TechnicId' => 'TECHNIC_ID',
        'technicId' => 'TECHNIC_ID',
        'workTechnicVersion.technicId' => 'TECHNIC_ID',
        'WorkTechnicVersionTableMap::COL_TECHNIC_ID' => 'TECHNIC_ID',
        'COL_TECHNIC_ID' => 'TECHNIC_ID',
        'technic_id' => 'TECHNIC_ID',
        'work_technic_version.technic_id' => 'TECHNIC_ID',
        'Amount' => 'AMOUNT',
        'WorkTechnicVersion.Amount' => 'AMOUNT',
        'amount' => 'AMOUNT',
        'workTechnicVersion.amount' => 'AMOUNT',
        'WorkTechnicVersionTableMap::COL_AMOUNT' => 'AMOUNT',
        'COL_AMOUNT' => 'AMOUNT',
        'work_technic_version.amount' => 'AMOUNT',
        'Version' => 'VERSION',
        'WorkTechnicVersion.Version' => 'VERSION',
        'version' => 'VERSION',
        'workTechnicVersion.version' => 'VERSION',
        'WorkTechnicVersionTableMap::COL_VERSION' => 'VERSION',
        'COL_VERSION' => 'VERSION',
        'work_technic_version.version' => 'VERSION',
        'VersionCreatedAt' => 'VERSION_CREATED_AT',
        'WorkTechnicVersion.VersionCreatedAt' => 'VERSION_CREATED_AT',
        'versionCreatedAt' => 'VERSION_CREATED_AT',
        'workTechnicVersion.versionCreatedAt' => 'VERSION_CREATED_AT',
        'WorkTechnicVersionTableMap::COL_VERSION_CREATED_AT' => 'VERSION_CREATED_AT',
        'COL_VERSION_CREATED_AT' => 'VERSION_CREATED_AT',
        'version_created_at' => 'VERSION_CREATED_AT',
        'work_technic_version.version_created_at' => 'VERSION_CREATED_AT',
        'VersionCreatedBy' => 'VERSION_CREATED_BY',
        'WorkTechnicVersion.VersionCreatedBy' => 'VERSION_CREATED_BY',
        'versionCreatedBy' => 'VERSION_CREATED_BY',
        'workTechnicVersion.versionCreatedBy' => 'VERSION_CREATED_BY',
        'WorkTechnicVersionTableMap::COL_VERSION_CREATED_BY' => 'VERSION_CREATED_BY',
        'COL_VERSION_CREATED_BY' => 'VERSION_CREATED_BY',
        'version_created_by' => 'VERSION_CREATED_BY',
        'work_technic_version.version_created_by' => 'VERSION_CREATED_BY',
        'VersionComment' => 'VERSION_COMMENT',
        'WorkTechnicVersion.VersionComment' => 'VERSION_COMMENT',
        'versionComment' => 'VERSION_COMMENT',
        'workTechnicVersion.versionComment' => 'VERSION_COMMENT',
        'WorkTechnicVersionTableMap::COL_VERSION_COMMENT' => 'VERSION_COMMENT',
        'COL_VERSION_COMMENT' => 'VERSION_COMMENT',
        'version_comment' => 'VERSION_COMMENT',
        'work_technic_version.version_comment' => 'VERSION_COMMENT',
        'WorkIdVersion' => 'WORK_ID_VERSION',
        'WorkTechnicVersion.WorkIdVersion' => 'WORK_ID_VERSION',
        'workIdVersion' => 'WORK_ID_VERSION',
        'workTechnicVersion.workIdVersion' => 'WORK_ID_VERSION',
        'WorkTechnicVersionTableMap::COL_WORK_ID_VERSION' => 'WORK_ID_VERSION',
        'COL_WORK_ID_VERSION' => 'WORK_ID_VERSION',
        'work_id_version' => 'WORK_ID_VERSION',
        'work_technic_version.work_id_version' => 'WORK_ID_VERSION',
        'TechnicIdVersion' => 'TECHNIC_ID_VERSION',
        'WorkTechnicVersion.TechnicIdVersion' => 'TECHNIC_ID_VERSION',
        'technicIdVersion' => 'TECHNIC_ID_VERSION',
        'workTechnicVersion.technicIdVersion' => 'TECHNIC_ID_VERSION',
        'WorkTechnicVersionTableMap::COL_TECHNIC_ID_VERSION' => 'TECHNIC_ID_VERSION',
        'COL_TECHNIC_ID_VERSION' => 'TECHNIC_ID_VERSION',
        'technic_id_version' => 'TECHNIC_ID_VERSION',
        'work_technic_version.technic_id_version' => 'TECHNIC_ID_VERSION',
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
        $this->setName('work_technic_version');
        $this->setPhpName('WorkTechnicVersion');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\DB\\WorkTechnicVersion');
        $this->setPackage('DB');
        $this->setUseIdGenerator(false);
        // columns
        $this->addForeignPrimaryKey('id', 'Id', 'INTEGER' , 'work_technic', 'id', true, null, null);
        $this->addColumn('work_id', 'WorkId', 'INTEGER', true, null, null);
        $this->addColumn('technic_id', 'TechnicId', 'INTEGER', true, null, null);
        $this->addColumn('amount', 'Amount', 'DECIMAL', true, 19, null);
        $this->addPrimaryKey('version', 'Version', 'INTEGER', true, null, 0);
        $this->addColumn('version_created_at', 'VersionCreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('version_created_by', 'VersionCreatedBy', 'VARCHAR', false, 100, null);
        $this->addColumn('version_comment', 'VersionComment', 'VARCHAR', false, 255, null);
        $this->addColumn('work_id_version', 'WorkIdVersion', 'INTEGER', false, null, 0);
        $this->addColumn('technic_id_version', 'TechnicIdVersion', 'INTEGER', false, null, 0);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('WorkTechnic', '\\DB\\WorkTechnic', RelationMap::MANY_TO_ONE, array (
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
     * @param \DB\WorkTechnicVersion $obj A \DB\WorkTechnicVersion object.
     * @param string|null $key Key (optional) to use for instance map (for performance boost if key was already calculated externally).
     *
     * @return void
     */
    public static function addInstanceToPool(WorkTechnicVersion $obj, ?string $key = null): void
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
     * @param mixed $value A \DB\WorkTechnicVersion object or a primary key value.
     *
     * @return void
     */
    public static function removeInstanceFromPool($value): void
    {
        if (Propel::isInstancePoolingEnabled() && null !== $value) {
            if (is_object($value) && $value instanceof \DB\WorkTechnicVersion) {
                $key = serialize([(null === $value->getId() || is_scalar($value->getId()) || is_callable([$value->getId(), '__toString']) ? (string) $value->getId() : $value->getId()), (null === $value->getVersion() || is_scalar($value->getVersion()) || is_callable([$value->getVersion(), '__toString']) ? (string) $value->getVersion() : $value->getVersion())]);

            } elseif (is_array($value) && count($value) === 2) {
                // assume we've been passed a primary key";
                $key = serialize([(null === $value[0] || is_scalar($value[0]) || is_callable([$value[0], '__toString']) ? (string) $value[0] : $value[0]), (null === $value[1] || is_scalar($value[1]) || is_callable([$value[1], '__toString']) ? (string) $value[1] : $value[1])]);
            } elseif ($value instanceof Criteria) {
                self::$instances = [];

                return;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or \DB\WorkTechnicVersion object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value, true)));
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null && $row[TableMap::TYPE_NUM == $indexType ? 4 + $offset : static::translateFieldName('Version', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return serialize([(null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]), (null === $row[TableMap::TYPE_NUM == $indexType ? 4 + $offset : static::translateFieldName('Version', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 4 + $offset : static::translateFieldName('Version', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 4 + $offset : static::translateFieldName('Version', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 4 + $offset : static::translateFieldName('Version', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 4 + $offset : static::translateFieldName('Version', TableMap::TYPE_PHPNAME, $indexType)])]);
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
                ? 4 + $offset
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
        return $withPrefix ? WorkTechnicVersionTableMap::CLASS_DEFAULT : WorkTechnicVersionTableMap::OM_CLASS;
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
     * @return array (WorkTechnicVersion object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = WorkTechnicVersionTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = WorkTechnicVersionTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + WorkTechnicVersionTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = WorkTechnicVersionTableMap::OM_CLASS;
            /** @var WorkTechnicVersion $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            WorkTechnicVersionTableMap::addInstanceToPool($obj, $key);
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
            $key = WorkTechnicVersionTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = WorkTechnicVersionTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var WorkTechnicVersion $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                WorkTechnicVersionTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(WorkTechnicVersionTableMap::COL_ID);
            $criteria->addSelectColumn(WorkTechnicVersionTableMap::COL_WORK_ID);
            $criteria->addSelectColumn(WorkTechnicVersionTableMap::COL_TECHNIC_ID);
            $criteria->addSelectColumn(WorkTechnicVersionTableMap::COL_AMOUNT);
            $criteria->addSelectColumn(WorkTechnicVersionTableMap::COL_VERSION);
            $criteria->addSelectColumn(WorkTechnicVersionTableMap::COL_VERSION_CREATED_AT);
            $criteria->addSelectColumn(WorkTechnicVersionTableMap::COL_VERSION_CREATED_BY);
            $criteria->addSelectColumn(WorkTechnicVersionTableMap::COL_VERSION_COMMENT);
            $criteria->addSelectColumn(WorkTechnicVersionTableMap::COL_WORK_ID_VERSION);
            $criteria->addSelectColumn(WorkTechnicVersionTableMap::COL_TECHNIC_ID_VERSION);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.work_id');
            $criteria->addSelectColumn($alias . '.technic_id');
            $criteria->addSelectColumn($alias . '.amount');
            $criteria->addSelectColumn($alias . '.version');
            $criteria->addSelectColumn($alias . '.version_created_at');
            $criteria->addSelectColumn($alias . '.version_created_by');
            $criteria->addSelectColumn($alias . '.version_comment');
            $criteria->addSelectColumn($alias . '.work_id_version');
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
            $criteria->removeSelectColumn(WorkTechnicVersionTableMap::COL_ID);
            $criteria->removeSelectColumn(WorkTechnicVersionTableMap::COL_WORK_ID);
            $criteria->removeSelectColumn(WorkTechnicVersionTableMap::COL_TECHNIC_ID);
            $criteria->removeSelectColumn(WorkTechnicVersionTableMap::COL_AMOUNT);
            $criteria->removeSelectColumn(WorkTechnicVersionTableMap::COL_VERSION);
            $criteria->removeSelectColumn(WorkTechnicVersionTableMap::COL_VERSION_CREATED_AT);
            $criteria->removeSelectColumn(WorkTechnicVersionTableMap::COL_VERSION_CREATED_BY);
            $criteria->removeSelectColumn(WorkTechnicVersionTableMap::COL_VERSION_COMMENT);
            $criteria->removeSelectColumn(WorkTechnicVersionTableMap::COL_WORK_ID_VERSION);
            $criteria->removeSelectColumn(WorkTechnicVersionTableMap::COL_TECHNIC_ID_VERSION);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.work_id');
            $criteria->removeSelectColumn($alias . '.technic_id');
            $criteria->removeSelectColumn($alias . '.amount');
            $criteria->removeSelectColumn($alias . '.version');
            $criteria->removeSelectColumn($alias . '.version_created_at');
            $criteria->removeSelectColumn($alias . '.version_created_by');
            $criteria->removeSelectColumn($alias . '.version_comment');
            $criteria->removeSelectColumn($alias . '.work_id_version');
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
        return Propel::getServiceContainer()->getDatabaseMap(WorkTechnicVersionTableMap::DATABASE_NAME)->getTable(WorkTechnicVersionTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a WorkTechnicVersion or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or WorkTechnicVersion object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(WorkTechnicVersionTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \DB\WorkTechnicVersion) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(WorkTechnicVersionTableMap::DATABASE_NAME);
            // primary key is composite; we therefore, expect
            // the primary key passed to be an array of pkey values
            if (count($values) == count($values, COUNT_RECURSIVE)) {
                // array is not multi-dimensional
                $values = [$values];
            }
            foreach ($values as $value) {
                $criterion = $criteria->getNewCriterion(WorkTechnicVersionTableMap::COL_ID, $value[0]);
                $criterion->addAnd($criteria->getNewCriterion(WorkTechnicVersionTableMap::COL_VERSION, $value[1]));
                $criteria->addOr($criterion);
            }
        }

        $query = WorkTechnicVersionQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            WorkTechnicVersionTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                WorkTechnicVersionTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the work_technic_version table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return WorkTechnicVersionQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a WorkTechnicVersion or Criteria object.
     *
     * @param mixed $criteria Criteria or WorkTechnicVersion object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(WorkTechnicVersionTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from WorkTechnicVersion object
        }


        // Set the correct dbName
        $query = WorkTechnicVersionQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
