<?php

namespace DB\Base;

use \Exception;
use \PDO;
use DB\ObjGroupVersion as ChildObjGroupVersion;
use DB\ObjGroupVersionQuery as ChildObjGroupVersionQuery;
use DB\Map\ObjGroupVersionTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'obj_group_version' table.
 *
 *
 *
 * @method     ChildObjGroupVersionQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildObjGroupVersionQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildObjGroupVersionQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildObjGroupVersionQuery orderByIsPublic($order = Criteria::ASC) Order by the is_public column
 * @method     ChildObjGroupVersionQuery orderByIsAvailable($order = Criteria::ASC) Order by the is_available column
 * @method     ChildObjGroupVersionQuery orderBySubprojectId($order = Criteria::ASC) Order by the subproject_id column
 * @method     ChildObjGroupVersionQuery orderByVersion($order = Criteria::ASC) Order by the version column
 * @method     ChildObjGroupVersionQuery orderByVersionCreatedAt($order = Criteria::ASC) Order by the version_created_at column
 * @method     ChildObjGroupVersionQuery orderByVersionCreatedBy($order = Criteria::ASC) Order by the version_created_by column
 * @method     ChildObjGroupVersionQuery orderByVersionComment($order = Criteria::ASC) Order by the version_comment column
 * @method     ChildObjGroupVersionQuery orderBySubprojectIdVersion($order = Criteria::ASC) Order by the subproject_id_version column
 * @method     ChildObjGroupVersionQuery orderByObjHouseIds($order = Criteria::ASC) Order by the obj_house_ids column
 * @method     ChildObjGroupVersionQuery orderByObjHouseVersions($order = Criteria::ASC) Order by the obj_house_versions column
 *
 * @method     ChildObjGroupVersionQuery groupById() Group by the id column
 * @method     ChildObjGroupVersionQuery groupByName() Group by the name column
 * @method     ChildObjGroupVersionQuery groupByStatus() Group by the status column
 * @method     ChildObjGroupVersionQuery groupByIsPublic() Group by the is_public column
 * @method     ChildObjGroupVersionQuery groupByIsAvailable() Group by the is_available column
 * @method     ChildObjGroupVersionQuery groupBySubprojectId() Group by the subproject_id column
 * @method     ChildObjGroupVersionQuery groupByVersion() Group by the version column
 * @method     ChildObjGroupVersionQuery groupByVersionCreatedAt() Group by the version_created_at column
 * @method     ChildObjGroupVersionQuery groupByVersionCreatedBy() Group by the version_created_by column
 * @method     ChildObjGroupVersionQuery groupByVersionComment() Group by the version_comment column
 * @method     ChildObjGroupVersionQuery groupBySubprojectIdVersion() Group by the subproject_id_version column
 * @method     ChildObjGroupVersionQuery groupByObjHouseIds() Group by the obj_house_ids column
 * @method     ChildObjGroupVersionQuery groupByObjHouseVersions() Group by the obj_house_versions column
 *
 * @method     ChildObjGroupVersionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildObjGroupVersionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildObjGroupVersionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildObjGroupVersionQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildObjGroupVersionQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildObjGroupVersionQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildObjGroupVersionQuery leftJoinObjGroup($relationAlias = null) Adds a LEFT JOIN clause to the query using the ObjGroup relation
 * @method     ChildObjGroupVersionQuery rightJoinObjGroup($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ObjGroup relation
 * @method     ChildObjGroupVersionQuery innerJoinObjGroup($relationAlias = null) Adds a INNER JOIN clause to the query using the ObjGroup relation
 *
 * @method     ChildObjGroupVersionQuery joinWithObjGroup($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ObjGroup relation
 *
 * @method     ChildObjGroupVersionQuery leftJoinWithObjGroup() Adds a LEFT JOIN clause and with to the query using the ObjGroup relation
 * @method     ChildObjGroupVersionQuery rightJoinWithObjGroup() Adds a RIGHT JOIN clause and with to the query using the ObjGroup relation
 * @method     ChildObjGroupVersionQuery innerJoinWithObjGroup() Adds a INNER JOIN clause and with to the query using the ObjGroup relation
 *
 * @method     \DB\ObjGroupQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildObjGroupVersion|null findOne(?ConnectionInterface $con = null) Return the first ChildObjGroupVersion matching the query
 * @method     ChildObjGroupVersion findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildObjGroupVersion matching the query, or a new ChildObjGroupVersion object populated from the query conditions when no match is found
 *
 * @method     ChildObjGroupVersion|null findOneById(int $id) Return the first ChildObjGroupVersion filtered by the id column
 * @method     ChildObjGroupVersion|null findOneByName(string $name) Return the first ChildObjGroupVersion filtered by the name column
 * @method     ChildObjGroupVersion|null findOneByStatus(string $status) Return the first ChildObjGroupVersion filtered by the status column
 * @method     ChildObjGroupVersion|null findOneByIsPublic(boolean $is_public) Return the first ChildObjGroupVersion filtered by the is_public column
 * @method     ChildObjGroupVersion|null findOneByIsAvailable(boolean $is_available) Return the first ChildObjGroupVersion filtered by the is_available column
 * @method     ChildObjGroupVersion|null findOneBySubprojectId(int $subproject_id) Return the first ChildObjGroupVersion filtered by the subproject_id column
 * @method     ChildObjGroupVersion|null findOneByVersion(int $version) Return the first ChildObjGroupVersion filtered by the version column
 * @method     ChildObjGroupVersion|null findOneByVersionCreatedAt(string $version_created_at) Return the first ChildObjGroupVersion filtered by the version_created_at column
 * @method     ChildObjGroupVersion|null findOneByVersionCreatedBy(string $version_created_by) Return the first ChildObjGroupVersion filtered by the version_created_by column
 * @method     ChildObjGroupVersion|null findOneByVersionComment(string $version_comment) Return the first ChildObjGroupVersion filtered by the version_comment column
 * @method     ChildObjGroupVersion|null findOneBySubprojectIdVersion(int $subproject_id_version) Return the first ChildObjGroupVersion filtered by the subproject_id_version column
 * @method     ChildObjGroupVersion|null findOneByObjHouseIds(array $obj_house_ids) Return the first ChildObjGroupVersion filtered by the obj_house_ids column
 * @method     ChildObjGroupVersion|null findOneByObjHouseVersions(array $obj_house_versions) Return the first ChildObjGroupVersion filtered by the obj_house_versions column *

 * @method     ChildObjGroupVersion requirePk($key, ?ConnectionInterface $con = null) Return the ChildObjGroupVersion by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjGroupVersion requireOne(?ConnectionInterface $con = null) Return the first ChildObjGroupVersion matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildObjGroupVersion requireOneById(int $id) Return the first ChildObjGroupVersion filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjGroupVersion requireOneByName(string $name) Return the first ChildObjGroupVersion filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjGroupVersion requireOneByStatus(string $status) Return the first ChildObjGroupVersion filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjGroupVersion requireOneByIsPublic(boolean $is_public) Return the first ChildObjGroupVersion filtered by the is_public column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjGroupVersion requireOneByIsAvailable(boolean $is_available) Return the first ChildObjGroupVersion filtered by the is_available column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjGroupVersion requireOneBySubprojectId(int $subproject_id) Return the first ChildObjGroupVersion filtered by the subproject_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjGroupVersion requireOneByVersion(int $version) Return the first ChildObjGroupVersion filtered by the version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjGroupVersion requireOneByVersionCreatedAt(string $version_created_at) Return the first ChildObjGroupVersion filtered by the version_created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjGroupVersion requireOneByVersionCreatedBy(string $version_created_by) Return the first ChildObjGroupVersion filtered by the version_created_by column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjGroupVersion requireOneByVersionComment(string $version_comment) Return the first ChildObjGroupVersion filtered by the version_comment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjGroupVersion requireOneBySubprojectIdVersion(int $subproject_id_version) Return the first ChildObjGroupVersion filtered by the subproject_id_version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjGroupVersion requireOneByObjHouseIds(array $obj_house_ids) Return the first ChildObjGroupVersion filtered by the obj_house_ids column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjGroupVersion requireOneByObjHouseVersions(array $obj_house_versions) Return the first ChildObjGroupVersion filtered by the obj_house_versions column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildObjGroupVersion[]|Collection find(?ConnectionInterface $con = null) Return ChildObjGroupVersion objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildObjGroupVersion> find(?ConnectionInterface $con = null) Return ChildObjGroupVersion objects based on current ModelCriteria
 * @method     ChildObjGroupVersion[]|Collection findById(int $id) Return ChildObjGroupVersion objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildObjGroupVersion> findById(int $id) Return ChildObjGroupVersion objects filtered by the id column
 * @method     ChildObjGroupVersion[]|Collection findByName(string $name) Return ChildObjGroupVersion objects filtered by the name column
 * @psalm-method Collection&\Traversable<ChildObjGroupVersion> findByName(string $name) Return ChildObjGroupVersion objects filtered by the name column
 * @method     ChildObjGroupVersion[]|Collection findByStatus(string $status) Return ChildObjGroupVersion objects filtered by the status column
 * @psalm-method Collection&\Traversable<ChildObjGroupVersion> findByStatus(string $status) Return ChildObjGroupVersion objects filtered by the status column
 * @method     ChildObjGroupVersion[]|Collection findByIsPublic(boolean $is_public) Return ChildObjGroupVersion objects filtered by the is_public column
 * @psalm-method Collection&\Traversable<ChildObjGroupVersion> findByIsPublic(boolean $is_public) Return ChildObjGroupVersion objects filtered by the is_public column
 * @method     ChildObjGroupVersion[]|Collection findByIsAvailable(boolean $is_available) Return ChildObjGroupVersion objects filtered by the is_available column
 * @psalm-method Collection&\Traversable<ChildObjGroupVersion> findByIsAvailable(boolean $is_available) Return ChildObjGroupVersion objects filtered by the is_available column
 * @method     ChildObjGroupVersion[]|Collection findBySubprojectId(int $subproject_id) Return ChildObjGroupVersion objects filtered by the subproject_id column
 * @psalm-method Collection&\Traversable<ChildObjGroupVersion> findBySubprojectId(int $subproject_id) Return ChildObjGroupVersion objects filtered by the subproject_id column
 * @method     ChildObjGroupVersion[]|Collection findByVersion(int $version) Return ChildObjGroupVersion objects filtered by the version column
 * @psalm-method Collection&\Traversable<ChildObjGroupVersion> findByVersion(int $version) Return ChildObjGroupVersion objects filtered by the version column
 * @method     ChildObjGroupVersion[]|Collection findByVersionCreatedAt(string $version_created_at) Return ChildObjGroupVersion objects filtered by the version_created_at column
 * @psalm-method Collection&\Traversable<ChildObjGroupVersion> findByVersionCreatedAt(string $version_created_at) Return ChildObjGroupVersion objects filtered by the version_created_at column
 * @method     ChildObjGroupVersion[]|Collection findByVersionCreatedBy(string $version_created_by) Return ChildObjGroupVersion objects filtered by the version_created_by column
 * @psalm-method Collection&\Traversable<ChildObjGroupVersion> findByVersionCreatedBy(string $version_created_by) Return ChildObjGroupVersion objects filtered by the version_created_by column
 * @method     ChildObjGroupVersion[]|Collection findByVersionComment(string $version_comment) Return ChildObjGroupVersion objects filtered by the version_comment column
 * @psalm-method Collection&\Traversable<ChildObjGroupVersion> findByVersionComment(string $version_comment) Return ChildObjGroupVersion objects filtered by the version_comment column
 * @method     ChildObjGroupVersion[]|Collection findBySubprojectIdVersion(int $subproject_id_version) Return ChildObjGroupVersion objects filtered by the subproject_id_version column
 * @psalm-method Collection&\Traversable<ChildObjGroupVersion> findBySubprojectIdVersion(int $subproject_id_version) Return ChildObjGroupVersion objects filtered by the subproject_id_version column
 * @method     ChildObjGroupVersion[]|Collection findByObjHouseIds(array $obj_house_ids) Return ChildObjGroupVersion objects filtered by the obj_house_ids column
 * @psalm-method Collection&\Traversable<ChildObjGroupVersion> findByObjHouseIds(array $obj_house_ids) Return ChildObjGroupVersion objects filtered by the obj_house_ids column
 * @method     ChildObjGroupVersion[]|Collection findByObjHouseVersions(array $obj_house_versions) Return ChildObjGroupVersion objects filtered by the obj_house_versions column
 * @psalm-method Collection&\Traversable<ChildObjGroupVersion> findByObjHouseVersions(array $obj_house_versions) Return ChildObjGroupVersion objects filtered by the obj_house_versions column
 * @method     ChildObjGroupVersion[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildObjGroupVersion> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ObjGroupVersionQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \DB\Base\ObjGroupVersionQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\DB\\ObjGroupVersion', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildObjGroupVersionQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildObjGroupVersionQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildObjGroupVersionQuery) {
            return $criteria;
        }
        $query = new ChildObjGroupVersionQuery();
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
     * @return ChildObjGroupVersion|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ObjGroupVersionTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ObjGroupVersionTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildObjGroupVersion A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, status, is_public, is_available, subproject_id, version, version_created_at, version_created_by, version_comment, subproject_id_version, obj_house_ids, obj_house_versions FROM obj_group_version WHERE id = :p0 AND version = :p1';
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
            /** @var ChildObjGroupVersion $obj */
            $obj = new ChildObjGroupVersion();
            $obj->hydrate($row);
            ObjGroupVersionTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildObjGroupVersion|array|mixed the result, formatted by the current formatter
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
        $this->addUsingAlias(ObjGroupVersionTableMap::COL_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(ObjGroupVersionTableMap::COL_VERSION, $key[1], Criteria::EQUAL);

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
            $cton0 = $this->getNewCriterion(ObjGroupVersionTableMap::COL_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(ObjGroupVersionTableMap::COL_VERSION, $key[1], Criteria::EQUAL);
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
     * @see       filterByObjGroup()
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
                $this->addUsingAlias(ObjGroupVersionTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ObjGroupVersionTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ObjGroupVersionTableMap::COL_ID, $id, $comparison);

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

        $this->addUsingAlias(ObjGroupVersionTableMap::COL_NAME, $name, $comparison);

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

        $this->addUsingAlias(ObjGroupVersionTableMap::COL_STATUS, $status, $comparison);

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

        $this->addUsingAlias(ObjGroupVersionTableMap::COL_IS_PUBLIC, $isPublic, $comparison);

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

        $this->addUsingAlias(ObjGroupVersionTableMap::COL_IS_AVAILABLE, $isAvailable, $comparison);

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
                $this->addUsingAlias(ObjGroupVersionTableMap::COL_SUBPROJECT_ID, $subprojectId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($subprojectId['max'])) {
                $this->addUsingAlias(ObjGroupVersionTableMap::COL_SUBPROJECT_ID, $subprojectId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ObjGroupVersionTableMap::COL_SUBPROJECT_ID, $subprojectId, $comparison);

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
                $this->addUsingAlias(ObjGroupVersionTableMap::COL_VERSION, $version['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($version['max'])) {
                $this->addUsingAlias(ObjGroupVersionTableMap::COL_VERSION, $version['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ObjGroupVersionTableMap::COL_VERSION, $version, $comparison);

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
                $this->addUsingAlias(ObjGroupVersionTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($versionCreatedAt['max'])) {
                $this->addUsingAlias(ObjGroupVersionTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ObjGroupVersionTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt, $comparison);

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

        $this->addUsingAlias(ObjGroupVersionTableMap::COL_VERSION_CREATED_BY, $versionCreatedBy, $comparison);

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

        $this->addUsingAlias(ObjGroupVersionTableMap::COL_VERSION_COMMENT, $versionComment, $comparison);

        return $this;
    }

    /**
     * Filter the query on the subproject_id_version column
     *
     * Example usage:
     * <code>
     * $query->filterBySubprojectIdVersion(1234); // WHERE subproject_id_version = 1234
     * $query->filterBySubprojectIdVersion(array(12, 34)); // WHERE subproject_id_version IN (12, 34)
     * $query->filterBySubprojectIdVersion(array('min' => 12)); // WHERE subproject_id_version > 12
     * </code>
     *
     * @param mixed $subprojectIdVersion The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySubprojectIdVersion($subprojectIdVersion = null, ?string $comparison = null)
    {
        if (is_array($subprojectIdVersion)) {
            $useMinMax = false;
            if (isset($subprojectIdVersion['min'])) {
                $this->addUsingAlias(ObjGroupVersionTableMap::COL_SUBPROJECT_ID_VERSION, $subprojectIdVersion['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($subprojectIdVersion['max'])) {
                $this->addUsingAlias(ObjGroupVersionTableMap::COL_SUBPROJECT_ID_VERSION, $subprojectIdVersion['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ObjGroupVersionTableMap::COL_SUBPROJECT_ID_VERSION, $subprojectIdVersion, $comparison);

        return $this;
    }

    /**
     * Filter the query on the obj_house_ids column
     *
     * @param array $objHouseIds The values to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByObjHouseIds($objHouseIds = null, ?string $comparison = null)
    {
        $key = $this->getAliasedColName(ObjGroupVersionTableMap::COL_OBJ_HOUSE_IDS);
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            foreach ($objHouseIds as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addAnd($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_SOME) {
            foreach ($objHouseIds as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addOr($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            foreach ($objHouseIds as $value) {
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

        $this->addUsingAlias(ObjGroupVersionTableMap::COL_OBJ_HOUSE_IDS, $objHouseIds, $comparison);

        return $this;
    }

    /**
     * Filter the query on the obj_house_ids column
     * @param mixed $objHouseIds The value to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::CONTAINS_ALL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByObjHouseId($objHouseIds = null, ?string $comparison = null)
    {
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            if (is_scalar($objHouseIds)) {
                $objHouseIds = '%| ' . $objHouseIds . ' |%';
                $comparison = Criteria::LIKE;
            }
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            $objHouseIds = '%| ' . $objHouseIds . ' |%';
            $comparison = Criteria::NOT_LIKE;
            $key = $this->getAliasedColName(ObjGroupVersionTableMap::COL_OBJ_HOUSE_IDS);
            if ($this->containsKey($key)) {
                $this->addAnd($key, $objHouseIds, $comparison);
            } else {
                $this->addAnd($key, $objHouseIds, $comparison);
            }
            $this->addOr($key, null, Criteria::ISNULL);

            return $this;
        }

        $this->addUsingAlias(ObjGroupVersionTableMap::COL_OBJ_HOUSE_IDS, $objHouseIds, $comparison);

        return $this;
    }

    /**
     * Filter the query on the obj_house_versions column
     *
     * @param array $objHouseVersions The values to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByObjHouseVersions($objHouseVersions = null, ?string $comparison = null)
    {
        $key = $this->getAliasedColName(ObjGroupVersionTableMap::COL_OBJ_HOUSE_VERSIONS);
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            foreach ($objHouseVersions as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addAnd($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_SOME) {
            foreach ($objHouseVersions as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addOr($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            foreach ($objHouseVersions as $value) {
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

        $this->addUsingAlias(ObjGroupVersionTableMap::COL_OBJ_HOUSE_VERSIONS, $objHouseVersions, $comparison);

        return $this;
    }

    /**
     * Filter the query on the obj_house_versions column
     * @param mixed $objHouseVersions The value to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::CONTAINS_ALL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByObjHouseVersion($objHouseVersions = null, ?string $comparison = null)
    {
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            if (is_scalar($objHouseVersions)) {
                $objHouseVersions = '%| ' . $objHouseVersions . ' |%';
                $comparison = Criteria::LIKE;
            }
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            $objHouseVersions = '%| ' . $objHouseVersions . ' |%';
            $comparison = Criteria::NOT_LIKE;
            $key = $this->getAliasedColName(ObjGroupVersionTableMap::COL_OBJ_HOUSE_VERSIONS);
            if ($this->containsKey($key)) {
                $this->addAnd($key, $objHouseVersions, $comparison);
            } else {
                $this->addAnd($key, $objHouseVersions, $comparison);
            }
            $this->addOr($key, null, Criteria::ISNULL);

            return $this;
        }

        $this->addUsingAlias(ObjGroupVersionTableMap::COL_OBJ_HOUSE_VERSIONS, $objHouseVersions, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \DB\ObjGroup object
     *
     * @param \DB\ObjGroup|ObjectCollection $objGroup The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByObjGroup($objGroup, ?string $comparison = null)
    {
        if ($objGroup instanceof \DB\ObjGroup) {
            return $this
                ->addUsingAlias(ObjGroupVersionTableMap::COL_ID, $objGroup->getId(), $comparison);
        } elseif ($objGroup instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(ObjGroupVersionTableMap::COL_ID, $objGroup->toKeyValue('PrimaryKey', 'Id'), $comparison);

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
     * Exclude object from result
     *
     * @param ChildObjGroupVersion $objGroupVersion Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($objGroupVersion = null)
    {
        if ($objGroupVersion) {
            $this->addCond('pruneCond0', $this->getAliasedColName(ObjGroupVersionTableMap::COL_ID), $objGroupVersion->getId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(ObjGroupVersionTableMap::COL_VERSION), $objGroupVersion->getVersion(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the obj_group_version table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ObjGroupVersionTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ObjGroupVersionTableMap::clearInstancePool();
            ObjGroupVersionTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ObjGroupVersionTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ObjGroupVersionTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ObjGroupVersionTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ObjGroupVersionTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
