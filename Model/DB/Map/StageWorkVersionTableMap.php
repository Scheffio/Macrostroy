<?php

namespace DB\Map;

use DB\StageWorkVersion;
use DB\StageWorkVersionQuery;
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
 * This class defines the structure of the 'stage_work_version' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class StageWorkVersionTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'DB.Map.StageWorkVersionTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'stage_work_version';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'StageWorkVersion';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\DB\\StageWorkVersion';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'DB.StageWorkVersion';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 13;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 13;

    /**
     * the column name for the id field
     */
    public const COL_ID = 'stage_work_version.id';

    /**
     * the column name for the stage_id field
     */
    public const COL_STAGE_ID = 'stage_work_version.stage_id';

    /**
     * the column name for the work_id field
     */
    public const COL_WORK_ID = 'stage_work_version.work_id';

    /**
     * the column name for the price field
     */
    public const COL_PRICE = 'stage_work_version.price';

    /**
     * the column name for the amount field
     */
    public const COL_AMOUNT = 'stage_work_version.amount';

    /**
     * the column name for the version field
     */
    public const COL_VERSION = 'stage_work_version.version';

    /**
     * the column name for the version_created_at field
     */
    public const COL_VERSION_CREATED_AT = 'stage_work_version.version_created_at';

    /**
     * the column name for the version_created_by field
     */
    public const COL_VERSION_CREATED_BY = 'stage_work_version.version_created_by';

    /**
     * the column name for the version_comment field
     */
    public const COL_VERSION_COMMENT = 'stage_work_version.version_comment';

    /**
     * the column name for the stage_material_ids field
     */
    public const COL_STAGE_MATERIAL_IDS = 'stage_work_version.stage_material_ids';

    /**
     * the column name for the stage_material_versions field
     */
    public const COL_STAGE_MATERIAL_VERSIONS = 'stage_work_version.stage_material_versions';

    /**
     * the column name for the stage_technic_ids field
     */
    public const COL_STAGE_TECHNIC_IDS = 'stage_work_version.stage_technic_ids';

    /**
     * the column name for the stage_technic_versions field
     */
    public const COL_STAGE_TECHNIC_VERSIONS = 'stage_work_version.stage_technic_versions';

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
        self::TYPE_PHPNAME       => ['Id', 'StageId', 'WorkId', 'Price', 'Amount', 'Version', 'VersionCreatedAt', 'VersionCreatedBy', 'VersionComment', 'StageMaterialIds', 'StageMaterialVersions', 'StageTechnicIds', 'StageTechnicVersions', ],
        self::TYPE_CAMELNAME     => ['id', 'stageId', 'workId', 'price', 'amount', 'version', 'versionCreatedAt', 'versionCreatedBy', 'versionComment', 'stageMaterialIds', 'stageMaterialVersions', 'stageTechnicIds', 'stageTechnicVersions', ],
        self::TYPE_COLNAME       => [StageWorkVersionTableMap::COL_ID, StageWorkVersionTableMap::COL_STAGE_ID, StageWorkVersionTableMap::COL_WORK_ID, StageWorkVersionTableMap::COL_PRICE, StageWorkVersionTableMap::COL_AMOUNT, StageWorkVersionTableMap::COL_VERSION, StageWorkVersionTableMap::COL_VERSION_CREATED_AT, StageWorkVersionTableMap::COL_VERSION_CREATED_BY, StageWorkVersionTableMap::COL_VERSION_COMMENT, StageWorkVersionTableMap::COL_STAGE_MATERIAL_IDS, StageWorkVersionTableMap::COL_STAGE_MATERIAL_VERSIONS, StageWorkVersionTableMap::COL_STAGE_TECHNIC_IDS, StageWorkVersionTableMap::COL_STAGE_TECHNIC_VERSIONS, ],
        self::TYPE_FIELDNAME     => ['id', 'stage_id', 'work_id', 'price', 'amount', 'version', 'version_created_at', 'version_created_by', 'version_comment', 'stage_material_ids', 'stage_material_versions', 'stage_technic_ids', 'stage_technic_versions', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, ]
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
        self::TYPE_PHPNAME       => ['Id' => 0, 'StageId' => 1, 'WorkId' => 2, 'Price' => 3, 'Amount' => 4, 'Version' => 5, 'VersionCreatedAt' => 6, 'VersionCreatedBy' => 7, 'VersionComment' => 8, 'StageMaterialIds' => 9, 'StageMaterialVersions' => 10, 'StageTechnicIds' => 11, 'StageTechnicVersions' => 12, ],
        self::TYPE_CAMELNAME     => ['id' => 0, 'stageId' => 1, 'workId' => 2, 'price' => 3, 'amount' => 4, 'version' => 5, 'versionCreatedAt' => 6, 'versionCreatedBy' => 7, 'versionComment' => 8, 'stageMaterialIds' => 9, 'stageMaterialVersions' => 10, 'stageTechnicIds' => 11, 'stageTechnicVersions' => 12, ],
        self::TYPE_COLNAME       => [StageWorkVersionTableMap::COL_ID => 0, StageWorkVersionTableMap::COL_STAGE_ID => 1, StageWorkVersionTableMap::COL_WORK_ID => 2, StageWorkVersionTableMap::COL_PRICE => 3, StageWorkVersionTableMap::COL_AMOUNT => 4, StageWorkVersionTableMap::COL_VERSION => 5, StageWorkVersionTableMap::COL_VERSION_CREATED_AT => 6, StageWorkVersionTableMap::COL_VERSION_CREATED_BY => 7, StageWorkVersionTableMap::COL_VERSION_COMMENT => 8, StageWorkVersionTableMap::COL_STAGE_MATERIAL_IDS => 9, StageWorkVersionTableMap::COL_STAGE_MATERIAL_VERSIONS => 10, StageWorkVersionTableMap::COL_STAGE_TECHNIC_IDS => 11, StageWorkVersionTableMap::COL_STAGE_TECHNIC_VERSIONS => 12, ],
        self::TYPE_FIELDNAME     => ['id' => 0, 'stage_id' => 1, 'work_id' => 2, 'price' => 3, 'amount' => 4, 'version' => 5, 'version_created_at' => 6, 'version_created_by' => 7, 'version_comment' => 8, 'stage_material_ids' => 9, 'stage_material_versions' => 10, 'stage_technic_ids' => 11, 'stage_technic_versions' => 12, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'StageWorkVersion.Id' => 'ID',
        'id' => 'ID',
        'stageWorkVersion.id' => 'ID',
        'StageWorkVersionTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'stage_work_version.id' => 'ID',
        'StageId' => 'STAGE_ID',
        'StageWorkVersion.StageId' => 'STAGE_ID',
        'stageId' => 'STAGE_ID',
        'stageWorkVersion.stageId' => 'STAGE_ID',
        'StageWorkVersionTableMap::COL_STAGE_ID' => 'STAGE_ID',
        'COL_STAGE_ID' => 'STAGE_ID',
        'stage_id' => 'STAGE_ID',
        'stage_work_version.stage_id' => 'STAGE_ID',
        'WorkId' => 'WORK_ID',
        'StageWorkVersion.WorkId' => 'WORK_ID',
        'workId' => 'WORK_ID',
        'stageWorkVersion.workId' => 'WORK_ID',
        'StageWorkVersionTableMap::COL_WORK_ID' => 'WORK_ID',
        'COL_WORK_ID' => 'WORK_ID',
        'work_id' => 'WORK_ID',
        'stage_work_version.work_id' => 'WORK_ID',
        'Price' => 'PRICE',
        'StageWorkVersion.Price' => 'PRICE',
        'price' => 'PRICE',
        'stageWorkVersion.price' => 'PRICE',
        'StageWorkVersionTableMap::COL_PRICE' => 'PRICE',
        'COL_PRICE' => 'PRICE',
        'stage_work_version.price' => 'PRICE',
        'Amount' => 'AMOUNT',
        'StageWorkVersion.Amount' => 'AMOUNT',
        'amount' => 'AMOUNT',
        'stageWorkVersion.amount' => 'AMOUNT',
        'StageWorkVersionTableMap::COL_AMOUNT' => 'AMOUNT',
        'COL_AMOUNT' => 'AMOUNT',
        'stage_work_version.amount' => 'AMOUNT',
        'Version' => 'VERSION',
        'StageWorkVersion.Version' => 'VERSION',
        'version' => 'VERSION',
        'stageWorkVersion.version' => 'VERSION',
        'StageWorkVersionTableMap::COL_VERSION' => 'VERSION',
        'COL_VERSION' => 'VERSION',
        'stage_work_version.version' => 'VERSION',
        'VersionCreatedAt' => 'VERSION_CREATED_AT',
        'StageWorkVersion.VersionCreatedAt' => 'VERSION_CREATED_AT',
        'versionCreatedAt' => 'VERSION_CREATED_AT',
        'stageWorkVersion.versionCreatedAt' => 'VERSION_CREATED_AT',
        'StageWorkVersionTableMap::COL_VERSION_CREATED_AT' => 'VERSION_CREATED_AT',
        'COL_VERSION_CREATED_AT' => 'VERSION_CREATED_AT',
        'version_created_at' => 'VERSION_CREATED_AT',
        'stage_work_version.version_created_at' => 'VERSION_CREATED_AT',
        'VersionCreatedBy' => 'VERSION_CREATED_BY',
        'StageWorkVersion.VersionCreatedBy' => 'VERSION_CREATED_BY',
        'versionCreatedBy' => 'VERSION_CREATED_BY',
        'stageWorkVersion.versionCreatedBy' => 'VERSION_CREATED_BY',
        'StageWorkVersionTableMap::COL_VERSION_CREATED_BY' => 'VERSION_CREATED_BY',
        'COL_VERSION_CREATED_BY' => 'VERSION_CREATED_BY',
        'version_created_by' => 'VERSION_CREATED_BY',
        'stage_work_version.version_created_by' => 'VERSION_CREATED_BY',
        'VersionComment' => 'VERSION_COMMENT',
        'StageWorkVersion.VersionComment' => 'VERSION_COMMENT',
        'versionComment' => 'VERSION_COMMENT',
        'stageWorkVersion.versionComment' => 'VERSION_COMMENT',
        'StageWorkVersionTableMap::COL_VERSION_COMMENT' => 'VERSION_COMMENT',
        'COL_VERSION_COMMENT' => 'VERSION_COMMENT',
        'version_comment' => 'VERSION_COMMENT',
        'stage_work_version.version_comment' => 'VERSION_COMMENT',
        'StageMaterialIds' => 'STAGE_MATERIAL_IDS',
        'StageWorkVersion.StageMaterialIds' => 'STAGE_MATERIAL_IDS',
        'stageMaterialIds' => 'STAGE_MATERIAL_IDS',
        'stageWorkVersion.stageMaterialIds' => 'STAGE_MATERIAL_IDS',
        'StageWorkVersionTableMap::COL_STAGE_MATERIAL_IDS' => 'STAGE_MATERIAL_IDS',
        'COL_STAGE_MATERIAL_IDS' => 'STAGE_MATERIAL_IDS',
        'stage_material_ids' => 'STAGE_MATERIAL_IDS',
        'stage_work_version.stage_material_ids' => 'STAGE_MATERIAL_IDS',
        'StageMaterialVersions' => 'STAGE_MATERIAL_VERSIONS',
        'StageWorkVersion.StageMaterialVersions' => 'STAGE_MATERIAL_VERSIONS',
        'stageMaterialVersions' => 'STAGE_MATERIAL_VERSIONS',
        'stageWorkVersion.stageMaterialVersions' => 'STAGE_MATERIAL_VERSIONS',
        'StageWorkVersionTableMap::COL_STAGE_MATERIAL_VERSIONS' => 'STAGE_MATERIAL_VERSIONS',
        'COL_STAGE_MATERIAL_VERSIONS' => 'STAGE_MATERIAL_VERSIONS',
        'stage_material_versions' => 'STAGE_MATERIAL_VERSIONS',
        'stage_work_version.stage_material_versions' => 'STAGE_MATERIAL_VERSIONS',
        'StageTechnicIds' => 'STAGE_TECHNIC_IDS',
        'StageWorkVersion.StageTechnicIds' => 'STAGE_TECHNIC_IDS',
        'stageTechnicIds' => 'STAGE_TECHNIC_IDS',
        'stageWorkVersion.stageTechnicIds' => 'STAGE_TECHNIC_IDS',
        'StageWorkVersionTableMap::COL_STAGE_TECHNIC_IDS' => 'STAGE_TECHNIC_IDS',
        'COL_STAGE_TECHNIC_IDS' => 'STAGE_TECHNIC_IDS',
        'stage_technic_ids' => 'STAGE_TECHNIC_IDS',
        'stage_work_version.stage_technic_ids' => 'STAGE_TECHNIC_IDS',
        'StageTechnicVersions' => 'STAGE_TECHNIC_VERSIONS',
        'StageWorkVersion.StageTechnicVersions' => 'STAGE_TECHNIC_VERSIONS',
        'stageTechnicVersions' => 'STAGE_TECHNIC_VERSIONS',
        'stageWorkVersion.stageTechnicVersions' => 'STAGE_TECHNIC_VERSIONS',
        'StageWorkVersionTableMap::COL_STAGE_TECHNIC_VERSIONS' => 'STAGE_TECHNIC_VERSIONS',
        'COL_STAGE_TECHNIC_VERSIONS' => 'STAGE_TECHNIC_VERSIONS',
        'stage_technic_versions' => 'STAGE_TECHNIC_VERSIONS',
        'stage_work_version.stage_technic_versions' => 'STAGE_TECHNIC_VERSIONS',
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
        $this->setName('stage_work_version');
        $this->setPhpName('StageWorkVersion');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\DB\\StageWorkVersion');
        $this->setPackage('DB');
        $this->setUseIdGenerator(false);
        // columns
        $this->addForeignPrimaryKey('id', 'Id', 'INTEGER' , 'stage_work', 'id', true, null, null);
        $this->addColumn('stage_id', 'StageId', 'INTEGER', true, null, null);
        $this->addColumn('work_id', 'WorkId', 'INTEGER', true, null, null);
        $this->addColumn('price', 'Price', 'DECIMAL', true, 19, null);
        $this->addColumn('amount', 'Amount', 'DECIMAL', true, 19, null);
        $this->addPrimaryKey('version', 'Version', 'INTEGER', true, null, 0);
        $this->addColumn('version_created_at', 'VersionCreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('version_created_by', 'VersionCreatedBy', 'VARCHAR', false, 100, null);
        $this->addColumn('version_comment', 'VersionComment', 'VARCHAR', false, 255, null);
        $this->addColumn('stage_material_ids', 'StageMaterialIds', 'LONGVARCHAR', false, null, null);
        $this->addColumn('stage_material_versions', 'StageMaterialVersions', 'LONGVARCHAR', false, null, null);
        $this->addColumn('stage_technic_ids', 'StageTechnicIds', 'LONGVARCHAR', false, null, null);
        $this->addColumn('stage_technic_versions', 'StageTechnicVersions', 'LONGVARCHAR', false, null, null);
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
     * @param \DB\StageWorkVersion $obj A \DB\StageWorkVersion object.
     * @param string|null $key Key (optional) to use for instance map (for performance boost if key was already calculated externally).
     *
     * @return void
     */
    public static function addInstanceToPool(StageWorkVersion $obj, ?string $key = null): void
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
     * @param mixed $value A \DB\StageWorkVersion object or a primary key value.
     *
     * @return void
     */
    public static function removeInstanceFromPool($value): void
    {
        if (Propel::isInstancePoolingEnabled() && null !== $value) {
            if (is_object($value) && $value instanceof \DB\StageWorkVersion) {
                $key = serialize([(null === $value->getId() || is_scalar($value->getId()) || is_callable([$value->getId(), '__toString']) ? (string) $value->getId() : $value->getId()), (null === $value->getVersion() || is_scalar($value->getVersion()) || is_callable([$value->getVersion(), '__toString']) ? (string) $value->getVersion() : $value->getVersion())]);

            } elseif (is_array($value) && count($value) === 2) {
                // assume we've been passed a primary key";
                $key = serialize([(null === $value[0] || is_scalar($value[0]) || is_callable([$value[0], '__toString']) ? (string) $value[0] : $value[0]), (null === $value[1] || is_scalar($value[1]) || is_callable([$value[1], '__toString']) ? (string) $value[1] : $value[1])]);
            } elseif ($value instanceof Criteria) {
                self::$instances = [];

                return;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or \DB\StageWorkVersion object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value, true)));
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
        return $withPrefix ? StageWorkVersionTableMap::CLASS_DEFAULT : StageWorkVersionTableMap::OM_CLASS;
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
     * @return array (StageWorkVersion object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = StageWorkVersionTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = StageWorkVersionTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + StageWorkVersionTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = StageWorkVersionTableMap::OM_CLASS;
            /** @var StageWorkVersion $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            StageWorkVersionTableMap::addInstanceToPool($obj, $key);
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
            $key = StageWorkVersionTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = StageWorkVersionTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var StageWorkVersion $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                StageWorkVersionTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(StageWorkVersionTableMap::COL_ID);
            $criteria->addSelectColumn(StageWorkVersionTableMap::COL_STAGE_ID);
            $criteria->addSelectColumn(StageWorkVersionTableMap::COL_WORK_ID);
            $criteria->addSelectColumn(StageWorkVersionTableMap::COL_PRICE);
            $criteria->addSelectColumn(StageWorkVersionTableMap::COL_AMOUNT);
            $criteria->addSelectColumn(StageWorkVersionTableMap::COL_VERSION);
            $criteria->addSelectColumn(StageWorkVersionTableMap::COL_VERSION_CREATED_AT);
            $criteria->addSelectColumn(StageWorkVersionTableMap::COL_VERSION_CREATED_BY);
            $criteria->addSelectColumn(StageWorkVersionTableMap::COL_VERSION_COMMENT);
            $criteria->addSelectColumn(StageWorkVersionTableMap::COL_STAGE_MATERIAL_IDS);
            $criteria->addSelectColumn(StageWorkVersionTableMap::COL_STAGE_MATERIAL_VERSIONS);
            $criteria->addSelectColumn(StageWorkVersionTableMap::COL_STAGE_TECHNIC_IDS);
            $criteria->addSelectColumn(StageWorkVersionTableMap::COL_STAGE_TECHNIC_VERSIONS);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.stage_id');
            $criteria->addSelectColumn($alias . '.work_id');
            $criteria->addSelectColumn($alias . '.price');
            $criteria->addSelectColumn($alias . '.amount');
            $criteria->addSelectColumn($alias . '.version');
            $criteria->addSelectColumn($alias . '.version_created_at');
            $criteria->addSelectColumn($alias . '.version_created_by');
            $criteria->addSelectColumn($alias . '.version_comment');
            $criteria->addSelectColumn($alias . '.stage_material_ids');
            $criteria->addSelectColumn($alias . '.stage_material_versions');
            $criteria->addSelectColumn($alias . '.stage_technic_ids');
            $criteria->addSelectColumn($alias . '.stage_technic_versions');
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
            $criteria->removeSelectColumn(StageWorkVersionTableMap::COL_ID);
            $criteria->removeSelectColumn(StageWorkVersionTableMap::COL_STAGE_ID);
            $criteria->removeSelectColumn(StageWorkVersionTableMap::COL_WORK_ID);
            $criteria->removeSelectColumn(StageWorkVersionTableMap::COL_PRICE);
            $criteria->removeSelectColumn(StageWorkVersionTableMap::COL_AMOUNT);
            $criteria->removeSelectColumn(StageWorkVersionTableMap::COL_VERSION);
            $criteria->removeSelectColumn(StageWorkVersionTableMap::COL_VERSION_CREATED_AT);
            $criteria->removeSelectColumn(StageWorkVersionTableMap::COL_VERSION_CREATED_BY);
            $criteria->removeSelectColumn(StageWorkVersionTableMap::COL_VERSION_COMMENT);
            $criteria->removeSelectColumn(StageWorkVersionTableMap::COL_STAGE_MATERIAL_IDS);
            $criteria->removeSelectColumn(StageWorkVersionTableMap::COL_STAGE_MATERIAL_VERSIONS);
            $criteria->removeSelectColumn(StageWorkVersionTableMap::COL_STAGE_TECHNIC_IDS);
            $criteria->removeSelectColumn(StageWorkVersionTableMap::COL_STAGE_TECHNIC_VERSIONS);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.stage_id');
            $criteria->removeSelectColumn($alias . '.work_id');
            $criteria->removeSelectColumn($alias . '.price');
            $criteria->removeSelectColumn($alias . '.amount');
            $criteria->removeSelectColumn($alias . '.version');
            $criteria->removeSelectColumn($alias . '.version_created_at');
            $criteria->removeSelectColumn($alias . '.version_created_by');
            $criteria->removeSelectColumn($alias . '.version_comment');
            $criteria->removeSelectColumn($alias . '.stage_material_ids');
            $criteria->removeSelectColumn($alias . '.stage_material_versions');
            $criteria->removeSelectColumn($alias . '.stage_technic_ids');
            $criteria->removeSelectColumn($alias . '.stage_technic_versions');
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
        return Propel::getServiceContainer()->getDatabaseMap(StageWorkVersionTableMap::DATABASE_NAME)->getTable(StageWorkVersionTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a StageWorkVersion or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or StageWorkVersion object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(StageWorkVersionTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \DB\StageWorkVersion) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(StageWorkVersionTableMap::DATABASE_NAME);
            // primary key is composite; we therefore, expect
            // the primary key passed to be an array of pkey values
            if (count($values) == count($values, COUNT_RECURSIVE)) {
                // array is not multi-dimensional
                $values = [$values];
            }
            foreach ($values as $value) {
                $criterion = $criteria->getNewCriterion(StageWorkVersionTableMap::COL_ID, $value[0]);
                $criterion->addAnd($criteria->getNewCriterion(StageWorkVersionTableMap::COL_VERSION, $value[1]));
                $criteria->addOr($criterion);
            }
        }

        $query = StageWorkVersionQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            StageWorkVersionTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                StageWorkVersionTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the stage_work_version table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return StageWorkVersionQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a StageWorkVersion or Criteria object.
     *
     * @param mixed $criteria Criteria or StageWorkVersion object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(StageWorkVersionTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from StageWorkVersion object
        }


        // Set the correct dbName
        $query = StageWorkVersionQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
