<?php

namespace DB\Base;

use \Exception;
use \PDO;
use DB\UsersResetsVersion as ChildUsersResetsVersion;
use DB\UsersResetsVersionQuery as ChildUsersResetsVersionQuery;
use DB\Map\UsersResetsVersionTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'users_resets_version' table.
 *
 *
 *
 * @method     ChildUsersResetsVersionQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildUsersResetsVersionQuery orderByUser($order = Criteria::ASC) Order by the user column
 * @method     ChildUsersResetsVersionQuery orderBySelector($order = Criteria::ASC) Order by the selector column
 * @method     ChildUsersResetsVersionQuery orderByToken($order = Criteria::ASC) Order by the token column
 * @method     ChildUsersResetsVersionQuery orderByExpires($order = Criteria::ASC) Order by the expires column
 * @method     ChildUsersResetsVersionQuery orderByVersion($order = Criteria::ASC) Order by the version column
 *
 * @method     ChildUsersResetsVersionQuery groupById() Group by the id column
 * @method     ChildUsersResetsVersionQuery groupByUser() Group by the user column
 * @method     ChildUsersResetsVersionQuery groupBySelector() Group by the selector column
 * @method     ChildUsersResetsVersionQuery groupByToken() Group by the token column
 * @method     ChildUsersResetsVersionQuery groupByExpires() Group by the expires column
 * @method     ChildUsersResetsVersionQuery groupByVersion() Group by the version column
 *
 * @method     ChildUsersResetsVersionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUsersResetsVersionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUsersResetsVersionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUsersResetsVersionQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildUsersResetsVersionQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildUsersResetsVersionQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildUsersResetsVersionQuery leftJoinUsersResets($relationAlias = null) Adds a LEFT JOIN clause to the query using the UsersResets relation
 * @method     ChildUsersResetsVersionQuery rightJoinUsersResets($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UsersResets relation
 * @method     ChildUsersResetsVersionQuery innerJoinUsersResets($relationAlias = null) Adds a INNER JOIN clause to the query using the UsersResets relation
 *
 * @method     ChildUsersResetsVersionQuery joinWithUsersResets($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the UsersResets relation
 *
 * @method     ChildUsersResetsVersionQuery leftJoinWithUsersResets() Adds a LEFT JOIN clause and with to the query using the UsersResets relation
 * @method     ChildUsersResetsVersionQuery rightJoinWithUsersResets() Adds a RIGHT JOIN clause and with to the query using the UsersResets relation
 * @method     ChildUsersResetsVersionQuery innerJoinWithUsersResets() Adds a INNER JOIN clause and with to the query using the UsersResets relation
 *
 * @method     \DB\UsersResetsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildUsersResetsVersion|null findOne(?ConnectionInterface $con = null) Return the first ChildUsersResetsVersion matching the query
 * @method     ChildUsersResetsVersion findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildUsersResetsVersion matching the query, or a new ChildUsersResetsVersion object populated from the query conditions when no match is found
 *
 * @method     ChildUsersResetsVersion|null findOneById(string $id) Return the first ChildUsersResetsVersion filtered by the id column
 * @method     ChildUsersResetsVersion|null findOneByUser(int $user) Return the first ChildUsersResetsVersion filtered by the user column
 * @method     ChildUsersResetsVersion|null findOneBySelector(string $selector) Return the first ChildUsersResetsVersion filtered by the selector column
 * @method     ChildUsersResetsVersion|null findOneByToken(string $token) Return the first ChildUsersResetsVersion filtered by the token column
 * @method     ChildUsersResetsVersion|null findOneByExpires(int $expires) Return the first ChildUsersResetsVersion filtered by the expires column
 * @method     ChildUsersResetsVersion|null findOneByVersion(int $version) Return the first ChildUsersResetsVersion filtered by the version column *

 * @method     ChildUsersResetsVersion requirePk($key, ?ConnectionInterface $con = null) Return the ChildUsersResetsVersion by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersResetsVersion requireOne(?ConnectionInterface $con = null) Return the first ChildUsersResetsVersion matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUsersResetsVersion requireOneById(string $id) Return the first ChildUsersResetsVersion filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersResetsVersion requireOneByUser(int $user) Return the first ChildUsersResetsVersion filtered by the user column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersResetsVersion requireOneBySelector(string $selector) Return the first ChildUsersResetsVersion filtered by the selector column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersResetsVersion requireOneByToken(string $token) Return the first ChildUsersResetsVersion filtered by the token column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersResetsVersion requireOneByExpires(int $expires) Return the first ChildUsersResetsVersion filtered by the expires column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersResetsVersion requireOneByVersion(int $version) Return the first ChildUsersResetsVersion filtered by the version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUsersResetsVersion[]|Collection find(?ConnectionInterface $con = null) Return ChildUsersResetsVersion objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildUsersResetsVersion> find(?ConnectionInterface $con = null) Return ChildUsersResetsVersion objects based on current ModelCriteria
 * @method     ChildUsersResetsVersion[]|Collection findById(string $id) Return ChildUsersResetsVersion objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildUsersResetsVersion> findById(string $id) Return ChildUsersResetsVersion objects filtered by the id column
 * @method     ChildUsersResetsVersion[]|Collection findByUser(int $user) Return ChildUsersResetsVersion objects filtered by the user column
 * @psalm-method Collection&\Traversable<ChildUsersResetsVersion> findByUser(int $user) Return ChildUsersResetsVersion objects filtered by the user column
 * @method     ChildUsersResetsVersion[]|Collection findBySelector(string $selector) Return ChildUsersResetsVersion objects filtered by the selector column
 * @psalm-method Collection&\Traversable<ChildUsersResetsVersion> findBySelector(string $selector) Return ChildUsersResetsVersion objects filtered by the selector column
 * @method     ChildUsersResetsVersion[]|Collection findByToken(string $token) Return ChildUsersResetsVersion objects filtered by the token column
 * @psalm-method Collection&\Traversable<ChildUsersResetsVersion> findByToken(string $token) Return ChildUsersResetsVersion objects filtered by the token column
 * @method     ChildUsersResetsVersion[]|Collection findByExpires(int $expires) Return ChildUsersResetsVersion objects filtered by the expires column
 * @psalm-method Collection&\Traversable<ChildUsersResetsVersion> findByExpires(int $expires) Return ChildUsersResetsVersion objects filtered by the expires column
 * @method     ChildUsersResetsVersion[]|Collection findByVersion(int $version) Return ChildUsersResetsVersion objects filtered by the version column
 * @psalm-method Collection&\Traversable<ChildUsersResetsVersion> findByVersion(int $version) Return ChildUsersResetsVersion objects filtered by the version column
 * @method     ChildUsersResetsVersion[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildUsersResetsVersion> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class UsersResetsVersionQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \DB\Base\UsersResetsVersionQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\DB\\UsersResetsVersion', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildUsersResetsVersionQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildUsersResetsVersionQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildUsersResetsVersionQuery) {
            return $criteria;
        }
        $query = new ChildUsersResetsVersionQuery();
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
     * @return ChildUsersResetsVersion|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UsersResetsVersionTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = UsersResetsVersionTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildUsersResetsVersion A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, user, selector, token, expires, version FROM users_resets_version WHERE id = :p0 AND version = :p1';
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
            /** @var ChildUsersResetsVersion $obj */
            $obj = new ChildUsersResetsVersion();
            $obj->hydrate($row);
            UsersResetsVersionTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildUsersResetsVersion|array|mixed the result, formatted by the current formatter
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
        $this->addUsingAlias(UsersResetsVersionTableMap::COL_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(UsersResetsVersionTableMap::COL_VERSION, $key[1], Criteria::EQUAL);

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
            $cton0 = $this->getNewCriterion(UsersResetsVersionTableMap::COL_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(UsersResetsVersionTableMap::COL_VERSION, $key[1], Criteria::EQUAL);
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
     * @see       filterByUsersResets()
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
                $this->addUsingAlias(UsersResetsVersionTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(UsersResetsVersionTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersResetsVersionTableMap::COL_ID, $id, $comparison);

        return $this;
    }

    /**
     * Filter the query on the user column
     *
     * Example usage:
     * <code>
     * $query->filterByUser(1234); // WHERE user = 1234
     * $query->filterByUser(array(12, 34)); // WHERE user IN (12, 34)
     * $query->filterByUser(array('min' => 12)); // WHERE user > 12
     * </code>
     *
     * @param mixed $user The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUser($user = null, ?string $comparison = null)
    {
        if (is_array($user)) {
            $useMinMax = false;
            if (isset($user['min'])) {
                $this->addUsingAlias(UsersResetsVersionTableMap::COL_USER, $user['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($user['max'])) {
                $this->addUsingAlias(UsersResetsVersionTableMap::COL_USER, $user['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersResetsVersionTableMap::COL_USER, $user, $comparison);

        return $this;
    }

    /**
     * Filter the query on the selector column
     *
     * Example usage:
     * <code>
     * $query->filterBySelector('fooValue');   // WHERE selector = 'fooValue'
     * $query->filterBySelector('%fooValue%', Criteria::LIKE); // WHERE selector LIKE '%fooValue%'
     * $query->filterBySelector(['foo', 'bar']); // WHERE selector IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $selector The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySelector($selector = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($selector)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersResetsVersionTableMap::COL_SELECTOR, $selector, $comparison);

        return $this;
    }

    /**
     * Filter the query on the token column
     *
     * Example usage:
     * <code>
     * $query->filterByToken('fooValue');   // WHERE token = 'fooValue'
     * $query->filterByToken('%fooValue%', Criteria::LIKE); // WHERE token LIKE '%fooValue%'
     * $query->filterByToken(['foo', 'bar']); // WHERE token IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $token The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByToken($token = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($token)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersResetsVersionTableMap::COL_TOKEN, $token, $comparison);

        return $this;
    }

    /**
     * Filter the query on the expires column
     *
     * Example usage:
     * <code>
     * $query->filterByExpires(1234); // WHERE expires = 1234
     * $query->filterByExpires(array(12, 34)); // WHERE expires IN (12, 34)
     * $query->filterByExpires(array('min' => 12)); // WHERE expires > 12
     * </code>
     *
     * @param mixed $expires The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpires($expires = null, ?string $comparison = null)
    {
        if (is_array($expires)) {
            $useMinMax = false;
            if (isset($expires['min'])) {
                $this->addUsingAlias(UsersResetsVersionTableMap::COL_EXPIRES, $expires['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($expires['max'])) {
                $this->addUsingAlias(UsersResetsVersionTableMap::COL_EXPIRES, $expires['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersResetsVersionTableMap::COL_EXPIRES, $expires, $comparison);

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
                $this->addUsingAlias(UsersResetsVersionTableMap::COL_VERSION, $version['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($version['max'])) {
                $this->addUsingAlias(UsersResetsVersionTableMap::COL_VERSION, $version['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersResetsVersionTableMap::COL_VERSION, $version, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \DB\UsersResets object
     *
     * @param \DB\UsersResets|ObjectCollection $usersResets The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUsersResets($usersResets, ?string $comparison = null)
    {
        if ($usersResets instanceof \DB\UsersResets) {
            return $this
                ->addUsingAlias(UsersResetsVersionTableMap::COL_ID, $usersResets->getId(), $comparison);
        } elseif ($usersResets instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(UsersResetsVersionTableMap::COL_ID, $usersResets->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByUsersResets() only accepts arguments of type \DB\UsersResets or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UsersResets relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinUsersResets(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UsersResets');

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
            $this->addJoinObject($join, 'UsersResets');
        }

        return $this;
    }

    /**
     * Use the UsersResets relation UsersResets object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\UsersResetsQuery A secondary query class using the current class as primary query
     */
    public function useUsersResetsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUsersResets($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UsersResets', '\DB\UsersResetsQuery');
    }

    /**
     * Use the UsersResets relation UsersResets object
     *
     * @param callable(\DB\UsersResetsQuery):\DB\UsersResetsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withUsersResetsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useUsersResetsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to UsersResets table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\UsersResetsQuery The inner query object of the EXISTS statement
     */
    public function useUsersResetsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('UsersResets', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to UsersResets table for a NOT EXISTS query.
     *
     * @see useUsersResetsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\UsersResetsQuery The inner query object of the NOT EXISTS statement
     */
    public function useUsersResetsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('UsersResets', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Exclude object from result
     *
     * @param ChildUsersResetsVersion $usersResetsVersion Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($usersResetsVersion = null)
    {
        if ($usersResetsVersion) {
            $this->addCond('pruneCond0', $this->getAliasedColName(UsersResetsVersionTableMap::COL_ID), $usersResetsVersion->getId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(UsersResetsVersionTableMap::COL_VERSION), $usersResetsVersion->getVersion(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the users_resets_version table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsersResetsVersionTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UsersResetsVersionTableMap::clearInstancePool();
            UsersResetsVersionTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(UsersResetsVersionTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(UsersResetsVersionTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            UsersResetsVersionTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            UsersResetsVersionTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
