<?php

namespace DB\Map;

use DB\VolMaterialVersion;
use DB\VolMaterialVersionQuery;
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
 * This class defines the structure of the 'vol_material_version' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class VolMaterialVersionTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'DB.Map.VolMaterialVersionTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'vol_material_version';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'VolMaterialVersion';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\DB\\VolMaterialVersion';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'DB.VolMaterialVersion';

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
    public const COL_ID = 'vol_material_version.id';

    /**
     * the column name for the name field
     */
    public const COL_NAME = 'vol_material_version.name';

    /**
     * the column name for the price field
     */
    public const COL_PRICE = 'vol_material_version.price';

    /**
     * the column name for the is_available field
     */
    public const COL_IS_AVAILABLE = 'vol_material_version.is_available';

    /**
     * the column name for the unit_id field
     */
    public const COL_UNIT_ID = 'vol_material_version.unit_id';

    /**
     * the column name for the version_created_by field
     */
    public const COL_VERSION_CREATED_BY = 'vol_material_version.version_created_by';

    /**
     * the column name for the version field
     */
    public const COL_VERSION = 'vol_material_version.version';

    /**
     * the column name for the version_created_at field
     */
    public const COL_VERSION_CREATED_AT = 'vol_material_version.version_created_at';

    /**
     * the column name for the version_comment field
     */
    public const COL_VERSION_COMMENT = 'vol_material_version.version_comment';

    /**
     * the column name for the obj_stage_material_ids field
     */
    public const COL_OBJ_STAGE_MATERIAL_IDS = 'vol_material_version.obj_stage_material_ids';

    /**
     * the column name for the obj_stage_material_versions field
     */
    public const COL_OBJ_STAGE_MATERIAL_VERSIONS = 'vol_material_version.obj_stage_material_versions';

    /**
     * the column name for the vol_work_material_ids field
     */
    public const COL_VOL_WORK_MATERIAL_IDS = 'vol_material_version.vol_work_material_ids';

    /**
     * the column name for the vol_work_material_versions field
     */
    public const COL_VOL_WORK_MATERIAL_VERSIONS = 'vol_material_version.vol_work_material_versions';

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
        self::TYPE_PHPNAME       => ['Id', 'Name', 'Price', 'IsAvailable', 'UnitId', 'VersionCreatedBy', 'Version', 'VersionCreatedAt', 'VersionComment', 'ObjStageMaterialIds', 'ObjStageMaterialVersions', 'VolWorkMaterialIds', 'VolWorkMaterialVersions', ],
        self::TYPE_CAMELNAME     => ['id', 'name', 'price', 'isAvailable', 'unitId', 'versionCreatedBy', 'version', 'versionCreatedAt', 'versionComment', 'objStageMaterialIds', 'objStageMaterialVersions', 'volWorkMaterialIds', 'volWorkMaterialVersions', ],
        self::TYPE_COLNAME       => [VolMaterialVersionTableMap::COL_ID, VolMaterialVersionTableMap::COL_NAME, VolMaterialVersionTableMap::COL_PRICE, VolMaterialVersionTableMap::COL_IS_AVAILABLE, VolMaterialVersionTableMap::COL_UNIT_ID, VolMaterialVersionTableMap::COL_VERSION_CREATED_BY, VolMaterialVersionTableMap::COL_VERSION, VolMaterialVersionTableMap::COL_VERSION_CREATED_AT, VolMaterialVersionTableMap::COL_VERSION_COMMENT, VolMaterialVersionTableMap::COL_OBJ_STAGE_MATERIAL_IDS, VolMaterialVersionTableMap::COL_OBJ_STAGE_MATERIAL_VERSIONS, VolMaterialVersionTableMap::COL_VOL_WORK_MATERIAL_IDS, VolMaterialVersionTableMap::COL_VOL_WORK_MATERIAL_VERSIONS, ],
        self::TYPE_FIELDNAME     => ['id', 'name', 'price', 'is_available', 'unit_id', 'version_created_by', 'version', 'version_created_at', 'version_comment', 'obj_stage_material_ids', 'obj_stage_material_versions', 'vol_work_material_ids', 'vol_work_material_versions', ],
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
        self::TYPE_PHPNAME       => ['Id' => 0, 'Name' => 1, 'Price' => 2, 'IsAvailable' => 3, 'UnitId' => 4, 'VersionCreatedBy' => 5, 'Version' => 6, 'VersionCreatedAt' => 7, 'VersionComment' => 8, 'ObjStageMaterialIds' => 9, 'ObjStageMaterialVersions' => 10, 'VolWorkMaterialIds' => 11, 'VolWorkMaterialVersions' => 12, ],
        self::TYPE_CAMELNAME     => ['id' => 0, 'name' => 1, 'price' => 2, 'isAvailable' => 3, 'unitId' => 4, 'versionCreatedBy' => 5, 'version' => 6, 'versionCreatedAt' => 7, 'versionComment' => 8, 'objStageMaterialIds' => 9, 'objStageMaterialVersions' => 10, 'volWorkMaterialIds' => 11, 'volWorkMaterialVersions' => 12, ],
        self::TYPE_COLNAME       => [VolMaterialVersionTableMap::COL_ID => 0, VolMaterialVersionTableMap::COL_NAME => 1, VolMaterialVersionTableMap::COL_PRICE => 2, VolMaterialVersionTableMap::COL_IS_AVAILABLE => 3, VolMaterialVersionTableMap::COL_UNIT_ID => 4, VolMaterialVersionTableMap::COL_VERSION_CREATED_BY => 5, VolMaterialVersionTableMap::COL_VERSION => 6, VolMaterialVersionTableMap::COL_VERSION_CREATED_AT => 7, VolMaterialVersionTableMap::COL_VERSION_COMMENT => 8, VolMaterialVersionTableMap::COL_OBJ_STAGE_MATERIAL_IDS => 9, VolMaterialVersionTableMap::COL_OBJ_STAGE_MATERIAL_VERSIONS => 10, VolMaterialVersionTableMap::COL_VOL_WORK_MATERIAL_IDS => 11, VolMaterialVersionTableMap::COL_VOL_WORK_MATERIAL_VERSIONS => 12, ],
        self::TYPE_FIELDNAME     => ['id' => 0, 'name' => 1, 'price' => 2, 'is_available' => 3, 'unit_id' => 4, 'version_created_by' => 5, 'version' => 6, 'version_created_at' => 7, 'version_comment' => 8, 'obj_stage_material_ids' => 9, 'obj_stage_material_versions' => 10, 'vol_work_material_ids' => 11, 'vol_work_material_versions' => 12, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'VolMaterialVersion.Id' => 'ID',
        'id' => 'ID',
        'volMaterialVersion.id' => 'ID',
        'VolMaterialVersionTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'vol_material_version.id' => 'ID',
        'Name' => 'NAME',
        'VolMaterialVersion.Name' => 'NAME',
        'name' => 'NAME',
        'volMaterialVersion.name' => 'NAME',
        'VolMaterialVersionTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'vol_material_version.name' => 'NAME',
        'Price' => 'PRICE',
        'VolMaterialVersion.Price' => 'PRICE',
        'price' => 'PRICE',
        'volMaterialVersion.price' => 'PRICE',
        'VolMaterialVersionTableMap::COL_PRICE' => 'PRICE',
        'COL_PRICE' => 'PRICE',
        'vol_material_version.price' => 'PRICE',
        'IsAvailable' => 'IS_AVAILABLE',
        'VolMaterialVersion.IsAvailable' => 'IS_AVAILABLE',
        'isAvailable' => 'IS_AVAILABLE',
        'volMaterialVersion.isAvailable' => 'IS_AVAILABLE',
        'VolMaterialVersionTableMap::COL_IS_AVAILABLE' => 'IS_AVAILABLE',
        'COL_IS_AVAILABLE' => 'IS_AVAILABLE',
        'is_available' => 'IS_AVAILABLE',
        'vol_material_version.is_available' => 'IS_AVAILABLE',
        'UnitId' => 'UNIT_ID',
        'VolMaterialVersion.UnitId' => 'UNIT_ID',
        'unitId' => 'UNIT_ID',
        'volMaterialVersion.unitId' => 'UNIT_ID',
        'VolMaterialVersionTableMap::COL_UNIT_ID' => 'UNIT_ID',
        'COL_UNIT_ID' => 'UNIT_ID',
        'unit_id' => 'UNIT_ID',
        'vol_material_version.unit_id' => 'UNIT_ID',
        'VersionCreatedBy' => 'VERSION_CREATED_BY',
        'VolMaterialVersion.VersionCreatedBy' => 'VERSION_CREATED_BY',
        'versionCreatedBy' => 'VERSION_CREATED_BY',
        'volMaterialVersion.versionCreatedBy' => 'VERSION_CREATED_BY',
        'VolMaterialVersionTableMap::COL_VERSION_CREATED_BY' => 'VERSION_CREATED_BY',
        'COL_VERSION_CREATED_BY' => 'VERSION_CREATED_BY',
        'version_created_by' => 'VERSION_CREATED_BY',
        'vol_material_version.version_created_by' => 'VERSION_CREATED_BY',
        'Version' => 'VERSION',
        'VolMaterialVersion.Version' => 'VERSION',
        'version' => 'VERSION',
        'volMaterialVersion.version' => 'VERSION',
        'VolMaterialVersionTableMap::COL_VERSION' => 'VERSION',
        'COL_VERSION' => 'VERSION',
        'vol_material_version.version' => 'VERSION',
        'VersionCreatedAt' => 'VERSION_CREATED_AT',
        'VolMaterialVersion.VersionCreatedAt' => 'VERSION_CREATED_AT',
        'versionCreatedAt' => 'VERSION_CREATED_AT',
        'volMaterialVersion.versionCreatedAt' => 'VERSION_CREATED_AT',
        'VolMaterialVersionTableMap::COL_VERSION_CREATED_AT' => 'VERSION_CREATED_AT',
        'COL_VERSION_CREATED_AT' => 'VERSION_CREATED_AT',
        'version_created_at' => 'VERSION_CREATED_AT',
        'vol_material_version.version_created_at' => 'VERSION_CREATED_AT',
        'VersionComment' => 'VERSION_COMMENT',
        'VolMaterialVersion.VersionComment' => 'VERSION_COMMENT',
        'versionComment' => 'VERSION_COMMENT',
        'volMaterialVersion.versionComment' => 'VERSION_COMMENT',
        'VolMaterialVersionTableMap::COL_VERSION_COMMENT' => 'VERSION_COMMENT',
        'COL_VERSION_COMMENT' => 'VERSION_COMMENT',
        'version_comment' => 'VERSION_COMMENT',
        'vol_material_version.version_comment' => 'VERSION_COMMENT',
        'ObjStageMaterialIds' => 'OBJ_STAGE_MATERIAL_IDS',
        'VolMaterialVersion.ObjStageMaterialIds' => 'OBJ_STAGE_MATERIAL_IDS',
        'objStageMaterialIds' => 'OBJ_STAGE_MATERIAL_IDS',
        'volMaterialVersion.objStageMaterialIds' => 'OBJ_STAGE_MATERIAL_IDS',
        'VolMaterialVersionTableMap::COL_OBJ_STAGE_MATERIAL_IDS' => 'OBJ_STAGE_MATERIAL_IDS',
        'COL_OBJ_STAGE_MATERIAL_IDS' => 'OBJ_STAGE_MATERIAL_IDS',
        'obj_stage_material_ids' => 'OBJ_STAGE_MATERIAL_IDS',
        'vol_material_version.obj_stage_material_ids' => 'OBJ_STAGE_MATERIAL_IDS',
        'ObjStageMaterialVersions' => 'OBJ_STAGE_MATERIAL_VERSIONS',
        'VolMaterialVersion.ObjStageMaterialVersions' => 'OBJ_STAGE_MATERIAL_VERSIONS',
        'objStageMaterialVersions' => 'OBJ_STAGE_MATERIAL_VERSIONS',
        'volMaterialVersion.objStageMaterialVersions' => 'OBJ_STAGE_MATERIAL_VERSIONS',
        'VolMaterialVersionTableMap::COL_OBJ_STAGE_MATERIAL_VERSIONS' => 'OBJ_STAGE_MATERIAL_VERSIONS',
        'COL_OBJ_STAGE_MATERIAL_VERSIONS' => 'OBJ_STAGE_MATERIAL_VERSIONS',
        'obj_stage_material_versions' => 'OBJ_STAGE_MATERIAL_VERSIONS',
        'vol_material_version.obj_stage_material_versions' => 'OBJ_STAGE_MATERIAL_VERSIONS',
        'VolWorkMaterialIds' => 'VOL_WORK_MATERIAL_IDS',
        'VolMaterialVersion.VolWorkMaterialIds' => 'VOL_WORK_MATERIAL_IDS',
        'volWorkMaterialIds' => 'VOL_WORK_MATERIAL_IDS',
        'volMaterialVersion.volWorkMaterialIds' => 'VOL_WORK_MATERIAL_IDS',
        'VolMaterialVersionTableMap::COL_VOL_WORK_MATERIAL_IDS' => 'VOL_WORK_MATERIAL_IDS',
        'COL_VOL_WORK_MATERIAL_IDS' => 'VOL_WORK_MATERIAL_IDS',
        'vol_work_material_ids' => 'VOL_WORK_MATERIAL_IDS',
        'vol_material_version.vol_work_material_ids' => 'VOL_WORK_MATERIAL_IDS',
        'VolWorkMaterialVersions' => 'VOL_WORK_MATERIAL_VERSIONS',
        'VolMaterialVersion.VolWorkMaterialVersions' => 'VOL_WORK_MATERIAL_VERSIONS',
        'volWorkMaterialVersions' => 'VOL_WORK_MATERIAL_VERSIONS',
        'volMaterialVersion.volWorkMaterialVersions' => 'VOL_WORK_MATERIAL_VERSIONS',
        'VolMaterialVersionTableMap::COL_VOL_WORK_MATERIAL_VERSIONS' => 'VOL_WORK_MATERIAL_VERSIONS',
        'COL_VOL_WORK_MATERIAL_VERSIONS' => 'VOL_WORK_MATERIAL_VERSIONS',
        'vol_work_material_versions' => 'VOL_WORK_MATERIAL_VERSIONS',
        'vol_material_version.vol_work_material_versions' => 'VOL_WORK_MATERIAL_VERSIONS',
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
        $this->setName('vol_material_version');
        $this->setPhpName('VolMaterialVersion');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\DB\\VolMaterialVersion');
        $this->setPackage('DB');
        $this->setUseIdGenerator(false);
        // columns
        $this->addForeignPrimaryKey('id', 'Id', 'INTEGER' , 'vol_material', 'id', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 255, null);
        $this->addColumn('price', 'Price', 'DECIMAL', true, 19, null);
        $this->addColumn('is_available', 'IsAvailable', 'BOOLEAN', true, 1, true);
        $this->addColumn('unit_id', 'UnitId', 'INTEGER', true, null, null);
        $this->addColumn('version_created_by', 'VersionCreatedBy', 'INTEGER', true, null, null);
        $this->addPrimaryKey('version', 'Version', 'INTEGER', true, null, 0);
        $this->addColumn('version_created_at', 'VersionCreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('version_comment', 'VersionComment', 'VARCHAR', false, 255, null);
        $this->addColumn('obj_stage_material_ids', 'ObjStageMaterialIds', 'ARRAY', false, null, null);
        $this->addColumn('obj_stage_material_versions', 'ObjStageMaterialVersions', 'ARRAY', false, null, null);
        $this->addColumn('vol_work_material_ids', 'VolWorkMaterialIds', 'ARRAY', false, null, null);
        $this->addColumn('vol_work_material_versions', 'VolWorkMaterialVersions', 'ARRAY', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('VolMaterial', '\\DB\\VolMaterial', RelationMap::MANY_TO_ONE, array (
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
     * @param \DB\VolMaterialVersion $obj A \DB\VolMaterialVersion object.
     * @param string|null $key Key (optional) to use for instance map (for performance boost if key was already calculated externally).
     *
     * @return void
     */
    public static function addInstanceToPool(VolMaterialVersion $obj, ?string $key = null): void
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
     * @param mixed $value A \DB\VolMaterialVersion object or a primary key value.
     *
     * @return void
     */
    public static function removeInstanceFromPool($value): void
    {
        if (Propel::isInstancePoolingEnabled() && null !== $value) {
            if (is_object($value) && $value instanceof \DB\VolMaterialVersion) {
                $key = serialize([(null === $value->getId() || is_scalar($value->getId()) || is_callable([$value->getId(), '__toString']) ? (string) $value->getId() : $value->getId()), (null === $value->getVersion() || is_scalar($value->getVersion()) || is_callable([$value->getVersion(), '__toString']) ? (string) $value->getVersion() : $value->getVersion())]);

            } elseif (is_array($value) && count($value) === 2) {
                // assume we've been passed a primary key";
                $key = serialize([(null === $value[0] || is_scalar($value[0]) || is_callable([$value[0], '__toString']) ? (string) $value[0] : $value[0]), (null === $value[1] || is_scalar($value[1]) || is_callable([$value[1], '__toString']) ? (string) $value[1] : $value[1])]);
            } elseif ($value instanceof Criteria) {
                self::$instances = [];

                return;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or \DB\VolMaterialVersion object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value, true)));
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
        return $withPrefix ? VolMaterialVersionTableMap::CLASS_DEFAULT : VolMaterialVersionTableMap::OM_CLASS;
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
     * @return array (VolMaterialVersion object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = VolMaterialVersionTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = VolMaterialVersionTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + VolMaterialVersionTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = VolMaterialVersionTableMap::OM_CLASS;
            /** @var VolMaterialVersion $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            VolMaterialVersionTableMap::addInstanceToPool($obj, $key);
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
            $key = VolMaterialVersionTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = VolMaterialVersionTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var VolMaterialVersion $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                VolMaterialVersionTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(VolMaterialVersionTableMap::COL_ID);
            $criteria->addSelectColumn(VolMaterialVersionTableMap::COL_NAME);
            $criteria->addSelectColumn(VolMaterialVersionTableMap::COL_PRICE);
            $criteria->addSelectColumn(VolMaterialVersionTableMap::COL_IS_AVAILABLE);
            $criteria->addSelectColumn(VolMaterialVersionTableMap::COL_UNIT_ID);
            $criteria->addSelectColumn(VolMaterialVersionTableMap::COL_VERSION_CREATED_BY);
            $criteria->addSelectColumn(VolMaterialVersionTableMap::COL_VERSION);
            $criteria->addSelectColumn(VolMaterialVersionTableMap::COL_VERSION_CREATED_AT);
            $criteria->addSelectColumn(VolMaterialVersionTableMap::COL_VERSION_COMMENT);
            $criteria->addSelectColumn(VolMaterialVersionTableMap::COL_OBJ_STAGE_MATERIAL_IDS);
            $criteria->addSelectColumn(VolMaterialVersionTableMap::COL_OBJ_STAGE_MATERIAL_VERSIONS);
            $criteria->addSelectColumn(VolMaterialVersionTableMap::COL_VOL_WORK_MATERIAL_IDS);
            $criteria->addSelectColumn(VolMaterialVersionTableMap::COL_VOL_WORK_MATERIAL_VERSIONS);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.price');
            $criteria->addSelectColumn($alias . '.is_available');
            $criteria->addSelectColumn($alias . '.unit_id');
            $criteria->addSelectColumn($alias . '.version_created_by');
            $criteria->addSelectColumn($alias . '.version');
            $criteria->addSelectColumn($alias . '.version_created_at');
            $criteria->addSelectColumn($alias . '.version_comment');
            $criteria->addSelectColumn($alias . '.obj_stage_material_ids');
            $criteria->addSelectColumn($alias . '.obj_stage_material_versions');
            $criteria->addSelectColumn($alias . '.vol_work_material_ids');
            $criteria->addSelectColumn($alias . '.vol_work_material_versions');
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
            $criteria->removeSelectColumn(VolMaterialVersionTableMap::COL_ID);
            $criteria->removeSelectColumn(VolMaterialVersionTableMap::COL_NAME);
            $criteria->removeSelectColumn(VolMaterialVersionTableMap::COL_PRICE);
            $criteria->removeSelectColumn(VolMaterialVersionTableMap::COL_IS_AVAILABLE);
            $criteria->removeSelectColumn(VolMaterialVersionTableMap::COL_UNIT_ID);
            $criteria->removeSelectColumn(VolMaterialVersionTableMap::COL_VERSION_CREATED_BY);
            $criteria->removeSelectColumn(VolMaterialVersionTableMap::COL_VERSION);
            $criteria->removeSelectColumn(VolMaterialVersionTableMap::COL_VERSION_CREATED_AT);
            $criteria->removeSelectColumn(VolMaterialVersionTableMap::COL_VERSION_COMMENT);
            $criteria->removeSelectColumn(VolMaterialVersionTableMap::COL_OBJ_STAGE_MATERIAL_IDS);
            $criteria->removeSelectColumn(VolMaterialVersionTableMap::COL_OBJ_STAGE_MATERIAL_VERSIONS);
            $criteria->removeSelectColumn(VolMaterialVersionTableMap::COL_VOL_WORK_MATERIAL_IDS);
            $criteria->removeSelectColumn(VolMaterialVersionTableMap::COL_VOL_WORK_MATERIAL_VERSIONS);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.name');
            $criteria->removeSelectColumn($alias . '.price');
            $criteria->removeSelectColumn($alias . '.is_available');
            $criteria->removeSelectColumn($alias . '.unit_id');
            $criteria->removeSelectColumn($alias . '.version_created_by');
            $criteria->removeSelectColumn($alias . '.version');
            $criteria->removeSelectColumn($alias . '.version_created_at');
            $criteria->removeSelectColumn($alias . '.version_comment');
            $criteria->removeSelectColumn($alias . '.obj_stage_material_ids');
            $criteria->removeSelectColumn($alias . '.obj_stage_material_versions');
            $criteria->removeSelectColumn($alias . '.vol_work_material_ids');
            $criteria->removeSelectColumn($alias . '.vol_work_material_versions');
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
        return Propel::getServiceContainer()->getDatabaseMap(VolMaterialVersionTableMap::DATABASE_NAME)->getTable(VolMaterialVersionTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a VolMaterialVersion or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or VolMaterialVersion object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(VolMaterialVersionTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \DB\VolMaterialVersion) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(VolMaterialVersionTableMap::DATABASE_NAME);
            // primary key is composite; we therefore, expect
            // the primary key passed to be an array of pkey values
            if (count($values) == count($values, COUNT_RECURSIVE)) {
                // array is not multi-dimensional
                $values = [$values];
            }
            foreach ($values as $value) {
                $criterion = $criteria->getNewCriterion(VolMaterialVersionTableMap::COL_ID, $value[0]);
                $criterion->addAnd($criteria->getNewCriterion(VolMaterialVersionTableMap::COL_VERSION, $value[1]));
                $criteria->addOr($criterion);
            }
        }

        $query = VolMaterialVersionQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            VolMaterialVersionTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                VolMaterialVersionTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the vol_material_version table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return VolMaterialVersionQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a VolMaterialVersion or Criteria object.
     *
     * @param mixed $criteria Criteria or VolMaterialVersion object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(VolMaterialVersionTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from VolMaterialVersion object
        }


        // Set the correct dbName
        $query = VolMaterialVersionQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
