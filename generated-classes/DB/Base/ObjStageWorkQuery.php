<?php

namespace DB\Base;

use \Exception;
use \PDO;
use DB\ObjStageWork as ChildObjStageWork;
use DB\ObjStageWorkQuery as ChildObjStageWorkQuery;
use DB\Map\ObjStageWorkTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'obj_stage_work' table.
 *
 *
 *
 * @method     ChildObjStageWorkQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildObjStageWorkQuery orderByPrice($order = Criteria::ASC) Order by the price column
 * @method     ChildObjStageWorkQuery orderByAmount($order = Criteria::ASC) Order by the amount column
 * @method     ChildObjStageWorkQuery orderByIsAvailable($order = Criteria::ASC) Order by the is_available column
 * @method     ChildObjStageWorkQuery orderByWorkId($order = Criteria::ASC) Order by the work_id column
 * @method     ChildObjStageWorkQuery orderByStageId($order = Criteria::ASC) Order by the stage_id column
 * @method     ChildObjStageWorkQuery orderByVersionCreatedBy($order = Criteria::ASC) Order by the version_created_by column
 * @method     ChildObjStageWorkQuery orderByVersion($order = Criteria::ASC) Order by the version column
 * @method     ChildObjStageWorkQuery orderByVersionCreatedAt($order = Criteria::ASC) Order by the version_created_at column
 * @method     ChildObjStageWorkQuery orderByVersionComment($order = Criteria::ASC) Order by the version_comment column
 *
 * @method     ChildObjStageWorkQuery groupById() Group by the id column
 * @method     ChildObjStageWorkQuery groupByPrice() Group by the price column
 * @method     ChildObjStageWorkQuery groupByAmount() Group by the amount column
 * @method     ChildObjStageWorkQuery groupByIsAvailable() Group by the is_available column
 * @method     ChildObjStageWorkQuery groupByWorkId() Group by the work_id column
 * @method     ChildObjStageWorkQuery groupByStageId() Group by the stage_id column
 * @method     ChildObjStageWorkQuery groupByVersionCreatedBy() Group by the version_created_by column
 * @method     ChildObjStageWorkQuery groupByVersion() Group by the version column
 * @method     ChildObjStageWorkQuery groupByVersionCreatedAt() Group by the version_created_at column
 * @method     ChildObjStageWorkQuery groupByVersionComment() Group by the version_comment column
 *
 * @method     ChildObjStageWorkQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildObjStageWorkQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildObjStageWorkQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildObjStageWorkQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildObjStageWorkQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildObjStageWorkQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildObjStageWorkQuery leftJoinUsers($relationAlias = null) Adds a LEFT JOIN clause to the query using the Users relation
 * @method     ChildObjStageWorkQuery rightJoinUsers($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Users relation
 * @method     ChildObjStageWorkQuery innerJoinUsers($relationAlias = null) Adds a INNER JOIN clause to the query using the Users relation
 *
 * @method     ChildObjStageWorkQuery joinWithUsers($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Users relation
 *
 * @method     ChildObjStageWorkQuery leftJoinWithUsers() Adds a LEFT JOIN clause and with to the query using the Users relation
 * @method     ChildObjStageWorkQuery rightJoinWithUsers() Adds a RIGHT JOIN clause and with to the query using the Users relation
 * @method     ChildObjStageWorkQuery innerJoinWithUsers() Adds a INNER JOIN clause and with to the query using the Users relation
 *
 * @method     ChildObjStageWorkQuery leftJoinVolWork($relationAlias = null) Adds a LEFT JOIN clause to the query using the VolWork relation
 * @method     ChildObjStageWorkQuery rightJoinVolWork($relationAlias = null) Adds a RIGHT JOIN clause to the query using the VolWork relation
 * @method     ChildObjStageWorkQuery innerJoinVolWork($relationAlias = null) Adds a INNER JOIN clause to the query using the VolWork relation
 *
 * @method     ChildObjStageWorkQuery joinWithVolWork($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the VolWork relation
 *
 * @method     ChildObjStageWorkQuery leftJoinWithVolWork() Adds a LEFT JOIN clause and with to the query using the VolWork relation
 * @method     ChildObjStageWorkQuery rightJoinWithVolWork() Adds a RIGHT JOIN clause and with to the query using the VolWork relation
 * @method     ChildObjStageWorkQuery innerJoinWithVolWork() Adds a INNER JOIN clause and with to the query using the VolWork relation
 *
 * @method     ChildObjStageWorkQuery leftJoinObjStage($relationAlias = null) Adds a LEFT JOIN clause to the query using the ObjStage relation
 * @method     ChildObjStageWorkQuery rightJoinObjStage($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ObjStage relation
 * @method     ChildObjStageWorkQuery innerJoinObjStage($relationAlias = null) Adds a INNER JOIN clause to the query using the ObjStage relation
 *
 * @method     ChildObjStageWorkQuery joinWithObjStage($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ObjStage relation
 *
 * @method     ChildObjStageWorkQuery leftJoinWithObjStage() Adds a LEFT JOIN clause and with to the query using the ObjStage relation
 * @method     ChildObjStageWorkQuery rightJoinWithObjStage() Adds a RIGHT JOIN clause and with to the query using the ObjStage relation
 * @method     ChildObjStageWorkQuery innerJoinWithObjStage() Adds a INNER JOIN clause and with to the query using the ObjStage relation
 *
 * @method     ChildObjStageWorkQuery leftJoinObjStageMaterial($relationAlias = null) Adds a LEFT JOIN clause to the query using the ObjStageMaterial relation
 * @method     ChildObjStageWorkQuery rightJoinObjStageMaterial($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ObjStageMaterial relation
 * @method     ChildObjStageWorkQuery innerJoinObjStageMaterial($relationAlias = null) Adds a INNER JOIN clause to the query using the ObjStageMaterial relation
 *
 * @method     ChildObjStageWorkQuery joinWithObjStageMaterial($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ObjStageMaterial relation
 *
 * @method     ChildObjStageWorkQuery leftJoinWithObjStageMaterial() Adds a LEFT JOIN clause and with to the query using the ObjStageMaterial relation
 * @method     ChildObjStageWorkQuery rightJoinWithObjStageMaterial() Adds a RIGHT JOIN clause and with to the query using the ObjStageMaterial relation
 * @method     ChildObjStageWorkQuery innerJoinWithObjStageMaterial() Adds a INNER JOIN clause and with to the query using the ObjStageMaterial relation
 *
 * @method     ChildObjStageWorkQuery leftJoinObjStageTechnic($relationAlias = null) Adds a LEFT JOIN clause to the query using the ObjStageTechnic relation
 * @method     ChildObjStageWorkQuery rightJoinObjStageTechnic($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ObjStageTechnic relation
 * @method     ChildObjStageWorkQuery innerJoinObjStageTechnic($relationAlias = null) Adds a INNER JOIN clause to the query using the ObjStageTechnic relation
 *
 * @method     ChildObjStageWorkQuery joinWithObjStageTechnic($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ObjStageTechnic relation
 *
 * @method     ChildObjStageWorkQuery leftJoinWithObjStageTechnic() Adds a LEFT JOIN clause and with to the query using the ObjStageTechnic relation
 * @method     ChildObjStageWorkQuery rightJoinWithObjStageTechnic() Adds a RIGHT JOIN clause and with to the query using the ObjStageTechnic relation
 * @method     ChildObjStageWorkQuery innerJoinWithObjStageTechnic() Adds a INNER JOIN clause and with to the query using the ObjStageTechnic relation
 *
 * @method     ChildObjStageWorkQuery leftJoinObjStageWorkVersion($relationAlias = null) Adds a LEFT JOIN clause to the query using the ObjStageWorkVersion relation
 * @method     ChildObjStageWorkQuery rightJoinObjStageWorkVersion($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ObjStageWorkVersion relation
 * @method     ChildObjStageWorkQuery innerJoinObjStageWorkVersion($relationAlias = null) Adds a INNER JOIN clause to the query using the ObjStageWorkVersion relation
 *
 * @method     ChildObjStageWorkQuery joinWithObjStageWorkVersion($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ObjStageWorkVersion relation
 *
 * @method     ChildObjStageWorkQuery leftJoinWithObjStageWorkVersion() Adds a LEFT JOIN clause and with to the query using the ObjStageWorkVersion relation
 * @method     ChildObjStageWorkQuery rightJoinWithObjStageWorkVersion() Adds a RIGHT JOIN clause and with to the query using the ObjStageWorkVersion relation
 * @method     ChildObjStageWorkQuery innerJoinWithObjStageWorkVersion() Adds a INNER JOIN clause and with to the query using the ObjStageWorkVersion relation
 *
 * @method     \DB\UsersQuery|\DB\VolWorkQuery|\DB\ObjStageQuery|\DB\ObjStageMaterialQuery|\DB\ObjStageTechnicQuery|\DB\ObjStageWorkVersionQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildObjStageWork|null findOne(?ConnectionInterface $con = null) Return the first ChildObjStageWork matching the query
 * @method     ChildObjStageWork findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildObjStageWork matching the query, or a new ChildObjStageWork object populated from the query conditions when no match is found
 *
 * @method     ChildObjStageWork|null findOneById(int $id) Return the first ChildObjStageWork filtered by the id column
 * @method     ChildObjStageWork|null findOneByPrice(string $price) Return the first ChildObjStageWork filtered by the price column
 * @method     ChildObjStageWork|null findOneByAmount(string $amount) Return the first ChildObjStageWork filtered by the amount column
 * @method     ChildObjStageWork|null findOneByIsAvailable(boolean $is_available) Return the first ChildObjStageWork filtered by the is_available column
 * @method     ChildObjStageWork|null findOneByWorkId(int $work_id) Return the first ChildObjStageWork filtered by the work_id column
 * @method     ChildObjStageWork|null findOneByStageId(int $stage_id) Return the first ChildObjStageWork filtered by the stage_id column
 * @method     ChildObjStageWork|null findOneByVersionCreatedBy(int $version_created_by) Return the first ChildObjStageWork filtered by the version_created_by column
 * @method     ChildObjStageWork|null findOneByVersion(int $version) Return the first ChildObjStageWork filtered by the version column
 * @method     ChildObjStageWork|null findOneByVersionCreatedAt(string $version_created_at) Return the first ChildObjStageWork filtered by the version_created_at column
 * @method     ChildObjStageWork|null findOneByVersionComment(string $version_comment) Return the first ChildObjStageWork filtered by the version_comment column *

 * @method     ChildObjStageWork requirePk($key, ?ConnectionInterface $con = null) Return the ChildObjStageWork by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjStageWork requireOne(?ConnectionInterface $con = null) Return the first ChildObjStageWork matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildObjStageWork requireOneById(int $id) Return the first ChildObjStageWork filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjStageWork requireOneByPrice(string $price) Return the first ChildObjStageWork filtered by the price column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjStageWork requireOneByAmount(string $amount) Return the first ChildObjStageWork filtered by the amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjStageWork requireOneByIsAvailable(boolean $is_available) Return the first ChildObjStageWork filtered by the is_available column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjStageWork requireOneByWorkId(int $work_id) Return the first ChildObjStageWork filtered by the work_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjStageWork requireOneByStageId(int $stage_id) Return the first ChildObjStageWork filtered by the stage_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjStageWork requireOneByVersionCreatedBy(int $version_created_by) Return the first ChildObjStageWork filtered by the version_created_by column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjStageWork requireOneByVersion(int $version) Return the first ChildObjStageWork filtered by the version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjStageWork requireOneByVersionCreatedAt(string $version_created_at) Return the first ChildObjStageWork filtered by the version_created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjStageWork requireOneByVersionComment(string $version_comment) Return the first ChildObjStageWork filtered by the version_comment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildObjStageWork[]|Collection find(?ConnectionInterface $con = null) Return ChildObjStageWork objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildObjStageWork> find(?ConnectionInterface $con = null) Return ChildObjStageWork objects based on current ModelCriteria
 * @method     ChildObjStageWork[]|Collection findById(int $id) Return ChildObjStageWork objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildObjStageWork> findById(int $id) Return ChildObjStageWork objects filtered by the id column
 * @method     ChildObjStageWork[]|Collection findByPrice(string $price) Return ChildObjStageWork objects filtered by the price column
 * @psalm-method Collection&\Traversable<ChildObjStageWork> findByPrice(string $price) Return ChildObjStageWork objects filtered by the price column
 * @method     ChildObjStageWork[]|Collection findByAmount(string $amount) Return ChildObjStageWork objects filtered by the amount column
 * @psalm-method Collection&\Traversable<ChildObjStageWork> findByAmount(string $amount) Return ChildObjStageWork objects filtered by the amount column
 * @method     ChildObjStageWork[]|Collection findByIsAvailable(boolean $is_available) Return ChildObjStageWork objects filtered by the is_available column
 * @psalm-method Collection&\Traversable<ChildObjStageWork> findByIsAvailable(boolean $is_available) Return ChildObjStageWork objects filtered by the is_available column
 * @method     ChildObjStageWork[]|Collection findByWorkId(int $work_id) Return ChildObjStageWork objects filtered by the work_id column
 * @psalm-method Collection&\Traversable<ChildObjStageWork> findByWorkId(int $work_id) Return ChildObjStageWork objects filtered by the work_id column
 * @method     ChildObjStageWork[]|Collection findByStageId(int $stage_id) Return ChildObjStageWork objects filtered by the stage_id column
 * @psalm-method Collection&\Traversable<ChildObjStageWork> findByStageId(int $stage_id) Return ChildObjStageWork objects filtered by the stage_id column
 * @method     ChildObjStageWork[]|Collection findByVersionCreatedBy(int $version_created_by) Return ChildObjStageWork objects filtered by the version_created_by column
 * @psalm-method Collection&\Traversable<ChildObjStageWork> findByVersionCreatedBy(int $version_created_by) Return ChildObjStageWork objects filtered by the version_created_by column
 * @method     ChildObjStageWork[]|Collection findByVersion(int $version) Return ChildObjStageWork objects filtered by the version column
 * @psalm-method Collection&\Traversable<ChildObjStageWork> findByVersion(int $version) Return ChildObjStageWork objects filtered by the version column
 * @method     ChildObjStageWork[]|Collection findByVersionCreatedAt(string $version_created_at) Return ChildObjStageWork objects filtered by the version_created_at column
 * @psalm-method Collection&\Traversable<ChildObjStageWork> findByVersionCreatedAt(string $version_created_at) Return ChildObjStageWork objects filtered by the version_created_at column
 * @method     ChildObjStageWork[]|Collection findByVersionComment(string $version_comment) Return ChildObjStageWork objects filtered by the version_comment column
 * @psalm-method Collection&\Traversable<ChildObjStageWork> findByVersionComment(string $version_comment) Return ChildObjStageWork objects filtered by the version_comment column
 * @method     ChildObjStageWork[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildObjStageWork> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ObjStageWorkQuery extends ModelCriteria
{

    // versionable behavior

    /**
     * Whether the versioning is enabled
     */
    static $isVersioningEnabled = true;
protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \DB\Base\ObjStageWorkQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\DB\\ObjStageWork', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildObjStageWorkQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildObjStageWorkQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildObjStageWorkQuery) {
            return $criteria;
        }
        $query = new ChildObjStageWorkQuery();
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
     * @return ChildObjStageWork|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ObjStageWorkTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ObjStageWorkTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildObjStageWork A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, price, amount, is_available, work_id, stage_id, version_created_by, version, version_created_at, version_comment FROM obj_stage_work WHERE id = :p0';
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
            /** @var ChildObjStageWork $obj */
            $obj = new ChildObjStageWork();
            $obj->hydrate($row);
            ObjStageWorkTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildObjStageWork|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(ObjStageWorkTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(ObjStageWorkTableMap::COL_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(ObjStageWorkTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ObjStageWorkTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ObjStageWorkTableMap::COL_ID, $id, $comparison);

        return $this;
    }

    /**
     * Filter the query on the price column
     *
     * Example usage:
     * <code>
     * $query->filterByPrice(1234); // WHERE price = 1234
     * $query->filterByPrice(array(12, 34)); // WHERE price IN (12, 34)
     * $query->filterByPrice(array('min' => 12)); // WHERE price > 12
     * </code>
     *
     * @param mixed $price The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrice($price = null, ?string $comparison = null)
    {
        if (is_array($price)) {
            $useMinMax = false;
            if (isset($price['min'])) {
                $this->addUsingAlias(ObjStageWorkTableMap::COL_PRICE, $price['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($price['max'])) {
                $this->addUsingAlias(ObjStageWorkTableMap::COL_PRICE, $price['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ObjStageWorkTableMap::COL_PRICE, $price, $comparison);

        return $this;
    }

    /**
     * Filter the query on the amount column
     *
     * Example usage:
     * <code>
     * $query->filterByAmount(1234); // WHERE amount = 1234
     * $query->filterByAmount(array(12, 34)); // WHERE amount IN (12, 34)
     * $query->filterByAmount(array('min' => 12)); // WHERE amount > 12
     * </code>
     *
     * @param mixed $amount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAmount($amount = null, ?string $comparison = null)
    {
        if (is_array($amount)) {
            $useMinMax = false;
            if (isset($amount['min'])) {
                $this->addUsingAlias(ObjStageWorkTableMap::COL_AMOUNT, $amount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($amount['max'])) {
                $this->addUsingAlias(ObjStageWorkTableMap::COL_AMOUNT, $amount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ObjStageWorkTableMap::COL_AMOUNT, $amount, $comparison);

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

        $this->addUsingAlias(ObjStageWorkTableMap::COL_IS_AVAILABLE, $isAvailable, $comparison);

        return $this;
    }

    /**
     * Filter the query on the work_id column
     *
     * Example usage:
     * <code>
     * $query->filterByWorkId(1234); // WHERE work_id = 1234
     * $query->filterByWorkId(array(12, 34)); // WHERE work_id IN (12, 34)
     * $query->filterByWorkId(array('min' => 12)); // WHERE work_id > 12
     * </code>
     *
     * @see       filterByVolWork()
     *
     * @param mixed $workId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWorkId($workId = null, ?string $comparison = null)
    {
        if (is_array($workId)) {
            $useMinMax = false;
            if (isset($workId['min'])) {
                $this->addUsingAlias(ObjStageWorkTableMap::COL_WORK_ID, $workId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($workId['max'])) {
                $this->addUsingAlias(ObjStageWorkTableMap::COL_WORK_ID, $workId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ObjStageWorkTableMap::COL_WORK_ID, $workId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the stage_id column
     *
     * Example usage:
     * <code>
     * $query->filterByStageId(1234); // WHERE stage_id = 1234
     * $query->filterByStageId(array(12, 34)); // WHERE stage_id IN (12, 34)
     * $query->filterByStageId(array('min' => 12)); // WHERE stage_id > 12
     * </code>
     *
     * @see       filterByObjStage()
     *
     * @param mixed $stageId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStageId($stageId = null, ?string $comparison = null)
    {
        if (is_array($stageId)) {
            $useMinMax = false;
            if (isset($stageId['min'])) {
                $this->addUsingAlias(ObjStageWorkTableMap::COL_STAGE_ID, $stageId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($stageId['max'])) {
                $this->addUsingAlias(ObjStageWorkTableMap::COL_STAGE_ID, $stageId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ObjStageWorkTableMap::COL_STAGE_ID, $stageId, $comparison);

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
                $this->addUsingAlias(ObjStageWorkTableMap::COL_VERSION_CREATED_BY, $versionCreatedBy['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($versionCreatedBy['max'])) {
                $this->addUsingAlias(ObjStageWorkTableMap::COL_VERSION_CREATED_BY, $versionCreatedBy['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ObjStageWorkTableMap::COL_VERSION_CREATED_BY, $versionCreatedBy, $comparison);

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
                $this->addUsingAlias(ObjStageWorkTableMap::COL_VERSION, $version['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($version['max'])) {
                $this->addUsingAlias(ObjStageWorkTableMap::COL_VERSION, $version['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ObjStageWorkTableMap::COL_VERSION, $version, $comparison);

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
                $this->addUsingAlias(ObjStageWorkTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($versionCreatedAt['max'])) {
                $this->addUsingAlias(ObjStageWorkTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ObjStageWorkTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt, $comparison);

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

        $this->addUsingAlias(ObjStageWorkTableMap::COL_VERSION_COMMENT, $versionComment, $comparison);

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
                ->addUsingAlias(ObjStageWorkTableMap::COL_VERSION_CREATED_BY, $users->getId(), $comparison);
        } elseif ($users instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(ObjStageWorkTableMap::COL_VERSION_CREATED_BY, $users->toKeyValue('PrimaryKey', 'Id'), $comparison);

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
     * Filter the query by a related \DB\VolWork object
     *
     * @param \DB\VolWork|ObjectCollection $volWork The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByVolWork($volWork, ?string $comparison = null)
    {
        if ($volWork instanceof \DB\VolWork) {
            return $this
                ->addUsingAlias(ObjStageWorkTableMap::COL_WORK_ID, $volWork->getId(), $comparison);
        } elseif ($volWork instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(ObjStageWorkTableMap::COL_WORK_ID, $volWork->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByVolWork() only accepts arguments of type \DB\VolWork or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the VolWork relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinVolWork(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('VolWork');

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
            $this->addJoinObject($join, 'VolWork');
        }

        return $this;
    }

    /**
     * Use the VolWork relation VolWork object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\VolWorkQuery A secondary query class using the current class as primary query
     */
    public function useVolWorkQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinVolWork($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'VolWork', '\DB\VolWorkQuery');
    }

    /**
     * Use the VolWork relation VolWork object
     *
     * @param callable(\DB\VolWorkQuery):\DB\VolWorkQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withVolWorkQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useVolWorkQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to VolWork table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\VolWorkQuery The inner query object of the EXISTS statement
     */
    public function useVolWorkExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('VolWork', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to VolWork table for a NOT EXISTS query.
     *
     * @see useVolWorkExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\VolWorkQuery The inner query object of the NOT EXISTS statement
     */
    public function useVolWorkNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('VolWork', $modelAlias, $queryClass, 'NOT EXISTS');
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
                ->addUsingAlias(ObjStageWorkTableMap::COL_STAGE_ID, $objStage->getId(), $comparison);
        } elseif ($objStage instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(ObjStageWorkTableMap::COL_STAGE_ID, $objStage->toKeyValue('PrimaryKey', 'Id'), $comparison);

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
     * Filter the query by a related \DB\ObjStageMaterial object
     *
     * @param \DB\ObjStageMaterial|ObjectCollection $objStageMaterial the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByObjStageMaterial($objStageMaterial, ?string $comparison = null)
    {
        if ($objStageMaterial instanceof \DB\ObjStageMaterial) {
            $this
                ->addUsingAlias(ObjStageWorkTableMap::COL_ID, $objStageMaterial->getStageWorkId(), $comparison);

            return $this;
        } elseif ($objStageMaterial instanceof ObjectCollection) {
            $this
                ->useObjStageMaterialQuery()
                ->filterByPrimaryKeys($objStageMaterial->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByObjStageMaterial() only accepts arguments of type \DB\ObjStageMaterial or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ObjStageMaterial relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinObjStageMaterial(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ObjStageMaterial');

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
            $this->addJoinObject($join, 'ObjStageMaterial');
        }

        return $this;
    }

    /**
     * Use the ObjStageMaterial relation ObjStageMaterial object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\ObjStageMaterialQuery A secondary query class using the current class as primary query
     */
    public function useObjStageMaterialQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinObjStageMaterial($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ObjStageMaterial', '\DB\ObjStageMaterialQuery');
    }

    /**
     * Use the ObjStageMaterial relation ObjStageMaterial object
     *
     * @param callable(\DB\ObjStageMaterialQuery):\DB\ObjStageMaterialQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withObjStageMaterialQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useObjStageMaterialQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to ObjStageMaterial table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\ObjStageMaterialQuery The inner query object of the EXISTS statement
     */
    public function useObjStageMaterialExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('ObjStageMaterial', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to ObjStageMaterial table for a NOT EXISTS query.
     *
     * @see useObjStageMaterialExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\ObjStageMaterialQuery The inner query object of the NOT EXISTS statement
     */
    public function useObjStageMaterialNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('ObjStageMaterial', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \DB\ObjStageTechnic object
     *
     * @param \DB\ObjStageTechnic|ObjectCollection $objStageTechnic the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByObjStageTechnic($objStageTechnic, ?string $comparison = null)
    {
        if ($objStageTechnic instanceof \DB\ObjStageTechnic) {
            $this
                ->addUsingAlias(ObjStageWorkTableMap::COL_ID, $objStageTechnic->getStageWorkId(), $comparison);

            return $this;
        } elseif ($objStageTechnic instanceof ObjectCollection) {
            $this
                ->useObjStageTechnicQuery()
                ->filterByPrimaryKeys($objStageTechnic->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByObjStageTechnic() only accepts arguments of type \DB\ObjStageTechnic or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ObjStageTechnic relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinObjStageTechnic(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ObjStageTechnic');

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
            $this->addJoinObject($join, 'ObjStageTechnic');
        }

        return $this;
    }

    /**
     * Use the ObjStageTechnic relation ObjStageTechnic object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\ObjStageTechnicQuery A secondary query class using the current class as primary query
     */
    public function useObjStageTechnicQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinObjStageTechnic($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ObjStageTechnic', '\DB\ObjStageTechnicQuery');
    }

    /**
     * Use the ObjStageTechnic relation ObjStageTechnic object
     *
     * @param callable(\DB\ObjStageTechnicQuery):\DB\ObjStageTechnicQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withObjStageTechnicQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useObjStageTechnicQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to ObjStageTechnic table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\ObjStageTechnicQuery The inner query object of the EXISTS statement
     */
    public function useObjStageTechnicExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('ObjStageTechnic', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to ObjStageTechnic table for a NOT EXISTS query.
     *
     * @see useObjStageTechnicExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\ObjStageTechnicQuery The inner query object of the NOT EXISTS statement
     */
    public function useObjStageTechnicNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('ObjStageTechnic', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \DB\ObjStageWorkVersion object
     *
     * @param \DB\ObjStageWorkVersion|ObjectCollection $objStageWorkVersion the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByObjStageWorkVersion($objStageWorkVersion, ?string $comparison = null)
    {
        if ($objStageWorkVersion instanceof \DB\ObjStageWorkVersion) {
            $this
                ->addUsingAlias(ObjStageWorkTableMap::COL_ID, $objStageWorkVersion->getId(), $comparison);

            return $this;
        } elseif ($objStageWorkVersion instanceof ObjectCollection) {
            $this
                ->useObjStageWorkVersionQuery()
                ->filterByPrimaryKeys($objStageWorkVersion->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByObjStageWorkVersion() only accepts arguments of type \DB\ObjStageWorkVersion or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ObjStageWorkVersion relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinObjStageWorkVersion(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ObjStageWorkVersion');

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
            $this->addJoinObject($join, 'ObjStageWorkVersion');
        }

        return $this;
    }

    /**
     * Use the ObjStageWorkVersion relation ObjStageWorkVersion object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\ObjStageWorkVersionQuery A secondary query class using the current class as primary query
     */
    public function useObjStageWorkVersionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinObjStageWorkVersion($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ObjStageWorkVersion', '\DB\ObjStageWorkVersionQuery');
    }

    /**
     * Use the ObjStageWorkVersion relation ObjStageWorkVersion object
     *
     * @param callable(\DB\ObjStageWorkVersionQuery):\DB\ObjStageWorkVersionQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withObjStageWorkVersionQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useObjStageWorkVersionQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to ObjStageWorkVersion table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\ObjStageWorkVersionQuery The inner query object of the EXISTS statement
     */
    public function useObjStageWorkVersionExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('ObjStageWorkVersion', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to ObjStageWorkVersion table for a NOT EXISTS query.
     *
     * @see useObjStageWorkVersionExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\ObjStageWorkVersionQuery The inner query object of the NOT EXISTS statement
     */
    public function useObjStageWorkVersionNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('ObjStageWorkVersion', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Exclude object from result
     *
     * @param ChildObjStageWork $objStageWork Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($objStageWork = null)
    {
        if ($objStageWork) {
            $this->addUsingAlias(ObjStageWorkTableMap::COL_ID, $objStageWork->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the obj_stage_work table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ObjStageWorkTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ObjStageWorkTableMap::clearInstancePool();
            ObjStageWorkTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ObjStageWorkTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ObjStageWorkTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ObjStageWorkTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ObjStageWorkTableMap::clearRelatedInstancePool();

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
