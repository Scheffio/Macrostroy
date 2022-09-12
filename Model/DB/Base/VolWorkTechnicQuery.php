<?php

namespace DB\Base;

use \Exception;
use \PDO;
use DB\VolWorkTechnic as ChildVolWorkTechnic;
use DB\VolWorkTechnicQuery as ChildVolWorkTechnicQuery;
use DB\Map\VolWorkTechnicTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'vol_work_technic' table.
 *
 *
 *
 * @method     ChildVolWorkTechnicQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildVolWorkTechnicQuery orderByAmount($order = Criteria::ASC) Order by the amount column
 * @method     ChildVolWorkTechnicQuery orderByWorkId($order = Criteria::ASC) Order by the work_id column
 * @method     ChildVolWorkTechnicQuery orderByTechnicId($order = Criteria::ASC) Order by the technic_id column
 * @method     ChildVolWorkTechnicQuery orderByVersion($order = Criteria::ASC) Order by the version column
 * @method     ChildVolWorkTechnicQuery orderByVersionCreatedAt($order = Criteria::ASC) Order by the version_created_at column
 * @method     ChildVolWorkTechnicQuery orderByVersionCreatedBy($order = Criteria::ASC) Order by the version_created_by column
 * @method     ChildVolWorkTechnicQuery orderByVersionComment($order = Criteria::ASC) Order by the version_comment column
 *
 * @method     ChildVolWorkTechnicQuery groupById() Group by the id column
 * @method     ChildVolWorkTechnicQuery groupByAmount() Group by the amount column
 * @method     ChildVolWorkTechnicQuery groupByWorkId() Group by the work_id column
 * @method     ChildVolWorkTechnicQuery groupByTechnicId() Group by the technic_id column
 * @method     ChildVolWorkTechnicQuery groupByVersion() Group by the version column
 * @method     ChildVolWorkTechnicQuery groupByVersionCreatedAt() Group by the version_created_at column
 * @method     ChildVolWorkTechnicQuery groupByVersionCreatedBy() Group by the version_created_by column
 * @method     ChildVolWorkTechnicQuery groupByVersionComment() Group by the version_comment column
 *
 * @method     ChildVolWorkTechnicQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildVolWorkTechnicQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildVolWorkTechnicQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildVolWorkTechnicQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildVolWorkTechnicQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildVolWorkTechnicQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildVolWorkTechnicQuery leftJoinVolWork($relationAlias = null) Adds a LEFT JOIN clause to the query using the VolWork relation
 * @method     ChildVolWorkTechnicQuery rightJoinVolWork($relationAlias = null) Adds a RIGHT JOIN clause to the query using the VolWork relation
 * @method     ChildVolWorkTechnicQuery innerJoinVolWork($relationAlias = null) Adds a INNER JOIN clause to the query using the VolWork relation
 *
 * @method     ChildVolWorkTechnicQuery joinWithVolWork($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the VolWork relation
 *
 * @method     ChildVolWorkTechnicQuery leftJoinWithVolWork() Adds a LEFT JOIN clause and with to the query using the VolWork relation
 * @method     ChildVolWorkTechnicQuery rightJoinWithVolWork() Adds a RIGHT JOIN clause and with to the query using the VolWork relation
 * @method     ChildVolWorkTechnicQuery innerJoinWithVolWork() Adds a INNER JOIN clause and with to the query using the VolWork relation
 *
 * @method     ChildVolWorkTechnicQuery leftJoinVolTechnic($relationAlias = null) Adds a LEFT JOIN clause to the query using the VolTechnic relation
 * @method     ChildVolWorkTechnicQuery rightJoinVolTechnic($relationAlias = null) Adds a RIGHT JOIN clause to the query using the VolTechnic relation
 * @method     ChildVolWorkTechnicQuery innerJoinVolTechnic($relationAlias = null) Adds a INNER JOIN clause to the query using the VolTechnic relation
 *
 * @method     ChildVolWorkTechnicQuery joinWithVolTechnic($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the VolTechnic relation
 *
 * @method     ChildVolWorkTechnicQuery leftJoinWithVolTechnic() Adds a LEFT JOIN clause and with to the query using the VolTechnic relation
 * @method     ChildVolWorkTechnicQuery rightJoinWithVolTechnic() Adds a RIGHT JOIN clause and with to the query using the VolTechnic relation
 * @method     ChildVolWorkTechnicQuery innerJoinWithVolTechnic() Adds a INNER JOIN clause and with to the query using the VolTechnic relation
 *
 * @method     ChildVolWorkTechnicQuery leftJoinVolWorkTechnicVersion($relationAlias = null) Adds a LEFT JOIN clause to the query using the VolWorkTechnicVersion relation
 * @method     ChildVolWorkTechnicQuery rightJoinVolWorkTechnicVersion($relationAlias = null) Adds a RIGHT JOIN clause to the query using the VolWorkTechnicVersion relation
 * @method     ChildVolWorkTechnicQuery innerJoinVolWorkTechnicVersion($relationAlias = null) Adds a INNER JOIN clause to the query using the VolWorkTechnicVersion relation
 *
 * @method     ChildVolWorkTechnicQuery joinWithVolWorkTechnicVersion($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the VolWorkTechnicVersion relation
 *
 * @method     ChildVolWorkTechnicQuery leftJoinWithVolWorkTechnicVersion() Adds a LEFT JOIN clause and with to the query using the VolWorkTechnicVersion relation
 * @method     ChildVolWorkTechnicQuery rightJoinWithVolWorkTechnicVersion() Adds a RIGHT JOIN clause and with to the query using the VolWorkTechnicVersion relation
 * @method     ChildVolWorkTechnicQuery innerJoinWithVolWorkTechnicVersion() Adds a INNER JOIN clause and with to the query using the VolWorkTechnicVersion relation
 *
 * @method     \DB\VolWorkQuery|\DB\VolTechnicQuery|\DB\VolWorkTechnicVersionQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildVolWorkTechnic|null findOne(?ConnectionInterface $con = null) Return the first ChildVolWorkTechnic matching the query
 * @method     ChildVolWorkTechnic findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildVolWorkTechnic matching the query, or a new ChildVolWorkTechnic object populated from the query conditions when no match is found
 *
 * @method     ChildVolWorkTechnic|null findOneById(int $id) Return the first ChildVolWorkTechnic filtered by the id column
 * @method     ChildVolWorkTechnic|null findOneByAmount(string $amount) Return the first ChildVolWorkTechnic filtered by the amount column
 * @method     ChildVolWorkTechnic|null findOneByWorkId(int $work_id) Return the first ChildVolWorkTechnic filtered by the work_id column
 * @method     ChildVolWorkTechnic|null findOneByTechnicId(int $technic_id) Return the first ChildVolWorkTechnic filtered by the technic_id column
 * @method     ChildVolWorkTechnic|null findOneByVersion(int $version) Return the first ChildVolWorkTechnic filtered by the version column
 * @method     ChildVolWorkTechnic|null findOneByVersionCreatedAt(string $version_created_at) Return the first ChildVolWorkTechnic filtered by the version_created_at column
 * @method     ChildVolWorkTechnic|null findOneByVersionCreatedBy(string $version_created_by) Return the first ChildVolWorkTechnic filtered by the version_created_by column
 * @method     ChildVolWorkTechnic|null findOneByVersionComment(string $version_comment) Return the first ChildVolWorkTechnic filtered by the version_comment column *

 * @method     ChildVolWorkTechnic requirePk($key, ?ConnectionInterface $con = null) Return the ChildVolWorkTechnic by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolWorkTechnic requireOne(?ConnectionInterface $con = null) Return the first ChildVolWorkTechnic matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildVolWorkTechnic requireOneById(int $id) Return the first ChildVolWorkTechnic filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolWorkTechnic requireOneByAmount(string $amount) Return the first ChildVolWorkTechnic filtered by the amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolWorkTechnic requireOneByWorkId(int $work_id) Return the first ChildVolWorkTechnic filtered by the work_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolWorkTechnic requireOneByTechnicId(int $technic_id) Return the first ChildVolWorkTechnic filtered by the technic_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolWorkTechnic requireOneByVersion(int $version) Return the first ChildVolWorkTechnic filtered by the version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolWorkTechnic requireOneByVersionCreatedAt(string $version_created_at) Return the first ChildVolWorkTechnic filtered by the version_created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolWorkTechnic requireOneByVersionCreatedBy(string $version_created_by) Return the first ChildVolWorkTechnic filtered by the version_created_by column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolWorkTechnic requireOneByVersionComment(string $version_comment) Return the first ChildVolWorkTechnic filtered by the version_comment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildVolWorkTechnic[]|Collection find(?ConnectionInterface $con = null) Return ChildVolWorkTechnic objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildVolWorkTechnic> find(?ConnectionInterface $con = null) Return ChildVolWorkTechnic objects based on current ModelCriteria
 * @method     ChildVolWorkTechnic[]|Collection findById(int $id) Return ChildVolWorkTechnic objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildVolWorkTechnic> findById(int $id) Return ChildVolWorkTechnic objects filtered by the id column
 * @method     ChildVolWorkTechnic[]|Collection findByAmount(string $amount) Return ChildVolWorkTechnic objects filtered by the amount column
 * @psalm-method Collection&\Traversable<ChildVolWorkTechnic> findByAmount(string $amount) Return ChildVolWorkTechnic objects filtered by the amount column
 * @method     ChildVolWorkTechnic[]|Collection findByWorkId(int $work_id) Return ChildVolWorkTechnic objects filtered by the work_id column
 * @psalm-method Collection&\Traversable<ChildVolWorkTechnic> findByWorkId(int $work_id) Return ChildVolWorkTechnic objects filtered by the work_id column
 * @method     ChildVolWorkTechnic[]|Collection findByTechnicId(int $technic_id) Return ChildVolWorkTechnic objects filtered by the technic_id column
 * @psalm-method Collection&\Traversable<ChildVolWorkTechnic> findByTechnicId(int $technic_id) Return ChildVolWorkTechnic objects filtered by the technic_id column
 * @method     ChildVolWorkTechnic[]|Collection findByVersion(int $version) Return ChildVolWorkTechnic objects filtered by the version column
 * @psalm-method Collection&\Traversable<ChildVolWorkTechnic> findByVersion(int $version) Return ChildVolWorkTechnic objects filtered by the version column
 * @method     ChildVolWorkTechnic[]|Collection findByVersionCreatedAt(string $version_created_at) Return ChildVolWorkTechnic objects filtered by the version_created_at column
 * @psalm-method Collection&\Traversable<ChildVolWorkTechnic> findByVersionCreatedAt(string $version_created_at) Return ChildVolWorkTechnic objects filtered by the version_created_at column
 * @method     ChildVolWorkTechnic[]|Collection findByVersionCreatedBy(string $version_created_by) Return ChildVolWorkTechnic objects filtered by the version_created_by column
 * @psalm-method Collection&\Traversable<ChildVolWorkTechnic> findByVersionCreatedBy(string $version_created_by) Return ChildVolWorkTechnic objects filtered by the version_created_by column
 * @method     ChildVolWorkTechnic[]|Collection findByVersionComment(string $version_comment) Return ChildVolWorkTechnic objects filtered by the version_comment column
 * @psalm-method Collection&\Traversable<ChildVolWorkTechnic> findByVersionComment(string $version_comment) Return ChildVolWorkTechnic objects filtered by the version_comment column
 * @method     ChildVolWorkTechnic[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildVolWorkTechnic> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class VolWorkTechnicQuery extends ModelCriteria
{

    // versionable behavior

    /**
     * Whether the versioning is enabled
     */
    static $isVersioningEnabled = true;
protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \DB\Base\VolWorkTechnicQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\DB\\VolWorkTechnic', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildVolWorkTechnicQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildVolWorkTechnicQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildVolWorkTechnicQuery) {
            return $criteria;
        }
        $query = new ChildVolWorkTechnicQuery();
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
     * @return ChildVolWorkTechnic|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(VolWorkTechnicTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = VolWorkTechnicTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildVolWorkTechnic A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, amount, work_id, technic_id, version, version_created_at, version_created_by, version_comment FROM vol_work_technic WHERE id = :p0';
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
            /** @var ChildVolWorkTechnic $obj */
            $obj = new ChildVolWorkTechnic();
            $obj->hydrate($row);
            VolWorkTechnicTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildVolWorkTechnic|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(VolWorkTechnicTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(VolWorkTechnicTableMap::COL_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(VolWorkTechnicTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(VolWorkTechnicTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(VolWorkTechnicTableMap::COL_ID, $id, $comparison);

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
                $this->addUsingAlias(VolWorkTechnicTableMap::COL_AMOUNT, $amount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($amount['max'])) {
                $this->addUsingAlias(VolWorkTechnicTableMap::COL_AMOUNT, $amount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(VolWorkTechnicTableMap::COL_AMOUNT, $amount, $comparison);

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
     * @see       filterByVolWork()
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
                $this->addUsingAlias(VolWorkTechnicTableMap::COL_WORK_ID, $workId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($workId['max'])) {
                $this->addUsingAlias(VolWorkTechnicTableMap::COL_WORK_ID, $workId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(VolWorkTechnicTableMap::COL_WORK_ID, $workId, $comparison);

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
     * @see       filterByVolTechnic()
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
                $this->addUsingAlias(VolWorkTechnicTableMap::COL_TECHNIC_ID, $technicId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($technicId['max'])) {
                $this->addUsingAlias(VolWorkTechnicTableMap::COL_TECHNIC_ID, $technicId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(VolWorkTechnicTableMap::COL_TECHNIC_ID, $technicId, $comparison);

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
                $this->addUsingAlias(VolWorkTechnicTableMap::COL_VERSION, $version['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($version['max'])) {
                $this->addUsingAlias(VolWorkTechnicTableMap::COL_VERSION, $version['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(VolWorkTechnicTableMap::COL_VERSION, $version, $comparison);

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
                $this->addUsingAlias(VolWorkTechnicTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($versionCreatedAt['max'])) {
                $this->addUsingAlias(VolWorkTechnicTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(VolWorkTechnicTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt, $comparison);

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

        $this->addUsingAlias(VolWorkTechnicTableMap::COL_VERSION_CREATED_BY, $versionCreatedBy, $comparison);

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

        $this->addUsingAlias(VolWorkTechnicTableMap::COL_VERSION_COMMENT, $versionComment, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \DB\VolWork object
     *
     * @param \DB\VolWork|ObjectCollection $volWork The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByVolWork($volWork, ?string $comparison = null)
    {
        if ($volWork instanceof \DB\VolWork) {
            return $this
                ->addUsingAlias(VolWorkTechnicTableMap::COL_WORK_ID, $volWork->getId(), $comparison);
        } elseif ($volWork instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(VolWorkTechnicTableMap::COL_WORK_ID, $volWork->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByVolWork() only accepts arguments of type \DB\VolWork or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the VolWork relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinVolWork(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('VolWork');

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
            $this->addJoinObject($join, 'VolWork');
        }

        return $this;
    }

    /**
     * Use the VolWork relation VolWork object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\VolWorkQuery A secondary query class using the current class as primary query
     */
    public function useVolWorkQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinVolWork($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'VolWork', '\DB\VolWorkQuery');
    }

    /**
     * Use the VolWork relation VolWork object
     *
     * @param callable(\DB\VolWorkQuery):\DB\VolWorkQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withVolWorkQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useVolWorkQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to VolWork table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\VolWorkQuery The inner query object of the EXISTS statement
     */
    public function useVolWorkExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('VolWork', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to VolWork table for a NOT EXISTS query.
     *
     * @see useVolWorkExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\VolWorkQuery The inner query object of the NOT EXISTS statement
     */
    public function useVolWorkNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('VolWork', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \DB\VolTechnic object
     *
     * @param \DB\VolTechnic|ObjectCollection $volTechnic The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByVolTechnic($volTechnic, ?string $comparison = null)
    {
        if ($volTechnic instanceof \DB\VolTechnic) {
            return $this
                ->addUsingAlias(VolWorkTechnicTableMap::COL_TECHNIC_ID, $volTechnic->getId(), $comparison);
        } elseif ($volTechnic instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(VolWorkTechnicTableMap::COL_TECHNIC_ID, $volTechnic->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByVolTechnic() only accepts arguments of type \DB\VolTechnic or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the VolTechnic relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinVolTechnic(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('VolTechnic');

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
            $this->addJoinObject($join, 'VolTechnic');
        }

        return $this;
    }

    /**
     * Use the VolTechnic relation VolTechnic object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\VolTechnicQuery A secondary query class using the current class as primary query
     */
    public function useVolTechnicQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinVolTechnic($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'VolTechnic', '\DB\VolTechnicQuery');
    }

    /**
     * Use the VolTechnic relation VolTechnic object
     *
     * @param callable(\DB\VolTechnicQuery):\DB\VolTechnicQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withVolTechnicQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useVolTechnicQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to VolTechnic table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\VolTechnicQuery The inner query object of the EXISTS statement
     */
    public function useVolTechnicExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('VolTechnic', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to VolTechnic table for a NOT EXISTS query.
     *
     * @see useVolTechnicExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\VolTechnicQuery The inner query object of the NOT EXISTS statement
     */
    public function useVolTechnicNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('VolTechnic', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \DB\VolWorkTechnicVersion object
     *
     * @param \DB\VolWorkTechnicVersion|ObjectCollection $volWorkTechnicVersion the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByVolWorkTechnicVersion($volWorkTechnicVersion, ?string $comparison = null)
    {
        if ($volWorkTechnicVersion instanceof \DB\VolWorkTechnicVersion) {
            $this
                ->addUsingAlias(VolWorkTechnicTableMap::COL_ID, $volWorkTechnicVersion->getId(), $comparison);

            return $this;
        } elseif ($volWorkTechnicVersion instanceof ObjectCollection) {
            $this
                ->useVolWorkTechnicVersionQuery()
                ->filterByPrimaryKeys($volWorkTechnicVersion->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByVolWorkTechnicVersion() only accepts arguments of type \DB\VolWorkTechnicVersion or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the VolWorkTechnicVersion relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinVolWorkTechnicVersion(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('VolWorkTechnicVersion');

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
            $this->addJoinObject($join, 'VolWorkTechnicVersion');
        }

        return $this;
    }

    /**
     * Use the VolWorkTechnicVersion relation VolWorkTechnicVersion object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\VolWorkTechnicVersionQuery A secondary query class using the current class as primary query
     */
    public function useVolWorkTechnicVersionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinVolWorkTechnicVersion($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'VolWorkTechnicVersion', '\DB\VolWorkTechnicVersionQuery');
    }

    /**
     * Use the VolWorkTechnicVersion relation VolWorkTechnicVersion object
     *
     * @param callable(\DB\VolWorkTechnicVersionQuery):\DB\VolWorkTechnicVersionQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withVolWorkTechnicVersionQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useVolWorkTechnicVersionQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to VolWorkTechnicVersion table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\VolWorkTechnicVersionQuery The inner query object of the EXISTS statement
     */
    public function useVolWorkTechnicVersionExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('VolWorkTechnicVersion', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to VolWorkTechnicVersion table for a NOT EXISTS query.
     *
     * @see useVolWorkTechnicVersionExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\VolWorkTechnicVersionQuery The inner query object of the NOT EXISTS statement
     */
    public function useVolWorkTechnicVersionNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('VolWorkTechnicVersion', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Exclude object from result
     *
     * @param ChildVolWorkTechnic $volWorkTechnic Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($volWorkTechnic = null)
    {
        if ($volWorkTechnic) {
            $this->addUsingAlias(VolWorkTechnicTableMap::COL_ID, $volWorkTechnic->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the vol_work_technic table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(VolWorkTechnicTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            VolWorkTechnicTableMap::clearInstancePool();
            VolWorkTechnicTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(VolWorkTechnicTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(VolWorkTechnicTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            VolWorkTechnicTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            VolWorkTechnicTableMap::clearRelatedInstancePool();

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
