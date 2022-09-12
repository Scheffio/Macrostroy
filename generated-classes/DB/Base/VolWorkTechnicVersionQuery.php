<?php

namespace DB\Base;

use \Exception;
use \PDO;
use DB\VolWorkTechnicVersion as ChildVolWorkTechnicVersion;
use DB\VolWorkTechnicVersionQuery as ChildVolWorkTechnicVersionQuery;
use DB\Map\VolWorkTechnicVersionTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'vol_work_technic_version' table.
 *
 *
 *
 * @method     ChildVolWorkTechnicVersionQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildVolWorkTechnicVersionQuery orderByAmount($order = Criteria::ASC) Order by the amount column
 * @method     ChildVolWorkTechnicVersionQuery orderByWorkId($order = Criteria::ASC) Order by the work_id column
 * @method     ChildVolWorkTechnicVersionQuery orderByTechnicId($order = Criteria::ASC) Order by the technic_id column
 * @method     ChildVolWorkTechnicVersionQuery orderByVersion($order = Criteria::ASC) Order by the version column
 * @method     ChildVolWorkTechnicVersionQuery orderByVersionCreatedAt($order = Criteria::ASC) Order by the version_created_at column
 * @method     ChildVolWorkTechnicVersionQuery orderByVersionCreatedBy($order = Criteria::ASC) Order by the version_created_by column
 * @method     ChildVolWorkTechnicVersionQuery orderByVersionComment($order = Criteria::ASC) Order by the version_comment column
 * @method     ChildVolWorkTechnicVersionQuery orderByWorkIdVersion($order = Criteria::ASC) Order by the work_id_version column
 * @method     ChildVolWorkTechnicVersionQuery orderByTechnicIdVersion($order = Criteria::ASC) Order by the technic_id_version column
 *
 * @method     ChildVolWorkTechnicVersionQuery groupById() Group by the id column
 * @method     ChildVolWorkTechnicVersionQuery groupByAmount() Group by the amount column
 * @method     ChildVolWorkTechnicVersionQuery groupByWorkId() Group by the work_id column
 * @method     ChildVolWorkTechnicVersionQuery groupByTechnicId() Group by the technic_id column
 * @method     ChildVolWorkTechnicVersionQuery groupByVersion() Group by the version column
 * @method     ChildVolWorkTechnicVersionQuery groupByVersionCreatedAt() Group by the version_created_at column
 * @method     ChildVolWorkTechnicVersionQuery groupByVersionCreatedBy() Group by the version_created_by column
 * @method     ChildVolWorkTechnicVersionQuery groupByVersionComment() Group by the version_comment column
 * @method     ChildVolWorkTechnicVersionQuery groupByWorkIdVersion() Group by the work_id_version column
 * @method     ChildVolWorkTechnicVersionQuery groupByTechnicIdVersion() Group by the technic_id_version column
 *
 * @method     ChildVolWorkTechnicVersionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildVolWorkTechnicVersionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildVolWorkTechnicVersionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildVolWorkTechnicVersionQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildVolWorkTechnicVersionQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildVolWorkTechnicVersionQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildVolWorkTechnicVersionQuery leftJoinVolWorkTechnic($relationAlias = null) Adds a LEFT JOIN clause to the query using the VolWorkTechnic relation
 * @method     ChildVolWorkTechnicVersionQuery rightJoinVolWorkTechnic($relationAlias = null) Adds a RIGHT JOIN clause to the query using the VolWorkTechnic relation
 * @method     ChildVolWorkTechnicVersionQuery innerJoinVolWorkTechnic($relationAlias = null) Adds a INNER JOIN clause to the query using the VolWorkTechnic relation
 *
 * @method     ChildVolWorkTechnicVersionQuery joinWithVolWorkTechnic($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the VolWorkTechnic relation
 *
 * @method     ChildVolWorkTechnicVersionQuery leftJoinWithVolWorkTechnic() Adds a LEFT JOIN clause and with to the query using the VolWorkTechnic relation
 * @method     ChildVolWorkTechnicVersionQuery rightJoinWithVolWorkTechnic() Adds a RIGHT JOIN clause and with to the query using the VolWorkTechnic relation
 * @method     ChildVolWorkTechnicVersionQuery innerJoinWithVolWorkTechnic() Adds a INNER JOIN clause and with to the query using the VolWorkTechnic relation
 *
 * @method     \DB\VolWorkTechnicQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildVolWorkTechnicVersion|null findOne(?ConnectionInterface $con = null) Return the first ChildVolWorkTechnicVersion matching the query
 * @method     ChildVolWorkTechnicVersion findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildVolWorkTechnicVersion matching the query, or a new ChildVolWorkTechnicVersion object populated from the query conditions when no match is found
 *
 * @method     ChildVolWorkTechnicVersion|null findOneById(int $id) Return the first ChildVolWorkTechnicVersion filtered by the id column
 * @method     ChildVolWorkTechnicVersion|null findOneByAmount(string $amount) Return the first ChildVolWorkTechnicVersion filtered by the amount column
 * @method     ChildVolWorkTechnicVersion|null findOneByWorkId(int $work_id) Return the first ChildVolWorkTechnicVersion filtered by the work_id column
 * @method     ChildVolWorkTechnicVersion|null findOneByTechnicId(int $technic_id) Return the first ChildVolWorkTechnicVersion filtered by the technic_id column
 * @method     ChildVolWorkTechnicVersion|null findOneByVersion(int $version) Return the first ChildVolWorkTechnicVersion filtered by the version column
 * @method     ChildVolWorkTechnicVersion|null findOneByVersionCreatedAt(string $version_created_at) Return the first ChildVolWorkTechnicVersion filtered by the version_created_at column
 * @method     ChildVolWorkTechnicVersion|null findOneByVersionCreatedBy(string $version_created_by) Return the first ChildVolWorkTechnicVersion filtered by the version_created_by column
 * @method     ChildVolWorkTechnicVersion|null findOneByVersionComment(string $version_comment) Return the first ChildVolWorkTechnicVersion filtered by the version_comment column
 * @method     ChildVolWorkTechnicVersion|null findOneByWorkIdVersion(int $work_id_version) Return the first ChildVolWorkTechnicVersion filtered by the work_id_version column
 * @method     ChildVolWorkTechnicVersion|null findOneByTechnicIdVersion(int $technic_id_version) Return the first ChildVolWorkTechnicVersion filtered by the technic_id_version column *

 * @method     ChildVolWorkTechnicVersion requirePk($key, ?ConnectionInterface $con = null) Return the ChildVolWorkTechnicVersion by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolWorkTechnicVersion requireOne(?ConnectionInterface $con = null) Return the first ChildVolWorkTechnicVersion matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildVolWorkTechnicVersion requireOneById(int $id) Return the first ChildVolWorkTechnicVersion filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolWorkTechnicVersion requireOneByAmount(string $amount) Return the first ChildVolWorkTechnicVersion filtered by the amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolWorkTechnicVersion requireOneByWorkId(int $work_id) Return the first ChildVolWorkTechnicVersion filtered by the work_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolWorkTechnicVersion requireOneByTechnicId(int $technic_id) Return the first ChildVolWorkTechnicVersion filtered by the technic_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolWorkTechnicVersion requireOneByVersion(int $version) Return the first ChildVolWorkTechnicVersion filtered by the version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolWorkTechnicVersion requireOneByVersionCreatedAt(string $version_created_at) Return the first ChildVolWorkTechnicVersion filtered by the version_created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolWorkTechnicVersion requireOneByVersionCreatedBy(string $version_created_by) Return the first ChildVolWorkTechnicVersion filtered by the version_created_by column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolWorkTechnicVersion requireOneByVersionComment(string $version_comment) Return the first ChildVolWorkTechnicVersion filtered by the version_comment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolWorkTechnicVersion requireOneByWorkIdVersion(int $work_id_version) Return the first ChildVolWorkTechnicVersion filtered by the work_id_version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolWorkTechnicVersion requireOneByTechnicIdVersion(int $technic_id_version) Return the first ChildVolWorkTechnicVersion filtered by the technic_id_version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildVolWorkTechnicVersion[]|Collection find(?ConnectionInterface $con = null) Return ChildVolWorkTechnicVersion objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildVolWorkTechnicVersion> find(?ConnectionInterface $con = null) Return ChildVolWorkTechnicVersion objects based on current ModelCriteria
 * @method     ChildVolWorkTechnicVersion[]|Collection findById(int $id) Return ChildVolWorkTechnicVersion objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildVolWorkTechnicVersion> findById(int $id) Return ChildVolWorkTechnicVersion objects filtered by the id column
 * @method     ChildVolWorkTechnicVersion[]|Collection findByAmount(string $amount) Return ChildVolWorkTechnicVersion objects filtered by the amount column
 * @psalm-method Collection&\Traversable<ChildVolWorkTechnicVersion> findByAmount(string $amount) Return ChildVolWorkTechnicVersion objects filtered by the amount column
 * @method     ChildVolWorkTechnicVersion[]|Collection findByWorkId(int $work_id) Return ChildVolWorkTechnicVersion objects filtered by the work_id column
 * @psalm-method Collection&\Traversable<ChildVolWorkTechnicVersion> findByWorkId(int $work_id) Return ChildVolWorkTechnicVersion objects filtered by the work_id column
 * @method     ChildVolWorkTechnicVersion[]|Collection findByTechnicId(int $technic_id) Return ChildVolWorkTechnicVersion objects filtered by the technic_id column
 * @psalm-method Collection&\Traversable<ChildVolWorkTechnicVersion> findByTechnicId(int $technic_id) Return ChildVolWorkTechnicVersion objects filtered by the technic_id column
 * @method     ChildVolWorkTechnicVersion[]|Collection findByVersion(int $version) Return ChildVolWorkTechnicVersion objects filtered by the version column
 * @psalm-method Collection&\Traversable<ChildVolWorkTechnicVersion> findByVersion(int $version) Return ChildVolWorkTechnicVersion objects filtered by the version column
 * @method     ChildVolWorkTechnicVersion[]|Collection findByVersionCreatedAt(string $version_created_at) Return ChildVolWorkTechnicVersion objects filtered by the version_created_at column
 * @psalm-method Collection&\Traversable<ChildVolWorkTechnicVersion> findByVersionCreatedAt(string $version_created_at) Return ChildVolWorkTechnicVersion objects filtered by the version_created_at column
 * @method     ChildVolWorkTechnicVersion[]|Collection findByVersionCreatedBy(string $version_created_by) Return ChildVolWorkTechnicVersion objects filtered by the version_created_by column
 * @psalm-method Collection&\Traversable<ChildVolWorkTechnicVersion> findByVersionCreatedBy(string $version_created_by) Return ChildVolWorkTechnicVersion objects filtered by the version_created_by column
 * @method     ChildVolWorkTechnicVersion[]|Collection findByVersionComment(string $version_comment) Return ChildVolWorkTechnicVersion objects filtered by the version_comment column
 * @psalm-method Collection&\Traversable<ChildVolWorkTechnicVersion> findByVersionComment(string $version_comment) Return ChildVolWorkTechnicVersion objects filtered by the version_comment column
 * @method     ChildVolWorkTechnicVersion[]|Collection findByWorkIdVersion(int $work_id_version) Return ChildVolWorkTechnicVersion objects filtered by the work_id_version column
 * @psalm-method Collection&\Traversable<ChildVolWorkTechnicVersion> findByWorkIdVersion(int $work_id_version) Return ChildVolWorkTechnicVersion objects filtered by the work_id_version column
 * @method     ChildVolWorkTechnicVersion[]|Collection findByTechnicIdVersion(int $technic_id_version) Return ChildVolWorkTechnicVersion objects filtered by the technic_id_version column
 * @psalm-method Collection&\Traversable<ChildVolWorkTechnicVersion> findByTechnicIdVersion(int $technic_id_version) Return ChildVolWorkTechnicVersion objects filtered by the technic_id_version column
 * @method     ChildVolWorkTechnicVersion[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildVolWorkTechnicVersion> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class VolWorkTechnicVersionQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \DB\Base\VolWorkTechnicVersionQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\DB\\VolWorkTechnicVersion', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildVolWorkTechnicVersionQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildVolWorkTechnicVersionQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildVolWorkTechnicVersionQuery) {
            return $criteria;
        }
        $query = new ChildVolWorkTechnicVersionQuery();
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
     * @return ChildVolWorkTechnicVersion|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(VolWorkTechnicVersionTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = VolWorkTechnicVersionTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildVolWorkTechnicVersion A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, amount, work_id, technic_id, version, version_created_at, version_created_by, version_comment, work_id_version, technic_id_version FROM vol_work_technic_version WHERE id = :p0 AND version = :p1';
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
            /** @var ChildVolWorkTechnicVersion $obj */
            $obj = new ChildVolWorkTechnicVersion();
            $obj->hydrate($row);
            VolWorkTechnicVersionTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildVolWorkTechnicVersion|array|mixed the result, formatted by the current formatter
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
        $this->addUsingAlias(VolWorkTechnicVersionTableMap::COL_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(VolWorkTechnicVersionTableMap::COL_VERSION, $key[1], Criteria::EQUAL);

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
            $cton0 = $this->getNewCriterion(VolWorkTechnicVersionTableMap::COL_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(VolWorkTechnicVersionTableMap::COL_VERSION, $key[1], Criteria::EQUAL);
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
     * @see       filterByVolWorkTechnic()
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
                $this->addUsingAlias(VolWorkTechnicVersionTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(VolWorkTechnicVersionTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(VolWorkTechnicVersionTableMap::COL_ID, $id, $comparison);

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
                $this->addUsingAlias(VolWorkTechnicVersionTableMap::COL_AMOUNT, $amount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($amount['max'])) {
                $this->addUsingAlias(VolWorkTechnicVersionTableMap::COL_AMOUNT, $amount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(VolWorkTechnicVersionTableMap::COL_AMOUNT, $amount, $comparison);

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
                $this->addUsingAlias(VolWorkTechnicVersionTableMap::COL_WORK_ID, $workId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($workId['max'])) {
                $this->addUsingAlias(VolWorkTechnicVersionTableMap::COL_WORK_ID, $workId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(VolWorkTechnicVersionTableMap::COL_WORK_ID, $workId, $comparison);

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
                $this->addUsingAlias(VolWorkTechnicVersionTableMap::COL_TECHNIC_ID, $technicId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($technicId['max'])) {
                $this->addUsingAlias(VolWorkTechnicVersionTableMap::COL_TECHNIC_ID, $technicId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(VolWorkTechnicVersionTableMap::COL_TECHNIC_ID, $technicId, $comparison);

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
                $this->addUsingAlias(VolWorkTechnicVersionTableMap::COL_VERSION, $version['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($version['max'])) {
                $this->addUsingAlias(VolWorkTechnicVersionTableMap::COL_VERSION, $version['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(VolWorkTechnicVersionTableMap::COL_VERSION, $version, $comparison);

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
                $this->addUsingAlias(VolWorkTechnicVersionTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($versionCreatedAt['max'])) {
                $this->addUsingAlias(VolWorkTechnicVersionTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(VolWorkTechnicVersionTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt, $comparison);

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

        $this->addUsingAlias(VolWorkTechnicVersionTableMap::COL_VERSION_CREATED_BY, $versionCreatedBy, $comparison);

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

        $this->addUsingAlias(VolWorkTechnicVersionTableMap::COL_VERSION_COMMENT, $versionComment, $comparison);

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
                $this->addUsingAlias(VolWorkTechnicVersionTableMap::COL_WORK_ID_VERSION, $workIdVersion['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($workIdVersion['max'])) {
                $this->addUsingAlias(VolWorkTechnicVersionTableMap::COL_WORK_ID_VERSION, $workIdVersion['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(VolWorkTechnicVersionTableMap::COL_WORK_ID_VERSION, $workIdVersion, $comparison);

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
                $this->addUsingAlias(VolWorkTechnicVersionTableMap::COL_TECHNIC_ID_VERSION, $technicIdVersion['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($technicIdVersion['max'])) {
                $this->addUsingAlias(VolWorkTechnicVersionTableMap::COL_TECHNIC_ID_VERSION, $technicIdVersion['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(VolWorkTechnicVersionTableMap::COL_TECHNIC_ID_VERSION, $technicIdVersion, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \DB\VolWorkTechnic object
     *
     * @param \DB\VolWorkTechnic|ObjectCollection $volWorkTechnic The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByVolWorkTechnic($volWorkTechnic, ?string $comparison = null)
    {
        if ($volWorkTechnic instanceof \DB\VolWorkTechnic) {
            return $this
                ->addUsingAlias(VolWorkTechnicVersionTableMap::COL_ID, $volWorkTechnic->getId(), $comparison);
        } elseif ($volWorkTechnic instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(VolWorkTechnicVersionTableMap::COL_ID, $volWorkTechnic->toKeyValue('PrimaryKey', 'Id'), $comparison);

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
     * Exclude object from result
     *
     * @param ChildVolWorkTechnicVersion $volWorkTechnicVersion Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($volWorkTechnicVersion = null)
    {
        if ($volWorkTechnicVersion) {
            $this->addCond('pruneCond0', $this->getAliasedColName(VolWorkTechnicVersionTableMap::COL_ID), $volWorkTechnicVersion->getId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(VolWorkTechnicVersionTableMap::COL_VERSION), $volWorkTechnicVersion->getVersion(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the vol_work_technic_version table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(VolWorkTechnicVersionTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            VolWorkTechnicVersionTableMap::clearInstancePool();
            VolWorkTechnicVersionTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(VolWorkTechnicVersionTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(VolWorkTechnicVersionTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            VolWorkTechnicVersionTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            VolWorkTechnicVersionTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
