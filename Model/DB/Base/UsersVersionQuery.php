<?php

namespace DB\Base;

use \Exception;
use \PDO;
use DB\UsersVersion as ChildUsersVersion;
use DB\UsersVersionQuery as ChildUsersVersionQuery;
use DB\Map\UsersVersionTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'users_version' table.
 *
 *
 *
 * @method     ChildUsersVersionQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildUsersVersionQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method     ChildUsersVersionQuery orderByPassword($order = Criteria::ASC) Order by the password column
 * @method     ChildUsersVersionQuery orderByUsername($order = Criteria::ASC) Order by the username column
 * @method     ChildUsersVersionQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildUsersVersionQuery orderByVerified($order = Criteria::ASC) Order by the verified column
 * @method     ChildUsersVersionQuery orderByResettable($order = Criteria::ASC) Order by the resettable column
 * @method     ChildUsersVersionQuery orderByRolesMask($order = Criteria::ASC) Order by the roles_mask column
 * @method     ChildUsersVersionQuery orderByRegistered($order = Criteria::ASC) Order by the registered column
 * @method     ChildUsersVersionQuery orderByLastLogin($order = Criteria::ASC) Order by the last_login column
 * @method     ChildUsersVersionQuery orderByForceLogout($order = Criteria::ASC) Order by the force_logout column
 * @method     ChildUsersVersionQuery orderByIsAvailable($order = Criteria::ASC) Order by the is_available column
 * @method     ChildUsersVersionQuery orderByVersion($order = Criteria::ASC) Order by the version column
 * @method     ChildUsersVersionQuery orderByGroupsIds($order = Criteria::ASC) Order by the groups_ids column
 * @method     ChildUsersVersionQuery orderByGroupsVersions($order = Criteria::ASC) Order by the groups_versions column
 * @method     ChildUsersVersionQuery orderByUnitIds($order = Criteria::ASC) Order by the unit_ids column
 * @method     ChildUsersVersionQuery orderByUnitVersions($order = Criteria::ASC) Order by the unit_versions column
 *
 * @method     ChildUsersVersionQuery groupById() Group by the id column
 * @method     ChildUsersVersionQuery groupByEmail() Group by the email column
 * @method     ChildUsersVersionQuery groupByPassword() Group by the password column
 * @method     ChildUsersVersionQuery groupByUsername() Group by the username column
 * @method     ChildUsersVersionQuery groupByStatus() Group by the status column
 * @method     ChildUsersVersionQuery groupByVerified() Group by the verified column
 * @method     ChildUsersVersionQuery groupByResettable() Group by the resettable column
 * @method     ChildUsersVersionQuery groupByRolesMask() Group by the roles_mask column
 * @method     ChildUsersVersionQuery groupByRegistered() Group by the registered column
 * @method     ChildUsersVersionQuery groupByLastLogin() Group by the last_login column
 * @method     ChildUsersVersionQuery groupByForceLogout() Group by the force_logout column
 * @method     ChildUsersVersionQuery groupByIsAvailable() Group by the is_available column
 * @method     ChildUsersVersionQuery groupByVersion() Group by the version column
 * @method     ChildUsersVersionQuery groupByGroupsIds() Group by the groups_ids column
 * @method     ChildUsersVersionQuery groupByGroupsVersions() Group by the groups_versions column
 * @method     ChildUsersVersionQuery groupByUnitIds() Group by the unit_ids column
 * @method     ChildUsersVersionQuery groupByUnitVersions() Group by the unit_versions column
 *
 * @method     ChildUsersVersionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUsersVersionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUsersVersionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUsersVersionQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildUsersVersionQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildUsersVersionQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildUsersVersionQuery leftJoinUsers($relationAlias = null) Adds a LEFT JOIN clause to the query using the Users relation
 * @method     ChildUsersVersionQuery rightJoinUsers($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Users relation
 * @method     ChildUsersVersionQuery innerJoinUsers($relationAlias = null) Adds a INNER JOIN clause to the query using the Users relation
 *
 * @method     ChildUsersVersionQuery joinWithUsers($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Users relation
 *
 * @method     ChildUsersVersionQuery leftJoinWithUsers() Adds a LEFT JOIN clause and with to the query using the Users relation
 * @method     ChildUsersVersionQuery rightJoinWithUsers() Adds a RIGHT JOIN clause and with to the query using the Users relation
 * @method     ChildUsersVersionQuery innerJoinWithUsers() Adds a INNER JOIN clause and with to the query using the Users relation
 *
 * @method     \DB\UsersQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildUsersVersion|null findOne(?ConnectionInterface $con = null) Return the first ChildUsersVersion matching the query
 * @method     ChildUsersVersion findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildUsersVersion matching the query, or a new ChildUsersVersion object populated from the query conditions when no match is found
 *
 * @method     ChildUsersVersion|null findOneById(int $id) Return the first ChildUsersVersion filtered by the id column
 * @method     ChildUsersVersion|null findOneByEmail(string $email) Return the first ChildUsersVersion filtered by the email column
 * @method     ChildUsersVersion|null findOneByPassword(string $password) Return the first ChildUsersVersion filtered by the password column
 * @method     ChildUsersVersion|null findOneByUsername(string $username) Return the first ChildUsersVersion filtered by the username column
 * @method     ChildUsersVersion|null findOneByStatus(int $status) Return the first ChildUsersVersion filtered by the status column
 * @method     ChildUsersVersion|null findOneByVerified(int $verified) Return the first ChildUsersVersion filtered by the verified column
 * @method     ChildUsersVersion|null findOneByResettable(int $resettable) Return the first ChildUsersVersion filtered by the resettable column
 * @method     ChildUsersVersion|null findOneByRolesMask(int $roles_mask) Return the first ChildUsersVersion filtered by the roles_mask column
 * @method     ChildUsersVersion|null findOneByRegistered(int $registered) Return the first ChildUsersVersion filtered by the registered column
 * @method     ChildUsersVersion|null findOneByLastLogin(int $last_login) Return the first ChildUsersVersion filtered by the last_login column
 * @method     ChildUsersVersion|null findOneByForceLogout(int $force_logout) Return the first ChildUsersVersion filtered by the force_logout column
 * @method     ChildUsersVersion|null findOneByIsAvailable(boolean $is_available) Return the first ChildUsersVersion filtered by the is_available column
 * @method     ChildUsersVersion|null findOneByVersion(int $version) Return the first ChildUsersVersion filtered by the version column
 * @method     ChildUsersVersion|null findOneByGroupsIds(array $groups_ids) Return the first ChildUsersVersion filtered by the groups_ids column
 * @method     ChildUsersVersion|null findOneByGroupsVersions(array $groups_versions) Return the first ChildUsersVersion filtered by the groups_versions column
 * @method     ChildUsersVersion|null findOneByUnitIds(array $unit_ids) Return the first ChildUsersVersion filtered by the unit_ids column
 * @method     ChildUsersVersion|null findOneByUnitVersions(array $unit_versions) Return the first ChildUsersVersion filtered by the unit_versions column *

 * @method     ChildUsersVersion requirePk($key, ?ConnectionInterface $con = null) Return the ChildUsersVersion by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersVersion requireOne(?ConnectionInterface $con = null) Return the first ChildUsersVersion matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUsersVersion requireOneById(int $id) Return the first ChildUsersVersion filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersVersion requireOneByEmail(string $email) Return the first ChildUsersVersion filtered by the email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersVersion requireOneByPassword(string $password) Return the first ChildUsersVersion filtered by the password column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersVersion requireOneByUsername(string $username) Return the first ChildUsersVersion filtered by the username column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersVersion requireOneByStatus(int $status) Return the first ChildUsersVersion filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersVersion requireOneByVerified(int $verified) Return the first ChildUsersVersion filtered by the verified column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersVersion requireOneByResettable(int $resettable) Return the first ChildUsersVersion filtered by the resettable column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersVersion requireOneByRolesMask(int $roles_mask) Return the first ChildUsersVersion filtered by the roles_mask column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersVersion requireOneByRegistered(int $registered) Return the first ChildUsersVersion filtered by the registered column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersVersion requireOneByLastLogin(int $last_login) Return the first ChildUsersVersion filtered by the last_login column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersVersion requireOneByForceLogout(int $force_logout) Return the first ChildUsersVersion filtered by the force_logout column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersVersion requireOneByIsAvailable(boolean $is_available) Return the first ChildUsersVersion filtered by the is_available column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersVersion requireOneByVersion(int $version) Return the first ChildUsersVersion filtered by the version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersVersion requireOneByGroupsIds(array $groups_ids) Return the first ChildUsersVersion filtered by the groups_ids column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersVersion requireOneByGroupsVersions(array $groups_versions) Return the first ChildUsersVersion filtered by the groups_versions column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersVersion requireOneByUnitIds(array $unit_ids) Return the first ChildUsersVersion filtered by the unit_ids column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersVersion requireOneByUnitVersions(array $unit_versions) Return the first ChildUsersVersion filtered by the unit_versions column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUsersVersion[]|Collection find(?ConnectionInterface $con = null) Return ChildUsersVersion objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildUsersVersion> find(?ConnectionInterface $con = null) Return ChildUsersVersion objects based on current ModelCriteria
 * @method     ChildUsersVersion[]|Collection findById(int $id) Return ChildUsersVersion objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildUsersVersion> findById(int $id) Return ChildUsersVersion objects filtered by the id column
 * @method     ChildUsersVersion[]|Collection findByEmail(string $email) Return ChildUsersVersion objects filtered by the email column
 * @psalm-method Collection&\Traversable<ChildUsersVersion> findByEmail(string $email) Return ChildUsersVersion objects filtered by the email column
 * @method     ChildUsersVersion[]|Collection findByPassword(string $password) Return ChildUsersVersion objects filtered by the password column
 * @psalm-method Collection&\Traversable<ChildUsersVersion> findByPassword(string $password) Return ChildUsersVersion objects filtered by the password column
 * @method     ChildUsersVersion[]|Collection findByUsername(string $username) Return ChildUsersVersion objects filtered by the username column
 * @psalm-method Collection&\Traversable<ChildUsersVersion> findByUsername(string $username) Return ChildUsersVersion objects filtered by the username column
 * @method     ChildUsersVersion[]|Collection findByStatus(int $status) Return ChildUsersVersion objects filtered by the status column
 * @psalm-method Collection&\Traversable<ChildUsersVersion> findByStatus(int $status) Return ChildUsersVersion objects filtered by the status column
 * @method     ChildUsersVersion[]|Collection findByVerified(int $verified) Return ChildUsersVersion objects filtered by the verified column
 * @psalm-method Collection&\Traversable<ChildUsersVersion> findByVerified(int $verified) Return ChildUsersVersion objects filtered by the verified column
 * @method     ChildUsersVersion[]|Collection findByResettable(int $resettable) Return ChildUsersVersion objects filtered by the resettable column
 * @psalm-method Collection&\Traversable<ChildUsersVersion> findByResettable(int $resettable) Return ChildUsersVersion objects filtered by the resettable column
 * @method     ChildUsersVersion[]|Collection findByRolesMask(int $roles_mask) Return ChildUsersVersion objects filtered by the roles_mask column
 * @psalm-method Collection&\Traversable<ChildUsersVersion> findByRolesMask(int $roles_mask) Return ChildUsersVersion objects filtered by the roles_mask column
 * @method     ChildUsersVersion[]|Collection findByRegistered(int $registered) Return ChildUsersVersion objects filtered by the registered column
 * @psalm-method Collection&\Traversable<ChildUsersVersion> findByRegistered(int $registered) Return ChildUsersVersion objects filtered by the registered column
 * @method     ChildUsersVersion[]|Collection findByLastLogin(int $last_login) Return ChildUsersVersion objects filtered by the last_login column
 * @psalm-method Collection&\Traversable<ChildUsersVersion> findByLastLogin(int $last_login) Return ChildUsersVersion objects filtered by the last_login column
 * @method     ChildUsersVersion[]|Collection findByForceLogout(int $force_logout) Return ChildUsersVersion objects filtered by the force_logout column
 * @psalm-method Collection&\Traversable<ChildUsersVersion> findByForceLogout(int $force_logout) Return ChildUsersVersion objects filtered by the force_logout column
 * @method     ChildUsersVersion[]|Collection findByIsAvailable(boolean $is_available) Return ChildUsersVersion objects filtered by the is_available column
 * @psalm-method Collection&\Traversable<ChildUsersVersion> findByIsAvailable(boolean $is_available) Return ChildUsersVersion objects filtered by the is_available column
 * @method     ChildUsersVersion[]|Collection findByVersion(int $version) Return ChildUsersVersion objects filtered by the version column
 * @psalm-method Collection&\Traversable<ChildUsersVersion> findByVersion(int $version) Return ChildUsersVersion objects filtered by the version column
 * @method     ChildUsersVersion[]|Collection findByGroupsIds(array $groups_ids) Return ChildUsersVersion objects filtered by the groups_ids column
 * @psalm-method Collection&\Traversable<ChildUsersVersion> findByGroupsIds(array $groups_ids) Return ChildUsersVersion objects filtered by the groups_ids column
 * @method     ChildUsersVersion[]|Collection findByGroupsVersions(array $groups_versions) Return ChildUsersVersion objects filtered by the groups_versions column
 * @psalm-method Collection&\Traversable<ChildUsersVersion> findByGroupsVersions(array $groups_versions) Return ChildUsersVersion objects filtered by the groups_versions column
 * @method     ChildUsersVersion[]|Collection findByUnitIds(array $unit_ids) Return ChildUsersVersion objects filtered by the unit_ids column
 * @psalm-method Collection&\Traversable<ChildUsersVersion> findByUnitIds(array $unit_ids) Return ChildUsersVersion objects filtered by the unit_ids column
 * @method     ChildUsersVersion[]|Collection findByUnitVersions(array $unit_versions) Return ChildUsersVersion objects filtered by the unit_versions column
 * @psalm-method Collection&\Traversable<ChildUsersVersion> findByUnitVersions(array $unit_versions) Return ChildUsersVersion objects filtered by the unit_versions column
 * @method     ChildUsersVersion[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildUsersVersion> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class UsersVersionQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \DB\Base\UsersVersionQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\DB\\UsersVersion', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildUsersVersionQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildUsersVersionQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildUsersVersionQuery) {
            return $criteria;
        }
        $query = new ChildUsersVersionQuery();
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
     * @return ChildUsersVersion|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UsersVersionTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = UsersVersionTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildUsersVersion A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, email, password, username, status, verified, resettable, roles_mask, registered, last_login, force_logout, is_available, version, groups_ids, groups_versions, unit_ids, unit_versions FROM users_version WHERE id = :p0 AND version = :p1';
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
            /** @var ChildUsersVersion $obj */
            $obj = new ChildUsersVersion();
            $obj->hydrate($row);
            UsersVersionTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildUsersVersion|array|mixed the result, formatted by the current formatter
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
        $this->addUsingAlias(UsersVersionTableMap::COL_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(UsersVersionTableMap::COL_VERSION, $key[1], Criteria::EQUAL);

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
            $cton0 = $this->getNewCriterion(UsersVersionTableMap::COL_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(UsersVersionTableMap::COL_VERSION, $key[1], Criteria::EQUAL);
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
     * @see       filterByUsers()
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
                $this->addUsingAlias(UsersVersionTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(UsersVersionTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersVersionTableMap::COL_ID, $id, $comparison);

        return $this;
    }

    /**
     * Filter the query on the email column
     *
     * Example usage:
     * <code>
     * $query->filterByEmail('fooValue');   // WHERE email = 'fooValue'
     * $query->filterByEmail('%fooValue%', Criteria::LIKE); // WHERE email LIKE '%fooValue%'
     * $query->filterByEmail(['foo', 'bar']); // WHERE email IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $email The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmail($email = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersVersionTableMap::COL_EMAIL, $email, $comparison);

        return $this;
    }

    /**
     * Filter the query on the password column
     *
     * Example usage:
     * <code>
     * $query->filterByPassword('fooValue');   // WHERE password = 'fooValue'
     * $query->filterByPassword('%fooValue%', Criteria::LIKE); // WHERE password LIKE '%fooValue%'
     * $query->filterByPassword(['foo', 'bar']); // WHERE password IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $password The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPassword($password = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($password)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersVersionTableMap::COL_PASSWORD, $password, $comparison);

        return $this;
    }

    /**
     * Filter the query on the username column
     *
     * Example usage:
     * <code>
     * $query->filterByUsername('fooValue');   // WHERE username = 'fooValue'
     * $query->filterByUsername('%fooValue%', Criteria::LIKE); // WHERE username LIKE '%fooValue%'
     * $query->filterByUsername(['foo', 'bar']); // WHERE username IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $username The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUsername($username = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($username)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersVersionTableMap::COL_USERNAME, $username, $comparison);

        return $this;
    }

    /**
     * Filter the query on the status column
     *
     * Example usage:
     * <code>
     * $query->filterByStatus(1234); // WHERE status = 1234
     * $query->filterByStatus(array(12, 34)); // WHERE status IN (12, 34)
     * $query->filterByStatus(array('min' => 12)); // WHERE status > 12
     * </code>
     *
     * @param mixed $status The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStatus($status = null, ?string $comparison = null)
    {
        if (is_array($status)) {
            $useMinMax = false;
            if (isset($status['min'])) {
                $this->addUsingAlias(UsersVersionTableMap::COL_STATUS, $status['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($status['max'])) {
                $this->addUsingAlias(UsersVersionTableMap::COL_STATUS, $status['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersVersionTableMap::COL_STATUS, $status, $comparison);

        return $this;
    }

    /**
     * Filter the query on the verified column
     *
     * Example usage:
     * <code>
     * $query->filterByVerified(1234); // WHERE verified = 1234
     * $query->filterByVerified(array(12, 34)); // WHERE verified IN (12, 34)
     * $query->filterByVerified(array('min' => 12)); // WHERE verified > 12
     * </code>
     *
     * @param mixed $verified The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByVerified($verified = null, ?string $comparison = null)
    {
        if (is_array($verified)) {
            $useMinMax = false;
            if (isset($verified['min'])) {
                $this->addUsingAlias(UsersVersionTableMap::COL_VERIFIED, $verified['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($verified['max'])) {
                $this->addUsingAlias(UsersVersionTableMap::COL_VERIFIED, $verified['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersVersionTableMap::COL_VERIFIED, $verified, $comparison);

        return $this;
    }

    /**
     * Filter the query on the resettable column
     *
     * Example usage:
     * <code>
     * $query->filterByResettable(1234); // WHERE resettable = 1234
     * $query->filterByResettable(array(12, 34)); // WHERE resettable IN (12, 34)
     * $query->filterByResettable(array('min' => 12)); // WHERE resettable > 12
     * </code>
     *
     * @param mixed $resettable The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByResettable($resettable = null, ?string $comparison = null)
    {
        if (is_array($resettable)) {
            $useMinMax = false;
            if (isset($resettable['min'])) {
                $this->addUsingAlias(UsersVersionTableMap::COL_RESETTABLE, $resettable['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($resettable['max'])) {
                $this->addUsingAlias(UsersVersionTableMap::COL_RESETTABLE, $resettable['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersVersionTableMap::COL_RESETTABLE, $resettable, $comparison);

        return $this;
    }

    /**
     * Filter the query on the roles_mask column
     *
     * Example usage:
     * <code>
     * $query->filterByRolesMask(1234); // WHERE roles_mask = 1234
     * $query->filterByRolesMask(array(12, 34)); // WHERE roles_mask IN (12, 34)
     * $query->filterByRolesMask(array('min' => 12)); // WHERE roles_mask > 12
     * </code>
     *
     * @param mixed $rolesMask The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRolesMask($rolesMask = null, ?string $comparison = null)
    {
        if (is_array($rolesMask)) {
            $useMinMax = false;
            if (isset($rolesMask['min'])) {
                $this->addUsingAlias(UsersVersionTableMap::COL_ROLES_MASK, $rolesMask['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($rolesMask['max'])) {
                $this->addUsingAlias(UsersVersionTableMap::COL_ROLES_MASK, $rolesMask['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersVersionTableMap::COL_ROLES_MASK, $rolesMask, $comparison);

        return $this;
    }

    /**
     * Filter the query on the registered column
     *
     * Example usage:
     * <code>
     * $query->filterByRegistered(1234); // WHERE registered = 1234
     * $query->filterByRegistered(array(12, 34)); // WHERE registered IN (12, 34)
     * $query->filterByRegistered(array('min' => 12)); // WHERE registered > 12
     * </code>
     *
     * @param mixed $registered The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRegistered($registered = null, ?string $comparison = null)
    {
        if (is_array($registered)) {
            $useMinMax = false;
            if (isset($registered['min'])) {
                $this->addUsingAlias(UsersVersionTableMap::COL_REGISTERED, $registered['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($registered['max'])) {
                $this->addUsingAlias(UsersVersionTableMap::COL_REGISTERED, $registered['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersVersionTableMap::COL_REGISTERED, $registered, $comparison);

        return $this;
    }

    /**
     * Filter the query on the last_login column
     *
     * Example usage:
     * <code>
     * $query->filterByLastLogin(1234); // WHERE last_login = 1234
     * $query->filterByLastLogin(array(12, 34)); // WHERE last_login IN (12, 34)
     * $query->filterByLastLogin(array('min' => 12)); // WHERE last_login > 12
     * </code>
     *
     * @param mixed $lastLogin The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLastLogin($lastLogin = null, ?string $comparison = null)
    {
        if (is_array($lastLogin)) {
            $useMinMax = false;
            if (isset($lastLogin['min'])) {
                $this->addUsingAlias(UsersVersionTableMap::COL_LAST_LOGIN, $lastLogin['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastLogin['max'])) {
                $this->addUsingAlias(UsersVersionTableMap::COL_LAST_LOGIN, $lastLogin['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersVersionTableMap::COL_LAST_LOGIN, $lastLogin, $comparison);

        return $this;
    }

    /**
     * Filter the query on the force_logout column
     *
     * Example usage:
     * <code>
     * $query->filterByForceLogout(1234); // WHERE force_logout = 1234
     * $query->filterByForceLogout(array(12, 34)); // WHERE force_logout IN (12, 34)
     * $query->filterByForceLogout(array('min' => 12)); // WHERE force_logout > 12
     * </code>
     *
     * @param mixed $forceLogout The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByForceLogout($forceLogout = null, ?string $comparison = null)
    {
        if (is_array($forceLogout)) {
            $useMinMax = false;
            if (isset($forceLogout['min'])) {
                $this->addUsingAlias(UsersVersionTableMap::COL_FORCE_LOGOUT, $forceLogout['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($forceLogout['max'])) {
                $this->addUsingAlias(UsersVersionTableMap::COL_FORCE_LOGOUT, $forceLogout['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersVersionTableMap::COL_FORCE_LOGOUT, $forceLogout, $comparison);

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

        $this->addUsingAlias(UsersVersionTableMap::COL_IS_AVAILABLE, $isAvailable, $comparison);

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
                $this->addUsingAlias(UsersVersionTableMap::COL_VERSION, $version['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($version['max'])) {
                $this->addUsingAlias(UsersVersionTableMap::COL_VERSION, $version['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersVersionTableMap::COL_VERSION, $version, $comparison);

        return $this;
    }

    /**
     * Filter the query on the groups_ids column
     *
     * @param array $groupsIds The values to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGroupsIds($groupsIds = null, ?string $comparison = null)
    {
        $key = $this->getAliasedColName(UsersVersionTableMap::COL_GROUPS_IDS);
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            foreach ($groupsIds as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addAnd($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_SOME) {
            foreach ($groupsIds as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addOr($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            foreach ($groupsIds as $value) {
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

        $this->addUsingAlias(UsersVersionTableMap::COL_GROUPS_IDS, $groupsIds, $comparison);

        return $this;
    }

    /**
     * Filter the query on the groups_ids column
     * @param mixed $groupsIds The value to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::CONTAINS_ALL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGroupsId($groupsIds = null, ?string $comparison = null)
    {
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            if (is_scalar($groupsIds)) {
                $groupsIds = '%| ' . $groupsIds . ' |%';
                $comparison = Criteria::LIKE;
            }
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            $groupsIds = '%| ' . $groupsIds . ' |%';
            $comparison = Criteria::NOT_LIKE;
            $key = $this->getAliasedColName(UsersVersionTableMap::COL_GROUPS_IDS);
            if ($this->containsKey($key)) {
                $this->addAnd($key, $groupsIds, $comparison);
            } else {
                $this->addAnd($key, $groupsIds, $comparison);
            }
            $this->addOr($key, null, Criteria::ISNULL);

            return $this;
        }

        $this->addUsingAlias(UsersVersionTableMap::COL_GROUPS_IDS, $groupsIds, $comparison);

        return $this;
    }

    /**
     * Filter the query on the groups_versions column
     *
     * @param array $groupsVersions The values to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGroupsVersions($groupsVersions = null, ?string $comparison = null)
    {
        $key = $this->getAliasedColName(UsersVersionTableMap::COL_GROUPS_VERSIONS);
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            foreach ($groupsVersions as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addAnd($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_SOME) {
            foreach ($groupsVersions as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addOr($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            foreach ($groupsVersions as $value) {
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

        $this->addUsingAlias(UsersVersionTableMap::COL_GROUPS_VERSIONS, $groupsVersions, $comparison);

        return $this;
    }

    /**
     * Filter the query on the groups_versions column
     * @param mixed $groupsVersions The value to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::CONTAINS_ALL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGroupsVersion($groupsVersions = null, ?string $comparison = null)
    {
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            if (is_scalar($groupsVersions)) {
                $groupsVersions = '%| ' . $groupsVersions . ' |%';
                $comparison = Criteria::LIKE;
            }
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            $groupsVersions = '%| ' . $groupsVersions . ' |%';
            $comparison = Criteria::NOT_LIKE;
            $key = $this->getAliasedColName(UsersVersionTableMap::COL_GROUPS_VERSIONS);
            if ($this->containsKey($key)) {
                $this->addAnd($key, $groupsVersions, $comparison);
            } else {
                $this->addAnd($key, $groupsVersions, $comparison);
            }
            $this->addOr($key, null, Criteria::ISNULL);

            return $this;
        }

        $this->addUsingAlias(UsersVersionTableMap::COL_GROUPS_VERSIONS, $groupsVersions, $comparison);

        return $this;
    }

    /**
     * Filter the query on the unit_ids column
     *
     * @param array $unitIds The values to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUnitIds($unitIds = null, ?string $comparison = null)
    {
        $key = $this->getAliasedColName(UsersVersionTableMap::COL_UNIT_IDS);
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            foreach ($unitIds as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addAnd($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_SOME) {
            foreach ($unitIds as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addOr($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            foreach ($unitIds as $value) {
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

        $this->addUsingAlias(UsersVersionTableMap::COL_UNIT_IDS, $unitIds, $comparison);

        return $this;
    }

    /**
     * Filter the query on the unit_ids column
     * @param mixed $unitIds The value to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::CONTAINS_ALL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUnitId($unitIds = null, ?string $comparison = null)
    {
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            if (is_scalar($unitIds)) {
                $unitIds = '%| ' . $unitIds . ' |%';
                $comparison = Criteria::LIKE;
            }
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            $unitIds = '%| ' . $unitIds . ' |%';
            $comparison = Criteria::NOT_LIKE;
            $key = $this->getAliasedColName(UsersVersionTableMap::COL_UNIT_IDS);
            if ($this->containsKey($key)) {
                $this->addAnd($key, $unitIds, $comparison);
            } else {
                $this->addAnd($key, $unitIds, $comparison);
            }
            $this->addOr($key, null, Criteria::ISNULL);

            return $this;
        }

        $this->addUsingAlias(UsersVersionTableMap::COL_UNIT_IDS, $unitIds, $comparison);

        return $this;
    }

    /**
     * Filter the query on the unit_versions column
     *
     * @param array $unitVersions The values to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUnitVersions($unitVersions = null, ?string $comparison = null)
    {
        $key = $this->getAliasedColName(UsersVersionTableMap::COL_UNIT_VERSIONS);
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            foreach ($unitVersions as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addAnd($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_SOME) {
            foreach ($unitVersions as $value) {
                $value = '%| ' . $value . ' |%';
                if ($this->containsKey($key)) {
                    $this->addOr($key, $value, Criteria::LIKE);
                } else {
                    $this->add($key, $value, Criteria::LIKE);
                }
            }

            return $this;
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            foreach ($unitVersions as $value) {
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

        $this->addUsingAlias(UsersVersionTableMap::COL_UNIT_VERSIONS, $unitVersions, $comparison);

        return $this;
    }

    /**
     * Filter the query on the unit_versions column
     * @param mixed $unitVersions The value to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::CONTAINS_ALL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUnitVersion($unitVersions = null, ?string $comparison = null)
    {
        if (null === $comparison || $comparison == Criteria::CONTAINS_ALL) {
            if (is_scalar($unitVersions)) {
                $unitVersions = '%| ' . $unitVersions . ' |%';
                $comparison = Criteria::LIKE;
            }
        } elseif ($comparison == Criteria::CONTAINS_NONE) {
            $unitVersions = '%| ' . $unitVersions . ' |%';
            $comparison = Criteria::NOT_LIKE;
            $key = $this->getAliasedColName(UsersVersionTableMap::COL_UNIT_VERSIONS);
            if ($this->containsKey($key)) {
                $this->addAnd($key, $unitVersions, $comparison);
            } else {
                $this->addAnd($key, $unitVersions, $comparison);
            }
            $this->addOr($key, null, Criteria::ISNULL);

            return $this;
        }

        $this->addUsingAlias(UsersVersionTableMap::COL_UNIT_VERSIONS, $unitVersions, $comparison);

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
                ->addUsingAlias(UsersVersionTableMap::COL_ID, $users->getId(), $comparison);
        } elseif ($users instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(UsersVersionTableMap::COL_ID, $users->toKeyValue('PrimaryKey', 'Id'), $comparison);

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
     * Exclude object from result
     *
     * @param ChildUsersVersion $usersVersion Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($usersVersion = null)
    {
        if ($usersVersion) {
            $this->addCond('pruneCond0', $this->getAliasedColName(UsersVersionTableMap::COL_ID), $usersVersion->getId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(UsersVersionTableMap::COL_VERSION), $usersVersion->getVersion(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the users_version table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsersVersionTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UsersVersionTableMap::clearInstancePool();
            UsersVersionTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(UsersVersionTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(UsersVersionTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            UsersVersionTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            UsersVersionTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
