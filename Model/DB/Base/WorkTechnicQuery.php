<?php

namespace DB\Base;

use \Exception;
use \PDO;
use DB\WorkTechnic as ChildWorkTechnic;
use DB\WorkTechnicQuery as ChildWorkTechnicQuery;
use DB\Map\WorkTechnicTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'work_technic' table.
 *
 *
 *
 * @method     ChildWorkTechnicQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildWorkTechnicQuery orderByWorkId($order = Criteria::ASC) Order by the work_id column
 * @method     ChildWorkTechnicQuery orderByTechnicId($order = Criteria::ASC) Order by the technic_id column
 * @method     ChildWorkTechnicQuery orderByAmount($order = Criteria::ASC) Order by the amount column
 * @method     ChildWorkTechnicQuery orderByVersion($order = Criteria::ASC) Order by the version column
 * @method     ChildWorkTechnicQuery orderByVersionCreatedAt($order = Criteria::ASC) Order by the version_created_at column
 * @method     ChildWorkTechnicQuery orderByVersionCreatedBy($order = Criteria::ASC) Order by the version_created_by column
 * @method     ChildWorkTechnicQuery orderByVersionComment($order = Criteria::ASC) Order by the version_comment column
 *
 * @method     ChildWorkTechnicQuery groupById() Group by the id column
 * @method     ChildWorkTechnicQuery groupByWorkId() Group by the work_id column
 * @method     ChildWorkTechnicQuery groupByTechnicId() Group by the technic_id column
 * @method     ChildWorkTechnicQuery groupByAmount() Group by the amount column
 * @method     ChildWorkTechnicQuery groupByVersion() Group by the version column
 * @method     ChildWorkTechnicQuery groupByVersionCreatedAt() Group by the version_created_at column
 * @method     ChildWorkTechnicQuery groupByVersionCreatedBy() Group by the version_created_by column
 * @method     ChildWorkTechnicQuery groupByVersionComment() Group by the version_comment column
 *
 * @method     ChildWorkTechnicQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildWorkTechnicQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildWorkTechnicQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildWorkTechnicQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildWorkTechnicQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildWorkTechnicQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildWorkTechnicQuery leftJoinWork($relationAlias = null) Adds a LEFT JOIN clause to the query using the Work relation
 * @method     ChildWorkTechnicQuery rightJoinWork($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Work relation
 * @method     ChildWorkTechnicQuery innerJoinWork($relationAlias = null) Adds a INNER JOIN clause to the query using the Work relation
 *
 * @method     ChildWorkTechnicQuery joinWithWork($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Work relation
 *
 * @method     ChildWorkTechnicQuery leftJoinWithWork() Adds a LEFT JOIN clause and with to the query using the Work relation
 * @method     ChildWorkTechnicQuery rightJoinWithWork() Adds a RIGHT JOIN clause and with to the query using the Work relation
 * @method     ChildWorkTechnicQuery innerJoinWithWork() Adds a INNER JOIN clause and with to the query using the Work relation
 *
 * @method     ChildWorkTechnicQuery leftJoinTechnic($relationAlias = null) Adds a LEFT JOIN clause to the query using the Technic relation
 * @method     ChildWorkTechnicQuery rightJoinTechnic($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Technic relation
 * @method     ChildWorkTechnicQuery innerJoinTechnic($relationAlias = null) Adds a INNER JOIN clause to the query using the Technic relation
 *
 * @method     ChildWorkTechnicQuery joinWithTechnic($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Technic relation
 *
 * @method     ChildWorkTechnicQuery leftJoinWithTechnic() Adds a LEFT JOIN clause and with to the query using the Technic relation
 * @method     ChildWorkTechnicQuery rightJoinWithTechnic() Adds a RIGHT JOIN clause and with to the query using the Technic relation
 * @method     ChildWorkTechnicQuery innerJoinWithTechnic() Adds a INNER JOIN clause and with to the query using the Technic relation
 *
 * @method     ChildWorkTechnicQuery leftJoinWorkTechnicVersion($relationAlias = null) Adds a LEFT JOIN clause to the query using the WorkTechnicVersion relation
 * @method     ChildWorkTechnicQuery rightJoinWorkTechnicVersion($relationAlias = null) Adds a RIGHT JOIN clause to the query using the WorkTechnicVersion relation
 * @method     ChildWorkTechnicQuery innerJoinWorkTechnicVersion($relationAlias = null) Adds a INNER JOIN clause to the query using the WorkTechnicVersion relation
 *
 * @method     ChildWorkTechnicQuery joinWithWorkTechnicVersion($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the WorkTechnicVersion relation
 *
 * @method     ChildWorkTechnicQuery leftJoinWithWorkTechnicVersion() Adds a LEFT JOIN clause and with to the query using the WorkTechnicVersion relation
 * @method     ChildWorkTechnicQuery rightJoinWithWorkTechnicVersion() Adds a RIGHT JOIN clause and with to the query using the WorkTechnicVersion relation
 * @method     ChildWorkTechnicQuery innerJoinWithWorkTechnicVersion() Adds a INNER JOIN clause and with to the query using the WorkTechnicVersion relation
 *
 * @method     \DB\WorkQuery|\DB\TechnicQuery|\DB\WorkTechnicVersionQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildWorkTechnic|null findOne(?ConnectionInterface $con = null) Return the first ChildWorkTechnic matching the query
 * @method     ChildWorkTechnic findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildWorkTechnic matching the query, or a new ChildWorkTechnic object populated from the query conditions when no match is found
 *
 * @method     ChildWorkTechnic|null findOneById(int $id) Return the first ChildWorkTechnic filtered by the id column
 * @method     ChildWorkTechnic|null findOneByWorkId(int $work_id) Return the first ChildWorkTechnic filtered by the work_id column
 * @method     ChildWorkTechnic|null findOneByTechnicId(int $technic_id) Return the first ChildWorkTechnic filtered by the technic_id column
 * @method     ChildWorkTechnic|null findOneByAmount(string $amount) Return the first ChildWorkTechnic filtered by the amount column
 * @method     ChildWorkTechnic|null findOneByVersion(int $version) Return the first ChildWorkTechnic filtered by the version column
 * @method     ChildWorkTechnic|null findOneByVersionCreatedAt(string $version_created_at) Return the first ChildWorkTechnic filtered by the version_created_at column
 * @method     ChildWorkTechnic|null findOneByVersionCreatedBy(string $version_created_by) Return the first ChildWorkTechnic filtered by the version_created_by column
 * @method     ChildWorkTechnic|null findOneByVersionComment(string $version_comment) Return the first ChildWorkTechnic filtered by the version_comment column *

 * @method     ChildWorkTechnic requirePk($key, ?ConnectionInterface $con = null) Return the ChildWorkTechnic by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWorkTechnic requireOne(?ConnectionInterface $con = null) Return the first ChildWorkTechnic matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWorkTechnic requireOneById(int $id) Return the first ChildWorkTechnic filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWorkTechnic requireOneByWorkId(int $work_id) Return the first ChildWorkTechnic filtered by the work_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWorkTechnic requireOneByTechnicId(int $technic_id) Return the first ChildWorkTechnic filtered by the technic_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWorkTechnic requireOneByAmount(string $amount) Return the first ChildWorkTechnic filtered by the amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWorkTechnic requireOneByVersion(int $version) Return the first ChildWorkTechnic filtered by the version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWorkTechnic requireOneByVersionCreatedAt(string $version_created_at) Return the first ChildWorkTechnic filtered by the version_created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWorkTechnic requireOneByVersionCreatedBy(string $version_created_by) Return the first ChildWorkTechnic filtered by the version_created_by column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWorkTechnic requireOneByVersionComment(string $version_comment) Return the first ChildWorkTechnic filtered by the version_comment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWorkTechnic[]|Collection find(?ConnectionInterface $con = null) Return ChildWorkTechnic objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildWorkTechnic> find(?ConnectionInterface $con = null) Return ChildWorkTechnic objects based on current ModelCriteria
 * @method     ChildWorkTechnic[]|Collection findById(int $id) Return ChildWorkTechnic objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildWorkTechnic> findById(int $id) Return ChildWorkTechnic objects filtered by the id column
 * @method     ChildWorkTechnic[]|Collection findByWorkId(int $work_id) Return ChildWorkTechnic objects filtered by the work_id column
 * @psalm-method Collection&\Traversable<ChildWorkTechnic> findByWorkId(int $work_id) Return ChildWorkTechnic objects filtered by the work_id column
 * @method     ChildWorkTechnic[]|Collection findByTechnicId(int $technic_id) Return ChildWorkTechnic objects filtered by the technic_id column
 * @psalm-method Collection&\Traversable<ChildWorkTechnic> findByTechnicId(int $technic_id) Return ChildWorkTechnic objects filtered by the technic_id column
 * @method     ChildWorkTechnic[]|Collection findByAmount(string $amount) Return ChildWorkTechnic objects filtered by the amount column
 * @psalm-method Collection&\Traversable<ChildWorkTechnic> findByAmount(string $amount) Return ChildWorkTechnic objects filtered by the amount column
 * @method     ChildWorkTechnic[]|Collection findByVersion(int $version) Return ChildWorkTechnic objects filtered by the version column
 * @psalm-method Collection&\Traversable<ChildWorkTechnic> findByVersion(int $version) Return ChildWorkTechnic objects filtered by the version column
 * @method     ChildWorkTechnic[]|Collection findByVersionCreatedAt(string $version_created_at) Return ChildWorkTechnic objects filtered by the version_created_at column
 * @psalm-method Collection&\Traversable<ChildWorkTechnic> findByVersionCreatedAt(string $version_created_at) Return ChildWorkTechnic objects filtered by the version_created_at column
 * @method     ChildWorkTechnic[]|Collection findByVersionCreatedBy(string $version_created_by) Return ChildWorkTechnic objects filtered by the version_created_by column
 * @psalm-method Collection&\Traversable<ChildWorkTechnic> findByVersionCreatedBy(string $version_created_by) Return ChildWorkTechnic objects filtered by the version_created_by column
 * @method     ChildWorkTechnic[]|Collection findByVersionComment(string $version_comment) Return ChildWorkTechnic objects filtered by the version_comment column
 * @psalm-method Collection&\Traversable<ChildWorkTechnic> findByVersionComment(string $version_comment) Return ChildWorkTechnic objects filtered by the version_comment column
 * @method     ChildWorkTechnic[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildWorkTechnic> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class WorkTechnicQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \DB\Base\WorkTechnicQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\DB\\WorkTechnic', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildWorkTechnicQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildWorkTechnicQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildWorkTechnicQuery) {
            return $criteria;
        }
        $query = new ChildWorkTechnicQuery();
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
     * @return ChildWorkTechnic|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(WorkTechnicTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = WorkTechnicTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildWorkTechnic A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, work_id, technic_id, amount, version, version_created_at, version_created_by, version_comment FROM work_technic WHERE id = :p0';
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
            /** @var ChildWorkTechnic $obj */
            $obj = new ChildWorkTechnic();
            $obj->hydrate($row);
            WorkTechnicTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildWorkTechnic|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(WorkTechnicTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(WorkTechnicTableMap::COL_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(WorkTechnicTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(WorkTechnicTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WorkTechnicTableMap::COL_ID, $id, $comparison);

        return $this;
    }

    /**
     * Filter the query on the work_id column
     *
     * Example usage:
     * <code>
     * $query->filterByWorkId(1234); // WHERE work_id = 1234
     * $query->filterByWorkId(array(12, 34)); // WHERE work_id IN (12, 34)
     * $query->filterByWorkId(array('min' => 12)); // WHERE work_id > 12
     * </code>
     *
     * @see       filterByWork()
     *
     * @param mixed $workId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWorkId($workId = null, ?string $comparison = null)
    {
        if (is_array($workId)) {
            $useMinMax = false;
            if (isset($workId['min'])) {
                $this->addUsingAlias(WorkTechnicTableMap::COL_WORK_ID, $workId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($workId['max'])) {
                $this->addUsingAlias(WorkTechnicTableMap::COL_WORK_ID, $workId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WorkTechnicTableMap::COL_WORK_ID, $workId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the technic_id column
     *
     * Example usage:
     * <code>
     * $query->filterByTechnicId(1234); // WHERE technic_id = 1234
     * $query->filterByTechnicId(array(12, 34)); // WHERE technic_id IN (12, 34)
     * $query->filterByTechnicId(array('min' => 12)); // WHERE technic_id > 12
     * </code>
     *
     * @see       filterByTechnic()
     *
     * @param mixed $technicId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTechnicId($technicId = null, ?string $comparison = null)
    {
        if (is_array($technicId)) {
            $useMinMax = false;
            if (isset($technicId['min'])) {
                $this->addUsingAlias(WorkTechnicTableMap::COL_TECHNIC_ID, $technicId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($technicId['max'])) {
                $this->addUsingAlias(WorkTechnicTableMap::COL_TECHNIC_ID, $technicId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WorkTechnicTableMap::COL_TECHNIC_ID, $technicId, $comparison);

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
                $this->addUsingAlias(WorkTechnicTableMap::COL_AMOUNT, $amount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($amount['max'])) {
                $this->addUsingAlias(WorkTechnicTableMap::COL_AMOUNT, $amount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WorkTechnicTableMap::COL_AMOUNT, $amount, $comparison);

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
                $this->addUsingAlias(WorkTechnicTableMap::COL_VERSION, $version['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($version['max'])) {
                $this->addUsingAlias(WorkTechnicTableMap::COL_VERSION, $version['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WorkTechnicTableMap::COL_VERSION, $version, $comparison);

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
                $this->addUsingAlias(WorkTechnicTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($versionCreatedAt['max'])) {
                $this->addUsingAlias(WorkTechnicTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WorkTechnicTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt, $comparison);

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

        $this->addUsingAlias(WorkTechnicTableMap::COL_VERSION_CREATED_BY, $versionCreatedBy, $comparison);

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

        $this->addUsingAlias(WorkTechnicTableMap::COL_VERSION_COMMENT, $versionComment, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \DB\Work object
     *
     * @param \DB\Work|ObjectCollection $work The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWork($work, ?string $comparison = null)
    {
        if ($work instanceof \DB\Work) {
            return $this
                ->addUsingAlias(WorkTechnicTableMap::COL_WORK_ID, $work->getId(), $comparison);
        } elseif ($work instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(WorkTechnicTableMap::COL_WORK_ID, $work->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByWork() only accepts arguments of type \DB\Work or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Work relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinWork(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Work');

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
            $this->addJoinObject($join, 'Work');
        }

        return $this;
    }

    /**
     * Use the Work relation Work object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\WorkQuery A secondary query class using the current class as primary query
     */
    public function useWorkQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinWork($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Work', '\DB\WorkQuery');
    }

    /**
     * Use the Work relation Work object
     *
     * @param callable(\DB\WorkQuery):\DB\WorkQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withWorkQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useWorkQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to Work table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\WorkQuery The inner query object of the EXISTS statement
     */
    public function useWorkExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('Work', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to Work table for a NOT EXISTS query.
     *
     * @see useWorkExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\WorkQuery The inner query object of the NOT EXISTS statement
     */
    public function useWorkNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('Work', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \DB\Technic object
     *
     * @param \DB\Technic|ObjectCollection $technic The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTechnic($technic, ?string $comparison = null)
    {
        if ($technic instanceof \DB\Technic) {
            return $this
                ->addUsingAlias(WorkTechnicTableMap::COL_TECHNIC_ID, $technic->getId(), $comparison);
        } elseif ($technic instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(WorkTechnicTableMap::COL_TECHNIC_ID, $technic->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByTechnic() only accepts arguments of type \DB\Technic or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Technic relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinTechnic(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Technic');

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
            $this->addJoinObject($join, 'Technic');
        }

        return $this;
    }

    /**
     * Use the Technic relation Technic object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\TechnicQuery A secondary query class using the current class as primary query
     */
    public function useTechnicQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTechnic($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Technic', '\DB\TechnicQuery');
    }

    /**
     * Use the Technic relation Technic object
     *
     * @param callable(\DB\TechnicQuery):\DB\TechnicQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withTechnicQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useTechnicQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to Technic table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\TechnicQuery The inner query object of the EXISTS statement
     */
    public function useTechnicExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('Technic', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to Technic table for a NOT EXISTS query.
     *
     * @see useTechnicExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\TechnicQuery The inner query object of the NOT EXISTS statement
     */
    public function useTechnicNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('Technic', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \DB\WorkTechnicVersion object
     *
     * @param \DB\WorkTechnicVersion|ObjectCollection $workTechnicVersion the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWorkTechnicVersion($workTechnicVersion, ?string $comparison = null)
    {
        if ($workTechnicVersion instanceof \DB\WorkTechnicVersion) {
            $this
                ->addUsingAlias(WorkTechnicTableMap::COL_ID, $workTechnicVersion->getId(), $comparison);

            return $this;
        } elseif ($workTechnicVersion instanceof ObjectCollection) {
            $this
                ->useWorkTechnicVersionQuery()
                ->filterByPrimaryKeys($workTechnicVersion->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByWorkTechnicVersion() only accepts arguments of type \DB\WorkTechnicVersion or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the WorkTechnicVersion relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinWorkTechnicVersion(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('WorkTechnicVersion');

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
            $this->addJoinObject($join, 'WorkTechnicVersion');
        }

        return $this;
    }

    /**
     * Use the WorkTechnicVersion relation WorkTechnicVersion object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\WorkTechnicVersionQuery A secondary query class using the current class as primary query
     */
    public function useWorkTechnicVersionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinWorkTechnicVersion($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'WorkTechnicVersion', '\DB\WorkTechnicVersionQuery');
    }

    /**
     * Use the WorkTechnicVersion relation WorkTechnicVersion object
     *
     * @param callable(\DB\WorkTechnicVersionQuery):\DB\WorkTechnicVersionQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withWorkTechnicVersionQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useWorkTechnicVersionQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to WorkTechnicVersion table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\WorkTechnicVersionQuery The inner query object of the EXISTS statement
     */
    public function useWorkTechnicVersionExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('WorkTechnicVersion', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to WorkTechnicVersion table for a NOT EXISTS query.
     *
     * @see useWorkTechnicVersionExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\WorkTechnicVersionQuery The inner query object of the NOT EXISTS statement
     */
    public function useWorkTechnicVersionNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('WorkTechnicVersion', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Exclude object from result
     *
     * @param ChildWorkTechnic $workTechnic Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($workTechnic = null)
    {
        if ($workTechnic) {
            $this->addUsingAlias(WorkTechnicTableMap::COL_ID, $workTechnic->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the work_technic table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(WorkTechnicTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            WorkTechnicTableMap::clearInstancePool();
            WorkTechnicTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(WorkTechnicTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(WorkTechnicTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            WorkTechnicTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            WorkTechnicTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
