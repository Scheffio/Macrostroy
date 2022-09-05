<?php

namespace DB\Base;

use \DateTime;
use \Exception;
use inc\artemy\v1\auth\Auth;
use \PDO;
use DB\Material as ChildMaterial;
use DB\MaterialQuery as ChildMaterialQuery;
use DB\MaterialVersion as ChildMaterialVersion;
use DB\MaterialVersionQuery as ChildMaterialVersionQuery;
use DB\StageMaterial as ChildStageMaterial;
use DB\StageMaterialQuery as ChildStageMaterialQuery;
use DB\StageMaterialVersionQuery as ChildStageMaterialVersionQuery;
use DB\Unit as ChildUnit;
use DB\UnitQuery as ChildUnitQuery;
use DB\WorkMaterial as ChildWorkMaterial;
use DB\WorkMaterialQuery as ChildWorkMaterialQuery;
use DB\WorkMaterialVersionQuery as ChildWorkMaterialVersionQuery;
use DB\Map\MaterialTableMap;
use DB\Map\MaterialVersionTableMap;
use DB\Map\StageMaterialTableMap;
use DB\Map\StageMaterialVersionTableMap;
use DB\Map\WorkMaterialTableMap;
use DB\Map\WorkMaterialVersionTableMap;
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
 * Base class that represents a row from the 'material' table.
 *
 *
 *
 * @package    propel.generator.DB.Base
 */
abstract class Material implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\DB\\Map\\MaterialTableMap';


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
     * ID материала
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
     * The value for the price field.
     * Стоимость
     * @var        string
     */
    protected $price;

    /**
     * The value for the is_available field.
     * Доступ (доступный, удаленный)
     * Note: this column has a database default value of: true
     * @var        boolean
     */
    protected $is_available;

    /**
     * The value for the unit_id field.
     * ID ед. измерения
     * @var        int
     */
    protected $unit_id;

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
     * @var        ChildUnit
     */
    protected $aUnit;

    /**
     * @var        ObjectCollection|ChildStageMaterial[] Collection to store aggregation of ChildStageMaterial objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildStageMaterial> Collection to store aggregation of ChildStageMaterial objects.
     */
    protected $collStageMaterials;
    protected $collStageMaterialsPartial;

    /**
     * @var        ObjectCollection|ChildWorkMaterial[] Collection to store aggregation of ChildWorkMaterial objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildWorkMaterial> Collection to store aggregation of ChildWorkMaterial objects.
     */
    protected $collWorkMaterials;
    protected $collWorkMaterialsPartial;

    /**
     * @var        ObjectCollection|ChildMaterialVersion[] Collection to store aggregation of ChildMaterialVersion objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildMaterialVersion> Collection to store aggregation of ChildMaterialVersion objects.
     */
    protected $collMaterialVersions;
    protected $collMaterialVersionsPartial;

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
     * @var ObjectCollection|ChildStageMaterial[]
     * @phpstan-var ObjectCollection&\Traversable<ChildStageMaterial>
     */
    protected $stageMaterialsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildWorkMaterial[]
     * @phpstan-var ObjectCollection&\Traversable<ChildWorkMaterial>
     */
    protected $workMaterialsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildMaterialVersion[]
     * @phpstan-var ObjectCollection&\Traversable<ChildMaterialVersion>
     */
    protected $materialVersionsScheduledForDeletion = null;

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
     * Initializes internal state of DB\Base\Material object.
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
     * Compares this with another <code>Material</code> instance.  If
     * <code>obj</code> is an instance of <code>Material</code>, delegates to
     * <code>equals(Material)</code>.  Otherwise, returns <code>false</code>.
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
     * ID материала
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
     * Get the [price] column value.
     * Стоимость
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
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
     * Get the [unit_id] column value.
     * ID ед. измерения
     * @return int
     */
    public function getUnitId()
    {
        return $this->unit_id;
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
     * ID материала
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
            $this->modifiedColumns[MaterialTableMap::COL_ID] = true;
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
            $this->modifiedColumns[MaterialTableMap::COL_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [price] column.
     * Стоимость
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPrice($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->price !== $v) {
            $this->price = $v;
            $this->modifiedColumns[MaterialTableMap::COL_PRICE] = true;
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
            $this->modifiedColumns[MaterialTableMap::COL_IS_AVAILABLE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [unit_id] column.
     * ID ед. измерения
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setUnitId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->unit_id !== $v) {
            $this->unit_id = $v;
            $this->modifiedColumns[MaterialTableMap::COL_UNIT_ID] = true;
        }

        if ($this->aUnit !== null && $this->aUnit->getId() !== $v) {
            $this->aUnit = null;
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
            $this->modifiedColumns[MaterialTableMap::COL_VERSION] = true;
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
                $this->modifiedColumns[MaterialTableMap::COL_VERSION_CREATED_AT] = true;
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
            $this->modifiedColumns[MaterialTableMap::COL_VERSION_CREATED_BY] = true;
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
            $this->modifiedColumns[MaterialTableMap::COL_VERSION_COMMENT] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : MaterialTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : MaterialTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : MaterialTableMap::translateFieldName('Price', TableMap::TYPE_PHPNAME, $indexType)];
            $this->price = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : MaterialTableMap::translateFieldName('IsAvailable', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_available = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : MaterialTableMap::translateFieldName('UnitId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->unit_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : MaterialTableMap::translateFieldName('Version', TableMap::TYPE_PHPNAME, $indexType)];
            $this->version = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : MaterialTableMap::translateFieldName('VersionCreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->version_created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : MaterialTableMap::translateFieldName('VersionCreatedBy', TableMap::TYPE_PHPNAME, $indexType)];
            $this->version_created_by = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : MaterialTableMap::translateFieldName('VersionComment', TableMap::TYPE_PHPNAME, $indexType)];
            $this->version_comment = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 9; // 9 = MaterialTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\DB\\Material'), 0, $e);
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
        if ($this->aUnit !== null && $this->unit_id !== $this->aUnit->getId()) {
            $this->aUnit = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(MaterialTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildMaterialQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aUnit = null;
            $this->collStageMaterials = null;

            $this->collWorkMaterials = null;

            $this->collMaterialVersions = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see Material::setDeleted()
     * @see Material::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(MaterialTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildMaterialQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(MaterialTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            // versionable behavior
            if ($this->isVersioningNecessary()) {
                $this->setVersion($this->isNew() ? 1 : $this->getLastVersionNumber($con) + 1);
                if (!$this->isColumnModified(MaterialTableMap::COL_VERSION_CREATED_AT)) {
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
                MaterialTableMap::addInstanceToPool($this);
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

            if ($this->aUnit !== null) {
                if ($this->aUnit->isModified() || $this->aUnit->isNew()) {
                    $affectedRows += $this->aUnit->save($con);
                }
                $this->setUnit($this->aUnit);
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

            if ($this->stageMaterialsScheduledForDeletion !== null) {
                if (!$this->stageMaterialsScheduledForDeletion->isEmpty()) {
                    \DB\StageMaterialQuery::create()
                        ->filterByPrimaryKeys($this->stageMaterialsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->stageMaterialsScheduledForDeletion = null;
                }
            }

            if ($this->collStageMaterials !== null) {
                foreach ($this->collStageMaterials as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->workMaterialsScheduledForDeletion !== null) {
                if (!$this->workMaterialsScheduledForDeletion->isEmpty()) {
                    \DB\WorkMaterialQuery::create()
                        ->filterByPrimaryKeys($this->workMaterialsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->workMaterialsScheduledForDeletion = null;
                }
            }

            if ($this->collWorkMaterials !== null) {
                foreach ($this->collWorkMaterials as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->materialVersionsScheduledForDeletion !== null) {
                if (!$this->materialVersionsScheduledForDeletion->isEmpty()) {
                    \DB\MaterialVersionQuery::create()
                        ->filterByPrimaryKeys($this->materialVersionsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->materialVersionsScheduledForDeletion = null;
                }
            }

            if ($this->collMaterialVersions !== null) {
                foreach ($this->collMaterialVersions as $referrerFK) {
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

        $this->modifiedColumns[MaterialTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . MaterialTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(MaterialTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(MaterialTableMap::COL_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'name';
        }
        if ($this->isColumnModified(MaterialTableMap::COL_PRICE)) {
            $modifiedColumns[':p' . $index++]  = 'price';
        }
        if ($this->isColumnModified(MaterialTableMap::COL_IS_AVAILABLE)) {
            $modifiedColumns[':p' . $index++]  = 'is_available';
        }
        if ($this->isColumnModified(MaterialTableMap::COL_UNIT_ID)) {
            $modifiedColumns[':p' . $index++]  = 'unit_id';
        }
        if ($this->isColumnModified(MaterialTableMap::COL_VERSION)) {
            $modifiedColumns[':p' . $index++]  = 'version';
        }
        if ($this->isColumnModified(MaterialTableMap::COL_VERSION_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'version_created_at';
        }
        if ($this->isColumnModified(MaterialTableMap::COL_VERSION_CREATED_BY)) {
            $modifiedColumns[':p' . $index++]  = 'version_created_by';
        }
        if ($this->isColumnModified(MaterialTableMap::COL_VERSION_COMMENT)) {
            $modifiedColumns[':p' . $index++]  = 'version_comment';
        }

        $sql = sprintf(
            'INSERT INTO material (%s) VALUES (%s)',
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
                    case 'price':
                        $stmt->bindValue($identifier, $this->price, PDO::PARAM_STR);
                        break;
                    case 'is_available':
                        $stmt->bindValue($identifier, (int) $this->is_available, PDO::PARAM_INT);
                        break;
                    case 'unit_id':
                        $stmt->bindValue($identifier, $this->unit_id, PDO::PARAM_INT);
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
        $pos = MaterialTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getPrice();

            case 3:
                return $this->getIsAvailable();

            case 4:
                return $this->getUnitId();

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
        if (isset($alreadyDumpedObjects['Material'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['Material'][$this->hashCode()] = true;
        $keys = MaterialTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getId(),
            $keys[1] => $this->getName(),
            $keys[2] => $this->getPrice(),
            $keys[3] => $this->getIsAvailable(),
            $keys[4] => $this->getUnitId(),
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
            if (null !== $this->aUnit) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'unit';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'unit';
                        break;
                    default:
                        $key = 'Unit';
                }

                $result[$key] = $this->aUnit->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collStageMaterials) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'stageMaterials';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'stage_materials';
                        break;
                    default:
                        $key = 'StageMaterials';
                }

                $result[$key] = $this->collStageMaterials->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collWorkMaterials) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'workMaterials';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'work_materials';
                        break;
                    default:
                        $key = 'WorkMaterials';
                }

                $result[$key] = $this->collWorkMaterials->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collMaterialVersions) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'materialVersions';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'material_versions';
                        break;
                    default:
                        $key = 'MaterialVersions';
                }

                $result[$key] = $this->collMaterialVersions->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = MaterialTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setPrice($value);
                break;
            case 3:
                $this->setIsAvailable($value);
                break;
            case 4:
                $this->setUnitId($value);
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
        $keys = MaterialTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setName($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setPrice($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setIsAvailable($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setUnitId($arr[$keys[4]]);
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
        $criteria = new Criteria(MaterialTableMap::DATABASE_NAME);

        if ($this->isColumnModified(MaterialTableMap::COL_ID)) {
            $criteria->add(MaterialTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(MaterialTableMap::COL_NAME)) {
            $criteria->add(MaterialTableMap::COL_NAME, $this->name);
        }
        if ($this->isColumnModified(MaterialTableMap::COL_PRICE)) {
            $criteria->add(MaterialTableMap::COL_PRICE, $this->price);
        }
        if ($this->isColumnModified(MaterialTableMap::COL_IS_AVAILABLE)) {
            $criteria->add(MaterialTableMap::COL_IS_AVAILABLE, $this->is_available);
        }
        if ($this->isColumnModified(MaterialTableMap::COL_UNIT_ID)) {
            $criteria->add(MaterialTableMap::COL_UNIT_ID, $this->unit_id);
        }
        if ($this->isColumnModified(MaterialTableMap::COL_VERSION)) {
            $criteria->add(MaterialTableMap::COL_VERSION, $this->version);
        }
        if ($this->isColumnModified(MaterialTableMap::COL_VERSION_CREATED_AT)) {
            $criteria->add(MaterialTableMap::COL_VERSION_CREATED_AT, $this->version_created_at);
        }
        if ($this->isColumnModified(MaterialTableMap::COL_VERSION_CREATED_BY)) {
            $criteria->add(MaterialTableMap::COL_VERSION_CREATED_BY, $this->version_created_by);
        }
        if ($this->isColumnModified(MaterialTableMap::COL_VERSION_COMMENT)) {
            $criteria->add(MaterialTableMap::COL_VERSION_COMMENT, $this->version_comment);
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
        $criteria = ChildMaterialQuery::create();
        $criteria->add(MaterialTableMap::COL_ID, $this->id);

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
     * @param object $copyObj An object of \DB\Material (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setName($this->getName());
        $copyObj->setPrice($this->getPrice());
        $copyObj->setIsAvailable($this->getIsAvailable());
        $copyObj->setUnitId($this->getUnitId());
        $copyObj->setVersion($this->getVersion());
        $copyObj->setVersionCreatedAt($this->getVersionCreatedAt());
        $copyObj->setVersionCreatedBy($this->getVersionCreatedBy());
        $copyObj->setVersionComment($this->getVersionComment());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getStageMaterials() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addStageMaterial($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getWorkMaterials() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addWorkMaterial($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getMaterialVersions() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addMaterialVersion($relObj->copy($deepCopy));
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
     * @return \DB\Material Clone of current object.
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
     * Declares an association between this object and a ChildUnit object.
     *
     * @param ChildUnit $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setUnit(ChildUnit $v = null)
    {
        if ($v === null) {
            $this->setUnitId(NULL);
        } else {
            $this->setUnitId($v->getId());
        }

        $this->aUnit = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildUnit object, it will not be re-added.
        if ($v !== null) {
            $v->addMaterial($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildUnit object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildUnit The associated ChildUnit object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getUnit(?ConnectionInterface $con = null)
    {
        if ($this->aUnit === null && ($this->unit_id != 0)) {
            $this->aUnit = ChildUnitQuery::create()->findPk($this->unit_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aUnit->addMaterials($this);
             */
        }

        return $this->aUnit;
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
        if ('StageMaterial' === $relationName) {
            $this->initStageMaterials();
            return;
        }
        if ('WorkMaterial' === $relationName) {
            $this->initWorkMaterials();
            return;
        }
        if ('MaterialVersion' === $relationName) {
            $this->initMaterialVersions();
            return;
        }
    }

    /**
     * Clears out the collStageMaterials collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addStageMaterials()
     */
    public function clearStageMaterials()
    {
        $this->collStageMaterials = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collStageMaterials collection loaded partially.
     *
     * @return void
     */
    public function resetPartialStageMaterials($v = true): void
    {
        $this->collStageMaterialsPartial = $v;
    }

    /**
     * Initializes the collStageMaterials collection.
     *
     * By default this just sets the collStageMaterials collection to an empty array (like clearcollStageMaterials());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initStageMaterials(bool $overrideExisting = true): void
    {
        if (null !== $this->collStageMaterials && !$overrideExisting) {
            return;
        }

        $collectionClassName = StageMaterialTableMap::getTableMap()->getCollectionClassName();

        $this->collStageMaterials = new $collectionClassName;
        $this->collStageMaterials->setModel('\DB\StageMaterial');
    }

    /**
     * Gets an array of ChildStageMaterial objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildMaterial is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildStageMaterial[] List of ChildStageMaterial objects
     * @phpstan-return ObjectCollection&\Traversable<ChildStageMaterial> List of ChildStageMaterial objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getStageMaterials(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collStageMaterialsPartial && !$this->isNew();
        if (null === $this->collStageMaterials || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collStageMaterials) {
                    $this->initStageMaterials();
                } else {
                    $collectionClassName = StageMaterialTableMap::getTableMap()->getCollectionClassName();

                    $collStageMaterials = new $collectionClassName;
                    $collStageMaterials->setModel('\DB\StageMaterial');

                    return $collStageMaterials;
                }
            } else {
                $collStageMaterials = ChildStageMaterialQuery::create(null, $criteria)
                    ->filterByMaterial($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collStageMaterialsPartial && count($collStageMaterials)) {
                        $this->initStageMaterials(false);

                        foreach ($collStageMaterials as $obj) {
                            if (false == $this->collStageMaterials->contains($obj)) {
                                $this->collStageMaterials->append($obj);
                            }
                        }

                        $this->collStageMaterialsPartial = true;
                    }

                    return $collStageMaterials;
                }

                if ($partial && $this->collStageMaterials) {
                    foreach ($this->collStageMaterials as $obj) {
                        if ($obj->isNew()) {
                            $collStageMaterials[] = $obj;
                        }
                    }
                }

                $this->collStageMaterials = $collStageMaterials;
                $this->collStageMaterialsPartial = false;
            }
        }

        return $this->collStageMaterials;
    }

    /**
     * Sets a collection of ChildStageMaterial objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $stageMaterials A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setStageMaterials(Collection $stageMaterials, ?ConnectionInterface $con = null)
    {
        /** @var ChildStageMaterial[] $stageMaterialsToDelete */
        $stageMaterialsToDelete = $this->getStageMaterials(new Criteria(), $con)->diff($stageMaterials);


        $this->stageMaterialsScheduledForDeletion = $stageMaterialsToDelete;

        foreach ($stageMaterialsToDelete as $stageMaterialRemoved) {
            $stageMaterialRemoved->setMaterial(null);
        }

        $this->collStageMaterials = null;
        foreach ($stageMaterials as $stageMaterial) {
            $this->addStageMaterial($stageMaterial);
        }

        $this->collStageMaterials = $stageMaterials;
        $this->collStageMaterialsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related StageMaterial objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related StageMaterial objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countStageMaterials(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collStageMaterialsPartial && !$this->isNew();
        if (null === $this->collStageMaterials || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collStageMaterials) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getStageMaterials());
            }

            $query = ChildStageMaterialQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByMaterial($this)
                ->count($con);
        }

        return count($this->collStageMaterials);
    }

    /**
     * Method called to associate a ChildStageMaterial object to this object
     * through the ChildStageMaterial foreign key attribute.
     *
     * @param ChildStageMaterial $l ChildStageMaterial
     * @return $this The current object (for fluent API support)
     */
    public function addStageMaterial(ChildStageMaterial $l)
    {
        if ($this->collStageMaterials === null) {
            $this->initStageMaterials();
            $this->collStageMaterialsPartial = true;
        }

        if (!$this->collStageMaterials->contains($l)) {
            $this->doAddStageMaterial($l);

            if ($this->stageMaterialsScheduledForDeletion and $this->stageMaterialsScheduledForDeletion->contains($l)) {
                $this->stageMaterialsScheduledForDeletion->remove($this->stageMaterialsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildStageMaterial $stageMaterial The ChildStageMaterial object to add.
     */
    protected function doAddStageMaterial(ChildStageMaterial $stageMaterial): void
    {
        $this->collStageMaterials[]= $stageMaterial;
        $stageMaterial->setMaterial($this);
    }

    /**
     * @param ChildStageMaterial $stageMaterial The ChildStageMaterial object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeStageMaterial(ChildStageMaterial $stageMaterial)
    {
        if ($this->getStageMaterials()->contains($stageMaterial)) {
            $pos = $this->collStageMaterials->search($stageMaterial);
            $this->collStageMaterials->remove($pos);
            if (null === $this->stageMaterialsScheduledForDeletion) {
                $this->stageMaterialsScheduledForDeletion = clone $this->collStageMaterials;
                $this->stageMaterialsScheduledForDeletion->clear();
            }
            $this->stageMaterialsScheduledForDeletion[]= clone $stageMaterial;
            $stageMaterial->setMaterial(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Material is new, it will return
     * an empty collection; or if this Material has previously
     * been saved, it will retrieve related StageMaterials from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Material.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildStageMaterial[] List of ChildStageMaterial objects
     * @phpstan-return ObjectCollection&\Traversable<ChildStageMaterial}> List of ChildStageMaterial objects
     */
    public function getStageMaterialsJoinStageWork(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildStageMaterialQuery::create(null, $criteria);
        $query->joinWith('StageWork', $joinBehavior);

        return $this->getStageMaterials($query, $con);
    }

    /**
     * Clears out the collWorkMaterials collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addWorkMaterials()
     */
    public function clearWorkMaterials()
    {
        $this->collWorkMaterials = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collWorkMaterials collection loaded partially.
     *
     * @return void
     */
    public function resetPartialWorkMaterials($v = true): void
    {
        $this->collWorkMaterialsPartial = $v;
    }

    /**
     * Initializes the collWorkMaterials collection.
     *
     * By default this just sets the collWorkMaterials collection to an empty array (like clearcollWorkMaterials());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initWorkMaterials(bool $overrideExisting = true): void
    {
        if (null !== $this->collWorkMaterials && !$overrideExisting) {
            return;
        }

        $collectionClassName = WorkMaterialTableMap::getTableMap()->getCollectionClassName();

        $this->collWorkMaterials = new $collectionClassName;
        $this->collWorkMaterials->setModel('\DB\WorkMaterial');
    }

    /**
     * Gets an array of ChildWorkMaterial objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildMaterial is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildWorkMaterial[] List of ChildWorkMaterial objects
     * @phpstan-return ObjectCollection&\Traversable<ChildWorkMaterial> List of ChildWorkMaterial objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getWorkMaterials(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collWorkMaterialsPartial && !$this->isNew();
        if (null === $this->collWorkMaterials || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collWorkMaterials) {
                    $this->initWorkMaterials();
                } else {
                    $collectionClassName = WorkMaterialTableMap::getTableMap()->getCollectionClassName();

                    $collWorkMaterials = new $collectionClassName;
                    $collWorkMaterials->setModel('\DB\WorkMaterial');

                    return $collWorkMaterials;
                }
            } else {
                $collWorkMaterials = ChildWorkMaterialQuery::create(null, $criteria)
                    ->filterByMaterial($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collWorkMaterialsPartial && count($collWorkMaterials)) {
                        $this->initWorkMaterials(false);

                        foreach ($collWorkMaterials as $obj) {
                            if (false == $this->collWorkMaterials->contains($obj)) {
                                $this->collWorkMaterials->append($obj);
                            }
                        }

                        $this->collWorkMaterialsPartial = true;
                    }

                    return $collWorkMaterials;
                }

                if ($partial && $this->collWorkMaterials) {
                    foreach ($this->collWorkMaterials as $obj) {
                        if ($obj->isNew()) {
                            $collWorkMaterials[] = $obj;
                        }
                    }
                }

                $this->collWorkMaterials = $collWorkMaterials;
                $this->collWorkMaterialsPartial = false;
            }
        }

        return $this->collWorkMaterials;
    }

    /**
     * Sets a collection of ChildWorkMaterial objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $workMaterials A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setWorkMaterials(Collection $workMaterials, ?ConnectionInterface $con = null)
    {
        /** @var ChildWorkMaterial[] $workMaterialsToDelete */
        $workMaterialsToDelete = $this->getWorkMaterials(new Criteria(), $con)->diff($workMaterials);


        $this->workMaterialsScheduledForDeletion = $workMaterialsToDelete;

        foreach ($workMaterialsToDelete as $workMaterialRemoved) {
            $workMaterialRemoved->setMaterial(null);
        }

        $this->collWorkMaterials = null;
        foreach ($workMaterials as $workMaterial) {
            $this->addWorkMaterial($workMaterial);
        }

        $this->collWorkMaterials = $workMaterials;
        $this->collWorkMaterialsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related WorkMaterial objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related WorkMaterial objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countWorkMaterials(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collWorkMaterialsPartial && !$this->isNew();
        if (null === $this->collWorkMaterials || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collWorkMaterials) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getWorkMaterials());
            }

            $query = ChildWorkMaterialQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByMaterial($this)
                ->count($con);
        }

        return count($this->collWorkMaterials);
    }

    /**
     * Method called to associate a ChildWorkMaterial object to this object
     * through the ChildWorkMaterial foreign key attribute.
     *
     * @param ChildWorkMaterial $l ChildWorkMaterial
     * @return $this The current object (for fluent API support)
     */
    public function addWorkMaterial(ChildWorkMaterial $l)
    {
        if ($this->collWorkMaterials === null) {
            $this->initWorkMaterials();
            $this->collWorkMaterialsPartial = true;
        }

        if (!$this->collWorkMaterials->contains($l)) {
            $this->doAddWorkMaterial($l);

            if ($this->workMaterialsScheduledForDeletion and $this->workMaterialsScheduledForDeletion->contains($l)) {
                $this->workMaterialsScheduledForDeletion->remove($this->workMaterialsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildWorkMaterial $workMaterial The ChildWorkMaterial object to add.
     */
    protected function doAddWorkMaterial(ChildWorkMaterial $workMaterial): void
    {
        $this->collWorkMaterials[]= $workMaterial;
        $workMaterial->setMaterial($this);
    }

    /**
     * @param ChildWorkMaterial $workMaterial The ChildWorkMaterial object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeWorkMaterial(ChildWorkMaterial $workMaterial)
    {
        if ($this->getWorkMaterials()->contains($workMaterial)) {
            $pos = $this->collWorkMaterials->search($workMaterial);
            $this->collWorkMaterials->remove($pos);
            if (null === $this->workMaterialsScheduledForDeletion) {
                $this->workMaterialsScheduledForDeletion = clone $this->collWorkMaterials;
                $this->workMaterialsScheduledForDeletion->clear();
            }
            $this->workMaterialsScheduledForDeletion[]= clone $workMaterial;
            $workMaterial->setMaterial(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Material is new, it will return
     * an empty collection; or if this Material has previously
     * been saved, it will retrieve related WorkMaterials from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Material.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildWorkMaterial[] List of ChildWorkMaterial objects
     * @phpstan-return ObjectCollection&\Traversable<ChildWorkMaterial}> List of ChildWorkMaterial objects
     */
    public function getWorkMaterialsJoinWork(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildWorkMaterialQuery::create(null, $criteria);
        $query->joinWith('Work', $joinBehavior);

        return $this->getWorkMaterials($query, $con);
    }

    /**
     * Clears out the collMaterialVersions collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addMaterialVersions()
     */
    public function clearMaterialVersions()
    {
        $this->collMaterialVersions = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collMaterialVersions collection loaded partially.
     *
     * @return void
     */
    public function resetPartialMaterialVersions($v = true): void
    {
        $this->collMaterialVersionsPartial = $v;
    }

    /**
     * Initializes the collMaterialVersions collection.
     *
     * By default this just sets the collMaterialVersions collection to an empty array (like clearcollMaterialVersions());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initMaterialVersions(bool $overrideExisting = true): void
    {
        if (null !== $this->collMaterialVersions && !$overrideExisting) {
            return;
        }

        $collectionClassName = MaterialVersionTableMap::getTableMap()->getCollectionClassName();

        $this->collMaterialVersions = new $collectionClassName;
        $this->collMaterialVersions->setModel('\DB\MaterialVersion');
    }

    /**
     * Gets an array of ChildMaterialVersion objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildMaterial is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildMaterialVersion[] List of ChildMaterialVersion objects
     * @phpstan-return ObjectCollection&\Traversable<ChildMaterialVersion> List of ChildMaterialVersion objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getMaterialVersions(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collMaterialVersionsPartial && !$this->isNew();
        if (null === $this->collMaterialVersions || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collMaterialVersions) {
                    $this->initMaterialVersions();
                } else {
                    $collectionClassName = MaterialVersionTableMap::getTableMap()->getCollectionClassName();

                    $collMaterialVersions = new $collectionClassName;
                    $collMaterialVersions->setModel('\DB\MaterialVersion');

                    return $collMaterialVersions;
                }
            } else {
                $collMaterialVersions = ChildMaterialVersionQuery::create(null, $criteria)
                    ->filterByMaterial($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collMaterialVersionsPartial && count($collMaterialVersions)) {
                        $this->initMaterialVersions(false);

                        foreach ($collMaterialVersions as $obj) {
                            if (false == $this->collMaterialVersions->contains($obj)) {
                                $this->collMaterialVersions->append($obj);
                            }
                        }

                        $this->collMaterialVersionsPartial = true;
                    }

                    return $collMaterialVersions;
                }

                if ($partial && $this->collMaterialVersions) {
                    foreach ($this->collMaterialVersions as $obj) {
                        if ($obj->isNew()) {
                            $collMaterialVersions[] = $obj;
                        }
                    }
                }

                $this->collMaterialVersions = $collMaterialVersions;
                $this->collMaterialVersionsPartial = false;
            }
        }

        return $this->collMaterialVersions;
    }

    /**
     * Sets a collection of ChildMaterialVersion objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $materialVersions A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setMaterialVersions(Collection $materialVersions, ?ConnectionInterface $con = null)
    {
        /** @var ChildMaterialVersion[] $materialVersionsToDelete */
        $materialVersionsToDelete = $this->getMaterialVersions(new Criteria(), $con)->diff($materialVersions);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->materialVersionsScheduledForDeletion = clone $materialVersionsToDelete;

        foreach ($materialVersionsToDelete as $materialVersionRemoved) {
            $materialVersionRemoved->setMaterial(null);
        }

        $this->collMaterialVersions = null;
        foreach ($materialVersions as $materialVersion) {
            $this->addMaterialVersion($materialVersion);
        }

        $this->collMaterialVersions = $materialVersions;
        $this->collMaterialVersionsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related MaterialVersion objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related MaterialVersion objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countMaterialVersions(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collMaterialVersionsPartial && !$this->isNew();
        if (null === $this->collMaterialVersions || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collMaterialVersions) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getMaterialVersions());
            }

            $query = ChildMaterialVersionQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByMaterial($this)
                ->count($con);
        }

        return count($this->collMaterialVersions);
    }

    /**
     * Method called to associate a ChildMaterialVersion object to this object
     * through the ChildMaterialVersion foreign key attribute.
     *
     * @param ChildMaterialVersion $l ChildMaterialVersion
     * @return $this The current object (for fluent API support)
     */
    public function addMaterialVersion(ChildMaterialVersion $l)
    {
        if ($this->collMaterialVersions === null) {
            $this->initMaterialVersions();
            $this->collMaterialVersionsPartial = true;
        }

        if (!$this->collMaterialVersions->contains($l)) {
            $this->doAddMaterialVersion($l);

            if ($this->materialVersionsScheduledForDeletion and $this->materialVersionsScheduledForDeletion->contains($l)) {
                $this->materialVersionsScheduledForDeletion->remove($this->materialVersionsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildMaterialVersion $materialVersion The ChildMaterialVersion object to add.
     */
    protected function doAddMaterialVersion(ChildMaterialVersion $materialVersion): void
    {
        $this->collMaterialVersions[]= $materialVersion;
        $materialVersion->setMaterial($this);
    }

    /**
     * @param ChildMaterialVersion $materialVersion The ChildMaterialVersion object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeMaterialVersion(ChildMaterialVersion $materialVersion)
    {
        if ($this->getMaterialVersions()->contains($materialVersion)) {
            $pos = $this->collMaterialVersions->search($materialVersion);
            $this->collMaterialVersions->remove($pos);
            if (null === $this->materialVersionsScheduledForDeletion) {
                $this->materialVersionsScheduledForDeletion = clone $this->collMaterialVersions;
                $this->materialVersionsScheduledForDeletion->clear();
            }
            $this->materialVersionsScheduledForDeletion[]= clone $materialVersion;
            $materialVersion->setMaterial(null);
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
        if (null !== $this->aUnit) {
            $this->aUnit->removeMaterial($this);
        }
        $this->id = null;
        $this->name = null;
        $this->price = null;
        $this->is_available = null;
        $this->unit_id = null;
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
            if ($this->collStageMaterials) {
                foreach ($this->collStageMaterials as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collWorkMaterials) {
                foreach ($this->collWorkMaterials as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collMaterialVersions) {
                foreach ($this->collMaterialVersions as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collStageMaterials = null;
        $this->collWorkMaterials = null;
        $this->collMaterialVersions = null;
        $this->aUnit = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(MaterialTableMap::DEFAULT_STRING_FORMAT);
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

        if (ChildMaterialQuery::isVersioningEnabled() && ($this->isNew() || $this->isModified()) || $this->isDeleted()) {
            return true;
        }
        if ($this->collStageMaterials) {

            // to avoid infinite loops, emulate in save
            $this->alreadyInSave = true;

            foreach ($this->getStageMaterials(null, $con) as $relatedObject) {

                if ($relatedObject->isVersioningNecessary($con)) {

                    $this->alreadyInSave = false;
                    return true;
                }
            }
            $this->alreadyInSave = false;
        }

        if ($this->collWorkMaterials) {

            // to avoid infinite loops, emulate in save
            $this->alreadyInSave = true;

            foreach ($this->getWorkMaterials(null, $con) as $relatedObject) {

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
     * @return ChildMaterialVersion A version object
     */
    public function addVersion(?ConnectionInterface $con = null)
    {
        $this->enforceVersion = false;

        $version = new ChildMaterialVersion();
        $version->setId($this->getId());
        $version->setName($this->getName());
        $version->setPrice($this->getPrice());
        $version->setIsAvailable($this->getIsAvailable());
        $version->setUnitId($this->getUnitId());
        $version->setVersion($this->getVersion());
        $version->setVersionCreatedAt($this->getVersionCreatedAt());
        $version->setVersionCreatedBy($this->getVersionCreatedBy());
        $version->setVersionComment($this->getVersionComment());
        $version->setMaterial($this);
        $object = $this->getStageMaterials(null, $con);


        if ($object && $relateds = $object->toKeyValue('Id', 'Version')) {
            $version->setStageMaterialIds(array_keys($relateds));
            $version->setStageMaterialVersions(array_values($relateds));
        }

        $object = $this->getWorkMaterials(null, $con);


        if ($object && $relateds = $object->toKeyValue('Id', 'Version')) {
            $version->setWorkMaterialIds(array_keys($relateds));
            $version->setWorkMaterialVersions(array_values($relateds));
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
            throw new PropelException(sprintf('No ChildMaterial object found with version %d', $version));
        }
        $this->populateFromVersion($version, $con);

        return $this;
    }

    /**
     * Sets the properties of the current object to the value they had at a specific version
     *
     * @param ChildMaterialVersion $version The version object to use
     * @param ConnectionInterface $con the connection to use
     * @param array $loadedObjects objects that been loaded in a chain of populateFromVersion calls on referrer or fk objects.
     *
     * @return $this The current object (for fluent API support)
     */
    public function populateFromVersion($version, $con = null, &$loadedObjects = [])
    {
        $loadedObjects['ChildMaterial'][$version->getId()][$version->getVersion()] = $this;
        $this->setId($version->getId());
        $this->setName($version->getName());
        $this->setPrice($version->getPrice());
        $this->setIsAvailable($version->getIsAvailable());
        $this->setUnitId($version->getUnitId());
        $this->setVersion($version->getVersion());
        $this->setVersionCreatedAt($version->getVersionCreatedAt());
        $this->setVersionCreatedBy($version->getVersionCreatedBy());
        $this->setVersionComment($version->getVersionComment());
        if ($fkValues = $version->getStageMaterialIds()) {
            $this->clearStageMaterials();
            $fkVersions = $version->getStageMaterialVersions();
            $query = ChildStageMaterialVersionQuery::create();
            foreach ($fkValues as $key => $value) {
                $c1 = $query->getNewCriterion(StageMaterialVersionTableMap::COL_ID, $value);
                $c2 = $query->getNewCriterion(StageMaterialVersionTableMap::COL_VERSION, $fkVersions[$key]);
                $c1->addAnd($c2);
                $query->addOr($c1);
            }
            foreach ($query->find($con) as $relatedVersion) {
                if (isset($loadedObjects['ChildStageMaterial']) && isset($loadedObjects['ChildStageMaterial'][$relatedVersion->getId()]) && isset($loadedObjects['ChildStageMaterial'][$relatedVersion->getId()][$relatedVersion->getVersion()])) {
                    $related = $loadedObjects['ChildStageMaterial'][$relatedVersion->getId()][$relatedVersion->getVersion()];
                } else {
                    $related = new ChildStageMaterial();
                    $related->populateFromVersion($relatedVersion, $con, $loadedObjects);
                    $related->setNew(false);
                }
                $this->addStageMaterial($related);
                $this->collStageMaterialsPartial = false;
            }
        }
        if ($fkValues = $version->getWorkMaterialIds()) {
            $this->clearWorkMaterial();
            $fkVersions = $version->getWorkMaterialVersions();
            $query = ChildWorkMaterialVersionQuery::create();
            foreach ($fkValues as $key => $value) {
                $c1 = $query->getNewCriterion(WorkMaterialVersionTableMap::COL_ID, $value);
                $c2 = $query->getNewCriterion(WorkMaterialVersionTableMap::COL_VERSION, $fkVersions[$key]);
                $c1->addAnd($c2);
                $query->addOr($c1);
            }
            foreach ($query->find($con) as $relatedVersion) {
                if (isset($loadedObjects['ChildWorkMaterial']) && isset($loadedObjects['ChildWorkMaterial'][$relatedVersion->getId()]) && isset($loadedObjects['ChildWorkMaterial'][$relatedVersion->getId()][$relatedVersion->getVersion()])) {
                    $related = $loadedObjects['ChildWorkMaterial'][$relatedVersion->getId()][$relatedVersion->getVersion()];
                } else {
                    $related = new ChildWorkMaterial();
                    $related->populateFromVersion($relatedVersion, $con, $loadedObjects);
                    $related->setNew(false);
                }
                $this->addWorkMaterial($related);
                $this->collWorkMaterialPartial = false;
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
        $v = ChildMaterialVersionQuery::create()
            ->filterByMaterial($this)
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
     * @return ChildMaterialVersion A version object
     */
    public function getOneVersion(int $versionNumber, ?ConnectionInterface $con = null)
    {
        return ChildMaterialVersionQuery::create()
            ->filterByMaterial($this)
            ->filterByVersion($versionNumber)
            ->findOne($con);
    }

    /**
     * Gets all the versions of this object, in incremental order
     *
     * @param ConnectionInterface $con The ConnectionInterface connection to use.
     *
     * @return ObjectCollection|ChildMaterialVersion[] A list of ChildMaterialVersion objects
     */
    public function getAllVersions(?ConnectionInterface $con = null)
    {
        $criteria = new Criteria();
        $criteria->addAscendingOrderByColumn(MaterialVersionTableMap::COL_VERSION);

        return $this->getMaterialVersions($criteria, $con);
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
     * @return PropelCollection|\DB\MaterialVersion[] List of \DB\MaterialVersion objects
     */
    public function getLastVersions($number = 10, $criteria = null, ?ConnectionInterface $con = null)
    {
        $criteria = ChildMaterialVersionQuery::create(null, $criteria);
        $criteria->addDescendingOrderByColumn(MaterialVersionTableMap::COL_VERSION);
        $criteria->limit($number);

        return $this->getMaterialVersions($criteria, $con);
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

        if ($this->is_available === true) $this->setVersionComment('update');
        else $this->setVersionComment('delete');

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
