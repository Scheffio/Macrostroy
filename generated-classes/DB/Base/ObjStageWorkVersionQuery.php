<?php

namespace DB\Base;

use \Exception;
use \PDO;
use DB\ObjStageWorkVersion as ChildObjStageWorkVersion;
use DB\ObjStageWorkVersionQuery as ChildObjStageWorkVersionQuery;
use DB\Map\ObjStageWorkVersionTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'obj_stage_work_version' table.
 *
 *
 *
 * @method     ChildObjStageWorkVersionQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildObjStageWorkVersionQuery orderByPrice($order = Criteria::ASC) Order by the price column
 * @method     ChildObjStageWorkVersionQuery orderByAmount($order = Criteria::ASC) Order by the amount column
 * @method     ChildObjStageWorkVersionQuery orderByIsAvailable($order = Criteria::ASC) Order by the is_available column
 * @method     ChildObjStageWorkVersionQuery orderByWorkId($order = Criteria::ASC) Order by the work_id column
 * @method     ChildObjStageWorkVersionQuery orderByStageId($order = Criteria::ASC) Order by the stage_id column
 * @method     ChildObjStageWorkVersionQuery orderByVersionCreatedBy($order = Criteria::ASC) Order by the version_created_by column
 * @method     ChildObjStageWorkVersionQuery orderByVersion($order = Criteria::ASC) Order by the version column
 * @method     ChildObjStageWorkVersionQuery orderByVersionCreatedAt($order = Criteria::ASC) Order by the version_created_at column
 * @method     ChildObjStageWorkVersionQuery orderByVersionComment($order = Criteria::ASC) Order by the version_comment column
 * @method     ChildObjStageWorkVersionQuery orderByWorkIdVersion($order = Criteria::ASC) Order by the work_id_version column
 * @method     ChildObjStageWorkVersionQuery orderByStageIdVersion($order = Criteria::ASC) Order by the stage_id_version column
 * @method     ChildObjStageWorkVersionQuery orderByObjStageMaterialIds($order = Criteria::ASC) Order by the obj_stage_material_ids column
 * @method     ChildObjStageWorkVersionQuery orderByObjStageMaterialVersions($order = Criteria::ASC) Order by the obj_stage_material_versions column
 * @method     ChildObjStageWorkVersionQuery orderByObjStageTechnicIds($order = Criteria::ASC) Order by the obj_stage_technic_ids column
 * @method     ChildObjStageWorkVersionQuery orderByObjStageTechnicVersions($order = Criteria::ASC) Order by the obj_stage_technic_versions column
 *
 * @method     ChildObjStageWorkVersionQuery groupById() Group by the id column
 * @method     ChildObjStageWorkVersionQuery groupByPrice() Group by the price column
 * @method     ChildObjStageWorkVersionQuery groupByAmount() Group by the amount column
 * @method     ChildObjStageWorkVersionQuery groupByIsAvailable() Group by the is_available column
 * @method     ChildObjStageWorkVersionQuery groupByWorkId() Group by the work_id column
 * @method     ChildObjStageWorkVersionQuery groupByStageId() Group by the stage_id column
 * @method     ChildObjStageWorkVersionQuery groupByVersionCreatedBy() Group by the version_created_by column
 * @method     ChildObjStageWorkVersionQuery groupByVersion() Group by the version column
 * @method     ChildObjStageWorkVersionQuery groupByVersionCreatedAt() Group by the version_created_at column
 * @method     ChildObjStageWorkVersionQuery groupByVersionComment() Group by the version_comment column
 * @method     ChildObjStageWorkVersionQuery groupByWorkIdVersion() Group by the work_id_version column
 * @method     ChildObjStageWorkVersionQuery groupByStageIdVersion() Group by the stage_id_version column
 * @method     ChildObjStageWorkVersionQuery groupByObjStageMaterialIds() Group by the obj_stage_material_ids column
 * @method     ChildObjStageWorkVersionQuery groupByObjStageMaterialVersions() Group by the obj_stage_material_versions column
 * @method     ChildObjStageWorkVersionQuery groupByObjStageTechnicIds() Group by the obj_stage_technic_ids column
 * @method     ChildObjStageWorkVersionQuery groupByObjStageTechnicVersions() Group by the obj_stage_technic_versions column
 *
 * @method     ChildObjStageWorkVersionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildObjStageWorkVersionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildObjStageWorkVersionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildObjStageWorkVersionQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildObjStageWorkVersionQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildObjStageWorkVersionQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildObjStageWorkVersionQuery leftJoinObjStageWork($relationAlias = null) Adds a LEFT JOIN clause to the query using the ObjStageWork relation
 * @method     ChildObjStageWorkVersionQuery rightJoinObjStageWork($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ObjStageWork relation
 * @method     ChildObjStageWorkVersionQuery innerJoinObjStageWork($relationAlias = null) Adds a INNER JOIN clause to the query using the ObjStageWork relation
 *
 * @method     ChildObjStageWorkVersionQuery joinWithObjStageWork($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ObjStageWork relation
 *
 * @method     ChildObjStageWorkVersionQuery leftJoinWithObjStageWork() Adds a LEFT JOIN clause and with to the query using the ObjStageWork relation
 * @method     ChildObjStageWorkVersionQuery rightJoinWithObjStageWork() Adds a RIGHT JOIN clause and with to the query using the ObjStageWork relation
 * @method     ChildObjStageWorkVersionQuery innerJoinWithObjStageWork() Adds a INNER JOIN clause and with to the query using the ObjStageWork relation
 *
 * @method     \DB\ObjStageWorkQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildObjStageWorkVersion|null findOne(?ConnectionInterface $con = null) Return the first ChildObjStageWorkVersion matching the query
 * @method     ChildObjStageWorkVersion findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildObjStageWorkVersion matching the query, or a new ChildObjStageWorkVersion object populated from the query conditions when no match is found
 *
 * @method     ChildObjStageWorkVersion|null findOneById(int $id) Return the first ChildObjStageWorkVersion filtered by the id column
 * @method     ChildObjStageWorkVersion|null findOneByPrice(string $price) Return the first ChildObjStageWorkVersion filtered by the price column
 * @method     ChildObjStageWorkVersion|null findOneByAmount(string $amount) Return the first ChildObjStageWorkVersion filtered by the amount column
 * @method     ChildObjStageWorkVersion|null findOneByIsAvailable(boolean $is_available) Return the first ChildObjStageWorkVersion filtered by the is_available column
 * @method     ChildObjStageWorkVersion|null findOneByWorkId(int $work_id) Return the first ChildObjStageWorkVersion filtered by the work_id column
 * @method     ChildObjStageWorkVersion|null findOneByStageId(int $stage_id) Return the first ChildObjStageWorkVersion filtered by the stage_id column
 * @method     ChildObjStageWorkVersion|null findOneByVersionCreatedBy(int $version_created_by) Return the first ChildObjStageWorkVersion filtered by the version_created_by column
 * @method     ChildObjStageWorkVersion|null findOneByVersion(int $version) Return the first ChildObjStageWorkVersion filtered by the version column
 * @method     ChildObjStageWorkVersion|null findOneByVersionCreatedAt(string $version_created_at) Return the first ChildObjStageWorkVersion filtered by the version_created_at column
 * @method     ChildObjStageWorkVersion|null findOneByVersionComment(string $version_comment) Return the first ChildObjStageWorkVersion filtered by the version_comment column
 * @method     ChildObjStageWorkVersion|null findOneByWorkIdVersion(int $work_id_version) Return the first ChildObjStageWorkVersion filtered by the work_id_version column
 * @method     ChildObjStageWorkVersion|null findOneByStageIdVersion(int $stage_id_version) Return the first ChildObjStageWorkVersion filtered by the stage_id_version column
 * @method     ChildObjStageWorkVersion|null findOneByObjStageMaterialIds(array $obj_stage_material_ids) Return the first ChildObjStageWorkVersion filtered by the obj_stage_material_ids column
 * @method     ChildObjStageWorkVersion|null findOneByObjStageMaterialVersions(array $obj_stage_material_versions) Return the first ChildObjStageWorkVersion filtered by the obj_stage_material_versions column
 * @method     ChildObjStageWorkVersion|null findOneByObjStageTechnicIds(array $obj_stage_technic_ids) Return the first ChildObjStageWorkVersion filtered by the obj_stage_technic_ids column
 * @method     ChildObjStageWorkVersion|null findOneByObjStageTechnicVersions(array $obj_stage_technic_versions) Return the first ChildObjStageWorkVersion filtered by the obj_stage_technic_versions column *

 * @method     ChildObjStageWorkVersion requirePk($key, ?ConnectionInterface $con = null) Return the ChildObjStageWorkVersion by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjStageWorkVersion requireOne(?ConnectionInterface $con = null) Return the first ChildObjStageWorkVersion matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildObjStageWorkVersion requireOneById(int $id) Return the first ChildObjStageWorkVersion filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjStageWorkVersion requireOneByPrice(string $price) Return the first ChildObjStageWorkVersion filtered by the price column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjStageWorkVersion requireOneByAmount(string $amount) Return the first ChildObjStageWorkVersion filtered by the amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjStageWorkVersion requireOneByIsAvailable(boolean $is_available) Return the first ChildObjStageWorkVersion filtered by the is_available column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjStageWorkVersion requireOneByWorkId(int $work_id) Return the first ChildObjStageWorkVersion filtered by the work_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjStageWorkVersion requireOneByStageId(int $stage_id) Return the first ChildObjStageWorkVersion filtered by the stage_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjStageWorkVersion requireOneByVersionCreatedBy(int $version_created_by) Return the first ChildObjStageWorkVersion filtered by the version_created_by column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjStageWorkVersion requireOneByVersion(int $version) Return the first ChildObjStageWorkVersion filtered by the version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjStageWorkVersion requireOneByVersionCreatedAt(string $version_created_at) Return the first ChildObjStageWorkVersion filtered by the version_created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjStageWorkVersion requireOneByVersionComment(string $version_comment) Return the first ChildObjStageWorkVersion filtered by the version_comment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjStageWorkVersion requireOneByWorkIdVersion(int $work_id_version) Return the first ChildObjStageWorkVersion filtered by the work_id_version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjStageWorkVersion requireOneByStageIdVersion(int $stage_id_version) Return the first ChildObjStageWorkVersion filtered by the stage_id_version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjStageWorkVersion requireOneByObjStageMaterialIds(array $obj_stage_material_ids) Return the first ChildObjStageWorkVersion filtered by the obj_stage_material_ids column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjStageWorkVersion requireOneByObjStageMaterialVersions(array $obj_stage_material_versions) Return the first ChildObjStageWorkVersion filtered by the obj_stage_material_versions column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjStageWorkVersion requireOneByObjStageTechnicIds(array $obj_stage_technic_ids) Return the first ChildObjStageWorkVersion filtered by the obj_stage_technic_ids column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildObjStageWorkVersion requireOneByObjStageTechnicVersions(array $obj_stage_technic_versions) Return the first ChildObjStageWorkVersion filtered by the obj_stage_technic_versions column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildObjStageWorkVersion[]|Collection find(?ConnectionInterface $con = null) Return ChildObjStageWorkVersion objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildObjStageWorkVersion> find(?ConnectionInterface $con = null) Return ChildObjStageWorkVersion objects based on current ModelCriteria
 * @method     ChildObjStageWorkVersion[]|Collection findById(int $id) Return ChildObjStageWorkVersion objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildObjStageWorkVersion> findById(int $id) Return ChildObjStageWorkVersion objects filtered by the id column
 * @method     ChildObjStageWorkVersion[]|Collection findByPrice(string $price) Return ChildObjStageWorkVersion objects filtered by the price column
 * @psalm-method Collection&\Traversable<ChildObjStageWorkVersion> findByPrice(string $price) Return ChildObjStageWorkVersion objects filtered by the price column
 * @method     ChildObjStageWorkVersion[]|Collection findByAmount(string $amount) Return ChildObjStageWorkVersion objects filtered by the amount column
 * @psalm-method Collection&\Traversable<ChildObjStageWorkVersion> findByAmount(string $amount) Return ChildObjStageWorkVersion objects filtered by the amount column
 * @method     ChildObjStageWorkVersion[]|Collection findByIsAvailable(boolean $is_available) Return ChildObjStageWorkVersion objects filtered by the is_available column
 * @psalm-method Collection&\Traversable<ChildObjStageWorkVersion> findByIsAvailable(boolean $is_available) Return ChildObjStageWorkVersion objects filtered by the is_available column
 * @method     ChildObjStageWorkVersion[]|Collection findByWorkId(int $work_id) Return ChildObjStageWorkVersion objects filtered by the work_id column
 * @psalm-method Collection&\Traversable<ChildObjStageWorkVersion> findByWorkId(int $work_id) Return ChildObjStageWorkVersion objects filtered by the work_id column
 * @method     ChildObjStageWorkVersion[]|Collection findByStageId(int $stage_id) Return ChildObjStageWorkVersion objects filtered by the stage_id column
 * @psalm-method Collection&\Traversable<ChildObjStageWorkVersion> findByStageId(int $stage_id) Return ChildObjStageWorkVersion objects filtered by the stage_id column
 * @method     ChildObjStageWorkVersion[]|Collection findByVersionCreatedBy(int $version_created_by) Return ChildObjStageWorkVersion objects filtered by the version_created_by column
 * @psalm-method Collection&\Traversable<ChildObjStageWorkVersion> findByVersionCreatedBy(int $version_created_by) Return ChildObjStageWorkVersion objects filtered by the version_created_by column
 * @method     ChildObjStageWorkVersion[]|Collection findByVersion(int $version) Return ChildObjStageWorkVersion objects filtered by the version column
 * @psalm-method Collection&\Traversable<ChildObjStageWorkVersion> findByVersion(int $version) Return ChildObjStageWorkVersion objects filtered by the version column
 * @method     ChildObjStageWorkVersion[]|Collection findByVersionCreatedAt(string $version_created_at) Return ChildObjStageWorkVersion objects filtered by the version_created_at column
 * @psalm-method Collection&\Traversable<ChildObjStageWorkVersion> findByVersionCreatedAt(string $version_created_at) Return ChildObjStageWorkVersion objects filtered by the version_created_at column
 * @method     ChildObjStageWorkVersion[]|Collection findByVersionComment(string $version_comment) Return ChildObjStageWorkVersion objects filtered by the version_comment column
 * @psalm-method Collection&\Traversable<ChildObjStageWorkVersion> findByVersionComment(string $version_comment) Return ChildObjStageWorkVersion objects filtered by the version_comment column
 * @method     ChildObjStageWorkVersion[]|Collection findByWorkIdVersion(int $work_id_version) Return ChildObjStageWorkVersion objects filtered by the work_id_version column
 * @psalm-method Collection&\Traversable<ChildObjStageWorkVersion> findByWorkIdVersion(int $work_id_version) Return ChildObjStageWorkVersion objects filtered by the work_id_version column
 * @method     ChildObjStageWorkVersion[]|Collection findByStageIdVersion(int $stage_id_version) Return ChildObjStageWorkVersion objects filtered by the stage_id_version column
 * @psalm-method Collection&\Traversable<ChildObjStageWorkVersion> findByStageIdVersion(int $stage_id_version) Return ChildObjStageWorkVersion objects filtered by the stage_id_version column
 * @method     ChildObjStageWorkVersion[]|Collection findByObjStageMaterialIds(array $obj_stage_material_ids) Return ChildObjStageWorkVersion objects filtered by the obj_stage_material_ids column
 * @psalm-method Collection&\Traversable<ChildObjStageWorkVersion> findByObjStageMaterialIds(array $obj_stage_material_ids) Return ChildObjStageWorkVersion objects filtered by the obj_stage_material_ids column
 * @method     ChildObjStageWorkVersion[]|Collection findByObjStageMaterialVersions(array $obj_stage_material_versions) Return ChildObjStageWorkVersion objects filtered by the obj_stage_material_versions column
 * @psalm-method Collection&\Traversable<ChildObjStageWorkVersion> findByObjStageMaterialVersions(array $obj_stage_material_versions) Return ChildObjStageWorkVersion objects filtered by the obj_stage_material_versions column
 * @method     ChildObjStageWorkVersion[]|Collection findByObjStageTechnicIds(array $obj_stage_technic_ids) Return ChildObjStageWorkVersion objects filtered by the obj_stage_technic_ids column
 * @psalm-method Collection&\Traversable<ChildObjStageWorkVersion> findByObjStageTechnicIds(array $obj_stage_technic_ids) Return ChildObjStageWorkVersion objects filtered by the obj_stage_technic_ids column
 * @method     ChildObjStageWorkVersion[]|Collection findByObjStageTechnicVersions(array $obj_stage_technic_versions) Return ChildObjStageWorkVersion objects filtered by the obj_stage_technic_versions column
 * @psalm-method Collection&\Traversable<ChildObjStageWorkVersion> findByObjStageTechnicVersions(array $obj_stage_technic_versions) Return ChildObjStageWorkVersion objects filtered by the obj_stage_technic_versions column
 * @method     ChildObjStageWorkVersion[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildObjStageWorkVersion> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ObjStageWorkVersionQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \DB\Base\ObjStageWorkVersionQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\DB\\ObjStageWorkVersion', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildObjStageWorkVersionQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildObjStageWorkVersionQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildObjStageWorkVersionQuery) {
            return $criteria;
        }
        $query = new ChildObjStageWorkVersionQuery();
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
     * @return ChildObjStageWorkVersion|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ObjStageWorkVersionTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ObjStageWorkVersionTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildObjStageWorkVersion A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, price, amount, is_available, work_id, stage_id, version_created_by, version, version_created_at, version_comment, work_id_version, stage_id_version, obj_stage_material_ids, obj_stage_material_versions, obj_stage_technic_ids, obj_stage_technic_versions FROM obj_stage_work_version WHERE id = :p0 AND version = :p1';
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
            /** @var ChildObjStageWorkVersion $obj */
            $obj = new ChildObjStageWorkVersion();
            $obj->hydrate($row);
            ObjStageWorkVersionTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildObjStageWorkVersion|array|mixed the result, formatted by the current formatter
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
        $this->addUsingAlias(ObjStageWorkVersionTableMap::COL_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(ObjStageWorkVersionTableMap::COL_VERSION, $key[1], Criteria::EQUAL);

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
            $cton0 = $this->getNewCriterion(ObjStageWorkVersionTableMap::COL_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(ObjStageWorkVersionTableMap::COL_VERSION, $key[1], Criteria::EQUAL);
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
     * @see       filterByObjStageWork()
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
                $this->addUsingAlias(ObjStageWorkVersionTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ObjStageWorkVersionTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ObjStageWorkVersionTableMap::COL_ID, $id, $comparison);

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
                $this->addUsingAlias(ObjStageWorkVersionTableMap::COL_PRICE, $price['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($price['max'])) {
                $this->addUsingAlias(ObjStageWorkVersionTableMap::COL_PRICE, $price['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ObjStageWorkVersionTableMap::COL_PRICE, $price, $comparison);

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
                $this->addUsingAlias(ObjStageWorkVersionTableMap::COL_AMOUNT, $amount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($amount['max'])) {
                $this->addUsingAlias(ObjStageWorkVersionTableMap::COL_AMOUNT, $amount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ObjStageWorkVersionTableMap::COL_AMOUNT, $amount, $comparison);

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

        $this->addUsingAlias(ObjStageWorkVersionTableMap::COL_IS_AVAILABLE, $isAvailable, $comparison);

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
                $this->addUsingAlias(ObjStageWorkVersionTableMap::COL_WORK_ID, $workId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($workId['max'])) {
                $this->addUsingAlias(ObjStageWorkVersionTableMap::COL_WORK_ID, $workId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ObjStageWorkVersionTableMap::COL_WORK_ID, $workId, $comparison);

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
                $this->addUsingAlias(ObjStageWorkVersionTableMap::COL_STAGE_ID, $stageId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($stageId['max'])) {
                $this->addUsingAlias(ObjStageWorkVersionTableMap::COL_STAGE_ID, $stageId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ObjStageWorkVersionTableMap::COL_STAGE_ID, $stageId, $comparison);

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
                $this->addUsingAlias(ObjStageWorkVersionTableMap::COL_VERSION_CREATED_BY, $versionCreatedBy['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($versionCreatedBy['max'])) {
                $this->addUsingAlias(ObjStageWorkVersionTableMap::COL_VERSION_CREATED_BY, $versionCreatedBy['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ObjStageWorkVersionTableMap::COL_VERSION_CREATED_BY, $versionCreatedBy, $comparison);

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
                $this->addUsingAlias(ObjStageWorkVersionTableMap::COL_VERSION, $version['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($version['max'])) {
                $this->addUsingAlias(ObjStageWorkVersionTableMap::COL_VERSION, $version['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ObjStageWorkVersionTableMap::COL_VERSION, $version, $comparison);

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
                $this->addUsingAlias(ObjStageWorkVersionTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($versionCreatedAt['max'])) {
                $this->addUsingAlias(ObjStageWorkVersionTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ObjStageWorkVersionTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt, $comparison);

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

        $this->addUsingAlias(ObjStageWorkVersionTableMap::COL_VERSION_COMMENT, $versionComment, $comparison);

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
                $this->addUsingAlias(ObjStageWorkVersionTableMap::COL_WORK_ID_VERSION, $workIdVersion['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($workIdVersion['max'])) {
                $this->addUsingAlias(ObjStageWorkVersionTableMap::COL_WORK_ID_VERSION, $workIdVersion['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ObjStageWorkVersionTableMap::COL_WORK_ID_VERSION, $workIdVersion, $comparison);

        return $this;
    }

    /**
     * Filter the query on the stage_id_version column
     *
     * Example usage:
     * <code>
     * $query->filterByStageIdVersion(1234); // WHERE stage_id_version = 1234
     * $query->filterByStageIdVersion(array(12, 34)); // WHERE stage_id_version IN (12, 34)
     * $query->filterByStageIdVersion(array('min' => 12)); // WHERE stage_id_version > 12
     * </code>
     *
     * @param mixed $stageIdVersion The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStageIdVersion($stageIdVersion = null, ?string $comparison = null)
    {
        if (is_array($stageIdVersion)) {
            $useMinMax = false;
            if (isset($stageIdVersion['min'])) {
                $this->addUsingAlias(ObjStageWorkVersionTableMap::COL_STAGE_ID_VERSION, $stageIdVersion['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($stageIdVersion['max'])) {
                $this->addUsingAlias(ObjStageWorkVersionTableMap::COL_STAGE_ID_VERSION, $stageIdVersion['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ObjStageWorkVersionTableMap::COL_STAGE_ID_VERSION, $stageIdVersion, $comparison);

        return $this;
    }

    /**
     * Filter the query on the obj_stage_material_ids column
     *
     * @param array $objStageMaterialIds The values to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByObjStageMaterialIds($objStageMaterialIds = null, ?string $comparison = null)
    {
        $key = $this->getAliasedColName(ObjStageWorkVersionTableMap::COL_OBJ_STAGE_MATERIAL_IDS);
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            foreach ($objStageMaterialIds as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addAnd($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_SOME) {
            foreach ($objStageMaterialIds as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addOr($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            foreach ($objStageMaterialIds as $value) {
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

        $this->addUsingAlias(ObjStageWorkVersionTableMap::COL_OBJ_STAGE_MATERIAL_IDS, $objStageMaterialIds, $comparison);

        return $this;
    }

    /**
     * Filter the query on the obj_stage_material_ids column
     * @param mixed $objStageMaterialIds The value to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::CONTAINS_ALL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByObjStageMaterialId($objStageMaterialIds = null, ?string $comparison = null)
    {
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            if (is_scalar($objStageMaterialIds)) {
                $objStageMaterialIds = '%| ' . $objStageMaterialIds . ' |%';
                $comparison = Criteria::LIKE;
            }
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            $objStageMaterialIds = '%| ' . $objStageMaterialIds . ' |%';
            $comparison = Criteria::NOT_LIKE;
            $key = $this->getAliasedColName(ObjStageWorkVersionTableMap::COL_OBJ_STAGE_MATERIAL_IDS);
            if ($this->containsKey($key)) {
                $this->addAnd($key, $objStageMaterialIds, $comparison);
            } else {
                $this->addAnd($key, $objStageMaterialIds, $comparison);
            }
            $this->addOr($key, null, Criteria::ISNULL);

            return $this;
        }

        $this->addUsingAlias(ObjStageWorkVersionTableMap::COL_OBJ_STAGE_MATERIAL_IDS, $objStageMaterialIds, $comparison);

        return $this;
    }

    /**
     * Filter the query on the obj_stage_material_versions column
     *
     * @param array $objStageMaterialVersions The values to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByObjStageMaterialVersions($objStageMaterialVersions = null, ?string $comparison = null)
    {
        $key = $this->getAliasedColName(ObjStageWorkVersionTableMap::COL_OBJ_STAGE_MATERIAL_VERSIONS);
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            foreach ($objStageMaterialVersions as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addAnd($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_SOME) {
            foreach ($objStageMaterialVersions as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addOr($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            foreach ($objStageMaterialVersions as $value) {
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

        $this->addUsingAlias(ObjStageWorkVersionTableMap::COL_OBJ_STAGE_MATERIAL_VERSIONS, $objStageMaterialVersions, $comparison);

        return $this;
    }

    /**
     * Filter the query on the obj_stage_material_versions column
     * @param mixed $objStageMaterialVersions The value to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::CONTAINS_ALL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByObjStageMaterialVersion($objStageMaterialVersions = null, ?string $comparison = null)
    {
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            if (is_scalar($objStageMaterialVersions)) {
                $objStageMaterialVersions = '%| ' . $objStageMaterialVersions . ' |%';
                $comparison = Criteria::LIKE;
            }
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            $objStageMaterialVersions = '%| ' . $objStageMaterialVersions . ' |%';
            $comparison = Criteria::NOT_LIKE;
            $key = $this->getAliasedColName(ObjStageWorkVersionTableMap::COL_OBJ_STAGE_MATERIAL_VERSIONS);
            if ($this->containsKey($key)) {
                $this->addAnd($key, $objStageMaterialVersions, $comparison);
            } else {
                $this->addAnd($key, $objStageMaterialVersions, $comparison);
            }
            $this->addOr($key, null, Criteria::ISNULL);

            return $this;
        }

        $this->addUsingAlias(ObjStageWorkVersionTableMap::COL_OBJ_STAGE_MATERIAL_VERSIONS, $objStageMaterialVersions, $comparison);

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
        $key = $this->getAliasedColName(ObjStageWorkVersionTableMap::COL_OBJ_STAGE_TECHNIC_IDS);
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

        $this->addUsingAlias(ObjStageWorkVersionTableMap::COL_OBJ_STAGE_TECHNIC_IDS, $objStageTechnicIds, $comparison);

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
            $key = $this->getAliasedColName(ObjStageWorkVersionTableMap::COL_OBJ_STAGE_TECHNIC_IDS);
            if ($this->containsKey($key)) {
                $this->addAnd($key, $objStageTechnicIds, $comparison);
            } else {
                $this->addAnd($key, $objStageTechnicIds, $comparison);
            }
            $this->addOr($key, null, Criteria::ISNULL);

            return $this;
        }

        $this->addUsingAlias(ObjStageWorkVersionTableMap::COL_OBJ_STAGE_TECHNIC_IDS, $objStageTechnicIds, $comparison);

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
        $key = $this->getAliasedColName(ObjStageWorkVersionTableMap::COL_OBJ_STAGE_TECHNIC_VERSIONS);
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

        $this->addUsingAlias(ObjStageWorkVersionTableMap::COL_OBJ_STAGE_TECHNIC_VERSIONS, $objStageTechnicVersions, $comparison);

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
            $key = $this->getAliasedColName(ObjStageWorkVersionTableMap::COL_OBJ_STAGE_TECHNIC_VERSIONS);
            if ($this->containsKey($key)) {
                $this->addAnd($key, $objStageTechnicVersions, $comparison);
            } else {
                $this->addAnd($key, $objStageTechnicVersions, $comparison);
            }
            $this->addOr($key, null, Criteria::ISNULL);

            return $this;
        }

        $this->addUsingAlias(ObjStageWorkVersionTableMap::COL_OBJ_STAGE_TECHNIC_VERSIONS, $objStageTechnicVersions, $comparison);

        return $this;
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
                ->addUsingAlias(ObjStageWorkVersionTableMap::COL_ID, $objStageWork->getId(), $comparison);
        } elseif ($objStageWork instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(ObjStageWorkVersionTableMap::COL_ID, $objStageWork->toKeyValue('PrimaryKey', 'Id'), $comparison);

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
     * Exclude object from result
     *
     * @param ChildObjStageWorkVersion $objStageWorkVersion Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($objStageWorkVersion = null)
    {
        if ($objStageWorkVersion) {
            $this->addCond('pruneCond0', $this->getAliasedColName(ObjStageWorkVersionTableMap::COL_ID), $objStageWorkVersion->getId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(ObjStageWorkVersionTableMap::COL_VERSION), $objStageWorkVersion->getVersion(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the obj_stage_work_version table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ObjStageWorkVersionTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ObjStageWorkVersionTableMap::clearInstancePool();
            ObjStageWorkVersionTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ObjStageWorkVersionTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ObjStageWorkVersionTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ObjStageWorkVersionTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ObjStageWorkVersionTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
