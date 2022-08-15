<?php

namespace DB\Base;

use \Exception;
use \PDO;
use DB\SubprojectVersion as ChildSubprojectVersion;
use DB\SubprojectVersionQuery as ChildSubprojectVersionQuery;
use DB\Map\SubprojectVersionTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'subproject_version' table.
 *
 *
 *
 * @method     ChildSubprojectVersionQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildSubprojectVersionQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildSubprojectVersionQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildSubprojectVersionQuery orderByIsAvailable($order = Criteria::ASC) Order by the is_available column
 * @method     ChildSubprojectVersionQuery orderByProjectId($order = Criteria::ASC) Order by the project_id column
 * @method     ChildSubprojectVersionQuery orderByVersion($order = Criteria::ASC) Order by the version column
 * @method     ChildSubprojectVersionQuery orderByProjectIdVersion($order = Criteria::ASC) Order by the project_id_version column
 * @method     ChildSubprojectVersionQuery orderByGroupsIds($order = Criteria::ASC) Order by the groups_ids column
 * @method     ChildSubprojectVersionQuery orderByGroupsVersions($order = Criteria::ASC) Order by the groups_versions column
 *
 * @method     ChildSubprojectVersionQuery groupById() Group by the id column
 * @method     ChildSubprojectVersionQuery groupByName() Group by the name column
 * @method     ChildSubprojectVersionQuery groupByStatus() Group by the status column
 * @method     ChildSubprojectVersionQuery groupByIsAvailable() Group by the is_available column
 * @method     ChildSubprojectVersionQuery groupByProjectId() Group by the project_id column
 * @method     ChildSubprojectVersionQuery groupByVersion() Group by the version column
 * @method     ChildSubprojectVersionQuery groupByProjectIdVersion() Group by the project_id_version column
 * @method     ChildSubprojectVersionQuery groupByGroupsIds() Group by the groups_ids column
 * @method     ChildSubprojectVersionQuery groupByGroupsVersions() Group by the groups_versions column
 *
 * @method     ChildSubprojectVersionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSubprojectVersionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSubprojectVersionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSubprojectVersionQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSubprojectVersionQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSubprojectVersionQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSubprojectVersionQuery leftJoinSubproject($relationAlias = null) Adds a LEFT JOIN clause to the query using the Subproject relation
 * @method     ChildSubprojectVersionQuery rightJoinSubproject($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Subproject relation
 * @method     ChildSubprojectVersionQuery innerJoinSubproject($relationAlias = null) Adds a INNER JOIN clause to the query using the Subproject relation
 *
 * @method     ChildSubprojectVersionQuery joinWithSubproject($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Subproject relation
 *
 * @method     ChildSubprojectVersionQuery leftJoinWithSubproject() Adds a LEFT JOIN clause and with to the query using the Subproject relation
 * @method     ChildSubprojectVersionQuery rightJoinWithSubproject() Adds a RIGHT JOIN clause and with to the query using the Subproject relation
 * @method     ChildSubprojectVersionQuery innerJoinWithSubproject() Adds a INNER JOIN clause and with to the query using the Subproject relation
 *
 * @method     \DB\SubprojectQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSubprojectVersion|null findOne(?ConnectionInterface $con = null) Return the first ChildSubprojectVersion matching the query
 * @method     ChildSubprojectVersion findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSubprojectVersion matching the query, or a new ChildSubprojectVersion object populated from the query conditions when no match is found
 *
 * @method     ChildSubprojectVersion|null findOneById(int $id) Return the first ChildSubprojectVersion filtered by the id column
 * @method     ChildSubprojectVersion|null findOneByName(string $name) Return the first ChildSubprojectVersion filtered by the name column
 * @method     ChildSubprojectVersion|null findOneByStatus(string $status) Return the first ChildSubprojectVersion filtered by the status column
 * @method     ChildSubprojectVersion|null findOneByIsAvailable(boolean $is_available) Return the first ChildSubprojectVersion filtered by the is_available column
 * @method     ChildSubprojectVersion|null findOneByProjectId(int $project_id) Return the first ChildSubprojectVersion filtered by the project_id column
 * @method     ChildSubprojectVersion|null findOneByVersion(int $version) Return the first ChildSubprojectVersion filtered by the version column
 * @method     ChildSubprojectVersion|null findOneByProjectIdVersion(int $project_id_version) Return the first ChildSubprojectVersion filtered by the project_id_version column
 * @method     ChildSubprojectVersion|null findOneByGroupsIds(array $groups_ids) Return the first ChildSubprojectVersion filtered by the groups_ids column
 * @method     ChildSubprojectVersion|null findOneByGroupsVersions(array $groups_versions) Return the first ChildSubprojectVersion filtered by the groups_versions column *

 * @method     ChildSubprojectVersion requirePk($key, ?ConnectionInterface $con = null) Return the ChildSubprojectVersion by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSubprojectVersion requireOne(?ConnectionInterface $con = null) Return the first ChildSubprojectVersion matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSubprojectVersion requireOneById(int $id) Return the first ChildSubprojectVersion filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSubprojectVersion requireOneByName(string $name) Return the first ChildSubprojectVersion filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSubprojectVersion requireOneByStatus(string $status) Return the first ChildSubprojectVersion filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSubprojectVersion requireOneByIsAvailable(boolean $is_available) Return the first ChildSubprojectVersion filtered by the is_available column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSubprojectVersion requireOneByProjectId(int $project_id) Return the first ChildSubprojectVersion filtered by the project_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSubprojectVersion requireOneByVersion(int $version) Return the first ChildSubprojectVersion filtered by the version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSubprojectVersion requireOneByProjectIdVersion(int $project_id_version) Return the first ChildSubprojectVersion filtered by the project_id_version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSubprojectVersion requireOneByGroupsIds(array $groups_ids) Return the first ChildSubprojectVersion filtered by the groups_ids column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSubprojectVersion requireOneByGroupsVersions(array $groups_versions) Return the first ChildSubprojectVersion filtered by the groups_versions column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSubprojectVersion[]|Collection find(?ConnectionInterface $con = null) Return ChildSubprojectVersion objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSubprojectVersion> find(?ConnectionInterface $con = null) Return ChildSubprojectVersion objects based on current ModelCriteria
 * @method     ChildSubprojectVersion[]|Collection findById(int $id) Return ChildSubprojectVersion objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildSubprojectVersion> findById(int $id) Return ChildSubprojectVersion objects filtered by the id column
 * @method     ChildSubprojectVersion[]|Collection findByName(string $name) Return ChildSubprojectVersion objects filtered by the name column
 * @psalm-method Collection&\Traversable<ChildSubprojectVersion> findByName(string $name) Return ChildSubprojectVersion objects filtered by the name column
 * @method     ChildSubprojectVersion[]|Collection findByStatus(string $status) Return ChildSubprojectVersion objects filtered by the status column
 * @psalm-method Collection&\Traversable<ChildSubprojectVersion> findByStatus(string $status) Return ChildSubprojectVersion objects filtered by the status column
 * @method     ChildSubprojectVersion[]|Collection findByIsAvailable(boolean $is_available) Return ChildSubprojectVersion objects filtered by the is_available column
 * @psalm-method Collection&\Traversable<ChildSubprojectVersion> findByIsAvailable(boolean $is_available) Return ChildSubprojectVersion objects filtered by the is_available column
 * @method     ChildSubprojectVersion[]|Collection findByProjectId(int $project_id) Return ChildSubprojectVersion objects filtered by the project_id column
 * @psalm-method Collection&\Traversable<ChildSubprojectVersion> findByProjectId(int $project_id) Return ChildSubprojectVersion objects filtered by the project_id column
 * @method     ChildSubprojectVersion[]|Collection findByVersion(int $version) Return ChildSubprojectVersion objects filtered by the version column
 * @psalm-method Collection&\Traversable<ChildSubprojectVersion> findByVersion(int $version) Return ChildSubprojectVersion objects filtered by the version column
 * @method     ChildSubprojectVersion[]|Collection findByProjectIdVersion(int $project_id_version) Return ChildSubprojectVersion objects filtered by the project_id_version column
 * @psalm-method Collection&\Traversable<ChildSubprojectVersion> findByProjectIdVersion(int $project_id_version) Return ChildSubprojectVersion objects filtered by the project_id_version column
 * @method     ChildSubprojectVersion[]|Collection findByGroupsIds(array $groups_ids) Return ChildSubprojectVersion objects filtered by the groups_ids column
 * @psalm-method Collection&\Traversable<ChildSubprojectVersion> findByGroupsIds(array $groups_ids) Return ChildSubprojectVersion objects filtered by the groups_ids column
 * @method     ChildSubprojectVersion[]|Collection findByGroupsVersions(array $groups_versions) Return ChildSubprojectVersion objects filtered by the groups_versions column
 * @psalm-method Collection&\Traversable<ChildSubprojectVersion> findByGroupsVersions(array $groups_versions) Return ChildSubprojectVersion objects filtered by the groups_versions column
 * @method     ChildSubprojectVersion[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSubprojectVersion> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class SubprojectVersionQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \DB\Base\SubprojectVersionQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\DB\\SubprojectVersion', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSubprojectVersionQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSubprojectVersionQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSubprojectVersionQuery) {
            return $criteria;
        }
        $query = new ChildSubprojectVersionQuery();
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
     * @return ChildSubprojectVersion|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SubprojectVersionTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = SubprojectVersionTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildSubprojectVersion A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, status, is_available, project_id, version, project_id_version, groups_ids, groups_versions FROM subproject_version WHERE id = :p0 AND version = :p1';
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
            /** @var ChildSubprojectVersion $obj */
            $obj = new ChildSubprojectVersion();
            $obj->hydrate($row);
            SubprojectVersionTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildSubprojectVersion|array|mixed the result, formatted by the current formatter
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
        $this->addUsingAlias(SubprojectVersionTableMap::COL_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(SubprojectVersionTableMap::COL_VERSION, $key[1], Criteria::EQUAL);

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
            $cton0 = $this->getNewCriterion(SubprojectVersionTableMap::COL_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(SubprojectVersionTableMap::COL_VERSION, $key[1], Criteria::EQUAL);
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
     * @see       filterBySubproject()
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
                $this->addUsingAlias(SubprojectVersionTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(SubprojectVersionTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SubprojectVersionTableMap::COL_ID, $id, $comparison);

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

        $this->addUsingAlias(SubprojectVersionTableMap::COL_NAME, $name, $comparison);

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

        $this->addUsingAlias(SubprojectVersionTableMap::COL_STATUS, $status, $comparison);

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

        $this->addUsingAlias(SubprojectVersionTableMap::COL_IS_AVAILABLE, $isAvailable, $comparison);

        return $this;
    }

    /**
     * Filter the query on the project_id column
     *
     * Example usage:
     * <code>
     * $query->filterByProjectId(1234); // WHERE project_id = 1234
     * $query->filterByProjectId(array(12, 34)); // WHERE project_id IN (12, 34)
     * $query->filterByProjectId(array('min' => 12)); // WHERE project_id > 12
     * </code>
     *
     * @param mixed $projectId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProjectId($projectId = null, ?string $comparison = null)
    {
        if (is_array($projectId)) {
            $useMinMax = false;
            if (isset($projectId['min'])) {
                $this->addUsingAlias(SubprojectVersionTableMap::COL_PROJECT_ID, $projectId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($projectId['max'])) {
                $this->addUsingAlias(SubprojectVersionTableMap::COL_PROJECT_ID, $projectId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SubprojectVersionTableMap::COL_PROJECT_ID, $projectId, $comparison);

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
                $this->addUsingAlias(SubprojectVersionTableMap::COL_VERSION, $version['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($version['max'])) {
                $this->addUsingAlias(SubprojectVersionTableMap::COL_VERSION, $version['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SubprojectVersionTableMap::COL_VERSION, $version, $comparison);

        return $this;
    }

    /**
     * Filter the query on the project_id_version column
     *
     * Example usage:
     * <code>
     * $query->filterByProjectIdVersion(1234); // WHERE project_id_version = 1234
     * $query->filterByProjectIdVersion(array(12, 34)); // WHERE project_id_version IN (12, 34)
     * $query->filterByProjectIdVersion(array('min' => 12)); // WHERE project_id_version > 12
     * </code>
     *
     * @param mixed $projectIdVersion The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProjectIdVersion($projectIdVersion = null, ?string $comparison = null)
    {
        if (is_array($projectIdVersion)) {
            $useMinMax = false;
            if (isset($projectIdVersion['min'])) {
                $this->addUsingAlias(SubprojectVersionTableMap::COL_PROJECT_ID_VERSION, $projectIdVersion['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($projectIdVersion['max'])) {
                $this->addUsingAlias(SubprojectVersionTableMap::COL_PROJECT_ID_VERSION, $projectIdVersion['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SubprojectVersionTableMap::COL_PROJECT_ID_VERSION, $projectIdVersion, $comparison);

        return $this;
    }

    /**
     * Filter the query on the groups_ids column
     *
     * @param array $groupsIds The values to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGroupsIds($groupsIds = null, ?string $comparison = null)
    {
        $key = $this->getAliasedColName(SubprojectVersionTableMap::COL_GROUPS_IDS);
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            foreach ($groupsIds as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addAnd($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_SOME) {
            foreach ($groupsIds as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addOr($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            foreach ($groupsIds as $value) {
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

        $this->addUsingAlias(SubprojectVersionTableMap::COL_GROUPS_IDS, $groupsIds, $comparison);

        return $this;
    }

    /**
     * Filter the query on the groups_ids column
     * @param mixed $groupsIds The value to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::CONTAINS_ALL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGroupsId($groupsIds = null, ?string $comparison = null)
    {
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            if (is_scalar($groupsIds)) {
                $groupsIds = '%| ' . $groupsIds . ' |%';
                $comparison = Criteria::LIKE;
            }
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            $groupsIds = '%| ' . $groupsIds . ' |%';
            $comparison = Criteria::NOT_LIKE;
            $key = $this->getAliasedColName(SubprojectVersionTableMap::COL_GROUPS_IDS);
            if ($this->containsKey($key)) {
                $this->addAnd($key, $groupsIds, $comparison);
            } else {
                $this->addAnd($key, $groupsIds, $comparison);
            }
            $this->addOr($key, null, Criteria::ISNULL);

            return $this;
        }

        $this->addUsingAlias(SubprojectVersionTableMap::COL_GROUPS_IDS, $groupsIds, $comparison);

        return $this;
    }

    /**
     * Filter the query on the groups_versions column
     *
     * @param array $groupsVersions The values to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGroupsVersions($groupsVersions = null, ?string $comparison = null)
    {
        $key = $this->getAliasedColName(SubprojectVersionTableMap::COL_GROUPS_VERSIONS);
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            foreach ($groupsVersions as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addAnd($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_SOME) {
            foreach ($groupsVersions as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addOr($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            foreach ($groupsVersions as $value) {
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

        $this->addUsingAlias(SubprojectVersionTableMap::COL_GROUPS_VERSIONS, $groupsVersions, $comparison);

        return $this;
    }

    /**
     * Filter the query on the groups_versions column
     * @param mixed $groupsVersions The value to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::CONTAINS_ALL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGroupsVersion($groupsVersions = null, ?string $comparison = null)
    {
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            if (is_scalar($groupsVersions)) {
                $groupsVersions = '%| ' . $groupsVersions . ' |%';
                $comparison = Criteria::LIKE;
            }
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            $groupsVersions = '%| ' . $groupsVersions . ' |%';
            $comparison = Criteria::NOT_LIKE;
            $key = $this->getAliasedColName(SubprojectVersionTableMap::COL_GROUPS_VERSIONS);
            if ($this->containsKey($key)) {
                $this->addAnd($key, $groupsVersions, $comparison);
            } else {
                $this->addAnd($key, $groupsVersions, $comparison);
            }
            $this->addOr($key, null, Criteria::ISNULL);

            return $this;
        }

        $this->addUsingAlias(SubprojectVersionTableMap::COL_GROUPS_VERSIONS, $groupsVersions, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \DB\Subproject object
     *
     * @param \DB\Subproject|ObjectCollection $subproject The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySubproject($subproject, ?string $comparison = null)
    {
        if ($subproject instanceof \DB\Subproject) {
            return $this
                ->addUsingAlias(SubprojectVersionTableMap::COL_ID, $subproject->getId(), $comparison);
        } elseif ($subproject instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SubprojectVersionTableMap::COL_ID, $subproject->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterBySubproject() only accepts arguments of type \DB\Subproject or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Subproject relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSubproject(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Subproject');

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
            $this->addJoinObject($join, 'Subproject');
        }

        return $this;
    }

    /**
     * Use the Subproject relation Subproject object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\SubprojectQuery A secondary query class using the current class as primary query
     */
    public function useSubprojectQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSubproject($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Subproject', '\DB\SubprojectQuery');
    }

    /**
     * Use the Subproject relation Subproject object
     *
     * @param callable(\DB\SubprojectQuery):\DB\SubprojectQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSubprojectQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSubprojectQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to Subproject table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\SubprojectQuery The inner query object of the EXISTS statement
     */
    public function useSubprojectExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('Subproject', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to Subproject table for a NOT EXISTS query.
     *
     * @see useSubprojectExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\SubprojectQuery The inner query object of the NOT EXISTS statement
     */
    public function useSubprojectNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('Subproject', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Exclude object from result
     *
     * @param ChildSubprojectVersion $subprojectVersion Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($subprojectVersion = null)
    {
        if ($subprojectVersion) {
            $this->addCond('pruneCond0', $this->getAliasedColName(SubprojectVersionTableMap::COL_ID), $subprojectVersion->getId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(SubprojectVersionTableMap::COL_VERSION), $subprojectVersion->getVersion(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the subproject_version table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SubprojectVersionTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SubprojectVersionTableMap::clearInstancePool();
            SubprojectVersionTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SubprojectVersionTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SubprojectVersionTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SubprojectVersionTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SubprojectVersionTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
