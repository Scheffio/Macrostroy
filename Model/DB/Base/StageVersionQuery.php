<?php

namespace DB\Base;

use \Exception;
use \PDO;
use DB\StageVersion as ChildStageVersion;
use DB\StageVersionQuery as ChildStageVersionQuery;
use DB\Map\StageVersionTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'stage_version' table.
 *
 *
 *
 * @method     ChildStageVersionQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildStageVersionQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildStageVersionQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildStageVersionQuery orderByIsAvailable($order = Criteria::ASC) Order by the is_available column
 * @method     ChildStageVersionQuery orderByHouseId($order = Criteria::ASC) Order by the house_id column
 * @method     ChildStageVersionQuery orderByVersion($order = Criteria::ASC) Order by the version column
 * @method     ChildStageVersionQuery orderByVersionCreatedAt($order = Criteria::ASC) Order by the version_created_at column
 * @method     ChildStageVersionQuery orderByVersionCreatedBy($order = Criteria::ASC) Order by the version_created_by column
 * @method     ChildStageVersionQuery orderByVersionComment($order = Criteria::ASC) Order by the version_comment column
 * @method     ChildStageVersionQuery orderByHouseIdVersion($order = Criteria::ASC) Order by the house_id_version column
 *
 * @method     ChildStageVersionQuery groupById() Group by the id column
 * @method     ChildStageVersionQuery groupByName() Group by the name column
 * @method     ChildStageVersionQuery groupByStatus() Group by the status column
 * @method     ChildStageVersionQuery groupByIsAvailable() Group by the is_available column
 * @method     ChildStageVersionQuery groupByHouseId() Group by the house_id column
 * @method     ChildStageVersionQuery groupByVersion() Group by the version column
 * @method     ChildStageVersionQuery groupByVersionCreatedAt() Group by the version_created_at column
 * @method     ChildStageVersionQuery groupByVersionCreatedBy() Group by the version_created_by column
 * @method     ChildStageVersionQuery groupByVersionComment() Group by the version_comment column
 * @method     ChildStageVersionQuery groupByHouseIdVersion() Group by the house_id_version column
 *
 * @method     ChildStageVersionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildStageVersionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildStageVersionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildStageVersionQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildStageVersionQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildStageVersionQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildStageVersionQuery leftJoinStage($relationAlias = null) Adds a LEFT JOIN clause to the query using the Stage relation
 * @method     ChildStageVersionQuery rightJoinStage($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Stage relation
 * @method     ChildStageVersionQuery innerJoinStage($relationAlias = null) Adds a INNER JOIN clause to the query using the Stage relation
 *
 * @method     ChildStageVersionQuery joinWithStage($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Stage relation
 *
 * @method     ChildStageVersionQuery leftJoinWithStage() Adds a LEFT JOIN clause and with to the query using the Stage relation
 * @method     ChildStageVersionQuery rightJoinWithStage() Adds a RIGHT JOIN clause and with to the query using the Stage relation
 * @method     ChildStageVersionQuery innerJoinWithStage() Adds a INNER JOIN clause and with to the query using the Stage relation
 *
 * @method     \DB\StageQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildStageVersion|null findOne(?ConnectionInterface $con = null) Return the first ChildStageVersion matching the query
 * @method     ChildStageVersion findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildStageVersion matching the query, or a new ChildStageVersion object populated from the query conditions when no match is found
 *
 * @method     ChildStageVersion|null findOneById(int $id) Return the first ChildStageVersion filtered by the id column
 * @method     ChildStageVersion|null findOneByName(string $name) Return the first ChildStageVersion filtered by the name column
 * @method     ChildStageVersion|null findOneByStatus(string $status) Return the first ChildStageVersion filtered by the status column
 * @method     ChildStageVersion|null findOneByIsAvailable(boolean $is_available) Return the first ChildStageVersion filtered by the is_available column
 * @method     ChildStageVersion|null findOneByHouseId(int $house_id) Return the first ChildStageVersion filtered by the house_id column
 * @method     ChildStageVersion|null findOneByVersion(int $version) Return the first ChildStageVersion filtered by the version column
 * @method     ChildStageVersion|null findOneByVersionCreatedAt(string $version_created_at) Return the first ChildStageVersion filtered by the version_created_at column
 * @method     ChildStageVersion|null findOneByVersionCreatedBy(string $version_created_by) Return the first ChildStageVersion filtered by the version_created_by column
 * @method     ChildStageVersion|null findOneByVersionComment(string $version_comment) Return the first ChildStageVersion filtered by the version_comment column
 * @method     ChildStageVersion|null findOneByHouseIdVersion(int $house_id_version) Return the first ChildStageVersion filtered by the house_id_version column *

 * @method     ChildStageVersion requirePk($key, ?ConnectionInterface $con = null) Return the ChildStageVersion by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStageVersion requireOne(?ConnectionInterface $con = null) Return the first ChildStageVersion matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildStageVersion requireOneById(int $id) Return the first ChildStageVersion filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStageVersion requireOneByName(string $name) Return the first ChildStageVersion filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStageVersion requireOneByStatus(string $status) Return the first ChildStageVersion filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStageVersion requireOneByIsAvailable(boolean $is_available) Return the first ChildStageVersion filtered by the is_available column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStageVersion requireOneByHouseId(int $house_id) Return the first ChildStageVersion filtered by the house_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStageVersion requireOneByVersion(int $version) Return the first ChildStageVersion filtered by the version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStageVersion requireOneByVersionCreatedAt(string $version_created_at) Return the first ChildStageVersion filtered by the version_created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStageVersion requireOneByVersionCreatedBy(string $version_created_by) Return the first ChildStageVersion filtered by the version_created_by column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStageVersion requireOneByVersionComment(string $version_comment) Return the first ChildStageVersion filtered by the version_comment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStageVersion requireOneByHouseIdVersion(int $house_id_version) Return the first ChildStageVersion filtered by the house_id_version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildStageVersion[]|Collection find(?ConnectionInterface $con = null) Return ChildStageVersion objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildStageVersion> find(?ConnectionInterface $con = null) Return ChildStageVersion objects based on current ModelCriteria
 * @method     ChildStageVersion[]|Collection findById(int $id) Return ChildStageVersion objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildStageVersion> findById(int $id) Return ChildStageVersion objects filtered by the id column
 * @method     ChildStageVersion[]|Collection findByName(string $name) Return ChildStageVersion objects filtered by the name column
 * @psalm-method Collection&\Traversable<ChildStageVersion> findByName(string $name) Return ChildStageVersion objects filtered by the name column
 * @method     ChildStageVersion[]|Collection findByStatus(string $status) Return ChildStageVersion objects filtered by the status column
 * @psalm-method Collection&\Traversable<ChildStageVersion> findByStatus(string $status) Return ChildStageVersion objects filtered by the status column
 * @method     ChildStageVersion[]|Collection findByIsAvailable(boolean $is_available) Return ChildStageVersion objects filtered by the is_available column
 * @psalm-method Collection&\Traversable<ChildStageVersion> findByIsAvailable(boolean $is_available) Return ChildStageVersion objects filtered by the is_available column
 * @method     ChildStageVersion[]|Collection findByHouseId(int $house_id) Return ChildStageVersion objects filtered by the house_id column
 * @psalm-method Collection&\Traversable<ChildStageVersion> findByHouseId(int $house_id) Return ChildStageVersion objects filtered by the house_id column
 * @method     ChildStageVersion[]|Collection findByVersion(int $version) Return ChildStageVersion objects filtered by the version column
 * @psalm-method Collection&\Traversable<ChildStageVersion> findByVersion(int $version) Return ChildStageVersion objects filtered by the version column
 * @method     ChildStageVersion[]|Collection findByVersionCreatedAt(string $version_created_at) Return ChildStageVersion objects filtered by the version_created_at column
 * @psalm-method Collection&\Traversable<ChildStageVersion> findByVersionCreatedAt(string $version_created_at) Return ChildStageVersion objects filtered by the version_created_at column
 * @method     ChildStageVersion[]|Collection findByVersionCreatedBy(string $version_created_by) Return ChildStageVersion objects filtered by the version_created_by column
 * @psalm-method Collection&\Traversable<ChildStageVersion> findByVersionCreatedBy(string $version_created_by) Return ChildStageVersion objects filtered by the version_created_by column
 * @method     ChildStageVersion[]|Collection findByVersionComment(string $version_comment) Return ChildStageVersion objects filtered by the version_comment column
 * @psalm-method Collection&\Traversable<ChildStageVersion> findByVersionComment(string $version_comment) Return ChildStageVersion objects filtered by the version_comment column
 * @method     ChildStageVersion[]|Collection findByHouseIdVersion(int $house_id_version) Return ChildStageVersion objects filtered by the house_id_version column
 * @psalm-method Collection&\Traversable<ChildStageVersion> findByHouseIdVersion(int $house_id_version) Return ChildStageVersion objects filtered by the house_id_version column
 * @method     ChildStageVersion[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildStageVersion> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class StageVersionQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \DB\Base\StageVersionQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\DB\\StageVersion', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildStageVersionQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildStageVersionQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildStageVersionQuery) {
            return $criteria;
        }
        $query = new ChildStageVersionQuery();
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
     * @return ChildStageVersion|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(StageVersionTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = StageVersionTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildStageVersion A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, status, is_available, house_id, version, version_created_at, version_created_by, version_comment, house_id_version FROM stage_version WHERE id = :p0 AND version = :p1';
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
            /** @var ChildStageVersion $obj */
            $obj = new ChildStageVersion();
            $obj->hydrate($row);
            StageVersionTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildStageVersion|array|mixed the result, formatted by the current formatter
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
        $this->addUsingAlias(StageVersionTableMap::COL_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(StageVersionTableMap::COL_VERSION, $key[1], Criteria::EQUAL);

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
            $cton0 = $this->getNewCriterion(StageVersionTableMap::COL_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(StageVersionTableMap::COL_VERSION, $key[1], Criteria::EQUAL);
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
     * @see       filterByStage()
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
                $this->addUsingAlias(StageVersionTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(StageVersionTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StageVersionTableMap::COL_ID, $id, $comparison);

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

        $this->addUsingAlias(StageVersionTableMap::COL_NAME, $name, $comparison);

        return $this;
    }

    /**
     * Filter the query on the status column
     *
     * Example usage:
     * <code>
     * $query->filterByStatus('fooValue');   // WHERE status = 'fooValue'
     * $query->filterByStatus('%fooValue%', Criteria::LIKE); // WHERE status LIKE '%fooValue%'
     * $query->filterByStatus(['foo', 'bar']); // WHERE status IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $status The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStatus($status = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($status)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StageVersionTableMap::COL_STATUS, $status, $comparison);

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

        $this->addUsingAlias(StageVersionTableMap::COL_IS_AVAILABLE, $isAvailable, $comparison);

        return $this;
    }

    /**
     * Filter the query on the house_id column
     *
     * Example usage:
     * <code>
     * $query->filterByHouseId(1234); // WHERE house_id = 1234
     * $query->filterByHouseId(array(12, 34)); // WHERE house_id IN (12, 34)
     * $query->filterByHouseId(array('min' => 12)); // WHERE house_id > 12
     * </code>
     *
     * @param mixed $houseId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByHouseId($houseId = null, ?string $comparison = null)
    {
        if (is_array($houseId)) {
            $useMinMax = false;
            if (isset($houseId['min'])) {
                $this->addUsingAlias(StageVersionTableMap::COL_HOUSE_ID, $houseId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($houseId['max'])) {
                $this->addUsingAlias(StageVersionTableMap::COL_HOUSE_ID, $houseId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StageVersionTableMap::COL_HOUSE_ID, $houseId, $comparison);

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
                $this->addUsingAlias(StageVersionTableMap::COL_VERSION, $version['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($version['max'])) {
                $this->addUsingAlias(StageVersionTableMap::COL_VERSION, $version['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StageVersionTableMap::COL_VERSION, $version, $comparison);

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
                $this->addUsingAlias(StageVersionTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($versionCreatedAt['max'])) {
                $this->addUsingAlias(StageVersionTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StageVersionTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt, $comparison);

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

        $this->addUsingAlias(StageVersionTableMap::COL_VERSION_CREATED_BY, $versionCreatedBy, $comparison);

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

        $this->addUsingAlias(StageVersionTableMap::COL_VERSION_COMMENT, $versionComment, $comparison);

        return $this;
    }

    /**
     * Filter the query on the house_id_version column
     *
     * Example usage:
     * <code>
     * $query->filterByHouseIdVersion(1234); // WHERE house_id_version = 1234
     * $query->filterByHouseIdVersion(array(12, 34)); // WHERE house_id_version IN (12, 34)
     * $query->filterByHouseIdVersion(array('min' => 12)); // WHERE house_id_version > 12
     * </code>
     *
     * @param mixed $houseIdVersion The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByHouseIdVersion($houseIdVersion = null, ?string $comparison = null)
    {
        if (is_array($houseIdVersion)) {
            $useMinMax = false;
            if (isset($houseIdVersion['min'])) {
                $this->addUsingAlias(StageVersionTableMap::COL_HOUSE_ID_VERSION, $houseIdVersion['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($houseIdVersion['max'])) {
                $this->addUsingAlias(StageVersionTableMap::COL_HOUSE_ID_VERSION, $houseIdVersion['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StageVersionTableMap::COL_HOUSE_ID_VERSION, $houseIdVersion, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \DB\Stage object
     *
     * @param \DB\Stage|ObjectCollection $stage The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStage($stage, ?string $comparison = null)
    {
        if ($stage instanceof \DB\Stage) {
            return $this
                ->addUsingAlias(StageVersionTableMap::COL_ID, $stage->getId(), $comparison);
        } elseif ($stage instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(StageVersionTableMap::COL_ID, $stage->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByStage() only accepts arguments of type \DB\Stage or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Stage relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinStage(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Stage');

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
            $this->addJoinObject($join, 'Stage');
        }

        return $this;
    }

    /**
     * Use the Stage relation Stage object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\StageQuery A secondary query class using the current class as primary query
     */
    public function useStageQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinStage($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Stage', '\DB\StageQuery');
    }

    /**
     * Use the Stage relation Stage object
     *
     * @param callable(\DB\StageQuery):\DB\StageQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withStageQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useStageQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to Stage table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\StageQuery The inner query object of the EXISTS statement
     */
    public function useStageExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('Stage', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to Stage table for a NOT EXISTS query.
     *
     * @see useStageExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\StageQuery The inner query object of the NOT EXISTS statement
     */
    public function useStageNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('Stage', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Exclude object from result
     *
     * @param ChildStageVersion $stageVersion Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($stageVersion = null)
    {
        if ($stageVersion) {
            $this->addCond('pruneCond0', $this->getAliasedColName(StageVersionTableMap::COL_ID), $stageVersion->getId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(StageVersionTableMap::COL_VERSION), $stageVersion->getVersion(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the stage_version table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(StageVersionTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            StageVersionTableMap::clearInstancePool();
            StageVersionTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(StageVersionTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(StageVersionTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            StageVersionTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            StageVersionTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
