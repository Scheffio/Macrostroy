<?php

namespace DB\Base;

use \Exception;
use \PDO;
use DB\StageWork as ChildStageWork;
use DB\StageWorkQuery as ChildStageWorkQuery;
use DB\Map\StageWorkTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'stage_work' table.
 *
 *
 *
 * @method     ChildStageWorkQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildStageWorkQuery orderByStageId($order = Criteria::ASC) Order by the stage_id column
 * @method     ChildStageWorkQuery orderByWorkId($order = Criteria::ASC) Order by the work_id column
 * @method     ChildStageWorkQuery orderByPrice($order = Criteria::ASC) Order by the price column
 * @method     ChildStageWorkQuery orderByAmount($order = Criteria::ASC) Order by the amount column
 * @method     ChildStageWorkQuery orderByIsAvailable($order = Criteria::ASC) Order by the is_available column
 * @method     ChildStageWorkQuery orderByVersion($order = Criteria::ASC) Order by the version column
 * @method     ChildStageWorkQuery orderByVersionCreatedAt($order = Criteria::ASC) Order by the version_created_at column
 * @method     ChildStageWorkQuery orderByVersionCreatedBy($order = Criteria::ASC) Order by the version_created_by column
 * @method     ChildStageWorkQuery orderByVersionComment($order = Criteria::ASC) Order by the version_comment column
 *
 * @method     ChildStageWorkQuery groupById() Group by the id column
 * @method     ChildStageWorkQuery groupByStageId() Group by the stage_id column
 * @method     ChildStageWorkQuery groupByWorkId() Group by the work_id column
 * @method     ChildStageWorkQuery groupByPrice() Group by the price column
 * @method     ChildStageWorkQuery groupByAmount() Group by the amount column
 * @method     ChildStageWorkQuery groupByIsAvailable() Group by the is_available column
 * @method     ChildStageWorkQuery groupByVersion() Group by the version column
 * @method     ChildStageWorkQuery groupByVersionCreatedAt() Group by the version_created_at column
 * @method     ChildStageWorkQuery groupByVersionCreatedBy() Group by the version_created_by column
 * @method     ChildStageWorkQuery groupByVersionComment() Group by the version_comment column
 *
 * @method     ChildStageWorkQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildStageWorkQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildStageWorkQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildStageWorkQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildStageWorkQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildStageWorkQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildStageWorkQuery leftJoinStageMaterial($relationAlias = null) Adds a LEFT JOIN clause to the query using the StageMaterial relation
 * @method     ChildStageWorkQuery rightJoinStageMaterial($relationAlias = null) Adds a RIGHT JOIN clause to the query using the StageMaterial relation
 * @method     ChildStageWorkQuery innerJoinStageMaterial($relationAlias = null) Adds a INNER JOIN clause to the query using the StageMaterial relation
 *
 * @method     ChildStageWorkQuery joinWithStageMaterial($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the StageMaterial relation
 *
 * @method     ChildStageWorkQuery leftJoinWithStageMaterial() Adds a LEFT JOIN clause and with to the query using the StageMaterial relation
 * @method     ChildStageWorkQuery rightJoinWithStageMaterial() Adds a RIGHT JOIN clause and with to the query using the StageMaterial relation
 * @method     ChildStageWorkQuery innerJoinWithStageMaterial() Adds a INNER JOIN clause and with to the query using the StageMaterial relation
 *
 * @method     ChildStageWorkQuery leftJoinStageTechnic($relationAlias = null) Adds a LEFT JOIN clause to the query using the StageTechnic relation
 * @method     ChildStageWorkQuery rightJoinStageTechnic($relationAlias = null) Adds a RIGHT JOIN clause to the query using the StageTechnic relation
 * @method     ChildStageWorkQuery innerJoinStageTechnic($relationAlias = null) Adds a INNER JOIN clause to the query using the StageTechnic relation
 *
 * @method     ChildStageWorkQuery joinWithStageTechnic($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the StageTechnic relation
 *
 * @method     ChildStageWorkQuery leftJoinWithStageTechnic() Adds a LEFT JOIN clause and with to the query using the StageTechnic relation
 * @method     ChildStageWorkQuery rightJoinWithStageTechnic() Adds a RIGHT JOIN clause and with to the query using the StageTechnic relation
 * @method     ChildStageWorkQuery innerJoinWithStageTechnic() Adds a INNER JOIN clause and with to the query using the StageTechnic relation
 *
 * @method     ChildStageWorkQuery leftJoinStageWorkVersion($relationAlias = null) Adds a LEFT JOIN clause to the query using the StageWorkVersion relation
 * @method     ChildStageWorkQuery rightJoinStageWorkVersion($relationAlias = null) Adds a RIGHT JOIN clause to the query using the StageWorkVersion relation
 * @method     ChildStageWorkQuery innerJoinStageWorkVersion($relationAlias = null) Adds a INNER JOIN clause to the query using the StageWorkVersion relation
 *
 * @method     ChildStageWorkQuery joinWithStageWorkVersion($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the StageWorkVersion relation
 *
 * @method     ChildStageWorkQuery leftJoinWithStageWorkVersion() Adds a LEFT JOIN clause and with to the query using the StageWorkVersion relation
 * @method     ChildStageWorkQuery rightJoinWithStageWorkVersion() Adds a RIGHT JOIN clause and with to the query using the StageWorkVersion relation
 * @method     ChildStageWorkQuery innerJoinWithStageWorkVersion() Adds a INNER JOIN clause and with to the query using the StageWorkVersion relation
 *
 * @method     \DB\StageMaterialQuery|\DB\StageTechnicQuery|\DB\StageWorkVersionQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildStageWork|null findOne(?ConnectionInterface $con = null) Return the first ChildStageWork matching the query
 * @method     ChildStageWork findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildStageWork matching the query, or a new ChildStageWork object populated from the query conditions when no match is found
 *
 * @method     ChildStageWork|null findOneById(int $id) Return the first ChildStageWork filtered by the id column
 * @method     ChildStageWork|null findOneByStageId(int $stage_id) Return the first ChildStageWork filtered by the stage_id column
 * @method     ChildStageWork|null findOneByWorkId(int $work_id) Return the first ChildStageWork filtered by the work_id column
 * @method     ChildStageWork|null findOneByPrice(string $price) Return the first ChildStageWork filtered by the price column
 * @method     ChildStageWork|null findOneByAmount(string $amount) Return the first ChildStageWork filtered by the amount column
 * @method     ChildStageWork|null findOneByIsAvailable(boolean $is_available) Return the first ChildStageWork filtered by the is_available column
 * @method     ChildStageWork|null findOneByVersion(int $version) Return the first ChildStageWork filtered by the version column
 * @method     ChildStageWork|null findOneByVersionCreatedAt(string $version_created_at) Return the first ChildStageWork filtered by the version_created_at column
 * @method     ChildStageWork|null findOneByVersionCreatedBy(string $version_created_by) Return the first ChildStageWork filtered by the version_created_by column
 * @method     ChildStageWork|null findOneByVersionComment(string $version_comment) Return the first ChildStageWork filtered by the version_comment column *

 * @method     ChildStageWork requirePk($key, ?ConnectionInterface $con = null) Return the ChildStageWork by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStageWork requireOne(?ConnectionInterface $con = null) Return the first ChildStageWork matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildStageWork requireOneById(int $id) Return the first ChildStageWork filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStageWork requireOneByStageId(int $stage_id) Return the first ChildStageWork filtered by the stage_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStageWork requireOneByWorkId(int $work_id) Return the first ChildStageWork filtered by the work_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStageWork requireOneByPrice(string $price) Return the first ChildStageWork filtered by the price column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStageWork requireOneByAmount(string $amount) Return the first ChildStageWork filtered by the amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStageWork requireOneByIsAvailable(boolean $is_available) Return the first ChildStageWork filtered by the is_available column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStageWork requireOneByVersion(int $version) Return the first ChildStageWork filtered by the version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStageWork requireOneByVersionCreatedAt(string $version_created_at) Return the first ChildStageWork filtered by the version_created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStageWork requireOneByVersionCreatedBy(string $version_created_by) Return the first ChildStageWork filtered by the version_created_by column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStageWork requireOneByVersionComment(string $version_comment) Return the first ChildStageWork filtered by the version_comment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildStageWork[]|Collection find(?ConnectionInterface $con = null) Return ChildStageWork objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildStageWork> find(?ConnectionInterface $con = null) Return ChildStageWork objects based on current ModelCriteria
 * @method     ChildStageWork[]|Collection findById(int $id) Return ChildStageWork objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildStageWork> findById(int $id) Return ChildStageWork objects filtered by the id column
 * @method     ChildStageWork[]|Collection findByStageId(int $stage_id) Return ChildStageWork objects filtered by the stage_id column
 * @psalm-method Collection&\Traversable<ChildStageWork> findByStageId(int $stage_id) Return ChildStageWork objects filtered by the stage_id column
 * @method     ChildStageWork[]|Collection findByWorkId(int $work_id) Return ChildStageWork objects filtered by the work_id column
 * @psalm-method Collection&\Traversable<ChildStageWork> findByWorkId(int $work_id) Return ChildStageWork objects filtered by the work_id column
 * @method     ChildStageWork[]|Collection findByPrice(string $price) Return ChildStageWork objects filtered by the price column
 * @psalm-method Collection&\Traversable<ChildStageWork> findByPrice(string $price) Return ChildStageWork objects filtered by the price column
 * @method     ChildStageWork[]|Collection findByAmount(string $amount) Return ChildStageWork objects filtered by the amount column
 * @psalm-method Collection&\Traversable<ChildStageWork> findByAmount(string $amount) Return ChildStageWork objects filtered by the amount column
 * @method     ChildStageWork[]|Collection findByIsAvailable(boolean $is_available) Return ChildStageWork objects filtered by the is_available column
 * @psalm-method Collection&\Traversable<ChildStageWork> findByIsAvailable(boolean $is_available) Return ChildStageWork objects filtered by the is_available column
 * @method     ChildStageWork[]|Collection findByVersion(int $version) Return ChildStageWork objects filtered by the version column
 * @psalm-method Collection&\Traversable<ChildStageWork> findByVersion(int $version) Return ChildStageWork objects filtered by the version column
 * @method     ChildStageWork[]|Collection findByVersionCreatedAt(string $version_created_at) Return ChildStageWork objects filtered by the version_created_at column
 * @psalm-method Collection&\Traversable<ChildStageWork> findByVersionCreatedAt(string $version_created_at) Return ChildStageWork objects filtered by the version_created_at column
 * @method     ChildStageWork[]|Collection findByVersionCreatedBy(string $version_created_by) Return ChildStageWork objects filtered by the version_created_by column
 * @psalm-method Collection&\Traversable<ChildStageWork> findByVersionCreatedBy(string $version_created_by) Return ChildStageWork objects filtered by the version_created_by column
 * @method     ChildStageWork[]|Collection findByVersionComment(string $version_comment) Return ChildStageWork objects filtered by the version_comment column
 * @psalm-method Collection&\Traversable<ChildStageWork> findByVersionComment(string $version_comment) Return ChildStageWork objects filtered by the version_comment column
 * @method     ChildStageWork[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildStageWork> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class StageWorkQuery extends ModelCriteria
{

    // versionable behavior

    /**
     * Whether the versioning is enabled
     */
    static $isVersioningEnabled = true;
protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \DB\Base\StageWorkQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\DB\\StageWork', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildStageWorkQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildStageWorkQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildStageWorkQuery) {
            return $criteria;
        }
        $query = new ChildStageWorkQuery();
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
     * @return ChildStageWork|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(StageWorkTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = StageWorkTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildStageWork A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, stage_id, work_id, price, amount, is_available, version, version_created_at, version_created_by, version_comment FROM stage_work WHERE id = :p0';
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
            /** @var ChildStageWork $obj */
            $obj = new ChildStageWork();
            $obj->hydrate($row);
            StageWorkTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildStageWork|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(StageWorkTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(StageWorkTableMap::COL_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(StageWorkTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(StageWorkTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StageWorkTableMap::COL_ID, $id, $comparison);

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
                $this->addUsingAlias(StageWorkTableMap::COL_STAGE_ID, $stageId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($stageId['max'])) {
                $this->addUsingAlias(StageWorkTableMap::COL_STAGE_ID, $stageId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StageWorkTableMap::COL_STAGE_ID, $stageId, $comparison);

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
                $this->addUsingAlias(StageWorkTableMap::COL_WORK_ID, $workId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($workId['max'])) {
                $this->addUsingAlias(StageWorkTableMap::COL_WORK_ID, $workId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StageWorkTableMap::COL_WORK_ID, $workId, $comparison);

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
                $this->addUsingAlias(StageWorkTableMap::COL_PRICE, $price['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($price['max'])) {
                $this->addUsingAlias(StageWorkTableMap::COL_PRICE, $price['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StageWorkTableMap::COL_PRICE, $price, $comparison);

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
                $this->addUsingAlias(StageWorkTableMap::COL_AMOUNT, $amount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($amount['max'])) {
                $this->addUsingAlias(StageWorkTableMap::COL_AMOUNT, $amount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StageWorkTableMap::COL_AMOUNT, $amount, $comparison);

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

        $this->addUsingAlias(StageWorkTableMap::COL_IS_AVAILABLE, $isAvailable, $comparison);

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
                $this->addUsingAlias(StageWorkTableMap::COL_VERSION, $version['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($version['max'])) {
                $this->addUsingAlias(StageWorkTableMap::COL_VERSION, $version['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StageWorkTableMap::COL_VERSION, $version, $comparison);

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
                $this->addUsingAlias(StageWorkTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($versionCreatedAt['max'])) {
                $this->addUsingAlias(StageWorkTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StageWorkTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt, $comparison);

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

        $this->addUsingAlias(StageWorkTableMap::COL_VERSION_CREATED_BY, $versionCreatedBy, $comparison);

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

        $this->addUsingAlias(StageWorkTableMap::COL_VERSION_COMMENT, $versionComment, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \DB\StageMaterial object
     *
     * @param \DB\StageMaterial|ObjectCollection $stageMaterial the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStageMaterial($stageMaterial, ?string $comparison = null)
    {
        if ($stageMaterial instanceof \DB\StageMaterial) {
            $this
                ->addUsingAlias(StageWorkTableMap::COL_ID, $stageMaterial->getStageWorkId(), $comparison);

            return $this;
        } elseif ($stageMaterial instanceof ObjectCollection) {
            $this
                ->useStageMaterialQuery()
                ->filterByPrimaryKeys($stageMaterial->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByStageMaterial() only accepts arguments of type \DB\StageMaterial or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the StageMaterial relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinStageMaterial(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('StageMaterial');

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
            $this->addJoinObject($join, 'StageMaterial');
        }

        return $this;
    }

    /**
     * Use the StageMaterial relation StageMaterial object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\StageMaterialQuery A secondary query class using the current class as primary query
     */
    public function useStageMaterialQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinStageMaterial($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'StageMaterial', '\DB\StageMaterialQuery');
    }

    /**
     * Use the StageMaterial relation StageMaterial object
     *
     * @param callable(\DB\StageMaterialQuery):\DB\StageMaterialQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withStageMaterialQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useStageMaterialQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to StageMaterial table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\StageMaterialQuery The inner query object of the EXISTS statement
     */
    public function useStageMaterialExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('StageMaterial', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to StageMaterial table for a NOT EXISTS query.
     *
     * @see useStageMaterialExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\StageMaterialQuery The inner query object of the NOT EXISTS statement
     */
    public function useStageMaterialNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('StageMaterial', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \DB\StageTechnic object
     *
     * @param \DB\StageTechnic|ObjectCollection $stageTechnic the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStageTechnic($stageTechnic, ?string $comparison = null)
    {
        if ($stageTechnic instanceof \DB\StageTechnic) {
            $this
                ->addUsingAlias(StageWorkTableMap::COL_ID, $stageTechnic->getStageWorkId(), $comparison);

            return $this;
        } elseif ($stageTechnic instanceof ObjectCollection) {
            $this
                ->useStageTechnicQuery()
                ->filterByPrimaryKeys($stageTechnic->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByStageTechnic() only accepts arguments of type \DB\StageTechnic or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the StageTechnic relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinStageTechnic(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('StageTechnic');

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
            $this->addJoinObject($join, 'StageTechnic');
        }

        return $this;
    }

    /**
     * Use the StageTechnic relation StageTechnic object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\StageTechnicQuery A secondary query class using the current class as primary query
     */
    public function useStageTechnicQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinStageTechnic($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'StageTechnic', '\DB\StageTechnicQuery');
    }

    /**
     * Use the StageTechnic relation StageTechnic object
     *
     * @param callable(\DB\StageTechnicQuery):\DB\StageTechnicQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withStageTechnicQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useStageTechnicQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to StageTechnic table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\StageTechnicQuery The inner query object of the EXISTS statement
     */
    public function useStageTechnicExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('StageTechnic', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to StageTechnic table for a NOT EXISTS query.
     *
     * @see useStageTechnicExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\StageTechnicQuery The inner query object of the NOT EXISTS statement
     */
    public function useStageTechnicNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('StageTechnic', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \DB\StageWorkVersion object
     *
     * @param \DB\StageWorkVersion|ObjectCollection $stageWorkVersion the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStageWorkVersion($stageWorkVersion, ?string $comparison = null)
    {
        if ($stageWorkVersion instanceof \DB\StageWorkVersion) {
            $this
                ->addUsingAlias(StageWorkTableMap::COL_ID, $stageWorkVersion->getId(), $comparison);

            return $this;
        } elseif ($stageWorkVersion instanceof ObjectCollection) {
            $this
                ->useStageWorkVersionQuery()
                ->filterByPrimaryKeys($stageWorkVersion->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByStageWorkVersion() only accepts arguments of type \DB\StageWorkVersion or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the StageWorkVersion relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinStageWorkVersion(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('StageWorkVersion');

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
            $this->addJoinObject($join, 'StageWorkVersion');
        }

        return $this;
    }

    /**
     * Use the StageWorkVersion relation StageWorkVersion object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\StageWorkVersionQuery A secondary query class using the current class as primary query
     */
    public function useStageWorkVersionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinStageWorkVersion($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'StageWorkVersion', '\DB\StageWorkVersionQuery');
    }

    /**
     * Use the StageWorkVersion relation StageWorkVersion object
     *
     * @param callable(\DB\StageWorkVersionQuery):\DB\StageWorkVersionQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withStageWorkVersionQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useStageWorkVersionQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to StageWorkVersion table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\StageWorkVersionQuery The inner query object of the EXISTS statement
     */
    public function useStageWorkVersionExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('StageWorkVersion', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to StageWorkVersion table for a NOT EXISTS query.
     *
     * @see useStageWorkVersionExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\StageWorkVersionQuery The inner query object of the NOT EXISTS statement
     */
    public function useStageWorkVersionNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('StageWorkVersion', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Exclude object from result
     *
     * @param ChildStageWork $stageWork Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($stageWork = null)
    {
        if ($stageWork) {
            $this->addUsingAlias(StageWorkTableMap::COL_ID, $stageWork->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the stage_work table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(StageWorkTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            StageWorkTableMap::clearInstancePool();
            StageWorkTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(StageWorkTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(StageWorkTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            StageWorkTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            StageWorkTableMap::clearRelatedInstancePool();

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
