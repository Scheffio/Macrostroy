<?php

namespace DB\Base;

use \Exception;
use \PDO;
use DB\Project as ChildProject;
use DB\ProjectQuery as ChildProjectQuery;
use DB\Map\ProjectTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'project' table.
 *
 *
 *
 * @method     ChildProjectQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildProjectQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildProjectQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildProjectQuery orderByIsAvailable($order = Criteria::ASC) Order by the is_available column
 * @method     ChildProjectQuery orderByVersion($order = Criteria::ASC) Order by the version column
 * @method     ChildProjectQuery orderByVersionCreatedAt($order = Criteria::ASC) Order by the version_created_at column
 * @method     ChildProjectQuery orderByVersionCreatedBy($order = Criteria::ASC) Order by the version_created_by column
 * @method     ChildProjectQuery orderByVersionComment($order = Criteria::ASC) Order by the version_comment column
 *
 * @method     ChildProjectQuery groupById() Group by the id column
 * @method     ChildProjectQuery groupByName() Group by the name column
 * @method     ChildProjectQuery groupByStatus() Group by the status column
 * @method     ChildProjectQuery groupByIsAvailable() Group by the is_available column
 * @method     ChildProjectQuery groupByVersion() Group by the version column
 * @method     ChildProjectQuery groupByVersionCreatedAt() Group by the version_created_at column
 * @method     ChildProjectQuery groupByVersionCreatedBy() Group by the version_created_by column
 * @method     ChildProjectQuery groupByVersionComment() Group by the version_comment column
 *
 * @method     ChildProjectQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildProjectQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildProjectQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildProjectQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildProjectQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildProjectQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildProjectQuery leftJoinProjectRole($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProjectRole relation
 * @method     ChildProjectQuery rightJoinProjectRole($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProjectRole relation
 * @method     ChildProjectQuery innerJoinProjectRole($relationAlias = null) Adds a INNER JOIN clause to the query using the ProjectRole relation
 *
 * @method     ChildProjectQuery joinWithProjectRole($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProjectRole relation
 *
 * @method     ChildProjectQuery leftJoinWithProjectRole() Adds a LEFT JOIN clause and with to the query using the ProjectRole relation
 * @method     ChildProjectQuery rightJoinWithProjectRole() Adds a RIGHT JOIN clause and with to the query using the ProjectRole relation
 * @method     ChildProjectQuery innerJoinWithProjectRole() Adds a INNER JOIN clause and with to the query using the ProjectRole relation
 *
 * @method     ChildProjectQuery leftJoinProjectVersion($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProjectVersion relation
 * @method     ChildProjectQuery rightJoinProjectVersion($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProjectVersion relation
 * @method     ChildProjectQuery innerJoinProjectVersion($relationAlias = null) Adds a INNER JOIN clause to the query using the ProjectVersion relation
 *
 * @method     ChildProjectQuery joinWithProjectVersion($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProjectVersion relation
 *
 * @method     ChildProjectQuery leftJoinWithProjectVersion() Adds a LEFT JOIN clause and with to the query using the ProjectVersion relation
 * @method     ChildProjectQuery rightJoinWithProjectVersion() Adds a RIGHT JOIN clause and with to the query using the ProjectVersion relation
 * @method     ChildProjectQuery innerJoinWithProjectVersion() Adds a INNER JOIN clause and with to the query using the ProjectVersion relation
 *
 * @method     ChildProjectQuery leftJoinSubproject($relationAlias = null) Adds a LEFT JOIN clause to the query using the Subproject relation
 * @method     ChildProjectQuery rightJoinSubproject($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Subproject relation
 * @method     ChildProjectQuery innerJoinSubproject($relationAlias = null) Adds a INNER JOIN clause to the query using the Subproject relation
 *
 * @method     ChildProjectQuery joinWithSubproject($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Subproject relation
 *
 * @method     ChildProjectQuery leftJoinWithSubproject() Adds a LEFT JOIN clause and with to the query using the Subproject relation
 * @method     ChildProjectQuery rightJoinWithSubproject() Adds a RIGHT JOIN clause and with to the query using the Subproject relation
 * @method     ChildProjectQuery innerJoinWithSubproject() Adds a INNER JOIN clause and with to the query using the Subproject relation
 *
 * @method     \DB\ProjectRoleQuery|\DB\ProjectVersionQuery|\DB\SubprojectQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildProject|null findOne(?ConnectionInterface $con = null) Return the first ChildProject matching the query
 * @method     ChildProject findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildProject matching the query, or a new ChildProject object populated from the query conditions when no match is found
 *
 * @method     ChildProject|null findOneById(int $id) Return the first ChildProject filtered by the id column
 * @method     ChildProject|null findOneByName(string $name) Return the first ChildProject filtered by the name column
 * @method     ChildProject|null findOneByStatus(string $status) Return the first ChildProject filtered by the status column
 * @method     ChildProject|null findOneByIsAvailable(boolean $is_available) Return the first ChildProject filtered by the is_available column
 * @method     ChildProject|null findOneByVersion(int $version) Return the first ChildProject filtered by the version column
 * @method     ChildProject|null findOneByVersionCreatedAt(string $version_created_at) Return the first ChildProject filtered by the version_created_at column
 * @method     ChildProject|null findOneByVersionCreatedBy(string $version_created_by) Return the first ChildProject filtered by the version_created_by column
 * @method     ChildProject|null findOneByVersionComment(string $version_comment) Return the first ChildProject filtered by the version_comment column *

 * @method     ChildProject requirePk($key, ?ConnectionInterface $con = null) Return the ChildProject by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProject requireOne(?ConnectionInterface $con = null) Return the first ChildProject matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProject requireOneById(int $id) Return the first ChildProject filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProject requireOneByName(string $name) Return the first ChildProject filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProject requireOneByStatus(string $status) Return the first ChildProject filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProject requireOneByIsAvailable(boolean $is_available) Return the first ChildProject filtered by the is_available column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProject requireOneByVersion(int $version) Return the first ChildProject filtered by the version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProject requireOneByVersionCreatedAt(string $version_created_at) Return the first ChildProject filtered by the version_created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProject requireOneByVersionCreatedBy(string $version_created_by) Return the first ChildProject filtered by the version_created_by column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProject requireOneByVersionComment(string $version_comment) Return the first ChildProject filtered by the version_comment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProject[]|Collection find(?ConnectionInterface $con = null) Return ChildProject objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildProject> find(?ConnectionInterface $con = null) Return ChildProject objects based on current ModelCriteria
 * @method     ChildProject[]|Collection findById(int $id) Return ChildProject objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildProject> findById(int $id) Return ChildProject objects filtered by the id column
 * @method     ChildProject[]|Collection findByName(string $name) Return ChildProject objects filtered by the name column
 * @psalm-method Collection&\Traversable<ChildProject> findByName(string $name) Return ChildProject objects filtered by the name column
 * @method     ChildProject[]|Collection findByStatus(string $status) Return ChildProject objects filtered by the status column
 * @psalm-method Collection&\Traversable<ChildProject> findByStatus(string $status) Return ChildProject objects filtered by the status column
 * @method     ChildProject[]|Collection findByIsAvailable(boolean $is_available) Return ChildProject objects filtered by the is_available column
 * @psalm-method Collection&\Traversable<ChildProject> findByIsAvailable(boolean $is_available) Return ChildProject objects filtered by the is_available column
 * @method     ChildProject[]|Collection findByVersion(int $version) Return ChildProject objects filtered by the version column
 * @psalm-method Collection&\Traversable<ChildProject> findByVersion(int $version) Return ChildProject objects filtered by the version column
 * @method     ChildProject[]|Collection findByVersionCreatedAt(string $version_created_at) Return ChildProject objects filtered by the version_created_at column
 * @psalm-method Collection&\Traversable<ChildProject> findByVersionCreatedAt(string $version_created_at) Return ChildProject objects filtered by the version_created_at column
 * @method     ChildProject[]|Collection findByVersionCreatedBy(string $version_created_by) Return ChildProject objects filtered by the version_created_by column
 * @psalm-method Collection&\Traversable<ChildProject> findByVersionCreatedBy(string $version_created_by) Return ChildProject objects filtered by the version_created_by column
 * @method     ChildProject[]|Collection findByVersionComment(string $version_comment) Return ChildProject objects filtered by the version_comment column
 * @psalm-method Collection&\Traversable<ChildProject> findByVersionComment(string $version_comment) Return ChildProject objects filtered by the version_comment column
 * @method     ChildProject[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildProject> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ProjectQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \DB\Base\ProjectQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\DB\\Project', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildProjectQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildProjectQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildProjectQuery) {
            return $criteria;
        }
        $query = new ChildProjectQuery();
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
     * @return ChildProject|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ProjectTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ProjectTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildProject A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, status, is_available, version, version_created_at, version_created_by, version_comment FROM project WHERE id = :p0';
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
            /** @var ChildProject $obj */
            $obj = new ChildProject();
            $obj->hydrate($row);
            ProjectTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildProject|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(ProjectTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(ProjectTableMap::COL_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(ProjectTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ProjectTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ProjectTableMap::COL_ID, $id, $comparison);

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

        $this->addUsingAlias(ProjectTableMap::COL_NAME, $name, $comparison);

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

        $this->addUsingAlias(ProjectTableMap::COL_STATUS, $status, $comparison);

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

        $this->addUsingAlias(ProjectTableMap::COL_IS_AVAILABLE, $isAvailable, $comparison);

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
                $this->addUsingAlias(ProjectTableMap::COL_VERSION, $version['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($version['max'])) {
                $this->addUsingAlias(ProjectTableMap::COL_VERSION, $version['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ProjectTableMap::COL_VERSION, $version, $comparison);

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
                $this->addUsingAlias(ProjectTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($versionCreatedAt['max'])) {
                $this->addUsingAlias(ProjectTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ProjectTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt, $comparison);

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

        $this->addUsingAlias(ProjectTableMap::COL_VERSION_CREATED_BY, $versionCreatedBy, $comparison);

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

        $this->addUsingAlias(ProjectTableMap::COL_VERSION_COMMENT, $versionComment, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \DB\ProjectRole object
     *
     * @param \DB\ProjectRole|ObjectCollection $projectRole the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProjectRole($projectRole, ?string $comparison = null)
    {
        if ($projectRole instanceof \DB\ProjectRole) {
            $this
                ->addUsingAlias(ProjectTableMap::COL_ID, $projectRole->getProjectId(), $comparison);

            return $this;
        } elseif ($projectRole instanceof ObjectCollection) {
            $this
                ->useProjectRoleQuery()
                ->filterByPrimaryKeys($projectRole->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByProjectRole() only accepts arguments of type \DB\ProjectRole or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProjectRole relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinProjectRole(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProjectRole');

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
            $this->addJoinObject($join, 'ProjectRole');
        }

        return $this;
    }

    /**
     * Use the ProjectRole relation ProjectRole object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\ProjectRoleQuery A secondary query class using the current class as primary query
     */
    public function useProjectRoleQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProjectRole($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProjectRole', '\DB\ProjectRoleQuery');
    }

    /**
     * Use the ProjectRole relation ProjectRole object
     *
     * @param callable(\DB\ProjectRoleQuery):\DB\ProjectRoleQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withProjectRoleQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useProjectRoleQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to ProjectRole table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\ProjectRoleQuery The inner query object of the EXISTS statement
     */
    public function useProjectRoleExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('ProjectRole', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to ProjectRole table for a NOT EXISTS query.
     *
     * @see useProjectRoleExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\ProjectRoleQuery The inner query object of the NOT EXISTS statement
     */
    public function useProjectRoleNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('ProjectRole', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \DB\ProjectVersion object
     *
     * @param \DB\ProjectVersion|ObjectCollection $projectVersion the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProjectVersion($projectVersion, ?string $comparison = null)
    {
        if ($projectVersion instanceof \DB\ProjectVersion) {
            $this
                ->addUsingAlias(ProjectTableMap::COL_ID, $projectVersion->getId(), $comparison);

            return $this;
        } elseif ($projectVersion instanceof ObjectCollection) {
            $this
                ->useProjectVersionQuery()
                ->filterByPrimaryKeys($projectVersion->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByProjectVersion() only accepts arguments of type \DB\ProjectVersion or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProjectVersion relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinProjectVersion(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProjectVersion');

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
            $this->addJoinObject($join, 'ProjectVersion');
        }

        return $this;
    }

    /**
     * Use the ProjectVersion relation ProjectVersion object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\ProjectVersionQuery A secondary query class using the current class as primary query
     */
    public function useProjectVersionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProjectVersion($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProjectVersion', '\DB\ProjectVersionQuery');
    }

    /**
     * Use the ProjectVersion relation ProjectVersion object
     *
     * @param callable(\DB\ProjectVersionQuery):\DB\ProjectVersionQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withProjectVersionQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useProjectVersionQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to ProjectVersion table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\ProjectVersionQuery The inner query object of the EXISTS statement
     */
    public function useProjectVersionExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('ProjectVersion', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to ProjectVersion table for a NOT EXISTS query.
     *
     * @see useProjectVersionExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\ProjectVersionQuery The inner query object of the NOT EXISTS statement
     */
    public function useProjectVersionNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('ProjectVersion', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \DB\Subproject object
     *
     * @param \DB\Subproject|ObjectCollection $subproject the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySubproject($subproject, ?string $comparison = null)
    {
        if ($subproject instanceof \DB\Subproject) {
            $this
                ->addUsingAlias(ProjectTableMap::COL_ID, $subproject->getProjectId(), $comparison);

            return $this;
        } elseif ($subproject instanceof ObjectCollection) {
            $this
                ->useSubprojectQuery()
                ->filterByPrimaryKeys($subproject->getPrimaryKeys())
                ->endUse();

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
     * @param ChildProject $project Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($project = null)
    {
        if ($project) {
            $this->addUsingAlias(ProjectTableMap::COL_ID, $project->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the project table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProjectTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ProjectTableMap::clearInstancePool();
            ProjectTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ProjectTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ProjectTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ProjectTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ProjectTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
