<?php

namespace DB\Base;

use \Exception;
use \PDO;
use DB\VolTechnic as ChildVolTechnic;
use DB\VolTechnicQuery as ChildVolTechnicQuery;
use DB\Map\VolTechnicTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'vol_technic' table.
 *
 *
 *
 * @method     ChildVolTechnicQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildVolTechnicQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildVolTechnicQuery orderByPrice($order = Criteria::ASC) Order by the price column
 * @method     ChildVolTechnicQuery orderByIsAvailable($order = Criteria::ASC) Order by the is_available column
 * @method     ChildVolTechnicQuery orderByUnitId($order = Criteria::ASC) Order by the unit_id column
 * @method     ChildVolTechnicQuery orderByVersion($order = Criteria::ASC) Order by the version column
 * @method     ChildVolTechnicQuery orderByVersionCreatedAt($order = Criteria::ASC) Order by the version_created_at column
 * @method     ChildVolTechnicQuery orderByVersionCreatedBy($order = Criteria::ASC) Order by the version_created_by column
 * @method     ChildVolTechnicQuery orderByVersionComment($order = Criteria::ASC) Order by the version_comment column
 *
 * @method     ChildVolTechnicQuery groupById() Group by the id column
 * @method     ChildVolTechnicQuery groupByName() Group by the name column
 * @method     ChildVolTechnicQuery groupByPrice() Group by the price column
 * @method     ChildVolTechnicQuery groupByIsAvailable() Group by the is_available column
 * @method     ChildVolTechnicQuery groupByUnitId() Group by the unit_id column
 * @method     ChildVolTechnicQuery groupByVersion() Group by the version column
 * @method     ChildVolTechnicQuery groupByVersionCreatedAt() Group by the version_created_at column
 * @method     ChildVolTechnicQuery groupByVersionCreatedBy() Group by the version_created_by column
 * @method     ChildVolTechnicQuery groupByVersionComment() Group by the version_comment column
 *
 * @method     ChildVolTechnicQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildVolTechnicQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildVolTechnicQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildVolTechnicQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildVolTechnicQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildVolTechnicQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildVolTechnicQuery leftJoinVolUnit($relationAlias = null) Adds a LEFT JOIN clause to the query using the VolUnit relation
 * @method     ChildVolTechnicQuery rightJoinVolUnit($relationAlias = null) Adds a RIGHT JOIN clause to the query using the VolUnit relation
 * @method     ChildVolTechnicQuery innerJoinVolUnit($relationAlias = null) Adds a INNER JOIN clause to the query using the VolUnit relation
 *
 * @method     ChildVolTechnicQuery joinWithVolUnit($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the VolUnit relation
 *
 * @method     ChildVolTechnicQuery leftJoinWithVolUnit() Adds a LEFT JOIN clause and with to the query using the VolUnit relation
 * @method     ChildVolTechnicQuery rightJoinWithVolUnit() Adds a RIGHT JOIN clause and with to the query using the VolUnit relation
 * @method     ChildVolTechnicQuery innerJoinWithVolUnit() Adds a INNER JOIN clause and with to the query using the VolUnit relation
 *
 * @method     ChildVolTechnicQuery leftJoinObjStageTechnic($relationAlias = null) Adds a LEFT JOIN clause to the query using the ObjStageTechnic relation
 * @method     ChildVolTechnicQuery rightJoinObjStageTechnic($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ObjStageTechnic relation
 * @method     ChildVolTechnicQuery innerJoinObjStageTechnic($relationAlias = null) Adds a INNER JOIN clause to the query using the ObjStageTechnic relation
 *
 * @method     ChildVolTechnicQuery joinWithObjStageTechnic($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ObjStageTechnic relation
 *
 * @method     ChildVolTechnicQuery leftJoinWithObjStageTechnic() Adds a LEFT JOIN clause and with to the query using the ObjStageTechnic relation
 * @method     ChildVolTechnicQuery rightJoinWithObjStageTechnic() Adds a RIGHT JOIN clause and with to the query using the ObjStageTechnic relation
 * @method     ChildVolTechnicQuery innerJoinWithObjStageTechnic() Adds a INNER JOIN clause and with to the query using the ObjStageTechnic relation
 *
 * @method     ChildVolTechnicQuery leftJoinVolWorkTechnic($relationAlias = null) Adds a LEFT JOIN clause to the query using the VolWorkTechnic relation
 * @method     ChildVolTechnicQuery rightJoinVolWorkTechnic($relationAlias = null) Adds a RIGHT JOIN clause to the query using the VolWorkTechnic relation
 * @method     ChildVolTechnicQuery innerJoinVolWorkTechnic($relationAlias = null) Adds a INNER JOIN clause to the query using the VolWorkTechnic relation
 *
 * @method     ChildVolTechnicQuery joinWithVolWorkTechnic($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the VolWorkTechnic relation
 *
 * @method     ChildVolTechnicQuery leftJoinWithVolWorkTechnic() Adds a LEFT JOIN clause and with to the query using the VolWorkTechnic relation
 * @method     ChildVolTechnicQuery rightJoinWithVolWorkTechnic() Adds a RIGHT JOIN clause and with to the query using the VolWorkTechnic relation
 * @method     ChildVolTechnicQuery innerJoinWithVolWorkTechnic() Adds a INNER JOIN clause and with to the query using the VolWorkTechnic relation
 *
 * @method     ChildVolTechnicQuery leftJoinVolTechnicVersion($relationAlias = null) Adds a LEFT JOIN clause to the query using the VolTechnicVersion relation
 * @method     ChildVolTechnicQuery rightJoinVolTechnicVersion($relationAlias = null) Adds a RIGHT JOIN clause to the query using the VolTechnicVersion relation
 * @method     ChildVolTechnicQuery innerJoinVolTechnicVersion($relationAlias = null) Adds a INNER JOIN clause to the query using the VolTechnicVersion relation
 *
 * @method     ChildVolTechnicQuery joinWithVolTechnicVersion($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the VolTechnicVersion relation
 *
 * @method     ChildVolTechnicQuery leftJoinWithVolTechnicVersion() Adds a LEFT JOIN clause and with to the query using the VolTechnicVersion relation
 * @method     ChildVolTechnicQuery rightJoinWithVolTechnicVersion() Adds a RIGHT JOIN clause and with to the query using the VolTechnicVersion relation
 * @method     ChildVolTechnicQuery innerJoinWithVolTechnicVersion() Adds a INNER JOIN clause and with to the query using the VolTechnicVersion relation
 *
 * @method     \DB\VolUnitQuery|\DB\ObjStageTechnicQuery|\DB\VolWorkTechnicQuery|\DB\VolTechnicVersionQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildVolTechnic|null findOne(?ConnectionInterface $con = null) Return the first ChildVolTechnic matching the query
 * @method     ChildVolTechnic findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildVolTechnic matching the query, or a new ChildVolTechnic object populated from the query conditions when no match is found
 *
 * @method     ChildVolTechnic|null findOneById(int $id) Return the first ChildVolTechnic filtered by the id column
 * @method     ChildVolTechnic|null findOneByName(string $name) Return the first ChildVolTechnic filtered by the name column
 * @method     ChildVolTechnic|null findOneByPrice(string $price) Return the first ChildVolTechnic filtered by the price column
 * @method     ChildVolTechnic|null findOneByIsAvailable(boolean $is_available) Return the first ChildVolTechnic filtered by the is_available column
 * @method     ChildVolTechnic|null findOneByUnitId(int $unit_id) Return the first ChildVolTechnic filtered by the unit_id column
 * @method     ChildVolTechnic|null findOneByVersion(int $version) Return the first ChildVolTechnic filtered by the version column
 * @method     ChildVolTechnic|null findOneByVersionCreatedAt(string $version_created_at) Return the first ChildVolTechnic filtered by the version_created_at column
 * @method     ChildVolTechnic|null findOneByVersionCreatedBy(string $version_created_by) Return the first ChildVolTechnic filtered by the version_created_by column
 * @method     ChildVolTechnic|null findOneByVersionComment(string $version_comment) Return the first ChildVolTechnic filtered by the version_comment column *

 * @method     ChildVolTechnic requirePk($key, ?ConnectionInterface $con = null) Return the ChildVolTechnic by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolTechnic requireOne(?ConnectionInterface $con = null) Return the first ChildVolTechnic matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildVolTechnic requireOneById(int $id) Return the first ChildVolTechnic filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolTechnic requireOneByName(string $name) Return the first ChildVolTechnic filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolTechnic requireOneByPrice(string $price) Return the first ChildVolTechnic filtered by the price column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolTechnic requireOneByIsAvailable(boolean $is_available) Return the first ChildVolTechnic filtered by the is_available column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolTechnic requireOneByUnitId(int $unit_id) Return the first ChildVolTechnic filtered by the unit_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolTechnic requireOneByVersion(int $version) Return the first ChildVolTechnic filtered by the version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolTechnic requireOneByVersionCreatedAt(string $version_created_at) Return the first ChildVolTechnic filtered by the version_created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolTechnic requireOneByVersionCreatedBy(string $version_created_by) Return the first ChildVolTechnic filtered by the version_created_by column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolTechnic requireOneByVersionComment(string $version_comment) Return the first ChildVolTechnic filtered by the version_comment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildVolTechnic[]|Collection find(?ConnectionInterface $con = null) Return ChildVolTechnic objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildVolTechnic> find(?ConnectionInterface $con = null) Return ChildVolTechnic objects based on current ModelCriteria
 * @method     ChildVolTechnic[]|Collection findById(int $id) Return ChildVolTechnic objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildVolTechnic> findById(int $id) Return ChildVolTechnic objects filtered by the id column
 * @method     ChildVolTechnic[]|Collection findByName(string $name) Return ChildVolTechnic objects filtered by the name column
 * @psalm-method Collection&\Traversable<ChildVolTechnic> findByName(string $name) Return ChildVolTechnic objects filtered by the name column
 * @method     ChildVolTechnic[]|Collection findByPrice(string $price) Return ChildVolTechnic objects filtered by the price column
 * @psalm-method Collection&\Traversable<ChildVolTechnic> findByPrice(string $price) Return ChildVolTechnic objects filtered by the price column
 * @method     ChildVolTechnic[]|Collection findByIsAvailable(boolean $is_available) Return ChildVolTechnic objects filtered by the is_available column
 * @psalm-method Collection&\Traversable<ChildVolTechnic> findByIsAvailable(boolean $is_available) Return ChildVolTechnic objects filtered by the is_available column
 * @method     ChildVolTechnic[]|Collection findByUnitId(int $unit_id) Return ChildVolTechnic objects filtered by the unit_id column
 * @psalm-method Collection&\Traversable<ChildVolTechnic> findByUnitId(int $unit_id) Return ChildVolTechnic objects filtered by the unit_id column
 * @method     ChildVolTechnic[]|Collection findByVersion(int $version) Return ChildVolTechnic objects filtered by the version column
 * @psalm-method Collection&\Traversable<ChildVolTechnic> findByVersion(int $version) Return ChildVolTechnic objects filtered by the version column
 * @method     ChildVolTechnic[]|Collection findByVersionCreatedAt(string $version_created_at) Return ChildVolTechnic objects filtered by the version_created_at column
 * @psalm-method Collection&\Traversable<ChildVolTechnic> findByVersionCreatedAt(string $version_created_at) Return ChildVolTechnic objects filtered by the version_created_at column
 * @method     ChildVolTechnic[]|Collection findByVersionCreatedBy(string $version_created_by) Return ChildVolTechnic objects filtered by the version_created_by column
 * @psalm-method Collection&\Traversable<ChildVolTechnic> findByVersionCreatedBy(string $version_created_by) Return ChildVolTechnic objects filtered by the version_created_by column
 * @method     ChildVolTechnic[]|Collection findByVersionComment(string $version_comment) Return ChildVolTechnic objects filtered by the version_comment column
 * @psalm-method Collection&\Traversable<ChildVolTechnic> findByVersionComment(string $version_comment) Return ChildVolTechnic objects filtered by the version_comment column
 * @method     ChildVolTechnic[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildVolTechnic> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class VolTechnicQuery extends ModelCriteria
{

    // versionable behavior

    /**
     * Whether the versioning is enabled
     */
    static $isVersioningEnabled = true;
protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \DB\Base\VolTechnicQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\DB\\VolTechnic', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildVolTechnicQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildVolTechnicQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildVolTechnicQuery) {
            return $criteria;
        }
        $query = new ChildVolTechnicQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildVolTechnic|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(VolTechnicTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = VolTechnicTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildVolTechnic A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, price, is_available, unit_id, version, version_created_at, version_created_by, version_comment FROM vol_technic WHERE id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildVolTechnic $obj */
            $obj = new ChildVolTechnic();
            $obj->hydrate($row);
            VolTechnicTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con A connection object
     *
     * @return ChildVolTechnic|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param array $keys Primary keys to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return Collection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param mixed $key Primary key to use for the query
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        $this->addUsingAlias(VolTechnicTableMap::COL_ID, $key, Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param array|int $keys The list of primary key to use for the query
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        $this->addUsingAlias(VolTechnicTableMap::COL_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterById($id = null, ?string $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(VolTechnicTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(VolTechnicTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(VolTechnicTableMap::COL_ID, $id, $comparison);

        return $this;
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%', Criteria::LIKE); // WHERE name LIKE '%fooValue%'
     * $query->filterByName(['foo', 'bar']); // WHERE name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $name The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByName($name = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(VolTechnicTableMap::COL_NAME, $name, $comparison);

        return $this;
    }

    /**
     * Filter the query on the price column
     *
     * Example usage:
     * <code>
     * $query->filterByPrice(1234); // WHERE price = 1234
     * $query->filterByPrice(array(12, 34)); // WHERE price IN (12, 34)
     * $query->filterByPrice(array('min' => 12)); // WHERE price > 12
     * </code>
     *
     * @param mixed $price The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrice($price = null, ?string $comparison = null)
    {
        if (is_array($price)) {
            $useMinMax = false;
            if (isset($price['min'])) {
                $this->addUsingAlias(VolTechnicTableMap::COL_PRICE, $price['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($price['max'])) {
                $this->addUsingAlias(VolTechnicTableMap::COL_PRICE, $price['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(VolTechnicTableMap::COL_PRICE, $price, $comparison);

        return $this;
    }

    /**
     * Filter the query on the is_available column
     *
     * Example usage:
     * <code>
     * $query->filterByIsAvailable(true); // WHERE is_available = true
     * $query->filterByIsAvailable('yes'); // WHERE is_available = true
     * </code>
     *
     * @param bool|string $isAvailable The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIsAvailable($isAvailable = null, ?string $comparison = null)
    {
        if (is_string($isAvailable)) {
            $isAvailable = in_array(strtolower($isAvailable), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        $this->addUsingAlias(VolTechnicTableMap::COL_IS_AVAILABLE, $isAvailable, $comparison);

        return $this;
    }

    /**
     * Filter the query on the unit_id column
     *
     * Example usage:
     * <code>
     * $query->filterByUnitId(1234); // WHERE unit_id = 1234
     * $query->filterByUnitId(array(12, 34)); // WHERE unit_id IN (12, 34)
     * $query->filterByUnitId(array('min' => 12)); // WHERE unit_id > 12
     * </code>
     *
     * @see       filterByVolUnit()
     *
     * @param mixed $unitId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUnitId($unitId = null, ?string $comparison = null)
    {
        if (is_array($unitId)) {
            $useMinMax = false;
            if (isset($unitId['min'])) {
                $this->addUsingAlias(VolTechnicTableMap::COL_UNIT_ID, $unitId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($unitId['max'])) {
                $this->addUsingAlias(VolTechnicTableMap::COL_UNIT_ID, $unitId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(VolTechnicTableMap::COL_UNIT_ID, $unitId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the version column
     *
     * Example usage:
     * <code>
     * $query->filterByVersion(1234); // WHERE version = 1234
     * $query->filterByVersion(array(12, 34)); // WHERE version IN (12, 34)
     * $query->filterByVersion(array('min' => 12)); // WHERE version > 12
     * </code>
     *
     * @param mixed $version The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByVersion($version = null, ?string $comparison = null)
    {
        if (is_array($version)) {
            $useMinMax = false;
            if (isset($version['min'])) {
                $this->addUsingAlias(VolTechnicTableMap::COL_VERSION, $version['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($version['max'])) {
                $this->addUsingAlias(VolTechnicTableMap::COL_VERSION, $version['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(VolTechnicTableMap::COL_VERSION, $version, $comparison);

        return $this;
    }

    /**
     * Filter the query on the version_created_at column
     *
     * Example usage:
     * <code>
     * $query->filterByVersionCreatedAt('2011-03-14'); // WHERE version_created_at = '2011-03-14'
     * $query->filterByVersionCreatedAt('now'); // WHERE version_created_at = '2011-03-14'
     * $query->filterByVersionCreatedAt(array('max' => 'yesterday')); // WHERE version_created_at > '2011-03-13'
     * </code>
     *
     * @param mixed $versionCreatedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByVersionCreatedAt($versionCreatedAt = null, ?string $comparison = null)
    {
        if (is_array($versionCreatedAt)) {
            $useMinMax = false;
            if (isset($versionCreatedAt['min'])) {
                $this->addUsingAlias(VolTechnicTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($versionCreatedAt['max'])) {
                $this->addUsingAlias(VolTechnicTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(VolTechnicTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the version_created_by column
     *
     * Example usage:
     * <code>
     * $query->filterByVersionCreatedBy('fooValue');   // WHERE version_created_by = 'fooValue'
     * $query->filterByVersionCreatedBy('%fooValue%', Criteria::LIKE); // WHERE version_created_by LIKE '%fooValue%'
     * $query->filterByVersionCreatedBy(['foo', 'bar']); // WHERE version_created_by IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $versionCreatedBy The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByVersionCreatedBy($versionCreatedBy = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($versionCreatedBy)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(VolTechnicTableMap::COL_VERSION_CREATED_BY, $versionCreatedBy, $comparison);

        return $this;
    }

    /**
     * Filter the query on the version_comment column
     *
     * Example usage:
     * <code>
     * $query->filterByVersionComment('fooValue');   // WHERE version_comment = 'fooValue'
     * $query->filterByVersionComment('%fooValue%', Criteria::LIKE); // WHERE version_comment LIKE '%fooValue%'
     * $query->filterByVersionComment(['foo', 'bar']); // WHERE version_comment IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $versionComment The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByVersionComment($versionComment = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($versionComment)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(VolTechnicTableMap::COL_VERSION_COMMENT, $versionComment, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \DB\VolUnit object
     *
     * @param \DB\VolUnit|ObjectCollection $volUnit The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByVolUnit($volUnit, ?string $comparison = null)
    {
        if ($volUnit instanceof \DB\VolUnit) {
            return $this
                ->addUsingAlias(VolTechnicTableMap::COL_UNIT_ID, $volUnit->getId(), $comparison);
        } elseif ($volUnit instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(VolTechnicTableMap::COL_UNIT_ID, $volUnit->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByVolUnit() only accepts arguments of type \DB\VolUnit or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the VolUnit relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinVolUnit(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('VolUnit');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'VolUnit');
        }

        return $this;
    }

    /**
     * Use the VolUnit relation VolUnit object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\VolUnitQuery A secondary query class using the current class as primary query
     */
    public function useVolUnitQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinVolUnit($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'VolUnit', '\DB\VolUnitQuery');
    }

    /**
     * Use the VolUnit relation VolUnit object
     *
     * @param callable(\DB\VolUnitQuery):\DB\VolUnitQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withVolUnitQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useVolUnitQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to VolUnit table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\VolUnitQuery The inner query object of the EXISTS statement
     */
    public function useVolUnitExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('VolUnit', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to VolUnit table for a NOT EXISTS query.
     *
     * @see useVolUnitExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\VolUnitQuery The inner query object of the NOT EXISTS statement
     */
    public function useVolUnitNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('VolUnit', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \DB\ObjStageTechnic object
     *
     * @param \DB\ObjStageTechnic|ObjectCollection $objStageTechnic the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByObjStageTechnic($objStageTechnic, ?string $comparison = null)
    {
        if ($objStageTechnic instanceof \DB\ObjStageTechnic) {
            $this
                ->addUsingAlias(VolTechnicTableMap::COL_ID, $objStageTechnic->getTechnicId(), $comparison);

            return $this;
        } elseif ($objStageTechnic instanceof ObjectCollection) {
            $this
                ->useObjStageTechnicQuery()
                ->filterByPrimaryKeys($objStageTechnic->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByObjStageTechnic() only accepts arguments of type \DB\ObjStageTechnic or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ObjStageTechnic relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinObjStageTechnic(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ObjStageTechnic');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'ObjStageTechnic');
        }

        return $this;
    }

    /**
     * Use the ObjStageTechnic relation ObjStageTechnic object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\ObjStageTechnicQuery A secondary query class using the current class as primary query
     */
    public function useObjStageTechnicQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinObjStageTechnic($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ObjStageTechnic', '\DB\ObjStageTechnicQuery');
    }

    /**
     * Use the ObjStageTechnic relation ObjStageTechnic object
     *
     * @param callable(\DB\ObjStageTechnicQuery):\DB\ObjStageTechnicQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withObjStageTechnicQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useObjStageTechnicQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to ObjStageTechnic table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\ObjStageTechnicQuery The inner query object of the EXISTS statement
     */
    public function useObjStageTechnicExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('ObjStageTechnic', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to ObjStageTechnic table for a NOT EXISTS query.
     *
     * @see useObjStageTechnicExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\ObjStageTechnicQuery The inner query object of the NOT EXISTS statement
     */
    public function useObjStageTechnicNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('ObjStageTechnic', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \DB\VolWorkTechnic object
     *
     * @param \DB\VolWorkTechnic|ObjectCollection $volWorkTechnic the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByVolWorkTechnic($volWorkTechnic, ?string $comparison = null)
    {
        if ($volWorkTechnic instanceof \DB\VolWorkTechnic) {
            $this
                ->addUsingAlias(VolTechnicTableMap::COL_ID, $volWorkTechnic->getTechnicId(), $comparison);

            return $this;
        } elseif ($volWorkTechnic instanceof ObjectCollection) {
            $this
                ->useVolWorkTechnicQuery()
                ->filterByPrimaryKeys($volWorkTechnic->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByVolWorkTechnic() only accepts arguments of type \DB\VolWorkTechnic or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the VolWorkTechnic relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinVolWorkTechnic(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('VolWorkTechnic');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'VolWorkTechnic');
        }

        return $this;
    }

    /**
     * Use the VolWorkTechnic relation VolWorkTechnic object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\VolWorkTechnicQuery A secondary query class using the current class as primary query
     */
    public function useVolWorkTechnicQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinVolWorkTechnic($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'VolWorkTechnic', '\DB\VolWorkTechnicQuery');
    }

    /**
     * Use the VolWorkTechnic relation VolWorkTechnic object
     *
     * @param callable(\DB\VolWorkTechnicQuery):\DB\VolWorkTechnicQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withVolWorkTechnicQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useVolWorkTechnicQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to VolWorkTechnic table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\VolWorkTechnicQuery The inner query object of the EXISTS statement
     */
    public function useVolWorkTechnicExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('VolWorkTechnic', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to VolWorkTechnic table for a NOT EXISTS query.
     *
     * @see useVolWorkTechnicExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\VolWorkTechnicQuery The inner query object of the NOT EXISTS statement
     */
    public function useVolWorkTechnicNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('VolWorkTechnic', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \DB\VolTechnicVersion object
     *
     * @param \DB\VolTechnicVersion|ObjectCollection $volTechnicVersion the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByVolTechnicVersion($volTechnicVersion, ?string $comparison = null)
    {
        if ($volTechnicVersion instanceof \DB\VolTechnicVersion) {
            $this
                ->addUsingAlias(VolTechnicTableMap::COL_ID, $volTechnicVersion->getId(), $comparison);

            return $this;
        } elseif ($volTechnicVersion instanceof ObjectCollection) {
            $this
                ->useVolTechnicVersionQuery()
                ->filterByPrimaryKeys($volTechnicVersion->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByVolTechnicVersion() only accepts arguments of type \DB\VolTechnicVersion or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the VolTechnicVersion relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinVolTechnicVersion(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('VolTechnicVersion');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'VolTechnicVersion');
        }

        return $this;
    }

    /**
     * Use the VolTechnicVersion relation VolTechnicVersion object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\VolTechnicVersionQuery A secondary query class using the current class as primary query
     */
    public function useVolTechnicVersionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinVolTechnicVersion($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'VolTechnicVersion', '\DB\VolTechnicVersionQuery');
    }

    /**
     * Use the VolTechnicVersion relation VolTechnicVersion object
     *
     * @param callable(\DB\VolTechnicVersionQuery):\DB\VolTechnicVersionQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withVolTechnicVersionQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useVolTechnicVersionQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to VolTechnicVersion table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\VolTechnicVersionQuery The inner query object of the EXISTS statement
     */
    public function useVolTechnicVersionExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('VolTechnicVersion', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to VolTechnicVersion table for a NOT EXISTS query.
     *
     * @see useVolTechnicVersionExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\VolTechnicVersionQuery The inner query object of the NOT EXISTS statement
     */
    public function useVolTechnicVersionNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('VolTechnicVersion', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Exclude object from result
     *
     * @param ChildVolTechnic $volTechnic Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($volTechnic = null)
    {
        if ($volTechnic) {
            $this->addUsingAlias(VolTechnicTableMap::COL_ID, $volTechnic->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the vol_technic table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(VolTechnicTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            VolTechnicTableMap::clearInstancePool();
            VolTechnicTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(VolTechnicTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(VolTechnicTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            VolTechnicTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            VolTechnicTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    // versionable behavior

    /**
     * Checks whether versioning is enabled
     *
     * @return bool
     */
    static public function isVersioningEnabled(): bool
    {
        return self::$isVersioningEnabled;
    }

    /**
     * Enables versioning
     */
    static public function enableVersioning(): void
    {
        self::$isVersioningEnabled = true;
    }

    /**
     * Disables versioning
     */
    static public function disableVersioning(): void
    {
        self::$isVersioningEnabled = false;
    }

}
