<?php

namespace DB\Base;

use \Exception;
use \PDO;
use DB\StageTechnic as ChildStageTechnic;
use DB\StageTechnicQuery as ChildStageTechnicQuery;
use DB\Technic as ChildTechnic;
use DB\TechnicQuery as ChildTechnicQuery;
use DB\Unit as ChildUnit;
use DB\UnitQuery as ChildUnitQuery;
use DB\WorkTechnic as ChildWorkTechnic;
use DB\WorkTechnicQuery as ChildWorkTechnicQuery;
use DB\Map\StageTechnicTableMap;
use DB\Map\TechnicTableMap;
use DB\Map\WorkTechnicTableMap;
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

/**
 * Base class that represents a row from the 'technic' table.
 *
 *
 *
 * @package    propel.generator.DB.Base
 */
abstract class Technic implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\DB\\Map\\TechnicTableMap';


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
     * ID техники
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
     * ID ед.измерения
     * @var        int
     */
    protected $unit_id;

    /**
     * @var        ChildUnit
     */
    protected $aUnit;

    /**
     * @var        ObjectCollection|ChildStageTechnic[] Collection to store aggregation of ChildStageTechnic objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildStageTechnic> Collection to store aggregation of ChildStageTechnic objects.
     */
    protected $collStageTechnics;
    protected $collStageTechnicsPartial;

    /**
     * @var        ObjectCollection|ChildWorkTechnic[] Collection to store aggregation of ChildWorkTechnic objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildWorkTechnic> Collection to store aggregation of ChildWorkTechnic objects.
     */
    protected $collWorkTechnics;
    protected $collWorkTechnicsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildStageTechnic[]
     * @phpstan-var ObjectCollection&\Traversable<ChildStageTechnic>
     */
    protected $stageTechnicsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildWorkTechnic[]
     * @phpstan-var ObjectCollection&\Traversable<ChildWorkTechnic>
     */
    protected $workTechnicsScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
        $this->is_available = true;
    }

    /**
     * Initializes internal state of DB\Base\Technic object.
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
     * Compares this with another <code>Technic</code> instance.  If
     * <code>obj</code> is an instance of <code>Technic</code>, delegates to
     * <code>equals(Technic)</code>.  Otherwise, returns <code>false</code>.
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
     * ID техники
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
     * ID ед.измерения
     * @return int
     */
    public function getUnitId()
    {
        return $this->unit_id;
    }

    /**
     * Set the value of [id] column.
     * ID техники
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
            $this->modifiedColumns[TechnicTableMap::COL_ID] = true;
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
            $this->modifiedColumns[TechnicTableMap::COL_NAME] = true;
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
            $this->modifiedColumns[TechnicTableMap::COL_PRICE] = true;
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
            $this->modifiedColumns[TechnicTableMap::COL_IS_AVAILABLE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [unit_id] column.
     * ID ед.измерения
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
            $this->modifiedColumns[TechnicTableMap::COL_UNIT_ID] = true;
        }

        if ($this->aUnit !== null && $this->aUnit->getId() !== $v) {
            $this->aUnit = null;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : TechnicTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : TechnicTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : TechnicTableMap::translateFieldName('Price', TableMap::TYPE_PHPNAME, $indexType)];
            $this->price = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : TechnicTableMap::translateFieldName('IsAvailable', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_available = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : TechnicTableMap::translateFieldName('UnitId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->unit_id = (null !== $col) ? (int) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 5; // 5 = TechnicTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\DB\\Technic'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(TechnicTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildTechnicQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aUnit = null;
            $this->collStageTechnics = null;

            $this->collWorkTechnics = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see Technic::setDeleted()
     * @see Technic::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(TechnicTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildTechnicQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(TechnicTableMap::DATABASE_NAME);
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
                TechnicTableMap::addInstanceToPool($this);
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

            if ($this->stageTechnicsScheduledForDeletion !== null) {
                if (!$this->stageTechnicsScheduledForDeletion->isEmpty()) {
                    \DB\StageTechnicQuery::create()
                        ->filterByPrimaryKeys($this->stageTechnicsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->stageTechnicsScheduledForDeletion = null;
                }
            }

            if ($this->collStageTechnics !== null) {
                foreach ($this->collStageTechnics as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->workTechnicsScheduledForDeletion !== null) {
                if (!$this->workTechnicsScheduledForDeletion->isEmpty()) {
                    \DB\WorkTechnicQuery::create()
                        ->filterByPrimaryKeys($this->workTechnicsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->workTechnicsScheduledForDeletion = null;
                }
            }

            if ($this->collWorkTechnics !== null) {
                foreach ($this->collWorkTechnics as $referrerFK) {
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

        $this->modifiedColumns[TechnicTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . TechnicTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(TechnicTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(TechnicTableMap::COL_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'name';
        }
        if ($this->isColumnModified(TechnicTableMap::COL_PRICE)) {
            $modifiedColumns[':p' . $index++]  = 'price';
        }
        if ($this->isColumnModified(TechnicTableMap::COL_IS_AVAILABLE)) {
            $modifiedColumns[':p' . $index++]  = 'is_available';
        }
        if ($this->isColumnModified(TechnicTableMap::COL_UNIT_ID)) {
            $modifiedColumns[':p' . $index++]  = 'unit_id';
        }

        $sql = sprintf(
            'INSERT INTO technic (%s) VALUES (%s)',
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
        $pos = TechnicTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
        if (isset($alreadyDumpedObjects['Technic'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['Technic'][$this->hashCode()] = true;
        $keys = TechnicTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getId(),
            $keys[1] => $this->getName(),
            $keys[2] => $this->getPrice(),
            $keys[3] => $this->getIsAvailable(),
            $keys[4] => $this->getUnitId(),
        ];
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
            if (null !== $this->collStageTechnics) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'stageTechnics';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'stage_technics';
                        break;
                    default:
                        $key = 'StageTechnics';
                }

                $result[$key] = $this->collStageTechnics->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collWorkTechnics) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'workTechnics';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'work_technics';
                        break;
                    default:
                        $key = 'WorkTechnics';
                }

                $result[$key] = $this->collWorkTechnics->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = TechnicTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
        $keys = TechnicTableMap::getFieldNames($keyType);

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
        $criteria = new Criteria(TechnicTableMap::DATABASE_NAME);

        if ($this->isColumnModified(TechnicTableMap::COL_ID)) {
            $criteria->add(TechnicTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(TechnicTableMap::COL_NAME)) {
            $criteria->add(TechnicTableMap::COL_NAME, $this->name);
        }
        if ($this->isColumnModified(TechnicTableMap::COL_PRICE)) {
            $criteria->add(TechnicTableMap::COL_PRICE, $this->price);
        }
        if ($this->isColumnModified(TechnicTableMap::COL_IS_AVAILABLE)) {
            $criteria->add(TechnicTableMap::COL_IS_AVAILABLE, $this->is_available);
        }
        if ($this->isColumnModified(TechnicTableMap::COL_UNIT_ID)) {
            $criteria->add(TechnicTableMap::COL_UNIT_ID, $this->unit_id);
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
        $criteria = ChildTechnicQuery::create();
        $criteria->add(TechnicTableMap::COL_ID, $this->id);

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
     * @param object $copyObj An object of \DB\Technic (or compatible) type.
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

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getStageTechnics() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addStageTechnic($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getWorkTechnics() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addWorkTechnic($relObj->copy($deepCopy));
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
     * @return \DB\Technic Clone of current object.
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
            $v->addTechnic($this);
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
                $this->aUnit->addTechnics($this);
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
        if ('StageTechnic' === $relationName) {
            $this->initStageTechnics();
            return;
        }
        if ('WorkTechnic' === $relationName) {
            $this->initWorkTechnics();
            return;
        }
    }

    /**
     * Clears out the collStageTechnics collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addStageTechnics()
     */
    public function clearStageTechnics()
    {
        $this->collStageTechnics = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collStageTechnics collection loaded partially.
     *
     * @return void
     */
    public function resetPartialStageTechnics($v = true): void
    {
        $this->collStageTechnicsPartial = $v;
    }

    /**
     * Initializes the collStageTechnics collection.
     *
     * By default this just sets the collStageTechnics collection to an empty array (like clearcollStageTechnics());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initStageTechnics(bool $overrideExisting = true): void
    {
        if (null !== $this->collStageTechnics && !$overrideExisting) {
            return;
        }

        $collectionClassName = StageTechnicTableMap::getTableMap()->getCollectionClassName();

        $this->collStageTechnics = new $collectionClassName;
        $this->collStageTechnics->setModel('\DB\StageTechnic');
    }

    /**
     * Gets an array of ChildStageTechnic objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildTechnic is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildStageTechnic[] List of ChildStageTechnic objects
     * @phpstan-return ObjectCollection&\Traversable<ChildStageTechnic> List of ChildStageTechnic objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getStageTechnics(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collStageTechnicsPartial && !$this->isNew();
        if (null === $this->collStageTechnics || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collStageTechnics) {
                    $this->initStageTechnics();
                } else {
                    $collectionClassName = StageTechnicTableMap::getTableMap()->getCollectionClassName();

                    $collStageTechnics = new $collectionClassName;
                    $collStageTechnics->setModel('\DB\StageTechnic');

                    return $collStageTechnics;
                }
            } else {
                $collStageTechnics = ChildStageTechnicQuery::create(null, $criteria)
                    ->filterByTechnic($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collStageTechnicsPartial && count($collStageTechnics)) {
                        $this->initStageTechnics(false);

                        foreach ($collStageTechnics as $obj) {
                            if (false == $this->collStageTechnics->contains($obj)) {
                                $this->collStageTechnics->append($obj);
                            }
                        }

                        $this->collStageTechnicsPartial = true;
                    }

                    return $collStageTechnics;
                }

                if ($partial && $this->collStageTechnics) {
                    foreach ($this->collStageTechnics as $obj) {
                        if ($obj->isNew()) {
                            $collStageTechnics[] = $obj;
                        }
                    }
                }

                $this->collStageTechnics = $collStageTechnics;
                $this->collStageTechnicsPartial = false;
            }
        }

        return $this->collStageTechnics;
    }

    /**
     * Sets a collection of ChildStageTechnic objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $stageTechnics A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setStageTechnics(Collection $stageTechnics, ?ConnectionInterface $con = null)
    {
        /** @var ChildStageTechnic[] $stageTechnicsToDelete */
        $stageTechnicsToDelete = $this->getStageTechnics(new Criteria(), $con)->diff($stageTechnics);


        $this->stageTechnicsScheduledForDeletion = $stageTechnicsToDelete;

        foreach ($stageTechnicsToDelete as $stageTechnicRemoved) {
            $stageTechnicRemoved->setTechnic(null);
        }

        $this->collStageTechnics = null;
        foreach ($stageTechnics as $stageTechnic) {
            $this->addStageTechnic($stageTechnic);
        }

        $this->collStageTechnics = $stageTechnics;
        $this->collStageTechnicsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related StageTechnic objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related StageTechnic objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countStageTechnics(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collStageTechnicsPartial && !$this->isNew();
        if (null === $this->collStageTechnics || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collStageTechnics) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getStageTechnics());
            }

            $query = ChildStageTechnicQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByTechnic($this)
                ->count($con);
        }

        return count($this->collStageTechnics);
    }

    /**
     * Method called to associate a ChildStageTechnic object to this object
     * through the ChildStageTechnic foreign key attribute.
     *
     * @param ChildStageTechnic $l ChildStageTechnic
     * @return $this The current object (for fluent API support)
     */
    public function addStageTechnic(ChildStageTechnic $l)
    {
        if ($this->collStageTechnics === null) {
            $this->initStageTechnics();
            $this->collStageTechnicsPartial = true;
        }

        if (!$this->collStageTechnics->contains($l)) {
            $this->doAddStageTechnic($l);

            if ($this->stageTechnicsScheduledForDeletion and $this->stageTechnicsScheduledForDeletion->contains($l)) {
                $this->stageTechnicsScheduledForDeletion->remove($this->stageTechnicsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildStageTechnic $stageTechnic The ChildStageTechnic object to add.
     */
    protected function doAddStageTechnic(ChildStageTechnic $stageTechnic): void
    {
        $this->collStageTechnics[]= $stageTechnic;
        $stageTechnic->setTechnic($this);
    }

    /**
     * @param ChildStageTechnic $stageTechnic The ChildStageTechnic object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeStageTechnic(ChildStageTechnic $stageTechnic)
    {
        if ($this->getStageTechnics()->contains($stageTechnic)) {
            $pos = $this->collStageTechnics->search($stageTechnic);
            $this->collStageTechnics->remove($pos);
            if (null === $this->stageTechnicsScheduledForDeletion) {
                $this->stageTechnicsScheduledForDeletion = clone $this->collStageTechnics;
                $this->stageTechnicsScheduledForDeletion->clear();
            }
            $this->stageTechnicsScheduledForDeletion[]= clone $stageTechnic;
            $stageTechnic->setTechnic(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Technic is new, it will return
     * an empty collection; or if this Technic has previously
     * been saved, it will retrieve related StageTechnics from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Technic.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildStageTechnic[] List of ChildStageTechnic objects
     * @phpstan-return ObjectCollection&\Traversable<ChildStageTechnic}> List of ChildStageTechnic objects
     */
    public function getStageTechnicsJoinStage(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildStageTechnicQuery::create(null, $criteria);
        $query->joinWith('Stage', $joinBehavior);

        return $this->getStageTechnics($query, $con);
    }

    /**
     * Clears out the collWorkTechnics collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addWorkTechnics()
     */
    public function clearWorkTechnics()
    {
        $this->collWorkTechnics = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collWorkTechnics collection loaded partially.
     *
     * @return void
     */
    public function resetPartialWorkTechnics($v = true): void
    {
        $this->collWorkTechnicsPartial = $v;
    }

    /**
     * Initializes the collWorkTechnics collection.
     *
     * By default this just sets the collWorkTechnics collection to an empty array (like clearcollWorkTechnics());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initWorkTechnics(bool $overrideExisting = true): void
    {
        if (null !== $this->collWorkTechnics && !$overrideExisting) {
            return;
        }

        $collectionClassName = WorkTechnicTableMap::getTableMap()->getCollectionClassName();

        $this->collWorkTechnics = new $collectionClassName;
        $this->collWorkTechnics->setModel('\DB\WorkTechnic');
    }

    /**
     * Gets an array of ChildWorkTechnic objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildTechnic is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildWorkTechnic[] List of ChildWorkTechnic objects
     * @phpstan-return ObjectCollection&\Traversable<ChildWorkTechnic> List of ChildWorkTechnic objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getWorkTechnics(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collWorkTechnicsPartial && !$this->isNew();
        if (null === $this->collWorkTechnics || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collWorkTechnics) {
                    $this->initWorkTechnics();
                } else {
                    $collectionClassName = WorkTechnicTableMap::getTableMap()->getCollectionClassName();

                    $collWorkTechnics = new $collectionClassName;
                    $collWorkTechnics->setModel('\DB\WorkTechnic');

                    return $collWorkTechnics;
                }
            } else {
                $collWorkTechnics = ChildWorkTechnicQuery::create(null, $criteria)
                    ->filterByTechnic($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collWorkTechnicsPartial && count($collWorkTechnics)) {
                        $this->initWorkTechnics(false);

                        foreach ($collWorkTechnics as $obj) {
                            if (false == $this->collWorkTechnics->contains($obj)) {
                                $this->collWorkTechnics->append($obj);
                            }
                        }

                        $this->collWorkTechnicsPartial = true;
                    }

                    return $collWorkTechnics;
                }

                if ($partial && $this->collWorkTechnics) {
                    foreach ($this->collWorkTechnics as $obj) {
                        if ($obj->isNew()) {
                            $collWorkTechnics[] = $obj;
                        }
                    }
                }

                $this->collWorkTechnics = $collWorkTechnics;
                $this->collWorkTechnicsPartial = false;
            }
        }

        return $this->collWorkTechnics;
    }

    /**
     * Sets a collection of ChildWorkTechnic objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $workTechnics A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setWorkTechnics(Collection $workTechnics, ?ConnectionInterface $con = null)
    {
        /** @var ChildWorkTechnic[] $workTechnicsToDelete */
        $workTechnicsToDelete = $this->getWorkTechnics(new Criteria(), $con)->diff($workTechnics);


        $this->workTechnicsScheduledForDeletion = $workTechnicsToDelete;

        foreach ($workTechnicsToDelete as $workTechnicRemoved) {
            $workTechnicRemoved->setTechnic(null);
        }

        $this->collWorkTechnics = null;
        foreach ($workTechnics as $workTechnic) {
            $this->addWorkTechnic($workTechnic);
        }

        $this->collWorkTechnics = $workTechnics;
        $this->collWorkTechnicsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related WorkTechnic objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related WorkTechnic objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countWorkTechnics(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collWorkTechnicsPartial && !$this->isNew();
        if (null === $this->collWorkTechnics || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collWorkTechnics) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getWorkTechnics());
            }

            $query = ChildWorkTechnicQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByTechnic($this)
                ->count($con);
        }

        return count($this->collWorkTechnics);
    }

    /**
     * Method called to associate a ChildWorkTechnic object to this object
     * through the ChildWorkTechnic foreign key attribute.
     *
     * @param ChildWorkTechnic $l ChildWorkTechnic
     * @return $this The current object (for fluent API support)
     */
    public function addWorkTechnic(ChildWorkTechnic $l)
    {
        if ($this->collWorkTechnics === null) {
            $this->initWorkTechnics();
            $this->collWorkTechnicsPartial = true;
        }

        if (!$this->collWorkTechnics->contains($l)) {
            $this->doAddWorkTechnic($l);

            if ($this->workTechnicsScheduledForDeletion and $this->workTechnicsScheduledForDeletion->contains($l)) {
                $this->workTechnicsScheduledForDeletion->remove($this->workTechnicsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildWorkTechnic $workTechnic The ChildWorkTechnic object to add.
     */
    protected function doAddWorkTechnic(ChildWorkTechnic $workTechnic): void
    {
        $this->collWorkTechnics[]= $workTechnic;
        $workTechnic->setTechnic($this);
    }

    /**
     * @param ChildWorkTechnic $workTechnic The ChildWorkTechnic object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeWorkTechnic(ChildWorkTechnic $workTechnic)
    {
        if ($this->getWorkTechnics()->contains($workTechnic)) {
            $pos = $this->collWorkTechnics->search($workTechnic);
            $this->collWorkTechnics->remove($pos);
            if (null === $this->workTechnicsScheduledForDeletion) {
                $this->workTechnicsScheduledForDeletion = clone $this->collWorkTechnics;
                $this->workTechnicsScheduledForDeletion->clear();
            }
            $this->workTechnicsScheduledForDeletion[]= clone $workTechnic;
            $workTechnic->setTechnic(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Technic is new, it will return
     * an empty collection; or if this Technic has previously
     * been saved, it will retrieve related WorkTechnics from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Technic.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildWorkTechnic[] List of ChildWorkTechnic objects
     * @phpstan-return ObjectCollection&\Traversable<ChildWorkTechnic}> List of ChildWorkTechnic objects
     */
    public function getWorkTechnicsJoinWork(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildWorkTechnicQuery::create(null, $criteria);
        $query->joinWith('Work', $joinBehavior);

        return $this->getWorkTechnics($query, $con);
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
            $this->aUnit->removeTechnic($this);
        }
        $this->id = null;
        $this->name = null;
        $this->price = null;
        $this->is_available = null;
        $this->unit_id = null;
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
            if ($this->collStageTechnics) {
                foreach ($this->collStageTechnics as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collWorkTechnics) {
                foreach ($this->collWorkTechnics as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collStageTechnics = null;
        $this->collWorkTechnics = null;
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
        return (string) $this->exportTo(TechnicTableMap::DEFAULT_STRING_FORMAT);
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
