<?php

namespace DB\Map;

use DB\ObjStageVersion;
use DB\ObjStageVersionQuery;
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
 * This class defines the structure of the 'obj_stage_version' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class ObjStageVersionTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'DB.Map.ObjStageVersionTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'obj_stage_version';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'ObjStageVersion';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\DB\\ObjStageVersion';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'DB.ObjStageVersion';

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
    public const COL_ID = 'obj_stage_version.id';

    /**
     * the column name for the name field
     */
    public const COL_NAME = 'obj_stage_version.name';

    /**
     * the column name for the status field
     */
    public const COL_STATUS = 'obj_stage_version.status';

    /**
     * the column name for the is_public field
     */
    public const COL_IS_PUBLIC = 'obj_stage_version.is_public';

    /**
     * the column name for the is_available field
     */
    public const COL_IS_AVAILABLE = 'obj_stage_version.is_available';

    /**
     * the column name for the house_id field
     */
    public const COL_HOUSE_ID = 'obj_stage_version.house_id';

    /**
     * the column name for the version_created_by field
     */
    public const COL_VERSION_CREATED_BY = 'obj_stage_version.version_created_by';

    /**
     * the column name for the version field
     */
    public const COL_VERSION = 'obj_stage_version.version';

    /**
     * the column name for the version_created_at field
     */
    public const COL_VERSION_CREATED_AT = 'obj_stage_version.version_created_at';

    /**
     * the column name for the version_comment field
     */
    public const COL_VERSION_COMMENT = 'obj_stage_version.version_comment';

    /**
     * the column name for the house_id_version field
     */
    public const COL_HOUSE_ID_VERSION = 'obj_stage_version.house_id_version';

    /**
     * the column name for the obj_stage_work_ids field
     */
    public const COL_OBJ_STAGE_WORK_IDS = 'obj_stage_version.obj_stage_work_ids';

    /**
     * the column name for the obj_stage_work_versions field
     */
    public const COL_OBJ_STAGE_WORK_VERSIONS = 'obj_stage_version.obj_stage_work_versions';

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
        self::TYPE_PHPNAME       => ['Id', 'Name', 'Status', 'IsPublic', 'IsAvailable', 'HouseId', 'VersionCreatedBy', 'Version', 'VersionCreatedAt', 'VersionComment', 'HouseIdVersion', 'ObjStageWorkIds', 'ObjStageWorkVersions', ],
        self::TYPE_CAMELNAME     => ['id', 'name', 'status', 'isPublic', 'isAvailable', 'houseId', 'versionCreatedBy', 'version', 'versionCreatedAt', 'versionComment', 'houseIdVersion', 'objStageWorkIds', 'objStageWorkVersions', ],
        self::TYPE_COLNAME       => [ObjStageVersionTableMap::COL_ID, ObjStageVersionTableMap::COL_NAME, ObjStageVersionTableMap::COL_STATUS, ObjStageVersionTableMap::COL_IS_PUBLIC, ObjStageVersionTableMap::COL_IS_AVAILABLE, ObjStageVersionTableMap::COL_HOUSE_ID, ObjStageVersionTableMap::COL_VERSION_CREATED_BY, ObjStageVersionTableMap::COL_VERSION, ObjStageVersionTableMap::COL_VERSION_CREATED_AT, ObjStageVersionTableMap::COL_VERSION_COMMENT, ObjStageVersionTableMap::COL_HOUSE_ID_VERSION, ObjStageVersionTableMap::COL_OBJ_STAGE_WORK_IDS, ObjStageVersionTableMap::COL_OBJ_STAGE_WORK_VERSIONS, ],
        self::TYPE_FIELDNAME     => ['id', 'name', 'status', 'is_public', 'is_available', 'house_id', 'version_created_by', 'version', 'version_created_at', 'version_comment', 'house_id_version', 'obj_stage_work_ids', 'obj_stage_work_versions', ],
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
        self::TYPE_PHPNAME       => ['Id' => 0, 'Name' => 1, 'Status' => 2, 'IsPublic' => 3, 'IsAvailable' => 4, 'HouseId' => 5, 'VersionCreatedBy' => 6, 'Version' => 7, 'VersionCreatedAt' => 8, 'VersionComment' => 9, 'HouseIdVersion' => 10, 'ObjStageWorkIds' => 11, 'ObjStageWorkVersions' => 12, ],
        self::TYPE_CAMELNAME     => ['id' => 0, 'name' => 1, 'status' => 2, 'isPublic' => 3, 'isAvailable' => 4, 'houseId' => 5, 'versionCreatedBy' => 6, 'version' => 7, 'versionCreatedAt' => 8, 'versionComment' => 9, 'houseIdVersion' => 10, 'objStageWorkIds' => 11, 'objStageWorkVersions' => 12, ],
        self::TYPE_COLNAME       => [ObjStageVersionTableMap::COL_ID => 0, ObjStageVersionTableMap::COL_NAME => 1, ObjStageVersionTableMap::COL_STATUS => 2, ObjStageVersionTableMap::COL_IS_PUBLIC => 3, ObjStageVersionTableMap::COL_IS_AVAILABLE => 4, ObjStageVersionTableMap::COL_HOUSE_ID => 5, ObjStageVersionTableMap::COL_VERSION_CREATED_BY => 6, ObjStageVersionTableMap::COL_VERSION => 7, ObjStageVersionTableMap::COL_VERSION_CREATED_AT => 8, ObjStageVersionTableMap::COL_VERSION_COMMENT => 9, ObjStageVersionTableMap::COL_HOUSE_ID_VERSION => 10, ObjStageVersionTableMap::COL_OBJ_STAGE_WORK_IDS => 11, ObjStageVersionTableMap::COL_OBJ_STAGE_WORK_VERSIONS => 12, ],
        self::TYPE_FIELDNAME     => ['id' => 0, 'name' => 1, 'status' => 2, 'is_public' => 3, 'is_available' => 4, 'house_id' => 5, 'version_created_by' => 6, 'version' => 7, 'version_created_at' => 8, 'version_comment' => 9, 'house_id_version' => 10, 'obj_stage_work_ids' => 11, 'obj_stage_work_versions' => 12, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'ObjStageVersion.Id' => 'ID',
        'id' => 'ID',
        'objStageVersion.id' => 'ID',
        'ObjStageVersionTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'obj_stage_version.id' => 'ID',
        'Name' => 'NAME',
        'ObjStageVersion.Name' => 'NAME',
        'name' => 'NAME',
        'objStageVersion.name' => 'NAME',
        'ObjStageVersionTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'obj_stage_version.name' => 'NAME',
        'Status' => 'STATUS',
        'ObjStageVersion.Status' => 'STATUS',
        'status' => 'STATUS',
        'objStageVersion.status' => 'STATUS',
        'ObjStageVersionTableMap::COL_STATUS' => 'STATUS',
        'COL_STATUS' => 'STATUS',
        'obj_stage_version.status' => 'STATUS',
        'IsPublic' => 'IS_PUBLIC',
        'ObjStageVersion.IsPublic' => 'IS_PUBLIC',
        'isPublic' => 'IS_PUBLIC',
        'objStageVersion.isPublic' => 'IS_PUBLIC',
        'ObjStageVersionTableMap::COL_IS_PUBLIC' => 'IS_PUBLIC',
        'COL_IS_PUBLIC' => 'IS_PUBLIC',
        'is_public' => 'IS_PUBLIC',
        'obj_stage_version.is_public' => 'IS_PUBLIC',
        'IsAvailable' => 'IS_AVAILABLE',
        'ObjStageVersion.IsAvailable' => 'IS_AVAILABLE',
        'isAvailable' => 'IS_AVAILABLE',
        'objStageVersion.isAvailable' => 'IS_AVAILABLE',
        'ObjStageVersionTableMap::COL_IS_AVAILABLE' => 'IS_AVAILABLE',
        'COL_IS_AVAILABLE' => 'IS_AVAILABLE',
        'is_available' => 'IS_AVAILABLE',
        'obj_stage_version.is_available' => 'IS_AVAILABLE',
        'HouseId' => 'HOUSE_ID',
        'ObjStageVersion.HouseId' => 'HOUSE_ID',
        'houseId' => 'HOUSE_ID',
        'objStageVersion.houseId' => 'HOUSE_ID',
        'ObjStageVersionTableMap::COL_HOUSE_ID' => 'HOUSE_ID',
        'COL_HOUSE_ID' => 'HOUSE_ID',
        'house_id' => 'HOUSE_ID',
        'obj_stage_version.house_id' => 'HOUSE_ID',
        'VersionCreatedBy' => 'VERSION_CREATED_BY',
        'ObjStageVersion.VersionCreatedBy' => 'VERSION_CREATED_BY',
        'versionCreatedBy' => 'VERSION_CREATED_BY',
        'objStageVersion.versionCreatedBy' => 'VERSION_CREATED_BY',
        'ObjStageVersionTableMap::COL_VERSION_CREATED_BY' => 'VERSION_CREATED_BY',
        'COL_VERSION_CREATED_BY' => 'VERSION_CREATED_BY',
        'version_created_by' => 'VERSION_CREATED_BY',
        'obj_stage_version.version_created_by' => 'VERSION_CREATED_BY',
        'Version' => 'VERSION',
        'ObjStageVersion.Version' => 'VERSION',
        'version' => 'VERSION',
        'objStageVersion.version' => 'VERSION',
        'ObjStageVersionTableMap::COL_VERSION' => 'VERSION',
        'COL_VERSION' => 'VERSION',
        'obj_stage_version.version' => 'VERSION',
        'VersionCreatedAt' => 'VERSION_CREATED_AT',
        'ObjStageVersion.VersionCreatedAt' => 'VERSION_CREATED_AT',
        'versionCreatedAt' => 'VERSION_CREATED_AT',
        'objStageVersion.versionCreatedAt' => 'VERSION_CREATED_AT',
        'ObjStageVersionTableMap::COL_VERSION_CREATED_AT' => 'VERSION_CREATED_AT',
        'COL_VERSION_CREATED_AT' => 'VERSION_CREATED_AT',
        'version_created_at' => 'VERSION_CREATED_AT',
        'obj_stage_version.version_created_at' => 'VERSION_CREATED_AT',
        'VersionComment' => 'VERSION_COMMENT',
        'ObjStageVersion.VersionComment' => 'VERSION_COMMENT',
        'versionComment' => 'VERSION_COMMENT',
        'objStageVersion.versionComment' => 'VERSION_COMMENT',
        'ObjStageVersionTableMap::COL_VERSION_COMMENT' => 'VERSION_COMMENT',
        'COL_VERSION_COMMENT' => 'VERSION_COMMENT',
        'version_comment' => 'VERSION_COMMENT',
        'obj_stage_version.version_comment' => 'VERSION_COMMENT',
        'HouseIdVersion' => 'HOUSE_ID_VERSION',
        'ObjStageVersion.HouseIdVersion' => 'HOUSE_ID_VERSION',
        'houseIdVersion' => 'HOUSE_ID_VERSION',
        'objStageVersion.houseIdVersion' => 'HOUSE_ID_VERSION',
        'ObjStageVersionTableMap::COL_HOUSE_ID_VERSION' => 'HOUSE_ID_VERSION',
        'COL_HOUSE_ID_VERSION' => 'HOUSE_ID_VERSION',
        'house_id_version' => 'HOUSE_ID_VERSION',
        'obj_stage_version.house_id_version' => 'HOUSE_ID_VERSION',
        'ObjStageWorkIds' => 'OBJ_STAGE_WORK_IDS',
        'ObjStageVersion.ObjStageWorkIds' => 'OBJ_STAGE_WORK_IDS',
        'objStageWorkIds' => 'OBJ_STAGE_WORK_IDS',
        'objStageVersion.objStageWorkIds' => 'OBJ_STAGE_WORK_IDS',
        'ObjStageVersionTableMap::COL_OBJ_STAGE_WORK_IDS' => 'OBJ_STAGE_WORK_IDS',
        'COL_OBJ_STAGE_WORK_IDS' => 'OBJ_STAGE_WORK_IDS',
        'obj_stage_work_ids' => 'OBJ_STAGE_WORK_IDS',
        'obj_stage_version.obj_stage_work_ids' => 'OBJ_STAGE_WORK_IDS',
        'ObjStageWorkVersions' => 'OBJ_STAGE_WORK_VERSIONS',
        'ObjStageVersion.ObjStageWorkVersions' => 'OBJ_STAGE_WORK_VERSIONS',
        'objStageWorkVersions' => 'OBJ_STAGE_WORK_VERSIONS',
        'objStageVersion.objStageWorkVersions' => 'OBJ_STAGE_WORK_VERSIONS',
        'ObjStageVersionTableMap::COL_OBJ_STAGE_WORK_VERSIONS' => 'OBJ_STAGE_WORK_VERSIONS',
        'COL_OBJ_STAGE_WORK_VERSIONS' => 'OBJ_STAGE_WORK_VERSIONS',
        'obj_stage_work_versions' => 'OBJ_STAGE_WORK_VERSIONS',
        'obj_stage_version.obj_stage_work_versions' => 'OBJ_STAGE_WORK_VERSIONS',
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
        $this->setName('obj_stage_version');
        $this->setPhpName('ObjStageVersion');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\DB\\ObjStageVersion');
        $this->setPackage('DB');
        $this->setUseIdGenerator(false);
        // columns
        $this->addForeignPrimaryKey('id', 'Id', 'INTEGER' , 'obj_stage', 'id', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 255, null);
        $this->addColumn('status', 'Status', 'CHAR', true, null, 'in_process');
        $this->addColumn('is_public', 'IsPublic', 'BOOLEAN', true, 1, true);
        $this->addColumn('is_available', 'IsAvailable', 'BOOLEAN', true, 1, true);
        $this->addColumn('house_id', 'HouseId', 'INTEGER', true, null, null);
        $this->addColumn('version_created_by', 'VersionCreatedBy', 'INTEGER', true, null, null);
        $this->addPrimaryKey('version', 'Version', 'INTEGER', true, null, 0);
        $this->addColumn('version_created_at', 'VersionCreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('version_comment', 'VersionComment', 'VARCHAR', false, 255, null);
        $this->addColumn('house_id_version', 'HouseIdVersion', 'INTEGER', false, null, 0);
        $this->addColumn('obj_stage_work_ids', 'ObjStageWorkIds', 'ARRAY', false, null, null);
        $this->addColumn('obj_stage_work_versions', 'ObjStageWorkVersions', 'ARRAY', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('ObjStage', '\\DB\\ObjStage', RelationMap::MANY_TO_ONE, array (
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
     * @param \DB\ObjStageVersion $obj A \DB\ObjStageVersion object.
     * @param string|null $key Key (optional) to use for instance map (for performance boost if key was already calculated externally).
     *
     * @return void
     */
    public static function addInstanceToPool(ObjStageVersion $obj, ?string $key = null): void
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
     * @param mixed $value A \DB\ObjStageVersion object or a primary key value.
     *
     * @return void
     */
    public static function removeInstanceFromPool($value): void
    {
        if (Propel::isInstancePoolingEnabled() && null !== $value) {
            if (is_object($value) && $value instanceof \DB\ObjStageVersion) {
                $key = serialize([(null === $value->getId() || is_scalar($value->getId()) || is_callable([$value->getId(), '__toString']) ? (string) $value->getId() : $value->getId()), (null === $value->getVersion() || is_scalar($value->getVersion()) || is_callable([$value->getVersion(), '__toString']) ? (string) $value->getVersion() : $value->getVersion())]);

            } elseif (is_array($value) && count($value) === 2) {
                // assume we've been passed a primary key";
                $key = serialize([(null === $value[0] || is_scalar($value[0]) || is_callable([$value[0], '__toString']) ? (string) $value[0] : $value[0]), (null === $value[1] || is_scalar($value[1]) || is_callable([$value[1], '__toString']) ? (string) $value[1] : $value[1])]);
            } elseif ($value instanceof Criteria) {
                self::$instances = [];

                return;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or \DB\ObjStageVersion object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value, true)));
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null && $row[TableMap::TYPE_NUM == $indexType ? 7 + $offset : static::translateFieldName('Version', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return serialize([(null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]), (null === $row[TableMap::TYPE_NUM == $indexType ? 7 + $offset : static::translateFieldName('Version', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 7 + $offset : static::translateFieldName('Version', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 7 + $offset : static::translateFieldName('Version', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 7 + $offset : static::translateFieldName('Version', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 7 + $offset : static::translateFieldName('Version', TableMap::TYPE_PHPNAME, $indexType)])]);
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
                ? 7 + $offset
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
        return $withPrefix ? ObjStageVersionTableMap::CLASS_DEFAULT : ObjStageVersionTableMap::OM_CLASS;
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
     * @return array (ObjStageVersion object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = ObjStageVersionTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ObjStageVersionTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ObjStageVersionTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ObjStageVersionTableMap::OM_CLASS;
            /** @var ObjStageVersion $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ObjStageVersionTableMap::addInstanceToPool($obj, $key);
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
            $key = ObjStageVersionTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ObjStageVersionTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var ObjStageVersion $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ObjStageVersionTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ObjStageVersionTableMap::COL_ID);
            $criteria->addSelectColumn(ObjStageVersionTableMap::COL_NAME);
            $criteria->addSelectColumn(ObjStageVersionTableMap::COL_STATUS);
            $criteria->addSelectColumn(ObjStageVersionTableMap::COL_IS_PUBLIC);
            $criteria->addSelectColumn(ObjStageVersionTableMap::COL_IS_AVAILABLE);
            $criteria->addSelectColumn(ObjStageVersionTableMap::COL_HOUSE_ID);
            $criteria->addSelectColumn(ObjStageVersionTableMap::COL_VERSION_CREATED_BY);
            $criteria->addSelectColumn(ObjStageVersionTableMap::COL_VERSION);
            $criteria->addSelectColumn(ObjStageVersionTableMap::COL_VERSION_CREATED_AT);
            $criteria->addSelectColumn(ObjStageVersionTableMap::COL_VERSION_COMMENT);
            $criteria->addSelectColumn(ObjStageVersionTableMap::COL_HOUSE_ID_VERSION);
            $criteria->addSelectColumn(ObjStageVersionTableMap::COL_OBJ_STAGE_WORK_IDS);
            $criteria->addSelectColumn(ObjStageVersionTableMap::COL_OBJ_STAGE_WORK_VERSIONS);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.status');
            $criteria->addSelectColumn($alias . '.is_public');
            $criteria->addSelectColumn($alias . '.is_available');
            $criteria->addSelectColumn($alias . '.house_id');
            $criteria->addSelectColumn($alias . '.version_created_by');
            $criteria->addSelectColumn($alias . '.version');
            $criteria->addSelectColumn($alias . '.version_created_at');
            $criteria->addSelectColumn($alias . '.version_comment');
            $criteria->addSelectColumn($alias . '.house_id_version');
            $criteria->addSelectColumn($alias . '.obj_stage_work_ids');
            $criteria->addSelectColumn($alias . '.obj_stage_work_versions');
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
            $criteria->removeSelectColumn(ObjStageVersionTableMap::COL_ID);
            $criteria->removeSelectColumn(ObjStageVersionTableMap::COL_NAME);
            $criteria->removeSelectColumn(ObjStageVersionTableMap::COL_STATUS);
            $criteria->removeSelectColumn(ObjStageVersionTableMap::COL_IS_PUBLIC);
            $criteria->removeSelectColumn(ObjStageVersionTableMap::COL_IS_AVAILABLE);
            $criteria->removeSelectColumn(ObjStageVersionTableMap::COL_HOUSE_ID);
            $criteria->removeSelectColumn(ObjStageVersionTableMap::COL_VERSION_CREATED_BY);
            $criteria->removeSelectColumn(ObjStageVersionTableMap::COL_VERSION);
            $criteria->removeSelectColumn(ObjStageVersionTableMap::COL_VERSION_CREATED_AT);
            $criteria->removeSelectColumn(ObjStageVersionTableMap::COL_VERSION_COMMENT);
            $criteria->removeSelectColumn(ObjStageVersionTableMap::COL_HOUSE_ID_VERSION);
            $criteria->removeSelectColumn(ObjStageVersionTableMap::COL_OBJ_STAGE_WORK_IDS);
            $criteria->removeSelectColumn(ObjStageVersionTableMap::COL_OBJ_STAGE_WORK_VERSIONS);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.name');
            $criteria->removeSelectColumn($alias . '.status');
            $criteria->removeSelectColumn($alias . '.is_public');
            $criteria->removeSelectColumn($alias . '.is_available');
            $criteria->removeSelectColumn($alias . '.house_id');
            $criteria->removeSelectColumn($alias . '.version_created_by');
            $criteria->removeSelectColumn($alias . '.version');
            $criteria->removeSelectColumn($alias . '.version_created_at');
            $criteria->removeSelectColumn($alias . '.version_comment');
            $criteria->removeSelectColumn($alias . '.house_id_version');
            $criteria->removeSelectColumn($alias . '.obj_stage_work_ids');
            $criteria->removeSelectColumn($alias . '.obj_stage_work_versions');
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
        return Propel::getServiceContainer()->getDatabaseMap(ObjStageVersionTableMap::DATABASE_NAME)->getTable(ObjStageVersionTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a ObjStageVersion or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or ObjStageVersion object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ObjStageVersionTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \DB\ObjStageVersion) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ObjStageVersionTableMap::DATABASE_NAME);
            // primary key is composite; we therefore, expect
            // the primary key passed to be an array of pkey values
            if (count($values) == count($values, COUNT_RECURSIVE)) {
                // array is not multi-dimensional
                $values = [$values];
            }
            foreach ($values as $value) {
                $criterion = $criteria->getNewCriterion(ObjStageVersionTableMap::COL_ID, $value[0]);
                $criterion->addAnd($criteria->getNewCriterion(ObjStageVersionTableMap::COL_VERSION, $value[1]));
                $criteria->addOr($criterion);
            }
        }

        $query = ObjStageVersionQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ObjStageVersionTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ObjStageVersionTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the obj_stage_version table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return ObjStageVersionQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a ObjStageVersion or Criteria object.
     *
     * @param mixed $criteria Criteria or ObjStageVersion object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ObjStageVersionTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from ObjStageVersion object
        }


        // Set the correct dbName
        $query = ObjStageVersionQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
