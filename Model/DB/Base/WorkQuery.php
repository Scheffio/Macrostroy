<?php

namespace DB\Base;

use \Exception;
use \PDO;
use DB\Work as ChildWork;
use DB\WorkQuery as ChildWorkQuery;
use DB\Map\WorkTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'work' table.
 *
 *
 *
 * @method     ChildWorkQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildWorkQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildWorkQuery orderByPrice($order = Criteria::ASC) Order by the price column
 * @method     ChildWorkQuery orderByAmount($order = Criteria::ASC) Order by the amount column
 * @method     ChildWorkQuery orderByIsAvailable($order = Criteria::ASC) Order by the is_available column
 * @method     ChildWorkQuery orderByUnitId($order = Criteria::ASC) Order by the unit_id column
 * @method     ChildWorkQuery orderByVersion($order = Criteria::ASC) Order by the version column
 * @method     ChildWorkQuery orderByVersionCreatedAt($order = Criteria::ASC) Order by the version_created_at column
 * @method     ChildWorkQuery orderByVersionCreatedBy($order = Criteria::ASC) Order by the version_created_by column
 * @method     ChildWorkQuery orderByVersionComment($order = Criteria::ASC) Order by the version_comment column
 *
 * @method     ChildWorkQuery groupById() Group by the id column
 * @method     ChildWorkQuery groupByName() Group by the name column
 * @method     ChildWorkQuery groupByPrice() Group by the price column
 * @method     ChildWorkQuery groupByAmount() Group by the amount column
 * @method     ChildWorkQuery groupByIsAvailable() Group by the is_available column
 * @method     ChildWorkQuery groupByUnitId() Group by the unit_id column
 * @method     ChildWorkQuery groupByVersion() Group by the version column
 * @method     ChildWorkQuery groupByVersionCreatedAt() Group by the version_created_at column
 * @method     ChildWorkQuery groupByVersionCreatedBy() Group by the version_created_by column
 * @method     ChildWorkQuery groupByVersionComment() Group by the version_comment column
 *
 * @method     ChildWorkQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildWorkQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildWorkQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildWorkQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildWorkQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildWorkQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildWorkQuery leftJoinUnit($relationAlias = null) Adds a LEFT JOIN clause to the query using the Unit relation
 * @method     ChildWorkQuery rightJoinUnit($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Unit relation
 * @method     ChildWorkQuery innerJoinUnit($relationAlias = null) Adds a INNER JOIN clause to the query using the Unit relation
 *
 * @method     ChildWorkQuery joinWithUnit($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Unit relation
 *
 * @method     ChildWorkQuery leftJoinWithUnit() Adds a LEFT JOIN clause and with to the query using the Unit relation
 * @method     ChildWorkQuery rightJoinWithUnit() Adds a RIGHT JOIN clause and with to the query using the Unit relation
 * @method     ChildWorkQuery innerJoinWithUnit() Adds a INNER JOIN clause and with to the query using the Unit relation
 *
 * @method     ChildWorkQuery leftJoinWorkMaterial($relationAlias = null) Adds a LEFT JOIN clause to the query using the WorkMaterial relation
 * @method     ChildWorkQuery rightJoinWorkMaterial($relationAlias = null) Adds a RIGHT JOIN clause to the query using the WorkMaterial relation
 * @method     ChildWorkQuery innerJoinWorkMaterial($relationAlias = null) Adds a INNER JOIN clause to the query using the WorkMaterial relation
 *
 * @method     ChildWorkQuery joinWithWorkMaterial($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the WorkMaterial relation
 *
 * @method     ChildWorkQuery leftJoinWithWorkMaterial() Adds a LEFT JOIN clause and with to the query using the WorkMaterial relation
 * @method     ChildWorkQuery rightJoinWithWorkMaterial() Adds a RIGHT JOIN clause and with to the query using the WorkMaterial relation
 * @method     ChildWorkQuery innerJoinWithWorkMaterial() Adds a INNER JOIN clause and with to the query using the WorkMaterial relation
 *
 * @method     ChildWorkQuery leftJoinWorkTechnic($relationAlias = null) Adds a LEFT JOIN clause to the query using the WorkTechnic relation
 * @method     ChildWorkQuery rightJoinWorkTechnic($relationAlias = null) Adds a RIGHT JOIN clause to the query using the WorkTechnic relation
 * @method     ChildWorkQuery innerJoinWorkTechnic($relationAlias = null) Adds a INNER JOIN clause to the query using the WorkTechnic relation
 *
 * @method     ChildWorkQuery joinWithWorkTechnic($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the WorkTechnic relation
 *
 * @method     ChildWorkQuery leftJoinWithWorkTechnic() Adds a LEFT JOIN clause and with to the query using the WorkTechnic relation
 * @method     ChildWorkQuery rightJoinWithWorkTechnic() Adds a RIGHT JOIN clause and with to the query using the WorkTechnic relation
 * @method     ChildWorkQuery innerJoinWithWorkTechnic() Adds a INNER JOIN clause and with to the query using the WorkTechnic relation
 *
 * @method     ChildWorkQuery leftJoinWorkVersion($relationAlias = null) Adds a LEFT JOIN clause to the query using the WorkVersion relation
 * @method     ChildWorkQuery rightJoinWorkVersion($relationAlias = null) Adds a RIGHT JOIN clause to the query using the WorkVersion relation
 * @method     ChildWorkQuery innerJoinWorkVersion($relationAlias = null) Adds a INNER JOIN clause to the query using the WorkVersion relation
 *
 * @method     ChildWorkQuery joinWithWorkVersion($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the WorkVersion relation
 *
 * @method     ChildWorkQuery leftJoinWithWorkVersion() Adds a LEFT JOIN clause and with to the query using the WorkVersion relation
 * @method     ChildWorkQuery rightJoinWithWorkVersion() Adds a RIGHT JOIN clause and with to the query using the WorkVersion relation
 * @method     ChildWorkQuery innerJoinWithWorkVersion() Adds a INNER JOIN clause and with to the query using the WorkVersion relation
 *
 * @method     \DB\UnitQuery|\DB\WorkMaterialQuery|\DB\WorkTechnicQuery|\DB\WorkVersionQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildWork|null findOne(?ConnectionInterface $con = null) Return the first ChildWork matching the query
 * @method     ChildWork findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildWork matching the query, or a new ChildWork object populated from the query conditions when no match is found
 *
 * @method     ChildWork|null findOneById(int $id) Return the first ChildWork filtered by the id column
 * @method     ChildWork|null findOneByName(string $name) Return the first ChildWork filtered by the name column
 * @method     ChildWork|null findOneByPrice(string $price) Return the first ChildWork filtered by the price column
 * @method     ChildWork|null findOneByAmount(string $amount) Return the first ChildWork filtered by the amount column
 * @method     ChildWork|null findOneByIsAvailable(boolean $is_available) Return the first ChildWork filtered by the is_available column
 * @method     ChildWork|null findOneByUnitId(int $unit_id) Return the first ChildWork filtered by the unit_id column
 * @method     ChildWork|null findOneByVersion(int $version) Return the first ChildWork filtered by the version column
 * @method     ChildWork|null findOneByVersionCreatedAt(string $version_created_at) Return the first ChildWork filtered by the version_created_at column
 * @method     ChildWork|null findOneByVersionCreatedBy(string $version_created_by) Return the first ChildWork filtered by the version_created_by column
 * @method     ChildWork|null findOneByVersionComment(string $version_comment) Return the first ChildWork filtered by the version_comment column *

 * @method     ChildWork requirePk($key, ?ConnectionInterface $con = null) Return the ChildWork by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWork requireOne(?ConnectionInterface $con = null) Return the first ChildWork matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWork requireOneById(int $id) Return the first ChildWork filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWork requireOneByName(string $name) Return the first ChildWork filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWork requireOneByPrice(string $price) Return the first ChildWork filtered by the price column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWork requireOneByAmount(string $amount) Return the first ChildWork filtered by the amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWork requireOneByIsAvailable(boolean $is_available) Return the first ChildWork filtered by the is_available column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWork requireOneByUnitId(int $unit_id) Return the first ChildWork filtered by the unit_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWork requireOneByVersion(int $version) Return the first ChildWork filtered by the version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWork requireOneByVersionCreatedAt(string $version_created_at) Return the first ChildWork filtered by the version_created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWork requireOneByVersionCreatedBy(string $version_created_by) Return the first ChildWork filtered by the version_created_by column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWork requireOneByVersionComment(string $version_comment) Return the first ChildWork filtered by the version_comment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWork[]|Collection find(?ConnectionInterface $con = null) Return ChildWork objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildWork> find(?ConnectionInterface $con = null) Return ChildWork objects based on current ModelCriteria
 * @method     ChildWork[]|Collection findById(int $id) Return ChildWork objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildWork> findById(int $id) Return ChildWork objects filtered by the id column
 * @method     ChildWork[]|Collection findByName(string $name) Return ChildWork objects filtered by the name column
 * @psalm-method Collection&\Traversable<ChildWork> findByName(string $name) Return ChildWork objects filtered by the name column
 * @method     ChildWork[]|Collection findByPrice(string $price) Return ChildWork objects filtered by the price column
 * @psalm-method Collection&\Traversable<ChildWork> findByPrice(string $price) Return ChildWork objects filtered by the price column
 * @method     ChildWork[]|Collection findByAmount(string $amount) Return ChildWork objects filtered by the amount column
 * @psalm-method Collection&\Traversable<ChildWork> findByAmount(string $amount) Return ChildWork objects filtered by the amount column
 * @method     ChildWork[]|Collection findByIsAvailable(boolean $is_available) Return ChildWork objects filtered by the is_available column
 * @psalm-method Collection&\Traversable<ChildWork> findByIsAvailable(boolean $is_available) Return ChildWork objects filtered by the is_available column
 * @method     ChildWork[]|Collection findByUnitId(int $unit_id) Return ChildWork objects filtered by the unit_id column
 * @psalm-method Collection&\Traversable<ChildWork> findByUnitId(int $unit_id) Return ChildWork objects filtered by the unit_id column
 * @method     ChildWork[]|Collection findByVersion(int $version) Return ChildWork objects filtered by the version column
 * @psalm-method Collection&\Traversable<ChildWork> findByVersion(int $version) Return ChildWork objects filtered by the version column
 * @method     ChildWork[]|Collection findByVersionCreatedAt(string $version_created_at) Return ChildWork objects filtered by the version_created_at column
 * @psalm-method Collection&\Traversable<ChildWork> findByVersionCreatedAt(string $version_created_at) Return ChildWork objects filtered by the version_created_at column
 * @method     ChildWork[]|Collection findByVersionCreatedBy(string $version_created_by) Return ChildWork objects filtered by the version_created_by column
 * @psalm-method Collection&\Traversable<ChildWork> findByVersionCreatedBy(string $version_created_by) Return ChildWork objects filtered by the version_created_by column
 * @method     ChildWork[]|Collection findByVersionComment(string $version_comment) Return ChildWork objects filtered by the version_comment column
 * @psalm-method Collection&\Traversable<ChildWork> findByVersionComment(string $version_comment) Return ChildWork objects filtered by the version_comment column
 * @method     ChildWork[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildWork> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class WorkQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \DB\Base\WorkQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\DB\\Work', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildWorkQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildWorkQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildWorkQuery) {
            return $criteria;
        }
        $query = new ChildWorkQuery();
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
     * @return ChildWork|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(WorkTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = WorkTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildWork A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, price, amount, is_available, unit_id, version, version_created_at, version_created_by, version_comment FROM work WHERE id = :p0';
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
            /** @var ChildWork $obj */
            $obj = new ChildWork();
            $obj->hydrate($row);
            WorkTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildWork|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(WorkTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(WorkTableMap::COL_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(WorkTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(WorkTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WorkTableMap::COL_ID, $id, $comparison);

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

        $this->addUsingAlias(WorkTableMap::COL_NAME, $name, $comparison);

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
                $this->addUsingAlias(WorkTableMap::COL_PRICE, $price['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($price['max'])) {
                $this->addUsingAlias(WorkTableMap::COL_PRICE, $price['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WorkTableMap::COL_PRICE, $price, $comparison);

        return $this;
    }

    /**
     * Filter the query on the amount column
     *
     * Example usage:
     * <code>
     * $query->filterByAmount(1234); // WHERE amount = 1234
     * $query->filterByAmount(array(12, 34)); // WHERE amount IN (12, 34)
     * $query->filterByAmount(array('min' => 12)); // WHERE amount > 12
     * </code>
     *
     * @param mixed $amount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAmount($amount = null, ?string $comparison = null)
    {
        if (is_array($amount)) {
            $useMinMax = false;
            if (isset($amount['min'])) {
                $this->addUsingAlias(WorkTableMap::COL_AMOUNT, $amount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($amount['max'])) {
                $this->addUsingAlias(WorkTableMap::COL_AMOUNT, $amount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WorkTableMap::COL_AMOUNT, $amount, $comparison);

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

        $this->addUsingAlias(WorkTableMap::COL_IS_AVAILABLE, $isAvailable, $comparison);

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
     * @see       filterByUnit()
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
                $this->addUsingAlias(WorkTableMap::COL_UNIT_ID, $unitId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($unitId['max'])) {
                $this->addUsingAlias(WorkTableMap::COL_UNIT_ID, $unitId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WorkTableMap::COL_UNIT_ID, $unitId, $comparison);

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
                $this->addUsingAlias(WorkTableMap::COL_VERSION, $version['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($version['max'])) {
                $this->addUsingAlias(WorkTableMap::COL_VERSION, $version['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WorkTableMap::COL_VERSION, $version, $comparison);

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
                $this->addUsingAlias(WorkTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($versionCreatedAt['max'])) {
                $this->addUsingAlias(WorkTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WorkTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt, $comparison);

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

        $this->addUsingAlias(WorkTableMap::COL_VERSION_CREATED_BY, $versionCreatedBy, $comparison);

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

        $this->addUsingAlias(WorkTableMap::COL_VERSION_COMMENT, $versionComment, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \DB\Unit object
     *
     * @param \DB\Unit|ObjectCollection $unit The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUnit($unit, ?string $comparison = null)
    {
        if ($unit instanceof \DB\Unit) {
            return $this
                ->addUsingAlias(WorkTableMap::COL_UNIT_ID, $unit->getId(), $comparison);
        } elseif ($unit instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(WorkTableMap::COL_UNIT_ID, $unit->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByUnit() only accepts arguments of type \DB\Unit or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Unit relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinUnit(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Unit');

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
            $this->addJoinObject($join, 'Unit');
        }

        return $this;
    }

    /**
     * Use the Unit relation Unit object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\UnitQuery A secondary query class using the current class as primary query
     */
    public function useUnitQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUnit($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Unit', '\DB\UnitQuery');
    }

    /**
     * Use the Unit relation Unit object
     *
     * @param callable(\DB\UnitQuery):\DB\UnitQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withUnitQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useUnitQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to Unit table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\UnitQuery The inner query object of the EXISTS statement
     */
    public function useUnitExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('Unit', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to Unit table for a NOT EXISTS query.
     *
     * @see useUnitExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\UnitQuery The inner query object of the NOT EXISTS statement
     */
    public function useUnitNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('Unit', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \DB\WorkMaterial object
     *
     * @param \DB\WorkMaterial|ObjectCollection $workMaterial the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWorkMaterial($workMaterial, ?string $comparison = null)
    {
        if ($workMaterial instanceof \DB\WorkMaterial) {
            $this
                ->addUsingAlias(WorkTableMap::COL_ID, $workMaterial->getWorkId(), $comparison);

            return $this;
        } elseif ($workMaterial instanceof ObjectCollection) {
            $this
                ->useWorkMaterialQuery()
                ->filterByPrimaryKeys($workMaterial->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByWorkMaterial() only accepts arguments of type \DB\WorkMaterial or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the WorkMaterial relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinWorkMaterial(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('WorkMaterial');

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
            $this->addJoinObject($join, 'WorkMaterial');
        }

        return $this;
    }

    /**
     * Use the WorkMaterial relation WorkMaterial object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\WorkMaterialQuery A secondary query class using the current class as primary query
     */
    public function useWorkMaterialQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinWorkMaterial($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'WorkMaterial', '\DB\WorkMaterialQuery');
    }

    /**
     * Use the WorkMaterial relation WorkMaterial object
     *
     * @param callable(\DB\WorkMaterialQuery):\DB\WorkMaterialQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withWorkMaterialQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useWorkMaterialQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to WorkMaterial table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\WorkMaterialQuery The inner query object of the EXISTS statement
     */
    public function useWorkMaterialExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('WorkMaterial', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to WorkMaterial table for a NOT EXISTS query.
     *
     * @see useWorkMaterialExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\WorkMaterialQuery The inner query object of the NOT EXISTS statement
     */
    public function useWorkMaterialNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('WorkMaterial', $modelAlias, $queryClass, 'NOT EXISTS');
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
                ->addUsingAlias(WorkTableMap::COL_ID, $workTechnic->getWorkId(), $comparison);

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
     * Filter the query by a related \DB\WorkVersion object
     *
     * @param \DB\WorkVersion|ObjectCollection $workVersion the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWorkVersion($workVersion, ?string $comparison = null)
    {
        if ($workVersion instanceof \DB\WorkVersion) {
            $this
                ->addUsingAlias(WorkTableMap::COL_ID, $workVersion->getId(), $comparison);

            return $this;
        } elseif ($workVersion instanceof ObjectCollection) {
            $this
                ->useWorkVersionQuery()
                ->filterByPrimaryKeys($workVersion->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByWorkVersion() only accepts arguments of type \DB\WorkVersion or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the WorkVersion relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinWorkVersion(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('WorkVersion');

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
            $this->addJoinObject($join, 'WorkVersion');
        }

        return $this;
    }

    /**
     * Use the WorkVersion relation WorkVersion object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\WorkVersionQuery A secondary query class using the current class as primary query
     */
    public function useWorkVersionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinWorkVersion($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'WorkVersion', '\DB\WorkVersionQuery');
    }

    /**
     * Use the WorkVersion relation WorkVersion object
     *
     * @param callable(\DB\WorkVersionQuery):\DB\WorkVersionQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withWorkVersionQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useWorkVersionQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to WorkVersion table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\WorkVersionQuery The inner query object of the EXISTS statement
     */
    public function useWorkVersionExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('WorkVersion', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to WorkVersion table for a NOT EXISTS query.
     *
     * @see useWorkVersionExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\WorkVersionQuery The inner query object of the NOT EXISTS statement
     */
    public function useWorkVersionNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('WorkVersion', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Exclude object from result
     *
     * @param ChildWork $work Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($work = null)
    {
        if ($work) {
            $this->addUsingAlias(WorkTableMap::COL_ID, $work->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the work table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(WorkTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            WorkTableMap::clearInstancePool();
            WorkTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(WorkTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(WorkTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            WorkTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            WorkTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
