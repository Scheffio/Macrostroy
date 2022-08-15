<?php

namespace DB\Map;

use DB\StageVersion;
use DB\StageVersionQuery;
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
 * This class defines the structure of the 'stage_version' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class StageVersionTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'DB.Map.StageVersionTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'stage_version';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\DB\\StageVersion';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'DB.StageVersion';

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
    public const COL_ID = 'stage_version.id';

    /**
     * the column name for the name field
     */
    public const COL_NAME = 'stage_version.name';

    /**
     * the column name for the status field
     */
    public const COL_STATUS = 'stage_version.status';

    /**
     * the column name for the is_available field
     */
    public const COL_IS_AVAILABLE = 'stage_version.is_available';

    /**
     * the column name for the house_id field
     */
    public const COL_HOUSE_ID = 'stage_version.house_id';

    /**
     * the column name for the version field
     */
    public const COL_VERSION = 'stage_version.version';

    /**
     * the column name for the house_id_version field
     */
    public const COL_HOUSE_ID_VERSION = 'stage_version.house_id_version';

    /**
     * the column name for the stage_material_ids field
     */
    public const COL_STAGE_MATERIAL_IDS = 'stage_version.stage_material_ids';

    /**
     * the column name for the stage_material_versions field
     */
    public const COL_STAGE_MATERIAL_VERSIONS = 'stage_version.stage_material_versions';

    /**
     * the column name for the stage_technic_ids field
     */
    public const COL_STAGE_TECHNIC_IDS = 'stage_version.stage_technic_ids';

    /**
     * the column name for the stage_technic_versions field
     */
    public const COL_STAGE_TECHNIC_VERSIONS = 'stage_version.stage_technic_versions';

    /**
     * the column name for the stage_work_ids field
     */
    public const COL_STAGE_WORK_IDS = 'stage_version.stage_work_ids';

    /**
     * the column name for the stage_work_versions field
     */
    public const COL_STAGE_WORK_VERSIONS = 'stage_version.stage_work_versions';

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
        self::TYPE_PHPNAME       => ['Id', 'Name', 'Status', 'IsAvailable', 'HouseId', 'Version', 'HouseIdVersion', 'StageMaterialIds', 'StageMaterialVersions', 'StageTechnicIds', 'StageTechnicVersions', 'StageWorkIds', 'StageWorkVersions', ],
        self::TYPE_CAMELNAME     => ['id', 'name', 'status', 'isAvailable', 'houseId', 'version', 'houseIdVersion', 'stageMaterialIds', 'stageMaterialVersions', 'stageTechnicIds', 'stageTechnicVersions', 'stageWorkIds', 'stageWorkVersions', ],
        self::TYPE_COLNAME       => [StageVersionTableMap::COL_ID, StageVersionTableMap::COL_NAME, StageVersionTableMap::COL_STATUS, StageVersionTableMap::COL_IS_AVAILABLE, StageVersionTableMap::COL_HOUSE_ID, StageVersionTableMap::COL_VERSION, StageVersionTableMap::COL_HOUSE_ID_VERSION, StageVersionTableMap::COL_STAGE_MATERIAL_IDS, StageVersionTableMap::COL_STAGE_MATERIAL_VERSIONS, StageVersionTableMap::COL_STAGE_TECHNIC_IDS, StageVersionTableMap::COL_STAGE_TECHNIC_VERSIONS, StageVersionTableMap::COL_STAGE_WORK_IDS, StageVersionTableMap::COL_STAGE_WORK_VERSIONS, ],
        self::TYPE_FIELDNAME     => ['id', 'name', 'status', 'is_available', 'house_id', 'version', 'house_id_version', 'stage_material_ids', 'stage_material_versions', 'stage_technic_ids', 'stage_technic_versions', 'stage_work_ids', 'stage_work_versions', ],
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
        self::TYPE_PHPNAME       => ['Id' => 0, 'Name' => 1, 'Status' => 2, 'IsAvailable' => 3, 'HouseId' => 4, 'Version' => 5, 'HouseIdVersion' => 6, 'StageMaterialIds' => 7, 'StageMaterialVersions' => 8, 'StageTechnicIds' => 9, 'StageTechnicVersions' => 10, 'StageWorkIds' => 11, 'StageWorkVersions' => 12, ],
        self::TYPE_CAMELNAME     => ['id' => 0, 'name' => 1, 'status' => 2, 'isAvailable' => 3, 'houseId' => 4, 'version' => 5, 'houseIdVersion' => 6, 'stageMaterialIds' => 7, 'stageMaterialVersions' => 8, 'stageTechnicIds' => 9, 'stageTechnicVersions' => 10, 'stageWorkIds' => 11, 'stageWorkVersions' => 12, ],
        self::TYPE_COLNAME       => [StageVersionTableMap::COL_ID => 0, StageVersionTableMap::COL_NAME => 1, StageVersionTableMap::COL_STATUS => 2, StageVersionTableMap::COL_IS_AVAILABLE => 3, StageVersionTableMap::COL_HOUSE_ID => 4, StageVersionTableMap::COL_VERSION => 5, StageVersionTableMap::COL_HOUSE_ID_VERSION => 6, StageVersionTableMap::COL_STAGE_MATERIAL_IDS => 7, StageVersionTableMap::COL_STAGE_MATERIAL_VERSIONS => 8, StageVersionTableMap::COL_STAGE_TECHNIC_IDS => 9, StageVersionTableMap::COL_STAGE_TECHNIC_VERSIONS => 10, StageVersionTableMap::COL_STAGE_WORK_IDS => 11, StageVersionTableMap::COL_STAGE_WORK_VERSIONS => 12, ],
        self::TYPE_FIELDNAME     => ['id' => 0, 'name' => 1, 'status' => 2, 'is_available' => 3, 'house_id' => 4, 'version' => 5, 'house_id_version' => 6, 'stage_material_ids' => 7, 'stage_material_versions' => 8, 'stage_technic_ids' => 9, 'stage_technic_versions' => 10, 'stage_work_ids' => 11, 'stage_work_versions' => 12, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'StageVersion.Id' => 'ID',
        'id' => 'ID',
        'stageVersion.id' => 'ID',
        'StageVersionTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'stage_version.id' => 'ID',
        'Name' => 'NAME',
        'StageVersion.Name' => 'NAME',
        'name' => 'NAME',
        'stageVersion.name' => 'NAME',
        'StageVersionTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'stage_version.name' => 'NAME',
        'Status' => 'STATUS',
        'StageVersion.Status' => 'STATUS',
        'status' => 'STATUS',
        'stageVersion.status' => 'STATUS',
        'StageVersionTableMap::COL_STATUS' => 'STATUS',
        'COL_STATUS' => 'STATUS',
        'stage_version.status' => 'STATUS',
        'IsAvailable' => 'IS_AVAILABLE',
        'StageVersion.IsAvailable' => 'IS_AVAILABLE',
        'isAvailable' => 'IS_AVAILABLE',
        'stageVersion.isAvailable' => 'IS_AVAILABLE',
        'StageVersionTableMap::COL_IS_AVAILABLE' => 'IS_AVAILABLE',
        'COL_IS_AVAILABLE' => 'IS_AVAILABLE',
        'is_available' => 'IS_AVAILABLE',
        'stage_version.is_available' => 'IS_AVAILABLE',
        'HouseId' => 'HOUSE_ID',
        'StageVersion.HouseId' => 'HOUSE_ID',
        'houseId' => 'HOUSE_ID',
        'stageVersion.houseId' => 'HOUSE_ID',
        'StageVersionTableMap::COL_HOUSE_ID' => 'HOUSE_ID',
        'COL_HOUSE_ID' => 'HOUSE_ID',
        'house_id' => 'HOUSE_ID',
        'stage_version.house_id' => 'HOUSE_ID',
        'Version' => 'VERSION',
        'StageVersion.Version' => 'VERSION',
        'version' => 'VERSION',
        'stageVersion.version' => 'VERSION',
        'StageVersionTableMap::COL_VERSION' => 'VERSION',
        'COL_VERSION' => 'VERSION',
        'stage_version.version' => 'VERSION',
        'HouseIdVersion' => 'HOUSE_ID_VERSION',
        'StageVersion.HouseIdVersion' => 'HOUSE_ID_VERSION',
        'houseIdVersion' => 'HOUSE_ID_VERSION',
        'stageVersion.houseIdVersion' => 'HOUSE_ID_VERSION',
        'StageVersionTableMap::COL_HOUSE_ID_VERSION' => 'HOUSE_ID_VERSION',
        'COL_HOUSE_ID_VERSION' => 'HOUSE_ID_VERSION',
        'house_id_version' => 'HOUSE_ID_VERSION',
        'stage_version.house_id_version' => 'HOUSE_ID_VERSION',
        'StageMaterialIds' => 'STAGE_MATERIAL_IDS',
        'StageVersion.StageMaterialIds' => 'STAGE_MATERIAL_IDS',
        'stageMaterialIds' => 'STAGE_MATERIAL_IDS',
        'stageVersion.stageMaterialIds' => 'STAGE_MATERIAL_IDS',
        'StageVersionTableMap::COL_STAGE_MATERIAL_IDS' => 'STAGE_MATERIAL_IDS',
        'COL_STAGE_MATERIAL_IDS' => 'STAGE_MATERIAL_IDS',
        'stage_material_ids' => 'STAGE_MATERIAL_IDS',
        'stage_version.stage_material_ids' => 'STAGE_MATERIAL_IDS',
        'StageMaterialVersions' => 'STAGE_MATERIAL_VERSIONS',
        'StageVersion.StageMaterialVersions' => 'STAGE_MATERIAL_VERSIONS',
        'stageMaterialVersions' => 'STAGE_MATERIAL_VERSIONS',
        'stageVersion.stageMaterialVersions' => 'STAGE_MATERIAL_VERSIONS',
        'StageVersionTableMap::COL_STAGE_MATERIAL_VERSIONS' => 'STAGE_MATERIAL_VERSIONS',
        'COL_STAGE_MATERIAL_VERSIONS' => 'STAGE_MATERIAL_VERSIONS',
        'stage_material_versions' => 'STAGE_MATERIAL_VERSIONS',
        'stage_version.stage_material_versions' => 'STAGE_MATERIAL_VERSIONS',
        'StageTechnicIds' => 'STAGE_TECHNIC_IDS',
        'StageVersion.StageTechnicIds' => 'STAGE_TECHNIC_IDS',
        'stageTechnicIds' => 'STAGE_TECHNIC_IDS',
        'stageVersion.stageTechnicIds' => 'STAGE_TECHNIC_IDS',
        'StageVersionTableMap::COL_STAGE_TECHNIC_IDS' => 'STAGE_TECHNIC_IDS',
        'COL_STAGE_TECHNIC_IDS' => 'STAGE_TECHNIC_IDS',
        'stage_technic_ids' => 'STAGE_TECHNIC_IDS',
        'stage_version.stage_technic_ids' => 'STAGE_TECHNIC_IDS',
        'StageTechnicVersions' => 'STAGE_TECHNIC_VERSIONS',
        'StageVersion.StageTechnicVersions' => 'STAGE_TECHNIC_VERSIONS',
        'stageTechnicVersions' => 'STAGE_TECHNIC_VERSIONS',
        'stageVersion.stageTechnicVersions' => 'STAGE_TECHNIC_VERSIONS',
        'StageVersionTableMap::COL_STAGE_TECHNIC_VERSIONS' => 'STAGE_TECHNIC_VERSIONS',
        'COL_STAGE_TECHNIC_VERSIONS' => 'STAGE_TECHNIC_VERSIONS',
        'stage_technic_versions' => 'STAGE_TECHNIC_VERSIONS',
        'stage_version.stage_technic_versions' => 'STAGE_TECHNIC_VERSIONS',
        'StageWorkIds' => 'STAGE_WORK_IDS',
        'StageVersion.StageWorkIds' => 'STAGE_WORK_IDS',
        'stageWorkIds' => 'STAGE_WORK_IDS',
        'stageVersion.stageWorkIds' => 'STAGE_WORK_IDS',
        'StageVersionTableMap::COL_STAGE_WORK_IDS' => 'STAGE_WORK_IDS',
        'COL_STAGE_WORK_IDS' => 'STAGE_WORK_IDS',
        'stage_work_ids' => 'STAGE_WORK_IDS',
        'stage_version.stage_work_ids' => 'STAGE_WORK_IDS',
        'StageWorkVersions' => 'STAGE_WORK_VERSIONS',
        'StageVersion.StageWorkVersions' => 'STAGE_WORK_VERSIONS',
        'stageWorkVersions' => 'STAGE_WORK_VERSIONS',
        'stageVersion.stageWorkVersions' => 'STAGE_WORK_VERSIONS',
        'StageVersionTableMap::COL_STAGE_WORK_VERSIONS' => 'STAGE_WORK_VERSIONS',
        'COL_STAGE_WORK_VERSIONS' => 'STAGE_WORK_VERSIONS',
        'stage_work_versions' => 'STAGE_WORK_VERSIONS',
        'stage_version.stage_work_versions' => 'STAGE_WORK_VERSIONS',
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
        $this->setName('stage_version');
        $this->setPhpName('StageVersion');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\DB\\StageVersion');
        $this->setPackage('DB');
        $this->setUseIdGenerator(false);
        // columns
        $this->addForeignPrimaryKey('id', 'Id', 'INTEGER' , 'stage', 'id', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 255, null);
        $this->addColumn('status', 'Status', 'CHAR', true, null, 'in_process');
        $this->addColumn('is_available', 'IsAvailable', 'BOOLEAN', true, 1, true);
        $this->addColumn('house_id', 'HouseId', 'INTEGER', false, null, null);
        $this->addPrimaryKey('version', 'Version', 'INTEGER', true, null, 0);
        $this->addColumn('house_id_version', 'HouseIdVersion', 'INTEGER', false, null, 0);
        $this->addColumn('stage_material_ids', 'StageMaterialIds', 'ARRAY', false, null, null);
        $this->addColumn('stage_material_versions', 'StageMaterialVersions', 'ARRAY', false, null, null);
        $this->addColumn('stage_technic_ids', 'StageTechnicIds', 'ARRAY', false, null, null);
        $this->addColumn('stage_technic_versions', 'StageTechnicVersions', 'ARRAY', false, null, null);
        $this->addColumn('stage_work_ids', 'StageWorkIds', 'ARRAY', false, null, null);
        $this->addColumn('stage_work_versions', 'StageWorkVersions', 'ARRAY', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Stage', '\\DB\\Stage', RelationMap::MANY_TO_ONE, array (
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
     * @param \DB\StageVersion $obj A \DB\StageVersion object.
     * @param string|null $key Key (optional) to use for instance map (for performance boost if key was already calculated externally).
     *
     * @return void
     */
    public static function addInstanceToPool(StageVersion $obj, ?string $key = null): void
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
     * @param mixed $value A \DB\StageVersion object or a primary key value.
     *
     * @return void
     */
    public static function removeInstanceFromPool($value): void
    {
        if (Propel::isInstancePoolingEnabled() && null !== $value) {
            if (is_object($value) && $value instanceof \DB\StageVersion) {
                $key = serialize([(null === $value->getId() || is_scalar($value->getId()) || is_callable([$value->getId(), '__toString']) ? (string) $value->getId() : $value->getId()), (null === $value->getVersion() || is_scalar($value->getVersion()) || is_callable([$value->getVersion(), '__toString']) ? (string) $value->getVersion() : $value->getVersion())]);

            } elseif (is_array($value) && count($value) === 2) {
                // assume we've been passed a primary key";
                $key = serialize([(null === $value[0] || is_scalar($value[0]) || is_callable([$value[0], '__toString']) ? (string) $value[0] : $value[0]), (null === $value[1] || is_scalar($value[1]) || is_callable([$value[1], '__toString']) ? (string) $value[1] : $value[1])]);
            } elseif ($value instanceof Criteria) {
                self::$instances = [];

                return;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or \DB\StageVersion object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value, true)));
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
        return $withPrefix ? StageVersionTableMap::CLASS_DEFAULT : StageVersionTableMap::OM_CLASS;
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
     * @return array (StageVersion object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = StageVersionTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = StageVersionTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + StageVersionTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = StageVersionTableMap::OM_CLASS;
            /** @var StageVersion $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            StageVersionTableMap::addInstanceToPool($obj, $key);
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
            $key = StageVersionTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = StageVersionTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var StageVersion $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                StageVersionTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(StageVersionTableMap::COL_ID);
            $criteria->addSelectColumn(StageVersionTableMap::COL_NAME);
            $criteria->addSelectColumn(StageVersionTableMap::COL_STATUS);
            $criteria->addSelectColumn(StageVersionTableMap::COL_IS_AVAILABLE);
            $criteria->addSelectColumn(StageVersionTableMap::COL_HOUSE_ID);
            $criteria->addSelectColumn(StageVersionTableMap::COL_VERSION);
            $criteria->addSelectColumn(StageVersionTableMap::COL_HOUSE_ID_VERSION);
            $criteria->addSelectColumn(StageVersionTableMap::COL_STAGE_MATERIAL_IDS);
            $criteria->addSelectColumn(StageVersionTableMap::COL_STAGE_MATERIAL_VERSIONS);
            $criteria->addSelectColumn(StageVersionTableMap::COL_STAGE_TECHNIC_IDS);
            $criteria->addSelectColumn(StageVersionTableMap::COL_STAGE_TECHNIC_VERSIONS);
            $criteria->addSelectColumn(StageVersionTableMap::COL_STAGE_WORK_IDS);
            $criteria->addSelectColumn(StageVersionTableMap::COL_STAGE_WORK_VERSIONS);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.status');
            $criteria->addSelectColumn($alias . '.is_available');
            $criteria->addSelectColumn($alias . '.house_id');
            $criteria->addSelectColumn($alias . '.version');
            $criteria->addSelectColumn($alias . '.house_id_version');
            $criteria->addSelectColumn($alias . '.stage_material_ids');
            $criteria->addSelectColumn($alias . '.stage_material_versions');
            $criteria->addSelectColumn($alias . '.stage_technic_ids');
            $criteria->addSelectColumn($alias . '.stage_technic_versions');
            $criteria->addSelectColumn($alias . '.stage_work_ids');
            $criteria->addSelectColumn($alias . '.stage_work_versions');
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
            $criteria->removeSelectColumn(StageVersionTableMap::COL_ID);
            $criteria->removeSelectColumn(StageVersionTableMap::COL_NAME);
            $criteria->removeSelectColumn(StageVersionTableMap::COL_STATUS);
            $criteria->removeSelectColumn(StageVersionTableMap::COL_IS_AVAILABLE);
            $criteria->removeSelectColumn(StageVersionTableMap::COL_HOUSE_ID);
            $criteria->removeSelectColumn(StageVersionTableMap::COL_VERSION);
            $criteria->removeSelectColumn(StageVersionTableMap::COL_HOUSE_ID_VERSION);
            $criteria->removeSelectColumn(StageVersionTableMap::COL_STAGE_MATERIAL_IDS);
            $criteria->removeSelectColumn(StageVersionTableMap::COL_STAGE_MATERIAL_VERSIONS);
            $criteria->removeSelectColumn(StageVersionTableMap::COL_STAGE_TECHNIC_IDS);
            $criteria->removeSelectColumn(StageVersionTableMap::COL_STAGE_TECHNIC_VERSIONS);
            $criteria->removeSelectColumn(StageVersionTableMap::COL_STAGE_WORK_IDS);
            $criteria->removeSelectColumn(StageVersionTableMap::COL_STAGE_WORK_VERSIONS);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.name');
            $criteria->removeSelectColumn($alias . '.status');
            $criteria->removeSelectColumn($alias . '.is_available');
            $criteria->removeSelectColumn($alias . '.house_id');
            $criteria->removeSelectColumn($alias . '.version');
            $criteria->removeSelectColumn($alias . '.house_id_version');
            $criteria->removeSelectColumn($alias . '.stage_material_ids');
            $criteria->removeSelectColumn($alias . '.stage_material_versions');
            $criteria->removeSelectColumn($alias . '.stage_technic_ids');
            $criteria->removeSelectColumn($alias . '.stage_technic_versions');
            $criteria->removeSelectColumn($alias . '.stage_work_ids');
            $criteria->removeSelectColumn($alias . '.stage_work_versions');
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
        return Propel::getServiceContainer()->getDatabaseMap(StageVersionTableMap::DATABASE_NAME)->getTable(StageVersionTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a StageVersion or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or StageVersion object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(StageVersionTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \DB\StageVersion) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(StageVersionTableMap::DATABASE_NAME);
            // primary key is composite; we therefore, expect
            // the primary key passed to be an array of pkey values
            if (count($values) == count($values, COUNT_RECURSIVE)) {
                // array is not multi-dimensional
                $values = [$values];
            }
            foreach ($values as $value) {
                $criterion = $criteria->getNewCriterion(StageVersionTableMap::COL_ID, $value[0]);
                $criterion->addAnd($criteria->getNewCriterion(StageVersionTableMap::COL_VERSION, $value[1]));
                $criteria->addOr($criterion);
            }
        }

        $query = StageVersionQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            StageVersionTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                StageVersionTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the stage_version table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return StageVersionQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a StageVersion or Criteria object.
     *
     * @param mixed $criteria Criteria or StageVersion object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(StageVersionTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from StageVersion object
        }


        // Set the correct dbName
        $query = StageVersionQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
