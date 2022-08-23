<?php

namespace DB\Map;

use DB\StageTechnic;
use DB\StageTechnicQuery;
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
 * This class defines the structure of the 'stage_technic' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class StageTechnicTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'DB.Map.StageTechnicTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'stage_technic';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'StageTechnic';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\DB\\StageTechnic';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'DB.StageTechnic';

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
    public const COL_ID = 'stage_technic.id';

    /**
     * the column name for the price field
     */
    public const COL_PRICE = 'stage_technic.price';

    /**
     * the column name for the amount field
     */
    public const COL_AMOUNT = 'stage_technic.amount';

    /**
     * the column name for the is_available field
     */
    public const COL_IS_AVAILABLE = 'stage_technic.is_available';

    /**
     * the column name for the technic_id field
     */
    public const COL_TECHNIC_ID = 'stage_technic.technic_id';

    /**
     * the column name for the stage_work_id field
     */
    public const COL_STAGE_WORK_ID = 'stage_technic.stage_work_id';

    /**
     * the column name for the version field
     */
    public const COL_VERSION = 'stage_technic.version';

    /**
     * the column name for the version_created_at field
     */
    public const COL_VERSION_CREATED_AT = 'stage_technic.version_created_at';

    /**
     * the column name for the version_created_by field
     */
    public const COL_VERSION_CREATED_BY = 'stage_technic.version_created_by';

    /**
     * the column name for the version_comment field
     */
    public const COL_VERSION_COMMENT = 'stage_technic.version_comment';

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
        self::TYPE_PHPNAME       => ['Id', 'Price', 'Amount', 'IsAvailable', 'TechnicId', 'StageWorkId', 'Version', 'VersionCreatedAt', 'VersionCreatedBy', 'VersionComment', ],
        self::TYPE_CAMELNAME     => ['id', 'price', 'amount', 'isAvailable', 'technicId', 'stageWorkId', 'version', 'versionCreatedAt', 'versionCreatedBy', 'versionComment', ],
        self::TYPE_COLNAME       => [StageTechnicTableMap::COL_ID, StageTechnicTableMap::COL_PRICE, StageTechnicTableMap::COL_AMOUNT, StageTechnicTableMap::COL_IS_AVAILABLE, StageTechnicTableMap::COL_TECHNIC_ID, StageTechnicTableMap::COL_STAGE_WORK_ID, StageTechnicTableMap::COL_VERSION, StageTechnicTableMap::COL_VERSION_CREATED_AT, StageTechnicTableMap::COL_VERSION_CREATED_BY, StageTechnicTableMap::COL_VERSION_COMMENT, ],
        self::TYPE_FIELDNAME     => ['id', 'price', 'amount', 'is_available', 'technic_id', 'stage_work_id', 'version', 'version_created_at', 'version_created_by', 'version_comment', ],
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
        self::TYPE_PHPNAME       => ['Id' => 0, 'Price' => 1, 'Amount' => 2, 'IsAvailable' => 3, 'TechnicId' => 4, 'StageWorkId' => 5, 'Version' => 6, 'VersionCreatedAt' => 7, 'VersionCreatedBy' => 8, 'VersionComment' => 9, ],
        self::TYPE_CAMELNAME     => ['id' => 0, 'price' => 1, 'amount' => 2, 'isAvailable' => 3, 'technicId' => 4, 'stageWorkId' => 5, 'version' => 6, 'versionCreatedAt' => 7, 'versionCreatedBy' => 8, 'versionComment' => 9, ],
        self::TYPE_COLNAME       => [StageTechnicTableMap::COL_ID => 0, StageTechnicTableMap::COL_PRICE => 1, StageTechnicTableMap::COL_AMOUNT => 2, StageTechnicTableMap::COL_IS_AVAILABLE => 3, StageTechnicTableMap::COL_TECHNIC_ID => 4, StageTechnicTableMap::COL_STAGE_WORK_ID => 5, StageTechnicTableMap::COL_VERSION => 6, StageTechnicTableMap::COL_VERSION_CREATED_AT => 7, StageTechnicTableMap::COL_VERSION_CREATED_BY => 8, StageTechnicTableMap::COL_VERSION_COMMENT => 9, ],
        self::TYPE_FIELDNAME     => ['id' => 0, 'price' => 1, 'amount' => 2, 'is_available' => 3, 'technic_id' => 4, 'stage_work_id' => 5, 'version' => 6, 'version_created_at' => 7, 'version_created_by' => 8, 'version_comment' => 9, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'StageTechnic.Id' => 'ID',
        'id' => 'ID',
        'stageTechnic.id' => 'ID',
        'StageTechnicTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'stage_technic.id' => 'ID',
        'Price' => 'PRICE',
        'StageTechnic.Price' => 'PRICE',
        'price' => 'PRICE',
        'stageTechnic.price' => 'PRICE',
        'StageTechnicTableMap::COL_PRICE' => 'PRICE',
        'COL_PRICE' => 'PRICE',
        'stage_technic.price' => 'PRICE',
        'Amount' => 'AMOUNT',
        'StageTechnic.Amount' => 'AMOUNT',
        'amount' => 'AMOUNT',
        'stageTechnic.amount' => 'AMOUNT',
        'StageTechnicTableMap::COL_AMOUNT' => 'AMOUNT',
        'COL_AMOUNT' => 'AMOUNT',
        'stage_technic.amount' => 'AMOUNT',
        'IsAvailable' => 'IS_AVAILABLE',
        'StageTechnic.IsAvailable' => 'IS_AVAILABLE',
        'isAvailable' => 'IS_AVAILABLE',
        'stageTechnic.isAvailable' => 'IS_AVAILABLE',
        'StageTechnicTableMap::COL_IS_AVAILABLE' => 'IS_AVAILABLE',
        'COL_IS_AVAILABLE' => 'IS_AVAILABLE',
        'is_available' => 'IS_AVAILABLE',
        'stage_technic.is_available' => 'IS_AVAILABLE',
        'TechnicId' => 'TECHNIC_ID',
        'StageTechnic.TechnicId' => 'TECHNIC_ID',
        'technicId' => 'TECHNIC_ID',
        'stageTechnic.technicId' => 'TECHNIC_ID',
        'StageTechnicTableMap::COL_TECHNIC_ID' => 'TECHNIC_ID',
        'COL_TECHNIC_ID' => 'TECHNIC_ID',
        'technic_id' => 'TECHNIC_ID',
        'stage_technic.technic_id' => 'TECHNIC_ID',
        'StageWorkId' => 'STAGE_WORK_ID',
        'StageTechnic.StageWorkId' => 'STAGE_WORK_ID',
        'stageWorkId' => 'STAGE_WORK_ID',
        'stageTechnic.stageWorkId' => 'STAGE_WORK_ID',
        'StageTechnicTableMap::COL_STAGE_WORK_ID' => 'STAGE_WORK_ID',
        'COL_STAGE_WORK_ID' => 'STAGE_WORK_ID',
        'stage_work_id' => 'STAGE_WORK_ID',
        'stage_technic.stage_work_id' => 'STAGE_WORK_ID',
        'Version' => 'VERSION',
        'StageTechnic.Version' => 'VERSION',
        'version' => 'VERSION',
        'stageTechnic.version' => 'VERSION',
        'StageTechnicTableMap::COL_VERSION' => 'VERSION',
        'COL_VERSION' => 'VERSION',
        'stage_technic.version' => 'VERSION',
        'VersionCreatedAt' => 'VERSION_CREATED_AT',
        'StageTechnic.VersionCreatedAt' => 'VERSION_CREATED_AT',
        'versionCreatedAt' => 'VERSION_CREATED_AT',
        'stageTechnic.versionCreatedAt' => 'VERSION_CREATED_AT',
        'StageTechnicTableMap::COL_VERSION_CREATED_AT' => 'VERSION_CREATED_AT',
        'COL_VERSION_CREATED_AT' => 'VERSION_CREATED_AT',
        'version_created_at' => 'VERSION_CREATED_AT',
        'stage_technic.version_created_at' => 'VERSION_CREATED_AT',
        'VersionCreatedBy' => 'VERSION_CREATED_BY',
        'StageTechnic.VersionCreatedBy' => 'VERSION_CREATED_BY',
        'versionCreatedBy' => 'VERSION_CREATED_BY',
        'stageTechnic.versionCreatedBy' => 'VERSION_CREATED_BY',
        'StageTechnicTableMap::COL_VERSION_CREATED_BY' => 'VERSION_CREATED_BY',
        'COL_VERSION_CREATED_BY' => 'VERSION_CREATED_BY',
        'version_created_by' => 'VERSION_CREATED_BY',
        'stage_technic.version_created_by' => 'VERSION_CREATED_BY',
        'VersionComment' => 'VERSION_COMMENT',
        'StageTechnic.VersionComment' => 'VERSION_COMMENT',
        'versionComment' => 'VERSION_COMMENT',
        'stageTechnic.versionComment' => 'VERSION_COMMENT',
        'StageTechnicTableMap::COL_VERSION_COMMENT' => 'VERSION_COMMENT',
        'COL_VERSION_COMMENT' => 'VERSION_COMMENT',
        'version_comment' => 'VERSION_COMMENT',
        'stage_technic.version_comment' => 'VERSION_COMMENT',
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
        $this->setName('stage_technic');
        $this->setPhpName('StageTechnic');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\DB\\StageTechnic');
        $this->setPackage('DB');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('price', 'Price', 'DECIMAL', true, 19, null);
        $this->addColumn('amount', 'Amount', 'DECIMAL', true, 19, null);
        $this->addColumn('is_available', 'IsAvailable', 'BOOLEAN', true, 1, true);
        $this->addForeignKey('technic_id', 'TechnicId', 'INTEGER', 'technic', 'id', true, null, null);
        $this->addForeignKey('stage_work_id', 'StageWorkId', 'INTEGER', 'stage_work', 'id', true, null, null);
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
        $this->addRelation('StageWork', '\\DB\\StageWork', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':stage_work_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('Technic', '\\DB\\Technic', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':technic_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('StageTechnicVersion', '\\DB\\StageTechnicVersion', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':id',
    1 => ':id',
  ),
), 'CASCADE', null, 'StageTechnicVersions', false);
    }

    /**
     * Method to invalidate the instance pool of all tables related to stage_technic     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool(): void
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        StageTechnicVersionTableMap::clearInstancePool();
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
        return $withPrefix ? StageTechnicTableMap::CLASS_DEFAULT : StageTechnicTableMap::OM_CLASS;
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
     * @return array (StageTechnic object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = StageTechnicTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = StageTechnicTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + StageTechnicTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = StageTechnicTableMap::OM_CLASS;
            /** @var StageTechnic $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            StageTechnicTableMap::addInstanceToPool($obj, $key);
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
            $key = StageTechnicTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = StageTechnicTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var StageTechnic $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                StageTechnicTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(StageTechnicTableMap::COL_ID);
            $criteria->addSelectColumn(StageTechnicTableMap::COL_PRICE);
            $criteria->addSelectColumn(StageTechnicTableMap::COL_AMOUNT);
            $criteria->addSelectColumn(StageTechnicTableMap::COL_IS_AVAILABLE);
            $criteria->addSelectColumn(StageTechnicTableMap::COL_TECHNIC_ID);
            $criteria->addSelectColumn(StageTechnicTableMap::COL_STAGE_WORK_ID);
            $criteria->addSelectColumn(StageTechnicTableMap::COL_VERSION);
            $criteria->addSelectColumn(StageTechnicTableMap::COL_VERSION_CREATED_AT);
            $criteria->addSelectColumn(StageTechnicTableMap::COL_VERSION_CREATED_BY);
            $criteria->addSelectColumn(StageTechnicTableMap::COL_VERSION_COMMENT);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.price');
            $criteria->addSelectColumn($alias . '.amount');
            $criteria->addSelectColumn($alias . '.is_available');
            $criteria->addSelectColumn($alias . '.technic_id');
            $criteria->addSelectColumn($alias . '.stage_work_id');
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
            $criteria->removeSelectColumn(StageTechnicTableMap::COL_ID);
            $criteria->removeSelectColumn(StageTechnicTableMap::COL_PRICE);
            $criteria->removeSelectColumn(StageTechnicTableMap::COL_AMOUNT);
            $criteria->removeSelectColumn(StageTechnicTableMap::COL_IS_AVAILABLE);
            $criteria->removeSelectColumn(StageTechnicTableMap::COL_TECHNIC_ID);
            $criteria->removeSelectColumn(StageTechnicTableMap::COL_STAGE_WORK_ID);
            $criteria->removeSelectColumn(StageTechnicTableMap::COL_VERSION);
            $criteria->removeSelectColumn(StageTechnicTableMap::COL_VERSION_CREATED_AT);
            $criteria->removeSelectColumn(StageTechnicTableMap::COL_VERSION_CREATED_BY);
            $criteria->removeSelectColumn(StageTechnicTableMap::COL_VERSION_COMMENT);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.price');
            $criteria->removeSelectColumn($alias . '.amount');
            $criteria->removeSelectColumn($alias . '.is_available');
            $criteria->removeSelectColumn($alias . '.technic_id');
            $criteria->removeSelectColumn($alias . '.stage_work_id');
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
        return Propel::getServiceContainer()->getDatabaseMap(StageTechnicTableMap::DATABASE_NAME)->getTable(StageTechnicTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a StageTechnic or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or StageTechnic object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(StageTechnicTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \DB\StageTechnic) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(StageTechnicTableMap::DATABASE_NAME);
            $criteria->add(StageTechnicTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = StageTechnicQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            StageTechnicTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                StageTechnicTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the stage_technic table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return StageTechnicQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a StageTechnic or Criteria object.
     *
     * @param mixed $criteria Criteria or StageTechnic object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(StageTechnicTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from StageTechnic object
        }

        if ($criteria->containsKey(StageTechnicTableMap::COL_ID) && $criteria->keyContainsValue(StageTechnicTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.StageTechnicTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = StageTechnicQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
