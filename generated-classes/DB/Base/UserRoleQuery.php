<?php

namespace DB\Base;

use \Exception;
use \PDO;
use DB\UserRole as ChildUserRole;
use DB\UserRoleQuery as ChildUserRoleQuery;
use DB\Map\UserRoleTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'user_role' table.
 *
 *
 *
 * @method     ChildUserRoleQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildUserRoleQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildUserRoleQuery orderByObjectViewer($order = Criteria::ASC) Order by the object_viewer column
 * @method     ChildUserRoleQuery orderByManageObjects($order = Criteria::ASC) Order by the manage_objects column
 * @method     ChildUserRoleQuery orderByManageVolumes($order = Criteria::ASC) Order by the manage_volumes column
 * @method     ChildUserRoleQuery orderByManageHistory($order = Criteria::ASC) Order by the manage_history column
 * @method     ChildUserRoleQuery orderByManageUsers($order = Criteria::ASC) Order by the manage_users column
 *
 * @method     ChildUserRoleQuery groupById() Group by the id column
 * @method     ChildUserRoleQuery groupByName() Group by the name column
 * @method     ChildUserRoleQuery groupByObjectViewer() Group by the object_viewer column
 * @method     ChildUserRoleQuery groupByManageObjects() Group by the manage_objects column
 * @method     ChildUserRoleQuery groupByManageVolumes() Group by the manage_volumes column
 * @method     ChildUserRoleQuery groupByManageHistory() Group by the manage_history column
 * @method     ChildUserRoleQuery groupByManageUsers() Group by the manage_users column
 *
 * @method     ChildUserRoleQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUserRoleQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUserRoleQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUserRoleQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildUserRoleQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildUserRoleQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildUserRoleQuery leftJoinUsers($relationAlias = null) Adds a LEFT JOIN clause to the query using the Users relation
 * @method     ChildUserRoleQuery rightJoinUsers($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Users relation
 * @method     ChildUserRoleQuery innerJoinUsers($relationAlias = null) Adds a INNER JOIN clause to the query using the Users relation
 *
 * @method     ChildUserRoleQuery joinWithUsers($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Users relation
 *
 * @method     ChildUserRoleQuery leftJoinWithUsers() Adds a LEFT JOIN clause and with to the query using the Users relation
 * @method     ChildUserRoleQuery rightJoinWithUsers() Adds a RIGHT JOIN clause and with to the query using the Users relation
 * @method     ChildUserRoleQuery innerJoinWithUsers() Adds a INNER JOIN clause and with to the query using the Users relation
 *
 * @method     \DB\UsersQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildUserRole|null findOne(?ConnectionInterface $con = null) Return the first ChildUserRole matching the query
 * @method     ChildUserRole findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildUserRole matching the query, or a new ChildUserRole object populated from the query conditions when no match is found
 *
 * @method     ChildUserRole|null findOneById(int $id) Return the first ChildUserRole filtered by the id column
 * @method     ChildUserRole|null findOneByName(string $name) Return the first ChildUserRole filtered by the name column
 * @method     ChildUserRole|null findOneByObjectViewer(boolean $object_viewer) Return the first ChildUserRole filtered by the object_viewer column
 * @method     ChildUserRole|null findOneByManageObjects(boolean $manage_objects) Return the first ChildUserRole filtered by the manage_objects column
 * @method     ChildUserRole|null findOneByManageVolumes(boolean $manage_volumes) Return the first ChildUserRole filtered by the manage_volumes column
 * @method     ChildUserRole|null findOneByManageHistory(boolean $manage_history) Return the first ChildUserRole filtered by the manage_history column
 * @method     ChildUserRole|null findOneByManageUsers(boolean $manage_users) Return the first ChildUserRole filtered by the manage_users column *

 * @method     ChildUserRole requirePk($key, ?ConnectionInterface $con = null) Return the ChildUserRole by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserRole requireOne(?ConnectionInterface $con = null) Return the first ChildUserRole matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUserRole requireOneById(int $id) Return the first ChildUserRole filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserRole requireOneByName(string $name) Return the first ChildUserRole filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserRole requireOneByObjectViewer(boolean $object_viewer) Return the first ChildUserRole filtered by the object_viewer column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserRole requireOneByManageObjects(boolean $manage_objects) Return the first ChildUserRole filtered by the manage_objects column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserRole requireOneByManageVolumes(boolean $manage_volumes) Return the first ChildUserRole filtered by the manage_volumes column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserRole requireOneByManageHistory(boolean $manage_history) Return the first ChildUserRole filtered by the manage_history column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserRole requireOneByManageUsers(boolean $manage_users) Return the first ChildUserRole filtered by the manage_users column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUserRole[]|Collection find(?ConnectionInterface $con = null) Return ChildUserRole objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildUserRole> find(?ConnectionInterface $con = null) Return ChildUserRole objects based on current ModelCriteria
 * @method     ChildUserRole[]|Collection findById(int $id) Return ChildUserRole objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildUserRole> findById(int $id) Return ChildUserRole objects filtered by the id column
 * @method     ChildUserRole[]|Collection findByName(string $name) Return ChildUserRole objects filtered by the name column
 * @psalm-method Collection&\Traversable<ChildUserRole> findByName(string $name) Return ChildUserRole objects filtered by the name column
 * @method     ChildUserRole[]|Collection findByObjectViewer(boolean $object_viewer) Return ChildUserRole objects filtered by the object_viewer column
 * @psalm-method Collection&\Traversable<ChildUserRole> findByObjectViewer(boolean $object_viewer) Return ChildUserRole objects filtered by the object_viewer column
 * @method     ChildUserRole[]|Collection findByManageObjects(boolean $manage_objects) Return ChildUserRole objects filtered by the manage_objects column
 * @psalm-method Collection&\Traversable<ChildUserRole> findByManageObjects(boolean $manage_objects) Return ChildUserRole objects filtered by the manage_objects column
 * @method     ChildUserRole[]|Collection findByManageVolumes(boolean $manage_volumes) Return ChildUserRole objects filtered by the manage_volumes column
 * @psalm-method Collection&\Traversable<ChildUserRole> findByManageVolumes(boolean $manage_volumes) Return ChildUserRole objects filtered by the manage_volumes column
 * @method     ChildUserRole[]|Collection findByManageHistory(boolean $manage_history) Return ChildUserRole objects filtered by the manage_history column
 * @psalm-method Collection&\Traversable<ChildUserRole> findByManageHistory(boolean $manage_history) Return ChildUserRole objects filtered by the manage_history column
 * @method     ChildUserRole[]|Collection findByManageUsers(boolean $manage_users) Return ChildUserRole objects filtered by the manage_users column
 * @psalm-method Collection&\Traversable<ChildUserRole> findByManageUsers(boolean $manage_users) Return ChildUserRole objects filtered by the manage_users column
 * @method     ChildUserRole[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildUserRole> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class UserRoleQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \DB\Base\UserRoleQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\DB\\UserRole', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildUserRoleQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildUserRoleQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildUserRoleQuery) {
            return $criteria;
        }
        $query = new ChildUserRoleQuery();
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
     * @return ChildUserRole|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UserRoleTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = UserRoleTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildUserRole A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, object_viewer, manage_objects, manage_volumes, manage_history, manage_users FROM user_role WHERE id = :p0';
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
            /** @var ChildUserRole $obj */
            $obj = new ChildUserRole();
            $obj->hydrate($row);
            UserRoleTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildUserRole|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(UserRoleTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(UserRoleTableMap::COL_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(UserRoleTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(UserRoleTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UserRoleTableMap::COL_ID, $id, $comparison);

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

        $this->addUsingAlias(UserRoleTableMap::COL_NAME, $name, $comparison);

        return $this;
    }

    /**
     * Filter the query on the object_viewer column
     *
     * Example usage:
     * <code>
     * $query->filterByObjectViewer(true); // WHERE object_viewer = true
     * $query->filterByObjectViewer('yes'); // WHERE object_viewer = true
     * </code>
     *
     * @param bool|string $objectViewer The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByObjectViewer($objectViewer = null, ?string $comparison = null)
    {
        if (is_string($objectViewer)) {
            $objectViewer = in_array(strtolower($objectViewer), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        $this->addUsingAlias(UserRoleTableMap::COL_OBJECT_VIEWER, $objectViewer, $comparison);

        return $this;
    }

    /**
     * Filter the query on the manage_objects column
     *
     * Example usage:
     * <code>
     * $query->filterByManageObjects(true); // WHERE manage_objects = true
     * $query->filterByManageObjects('yes'); // WHERE manage_objects = true
     * </code>
     *
     * @param bool|string $manageObjects The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByManageObjects($manageObjects = null, ?string $comparison = null)
    {
        if (is_string($manageObjects)) {
            $manageObjects = in_array(strtolower($manageObjects), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        $this->addUsingAlias(UserRoleTableMap::COL_MANAGE_OBJECTS, $manageObjects, $comparison);

        return $this;
    }

    /**
     * Filter the query on the manage_volumes column
     *
     * Example usage:
     * <code>
     * $query->filterByManageVolumes(true); // WHERE manage_volumes = true
     * $query->filterByManageVolumes('yes'); // WHERE manage_volumes = true
     * </code>
     *
     * @param bool|string $manageVolumes The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByManageVolumes($manageVolumes = null, ?string $comparison = null)
    {
        if (is_string($manageVolumes)) {
            $manageVolumes = in_array(strtolower($manageVolumes), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        $this->addUsingAlias(UserRoleTableMap::COL_MANAGE_VOLUMES, $manageVolumes, $comparison);

        return $this;
    }

    /**
     * Filter the query on the manage_history column
     *
     * Example usage:
     * <code>
     * $query->filterByManageHistory(true); // WHERE manage_history = true
     * $query->filterByManageHistory('yes'); // WHERE manage_history = true
     * </code>
     *
     * @param bool|string $manageHistory The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByManageHistory($manageHistory = null, ?string $comparison = null)
    {
        if (is_string($manageHistory)) {
            $manageHistory = in_array(strtolower($manageHistory), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        $this->addUsingAlias(UserRoleTableMap::COL_MANAGE_HISTORY, $manageHistory, $comparison);

        return $this;
    }

    /**
     * Filter the query on the manage_users column
     *
     * Example usage:
     * <code>
     * $query->filterByManageUsers(true); // WHERE manage_users = true
     * $query->filterByManageUsers('yes'); // WHERE manage_users = true
     * </code>
     *
     * @param bool|string $manageUsers The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByManageUsers($manageUsers = null, ?string $comparison = null)
    {
        if (is_string($manageUsers)) {
            $manageUsers = in_array(strtolower($manageUsers), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        $this->addUsingAlias(UserRoleTableMap::COL_MANAGE_USERS, $manageUsers, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \DB\Users object
     *
     * @param \DB\Users|ObjectCollection $users the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUsers($users, ?string $comparison = null)
    {
        if ($users instanceof \DB\Users) {
            $this
                ->addUsingAlias(UserRoleTableMap::COL_ID, $users->getRoleId(), $comparison);

            return $this;
        } elseif ($users instanceof ObjectCollection) {
            $this
                ->useUsersQuery()
                ->filterByPrimaryKeys($users->getPrimaryKeys())
                ->endUse();

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
    public function joinUsers(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
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
    public function useUsersQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
        ?string $joinType = Criteria::LEFT_JOIN
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
     * Exclude object from result
     *
     * @param ChildUserRole $userRole Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($userRole = null)
    {
        if ($userRole) {
            $this->addUsingAlias(UserRoleTableMap::COL_ID, $userRole->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the user_role table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UserRoleTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UserRoleTableMap::clearInstancePool();
            UserRoleTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(UserRoleTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(UserRoleTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            UserRoleTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            UserRoleTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
