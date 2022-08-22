<?php

namespace DB\Base;

use \Exception;
use \PDO;
use DB\House as ChildHouse;
use DB\HouseQuery as ChildHouseQuery;
use DB\Map\HouseTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'house' table.
 *
 *
 *
 * @method     ChildHouseQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildHouseQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildHouseQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildHouseQuery orderByIsAvailable($order = Criteria::ASC) Order by the is_available column
 * @method     ChildHouseQuery orderByGroupId($order = Criteria::ASC) Order by the group_id column
 * @method     ChildHouseQuery orderByVersion($order = Criteria::ASC) Order by the version column
 * @method     ChildHouseQuery orderByVersionCreatedAt($order = Criteria::ASC) Order by the version_created_at column
 * @method     ChildHouseQuery orderByVersionCreatedBy($order = Criteria::ASC) Order by the version_created_by column
 * @method     ChildHouseQuery orderByVersionComment($order = Criteria::ASC) Order by the version_comment column
 *
 * @method     ChildHouseQuery groupById() Group by the id column
 * @method     ChildHouseQuery groupByName() Group by the name column
 * @method     ChildHouseQuery groupByStatus() Group by the status column
 * @method     ChildHouseQuery groupByIsAvailable() Group by the is_available column
 * @method     ChildHouseQuery groupByGroupId() Group by the group_id column
 * @method     ChildHouseQuery groupByVersion() Group by the version column
 * @method     ChildHouseQuery groupByVersionCreatedAt() Group by the version_created_at column
 * @method     ChildHouseQuery groupByVersionCreatedBy() Group by the version_created_by column
 * @method     ChildHouseQuery groupByVersionComment() Group by the version_comment column
 *
 * @method     ChildHouseQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildHouseQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildHouseQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildHouseQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildHouseQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildHouseQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildHouseQuery leftJoinGroups($relationAlias = null) Adds a LEFT JOIN clause to the query using the Groups relation
 * @method     ChildHouseQuery rightJoinGroups($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Groups relation
 * @method     ChildHouseQuery innerJoinGroups($relationAlias = null) Adds a INNER JOIN clause to the query using the Groups relation
 *
 * @method     ChildHouseQuery joinWithGroups($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Groups relation
 *
 * @method     ChildHouseQuery leftJoinWithGroups() Adds a LEFT JOIN clause and with to the query using the Groups relation
 * @method     ChildHouseQuery rightJoinWithGroups() Adds a RIGHT JOIN clause and with to the query using the Groups relation
 * @method     ChildHouseQuery innerJoinWithGroups() Adds a INNER JOIN clause and with to the query using the Groups relation
 *
 * @method     ChildHouseQuery leftJoinHouseVersion($relationAlias = null) Adds a LEFT JOIN clause to the query using the HouseVersion relation
 * @method     ChildHouseQuery rightJoinHouseVersion($relationAlias = null) Adds a RIGHT JOIN clause to the query using the HouseVersion relation
 * @method     ChildHouseQuery innerJoinHouseVersion($relationAlias = null) Adds a INNER JOIN clause to the query using the HouseVersion relation
 *
 * @method     ChildHouseQuery joinWithHouseVersion($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the HouseVersion relation
 *
 * @method     ChildHouseQuery leftJoinWithHouseVersion() Adds a LEFT JOIN clause and with to the query using the HouseVersion relation
 * @method     ChildHouseQuery rightJoinWithHouseVersion() Adds a RIGHT JOIN clause and with to the query using the HouseVersion relation
 * @method     ChildHouseQuery innerJoinWithHouseVersion() Adds a INNER JOIN clause and with to the query using the HouseVersion relation
 *
 * @method     ChildHouseQuery leftJoinStage($relationAlias = null) Adds a LEFT JOIN clause to the query using the Stage relation
 * @method     ChildHouseQuery rightJoinStage($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Stage relation
 * @method     ChildHouseQuery innerJoinStage($relationAlias = null) Adds a INNER JOIN clause to the query using the Stage relation
 *
 * @method     ChildHouseQuery joinWithStage($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Stage relation
 *
 * @method     ChildHouseQuery leftJoinWithStage() Adds a LEFT JOIN clause and with to the query using the Stage relation
 * @method     ChildHouseQuery rightJoinWithStage() Adds a RIGHT JOIN clause and with to the query using the Stage relation
 * @method     ChildHouseQuery innerJoinWithStage() Adds a INNER JOIN clause and with to the query using the Stage relation
 *
 * @method     \DB\GroupsQuery|\DB\HouseVersionQuery|\DB\StageQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildHouse|null findOne(?ConnectionInterface $con = null) Return the first ChildHouse matching the query
 * @method     ChildHouse findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildHouse matching the query, or a new ChildHouse object populated from the query conditions when no match is found
 *
 * @method     ChildHouse|null findOneById(int $id) Return the first ChildHouse filtered by the id column
 * @method     ChildHouse|null findOneByName(string $name) Return the first ChildHouse filtered by the name column
 * @method     ChildHouse|null findOneByStatus(string $status) Return the first ChildHouse filtered by the status column
 * @method     ChildHouse|null findOneByIsAvailable(boolean $is_available) Return the first ChildHouse filtered by the is_available column
 * @method     ChildHouse|null findOneByGroupId(int $group_id) Return the first ChildHouse filtered by the group_id column
 * @method     ChildHouse|null findOneByVersion(int $version) Return the first ChildHouse filtered by the version column
 * @method     ChildHouse|null findOneByVersionCreatedAt(string $version_created_at) Return the first ChildHouse filtered by the version_created_at column
 * @method     ChildHouse|null findOneByVersionCreatedBy(string $version_created_by) Return the first ChildHouse filtered by the version_created_by column
 * @method     ChildHouse|null findOneByVersionComment(string $version_comment) Return the first ChildHouse filtered by the version_comment column *

 * @method     ChildHouse requirePk($key, ?ConnectionInterface $con = null) Return the ChildHouse by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHouse requireOne(?ConnectionInterface $con = null) Return the first ChildHouse matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildHouse requireOneById(int $id) Return the first ChildHouse filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHouse requireOneByName(string $name) Return the first ChildHouse filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHouse requireOneByStatus(string $status) Return the first ChildHouse filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHouse requireOneByIsAvailable(boolean $is_available) Return the first ChildHouse filtered by the is_available column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHouse requireOneByGroupId(int $group_id) Return the first ChildHouse filtered by the group_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHouse requireOneByVersion(int $version) Return the first ChildHouse filtered by the version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHouse requireOneByVersionCreatedAt(string $version_created_at) Return the first ChildHouse filtered by the version_created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHouse requireOneByVersionCreatedBy(string $version_created_by) Return the first ChildHouse filtered by the version_created_by column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHouse requireOneByVersionComment(string $version_comment) Return the first ChildHouse filtered by the version_comment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildHouse[]|Collection find(?ConnectionInterface $con = null) Return ChildHouse objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildHouse> find(?ConnectionInterface $con = null) Return ChildHouse objects based on current ModelCriteria
 * @method     ChildHouse[]|Collection findById(int $id) Return ChildHouse objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildHouse> findById(int $id) Return ChildHouse objects filtered by the id column
 * @method     ChildHouse[]|Collection findByName(string $name) Return ChildHouse objects filtered by the name column
 * @psalm-method Collection&\Traversable<ChildHouse> findByName(string $name) Return ChildHouse objects filtered by the name column
 * @method     ChildHouse[]|Collection findByStatus(string $status) Return ChildHouse objects filtered by the status column
 * @psalm-method Collection&\Traversable<ChildHouse> findByStatus(string $status) Return ChildHouse objects filtered by the status column
 * @method     ChildHouse[]|Collection findByIsAvailable(boolean $is_available) Return ChildHouse objects filtered by the is_available column
 * @psalm-method Collection&\Traversable<ChildHouse> findByIsAvailable(boolean $is_available) Return ChildHouse objects filtered by the is_available column
 * @method     ChildHouse[]|Collection findByGroupId(int $group_id) Return ChildHouse objects filtered by the group_id column
 * @psalm-method Collection&\Traversable<ChildHouse> findByGroupId(int $group_id) Return ChildHouse objects filtered by the group_id column
 * @method     ChildHouse[]|Collection findByVersion(int $version) Return ChildHouse objects filtered by the version column
 * @psalm-method Collection&\Traversable<ChildHouse> findByVersion(int $version) Return ChildHouse objects filtered by the version column
 * @method     ChildHouse[]|Collection findByVersionCreatedAt(string $version_created_at) Return ChildHouse objects filtered by the version_created_at column
 * @psalm-method Collection&\Traversable<ChildHouse> findByVersionCreatedAt(string $version_created_at) Return ChildHouse objects filtered by the version_created_at column
 * @method     ChildHouse[]|Collection findByVersionCreatedBy(string $version_created_by) Return ChildHouse objects filtered by the version_created_by column
 * @psalm-method Collection&\Traversable<ChildHouse> findByVersionCreatedBy(string $version_created_by) Return ChildHouse objects filtered by the version_created_by column
 * @method     ChildHouse[]|Collection findByVersionComment(string $version_comment) Return ChildHouse objects filtered by the version_comment column
 * @psalm-method Collection&\Traversable<ChildHouse> findByVersionComment(string $version_comment) Return ChildHouse objects filtered by the version_comment column
 * @method     ChildHouse[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildHouse> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class HouseQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \DB\Base\HouseQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\DB\\House', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildHouseQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildHouseQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildHouseQuery) {
            return $criteria;
        }
        $query = new ChildHouseQuery();
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
     * @return ChildHouse|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(HouseTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = HouseTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildHouse A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, status, is_available, group_id, version, version_created_at, version_created_by, version_comment FROM house WHERE id = :p0';
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
            /** @var ChildHouse $obj */
            $obj = new ChildHouse();
            $obj->hydrate($row);
            HouseTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildHouse|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(HouseTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(HouseTableMap::COL_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(HouseTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(HouseTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(HouseTableMap::COL_ID, $id, $comparison);

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

        $this->addUsingAlias(HouseTableMap::COL_NAME, $name, $comparison);

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

        $this->addUsingAlias(HouseTableMap::COL_STATUS, $status, $comparison);

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

        $this->addUsingAlias(HouseTableMap::COL_IS_AVAILABLE, $isAvailable, $comparison);

        return $this;
    }

    /**
     * Filter the query on the group_id column
     *
     * Example usage:
     * <code>
     * $query->filterByGroupId(1234); // WHERE group_id = 1234
     * $query->filterByGroupId(array(12, 34)); // WHERE group_id IN (12, 34)
     * $query->filterByGroupId(array('min' => 12)); // WHERE group_id > 12
     * </code>
     *
     * @see       filterByGroups()
     *
     * @param mixed $groupId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGroupId($groupId = null, ?string $comparison = null)
    {
        if (is_array($groupId)) {
            $useMinMax = false;
            if (isset($groupId['min'])) {
                $this->addUsingAlias(HouseTableMap::COL_GROUP_ID, $groupId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($groupId['max'])) {
                $this->addUsingAlias(HouseTableMap::COL_GROUP_ID, $groupId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(HouseTableMap::COL_GROUP_ID, $groupId, $comparison);

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
                $this->addUsingAlias(HouseTableMap::COL_VERSION, $version['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($version['max'])) {
                $this->addUsingAlias(HouseTableMap::COL_VERSION, $version['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(HouseTableMap::COL_VERSION, $version, $comparison);

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
                $this->addUsingAlias(HouseTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($versionCreatedAt['max'])) {
                $this->addUsingAlias(HouseTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(HouseTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt, $comparison);

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

        $this->addUsingAlias(HouseTableMap::COL_VERSION_CREATED_BY, $versionCreatedBy, $comparison);

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

        $this->addUsingAlias(HouseTableMap::COL_VERSION_COMMENT, $versionComment, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \DB\Groups object
     *
     * @param \DB\Groups|ObjectCollection $groups The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGroups($groups, ?string $comparison = null)
    {
        if ($groups instanceof \DB\Groups) {
            return $this
                ->addUsingAlias(HouseTableMap::COL_GROUP_ID, $groups->getId(), $comparison);
        } elseif ($groups instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(HouseTableMap::COL_GROUP_ID, $groups->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByGroups() only accepts arguments of type \DB\Groups or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Groups relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinGroups(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Groups');

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
            $this->addJoinObject($join, 'Groups');
        }

        return $this;
    }

    /**
     * Use the Groups relation Groups object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\GroupsQuery A secondary query class using the current class as primary query
     */
    public function useGroupsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinGroups($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Groups', '\DB\GroupsQuery');
    }

    /**
     * Use the Groups relation Groups object
     *
     * @param callable(\DB\GroupsQuery):\DB\GroupsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withGroupsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useGroupsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to Groups table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\GroupsQuery The inner query object of the EXISTS statement
     */
    public function useGroupsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('Groups', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to Groups table for a NOT EXISTS query.
     *
     * @see useGroupsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\GroupsQuery The inner query object of the NOT EXISTS statement
     */
    public function useGroupsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('Groups', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \DB\HouseVersion object
     *
     * @param \DB\HouseVersion|ObjectCollection $houseVersion the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByHouseVersion($houseVersion, ?string $comparison = null)
    {
        if ($houseVersion instanceof \DB\HouseVersion) {
            $this
                ->addUsingAlias(HouseTableMap::COL_ID, $houseVersion->getId(), $comparison);

            return $this;
        } elseif ($houseVersion instanceof ObjectCollection) {
            $this
                ->useHouseVersionQuery()
                ->filterByPrimaryKeys($houseVersion->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByHouseVersion() only accepts arguments of type \DB\HouseVersion or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the HouseVersion relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinHouseVersion(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('HouseVersion');

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
            $this->addJoinObject($join, 'HouseVersion');
        }

        return $this;
    }

    /**
     * Use the HouseVersion relation HouseVersion object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\HouseVersionQuery A secondary query class using the current class as primary query
     */
    public function useHouseVersionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinHouseVersion($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'HouseVersion', '\DB\HouseVersionQuery');
    }

    /**
     * Use the HouseVersion relation HouseVersion object
     *
     * @param callable(\DB\HouseVersionQuery):\DB\HouseVersionQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withHouseVersionQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useHouseVersionQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to HouseVersion table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\HouseVersionQuery The inner query object of the EXISTS statement
     */
    public function useHouseVersionExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('HouseVersion', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to HouseVersion table for a NOT EXISTS query.
     *
     * @see useHouseVersionExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\HouseVersionQuery The inner query object of the NOT EXISTS statement
     */
    public function useHouseVersionNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('HouseVersion', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \DB\Stage object
     *
     * @param \DB\Stage|ObjectCollection $stage the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStage($stage, ?string $comparison = null)
    {
        if ($stage instanceof \DB\Stage) {
            $this
                ->addUsingAlias(HouseTableMap::COL_ID, $stage->getHouseId(), $comparison);

            return $this;
        } elseif ($stage instanceof ObjectCollection) {
            $this
                ->useStageQuery()
                ->filterByPrimaryKeys($stage->getPrimaryKeys())
                ->endUse();

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
     * @param ChildHouse $house Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($house = null)
    {
        if ($house) {
            $this->addUsingAlias(HouseTableMap::COL_ID, $house->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the house table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(HouseTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            HouseTableMap::clearInstancePool();
            HouseTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(HouseTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(HouseTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            HouseTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            HouseTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
