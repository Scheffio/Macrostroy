<?php

namespace DB\Base;

use \Exception;
use \PDO;
use DB\VolTechnicVersion as ChildVolTechnicVersion;
use DB\VolTechnicVersionQuery as ChildVolTechnicVersionQuery;
use DB\Map\VolTechnicVersionTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'vol_technic_version' table.
 *
 *
 *
 * @method     ChildVolTechnicVersionQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildVolTechnicVersionQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildVolTechnicVersionQuery orderByPrice($order = Criteria::ASC) Order by the price column
 * @method     ChildVolTechnicVersionQuery orderByIsAvailable($order = Criteria::ASC) Order by the is_available column
 * @method     ChildVolTechnicVersionQuery orderByUnitId($order = Criteria::ASC) Order by the unit_id column
 * @method     ChildVolTechnicVersionQuery orderByVersionCreatedBy($order = Criteria::ASC) Order by the version_created_by column
 * @method     ChildVolTechnicVersionQuery orderByVersion($order = Criteria::ASC) Order by the version column
 * @method     ChildVolTechnicVersionQuery orderByVersionCreatedAt($order = Criteria::ASC) Order by the version_created_at column
 * @method     ChildVolTechnicVersionQuery orderByVersionComment($order = Criteria::ASC) Order by the version_comment column
 * @method     ChildVolTechnicVersionQuery orderByObjStageTechnicIds($order = Criteria::ASC) Order by the obj_stage_technic_ids column
 * @method     ChildVolTechnicVersionQuery orderByObjStageTechnicVersions($order = Criteria::ASC) Order by the obj_stage_technic_versions column
 * @method     ChildVolTechnicVersionQuery orderByVolWorkTechnicIds($order = Criteria::ASC) Order by the vol_work_technic_ids column
 * @method     ChildVolTechnicVersionQuery orderByVolWorkTechnicVersions($order = Criteria::ASC) Order by the vol_work_technic_versions column
 *
 * @method     ChildVolTechnicVersionQuery groupById() Group by the id column
 * @method     ChildVolTechnicVersionQuery groupByName() Group by the name column
 * @method     ChildVolTechnicVersionQuery groupByPrice() Group by the price column
 * @method     ChildVolTechnicVersionQuery groupByIsAvailable() Group by the is_available column
 * @method     ChildVolTechnicVersionQuery groupByUnitId() Group by the unit_id column
 * @method     ChildVolTechnicVersionQuery groupByVersionCreatedBy() Group by the version_created_by column
 * @method     ChildVolTechnicVersionQuery groupByVersion() Group by the version column
 * @method     ChildVolTechnicVersionQuery groupByVersionCreatedAt() Group by the version_created_at column
 * @method     ChildVolTechnicVersionQuery groupByVersionComment() Group by the version_comment column
 * @method     ChildVolTechnicVersionQuery groupByObjStageTechnicIds() Group by the obj_stage_technic_ids column
 * @method     ChildVolTechnicVersionQuery groupByObjStageTechnicVersions() Group by the obj_stage_technic_versions column
 * @method     ChildVolTechnicVersionQuery groupByVolWorkTechnicIds() Group by the vol_work_technic_ids column
 * @method     ChildVolTechnicVersionQuery groupByVolWorkTechnicVersions() Group by the vol_work_technic_versions column
 *
 * @method     ChildVolTechnicVersionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildVolTechnicVersionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildVolTechnicVersionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildVolTechnicVersionQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildVolTechnicVersionQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildVolTechnicVersionQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildVolTechnicVersionQuery leftJoinVolTechnic($relationAlias = null) Adds a LEFT JOIN clause to the query using the VolTechnic relation
 * @method     ChildVolTechnicVersionQuery rightJoinVolTechnic($relationAlias = null) Adds a RIGHT JOIN clause to the query using the VolTechnic relation
 * @method     ChildVolTechnicVersionQuery innerJoinVolTechnic($relationAlias = null) Adds a INNER JOIN clause to the query using the VolTechnic relation
 *
 * @method     ChildVolTechnicVersionQuery joinWithVolTechnic($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the VolTechnic relation
 *
 * @method     ChildVolTechnicVersionQuery leftJoinWithVolTechnic() Adds a LEFT JOIN clause and with to the query using the VolTechnic relation
 * @method     ChildVolTechnicVersionQuery rightJoinWithVolTechnic() Adds a RIGHT JOIN clause and with to the query using the VolTechnic relation
 * @method     ChildVolTechnicVersionQuery innerJoinWithVolTechnic() Adds a INNER JOIN clause and with to the query using the VolTechnic relation
 *
 * @method     \DB\VolTechnicQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildVolTechnicVersion|null findOne(?ConnectionInterface $con = null) Return the first ChildVolTechnicVersion matching the query
 * @method     ChildVolTechnicVersion findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildVolTechnicVersion matching the query, or a new ChildVolTechnicVersion object populated from the query conditions when no match is found
 *
 * @method     ChildVolTechnicVersion|null findOneById(int $id) Return the first ChildVolTechnicVersion filtered by the id column
 * @method     ChildVolTechnicVersion|null findOneByName(string $name) Return the first ChildVolTechnicVersion filtered by the name column
 * @method     ChildVolTechnicVersion|null findOneByPrice(string $price) Return the first ChildVolTechnicVersion filtered by the price column
 * @method     ChildVolTechnicVersion|null findOneByIsAvailable(boolean $is_available) Return the first ChildVolTechnicVersion filtered by the is_available column
 * @method     ChildVolTechnicVersion|null findOneByUnitId(int $unit_id) Return the first ChildVolTechnicVersion filtered by the unit_id column
 * @method     ChildVolTechnicVersion|null findOneByVersionCreatedBy(int $version_created_by) Return the first ChildVolTechnicVersion filtered by the version_created_by column
 * @method     ChildVolTechnicVersion|null findOneByVersion(int $version) Return the first ChildVolTechnicVersion filtered by the version column
 * @method     ChildVolTechnicVersion|null findOneByVersionCreatedAt(string $version_created_at) Return the first ChildVolTechnicVersion filtered by the version_created_at column
 * @method     ChildVolTechnicVersion|null findOneByVersionComment(string $version_comment) Return the first ChildVolTechnicVersion filtered by the version_comment column
 * @method     ChildVolTechnicVersion|null findOneByObjStageTechnicIds(array $obj_stage_technic_ids) Return the first ChildVolTechnicVersion filtered by the obj_stage_technic_ids column
 * @method     ChildVolTechnicVersion|null findOneByObjStageTechnicVersions(array $obj_stage_technic_versions) Return the first ChildVolTechnicVersion filtered by the obj_stage_technic_versions column
 * @method     ChildVolTechnicVersion|null findOneByVolWorkTechnicIds(array $vol_work_technic_ids) Return the first ChildVolTechnicVersion filtered by the vol_work_technic_ids column
 * @method     ChildVolTechnicVersion|null findOneByVolWorkTechnicVersions(array $vol_work_technic_versions) Return the first ChildVolTechnicVersion filtered by the vol_work_technic_versions column *

 * @method     ChildVolTechnicVersion requirePk($key, ?ConnectionInterface $con = null) Return the ChildVolTechnicVersion by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolTechnicVersion requireOne(?ConnectionInterface $con = null) Return the first ChildVolTechnicVersion matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildVolTechnicVersion requireOneById(int $id) Return the first ChildVolTechnicVersion filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolTechnicVersion requireOneByName(string $name) Return the first ChildVolTechnicVersion filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolTechnicVersion requireOneByPrice(string $price) Return the first ChildVolTechnicVersion filtered by the price column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolTechnicVersion requireOneByIsAvailable(boolean $is_available) Return the first ChildVolTechnicVersion filtered by the is_available column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolTechnicVersion requireOneByUnitId(int $unit_id) Return the first ChildVolTechnicVersion filtered by the unit_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolTechnicVersion requireOneByVersionCreatedBy(int $version_created_by) Return the first ChildVolTechnicVersion filtered by the version_created_by column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolTechnicVersion requireOneByVersion(int $version) Return the first ChildVolTechnicVersion filtered by the version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolTechnicVersion requireOneByVersionCreatedAt(string $version_created_at) Return the first ChildVolTechnicVersion filtered by the version_created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolTechnicVersion requireOneByVersionComment(string $version_comment) Return the first ChildVolTechnicVersion filtered by the version_comment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolTechnicVersion requireOneByObjStageTechnicIds(array $obj_stage_technic_ids) Return the first ChildVolTechnicVersion filtered by the obj_stage_technic_ids column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolTechnicVersion requireOneByObjStageTechnicVersions(array $obj_stage_technic_versions) Return the first ChildVolTechnicVersion filtered by the obj_stage_technic_versions column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolTechnicVersion requireOneByVolWorkTechnicIds(array $vol_work_technic_ids) Return the first ChildVolTechnicVersion filtered by the vol_work_technic_ids column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolTechnicVersion requireOneByVolWorkTechnicVersions(array $vol_work_technic_versions) Return the first ChildVolTechnicVersion filtered by the vol_work_technic_versions column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildVolTechnicVersion[]|Collection find(?ConnectionInterface $con = null) Return ChildVolTechnicVersion objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildVolTechnicVersion> find(?ConnectionInterface $con = null) Return ChildVolTechnicVersion objects based on current ModelCriteria
 * @method     ChildVolTechnicVersion[]|Collection findById(int $id) Return ChildVolTechnicVersion objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildVolTechnicVersion> findById(int $id) Return ChildVolTechnicVersion objects filtered by the id column
 * @method     ChildVolTechnicVersion[]|Collection findByName(string $name) Return ChildVolTechnicVersion objects filtered by the name column
 * @psalm-method Collection&\Traversable<ChildVolTechnicVersion> findByName(string $name) Return ChildVolTechnicVersion objects filtered by the name column
 * @method     ChildVolTechnicVersion[]|Collection findByPrice(string $price) Return ChildVolTechnicVersion objects filtered by the price column
 * @psalm-method Collection&\Traversable<ChildVolTechnicVersion> findByPrice(string $price) Return ChildVolTechnicVersion objects filtered by the price column
 * @method     ChildVolTechnicVersion[]|Collection findByIsAvailable(boolean $is_available) Return ChildVolTechnicVersion objects filtered by the is_available column
 * @psalm-method Collection&\Traversable<ChildVolTechnicVersion> findByIsAvailable(boolean $is_available) Return ChildVolTechnicVersion objects filtered by the is_available column
 * @method     ChildVolTechnicVersion[]|Collection findByUnitId(int $unit_id) Return ChildVolTechnicVersion objects filtered by the unit_id column
 * @psalm-method Collection&\Traversable<ChildVolTechnicVersion> findByUnitId(int $unit_id) Return ChildVolTechnicVersion objects filtered by the unit_id column
 * @method     ChildVolTechnicVersion[]|Collection findByVersionCreatedBy(int $version_created_by) Return ChildVolTechnicVersion objects filtered by the version_created_by column
 * @psalm-method Collection&\Traversable<ChildVolTechnicVersion> findByVersionCreatedBy(int $version_created_by) Return ChildVolTechnicVersion objects filtered by the version_created_by column
 * @method     ChildVolTechnicVersion[]|Collection findByVersion(int $version) Return ChildVolTechnicVersion objects filtered by the version column
 * @psalm-method Collection&\Traversable<ChildVolTechnicVersion> findByVersion(int $version) Return ChildVolTechnicVersion objects filtered by the version column
 * @method     ChildVolTechnicVersion[]|Collection findByVersionCreatedAt(string $version_created_at) Return ChildVolTechnicVersion objects filtered by the version_created_at column
 * @psalm-method Collection&\Traversable<ChildVolTechnicVersion> findByVersionCreatedAt(string $version_created_at) Return ChildVolTechnicVersion objects filtered by the version_created_at column
 * @method     ChildVolTechnicVersion[]|Collection findByVersionComment(string $version_comment) Return ChildVolTechnicVersion objects filtered by the version_comment column
 * @psalm-method Collection&\Traversable<ChildVolTechnicVersion> findByVersionComment(string $version_comment) Return ChildVolTechnicVersion objects filtered by the version_comment column
 * @method     ChildVolTechnicVersion[]|Collection findByObjStageTechnicIds(array $obj_stage_technic_ids) Return ChildVolTechnicVersion objects filtered by the obj_stage_technic_ids column
 * @psalm-method Collection&\Traversable<ChildVolTechnicVersion> findByObjStageTechnicIds(array $obj_stage_technic_ids) Return ChildVolTechnicVersion objects filtered by the obj_stage_technic_ids column
 * @method     ChildVolTechnicVersion[]|Collection findByObjStageTechnicVersions(array $obj_stage_technic_versions) Return ChildVolTechnicVersion objects filtered by the obj_stage_technic_versions column
 * @psalm-method Collection&\Traversable<ChildVolTechnicVersion> findByObjStageTechnicVersions(array $obj_stage_technic_versions) Return ChildVolTechnicVersion objects filtered by the obj_stage_technic_versions column
 * @method     ChildVolTechnicVersion[]|Collection findByVolWorkTechnicIds(array $vol_work_technic_ids) Return ChildVolTechnicVersion objects filtered by the vol_work_technic_ids column
 * @psalm-method Collection&\Traversable<ChildVolTechnicVersion> findByVolWorkTechnicIds(array $vol_work_technic_ids) Return ChildVolTechnicVersion objects filtered by the vol_work_technic_ids column
 * @method     ChildVolTechnicVersion[]|Collection findByVolWorkTechnicVersions(array $vol_work_technic_versions) Return ChildVolTechnicVersion objects filtered by the vol_work_technic_versions column
 * @psalm-method Collection&\Traversable<ChildVolTechnicVersion> findByVolWorkTechnicVersions(array $vol_work_technic_versions) Return ChildVolTechnicVersion objects filtered by the vol_work_technic_versions column
 * @method     ChildVolTechnicVersion[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildVolTechnicVersion> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class VolTechnicVersionQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \DB\Base\VolTechnicVersionQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\DB\\VolTechnicVersion', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildVolTechnicVersionQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildVolTechnicVersionQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildVolTechnicVersionQuery) {
            return $criteria;
        }
        $query = new ChildVolTechnicVersionQuery();
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
     * @return ChildVolTechnicVersion|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(VolTechnicVersionTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = VolTechnicVersionTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildVolTechnicVersion A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, price, is_available, unit_id, version_created_by, version, version_created_at, version_comment, obj_stage_technic_ids, obj_stage_technic_versions, vol_work_technic_ids, vol_work_technic_versions FROM vol_technic_version WHERE id = :p0 AND version = :p1';
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
            /** @var ChildVolTechnicVersion $obj */
            $obj = new ChildVolTechnicVersion();
            $obj->hydrate($row);
            VolTechnicVersionTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildVolTechnicVersion|array|mixed the result, formatted by the current formatter
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
        $this->addUsingAlias(VolTechnicVersionTableMap::COL_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(VolTechnicVersionTableMap::COL_VERSION, $key[1], Criteria::EQUAL);

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
            $cton0 = $this->getNewCriterion(VolTechnicVersionTableMap::COL_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(VolTechnicVersionTableMap::COL_VERSION, $key[1], Criteria::EQUAL);
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
     * @see       filterByVolTechnic()
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
                $this->addUsingAlias(VolTechnicVersionTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(VolTechnicVersionTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(VolTechnicVersionTableMap::COL_ID, $id, $comparison);

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

        $this->addUsingAlias(VolTechnicVersionTableMap::COL_NAME, $name, $comparison);

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
                $this->addUsingAlias(VolTechnicVersionTableMap::COL_PRICE, $price['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($price['max'])) {
                $this->addUsingAlias(VolTechnicVersionTableMap::COL_PRICE, $price['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(VolTechnicVersionTableMap::COL_PRICE, $price, $comparison);

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

        $this->addUsingAlias(VolTechnicVersionTableMap::COL_IS_AVAILABLE, $isAvailable, $comparison);

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
                $this->addUsingAlias(VolTechnicVersionTableMap::COL_UNIT_ID, $unitId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($unitId['max'])) {
                $this->addUsingAlias(VolTechnicVersionTableMap::COL_UNIT_ID, $unitId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(VolTechnicVersionTableMap::COL_UNIT_ID, $unitId, $comparison);

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
                $this->addUsingAlias(VolTechnicVersionTableMap::COL_VERSION_CREATED_BY, $versionCreatedBy['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($versionCreatedBy['max'])) {
                $this->addUsingAlias(VolTechnicVersionTableMap::COL_VERSION_CREATED_BY, $versionCreatedBy['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(VolTechnicVersionTableMap::COL_VERSION_CREATED_BY, $versionCreatedBy, $comparison);

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
                $this->addUsingAlias(VolTechnicVersionTableMap::COL_VERSION, $version['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($version['max'])) {
                $this->addUsingAlias(VolTechnicVersionTableMap::COL_VERSION, $version['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(VolTechnicVersionTableMap::COL_VERSION, $version, $comparison);

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
                $this->addUsingAlias(VolTechnicVersionTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($versionCreatedAt['max'])) {
                $this->addUsingAlias(VolTechnicVersionTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(VolTechnicVersionTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt, $comparison);

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

        $this->addUsingAlias(VolTechnicVersionTableMap::COL_VERSION_COMMENT, $versionComment, $comparison);

        return $this;
    }

    /**
     * Filter the query on the obj_stage_technic_ids column
     *
     * @param array $objStageTechnicIds The values to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByObjStageTechnicIds($objStageTechnicIds = null, ?string $comparison = null)
    {
        $key = $this->getAliasedColName(VolTechnicVersionTableMap::COL_OBJ_STAGE_TECHNIC_IDS);
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            foreach ($objStageTechnicIds as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addAnd($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_SOME) {
            foreach ($objStageTechnicIds as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addOr($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            foreach ($objStageTechnicIds as $value) {
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

        $this->addUsingAlias(VolTechnicVersionTableMap::COL_OBJ_STAGE_TECHNIC_IDS, $objStageTechnicIds, $comparison);

        return $this;
    }

    /**
     * Filter the query on the obj_stage_technic_ids column
     * @param mixed $objStageTechnicIds The value to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::CONTAINS_ALL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByObjStageTechnicId($objStageTechnicIds = null, ?string $comparison = null)
    {
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            if (is_scalar($objStageTechnicIds)) {
                $objStageTechnicIds = '%| ' . $objStageTechnicIds . ' |%';
                $comparison = Criteria::LIKE;
            }
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            $objStageTechnicIds = '%| ' . $objStageTechnicIds . ' |%';
            $comparison = Criteria::NOT_LIKE;
            $key = $this->getAliasedColName(VolTechnicVersionTableMap::COL_OBJ_STAGE_TECHNIC_IDS);
            if ($this->containsKey($key)) {
                $this->addAnd($key, $objStageTechnicIds, $comparison);
            } else {
                $this->addAnd($key, $objStageTechnicIds, $comparison);
            }
            $this->addOr($key, null, Criteria::ISNULL);

            return $this;
        }

        $this->addUsingAlias(VolTechnicVersionTableMap::COL_OBJ_STAGE_TECHNIC_IDS, $objStageTechnicIds, $comparison);

        return $this;
    }

    /**
     * Filter the query on the obj_stage_technic_versions column
     *
     * @param array $objStageTechnicVersions The values to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByObjStageTechnicVersions($objStageTechnicVersions = null, ?string $comparison = null)
    {
        $key = $this->getAliasedColName(VolTechnicVersionTableMap::COL_OBJ_STAGE_TECHNIC_VERSIONS);
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            foreach ($objStageTechnicVersions as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addAnd($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_SOME) {
            foreach ($objStageTechnicVersions as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addOr($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            foreach ($objStageTechnicVersions as $value) {
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

        $this->addUsingAlias(VolTechnicVersionTableMap::COL_OBJ_STAGE_TECHNIC_VERSIONS, $objStageTechnicVersions, $comparison);

        return $this;
    }

    /**
     * Filter the query on the obj_stage_technic_versions column
     * @param mixed $objStageTechnicVersions The value to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::CONTAINS_ALL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByObjStageTechnicVersion($objStageTechnicVersions = null, ?string $comparison = null)
    {
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            if (is_scalar($objStageTechnicVersions)) {
                $objStageTechnicVersions = '%| ' . $objStageTechnicVersions . ' |%';
                $comparison = Criteria::LIKE;
            }
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            $objStageTechnicVersions = '%| ' . $objStageTechnicVersions . ' |%';
            $comparison = Criteria::NOT_LIKE;
            $key = $this->getAliasedColName(VolTechnicVersionTableMap::COL_OBJ_STAGE_TECHNIC_VERSIONS);
            if ($this->containsKey($key)) {
                $this->addAnd($key, $objStageTechnicVersions, $comparison);
            } else {
                $this->addAnd($key, $objStageTechnicVersions, $comparison);
            }
            $this->addOr($key, null, Criteria::ISNULL);

            return $this;
        }

        $this->addUsingAlias(VolTechnicVersionTableMap::COL_OBJ_STAGE_TECHNIC_VERSIONS, $objStageTechnicVersions, $comparison);

        return $this;
    }

    /**
     * Filter the query on the vol_work_technic_ids column
     *
     * @param array $volWorkTechnicIds The values to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByVolWorkTechnicIds($volWorkTechnicIds = null, ?string $comparison = null)
    {
        $key = $this->getAliasedColName(VolTechnicVersionTableMap::COL_VOL_WORK_TECHNIC_IDS);
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            foreach ($volWorkTechnicIds as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addAnd($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_SOME) {
            foreach ($volWorkTechnicIds as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addOr($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            foreach ($volWorkTechnicIds as $value) {
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

        $this->addUsingAlias(VolTechnicVersionTableMap::COL_VOL_WORK_TECHNIC_IDS, $volWorkTechnicIds, $comparison);

        return $this;
    }

    /**
     * Filter the query on the vol_work_technic_ids column
     * @param mixed $volWorkTechnicIds The value to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::CONTAINS_ALL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByVolWorkTechnicId($volWorkTechnicIds = null, ?string $comparison = null)
    {
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            if (is_scalar($volWorkTechnicIds)) {
                $volWorkTechnicIds = '%| ' . $volWorkTechnicIds . ' |%';
                $comparison = Criteria::LIKE;
            }
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            $volWorkTechnicIds = '%| ' . $volWorkTechnicIds . ' |%';
            $comparison = Criteria::NOT_LIKE;
            $key = $this->getAliasedColName(VolTechnicVersionTableMap::COL_VOL_WORK_TECHNIC_IDS);
            if ($this->containsKey($key)) {
                $this->addAnd($key, $volWorkTechnicIds, $comparison);
            } else {
                $this->addAnd($key, $volWorkTechnicIds, $comparison);
            }
            $this->addOr($key, null, Criteria::ISNULL);

            return $this;
        }

        $this->addUsingAlias(VolTechnicVersionTableMap::COL_VOL_WORK_TECHNIC_IDS, $volWorkTechnicIds, $comparison);

        return $this;
    }

    /**
     * Filter the query on the vol_work_technic_versions column
     *
     * @param array $volWorkTechnicVersions The values to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByVolWorkTechnicVersions($volWorkTechnicVersions = null, ?string $comparison = null)
    {
        $key = $this->getAliasedColName(VolTechnicVersionTableMap::COL_VOL_WORK_TECHNIC_VERSIONS);
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            foreach ($volWorkTechnicVersions as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addAnd($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_SOME) {
            foreach ($volWorkTechnicVersions as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addOr($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            foreach ($volWorkTechnicVersions as $value) {
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

        $this->addUsingAlias(VolTechnicVersionTableMap::COL_VOL_WORK_TECHNIC_VERSIONS, $volWorkTechnicVersions, $comparison);

        return $this;
    }

    /**
     * Filter the query on the vol_work_technic_versions column
     * @param mixed $volWorkTechnicVersions The value to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::CONTAINS_ALL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByVolWorkTechnicVersion($volWorkTechnicVersions = null, ?string $comparison = null)
    {
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            if (is_scalar($volWorkTechnicVersions)) {
                $volWorkTechnicVersions = '%| ' . $volWorkTechnicVersions . ' |%';
                $comparison = Criteria::LIKE;
            }
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            $volWorkTechnicVersions = '%| ' . $volWorkTechnicVersions . ' |%';
            $comparison = Criteria::NOT_LIKE;
            $key = $this->getAliasedColName(VolTechnicVersionTableMap::COL_VOL_WORK_TECHNIC_VERSIONS);
            if ($this->containsKey($key)) {
                $this->addAnd($key, $volWorkTechnicVersions, $comparison);
            } else {
                $this->addAnd($key, $volWorkTechnicVersions, $comparison);
            }
            $this->addOr($key, null, Criteria::ISNULL);

            return $this;
        }

        $this->addUsingAlias(VolTechnicVersionTableMap::COL_VOL_WORK_TECHNIC_VERSIONS, $volWorkTechnicVersions, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \DB\VolTechnic object
     *
     * @param \DB\VolTechnic|ObjectCollection $volTechnic The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByVolTechnic($volTechnic, ?string $comparison = null)
    {
        if ($volTechnic instanceof \DB\VolTechnic) {
            return $this
                ->addUsingAlias(VolTechnicVersionTableMap::COL_ID, $volTechnic->getId(), $comparison);
        } elseif ($volTechnic instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(VolTechnicVersionTableMap::COL_ID, $volTechnic->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByVolTechnic() only accepts arguments of type \DB\VolTechnic or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the VolTechnic relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinVolTechnic(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('VolTechnic');

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
            $this->addJoinObject($join, 'VolTechnic');
        }

        return $this;
    }

    /**
     * Use the VolTechnic relation VolTechnic object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\VolTechnicQuery A secondary query class using the current class as primary query
     */
    public function useVolTechnicQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinVolTechnic($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'VolTechnic', '\DB\VolTechnicQuery');
    }

    /**
     * Use the VolTechnic relation VolTechnic object
     *
     * @param callable(\DB\VolTechnicQuery):\DB\VolTechnicQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withVolTechnicQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useVolTechnicQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to VolTechnic table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\VolTechnicQuery The inner query object of the EXISTS statement
     */
    public function useVolTechnicExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('VolTechnic', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to VolTechnic table for a NOT EXISTS query.
     *
     * @see useVolTechnicExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\VolTechnicQuery The inner query object of the NOT EXISTS statement
     */
    public function useVolTechnicNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('VolTechnic', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Exclude object from result
     *
     * @param ChildVolTechnicVersion $volTechnicVersion Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($volTechnicVersion = null)
    {
        if ($volTechnicVersion) {
            $this->addCond('pruneCond0', $this->getAliasedColName(VolTechnicVersionTableMap::COL_ID), $volTechnicVersion->getId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(VolTechnicVersionTableMap::COL_VERSION), $volTechnicVersion->getVersion(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the vol_technic_version table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(VolTechnicVersionTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            VolTechnicVersionTableMap::clearInstancePool();
            VolTechnicVersionTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(VolTechnicVersionTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(VolTechnicVersionTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            VolTechnicVersionTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            VolTechnicVersionTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
