<?php

namespace DB\Base;

use \Exception;
use \PDO;
use DB\Stage as ChildStage;
use DB\StageQuery as ChildStageQuery;
use DB\Map\StageTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'stage' table.
 *
 *
 *
 * @method     ChildStageQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildStageQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildStageQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildStageQuery orderByIsAvailable($order = Criteria::ASC) Order by the is_available column
 * @method     ChildStageQuery orderByHouseId($order = Criteria::ASC) Order by the house_id column
 *
 * @method     ChildStageQuery groupById() Group by the id column
 * @method     ChildStageQuery groupByName() Group by the name column
 * @method     ChildStageQuery groupByStatus() Group by the status column
 * @method     ChildStageQuery groupByIsAvailable() Group by the is_available column
 * @method     ChildStageQuery groupByHouseId() Group by the house_id column
 *
 * @method     ChildStageQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildStageQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildStageQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildStageQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildStageQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildStageQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildStageQuery leftJoinHouse($relationAlias = null) Adds a LEFT JOIN clause to the query using the House relation
 * @method     ChildStageQuery rightJoinHouse($relationAlias = null) Adds a RIGHT JOIN clause to the query using the House relation
 * @method     ChildStageQuery innerJoinHouse($relationAlias = null) Adds a INNER JOIN clause to the query using the House relation
 *
 * @method     ChildStageQuery joinWithHouse($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the House relation
 *
 * @method     ChildStageQuery leftJoinWithHouse() Adds a LEFT JOIN clause and with to the query using the House relation
 * @method     ChildStageQuery rightJoinWithHouse() Adds a RIGHT JOIN clause and with to the query using the House relation
 * @method     ChildStageQuery innerJoinWithHouse() Adds a INNER JOIN clause and with to the query using the House relation
 *
 * @method     ChildStageQuery leftJoinStageMaterial($relationAlias = null) Adds a LEFT JOIN clause to the query using the StageMaterial relation
 * @method     ChildStageQuery rightJoinStageMaterial($relationAlias = null) Adds a RIGHT JOIN clause to the query using the StageMaterial relation
 * @method     ChildStageQuery innerJoinStageMaterial($relationAlias = null) Adds a INNER JOIN clause to the query using the StageMaterial relation
 *
 * @method     ChildStageQuery joinWithStageMaterial($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the StageMaterial relation
 *
 * @method     ChildStageQuery leftJoinWithStageMaterial() Adds a LEFT JOIN clause and with to the query using the StageMaterial relation
 * @method     ChildStageQuery rightJoinWithStageMaterial() Adds a RIGHT JOIN clause and with to the query using the StageMaterial relation
 * @method     ChildStageQuery innerJoinWithStageMaterial() Adds a INNER JOIN clause and with to the query using the StageMaterial relation
 *
 * @method     ChildStageQuery leftJoinStageTechnic($relationAlias = null) Adds a LEFT JOIN clause to the query using the StageTechnic relation
 * @method     ChildStageQuery rightJoinStageTechnic($relationAlias = null) Adds a RIGHT JOIN clause to the query using the StageTechnic relation
 * @method     ChildStageQuery innerJoinStageTechnic($relationAlias = null) Adds a INNER JOIN clause to the query using the StageTechnic relation
 *
 * @method     ChildStageQuery joinWithStageTechnic($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the StageTechnic relation
 *
 * @method     ChildStageQuery leftJoinWithStageTechnic() Adds a LEFT JOIN clause and with to the query using the StageTechnic relation
 * @method     ChildStageQuery rightJoinWithStageTechnic() Adds a RIGHT JOIN clause and with to the query using the StageTechnic relation
 * @method     ChildStageQuery innerJoinWithStageTechnic() Adds a INNER JOIN clause and with to the query using the StageTechnic relation
 *
 * @method     ChildStageQuery leftJoinStageWork($relationAlias = null) Adds a LEFT JOIN clause to the query using the StageWork relation
 * @method     ChildStageQuery rightJoinStageWork($relationAlias = null) Adds a RIGHT JOIN clause to the query using the StageWork relation
 * @method     ChildStageQuery innerJoinStageWork($relationAlias = null) Adds a INNER JOIN clause to the query using the StageWork relation
 *
 * @method     ChildStageQuery joinWithStageWork($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the StageWork relation
 *
 * @method     ChildStageQuery leftJoinWithStageWork() Adds a LEFT JOIN clause and with to the query using the StageWork relation
 * @method     ChildStageQuery rightJoinWithStageWork() Adds a RIGHT JOIN clause and with to the query using the StageWork relation
 * @method     ChildStageQuery innerJoinWithStageWork() Adds a INNER JOIN clause and with to the query using the StageWork relation
 *
 * @method     \DB\HouseQuery|\DB\StageMaterialQuery|\DB\StageTechnicQuery|\DB\StageWorkQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildStage|null findOne(?ConnectionInterface $con = null) Return the first ChildStage matching the query
 * @method     ChildStage findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildStage matching the query, or a new ChildStage object populated from the query conditions when no match is found
 *
 * @method     ChildStage|null findOneById(int $id) Return the first ChildStage filtered by the id column
 * @method     ChildStage|null findOneByName(string $name) Return the first ChildStage filtered by the name column
 * @method     ChildStage|null findOneByStatus(string $status) Return the first ChildStage filtered by the status column
 * @method     ChildStage|null findOneByIsAvailable(boolean $is_available) Return the first ChildStage filtered by the is_available column
 * @method     ChildStage|null findOneByHouseId(int $house_id) Return the first ChildStage filtered by the house_id column *

 * @method     ChildStage requirePk($key, ?ConnectionInterface $con = null) Return the ChildStage by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStage requireOne(?ConnectionInterface $con = null) Return the first ChildStage matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildStage requireOneById(int $id) Return the first ChildStage filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStage requireOneByName(string $name) Return the first ChildStage filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStage requireOneByStatus(string $status) Return the first ChildStage filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStage requireOneByIsAvailable(boolean $is_available) Return the first ChildStage filtered by the is_available column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStage requireOneByHouseId(int $house_id) Return the first ChildStage filtered by the house_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildStage[]|Collection find(?ConnectionInterface $con = null) Return ChildStage objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildStage> find(?ConnectionInterface $con = null) Return ChildStage objects based on current ModelCriteria
 * @method     ChildStage[]|Collection findById(int $id) Return ChildStage objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildStage> findById(int $id) Return ChildStage objects filtered by the id column
 * @method     ChildStage[]|Collection findByName(string $name) Return ChildStage objects filtered by the name column
 * @psalm-method Collection&\Traversable<ChildStage> findByName(string $name) Return ChildStage objects filtered by the name column
 * @method     ChildStage[]|Collection findByStatus(string $status) Return ChildStage objects filtered by the status column
 * @psalm-method Collection&\Traversable<ChildStage> findByStatus(string $status) Return ChildStage objects filtered by the status column
 * @method     ChildStage[]|Collection findByIsAvailable(boolean $is_available) Return ChildStage objects filtered by the is_available column
 * @psalm-method Collection&\Traversable<ChildStage> findByIsAvailable(boolean $is_available) Return ChildStage objects filtered by the is_available column
 * @method     ChildStage[]|Collection findByHouseId(int $house_id) Return ChildStage objects filtered by the house_id column
 * @psalm-method Collection&\Traversable<ChildStage> findByHouseId(int $house_id) Return ChildStage objects filtered by the house_id column
 * @method     ChildStage[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildStage> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class StageQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \DB\Base\StageQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\DB\\Stage', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildStageQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildStageQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildStageQuery) {
            return $criteria;
        }
        $query = new ChildStageQuery();
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
     * @return ChildStage|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(StageTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = StageTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildStage A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, status, is_available, house_id FROM stage WHERE id = :p0';
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
            /** @var ChildStage $obj */
            $obj = new ChildStage();
            $obj->hydrate($row);
            StageTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildStage|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(StageTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(StageTableMap::COL_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(StageTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(StageTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StageTableMap::COL_ID, $id, $comparison);

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

        $this->addUsingAlias(StageTableMap::COL_NAME, $name, $comparison);

        return $this;
    }

    /**
     * Filter the query on the status column
     *
     * Example usage:
     * <code>
     * $query->filterByStatus('fooValue');   // WHERE status = 'fooValue'
     * $query->filterByStatus('%fooValue%', Criteria::LIKE); // WHERE status LIKE '%fooValue%'
     * $query->filterByStatus(['foo', 'bar']); // WHERE status IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $status The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStatus($status = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($status)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StageTableMap::COL_STATUS, $status, $comparison);

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

        $this->addUsingAlias(StageTableMap::COL_IS_AVAILABLE, $isAvailable, $comparison);

        return $this;
    }

    /**
     * Filter the query on the house_id column
     *
     * Example usage:
     * <code>
     * $query->filterByHouseId(1234); // WHERE house_id = 1234
     * $query->filterByHouseId(array(12, 34)); // WHERE house_id IN (12, 34)
     * $query->filterByHouseId(array('min' => 12)); // WHERE house_id > 12
     * </code>
     *
     * @see       filterByHouse()
     *
     * @param mixed $houseId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByHouseId($houseId = null, ?string $comparison = null)
    {
        if (is_array($houseId)) {
            $useMinMax = false;
            if (isset($houseId['min'])) {
                $this->addUsingAlias(StageTableMap::COL_HOUSE_ID, $houseId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($houseId['max'])) {
                $this->addUsingAlias(StageTableMap::COL_HOUSE_ID, $houseId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StageTableMap::COL_HOUSE_ID, $houseId, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \DB\House object
     *
     * @param \DB\House|ObjectCollection $house The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByHouse($house, ?string $comparison = null)
    {
        if ($house instanceof \DB\House) {
            return $this
                ->addUsingAlias(StageTableMap::COL_HOUSE_ID, $house->getId(), $comparison);
        } elseif ($house instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(StageTableMap::COL_HOUSE_ID, $house->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByHouse() only accepts arguments of type \DB\House or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the House relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinHouse(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('House');

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
            $this->addJoinObject($join, 'House');
        }

        return $this;
    }

    /**
     * Use the House relation House object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\HouseQuery A secondary query class using the current class as primary query
     */
    public function useHouseQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinHouse($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'House', '\DB\HouseQuery');
    }

    /**
     * Use the House relation House object
     *
     * @param callable(\DB\HouseQuery):\DB\HouseQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withHouseQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useHouseQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to House table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\HouseQuery The inner query object of the EXISTS statement
     */
    public function useHouseExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('House', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to House table for a NOT EXISTS query.
     *
     * @see useHouseExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\HouseQuery The inner query object of the NOT EXISTS statement
     */
    public function useHouseNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('House', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \DB\StageMaterial object
     *
     * @param \DB\StageMaterial|ObjectCollection $stageMaterial the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStageMaterial($stageMaterial, ?string $comparison = null)
    {
        if ($stageMaterial instanceof \DB\StageMaterial) {
            $this
                ->addUsingAlias(StageTableMap::COL_ID, $stageMaterial->getStageId(), $comparison);

            return $this;
        } elseif ($stageMaterial instanceof ObjectCollection) {
            $this
                ->useStageMaterialQuery()
                ->filterByPrimaryKeys($stageMaterial->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByStageMaterial() only accepts arguments of type \DB\StageMaterial or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the StageMaterial relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinStageMaterial(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('StageMaterial');

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
            $this->addJoinObject($join, 'StageMaterial');
        }

        return $this;
    }

    /**
     * Use the StageMaterial relation StageMaterial object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\StageMaterialQuery A secondary query class using the current class as primary query
     */
    public function useStageMaterialQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinStageMaterial($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'StageMaterial', '\DB\StageMaterialQuery');
    }

    /**
     * Use the StageMaterial relation StageMaterial object
     *
     * @param callable(\DB\StageMaterialQuery):\DB\StageMaterialQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withStageMaterialQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useStageMaterialQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to StageMaterial table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\StageMaterialQuery The inner query object of the EXISTS statement
     */
    public function useStageMaterialExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('StageMaterial', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to StageMaterial table for a NOT EXISTS query.
     *
     * @see useStageMaterialExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\StageMaterialQuery The inner query object of the NOT EXISTS statement
     */
    public function useStageMaterialNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('StageMaterial', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \DB\StageTechnic object
     *
     * @param \DB\StageTechnic|ObjectCollection $stageTechnic the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStageTechnic($stageTechnic, ?string $comparison = null)
    {
        if ($stageTechnic instanceof \DB\StageTechnic) {
            $this
                ->addUsingAlias(StageTableMap::COL_ID, $stageTechnic->getStageId(), $comparison);

            return $this;
        } elseif ($stageTechnic instanceof ObjectCollection) {
            $this
                ->useStageTechnicQuery()
                ->filterByPrimaryKeys($stageTechnic->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByStageTechnic() only accepts arguments of type \DB\StageTechnic or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the StageTechnic relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinStageTechnic(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('StageTechnic');

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
            $this->addJoinObject($join, 'StageTechnic');
        }

        return $this;
    }

    /**
     * Use the StageTechnic relation StageTechnic object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\StageTechnicQuery A secondary query class using the current class as primary query
     */
    public function useStageTechnicQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinStageTechnic($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'StageTechnic', '\DB\StageTechnicQuery');
    }

    /**
     * Use the StageTechnic relation StageTechnic object
     *
     * @param callable(\DB\StageTechnicQuery):\DB\StageTechnicQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withStageTechnicQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useStageTechnicQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to StageTechnic table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\StageTechnicQuery The inner query object of the EXISTS statement
     */
    public function useStageTechnicExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('StageTechnic', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to StageTechnic table for a NOT EXISTS query.
     *
     * @see useStageTechnicExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\StageTechnicQuery The inner query object of the NOT EXISTS statement
     */
    public function useStageTechnicNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('StageTechnic', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \DB\StageWork object
     *
     * @param \DB\StageWork|ObjectCollection $stageWork the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStageWork($stageWork, ?string $comparison = null)
    {
        if ($stageWork instanceof \DB\StageWork) {
            $this
                ->addUsingAlias(StageTableMap::COL_ID, $stageWork->getStageId(), $comparison);

            return $this;
        } elseif ($stageWork instanceof ObjectCollection) {
            $this
                ->useStageWorkQuery()
                ->filterByPrimaryKeys($stageWork->getPrimaryKeys())
                ->endUse();

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
     * @param ChildStage $stage Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($stage = null)
    {
        if ($stage) {
            $this->addUsingAlias(StageTableMap::COL_ID, $stage->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the stage table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(StageTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            StageTableMap::clearInstancePool();
            StageTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(StageTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(StageTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            StageTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            StageTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
