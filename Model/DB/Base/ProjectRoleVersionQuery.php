<?php

namespace DB\Base;

use \Exception;
use \PDO;
use DB\ProjectRoleVersion as ChildProjectRoleVersion;
use DB\ProjectRoleVersionQuery as ChildProjectRoleVersionQuery;
use DB\Map\ProjectRoleVersionTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'project_role_version' table.
 *
 *
 *
 * @method     ChildProjectRoleVersionQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildProjectRoleVersionQuery orderByLvl($order = Criteria::ASC) Order by the lvl column
 * @method     ChildProjectRoleVersionQuery orderByRoleId($order = Criteria::ASC) Order by the role_id column
 * @method     ChildProjectRoleVersionQuery orderByProjectId($order = Criteria::ASC) Order by the project_id column
 * @method     ChildProjectRoleVersionQuery orderByObjectId($order = Criteria::ASC) Order by the object_id column
 * @method     ChildProjectRoleVersionQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     ChildProjectRoleVersionQuery orderByVersion($order = Criteria::ASC) Order by the version column
 * @method     ChildProjectRoleVersionQuery orderByVersionCreatedAt($order = Criteria::ASC) Order by the version_created_at column
 * @method     ChildProjectRoleVersionQuery orderByVersionCreatedBy($order = Criteria::ASC) Order by the version_created_by column
 * @method     ChildProjectRoleVersionQuery orderByVersionComment($order = Criteria::ASC) Order by the version_comment column
 * @method     ChildProjectRoleVersionQuery orderByProjectIdVersion($order = Criteria::ASC) Order by the project_id_version column
 *
 * @method     ChildProjectRoleVersionQuery groupById() Group by the id column
 * @method     ChildProjectRoleVersionQuery groupByLvl() Group by the lvl column
 * @method     ChildProjectRoleVersionQuery groupByRoleId() Group by the role_id column
 * @method     ChildProjectRoleVersionQuery groupByProjectId() Group by the project_id column
 * @method     ChildProjectRoleVersionQuery groupByObjectId() Group by the object_id column
 * @method     ChildProjectRoleVersionQuery groupByUserId() Group by the user_id column
 * @method     ChildProjectRoleVersionQuery groupByVersion() Group by the version column
 * @method     ChildProjectRoleVersionQuery groupByVersionCreatedAt() Group by the version_created_at column
 * @method     ChildProjectRoleVersionQuery groupByVersionCreatedBy() Group by the version_created_by column
 * @method     ChildProjectRoleVersionQuery groupByVersionComment() Group by the version_comment column
 * @method     ChildProjectRoleVersionQuery groupByProjectIdVersion() Group by the project_id_version column
 *
 * @method     ChildProjectRoleVersionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildProjectRoleVersionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildProjectRoleVersionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildProjectRoleVersionQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildProjectRoleVersionQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildProjectRoleVersionQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildProjectRoleVersionQuery leftJoinProjectRole($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProjectRole relation
 * @method     ChildProjectRoleVersionQuery rightJoinProjectRole($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProjectRole relation
 * @method     ChildProjectRoleVersionQuery innerJoinProjectRole($relationAlias = null) Adds a INNER JOIN clause to the query using the ProjectRole relation
 *
 * @method     ChildProjectRoleVersionQuery joinWithProjectRole($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProjectRole relation
 *
 * @method     ChildProjectRoleVersionQuery leftJoinWithProjectRole() Adds a LEFT JOIN clause and with to the query using the ProjectRole relation
 * @method     ChildProjectRoleVersionQuery rightJoinWithProjectRole() Adds a RIGHT JOIN clause and with to the query using the ProjectRole relation
 * @method     ChildProjectRoleVersionQuery innerJoinWithProjectRole() Adds a INNER JOIN clause and with to the query using the ProjectRole relation
 *
 * @method     \DB\ProjectRoleQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildProjectRoleVersion|null findOne(?ConnectionInterface $con = null) Return the first ChildProjectRoleVersion matching the query
 * @method     ChildProjectRoleVersion findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildProjectRoleVersion matching the query, or a new ChildProjectRoleVersion object populated from the query conditions when no match is found
 *
 * @method     ChildProjectRoleVersion|null findOneById(int $id) Return the first ChildProjectRoleVersion filtered by the id column
 * @method     ChildProjectRoleVersion|null findOneByLvl(int $lvl) Return the first ChildProjectRoleVersion filtered by the lvl column
 * @method     ChildProjectRoleVersion|null findOneByRoleId(int $role_id) Return the first ChildProjectRoleVersion filtered by the role_id column
 * @method     ChildProjectRoleVersion|null findOneByProjectId(int $project_id) Return the first ChildProjectRoleVersion filtered by the project_id column
 * @method     ChildProjectRoleVersion|null findOneByObjectId(int $object_id) Return the first ChildProjectRoleVersion filtered by the object_id column
 * @method     ChildProjectRoleVersion|null findOneByUserId(int $user_id) Return the first ChildProjectRoleVersion filtered by the user_id column
 * @method     ChildProjectRoleVersion|null findOneByVersion(int $version) Return the first ChildProjectRoleVersion filtered by the version column
 * @method     ChildProjectRoleVersion|null findOneByVersionCreatedAt(string $version_created_at) Return the first ChildProjectRoleVersion filtered by the version_created_at column
 * @method     ChildProjectRoleVersion|null findOneByVersionCreatedBy(string $version_created_by) Return the first ChildProjectRoleVersion filtered by the version_created_by column
 * @method     ChildProjectRoleVersion|null findOneByVersionComment(string $version_comment) Return the first ChildProjectRoleVersion filtered by the version_comment column
 * @method     ChildProjectRoleVersion|null findOneByProjectIdVersion(int $project_id_version) Return the first ChildProjectRoleVersion filtered by the project_id_version column *

 * @method     ChildProjectRoleVersion requirePk($key, ?ConnectionInterface $con = null) Return the ChildProjectRoleVersion by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProjectRoleVersion requireOne(?ConnectionInterface $con = null) Return the first ChildProjectRoleVersion matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProjectRoleVersion requireOneById(int $id) Return the first ChildProjectRoleVersion filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProjectRoleVersion requireOneByLvl(int $lvl) Return the first ChildProjectRoleVersion filtered by the lvl column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProjectRoleVersion requireOneByRoleId(int $role_id) Return the first ChildProjectRoleVersion filtered by the role_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProjectRoleVersion requireOneByProjectId(int $project_id) Return the first ChildProjectRoleVersion filtered by the project_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProjectRoleVersion requireOneByObjectId(int $object_id) Return the first ChildProjectRoleVersion filtered by the object_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProjectRoleVersion requireOneByUserId(int $user_id) Return the first ChildProjectRoleVersion filtered by the user_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProjectRoleVersion requireOneByVersion(int $version) Return the first ChildProjectRoleVersion filtered by the version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProjectRoleVersion requireOneByVersionCreatedAt(string $version_created_at) Return the first ChildProjectRoleVersion filtered by the version_created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProjectRoleVersion requireOneByVersionCreatedBy(string $version_created_by) Return the first ChildProjectRoleVersion filtered by the version_created_by column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProjectRoleVersion requireOneByVersionComment(string $version_comment) Return the first ChildProjectRoleVersion filtered by the version_comment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProjectRoleVersion requireOneByProjectIdVersion(int $project_id_version) Return the first ChildProjectRoleVersion filtered by the project_id_version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProjectRoleVersion[]|Collection find(?ConnectionInterface $con = null) Return ChildProjectRoleVersion objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildProjectRoleVersion> find(?ConnectionInterface $con = null) Return ChildProjectRoleVersion objects based on current ModelCriteria
 * @method     ChildProjectRoleVersion[]|Collection findById(int $id) Return ChildProjectRoleVersion objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildProjectRoleVersion> findById(int $id) Return ChildProjectRoleVersion objects filtered by the id column
 * @method     ChildProjectRoleVersion[]|Collection findByLvl(int $lvl) Return ChildProjectRoleVersion objects filtered by the lvl column
 * @psalm-method Collection&\Traversable<ChildProjectRoleVersion> findByLvl(int $lvl) Return ChildProjectRoleVersion objects filtered by the lvl column
 * @method     ChildProjectRoleVersion[]|Collection findByRoleId(int $role_id) Return ChildProjectRoleVersion objects filtered by the role_id column
 * @psalm-method Collection&\Traversable<ChildProjectRoleVersion> findByRoleId(int $role_id) Return ChildProjectRoleVersion objects filtered by the role_id column
 * @method     ChildProjectRoleVersion[]|Collection findByProjectId(int $project_id) Return ChildProjectRoleVersion objects filtered by the project_id column
 * @psalm-method Collection&\Traversable<ChildProjectRoleVersion> findByProjectId(int $project_id) Return ChildProjectRoleVersion objects filtered by the project_id column
 * @method     ChildProjectRoleVersion[]|Collection findByObjectId(int $object_id) Return ChildProjectRoleVersion objects filtered by the object_id column
 * @psalm-method Collection&\Traversable<ChildProjectRoleVersion> findByObjectId(int $object_id) Return ChildProjectRoleVersion objects filtered by the object_id column
 * @method     ChildProjectRoleVersion[]|Collection findByUserId(int $user_id) Return ChildProjectRoleVersion objects filtered by the user_id column
 * @psalm-method Collection&\Traversable<ChildProjectRoleVersion> findByUserId(int $user_id) Return ChildProjectRoleVersion objects filtered by the user_id column
 * @method     ChildProjectRoleVersion[]|Collection findByVersion(int $version) Return ChildProjectRoleVersion objects filtered by the version column
 * @psalm-method Collection&\Traversable<ChildProjectRoleVersion> findByVersion(int $version) Return ChildProjectRoleVersion objects filtered by the version column
 * @method     ChildProjectRoleVersion[]|Collection findByVersionCreatedAt(string $version_created_at) Return ChildProjectRoleVersion objects filtered by the version_created_at column
 * @psalm-method Collection&\Traversable<ChildProjectRoleVersion> findByVersionCreatedAt(string $version_created_at) Return ChildProjectRoleVersion objects filtered by the version_created_at column
 * @method     ChildProjectRoleVersion[]|Collection findByVersionCreatedBy(string $version_created_by) Return ChildProjectRoleVersion objects filtered by the version_created_by column
 * @psalm-method Collection&\Traversable<ChildProjectRoleVersion> findByVersionCreatedBy(string $version_created_by) Return ChildProjectRoleVersion objects filtered by the version_created_by column
 * @method     ChildProjectRoleVersion[]|Collection findByVersionComment(string $version_comment) Return ChildProjectRoleVersion objects filtered by the version_comment column
 * @psalm-method Collection&\Traversable<ChildProjectRoleVersion> findByVersionComment(string $version_comment) Return ChildProjectRoleVersion objects filtered by the version_comment column
 * @method     ChildProjectRoleVersion[]|Collection findByProjectIdVersion(int $project_id_version) Return ChildProjectRoleVersion objects filtered by the project_id_version column
 * @psalm-method Collection&\Traversable<ChildProjectRoleVersion> findByProjectIdVersion(int $project_id_version) Return ChildProjectRoleVersion objects filtered by the project_id_version column
 * @method     ChildProjectRoleVersion[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildProjectRoleVersion> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ProjectRoleVersionQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \DB\Base\ProjectRoleVersionQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\DB\\ProjectRoleVersion', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildProjectRoleVersionQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildProjectRoleVersionQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildProjectRoleVersionQuery) {
            return $criteria;
        }
        $query = new ChildProjectRoleVersionQuery();
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
     * @return ChildProjectRoleVersion|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ProjectRoleVersionTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ProjectRoleVersionTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildProjectRoleVersion A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, lvl, role_id, project_id, object_id, user_id, version, version_created_at, version_created_by, version_comment, project_id_version FROM project_role_version WHERE id = :p0 AND version = :p1';
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
            /** @var ChildProjectRoleVersion $obj */
            $obj = new ChildProjectRoleVersion();
            $obj->hydrate($row);
            ProjectRoleVersionTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildProjectRoleVersion|array|mixed the result, formatted by the current formatter
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
        $this->addUsingAlias(ProjectRoleVersionTableMap::COL_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(ProjectRoleVersionTableMap::COL_VERSION, $key[1], Criteria::EQUAL);

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
            $cton0 = $this->getNewCriterion(ProjectRoleVersionTableMap::COL_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(ProjectRoleVersionTableMap::COL_VERSION, $key[1], Criteria::EQUAL);
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
     * @see       filterByProjectRole()
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
                $this->addUsingAlias(ProjectRoleVersionTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ProjectRoleVersionTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ProjectRoleVersionTableMap::COL_ID, $id, $comparison);

        return $this;
    }

    /**
     * Filter the query on the lvl column
     *
     * Example usage:
     * <code>
     * $query->filterByLvl(1234); // WHERE lvl = 1234
     * $query->filterByLvl(array(12, 34)); // WHERE lvl IN (12, 34)
     * $query->filterByLvl(array('min' => 12)); // WHERE lvl > 12
     * </code>
     *
     * @param mixed $lvl The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLvl($lvl = null, ?string $comparison = null)
    {
        if (is_array($lvl)) {
            $useMinMax = false;
            if (isset($lvl['min'])) {
                $this->addUsingAlias(ProjectRoleVersionTableMap::COL_LVL, $lvl['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lvl['max'])) {
                $this->addUsingAlias(ProjectRoleVersionTableMap::COL_LVL, $lvl['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ProjectRoleVersionTableMap::COL_LVL, $lvl, $comparison);

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
                $this->addUsingAlias(ProjectRoleVersionTableMap::COL_ROLE_ID, $roleId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($roleId['max'])) {
                $this->addUsingAlias(ProjectRoleVersionTableMap::COL_ROLE_ID, $roleId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ProjectRoleVersionTableMap::COL_ROLE_ID, $roleId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the project_id column
     *
     * Example usage:
     * <code>
     * $query->filterByProjectId(1234); // WHERE project_id = 1234
     * $query->filterByProjectId(array(12, 34)); // WHERE project_id IN (12, 34)
     * $query->filterByProjectId(array('min' => 12)); // WHERE project_id > 12
     * </code>
     *
     * @param mixed $projectId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProjectId($projectId = null, ?string $comparison = null)
    {
        if (is_array($projectId)) {
            $useMinMax = false;
            if (isset($projectId['min'])) {
                $this->addUsingAlias(ProjectRoleVersionTableMap::COL_PROJECT_ID, $projectId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($projectId['max'])) {
                $this->addUsingAlias(ProjectRoleVersionTableMap::COL_PROJECT_ID, $projectId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ProjectRoleVersionTableMap::COL_PROJECT_ID, $projectId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the object_id column
     *
     * Example usage:
     * <code>
     * $query->filterByObjectId(1234); // WHERE object_id = 1234
     * $query->filterByObjectId(array(12, 34)); // WHERE object_id IN (12, 34)
     * $query->filterByObjectId(array('min' => 12)); // WHERE object_id > 12
     * </code>
     *
     * @param mixed $objectId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByObjectId($objectId = null, ?string $comparison = null)
    {
        if (is_array($objectId)) {
            $useMinMax = false;
            if (isset($objectId['min'])) {
                $this->addUsingAlias(ProjectRoleVersionTableMap::COL_OBJECT_ID, $objectId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($objectId['max'])) {
                $this->addUsingAlias(ProjectRoleVersionTableMap::COL_OBJECT_ID, $objectId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ProjectRoleVersionTableMap::COL_OBJECT_ID, $objectId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the user_id column
     *
     * Example usage:
     * <code>
     * $query->filterByUserId(1234); // WHERE user_id = 1234
     * $query->filterByUserId(array(12, 34)); // WHERE user_id IN (12, 34)
     * $query->filterByUserId(array('min' => 12)); // WHERE user_id > 12
     * </code>
     *
     * @param mixed $userId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUserId($userId = null, ?string $comparison = null)
    {
        if (is_array($userId)) {
            $useMinMax = false;
            if (isset($userId['min'])) {
                $this->addUsingAlias(ProjectRoleVersionTableMap::COL_USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(ProjectRoleVersionTableMap::COL_USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ProjectRoleVersionTableMap::COL_USER_ID, $userId, $comparison);

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
                $this->addUsingAlias(ProjectRoleVersionTableMap::COL_VERSION, $version['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($version['max'])) {
                $this->addUsingAlias(ProjectRoleVersionTableMap::COL_VERSION, $version['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ProjectRoleVersionTableMap::COL_VERSION, $version, $comparison);

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
                $this->addUsingAlias(ProjectRoleVersionTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($versionCreatedAt['max'])) {
                $this->addUsingAlias(ProjectRoleVersionTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ProjectRoleVersionTableMap::COL_VERSION_CREATED_AT, $versionCreatedAt, $comparison);

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

        $this->addUsingAlias(ProjectRoleVersionTableMap::COL_VERSION_CREATED_BY, $versionCreatedBy, $comparison);

        return $this;
    }

    /**
     * Filter the query on the version_comment column
     *
     * Example usage:
     * <code>
     * $query->filterByVersionComment('fooValue');   // WHERE version_comment = 'fooValue'
     * $query->filterByVersionComment('%fooValue%', Criteria::LIKE); // WHERE version_comment LIKE '%fooValue%'
     * $query->filterByVersionComment(['foo', 'bar']); // WHERE version_comment IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $versionComment The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByVersionComment($versionComment = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($versionComment)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ProjectRoleVersionTableMap::COL_VERSION_COMMENT, $versionComment, $comparison);

        return $this;
    }

    /**
     * Filter the query on the project_id_version column
     *
     * Example usage:
     * <code>
     * $query->filterByProjectIdVersion(1234); // WHERE project_id_version = 1234
     * $query->filterByProjectIdVersion(array(12, 34)); // WHERE project_id_version IN (12, 34)
     * $query->filterByProjectIdVersion(array('min' => 12)); // WHERE project_id_version > 12
     * </code>
     *
     * @param mixed $projectIdVersion The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProjectIdVersion($projectIdVersion = null, ?string $comparison = null)
    {
        if (is_array($projectIdVersion)) {
            $useMinMax = false;
            if (isset($projectIdVersion['min'])) {
                $this->addUsingAlias(ProjectRoleVersionTableMap::COL_PROJECT_ID_VERSION, $projectIdVersion['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($projectIdVersion['max'])) {
                $this->addUsingAlias(ProjectRoleVersionTableMap::COL_PROJECT_ID_VERSION, $projectIdVersion['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ProjectRoleVersionTableMap::COL_PROJECT_ID_VERSION, $projectIdVersion, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \DB\ProjectRole object
     *
     * @param \DB\ProjectRole|ObjectCollection $projectRole The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProjectRole($projectRole, ?string $comparison = null)
    {
        if ($projectRole instanceof \DB\ProjectRole) {
            return $this
                ->addUsingAlias(ProjectRoleVersionTableMap::COL_ID, $projectRole->getId(), $comparison);
        } elseif ($projectRole instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(ProjectRoleVersionTableMap::COL_ID, $projectRole->toKeyValue('PrimaryKey', 'Id'), $comparison);

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
     * @param ChildProjectRoleVersion $projectRoleVersion Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($projectRoleVersion = null)
    {
        if ($projectRoleVersion) {
            $this->addCond('pruneCond0', $this->getAliasedColName(ProjectRoleVersionTableMap::COL_ID), $projectRoleVersion->getId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(ProjectRoleVersionTableMap::COL_VERSION), $projectRoleVersion->getVersion(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the project_role_version table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProjectRoleVersionTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ProjectRoleVersionTableMap::clearInstancePool();
            ProjectRoleVersionTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ProjectRoleVersionTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ProjectRoleVersionTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ProjectRoleVersionTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ProjectRoleVersionTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
