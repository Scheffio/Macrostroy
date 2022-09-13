<?php

namespace DB\Base;

use \Exception;
use \PDO;
use DB\ObjSubprojectVersion as ChildObjSubprojectVersion;
use DB\ObjSubprojectVersionQuery as ChildObjSubprojectVersionQuery;
use DB\Map\ObjSubprojectVersionTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'obj_subproject_version' table.
 *
 *
 *
 * @method     ChildObjSubprojectVersionQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildObjSubprojectVersionQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildObjSubprojectVersionQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildObjSubprojectVersionQuery orderByIsPublic($order = Criteria::ASC) Order by the is_public column
 * @method     ChildObjSubprojectVersionQuery orderByIsAvailable($order = Criteria::ASC) Order by the is_available column
 * @method     ChildObjSubprojectVersionQuery orderByProjectId($order = Criteria::ASC) Order by the project_id column
 * @method     ChildObjSubprojectVersionQuery orderByVersionCreatedBy($order = Criteria::ASC) Order by the version_created_by column
 * @method     ChildObjSubprojectVersionQuery orderByVersion($order = Criteria::ASC) Order by the version column
 * @method     ChildObjSubprojectVersionQuery orderByVersionCreatedAt($order = Criteria::ASC) Order by the version_created_at column
 * @method     ChildObjSubprojectVersionQuery orderByVersionComment($order = Criteria::ASC) Order by the version_comment column
 * @method     ChildObjSubprojectVersionQuery orderByProjectIdVersion($order = Criteria::ASC) Order by the project_id_version column
 * @method     ChildObjSubprojectVersionQuery orderByObjGroupIds($order = Criteria::ASC) Order by the obj_group_ids column
 * @method     ChildObjSubprojectVersionQuery orderByObjGroupVersions($order = Criteria::ASC) Order by the obj_group_versions column
 *
 * @method     ChildObjSubprojectVersionQuery groupById() Group by the id column
 * @method     ChildObjSubprojectVersionQuery groupByName() Group by the name column
 * @method     ChildObjSubprojectVersionQuery groupByStatus() Group by the status column
 * @method     ChildObjSubprojectVersionQuery groupByIsPublic() Group by the is_public column
 * @method     ChildObjSubprojectVersionQuery groupByIsAvailable() Group by the is_available column
 * @method     ChildObjSubprojectVersionQuery groupByProjectId() Group by the project_id column
 * @method     ChildObjSubprojectVersionQuery groupByVersionCreatedBy() Group by the version_created_by column
 * @method     ChildObjSubprojectVersionQuery groupByVersion() Group by the version column
 * @method     ChildObjSubprojectVersionQuery groupByVersionCreatedAt() Group by the version_created_at column
 * @method     ChildObjSubprojectVersionQuery groupByVersionComment() Group by the version_comment column
 * @method     ChildObjSubprojectVersionQuery groupByProjectIdVersion() Group by the project_id_version column
 * @method     ChildObjSubprojectVersionQuery groupByObjGroupIds() Group by the obj_group_ids column
 * @method     ChildObjSubprojectVersionQuery groupByObjGroupVersions() Group by the obj_group_versions column
 *
 * @method     ChildObjSubprojectVersionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildObjSubprojectVersionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildObjSubprojectVersionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildObjSubprojectVersionQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildObjSubprojectVersionQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildObjSubprojectVersionQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildObjSubprojectVersionQuery leftJoinObjSubproject($relationAlias = null) Adds a LEFT JOIN clause to the query using the ObjSubproject relation
 * @method     ChildObjSubprojectVersionQuery rightJoinObjSubproject($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ObjSubproject relation
 * @method     ChildObjSubprojectVersionQuery innerJoinObjSubproject($relationAlias = null) Adds a INNER JOIN clause to the query using the ObjSubproject relation
 *
 * @method     ChildObjSubprojectVersionQuery joinWithObjSubproject($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ObjSubproject relation
 *
 * @method     ChildObjSubprojectVersionQuery leftJoinWithObjSubproject() Adds a LEFT JOIN clause and with to the query using the ObjSubproject relation
 * @method     ChildObjSubprojectVersionQuery rightJoinWithObjSubproject() Adds a RIGHT JOIN clause and with to the query using the ObjSubproject relation
 * @method     ChildObjSubprojectVersionQuery innerJoinWithObjSubproject() Adds a INNER JOIN clause and with to the query using the ObjSubproject relation
 *
 * @method     \DB\ObjSubprojectQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildObjSubprojectVersion|null findOne(?ConnectionInterface $con = null) Return the first ChildObjSubprojectVersion matching the query
 * @method     ChildObjSubprojectVersion findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildObjSubprojectVersion matching the query, or a new ChildObjSubprojectVersion object populated from the query conditions when no match is found
 *
 * @method     ChildObjSubprojectVersion|null findOneById(int $id) Return the first ChildObjSubprojectVersion filtered by the id column
 * @method     ChildObjSubprojectVersion|null findOneByName(string $name) Return the first ChildObjSubprojectVersion filtered by the name column
 * @method     ChildObjSubprojectVersion|null findOneByStatus(string $status) Return the first ChildObjSubprojectVersion filtered by the status column
 * @method     ChildObjSubprojectVersion|null findOneByIsPublic(boolean $is_public) Return the first ChildObjSubprojectVersion filtered by the is_public column
 * @method     ChildObjSubprojectVersion|null findOneByIsAvailable(boolean $is_available) Return the first ChildObjSubprojectVersion filtered by the is_available column
 * @method     ChildObjSubprojectVersion|null findOneByProjectId(int $project_id) Return the first ChildObjSubprojectVersion filtered by the project_id column
 * @method     ChildObjSubprojectVersion|null findOneByVersionCreatedBy(int $version_created_by) Return the first ChildObjSubprojectVersion filtered by the version_created_by column
 * @method     ChildObjSubprojectVersion|null findOneByVersion(int $version) Return the first ChildObjSubprojectVersion filtered by the version column
 * @method     ChildObjSubprojectVersion|null findOneByVersionCreatedAt(string $version_created_at) Return the first ChildObjSubprojectVersion filtered by the version_created_at column
 * @method     ChildObjSubprojectVersion|null findOneByVersionComment(string $version_comment) Return the first ChildObjSubprojectVersion filtered by the version_comment column
 * @method     ChildObjSubprojectVersion|null findOneByProjectIdVersion(int $project_id_version) Return the first ChildObjSubprojectVersion filtered by the project_id_version column
 * @method     ChildObjSubprojectVersion|null findOneByObjGroupIds(array $obj_group_ids) Return the first ChildObjSubprojectVersion filtered by the obj_group_ids column
 * @method     ChildObjSubprojectVersion|null findOneByObjGroupVersions(array $obj_group_versions) Return the first ChildObjSubprojectVersion filtered by the obj_group_versions column *

 * @method     ChildObjSubprojectVersion requirePk($key, ?ConnectionInterface $con = null) Return the ChildObjSubprojectVersion by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjSubprojectVersion requireOne(?ConnectionInterface $con = null) Return the first ChildObjSubprojectVersion matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildObjSubprojectVersion requireOneById(int $id) Return the first ChildObjSubprojectVersion filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjSubprojectVersion requireOneByName(string $name) Return the first ChildObjSubprojectVersion filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjSubprojectVersion requireOneByStatus(string $status) Return the first ChildObjSubprojectVersion filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjSubprojectVersion requireOneByIsPublic(boolean $is_public) Return the first ChildObjSubprojectVersion filtered by the is_public column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjSubprojectVersion requireOneByIsAvailable(boolean $is_available) Return the first ChildObjSubprojectVersion filtered by the is_available column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjSubprojectVersion requireOneByProjectId(int $project_id) Return the first ChildObjSubprojectVersion filtered by the project_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjSubprojectVersion requireOneByVersionCreatedBy(int $version_created_by) Return the first ChildObjSubprojectVersion filtered by the version_created_by column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjSubprojectVersion requireOneByVersion(int $version) Return the first ChildObjSubprojectVersion filtered by the version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjSubprojectVersion requireOneByVersionCreatedAt(string $version_created_at) Return the first ChildObjSubprojectVersion filtered by the version_created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjSubprojectVersion requireOneByVersionComment(string $version_comment) Return the first ChildObjSubprojectVersion filtered by the version_comment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjSubprojectVersion requireOneByProjectIdVersion(int $project_id_version) Return the first ChildObjSubprojectVersion filtered by the project_id_version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjSubprojectVersion requireOneByObjGroupIds(array $obj_group_ids) Return the first ChildObjSubprojectVersion filtered by the obj_group_ids column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjSubprojectVersion requireOneByObjGroupVersions(array $obj_group_versions) Return the first ChildObjSubprojectVersion filtered by the obj_group_versions column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildObjSubprojectVersion[]|Collection find(?ConnectionInterface $con = null) Return ChildObjSubprojectVersion objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildObjSubprojectVersion> find(?ConnectionInterface $con = null) Return ChildObjSubprojectVersion objects based on current ModelCriteria
 * @method     ChildObjSubprojectVersion[]|Collection findById(int $id) Return ChildObjSubprojectVersion objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildObjSubprojectVersion> findById(int $id) Return ChildObjSubprojectVersion objects filtered by the id column
 * @method     ChildObjSubprojectVersion[]|Collection findByName(string $name) Return ChildObjSubprojectVersion objects filtered by the name column
 * @psalm-method Collection&\Traversable<ChildObjSubprojectVersion> findByName(string $name) Return ChildObjSubprojectVersion objects filtered by the name column
 * @method     ChildObjSubprojectVersion[]|Collection findByStatus(string $status) Return ChildObjSubprojectVersion objects filtered by the status column
 * @psalm-method Collection&\Traversable<ChildObjSubprojectVersion> findByStatus(string $status) Return ChildObjSubprojectVersion objects filtered by the status column
 * @method     ChildObjSubprojectVersion[]|Collection findByIsPublic(boolean $is_public) Return ChildObjSubprojectVersion objects filtered by the is_public column
 * @psalm-method Collection&\Traversable<ChildObjSubprojectVersion> findByIsPublic(boolean $is_public) Return ChildObjSubprojectVersion objects filtered by the is_public column
 * @method     ChildObjSubprojectVersion[]|Collection findByIsAvailable(boolean $is_available) Return ChildObjSubprojectVersion objects filtered by the is_available column
 * @psalm-method Collection&\Traversable<ChildObjSubprojectVersion> findByIsAvailable(boolean $is_available) Return ChildObjSubprojectVersion objects filtered by the is_available column
 * @method     ChildObjSubprojectVersion[]|Collection findByProjectId(int $project_id) Return ChildObjSubprojectVersion objects filtered by the project_id column
 * @psalm-method Collection&\Traversable<ChildObjSubprojectVersion> findByProjectId(int $project_id) Return ChildObjSubprojectVersion objects filtered by the project_id column
 * @method     ChildObjSubprojectVersion[]|Collection findByVersionCreatedBy(int $version_created_by) Return ChildObjSubprojectVersion objects filtered by the version_created_by column
 * @psalm-method Collection&\Traversable<ChildObjSubprojectVersion> findByVersionCreatedBy(int $version_created_by) Return ChildObjSubprojectVersion objects filtered by the version_created_by column
 * @method     ChildObjSubprojectVersion[]|Collection findByVersion(int $version) Return ChildObjSubprojectVersion objects filtered by the version column
 * @psalm-method Collection&\Traversable<ChildObjSubprojectVersion> findByVersion(int $version) Return ChildObjSubprojectVersion objects filtered by the version column
 * @method     ChildObjSubprojectVersion[]|Collection findByVersionCreatedAt(string $version_created_at) Return ChildObjSubprojectVersion objects filtered by the version_created_at column
 * @psalm-method Collection&\Traversable<ChildObjSubprojectVersion> findByVersionCreatedAt(string $version_created_at) Return ChildObjSubprojectVersion objects filtered by the version_created_at column
 * @method     ChildObjSubprojectVersion[]|Collection findByVersionComment(string $version_comment) Return ChildObjSubprojectVersion objects filtered by the version_comment column
 * @psalm-method Collection&\Traversable<ChildObjSubprojectVersion> findByVersionComment(string $version_comment) Return ChildObjSubprojectVersion objects filtered by the version_comment column
 * @method     ChildObjSubprojectVersion[]|Collection findByProjectIdVersion(int $project_id_version) Return ChildObjSubprojectVersion objects filtered by the project_id_version column
 * @psalm-method Collection&\Traversable<ChildObjSubprojectVersion> findByProjectIdVersion(int $project_id_version) Return ChildObjSubprojectVersion objects filtered by the project_id_version column
 * @method     ChildObjSubprojectVersion[]|Collection findByObjGroupIds(array $obj_group_ids) Return ChildObjSubprojectVersion objects filtered by the obj_group_ids column
 * @psalm-method Collection&\Traversable<ChildObjSubprojectVersion> findByObjGroupIds(array $obj_group_ids) Return ChildObjSubprojectVersion objects filtered by the obj_group_ids column
 * @method     ChildObjSubprojectVersion[]|Collection findByObjGroupVersions(array $obj_group_versions) Return ChildObjSubprojectVersion objects filtered by the obj_group_versions column
 * @psalm-method Collection&\Traversable<ChildObjSubprojectVersion> findByObjGroupVersions(array $obj_group_versions) Return ChildObjSubprojectVersion objects filtered by the obj_group_versions column
 * @method     ChildObjSubprojectVersion[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildObjSubprojectVersion> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ObjSubprojectVersionQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \DB\Base\ObjSubprojectVersionQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\DB\\ObjSubprojectVersion', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildObjSubprojectVersionQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildObjSubprojectVersionQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildObjSubprojectVersionQuery) {
            return $criteria;
        }
        $query = new ChildObjSubprojectVersionQuery();
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
     * @return ChildObjSubprojectVersion|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ObjSubprojectVersionTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ObjSubprojectVersionTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildObjSubprojectVersion A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, status, is_public, is_available, project_id, version_created_by, version, version_created_at, version_comment, project_id_version, obj_group_ids, obj_group_versions FROM obj_subproject_version WHERE id = :p0 AND version = :p1';
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
            /** @var ChildObjSubprojectVersion $obj */
            $obj = new ChildObjSubprojectVersion();
            $obj->hydrate($row);
            ObjSubprojectVersionTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildObjSubprojectVersion|array|mixed the result, formatted by the current formatter
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
        $this->addUsingAlias(ObjSubprojectVersionTableMap::COL_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(ObjSubprojectVersionTableMap::COL_VERSION, $key[1], Criteria::EQUAL);

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
            $cton0 = $this->getNewCriterion(ObjSubprojectVersionTableMap::COL_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(ObjSubprojectVersionTableMap::COL_VERSION, $key[1], Criteria::EQUAL);
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
     * @see       filterByObjSubproject()
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
                $this->addUsingAlias(ObjSubprojectVersionTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ObjSubprojectVersionTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ObjSubprojectVersionTableMap::COL_ID, $id, $comparison);

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

        $this->addUsingAlias(ObjSubprojectVersionTableMap::COL_NAME, $name, $comparison);

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

        $this->addUsingAlias(ObjSubprojectVersionTableMap::COL_STATUS, $status, $comparison);

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

        $this->addUsingAlias(ObjSubprojectVersionTableMap::COL_IS_PUBLIC, $isPublic, $comparison);

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

        $this->addUsingAlias(ObjSubprojectVersionTableMap::COL_IS_AVAILABLE, $isAvailable, $comparison);

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
                $this->addUsingAlias(ObjSubprojectVersionTableMap::COL_PROJECT_ID, $projectId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($projectId['max'])) {
                $this->addUsingAlias(ObjSubprojectVersionTableMap::COL_PROJECT_ID, $projectId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ObjSubprojectVersionTableMap::COL_PROJECT_ID, $projectId, $comparison);

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
                $this->addUsingAlias(ObjSubprojectVersionTableMap::COL_VERSION_CREATED_BY, $versionCreatedBy['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($versionCreatedBy['max'])) {
                $this->addUsingAlias(ObjSubprojectVersionTableMap::COL_VERSION_CREATED_BY, $versionCreatedBy['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ObjSubprojectVersionTableMap::COL_VERSION_CREATED_BY, $versionCreatedBy, $comparison);

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
                $this->addUsingAlias(ObjSubprojectVersionTableMap::COL_VERSION, $version['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($version['max'])) {
                $this->addUsingAlias(ObjSubprojectVersionTableMap::COL_VERSION, $version['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ObjSubprojectVersionTableMap::COL_VERSION, $version, $comparison);

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
                $this->addUsingAlias(ObjSubprojectVersionTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($versionCreatedAt['max'])) {
                $this->addUsingAlias(ObjSubprojectVersionTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ObjSubprojectVersionTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt, $comparison);

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

        $this->addUsingAlias(ObjSubprojectVersionTableMap::COL_VERSION_COMMENT, $versionComment, $comparison);

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
                $this->addUsingAlias(ObjSubprojectVersionTableMap::COL_PROJECT_ID_VERSION, $projectIdVersion['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($projectIdVersion['max'])) {
                $this->addUsingAlias(ObjSubprojectVersionTableMap::COL_PROJECT_ID_VERSION, $projectIdVersion['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ObjSubprojectVersionTableMap::COL_PROJECT_ID_VERSION, $projectIdVersion, $comparison);

        return $this;
    }

    /**
     * Filter the query on the obj_group_ids column
     *
     * @param array $objGroupIds The values to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByObjGroupIds($objGroupIds = null, ?string $comparison = null)
    {
        $key = $this->getAliasedColName(ObjSubprojectVersionTableMap::COL_OBJ_GROUP_IDS);
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            foreach ($objGroupIds as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addAnd($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_SOME) {
            foreach ($objGroupIds as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addOr($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            foreach ($objGroupIds as $value) {
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

        $this->addUsingAlias(ObjSubprojectVersionTableMap::COL_OBJ_GROUP_IDS, $objGroupIds, $comparison);

        return $this;
    }

    /**
     * Filter the query on the obj_group_ids column
     * @param mixed $objGroupIds The value to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::CONTAINS_ALL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByObjGroupId($objGroupIds = null, ?string $comparison = null)
    {
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            if (is_scalar($objGroupIds)) {
                $objGroupIds = '%| ' . $objGroupIds . ' |%';
                $comparison = Criteria::LIKE;
            }
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            $objGroupIds = '%| ' . $objGroupIds . ' |%';
            $comparison = Criteria::NOT_LIKE;
            $key = $this->getAliasedColName(ObjSubprojectVersionTableMap::COL_OBJ_GROUP_IDS);
            if ($this->containsKey($key)) {
                $this->addAnd($key, $objGroupIds, $comparison);
            } else {
                $this->addAnd($key, $objGroupIds, $comparison);
            }
            $this->addOr($key, null, Criteria::ISNULL);

            return $this;
        }

        $this->addUsingAlias(ObjSubprojectVersionTableMap::COL_OBJ_GROUP_IDS, $objGroupIds, $comparison);

        return $this;
    }

    /**
     * Filter the query on the obj_group_versions column
     *
     * @param array $objGroupVersions The values to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByObjGroupVersions($objGroupVersions = null, ?string $comparison = null)
    {
        $key = $this->getAliasedColName(ObjSubprojectVersionTableMap::COL_OBJ_GROUP_VERSIONS);
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            foreach ($objGroupVersions as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addAnd($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_SOME) {
            foreach ($objGroupVersions as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addOr($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            foreach ($objGroupVersions as $value) {
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

        $this->addUsingAlias(ObjSubprojectVersionTableMap::COL_OBJ_GROUP_VERSIONS, $objGroupVersions, $comparison);

        return $this;
    }

    /**
     * Filter the query on the obj_group_versions column
     * @param mixed $objGroupVersions The value to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::CONTAINS_ALL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByObjGroupVersion($objGroupVersions = null, ?string $comparison = null)
    {
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            if (is_scalar($objGroupVersions)) {
                $objGroupVersions = '%| ' . $objGroupVersions . ' |%';
                $comparison = Criteria::LIKE;
            }
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            $objGroupVersions = '%| ' . $objGroupVersions . ' |%';
            $comparison = Criteria::NOT_LIKE;
            $key = $this->getAliasedColName(ObjSubprojectVersionTableMap::COL_OBJ_GROUP_VERSIONS);
            if ($this->containsKey($key)) {
                $this->addAnd($key, $objGroupVersions, $comparison);
            } else {
                $this->addAnd($key, $objGroupVersions, $comparison);
            }
            $this->addOr($key, null, Criteria::ISNULL);

            return $this;
        }

        $this->addUsingAlias(ObjSubprojectVersionTableMap::COL_OBJ_GROUP_VERSIONS, $objGroupVersions, $comparison);

        return $this;
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
                ->addUsingAlias(ObjSubprojectVersionTableMap::COL_ID, $objSubproject->getId(), $comparison);
        } elseif ($objSubproject instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(ObjSubprojectVersionTableMap::COL_ID, $objSubproject->toKeyValue('PrimaryKey', 'Id'), $comparison);

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
     * Exclude object from result
     *
     * @param ChildObjSubprojectVersion $objSubprojectVersion Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($objSubprojectVersion = null)
    {
        if ($objSubprojectVersion) {
            $this->addCond('pruneCond0', $this->getAliasedColName(ObjSubprojectVersionTableMap::COL_ID), $objSubprojectVersion->getId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(ObjSubprojectVersionTableMap::COL_VERSION), $objSubprojectVersion->getVersion(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the obj_subproject_version table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ObjSubprojectVersionTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ObjSubprojectVersionTableMap::clearInstancePool();
            ObjSubprojectVersionTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ObjSubprojectVersionTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ObjSubprojectVersionTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ObjSubprojectVersionTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ObjSubprojectVersionTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
