<?php

namespace DB\Base;

use \Exception;
use \PDO;
use DB\HouseVersion as ChildHouseVersion;
use DB\HouseVersionQuery as ChildHouseVersionQuery;
use DB\Map\HouseVersionTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'house_version' table.
 *
 *
 *
 * @method     ChildHouseVersionQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildHouseVersionQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildHouseVersionQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildHouseVersionQuery orderByIsAvailable($order = Criteria::ASC) Order by the is_available column
 * @method     ChildHouseVersionQuery orderByGroupId($order = Criteria::ASC) Order by the group_id column
 * @method     ChildHouseVersionQuery orderByVersion($order = Criteria::ASC) Order by the version column
 * @method     ChildHouseVersionQuery orderByVersionCreatedAt($order = Criteria::ASC) Order by the version_created_at column
 * @method     ChildHouseVersionQuery orderByVersionCreatedBy($order = Criteria::ASC) Order by the version_created_by column
 * @method     ChildHouseVersionQuery orderByVersionComment($order = Criteria::ASC) Order by the version_comment column
 * @method     ChildHouseVersionQuery orderByGroupIdVersion($order = Criteria::ASC) Order by the group_id_version column
 * @method     ChildHouseVersionQuery orderByStageIds($order = Criteria::ASC) Order by the stage_ids column
 * @method     ChildHouseVersionQuery orderByStageVersions($order = Criteria::ASC) Order by the stage_versions column
 *
 * @method     ChildHouseVersionQuery groupById() Group by the id column
 * @method     ChildHouseVersionQuery groupByName() Group by the name column
 * @method     ChildHouseVersionQuery groupByStatus() Group by the status column
 * @method     ChildHouseVersionQuery groupByIsAvailable() Group by the is_available column
 * @method     ChildHouseVersionQuery groupByGroupId() Group by the group_id column
 * @method     ChildHouseVersionQuery groupByVersion() Group by the version column
 * @method     ChildHouseVersionQuery groupByVersionCreatedAt() Group by the version_created_at column
 * @method     ChildHouseVersionQuery groupByVersionCreatedBy() Group by the version_created_by column
 * @method     ChildHouseVersionQuery groupByVersionComment() Group by the version_comment column
 * @method     ChildHouseVersionQuery groupByGroupIdVersion() Group by the group_id_version column
 * @method     ChildHouseVersionQuery groupByStageIds() Group by the stage_ids column
 * @method     ChildHouseVersionQuery groupByStageVersions() Group by the stage_versions column
 *
 * @method     ChildHouseVersionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildHouseVersionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildHouseVersionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildHouseVersionQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildHouseVersionQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildHouseVersionQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildHouseVersionQuery leftJoinHouse($relationAlias = null) Adds a LEFT JOIN clause to the query using the House relation
 * @method     ChildHouseVersionQuery rightJoinHouse($relationAlias = null) Adds a RIGHT JOIN clause to the query using the House relation
 * @method     ChildHouseVersionQuery innerJoinHouse($relationAlias = null) Adds a INNER JOIN clause to the query using the House relation
 *
 * @method     ChildHouseVersionQuery joinWithHouse($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the House relation
 *
 * @method     ChildHouseVersionQuery leftJoinWithHouse() Adds a LEFT JOIN clause and with to the query using the House relation
 * @method     ChildHouseVersionQuery rightJoinWithHouse() Adds a RIGHT JOIN clause and with to the query using the House relation
 * @method     ChildHouseVersionQuery innerJoinWithHouse() Adds a INNER JOIN clause and with to the query using the House relation
 *
 * @method     \DB\HouseQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildHouseVersion|null findOne(?ConnectionInterface $con = null) Return the first ChildHouseVersion matching the query
 * @method     ChildHouseVersion findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildHouseVersion matching the query, or a new ChildHouseVersion object populated from the query conditions when no match is found
 *
 * @method     ChildHouseVersion|null findOneById(int $id) Return the first ChildHouseVersion filtered by the id column
 * @method     ChildHouseVersion|null findOneByName(string $name) Return the first ChildHouseVersion filtered by the name column
 * @method     ChildHouseVersion|null findOneByStatus(string $status) Return the first ChildHouseVersion filtered by the status column
 * @method     ChildHouseVersion|null findOneByIsAvailable(boolean $is_available) Return the first ChildHouseVersion filtered by the is_available column
 * @method     ChildHouseVersion|null findOneByGroupId(int $group_id) Return the first ChildHouseVersion filtered by the group_id column
 * @method     ChildHouseVersion|null findOneByVersion(int $version) Return the first ChildHouseVersion filtered by the version column
 * @method     ChildHouseVersion|null findOneByVersionCreatedAt(string $version_created_at) Return the first ChildHouseVersion filtered by the version_created_at column
 * @method     ChildHouseVersion|null findOneByVersionCreatedBy(string $version_created_by) Return the first ChildHouseVersion filtered by the version_created_by column
 * @method     ChildHouseVersion|null findOneByVersionComment(string $version_comment) Return the first ChildHouseVersion filtered by the version_comment column
 * @method     ChildHouseVersion|null findOneByGroupIdVersion(int $group_id_version) Return the first ChildHouseVersion filtered by the group_id_version column
 * @method     ChildHouseVersion|null findOneByStageIds(string $stage_ids) Return the first ChildHouseVersion filtered by the stage_ids column
 * @method     ChildHouseVersion|null findOneByStageVersions(string $stage_versions) Return the first ChildHouseVersion filtered by the stage_versions column *

 * @method     ChildHouseVersion requirePk($key, ?ConnectionInterface $con = null) Return the ChildHouseVersion by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHouseVersion requireOne(?ConnectionInterface $con = null) Return the first ChildHouseVersion matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildHouseVersion requireOneById(int $id) Return the first ChildHouseVersion filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHouseVersion requireOneByName(string $name) Return the first ChildHouseVersion filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHouseVersion requireOneByStatus(string $status) Return the first ChildHouseVersion filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHouseVersion requireOneByIsAvailable(boolean $is_available) Return the first ChildHouseVersion filtered by the is_available column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHouseVersion requireOneByGroupId(int $group_id) Return the first ChildHouseVersion filtered by the group_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHouseVersion requireOneByVersion(int $version) Return the first ChildHouseVersion filtered by the version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHouseVersion requireOneByVersionCreatedAt(string $version_created_at) Return the first ChildHouseVersion filtered by the version_created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHouseVersion requireOneByVersionCreatedBy(string $version_created_by) Return the first ChildHouseVersion filtered by the version_created_by column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHouseVersion requireOneByVersionComment(string $version_comment) Return the first ChildHouseVersion filtered by the version_comment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHouseVersion requireOneByGroupIdVersion(int $group_id_version) Return the first ChildHouseVersion filtered by the group_id_version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHouseVersion requireOneByStageIds(string $stage_ids) Return the first ChildHouseVersion filtered by the stage_ids column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHouseVersion requireOneByStageVersions(string $stage_versions) Return the first ChildHouseVersion filtered by the stage_versions column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildHouseVersion[]|Collection find(?ConnectionInterface $con = null) Return ChildHouseVersion objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildHouseVersion> find(?ConnectionInterface $con = null) Return ChildHouseVersion objects based on current ModelCriteria
 * @method     ChildHouseVersion[]|Collection findById(int $id) Return ChildHouseVersion objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildHouseVersion> findById(int $id) Return ChildHouseVersion objects filtered by the id column
 * @method     ChildHouseVersion[]|Collection findByName(string $name) Return ChildHouseVersion objects filtered by the name column
 * @psalm-method Collection&\Traversable<ChildHouseVersion> findByName(string $name) Return ChildHouseVersion objects filtered by the name column
 * @method     ChildHouseVersion[]|Collection findByStatus(string $status) Return ChildHouseVersion objects filtered by the status column
 * @psalm-method Collection&\Traversable<ChildHouseVersion> findByStatus(string $status) Return ChildHouseVersion objects filtered by the status column
 * @method     ChildHouseVersion[]|Collection findByIsAvailable(boolean $is_available) Return ChildHouseVersion objects filtered by the is_available column
 * @psalm-method Collection&\Traversable<ChildHouseVersion> findByIsAvailable(boolean $is_available) Return ChildHouseVersion objects filtered by the is_available column
 * @method     ChildHouseVersion[]|Collection findByGroupId(int $group_id) Return ChildHouseVersion objects filtered by the group_id column
 * @psalm-method Collection&\Traversable<ChildHouseVersion> findByGroupId(int $group_id) Return ChildHouseVersion objects filtered by the group_id column
 * @method     ChildHouseVersion[]|Collection findByVersion(int $version) Return ChildHouseVersion objects filtered by the version column
 * @psalm-method Collection&\Traversable<ChildHouseVersion> findByVersion(int $version) Return ChildHouseVersion objects filtered by the version column
 * @method     ChildHouseVersion[]|Collection findByVersionCreatedAt(string $version_created_at) Return ChildHouseVersion objects filtered by the version_created_at column
 * @psalm-method Collection&\Traversable<ChildHouseVersion> findByVersionCreatedAt(string $version_created_at) Return ChildHouseVersion objects filtered by the version_created_at column
 * @method     ChildHouseVersion[]|Collection findByVersionCreatedBy(string $version_created_by) Return ChildHouseVersion objects filtered by the version_created_by column
 * @psalm-method Collection&\Traversable<ChildHouseVersion> findByVersionCreatedBy(string $version_created_by) Return ChildHouseVersion objects filtered by the version_created_by column
 * @method     ChildHouseVersion[]|Collection findByVersionComment(string $version_comment) Return ChildHouseVersion objects filtered by the version_comment column
 * @psalm-method Collection&\Traversable<ChildHouseVersion> findByVersionComment(string $version_comment) Return ChildHouseVersion objects filtered by the version_comment column
 * @method     ChildHouseVersion[]|Collection findByGroupIdVersion(int $group_id_version) Return ChildHouseVersion objects filtered by the group_id_version column
 * @psalm-method Collection&\Traversable<ChildHouseVersion> findByGroupIdVersion(int $group_id_version) Return ChildHouseVersion objects filtered by the group_id_version column
 * @method     ChildHouseVersion[]|Collection findByStageIds(string $stage_ids) Return ChildHouseVersion objects filtered by the stage_ids column
 * @psalm-method Collection&\Traversable<ChildHouseVersion> findByStageIds(string $stage_ids) Return ChildHouseVersion objects filtered by the stage_ids column
 * @method     ChildHouseVersion[]|Collection findByStageVersions(string $stage_versions) Return ChildHouseVersion objects filtered by the stage_versions column
 * @psalm-method Collection&\Traversable<ChildHouseVersion> findByStageVersions(string $stage_versions) Return ChildHouseVersion objects filtered by the stage_versions column
 * @method     ChildHouseVersion[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildHouseVersion> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class HouseVersionQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \DB\Base\HouseVersionQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\DB\\HouseVersion', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildHouseVersionQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildHouseVersionQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildHouseVersionQuery) {
            return $criteria;
        }
        $query = new ChildHouseVersionQuery();
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
     * @return ChildHouseVersion|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(HouseVersionTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = HouseVersionTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildHouseVersion A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, status, is_available, group_id, version, version_created_at, version_created_by, version_comment, group_id_version, stage_ids, stage_versions FROM house_version WHERE id = :p0 AND version = :p1';
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
            /** @var ChildHouseVersion $obj */
            $obj = new ChildHouseVersion();
            $obj->hydrate($row);
            HouseVersionTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildHouseVersion|array|mixed the result, formatted by the current formatter
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
        $this->addUsingAlias(HouseVersionTableMap::COL_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(HouseVersionTableMap::COL_VERSION, $key[1], Criteria::EQUAL);

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
            $cton0 = $this->getNewCriterion(HouseVersionTableMap::COL_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(HouseVersionTableMap::COL_VERSION, $key[1], Criteria::EQUAL);
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
     * @see       filterByHouse()
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
                $this->addUsingAlias(HouseVersionTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(HouseVersionTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(HouseVersionTableMap::COL_ID, $id, $comparison);

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

        $this->addUsingAlias(HouseVersionTableMap::COL_NAME, $name, $comparison);

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

        $this->addUsingAlias(HouseVersionTableMap::COL_STATUS, $status, $comparison);

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

        $this->addUsingAlias(HouseVersionTableMap::COL_IS_AVAILABLE, $isAvailable, $comparison);

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
                $this->addUsingAlias(HouseVersionTableMap::COL_GROUP_ID, $groupId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($groupId['max'])) {
                $this->addUsingAlias(HouseVersionTableMap::COL_GROUP_ID, $groupId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(HouseVersionTableMap::COL_GROUP_ID, $groupId, $comparison);

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
                $this->addUsingAlias(HouseVersionTableMap::COL_VERSION, $version['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($version['max'])) {
                $this->addUsingAlias(HouseVersionTableMap::COL_VERSION, $version['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(HouseVersionTableMap::COL_VERSION, $version, $comparison);

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
                $this->addUsingAlias(HouseVersionTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($versionCreatedAt['max'])) {
                $this->addUsingAlias(HouseVersionTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(HouseVersionTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt, $comparison);

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

        $this->addUsingAlias(HouseVersionTableMap::COL_VERSION_CREATED_BY, $versionCreatedBy, $comparison);

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

        $this->addUsingAlias(HouseVersionTableMap::COL_VERSION_COMMENT, $versionComment, $comparison);

        return $this;
    }

    /**
     * Filter the query on the group_id_version column
     *
     * Example usage:
     * <code>
     * $query->filterByGroupIdVersion(1234); // WHERE group_id_version = 1234
     * $query->filterByGroupIdVersion(array(12, 34)); // WHERE group_id_version IN (12, 34)
     * $query->filterByGroupIdVersion(array('min' => 12)); // WHERE group_id_version > 12
     * </code>
     *
     * @param mixed $groupIdVersion The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGroupIdVersion($groupIdVersion = null, ?string $comparison = null)
    {
        if (is_array($groupIdVersion)) {
            $useMinMax = false;
            if (isset($groupIdVersion['min'])) {
                $this->addUsingAlias(HouseVersionTableMap::COL_GROUP_ID_VERSION, $groupIdVersion['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($groupIdVersion['max'])) {
                $this->addUsingAlias(HouseVersionTableMap::COL_GROUP_ID_VERSION, $groupIdVersion['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(HouseVersionTableMap::COL_GROUP_ID_VERSION, $groupIdVersion, $comparison);

        return $this;
    }

    /**
     * Filter the query on the stage_ids column
     *
     * Example usage:
     * <code>
     * $query->filterByStageIds('fooValue');   // WHERE stage_ids = 'fooValue'
     * $query->filterByStageIds('%fooValue%', Criteria::LIKE); // WHERE stage_ids LIKE '%fooValue%'
     * $query->filterByStageIds(['foo', 'bar']); // WHERE stage_ids IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $stageIds The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStageIds($stageIds = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($stageIds)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(HouseVersionTableMap::COL_STAGE_IDS, $stageIds, $comparison);

        return $this;
    }

    /**
     * Filter the query on the stage_versions column
     *
     * Example usage:
     * <code>
     * $query->filterByStageVersions('fooValue');   // WHERE stage_versions = 'fooValue'
     * $query->filterByStageVersions('%fooValue%', Criteria::LIKE); // WHERE stage_versions LIKE '%fooValue%'
     * $query->filterByStageVersions(['foo', 'bar']); // WHERE stage_versions IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $stageVersions The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStageVersions($stageVersions = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($stageVersions)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(HouseVersionTableMap::COL_STAGE_VERSIONS, $stageVersions, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \DB\House object
     *
     * @param \DB\House|ObjectCollection $house The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByHouse($house, ?string $comparison = null)
    {
        if ($house instanceof \DB\House) {
            return $this
                ->addUsingAlias(HouseVersionTableMap::COL_ID, $house->getId(), $comparison);
        } elseif ($house instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(HouseVersionTableMap::COL_ID, $house->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByHouse() only accepts arguments of type \DB\House or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the House relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinHouse(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('House');

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
            $this->addJoinObject($join, 'House');
        }

        return $this;
    }

    /**
     * Use the House relation House object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\HouseQuery A secondary query class using the current class as primary query
     */
    public function useHouseQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinHouse($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'House', '\DB\HouseQuery');
    }

    /**
     * Use the House relation House object
     *
     * @param callable(\DB\HouseQuery):\DB\HouseQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withHouseQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useHouseQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to House table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\HouseQuery The inner query object of the EXISTS statement
     */
    public function useHouseExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('House', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to House table for a NOT EXISTS query.
     *
     * @see useHouseExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\HouseQuery The inner query object of the NOT EXISTS statement
     */
    public function useHouseNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('House', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Exclude object from result
     *
     * @param ChildHouseVersion $houseVersion Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($houseVersion = null)
    {
        if ($houseVersion) {
            $this->addCond('pruneCond0', $this->getAliasedColName(HouseVersionTableMap::COL_ID), $houseVersion->getId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(HouseVersionTableMap::COL_VERSION), $houseVersion->getVersion(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the house_version table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(HouseVersionTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            HouseVersionTableMap::clearInstancePool();
            HouseVersionTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(HouseVersionTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(HouseVersionTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            HouseVersionTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            HouseVersionTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
