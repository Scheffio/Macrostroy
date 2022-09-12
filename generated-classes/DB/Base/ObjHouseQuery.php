<?php

namespace DB\Base;

use \Exception;
use \PDO;
use DB\ObjHouse as ChildObjHouse;
use DB\ObjHouseQuery as ChildObjHouseQuery;
use DB\Map\ObjHouseTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'obj_house' table.
 *
 *
 *
 * @method     ChildObjHouseQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildObjHouseQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildObjHouseQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildObjHouseQuery orderByIsPublic($order = Criteria::ASC) Order by the is_public column
 * @method     ChildObjHouseQuery orderByIsAvailable($order = Criteria::ASC) Order by the is_available column
 * @method     ChildObjHouseQuery orderByGroupId($order = Criteria::ASC) Order by the group_id column
 * @method     ChildObjHouseQuery orderByVersion($order = Criteria::ASC) Order by the version column
 * @method     ChildObjHouseQuery orderByVersionCreatedAt($order = Criteria::ASC) Order by the version_created_at column
 * @method     ChildObjHouseQuery orderByVersionCreatedBy($order = Criteria::ASC) Order by the version_created_by column
 * @method     ChildObjHouseQuery orderByVersionComment($order = Criteria::ASC) Order by the version_comment column
 *
 * @method     ChildObjHouseQuery groupById() Group by the id column
 * @method     ChildObjHouseQuery groupByName() Group by the name column
 * @method     ChildObjHouseQuery groupByStatus() Group by the status column
 * @method     ChildObjHouseQuery groupByIsPublic() Group by the is_public column
 * @method     ChildObjHouseQuery groupByIsAvailable() Group by the is_available column
 * @method     ChildObjHouseQuery groupByGroupId() Group by the group_id column
 * @method     ChildObjHouseQuery groupByVersion() Group by the version column
 * @method     ChildObjHouseQuery groupByVersionCreatedAt() Group by the version_created_at column
 * @method     ChildObjHouseQuery groupByVersionCreatedBy() Group by the version_created_by column
 * @method     ChildObjHouseQuery groupByVersionComment() Group by the version_comment column
 *
 * @method     ChildObjHouseQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildObjHouseQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildObjHouseQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildObjHouseQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildObjHouseQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildObjHouseQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildObjHouseQuery leftJoinObjGroup($relationAlias = null) Adds a LEFT JOIN clause to the query using the ObjGroup relation
 * @method     ChildObjHouseQuery rightJoinObjGroup($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ObjGroup relation
 * @method     ChildObjHouseQuery innerJoinObjGroup($relationAlias = null) Adds a INNER JOIN clause to the query using the ObjGroup relation
 *
 * @method     ChildObjHouseQuery joinWithObjGroup($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ObjGroup relation
 *
 * @method     ChildObjHouseQuery leftJoinWithObjGroup() Adds a LEFT JOIN clause and with to the query using the ObjGroup relation
 * @method     ChildObjHouseQuery rightJoinWithObjGroup() Adds a RIGHT JOIN clause and with to the query using the ObjGroup relation
 * @method     ChildObjHouseQuery innerJoinWithObjGroup() Adds a INNER JOIN clause and with to the query using the ObjGroup relation
 *
 * @method     ChildObjHouseQuery leftJoinObjStage($relationAlias = null) Adds a LEFT JOIN clause to the query using the ObjStage relation
 * @method     ChildObjHouseQuery rightJoinObjStage($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ObjStage relation
 * @method     ChildObjHouseQuery innerJoinObjStage($relationAlias = null) Adds a INNER JOIN clause to the query using the ObjStage relation
 *
 * @method     ChildObjHouseQuery joinWithObjStage($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ObjStage relation
 *
 * @method     ChildObjHouseQuery leftJoinWithObjStage() Adds a LEFT JOIN clause and with to the query using the ObjStage relation
 * @method     ChildObjHouseQuery rightJoinWithObjStage() Adds a RIGHT JOIN clause and with to the query using the ObjStage relation
 * @method     ChildObjHouseQuery innerJoinWithObjStage() Adds a INNER JOIN clause and with to the query using the ObjStage relation
 *
 * @method     ChildObjHouseQuery leftJoinObjHouseVersion($relationAlias = null) Adds a LEFT JOIN clause to the query using the ObjHouseVersion relation
 * @method     ChildObjHouseQuery rightJoinObjHouseVersion($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ObjHouseVersion relation
 * @method     ChildObjHouseQuery innerJoinObjHouseVersion($relationAlias = null) Adds a INNER JOIN clause to the query using the ObjHouseVersion relation
 *
 * @method     ChildObjHouseQuery joinWithObjHouseVersion($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ObjHouseVersion relation
 *
 * @method     ChildObjHouseQuery leftJoinWithObjHouseVersion() Adds a LEFT JOIN clause and with to the query using the ObjHouseVersion relation
 * @method     ChildObjHouseQuery rightJoinWithObjHouseVersion() Adds a RIGHT JOIN clause and with to the query using the ObjHouseVersion relation
 * @method     ChildObjHouseQuery innerJoinWithObjHouseVersion() Adds a INNER JOIN clause and with to the query using the ObjHouseVersion relation
 *
 * @method     \DB\ObjGroupQuery|\DB\ObjStageQuery|\DB\ObjHouseVersionQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildObjHouse|null findOne(?ConnectionInterface $con = null) Return the first ChildObjHouse matching the query
 * @method     ChildObjHouse findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildObjHouse matching the query, or a new ChildObjHouse object populated from the query conditions when no match is found
 *
 * @method     ChildObjHouse|null findOneById(int $id) Return the first ChildObjHouse filtered by the id column
 * @method     ChildObjHouse|null findOneByName(string $name) Return the first ChildObjHouse filtered by the name column
 * @method     ChildObjHouse|null findOneByStatus(string $status) Return the first ChildObjHouse filtered by the status column
 * @method     ChildObjHouse|null findOneByIsPublic(boolean $is_public) Return the first ChildObjHouse filtered by the is_public column
 * @method     ChildObjHouse|null findOneByIsAvailable(boolean $is_available) Return the first ChildObjHouse filtered by the is_available column
 * @method     ChildObjHouse|null findOneByGroupId(int $group_id) Return the first ChildObjHouse filtered by the group_id column
 * @method     ChildObjHouse|null findOneByVersion(int $version) Return the first ChildObjHouse filtered by the version column
 * @method     ChildObjHouse|null findOneByVersionCreatedAt(string $version_created_at) Return the first ChildObjHouse filtered by the version_created_at column
 * @method     ChildObjHouse|null findOneByVersionCreatedBy(string $version_created_by) Return the first ChildObjHouse filtered by the version_created_by column
 * @method     ChildObjHouse|null findOneByVersionComment(string $version_comment) Return the first ChildObjHouse filtered by the version_comment column *

 * @method     ChildObjHouse requirePk($key, ?ConnectionInterface $con = null) Return the ChildObjHouse by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjHouse requireOne(?ConnectionInterface $con = null) Return the first ChildObjHouse matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildObjHouse requireOneById(int $id) Return the first ChildObjHouse filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjHouse requireOneByName(string $name) Return the first ChildObjHouse filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjHouse requireOneByStatus(string $status) Return the first ChildObjHouse filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjHouse requireOneByIsPublic(boolean $is_public) Return the first ChildObjHouse filtered by the is_public column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjHouse requireOneByIsAvailable(boolean $is_available) Return the first ChildObjHouse filtered by the is_available column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjHouse requireOneByGroupId(int $group_id) Return the first ChildObjHouse filtered by the group_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjHouse requireOneByVersion(int $version) Return the first ChildObjHouse filtered by the version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjHouse requireOneByVersionCreatedAt(string $version_created_at) Return the first ChildObjHouse filtered by the version_created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjHouse requireOneByVersionCreatedBy(string $version_created_by) Return the first ChildObjHouse filtered by the version_created_by column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjHouse requireOneByVersionComment(string $version_comment) Return the first ChildObjHouse filtered by the version_comment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildObjHouse[]|Collection find(?ConnectionInterface $con = null) Return ChildObjHouse objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildObjHouse> find(?ConnectionInterface $con = null) Return ChildObjHouse objects based on current ModelCriteria
 * @method     ChildObjHouse[]|Collection findById(int $id) Return ChildObjHouse objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildObjHouse> findById(int $id) Return ChildObjHouse objects filtered by the id column
 * @method     ChildObjHouse[]|Collection findByName(string $name) Return ChildObjHouse objects filtered by the name column
 * @psalm-method Collection&\Traversable<ChildObjHouse> findByName(string $name) Return ChildObjHouse objects filtered by the name column
 * @method     ChildObjHouse[]|Collection findByStatus(string $status) Return ChildObjHouse objects filtered by the status column
 * @psalm-method Collection&\Traversable<ChildObjHouse> findByStatus(string $status) Return ChildObjHouse objects filtered by the status column
 * @method     ChildObjHouse[]|Collection findByIsPublic(boolean $is_public) Return ChildObjHouse objects filtered by the is_public column
 * @psalm-method Collection&\Traversable<ChildObjHouse> findByIsPublic(boolean $is_public) Return ChildObjHouse objects filtered by the is_public column
 * @method     ChildObjHouse[]|Collection findByIsAvailable(boolean $is_available) Return ChildObjHouse objects filtered by the is_available column
 * @psalm-method Collection&\Traversable<ChildObjHouse> findByIsAvailable(boolean $is_available) Return ChildObjHouse objects filtered by the is_available column
 * @method     ChildObjHouse[]|Collection findByGroupId(int $group_id) Return ChildObjHouse objects filtered by the group_id column
 * @psalm-method Collection&\Traversable<ChildObjHouse> findByGroupId(int $group_id) Return ChildObjHouse objects filtered by the group_id column
 * @method     ChildObjHouse[]|Collection findByVersion(int $version) Return ChildObjHouse objects filtered by the version column
 * @psalm-method Collection&\Traversable<ChildObjHouse> findByVersion(int $version) Return ChildObjHouse objects filtered by the version column
 * @method     ChildObjHouse[]|Collection findByVersionCreatedAt(string $version_created_at) Return ChildObjHouse objects filtered by the version_created_at column
 * @psalm-method Collection&\Traversable<ChildObjHouse> findByVersionCreatedAt(string $version_created_at) Return ChildObjHouse objects filtered by the version_created_at column
 * @method     ChildObjHouse[]|Collection findByVersionCreatedBy(string $version_created_by) Return ChildObjHouse objects filtered by the version_created_by column
 * @psalm-method Collection&\Traversable<ChildObjHouse> findByVersionCreatedBy(string $version_created_by) Return ChildObjHouse objects filtered by the version_created_by column
 * @method     ChildObjHouse[]|Collection findByVersionComment(string $version_comment) Return ChildObjHouse objects filtered by the version_comment column
 * @psalm-method Collection&\Traversable<ChildObjHouse> findByVersionComment(string $version_comment) Return ChildObjHouse objects filtered by the version_comment column
 * @method     ChildObjHouse[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildObjHouse> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ObjHouseQuery extends ModelCriteria
{

    // versionable behavior

    /**
     * Whether the versioning is enabled
     */
    static $isVersioningEnabled = true;
protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \DB\Base\ObjHouseQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\DB\\ObjHouse', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildObjHouseQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildObjHouseQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildObjHouseQuery) {
            return $criteria;
        }
        $query = new ChildObjHouseQuery();
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
     * @return ChildObjHouse|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ObjHouseTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ObjHouseTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildObjHouse A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, status, is_public, is_available, group_id, version, version_created_at, version_created_by, version_comment FROM obj_house WHERE id = :p0';
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
            /** @var ChildObjHouse $obj */
            $obj = new ChildObjHouse();
            $obj->hydrate($row);
            ObjHouseTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildObjHouse|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(ObjHouseTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(ObjHouseTableMap::COL_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(ObjHouseTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ObjHouseTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ObjHouseTableMap::COL_ID, $id, $comparison);

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

        $this->addUsingAlias(ObjHouseTableMap::COL_NAME, $name, $comparison);

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

        $this->addUsingAlias(ObjHouseTableMap::COL_STATUS, $status, $comparison);

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

        $this->addUsingAlias(ObjHouseTableMap::COL_IS_PUBLIC, $isPublic, $comparison);

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

        $this->addUsingAlias(ObjHouseTableMap::COL_IS_AVAILABLE, $isAvailable, $comparison);

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
     * @see       filterByObjGroup()
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
                $this->addUsingAlias(ObjHouseTableMap::COL_GROUP_ID, $groupId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($groupId['max'])) {
                $this->addUsingAlias(ObjHouseTableMap::COL_GROUP_ID, $groupId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ObjHouseTableMap::COL_GROUP_ID, $groupId, $comparison);

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
                $this->addUsingAlias(ObjHouseTableMap::COL_VERSION, $version['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($version['max'])) {
                $this->addUsingAlias(ObjHouseTableMap::COL_VERSION, $version['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ObjHouseTableMap::COL_VERSION, $version, $comparison);

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
                $this->addUsingAlias(ObjHouseTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($versionCreatedAt['max'])) {
                $this->addUsingAlias(ObjHouseTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ObjHouseTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt, $comparison);

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

        $this->addUsingAlias(ObjHouseTableMap::COL_VERSION_CREATED_BY, $versionCreatedBy, $comparison);

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

        $this->addUsingAlias(ObjHouseTableMap::COL_VERSION_COMMENT, $versionComment, $comparison);

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
                ->addUsingAlias(ObjHouseTableMap::COL_GROUP_ID, $objGroup->getId(), $comparison);
        } elseif ($objGroup instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(ObjHouseTableMap::COL_GROUP_ID, $objGroup->toKeyValue('PrimaryKey', 'Id'), $comparison);

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
     * Filter the query by a related \DB\ObjStage object
     *
     * @param \DB\ObjStage|ObjectCollection $objStage the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByObjStage($objStage, ?string $comparison = null)
    {
        if ($objStage instanceof \DB\ObjStage) {
            $this
                ->addUsingAlias(ObjHouseTableMap::COL_ID, $objStage->getHouseId(), $comparison);

            return $this;
        } elseif ($objStage instanceof ObjectCollection) {
            $this
                ->useObjStageQuery()
                ->filterByPrimaryKeys($objStage->getPrimaryKeys())
                ->endUse();

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
     * Filter the query by a related \DB\ObjHouseVersion object
     *
     * @param \DB\ObjHouseVersion|ObjectCollection $objHouseVersion the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByObjHouseVersion($objHouseVersion, ?string $comparison = null)
    {
        if ($objHouseVersion instanceof \DB\ObjHouseVersion) {
            $this
                ->addUsingAlias(ObjHouseTableMap::COL_ID, $objHouseVersion->getId(), $comparison);

            return $this;
        } elseif ($objHouseVersion instanceof ObjectCollection) {
            $this
                ->useObjHouseVersionQuery()
                ->filterByPrimaryKeys($objHouseVersion->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByObjHouseVersion() only accepts arguments of type \DB\ObjHouseVersion or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ObjHouseVersion relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinObjHouseVersion(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ObjHouseVersion');

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
            $this->addJoinObject($join, 'ObjHouseVersion');
        }

        return $this;
    }

    /**
     * Use the ObjHouseVersion relation ObjHouseVersion object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\ObjHouseVersionQuery A secondary query class using the current class as primary query
     */
    public function useObjHouseVersionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinObjHouseVersion($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ObjHouseVersion', '\DB\ObjHouseVersionQuery');
    }

    /**
     * Use the ObjHouseVersion relation ObjHouseVersion object
     *
     * @param callable(\DB\ObjHouseVersionQuery):\DB\ObjHouseVersionQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withObjHouseVersionQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useObjHouseVersionQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to ObjHouseVersion table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\ObjHouseVersionQuery The inner query object of the EXISTS statement
     */
    public function useObjHouseVersionExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('ObjHouseVersion', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to ObjHouseVersion table for a NOT EXISTS query.
     *
     * @see useObjHouseVersionExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\ObjHouseVersionQuery The inner query object of the NOT EXISTS statement
     */
    public function useObjHouseVersionNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('ObjHouseVersion', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Exclude object from result
     *
     * @param ChildObjHouse $objHouse Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($objHouse = null)
    {
        if ($objHouse) {
            $this->addUsingAlias(ObjHouseTableMap::COL_ID, $objHouse->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the obj_house table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ObjHouseTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ObjHouseTableMap::clearInstancePool();
            ObjHouseTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ObjHouseTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ObjHouseTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ObjHouseTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ObjHouseTableMap::clearRelatedInstancePool();

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
