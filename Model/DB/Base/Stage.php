<?php

namespace DB\Base;

use \Exception;
use \PDO;
use DB\House as ChildHouse;
use DB\HouseQuery as ChildHouseQuery;
use DB\Stage as ChildStage;
use DB\StageMaterial as ChildStageMaterial;
use DB\StageMaterialQuery as ChildStageMaterialQuery;
use DB\StageQuery as ChildStageQuery;
use DB\StageTechnic as ChildStageTechnic;
use DB\StageTechnicQuery as ChildStageTechnicQuery;
use DB\StageWork as ChildStageWork;
use DB\StageWorkQuery as ChildStageWorkQuery;
use DB\Map\StageMaterialTableMap;
use DB\Map\StageTableMap;
use DB\Map\StageTechnicTableMap;
use DB\Map\StageWorkTableMap;
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
 * Base class that represents a row from the 'stage' table.
 *
 *
 *
 * @package    propel.generator.DB.Base
 */
abstract class Stage implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\DB\\Map\\StageTableMap';


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
     * ID этап
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
     * 	Доступ (открытый, приватный)
     * Note: this column has a database default value of: true
     * @var        boolean
     */
    protected $is_available;

    /**
     * The value for the house_id field.
     * ID дома
     * @var        int|null
     */
    protected $house_id;

    /**
     * @var        ChildHouse
     */
    protected $aHouse;

    /**
     * @var        ObjectCollection|ChildStageMaterial[] Collection to store aggregation of ChildStageMaterial objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildStageMaterial> Collection to store aggregation of ChildStageMaterial objects.
     */
    protected $collStageMaterials;
    protected $collStageMaterialsPartial;

    /**
     * @var        ObjectCollection|ChildStageTechnic[] Collection to store aggregation of ChildStageTechnic objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildStageTechnic> Collection to store aggregation of ChildStageTechnic objects.
     */
    protected $collStageTechnics;
    protected $collStageTechnicsPartial;

    /**
     * @var        ObjectCollection|ChildStageWork[] Collection to store aggregation of ChildStageWork objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildStageWork> Collection to store aggregation of ChildStageWork objects.
     */
    protected $collStageWorks;
    protected $collStageWorksPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildStageMaterial[]
     * @phpstan-var ObjectCollection&\Traversable<ChildStageMaterial>
     */
    protected $stageMaterialsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildStageTechnic[]
     * @phpstan-var ObjectCollection&\Traversable<ChildStageTechnic>
     */
    protected $stageTechnicsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildStageWork[]
     * @phpstan-var ObjectCollection&\Traversable<ChildStageWork>
     */
    protected $stageWorksScheduledForDeletion = null;

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
    }

    /**
     * Initializes internal state of DB\Base\Stage object.
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
     * Compares this with another <code>Stage</code> instance.  If
     * <code>obj</code> is an instance of <code>Stage</code>, delegates to
     * <code>equals(Stage)</code>.  Otherwise, returns <code>false</code>.
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
     * ID этап
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
     * 	Доступ (открытый, приватный)
     * @return boolean
     */
    public function getIsAvailable()
    {
        return $this->is_available;
    }

    /**
     * Get the [is_available] column value.
     * 	Доступ (открытый, приватный)
     * @return boolean
     */
    public function isAvailable()
    {
        return $this->getIsAvailable();
    }

    /**
     * Get the [house_id] column value.
     * ID дома
     * @return int|null
     */
    public function getHouseId()
    {
        return $this->house_id;
    }

    /**
     * Set the value of [id] column.
     * ID этап
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
            $this->modifiedColumns[StageTableMap::COL_ID] = true;
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
            $this->modifiedColumns[StageTableMap::COL_NAME] = true;
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
            $this->modifiedColumns[StageTableMap::COL_STATUS] = true;
        }

        return $this;
    }

    /**
     * Sets the value of the [is_available] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * 	Доступ (открытый, приватный)
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
            $this->modifiedColumns[StageTableMap::COL_IS_AVAILABLE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [house_id] column.
     * ID дома
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setHouseId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->house_id !== $v) {
            $this->house_id = $v;
            $this->modifiedColumns[StageTableMap::COL_HOUSE_ID] = true;
        }

        if ($this->aHouse !== null && $this->aHouse->getId() !== $v) {
            $this->aHouse = null;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : StageTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : StageTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : StageTableMap::translateFieldName('Status', TableMap::TYPE_PHPNAME, $indexType)];
            $this->status = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : StageTableMap::translateFieldName('IsAvailable', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_available = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : StageTableMap::translateFieldName('HouseId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->house_id = (null !== $col) ? (int) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 5; // 5 = StageTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\DB\\Stage'), 0, $e);
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
        if ($this->aHouse !== null && $this->house_id !== $this->aHouse->getId()) {
            $this->aHouse = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(StageTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildStageQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aHouse = null;
            $this->collStageMaterials = null;

            $this->collStageTechnics = null;

            $this->collStageWorks = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see Stage::setDeleted()
     * @see Stage::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(StageTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildStageQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(StageTableMap::DATABASE_NAME);
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
                StageTableMap::addInstanceToPool($this);
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

            if ($this->aHouse !== null) {
                if ($this->aHouse->isModified() || $this->aHouse->isNew()) {
                    $affectedRows += $this->aHouse->save($con);
                }
                $this->setHouse($this->aHouse);
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

            if ($this->stageWorksScheduledForDeletion !== null) {
                if (!$this->stageWorksScheduledForDeletion->isEmpty()) {
                    \DB\StageWorkQuery::create()
                        ->filterByPrimaryKeys($this->stageWorksScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->stageWorksScheduledForDeletion = null;
                }
            }

            if ($this->collStageWorks !== null) {
                foreach ($this->collStageWorks as $referrerFK) {
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


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(StageTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(StageTableMap::COL_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'name';
        }
        if ($this->isColumnModified(StageTableMap::COL_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'status';
        }
        if ($this->isColumnModified(StageTableMap::COL_IS_AVAILABLE)) {
            $modifiedColumns[':p' . $index++]  = 'is_available';
        }
        if ($this->isColumnModified(StageTableMap::COL_HOUSE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'house_id';
        }

        $sql = sprintf(
            'INSERT INTO stage (%s) VALUES (%s)',
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
                    case 'house_id':
                        $stmt->bindValue($identifier, $this->house_id, PDO::PARAM_INT);
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
        $pos = StageTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getHouseId();

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
        if (isset($alreadyDumpedObjects['Stage'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['Stage'][$this->hashCode()] = true;
        $keys = StageTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getId(),
            $keys[1] => $this->getName(),
            $keys[2] => $this->getStatus(),
            $keys[3] => $this->getIsAvailable(),
            $keys[4] => $this->getHouseId(),
        ];
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aHouse) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'house';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'house';
                        break;
                    default:
                        $key = 'House';
                }

                $result[$key] = $this->aHouse->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
            if (null !== $this->collStageWorks) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'stageWorks';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'stage_works';
                        break;
                    default:
                        $key = 'StageWorks';
                }

                $result[$key] = $this->collStageWorks->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = StageTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setHouseId($value);
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
        $keys = StageTableMap::getFieldNames($keyType);

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
            $this->setHouseId($arr[$keys[4]]);
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
        $criteria = new Criteria(StageTableMap::DATABASE_NAME);

        if ($this->isColumnModified(StageTableMap::COL_ID)) {
            $criteria->add(StageTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(StageTableMap::COL_NAME)) {
            $criteria->add(StageTableMap::COL_NAME, $this->name);
        }
        if ($this->isColumnModified(StageTableMap::COL_STATUS)) {
            $criteria->add(StageTableMap::COL_STATUS, $this->status);
        }
        if ($this->isColumnModified(StageTableMap::COL_IS_AVAILABLE)) {
            $criteria->add(StageTableMap::COL_IS_AVAILABLE, $this->is_available);
        }
        if ($this->isColumnModified(StageTableMap::COL_HOUSE_ID)) {
            $criteria->add(StageTableMap::COL_HOUSE_ID, $this->house_id);
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
        $criteria = ChildStageQuery::create();
        $criteria->add(StageTableMap::COL_ID, $this->id);

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
     * @param object $copyObj An object of \DB\Stage (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setId($this->getId());
        $copyObj->setName($this->getName());
        $copyObj->setStatus($this->getStatus());
        $copyObj->setIsAvailable($this->getIsAvailable());
        $copyObj->setHouseId($this->getHouseId());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getStageMaterials() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addStageMaterial($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getStageTechnics() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addStageTechnic($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getStageWorks() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addStageWork($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

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
     * @return \DB\Stage Clone of current object.
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
     * Declares an association between this object and a ChildHouse object.
     *
     * @param ChildHouse|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setHouse(ChildHouse $v = null)
    {
        if ($v === null) {
            $this->setHouseId(NULL);
        } else {
            $this->setHouseId($v->getId());
        }

        $this->aHouse = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildHouse object, it will not be re-added.
        if ($v !== null) {
            $v->addStage($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildHouse object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildHouse|null The associated ChildHouse object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getHouse(?ConnectionInterface $con = null)
    {
        if ($this->aHouse === null && ($this->house_id != 0)) {
            $this->aHouse = ChildHouseQuery::create()->findPk($this->house_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aHouse->addStages($this);
             */
        }

        return $this->aHouse;
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
        if ('StageTechnic' === $relationName) {
            $this->initStageTechnics();
            return;
        }
        if ('StageWork' === $relationName) {
            $this->initStageWorks();
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
     * If this ChildStage is new, it will return
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
                    ->filterByStage($this)
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
            $stageMaterialRemoved->setStage(null);
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
                ->filterByStage($this)
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
        $stageMaterial->setStage($this);
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
            $stageMaterial->setStage(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Stage is new, it will return
     * an empty collection; or if this Stage has previously
     * been saved, it will retrieve related StageMaterials from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Stage.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildStageMaterial[] List of ChildStageMaterial objects
     * @phpstan-return ObjectCollection&\Traversable<ChildStageMaterial}> List of ChildStageMaterial objects
     */
    public function getStageMaterialsJoinMaterial(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildStageMaterialQuery::create(null, $criteria);
        $query->joinWith('Material', $joinBehavior);

        return $this->getStageMaterials($query, $con);
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
     * If this ChildStage is new, it will return
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
                    ->filterByStage($this)
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
            $stageTechnicRemoved->setStage(null);
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
                ->filterByStage($this)
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
        $stageTechnic->setStage($this);
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
            $stageTechnic->setStage(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Stage is new, it will return
     * an empty collection; or if this Stage has previously
     * been saved, it will retrieve related StageTechnics from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Stage.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildStageTechnic[] List of ChildStageTechnic objects
     * @phpstan-return ObjectCollection&\Traversable<ChildStageTechnic}> List of ChildStageTechnic objects
     */
    public function getStageTechnicsJoinTechnic(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildStageTechnicQuery::create(null, $criteria);
        $query->joinWith('Technic', $joinBehavior);

        return $this->getStageTechnics($query, $con);
    }

    /**
     * Clears out the collStageWorks collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addStageWorks()
     */
    public function clearStageWorks()
    {
        $this->collStageWorks = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collStageWorks collection loaded partially.
     *
     * @return void
     */
    public function resetPartialStageWorks($v = true): void
    {
        $this->collStageWorksPartial = $v;
    }

    /**
     * Initializes the collStageWorks collection.
     *
     * By default this just sets the collStageWorks collection to an empty array (like clearcollStageWorks());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initStageWorks(bool $overrideExisting = true): void
    {
        if (null !== $this->collStageWorks && !$overrideExisting) {
            return;
        }

        $collectionClassName = StageWorkTableMap::getTableMap()->getCollectionClassName();

        $this->collStageWorks = new $collectionClassName;
        $this->collStageWorks->setModel('\DB\StageWork');
    }

    /**
     * Gets an array of ChildStageWork objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildStage is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildStageWork[] List of ChildStageWork objects
     * @phpstan-return ObjectCollection&\Traversable<ChildStageWork> List of ChildStageWork objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getStageWorks(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collStageWorksPartial && !$this->isNew();
        if (null === $this->collStageWorks || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collStageWorks) {
                    $this->initStageWorks();
                } else {
                    $collectionClassName = StageWorkTableMap::getTableMap()->getCollectionClassName();

                    $collStageWorks = new $collectionClassName;
                    $collStageWorks->setModel('\DB\StageWork');

                    return $collStageWorks;
                }
            } else {
                $collStageWorks = ChildStageWorkQuery::create(null, $criteria)
                    ->filterByStage($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collStageWorksPartial && count($collStageWorks)) {
                        $this->initStageWorks(false);

                        foreach ($collStageWorks as $obj) {
                            if (false == $this->collStageWorks->contains($obj)) {
                                $this->collStageWorks->append($obj);
                            }
                        }

                        $this->collStageWorksPartial = true;
                    }

                    return $collStageWorks;
                }

                if ($partial && $this->collStageWorks) {
                    foreach ($this->collStageWorks as $obj) {
                        if ($obj->isNew()) {
                            $collStageWorks[] = $obj;
                        }
                    }
                }

                $this->collStageWorks = $collStageWorks;
                $this->collStageWorksPartial = false;
            }
        }

        return $this->collStageWorks;
    }

    /**
     * Sets a collection of ChildStageWork objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $stageWorks A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setStageWorks(Collection $stageWorks, ?ConnectionInterface $con = null)
    {
        /** @var ChildStageWork[] $stageWorksToDelete */
        $stageWorksToDelete = $this->getStageWorks(new Criteria(), $con)->diff($stageWorks);


        $this->stageWorksScheduledForDeletion = $stageWorksToDelete;

        foreach ($stageWorksToDelete as $stageWorkRemoved) {
            $stageWorkRemoved->setStage(null);
        }

        $this->collStageWorks = null;
        foreach ($stageWorks as $stageWork) {
            $this->addStageWork($stageWork);
        }

        $this->collStageWorks = $stageWorks;
        $this->collStageWorksPartial = false;

        return $this;
    }

    /**
     * Returns the number of related StageWork objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related StageWork objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countStageWorks(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collStageWorksPartial && !$this->isNew();
        if (null === $this->collStageWorks || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collStageWorks) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getStageWorks());
            }

            $query = ChildStageWorkQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByStage($this)
                ->count($con);
        }

        return count($this->collStageWorks);
    }

    /**
     * Method called to associate a ChildStageWork object to this object
     * through the ChildStageWork foreign key attribute.
     *
     * @param ChildStageWork $l ChildStageWork
     * @return $this The current object (for fluent API support)
     */
    public function addStageWork(ChildStageWork $l)
    {
        if ($this->collStageWorks === null) {
            $this->initStageWorks();
            $this->collStageWorksPartial = true;
        }

        if (!$this->collStageWorks->contains($l)) {
            $this->doAddStageWork($l);

            if ($this->stageWorksScheduledForDeletion and $this->stageWorksScheduledForDeletion->contains($l)) {
                $this->stageWorksScheduledForDeletion->remove($this->stageWorksScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildStageWork $stageWork The ChildStageWork object to add.
     */
    protected function doAddStageWork(ChildStageWork $stageWork): void
    {
        $this->collStageWorks[]= $stageWork;
        $stageWork->setStage($this);
    }

    /**
     * @param ChildStageWork $stageWork The ChildStageWork object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeStageWork(ChildStageWork $stageWork)
    {
        if ($this->getStageWorks()->contains($stageWork)) {
            $pos = $this->collStageWorks->search($stageWork);
            $this->collStageWorks->remove($pos);
            if (null === $this->stageWorksScheduledForDeletion) {
                $this->stageWorksScheduledForDeletion = clone $this->collStageWorks;
                $this->stageWorksScheduledForDeletion->clear();
            }
            $this->stageWorksScheduledForDeletion[]= clone $stageWork;
            $stageWork->setStage(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Stage is new, it will return
     * an empty collection; or if this Stage has previously
     * been saved, it will retrieve related StageWorks from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Stage.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildStageWork[] List of ChildStageWork objects
     * @phpstan-return ObjectCollection&\Traversable<ChildStageWork}> List of ChildStageWork objects
     */
    public function getStageWorksJoinWork(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildStageWorkQuery::create(null, $criteria);
        $query->joinWith('Work', $joinBehavior);

        return $this->getStageWorks($query, $con);
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
        if (null !== $this->aHouse) {
            $this->aHouse->removeStage($this);
        }
        $this->id = null;
        $this->name = null;
        $this->status = null;
        $this->is_available = null;
        $this->house_id = null;
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
            if ($this->collStageTechnics) {
                foreach ($this->collStageTechnics as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collStageWorks) {
                foreach ($this->collStageWorks as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collStageMaterials = null;
        $this->collStageTechnics = null;
        $this->collStageWorks = null;
        $this->aHouse = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(StageTableMap::DEFAULT_STRING_FORMAT);
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
