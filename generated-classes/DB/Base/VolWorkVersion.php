<?php

namespace DB\Base;

use \DateTime;
use \Exception;
use \PDO;
use DB\VolWork as ChildVolWork;
use DB\VolWorkQuery as ChildVolWorkQuery;
use DB\VolWorkVersionQuery as ChildVolWorkVersionQuery;
use DB\Map\VolWorkVersionTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;

/**
 * Base class that represents a row from the 'vol_work_version' table.
 *
 *
 *
 * @package    propel.generator.DB.Base
 */
abstract class VolWorkVersion implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\DB\\Map\\VolWorkVersionTableMap';


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
     * ID работы
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
     * @var        int
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
     * The value for the obj_stage_work_ids field.
     *
     * @var        array|null
     */
    protected $obj_stage_work_ids;

    /**
     * The unserialized $obj_stage_work_ids value - i.e. the persisted object.
     * This is necessary to avoid repeated calls to unserialize() at runtime.
     * @var object
     */
    protected $obj_stage_work_ids_unserialized;

    /**
     * The value for the obj_stage_work_versions field.
     *
     * @var        array|null
     */
    protected $obj_stage_work_versions;

    /**
     * The unserialized $obj_stage_work_versions value - i.e. the persisted object.
     * This is necessary to avoid repeated calls to unserialize() at runtime.
     * @var object
     */
    protected $obj_stage_work_versions_unserialized;

    /**
     * The value for the vol_work_material_ids field.
     *
     * @var        array|null
     */
    protected $vol_work_material_ids;

    /**
     * The unserialized $vol_work_material_ids value - i.e. the persisted object.
     * This is necessary to avoid repeated calls to unserialize() at runtime.
     * @var object
     */
    protected $vol_work_material_ids_unserialized;

    /**
     * The value for the vol_work_material_versions field.
     *
     * @var        array|null
     */
    protected $vol_work_material_versions;

    /**
     * The unserialized $vol_work_material_versions value - i.e. the persisted object.
     * This is necessary to avoid repeated calls to unserialize() at runtime.
     * @var object
     */
    protected $vol_work_material_versions_unserialized;

    /**
     * The value for the vol_work_technic_ids field.
     *
     * @var        array|null
     */
    protected $vol_work_technic_ids;

    /**
     * The unserialized $vol_work_technic_ids value - i.e. the persisted object.
     * This is necessary to avoid repeated calls to unserialize() at runtime.
     * @var object
     */
    protected $vol_work_technic_ids_unserialized;

    /**
     * The value for the vol_work_technic_versions field.
     *
     * @var        array|null
     */
    protected $vol_work_technic_versions;

    /**
     * The unserialized $vol_work_technic_versions value - i.e. the persisted object.
     * This is necessary to avoid repeated calls to unserialize() at runtime.
     * @var object
     */
    protected $vol_work_technic_versions_unserialized;

    /**
     * @var        ChildVolWork
     */
    protected $aVolWork;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

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
     * Initializes internal state of DB\Base\VolWorkVersion object.
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
     * Compares this with another <code>VolWorkVersion</code> instance.  If
     * <code>obj</code> is an instance of <code>VolWorkVersion</code>, delegates to
     * <code>equals(VolWorkVersion)</code>.  Otherwise, returns <code>false</code>.
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
     * ID работы
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
     * @return int
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
     * Get the [obj_stage_work_ids] column value.
     *
     * @return array|null
     */
    public function getObjStageWorkIds()
    {
        if (null === $this->obj_stage_work_ids_unserialized) {
            $this->obj_stage_work_ids_unserialized = [];
        }
        if (!$this->obj_stage_work_ids_unserialized && null !== $this->obj_stage_work_ids) {
            $obj_stage_work_ids_unserialized = substr($this->obj_stage_work_ids, 2, -2);
            $this->obj_stage_work_ids_unserialized = '' !== $obj_stage_work_ids_unserialized ? explode(' | ', $obj_stage_work_ids_unserialized) : array();
        }

        return $this->obj_stage_work_ids_unserialized;
    }

    /**
     * Test the presence of a value in the [obj_stage_work_ids] array column value.
     * @param mixed $value
     *
     * @return bool
     */
    public function hasObjStageWorkId($value): bool
    {
        return in_array($value, $this->getObjStageWorkIds());
    }

    /**
     * Get the [obj_stage_work_versions] column value.
     *
     * @return array|null
     */
    public function getObjStageWorkVersions()
    {
        if (null === $this->obj_stage_work_versions_unserialized) {
            $this->obj_stage_work_versions_unserialized = [];
        }
        if (!$this->obj_stage_work_versions_unserialized && null !== $this->obj_stage_work_versions) {
            $obj_stage_work_versions_unserialized = substr($this->obj_stage_work_versions, 2, -2);
            $this->obj_stage_work_versions_unserialized = '' !== $obj_stage_work_versions_unserialized ? explode(' | ', $obj_stage_work_versions_unserialized) : array();
        }

        return $this->obj_stage_work_versions_unserialized;
    }

    /**
     * Test the presence of a value in the [obj_stage_work_versions] array column value.
     * @param mixed $value
     *
     * @return bool
     */
    public function hasObjStageWorkVersion($value): bool
    {
        return in_array($value, $this->getObjStageWorkVersions());
    }

    /**
     * Get the [vol_work_material_ids] column value.
     *
     * @return array|null
     */
    public function getVolWorkMaterialIds()
    {
        if (null === $this->vol_work_material_ids_unserialized) {
            $this->vol_work_material_ids_unserialized = [];
        }
        if (!$this->vol_work_material_ids_unserialized && null !== $this->vol_work_material_ids) {
            $vol_work_material_ids_unserialized = substr($this->vol_work_material_ids, 2, -2);
            $this->vol_work_material_ids_unserialized = '' !== $vol_work_material_ids_unserialized ? explode(' | ', $vol_work_material_ids_unserialized) : array();
        }

        return $this->vol_work_material_ids_unserialized;
    }

    /**
     * Test the presence of a value in the [vol_work_material_ids] array column value.
     * @param mixed $value
     *
     * @return bool
     */
    public function hasVolWorkMaterialId($value): bool
    {
        return in_array($value, $this->getVolWorkMaterialIds());
    }

    /**
     * Get the [vol_work_material_versions] column value.
     *
     * @return array|null
     */
    public function getVolWorkMaterialVersions()
    {
        if (null === $this->vol_work_material_versions_unserialized) {
            $this->vol_work_material_versions_unserialized = [];
        }
        if (!$this->vol_work_material_versions_unserialized && null !== $this->vol_work_material_versions) {
            $vol_work_material_versions_unserialized = substr($this->vol_work_material_versions, 2, -2);
            $this->vol_work_material_versions_unserialized = '' !== $vol_work_material_versions_unserialized ? explode(' | ', $vol_work_material_versions_unserialized) : array();
        }

        return $this->vol_work_material_versions_unserialized;
    }

    /**
     * Test the presence of a value in the [vol_work_material_versions] array column value.
     * @param mixed $value
     *
     * @return bool
     */
    public function hasVolWorkMaterialVersion($value): bool
    {
        return in_array($value, $this->getVolWorkMaterialVersions());
    }

    /**
     * Get the [vol_work_technic_ids] column value.
     *
     * @return array|null
     */
    public function getVolWorkTechnicIds()
    {
        if (null === $this->vol_work_technic_ids_unserialized) {
            $this->vol_work_technic_ids_unserialized = [];
        }
        if (!$this->vol_work_technic_ids_unserialized && null !== $this->vol_work_technic_ids) {
            $vol_work_technic_ids_unserialized = substr($this->vol_work_technic_ids, 2, -2);
            $this->vol_work_technic_ids_unserialized = '' !== $vol_work_technic_ids_unserialized ? explode(' | ', $vol_work_technic_ids_unserialized) : array();
        }

        return $this->vol_work_technic_ids_unserialized;
    }

    /**
     * Test the presence of a value in the [vol_work_technic_ids] array column value.
     * @param mixed $value
     *
     * @return bool
     */
    public function hasVolWorkTechnicId($value): bool
    {
        return in_array($value, $this->getVolWorkTechnicIds());
    }

    /**
     * Get the [vol_work_technic_versions] column value.
     *
     * @return array|null
     */
    public function getVolWorkTechnicVersions()
    {
        if (null === $this->vol_work_technic_versions_unserialized) {
            $this->vol_work_technic_versions_unserialized = [];
        }
        if (!$this->vol_work_technic_versions_unserialized && null !== $this->vol_work_technic_versions) {
            $vol_work_technic_versions_unserialized = substr($this->vol_work_technic_versions, 2, -2);
            $this->vol_work_technic_versions_unserialized = '' !== $vol_work_technic_versions_unserialized ? explode(' | ', $vol_work_technic_versions_unserialized) : array();
        }

        return $this->vol_work_technic_versions_unserialized;
    }

    /**
     * Test the presence of a value in the [vol_work_technic_versions] array column value.
     * @param mixed $value
     *
     * @return bool
     */
    public function hasVolWorkTechnicVersion($value): bool
    {
        return in_array($value, $this->getVolWorkTechnicVersions());
    }

    /**
     * Set the value of [id] column.
     * ID работы
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
            $this->modifiedColumns[VolWorkVersionTableMap::COL_ID] = true;
        }

        if ($this->aVolWork !== null && $this->aVolWork->getId() !== $v) {
            $this->aVolWork = null;
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
            $this->modifiedColumns[VolWorkVersionTableMap::COL_NAME] = true;
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
            $this->modifiedColumns[VolWorkVersionTableMap::COL_PRICE] = true;
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
            $this->modifiedColumns[VolWorkVersionTableMap::COL_IS_AVAILABLE] = true;
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
            $this->modifiedColumns[VolWorkVersionTableMap::COL_UNIT_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [version] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setVersion($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->version !== $v) {
            $this->version = $v;
            $this->modifiedColumns[VolWorkVersionTableMap::COL_VERSION] = true;
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
                $this->modifiedColumns[VolWorkVersionTableMap::COL_VERSION_CREATED_AT] = true;
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
            $this->modifiedColumns[VolWorkVersionTableMap::COL_VERSION_CREATED_BY] = true;
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
            $this->modifiedColumns[VolWorkVersionTableMap::COL_VERSION_COMMENT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [obj_stage_work_ids] column.
     *
     * @param array|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setObjStageWorkIds($v)
    {
        if ($this->obj_stage_work_ids_unserialized !== $v) {
            $this->obj_stage_work_ids_unserialized = $v;
            $this->obj_stage_work_ids = '| ' . implode(' | ', $v) . ' |';
            $this->modifiedColumns[VolWorkVersionTableMap::COL_OBJ_STAGE_WORK_IDS] = true;
        }

        return $this;
    }

    /**
     * Adds a value to the [obj_stage_work_ids] array column value.
     * @param mixed $value
     *
     * @return $this The current object (for fluent API support)
     */
    public function addObjStageWorkId($value)
    {
        $currentArray = $this->getObjStageWorkIds();
        $currentArray []= $value;
        $this->setObjStageWorkIds($currentArray);

        return $this;
    }

    /**
     * Removes a value from the [obj_stage_work_ids] array column value.
     * @param mixed $value
     *
     * @return $this The current object (for fluent API support)
     */
    public function removeObjStageWorkId($value)
    {
        $targetArray = [];
        foreach ($this->getObjStageWorkIds() as $element) {
            if ($element != $value) {
                $targetArray []= $element;
            }
        }
        $this->setObjStageWorkIds($targetArray);

        return $this;
    }

    /**
     * Set the value of [obj_stage_work_versions] column.
     *
     * @param array|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setObjStageWorkVersions($v)
    {
        if ($this->obj_stage_work_versions_unserialized !== $v) {
            $this->obj_stage_work_versions_unserialized = $v;
            $this->obj_stage_work_versions = '| ' . implode(' | ', $v) . ' |';
            $this->modifiedColumns[VolWorkVersionTableMap::COL_OBJ_STAGE_WORK_VERSIONS] = true;
        }

        return $this;
    }

    /**
     * Adds a value to the [obj_stage_work_versions] array column value.
     * @param mixed $value
     *
     * @return $this The current object (for fluent API support)
     */
    public function addObjStageWorkVersion($value)
    {
        $currentArray = $this->getObjStageWorkVersions();
        $currentArray []= $value;
        $this->setObjStageWorkVersions($currentArray);

        return $this;
    }

    /**
     * Removes a value from the [obj_stage_work_versions] array column value.
     * @param mixed $value
     *
     * @return $this The current object (for fluent API support)
     */
    public function removeObjStageWorkVersion($value)
    {
        $targetArray = [];
        foreach ($this->getObjStageWorkVersions() as $element) {
            if ($element != $value) {
                $targetArray []= $element;
            }
        }
        $this->setObjStageWorkVersions($targetArray);

        return $this;
    }

    /**
     * Set the value of [vol_work_material_ids] column.
     *
     * @param array|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setVolWorkMaterialIds($v)
    {
        if ($this->vol_work_material_ids_unserialized !== $v) {
            $this->vol_work_material_ids_unserialized = $v;
            $this->vol_work_material_ids = '| ' . implode(' | ', $v) . ' |';
            $this->modifiedColumns[VolWorkVersionTableMap::COL_VOL_WORK_MATERIAL_IDS] = true;
        }

        return $this;
    }

    /**
     * Adds a value to the [vol_work_material_ids] array column value.
     * @param mixed $value
     *
     * @return $this The current object (for fluent API support)
     */
    public function addVolWorkMaterialId($value)
    {
        $currentArray = $this->getVolWorkMaterialIds();
        $currentArray []= $value;
        $this->setVolWorkMaterialIds($currentArray);

        return $this;
    }

    /**
     * Removes a value from the [vol_work_material_ids] array column value.
     * @param mixed $value
     *
     * @return $this The current object (for fluent API support)
     */
    public function removeVolWorkMaterialId($value)
    {
        $targetArray = [];
        foreach ($this->getVolWorkMaterialIds() as $element) {
            if ($element != $value) {
                $targetArray []= $element;
            }
        }
        $this->setVolWorkMaterialIds($targetArray);

        return $this;
    }

    /**
     * Set the value of [vol_work_material_versions] column.
     *
     * @param array|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setVolWorkMaterialVersions($v)
    {
        if ($this->vol_work_material_versions_unserialized !== $v) {
            $this->vol_work_material_versions_unserialized = $v;
            $this->vol_work_material_versions = '| ' . implode(' | ', $v) . ' |';
            $this->modifiedColumns[VolWorkVersionTableMap::COL_VOL_WORK_MATERIAL_VERSIONS] = true;
        }

        return $this;
    }

    /**
     * Adds a value to the [vol_work_material_versions] array column value.
     * @param mixed $value
     *
     * @return $this The current object (for fluent API support)
     */
    public function addVolWorkMaterialVersion($value)
    {
        $currentArray = $this->getVolWorkMaterialVersions();
        $currentArray []= $value;
        $this->setVolWorkMaterialVersions($currentArray);

        return $this;
    }

    /**
     * Removes a value from the [vol_work_material_versions] array column value.
     * @param mixed $value
     *
     * @return $this The current object (for fluent API support)
     */
    public function removeVolWorkMaterialVersion($value)
    {
        $targetArray = [];
        foreach ($this->getVolWorkMaterialVersions() as $element) {
            if ($element != $value) {
                $targetArray []= $element;
            }
        }
        $this->setVolWorkMaterialVersions($targetArray);

        return $this;
    }

    /**
     * Set the value of [vol_work_technic_ids] column.
     *
     * @param array|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setVolWorkTechnicIds($v)
    {
        if ($this->vol_work_technic_ids_unserialized !== $v) {
            $this->vol_work_technic_ids_unserialized = $v;
            $this->vol_work_technic_ids = '| ' . implode(' | ', $v) . ' |';
            $this->modifiedColumns[VolWorkVersionTableMap::COL_VOL_WORK_TECHNIC_IDS] = true;
        }

        return $this;
    }

    /**
     * Adds a value to the [vol_work_technic_ids] array column value.
     * @param mixed $value
     *
     * @return $this The current object (for fluent API support)
     */
    public function addVolWorkTechnicId($value)
    {
        $currentArray = $this->getVolWorkTechnicIds();
        $currentArray []= $value;
        $this->setVolWorkTechnicIds($currentArray);

        return $this;
    }

    /**
     * Removes a value from the [vol_work_technic_ids] array column value.
     * @param mixed $value
     *
     * @return $this The current object (for fluent API support)
     */
    public function removeVolWorkTechnicId($value)
    {
        $targetArray = [];
        foreach ($this->getVolWorkTechnicIds() as $element) {
            if ($element != $value) {
                $targetArray []= $element;
            }
        }
        $this->setVolWorkTechnicIds($targetArray);

        return $this;
    }

    /**
     * Set the value of [vol_work_technic_versions] column.
     *
     * @param array|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setVolWorkTechnicVersions($v)
    {
        if ($this->vol_work_technic_versions_unserialized !== $v) {
            $this->vol_work_technic_versions_unserialized = $v;
            $this->vol_work_technic_versions = '| ' . implode(' | ', $v) . ' |';
            $this->modifiedColumns[VolWorkVersionTableMap::COL_VOL_WORK_TECHNIC_VERSIONS] = true;
        }

        return $this;
    }

    /**
     * Adds a value to the [vol_work_technic_versions] array column value.
     * @param mixed $value
     *
     * @return $this The current object (for fluent API support)
     */
    public function addVolWorkTechnicVersion($value)
    {
        $currentArray = $this->getVolWorkTechnicVersions();
        $currentArray []= $value;
        $this->setVolWorkTechnicVersions($currentArray);

        return $this;
    }

    /**
     * Removes a value from the [vol_work_technic_versions] array column value.
     * @param mixed $value
     *
     * @return $this The current object (for fluent API support)
     */
    public function removeVolWorkTechnicVersion($value)
    {
        $targetArray = [];
        foreach ($this->getVolWorkTechnicVersions() as $element) {
            if ($element != $value) {
                $targetArray []= $element;
            }
        }
        $this->setVolWorkTechnicVersions($targetArray);

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : VolWorkVersionTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : VolWorkVersionTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : VolWorkVersionTableMap::translateFieldName('Price', TableMap::TYPE_PHPNAME, $indexType)];
            $this->price = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : VolWorkVersionTableMap::translateFieldName('IsAvailable', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_available = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : VolWorkVersionTableMap::translateFieldName('UnitId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->unit_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : VolWorkVersionTableMap::translateFieldName('Version', TableMap::TYPE_PHPNAME, $indexType)];
            $this->version = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : VolWorkVersionTableMap::translateFieldName('VersionCreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->version_created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : VolWorkVersionTableMap::translateFieldName('VersionCreatedBy', TableMap::TYPE_PHPNAME, $indexType)];
            $this->version_created_by = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : VolWorkVersionTableMap::translateFieldName('VersionComment', TableMap::TYPE_PHPNAME, $indexType)];
            $this->version_comment = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : VolWorkVersionTableMap::translateFieldName('ObjStageWorkIds', TableMap::TYPE_PHPNAME, $indexType)];
            $this->obj_stage_work_ids = $col;
            $this->obj_stage_work_ids_unserialized = null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : VolWorkVersionTableMap::translateFieldName('ObjStageWorkVersions', TableMap::TYPE_PHPNAME, $indexType)];
            $this->obj_stage_work_versions = $col;
            $this->obj_stage_work_versions_unserialized = null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : VolWorkVersionTableMap::translateFieldName('VolWorkMaterialIds', TableMap::TYPE_PHPNAME, $indexType)];
            $this->vol_work_material_ids = $col;
            $this->vol_work_material_ids_unserialized = null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : VolWorkVersionTableMap::translateFieldName('VolWorkMaterialVersions', TableMap::TYPE_PHPNAME, $indexType)];
            $this->vol_work_material_versions = $col;
            $this->vol_work_material_versions_unserialized = null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : VolWorkVersionTableMap::translateFieldName('VolWorkTechnicIds', TableMap::TYPE_PHPNAME, $indexType)];
            $this->vol_work_technic_ids = $col;
            $this->vol_work_technic_ids_unserialized = null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : VolWorkVersionTableMap::translateFieldName('VolWorkTechnicVersions', TableMap::TYPE_PHPNAME, $indexType)];
            $this->vol_work_technic_versions = $col;
            $this->vol_work_technic_versions_unserialized = null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 15; // 15 = VolWorkVersionTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\DB\\VolWorkVersion'), 0, $e);
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
        if ($this->aVolWork !== null && $this->id !== $this->aVolWork->getId()) {
            $this->aVolWork = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(VolWorkVersionTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildVolWorkVersionQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aVolWork = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see VolWorkVersion::setDeleted()
     * @see VolWorkVersion::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(VolWorkVersionTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildVolWorkVersionQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(VolWorkVersionTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
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
                VolWorkVersionTableMap::addInstanceToPool($this);
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

            if ($this->aVolWork !== null) {
                if ($this->aVolWork->isModified() || $this->aVolWork->isNew()) {
                    $affectedRows += $this->aVolWork->save($con);
                }
                $this->setVolWork($this->aVolWork);
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


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(VolWorkVersionTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(VolWorkVersionTableMap::COL_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'name';
        }
        if ($this->isColumnModified(VolWorkVersionTableMap::COL_PRICE)) {
            $modifiedColumns[':p' . $index++]  = 'price';
        }
        if ($this->isColumnModified(VolWorkVersionTableMap::COL_IS_AVAILABLE)) {
            $modifiedColumns[':p' . $index++]  = 'is_available';
        }
        if ($this->isColumnModified(VolWorkVersionTableMap::COL_UNIT_ID)) {
            $modifiedColumns[':p' . $index++]  = 'unit_id';
        }
        if ($this->isColumnModified(VolWorkVersionTableMap::COL_VERSION)) {
            $modifiedColumns[':p' . $index++]  = 'version';
        }
        if ($this->isColumnModified(VolWorkVersionTableMap::COL_VERSION_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'version_created_at';
        }
        if ($this->isColumnModified(VolWorkVersionTableMap::COL_VERSION_CREATED_BY)) {
            $modifiedColumns[':p' . $index++]  = 'version_created_by';
        }
        if ($this->isColumnModified(VolWorkVersionTableMap::COL_VERSION_COMMENT)) {
            $modifiedColumns[':p' . $index++]  = 'version_comment';
        }
        if ($this->isColumnModified(VolWorkVersionTableMap::COL_OBJ_STAGE_WORK_IDS)) {
            $modifiedColumns[':p' . $index++]  = 'obj_stage_work_ids';
        }
        if ($this->isColumnModified(VolWorkVersionTableMap::COL_OBJ_STAGE_WORK_VERSIONS)) {
            $modifiedColumns[':p' . $index++]  = 'obj_stage_work_versions';
        }
        if ($this->isColumnModified(VolWorkVersionTableMap::COL_VOL_WORK_MATERIAL_IDS)) {
            $modifiedColumns[':p' . $index++]  = 'vol_work_material_ids';
        }
        if ($this->isColumnModified(VolWorkVersionTableMap::COL_VOL_WORK_MATERIAL_VERSIONS)) {
            $modifiedColumns[':p' . $index++]  = 'vol_work_material_versions';
        }
        if ($this->isColumnModified(VolWorkVersionTableMap::COL_VOL_WORK_TECHNIC_IDS)) {
            $modifiedColumns[':p' . $index++]  = 'vol_work_technic_ids';
        }
        if ($this->isColumnModified(VolWorkVersionTableMap::COL_VOL_WORK_TECHNIC_VERSIONS)) {
            $modifiedColumns[':p' . $index++]  = 'vol_work_technic_versions';
        }

        $sql = sprintf(
            'INSERT INTO vol_work_version (%s) VALUES (%s)',
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
                    case 'obj_stage_work_ids':
                        $stmt->bindValue($identifier, $this->obj_stage_work_ids, PDO::PARAM_STR);
                        break;
                    case 'obj_stage_work_versions':
                        $stmt->bindValue($identifier, $this->obj_stage_work_versions, PDO::PARAM_STR);
                        break;
                    case 'vol_work_material_ids':
                        $stmt->bindValue($identifier, $this->vol_work_material_ids, PDO::PARAM_STR);
                        break;
                    case 'vol_work_material_versions':
                        $stmt->bindValue($identifier, $this->vol_work_material_versions, PDO::PARAM_STR);
                        break;
                    case 'vol_work_technic_ids':
                        $stmt->bindValue($identifier, $this->vol_work_technic_ids, PDO::PARAM_STR);
                        break;
                    case 'vol_work_technic_versions':
                        $stmt->bindValue($identifier, $this->vol_work_technic_versions, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

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
        $pos = VolWorkVersionTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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

            case 9:
                return $this->getObjStageWorkIds();

            case 10:
                return $this->getObjStageWorkVersions();

            case 11:
                return $this->getVolWorkMaterialIds();

            case 12:
                return $this->getVolWorkMaterialVersions();

            case 13:
                return $this->getVolWorkTechnicIds();

            case 14:
                return $this->getVolWorkTechnicVersions();

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
        if (isset($alreadyDumpedObjects['VolWorkVersion'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['VolWorkVersion'][$this->hashCode()] = true;
        $keys = VolWorkVersionTableMap::getFieldNames($keyType);
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
            $keys[9] => $this->getObjStageWorkIds(),
            $keys[10] => $this->getObjStageWorkVersions(),
            $keys[11] => $this->getVolWorkMaterialIds(),
            $keys[12] => $this->getVolWorkMaterialVersions(),
            $keys[13] => $this->getVolWorkTechnicIds(),
            $keys[14] => $this->getVolWorkTechnicVersions(),
        ];
        if ($result[$keys[6]] instanceof \DateTimeInterface) {
            $result[$keys[6]] = $result[$keys[6]]->format('Y-m-d H:i:s.u');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
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
        $pos = VolWorkVersionTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
            case 9:
                if (!is_array($value)) {
                    $v = trim(substr($value, 2, -2));
                    $value = $v ? explode(' | ', $v) : array();
                }
                $this->setObjStageWorkIds($value);
                break;
            case 10:
                if (!is_array($value)) {
                    $v = trim(substr($value, 2, -2));
                    $value = $v ? explode(' | ', $v) : array();
                }
                $this->setObjStageWorkVersions($value);
                break;
            case 11:
                if (!is_array($value)) {
                    $v = trim(substr($value, 2, -2));
                    $value = $v ? explode(' | ', $v) : array();
                }
                $this->setVolWorkMaterialIds($value);
                break;
            case 12:
                if (!is_array($value)) {
                    $v = trim(substr($value, 2, -2));
                    $value = $v ? explode(' | ', $v) : array();
                }
                $this->setVolWorkMaterialVersions($value);
                break;
            case 13:
                if (!is_array($value)) {
                    $v = trim(substr($value, 2, -2));
                    $value = $v ? explode(' | ', $v) : array();
                }
                $this->setVolWorkTechnicIds($value);
                break;
            case 14:
                if (!is_array($value)) {
                    $v = trim(substr($value, 2, -2));
                    $value = $v ? explode(' | ', $v) : array();
                }
                $this->setVolWorkTechnicVersions($value);
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
        $keys = VolWorkVersionTableMap::getFieldNames($keyType);

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
        if (array_key_exists($keys[9], $arr)) {
            $this->setObjStageWorkIds($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setObjStageWorkVersions($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setVolWorkMaterialIds($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setVolWorkMaterialVersions($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setVolWorkTechnicIds($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setVolWorkTechnicVersions($arr[$keys[14]]);
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
        $criteria = new Criteria(VolWorkVersionTableMap::DATABASE_NAME);

        if ($this->isColumnModified(VolWorkVersionTableMap::COL_ID)) {
            $criteria->add(VolWorkVersionTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(VolWorkVersionTableMap::COL_NAME)) {
            $criteria->add(VolWorkVersionTableMap::COL_NAME, $this->name);
        }
        if ($this->isColumnModified(VolWorkVersionTableMap::COL_PRICE)) {
            $criteria->add(VolWorkVersionTableMap::COL_PRICE, $this->price);
        }
        if ($this->isColumnModified(VolWorkVersionTableMap::COL_IS_AVAILABLE)) {
            $criteria->add(VolWorkVersionTableMap::COL_IS_AVAILABLE, $this->is_available);
        }
        if ($this->isColumnModified(VolWorkVersionTableMap::COL_UNIT_ID)) {
            $criteria->add(VolWorkVersionTableMap::COL_UNIT_ID, $this->unit_id);
        }
        if ($this->isColumnModified(VolWorkVersionTableMap::COL_VERSION)) {
            $criteria->add(VolWorkVersionTableMap::COL_VERSION, $this->version);
        }
        if ($this->isColumnModified(VolWorkVersionTableMap::COL_VERSION_CREATED_AT)) {
            $criteria->add(VolWorkVersionTableMap::COL_VERSION_CREATED_AT, $this->version_created_at);
        }
        if ($this->isColumnModified(VolWorkVersionTableMap::COL_VERSION_CREATED_BY)) {
            $criteria->add(VolWorkVersionTableMap::COL_VERSION_CREATED_BY, $this->version_created_by);
        }
        if ($this->isColumnModified(VolWorkVersionTableMap::COL_VERSION_COMMENT)) {
            $criteria->add(VolWorkVersionTableMap::COL_VERSION_COMMENT, $this->version_comment);
        }
        if ($this->isColumnModified(VolWorkVersionTableMap::COL_OBJ_STAGE_WORK_IDS)) {
            $criteria->add(VolWorkVersionTableMap::COL_OBJ_STAGE_WORK_IDS, $this->obj_stage_work_ids);
        }
        if ($this->isColumnModified(VolWorkVersionTableMap::COL_OBJ_STAGE_WORK_VERSIONS)) {
            $criteria->add(VolWorkVersionTableMap::COL_OBJ_STAGE_WORK_VERSIONS, $this->obj_stage_work_versions);
        }
        if ($this->isColumnModified(VolWorkVersionTableMap::COL_VOL_WORK_MATERIAL_IDS)) {
            $criteria->add(VolWorkVersionTableMap::COL_VOL_WORK_MATERIAL_IDS, $this->vol_work_material_ids);
        }
        if ($this->isColumnModified(VolWorkVersionTableMap::COL_VOL_WORK_MATERIAL_VERSIONS)) {
            $criteria->add(VolWorkVersionTableMap::COL_VOL_WORK_MATERIAL_VERSIONS, $this->vol_work_material_versions);
        }
        if ($this->isColumnModified(VolWorkVersionTableMap::COL_VOL_WORK_TECHNIC_IDS)) {
            $criteria->add(VolWorkVersionTableMap::COL_VOL_WORK_TECHNIC_IDS, $this->vol_work_technic_ids);
        }
        if ($this->isColumnModified(VolWorkVersionTableMap::COL_VOL_WORK_TECHNIC_VERSIONS)) {
            $criteria->add(VolWorkVersionTableMap::COL_VOL_WORK_TECHNIC_VERSIONS, $this->vol_work_technic_versions);
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
        $criteria = ChildVolWorkVersionQuery::create();
        $criteria->add(VolWorkVersionTableMap::COL_ID, $this->id);
        $criteria->add(VolWorkVersionTableMap::COL_VERSION, $this->version);

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
        $validPk = null !== $this->getId() &&
            null !== $this->getVersion();

        $validPrimaryKeyFKs = 1;
        $primaryKeyFKs = [];

        //relation vol_work_version_fk_b92c65 to table vol_work
        if ($this->aVolWork && $hash = spl_object_hash($this->aVolWork)) {
            $primaryKeyFKs[] = $hash;
        } else {
            $validPrimaryKeyFKs = false;
        }

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the composite primary key for this object.
     * The array elements will be in same order as specified in XML.
     * @return array
     */
    public function getPrimaryKey()
    {
        $pks = [];
        $pks[0] = $this->getId();
        $pks[1] = $this->getVersion();

        return $pks;
    }

    /**
     * Set the [composite] primary key.
     *
     * @param array $keys The elements of the composite key (order must match the order in XML file).
     * @return void
     */
    public function setPrimaryKey(array $keys): void
    {
        $this->setId($keys[0]);
        $this->setVersion($keys[1]);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return (null === $this->getId()) && (null === $this->getVersion());
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \DB\VolWorkVersion (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setId($this->getId());
        $copyObj->setName($this->getName());
        $copyObj->setPrice($this->getPrice());
        $copyObj->setIsAvailable($this->getIsAvailable());
        $copyObj->setUnitId($this->getUnitId());
        $copyObj->setVersion($this->getVersion());
        $copyObj->setVersionCreatedAt($this->getVersionCreatedAt());
        $copyObj->setVersionCreatedBy($this->getVersionCreatedBy());
        $copyObj->setVersionComment($this->getVersionComment());
        $copyObj->setObjStageWorkIds($this->getObjStageWorkIds());
        $copyObj->setObjStageWorkVersions($this->getObjStageWorkVersions());
        $copyObj->setVolWorkMaterialIds($this->getVolWorkMaterialIds());
        $copyObj->setVolWorkMaterialVersions($this->getVolWorkMaterialVersions());
        $copyObj->setVolWorkTechnicIds($this->getVolWorkTechnicIds());
        $copyObj->setVolWorkTechnicVersions($this->getVolWorkTechnicVersions());
        if ($makeNew) {
            $copyObj->setNew(true);
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
     * @return \DB\VolWorkVersion Clone of current object.
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
     * Declares an association between this object and a ChildVolWork object.
     *
     * @param ChildVolWork $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setVolWork(ChildVolWork $v = null)
    {
        if ($v === null) {
            $this->setId(NULL);
        } else {
            $this->setId($v->getId());
        }

        $this->aVolWork = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildVolWork object, it will not be re-added.
        if ($v !== null) {
            $v->addVolWorkVersion($this);
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
        if ($this->aVolWork === null && ($this->id != 0)) {
            $this->aVolWork = ChildVolWorkQuery::create()->findPk($this->id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aVolWork->addVolWorkVersions($this);
             */
        }

        return $this->aVolWork;
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
        if (null !== $this->aVolWork) {
            $this->aVolWork->removeVolWorkVersion($this);
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
        $this->obj_stage_work_ids = null;
        $this->obj_stage_work_ids_unserialized = null;
        $this->obj_stage_work_versions = null;
        $this->obj_stage_work_versions_unserialized = null;
        $this->vol_work_material_ids = null;
        $this->vol_work_material_ids_unserialized = null;
        $this->vol_work_material_versions = null;
        $this->vol_work_material_versions_unserialized = null;
        $this->vol_work_technic_ids = null;
        $this->vol_work_technic_ids_unserialized = null;
        $this->vol_work_technic_versions = null;
        $this->vol_work_technic_versions_unserialized = null;
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
        } // if ($deep)

        $this->aVolWork = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(VolWorkVersionTableMap::DEFAULT_STRING_FORMAT);
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
