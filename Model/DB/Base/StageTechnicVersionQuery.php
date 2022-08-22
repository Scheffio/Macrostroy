<?php

namespace DB\Base;

use \Exception;
use \PDO;
use DB\StageTechnicVersion as ChildStageTechnicVersion;
use DB\StageTechnicVersionQuery as ChildStageTechnicVersionQuery;
use DB\Map\StageTechnicVersionTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'stage_technic_version' table.
 *
 *
 *
 * @method     ChildStageTechnicVersionQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildStageTechnicVersionQuery orderByPrice($order = Criteria::ASC) Order by the price column
 * @method     ChildStageTechnicVersionQuery orderByAmount($order = Criteria::ASC) Order by the amount column
 * @method     ChildStageTechnicVersionQuery orderByIsAvailable($order = Criteria::ASC) Order by the is_available column
 * @method     ChildStageTechnicVersionQuery orderByTechnicId($order = Criteria::ASC) Order by the technic_id column
 * @method     ChildStageTechnicVersionQuery orderByStageWorkId($order = Criteria::ASC) Order by the stage_work_id column
 * @method     ChildStageTechnicVersionQuery orderByVersion($order = Criteria::ASC) Order by the version column
 * @method     ChildStageTechnicVersionQuery orderByVersionCreatedAt($order = Criteria::ASC) Order by the version_created_at column
 * @method     ChildStageTechnicVersionQuery orderByVersionCreatedBy($order = Criteria::ASC) Order by the version_created_by column
 * @method     ChildStageTechnicVersionQuery orderByVersionComment($order = Criteria::ASC) Order by the version_comment column
 * @method     ChildStageTechnicVersionQuery orderByStageWorkIdVersion($order = Criteria::ASC) Order by the stage_work_id_version column
 * @method     ChildStageTechnicVersionQuery orderByTechnicIdVersion($order = Criteria::ASC) Order by the technic_id_version column
 *
 * @method     ChildStageTechnicVersionQuery groupById() Group by the id column
 * @method     ChildStageTechnicVersionQuery groupByPrice() Group by the price column
 * @method     ChildStageTechnicVersionQuery groupByAmount() Group by the amount column
 * @method     ChildStageTechnicVersionQuery groupByIsAvailable() Group by the is_available column
 * @method     ChildStageTechnicVersionQuery groupByTechnicId() Group by the technic_id column
 * @method     ChildStageTechnicVersionQuery groupByStageWorkId() Group by the stage_work_id column
 * @method     ChildStageTechnicVersionQuery groupByVersion() Group by the version column
 * @method     ChildStageTechnicVersionQuery groupByVersionCreatedAt() Group by the version_created_at column
 * @method     ChildStageTechnicVersionQuery groupByVersionCreatedBy() Group by the version_created_by column
 * @method     ChildStageTechnicVersionQuery groupByVersionComment() Group by the version_comment column
 * @method     ChildStageTechnicVersionQuery groupByStageWorkIdVersion() Group by the stage_work_id_version column
 * @method     ChildStageTechnicVersionQuery groupByTechnicIdVersion() Group by the technic_id_version column
 *
 * @method     ChildStageTechnicVersionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildStageTechnicVersionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildStageTechnicVersionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildStageTechnicVersionQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildStageTechnicVersionQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildStageTechnicVersionQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildStageTechnicVersionQuery leftJoinStageTechnic($relationAlias = null) Adds a LEFT JOIN clause to the query using the StageTechnic relation
 * @method     ChildStageTechnicVersionQuery rightJoinStageTechnic($relationAlias = null) Adds a RIGHT JOIN clause to the query using the StageTechnic relation
 * @method     ChildStageTechnicVersionQuery innerJoinStageTechnic($relationAlias = null) Adds a INNER JOIN clause to the query using the StageTechnic relation
 *
 * @method     ChildStageTechnicVersionQuery joinWithStageTechnic($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the StageTechnic relation
 *
 * @method     ChildStageTechnicVersionQuery leftJoinWithStageTechnic() Adds a LEFT JOIN clause and with to the query using the StageTechnic relation
 * @method     ChildStageTechnicVersionQuery rightJoinWithStageTechnic() Adds a RIGHT JOIN clause and with to the query using the StageTechnic relation
 * @method     ChildStageTechnicVersionQuery innerJoinWithStageTechnic() Adds a INNER JOIN clause and with to the query using the StageTechnic relation
 *
 * @method     \DB\StageTechnicQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildStageTechnicVersion|null findOne(?ConnectionInterface $con = null) Return the first ChildStageTechnicVersion matching the query
 * @method     ChildStageTechnicVersion findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildStageTechnicVersion matching the query, or a new ChildStageTechnicVersion object populated from the query conditions when no match is found
 *
 * @method     ChildStageTechnicVersion|null findOneById(int $id) Return the first ChildStageTechnicVersion filtered by the id column
 * @method     ChildStageTechnicVersion|null findOneByPrice(string $price) Return the first ChildStageTechnicVersion filtered by the price column
 * @method     ChildStageTechnicVersion|null findOneByAmount(string $amount) Return the first ChildStageTechnicVersion filtered by the amount column
 * @method     ChildStageTechnicVersion|null findOneByIsAvailable(boolean $is_available) Return the first ChildStageTechnicVersion filtered by the is_available column
 * @method     ChildStageTechnicVersion|null findOneByTechnicId(int $technic_id) Return the first ChildStageTechnicVersion filtered by the technic_id column
 * @method     ChildStageTechnicVersion|null findOneByStageWorkId(int $stage_work_id) Return the first ChildStageTechnicVersion filtered by the stage_work_id column
 * @method     ChildStageTechnicVersion|null findOneByVersion(int $version) Return the first ChildStageTechnicVersion filtered by the version column
 * @method     ChildStageTechnicVersion|null findOneByVersionCreatedAt(string $version_created_at) Return the first ChildStageTechnicVersion filtered by the version_created_at column
 * @method     ChildStageTechnicVersion|null findOneByVersionCreatedBy(string $version_created_by) Return the first ChildStageTechnicVersion filtered by the version_created_by column
 * @method     ChildStageTechnicVersion|null findOneByVersionComment(string $version_comment) Return the first ChildStageTechnicVersion filtered by the version_comment column
 * @method     ChildStageTechnicVersion|null findOneByStageWorkIdVersion(int $stage_work_id_version) Return the first ChildStageTechnicVersion filtered by the stage_work_id_version column
 * @method     ChildStageTechnicVersion|null findOneByTechnicIdVersion(int $technic_id_version) Return the first ChildStageTechnicVersion filtered by the technic_id_version column *

 * @method     ChildStageTechnicVersion requirePk($key, ?ConnectionInterface $con = null) Return the ChildStageTechnicVersion by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStageTechnicVersion requireOne(?ConnectionInterface $con = null) Return the first ChildStageTechnicVersion matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildStageTechnicVersion requireOneById(int $id) Return the first ChildStageTechnicVersion filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStageTechnicVersion requireOneByPrice(string $price) Return the first ChildStageTechnicVersion filtered by the price column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStageTechnicVersion requireOneByAmount(string $amount) Return the first ChildStageTechnicVersion filtered by the amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStageTechnicVersion requireOneByIsAvailable(boolean $is_available) Return the first ChildStageTechnicVersion filtered by the is_available column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStageTechnicVersion requireOneByTechnicId(int $technic_id) Return the first ChildStageTechnicVersion filtered by the technic_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStageTechnicVersion requireOneByStageWorkId(int $stage_work_id) Return the first ChildStageTechnicVersion filtered by the stage_work_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStageTechnicVersion requireOneByVersion(int $version) Return the first ChildStageTechnicVersion filtered by the version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStageTechnicVersion requireOneByVersionCreatedAt(string $version_created_at) Return the first ChildStageTechnicVersion filtered by the version_created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStageTechnicVersion requireOneByVersionCreatedBy(string $version_created_by) Return the first ChildStageTechnicVersion filtered by the version_created_by column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStageTechnicVersion requireOneByVersionComment(string $version_comment) Return the first ChildStageTechnicVersion filtered by the version_comment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStageTechnicVersion requireOneByStageWorkIdVersion(int $stage_work_id_version) Return the first ChildStageTechnicVersion filtered by the stage_work_id_version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStageTechnicVersion requireOneByTechnicIdVersion(int $technic_id_version) Return the first ChildStageTechnicVersion filtered by the technic_id_version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildStageTechnicVersion[]|Collection find(?ConnectionInterface $con = null) Return ChildStageTechnicVersion objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildStageTechnicVersion> find(?ConnectionInterface $con = null) Return ChildStageTechnicVersion objects based on current ModelCriteria
 * @method     ChildStageTechnicVersion[]|Collection findById(int $id) Return ChildStageTechnicVersion objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildStageTechnicVersion> findById(int $id) Return ChildStageTechnicVersion objects filtered by the id column
 * @method     ChildStageTechnicVersion[]|Collection findByPrice(string $price) Return ChildStageTechnicVersion objects filtered by the price column
 * @psalm-method Collection&\Traversable<ChildStageTechnicVersion> findByPrice(string $price) Return ChildStageTechnicVersion objects filtered by the price column
 * @method     ChildStageTechnicVersion[]|Collection findByAmount(string $amount) Return ChildStageTechnicVersion objects filtered by the amount column
 * @psalm-method Collection&\Traversable<ChildStageTechnicVersion> findByAmount(string $amount) Return ChildStageTechnicVersion objects filtered by the amount column
 * @method     ChildStageTechnicVersion[]|Collection findByIsAvailable(boolean $is_available) Return ChildStageTechnicVersion objects filtered by the is_available column
 * @psalm-method Collection&\Traversable<ChildStageTechnicVersion> findByIsAvailable(boolean $is_available) Return ChildStageTechnicVersion objects filtered by the is_available column
 * @method     ChildStageTechnicVersion[]|Collection findByTechnicId(int $technic_id) Return ChildStageTechnicVersion objects filtered by the technic_id column
 * @psalm-method Collection&\Traversable<ChildStageTechnicVersion> findByTechnicId(int $technic_id) Return ChildStageTechnicVersion objects filtered by the technic_id column
 * @method     ChildStageTechnicVersion[]|Collection findByStageWorkId(int $stage_work_id) Return ChildStageTechnicVersion objects filtered by the stage_work_id column
 * @psalm-method Collection&\Traversable<ChildStageTechnicVersion> findByStageWorkId(int $stage_work_id) Return ChildStageTechnicVersion objects filtered by the stage_work_id column
 * @method     ChildStageTechnicVersion[]|Collection findByVersion(int $version) Return ChildStageTechnicVersion objects filtered by the version column
 * @psalm-method Collection&\Traversable<ChildStageTechnicVersion> findByVersion(int $version) Return ChildStageTechnicVersion objects filtered by the version column
 * @method     ChildStageTechnicVersion[]|Collection findByVersionCreatedAt(string $version_created_at) Return ChildStageTechnicVersion objects filtered by the version_created_at column
 * @psalm-method Collection&\Traversable<ChildStageTechnicVersion> findByVersionCreatedAt(string $version_created_at) Return ChildStageTechnicVersion objects filtered by the version_created_at column
 * @method     ChildStageTechnicVersion[]|Collection findByVersionCreatedBy(string $version_created_by) Return ChildStageTechnicVersion objects filtered by the version_created_by column
 * @psalm-method Collection&\Traversable<ChildStageTechnicVersion> findByVersionCreatedBy(string $version_created_by) Return ChildStageTechnicVersion objects filtered by the version_created_by column
 * @method     ChildStageTechnicVersion[]|Collection findByVersionComment(string $version_comment) Return ChildStageTechnicVersion objects filtered by the version_comment column
 * @psalm-method Collection&\Traversable<ChildStageTechnicVersion> findByVersionComment(string $version_comment) Return ChildStageTechnicVersion objects filtered by the version_comment column
 * @method     ChildStageTechnicVersion[]|Collection findByStageWorkIdVersion(int $stage_work_id_version) Return ChildStageTechnicVersion objects filtered by the stage_work_id_version column
 * @psalm-method Collection&\Traversable<ChildStageTechnicVersion> findByStageWorkIdVersion(int $stage_work_id_version) Return ChildStageTechnicVersion objects filtered by the stage_work_id_version column
 * @method     ChildStageTechnicVersion[]|Collection findByTechnicIdVersion(int $technic_id_version) Return ChildStageTechnicVersion objects filtered by the technic_id_version column
 * @psalm-method Collection&\Traversable<ChildStageTechnicVersion> findByTechnicIdVersion(int $technic_id_version) Return ChildStageTechnicVersion objects filtered by the technic_id_version column
 * @method     ChildStageTechnicVersion[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildStageTechnicVersion> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class StageTechnicVersionQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \DB\Base\StageTechnicVersionQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\DB\\StageTechnicVersion', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildStageTechnicVersionQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildStageTechnicVersionQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildStageTechnicVersionQuery) {
            return $criteria;
        }
        $query = new ChildStageTechnicVersionQuery();
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
     * @return ChildStageTechnicVersion|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(StageTechnicVersionTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = StageTechnicVersionTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildStageTechnicVersion A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, price, amount, is_available, technic_id, stage_work_id, version, version_created_at, version_created_by, version_comment, stage_work_id_version, technic_id_version FROM stage_technic_version WHERE id = :p0 AND version = :p1';
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
            /** @var ChildStageTechnicVersion $obj */
            $obj = new ChildStageTechnicVersion();
            $obj->hydrate($row);
            StageTechnicVersionTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildStageTechnicVersion|array|mixed the result, formatted by the current formatter
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
        $this->addUsingAlias(StageTechnicVersionTableMap::COL_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(StageTechnicVersionTableMap::COL_VERSION, $key[1], Criteria::EQUAL);

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
            $cton0 = $this->getNewCriterion(StageTechnicVersionTableMap::COL_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(StageTechnicVersionTableMap::COL_VERSION, $key[1], Criteria::EQUAL);
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
     * @see       filterByStageTechnic()
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
                $this->addUsingAlias(StageTechnicVersionTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(StageTechnicVersionTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StageTechnicVersionTableMap::COL_ID, $id, $comparison);

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
                $this->addUsingAlias(StageTechnicVersionTableMap::COL_PRICE, $price['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($price['max'])) {
                $this->addUsingAlias(StageTechnicVersionTableMap::COL_PRICE, $price['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StageTechnicVersionTableMap::COL_PRICE, $price, $comparison);

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
                $this->addUsingAlias(StageTechnicVersionTableMap::COL_AMOUNT, $amount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($amount['max'])) {
                $this->addUsingAlias(StageTechnicVersionTableMap::COL_AMOUNT, $amount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StageTechnicVersionTableMap::COL_AMOUNT, $amount, $comparison);

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

        $this->addUsingAlias(StageTechnicVersionTableMap::COL_IS_AVAILABLE, $isAvailable, $comparison);

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
                $this->addUsingAlias(StageTechnicVersionTableMap::COL_TECHNIC_ID, $technicId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($technicId['max'])) {
                $this->addUsingAlias(StageTechnicVersionTableMap::COL_TECHNIC_ID, $technicId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StageTechnicVersionTableMap::COL_TECHNIC_ID, $technicId, $comparison);

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
                $this->addUsingAlias(StageTechnicVersionTableMap::COL_STAGE_WORK_ID, $stageWorkId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($stageWorkId['max'])) {
                $this->addUsingAlias(StageTechnicVersionTableMap::COL_STAGE_WORK_ID, $stageWorkId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StageTechnicVersionTableMap::COL_STAGE_WORK_ID, $stageWorkId, $comparison);

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
                $this->addUsingAlias(StageTechnicVersionTableMap::COL_VERSION, $version['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($version['max'])) {
                $this->addUsingAlias(StageTechnicVersionTableMap::COL_VERSION, $version['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StageTechnicVersionTableMap::COL_VERSION, $version, $comparison);

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
                $this->addUsingAlias(StageTechnicVersionTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($versionCreatedAt['max'])) {
                $this->addUsingAlias(StageTechnicVersionTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StageTechnicVersionTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt, $comparison);

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

        $this->addUsingAlias(StageTechnicVersionTableMap::COL_VERSION_CREATED_BY, $versionCreatedBy, $comparison);

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

        $this->addUsingAlias(StageTechnicVersionTableMap::COL_VERSION_COMMENT, $versionComment, $comparison);

        return $this;
    }

    /**
     * Filter the query on the stage_work_id_version column
     *
     * Example usage:
     * <code>
     * $query->filterByStageWorkIdVersion(1234); // WHERE stage_work_id_version = 1234
     * $query->filterByStageWorkIdVersion(array(12, 34)); // WHERE stage_work_id_version IN (12, 34)
     * $query->filterByStageWorkIdVersion(array('min' => 12)); // WHERE stage_work_id_version > 12
     * </code>
     *
     * @param mixed $stageWorkIdVersion The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStageWorkIdVersion($stageWorkIdVersion = null, ?string $comparison = null)
    {
        if (is_array($stageWorkIdVersion)) {
            $useMinMax = false;
            if (isset($stageWorkIdVersion['min'])) {
                $this->addUsingAlias(StageTechnicVersionTableMap::COL_STAGE_WORK_ID_VERSION, $stageWorkIdVersion['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($stageWorkIdVersion['max'])) {
                $this->addUsingAlias(StageTechnicVersionTableMap::COL_STAGE_WORK_ID_VERSION, $stageWorkIdVersion['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StageTechnicVersionTableMap::COL_STAGE_WORK_ID_VERSION, $stageWorkIdVersion, $comparison);

        return $this;
    }

    /**
     * Filter the query on the technic_id_version column
     *
     * Example usage:
     * <code>
     * $query->filterByTechnicIdVersion(1234); // WHERE technic_id_version = 1234
     * $query->filterByTechnicIdVersion(array(12, 34)); // WHERE technic_id_version IN (12, 34)
     * $query->filterByTechnicIdVersion(array('min' => 12)); // WHERE technic_id_version > 12
     * </code>
     *
     * @param mixed $technicIdVersion The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTechnicIdVersion($technicIdVersion = null, ?string $comparison = null)
    {
        if (is_array($technicIdVersion)) {
            $useMinMax = false;
            if (isset($technicIdVersion['min'])) {
                $this->addUsingAlias(StageTechnicVersionTableMap::COL_TECHNIC_ID_VERSION, $technicIdVersion['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($technicIdVersion['max'])) {
                $this->addUsingAlias(StageTechnicVersionTableMap::COL_TECHNIC_ID_VERSION, $technicIdVersion['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StageTechnicVersionTableMap::COL_TECHNIC_ID_VERSION, $technicIdVersion, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \DB\StageTechnic object
     *
     * @param \DB\StageTechnic|ObjectCollection $stageTechnic The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStageTechnic($stageTechnic, ?string $comparison = null)
    {
        if ($stageTechnic instanceof \DB\StageTechnic) {
            return $this
                ->addUsingAlias(StageTechnicVersionTableMap::COL_ID, $stageTechnic->getId(), $comparison);
        } elseif ($stageTechnic instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(StageTechnicVersionTableMap::COL_ID, $stageTechnic->toKeyValue('PrimaryKey', 'Id'), $comparison);

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
     * Exclude object from result
     *
     * @param ChildStageTechnicVersion $stageTechnicVersion Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($stageTechnicVersion = null)
    {
        if ($stageTechnicVersion) {
            $this->addCond('pruneCond0', $this->getAliasedColName(StageTechnicVersionTableMap::COL_ID), $stageTechnicVersion->getId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(StageTechnicVersionTableMap::COL_VERSION), $stageTechnicVersion->getVersion(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the stage_technic_version table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(StageTechnicVersionTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            StageTechnicVersionTableMap::clearInstancePool();
            StageTechnicVersionTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(StageTechnicVersionTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(StageTechnicVersionTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            StageTechnicVersionTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            StageTechnicVersionTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
