<?php

namespace DB\Base;

use \Exception;
use \PDO;
use DB\GroupsVersion as ChildGroupsVersion;
use DB\GroupsVersionQuery as ChildGroupsVersionQuery;
use DB\Map\GroupsVersionTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'groups_version' table.
 *
 *
 *
 * @method     ChildGroupsVersionQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildGroupsVersionQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildGroupsVersionQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildGroupsVersionQuery orderByIsAvailable($order = Criteria::ASC) Order by the is_available column
 * @method     ChildGroupsVersionQuery orderBySubprojectId($order = Criteria::ASC) Order by the subproject_id column
 * @method     ChildGroupsVersionQuery orderByVersion($order = Criteria::ASC) Order by the version column
 * @method     ChildGroupsVersionQuery orderByVersionCreatedAt($order = Criteria::ASC) Order by the version_created_at column
 * @method     ChildGroupsVersionQuery orderByVersionCreatedBy($order = Criteria::ASC) Order by the version_created_by column
 * @method     ChildGroupsVersionQuery orderByVersionComment($order = Criteria::ASC) Order by the version_comment column
 * @method     ChildGroupsVersionQuery orderBySubprojectIdVersion($order = Criteria::ASC) Order by the subproject_id_version column
 * @method     ChildGroupsVersionQuery orderByHouseIds($order = Criteria::ASC) Order by the house_ids column
 * @method     ChildGroupsVersionQuery orderByHouseVersions($order = Criteria::ASC) Order by the house_versions column
 *
 * @method     ChildGroupsVersionQuery groupById() Group by the id column
 * @method     ChildGroupsVersionQuery groupByName() Group by the name column
 * @method     ChildGroupsVersionQuery groupByStatus() Group by the status column
 * @method     ChildGroupsVersionQuery groupByIsAvailable() Group by the is_available column
 * @method     ChildGroupsVersionQuery groupBySubprojectId() Group by the subproject_id column
 * @method     ChildGroupsVersionQuery groupByVersion() Group by the version column
 * @method     ChildGroupsVersionQuery groupByVersionCreatedAt() Group by the version_created_at column
 * @method     ChildGroupsVersionQuery groupByVersionCreatedBy() Group by the version_created_by column
 * @method     ChildGroupsVersionQuery groupByVersionComment() Group by the version_comment column
 * @method     ChildGroupsVersionQuery groupBySubprojectIdVersion() Group by the subproject_id_version column
 * @method     ChildGroupsVersionQuery groupByHouseIds() Group by the house_ids column
 * @method     ChildGroupsVersionQuery groupByHouseVersions() Group by the house_versions column
 *
 * @method     ChildGroupsVersionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildGroupsVersionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildGroupsVersionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildGroupsVersionQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildGroupsVersionQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildGroupsVersionQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildGroupsVersionQuery leftJoinGroups($relationAlias = null) Adds a LEFT JOIN clause to the query using the Groups relation
 * @method     ChildGroupsVersionQuery rightJoinGroups($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Groups relation
 * @method     ChildGroupsVersionQuery innerJoinGroups($relationAlias = null) Adds a INNER JOIN clause to the query using the Groups relation
 *
 * @method     ChildGroupsVersionQuery joinWithGroups($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Groups relation
 *
 * @method     ChildGroupsVersionQuery leftJoinWithGroups() Adds a LEFT JOIN clause and with to the query using the Groups relation
 * @method     ChildGroupsVersionQuery rightJoinWithGroups() Adds a RIGHT JOIN clause and with to the query using the Groups relation
 * @method     ChildGroupsVersionQuery innerJoinWithGroups() Adds a INNER JOIN clause and with to the query using the Groups relation
 *
 * @method     \DB\GroupsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildGroupsVersion|null findOne(?ConnectionInterface $con = null) Return the first ChildGroupsVersion matching the query
 * @method     ChildGroupsVersion findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildGroupsVersion matching the query, or a new ChildGroupsVersion object populated from the query conditions when no match123 is found
 *
 * @method     ChildGroupsVersion|null findOneById(int $id) Return the first ChildGroupsVersion filtered by the id column
 * @method     ChildGroupsVersion|null findOneByName(string $name) Return the first ChildGroupsVersion filtered by the name column
 * @method     ChildGroupsVersion|null findOneByStatus(string $status) Return the first ChildGroupsVersion filtered by the status column
 * @method     ChildGroupsVersion|null findOneByIsAvailable(boolean $is_available) Return the first ChildGroupsVersion filtered by the is_available column
 * @method     ChildGroupsVersion|null findOneBySubprojectId(int $subproject_id) Return the first ChildGroupsVersion filtered by the subproject_id column
 * @method     ChildGroupsVersion|null findOneByVersion(int $version) Return the first ChildGroupsVersion filtered by the version column
 * @method     ChildGroupsVersion|null findOneByVersionCreatedAt(string $version_created_at) Return the first ChildGroupsVersion filtered by the version_created_at column
 * @method     ChildGroupsVersion|null findOneByVersionCreatedBy(string $version_created_by) Return the first ChildGroupsVersion filtered by the version_created_by column
 * @method     ChildGroupsVersion|null findOneByVersionComment(string $version_comment) Return the first ChildGroupsVersion filtered by the version_comment column
 * @method     ChildGroupsVersion|null findOneBySubprojectIdVersion(int $subproject_id_version) Return the first ChildGroupsVersion filtered by the subproject_id_version column
 * @method     ChildGroupsVersion|null findOneByHouseIds(array $house_ids) Return the first ChildGroupsVersion filtered by the house_ids column
 * @method     ChildGroupsVersion|null findOneByHouseVersions(array $house_versions) Return the first ChildGroupsVersion filtered by the house_versions column *

 * @method     ChildGroupsVersion requirePk($key, ?ConnectionInterface $con = null) Return the ChildGroupsVersion by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroupsVersion requireOne(?ConnectionInterface $con = null) Return the first ChildGroupsVersion matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildGroupsVersion requireOneById(int $id) Return the first ChildGroupsVersion filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroupsVersion requireOneByName(string $name) Return the first ChildGroupsVersion filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroupsVersion requireOneByStatus(string $status) Return the first ChildGroupsVersion filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroupsVersion requireOneByIsAvailable(boolean $is_available) Return the first ChildGroupsVersion filtered by the is_available column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroupsVersion requireOneBySubprojectId(int $subproject_id) Return the first ChildGroupsVersion filtered by the subproject_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroupsVersion requireOneByVersion(int $version) Return the first ChildGroupsVersion filtered by the version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroupsVersion requireOneByVersionCreatedAt(string $version_created_at) Return the first ChildGroupsVersion filtered by the version_created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroupsVersion requireOneByVersionCreatedBy(string $version_created_by) Return the first ChildGroupsVersion filtered by the version_created_by column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroupsVersion requireOneByVersionComment(string $version_comment) Return the first ChildGroupsVersion filtered by the version_comment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroupsVersion requireOneBySubprojectIdVersion(int $subproject_id_version) Return the first ChildGroupsVersion filtered by the subproject_id_version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroupsVersion requireOneByHouseIds(array $house_ids) Return the first ChildGroupsVersion filtered by the house_ids column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroupsVersion requireOneByHouseVersions(array $house_versions) Return the first ChildGroupsVersion filtered by the house_versions column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildGroupsVersion[]|Collection find(?ConnectionInterface $con = null) Return ChildGroupsVersion objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildGroupsVersion> find(?ConnectionInterface $con = null) Return ChildGroupsVersion objects based on current ModelCriteria
 * @method     ChildGroupsVersion[]|Collection findById(int $id) Return ChildGroupsVersion objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildGroupsVersion> findById(int $id) Return ChildGroupsVersion objects filtered by the id column
 * @method     ChildGroupsVersion[]|Collection findByName(string $name) Return ChildGroupsVersion objects filtered by the name column
 * @psalm-method Collection&\Traversable<ChildGroupsVersion> findByName(string $name) Return ChildGroupsVersion objects filtered by the name column
 * @method     ChildGroupsVersion[]|Collection findByStatus(string $status) Return ChildGroupsVersion objects filtered by the status column
 * @psalm-method Collection&\Traversable<ChildGroupsVersion> findByStatus(string $status) Return ChildGroupsVersion objects filtered by the status column
 * @method     ChildGroupsVersion[]|Collection findByIsAvailable(boolean $is_available) Return ChildGroupsVersion objects filtered by the is_available column
 * @psalm-method Collection&\Traversable<ChildGroupsVersion> findByIsAvailable(boolean $is_available) Return ChildGroupsVersion objects filtered by the is_available column
 * @method     ChildGroupsVersion[]|Collection findBySubprojectId(int $subproject_id) Return ChildGroupsVersion objects filtered by the subproject_id column
 * @psalm-method Collection&\Traversable<ChildGroupsVersion> findBySubprojectId(int $subproject_id) Return ChildGroupsVersion objects filtered by the subproject_id column
 * @method     ChildGroupsVersion[]|Collection findByVersion(int $version) Return ChildGroupsVersion objects filtered by the version column
 * @psalm-method Collection&\Traversable<ChildGroupsVersion> findByVersion(int $version) Return ChildGroupsVersion objects filtered by the version column
 * @method     ChildGroupsVersion[]|Collection findByVersionCreatedAt(string $version_created_at) Return ChildGroupsVersion objects filtered by the version_created_at column
 * @psalm-method Collection&\Traversable<ChildGroupsVersion> findByVersionCreatedAt(string $version_created_at) Return ChildGroupsVersion objects filtered by the version_created_at column
 * @method     ChildGroupsVersion[]|Collection findByVersionCreatedBy(string $version_created_by) Return ChildGroupsVersion objects filtered by the version_created_by column
 * @psalm-method Collection&\Traversable<ChildGroupsVersion> findByVersionCreatedBy(string $version_created_by) Return ChildGroupsVersion objects filtered by the version_created_by column
 * @method     ChildGroupsVersion[]|Collection findByVersionComment(string $version_comment) Return ChildGroupsVersion objects filtered by the version_comment column
 * @psalm-method Collection&\Traversable<ChildGroupsVersion> findByVersionComment(string $version_comment) Return ChildGroupsVersion objects filtered by the version_comment column
 * @method     ChildGroupsVersion[]|Collection findBySubprojectIdVersion(int $subproject_id_version) Return ChildGroupsVersion objects filtered by the subproject_id_version column
 * @psalm-method Collection&\Traversable<ChildGroupsVersion> findBySubprojectIdVersion(int $subproject_id_version) Return ChildGroupsVersion objects filtered by the subproject_id_version column
 * @method     ChildGroupsVersion[]|Collection findByHouseIds(array $house_ids) Return ChildGroupsVersion objects filtered by the house_ids column
 * @psalm-method Collection&\Traversable<ChildGroupsVersion> findByHouseIds(array $house_ids) Return ChildGroupsVersion objects filtered by the house_ids column
 * @method     ChildGroupsVersion[]|Collection findByHouseVersions(array $house_versions) Return ChildGroupsVersion objects filtered by the house_versions column
 * @psalm-method Collection&\Traversable<ChildGroupsVersion> findByHouseVersions(array $house_versions) Return ChildGroupsVersion objects filtered by the house_versions column
 * @method     ChildGroupsVersion[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildGroupsVersion> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class GroupsVersionQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \DB\Base\GroupsVersionQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\DB\\GroupsVersion', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildGroupsVersionQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildGroupsVersionQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildGroupsVersionQuery) {
            return $criteria;
        }
        $query = new ChildGroupsVersionQuery();
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
     * @return ChildGroupsVersion|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(GroupsVersionTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = GroupsVersionTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildGroupsVersion A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, status, is_available, subproject_id, version, version_created_at, version_created_by, version_comment, subproject_id_version, house_ids, house_versions FROM groups_version WHERE id = :p0 AND version = :p1';
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
            /** @var ChildGroupsVersion $obj */
            $obj = new ChildGroupsVersion();
            $obj->hydrate($row);
            GroupsVersionTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildGroupsVersion|array|mixed the result, formatted by the current formatter
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
        $this->addUsingAlias(GroupsVersionTableMap::COL_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(GroupsVersionTableMap::COL_VERSION, $key[1], Criteria::EQUAL);

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
            $cton0 = $this->getNewCriterion(GroupsVersionTableMap::COL_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(GroupsVersionTableMap::COL_VERSION, $key[1], Criteria::EQUAL);
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
     * @see       filterByGroups()
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
                $this->addUsingAlias(GroupsVersionTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(GroupsVersionTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GroupsVersionTableMap::COL_ID, $id, $comparison);

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

        $this->addUsingAlias(GroupsVersionTableMap::COL_NAME, $name, $comparison);

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

        $this->addUsingAlias(GroupsVersionTableMap::COL_STATUS, $status, $comparison);

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

        $this->addUsingAlias(GroupsVersionTableMap::COL_IS_AVAILABLE, $isAvailable, $comparison);

        return $this;
    }

    /**
     * Filter the query on the subproject_id column
     *
     * Example usage:
     * <code>
     * $query->filterBySubprojectId(1234); // WHERE subproject_id = 1234
     * $query->filterBySubprojectId(array(12, 34)); // WHERE subproject_id IN (12, 34)
     * $query->filterBySubprojectId(array('min' => 12)); // WHERE subproject_id > 12
     * </code>
     *
     * @param mixed $subprojectId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySubprojectId($subprojectId = null, ?string $comparison = null)
    {
        if (is_array($subprojectId)) {
            $useMinMax = false;
            if (isset($subprojectId['min'])) {
                $this->addUsingAlias(GroupsVersionTableMap::COL_SUBPROJECT_ID, $subprojectId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($subprojectId['max'])) {
                $this->addUsingAlias(GroupsVersionTableMap::COL_SUBPROJECT_ID, $subprojectId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GroupsVersionTableMap::COL_SUBPROJECT_ID, $subprojectId, $comparison);

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
                $this->addUsingAlias(GroupsVersionTableMap::COL_VERSION, $version['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($version['max'])) {
                $this->addUsingAlias(GroupsVersionTableMap::COL_VERSION, $version['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GroupsVersionTableMap::COL_VERSION, $version, $comparison);

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
                $this->addUsingAlias(GroupsVersionTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($versionCreatedAt['max'])) {
                $this->addUsingAlias(GroupsVersionTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GroupsVersionTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt, $comparison);

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

        $this->addUsingAlias(GroupsVersionTableMap::COL_VERSION_CREATED_BY, $versionCreatedBy, $comparison);

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

        $this->addUsingAlias(GroupsVersionTableMap::COL_VERSION_COMMENT, $versionComment, $comparison);

        return $this;
    }

    /**
     * Filter the query on the subproject_id_version column
     *
     * Example usage:
     * <code>
     * $query->filterBySubprojectIdVersion(1234); // WHERE subproject_id_version = 1234
     * $query->filterBySubprojectIdVersion(array(12, 34)); // WHERE subproject_id_version IN (12, 34)
     * $query->filterBySubprojectIdVersion(array('min' => 12)); // WHERE subproject_id_version > 12
     * </code>
     *
     * @param mixed $subprojectIdVersion The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySubprojectIdVersion($subprojectIdVersion = null, ?string $comparison = null)
    {
        if (is_array($subprojectIdVersion)) {
            $useMinMax = false;
            if (isset($subprojectIdVersion['min'])) {
                $this->addUsingAlias(GroupsVersionTableMap::COL_SUBPROJECT_ID_VERSION, $subprojectIdVersion['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($subprojectIdVersion['max'])) {
                $this->addUsingAlias(GroupsVersionTableMap::COL_SUBPROJECT_ID_VERSION, $subprojectIdVersion['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GroupsVersionTableMap::COL_SUBPROJECT_ID_VERSION, $subprojectIdVersion, $comparison);

        return $this;
    }

    /**
     * Filter the query on the house_ids column
     *
     * @param array $houseIds The values to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByHouseIds($houseIds = null, ?string $comparison = null)
    {
        $key = $this->getAliasedColName(GroupsVersionTableMap::COL_HOUSE_IDS);
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            foreach ($houseIds as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addAnd($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_SOME) {
            foreach ($houseIds as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addOr($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            foreach ($houseIds as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addAnd($key, $value, Criteria::NOT_LIKE);
                } else {
                    $this->add($key, $value, Criteria::NOT_LIKE);
                }
            }
            $this->addOr($key, null, Criteria::ISNULL);

            return $this;
        }

        $this->addUsingAlias(GroupsVersionTableMap::COL_HOUSE_IDS, $houseIds, $comparison);

        return $this;
    }

    /**
     * Filter the query on the house_ids column
     * @param mixed $houseIds The value to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::CONTAINS_ALL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByHouseId($houseIds = null, ?string $comparison = null)
    {
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            if (is_scalar($houseIds)) {
                $houseIds = '%| ' . $houseIds . ' |%';
                $comparison = Criteria::LIKE;
            }
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            $houseIds = '%| ' . $houseIds . ' |%';
            $comparison = Criteria::NOT_LIKE;
            $key = $this->getAliasedColName(GroupsVersionTableMap::COL_HOUSE_IDS);
            if ($this->containsKey($key)) {
                $this->addAnd($key, $houseIds, $comparison);
            } else {
                $this->addAnd($key, $houseIds, $comparison);
            }
            $this->addOr($key, null, Criteria::ISNULL);

            return $this;
        }

        $this->addUsingAlias(GroupsVersionTableMap::COL_HOUSE_IDS, $houseIds, $comparison);

        return $this;
    }

    /**
     * Filter the query on the house_versions column
     *
     * @param array $houseVersions The values to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByHouseVersions($houseVersions = null, ?string $comparison = null)
    {
        $key = $this->getAliasedColName(GroupsVersionTableMap::COL_HOUSE_VERSIONS);
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            foreach ($houseVersions as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addAnd($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_SOME) {
            foreach ($houseVersions as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addOr($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            foreach ($houseVersions as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addAnd($key, $value, Criteria::NOT_LIKE);
                } else {
                    $this->add($key, $value, Criteria::NOT_LIKE);
                }
            }
            $this->addOr($key, null, Criteria::ISNULL);

            return $this;
        }

        $this->addUsingAlias(GroupsVersionTableMap::COL_HOUSE_VERSIONS, $houseVersions, $comparison);

        return $this;
    }

    /**
     * Filter the query on the house_versions column
     * @param mixed $houseVersions The value to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::CONTAINS_ALL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByHouseVersion($houseVersions = null, ?string $comparison = null)
    {
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            if (is_scalar($houseVersions)) {
                $houseVersions = '%| ' . $houseVersions . ' |%';
                $comparison = Criteria::LIKE;
            }
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            $houseVersions = '%| ' . $houseVersions . ' |%';
            $comparison = Criteria::NOT_LIKE;
            $key = $this->getAliasedColName(GroupsVersionTableMap::COL_HOUSE_VERSIONS);
            if ($this->containsKey($key)) {
                $this->addAnd($key, $houseVersions, $comparison);
            } else {
                $this->addAnd($key, $houseVersions, $comparison);
            }
            $this->addOr($key, null, Criteria::ISNULL);

            return $this;
        }

        $this->addUsingAlias(GroupsVersionTableMap::COL_HOUSE_VERSIONS, $houseVersions, $comparison);

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
                ->addUsingAlias(GroupsVersionTableMap::COL_ID, $groups->getId(), $comparison);
        } elseif ($groups instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(GroupsVersionTableMap::COL_ID, $groups->toKeyValue('PrimaryKey', 'Id'), $comparison);

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
     * Exclude object from result
     *
     * @param ChildGroupsVersion $groupsVersion Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($groupsVersion = null)
    {
        if ($groupsVersion) {
            $this->addCond('pruneCond0', $this->getAliasedColName(GroupsVersionTableMap::COL_ID), $groupsVersion->getId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(GroupsVersionTableMap::COL_VERSION), $groupsVersion->getVersion(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the groups_version table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(GroupsVersionTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            GroupsVersionTableMap::clearInstancePool();
            GroupsVersionTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(GroupsVersionTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(GroupsVersionTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            GroupsVersionTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            GroupsVersionTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
