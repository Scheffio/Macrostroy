<?php

namespace DB\Base;

use \Exception;
use \PDO;
use DB\Technic as ChildTechnic;
use DB\TechnicQuery as ChildTechnicQuery;
use DB\Map\TechnicTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'technic' table.
 *
 *
 *
 * @method     ChildTechnicQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildTechnicQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildTechnicQuery orderByPrice($order = Criteria::ASC) Order by the price column
 * @method     ChildTechnicQuery orderByIsAvailable($order = Criteria::ASC) Order by the is_available column
 * @method     ChildTechnicQuery orderByUnitId($order = Criteria::ASC) Order by the unit_id column
 * @method     ChildTechnicQuery orderByVersion($order = Criteria::ASC) Order by the version column
 * @method     ChildTechnicQuery orderByVersionCreatedAt($order = Criteria::ASC) Order by the version_created_at column
 * @method     ChildTechnicQuery orderByVersionCreatedBy($order = Criteria::ASC) Order by the version_created_by column
 * @method     ChildTechnicQuery orderByVersionComment($order = Criteria::ASC) Order by the version_comment column
 *
 * @method     ChildTechnicQuery groupById() Group by the id column
 * @method     ChildTechnicQuery groupByName() Group by the name column
 * @method     ChildTechnicQuery groupByPrice() Group by the price column
 * @method     ChildTechnicQuery groupByIsAvailable() Group by the is_available column
 * @method     ChildTechnicQuery groupByUnitId() Group by the unit_id column
 * @method     ChildTechnicQuery groupByVersion() Group by the version column
 * @method     ChildTechnicQuery groupByVersionCreatedAt() Group by the version_created_at column
 * @method     ChildTechnicQuery groupByVersionCreatedBy() Group by the version_created_by column
 * @method     ChildTechnicQuery groupByVersionComment() Group by the version_comment column
 *
 * @method     ChildTechnicQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildTechnicQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildTechnicQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildTechnicQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildTechnicQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildTechnicQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildTechnicQuery leftJoinStageTechnic($relationAlias = null) Adds a LEFT JOIN clause to the query using the StageTechnic relation
 * @method     ChildTechnicQuery rightJoinStageTechnic($relationAlias = null) Adds a RIGHT JOIN clause to the query using the StageTechnic relation
 * @method     ChildTechnicQuery innerJoinStageTechnic($relationAlias = null) Adds a INNER JOIN clause to the query using the StageTechnic relation
 *
 * @method     ChildTechnicQuery joinWithStageTechnic($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the StageTechnic relation
 *
 * @method     ChildTechnicQuery leftJoinWithStageTechnic() Adds a LEFT JOIN clause and with to the query using the StageTechnic relation
 * @method     ChildTechnicQuery rightJoinWithStageTechnic() Adds a RIGHT JOIN clause and with to the query using the StageTechnic relation
 * @method     ChildTechnicQuery innerJoinWithStageTechnic() Adds a INNER JOIN clause and with to the query using the StageTechnic relation
 *
 * @method     ChildTechnicQuery leftJoinWorkTechnic($relationAlias = null) Adds a LEFT JOIN clause to the query using the WorkTechnic relation
 * @method     ChildTechnicQuery rightJoinWorkTechnic($relationAlias = null) Adds a RIGHT JOIN clause to the query using the WorkTechnic relation
 * @method     ChildTechnicQuery innerJoinWorkTechnic($relationAlias = null) Adds a INNER JOIN clause to the query using the WorkTechnic relation
 *
 * @method     ChildTechnicQuery joinWithWorkTechnic($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the WorkTechnic relation
 *
 * @method     ChildTechnicQuery leftJoinWithWorkTechnic() Adds a LEFT JOIN clause and with to the query using the WorkTechnic relation
 * @method     ChildTechnicQuery rightJoinWithWorkTechnic() Adds a RIGHT JOIN clause and with to the query using the WorkTechnic relation
 * @method     ChildTechnicQuery innerJoinWithWorkTechnic() Adds a INNER JOIN clause and with to the query using the WorkTechnic relation
 *
 * @method     ChildTechnicQuery leftJoinTechnicVersion($relationAlias = null) Adds a LEFT JOIN clause to the query using the TechnicVersion relation
 * @method     ChildTechnicQuery rightJoinTechnicVersion($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TechnicVersion relation
 * @method     ChildTechnicQuery innerJoinTechnicVersion($relationAlias = null) Adds a INNER JOIN clause to the query using the TechnicVersion relation
 *
 * @method     ChildTechnicQuery joinWithTechnicVersion($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the TechnicVersion relation
 *
 * @method     ChildTechnicQuery leftJoinWithTechnicVersion() Adds a LEFT JOIN clause and with to the query using the TechnicVersion relation
 * @method     ChildTechnicQuery rightJoinWithTechnicVersion() Adds a RIGHT JOIN clause and with to the query using the TechnicVersion relation
 * @method     ChildTechnicQuery innerJoinWithTechnicVersion() Adds a INNER JOIN clause and with to the query using the TechnicVersion relation
 *
 * @method     \DB\StageTechnicQuery|\DB\WorkTechnicQuery|\DB\TechnicVersionQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildTechnic|null findOne(?ConnectionInterface $con = null) Return the first ChildTechnic matching the query
 * @method     ChildTechnic findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildTechnic matching the query, or a new ChildTechnic object populated from the query conditions when no match is found
 *
 * @method     ChildTechnic|null findOneById(int $id) Return the first ChildTechnic filtered by the id column
 * @method     ChildTechnic|null findOneByName(string $name) Return the first ChildTechnic filtered by the name column
 * @method     ChildTechnic|null findOneByPrice(string $price) Return the first ChildTechnic filtered by the price column
 * @method     ChildTechnic|null findOneByIsAvailable(boolean $is_available) Return the first ChildTechnic filtered by the is_available column
 * @method     ChildTechnic|null findOneByUnitId(int $unit_id) Return the first ChildTechnic filtered by the unit_id column
 * @method     ChildTechnic|null findOneByVersion(int $version) Return the first ChildTechnic filtered by the version column
 * @method     ChildTechnic|null findOneByVersionCreatedAt(string $version_created_at) Return the first ChildTechnic filtered by the version_created_at column
 * @method     ChildTechnic|null findOneByVersionCreatedBy(string $version_created_by) Return the first ChildTechnic filtered by the version_created_by column
 * @method     ChildTechnic|null findOneByVersionComment(string $version_comment) Return the first ChildTechnic filtered by the version_comment column *

 * @method     ChildTechnic requirePk($key, ?ConnectionInterface $con = null) Return the ChildTechnic by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTechnic requireOne(?ConnectionInterface $con = null) Return the first ChildTechnic matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTechnic requireOneById(int $id) Return the first ChildTechnic filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTechnic requireOneByName(string $name) Return the first ChildTechnic filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTechnic requireOneByPrice(string $price) Return the first ChildTechnic filtered by the price column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTechnic requireOneByIsAvailable(boolean $is_available) Return the first ChildTechnic filtered by the is_available column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTechnic requireOneByUnitId(int $unit_id) Return the first ChildTechnic filtered by the unit_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTechnic requireOneByVersion(int $version) Return the first ChildTechnic filtered by the version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTechnic requireOneByVersionCreatedAt(string $version_created_at) Return the first ChildTechnic filtered by the version_created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTechnic requireOneByVersionCreatedBy(string $version_created_by) Return the first ChildTechnic filtered by the version_created_by column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTechnic requireOneByVersionComment(string $version_comment) Return the first ChildTechnic filtered by the version_comment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTechnic[]|Collection find(?ConnectionInterface $con = null) Return ChildTechnic objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildTechnic> find(?ConnectionInterface $con = null) Return ChildTechnic objects based on current ModelCriteria
 * @method     ChildTechnic[]|Collection findById(int $id) Return ChildTechnic objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildTechnic> findById(int $id) Return ChildTechnic objects filtered by the id column
 * @method     ChildTechnic[]|Collection findByName(string $name) Return ChildTechnic objects filtered by the name column
 * @psalm-method Collection&\Traversable<ChildTechnic> findByName(string $name) Return ChildTechnic objects filtered by the name column
 * @method     ChildTechnic[]|Collection findByPrice(string $price) Return ChildTechnic objects filtered by the price column
 * @psalm-method Collection&\Traversable<ChildTechnic> findByPrice(string $price) Return ChildTechnic objects filtered by the price column
 * @method     ChildTechnic[]|Collection findByIsAvailable(boolean $is_available) Return ChildTechnic objects filtered by the is_available column
 * @psalm-method Collection&\Traversable<ChildTechnic> findByIsAvailable(boolean $is_available) Return ChildTechnic objects filtered by the is_available column
 * @method     ChildTechnic[]|Collection findByUnitId(int $unit_id) Return ChildTechnic objects filtered by the unit_id column
 * @psalm-method Collection&\Traversable<ChildTechnic> findByUnitId(int $unit_id) Return ChildTechnic objects filtered by the unit_id column
 * @method     ChildTechnic[]|Collection findByVersion(int $version) Return ChildTechnic objects filtered by the version column
 * @psalm-method Collection&\Traversable<ChildTechnic> findByVersion(int $version) Return ChildTechnic objects filtered by the version column
 * @method     ChildTechnic[]|Collection findByVersionCreatedAt(string $version_created_at) Return ChildTechnic objects filtered by the version_created_at column
 * @psalm-method Collection&\Traversable<ChildTechnic> findByVersionCreatedAt(string $version_created_at) Return ChildTechnic objects filtered by the version_created_at column
 * @method     ChildTechnic[]|Collection findByVersionCreatedBy(string $version_created_by) Return ChildTechnic objects filtered by the version_created_by column
 * @psalm-method Collection&\Traversable<ChildTechnic> findByVersionCreatedBy(string $version_created_by) Return ChildTechnic objects filtered by the version_created_by column
 * @method     ChildTechnic[]|Collection findByVersionComment(string $version_comment) Return ChildTechnic objects filtered by the version_comment column
 * @psalm-method Collection&\Traversable<ChildTechnic> findByVersionComment(string $version_comment) Return ChildTechnic objects filtered by the version_comment column
 * @method     ChildTechnic[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildTechnic> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class TechnicQuery extends ModelCriteria
{

    // versionable behavior

    /**
     * Whether the versioning is enabled
     */
    static $isVersioningEnabled = true;
protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \DB\Base\TechnicQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\DB\\Technic', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildTechnicQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildTechnicQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildTechnicQuery) {
            return $criteria;
        }
        $query = new ChildTechnicQuery();
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
     * @return ChildTechnic|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(TechnicTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = TechnicTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildTechnic A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, price, is_available, unit_id, version, version_created_at, version_created_by, version_comment FROM technic WHERE id = :p0';
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
            /** @var ChildTechnic $obj */
            $obj = new ChildTechnic();
            $obj->hydrate($row);
            TechnicTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildTechnic|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(TechnicTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(TechnicTableMap::COL_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(TechnicTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(TechnicTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TechnicTableMap::COL_ID, $id, $comparison);

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

        $this->addUsingAlias(TechnicTableMap::COL_NAME, $name, $comparison);

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
                $this->addUsingAlias(TechnicTableMap::COL_PRICE, $price['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($price['max'])) {
                $this->addUsingAlias(TechnicTableMap::COL_PRICE, $price['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TechnicTableMap::COL_PRICE, $price, $comparison);

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

        $this->addUsingAlias(TechnicTableMap::COL_IS_AVAILABLE, $isAvailable, $comparison);

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
                $this->addUsingAlias(TechnicTableMap::COL_UNIT_ID, $unitId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($unitId['max'])) {
                $this->addUsingAlias(TechnicTableMap::COL_UNIT_ID, $unitId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TechnicTableMap::COL_UNIT_ID, $unitId, $comparison);

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
                $this->addUsingAlias(TechnicTableMap::COL_VERSION, $version['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($version['max'])) {
                $this->addUsingAlias(TechnicTableMap::COL_VERSION, $version['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TechnicTableMap::COL_VERSION, $version, $comparison);

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
                $this->addUsingAlias(TechnicTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($versionCreatedAt['max'])) {
                $this->addUsingAlias(TechnicTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TechnicTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt, $comparison);

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

        $this->addUsingAlias(TechnicTableMap::COL_VERSION_CREATED_BY, $versionCreatedBy, $comparison);

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

        $this->addUsingAlias(TechnicTableMap::COL_VERSION_COMMENT, $versionComment, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \DB\StageTechnic object
     *
     * @param \DB\StageTechnic|ObjectCollection $stageTechnic the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStageTechnic($stageTechnic, ?string $comparison = null)
    {
        if ($stageTechnic instanceof \DB\StageTechnic) {
            $this
                ->addUsingAlias(TechnicTableMap::COL_ID, $stageTechnic->getTechnicId(), $comparison);

            return $this;
        } elseif ($stageTechnic instanceof ObjectCollection) {
            $this
                ->useStageTechnicQuery()
                ->filterByPrimaryKeys($stageTechnic->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByStageTechnic() only accepts arguments of type \DB\StageTechnic or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the StageTechnic relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinStageTechnic(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('StageTechnic');

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
            $this->addJoinObject($join, 'StageTechnic');
        }

        return $this;
    }

    /**
     * Use the StageTechnic relation StageTechnic object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\StageTechnicQuery A secondary query class using the current class as primary query
     */
    public function useStageTechnicQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinStageTechnic($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'StageTechnic', '\DB\StageTechnicQuery');
    }

    /**
     * Use the StageTechnic relation StageTechnic object
     *
     * @param callable(\DB\StageTechnicQuery):\DB\StageTechnicQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withStageTechnicQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useStageTechnicQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to StageTechnic table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\StageTechnicQuery The inner query object of the EXISTS statement
     */
    public function useStageTechnicExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('StageTechnic', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to StageTechnic table for a NOT EXISTS query.
     *
     * @see useStageTechnicExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\StageTechnicQuery The inner query object of the NOT EXISTS statement
     */
    public function useStageTechnicNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('StageTechnic', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \DB\WorkTechnic object
     *
     * @param \DB\WorkTechnic|ObjectCollection $workTechnic the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWorkTechnic($workTechnic, ?string $comparison = null)
    {
        if ($workTechnic instanceof \DB\WorkTechnic) {
            $this
                ->addUsingAlias(TechnicTableMap::COL_ID, $workTechnic->getTechnicId(), $comparison);

            return $this;
        } elseif ($workTechnic instanceof ObjectCollection) {
            $this
                ->useWorkTechnicQuery()
                ->filterByPrimaryKeys($workTechnic->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByWorkTechnic() only accepts arguments of type \DB\WorkTechnic or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the WorkTechnic relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinWorkTechnic(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('WorkTechnic');

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
            $this->addJoinObject($join, 'WorkTechnic');
        }

        return $this;
    }

    /**
     * Use the WorkTechnic relation WorkTechnic object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\WorkTechnicQuery A secondary query class using the current class as primary query
     */
    public function useWorkTechnicQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinWorkTechnic($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'WorkTechnic', '\DB\WorkTechnicQuery');
    }

    /**
     * Use the WorkTechnic relation WorkTechnic object
     *
     * @param callable(\DB\WorkTechnicQuery):\DB\WorkTechnicQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withWorkTechnicQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useWorkTechnicQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to WorkTechnic table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\WorkTechnicQuery The inner query object of the EXISTS statement
     */
    public function useWorkTechnicExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('WorkTechnic', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to WorkTechnic table for a NOT EXISTS query.
     *
     * @see useWorkTechnicExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\WorkTechnicQuery The inner query object of the NOT EXISTS statement
     */
    public function useWorkTechnicNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('WorkTechnic', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \DB\TechnicVersion object
     *
     * @param \DB\TechnicVersion|ObjectCollection $technicVersion the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTechnicVersion($technicVersion, ?string $comparison = null)
    {
        if ($technicVersion instanceof \DB\TechnicVersion) {
            $this
                ->addUsingAlias(TechnicTableMap::COL_ID, $technicVersion->getId(), $comparison);

            return $this;
        } elseif ($technicVersion instanceof ObjectCollection) {
            $this
                ->useTechnicVersionQuery()
                ->filterByPrimaryKeys($technicVersion->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByTechnicVersion() only accepts arguments of type \DB\TechnicVersion or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TechnicVersion relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinTechnicVersion(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TechnicVersion');

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
            $this->addJoinObject($join, 'TechnicVersion');
        }

        return $this;
    }

    /**
     * Use the TechnicVersion relation TechnicVersion object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\TechnicVersionQuery A secondary query class using the current class as primary query
     */
    public function useTechnicVersionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTechnicVersion($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TechnicVersion', '\DB\TechnicVersionQuery');
    }

    /**
     * Use the TechnicVersion relation TechnicVersion object
     *
     * @param callable(\DB\TechnicVersionQuery):\DB\TechnicVersionQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withTechnicVersionQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useTechnicVersionQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to TechnicVersion table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\TechnicVersionQuery The inner query object of the EXISTS statement
     */
    public function useTechnicVersionExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('TechnicVersion', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to TechnicVersion table for a NOT EXISTS query.
     *
     * @see useTechnicVersionExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\TechnicVersionQuery The inner query object of the NOT EXISTS statement
     */
    public function useTechnicVersionNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('TechnicVersion', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Exclude object from result
     *
     * @param ChildTechnic $technic Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($technic = null)
    {
        if ($technic) {
            $this->addUsingAlias(TechnicTableMap::COL_ID, $technic->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the technic table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TechnicTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            TechnicTableMap::clearInstancePool();
            TechnicTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(TechnicTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(TechnicTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            TechnicTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            TechnicTableMap::clearRelatedInstancePool();

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
