<?php

namespace DB\Base;

use \Exception;
use \PDO;
use DB\WorkTechnicVersion as ChildWorkTechnicVersion;
use DB\WorkTechnicVersionQuery as ChildWorkTechnicVersionQuery;
use DB\Map\WorkTechnicVersionTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'work_technic_version' table.
 *
 *
 *
 * @method     ChildWorkTechnicVersionQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildWorkTechnicVersionQuery orderByTechnicId($order = Criteria::ASC) Order by the technic_id column
 * @method     ChildWorkTechnicVersionQuery orderByWorkId($order = Criteria::ASC) Order by the work_id column
 * @method     ChildWorkTechnicVersionQuery orderByAmount($order = Criteria::ASC) Order by the amount column
 * @method     ChildWorkTechnicVersionQuery orderByVersion($order = Criteria::ASC) Order by the version column
 * @method     ChildWorkTechnicVersionQuery orderByTechnicIdVersion($order = Criteria::ASC) Order by the technic_id_version column
 * @method     ChildWorkTechnicVersionQuery orderByWorkIdVersion($order = Criteria::ASC) Order by the work_id_version column
 *
 * @method     ChildWorkTechnicVersionQuery groupById() Group by the id column
 * @method     ChildWorkTechnicVersionQuery groupByTechnicId() Group by the technic_id column
 * @method     ChildWorkTechnicVersionQuery groupByWorkId() Group by the work_id column
 * @method     ChildWorkTechnicVersionQuery groupByAmount() Group by the amount column
 * @method     ChildWorkTechnicVersionQuery groupByVersion() Group by the version column
 * @method     ChildWorkTechnicVersionQuery groupByTechnicIdVersion() Group by the technic_id_version column
 * @method     ChildWorkTechnicVersionQuery groupByWorkIdVersion() Group by the work_id_version column
 *
 * @method     ChildWorkTechnicVersionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildWorkTechnicVersionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildWorkTechnicVersionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildWorkTechnicVersionQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildWorkTechnicVersionQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildWorkTechnicVersionQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildWorkTechnicVersionQuery leftJoinWorkTechnic($relationAlias = null) Adds a LEFT JOIN clause to the query using the WorkTechnic relation
 * @method     ChildWorkTechnicVersionQuery rightJoinWorkTechnic($relationAlias = null) Adds a RIGHT JOIN clause to the query using the WorkTechnic relation
 * @method     ChildWorkTechnicVersionQuery innerJoinWorkTechnic($relationAlias = null) Adds a INNER JOIN clause to the query using the WorkTechnic relation
 *
 * @method     ChildWorkTechnicVersionQuery joinWithWorkTechnic($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the WorkTechnic relation
 *
 * @method     ChildWorkTechnicVersionQuery leftJoinWithWorkTechnic() Adds a LEFT JOIN clause and with to the query using the WorkTechnic relation
 * @method     ChildWorkTechnicVersionQuery rightJoinWithWorkTechnic() Adds a RIGHT JOIN clause and with to the query using the WorkTechnic relation
 * @method     ChildWorkTechnicVersionQuery innerJoinWithWorkTechnic() Adds a INNER JOIN clause and with to the query using the WorkTechnic relation
 *
 * @method     \DB\WorkTechnicQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildWorkTechnicVersion|null findOne(?ConnectionInterface $con = null) Return the first ChildWorkTechnicVersion matching the query
 * @method     ChildWorkTechnicVersion findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildWorkTechnicVersion matching the query, or a new ChildWorkTechnicVersion object populated from the query conditions when no match is found
 *
 * @method     ChildWorkTechnicVersion|null findOneById(int $id) Return the first ChildWorkTechnicVersion filtered by the id column
 * @method     ChildWorkTechnicVersion|null findOneByTechnicId(int $technic_id) Return the first ChildWorkTechnicVersion filtered by the technic_id column
 * @method     ChildWorkTechnicVersion|null findOneByWorkId(int $work_id) Return the first ChildWorkTechnicVersion filtered by the work_id column
 * @method     ChildWorkTechnicVersion|null findOneByAmount(string $amount) Return the first ChildWorkTechnicVersion filtered by the amount column
 * @method     ChildWorkTechnicVersion|null findOneByVersion(int $version) Return the first ChildWorkTechnicVersion filtered by the version column
 * @method     ChildWorkTechnicVersion|null findOneByTechnicIdVersion(int $technic_id_version) Return the first ChildWorkTechnicVersion filtered by the technic_id_version column
 * @method     ChildWorkTechnicVersion|null findOneByWorkIdVersion(int $work_id_version) Return the first ChildWorkTechnicVersion filtered by the work_id_version column *

 * @method     ChildWorkTechnicVersion requirePk($key, ?ConnectionInterface $con = null) Return the ChildWorkTechnicVersion by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWorkTechnicVersion requireOne(?ConnectionInterface $con = null) Return the first ChildWorkTechnicVersion matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWorkTechnicVersion requireOneById(int $id) Return the first ChildWorkTechnicVersion filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWorkTechnicVersion requireOneByTechnicId(int $technic_id) Return the first ChildWorkTechnicVersion filtered by the technic_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWorkTechnicVersion requireOneByWorkId(int $work_id) Return the first ChildWorkTechnicVersion filtered by the work_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWorkTechnicVersion requireOneByAmount(string $amount) Return the first ChildWorkTechnicVersion filtered by the amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWorkTechnicVersion requireOneByVersion(int $version) Return the first ChildWorkTechnicVersion filtered by the version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWorkTechnicVersion requireOneByTechnicIdVersion(int $technic_id_version) Return the first ChildWorkTechnicVersion filtered by the technic_id_version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWorkTechnicVersion requireOneByWorkIdVersion(int $work_id_version) Return the first ChildWorkTechnicVersion filtered by the work_id_version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWorkTechnicVersion[]|Collection find(?ConnectionInterface $con = null) Return ChildWorkTechnicVersion objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildWorkTechnicVersion> find(?ConnectionInterface $con = null) Return ChildWorkTechnicVersion objects based on current ModelCriteria
 * @method     ChildWorkTechnicVersion[]|Collection findById(int $id) Return ChildWorkTechnicVersion objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildWorkTechnicVersion> findById(int $id) Return ChildWorkTechnicVersion objects filtered by the id column
 * @method     ChildWorkTechnicVersion[]|Collection findByTechnicId(int $technic_id) Return ChildWorkTechnicVersion objects filtered by the technic_id column
 * @psalm-method Collection&\Traversable<ChildWorkTechnicVersion> findByTechnicId(int $technic_id) Return ChildWorkTechnicVersion objects filtered by the technic_id column
 * @method     ChildWorkTechnicVersion[]|Collection findByWorkId(int $work_id) Return ChildWorkTechnicVersion objects filtered by the work_id column
 * @psalm-method Collection&\Traversable<ChildWorkTechnicVersion> findByWorkId(int $work_id) Return ChildWorkTechnicVersion objects filtered by the work_id column
 * @method     ChildWorkTechnicVersion[]|Collection findByAmount(string $amount) Return ChildWorkTechnicVersion objects filtered by the amount column
 * @psalm-method Collection&\Traversable<ChildWorkTechnicVersion> findByAmount(string $amount) Return ChildWorkTechnicVersion objects filtered by the amount column
 * @method     ChildWorkTechnicVersion[]|Collection findByVersion(int $version) Return ChildWorkTechnicVersion objects filtered by the version column
 * @psalm-method Collection&\Traversable<ChildWorkTechnicVersion> findByVersion(int $version) Return ChildWorkTechnicVersion objects filtered by the version column
 * @method     ChildWorkTechnicVersion[]|Collection findByTechnicIdVersion(int $technic_id_version) Return ChildWorkTechnicVersion objects filtered by the technic_id_version column
 * @psalm-method Collection&\Traversable<ChildWorkTechnicVersion> findByTechnicIdVersion(int $technic_id_version) Return ChildWorkTechnicVersion objects filtered by the technic_id_version column
 * @method     ChildWorkTechnicVersion[]|Collection findByWorkIdVersion(int $work_id_version) Return ChildWorkTechnicVersion objects filtered by the work_id_version column
 * @psalm-method Collection&\Traversable<ChildWorkTechnicVersion> findByWorkIdVersion(int $work_id_version) Return ChildWorkTechnicVersion objects filtered by the work_id_version column
 * @method     ChildWorkTechnicVersion[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildWorkTechnicVersion> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class WorkTechnicVersionQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \DB\Base\WorkTechnicVersionQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\DB\\WorkTechnicVersion', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildWorkTechnicVersionQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildWorkTechnicVersionQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildWorkTechnicVersionQuery) {
            return $criteria;
        }
        $query = new ChildWorkTechnicVersionQuery();
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
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array[$id, $version] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildWorkTechnicVersion|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(WorkTechnicVersionTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = WorkTechnicVersionTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildWorkTechnicVersion A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, technic_id, work_id, amount, version, technic_id_version, work_id_version FROM work_technic_version WHERE id = :p0 AND version = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildWorkTechnicVersion $obj */
            $obj = new ChildWorkTechnicVersion();
            $obj->hydrate($row);
            WorkTechnicVersionTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildWorkTechnicVersion|array|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
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
        $this->addUsingAlias(WorkTechnicVersionTableMap::COL_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(WorkTechnicVersionTableMap::COL_VERSION, $key[1], Criteria::EQUAL);

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
        if (empty($keys)) {
            $this->add(null, '1<>1', Criteria::CUSTOM);

            return $this;
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(WorkTechnicVersionTableMap::COL_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(WorkTechnicVersionTableMap::COL_VERSION, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

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
     * @see       filterByWorkTechnic()
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
                $this->addUsingAlias(WorkTechnicVersionTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(WorkTechnicVersionTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WorkTechnicVersionTableMap::COL_ID, $id, $comparison);

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
                $this->addUsingAlias(WorkTechnicVersionTableMap::COL_TECHNIC_ID, $technicId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($technicId['max'])) {
                $this->addUsingAlias(WorkTechnicVersionTableMap::COL_TECHNIC_ID, $technicId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WorkTechnicVersionTableMap::COL_TECHNIC_ID, $technicId, $comparison);

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
                $this->addUsingAlias(WorkTechnicVersionTableMap::COL_WORK_ID, $workId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($workId['max'])) {
                $this->addUsingAlias(WorkTechnicVersionTableMap::COL_WORK_ID, $workId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WorkTechnicVersionTableMap::COL_WORK_ID, $workId, $comparison);

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
                $this->addUsingAlias(WorkTechnicVersionTableMap::COL_AMOUNT, $amount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($amount['max'])) {
                $this->addUsingAlias(WorkTechnicVersionTableMap::COL_AMOUNT, $amount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WorkTechnicVersionTableMap::COL_AMOUNT, $amount, $comparison);

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
                $this->addUsingAlias(WorkTechnicVersionTableMap::COL_VERSION, $version['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($version['max'])) {
                $this->addUsingAlias(WorkTechnicVersionTableMap::COL_VERSION, $version['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WorkTechnicVersionTableMap::COL_VERSION, $version, $comparison);

        return $this;
    }

    /**
     * Filter the query on the technic_id_version column
     *
     * Example usage:
     * <code>
     * $query->filterByTechnicIdVersion(1234); // WHERE technic_id_version = 1234
     * $query->filterByTechnicIdVersion(array(12, 34)); // WHERE technic_id_version IN (12, 34)
     * $query->filterByTechnicIdVersion(array('min' => 12)); // WHERE technic_id_version > 12
     * </code>
     *
     * @param mixed $technicIdVersion The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTechnicIdVersion($technicIdVersion = null, ?string $comparison = null)
    {
        if (is_array($technicIdVersion)) {
            $useMinMax = false;
            if (isset($technicIdVersion['min'])) {
                $this->addUsingAlias(WorkTechnicVersionTableMap::COL_TECHNIC_ID_VERSION, $technicIdVersion['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($technicIdVersion['max'])) {
                $this->addUsingAlias(WorkTechnicVersionTableMap::COL_TECHNIC_ID_VERSION, $technicIdVersion['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WorkTechnicVersionTableMap::COL_TECHNIC_ID_VERSION, $technicIdVersion, $comparison);

        return $this;
    }

    /**
     * Filter the query on the work_id_version column
     *
     * Example usage:
     * <code>
     * $query->filterByWorkIdVersion(1234); // WHERE work_id_version = 1234
     * $query->filterByWorkIdVersion(array(12, 34)); // WHERE work_id_version IN (12, 34)
     * $query->filterByWorkIdVersion(array('min' => 12)); // WHERE work_id_version > 12
     * </code>
     *
     * @param mixed $workIdVersion The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWorkIdVersion($workIdVersion = null, ?string $comparison = null)
    {
        if (is_array($workIdVersion)) {
            $useMinMax = false;
            if (isset($workIdVersion['min'])) {
                $this->addUsingAlias(WorkTechnicVersionTableMap::COL_WORK_ID_VERSION, $workIdVersion['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($workIdVersion['max'])) {
                $this->addUsingAlias(WorkTechnicVersionTableMap::COL_WORK_ID_VERSION, $workIdVersion['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WorkTechnicVersionTableMap::COL_WORK_ID_VERSION, $workIdVersion, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \DB\WorkTechnic object
     *
     * @param \DB\WorkTechnic|ObjectCollection $workTechnic The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWorkTechnic($workTechnic, ?string $comparison = null)
    {
        if ($workTechnic instanceof \DB\WorkTechnic) {
            return $this
                ->addUsingAlias(WorkTechnicVersionTableMap::COL_ID, $workTechnic->getId(), $comparison);
        } elseif ($workTechnic instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(WorkTechnicVersionTableMap::COL_ID, $workTechnic->toKeyValue('PrimaryKey', 'Id'), $comparison);

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
     * Exclude object from result
     *
     * @param ChildWorkTechnicVersion $workTechnicVersion Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($workTechnicVersion = null)
    {
        if ($workTechnicVersion) {
            $this->addCond('pruneCond0', $this->getAliasedColName(WorkTechnicVersionTableMap::COL_ID), $workTechnicVersion->getId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(WorkTechnicVersionTableMap::COL_VERSION), $workTechnicVersion->getVersion(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the work_technic_version table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(WorkTechnicVersionTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            WorkTechnicVersionTableMap::clearInstancePool();
            WorkTechnicVersionTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(WorkTechnicVersionTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(WorkTechnicVersionTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            WorkTechnicVersionTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            WorkTechnicVersionTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
