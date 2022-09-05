<?php

namespace DB\Map;

use DB\ObjStageWorkVersion;
use DB\ObjStageWorkVersionQuery;
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
 * This class defines the structure of the 'obj_stage_work_version' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class ObjStageWorkVersionTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'DB.Map.ObjStageWorkVersionTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'obj_stage_work_version';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'ObjStageWorkVersion';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\DB\\ObjStageWorkVersion';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'DB.ObjStageWorkVersion';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 16;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 16;

    /**
     * the column name for the id field
     */
    public const COL_ID = 'obj_stage_work_version.id';

    /**
     * the column name for the price field
     */
    public const COL_PRICE = 'obj_stage_work_version.price';

    /**
     * the column name for the amount field
     */
    public const COL_AMOUNT = 'obj_stage_work_version.amount';

    /**
     * the column name for the is_available field
     */
    public const COL_IS_AVAILABLE = 'obj_stage_work_version.is_available';

    /**
     * the column name for the work_id field
     */
    public const COL_WORK_ID = 'obj_stage_work_version.work_id';

    /**
     * the column name for the stage_id field
     */
    public const COL_STAGE_ID = 'obj_stage_work_version.stage_id';

    /**
     * the column name for the version field
     */
    public const COL_VERSION = 'obj_stage_work_version.version';

    /**
     * the column name for the version_created_at field
     */
    public const COL_VERSION_CREATED_AT = 'obj_stage_work_version.version_created_at';

    /**
     * the column name for the version_created_by field
     */
    public const COL_VERSION_CREATED_BY = 'obj_stage_work_version.version_created_by';

    /**
     * the column name for the version_comment field
     */
    public const COL_VERSION_COMMENT = 'obj_stage_work_version.version_comment';

    /**
     * the column name for the work_id_version field
     */
    public const COL_WORK_ID_VERSION = 'obj_stage_work_version.work_id_version';

    /**
     * the column name for the stage_id_version field
     */
    public const COL_STAGE_ID_VERSION = 'obj_stage_work_version.stage_id_version';

    /**
     * the column name for the obj_stage_material_ids field
     */
    public const COL_OBJ_STAGE_MATERIAL_IDS = 'obj_stage_work_version.obj_stage_material_ids';

    /**
     * the column name for the obj_stage_material_versions field
     */
    public const COL_OBJ_STAGE_MATERIAL_VERSIONS = 'obj_stage_work_version.obj_stage_material_versions';

    /**
     * the column name for the obj_stage_technic_ids field
     */
    public const COL_OBJ_STAGE_TECHNIC_IDS = 'obj_stage_work_version.obj_stage_technic_ids';

    /**
     * the column name for the obj_stage_technic_versions field
     */
    public const COL_OBJ_STAGE_TECHNIC_VERSIONS = 'obj_stage_work_version.obj_stage_technic_versions';

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
        self::TYPE_PHPNAME       => ['Id', 'Price', 'Amount', 'IsAvailable', 'WorkId', 'StageId', 'Version', 'VersionCreatedAt', 'VersionCreatedBy', 'VersionComment', 'WorkIdVersion', 'StageIdVersion', 'ObjStageMaterialIds', 'ObjStageMaterialVersions', 'ObjStageTechnicIds', 'ObjStageTechnicVersions', ],
        self::TYPE_CAMELNAME     => ['id', 'price', 'amount', 'isAvailable', 'workId', 'stageId', 'version', 'versionCreatedAt', 'versionCreatedBy', 'versionComment', 'workIdVersion', 'stageIdVersion', 'objStageMaterialIds', 'objStageMaterialVersions', 'objStageTechnicIds', 'objStageTechnicVersions', ],
        self::TYPE_COLNAME       => [ObjStageWorkVersionTableMap::COL_ID, ObjStageWorkVersionTableMap::COL_PRICE, ObjStageWorkVersionTableMap::COL_AMOUNT, ObjStageWorkVersionTableMap::COL_IS_AVAILABLE, ObjStageWorkVersionTableMap::COL_WORK_ID, ObjStageWorkVersionTableMap::COL_STAGE_ID, ObjStageWorkVersionTableMap::COL_VERSION, ObjStageWorkVersionTableMap::COL_VERSION_CREATED_AT, ObjStageWorkVersionTableMap::COL_VERSION_CREATED_BY, ObjStageWorkVersionTableMap::COL_VERSION_COMMENT, ObjStageWorkVersionTableMap::COL_WORK_ID_VERSION, ObjStageWorkVersionTableMap::COL_STAGE_ID_VERSION, ObjStageWorkVersionTableMap::COL_OBJ_STAGE_MATERIAL_IDS, ObjStageWorkVersionTableMap::COL_OBJ_STAGE_MATERIAL_VERSIONS, ObjStageWorkVersionTableMap::COL_OBJ_STAGE_TECHNIC_IDS, ObjStageWorkVersionTableMap::COL_OBJ_STAGE_TECHNIC_VERSIONS, ],
        self::TYPE_FIELDNAME     => ['id', 'price', 'amount', 'is_available', 'work_id', 'stage_id', 'version', 'version_created_at', 'version_created_by', 'version_comment', 'work_id_version', 'stage_id_version', 'obj_stage_material_ids', 'obj_stage_material_versions', 'obj_stage_technic_ids', 'obj_stage_technic_versions', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, ]
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
        self::TYPE_PHPNAME       => ['Id' => 0, 'Price' => 1, 'Amount' => 2, 'IsAvailable' => 3, 'WorkId' => 4, 'StageId' => 5, 'Version' => 6, 'VersionCreatedAt' => 7, 'VersionCreatedBy' => 8, 'VersionComment' => 9, 'WorkIdVersion' => 10, 'StageIdVersion' => 11, 'ObjStageMaterialIds' => 12, 'ObjStageMaterialVersions' => 13, 'ObjStageTechnicIds' => 14, 'ObjStageTechnicVersions' => 15, ],
        self::TYPE_CAMELNAME     => ['id' => 0, 'price' => 1, 'amount' => 2, 'isAvailable' => 3, 'workId' => 4, 'stageId' => 5, 'version' => 6, 'versionCreatedAt' => 7, 'versionCreatedBy' => 8, 'versionComment' => 9, 'workIdVersion' => 10, 'stageIdVersion' => 11, 'objStageMaterialIds' => 12, 'objStageMaterialVersions' => 13, 'objStageTechnicIds' => 14, 'objStageTechnicVersions' => 15, ],
        self::TYPE_COLNAME       => [ObjStageWorkVersionTableMap::COL_ID => 0, ObjStageWorkVersionTableMap::COL_PRICE => 1, ObjStageWorkVersionTableMap::COL_AMOUNT => 2, ObjStageWorkVersionTableMap::COL_IS_AVAILABLE => 3, ObjStageWorkVersionTableMap::COL_WORK_ID => 4, ObjStageWorkVersionTableMap::COL_STAGE_ID => 5, ObjStageWorkVersionTableMap::COL_VERSION => 6, ObjStageWorkVersionTableMap::COL_VERSION_CREATED_AT => 7, ObjStageWorkVersionTableMap::COL_VERSION_CREATED_BY => 8, ObjStageWorkVersionTableMap::COL_VERSION_COMMENT => 9, ObjStageWorkVersionTableMap::COL_WORK_ID_VERSION => 10, ObjStageWorkVersionTableMap::COL_STAGE_ID_VERSION => 11, ObjStageWorkVersionTableMap::COL_OBJ_STAGE_MATERIAL_IDS => 12, ObjStageWorkVersionTableMap::COL_OBJ_STAGE_MATERIAL_VERSIONS => 13, ObjStageWorkVersionTableMap::COL_OBJ_STAGE_TECHNIC_IDS => 14, ObjStageWorkVersionTableMap::COL_OBJ_STAGE_TECHNIC_VERSIONS => 15, ],
        self::TYPE_FIELDNAME     => ['id' => 0, 'price' => 1, 'amount' => 2, 'is_available' => 3, 'work_id' => 4, 'stage_id' => 5, 'version' => 6, 'version_created_at' => 7, 'version_created_by' => 8, 'version_comment' => 9, 'work_id_version' => 10, 'stage_id_version' => 11, 'obj_stage_material_ids' => 12, 'obj_stage_material_versions' => 13, 'obj_stage_technic_ids' => 14, 'obj_stage_technic_versions' => 15, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'ObjStageWorkVersion.Id' => 'ID',
        'id' => 'ID',
        'objStageWorkVersion.id' => 'ID',
        'ObjStageWorkVersionTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'obj_stage_work_version.id' => 'ID',
        'Price' => 'PRICE',
        'ObjStageWorkVersion.Price' => 'PRICE',
        'price' => 'PRICE',
        'objStageWorkVersion.price' => 'PRICE',
        'ObjStageWorkVersionTableMap::COL_PRICE' => 'PRICE',
        'COL_PRICE' => 'PRICE',
        'obj_stage_work_version.price' => 'PRICE',
        'Amount' => 'AMOUNT',
        'ObjStageWorkVersion.Amount' => 'AMOUNT',
        'amount' => 'AMOUNT',
        'objStageWorkVersion.amount' => 'AMOUNT',
        'ObjStageWorkVersionTableMap::COL_AMOUNT' => 'AMOUNT',
        'COL_AMOUNT' => 'AMOUNT',
        'obj_stage_work_version.amount' => 'AMOUNT',
        'IsAvailable' => 'IS_AVAILABLE',
        'ObjStageWorkVersion.IsAvailable' => 'IS_AVAILABLE',
        'isAvailable' => 'IS_AVAILABLE',
        'objStageWorkVersion.isAvailable' => 'IS_AVAILABLE',
        'ObjStageWorkVersionTableMap::COL_IS_AVAILABLE' => 'IS_AVAILABLE',
        'COL_IS_AVAILABLE' => 'IS_AVAILABLE',
        'is_available' => 'IS_AVAILABLE',
        'obj_stage_work_version.is_available' => 'IS_AVAILABLE',
        'WorkId' => 'WORK_ID',
        'ObjStageWorkVersion.WorkId' => 'WORK_ID',
        'workId' => 'WORK_ID',
        'objStageWorkVersion.workId' => 'WORK_ID',
        'ObjStageWorkVersionTableMap::COL_WORK_ID' => 'WORK_ID',
        'COL_WORK_ID' => 'WORK_ID',
        'work_id' => 'WORK_ID',
        'obj_stage_work_version.work_id' => 'WORK_ID',
        'StageId' => 'STAGE_ID',
        'ObjStageWorkVersion.StageId' => 'STAGE_ID',
        'stageId' => 'STAGE_ID',
        'objStageWorkVersion.stageId' => 'STAGE_ID',
        'ObjStageWorkVersionTableMap::COL_STAGE_ID' => 'STAGE_ID',
        'COL_STAGE_ID' => 'STAGE_ID',
        'stage_id' => 'STAGE_ID',
        'obj_stage_work_version.stage_id' => 'STAGE_ID',
        'Version' => 'VERSION',
        'ObjStageWorkVersion.Version' => 'VERSION',
        'version' => 'VERSION',
        'objStageWorkVersion.version' => 'VERSION',
        'ObjStageWorkVersionTableMap::COL_VERSION' => 'VERSION',
        'COL_VERSION' => 'VERSION',
        'obj_stage_work_version.version' => 'VERSION',
        'VersionCreatedAt' => 'VERSION_CREATED_AT',
        'ObjStageWorkVersion.VersionCreatedAt' => 'VERSION_CREATED_AT',
        'versionCreatedAt' => 'VERSION_CREATED_AT',
        'objStageWorkVersion.versionCreatedAt' => 'VERSION_CREATED_AT',
        'ObjStageWorkVersionTableMap::COL_VERSION_CREATED_AT' => 'VERSION_CREATED_AT',
        'COL_VERSION_CREATED_AT' => 'VERSION_CREATED_AT',
        'version_created_at' => 'VERSION_CREATED_AT',
        'obj_stage_work_version.version_created_at' => 'VERSION_CREATED_AT',
        'VersionCreatedBy' => 'VERSION_CREATED_BY',
        'ObjStageWorkVersion.VersionCreatedBy' => 'VERSION_CREATED_BY',
        'versionCreatedBy' => 'VERSION_CREATED_BY',
        'objStageWorkVersion.versionCreatedBy' => 'VERSION_CREATED_BY',
        'ObjStageWorkVersionTableMap::COL_VERSION_CREATED_BY' => 'VERSION_CREATED_BY',
        'COL_VERSION_CREATED_BY' => 'VERSION_CREATED_BY',
        'version_created_by' => 'VERSION_CREATED_BY',
        'obj_stage_work_version.version_created_by' => 'VERSION_CREATED_BY',
        'VersionComment' => 'VERSION_COMMENT',
        'ObjStageWorkVersion.VersionComment' => 'VERSION_COMMENT',
        'versionComment' => 'VERSION_COMMENT',
        'objStageWorkVersion.versionComment' => 'VERSION_COMMENT',
        'ObjStageWorkVersionTableMap::COL_VERSION_COMMENT' => 'VERSION_COMMENT',
        'COL_VERSION_COMMENT' => 'VERSION_COMMENT',
        'version_comment' => 'VERSION_COMMENT',
        'obj_stage_work_version.version_comment' => 'VERSION_COMMENT',
        'WorkIdVersion' => 'WORK_ID_VERSION',
        'ObjStageWorkVersion.WorkIdVersion' => 'WORK_ID_VERSION',
        'workIdVersion' => 'WORK_ID_VERSION',
        'objStageWorkVersion.workIdVersion' => 'WORK_ID_VERSION',
        'ObjStageWorkVersionTableMap::COL_WORK_ID_VERSION' => 'WORK_ID_VERSION',
        'COL_WORK_ID_VERSION' => 'WORK_ID_VERSION',
        'work_id_version' => 'WORK_ID_VERSION',
        'obj_stage_work_version.work_id_version' => 'WORK_ID_VERSION',
        'StageIdVersion' => 'STAGE_ID_VERSION',
        'ObjStageWorkVersion.StageIdVersion' => 'STAGE_ID_VERSION',
        'stageIdVersion' => 'STAGE_ID_VERSION',
        'objStageWorkVersion.stageIdVersion' => 'STAGE_ID_VERSION',
        'ObjStageWorkVersionTableMap::COL_STAGE_ID_VERSION' => 'STAGE_ID_VERSION',
        'COL_STAGE_ID_VERSION' => 'STAGE_ID_VERSION',
        'stage_id_version' => 'STAGE_ID_VERSION',
        'obj_stage_work_version.stage_id_version' => 'STAGE_ID_VERSION',
        'ObjStageMaterialIds' => 'OBJ_STAGE_MATERIAL_IDS',
        'ObjStageWorkVersion.ObjStageMaterialIds' => 'OBJ_STAGE_MATERIAL_IDS',
        'objStageMaterialIds' => 'OBJ_STAGE_MATERIAL_IDS',
        'objStageWorkVersion.objStageMaterialIds' => 'OBJ_STAGE_MATERIAL_IDS',
        'ObjStageWorkVersionTableMap::COL_OBJ_STAGE_MATERIAL_IDS' => 'OBJ_STAGE_MATERIAL_IDS',
        'COL_OBJ_STAGE_MATERIAL_IDS' => 'OBJ_STAGE_MATERIAL_IDS',
        'obj_stage_material_ids' => 'OBJ_STAGE_MATERIAL_IDS',
        'obj_stage_work_version.obj_stage_material_ids' => 'OBJ_STAGE_MATERIAL_IDS',
        'ObjStageMaterialVersions' => 'OBJ_STAGE_MATERIAL_VERSIONS',
        'ObjStageWorkVersion.ObjStageMaterialVersions' => 'OBJ_STAGE_MATERIAL_VERSIONS',
        'objStageMaterialVersions' => 'OBJ_STAGE_MATERIAL_VERSIONS',
        'objStageWorkVersion.objStageMaterialVersions' => 'OBJ_STAGE_MATERIAL_VERSIONS',
        'ObjStageWorkVersionTableMap::COL_OBJ_STAGE_MATERIAL_VERSIONS' => 'OBJ_STAGE_MATERIAL_VERSIONS',
        'COL_OBJ_STAGE_MATERIAL_VERSIONS' => 'OBJ_STAGE_MATERIAL_VERSIONS',
        'obj_stage_material_versions' => 'OBJ_STAGE_MATERIAL_VERSIONS',
        'obj_stage_work_version.obj_stage_material_versions' => 'OBJ_STAGE_MATERIAL_VERSIONS',
        'ObjStageTechnicIds' => 'OBJ_STAGE_TECHNIC_IDS',
        'ObjStageWorkVersion.ObjStageTechnicIds' => 'OBJ_STAGE_TECHNIC_IDS',
        'objStageTechnicIds' => 'OBJ_STAGE_TECHNIC_IDS',
        'objStageWorkVersion.objStageTechnicIds' => 'OBJ_STAGE_TECHNIC_IDS',
        'ObjStageWorkVersionTableMap::COL_OBJ_STAGE_TECHNIC_IDS' => 'OBJ_STAGE_TECHNIC_IDS',
        'COL_OBJ_STAGE_TECHNIC_IDS' => 'OBJ_STAGE_TECHNIC_IDS',
        'obj_stage_technic_ids' => 'OBJ_STAGE_TECHNIC_IDS',
        'obj_stage_work_version.obj_stage_technic_ids' => 'OBJ_STAGE_TECHNIC_IDS',
        'ObjStageTechnicVersions' => 'OBJ_STAGE_TECHNIC_VERSIONS',
        'ObjStageWorkVersion.ObjStageTechnicVersions' => 'OBJ_STAGE_TECHNIC_VERSIONS',
        'objStageTechnicVersions' => 'OBJ_STAGE_TECHNIC_VERSIONS',
        'objStageWorkVersion.objStageTechnicVersions' => 'OBJ_STAGE_TECHNIC_VERSIONS',
        'ObjStageWorkVersionTableMap::COL_OBJ_STAGE_TECHNIC_VERSIONS' => 'OBJ_STAGE_TECHNIC_VERSIONS',
        'COL_OBJ_STAGE_TECHNIC_VERSIONS' => 'OBJ_STAGE_TECHNIC_VERSIONS',
        'obj_stage_technic_versions' => 'OBJ_STAGE_TECHNIC_VERSIONS',
        'obj_stage_work_version.obj_stage_technic_versions' => 'OBJ_STAGE_TECHNIC_VERSIONS',
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
        $this->setName('obj_stage_work_version');
        $this->setPhpName('ObjStageWorkVersion');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\DB\\ObjStageWorkVersion');
        $this->setPackage('DB');
        $this->setUseIdGenerator(false);
        // columns
        $this->addForeignPrimaryKey('id', 'Id', 'INTEGER' , 'obj_stage_work', 'id', true, null, null);
        $this->addColumn('price', 'Price', 'DECIMAL', true, 19, null);
        $this->addColumn('amount', 'Amount', 'DECIMAL', true, 19, null);
        $this->addColumn('is_available', 'IsAvailable', 'BOOLEAN', true, 1, true);
        $this->addColumn('work_id', 'WorkId', 'INTEGER', true, null, null);
        $this->addColumn('stage_id', 'StageId', 'INTEGER', true, null, null);
        $this->addPrimaryKey('version', 'Version', 'INTEGER', true, null, 0);
        $this->addColumn('version_created_at', 'VersionCreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('version_created_by', 'VersionCreatedBy', 'VARCHAR', false, 100, null);
        $this->addColumn('version_comment', 'VersionComment', 'VARCHAR', false, 255, null);
        $this->addColumn('work_id_version', 'WorkIdVersion', 'INTEGER', false, null, 0);
        $this->addColumn('stage_id_version', 'StageIdVersion', 'INTEGER', false, null, 0);
        $this->addColumn('obj_stage_material_ids', 'ObjStageMaterialIds', 'ARRAY', false, null, null);
        $this->addColumn('obj_stage_material_versions', 'ObjStageMaterialVersions', 'ARRAY', false, null, null);
        $this->addColumn('obj_stage_technic_ids', 'ObjStageTechnicIds', 'ARRAY', false, null, null);
        $this->addColumn('obj_stage_technic_versions', 'ObjStageTechnicVersions', 'ARRAY', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('ObjStageWork', '\\DB\\ObjStageWork', RelationMap::MANY_TO_ONE, array (
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
     * @param \DB\ObjStageWorkVersion $obj A \DB\ObjStageWorkVersion object.
     * @param string|null $key Key (optional) to use for instance map (for performance boost if key was already calculated externally).
     *
     * @return void
     */
    public static function addInstanceToPool(ObjStageWorkVersion $obj, ?string $key = null): void
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
     * @param mixed $value A \DB\ObjStageWorkVersion object or a primary key value.
     *
     * @return void
     */
    public static function removeInstanceFromPool($value): void
    {
        if (Propel::isInstancePoolingEnabled() && null !== $value) {
            if (is_object($value) && $value instanceof \DB\ObjStageWorkVersion) {
                $key = serialize([(null === $value->getId() || is_scalar($value->getId()) || is_callable([$value->getId(), '__toString']) ? (string) $value->getId() : $value->getId()), (null === $value->getVersion() || is_scalar($value->getVersion()) || is_callable([$value->getVersion(), '__toString']) ? (string) $value->getVersion() : $value->getVersion())]);

            } elseif (is_array($value) && count($value) === 2) {
                // assume we've been passed a primary key";
                $key = serialize([(null === $value[0] || is_scalar($value[0]) || is_callable([$value[0], '__toString']) ? (string) $value[0] : $value[0]), (null === $value[1] || is_scalar($value[1]) || is_callable([$value[1], '__toString']) ? (string) $value[1] : $value[1])]);
            } elseif ($value instanceof Criteria) {
                self::$instances = [];

                return;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or \DB\ObjStageWorkVersion object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value, true)));
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null && $row[TableMap::TYPE_NUM == $indexType ? 6 + $offset : static::translateFieldName('Version', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return serialize([(null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]), (null === $row[TableMap::TYPE_NUM == $indexType ? 6 + $offset : static::translateFieldName('Version', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 6 + $offset : static::translateFieldName('Version', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 6 + $offset : static::translateFieldName('Version', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 6 + $offset : static::translateFieldName('Version', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 6 + $offset : static::translateFieldName('Version', TableMap::TYPE_PHPNAME, $indexType)])]);
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
                ? 6 + $offset
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
        return $withPrefix ? ObjStageWorkVersionTableMap::CLASS_DEFAULT : ObjStageWorkVersionTableMap::OM_CLASS;
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
     * @return array (ObjStageWorkVersion object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = ObjStageWorkVersionTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ObjStageWorkVersionTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ObjStageWorkVersionTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ObjStageWorkVersionTableMap::OM_CLASS;
            /** @var ObjStageWorkVersion $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ObjStageWorkVersionTableMap::addInstanceToPool($obj, $key);
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
            $key = ObjStageWorkVersionTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ObjStageWorkVersionTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var ObjStageWorkVersion $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ObjStageWorkVersionTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ObjStageWorkVersionTableMap::COL_ID);
            $criteria->addSelectColumn(ObjStageWorkVersionTableMap::COL_PRICE);
            $criteria->addSelectColumn(ObjStageWorkVersionTableMap::COL_AMOUNT);
            $criteria->addSelectColumn(ObjStageWorkVersionTableMap::COL_IS_AVAILABLE);
            $criteria->addSelectColumn(ObjStageWorkVersionTableMap::COL_WORK_ID);
            $criteria->addSelectColumn(ObjStageWorkVersionTableMap::COL_STAGE_ID);
            $criteria->addSelectColumn(ObjStageWorkVersionTableMap::COL_VERSION);
            $criteria->addSelectColumn(ObjStageWorkVersionTableMap::COL_VERSION_CREATED_AT);
            $criteria->addSelectColumn(ObjStageWorkVersionTableMap::COL_VERSION_CREATED_BY);
            $criteria->addSelectColumn(ObjStageWorkVersionTableMap::COL_VERSION_COMMENT);
            $criteria->addSelectColumn(ObjStageWorkVersionTableMap::COL_WORK_ID_VERSION);
            $criteria->addSelectColumn(ObjStageWorkVersionTableMap::COL_STAGE_ID_VERSION);
            $criteria->addSelectColumn(ObjStageWorkVersionTableMap::COL_OBJ_STAGE_MATERIAL_IDS);
            $criteria->addSelectColumn(ObjStageWorkVersionTableMap::COL_OBJ_STAGE_MATERIAL_VERSIONS);
            $criteria->addSelectColumn(ObjStageWorkVersionTableMap::COL_OBJ_STAGE_TECHNIC_IDS);
            $criteria->addSelectColumn(ObjStageWorkVersionTableMap::COL_OBJ_STAGE_TECHNIC_VERSIONS);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.price');
            $criteria->addSelectColumn($alias . '.amount');
            $criteria->addSelectColumn($alias . '.is_available');
            $criteria->addSelectColumn($alias . '.work_id');
            $criteria->addSelectColumn($alias . '.stage_id');
            $criteria->addSelectColumn($alias . '.version');
            $criteria->addSelectColumn($alias . '.version_created_at');
            $criteria->addSelectColumn($alias . '.version_created_by');
            $criteria->addSelectColumn($alias . '.version_comment');
            $criteria->addSelectColumn($alias . '.work_id_version');
            $criteria->addSelectColumn($alias . '.stage_id_version');
            $criteria->addSelectColumn($alias . '.obj_stage_material_ids');
            $criteria->addSelectColumn($alias . '.obj_stage_material_versions');
            $criteria->addSelectColumn($alias . '.obj_stage_technic_ids');
            $criteria->addSelectColumn($alias . '.obj_stage_technic_versions');
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
            $criteria->removeSelectColumn(ObjStageWorkVersionTableMap::COL_ID);
            $criteria->removeSelectColumn(ObjStageWorkVersionTableMap::COL_PRICE);
            $criteria->removeSelectColumn(ObjStageWorkVersionTableMap::COL_AMOUNT);
            $criteria->removeSelectColumn(ObjStageWorkVersionTableMap::COL_IS_AVAILABLE);
            $criteria->removeSelectColumn(ObjStageWorkVersionTableMap::COL_WORK_ID);
            $criteria->removeSelectColumn(ObjStageWorkVersionTableMap::COL_STAGE_ID);
            $criteria->removeSelectColumn(ObjStageWorkVersionTableMap::COL_VERSION);
            $criteria->removeSelectColumn(ObjStageWorkVersionTableMap::COL_VERSION_CREATED_AT);
            $criteria->removeSelectColumn(ObjStageWorkVersionTableMap::COL_VERSION_CREATED_BY);
            $criteria->removeSelectColumn(ObjStageWorkVersionTableMap::COL_VERSION_COMMENT);
            $criteria->removeSelectColumn(ObjStageWorkVersionTableMap::COL_WORK_ID_VERSION);
            $criteria->removeSelectColumn(ObjStageWorkVersionTableMap::COL_STAGE_ID_VERSION);
            $criteria->removeSelectColumn(ObjStageWorkVersionTableMap::COL_OBJ_STAGE_MATERIAL_IDS);
            $criteria->removeSelectColumn(ObjStageWorkVersionTableMap::COL_OBJ_STAGE_MATERIAL_VERSIONS);
            $criteria->removeSelectColumn(ObjStageWorkVersionTableMap::COL_OBJ_STAGE_TECHNIC_IDS);
            $criteria->removeSelectColumn(ObjStageWorkVersionTableMap::COL_OBJ_STAGE_TECHNIC_VERSIONS);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.price');
            $criteria->removeSelectColumn($alias . '.amount');
            $criteria->removeSelectColumn($alias . '.is_available');
            $criteria->removeSelectColumn($alias . '.work_id');
            $criteria->removeSelectColumn($alias . '.stage_id');
            $criteria->removeSelectColumn($alias . '.version');
            $criteria->removeSelectColumn($alias . '.version_created_at');
            $criteria->removeSelectColumn($alias . '.version_created_by');
            $criteria->removeSelectColumn($alias . '.version_comment');
            $criteria->removeSelectColumn($alias . '.work_id_version');
            $criteria->removeSelectColumn($alias . '.stage_id_version');
            $criteria->removeSelectColumn($alias . '.obj_stage_material_ids');
            $criteria->removeSelectColumn($alias . '.obj_stage_material_versions');
            $criteria->removeSelectColumn($alias . '.obj_stage_technic_ids');
            $criteria->removeSelectColumn($alias . '.obj_stage_technic_versions');
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
        return Propel::getServiceContainer()->getDatabaseMap(ObjStageWorkVersionTableMap::DATABASE_NAME)->getTable(ObjStageWorkVersionTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a ObjStageWorkVersion or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or ObjStageWorkVersion object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ObjStageWorkVersionTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \DB\ObjStageWorkVersion) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ObjStageWorkVersionTableMap::DATABASE_NAME);
            // primary key is composite; we therefore, expect
            // the primary key passed to be an array of pkey values
            if (count($values) == count($values, COUNT_RECURSIVE)) {
                // array is not multi-dimensional
                $values = [$values];
            }
            foreach ($values as $value) {
                $criterion = $criteria->getNewCriterion(ObjStageWorkVersionTableMap::COL_ID, $value[0]);
                $criterion->addAnd($criteria->getNewCriterion(ObjStageWorkVersionTableMap::COL_VERSION, $value[1]));
                $criteria->addOr($criterion);
            }
        }

        $query = ObjStageWorkVersionQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ObjStageWorkVersionTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ObjStageWorkVersionTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the obj_stage_work_version table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return ObjStageWorkVersionQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a ObjStageWorkVersion or Criteria object.
     *
     * @param mixed $criteria Criteria or ObjStageWorkVersion object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ObjStageWorkVersionTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from ObjStageWorkVersion object
        }


        // Set the correct dbName
        $query = ObjStageWorkVersionQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
