<?php

namespace DB\Base;

use \Exception;
use \PDO;
use DB\ObjStage as ChildObjStage;
use DB\ObjStageQuery as ChildObjStageQuery;
use DB\Map\ObjStageTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'obj_stage' table.
 *
 *
 *
 * @method     ChildObjStageQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildObjStageQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildObjStageQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildObjStageQuery orderByIsPublic($order = Criteria::ASC) Order by the is_public column
 * @method     ChildObjStageQuery orderByIsAvailable($order = Criteria::ASC) Order by the is_available column
 * @method     ChildObjStageQuery orderByHouseId($order = Criteria::ASC) Order by the house_id column
 * @method     ChildObjStageQuery orderByVersion($order = Criteria::ASC) Order by the version column
 * @method     ChildObjStageQuery orderByVersionCreatedAt($order = Criteria::ASC) Order by the version_created_at column
 * @method     ChildObjStageQuery orderByVersionCreatedBy($order = Criteria::ASC) Order by the version_created_by column
 * @method     ChildObjStageQuery orderByVersionComment($order = Criteria::ASC) Order by the version_comment column
 *
 * @method     ChildObjStageQuery groupById() Group by the id column
 * @method     ChildObjStageQuery groupByName() Group by the name column
 * @method     ChildObjStageQuery groupByStatus() Group by the status column
 * @method     ChildObjStageQuery groupByIsPublic() Group by the is_public column
 * @method     ChildObjStageQuery groupByIsAvailable() Group by the is_available column
 * @method     ChildObjStageQuery groupByHouseId() Group by the house_id column
 * @method     ChildObjStageQuery groupByVersion() Group by the version column
 * @method     ChildObjStageQuery groupByVersionCreatedAt() Group by the version_created_at column
 * @method     ChildObjStageQuery groupByVersionCreatedBy() Group by the version_created_by column
 * @method     ChildObjStageQuery groupByVersionComment() Group by the version_comment column
 *
 * @method     ChildObjStageQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildObjStageQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildObjStageQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildObjStageQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildObjStageQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildObjStageQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildObjStageQuery leftJoinObjHouse($relationAlias = null) Adds a LEFT JOIN clause to the query using the ObjHouse relation
 * @method     ChildObjStageQuery rightJoinObjHouse($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ObjHouse relation
 * @method     ChildObjStageQuery innerJoinObjHouse($relationAlias = null) Adds a INNER JOIN clause to the query using the ObjHouse relation
 *
 * @method     ChildObjStageQuery joinWithObjHouse($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ObjHouse relation
 *
 * @method     ChildObjStageQuery leftJoinWithObjHouse() Adds a LEFT JOIN clause and with to the query using the ObjHouse relation
 * @method     ChildObjStageQuery rightJoinWithObjHouse() Adds a RIGHT JOIN clause and with to the query using the ObjHouse relation
 * @method     ChildObjStageQuery innerJoinWithObjHouse() Adds a INNER JOIN clause and with to the query using the ObjHouse relation
 *
 * @method     ChildObjStageQuery leftJoinObjStageWork($relationAlias = null) Adds a LEFT JOIN clause to the query using the ObjStageWork relation
 * @method     ChildObjStageQuery rightJoinObjStageWork($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ObjStageWork relation
 * @method     ChildObjStageQuery innerJoinObjStageWork($relationAlias = null) Adds a INNER JOIN clause to the query using the ObjStageWork relation
 *
 * @method     ChildObjStageQuery joinWithObjStageWork($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ObjStageWork relation
 *
 * @method     ChildObjStageQuery leftJoinWithObjStageWork() Adds a LEFT JOIN clause and with to the query using the ObjStageWork relation
 * @method     ChildObjStageQuery rightJoinWithObjStageWork() Adds a RIGHT JOIN clause and with to the query using the ObjStageWork relation
 * @method     ChildObjStageQuery innerJoinWithObjStageWork() Adds a INNER JOIN clause and with to the query using the ObjStageWork relation
 *
 * @method     ChildObjStageQuery leftJoinObjStageVersion($relationAlias = null) Adds a LEFT JOIN clause to the query using the ObjStageVersion relation
 * @method     ChildObjStageQuery rightJoinObjStageVersion($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ObjStageVersion relation
 * @method     ChildObjStageQuery innerJoinObjStageVersion($relationAlias = null) Adds a INNER JOIN clause to the query using the ObjStageVersion relation
 *
 * @method     ChildObjStageQuery joinWithObjStageVersion($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ObjStageVersion relation
 *
 * @method     ChildObjStageQuery leftJoinWithObjStageVersion() Adds a LEFT JOIN clause and with to the query using the ObjStageVersion relation
 * @method     ChildObjStageQuery rightJoinWithObjStageVersion() Adds a RIGHT JOIN clause and with to the query using the ObjStageVersion relation
 * @method     ChildObjStageQuery innerJoinWithObjStageVersion() Adds a INNER JOIN clause and with to the query using the ObjStageVersion relation
 *
 * @method     \DB\ObjHouseQuery|\DB\ObjStageWorkQuery|\DB\ObjStageVersionQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildObjStage|null findOne(?ConnectionInterface $con = null) Return the first ChildObjStage matching the query
 * @method     ChildObjStage findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildObjStage matching the query, or a new ChildObjStage object populated from the query conditions when no match is found
 *
 * @method     ChildObjStage|null findOneById(int $id) Return the first ChildObjStage filtered by the id column
 * @method     ChildObjStage|null findOneByName(string $name) Return the first ChildObjStage filtered by the name column
 * @method     ChildObjStage|null findOneByStatus(string $status) Return the first ChildObjStage filtered by the status column
 * @method     ChildObjStage|null findOneByIsPublic(boolean $is_public) Return the first ChildObjStage filtered by the is_public column
 * @method     ChildObjStage|null findOneByIsAvailable(boolean $is_available) Return the first ChildObjStage filtered by the is_available column
 * @method     ChildObjStage|null findOneByHouseId(int $house_id) Return the first ChildObjStage filtered by the house_id column
 * @method     ChildObjStage|null findOneByVersion(int $version) Return the first ChildObjStage filtered by the version column
 * @method     ChildObjStage|null findOneByVersionCreatedAt(string $version_created_at) Return the first ChildObjStage filtered by the version_created_at column
 * @method     ChildObjStage|null findOneByVersionCreatedBy(string $version_created_by) Return the first ChildObjStage filtered by the version_created_by column
 * @method     ChildObjStage|null findOneByVersionComment(string $version_comment) Return the first ChildObjStage filtered by the version_comment column *

 * @method     ChildObjStage requirePk($key, ?ConnectionInterface $con = null) Return the ChildObjStage by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjStage requireOne(?ConnectionInterface $con = null) Return the first ChildObjStage matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildObjStage requireOneById(int $id) Return the first ChildObjStage filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjStage requireOneByName(string $name) Return the first ChildObjStage filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjStage requireOneByStatus(string $status) Return the first ChildObjStage filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjStage requireOneByIsPublic(boolean $is_public) Return the first ChildObjStage filtered by the is_public column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjStage requireOneByIsAvailable(boolean $is_available) Return the first ChildObjStage filtered by the is_available column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjStage requireOneByHouseId(int $house_id) Return the first ChildObjStage filtered by the house_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjStage requireOneByVersion(int $version) Return the first ChildObjStage filtered by the version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjStage requireOneByVersionCreatedAt(string $version_created_at) Return the first ChildObjStage filtered by the version_created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjStage requireOneByVersionCreatedBy(string $version_created_by) Return the first ChildObjStage filtered by the version_created_by column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjStage requireOneByVersionComment(string $version_comment) Return the first ChildObjStage filtered by the version_comment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildObjStage[]|Collection find(?ConnectionInterface $con = null) Return ChildObjStage objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildObjStage> find(?ConnectionInterface $con = null) Return ChildObjStage objects based on current ModelCriteria
 * @method     ChildObjStage[]|Collection findById(int $id) Return ChildObjStage objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildObjStage> findById(int $id) Return ChildObjStage objects filtered by the id column
 * @method     ChildObjStage[]|Collection findByName(string $name) Return ChildObjStage objects filtered by the name column
 * @psalm-method Collection&\Traversable<ChildObjStage> findByName(string $name) Return ChildObjStage objects filtered by the name column
 * @method     ChildObjStage[]|Collection findByStatus(string $status) Return ChildObjStage objects filtered by the status column
 * @psalm-method Collection&\Traversable<ChildObjStage> findByStatus(string $status) Return ChildObjStage objects filtered by the status column
 * @method     ChildObjStage[]|Collection findByIsPublic(boolean $is_public) Return ChildObjStage objects filtered by the is_public column
 * @psalm-method Collection&\Traversable<ChildObjStage> findByIsPublic(boolean $is_public) Return ChildObjStage objects filtered by the is_public column
 * @method     ChildObjStage[]|Collection findByIsAvailable(boolean $is_available) Return ChildObjStage objects filtered by the is_available column
 * @psalm-method Collection&\Traversable<ChildObjStage> findByIsAvailable(boolean $is_available) Return ChildObjStage objects filtered by the is_available column
 * @method     ChildObjStage[]|Collection findByHouseId(int $house_id) Return ChildObjStage objects filtered by the house_id column
 * @psalm-method Collection&\Traversable<ChildObjStage> findByHouseId(int $house_id) Return ChildObjStage objects filtered by the house_id column
 * @method     ChildObjStage[]|Collection findByVersion(int $version) Return ChildObjStage objects filtered by the version column
 * @psalm-method Collection&\Traversable<ChildObjStage> findByVersion(int $version) Return ChildObjStage objects filtered by the version column
 * @method     ChildObjStage[]|Collection findByVersionCreatedAt(string $version_created_at) Return ChildObjStage objects filtered by the version_created_at column
 * @psalm-method Collection&\Traversable<ChildObjStage> findByVersionCreatedAt(string $version_created_at) Return ChildObjStage objects filtered by the version_created_at column
 * @method     ChildObjStage[]|Collection findByVersionCreatedBy(string $version_created_by) Return ChildObjStage objects filtered by the version_created_by column
 * @psalm-method Collection&\Traversable<ChildObjStage> findByVersionCreatedBy(string $version_created_by) Return ChildObjStage objects filtered by the version_created_by column
 * @method     ChildObjStage[]|Collection findByVersionComment(string $version_comment) Return ChildObjStage objects filtered by the version_comment column
 * @psalm-method Collection&\Traversable<ChildObjStage> findByVersionComment(string $version_comment) Return ChildObjStage objects filtered by the version_comment column
 * @method     ChildObjStage[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildObjStage> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ObjStageQuery extends ModelCriteria
{

    // versionable behavior

    /**
     * Whether the versioning is enabled
     */
    static $isVersioningEnabled = true;
protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \DB\Base\ObjStageQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\DB\\ObjStage', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildObjStageQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildObjStageQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildObjStageQuery) {
            return $criteria;
        }
        $query = new ChildObjStageQuery();
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
     * @return ChildObjStage|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ObjStageTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ObjStageTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildObjStage A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, status, is_public, is_available, house_id, version, version_created_at, version_created_by, version_comment FROM obj_stage WHERE id = :p0';
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
            /** @var ChildObjStage $obj */
            $obj = new ChildObjStage();
            $obj->hydrate($row);
            ObjStageTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildObjStage|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(ObjStageTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(ObjStageTableMap::COL_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(ObjStageTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ObjStageTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ObjStageTableMap::COL_ID, $id, $comparison);

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

        $this->addUsingAlias(ObjStageTableMap::COL_NAME, $name, $comparison);

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

        $this->addUsingAlias(ObjStageTableMap::COL_STATUS, $status, $comparison);

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

        $this->addUsingAlias(ObjStageTableMap::COL_IS_PUBLIC, $isPublic, $comparison);

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

        $this->addUsingAlias(ObjStageTableMap::COL_IS_AVAILABLE, $isAvailable, $comparison);

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
     * @see       filterByObjHouse()
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
                $this->addUsingAlias(ObjStageTableMap::COL_HOUSE_ID, $houseId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($houseId['max'])) {
                $this->addUsingAlias(ObjStageTableMap::COL_HOUSE_ID, $houseId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ObjStageTableMap::COL_HOUSE_ID, $houseId, $comparison);

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
                $this->addUsingAlias(ObjStageTableMap::COL_VERSION, $version['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($version['max'])) {
                $this->addUsingAlias(ObjStageTableMap::COL_VERSION, $version['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ObjStageTableMap::COL_VERSION, $version, $comparison);

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
                $this->addUsingAlias(ObjStageTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($versionCreatedAt['max'])) {
                $this->addUsingAlias(ObjStageTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ObjStageTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt, $comparison);

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

        $this->addUsingAlias(ObjStageTableMap::COL_VERSION_CREATED_BY, $versionCreatedBy, $comparison);

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

        $this->addUsingAlias(ObjStageTableMap::COL_VERSION_COMMENT, $versionComment, $comparison);

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
                ->addUsingAlias(ObjStageTableMap::COL_HOUSE_ID, $objHouse->getId(), $comparison);
        } elseif ($objHouse instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(ObjStageTableMap::COL_HOUSE_ID, $objHouse->toKeyValue('PrimaryKey', 'Id'), $comparison);

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
     * Filter the query by a related \DB\ObjStageWork object
     *
     * @param \DB\ObjStageWork|ObjectCollection $objStageWork the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByObjStageWork($objStageWork, ?string $comparison = null)
    {
        if ($objStageWork instanceof \DB\ObjStageWork) {
            $this
                ->addUsingAlias(ObjStageTableMap::COL_ID, $objStageWork->getStageId(), $comparison);

            return $this;
        } elseif ($objStageWork instanceof ObjectCollection) {
            $this
                ->useObjStageWorkQuery()
                ->filterByPrimaryKeys($objStageWork->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByObjStageWork() only accepts arguments of type \DB\ObjStageWork or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ObjStageWork relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinObjStageWork(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ObjStageWork');

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
            $this->addJoinObject($join, 'ObjStageWork');
        }

        return $this;
    }

    /**
     * Use the ObjStageWork relation ObjStageWork object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\ObjStageWorkQuery A secondary query class using the current class as primary query
     */
    public function useObjStageWorkQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinObjStageWork($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ObjStageWork', '\DB\ObjStageWorkQuery');
    }

    /**
     * Use the ObjStageWork relation ObjStageWork object
     *
     * @param callable(\DB\ObjStageWorkQuery):\DB\ObjStageWorkQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withObjStageWorkQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useObjStageWorkQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to ObjStageWork table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\ObjStageWorkQuery The inner query object of the EXISTS statement
     */
    public function useObjStageWorkExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('ObjStageWork', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to ObjStageWork table for a NOT EXISTS query.
     *
     * @see useObjStageWorkExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\ObjStageWorkQuery The inner query object of the NOT EXISTS statement
     */
    public function useObjStageWorkNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('ObjStageWork', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \DB\ObjStageVersion object
     *
     * @param \DB\ObjStageVersion|ObjectCollection $objStageVersion the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByObjStageVersion($objStageVersion, ?string $comparison = null)
    {
        if ($objStageVersion instanceof \DB\ObjStageVersion) {
            $this
                ->addUsingAlias(ObjStageTableMap::COL_ID, $objStageVersion->getId(), $comparison);

            return $this;
        } elseif ($objStageVersion instanceof ObjectCollection) {
            $this
                ->useObjStageVersionQuery()
                ->filterByPrimaryKeys($objStageVersion->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByObjStageVersion() only accepts arguments of type \DB\ObjStageVersion or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ObjStageVersion relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinObjStageVersion(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ObjStageVersion');

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
            $this->addJoinObject($join, 'ObjStageVersion');
        }

        return $this;
    }

    /**
     * Use the ObjStageVersion relation ObjStageVersion object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\ObjStageVersionQuery A secondary query class using the current class as primary query
     */
    public function useObjStageVersionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinObjStageVersion($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ObjStageVersion', '\DB\ObjStageVersionQuery');
    }

    /**
     * Use the ObjStageVersion relation ObjStageVersion object
     *
     * @param callable(\DB\ObjStageVersionQuery):\DB\ObjStageVersionQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withObjStageVersionQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useObjStageVersionQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to ObjStageVersion table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\ObjStageVersionQuery The inner query object of the EXISTS statement
     */
    public function useObjStageVersionExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('ObjStageVersion', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to ObjStageVersion table for a NOT EXISTS query.
     *
     * @see useObjStageVersionExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\ObjStageVersionQuery The inner query object of the NOT EXISTS statement
     */
    public function useObjStageVersionNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('ObjStageVersion', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Exclude object from result
     *
     * @param ChildObjStage $objStage Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($objStage = null)
    {
        if ($objStage) {
            $this->addUsingAlias(ObjStageTableMap::COL_ID, $objStage->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the obj_stage table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ObjStageTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ObjStageTableMap::clearInstancePool();
            ObjStageTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ObjStageTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ObjStageTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ObjStageTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ObjStageTableMap::clearRelatedInstancePool();

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
