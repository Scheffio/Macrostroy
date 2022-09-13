<?php

namespace DB\Base;

use \Exception;
use \PDO;
use DB\ObjHouseVersion as ChildObjHouseVersion;
use DB\ObjHouseVersionQuery as ChildObjHouseVersionQuery;
use DB\Map\ObjHouseVersionTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'obj_house_version' table.
 *
 *
 *
 * @method     ChildObjHouseVersionQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildObjHouseVersionQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildObjHouseVersionQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildObjHouseVersionQuery orderByIsPublic($order = Criteria::ASC) Order by the is_public column
 * @method     ChildObjHouseVersionQuery orderByIsAvailable($order = Criteria::ASC) Order by the is_available column
 * @method     ChildObjHouseVersionQuery orderByGroupId($order = Criteria::ASC) Order by the group_id column
 * @method     ChildObjHouseVersionQuery orderByVersionCreatedBy($order = Criteria::ASC) Order by the version_created_by column
 * @method     ChildObjHouseVersionQuery orderByVersion($order = Criteria::ASC) Order by the version column
 * @method     ChildObjHouseVersionQuery orderByVersionCreatedAt($order = Criteria::ASC) Order by the version_created_at column
 * @method     ChildObjHouseVersionQuery orderByVersionComment($order = Criteria::ASC) Order by the version_comment column
 * @method     ChildObjHouseVersionQuery orderByGroupIdVersion($order = Criteria::ASC) Order by the group_id_version column
 * @method     ChildObjHouseVersionQuery orderByObjStageIds($order = Criteria::ASC) Order by the obj_stage_ids column
 * @method     ChildObjHouseVersionQuery orderByObjStageVersions($order = Criteria::ASC) Order by the obj_stage_versions column
 *
 * @method     ChildObjHouseVersionQuery groupById() Group by the id column
 * @method     ChildObjHouseVersionQuery groupByName() Group by the name column
 * @method     ChildObjHouseVersionQuery groupByStatus() Group by the status column
 * @method     ChildObjHouseVersionQuery groupByIsPublic() Group by the is_public column
 * @method     ChildObjHouseVersionQuery groupByIsAvailable() Group by the is_available column
 * @method     ChildObjHouseVersionQuery groupByGroupId() Group by the group_id column
 * @method     ChildObjHouseVersionQuery groupByVersionCreatedBy() Group by the version_created_by column
 * @method     ChildObjHouseVersionQuery groupByVersion() Group by the version column
 * @method     ChildObjHouseVersionQuery groupByVersionCreatedAt() Group by the version_created_at column
 * @method     ChildObjHouseVersionQuery groupByVersionComment() Group by the version_comment column
 * @method     ChildObjHouseVersionQuery groupByGroupIdVersion() Group by the group_id_version column
 * @method     ChildObjHouseVersionQuery groupByObjStageIds() Group by the obj_stage_ids column
 * @method     ChildObjHouseVersionQuery groupByObjStageVersions() Group by the obj_stage_versions column
 *
 * @method     ChildObjHouseVersionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildObjHouseVersionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildObjHouseVersionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildObjHouseVersionQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildObjHouseVersionQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildObjHouseVersionQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildObjHouseVersionQuery leftJoinObjHouse($relationAlias = null) Adds a LEFT JOIN clause to the query using the ObjHouse relation
 * @method     ChildObjHouseVersionQuery rightJoinObjHouse($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ObjHouse relation
 * @method     ChildObjHouseVersionQuery innerJoinObjHouse($relationAlias = null) Adds a INNER JOIN clause to the query using the ObjHouse relation
 *
 * @method     ChildObjHouseVersionQuery joinWithObjHouse($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ObjHouse relation
 *
 * @method     ChildObjHouseVersionQuery leftJoinWithObjHouse() Adds a LEFT JOIN clause and with to the query using the ObjHouse relation
 * @method     ChildObjHouseVersionQuery rightJoinWithObjHouse() Adds a RIGHT JOIN clause and with to the query using the ObjHouse relation
 * @method     ChildObjHouseVersionQuery innerJoinWithObjHouse() Adds a INNER JOIN clause and with to the query using the ObjHouse relation
 *
 * @method     \DB\ObjHouseQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildObjHouseVersion|null findOne(?ConnectionInterface $con = null) Return the first ChildObjHouseVersion matching the query
 * @method     ChildObjHouseVersion findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildObjHouseVersion matching the query, or a new ChildObjHouseVersion object populated from the query conditions when no match is found
 *
 * @method     ChildObjHouseVersion|null findOneById(int $id) Return the first ChildObjHouseVersion filtered by the id column
 * @method     ChildObjHouseVersion|null findOneByName(string $name) Return the first ChildObjHouseVersion filtered by the name column
 * @method     ChildObjHouseVersion|null findOneByStatus(string $status) Return the first ChildObjHouseVersion filtered by the status column
 * @method     ChildObjHouseVersion|null findOneByIsPublic(boolean $is_public) Return the first ChildObjHouseVersion filtered by the is_public column
 * @method     ChildObjHouseVersion|null findOneByIsAvailable(boolean $is_available) Return the first ChildObjHouseVersion filtered by the is_available column
 * @method     ChildObjHouseVersion|null findOneByGroupId(int $group_id) Return the first ChildObjHouseVersion filtered by the group_id column
 * @method     ChildObjHouseVersion|null findOneByVersionCreatedBy(int $version_created_by) Return the first ChildObjHouseVersion filtered by the version_created_by column
 * @method     ChildObjHouseVersion|null findOneByVersion(int $version) Return the first ChildObjHouseVersion filtered by the version column
 * @method     ChildObjHouseVersion|null findOneByVersionCreatedAt(string $version_created_at) Return the first ChildObjHouseVersion filtered by the version_created_at column
 * @method     ChildObjHouseVersion|null findOneByVersionComment(string $version_comment) Return the first ChildObjHouseVersion filtered by the version_comment column
 * @method     ChildObjHouseVersion|null findOneByGroupIdVersion(int $group_id_version) Return the first ChildObjHouseVersion filtered by the group_id_version column
 * @method     ChildObjHouseVersion|null findOneByObjStageIds(array $obj_stage_ids) Return the first ChildObjHouseVersion filtered by the obj_stage_ids column
 * @method     ChildObjHouseVersion|null findOneByObjStageVersions(array $obj_stage_versions) Return the first ChildObjHouseVersion filtered by the obj_stage_versions column *

 * @method     ChildObjHouseVersion requirePk($key, ?ConnectionInterface $con = null) Return the ChildObjHouseVersion by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjHouseVersion requireOne(?ConnectionInterface $con = null) Return the first ChildObjHouseVersion matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildObjHouseVersion requireOneById(int $id) Return the first ChildObjHouseVersion filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjHouseVersion requireOneByName(string $name) Return the first ChildObjHouseVersion filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjHouseVersion requireOneByStatus(string $status) Return the first ChildObjHouseVersion filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjHouseVersion requireOneByIsPublic(boolean $is_public) Return the first ChildObjHouseVersion filtered by the is_public column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjHouseVersion requireOneByIsAvailable(boolean $is_available) Return the first ChildObjHouseVersion filtered by the is_available column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjHouseVersion requireOneByGroupId(int $group_id) Return the first ChildObjHouseVersion filtered by the group_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjHouseVersion requireOneByVersionCreatedBy(int $version_created_by) Return the first ChildObjHouseVersion filtered by the version_created_by column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjHouseVersion requireOneByVersion(int $version) Return the first ChildObjHouseVersion filtered by the version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjHouseVersion requireOneByVersionCreatedAt(string $version_created_at) Return the first ChildObjHouseVersion filtered by the version_created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjHouseVersion requireOneByVersionComment(string $version_comment) Return the first ChildObjHouseVersion filtered by the version_comment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjHouseVersion requireOneByGroupIdVersion(int $group_id_version) Return the first ChildObjHouseVersion filtered by the group_id_version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjHouseVersion requireOneByObjStageIds(array $obj_stage_ids) Return the first ChildObjHouseVersion filtered by the obj_stage_ids column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjHouseVersion requireOneByObjStageVersions(array $obj_stage_versions) Return the first ChildObjHouseVersion filtered by the obj_stage_versions column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildObjHouseVersion[]|Collection find(?ConnectionInterface $con = null) Return ChildObjHouseVersion objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildObjHouseVersion> find(?ConnectionInterface $con = null) Return ChildObjHouseVersion objects based on current ModelCriteria
 * @method     ChildObjHouseVersion[]|Collection findById(int $id) Return ChildObjHouseVersion objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildObjHouseVersion> findById(int $id) Return ChildObjHouseVersion objects filtered by the id column
 * @method     ChildObjHouseVersion[]|Collection findByName(string $name) Return ChildObjHouseVersion objects filtered by the name column
 * @psalm-method Collection&\Traversable<ChildObjHouseVersion> findByName(string $name) Return ChildObjHouseVersion objects filtered by the name column
 * @method     ChildObjHouseVersion[]|Collection findByStatus(string $status) Return ChildObjHouseVersion objects filtered by the status column
 * @psalm-method Collection&\Traversable<ChildObjHouseVersion> findByStatus(string $status) Return ChildObjHouseVersion objects filtered by the status column
 * @method     ChildObjHouseVersion[]|Collection findByIsPublic(boolean $is_public) Return ChildObjHouseVersion objects filtered by the is_public column
 * @psalm-method Collection&\Traversable<ChildObjHouseVersion> findByIsPublic(boolean $is_public) Return ChildObjHouseVersion objects filtered by the is_public column
 * @method     ChildObjHouseVersion[]|Collection findByIsAvailable(boolean $is_available) Return ChildObjHouseVersion objects filtered by the is_available column
 * @psalm-method Collection&\Traversable<ChildObjHouseVersion> findByIsAvailable(boolean $is_available) Return ChildObjHouseVersion objects filtered by the is_available column
 * @method     ChildObjHouseVersion[]|Collection findByGroupId(int $group_id) Return ChildObjHouseVersion objects filtered by the group_id column
 * @psalm-method Collection&\Traversable<ChildObjHouseVersion> findByGroupId(int $group_id) Return ChildObjHouseVersion objects filtered by the group_id column
 * @method     ChildObjHouseVersion[]|Collection findByVersionCreatedBy(int $version_created_by) Return ChildObjHouseVersion objects filtered by the version_created_by column
 * @psalm-method Collection&\Traversable<ChildObjHouseVersion> findByVersionCreatedBy(int $version_created_by) Return ChildObjHouseVersion objects filtered by the version_created_by column
 * @method     ChildObjHouseVersion[]|Collection findByVersion(int $version) Return ChildObjHouseVersion objects filtered by the version column
 * @psalm-method Collection&\Traversable<ChildObjHouseVersion> findByVersion(int $version) Return ChildObjHouseVersion objects filtered by the version column
 * @method     ChildObjHouseVersion[]|Collection findByVersionCreatedAt(string $version_created_at) Return ChildObjHouseVersion objects filtered by the version_created_at column
 * @psalm-method Collection&\Traversable<ChildObjHouseVersion> findByVersionCreatedAt(string $version_created_at) Return ChildObjHouseVersion objects filtered by the version_created_at column
 * @method     ChildObjHouseVersion[]|Collection findByVersionComment(string $version_comment) Return ChildObjHouseVersion objects filtered by the version_comment column
 * @psalm-method Collection&\Traversable<ChildObjHouseVersion> findByVersionComment(string $version_comment) Return ChildObjHouseVersion objects filtered by the version_comment column
 * @method     ChildObjHouseVersion[]|Collection findByGroupIdVersion(int $group_id_version) Return ChildObjHouseVersion objects filtered by the group_id_version column
 * @psalm-method Collection&\Traversable<ChildObjHouseVersion> findByGroupIdVersion(int $group_id_version) Return ChildObjHouseVersion objects filtered by the group_id_version column
 * @method     ChildObjHouseVersion[]|Collection findByObjStageIds(array $obj_stage_ids) Return ChildObjHouseVersion objects filtered by the obj_stage_ids column
 * @psalm-method Collection&\Traversable<ChildObjHouseVersion> findByObjStageIds(array $obj_stage_ids) Return ChildObjHouseVersion objects filtered by the obj_stage_ids column
 * @method     ChildObjHouseVersion[]|Collection findByObjStageVersions(array $obj_stage_versions) Return ChildObjHouseVersion objects filtered by the obj_stage_versions column
 * @psalm-method Collection&\Traversable<ChildObjHouseVersion> findByObjStageVersions(array $obj_stage_versions) Return ChildObjHouseVersion objects filtered by the obj_stage_versions column
 * @method     ChildObjHouseVersion[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildObjHouseVersion> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ObjHouseVersionQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \DB\Base\ObjHouseVersionQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\DB\\ObjHouseVersion', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildObjHouseVersionQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildObjHouseVersionQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildObjHouseVersionQuery) {
            return $criteria;
        }
        $query = new ChildObjHouseVersionQuery();
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
     * @return ChildObjHouseVersion|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ObjHouseVersionTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ObjHouseVersionTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildObjHouseVersion A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, status, is_public, is_available, group_id, version_created_by, version, version_created_at, version_comment, group_id_version, obj_stage_ids, obj_stage_versions FROM obj_house_version WHERE id = :p0 AND version = :p1';
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
            /** @var ChildObjHouseVersion $obj */
            $obj = new ChildObjHouseVersion();
            $obj->hydrate($row);
            ObjHouseVersionTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildObjHouseVersion|array|mixed the result, formatted by the current formatter
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
        $this->addUsingAlias(ObjHouseVersionTableMap::COL_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(ObjHouseVersionTableMap::COL_VERSION, $key[1], Criteria::EQUAL);

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
            $cton0 = $this->getNewCriterion(ObjHouseVersionTableMap::COL_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(ObjHouseVersionTableMap::COL_VERSION, $key[1], Criteria::EQUAL);
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
     * @see       filterByObjHouse()
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
                $this->addUsingAlias(ObjHouseVersionTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ObjHouseVersionTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ObjHouseVersionTableMap::COL_ID, $id, $comparison);

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

        $this->addUsingAlias(ObjHouseVersionTableMap::COL_NAME, $name, $comparison);

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

        $this->addUsingAlias(ObjHouseVersionTableMap::COL_STATUS, $status, $comparison);

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

        $this->addUsingAlias(ObjHouseVersionTableMap::COL_IS_PUBLIC, $isPublic, $comparison);

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

        $this->addUsingAlias(ObjHouseVersionTableMap::COL_IS_AVAILABLE, $isAvailable, $comparison);

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
                $this->addUsingAlias(ObjHouseVersionTableMap::COL_GROUP_ID, $groupId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($groupId['max'])) {
                $this->addUsingAlias(ObjHouseVersionTableMap::COL_GROUP_ID, $groupId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ObjHouseVersionTableMap::COL_GROUP_ID, $groupId, $comparison);

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
                $this->addUsingAlias(ObjHouseVersionTableMap::COL_VERSION_CREATED_BY, $versionCreatedBy['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($versionCreatedBy['max'])) {
                $this->addUsingAlias(ObjHouseVersionTableMap::COL_VERSION_CREATED_BY, $versionCreatedBy['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ObjHouseVersionTableMap::COL_VERSION_CREATED_BY, $versionCreatedBy, $comparison);

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
                $this->addUsingAlias(ObjHouseVersionTableMap::COL_VERSION, $version['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($version['max'])) {
                $this->addUsingAlias(ObjHouseVersionTableMap::COL_VERSION, $version['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ObjHouseVersionTableMap::COL_VERSION, $version, $comparison);

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
                $this->addUsingAlias(ObjHouseVersionTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($versionCreatedAt['max'])) {
                $this->addUsingAlias(ObjHouseVersionTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ObjHouseVersionTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt, $comparison);

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

        $this->addUsingAlias(ObjHouseVersionTableMap::COL_VERSION_COMMENT, $versionComment, $comparison);

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
                $this->addUsingAlias(ObjHouseVersionTableMap::COL_GROUP_ID_VERSION, $groupIdVersion['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($groupIdVersion['max'])) {
                $this->addUsingAlias(ObjHouseVersionTableMap::COL_GROUP_ID_VERSION, $groupIdVersion['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ObjHouseVersionTableMap::COL_GROUP_ID_VERSION, $groupIdVersion, $comparison);

        return $this;
    }

    /**
     * Filter the query on the obj_stage_ids column
     *
     * @param array $objStageIds The values to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByObjStageIds($objStageIds = null, ?string $comparison = null)
    {
        $key = $this->getAliasedColName(ObjHouseVersionTableMap::COL_OBJ_STAGE_IDS);
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            foreach ($objStageIds as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addAnd($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_SOME) {
            foreach ($objStageIds as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addOr($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            foreach ($objStageIds as $value) {
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

        $this->addUsingAlias(ObjHouseVersionTableMap::COL_OBJ_STAGE_IDS, $objStageIds, $comparison);

        return $this;
    }

    /**
     * Filter the query on the obj_stage_ids column
     * @param mixed $objStageIds The value to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::CONTAINS_ALL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByObjStageId($objStageIds = null, ?string $comparison = null)
    {
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            if (is_scalar($objStageIds)) {
                $objStageIds = '%| ' . $objStageIds . ' |%';
                $comparison = Criteria::LIKE;
            }
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            $objStageIds = '%| ' . $objStageIds . ' |%';
            $comparison = Criteria::NOT_LIKE;
            $key = $this->getAliasedColName(ObjHouseVersionTableMap::COL_OBJ_STAGE_IDS);
            if ($this->containsKey($key)) {
                $this->addAnd($key, $objStageIds, $comparison);
            } else {
                $this->addAnd($key, $objStageIds, $comparison);
            }
            $this->addOr($key, null, Criteria::ISNULL);

            return $this;
        }

        $this->addUsingAlias(ObjHouseVersionTableMap::COL_OBJ_STAGE_IDS, $objStageIds, $comparison);

        return $this;
    }

    /**
     * Filter the query on the obj_stage_versions column
     *
     * @param array $objStageVersions The values to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByObjStageVersions($objStageVersions = null, ?string $comparison = null)
    {
        $key = $this->getAliasedColName(ObjHouseVersionTableMap::COL_OBJ_STAGE_VERSIONS);
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            foreach ($objStageVersions as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addAnd($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_SOME) {
            foreach ($objStageVersions as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addOr($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            foreach ($objStageVersions as $value) {
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

        $this->addUsingAlias(ObjHouseVersionTableMap::COL_OBJ_STAGE_VERSIONS, $objStageVersions, $comparison);

        return $this;
    }

    /**
     * Filter the query on the obj_stage_versions column
     * @param mixed $objStageVersions The value to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::CONTAINS_ALL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByObjStageVersion($objStageVersions = null, ?string $comparison = null)
    {
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            if (is_scalar($objStageVersions)) {
                $objStageVersions = '%| ' . $objStageVersions . ' |%';
                $comparison = Criteria::LIKE;
            }
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            $objStageVersions = '%| ' . $objStageVersions . ' |%';
            $comparison = Criteria::NOT_LIKE;
            $key = $this->getAliasedColName(ObjHouseVersionTableMap::COL_OBJ_STAGE_VERSIONS);
            if ($this->containsKey($key)) {
                $this->addAnd($key, $objStageVersions, $comparison);
            } else {
                $this->addAnd($key, $objStageVersions, $comparison);
            }
            $this->addOr($key, null, Criteria::ISNULL);

            return $this;
        }

        $this->addUsingAlias(ObjHouseVersionTableMap::COL_OBJ_STAGE_VERSIONS, $objStageVersions, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \DB\ObjHouse object
     *
     * @param \DB\ObjHouse|ObjectCollection $objHouse The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByObjHouse($objHouse, ?string $comparison = null)
    {
        if ($objHouse instanceof \DB\ObjHouse) {
            return $this
                ->addUsingAlias(ObjHouseVersionTableMap::COL_ID, $objHouse->getId(), $comparison);
        } elseif ($objHouse instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(ObjHouseVersionTableMap::COL_ID, $objHouse->toKeyValue('PrimaryKey', 'Id'), $comparison);

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
     * Exclude object from result
     *
     * @param ChildObjHouseVersion $objHouseVersion Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($objHouseVersion = null)
    {
        if ($objHouseVersion) {
            $this->addCond('pruneCond0', $this->getAliasedColName(ObjHouseVersionTableMap::COL_ID), $objHouseVersion->getId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(ObjHouseVersionTableMap::COL_VERSION), $objHouseVersion->getVersion(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the obj_house_version table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ObjHouseVersionTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ObjHouseVersionTableMap::clearInstancePool();
            ObjHouseVersionTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ObjHouseVersionTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ObjHouseVersionTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ObjHouseVersionTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ObjHouseVersionTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
