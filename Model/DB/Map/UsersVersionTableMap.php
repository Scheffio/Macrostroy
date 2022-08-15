<?php

namespace DB\Map;

use DB\UsersVersion;
use DB\UsersVersionQuery;
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
 * This class defines the structure of the 'users_version' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class UsersVersionTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'DB.Map.UsersVersionTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'users_version';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\DB\\UsersVersion';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'DB.UsersVersion';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 17;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 17;

    /**
     * the column name for the id field
     */
    public const COL_ID = 'users_version.id';

    /**
     * the column name for the email field
     */
    public const COL_EMAIL = 'users_version.email';

    /**
     * the column name for the password field
     */
    public const COL_PASSWORD = 'users_version.password';

    /**
     * the column name for the username field
     */
    public const COL_USERNAME = 'users_version.username';

    /**
     * the column name for the status field
     */
    public const COL_STATUS = 'users_version.status';

    /**
     * the column name for the verified field
     */
    public const COL_VERIFIED = 'users_version.verified';

    /**
     * the column name for the resettable field
     */
    public const COL_RESETTABLE = 'users_version.resettable';

    /**
     * the column name for the roles_mask field
     */
    public const COL_ROLES_MASK = 'users_version.roles_mask';

    /**
     * the column name for the registered field
     */
    public const COL_REGISTERED = 'users_version.registered';

    /**
     * the column name for the last_login field
     */
    public const COL_LAST_LOGIN = 'users_version.last_login';

    /**
     * the column name for the force_logout field
     */
    public const COL_FORCE_LOGOUT = 'users_version.force_logout';

    /**
     * the column name for the is_available field
     */
    public const COL_IS_AVAILABLE = 'users_version.is_available';

    /**
     * the column name for the version field
     */
    public const COL_VERSION = 'users_version.version';

    /**
     * the column name for the groups_ids field
     */
    public const COL_GROUPS_IDS = 'users_version.groups_ids';

    /**
     * the column name for the groups_versions field
     */
    public const COL_GROUPS_VERSIONS = 'users_version.groups_versions';

    /**
     * the column name for the unit_ids field
     */
    public const COL_UNIT_IDS = 'users_version.unit_ids';

    /**
     * the column name for the unit_versions field
     */
    public const COL_UNIT_VERSIONS = 'users_version.unit_versions';

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
        self::TYPE_PHPNAME       => ['Id', 'Email', 'Password', 'Username', 'Status', 'Verified', 'Resettable', 'RolesMask', 'Registered', 'LastLogin', 'ForceLogout', 'IsAvailable', 'Version', 'GroupsIds', 'GroupsVersions', 'UnitIds', 'UnitVersions', ],
        self::TYPE_CAMELNAME     => ['id', 'email', 'password', 'username', 'status', 'verified', 'resettable', 'rolesMask', 'registered', 'lastLogin', 'forceLogout', 'isAvailable', 'version', 'groupsIds', 'groupsVersions', 'unitIds', 'unitVersions', ],
        self::TYPE_COLNAME       => [UsersVersionTableMap::COL_ID, UsersVersionTableMap::COL_EMAIL, UsersVersionTableMap::COL_PASSWORD, UsersVersionTableMap::COL_USERNAME, UsersVersionTableMap::COL_STATUS, UsersVersionTableMap::COL_VERIFIED, UsersVersionTableMap::COL_RESETTABLE, UsersVersionTableMap::COL_ROLES_MASK, UsersVersionTableMap::COL_REGISTERED, UsersVersionTableMap::COL_LAST_LOGIN, UsersVersionTableMap::COL_FORCE_LOGOUT, UsersVersionTableMap::COL_IS_AVAILABLE, UsersVersionTableMap::COL_VERSION, UsersVersionTableMap::COL_GROUPS_IDS, UsersVersionTableMap::COL_GROUPS_VERSIONS, UsersVersionTableMap::COL_UNIT_IDS, UsersVersionTableMap::COL_UNIT_VERSIONS, ],
        self::TYPE_FIELDNAME     => ['id', 'email', 'password', 'username', 'status', 'verified', 'resettable', 'roles_mask', 'registered', 'last_login', 'force_logout', 'is_available', 'version', 'groups_ids', 'groups_versions', 'unit_ids', 'unit_versions', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, ]
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
        self::TYPE_PHPNAME       => ['Id' => 0, 'Email' => 1, 'Password' => 2, 'Username' => 3, 'Status' => 4, 'Verified' => 5, 'Resettable' => 6, 'RolesMask' => 7, 'Registered' => 8, 'LastLogin' => 9, 'ForceLogout' => 10, 'IsAvailable' => 11, 'Version' => 12, 'GroupsIds' => 13, 'GroupsVersions' => 14, 'UnitIds' => 15, 'UnitVersions' => 16, ],
        self::TYPE_CAMELNAME     => ['id' => 0, 'email' => 1, 'password' => 2, 'username' => 3, 'status' => 4, 'verified' => 5, 'resettable' => 6, 'rolesMask' => 7, 'registered' => 8, 'lastLogin' => 9, 'forceLogout' => 10, 'isAvailable' => 11, 'version' => 12, 'groupsIds' => 13, 'groupsVersions' => 14, 'unitIds' => 15, 'unitVersions' => 16, ],
        self::TYPE_COLNAME       => [UsersVersionTableMap::COL_ID => 0, UsersVersionTableMap::COL_EMAIL => 1, UsersVersionTableMap::COL_PASSWORD => 2, UsersVersionTableMap::COL_USERNAME => 3, UsersVersionTableMap::COL_STATUS => 4, UsersVersionTableMap::COL_VERIFIED => 5, UsersVersionTableMap::COL_RESETTABLE => 6, UsersVersionTableMap::COL_ROLES_MASK => 7, UsersVersionTableMap::COL_REGISTERED => 8, UsersVersionTableMap::COL_LAST_LOGIN => 9, UsersVersionTableMap::COL_FORCE_LOGOUT => 10, UsersVersionTableMap::COL_IS_AVAILABLE => 11, UsersVersionTableMap::COL_VERSION => 12, UsersVersionTableMap::COL_GROUPS_IDS => 13, UsersVersionTableMap::COL_GROUPS_VERSIONS => 14, UsersVersionTableMap::COL_UNIT_IDS => 15, UsersVersionTableMap::COL_UNIT_VERSIONS => 16, ],
        self::TYPE_FIELDNAME     => ['id' => 0, 'email' => 1, 'password' => 2, 'username' => 3, 'status' => 4, 'verified' => 5, 'resettable' => 6, 'roles_mask' => 7, 'registered' => 8, 'last_login' => 9, 'force_logout' => 10, 'is_available' => 11, 'version' => 12, 'groups_ids' => 13, 'groups_versions' => 14, 'unit_ids' => 15, 'unit_versions' => 16, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'UsersVersion.Id' => 'ID',
        'id' => 'ID',
        'usersVersion.id' => 'ID',
        'UsersVersionTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'users_version.id' => 'ID',
        'Email' => 'EMAIL',
        'UsersVersion.Email' => 'EMAIL',
        'email' => 'EMAIL',
        'usersVersion.email' => 'EMAIL',
        'UsersVersionTableMap::COL_EMAIL' => 'EMAIL',
        'COL_EMAIL' => 'EMAIL',
        'users_version.email' => 'EMAIL',
        'Password' => 'PASSWORD',
        'UsersVersion.Password' => 'PASSWORD',
        'password' => 'PASSWORD',
        'usersVersion.password' => 'PASSWORD',
        'UsersVersionTableMap::COL_PASSWORD' => 'PASSWORD',
        'COL_PASSWORD' => 'PASSWORD',
        'users_version.password' => 'PASSWORD',
        'Username' => 'USERNAME',
        'UsersVersion.Username' => 'USERNAME',
        'username' => 'USERNAME',
        'usersVersion.username' => 'USERNAME',
        'UsersVersionTableMap::COL_USERNAME' => 'USERNAME',
        'COL_USERNAME' => 'USERNAME',
        'users_version.username' => 'USERNAME',
        'Status' => 'STATUS',
        'UsersVersion.Status' => 'STATUS',
        'status' => 'STATUS',
        'usersVersion.status' => 'STATUS',
        'UsersVersionTableMap::COL_STATUS' => 'STATUS',
        'COL_STATUS' => 'STATUS',
        'users_version.status' => 'STATUS',
        'Verified' => 'VERIFIED',
        'UsersVersion.Verified' => 'VERIFIED',
        'verified' => 'VERIFIED',
        'usersVersion.verified' => 'VERIFIED',
        'UsersVersionTableMap::COL_VERIFIED' => 'VERIFIED',
        'COL_VERIFIED' => 'VERIFIED',
        'users_version.verified' => 'VERIFIED',
        'Resettable' => 'RESETTABLE',
        'UsersVersion.Resettable' => 'RESETTABLE',
        'resettable' => 'RESETTABLE',
        'usersVersion.resettable' => 'RESETTABLE',
        'UsersVersionTableMap::COL_RESETTABLE' => 'RESETTABLE',
        'COL_RESETTABLE' => 'RESETTABLE',
        'users_version.resettable' => 'RESETTABLE',
        'RolesMask' => 'ROLES_MASK',
        'UsersVersion.RolesMask' => 'ROLES_MASK',
        'rolesMask' => 'ROLES_MASK',
        'usersVersion.rolesMask' => 'ROLES_MASK',
        'UsersVersionTableMap::COL_ROLES_MASK' => 'ROLES_MASK',
        'COL_ROLES_MASK' => 'ROLES_MASK',
        'roles_mask' => 'ROLES_MASK',
        'users_version.roles_mask' => 'ROLES_MASK',
        'Registered' => 'REGISTERED',
        'UsersVersion.Registered' => 'REGISTERED',
        'registered' => 'REGISTERED',
        'usersVersion.registered' => 'REGISTERED',
        'UsersVersionTableMap::COL_REGISTERED' => 'REGISTERED',
        'COL_REGISTERED' => 'REGISTERED',
        'users_version.registered' => 'REGISTERED',
        'LastLogin' => 'LAST_LOGIN',
        'UsersVersion.LastLogin' => 'LAST_LOGIN',
        'lastLogin' => 'LAST_LOGIN',
        'usersVersion.lastLogin' => 'LAST_LOGIN',
        'UsersVersionTableMap::COL_LAST_LOGIN' => 'LAST_LOGIN',
        'COL_LAST_LOGIN' => 'LAST_LOGIN',
        'last_login' => 'LAST_LOGIN',
        'users_version.last_login' => 'LAST_LOGIN',
        'ForceLogout' => 'FORCE_LOGOUT',
        'UsersVersion.ForceLogout' => 'FORCE_LOGOUT',
        'forceLogout' => 'FORCE_LOGOUT',
        'usersVersion.forceLogout' => 'FORCE_LOGOUT',
        'UsersVersionTableMap::COL_FORCE_LOGOUT' => 'FORCE_LOGOUT',
        'COL_FORCE_LOGOUT' => 'FORCE_LOGOUT',
        'force_logout' => 'FORCE_LOGOUT',
        'users_version.force_logout' => 'FORCE_LOGOUT',
        'IsAvailable' => 'IS_AVAILABLE',
        'UsersVersion.IsAvailable' => 'IS_AVAILABLE',
        'isAvailable' => 'IS_AVAILABLE',
        'usersVersion.isAvailable' => 'IS_AVAILABLE',
        'UsersVersionTableMap::COL_IS_AVAILABLE' => 'IS_AVAILABLE',
        'COL_IS_AVAILABLE' => 'IS_AVAILABLE',
        'is_available' => 'IS_AVAILABLE',
        'users_version.is_available' => 'IS_AVAILABLE',
        'Version' => 'VERSION',
        'UsersVersion.Version' => 'VERSION',
        'version' => 'VERSION',
        'usersVersion.version' => 'VERSION',
        'UsersVersionTableMap::COL_VERSION' => 'VERSION',
        'COL_VERSION' => 'VERSION',
        'users_version.version' => 'VERSION',
        'GroupsIds' => 'GROUPS_IDS',
        'UsersVersion.GroupsIds' => 'GROUPS_IDS',
        'groupsIds' => 'GROUPS_IDS',
        'usersVersion.groupsIds' => 'GROUPS_IDS',
        'UsersVersionTableMap::COL_GROUPS_IDS' => 'GROUPS_IDS',
        'COL_GROUPS_IDS' => 'GROUPS_IDS',
        'groups_ids' => 'GROUPS_IDS',
        'users_version.groups_ids' => 'GROUPS_IDS',
        'GroupsVersions' => 'GROUPS_VERSIONS',
        'UsersVersion.GroupsVersions' => 'GROUPS_VERSIONS',
        'groupsVersions' => 'GROUPS_VERSIONS',
        'usersVersion.groupsVersions' => 'GROUPS_VERSIONS',
        'UsersVersionTableMap::COL_GROUPS_VERSIONS' => 'GROUPS_VERSIONS',
        'COL_GROUPS_VERSIONS' => 'GROUPS_VERSIONS',
        'groups_versions' => 'GROUPS_VERSIONS',
        'users_version.groups_versions' => 'GROUPS_VERSIONS',
        'UnitIds' => 'UNIT_IDS',
        'UsersVersion.UnitIds' => 'UNIT_IDS',
        'unitIds' => 'UNIT_IDS',
        'usersVersion.unitIds' => 'UNIT_IDS',
        'UsersVersionTableMap::COL_UNIT_IDS' => 'UNIT_IDS',
        'COL_UNIT_IDS' => 'UNIT_IDS',
        'unit_ids' => 'UNIT_IDS',
        'users_version.unit_ids' => 'UNIT_IDS',
        'UnitVersions' => 'UNIT_VERSIONS',
        'UsersVersion.UnitVersions' => 'UNIT_VERSIONS',
        'unitVersions' => 'UNIT_VERSIONS',
        'usersVersion.unitVersions' => 'UNIT_VERSIONS',
        'UsersVersionTableMap::COL_UNIT_VERSIONS' => 'UNIT_VERSIONS',
        'COL_UNIT_VERSIONS' => 'UNIT_VERSIONS',
        'unit_versions' => 'UNIT_VERSIONS',
        'users_version.unit_versions' => 'UNIT_VERSIONS',
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
        $this->setName('users_version');
        $this->setPhpName('UsersVersion');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\DB\\UsersVersion');
        $this->setPackage('DB');
        $this->setUseIdGenerator(false);
        // columns
        $this->addForeignPrimaryKey('id', 'Id', 'INTEGER' , 'users', 'id', true, null, null);
        $this->addColumn('email', 'Email', 'VARCHAR', true, 249, null);
        $this->addColumn('password', 'Password', 'VARCHAR', true, 255, null);
        $this->addColumn('username', 'Username', 'VARCHAR', false, 100, null);
        $this->addColumn('status', 'Status', 'TINYINT', true, null, 0);
        $this->addColumn('verified', 'Verified', 'TINYINT', true, null, 0);
        $this->addColumn('resettable', 'Resettable', 'TINYINT', true, null, 1);
        $this->addColumn('roles_mask', 'RolesMask', 'INTEGER', true, null, 0);
        $this->addColumn('registered', 'Registered', 'INTEGER', true, null, null);
        $this->addColumn('last_login', 'LastLogin', 'INTEGER', false, null, null);
        $this->addColumn('force_logout', 'ForceLogout', 'SMALLINT', true, null, 0);
        $this->addColumn('is_available', 'IsAvailable', 'BOOLEAN', true, 1, true);
        $this->addPrimaryKey('version', 'Version', 'INTEGER', true, null, 0);
        $this->addColumn('groups_ids', 'GroupsIds', 'ARRAY', false, null, null);
        $this->addColumn('groups_versions', 'GroupsVersions', 'ARRAY', false, null, null);
        $this->addColumn('unit_ids', 'UnitIds', 'ARRAY', false, null, null);
        $this->addColumn('unit_versions', 'UnitVersions', 'ARRAY', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Users', '\\DB\\Users', RelationMap::MANY_TO_ONE, array (
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
     * @param \DB\UsersVersion $obj A \DB\UsersVersion object.
     * @param string|null $key Key (optional) to use for instance map (for performance boost if key was already calculated externally).
     *
     * @return void
     */
    public static function addInstanceToPool(UsersVersion $obj, ?string $key = null): void
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
     * @param mixed $value A \DB\UsersVersion object or a primary key value.
     *
     * @return void
     */
    public static function removeInstanceFromPool($value): void
    {
        if (Propel::isInstancePoolingEnabled() && null !== $value) {
            if (is_object($value) && $value instanceof \DB\UsersVersion) {
                $key = serialize([(null === $value->getId() || is_scalar($value->getId()) || is_callable([$value->getId(), '__toString']) ? (string) $value->getId() : $value->getId()), (null === $value->getVersion() || is_scalar($value->getVersion()) || is_callable([$value->getVersion(), '__toString']) ? (string) $value->getVersion() : $value->getVersion())]);

            } elseif (is_array($value) && count($value) === 2) {
                // assume we've been passed a primary key";
                $key = serialize([(null === $value[0] || is_scalar($value[0]) || is_callable([$value[0], '__toString']) ? (string) $value[0] : $value[0]), (null === $value[1] || is_scalar($value[1]) || is_callable([$value[1], '__toString']) ? (string) $value[1] : $value[1])]);
            } elseif ($value instanceof Criteria) {
                self::$instances = [];

                return;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or \DB\UsersVersion object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value, true)));
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null && $row[TableMap::TYPE_NUM == $indexType ? 12 + $offset : static::translateFieldName('Version', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return serialize([(null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]), (null === $row[TableMap::TYPE_NUM == $indexType ? 12 + $offset : static::translateFieldName('Version', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 12 + $offset : static::translateFieldName('Version', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 12 + $offset : static::translateFieldName('Version', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 12 + $offset : static::translateFieldName('Version', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 12 + $offset : static::translateFieldName('Version', TableMap::TYPE_PHPNAME, $indexType)])]);
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
                ? 12 + $offset
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
        return $withPrefix ? UsersVersionTableMap::CLASS_DEFAULT : UsersVersionTableMap::OM_CLASS;
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
     * @return array (UsersVersion object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = UsersVersionTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = UsersVersionTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + UsersVersionTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = UsersVersionTableMap::OM_CLASS;
            /** @var UsersVersion $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            UsersVersionTableMap::addInstanceToPool($obj, $key);
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
            $key = UsersVersionTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = UsersVersionTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var UsersVersion $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                UsersVersionTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(UsersVersionTableMap::COL_ID);
            $criteria->addSelectColumn(UsersVersionTableMap::COL_EMAIL);
            $criteria->addSelectColumn(UsersVersionTableMap::COL_PASSWORD);
            $criteria->addSelectColumn(UsersVersionTableMap::COL_USERNAME);
            $criteria->addSelectColumn(UsersVersionTableMap::COL_STATUS);
            $criteria->addSelectColumn(UsersVersionTableMap::COL_VERIFIED);
            $criteria->addSelectColumn(UsersVersionTableMap::COL_RESETTABLE);
            $criteria->addSelectColumn(UsersVersionTableMap::COL_ROLES_MASK);
            $criteria->addSelectColumn(UsersVersionTableMap::COL_REGISTERED);
            $criteria->addSelectColumn(UsersVersionTableMap::COL_LAST_LOGIN);
            $criteria->addSelectColumn(UsersVersionTableMap::COL_FORCE_LOGOUT);
            $criteria->addSelectColumn(UsersVersionTableMap::COL_IS_AVAILABLE);
            $criteria->addSelectColumn(UsersVersionTableMap::COL_VERSION);
            $criteria->addSelectColumn(UsersVersionTableMap::COL_GROUPS_IDS);
            $criteria->addSelectColumn(UsersVersionTableMap::COL_GROUPS_VERSIONS);
            $criteria->addSelectColumn(UsersVersionTableMap::COL_UNIT_IDS);
            $criteria->addSelectColumn(UsersVersionTableMap::COL_UNIT_VERSIONS);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.email');
            $criteria->addSelectColumn($alias . '.password');
            $criteria->addSelectColumn($alias . '.username');
            $criteria->addSelectColumn($alias . '.status');
            $criteria->addSelectColumn($alias . '.verified');
            $criteria->addSelectColumn($alias . '.resettable');
            $criteria->addSelectColumn($alias . '.roles_mask');
            $criteria->addSelectColumn($alias . '.registered');
            $criteria->addSelectColumn($alias . '.last_login');
            $criteria->addSelectColumn($alias . '.force_logout');
            $criteria->addSelectColumn($alias . '.is_available');
            $criteria->addSelectColumn($alias . '.version');
            $criteria->addSelectColumn($alias . '.groups_ids');
            $criteria->addSelectColumn($alias . '.groups_versions');
            $criteria->addSelectColumn($alias . '.unit_ids');
            $criteria->addSelectColumn($alias . '.unit_versions');
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
            $criteria->removeSelectColumn(UsersVersionTableMap::COL_ID);
            $criteria->removeSelectColumn(UsersVersionTableMap::COL_EMAIL);
            $criteria->removeSelectColumn(UsersVersionTableMap::COL_PASSWORD);
            $criteria->removeSelectColumn(UsersVersionTableMap::COL_USERNAME);
            $criteria->removeSelectColumn(UsersVersionTableMap::COL_STATUS);
            $criteria->removeSelectColumn(UsersVersionTableMap::COL_VERIFIED);
            $criteria->removeSelectColumn(UsersVersionTableMap::COL_RESETTABLE);
            $criteria->removeSelectColumn(UsersVersionTableMap::COL_ROLES_MASK);
            $criteria->removeSelectColumn(UsersVersionTableMap::COL_REGISTERED);
            $criteria->removeSelectColumn(UsersVersionTableMap::COL_LAST_LOGIN);
            $criteria->removeSelectColumn(UsersVersionTableMap::COL_FORCE_LOGOUT);
            $criteria->removeSelectColumn(UsersVersionTableMap::COL_IS_AVAILABLE);
            $criteria->removeSelectColumn(UsersVersionTableMap::COL_VERSION);
            $criteria->removeSelectColumn(UsersVersionTableMap::COL_GROUPS_IDS);
            $criteria->removeSelectColumn(UsersVersionTableMap::COL_GROUPS_VERSIONS);
            $criteria->removeSelectColumn(UsersVersionTableMap::COL_UNIT_IDS);
            $criteria->removeSelectColumn(UsersVersionTableMap::COL_UNIT_VERSIONS);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.email');
            $criteria->removeSelectColumn($alias . '.password');
            $criteria->removeSelectColumn($alias . '.username');
            $criteria->removeSelectColumn($alias . '.status');
            $criteria->removeSelectColumn($alias . '.verified');
            $criteria->removeSelectColumn($alias . '.resettable');
            $criteria->removeSelectColumn($alias . '.roles_mask');
            $criteria->removeSelectColumn($alias . '.registered');
            $criteria->removeSelectColumn($alias . '.last_login');
            $criteria->removeSelectColumn($alias . '.force_logout');
            $criteria->removeSelectColumn($alias . '.is_available');
            $criteria->removeSelectColumn($alias . '.version');
            $criteria->removeSelectColumn($alias . '.groups_ids');
            $criteria->removeSelectColumn($alias . '.groups_versions');
            $criteria->removeSelectColumn($alias . '.unit_ids');
            $criteria->removeSelectColumn($alias . '.unit_versions');
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
        return Propel::getServiceContainer()->getDatabaseMap(UsersVersionTableMap::DATABASE_NAME)->getTable(UsersVersionTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a UsersVersion or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or UsersVersion object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(UsersVersionTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \DB\UsersVersion) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(UsersVersionTableMap::DATABASE_NAME);
            // primary key is composite; we therefore, expect
            // the primary key passed to be an array of pkey values
            if (count($values) == count($values, COUNT_RECURSIVE)) {
                // array is not multi-dimensional
                $values = [$values];
            }
            foreach ($values as $value) {
                $criterion = $criteria->getNewCriterion(UsersVersionTableMap::COL_ID, $value[0]);
                $criterion->addAnd($criteria->getNewCriterion(UsersVersionTableMap::COL_VERSION, $value[1]));
                $criteria->addOr($criterion);
            }
        }

        $query = UsersVersionQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            UsersVersionTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                UsersVersionTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the users_version table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return UsersVersionQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a UsersVersion or Criteria object.
     *
     * @param mixed $criteria Criteria or UsersVersion object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsersVersionTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from UsersVersion object
        }


        // Set the correct dbName
        $query = UsersVersionQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
