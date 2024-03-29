<?php

namespace DB\Base;

use \Exception;
use \PDO;
use DB\VolMaterial as ChildVolMaterial;
use DB\VolMaterialQuery as ChildVolMaterialQuery;
use DB\VolTechnic as ChildVolTechnic;
use DB\VolTechnicQuery as ChildVolTechnicQuery;
use DB\VolUnit as ChildVolUnit;
use DB\VolUnitQuery as ChildVolUnitQuery;
use DB\VolWork as ChildVolWork;
use DB\VolWorkQuery as ChildVolWorkQuery;
use DB\Map\VolMaterialTableMap;
use DB\Map\VolTechnicTableMap;
use DB\Map\VolUnitTableMap;
use DB\Map\VolWorkTableMap;
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
 * Base class that represents a row from the 'vol_unit' table.
 *
 *
 *
 * @package    propel.generator.DB.Base
 */
abstract class VolUnit implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\DB\\Map\\VolUnitTableMap';


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
     * ID ед. измерения
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
     * @var        ObjectCollection|ChildVolMaterial[] Collection to store aggregation of ChildVolMaterial objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildVolMaterial> Collection to store aggregation of ChildVolMaterial objects.
     */
    protected $collVolMaterials;
    protected $collVolMaterialsPartial;

    /**
     * @var        ObjectCollection|ChildVolTechnic[] Collection to store aggregation of ChildVolTechnic objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildVolTechnic> Collection to store aggregation of ChildVolTechnic objects.
     */
    protected $collVolTechnics;
    protected $collVolTechnicsPartial;

    /**
     * @var        ObjectCollection|ChildVolWork[] Collection to store aggregation of ChildVolWork objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildVolWork> Collection to store aggregation of ChildVolWork objects.
     */
    protected $collVolWorks;
    protected $collVolWorksPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildVolMaterial[]
     * @phpstan-var ObjectCollection&\Traversable<ChildVolMaterial>
     */
    protected $volMaterialsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildVolTechnic[]
     * @phpstan-var ObjectCollection&\Traversable<ChildVolTechnic>
     */
    protected $volTechnicsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildVolWork[]
     * @phpstan-var ObjectCollection&\Traversable<ChildVolWork>
     */
    protected $volWorksScheduledForDeletion = null;

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
     * Initializes internal state of DB\Base\VolUnit object.
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
     * Compares this with another <code>VolUnit</code> instance.  If
     * <code>obj</code> is an instance of <code>VolUnit</code>, delegates to
     * <code>equals(VolUnit)</code>.  Otherwise, returns <code>false</code>.
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
     * ID ед. измерения
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
     * Set the value of [id] column.
     * ID ед. измерения
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
            $this->modifiedColumns[VolUnitTableMap::COL_ID] = true;
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
            $this->modifiedColumns[VolUnitTableMap::COL_NAME] = true;
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
            $this->modifiedColumns[VolUnitTableMap::COL_IS_AVAILABLE] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : VolUnitTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : VolUnitTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : VolUnitTableMap::translateFieldName('IsAvailable', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_available = (null !== $col) ? (boolean) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 3; // 3 = VolUnitTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\DB\\VolUnit'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(VolUnitTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildVolUnitQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collVolMaterials = null;

            $this->collVolTechnics = null;

            $this->collVolWorks = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see VolUnit::setDeleted()
     * @see VolUnit::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(VolUnitTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildVolUnitQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(VolUnitTableMap::DATABASE_NAME);
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
                VolUnitTableMap::addInstanceToPool($this);
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

            if ($this->volMaterialsScheduledForDeletion !== null) {
                if (!$this->volMaterialsScheduledForDeletion->isEmpty()) {
                    \DB\VolMaterialQuery::create()
                        ->filterByPrimaryKeys($this->volMaterialsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->volMaterialsScheduledForDeletion = null;
                }
            }

            if ($this->collVolMaterials !== null) {
                foreach ($this->collVolMaterials as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->volTechnicsScheduledForDeletion !== null) {
                if (!$this->volTechnicsScheduledForDeletion->isEmpty()) {
                    \DB\VolTechnicQuery::create()
                        ->filterByPrimaryKeys($this->volTechnicsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->volTechnicsScheduledForDeletion = null;
                }
            }

            if ($this->collVolTechnics !== null) {
                foreach ($this->collVolTechnics as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->volWorksScheduledForDeletion !== null) {
                if (!$this->volWorksScheduledForDeletion->isEmpty()) {
                    \DB\VolWorkQuery::create()
                        ->filterByPrimaryKeys($this->volWorksScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->volWorksScheduledForDeletion = null;
                }
            }

            if ($this->collVolWorks !== null) {
                foreach ($this->collVolWorks as $referrerFK) {
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

        $this->modifiedColumns[VolUnitTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . VolUnitTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(VolUnitTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(VolUnitTableMap::COL_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'name';
        }
        if ($this->isColumnModified(VolUnitTableMap::COL_IS_AVAILABLE)) {
            $modifiedColumns[':p' . $index++]  = 'is_available';
        }

        $sql = sprintf(
            'INSERT INTO vol_unit (%s) VALUES (%s)',
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
        $pos = VolUnitTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
        if (isset($alreadyDumpedObjects['VolUnit'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['VolUnit'][$this->hashCode()] = true;
        $keys = VolUnitTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getId(),
            $keys[1] => $this->getName(),
            $keys[2] => $this->getIsAvailable(),
        ];
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collVolMaterials) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'volMaterials';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'vol_materials';
                        break;
                    default:
                        $key = 'VolMaterials';
                }

                $result[$key] = $this->collVolMaterials->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collVolTechnics) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'volTechnics';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'vol_technics';
                        break;
                    default:
                        $key = 'VolTechnics';
                }

                $result[$key] = $this->collVolTechnics->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collVolWorks) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'volWorks';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'vol_works';
                        break;
                    default:
                        $key = 'VolWorks';
                }

                $result[$key] = $this->collVolWorks->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = VolUnitTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
        $keys = VolUnitTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setName($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setIsAvailable($arr[$keys[2]]);
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
        $criteria = new Criteria(VolUnitTableMap::DATABASE_NAME);

        if ($this->isColumnModified(VolUnitTableMap::COL_ID)) {
            $criteria->add(VolUnitTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(VolUnitTableMap::COL_NAME)) {
            $criteria->add(VolUnitTableMap::COL_NAME, $this->name);
        }
        if ($this->isColumnModified(VolUnitTableMap::COL_IS_AVAILABLE)) {
            $criteria->add(VolUnitTableMap::COL_IS_AVAILABLE, $this->is_available);
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
        $criteria = ChildVolUnitQuery::create();
        $criteria->add(VolUnitTableMap::COL_ID, $this->id);

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
     * @param object $copyObj An object of \DB\VolUnit (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setName($this->getName());
        $copyObj->setIsAvailable($this->getIsAvailable());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getVolMaterials() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addVolMaterial($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getVolTechnics() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addVolTechnic($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getVolWorks() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addVolWork($relObj->copy($deepCopy));
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
     * @return \DB\VolUnit Clone of current object.
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
        if ('VolMaterial' === $relationName) {
            $this->initVolMaterials();
            return;
        }
        if ('VolTechnic' === $relationName) {
            $this->initVolTechnics();
            return;
        }
        if ('VolWork' === $relationName) {
            $this->initVolWorks();
            return;
        }
    }

    /**
     * Clears out the collVolMaterials collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addVolMaterials()
     */
    public function clearVolMaterials()
    {
        $this->collVolMaterials = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collVolMaterials collection loaded partially.
     *
     * @return void
     */
    public function resetPartialVolMaterials($v = true): void
    {
        $this->collVolMaterialsPartial = $v;
    }

    /**
     * Initializes the collVolMaterials collection.
     *
     * By default this just sets the collVolMaterials collection to an empty array (like clearcollVolMaterials());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initVolMaterials(bool $overrideExisting = true): void
    {
        if (null !== $this->collVolMaterials && !$overrideExisting) {
            return;
        }

        $collectionClassName = VolMaterialTableMap::getTableMap()->getCollectionClassName();

        $this->collVolMaterials = new $collectionClassName;
        $this->collVolMaterials->setModel('\DB\VolMaterial');
    }

    /**
     * Gets an array of ChildVolMaterial objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildVolUnit is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildVolMaterial[] List of ChildVolMaterial objects
     * @phpstan-return ObjectCollection&\Traversable<ChildVolMaterial> List of ChildVolMaterial objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getVolMaterials(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collVolMaterialsPartial && !$this->isNew();
        if (null === $this->collVolMaterials || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collVolMaterials) {
                    $this->initVolMaterials();
                } else {
                    $collectionClassName = VolMaterialTableMap::getTableMap()->getCollectionClassName();

                    $collVolMaterials = new $collectionClassName;
                    $collVolMaterials->setModel('\DB\VolMaterial');

                    return $collVolMaterials;
                }
            } else {
                $collVolMaterials = ChildVolMaterialQuery::create(null, $criteria)
                    ->filterByVolUnit($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collVolMaterialsPartial && count($collVolMaterials)) {
                        $this->initVolMaterials(false);

                        foreach ($collVolMaterials as $obj) {
                            if (false == $this->collVolMaterials->contains($obj)) {
                                $this->collVolMaterials->append($obj);
                            }
                        }

                        $this->collVolMaterialsPartial = true;
                    }

                    return $collVolMaterials;
                }

                if ($partial && $this->collVolMaterials) {
                    foreach ($this->collVolMaterials as $obj) {
                        if ($obj->isNew()) {
                            $collVolMaterials[] = $obj;
                        }
                    }
                }

                $this->collVolMaterials = $collVolMaterials;
                $this->collVolMaterialsPartial = false;
            }
        }

        return $this->collVolMaterials;
    }

    /**
     * Sets a collection of ChildVolMaterial objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $volMaterials A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setVolMaterials(Collection $volMaterials, ?ConnectionInterface $con = null)
    {
        /** @var ChildVolMaterial[] $volMaterialsToDelete */
        $volMaterialsToDelete = $this->getVolMaterials(new Criteria(), $con)->diff($volMaterials);


        $this->volMaterialsScheduledForDeletion = $volMaterialsToDelete;

        foreach ($volMaterialsToDelete as $volMaterialRemoved) {
            $volMaterialRemoved->setVolUnit(null);
        }

        $this->collVolMaterials = null;
        foreach ($volMaterials as $volMaterial) {
            $this->addVolMaterial($volMaterial);
        }

        $this->collVolMaterials = $volMaterials;
        $this->collVolMaterialsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related VolMaterial objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related VolMaterial objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countVolMaterials(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collVolMaterialsPartial && !$this->isNew();
        if (null === $this->collVolMaterials || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collVolMaterials) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getVolMaterials());
            }

            $query = ChildVolMaterialQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByVolUnit($this)
                ->count($con);
        }

        return count($this->collVolMaterials);
    }

    /**
     * Method called to associate a ChildVolMaterial object to this object
     * through the ChildVolMaterial foreign key attribute.
     *
     * @param ChildVolMaterial $l ChildVolMaterial
     * @return $this The current object (for fluent API support)
     */
    public function addVolMaterial(ChildVolMaterial $l)
    {
        if ($this->collVolMaterials === null) {
            $this->initVolMaterials();
            $this->collVolMaterialsPartial = true;
        }

        if (!$this->collVolMaterials->contains($l)) {
            $this->doAddVolMaterial($l);

            if ($this->volMaterialsScheduledForDeletion and $this->volMaterialsScheduledForDeletion->contains($l)) {
                $this->volMaterialsScheduledForDeletion->remove($this->volMaterialsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildVolMaterial $volMaterial The ChildVolMaterial object to add.
     */
    protected function doAddVolMaterial(ChildVolMaterial $volMaterial): void
    {
        $this->collVolMaterials[]= $volMaterial;
        $volMaterial->setVolUnit($this);
    }

    /**
     * @param ChildVolMaterial $volMaterial The ChildVolMaterial object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeVolMaterial(ChildVolMaterial $volMaterial)
    {
        if ($this->getVolMaterials()->contains($volMaterial)) {
            $pos = $this->collVolMaterials->search($volMaterial);
            $this->collVolMaterials->remove($pos);
            if (null === $this->volMaterialsScheduledForDeletion) {
                $this->volMaterialsScheduledForDeletion = clone $this->collVolMaterials;
                $this->volMaterialsScheduledForDeletion->clear();
            }
            $this->volMaterialsScheduledForDeletion[]= clone $volMaterial;
            $volMaterial->setVolUnit(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this VolUnit is new, it will return
     * an empty collection; or if this VolUnit has previously
     * been saved, it will retrieve related VolMaterials from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in VolUnit.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildVolMaterial[] List of ChildVolMaterial objects
     * @phpstan-return ObjectCollection&\Traversable<ChildVolMaterial}> List of ChildVolMaterial objects
     */
    public function getVolMaterialsJoinUsers(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildVolMaterialQuery::create(null, $criteria);
        $query->joinWith('Users', $joinBehavior);

        return $this->getVolMaterials($query, $con);
    }

    /**
     * Clears out the collVolTechnics collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addVolTechnics()
     */
    public function clearVolTechnics()
    {
        $this->collVolTechnics = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collVolTechnics collection loaded partially.
     *
     * @return void
     */
    public function resetPartialVolTechnics($v = true): void
    {
        $this->collVolTechnicsPartial = $v;
    }

    /**
     * Initializes the collVolTechnics collection.
     *
     * By default this just sets the collVolTechnics collection to an empty array (like clearcollVolTechnics());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initVolTechnics(bool $overrideExisting = true): void
    {
        if (null !== $this->collVolTechnics && !$overrideExisting) {
            return;
        }

        $collectionClassName = VolTechnicTableMap::getTableMap()->getCollectionClassName();

        $this->collVolTechnics = new $collectionClassName;
        $this->collVolTechnics->setModel('\DB\VolTechnic');
    }

    /**
     * Gets an array of ChildVolTechnic objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildVolUnit is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildVolTechnic[] List of ChildVolTechnic objects
     * @phpstan-return ObjectCollection&\Traversable<ChildVolTechnic> List of ChildVolTechnic objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getVolTechnics(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collVolTechnicsPartial && !$this->isNew();
        if (null === $this->collVolTechnics || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collVolTechnics) {
                    $this->initVolTechnics();
                } else {
                    $collectionClassName = VolTechnicTableMap::getTableMap()->getCollectionClassName();

                    $collVolTechnics = new $collectionClassName;
                    $collVolTechnics->setModel('\DB\VolTechnic');

                    return $collVolTechnics;
                }
            } else {
                $collVolTechnics = ChildVolTechnicQuery::create(null, $criteria)
                    ->filterByVolUnit($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collVolTechnicsPartial && count($collVolTechnics)) {
                        $this->initVolTechnics(false);

                        foreach ($collVolTechnics as $obj) {
                            if (false == $this->collVolTechnics->contains($obj)) {
                                $this->collVolTechnics->append($obj);
                            }
                        }

                        $this->collVolTechnicsPartial = true;
                    }

                    return $collVolTechnics;
                }

                if ($partial && $this->collVolTechnics) {
                    foreach ($this->collVolTechnics as $obj) {
                        if ($obj->isNew()) {
                            $collVolTechnics[] = $obj;
                        }
                    }
                }

                $this->collVolTechnics = $collVolTechnics;
                $this->collVolTechnicsPartial = false;
            }
        }

        return $this->collVolTechnics;
    }

    /**
     * Sets a collection of ChildVolTechnic objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $volTechnics A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setVolTechnics(Collection $volTechnics, ?ConnectionInterface $con = null)
    {
        /** @var ChildVolTechnic[] $volTechnicsToDelete */
        $volTechnicsToDelete = $this->getVolTechnics(new Criteria(), $con)->diff($volTechnics);


        $this->volTechnicsScheduledForDeletion = $volTechnicsToDelete;

        foreach ($volTechnicsToDelete as $volTechnicRemoved) {
            $volTechnicRemoved->setVolUnit(null);
        }

        $this->collVolTechnics = null;
        foreach ($volTechnics as $volTechnic) {
            $this->addVolTechnic($volTechnic);
        }

        $this->collVolTechnics = $volTechnics;
        $this->collVolTechnicsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related VolTechnic objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related VolTechnic objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countVolTechnics(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collVolTechnicsPartial && !$this->isNew();
        if (null === $this->collVolTechnics || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collVolTechnics) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getVolTechnics());
            }

            $query = ChildVolTechnicQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByVolUnit($this)
                ->count($con);
        }

        return count($this->collVolTechnics);
    }

    /**
     * Method called to associate a ChildVolTechnic object to this object
     * through the ChildVolTechnic foreign key attribute.
     *
     * @param ChildVolTechnic $l ChildVolTechnic
     * @return $this The current object (for fluent API support)
     */
    public function addVolTechnic(ChildVolTechnic $l)
    {
        if ($this->collVolTechnics === null) {
            $this->initVolTechnics();
            $this->collVolTechnicsPartial = true;
        }

        if (!$this->collVolTechnics->contains($l)) {
            $this->doAddVolTechnic($l);

            if ($this->volTechnicsScheduledForDeletion and $this->volTechnicsScheduledForDeletion->contains($l)) {
                $this->volTechnicsScheduledForDeletion->remove($this->volTechnicsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildVolTechnic $volTechnic The ChildVolTechnic object to add.
     */
    protected function doAddVolTechnic(ChildVolTechnic $volTechnic): void
    {
        $this->collVolTechnics[]= $volTechnic;
        $volTechnic->setVolUnit($this);
    }

    /**
     * @param ChildVolTechnic $volTechnic The ChildVolTechnic object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeVolTechnic(ChildVolTechnic $volTechnic)
    {
        if ($this->getVolTechnics()->contains($volTechnic)) {
            $pos = $this->collVolTechnics->search($volTechnic);
            $this->collVolTechnics->remove($pos);
            if (null === $this->volTechnicsScheduledForDeletion) {
                $this->volTechnicsScheduledForDeletion = clone $this->collVolTechnics;
                $this->volTechnicsScheduledForDeletion->clear();
            }
            $this->volTechnicsScheduledForDeletion[]= clone $volTechnic;
            $volTechnic->setVolUnit(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this VolUnit is new, it will return
     * an empty collection; or if this VolUnit has previously
     * been saved, it will retrieve related VolTechnics from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in VolUnit.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildVolTechnic[] List of ChildVolTechnic objects
     * @phpstan-return ObjectCollection&\Traversable<ChildVolTechnic}> List of ChildVolTechnic objects
     */
    public function getVolTechnicsJoinUsers(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildVolTechnicQuery::create(null, $criteria);
        $query->joinWith('Users', $joinBehavior);

        return $this->getVolTechnics($query, $con);
    }

    /**
     * Clears out the collVolWorks collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addVolWorks()
     */
    public function clearVolWorks()
    {
        $this->collVolWorks = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collVolWorks collection loaded partially.
     *
     * @return void
     */
    public function resetPartialVolWorks($v = true): void
    {
        $this->collVolWorksPartial = $v;
    }

    /**
     * Initializes the collVolWorks collection.
     *
     * By default this just sets the collVolWorks collection to an empty array (like clearcollVolWorks());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initVolWorks(bool $overrideExisting = true): void
    {
        if (null !== $this->collVolWorks && !$overrideExisting) {
            return;
        }

        $collectionClassName = VolWorkTableMap::getTableMap()->getCollectionClassName();

        $this->collVolWorks = new $collectionClassName;
        $this->collVolWorks->setModel('\DB\VolWork');
    }

    /**
     * Gets an array of ChildVolWork objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildVolUnit is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildVolWork[] List of ChildVolWork objects
     * @phpstan-return ObjectCollection&\Traversable<ChildVolWork> List of ChildVolWork objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getVolWorks(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collVolWorksPartial && !$this->isNew();
        if (null === $this->collVolWorks || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collVolWorks) {
                    $this->initVolWorks();
                } else {
                    $collectionClassName = VolWorkTableMap::getTableMap()->getCollectionClassName();

                    $collVolWorks = new $collectionClassName;
                    $collVolWorks->setModel('\DB\VolWork');

                    return $collVolWorks;
                }
            } else {
                $collVolWorks = ChildVolWorkQuery::create(null, $criteria)
                    ->filterByVolUnit($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collVolWorksPartial && count($collVolWorks)) {
                        $this->initVolWorks(false);

                        foreach ($collVolWorks as $obj) {
                            if (false == $this->collVolWorks->contains($obj)) {
                                $this->collVolWorks->append($obj);
                            }
                        }

                        $this->collVolWorksPartial = true;
                    }

                    return $collVolWorks;
                }

                if ($partial && $this->collVolWorks) {
                    foreach ($this->collVolWorks as $obj) {
                        if ($obj->isNew()) {
                            $collVolWorks[] = $obj;
                        }
                    }
                }

                $this->collVolWorks = $collVolWorks;
                $this->collVolWorksPartial = false;
            }
        }

        return $this->collVolWorks;
    }

    /**
     * Sets a collection of ChildVolWork objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $volWorks A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setVolWorks(Collection $volWorks, ?ConnectionInterface $con = null)
    {
        /** @var ChildVolWork[] $volWorksToDelete */
        $volWorksToDelete = $this->getVolWorks(new Criteria(), $con)->diff($volWorks);


        $this->volWorksScheduledForDeletion = $volWorksToDelete;

        foreach ($volWorksToDelete as $volWorkRemoved) {
            $volWorkRemoved->setVolUnit(null);
        }

        $this->collVolWorks = null;
        foreach ($volWorks as $volWork) {
            $this->addVolWork($volWork);
        }

        $this->collVolWorks = $volWorks;
        $this->collVolWorksPartial = false;

        return $this;
    }

    /**
     * Returns the number of related VolWork objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related VolWork objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countVolWorks(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collVolWorksPartial && !$this->isNew();
        if (null === $this->collVolWorks || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collVolWorks) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getVolWorks());
            }

            $query = ChildVolWorkQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByVolUnit($this)
                ->count($con);
        }

        return count($this->collVolWorks);
    }

    /**
     * Method called to associate a ChildVolWork object to this object
     * through the ChildVolWork foreign key attribute.
     *
     * @param ChildVolWork $l ChildVolWork
     * @return $this The current object (for fluent API support)
     */
    public function addVolWork(ChildVolWork $l)
    {
        if ($this->collVolWorks === null) {
            $this->initVolWorks();
            $this->collVolWorksPartial = true;
        }

        if (!$this->collVolWorks->contains($l)) {
            $this->doAddVolWork($l);

            if ($this->volWorksScheduledForDeletion and $this->volWorksScheduledForDeletion->contains($l)) {
                $this->volWorksScheduledForDeletion->remove($this->volWorksScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildVolWork $volWork The ChildVolWork object to add.
     */
    protected function doAddVolWork(ChildVolWork $volWork): void
    {
        $this->collVolWorks[]= $volWork;
        $volWork->setVolUnit($this);
    }

    /**
     * @param ChildVolWork $volWork The ChildVolWork object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeVolWork(ChildVolWork $volWork)
    {
        if ($this->getVolWorks()->contains($volWork)) {
            $pos = $this->collVolWorks->search($volWork);
            $this->collVolWorks->remove($pos);
            if (null === $this->volWorksScheduledForDeletion) {
                $this->volWorksScheduledForDeletion = clone $this->collVolWorks;
                $this->volWorksScheduledForDeletion->clear();
            }
            $this->volWorksScheduledForDeletion[]= clone $volWork;
            $volWork->setVolUnit(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this VolUnit is new, it will return
     * an empty collection; or if this VolUnit has previously
     * been saved, it will retrieve related VolWorks from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in VolUnit.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildVolWork[] List of ChildVolWork objects
     * @phpstan-return ObjectCollection&\Traversable<ChildVolWork}> List of ChildVolWork objects
     */
    public function getVolWorksJoinUsers(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildVolWorkQuery::create(null, $criteria);
        $query->joinWith('Users', $joinBehavior);

        return $this->getVolWorks($query, $con);
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
            if ($this->collVolMaterials) {
                foreach ($this->collVolMaterials as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collVolTechnics) {
                foreach ($this->collVolTechnics as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collVolWorks) {
                foreach ($this->collVolWorks as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collVolMaterials = null;
        $this->collVolTechnics = null;
        $this->collVolWorks = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(VolUnitTableMap::DEFAULT_STRING_FORMAT);
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
