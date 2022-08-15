<?php

namespace DB\Base;

use \Exception;
use \PDO;
use DB\MaterialVersion as ChildMaterialVersion;
use DB\MaterialVersionQuery as ChildMaterialVersionQuery;
use DB\Map\MaterialVersionTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'material_version' table.
 *
 *
 *
 * @method     ChildMaterialVersionQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildMaterialVersionQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildMaterialVersionQuery orderByPrice($order = Criteria::ASC) Order by the price column
 * @method     ChildMaterialVersionQuery orderByIsAvailable($order = Criteria::ASC) Order by the is_available column
 * @method     ChildMaterialVersionQuery orderByUnitId($order = Criteria::ASC) Order by the unit_id column
 * @method     ChildMaterialVersionQuery orderByVersion($order = Criteria::ASC) Order by the version column
 * @method     ChildMaterialVersionQuery orderByUnitIdVersion($order = Criteria::ASC) Order by the unit_id_version column
 * @method     ChildMaterialVersionQuery orderByStageMaterialIds($order = Criteria::ASC) Order by the stage_material_ids column
 * @method     ChildMaterialVersionQuery orderByStageMaterialVersions($order = Criteria::ASC) Order by the stage_material_versions column
 * @method     ChildMaterialVersionQuery orderByWorkMaterialIds($order = Criteria::ASC) Order by the work_material_ids column
 * @method     ChildMaterialVersionQuery orderByWorkMaterialVersions($order = Criteria::ASC) Order by the work_material_versions column
 *
 * @method     ChildMaterialVersionQuery groupById() Group by the id column
 * @method     ChildMaterialVersionQuery groupByName() Group by the name column
 * @method     ChildMaterialVersionQuery groupByPrice() Group by the price column
 * @method     ChildMaterialVersionQuery groupByIsAvailable() Group by the is_available column
 * @method     ChildMaterialVersionQuery groupByUnitId() Group by the unit_id column
 * @method     ChildMaterialVersionQuery groupByVersion() Group by the version column
 * @method     ChildMaterialVersionQuery groupByUnitIdVersion() Group by the unit_id_version column
 * @method     ChildMaterialVersionQuery groupByStageMaterialIds() Group by the stage_material_ids column
 * @method     ChildMaterialVersionQuery groupByStageMaterialVersions() Group by the stage_material_versions column
 * @method     ChildMaterialVersionQuery groupByWorkMaterialIds() Group by the work_material_ids column
 * @method     ChildMaterialVersionQuery groupByWorkMaterialVersions() Group by the work_material_versions column
 *
 * @method     ChildMaterialVersionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildMaterialVersionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildMaterialVersionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildMaterialVersionQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildMaterialVersionQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildMaterialVersionQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildMaterialVersionQuery leftJoinMaterial($relationAlias = null) Adds a LEFT JOIN clause to the query using the Material relation
 * @method     ChildMaterialVersionQuery rightJoinMaterial($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Material relation
 * @method     ChildMaterialVersionQuery innerJoinMaterial($relationAlias = null) Adds a INNER JOIN clause to the query using the Material relation
 *
 * @method     ChildMaterialVersionQuery joinWithMaterial($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Material relation
 *
 * @method     ChildMaterialVersionQuery leftJoinWithMaterial() Adds a LEFT JOIN clause and with to the query using the Material relation
 * @method     ChildMaterialVersionQuery rightJoinWithMaterial() Adds a RIGHT JOIN clause and with to the query using the Material relation
 * @method     ChildMaterialVersionQuery innerJoinWithMaterial() Adds a INNER JOIN clause and with to the query using the Material relation
 *
 * @method     \DB\MaterialQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildMaterialVersion|null findOne(?ConnectionInterface $con = null) Return the first ChildMaterialVersion matching the query
 * @method     ChildMaterialVersion findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildMaterialVersion matching the query, or a new ChildMaterialVersion object populated from the query conditions when no match is found
 *
 * @method     ChildMaterialVersion|null findOneById(int $id) Return the first ChildMaterialVersion filtered by the id column
 * @method     ChildMaterialVersion|null findOneByName(string $name) Return the first ChildMaterialVersion filtered by the name column
 * @method     ChildMaterialVersion|null findOneByPrice(string $price) Return the first ChildMaterialVersion filtered by the price column
 * @method     ChildMaterialVersion|null findOneByIsAvailable(boolean $is_available) Return the first ChildMaterialVersion filtered by the is_available column
 * @method     ChildMaterialVersion|null findOneByUnitId(int $unit_id) Return the first ChildMaterialVersion filtered by the unit_id column
 * @method     ChildMaterialVersion|null findOneByVersion(int $version) Return the first ChildMaterialVersion filtered by the version column
 * @method     ChildMaterialVersion|null findOneByUnitIdVersion(int $unit_id_version) Return the first ChildMaterialVersion filtered by the unit_id_version column
 * @method     ChildMaterialVersion|null findOneByStageMaterialIds(array $stage_material_ids) Return the first ChildMaterialVersion filtered by the stage_material_ids column
 * @method     ChildMaterialVersion|null findOneByStageMaterialVersions(array $stage_material_versions) Return the first ChildMaterialVersion filtered by the stage_material_versions column
 * @method     ChildMaterialVersion|null findOneByWorkMaterialIds(array $work_material_ids) Return the first ChildMaterialVersion filtered by the work_material_ids column
 * @method     ChildMaterialVersion|null findOneByWorkMaterialVersions(array $work_material_versions) Return the first ChildMaterialVersion filtered by the work_material_versions column *

 * @method     ChildMaterialVersion requirePk($key, ?ConnectionInterface $con = null) Return the ChildMaterialVersion by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMaterialVersion requireOne(?ConnectionInterface $con = null) Return the first ChildMaterialVersion matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildMaterialVersion requireOneById(int $id) Return the first ChildMaterialVersion filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMaterialVersion requireOneByName(string $name) Return the first ChildMaterialVersion filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMaterialVersion requireOneByPrice(string $price) Return the first ChildMaterialVersion filtered by the price column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMaterialVersion requireOneByIsAvailable(boolean $is_available) Return the first ChildMaterialVersion filtered by the is_available column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMaterialVersion requireOneByUnitId(int $unit_id) Return the first ChildMaterialVersion filtered by the unit_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMaterialVersion requireOneByVersion(int $version) Return the first ChildMaterialVersion filtered by the version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMaterialVersion requireOneByUnitIdVersion(int $unit_id_version) Return the first ChildMaterialVersion filtered by the unit_id_version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMaterialVersion requireOneByStageMaterialIds(array $stage_material_ids) Return the first ChildMaterialVersion filtered by the stage_material_ids column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMaterialVersion requireOneByStageMaterialVersions(array $stage_material_versions) Return the first ChildMaterialVersion filtered by the stage_material_versions column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMaterialVersion requireOneByWorkMaterialIds(array $work_material_ids) Return the first ChildMaterialVersion filtered by the work_material_ids column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMaterialVersion requireOneByWorkMaterialVersions(array $work_material_versions) Return the first ChildMaterialVersion filtered by the work_material_versions column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildMaterialVersion[]|Collection find(?ConnectionInterface $con = null) Return ChildMaterialVersion objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildMaterialVersion> find(?ConnectionInterface $con = null) Return ChildMaterialVersion objects based on current ModelCriteria
 * @method     ChildMaterialVersion[]|Collection findById(int $id) Return ChildMaterialVersion objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildMaterialVersion> findById(int $id) Return ChildMaterialVersion objects filtered by the id column
 * @method     ChildMaterialVersion[]|Collection findByName(string $name) Return ChildMaterialVersion objects filtered by the name column
 * @psalm-method Collection&\Traversable<ChildMaterialVersion> findByName(string $name) Return ChildMaterialVersion objects filtered by the name column
 * @method     ChildMaterialVersion[]|Collection findByPrice(string $price) Return ChildMaterialVersion objects filtered by the price column
 * @psalm-method Collection&\Traversable<ChildMaterialVersion> findByPrice(string $price) Return ChildMaterialVersion objects filtered by the price column
 * @method     ChildMaterialVersion[]|Collection findByIsAvailable(boolean $is_available) Return ChildMaterialVersion objects filtered by the is_available column
 * @psalm-method Collection&\Traversable<ChildMaterialVersion> findByIsAvailable(boolean $is_available) Return ChildMaterialVersion objects filtered by the is_available column
 * @method     ChildMaterialVersion[]|Collection findByUnitId(int $unit_id) Return ChildMaterialVersion objects filtered by the unit_id column
 * @psalm-method Collection&\Traversable<ChildMaterialVersion> findByUnitId(int $unit_id) Return ChildMaterialVersion objects filtered by the unit_id column
 * @method     ChildMaterialVersion[]|Collection findByVersion(int $version) Return ChildMaterialVersion objects filtered by the version column
 * @psalm-method Collection&\Traversable<ChildMaterialVersion> findByVersion(int $version) Return ChildMaterialVersion objects filtered by the version column
 * @method     ChildMaterialVersion[]|Collection findByUnitIdVersion(int $unit_id_version) Return ChildMaterialVersion objects filtered by the unit_id_version column
 * @psalm-method Collection&\Traversable<ChildMaterialVersion> findByUnitIdVersion(int $unit_id_version) Return ChildMaterialVersion objects filtered by the unit_id_version column
 * @method     ChildMaterialVersion[]|Collection findByStageMaterialIds(array $stage_material_ids) Return ChildMaterialVersion objects filtered by the stage_material_ids column
 * @psalm-method Collection&\Traversable<ChildMaterialVersion> findByStageMaterialIds(array $stage_material_ids) Return ChildMaterialVersion objects filtered by the stage_material_ids column
 * @method     ChildMaterialVersion[]|Collection findByStageMaterialVersions(array $stage_material_versions) Return ChildMaterialVersion objects filtered by the stage_material_versions column
 * @psalm-method Collection&\Traversable<ChildMaterialVersion> findByStageMaterialVersions(array $stage_material_versions) Return ChildMaterialVersion objects filtered by the stage_material_versions column
 * @method     ChildMaterialVersion[]|Collection findByWorkMaterialIds(array $work_material_ids) Return ChildMaterialVersion objects filtered by the work_material_ids column
 * @psalm-method Collection&\Traversable<ChildMaterialVersion> findByWorkMaterialIds(array $work_material_ids) Return ChildMaterialVersion objects filtered by the work_material_ids column
 * @method     ChildMaterialVersion[]|Collection findByWorkMaterialVersions(array $work_material_versions) Return ChildMaterialVersion objects filtered by the work_material_versions column
 * @psalm-method Collection&\Traversable<ChildMaterialVersion> findByWorkMaterialVersions(array $work_material_versions) Return ChildMaterialVersion objects filtered by the work_material_versions column
 * @method     ChildMaterialVersion[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildMaterialVersion> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class MaterialVersionQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \DB\Base\MaterialVersionQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\DB\\MaterialVersion', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildMaterialVersionQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildMaterialVersionQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildMaterialVersionQuery) {
            return $criteria;
        }
        $query = new ChildMaterialVersionQuery();
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
     * @return ChildMaterialVersion|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(MaterialVersionTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = MaterialVersionTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildMaterialVersion A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, price, is_available, unit_id, version, unit_id_version, stage_material_ids, stage_material_versions, work_material_ids, work_material_versions FROM material_version WHERE id = :p0 AND version = :p1';
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
            /** @var ChildMaterialVersion $obj */
            $obj = new ChildMaterialVersion();
            $obj->hydrate($row);
            MaterialVersionTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildMaterialVersion|array|mixed the result, formatted by the current formatter
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
        $this->addUsingAlias(MaterialVersionTableMap::COL_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(MaterialVersionTableMap::COL_VERSION, $key[1], Criteria::EQUAL);

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
            $cton0 = $this->getNewCriterion(MaterialVersionTableMap::COL_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(MaterialVersionTableMap::COL_VERSION, $key[1], Criteria::EQUAL);
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
     * @see       filterByMaterial()
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
                $this->addUsingAlias(MaterialVersionTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(MaterialVersionTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MaterialVersionTableMap::COL_ID, $id, $comparison);

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

        $this->addUsingAlias(MaterialVersionTableMap::COL_NAME, $name, $comparison);

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
                $this->addUsingAlias(MaterialVersionTableMap::COL_PRICE, $price['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($price['max'])) {
                $this->addUsingAlias(MaterialVersionTableMap::COL_PRICE, $price['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MaterialVersionTableMap::COL_PRICE, $price, $comparison);

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

        $this->addUsingAlias(MaterialVersionTableMap::COL_IS_AVAILABLE, $isAvailable, $comparison);

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
                $this->addUsingAlias(MaterialVersionTableMap::COL_UNIT_ID, $unitId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($unitId['max'])) {
                $this->addUsingAlias(MaterialVersionTableMap::COL_UNIT_ID, $unitId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MaterialVersionTableMap::COL_UNIT_ID, $unitId, $comparison);

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
                $this->addUsingAlias(MaterialVersionTableMap::COL_VERSION, $version['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($version['max'])) {
                $this->addUsingAlias(MaterialVersionTableMap::COL_VERSION, $version['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MaterialVersionTableMap::COL_VERSION, $version, $comparison);

        return $this;
    }

    /**
     * Filter the query on the unit_id_version column
     *
     * Example usage:
     * <code>
     * $query->filterByUnitIdVersion(1234); // WHERE unit_id_version = 1234
     * $query->filterByUnitIdVersion(array(12, 34)); // WHERE unit_id_version IN (12, 34)
     * $query->filterByUnitIdVersion(array('min' => 12)); // WHERE unit_id_version > 12
     * </code>
     *
     * @param mixed $unitIdVersion The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUnitIdVersion($unitIdVersion = null, ?string $comparison = null)
    {
        if (is_array($unitIdVersion)) {
            $useMinMax = false;
            if (isset($unitIdVersion['min'])) {
                $this->addUsingAlias(MaterialVersionTableMap::COL_UNIT_ID_VERSION, $unitIdVersion['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($unitIdVersion['max'])) {
                $this->addUsingAlias(MaterialVersionTableMap::COL_UNIT_ID_VERSION, $unitIdVersion['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(MaterialVersionTableMap::COL_UNIT_ID_VERSION, $unitIdVersion, $comparison);

        return $this;
    }

    /**
     * Filter the query on the stage_material_ids column
     *
     * @param array $stageMaterialIds The values to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStageMaterialIds($stageMaterialIds = null, ?string $comparison = null)
    {
        $key = $this->getAliasedColName(MaterialVersionTableMap::COL_STAGE_MATERIAL_IDS);
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            foreach ($stageMaterialIds as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addAnd($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_SOME) {
            foreach ($stageMaterialIds as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addOr($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            foreach ($stageMaterialIds as $value) {
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

        $this->addUsingAlias(MaterialVersionTableMap::COL_STAGE_MATERIAL_IDS, $stageMaterialIds, $comparison);

        return $this;
    }

    /**
     * Filter the query on the stage_material_ids column
     * @param mixed $stageMaterialIds The value to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::CONTAINS_ALL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStageMaterialId($stageMaterialIds = null, ?string $comparison = null)
    {
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            if (is_scalar($stageMaterialIds)) {
                $stageMaterialIds = '%| ' . $stageMaterialIds . ' |%';
                $comparison = Criteria::LIKE;
            }
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            $stageMaterialIds = '%| ' . $stageMaterialIds . ' |%';
            $comparison = Criteria::NOT_LIKE;
            $key = $this->getAliasedColName(MaterialVersionTableMap::COL_STAGE_MATERIAL_IDS);
            if ($this->containsKey($key)) {
                $this->addAnd($key, $stageMaterialIds, $comparison);
            } else {
                $this->addAnd($key, $stageMaterialIds, $comparison);
            }
            $this->addOr($key, null, Criteria::ISNULL);

            return $this;
        }

        $this->addUsingAlias(MaterialVersionTableMap::COL_STAGE_MATERIAL_IDS, $stageMaterialIds, $comparison);

        return $this;
    }

    /**
     * Filter the query on the stage_material_versions column
     *
     * @param array $stageMaterialVersions The values to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStageMaterialVersions($stageMaterialVersions = null, ?string $comparison = null)
    {
        $key = $this->getAliasedColName(MaterialVersionTableMap::COL_STAGE_MATERIAL_VERSIONS);
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            foreach ($stageMaterialVersions as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addAnd($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_SOME) {
            foreach ($stageMaterialVersions as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addOr($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            foreach ($stageMaterialVersions as $value) {
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

        $this->addUsingAlias(MaterialVersionTableMap::COL_STAGE_MATERIAL_VERSIONS, $stageMaterialVersions, $comparison);

        return $this;
    }

    /**
     * Filter the query on the stage_material_versions column
     * @param mixed $stageMaterialVersions The value to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::CONTAINS_ALL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStageMaterialVersion($stageMaterialVersions = null, ?string $comparison = null)
    {
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            if (is_scalar($stageMaterialVersions)) {
                $stageMaterialVersions = '%| ' . $stageMaterialVersions . ' |%';
                $comparison = Criteria::LIKE;
            }
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            $stageMaterialVersions = '%| ' . $stageMaterialVersions . ' |%';
            $comparison = Criteria::NOT_LIKE;
            $key = $this->getAliasedColName(MaterialVersionTableMap::COL_STAGE_MATERIAL_VERSIONS);
            if ($this->containsKey($key)) {
                $this->addAnd($key, $stageMaterialVersions, $comparison);
            } else {
                $this->addAnd($key, $stageMaterialVersions, $comparison);
            }
            $this->addOr($key, null, Criteria::ISNULL);

            return $this;
        }

        $this->addUsingAlias(MaterialVersionTableMap::COL_STAGE_MATERIAL_VERSIONS, $stageMaterialVersions, $comparison);

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
        $key = $this->getAliasedColName(MaterialVersionTableMap::COL_WORK_MATERIAL_IDS);
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

        $this->addUsingAlias(MaterialVersionTableMap::COL_WORK_MATERIAL_IDS, $workMaterialIds, $comparison);

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
            $key = $this->getAliasedColName(MaterialVersionTableMap::COL_WORK_MATERIAL_IDS);
            if ($this->containsKey($key)) {
                $this->addAnd($key, $workMaterialIds, $comparison);
            } else {
                $this->addAnd($key, $workMaterialIds, $comparison);
            }
            $this->addOr($key, null, Criteria::ISNULL);

            return $this;
        }

        $this->addUsingAlias(MaterialVersionTableMap::COL_WORK_MATERIAL_IDS, $workMaterialIds, $comparison);

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
        $key = $this->getAliasedColName(MaterialVersionTableMap::COL_WORK_MATERIAL_VERSIONS);
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

        $this->addUsingAlias(MaterialVersionTableMap::COL_WORK_MATERIAL_VERSIONS, $workMaterialVersions, $comparison);

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
            $key = $this->getAliasedColName(MaterialVersionTableMap::COL_WORK_MATERIAL_VERSIONS);
            if ($this->containsKey($key)) {
                $this->addAnd($key, $workMaterialVersions, $comparison);
            } else {
                $this->addAnd($key, $workMaterialVersions, $comparison);
            }
            $this->addOr($key, null, Criteria::ISNULL);

            return $this;
        }

        $this->addUsingAlias(MaterialVersionTableMap::COL_WORK_MATERIAL_VERSIONS, $workMaterialVersions, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \DB\Material object
     *
     * @param \DB\Material|ObjectCollection $material The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMaterial($material, ?string $comparison = null)
    {
        if ($material instanceof \DB\Material) {
            return $this
                ->addUsingAlias(MaterialVersionTableMap::COL_ID, $material->getId(), $comparison);
        } elseif ($material instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(MaterialVersionTableMap::COL_ID, $material->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByMaterial() only accepts arguments of type \DB\Material or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Material relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinMaterial(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Material');

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
            $this->addJoinObject($join, 'Material');
        }

        return $this;
    }

    /**
     * Use the Material relation Material object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\MaterialQuery A secondary query class using the current class as primary query
     */
    public function useMaterialQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinMaterial($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Material', '\DB\MaterialQuery');
    }

    /**
     * Use the Material relation Material object
     *
     * @param callable(\DB\MaterialQuery):\DB\MaterialQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withMaterialQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useMaterialQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to Material table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\MaterialQuery The inner query object of the EXISTS statement
     */
    public function useMaterialExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('Material', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to Material table for a NOT EXISTS query.
     *
     * @see useMaterialExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\MaterialQuery The inner query object of the NOT EXISTS statement
     */
    public function useMaterialNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('Material', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Exclude object from result
     *
     * @param ChildMaterialVersion $materialVersion Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($materialVersion = null)
    {
        if ($materialVersion) {
            $this->addCond('pruneCond0', $this->getAliasedColName(MaterialVersionTableMap::COL_ID), $materialVersion->getId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(MaterialVersionTableMap::COL_VERSION), $materialVersion->getVersion(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the material_version table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(MaterialVersionTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            MaterialVersionTableMap::clearInstancePool();
            MaterialVersionTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(MaterialVersionTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(MaterialVersionTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            MaterialVersionTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            MaterialVersionTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
