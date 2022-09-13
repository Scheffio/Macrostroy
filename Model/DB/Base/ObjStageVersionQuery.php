<?php

namespace DB\Base;

use \Exception;
use \PDO;
use DB\ObjStageVersion as ChildObjStageVersion;
use DB\ObjStageVersionQuery as ChildObjStageVersionQuery;
use DB\Map\ObjStageVersionTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'obj_stage_version' table.
 *
 *
 *
 * @method     ChildObjStageVersionQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildObjStageVersionQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildObjStageVersionQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildObjStageVersionQuery orderByIsPublic($order = Criteria::ASC) Order by the is_public column
 * @method     ChildObjStageVersionQuery orderByIsAvailable($order = Criteria::ASC) Order by the is_available column
 * @method     ChildObjStageVersionQuery orderByHouseId($order = Criteria::ASC) Order by the house_id column
 * @method     ChildObjStageVersionQuery orderByVersionCreatedBy($order = Criteria::ASC) Order by the version_created_by column
 * @method     ChildObjStageVersionQuery orderByVersion($order = Criteria::ASC) Order by the version column
 * @method     ChildObjStageVersionQuery orderByVersionCreatedAt($order = Criteria::ASC) Order by the version_created_at column
 * @method     ChildObjStageVersionQuery orderByVersionComment($order = Criteria::ASC) Order by the version_comment column
 * @method     ChildObjStageVersionQuery orderByHouseIdVersion($order = Criteria::ASC) Order by the house_id_version column
 * @method     ChildObjStageVersionQuery orderByObjStageWorkIds($order = Criteria::ASC) Order by the obj_stage_work_ids column
 * @method     ChildObjStageVersionQuery orderByObjStageWorkVersions($order = Criteria::ASC) Order by the obj_stage_work_versions column
 *
 * @method     ChildObjStageVersionQuery groupById() Group by the id column
 * @method     ChildObjStageVersionQuery groupByName() Group by the name column
 * @method     ChildObjStageVersionQuery groupByStatus() Group by the status column
 * @method     ChildObjStageVersionQuery groupByIsPublic() Group by the is_public column
 * @method     ChildObjStageVersionQuery groupByIsAvailable() Group by the is_available column
 * @method     ChildObjStageVersionQuery groupByHouseId() Group by the house_id column
 * @method     ChildObjStageVersionQuery groupByVersionCreatedBy() Group by the version_created_by column
 * @method     ChildObjStageVersionQuery groupByVersion() Group by the version column
 * @method     ChildObjStageVersionQuery groupByVersionCreatedAt() Group by the version_created_at column
 * @method     ChildObjStageVersionQuery groupByVersionComment() Group by the version_comment column
 * @method     ChildObjStageVersionQuery groupByHouseIdVersion() Group by the house_id_version column
 * @method     ChildObjStageVersionQuery groupByObjStageWorkIds() Group by the obj_stage_work_ids column
 * @method     ChildObjStageVersionQuery groupByObjStageWorkVersions() Group by the obj_stage_work_versions column
 *
 * @method     ChildObjStageVersionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildObjStageVersionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildObjStageVersionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildObjStageVersionQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildObjStageVersionQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildObjStageVersionQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildObjStageVersionQuery leftJoinObjStage($relationAlias = null) Adds a LEFT JOIN clause to the query using the ObjStage relation
 * @method     ChildObjStageVersionQuery rightJoinObjStage($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ObjStage relation
 * @method     ChildObjStageVersionQuery innerJoinObjStage($relationAlias = null) Adds a INNER JOIN clause to the query using the ObjStage relation
 *
 * @method     ChildObjStageVersionQuery joinWithObjStage($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ObjStage relation
 *
 * @method     ChildObjStageVersionQuery leftJoinWithObjStage() Adds a LEFT JOIN clause and with to the query using the ObjStage relation
 * @method     ChildObjStageVersionQuery rightJoinWithObjStage() Adds a RIGHT JOIN clause and with to the query using the ObjStage relation
 * @method     ChildObjStageVersionQuery innerJoinWithObjStage() Adds a INNER JOIN clause and with to the query using the ObjStage relation
 *
 * @method     \DB\ObjStageQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildObjStageVersion|null findOne(?ConnectionInterface $con = null) Return the first ChildObjStageVersion matching the query
 * @method     ChildObjStageVersion findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildObjStageVersion matching the query, or a new ChildObjStageVersion object populated from the query conditions when no match is found
 *
 * @method     ChildObjStageVersion|null findOneById(int $id) Return the first ChildObjStageVersion filtered by the id column
 * @method     ChildObjStageVersion|null findOneByName(string $name) Return the first ChildObjStageVersion filtered by the name column
 * @method     ChildObjStageVersion|null findOneByStatus(string $status) Return the first ChildObjStageVersion filtered by the status column
 * @method     ChildObjStageVersion|null findOneByIsPublic(boolean $is_public) Return the first ChildObjStageVersion filtered by the is_public column
 * @method     ChildObjStageVersion|null findOneByIsAvailable(boolean $is_available) Return the first ChildObjStageVersion filtered by the is_available column
 * @method     ChildObjStageVersion|null findOneByHouseId(int $house_id) Return the first ChildObjStageVersion filtered by the house_id column
 * @method     ChildObjStageVersion|null findOneByVersionCreatedBy(int $version_created_by) Return the first ChildObjStageVersion filtered by the version_created_by column
 * @method     ChildObjStageVersion|null findOneByVersion(int $version) Return the first ChildObjStageVersion filtered by the version column
 * @method     ChildObjStageVersion|null findOneByVersionCreatedAt(string $version_created_at) Return the first ChildObjStageVersion filtered by the version_created_at column
 * @method     ChildObjStageVersion|null findOneByVersionComment(string $version_comment) Return the first ChildObjStageVersion filtered by the version_comment column
 * @method     ChildObjStageVersion|null findOneByHouseIdVersion(int $house_id_version) Return the first ChildObjStageVersion filtered by the house_id_version column
 * @method     ChildObjStageVersion|null findOneByObjStageWorkIds(array $obj_stage_work_ids) Return the first ChildObjStageVersion filtered by the obj_stage_work_ids column
 * @method     ChildObjStageVersion|null findOneByObjStageWorkVersions(array $obj_stage_work_versions) Return the first ChildObjStageVersion filtered by the obj_stage_work_versions column *

 * @method     ChildObjStageVersion requirePk($key, ?ConnectionInterface $con = null) Return the ChildObjStageVersion by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjStageVersion requireOne(?ConnectionInterface $con = null) Return the first ChildObjStageVersion matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildObjStageVersion requireOneById(int $id) Return the first ChildObjStageVersion filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjStageVersion requireOneByName(string $name) Return the first ChildObjStageVersion filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjStageVersion requireOneByStatus(string $status) Return the first ChildObjStageVersion filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjStageVersion requireOneByIsPublic(boolean $is_public) Return the first ChildObjStageVersion filtered by the is_public column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjStageVersion requireOneByIsAvailable(boolean $is_available) Return the first ChildObjStageVersion filtered by the is_available column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjStageVersion requireOneByHouseId(int $house_id) Return the first ChildObjStageVersion filtered by the house_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjStageVersion requireOneByVersionCreatedBy(int $version_created_by) Return the first ChildObjStageVersion filtered by the version_created_by column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjStageVersion requireOneByVersion(int $version) Return the first ChildObjStageVersion filtered by the version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjStageVersion requireOneByVersionCreatedAt(string $version_created_at) Return the first ChildObjStageVersion filtered by the version_created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjStageVersion requireOneByVersionComment(string $version_comment) Return the first ChildObjStageVersion filtered by the version_comment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjStageVersion requireOneByHouseIdVersion(int $house_id_version) Return the first ChildObjStageVersion filtered by the house_id_version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjStageVersion requireOneByObjStageWorkIds(array $obj_stage_work_ids) Return the first ChildObjStageVersion filtered by the obj_stage_work_ids column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjStageVersion requireOneByObjStageWorkVersions(array $obj_stage_work_versions) Return the first ChildObjStageVersion filtered by the obj_stage_work_versions column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildObjStageVersion[]|Collection find(?ConnectionInterface $con = null) Return ChildObjStageVersion objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildObjStageVersion> find(?ConnectionInterface $con = null) Return ChildObjStageVersion objects based on current ModelCriteria
 * @method     ChildObjStageVersion[]|Collection findById(int $id) Return ChildObjStageVersion objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildObjStageVersion> findById(int $id) Return ChildObjStageVersion objects filtered by the id column
 * @method     ChildObjStageVersion[]|Collection findByName(string $name) Return ChildObjStageVersion objects filtered by the name column
 * @psalm-method Collection&\Traversable<ChildObjStageVersion> findByName(string $name) Return ChildObjStageVersion objects filtered by the name column
 * @method     ChildObjStageVersion[]|Collection findByStatus(string $status) Return ChildObjStageVersion objects filtered by the status column
 * @psalm-method Collection&\Traversable<ChildObjStageVersion> findByStatus(string $status) Return ChildObjStageVersion objects filtered by the status column
 * @method     ChildObjStageVersion[]|Collection findByIsPublic(boolean $is_public) Return ChildObjStageVersion objects filtered by the is_public column
 * @psalm-method Collection&\Traversable<ChildObjStageVersion> findByIsPublic(boolean $is_public) Return ChildObjStageVersion objects filtered by the is_public column
 * @method     ChildObjStageVersion[]|Collection findByIsAvailable(boolean $is_available) Return ChildObjStageVersion objects filtered by the is_available column
 * @psalm-method Collection&\Traversable<ChildObjStageVersion> findByIsAvailable(boolean $is_available) Return ChildObjStageVersion objects filtered by the is_available column
 * @method     ChildObjStageVersion[]|Collection findByHouseId(int $house_id) Return ChildObjStageVersion objects filtered by the house_id column
 * @psalm-method Collection&\Traversable<ChildObjStageVersion> findByHouseId(int $house_id) Return ChildObjStageVersion objects filtered by the house_id column
 * @method     ChildObjStageVersion[]|Collection findByVersionCreatedBy(int $version_created_by) Return ChildObjStageVersion objects filtered by the version_created_by column
 * @psalm-method Collection&\Traversable<ChildObjStageVersion> findByVersionCreatedBy(int $version_created_by) Return ChildObjStageVersion objects filtered by the version_created_by column
 * @method     ChildObjStageVersion[]|Collection findByVersion(int $version) Return ChildObjStageVersion objects filtered by the version column
 * @psalm-method Collection&\Traversable<ChildObjStageVersion> findByVersion(int $version) Return ChildObjStageVersion objects filtered by the version column
 * @method     ChildObjStageVersion[]|Collection findByVersionCreatedAt(string $version_created_at) Return ChildObjStageVersion objects filtered by the version_created_at column
 * @psalm-method Collection&\Traversable<ChildObjStageVersion> findByVersionCreatedAt(string $version_created_at) Return ChildObjStageVersion objects filtered by the version_created_at column
 * @method     ChildObjStageVersion[]|Collection findByVersionComment(string $version_comment) Return ChildObjStageVersion objects filtered by the version_comment column
 * @psalm-method Collection&\Traversable<ChildObjStageVersion> findByVersionComment(string $version_comment) Return ChildObjStageVersion objects filtered by the version_comment column
 * @method     ChildObjStageVersion[]|Collection findByHouseIdVersion(int $house_id_version) Return ChildObjStageVersion objects filtered by the house_id_version column
 * @psalm-method Collection&\Traversable<ChildObjStageVersion> findByHouseIdVersion(int $house_id_version) Return ChildObjStageVersion objects filtered by the house_id_version column
 * @method     ChildObjStageVersion[]|Collection findByObjStageWorkIds(array $obj_stage_work_ids) Return ChildObjStageVersion objects filtered by the obj_stage_work_ids column
 * @psalm-method Collection&\Traversable<ChildObjStageVersion> findByObjStageWorkIds(array $obj_stage_work_ids) Return ChildObjStageVersion objects filtered by the obj_stage_work_ids column
 * @method     ChildObjStageVersion[]|Collection findByObjStageWorkVersions(array $obj_stage_work_versions) Return ChildObjStageVersion objects filtered by the obj_stage_work_versions column
 * @psalm-method Collection&\Traversable<ChildObjStageVersion> findByObjStageWorkVersions(array $obj_stage_work_versions) Return ChildObjStageVersion objects filtered by the obj_stage_work_versions column
 * @method     ChildObjStageVersion[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildObjStageVersion> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ObjStageVersionQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \DB\Base\ObjStageVersionQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\DB\\ObjStageVersion', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildObjStageVersionQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildObjStageVersionQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildObjStageVersionQuery) {
            return $criteria;
        }
        $query = new ChildObjStageVersionQuery();
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
     * @return ChildObjStageVersion|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ObjStageVersionTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ObjStageVersionTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildObjStageVersion A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, status, is_public, is_available, house_id, version_created_by, version, version_created_at, version_comment, house_id_version, obj_stage_work_ids, obj_stage_work_versions FROM obj_stage_version WHERE id = :p0 AND version = :p1';
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
            /** @var ChildObjStageVersion $obj */
            $obj = new ChildObjStageVersion();
            $obj->hydrate($row);
            ObjStageVersionTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildObjStageVersion|array|mixed the result, formatted by the current formatter
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
        $this->addUsingAlias(ObjStageVersionTableMap::COL_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(ObjStageVersionTableMap::COL_VERSION, $key[1], Criteria::EQUAL);

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
            $cton0 = $this->getNewCriterion(ObjStageVersionTableMap::COL_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(ObjStageVersionTableMap::COL_VERSION, $key[1], Criteria::EQUAL);
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
     * @see       filterByObjStage()
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
                $this->addUsingAlias(ObjStageVersionTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ObjStageVersionTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ObjStageVersionTableMap::COL_ID, $id, $comparison);

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

        $this->addUsingAlias(ObjStageVersionTableMap::COL_NAME, $name, $comparison);

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

        $this->addUsingAlias(ObjStageVersionTableMap::COL_STATUS, $status, $comparison);

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

        $this->addUsingAlias(ObjStageVersionTableMap::COL_IS_PUBLIC, $isPublic, $comparison);

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

        $this->addUsingAlias(ObjStageVersionTableMap::COL_IS_AVAILABLE, $isAvailable, $comparison);

        return $this;
    }

    /**
     * Filter the query on the house_id column
     *
     * Example usage:
     * <code>
     * $query->filterByHouseId(1234); // WHERE house_id = 1234
     * $query->filterByHouseId(array(12, 34)); // WHERE house_id IN (12, 34)
     * $query->filterByHouseId(array('min' => 12)); // WHERE house_id > 12
     * </code>
     *
     * @param mixed $houseId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByHouseId($houseId = null, ?string $comparison = null)
    {
        if (is_array($houseId)) {
            $useMinMax = false;
            if (isset($houseId['min'])) {
                $this->addUsingAlias(ObjStageVersionTableMap::COL_HOUSE_ID, $houseId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($houseId['max'])) {
                $this->addUsingAlias(ObjStageVersionTableMap::COL_HOUSE_ID, $houseId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ObjStageVersionTableMap::COL_HOUSE_ID, $houseId, $comparison);

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
                $this->addUsingAlias(ObjStageVersionTableMap::COL_VERSION_CREATED_BY, $versionCreatedBy['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($versionCreatedBy['max'])) {
                $this->addUsingAlias(ObjStageVersionTableMap::COL_VERSION_CREATED_BY, $versionCreatedBy['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ObjStageVersionTableMap::COL_VERSION_CREATED_BY, $versionCreatedBy, $comparison);

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
                $this->addUsingAlias(ObjStageVersionTableMap::COL_VERSION, $version['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($version['max'])) {
                $this->addUsingAlias(ObjStageVersionTableMap::COL_VERSION, $version['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ObjStageVersionTableMap::COL_VERSION, $version, $comparison);

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
                $this->addUsingAlias(ObjStageVersionTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($versionCreatedAt['max'])) {
                $this->addUsingAlias(ObjStageVersionTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ObjStageVersionTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt, $comparison);

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

        $this->addUsingAlias(ObjStageVersionTableMap::COL_VERSION_COMMENT, $versionComment, $comparison);

        return $this;
    }

    /**
     * Filter the query on the house_id_version column
     *
     * Example usage:
     * <code>
     * $query->filterByHouseIdVersion(1234); // WHERE house_id_version = 1234
     * $query->filterByHouseIdVersion(array(12, 34)); // WHERE house_id_version IN (12, 34)
     * $query->filterByHouseIdVersion(array('min' => 12)); // WHERE house_id_version > 12
     * </code>
     *
     * @param mixed $houseIdVersion The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByHouseIdVersion($houseIdVersion = null, ?string $comparison = null)
    {
        if (is_array($houseIdVersion)) {
            $useMinMax = false;
            if (isset($houseIdVersion['min'])) {
                $this->addUsingAlias(ObjStageVersionTableMap::COL_HOUSE_ID_VERSION, $houseIdVersion['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($houseIdVersion['max'])) {
                $this->addUsingAlias(ObjStageVersionTableMap::COL_HOUSE_ID_VERSION, $houseIdVersion['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ObjStageVersionTableMap::COL_HOUSE_ID_VERSION, $houseIdVersion, $comparison);

        return $this;
    }

    /**
     * Filter the query on the obj_stage_work_ids column
     *
     * @param array $objStageWorkIds The values to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByObjStageWorkIds($objStageWorkIds = null, ?string $comparison = null)
    {
        $key = $this->getAliasedColName(ObjStageVersionTableMap::COL_OBJ_STAGE_WORK_IDS);
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            foreach ($objStageWorkIds as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addAnd($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_SOME) {
            foreach ($objStageWorkIds as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addOr($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            foreach ($objStageWorkIds as $value) {
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

        $this->addUsingAlias(ObjStageVersionTableMap::COL_OBJ_STAGE_WORK_IDS, $objStageWorkIds, $comparison);

        return $this;
    }

    /**
     * Filter the query on the obj_stage_work_ids column
     * @param mixed $objStageWorkIds The value to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::CONTAINS_ALL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByObjStageWorkId($objStageWorkIds = null, ?string $comparison = null)
    {
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            if (is_scalar($objStageWorkIds)) {
                $objStageWorkIds = '%| ' . $objStageWorkIds . ' |%';
                $comparison = Criteria::LIKE;
            }
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            $objStageWorkIds = '%| ' . $objStageWorkIds . ' |%';
            $comparison = Criteria::NOT_LIKE;
            $key = $this->getAliasedColName(ObjStageVersionTableMap::COL_OBJ_STAGE_WORK_IDS);
            if ($this->containsKey($key)) {
                $this->addAnd($key, $objStageWorkIds, $comparison);
            } else {
                $this->addAnd($key, $objStageWorkIds, $comparison);
            }
            $this->addOr($key, null, Criteria::ISNULL);

            return $this;
        }

        $this->addUsingAlias(ObjStageVersionTableMap::COL_OBJ_STAGE_WORK_IDS, $objStageWorkIds, $comparison);

        return $this;
    }

    /**
     * Filter the query on the obj_stage_work_versions column
     *
     * @param array $objStageWorkVersions The values to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByObjStageWorkVersions($objStageWorkVersions = null, ?string $comparison = null)
    {
        $key = $this->getAliasedColName(ObjStageVersionTableMap::COL_OBJ_STAGE_WORK_VERSIONS);
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            foreach ($objStageWorkVersions as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addAnd($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_SOME) {
            foreach ($objStageWorkVersions as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addOr($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            foreach ($objStageWorkVersions as $value) {
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

        $this->addUsingAlias(ObjStageVersionTableMap::COL_OBJ_STAGE_WORK_VERSIONS, $objStageWorkVersions, $comparison);

        return $this;
    }

    /**
     * Filter the query on the obj_stage_work_versions column
     * @param mixed $objStageWorkVersions The value to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::CONTAINS_ALL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByObjStageWorkVersion($objStageWorkVersions = null, ?string $comparison = null)
    {
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            if (is_scalar($objStageWorkVersions)) {
                $objStageWorkVersions = '%| ' . $objStageWorkVersions . ' |%';
                $comparison = Criteria::LIKE;
            }
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            $objStageWorkVersions = '%| ' . $objStageWorkVersions . ' |%';
            $comparison = Criteria::NOT_LIKE;
            $key = $this->getAliasedColName(ObjStageVersionTableMap::COL_OBJ_STAGE_WORK_VERSIONS);
            if ($this->containsKey($key)) {
                $this->addAnd($key, $objStageWorkVersions, $comparison);
            } else {
                $this->addAnd($key, $objStageWorkVersions, $comparison);
            }
            $this->addOr($key, null, Criteria::ISNULL);

            return $this;
        }

        $this->addUsingAlias(ObjStageVersionTableMap::COL_OBJ_STAGE_WORK_VERSIONS, $objStageWorkVersions, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \DB\ObjStage object
     *
     * @param \DB\ObjStage|ObjectCollection $objStage The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByObjStage($objStage, ?string $comparison = null)
    {
        if ($objStage instanceof \DB\ObjStage) {
            return $this
                ->addUsingAlias(ObjStageVersionTableMap::COL_ID, $objStage->getId(), $comparison);
        } elseif ($objStage instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(ObjStageVersionTableMap::COL_ID, $objStage->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByObjStage() only accepts arguments of type \DB\ObjStage or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ObjStage relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinObjStage(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ObjStage');

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
            $this->addJoinObject($join, 'ObjStage');
        }

        return $this;
    }

    /**
     * Use the ObjStage relation ObjStage object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\ObjStageQuery A secondary query class using the current class as primary query
     */
    public function useObjStageQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinObjStage($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ObjStage', '\DB\ObjStageQuery');
    }

    /**
     * Use the ObjStage relation ObjStage object
     *
     * @param callable(\DB\ObjStageQuery):\DB\ObjStageQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withObjStageQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useObjStageQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to ObjStage table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\ObjStageQuery The inner query object of the EXISTS statement
     */
    public function useObjStageExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('ObjStage', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to ObjStage table for a NOT EXISTS query.
     *
     * @see useObjStageExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\ObjStageQuery The inner query object of the NOT EXISTS statement
     */
    public function useObjStageNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('ObjStage', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Exclude object from result
     *
     * @param ChildObjStageVersion $objStageVersion Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($objStageVersion = null)
    {
        if ($objStageVersion) {
            $this->addCond('pruneCond0', $this->getAliasedColName(ObjStageVersionTableMap::COL_ID), $objStageVersion->getId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(ObjStageVersionTableMap::COL_VERSION), $objStageVersion->getVersion(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the obj_stage_version table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ObjStageVersionTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ObjStageVersionTableMap::clearInstancePool();
            ObjStageVersionTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ObjStageVersionTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ObjStageVersionTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ObjStageVersionTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ObjStageVersionTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
