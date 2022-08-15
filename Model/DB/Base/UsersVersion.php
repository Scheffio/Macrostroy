<?php

namespace DB\Base;

use \Exception;
use \PDO;
use DB\Users as ChildUsers;
use DB\UsersQuery as ChildUsersQuery;
use DB\UsersVersionQuery as ChildUsersVersionQuery;
use DB\Map\UsersVersionTableMap;
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

/**
 * Base class that represents a row from the 'users_version' table.
 *
 *
 *
 * @package    propel.generator.DB.Base
 */
abstract class UsersVersion implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\DB\\Map\\UsersVersionTableMap';


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
     *
     * @var        int
     */
    protected $id;

    /**
     * The value for the email field.
     *
     * @var        string
     */
    protected $email;

    /**
     * The value for the password field.
     *
     * @var        string
     */
    protected $password;

    /**
     * The value for the username field.
     *
     * @var        string|null
     */
    protected $username;

    /**
     * The value for the status field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $status;

    /**
     * The value for the verified field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $verified;

    /**
     * The value for the resettable field.
     *
     * Note: this column has a database default value of: 1
     * @var        int
     */
    protected $resettable;

    /**
     * The value for the roles_mask field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $roles_mask;

    /**
     * The value for the registered field.
     *
     * @var        int
     */
    protected $registered;

    /**
     * The value for the last_login field.
     *
     * @var        int|null
     */
    protected $last_login;

    /**
     * The value for the force_logout field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $force_logout;

    /**
     * The value for the is_available field.
     *
     * Note: this column has a database default value of: true
     * @var        boolean
     */
    protected $is_available;

    /**
     * The value for the version field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $version;

    /**
     * The value for the groups_ids field.
     *
     * @var        array|null
     */
    protected $groups_ids;

    /**
     * The unserialized $groups_ids value - i.e. the persisted object.
     * This is necessary to avoid repeated calls to unserialize() at runtime.
     * @var object
     */
    protected $groups_ids_unserialized;

    /**
     * The value for the groups_versions field.
     *
     * @var        array|null
     */
    protected $groups_versions;

    /**
     * The unserialized $groups_versions value - i.e. the persisted object.
     * This is necessary to avoid repeated calls to unserialize() at runtime.
     * @var object
     */
    protected $groups_versions_unserialized;

    /**
     * The value for the unit_ids field.
     *
     * @var        array|null
     */
    protected $unit_ids;

    /**
     * The unserialized $unit_ids value - i.e. the persisted object.
     * This is necessary to avoid repeated calls to unserialize() at runtime.
     * @var object
     */
    protected $unit_ids_unserialized;

    /**
     * The value for the unit_versions field.
     *
     * @var        array|null
     */
    protected $unit_versions;

    /**
     * The unserialized $unit_versions value - i.e. the persisted object.
     * This is necessary to avoid repeated calls to unserialize() at runtime.
     * @var object
     */
    protected $unit_versions_unserialized;

    /**
     * @var        ChildUsers
     */
    protected $aUsers;

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
        $this->status = 0;
        $this->verified = 0;
        $this->resettable = 1;
        $this->roles_mask = 0;
        $this->force_logout = 0;
        $this->is_available = true;
        $this->version = 0;
    }

    /**
     * Initializes internal state of DB\Base\UsersVersion object.
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
     * Compares this with another <code>UsersVersion</code> instance.  If
     * <code>obj</code> is an instance of <code>UsersVersion</code>, delegates to
     * <code>equals(UsersVersion)</code>.  Otherwise, returns <code>false</code>.
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
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the [email] column value.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the [password] column value.
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Get the [username] column value.
     *
     * @return string|null
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Get the [status] column value.
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Get the [verified] column value.
     *
     * @return int
     */
    public function getVerified()
    {
        return $this->verified;
    }

    /**
     * Get the [resettable] column value.
     *
     * @return int
     */
    public function getResettable()
    {
        return $this->resettable;
    }

    /**
     * Get the [roles_mask] column value.
     *
     * @return int
     */
    public function getRolesMask()
    {
        return $this->roles_mask;
    }

    /**
     * Get the [registered] column value.
     *
     * @return int
     */
    public function getRegistered()
    {
        return $this->registered;
    }

    /**
     * Get the [last_login] column value.
     *
     * @return int|null
     */
    public function getLastLogin()
    {
        return $this->last_login;
    }

    /**
     * Get the [force_logout] column value.
     *
     * @return int
     */
    public function getForceLogout()
    {
        return $this->force_logout;
    }

    /**
     * Get the [is_available] column value.
     *
     * @return boolean
     */
    public function getIsAvailable()
    {
        return $this->is_available;
    }

    /**
     * Get the [is_available] column value.
     *
     * @return boolean
     */
    public function isAvailable()
    {
        return $this->getIsAvailable();
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
     * Get the [groups_ids] column value.
     *
     * @return array|null
     */
    public function getGroupsIds()
    {
        if (null === $this->groups_ids_unserialized) {
            $this->groups_ids_unserialized = [];
        }
        if (!$this->groups_ids_unserialized && null !== $this->groups_ids) {
            $groups_ids_unserialized = substr($this->groups_ids, 2, -2);
            $this->groups_ids_unserialized = '' !== $groups_ids_unserialized ? explode(' | ', $groups_ids_unserialized) : array();
        }

        return $this->groups_ids_unserialized;
    }

    /**
     * Test the presence of a value in the [groups_ids] array column value.
     * @param mixed $value
     *
     * @return bool
     */
    public function hasGroupsId($value): bool
    {
        return in_array($value, $this->getGroupsIds());
    }

    /**
     * Get the [groups_versions] column value.
     *
     * @return array|null
     */
    public function getGroupsVersions()
    {
        if (null === $this->groups_versions_unserialized) {
            $this->groups_versions_unserialized = [];
        }
        if (!$this->groups_versions_unserialized && null !== $this->groups_versions) {
            $groups_versions_unserialized = substr($this->groups_versions, 2, -2);
            $this->groups_versions_unserialized = '' !== $groups_versions_unserialized ? explode(' | ', $groups_versions_unserialized) : array();
        }

        return $this->groups_versions_unserialized;
    }

    /**
     * Test the presence of a value in the [groups_versions] array column value.
     * @param mixed $value
     *
     * @return bool
     */
    public function hasGroupsVersion($value): bool
    {
        return in_array($value, $this->getGroupsVersions());
    }

    /**
     * Get the [unit_ids] column value.
     *
     * @return array|null
     */
    public function getUnitIds()
    {
        if (null === $this->unit_ids_unserialized) {
            $this->unit_ids_unserialized = [];
        }
        if (!$this->unit_ids_unserialized && null !== $this->unit_ids) {
            $unit_ids_unserialized = substr($this->unit_ids, 2, -2);
            $this->unit_ids_unserialized = '' !== $unit_ids_unserialized ? explode(' | ', $unit_ids_unserialized) : array();
        }

        return $this->unit_ids_unserialized;
    }

    /**
     * Test the presence of a value in the [unit_ids] array column value.
     * @param mixed $value
     *
     * @return bool
     */
    public function hasUnitId($value): bool
    {
        return in_array($value, $this->getUnitIds());
    }

    /**
     * Get the [unit_versions] column value.
     *
     * @return array|null
     */
    public function getUnitVersions()
    {
        if (null === $this->unit_versions_unserialized) {
            $this->unit_versions_unserialized = [];
        }
        if (!$this->unit_versions_unserialized && null !== $this->unit_versions) {
            $unit_versions_unserialized = substr($this->unit_versions, 2, -2);
            $this->unit_versions_unserialized = '' !== $unit_versions_unserialized ? explode(' | ', $unit_versions_unserialized) : array();
        }

        return $this->unit_versions_unserialized;
    }

    /**
     * Test the presence of a value in the [unit_versions] array column value.
     * @param mixed $value
     *
     * @return bool
     */
    public function hasUnitVersion($value): bool
    {
        return in_array($value, $this->getUnitVersions());
    }

    /**
     * Set the value of [id] column.
     *
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
            $this->modifiedColumns[UsersVersionTableMap::COL_ID] = true;
        }

        if ($this->aUsers !== null && $this->aUsers->getId() !== $v) {
            $this->aUsers = null;
        }

        return $this;
    }

    /**
     * Set the value of [email] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->email !== $v) {
            $this->email = $v;
            $this->modifiedColumns[UsersVersionTableMap::COL_EMAIL] = true;
        }

        return $this;
    }

    /**
     * Set the value of [password] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPassword($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->password !== $v) {
            $this->password = $v;
            $this->modifiedColumns[UsersVersionTableMap::COL_PASSWORD] = true;
        }

        return $this;
    }

    /**
     * Set the value of [username] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setUsername($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->username !== $v) {
            $this->username = $v;
            $this->modifiedColumns[UsersVersionTableMap::COL_USERNAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [status] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setStatus($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->status !== $v) {
            $this->status = $v;
            $this->modifiedColumns[UsersVersionTableMap::COL_STATUS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [verified] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setVerified($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->verified !== $v) {
            $this->verified = $v;
            $this->modifiedColumns[UsersVersionTableMap::COL_VERIFIED] = true;
        }

        return $this;
    }

    /**
     * Set the value of [resettable] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setResettable($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->resettable !== $v) {
            $this->resettable = $v;
            $this->modifiedColumns[UsersVersionTableMap::COL_RESETTABLE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [roles_mask] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setRolesMask($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->roles_mask !== $v) {
            $this->roles_mask = $v;
            $this->modifiedColumns[UsersVersionTableMap::COL_ROLES_MASK] = true;
        }

        return $this;
    }

    /**
     * Set the value of [registered] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setRegistered($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->registered !== $v) {
            $this->registered = $v;
            $this->modifiedColumns[UsersVersionTableMap::COL_REGISTERED] = true;
        }

        return $this;
    }

    /**
     * Set the value of [last_login] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setLastLogin($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->last_login !== $v) {
            $this->last_login = $v;
            $this->modifiedColumns[UsersVersionTableMap::COL_LAST_LOGIN] = true;
        }

        return $this;
    }

    /**
     * Set the value of [force_logout] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setForceLogout($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->force_logout !== $v) {
            $this->force_logout = $v;
            $this->modifiedColumns[UsersVersionTableMap::COL_FORCE_LOGOUT] = true;
        }

        return $this;
    }

    /**
     * Sets the value of the [is_available] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
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
            $this->modifiedColumns[UsersVersionTableMap::COL_IS_AVAILABLE] = true;
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
            $this->modifiedColumns[UsersVersionTableMap::COL_VERSION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [groups_ids] column.
     *
     * @param array|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setGroupsIds($v)
    {
        if ($this->groups_ids_unserialized !== $v) {
            $this->groups_ids_unserialized = $v;
            $this->groups_ids = '| ' . implode(' | ', $v) . ' |';
            $this->modifiedColumns[UsersVersionTableMap::COL_GROUPS_IDS] = true;
        }

        return $this;
    }

    /**
     * Adds a value to the [groups_ids] array column value.
     * @param mixed $value
     *
     * @return $this The current object (for fluent API support)
     */
    public function addGroupsId($value)
    {
        $currentArray = $this->getGroupsIds();
        $currentArray []= $value;
        $this->setGroupsIds($currentArray);

        return $this;
    }

    /**
     * Removes a value from the [groups_ids] array column value.
     * @param mixed $value
     *
     * @return $this The current object (for fluent API support)
     */
    public function removeGroupsId($value)
    {
        $targetArray = [];
        foreach ($this->getGroupsIds() as $element) {
            if ($element != $value) {
                $targetArray []= $element;
            }
        }
        $this->setGroupsIds($targetArray);

        return $this;
    }

    /**
     * Set the value of [groups_versions] column.
     *
     * @param array|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setGroupsVersions($v)
    {
        if ($this->groups_versions_unserialized !== $v) {
            $this->groups_versions_unserialized = $v;
            $this->groups_versions = '| ' . implode(' | ', $v) . ' |';
            $this->modifiedColumns[UsersVersionTableMap::COL_GROUPS_VERSIONS] = true;
        }

        return $this;
    }

    /**
     * Adds a value to the [groups_versions] array column value.
     * @param mixed $value
     *
     * @return $this The current object (for fluent API support)
     */
    public function addGroupsVersion($value)
    {
        $currentArray = $this->getGroupsVersions();
        $currentArray []= $value;
        $this->setGroupsVersions($currentArray);

        return $this;
    }

    /**
     * Removes a value from the [groups_versions] array column value.
     * @param mixed $value
     *
     * @return $this The current object (for fluent API support)
     */
    public function removeGroupsVersion($value)
    {
        $targetArray = [];
        foreach ($this->getGroupsVersions() as $element) {
            if ($element != $value) {
                $targetArray []= $element;
            }
        }
        $this->setGroupsVersions($targetArray);

        return $this;
    }

    /**
     * Set the value of [unit_ids] column.
     *
     * @param array|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setUnitIds($v)
    {
        if ($this->unit_ids_unserialized !== $v) {
            $this->unit_ids_unserialized = $v;
            $this->unit_ids = '| ' . implode(' | ', $v) . ' |';
            $this->modifiedColumns[UsersVersionTableMap::COL_UNIT_IDS] = true;
        }

        return $this;
    }

    /**
     * Adds a value to the [unit_ids] array column value.
     * @param mixed $value
     *
     * @return $this The current object (for fluent API support)
     */
    public function addUnitId($value)
    {
        $currentArray = $this->getUnitIds();
        $currentArray []= $value;
        $this->setUnitIds($currentArray);

        return $this;
    }

    /**
     * Removes a value from the [unit_ids] array column value.
     * @param mixed $value
     *
     * @return $this The current object (for fluent API support)
     */
    public function removeUnitId($value)
    {
        $targetArray = [];
        foreach ($this->getUnitIds() as $element) {
            if ($element != $value) {
                $targetArray []= $element;
            }
        }
        $this->setUnitIds($targetArray);

        return $this;
    }

    /**
     * Set the value of [unit_versions] column.
     *
     * @param array|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setUnitVersions($v)
    {
        if ($this->unit_versions_unserialized !== $v) {
            $this->unit_versions_unserialized = $v;
            $this->unit_versions = '| ' . implode(' | ', $v) . ' |';
            $this->modifiedColumns[UsersVersionTableMap::COL_UNIT_VERSIONS] = true;
        }

        return $this;
    }

    /**
     * Adds a value to the [unit_versions] array column value.
     * @param mixed $value
     *
     * @return $this The current object (for fluent API support)
     */
    public function addUnitVersion($value)
    {
        $currentArray = $this->getUnitVersions();
        $currentArray []= $value;
        $this->setUnitVersions($currentArray);

        return $this;
    }

    /**
     * Removes a value from the [unit_versions] array column value.
     * @param mixed $value
     *
     * @return $this The current object (for fluent API support)
     */
    public function removeUnitVersion($value)
    {
        $targetArray = [];
        foreach ($this->getUnitVersions() as $element) {
            if ($element != $value) {
                $targetArray []= $element;
            }
        }
        $this->setUnitVersions($targetArray);

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
            if ($this->status !== 0) {
                return false;
            }

            if ($this->verified !== 0) {
                return false;
            }

            if ($this->resettable !== 1) {
                return false;
            }

            if ($this->roles_mask !== 0) {
                return false;
            }

            if ($this->force_logout !== 0) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : UsersVersionTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : UsersVersionTableMap::translateFieldName('Email', TableMap::TYPE_PHPNAME, $indexType)];
            $this->email = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : UsersVersionTableMap::translateFieldName('Password', TableMap::TYPE_PHPNAME, $indexType)];
            $this->password = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : UsersVersionTableMap::translateFieldName('Username', TableMap::TYPE_PHPNAME, $indexType)];
            $this->username = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : UsersVersionTableMap::translateFieldName('Status', TableMap::TYPE_PHPNAME, $indexType)];
            $this->status = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : UsersVersionTableMap::translateFieldName('Verified', TableMap::TYPE_PHPNAME, $indexType)];
            $this->verified = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : UsersVersionTableMap::translateFieldName('Resettable', TableMap::TYPE_PHPNAME, $indexType)];
            $this->resettable = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : UsersVersionTableMap::translateFieldName('RolesMask', TableMap::TYPE_PHPNAME, $indexType)];
            $this->roles_mask = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : UsersVersionTableMap::translateFieldName('Registered', TableMap::TYPE_PHPNAME, $indexType)];
            $this->registered = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : UsersVersionTableMap::translateFieldName('LastLogin', TableMap::TYPE_PHPNAME, $indexType)];
            $this->last_login = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : UsersVersionTableMap::translateFieldName('ForceLogout', TableMap::TYPE_PHPNAME, $indexType)];
            $this->force_logout = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : UsersVersionTableMap::translateFieldName('IsAvailable', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_available = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : UsersVersionTableMap::translateFieldName('Version', TableMap::TYPE_PHPNAME, $indexType)];
            $this->version = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : UsersVersionTableMap::translateFieldName('GroupsIds', TableMap::TYPE_PHPNAME, $indexType)];
            $this->groups_ids = $col;
            $this->groups_ids_unserialized = null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : UsersVersionTableMap::translateFieldName('GroupsVersions', TableMap::TYPE_PHPNAME, $indexType)];
            $this->groups_versions = $col;
            $this->groups_versions_unserialized = null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : UsersVersionTableMap::translateFieldName('UnitIds', TableMap::TYPE_PHPNAME, $indexType)];
            $this->unit_ids = $col;
            $this->unit_ids_unserialized = null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : UsersVersionTableMap::translateFieldName('UnitVersions', TableMap::TYPE_PHPNAME, $indexType)];
            $this->unit_versions = $col;
            $this->unit_versions_unserialized = null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 17; // 17 = UsersVersionTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\DB\\UsersVersion'), 0, $e);
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
        if ($this->aUsers !== null && $this->id !== $this->aUsers->getId()) {
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
            $con = Propel::getServiceContainer()->getReadConnection(UsersVersionTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildUsersVersionQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aUsers = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see UsersVersion::setDeleted()
     * @see UsersVersion::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsersVersionTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildUsersVersionQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(UsersVersionTableMap::DATABASE_NAME);
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
                UsersVersionTableMap::addInstanceToPool($this);
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
        if ($this->isColumnModified(UsersVersionTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(UsersVersionTableMap::COL_EMAIL)) {
            $modifiedColumns[':p' . $index++]  = 'email';
        }
        if ($this->isColumnModified(UsersVersionTableMap::COL_PASSWORD)) {
            $modifiedColumns[':p' . $index++]  = 'password';
        }
        if ($this->isColumnModified(UsersVersionTableMap::COL_USERNAME)) {
            $modifiedColumns[':p' . $index++]  = 'username';
        }
        if ($this->isColumnModified(UsersVersionTableMap::COL_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'status';
        }
        if ($this->isColumnModified(UsersVersionTableMap::COL_VERIFIED)) {
            $modifiedColumns[':p' . $index++]  = 'verified';
        }
        if ($this->isColumnModified(UsersVersionTableMap::COL_RESETTABLE)) {
            $modifiedColumns[':p' . $index++]  = 'resettable';
        }
        if ($this->isColumnModified(UsersVersionTableMap::COL_ROLES_MASK)) {
            $modifiedColumns[':p' . $index++]  = 'roles_mask';
        }
        if ($this->isColumnModified(UsersVersionTableMap::COL_REGISTERED)) {
            $modifiedColumns[':p' . $index++]  = 'registered';
        }
        if ($this->isColumnModified(UsersVersionTableMap::COL_LAST_LOGIN)) {
            $modifiedColumns[':p' . $index++]  = 'last_login';
        }
        if ($this->isColumnModified(UsersVersionTableMap::COL_FORCE_LOGOUT)) {
            $modifiedColumns[':p' . $index++]  = 'force_logout';
        }
        if ($this->isColumnModified(UsersVersionTableMap::COL_IS_AVAILABLE)) {
            $modifiedColumns[':p' . $index++]  = 'is_available';
        }
        if ($this->isColumnModified(UsersVersionTableMap::COL_VERSION)) {
            $modifiedColumns[':p' . $index++]  = 'version';
        }
        if ($this->isColumnModified(UsersVersionTableMap::COL_GROUPS_IDS)) {
            $modifiedColumns[':p' . $index++]  = 'groups_ids';
        }
        if ($this->isColumnModified(UsersVersionTableMap::COL_GROUPS_VERSIONS)) {
            $modifiedColumns[':p' . $index++]  = 'groups_versions';
        }
        if ($this->isColumnModified(UsersVersionTableMap::COL_UNIT_IDS)) {
            $modifiedColumns[':p' . $index++]  = 'unit_ids';
        }
        if ($this->isColumnModified(UsersVersionTableMap::COL_UNIT_VERSIONS)) {
            $modifiedColumns[':p' . $index++]  = 'unit_versions';
        }

        $sql = sprintf(
            'INSERT INTO users_version (%s) VALUES (%s)',
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
                    case 'email':
                        $stmt->bindValue($identifier, $this->email, PDO::PARAM_STR);
                        break;
                    case 'password':
                        $stmt->bindValue($identifier, $this->password, PDO::PARAM_STR);
                        break;
                    case 'username':
                        $stmt->bindValue($identifier, $this->username, PDO::PARAM_STR);
                        break;
                    case 'status':
                        $stmt->bindValue($identifier, $this->status, PDO::PARAM_INT);
                        break;
                    case 'verified':
                        $stmt->bindValue($identifier, $this->verified, PDO::PARAM_INT);
                        break;
                    case 'resettable':
                        $stmt->bindValue($identifier, $this->resettable, PDO::PARAM_INT);
                        break;
                    case 'roles_mask':
                        $stmt->bindValue($identifier, $this->roles_mask, PDO::PARAM_INT);
                        break;
                    case 'registered':
                        $stmt->bindValue($identifier, $this->registered, PDO::PARAM_INT);
                        break;
                    case 'last_login':
                        $stmt->bindValue($identifier, $this->last_login, PDO::PARAM_INT);
                        break;
                    case 'force_logout':
                        $stmt->bindValue($identifier, $this->force_logout, PDO::PARAM_INT);
                        break;
                    case 'is_available':
                        $stmt->bindValue($identifier, (int) $this->is_available, PDO::PARAM_INT);
                        break;
                    case 'version':
                        $stmt->bindValue($identifier, $this->version, PDO::PARAM_INT);
                        break;
                    case 'groups_ids':
                        $stmt->bindValue($identifier, $this->groups_ids, PDO::PARAM_STR);
                        break;
                    case 'groups_versions':
                        $stmt->bindValue($identifier, $this->groups_versions, PDO::PARAM_STR);
                        break;
                    case 'unit_ids':
                        $stmt->bindValue($identifier, $this->unit_ids, PDO::PARAM_STR);
                        break;
                    case 'unit_versions':
                        $stmt->bindValue($identifier, $this->unit_versions, PDO::PARAM_STR);
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
        $pos = UsersVersionTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getEmail();

            case 2:
                return $this->getPassword();

            case 3:
                return $this->getUsername();

            case 4:
                return $this->getStatus();

            case 5:
                return $this->getVerified();

            case 6:
                return $this->getResettable();

            case 7:
                return $this->getRolesMask();

            case 8:
                return $this->getRegistered();

            case 9:
                return $this->getLastLogin();

            case 10:
                return $this->getForceLogout();

            case 11:
                return $this->getIsAvailable();

            case 12:
                return $this->getVersion();

            case 13:
                return $this->getGroupsIds();

            case 14:
                return $this->getGroupsVersions();

            case 15:
                return $this->getUnitIds();

            case 16:
                return $this->getUnitVersions();

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
        if (isset($alreadyDumpedObjects['UsersVersion'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['UsersVersion'][$this->hashCode()] = true;
        $keys = UsersVersionTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getId(),
            $keys[1] => $this->getEmail(),
            $keys[2] => $this->getPassword(),
            $keys[3] => $this->getUsername(),
            $keys[4] => $this->getStatus(),
            $keys[5] => $this->getVerified(),
            $keys[6] => $this->getResettable(),
            $keys[7] => $this->getRolesMask(),
            $keys[8] => $this->getRegistered(),
            $keys[9] => $this->getLastLogin(),
            $keys[10] => $this->getForceLogout(),
            $keys[11] => $this->getIsAvailable(),
            $keys[12] => $this->getVersion(),
            $keys[13] => $this->getGroupsIds(),
            $keys[14] => $this->getGroupsVersions(),
            $keys[15] => $this->getUnitIds(),
            $keys[16] => $this->getUnitVersions(),
        ];
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
        $pos = UsersVersionTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setEmail($value);
                break;
            case 2:
                $this->setPassword($value);
                break;
            case 3:
                $this->setUsername($value);
                break;
            case 4:
                $this->setStatus($value);
                break;
            case 5:
                $this->setVerified($value);
                break;
            case 6:
                $this->setResettable($value);
                break;
            case 7:
                $this->setRolesMask($value);
                break;
            case 8:
                $this->setRegistered($value);
                break;
            case 9:
                $this->setLastLogin($value);
                break;
            case 10:
                $this->setForceLogout($value);
                break;
            case 11:
                $this->setIsAvailable($value);
                break;
            case 12:
                $this->setVersion($value);
                break;
            case 13:
                if (!is_array($value)) {
                    $v = trim(substr($value, 2, -2));
                    $value = $v ? explode(' | ', $v) : array();
                }
                $this->setGroupsIds($value);
                break;
            case 14:
                if (!is_array($value)) {
                    $v = trim(substr($value, 2, -2));
                    $value = $v ? explode(' | ', $v) : array();
                }
                $this->setGroupsVersions($value);
                break;
            case 15:
                if (!is_array($value)) {
                    $v = trim(substr($value, 2, -2));
                    $value = $v ? explode(' | ', $v) : array();
                }
                $this->setUnitIds($value);
                break;
            case 16:
                if (!is_array($value)) {
                    $v = trim(substr($value, 2, -2));
                    $value = $v ? explode(' | ', $v) : array();
                }
                $this->setUnitVersions($value);
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
        $keys = UsersVersionTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setEmail($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setPassword($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setUsername($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setStatus($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setVerified($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setResettable($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setRolesMask($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setRegistered($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setLastLogin($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setForceLogout($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setIsAvailable($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setVersion($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setGroupsIds($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setGroupsVersions($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setUnitIds($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setUnitVersions($arr[$keys[16]]);
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
        $criteria = new Criteria(UsersVersionTableMap::DATABASE_NAME);

        if ($this->isColumnModified(UsersVersionTableMap::COL_ID)) {
            $criteria->add(UsersVersionTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(UsersVersionTableMap::COL_EMAIL)) {
            $criteria->add(UsersVersionTableMap::COL_EMAIL, $this->email);
        }
        if ($this->isColumnModified(UsersVersionTableMap::COL_PASSWORD)) {
            $criteria->add(UsersVersionTableMap::COL_PASSWORD, $this->password);
        }
        if ($this->isColumnModified(UsersVersionTableMap::COL_USERNAME)) {
            $criteria->add(UsersVersionTableMap::COL_USERNAME, $this->username);
        }
        if ($this->isColumnModified(UsersVersionTableMap::COL_STATUS)) {
            $criteria->add(UsersVersionTableMap::COL_STATUS, $this->status);
        }
        if ($this->isColumnModified(UsersVersionTableMap::COL_VERIFIED)) {
            $criteria->add(UsersVersionTableMap::COL_VERIFIED, $this->verified);
        }
        if ($this->isColumnModified(UsersVersionTableMap::COL_RESETTABLE)) {
            $criteria->add(UsersVersionTableMap::COL_RESETTABLE, $this->resettable);
        }
        if ($this->isColumnModified(UsersVersionTableMap::COL_ROLES_MASK)) {
            $criteria->add(UsersVersionTableMap::COL_ROLES_MASK, $this->roles_mask);
        }
        if ($this->isColumnModified(UsersVersionTableMap::COL_REGISTERED)) {
            $criteria->add(UsersVersionTableMap::COL_REGISTERED, $this->registered);
        }
        if ($this->isColumnModified(UsersVersionTableMap::COL_LAST_LOGIN)) {
            $criteria->add(UsersVersionTableMap::COL_LAST_LOGIN, $this->last_login);
        }
        if ($this->isColumnModified(UsersVersionTableMap::COL_FORCE_LOGOUT)) {
            $criteria->add(UsersVersionTableMap::COL_FORCE_LOGOUT, $this->force_logout);
        }
        if ($this->isColumnModified(UsersVersionTableMap::COL_IS_AVAILABLE)) {
            $criteria->add(UsersVersionTableMap::COL_IS_AVAILABLE, $this->is_available);
        }
        if ($this->isColumnModified(UsersVersionTableMap::COL_VERSION)) {
            $criteria->add(UsersVersionTableMap::COL_VERSION, $this->version);
        }
        if ($this->isColumnModified(UsersVersionTableMap::COL_GROUPS_IDS)) {
            $criteria->add(UsersVersionTableMap::COL_GROUPS_IDS, $this->groups_ids);
        }
        if ($this->isColumnModified(UsersVersionTableMap::COL_GROUPS_VERSIONS)) {
            $criteria->add(UsersVersionTableMap::COL_GROUPS_VERSIONS, $this->groups_versions);
        }
        if ($this->isColumnModified(UsersVersionTableMap::COL_UNIT_IDS)) {
            $criteria->add(UsersVersionTableMap::COL_UNIT_IDS, $this->unit_ids);
        }
        if ($this->isColumnModified(UsersVersionTableMap::COL_UNIT_VERSIONS)) {
            $criteria->add(UsersVersionTableMap::COL_UNIT_VERSIONS, $this->unit_versions);
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
        $criteria = ChildUsersVersionQuery::create();
        $criteria->add(UsersVersionTableMap::COL_ID, $this->id);
        $criteria->add(UsersVersionTableMap::COL_VERSION, $this->version);

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

        //relation users_version_fk_987e4e to table users
        if ($this->aUsers && $hash = spl_object_hash($this->aUsers)) {
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
     * @param object $copyObj An object of \DB\UsersVersion (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setId($this->getId());
        $copyObj->setEmail($this->getEmail());
        $copyObj->setPassword($this->getPassword());
        $copyObj->setUsername($this->getUsername());
        $copyObj->setStatus($this->getStatus());
        $copyObj->setVerified($this->getVerified());
        $copyObj->setResettable($this->getResettable());
        $copyObj->setRolesMask($this->getRolesMask());
        $copyObj->setRegistered($this->getRegistered());
        $copyObj->setLastLogin($this->getLastLogin());
        $copyObj->setForceLogout($this->getForceLogout());
        $copyObj->setIsAvailable($this->getIsAvailable());
        $copyObj->setVersion($this->getVersion());
        $copyObj->setGroupsIds($this->getGroupsIds());
        $copyObj->setGroupsVersions($this->getGroupsVersions());
        $copyObj->setUnitIds($this->getUnitIds());
        $copyObj->setUnitVersions($this->getUnitVersions());
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
     * @return \DB\UsersVersion Clone of current object.
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
            $this->setId(NULL);
        } else {
            $this->setId($v->getId());
        }

        $this->aUsers = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildUsers object, it will not be re-added.
        if ($v !== null) {
            $v->addUsersVersion($this);
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
        if ($this->aUsers === null && ($this->id != 0)) {
            $this->aUsers = ChildUsersQuery::create()->findPk($this->id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aUsers->addUsersVersions($this);
             */
        }

        return $this->aUsers;
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
            $this->aUsers->removeUsersVersion($this);
        }
        $this->id = null;
        $this->email = null;
        $this->password = null;
        $this->username = null;
        $this->status = null;
        $this->verified = null;
        $this->resettable = null;
        $this->roles_mask = null;
        $this->registered = null;
        $this->last_login = null;
        $this->force_logout = null;
        $this->is_available = null;
        $this->version = null;
        $this->groups_ids = null;
        $this->groups_ids_unserialized = null;
        $this->groups_versions = null;
        $this->groups_versions_unserialized = null;
        $this->unit_ids = null;
        $this->unit_ids_unserialized = null;
        $this->unit_versions = null;
        $this->unit_versions_unserialized = null;
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

        $this->aUsers = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(UsersVersionTableMap::DEFAULT_STRING_FORMAT);
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
