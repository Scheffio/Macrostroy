<?php

namespace DB\Base;

use \Exception;
use \PDO;
use DB\ObjStageMaterial as ChildObjStageMaterial;
use DB\ObjStageMaterialQuery as ChildObjStageMaterialQuery;
use DB\Map\ObjStageMaterialTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'obj_stage_material' table.
 *
 *
 *
 * @method     ChildObjStageMaterialQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildObjStageMaterialQuery orderByPrice($order = Criteria::ASC) Order by the price column
 * @method     ChildObjStageMaterialQuery orderByAmount($order = Criteria::ASC) Order by the amount column
 * @method     ChildObjStageMaterialQuery orderByIsAvailable($order = Criteria::ASC) Order by the is_available column
 * @method     ChildObjStageMaterialQuery orderByMaterialId($order = Criteria::ASC) Order by the material_id column
 * @method     ChildObjStageMaterialQuery orderByStageWorkId($order = Criteria::ASC) Order by the stage_work_id column
 * @method     ChildObjStageMaterialQuery orderByVersionCreatedBy($order = Criteria::ASC) Order by the version_created_by column
 * @method     ChildObjStageMaterialQuery orderByVersion($order = Criteria::ASC) Order by the version column
 * @method     ChildObjStageMaterialQuery orderByVersionCreatedAt($order = Criteria::ASC) Order by the version_created_at column
 * @method     ChildObjStageMaterialQuery orderByVersionComment($order = Criteria::ASC) Order by the version_comment column
 *
 * @method     ChildObjStageMaterialQuery groupById() Group by the id column
 * @method     ChildObjStageMaterialQuery groupByPrice() Group by the price column
 * @method     ChildObjStageMaterialQuery groupByAmount() Group by the amount column
 * @method     ChildObjStageMaterialQuery groupByIsAvailable() Group by the is_available column
 * @method     ChildObjStageMaterialQuery groupByMaterialId() Group by the material_id column
 * @method     ChildObjStageMaterialQuery groupByStageWorkId() Group by the stage_work_id column
 * @method     ChildObjStageMaterialQuery groupByVersionCreatedBy() Group by the version_created_by column
 * @method     ChildObjStageMaterialQuery groupByVersion() Group by the version column
 * @method     ChildObjStageMaterialQuery groupByVersionCreatedAt() Group by the version_created_at column
 * @method     ChildObjStageMaterialQuery groupByVersionComment() Group by the version_comment column
 *
 * @method     ChildObjStageMaterialQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildObjStageMaterialQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildObjStageMaterialQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildObjStageMaterialQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildObjStageMaterialQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildObjStageMaterialQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildObjStageMaterialQuery leftJoinUsers($relationAlias = null) Adds a LEFT JOIN clause to the query using the Users relation
 * @method     ChildObjStageMaterialQuery rightJoinUsers($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Users relation
 * @method     ChildObjStageMaterialQuery innerJoinUsers($relationAlias = null) Adds a INNER JOIN clause to the query using the Users relation
 *
 * @method     ChildObjStageMaterialQuery joinWithUsers($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Users relation
 *
 * @method     ChildObjStageMaterialQuery leftJoinWithUsers() Adds a LEFT JOIN clause and with to the query using the Users relation
 * @method     ChildObjStageMaterialQuery rightJoinWithUsers() Adds a RIGHT JOIN clause and with to the query using the Users relation
 * @method     ChildObjStageMaterialQuery innerJoinWithUsers() Adds a INNER JOIN clause and with to the query using the Users relation
 *
 * @method     ChildObjStageMaterialQuery leftJoinVolMaterial($relationAlias = null) Adds a LEFT JOIN clause to the query using the VolMaterial relation
 * @method     ChildObjStageMaterialQuery rightJoinVolMaterial($relationAlias = null) Adds a RIGHT JOIN clause to the query using the VolMaterial relation
 * @method     ChildObjStageMaterialQuery innerJoinVolMaterial($relationAlias = null) Adds a INNER JOIN clause to the query using the VolMaterial relation
 *
 * @method     ChildObjStageMaterialQuery joinWithVolMaterial($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the VolMaterial relation
 *
 * @method     ChildObjStageMaterialQuery leftJoinWithVolMaterial() Adds a LEFT JOIN clause and with to the query using the VolMaterial relation
 * @method     ChildObjStageMaterialQuery rightJoinWithVolMaterial() Adds a RIGHT JOIN clause and with to the query using the VolMaterial relation
 * @method     ChildObjStageMaterialQuery innerJoinWithVolMaterial() Adds a INNER JOIN clause and with to the query using the VolMaterial relation
 *
 * @method     ChildObjStageMaterialQuery leftJoinObjStageWork($relationAlias = null) Adds a LEFT JOIN clause to the query using the ObjStageWork relation
 * @method     ChildObjStageMaterialQuery rightJoinObjStageWork($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ObjStageWork relation
 * @method     ChildObjStageMaterialQuery innerJoinObjStageWork($relationAlias = null) Adds a INNER JOIN clause to the query using the ObjStageWork relation
 *
 * @method     ChildObjStageMaterialQuery joinWithObjStageWork($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ObjStageWork relation
 *
 * @method     ChildObjStageMaterialQuery leftJoinWithObjStageWork() Adds a LEFT JOIN clause and with to the query using the ObjStageWork relation
 * @method     ChildObjStageMaterialQuery rightJoinWithObjStageWork() Adds a RIGHT JOIN clause and with to the query using the ObjStageWork relation
 * @method     ChildObjStageMaterialQuery innerJoinWithObjStageWork() Adds a INNER JOIN clause and with to the query using the ObjStageWork relation
 *
 * @method     ChildObjStageMaterialQuery leftJoinObjStageMaterialVersion($relationAlias = null) Adds a LEFT JOIN clause to the query using the ObjStageMaterialVersion relation
 * @method     ChildObjStageMaterialQuery rightJoinObjStageMaterialVersion($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ObjStageMaterialVersion relation
 * @method     ChildObjStageMaterialQuery innerJoinObjStageMaterialVersion($relationAlias = null) Adds a INNER JOIN clause to the query using the ObjStageMaterialVersion relation
 *
 * @method     ChildObjStageMaterialQuery joinWithObjStageMaterialVersion($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ObjStageMaterialVersion relation
 *
 * @method     ChildObjStageMaterialQuery leftJoinWithObjStageMaterialVersion() Adds a LEFT JOIN clause and with to the query using the ObjStageMaterialVersion relation
 * @method     ChildObjStageMaterialQuery rightJoinWithObjStageMaterialVersion() Adds a RIGHT JOIN clause and with to the query using the ObjStageMaterialVersion relation
 * @method     ChildObjStageMaterialQuery innerJoinWithObjStageMaterialVersion() Adds a INNER JOIN clause and with to the query using the ObjStageMaterialVersion relation
 *
 * @method     \DB\UsersQuery|\DB\VolMaterialQuery|\DB\ObjStageWorkQuery|\DB\ObjStageMaterialVersionQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildObjStageMaterial|null findOne(?ConnectionInterface $con = null) Return the first ChildObjStageMaterial matching the query
 * @method     ChildObjStageMaterial findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildObjStageMaterial matching the query, or a new ChildObjStageMaterial object populated from the query conditions when no match is found
 *
 * @method     ChildObjStageMaterial|null findOneById(int $id) Return the first ChildObjStageMaterial filtered by the id column
 * @method     ChildObjStageMaterial|null findOneByPrice(string $price) Return the first ChildObjStageMaterial filtered by the price column
 * @method     ChildObjStageMaterial|null findOneByAmount(string $amount) Return the first ChildObjStageMaterial filtered by the amount column
 * @method     ChildObjStageMaterial|null findOneByIsAvailable(boolean $is_available) Return the first ChildObjStageMaterial filtered by the is_available column
 * @method     ChildObjStageMaterial|null findOneByMaterialId(int $material_id) Return the first ChildObjStageMaterial filtered by the material_id column
 * @method     ChildObjStageMaterial|null findOneByStageWorkId(int $stage_work_id) Return the first ChildObjStageMaterial filtered by the stage_work_id column
 * @method     ChildObjStageMaterial|null findOneByVersionCreatedBy(int $version_created_by) Return the first ChildObjStageMaterial filtered by the version_created_by column
 * @method     ChildObjStageMaterial|null findOneByVersion(int $version) Return the first ChildObjStageMaterial filtered by the version column
 * @method     ChildObjStageMaterial|null findOneByVersionCreatedAt(string $version_created_at) Return the first ChildObjStageMaterial filtered by the version_created_at column
 * @method     ChildObjStageMaterial|null findOneByVersionComment(string $version_comment) Return the first ChildObjStageMaterial filtered by the version_comment column *

 * @method     ChildObjStageMaterial requirePk($key, ?ConnectionInterface $con = null) Return the ChildObjStageMaterial by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjStageMaterial requireOne(?ConnectionInterface $con = null) Return the first ChildObjStageMaterial matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildObjStageMaterial requireOneById(int $id) Return the first ChildObjStageMaterial filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjStageMaterial requireOneByPrice(string $price) Return the first ChildObjStageMaterial filtered by the price column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjStageMaterial requireOneByAmount(string $amount) Return the first ChildObjStageMaterial filtered by the amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjStageMaterial requireOneByIsAvailable(boolean $is_available) Return the first ChildObjStageMaterial filtered by the is_available column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjStageMaterial requireOneByMaterialId(int $material_id) Return the first ChildObjStageMaterial filtered by the material_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjStageMaterial requireOneByStageWorkId(int $stage_work_id) Return the first ChildObjStageMaterial filtered by the stage_work_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjStageMaterial requireOneByVersionCreatedBy(int $version_created_by) Return the first ChildObjStageMaterial filtered by the version_created_by column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjStageMaterial requireOneByVersion(int $version) Return the first ChildObjStageMaterial filtered by the version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjStageMaterial requireOneByVersionCreatedAt(string $version_created_at) Return the first ChildObjStageMaterial filtered by the version_created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjStageMaterial requireOneByVersionComment(string $version_comment) Return the first ChildObjStageMaterial filtered by the version_comment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildObjStageMaterial[]|Collection find(?ConnectionInterface $con = null) Return ChildObjStageMaterial objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildObjStageMaterial> find(?ConnectionInterface $con = null) Return ChildObjStageMaterial objects based on current ModelCriteria
 * @method     ChildObjStageMaterial[]|Collection findById(int $id) Return ChildObjStageMaterial objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildObjStageMaterial> findById(int $id) Return ChildObjStageMaterial objects filtered by the id column
 * @method     ChildObjStageMaterial[]|Collection findByPrice(string $price) Return ChildObjStageMaterial objects filtered by the price column
 * @psalm-method Collection&\Traversable<ChildObjStageMaterial> findByPrice(string $price) Return ChildObjStageMaterial objects filtered by the price column
 * @method     ChildObjStageMaterial[]|Collection findByAmount(string $amount) Return ChildObjStageMaterial objects filtered by the amount column
 * @psalm-method Collection&\Traversable<ChildObjStageMaterial> findByAmount(string $amount) Return ChildObjStageMaterial objects filtered by the amount column
 * @method     ChildObjStageMaterial[]|Collection findByIsAvailable(boolean $is_available) Return ChildObjStageMaterial objects filtered by the is_available column
 * @psalm-method Collection&\Traversable<ChildObjStageMaterial> findByIsAvailable(boolean $is_available) Return ChildObjStageMaterial objects filtered by the is_available column
 * @method     ChildObjStageMaterial[]|Collection findByMaterialId(int $material_id) Return ChildObjStageMaterial objects filtered by the material_id column
 * @psalm-method Collection&\Traversable<ChildObjStageMaterial> findByMaterialId(int $material_id) Return ChildObjStageMaterial objects filtered by the material_id column
 * @method     ChildObjStageMaterial[]|Collection findByStageWorkId(int $stage_work_id) Return ChildObjStageMaterial objects filtered by the stage_work_id column
 * @psalm-method Collection&\Traversable<ChildObjStageMaterial> findByStageWorkId(int $stage_work_id) Return ChildObjStageMaterial objects filtered by the stage_work_id column
 * @method     ChildObjStageMaterial[]|Collection findByVersionCreatedBy(int $version_created_by) Return ChildObjStageMaterial objects filtered by the version_created_by column
 * @psalm-method Collection&\Traversable<ChildObjStageMaterial> findByVersionCreatedBy(int $version_created_by) Return ChildObjStageMaterial objects filtered by the version_created_by column
 * @method     ChildObjStageMaterial[]|Collection findByVersion(int $version) Return ChildObjStageMaterial objects filtered by the version column
 * @psalm-method Collection&\Traversable<ChildObjStageMaterial> findByVersion(int $version) Return ChildObjStageMaterial objects filtered by the version column
 * @method     ChildObjStageMaterial[]|Collection findByVersionCreatedAt(string $version_created_at) Return ChildObjStageMaterial objects filtered by the version_created_at column
 * @psalm-method Collection&\Traversable<ChildObjStageMaterial> findByVersionCreatedAt(string $version_created_at) Return ChildObjStageMaterial objects filtered by the version_created_at column
 * @method     ChildObjStageMaterial[]|Collection findByVersionComment(string $version_comment) Return ChildObjStageMaterial objects filtered by the version_comment column
 * @psalm-method Collection&\Traversable<ChildObjStageMaterial> findByVersionComment(string $version_comment) Return ChildObjStageMaterial objects filtered by the version_comment column
 * @method     ChildObjStageMaterial[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildObjStageMaterial> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ObjStageMaterialQuery extends ModelCriteria
{

    // versionable behavior

    /**
     * Whether the versioning is enabled
     */
    static $isVersioningEnabled = true;
protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \DB\Base\ObjStageMaterialQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\DB\\ObjStageMaterial', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildObjStageMaterialQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildObjStageMaterialQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildObjStageMaterialQuery) {
            return $criteria;
        }
        $query = new ChildObjStageMaterialQuery();
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
     * @return ChildObjStageMaterial|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ObjStageMaterialTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ObjStageMaterialTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildObjStageMaterial A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, price, amount, is_available, material_id, stage_work_id, version_created_by, version, version_created_at, version_comment FROM obj_stage_material WHERE id = :p0';
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
            /** @var ChildObjStageMaterial $obj */
            $obj = new ChildObjStageMaterial();
            $obj->hydrate($row);
            ObjStageMaterialTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildObjStageMaterial|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(ObjStageMaterialTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(ObjStageMaterialTableMap::COL_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(ObjStageMaterialTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ObjStageMaterialTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ObjStageMaterialTableMap::COL_ID, $id, $comparison);

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
                $this->addUsingAlias(ObjStageMaterialTableMap::COL_PRICE, $price['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($price['max'])) {
                $this->addUsingAlias(ObjStageMaterialTableMap::COL_PRICE, $price['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ObjStageMaterialTableMap::COL_PRICE, $price, $comparison);

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
                $this->addUsingAlias(ObjStageMaterialTableMap::COL_AMOUNT, $amount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($amount['max'])) {
                $this->addUsingAlias(ObjStageMaterialTableMap::COL_AMOUNT, $amount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ObjStageMaterialTableMap::COL_AMOUNT, $amount, $comparison);

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

        $this->addUsingAlias(ObjStageMaterialTableMap::COL_IS_AVAILABLE, $isAvailable, $comparison);

        return $this;
    }

    /**
     * Filter the query on the material_id column
     *
     * Example usage:
     * <code>
     * $query->filterByMaterialId(1234); // WHERE material_id = 1234
     * $query->filterByMaterialId(array(12, 34)); // WHERE material_id IN (12, 34)
     * $query->filterByMaterialId(array('min' => 12)); // WHERE material_id > 12
     * </code>
     *
     * @see       filterByVolMaterial()
     *
     * @param mixed $materialId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMaterialId($materialId = null, ?string $comparison = null)
    {
        if (is_array($materialId)) {
            $useMinMax = false;
            if (isset($materialId['min'])) {
                $this->addUsingAlias(ObjStageMaterialTableMap::COL_MATERIAL_ID, $materialId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($materialId['max'])) {
                $this->addUsingAlias(ObjStageMaterialTableMap::COL_MATERIAL_ID, $materialId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ObjStageMaterialTableMap::COL_MATERIAL_ID, $materialId, $comparison);

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
     * @see       filterByObjStageWork()
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
                $this->addUsingAlias(ObjStageMaterialTableMap::COL_STAGE_WORK_ID, $stageWorkId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($stageWorkId['max'])) {
                $this->addUsingAlias(ObjStageMaterialTableMap::COL_STAGE_WORK_ID, $stageWorkId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ObjStageMaterialTableMap::COL_STAGE_WORK_ID, $stageWorkId, $comparison);

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
                $this->addUsingAlias(ObjStageMaterialTableMap::COL_VERSION_CREATED_BY, $versionCreatedBy['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($versionCreatedBy['max'])) {
                $this->addUsingAlias(ObjStageMaterialTableMap::COL_VERSION_CREATED_BY, $versionCreatedBy['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ObjStageMaterialTableMap::COL_VERSION_CREATED_BY, $versionCreatedBy, $comparison);

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
                $this->addUsingAlias(ObjStageMaterialTableMap::COL_VERSION, $version['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($version['max'])) {
                $this->addUsingAlias(ObjStageMaterialTableMap::COL_VERSION, $version['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ObjStageMaterialTableMap::COL_VERSION, $version, $comparison);

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
                $this->addUsingAlias(ObjStageMaterialTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($versionCreatedAt['max'])) {
                $this->addUsingAlias(ObjStageMaterialTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ObjStageMaterialTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt, $comparison);

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

        $this->addUsingAlias(ObjStageMaterialTableMap::COL_VERSION_COMMENT, $versionComment, $comparison);

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
                ->addUsingAlias(ObjStageMaterialTableMap::COL_VERSION_CREATED_BY, $users->getId(), $comparison);
        } elseif ($users instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(ObjStageMaterialTableMap::COL_VERSION_CREATED_BY, $users->toKeyValue('PrimaryKey', 'Id'), $comparison);

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
     * Filter the query by a related \DB\VolMaterial object
     *
     * @param \DB\VolMaterial|ObjectCollection $volMaterial The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByVolMaterial($volMaterial, ?string $comparison = null)
    {
        if ($volMaterial instanceof \DB\VolMaterial) {
            return $this
                ->addUsingAlias(ObjStageMaterialTableMap::COL_MATERIAL_ID, $volMaterial->getId(), $comparison);
        } elseif ($volMaterial instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(ObjStageMaterialTableMap::COL_MATERIAL_ID, $volMaterial->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByVolMaterial() only accepts arguments of type \DB\VolMaterial or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the VolMaterial relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinVolMaterial(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('VolMaterial');

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
            $this->addJoinObject($join, 'VolMaterial');
        }

        return $this;
    }

    /**
     * Use the VolMaterial relation VolMaterial object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\VolMaterialQuery A secondary query class using the current class as primary query
     */
    public function useVolMaterialQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinVolMaterial($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'VolMaterial', '\DB\VolMaterialQuery');
    }

    /**
     * Use the VolMaterial relation VolMaterial object
     *
     * @param callable(\DB\VolMaterialQuery):\DB\VolMaterialQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withVolMaterialQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useVolMaterialQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to VolMaterial table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\VolMaterialQuery The inner query object of the EXISTS statement
     */
    public function useVolMaterialExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('VolMaterial', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to VolMaterial table for a NOT EXISTS query.
     *
     * @see useVolMaterialExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\VolMaterialQuery The inner query object of the NOT EXISTS statement
     */
    public function useVolMaterialNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('VolMaterial', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \DB\ObjStageWork object
     *
     * @param \DB\ObjStageWork|ObjectCollection $objStageWork The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByObjStageWork($objStageWork, ?string $comparison = null)
    {
        if ($objStageWork instanceof \DB\ObjStageWork) {
            return $this
                ->addUsingAlias(ObjStageMaterialTableMap::COL_STAGE_WORK_ID, $objStageWork->getId(), $comparison);
        } elseif ($objStageWork instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(ObjStageMaterialTableMap::COL_STAGE_WORK_ID, $objStageWork->toKeyValue('PrimaryKey', 'Id'), $comparison);

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
     * Filter the query by a related \DB\ObjStageMaterialVersion object
     *
     * @param \DB\ObjStageMaterialVersion|ObjectCollection $objStageMaterialVersion the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByObjStageMaterialVersion($objStageMaterialVersion, ?string $comparison = null)
    {
        if ($objStageMaterialVersion instanceof \DB\ObjStageMaterialVersion) {
            $this
                ->addUsingAlias(ObjStageMaterialTableMap::COL_ID, $objStageMaterialVersion->getId(), $comparison);

            return $this;
        } elseif ($objStageMaterialVersion instanceof ObjectCollection) {
            $this
                ->useObjStageMaterialVersionQuery()
                ->filterByPrimaryKeys($objStageMaterialVersion->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByObjStageMaterialVersion() only accepts arguments of type \DB\ObjStageMaterialVersion or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ObjStageMaterialVersion relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinObjStageMaterialVersion(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ObjStageMaterialVersion');

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
            $this->addJoinObject($join, 'ObjStageMaterialVersion');
        }

        return $this;
    }

    /**
     * Use the ObjStageMaterialVersion relation ObjStageMaterialVersion object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\ObjStageMaterialVersionQuery A secondary query class using the current class as primary query
     */
    public function useObjStageMaterialVersionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinObjStageMaterialVersion($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ObjStageMaterialVersion', '\DB\ObjStageMaterialVersionQuery');
    }

    /**
     * Use the ObjStageMaterialVersion relation ObjStageMaterialVersion object
     *
     * @param callable(\DB\ObjStageMaterialVersionQuery):\DB\ObjStageMaterialVersionQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withObjStageMaterialVersionQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useObjStageMaterialVersionQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to ObjStageMaterialVersion table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\ObjStageMaterialVersionQuery The inner query object of the EXISTS statement
     */
    public function useObjStageMaterialVersionExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('ObjStageMaterialVersion', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to ObjStageMaterialVersion table for a NOT EXISTS query.
     *
     * @see useObjStageMaterialVersionExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\ObjStageMaterialVersionQuery The inner query object of the NOT EXISTS statement
     */
    public function useObjStageMaterialVersionNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('ObjStageMaterialVersion', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Exclude object from result
     *
     * @param ChildObjStageMaterial $objStageMaterial Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($objStageMaterial = null)
    {
        if ($objStageMaterial) {
            $this->addUsingAlias(ObjStageMaterialTableMap::COL_ID, $objStageMaterial->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the obj_stage_material table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ObjStageMaterialTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ObjStageMaterialTableMap::clearInstancePool();
            ObjStageMaterialTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ObjStageMaterialTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ObjStageMaterialTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ObjStageMaterialTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ObjStageMaterialTableMap::clearRelatedInstancePool();

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
