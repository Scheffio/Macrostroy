<?php

namespace DB\Base;

use \DateTime;
use \Exception;
use \PDO;
use DB\Material as ChildMaterial;
use DB\MaterialQuery as ChildMaterialQuery;
use DB\Technic as ChildTechnic;
use DB\TechnicQuery as ChildTechnicQuery;
use DB\Unit as ChildUnit;
use DB\UnitQuery as ChildUnitQuery;
use DB\UnitVersion as ChildUnitVersion;
use DB\UnitVersionQuery as ChildUnitVersionQuery;
use DB\Work as ChildWork;
use DB\WorkQuery as ChildWorkQuery;
use DB\Map\MaterialTableMap;
use DB\Map\TechnicTableMap;
use DB\Map\UnitTableMap;
use DB\Map\UnitVersionTableMap;
use DB\Map\WorkTableMap;
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
 * Base class that represents a row from the 'unit' table.
 *
 *
 *
 * @package    propel.generator.DB.Base
 */
abstract class Unit implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\DB\\Map\\UnitTableMap';


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
     * ID ед.измерения
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
     * The value for the is_available field.
     * Доступ (доступный, удаленный)
     * Note: this column has a database default value of: true
     * @var        boolean
     */
    protected $is_available;

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
     * @var        ObjectCollection|ChildMaterial[] Collection to store aggregation of ChildMaterial objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildMaterial> Collection to store aggregation of ChildMaterial objects.
     */
    protected $collMaterials;
    protected $collMaterialsPartial;

    /**
     * @var        ObjectCollection|ChildTechnic[] Collection to store aggregation of ChildTechnic objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildTechnic> Collection to store aggregation of ChildTechnic objects.
     */
    protected $collTechnics;
    protected $collTechnicsPartial;

    /**
     * @var        ObjectCollection|ChildWork[] Collection to store aggregation of ChildWork objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildWork> Collection to store aggregation of ChildWork objects.
     */
    protected $collWorks;
    protected $collWorksPartial;

    /**
     * @var        ObjectCollection|ChildUnitVersion[] Collection to store aggregation of ChildUnitVersion objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildUnitVersion> Collection to store aggregation of ChildUnitVersion objects.
     */
    protected $collUnitVersions;
    protected $collUnitVersionsPartial;

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
     * @var ObjectCollection|ChildMaterial[]
     * @phpstan-var ObjectCollection&\Traversable<ChildMaterial>
     */
    protected $materialsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildTechnic[]
     * @phpstan-var ObjectCollection&\Traversable<ChildTechnic>
     */
    protected $technicsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildWork[]
     * @phpstan-var ObjectCollection&\Traversable<ChildWork>
     */
    protected $worksScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildUnitVersion[]
     * @phpstan-var ObjectCollection&\Traversable<ChildUnitVersion>
     */
    protected $unitVersionsScheduledForDeletion = null;

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
     * Initializes internal state of DB\Base\Unit object.
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
     * Compares this with another <code>Unit</code> instance.  If
     * <code>obj</code> is an instance of <code>Unit</code>, delegates to
     * <code>equals(Unit)</code>.  Otherwise, returns <code>false</code>.
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
     * ID ед.измерения
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
     * Set the value of [id] column.
     * ID ед.измерения
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
            $this->modifiedColumns[UnitTableMap::COL_ID] = true;
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
            $this->modifiedColumns[UnitTableMap::COL_NAME] = true;
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
            $this->modifiedColumns[UnitTableMap::COL_IS_AVAILABLE] = true;
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
            $this->modifiedColumns[UnitTableMap::COL_VERSION] = true;
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
                $this->modifiedColumns[UnitTableMap::COL_VERSION_CREATED_AT] = true;
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
            $this->modifiedColumns[UnitTableMap::COL_VERSION_CREATED_BY] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : UnitTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : UnitTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : UnitTableMap::translateFieldName('IsAvailable', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_available = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : UnitTableMap::translateFieldName('Version', TableMap::TYPE_PHPNAME, $indexType)];
            $this->version = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : UnitTableMap::translateFieldName('VersionCreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->version_created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : UnitTableMap::translateFieldName('VersionCreatedBy', TableMap::TYPE_PHPNAME, $indexType)];
            $this->version_created_by = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 6; // 6 = UnitTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\DB\\Unit'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(UnitTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildUnitQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collMaterials = null;

            $this->collTechnics = null;

            $this->collWorks = null;

            $this->collUnitVersions = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see Unit::setDeleted()
     * @see Unit::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(UnitTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildUnitQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(UnitTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            // versionable behavior
            if ($this->isVersioningNecessary()) {
                $this->setVersion($this->isNew() ? 1 : $this->getLastVersionNumber($con) + 1);
                if (!$this->isColumnModified(UnitTableMap::COL_VERSION_CREATED_AT)) {
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
                UnitTableMap::addInstanceToPool($this);
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

            if ($this->materialsScheduledForDeletion !== null) {
                if (!$this->materialsScheduledForDeletion->isEmpty()) {
                    \DB\MaterialQuery::create()
                        ->filterByPrimaryKeys($this->materialsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->materialsScheduledForDeletion = null;
                }
            }

            if ($this->collMaterials !== null) {
                foreach ($this->collMaterials as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->technicsScheduledForDeletion !== null) {
                if (!$this->technicsScheduledForDeletion->isEmpty()) {
                    \DB\TechnicQuery::create()
                        ->filterByPrimaryKeys($this->technicsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->technicsScheduledForDeletion = null;
                }
            }

            if ($this->collTechnics !== null) {
                foreach ($this->collTechnics as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->worksScheduledForDeletion !== null) {
                if (!$this->worksScheduledForDeletion->isEmpty()) {
                    \DB\WorkQuery::create()
                        ->filterByPrimaryKeys($this->worksScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->worksScheduledForDeletion = null;
                }
            }

            if ($this->collWorks !== null) {
                foreach ($this->collWorks as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->unitVersionsScheduledForDeletion !== null) {
                if (!$this->unitVersionsScheduledForDeletion->isEmpty()) {
                    \DB\UnitVersionQuery::create()
                        ->filterByPrimaryKeys($this->unitVersionsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->unitVersionsScheduledForDeletion = null;
                }
            }

            if ($this->collUnitVersions !== null) {
                foreach ($this->collUnitVersions as $referrerFK) {
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

        $this->modifiedColumns[UnitTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . UnitTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(UnitTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(UnitTableMap::COL_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'name';
        }
        if ($this->isColumnModified(UnitTableMap::COL_IS_AVAILABLE)) {
            $modifiedColumns[':p' . $index++]  = 'is_available';
        }
        if ($this->isColumnModified(UnitTableMap::COL_VERSION)) {
            $modifiedColumns[':p' . $index++]  = 'version';
        }
        if ($this->isColumnModified(UnitTableMap::COL_VERSION_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'version_created_at';
        }
        if ($this->isColumnModified(UnitTableMap::COL_VERSION_CREATED_BY)) {
            $modifiedColumns[':p' . $index++]  = 'version_created_by';
        }

        $sql = sprintf(
            'INSERT INTO unit (%s) VALUES (%s)',
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
                    case 'is_available':
                        $stmt->bindValue($identifier, (int) $this->is_available, PDO::PARAM_INT);
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
        $pos = UnitTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIsAvailable();

            case 3:
                return $this->getVersion();

            case 4:
                return $this->getVersionCreatedAt();

            case 5:
                return $this->getVersionCreatedBy();

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
        if (isset($alreadyDumpedObjects['Unit'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['Unit'][$this->hashCode()] = true;
        $keys = UnitTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getId(),
            $keys[1] => $this->getName(),
            $keys[2] => $this->getIsAvailable(),
            $keys[3] => $this->getVersion(),
            $keys[4] => $this->getVersionCreatedAt(),
            $keys[5] => $this->getVersionCreatedBy(),
        ];
        if ($result[$keys[4]] instanceof \DateTimeInterface) {
            $result[$keys[4]] = $result[$keys[4]]->format('Y-m-d H:i:s.u');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collMaterials) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'materials';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'materials';
                        break;
                    default:
                        $key = 'Materials';
                }

                $result[$key] = $this->collMaterials->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTechnics) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'technics';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'technics';
                        break;
                    default:
                        $key = 'Technics';
                }

                $result[$key] = $this->collTechnics->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collWorks) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'works';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'works';
                        break;
                    default:
                        $key = 'Works';
                }

                $result[$key] = $this->collWorks->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collUnitVersions) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'unitVersions';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'unit_versions';
                        break;
                    default:
                        $key = 'UnitVersions';
                }

                $result[$key] = $this->collUnitVersions->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = UnitTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setIsAvailable($value);
                break;
            case 3:
                $this->setVersion($value);
                break;
            case 4:
                $this->setVersionCreatedAt($value);
                break;
            case 5:
                $this->setVersionCreatedBy($value);
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
        $keys = UnitTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setName($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setIsAvailable($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setVersion($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setVersionCreatedAt($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setVersionCreatedBy($arr[$keys[5]]);
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
        $criteria = new Criteria(UnitTableMap::DATABASE_NAME);

        if ($this->isColumnModified(UnitTableMap::COL_ID)) {
            $criteria->add(UnitTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(UnitTableMap::COL_NAME)) {
            $criteria->add(UnitTableMap::COL_NAME, $this->name);
        }
        if ($this->isColumnModified(UnitTableMap::COL_IS_AVAILABLE)) {
            $criteria->add(UnitTableMap::COL_IS_AVAILABLE, $this->is_available);
        }
        if ($this->isColumnModified(UnitTableMap::COL_VERSION)) {
            $criteria->add(UnitTableMap::COL_VERSION, $this->version);
        }
        if ($this->isColumnModified(UnitTableMap::COL_VERSION_CREATED_AT)) {
            $criteria->add(UnitTableMap::COL_VERSION_CREATED_AT, $this->version_created_at);
        }
        if ($this->isColumnModified(UnitTableMap::COL_VERSION_CREATED_BY)) {
            $criteria->add(UnitTableMap::COL_VERSION_CREATED_BY, $this->version_created_by);
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
        $criteria = ChildUnitQuery::create();
        $criteria->add(UnitTableMap::COL_ID, $this->id);

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
     * @param object $copyObj An object of \DB\Unit (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setName($this->getName());
        $copyObj->setIsAvailable($this->getIsAvailable());
        $copyObj->setVersion($this->getVersion());
        $copyObj->setVersionCreatedAt($this->getVersionCreatedAt());
        $copyObj->setVersionCreatedBy($this->getVersionCreatedBy());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getMaterials() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addMaterial($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTechnics() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTechnic($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getWorks() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addWork($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getUnitVersions() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addUnitVersion($relObj->copy($deepCopy));
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
     * @return \DB\Unit Clone of current object.
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
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName): void
    {
        if ('Material' === $relationName) {
            $this->initMaterials();
            return;
        }
        if ('Technic' === $relationName) {
            $this->initTechnics();
            return;
        }
        if ('Work' === $relationName) {
            $this->initWorks();
            return;
        }
        if ('UnitVersion' === $relationName) {
            $this->initUnitVersions();
            return;
        }
    }

    /**
     * Clears out the collMaterials collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addMaterials()
     */
    public function clearMaterials()
    {
        $this->collMaterials = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collMaterials collection loaded partially.
     *
     * @return void
     */
    public function resetPartialMaterials($v = true): void
    {
        $this->collMaterialsPartial = $v;
    }

    /**
     * Initializes the collMaterials collection.
     *
     * By default this just sets the collMaterials collection to an empty array (like clearcollMaterials());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initMaterials(bool $overrideExisting = true): void
    {
        if (null !== $this->collMaterials && !$overrideExisting) {
            return;
        }

        $collectionClassName = MaterialTableMap::getTableMap()->getCollectionClassName();

        $this->collMaterials = new $collectionClassName;
        $this->collMaterials->setModel('\DB\Material');
    }

    /**
     * Gets an array of ChildMaterial objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUnit is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildMaterial[] List of ChildMaterial objects
     * @phpstan-return ObjectCollection&\Traversable<ChildMaterial> List of ChildMaterial objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getMaterials(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collMaterialsPartial && !$this->isNew();
        if (null === $this->collMaterials || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collMaterials) {
                    $this->initMaterials();
                } else {
                    $collectionClassName = MaterialTableMap::getTableMap()->getCollectionClassName();

                    $collMaterials = new $collectionClassName;
                    $collMaterials->setModel('\DB\Material');

                    return $collMaterials;
                }
            } else {
                $collMaterials = ChildMaterialQuery::create(null, $criteria)
                    ->filterByUnit($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collMaterialsPartial && count($collMaterials)) {
                        $this->initMaterials(false);

                        foreach ($collMaterials as $obj) {
                            if (false == $this->collMaterials->contains($obj)) {
                                $this->collMaterials->append($obj);
                            }
                        }

                        $this->collMaterialsPartial = true;
                    }

                    return $collMaterials;
                }

                if ($partial && $this->collMaterials) {
                    foreach ($this->collMaterials as $obj) {
                        if ($obj->isNew()) {
                            $collMaterials[] = $obj;
                        }
                    }
                }

                $this->collMaterials = $collMaterials;
                $this->collMaterialsPartial = false;
            }
        }

        return $this->collMaterials;
    }

    /**
     * Sets a collection of ChildMaterial objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $materials A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setMaterials(Collection $materials, ?ConnectionInterface $con = null)
    {
        /** @var ChildMaterial[] $materialsToDelete */
        $materialsToDelete = $this->getMaterials(new Criteria(), $con)->diff($materials);


        $this->materialsScheduledForDeletion = $materialsToDelete;

        foreach ($materialsToDelete as $materialRemoved) {
            $materialRemoved->setUnit(null);
        }

        $this->collMaterials = null;
        foreach ($materials as $material) {
            $this->addMaterial($material);
        }

        $this->collMaterials = $materials;
        $this->collMaterialsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Material objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Material objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countMaterials(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collMaterialsPartial && !$this->isNew();
        if (null === $this->collMaterials || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collMaterials) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getMaterials());
            }

            $query = ChildMaterialQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUnit($this)
                ->count($con);
        }

        return count($this->collMaterials);
    }

    /**
     * Method called to associate a ChildMaterial object to this object
     * through the ChildMaterial foreign key attribute.
     *
     * @param ChildMaterial $l ChildMaterial
     * @return $this The current object (for fluent API support)
     */
    public function addMaterial(ChildMaterial $l)
    {
        if ($this->collMaterials === null) {
            $this->initMaterials();
            $this->collMaterialsPartial = true;
        }

        if (!$this->collMaterials->contains($l)) {
            $this->doAddMaterial($l);

            if ($this->materialsScheduledForDeletion and $this->materialsScheduledForDeletion->contains($l)) {
                $this->materialsScheduledForDeletion->remove($this->materialsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildMaterial $material The ChildMaterial object to add.
     */
    protected function doAddMaterial(ChildMaterial $material): void
    {
        $this->collMaterials[]= $material;
        $material->setUnit($this);
    }

    /**
     * @param ChildMaterial $material The ChildMaterial object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeMaterial(ChildMaterial $material)
    {
        if ($this->getMaterials()->contains($material)) {
            $pos = $this->collMaterials->search($material);
            $this->collMaterials->remove($pos);
            if (null === $this->materialsScheduledForDeletion) {
                $this->materialsScheduledForDeletion = clone $this->collMaterials;
                $this->materialsScheduledForDeletion->clear();
            }
            $this->materialsScheduledForDeletion[]= clone $material;
            $material->setUnit(null);
        }

        return $this;
    }

    /**
     * Clears out the collTechnics collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addTechnics()
     */
    public function clearTechnics()
    {
        $this->collTechnics = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collTechnics collection loaded partially.
     *
     * @return void
     */
    public function resetPartialTechnics($v = true): void
    {
        $this->collTechnicsPartial = $v;
    }

    /**
     * Initializes the collTechnics collection.
     *
     * By default this just sets the collTechnics collection to an empty array (like clearcollTechnics());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTechnics(bool $overrideExisting = true): void
    {
        if (null !== $this->collTechnics && !$overrideExisting) {
            return;
        }

        $collectionClassName = TechnicTableMap::getTableMap()->getCollectionClassName();

        $this->collTechnics = new $collectionClassName;
        $this->collTechnics->setModel('\DB\Technic');
    }

    /**
     * Gets an array of ChildTechnic objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUnit is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildTechnic[] List of ChildTechnic objects
     * @phpstan-return ObjectCollection&\Traversable<ChildTechnic> List of ChildTechnic objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getTechnics(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collTechnicsPartial && !$this->isNew();
        if (null === $this->collTechnics || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collTechnics) {
                    $this->initTechnics();
                } else {
                    $collectionClassName = TechnicTableMap::getTableMap()->getCollectionClassName();

                    $collTechnics = new $collectionClassName;
                    $collTechnics->setModel('\DB\Technic');

                    return $collTechnics;
                }
            } else {
                $collTechnics = ChildTechnicQuery::create(null, $criteria)
                    ->filterByUnit($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collTechnicsPartial && count($collTechnics)) {
                        $this->initTechnics(false);

                        foreach ($collTechnics as $obj) {
                            if (false == $this->collTechnics->contains($obj)) {
                                $this->collTechnics->append($obj);
                            }
                        }

                        $this->collTechnicsPartial = true;
                    }

                    return $collTechnics;
                }

                if ($partial && $this->collTechnics) {
                    foreach ($this->collTechnics as $obj) {
                        if ($obj->isNew()) {
                            $collTechnics[] = $obj;
                        }
                    }
                }

                $this->collTechnics = $collTechnics;
                $this->collTechnicsPartial = false;
            }
        }

        return $this->collTechnics;
    }

    /**
     * Sets a collection of ChildTechnic objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $technics A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setTechnics(Collection $technics, ?ConnectionInterface $con = null)
    {
        /** @var ChildTechnic[] $technicsToDelete */
        $technicsToDelete = $this->getTechnics(new Criteria(), $con)->diff($technics);


        $this->technicsScheduledForDeletion = $technicsToDelete;

        foreach ($technicsToDelete as $technicRemoved) {
            $technicRemoved->setUnit(null);
        }

        $this->collTechnics = null;
        foreach ($technics as $technic) {
            $this->addTechnic($technic);
        }

        $this->collTechnics = $technics;
        $this->collTechnicsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Technic objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Technic objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countTechnics(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collTechnicsPartial && !$this->isNew();
        if (null === $this->collTechnics || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTechnics) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getTechnics());
            }

            $query = ChildTechnicQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUnit($this)
                ->count($con);
        }

        return count($this->collTechnics);
    }

    /**
     * Method called to associate a ChildTechnic object to this object
     * through the ChildTechnic foreign key attribute.
     *
     * @param ChildTechnic $l ChildTechnic
     * @return $this The current object (for fluent API support)
     */
    public function addTechnic(ChildTechnic $l)
    {
        if ($this->collTechnics === null) {
            $this->initTechnics();
            $this->collTechnicsPartial = true;
        }

        if (!$this->collTechnics->contains($l)) {
            $this->doAddTechnic($l);

            if ($this->technicsScheduledForDeletion and $this->technicsScheduledForDeletion->contains($l)) {
                $this->technicsScheduledForDeletion->remove($this->technicsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildTechnic $technic The ChildTechnic object to add.
     */
    protected function doAddTechnic(ChildTechnic $technic): void
    {
        $this->collTechnics[]= $technic;
        $technic->setUnit($this);
    }

    /**
     * @param ChildTechnic $technic The ChildTechnic object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeTechnic(ChildTechnic $technic)
    {
        if ($this->getTechnics()->contains($technic)) {
            $pos = $this->collTechnics->search($technic);
            $this->collTechnics->remove($pos);
            if (null === $this->technicsScheduledForDeletion) {
                $this->technicsScheduledForDeletion = clone $this->collTechnics;
                $this->technicsScheduledForDeletion->clear();
            }
            $this->technicsScheduledForDeletion[]= clone $technic;
            $technic->setUnit(null);
        }

        return $this;
    }

    /**
     * Clears out the collWorks collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addWorks()
     */
    public function clearWorks()
    {
        $this->collWorks = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collWorks collection loaded partially.
     *
     * @return void
     */
    public function resetPartialWorks($v = true): void
    {
        $this->collWorksPartial = $v;
    }

    /**
     * Initializes the collWorks collection.
     *
     * By default this just sets the collWorks collection to an empty array (like clearcollWorks());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initWorks(bool $overrideExisting = true): void
    {
        if (null !== $this->collWorks && !$overrideExisting) {
            return;
        }

        $collectionClassName = WorkTableMap::getTableMap()->getCollectionClassName();

        $this->collWorks = new $collectionClassName;
        $this->collWorks->setModel('\DB\Work');
    }

    /**
     * Gets an array of ChildWork objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUnit is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildWork[] List of ChildWork objects
     * @phpstan-return ObjectCollection&\Traversable<ChildWork> List of ChildWork objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getWorks(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collWorksPartial && !$this->isNew();
        if (null === $this->collWorks || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collWorks) {
                    $this->initWorks();
                } else {
                    $collectionClassName = WorkTableMap::getTableMap()->getCollectionClassName();

                    $collWorks = new $collectionClassName;
                    $collWorks->setModel('\DB\Work');

                    return $collWorks;
                }
            } else {
                $collWorks = ChildWorkQuery::create(null, $criteria)
                    ->filterByUnit($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collWorksPartial && count($collWorks)) {
                        $this->initWorks(false);

                        foreach ($collWorks as $obj) {
                            if (false == $this->collWorks->contains($obj)) {
                                $this->collWorks->append($obj);
                            }
                        }

                        $this->collWorksPartial = true;
                    }

                    return $collWorks;
                }

                if ($partial && $this->collWorks) {
                    foreach ($this->collWorks as $obj) {
                        if ($obj->isNew()) {
                            $collWorks[] = $obj;
                        }
                    }
                }

                $this->collWorks = $collWorks;
                $this->collWorksPartial = false;
            }
        }

        return $this->collWorks;
    }

    /**
     * Sets a collection of ChildWork objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $works A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setWorks(Collection $works, ?ConnectionInterface $con = null)
    {
        /** @var ChildWork[] $worksToDelete */
        $worksToDelete = $this->getWorks(new Criteria(), $con)->diff($works);


        $this->worksScheduledForDeletion = $worksToDelete;

        foreach ($worksToDelete as $workRemoved) {
            $workRemoved->setUnit(null);
        }

        $this->collWorks = null;
        foreach ($works as $work) {
            $this->addWork($work);
        }

        $this->collWorks = $works;
        $this->collWorksPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Work objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Work objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countWorks(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collWorksPartial && !$this->isNew();
        if (null === $this->collWorks || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collWorks) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getWorks());
            }

            $query = ChildWorkQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUnit($this)
                ->count($con);
        }

        return count($this->collWorks);
    }

    /**
     * Method called to associate a ChildWork object to this object
     * through the ChildWork foreign key attribute.
     *
     * @param ChildWork $l ChildWork
     * @return $this The current object (for fluent API support)
     */
    public function addWork(ChildWork $l)
    {
        if ($this->collWorks === null) {
            $this->initWorks();
            $this->collWorksPartial = true;
        }

        if (!$this->collWorks->contains($l)) {
            $this->doAddWork($l);

            if ($this->worksScheduledForDeletion and $this->worksScheduledForDeletion->contains($l)) {
                $this->worksScheduledForDeletion->remove($this->worksScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildWork $work The ChildWork object to add.
     */
    protected function doAddWork(ChildWork $work): void
    {
        $this->collWorks[]= $work;
        $work->setUnit($this);
    }

    /**
     * @param ChildWork $work The ChildWork object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeWork(ChildWork $work)
    {
        if ($this->getWorks()->contains($work)) {
            $pos = $this->collWorks->search($work);
            $this->collWorks->remove($pos);
            if (null === $this->worksScheduledForDeletion) {
                $this->worksScheduledForDeletion = clone $this->collWorks;
                $this->worksScheduledForDeletion->clear();
            }
            $this->worksScheduledForDeletion[]= clone $work;
            $work->setUnit(null);
        }

        return $this;
    }

    /**
     * Clears out the collUnitVersions collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addUnitVersions()
     */
    public function clearUnitVersions()
    {
        $this->collUnitVersions = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collUnitVersions collection loaded partially.
     *
     * @return void
     */
    public function resetPartialUnitVersions($v = true): void
    {
        $this->collUnitVersionsPartial = $v;
    }

    /**
     * Initializes the collUnitVersions collection.
     *
     * By default this just sets the collUnitVersions collection to an empty array (like clearcollUnitVersions());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initUnitVersions(bool $overrideExisting = true): void
    {
        if (null !== $this->collUnitVersions && !$overrideExisting) {
            return;
        }

        $collectionClassName = UnitVersionTableMap::getTableMap()->getCollectionClassName();

        $this->collUnitVersions = new $collectionClassName;
        $this->collUnitVersions->setModel('\DB\UnitVersion');
    }

    /**
     * Gets an array of ChildUnitVersion objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUnit is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildUnitVersion[] List of ChildUnitVersion objects
     * @phpstan-return ObjectCollection&\Traversable<ChildUnitVersion> List of ChildUnitVersion objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getUnitVersions(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collUnitVersionsPartial && !$this->isNew();
        if (null === $this->collUnitVersions || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collUnitVersions) {
                    $this->initUnitVersions();
                } else {
                    $collectionClassName = UnitVersionTableMap::getTableMap()->getCollectionClassName();

                    $collUnitVersions = new $collectionClassName;
                    $collUnitVersions->setModel('\DB\UnitVersion');

                    return $collUnitVersions;
                }
            } else {
                $collUnitVersions = ChildUnitVersionQuery::create(null, $criteria)
                    ->filterByUnit($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collUnitVersionsPartial && count($collUnitVersions)) {
                        $this->initUnitVersions(false);

                        foreach ($collUnitVersions as $obj) {
                            if (false == $this->collUnitVersions->contains($obj)) {
                                $this->collUnitVersions->append($obj);
                            }
                        }

                        $this->collUnitVersionsPartial = true;
                    }

                    return $collUnitVersions;
                }

                if ($partial && $this->collUnitVersions) {
                    foreach ($this->collUnitVersions as $obj) {
                        if ($obj->isNew()) {
                            $collUnitVersions[] = $obj;
                        }
                    }
                }

                $this->collUnitVersions = $collUnitVersions;
                $this->collUnitVersionsPartial = false;
            }
        }

        return $this->collUnitVersions;
    }

    /**
     * Sets a collection of ChildUnitVersion objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $unitVersions A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setUnitVersions(Collection $unitVersions, ?ConnectionInterface $con = null)
    {
        /** @var ChildUnitVersion[] $unitVersionsToDelete */
        $unitVersionsToDelete = $this->getUnitVersions(new Criteria(), $con)->diff($unitVersions);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->unitVersionsScheduledForDeletion = clone $unitVersionsToDelete;

        foreach ($unitVersionsToDelete as $unitVersionRemoved) {
            $unitVersionRemoved->setUnit(null);
        }

        $this->collUnitVersions = null;
        foreach ($unitVersions as $unitVersion) {
            $this->addUnitVersion($unitVersion);
        }

        $this->collUnitVersions = $unitVersions;
        $this->collUnitVersionsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related UnitVersion objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related UnitVersion objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countUnitVersions(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collUnitVersionsPartial && !$this->isNew();
        if (null === $this->collUnitVersions || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collUnitVersions) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getUnitVersions());
            }

            $query = ChildUnitVersionQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUnit($this)
                ->count($con);
        }

        return count($this->collUnitVersions);
    }

    /**
     * Method called to associate a ChildUnitVersion object to this object
     * through the ChildUnitVersion foreign key attribute.
     *
     * @param ChildUnitVersion $l ChildUnitVersion
     * @return $this The current object (for fluent API support)
     */
    public function addUnitVersion(ChildUnitVersion $l)
    {
        if ($this->collUnitVersions === null) {
            $this->initUnitVersions();
            $this->collUnitVersionsPartial = true;
        }

        if (!$this->collUnitVersions->contains($l)) {
            $this->doAddUnitVersion($l);

            if ($this->unitVersionsScheduledForDeletion and $this->unitVersionsScheduledForDeletion->contains($l)) {
                $this->unitVersionsScheduledForDeletion->remove($this->unitVersionsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildUnitVersion $unitVersion The ChildUnitVersion object to add.
     */
    protected function doAddUnitVersion(ChildUnitVersion $unitVersion): void
    {
        $this->collUnitVersions[]= $unitVersion;
        $unitVersion->setUnit($this);
    }

    /**
     * @param ChildUnitVersion $unitVersion The ChildUnitVersion object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeUnitVersion(ChildUnitVersion $unitVersion)
    {
        if ($this->getUnitVersions()->contains($unitVersion)) {
            $pos = $this->collUnitVersions->search($unitVersion);
            $this->collUnitVersions->remove($pos);
            if (null === $this->unitVersionsScheduledForDeletion) {
                $this->unitVersionsScheduledForDeletion = clone $this->collUnitVersions;
                $this->unitVersionsScheduledForDeletion->clear();
            }
            $this->unitVersionsScheduledForDeletion[]= clone $unitVersion;
            $unitVersion->setUnit(null);
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
        $this->id = null;
        $this->name = null;
        $this->is_available = null;
        $this->version = null;
        $this->version_created_at = null;
        $this->version_created_by = null;
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
            if ($this->collMaterials) {
                foreach ($this->collMaterials as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTechnics) {
                foreach ($this->collTechnics as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collWorks) {
                foreach ($this->collWorks as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collUnitVersions) {
                foreach ($this->collUnitVersions as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collMaterials = null;
        $this->collTechnics = null;
        $this->collWorks = null;
        $this->collUnitVersions = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(UnitTableMap::DEFAULT_STRING_FORMAT);
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

        if (ChildUnitQuery::isVersioningEnabled() && ($this->isNew() || $this->isModified()) || $this->isDeleted()) {
            return true;
        }

        return false;
    }

    /**
     * Creates a version of the current object and saves it.
     *
     * @param ConnectionInterface $con The ConnectionInterface connection to use.
     *
     * @return ChildUnitVersion A version object
     */
    public function addVersion(?ConnectionInterface $con = null)
    {
        $this->enforceVersion = false;

        $version = new ChildUnitVersion();
        $version->setId($this->getId());
        $version->setName($this->getName());
        $version->setIsAvailable($this->getIsAvailable());
        $version->setVersion($this->getVersion());
        $version->setVersionCreatedAt($this->getVersionCreatedAt());
        $version->setVersionCreatedBy($this->getVersionCreatedBy());
        $version->setUnit($this);
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
            throw new PropelException(sprintf('No ChildUnit object found with version %d', $version));
        }
        $this->populateFromVersion($version, $con);

        return $this;
    }

    /**
     * Sets the properties of the current object to the value they had at a specific version
     *
     * @param ChildUnitVersion $version The version object to use
     * @param ConnectionInterface $con the connection to use
     * @param array $loadedObjects objects that been loaded in a chain of populateFromVersion calls on referrer or fk objects.
     *
     * @return $this The current object (for fluent API support)
     */
    public function populateFromVersion($version, $con = null, &$loadedObjects = [])
    {
        $loadedObjects['ChildUnit'][$version->getId()][$version->getVersion()] = $this;
        $this->setId($version->getId());
        $this->setName($version->getName());
        $this->setIsAvailable($version->getIsAvailable());
        $this->setVersion($version->getVersion());
        $this->setVersionCreatedAt($version->getVersionCreatedAt());
        $this->setVersionCreatedBy($version->getVersionCreatedBy());

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
        $v = ChildUnitVersionQuery::create()
            ->filterByUnit($this)
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
     * @return ChildUnitVersion A version object
     */
    public function getOneVersion(int $versionNumber, ?ConnectionInterface $con = null)
    {
        return ChildUnitVersionQuery::create()
            ->filterByUnit($this)
            ->filterByVersion($versionNumber)
            ->findOne($con);
    }

    /**
     * Gets all the versions of this object, in incremental order
     *
     * @param ConnectionInterface $con The ConnectionInterface connection to use.
     *
     * @return ObjectCollection|ChildUnitVersion[] A list of ChildUnitVersion objects
     */
    public function getAllVersions(?ConnectionInterface $con = null)
    {
        $criteria = new Criteria();
        $criteria->addAscendingOrderByColumn(UnitVersionTableMap::COL_VERSION);

        return $this->getUnitVersions($criteria, $con);
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
     * @return PropelCollection|\DB\UnitVersion[] List of \DB\UnitVersion objects
     */
    public function getLastVersions($number = 10, $criteria = null, ?ConnectionInterface $con = null)
    {
        $criteria = ChildUnitVersionQuery::create(null, $criteria);
        $criteria->addDescendingOrderByColumn(UnitVersionTableMap::COL_VERSION);
        $criteria->limit($number);

        return $this->getUnitVersions($criteria, $con);
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
