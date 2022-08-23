<?php

namespace DB\Base;

use \Exception;
use \PDO;
use DB\StageTechnic as ChildStageTechnic;
use DB\StageTechnicQuery as ChildStageTechnicQuery;
use DB\Map\StageTechnicTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'stage_technic' table.
 *
 *
 *
 * @method     ChildStageTechnicQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildStageTechnicQuery orderByPrice($order = Criteria::ASC) Order by the price column
 * @method     ChildStageTechnicQuery orderByAmount($order = Criteria::ASC) Order by the amount column
 * @method     ChildStageTechnicQuery orderByIsAvailable($order = Criteria::ASC) Order by the is_available column
 * @method     ChildStageTechnicQuery orderByTechnicId($order = Criteria::ASC) Order by the technic_id column
 * @method     ChildStageTechnicQuery orderByStageWorkId($order = Criteria::ASC) Order by the stage_work_id column
 * @method     ChildStageTechnicQuery orderByVersion($order = Criteria::ASC) Order by the version column
 * @method     ChildStageTechnicQuery orderByVersionCreatedAt($order = Criteria::ASC) Order by the version_created_at column
 * @method     ChildStageTechnicQuery orderByVersionCreatedBy($order = Criteria::ASC) Order by the version_created_by column
 * @method     ChildStageTechnicQuery orderByVersionComment($order = Criteria::ASC) Order by the version_comment column
 *
 * @method     ChildStageTechnicQuery groupById() Group by the id column
 * @method     ChildStageTechnicQuery groupByPrice() Group by the price column
 * @method     ChildStageTechnicQuery groupByAmount() Group by the amount column
 * @method     ChildStageTechnicQuery groupByIsAvailable() Group by the is_available column
 * @method     ChildStageTechnicQuery groupByTechnicId() Group by the technic_id column
 * @method     ChildStageTechnicQuery groupByStageWorkId() Group by the stage_work_id column
 * @method     ChildStageTechnicQuery groupByVersion() Group by the version column
 * @method     ChildStageTechnicQuery groupByVersionCreatedAt() Group by the version_created_at column
 * @method     ChildStageTechnicQuery groupByVersionCreatedBy() Group by the version_created_by column
 * @method     ChildStageTechnicQuery groupByVersionComment() Group by the version_comment column
 *
 * @method     ChildStageTechnicQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildStageTechnicQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildStageTechnicQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildStageTechnicQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildStageTechnicQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildStageTechnicQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildStageTechnicQuery leftJoinStageWork($relationAlias = null) Adds a LEFT JOIN clause to the query using the StageWork relation
 * @method     ChildStageTechnicQuery rightJoinStageWork($relationAlias = null) Adds a RIGHT JOIN clause to the query using the StageWork relation
 * @method     ChildStageTechnicQuery innerJoinStageWork($relationAlias = null) Adds a INNER JOIN clause to the query using the StageWork relation
 *
 * @method     ChildStageTechnicQuery joinWithStageWork($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the StageWork relation
 *
 * @method     ChildStageTechnicQuery leftJoinWithStageWork() Adds a LEFT JOIN clause and with to the query using the StageWork relation
 * @method     ChildStageTechnicQuery rightJoinWithStageWork() Adds a RIGHT JOIN clause and with to the query using the StageWork relation
 * @method     ChildStageTechnicQuery innerJoinWithStageWork() Adds a INNER JOIN clause and with to the query using the StageWork relation
 *
 * @method     ChildStageTechnicQuery leftJoinTechnic($relationAlias = null) Adds a LEFT JOIN clause to the query using the Technic relation
 * @method     ChildStageTechnicQuery rightJoinTechnic($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Technic relation
 * @method     ChildStageTechnicQuery innerJoinTechnic($relationAlias = null) Adds a INNER JOIN clause to the query using the Technic relation
 *
 * @method     ChildStageTechnicQuery joinWithTechnic($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Technic relation
 *
 * @method     ChildStageTechnicQuery leftJoinWithTechnic() Adds a LEFT JOIN clause and with to the query using the Technic relation
 * @method     ChildStageTechnicQuery rightJoinWithTechnic() Adds a RIGHT JOIN clause and with to the query using the Technic relation
 * @method     ChildStageTechnicQuery innerJoinWithTechnic() Adds a INNER JOIN clause and with to the query using the Technic relation
 *
 * @method     ChildStageTechnicQuery leftJoinStageTechnicVersion($relationAlias = null) Adds a LEFT JOIN clause to the query using the StageTechnicVersion relation
 * @method     ChildStageTechnicQuery rightJoinStageTechnicVersion($relationAlias = null) Adds a RIGHT JOIN clause to the query using the StageTechnicVersion relation
 * @method     ChildStageTechnicQuery innerJoinStageTechnicVersion($relationAlias = null) Adds a INNER JOIN clause to the query using the StageTechnicVersion relation
 *
 * @method     ChildStageTechnicQuery joinWithStageTechnicVersion($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the StageTechnicVersion relation
 *
 * @method     ChildStageTechnicQuery leftJoinWithStageTechnicVersion() Adds a LEFT JOIN clause and with to the query using the StageTechnicVersion relation
 * @method     ChildStageTechnicQuery rightJoinWithStageTechnicVersion() Adds a RIGHT JOIN clause and with to the query using the StageTechnicVersion relation
 * @method     ChildStageTechnicQuery innerJoinWithStageTechnicVersion() Adds a INNER JOIN clause and with to the query using the StageTechnicVersion relation
 *
 * @method     \DB\StageWorkQuery|\DB\TechnicQuery|\DB\StageTechnicVersionQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildStageTechnic|null findOne(?ConnectionInterface $con = null) Return the first ChildStageTechnic matching the query
 * @method     ChildStageTechnic findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildStageTechnic matching the query, or a new ChildStageTechnic object populated from the query conditions when no match is found
 *
 * @method     ChildStageTechnic|null findOneById(int $id) Return the first ChildStageTechnic filtered by the id column
 * @method     ChildStageTechnic|null findOneByPrice(string $price) Return the first ChildStageTechnic filtered by the price column
 * @method     ChildStageTechnic|null findOneByAmount(string $amount) Return the first ChildStageTechnic filtered by the amount column
 * @method     ChildStageTechnic|null findOneByIsAvailable(boolean $is_available) Return the first ChildStageTechnic filtered by the is_available column
 * @method     ChildStageTechnic|null findOneByTechnicId(int $technic_id) Return the first ChildStageTechnic filtered by the technic_id column
 * @method     ChildStageTechnic|null findOneByStageWorkId(int $stage_work_id) Return the first ChildStageTechnic filtered by the stage_work_id column
 * @method     ChildStageTechnic|null findOneByVersion(int $version) Return the first ChildStageTechnic filtered by the version column
 * @method     ChildStageTechnic|null findOneByVersionCreatedAt(string $version_created_at) Return the first ChildStageTechnic filtered by the version_created_at column
 * @method     ChildStageTechnic|null findOneByVersionCreatedBy(string $version_created_by) Return the first ChildStageTechnic filtered by the version_created_by column
 * @method     ChildStageTechnic|null findOneByVersionComment(string $version_comment) Return the first ChildStageTechnic filtered by the version_comment column *

 * @method     ChildStageTechnic requirePk($key, ?ConnectionInterface $con = null) Return the ChildStageTechnic by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStageTechnic requireOne(?ConnectionInterface $con = null) Return the first ChildStageTechnic matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildStageTechnic requireOneById(int $id) Return the first ChildStageTechnic filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStageTechnic requireOneByPrice(string $price) Return the first ChildStageTechnic filtered by the price column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStageTechnic requireOneByAmount(string $amount) Return the first ChildStageTechnic filtered by the amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStageTechnic requireOneByIsAvailable(boolean $is_available) Return the first ChildStageTechnic filtered by the is_available column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStageTechnic requireOneByTechnicId(int $technic_id) Return the first ChildStageTechnic filtered by the technic_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStageTechnic requireOneByStageWorkId(int $stage_work_id) Return the first ChildStageTechnic filtered by the stage_work_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStageTechnic requireOneByVersion(int $version) Return the first ChildStageTechnic filtered by the version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStageTechnic requireOneByVersionCreatedAt(string $version_created_at) Return the first ChildStageTechnic filtered by the version_created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStageTechnic requireOneByVersionCreatedBy(string $version_created_by) Return the first ChildStageTechnic filtered by the version_created_by column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStageTechnic requireOneByVersionComment(string $version_comment) Return the first ChildStageTechnic filtered by the version_comment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildStageTechnic[]|Collection find(?ConnectionInterface $con = null) Return ChildStageTechnic objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildStageTechnic> find(?ConnectionInterface $con = null) Return ChildStageTechnic objects based on current ModelCriteria
 * @method     ChildStageTechnic[]|Collection findById(int $id) Return ChildStageTechnic objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildStageTechnic> findById(int $id) Return ChildStageTechnic objects filtered by the id column
 * @method     ChildStageTechnic[]|Collection findByPrice(string $price) Return ChildStageTechnic objects filtered by the price column
 * @psalm-method Collection&\Traversable<ChildStageTechnic> findByPrice(string $price) Return ChildStageTechnic objects filtered by the price column
 * @method     ChildStageTechnic[]|Collection findByAmount(string $amount) Return ChildStageTechnic objects filtered by the amount column
 * @psalm-method Collection&\Traversable<ChildStageTechnic> findByAmount(string $amount) Return ChildStageTechnic objects filtered by the amount column
 * @method     ChildStageTechnic[]|Collection findByIsAvailable(boolean $is_available) Return ChildStageTechnic objects filtered by the is_available column
 * @psalm-method Collection&\Traversable<ChildStageTechnic> findByIsAvailable(boolean $is_available) Return ChildStageTechnic objects filtered by the is_available column
 * @method     ChildStageTechnic[]|Collection findByTechnicId(int $technic_id) Return ChildStageTechnic objects filtered by the technic_id column
 * @psalm-method Collection&\Traversable<ChildStageTechnic> findByTechnicId(int $technic_id) Return ChildStageTechnic objects filtered by the technic_id column
 * @method     ChildStageTechnic[]|Collection findByStageWorkId(int $stage_work_id) Return ChildStageTechnic objects filtered by the stage_work_id column
 * @psalm-method Collection&\Traversable<ChildStageTechnic> findByStageWorkId(int $stage_work_id) Return ChildStageTechnic objects filtered by the stage_work_id column
 * @method     ChildStageTechnic[]|Collection findByVersion(int $version) Return ChildStageTechnic objects filtered by the version column
 * @psalm-method Collection&\Traversable<ChildStageTechnic> findByVersion(int $version) Return ChildStageTechnic objects filtered by the version column
 * @method     ChildStageTechnic[]|Collection findByVersionCreatedAt(string $version_created_at) Return ChildStageTechnic objects filtered by the version_created_at column
 * @psalm-method Collection&\Traversable<ChildStageTechnic> findByVersionCreatedAt(string $version_created_at) Return ChildStageTechnic objects filtered by the version_created_at column
 * @method     ChildStageTechnic[]|Collection findByVersionCreatedBy(string $version_created_by) Return ChildStageTechnic objects filtered by the version_created_by column
 * @psalm-method Collection&\Traversable<ChildStageTechnic> findByVersionCreatedBy(string $version_created_by) Return ChildStageTechnic objects filtered by the version_created_by column
 * @method     ChildStageTechnic[]|Collection findByVersionComment(string $version_comment) Return ChildStageTechnic objects filtered by the version_comment column
 * @psalm-method Collection&\Traversable<ChildStageTechnic> findByVersionComment(string $version_comment) Return ChildStageTechnic objects filtered by the version_comment column
 * @method     ChildStageTechnic[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildStageTechnic> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class StageTechnicQuery extends ModelCriteria
{

    // versionable behavior

    /**
     * Whether the versioning is enabled
     */
    static $isVersioningEnabled = true;
protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \DB\Base\StageTechnicQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\DB\\StageTechnic', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildStageTechnicQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildStageTechnicQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildStageTechnicQuery) {
            return $criteria;
        }
        $query = new ChildStageTechnicQuery();
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
     * @return ChildStageTechnic|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(StageTechnicTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = StageTechnicTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildStageTechnic A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, price, amount, is_available, technic_id, stage_work_id, version, version_created_at, version_created_by, version_comment FROM stage_technic WHERE id = :p0';
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
            /** @var ChildStageTechnic $obj */
            $obj = new ChildStageTechnic();
            $obj->hydrate($row);
            StageTechnicTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildStageTechnic|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(StageTechnicTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(StageTechnicTableMap::COL_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(StageTechnicTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(StageTechnicTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StageTechnicTableMap::COL_ID, $id, $comparison);

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
                $this->addUsingAlias(StageTechnicTableMap::COL_PRICE, $price['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($price['max'])) {
                $this->addUsingAlias(StageTechnicTableMap::COL_PRICE, $price['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StageTechnicTableMap::COL_PRICE, $price, $comparison);

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
                $this->addUsingAlias(StageTechnicTableMap::COL_AMOUNT, $amount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($amount['max'])) {
                $this->addUsingAlias(StageTechnicTableMap::COL_AMOUNT, $amount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StageTechnicTableMap::COL_AMOUNT, $amount, $comparison);

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

        $this->addUsingAlias(StageTechnicTableMap::COL_IS_AVAILABLE, $isAvailable, $comparison);

        return $this;
    }

    /**
     * Filter the query on the technic_id column
     *
     * Example usage:
     * <code>
     * $query->filterByTechnicId(1234); // WHERE technic_id = 1234
     * $query->filterByTechnicId(array(12, 34)); // WHERE technic_id IN (12, 34)
     * $query->filterByTechnicId(array('min' => 12)); // WHERE technic_id > 12
     * </code>
     *
     * @see       filterByTechnic()
     *
     * @param mixed $technicId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTechnicId($technicId = null, ?string $comparison = null)
    {
        if (is_array($technicId)) {
            $useMinMax = false;
            if (isset($technicId['min'])) {
                $this->addUsingAlias(StageTechnicTableMap::COL_TECHNIC_ID, $technicId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($technicId['max'])) {
                $this->addUsingAlias(StageTechnicTableMap::COL_TECHNIC_ID, $technicId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StageTechnicTableMap::COL_TECHNIC_ID, $technicId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the stage_work_id column
     *
     * Example usage:
     * <code>
     * $query->filterByStageWorkId(1234); // WHERE stage_work_id = 1234
     * $query->filterByStageWorkId(array(12, 34)); // WHERE stage_work_id IN (12, 34)
     * $query->filterByStageWorkId(array('min' => 12)); // WHERE stage_work_id > 12
     * </code>
     *
     * @see       filterByStageWork()
     *
     * @param mixed $stageWorkId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStageWorkId($stageWorkId = null, ?string $comparison = null)
    {
        if (is_array($stageWorkId)) {
            $useMinMax = false;
            if (isset($stageWorkId['min'])) {
                $this->addUsingAlias(StageTechnicTableMap::COL_STAGE_WORK_ID, $stageWorkId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($stageWorkId['max'])) {
                $this->addUsingAlias(StageTechnicTableMap::COL_STAGE_WORK_ID, $stageWorkId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StageTechnicTableMap::COL_STAGE_WORK_ID, $stageWorkId, $comparison);

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
                $this->addUsingAlias(StageTechnicTableMap::COL_VERSION, $version['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($version['max'])) {
                $this->addUsingAlias(StageTechnicTableMap::COL_VERSION, $version['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StageTechnicTableMap::COL_VERSION, $version, $comparison);

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
                $this->addUsingAlias(StageTechnicTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($versionCreatedAt['max'])) {
                $this->addUsingAlias(StageTechnicTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StageTechnicTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt, $comparison);

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

        $this->addUsingAlias(StageTechnicTableMap::COL_VERSION_CREATED_BY, $versionCreatedBy, $comparison);

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

        $this->addUsingAlias(StageTechnicTableMap::COL_VERSION_COMMENT, $versionComment, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \DB\StageWork object
     *
     * @param \DB\StageWork|ObjectCollection $stageWork The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStageWork($stageWork, ?string $comparison = null)
    {
        if ($stageWork instanceof \DB\StageWork) {
            return $this
                ->addUsingAlias(StageTechnicTableMap::COL_STAGE_WORK_ID, $stageWork->getId(), $comparison);
        } elseif ($stageWork instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(StageTechnicTableMap::COL_STAGE_WORK_ID, $stageWork->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByStageWork() only accepts arguments of type \DB\StageWork or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the StageWork relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinStageWork(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('StageWork');

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
            $this->addJoinObject($join, 'StageWork');
        }

        return $this;
    }

    /**
     * Use the StageWork relation StageWork object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\StageWorkQuery A secondary query class using the current class as primary query
     */
    public function useStageWorkQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinStageWork($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'StageWork', '\DB\StageWorkQuery');
    }

    /**
     * Use the StageWork relation StageWork object
     *
     * @param callable(\DB\StageWorkQuery):\DB\StageWorkQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withStageWorkQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useStageWorkQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to StageWork table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\StageWorkQuery The inner query object of the EXISTS statement
     */
    public function useStageWorkExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('StageWork', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to StageWork table for a NOT EXISTS query.
     *
     * @see useStageWorkExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\StageWorkQuery The inner query object of the NOT EXISTS statement
     */
    public function useStageWorkNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('StageWork', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \DB\Technic object
     *
     * @param \DB\Technic|ObjectCollection $technic The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTechnic($technic, ?string $comparison = null)
    {
        if ($technic instanceof \DB\Technic) {
            return $this
                ->addUsingAlias(StageTechnicTableMap::COL_TECHNIC_ID, $technic->getId(), $comparison);
        } elseif ($technic instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(StageTechnicTableMap::COL_TECHNIC_ID, $technic->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByTechnic() only accepts arguments of type \DB\Technic or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Technic relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinTechnic(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Technic');

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
            $this->addJoinObject($join, 'Technic');
        }

        return $this;
    }

    /**
     * Use the Technic relation Technic object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\TechnicQuery A secondary query class using the current class as primary query
     */
    public function useTechnicQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTechnic($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Technic', '\DB\TechnicQuery');
    }

    /**
     * Use the Technic relation Technic object
     *
     * @param callable(\DB\TechnicQuery):\DB\TechnicQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withTechnicQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useTechnicQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to Technic table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\TechnicQuery The inner query object of the EXISTS statement
     */
    public function useTechnicExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('Technic', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to Technic table for a NOT EXISTS query.
     *
     * @see useTechnicExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\TechnicQuery The inner query object of the NOT EXISTS statement
     */
    public function useTechnicNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('Technic', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \DB\StageTechnicVersion object
     *
     * @param \DB\StageTechnicVersion|ObjectCollection $stageTechnicVersion the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStageTechnicVersion($stageTechnicVersion, ?string $comparison = null)
    {
        if ($stageTechnicVersion instanceof \DB\StageTechnicVersion) {
            $this
                ->addUsingAlias(StageTechnicTableMap::COL_ID, $stageTechnicVersion->getId(), $comparison);

            return $this;
        } elseif ($stageTechnicVersion instanceof ObjectCollection) {
            $this
                ->useStageTechnicVersionQuery()
                ->filterByPrimaryKeys($stageTechnicVersion->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByStageTechnicVersion() only accepts arguments of type \DB\StageTechnicVersion or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the StageTechnicVersion relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinStageTechnicVersion(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('StageTechnicVersion');

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
            $this->addJoinObject($join, 'StageTechnicVersion');
        }

        return $this;
    }

    /**
     * Use the StageTechnicVersion relation StageTechnicVersion object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\StageTechnicVersionQuery A secondary query class using the current class as primary query
     */
    public function useStageTechnicVersionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinStageTechnicVersion($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'StageTechnicVersion', '\DB\StageTechnicVersionQuery');
    }

    /**
     * Use the StageTechnicVersion relation StageTechnicVersion object
     *
     * @param callable(\DB\StageTechnicVersionQuery):\DB\StageTechnicVersionQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withStageTechnicVersionQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useStageTechnicVersionQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to StageTechnicVersion table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\StageTechnicVersionQuery The inner query object of the EXISTS statement
     */
    public function useStageTechnicVersionExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('StageTechnicVersion', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to StageTechnicVersion table for a NOT EXISTS query.
     *
     * @see useStageTechnicVersionExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\StageTechnicVersionQuery The inner query object of the NOT EXISTS statement
     */
    public function useStageTechnicVersionNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('StageTechnicVersion', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Exclude object from result
     *
     * @param ChildStageTechnic $stageTechnic Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($stageTechnic = null)
    {
        if ($stageTechnic) {
            $this->addUsingAlias(StageTechnicTableMap::COL_ID, $stageTechnic->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the stage_technic table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(StageTechnicTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            StageTechnicTableMap::clearInstancePool();
            StageTechnicTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(StageTechnicTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(StageTechnicTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            StageTechnicTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            StageTechnicTableMap::clearRelatedInstancePool();

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
