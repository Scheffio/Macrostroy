<?php

namespace DB\Base;

use \Exception;
use \PDO;
use DB\UsersThrottlingVersion as ChildUsersThrottlingVersion;
use DB\UsersThrottlingVersionQuery as ChildUsersThrottlingVersionQuery;
use DB\Map\UsersThrottlingVersionTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'users_throttling_version' table.
 *
 *
 *
 * @method     ChildUsersThrottlingVersionQuery orderByBucket($order = Criteria::ASC) Order by the bucket column
 * @method     ChildUsersThrottlingVersionQuery orderByTokens($order = Criteria::ASC) Order by the tokens column
 * @method     ChildUsersThrottlingVersionQuery orderByReplenishedAt($order = Criteria::ASC) Order by the replenished_at column
 * @method     ChildUsersThrottlingVersionQuery orderByExpiresAt($order = Criteria::ASC) Order by the expires_at column
 * @method     ChildUsersThrottlingVersionQuery orderByVersion($order = Criteria::ASC) Order by the version column
 *
 * @method     ChildUsersThrottlingVersionQuery groupByBucket() Group by the bucket column
 * @method     ChildUsersThrottlingVersionQuery groupByTokens() Group by the tokens column
 * @method     ChildUsersThrottlingVersionQuery groupByReplenishedAt() Group by the replenished_at column
 * @method     ChildUsersThrottlingVersionQuery groupByExpiresAt() Group by the expires_at column
 * @method     ChildUsersThrottlingVersionQuery groupByVersion() Group by the version column
 *
 * @method     ChildUsersThrottlingVersionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUsersThrottlingVersionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUsersThrottlingVersionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUsersThrottlingVersionQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildUsersThrottlingVersionQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildUsersThrottlingVersionQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildUsersThrottlingVersionQuery leftJoinUsersThrottling($relationAlias = null) Adds a LEFT JOIN clause to the query using the UsersThrottling relation
 * @method     ChildUsersThrottlingVersionQuery rightJoinUsersThrottling($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UsersThrottling relation
 * @method     ChildUsersThrottlingVersionQuery innerJoinUsersThrottling($relationAlias = null) Adds a INNER JOIN clause to the query using the UsersThrottling relation
 *
 * @method     ChildUsersThrottlingVersionQuery joinWithUsersThrottling($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the UsersThrottling relation
 *
 * @method     ChildUsersThrottlingVersionQuery leftJoinWithUsersThrottling() Adds a LEFT JOIN clause and with to the query using the UsersThrottling relation
 * @method     ChildUsersThrottlingVersionQuery rightJoinWithUsersThrottling() Adds a RIGHT JOIN clause and with to the query using the UsersThrottling relation
 * @method     ChildUsersThrottlingVersionQuery innerJoinWithUsersThrottling() Adds a INNER JOIN clause and with to the query using the UsersThrottling relation
 *
 * @method     \DB\UsersThrottlingQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildUsersThrottlingVersion|null findOne(?ConnectionInterface $con = null) Return the first ChildUsersThrottlingVersion matching the query
 * @method     ChildUsersThrottlingVersion findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildUsersThrottlingVersion matching the query, or a new ChildUsersThrottlingVersion object populated from the query conditions when no match is found
 *
 * @method     ChildUsersThrottlingVersion|null findOneByBucket(string $bucket) Return the first ChildUsersThrottlingVersion filtered by the bucket column
 * @method     ChildUsersThrottlingVersion|null findOneByTokens(double $tokens) Return the first ChildUsersThrottlingVersion filtered by the tokens column
 * @method     ChildUsersThrottlingVersion|null findOneByReplenishedAt(int $replenished_at) Return the first ChildUsersThrottlingVersion filtered by the replenished_at column
 * @method     ChildUsersThrottlingVersion|null findOneByExpiresAt(int $expires_at) Return the first ChildUsersThrottlingVersion filtered by the expires_at column
 * @method     ChildUsersThrottlingVersion|null findOneByVersion(int $version) Return the first ChildUsersThrottlingVersion filtered by the version column *

 * @method     ChildUsersThrottlingVersion requirePk($key, ?ConnectionInterface $con = null) Return the ChildUsersThrottlingVersion by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersThrottlingVersion requireOne(?ConnectionInterface $con = null) Return the first ChildUsersThrottlingVersion matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUsersThrottlingVersion requireOneByBucket(string $bucket) Return the first ChildUsersThrottlingVersion filtered by the bucket column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersThrottlingVersion requireOneByTokens(double $tokens) Return the first ChildUsersThrottlingVersion filtered by the tokens column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersThrottlingVersion requireOneByReplenishedAt(int $replenished_at) Return the first ChildUsersThrottlingVersion filtered by the replenished_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersThrottlingVersion requireOneByExpiresAt(int $expires_at) Return the first ChildUsersThrottlingVersion filtered by the expires_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersThrottlingVersion requireOneByVersion(int $version) Return the first ChildUsersThrottlingVersion filtered by the version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUsersThrottlingVersion[]|Collection find(?ConnectionInterface $con = null) Return ChildUsersThrottlingVersion objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildUsersThrottlingVersion> find(?ConnectionInterface $con = null) Return ChildUsersThrottlingVersion objects based on current ModelCriteria
 * @method     ChildUsersThrottlingVersion[]|Collection findByBucket(string $bucket) Return ChildUsersThrottlingVersion objects filtered by the bucket column
 * @psalm-method Collection&\Traversable<ChildUsersThrottlingVersion> findByBucket(string $bucket) Return ChildUsersThrottlingVersion objects filtered by the bucket column
 * @method     ChildUsersThrottlingVersion[]|Collection findByTokens(double $tokens) Return ChildUsersThrottlingVersion objects filtered by the tokens column
 * @psalm-method Collection&\Traversable<ChildUsersThrottlingVersion> findByTokens(double $tokens) Return ChildUsersThrottlingVersion objects filtered by the tokens column
 * @method     ChildUsersThrottlingVersion[]|Collection findByReplenishedAt(int $replenished_at) Return ChildUsersThrottlingVersion objects filtered by the replenished_at column
 * @psalm-method Collection&\Traversable<ChildUsersThrottlingVersion> findByReplenishedAt(int $replenished_at) Return ChildUsersThrottlingVersion objects filtered by the replenished_at column
 * @method     ChildUsersThrottlingVersion[]|Collection findByExpiresAt(int $expires_at) Return ChildUsersThrottlingVersion objects filtered by the expires_at column
 * @psalm-method Collection&\Traversable<ChildUsersThrottlingVersion> findByExpiresAt(int $expires_at) Return ChildUsersThrottlingVersion objects filtered by the expires_at column
 * @method     ChildUsersThrottlingVersion[]|Collection findByVersion(int $version) Return ChildUsersThrottlingVersion objects filtered by the version column
 * @psalm-method Collection&\Traversable<ChildUsersThrottlingVersion> findByVersion(int $version) Return ChildUsersThrottlingVersion objects filtered by the version column
 * @method     ChildUsersThrottlingVersion[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildUsersThrottlingVersion> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class UsersThrottlingVersionQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \DB\Base\UsersThrottlingVersionQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\DB\\UsersThrottlingVersion', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildUsersThrottlingVersionQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildUsersThrottlingVersionQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildUsersThrottlingVersionQuery) {
            return $criteria;
        }
        $query = new ChildUsersThrottlingVersionQuery();
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
     * @param array[$bucket, $version] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildUsersThrottlingVersion|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UsersThrottlingVersionTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = UsersThrottlingVersionTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildUsersThrottlingVersion A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT bucket, tokens, replenished_at, expires_at, version FROM users_throttling_version WHERE bucket = :p0 AND version = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_STR);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildUsersThrottlingVersion $obj */
            $obj = new ChildUsersThrottlingVersion();
            $obj->hydrate($row);
            UsersThrottlingVersionTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildUsersThrottlingVersion|array|mixed the result, formatted by the current formatter
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
        $this->addUsingAlias(UsersThrottlingVersionTableMap::COL_BUCKET, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(UsersThrottlingVersionTableMap::COL_VERSION, $key[1], Criteria::EQUAL);

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
            $cton0 = $this->getNewCriterion(UsersThrottlingVersionTableMap::COL_BUCKET, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(UsersThrottlingVersionTableMap::COL_VERSION, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the bucket column
     *
     * Example usage:
     * <code>
     * $query->filterByBucket('fooValue');   // WHERE bucket = 'fooValue'
     * $query->filterByBucket('%fooValue%', Criteria::LIKE); // WHERE bucket LIKE '%fooValue%'
     * $query->filterByBucket(['foo', 'bar']); // WHERE bucket IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $bucket The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBucket($bucket = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($bucket)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersThrottlingVersionTableMap::COL_BUCKET, $bucket, $comparison);

        return $this;
    }

    /**
     * Filter the query on the tokens column
     *
     * Example usage:
     * <code>
     * $query->filterByTokens(1234); // WHERE tokens = 1234
     * $query->filterByTokens(array(12, 34)); // WHERE tokens IN (12, 34)
     * $query->filterByTokens(array('min' => 12)); // WHERE tokens > 12
     * </code>
     *
     * @param mixed $tokens The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTokens($tokens = null, ?string $comparison = null)
    {
        if (is_array($tokens)) {
            $useMinMax = false;
            if (isset($tokens['min'])) {
                $this->addUsingAlias(UsersThrottlingVersionTableMap::COL_TOKENS, $tokens['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($tokens['max'])) {
                $this->addUsingAlias(UsersThrottlingVersionTableMap::COL_TOKENS, $tokens['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersThrottlingVersionTableMap::COL_TOKENS, $tokens, $comparison);

        return $this;
    }

    /**
     * Filter the query on the replenished_at column
     *
     * Example usage:
     * <code>
     * $query->filterByReplenishedAt(1234); // WHERE replenished_at = 1234
     * $query->filterByReplenishedAt(array(12, 34)); // WHERE replenished_at IN (12, 34)
     * $query->filterByReplenishedAt(array('min' => 12)); // WHERE replenished_at > 12
     * </code>
     *
     * @param mixed $replenishedAt The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByReplenishedAt($replenishedAt = null, ?string $comparison = null)
    {
        if (is_array($replenishedAt)) {
            $useMinMax = false;
            if (isset($replenishedAt['min'])) {
                $this->addUsingAlias(UsersThrottlingVersionTableMap::COL_REPLENISHED_AT, $replenishedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($replenishedAt['max'])) {
                $this->addUsingAlias(UsersThrottlingVersionTableMap::COL_REPLENISHED_AT, $replenishedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersThrottlingVersionTableMap::COL_REPLENISHED_AT, $replenishedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the expires_at column
     *
     * Example usage:
     * <code>
     * $query->filterByExpiresAt(1234); // WHERE expires_at = 1234
     * $query->filterByExpiresAt(array(12, 34)); // WHERE expires_at IN (12, 34)
     * $query->filterByExpiresAt(array('min' => 12)); // WHERE expires_at > 12
     * </code>
     *
     * @param mixed $expiresAt The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpiresAt($expiresAt = null, ?string $comparison = null)
    {
        if (is_array($expiresAt)) {
            $useMinMax = false;
            if (isset($expiresAt['min'])) {
                $this->addUsingAlias(UsersThrottlingVersionTableMap::COL_EXPIRES_AT, $expiresAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($expiresAt['max'])) {
                $this->addUsingAlias(UsersThrottlingVersionTableMap::COL_EXPIRES_AT, $expiresAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersThrottlingVersionTableMap::COL_EXPIRES_AT, $expiresAt, $comparison);

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
                $this->addUsingAlias(UsersThrottlingVersionTableMap::COL_VERSION, $version['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($version['max'])) {
                $this->addUsingAlias(UsersThrottlingVersionTableMap::COL_VERSION, $version['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersThrottlingVersionTableMap::COL_VERSION, $version, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \DB\UsersThrottling object
     *
     * @param \DB\UsersThrottling|ObjectCollection $usersThrottling The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUsersThrottling($usersThrottling, ?string $comparison = null)
    {
        if ($usersThrottling instanceof \DB\UsersThrottling) {
            return $this
                ->addUsingAlias(UsersThrottlingVersionTableMap::COL_BUCKET, $usersThrottling->getBucket(), $comparison);
        } elseif ($usersThrottling instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(UsersThrottlingVersionTableMap::COL_BUCKET, $usersThrottling->toKeyValue('PrimaryKey', 'Bucket'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByUsersThrottling() only accepts arguments of type \DB\UsersThrottling or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UsersThrottling relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinUsersThrottling(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UsersThrottling');

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
            $this->addJoinObject($join, 'UsersThrottling');
        }

        return $this;
    }

    /**
     * Use the UsersThrottling relation UsersThrottling object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\UsersThrottlingQuery A secondary query class using the current class as primary query
     */
    public function useUsersThrottlingQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUsersThrottling($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UsersThrottling', '\DB\UsersThrottlingQuery');
    }

    /**
     * Use the UsersThrottling relation UsersThrottling object
     *
     * @param callable(\DB\UsersThrottlingQuery):\DB\UsersThrottlingQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withUsersThrottlingQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useUsersThrottlingQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to UsersThrottling table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\UsersThrottlingQuery The inner query object of the EXISTS statement
     */
    public function useUsersThrottlingExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('UsersThrottling', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to UsersThrottling table for a NOT EXISTS query.
     *
     * @see useUsersThrottlingExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\UsersThrottlingQuery The inner query object of the NOT EXISTS statement
     */
    public function useUsersThrottlingNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('UsersThrottling', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Exclude object from result
     *
     * @param ChildUsersThrottlingVersion $usersThrottlingVersion Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($usersThrottlingVersion = null)
    {
        if ($usersThrottlingVersion) {
            $this->addCond('pruneCond0', $this->getAliasedColName(UsersThrottlingVersionTableMap::COL_BUCKET), $usersThrottlingVersion->getBucket(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(UsersThrottlingVersionTableMap::COL_VERSION), $usersThrottlingVersion->getVersion(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the users_throttling_version table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsersThrottlingVersionTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UsersThrottlingVersionTableMap::clearInstancePool();
            UsersThrottlingVersionTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(UsersThrottlingVersionTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(UsersThrottlingVersionTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            UsersThrottlingVersionTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            UsersThrottlingVersionTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
