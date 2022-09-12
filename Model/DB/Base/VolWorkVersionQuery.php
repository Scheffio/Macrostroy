<?php

namespace DB\Base;

use \Exception;
use \PDO;
use DB\VolWorkVersion as ChildVolWorkVersion;
use DB\VolWorkVersionQuery as ChildVolWorkVersionQuery;
use DB\Map\VolWorkVersionTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'vol_work_version' table.
 *
 *
 *
 * @method     ChildVolWorkVersionQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildVolWorkVersionQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildVolWorkVersionQuery orderByPrice($order = Criteria::ASC) Order by the price column
 * @method     ChildVolWorkVersionQuery orderByIsAvailable($order = Criteria::ASC) Order by the is_available column
 * @method     ChildVolWorkVersionQuery orderByUnitId($order = Criteria::ASC) Order by the unit_id column
 * @method     ChildVolWorkVersionQuery orderByVersion($order = Criteria::ASC) Order by the version column
 * @method     ChildVolWorkVersionQuery orderByVersionCreatedAt($order = Criteria::ASC) Order by the version_created_at column
 * @method     ChildVolWorkVersionQuery orderByVersionCreatedBy($order = Criteria::ASC) Order by the version_created_by column
 * @method     ChildVolWorkVersionQuery orderByVersionComment($order = Criteria::ASC) Order by the version_comment column
 * @method     ChildVolWorkVersionQuery orderByObjStageWorkIds($order = Criteria::ASC) Order by the obj_stage_work_ids column
 * @method     ChildVolWorkVersionQuery orderByObjStageWorkVersions($order = Criteria::ASC) Order by the obj_stage_work_versions column
 * @method     ChildVolWorkVersionQuery orderByVolWorkMaterialIds($order = Criteria::ASC) Order by the vol_work_material_ids column
 * @method     ChildVolWorkVersionQuery orderByVolWorkMaterialVersions($order = Criteria::ASC) Order by the vol_work_material_versions column
 * @method     ChildVolWorkVersionQuery orderByVolWorkTechnicIds($order = Criteria::ASC) Order by the vol_work_technic_ids column
 * @method     ChildVolWorkVersionQuery orderByVolWorkTechnicVersions($order = Criteria::ASC) Order by the vol_work_technic_versions column
 *
 * @method     ChildVolWorkVersionQuery groupById() Group by the id column
 * @method     ChildVolWorkVersionQuery groupByName() Group by the name column
 * @method     ChildVolWorkVersionQuery groupByPrice() Group by the price column
 * @method     ChildVolWorkVersionQuery groupByIsAvailable() Group by the is_available column
 * @method     ChildVolWorkVersionQuery groupByUnitId() Group by the unit_id column
 * @method     ChildVolWorkVersionQuery groupByVersion() Group by the version column
 * @method     ChildVolWorkVersionQuery groupByVersionCreatedAt() Group by the version_created_at column
 * @method     ChildVolWorkVersionQuery groupByVersionCreatedBy() Group by the version_created_by column
 * @method     ChildVolWorkVersionQuery groupByVersionComment() Group by the version_comment column
 * @method     ChildVolWorkVersionQuery groupByObjStageWorkIds() Group by the obj_stage_work_ids column
 * @method     ChildVolWorkVersionQuery groupByObjStageWorkVersions() Group by the obj_stage_work_versions column
 * @method     ChildVolWorkVersionQuery groupByVolWorkMaterialIds() Group by the vol_work_material_ids column
 * @method     ChildVolWorkVersionQuery groupByVolWorkMaterialVersions() Group by the vol_work_material_versions column
 * @method     ChildVolWorkVersionQuery groupByVolWorkTechnicIds() Group by the vol_work_technic_ids column
 * @method     ChildVolWorkVersionQuery groupByVolWorkTechnicVersions() Group by the vol_work_technic_versions column
 *
 * @method     ChildVolWorkVersionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildVolWorkVersionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildVolWorkVersionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildVolWorkVersionQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildVolWorkVersionQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildVolWorkVersionQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildVolWorkVersionQuery leftJoinVolWork($relationAlias = null) Adds a LEFT JOIN clause to the query using the VolWork relation
 * @method     ChildVolWorkVersionQuery rightJoinVolWork($relationAlias = null) Adds a RIGHT JOIN clause to the query using the VolWork relation
 * @method     ChildVolWorkVersionQuery innerJoinVolWork($relationAlias = null) Adds a INNER JOIN clause to the query using the VolWork relation
 *
 * @method     ChildVolWorkVersionQuery joinWithVolWork($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the VolWork relation
 *
 * @method     ChildVolWorkVersionQuery leftJoinWithVolWork() Adds a LEFT JOIN clause and with to the query using the VolWork relation
 * @method     ChildVolWorkVersionQuery rightJoinWithVolWork() Adds a RIGHT JOIN clause and with to the query using the VolWork relation
 * @method     ChildVolWorkVersionQuery innerJoinWithVolWork() Adds a INNER JOIN clause and with to the query using the VolWork relation
 *
 * @method     \DB\VolWorkQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildVolWorkVersion|null findOne(?ConnectionInterface $con = null) Return the first ChildVolWorkVersion matching the query
 * @method     ChildVolWorkVersion findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildVolWorkVersion matching the query, or a new ChildVolWorkVersion object populated from the query conditions when no match is found
 *
 * @method     ChildVolWorkVersion|null findOneById(int $id) Return the first ChildVolWorkVersion filtered by the id column
 * @method     ChildVolWorkVersion|null findOneByName(string $name) Return the first ChildVolWorkVersion filtered by the name column
 * @method     ChildVolWorkVersion|null findOneByPrice(string $price) Return the first ChildVolWorkVersion filtered by the price column
 * @method     ChildVolWorkVersion|null findOneByIsAvailable(boolean $is_available) Return the first ChildVolWorkVersion filtered by the is_available column
 * @method     ChildVolWorkVersion|null findOneByUnitId(int $unit_id) Return the first ChildVolWorkVersion filtered by the unit_id column
 * @method     ChildVolWorkVersion|null findOneByVersion(int $version) Return the first ChildVolWorkVersion filtered by the version column
 * @method     ChildVolWorkVersion|null findOneByVersionCreatedAt(string $version_created_at) Return the first ChildVolWorkVersion filtered by the version_created_at column
 * @method     ChildVolWorkVersion|null findOneByVersionCreatedBy(string $version_created_by) Return the first ChildVolWorkVersion filtered by the version_created_by column
 * @method     ChildVolWorkVersion|null findOneByVersionComment(string $version_comment) Return the first ChildVolWorkVersion filtered by the version_comment column
 * @method     ChildVolWorkVersion|null findOneByObjStageWorkIds(array $obj_stage_work_ids) Return the first ChildVolWorkVersion filtered by the obj_stage_work_ids column
 * @method     ChildVolWorkVersion|null findOneByObjStageWorkVersions(array $obj_stage_work_versions) Return the first ChildVolWorkVersion filtered by the obj_stage_work_versions column
 * @method     ChildVolWorkVersion|null findOneByVolWorkMaterialIds(array $vol_work_material_ids) Return the first ChildVolWorkVersion filtered by the vol_work_material_ids column
 * @method     ChildVolWorkVersion|null findOneByVolWorkMaterialVersions(array $vol_work_material_versions) Return the first ChildVolWorkVersion filtered by the vol_work_material_versions column
 * @method     ChildVolWorkVersion|null findOneByVolWorkTechnicIds(array $vol_work_technic_ids) Return the first ChildVolWorkVersion filtered by the vol_work_technic_ids column
 * @method     ChildVolWorkVersion|null findOneByVolWorkTechnicVersions(array $vol_work_technic_versions) Return the first ChildVolWorkVersion filtered by the vol_work_technic_versions column *

 * @method     ChildVolWorkVersion requirePk($key, ?ConnectionInterface $con = null) Return the ChildVolWorkVersion by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolWorkVersion requireOne(?ConnectionInterface $con = null) Return the first ChildVolWorkVersion matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildVolWorkVersion requireOneById(int $id) Return the first ChildVolWorkVersion filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolWorkVersion requireOneByName(string $name) Return the first ChildVolWorkVersion filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolWorkVersion requireOneByPrice(string $price) Return the first ChildVolWorkVersion filtered by the price column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolWorkVersion requireOneByIsAvailable(boolean $is_available) Return the first ChildVolWorkVersion filtered by the is_available column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolWorkVersion requireOneByUnitId(int $unit_id) Return the first ChildVolWorkVersion filtered by the unit_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolWorkVersion requireOneByVersion(int $version) Return the first ChildVolWorkVersion filtered by the version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolWorkVersion requireOneByVersionCreatedAt(string $version_created_at) Return the first ChildVolWorkVersion filtered by the version_created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolWorkVersion requireOneByVersionCreatedBy(string $version_created_by) Return the first ChildVolWorkVersion filtered by the version_created_by column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolWorkVersion requireOneByVersionComment(string $version_comment) Return the first ChildVolWorkVersion filtered by the version_comment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolWorkVersion requireOneByObjStageWorkIds(array $obj_stage_work_ids) Return the first ChildVolWorkVersion filtered by the obj_stage_work_ids column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolWorkVersion requireOneByObjStageWorkVersions(array $obj_stage_work_versions) Return the first ChildVolWorkVersion filtered by the obj_stage_work_versions column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolWorkVersion requireOneByVolWorkMaterialIds(array $vol_work_material_ids) Return the first ChildVolWorkVersion filtered by the vol_work_material_ids column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolWorkVersion requireOneByVolWorkMaterialVersions(array $vol_work_material_versions) Return the first ChildVolWorkVersion filtered by the vol_work_material_versions column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolWorkVersion requireOneByVolWorkTechnicIds(array $vol_work_technic_ids) Return the first ChildVolWorkVersion filtered by the vol_work_technic_ids column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolWorkVersion requireOneByVolWorkTechnicVersions(array $vol_work_technic_versions) Return the first ChildVolWorkVersion filtered by the vol_work_technic_versions column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildVolWorkVersion[]|Collection find(?ConnectionInterface $con = null) Return ChildVolWorkVersion objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildVolWorkVersion> find(?ConnectionInterface $con = null) Return ChildVolWorkVersion objects based on current ModelCriteria
 * @method     ChildVolWorkVersion[]|Collection findById(int $id) Return ChildVolWorkVersion objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildVolWorkVersion> findById(int $id) Return ChildVolWorkVersion objects filtered by the id column
 * @method     ChildVolWorkVersion[]|Collection findByName(string $name) Return ChildVolWorkVersion objects filtered by the name column
 * @psalm-method Collection&\Traversable<ChildVolWorkVersion> findByName(string $name) Return ChildVolWorkVersion objects filtered by the name column
 * @method     ChildVolWorkVersion[]|Collection findByPrice(string $price) Return ChildVolWorkVersion objects filtered by the price column
 * @psalm-method Collection&\Traversable<ChildVolWorkVersion> findByPrice(string $price) Return ChildVolWorkVersion objects filtered by the price column
 * @method     ChildVolWorkVersion[]|Collection findByIsAvailable(boolean $is_available) Return ChildVolWorkVersion objects filtered by the is_available column
 * @psalm-method Collection&\Traversable<ChildVolWorkVersion> findByIsAvailable(boolean $is_available) Return ChildVolWorkVersion objects filtered by the is_available column
 * @method     ChildVolWorkVersion[]|Collection findByUnitId(int $unit_id) Return ChildVolWorkVersion objects filtered by the unit_id column
 * @psalm-method Collection&\Traversable<ChildVolWorkVersion> findByUnitId(int $unit_id) Return ChildVolWorkVersion objects filtered by the unit_id column
 * @method     ChildVolWorkVersion[]|Collection findByVersion(int $version) Return ChildVolWorkVersion objects filtered by the version column
 * @psalm-method Collection&\Traversable<ChildVolWorkVersion> findByVersion(int $version) Return ChildVolWorkVersion objects filtered by the version column
 * @method     ChildVolWorkVersion[]|Collection findByVersionCreatedAt(string $version_created_at) Return ChildVolWorkVersion objects filtered by the version_created_at column
 * @psalm-method Collection&\Traversable<ChildVolWorkVersion> findByVersionCreatedAt(string $version_created_at) Return ChildVolWorkVersion objects filtered by the version_created_at column
 * @method     ChildVolWorkVersion[]|Collection findByVersionCreatedBy(string $version_created_by) Return ChildVolWorkVersion objects filtered by the version_created_by column
 * @psalm-method Collection&\Traversable<ChildVolWorkVersion> findByVersionCreatedBy(string $version_created_by) Return ChildVolWorkVersion objects filtered by the version_created_by column
 * @method     ChildVolWorkVersion[]|Collection findByVersionComment(string $version_comment) Return ChildVolWorkVersion objects filtered by the version_comment column
 * @psalm-method Collection&\Traversable<ChildVolWorkVersion> findByVersionComment(string $version_comment) Return ChildVolWorkVersion objects filtered by the version_comment column
 * @method     ChildVolWorkVersion[]|Collection findByObjStageWorkIds(array $obj_stage_work_ids) Return ChildVolWorkVersion objects filtered by the obj_stage_work_ids column
 * @psalm-method Collection&\Traversable<ChildVolWorkVersion> findByObjStageWorkIds(array $obj_stage_work_ids) Return ChildVolWorkVersion objects filtered by the obj_stage_work_ids column
 * @method     ChildVolWorkVersion[]|Collection findByObjStageWorkVersions(array $obj_stage_work_versions) Return ChildVolWorkVersion objects filtered by the obj_stage_work_versions column
 * @psalm-method Collection&\Traversable<ChildVolWorkVersion> findByObjStageWorkVersions(array $obj_stage_work_versions) Return ChildVolWorkVersion objects filtered by the obj_stage_work_versions column
 * @method     ChildVolWorkVersion[]|Collection findByVolWorkMaterialIds(array $vol_work_material_ids) Return ChildVolWorkVersion objects filtered by the vol_work_material_ids column
 * @psalm-method Collection&\Traversable<ChildVolWorkVersion> findByVolWorkMaterialIds(array $vol_work_material_ids) Return ChildVolWorkVersion objects filtered by the vol_work_material_ids column
 * @method     ChildVolWorkVersion[]|Collection findByVolWorkMaterialVersions(array $vol_work_material_versions) Return ChildVolWorkVersion objects filtered by the vol_work_material_versions column
 * @psalm-method Collection&\Traversable<ChildVolWorkVersion> findByVolWorkMaterialVersions(array $vol_work_material_versions) Return ChildVolWorkVersion objects filtered by the vol_work_material_versions column
 * @method     ChildVolWorkVersion[]|Collection findByVolWorkTechnicIds(array $vol_work_technic_ids) Return ChildVolWorkVersion objects filtered by the vol_work_technic_ids column
 * @psalm-method Collection&\Traversable<ChildVolWorkVersion> findByVolWorkTechnicIds(array $vol_work_technic_ids) Return ChildVolWorkVersion objects filtered by the vol_work_technic_ids column
 * @method     ChildVolWorkVersion[]|Collection findByVolWorkTechnicVersions(array $vol_work_technic_versions) Return ChildVolWorkVersion objects filtered by the vol_work_technic_versions column
 * @psalm-method Collection&\Traversable<ChildVolWorkVersion> findByVolWorkTechnicVersions(array $vol_work_technic_versions) Return ChildVolWorkVersion objects filtered by the vol_work_technic_versions column
 * @method     ChildVolWorkVersion[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildVolWorkVersion> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class VolWorkVersionQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \DB\Base\VolWorkVersionQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\DB\\VolWorkVersion', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildVolWorkVersionQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildVolWorkVersionQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildVolWorkVersionQuery) {
            return $criteria;
        }
        $query = new ChildVolWorkVersionQuery();
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
     * @return ChildVolWorkVersion|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(VolWorkVersionTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = VolWorkVersionTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildVolWorkVersion A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, price, is_available, unit_id, version, version_created_at, version_created_by, version_comment, obj_stage_work_ids, obj_stage_work_versions, vol_work_material_ids, vol_work_material_versions, vol_work_technic_ids, vol_work_technic_versions FROM vol_work_version WHERE id = :p0 AND version = :p1';
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
            /** @var ChildVolWorkVersion $obj */
            $obj = new ChildVolWorkVersion();
            $obj->hydrate($row);
            VolWorkVersionTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildVolWorkVersion|array|mixed the result, formatted by the current formatter
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
        $this->addUsingAlias(VolWorkVersionTableMap::COL_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(VolWorkVersionTableMap::COL_VERSION, $key[1], Criteria::EQUAL);

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
            $cton0 = $this->getNewCriterion(VolWorkVersionTableMap::COL_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(VolWorkVersionTableMap::COL_VERSION, $key[1], Criteria::EQUAL);
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
     * @see       filterByVolWork()
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
                $this->addUsingAlias(VolWorkVersionTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(VolWorkVersionTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(VolWorkVersionTableMap::COL_ID, $id, $comparison);

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

        $this->addUsingAlias(VolWorkVersionTableMap::COL_NAME, $name, $comparison);

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
                $this->addUsingAlias(VolWorkVersionTableMap::COL_PRICE, $price['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($price['max'])) {
                $this->addUsingAlias(VolWorkVersionTableMap::COL_PRICE, $price['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(VolWorkVersionTableMap::COL_PRICE, $price, $comparison);

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

        $this->addUsingAlias(VolWorkVersionTableMap::COL_IS_AVAILABLE, $isAvailable, $comparison);

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
                $this->addUsingAlias(VolWorkVersionTableMap::COL_UNIT_ID, $unitId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($unitId['max'])) {
                $this->addUsingAlias(VolWorkVersionTableMap::COL_UNIT_ID, $unitId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(VolWorkVersionTableMap::COL_UNIT_ID, $unitId, $comparison);

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
                $this->addUsingAlias(VolWorkVersionTableMap::COL_VERSION, $version['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($version['max'])) {
                $this->addUsingAlias(VolWorkVersionTableMap::COL_VERSION, $version['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(VolWorkVersionTableMap::COL_VERSION, $version, $comparison);

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
                $this->addUsingAlias(VolWorkVersionTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($versionCreatedAt['max'])) {
                $this->addUsingAlias(VolWorkVersionTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(VolWorkVersionTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt, $comparison);

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

        $this->addUsingAlias(VolWorkVersionTableMap::COL_VERSION_CREATED_BY, $versionCreatedBy, $comparison);

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

        $this->addUsingAlias(VolWorkVersionTableMap::COL_VERSION_COMMENT, $versionComment, $comparison);

        return $this;
    }

    /**
     * Filter the query on the obj_stage_work_ids column
     *
     * @param array $objStageWorkIds The values to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByObjStageWorkIds($objStageWorkIds = null, ?string $comparison = null)
    {
        $key = $this->getAliasedColName(VolWorkVersionTableMap::COL_OBJ_STAGE_WORK_IDS);
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            foreach ($objStageWorkIds as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addAnd($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_SOME) {
            foreach ($objStageWorkIds as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addOr($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            foreach ($objStageWorkIds as $value) {
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

        $this->addUsingAlias(VolWorkVersionTableMap::COL_OBJ_STAGE_WORK_IDS, $objStageWorkIds, $comparison);

        return $this;
    }

    /**
     * Filter the query on the obj_stage_work_ids column
     * @param mixed $objStageWorkIds The value to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::CONTAINS_ALL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByObjStageWorkId($objStageWorkIds = null, ?string $comparison = null)
    {
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            if (is_scalar($objStageWorkIds)) {
                $objStageWorkIds = '%| ' . $objStageWorkIds . ' |%';
                $comparison = Criteria::LIKE;
            }
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            $objStageWorkIds = '%| ' . $objStageWorkIds . ' |%';
            $comparison = Criteria::NOT_LIKE;
            $key = $this->getAliasedColName(VolWorkVersionTableMap::COL_OBJ_STAGE_WORK_IDS);
            if ($this->containsKey($key)) {
                $this->addAnd($key, $objStageWorkIds, $comparison);
            } else {
                $this->addAnd($key, $objStageWorkIds, $comparison);
            }
            $this->addOr($key, null, Criteria::ISNULL);

            return $this;
        }

        $this->addUsingAlias(VolWorkVersionTableMap::COL_OBJ_STAGE_WORK_IDS, $objStageWorkIds, $comparison);

        return $this;
    }

    /**
     * Filter the query on the obj_stage_work_versions column
     *
     * @param array $objStageWorkVersions The values to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByObjStageWorkVersions($objStageWorkVersions = null, ?string $comparison = null)
    {
        $key = $this->getAliasedColName(VolWorkVersionTableMap::COL_OBJ_STAGE_WORK_VERSIONS);
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            foreach ($objStageWorkVersions as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addAnd($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_SOME) {
            foreach ($objStageWorkVersions as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addOr($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            foreach ($objStageWorkVersions as $value) {
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

        $this->addUsingAlias(VolWorkVersionTableMap::COL_OBJ_STAGE_WORK_VERSIONS, $objStageWorkVersions, $comparison);

        return $this;
    }

    /**
     * Filter the query on the obj_stage_work_versions column
     * @param mixed $objStageWorkVersions The value to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::CONTAINS_ALL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByObjStageWorkVersion($objStageWorkVersions = null, ?string $comparison = null)
    {
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            if (is_scalar($objStageWorkVersions)) {
                $objStageWorkVersions = '%| ' . $objStageWorkVersions . ' |%';
                $comparison = Criteria::LIKE;
            }
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            $objStageWorkVersions = '%| ' . $objStageWorkVersions . ' |%';
            $comparison = Criteria::NOT_LIKE;
            $key = $this->getAliasedColName(VolWorkVersionTableMap::COL_OBJ_STAGE_WORK_VERSIONS);
            if ($this->containsKey($key)) {
                $this->addAnd($key, $objStageWorkVersions, $comparison);
            } else {
                $this->addAnd($key, $objStageWorkVersions, $comparison);
            }
            $this->addOr($key, null, Criteria::ISNULL);

            return $this;
        }

        $this->addUsingAlias(VolWorkVersionTableMap::COL_OBJ_STAGE_WORK_VERSIONS, $objStageWorkVersions, $comparison);

        return $this;
    }

    /**
     * Filter the query on the vol_work_material_ids column
     *
     * @param array $volWorkMaterialIds The values to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByVolWorkMaterialIds($volWorkMaterialIds = null, ?string $comparison = null)
    {
        $key = $this->getAliasedColName(VolWorkVersionTableMap::COL_VOL_WORK_MATERIAL_IDS);
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            foreach ($volWorkMaterialIds as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addAnd($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_SOME) {
            foreach ($volWorkMaterialIds as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addOr($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            foreach ($volWorkMaterialIds as $value) {
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

        $this->addUsingAlias(VolWorkVersionTableMap::COL_VOL_WORK_MATERIAL_IDS, $volWorkMaterialIds, $comparison);

        return $this;
    }

    /**
     * Filter the query on the vol_work_material_ids column
     * @param mixed $volWorkMaterialIds The value to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::CONTAINS_ALL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByVolWorkMaterialId($volWorkMaterialIds = null, ?string $comparison = null)
    {
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            if (is_scalar($volWorkMaterialIds)) {
                $volWorkMaterialIds = '%| ' . $volWorkMaterialIds . ' |%';
                $comparison = Criteria::LIKE;
            }
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            $volWorkMaterialIds = '%| ' . $volWorkMaterialIds . ' |%';
            $comparison = Criteria::NOT_LIKE;
            $key = $this->getAliasedColName(VolWorkVersionTableMap::COL_VOL_WORK_MATERIAL_IDS);
            if ($this->containsKey($key)) {
                $this->addAnd($key, $volWorkMaterialIds, $comparison);
            } else {
                $this->addAnd($key, $volWorkMaterialIds, $comparison);
            }
            $this->addOr($key, null, Criteria::ISNULL);

            return $this;
        }

        $this->addUsingAlias(VolWorkVersionTableMap::COL_VOL_WORK_MATERIAL_IDS, $volWorkMaterialIds, $comparison);

        return $this;
    }

    /**
     * Filter the query on the vol_work_material_versions column
     *
     * @param array $volWorkMaterialVersions The values to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByVolWorkMaterialVersions($volWorkMaterialVersions = null, ?string $comparison = null)
    {
        $key = $this->getAliasedColName(VolWorkVersionTableMap::COL_VOL_WORK_MATERIAL_VERSIONS);
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            foreach ($volWorkMaterialVersions as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addAnd($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_SOME) {
            foreach ($volWorkMaterialVersions as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addOr($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            foreach ($volWorkMaterialVersions as $value) {
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

        $this->addUsingAlias(VolWorkVersionTableMap::COL_VOL_WORK_MATERIAL_VERSIONS, $volWorkMaterialVersions, $comparison);

        return $this;
    }

    /**
     * Filter the query on the vol_work_material_versions column
     * @param mixed $volWorkMaterialVersions The value to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::CONTAINS_ALL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByVolWorkMaterialVersion($volWorkMaterialVersions = null, ?string $comparison = null)
    {
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            if (is_scalar($volWorkMaterialVersions)) {
                $volWorkMaterialVersions = '%| ' . $volWorkMaterialVersions . ' |%';
                $comparison = Criteria::LIKE;
            }
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            $volWorkMaterialVersions = '%| ' . $volWorkMaterialVersions . ' |%';
            $comparison = Criteria::NOT_LIKE;
            $key = $this->getAliasedColName(VolWorkVersionTableMap::COL_VOL_WORK_MATERIAL_VERSIONS);
            if ($this->containsKey($key)) {
                $this->addAnd($key, $volWorkMaterialVersions, $comparison);
            } else {
                $this->addAnd($key, $volWorkMaterialVersions, $comparison);
            }
            $this->addOr($key, null, Criteria::ISNULL);

            return $this;
        }

        $this->addUsingAlias(VolWorkVersionTableMap::COL_VOL_WORK_MATERIAL_VERSIONS, $volWorkMaterialVersions, $comparison);

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
        $key = $this->getAliasedColName(VolWorkVersionTableMap::COL_VOL_WORK_TECHNIC_IDS);
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

        $this->addUsingAlias(VolWorkVersionTableMap::COL_VOL_WORK_TECHNIC_IDS, $volWorkTechnicIds, $comparison);

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
            $key = $this->getAliasedColName(VolWorkVersionTableMap::COL_VOL_WORK_TECHNIC_IDS);
            if ($this->containsKey($key)) {
                $this->addAnd($key, $volWorkTechnicIds, $comparison);
            } else {
                $this->addAnd($key, $volWorkTechnicIds, $comparison);
            }
            $this->addOr($key, null, Criteria::ISNULL);

            return $this;
        }

        $this->addUsingAlias(VolWorkVersionTableMap::COL_VOL_WORK_TECHNIC_IDS, $volWorkTechnicIds, $comparison);

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
        $key = $this->getAliasedColName(VolWorkVersionTableMap::COL_VOL_WORK_TECHNIC_VERSIONS);
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

        $this->addUsingAlias(VolWorkVersionTableMap::COL_VOL_WORK_TECHNIC_VERSIONS, $volWorkTechnicVersions, $comparison);

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
            $key = $this->getAliasedColName(VolWorkVersionTableMap::COL_VOL_WORK_TECHNIC_VERSIONS);
            if ($this->containsKey($key)) {
                $this->addAnd($key, $volWorkTechnicVersions, $comparison);
            } else {
                $this->addAnd($key, $volWorkTechnicVersions, $comparison);
            }
            $this->addOr($key, null, Criteria::ISNULL);

            return $this;
        }

        $this->addUsingAlias(VolWorkVersionTableMap::COL_VOL_WORK_TECHNIC_VERSIONS, $volWorkTechnicVersions, $comparison);

        return $this;
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
                ->addUsingAlias(VolWorkVersionTableMap::COL_ID, $volWork->getId(), $comparison);
        } elseif ($volWork instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(VolWorkVersionTableMap::COL_ID, $volWork->toKeyValue('PrimaryKey', 'Id'), $comparison);

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
     * Exclude object from result
     *
     * @param ChildVolWorkVersion $volWorkVersion Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($volWorkVersion = null)
    {
        if ($volWorkVersion) {
            $this->addCond('pruneCond0', $this->getAliasedColName(VolWorkVersionTableMap::COL_ID), $volWorkVersion->getId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(VolWorkVersionTableMap::COL_VERSION), $volWorkVersion->getVersion(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the vol_work_version table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(VolWorkVersionTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            VolWorkVersionTableMap::clearInstancePool();
            VolWorkVersionTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(VolWorkVersionTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(VolWorkVersionTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            VolWorkVersionTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            VolWorkVersionTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
