<?php

namespace DB\Base;

use \Exception;
use \PDO;
use DB\Unit as ChildUnit;
use DB\UnitQuery as ChildUnitQuery;
use DB\Map\UnitTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'unit' table.
 *
 *
 *
 * @method     ChildUnitQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildUnitQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildUnitQuery orderByIsAvailable($order = Criteria::ASC) Order by the is_available column
 * @method     ChildUnitQuery orderByVersion($order = Criteria::ASC) Order by the version column
 * @method     ChildUnitQuery orderByVersionCreatedAt($order = Criteria::ASC) Order by the version_created_at column
 * @method     ChildUnitQuery orderByVersionCreatedBy($order = Criteria::ASC) Order by the version_created_by column
 *
 * @method     ChildUnitQuery groupById() Group by the id column
 * @method     ChildUnitQuery groupByName() Group by the name column
 * @method     ChildUnitQuery groupByIsAvailable() Group by the is_available column
 * @method     ChildUnitQuery groupByVersion() Group by the version column
 * @method     ChildUnitQuery groupByVersionCreatedAt() Group by the version_created_at column
 * @method     ChildUnitQuery groupByVersionCreatedBy() Group by the version_created_by column
 *
 * @method     ChildUnitQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUnitQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUnitQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUnitQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildUnitQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildUnitQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildUnitQuery leftJoinMaterial($relationAlias = null) Adds a LEFT JOIN clause to the query using the Material relation
 * @method     ChildUnitQuery rightJoinMaterial($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Material relation
 * @method     ChildUnitQuery innerJoinMaterial($relationAlias = null) Adds a INNER JOIN clause to the query using the Material relation
 *
 * @method     ChildUnitQuery joinWithMaterial($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Material relation
 *
 * @method     ChildUnitQuery leftJoinWithMaterial() Adds a LEFT JOIN clause and with to the query using the Material relation
 * @method     ChildUnitQuery rightJoinWithMaterial() Adds a RIGHT JOIN clause and with to the query using the Material relation
 * @method     ChildUnitQuery innerJoinWithMaterial() Adds a INNER JOIN clause and with to the query using the Material relation
 *
 * @method     ChildUnitQuery leftJoinTechnic($relationAlias = null) Adds a LEFT JOIN clause to the query using the Technic relation
 * @method     ChildUnitQuery rightJoinTechnic($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Technic relation
 * @method     ChildUnitQuery innerJoinTechnic($relationAlias = null) Adds a INNER JOIN clause to the query using the Technic relation
 *
 * @method     ChildUnitQuery joinWithTechnic($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Technic relation
 *
 * @method     ChildUnitQuery leftJoinWithTechnic() Adds a LEFT JOIN clause and with to the query using the Technic relation
 * @method     ChildUnitQuery rightJoinWithTechnic() Adds a RIGHT JOIN clause and with to the query using the Technic relation
 * @method     ChildUnitQuery innerJoinWithTechnic() Adds a INNER JOIN clause and with to the query using the Technic relation
 *
 * @method     ChildUnitQuery leftJoinWork($relationAlias = null) Adds a LEFT JOIN clause to the query using the Work relation
 * @method     ChildUnitQuery rightJoinWork($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Work relation
 * @method     ChildUnitQuery innerJoinWork($relationAlias = null) Adds a INNER JOIN clause to the query using the Work relation
 *
 * @method     ChildUnitQuery joinWithWork($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Work relation
 *
 * @method     ChildUnitQuery leftJoinWithWork() Adds a LEFT JOIN clause and with to the query using the Work relation
 * @method     ChildUnitQuery rightJoinWithWork() Adds a RIGHT JOIN clause and with to the query using the Work relation
 * @method     ChildUnitQuery innerJoinWithWork() Adds a INNER JOIN clause and with to the query using the Work relation
 *
 * @method     ChildUnitQuery leftJoinUnitVersion($relationAlias = null) Adds a LEFT JOIN clause to the query using the UnitVersion relation
 * @method     ChildUnitQuery rightJoinUnitVersion($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UnitVersion relation
 * @method     ChildUnitQuery innerJoinUnitVersion($relationAlias = null) Adds a INNER JOIN clause to the query using the UnitVersion relation
 *
 * @method     ChildUnitQuery joinWithUnitVersion($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the UnitVersion relation
 *
 * @method     ChildUnitQuery leftJoinWithUnitVersion() Adds a LEFT JOIN clause and with to the query using the UnitVersion relation
 * @method     ChildUnitQuery rightJoinWithUnitVersion() Adds a RIGHT JOIN clause and with to the query using the UnitVersion relation
 * @method     ChildUnitQuery innerJoinWithUnitVersion() Adds a INNER JOIN clause and with to the query using the UnitVersion relation
 *
 * @method     \DB\MaterialQuery|\DB\TechnicQuery|\DB\WorkQuery|\DB\UnitVersionQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildUnit|null findOne(?ConnectionInterface $con = null) Return the first ChildUnit matching the query
 * @method     ChildUnit findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildUnit matching the query, or a new ChildUnit object populated from the query conditions when no match is found
 *
 * @method     ChildUnit|null findOneById(int $id) Return the first ChildUnit filtered by the id column
 * @method     ChildUnit|null findOneByName(string $name) Return the first ChildUnit filtered by the name column
 * @method     ChildUnit|null findOneByIsAvailable(boolean $is_available) Return the first ChildUnit filtered by the is_available column
 * @method     ChildUnit|null findOneByVersion(int $version) Return the first ChildUnit filtered by the version column
 * @method     ChildUnit|null findOneByVersionCreatedAt(string $version_created_at) Return the first ChildUnit filtered by the version_created_at column
 * @method     ChildUnit|null findOneByVersionCreatedBy(string $version_created_by) Return the first ChildUnit filtered by the version_created_by column *

 * @method     ChildUnit requirePk($key, ?ConnectionInterface $con = null) Return the ChildUnit by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUnit requireOne(?ConnectionInterface $con = null) Return the first ChildUnit matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUnit requireOneById(int $id) Return the first ChildUnit filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUnit requireOneByName(string $name) Return the first ChildUnit filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUnit requireOneByIsAvailable(boolean $is_available) Return the first ChildUnit filtered by the is_available column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUnit requireOneByVersion(int $version) Return the first ChildUnit filtered by the version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUnit requireOneByVersionCreatedAt(string $version_created_at) Return the first ChildUnit filtered by the version_created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUnit requireOneByVersionCreatedBy(string $version_created_by) Return the first ChildUnit filtered by the version_created_by column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUnit[]|Collection find(?ConnectionInterface $con = null) Return ChildUnit objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildUnit> find(?ConnectionInterface $con = null) Return ChildUnit objects based on current ModelCriteria
 * @method     ChildUnit[]|Collection findById(int $id) Return ChildUnit objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildUnit> findById(int $id) Return ChildUnit objects filtered by the id column
 * @method     ChildUnit[]|Collection findByName(string $name) Return ChildUnit objects filtered by the name column
 * @psalm-method Collection&\Traversable<ChildUnit> findByName(string $name) Return ChildUnit objects filtered by the name column
 * @method     ChildUnit[]|Collection findByIsAvailable(boolean $is_available) Return ChildUnit objects filtered by the is_available column
 * @psalm-method Collection&\Traversable<ChildUnit> findByIsAvailable(boolean $is_available) Return ChildUnit objects filtered by the is_available column
 * @method     ChildUnit[]|Collection findByVersion(int $version) Return ChildUnit objects filtered by the version column
 * @psalm-method Collection&\Traversable<ChildUnit> findByVersion(int $version) Return ChildUnit objects filtered by the version column
 * @method     ChildUnit[]|Collection findByVersionCreatedAt(string $version_created_at) Return ChildUnit objects filtered by the version_created_at column
 * @psalm-method Collection&\Traversable<ChildUnit> findByVersionCreatedAt(string $version_created_at) Return ChildUnit objects filtered by the version_created_at column
 * @method     ChildUnit[]|Collection findByVersionCreatedBy(string $version_created_by) Return ChildUnit objects filtered by the version_created_by column
 * @psalm-method Collection&\Traversable<ChildUnit> findByVersionCreatedBy(string $version_created_by) Return ChildUnit objects filtered by the version_created_by column
 * @method     ChildUnit[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildUnit> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class UnitQuery extends ModelCriteria
{

    // versionable behavior

    /**
     * Whether the versioning is enabled
     */
    static $isVersioningEnabled = true;
protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \DB\Base\UnitQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\DB\\Unit', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildUnitQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildUnitQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildUnitQuery) {
            return $criteria;
        }
        $query = new ChildUnitQuery();
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
     * @return ChildUnit|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UnitTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = UnitTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildUnit A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, is_available, version, version_created_at, version_created_by FROM unit WHERE id = :p0';
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
            /** @var ChildUnit $obj */
            $obj = new ChildUnit();
            $obj->hydrate($row);
            UnitTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildUnit|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(UnitTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(UnitTableMap::COL_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(UnitTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(UnitTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UnitTableMap::COL_ID, $id, $comparison);

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

        $this->addUsingAlias(UnitTableMap::COL_NAME, $name, $comparison);

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

        $this->addUsingAlias(UnitTableMap::COL_IS_AVAILABLE, $isAvailable, $comparison);

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
                $this->addUsingAlias(UnitTableMap::COL_VERSION, $version['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($version['max'])) {
                $this->addUsingAlias(UnitTableMap::COL_VERSION, $version['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UnitTableMap::COL_VERSION, $version, $comparison);

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
                $this->addUsingAlias(UnitTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($versionCreatedAt['max'])) {
                $this->addUsingAlias(UnitTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UnitTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt, $comparison);

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

        $this->addUsingAlias(UnitTableMap::COL_VERSION_CREATED_BY, $versionCreatedBy, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \DB\Material object
     *
     * @param \DB\Material|ObjectCollection $material the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMaterial($material, ?string $comparison = null)
    {
        if ($material instanceof \DB\Material) {
            $this
                ->addUsingAlias(UnitTableMap::COL_ID, $material->getUnitId(), $comparison);

            return $this;
        } elseif ($material instanceof ObjectCollection) {
            $this
                ->useMaterialQuery()
                ->filterByPrimaryKeys($material->getPrimaryKeys())
                ->endUse();

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
     * Filter the query by a related \DB\Technic object
     *
     * @param \DB\Technic|ObjectCollection $technic the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTechnic($technic, ?string $comparison = null)
    {
        if ($technic instanceof \DB\Technic) {
            $this
                ->addUsingAlias(UnitTableMap::COL_ID, $technic->getUnitId(), $comparison);

            return $this;
        } elseif ($technic instanceof ObjectCollection) {
            $this
                ->useTechnicQuery()
                ->filterByPrimaryKeys($technic->getPrimaryKeys())
                ->endUse();

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
     * Filter the query by a related \DB\Work object
     *
     * @param \DB\Work|ObjectCollection $work the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWork($work, ?string $comparison = null)
    {
        if ($work instanceof \DB\Work) {
            $this
                ->addUsingAlias(UnitTableMap::COL_ID, $work->getUnitId(), $comparison);

            return $this;
        } elseif ($work instanceof ObjectCollection) {
            $this
                ->useWorkQuery()
                ->filterByPrimaryKeys($work->getPrimaryKeys())
                ->endUse();

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
     * Filter the query by a related \DB\UnitVersion object
     *
     * @param \DB\UnitVersion|ObjectCollection $unitVersion the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUnitVersion($unitVersion, ?string $comparison = null)
    {
        if ($unitVersion instanceof \DB\UnitVersion) {
            $this
                ->addUsingAlias(UnitTableMap::COL_ID, $unitVersion->getId(), $comparison);

            return $this;
        } elseif ($unitVersion instanceof ObjectCollection) {
            $this
                ->useUnitVersionQuery()
                ->filterByPrimaryKeys($unitVersion->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByUnitVersion() only accepts arguments of type \DB\UnitVersion or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UnitVersion relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinUnitVersion(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UnitVersion');

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
            $this->addJoinObject($join, 'UnitVersion');
        }

        return $this;
    }

    /**
     * Use the UnitVersion relation UnitVersion object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\UnitVersionQuery A secondary query class using the current class as primary query
     */
    public function useUnitVersionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUnitVersion($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UnitVersion', '\DB\UnitVersionQuery');
    }

    /**
     * Use the UnitVersion relation UnitVersion object
     *
     * @param callable(\DB\UnitVersionQuery):\DB\UnitVersionQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withUnitVersionQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useUnitVersionQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to UnitVersion table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\UnitVersionQuery The inner query object of the EXISTS statement
     */
    public function useUnitVersionExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('UnitVersion', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to UnitVersion table for a NOT EXISTS query.
     *
     * @see useUnitVersionExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\UnitVersionQuery The inner query object of the NOT EXISTS statement
     */
    public function useUnitVersionNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('UnitVersion', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Exclude object from result
     *
     * @param ChildUnit $unit Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($unit = null)
    {
        if ($unit) {
            $this->addUsingAlias(UnitTableMap::COL_ID, $unit->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the unit table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UnitTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UnitTableMap::clearInstancePool();
            UnitTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(UnitTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(UnitTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            UnitTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            UnitTableMap::clearRelatedInstancePool();

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
