<?php

namespace DB\Base;

use \Exception;
use \PDO;
use DB\Subproject as ChildSubproject;
use DB\SubprojectQuery as ChildSubprojectQuery;
use DB\Map\SubprojectTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'subproject' table.
 *
 *
 *
 * @method     ChildSubprojectQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildSubprojectQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildSubprojectQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildSubprojectQuery orderByIsAvailable($order = Criteria::ASC) Order by the is_available column
 * @method     ChildSubprojectQuery orderByProjectId($order = Criteria::ASC) Order by the project_id column
 * @method     ChildSubprojectQuery orderByVersion($order = Criteria::ASC) Order by the version column
 * @method     ChildSubprojectQuery orderByVersionCreatedAt($order = Criteria::ASC) Order by the version_created_at column
 * @method     ChildSubprojectQuery orderByVersionCreatedBy($order = Criteria::ASC) Order by the version_created_by column
 * @method     ChildSubprojectQuery orderByVersionComment($order = Criteria::ASC) Order by the version_comment column
 *
 * @method     ChildSubprojectQuery groupById() Group by the id column
 * @method     ChildSubprojectQuery groupByName() Group by the name column
 * @method     ChildSubprojectQuery groupByStatus() Group by the status column
 * @method     ChildSubprojectQuery groupByIsAvailable() Group by the is_available column
 * @method     ChildSubprojectQuery groupByProjectId() Group by the project_id column
 * @method     ChildSubprojectQuery groupByVersion() Group by the version column
 * @method     ChildSubprojectQuery groupByVersionCreatedAt() Group by the version_created_at column
 * @method     ChildSubprojectQuery groupByVersionCreatedBy() Group by the version_created_by column
 * @method     ChildSubprojectQuery groupByVersionComment() Group by the version_comment column
 *
 * @method     ChildSubprojectQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSubprojectQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSubprojectQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSubprojectQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSubprojectQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSubprojectQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSubprojectQuery leftJoinProject($relationAlias = null) Adds a LEFT JOIN clause to the query using the Project relation
 * @method     ChildSubprojectQuery rightJoinProject($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Project relation
 * @method     ChildSubprojectQuery innerJoinProject($relationAlias = null) Adds a INNER JOIN clause to the query using the Project relation
 *
 * @method     ChildSubprojectQuery joinWithProject($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Project relation
 *
 * @method     ChildSubprojectQuery leftJoinWithProject() Adds a LEFT JOIN clause and with to the query using the Project relation
 * @method     ChildSubprojectQuery rightJoinWithProject() Adds a RIGHT JOIN clause and with to the query using the Project relation
 * @method     ChildSubprojectQuery innerJoinWithProject() Adds a INNER JOIN clause and with to the query using the Project relation
 *
 * @method     ChildSubprojectQuery leftJoinGroups($relationAlias = null) Adds a LEFT JOIN clause to the query using the Groups relation
 * @method     ChildSubprojectQuery rightJoinGroups($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Groups relation
 * @method     ChildSubprojectQuery innerJoinGroups($relationAlias = null) Adds a INNER JOIN clause to the query using the Groups relation
 *
 * @method     ChildSubprojectQuery joinWithGroups($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Groups relation
 *
 * @method     ChildSubprojectQuery leftJoinWithGroups() Adds a LEFT JOIN clause and with to the query using the Groups relation
 * @method     ChildSubprojectQuery rightJoinWithGroups() Adds a RIGHT JOIN clause and with to the query using the Groups relation
 * @method     ChildSubprojectQuery innerJoinWithGroups() Adds a INNER JOIN clause and with to the query using the Groups relation
 *
 * @method     ChildSubprojectQuery leftJoinSubprojectVersion($relationAlias = null) Adds a LEFT JOIN clause to the query using the SubprojectVersion relation
 * @method     ChildSubprojectQuery rightJoinSubprojectVersion($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SubprojectVersion relation
 * @method     ChildSubprojectQuery innerJoinSubprojectVersion($relationAlias = null) Adds a INNER JOIN clause to the query using the SubprojectVersion relation
 *
 * @method     ChildSubprojectQuery joinWithSubprojectVersion($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SubprojectVersion relation
 *
 * @method     ChildSubprojectQuery leftJoinWithSubprojectVersion() Adds a LEFT JOIN clause and with to the query using the SubprojectVersion relation
 * @method     ChildSubprojectQuery rightJoinWithSubprojectVersion() Adds a RIGHT JOIN clause and with to the query using the SubprojectVersion relation
 * @method     ChildSubprojectQuery innerJoinWithSubprojectVersion() Adds a INNER JOIN clause and with to the query using the SubprojectVersion relation
 *
 * @method     \DB\ProjectQuery|\DB\GroupsQuery|\DB\SubprojectVersionQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSubproject|null findOne(?ConnectionInterface $con = null) Return the first ChildSubproject matching the query
 * @method     ChildSubproject findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSubproject matching the query, or a new ChildSubproject object populated from the query conditions when no match is found
 *
 * @method     ChildSubproject|null findOneById(int $id) Return the first ChildSubproject filtered by the id column
 * @method     ChildSubproject|null findOneByName(string $name) Return the first ChildSubproject filtered by the name column
 * @method     ChildSubproject|null findOneByStatus(string $status) Return the first ChildSubproject filtered by the status column
 * @method     ChildSubproject|null findOneByIsAvailable(boolean $is_available) Return the first ChildSubproject filtered by the is_available column
 * @method     ChildSubproject|null findOneByProjectId(int $project_id) Return the first ChildSubproject filtered by the project_id column
 * @method     ChildSubproject|null findOneByVersion(int $version) Return the first ChildSubproject filtered by the version column
 * @method     ChildSubproject|null findOneByVersionCreatedAt(string $version_created_at) Return the first ChildSubproject filtered by the version_created_at column
 * @method     ChildSubproject|null findOneByVersionCreatedBy(string $version_created_by) Return the first ChildSubproject filtered by the version_created_by column
 * @method     ChildSubproject|null findOneByVersionComment(string $version_comment) Return the first ChildSubproject filtered by the version_comment column *

 * @method     ChildSubproject requirePk($key, ?ConnectionInterface $con = null) Return the ChildSubproject by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSubproject requireOne(?ConnectionInterface $con = null) Return the first ChildSubproject matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSubproject requireOneById(int $id) Return the first ChildSubproject filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSubproject requireOneByName(string $name) Return the first ChildSubproject filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSubproject requireOneByStatus(string $status) Return the first ChildSubproject filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSubproject requireOneByIsAvailable(boolean $is_available) Return the first ChildSubproject filtered by the is_available column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSubproject requireOneByProjectId(int $project_id) Return the first ChildSubproject filtered by the project_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSubproject requireOneByVersion(int $version) Return the first ChildSubproject filtered by the version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSubproject requireOneByVersionCreatedAt(string $version_created_at) Return the first ChildSubproject filtered by the version_created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSubproject requireOneByVersionCreatedBy(string $version_created_by) Return the first ChildSubproject filtered by the version_created_by column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSubproject requireOneByVersionComment(string $version_comment) Return the first ChildSubproject filtered by the version_comment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSubproject[]|Collection find(?ConnectionInterface $con = null) Return ChildSubproject objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSubproject> find(?ConnectionInterface $con = null) Return ChildSubproject objects based on current ModelCriteria
 * @method     ChildSubproject[]|Collection findById(int $id) Return ChildSubproject objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildSubproject> findById(int $id) Return ChildSubproject objects filtered by the id column
 * @method     ChildSubproject[]|Collection findByName(string $name) Return ChildSubproject objects filtered by the name column
 * @psalm-method Collection&\Traversable<ChildSubproject> findByName(string $name) Return ChildSubproject objects filtered by the name column
 * @method     ChildSubproject[]|Collection findByStatus(string $status) Return ChildSubproject objects filtered by the status column
 * @psalm-method Collection&\Traversable<ChildSubproject> findByStatus(string $status) Return ChildSubproject objects filtered by the status column
 * @method     ChildSubproject[]|Collection findByIsAvailable(boolean $is_available) Return ChildSubproject objects filtered by the is_available column
 * @psalm-method Collection&\Traversable<ChildSubproject> findByIsAvailable(boolean $is_available) Return ChildSubproject objects filtered by the is_available column
 * @method     ChildSubproject[]|Collection findByProjectId(int $project_id) Return ChildSubproject objects filtered by the project_id column
 * @psalm-method Collection&\Traversable<ChildSubproject> findByProjectId(int $project_id) Return ChildSubproject objects filtered by the project_id column
 * @method     ChildSubproject[]|Collection findByVersion(int $version) Return ChildSubproject objects filtered by the version column
 * @psalm-method Collection&\Traversable<ChildSubproject> findByVersion(int $version) Return ChildSubproject objects filtered by the version column
 * @method     ChildSubproject[]|Collection findByVersionCreatedAt(string $version_created_at) Return ChildSubproject objects filtered by the version_created_at column
 * @psalm-method Collection&\Traversable<ChildSubproject> findByVersionCreatedAt(string $version_created_at) Return ChildSubproject objects filtered by the version_created_at column
 * @method     ChildSubproject[]|Collection findByVersionCreatedBy(string $version_created_by) Return ChildSubproject objects filtered by the version_created_by column
 * @psalm-method Collection&\Traversable<ChildSubproject> findByVersionCreatedBy(string $version_created_by) Return ChildSubproject objects filtered by the version_created_by column
 * @method     ChildSubproject[]|Collection findByVersionComment(string $version_comment) Return ChildSubproject objects filtered by the version_comment column
 * @psalm-method Collection&\Traversable<ChildSubproject> findByVersionComment(string $version_comment) Return ChildSubproject objects filtered by the version_comment column
 * @method     ChildSubproject[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSubproject> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class SubprojectQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \DB\Base\SubprojectQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\DB\\Subproject', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSubprojectQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSubprojectQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSubprojectQuery) {
            return $criteria;
        }
        $query = new ChildSubprojectQuery();
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
     * @return ChildSubproject|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SubprojectTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = SubprojectTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSubproject A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, status, is_available, project_id, version, version_created_at, version_created_by, version_comment FROM subproject WHERE id = :p0';
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
            /** @var ChildSubproject $obj */
            $obj = new ChildSubproject();
            $obj->hydrate($row);
            SubprojectTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSubproject|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SubprojectTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SubprojectTableMap::COL_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(SubprojectTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(SubprojectTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SubprojectTableMap::COL_ID, $id, $comparison);

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

        $this->addUsingAlias(SubprojectTableMap::COL_NAME, $name, $comparison);

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

        $this->addUsingAlias(SubprojectTableMap::COL_STATUS, $status, $comparison);

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

        $this->addUsingAlias(SubprojectTableMap::COL_IS_AVAILABLE, $isAvailable, $comparison);

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
     * @see       filterByProject()
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
                $this->addUsingAlias(SubprojectTableMap::COL_PROJECT_ID, $projectId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($projectId['max'])) {
                $this->addUsingAlias(SubprojectTableMap::COL_PROJECT_ID, $projectId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SubprojectTableMap::COL_PROJECT_ID, $projectId, $comparison);

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
                $this->addUsingAlias(SubprojectTableMap::COL_VERSION, $version['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($version['max'])) {
                $this->addUsingAlias(SubprojectTableMap::COL_VERSION, $version['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SubprojectTableMap::COL_VERSION, $version, $comparison);

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
                $this->addUsingAlias(SubprojectTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($versionCreatedAt['max'])) {
                $this->addUsingAlias(SubprojectTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SubprojectTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt, $comparison);

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

        $this->addUsingAlias(SubprojectTableMap::COL_VERSION_CREATED_BY, $versionCreatedBy, $comparison);

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

        $this->addUsingAlias(SubprojectTableMap::COL_VERSION_COMMENT, $versionComment, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \DB\Project object
     *
     * @param \DB\Project|ObjectCollection $project The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProject($project, ?string $comparison = null)
    {
        if ($project instanceof \DB\Project) {
            return $this
                ->addUsingAlias(SubprojectTableMap::COL_PROJECT_ID, $project->getId(), $comparison);
        } elseif ($project instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SubprojectTableMap::COL_PROJECT_ID, $project->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByProject() only accepts arguments of type \DB\Project or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Project relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinProject(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Project');

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
            $this->addJoinObject($join, 'Project');
        }

        return $this;
    }

    /**
     * Use the Project relation Project object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\ProjectQuery A secondary query class using the current class as primary query
     */
    public function useProjectQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProject($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Project', '\DB\ProjectQuery');
    }

    /**
     * Use the Project relation Project object
     *
     * @param callable(\DB\ProjectQuery):\DB\ProjectQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withProjectQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useProjectQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to Project table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\ProjectQuery The inner query object of the EXISTS statement
     */
    public function useProjectExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('Project', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to Project table for a NOT EXISTS query.
     *
     * @see useProjectExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\ProjectQuery The inner query object of the NOT EXISTS statement
     */
    public function useProjectNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('Project', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \DB\Groups object
     *
     * @param \DB\Groups|ObjectCollection $groups the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGroups($groups, ?string $comparison = null)
    {
        if ($groups instanceof \DB\Groups) {
            $this
                ->addUsingAlias(SubprojectTableMap::COL_ID, $groups->getSubprojectId(), $comparison);

            return $this;
        } elseif ($groups instanceof ObjectCollection) {
            $this
                ->useGroupsQuery()
                ->filterByPrimaryKeys($groups->getPrimaryKeys())
                ->endUse();

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
     * Filter the query by a related \DB\SubprojectVersion object
     *
     * @param \DB\SubprojectVersion|ObjectCollection $subprojectVersion the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySubprojectVersion($subprojectVersion, ?string $comparison = null)
    {
        if ($subprojectVersion instanceof \DB\SubprojectVersion) {
            $this
                ->addUsingAlias(SubprojectTableMap::COL_ID, $subprojectVersion->getId(), $comparison);

            return $this;
        } elseif ($subprojectVersion instanceof ObjectCollection) {
            $this
                ->useSubprojectVersionQuery()
                ->filterByPrimaryKeys($subprojectVersion->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySubprojectVersion() only accepts arguments of type \DB\SubprojectVersion or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SubprojectVersion relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSubprojectVersion(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SubprojectVersion');

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
            $this->addJoinObject($join, 'SubprojectVersion');
        }

        return $this;
    }

    /**
     * Use the SubprojectVersion relation SubprojectVersion object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\SubprojectVersionQuery A secondary query class using the current class as primary query
     */
    public function useSubprojectVersionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSubprojectVersion($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SubprojectVersion', '\DB\SubprojectVersionQuery');
    }

    /**
     * Use the SubprojectVersion relation SubprojectVersion object
     *
     * @param callable(\DB\SubprojectVersionQuery):\DB\SubprojectVersionQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSubprojectVersionQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSubprojectVersionQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to SubprojectVersion table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\SubprojectVersionQuery The inner query object of the EXISTS statement
     */
    public function useSubprojectVersionExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('SubprojectVersion', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to SubprojectVersion table for a NOT EXISTS query.
     *
     * @see useSubprojectVersionExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\SubprojectVersionQuery The inner query object of the NOT EXISTS statement
     */
    public function useSubprojectVersionNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('SubprojectVersion', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Exclude object from result
     *
     * @param ChildSubproject $subproject Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($subproject = null)
    {
        if ($subproject) {
            $this->addUsingAlias(SubprojectTableMap::COL_ID, $subproject->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the subproject table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SubprojectTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SubprojectTableMap::clearInstancePool();
            SubprojectTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SubprojectTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SubprojectTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SubprojectTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SubprojectTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
