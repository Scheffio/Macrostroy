<?php

namespace DB\Map;

use DB\ObjStageWork;
use DB\ObjStageWorkQuery;
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
 * This class defines the structure of the 'obj_stage_work' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class ObjStageWorkTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'DB.Map.ObjStageWorkTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'obj_stage_work';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'ObjStageWork';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\DB\\ObjStageWork';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'DB.ObjStageWork';

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
    public const COL_ID = 'obj_stage_work.id';

    /**
     * the column name for the price field
     */
    public const COL_PRICE = 'obj_stage_work.price';

    /**
     * the column name for the amount field
     */
    public const COL_AMOUNT = 'obj_stage_work.amount';

    /**
     * the column name for the is_available field
     */
    public const COL_IS_AVAILABLE = 'obj_stage_work.is_available';

    /**
     * the column name for the work_id field
     */
    public const COL_WORK_ID = 'obj_stage_work.work_id';

    /**
     * the column name for the stage_id field
     */
    public const COL_STAGE_ID = 'obj_stage_work.stage_id';

    /**
     * the column name for the version_created_by field
     */
    public const COL_VERSION_CREATED_BY = 'obj_stage_work.version_created_by';

    /**
     * the column name for the version field
     */
    public const COL_VERSION = 'obj_stage_work.version';

    /**
     * the column name for the version_created_at field
     */
    public const COL_VERSION_CREATED_AT = 'obj_stage_work.version_created_at';

    /**
     * the column name for the version_comment field
     */
    public const COL_VERSION_COMMENT = 'obj_stage_work.version_comment';

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
        self::TYPE_PHPNAME       => ['Id', 'Price', 'Amount', 'IsAvailable', 'WorkId', 'StageId', 'VersionCreatedBy', 'Version', 'VersionCreatedAt', 'VersionComment', ],
        self::TYPE_CAMELNAME     => ['id', 'price', 'amount', 'isAvailable', 'workId', 'stageId', 'versionCreatedBy', 'version', 'versionCreatedAt', 'versionComment', ],
        self::TYPE_COLNAME       => [ObjStageWorkTableMap::COL_ID, ObjStageWorkTableMap::COL_PRICE, ObjStageWorkTableMap::COL_AMOUNT, ObjStageWorkTableMap::COL_IS_AVAILABLE, ObjStageWorkTableMap::COL_WORK_ID, ObjStageWorkTableMap::COL_STAGE_ID, ObjStageWorkTableMap::COL_VERSION_CREATED_BY, ObjStageWorkTableMap::COL_VERSION, ObjStageWorkTableMap::COL_VERSION_CREATED_AT, ObjStageWorkTableMap::COL_VERSION_COMMENT, ],
        self::TYPE_FIELDNAME     => ['id', 'price', 'amount', 'is_available', 'work_id', 'stage_id', 'version_created_by', 'version', 'version_created_at', 'version_comment', ],
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
        self::TYPE_PHPNAME       => ['Id' => 0, 'Price' => 1, 'Amount' => 2, 'IsAvailable' => 3, 'WorkId' => 4, 'StageId' => 5, 'VersionCreatedBy' => 6, 'Version' => 7, 'VersionCreatedAt' => 8, 'VersionComment' => 9, ],
        self::TYPE_CAMELNAME     => ['id' => 0, 'price' => 1, 'amount' => 2, 'isAvailable' => 3, 'workId' => 4, 'stageId' => 5, 'versionCreatedBy' => 6, 'version' => 7, 'versionCreatedAt' => 8, 'versionComment' => 9, ],
        self::TYPE_COLNAME       => [ObjStageWorkTableMap::COL_ID => 0, ObjStageWorkTableMap::COL_PRICE => 1, ObjStageWorkTableMap::COL_AMOUNT => 2, ObjStageWorkTableMap::COL_IS_AVAILABLE => 3, ObjStageWorkTableMap::COL_WORK_ID => 4, ObjStageWorkTableMap::COL_STAGE_ID => 5, ObjStageWorkTableMap::COL_VERSION_CREATED_BY => 6, ObjStageWorkTableMap::COL_VERSION => 7, ObjStageWorkTableMap::COL_VERSION_CREATED_AT => 8, ObjStageWorkTableMap::COL_VERSION_COMMENT => 9, ],
        self::TYPE_FIELDNAME     => ['id' => 0, 'price' => 1, 'amount' => 2, 'is_available' => 3, 'work_id' => 4, 'stage_id' => 5, 'version_created_by' => 6, 'version' => 7, 'version_created_at' => 8, 'version_comment' => 9, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'ObjStageWork.Id' => 'ID',
        'id' => 'ID',
        'objStageWork.id' => 'ID',
        'ObjStageWorkTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'obj_stage_work.id' => 'ID',
        'Price' => 'PRICE',
        'ObjStageWork.Price' => 'PRICE',
        'price' => 'PRICE',
        'objStageWork.price' => 'PRICE',
        'ObjStageWorkTableMap::COL_PRICE' => 'PRICE',
        'COL_PRICE' => 'PRICE',
        'obj_stage_work.price' => 'PRICE',
        'Amount' => 'AMOUNT',
        'ObjStageWork.Amount' => 'AMOUNT',
        'amount' => 'AMOUNT',
        'objStageWork.amount' => 'AMOUNT',
        'ObjStageWorkTableMap::COL_AMOUNT' => 'AMOUNT',
        'COL_AMOUNT' => 'AMOUNT',
        'obj_stage_work.amount' => 'AMOUNT',
        'IsAvailable' => 'IS_AVAILABLE',
        'ObjStageWork.IsAvailable' => 'IS_AVAILABLE',
        'isAvailable' => 'IS_AVAILABLE',
        'objStageWork.isAvailable' => 'IS_AVAILABLE',
        'ObjStageWorkTableMap::COL_IS_AVAILABLE' => 'IS_AVAILABLE',
        'COL_IS_AVAILABLE' => 'IS_AVAILABLE',
        'is_available' => 'IS_AVAILABLE',
        'obj_stage_work.is_available' => 'IS_AVAILABLE',
        'WorkId' => 'WORK_ID',
        'ObjStageWork.WorkId' => 'WORK_ID',
        'workId' => 'WORK_ID',
        'objStageWork.workId' => 'WORK_ID',
        'ObjStageWorkTableMap::COL_WORK_ID' => 'WORK_ID',
        'COL_WORK_ID' => 'WORK_ID',
        'work_id' => 'WORK_ID',
        'obj_stage_work.work_id' => 'WORK_ID',
        'StageId' => 'STAGE_ID',
        'ObjStageWork.StageId' => 'STAGE_ID',
        'stageId' => 'STAGE_ID',
        'objStageWork.stageId' => 'STAGE_ID',
        'ObjStageWorkTableMap::COL_STAGE_ID' => 'STAGE_ID',
        'COL_STAGE_ID' => 'STAGE_ID',
        'stage_id' => 'STAGE_ID',
        'obj_stage_work.stage_id' => 'STAGE_ID',
        'VersionCreatedBy' => 'VERSION_CREATED_BY',
        'ObjStageWork.VersionCreatedBy' => 'VERSION_CREATED_BY',
        'versionCreatedBy' => 'VERSION_CREATED_BY',
        'objStageWork.versionCreatedBy' => 'VERSION_CREATED_BY',
        'ObjStageWorkTableMap::COL_VERSION_CREATED_BY' => 'VERSION_CREATED_BY',
        'COL_VERSION_CREATED_BY' => 'VERSION_CREATED_BY',
        'version_created_by' => 'VERSION_CREATED_BY',
        'obj_stage_work.version_created_by' => 'VERSION_CREATED_BY',
        'Version' => 'VERSION',
        'ObjStageWork.Version' => 'VERSION',
        'version' => 'VERSION',
        'objStageWork.version' => 'VERSION',
        'ObjStageWorkTableMap::COL_VERSION' => 'VERSION',
        'COL_VERSION' => 'VERSION',
        'obj_stage_work.version' => 'VERSION',
        'VersionCreatedAt' => 'VERSION_CREATED_AT',
        'ObjStageWork.VersionCreatedAt' => 'VERSION_CREATED_AT',
        'versionCreatedAt' => 'VERSION_CREATED_AT',
        'objStageWork.versionCreatedAt' => 'VERSION_CREATED_AT',
        'ObjStageWorkTableMap::COL_VERSION_CREATED_AT' => 'VERSION_CREATED_AT',
        'COL_VERSION_CREATED_AT' => 'VERSION_CREATED_AT',
        'version_created_at' => 'VERSION_CREATED_AT',
        'obj_stage_work.version_created_at' => 'VERSION_CREATED_AT',
        'VersionComment' => 'VERSION_COMMENT',
        'ObjStageWork.VersionComment' => 'VERSION_COMMENT',
        'versionComment' => 'VERSION_COMMENT',
        'objStageWork.versionComment' => 'VERSION_COMMENT',
        'ObjStageWorkTableMap::COL_VERSION_COMMENT' => 'VERSION_COMMENT',
        'COL_VERSION_COMMENT' => 'VERSION_COMMENT',
        'version_comment' => 'VERSION_COMMENT',
        'obj_stage_work.version_comment' => 'VERSION_COMMENT',
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
        $this->setName('obj_stage_work');
        $this->setPhpName('ObjStageWork');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\DB\\ObjStageWork');
        $this->setPackage('DB');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('price', 'Price', 'DECIMAL', true, 19, null);
        $this->addColumn('amount', 'Amount', 'DECIMAL', true, 19, null);
        $this->addColumn('is_available', 'IsAvailable', 'BOOLEAN', true, 1, true);
        $this->addForeignKey('work_id', 'WorkId', 'INTEGER', 'vol_work', 'id', true, null, null);
        $this->addForeignKey('stage_id', 'StageId', 'INTEGER', 'obj_stage', 'id', true, null, null);
        $this->addForeignKey('version_created_by', 'VersionCreatedBy', 'INTEGER', 'users', 'id', true, null, null);
        $this->addColumn('version', 'Version', 'INTEGER', false, null, 0);
        $this->addColumn('version_created_at', 'VersionCreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('version_comment', 'VersionComment', 'VARCHAR', false, 255, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Users', '\\DB\\Users', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':version_created_by',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('VolWork', '\\DB\\VolWork', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':work_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('ObjStage', '\\DB\\ObjStage', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':stage_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('ObjStageMaterial', '\\DB\\ObjStageMaterial', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':stage_work_id',
    1 => ':id',
  ),
), null, null, 'ObjStageMaterials', false);
        $this->addRelation('ObjStageTechnic', '\\DB\\ObjStageTechnic', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':stage_work_id',
    1 => ':id',
  ),
), null, null, 'ObjStageTechnics', false);
        $this->addRelation('ObjStageWorkVersion', '\\DB\\ObjStageWorkVersion', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':id',
    1 => ':id',
  ),
), 'CASCADE', null, 'ObjStageWorkVersions', false);
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
     * Method to invalidate the instance pool of all tables related to obj_stage_work     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool(): void
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        ObjStageWorkVersionTableMap::clearInstancePool();
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
        return $withPrefix ? ObjStageWorkTableMap::CLASS_DEFAULT : ObjStageWorkTableMap::OM_CLASS;
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
     * @return array (ObjStageWork object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = ObjStageWorkTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ObjStageWorkTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ObjStageWorkTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ObjStageWorkTableMap::OM_CLASS;
            /** @var ObjStageWork $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ObjStageWorkTableMap::addInstanceToPool($obj, $key);
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
            $key = ObjStageWorkTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ObjStageWorkTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var ObjStageWork $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ObjStageWorkTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ObjStageWorkTableMap::COL_ID);
            $criteria->addSelectColumn(ObjStageWorkTableMap::COL_PRICE);
            $criteria->addSelectColumn(ObjStageWorkTableMap::COL_AMOUNT);
            $criteria->addSelectColumn(ObjStageWorkTableMap::COL_IS_AVAILABLE);
            $criteria->addSelectColumn(ObjStageWorkTableMap::COL_WORK_ID);
            $criteria->addSelectColumn(ObjStageWorkTableMap::COL_STAGE_ID);
            $criteria->addSelectColumn(ObjStageWorkTableMap::COL_VERSION_CREATED_BY);
            $criteria->addSelectColumn(ObjStageWorkTableMap::COL_VERSION);
            $criteria->addSelectColumn(ObjStageWorkTableMap::COL_VERSION_CREATED_AT);
            $criteria->addSelectColumn(ObjStageWorkTableMap::COL_VERSION_COMMENT);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.price');
            $criteria->addSelectColumn($alias . '.amount');
            $criteria->addSelectColumn($alias . '.is_available');
            $criteria->addSelectColumn($alias . '.work_id');
            $criteria->addSelectColumn($alias . '.stage_id');
            $criteria->addSelectColumn($alias . '.version_created_by');
            $criteria->addSelectColumn($alias . '.version');
            $criteria->addSelectColumn($alias . '.version_created_at');
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
            $criteria->removeSelectColumn(ObjStageWorkTableMap::COL_ID);
            $criteria->removeSelectColumn(ObjStageWorkTableMap::COL_PRICE);
            $criteria->removeSelectColumn(ObjStageWorkTableMap::COL_AMOUNT);
            $criteria->removeSelectColumn(ObjStageWorkTableMap::COL_IS_AVAILABLE);
            $criteria->removeSelectColumn(ObjStageWorkTableMap::COL_WORK_ID);
            $criteria->removeSelectColumn(ObjStageWorkTableMap::COL_STAGE_ID);
            $criteria->removeSelectColumn(ObjStageWorkTableMap::COL_VERSION_CREATED_BY);
            $criteria->removeSelectColumn(ObjStageWorkTableMap::COL_VERSION);
            $criteria->removeSelectColumn(ObjStageWorkTableMap::COL_VERSION_CREATED_AT);
            $criteria->removeSelectColumn(ObjStageWorkTableMap::COL_VERSION_COMMENT);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.price');
            $criteria->removeSelectColumn($alias . '.amount');
            $criteria->removeSelectColumn($alias . '.is_available');
            $criteria->removeSelectColumn($alias . '.work_id');
            $criteria->removeSelectColumn($alias . '.stage_id');
            $criteria->removeSelectColumn($alias . '.version_created_by');
            $criteria->removeSelectColumn($alias . '.version');
            $criteria->removeSelectColumn($alias . '.version_created_at');
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
        return Propel::getServiceContainer()->getDatabaseMap(ObjStageWorkTableMap::DATABASE_NAME)->getTable(ObjStageWorkTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a ObjStageWork or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or ObjStageWork object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ObjStageWorkTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \DB\ObjStageWork) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ObjStageWorkTableMap::DATABASE_NAME);
            $criteria->add(ObjStageWorkTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = ObjStageWorkQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ObjStageWorkTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ObjStageWorkTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the obj_stage_work table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return ObjStageWorkQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a ObjStageWork or Criteria object.
     *
     * @param mixed $criteria Criteria or ObjStageWork object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ObjStageWorkTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from ObjStageWork object
        }

        if ($criteria->containsKey(ObjStageWorkTableMap::COL_ID) && $criteria->keyContainsValue(ObjStageWorkTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.ObjStageWorkTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = ObjStageWorkQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
