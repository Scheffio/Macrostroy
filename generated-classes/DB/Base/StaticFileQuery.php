<?php

namespace DB\Base;

use \Exception;
use \PDO;
use DB\StaticFile as ChildStaticFile;
use DB\StaticFileQuery as ChildStaticFileQuery;
use DB\Map\StaticFileTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'static_file' table.
 *
 *
 *
 * @method     ChildStaticFileQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildStaticFileQuery orderByFileName($order = Criteria::ASC) Order by the file_name column
 * @method     ChildStaticFileQuery orderByContentType($order = Criteria::ASC) Order by the content_type column
 * @method     ChildStaticFileQuery orderByFile($order = Criteria::ASC) Order by the file column
 * @method     ChildStaticFileQuery orderByHeaders($order = Criteria::ASC) Order by the headers column
 * @method     ChildStaticFileQuery orderByUrl($order = Criteria::ASC) Order by the url column
 *
 * @method     ChildStaticFileQuery groupById() Group by the id column
 * @method     ChildStaticFileQuery groupByFileName() Group by the file_name column
 * @method     ChildStaticFileQuery groupByContentType() Group by the content_type column
 * @method     ChildStaticFileQuery groupByFile() Group by the file column
 * @method     ChildStaticFileQuery groupByHeaders() Group by the headers column
 * @method     ChildStaticFileQuery groupByUrl() Group by the url column
 *
 * @method     ChildStaticFileQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildStaticFileQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildStaticFileQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildStaticFileQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildStaticFileQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildStaticFileQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildStaticFile|null findOne(?ConnectionInterface $con = null) Return the first ChildStaticFile matching the query
 * @method     ChildStaticFile findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildStaticFile matching the query, or a new ChildStaticFile object populated from the query conditions when no match is found
 *
 * @method     ChildStaticFile|null findOneById(int $id) Return the first ChildStaticFile filtered by the id column
 * @method     ChildStaticFile|null findOneByFileName(string $file_name) Return the first ChildStaticFile filtered by the file_name column
 * @method     ChildStaticFile|null findOneByContentType(string $content_type) Return the first ChildStaticFile filtered by the content_type column
 * @method     ChildStaticFile|null findOneByFile(string $file) Return the first ChildStaticFile filtered by the file column
 * @method     ChildStaticFile|null findOneByHeaders(string $headers) Return the first ChildStaticFile filtered by the headers column
 * @method     ChildStaticFile|null findOneByUrl(string $url) Return the first ChildStaticFile filtered by the url column *

 * @method     ChildStaticFile requirePk($key, ?ConnectionInterface $con = null) Return the ChildStaticFile by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStaticFile requireOne(?ConnectionInterface $con = null) Return the first ChildStaticFile matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildStaticFile requireOneById(int $id) Return the first ChildStaticFile filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStaticFile requireOneByFileName(string $file_name) Return the first ChildStaticFile filtered by the file_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStaticFile requireOneByContentType(string $content_type) Return the first ChildStaticFile filtered by the content_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStaticFile requireOneByFile(string $file) Return the first ChildStaticFile filtered by the file column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStaticFile requireOneByHeaders(string $headers) Return the first ChildStaticFile filtered by the headers column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStaticFile requireOneByUrl(string $url) Return the first ChildStaticFile filtered by the url column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildStaticFile[]|Collection find(?ConnectionInterface $con = null) Return ChildStaticFile objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildStaticFile> find(?ConnectionInterface $con = null) Return ChildStaticFile objects based on current ModelCriteria
 * @method     ChildStaticFile[]|Collection findById(int $id) Return ChildStaticFile objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildStaticFile> findById(int $id) Return ChildStaticFile objects filtered by the id column
 * @method     ChildStaticFile[]|Collection findByFileName(string $file_name) Return ChildStaticFile objects filtered by the file_name column
 * @psalm-method Collection&\Traversable<ChildStaticFile> findByFileName(string $file_name) Return ChildStaticFile objects filtered by the file_name column
 * @method     ChildStaticFile[]|Collection findByContentType(string $content_type) Return ChildStaticFile objects filtered by the content_type column
 * @psalm-method Collection&\Traversable<ChildStaticFile> findByContentType(string $content_type) Return ChildStaticFile objects filtered by the content_type column
 * @method     ChildStaticFile[]|Collection findByFile(string $file) Return ChildStaticFile objects filtered by the file column
 * @psalm-method Collection&\Traversable<ChildStaticFile> findByFile(string $file) Return ChildStaticFile objects filtered by the file column
 * @method     ChildStaticFile[]|Collection findByHeaders(string $headers) Return ChildStaticFile objects filtered by the headers column
 * @psalm-method Collection&\Traversable<ChildStaticFile> findByHeaders(string $headers) Return ChildStaticFile objects filtered by the headers column
 * @method     ChildStaticFile[]|Collection findByUrl(string $url) Return ChildStaticFile objects filtered by the url column
 * @psalm-method Collection&\Traversable<ChildStaticFile> findByUrl(string $url) Return ChildStaticFile objects filtered by the url column
 * @method     ChildStaticFile[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildStaticFile> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class StaticFileQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \DB\Base\StaticFileQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\DB\\StaticFile', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildStaticFileQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildStaticFileQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildStaticFileQuery) {
            return $criteria;
        }
        $query = new ChildStaticFileQuery();
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
     * @return ChildStaticFile|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(StaticFileTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = StaticFileTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildStaticFile A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, file_name, content_type, file, headers, url FROM static_file WHERE id = :p0';
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
            /** @var ChildStaticFile $obj */
            $obj = new ChildStaticFile();
            $obj->hydrate($row);
            StaticFileTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildStaticFile|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(StaticFileTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(StaticFileTableMap::COL_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(StaticFileTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(StaticFileTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StaticFileTableMap::COL_ID, $id, $comparison);

        return $this;
    }

    /**
     * Filter the query on the file_name column
     *
     * Example usage:
     * <code>
     * $query->filterByFileName('fooValue');   // WHERE file_name = 'fooValue'
     * $query->filterByFileName('%fooValue%', Criteria::LIKE); // WHERE file_name LIKE '%fooValue%'
     * $query->filterByFileName(['foo', 'bar']); // WHERE file_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $fileName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFileName($fileName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fileName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StaticFileTableMap::COL_FILE_NAME, $fileName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the content_type column
     *
     * Example usage:
     * <code>
     * $query->filterByContentType('fooValue');   // WHERE content_type = 'fooValue'
     * $query->filterByContentType('%fooValue%', Criteria::LIKE); // WHERE content_type LIKE '%fooValue%'
     * $query->filterByContentType(['foo', 'bar']); // WHERE content_type IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $contentType The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByContentType($contentType = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($contentType)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StaticFileTableMap::COL_CONTENT_TYPE, $contentType, $comparison);

        return $this;
    }

    /**
     * Filter the query on the file column
     *
     * @param mixed $file The value to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFile($file = null, ?string $comparison = null)
    {

        $this->addUsingAlias(StaticFileTableMap::COL_FILE, $file, $comparison);

        return $this;
    }

    /**
     * Filter the query on the headers column
     *
     * Example usage:
     * <code>
     * $query->filterByHeaders('fooValue');   // WHERE headers = 'fooValue'
     * $query->filterByHeaders('%fooValue%', Criteria::LIKE); // WHERE headers LIKE '%fooValue%'
     * $query->filterByHeaders(['foo', 'bar']); // WHERE headers IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $headers The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByHeaders($headers = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($headers)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StaticFileTableMap::COL_HEADERS, $headers, $comparison);

        return $this;
    }

    /**
     * Filter the query on the url column
     *
     * Example usage:
     * <code>
     * $query->filterByUrl('fooValue');   // WHERE url = 'fooValue'
     * $query->filterByUrl('%fooValue%', Criteria::LIKE); // WHERE url LIKE '%fooValue%'
     * $query->filterByUrl(['foo', 'bar']); // WHERE url IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $url The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUrl($url = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($url)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(StaticFileTableMap::COL_URL, $url, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildStaticFile $staticFile Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($staticFile = null)
    {
        if ($staticFile) {
            $this->addUsingAlias(StaticFileTableMap::COL_ID, $staticFile->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the static_file table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(StaticFileTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            StaticFileTableMap::clearInstancePool();
            StaticFileTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(StaticFileTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(StaticFileTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            StaticFileTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            StaticFileTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    // sluggable behavior

    /**
     * Filter the query on the slug column
     *
     * @param string $slug The value to use as filter.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySlug(string $slug)
    {
        $this->addUsingAlias(StaticFileTableMap::COL_URL, $slug, Criteria::EQUAL);

        return $this;
    }

    /**
     * Find one object based on its slug
     *
     * @param string $slug The value to use as filter.
     * @param ConnectionInterface $con The optional connection object
     *
     * @return ChildStaticFile the result, formatted by the current formatter
     */
    public function findOneBySlug(string $slug, ?ConnectionInterface $con = null)
    {
        return $this->filterBySlug($slug)->findOne($con);
    }

}
