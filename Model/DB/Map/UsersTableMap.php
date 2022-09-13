<?php

namespace DB\Map;

use DB\Users;
use DB\UsersQuery;
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
 * This class defines the structure of the 'users' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class UsersTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'DB.Map.UsersTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'users';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'Users';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\DB\\Users';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'DB.Users';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 14;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 14;

    /**
     * the column name for the id field
     */
    public const COL_ID = 'users.id';

    /**
     * the column name for the email field
     */
    public const COL_EMAIL = 'users.email';

    /**
     * the column name for the phone field
     */
    public const COL_PHONE = 'users.phone';

    /**
     * the column name for the password field
     */
    public const COL_PASSWORD = 'users.password';

    /**
     * the column name for the username field
     */
    public const COL_USERNAME = 'users.username';

    /**
     * the column name for the status field
     */
    public const COL_STATUS = 'users.status';

    /**
     * the column name for the role_id field
     */
    public const COL_ROLE_ID = 'users.role_id';

    /**
     * the column name for the verified field
     */
    public const COL_VERIFIED = 'users.verified';

    /**
     * the column name for the resettable field
     */
    public const COL_RESETTABLE = 'users.resettable';

    /**
     * the column name for the roles_mask field
     */
    public const COL_ROLES_MASK = 'users.roles_mask';

    /**
     * the column name for the registered field
     */
    public const COL_REGISTERED = 'users.registered';

    /**
     * the column name for the last_login field
     */
    public const COL_LAST_LOGIN = 'users.last_login';

    /**
     * the column name for the force_logout field
     */
    public const COL_FORCE_LOGOUT = 'users.force_logout';

    /**
     * the column name for the is_available field
     */
    public const COL_IS_AVAILABLE = 'users.is_available';

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
        self::TYPE_PHPNAME       => ['Id', 'Email', 'Phone', 'Password', 'Username', 'Status', 'RoleId', 'Verified', 'Resettable', 'RolesMask', 'Registered', 'LastLogin', 'ForceLogout', 'IsAvailable', ],
        self::TYPE_CAMELNAME     => ['id', 'email', 'phone', 'password', 'username', 'status', 'roleId', 'verified', 'resettable', 'rolesMask', 'registered', 'lastLogin', 'forceLogout', 'isAvailable', ],
        self::TYPE_COLNAME       => [UsersTableMap::COL_ID, UsersTableMap::COL_EMAIL, UsersTableMap::COL_PHONE, UsersTableMap::COL_PASSWORD, UsersTableMap::COL_USERNAME, UsersTableMap::COL_STATUS, UsersTableMap::COL_ROLE_ID, UsersTableMap::COL_VERIFIED, UsersTableMap::COL_RESETTABLE, UsersTableMap::COL_ROLES_MASK, UsersTableMap::COL_REGISTERED, UsersTableMap::COL_LAST_LOGIN, UsersTableMap::COL_FORCE_LOGOUT, UsersTableMap::COL_IS_AVAILABLE, ],
        self::TYPE_FIELDNAME     => ['id', 'email', 'phone', 'password', 'username', 'status', 'role_id', 'verified', 'resettable', 'roles_mask', 'registered', 'last_login', 'force_logout', 'is_available', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, ]
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
        self::TYPE_PHPNAME       => ['Id' => 0, 'Email' => 1, 'Phone' => 2, 'Password' => 3, 'Username' => 4, 'Status' => 5, 'RoleId' => 6, 'Verified' => 7, 'Resettable' => 8, 'RolesMask' => 9, 'Registered' => 10, 'LastLogin' => 11, 'ForceLogout' => 12, 'IsAvailable' => 13, ],
        self::TYPE_CAMELNAME     => ['id' => 0, 'email' => 1, 'phone' => 2, 'password' => 3, 'username' => 4, 'status' => 5, 'roleId' => 6, 'verified' => 7, 'resettable' => 8, 'rolesMask' => 9, 'registered' => 10, 'lastLogin' => 11, 'forceLogout' => 12, 'isAvailable' => 13, ],
        self::TYPE_COLNAME       => [UsersTableMap::COL_ID => 0, UsersTableMap::COL_EMAIL => 1, UsersTableMap::COL_PHONE => 2, UsersTableMap::COL_PASSWORD => 3, UsersTableMap::COL_USERNAME => 4, UsersTableMap::COL_STATUS => 5, UsersTableMap::COL_ROLE_ID => 6, UsersTableMap::COL_VERIFIED => 7, UsersTableMap::COL_RESETTABLE => 8, UsersTableMap::COL_ROLES_MASK => 9, UsersTableMap::COL_REGISTERED => 10, UsersTableMap::COL_LAST_LOGIN => 11, UsersTableMap::COL_FORCE_LOGOUT => 12, UsersTableMap::COL_IS_AVAILABLE => 13, ],
        self::TYPE_FIELDNAME     => ['id' => 0, 'email' => 1, 'phone' => 2, 'password' => 3, 'username' => 4, 'status' => 5, 'role_id' => 6, 'verified' => 7, 'resettable' => 8, 'roles_mask' => 9, 'registered' => 10, 'last_login' => 11, 'force_logout' => 12, 'is_available' => 13, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'Users.Id' => 'ID',
        'id' => 'ID',
        'users.id' => 'ID',
        'UsersTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'Email' => 'EMAIL',
        'Users.Email' => 'EMAIL',
        'email' => 'EMAIL',
        'users.email' => 'EMAIL',
        'UsersTableMap::COL_EMAIL' => 'EMAIL',
        'COL_EMAIL' => 'EMAIL',
        'Phone' => 'PHONE',
        'Users.Phone' => 'PHONE',
        'phone' => 'PHONE',
        'users.phone' => 'PHONE',
        'UsersTableMap::COL_PHONE' => 'PHONE',
        'COL_PHONE' => 'PHONE',
        'Password' => 'PASSWORD',
        'Users.Password' => 'PASSWORD',
        'password' => 'PASSWORD',
        'users.password' => 'PASSWORD',
        'UsersTableMap::COL_PASSWORD' => 'PASSWORD',
        'COL_PASSWORD' => 'PASSWORD',
        'Username' => 'USERNAME',
        'Users.Username' => 'USERNAME',
        'username' => 'USERNAME',
        'users.username' => 'USERNAME',
        'UsersTableMap::COL_USERNAME' => 'USERNAME',
        'COL_USERNAME' => 'USERNAME',
        'Status' => 'STATUS',
        'Users.Status' => 'STATUS',
        'status' => 'STATUS',
        'users.status' => 'STATUS',
        'UsersTableMap::COL_STATUS' => 'STATUS',
        'COL_STATUS' => 'STATUS',
        'RoleId' => 'ROLE_ID',
        'Users.RoleId' => 'ROLE_ID',
        'roleId' => 'ROLE_ID',
        'users.roleId' => 'ROLE_ID',
        'UsersTableMap::COL_ROLE_ID' => 'ROLE_ID',
        'COL_ROLE_ID' => 'ROLE_ID',
        'role_id' => 'ROLE_ID',
        'users.role_id' => 'ROLE_ID',
        'Verified' => 'VERIFIED',
        'Users.Verified' => 'VERIFIED',
        'verified' => 'VERIFIED',
        'users.verified' => 'VERIFIED',
        'UsersTableMap::COL_VERIFIED' => 'VERIFIED',
        'COL_VERIFIED' => 'VERIFIED',
        'Resettable' => 'RESETTABLE',
        'Users.Resettable' => 'RESETTABLE',
        'resettable' => 'RESETTABLE',
        'users.resettable' => 'RESETTABLE',
        'UsersTableMap::COL_RESETTABLE' => 'RESETTABLE',
        'COL_RESETTABLE' => 'RESETTABLE',
        'RolesMask' => 'ROLES_MASK',
        'Users.RolesMask' => 'ROLES_MASK',
        'rolesMask' => 'ROLES_MASK',
        'users.rolesMask' => 'ROLES_MASK',
        'UsersTableMap::COL_ROLES_MASK' => 'ROLES_MASK',
        'COL_ROLES_MASK' => 'ROLES_MASK',
        'roles_mask' => 'ROLES_MASK',
        'users.roles_mask' => 'ROLES_MASK',
        'Registered' => 'REGISTERED',
        'Users.Registered' => 'REGISTERED',
        'registered' => 'REGISTERED',
        'users.registered' => 'REGISTERED',
        'UsersTableMap::COL_REGISTERED' => 'REGISTERED',
        'COL_REGISTERED' => 'REGISTERED',
        'LastLogin' => 'LAST_LOGIN',
        'Users.LastLogin' => 'LAST_LOGIN',
        'lastLogin' => 'LAST_LOGIN',
        'users.lastLogin' => 'LAST_LOGIN',
        'UsersTableMap::COL_LAST_LOGIN' => 'LAST_LOGIN',
        'COL_LAST_LOGIN' => 'LAST_LOGIN',
        'last_login' => 'LAST_LOGIN',
        'users.last_login' => 'LAST_LOGIN',
        'ForceLogout' => 'FORCE_LOGOUT',
        'Users.ForceLogout' => 'FORCE_LOGOUT',
        'forceLogout' => 'FORCE_LOGOUT',
        'users.forceLogout' => 'FORCE_LOGOUT',
        'UsersTableMap::COL_FORCE_LOGOUT' => 'FORCE_LOGOUT',
        'COL_FORCE_LOGOUT' => 'FORCE_LOGOUT',
        'force_logout' => 'FORCE_LOGOUT',
        'users.force_logout' => 'FORCE_LOGOUT',
        'IsAvailable' => 'IS_AVAILABLE',
        'Users.IsAvailable' => 'IS_AVAILABLE',
        'isAvailable' => 'IS_AVAILABLE',
        'users.isAvailable' => 'IS_AVAILABLE',
        'UsersTableMap::COL_IS_AVAILABLE' => 'IS_AVAILABLE',
        'COL_IS_AVAILABLE' => 'IS_AVAILABLE',
        'is_available' => 'IS_AVAILABLE',
        'users.is_available' => 'IS_AVAILABLE',
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
        $this->setName('users');
        $this->setPhpName('Users');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\DB\\Users');
        $this->setPackage('DB');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('email', 'Email', 'VARCHAR', true, 249, null);
        $this->addColumn('phone', 'Phone', 'VARCHAR', false, 11, null);
        $this->addColumn('password', 'Password', 'VARCHAR', true, 255, null);
        $this->addColumn('username', 'Username', 'VARCHAR', false, 100, null);
        $this->addColumn('status', 'Status', 'TINYINT', true, null, 0);
        $this->addForeignKey('role_id', 'RoleId', 'INTEGER', 'user_role', 'id', false, null, null);
        $this->addColumn('verified', 'Verified', 'TINYINT', true, null, 0);
        $this->addColumn('resettable', 'Resettable', 'TINYINT', true, null, 1);
        $this->addColumn('roles_mask', 'RolesMask', 'INTEGER', true, null, 0);
        $this->addColumn('registered', 'Registered', 'INTEGER', true, null, null);
        $this->addColumn('last_login', 'LastLogin', 'INTEGER', false, null, null);
        $this->addColumn('force_logout', 'ForceLogout', 'SMALLINT', true, null, 0);
        $this->addColumn('is_available', 'IsAvailable', 'BOOLEAN', true, 1, true);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('UserRole', '\\DB\\UserRole', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':role_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('ProjectRole', '\\DB\\ProjectRole', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':user_id',
    1 => ':id',
  ),
), null, null, 'ProjectRoles', false);
        $this->addRelation('ObjProject', '\\DB\\ObjProject', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':version_created_by',
    1 => ':id',
  ),
), null, null, 'ObjProjects', false);
        $this->addRelation('ObjSubproject', '\\DB\\ObjSubproject', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':version_created_by',
    1 => ':id',
  ),
), null, null, 'ObjSubprojects', false);
        $this->addRelation('ObjGroup', '\\DB\\ObjGroup', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':version_created_by',
    1 => ':id',
  ),
), null, null, 'ObjGroups', false);
        $this->addRelation('ObjHouse', '\\DB\\ObjHouse', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':version_created_by',
    1 => ':id',
  ),
), null, null, 'ObjHouses', false);
        $this->addRelation('ObjStage', '\\DB\\ObjStage', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':version_created_by',
    1 => ':id',
  ),
), null, null, 'ObjStages', false);
        $this->addRelation('ObjStageWork', '\\DB\\ObjStageWork', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':version_created_by',
    1 => ':id',
  ),
), null, null, 'ObjStageWorks', false);
        $this->addRelation('ObjStageMaterial', '\\DB\\ObjStageMaterial', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':version_created_by',
    1 => ':id',
  ),
), null, null, 'ObjStageMaterials', false);
        $this->addRelation('ObjStageTechnic', '\\DB\\ObjStageTechnic', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':version_created_by',
    1 => ':id',
  ),
), null, null, 'ObjStageTechnics', false);
        $this->addRelation('VolMaterial', '\\DB\\VolMaterial', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':version_created_by',
    1 => ':id',
  ),
), null, null, 'VolMaterials', false);
        $this->addRelation('VolTechnic', '\\DB\\VolTechnic', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':version_created_by',
    1 => ':id',
  ),
), null, null, 'VolTechnics', false);
        $this->addRelation('VolWork', '\\DB\\VolWork', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':version_created_by',
    1 => ':id',
  ),
), null, null, 'VolWorks', false);
        $this->addRelation('VolWorkMaterial', '\\DB\\VolWorkMaterial', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':version_created_by',
    1 => ':id',
  ),
), null, null, 'VolWorkMaterials', false);
        $this->addRelation('VolWorkTechnic', '\\DB\\VolWorkTechnic', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':version_created_by',
    1 => ':id',
  ),
), null, null, 'VolWorkTechnics', false);
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
        return $withPrefix ? UsersTableMap::CLASS_DEFAULT : UsersTableMap::OM_CLASS;
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
     * @return array (Users object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = UsersTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = UsersTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + UsersTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = UsersTableMap::OM_CLASS;
            /** @var Users $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            UsersTableMap::addInstanceToPool($obj, $key);
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
            $key = UsersTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = UsersTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Users $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                UsersTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(UsersTableMap::COL_ID);
            $criteria->addSelectColumn(UsersTableMap::COL_EMAIL);
            $criteria->addSelectColumn(UsersTableMap::COL_PHONE);
            $criteria->addSelectColumn(UsersTableMap::COL_PASSWORD);
            $criteria->addSelectColumn(UsersTableMap::COL_USERNAME);
            $criteria->addSelectColumn(UsersTableMap::COL_STATUS);
            $criteria->addSelectColumn(UsersTableMap::COL_ROLE_ID);
            $criteria->addSelectColumn(UsersTableMap::COL_VERIFIED);
            $criteria->addSelectColumn(UsersTableMap::COL_RESETTABLE);
            $criteria->addSelectColumn(UsersTableMap::COL_ROLES_MASK);
            $criteria->addSelectColumn(UsersTableMap::COL_REGISTERED);
            $criteria->addSelectColumn(UsersTableMap::COL_LAST_LOGIN);
            $criteria->addSelectColumn(UsersTableMap::COL_FORCE_LOGOUT);
            $criteria->addSelectColumn(UsersTableMap::COL_IS_AVAILABLE);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.email');
            $criteria->addSelectColumn($alias . '.phone');
            $criteria->addSelectColumn($alias . '.password');
            $criteria->addSelectColumn($alias . '.username');
            $criteria->addSelectColumn($alias . '.status');
            $criteria->addSelectColumn($alias . '.role_id');
            $criteria->addSelectColumn($alias . '.verified');
            $criteria->addSelectColumn($alias . '.resettable');
            $criteria->addSelectColumn($alias . '.roles_mask');
            $criteria->addSelectColumn($alias . '.registered');
            $criteria->addSelectColumn($alias . '.last_login');
            $criteria->addSelectColumn($alias . '.force_logout');
            $criteria->addSelectColumn($alias . '.is_available');
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
            $criteria->removeSelectColumn(UsersTableMap::COL_ID);
            $criteria->removeSelectColumn(UsersTableMap::COL_EMAIL);
            $criteria->removeSelectColumn(UsersTableMap::COL_PHONE);
            $criteria->removeSelectColumn(UsersTableMap::COL_PASSWORD);
            $criteria->removeSelectColumn(UsersTableMap::COL_USERNAME);
            $criteria->removeSelectColumn(UsersTableMap::COL_STATUS);
            $criteria->removeSelectColumn(UsersTableMap::COL_ROLE_ID);
            $criteria->removeSelectColumn(UsersTableMap::COL_VERIFIED);
            $criteria->removeSelectColumn(UsersTableMap::COL_RESETTABLE);
            $criteria->removeSelectColumn(UsersTableMap::COL_ROLES_MASK);
            $criteria->removeSelectColumn(UsersTableMap::COL_REGISTERED);
            $criteria->removeSelectColumn(UsersTableMap::COL_LAST_LOGIN);
            $criteria->removeSelectColumn(UsersTableMap::COL_FORCE_LOGOUT);
            $criteria->removeSelectColumn(UsersTableMap::COL_IS_AVAILABLE);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.email');
            $criteria->removeSelectColumn($alias . '.phone');
            $criteria->removeSelectColumn($alias . '.password');
            $criteria->removeSelectColumn($alias . '.username');
            $criteria->removeSelectColumn($alias . '.status');
            $criteria->removeSelectColumn($alias . '.role_id');
            $criteria->removeSelectColumn($alias . '.verified');
            $criteria->removeSelectColumn($alias . '.resettable');
            $criteria->removeSelectColumn($alias . '.roles_mask');
            $criteria->removeSelectColumn($alias . '.registered');
            $criteria->removeSelectColumn($alias . '.last_login');
            $criteria->removeSelectColumn($alias . '.force_logout');
            $criteria->removeSelectColumn($alias . '.is_available');
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
        return Propel::getServiceContainer()->getDatabaseMap(UsersTableMap::DATABASE_NAME)->getTable(UsersTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Users or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Users object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(UsersTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \DB\Users) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(UsersTableMap::DATABASE_NAME);
            $criteria->add(UsersTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = UsersQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            UsersTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                UsersTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the users table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return UsersQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Users or Criteria object.
     *
     * @param mixed $criteria Criteria or Users object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsersTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Users object
        }

        if ($criteria->containsKey(UsersTableMap::COL_ID) && $criteria->keyContainsValue(UsersTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.UsersTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = UsersQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
