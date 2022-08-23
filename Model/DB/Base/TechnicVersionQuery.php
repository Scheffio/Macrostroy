<?php

namespace DB\Base;

use \Exception;
use \PDO;
use DB\TechnicVersion as ChildTechnicVersion;
use DB\TechnicVersionQuery as ChildTechnicVersionQuery;
use DB\Map\TechnicVersionTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'technic_version' table.
 *
 *
 *
 * @method     ChildTechnicVersionQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildTechnicVersionQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildTechnicVersionQuery orderByPrice($order = Criteria::ASC) Order by the price column
 * @method     ChildTechnicVersionQuery orderByIsAvailable($order = Criteria::ASC) Order by the is_available column
 * @method     ChildTechnicVersionQuery orderByUnitId($order = Criteria::ASC) Order by the unit_id column
 * @method     ChildTechnicVersionQuery orderByVersion($order = Criteria::ASC) Order by the version column
 * @method     ChildTechnicVersionQuery orderByVersionCreatedAt($order = Criteria::ASC) Order by the version_created_at column
 * @method     ChildTechnicVersionQuery orderByVersionCreatedBy($order = Criteria::ASC) Order by the version_created_by column
 * @method     ChildTechnicVersionQuery orderByVersionComment($order = Criteria::ASC) Order by the version_comment column
 * @method     ChildTechnicVersionQuery orderByStageTechnicIds($order = Criteria::ASC) Order by the stage_technic_ids column
 * @method     ChildTechnicVersionQuery orderByStageTechnicVersions($order = Criteria::ASC) Order by the stage_technic_versions column
 * @method     ChildTechnicVersionQuery orderByWorkTechnicIds($order = Criteria::ASC) Order by the work_technic_ids column
 * @method     ChildTechnicVersionQuery orderByWorkTechnicVersions($order = Criteria::ASC) Order by the work_technic_versions column
 *
 * @method     ChildTechnicVersionQuery groupById() Group by the id column
 * @method     ChildTechnicVersionQuery groupByName() Group by the name column
 * @method     ChildTechnicVersionQuery groupByPrice() Group by the price column
 * @method     ChildTechnicVersionQuery groupByIsAvailable() Group by the is_available column
 * @method     ChildTechnicVersionQuery groupByUnitId() Group by the unit_id column
 * @method     ChildTechnicVersionQuery groupByVersion() Group by the version column
 * @method     ChildTechnicVersionQuery groupByVersionCreatedAt() Group by the version_created_at column
 * @method     ChildTechnicVersionQuery groupByVersionCreatedBy() Group by the version_created_by column
 * @method     ChildTechnicVersionQuery groupByVersionComment() Group by the version_comment column
 * @method     ChildTechnicVersionQuery groupByStageTechnicIds() Group by the stage_technic_ids column
 * @method     ChildTechnicVersionQuery groupByStageTechnicVersions() Group by the stage_technic_versions column
 * @method     ChildTechnicVersionQuery groupByWorkTechnicIds() Group by the work_technic_ids column
 * @method     ChildTechnicVersionQuery groupByWorkTechnicVersions() Group by the work_technic_versions column
 *
 * @method     ChildTechnicVersionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildTechnicVersionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildTechnicVersionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildTechnicVersionQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildTechnicVersionQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildTechnicVersionQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildTechnicVersionQuery leftJoinTechnic($relationAlias = null) Adds a LEFT JOIN clause to the query using the Technic relation
 * @method     ChildTechnicVersionQuery rightJoinTechnic($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Technic relation
 * @method     ChildTechnicVersionQuery innerJoinTechnic($relationAlias = null) Adds a INNER JOIN clause to the query using the Technic relation
 *
 * @method     ChildTechnicVersionQuery joinWithTechnic($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Technic relation
 *
 * @method     ChildTechnicVersionQuery leftJoinWithTechnic() Adds a LEFT JOIN clause and with to the query using the Technic relation
 * @method     ChildTechnicVersionQuery rightJoinWithTechnic() Adds a RIGHT JOIN clause and with to the query using the Technic relation
 * @method     ChildTechnicVersionQuery innerJoinWithTechnic() Adds a INNER JOIN clause and with to the query using the Technic relation
 *
 * @method     \DB\TechnicQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildTechnicVersion|null findOne(?ConnectionInterface $con = null) Return the first ChildTechnicVersion matching the query
 * @method     ChildTechnicVersion findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildTechnicVersion matching the query, or a new ChildTechnicVersion object populated from the query conditions when no match is found
 *
 * @method     ChildTechnicVersion|null findOneById(int $id) Return the first ChildTechnicVersion filtered by the id column
 * @method     ChildTechnicVersion|null findOneByName(string $name) Return the first ChildTechnicVersion filtered by the name column
 * @method     ChildTechnicVersion|null findOneByPrice(string $price) Return the first ChildTechnicVersion filtered by the price column
 * @method     ChildTechnicVersion|null findOneByIsAvailable(boolean $is_available) Return the first ChildTechnicVersion filtered by the is_available column
 * @method     ChildTechnicVersion|null findOneByUnitId(int $unit_id) Return the first ChildTechnicVersion filtered by the unit_id column
 * @method     ChildTechnicVersion|null findOneByVersion(int $version) Return the first ChildTechnicVersion filtered by the version column
 * @method     ChildTechnicVersion|null findOneByVersionCreatedAt(string $version_created_at) Return the first ChildTechnicVersion filtered by the version_created_at column
 * @method     ChildTechnicVersion|null findOneByVersionCreatedBy(string $version_created_by) Return the first ChildTechnicVersion filtered by the version_created_by column
 * @method     ChildTechnicVersion|null findOneByVersionComment(string $version_comment) Return the first ChildTechnicVersion filtered by the version_comment column
 * @method     ChildTechnicVersion|null findOneByStageTechnicIds(array $stage_technic_ids) Return the first ChildTechnicVersion filtered by the stage_technic_ids column
 * @method     ChildTechnicVersion|null findOneByStageTechnicVersions(array $stage_technic_versions) Return the first ChildTechnicVersion filtered by the stage_technic_versions column
 * @method     ChildTechnicVersion|null findOneByWorkTechnicIds(array $work_technic_ids) Return the first ChildTechnicVersion filtered by the work_technic_ids column
 * @method     ChildTechnicVersion|null findOneByWorkTechnicVersions(array $work_technic_versions) Return the first ChildTechnicVersion filtered by the work_technic_versions column *

 * @method     ChildTechnicVersion requirePk($key, ?ConnectionInterface $con = null) Return the ChildTechnicVersion by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTechnicVersion requireOne(?ConnectionInterface $con = null) Return the first ChildTechnicVersion matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTechnicVersion requireOneById(int $id) Return the first ChildTechnicVersion filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTechnicVersion requireOneByName(string $name) Return the first ChildTechnicVersion filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTechnicVersion requireOneByPrice(string $price) Return the first ChildTechnicVersion filtered by the price column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTechnicVersion requireOneByIsAvailable(boolean $is_available) Return the first ChildTechnicVersion filtered by the is_available column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTechnicVersion requireOneByUnitId(int $unit_id) Return the first ChildTechnicVersion filtered by the unit_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTechnicVersion requireOneByVersion(int $version) Return the first ChildTechnicVersion filtered by the version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTechnicVersion requireOneByVersionCreatedAt(string $version_created_at) Return the first ChildTechnicVersion filtered by the version_created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTechnicVersion requireOneByVersionCreatedBy(string $version_created_by) Return the first ChildTechnicVersion filtered by the version_created_by column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTechnicVersion requireOneByVersionComment(string $version_comment) Return the first ChildTechnicVersion filtered by the version_comment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTechnicVersion requireOneByStageTechnicIds(array $stage_technic_ids) Return the first ChildTechnicVersion filtered by the stage_technic_ids column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTechnicVersion requireOneByStageTechnicVersions(array $stage_technic_versions) Return the first ChildTechnicVersion filtered by the stage_technic_versions column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTechnicVersion requireOneByWorkTechnicIds(array $work_technic_ids) Return the first ChildTechnicVersion filtered by the work_technic_ids column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTechnicVersion requireOneByWorkTechnicVersions(array $work_technic_versions) Return the first ChildTechnicVersion filtered by the work_technic_versions column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTechnicVersion[]|Collection find(?ConnectionInterface $con = null) Return ChildTechnicVersion objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildTechnicVersion> find(?ConnectionInterface $con = null) Return ChildTechnicVersion objects based on current ModelCriteria
 * @method     ChildTechnicVersion[]|Collection findById(int $id) Return ChildTechnicVersion objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildTechnicVersion> findById(int $id) Return ChildTechnicVersion objects filtered by the id column
 * @method     ChildTechnicVersion[]|Collection findByName(string $name) Return ChildTechnicVersion objects filtered by the name column
 * @psalm-method Collection&\Traversable<ChildTechnicVersion> findByName(string $name) Return ChildTechnicVersion objects filtered by the name column
 * @method     ChildTechnicVersion[]|Collection findByPrice(string $price) Return ChildTechnicVersion objects filtered by the price column
 * @psalm-method Collection&\Traversable<ChildTechnicVersion> findByPrice(string $price) Return ChildTechnicVersion objects filtered by the price column
 * @method     ChildTechnicVersion[]|Collection findByIsAvailable(boolean $is_available) Return ChildTechnicVersion objects filtered by the is_available column
 * @psalm-method Collection&\Traversable<ChildTechnicVersion> findByIsAvailable(boolean $is_available) Return ChildTechnicVersion objects filtered by the is_available column
 * @method     ChildTechnicVersion[]|Collection findByUnitId(int $unit_id) Return ChildTechnicVersion objects filtered by the unit_id column
 * @psalm-method Collection&\Traversable<ChildTechnicVersion> findByUnitId(int $unit_id) Return ChildTechnicVersion objects filtered by the unit_id column
 * @method     ChildTechnicVersion[]|Collection findByVersion(int $version) Return ChildTechnicVersion objects filtered by the version column
 * @psalm-method Collection&\Traversable<ChildTechnicVersion> findByVersion(int $version) Return ChildTechnicVersion objects filtered by the version column
 * @method     ChildTechnicVersion[]|Collection findByVersionCreatedAt(string $version_created_at) Return ChildTechnicVersion objects filtered by the version_created_at column
 * @psalm-method Collection&\Traversable<ChildTechnicVersion> findByVersionCreatedAt(string $version_created_at) Return ChildTechnicVersion objects filtered by the version_created_at column
 * @method     ChildTechnicVersion[]|Collection findByVersionCreatedBy(string $version_created_by) Return ChildTechnicVersion objects filtered by the version_created_by column
 * @psalm-method Collection&\Traversable<ChildTechnicVersion> findByVersionCreatedBy(string $version_created_by) Return ChildTechnicVersion objects filtered by the version_created_by column
 * @method     ChildTechnicVersion[]|Collection findByVersionComment(string $version_comment) Return ChildTechnicVersion objects filtered by the version_comment column
 * @psalm-method Collection&\Traversable<ChildTechnicVersion> findByVersionComment(string $version_comment) Return ChildTechnicVersion objects filtered by the version_comment column
 * @method     ChildTechnicVersion[]|Collection findByStageTechnicIds(array $stage_technic_ids) Return ChildTechnicVersion objects filtered by the stage_technic_ids column
 * @psalm-method Collection&\Traversable<ChildTechnicVersion> findByStageTechnicIds(array $stage_technic_ids) Return ChildTechnicVersion objects filtered by the stage_technic_ids column
 * @method     ChildTechnicVersion[]|Collection findByStageTechnicVersions(array $stage_technic_versions) Return ChildTechnicVersion objects filtered by the stage_technic_versions column
 * @psalm-method Collection&\Traversable<ChildTechnicVersion> findByStageTechnicVersions(array $stage_technic_versions) Return ChildTechnicVersion objects filtered by the stage_technic_versions column
 * @method     ChildTechnicVersion[]|Collection findByWorkTechnicIds(array $work_technic_ids) Return ChildTechnicVersion objects filtered by the work_technic_ids column
 * @psalm-method Collection&\Traversable<ChildTechnicVersion> findByWorkTechnicIds(array $work_technic_ids) Return ChildTechnicVersion objects filtered by the work_technic_ids column
 * @method     ChildTechnicVersion[]|Collection findByWorkTechnicVersions(array $work_technic_versions) Return ChildTechnicVersion objects filtered by the work_technic_versions column
 * @psalm-method Collection&\Traversable<ChildTechnicVersion> findByWorkTechnicVersions(array $work_technic_versions) Return ChildTechnicVersion objects filtered by the work_technic_versions column
 * @method     ChildTechnicVersion[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildTechnicVersion> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class TechnicVersionQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \DB\Base\TechnicVersionQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\DB\\TechnicVersion', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildTechnicVersionQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildTechnicVersionQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildTechnicVersionQuery) {
            return $criteria;
        }
        $query = new ChildTechnicVersionQuery();
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
     * @return ChildTechnicVersion|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(TechnicVersionTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = TechnicVersionTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildTechnicVersion A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, price, is_available, unit_id, version, version_created_at, version_created_by, version_comment, stage_technic_ids, stage_technic_versions, work_technic_ids, work_technic_versions FROM technic_version WHERE id = :p0 AND version = :p1';
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
            /** @var ChildTechnicVersion $obj */
            $obj = new ChildTechnicVersion();
            $obj->hydrate($row);
            TechnicVersionTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildTechnicVersion|array|mixed the result, formatted by the current formatter
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
        $this->addUsingAlias(TechnicVersionTableMap::COL_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(TechnicVersionTableMap::COL_VERSION, $key[1], Criteria::EQUAL);

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
            $cton0 = $this->getNewCriterion(TechnicVersionTableMap::COL_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(TechnicVersionTableMap::COL_VERSION, $key[1], Criteria::EQUAL);
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
     * @see       filterByTechnic()
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
                $this->addUsingAlias(TechnicVersionTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(TechnicVersionTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TechnicVersionTableMap::COL_ID, $id, $comparison);

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

        $this->addUsingAlias(TechnicVersionTableMap::COL_NAME, $name, $comparison);

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
                $this->addUsingAlias(TechnicVersionTableMap::COL_PRICE, $price['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($price['max'])) {
                $this->addUsingAlias(TechnicVersionTableMap::COL_PRICE, $price['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TechnicVersionTableMap::COL_PRICE, $price, $comparison);

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

        $this->addUsingAlias(TechnicVersionTableMap::COL_IS_AVAILABLE, $isAvailable, $comparison);

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
                $this->addUsingAlias(TechnicVersionTableMap::COL_UNIT_ID, $unitId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($unitId['max'])) {
                $this->addUsingAlias(TechnicVersionTableMap::COL_UNIT_ID, $unitId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TechnicVersionTableMap::COL_UNIT_ID, $unitId, $comparison);

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
                $this->addUsingAlias(TechnicVersionTableMap::COL_VERSION, $version['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($version['max'])) {
                $this->addUsingAlias(TechnicVersionTableMap::COL_VERSION, $version['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TechnicVersionTableMap::COL_VERSION, $version, $comparison);

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
                $this->addUsingAlias(TechnicVersionTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($versionCreatedAt['max'])) {
                $this->addUsingAlias(TechnicVersionTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(TechnicVersionTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt, $comparison);

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

        $this->addUsingAlias(TechnicVersionTableMap::COL_VERSION_CREATED_BY, $versionCreatedBy, $comparison);

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

        $this->addUsingAlias(TechnicVersionTableMap::COL_VERSION_COMMENT, $versionComment, $comparison);

        return $this;
    }

    /**
     * Filter the query on the stage_technic_ids column
     *
     * @param array $stageTechnicIds The values to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStageTechnicIds($stageTechnicIds = null, ?string $comparison = null)
    {
        $key = $this->getAliasedColName(TechnicVersionTableMap::COL_STAGE_TECHNIC_IDS);
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            foreach ($stageTechnicIds as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addAnd($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_SOME) {
            foreach ($stageTechnicIds as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addOr($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            foreach ($stageTechnicIds as $value) {
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

        $this->addUsingAlias(TechnicVersionTableMap::COL_STAGE_TECHNIC_IDS, $stageTechnicIds, $comparison);

        return $this;
    }

    /**
     * Filter the query on the stage_technic_ids column
     * @param mixed $stageTechnicIds The value to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::CONTAINS_ALL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStageTechnicId($stageTechnicIds = null, ?string $comparison = null)
    {
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            if (is_scalar($stageTechnicIds)) {
                $stageTechnicIds = '%| ' . $stageTechnicIds . ' |%';
                $comparison = Criteria::LIKE;
            }
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            $stageTechnicIds = '%| ' . $stageTechnicIds . ' |%';
            $comparison = Criteria::NOT_LIKE;
            $key = $this->getAliasedColName(TechnicVersionTableMap::COL_STAGE_TECHNIC_IDS);
            if ($this->containsKey($key)) {
                $this->addAnd($key, $stageTechnicIds, $comparison);
            } else {
                $this->addAnd($key, $stageTechnicIds, $comparison);
            }
            $this->addOr($key, null, Criteria::ISNULL);

            return $this;
        }

        $this->addUsingAlias(TechnicVersionTableMap::COL_STAGE_TECHNIC_IDS, $stageTechnicIds, $comparison);

        return $this;
    }

    /**
     * Filter the query on the stage_technic_versions column
     *
     * @param array $stageTechnicVersions The values to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStageTechnicVersions($stageTechnicVersions = null, ?string $comparison = null)
    {
        $key = $this->getAliasedColName(TechnicVersionTableMap::COL_STAGE_TECHNIC_VERSIONS);
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            foreach ($stageTechnicVersions as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addAnd($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_SOME) {
            foreach ($stageTechnicVersions as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addOr($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            foreach ($stageTechnicVersions as $value) {
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

        $this->addUsingAlias(TechnicVersionTableMap::COL_STAGE_TECHNIC_VERSIONS, $stageTechnicVersions, $comparison);

        return $this;
    }

    /**
     * Filter the query on the stage_technic_versions column
     * @param mixed $stageTechnicVersions The value to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::CONTAINS_ALL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStageTechnicVersion($stageTechnicVersions = null, ?string $comparison = null)
    {
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            if (is_scalar($stageTechnicVersions)) {
                $stageTechnicVersions = '%| ' . $stageTechnicVersions . ' |%';
                $comparison = Criteria::LIKE;
            }
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            $stageTechnicVersions = '%| ' . $stageTechnicVersions . ' |%';
            $comparison = Criteria::NOT_LIKE;
            $key = $this->getAliasedColName(TechnicVersionTableMap::COL_STAGE_TECHNIC_VERSIONS);
            if ($this->containsKey($key)) {
                $this->addAnd($key, $stageTechnicVersions, $comparison);
            } else {
                $this->addAnd($key, $stageTechnicVersions, $comparison);
            }
            $this->addOr($key, null, Criteria::ISNULL);

            return $this;
        }

        $this->addUsingAlias(TechnicVersionTableMap::COL_STAGE_TECHNIC_VERSIONS, $stageTechnicVersions, $comparison);

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
        $key = $this->getAliasedColName(TechnicVersionTableMap::COL_WORK_TECHNIC_IDS);
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

        $this->addUsingAlias(TechnicVersionTableMap::COL_WORK_TECHNIC_IDS, $workTechnicIds, $comparison);

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
            $key = $this->getAliasedColName(TechnicVersionTableMap::COL_WORK_TECHNIC_IDS);
            if ($this->containsKey($key)) {
                $this->addAnd($key, $workTechnicIds, $comparison);
            } else {
                $this->addAnd($key, $workTechnicIds, $comparison);
            }
            $this->addOr($key, null, Criteria::ISNULL);

            return $this;
        }

        $this->addUsingAlias(TechnicVersionTableMap::COL_WORK_TECHNIC_IDS, $workTechnicIds, $comparison);

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
        $key = $this->getAliasedColName(TechnicVersionTableMap::COL_WORK_TECHNIC_VERSIONS);
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

        $this->addUsingAlias(TechnicVersionTableMap::COL_WORK_TECHNIC_VERSIONS, $workTechnicVersions, $comparison);

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
            $key = $this->getAliasedColName(TechnicVersionTableMap::COL_WORK_TECHNIC_VERSIONS);
            if ($this->containsKey($key)) {
                $this->addAnd($key, $workTechnicVersions, $comparison);
            } else {
                $this->addAnd($key, $workTechnicVersions, $comparison);
            }
            $this->addOr($key, null, Criteria::ISNULL);

            return $this;
        }

        $this->addUsingAlias(TechnicVersionTableMap::COL_WORK_TECHNIC_VERSIONS, $workTechnicVersions, $comparison);

        return $this;
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
                ->addUsingAlias(TechnicVersionTableMap::COL_ID, $technic->getId(), $comparison);
        } elseif ($technic instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(TechnicVersionTableMap::COL_ID, $technic->toKeyValue('PrimaryKey', 'Id'), $comparison);

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
     * Exclude object from result
     *
     * @param ChildTechnicVersion $technicVersion Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($technicVersion = null)
    {
        if ($technicVersion) {
            $this->addCond('pruneCond0', $this->getAliasedColName(TechnicVersionTableMap::COL_ID), $technicVersion->getId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(TechnicVersionTableMap::COL_VERSION), $technicVersion->getVersion(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the technic_version table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TechnicVersionTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            TechnicVersionTableMap::clearInstancePool();
            TechnicVersionTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(TechnicVersionTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(TechnicVersionTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            TechnicVersionTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            TechnicVersionTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
