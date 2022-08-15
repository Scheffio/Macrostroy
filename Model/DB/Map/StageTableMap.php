<?php

namespace DB\Map;

use DB\Stage;
use DB\StageQuery;
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
 * This class defines the structure of the 'stage' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class StageTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'DB.Map.StageTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'stage';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\DB\\Stage';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'DB.Stage';

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
     * the column name for the id field
     */
    public const COL_ID = 'stage.id';

    /**
     * the column name for the name field
     */
    public const COL_NAME = 'stage.name';

    /**
     * the column name for the status field
     */
    public const COL_STATUS = 'stage.status';

    /**
     * the column name for the is_available field
     */
    public const COL_IS_AVAILABLE = 'stage.is_available';

    /**
     * the column name for the house_id field
     */
    public const COL_HOUSE_ID = 'stage.house_id';

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
        self::TYPE_PHPNAME       => ['Id', 'Name', 'Status', 'IsAvailable', 'HouseId', ],
        self::TYPE_CAMELNAME     => ['id', 'name', 'status', 'isAvailable', 'houseId', ],
        self::TYPE_COLNAME       => [StageTableMap::COL_ID, StageTableMap::COL_NAME, StageTableMap::COL_STATUS, StageTableMap::COL_IS_AVAILABLE, StageTableMap::COL_HOUSE_ID, ],
        self::TYPE_FIELDNAME     => ['id', 'name', 'status', 'is_available', 'house_id', ],
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
        self::TYPE_PHPNAME       => ['Id' => 0, 'Name' => 1, 'Status' => 2, 'IsAvailable' => 3, 'HouseId' => 4, ],
        self::TYPE_CAMELNAME     => ['id' => 0, 'name' => 1, 'status' => 2, 'isAvailable' => 3, 'houseId' => 4, ],
        self::TYPE_COLNAME       => [StageTableMap::COL_ID => 0, StageTableMap::COL_NAME => 1, StageTableMap::COL_STATUS => 2, StageTableMap::COL_IS_AVAILABLE => 3, StageTableMap::COL_HOUSE_ID => 4, ],
        self::TYPE_FIELDNAME     => ['id' => 0, 'name' => 1, 'status' => 2, 'is_available' => 3, 'house_id' => 4, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'Stage.Id' => 'ID',
        'id' => 'ID',
        'stage.id' => 'ID',
        'StageTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'Name' => 'NAME',
        'Stage.Name' => 'NAME',
        'name' => 'NAME',
        'stage.name' => 'NAME',
        'StageTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'Status' => 'STATUS',
        'Stage.Status' => 'STATUS',
        'status' => 'STATUS',
        'stage.status' => 'STATUS',
        'StageTableMap::COL_STATUS' => 'STATUS',
        'COL_STATUS' => 'STATUS',
        'IsAvailable' => 'IS_AVAILABLE',
        'Stage.IsAvailable' => 'IS_AVAILABLE',
        'isAvailable' => 'IS_AVAILABLE',
        'stage.isAvailable' => 'IS_AVAILABLE',
        'StageTableMap::COL_IS_AVAILABLE' => 'IS_AVAILABLE',
        'COL_IS_AVAILABLE' => 'IS_AVAILABLE',
        'is_available' => 'IS_AVAILABLE',
        'stage.is_available' => 'IS_AVAILABLE',
        'HouseId' => 'HOUSE_ID',
        'Stage.HouseId' => 'HOUSE_ID',
        'houseId' => 'HOUSE_ID',
        'stage.houseId' => 'HOUSE_ID',
        'StageTableMap::COL_HOUSE_ID' => 'HOUSE_ID',
        'COL_HOUSE_ID' => 'HOUSE_ID',
        'house_id' => 'HOUSE_ID',
        'stage.house_id' => 'HOUSE_ID',
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
        $this->setName('stage');
        $this->setPhpName('Stage');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\DB\\Stage');
        $this->setPackage('DB');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 255, null);
        $this->addColumn('status', 'Status', 'CHAR', true, null, 'in_process');
        $this->addColumn('is_available', 'IsAvailable', 'BOOLEAN', true, 1, true);
        $this->addForeignKey('house_id', 'HouseId', 'INTEGER', 'house', 'id', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('House', '\\DB\\House', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':house_id',
    1 => ':id',
  ),
), 'CASCADE', null, null, false);
        $this->addRelation('StageMaterial', '\\DB\\StageMaterial', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':stage_id',
    1 => ':id',
  ),
), null, null, 'StageMaterials', false);
        $this->addRelation('StageTechnic', '\\DB\\StageTechnic', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':stage_id',
    1 => ':id',
  ),
), null, null, 'StageTechnics', false);
        $this->addRelation('StageWork', '\\DB\\StageWork', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':stage_id',
    1 => ':id',
  ),
), null, null, 'StageWorks', false);
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
        return $withPrefix ? StageTableMap::CLASS_DEFAULT : StageTableMap::OM_CLASS;
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
     * @return array (Stage object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = StageTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = StageTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + StageTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = StageTableMap::OM_CLASS;
            /** @var Stage $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            StageTableMap::addInstanceToPool($obj, $key);
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
            $key = StageTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = StageTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Stage $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                StageTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(StageTableMap::COL_ID);
            $criteria->addSelectColumn(StageTableMap::COL_NAME);
            $criteria->addSelectColumn(StageTableMap::COL_STATUS);
            $criteria->addSelectColumn(StageTableMap::COL_IS_AVAILABLE);
            $criteria->addSelectColumn(StageTableMap::COL_HOUSE_ID);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.status');
            $criteria->addSelectColumn($alias . '.is_available');
            $criteria->addSelectColumn($alias . '.house_id');
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
            $criteria->removeSelectColumn(StageTableMap::COL_ID);
            $criteria->removeSelectColumn(StageTableMap::COL_NAME);
            $criteria->removeSelectColumn(StageTableMap::COL_STATUS);
            $criteria->removeSelectColumn(StageTableMap::COL_IS_AVAILABLE);
            $criteria->removeSelectColumn(StageTableMap::COL_HOUSE_ID);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.name');
            $criteria->removeSelectColumn($alias . '.status');
            $criteria->removeSelectColumn($alias . '.is_available');
            $criteria->removeSelectColumn($alias . '.house_id');
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
        return Propel::getServiceContainer()->getDatabaseMap(StageTableMap::DATABASE_NAME)->getTable(StageTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Stage or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Stage object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(StageTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \DB\Stage) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(StageTableMap::DATABASE_NAME);
            $criteria->add(StageTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = StageQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            StageTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                StageTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the stage table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return StageQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Stage or Criteria object.
     *
     * @param mixed $criteria Criteria or Stage object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(StageTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Stage object
        }


        // Set the correct dbName
        $query = StageQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
