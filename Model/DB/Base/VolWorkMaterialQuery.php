<?php

namespace DB\Base;

use \Exception;
use \PDO;
use DB\VolWorkMaterial as ChildVolWorkMaterial;
use DB\VolWorkMaterialQuery as ChildVolWorkMaterialQuery;
use DB\Map\VolWorkMaterialTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'vol_work_material' table.
 *
 *
 *
 * @method     ChildVolWorkMaterialQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildVolWorkMaterialQuery orderByAmount($order = Criteria::ASC) Order by the amount column
 * @method     ChildVolWorkMaterialQuery orderByWorkId($order = Criteria::ASC) Order by the work_id column
 * @method     ChildVolWorkMaterialQuery orderByMaterialId($order = Criteria::ASC) Order by the material_id column
 *
 * @method     ChildVolWorkMaterialQuery groupById() Group by the id column
 * @method     ChildVolWorkMaterialQuery groupByAmount() Group by the amount column
 * @method     ChildVolWorkMaterialQuery groupByWorkId() Group by the work_id column
 * @method     ChildVolWorkMaterialQuery groupByMaterialId() Group by the material_id column
 *
 * @method     ChildVolWorkMaterialQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildVolWorkMaterialQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildVolWorkMaterialQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildVolWorkMaterialQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildVolWorkMaterialQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildVolWorkMaterialQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildVolWorkMaterialQuery leftJoinVolWork($relationAlias = null) Adds a LEFT JOIN clause to the query using the VolWork relation
 * @method     ChildVolWorkMaterialQuery rightJoinVolWork($relationAlias = null) Adds a RIGHT JOIN clause to the query using the VolWork relation
 * @method     ChildVolWorkMaterialQuery innerJoinVolWork($relationAlias = null) Adds a INNER JOIN clause to the query using the VolWork relation
 *
 * @method     ChildVolWorkMaterialQuery joinWithVolWork($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the VolWork relation
 *
 * @method     ChildVolWorkMaterialQuery leftJoinWithVolWork() Adds a LEFT JOIN clause and with to the query using the VolWork relation
 * @method     ChildVolWorkMaterialQuery rightJoinWithVolWork() Adds a RIGHT JOIN clause and with to the query using the VolWork relation
 * @method     ChildVolWorkMaterialQuery innerJoinWithVolWork() Adds a INNER JOIN clause and with to the query using the VolWork relation
 *
 * @method     ChildVolWorkMaterialQuery leftJoinVolMaterial($relationAlias = null) Adds a LEFT JOIN clause to the query using the VolMaterial relation
 * @method     ChildVolWorkMaterialQuery rightJoinVolMaterial($relationAlias = null) Adds a RIGHT JOIN clause to the query using the VolMaterial relation
 * @method     ChildVolWorkMaterialQuery innerJoinVolMaterial($relationAlias = null) Adds a INNER JOIN clause to the query using the VolMaterial relation
 *
 * @method     ChildVolWorkMaterialQuery joinWithVolMaterial($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the VolMaterial relation
 *
 * @method     ChildVolWorkMaterialQuery leftJoinWithVolMaterial() Adds a LEFT JOIN clause and with to the query using the VolMaterial relation
 * @method     ChildVolWorkMaterialQuery rightJoinWithVolMaterial() Adds a RIGHT JOIN clause and with to the query using the VolMaterial relation
 * @method     ChildVolWorkMaterialQuery innerJoinWithVolMaterial() Adds a INNER JOIN clause and with to the query using the VolMaterial relation
 *
 * @method     \DB\VolWorkQuery|\DB\VolMaterialQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildVolWorkMaterial|null findOne(?ConnectionInterface $con = null) Return the first ChildVolWorkMaterial matching the query
 * @method     ChildVolWorkMaterial findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildVolWorkMaterial matching the query, or a new ChildVolWorkMaterial object populated from the query conditions when no match is found
 *
 * @method     ChildVolWorkMaterial|null findOneById(int $id) Return the first ChildVolWorkMaterial filtered by the id column
 * @method     ChildVolWorkMaterial|null findOneByAmount(string $amount) Return the first ChildVolWorkMaterial filtered by the amount column
 * @method     ChildVolWorkMaterial|null findOneByWorkId(int $work_id) Return the first ChildVolWorkMaterial filtered by the work_id column
 * @method     ChildVolWorkMaterial|null findOneByMaterialId(int $material_id) Return the first ChildVolWorkMaterial filtered by the material_id column *

 * @method     ChildVolWorkMaterial requirePk($key, ?ConnectionInterface $con = null) Return the ChildVolWorkMaterial by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolWorkMaterial requireOne(?ConnectionInterface $con = null) Return the first ChildVolWorkMaterial matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildVolWorkMaterial requireOneById(int $id) Return the first ChildVolWorkMaterial filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolWorkMaterial requireOneByAmount(string $amount) Return the first ChildVolWorkMaterial filtered by the amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolWorkMaterial requireOneByWorkId(int $work_id) Return the first ChildVolWorkMaterial filtered by the work_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVolWorkMaterial requireOneByMaterialId(int $material_id) Return the first ChildVolWorkMaterial filtered by the material_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildVolWorkMaterial[]|Collection find(?ConnectionInterface $con = null) Return ChildVolWorkMaterial objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildVolWorkMaterial> find(?ConnectionInterface $con = null) Return ChildVolWorkMaterial objects based on current ModelCriteria
 * @method     ChildVolWorkMaterial[]|Collection findById(int $id) Return ChildVolWorkMaterial objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildVolWorkMaterial> findById(int $id) Return ChildVolWorkMaterial objects filtered by the id column
 * @method     ChildVolWorkMaterial[]|Collection findByAmount(string $amount) Return ChildVolWorkMaterial objects filtered by the amount column
 * @psalm-method Collection&\Traversable<ChildVolWorkMaterial> findByAmount(string $amount) Return ChildVolWorkMaterial objects filtered by the amount column
 * @method     ChildVolWorkMaterial[]|Collection findByWorkId(int $work_id) Return ChildVolWorkMaterial objects filtered by the work_id column
 * @psalm-method Collection&\Traversable<ChildVolWorkMaterial> findByWorkId(int $work_id) Return ChildVolWorkMaterial objects filtered by the work_id column
 * @method     ChildVolWorkMaterial[]|Collection findByMaterialId(int $material_id) Return ChildVolWorkMaterial objects filtered by the material_id column
 * @psalm-method Collection&\Traversable<ChildVolWorkMaterial> findByMaterialId(int $material_id) Return ChildVolWorkMaterial objects filtered by the material_id column
 * @method     ChildVolWorkMaterial[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildVolWorkMaterial> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class VolWorkMaterialQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \DB\Base\VolWorkMaterialQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\DB\\VolWorkMaterial', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildVolWorkMaterialQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildVolWorkMaterialQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildVolWorkMaterialQuery) {
            return $criteria;
        }
        $query = new ChildVolWorkMaterialQuery();
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
     * @return ChildVolWorkMaterial|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(VolWorkMaterialTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = VolWorkMaterialTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildVolWorkMaterial A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, amount, work_id, material_id FROM vol_work_material WHERE id = :p0';
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
            /** @var ChildVolWorkMaterial $obj */
            $obj = new ChildVolWorkMaterial();
            $obj->hydrate($row);
            VolWorkMaterialTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildVolWorkMaterial|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(VolWorkMaterialTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(VolWorkMaterialTableMap::COL_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(VolWorkMaterialTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(VolWorkMaterialTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(VolWorkMaterialTableMap::COL_ID, $id, $comparison);

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
                $this->addUsingAlias(VolWorkMaterialTableMap::COL_AMOUNT, $amount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($amount['max'])) {
                $this->addUsingAlias(VolWorkMaterialTableMap::COL_AMOUNT, $amount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(VolWorkMaterialTableMap::COL_AMOUNT, $amount, $comparison);

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
     * @see       filterByVolWork()
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
                $this->addUsingAlias(VolWorkMaterialTableMap::COL_WORK_ID, $workId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($workId['max'])) {
                $this->addUsingAlias(VolWorkMaterialTableMap::COL_WORK_ID, $workId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(VolWorkMaterialTableMap::COL_WORK_ID, $workId, $comparison);

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
                $this->addUsingAlias(VolWorkMaterialTableMap::COL_MATERIAL_ID, $materialId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($materialId['max'])) {
                $this->addUsingAlias(VolWorkMaterialTableMap::COL_MATERIAL_ID, $materialId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(VolWorkMaterialTableMap::COL_MATERIAL_ID, $materialId, $comparison);

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
                ->addUsingAlias(VolWorkMaterialTableMap::COL_WORK_ID, $volWork->getId(), $comparison);
        } elseif ($volWork instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(VolWorkMaterialTableMap::COL_WORK_ID, $volWork->toKeyValue('PrimaryKey', 'Id'), $comparison);

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
                ->addUsingAlias(VolWorkMaterialTableMap::COL_MATERIAL_ID, $volMaterial->getId(), $comparison);
        } elseif ($volMaterial instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(VolWorkMaterialTableMap::COL_MATERIAL_ID, $volMaterial->toKeyValue('PrimaryKey', 'Id'), $comparison);

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
     * Exclude object from result
     *
     * @param ChildVolWorkMaterial $volWorkMaterial Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($volWorkMaterial = null)
    {
        if ($volWorkMaterial) {
            $this->addUsingAlias(VolWorkMaterialTableMap::COL_ID, $volWorkMaterial->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the vol_work_material table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(VolWorkMaterialTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            VolWorkMaterialTableMap::clearInstancePool();
            VolWorkMaterialTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(VolWorkMaterialTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(VolWorkMaterialTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            VolWorkMaterialTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            VolWorkMaterialTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
