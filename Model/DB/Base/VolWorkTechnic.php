<?php

namespace DB\Base;

use \DateTime;
use \Exception;
use \PDO;
use DB\Users as ChildUsers;
use DB\UsersQuery as ChildUsersQuery;
use DB\VolTechnic as ChildVolTechnic;
use DB\VolTechnicQuery as ChildVolTechnicQuery;
use DB\VolTechnicVersionQuery as ChildVolTechnicVersionQuery;
use DB\VolWork as ChildVolWork;
use DB\VolWorkQuery as ChildVolWorkQuery;
use DB\VolWorkTechnic as ChildVolWorkTechnic;
use DB\VolWorkTechnicQuery as ChildVolWorkTechnicQuery;
use DB\VolWorkTechnicVersion as ChildVolWorkTechnicVersion;
use DB\VolWorkTechnicVersionQuery as ChildVolWorkTechnicVersionQuery;
use DB\VolWorkVersionQuery as ChildVolWorkVersionQuery;
use DB\Map\VolWorkTechnicTableMap;
use DB\Map\VolWorkTechnicVersionTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;

/**
 * Base class that represents a row from the 'vol_work_technic' table.
 *
 *
 *
 * @package    propel.generator.DB.Base
 */
abstract class VolWorkTechnic implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\DB\\Map\\VolWorkTechnicTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var bool
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var bool
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = [];

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = [];

    /**
     * The value for the id field.
     * ID техники работы
     * @var        int
     */
    protected $id;

    /**
     * The value for the amount field.
     * Кол-во
     * @var        string
     */
    protected $amount;

    /**
     * The value for the is_available field.
     * Доступ (доступный, удаленный)
     * Note: this column has a database default value of: true
     * @var        boolean
     */
    protected $is_available;

    /**
     * The value for the work_id field.
     * ID работы
     * @var        int
     */
    protected $work_id;

    /**
     * The value for the technic_id field.
     * ID техники
     * @var        int
     */
    protected $technic_id;

    /**
     * The value for the version_created_by field.
     *
     * @var        int
     */
    protected $version_created_by;

    /**
     * The value for the version field.
     *
     * Note: this column has a database default value of: 0
     * @var        int|null
     */
    protected $version;

    /**
     * The value for the version_created_at field.
     *
     * @var        DateTime|null
     */
    protected $version_created_at;

    /**
     * The value for the version_comment field.
     *
     * @var        string|null
     */
    protected $version_comment;

    /**
     * @var        ChildUsers
     */
    protected $aUsers;

    /**
     * @var        ChildVolWork
     */
    protected $aVolWork;

    /**
     * @var        ChildVolTechnic
     */
    protected $aVolTechnic;

    /**
     * @var        ObjectCollection|ChildVolWorkTechnicVersion[] Collection to store aggregation of ChildVolWorkTechnicVersion objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildVolWorkTechnicVersion> Collection to store aggregation of ChildVolWorkTechnicVersion objects.
     */
    protected $collVolWorkTechnicVersions;
    protected $collVolWorkTechnicVersionsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    // versionable behavior


    /**
     * @var bool
     */
    protected $enforceVersion = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildVolWorkTechnicVersion[]
     * @phpstan-var ObjectCollection&\Traversable<ChildVolWorkTechnicVersion>
     */
    protected $volWorkTechnicVersionsScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
        $this->is_available = true;
        $this->version = 0;
    }

    /**
     * Initializes internal state of DB\Base\VolWorkTechnic object.
     * @see applyDefaults()
     */
    public function __construct()
    {
        $this->applyDefaultValues();
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return bool True if the object has been modified.
     */
    public function isModified(): bool
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param string $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return bool True if $col has been modified.
     */
    public function isColumnModified(string $col): bool
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns(): array
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return bool True, if the object has never been persisted.
     */
    public function isNew(): bool
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param bool $b the state of the object.
     */
    public function setNew(bool $b): void
    {
        $this->new = $b;
    }

    /**
     * Whether this object has been deleted.
     * @return bool The deleted state of this object.
     */
    public function isDeleted(): bool
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param bool $b The deleted state of this object.
     * @return void
     */
    public function setDeleted(bool $b): void
    {
        $this->deleted = $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified(?string $col = null): void
    {
        if (null !== $col) {
            unset($this->modifiedColumns[$col]);
        } else {
            $this->modifiedColumns = [];
        }
    }

    /**
     * Compares this with another <code>VolWorkTechnic</code> instance.  If
     * <code>obj</code> is an instance of <code>VolWorkTechnic</code>, delegates to
     * <code>equals(VolWorkTechnic)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param mixed $obj The object to compare to.
     * @return bool Whether equal to the object specified.
     */
    public function equals($obj): bool
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns(): array
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param string $name The virtual column name
     * @return bool
     */
    public function hasVirtualColumn(string $name): bool
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param string $name The virtual column name
     * @return mixed
     *
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getVirtualColumn(string $name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of nonexistent virtual column `%s`.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name The virtual column name
     * @param mixed $value The value to give to the virtual column
     *
     * @return $this The current object, for fluid interface
     */
    public function setVirtualColumn(string $name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param string $msg
     * @param int $priority One of the Propel::LOG_* logging levels
     * @return void
     */
    protected function log(string $msg, int $priority = Propel::LOG_INFO): void
    {
        Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param \Propel\Runtime\Parser\AbstractParser|string $parser An AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param bool $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @param string $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME, TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM. Defaults to TableMap::TYPE_PHPNAME.
     * @return string The exported data
     */
    public function exportTo($parser, bool $includeLazyLoadColumns = true, string $keyType = TableMap::TYPE_PHPNAME): string
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray($keyType, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     *
     * @return array<string>
     */
    public function __sleep(): array
    {
        $this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }

    /**
     * Get the [id] column value.
     * ID техники работы
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the [amount] column value.
     * Кол-во
     * @return string
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Get the [is_available] column value.
     * Доступ (доступный, удаленный)
     * @return boolean
     */
    public function getIsAvailable()
    {
        return $this->is_available;
    }

    /**
     * Get the [is_available] column value.
     * Доступ (доступный, удаленный)
     * @return boolean
     */
    public function isAvailable()
    {
        return $this->getIsAvailable();
    }

    /**
     * Get the [work_id] column value.
     * ID работы
     * @return int
     */
    public function getWorkId()
    {
        return $this->work_id;
    }

    /**
     * Get the [technic_id] column value.
     * ID техники
     * @return int
     */
    public function getTechnicId()
    {
        return $this->technic_id;
    }

    /**
     * Get the [version_created_by] column value.
     *
     * @return int
     */
    public function getVersionCreatedBy()
    {
        return $this->version_created_by;
    }

    /**
     * Get the [version] column value.
     *
     * @return int|null
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Get the [optionally formatted] temporal [version_created_at] column value.
     *
     *
     * @param string|null $format The date/time format string (either date()-style or strftime()-style).
     *   If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime|null Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00.
     *
     * @throws \Propel\Runtime\Exception\PropelException - if unable to parse/validate the date/time value.
     *
     * @psalm-return ($format is null ? DateTime|null : string|null)
     */
    public function getVersionCreatedAt($format = null)
    {
        if ($format === null) {
            return $this->version_created_at;
        } else {
            return $this->version_created_at instanceof \DateTimeInterface ? $this->version_created_at->format($format) : null;
        }
    }

    /**
     * Get the [version_comment] column value.
     *
     * @return string|null
     */
    public function getVersionComment()
    {
        return $this->version_comment;
    }

    /**
     * Set the value of [id] column.
     * ID техники работы
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[VolWorkTechnicTableMap::COL_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [amount] column.
     * Кол-во
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setAmount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->amount !== $v) {
            $this->amount = $v;
            $this->modifiedColumns[VolWorkTechnicTableMap::COL_AMOUNT] = true;
        }

        return $this;
    }

    /**
     * Sets the value of the [is_available] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * Доступ (доступный, удаленный)
     * @param bool|integer|string $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setIsAvailable($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->is_available !== $v) {
            $this->is_available = $v;
            $this->modifiedColumns[VolWorkTechnicTableMap::COL_IS_AVAILABLE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [work_id] column.
     * ID работы
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setWorkId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->work_id !== $v) {
            $this->work_id = $v;
            $this->modifiedColumns[VolWorkTechnicTableMap::COL_WORK_ID] = true;
        }

        if ($this->aVolWork !== null && $this->aVolWork->getId() !== $v) {
            $this->aVolWork = null;
        }

        return $this;
    }

    /**
     * Set the value of [technic_id] column.
     * ID техники
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setTechnicId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->technic_id !== $v) {
            $this->technic_id = $v;
            $this->modifiedColumns[VolWorkTechnicTableMap::COL_TECHNIC_ID] = true;
        }

        if ($this->aVolTechnic !== null && $this->aVolTechnic->getId() !== $v) {
            $this->aVolTechnic = null;
        }

        return $this;
    }

    /**
     * Set the value of [version_created_by] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setVersionCreatedBy($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->version_created_by !== $v) {
            $this->version_created_by = $v;
            $this->modifiedColumns[VolWorkTechnicTableMap::COL_VERSION_CREATED_BY] = true;
        }

        if ($this->aUsers !== null && $this->aUsers->getId() !== $v) {
            $this->aUsers = null;
        }

        return $this;
    }

    /**
     * Set the value of [version] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setVersion($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->version !== $v) {
            $this->version = $v;
            $this->modifiedColumns[VolWorkTechnicTableMap::COL_VERSION] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [version_created_at] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setVersionCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->version_created_at !== null || $dt !== null) {
            if ($this->version_created_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->version_created_at->format("Y-m-d H:i:s.u")) {
                $this->version_created_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[VolWorkTechnicTableMap::COL_VERSION_CREATED_AT] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [version_comment] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setVersionComment($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->version_comment !== $v) {
            $this->version_comment = $v;
            $this->modifiedColumns[VolWorkTechnicTableMap::COL_VERSION_COMMENT] = true;
        }

        return $this;
    }

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return bool Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues(): bool
    {
            if ($this->is_available !== true) {
                return false;
            }

            if ($this->version !== 0) {
                return false;
            }

        // otherwise, everything was equal, so return TRUE
        return true;
    }

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array $row The row returned by DataFetcher->fetch().
     * @param int $startcol 0-based offset column which indicates which resultset column to start with.
     * @param bool $rehydrate Whether this object is being re-hydrated from the database.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int next starting column
     * @throws \Propel\Runtime\Exception\PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate(array $row, int $startcol = 0, bool $rehydrate = false, string $indexType = TableMap::TYPE_NUM): int
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : VolWorkTechnicTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : VolWorkTechnicTableMap::translateFieldName('Amount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->amount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : VolWorkTechnicTableMap::translateFieldName('IsAvailable', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_available = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : VolWorkTechnicTableMap::translateFieldName('WorkId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->work_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : VolWorkTechnicTableMap::translateFieldName('TechnicId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->technic_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : VolWorkTechnicTableMap::translateFieldName('VersionCreatedBy', TableMap::TYPE_PHPNAME, $indexType)];
            $this->version_created_by = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : VolWorkTechnicTableMap::translateFieldName('Version', TableMap::TYPE_PHPNAME, $indexType)];
            $this->version = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : VolWorkTechnicTableMap::translateFieldName('VersionCreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->version_created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : VolWorkTechnicTableMap::translateFieldName('VersionComment', TableMap::TYPE_PHPNAME, $indexType)];
            $this->version_comment = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 9; // 9 = VolWorkTechnicTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\DB\\VolWorkTechnic'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function ensureConsistency(): void
    {
        if ($this->aVolWork !== null && $this->work_id !== $this->aVolWork->getId()) {
            $this->aVolWork = null;
        }
        if ($this->aVolTechnic !== null && $this->technic_id !== $this->aVolTechnic->getId()) {
            $this->aVolTechnic = null;
        }
        if ($this->aUsers !== null && $this->version_created_by !== $this->aUsers->getId()) {
            $this->aUsers = null;
        }
    }

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param bool $deep (optional) Whether to also de-associated any related objects.
     * @param ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload(bool $deep = false, ?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(VolWorkTechnicTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildVolWorkTechnicQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aUsers = null;
            $this->aVolWork = null;
            $this->aVolTechnic = null;
            $this->collVolWorkTechnicVersions = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see VolWorkTechnic::setDeleted()
     * @see VolWorkTechnic::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(VolWorkTechnicTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildVolWorkTechnicQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param ConnectionInterface $con
     * @return int The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws \Propel\Runtime\Exception\PropelException
     * @see doSave()
     */
    public function save(?ConnectionInterface $con = null): int
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($this->alreadyInSave) {
            return 0;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(VolWorkTechnicTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            // versionable behavior
            if ($this->isVersioningNecessary()) {
                $this->setVersion($this->isNew() ? 1 : $this->getLastVersionNumber($con) + 1);
                if (!$this->isColumnModified(VolWorkTechnicTableMap::COL_VERSION_CREATED_AT)) {
                    $this->setVersionCreatedAt(time());
                }
                $createVersion = true; // for postSave hook
            }
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                // versionable behavior
                if (isset($createVersion)) {
                    $this->addVersion($con);
                }
                VolWorkTechnicTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param ConnectionInterface $con
     * @return int The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws \Propel\Runtime\Exception\PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con): int
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aUsers !== null) {
                if ($this->aUsers->isModified() || $this->aUsers->isNew()) {
                    $affectedRows += $this->aUsers->save($con);
                }
                $this->setUsers($this->aUsers);
            }

            if ($this->aVolWork !== null) {
                if ($this->aVolWork->isModified() || $this->aVolWork->isNew()) {
                    $affectedRows += $this->aVolWork->save($con);
                }
                $this->setVolWork($this->aVolWork);
            }

            if ($this->aVolTechnic !== null) {
                if ($this->aVolTechnic->isModified() || $this->aVolTechnic->isNew()) {
                    $affectedRows += $this->aVolTechnic->save($con);
                }
                $this->setVolTechnic($this->aVolTechnic);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            if ($this->volWorkTechnicVersionsScheduledForDeletion !== null) {
                if (!$this->volWorkTechnicVersionsScheduledForDeletion->isEmpty()) {
                    \DB\VolWorkTechnicVersionQuery::create()
                        ->filterByPrimaryKeys($this->volWorkTechnicVersionsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->volWorkTechnicVersionsScheduledForDeletion = null;
                }
            }

            if ($this->collVolWorkTechnicVersions !== null) {
                foreach ($this->collVolWorkTechnicVersions as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    }

    /**
     * Insert the row in the database.
     *
     * @param ConnectionInterface $con
     *
     * @throws \Propel\Runtime\Exception\PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con): void
    {
        $modifiedColumns = [];
        $index = 0;

        $this->modifiedColumns[VolWorkTechnicTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . VolWorkTechnicTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(VolWorkTechnicTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(VolWorkTechnicTableMap::COL_AMOUNT)) {
            $modifiedColumns[':p' . $index++]  = 'amount';
        }
        if ($this->isColumnModified(VolWorkTechnicTableMap::COL_IS_AVAILABLE)) {
            $modifiedColumns[':p' . $index++]  = 'is_available';
        }
        if ($this->isColumnModified(VolWorkTechnicTableMap::COL_WORK_ID)) {
            $modifiedColumns[':p' . $index++]  = 'work_id';
        }
        if ($this->isColumnModified(VolWorkTechnicTableMap::COL_TECHNIC_ID)) {
            $modifiedColumns[':p' . $index++]  = 'technic_id';
        }
        if ($this->isColumnModified(VolWorkTechnicTableMap::COL_VERSION_CREATED_BY)) {
            $modifiedColumns[':p' . $index++]  = 'version_created_by';
        }
        if ($this->isColumnModified(VolWorkTechnicTableMap::COL_VERSION)) {
            $modifiedColumns[':p' . $index++]  = 'version';
        }
        if ($this->isColumnModified(VolWorkTechnicTableMap::COL_VERSION_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'version_created_at';
        }
        if ($this->isColumnModified(VolWorkTechnicTableMap::COL_VERSION_COMMENT)) {
            $modifiedColumns[':p' . $index++]  = 'version_comment';
        }

        $sql = sprintf(
            'INSERT INTO vol_work_technic (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case 'amount':
                        $stmt->bindValue($identifier, $this->amount, PDO::PARAM_STR);
                        break;
                    case 'is_available':
                        $stmt->bindValue($identifier, (int) $this->is_available, PDO::PARAM_INT);
                        break;
                    case 'work_id':
                        $stmt->bindValue($identifier, $this->work_id, PDO::PARAM_INT);
                        break;
                    case 'technic_id':
                        $stmt->bindValue($identifier, $this->technic_id, PDO::PARAM_INT);
                        break;
                    case 'version_created_by':
                        $stmt->bindValue($identifier, $this->version_created_by, PDO::PARAM_INT);
                        break;
                    case 'version':
                        $stmt->bindValue($identifier, $this->version, PDO::PARAM_INT);
                        break;
                    case 'version_created_at':
                        $stmt->bindValue($identifier, $this->version_created_at ? $this->version_created_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'version_comment':
                        $stmt->bindValue($identifier, $this->version_comment, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param ConnectionInterface $con
     *
     * @return int Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con): int
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param string $name name
     * @param string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName(string $name, string $type = TableMap::TYPE_PHPNAME)
    {
        $pos = VolWorkTechnicTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos Position in XML schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition(int $pos)
    {
        switch ($pos) {
            case 0:
                return $this->getId();

            case 1:
                return $this->getAmount();

            case 2:
                return $this->getIsAvailable();

            case 3:
                return $this->getWorkId();

            case 4:
                return $this->getTechnicId();

            case 5:
                return $this->getVersionCreatedBy();

            case 6:
                return $this->getVersion();

            case 7:
                return $this->getVersionCreatedAt();

            case 8:
                return $this->getVersionComment();

            default:
                return null;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param string $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param bool $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param bool $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array An associative array containing the field names (as keys) and field values
     */
    public function toArray(string $keyType = TableMap::TYPE_PHPNAME, bool $includeLazyLoadColumns = true, array $alreadyDumpedObjects = [], bool $includeForeignObjects = false): array
    {
        if (isset($alreadyDumpedObjects['VolWorkTechnic'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['VolWorkTechnic'][$this->hashCode()] = true;
        $keys = VolWorkTechnicTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getId(),
            $keys[1] => $this->getAmount(),
            $keys[2] => $this->getIsAvailable(),
            $keys[3] => $this->getWorkId(),
            $keys[4] => $this->getTechnicId(),
            $keys[5] => $this->getVersionCreatedBy(),
            $keys[6] => $this->getVersion(),
            $keys[7] => $this->getVersionCreatedAt(),
            $keys[8] => $this->getVersionComment(),
        ];
        if ($result[$keys[7]] instanceof \DateTimeInterface) {
            $result[$keys[7]] = $result[$keys[7]]->format('Y-m-d H:i:s.u');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aUsers) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'users';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'users';
                        break;
                    default:
                        $key = 'Users';
                }

                $result[$key] = $this->aUsers->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aVolWork) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'volWork';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'vol_work';
                        break;
                    default:
                        $key = 'VolWork';
                }

                $result[$key] = $this->aVolWork->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aVolTechnic) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'volTechnic';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'vol_technic';
                        break;
                    default:
                        $key = 'VolTechnic';
                }

                $result[$key] = $this->aVolTechnic->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collVolWorkTechnicVersions) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'volWorkTechnicVersions';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'vol_work_technic_versions';
                        break;
                    default:
                        $key = 'VolWorkTechnicVersions';
                }

                $result[$key] = $this->collVolWorkTechnicVersions->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param string $name
     * @param mixed $value field value
     * @param string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this
     */
    public function setByName(string $name, $value, string $type = TableMap::TYPE_PHPNAME)
    {
        $pos = VolWorkTechnicTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        $this->setByPosition($pos, $value);

        return $this;
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @param mixed $value field value
     * @return $this
     */
    public function setByPosition(int $pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setAmount($value);
                break;
            case 2:
                $this->setIsAvailable($value);
                break;
            case 3:
                $this->setWorkId($value);
                break;
            case 4:
                $this->setTechnicId($value);
                break;
            case 5:
                $this->setVersionCreatedBy($value);
                break;
            case 6:
                $this->setVersion($value);
                break;
            case 7:
                $this->setVersionCreatedAt($value);
                break;
            case 8:
                $this->setVersionComment($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param array $arr An array to populate the object from.
     * @param string $keyType The type of keys the array uses.
     * @return $this
     */
    public function fromArray(array $arr, string $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = VolWorkTechnicTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setAmount($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setIsAvailable($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setWorkId($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setTechnicId($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setVersionCreatedBy($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setVersion($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setVersionCreatedAt($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setVersionComment($arr[$keys[8]]);
        }

        return $this;
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this The current object, for fluid interface
     */
    public function importFrom($parser, string $data, string $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return \Propel\Runtime\ActiveQuery\Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria(): Criteria
    {
        $criteria = new Criteria(VolWorkTechnicTableMap::DATABASE_NAME);

        if ($this->isColumnModified(VolWorkTechnicTableMap::COL_ID)) {
            $criteria->add(VolWorkTechnicTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(VolWorkTechnicTableMap::COL_AMOUNT)) {
            $criteria->add(VolWorkTechnicTableMap::COL_AMOUNT, $this->amount);
        }
        if ($this->isColumnModified(VolWorkTechnicTableMap::COL_IS_AVAILABLE)) {
            $criteria->add(VolWorkTechnicTableMap::COL_IS_AVAILABLE, $this->is_available);
        }
        if ($this->isColumnModified(VolWorkTechnicTableMap::COL_WORK_ID)) {
            $criteria->add(VolWorkTechnicTableMap::COL_WORK_ID, $this->work_id);
        }
        if ($this->isColumnModified(VolWorkTechnicTableMap::COL_TECHNIC_ID)) {
            $criteria->add(VolWorkTechnicTableMap::COL_TECHNIC_ID, $this->technic_id);
        }
        if ($this->isColumnModified(VolWorkTechnicTableMap::COL_VERSION_CREATED_BY)) {
            $criteria->add(VolWorkTechnicTableMap::COL_VERSION_CREATED_BY, $this->version_created_by);
        }
        if ($this->isColumnModified(VolWorkTechnicTableMap::COL_VERSION)) {
            $criteria->add(VolWorkTechnicTableMap::COL_VERSION, $this->version);
        }
        if ($this->isColumnModified(VolWorkTechnicTableMap::COL_VERSION_CREATED_AT)) {
            $criteria->add(VolWorkTechnicTableMap::COL_VERSION_CREATED_AT, $this->version_created_at);
        }
        if ($this->isColumnModified(VolWorkTechnicTableMap::COL_VERSION_COMMENT)) {
            $criteria->add(VolWorkTechnicTableMap::COL_VERSION_COMMENT, $this->version_comment);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return \Propel\Runtime\ActiveQuery\Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria(): Criteria
    {
        $criteria = ChildVolWorkTechnicQuery::create();
        $criteria->add(VolWorkTechnicTableMap::COL_ID, $this->id);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int|string Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getId();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getId();
    }

    /**
     * Generic method to set the primary key (id column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \DB\VolWorkTechnic (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setAmount($this->getAmount());
        $copyObj->setIsAvailable($this->getIsAvailable());
        $copyObj->setWorkId($this->getWorkId());
        $copyObj->setTechnicId($this->getTechnicId());
        $copyObj->setVersionCreatedBy($this->getVersionCreatedBy());
        $copyObj->setVersion($this->getVersion());
        $copyObj->setVersionCreatedAt($this->getVersionCreatedAt());
        $copyObj->setVersionComment($this->getVersionComment());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getVolWorkTechnicVersions() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addVolWorkTechnicVersion($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \DB\VolWorkTechnic Clone of current object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function copy(bool $deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Declares an association between this object and a ChildUsers object.
     *
     * @param ChildUsers $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setUsers(ChildUsers $v = null)
    {
        if ($v === null) {
            $this->setVersionCreatedBy(NULL);
        } else {
            $this->setVersionCreatedBy($v->getId());
        }

        $this->aUsers = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildUsers object, it will not be re-added.
        if ($v !== null) {
            $v->addVolWorkTechnic($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildUsers object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildUsers The associated ChildUsers object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getUsers(?ConnectionInterface $con = null)
    {
        if ($this->aUsers === null && ($this->version_created_by != 0)) {
            $this->aUsers = ChildUsersQuery::create()->findPk($this->version_created_by, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aUsers->addVolWorkTechnics($this);
             */
        }

        return $this->aUsers;
    }

    /**
     * Declares an association between this object and a ChildVolWork object.
     *
     * @param ChildVolWork $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setVolWork(ChildVolWork $v = null)
    {
        if ($v === null) {
            $this->setWorkId(NULL);
        } else {
            $this->setWorkId($v->getId());
        }

        $this->aVolWork = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildVolWork object, it will not be re-added.
        if ($v !== null) {
            $v->addVolWorkTechnic($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildVolWork object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildVolWork The associated ChildVolWork object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getVolWork(?ConnectionInterface $con = null)
    {
        if ($this->aVolWork === null && ($this->work_id != 0)) {
            $this->aVolWork = ChildVolWorkQuery::create()->findPk($this->work_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aVolWork->addVolWorkTechnics($this);
             */
        }

        return $this->aVolWork;
    }

    /**
     * Declares an association between this object and a ChildVolTechnic object.
     *
     * @param ChildVolTechnic $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setVolTechnic(ChildVolTechnic $v = null)
    {
        if ($v === null) {
            $this->setTechnicId(NULL);
        } else {
            $this->setTechnicId($v->getId());
        }

        $this->aVolTechnic = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildVolTechnic object, it will not be re-added.
        if ($v !== null) {
            $v->addVolWorkTechnic($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildVolTechnic object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildVolTechnic The associated ChildVolTechnic object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getVolTechnic(?ConnectionInterface $con = null)
    {
        if ($this->aVolTechnic === null && ($this->technic_id != 0)) {
            $this->aVolTechnic = ChildVolTechnicQuery::create()->findPk($this->technic_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aVolTechnic->addVolWorkTechnics($this);
             */
        }

        return $this->aVolTechnic;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName): void
    {
        if ('VolWorkTechnicVersion' === $relationName) {
            $this->initVolWorkTechnicVersions();
            return;
        }
    }

    /**
     * Clears out the collVolWorkTechnicVersions collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addVolWorkTechnicVersions()
     */
    public function clearVolWorkTechnicVersions()
    {
        $this->collVolWorkTechnicVersions = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collVolWorkTechnicVersions collection loaded partially.
     *
     * @return void
     */
    public function resetPartialVolWorkTechnicVersions($v = true): void
    {
        $this->collVolWorkTechnicVersionsPartial = $v;
    }

    /**
     * Initializes the collVolWorkTechnicVersions collection.
     *
     * By default this just sets the collVolWorkTechnicVersions collection to an empty array (like clearcollVolWorkTechnicVersions());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initVolWorkTechnicVersions(bool $overrideExisting = true): void
    {
        if (null !== $this->collVolWorkTechnicVersions && !$overrideExisting) {
            return;
        }

        $collectionClassName = VolWorkTechnicVersionTableMap::getTableMap()->getCollectionClassName();

        $this->collVolWorkTechnicVersions = new $collectionClassName;
        $this->collVolWorkTechnicVersions->setModel('\DB\VolWorkTechnicVersion');
    }

    /**
     * Gets an array of ChildVolWorkTechnicVersion objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildVolWorkTechnic is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildVolWorkTechnicVersion[] List of ChildVolWorkTechnicVersion objects
     * @phpstan-return ObjectCollection&\Traversable<ChildVolWorkTechnicVersion> List of ChildVolWorkTechnicVersion objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getVolWorkTechnicVersions(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collVolWorkTechnicVersionsPartial && !$this->isNew();
        if (null === $this->collVolWorkTechnicVersions || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collVolWorkTechnicVersions) {
                    $this->initVolWorkTechnicVersions();
                } else {
                    $collectionClassName = VolWorkTechnicVersionTableMap::getTableMap()->getCollectionClassName();

                    $collVolWorkTechnicVersions = new $collectionClassName;
                    $collVolWorkTechnicVersions->setModel('\DB\VolWorkTechnicVersion');

                    return $collVolWorkTechnicVersions;
                }
            } else {
                $collVolWorkTechnicVersions = ChildVolWorkTechnicVersionQuery::create(null, $criteria)
                    ->filterByVolWorkTechnic($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collVolWorkTechnicVersionsPartial && count($collVolWorkTechnicVersions)) {
                        $this->initVolWorkTechnicVersions(false);

                        foreach ($collVolWorkTechnicVersions as $obj) {
                            if (false == $this->collVolWorkTechnicVersions->contains($obj)) {
                                $this->collVolWorkTechnicVersions->append($obj);
                            }
                        }

                        $this->collVolWorkTechnicVersionsPartial = true;
                    }

                    return $collVolWorkTechnicVersions;
                }

                if ($partial && $this->collVolWorkTechnicVersions) {
                    foreach ($this->collVolWorkTechnicVersions as $obj) {
                        if ($obj->isNew()) {
                            $collVolWorkTechnicVersions[] = $obj;
                        }
                    }
                }

                $this->collVolWorkTechnicVersions = $collVolWorkTechnicVersions;
                $this->collVolWorkTechnicVersionsPartial = false;
            }
        }

        return $this->collVolWorkTechnicVersions;
    }

    /**
     * Sets a collection of ChildVolWorkTechnicVersion objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $volWorkTechnicVersions A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setVolWorkTechnicVersions(Collection $volWorkTechnicVersions, ?ConnectionInterface $con = null)
    {
        /** @var ChildVolWorkTechnicVersion[] $volWorkTechnicVersionsToDelete */
        $volWorkTechnicVersionsToDelete = $this->getVolWorkTechnicVersions(new Criteria(), $con)->diff($volWorkTechnicVersions);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->volWorkTechnicVersionsScheduledForDeletion = clone $volWorkTechnicVersionsToDelete;

        foreach ($volWorkTechnicVersionsToDelete as $volWorkTechnicVersionRemoved) {
            $volWorkTechnicVersionRemoved->setVolWorkTechnic(null);
        }

        $this->collVolWorkTechnicVersions = null;
        foreach ($volWorkTechnicVersions as $volWorkTechnicVersion) {
            $this->addVolWorkTechnicVersion($volWorkTechnicVersion);
        }

        $this->collVolWorkTechnicVersions = $volWorkTechnicVersions;
        $this->collVolWorkTechnicVersionsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related VolWorkTechnicVersion objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related VolWorkTechnicVersion objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countVolWorkTechnicVersions(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collVolWorkTechnicVersionsPartial && !$this->isNew();
        if (null === $this->collVolWorkTechnicVersions || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collVolWorkTechnicVersions) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getVolWorkTechnicVersions());
            }

            $query = ChildVolWorkTechnicVersionQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByVolWorkTechnic($this)
                ->count($con);
        }

        return count($this->collVolWorkTechnicVersions);
    }

    /**
     * Method called to associate a ChildVolWorkTechnicVersion object to this object
     * through the ChildVolWorkTechnicVersion foreign key attribute.
     *
     * @param ChildVolWorkTechnicVersion $l ChildVolWorkTechnicVersion
     * @return $this The current object (for fluent API support)
     */
    public function addVolWorkTechnicVersion(ChildVolWorkTechnicVersion $l)
    {
        if ($this->collVolWorkTechnicVersions === null) {
            $this->initVolWorkTechnicVersions();
            $this->collVolWorkTechnicVersionsPartial = true;
        }

        if (!$this->collVolWorkTechnicVersions->contains($l)) {
            $this->doAddVolWorkTechnicVersion($l);

            if ($this->volWorkTechnicVersionsScheduledForDeletion and $this->volWorkTechnicVersionsScheduledForDeletion->contains($l)) {
                $this->volWorkTechnicVersionsScheduledForDeletion->remove($this->volWorkTechnicVersionsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildVolWorkTechnicVersion $volWorkTechnicVersion The ChildVolWorkTechnicVersion object to add.
     */
    protected function doAddVolWorkTechnicVersion(ChildVolWorkTechnicVersion $volWorkTechnicVersion): void
    {
        $this->collVolWorkTechnicVersions[]= $volWorkTechnicVersion;
        $volWorkTechnicVersion->setVolWorkTechnic($this);
    }

    /**
     * @param ChildVolWorkTechnicVersion $volWorkTechnicVersion The ChildVolWorkTechnicVersion object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeVolWorkTechnicVersion(ChildVolWorkTechnicVersion $volWorkTechnicVersion)
    {
        if ($this->getVolWorkTechnicVersions()->contains($volWorkTechnicVersion)) {
            $pos = $this->collVolWorkTechnicVersions->search($volWorkTechnicVersion);
            $this->collVolWorkTechnicVersions->remove($pos);
            if (null === $this->volWorkTechnicVersionsScheduledForDeletion) {
                $this->volWorkTechnicVersionsScheduledForDeletion = clone $this->collVolWorkTechnicVersions;
                $this->volWorkTechnicVersionsScheduledForDeletion->clear();
            }
            $this->volWorkTechnicVersionsScheduledForDeletion[]= clone $volWorkTechnicVersion;
            $volWorkTechnicVersion->setVolWorkTechnic(null);
        }

        return $this;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     *
     * @return $this
     */
    public function clear()
    {
        if (null !== $this->aUsers) {
            $this->aUsers->removeVolWorkTechnic($this);
        }
        if (null !== $this->aVolWork) {
            $this->aVolWork->removeVolWorkTechnic($this);
        }
        if (null !== $this->aVolTechnic) {
            $this->aVolTechnic->removeVolWorkTechnic($this);
        }
        $this->id = null;
        $this->amount = null;
        $this->is_available = null;
        $this->work_id = null;
        $this->technic_id = null;
        $this->version_created_by = null;
        $this->version = null;
        $this->version_created_at = null;
        $this->version_comment = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->applyDefaultValues();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);

        return $this;
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param bool $deep Whether to also clear the references on all referrer objects.
     * @return $this
     */
    public function clearAllReferences(bool $deep = false)
    {
        if ($deep) {
            if ($this->collVolWorkTechnicVersions) {
                foreach ($this->collVolWorkTechnicVersions as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collVolWorkTechnicVersions = null;
        $this->aUsers = null;
        $this->aVolWork = null;
        $this->aVolTechnic = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(VolWorkTechnicTableMap::DEFAULT_STRING_FORMAT);
    }

    // versionable behavior

    /**
     * Enforce a new Version of this object upon next save.
     *
     * @return $this
     */
    public function enforceVersioning()
    {
        $this->enforceVersion = true;

        return $this;
    }

    /**
     * Checks whether the current state must be recorded as a version
     *
     * @param ConnectionInterface $con The ConnectionInterface connection to use.
     * @return bool
     */
    public function isVersioningNecessary(?ConnectionInterface $con = null): bool
    {
        if ($this->alreadyInSave) {
            return false;
        }

        if ($this->enforceVersion) {
            return true;
        }

        if (ChildVolWorkTechnicQuery::isVersioningEnabled() && ($this->isNew() || $this->isModified()) || $this->isDeleted()) {
            return true;
        }
        if (null !== ($object = $this->getVolWork($con)) && $object->isVersioningNecessary($con)) {
            return true;
        }

        if (null !== ($object = $this->getVolTechnic($con)) && $object->isVersioningNecessary($con)) {
            return true;
        }


        return false;
    }

    /**
     * Creates a version of the current object and saves it.
     *
     * @param ConnectionInterface $con The ConnectionInterface connection to use.
     *
     * @return ChildVolWorkTechnicVersion A version object
     */
    public function addVersion(?ConnectionInterface $con = null)
    {
        $this->enforceVersion = false;

        $version = new ChildVolWorkTechnicVersion();
        $version->setId($this->getId());
        $version->setAmount($this->getAmount());
        $version->setIsAvailable($this->getIsAvailable());
        $version->setWorkId($this->getWorkId());
        $version->setTechnicId($this->getTechnicId());
        $version->setVersionCreatedBy($this->getVersionCreatedBy());
        $version->setVersion($this->getVersion());
        $version->setVersionCreatedAt($this->getVersionCreatedAt());
        $version->setVersionComment($this->getVersionComment());
        $version->setVolWorkTechnic($this);
        if (($related = $this->getVolWork(null, $con)) && $related->getVersion()) {
            $version->setWorkIdVersion($related->getVersion());
        }
        if (($related = $this->getVolTechnic(null, $con)) && $related->getVersion()) {
            $version->setTechnicIdVersion($related->getVersion());
        }
        $version->save($con);

        return $version;
    }

    /**
     * Sets the properties of the current object to the value they had at a specific version
     *
     * @param int $versionNumber The version number to read
     * @param ConnectionInterface|null $con The ConnectionInterface connection to use.
     *
     * @return $this The current object (for fluent API support)
     */
    public function toVersion($versionNumber, ?ConnectionInterface $con = null)
    {
        $version = $this->getOneVersion($versionNumber, $con);
        if (!$version) {
            throw new PropelException(sprintf('No ChildVolWorkTechnic object found with version %d', $version));
        }
        $this->populateFromVersion($version, $con);

        return $this;
    }

    /**
     * Sets the properties of the current object to the value they had at a specific version
     *
     * @param ChildVolWorkTechnicVersion $version The version object to use
     * @param ConnectionInterface $con the connection to use
     * @param array $loadedObjects objects that been loaded in a chain of populateFromVersion calls on referrer or fk objects.
     *
     * @return $this The current object (for fluent API support)
     */
    public function populateFromVersion($version, $con = null, &$loadedObjects = [])
    {
        $loadedObjects['ChildVolWorkTechnic'][$version->getId()][$version->getVersion()] = $this;
        $this->setId($version->getId());
        $this->setAmount($version->getAmount());
        $this->setIsAvailable($version->getIsAvailable());
        $this->setWorkId($version->getWorkId());
        $this->setTechnicId($version->getTechnicId());
        $this->setVersionCreatedBy($version->getVersionCreatedBy());
        $this->setVersion($version->getVersion());
        $this->setVersionCreatedAt($version->getVersionCreatedAt());
        $this->setVersionComment($version->getVersionComment());
        if ($fkValue = $version->getWorkId()) {
            if (isset($loadedObjects['ChildVolWork']) && isset($loadedObjects['ChildVolWork'][$fkValue]) && isset($loadedObjects['ChildVolWork'][$fkValue][$version->getWorkIdVersion()])) {
                $related = $loadedObjects['ChildVolWork'][$fkValue][$version->getWorkIdVersion()];
            } else {
                $related = new ChildVolWork();
                $relatedVersion = ChildVolWorkVersionQuery::create()
                    ->filterById($fkValue)
                    ->filterByVersionComment($version->getWorkIdVersion())
                    ->findOne($con);
                $related->populateFromVersion($relatedVersion, $con, $loadedObjects);
                $related->setNew(false);
            }
            $this->setVolWork($related);
        }
        if ($fkValue = $version->getTechnicId()) {
            if (isset($loadedObjects['ChildVolTechnic']) && isset($loadedObjects['ChildVolTechnic'][$fkValue]) && isset($loadedObjects['ChildVolTechnic'][$fkValue][$version->getTechnicIdVersion()])) {
                $related = $loadedObjects['ChildVolTechnic'][$fkValue][$version->getTechnicIdVersion()];
            } else {
                $related = new ChildVolTechnic();
                $relatedVersion = ChildVolTechnicVersionQuery::create()
                    ->filterById($fkValue)
                    ->filterByVersionComment($version->getTechnicIdVersion())
                    ->findOne($con);
                $related->populateFromVersion($relatedVersion, $con, $loadedObjects);
                $related->setNew(false);
            }
            $this->setVolTechnic($related);
        }

        return $this;
    }

    /**
     * Gets the latest persisted version number for the current object
     *
     * @param ConnectionInterface $con The ConnectionInterface connection to use.
     *
     * @return int
     */
    public function getLastVersionNumber(?ConnectionInterface $con = null): int
    {
        $v = ChildVolWorkTechnicVersionQuery::create()
            ->filterByVolWorkTechnic($this)
            ->orderByVersion('desc')
            ->findOne($con);
        if (!$v) {
            return 0;
        }

        return $v->getVersion();
    }

    /**
     * Checks whether the current object is the latest one
     *
     * @param ConnectionInterface $con The ConnectionInterface connection to use.
     *
     * @return bool
     */
    public function isLastVersion(?ConnectionInterface $con = null)
    {
        return $this->getLastVersionNumber($con) == $this->getVersion();
    }

    /**
     * Retrieves a version object for this entity and a version number
     *
     * @param int $versionNumber The version number to read
     * @param ConnectionInterface|null $con The ConnectionInterface connection to use.
     *
     * @return ChildVolWorkTechnicVersion A version object
     */
    public function getOneVersion(int $versionNumber, ?ConnectionInterface $con = null)
    {
        return ChildVolWorkTechnicVersionQuery::create()
            ->filterByVolWorkTechnic($this)
            ->filterByVersion($versionNumber)
            ->findOne($con);
    }

    /**
     * Gets all the versions of this object, in incremental order
     *
     * @param ConnectionInterface $con The ConnectionInterface connection to use.
     *
     * @return ObjectCollection|ChildVolWorkTechnicVersion[] A list of ChildVolWorkTechnicVersion objects
     */
    public function getAllVersions(?ConnectionInterface $con = null)
    {
        $criteria = new Criteria();
        $criteria->addAscendingOrderByColumn(VolWorkTechnicVersionTableMap::COL_VERSION);

        return $this->getVolWorkTechnicVersions($criteria, $con);
    }

    /**
     * Compares the current object with another of its version.
     * <code>
     * print_r($book->compareVersion(1));
     * => array(
     *   '1' => array('Title' => 'Book title at version 1'),
     *   '2' => array('Title' => 'Book title at version 2')
     * );
     * </code>
     *
     * @param int $versionNumber
     * @param string $keys Main key used for the result diff (versions|columns)
     * @param ConnectionInterface $con The ConnectionInterface connection to use.
     * @param array $ignoredColumns  The columns to exclude from the diff.
     *
     * @return array A list of differences
     */
    public function compareVersion(int $versionNumber, string $keys = 'columns', ?ConnectionInterface $con = null, array $ignoredColumns = []): array
    {
        $fromVersion = $this->toArray();
        $toVersion = $this->getOneVersion($versionNumber, $con)->toArray();

        return $this->computeDiff($fromVersion, $toVersion, $keys, $ignoredColumns);
    }

    /**
     * Compares two versions of the current object.
     * <code>
     * print_r($book->compareVersions(1, 2));
     * => array(
     *   '1' => array('Title' => 'Book title at version 1'),
     *   '2' => array('Title' => 'Book title at version 2')
     * );
     * </code>
     *
     * @param int $fromVersionNumber
     * @param int $toVersionNumber
     * @param string $keys Main key used for the result diff (versions|columns)
     * @param ConnectionInterface|null $con The ConnectionInterface connection to use.
     * @param array $ignoredColumns  The columns to exclude from the diff.
     *
     * @return array A list of differences
     */
    public function compareVersions(int $fromVersionNumber, int $toVersionNumber, string $keys = 'columns', ?ConnectionInterface $con = null, array $ignoredColumns = []): array
    {
        $fromVersion = $this->getOneVersion($fromVersionNumber, $con)->toArray();
        $toVersion = $this->getOneVersion($toVersionNumber, $con)->toArray();

        return $this->computeDiff($fromVersion, $toVersion, $keys, $ignoredColumns);
    }

    /**
     * Computes the diff between two versions.
     * <code>
     * print_r($book->computeDiff(1, 2));
     * => array(
     *   '1' => array('Title' => 'Book title at version 1'),
     *   '2' => array('Title' => 'Book title at version 2')
     * );
     * </code>
     *
     * @param array $fromVersion     An array representing the original version.
     * @param array $toVersion       An array representing the destination version.
     * @param string $keys            Main key used for the result diff (versions|columns).
     * @param array $ignoredColumns  The columns to exclude from the diff.
     *
     * @return array A list of differences
     */
    protected function computeDiff($fromVersion, $toVersion, $keys = 'columns', $ignoredColumns = [])
    {
        $fromVersionNumber = $fromVersion['Version'];
        $toVersionNumber = $toVersion['Version'];
        $ignoredColumns = array_merge(array(
            'Version',
            'VersionCreatedAt',
            'VersionCreatedBy',
            'VersionComment',
        ), $ignoredColumns);
        $diff = [];
        foreach ($fromVersion as $key => $value) {
            if (in_array($key, $ignoredColumns)) {
                continue;
            }
            if ($toVersion[$key] != $value) {
                switch ($keys) {
                    case 'versions':
                        $diff[$fromVersionNumber][$key] = $value;
                        $diff[$toVersionNumber][$key] = $toVersion[$key];
                        break;
                    default:
                        $diff[$key] = [
                            $fromVersionNumber => $value,
                            $toVersionNumber => $toVersion[$key],
                        ];
                        break;
                }
            }
        }

        return $diff;
    }
    /**
     * retrieve the last $number versions.
     *
     * @param Integer $number The number of record to return.
     * @param Criteria $criteria The Criteria object containing modified values.
     * @param ConnectionInterface $con The ConnectionInterface connection to use.
     *
     * @return PropelCollection|\DB\VolWorkTechnicVersion[] List of \DB\VolWorkTechnicVersion objects
     */
    public function getLastVersions($number = 10, $criteria = null, ?ConnectionInterface $con = null)
    {
        $criteria = ChildVolWorkTechnicVersionQuery::create(null, $criteria);
        $criteria->addDescendingOrderByColumn(VolWorkTechnicVersionTableMap::COL_VERSION);
        $criteria->limit($number);

        return $this->getVolWorkTechnicVersions($criteria, $con);
    }
    /**
     * Code to be run before persisting the object
     * @param ConnectionInterface|null $con
     * @return bool
     */
    public function preSave(?ConnectionInterface $con = null): bool
    {
                return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface|null $con
     * @return void
     */
    public function postSave(?ConnectionInterface $con = null): void
    {
            }

    /**
     * Code to be run before inserting to database
     * @param ConnectionInterface|null $con
     * @return bool
     */
    public function preInsert(?ConnectionInterface $con = null): bool
    {
                return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface|null $con
     * @return void
     */
    public function postInsert(?ConnectionInterface $con = null): void
    {
            }

    /**
     * Code to be run before updating the object in database
     * @param ConnectionInterface|null $con
     * @return bool
     */
    public function preUpdate(?ConnectionInterface $con = null): bool
    {
                return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface|null $con
     * @return void
     */
    public function postUpdate(?ConnectionInterface $con = null): void
    {
            }

    /**
     * Code to be run before deleting the object in database
     * @param ConnectionInterface|null $con
     * @return bool
     */
    public function preDelete(?ConnectionInterface $con = null): bool
    {
                return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface|null $con
     * @return void
     */
    public function postDelete(?ConnectionInterface $con = null): void
    {
            }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);
            $inputData = $params[0];
            $keyType = $params[1] ?? TableMap::TYPE_PHPNAME;

            return $this->importFrom($format, $inputData, $keyType);
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = $params[0] ?? true;
            $keyType = $params[1] ?? TableMap::TYPE_PHPNAME;

            return $this->exportTo($format, $includeLazyLoadColumns, $keyType);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
