<?php

namespace DB\Base;

use \Exception;
use \PDO;
use DB\Users as ChildUsers;
use DB\UsersQuery as ChildUsersQuery;
use DB\Map\UsersTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'users' table.
 *
 *
 *
 * @method     ChildUsersQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildUsersQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method     ChildUsersQuery orderByPhone($order = Criteria::ASC) Order by the phone column
 * @method     ChildUsersQuery orderByPassword($order = Criteria::ASC) Order by the password column
 * @method     ChildUsersQuery orderByUsername($order = Criteria::ASC) Order by the username column
 * @method     ChildUsersQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildUsersQuery orderByRoleId($order = Criteria::ASC) Order by the role_id column
 * @method     ChildUsersQuery orderByVerified($order = Criteria::ASC) Order by the verified column
 * @method     ChildUsersQuery orderByResettable($order = Criteria::ASC) Order by the resettable column
 * @method     ChildUsersQuery orderByRolesMask($order = Criteria::ASC) Order by the roles_mask column
 * @method     ChildUsersQuery orderByRegistered($order = Criteria::ASC) Order by the registered column
 * @method     ChildUsersQuery orderByLastLogin($order = Criteria::ASC) Order by the last_login column
 * @method     ChildUsersQuery orderByForceLogout($order = Criteria::ASC) Order by the force_logout column
 * @method     ChildUsersQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildUsersQuery orderBySurname($order = Criteria::ASC) Order by the surname column
 * @method     ChildUsersQuery orderByPatronymic($order = Criteria::ASC) Order by the patronymic column
 * @method     ChildUsersQuery orderByIsAvailable($order = Criteria::ASC) Order by the is_available column
 *
 * @method     ChildUsersQuery groupById() Group by the id column
 * @method     ChildUsersQuery groupByEmail() Group by the email column
 * @method     ChildUsersQuery groupByPhone() Group by the phone column
 * @method     ChildUsersQuery groupByPassword() Group by the password column
 * @method     ChildUsersQuery groupByUsername() Group by the username column
 * @method     ChildUsersQuery groupByStatus() Group by the status column
 * @method     ChildUsersQuery groupByRoleId() Group by the role_id column
 * @method     ChildUsersQuery groupByVerified() Group by the verified column
 * @method     ChildUsersQuery groupByResettable() Group by the resettable column
 * @method     ChildUsersQuery groupByRolesMask() Group by the roles_mask column
 * @method     ChildUsersQuery groupByRegistered() Group by the registered column
 * @method     ChildUsersQuery groupByLastLogin() Group by the last_login column
 * @method     ChildUsersQuery groupByForceLogout() Group by the force_logout column
 * @method     ChildUsersQuery groupByName() Group by the name column
 * @method     ChildUsersQuery groupBySurname() Group by the surname column
 * @method     ChildUsersQuery groupByPatronymic() Group by the patronymic column
 * @method     ChildUsersQuery groupByIsAvailable() Group by the is_available column
 *
 * @method     ChildUsersQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUsersQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUsersQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUsersQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildUsersQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildUsersQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildUsersQuery leftJoinRole($relationAlias = null) Adds a LEFT JOIN clause to the query using the Role relation
 * @method     ChildUsersQuery rightJoinRole($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Role relation
 * @method     ChildUsersQuery innerJoinRole($relationAlias = null) Adds a INNER JOIN clause to the query using the Role relation
 *
 * @method     ChildUsersQuery joinWithRole($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Role relation
 *
 * @method     ChildUsersQuery leftJoinWithRole() Adds a LEFT JOIN clause and with to the query using the Role relation
 * @method     ChildUsersQuery rightJoinWithRole() Adds a RIGHT JOIN clause and with to the query using the Role relation
 * @method     ChildUsersQuery innerJoinWithRole() Adds a INNER JOIN clause and with to the query using the Role relation
 *
 * @method     ChildUsersQuery leftJoinProjectRole($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProjectRole relation
 * @method     ChildUsersQuery rightJoinProjectRole($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProjectRole relation
 * @method     ChildUsersQuery innerJoinProjectRole($relationAlias = null) Adds a INNER JOIN clause to the query using the ProjectRole relation
 *
 * @method     ChildUsersQuery joinWithProjectRole($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProjectRole relation
 *
 * @method     ChildUsersQuery leftJoinWithProjectRole() Adds a LEFT JOIN clause and with to the query using the ProjectRole relation
 * @method     ChildUsersQuery rightJoinWithProjectRole() Adds a RIGHT JOIN clause and with to the query using the ProjectRole relation
 * @method     ChildUsersQuery innerJoinWithProjectRole() Adds a INNER JOIN clause and with to the query using the ProjectRole relation
 *
 * @method     \DB\RoleQuery|\DB\ProjectRoleQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildUsers|null findOne(?ConnectionInterface $con = null) Return the first ChildUsers matching the query
 * @method     ChildUsers findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildUsers matching the query, or a new ChildUsers object populated from the query conditions when no match is found
 *
 * @method     ChildUsers|null findOneById(int $id) Return the first ChildUsers filtered by the id column
 * @method     ChildUsers|null findOneByEmail(string $email) Return the first ChildUsers filtered by the email column
 * @method     ChildUsers|null findOneByPhone(string $phone) Return the first ChildUsers filtered by the phone column
 * @method     ChildUsers|null findOneByPassword(string $password) Return the first ChildUsers filtered by the password column
 * @method     ChildUsers|null findOneByUsername(string $username) Return the first ChildUsers filtered by the username column
 * @method     ChildUsers|null findOneByStatus(int $status) Return the first ChildUsers filtered by the status column
 * @method     ChildUsers|null findOneByRoleId(int $role_id) Return the first ChildUsers filtered by the role_id column
 * @method     ChildUsers|null findOneByVerified(boolean $verified) Return the first ChildUsers filtered by the verified column
 * @method     ChildUsers|null findOneByResettable(boolean $resettable) Return the first ChildUsers filtered by the resettable column
 * @method     ChildUsers|null findOneByRolesMask(int $roles_mask) Return the first ChildUsers filtered by the roles_mask column
 * @method     ChildUsers|null findOneByRegistered(int $registered) Return the first ChildUsers filtered by the registered column
 * @method     ChildUsers|null findOneByLastLogin(int $last_login) Return the first ChildUsers filtered by the last_login column
 * @method     ChildUsers|null findOneByForceLogout(int $force_logout) Return the first ChildUsers filtered by the force_logout column
 * @method     ChildUsers|null findOneByName(string $name) Return the first ChildUsers filtered by the name column
 * @method     ChildUsers|null findOneBySurname(string $surname) Return the first ChildUsers filtered by the surname column
 * @method     ChildUsers|null findOneByPatronymic(string $patronymic) Return the first ChildUsers filtered by the patronymic column
 * @method     ChildUsers|null findOneByIsAvailable(boolean $is_available) Return the first ChildUsers filtered by the is_available column *

 * @method     ChildUsers requirePk($key, ?ConnectionInterface $con = null) Return the ChildUsers by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOne(?ConnectionInterface $con = null) Return the first ChildUsers matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUsers requireOneById(int $id) Return the first ChildUsers filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByEmail(string $email) Return the first ChildUsers filtered by the email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByPhone(string $phone) Return the first ChildUsers filtered by the phone column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByPassword(string $password) Return the first ChildUsers filtered by the password column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByUsername(string $username) Return the first ChildUsers filtered by the username column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByStatus(int $status) Return the first ChildUsers filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByRoleId(int $role_id) Return the first ChildUsers filtered by the role_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByVerified(boolean $verified) Return the first ChildUsers filtered by the verified column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByResettable(boolean $resettable) Return the first ChildUsers filtered by the resettable column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByRolesMask(int $roles_mask) Return the first ChildUsers filtered by the roles_mask column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByRegistered(int $registered) Return the first ChildUsers filtered by the registered column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByLastLogin(int $last_login) Return the first ChildUsers filtered by the last_login column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByForceLogout(int $force_logout) Return the first ChildUsers filtered by the force_logout column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByName(string $name) Return the first ChildUsers filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneBySurname(string $surname) Return the first ChildUsers filtered by the surname column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByPatronymic(string $patronymic) Return the first ChildUsers filtered by the patronymic column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByIsAvailable(boolean $is_available) Return the first ChildUsers filtered by the is_available column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUsers[]|Collection find(?ConnectionInterface $con = null) Return ChildUsers objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildUsers> find(?ConnectionInterface $con = null) Return ChildUsers objects based on current ModelCriteria
 * @method     ChildUsers[]|Collection findById(int $id) Return ChildUsers objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildUsers> findById(int $id) Return ChildUsers objects filtered by the id column
 * @method     ChildUsers[]|Collection findByEmail(string $email) Return ChildUsers objects filtered by the email column
 * @psalm-method Collection&\Traversable<ChildUsers> findByEmail(string $email) Return ChildUsers objects filtered by the email column
 * @method     ChildUsers[]|Collection findByPhone(string $phone) Return ChildUsers objects filtered by the phone column
 * @psalm-method Collection&\Traversable<ChildUsers> findByPhone(string $phone) Return ChildUsers objects filtered by the phone column
 * @method     ChildUsers[]|Collection findByPassword(string $password) Return ChildUsers objects filtered by the password column
 * @psalm-method Collection&\Traversable<ChildUsers> findByPassword(string $password) Return ChildUsers objects filtered by the password column
 * @method     ChildUsers[]|Collection findByUsername(string $username) Return ChildUsers objects filtered by the username column
 * @psalm-method Collection&\Traversable<ChildUsers> findByUsername(string $username) Return ChildUsers objects filtered by the username column
 * @method     ChildUsers[]|Collection findByStatus(int $status) Return ChildUsers objects filtered by the status column
 * @psalm-method Collection&\Traversable<ChildUsers> findByStatus(int $status) Return ChildUsers objects filtered by the status column
 * @method     ChildUsers[]|Collection findByRoleId(int $role_id) Return ChildUsers objects filtered by the role_id column
 * @psalm-method Collection&\Traversable<ChildUsers> findByRoleId(int $role_id) Return ChildUsers objects filtered by the role_id column
 * @method     ChildUsers[]|Collection findByVerified(boolean $verified) Return ChildUsers objects filtered by the verified column
 * @psalm-method Collection&\Traversable<ChildUsers> findByVerified(boolean $verified) Return ChildUsers objects filtered by the verified column
 * @method     ChildUsers[]|Collection findByResettable(boolean $resettable) Return ChildUsers objects filtered by the resettable column
 * @psalm-method Collection&\Traversable<ChildUsers> findByResettable(boolean $resettable) Return ChildUsers objects filtered by the resettable column
 * @method     ChildUsers[]|Collection findByRolesMask(int $roles_mask) Return ChildUsers objects filtered by the roles_mask column
 * @psalm-method Collection&\Traversable<ChildUsers> findByRolesMask(int $roles_mask) Return ChildUsers objects filtered by the roles_mask column
 * @method     ChildUsers[]|Collection findByRegistered(int $registered) Return ChildUsers objects filtered by the registered column
 * @psalm-method Collection&\Traversable<ChildUsers> findByRegistered(int $registered) Return ChildUsers objects filtered by the registered column
 * @method     ChildUsers[]|Collection findByLastLogin(int $last_login) Return ChildUsers objects filtered by the last_login column
 * @psalm-method Collection&\Traversable<ChildUsers> findByLastLogin(int $last_login) Return ChildUsers objects filtered by the last_login column
 * @method     ChildUsers[]|Collection findByForceLogout(int $force_logout) Return ChildUsers objects filtered by the force_logout column
 * @psalm-method Collection&\Traversable<ChildUsers> findByForceLogout(int $force_logout) Return ChildUsers objects filtered by the force_logout column
 * @method     ChildUsers[]|Collection findByName(string $name) Return ChildUsers objects filtered by the name column
 * @psalm-method Collection&\Traversable<ChildUsers> findByName(string $name) Return ChildUsers objects filtered by the name column
 * @method     ChildUsers[]|Collection findBySurname(string $surname) Return ChildUsers objects filtered by the surname column
 * @psalm-method Collection&\Traversable<ChildUsers> findBySurname(string $surname) Return ChildUsers objects filtered by the surname column
 * @method     ChildUsers[]|Collection findByPatronymic(string $patronymic) Return ChildUsers objects filtered by the patronymic column
 * @psalm-method Collection&\Traversable<ChildUsers> findByPatronymic(string $patronymic) Return ChildUsers objects filtered by the patronymic column
 * @method     ChildUsers[]|Collection findByIsAvailable(boolean $is_available) Return ChildUsers objects filtered by the is_available column
 * @psalm-method Collection&\Traversable<ChildUsers> findByIsAvailable(boolean $is_available) Return ChildUsers objects filtered by the is_available column
 * @method     ChildUsers[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildUsers> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class UsersQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \DB\Base\UsersQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\DB\\Users', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildUsersQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildUsersQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildUsersQuery) {
            return $criteria;
        }
        $query = new ChildUsersQuery();
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
     * @return ChildUsers|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UsersTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = UsersTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildUsers A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, email, phone, password, username, status, role_id, verified, resettable, roles_mask, registered, last_login, force_logout, name, surname, patronymic, is_available FROM users WHERE id = :p0';
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
            /** @var ChildUsers $obj */
            $obj = new ChildUsers();
            $obj->hydrate($row);
            UsersTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildUsers|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(UsersTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(UsersTableMap::COL_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(UsersTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(UsersTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersTableMap::COL_ID, $id, $comparison);

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

        $this->addUsingAlias(UsersTableMap::COL_EMAIL, $email, $comparison);

        return $this;
    }

    /**
     * Filter the query on the phone column
     *
     * Example usage:
     * <code>
     * $query->filterByPhone('fooValue');   // WHERE phone = 'fooValue'
     * $query->filterByPhone('%fooValue%', Criteria::LIKE); // WHERE phone LIKE '%fooValue%'
     * $query->filterByPhone(['foo', 'bar']); // WHERE phone IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $phone The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPhone($phone = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($phone)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersTableMap::COL_PHONE, $phone, $comparison);

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

        $this->addUsingAlias(UsersTableMap::COL_PASSWORD, $password, $comparison);

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

        $this->addUsingAlias(UsersTableMap::COL_USERNAME, $username, $comparison);

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
                $this->addUsingAlias(UsersTableMap::COL_STATUS, $status['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($status['max'])) {
                $this->addUsingAlias(UsersTableMap::COL_STATUS, $status['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersTableMap::COL_STATUS, $status, $comparison);

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
                $this->addUsingAlias(UsersTableMap::COL_ROLE_ID, $roleId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($roleId['max'])) {
                $this->addUsingAlias(UsersTableMap::COL_ROLE_ID, $roleId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersTableMap::COL_ROLE_ID, $roleId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the verified column
     *
     * Example usage:
     * <code>
     * $query->filterByVerified(true); // WHERE verified = true
     * $query->filterByVerified('yes'); // WHERE verified = true
     * </code>
     *
     * @param bool|string $verified The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByVerified($verified = null, ?string $comparison = null)
    {
        if (is_string($verified)) {
            $verified = in_array(strtolower($verified), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        $this->addUsingAlias(UsersTableMap::COL_VERIFIED, $verified, $comparison);

        return $this;
    }

    /**
     * Filter the query on the resettable column
     *
     * Example usage:
     * <code>
     * $query->filterByResettable(true); // WHERE resettable = true
     * $query->filterByResettable('yes'); // WHERE resettable = true
     * </code>
     *
     * @param bool|string $resettable The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByResettable($resettable = null, ?string $comparison = null)
    {
        if (is_string($resettable)) {
            $resettable = in_array(strtolower($resettable), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        $this->addUsingAlias(UsersTableMap::COL_RESETTABLE, $resettable, $comparison);

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
                $this->addUsingAlias(UsersTableMap::COL_ROLES_MASK, $rolesMask['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($rolesMask['max'])) {
                $this->addUsingAlias(UsersTableMap::COL_ROLES_MASK, $rolesMask['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersTableMap::COL_ROLES_MASK, $rolesMask, $comparison);

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
                $this->addUsingAlias(UsersTableMap::COL_REGISTERED, $registered['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($registered['max'])) {
                $this->addUsingAlias(UsersTableMap::COL_REGISTERED, $registered['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersTableMap::COL_REGISTERED, $registered, $comparison);

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
                $this->addUsingAlias(UsersTableMap::COL_LAST_LOGIN, $lastLogin['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastLogin['max'])) {
                $this->addUsingAlias(UsersTableMap::COL_LAST_LOGIN, $lastLogin['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersTableMap::COL_LAST_LOGIN, $lastLogin, $comparison);

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
                $this->addUsingAlias(UsersTableMap::COL_FORCE_LOGOUT, $forceLogout['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($forceLogout['max'])) {
                $this->addUsingAlias(UsersTableMap::COL_FORCE_LOGOUT, $forceLogout['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersTableMap::COL_FORCE_LOGOUT, $forceLogout, $comparison);

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

        $this->addUsingAlias(UsersTableMap::COL_NAME, $name, $comparison);

        return $this;
    }

    /**
     * Filter the query on the surname column
     *
     * Example usage:
     * <code>
     * $query->filterBySurname('fooValue');   // WHERE surname = 'fooValue'
     * $query->filterBySurname('%fooValue%', Criteria::LIKE); // WHERE surname LIKE '%fooValue%'
     * $query->filterBySurname(['foo', 'bar']); // WHERE surname IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $surname The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySurname($surname = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($surname)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersTableMap::COL_SURNAME, $surname, $comparison);

        return $this;
    }

    /**
     * Filter the query on the patronymic column
     *
     * Example usage:
     * <code>
     * $query->filterByPatronymic('fooValue');   // WHERE patronymic = 'fooValue'
     * $query->filterByPatronymic('%fooValue%', Criteria::LIKE); // WHERE patronymic LIKE '%fooValue%'
     * $query->filterByPatronymic(['foo', 'bar']); // WHERE patronymic IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $patronymic The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPatronymic($patronymic = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($patronymic)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersTableMap::COL_PATRONYMIC, $patronymic, $comparison);

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

        $this->addUsingAlias(UsersTableMap::COL_IS_AVAILABLE, $isAvailable, $comparison);

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
                ->addUsingAlias(UsersTableMap::COL_ROLE_ID, $role->getId(), $comparison);
        } elseif ($role instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(UsersTableMap::COL_ROLE_ID, $role->toKeyValue('PrimaryKey', 'Id'), $comparison);

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
     * Filter the query by a related \DB\ProjectRole object
     *
     * @param \DB\ProjectRole|ObjectCollection $projectRole the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProjectRole($projectRole, ?string $comparison = null)
    {
        if ($projectRole instanceof \DB\ProjectRole) {
            $this
                ->addUsingAlias(UsersTableMap::COL_ID, $projectRole->getUserId(), $comparison);

            return $this;
        } elseif ($projectRole instanceof ObjectCollection) {
            $this
                ->useProjectRoleQuery()
                ->filterByPrimaryKeys($projectRole->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByProjectRole() only accepts arguments of type \DB\ProjectRole or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProjectRole relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinProjectRole(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProjectRole');

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
            $this->addJoinObject($join, 'ProjectRole');
        }

        return $this;
    }

    /**
     * Use the ProjectRole relation ProjectRole object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\ProjectRoleQuery A secondary query class using the current class as primary query
     */
    public function useProjectRoleQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProjectRole($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProjectRole', '\DB\ProjectRoleQuery');
    }

    /**
     * Use the ProjectRole relation ProjectRole object
     *
     * @param callable(\DB\ProjectRoleQuery):\DB\ProjectRoleQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withProjectRoleQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useProjectRoleQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to ProjectRole table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\ProjectRoleQuery The inner query object of the EXISTS statement
     */
    public function useProjectRoleExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('ProjectRole', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to ProjectRole table for a NOT EXISTS query.
     *
     * @see useProjectRoleExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\ProjectRoleQuery The inner query object of the NOT EXISTS statement
     */
    public function useProjectRoleNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('ProjectRole', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Exclude object from result
     *
     * @param ChildUsers $users Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($users = null)
    {
        if ($users) {
            $this->addUsingAlias(UsersTableMap::COL_ID, $users->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the users table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsersTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UsersTableMap::clearInstancePool();
            UsersTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(UsersTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(UsersTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            UsersTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            UsersTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
