<?php

namespace DB\Map;

use DB\StaticFile;
use DB\StaticFileQuery;
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
 * This class defines the structure of the 'static_file' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class StaticFileTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'DB.Map.StaticFileTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'static_file';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'StaticFile';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\DB\\StaticFile';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'DB.StaticFile';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 6;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 6;

    /**
     * the column name for the id field
     */
    public const COL_ID = 'static_file.id';

    /**
     * the column name for the file_name field
     */
    public const COL_FILE_NAME = 'static_file.file_name';

    /**
     * the column name for the content_type field
     */
    public const COL_CONTENT_TYPE = 'static_file.content_type';

    /**
     * the column name for the file field
     */
    public const COL_FILE = 'static_file.file';

    /**
     * the column name for the headers field
     */
    public const COL_HEADERS = 'static_file.headers';

    /**
     * the column name for the url field
     */
    public const COL_URL = 'static_file.url';

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
        self::TYPE_PHPNAME       => ['Id', 'FileName', 'ContentType', 'File', 'Headers', 'Url', ],
        self::TYPE_CAMELNAME     => ['id', 'fileName', 'contentType', 'file', 'headers', 'url', ],
        self::TYPE_COLNAME       => [StaticFileTableMap::COL_ID, StaticFileTableMap::COL_FILE_NAME, StaticFileTableMap::COL_CONTENT_TYPE, StaticFileTableMap::COL_FILE, StaticFileTableMap::COL_HEADERS, StaticFileTableMap::COL_URL, ],
        self::TYPE_FIELDNAME     => ['id', 'file_name', 'content_type', 'file', 'headers', 'url', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, ]
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
        self::TYPE_PHPNAME       => ['Id' => 0, 'FileName' => 1, 'ContentType' => 2, 'File' => 3, 'Headers' => 4, 'Url' => 5, ],
        self::TYPE_CAMELNAME     => ['id' => 0, 'fileName' => 1, 'contentType' => 2, 'file' => 3, 'headers' => 4, 'url' => 5, ],
        self::TYPE_COLNAME       => [StaticFileTableMap::COL_ID => 0, StaticFileTableMap::COL_FILE_NAME => 1, StaticFileTableMap::COL_CONTENT_TYPE => 2, StaticFileTableMap::COL_FILE => 3, StaticFileTableMap::COL_HEADERS => 4, StaticFileTableMap::COL_URL => 5, ],
        self::TYPE_FIELDNAME     => ['id' => 0, 'file_name' => 1, 'content_type' => 2, 'file' => 3, 'headers' => 4, 'url' => 5, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'StaticFile.Id' => 'ID',
        'id' => 'ID',
        'staticFile.id' => 'ID',
        'StaticFileTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'static_file.id' => 'ID',
        'FileName' => 'FILE_NAME',
        'StaticFile.FileName' => 'FILE_NAME',
        'fileName' => 'FILE_NAME',
        'staticFile.fileName' => 'FILE_NAME',
        'StaticFileTableMap::COL_FILE_NAME' => 'FILE_NAME',
        'COL_FILE_NAME' => 'FILE_NAME',
        'file_name' => 'FILE_NAME',
        'static_file.file_name' => 'FILE_NAME',
        'ContentType' => 'CONTENT_TYPE',
        'StaticFile.ContentType' => 'CONTENT_TYPE',
        'contentType' => 'CONTENT_TYPE',
        'staticFile.contentType' => 'CONTENT_TYPE',
        'StaticFileTableMap::COL_CONTENT_TYPE' => 'CONTENT_TYPE',
        'COL_CONTENT_TYPE' => 'CONTENT_TYPE',
        'content_type' => 'CONTENT_TYPE',
        'static_file.content_type' => 'CONTENT_TYPE',
        'File' => 'FILE',
        'StaticFile.File' => 'FILE',
        'file' => 'FILE',
        'staticFile.file' => 'FILE',
        'StaticFileTableMap::COL_FILE' => 'FILE',
        'COL_FILE' => 'FILE',
        'static_file.file' => 'FILE',
        'Headers' => 'HEADERS',
        'StaticFile.Headers' => 'HEADERS',
        'headers' => 'HEADERS',
        'staticFile.headers' => 'HEADERS',
        'StaticFileTableMap::COL_HEADERS' => 'HEADERS',
        'COL_HEADERS' => 'HEADERS',
        'static_file.headers' => 'HEADERS',
        'Url' => 'URL',
        'StaticFile.Url' => 'URL',
        'url' => 'URL',
        'staticFile.url' => 'URL',
        'StaticFileTableMap::COL_URL' => 'URL',
        'COL_URL' => 'URL',
        'static_file.url' => 'URL',
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
        $this->setName('static_file');
        $this->setPhpName('StaticFile');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\DB\\StaticFile');
        $this->setPackage('DB');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('file_name', 'FileName', 'VARCHAR', true, 255, null);
        $this->addColumn('content_type', 'ContentType', 'VARCHAR', true, 255, null);
        $this->addColumn('file', 'File', 'LONGVARBINARY', true, null, null);
        $this->addColumn('headers', 'Headers', 'JSON', false, null, null);
        $this->addColumn('url', 'Url', 'VARCHAR', false, 255, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
    }

    /**
     *
     * Gets the list of behaviors registered for this table
     *
     * @return array<string, array> Associative array (name => parameters) of behaviors
     */
    public function getBehaviors(): array
    {
        return [
            'sluggable' => ['slug_column' => 'url', 'slug_pattern' => '{FileName}', 'replace_pattern' => '/[^\\w\\/]+/u', 'replacement' => '-', 'separator' => '-', 'permanent' => 'true', 'scope_column' => '', 'unique_constraint' => 'true'],
        ];
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
        return $withPrefix ? StaticFileTableMap::CLASS_DEFAULT : StaticFileTableMap::OM_CLASS;
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
     * @return array (StaticFile object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = StaticFileTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = StaticFileTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + StaticFileTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = StaticFileTableMap::OM_CLASS;
            /** @var StaticFile $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            StaticFileTableMap::addInstanceToPool($obj, $key);
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
            $key = StaticFileTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = StaticFileTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var StaticFile $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                StaticFileTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(StaticFileTableMap::COL_ID);
            $criteria->addSelectColumn(StaticFileTableMap::COL_FILE_NAME);
            $criteria->addSelectColumn(StaticFileTableMap::COL_CONTENT_TYPE);
            $criteria->addSelectColumn(StaticFileTableMap::COL_FILE);
            $criteria->addSelectColumn(StaticFileTableMap::COL_HEADERS);
            $criteria->addSelectColumn(StaticFileTableMap::COL_URL);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.file_name');
            $criteria->addSelectColumn($alias . '.content_type');
            $criteria->addSelectColumn($alias . '.file');
            $criteria->addSelectColumn($alias . '.headers');
            $criteria->addSelectColumn($alias . '.url');
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
            $criteria->removeSelectColumn(StaticFileTableMap::COL_ID);
            $criteria->removeSelectColumn(StaticFileTableMap::COL_FILE_NAME);
            $criteria->removeSelectColumn(StaticFileTableMap::COL_CONTENT_TYPE);
            $criteria->removeSelectColumn(StaticFileTableMap::COL_FILE);
            $criteria->removeSelectColumn(StaticFileTableMap::COL_HEADERS);
            $criteria->removeSelectColumn(StaticFileTableMap::COL_URL);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.file_name');
            $criteria->removeSelectColumn($alias . '.content_type');
            $criteria->removeSelectColumn($alias . '.file');
            $criteria->removeSelectColumn($alias . '.headers');
            $criteria->removeSelectColumn($alias . '.url');
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
        return Propel::getServiceContainer()->getDatabaseMap(StaticFileTableMap::DATABASE_NAME)->getTable(StaticFileTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a StaticFile or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or StaticFile object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(StaticFileTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \DB\StaticFile) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(StaticFileTableMap::DATABASE_NAME);
            $criteria->add(StaticFileTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = StaticFileQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            StaticFileTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                StaticFileTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the static_file table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return StaticFileQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a StaticFile or Criteria object.
     *
     * @param mixed $criteria Criteria or StaticFile object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(StaticFileTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from StaticFile object
        }

        if ($criteria->containsKey(StaticFileTableMap::COL_ID) && $criteria->keyContainsValue(StaticFileTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.StaticFileTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = StaticFileQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
