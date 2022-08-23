<?php

namespace DB\Base;

use \Exception;
use \PDO;
use DB\WorkMaterial as ChildWorkMaterial;
use DB\WorkMaterialQuery as ChildWorkMaterialQuery;
use DB\Map\WorkMaterialTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'work_material' table.
 *
 *
 *
 * @method     ChildWorkMaterialQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildWorkMaterialQuery orderByWorkId($order = Criteria::ASC) Order by the work_id column
 * @method     ChildWorkMaterialQuery orderByMaterialId($order = Criteria::ASC) Order by the material_id column
 * @method     ChildWorkMaterialQuery orderByAmount($order = Criteria::ASC) Order by the amount column
 * @method     ChildWorkMaterialQuery orderByIsAvailable($order = Criteria::ASC) Order by the is_available column
 * @method     ChildWorkMaterialQuery orderByVersion($order = Criteria::ASC) Order by the version column
 * @method     ChildWorkMaterialQuery orderByVersionCreatedAt($order = Criteria::ASC) Order by the version_created_at column
 * @method     ChildWorkMaterialQuery orderByVersionCreatedBy($order = Criteria::ASC) Order by the version_created_by column
 * @method     ChildWorkMaterialQuery orderByVersionComment($order = Criteria::ASC) Order by the version_comment column
 *
 * @method     ChildWorkMaterialQuery groupById() Group by the id column
 * @method     ChildWorkMaterialQuery groupByWorkId() Group by the work_id column
 * @method     ChildWorkMaterialQuery groupByMaterialId() Group by the material_id column
 * @method     ChildWorkMaterialQuery groupByAmount() Group by the amount column
 * @method     ChildWorkMaterialQuery groupByIsAvailable() Group by the is_available column
 * @method     ChildWorkMaterialQuery groupByVersion() Group by the version column
 * @method     ChildWorkMaterialQuery groupByVersionCreatedAt() Group by the version_created_at column
 * @method     ChildWorkMaterialQuery groupByVersionCreatedBy() Group by the version_created_by column
 * @method     ChildWorkMaterialQuery groupByVersionComment() Group by the version_comment column
 *
 * @method     ChildWorkMaterialQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildWorkMaterialQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildWorkMaterialQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildWorkMaterialQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildWorkMaterialQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildWorkMaterialQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildWorkMaterialQuery leftJoinWork($relationAlias = null) Adds a LEFT JOIN clause to the query using the Work relation
 * @method     ChildWorkMaterialQuery rightJoinWork($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Work relation
 * @method     ChildWorkMaterialQuery innerJoinWork($relationAlias = null) Adds a INNER JOIN clause to the query using the Work relation
 *
 * @method     ChildWorkMaterialQuery joinWithWork($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Work relation
 *
 * @method     ChildWorkMaterialQuery leftJoinWithWork() Adds a LEFT JOIN clause and with to the query using the Work relation
 * @method     ChildWorkMaterialQuery rightJoinWithWork() Adds a RIGHT JOIN clause and with to the query using the Work relation
 * @method     ChildWorkMaterialQuery innerJoinWithWork() Adds a INNER JOIN clause and with to the query using the Work relation
 *
 * @method     ChildWorkMaterialQuery leftJoinMaterial($relationAlias = null) Adds a LEFT JOIN clause to the query using the Material relation
 * @method     ChildWorkMaterialQuery rightJoinMaterial($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Material relation
 * @method     ChildWorkMaterialQuery innerJoinMaterial($relationAlias = null) Adds a INNER JOIN clause to the query using the Material relation
 *
 * @method     ChildWorkMaterialQuery joinWithMaterial($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Material relation
 *
 * @method     ChildWorkMaterialQuery leftJoinWithMaterial() Adds a LEFT JOIN clause and with to the query using the Material relation
 * @method     ChildWorkMaterialQuery rightJoinWithMaterial() Adds a RIGHT JOIN clause and with to the query using the Material relation
 * @method     ChildWorkMaterialQuery innerJoinWithMaterial() Adds a INNER JOIN clause and with to the query using the Material relation
 *
 * @method     ChildWorkMaterialQuery leftJoinWorkMaterialVersion($relationAlias = null) Adds a LEFT JOIN clause to the query using the WorkMaterialVersion relation
 * @method     ChildWorkMaterialQuery rightJoinWorkMaterialVersion($relationAlias = null) Adds a RIGHT JOIN clause to the query using the WorkMaterialVersion relation
 * @method     ChildWorkMaterialQuery innerJoinWorkMaterialVersion($relationAlias = null) Adds a INNER JOIN clause to the query using the WorkMaterialVersion relation
 *
 * @method     ChildWorkMaterialQuery joinWithWorkMaterialVersion($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the WorkMaterialVersion relation
 *
 * @method     ChildWorkMaterialQuery leftJoinWithWorkMaterialVersion() Adds a LEFT JOIN clause and with to the query using the WorkMaterialVersion relation
 * @method     ChildWorkMaterialQuery rightJoinWithWorkMaterialVersion() Adds a RIGHT JOIN clause and with to the query using the WorkMaterialVersion relation
 * @method     ChildWorkMaterialQuery innerJoinWithWorkMaterialVersion() Adds a INNER JOIN clause and with to the query using the WorkMaterialVersion relation
 *
 * @method     \DB\WorkQuery|\DB\MaterialQuery|\DB\WorkMaterialVersionQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildWorkMaterial|null findOne(?ConnectionInterface $con = null) Return the first ChildWorkMaterial matching the query
 * @method     ChildWorkMaterial findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildWorkMaterial matching the query, or a new ChildWorkMaterial object populated from the query conditions when no match is found
 *
 * @method     ChildWorkMaterial|null findOneById(int $id) Return the first ChildWorkMaterial filtered by the id column
 * @method     ChildWorkMaterial|null findOneByWorkId(int $work_id) Return the first ChildWorkMaterial filtered by the work_id column
 * @method     ChildWorkMaterial|null findOneByMaterialId(int $material_id) Return the first ChildWorkMaterial filtered by the material_id column
 * @method     ChildWorkMaterial|null findOneByAmount(string $amount) Return the first ChildWorkMaterial filtered by the amount column
 * @method     ChildWorkMaterial|null findOneByIsAvailable(boolean $is_available) Return the first ChildWorkMaterial filtered by the is_available column
 * @method     ChildWorkMaterial|null findOneByVersion(int $version) Return the first ChildWorkMaterial filtered by the version column
 * @method     ChildWorkMaterial|null findOneByVersionCreatedAt(string $version_created_at) Return the first ChildWorkMaterial filtered by the version_created_at column
 * @method     ChildWorkMaterial|null findOneByVersionCreatedBy(string $version_created_by) Return the first ChildWorkMaterial filtered by the version_created_by column
 * @method     ChildWorkMaterial|null findOneByVersionComment(string $version_comment) Return the first ChildWorkMaterial filtered by the version_comment column *

 * @method     ChildWorkMaterial requirePk($key, ?ConnectionInterface $con = null) Return the ChildWorkMaterial by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWorkMaterial requireOne(?ConnectionInterface $con = null) Return the first ChildWorkMaterial matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWorkMaterial requireOneById(int $id) Return the first ChildWorkMaterial filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWorkMaterial requireOneByWorkId(int $work_id) Return the first ChildWorkMaterial filtered by the work_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWorkMaterial requireOneByMaterialId(int $material_id) Return the first ChildWorkMaterial filtered by the material_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWorkMaterial requireOneByAmount(string $amount) Return the first ChildWorkMaterial filtered by the amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWorkMaterial requireOneByIsAvailable(boolean $is_available) Return the first ChildWorkMaterial filtered by the is_available column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWorkMaterial requireOneByVersion(int $version) Return the first ChildWorkMaterial filtered by the version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWorkMaterial requireOneByVersionCreatedAt(string $version_created_at) Return the first ChildWorkMaterial filtered by the version_created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWorkMaterial requireOneByVersionCreatedBy(string $version_created_by) Return the first ChildWorkMaterial filtered by the version_created_by column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWorkMaterial requireOneByVersionComment(string $version_comment) Return the first ChildWorkMaterial filtered by the version_comment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWorkMaterial[]|Collection find(?ConnectionInterface $con = null) Return ChildWorkMaterial objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildWorkMaterial> find(?ConnectionInterface $con = null) Return ChildWorkMaterial objects based on current ModelCriteria
 * @method     ChildWorkMaterial[]|Collection findById(int $id) Return ChildWorkMaterial objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildWorkMaterial> findById(int $id) Return ChildWorkMaterial objects filtered by the id column
 * @method     ChildWorkMaterial[]|Collection findByWorkId(int $work_id) Return ChildWorkMaterial objects filtered by the work_id column
 * @psalm-method Collection&\Traversable<ChildWorkMaterial> findByWorkId(int $work_id) Return ChildWorkMaterial objects filtered by the work_id column
 * @method     ChildWorkMaterial[]|Collection findByMaterialId(int $material_id) Return ChildWorkMaterial objects filtered by the material_id column
 * @psalm-method Collection&\Traversable<ChildWorkMaterial> findByMaterialId(int $material_id) Return ChildWorkMaterial objects filtered by the material_id column
 * @method     ChildWorkMaterial[]|Collection findByAmount(string $amount) Return ChildWorkMaterial objects filtered by the amount column
 * @psalm-method Collection&\Traversable<ChildWorkMaterial> findByAmount(string $amount) Return ChildWorkMaterial objects filtered by the amount column
 * @method     ChildWorkMaterial[]|Collection findByIsAvailable(boolean $is_available) Return ChildWorkMaterial objects filtered by the is_available column
 * @psalm-method Collection&\Traversable<ChildWorkMaterial> findByIsAvailable(boolean $is_available) Return ChildWorkMaterial objects filtered by the is_available column
 * @method     ChildWorkMaterial[]|Collection findByVersion(int $version) Return ChildWorkMaterial objects filtered by the version column
 * @psalm-method Collection&\Traversable<ChildWorkMaterial> findByVersion(int $version) Return ChildWorkMaterial objects filtered by the version column
 * @method     ChildWorkMaterial[]|Collection findByVersionCreatedAt(string $version_created_at) Return ChildWorkMaterial objects filtered by the version_created_at column
 * @psalm-method Collection&\Traversable<ChildWorkMaterial> findByVersionCreatedAt(string $version_created_at) Return ChildWorkMaterial objects filtered by the version_created_at column
 * @method     ChildWorkMaterial[]|Collection findByVersionCreatedBy(string $version_created_by) Return ChildWorkMaterial objects filtered by the version_created_by column
 * @psalm-method Collection&\Traversable<ChildWorkMaterial> findByVersionCreatedBy(string $version_created_by) Return ChildWorkMaterial objects filtered by the version_created_by column
 * @method     ChildWorkMaterial[]|Collection findByVersionComment(string $version_comment) Return ChildWorkMaterial objects filtered by the version_comment column
 * @psalm-method Collection&\Traversable<ChildWorkMaterial> findByVersionComment(string $version_comment) Return ChildWorkMaterial objects filtered by the version_comment column
 * @method     ChildWorkMaterial[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildWorkMaterial> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class WorkMaterialQuery extends ModelCriteria
{

    // versionable behavior

    /**
     * Whether the versioning is enabled
     */
    static $isVersioningEnabled = true;
protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \DB\Base\WorkMaterialQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\DB\\WorkMaterial', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildWorkMaterialQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildWorkMaterialQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildWorkMaterialQuery) {
            return $criteria;
        }
        $query = new ChildWorkMaterialQuery();
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
     * @return ChildWorkMaterial|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(WorkMaterialTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = WorkMaterialTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildWorkMaterial A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, work_id, material_id, amount, is_available, version, version_created_at, version_created_by, version_comment FROM work_material WHERE id = :p0';
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
            /** @var ChildWorkMaterial $obj */
            $obj = new ChildWorkMaterial();
            $obj->hydrate($row);
            WorkMaterialTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildWorkMaterial|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(WorkMaterialTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(WorkMaterialTableMap::COL_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(WorkMaterialTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(WorkMaterialTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WorkMaterialTableMap::COL_ID, $id, $comparison);

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
     * @see       filterByWork()
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
                $this->addUsingAlias(WorkMaterialTableMap::COL_WORK_ID, $workId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($workId['max'])) {
                $this->addUsingAlias(WorkMaterialTableMap::COL_WORK_ID, $workId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WorkMaterialTableMap::COL_WORK_ID, $workId, $comparison);

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
     * @see       filterByMaterial()
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
                $this->addUsingAlias(WorkMaterialTableMap::COL_MATERIAL_ID, $materialId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($materialId['max'])) {
                $this->addUsingAlias(WorkMaterialTableMap::COL_MATERIAL_ID, $materialId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WorkMaterialTableMap::COL_MATERIAL_ID, $materialId, $comparison);

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
                $this->addUsingAlias(WorkMaterialTableMap::COL_AMOUNT, $amount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($amount['max'])) {
                $this->addUsingAlias(WorkMaterialTableMap::COL_AMOUNT, $amount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WorkMaterialTableMap::COL_AMOUNT, $amount, $comparison);

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

        $this->addUsingAlias(WorkMaterialTableMap::COL_IS_AVAILABLE, $isAvailable, $comparison);

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
                $this->addUsingAlias(WorkMaterialTableMap::COL_VERSION, $version['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($version['max'])) {
                $this->addUsingAlias(WorkMaterialTableMap::COL_VERSION, $version['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WorkMaterialTableMap::COL_VERSION, $version, $comparison);

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
                $this->addUsingAlias(WorkMaterialTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($versionCreatedAt['max'])) {
                $this->addUsingAlias(WorkMaterialTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WorkMaterialTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt, $comparison);

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

        $this->addUsingAlias(WorkMaterialTableMap::COL_VERSION_CREATED_BY, $versionCreatedBy, $comparison);

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

        $this->addUsingAlias(WorkMaterialTableMap::COL_VERSION_COMMENT, $versionComment, $comparison);

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
                ->addUsingAlias(WorkMaterialTableMap::COL_WORK_ID, $work->getId(), $comparison);
        } elseif ($work instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(WorkMaterialTableMap::COL_WORK_ID, $work->toKeyValue('PrimaryKey', 'Id'), $comparison);

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
                ->addUsingAlias(WorkMaterialTableMap::COL_MATERIAL_ID, $material->getId(), $comparison);
        } elseif ($material instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(WorkMaterialTableMap::COL_MATERIAL_ID, $material->toKeyValue('PrimaryKey', 'Id'), $comparison);

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
     * Filter the query by a related \DB\WorkMaterialVersion object
     *
     * @param \DB\WorkMaterialVersion|ObjectCollection $workMaterialVersion the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWorkMaterialVersion($workMaterialVersion, ?string $comparison = null)
    {
        if ($workMaterialVersion instanceof \DB\WorkMaterialVersion) {
            $this
                ->addUsingAlias(WorkMaterialTableMap::COL_ID, $workMaterialVersion->getId(), $comparison);

            return $this;
        } elseif ($workMaterialVersion instanceof ObjectCollection) {
            $this
                ->useWorkMaterialVersionQuery()
                ->filterByPrimaryKeys($workMaterialVersion->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByWorkMaterialVersion() only accepts arguments of type \DB\WorkMaterialVersion or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the WorkMaterialVersion relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinWorkMaterialVersion(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('WorkMaterialVersion');

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
            $this->addJoinObject($join, 'WorkMaterialVersion');
        }

        return $this;
    }

    /**
     * Use the WorkMaterialVersion relation WorkMaterialVersion object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\WorkMaterialVersionQuery A secondary query class using the current class as primary query
     */
    public function useWorkMaterialVersionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinWorkMaterialVersion($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'WorkMaterialVersion', '\DB\WorkMaterialVersionQuery');
    }

    /**
     * Use the WorkMaterialVersion relation WorkMaterialVersion object
     *
     * @param callable(\DB\WorkMaterialVersionQuery):\DB\WorkMaterialVersionQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withWorkMaterialVersionQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useWorkMaterialVersionQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to WorkMaterialVersion table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\WorkMaterialVersionQuery The inner query object of the EXISTS statement
     */
    public function useWorkMaterialVersionExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('WorkMaterialVersion', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to WorkMaterialVersion table for a NOT EXISTS query.
     *
     * @see useWorkMaterialVersionExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\WorkMaterialVersionQuery The inner query object of the NOT EXISTS statement
     */
    public function useWorkMaterialVersionNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('WorkMaterialVersion', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Exclude object from result
     *
     * @param ChildWorkMaterial $workMaterial Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($workMaterial = null)
    {
        if ($workMaterial) {
            $this->addUsingAlias(WorkMaterialTableMap::COL_ID, $workMaterial->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the work_material table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(WorkMaterialTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            WorkMaterialTableMap::clearInstancePool();
            WorkMaterialTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(WorkMaterialTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(WorkMaterialTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            WorkMaterialTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            WorkMaterialTableMap::clearRelatedInstancePool();

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
