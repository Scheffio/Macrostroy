<?php

namespace DB\Base;

use \DateTime;
use \Exception;
use \PDO;
use DB\ObjGroup as ChildObjGroup;
use DB\ObjGroupQuery as ChildObjGroupQuery;
use DB\ObjGroupVersion as ChildObjGroupVersion;
use DB\ObjGroupVersionQuery as ChildObjGroupVersionQuery;
use DB\ObjHouse as ChildObjHouse;
use DB\ObjHouseQuery as ChildObjHouseQuery;
use DB\ObjHouseVersionQuery as ChildObjHouseVersionQuery;
use DB\ObjSubproject as ChildObjSubproject;
use DB\ObjSubprojectQuery as ChildObjSubprojectQuery;
use DB\ObjSubprojectVersionQuery as ChildObjSubprojectVersionQuery;
use DB\Map\ObjGroupTableMap;
use DB\Map\ObjGroupVersionTableMap;
use DB\Map\ObjHouseTableMap;
use DB\Map\ObjHouseVersionTableMap;
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
 * Base class that represents a row from the 'obj_group' table.
 *
 *
 *
 * @package    propel.generator.DB.Base
 */
abstract class ObjGroup implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\DB\\Map\\ObjGroupTableMap';


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
     * ID группы
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
     * The value for the is_public field.
     * Доступ (публичный, приватный)
     * Note: this column has a database default value of: true
     * @var        boolean
     */
    protected $is_public;

    /**
     * The value for the is_available field.
     * Доступ (доступный, удаленный)
     * Note: this column has a database default value of: true
     * @var        boolean
     */
    protected $is_available;

    /**
     * The value for the subproject_id field.
     * ID подпроекта
     * @var        int
     */
    protected $subproject_id;

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
     * @var        ChildObjSubproject
     */
    protected $aObjSubproject;

    /**
     * @var        ObjectCollection|ChildObjHouse[] Collection to store aggregation of ChildObjHouse objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildObjHouse> Collection to store aggregation of ChildObjHouse objects.
     */
    protected $collObjHouses;
    protected $collObjHousesPartial;

    /**
     * @var        ObjectCollection|ChildObjGroupVersion[] Collection to store aggregation of ChildObjGroupVersion objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildObjGroupVersion> Collection to store aggregation of ChildObjGroupVersion objects.
     */
    protected $collObjGroupVersions;
    protected $collObjGroupVersionsPartial;

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
     * @var ObjectCollection|ChildObjHouse[]
     * @phpstan-var ObjectCollection&\Traversable<ChildObjHouse>
     */
    protected $objHousesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildObjGroupVersion[]
     * @phpstan-var ObjectCollection&\Traversable<ChildObjGroupVersion>
     */
    protected $objGroupVersionsScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
        $this->status = 'in_process';
        $this->is_public = true;
        $this->is_available = true;
        $this->version = 0;
    }

    /**
     * Initializes internal state of DB\Base\ObjGroup object.
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
     * Compares this with another <code>ObjGroup</code> instance.  If
     * <code>obj</code> is an instance of <code>ObjGroup</code>, delegates to
     * <code>equals(ObjGroup)</code>.  Otherwise, returns <code>false</code>.
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
     * ID группы
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
     * Get the [is_public] column value.
     * Доступ (публичный, приватный)
     * @return boolean
     */
    public function getIsPublic()
    {
        return $this->is_public;
    }

    /**
     * Get the [is_public] column value.
     * Доступ (публичный, приватный)
     * @return boolean
     */
    public function isPublic()
    {
        return $this->getIsPublic();
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
     * Get the [subproject_id] column value.
     * ID подпроекта
     * @return int
     */
    public function getSubprojectId()
    {
        return $this->subproject_id;
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
     * ID группы
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
            $this->modifiedColumns[ObjGroupTableMap::COL_ID] = true;
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
            $this->modifiedColumns[ObjGroupTableMap::COL_NAME] = true;
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
            $this->modifiedColumns[ObjGroupTableMap::COL_STATUS] = true;
        }

        return $this;
    }

    /**
     * Sets the value of the [is_public] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * Доступ (публичный, приватный)
     * @param bool|integer|string $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setIsPublic($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->is_public !== $v) {
            $this->is_public = $v;
            $this->modifiedColumns[ObjGroupTableMap::COL_IS_PUBLIC] = true;
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
            $this->modifiedColumns[ObjGroupTableMap::COL_IS_AVAILABLE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [subproject_id] column.
     * ID подпроекта
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setSubprojectId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->subproject_id !== $v) {
            $this->subproject_id = $v;
            $this->modifiedColumns[ObjGroupTableMap::COL_SUBPROJECT_ID] = true;
        }

        if ($this->aObjSubproject !== null && $this->aObjSubproject->getId() !== $v) {
            $this->aObjSubproject = null;
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
            $this->modifiedColumns[ObjGroupTableMap::COL_VERSION] = true;
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
                $this->modifiedColumns[ObjGroupTableMap::COL_VERSION_CREATED_AT] = true;
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
            $this->modifiedColumns[ObjGroupTableMap::COL_VERSION_CREATED_BY] = true;
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
            $this->modifiedColumns[ObjGroupTableMap::COL_VERSION_COMMENT] = true;
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

            if ($this->is_public !== true) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : ObjGroupTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : ObjGroupTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : ObjGroupTableMap::translateFieldName('Status', TableMap::TYPE_PHPNAME, $indexType)];
            $this->status = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : ObjGroupTableMap::translateFieldName('IsPublic', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_public = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : ObjGroupTableMap::translateFieldName('IsAvailable', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_available = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : ObjGroupTableMap::translateFieldName('SubprojectId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->subproject_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : ObjGroupTableMap::translateFieldName('Version', TableMap::TYPE_PHPNAME, $indexType)];
            $this->version = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : ObjGroupTableMap::translateFieldName('VersionCreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->version_created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : ObjGroupTableMap::translateFieldName('VersionCreatedBy', TableMap::TYPE_PHPNAME, $indexType)];
            $this->version_created_by = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : ObjGroupTableMap::translateFieldName('VersionComment', TableMap::TYPE_PHPNAME, $indexType)];
            $this->version_comment = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 10; // 10 = ObjGroupTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\DB\\ObjGroup'), 0, $e);
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
        if ($this->aObjSubproject !== null && $this->subproject_id !== $this->aObjSubproject->getId()) {
            $this->aObjSubproject = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(ObjGroupTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildObjGroupQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aObjSubproject = null;
            $this->collObjHouses = null;

            $this->collObjGroupVersions = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see ObjGroup::setDeleted()
     * @see ObjGroup::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(ObjGroupTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildObjGroupQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(ObjGroupTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            // versionable behavior
            if ($this->isVersioningNecessary()) {
                $this->setVersion($this->isNew() ? 1 : $this->getLastVersionNumber($con) + 1);
                if (!$this->isColumnModified(ObjGroupTableMap::COL_VERSION_CREATED_AT)) {
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
                ObjGroupTableMap::addInstanceToPool($this);
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

            if ($this->aObjSubproject !== null) {
                if ($this->aObjSubproject->isModified() || $this->aObjSubproject->isNew()) {
                    $affectedRows += $this->aObjSubproject->save($con);
                }
                $this->setObjSubproject($this->aObjSubproject);
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

            if ($this->objHousesScheduledForDeletion !== null) {
                if (!$this->objHousesScheduledForDeletion->isEmpty()) {
                    \DB\ObjHouseQuery::create()
                        ->filterByPrimaryKeys($this->objHousesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->objHousesScheduledForDeletion = null;
                }
            }

            if ($this->collObjHouses !== null) {
                foreach ($this->collObjHouses as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->objGroupVersionsScheduledForDeletion !== null) {
                if (!$this->objGroupVersionsScheduledForDeletion->isEmpty()) {
                    \DB\ObjGroupVersionQuery::create()
                        ->filterByPrimaryKeys($this->objGroupVersionsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->objGroupVersionsScheduledForDeletion = null;
                }
            }

            if ($this->collObjGroupVersions !== null) {
                foreach ($this->collObjGroupVersions as $referrerFK) {
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

        $this->modifiedColumns[ObjGroupTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . ObjGroupTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(ObjGroupTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(ObjGroupTableMap::COL_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'name';
        }
        if ($this->isColumnModified(ObjGroupTableMap::COL_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'status';
        }
        if ($this->isColumnModified(ObjGroupTableMap::COL_IS_PUBLIC)) {
            $modifiedColumns[':p' . $index++]  = 'is_public';
        }
        if ($this->isColumnModified(ObjGroupTableMap::COL_IS_AVAILABLE)) {
            $modifiedColumns[':p' . $index++]  = 'is_available';
        }
        if ($this->isColumnModified(ObjGroupTableMap::COL_SUBPROJECT_ID)) {
            $modifiedColumns[':p' . $index++]  = 'subproject_id';
        }
        if ($this->isColumnModified(ObjGroupTableMap::COL_VERSION)) {
            $modifiedColumns[':p' . $index++]  = 'version';
        }
        if ($this->isColumnModified(ObjGroupTableMap::COL_VERSION_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'version_created_at';
        }
        if ($this->isColumnModified(ObjGroupTableMap::COL_VERSION_CREATED_BY)) {
            $modifiedColumns[':p' . $index++]  = 'version_created_by';
        }
        if ($this->isColumnModified(ObjGroupTableMap::COL_VERSION_COMMENT)) {
            $modifiedColumns[':p' . $index++]  = 'version_comment';
        }

        $sql = sprintf(
            'INSERT INTO obj_group (%s) VALUES (%s)',
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
                    case 'is_public':
                        $stmt->bindValue($identifier, (int) $this->is_public, PDO::PARAM_INT);
                        break;
                    case 'is_available':
                        $stmt->bindValue($identifier, (int) $this->is_available, PDO::PARAM_INT);
                        break;
                    case 'subproject_id':
                        $stmt->bindValue($identifier, $this->subproject_id, PDO::PARAM_INT);
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
        $pos = ObjGroupTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIsPublic();

            case 4:
                return $this->getIsAvailable();

            case 5:
                return $this->getSubprojectId();

            case 6:
                return $this->getVersion();

            case 7:
                return $this->getVersionCreatedAt();

            case 8:
                return $this->getVersionCreatedBy();

            case 9:
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
        if (isset($alreadyDumpedObjects['ObjGroup'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['ObjGroup'][$this->hashCode()] = true;
        $keys = ObjGroupTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getId(),
            $keys[1] => $this->getName(),
            $keys[2] => $this->getStatus(),
            $keys[3] => $this->getIsPublic(),
            $keys[4] => $this->getIsAvailable(),
            $keys[5] => $this->getSubprojectId(),
            $keys[6] => $this->getVersion(),
            $keys[7] => $this->getVersionCreatedAt(),
            $keys[8] => $this->getVersionCreatedBy(),
            $keys[9] => $this->getVersionComment(),
        ];
        if ($result[$keys[7]] instanceof \DateTimeInterface) {
            $result[$keys[7]] = $result[$keys[7]]->format('Y-m-d H:i:s.u');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aObjSubproject) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'objSubproject';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'obj_subproject';
                        break;
                    default:
                        $key = 'ObjSubproject';
                }

                $result[$key] = $this->aObjSubproject->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collObjHouses) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'objHouses';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'obj_houses';
                        break;
                    default:
                        $key = 'ObjHouses';
                }

                $result[$key] = $this->collObjHouses->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collObjGroupVersions) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'objGroupVersions';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'obj_group_versions';
                        break;
                    default:
                        $key = 'ObjGroupVersions';
                }

                $result[$key] = $this->collObjGroupVersions->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = ObjGroupTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setIsPublic($value);
                break;
            case 4:
                $this->setIsAvailable($value);
                break;
            case 5:
                $this->setSubprojectId($value);
                break;
            case 6:
                $this->setVersion($value);
                break;
            case 7:
                $this->setVersionCreatedAt($value);
                break;
            case 8:
                $this->setVersionCreatedBy($value);
                break;
            case 9:
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
        $keys = ObjGroupTableMap::getFieldNames($keyType);

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
            $this->setIsPublic($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setIsAvailable($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setSubprojectId($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setVersion($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setVersionCreatedAt($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setVersionCreatedBy($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setVersionComment($arr[$keys[9]]);
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
        $criteria = new Criteria(ObjGroupTableMap::DATABASE_NAME);

        if ($this->isColumnModified(ObjGroupTableMap::COL_ID)) {
            $criteria->add(ObjGroupTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(ObjGroupTableMap::COL_NAME)) {
            $criteria->add(ObjGroupTableMap::COL_NAME, $this->name);
        }
        if ($this->isColumnModified(ObjGroupTableMap::COL_STATUS)) {
            $criteria->add(ObjGroupTableMap::COL_STATUS, $this->status);
        }
        if ($this->isColumnModified(ObjGroupTableMap::COL_IS_PUBLIC)) {
            $criteria->add(ObjGroupTableMap::COL_IS_PUBLIC, $this->is_public);
        }
        if ($this->isColumnModified(ObjGroupTableMap::COL_IS_AVAILABLE)) {
            $criteria->add(ObjGroupTableMap::COL_IS_AVAILABLE, $this->is_available);
        }
        if ($this->isColumnModified(ObjGroupTableMap::COL_SUBPROJECT_ID)) {
            $criteria->add(ObjGroupTableMap::COL_SUBPROJECT_ID, $this->subproject_id);
        }
        if ($this->isColumnModified(ObjGroupTableMap::COL_VERSION)) {
            $criteria->add(ObjGroupTableMap::COL_VERSION, $this->version);
        }
        if ($this->isColumnModified(ObjGroupTableMap::COL_VERSION_CREATED_AT)) {
            $criteria->add(ObjGroupTableMap::COL_VERSION_CREATED_AT, $this->version_created_at);
        }
        if ($this->isColumnModified(ObjGroupTableMap::COL_VERSION_CREATED_BY)) {
            $criteria->add(ObjGroupTableMap::COL_VERSION_CREATED_BY, $this->version_created_by);
        }
        if ($this->isColumnModified(ObjGroupTableMap::COL_VERSION_COMMENT)) {
            $criteria->add(ObjGroupTableMap::COL_VERSION_COMMENT, $this->version_comment);
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
        $criteria = ChildObjGroupQuery::create();
        $criteria->add(ObjGroupTableMap::COL_ID, $this->id);

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
     * @param object $copyObj An object of \DB\ObjGroup (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setName($this->getName());
        $copyObj->setStatus($this->getStatus());
        $copyObj->setIsPublic($this->getIsPublic());
        $copyObj->setIsAvailable($this->getIsAvailable());
        $copyObj->setSubprojectId($this->getSubprojectId());
        $copyObj->setVersion($this->getVersion());
        $copyObj->setVersionCreatedAt($this->getVersionCreatedAt());
        $copyObj->setVersionCreatedBy($this->getVersionCreatedBy());
        $copyObj->setVersionComment($this->getVersionComment());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getObjHouses() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addObjHouse($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getObjGroupVersions() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addObjGroupVersion($relObj->copy($deepCopy));
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
     * @return \DB\ObjGroup Clone of current object.
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
     * Declares an association between this object and a ChildObjSubproject object.
     *
     * @param ChildObjSubproject $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setObjSubproject(ChildObjSubproject $v = null)
    {
        if ($v === null) {
            $this->setSubprojectId(NULL);
        } else {
            $this->setSubprojectId($v->getId());
        }

        $this->aObjSubproject = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildObjSubproject object, it will not be re-added.
        if ($v !== null) {
            $v->addObjGroup($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildObjSubproject object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildObjSubproject The associated ChildObjSubproject object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getObjSubproject(?ConnectionInterface $con = null)
    {
        if ($this->aObjSubproject === null && ($this->subproject_id != 0)) {
            $this->aObjSubproject = ChildObjSubprojectQuery::create()->findPk($this->subproject_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aObjSubproject->addObjGroups($this);
             */
        }

        return $this->aObjSubproject;
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
        if ('ObjHouse' === $relationName) {
            $this->initObjHouses();
            return;
        }
        if ('ObjGroupVersion' === $relationName) {
            $this->initObjGroupVersions();
            return;
        }
    }

    /**
     * Clears out the collObjHouses collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addObjHouses()
     */
    public function clearObjHouses()
    {
        $this->collObjHouses = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collObjHouses collection loaded partially.
     *
     * @return void
     */
    public function resetPartialObjHouses($v = true): void
    {
        $this->collObjHousesPartial = $v;
    }

    /**
     * Initializes the collObjHouses collection.
     *
     * By default this just sets the collObjHouses collection to an empty array (like clearcollObjHouses());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initObjHouses(bool $overrideExisting = true): void
    {
        if (null !== $this->collObjHouses && !$overrideExisting) {
            return;
        }

        $collectionClassName = ObjHouseTableMap::getTableMap()->getCollectionClassName();

        $this->collObjHouses = new $collectionClassName;
        $this->collObjHouses->setModel('\DB\ObjHouse');
    }

    /**
     * Gets an array of ChildObjHouse objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildObjGroup is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildObjHouse[] List of ChildObjHouse objects
     * @phpstan-return ObjectCollection&\Traversable<ChildObjHouse> List of ChildObjHouse objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getObjHouses(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collObjHousesPartial && !$this->isNew();
        if (null === $this->collObjHouses || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collObjHouses) {
                    $this->initObjHouses();
                } else {
                    $collectionClassName = ObjHouseTableMap::getTableMap()->getCollectionClassName();

                    $collObjHouses = new $collectionClassName;
                    $collObjHouses->setModel('\DB\ObjHouse');

                    return $collObjHouses;
                }
            } else {
                $collObjHouses = ChildObjHouseQuery::create(null, $criteria)
                    ->filterByObjGroup($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collObjHousesPartial && count($collObjHouses)) {
                        $this->initObjHouses(false);

                        foreach ($collObjHouses as $obj) {
                            if (false == $this->collObjHouses->contains($obj)) {
                                $this->collObjHouses->append($obj);
                            }
                        }

                        $this->collObjHousesPartial = true;
                    }

                    return $collObjHouses;
                }

                if ($partial && $this->collObjHouses) {
                    foreach ($this->collObjHouses as $obj) {
                        if ($obj->isNew()) {
                            $collObjHouses[] = $obj;
                        }
                    }
                }

                $this->collObjHouses = $collObjHouses;
                $this->collObjHousesPartial = false;
            }
        }

        return $this->collObjHouses;
    }

    /**
     * Sets a collection of ChildObjHouse objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $objHouses A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setObjHouses(Collection $objHouses, ?ConnectionInterface $con = null)
    {
        /** @var ChildObjHouse[] $objHousesToDelete */
        $objHousesToDelete = $this->getObjHouses(new Criteria(), $con)->diff($objHouses);


        $this->objHousesScheduledForDeletion = $objHousesToDelete;

        foreach ($objHousesToDelete as $objHouseRemoved) {
            $objHouseRemoved->setObjGroup(null);
        }

        $this->collObjHouses = null;
        foreach ($objHouses as $objHouse) {
            $this->addObjHouse($objHouse);
        }

        $this->collObjHouses = $objHouses;
        $this->collObjHousesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ObjHouse objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related ObjHouse objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countObjHouses(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collObjHousesPartial && !$this->isNew();
        if (null === $this->collObjHouses || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collObjHouses) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getObjHouses());
            }

            $query = ChildObjHouseQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByObjGroup($this)
                ->count($con);
        }

        return count($this->collObjHouses);
    }

    /**
     * Method called to associate a ChildObjHouse object to this object
     * through the ChildObjHouse foreign key attribute.
     *
     * @param ChildObjHouse $l ChildObjHouse
     * @return $this The current object (for fluent API support)
     */
    public function addObjHouse(ChildObjHouse $l)
    {
        if ($this->collObjHouses === null) {
            $this->initObjHouses();
            $this->collObjHousesPartial = true;
        }

        if (!$this->collObjHouses->contains($l)) {
            $this->doAddObjHouse($l);

            if ($this->objHousesScheduledForDeletion and $this->objHousesScheduledForDeletion->contains($l)) {
                $this->objHousesScheduledForDeletion->remove($this->objHousesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildObjHouse $objHouse The ChildObjHouse object to add.
     */
    protected function doAddObjHouse(ChildObjHouse $objHouse): void
    {
        $this->collObjHouses[]= $objHouse;
        $objHouse->setObjGroup($this);
    }

    /**
     * @param ChildObjHouse $objHouse The ChildObjHouse object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeObjHouse(ChildObjHouse $objHouse)
    {
        if ($this->getObjHouses()->contains($objHouse)) {
            $pos = $this->collObjHouses->search($objHouse);
            $this->collObjHouses->remove($pos);
            if (null === $this->objHousesScheduledForDeletion) {
                $this->objHousesScheduledForDeletion = clone $this->collObjHouses;
                $this->objHousesScheduledForDeletion->clear();
            }
            $this->objHousesScheduledForDeletion[]= clone $objHouse;
            $objHouse->setObjGroup(null);
        }

        return $this;
    }

    /**
     * Clears out the collObjGroupVersions collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addObjGroupVersions()
     */
    public function clearObjGroupVersions()
    {
        $this->collObjGroupVersions = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collObjGroupVersions collection loaded partially.
     *
     * @return void
     */
    public function resetPartialObjGroupVersions($v = true): void
    {
        $this->collObjGroupVersionsPartial = $v;
    }

    /**
     * Initializes the collObjGroupVersions collection.
     *
     * By default this just sets the collObjGroupVersions collection to an empty array (like clearcollObjGroupVersions());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initObjGroupVersions(bool $overrideExisting = true): void
    {
        if (null !== $this->collObjGroupVersions && !$overrideExisting) {
            return;
        }

        $collectionClassName = ObjGroupVersionTableMap::getTableMap()->getCollectionClassName();

        $this->collObjGroupVersions = new $collectionClassName;
        $this->collObjGroupVersions->setModel('\DB\ObjGroupVersion');
    }

    /**
     * Gets an array of ChildObjGroupVersion objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildObjGroup is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildObjGroupVersion[] List of ChildObjGroupVersion objects
     * @phpstan-return ObjectCollection&\Traversable<ChildObjGroupVersion> List of ChildObjGroupVersion objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getObjGroupVersions(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collObjGroupVersionsPartial && !$this->isNew();
        if (null === $this->collObjGroupVersions || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collObjGroupVersions) {
                    $this->initObjGroupVersions();
                } else {
                    $collectionClassName = ObjGroupVersionTableMap::getTableMap()->getCollectionClassName();

                    $collObjGroupVersions = new $collectionClassName;
                    $collObjGroupVersions->setModel('\DB\ObjGroupVersion');

                    return $collObjGroupVersions;
                }
            } else {
                $collObjGroupVersions = ChildObjGroupVersionQuery::create(null, $criteria)
                    ->filterByObjGroup($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collObjGroupVersionsPartial && count($collObjGroupVersions)) {
                        $this->initObjGroupVersions(false);

                        foreach ($collObjGroupVersions as $obj) {
                            if (false == $this->collObjGroupVersions->contains($obj)) {
                                $this->collObjGroupVersions->append($obj);
                            }
                        }

                        $this->collObjGroupVersionsPartial = true;
                    }

                    return $collObjGroupVersions;
                }

                if ($partial && $this->collObjGroupVersions) {
                    foreach ($this->collObjGroupVersions as $obj) {
                        if ($obj->isNew()) {
                            $collObjGroupVersions[] = $obj;
                        }
                    }
                }

                $this->collObjGroupVersions = $collObjGroupVersions;
                $this->collObjGroupVersionsPartial = false;
            }
        }

        return $this->collObjGroupVersions;
    }

    /**
     * Sets a collection of ChildObjGroupVersion objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $objGroupVersions A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setObjGroupVersions(Collection $objGroupVersions, ?ConnectionInterface $con = null)
    {
        /** @var ChildObjGroupVersion[] $objGroupVersionsToDelete */
        $objGroupVersionsToDelete = $this->getObjGroupVersions(new Criteria(), $con)->diff($objGroupVersions);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->objGroupVersionsScheduledForDeletion = clone $objGroupVersionsToDelete;

        foreach ($objGroupVersionsToDelete as $objGroupVersionRemoved) {
            $objGroupVersionRemoved->setObjGroup(null);
        }

        $this->collObjGroupVersions = null;
        foreach ($objGroupVersions as $objGroupVersion) {
            $this->addObjGroupVersion($objGroupVersion);
        }

        $this->collObjGroupVersions = $objGroupVersions;
        $this->collObjGroupVersionsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ObjGroupVersion objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related ObjGroupVersion objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countObjGroupVersions(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collObjGroupVersionsPartial && !$this->isNew();
        if (null === $this->collObjGroupVersions || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collObjGroupVersions) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getObjGroupVersions());
            }

            $query = ChildObjGroupVersionQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByObjGroup($this)
                ->count($con);
        }

        return count($this->collObjGroupVersions);
    }

    /**
     * Method called to associate a ChildObjGroupVersion object to this object
     * through the ChildObjGroupVersion foreign key attribute.
     *
     * @param ChildObjGroupVersion $l ChildObjGroupVersion
     * @return $this The current object (for fluent API support)
     */
    public function addObjGroupVersion(ChildObjGroupVersion $l)
    {
        if ($this->collObjGroupVersions === null) {
            $this->initObjGroupVersions();
            $this->collObjGroupVersionsPartial = true;
        }

        if (!$this->collObjGroupVersions->contains($l)) {
            $this->doAddObjGroupVersion($l);

            if ($this->objGroupVersionsScheduledForDeletion and $this->objGroupVersionsScheduledForDeletion->contains($l)) {
                $this->objGroupVersionsScheduledForDeletion->remove($this->objGroupVersionsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildObjGroupVersion $objGroupVersion The ChildObjGroupVersion object to add.
     */
    protected function doAddObjGroupVersion(ChildObjGroupVersion $objGroupVersion): void
    {
        $this->collObjGroupVersions[]= $objGroupVersion;
        $objGroupVersion->setObjGroup($this);
    }

    /**
     * @param ChildObjGroupVersion $objGroupVersion The ChildObjGroupVersion object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeObjGroupVersion(ChildObjGroupVersion $objGroupVersion)
    {
        if ($this->getObjGroupVersions()->contains($objGroupVersion)) {
            $pos = $this->collObjGroupVersions->search($objGroupVersion);
            $this->collObjGroupVersions->remove($pos);
            if (null === $this->objGroupVersionsScheduledForDeletion) {
                $this->objGroupVersionsScheduledForDeletion = clone $this->collObjGroupVersions;
                $this->objGroupVersionsScheduledForDeletion->clear();
            }
            $this->objGroupVersionsScheduledForDeletion[]= clone $objGroupVersion;
            $objGroupVersion->setObjGroup(null);
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
        if (null !== $this->aObjSubproject) {
            $this->aObjSubproject->removeObjGroup($this);
        }
        $this->id = null;
        $this->name = null;
        $this->status = null;
        $this->is_public = null;
        $this->is_available = null;
        $this->subproject_id = null;
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
            if ($this->collObjHouses) {
                foreach ($this->collObjHouses as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collObjGroupVersions) {
                foreach ($this->collObjGroupVersions as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collObjHouses = null;
        $this->collObjGroupVersions = null;
        $this->aObjSubproject = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(ObjGroupTableMap::DEFAULT_STRING_FORMAT);
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

        if (ChildObjGroupQuery::isVersioningEnabled() && ($this->isNew() || $this->isModified()) || $this->isDeleted()) {
            return true;
        }
        if (null !== ($object = $this->getObjSubproject($con)) && $object->isVersioningNecessary($con)) {
            return true;
        }

        if ($this->collObjHouses) {

            // to avoid infinite loops, emulate in save
            $this->alreadyInSave = true;

            foreach ($this->getObjHouses(null, $con) as $relatedObject) {

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
     * @return ChildObjGroupVersion A version object
     */
    public function addVersion(?ConnectionInterface $con = null)
    {
        $this->enforceVersion = false;

        $version = new ChildObjGroupVersion();
        $version->setId($this->getId());
        $version->setName($this->getName());
        $version->setStatus($this->getStatus());
        $version->setIsPublic($this->getIsPublic());
        $version->setIsAvailable($this->getIsAvailable());
        $version->setSubprojectId($this->getSubprojectId());
        $version->setVersion($this->getVersion());
        $version->setVersionCreatedAt($this->getVersionCreatedAt());
        $version->setVersionCreatedBy($this->getVersionCreatedBy());
        $version->setVersionComment($this->getVersionComment());
        $version->setObjGroup($this);
        if (($related = $this->getObjSubproject(null, $con)) && $related->getVersion()) {
            $version->setSubprojectIdVersion($related->getVersion());
        }
        $object = $this->getObjHouses(null, $con);


        if ($object && $relateds = $object->toKeyValue('Id', 'Version')) {
            $version->setObjHouseIds(array_keys($relateds));
            $version->setObjHouseVersions(array_values($relateds));
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
            throw new PropelException(sprintf('No ChildObjGroup object found with version %d', $version));
        }
        $this->populateFromVersion($version, $con);

        return $this;
    }

    /**
     * Sets the properties of the current object to the value they had at a specific version
     *
     * @param ChildObjGroupVersion $version The version object to use
     * @param ConnectionInterface $con the connection to use
     * @param array $loadedObjects objects that been loaded in a chain of populateFromVersion calls on referrer or fk objects.
     *
     * @return $this The current object (for fluent API support)
     */
    public function populateFromVersion($version, $con = null, &$loadedObjects = [])
    {
        $loadedObjects['ChildObjGroup'][$version->getId()][$version->getVersion()] = $this;
        $this->setId($version->getId());
        $this->setName($version->getName());
        $this->setStatus($version->getStatus());
        $this->setIsPublic($version->getIsPublic());
        $this->setIsAvailable($version->getIsAvailable());
        $this->setSubprojectId($version->getSubprojectId());
        $this->setVersion($version->getVersion());
        $this->setVersionCreatedAt($version->getVersionCreatedAt());
        $this->setVersionCreatedBy($version->getVersionCreatedBy());
        $this->setVersionComment($version->getVersionComment());
        if ($fkValue = $version->getSubprojectId()) {
            if (isset($loadedObjects['ChildObjSubproject']) && isset($loadedObjects['ChildObjSubproject'][$fkValue]) && isset($loadedObjects['ChildObjSubproject'][$fkValue][$version->getSubprojectIdVersion()])) {
                $related = $loadedObjects['ChildObjSubproject'][$fkValue][$version->getSubprojectIdVersion()];
            } else {
                $related = new ChildObjSubproject();
                $relatedVersion = ChildObjSubprojectVersionQuery::create()
                    ->filterById($fkValue)
                    ->filterByVersionComment($version->getSubprojectIdVersion())
                    ->findOne($con);
                $related->populateFromVersion($relatedVersion, $con, $loadedObjects);
                $related->setNew(false);
            }
            $this->setObjSubproject($related);
        }
        if ($fkValues = $version->getObjHouseIds()) {
            $this->clearObjHouses();
            $fkVersions = $version->getObjHouseVersions();
            $query = ChildObjHouseVersionQuery::create();
            foreach ($fkValues as $key => $value) {
                $c1 = $query->getNewCriterion(ObjHouseVersionTableMap::COL_ID, $value);
                $c2 = $query->getNewCriterion(ObjHouseVersionTableMap::COL_VERSION, $fkVersions[$key]);
                $c1->addAnd($c2);
                $query->addOr($c1);
            }
            foreach ($query->find($con) as $relatedVersion) {
                if (isset($loadedObjects['ChildObjHouse']) && isset($loadedObjects['ChildObjHouse'][$relatedVersion->getId()]) && isset($loadedObjects['ChildObjHouse'][$relatedVersion->getId()][$relatedVersion->getVersion()])) {
                    $related = $loadedObjects['ChildObjHouse'][$relatedVersion->getId()][$relatedVersion->getVersion()];
                } else {
                    $related = new ChildObjHouse();
                    $related->populateFromVersion($relatedVersion, $con, $loadedObjects);
                    $related->setNew(false);
                }
                $this->addObjHouse($related);
                $this->collObjHousesPartial = false;
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
        $v = ChildObjGroupVersionQuery::create()
            ->filterByObjGroup($this)
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
     * @return ChildObjGroupVersion A version object
     */
    public function getOneVersion(int $versionNumber, ?ConnectionInterface $con = null)
    {
        return ChildObjGroupVersionQuery::create()
            ->filterByObjGroup($this)
            ->filterByVersion($versionNumber)
            ->findOne($con);
    }

    /**
     * Gets all the versions of this object, in incremental order
     *
     * @param ConnectionInterface $con The ConnectionInterface connection to use.
     *
     * @return ObjectCollection|ChildObjGroupVersion[] A list of ChildObjGroupVersion objects
     */
    public function getAllVersions(?ConnectionInterface $con = null)
    {
        $criteria = new Criteria();
        $criteria->addAscendingOrderByColumn(ObjGroupVersionTableMap::COL_VERSION);

        return $this->getObjGroupVersions($criteria, $con);
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
     * @return PropelCollection|\DB\ObjGroupVersion[] List of \DB\ObjGroupVersion objects
     */
    public function getLastVersions($number = 10, $criteria = null, ?ConnectionInterface $con = null)
    {
        $criteria = ChildObjGroupVersionQuery::create(null, $criteria);
        $criteria->addDescendingOrderByColumn(ObjGroupVersionTableMap::COL_VERSION);
        $criteria->limit($number);

        return $this->getObjGroupVersions($criteria, $con);
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
