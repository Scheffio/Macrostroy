<?php

namespace DB\Base;

use \DateTime;
use \Exception;
use inc\artemy\v1\auth\Auth;
use \PDO;
use DB\Groups as ChildGroups;
use DB\GroupsQuery as ChildGroupsQuery;
use DB\GroupsVersionQuery as ChildGroupsVersionQuery;
use DB\House as ChildHouse;
use DB\HouseQuery as ChildHouseQuery;
use DB\HouseVersion as ChildHouseVersion;
use DB\HouseVersionQuery as ChildHouseVersionQuery;
use DB\Stage as ChildStage;
use DB\StageQuery as ChildStageQuery;
use DB\StageVersionQuery as ChildStageVersionQuery;
use DB\Map\HouseTableMap;
use DB\Map\HouseVersionTableMap;
use DB\Map\StageTableMap;
use DB\Map\StageVersionTableMap;
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
 * Base class that represents a row from the 'house' table.
 *
 *
 *
 * @package    propel.generator.DB.Base
 */
abstract class House implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\DB\\Map\\HouseTableMap';


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
     * ID дома
     * @var        int
     */
    protected $id;

    /**
     * The value for the name field.
     * Наименование
     * @var        string
     */
    protected $name;

    /**
     * The value for the status field.
     * Статус (в процессе, завершен, удален)
     * Note: this column has a database default value of: 'in_process'
     * @var        string
     */
    protected $status;

    /**
     * The value for the is_available field.
     * Доступ (публичный, приватный)
     * Note: this column has a database default value of: true
     * @var        boolean
     */
    protected $is_available;

    /**
     * The value for the group_id field.
     * Id группы
     * @var        int
     */
    protected $group_id;

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
     * The value for the version_created_by field.
     *
     * @var        string|null
     */
    protected $version_created_by;

    /**
     * The value for the version_comment field.
     *
     * @var        string|null
     */
    protected $version_comment;

    /**
     * @var        ChildGroups
     */
    protected $aGroups;

    /**
     * @var        ObjectCollection|ChildStage[] Collection to store aggregation of ChildStage objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildStage> Collection to store aggregation of ChildStage objects.
     */
    protected $collStages;
    protected $collStagesPartial;

    /**
     * @var        ObjectCollection|ChildHouseVersion[] Collection to store aggregation of ChildHouseVersion objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildHouseVersion> Collection to store aggregation of ChildHouseVersion objects.
     */
    protected $collHouseVersions;
    protected $collHouseVersionsPartial;

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
     * @var ObjectCollection|ChildStage[]
     * @phpstan-var ObjectCollection&\Traversable<ChildStage>
     */
    protected $stagesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildHouseVersion[]
     * @phpstan-var ObjectCollection&\Traversable<ChildHouseVersion>
     */
    protected $houseVersionsScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
        $this->status = 'in_process';
        $this->is_available = true;
        $this->version = 0;
    }

    /**
     * Initializes internal state of DB\Base\House object.
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
     * Compares this with another <code>House</code> instance.  If
     * <code>obj</code> is an instance of <code>House</code>, delegates to
     * <code>equals(House)</code>.  Otherwise, returns <code>false</code>.
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
     * ID дома
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the [name] column value.
     * Наименование
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the [status] column value.
     * Статус (в процессе, завершен, удален)
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Get the [is_available] column value.
     * Доступ (публичный, приватный)
     * @return boolean
     */
    public function getIsAvailable()
    {
        return $this->is_available;
    }

    /**
     * Get the [is_available] column value.
     * Доступ (публичный, приватный)
     * @return boolean
     */
    public function isAvailable()
    {
        return $this->getIsAvailable();
    }

    /**
     * Get the [group_id] column value.
     * Id группы
     * @return int
     */
    public function getGroupId()
    {
        return $this->group_id;
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
     * Get the [version_created_by] column value.
     *
     * @return string|null
     */
    public function getVersionCreatedBy()
    {
        return $this->version_created_by;
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
     * ID дома
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
            $this->modifiedColumns[HouseTableMap::COL_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [name] column.
     * Наименование
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[HouseTableMap::COL_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [status] column.
     * Статус (в процессе, завершен, удален)
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setStatus($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->status !== $v) {
            $this->status = $v;
            $this->modifiedColumns[HouseTableMap::COL_STATUS] = true;
        }

        return $this;
    }

    /**
     * Sets the value of the [is_available] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * Доступ (публичный, приватный)
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
            $this->modifiedColumns[HouseTableMap::COL_IS_AVAILABLE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [group_id] column.
     * Id группы
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setGroupId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->group_id !== $v) {
            $this->group_id = $v;
            $this->modifiedColumns[HouseTableMap::COL_GROUP_ID] = true;
        }

        if ($this->aGroups !== null && $this->aGroups->getId() !== $v) {
            $this->aGroups = null;
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
            $this->modifiedColumns[HouseTableMap::COL_VERSION] = true;
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
                $this->modifiedColumns[HouseTableMap::COL_VERSION_CREATED_AT] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [version_created_by] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setVersionCreatedBy($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->version_created_by !== $v) {
            $this->version_created_by = $v;
            $this->modifiedColumns[HouseTableMap::COL_VERSION_CREATED_BY] = true;
        }

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
            $this->modifiedColumns[HouseTableMap::COL_VERSION_COMMENT] = true;
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
            if ($this->status !== 'in_process') {
                return false;
            }

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : HouseTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : HouseTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : HouseTableMap::translateFieldName('Status', TableMap::TYPE_PHPNAME, $indexType)];
            $this->status = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : HouseTableMap::translateFieldName('IsAvailable', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_available = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : HouseTableMap::translateFieldName('GroupId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->group_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : HouseTableMap::translateFieldName('Version', TableMap::TYPE_PHPNAME, $indexType)];
            $this->version = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : HouseTableMap::translateFieldName('VersionCreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->version_created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : HouseTableMap::translateFieldName('VersionCreatedBy', TableMap::TYPE_PHPNAME, $indexType)];
            $this->version_created_by = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : HouseTableMap::translateFieldName('VersionComment', TableMap::TYPE_PHPNAME, $indexType)];
            $this->version_comment = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 9; // 9 = HouseTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\DB\\House'), 0, $e);
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
        if ($this->aGroups !== null && $this->group_id !== $this->aGroups->getId()) {
            $this->aGroups = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(HouseTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildHouseQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aGroups = null;
            $this->collStages = null;

            $this->collHouseVersions = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see House::setDeleted()
     * @see House::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(HouseTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildHouseQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(HouseTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            // versionable behavior
            if ($this->isVersioningNecessary()) {
                $this->setVersion($this->isNew() ? 1 : $this->getLastVersionNumber($con) + 1);
                if (!$this->isColumnModified(HouseTableMap::COL_VERSION_CREATED_AT)) {
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
                HouseTableMap::addInstanceToPool($this);
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

            if ($this->aGroups !== null) {
                if ($this->aGroups->isModified() || $this->aGroups->isNew()) {
                    $affectedRows += $this->aGroups->save($con);
                }
                $this->setGroups($this->aGroups);
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

            if ($this->stagesScheduledForDeletion !== null) {
                if (!$this->stagesScheduledForDeletion->isEmpty()) {
                    \DB\StageQuery::create()
                        ->filterByPrimaryKeys($this->stagesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->stagesScheduledForDeletion = null;
                }
            }

            if ($this->collStages !== null) {
                foreach ($this->collStages as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->houseVersionsScheduledForDeletion !== null) {
                if (!$this->houseVersionsScheduledForDeletion->isEmpty()) {
                    \DB\HouseVersionQuery::create()
                        ->filterByPrimaryKeys($this->houseVersionsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->houseVersionsScheduledForDeletion = null;
                }
            }

            if ($this->collHouseVersions !== null) {
                foreach ($this->collHouseVersions as $referrerFK) {
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

        $this->modifiedColumns[HouseTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . HouseTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(HouseTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(HouseTableMap::COL_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'name';
        }
        if ($this->isColumnModified(HouseTableMap::COL_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'status';
        }
        if ($this->isColumnModified(HouseTableMap::COL_IS_AVAILABLE)) {
            $modifiedColumns[':p' . $index++]  = 'is_available';
        }
        if ($this->isColumnModified(HouseTableMap::COL_GROUP_ID)) {
            $modifiedColumns[':p' . $index++]  = 'group_id';
        }
        if ($this->isColumnModified(HouseTableMap::COL_VERSION)) {
            $modifiedColumns[':p' . $index++]  = 'version';
        }
        if ($this->isColumnModified(HouseTableMap::COL_VERSION_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'version_created_at';
        }
        if ($this->isColumnModified(HouseTableMap::COL_VERSION_CREATED_BY)) {
            $modifiedColumns[':p' . $index++]  = 'version_created_by';
        }
        if ($this->isColumnModified(HouseTableMap::COL_VERSION_COMMENT)) {
            $modifiedColumns[':p' . $index++]  = 'version_comment';
        }

        $sql = sprintf(
            'INSERT INTO house (%s) VALUES (%s)',
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
                    case 'name':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);
                        break;
                    case 'status':
                        $stmt->bindValue($identifier, $this->status, PDO::PARAM_STR);
                        break;
                    case 'is_available':
                        $stmt->bindValue($identifier, (int) $this->is_available, PDO::PARAM_INT);
                        break;
                    case 'group_id':
                        $stmt->bindValue($identifier, $this->group_id, PDO::PARAM_INT);
                        break;
                    case 'version':
                        $stmt->bindValue($identifier, $this->version, PDO::PARAM_INT);
                        break;
                    case 'version_created_at':
                        $stmt->bindValue($identifier, $this->version_created_at ? $this->version_created_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'version_created_by':
                        $stmt->bindValue($identifier, $this->version_created_by, PDO::PARAM_STR);
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
        $pos = HouseTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getName();

            case 2:
                return $this->getStatus();

            case 3:
                return $this->getIsAvailable();

            case 4:
                return $this->getGroupId();

            case 5:
                return $this->getVersion();

            case 6:
                return $this->getVersionCreatedAt();

            case 7:
                return $this->getVersionCreatedBy();

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
        if (isset($alreadyDumpedObjects['House'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['House'][$this->hashCode()] = true;
        $keys = HouseTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getId(),
            $keys[1] => $this->getName(),
            $keys[2] => $this->getStatus(),
            $keys[3] => $this->getIsAvailable(),
            $keys[4] => $this->getGroupId(),
            $keys[5] => $this->getVersion(),
            $keys[6] => $this->getVersionCreatedAt(),
            $keys[7] => $this->getVersionCreatedBy(),
            $keys[8] => $this->getVersionComment(),
        ];
        if ($result[$keys[6]] instanceof \DateTimeInterface) {
            $result[$keys[6]] = $result[$keys[6]]->format('Y-m-d H:i:s.u');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aGroups) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'groups';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'groups';
                        break;
                    default:
                        $key = 'Groups';
                }

                $result[$key] = $this->aGroups->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collStages) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'stages';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'stages';
                        break;
                    default:
                        $key = 'Stages';
                }

                $result[$key] = $this->collStages->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collHouseVersions) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'houseVersions';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'house_versions';
                        break;
                    default:
                        $key = 'HouseVersions';
                }

                $result[$key] = $this->collHouseVersions->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = HouseTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setName($value);
                break;
            case 2:
                $this->setStatus($value);
                break;
            case 3:
                $this->setIsAvailable($value);
                break;
            case 4:
                $this->setGroupId($value);
                break;
            case 5:
                $this->setVersion($value);
                break;
            case 6:
                $this->setVersionCreatedAt($value);
                break;
            case 7:
                $this->setVersionCreatedBy($value);
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
        $keys = HouseTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setName($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setStatus($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setIsAvailable($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setGroupId($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setVersion($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setVersionCreatedAt($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setVersionCreatedBy($arr[$keys[7]]);
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
        $criteria = new Criteria(HouseTableMap::DATABASE_NAME);

        if ($this->isColumnModified(HouseTableMap::COL_ID)) {
            $criteria->add(HouseTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(HouseTableMap::COL_NAME)) {
            $criteria->add(HouseTableMap::COL_NAME, $this->name);
        }
        if ($this->isColumnModified(HouseTableMap::COL_STATUS)) {
            $criteria->add(HouseTableMap::COL_STATUS, $this->status);
        }
        if ($this->isColumnModified(HouseTableMap::COL_IS_AVAILABLE)) {
            $criteria->add(HouseTableMap::COL_IS_AVAILABLE, $this->is_available);
        }
        if ($this->isColumnModified(HouseTableMap::COL_GROUP_ID)) {
            $criteria->add(HouseTableMap::COL_GROUP_ID, $this->group_id);
        }
        if ($this->isColumnModified(HouseTableMap::COL_VERSION)) {
            $criteria->add(HouseTableMap::COL_VERSION, $this->version);
        }
        if ($this->isColumnModified(HouseTableMap::COL_VERSION_CREATED_AT)) {
            $criteria->add(HouseTableMap::COL_VERSION_CREATED_AT, $this->version_created_at);
        }
        if ($this->isColumnModified(HouseTableMap::COL_VERSION_CREATED_BY)) {
            $criteria->add(HouseTableMap::COL_VERSION_CREATED_BY, $this->version_created_by);
        }
        if ($this->isColumnModified(HouseTableMap::COL_VERSION_COMMENT)) {
            $criteria->add(HouseTableMap::COL_VERSION_COMMENT, $this->version_comment);
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
        $criteria = ChildHouseQuery::create();
        $criteria->add(HouseTableMap::COL_ID, $this->id);

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
     * @param object $copyObj An object of \DB\House (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setName($this->getName());
        $copyObj->setStatus($this->getStatus());
        $copyObj->setIsAvailable($this->getIsAvailable());
        $copyObj->setGroupId($this->getGroupId());
        $copyObj->setVersion($this->getVersion());
        $copyObj->setVersionCreatedAt($this->getVersionCreatedAt());
        $copyObj->setVersionCreatedBy($this->getVersionCreatedBy());
        $copyObj->setVersionComment($this->getVersionComment());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getStages() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addStage($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getHouseVersions() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addHouseVersion($relObj->copy($deepCopy));
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
     * @return \DB\House Clone of current object.
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
     * Declares an association between this object and a ChildGroups object.
     *
     * @param ChildGroups $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setGroups(ChildGroups $v = null)
    {
        if ($v === null) {
            $this->setGroupId(NULL);
        } else {
            $this->setGroupId($v->getId());
        }

        $this->aGroups = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildGroups object, it will not be re-added.
        if ($v !== null) {
            $v->addHouse($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildGroups object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildGroups The associated ChildGroups object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getGroups(?ConnectionInterface $con = null)
    {
        if ($this->aGroups === null && ($this->group_id != 0)) {
            $this->aGroups = ChildGroupsQuery::create()->findPk($this->group_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aGroups->addHouses($this);
             */
        }

        return $this->aGroups;
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
        if ('Stage' === $relationName) {
            $this->initStages();
            return;
        }
        if ('HouseVersion' === $relationName) {
            $this->initHouseVersions();
            return;
        }
    }

    /**
     * Clears out the collStages collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addStages()
     */
    public function clearStages()
    {
        $this->collStages = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collStages collection loaded partially.
     *
     * @return void
     */
    public function resetPartialStages($v = true): void
    {
        $this->collStagesPartial = $v;
    }

    /**
     * Initializes the collStages collection.
     *
     * By default this just sets the collStages collection to an empty array (like clearcollStages());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initStages(bool $overrideExisting = true): void
    {
        if (null !== $this->collStages && !$overrideExisting) {
            return;
        }

        $collectionClassName = StageTableMap::getTableMap()->getCollectionClassName();

        $this->collStages = new $collectionClassName;
        $this->collStages->setModel('\DB\Stage');
    }

    /**
     * Gets an array of ChildStage objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildHouse is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildStage[] List of ChildStage objects
     * @phpstan-return ObjectCollection&\Traversable<ChildStage> List of ChildStage objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getStages(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collStagesPartial && !$this->isNew();
        if (null === $this->collStages || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collStages) {
                    $this->initStages();
                } else {
                    $collectionClassName = StageTableMap::getTableMap()->getCollectionClassName();

                    $collStages = new $collectionClassName;
                    $collStages->setModel('\DB\Stage');

                    return $collStages;
                }
            } else {
                $collStages = ChildStageQuery::create(null, $criteria)
                    ->filterByHouse($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collStagesPartial && count($collStages)) {
                        $this->initStages(false);

                        foreach ($collStages as $obj) {
                            if (false == $this->collStages->contains($obj)) {
                                $this->collStages->append($obj);
                            }
                        }

                        $this->collStagesPartial = true;
                    }

                    return $collStages;
                }

                if ($partial && $this->collStages) {
                    foreach ($this->collStages as $obj) {
                        if ($obj->isNew()) {
                            $collStages[] = $obj;
                        }
                    }
                }

                $this->collStages = $collStages;
                $this->collStagesPartial = false;
            }
        }

        return $this->collStages;
    }

    /**
     * Sets a collection of ChildStage objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $stages A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setStages(Collection $stages, ?ConnectionInterface $con = null)
    {
        /** @var ChildStage[] $stagesToDelete */
        $stagesToDelete = $this->getStages(new Criteria(), $con)->diff($stages);


        $this->stagesScheduledForDeletion = $stagesToDelete;

        foreach ($stagesToDelete as $stageRemoved) {
            $stageRemoved->setHouse(null);
        }

        $this->collStages = null;
        foreach ($stages as $stage) {
            $this->addStage($stage);
        }

        $this->collStages = $stages;
        $this->collStagesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Stage objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Stage objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countStages(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collStagesPartial && !$this->isNew();
        if (null === $this->collStages || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collStages) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getStages());
            }

            $query = ChildStageQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByHouse($this)
                ->count($con);
        }

        return count($this->collStages);
    }

    /**
     * Method called to associate a ChildStage object to this object
     * through the ChildStage foreign key attribute.
     *
     * @param ChildStage $l ChildStage
     * @return $this The current object (for fluent API support)
     */
    public function addStage(ChildStage $l)
    {
        if ($this->collStages === null) {
            $this->initStages();
            $this->collStagesPartial = true;
        }

        if (!$this->collStages->contains($l)) {
            $this->doAddStage($l);

            if ($this->stagesScheduledForDeletion and $this->stagesScheduledForDeletion->contains($l)) {
                $this->stagesScheduledForDeletion->remove($this->stagesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildStage $stage The ChildStage object to add.
     */
    protected function doAddStage(ChildStage $stage): void
    {
        $this->collStages[]= $stage;
        $stage->setHouse($this);
    }

    /**
     * @param ChildStage $stage The ChildStage object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeStage(ChildStage $stage)
    {
        if ($this->getStages()->contains($stage)) {
            $pos = $this->collStages->search($stage);
            $this->collStages->remove($pos);
            if (null === $this->stagesScheduledForDeletion) {
                $this->stagesScheduledForDeletion = clone $this->collStages;
                $this->stagesScheduledForDeletion->clear();
            }
            $this->stagesScheduledForDeletion[]= clone $stage;
            $stage->setHouse(null);
        }

        return $this;
    }

    /**
     * Clears out the collHouseVersions collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addHouseVersions()
     */
    public function clearHouseVersions()
    {
        $this->collHouseVersions = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collHouseVersions collection loaded partially.
     *
     * @return void
     */
    public function resetPartialHouseVersions($v = true): void
    {
        $this->collHouseVersionsPartial = $v;
    }

    /**
     * Initializes the collHouseVersions collection.
     *
     * By default this just sets the collHouseVersions collection to an empty array (like clearcollHouseVersions());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initHouseVersions(bool $overrideExisting = true): void
    {
        if (null !== $this->collHouseVersions && !$overrideExisting) {
            return;
        }

        $collectionClassName = HouseVersionTableMap::getTableMap()->getCollectionClassName();

        $this->collHouseVersions = new $collectionClassName;
        $this->collHouseVersions->setModel('\DB\HouseVersion');
    }

    /**
     * Gets an array of ChildHouseVersion objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildHouse is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildHouseVersion[] List of ChildHouseVersion objects
     * @phpstan-return ObjectCollection&\Traversable<ChildHouseVersion> List of ChildHouseVersion objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getHouseVersions(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collHouseVersionsPartial && !$this->isNew();
        if (null === $this->collHouseVersions || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collHouseVersions) {
                    $this->initHouseVersions();
                } else {
                    $collectionClassName = HouseVersionTableMap::getTableMap()->getCollectionClassName();

                    $collHouseVersions = new $collectionClassName;
                    $collHouseVersions->setModel('\DB\HouseVersion');

                    return $collHouseVersions;
                }
            } else {
                $collHouseVersions = ChildHouseVersionQuery::create(null, $criteria)
                    ->filterByHouse($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collHouseVersionsPartial && count($collHouseVersions)) {
                        $this->initHouseVersions(false);

                        foreach ($collHouseVersions as $obj) {
                            if (false == $this->collHouseVersions->contains($obj)) {
                                $this->collHouseVersions->append($obj);
                            }
                        }

                        $this->collHouseVersionsPartial = true;
                    }

                    return $collHouseVersions;
                }

                if ($partial && $this->collHouseVersions) {
                    foreach ($this->collHouseVersions as $obj) {
                        if ($obj->isNew()) {
                            $collHouseVersions[] = $obj;
                        }
                    }
                }

                $this->collHouseVersions = $collHouseVersions;
                $this->collHouseVersionsPartial = false;
            }
        }

        return $this->collHouseVersions;
    }

    /**
     * Sets a collection of ChildHouseVersion objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $houseVersions A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setHouseVersions(Collection $houseVersions, ?ConnectionInterface $con = null)
    {
        /** @var ChildHouseVersion[] $houseVersionsToDelete */
        $houseVersionsToDelete = $this->getHouseVersions(new Criteria(), $con)->diff($houseVersions);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->houseVersionsScheduledForDeletion = clone $houseVersionsToDelete;

        foreach ($houseVersionsToDelete as $houseVersionRemoved) {
            $houseVersionRemoved->setHouse(null);
        }

        $this->collHouseVersions = null;
        foreach ($houseVersions as $houseVersion) {
            $this->addHouseVersion($houseVersion);
        }

        $this->collHouseVersions = $houseVersions;
        $this->collHouseVersionsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related HouseVersion objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related HouseVersion objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countHouseVersions(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collHouseVersionsPartial && !$this->isNew();
        if (null === $this->collHouseVersions || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collHouseVersions) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getHouseVersions());
            }

            $query = ChildHouseVersionQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByHouse($this)
                ->count($con);
        }

        return count($this->collHouseVersions);
    }

    /**
     * Method called to associate a ChildHouseVersion object to this object
     * through the ChildHouseVersion foreign key attribute.
     *
     * @param ChildHouseVersion $l ChildHouseVersion
     * @return $this The current object (for fluent API support)
     */
    public function addHouseVersion(ChildHouseVersion $l)
    {
        if ($this->collHouseVersions === null) {
            $this->initHouseVersions();
            $this->collHouseVersionsPartial = true;
        }

        if (!$this->collHouseVersions->contains($l)) {
            $this->doAddHouseVersion($l);

            if ($this->houseVersionsScheduledForDeletion and $this->houseVersionsScheduledForDeletion->contains($l)) {
                $this->houseVersionsScheduledForDeletion->remove($this->houseVersionsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildHouseVersion $houseVersion The ChildHouseVersion object to add.
     */
    protected function doAddHouseVersion(ChildHouseVersion $houseVersion): void
    {
        $this->collHouseVersions[]= $houseVersion;
        $houseVersion->setHouse($this);
    }

    /**
     * @param ChildHouseVersion $houseVersion The ChildHouseVersion object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeHouseVersion(ChildHouseVersion $houseVersion)
    {
        if ($this->getHouseVersions()->contains($houseVersion)) {
            $pos = $this->collHouseVersions->search($houseVersion);
            $this->collHouseVersions->remove($pos);
            if (null === $this->houseVersionsScheduledForDeletion) {
                $this->houseVersionsScheduledForDeletion = clone $this->collHouseVersions;
                $this->houseVersionsScheduledForDeletion->clear();
            }
            $this->houseVersionsScheduledForDeletion[]= clone $houseVersion;
            $houseVersion->setHouse(null);
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
        if (null !== $this->aGroups) {
            $this->aGroups->removeHouse($this);
        }
        $this->id = null;
        $this->name = null;
        $this->status = null;
        $this->is_available = null;
        $this->group_id = null;
        $this->version = null;
        $this->version_created_at = null;
        $this->version_created_by = null;
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
            if ($this->collStages) {
                foreach ($this->collStages as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collHouseVersions) {
                foreach ($this->collHouseVersions as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collStages = null;
        $this->collHouseVersions = null;
        $this->aGroups = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(HouseTableMap::DEFAULT_STRING_FORMAT);
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

        if (ChildHouseQuery::isVersioningEnabled() && ($this->isNew() || $this->isModified()) || $this->isDeleted()) {
            return true;
        }
        if (null !== ($object = $this->getGroups($con)) && $object->isVersioningNecessary($con)) {
            return true;
        }

        if ($this->collStages) {

            // to avoid infinite loops, emulate in save
            $this->alreadyInSave = true;

            foreach ($this->getStages(null, $con) as $relatedObject) {

                if ($relatedObject->isVersioningNecessary($con)) {

                    $this->alreadyInSave = false;
                    return true;
                }
            }
            $this->alreadyInSave = false;
        }


        return false;
    }

    /**
     * Creates a version of the current object and saves it.
     *
     * @param ConnectionInterface $con The ConnectionInterface connection to use.
     *
     * @return ChildHouseVersion A version object
     */
    public function addVersion(?ConnectionInterface $con = null)
    {
        $this->enforceVersion = false;

        $version = new ChildHouseVersion();
        $version->setId($this->getId());
        $version->setName($this->getName());
        $version->setStatus($this->getStatus());
        $version->setIsAvailable($this->getIsAvailable());
        $version->setGroupId($this->getGroupId());
        $version->setVersion($this->getVersion());
        $version->setVersionCreatedAt($this->getVersionCreatedAt());
        $version->setVersionCreatedBy($this->getVersionCreatedBy());
        $version->setVersionComment($this->getVersionComment());
        $version->setHouse($this);
        if (($related = $this->getGroups(null, $con)) && $related->getVersion()) {
            $version->setGroupIdVersion($related->getVersion());
        }
        $object = $this->getStages(null, $con);


        if ($object && $relateds = $object->toKeyValue('Id', 'Version')) {
            $version->setStageIds(array_keys($relateds));
            $version->setStageVersions(array_values($relateds));
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
            throw new PropelException(sprintf('No ChildHouse object found with version %d', $version));
        }
        $this->populateFromVersion($version, $con);

        return $this;
    }

    /**
     * Sets the properties of the current object to the value they had at a specific version
     *
     * @param ChildHouseVersion $version The version object to use
     * @param ConnectionInterface $con the connection to use
     * @param array $loadedObjects objects that been loaded in a chain of populateFromVersion calls on referrer or fk objects.
     *
     * @return $this The current object (for fluent API support)
     */
    public function populateFromVersion($version, $con = null, &$loadedObjects = [])
    {
        $loadedObjects['ChildHouse'][$version->getId()][$version->getVersion()] = $this;
        $this->setId($version->getId());
        $this->setName($version->getName());
        $this->setStatus($version->getStatus());
        $this->setIsAvailable($version->getIsAvailable());
        $this->setGroupId($version->getGroupId());
        $this->setVersion($version->getVersion());
        $this->setVersionCreatedAt($version->getVersionCreatedAt());
        $this->setVersionCreatedBy($version->getVersionCreatedBy());
        $this->setVersionComment($version->getVersionComment());
        if ($fkValue = $version->getGroupId()) {
            if (isset($loadedObjects['ChildGroups']) && isset($loadedObjects['ChildGroups'][$fkValue]) && isset($loadedObjects['ChildGroups'][$fkValue][$version->getGroupIdVersion()])) {
                $related = $loadedObjects['ChildGroups'][$fkValue][$version->getGroupIdVersion()];
            } else {
                $related = new ChildGroups();
                $relatedVersion = ChildGroupsVersionQuery::create()
                    ->filterById($fkValue)
                    ->filterByVersionComment($version->getGroupIdVersion())
                    ->findOne($con);
                $related->populateFromVersion($relatedVersion, $con, $loadedObjects);
                $related->setNew(false);
            }
            $this->setGroups($related);
        }
        if ($fkValues = $version->getStageIds()) {
            $this->clearStages();
            $fkVersions = $version->getStageVersions();
            $query = ChildStageVersionQuery::create();
            foreach ($fkValues as $key => $value) {
                $c1 = $query->getNewCriterion(StageVersionTableMap::COL_ID, $value);
                $c2 = $query->getNewCriterion(StageVersionTableMap::COL_VERSION, $fkVersions[$key]);
                $c1->addAnd($c2);
                $query->addOr($c1);
            }
            foreach ($query->find($con) as $relatedVersion) {
                if (isset($loadedObjects['ChildStage']) && isset($loadedObjects['ChildStage'][$relatedVersion->getId()]) && isset($loadedObjects['ChildStage'][$relatedVersion->getId()][$relatedVersion->getVersion()])) {
                    $related = $loadedObjects['ChildStage'][$relatedVersion->getId()][$relatedVersion->getVersion()];
                } else {
                    $related = new ChildStage();
                    $related->populateFromVersion($relatedVersion, $con, $loadedObjects);
                    $related->setNew(false);
                }
                $this->addStage($related);
                $this->collStagesPartial = false;
            }
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
        $v = ChildHouseVersionQuery::create()
            ->filterByHouse($this)
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
     * @return ChildHouseVersion A version object
     */
    public function getOneVersion(int $versionNumber, ?ConnectionInterface $con = null)
    {
        return ChildHouseVersionQuery::create()
            ->filterByHouse($this)
            ->filterByVersion($versionNumber)
            ->findOne($con);
    }

    /**
     * Gets all the versions of this object, in incremental order
     *
     * @param ConnectionInterface $con The ConnectionInterface connection to use.
     *
     * @return ObjectCollection|ChildHouseVersion[] A list of ChildHouseVersion objects
     */
    public function getAllVersions(?ConnectionInterface $con = null)
    {
        $criteria = new Criteria();
        $criteria->addAscendingOrderByColumn(HouseVersionTableMap::COL_VERSION);

        return $this->getHouseVersions($criteria, $con);
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
     * @return PropelCollection|\DB\HouseVersion[] List of \DB\HouseVersion objects
     */
    public function getLastVersions($number = 10, $criteria = null, ?ConnectionInterface $con = null)
    {
        $criteria = ChildHouseVersionQuery::create(null, $criteria);
        $criteria->addDescendingOrderByColumn(HouseVersionTableMap::COL_VERSION);
        $criteria->limit($number);

        return $this->getHouseVersions($criteria, $con);
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
        $this->setVersionCreatedBy(Auth::getUser()->id());
        $this->setVersionComment('insert');

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
        $this->setVersionCreatedBy(Auth::getUser()->id());

        if ($this->status === 'deleted') {
            $this->setVersionComment('delete');
            $this->setIsAvailable(false);
        } else $this->setVersionComment('update');

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
