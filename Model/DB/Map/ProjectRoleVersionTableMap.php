<?php

namespace DB\Map;

use DB\ProjectRoleVersion;
use DB\ProjectRoleVersionQuery;
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
 * This class defines the structure of the 'project_role_version' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class ProjectRoleVersionTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'DB.Map.ProjectRoleVersionTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'project_role_version';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'ProjectRoleVersion';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\DB\\ProjectRoleVersion';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'DB.ProjectRoleVersion';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 11;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 11;

    /**
     * the column name for the id field
     */
    public const COL_ID = 'project_role_version.id';

    /**
     * the column name for the lvl field
     */
    public const COL_LVL = 'project_role_version.lvl';

    /**
     * the column name for the role_id field
     */
    public const COL_ROLE_ID = 'project_role_version.role_id';

    /**
     * the column name for the project_id field
     */
    public const COL_PROJECT_ID = 'project_role_version.project_id';

    /**
     * the column name for the object_id field
     */
    public const COL_OBJECT_ID = 'project_role_version.object_id';

    /**
     * the column name for the user_id field
     */
    public const COL_USER_ID = 'project_role_version.user_id';

    /**
     * the column name for the version field
     */
    public const COL_VERSION = 'project_role_version.version';

    /**
     * the column name for the version_created_at field
     */
    public const COL_VERSION_CREATED_AT = 'project_role_version.version_created_at';

    /**
     * the column name for the version_created_by field
     */
    public const COL_VERSION_CREATED_BY = 'project_role_version.version_created_by';

    /**
     * the column name for the version_comment field
     */
    public const COL_VERSION_COMMENT = 'project_role_version.version_comment';

    /**
     * the column name for the project_id_version field
     */
    public const COL_PROJECT_ID_VERSION = 'project_role_version.project_id_version';

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
        self::TYPE_PHPNAME       => ['Id', 'Lvl', 'RoleId', 'ProjectId', 'ObjectId', 'UserId', 'Version', 'VersionCreatedAt', 'VersionCreatedBy', 'VersionComment', 'ProjectIdVersion', ],
        self::TYPE_CAMELNAME     => ['id', 'lvl', 'roleId', 'projectId', 'objectId', 'userId', 'version', 'versionCreatedAt', 'versionCreatedBy', 'versionComment', 'projectIdVersion', ],
        self::TYPE_COLNAME       => [ProjectRoleVersionTableMap::COL_ID, ProjectRoleVersionTableMap::COL_LVL, ProjectRoleVersionTableMap::COL_ROLE_ID, ProjectRoleVersionTableMap::COL_PROJECT_ID, ProjectRoleVersionTableMap::COL_OBJECT_ID, ProjectRoleVersionTableMap::COL_USER_ID, ProjectRoleVersionTableMap::COL_VERSION, ProjectRoleVersionTableMap::COL_VERSION_CREATED_AT, ProjectRoleVersionTableMap::COL_VERSION_CREATED_BY, ProjectRoleVersionTableMap::COL_VERSION_COMMENT, ProjectRoleVersionTableMap::COL_PROJECT_ID_VERSION, ],
        self::TYPE_FIELDNAME     => ['id', 'lvl', 'role_id', 'project_id', 'object_id', 'user_id', 'version', 'version_created_at', 'version_created_by', 'version_comment', 'project_id_version', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, ]
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
        self::TYPE_PHPNAME       => ['Id' => 0, 'Lvl' => 1, 'RoleId' => 2, 'ProjectId' => 3, 'ObjectId' => 4, 'UserId' => 5, 'Version' => 6, 'VersionCreatedAt' => 7, 'VersionCreatedBy' => 8, 'VersionComment' => 9, 'ProjectIdVersion' => 10, ],
        self::TYPE_CAMELNAME     => ['id' => 0, 'lvl' => 1, 'roleId' => 2, 'projectId' => 3, 'objectId' => 4, 'userId' => 5, 'version' => 6, 'versionCreatedAt' => 7, 'versionCreatedBy' => 8, 'versionComment' => 9, 'projectIdVersion' => 10, ],
        self::TYPE_COLNAME       => [ProjectRoleVersionTableMap::COL_ID => 0, ProjectRoleVersionTableMap::COL_LVL => 1, ProjectRoleVersionTableMap::COL_ROLE_ID => 2, ProjectRoleVersionTableMap::COL_PROJECT_ID => 3, ProjectRoleVersionTableMap::COL_OBJECT_ID => 4, ProjectRoleVersionTableMap::COL_USER_ID => 5, ProjectRoleVersionTableMap::COL_VERSION => 6, ProjectRoleVersionTableMap::COL_VERSION_CREATED_AT => 7, ProjectRoleVersionTableMap::COL_VERSION_CREATED_BY => 8, ProjectRoleVersionTableMap::COL_VERSION_COMMENT => 9, ProjectRoleVersionTableMap::COL_PROJECT_ID_VERSION => 10, ],
        self::TYPE_FIELDNAME     => ['id' => 0, 'lvl' => 1, 'role_id' => 2, 'project_id' => 3, 'object_id' => 4, 'user_id' => 5, 'version' => 6, 'version_created_at' => 7, 'version_created_by' => 8, 'version_comment' => 9, 'project_id_version' => 10, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'ProjectRoleVersion.Id' => 'ID',
        'id' => 'ID',
        'projectRoleVersion.id' => 'ID',
        'ProjectRoleVersionTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'project_role_version.id' => 'ID',
        'Lvl' => 'LVL',
        'ProjectRoleVersion.Lvl' => 'LVL',
        'lvl' => 'LVL',
        'projectRoleVersion.lvl' => 'LVL',
        'ProjectRoleVersionTableMap::COL_LVL' => 'LVL',
        'COL_LVL' => 'LVL',
        'project_role_version.lvl' => 'LVL',
        'RoleId' => 'ROLE_ID',
        'ProjectRoleVersion.RoleId' => 'ROLE_ID',
        'roleId' => 'ROLE_ID',
        'projectRoleVersion.roleId' => 'ROLE_ID',
        'ProjectRoleVersionTableMap::COL_ROLE_ID' => 'ROLE_ID',
        'COL_ROLE_ID' => 'ROLE_ID',
        'role_id' => 'ROLE_ID',
        'project_role_version.role_id' => 'ROLE_ID',
        'ProjectId' => 'PROJECT_ID',
        'ProjectRoleVersion.ProjectId' => 'PROJECT_ID',
        'projectId' => 'PROJECT_ID',
        'projectRoleVersion.projectId' => 'PROJECT_ID',
        'ProjectRoleVersionTableMap::COL_PROJECT_ID' => 'PROJECT_ID',
        'COL_PROJECT_ID' => 'PROJECT_ID',
        'project_id' => 'PROJECT_ID',
        'project_role_version.project_id' => 'PROJECT_ID',
        'ObjectId' => 'OBJECT_ID',
        'ProjectRoleVersion.ObjectId' => 'OBJECT_ID',
        'objectId' => 'OBJECT_ID',
        'projectRoleVersion.objectId' => 'OBJECT_ID',
        'ProjectRoleVersionTableMap::COL_OBJECT_ID' => 'OBJECT_ID',
        'COL_OBJECT_ID' => 'OBJECT_ID',
        'object_id' => 'OBJECT_ID',
        'project_role_version.object_id' => 'OBJECT_ID',
        'UserId' => 'USER_ID',
        'ProjectRoleVersion.UserId' => 'USER_ID',
        'userId' => 'USER_ID',
        'projectRoleVersion.userId' => 'USER_ID',
        'ProjectRoleVersionTableMap::COL_USER_ID' => 'USER_ID',
        'COL_USER_ID' => 'USER_ID',
        'user_id' => 'USER_ID',
        'project_role_version.user_id' => 'USER_ID',
        'Version' => 'VERSION',
        'ProjectRoleVersion.Version' => 'VERSION',
        'version' => 'VERSION',
        'projectRoleVersion.version' => 'VERSION',
        'ProjectRoleVersionTableMap::COL_VERSION' => 'VERSION',
        'COL_VERSION' => 'VERSION',
        'project_role_version.version' => 'VERSION',
        'VersionCreatedAt' => 'VERSION_CREATED_AT',
        'ProjectRoleVersion.VersionCreatedAt' => 'VERSION_CREATED_AT',
        'versionCreatedAt' => 'VERSION_CREATED_AT',
        'projectRoleVersion.versionCreatedAt' => 'VERSION_CREATED_AT',
        'ProjectRoleVersionTableMap::COL_VERSION_CREATED_AT' => 'VERSION_CREATED_AT',
        'COL_VERSION_CREATED_AT' => 'VERSION_CREATED_AT',
        'version_created_at' => 'VERSION_CREATED_AT',
        'project_role_version.version_created_at' => 'VERSION_CREATED_AT',
        'VersionCreatedBy' => 'VERSION_CREATED_BY',
        'ProjectRoleVersion.VersionCreatedBy' => 'VERSION_CREATED_BY',
        'versionCreatedBy' => 'VERSION_CREATED_BY',
        'projectRoleVersion.versionCreatedBy' => 'VERSION_CREATED_BY',
        'ProjectRoleVersionTableMap::COL_VERSION_CREATED_BY' => 'VERSION_CREATED_BY',
        'COL_VERSION_CREATED_BY' => 'VERSION_CREATED_BY',
        'version_created_by' => 'VERSION_CREATED_BY',
        'project_role_version.version_created_by' => 'VERSION_CREATED_BY',
        'VersionComment' => 'VERSION_COMMENT',
        'ProjectRoleVersion.VersionComment' => 'VERSION_COMMENT',
        'versionComment' => 'VERSION_COMMENT',
        'projectRoleVersion.versionComment' => 'VERSION_COMMENT',
        'ProjectRoleVersionTableMap::COL_VERSION_COMMENT' => 'VERSION_COMMENT',
        'COL_VERSION_COMMENT' => 'VERSION_COMMENT',
        'version_comment' => 'VERSION_COMMENT',
        'project_role_version.version_comment' => 'VERSION_COMMENT',
        'ProjectIdVersion' => 'PROJECT_ID_VERSION',
        'ProjectRoleVersion.ProjectIdVersion' => 'PROJECT_ID_VERSION',
        'projectIdVersion' => 'PROJECT_ID_VERSION',
        'projectRoleVersion.projectIdVersion' => 'PROJECT_ID_VERSION',
        'ProjectRoleVersionTableMap::COL_PROJECT_ID_VERSION' => 'PROJECT_ID_VERSION',
        'COL_PROJECT_ID_VERSION' => 'PROJECT_ID_VERSION',
        'project_id_version' => 'PROJECT_ID_VERSION',
        'project_role_version.project_id_version' => 'PROJECT_ID_VERSION',
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
        $this->setName('project_role_version');
        $this->setPhpName('ProjectRoleVersion');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\DB\\ProjectRoleVersion');
        $this->setPackage('DB');
        $this->setUseIdGenerator(false);
        // columns
        $this->addForeignPrimaryKey('id', 'Id', 'INTEGER' , 'project_role', 'id', true, null, null);
        $this->addColumn('lvl', 'Lvl', 'TINYINT', true, null, 1);
        $this->addColumn('role_id', 'RoleId', 'INTEGER', true, null, null);
        $this->addColumn('project_id', 'ProjectId', 'INTEGER', true, null, null);
        $this->addColumn('object_id', 'ObjectId', 'INTEGER', true, null, null);
        $this->addColumn('user_id', 'UserId', 'INTEGER', true, null, null);
        $this->addPrimaryKey('version', 'Version', 'INTEGER', true, null, 0);
        $this->addColumn('version_created_at', 'VersionCreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('version_created_by', 'VersionCreatedBy', 'VARCHAR', false, 100, null);
        $this->addColumn('version_comment', 'VersionComment', 'VARCHAR', false, 255, null);
        $this->addColumn('project_id_version', 'ProjectIdVersion', 'INTEGER', false, null, 0);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('ProjectRole', '\\DB\\ProjectRole', RelationMap::MANY_TO_ONE, array (
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
     * @param \DB\ProjectRoleVersion $obj A \DB\ProjectRoleVersion object.
     * @param string|null $key Key (optional) to use for instance map (for performance boost if key was already calculated externally).
     *
     * @return void
     */
    public static function addInstanceToPool(ProjectRoleVersion $obj, ?string $key = null): void
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
     * @param mixed $value A \DB\ProjectRoleVersion object or a primary key value.
     *
     * @return void
     */
    public static function removeInstanceFromPool($value): void
    {
        if (Propel::isInstancePoolingEnabled() && null !== $value) {
            if (is_object($value) && $value instanceof \DB\ProjectRoleVersion) {
                $key = serialize([(null === $value->getId() || is_scalar($value->getId()) || is_callable([$value->getId(), '__toString']) ? (string) $value->getId() : $value->getId()), (null === $value->getVersion() || is_scalar($value->getVersion()) || is_callable([$value->getVersion(), '__toString']) ? (string) $value->getVersion() : $value->getVersion())]);

            } elseif (is_array($value) && count($value) === 2) {
                // assume we've been passed a primary key";
                $key = serialize([(null === $value[0] || is_scalar($value[0]) || is_callable([$value[0], '__toString']) ? (string) $value[0] : $value[0]), (null === $value[1] || is_scalar($value[1]) || is_callable([$value[1], '__toString']) ? (string) $value[1] : $value[1])]);
            } elseif ($value instanceof Criteria) {
                self::$instances = [];

                return;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or \DB\ProjectRoleVersion object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value, true)));
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
        return $withPrefix ? ProjectRoleVersionTableMap::CLASS_DEFAULT : ProjectRoleVersionTableMap::OM_CLASS;
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
     * @return array (ProjectRoleVersion object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = ProjectRoleVersionTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ProjectRoleVersionTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ProjectRoleVersionTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ProjectRoleVersionTableMap::OM_CLASS;
            /** @var ProjectRoleVersion $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ProjectRoleVersionTableMap::addInstanceToPool($obj, $key);
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
            $key = ProjectRoleVersionTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ProjectRoleVersionTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var ProjectRoleVersion $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ProjectRoleVersionTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ProjectRoleVersionTableMap::COL_ID);
            $criteria->addSelectColumn(ProjectRoleVersionTableMap::COL_LVL);
            $criteria->addSelectColumn(ProjectRoleVersionTableMap::COL_ROLE_ID);
            $criteria->addSelectColumn(ProjectRoleVersionTableMap::COL_PROJECT_ID);
            $criteria->addSelectColumn(ProjectRoleVersionTableMap::COL_OBJECT_ID);
            $criteria->addSelectColumn(ProjectRoleVersionTableMap::COL_USER_ID);
            $criteria->addSelectColumn(ProjectRoleVersionTableMap::COL_VERSION);
            $criteria->addSelectColumn(ProjectRoleVersionTableMap::COL_VERSION_CREATED_AT);
            $criteria->addSelectColumn(ProjectRoleVersionTableMap::COL_VERSION_CREATED_BY);
            $criteria->addSelectColumn(ProjectRoleVersionTableMap::COL_VERSION_COMMENT);
            $criteria->addSelectColumn(ProjectRoleVersionTableMap::COL_PROJECT_ID_VERSION);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.lvl');
            $criteria->addSelectColumn($alias . '.role_id');
            $criteria->addSelectColumn($alias . '.project_id');
            $criteria->addSelectColumn($alias . '.object_id');
            $criteria->addSelectColumn($alias . '.user_id');
            $criteria->addSelectColumn($alias . '.version');
            $criteria->addSelectColumn($alias . '.version_created_at');
            $criteria->addSelectColumn($alias . '.version_created_by');
            $criteria->addSelectColumn($alias . '.version_comment');
            $criteria->addSelectColumn($alias . '.project_id_version');
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
            $criteria->removeSelectColumn(ProjectRoleVersionTableMap::COL_ID);
            $criteria->removeSelectColumn(ProjectRoleVersionTableMap::COL_LVL);
            $criteria->removeSelectColumn(ProjectRoleVersionTableMap::COL_ROLE_ID);
            $criteria->removeSelectColumn(ProjectRoleVersionTableMap::COL_PROJECT_ID);
            $criteria->removeSelectColumn(ProjectRoleVersionTableMap::COL_OBJECT_ID);
            $criteria->removeSelectColumn(ProjectRoleVersionTableMap::COL_USER_ID);
            $criteria->removeSelectColumn(ProjectRoleVersionTableMap::COL_VERSION);
            $criteria->removeSelectColumn(ProjectRoleVersionTableMap::COL_VERSION_CREATED_AT);
            $criteria->removeSelectColumn(ProjectRoleVersionTableMap::COL_VERSION_CREATED_BY);
            $criteria->removeSelectColumn(ProjectRoleVersionTableMap::COL_VERSION_COMMENT);
            $criteria->removeSelectColumn(ProjectRoleVersionTableMap::COL_PROJECT_ID_VERSION);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.lvl');
            $criteria->removeSelectColumn($alias . '.role_id');
            $criteria->removeSelectColumn($alias . '.project_id');
            $criteria->removeSelectColumn($alias . '.object_id');
            $criteria->removeSelectColumn($alias . '.user_id');
            $criteria->removeSelectColumn($alias . '.version');
            $criteria->removeSelectColumn($alias . '.version_created_at');
            $criteria->removeSelectColumn($alias . '.version_created_by');
            $criteria->removeSelectColumn($alias . '.version_comment');
            $criteria->removeSelectColumn($alias . '.project_id_version');
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
        return Propel::getServiceContainer()->getDatabaseMap(ProjectRoleVersionTableMap::DATABASE_NAME)->getTable(ProjectRoleVersionTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a ProjectRoleVersion or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or ProjectRoleVersion object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ProjectRoleVersionTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \DB\ProjectRoleVersion) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ProjectRoleVersionTableMap::DATABASE_NAME);
            // primary key is composite; we therefore, expect
            // the primary key passed to be an array of pkey values
            if (count($values) == count($values, COUNT_RECURSIVE)) {
                // array is not multi-dimensional
                $values = [$values];
            }
            foreach ($values as $value) {
                $criterion = $criteria->getNewCriterion(ProjectRoleVersionTableMap::COL_ID, $value[0]);
                $criterion->addAnd($criteria->getNewCriterion(ProjectRoleVersionTableMap::COL_VERSION, $value[1]));
                $criteria->addOr($criterion);
            }
        }

        $query = ProjectRoleVersionQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ProjectRoleVersionTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ProjectRoleVersionTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the project_role_version table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return ProjectRoleVersionQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a ProjectRoleVersion or Criteria object.
     *
     * @param mixed $criteria Criteria or ProjectRoleVersion object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProjectRoleVersionTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from ProjectRoleVersion object
        }


        // Set the correct dbName
        $query = ProjectRoleVersionQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
