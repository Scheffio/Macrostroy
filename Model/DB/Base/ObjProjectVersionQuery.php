<?php

namespace DB\Base;

use \Exception;
use \PDO;
use DB\ObjProjectVersion as ChildObjProjectVersion;
use DB\ObjProjectVersionQuery as ChildObjProjectVersionQuery;
use DB\Map\ObjProjectVersionTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'obj_project_version' table.
 *
 *
 *
 * @method     ChildObjProjectVersionQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildObjProjectVersionQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildObjProjectVersionQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildObjProjectVersionQuery orderByIsPublic($order = Criteria::ASC) Order by the is_public column
 * @method     ChildObjProjectVersionQuery orderByIsAvailable($order = Criteria::ASC) Order by the is_available column
 * @method     ChildObjProjectVersionQuery orderByVersionCreatedBy($order = Criteria::ASC) Order by the version_created_by column
 * @method     ChildObjProjectVersionQuery orderByVersion($order = Criteria::ASC) Order by the version column
 * @method     ChildObjProjectVersionQuery orderByVersionCreatedAt($order = Criteria::ASC) Order by the version_created_at column
 * @method     ChildObjProjectVersionQuery orderByVersionComment($order = Criteria::ASC) Order by the version_comment column
 * @method     ChildObjProjectVersionQuery orderByObjSubprojectIds($order = Criteria::ASC) Order by the obj_subproject_ids column
 * @method     ChildObjProjectVersionQuery orderByObjSubprojectVersions($order = Criteria::ASC) Order by the obj_subproject_versions column
 *
 * @method     ChildObjProjectVersionQuery groupById() Group by the id column
 * @method     ChildObjProjectVersionQuery groupByName() Group by the name column
 * @method     ChildObjProjectVersionQuery groupByStatus() Group by the status column
 * @method     ChildObjProjectVersionQuery groupByIsPublic() Group by the is_public column
 * @method     ChildObjProjectVersionQuery groupByIsAvailable() Group by the is_available column
 * @method     ChildObjProjectVersionQuery groupByVersionCreatedBy() Group by the version_created_by column
 * @method     ChildObjProjectVersionQuery groupByVersion() Group by the version column
 * @method     ChildObjProjectVersionQuery groupByVersionCreatedAt() Group by the version_created_at column
 * @method     ChildObjProjectVersionQuery groupByVersionComment() Group by the version_comment column
 * @method     ChildObjProjectVersionQuery groupByObjSubprojectIds() Group by the obj_subproject_ids column
 * @method     ChildObjProjectVersionQuery groupByObjSubprojectVersions() Group by the obj_subproject_versions column
 *
 * @method     ChildObjProjectVersionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildObjProjectVersionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildObjProjectVersionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildObjProjectVersionQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildObjProjectVersionQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildObjProjectVersionQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildObjProjectVersionQuery leftJoinObjProject($relationAlias = null) Adds a LEFT JOIN clause to the query using the ObjProject relation
 * @method     ChildObjProjectVersionQuery rightJoinObjProject($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ObjProject relation
 * @method     ChildObjProjectVersionQuery innerJoinObjProject($relationAlias = null) Adds a INNER JOIN clause to the query using the ObjProject relation
 *
 * @method     ChildObjProjectVersionQuery joinWithObjProject($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ObjProject relation
 *
 * @method     ChildObjProjectVersionQuery leftJoinWithObjProject() Adds a LEFT JOIN clause and with to the query using the ObjProject relation
 * @method     ChildObjProjectVersionQuery rightJoinWithObjProject() Adds a RIGHT JOIN clause and with to the query using the ObjProject relation
 * @method     ChildObjProjectVersionQuery innerJoinWithObjProject() Adds a INNER JOIN clause and with to the query using the ObjProject relation
 *
 * @method     \DB\ObjProjectQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildObjProjectVersion|null findOne(?ConnectionInterface $con = null) Return the first ChildObjProjectVersion matching the query
 * @method     ChildObjProjectVersion findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildObjProjectVersion matching the query, or a new ChildObjProjectVersion object populated from the query conditions when no match is found
 *
 * @method     ChildObjProjectVersion|null findOneById(int $id) Return the first ChildObjProjectVersion filtered by the id column
 * @method     ChildObjProjectVersion|null findOneByName(string $name) Return the first ChildObjProjectVersion filtered by the name column
 * @method     ChildObjProjectVersion|null findOneByStatus(string $status) Return the first ChildObjProjectVersion filtered by the status column
 * @method     ChildObjProjectVersion|null findOneByIsPublic(boolean $is_public) Return the first ChildObjProjectVersion filtered by the is_public column
 * @method     ChildObjProjectVersion|null findOneByIsAvailable(boolean $is_available) Return the first ChildObjProjectVersion filtered by the is_available column
 * @method     ChildObjProjectVersion|null findOneByVersionCreatedBy(int $version_created_by) Return the first ChildObjProjectVersion filtered by the version_created_by column
 * @method     ChildObjProjectVersion|null findOneByVersion(int $version) Return the first ChildObjProjectVersion filtered by the version column
 * @method     ChildObjProjectVersion|null findOneByVersionCreatedAt(string $version_created_at) Return the first ChildObjProjectVersion filtered by the version_created_at column
 * @method     ChildObjProjectVersion|null findOneByVersionComment(string $version_comment) Return the first ChildObjProjectVersion filtered by the version_comment column
 * @method     ChildObjProjectVersion|null findOneByObjSubprojectIds(array $obj_subproject_ids) Return the first ChildObjProjectVersion filtered by the obj_subproject_ids column
 * @method     ChildObjProjectVersion|null findOneByObjSubprojectVersions(array $obj_subproject_versions) Return the first ChildObjProjectVersion filtered by the obj_subproject_versions column *

 * @method     ChildObjProjectVersion requirePk($key, ?ConnectionInterface $con = null) Return the ChildObjProjectVersion by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjProjectVersion requireOne(?ConnectionInterface $con = null) Return the first ChildObjProjectVersion matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildObjProjectVersion requireOneById(int $id) Return the first ChildObjProjectVersion filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjProjectVersion requireOneByName(string $name) Return the first ChildObjProjectVersion filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjProjectVersion requireOneByStatus(string $status) Return the first ChildObjProjectVersion filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjProjectVersion requireOneByIsPublic(boolean $is_public) Return the first ChildObjProjectVersion filtered by the is_public column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjProjectVersion requireOneByIsAvailable(boolean $is_available) Return the first ChildObjProjectVersion filtered by the is_available column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjProjectVersion requireOneByVersionCreatedBy(int $version_created_by) Return the first ChildObjProjectVersion filtered by the version_created_by column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjProjectVersion requireOneByVersion(int $version) Return the first ChildObjProjectVersion filtered by the version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjProjectVersion requireOneByVersionCreatedAt(string $version_created_at) Return the first ChildObjProjectVersion filtered by the version_created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjProjectVersion requireOneByVersionComment(string $version_comment) Return the first ChildObjProjectVersion filtered by the version_comment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjProjectVersion requireOneByObjSubprojectIds(array $obj_subproject_ids) Return the first ChildObjProjectVersion filtered by the obj_subproject_ids column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjProjectVersion requireOneByObjSubprojectVersions(array $obj_subproject_versions) Return the first ChildObjProjectVersion filtered by the obj_subproject_versions column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildObjProjectVersion[]|Collection find(?ConnectionInterface $con = null) Return ChildObjProjectVersion objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildObjProjectVersion> find(?ConnectionInterface $con = null) Return ChildObjProjectVersion objects based on current ModelCriteria
 * @method     ChildObjProjectVersion[]|Collection findById(int $id) Return ChildObjProjectVersion objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildObjProjectVersion> findById(int $id) Return ChildObjProjectVersion objects filtered by the id column
 * @method     ChildObjProjectVersion[]|Collection findByName(string $name) Return ChildObjProjectVersion objects filtered by the name column
 * @psalm-method Collection&\Traversable<ChildObjProjectVersion> findByName(string $name) Return ChildObjProjectVersion objects filtered by the name column
 * @method     ChildObjProjectVersion[]|Collection findByStatus(string $status) Return ChildObjProjectVersion objects filtered by the status column
 * @psalm-method Collection&\Traversable<ChildObjProjectVersion> findByStatus(string $status) Return ChildObjProjectVersion objects filtered by the status column
 * @method     ChildObjProjectVersion[]|Collection findByIsPublic(boolean $is_public) Return ChildObjProjectVersion objects filtered by the is_public column
 * @psalm-method Collection&\Traversable<ChildObjProjectVersion> findByIsPublic(boolean $is_public) Return ChildObjProjectVersion objects filtered by the is_public column
 * @method     ChildObjProjectVersion[]|Collection findByIsAvailable(boolean $is_available) Return ChildObjProjectVersion objects filtered by the is_available column
 * @psalm-method Collection&\Traversable<ChildObjProjectVersion> findByIsAvailable(boolean $is_available) Return ChildObjProjectVersion objects filtered by the is_available column
 * @method     ChildObjProjectVersion[]|Collection findByVersionCreatedBy(int $version_created_by) Return ChildObjProjectVersion objects filtered by the version_created_by column
 * @psalm-method Collection&\Traversable<ChildObjProjectVersion> findByVersionCreatedBy(int $version_created_by) Return ChildObjProjectVersion objects filtered by the version_created_by column
 * @method     ChildObjProjectVersion[]|Collection findByVersion(int $version) Return ChildObjProjectVersion objects filtered by the version column
 * @psalm-method Collection&\Traversable<ChildObjProjectVersion> findByVersion(int $version) Return ChildObjProjectVersion objects filtered by the version column
 * @method     ChildObjProjectVersion[]|Collection findByVersionCreatedAt(string $version_created_at) Return ChildObjProjectVersion objects filtered by the version_created_at column
 * @psalm-method Collection&\Traversable<ChildObjProjectVersion> findByVersionCreatedAt(string $version_created_at) Return ChildObjProjectVersion objects filtered by the version_created_at column
 * @method     ChildObjProjectVersion[]|Collection findByVersionComment(string $version_comment) Return ChildObjProjectVersion objects filtered by the version_comment column
 * @psalm-method Collection&\Traversable<ChildObjProjectVersion> findByVersionComment(string $version_comment) Return ChildObjProjectVersion objects filtered by the version_comment column
 * @method     ChildObjProjectVersion[]|Collection findByObjSubprojectIds(array $obj_subproject_ids) Return ChildObjProjectVersion objects filtered by the obj_subproject_ids column
 * @psalm-method Collection&\Traversable<ChildObjProjectVersion> findByObjSubprojectIds(array $obj_subproject_ids) Return ChildObjProjectVersion objects filtered by the obj_subproject_ids column
 * @method     ChildObjProjectVersion[]|Collection findByObjSubprojectVersions(array $obj_subproject_versions) Return ChildObjProjectVersion objects filtered by the obj_subproject_versions column
 * @psalm-method Collection&\Traversable<ChildObjProjectVersion> findByObjSubprojectVersions(array $obj_subproject_versions) Return ChildObjProjectVersion objects filtered by the obj_subproject_versions column
 * @method     ChildObjProjectVersion[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildObjProjectVersion> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ObjProjectVersionQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \DB\Base\ObjProjectVersionQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\DB\\ObjProjectVersion', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildObjProjectVersionQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildObjProjectVersionQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildObjProjectVersionQuery) {
            return $criteria;
        }
        $query = new ChildObjProjectVersionQuery();
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
     * @return ChildObjProjectVersion|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ObjProjectVersionTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ObjProjectVersionTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildObjProjectVersion A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, status, is_public, is_available, version_created_by, version, version_created_at, version_comment, obj_subproject_ids, obj_subproject_versions FROM obj_project_version WHERE id = :p0 AND version = :p1';
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
            /** @var ChildObjProjectVersion $obj */
            $obj = new ChildObjProjectVersion();
            $obj->hydrate($row);
            ObjProjectVersionTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildObjProjectVersion|array|mixed the result, formatted by the current formatter
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
        $this->addUsingAlias(ObjProjectVersionTableMap::COL_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(ObjProjectVersionTableMap::COL_VERSION, $key[1], Criteria::EQUAL);

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
            $cton0 = $this->getNewCriterion(ObjProjectVersionTableMap::COL_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(ObjProjectVersionTableMap::COL_VERSION, $key[1], Criteria::EQUAL);
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
     * @see       filterByObjProject()
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
                $this->addUsingAlias(ObjProjectVersionTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ObjProjectVersionTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ObjProjectVersionTableMap::COL_ID, $id, $comparison);

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

        $this->addUsingAlias(ObjProjectVersionTableMap::COL_NAME, $name, $comparison);

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

        $this->addUsingAlias(ObjProjectVersionTableMap::COL_STATUS, $status, $comparison);

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

        $this->addUsingAlias(ObjProjectVersionTableMap::COL_IS_PUBLIC, $isPublic, $comparison);

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

        $this->addUsingAlias(ObjProjectVersionTableMap::COL_IS_AVAILABLE, $isAvailable, $comparison);

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
                $this->addUsingAlias(ObjProjectVersionTableMap::COL_VERSION_CREATED_BY, $versionCreatedBy['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($versionCreatedBy['max'])) {
                $this->addUsingAlias(ObjProjectVersionTableMap::COL_VERSION_CREATED_BY, $versionCreatedBy['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ObjProjectVersionTableMap::COL_VERSION_CREATED_BY, $versionCreatedBy, $comparison);

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
                $this->addUsingAlias(ObjProjectVersionTableMap::COL_VERSION, $version['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($version['max'])) {
                $this->addUsingAlias(ObjProjectVersionTableMap::COL_VERSION, $version['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ObjProjectVersionTableMap::COL_VERSION, $version, $comparison);

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
                $this->addUsingAlias(ObjProjectVersionTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($versionCreatedAt['max'])) {
                $this->addUsingAlias(ObjProjectVersionTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ObjProjectVersionTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt, $comparison);

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

        $this->addUsingAlias(ObjProjectVersionTableMap::COL_VERSION_COMMENT, $versionComment, $comparison);

        return $this;
    }

    /**
     * Filter the query on the obj_subproject_ids column
     *
     * @param array $objSubprojectIds The values to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByObjSubprojectIds($objSubprojectIds = null, ?string $comparison = null)
    {
        $key = $this->getAliasedColName(ObjProjectVersionTableMap::COL_OBJ_SUBPROJECT_IDS);
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            foreach ($objSubprojectIds as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addAnd($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_SOME) {
            foreach ($objSubprojectIds as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addOr($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            foreach ($objSubprojectIds as $value) {
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

        $this->addUsingAlias(ObjProjectVersionTableMap::COL_OBJ_SUBPROJECT_IDS, $objSubprojectIds, $comparison);

        return $this;
    }

    /**
     * Filter the query on the obj_subproject_ids column
     * @param mixed $objSubprojectIds The value to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::CONTAINS_ALL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByObjSubprojectId($objSubprojectIds = null, ?string $comparison = null)
    {
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            if (is_scalar($objSubprojectIds)) {
                $objSubprojectIds = '%| ' . $objSubprojectIds . ' |%';
                $comparison = Criteria::LIKE;
            }
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            $objSubprojectIds = '%| ' . $objSubprojectIds . ' |%';
            $comparison = Criteria::NOT_LIKE;
            $key = $this->getAliasedColName(ObjProjectVersionTableMap::COL_OBJ_SUBPROJECT_IDS);
            if ($this->containsKey($key)) {
                $this->addAnd($key, $objSubprojectIds, $comparison);
            } else {
                $this->addAnd($key, $objSubprojectIds, $comparison);
            }
            $this->addOr($key, null, Criteria::ISNULL);

            return $this;
        }

        $this->addUsingAlias(ObjProjectVersionTableMap::COL_OBJ_SUBPROJECT_IDS, $objSubprojectIds, $comparison);

        return $this;
    }

    /**
     * Filter the query on the obj_subproject_versions column
     *
     * @param array $objSubprojectVersions The values to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByObjSubprojectVersions($objSubprojectVersions = null, ?string $comparison = null)
    {
        $key = $this->getAliasedColName(ObjProjectVersionTableMap::COL_OBJ_SUBPROJECT_VERSIONS);
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            foreach ($objSubprojectVersions as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addAnd($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_SOME) {
            foreach ($objSubprojectVersions as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addOr($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            foreach ($objSubprojectVersions as $value) {
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

        $this->addUsingAlias(ObjProjectVersionTableMap::COL_OBJ_SUBPROJECT_VERSIONS, $objSubprojectVersions, $comparison);

        return $this;
    }

    /**
     * Filter the query on the obj_subproject_versions column
     * @param mixed $objSubprojectVersions The value to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::CONTAINS_ALL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByObjSubprojectVersion($objSubprojectVersions = null, ?string $comparison = null)
    {
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            if (is_scalar($objSubprojectVersions)) {
                $objSubprojectVersions = '%| ' . $objSubprojectVersions . ' |%';
                $comparison = Criteria::LIKE;
            }
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            $objSubprojectVersions = '%| ' . $objSubprojectVersions . ' |%';
            $comparison = Criteria::NOT_LIKE;
            $key = $this->getAliasedColName(ObjProjectVersionTableMap::COL_OBJ_SUBPROJECT_VERSIONS);
            if ($this->containsKey($key)) {
                $this->addAnd($key, $objSubprojectVersions, $comparison);
            } else {
                $this->addAnd($key, $objSubprojectVersions, $comparison);
            }
            $this->addOr($key, null, Criteria::ISNULL);

            return $this;
        }

        $this->addUsingAlias(ObjProjectVersionTableMap::COL_OBJ_SUBPROJECT_VERSIONS, $objSubprojectVersions, $comparison);

        return $this;
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
                ->addUsingAlias(ObjProjectVersionTableMap::COL_ID, $objProject->getId(), $comparison);
        } elseif ($objProject instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(ObjProjectVersionTableMap::COL_ID, $objProject->toKeyValue('PrimaryKey', 'Id'), $comparison);

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
     * Exclude object from result
     *
     * @param ChildObjProjectVersion $objProjectVersion Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($objProjectVersion = null)
    {
        if ($objProjectVersion) {
            $this->addCond('pruneCond0', $this->getAliasedColName(ObjProjectVersionTableMap::COL_ID), $objProjectVersion->getId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(ObjProjectVersionTableMap::COL_VERSION), $objProjectVersion->getVersion(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the obj_project_version table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ObjProjectVersionTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ObjProjectVersionTableMap::clearInstancePool();
            ObjProjectVersionTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ObjProjectVersionTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ObjProjectVersionTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ObjProjectVersionTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ObjProjectVersionTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
