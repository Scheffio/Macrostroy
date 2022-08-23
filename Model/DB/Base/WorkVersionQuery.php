<?php

namespace DB\Base;

use \Exception;
use \PDO;
use DB\WorkVersion as ChildWorkVersion;
use DB\WorkVersionQuery as ChildWorkVersionQuery;
use DB\Map\WorkVersionTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'work_version' table.
 *
 *
 *
 * @method     ChildWorkVersionQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildWorkVersionQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildWorkVersionQuery orderByPrice($order = Criteria::ASC) Order by the price column
 * @method     ChildWorkVersionQuery orderByAmount($order = Criteria::ASC) Order by the amount column
 * @method     ChildWorkVersionQuery orderByIsAvailable($order = Criteria::ASC) Order by the is_available column
 * @method     ChildWorkVersionQuery orderByUnitId($order = Criteria::ASC) Order by the unit_id column
 * @method     ChildWorkVersionQuery orderByVersion($order = Criteria::ASC) Order by the version column
 * @method     ChildWorkVersionQuery orderByVersionCreatedAt($order = Criteria::ASC) Order by the version_created_at column
 * @method     ChildWorkVersionQuery orderByVersionCreatedBy($order = Criteria::ASC) Order by the version_created_by column
 * @method     ChildWorkVersionQuery orderByVersionComment($order = Criteria::ASC) Order by the version_comment column
 * @method     ChildWorkVersionQuery orderByWorkMaterialIds($order = Criteria::ASC) Order by the work_material_ids column
 * @method     ChildWorkVersionQuery orderByWorkMaterialVersions($order = Criteria::ASC) Order by the work_material_versions column
 * @method     ChildWorkVersionQuery orderByWorkTechnicIds($order = Criteria::ASC) Order by the work_technic_ids column
 * @method     ChildWorkVersionQuery orderByWorkTechnicVersions($order = Criteria::ASC) Order by the work_technic_versions column
 *
 * @method     ChildWorkVersionQuery groupById() Group by the id column
 * @method     ChildWorkVersionQuery groupByName() Group by the name column
 * @method     ChildWorkVersionQuery groupByPrice() Group by the price column
 * @method     ChildWorkVersionQuery groupByAmount() Group by the amount column
 * @method     ChildWorkVersionQuery groupByIsAvailable() Group by the is_available column
 * @method     ChildWorkVersionQuery groupByUnitId() Group by the unit_id column
 * @method     ChildWorkVersionQuery groupByVersion() Group by the version column
 * @method     ChildWorkVersionQuery groupByVersionCreatedAt() Group by the version_created_at column
 * @method     ChildWorkVersionQuery groupByVersionCreatedBy() Group by the version_created_by column
 * @method     ChildWorkVersionQuery groupByVersionComment() Group by the version_comment column
 * @method     ChildWorkVersionQuery groupByWorkMaterialIds() Group by the work_material_ids column
 * @method     ChildWorkVersionQuery groupByWorkMaterialVersions() Group by the work_material_versions column
 * @method     ChildWorkVersionQuery groupByWorkTechnicIds() Group by the work_technic_ids column
 * @method     ChildWorkVersionQuery groupByWorkTechnicVersions() Group by the work_technic_versions column
 *
 * @method     ChildWorkVersionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildWorkVersionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildWorkVersionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildWorkVersionQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildWorkVersionQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildWorkVersionQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildWorkVersionQuery leftJoinWork($relationAlias = null) Adds a LEFT JOIN clause to the query using the Work relation
 * @method     ChildWorkVersionQuery rightJoinWork($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Work relation
 * @method     ChildWorkVersionQuery innerJoinWork($relationAlias = null) Adds a INNER JOIN clause to the query using the Work relation
 *
 * @method     ChildWorkVersionQuery joinWithWork($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Work relation
 *
 * @method     ChildWorkVersionQuery leftJoinWithWork() Adds a LEFT JOIN clause and with to the query using the Work relation
 * @method     ChildWorkVersionQuery rightJoinWithWork() Adds a RIGHT JOIN clause and with to the query using the Work relation
 * @method     ChildWorkVersionQuery innerJoinWithWork() Adds a INNER JOIN clause and with to the query using the Work relation
 *
 * @method     \DB\WorkQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildWorkVersion|null findOne(?ConnectionInterface $con = null) Return the first ChildWorkVersion matching the query
 * @method     ChildWorkVersion findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildWorkVersion matching the query, or a new ChildWorkVersion object populated from the query conditions when no match is found
 *
 * @method     ChildWorkVersion|null findOneById(int $id) Return the first ChildWorkVersion filtered by the id column
 * @method     ChildWorkVersion|null findOneByName(string $name) Return the first ChildWorkVersion filtered by the name column
 * @method     ChildWorkVersion|null findOneByPrice(string $price) Return the first ChildWorkVersion filtered by the price column
 * @method     ChildWorkVersion|null findOneByAmount(string $amount) Return the first ChildWorkVersion filtered by the amount column
 * @method     ChildWorkVersion|null findOneByIsAvailable(boolean $is_available) Return the first ChildWorkVersion filtered by the is_available column
 * @method     ChildWorkVersion|null findOneByUnitId(int $unit_id) Return the first ChildWorkVersion filtered by the unit_id column
 * @method     ChildWorkVersion|null findOneByVersion(int $version) Return the first ChildWorkVersion filtered by the version column
 * @method     ChildWorkVersion|null findOneByVersionCreatedAt(string $version_created_at) Return the first ChildWorkVersion filtered by the version_created_at column
 * @method     ChildWorkVersion|null findOneByVersionCreatedBy(string $version_created_by) Return the first ChildWorkVersion filtered by the version_created_by column
 * @method     ChildWorkVersion|null findOneByVersionComment(string $version_comment) Return the first ChildWorkVersion filtered by the version_comment column
 * @method     ChildWorkVersion|null findOneByWorkMaterialIds(array $work_material_ids) Return the first ChildWorkVersion filtered by the work_material_ids column
 * @method     ChildWorkVersion|null findOneByWorkMaterialVersions(array $work_material_versions) Return the first ChildWorkVersion filtered by the work_material_versions column
 * @method     ChildWorkVersion|null findOneByWorkTechnicIds(array $work_technic_ids) Return the first ChildWorkVersion filtered by the work_technic_ids column
 * @method     ChildWorkVersion|null findOneByWorkTechnicVersions(array $work_technic_versions) Return the first ChildWorkVersion filtered by the work_technic_versions column *

 * @method     ChildWorkVersion requirePk($key, ?ConnectionInterface $con = null) Return the ChildWorkVersion by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWorkVersion requireOne(?ConnectionInterface $con = null) Return the first ChildWorkVersion matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWorkVersion requireOneById(int $id) Return the first ChildWorkVersion filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWorkVersion requireOneByName(string $name) Return the first ChildWorkVersion filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWorkVersion requireOneByPrice(string $price) Return the first ChildWorkVersion filtered by the price column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWorkVersion requireOneByAmount(string $amount) Return the first ChildWorkVersion filtered by the amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWorkVersion requireOneByIsAvailable(boolean $is_available) Return the first ChildWorkVersion filtered by the is_available column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWorkVersion requireOneByUnitId(int $unit_id) Return the first ChildWorkVersion filtered by the unit_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWorkVersion requireOneByVersion(int $version) Return the first ChildWorkVersion filtered by the version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWorkVersion requireOneByVersionCreatedAt(string $version_created_at) Return the first ChildWorkVersion filtered by the version_created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWorkVersion requireOneByVersionCreatedBy(string $version_created_by) Return the first ChildWorkVersion filtered by the version_created_by column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWorkVersion requireOneByVersionComment(string $version_comment) Return the first ChildWorkVersion filtered by the version_comment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWorkVersion requireOneByWorkMaterialIds(array $work_material_ids) Return the first ChildWorkVersion filtered by the work_material_ids column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWorkVersion requireOneByWorkMaterialVersions(array $work_material_versions) Return the first ChildWorkVersion filtered by the work_material_versions column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWorkVersion requireOneByWorkTechnicIds(array $work_technic_ids) Return the first ChildWorkVersion filtered by the work_technic_ids column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWorkVersion requireOneByWorkTechnicVersions(array $work_technic_versions) Return the first ChildWorkVersion filtered by the work_technic_versions column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWorkVersion[]|Collection find(?ConnectionInterface $con = null) Return ChildWorkVersion objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildWorkVersion> find(?ConnectionInterface $con = null) Return ChildWorkVersion objects based on current ModelCriteria
 * @method     ChildWorkVersion[]|Collection findById(int $id) Return ChildWorkVersion objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildWorkVersion> findById(int $id) Return ChildWorkVersion objects filtered by the id column
 * @method     ChildWorkVersion[]|Collection findByName(string $name) Return ChildWorkVersion objects filtered by the name column
 * @psalm-method Collection&\Traversable<ChildWorkVersion> findByName(string $name) Return ChildWorkVersion objects filtered by the name column
 * @method     ChildWorkVersion[]|Collection findByPrice(string $price) Return ChildWorkVersion objects filtered by the price column
 * @psalm-method Collection&\Traversable<ChildWorkVersion> findByPrice(string $price) Return ChildWorkVersion objects filtered by the price column
 * @method     ChildWorkVersion[]|Collection findByAmount(string $amount) Return ChildWorkVersion objects filtered by the amount column
 * @psalm-method Collection&\Traversable<ChildWorkVersion> findByAmount(string $amount) Return ChildWorkVersion objects filtered by the amount column
 * @method     ChildWorkVersion[]|Collection findByIsAvailable(boolean $is_available) Return ChildWorkVersion objects filtered by the is_available column
 * @psalm-method Collection&\Traversable<ChildWorkVersion> findByIsAvailable(boolean $is_available) Return ChildWorkVersion objects filtered by the is_available column
 * @method     ChildWorkVersion[]|Collection findByUnitId(int $unit_id) Return ChildWorkVersion objects filtered by the unit_id column
 * @psalm-method Collection&\Traversable<ChildWorkVersion> findByUnitId(int $unit_id) Return ChildWorkVersion objects filtered by the unit_id column
 * @method     ChildWorkVersion[]|Collection findByVersion(int $version) Return ChildWorkVersion objects filtered by the version column
 * @psalm-method Collection&\Traversable<ChildWorkVersion> findByVersion(int $version) Return ChildWorkVersion objects filtered by the version column
 * @method     ChildWorkVersion[]|Collection findByVersionCreatedAt(string $version_created_at) Return ChildWorkVersion objects filtered by the version_created_at column
 * @psalm-method Collection&\Traversable<ChildWorkVersion> findByVersionCreatedAt(string $version_created_at) Return ChildWorkVersion objects filtered by the version_created_at column
 * @method     ChildWorkVersion[]|Collection findByVersionCreatedBy(string $version_created_by) Return ChildWorkVersion objects filtered by the version_created_by column
 * @psalm-method Collection&\Traversable<ChildWorkVersion> findByVersionCreatedBy(string $version_created_by) Return ChildWorkVersion objects filtered by the version_created_by column
 * @method     ChildWorkVersion[]|Collection findByVersionComment(string $version_comment) Return ChildWorkVersion objects filtered by the version_comment column
 * @psalm-method Collection&\Traversable<ChildWorkVersion> findByVersionComment(string $version_comment) Return ChildWorkVersion objects filtered by the version_comment column
 * @method     ChildWorkVersion[]|Collection findByWorkMaterialIds(array $work_material_ids) Return ChildWorkVersion objects filtered by the work_material_ids column
 * @psalm-method Collection&\Traversable<ChildWorkVersion> findByWorkMaterialIds(array $work_material_ids) Return ChildWorkVersion objects filtered by the work_material_ids column
 * @method     ChildWorkVersion[]|Collection findByWorkMaterialVersions(array $work_material_versions) Return ChildWorkVersion objects filtered by the work_material_versions column
 * @psalm-method Collection&\Traversable<ChildWorkVersion> findByWorkMaterialVersions(array $work_material_versions) Return ChildWorkVersion objects filtered by the work_material_versions column
 * @method     ChildWorkVersion[]|Collection findByWorkTechnicIds(array $work_technic_ids) Return ChildWorkVersion objects filtered by the work_technic_ids column
 * @psalm-method Collection&\Traversable<ChildWorkVersion> findByWorkTechnicIds(array $work_technic_ids) Return ChildWorkVersion objects filtered by the work_technic_ids column
 * @method     ChildWorkVersion[]|Collection findByWorkTechnicVersions(array $work_technic_versions) Return ChildWorkVersion objects filtered by the work_technic_versions column
 * @psalm-method Collection&\Traversable<ChildWorkVersion> findByWorkTechnicVersions(array $work_technic_versions) Return ChildWorkVersion objects filtered by the work_technic_versions column
 * @method     ChildWorkVersion[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildWorkVersion> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class WorkVersionQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \DB\Base\WorkVersionQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\DB\\WorkVersion', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildWorkVersionQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildWorkVersionQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildWorkVersionQuery) {
            return $criteria;
        }
        $query = new ChildWorkVersionQuery();
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
     * @return ChildWorkVersion|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(WorkVersionTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = WorkVersionTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildWorkVersion A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, price, amount, is_available, unit_id, version, version_created_at, version_created_by, version_comment, work_material_ids, work_material_versions, work_technic_ids, work_technic_versions FROM work_version WHERE id = :p0 AND version = :p1';
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
            /** @var ChildWorkVersion $obj */
            $obj = new ChildWorkVersion();
            $obj->hydrate($row);
            WorkVersionTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildWorkVersion|array|mixed the result, formatted by the current formatter
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
        $this->addUsingAlias(WorkVersionTableMap::COL_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(WorkVersionTableMap::COL_VERSION, $key[1], Criteria::EQUAL);

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
            $cton0 = $this->getNewCriterion(WorkVersionTableMap::COL_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(WorkVersionTableMap::COL_VERSION, $key[1], Criteria::EQUAL);
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
     * @see       filterByWork()
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
                $this->addUsingAlias(WorkVersionTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(WorkVersionTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WorkVersionTableMap::COL_ID, $id, $comparison);

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

        $this->addUsingAlias(WorkVersionTableMap::COL_NAME, $name, $comparison);

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
                $this->addUsingAlias(WorkVersionTableMap::COL_PRICE, $price['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($price['max'])) {
                $this->addUsingAlias(WorkVersionTableMap::COL_PRICE, $price['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WorkVersionTableMap::COL_PRICE, $price, $comparison);

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
                $this->addUsingAlias(WorkVersionTableMap::COL_AMOUNT, $amount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($amount['max'])) {
                $this->addUsingAlias(WorkVersionTableMap::COL_AMOUNT, $amount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WorkVersionTableMap::COL_AMOUNT, $amount, $comparison);

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

        $this->addUsingAlias(WorkVersionTableMap::COL_IS_AVAILABLE, $isAvailable, $comparison);

        return $this;
    }

    /**
     * Filter the query on the unit_id column
     *
     * Example usage:
     * <code>
     * $query->filterByUnitId(1234); // WHERE unit_id = 1234
     * $query->filterByUnitId(array(12, 34)); // WHERE unit_id IN (12, 34)
     * $query->filterByUnitId(array('min' => 12)); // WHERE unit_id > 12
     * </code>
     *
     * @param mixed $unitId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUnitId($unitId = null, ?string $comparison = null)
    {
        if (is_array($unitId)) {
            $useMinMax = false;
            if (isset($unitId['min'])) {
                $this->addUsingAlias(WorkVersionTableMap::COL_UNIT_ID, $unitId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($unitId['max'])) {
                $this->addUsingAlias(WorkVersionTableMap::COL_UNIT_ID, $unitId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WorkVersionTableMap::COL_UNIT_ID, $unitId, $comparison);

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
                $this->addUsingAlias(WorkVersionTableMap::COL_VERSION, $version['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($version['max'])) {
                $this->addUsingAlias(WorkVersionTableMap::COL_VERSION, $version['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WorkVersionTableMap::COL_VERSION, $version, $comparison);

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
                $this->addUsingAlias(WorkVersionTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($versionCreatedAt['max'])) {
                $this->addUsingAlias(WorkVersionTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WorkVersionTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt, $comparison);

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

        $this->addUsingAlias(WorkVersionTableMap::COL_VERSION_CREATED_BY, $versionCreatedBy, $comparison);

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

        $this->addUsingAlias(WorkVersionTableMap::COL_VERSION_COMMENT, $versionComment, $comparison);

        return $this;
    }

    /**
     * Filter the query on the work_material_ids column
     *
     * @param array $workMaterialIds The values to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWorkMaterialIds($workMaterialIds = null, ?string $comparison = null)
    {
        $key = $this->getAliasedColName(WorkVersionTableMap::COL_WORK_MATERIAL_IDS);
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            foreach ($workMaterialIds as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addAnd($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_SOME) {
            foreach ($workMaterialIds as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addOr($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            foreach ($workMaterialIds as $value) {
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

        $this->addUsingAlias(WorkVersionTableMap::COL_WORK_MATERIAL_IDS, $workMaterialIds, $comparison);

        return $this;
    }

    /**
     * Filter the query on the work_material_ids column
     * @param mixed $workMaterialIds The value to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::CONTAINS_ALL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWorkMaterialId($workMaterialIds = null, ?string $comparison = null)
    {
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            if (is_scalar($workMaterialIds)) {
                $workMaterialIds = '%| ' . $workMaterialIds . ' |%';
                $comparison = Criteria::LIKE;
            }
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            $workMaterialIds = '%| ' . $workMaterialIds . ' |%';
            $comparison = Criteria::NOT_LIKE;
            $key = $this->getAliasedColName(WorkVersionTableMap::COL_WORK_MATERIAL_IDS);
            if ($this->containsKey($key)) {
                $this->addAnd($key, $workMaterialIds, $comparison);
            } else {
                $this->addAnd($key, $workMaterialIds, $comparison);
            }
            $this->addOr($key, null, Criteria::ISNULL);

            return $this;
        }

        $this->addUsingAlias(WorkVersionTableMap::COL_WORK_MATERIAL_IDS, $workMaterialIds, $comparison);

        return $this;
    }

    /**
     * Filter the query on the work_material_versions column
     *
     * @param array $workMaterialVersions The values to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWorkMaterialVersions($workMaterialVersions = null, ?string $comparison = null)
    {
        $key = $this->getAliasedColName(WorkVersionTableMap::COL_WORK_MATERIAL_VERSIONS);
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            foreach ($workMaterialVersions as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addAnd($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_SOME) {
            foreach ($workMaterialVersions as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addOr($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            foreach ($workMaterialVersions as $value) {
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

        $this->addUsingAlias(WorkVersionTableMap::COL_WORK_MATERIAL_VERSIONS, $workMaterialVersions, $comparison);

        return $this;
    }

    /**
     * Filter the query on the work_material_versions column
     * @param mixed $workMaterialVersions The value to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::CONTAINS_ALL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWorkMaterialVersion($workMaterialVersions = null, ?string $comparison = null)
    {
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            if (is_scalar($workMaterialVersions)) {
                $workMaterialVersions = '%| ' . $workMaterialVersions . ' |%';
                $comparison = Criteria::LIKE;
            }
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            $workMaterialVersions = '%| ' . $workMaterialVersions . ' |%';
            $comparison = Criteria::NOT_LIKE;
            $key = $this->getAliasedColName(WorkVersionTableMap::COL_WORK_MATERIAL_VERSIONS);
            if ($this->containsKey($key)) {
                $this->addAnd($key, $workMaterialVersions, $comparison);
            } else {
                $this->addAnd($key, $workMaterialVersions, $comparison);
            }
            $this->addOr($key, null, Criteria::ISNULL);

            return $this;
        }

        $this->addUsingAlias(WorkVersionTableMap::COL_WORK_MATERIAL_VERSIONS, $workMaterialVersions, $comparison);

        return $this;
    }

    /**
     * Filter the query on the work_technic_ids column
     *
     * @param array $workTechnicIds The values to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWorkTechnicIds($workTechnicIds = null, ?string $comparison = null)
    {
        $key = $this->getAliasedColName(WorkVersionTableMap::COL_WORK_TECHNIC_IDS);
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            foreach ($workTechnicIds as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addAnd($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_SOME) {
            foreach ($workTechnicIds as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addOr($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            foreach ($workTechnicIds as $value) {
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

        $this->addUsingAlias(WorkVersionTableMap::COL_WORK_TECHNIC_IDS, $workTechnicIds, $comparison);

        return $this;
    }

    /**
     * Filter the query on the work_technic_ids column
     * @param mixed $workTechnicIds The value to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::CONTAINS_ALL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWorkTechnicId($workTechnicIds = null, ?string $comparison = null)
    {
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            if (is_scalar($workTechnicIds)) {
                $workTechnicIds = '%| ' . $workTechnicIds . ' |%';
                $comparison = Criteria::LIKE;
            }
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            $workTechnicIds = '%| ' . $workTechnicIds . ' |%';
            $comparison = Criteria::NOT_LIKE;
            $key = $this->getAliasedColName(WorkVersionTableMap::COL_WORK_TECHNIC_IDS);
            if ($this->containsKey($key)) {
                $this->addAnd($key, $workTechnicIds, $comparison);
            } else {
                $this->addAnd($key, $workTechnicIds, $comparison);
            }
            $this->addOr($key, null, Criteria::ISNULL);

            return $this;
        }

        $this->addUsingAlias(WorkVersionTableMap::COL_WORK_TECHNIC_IDS, $workTechnicIds, $comparison);

        return $this;
    }

    /**
     * Filter the query on the work_technic_versions column
     *
     * @param array $workTechnicVersions The values to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWorkTechnicVersions($workTechnicVersions = null, ?string $comparison = null)
    {
        $key = $this->getAliasedColName(WorkVersionTableMap::COL_WORK_TECHNIC_VERSIONS);
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            foreach ($workTechnicVersions as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addAnd($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_SOME) {
            foreach ($workTechnicVersions as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addOr($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            foreach ($workTechnicVersions as $value) {
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

        $this->addUsingAlias(WorkVersionTableMap::COL_WORK_TECHNIC_VERSIONS, $workTechnicVersions, $comparison);

        return $this;
    }

    /**
     * Filter the query on the work_technic_versions column
     * @param mixed $workTechnicVersions The value to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::CONTAINS_ALL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWorkTechnicVersion($workTechnicVersions = null, ?string $comparison = null)
    {
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            if (is_scalar($workTechnicVersions)) {
                $workTechnicVersions = '%| ' . $workTechnicVersions . ' |%';
                $comparison = Criteria::LIKE;
            }
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            $workTechnicVersions = '%| ' . $workTechnicVersions . ' |%';
            $comparison = Criteria::NOT_LIKE;
            $key = $this->getAliasedColName(WorkVersionTableMap::COL_WORK_TECHNIC_VERSIONS);
            if ($this->containsKey($key)) {
                $this->addAnd($key, $workTechnicVersions, $comparison);
            } else {
                $this->addAnd($key, $workTechnicVersions, $comparison);
            }
            $this->addOr($key, null, Criteria::ISNULL);

            return $this;
        }

        $this->addUsingAlias(WorkVersionTableMap::COL_WORK_TECHNIC_VERSIONS, $workTechnicVersions, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \DB\Work object
     *
     * @param \DB\Work|ObjectCollection $work The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWork($work, ?string $comparison = null)
    {
        if ($work instanceof \DB\Work) {
            return $this
                ->addUsingAlias(WorkVersionTableMap::COL_ID, $work->getId(), $comparison);
        } elseif ($work instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(WorkVersionTableMap::COL_ID, $work->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByWork() only accepts arguments of type \DB\Work or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Work relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinWork(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Work');

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
            $this->addJoinObject($join, 'Work');
        }

        return $this;
    }

    /**
     * Use the Work relation Work object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\WorkQuery A secondary query class using the current class as primary query
     */
    public function useWorkQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinWork($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Work', '\DB\WorkQuery');
    }

    /**
     * Use the Work relation Work object
     *
     * @param callable(\DB\WorkQuery):\DB\WorkQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withWorkQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useWorkQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to Work table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\WorkQuery The inner query object of the EXISTS statement
     */
    public function useWorkExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('Work', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to Work table for a NOT EXISTS query.
     *
     * @see useWorkExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\WorkQuery The inner query object of the NOT EXISTS statement
     */
    public function useWorkNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('Work', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Exclude object from result
     *
     * @param ChildWorkVersion $workVersion Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($workVersion = null)
    {
        if ($workVersion) {
            $this->addCond('pruneCond0', $this->getAliasedColName(WorkVersionTableMap::COL_ID), $workVersion->getId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(WorkVersionTableMap::COL_VERSION), $workVersion->getVersion(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the work_version table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(WorkVersionTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            WorkVersionTableMap::clearInstancePool();
            WorkVersionTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(WorkVersionTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(WorkVersionTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            WorkVersionTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            WorkVersionTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
