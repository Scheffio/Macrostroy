<?php

namespace DB\Base;

use \Exception;
use \PDO;
use DB\ObjSubproject as ChildObjSubproject;
use DB\ObjSubprojectQuery as ChildObjSubprojectQuery;
use DB\Map\ObjSubprojectTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'obj_subproject' table.
 *
 *
 *
 * @method     ChildObjSubprojectQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildObjSubprojectQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildObjSubprojectQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildObjSubprojectQuery orderByIsPublic($order = Criteria::ASC) Order by the is_public column
 * @method     ChildObjSubprojectQuery orderByIsAvailable($order = Criteria::ASC) Order by the is_available column
 * @method     ChildObjSubprojectQuery orderByProjectId($order = Criteria::ASC) Order by the project_id column
 * @method     ChildObjSubprojectQuery orderByVersionCreatedBy($order = Criteria::ASC) Order by the version_created_by column
 * @method     ChildObjSubprojectQuery orderByVersion($order = Criteria::ASC) Order by the version column
 * @method     ChildObjSubprojectQuery orderByVersionCreatedAt($order = Criteria::ASC) Order by the version_created_at column
 * @method     ChildObjSubprojectQuery orderByVersionComment($order = Criteria::ASC) Order by the version_comment column
 *
 * @method     ChildObjSubprojectQuery groupById() Group by the id column
 * @method     ChildObjSubprojectQuery groupByName() Group by the name column
 * @method     ChildObjSubprojectQuery groupByStatus() Group by the status column
 * @method     ChildObjSubprojectQuery groupByIsPublic() Group by the is_public column
 * @method     ChildObjSubprojectQuery groupByIsAvailable() Group by the is_available column
 * @method     ChildObjSubprojectQuery groupByProjectId() Group by the project_id column
 * @method     ChildObjSubprojectQuery groupByVersionCreatedBy() Group by the version_created_by column
 * @method     ChildObjSubprojectQuery groupByVersion() Group by the version column
 * @method     ChildObjSubprojectQuery groupByVersionCreatedAt() Group by the version_created_at column
 * @method     ChildObjSubprojectQuery groupByVersionComment() Group by the version_comment column
 *
 * @method     ChildObjSubprojectQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildObjSubprojectQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildObjSubprojectQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildObjSubprojectQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildObjSubprojectQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildObjSubprojectQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildObjSubprojectQuery leftJoinUsers($relationAlias = null) Adds a LEFT JOIN clause to the query using the Users relation
 * @method     ChildObjSubprojectQuery rightJoinUsers($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Users relation
 * @method     ChildObjSubprojectQuery innerJoinUsers($relationAlias = null) Adds a INNER JOIN clause to the query using the Users relation
 *
 * @method     ChildObjSubprojectQuery joinWithUsers($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Users relation
 *
 * @method     ChildObjSubprojectQuery leftJoinWithUsers() Adds a LEFT JOIN clause and with to the query using the Users relation
 * @method     ChildObjSubprojectQuery rightJoinWithUsers() Adds a RIGHT JOIN clause and with to the query using the Users relation
 * @method     ChildObjSubprojectQuery innerJoinWithUsers() Adds a INNER JOIN clause and with to the query using the Users relation
 *
 * @method     ChildObjSubprojectQuery leftJoinObjProject($relationAlias = null) Adds a LEFT JOIN clause to the query using the ObjProject relation
 * @method     ChildObjSubprojectQuery rightJoinObjProject($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ObjProject relation
 * @method     ChildObjSubprojectQuery innerJoinObjProject($relationAlias = null) Adds a INNER JOIN clause to the query using the ObjProject relation
 *
 * @method     ChildObjSubprojectQuery joinWithObjProject($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ObjProject relation
 *
 * @method     ChildObjSubprojectQuery leftJoinWithObjProject() Adds a LEFT JOIN clause and with to the query using the ObjProject relation
 * @method     ChildObjSubprojectQuery rightJoinWithObjProject() Adds a RIGHT JOIN clause and with to the query using the ObjProject relation
 * @method     ChildObjSubprojectQuery innerJoinWithObjProject() Adds a INNER JOIN clause and with to the query using the ObjProject relation
 *
 * @method     ChildObjSubprojectQuery leftJoinObjGroup($relationAlias = null) Adds a LEFT JOIN clause to the query using the ObjGroup relation
 * @method     ChildObjSubprojectQuery rightJoinObjGroup($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ObjGroup relation
 * @method     ChildObjSubprojectQuery innerJoinObjGroup($relationAlias = null) Adds a INNER JOIN clause to the query using the ObjGroup relation
 *
 * @method     ChildObjSubprojectQuery joinWithObjGroup($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ObjGroup relation
 *
 * @method     ChildObjSubprojectQuery leftJoinWithObjGroup() Adds a LEFT JOIN clause and with to the query using the ObjGroup relation
 * @method     ChildObjSubprojectQuery rightJoinWithObjGroup() Adds a RIGHT JOIN clause and with to the query using the ObjGroup relation
 * @method     ChildObjSubprojectQuery innerJoinWithObjGroup() Adds a INNER JOIN clause and with to the query using the ObjGroup relation
 *
 * @method     ChildObjSubprojectQuery leftJoinObjSubprojectVersion($relationAlias = null) Adds a LEFT JOIN clause to the query using the ObjSubprojectVersion relation
 * @method     ChildObjSubprojectQuery rightJoinObjSubprojectVersion($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ObjSubprojectVersion relation
 * @method     ChildObjSubprojectQuery innerJoinObjSubprojectVersion($relationAlias = null) Adds a INNER JOIN clause to the query using the ObjSubprojectVersion relation
 *
 * @method     ChildObjSubprojectQuery joinWithObjSubprojectVersion($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ObjSubprojectVersion relation
 *
 * @method     ChildObjSubprojectQuery leftJoinWithObjSubprojectVersion() Adds a LEFT JOIN clause and with to the query using the ObjSubprojectVersion relation
 * @method     ChildObjSubprojectQuery rightJoinWithObjSubprojectVersion() Adds a RIGHT JOIN clause and with to the query using the ObjSubprojectVersion relation
 * @method     ChildObjSubprojectQuery innerJoinWithObjSubprojectVersion() Adds a INNER JOIN clause and with to the query using the ObjSubprojectVersion relation
 *
 * @method     \DB\UsersQuery|\DB\ObjProjectQuery|\DB\ObjGroupQuery|\DB\ObjSubprojectVersionQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildObjSubproject|null findOne(?ConnectionInterface $con = null) Return the first ChildObjSubproject matching the query
 * @method     ChildObjSubproject findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildObjSubproject matching the query, or a new ChildObjSubproject object populated from the query conditions when no match is found
 *
 * @method     ChildObjSubproject|null findOneById(int $id) Return the first ChildObjSubproject filtered by the id column
 * @method     ChildObjSubproject|null findOneByName(string $name) Return the first ChildObjSubproject filtered by the name column
 * @method     ChildObjSubproject|null findOneByStatus(string $status) Return the first ChildObjSubproject filtered by the status column
 * @method     ChildObjSubproject|null findOneByIsPublic(boolean $is_public) Return the first ChildObjSubproject filtered by the is_public column
 * @method     ChildObjSubproject|null findOneByIsAvailable(boolean $is_available) Return the first ChildObjSubproject filtered by the is_available column
 * @method     ChildObjSubproject|null findOneByProjectId(int $project_id) Return the first ChildObjSubproject filtered by the project_id column
 * @method     ChildObjSubproject|null findOneByVersionCreatedBy(int $version_created_by) Return the first ChildObjSubproject filtered by the version_created_by column
 * @method     ChildObjSubproject|null findOneByVersion(int $version) Return the first ChildObjSubproject filtered by the version column
 * @method     ChildObjSubproject|null findOneByVersionCreatedAt(string $version_created_at) Return the first ChildObjSubproject filtered by the version_created_at column
 * @method     ChildObjSubproject|null findOneByVersionComment(string $version_comment) Return the first ChildObjSubproject filtered by the version_comment column *

 * @method     ChildObjSubproject requirePk($key, ?ConnectionInterface $con = null) Return the ChildObjSubproject by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjSubproject requireOne(?ConnectionInterface $con = null) Return the first ChildObjSubproject matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildObjSubproject requireOneById(int $id) Return the first ChildObjSubproject filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjSubproject requireOneByName(string $name) Return the first ChildObjSubproject filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjSubproject requireOneByStatus(string $status) Return the first ChildObjSubproject filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjSubproject requireOneByIsPublic(boolean $is_public) Return the first ChildObjSubproject filtered by the is_public column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjSubproject requireOneByIsAvailable(boolean $is_available) Return the first ChildObjSubproject filtered by the is_available column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjSubproject requireOneByProjectId(int $project_id) Return the first ChildObjSubproject filtered by the project_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjSubproject requireOneByVersionCreatedBy(int $version_created_by) Return the first ChildObjSubproject filtered by the version_created_by column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjSubproject requireOneByVersion(int $version) Return the first ChildObjSubproject filtered by the version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjSubproject requireOneByVersionCreatedAt(string $version_created_at) Return the first ChildObjSubproject filtered by the version_created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjSubproject requireOneByVersionComment(string $version_comment) Return the first ChildObjSubproject filtered by the version_comment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildObjSubproject[]|Collection find(?ConnectionInterface $con = null) Return ChildObjSubproject objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildObjSubproject> find(?ConnectionInterface $con = null) Return ChildObjSubproject objects based on current ModelCriteria
 * @method     ChildObjSubproject[]|Collection findById(int $id) Return ChildObjSubproject objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildObjSubproject> findById(int $id) Return ChildObjSubproject objects filtered by the id column
 * @method     ChildObjSubproject[]|Collection findByName(string $name) Return ChildObjSubproject objects filtered by the name column
 * @psalm-method Collection&\Traversable<ChildObjSubproject> findByName(string $name) Return ChildObjSubproject objects filtered by the name column
 * @method     ChildObjSubproject[]|Collection findByStatus(string $status) Return ChildObjSubproject objects filtered by the status column
 * @psalm-method Collection&\Traversable<ChildObjSubproject> findByStatus(string $status) Return ChildObjSubproject objects filtered by the status column
 * @method     ChildObjSubproject[]|Collection findByIsPublic(boolean $is_public) Return ChildObjSubproject objects filtered by the is_public column
 * @psalm-method Collection&\Traversable<ChildObjSubproject> findByIsPublic(boolean $is_public) Return ChildObjSubproject objects filtered by the is_public column
 * @method     ChildObjSubproject[]|Collection findByIsAvailable(boolean $is_available) Return ChildObjSubproject objects filtered by the is_available column
 * @psalm-method Collection&\Traversable<ChildObjSubproject> findByIsAvailable(boolean $is_available) Return ChildObjSubproject objects filtered by the is_available column
 * @method     ChildObjSubproject[]|Collection findByProjectId(int $project_id) Return ChildObjSubproject objects filtered by the project_id column
 * @psalm-method Collection&\Traversable<ChildObjSubproject> findByProjectId(int $project_id) Return ChildObjSubproject objects filtered by the project_id column
 * @method     ChildObjSubproject[]|Collection findByVersionCreatedBy(int $version_created_by) Return ChildObjSubproject objects filtered by the version_created_by column
 * @psalm-method Collection&\Traversable<ChildObjSubproject> findByVersionCreatedBy(int $version_created_by) Return ChildObjSubproject objects filtered by the version_created_by column
 * @method     ChildObjSubproject[]|Collection findByVersion(int $version) Return ChildObjSubproject objects filtered by the version column
 * @psalm-method Collection&\Traversable<ChildObjSubproject> findByVersion(int $version) Return ChildObjSubproject objects filtered by the version column
 * @method     ChildObjSubproject[]|Collection findByVersionCreatedAt(string $version_created_at) Return ChildObjSubproject objects filtered by the version_created_at column
 * @psalm-method Collection&\Traversable<ChildObjSubproject> findByVersionCreatedAt(string $version_created_at) Return ChildObjSubproject objects filtered by the version_created_at column
 * @method     ChildObjSubproject[]|Collection findByVersionComment(string $version_comment) Return ChildObjSubproject objects filtered by the version_comment column
 * @psalm-method Collection&\Traversable<ChildObjSubproject> findByVersionComment(string $version_comment) Return ChildObjSubproject objects filtered by the version_comment column
 * @method     ChildObjSubproject[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildObjSubproject> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ObjSubprojectQuery extends ModelCriteria
{

    // versionable behavior

    /**
     * Whether the versioning is enabled
     */
    static $isVersioningEnabled = true;
protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \DB\Base\ObjSubprojectQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\DB\\ObjSubproject', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildObjSubprojectQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildObjSubprojectQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildObjSubprojectQuery) {
            return $criteria;
        }
        $query = new ChildObjSubprojectQuery();
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
     * @return ChildObjSubproject|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ObjSubprojectTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ObjSubprojectTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildObjSubproject A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, status, is_public, is_available, project_id, version_created_by, version, version_created_at, version_comment FROM obj_subproject WHERE id = :p0';
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
            /** @var ChildObjSubproject $obj */
            $obj = new ChildObjSubproject();
            $obj->hydrate($row);
            ObjSubprojectTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildObjSubproject|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(ObjSubprojectTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(ObjSubprojectTableMap::COL_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(ObjSubprojectTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ObjSubprojectTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ObjSubprojectTableMap::COL_ID, $id, $comparison);

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

        $this->addUsingAlias(ObjSubprojectTableMap::COL_NAME, $name, $comparison);

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

        $this->addUsingAlias(ObjSubprojectTableMap::COL_STATUS, $status, $comparison);

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

        $this->addUsingAlias(ObjSubprojectTableMap::COL_IS_PUBLIC, $isPublic, $comparison);

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

        $this->addUsingAlias(ObjSubprojectTableMap::COL_IS_AVAILABLE, $isAvailable, $comparison);

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
     * @see       filterByObjProject()
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
                $this->addUsingAlias(ObjSubprojectTableMap::COL_PROJECT_ID, $projectId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($projectId['max'])) {
                $this->addUsingAlias(ObjSubprojectTableMap::COL_PROJECT_ID, $projectId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ObjSubprojectTableMap::COL_PROJECT_ID, $projectId, $comparison);

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
                $this->addUsingAlias(ObjSubprojectTableMap::COL_VERSION_CREATED_BY, $versionCreatedBy['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($versionCreatedBy['max'])) {
                $this->addUsingAlias(ObjSubprojectTableMap::COL_VERSION_CREATED_BY, $versionCreatedBy['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ObjSubprojectTableMap::COL_VERSION_CREATED_BY, $versionCreatedBy, $comparison);

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
                $this->addUsingAlias(ObjSubprojectTableMap::COL_VERSION, $version['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($version['max'])) {
                $this->addUsingAlias(ObjSubprojectTableMap::COL_VERSION, $version['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ObjSubprojectTableMap::COL_VERSION, $version, $comparison);

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
                $this->addUsingAlias(ObjSubprojectTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($versionCreatedAt['max'])) {
                $this->addUsingAlias(ObjSubprojectTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ObjSubprojectTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt, $comparison);

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

        $this->addUsingAlias(ObjSubprojectTableMap::COL_VERSION_COMMENT, $versionComment, $comparison);

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
                ->addUsingAlias(ObjSubprojectTableMap::COL_VERSION_CREATED_BY, $users->getId(), $comparison);
        } elseif ($users instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(ObjSubprojectTableMap::COL_VERSION_CREATED_BY, $users->toKeyValue('PrimaryKey', 'Id'), $comparison);

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
     * Filter the query by a related \DB\ObjProject object
     *
     * @param \DB\ObjProject|ObjectCollection $objProject The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByObjProject($objProject, ?string $comparison = null)
    {
        if ($objProject instanceof \DB\ObjProject) {
            return $this
                ->addUsingAlias(ObjSubprojectTableMap::COL_PROJECT_ID, $objProject->getId(), $comparison);
        } elseif ($objProject instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(ObjSubprojectTableMap::COL_PROJECT_ID, $objProject->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByObjProject() only accepts arguments of type \DB\ObjProject or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ObjProject relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinObjProject(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ObjProject');

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
            $this->addJoinObject($join, 'ObjProject');
        }

        return $this;
    }

    /**
     * Use the ObjProject relation ObjProject object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\ObjProjectQuery A secondary query class using the current class as primary query
     */
    public function useObjProjectQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinObjProject($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ObjProject', '\DB\ObjProjectQuery');
    }

    /**
     * Use the ObjProject relation ObjProject object
     *
     * @param callable(\DB\ObjProjectQuery):\DB\ObjProjectQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withObjProjectQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useObjProjectQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to ObjProject table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\ObjProjectQuery The inner query object of the EXISTS statement
     */
    public function useObjProjectExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('ObjProject', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to ObjProject table for a NOT EXISTS query.
     *
     * @see useObjProjectExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\ObjProjectQuery The inner query object of the NOT EXISTS statement
     */
    public function useObjProjectNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('ObjProject', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \DB\ObjGroup object
     *
     * @param \DB\ObjGroup|ObjectCollection $objGroup the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByObjGroup($objGroup, ?string $comparison = null)
    {
        if ($objGroup instanceof \DB\ObjGroup) {
            $this
                ->addUsingAlias(ObjSubprojectTableMap::COL_ID, $objGroup->getSubprojectId(), $comparison);

            return $this;
        } elseif ($objGroup instanceof ObjectCollection) {
            $this
                ->useObjGroupQuery()
                ->filterByPrimaryKeys($objGroup->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByObjGroup() only accepts arguments of type \DB\ObjGroup or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ObjGroup relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinObjGroup(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ObjGroup');

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
            $this->addJoinObject($join, 'ObjGroup');
        }

        return $this;
    }

    /**
     * Use the ObjGroup relation ObjGroup object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\ObjGroupQuery A secondary query class using the current class as primary query
     */
    public function useObjGroupQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinObjGroup($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ObjGroup', '\DB\ObjGroupQuery');
    }

    /**
     * Use the ObjGroup relation ObjGroup object
     *
     * @param callable(\DB\ObjGroupQuery):\DB\ObjGroupQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withObjGroupQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useObjGroupQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to ObjGroup table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\ObjGroupQuery The inner query object of the EXISTS statement
     */
    public function useObjGroupExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('ObjGroup', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to ObjGroup table for a NOT EXISTS query.
     *
     * @see useObjGroupExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\ObjGroupQuery The inner query object of the NOT EXISTS statement
     */
    public function useObjGroupNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('ObjGroup', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \DB\ObjSubprojectVersion object
     *
     * @param \DB\ObjSubprojectVersion|ObjectCollection $objSubprojectVersion the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByObjSubprojectVersion($objSubprojectVersion, ?string $comparison = null)
    {
        if ($objSubprojectVersion instanceof \DB\ObjSubprojectVersion) {
            $this
                ->addUsingAlias(ObjSubprojectTableMap::COL_ID, $objSubprojectVersion->getId(), $comparison);

            return $this;
        } elseif ($objSubprojectVersion instanceof ObjectCollection) {
            $this
                ->useObjSubprojectVersionQuery()
                ->filterByPrimaryKeys($objSubprojectVersion->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByObjSubprojectVersion() only accepts arguments of type \DB\ObjSubprojectVersion or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ObjSubprojectVersion relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinObjSubprojectVersion(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ObjSubprojectVersion');

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
            $this->addJoinObject($join, 'ObjSubprojectVersion');
        }

        return $this;
    }

    /**
     * Use the ObjSubprojectVersion relation ObjSubprojectVersion object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\ObjSubprojectVersionQuery A secondary query class using the current class as primary query
     */
    public function useObjSubprojectVersionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinObjSubprojectVersion($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ObjSubprojectVersion', '\DB\ObjSubprojectVersionQuery');
    }

    /**
     * Use the ObjSubprojectVersion relation ObjSubprojectVersion object
     *
     * @param callable(\DB\ObjSubprojectVersionQuery):\DB\ObjSubprojectVersionQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withObjSubprojectVersionQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useObjSubprojectVersionQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to ObjSubprojectVersion table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\ObjSubprojectVersionQuery The inner query object of the EXISTS statement
     */
    public function useObjSubprojectVersionExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('ObjSubprojectVersion', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to ObjSubprojectVersion table for a NOT EXISTS query.
     *
     * @see useObjSubprojectVersionExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\ObjSubprojectVersionQuery The inner query object of the NOT EXISTS statement
     */
    public function useObjSubprojectVersionNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('ObjSubprojectVersion', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Exclude object from result
     *
     * @param ChildObjSubproject $objSubproject Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($objSubproject = null)
    {
        if ($objSubproject) {
            $this->addUsingAlias(ObjSubprojectTableMap::COL_ID, $objSubproject->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the obj_subproject table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ObjSubprojectTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ObjSubprojectTableMap::clearInstancePool();
            ObjSubprojectTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ObjSubprojectTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ObjSubprojectTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ObjSubprojectTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ObjSubprojectTableMap::clearRelatedInstancePool();

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
