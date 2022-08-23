<?php

namespace DB\Map;

use DB\ProjectRole;
use DB\ProjectRoleQuery;
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
 * This class defines the structure of the 'project_role' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class ProjectRoleTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'DB.Map.ProjectRoleTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'project_role';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'ProjectRole';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\DB\\ProjectRole';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'DB.ProjectRole';

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
    public const COL_ID = 'project_role.id';

    /**
     * the column name for the lvl field
     */
    public const COL_LVL = 'project_role.lvl';

    /**
     * the column name for the role_id field
     */
    public const COL_ROLE_ID = 'project_role.role_id';

    /**
     * the column name for the project_id field
     */
    public const COL_PROJECT_ID = 'project_role.project_id';

    /**
     * the column name for the object_id field
     */
    public const COL_OBJECT_ID = 'project_role.object_id';

    /**
     * the column name for the user_id field
     */
    public const COL_USER_ID = 'project_role.user_id';

    /**
     * the column name for the version field
     */
    public const COL_VERSION = 'project_role.version';

    /**
     * the column name for the version_created_at field
     */
    public const COL_VERSION_CREATED_AT = 'project_role.version_created_at';

    /**
     * the column name for the version_created_by field
     */
    public const COL_VERSION_CREATED_BY = 'project_role.version_created_by';

    /**
     * the column name for the version_comment field
     */
    public const COL_VERSION_COMMENT = 'project_role.version_comment';

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
        self::TYPE_PHPNAME       => ['Id', 'Lvl', 'RoleId', 'ProjectId', 'ObjectId', 'UserId', 'Version', 'VersionCreatedAt', 'VersionCreatedBy', 'VersionComment', ],
        self::TYPE_CAMELNAME     => ['id', 'lvl', 'roleId', 'projectId', 'objectId', 'userId', 'version', 'versionCreatedAt', 'versionCreatedBy', 'versionComment', ],
        self::TYPE_COLNAME       => [ProjectRoleTableMap::COL_ID, ProjectRoleTableMap::COL_LVL, ProjectRoleTableMap::COL_ROLE_ID, ProjectRoleTableMap::COL_PROJECT_ID, ProjectRoleTableMap::COL_OBJECT_ID, ProjectRoleTableMap::COL_USER_ID, ProjectRoleTableMap::COL_VERSION, ProjectRoleTableMap::COL_VERSION_CREATED_AT, ProjectRoleTableMap::COL_VERSION_CREATED_BY, ProjectRoleTableMap::COL_VERSION_COMMENT, ],
        self::TYPE_FIELDNAME     => ['id', 'lvl', 'role_id', 'project_id', 'object_id', 'user_id', 'version', 'version_created_at', 'version_created_by', 'version_comment', ],
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
        self::TYPE_PHPNAME       => ['Id' => 0, 'Lvl' => 1, 'RoleId' => 2, 'ProjectId' => 3, 'ObjectId' => 4, 'UserId' => 5, 'Version' => 6, 'VersionCreatedAt' => 7, 'VersionCreatedBy' => 8, 'VersionComment' => 9, ],
        self::TYPE_CAMELNAME     => ['id' => 0, 'lvl' => 1, 'roleId' => 2, 'projectId' => 3, 'objectId' => 4, 'userId' => 5, 'version' => 6, 'versionCreatedAt' => 7, 'versionCreatedBy' => 8, 'versionComment' => 9, ],
        self::TYPE_COLNAME       => [ProjectRoleTableMap::COL_ID => 0, ProjectRoleTableMap::COL_LVL => 1, ProjectRoleTableMap::COL_ROLE_ID => 2, ProjectRoleTableMap::COL_PROJECT_ID => 3, ProjectRoleTableMap::COL_OBJECT_ID => 4, ProjectRoleTableMap::COL_USER_ID => 5, ProjectRoleTableMap::COL_VERSION => 6, ProjectRoleTableMap::COL_VERSION_CREATED_AT => 7, ProjectRoleTableMap::COL_VERSION_CREATED_BY => 8, ProjectRoleTableMap::COL_VERSION_COMMENT => 9, ],
        self::TYPE_FIELDNAME     => ['id' => 0, 'lvl' => 1, 'role_id' => 2, 'project_id' => 3, 'object_id' => 4, 'user_id' => 5, 'version' => 6, 'version_created_at' => 7, 'version_created_by' => 8, 'version_comment' => 9, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'ProjectRole.Id' => 'ID',
        'id' => 'ID',
        'projectRole.id' => 'ID',
        'ProjectRoleTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'project_role.id' => 'ID',
        'Lvl' => 'LVL',
        'ProjectRole.Lvl' => 'LVL',
        'lvl' => 'LVL',
        'projectRole.lvl' => 'LVL',
        'ProjectRoleTableMap::COL_LVL' => 'LVL',
        'COL_LVL' => 'LVL',
        'project_role.lvl' => 'LVL',
        'RoleId' => 'ROLE_ID',
        'ProjectRole.RoleId' => 'ROLE_ID',
        'roleId' => 'ROLE_ID',
        'projectRole.roleId' => 'ROLE_ID',
        'ProjectRoleTableMap::COL_ROLE_ID' => 'ROLE_ID',
        'COL_ROLE_ID' => 'ROLE_ID',
        'role_id' => 'ROLE_ID',
        'project_role.role_id' => 'ROLE_ID',
        'ProjectId' => 'PROJECT_ID',
        'ProjectRole.ProjectId' => 'PROJECT_ID',
        'projectId' => 'PROJECT_ID',
        'projectRole.projectId' => 'PROJECT_ID',
        'ProjectRoleTableMap::COL_PROJECT_ID' => 'PROJECT_ID',
        'COL_PROJECT_ID' => 'PROJECT_ID',
        'project_id' => 'PROJECT_ID',
        'project_role.project_id' => 'PROJECT_ID',
        'ObjectId' => 'OBJECT_ID',
        'ProjectRole.ObjectId' => 'OBJECT_ID',
        'objectId' => 'OBJECT_ID',
        'projectRole.objectId' => 'OBJECT_ID',
        'ProjectRoleTableMap::COL_OBJECT_ID' => 'OBJECT_ID',
        'COL_OBJECT_ID' => 'OBJECT_ID',
        'object_id' => 'OBJECT_ID',
        'project_role.object_id' => 'OBJECT_ID',
        'UserId' => 'USER_ID',
        'ProjectRole.UserId' => 'USER_ID',
        'userId' => 'USER_ID',
        'projectRole.userId' => 'USER_ID',
        'ProjectRoleTableMap::COL_USER_ID' => 'USER_ID',
        'COL_USER_ID' => 'USER_ID',
        'user_id' => 'USER_ID',
        'project_role.user_id' => 'USER_ID',
        'Version' => 'VERSION',
        'ProjectRole.Version' => 'VERSION',
        'version' => 'VERSION',
        'projectRole.version' => 'VERSION',
        'ProjectRoleTableMap::COL_VERSION' => 'VERSION',
        'COL_VERSION' => 'VERSION',
        'project_role.version' => 'VERSION',
        'VersionCreatedAt' => 'VERSION_CREATED_AT',
        'ProjectRole.VersionCreatedAt' => 'VERSION_CREATED_AT',
        'versionCreatedAt' => 'VERSION_CREATED_AT',
        'projectRole.versionCreatedAt' => 'VERSION_CREATED_AT',
        'ProjectRoleTableMap::COL_VERSION_CREATED_AT' => 'VERSION_CREATED_AT',
        'COL_VERSION_CREATED_AT' => 'VERSION_CREATED_AT',
        'version_created_at' => 'VERSION_CREATED_AT',
        'project_role.version_created_at' => 'VERSION_CREATED_AT',
        'VersionCreatedBy' => 'VERSION_CREATED_BY',
        'ProjectRole.VersionCreatedBy' => 'VERSION_CREATED_BY',
        'versionCreatedBy' => 'VERSION_CREATED_BY',
        'projectRole.versionCreatedBy' => 'VERSION_CREATED_BY',
        'ProjectRoleTableMap::COL_VERSION_CREATED_BY' => 'VERSION_CREATED_BY',
        'COL_VERSION_CREATED_BY' => 'VERSION_CREATED_BY',
        'version_created_by' => 'VERSION_CREATED_BY',
        'project_role.version_created_by' => 'VERSION_CREATED_BY',
        'VersionComment' => 'VERSION_COMMENT',
        'ProjectRole.VersionComment' => 'VERSION_COMMENT',
        'versionComment' => 'VERSION_COMMENT',
        'projectRole.versionComment' => 'VERSION_COMMENT',
        'ProjectRoleTableMap::COL_VERSION_COMMENT' => 'VERSION_COMMENT',
        'COL_VERSION_COMMENT' => 'VERSION_COMMENT',
        'version_comment' => 'VERSION_COMMENT',
        'project_role.version_comment' => 'VERSION_COMMENT',
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
        $this->setName('project_role');
        $this->setPhpName('ProjectRole');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\DB\\ProjectRole');
        $this->setPackage('DB');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('lvl', 'Lvl', 'TINYINT', true, null, 1);
        $this->addForeignKey('role_id', 'RoleId', 'INTEGER', 'role', 'id', true, null, null);
        $this->addForeignKey('project_id', 'ProjectId', 'INTEGER', 'project', 'id', true, null, null);
        $this->addColumn('object_id', 'ObjectId', 'INTEGER', true, null, null);
        $this->addForeignKey('user_id', 'UserId', 'INTEGER', 'users', 'id', true, null, null);
        $this->addColumn('version', 'Version', 'INTEGER', false, null, 0);
        $this->addColumn('version_created_at', 'VersionCreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('version_created_by', 'VersionCreatedBy', 'VARCHAR', false, 100, null);
        $this->addColumn('version_comment', 'VersionComment', 'VARCHAR', false, 255, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Role', '\\DB\\Role', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':role_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('Project', '\\DB\\Project', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':project_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('Users', '\\DB\\Users', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':user_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('ProjectRoleVersion', '\\DB\\ProjectRoleVersion', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':id',
    1 => ':id',
  ),
), 'CASCADE', null, 'ProjectRoleVersions', false);
    }

    /**
     * Method to invalidate the instance pool of all tables related to project_role     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool(): void
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        ProjectRoleVersionTableMap::clearInstancePool();
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
        return $withPrefix ? ProjectRoleTableMap::CLASS_DEFAULT : ProjectRoleTableMap::OM_CLASS;
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
     * @return array (ProjectRole object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = ProjectRoleTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ProjectRoleTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ProjectRoleTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ProjectRoleTableMap::OM_CLASS;
            /** @var ProjectRole $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ProjectRoleTableMap::addInstanceToPool($obj, $key);
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
            $key = ProjectRoleTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ProjectRoleTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var ProjectRole $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ProjectRoleTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ProjectRoleTableMap::COL_ID);
            $criteria->addSelectColumn(ProjectRoleTableMap::COL_LVL);
            $criteria->addSelectColumn(ProjectRoleTableMap::COL_ROLE_ID);
            $criteria->addSelectColumn(ProjectRoleTableMap::COL_PROJECT_ID);
            $criteria->addSelectColumn(ProjectRoleTableMap::COL_OBJECT_ID);
            $criteria->addSelectColumn(ProjectRoleTableMap::COL_USER_ID);
            $criteria->addSelectColumn(ProjectRoleTableMap::COL_VERSION);
            $criteria->addSelectColumn(ProjectRoleTableMap::COL_VERSION_CREATED_AT);
            $criteria->addSelectColumn(ProjectRoleTableMap::COL_VERSION_CREATED_BY);
            $criteria->addSelectColumn(ProjectRoleTableMap::COL_VERSION_COMMENT);
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
            $criteria->removeSelectColumn(ProjectRoleTableMap::COL_ID);
            $criteria->removeSelectColumn(ProjectRoleTableMap::COL_LVL);
            $criteria->removeSelectColumn(ProjectRoleTableMap::COL_ROLE_ID);
            $criteria->removeSelectColumn(ProjectRoleTableMap::COL_PROJECT_ID);
            $criteria->removeSelectColumn(ProjectRoleTableMap::COL_OBJECT_ID);
            $criteria->removeSelectColumn(ProjectRoleTableMap::COL_USER_ID);
            $criteria->removeSelectColumn(ProjectRoleTableMap::COL_VERSION);
            $criteria->removeSelectColumn(ProjectRoleTableMap::COL_VERSION_CREATED_AT);
            $criteria->removeSelectColumn(ProjectRoleTableMap::COL_VERSION_CREATED_BY);
            $criteria->removeSelectColumn(ProjectRoleTableMap::COL_VERSION_COMMENT);
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
        return Propel::getServiceContainer()->getDatabaseMap(ProjectRoleTableMap::DATABASE_NAME)->getTable(ProjectRoleTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a ProjectRole or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or ProjectRole object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ProjectRoleTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \DB\ProjectRole) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ProjectRoleTableMap::DATABASE_NAME);
            $criteria->add(ProjectRoleTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = ProjectRoleQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ProjectRoleTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ProjectRoleTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the project_role table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return ProjectRoleQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a ProjectRole or Criteria object.
     *
     * @param mixed $criteria Criteria or ProjectRole object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProjectRoleTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from ProjectRole object
        }

        if ($criteria->containsKey(ProjectRoleTableMap::COL_ID) && $criteria->keyContainsValue(ProjectRoleTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.ProjectRoleTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = ProjectRoleQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
