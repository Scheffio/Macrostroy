<?php

namespace DB\Map;

use DB\GroupsVersion;
use DB\GroupsVersionQuery;
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
 * This class defines the structure of the 'groups_version' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class GroupsVersionTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'DB.Map.GroupsVersionTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'groups_version';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'GroupsVersion';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\DB\\GroupsVersion';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'DB.GroupsVersion';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 12;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 12;

    /**
     * the column name for the id field
     */
    public const COL_ID = 'groups_version.id';

    /**
     * the column name for the name field
     */
    public const COL_NAME = 'groups_version.name';

    /**
     * the column name for the status field
     */
    public const COL_STATUS = 'groups_version.status';

    /**
     * the column name for the is_available field
     */
    public const COL_IS_AVAILABLE = 'groups_version.is_available';

    /**
     * the column name for the subproject_id field
     */
    public const COL_SUBPROJECT_ID = 'groups_version.subproject_id';

    /**
     * the column name for the version field
     */
    public const COL_VERSION = 'groups_version.version';

    /**
     * the column name for the version_created_at field
     */
    public const COL_VERSION_CREATED_AT = 'groups_version.version_created_at';

    /**
     * the column name for the version_created_by field
     */
    public const COL_VERSION_CREATED_BY = 'groups_version.version_created_by';

    /**
     * the column name for the version_comment field
     */
    public const COL_VERSION_COMMENT = 'groups_version.version_comment';

    /**
     * the column name for the subproject_id_version field
     */
    public const COL_SUBPROJECT_ID_VERSION = 'groups_version.subproject_id_version';

    /**
     * the column name for the house_ids field
     */
    public const COL_HOUSE_IDS = 'groups_version.house_ids';

    /**
     * the column name for the house_versions field
     */
    public const COL_HOUSE_VERSIONS = 'groups_version.house_versions';

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
        self::TYPE_PHPNAME       => ['Id', 'Name', 'Status', 'IsAvailable', 'SubprojectId', 'Version', 'VersionCreatedAt', 'VersionCreatedBy', 'VersionComment', 'SubprojectIdVersion', 'HouseIds', 'HouseVersions', ],
        self::TYPE_CAMELNAME     => ['id', 'name', 'status', 'isAvailable', 'subprojectId', 'version', 'versionCreatedAt', 'versionCreatedBy', 'versionComment', 'subprojectIdVersion', 'houseIds', 'houseVersions', ],
        self::TYPE_COLNAME       => [GroupsVersionTableMap::COL_ID, GroupsVersionTableMap::COL_NAME, GroupsVersionTableMap::COL_STATUS, GroupsVersionTableMap::COL_IS_AVAILABLE, GroupsVersionTableMap::COL_SUBPROJECT_ID, GroupsVersionTableMap::COL_VERSION, GroupsVersionTableMap::COL_VERSION_CREATED_AT, GroupsVersionTableMap::COL_VERSION_CREATED_BY, GroupsVersionTableMap::COL_VERSION_COMMENT, GroupsVersionTableMap::COL_SUBPROJECT_ID_VERSION, GroupsVersionTableMap::COL_HOUSE_IDS, GroupsVersionTableMap::COL_HOUSE_VERSIONS, ],
        self::TYPE_FIELDNAME     => ['id', 'name', 'status', 'is_available', 'subproject_id', 'version', 'version_created_at', 'version_created_by', 'version_comment', 'subproject_id_version', 'house_ids', 'house_versions', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, ]
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
        self::TYPE_PHPNAME       => ['Id' => 0, 'Name' => 1, 'Status' => 2, 'IsAvailable' => 3, 'SubprojectId' => 4, 'Version' => 5, 'VersionCreatedAt' => 6, 'VersionCreatedBy' => 7, 'VersionComment' => 8, 'SubprojectIdVersion' => 9, 'HouseIds' => 10, 'HouseVersions' => 11, ],
        self::TYPE_CAMELNAME     => ['id' => 0, 'name' => 1, 'status' => 2, 'isAvailable' => 3, 'subprojectId' => 4, 'version' => 5, 'versionCreatedAt' => 6, 'versionCreatedBy' => 7, 'versionComment' => 8, 'subprojectIdVersion' => 9, 'houseIds' => 10, 'houseVersions' => 11, ],
        self::TYPE_COLNAME       => [GroupsVersionTableMap::COL_ID => 0, GroupsVersionTableMap::COL_NAME => 1, GroupsVersionTableMap::COL_STATUS => 2, GroupsVersionTableMap::COL_IS_AVAILABLE => 3, GroupsVersionTableMap::COL_SUBPROJECT_ID => 4, GroupsVersionTableMap::COL_VERSION => 5, GroupsVersionTableMap::COL_VERSION_CREATED_AT => 6, GroupsVersionTableMap::COL_VERSION_CREATED_BY => 7, GroupsVersionTableMap::COL_VERSION_COMMENT => 8, GroupsVersionTableMap::COL_SUBPROJECT_ID_VERSION => 9, GroupsVersionTableMap::COL_HOUSE_IDS => 10, GroupsVersionTableMap::COL_HOUSE_VERSIONS => 11, ],
        self::TYPE_FIELDNAME     => ['id' => 0, 'name' => 1, 'status' => 2, 'is_available' => 3, 'subproject_id' => 4, 'version' => 5, 'version_created_at' => 6, 'version_created_by' => 7, 'version_comment' => 8, 'subproject_id_version' => 9, 'house_ids' => 10, 'house_versions' => 11, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'GroupsVersion.Id' => 'ID',
        'id' => 'ID',
        'groupsVersion.id' => 'ID',
        'GroupsVersionTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'groups_version.id' => 'ID',
        'Name' => 'NAME',
        'GroupsVersion.Name' => 'NAME',
        'name' => 'NAME',
        'groupsVersion.name' => 'NAME',
        'GroupsVersionTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'groups_version.name' => 'NAME',
        'Status' => 'STATUS',
        'GroupsVersion.Status' => 'STATUS',
        'status' => 'STATUS',
        'groupsVersion.status' => 'STATUS',
        'GroupsVersionTableMap::COL_STATUS' => 'STATUS',
        'COL_STATUS' => 'STATUS',
        'groups_version.status' => 'STATUS',
        'IsAvailable' => 'IS_AVAILABLE',
        'GroupsVersion.IsAvailable' => 'IS_AVAILABLE',
        'isAvailable' => 'IS_AVAILABLE',
        'groupsVersion.isAvailable' => 'IS_AVAILABLE',
        'GroupsVersionTableMap::COL_IS_AVAILABLE' => 'IS_AVAILABLE',
        'COL_IS_AVAILABLE' => 'IS_AVAILABLE',
        'is_available' => 'IS_AVAILABLE',
        'groups_version.is_available' => 'IS_AVAILABLE',
        'SubprojectId' => 'SUBPROJECT_ID',
        'GroupsVersion.SubprojectId' => 'SUBPROJECT_ID',
        'subprojectId' => 'SUBPROJECT_ID',
        'groupsVersion.subprojectId' => 'SUBPROJECT_ID',
        'GroupsVersionTableMap::COL_SUBPROJECT_ID' => 'SUBPROJECT_ID',
        'COL_SUBPROJECT_ID' => 'SUBPROJECT_ID',
        'subproject_id' => 'SUBPROJECT_ID',
        'groups_version.subproject_id' => 'SUBPROJECT_ID',
        'Version' => 'VERSION',
        'GroupsVersion.Version' => 'VERSION',
        'version' => 'VERSION',
        'groupsVersion.version' => 'VERSION',
        'GroupsVersionTableMap::COL_VERSION' => 'VERSION',
        'COL_VERSION' => 'VERSION',
        'groups_version.version' => 'VERSION',
        'VersionCreatedAt' => 'VERSION_CREATED_AT',
        'GroupsVersion.VersionCreatedAt' => 'VERSION_CREATED_AT',
        'versionCreatedAt' => 'VERSION_CREATED_AT',
        'groupsVersion.versionCreatedAt' => 'VERSION_CREATED_AT',
        'GroupsVersionTableMap::COL_VERSION_CREATED_AT' => 'VERSION_CREATED_AT',
        'COL_VERSION_CREATED_AT' => 'VERSION_CREATED_AT',
        'version_created_at' => 'VERSION_CREATED_AT',
        'groups_version.version_created_at' => 'VERSION_CREATED_AT',
        'VersionCreatedBy' => 'VERSION_CREATED_BY',
        'GroupsVersion.VersionCreatedBy' => 'VERSION_CREATED_BY',
        'versionCreatedBy' => 'VERSION_CREATED_BY',
        'groupsVersion.versionCreatedBy' => 'VERSION_CREATED_BY',
        'GroupsVersionTableMap::COL_VERSION_CREATED_BY' => 'VERSION_CREATED_BY',
        'COL_VERSION_CREATED_BY' => 'VERSION_CREATED_BY',
        'version_created_by' => 'VERSION_CREATED_BY',
        'groups_version.version_created_by' => 'VERSION_CREATED_BY',
        'VersionComment' => 'VERSION_COMMENT',
        'GroupsVersion.VersionComment' => 'VERSION_COMMENT',
        'versionComment' => 'VERSION_COMMENT',
        'groupsVersion.versionComment' => 'VERSION_COMMENT',
        'GroupsVersionTableMap::COL_VERSION_COMMENT' => 'VERSION_COMMENT',
        'COL_VERSION_COMMENT' => 'VERSION_COMMENT',
        'version_comment' => 'VERSION_COMMENT',
        'groups_version.version_comment' => 'VERSION_COMMENT',
        'SubprojectIdVersion' => 'SUBPROJECT_ID_VERSION',
        'GroupsVersion.SubprojectIdVersion' => 'SUBPROJECT_ID_VERSION',
        'subprojectIdVersion' => 'SUBPROJECT_ID_VERSION',
        'groupsVersion.subprojectIdVersion' => 'SUBPROJECT_ID_VERSION',
        'GroupsVersionTableMap::COL_SUBPROJECT_ID_VERSION' => 'SUBPROJECT_ID_VERSION',
        'COL_SUBPROJECT_ID_VERSION' => 'SUBPROJECT_ID_VERSION',
        'subproject_id_version' => 'SUBPROJECT_ID_VERSION',
        'groups_version.subproject_id_version' => 'SUBPROJECT_ID_VERSION',
        'HouseIds' => 'HOUSE_IDS',
        'GroupsVersion.HouseIds' => 'HOUSE_IDS',
        'houseIds' => 'HOUSE_IDS',
        'groupsVersion.houseIds' => 'HOUSE_IDS',
        'GroupsVersionTableMap::COL_HOUSE_IDS' => 'HOUSE_IDS',
        'COL_HOUSE_IDS' => 'HOUSE_IDS',
        'house_ids' => 'HOUSE_IDS',
        'groups_version.house_ids' => 'HOUSE_IDS',
        'HouseVersions' => 'HOUSE_VERSIONS',
        'GroupsVersion.HouseVersions' => 'HOUSE_VERSIONS',
        'houseVersions' => 'HOUSE_VERSIONS',
        'groupsVersion.houseVersions' => 'HOUSE_VERSIONS',
        'GroupsVersionTableMap::COL_HOUSE_VERSIONS' => 'HOUSE_VERSIONS',
        'COL_HOUSE_VERSIONS' => 'HOUSE_VERSIONS',
        'house_versions' => 'HOUSE_VERSIONS',
        'groups_version.house_versions' => 'HOUSE_VERSIONS',
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
        $this->setName('groups_version');
        $this->setPhpName('GroupsVersion');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\DB\\GroupsVersion');
        $this->setPackage('DB');
        $this->setUseIdGenerator(false);
        // columns
        $this->addForeignPrimaryKey('id', 'Id', 'INTEGER' , 'groups', 'id', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 255, null);
        $this->addColumn('status', 'Status', 'CHAR', true, null, 'in_process');
        $this->addColumn('is_available', 'IsAvailable', 'BOOLEAN', true, 1, true);
        $this->addColumn('subproject_id', 'SubprojectId', 'INTEGER', true, null, null);
        $this->addPrimaryKey('version', 'Version', 'INTEGER', true, null, 0);
        $this->addColumn('version_created_at', 'VersionCreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('version_created_by', 'VersionCreatedBy', 'VARCHAR', false, 100, null);
        $this->addColumn('version_comment', 'VersionComment', 'VARCHAR', false, 255, null);
        $this->addColumn('subproject_id_version', 'SubprojectIdVersion', 'INTEGER', false, null, 0);
        $this->addColumn('house_ids', 'HouseIds', 'ARRAY', false, null, null);
        $this->addColumn('house_versions', 'HouseVersions', 'ARRAY', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Groups', '\\DB\\Groups', RelationMap::MANY_TO_ONE, array (
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
     * @param \DB\GroupsVersion $obj A \DB\GroupsVersion object.
     * @param string|null $key Key (optional) to use for instance map (for performance boost if key was already calculated externally).
     *
     * @return void
     */
    public static function addInstanceToPool(GroupsVersion $obj, ?string $key = null): void
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
     * @param mixed $value A \DB\GroupsVersion object or a primary key value.
     *
     * @return void
     */
    public static function removeInstanceFromPool($value): void
    {
        if (Propel::isInstancePoolingEnabled() && null !== $value) {
            if (is_object($value) && $value instanceof \DB\GroupsVersion) {
                $key = serialize([(null === $value->getId() || is_scalar($value->getId()) || is_callable([$value->getId(), '__toString']) ? (string) $value->getId() : $value->getId()), (null === $value->getVersion() || is_scalar($value->getVersion()) || is_callable([$value->getVersion(), '__toString']) ? (string) $value->getVersion() : $value->getVersion())]);

            } elseif (is_array($value) && count($value) === 2) {
                // assume we've been passed a primary key";
                $key = serialize([(null === $value[0] || is_scalar($value[0]) || is_callable([$value[0], '__toString']) ? (string) $value[0] : $value[0]), (null === $value[1] || is_scalar($value[1]) || is_callable([$value[1], '__toString']) ? (string) $value[1] : $value[1])]);
            } elseif ($value instanceof Criteria) {
                self::$instances = [];

                return;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or \DB\GroupsVersion object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value, true)));
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
        return $withPrefix ? GroupsVersionTableMap::CLASS_DEFAULT : GroupsVersionTableMap::OM_CLASS;
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
     * @return array (GroupsVersion object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = GroupsVersionTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = GroupsVersionTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + GroupsVersionTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = GroupsVersionTableMap::OM_CLASS;
            /** @var GroupsVersion $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            GroupsVersionTableMap::addInstanceToPool($obj, $key);
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
            $key = GroupsVersionTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = GroupsVersionTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var GroupsVersion $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                GroupsVersionTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(GroupsVersionTableMap::COL_ID);
            $criteria->addSelectColumn(GroupsVersionTableMap::COL_NAME);
            $criteria->addSelectColumn(GroupsVersionTableMap::COL_STATUS);
            $criteria->addSelectColumn(GroupsVersionTableMap::COL_IS_AVAILABLE);
            $criteria->addSelectColumn(GroupsVersionTableMap::COL_SUBPROJECT_ID);
            $criteria->addSelectColumn(GroupsVersionTableMap::COL_VERSION);
            $criteria->addSelectColumn(GroupsVersionTableMap::COL_VERSION_CREATED_AT);
            $criteria->addSelectColumn(GroupsVersionTableMap::COL_VERSION_CREATED_BY);
            $criteria->addSelectColumn(GroupsVersionTableMap::COL_VERSION_COMMENT);
            $criteria->addSelectColumn(GroupsVersionTableMap::COL_SUBPROJECT_ID_VERSION);
            $criteria->addSelectColumn(GroupsVersionTableMap::COL_HOUSE_IDS);
            $criteria->addSelectColumn(GroupsVersionTableMap::COL_HOUSE_VERSIONS);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.status');
            $criteria->addSelectColumn($alias . '.is_available');
            $criteria->addSelectColumn($alias . '.subproject_id');
            $criteria->addSelectColumn($alias . '.version');
            $criteria->addSelectColumn($alias . '.version_created_at');
            $criteria->addSelectColumn($alias . '.version_created_by');
            $criteria->addSelectColumn($alias . '.version_comment');
            $criteria->addSelectColumn($alias . '.subproject_id_version');
            $criteria->addSelectColumn($alias . '.house_ids');
            $criteria->addSelectColumn($alias . '.house_versions');
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
            $criteria->removeSelectColumn(GroupsVersionTableMap::COL_ID);
            $criteria->removeSelectColumn(GroupsVersionTableMap::COL_NAME);
            $criteria->removeSelectColumn(GroupsVersionTableMap::COL_STATUS);
            $criteria->removeSelectColumn(GroupsVersionTableMap::COL_IS_AVAILABLE);
            $criteria->removeSelectColumn(GroupsVersionTableMap::COL_SUBPROJECT_ID);
            $criteria->removeSelectColumn(GroupsVersionTableMap::COL_VERSION);
            $criteria->removeSelectColumn(GroupsVersionTableMap::COL_VERSION_CREATED_AT);
            $criteria->removeSelectColumn(GroupsVersionTableMap::COL_VERSION_CREATED_BY);
            $criteria->removeSelectColumn(GroupsVersionTableMap::COL_VERSION_COMMENT);
            $criteria->removeSelectColumn(GroupsVersionTableMap::COL_SUBPROJECT_ID_VERSION);
            $criteria->removeSelectColumn(GroupsVersionTableMap::COL_HOUSE_IDS);
            $criteria->removeSelectColumn(GroupsVersionTableMap::COL_HOUSE_VERSIONS);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.name');
            $criteria->removeSelectColumn($alias . '.status');
            $criteria->removeSelectColumn($alias . '.is_available');
            $criteria->removeSelectColumn($alias . '.subproject_id');
            $criteria->removeSelectColumn($alias . '.version');
            $criteria->removeSelectColumn($alias . '.version_created_at');
            $criteria->removeSelectColumn($alias . '.version_created_by');
            $criteria->removeSelectColumn($alias . '.version_comment');
            $criteria->removeSelectColumn($alias . '.subproject_id_version');
            $criteria->removeSelectColumn($alias . '.house_ids');
            $criteria->removeSelectColumn($alias . '.house_versions');
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
        return Propel::getServiceContainer()->getDatabaseMap(GroupsVersionTableMap::DATABASE_NAME)->getTable(GroupsVersionTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a GroupsVersion or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or GroupsVersion object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(GroupsVersionTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \DB\GroupsVersion) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(GroupsVersionTableMap::DATABASE_NAME);
            // primary key is composite; we therefore, expect
            // the primary key passed to be an array of pkey values
            if (count($values) == count($values, COUNT_RECURSIVE)) {
                // array is not multi-dimensional
                $values = [$values];
            }
            foreach ($values as $value) {
                $criterion = $criteria->getNewCriterion(GroupsVersionTableMap::COL_ID, $value[0]);
                $criterion->addAnd($criteria->getNewCriterion(GroupsVersionTableMap::COL_VERSION, $value[1]));
                $criteria->addOr($criterion);
            }
        }

        $query = GroupsVersionQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            GroupsVersionTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                GroupsVersionTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the groups_version table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return GroupsVersionQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a GroupsVersion or Criteria object.
     *
     * @param mixed $criteria Criteria or GroupsVersion object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(GroupsVersionTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from GroupsVersion object
        }


        // Set the correct dbName
        $query = GroupsVersionQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
