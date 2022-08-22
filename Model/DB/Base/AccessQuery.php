<?php

namespace DB\Base;

use \Exception;
use \PDO;
use DB\Access as ChildAccess;
use DB\AccessQuery as ChildAccessQuery;
use DB\Map\AccessTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'access' table.
 *
 *
 *
 * @method     ChildAccessQuery orderByRoleId($order = Criteria::ASC) Order by the role_id column
 * @method     ChildAccessQuery orderByObjectViewer($order = Criteria::ASC) Order by the object_viewer column
 * @method     ChildAccessQuery orderByManageObjects($order = Criteria::ASC) Order by the manage_objects column
 * @method     ChildAccessQuery orderByManageVolumes($order = Criteria::ASC) Order by the manage_volumes column
 * @method     ChildAccessQuery orderByManageHistory($order = Criteria::ASC) Order by the manage_history column
 * @method     ChildAccessQuery orderByManageUsers($order = Criteria::ASC) Order by the manage_users column
 *
 * @method     ChildAccessQuery groupByRoleId() Group by the role_id column
 * @method     ChildAccessQuery groupByObjectViewer() Group by the object_viewer column
 * @method     ChildAccessQuery groupByManageObjects() Group by the manage_objects column
 * @method     ChildAccessQuery groupByManageVolumes() Group by the manage_volumes column
 * @method     ChildAccessQuery groupByManageHistory() Group by the manage_history column
 * @method     ChildAccessQuery groupByManageUsers() Group by the manage_users column
 *
 * @method     ChildAccessQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildAccessQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildAccessQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildAccessQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildAccessQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildAccessQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildAccessQuery leftJoinRole($relationAlias = null) Adds a LEFT JOIN clause to the query using the Role relation
 * @method     ChildAccessQuery rightJoinRole($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Role relation
 * @method     ChildAccessQuery innerJoinRole($relationAlias = null) Adds a INNER JOIN clause to the query using the Role relation
 *
 * @method     ChildAccessQuery joinWithRole($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Role relation
 *
 * @method     ChildAccessQuery leftJoinWithRole() Adds a LEFT JOIN clause and with to the query using the Role relation
 * @method     ChildAccessQuery rightJoinWithRole() Adds a RIGHT JOIN clause and with to the query using the Role relation
 * @method     ChildAccessQuery innerJoinWithRole() Adds a INNER JOIN clause and with to the query using the Role relation
 *
 * @method     \DB\RoleQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildAccess|null findOne(?ConnectionInterface $con = null) Return the first ChildAccess matching the query
 * @method     ChildAccess findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildAccess matching the query, or a new ChildAccess object populated from the query conditions when no match is found
 *
 * @method     ChildAccess|null findOneByRoleId(int $role_id) Return the first ChildAccess filtered by the role_id column
 * @method     ChildAccess|null findOneByObjectViewer(boolean $object_viewer) Return the first ChildAccess filtered by the object_viewer column
 * @method     ChildAccess|null findOneByManageObjects(boolean $manage_objects) Return the first ChildAccess filtered by the manage_objects column
 * @method     ChildAccess|null findOneByManageVolumes(boolean $manage_volumes) Return the first ChildAccess filtered by the manage_volumes column
 * @method     ChildAccess|null findOneByManageHistory(boolean $manage_history) Return the first ChildAccess filtered by the manage_history column
 * @method     ChildAccess|null findOneByManageUsers(boolean $manage_users) Return the first ChildAccess filtered by the manage_users column *

 * @method     ChildAccess requirePk($key, ?ConnectionInterface $con = null) Return the ChildAccess by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAccess requireOne(?ConnectionInterface $con = null) Return the first ChildAccess matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAccess requireOneByRoleId(int $role_id) Return the first ChildAccess filtered by the role_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAccess requireOneByObjectViewer(boolean $object_viewer) Return the first ChildAccess filtered by the object_viewer column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAccess requireOneByManageObjects(boolean $manage_objects) Return the first ChildAccess filtered by the manage_objects column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAccess requireOneByManageVolumes(boolean $manage_volumes) Return the first ChildAccess filtered by the manage_volumes column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAccess requireOneByManageHistory(boolean $manage_history) Return the first ChildAccess filtered by the manage_history column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAccess requireOneByManageUsers(boolean $manage_users) Return the first ChildAccess filtered by the manage_users column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAccess[]|Collection find(?ConnectionInterface $con = null) Return ChildAccess objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildAccess> find(?ConnectionInterface $con = null) Return ChildAccess objects based on current ModelCriteria
 * @method     ChildAccess[]|Collection findByRoleId(int $role_id) Return ChildAccess objects filtered by the role_id column
 * @psalm-method Collection&\Traversable<ChildAccess> findByRoleId(int $role_id) Return ChildAccess objects filtered by the role_id column
 * @method     ChildAccess[]|Collection findByObjectViewer(boolean $object_viewer) Return ChildAccess objects filtered by the object_viewer column
 * @psalm-method Collection&\Traversable<ChildAccess> findByObjectViewer(boolean $object_viewer) Return ChildAccess objects filtered by the object_viewer column
 * @method     ChildAccess[]|Collection findByManageObjects(boolean $manage_objects) Return ChildAccess objects filtered by the manage_objects column
 * @psalm-method Collection&\Traversable<ChildAccess> findByManageObjects(boolean $manage_objects) Return ChildAccess objects filtered by the manage_objects column
 * @method     ChildAccess[]|Collection findByManageVolumes(boolean $manage_volumes) Return ChildAccess objects filtered by the manage_volumes column
 * @psalm-method Collection&\Traversable<ChildAccess> findByManageVolumes(boolean $manage_volumes) Return ChildAccess objects filtered by the manage_volumes column
 * @method     ChildAccess[]|Collection findByManageHistory(boolean $manage_history) Return ChildAccess objects filtered by the manage_history column
 * @psalm-method Collection&\Traversable<ChildAccess> findByManageHistory(boolean $manage_history) Return ChildAccess objects filtered by the manage_history column
 * @method     ChildAccess[]|Collection findByManageUsers(boolean $manage_users) Return ChildAccess objects filtered by the manage_users column
 * @psalm-method Collection&\Traversable<ChildAccess> findByManageUsers(boolean $manage_users) Return ChildAccess objects filtered by the manage_users column
 * @method     ChildAccess[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildAccess> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class AccessQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \DB\Base\AccessQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\DB\\Access', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildAccessQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildAccessQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildAccessQuery) {
            return $criteria;
        }
        $query = new ChildAccessQuery();
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
     * @return ChildAccess|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(AccessTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = AccessTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildAccess A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT role_id, object_viewer, manage_objects, manage_volumes, manage_history, manage_users FROM access WHERE role_id = :p0';
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
            /** @var ChildAccess $obj */
            $obj = new ChildAccess();
            $obj->hydrate($row);
            AccessTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildAccess|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(AccessTableMap::COL_ROLE_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(AccessTableMap::COL_ROLE_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the role_id column
     *
     * Example usage:
     * <code>
     * $query->filterByRoleId(1234); // WHERE role_id = 1234
     * $query->filterByRoleId(array(12, 34)); // WHERE role_id IN (12, 34)
     * $query->filterByRoleId(array('min' => 12)); // WHERE role_id > 12
     * </code>
     *
     * @see       filterByRole()
     *
     * @param mixed $roleId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRoleId($roleId = null, ?string $comparison = null)
    {
        if (is_array($roleId)) {
            $useMinMax = false;
            if (isset($roleId['min'])) {
                $this->addUsingAlias(AccessTableMap::COL_ROLE_ID, $roleId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($roleId['max'])) {
                $this->addUsingAlias(AccessTableMap::COL_ROLE_ID, $roleId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(AccessTableMap::COL_ROLE_ID, $roleId, $comparison);

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

        $this->addUsingAlias(AccessTableMap::COL_OBJECT_VIEWER, $objectViewer, $comparison);

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

        $this->addUsingAlias(AccessTableMap::COL_MANAGE_OBJECTS, $manageObjects, $comparison);

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

        $this->addUsingAlias(AccessTableMap::COL_MANAGE_VOLUMES, $manageVolumes, $comparison);

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

        $this->addUsingAlias(AccessTableMap::COL_MANAGE_HISTORY, $manageHistory, $comparison);

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

        $this->addUsingAlias(AccessTableMap::COL_MANAGE_USERS, $manageUsers, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \DB\Role object
     *
     * @param \DB\Role|ObjectCollection $role The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRole($role, ?string $comparison = null)
    {
        if ($role instanceof \DB\Role) {
            return $this
                ->addUsingAlias(AccessTableMap::COL_ROLE_ID, $role->getId(), $comparison);
        } elseif ($role instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(AccessTableMap::COL_ROLE_ID, $role->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByRole() only accepts arguments of type \DB\Role or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Role relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinRole(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Role');

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
            $this->addJoinObject($join, 'Role');
        }

        return $this;
    }

    /**
     * Use the Role relation Role object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\RoleQuery A secondary query class using the current class as primary query
     */
    public function useRoleQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinRole($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Role', '\DB\RoleQuery');
    }

    /**
     * Use the Role relation Role object
     *
     * @param callable(\DB\RoleQuery):\DB\RoleQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withRoleQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useRoleQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to Role table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\RoleQuery The inner query object of the EXISTS statement
     */
    public function useRoleExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('Role', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to Role table for a NOT EXISTS query.
     *
     * @see useRoleExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\RoleQuery The inner query object of the NOT EXISTS statement
     */
    public function useRoleNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('Role', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Exclude object from result
     *
     * @param ChildAccess $access Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($access = null)
    {
        if ($access) {
            $this->addUsingAlias(AccessTableMap::COL_ROLE_ID, $access->getRoleId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the access table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AccessTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            AccessTableMap::clearInstancePool();
            AccessTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(AccessTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(AccessTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            AccessTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            AccessTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
