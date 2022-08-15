<?php

namespace DB\Base;

use \Exception;
use \PDO;
use DB\Groups as ChildGroups;
use DB\GroupsQuery as ChildGroupsQuery;
use DB\Map\GroupsTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'groups' table.
 *
 *
 *
 * @method     ChildGroupsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildGroupsQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildGroupsQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildGroupsQuery orderByIsAvailable($order = Criteria::ASC) Order by the is_available column
 * @method     ChildGroupsQuery orderBySubprojectId($order = Criteria::ASC) Order by the subproject_id column
 *
 * @method     ChildGroupsQuery groupById() Group by the id column
 * @method     ChildGroupsQuery groupByName() Group by the name column
 * @method     ChildGroupsQuery groupByStatus() Group by the status column
 * @method     ChildGroupsQuery groupByIsAvailable() Group by the is_available column
 * @method     ChildGroupsQuery groupBySubprojectId() Group by the subproject_id column
 *
 * @method     ChildGroupsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildGroupsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildGroupsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildGroupsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildGroupsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildGroupsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildGroupsQuery leftJoinSubproject($relationAlias = null) Adds a LEFT JOIN clause to the query using the Subproject relation
 * @method     ChildGroupsQuery rightJoinSubproject($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Subproject relation
 * @method     ChildGroupsQuery innerJoinSubproject($relationAlias = null) Adds a INNER JOIN clause to the query using the Subproject relation
 *
 * @method     ChildGroupsQuery joinWithSubproject($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Subproject relation
 *
 * @method     ChildGroupsQuery leftJoinWithSubproject() Adds a LEFT JOIN clause and with to the query using the Subproject relation
 * @method     ChildGroupsQuery rightJoinWithSubproject() Adds a RIGHT JOIN clause and with to the query using the Subproject relation
 * @method     ChildGroupsQuery innerJoinWithSubproject() Adds a INNER JOIN clause and with to the query using the Subproject relation
 *
 * @method     ChildGroupsQuery leftJoinHouse($relationAlias = null) Adds a LEFT JOIN clause to the query using the House relation
 * @method     ChildGroupsQuery rightJoinHouse($relationAlias = null) Adds a RIGHT JOIN clause to the query using the House relation
 * @method     ChildGroupsQuery innerJoinHouse($relationAlias = null) Adds a INNER JOIN clause to the query using the House relation
 *
 * @method     ChildGroupsQuery joinWithHouse($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the House relation
 *
 * @method     ChildGroupsQuery leftJoinWithHouse() Adds a LEFT JOIN clause and with to the query using the House relation
 * @method     ChildGroupsQuery rightJoinWithHouse() Adds a RIGHT JOIN clause and with to the query using the House relation
 * @method     ChildGroupsQuery innerJoinWithHouse() Adds a INNER JOIN clause and with to the query using the House relation
 *
 * @method     \DB\SubprojectQuery|\DB\HouseQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildGroups|null findOne(?ConnectionInterface $con = null) Return the first ChildGroups matching the query
 * @method     ChildGroups findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildGroups matching the query, or a new ChildGroups object populated from the query conditions when no match is found
 *
 * @method     ChildGroups|null findOneById(int $id) Return the first ChildGroups filtered by the id column
 * @method     ChildGroups|null findOneByName(string $name) Return the first ChildGroups filtered by the name column
 * @method     ChildGroups|null findOneByStatus(string $status) Return the first ChildGroups filtered by the status column
 * @method     ChildGroups|null findOneByIsAvailable(boolean $is_available) Return the first ChildGroups filtered by the is_available column
 * @method     ChildGroups|null findOneBySubprojectId(int $subproject_id) Return the first ChildGroups filtered by the subproject_id column *

 * @method     ChildGroups requirePk($key, ?ConnectionInterface $con = null) Return the ChildGroups by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroups requireOne(?ConnectionInterface $con = null) Return the first ChildGroups matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildGroups requireOneById(int $id) Return the first ChildGroups filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroups requireOneByName(string $name) Return the first ChildGroups filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroups requireOneByStatus(string $status) Return the first ChildGroups filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroups requireOneByIsAvailable(boolean $is_available) Return the first ChildGroups filtered by the is_available column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGroups requireOneBySubprojectId(int $subproject_id) Return the first ChildGroups filtered by the subproject_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildGroups[]|Collection find(?ConnectionInterface $con = null) Return ChildGroups objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildGroups> find(?ConnectionInterface $con = null) Return ChildGroups objects based on current ModelCriteria
 * @method     ChildGroups[]|Collection findById(int $id) Return ChildGroups objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildGroups> findById(int $id) Return ChildGroups objects filtered by the id column
 * @method     ChildGroups[]|Collection findByName(string $name) Return ChildGroups objects filtered by the name column
 * @psalm-method Collection&\Traversable<ChildGroups> findByName(string $name) Return ChildGroups objects filtered by the name column
 * @method     ChildGroups[]|Collection findByStatus(string $status) Return ChildGroups objects filtered by the status column
 * @psalm-method Collection&\Traversable<ChildGroups> findByStatus(string $status) Return ChildGroups objects filtered by the status column
 * @method     ChildGroups[]|Collection findByIsAvailable(boolean $is_available) Return ChildGroups objects filtered by the is_available column
 * @psalm-method Collection&\Traversable<ChildGroups> findByIsAvailable(boolean $is_available) Return ChildGroups objects filtered by the is_available column
 * @method     ChildGroups[]|Collection findBySubprojectId(int $subproject_id) Return ChildGroups objects filtered by the subproject_id column
 * @psalm-method Collection&\Traversable<ChildGroups> findBySubprojectId(int $subproject_id) Return ChildGroups objects filtered by the subproject_id column
 * @method     ChildGroups[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildGroups> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class GroupsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \DB\Base\GroupsQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\DB\\Groups', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildGroupsQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildGroupsQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildGroupsQuery) {
            return $criteria;
        }
        $query = new ChildGroupsQuery();
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
     * @return ChildGroups|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(GroupsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = GroupsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildGroups A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, status, is_available, subproject_id FROM groups WHERE id = :p0';
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
            /** @var ChildGroups $obj */
            $obj = new ChildGroups();
            $obj->hydrate($row);
            GroupsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildGroups|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(GroupsTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(GroupsTableMap::COL_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(GroupsTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(GroupsTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GroupsTableMap::COL_ID, $id, $comparison);

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

        $this->addUsingAlias(GroupsTableMap::COL_NAME, $name, $comparison);

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

        $this->addUsingAlias(GroupsTableMap::COL_STATUS, $status, $comparison);

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

        $this->addUsingAlias(GroupsTableMap::COL_IS_AVAILABLE, $isAvailable, $comparison);

        return $this;
    }

    /**
     * Filter the query on the subproject_id column
     *
     * Example usage:
     * <code>
     * $query->filterBySubprojectId(1234); // WHERE subproject_id = 1234
     * $query->filterBySubprojectId(array(12, 34)); // WHERE subproject_id IN (12, 34)
     * $query->filterBySubprojectId(array('min' => 12)); // WHERE subproject_id > 12
     * </code>
     *
     * @see       filterBySubproject()
     *
     * @param mixed $subprojectId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySubprojectId($subprojectId = null, ?string $comparison = null)
    {
        if (is_array($subprojectId)) {
            $useMinMax = false;
            if (isset($subprojectId['min'])) {
                $this->addUsingAlias(GroupsTableMap::COL_SUBPROJECT_ID, $subprojectId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($subprojectId['max'])) {
                $this->addUsingAlias(GroupsTableMap::COL_SUBPROJECT_ID, $subprojectId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GroupsTableMap::COL_SUBPROJECT_ID, $subprojectId, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \DB\Subproject object
     *
     * @param \DB\Subproject|ObjectCollection $subproject The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySubproject($subproject, ?string $comparison = null)
    {
        if ($subproject instanceof \DB\Subproject) {
            return $this
                ->addUsingAlias(GroupsTableMap::COL_SUBPROJECT_ID, $subproject->getId(), $comparison);
        } elseif ($subproject instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(GroupsTableMap::COL_SUBPROJECT_ID, $subproject->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterBySubproject() only accepts arguments of type \DB\Subproject or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Subproject relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSubproject(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Subproject');

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
            $this->addJoinObject($join, 'Subproject');
        }

        return $this;
    }

    /**
     * Use the Subproject relation Subproject object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\SubprojectQuery A secondary query class using the current class as primary query
     */
    public function useSubprojectQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSubproject($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Subproject', '\DB\SubprojectQuery');
    }

    /**
     * Use the Subproject relation Subproject object
     *
     * @param callable(\DB\SubprojectQuery):\DB\SubprojectQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSubprojectQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSubprojectQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to Subproject table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\SubprojectQuery The inner query object of the EXISTS statement
     */
    public function useSubprojectExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('Subproject', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to Subproject table for a NOT EXISTS query.
     *
     * @see useSubprojectExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\SubprojectQuery The inner query object of the NOT EXISTS statement
     */
    public function useSubprojectNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('Subproject', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \DB\House object
     *
     * @param \DB\House|ObjectCollection $house the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByHouse($house, ?string $comparison = null)
    {
        if ($house instanceof \DB\House) {
            $this
                ->addUsingAlias(GroupsTableMap::COL_ID, $house->getGroupId(), $comparison);

            return $this;
        } elseif ($house instanceof ObjectCollection) {
            $this
                ->useHouseQuery()
                ->filterByPrimaryKeys($house->getPrimaryKeys())
                ->endUse();

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
    public function joinHouse(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
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
    public function useHouseQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
        ?string $joinType = Criteria::INNER_JOIN
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
     * Exclude object from result
     *
     * @param ChildGroups $groups Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($groups = null)
    {
        if ($groups) {
            $this->addUsingAlias(GroupsTableMap::COL_ID, $groups->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the groups table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(GroupsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            GroupsTableMap::clearInstancePool();
            GroupsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(GroupsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(GroupsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            GroupsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            GroupsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
