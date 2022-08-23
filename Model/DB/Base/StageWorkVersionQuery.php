<?php

namespace DB\Base;

use \Exception;
use \PDO;
use DB\StageWorkVersion as ChildStageWorkVersion;
use DB\StageWorkVersionQuery as ChildStageWorkVersionQuery;
use DB\Map\StageWorkVersionTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'stage_work_version' table.
 *
 *
 *
 * @method     ChildStageWorkVersionQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildStageWorkVersionQuery orderByStageId($order = Criteria::ASC) Order by the stage_id column
 * @method     ChildStageWorkVersionQuery orderByWorkId($order = Criteria::ASC) Order by the work_id column
 * @method     ChildStageWorkVersionQuery orderByPrice($order = Criteria::ASC) Order by the price column
 * @method     ChildStageWorkVersionQuery orderByAmount($order = Criteria::ASC) Order by the amount column
 * @method     ChildStageWorkVersionQuery orderByIsAvailable($order = Criteria::ASC) Order by the is_available column
 * @method     ChildStageWorkVersionQuery orderByVersion($order = Criteria::ASC) Order by the version column
 * @method     ChildStageWorkVersionQuery orderByVersionCreatedAt($order = Criteria::ASC) Order by the version_created_at column
 * @method     ChildStageWorkVersionQuery orderByVersionCreatedBy($order = Criteria::ASC) Order by the version_created_by column
 * @method     ChildStageWorkVersionQuery orderByVersionComment($order = Criteria::ASC) Order by the version_comment column
 * @method     ChildStageWorkVersionQuery orderByStageMaterialIds($order = Criteria::ASC) Order by the stage_material_ids column
 * @method     ChildStageWorkVersionQuery orderByStageMaterialVersions($order = Criteria::ASC) Order by the stage_material_versions column
 * @method     ChildStageWorkVersionQuery orderByStageTechnicIds($order = Criteria::ASC) Order by the stage_technic_ids column
 * @method     ChildStageWorkVersionQuery orderByStageTechnicVersions($order = Criteria::ASC) Order by the stage_technic_versions column
 *
 * @method     ChildStageWorkVersionQuery groupById() Group by the id column
 * @method     ChildStageWorkVersionQuery groupByStageId() Group by the stage_id column
 * @method     ChildStageWorkVersionQuery groupByWorkId() Group by the work_id column
 * @method     ChildStageWorkVersionQuery groupByPrice() Group by the price column
 * @method     ChildStageWorkVersionQuery groupByAmount() Group by the amount column
 * @method     ChildStageWorkVersionQuery groupByIsAvailable() Group by the is_available column
 * @method     ChildStageWorkVersionQuery groupByVersion() Group by the version column
 * @method     ChildStageWorkVersionQuery groupByVersionCreatedAt() Group by the version_created_at column
 * @method     ChildStageWorkVersionQuery groupByVersionCreatedBy() Group by the version_created_by column
 * @method     ChildStageWorkVersionQuery groupByVersionComment() Group by the version_comment column
 * @method     ChildStageWorkVersionQuery groupByStageMaterialIds() Group by the stage_material_ids column
 * @method     ChildStageWorkVersionQuery groupByStageMaterialVersions() Group by the stage_material_versions column
 * @method     ChildStageWorkVersionQuery groupByStageTechnicIds() Group by the stage_technic_ids column
 * @method     ChildStageWorkVersionQuery groupByStageTechnicVersions() Group by the stage_technic_versions column
 *
 * @method     ChildStageWorkVersionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildStageWorkVersionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildStageWorkVersionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildStageWorkVersionQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildStageWorkVersionQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildStageWorkVersionQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildStageWorkVersionQuery leftJoinStageWork($relationAlias = null) Adds a LEFT JOIN clause to the query using the StageWork relation
 * @method     ChildStageWorkVersionQuery rightJoinStageWork($relationAlias = null) Adds a RIGHT JOIN clause to the query using the StageWork relation
 * @method     ChildStageWorkVersionQuery innerJoinStageWork($relationAlias = null) Adds a INNER JOIN clause to the query using the StageWork relation
 *
 * @method     ChildStageWorkVersionQuery joinWithStageWork($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the StageWork relation
 *
 * @method     ChildStageWorkVersionQuery leftJoinWithStageWork() Adds a LEFT JOIN clause and with to the query using the StageWork relation
 * @method     ChildStageWorkVersionQuery rightJoinWithStageWork() Adds a RIGHT JOIN clause and with to the query using the StageWork relation
 * @method     ChildStageWorkVersionQuery innerJoinWithStageWork() Adds a INNER JOIN clause and with to the query using the StageWork relation
 *
 * @method     \DB\StageWorkQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildStageWorkVersion|null findOne(?ConnectionInterface $con = null) Return the first ChildStageWorkVersion matching the query
 * @method     ChildStageWorkVersion findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildStageWorkVersion matching the query, or a new ChildStageWorkVersion object populated from the query conditions when no match is found
 *
 * @method     ChildStageWorkVersion|null findOneById(int $id) Return the first ChildStageWorkVersion filtered by the id column
 * @method     ChildStageWorkVersion|null findOneByStageId(int $stage_id) Return the first ChildStageWorkVersion filtered by the stage_id column
 * @method     ChildStageWorkVersion|null findOneByWorkId(int $work_id) Return the first ChildStageWorkVersion filtered by the work_id column
 * @method     ChildStageWorkVersion|null findOneByPrice(string $price) Return the first ChildStageWorkVersion filtered by the price column
 * @method     ChildStageWorkVersion|null findOneByAmount(string $amount) Return the first ChildStageWorkVersion filtered by the amount column
 * @method     ChildStageWorkVersion|null findOneByIsAvailable(boolean $is_available) Return the first ChildStageWorkVersion filtered by the is_available column
 * @method     ChildStageWorkVersion|null findOneByVersion(int $version) Return the first ChildStageWorkVersion filtered by the version column
 * @method     ChildStageWorkVersion|null findOneByVersionCreatedAt(string $version_created_at) Return the first ChildStageWorkVersion filtered by the version_created_at column
 * @method     ChildStageWorkVersion|null findOneByVersionCreatedBy(string $version_created_by) Return the first ChildStageWorkVersion filtered by the version_created_by column
 * @method     ChildStageWorkVersion|null findOneByVersionComment(string $version_comment) Return the first ChildStageWorkVersion filtered by the version_comment column
 * @method     ChildStageWorkVersion|null findOneByStageMaterialIds(array $stage_material_ids) Return the first ChildStageWorkVersion filtered by the stage_material_ids column
 * @method     ChildStageWorkVersion|null findOneByStageMaterialVersions(array $stage_material_versions) Return the first ChildStageWorkVersion filtered by the stage_material_versions column
 * @method     ChildStageWorkVersion|null findOneByStageTechnicIds(array $stage_technic_ids) Return the first ChildStageWorkVersion filtered by the stage_technic_ids column
 * @method     ChildStageWorkVersion|null findOneByStageTechnicVersions(array $stage_technic_versions) Return the first ChildStageWorkVersion filtered by the stage_technic_versions column *

 * @method     ChildStageWorkVersion requirePk($key, ?ConnectionInterface $con = null) Return the ChildStageWorkVersion by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStageWorkVersion requireOne(?ConnectionInterface $con = null) Return the first ChildStageWorkVersion matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildStageWorkVersion requireOneById(int $id) Return the first ChildStageWorkVersion filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStageWorkVersion requireOneByStageId(int $stage_id) Return the first ChildStageWorkVersion filtered by the stage_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStageWorkVersion requireOneByWorkId(int $work_id) Return the first ChildStageWorkVersion filtered by the work_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStageWorkVersion requireOneByPrice(string $price) Return the first ChildStageWorkVersion filtered by the price column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStageWorkVersion requireOneByAmount(string $amount) Return the first ChildStageWorkVersion filtered by the amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStageWorkVersion requireOneByIsAvailable(boolean $is_available) Return the first ChildStageWorkVersion filtered by the is_available column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStageWorkVersion requireOneByVersion(int $version) Return the first ChildStageWorkVersion filtered by the version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStageWorkVersion requireOneByVersionCreatedAt(string $version_created_at) Return the first ChildStageWorkVersion filtered by the version_created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStageWorkVersion requireOneByVersionCreatedBy(string $version_created_by) Return the first ChildStageWorkVersion filtered by the version_created_by column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStageWorkVersion requireOneByVersionComment(string $version_comment) Return the first ChildStageWorkVersion filtered by the version_comment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStageWorkVersion requireOneByStageMaterialIds(array $stage_material_ids) Return the first ChildStageWorkVersion filtered by the stage_material_ids column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStageWorkVersion requireOneByStageMaterialVersions(array $stage_material_versions) Return the first ChildStageWorkVersion filtered by the stage_material_versions column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStageWorkVersion requireOneByStageTechnicIds(array $stage_technic_ids) Return the first ChildStageWorkVersion filtered by the stage_technic_ids column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStageWorkVersion requireOneByStageTechnicVersions(array $stage_technic_versions) Return the first ChildStageWorkVersion filtered by the stage_technic_versions column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildStageWorkVersion[]|Collection find(?ConnectionInterface $con = null) Return ChildStageWorkVersion objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildStageWorkVersion> find(?ConnectionInterface $con = null) Return ChildStageWorkVersion objects based on current ModelCriteria
 * @method     ChildStageWorkVersion[]|Collection findById(int $id) Return ChildStageWorkVersion objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildStageWorkVersion> findById(int $id) Return ChildStageWorkVersion objects filtered by the id column
 * @method     ChildStageWorkVersion[]|Collection findByStageId(int $stage_id) Return ChildStageWorkVersion objects filtered by the stage_id column
 * @psalm-method Collection&\Traversable<ChildStageWorkVersion> findByStageId(int $stage_id) Return ChildStageWorkVersion objects filtered by the stage_id column
 * @method     ChildStageWorkVersion[]|Collection findByWorkId(int $work_id) Return ChildStageWorkVersion objects filtered by the work_id column
 * @psalm-method Collection&\Traversable<ChildStageWorkVersion> findByWorkId(int $work_id) Return ChildStageWorkVersion objects filtered by the work_id column
 * @method     ChildStageWorkVersion[]|Collection findByPrice(string $price) Return ChildStageWorkVersion objects filtered by the price column
 * @psalm-method Collection&\Traversable<ChildStageWorkVersion> findByPrice(string $price) Return ChildStageWorkVersion objects filtered by the price column
 * @method     ChildStageWorkVersion[]|Collection findByAmount(string $amount) Return ChildStageWorkVersion objects filtered by the amount column
 * @psalm-method Collection&\Traversable<ChildStageWorkVersion> findByAmount(string $amount) Return ChildStageWorkVersion objects filtered by the amount column
 * @method     ChildStageWorkVersion[]|Collection findByIsAvailable(boolean $is_available) Return ChildStageWorkVersion objects filtered by the is_available column
 * @psalm-method Collection&\Traversable<ChildStageWorkVersion> findByIsAvailable(boolean $is_available) Return ChildStageWorkVersion objects filtered by the is_available column
 * @method     ChildStageWorkVersion[]|Collection findByVersion(int $version) Return ChildStageWorkVersion objects filtered by the version column
 * @psalm-method Collection&\Traversable<ChildStageWorkVersion> findByVersion(int $version) Return ChildStageWorkVersion objects filtered by the version column
 * @method     ChildStageWorkVersion[]|Collection findByVersionCreatedAt(string $version_created_at) Return ChildStageWorkVersion objects filtered by the version_created_at column
 * @psalm-method Collection&\Traversable<ChildStageWorkVersion> findByVersionCreatedAt(string $version_created_at) Return ChildStageWorkVersion objects filtered by the version_created_at column
 * @method     ChildStageWorkVersion[]|Collection findByVersionCreatedBy(string $version_created_by) Return ChildStageWorkVersion objects filtered by the version_created_by column
 * @psalm-method Collection&\Traversable<ChildStageWorkVersion> findByVersionCreatedBy(string $version_created_by) Return ChildStageWorkVersion objects filtered by the version_created_by column
 * @method     ChildStageWorkVersion[]|Collection findByVersionComment(string $version_comment) Return ChildStageWorkVersion objects filtered by the version_comment column
 * @psalm-method Collection&\Traversable<ChildStageWorkVersion> findByVersionComment(string $version_comment) Return ChildStageWorkVersion objects filtered by the version_comment column
 * @method     ChildStageWorkVersion[]|Collection findByStageMaterialIds(array $stage_material_ids) Return ChildStageWorkVersion objects filtered by the stage_material_ids column
 * @psalm-method Collection&\Traversable<ChildStageWorkVersion> findByStageMaterialIds(array $stage_material_ids) Return ChildStageWorkVersion objects filtered by the stage_material_ids column
 * @method     ChildStageWorkVersion[]|Collection findByStageMaterialVersions(array $stage_material_versions) Return ChildStageWorkVersion objects filtered by the stage_material_versions column
 * @psalm-method Collection&\Traversable<ChildStageWorkVersion> findByStageMaterialVersions(array $stage_material_versions) Return ChildStageWorkVersion objects filtered by the stage_material_versions column
 * @method     ChildStageWorkVersion[]|Collection findByStageTechnicIds(array $stage_technic_ids) Return ChildStageWorkVersion objects filtered by the stage_technic_ids column
 * @psalm-method Collection&\Traversable<ChildStageWorkVersion> findByStageTechnicIds(array $stage_technic_ids) Return ChildStageWorkVersion objects filtered by the stage_technic_ids column
 * @method     ChildStageWorkVersion[]|Collection findByStageTechnicVersions(array $stage_technic_versions) Return ChildStageWorkVersion objects filtered by the stage_technic_versions column
 * @psalm-method Collection&\Traversable<ChildStageWorkVersion> findByStageTechnicVersions(array $stage_technic_versions) Return ChildStageWorkVersion objects filtered by the stage_technic_versions column
 * @method     ChildStageWorkVersion[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildStageWorkVersion> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class StageWorkVersionQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \DB\Base\StageWorkVersionQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\DB\\StageWorkVersion', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildStageWorkVersionQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildStageWorkVersionQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildStageWorkVersionQuery) {
            return $criteria;
        }
        $query = new ChildStageWorkVersionQuery();
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
     * @return ChildStageWorkVersion|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(StageWorkVersionTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = StageWorkVersionTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildStageWorkVersion A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, stage_id, work_id, price, amount, is_available, version, version_created_at, version_created_by, version_comment, stage_material_ids, stage_material_versions, stage_technic_ids, stage_technic_versions FROM stage_work_version WHERE id = :p0 AND version = :p1';
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
            /** @var ChildStageWorkVersion $obj */
            $obj = new ChildStageWorkVersion();
            $obj->hydrate($row);
            StageWorkVersionTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildStageWorkVersion|array|mixed the result, formatted by the current formatter
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
        $this->addUsingAlias(StageWorkVersionTableMap::COL_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(StageWorkVersionTableMap::COL_VERSION, $key[1], Criteria::EQUAL);

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
            $cton0 = $this->getNewCriterion(StageWorkVersionTableMap::COL_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(StageWorkVersionTableMap::COL_VERSION, $key[1], Criteria::EQUAL);
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
     * @see       filterByStageWork()
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
                $this->addUsingAlias(StageWorkVersionTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(StageWorkVersionTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StageWorkVersionTableMap::COL_ID, $id, $comparison);

        return $this;
    }

    /**
     * Filter the query on the stage_id column
     *
     * Example usage:
     * <code>
     * $query->filterByStageId(1234); // WHERE stage_id = 1234
     * $query->filterByStageId(array(12, 34)); // WHERE stage_id IN (12, 34)
     * $query->filterByStageId(array('min' => 12)); // WHERE stage_id > 12
     * </code>
     *
     * @param mixed $stageId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStageId($stageId = null, ?string $comparison = null)
    {
        if (is_array($stageId)) {
            $useMinMax = false;
            if (isset($stageId['min'])) {
                $this->addUsingAlias(StageWorkVersionTableMap::COL_STAGE_ID, $stageId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($stageId['max'])) {
                $this->addUsingAlias(StageWorkVersionTableMap::COL_STAGE_ID, $stageId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StageWorkVersionTableMap::COL_STAGE_ID, $stageId, $comparison);

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
                $this->addUsingAlias(StageWorkVersionTableMap::COL_WORK_ID, $workId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($workId['max'])) {
                $this->addUsingAlias(StageWorkVersionTableMap::COL_WORK_ID, $workId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StageWorkVersionTableMap::COL_WORK_ID, $workId, $comparison);

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
                $this->addUsingAlias(StageWorkVersionTableMap::COL_PRICE, $price['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($price['max'])) {
                $this->addUsingAlias(StageWorkVersionTableMap::COL_PRICE, $price['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StageWorkVersionTableMap::COL_PRICE, $price, $comparison);

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
                $this->addUsingAlias(StageWorkVersionTableMap::COL_AMOUNT, $amount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($amount['max'])) {
                $this->addUsingAlias(StageWorkVersionTableMap::COL_AMOUNT, $amount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StageWorkVersionTableMap::COL_AMOUNT, $amount, $comparison);

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

        $this->addUsingAlias(StageWorkVersionTableMap::COL_IS_AVAILABLE, $isAvailable, $comparison);

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
                $this->addUsingAlias(StageWorkVersionTableMap::COL_VERSION, $version['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($version['max'])) {
                $this->addUsingAlias(StageWorkVersionTableMap::COL_VERSION, $version['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StageWorkVersionTableMap::COL_VERSION, $version, $comparison);

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
                $this->addUsingAlias(StageWorkVersionTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($versionCreatedAt['max'])) {
                $this->addUsingAlias(StageWorkVersionTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StageWorkVersionTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt, $comparison);

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

        $this->addUsingAlias(StageWorkVersionTableMap::COL_VERSION_CREATED_BY, $versionCreatedBy, $comparison);

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

        $this->addUsingAlias(StageWorkVersionTableMap::COL_VERSION_COMMENT, $versionComment, $comparison);

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
        $key = $this->getAliasedColName(StageWorkVersionTableMap::COL_STAGE_MATERIAL_IDS);
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

        $this->addUsingAlias(StageWorkVersionTableMap::COL_STAGE_MATERIAL_IDS, $stageMaterialIds, $comparison);

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
            $key = $this->getAliasedColName(StageWorkVersionTableMap::COL_STAGE_MATERIAL_IDS);
            if ($this->containsKey($key)) {
                $this->addAnd($key, $stageMaterialIds, $comparison);
            } else {
                $this->addAnd($key, $stageMaterialIds, $comparison);
            }
            $this->addOr($key, null, Criteria::ISNULL);

            return $this;
        }

        $this->addUsingAlias(StageWorkVersionTableMap::COL_STAGE_MATERIAL_IDS, $stageMaterialIds, $comparison);

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
        $key = $this->getAliasedColName(StageWorkVersionTableMap::COL_STAGE_MATERIAL_VERSIONS);
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

        $this->addUsingAlias(StageWorkVersionTableMap::COL_STAGE_MATERIAL_VERSIONS, $stageMaterialVersions, $comparison);

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
            $key = $this->getAliasedColName(StageWorkVersionTableMap::COL_STAGE_MATERIAL_VERSIONS);
            if ($this->containsKey($key)) {
                $this->addAnd($key, $stageMaterialVersions, $comparison);
            } else {
                $this->addAnd($key, $stageMaterialVersions, $comparison);
            }
            $this->addOr($key, null, Criteria::ISNULL);

            return $this;
        }

        $this->addUsingAlias(StageWorkVersionTableMap::COL_STAGE_MATERIAL_VERSIONS, $stageMaterialVersions, $comparison);

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
        $key = $this->getAliasedColName(StageWorkVersionTableMap::COL_STAGE_TECHNIC_IDS);
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

        $this->addUsingAlias(StageWorkVersionTableMap::COL_STAGE_TECHNIC_IDS, $stageTechnicIds, $comparison);

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
            $key = $this->getAliasedColName(StageWorkVersionTableMap::COL_STAGE_TECHNIC_IDS);
            if ($this->containsKey($key)) {
                $this->addAnd($key, $stageTechnicIds, $comparison);
            } else {
                $this->addAnd($key, $stageTechnicIds, $comparison);
            }
            $this->addOr($key, null, Criteria::ISNULL);

            return $this;
        }

        $this->addUsingAlias(StageWorkVersionTableMap::COL_STAGE_TECHNIC_IDS, $stageTechnicIds, $comparison);

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
        $key = $this->getAliasedColName(StageWorkVersionTableMap::COL_STAGE_TECHNIC_VERSIONS);
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

        $this->addUsingAlias(StageWorkVersionTableMap::COL_STAGE_TECHNIC_VERSIONS, $stageTechnicVersions, $comparison);

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
            $key = $this->getAliasedColName(StageWorkVersionTableMap::COL_STAGE_TECHNIC_VERSIONS);
            if ($this->containsKey($key)) {
                $this->addAnd($key, $stageTechnicVersions, $comparison);
            } else {
                $this->addAnd($key, $stageTechnicVersions, $comparison);
            }
            $this->addOr($key, null, Criteria::ISNULL);

            return $this;
        }

        $this->addUsingAlias(StageWorkVersionTableMap::COL_STAGE_TECHNIC_VERSIONS, $stageTechnicVersions, $comparison);

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
                ->addUsingAlias(StageWorkVersionTableMap::COL_ID, $stageWork->getId(), $comparison);
        } elseif ($stageWork instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(StageWorkVersionTableMap::COL_ID, $stageWork->toKeyValue('PrimaryKey', 'Id'), $comparison);

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
     * Exclude object from result
     *
     * @param ChildStageWorkVersion $stageWorkVersion Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($stageWorkVersion = null)
    {
        if ($stageWorkVersion) {
            $this->addCond('pruneCond0', $this->getAliasedColName(StageWorkVersionTableMap::COL_ID), $stageWorkVersion->getId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(StageWorkVersionTableMap::COL_VERSION), $stageWorkVersion->getVersion(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the stage_work_version table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(StageWorkVersionTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            StageWorkVersionTableMap::clearInstancePool();
            StageWorkVersionTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(StageWorkVersionTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(StageWorkVersionTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            StageWorkVersionTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            StageWorkVersionTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
