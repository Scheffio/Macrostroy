<?php

namespace DB\Map;

use DB\UsersThrottlingVersion;
use DB\UsersThrottlingVersionQuery;
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
 * This class defines the structure of the 'users_throttling_version' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class UsersThrottlingVersionTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'DB.Map.UsersThrottlingVersionTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'users_throttling_version';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\DB\\UsersThrottlingVersion';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'DB.UsersThrottlingVersion';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 5;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 5;

    /**
     * the column name for the bucket field
     */
    public const COL_BUCKET = 'users_throttling_version.bucket';

    /**
     * the column name for the tokens field
     */
    public const COL_TOKENS = 'users_throttling_version.tokens';

    /**
     * the column name for the replenished_at field
     */
    public const COL_REPLENISHED_AT = 'users_throttling_version.replenished_at';

    /**
     * the column name for the expires_at field
     */
    public const COL_EXPIRES_AT = 'users_throttling_version.expires_at';

    /**
     * the column name for the version field
     */
    public const COL_VERSION = 'users_throttling_version.version';

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
        self::TYPE_PHPNAME       => ['Bucket', 'Tokens', 'ReplenishedAt', 'ExpiresAt', 'Version', ],
        self::TYPE_CAMELNAME     => ['bucket', 'tokens', 'replenishedAt', 'expiresAt', 'version', ],
        self::TYPE_COLNAME       => [UsersThrottlingVersionTableMap::COL_BUCKET, UsersThrottlingVersionTableMap::COL_TOKENS, UsersThrottlingVersionTableMap::COL_REPLENISHED_AT, UsersThrottlingVersionTableMap::COL_EXPIRES_AT, UsersThrottlingVersionTableMap::COL_VERSION, ],
        self::TYPE_FIELDNAME     => ['bucket', 'tokens', 'replenished_at', 'expires_at', 'version', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, ]
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
        self::TYPE_PHPNAME       => ['Bucket' => 0, 'Tokens' => 1, 'ReplenishedAt' => 2, 'ExpiresAt' => 3, 'Version' => 4, ],
        self::TYPE_CAMELNAME     => ['bucket' => 0, 'tokens' => 1, 'replenishedAt' => 2, 'expiresAt' => 3, 'version' => 4, ],
        self::TYPE_COLNAME       => [UsersThrottlingVersionTableMap::COL_BUCKET => 0, UsersThrottlingVersionTableMap::COL_TOKENS => 1, UsersThrottlingVersionTableMap::COL_REPLENISHED_AT => 2, UsersThrottlingVersionTableMap::COL_EXPIRES_AT => 3, UsersThrottlingVersionTableMap::COL_VERSION => 4, ],
        self::TYPE_FIELDNAME     => ['bucket' => 0, 'tokens' => 1, 'replenished_at' => 2, 'expires_at' => 3, 'version' => 4, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Bucket' => 'BUCKET',
        'UsersThrottlingVersion.Bucket' => 'BUCKET',
        'bucket' => 'BUCKET',
        'usersThrottlingVersion.bucket' => 'BUCKET',
        'UsersThrottlingVersionTableMap::COL_BUCKET' => 'BUCKET',
        'COL_BUCKET' => 'BUCKET',
        'users_throttling_version.bucket' => 'BUCKET',
        'Tokens' => 'TOKENS',
        'UsersThrottlingVersion.Tokens' => 'TOKENS',
        'tokens' => 'TOKENS',
        'usersThrottlingVersion.tokens' => 'TOKENS',
        'UsersThrottlingVersionTableMap::COL_TOKENS' => 'TOKENS',
        'COL_TOKENS' => 'TOKENS',
        'users_throttling_version.tokens' => 'TOKENS',
        'ReplenishedAt' => 'REPLENISHED_AT',
        'UsersThrottlingVersion.ReplenishedAt' => 'REPLENISHED_AT',
        'replenishedAt' => 'REPLENISHED_AT',
        'usersThrottlingVersion.replenishedAt' => 'REPLENISHED_AT',
        'UsersThrottlingVersionTableMap::COL_REPLENISHED_AT' => 'REPLENISHED_AT',
        'COL_REPLENISHED_AT' => 'REPLENISHED_AT',
        'replenished_at' => 'REPLENISHED_AT',
        'users_throttling_version.replenished_at' => 'REPLENISHED_AT',
        'ExpiresAt' => 'EXPIRES_AT',
        'UsersThrottlingVersion.ExpiresAt' => 'EXPIRES_AT',
        'expiresAt' => 'EXPIRES_AT',
        'usersThrottlingVersion.expiresAt' => 'EXPIRES_AT',
        'UsersThrottlingVersionTableMap::COL_EXPIRES_AT' => 'EXPIRES_AT',
        'COL_EXPIRES_AT' => 'EXPIRES_AT',
        'expires_at' => 'EXPIRES_AT',
        'users_throttling_version.expires_at' => 'EXPIRES_AT',
        'Version' => 'VERSION',
        'UsersThrottlingVersion.Version' => 'VERSION',
        'version' => 'VERSION',
        'usersThrottlingVersion.version' => 'VERSION',
        'UsersThrottlingVersionTableMap::COL_VERSION' => 'VERSION',
        'COL_VERSION' => 'VERSION',
        'users_throttling_version.version' => 'VERSION',
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
        $this->setName('users_throttling_version');
        $this->setPhpName('UsersThrottlingVersion');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\DB\\UsersThrottlingVersion');
        $this->setPackage('DB');
        $this->setUseIdGenerator(false);
        // columns
        $this->addForeignPrimaryKey('bucket', 'Bucket', 'VARCHAR' , 'users_throttling', 'bucket', true, 44, null);
        $this->addColumn('tokens', 'Tokens', 'FLOAT', true, null, null);
        $this->addColumn('replenished_at', 'ReplenishedAt', 'INTEGER', true, null, null);
        $this->addColumn('expires_at', 'ExpiresAt', 'INTEGER', true, null, null);
        $this->addPrimaryKey('version', 'Version', 'INTEGER', true, null, 0);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('UsersThrottling', '\\DB\\UsersThrottling', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':bucket',
    1 => ':bucket',
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
     * @param \DB\UsersThrottlingVersion $obj A \DB\UsersThrottlingVersion object.
     * @param string|null $key Key (optional) to use for instance map (for performance boost if key was already calculated externally).
     *
     * @return void
     */
    public static function addInstanceToPool(UsersThrottlingVersion $obj, ?string $key = null): void
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (null === $key) {
                $key = serialize([(null === $obj->getBucket() || is_scalar($obj->getBucket()) || is_callable([$obj->getBucket(), '__toString']) ? (string) $obj->getBucket() : $obj->getBucket()), (null === $obj->getVersion() || is_scalar($obj->getVersion()) || is_callable([$obj->getVersion(), '__toString']) ? (string) $obj->getVersion() : $obj->getVersion())]);
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
     * @param mixed $value A \DB\UsersThrottlingVersion object or a primary key value.
     *
     * @return void
     */
    public static function removeInstanceFromPool($value): void
    {
        if (Propel::isInstancePoolingEnabled() && null !== $value) {
            if (is_object($value) && $value instanceof \DB\UsersThrottlingVersion) {
                $key = serialize([(null === $value->getBucket() || is_scalar($value->getBucket()) || is_callable([$value->getBucket(), '__toString']) ? (string) $value->getBucket() : $value->getBucket()), (null === $value->getVersion() || is_scalar($value->getVersion()) || is_callable([$value->getVersion(), '__toString']) ? (string) $value->getVersion() : $value->getVersion())]);

            } elseif (is_array($value) && count($value) === 2) {
                // assume we've been passed a primary key";
                $key = serialize([(null === $value[0] || is_scalar($value[0]) || is_callable([$value[0], '__toString']) ? (string) $value[0] : $value[0]), (null === $value[1] || is_scalar($value[1]) || is_callable([$value[1], '__toString']) ? (string) $value[1] : $value[1])]);
            } elseif ($value instanceof Criteria) {
                self::$instances = [];

                return;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or \DB\UsersThrottlingVersion object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value, true)));
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Bucket', TableMap::TYPE_PHPNAME, $indexType)] === null && $row[TableMap::TYPE_NUM == $indexType ? 4 + $offset : static::translateFieldName('Version', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return serialize([(null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Bucket', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Bucket', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Bucket', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Bucket', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Bucket', TableMap::TYPE_PHPNAME, $indexType)]), (null === $row[TableMap::TYPE_NUM == $indexType ? 4 + $offset : static::translateFieldName('Version', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 4 + $offset : static::translateFieldName('Version', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 4 + $offset : static::translateFieldName('Version', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 4 + $offset : static::translateFieldName('Version', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 4 + $offset : static::translateFieldName('Version', TableMap::TYPE_PHPNAME, $indexType)])]);
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

        $pks[] = (string) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Bucket', TableMap::TYPE_PHPNAME, $indexType)
        ];
        $pks[] = (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 4 + $offset
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
        return $withPrefix ? UsersThrottlingVersionTableMap::CLASS_DEFAULT : UsersThrottlingVersionTableMap::OM_CLASS;
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
     * @return array (UsersThrottlingVersion object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = UsersThrottlingVersionTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = UsersThrottlingVersionTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + UsersThrottlingVersionTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = UsersThrottlingVersionTableMap::OM_CLASS;
            /** @var UsersThrottlingVersion $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            UsersThrottlingVersionTableMap::addInstanceToPool($obj, $key);
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
            $key = UsersThrottlingVersionTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = UsersThrottlingVersionTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var UsersThrottlingVersion $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                UsersThrottlingVersionTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(UsersThrottlingVersionTableMap::COL_BUCKET);
            $criteria->addSelectColumn(UsersThrottlingVersionTableMap::COL_TOKENS);
            $criteria->addSelectColumn(UsersThrottlingVersionTableMap::COL_REPLENISHED_AT);
            $criteria->addSelectColumn(UsersThrottlingVersionTableMap::COL_EXPIRES_AT);
            $criteria->addSelectColumn(UsersThrottlingVersionTableMap::COL_VERSION);
        } else {
            $criteria->addSelectColumn($alias . '.bucket');
            $criteria->addSelectColumn($alias . '.tokens');
            $criteria->addSelectColumn($alias . '.replenished_at');
            $criteria->addSelectColumn($alias . '.expires_at');
            $criteria->addSelectColumn($alias . '.version');
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
            $criteria->removeSelectColumn(UsersThrottlingVersionTableMap::COL_BUCKET);
            $criteria->removeSelectColumn(UsersThrottlingVersionTableMap::COL_TOKENS);
            $criteria->removeSelectColumn(UsersThrottlingVersionTableMap::COL_REPLENISHED_AT);
            $criteria->removeSelectColumn(UsersThrottlingVersionTableMap::COL_EXPIRES_AT);
            $criteria->removeSelectColumn(UsersThrottlingVersionTableMap::COL_VERSION);
        } else {
            $criteria->removeSelectColumn($alias . '.bucket');
            $criteria->removeSelectColumn($alias . '.tokens');
            $criteria->removeSelectColumn($alias . '.replenished_at');
            $criteria->removeSelectColumn($alias . '.expires_at');
            $criteria->removeSelectColumn($alias . '.version');
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
        return Propel::getServiceContainer()->getDatabaseMap(UsersThrottlingVersionTableMap::DATABASE_NAME)->getTable(UsersThrottlingVersionTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a UsersThrottlingVersion or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or UsersThrottlingVersion object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(UsersThrottlingVersionTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \DB\UsersThrottlingVersion) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(UsersThrottlingVersionTableMap::DATABASE_NAME);
            // primary key is composite; we therefore, expect
            // the primary key passed to be an array of pkey values
            if (count($values) == count($values, COUNT_RECURSIVE)) {
                // array is not multi-dimensional
                $values = [$values];
            }
            foreach ($values as $value) {
                $criterion = $criteria->getNewCriterion(UsersThrottlingVersionTableMap::COL_BUCKET, $value[0]);
                $criterion->addAnd($criteria->getNewCriterion(UsersThrottlingVersionTableMap::COL_VERSION, $value[1]));
                $criteria->addOr($criterion);
            }
        }

        $query = UsersThrottlingVersionQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            UsersThrottlingVersionTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                UsersThrottlingVersionTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the users_throttling_version table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return UsersThrottlingVersionQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a UsersThrottlingVersion or Criteria object.
     *
     * @param mixed $criteria Criteria or UsersThrottlingVersion object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsersThrottlingVersionTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from UsersThrottlingVersion object
        }


        // Set the correct dbName
        $query = UsersThrottlingVersionQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
