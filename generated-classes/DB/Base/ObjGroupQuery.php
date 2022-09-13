<?php

namespace DB\Base;

use \Exception;
use \PDO;
use DB\ObjGroup as ChildObjGroup;
use DB\ObjGroupQuery as ChildObjGroupQuery;
use DB\Map\ObjGroupTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'obj_group' table.
 *
 *
 *
 * @method     ChildObjGroupQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildObjGroupQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildObjGroupQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildObjGroupQuery orderByIsPublic($order = Criteria::ASC) Order by the is_public column
 * @method     ChildObjGroupQuery orderByIsAvailable($order = Criteria::ASC) Order by the is_available column
 * @method     ChildObjGroupQuery orderBySubprojectId($order = Criteria::ASC) Order by the subproject_id column
 * @method     ChildObjGroupQuery orderByVersionCreatedBy($order = Criteria::ASC) Order by the version_created_by column
 * @method     ChildObjGroupQuery orderByVersion($order = Criteria::ASC) Order by the version column
 * @method     ChildObjGroupQuery orderByVersionCreatedAt($order = Criteria::ASC) Order by the version_created_at column
 * @method     ChildObjGroupQuery orderByVersionComment($order = Criteria::ASC) Order by the version_comment column
 *
 * @method     ChildObjGroupQuery groupById() Group by the id column
 * @method     ChildObjGroupQuery groupByName() Group by the name column
 * @method     ChildObjGroupQuery groupByStatus() Group by the status column
 * @method     ChildObjGroupQuery groupByIsPublic() Group by the is_public column
 * @method     ChildObjGroupQuery groupByIsAvailable() Group by the is_available column
 * @method     ChildObjGroupQuery groupBySubprojectId() Group by the subproject_id column
 * @method     ChildObjGroupQuery groupByVersionCreatedBy() Group by the version_created_by column
 * @method     ChildObjGroupQuery groupByVersion() Group by the version column
 * @method     ChildObjGroupQuery groupByVersionCreatedAt() Group by the version_created_at column
 * @method     ChildObjGroupQuery groupByVersionComment() Group by the version_comment column
 *
 * @method     ChildObjGroupQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildObjGroupQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildObjGroupQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildObjGroupQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildObjGroupQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildObjGroupQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildObjGroupQuery leftJoinUsers($relationAlias = null) Adds a LEFT JOIN clause to the query using the Users relation
 * @method     ChildObjGroupQuery rightJoinUsers($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Users relation
 * @method     ChildObjGroupQuery innerJoinUsers($relationAlias = null) Adds a INNER JOIN clause to the query using the Users relation
 *
 * @method     ChildObjGroupQuery joinWithUsers($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Users relation
 *
 * @method     ChildObjGroupQuery leftJoinWithUsers() Adds a LEFT JOIN clause and with to the query using the Users relation
 * @method     ChildObjGroupQuery rightJoinWithUsers() Adds a RIGHT JOIN clause and with to the query using the Users relation
 * @method     ChildObjGroupQuery innerJoinWithUsers() Adds a INNER JOIN clause and with to the query using the Users relation
 *
 * @method     ChildObjGroupQuery leftJoinObjSubproject($relationAlias = null) Adds a LEFT JOIN clause to the query using the ObjSubproject relation
 * @method     ChildObjGroupQuery rightJoinObjSubproject($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ObjSubproject relation
 * @method     ChildObjGroupQuery innerJoinObjSubproject($relationAlias = null) Adds a INNER JOIN clause to the query using the ObjSubproject relation
 *
 * @method     ChildObjGroupQuery joinWithObjSubproject($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ObjSubproject relation
 *
 * @method     ChildObjGroupQuery leftJoinWithObjSubproject() Adds a LEFT JOIN clause and with to the query using the ObjSubproject relation
 * @method     ChildObjGroupQuery rightJoinWithObjSubproject() Adds a RIGHT JOIN clause and with to the query using the ObjSubproject relation
 * @method     ChildObjGroupQuery innerJoinWithObjSubproject() Adds a INNER JOIN clause and with to the query using the ObjSubproject relation
 *
 * @method     ChildObjGroupQuery leftJoinObjHouse($relationAlias = null) Adds a LEFT JOIN clause to the query using the ObjHouse relation
 * @method     ChildObjGroupQuery rightJoinObjHouse($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ObjHouse relation
 * @method     ChildObjGroupQuery innerJoinObjHouse($relationAlias = null) Adds a INNER JOIN clause to the query using the ObjHouse relation
 *
 * @method     ChildObjGroupQuery joinWithObjHouse($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ObjHouse relation
 *
 * @method     ChildObjGroupQuery leftJoinWithObjHouse() Adds a LEFT JOIN clause and with to the query using the ObjHouse relation
 * @method     ChildObjGroupQuery rightJoinWithObjHouse() Adds a RIGHT JOIN clause and with to the query using the ObjHouse relation
 * @method     ChildObjGroupQuery innerJoinWithObjHouse() Adds a INNER JOIN clause and with to the query using the ObjHouse relation
 *
 * @method     ChildObjGroupQuery leftJoinObjGroupVersion($relationAlias = null) Adds a LEFT JOIN clause to the query using the ObjGroupVersion relation
 * @method     ChildObjGroupQuery rightJoinObjGroupVersion($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ObjGroupVersion relation
 * @method     ChildObjGroupQuery innerJoinObjGroupVersion($relationAlias = null) Adds a INNER JOIN clause to the query using the ObjGroupVersion relation
 *
 * @method     ChildObjGroupQuery joinWithObjGroupVersion($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ObjGroupVersion relation
 *
 * @method     ChildObjGroupQuery leftJoinWithObjGroupVersion() Adds a LEFT JOIN clause and with to the query using the ObjGroupVersion relation
 * @method     ChildObjGroupQuery rightJoinWithObjGroupVersion() Adds a RIGHT JOIN clause and with to the query using the ObjGroupVersion relation
 * @method     ChildObjGroupQuery innerJoinWithObjGroupVersion() Adds a INNER JOIN clause and with to the query using the ObjGroupVersion relation
 *
 * @method     \DB\UsersQuery|\DB\ObjSubprojectQuery|\DB\ObjHouseQuery|\DB\ObjGroupVersionQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildObjGroup|null findOne(?ConnectionInterface $con = null) Return the first ChildObjGroup matching the query
 * @method     ChildObjGroup findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildObjGroup matching the query, or a new ChildObjGroup object populated from the query conditions when no match is found
 *
 * @method     ChildObjGroup|null findOneById(int $id) Return the first ChildObjGroup filtered by the id column
 * @method     ChildObjGroup|null findOneByName(string $name) Return the first ChildObjGroup filtered by the name column
 * @method     ChildObjGroup|null findOneByStatus(string $status) Return the first ChildObjGroup filtered by the status column
 * @method     ChildObjGroup|null findOneByIsPublic(boolean $is_public) Return the first ChildObjGroup filtered by the is_public column
 * @method     ChildObjGroup|null findOneByIsAvailable(boolean $is_available) Return the first ChildObjGroup filtered by the is_available column
 * @method     ChildObjGroup|null findOneBySubprojectId(int $subproject_id) Return the first ChildObjGroup filtered by the subproject_id column
 * @method     ChildObjGroup|null findOneByVersionCreatedBy(int $version_created_by) Return the first ChildObjGroup filtered by the version_created_by column
 * @method     ChildObjGroup|null findOneByVersion(int $version) Return the first ChildObjGroup filtered by the version column
 * @method     ChildObjGroup|null findOneByVersionCreatedAt(string $version_created_at) Return the first ChildObjGroup filtered by the version_created_at column
 * @method     ChildObjGroup|null findOneByVersionComment(string $version_comment) Return the first ChildObjGroup filtered by the version_comment column *

 * @method     ChildObjGroup requirePk($key, ?ConnectionInterface $con = null) Return the ChildObjGroup by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjGroup requireOne(?ConnectionInterface $con = null) Return the first ChildObjGroup matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildObjGroup requireOneById(int $id) Return the first ChildObjGroup filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjGroup requireOneByName(string $name) Return the first ChildObjGroup filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjGroup requireOneByStatus(string $status) Return the first ChildObjGroup filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjGroup requireOneByIsPublic(boolean $is_public) Return the first ChildObjGroup filtered by the is_public column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjGroup requireOneByIsAvailable(boolean $is_available) Return the first ChildObjGroup filtered by the is_available column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjGroup requireOneBySubprojectId(int $subproject_id) Return the first ChildObjGroup filtered by the subproject_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjGroup requireOneByVersionCreatedBy(int $version_created_by) Return the first ChildObjGroup filtered by the version_created_by column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjGroup requireOneByVersion(int $version) Return the first ChildObjGroup filtered by the version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjGroup requireOneByVersionCreatedAt(string $version_created_at) Return the first ChildObjGroup filtered by the version_created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjGroup requireOneByVersionComment(string $version_comment) Return the first ChildObjGroup filtered by the version_comment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildObjGroup[]|Collection find(?ConnectionInterface $con = null) Return ChildObjGroup objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildObjGroup> find(?ConnectionInterface $con = null) Return ChildObjGroup objects based on current ModelCriteria
 * @method     ChildObjGroup[]|Collection findById(int $id) Return ChildObjGroup objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildObjGroup> findById(int $id) Return ChildObjGroup objects filtered by the id column
 * @method     ChildObjGroup[]|Collection findByName(string $name) Return ChildObjGroup objects filtered by the name column
 * @psalm-method Collection&\Traversable<ChildObjGroup> findByName(string $name) Return ChildObjGroup objects filtered by the name column
 * @method     ChildObjGroup[]|Collection findByStatus(string $status) Return ChildObjGroup objects filtered by the status column
 * @psalm-method Collection&\Traversable<ChildObjGroup> findByStatus(string $status) Return ChildObjGroup objects filtered by the status column
 * @method     ChildObjGroup[]|Collection findByIsPublic(boolean $is_public) Return ChildObjGroup objects filtered by the is_public column
 * @psalm-method Collection&\Traversable<ChildObjGroup> findByIsPublic(boolean $is_public) Return ChildObjGroup objects filtered by the is_public column
 * @method     ChildObjGroup[]|Collection findByIsAvailable(boolean $is_available) Return ChildObjGroup objects filtered by the is_available column
 * @psalm-method Collection&\Traversable<ChildObjGroup> findByIsAvailable(boolean $is_available) Return ChildObjGroup objects filtered by the is_available column
 * @method     ChildObjGroup[]|Collection findBySubprojectId(int $subproject_id) Return ChildObjGroup objects filtered by the subproject_id column
 * @psalm-method Collection&\Traversable<ChildObjGroup> findBySubprojectId(int $subproject_id) Return ChildObjGroup objects filtered by the subproject_id column
 * @method     ChildObjGroup[]|Collection findByVersionCreatedBy(int $version_created_by) Return ChildObjGroup objects filtered by the version_created_by column
 * @psalm-method Collection&\Traversable<ChildObjGroup> findByVersionCreatedBy(int $version_created_by) Return ChildObjGroup objects filtered by the version_created_by column
 * @method     ChildObjGroup[]|Collection findByVersion(int $version) Return ChildObjGroup objects filtered by the version column
 * @psalm-method Collection&\Traversable<ChildObjGroup> findByVersion(int $version) Return ChildObjGroup objects filtered by the version column
 * @method     ChildObjGroup[]|Collection findByVersionCreatedAt(string $version_created_at) Return ChildObjGroup objects filtered by the version_created_at column
 * @psalm-method Collection&\Traversable<ChildObjGroup> findByVersionCreatedAt(string $version_created_at) Return ChildObjGroup objects filtered by the version_created_at column
 * @method     ChildObjGroup[]|Collection findByVersionComment(string $version_comment) Return ChildObjGroup objects filtered by the version_comment column
 * @psalm-method Collection&\Traversable<ChildObjGroup> findByVersionComment(string $version_comment) Return ChildObjGroup objects filtered by the version_comment column
 * @method     ChildObjGroup[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildObjGroup> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ObjGroupQuery extends ModelCriteria
{

    // versionable behavior

    /**
     * Whether the versioning is enabled
     */
    static $isVersioningEnabled = true;
protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \DB\Base\ObjGroupQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\DB\\ObjGroup', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildObjGroupQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildObjGroupQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildObjGroupQuery) {
            return $criteria;
        }
        $query = new ChildObjGroupQuery();
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
     * @return ChildObjGroup|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ObjGroupTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ObjGroupTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildObjGroup A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, status, is_public, is_available, subproject_id, version_created_by, version, version_created_at, version_comment FROM obj_group WHERE id = :p0';
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
            /** @var ChildObjGroup $obj */
            $obj = new ChildObjGroup();
            $obj->hydrate($row);
            ObjGroupTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildObjGroup|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(ObjGroupTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(ObjGroupTableMap::COL_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(ObjGroupTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ObjGroupTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ObjGroupTableMap::COL_ID, $id, $comparison);

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

        $this->addUsingAlias(ObjGroupTableMap::COL_NAME, $name, $comparison);

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

        $this->addUsingAlias(ObjGroupTableMap::COL_STATUS, $status, $comparison);

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

        $this->addUsingAlias(ObjGroupTableMap::COL_IS_PUBLIC, $isPublic, $comparison);

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

        $this->addUsingAlias(ObjGroupTableMap::COL_IS_AVAILABLE, $isAvailable, $comparison);

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
     * @see       filterByObjSubproject()
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
                $this->addUsingAlias(ObjGroupTableMap::COL_SUBPROJECT_ID, $subprojectId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($subprojectId['max'])) {
                $this->addUsingAlias(ObjGroupTableMap::COL_SUBPROJECT_ID, $subprojectId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ObjGroupTableMap::COL_SUBPROJECT_ID, $subprojectId, $comparison);

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
                $this->addUsingAlias(ObjGroupTableMap::COL_VERSION_CREATED_BY, $versionCreatedBy['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($versionCreatedBy['max'])) {
                $this->addUsingAlias(ObjGroupTableMap::COL_VERSION_CREATED_BY, $versionCreatedBy['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ObjGroupTableMap::COL_VERSION_CREATED_BY, $versionCreatedBy, $comparison);

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
                $this->addUsingAlias(ObjGroupTableMap::COL_VERSION, $version['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($version['max'])) {
                $this->addUsingAlias(ObjGroupTableMap::COL_VERSION, $version['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ObjGroupTableMap::COL_VERSION, $version, $comparison);

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
                $this->addUsingAlias(ObjGroupTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($versionCreatedAt['max'])) {
                $this->addUsingAlias(ObjGroupTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ObjGroupTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt, $comparison);

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

        $this->addUsingAlias(ObjGroupTableMap::COL_VERSION_COMMENT, $versionComment, $comparison);

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
                ->addUsingAlias(ObjGroupTableMap::COL_VERSION_CREATED_BY, $users->getId(), $comparison);
        } elseif ($users instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(ObjGroupTableMap::COL_VERSION_CREATED_BY, $users->toKeyValue('PrimaryKey', 'Id'), $comparison);

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
     * Filter the query by a related \DB\ObjSubproject object
     *
     * @param \DB\ObjSubproject|ObjectCollection $objSubproject The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByObjSubproject($objSubproject, ?string $comparison = null)
    {
        if ($objSubproject instanceof \DB\ObjSubproject) {
            return $this
                ->addUsingAlias(ObjGroupTableMap::COL_SUBPROJECT_ID, $objSubproject->getId(), $comparison);
        } elseif ($objSubproject instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(ObjGroupTableMap::COL_SUBPROJECT_ID, $objSubproject->toKeyValue('PrimaryKey', 'Id'), $comparison);

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
     * Filter the query by a related \DB\ObjHouse object
     *
     * @param \DB\ObjHouse|ObjectCollection $objHouse the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByObjHouse($objHouse, ?string $comparison = null)
    {
        if ($objHouse instanceof \DB\ObjHouse) {
            $this
                ->addUsingAlias(ObjGroupTableMap::COL_ID, $objHouse->getGroupId(), $comparison);

            return $this;
        } elseif ($objHouse instanceof ObjectCollection) {
            $this
                ->useObjHouseQuery()
                ->filterByPrimaryKeys($objHouse->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByObjHouse() only accepts arguments of type \DB\ObjHouse or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ObjHouse relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinObjHouse(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ObjHouse');

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
            $this->addJoinObject($join, 'ObjHouse');
        }

        return $this;
    }

    /**
     * Use the ObjHouse relation ObjHouse object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\ObjHouseQuery A secondary query class using the current class as primary query
     */
    public function useObjHouseQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinObjHouse($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ObjHouse', '\DB\ObjHouseQuery');
    }

    /**
     * Use the ObjHouse relation ObjHouse object
     *
     * @param callable(\DB\ObjHouseQuery):\DB\ObjHouseQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withObjHouseQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useObjHouseQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to ObjHouse table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\ObjHouseQuery The inner query object of the EXISTS statement
     */
    public function useObjHouseExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('ObjHouse', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to ObjHouse table for a NOT EXISTS query.
     *
     * @see useObjHouseExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\ObjHouseQuery The inner query object of the NOT EXISTS statement
     */
    public function useObjHouseNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('ObjHouse', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \DB\ObjGroupVersion object
     *
     * @param \DB\ObjGroupVersion|ObjectCollection $objGroupVersion the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByObjGroupVersion($objGroupVersion, ?string $comparison = null)
    {
        if ($objGroupVersion instanceof \DB\ObjGroupVersion) {
            $this
                ->addUsingAlias(ObjGroupTableMap::COL_ID, $objGroupVersion->getId(), $comparison);

            return $this;
        } elseif ($objGroupVersion instanceof ObjectCollection) {
            $this
                ->useObjGroupVersionQuery()
                ->filterByPrimaryKeys($objGroupVersion->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByObjGroupVersion() only accepts arguments of type \DB\ObjGroupVersion or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ObjGroupVersion relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinObjGroupVersion(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ObjGroupVersion');

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
            $this->addJoinObject($join, 'ObjGroupVersion');
        }

        return $this;
    }

    /**
     * Use the ObjGroupVersion relation ObjGroupVersion object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\ObjGroupVersionQuery A secondary query class using the current class as primary query
     */
    public function useObjGroupVersionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinObjGroupVersion($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ObjGroupVersion', '\DB\ObjGroupVersionQuery');
    }

    /**
     * Use the ObjGroupVersion relation ObjGroupVersion object
     *
     * @param callable(\DB\ObjGroupVersionQuery):\DB\ObjGroupVersionQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withObjGroupVersionQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useObjGroupVersionQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to ObjGroupVersion table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\ObjGroupVersionQuery The inner query object of the EXISTS statement
     */
    public function useObjGroupVersionExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('ObjGroupVersion', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to ObjGroupVersion table for a NOT EXISTS query.
     *
     * @see useObjGroupVersionExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\ObjGroupVersionQuery The inner query object of the NOT EXISTS statement
     */
    public function useObjGroupVersionNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('ObjGroupVersion', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Exclude object from result
     *
     * @param ChildObjGroup $objGroup Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($objGroup = null)
    {
        if ($objGroup) {
            $this->addUsingAlias(ObjGroupTableMap::COL_ID, $objGroup->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the obj_group table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ObjGroupTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ObjGroupTableMap::clearInstancePool();
            ObjGroupTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ObjGroupTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ObjGroupTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ObjGroupTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ObjGroupTableMap::clearRelatedInstancePool();

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
