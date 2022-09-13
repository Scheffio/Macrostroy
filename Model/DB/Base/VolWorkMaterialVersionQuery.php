<?php

namespace DB\Base;

use \Exception;
use \PDO;
use DB\VolWorkMaterialVersion as ChildVolWorkMaterialVersion;
use DB\VolWorkMaterialVersionQuery as ChildVolWorkMaterialVersionQuery;
use DB\Map\VolWorkMaterialVersionTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'vol_work_material_version' table.
 *
 *
 *
 * @method     ChildVolWorkMaterialVersionQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildVolWorkMaterialVersionQuery orderByAmount($order = Criteria::ASC) Order by the amount column
 * @method     ChildVolWorkMaterialVersionQuery orderByIsAvailable($order = Criteria::ASC) Order by the is_available column
 * @method     ChildVolWorkMaterialVersionQuery orderByWorkId($order = Criteria::ASC) Order by the work_id column
 * @method     ChildVolWorkMaterialVersionQuery orderByMaterialId($order = Criteria::ASC) Order by the material_id column
 * @method     ChildVolWorkMaterialVersionQuery orderByVersionCreatedBy($order = Criteria::ASC) Order by the version_created_by column
 * @method     ChildVolWorkMaterialVersionQuery orderByVersion($order = Criteria::ASC) Order by the version column
 * @method     ChildVolWorkMaterialVersionQuery orderByVersionCreatedAt($order = Criteria::ASC) Order by the version_created_at column
 * @method     ChildVolWorkMaterialVersionQuery orderByVersionComment($order = Criteria::ASC) Order by the version_comment column
 * @method     ChildVolWorkMaterialVersionQuery orderByWorkIdVersion($order = Criteria::ASC) Order by the work_id_version column
 * @method     ChildVolWorkMaterialVersionQuery orderByMaterialIdVersion($order = Criteria::ASC) Order by the material_id_version column
 *
 * @method     ChildVolWorkMaterialVersionQuery groupById() Group by the id column
 * @method     ChildVolWorkMaterialVersionQuery groupByAmount() Group by the amount column
 * @method     ChildVolWorkMaterialVersionQuery groupByIsAvailable() Group by the is_available column
 * @method     ChildVolWorkMaterialVersionQuery groupByWorkId() Group by the work_id column
 * @method     ChildVolWorkMaterialVersionQuery groupByMaterialId() Group by the material_id column
 * @method     ChildVolWorkMaterialVersionQuery groupByVersionCreatedBy() Group by the version_created_by column
 * @method     ChildVolWorkMaterialVersionQuery groupByVersion() Group by the version column
 * @method     ChildVolWorkMaterialVersionQuery groupByVersionCreatedAt() Group by the version_created_at column
 * @method     ChildVolWorkMaterialVersionQuery groupByVersionComment() Group by the version_comment column
 * @method     ChildVolWorkMaterialVersionQuery groupByWorkIdVersion() Group by the work_id_version column
 * @method     ChildVolWorkMaterialVersionQuery groupByMaterialIdVersion() Group by the material_id_version column
 *
 * @method     ChildVolWorkMaterialVersionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildVolWorkMaterialVersionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildVolWorkMaterialVersionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildVolWorkMaterialVersionQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildVolWorkMaterialVersionQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildVolWorkMaterialVersionQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildVolWorkMaterialVersionQuery leftJoinVolWorkMaterial($relationAlias = null) Adds a LEFT JOIN clause to the query using the VolWorkMaterial relation
 * @method     ChildVolWorkMaterialVersionQuery rightJoinVolWorkMaterial($relationAlias = null) Adds a RIGHT JOIN clause to the query using the VolWorkMaterial relation
 * @method     ChildVolWorkMaterialVersionQuery innerJoinVolWorkMaterial($relationAlias = null) Adds a INNER JOIN clause to the query using the VolWorkMaterial relation
 *
 * @method     ChildVolWorkMaterialVersionQuery joinWithVolWorkMaterial($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the VolWorkMaterial relation
 *
 * @method     ChildVolWorkMaterialVersionQuery leftJoinWithVolWorkMaterial() Adds a LEFT JOIN clause and with to the query using the VolWorkMaterial relation
 * @method     ChildVolWorkMaterialVersionQuery rightJoinWithVolWorkMaterial() Adds a RIGHT JOIN clause and with to the query using the VolWorkMaterial relation
 * @method     ChildVolWorkMaterialVersionQuery innerJoinWithVolWorkMaterial() Adds a INNER JOIN clause and with to the query using the VolWorkMaterial relation
 *
 * @method     \DB\VolWorkMaterialQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildVolWorkMaterialVersion|null findOne(?ConnectionInterface $con = null) Return the first ChildVolWorkMaterialVersion matching the query
 * @method     ChildVolWorkMaterialVersion findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildVolWorkMaterialVersion matching the query, or a new ChildVolWorkMaterialVersion object populated from the query conditions when no match is found
 *
 * @method     ChildVolWorkMaterialVersion|null findOneById(int $id) Return the first ChildVolWorkMaterialVersion filtered by the id column
 * @method     ChildVolWorkMaterialVersion|null findOneByAmount(string $amount) Return the first ChildVolWorkMaterialVersion filtered by the amount column
 * @method     ChildVolWorkMaterialVersion|null findOneByIsAvailable(boolean $is_available) Return the first ChildVolWorkMaterialVersion filtered by the is_available column
 * @method     ChildVolWorkMaterialVersion|null findOneByWorkId(int $work_id) Return the first ChildVolWorkMaterialVersion filtered by the work_id column
 * @method     ChildVolWorkMaterialVersion|null findOneByMaterialId(int $material_id) Return the first ChildVolWorkMaterialVersion filtered by the material_id column
 * @method     ChildVolWorkMaterialVersion|null findOneByVersionCreatedBy(int $version_created_by) Return the first ChildVolWorkMaterialVersion filtered by the version_created_by column
 * @method     ChildVolWorkMaterialVersion|null findOneByVersion(int $version) Return the first ChildVolWorkMaterialVersion filtered by the version column
 * @method     ChildVolWorkMaterialVersion|null findOneByVersionCreatedAt(string $version_created_at) Return the first ChildVolWorkMaterialVersion filtered by the version_created_at column
 * @method     ChildVolWorkMaterialVersion|null findOneByVersionComment(string $version_comment) Return the first ChildVolWorkMaterialVersion filtered by the version_comment column
 * @method     ChildVolWorkMaterialVersion|null findOneByWorkIdVersion(int $work_id_version) Return the first ChildVolWorkMaterialVersion filtered by the work_id_version column
 * @method     ChildVolWorkMaterialVersion|null findOneByMaterialIdVersion(int $material_id_version) Return the first ChildVolWorkMaterialVersion filtered by the material_id_version column *

 * @method     ChildVolWorkMaterialVersion requirePk($key, ?ConnectionInterface $con = null) Return the ChildVolWorkMaterialVersion by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolWorkMaterialVersion requireOne(?ConnectionInterface $con = null) Return the first ChildVolWorkMaterialVersion matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildVolWorkMaterialVersion requireOneById(int $id) Return the first ChildVolWorkMaterialVersion filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolWorkMaterialVersion requireOneByAmount(string $amount) Return the first ChildVolWorkMaterialVersion filtered by the amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolWorkMaterialVersion requireOneByIsAvailable(boolean $is_available) Return the first ChildVolWorkMaterialVersion filtered by the is_available column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolWorkMaterialVersion requireOneByWorkId(int $work_id) Return the first ChildVolWorkMaterialVersion filtered by the work_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolWorkMaterialVersion requireOneByMaterialId(int $material_id) Return the first ChildVolWorkMaterialVersion filtered by the material_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolWorkMaterialVersion requireOneByVersionCreatedBy(int $version_created_by) Return the first ChildVolWorkMaterialVersion filtered by the version_created_by column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolWorkMaterialVersion requireOneByVersion(int $version) Return the first ChildVolWorkMaterialVersion filtered by the version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolWorkMaterialVersion requireOneByVersionCreatedAt(string $version_created_at) Return the first ChildVolWorkMaterialVersion filtered by the version_created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolWorkMaterialVersion requireOneByVersionComment(string $version_comment) Return the first ChildVolWorkMaterialVersion filtered by the version_comment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolWorkMaterialVersion requireOneByWorkIdVersion(int $work_id_version) Return the first ChildVolWorkMaterialVersion filtered by the work_id_version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolWorkMaterialVersion requireOneByMaterialIdVersion(int $material_id_version) Return the first ChildVolWorkMaterialVersion filtered by the material_id_version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildVolWorkMaterialVersion[]|Collection find(?ConnectionInterface $con = null) Return ChildVolWorkMaterialVersion objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildVolWorkMaterialVersion> find(?ConnectionInterface $con = null) Return ChildVolWorkMaterialVersion objects based on current ModelCriteria
 * @method     ChildVolWorkMaterialVersion[]|Collection findById(int $id) Return ChildVolWorkMaterialVersion objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildVolWorkMaterialVersion> findById(int $id) Return ChildVolWorkMaterialVersion objects filtered by the id column
 * @method     ChildVolWorkMaterialVersion[]|Collection findByAmount(string $amount) Return ChildVolWorkMaterialVersion objects filtered by the amount column
 * @psalm-method Collection&\Traversable<ChildVolWorkMaterialVersion> findByAmount(string $amount) Return ChildVolWorkMaterialVersion objects filtered by the amount column
 * @method     ChildVolWorkMaterialVersion[]|Collection findByIsAvailable(boolean $is_available) Return ChildVolWorkMaterialVersion objects filtered by the is_available column
 * @psalm-method Collection&\Traversable<ChildVolWorkMaterialVersion> findByIsAvailable(boolean $is_available) Return ChildVolWorkMaterialVersion objects filtered by the is_available column
 * @method     ChildVolWorkMaterialVersion[]|Collection findByWorkId(int $work_id) Return ChildVolWorkMaterialVersion objects filtered by the work_id column
 * @psalm-method Collection&\Traversable<ChildVolWorkMaterialVersion> findByWorkId(int $work_id) Return ChildVolWorkMaterialVersion objects filtered by the work_id column
 * @method     ChildVolWorkMaterialVersion[]|Collection findByMaterialId(int $material_id) Return ChildVolWorkMaterialVersion objects filtered by the material_id column
 * @psalm-method Collection&\Traversable<ChildVolWorkMaterialVersion> findByMaterialId(int $material_id) Return ChildVolWorkMaterialVersion objects filtered by the material_id column
 * @method     ChildVolWorkMaterialVersion[]|Collection findByVersionCreatedBy(int $version_created_by) Return ChildVolWorkMaterialVersion objects filtered by the version_created_by column
 * @psalm-method Collection&\Traversable<ChildVolWorkMaterialVersion> findByVersionCreatedBy(int $version_created_by) Return ChildVolWorkMaterialVersion objects filtered by the version_created_by column
 * @method     ChildVolWorkMaterialVersion[]|Collection findByVersion(int $version) Return ChildVolWorkMaterialVersion objects filtered by the version column
 * @psalm-method Collection&\Traversable<ChildVolWorkMaterialVersion> findByVersion(int $version) Return ChildVolWorkMaterialVersion objects filtered by the version column
 * @method     ChildVolWorkMaterialVersion[]|Collection findByVersionCreatedAt(string $version_created_at) Return ChildVolWorkMaterialVersion objects filtered by the version_created_at column
 * @psalm-method Collection&\Traversable<ChildVolWorkMaterialVersion> findByVersionCreatedAt(string $version_created_at) Return ChildVolWorkMaterialVersion objects filtered by the version_created_at column
 * @method     ChildVolWorkMaterialVersion[]|Collection findByVersionComment(string $version_comment) Return ChildVolWorkMaterialVersion objects filtered by the version_comment column
 * @psalm-method Collection&\Traversable<ChildVolWorkMaterialVersion> findByVersionComment(string $version_comment) Return ChildVolWorkMaterialVersion objects filtered by the version_comment column
 * @method     ChildVolWorkMaterialVersion[]|Collection findByWorkIdVersion(int $work_id_version) Return ChildVolWorkMaterialVersion objects filtered by the work_id_version column
 * @psalm-method Collection&\Traversable<ChildVolWorkMaterialVersion> findByWorkIdVersion(int $work_id_version) Return ChildVolWorkMaterialVersion objects filtered by the work_id_version column
 * @method     ChildVolWorkMaterialVersion[]|Collection findByMaterialIdVersion(int $material_id_version) Return ChildVolWorkMaterialVersion objects filtered by the material_id_version column
 * @psalm-method Collection&\Traversable<ChildVolWorkMaterialVersion> findByMaterialIdVersion(int $material_id_version) Return ChildVolWorkMaterialVersion objects filtered by the material_id_version column
 * @method     ChildVolWorkMaterialVersion[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildVolWorkMaterialVersion> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class VolWorkMaterialVersionQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \DB\Base\VolWorkMaterialVersionQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\DB\\VolWorkMaterialVersion', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildVolWorkMaterialVersionQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildVolWorkMaterialVersionQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildVolWorkMaterialVersionQuery) {
            return $criteria;
        }
        $query = new ChildVolWorkMaterialVersionQuery();
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
     * @return ChildVolWorkMaterialVersion|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(VolWorkMaterialVersionTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = VolWorkMaterialVersionTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildVolWorkMaterialVersion A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, amount, is_available, work_id, material_id, version_created_by, version, version_created_at, version_comment, work_id_version, material_id_version FROM vol_work_material_version WHERE id = :p0 AND version = :p1';
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
            /** @var ChildVolWorkMaterialVersion $obj */
            $obj = new ChildVolWorkMaterialVersion();
            $obj->hydrate($row);
            VolWorkMaterialVersionTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildVolWorkMaterialVersion|array|mixed the result, formatted by the current formatter
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
        $this->addUsingAlias(VolWorkMaterialVersionTableMap::COL_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(VolWorkMaterialVersionTableMap::COL_VERSION, $key[1], Criteria::EQUAL);

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
            $cton0 = $this->getNewCriterion(VolWorkMaterialVersionTableMap::COL_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(VolWorkMaterialVersionTableMap::COL_VERSION, $key[1], Criteria::EQUAL);
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
     * @see       filterByVolWorkMaterial()
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
                $this->addUsingAlias(VolWorkMaterialVersionTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(VolWorkMaterialVersionTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(VolWorkMaterialVersionTableMap::COL_ID, $id, $comparison);

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
                $this->addUsingAlias(VolWorkMaterialVersionTableMap::COL_AMOUNT, $amount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($amount['max'])) {
                $this->addUsingAlias(VolWorkMaterialVersionTableMap::COL_AMOUNT, $amount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(VolWorkMaterialVersionTableMap::COL_AMOUNT, $amount, $comparison);

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

        $this->addUsingAlias(VolWorkMaterialVersionTableMap::COL_IS_AVAILABLE, $isAvailable, $comparison);

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
                $this->addUsingAlias(VolWorkMaterialVersionTableMap::COL_WORK_ID, $workId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($workId['max'])) {
                $this->addUsingAlias(VolWorkMaterialVersionTableMap::COL_WORK_ID, $workId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(VolWorkMaterialVersionTableMap::COL_WORK_ID, $workId, $comparison);

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
                $this->addUsingAlias(VolWorkMaterialVersionTableMap::COL_MATERIAL_ID, $materialId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($materialId['max'])) {
                $this->addUsingAlias(VolWorkMaterialVersionTableMap::COL_MATERIAL_ID, $materialId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(VolWorkMaterialVersionTableMap::COL_MATERIAL_ID, $materialId, $comparison);

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
                $this->addUsingAlias(VolWorkMaterialVersionTableMap::COL_VERSION_CREATED_BY, $versionCreatedBy['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($versionCreatedBy['max'])) {
                $this->addUsingAlias(VolWorkMaterialVersionTableMap::COL_VERSION_CREATED_BY, $versionCreatedBy['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(VolWorkMaterialVersionTableMap::COL_VERSION_CREATED_BY, $versionCreatedBy, $comparison);

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
                $this->addUsingAlias(VolWorkMaterialVersionTableMap::COL_VERSION, $version['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($version['max'])) {
                $this->addUsingAlias(VolWorkMaterialVersionTableMap::COL_VERSION, $version['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(VolWorkMaterialVersionTableMap::COL_VERSION, $version, $comparison);

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
                $this->addUsingAlias(VolWorkMaterialVersionTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($versionCreatedAt['max'])) {
                $this->addUsingAlias(VolWorkMaterialVersionTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(VolWorkMaterialVersionTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt, $comparison);

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

        $this->addUsingAlias(VolWorkMaterialVersionTableMap::COL_VERSION_COMMENT, $versionComment, $comparison);

        return $this;
    }

    /**
     * Filter the query on the work_id_version column
     *
     * Example usage:
     * <code>
     * $query->filterByWorkIdVersion(1234); // WHERE work_id_version = 1234
     * $query->filterByWorkIdVersion(array(12, 34)); // WHERE work_id_version IN (12, 34)
     * $query->filterByWorkIdVersion(array('min' => 12)); // WHERE work_id_version > 12
     * </code>
     *
     * @param mixed $workIdVersion The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWorkIdVersion($workIdVersion = null, ?string $comparison = null)
    {
        if (is_array($workIdVersion)) {
            $useMinMax = false;
            if (isset($workIdVersion['min'])) {
                $this->addUsingAlias(VolWorkMaterialVersionTableMap::COL_WORK_ID_VERSION, $workIdVersion['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($workIdVersion['max'])) {
                $this->addUsingAlias(VolWorkMaterialVersionTableMap::COL_WORK_ID_VERSION, $workIdVersion['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(VolWorkMaterialVersionTableMap::COL_WORK_ID_VERSION, $workIdVersion, $comparison);

        return $this;
    }

    /**
     * Filter the query on the material_id_version column
     *
     * Example usage:
     * <code>
     * $query->filterByMaterialIdVersion(1234); // WHERE material_id_version = 1234
     * $query->filterByMaterialIdVersion(array(12, 34)); // WHERE material_id_version IN (12, 34)
     * $query->filterByMaterialIdVersion(array('min' => 12)); // WHERE material_id_version > 12
     * </code>
     *
     * @param mixed $materialIdVersion The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMaterialIdVersion($materialIdVersion = null, ?string $comparison = null)
    {
        if (is_array($materialIdVersion)) {
            $useMinMax = false;
            if (isset($materialIdVersion['min'])) {
                $this->addUsingAlias(VolWorkMaterialVersionTableMap::COL_MATERIAL_ID_VERSION, $materialIdVersion['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($materialIdVersion['max'])) {
                $this->addUsingAlias(VolWorkMaterialVersionTableMap::COL_MATERIAL_ID_VERSION, $materialIdVersion['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(VolWorkMaterialVersionTableMap::COL_MATERIAL_ID_VERSION, $materialIdVersion, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \DB\VolWorkMaterial object
     *
     * @param \DB\VolWorkMaterial|ObjectCollection $volWorkMaterial The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByVolWorkMaterial($volWorkMaterial, ?string $comparison = null)
    {
        if ($volWorkMaterial instanceof \DB\VolWorkMaterial) {
            return $this
                ->addUsingAlias(VolWorkMaterialVersionTableMap::COL_ID, $volWorkMaterial->getId(), $comparison);
        } elseif ($volWorkMaterial instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(VolWorkMaterialVersionTableMap::COL_ID, $volWorkMaterial->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByVolWorkMaterial() only accepts arguments of type \DB\VolWorkMaterial or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the VolWorkMaterial relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinVolWorkMaterial(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('VolWorkMaterial');

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
            $this->addJoinObject($join, 'VolWorkMaterial');
        }

        return $this;
    }

    /**
     * Use the VolWorkMaterial relation VolWorkMaterial object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\VolWorkMaterialQuery A secondary query class using the current class as primary query
     */
    public function useVolWorkMaterialQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinVolWorkMaterial($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'VolWorkMaterial', '\DB\VolWorkMaterialQuery');
    }

    /**
     * Use the VolWorkMaterial relation VolWorkMaterial object
     *
     * @param callable(\DB\VolWorkMaterialQuery):\DB\VolWorkMaterialQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withVolWorkMaterialQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useVolWorkMaterialQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to VolWorkMaterial table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\VolWorkMaterialQuery The inner query object of the EXISTS statement
     */
    public function useVolWorkMaterialExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('VolWorkMaterial', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to VolWorkMaterial table for a NOT EXISTS query.
     *
     * @see useVolWorkMaterialExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\VolWorkMaterialQuery The inner query object of the NOT EXISTS statement
     */
    public function useVolWorkMaterialNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('VolWorkMaterial', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Exclude object from result
     *
     * @param ChildVolWorkMaterialVersion $volWorkMaterialVersion Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($volWorkMaterialVersion = null)
    {
        if ($volWorkMaterialVersion) {
            $this->addCond('pruneCond0', $this->getAliasedColName(VolWorkMaterialVersionTableMap::COL_ID), $volWorkMaterialVersion->getId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(VolWorkMaterialVersionTableMap::COL_VERSION), $volWorkMaterialVersion->getVersion(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the vol_work_material_version table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(VolWorkMaterialVersionTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            VolWorkMaterialVersionTableMap::clearInstancePool();
            VolWorkMaterialVersionTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(VolWorkMaterialVersionTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(VolWorkMaterialVersionTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            VolWorkMaterialVersionTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            VolWorkMaterialVersionTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}