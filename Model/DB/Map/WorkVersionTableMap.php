<?php

namespace DB\Map;

use DB\WorkVersion;
use DB\WorkVersionQuery;
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
 * This class defines the structure of the 'work_version' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class WorkVersionTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'DB.Map.WorkVersionTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'work_version';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\DB\\WorkVersion';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'DB.WorkVersion';

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
    public const COL_ID = 'work_version.id';

    /**
     * the column name for the name field
     */
    public const COL_NAME = 'work_version.name';

    /**
     * the column name for the price field
     */
    public const COL_PRICE = 'work_version.price';

    /**
     * the column name for the is_available field
     */
    public const COL_IS_AVAILABLE = 'work_version.is_available';

    /**
     * the column name for the unit_id field
     */
    public const COL_UNIT_ID = 'work_version.unit_id';

    /**
     * the column name for the version field
     */
    public const COL_VERSION = 'work_version.version';

    /**
     * the column name for the unit_id_version field
     */
    public const COL_UNIT_ID_VERSION = 'work_version.unit_id_version';

    /**
     * the column name for the stage_work_ids field
     */
    public const COL_STAGE_WORK_IDS = 'work_version.stage_work_ids';

    /**
     * the column name for the stage_work_versions field
     */
    public const COL_STAGE_WORK_VERSIONS = 'work_version.stage_work_versions';

    /**
     * the column name for the work_material_ids field
     */
    public const COL_WORK_MATERIAL_IDS = 'work_version.work_material_ids';

    /**
     * the column name for the work_material_versions field
     */
    public const COL_WORK_MATERIAL_VERSIONS = 'work_version.work_material_versions';

    /**
     * the column name for the work_technic_ids field
     */
    public const COL_WORK_TECHNIC_IDS = 'work_version.work_technic_ids';

    /**
     * the column name for the work_technic_versions field
     */
    public const COL_WORK_TECHNIC_VERSIONS = 'work_version.work_technic_versions';

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
        self::TYPE_PHPNAME       => ['Id', 'Name', 'Price', 'IsAvailable', 'UnitId', 'Version', 'UnitIdVersion', 'StageWorkIds', 'StageWorkVersions', 'WorkMaterialIds', 'WorkMaterialVersions', 'WorkTechnicIds', 'WorkTechnicVersions', ],
        self::TYPE_CAMELNAME     => ['id', 'name', 'price', 'isAvailable', 'unitId', 'version', 'unitIdVersion', 'stageWorkIds', 'stageWorkVersions', 'workMaterialIds', 'workMaterialVersions', 'workTechnicIds', 'workTechnicVersions', ],
        self::TYPE_COLNAME       => [WorkVersionTableMap::COL_ID, WorkVersionTableMap::COL_NAME, WorkVersionTableMap::COL_PRICE, WorkVersionTableMap::COL_IS_AVAILABLE, WorkVersionTableMap::COL_UNIT_ID, WorkVersionTableMap::COL_VERSION, WorkVersionTableMap::COL_UNIT_ID_VERSION, WorkVersionTableMap::COL_STAGE_WORK_IDS, WorkVersionTableMap::COL_STAGE_WORK_VERSIONS, WorkVersionTableMap::COL_WORK_MATERIAL_IDS, WorkVersionTableMap::COL_WORK_MATERIAL_VERSIONS, WorkVersionTableMap::COL_WORK_TECHNIC_IDS, WorkVersionTableMap::COL_WORK_TECHNIC_VERSIONS, ],
        self::TYPE_FIELDNAME     => ['id', 'name', 'price', 'is_available', 'unit_id', 'version', 'unit_id_version', 'stage_work_ids', 'stage_work_versions', 'work_material_ids', 'work_material_versions', 'work_technic_ids', 'work_technic_versions', ],
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
        self::TYPE_PHPNAME       => ['Id' => 0, 'Name' => 1, 'Price' => 2, 'IsAvailable' => 3, 'UnitId' => 4, 'Version' => 5, 'UnitIdVersion' => 6, 'StageWorkIds' => 7, 'StageWorkVersions' => 8, 'WorkMaterialIds' => 9, 'WorkMaterialVersions' => 10, 'WorkTechnicIds' => 11, 'WorkTechnicVersions' => 12, ],
        self::TYPE_CAMELNAME     => ['id' => 0, 'name' => 1, 'price' => 2, 'isAvailable' => 3, 'unitId' => 4, 'version' => 5, 'unitIdVersion' => 6, 'stageWorkIds' => 7, 'stageWorkVersions' => 8, 'workMaterialIds' => 9, 'workMaterialVersions' => 10, 'workTechnicIds' => 11, 'workTechnicVersions' => 12, ],
        self::TYPE_COLNAME       => [WorkVersionTableMap::COL_ID => 0, WorkVersionTableMap::COL_NAME => 1, WorkVersionTableMap::COL_PRICE => 2, WorkVersionTableMap::COL_IS_AVAILABLE => 3, WorkVersionTableMap::COL_UNIT_ID => 4, WorkVersionTableMap::COL_VERSION => 5, WorkVersionTableMap::COL_UNIT_ID_VERSION => 6, WorkVersionTableMap::COL_STAGE_WORK_IDS => 7, WorkVersionTableMap::COL_STAGE_WORK_VERSIONS => 8, WorkVersionTableMap::COL_WORK_MATERIAL_IDS => 9, WorkVersionTableMap::COL_WORK_MATERIAL_VERSIONS => 10, WorkVersionTableMap::COL_WORK_TECHNIC_IDS => 11, WorkVersionTableMap::COL_WORK_TECHNIC_VERSIONS => 12, ],
        self::TYPE_FIELDNAME     => ['id' => 0, 'name' => 1, 'price' => 2, 'is_available' => 3, 'unit_id' => 4, 'version' => 5, 'unit_id_version' => 6, 'stage_work_ids' => 7, 'stage_work_versions' => 8, 'work_material_ids' => 9, 'work_material_versions' => 10, 'work_technic_ids' => 11, 'work_technic_versions' => 12, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'WorkVersion.Id' => 'ID',
        'id' => 'ID',
        'workVersion.id' => 'ID',
        'WorkVersionTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'work_version.id' => 'ID',
        'Name' => 'NAME',
        'WorkVersion.Name' => 'NAME',
        'name' => 'NAME',
        'workVersion.name' => 'NAME',
        'WorkVersionTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'work_version.name' => 'NAME',
        'Price' => 'PRICE',
        'WorkVersion.Price' => 'PRICE',
        'price' => 'PRICE',
        'workVersion.price' => 'PRICE',
        'WorkVersionTableMap::COL_PRICE' => 'PRICE',
        'COL_PRICE' => 'PRICE',
        'work_version.price' => 'PRICE',
        'IsAvailable' => 'IS_AVAILABLE',
        'WorkVersion.IsAvailable' => 'IS_AVAILABLE',
        'isAvailable' => 'IS_AVAILABLE',
        'workVersion.isAvailable' => 'IS_AVAILABLE',
        'WorkVersionTableMap::COL_IS_AVAILABLE' => 'IS_AVAILABLE',
        'COL_IS_AVAILABLE' => 'IS_AVAILABLE',
        'is_available' => 'IS_AVAILABLE',
        'work_version.is_available' => 'IS_AVAILABLE',
        'UnitId' => 'UNIT_ID',
        'WorkVersion.UnitId' => 'UNIT_ID',
        'unitId' => 'UNIT_ID',
        'workVersion.unitId' => 'UNIT_ID',
        'WorkVersionTableMap::COL_UNIT_ID' => 'UNIT_ID',
        'COL_UNIT_ID' => 'UNIT_ID',
        'unit_id' => 'UNIT_ID',
        'work_version.unit_id' => 'UNIT_ID',
        'Version' => 'VERSION',
        'WorkVersion.Version' => 'VERSION',
        'version' => 'VERSION',
        'workVersion.version' => 'VERSION',
        'WorkVersionTableMap::COL_VERSION' => 'VERSION',
        'COL_VERSION' => 'VERSION',
        'work_version.version' => 'VERSION',
        'UnitIdVersion' => 'UNIT_ID_VERSION',
        'WorkVersion.UnitIdVersion' => 'UNIT_ID_VERSION',
        'unitIdVersion' => 'UNIT_ID_VERSION',
        'workVersion.unitIdVersion' => 'UNIT_ID_VERSION',
        'WorkVersionTableMap::COL_UNIT_ID_VERSION' => 'UNIT_ID_VERSION',
        'COL_UNIT_ID_VERSION' => 'UNIT_ID_VERSION',
        'unit_id_version' => 'UNIT_ID_VERSION',
        'work_version.unit_id_version' => 'UNIT_ID_VERSION',
        'StageWorkIds' => 'STAGE_WORK_IDS',
        'WorkVersion.StageWorkIds' => 'STAGE_WORK_IDS',
        'stageWorkIds' => 'STAGE_WORK_IDS',
        'workVersion.stageWorkIds' => 'STAGE_WORK_IDS',
        'WorkVersionTableMap::COL_STAGE_WORK_IDS' => 'STAGE_WORK_IDS',
        'COL_STAGE_WORK_IDS' => 'STAGE_WORK_IDS',
        'stage_work_ids' => 'STAGE_WORK_IDS',
        'work_version.stage_work_ids' => 'STAGE_WORK_IDS',
        'StageWorkVersions' => 'STAGE_WORK_VERSIONS',
        'WorkVersion.StageWorkVersions' => 'STAGE_WORK_VERSIONS',
        'stageWorkVersions' => 'STAGE_WORK_VERSIONS',
        'workVersion.stageWorkVersions' => 'STAGE_WORK_VERSIONS',
        'WorkVersionTableMap::COL_STAGE_WORK_VERSIONS' => 'STAGE_WORK_VERSIONS',
        'COL_STAGE_WORK_VERSIONS' => 'STAGE_WORK_VERSIONS',
        'stage_work_versions' => 'STAGE_WORK_VERSIONS',
        'work_version.stage_work_versions' => 'STAGE_WORK_VERSIONS',
        'WorkMaterialIds' => 'WORK_MATERIAL_IDS',
        'WorkVersion.WorkMaterialIds' => 'WORK_MATERIAL_IDS',
        'workMaterialIds' => 'WORK_MATERIAL_IDS',
        'workVersion.workMaterialIds' => 'WORK_MATERIAL_IDS',
        'WorkVersionTableMap::COL_WORK_MATERIAL_IDS' => 'WORK_MATERIAL_IDS',
        'COL_WORK_MATERIAL_IDS' => 'WORK_MATERIAL_IDS',
        'work_material_ids' => 'WORK_MATERIAL_IDS',
        'work_version.work_material_ids' => 'WORK_MATERIAL_IDS',
        'WorkMaterialVersions' => 'WORK_MATERIAL_VERSIONS',
        'WorkVersion.WorkMaterialVersions' => 'WORK_MATERIAL_VERSIONS',
        'workMaterialVersions' => 'WORK_MATERIAL_VERSIONS',
        'workVersion.workMaterialVersions' => 'WORK_MATERIAL_VERSIONS',
        'WorkVersionTableMap::COL_WORK_MATERIAL_VERSIONS' => 'WORK_MATERIAL_VERSIONS',
        'COL_WORK_MATERIAL_VERSIONS' => 'WORK_MATERIAL_VERSIONS',
        'work_material_versions' => 'WORK_MATERIAL_VERSIONS',
        'work_version.work_material_versions' => 'WORK_MATERIAL_VERSIONS',
        'WorkTechnicIds' => 'WORK_TECHNIC_IDS',
        'WorkVersion.WorkTechnicIds' => 'WORK_TECHNIC_IDS',
        'workTechnicIds' => 'WORK_TECHNIC_IDS',
        'workVersion.workTechnicIds' => 'WORK_TECHNIC_IDS',
        'WorkVersionTableMap::COL_WORK_TECHNIC_IDS' => 'WORK_TECHNIC_IDS',
        'COL_WORK_TECHNIC_IDS' => 'WORK_TECHNIC_IDS',
        'work_technic_ids' => 'WORK_TECHNIC_IDS',
        'work_version.work_technic_ids' => 'WORK_TECHNIC_IDS',
        'WorkTechnicVersions' => 'WORK_TECHNIC_VERSIONS',
        'WorkVersion.WorkTechnicVersions' => 'WORK_TECHNIC_VERSIONS',
        'workTechnicVersions' => 'WORK_TECHNIC_VERSIONS',
        'workVersion.workTechnicVersions' => 'WORK_TECHNIC_VERSIONS',
        'WorkVersionTableMap::COL_WORK_TECHNIC_VERSIONS' => 'WORK_TECHNIC_VERSIONS',
        'COL_WORK_TECHNIC_VERSIONS' => 'WORK_TECHNIC_VERSIONS',
        'work_technic_versions' => 'WORK_TECHNIC_VERSIONS',
        'work_version.work_technic_versions' => 'WORK_TECHNIC_VERSIONS',
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
        $this->setName('work_version');
        $this->setPhpName('WorkVersion');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\DB\\WorkVersion');
        $this->setPackage('DB');
        $this->setUseIdGenerator(false);
        // columns
        $this->addForeignPrimaryKey('id', 'Id', 'INTEGER' , 'work', 'id', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 255, null);
        $this->addColumn('price', 'Price', 'DECIMAL', true, 19, null);
        $this->addColumn('is_available', 'IsAvailable', 'BOOLEAN', true, 1, true);
        $this->addColumn('unit_id', 'UnitId', 'INTEGER', true, null, null);
        $this->addPrimaryKey('version', 'Version', 'INTEGER', true, null, 0);
        $this->addColumn('unit_id_version', 'UnitIdVersion', 'INTEGER', false, null, 0);
        $this->addColumn('stage_work_ids', 'StageWorkIds', 'ARRAY', false, null, null);
        $this->addColumn('stage_work_versions', 'StageWorkVersions', 'ARRAY', false, null, null);
        $this->addColumn('work_material_ids', 'WorkMaterialIds', 'ARRAY', false, null, null);
        $this->addColumn('work_material_versions', 'WorkMaterialVersions', 'ARRAY', false, null, null);
        $this->addColumn('work_technic_ids', 'WorkTechnicIds', 'ARRAY', false, null, null);
        $this->addColumn('work_technic_versions', 'WorkTechnicVersions', 'ARRAY', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Work', '\\DB\\Work', RelationMap::MANY_TO_ONE, array (
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
     * @param \DB\WorkVersion $obj A \DB\WorkVersion object.
     * @param string|null $key Key (optional) to use for instance map (for performance boost if key was already calculated externally).
     *
     * @return void
     */
    public static function addInstanceToPool(WorkVersion $obj, ?string $key = null): void
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
     * @param mixed $value A \DB\WorkVersion object or a primary key value.
     *
     * @return void
     */
    public static function removeInstanceFromPool($value): void
    {
        if (Propel::isInstancePoolingEnabled() && null !== $value) {
            if (is_object($value) && $value instanceof \DB\WorkVersion) {
                $key = serialize([(null === $value->getId() || is_scalar($value->getId()) || is_callable([$value->getId(), '__toString']) ? (string) $value->getId() : $value->getId()), (null === $value->getVersion() || is_scalar($value->getVersion()) || is_callable([$value->getVersion(), '__toString']) ? (string) $value->getVersion() : $value->getVersion())]);

            } elseif (is_array($value) && count($value) === 2) {
                // assume we've been passed a primary key";
                $key = serialize([(null === $value[0] || is_scalar($value[0]) || is_callable([$value[0], '__toString']) ? (string) $value[0] : $value[0]), (null === $value[1] || is_scalar($value[1]) || is_callable([$value[1], '__toString']) ? (string) $value[1] : $value[1])]);
            } elseif ($value instanceof Criteria) {
                self::$instances = [];

                return;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or \DB\WorkVersion object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value, true)));
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
        return $withPrefix ? WorkVersionTableMap::CLASS_DEFAULT : WorkVersionTableMap::OM_CLASS;
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
     * @return array (WorkVersion object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = WorkVersionTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = WorkVersionTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + WorkVersionTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = WorkVersionTableMap::OM_CLASS;
            /** @var WorkVersion $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            WorkVersionTableMap::addInstanceToPool($obj, $key);
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
            $key = WorkVersionTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = WorkVersionTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var WorkVersion $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                WorkVersionTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(WorkVersionTableMap::COL_ID);
            $criteria->addSelectColumn(WorkVersionTableMap::COL_NAME);
            $criteria->addSelectColumn(WorkVersionTableMap::COL_PRICE);
            $criteria->addSelectColumn(WorkVersionTableMap::COL_IS_AVAILABLE);
            $criteria->addSelectColumn(WorkVersionTableMap::COL_UNIT_ID);
            $criteria->addSelectColumn(WorkVersionTableMap::COL_VERSION);
            $criteria->addSelectColumn(WorkVersionTableMap::COL_UNIT_ID_VERSION);
            $criteria->addSelectColumn(WorkVersionTableMap::COL_STAGE_WORK_IDS);
            $criteria->addSelectColumn(WorkVersionTableMap::COL_STAGE_WORK_VERSIONS);
            $criteria->addSelectColumn(WorkVersionTableMap::COL_WORK_MATERIAL_IDS);
            $criteria->addSelectColumn(WorkVersionTableMap::COL_WORK_MATERIAL_VERSIONS);
            $criteria->addSelectColumn(WorkVersionTableMap::COL_WORK_TECHNIC_IDS);
            $criteria->addSelectColumn(WorkVersionTableMap::COL_WORK_TECHNIC_VERSIONS);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.price');
            $criteria->addSelectColumn($alias . '.is_available');
            $criteria->addSelectColumn($alias . '.unit_id');
            $criteria->addSelectColumn($alias . '.version');
            $criteria->addSelectColumn($alias . '.unit_id_version');
            $criteria->addSelectColumn($alias . '.stage_work_ids');
            $criteria->addSelectColumn($alias . '.stage_work_versions');
            $criteria->addSelectColumn($alias . '.work_material_ids');
            $criteria->addSelectColumn($alias . '.work_material_versions');
            $criteria->addSelectColumn($alias . '.work_technic_ids');
            $criteria->addSelectColumn($alias . '.work_technic_versions');
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
            $criteria->removeSelectColumn(WorkVersionTableMap::COL_ID);
            $criteria->removeSelectColumn(WorkVersionTableMap::COL_NAME);
            $criteria->removeSelectColumn(WorkVersionTableMap::COL_PRICE);
            $criteria->removeSelectColumn(WorkVersionTableMap::COL_IS_AVAILABLE);
            $criteria->removeSelectColumn(WorkVersionTableMap::COL_UNIT_ID);
            $criteria->removeSelectColumn(WorkVersionTableMap::COL_VERSION);
            $criteria->removeSelectColumn(WorkVersionTableMap::COL_UNIT_ID_VERSION);
            $criteria->removeSelectColumn(WorkVersionTableMap::COL_STAGE_WORK_IDS);
            $criteria->removeSelectColumn(WorkVersionTableMap::COL_STAGE_WORK_VERSIONS);
            $criteria->removeSelectColumn(WorkVersionTableMap::COL_WORK_MATERIAL_IDS);
            $criteria->removeSelectColumn(WorkVersionTableMap::COL_WORK_MATERIAL_VERSIONS);
            $criteria->removeSelectColumn(WorkVersionTableMap::COL_WORK_TECHNIC_IDS);
            $criteria->removeSelectColumn(WorkVersionTableMap::COL_WORK_TECHNIC_VERSIONS);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.name');
            $criteria->removeSelectColumn($alias . '.price');
            $criteria->removeSelectColumn($alias . '.is_available');
            $criteria->removeSelectColumn($alias . '.unit_id');
            $criteria->removeSelectColumn($alias . '.version');
            $criteria->removeSelectColumn($alias . '.unit_id_version');
            $criteria->removeSelectColumn($alias . '.stage_work_ids');
            $criteria->removeSelectColumn($alias . '.stage_work_versions');
            $criteria->removeSelectColumn($alias . '.work_material_ids');
            $criteria->removeSelectColumn($alias . '.work_material_versions');
            $criteria->removeSelectColumn($alias . '.work_technic_ids');
            $criteria->removeSelectColumn($alias . '.work_technic_versions');
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
        return Propel::getServiceContainer()->getDatabaseMap(WorkVersionTableMap::DATABASE_NAME)->getTable(WorkVersionTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a WorkVersion or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or WorkVersion object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(WorkVersionTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \DB\WorkVersion) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(WorkVersionTableMap::DATABASE_NAME);
            // primary key is composite; we therefore, expect
            // the primary key passed to be an array of pkey values
            if (count($values) == count($values, COUNT_RECURSIVE)) {
                // array is not multi-dimensional
                $values = [$values];
            }
            foreach ($values as $value) {
                $criterion = $criteria->getNewCriterion(WorkVersionTableMap::COL_ID, $value[0]);
                $criterion->addAnd($criteria->getNewCriterion(WorkVersionTableMap::COL_VERSION, $value[1]));
                $criteria->addOr($criterion);
            }
        }

        $query = WorkVersionQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            WorkVersionTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                WorkVersionTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the work_version table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return WorkVersionQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a WorkVersion or Criteria object.
     *
     * @param mixed $criteria Criteria or WorkVersion object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(WorkVersionTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from WorkVersion object
        }


        // Set the correct dbName
        $query = WorkVersionQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
