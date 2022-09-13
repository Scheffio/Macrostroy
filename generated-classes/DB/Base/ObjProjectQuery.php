<?php

namespace DB\Base;

use \Exception;
use \PDO;
use DB\ObjProject as ChildObjProject;
use DB\ObjProjectQuery as ChildObjProjectQuery;
use DB\Map\ObjProjectTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'obj_project' table.
 *
 *
 *
 * @method     ChildObjProjectQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildObjProjectQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildObjProjectQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildObjProjectQuery orderByIsPublic($order = Criteria::ASC) Order by the is_public column
 * @method     ChildObjProjectQuery orderByIsAvailable($order = Criteria::ASC) Order by the is_available column
 * @method     ChildObjProjectQuery orderByVersionCreatedBy($order = Criteria::ASC) Order by the version_created_by column
 * @method     ChildObjProjectQuery orderByVersion($order = Criteria::ASC) Order by the version column
 * @method     ChildObjProjectQuery orderByVersionCreatedAt($order = Criteria::ASC) Order by the version_created_at column
 * @method     ChildObjProjectQuery orderByVersionComment($order = Criteria::ASC) Order by the version_comment column
 *
 * @method     ChildObjProjectQuery groupById() Group by the id column
 * @method     ChildObjProjectQuery groupByName() Group by the name column
 * @method     ChildObjProjectQuery groupByStatus() Group by the status column
 * @method     ChildObjProjectQuery groupByIsPublic() Group by the is_public column
 * @method     ChildObjProjectQuery groupByIsAvailable() Group by the is_available column
 * @method     ChildObjProjectQuery groupByVersionCreatedBy() Group by the version_created_by column
 * @method     ChildObjProjectQuery groupByVersion() Group by the version column
 * @method     ChildObjProjectQuery groupByVersionCreatedAt() Group by the version_created_at column
 * @method     ChildObjProjectQuery groupByVersionComment() Group by the version_comment column
 *
 * @method     ChildObjProjectQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildObjProjectQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildObjProjectQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildObjProjectQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildObjProjectQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildObjProjectQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildObjProjectQuery leftJoinUsers($relationAlias = null) Adds a LEFT JOIN clause to the query using the Users relation
 * @method     ChildObjProjectQuery rightJoinUsers($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Users relation
 * @method     ChildObjProjectQuery innerJoinUsers($relationAlias = null) Adds a INNER JOIN clause to the query using the Users relation
 *
 * @method     ChildObjProjectQuery joinWithUsers($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Users relation
 *
 * @method     ChildObjProjectQuery leftJoinWithUsers() Adds a LEFT JOIN clause and with to the query using the Users relation
 * @method     ChildObjProjectQuery rightJoinWithUsers() Adds a RIGHT JOIN clause and with to the query using the Users relation
 * @method     ChildObjProjectQuery innerJoinWithUsers() Adds a INNER JOIN clause and with to the query using the Users relation
 *
 * @method     ChildObjProjectQuery leftJoinProjectRole($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProjectRole relation
 * @method     ChildObjProjectQuery rightJoinProjectRole($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProjectRole relation
 * @method     ChildObjProjectQuery innerJoinProjectRole($relationAlias = null) Adds a INNER JOIN clause to the query using the ProjectRole relation
 *
 * @method     ChildObjProjectQuery joinWithProjectRole($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProjectRole relation
 *
 * @method     ChildObjProjectQuery leftJoinWithProjectRole() Adds a LEFT JOIN clause and with to the query using the ProjectRole relation
 * @method     ChildObjProjectQuery rightJoinWithProjectRole() Adds a RIGHT JOIN clause and with to the query using the ProjectRole relation
 * @method     ChildObjProjectQuery innerJoinWithProjectRole() Adds a INNER JOIN clause and with to the query using the ProjectRole relation
 *
 * @method     ChildObjProjectQuery leftJoinObjSubproject($relationAlias = null) Adds a LEFT JOIN clause to the query using the ObjSubproject relation
 * @method     ChildObjProjectQuery rightJoinObjSubproject($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ObjSubproject relation
 * @method     ChildObjProjectQuery innerJoinObjSubproject($relationAlias = null) Adds a INNER JOIN clause to the query using the ObjSubproject relation
 *
 * @method     ChildObjProjectQuery joinWithObjSubproject($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ObjSubproject relation
 *
 * @method     ChildObjProjectQuery leftJoinWithObjSubproject() Adds a LEFT JOIN clause and with to the query using the ObjSubproject relation
 * @method     ChildObjProjectQuery rightJoinWithObjSubproject() Adds a RIGHT JOIN clause and with to the query using the ObjSubproject relation
 * @method     ChildObjProjectQuery innerJoinWithObjSubproject() Adds a INNER JOIN clause and with to the query using the ObjSubproject relation
 *
 * @method     ChildObjProjectQuery leftJoinObjProjectVersion($relationAlias = null) Adds a LEFT JOIN clause to the query using the ObjProjectVersion relation
 * @method     ChildObjProjectQuery rightJoinObjProjectVersion($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ObjProjectVersion relation
 * @method     ChildObjProjectQuery innerJoinObjProjectVersion($relationAlias = null) Adds a INNER JOIN clause to the query using the ObjProjectVersion relation
 *
 * @method     ChildObjProjectQuery joinWithObjProjectVersion($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ObjProjectVersion relation
 *
 * @method     ChildObjProjectQuery leftJoinWithObjProjectVersion() Adds a LEFT JOIN clause and with to the query using the ObjProjectVersion relation
 * @method     ChildObjProjectQuery rightJoinWithObjProjectVersion() Adds a RIGHT JOIN clause and with to the query using the ObjProjectVersion relation
 * @method     ChildObjProjectQuery innerJoinWithObjProjectVersion() Adds a INNER JOIN clause and with to the query using the ObjProjectVersion relation
 *
 * @method     \DB\UsersQuery|\DB\ProjectRoleQuery|\DB\ObjSubprojectQuery|\DB\ObjProjectVersionQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildObjProject|null findOne(?ConnectionInterface $con = null) Return the first ChildObjProject matching the query
 * @method     ChildObjProject findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildObjProject matching the query, or a new ChildObjProject object populated from the query conditions when no match is found
 *
 * @method     ChildObjProject|null findOneById(int $id) Return the first ChildObjProject filtered by the id column
 * @method     ChildObjProject|null findOneByName(string $name) Return the first ChildObjProject filtered by the name column
 * @method     ChildObjProject|null findOneByStatus(string $status) Return the first ChildObjProject filtered by the status column
 * @method     ChildObjProject|null findOneByIsPublic(boolean $is_public) Return the first ChildObjProject filtered by the is_public column
 * @method     ChildObjProject|null findOneByIsAvailable(boolean $is_available) Return the first ChildObjProject filtered by the is_available column
 * @method     ChildObjProject|null findOneByVersionCreatedBy(int $version_created_by) Return the first ChildObjProject filtered by the version_created_by column
 * @method     ChildObjProject|null findOneByVersion(int $version) Return the first ChildObjProject filtered by the version column
 * @method     ChildObjProject|null findOneByVersionCreatedAt(string $version_created_at) Return the first ChildObjProject filtered by the version_created_at column
 * @method     ChildObjProject|null findOneByVersionComment(string $version_comment) Return the first ChildObjProject filtered by the version_comment column *

 * @method     ChildObjProject requirePk($key, ?ConnectionInterface $con = null) Return the ChildObjProject by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjProject requireOne(?ConnectionInterface $con = null) Return the first ChildObjProject matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildObjProject requireOneById(int $id) Return the first ChildObjProject filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjProject requireOneByName(string $name) Return the first ChildObjProject filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjProject requireOneByStatus(string $status) Return the first ChildObjProject filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjProject requireOneByIsPublic(boolean $is_public) Return the first ChildObjProject filtered by the is_public column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjProject requireOneByIsAvailable(boolean $is_available) Return the first ChildObjProject filtered by the is_available column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjProject requireOneByVersionCreatedBy(int $version_created_by) Return the first ChildObjProject filtered by the version_created_by column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjProject requireOneByVersion(int $version) Return the first ChildObjProject filtered by the version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjProject requireOneByVersionCreatedAt(string $version_created_at) Return the first ChildObjProject filtered by the version_created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjProject requireOneByVersionComment(string $version_comment) Return the first ChildObjProject filtered by the version_comment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildObjProject[]|Collection find(?ConnectionInterface $con = null) Return ChildObjProject objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildObjProject> find(?ConnectionInterface $con = null) Return ChildObjProject objects based on current ModelCriteria
 * @method     ChildObjProject[]|Collection findById(int $id) Return ChildObjProject objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildObjProject> findById(int $id) Return ChildObjProject objects filtered by the id column
 * @method     ChildObjProject[]|Collection findByName(string $name) Return ChildObjProject objects filtered by the name column
 * @psalm-method Collection&\Traversable<ChildObjProject> findByName(string $name) Return ChildObjProject objects filtered by the name column
 * @method     ChildObjProject[]|Collection findByStatus(string $status) Return ChildObjProject objects filtered by the status column
 * @psalm-method Collection&\Traversable<ChildObjProject> findByStatus(string $status) Return ChildObjProject objects filtered by the status column
 * @method     ChildObjProject[]|Collection findByIsPublic(boolean $is_public) Return ChildObjProject objects filtered by the is_public column
 * @psalm-method Collection&\Traversable<ChildObjProject> findByIsPublic(boolean $is_public) Return ChildObjProject objects filtered by the is_public column
 * @method     ChildObjProject[]|Collection findByIsAvailable(boolean $is_available) Return ChildObjProject objects filtered by the is_available column
 * @psalm-method Collection&\Traversable<ChildObjProject> findByIsAvailable(boolean $is_available) Return ChildObjProject objects filtered by the is_available column
 * @method     ChildObjProject[]|Collection findByVersionCreatedBy(int $version_created_by) Return ChildObjProject objects filtered by the version_created_by column
 * @psalm-method Collection&\Traversable<ChildObjProject> findByVersionCreatedBy(int $version_created_by) Return ChildObjProject objects filtered by the version_created_by column
 * @method     ChildObjProject[]|Collection findByVersion(int $version) Return ChildObjProject objects filtered by the version column
 * @psalm-method Collection&\Traversable<ChildObjProject> findByVersion(int $version) Return ChildObjProject objects filtered by the version column
 * @method     ChildObjProject[]|Collection findByVersionCreatedAt(string $version_created_at) Return ChildObjProject objects filtered by the version_created_at column
 * @psalm-method Collection&\Traversable<ChildObjProject> findByVersionCreatedAt(string $version_created_at) Return ChildObjProject objects filtered by the version_created_at column
 * @method     ChildObjProject[]|Collection findByVersionComment(string $version_comment) Return ChildObjProject objects filtered by the version_comment column
 * @psalm-method Collection&\Traversable<ChildObjProject> findByVersionComment(string $version_comment) Return ChildObjProject objects filtered by the version_comment column
 * @method     ChildObjProject[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildObjProject> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ObjProjectQuery extends ModelCriteria
{

    // versionable behavior

    /**
     * Whether the versioning is enabled
     */
    static $isVersioningEnabled = true;
protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \DB\Base\ObjProjectQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\DB\\ObjProject', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildObjProjectQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildObjProjectQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildObjProjectQuery) {
            return $criteria;
        }
        $query = new ChildObjProjectQuery();
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
     * @return ChildObjProject|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ObjProjectTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ObjProjectTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildObjProject A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, status, is_public, is_available, version_created_by, version, version_created_at, version_comment FROM obj_project WHERE id = :p0';
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
            /** @var ChildObjProject $obj */
            $obj = new ChildObjProject();
            $obj->hydrate($row);
            ObjProjectTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildObjProject|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(ObjProjectTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(ObjProjectTableMap::COL_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(ObjProjectTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ObjProjectTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ObjProjectTableMap::COL_ID, $id, $comparison);

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

        $this->addUsingAlias(ObjProjectTableMap::COL_NAME, $name, $comparison);

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

        $this->addUsingAlias(ObjProjectTableMap::COL_STATUS, $status, $comparison);

        return $this;
    }

    /**
     * Filter the query on the is_public column
     *
     * Example usage:
     * <code>
     * $query->filterByIsPublic(true); // WHERE is_public = true
     * $query->filterByIsPublic('yes'); // WHERE is_public = true
     * </code>
     *
     * @param bool|string $isPublic The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIsPublic($isPublic = null, ?string $comparison = null)
    {
        if (is_string($isPublic)) {
            $isPublic = in_array(strtolower($isPublic), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        $this->addUsingAlias(ObjProjectTableMap::COL_IS_PUBLIC, $isPublic, $comparison);

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

        $this->addUsingAlias(ObjProjectTableMap::COL_IS_AVAILABLE, $isAvailable, $comparison);

        return $this;
    }

    /**
     * Filter the query on the version_created_by column
     *
     * Example usage:
     * <code>
     * $query->filterByVersionCreatedBy(1234); // WHERE version_created_by = 1234
     * $query->filterByVersionCreatedBy(array(12, 34)); // WHERE version_created_by IN (12, 34)
     * $query->filterByVersionCreatedBy(array('min' => 12)); // WHERE version_created_by > 12
     * </code>
     *
     * @see       filterByUsers()
     *
     * @param mixed $versionCreatedBy The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByVersionCreatedBy($versionCreatedBy = null, ?string $comparison = null)
    {
        if (is_array($versionCreatedBy)) {
            $useMinMax = false;
            if (isset($versionCreatedBy['min'])) {
                $this->addUsingAlias(ObjProjectTableMap::COL_VERSION_CREATED_BY, $versionCreatedBy['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($versionCreatedBy['max'])) {
                $this->addUsingAlias(ObjProjectTableMap::COL_VERSION_CREATED_BY, $versionCreatedBy['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ObjProjectTableMap::COL_VERSION_CREATED_BY, $versionCreatedBy, $comparison);

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
                $this->addUsingAlias(ObjProjectTableMap::COL_VERSION, $version['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($version['max'])) {
                $this->addUsingAlias(ObjProjectTableMap::COL_VERSION, $version['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ObjProjectTableMap::COL_VERSION, $version, $comparison);

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
                $this->addUsingAlias(ObjProjectTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($versionCreatedAt['max'])) {
                $this->addUsingAlias(ObjProjectTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ObjProjectTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt, $comparison);

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

        $this->addUsingAlias(ObjProjectTableMap::COL_VERSION_COMMENT, $versionComment, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \DB\Users object
     *
     * @param \DB\Users|ObjectCollection $users The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUsers($users, ?string $comparison = null)
    {
        if ($users instanceof \DB\Users) {
            return $this
                ->addUsingAlias(ObjProjectTableMap::COL_VERSION_CREATED_BY, $users->getId(), $comparison);
        } elseif ($users instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(ObjProjectTableMap::COL_VERSION_CREATED_BY, $users->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByUsers() only accepts arguments of type \DB\Users or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Users relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinUsers(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Users');

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
            $this->addJoinObject($join, 'Users');
        }

        return $this;
    }

    /**
     * Use the Users relation Users object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\UsersQuery A secondary query class using the current class as primary query
     */
    public function useUsersQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUsers($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Users', '\DB\UsersQuery');
    }

    /**
     * Use the Users relation Users object
     *
     * @param callable(\DB\UsersQuery):\DB\UsersQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withUsersQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useUsersQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to Users table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\UsersQuery The inner query object of the EXISTS statement
     */
    public function useUsersExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('Users', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to Users table for a NOT EXISTS query.
     *
     * @see useUsersExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\UsersQuery The inner query object of the NOT EXISTS statement
     */
    public function useUsersNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('Users', $modelAlias, $queryClass, 'NOT EXISTS');
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
                ->addUsingAlias(ObjProjectTableMap::COL_ID, $projectRole->getProjectId(), $comparison);

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
     * Filter the query by a related \DB\ObjSubproject object
     *
     * @param \DB\ObjSubproject|ObjectCollection $objSubproject the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByObjSubproject($objSubproject, ?string $comparison = null)
    {
        if ($objSubproject instanceof \DB\ObjSubproject) {
            $this
                ->addUsingAlias(ObjProjectTableMap::COL_ID, $objSubproject->getProjectId(), $comparison);

            return $this;
        } elseif ($objSubproject instanceof ObjectCollection) {
            $this
                ->useObjSubprojectQuery()
                ->filterByPrimaryKeys($objSubproject->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByObjSubproject() only accepts arguments of type \DB\ObjSubproject or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ObjSubproject relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinObjSubproject(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ObjSubproject');

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
            $this->addJoinObject($join, 'ObjSubproject');
        }

        return $this;
    }

    /**
     * Use the ObjSubproject relation ObjSubproject object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\ObjSubprojectQuery A secondary query class using the current class as primary query
     */
    public function useObjSubprojectQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinObjSubproject($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ObjSubproject', '\DB\ObjSubprojectQuery');
    }

    /**
     * Use the ObjSubproject relation ObjSubproject object
     *
     * @param callable(\DB\ObjSubprojectQuery):\DB\ObjSubprojectQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withObjSubprojectQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useObjSubprojectQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to ObjSubproject table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\ObjSubprojectQuery The inner query object of the EXISTS statement
     */
    public function useObjSubprojectExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('ObjSubproject', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to ObjSubproject table for a NOT EXISTS query.
     *
     * @see useObjSubprojectExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\ObjSubprojectQuery The inner query object of the NOT EXISTS statement
     */
    public function useObjSubprojectNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('ObjSubproject', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \DB\ObjProjectVersion object
     *
     * @param \DB\ObjProjectVersion|ObjectCollection $objProjectVersion the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByObjProjectVersion($objProjectVersion, ?string $comparison = null)
    {
        if ($objProjectVersion instanceof \DB\ObjProjectVersion) {
            $this
                ->addUsingAlias(ObjProjectTableMap::COL_ID, $objProjectVersion->getId(), $comparison);

            return $this;
        } elseif ($objProjectVersion instanceof ObjectCollection) {
            $this
                ->useObjProjectVersionQuery()
                ->filterByPrimaryKeys($objProjectVersion->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByObjProjectVersion() only accepts arguments of type \DB\ObjProjectVersion or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ObjProjectVersion relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinObjProjectVersion(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ObjProjectVersion');

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
            $this->addJoinObject($join, 'ObjProjectVersion');
        }

        return $this;
    }

    /**
     * Use the ObjProjectVersion relation ObjProjectVersion object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\ObjProjectVersionQuery A secondary query class using the current class as primary query
     */
    public function useObjProjectVersionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinObjProjectVersion($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ObjProjectVersion', '\DB\ObjProjectVersionQuery');
    }

    /**
     * Use the ObjProjectVersion relation ObjProjectVersion object
     *
     * @param callable(\DB\ObjProjectVersionQuery):\DB\ObjProjectVersionQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withObjProjectVersionQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useObjProjectVersionQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to ObjProjectVersion table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\ObjProjectVersionQuery The inner query object of the EXISTS statement
     */
    public function useObjProjectVersionExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('ObjProjectVersion', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to ObjProjectVersion table for a NOT EXISTS query.
     *
     * @see useObjProjectVersionExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\ObjProjectVersionQuery The inner query object of the NOT EXISTS statement
     */
    public function useObjProjectVersionNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('ObjProjectVersion', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Exclude object from result
     *
     * @param ChildObjProject $objProject Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($objProject = null)
    {
        if ($objProject) {
            $this->addUsingAlias(ObjProjectTableMap::COL_ID, $objProject->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the obj_project table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ObjProjectTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ObjProjectTableMap::clearInstancePool();
            ObjProjectTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ObjProjectTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ObjProjectTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ObjProjectTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ObjProjectTableMap::clearRelatedInstancePool();

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
