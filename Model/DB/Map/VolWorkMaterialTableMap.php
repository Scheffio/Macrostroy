<?php

namespace DB\Map;

use DB\VolWorkMaterial;
use DB\VolWorkMaterialQuery;
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
 * This class defines the structure of the 'vol_work_material' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class VolWorkMaterialTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'DB.Map.VolWorkMaterialTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'vol_work_material';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'VolWorkMaterial';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\DB\\VolWorkMaterial';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'DB.VolWorkMaterial';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 4;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 4;

    /**
     * the column name for the id field
     */
    public const COL_ID = 'vol_work_material.id';

    /**
     * the column name for the amount field
     */
    public const COL_AMOUNT = 'vol_work_material.amount';

    /**
     * the column name for the work_id field
     */
    public const COL_WORK_ID = 'vol_work_material.work_id';

    /**
     * the column name for the material_id field
     */
    public const COL_MATERIAL_ID = 'vol_work_material.material_id';

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
        self::TYPE_PHPNAME       => ['Id', 'Amount', 'WorkId', 'MaterialId', ],
        self::TYPE_CAMELNAME     => ['id', 'amount', 'workId', 'materialId', ],
        self::TYPE_COLNAME       => [VolWorkMaterialTableMap::COL_ID, VolWorkMaterialTableMap::COL_AMOUNT, VolWorkMaterialTableMap::COL_WORK_ID, VolWorkMaterialTableMap::COL_MATERIAL_ID, ],
        self::TYPE_FIELDNAME     => ['id', 'amount', 'work_id', 'material_id', ],
        self::TYPE_NUM           => [0, 1, 2, 3, ]
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
        self::TYPE_PHPNAME       => ['Id' => 0, 'Amount' => 1, 'WorkId' => 2, 'MaterialId' => 3, ],
        self::TYPE_CAMELNAME     => ['id' => 0, 'amount' => 1, 'workId' => 2, 'materialId' => 3, ],
        self::TYPE_COLNAME       => [VolWorkMaterialTableMap::COL_ID => 0, VolWorkMaterialTableMap::COL_AMOUNT => 1, VolWorkMaterialTableMap::COL_WORK_ID => 2, VolWorkMaterialTableMap::COL_MATERIAL_ID => 3, ],
        self::TYPE_FIELDNAME     => ['id' => 0, 'amount' => 1, 'work_id' => 2, 'material_id' => 3, ],
        self::TYPE_NUM           => [0, 1, 2, 3, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'VolWorkMaterial.Id' => 'ID',
        'id' => 'ID',
        'volWorkMaterial.id' => 'ID',
        'VolWorkMaterialTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'vol_work_material.id' => 'ID',
        'Amount' => 'AMOUNT',
        'VolWorkMaterial.Amount' => 'AMOUNT',
        'amount' => 'AMOUNT',
        'volWorkMaterial.amount' => 'AMOUNT',
        'VolWorkMaterialTableMap::COL_AMOUNT' => 'AMOUNT',
        'COL_AMOUNT' => 'AMOUNT',
        'vol_work_material.amount' => 'AMOUNT',
        'WorkId' => 'WORK_ID',
        'VolWorkMaterial.WorkId' => 'WORK_ID',
        'workId' => 'WORK_ID',
        'volWorkMaterial.workId' => 'WORK_ID',
        'VolWorkMaterialTableMap::COL_WORK_ID' => 'WORK_ID',
        'COL_WORK_ID' => 'WORK_ID',
        'work_id' => 'WORK_ID',
        'vol_work_material.work_id' => 'WORK_ID',
        'MaterialId' => 'MATERIAL_ID',
        'VolWorkMaterial.MaterialId' => 'MATERIAL_ID',
        'materialId' => 'MATERIAL_ID',
        'volWorkMaterial.materialId' => 'MATERIAL_ID',
        'VolWorkMaterialTableMap::COL_MATERIAL_ID' => 'MATERIAL_ID',
        'COL_MATERIAL_ID' => 'MATERIAL_ID',
        'material_id' => 'MATERIAL_ID',
        'vol_work_material.material_id' => 'MATERIAL_ID',
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
        $this->setName('vol_work_material');
        $this->setPhpName('VolWorkMaterial');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\DB\\VolWorkMaterial');
        $this->setPackage('DB');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('amount', 'Amount', 'DECIMAL', true, 19, null);
        $this->addForeignKey('work_id', 'WorkId', 'INTEGER', 'vol_work', 'id', true, null, null);
        $this->addForeignKey('material_id', 'MaterialId', 'INTEGER', 'vol_material', 'id', true, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('VolWork', '\\DB\\VolWork', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':work_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('VolMaterial', '\\DB\\VolMaterial', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':material_id',
    1 => ':id',
  ),
), null, null, null, false);
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
        return $withPrefix ? VolWorkMaterialTableMap::CLASS_DEFAULT : VolWorkMaterialTableMap::OM_CLASS;
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
     * @return array (VolWorkMaterial object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = VolWorkMaterialTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = VolWorkMaterialTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + VolWorkMaterialTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = VolWorkMaterialTableMap::OM_CLASS;
            /** @var VolWorkMaterial $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            VolWorkMaterialTableMap::addInstanceToPool($obj, $key);
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
            $key = VolWorkMaterialTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = VolWorkMaterialTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var VolWorkMaterial $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                VolWorkMaterialTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(VolWorkMaterialTableMap::COL_ID);
            $criteria->addSelectColumn(VolWorkMaterialTableMap::COL_AMOUNT);
            $criteria->addSelectColumn(VolWorkMaterialTableMap::COL_WORK_ID);
            $criteria->addSelectColumn(VolWorkMaterialTableMap::COL_MATERIAL_ID);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.amount');
            $criteria->addSelectColumn($alias . '.work_id');
            $criteria->addSelectColumn($alias . '.material_id');
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
            $criteria->removeSelectColumn(VolWorkMaterialTableMap::COL_ID);
            $criteria->removeSelectColumn(VolWorkMaterialTableMap::COL_AMOUNT);
            $criteria->removeSelectColumn(VolWorkMaterialTableMap::COL_WORK_ID);
            $criteria->removeSelectColumn(VolWorkMaterialTableMap::COL_MATERIAL_ID);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.amount');
            $criteria->removeSelectColumn($alias . '.work_id');
            $criteria->removeSelectColumn($alias . '.material_id');
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
        return Propel::getServiceContainer()->getDatabaseMap(VolWorkMaterialTableMap::DATABASE_NAME)->getTable(VolWorkMaterialTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a VolWorkMaterial or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or VolWorkMaterial object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(VolWorkMaterialTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \DB\VolWorkMaterial) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(VolWorkMaterialTableMap::DATABASE_NAME);
            $criteria->add(VolWorkMaterialTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = VolWorkMaterialQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            VolWorkMaterialTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                VolWorkMaterialTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the vol_work_material table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return VolWorkMaterialQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a VolWorkMaterial or Criteria object.
     *
     * @param mixed $criteria Criteria or VolWorkMaterial object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(VolWorkMaterialTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from VolWorkMaterial object
        }

        if ($criteria->containsKey(VolWorkMaterialTableMap::COL_ID) && $criteria->keyContainsValue(VolWorkMaterialTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.VolWorkMaterialTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = VolWorkMaterialQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
