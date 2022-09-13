<?php

namespace DB\Base;

use \Exception;
use \PDO;
use DB\VolWork as ChildVolWork;
use DB\VolWorkQuery as ChildVolWorkQuery;
use DB\Map\VolWorkTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'vol_work' table.
 *
 *
 *
 * @method     ChildVolWorkQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildVolWorkQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildVolWorkQuery orderByPrice($order = Criteria::ASC) Order by the price column
 * @method     ChildVolWorkQuery orderByIsAvailable($order = Criteria::ASC) Order by the is_available column
 * @method     ChildVolWorkQuery orderByUnitId($order = Criteria::ASC) Order by the unit_id column
 * @method     ChildVolWorkQuery orderByVersionCreatedBy($order = Criteria::ASC) Order by the version_created_by column
 * @method     ChildVolWorkQuery orderByVersion($order = Criteria::ASC) Order by the version column
 * @method     ChildVolWorkQuery orderByVersionCreatedAt($order = Criteria::ASC) Order by the version_created_at column
 * @method     ChildVolWorkQuery orderByVersionComment($order = Criteria::ASC) Order by the version_comment column
 *
 * @method     ChildVolWorkQuery groupById() Group by the id column
 * @method     ChildVolWorkQuery groupByName() Group by the name column
 * @method     ChildVolWorkQuery groupByPrice() Group by the price column
 * @method     ChildVolWorkQuery groupByIsAvailable() Group by the is_available column
 * @method     ChildVolWorkQuery groupByUnitId() Group by the unit_id column
 * @method     ChildVolWorkQuery groupByVersionCreatedBy() Group by the version_created_by column
 * @method     ChildVolWorkQuery groupByVersion() Group by the version column
 * @method     ChildVolWorkQuery groupByVersionCreatedAt() Group by the version_created_at column
 * @method     ChildVolWorkQuery groupByVersionComment() Group by the version_comment column
 *
 * @method     ChildVolWorkQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildVolWorkQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildVolWorkQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildVolWorkQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildVolWorkQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildVolWorkQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildVolWorkQuery leftJoinUsers($relationAlias = null) Adds a LEFT JOIN clause to the query using the Users relation
 * @method     ChildVolWorkQuery rightJoinUsers($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Users relation
 * @method     ChildVolWorkQuery innerJoinUsers($relationAlias = null) Adds a INNER JOIN clause to the query using the Users relation
 *
 * @method     ChildVolWorkQuery joinWithUsers($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Users relation
 *
 * @method     ChildVolWorkQuery leftJoinWithUsers() Adds a LEFT JOIN clause and with to the query using the Users relation
 * @method     ChildVolWorkQuery rightJoinWithUsers() Adds a RIGHT JOIN clause and with to the query using the Users relation
 * @method     ChildVolWorkQuery innerJoinWithUsers() Adds a INNER JOIN clause and with to the query using the Users relation
 *
 * @method     ChildVolWorkQuery leftJoinVolUnit($relationAlias = null) Adds a LEFT JOIN clause to the query using the VolUnit relation
 * @method     ChildVolWorkQuery rightJoinVolUnit($relationAlias = null) Adds a RIGHT JOIN clause to the query using the VolUnit relation
 * @method     ChildVolWorkQuery innerJoinVolUnit($relationAlias = null) Adds a INNER JOIN clause to the query using the VolUnit relation
 *
 * @method     ChildVolWorkQuery joinWithVolUnit($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the VolUnit relation
 *
 * @method     ChildVolWorkQuery leftJoinWithVolUnit() Adds a LEFT JOIN clause and with to the query using the VolUnit relation
 * @method     ChildVolWorkQuery rightJoinWithVolUnit() Adds a RIGHT JOIN clause and with to the query using the VolUnit relation
 * @method     ChildVolWorkQuery innerJoinWithVolUnit() Adds a INNER JOIN clause and with to the query using the VolUnit relation
 *
 * @method     ChildVolWorkQuery leftJoinObjStageWork($relationAlias = null) Adds a LEFT JOIN clause to the query using the ObjStageWork relation
 * @method     ChildVolWorkQuery rightJoinObjStageWork($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ObjStageWork relation
 * @method     ChildVolWorkQuery innerJoinObjStageWork($relationAlias = null) Adds a INNER JOIN clause to the query using the ObjStageWork relation
 *
 * @method     ChildVolWorkQuery joinWithObjStageWork($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ObjStageWork relation
 *
 * @method     ChildVolWorkQuery leftJoinWithObjStageWork() Adds a LEFT JOIN clause and with to the query using the ObjStageWork relation
 * @method     ChildVolWorkQuery rightJoinWithObjStageWork() Adds a RIGHT JOIN clause and with to the query using the ObjStageWork relation
 * @method     ChildVolWorkQuery innerJoinWithObjStageWork() Adds a INNER JOIN clause and with to the query using the ObjStageWork relation
 *
 * @method     ChildVolWorkQuery leftJoinVolWorkMaterial($relationAlias = null) Adds a LEFT JOIN clause to the query using the VolWorkMaterial relation
 * @method     ChildVolWorkQuery rightJoinVolWorkMaterial($relationAlias = null) Adds a RIGHT JOIN clause to the query using the VolWorkMaterial relation
 * @method     ChildVolWorkQuery innerJoinVolWorkMaterial($relationAlias = null) Adds a INNER JOIN clause to the query using the VolWorkMaterial relation
 *
 * @method     ChildVolWorkQuery joinWithVolWorkMaterial($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the VolWorkMaterial relation
 *
 * @method     ChildVolWorkQuery leftJoinWithVolWorkMaterial() Adds a LEFT JOIN clause and with to the query using the VolWorkMaterial relation
 * @method     ChildVolWorkQuery rightJoinWithVolWorkMaterial() Adds a RIGHT JOIN clause and with to the query using the VolWorkMaterial relation
 * @method     ChildVolWorkQuery innerJoinWithVolWorkMaterial() Adds a INNER JOIN clause and with to the query using the VolWorkMaterial relation
 *
 * @method     ChildVolWorkQuery leftJoinVolWorkTechnic($relationAlias = null) Adds a LEFT JOIN clause to the query using the VolWorkTechnic relation
 * @method     ChildVolWorkQuery rightJoinVolWorkTechnic($relationAlias = null) Adds a RIGHT JOIN clause to the query using the VolWorkTechnic relation
 * @method     ChildVolWorkQuery innerJoinVolWorkTechnic($relationAlias = null) Adds a INNER JOIN clause to the query using the VolWorkTechnic relation
 *
 * @method     ChildVolWorkQuery joinWithVolWorkTechnic($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the VolWorkTechnic relation
 *
 * @method     ChildVolWorkQuery leftJoinWithVolWorkTechnic() Adds a LEFT JOIN clause and with to the query using the VolWorkTechnic relation
 * @method     ChildVolWorkQuery rightJoinWithVolWorkTechnic() Adds a RIGHT JOIN clause and with to the query using the VolWorkTechnic relation
 * @method     ChildVolWorkQuery innerJoinWithVolWorkTechnic() Adds a INNER JOIN clause and with to the query using the VolWorkTechnic relation
 *
 * @method     ChildVolWorkQuery leftJoinVolWorkVersion($relationAlias = null) Adds a LEFT JOIN clause to the query using the VolWorkVersion relation
 * @method     ChildVolWorkQuery rightJoinVolWorkVersion($relationAlias = null) Adds a RIGHT JOIN clause to the query using the VolWorkVersion relation
 * @method     ChildVolWorkQuery innerJoinVolWorkVersion($relationAlias = null) Adds a INNER JOIN clause to the query using the VolWorkVersion relation
 *
 * @method     ChildVolWorkQuery joinWithVolWorkVersion($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the VolWorkVersion relation
 *
 * @method     ChildVolWorkQuery leftJoinWithVolWorkVersion() Adds a LEFT JOIN clause and with to the query using the VolWorkVersion relation
 * @method     ChildVolWorkQuery rightJoinWithVolWorkVersion() Adds a RIGHT JOIN clause and with to the query using the VolWorkVersion relation
 * @method     ChildVolWorkQuery innerJoinWithVolWorkVersion() Adds a INNER JOIN clause and with to the query using the VolWorkVersion relation
 *
 * @method     \DB\UsersQuery|\DB\VolUnitQuery|\DB\ObjStageWorkQuery|\DB\VolWorkMaterialQuery|\DB\VolWorkTechnicQuery|\DB\VolWorkVersionQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildVolWork|null findOne(?ConnectionInterface $con = null) Return the first ChildVolWork matching the query
 * @method     ChildVolWork findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildVolWork matching the query, or a new ChildVolWork object populated from the query conditions when no match is found
 *
 * @method     ChildVolWork|null findOneById(int $id) Return the first ChildVolWork filtered by the id column
 * @method     ChildVolWork|null findOneByName(string $name) Return the first ChildVolWork filtered by the name column
 * @method     ChildVolWork|null findOneByPrice(string $price) Return the first ChildVolWork filtered by the price column
 * @method     ChildVolWork|null findOneByIsAvailable(boolean $is_available) Return the first ChildVolWork filtered by the is_available column
 * @method     ChildVolWork|null findOneByUnitId(int $unit_id) Return the first ChildVolWork filtered by the unit_id column
 * @method     ChildVolWork|null findOneByVersionCreatedBy(int $version_created_by) Return the first ChildVolWork filtered by the version_created_by column
 * @method     ChildVolWork|null findOneByVersion(int $version) Return the first ChildVolWork filtered by the version column
 * @method     ChildVolWork|null findOneByVersionCreatedAt(string $version_created_at) Return the first ChildVolWork filtered by the version_created_at column
 * @method     ChildVolWork|null findOneByVersionComment(string $version_comment) Return the first ChildVolWork filtered by the version_comment column *

 * @method     ChildVolWork requirePk($key, ?ConnectionInterface $con = null) Return the ChildVolWork by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolWork requireOne(?ConnectionInterface $con = null) Return the first ChildVolWork matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildVolWork requireOneById(int $id) Return the first ChildVolWork filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolWork requireOneByName(string $name) Return the first ChildVolWork filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolWork requireOneByPrice(string $price) Return the first ChildVolWork filtered by the price column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolWork requireOneByIsAvailable(boolean $is_available) Return the first ChildVolWork filtered by the is_available column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolWork requireOneByUnitId(int $unit_id) Return the first ChildVolWork filtered by the unit_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolWork requireOneByVersionCreatedBy(int $version_created_by) Return the first ChildVolWork filtered by the version_created_by column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolWork requireOneByVersion(int $version) Return the first ChildVolWork filtered by the version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolWork requireOneByVersionCreatedAt(string $version_created_at) Return the first ChildVolWork filtered by the version_created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolWork requireOneByVersionComment(string $version_comment) Return the first ChildVolWork filtered by the version_comment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildVolWork[]|Collection find(?ConnectionInterface $con = null) Return ChildVolWork objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildVolWork> find(?ConnectionInterface $con = null) Return ChildVolWork objects based on current ModelCriteria
 * @method     ChildVolWork[]|Collection findById(int $id) Return ChildVolWork objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildVolWork> findById(int $id) Return ChildVolWork objects filtered by the id column
 * @method     ChildVolWork[]|Collection findByName(string $name) Return ChildVolWork objects filtered by the name column
 * @psalm-method Collection&\Traversable<ChildVolWork> findByName(string $name) Return ChildVolWork objects filtered by the name column
 * @method     ChildVolWork[]|Collection findByPrice(string $price) Return ChildVolWork objects filtered by the price column
 * @psalm-method Collection&\Traversable<ChildVolWork> findByPrice(string $price) Return ChildVolWork objects filtered by the price column
 * @method     ChildVolWork[]|Collection findByIsAvailable(boolean $is_available) Return ChildVolWork objects filtered by the is_available column
 * @psalm-method Collection&\Traversable<ChildVolWork> findByIsAvailable(boolean $is_available) Return ChildVolWork objects filtered by the is_available column
 * @method     ChildVolWork[]|Collection findByUnitId(int $unit_id) Return ChildVolWork objects filtered by the unit_id column
 * @psalm-method Collection&\Traversable<ChildVolWork> findByUnitId(int $unit_id) Return ChildVolWork objects filtered by the unit_id column
 * @method     ChildVolWork[]|Collection findByVersionCreatedBy(int $version_created_by) Return ChildVolWork objects filtered by the version_created_by column
 * @psalm-method Collection&\Traversable<ChildVolWork> findByVersionCreatedBy(int $version_created_by) Return ChildVolWork objects filtered by the version_created_by column
 * @method     ChildVolWork[]|Collection findByVersion(int $version) Return ChildVolWork objects filtered by the version column
 * @psalm-method Collection&\Traversable<ChildVolWork> findByVersion(int $version) Return ChildVolWork objects filtered by the version column
 * @method     ChildVolWork[]|Collection findByVersionCreatedAt(string $version_created_at) Return ChildVolWork objects filtered by the version_created_at column
 * @psalm-method Collection&\Traversable<ChildVolWork> findByVersionCreatedAt(string $version_created_at) Return ChildVolWork objects filtered by the version_created_at column
 * @method     ChildVolWork[]|Collection findByVersionComment(string $version_comment) Return ChildVolWork objects filtered by the version_comment column
 * @psalm-method Collection&\Traversable<ChildVolWork> findByVersionComment(string $version_comment) Return ChildVolWork objects filtered by the version_comment column
 * @method     ChildVolWork[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildVolWork> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class VolWorkQuery extends ModelCriteria
{

    // versionable behavior

    /**
     * Whether the versioning is enabled
     */
    static $isVersioningEnabled = true;
protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \DB\Base\VolWorkQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\DB\\VolWork', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildVolWorkQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildVolWorkQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildVolWorkQuery) {
            return $criteria;
        }
        $query = new ChildVolWorkQuery();
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
     * @return ChildVolWork|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(VolWorkTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = VolWorkTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildVolWork A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, price, is_available, unit_id, version_created_by, version, version_created_at, version_comment FROM vol_work WHERE id = :p0';
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
            /** @var ChildVolWork $obj */
            $obj = new ChildVolWork();
            $obj->hydrate($row);
            VolWorkTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildVolWork|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(VolWorkTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(VolWorkTableMap::COL_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(VolWorkTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(VolWorkTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(VolWorkTableMap::COL_ID, $id, $comparison);

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

        $this->addUsingAlias(VolWorkTableMap::COL_NAME, $name, $comparison);

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
                $this->addUsingAlias(VolWorkTableMap::COL_PRICE, $price['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($price['max'])) {
                $this->addUsingAlias(VolWorkTableMap::COL_PRICE, $price['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(VolWorkTableMap::COL_PRICE, $price, $comparison);

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

        $this->addUsingAlias(VolWorkTableMap::COL_IS_AVAILABLE, $isAvailable, $comparison);

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
     * @see       filterByVolUnit()
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
                $this->addUsingAlias(VolWorkTableMap::COL_UNIT_ID, $unitId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($unitId['max'])) {
                $this->addUsingAlias(VolWorkTableMap::COL_UNIT_ID, $unitId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(VolWorkTableMap::COL_UNIT_ID, $unitId, $comparison);

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
                $this->addUsingAlias(VolWorkTableMap::COL_VERSION_CREATED_BY, $versionCreatedBy['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($versionCreatedBy['max'])) {
                $this->addUsingAlias(VolWorkTableMap::COL_VERSION_CREATED_BY, $versionCreatedBy['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(VolWorkTableMap::COL_VERSION_CREATED_BY, $versionCreatedBy, $comparison);

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
                $this->addUsingAlias(VolWorkTableMap::COL_VERSION, $version['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($version['max'])) {
                $this->addUsingAlias(VolWorkTableMap::COL_VERSION, $version['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(VolWorkTableMap::COL_VERSION, $version, $comparison);

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
                $this->addUsingAlias(VolWorkTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($versionCreatedAt['max'])) {
                $this->addUsingAlias(VolWorkTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(VolWorkTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt, $comparison);

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

        $this->addUsingAlias(VolWorkTableMap::COL_VERSION_COMMENT, $versionComment, $comparison);

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
                ->addUsingAlias(VolWorkTableMap::COL_VERSION_CREATED_BY, $users->getId(), $comparison);
        } elseif ($users instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(VolWorkTableMap::COL_VERSION_CREATED_BY, $users->toKeyValue('PrimaryKey', 'Id'), $comparison);

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
     * Filter the query by a related \DB\VolUnit object
     *
     * @param \DB\VolUnit|ObjectCollection $volUnit The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByVolUnit($volUnit, ?string $comparison = null)
    {
        if ($volUnit instanceof \DB\VolUnit) {
            return $this
                ->addUsingAlias(VolWorkTableMap::COL_UNIT_ID, $volUnit->getId(), $comparison);
        } elseif ($volUnit instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(VolWorkTableMap::COL_UNIT_ID, $volUnit->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByVolUnit() only accepts arguments of type \DB\VolUnit or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the VolUnit relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinVolUnit(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('VolUnit');

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
            $this->addJoinObject($join, 'VolUnit');
        }

        return $this;
    }

    /**
     * Use the VolUnit relation VolUnit object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\VolUnitQuery A secondary query class using the current class as primary query
     */
    public function useVolUnitQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinVolUnit($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'VolUnit', '\DB\VolUnitQuery');
    }

    /**
     * Use the VolUnit relation VolUnit object
     *
     * @param callable(\DB\VolUnitQuery):\DB\VolUnitQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withVolUnitQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useVolUnitQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to VolUnit table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\VolUnitQuery The inner query object of the EXISTS statement
     */
    public function useVolUnitExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('VolUnit', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to VolUnit table for a NOT EXISTS query.
     *
     * @see useVolUnitExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\VolUnitQuery The inner query object of the NOT EXISTS statement
     */
    public function useVolUnitNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('VolUnit', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \DB\ObjStageWork object
     *
     * @param \DB\ObjStageWork|ObjectCollection $objStageWork the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByObjStageWork($objStageWork, ?string $comparison = null)
    {
        if ($objStageWork instanceof \DB\ObjStageWork) {
            $this
                ->addUsingAlias(VolWorkTableMap::COL_ID, $objStageWork->getWorkId(), $comparison);

            return $this;
        } elseif ($objStageWork instanceof ObjectCollection) {
            $this
                ->useObjStageWorkQuery()
                ->filterByPrimaryKeys($objStageWork->getPrimaryKeys())
                ->endUse();

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
     * Filter the query by a related \DB\VolWorkMaterial object
     *
     * @param \DB\VolWorkMaterial|ObjectCollection $volWorkMaterial the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByVolWorkMaterial($volWorkMaterial, ?string $comparison = null)
    {
        if ($volWorkMaterial instanceof \DB\VolWorkMaterial) {
            $this
                ->addUsingAlias(VolWorkTableMap::COL_ID, $volWorkMaterial->getWorkId(), $comparison);

            return $this;
        } elseif ($volWorkMaterial instanceof ObjectCollection) {
            $this
                ->useVolWorkMaterialQuery()
                ->filterByPrimaryKeys($volWorkMaterial->getPrimaryKeys())
                ->endUse();

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
     * Filter the query by a related \DB\VolWorkTechnic object
     *
     * @param \DB\VolWorkTechnic|ObjectCollection $volWorkTechnic the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByVolWorkTechnic($volWorkTechnic, ?string $comparison = null)
    {
        if ($volWorkTechnic instanceof \DB\VolWorkTechnic) {
            $this
                ->addUsingAlias(VolWorkTableMap::COL_ID, $volWorkTechnic->getWorkId(), $comparison);

            return $this;
        } elseif ($volWorkTechnic instanceof ObjectCollection) {
            $this
                ->useVolWorkTechnicQuery()
                ->filterByPrimaryKeys($volWorkTechnic->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByVolWorkTechnic() only accepts arguments of type \DB\VolWorkTechnic or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the VolWorkTechnic relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinVolWorkTechnic(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('VolWorkTechnic');

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
            $this->addJoinObject($join, 'VolWorkTechnic');
        }

        return $this;
    }

    /**
     * Use the VolWorkTechnic relation VolWorkTechnic object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\VolWorkTechnicQuery A secondary query class using the current class as primary query
     */
    public function useVolWorkTechnicQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinVolWorkTechnic($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'VolWorkTechnic', '\DB\VolWorkTechnicQuery');
    }

    /**
     * Use the VolWorkTechnic relation VolWorkTechnic object
     *
     * @param callable(\DB\VolWorkTechnicQuery):\DB\VolWorkTechnicQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withVolWorkTechnicQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useVolWorkTechnicQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to VolWorkTechnic table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\VolWorkTechnicQuery The inner query object of the EXISTS statement
     */
    public function useVolWorkTechnicExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('VolWorkTechnic', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to VolWorkTechnic table for a NOT EXISTS query.
     *
     * @see useVolWorkTechnicExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\VolWorkTechnicQuery The inner query object of the NOT EXISTS statement
     */
    public function useVolWorkTechnicNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('VolWorkTechnic', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \DB\VolWorkVersion object
     *
     * @param \DB\VolWorkVersion|ObjectCollection $volWorkVersion the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByVolWorkVersion($volWorkVersion, ?string $comparison = null)
    {
        if ($volWorkVersion instanceof \DB\VolWorkVersion) {
            $this
                ->addUsingAlias(VolWorkTableMap::COL_ID, $volWorkVersion->getId(), $comparison);

            return $this;
        } elseif ($volWorkVersion instanceof ObjectCollection) {
            $this
                ->useVolWorkVersionQuery()
                ->filterByPrimaryKeys($volWorkVersion->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByVolWorkVersion() only accepts arguments of type \DB\VolWorkVersion or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the VolWorkVersion relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinVolWorkVersion(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('VolWorkVersion');

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
            $this->addJoinObject($join, 'VolWorkVersion');
        }

        return $this;
    }

    /**
     * Use the VolWorkVersion relation VolWorkVersion object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\VolWorkVersionQuery A secondary query class using the current class as primary query
     */
    public function useVolWorkVersionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinVolWorkVersion($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'VolWorkVersion', '\DB\VolWorkVersionQuery');
    }

    /**
     * Use the VolWorkVersion relation VolWorkVersion object
     *
     * @param callable(\DB\VolWorkVersionQuery):\DB\VolWorkVersionQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withVolWorkVersionQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useVolWorkVersionQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to VolWorkVersion table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\VolWorkVersionQuery The inner query object of the EXISTS statement
     */
    public function useVolWorkVersionExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('VolWorkVersion', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to VolWorkVersion table for a NOT EXISTS query.
     *
     * @see useVolWorkVersionExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\VolWorkVersionQuery The inner query object of the NOT EXISTS statement
     */
    public function useVolWorkVersionNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('VolWorkVersion', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Exclude object from result
     *
     * @param ChildVolWork $volWork Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($volWork = null)
    {
        if ($volWork) {
            $this->addUsingAlias(VolWorkTableMap::COL_ID, $volWork->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the vol_work table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(VolWorkTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            VolWorkTableMap::clearInstancePool();
            VolWorkTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(VolWorkTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(VolWorkTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            VolWorkTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            VolWorkTableMap::clearRelatedInstancePool();

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
