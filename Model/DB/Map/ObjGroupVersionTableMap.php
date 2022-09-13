<?php

namespace DB\Map;

use DB\ObjGroupVersion;
use DB\ObjGroupVersionQuery;
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
 * This class defines the structure of the 'obj_group_version' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class ObjGroupVersionTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'DB.Map.ObjGroupVersionTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'obj_group_version';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'ObjGroupVersion';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\DB\\ObjGroupVersion';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'DB.ObjGroupVersion';

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
    public const COL_ID = 'obj_group_version.id';

    /**
     * the column name for the name field
     */
    public const COL_NAME = 'obj_group_version.name';

    /**
     * the column name for the status field
     */
    public const COL_STATUS = 'obj_group_version.status';

    /**
     * the column name for the is_public field
     */
    public const COL_IS_PUBLIC = 'obj_group_version.is_public';

    /**
     * the column name for the is_available field
     */
    public const COL_IS_AVAILABLE = 'obj_group_version.is_available';

    /**
     * the column name for the subproject_id field
     */
    public const COL_SUBPROJECT_ID = 'obj_group_version.subproject_id';

    /**
     * the column name for the version_created_by field
     */
    public const COL_VERSION_CREATED_BY = 'obj_group_version.version_created_by';

    /**
     * the column name for the version field
     */
    public const COL_VERSION = 'obj_group_version.version';

    /**
     * the column name for the version_created_at field
     */
    public const COL_VERSION_CREATED_AT = 'obj_group_version.version_created_at';

    /**
     * the column name for the version_comment field
     */
    public const COL_VERSION_COMMENT = 'obj_group_version.version_comment';

    /**
     * the column name for the subproject_id_version field
     */
    public const COL_SUBPROJECT_ID_VERSION = 'obj_group_version.subproject_id_version';

    /**
     * the column name for the obj_house_ids field
     */
    public const COL_OBJ_HOUSE_IDS = 'obj_group_version.obj_house_ids';

    /**
     * the column name for the obj_house_versions field
     */
    public const COL_OBJ_HOUSE_VERSIONS = 'obj_group_version.obj_house_versions';

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
        self::TYPE_PHPNAME       => ['Id', 'Name', 'Status', 'IsPublic', 'IsAvailable', 'SubprojectId', 'VersionCreatedBy', 'Version', 'VersionCreatedAt', 'VersionComment', 'SubprojectIdVersion', 'ObjHouseIds', 'ObjHouseVersions', ],
        self::TYPE_CAMELNAME     => ['id', 'name', 'status', 'isPublic', 'isAvailable', 'subprojectId', 'versionCreatedBy', 'version', 'versionCreatedAt', 'versionComment', 'subprojectIdVersion', 'objHouseIds', 'objHouseVersions', ],
        self::TYPE_COLNAME       => [ObjGroupVersionTableMap::COL_ID, ObjGroupVersionTableMap::COL_NAME, ObjGroupVersionTableMap::COL_STATUS, ObjGroupVersionTableMap::COL_IS_PUBLIC, ObjGroupVersionTableMap::COL_IS_AVAILABLE, ObjGroupVersionTableMap::COL_SUBPROJECT_ID, ObjGroupVersionTableMap::COL_VERSION_CREATED_BY, ObjGroupVersionTableMap::COL_VERSION, ObjGroupVersionTableMap::COL_VERSION_CREATED_AT, ObjGroupVersionTableMap::COL_VERSION_COMMENT, ObjGroupVersionTableMap::COL_SUBPROJECT_ID_VERSION, ObjGroupVersionTableMap::COL_OBJ_HOUSE_IDS, ObjGroupVersionTableMap::COL_OBJ_HOUSE_VERSIONS, ],
        self::TYPE_FIELDNAME     => ['id', 'name', 'status', 'is_public', 'is_available', 'subproject_id', 'version_created_by', 'version', 'version_created_at', 'version_comment', 'subproject_id_version', 'obj_house_ids', 'obj_house_versions', ],
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
        self::TYPE_PHPNAME       => ['Id' => 0, 'Name' => 1, 'Status' => 2, 'IsPublic' => 3, 'IsAvailable' => 4, 'SubprojectId' => 5, 'VersionCreatedBy' => 6, 'Version' => 7, 'VersionCreatedAt' => 8, 'VersionComment' => 9, 'SubprojectIdVersion' => 10, 'ObjHouseIds' => 11, 'ObjHouseVersions' => 12, ],
        self::TYPE_CAMELNAME     => ['id' => 0, 'name' => 1, 'status' => 2, 'isPublic' => 3, 'isAvailable' => 4, 'subprojectId' => 5, 'versionCreatedBy' => 6, 'version' => 7, 'versionCreatedAt' => 8, 'versionComment' => 9, 'subprojectIdVersion' => 10, 'objHouseIds' => 11, 'objHouseVersions' => 12, ],
        self::TYPE_COLNAME       => [ObjGroupVersionTableMap::COL_ID => 0, ObjGroupVersionTableMap::COL_NAME => 1, ObjGroupVersionTableMap::COL_STATUS => 2, ObjGroupVersionTableMap::COL_IS_PUBLIC => 3, ObjGroupVersionTableMap::COL_IS_AVAILABLE => 4, ObjGroupVersionTableMap::COL_SUBPROJECT_ID => 5, ObjGroupVersionTableMap::COL_VERSION_CREATED_BY => 6, ObjGroupVersionTableMap::COL_VERSION => 7, ObjGroupVersionTableMap::COL_VERSION_CREATED_AT => 8, ObjGroupVersionTableMap::COL_VERSION_COMMENT => 9, ObjGroupVersionTableMap::COL_SUBPROJECT_ID_VERSION => 10, ObjGroupVersionTableMap::COL_OBJ_HOUSE_IDS => 11, ObjGroupVersionTableMap::COL_OBJ_HOUSE_VERSIONS => 12, ],
        self::TYPE_FIELDNAME     => ['id' => 0, 'name' => 1, 'status' => 2, 'is_public' => 3, 'is_available' => 4, 'subproject_id' => 5, 'version_created_by' => 6, 'version' => 7, 'version_created_at' => 8, 'version_comment' => 9, 'subproject_id_version' => 10, 'obj_house_ids' => 11, 'obj_house_versions' => 12, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'ObjGroupVersion.Id' => 'ID',
        'id' => 'ID',
        'objGroupVersion.id' => 'ID',
        'ObjGroupVersionTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'obj_group_version.id' => 'ID',
        'Name' => 'NAME',
        'ObjGroupVersion.Name' => 'NAME',
        'name' => 'NAME',
        'objGroupVersion.name' => 'NAME',
        'ObjGroupVersionTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'obj_group_version.name' => 'NAME',
        'Status' => 'STATUS',
        'ObjGroupVersion.Status' => 'STATUS',
        'status' => 'STATUS',
        'objGroupVersion.status' => 'STATUS',
        'ObjGroupVersionTableMap::COL_STATUS' => 'STATUS',
        'COL_STATUS' => 'STATUS',
        'obj_group_version.status' => 'STATUS',
        'IsPublic' => 'IS_PUBLIC',
        'ObjGroupVersion.IsPublic' => 'IS_PUBLIC',
        'isPublic' => 'IS_PUBLIC',
        'objGroupVersion.isPublic' => 'IS_PUBLIC',
        'ObjGroupVersionTableMap::COL_IS_PUBLIC' => 'IS_PUBLIC',
        'COL_IS_PUBLIC' => 'IS_PUBLIC',
        'is_public' => 'IS_PUBLIC',
        'obj_group_version.is_public' => 'IS_PUBLIC',
        'IsAvailable' => 'IS_AVAILABLE',
        'ObjGroupVersion.IsAvailable' => 'IS_AVAILABLE',
        'isAvailable' => 'IS_AVAILABLE',
        'objGroupVersion.isAvailable' => 'IS_AVAILABLE',
        'ObjGroupVersionTableMap::COL_IS_AVAILABLE' => 'IS_AVAILABLE',
        'COL_IS_AVAILABLE' => 'IS_AVAILABLE',
        'is_available' => 'IS_AVAILABLE',
        'obj_group_version.is_available' => 'IS_AVAILABLE',
        'SubprojectId' => 'SUBPROJECT_ID',
        'ObjGroupVersion.SubprojectId' => 'SUBPROJECT_ID',
        'subprojectId' => 'SUBPROJECT_ID',
        'objGroupVersion.subprojectId' => 'SUBPROJECT_ID',
        'ObjGroupVersionTableMap::COL_SUBPROJECT_ID' => 'SUBPROJECT_ID',
        'COL_SUBPROJECT_ID' => 'SUBPROJECT_ID',
        'subproject_id' => 'SUBPROJECT_ID',
        'obj_group_version.subproject_id' => 'SUBPROJECT_ID',
        'VersionCreatedBy' => 'VERSION_CREATED_BY',
        'ObjGroupVersion.VersionCreatedBy' => 'VERSION_CREATED_BY',
        'versionCreatedBy' => 'VERSION_CREATED_BY',
        'objGroupVersion.versionCreatedBy' => 'VERSION_CREATED_BY',
        'ObjGroupVersionTableMap::COL_VERSION_CREATED_BY' => 'VERSION_CREATED_BY',
        'COL_VERSION_CREATED_BY' => 'VERSION_CREATED_BY',
        'version_created_by' => 'VERSION_CREATED_BY',
        'obj_group_version.version_created_by' => 'VERSION_CREATED_BY',
        'Version' => 'VERSION',
        'ObjGroupVersion.Version' => 'VERSION',
        'version' => 'VERSION',
        'objGroupVersion.version' => 'VERSION',
        'ObjGroupVersionTableMap::COL_VERSION' => 'VERSION',
        'COL_VERSION' => 'VERSION',
        'obj_group_version.version' => 'VERSION',
        'VersionCreatedAt' => 'VERSION_CREATED_AT',
        'ObjGroupVersion.VersionCreatedAt' => 'VERSION_CREATED_AT',
        'versionCreatedAt' => 'VERSION_CREATED_AT',
        'objGroupVersion.versionCreatedAt' => 'VERSION_CREATED_AT',
        'ObjGroupVersionTableMap::COL_VERSION_CREATED_AT' => 'VERSION_CREATED_AT',
        'COL_VERSION_CREATED_AT' => 'VERSION_CREATED_AT',
        'version_created_at' => 'VERSION_CREATED_AT',
        'obj_group_version.version_created_at' => 'VERSION_CREATED_AT',
        'VersionComment' => 'VERSION_COMMENT',
        'ObjGroupVersion.VersionComment' => 'VERSION_COMMENT',
        'versionComment' => 'VERSION_COMMENT',
        'objGroupVersion.versionComment' => 'VERSION_COMMENT',
        'ObjGroupVersionTableMap::COL_VERSION_COMMENT' => 'VERSION_COMMENT',
        'COL_VERSION_COMMENT' => 'VERSION_COMMENT',
        'version_comment' => 'VERSION_COMMENT',
        'obj_group_version.version_comment' => 'VERSION_COMMENT',
        'SubprojectIdVersion' => 'SUBPROJECT_ID_VERSION',
        'ObjGroupVersion.SubprojectIdVersion' => 'SUBPROJECT_ID_VERSION',
        'subprojectIdVersion' => 'SUBPROJECT_ID_VERSION',
        'objGroupVersion.subprojectIdVersion' => 'SUBPROJECT_ID_VERSION',
        'ObjGroupVersionTableMap::COL_SUBPROJECT_ID_VERSION' => 'SUBPROJECT_ID_VERSION',
        'COL_SUBPROJECT_ID_VERSION' => 'SUBPROJECT_ID_VERSION',
        'subproject_id_version' => 'SUBPROJECT_ID_VERSION',
        'obj_group_version.subproject_id_version' => 'SUBPROJECT_ID_VERSION',
        'ObjHouseIds' => 'OBJ_HOUSE_IDS',
        'ObjGroupVersion.ObjHouseIds' => 'OBJ_HOUSE_IDS',
        'objHouseIds' => 'OBJ_HOUSE_IDS',
        'objGroupVersion.objHouseIds' => 'OBJ_HOUSE_IDS',
        'ObjGroupVersionTableMap::COL_OBJ_HOUSE_IDS' => 'OBJ_HOUSE_IDS',
        'COL_OBJ_HOUSE_IDS' => 'OBJ_HOUSE_IDS',
        'obj_house_ids' => 'OBJ_HOUSE_IDS',
        'obj_group_version.obj_house_ids' => 'OBJ_HOUSE_IDS',
        'ObjHouseVersions' => 'OBJ_HOUSE_VERSIONS',
        'ObjGroupVersion.ObjHouseVersions' => 'OBJ_HOUSE_VERSIONS',
        'objHouseVersions' => 'OBJ_HOUSE_VERSIONS',
        'objGroupVersion.objHouseVersions' => 'OBJ_HOUSE_VERSIONS',
        'ObjGroupVersionTableMap::COL_OBJ_HOUSE_VERSIONS' => 'OBJ_HOUSE_VERSIONS',
        'COL_OBJ_HOUSE_VERSIONS' => 'OBJ_HOUSE_VERSIONS',
        'obj_house_versions' => 'OBJ_HOUSE_VERSIONS',
        'obj_group_version.obj_house_versions' => 'OBJ_HOUSE_VERSIONS',
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
        $this->setName('obj_group_version');
        $this->setPhpName('ObjGroupVersion');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\DB\\ObjGroupVersion');
        $this->setPackage('DB');
        $this->setUseIdGenerator(false);
        // columns
        $this->addForeignPrimaryKey('id', 'Id', 'INTEGER' , 'obj_group', 'id', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 255, null);
        $this->addColumn('status', 'Status', 'CHAR', true, null, 'in_process');
        $this->addColumn('is_public', 'IsPublic', 'BOOLEAN', true, 1, true);
        $this->addColumn('is_available', 'IsAvailable', 'BOOLEAN', true, 1, true);
        $this->addColumn('subproject_id', 'SubprojectId', 'INTEGER', true, null, null);
        $this->addColumn('version_created_by', 'VersionCreatedBy', 'INTEGER', true, null, null);
        $this->addPrimaryKey('version', 'Version', 'INTEGER', true, null, 0);
        $this->addColumn('version_created_at', 'VersionCreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('version_comment', 'VersionComment', 'VARCHAR', false, 255, null);
        $this->addColumn('subproject_id_version', 'SubprojectIdVersion', 'INTEGER', false, null, 0);
        $this->addColumn('obj_house_ids', 'ObjHouseIds', 'ARRAY', false, null, null);
        $this->addColumn('obj_house_versions', 'ObjHouseVersions', 'ARRAY', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('ObjGroup', '\\DB\\ObjGroup', RelationMap::MANY_TO_ONE, array (
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
     * @param \DB\ObjGroupVersion $obj A \DB\ObjGroupVersion object.
     * @param string|null $key Key (optional) to use for instance map (for performance boost if key was already calculated externally).
     *
     * @return void
     */
    public static function addInstanceToPool(ObjGroupVersion $obj, ?string $key = null): void
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
     * @param mixed $value A \DB\ObjGroupVersion object or a primary key value.
     *
     * @return void
     */
    public static function removeInstanceFromPool($value): void
    {
        if (Propel::isInstancePoolingEnabled() && null !== $value) {
            if (is_object($value) && $value instanceof \DB\ObjGroupVersion) {
                $key = serialize([(null === $value->getId() || is_scalar($value->getId()) || is_callable([$value->getId(), '__toString']) ? (string) $value->getId() : $value->getId()), (null === $value->getVersion() || is_scalar($value->getVersion()) || is_callable([$value->getVersion(), '__toString']) ? (string) $value->getVersion() : $value->getVersion())]);

            } elseif (is_array($value) && count($value) === 2) {
                // assume we've been passed a primary key";
                $key = serialize([(null === $value[0] || is_scalar($value[0]) || is_callable([$value[0], '__toString']) ? (string) $value[0] : $value[0]), (null === $value[1] || is_scalar($value[1]) || is_callable([$value[1], '__toString']) ? (string) $value[1] : $value[1])]);
            } elseif ($value instanceof Criteria) {
                self::$instances = [];

                return;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or \DB\ObjGroupVersion object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value, true)));
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
        return $withPrefix ? ObjGroupVersionTableMap::CLASS_DEFAULT : ObjGroupVersionTableMap::OM_CLASS;
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
     * @return array (ObjGroupVersion object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = ObjGroupVersionTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ObjGroupVersionTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ObjGroupVersionTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ObjGroupVersionTableMap::OM_CLASS;
            /** @var ObjGroupVersion $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ObjGroupVersionTableMap::addInstanceToPool($obj, $key);
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
            $key = ObjGroupVersionTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ObjGroupVersionTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var ObjGroupVersion $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ObjGroupVersionTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ObjGroupVersionTableMap::COL_ID);
            $criteria->addSelectColumn(ObjGroupVersionTableMap::COL_NAME);
            $criteria->addSelectColumn(ObjGroupVersionTableMap::COL_STATUS);
            $criteria->addSelectColumn(ObjGroupVersionTableMap::COL_IS_PUBLIC);
            $criteria->addSelectColumn(ObjGroupVersionTableMap::COL_IS_AVAILABLE);
            $criteria->addSelectColumn(ObjGroupVersionTableMap::COL_SUBPROJECT_ID);
            $criteria->addSelectColumn(ObjGroupVersionTableMap::COL_VERSION_CREATED_BY);
            $criteria->addSelectColumn(ObjGroupVersionTableMap::COL_VERSION);
            $criteria->addSelectColumn(ObjGroupVersionTableMap::COL_VERSION_CREATED_AT);
            $criteria->addSelectColumn(ObjGroupVersionTableMap::COL_VERSION_COMMENT);
            $criteria->addSelectColumn(ObjGroupVersionTableMap::COL_SUBPROJECT_ID_VERSION);
            $criteria->addSelectColumn(ObjGroupVersionTableMap::COL_OBJ_HOUSE_IDS);
            $criteria->addSelectColumn(ObjGroupVersionTableMap::COL_OBJ_HOUSE_VERSIONS);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.status');
            $criteria->addSelectColumn($alias . '.is_public');
            $criteria->addSelectColumn($alias . '.is_available');
            $criteria->addSelectColumn($alias . '.subproject_id');
            $criteria->addSelectColumn($alias . '.version_created_by');
            $criteria->addSelectColumn($alias . '.version');
            $criteria->addSelectColumn($alias . '.version_created_at');
            $criteria->addSelectColumn($alias . '.version_comment');
            $criteria->addSelectColumn($alias . '.subproject_id_version');
            $criteria->addSelectColumn($alias . '.obj_house_ids');
            $criteria->addSelectColumn($alias . '.obj_house_versions');
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
            $criteria->removeSelectColumn(ObjGroupVersionTableMap::COL_ID);
            $criteria->removeSelectColumn(ObjGroupVersionTableMap::COL_NAME);
            $criteria->removeSelectColumn(ObjGroupVersionTableMap::COL_STATUS);
            $criteria->removeSelectColumn(ObjGroupVersionTableMap::COL_IS_PUBLIC);
            $criteria->removeSelectColumn(ObjGroupVersionTableMap::COL_IS_AVAILABLE);
            $criteria->removeSelectColumn(ObjGroupVersionTableMap::COL_SUBPROJECT_ID);
            $criteria->removeSelectColumn(ObjGroupVersionTableMap::COL_VERSION_CREATED_BY);
            $criteria->removeSelectColumn(ObjGroupVersionTableMap::COL_VERSION);
            $criteria->removeSelectColumn(ObjGroupVersionTableMap::COL_VERSION_CREATED_AT);
            $criteria->removeSelectColumn(ObjGroupVersionTableMap::COL_VERSION_COMMENT);
            $criteria->removeSelectColumn(ObjGroupVersionTableMap::COL_SUBPROJECT_ID_VERSION);
            $criteria->removeSelectColumn(ObjGroupVersionTableMap::COL_OBJ_HOUSE_IDS);
            $criteria->removeSelectColumn(ObjGroupVersionTableMap::COL_OBJ_HOUSE_VERSIONS);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.name');
            $criteria->removeSelectColumn($alias . '.status');
            $criteria->removeSelectColumn($alias . '.is_public');
            $criteria->removeSelectColumn($alias . '.is_available');
            $criteria->removeSelectColumn($alias . '.subproject_id');
            $criteria->removeSelectColumn($alias . '.version_created_by');
            $criteria->removeSelectColumn($alias . '.version');
            $criteria->removeSelectColumn($alias . '.version_created_at');
            $criteria->removeSelectColumn($alias . '.version_comment');
            $criteria->removeSelectColumn($alias . '.subproject_id_version');
            $criteria->removeSelectColumn($alias . '.obj_house_ids');
            $criteria->removeSelectColumn($alias . '.obj_house_versions');
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
        return Propel::getServiceContainer()->getDatabaseMap(ObjGroupVersionTableMap::DATABASE_NAME)->getTable(ObjGroupVersionTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a ObjGroupVersion or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or ObjGroupVersion object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ObjGroupVersionTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \DB\ObjGroupVersion) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ObjGroupVersionTableMap::DATABASE_NAME);
            // primary key is composite; we therefore, expect
            // the primary key passed to be an array of pkey values
            if (count($values) == count($values, COUNT_RECURSIVE)) {
                // array is not multi-dimensional
                $values = [$values];
            }
            foreach ($values as $value) {
                $criterion = $criteria->getNewCriterion(ObjGroupVersionTableMap::COL_ID, $value[0]);
                $criterion->addAnd($criteria->getNewCriterion(ObjGroupVersionTableMap::COL_VERSION, $value[1]));
                $criteria->addOr($criterion);
            }
        }

        $query = ObjGroupVersionQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ObjGroupVersionTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ObjGroupVersionTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the obj_group_version table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return ObjGroupVersionQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a ObjGroupVersion or Criteria object.
     *
     * @param mixed $criteria Criteria or ObjGroupVersion object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ObjGroupVersionTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from ObjGroupVersion object
        }


        // Set the correct dbName
        $query = ObjGroupVersionQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
