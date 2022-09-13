<?php

namespace DB\Base;

use \Exception;
use \PDO;
use DB\ObjGroup as ChildObjGroup;
use DB\ObjGroupQuery as ChildObjGroupQuery;
use DB\ObjHouse as ChildObjHouse;
use DB\ObjHouseQuery as ChildObjHouseQuery;
use DB\ObjProject as ChildObjProject;
use DB\ObjProjectQuery as ChildObjProjectQuery;
use DB\ObjStage as ChildObjStage;
use DB\ObjStageMaterial as ChildObjStageMaterial;
use DB\ObjStageMaterialQuery as ChildObjStageMaterialQuery;
use DB\ObjStageQuery as ChildObjStageQuery;
use DB\ObjStageTechnic as ChildObjStageTechnic;
use DB\ObjStageTechnicQuery as ChildObjStageTechnicQuery;
use DB\ObjStageWork as ChildObjStageWork;
use DB\ObjStageWorkQuery as ChildObjStageWorkQuery;
use DB\ObjSubproject as ChildObjSubproject;
use DB\ObjSubprojectQuery as ChildObjSubprojectQuery;
use DB\ProjectRole as ChildProjectRole;
use DB\ProjectRoleQuery as ChildProjectRoleQuery;
use DB\UserRole as ChildUserRole;
use DB\UserRoleQuery as ChildUserRoleQuery;
use DB\Users as ChildUsers;
use DB\UsersQuery as ChildUsersQuery;
use DB\VolMaterial as ChildVolMaterial;
use DB\VolMaterialQuery as ChildVolMaterialQuery;
use DB\VolTechnic as ChildVolTechnic;
use DB\VolTechnicQuery as ChildVolTechnicQuery;
use DB\VolWork as ChildVolWork;
use DB\VolWorkMaterial as ChildVolWorkMaterial;
use DB\VolWorkMaterialQuery as ChildVolWorkMaterialQuery;
use DB\VolWorkQuery as ChildVolWorkQuery;
use DB\VolWorkTechnic as ChildVolWorkTechnic;
use DB\VolWorkTechnicQuery as ChildVolWorkTechnicQuery;
use DB\Map\ObjGroupTableMap;
use DB\Map\ObjHouseTableMap;
use DB\Map\ObjProjectTableMap;
use DB\Map\ObjStageMaterialTableMap;
use DB\Map\ObjStageTableMap;
use DB\Map\ObjStageTechnicTableMap;
use DB\Map\ObjStageWorkTableMap;
use DB\Map\ObjSubprojectTableMap;
use DB\Map\ProjectRoleTableMap;
use DB\Map\UsersTableMap;
use DB\Map\VolMaterialTableMap;
use DB\Map\VolTechnicTableMap;
use DB\Map\VolWorkMaterialTableMap;
use DB\Map\VolWorkTableMap;
use DB\Map\VolWorkTechnicTableMap;
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
 * Base class that represents a row from the 'users' table.
 *
 *
 *
 * @package    propel.generator.DB.Base
 */
abstract class Users implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\DB\\Map\\UsersTableMap';


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
     * The value for the phone field.
     *
     * @var        string|null
     */
    protected $phone;

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
     * The value for the role_id field.
     * ID роли
     * @var        int|null
     */
    protected $role_id;

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
     * Доступ (доступный, удаленный)
     * Note: this column has a database default value of: true
     * @var        boolean
     */
    protected $is_available;

    /**
     * @var        ChildUserRole
     */
    protected $aUserRole;

    /**
     * @var        ObjectCollection|ChildProjectRole[] Collection to store aggregation of ChildProjectRole objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildProjectRole> Collection to store aggregation of ChildProjectRole objects.
     */
    protected $collProjectRoles;
    protected $collProjectRolesPartial;

    /**
     * @var        ObjectCollection|ChildObjProject[] Collection to store aggregation of ChildObjProject objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildObjProject> Collection to store aggregation of ChildObjProject objects.
     */
    protected $collObjProjects;
    protected $collObjProjectsPartial;

    /**
     * @var        ObjectCollection|ChildObjSubproject[] Collection to store aggregation of ChildObjSubproject objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildObjSubproject> Collection to store aggregation of ChildObjSubproject objects.
     */
    protected $collObjSubprojects;
    protected $collObjSubprojectsPartial;

    /**
     * @var        ObjectCollection|ChildObjGroup[] Collection to store aggregation of ChildObjGroup objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildObjGroup> Collection to store aggregation of ChildObjGroup objects.
     */
    protected $collObjGroups;
    protected $collObjGroupsPartial;

    /**
     * @var        ObjectCollection|ChildObjHouse[] Collection to store aggregation of ChildObjHouse objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildObjHouse> Collection to store aggregation of ChildObjHouse objects.
     */
    protected $collObjHouses;
    protected $collObjHousesPartial;

    /**
     * @var        ObjectCollection|ChildObjStage[] Collection to store aggregation of ChildObjStage objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildObjStage> Collection to store aggregation of ChildObjStage objects.
     */
    protected $collObjStages;
    protected $collObjStagesPartial;

    /**
     * @var        ObjectCollection|ChildObjStageWork[] Collection to store aggregation of ChildObjStageWork objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildObjStageWork> Collection to store aggregation of ChildObjStageWork objects.
     */
    protected $collObjStageWorks;
    protected $collObjStageWorksPartial;

    /**
     * @var        ObjectCollection|ChildObjStageMaterial[] Collection to store aggregation of ChildObjStageMaterial objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildObjStageMaterial> Collection to store aggregation of ChildObjStageMaterial objects.
     */
    protected $collObjStageMaterials;
    protected $collObjStageMaterialsPartial;

    /**
     * @var        ObjectCollection|ChildObjStageTechnic[] Collection to store aggregation of ChildObjStageTechnic objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildObjStageTechnic> Collection to store aggregation of ChildObjStageTechnic objects.
     */
    protected $collObjStageTechnics;
    protected $collObjStageTechnicsPartial;

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
     * @var        ObjectCollection|ChildVolWorkMaterial[] Collection to store aggregation of ChildVolWorkMaterial objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildVolWorkMaterial> Collection to store aggregation of ChildVolWorkMaterial objects.
     */
    protected $collVolWorkMaterials;
    protected $collVolWorkMaterialsPartial;

    /**
     * @var        ObjectCollection|ChildVolWorkTechnic[] Collection to store aggregation of ChildVolWorkTechnic objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildVolWorkTechnic> Collection to store aggregation of ChildVolWorkTechnic objects.
     */
    protected $collVolWorkTechnics;
    protected $collVolWorkTechnicsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildProjectRole[]
     * @phpstan-var ObjectCollection&\Traversable<ChildProjectRole>
     */
    protected $projectRolesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildObjProject[]
     * @phpstan-var ObjectCollection&\Traversable<ChildObjProject>
     */
    protected $objProjectsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildObjSubproject[]
     * @phpstan-var ObjectCollection&\Traversable<ChildObjSubproject>
     */
    protected $objSubprojectsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildObjGroup[]
     * @phpstan-var ObjectCollection&\Traversable<ChildObjGroup>
     */
    protected $objGroupsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildObjHouse[]
     * @phpstan-var ObjectCollection&\Traversable<ChildObjHouse>
     */
    protected $objHousesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildObjStage[]
     * @phpstan-var ObjectCollection&\Traversable<ChildObjStage>
     */
    protected $objStagesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildObjStageWork[]
     * @phpstan-var ObjectCollection&\Traversable<ChildObjStageWork>
     */
    protected $objStageWorksScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildObjStageMaterial[]
     * @phpstan-var ObjectCollection&\Traversable<ChildObjStageMaterial>
     */
    protected $objStageMaterialsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildObjStageTechnic[]
     * @phpstan-var ObjectCollection&\Traversable<ChildObjStageTechnic>
     */
    protected $objStageTechnicsScheduledForDeletion = null;

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
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildVolWorkMaterial[]
     * @phpstan-var ObjectCollection&\Traversable<ChildVolWorkMaterial>
     */
    protected $volWorkMaterialsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildVolWorkTechnic[]
     * @phpstan-var ObjectCollection&\Traversable<ChildVolWorkTechnic>
     */
    protected $volWorkTechnicsScheduledForDeletion = null;

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
    }

    /**
     * Initializes internal state of DB\Base\Users object.
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
     * Compares this with another <code>Users</code> instance.  If
     * <code>obj</code> is an instance of <code>Users</code>, delegates to
     * <code>equals(Users)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [phone] column value.
     *
     * @return string|null
     */
    public function getPhone()
    {
        return $this->phone;
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
     * Get the [role_id] column value.
     * ID роли
     * @return int|null
     */
    public function getRoleId()
    {
        return $this->role_id;
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
            $this->modifiedColumns[UsersTableMap::COL_ID] = true;
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
            $this->modifiedColumns[UsersTableMap::COL_EMAIL] = true;
        }

        return $this;
    }

    /**
     * Set the value of [phone] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPhone($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->phone !== $v) {
            $this->phone = $v;
            $this->modifiedColumns[UsersTableMap::COL_PHONE] = true;
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
            $this->modifiedColumns[UsersTableMap::COL_PASSWORD] = true;
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
            $this->modifiedColumns[UsersTableMap::COL_USERNAME] = true;
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
            $this->modifiedColumns[UsersTableMap::COL_STATUS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [role_id] column.
     * ID роли
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setRoleId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->role_id !== $v) {
            $this->role_id = $v;
            $this->modifiedColumns[UsersTableMap::COL_ROLE_ID] = true;
        }

        if ($this->aUserRole !== null && $this->aUserRole->getId() !== $v) {
            $this->aUserRole = null;
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
            $this->modifiedColumns[UsersTableMap::COL_VERIFIED] = true;
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
            $this->modifiedColumns[UsersTableMap::COL_RESETTABLE] = true;
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
            $this->modifiedColumns[UsersTableMap::COL_ROLES_MASK] = true;
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
            $this->modifiedColumns[UsersTableMap::COL_REGISTERED] = true;
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
            $this->modifiedColumns[UsersTableMap::COL_LAST_LOGIN] = true;
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
            $this->modifiedColumns[UsersTableMap::COL_FORCE_LOGOUT] = true;
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
            $this->modifiedColumns[UsersTableMap::COL_IS_AVAILABLE] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : UsersTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : UsersTableMap::translateFieldName('Email', TableMap::TYPE_PHPNAME, $indexType)];
            $this->email = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : UsersTableMap::translateFieldName('Phone', TableMap::TYPE_PHPNAME, $indexType)];
            $this->phone = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : UsersTableMap::translateFieldName('Password', TableMap::TYPE_PHPNAME, $indexType)];
            $this->password = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : UsersTableMap::translateFieldName('Username', TableMap::TYPE_PHPNAME, $indexType)];
            $this->username = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : UsersTableMap::translateFieldName('Status', TableMap::TYPE_PHPNAME, $indexType)];
            $this->status = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : UsersTableMap::translateFieldName('RoleId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->role_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : UsersTableMap::translateFieldName('Verified', TableMap::TYPE_PHPNAME, $indexType)];
            $this->verified = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : UsersTableMap::translateFieldName('Resettable', TableMap::TYPE_PHPNAME, $indexType)];
            $this->resettable = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : UsersTableMap::translateFieldName('RolesMask', TableMap::TYPE_PHPNAME, $indexType)];
            $this->roles_mask = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : UsersTableMap::translateFieldName('Registered', TableMap::TYPE_PHPNAME, $indexType)];
            $this->registered = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : UsersTableMap::translateFieldName('LastLogin', TableMap::TYPE_PHPNAME, $indexType)];
            $this->last_login = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : UsersTableMap::translateFieldName('ForceLogout', TableMap::TYPE_PHPNAME, $indexType)];
            $this->force_logout = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : UsersTableMap::translateFieldName('IsAvailable', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_available = (null !== $col) ? (boolean) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 14; // 14 = UsersTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\DB\\Users'), 0, $e);
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
        if ($this->aUserRole !== null && $this->role_id !== $this->aUserRole->getId()) {
            $this->aUserRole = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(UsersTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildUsersQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aUserRole = null;
            $this->collProjectRoles = null;

            $this->collObjProjects = null;

            $this->collObjSubprojects = null;

            $this->collObjGroups = null;

            $this->collObjHouses = null;

            $this->collObjStages = null;

            $this->collObjStageWorks = null;

            $this->collObjStageMaterials = null;

            $this->collObjStageTechnics = null;

            $this->collVolMaterials = null;

            $this->collVolTechnics = null;

            $this->collVolWorks = null;

            $this->collVolWorkMaterials = null;

            $this->collVolWorkTechnics = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see Users::setDeleted()
     * @see Users::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsersTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildUsersQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(UsersTableMap::DATABASE_NAME);
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
                UsersTableMap::addInstanceToPool($this);
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

            if ($this->aUserRole !== null) {
                if ($this->aUserRole->isModified() || $this->aUserRole->isNew()) {
                    $affectedRows += $this->aUserRole->save($con);
                }
                $this->setUserRole($this->aUserRole);
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

            if ($this->projectRolesScheduledForDeletion !== null) {
                if (!$this->projectRolesScheduledForDeletion->isEmpty()) {
                    \DB\ProjectRoleQuery::create()
                        ->filterByPrimaryKeys($this->projectRolesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->projectRolesScheduledForDeletion = null;
                }
            }

            if ($this->collProjectRoles !== null) {
                foreach ($this->collProjectRoles as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->objProjectsScheduledForDeletion !== null) {
                if (!$this->objProjectsScheduledForDeletion->isEmpty()) {
                    \DB\ObjProjectQuery::create()
                        ->filterByPrimaryKeys($this->objProjectsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->objProjectsScheduledForDeletion = null;
                }
            }

            if ($this->collObjProjects !== null) {
                foreach ($this->collObjProjects as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->objSubprojectsScheduledForDeletion !== null) {
                if (!$this->objSubprojectsScheduledForDeletion->isEmpty()) {
                    \DB\ObjSubprojectQuery::create()
                        ->filterByPrimaryKeys($this->objSubprojectsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->objSubprojectsScheduledForDeletion = null;
                }
            }

            if ($this->collObjSubprojects !== null) {
                foreach ($this->collObjSubprojects as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->objGroupsScheduledForDeletion !== null) {
                if (!$this->objGroupsScheduledForDeletion->isEmpty()) {
                    \DB\ObjGroupQuery::create()
                        ->filterByPrimaryKeys($this->objGroupsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->objGroupsScheduledForDeletion = null;
                }
            }

            if ($this->collObjGroups !== null) {
                foreach ($this->collObjGroups as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
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

            if ($this->objStagesScheduledForDeletion !== null) {
                if (!$this->objStagesScheduledForDeletion->isEmpty()) {
                    \DB\ObjStageQuery::create()
                        ->filterByPrimaryKeys($this->objStagesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->objStagesScheduledForDeletion = null;
                }
            }

            if ($this->collObjStages !== null) {
                foreach ($this->collObjStages as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->objStageWorksScheduledForDeletion !== null) {
                if (!$this->objStageWorksScheduledForDeletion->isEmpty()) {
                    \DB\ObjStageWorkQuery::create()
                        ->filterByPrimaryKeys($this->objStageWorksScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->objStageWorksScheduledForDeletion = null;
                }
            }

            if ($this->collObjStageWorks !== null) {
                foreach ($this->collObjStageWorks as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->objStageMaterialsScheduledForDeletion !== null) {
                if (!$this->objStageMaterialsScheduledForDeletion->isEmpty()) {
                    \DB\ObjStageMaterialQuery::create()
                        ->filterByPrimaryKeys($this->objStageMaterialsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->objStageMaterialsScheduledForDeletion = null;
                }
            }

            if ($this->collObjStageMaterials !== null) {
                foreach ($this->collObjStageMaterials as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->objStageTechnicsScheduledForDeletion !== null) {
                if (!$this->objStageTechnicsScheduledForDeletion->isEmpty()) {
                    \DB\ObjStageTechnicQuery::create()
                        ->filterByPrimaryKeys($this->objStageTechnicsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->objStageTechnicsScheduledForDeletion = null;
                }
            }

            if ($this->collObjStageTechnics !== null) {
                foreach ($this->collObjStageTechnics as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
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

            if ($this->volWorkMaterialsScheduledForDeletion !== null) {
                if (!$this->volWorkMaterialsScheduledForDeletion->isEmpty()) {
                    \DB\VolWorkMaterialQuery::create()
                        ->filterByPrimaryKeys($this->volWorkMaterialsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->volWorkMaterialsScheduledForDeletion = null;
                }
            }

            if ($this->collVolWorkMaterials !== null) {
                foreach ($this->collVolWorkMaterials as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->volWorkTechnicsScheduledForDeletion !== null) {
                if (!$this->volWorkTechnicsScheduledForDeletion->isEmpty()) {
                    \DB\VolWorkTechnicQuery::create()
                        ->filterByPrimaryKeys($this->volWorkTechnicsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->volWorkTechnicsScheduledForDeletion = null;
                }
            }

            if ($this->collVolWorkTechnics !== null) {
                foreach ($this->collVolWorkTechnics as $referrerFK) {
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

        $this->modifiedColumns[UsersTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . UsersTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(UsersTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(UsersTableMap::COL_EMAIL)) {
            $modifiedColumns[':p' . $index++]  = 'email';
        }
        if ($this->isColumnModified(UsersTableMap::COL_PHONE)) {
            $modifiedColumns[':p' . $index++]  = 'phone';
        }
        if ($this->isColumnModified(UsersTableMap::COL_PASSWORD)) {
            $modifiedColumns[':p' . $index++]  = 'password';
        }
        if ($this->isColumnModified(UsersTableMap::COL_USERNAME)) {
            $modifiedColumns[':p' . $index++]  = 'username';
        }
        if ($this->isColumnModified(UsersTableMap::COL_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'status';
        }
        if ($this->isColumnModified(UsersTableMap::COL_ROLE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'role_id';
        }
        if ($this->isColumnModified(UsersTableMap::COL_VERIFIED)) {
            $modifiedColumns[':p' . $index++]  = 'verified';
        }
        if ($this->isColumnModified(UsersTableMap::COL_RESETTABLE)) {
            $modifiedColumns[':p' . $index++]  = 'resettable';
        }
        if ($this->isColumnModified(UsersTableMap::COL_ROLES_MASK)) {
            $modifiedColumns[':p' . $index++]  = 'roles_mask';
        }
        if ($this->isColumnModified(UsersTableMap::COL_REGISTERED)) {
            $modifiedColumns[':p' . $index++]  = 'registered';
        }
        if ($this->isColumnModified(UsersTableMap::COL_LAST_LOGIN)) {
            $modifiedColumns[':p' . $index++]  = 'last_login';
        }
        if ($this->isColumnModified(UsersTableMap::COL_FORCE_LOGOUT)) {
            $modifiedColumns[':p' . $index++]  = 'force_logout';
        }
        if ($this->isColumnModified(UsersTableMap::COL_IS_AVAILABLE)) {
            $modifiedColumns[':p' . $index++]  = 'is_available';
        }

        $sql = sprintf(
            'INSERT INTO users (%s) VALUES (%s)',
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
                    case 'phone':
                        $stmt->bindValue($identifier, $this->phone, PDO::PARAM_STR);
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
                    case 'role_id':
                        $stmt->bindValue($identifier, $this->role_id, PDO::PARAM_INT);
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
        $pos = UsersTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getPhone();

            case 3:
                return $this->getPassword();

            case 4:
                return $this->getUsername();

            case 5:
                return $this->getStatus();

            case 6:
                return $this->getRoleId();

            case 7:
                return $this->getVerified();

            case 8:
                return $this->getResettable();

            case 9:
                return $this->getRolesMask();

            case 10:
                return $this->getRegistered();

            case 11:
                return $this->getLastLogin();

            case 12:
                return $this->getForceLogout();

            case 13:
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
        if (isset($alreadyDumpedObjects['Users'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['Users'][$this->hashCode()] = true;
        $keys = UsersTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getId(),
            $keys[1] => $this->getEmail(),
            $keys[2] => $this->getPhone(),
            $keys[3] => $this->getPassword(),
            $keys[4] => $this->getUsername(),
            $keys[5] => $this->getStatus(),
            $keys[6] => $this->getRoleId(),
            $keys[7] => $this->getVerified(),
            $keys[8] => $this->getResettable(),
            $keys[9] => $this->getRolesMask(),
            $keys[10] => $this->getRegistered(),
            $keys[11] => $this->getLastLogin(),
            $keys[12] => $this->getForceLogout(),
            $keys[13] => $this->getIsAvailable(),
        ];
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aUserRole) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'userRole';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'user_role';
                        break;
                    default:
                        $key = 'UserRole';
                }

                $result[$key] = $this->aUserRole->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collProjectRoles) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'projectRoles';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'project_roles';
                        break;
                    default:
                        $key = 'ProjectRoles';
                }

                $result[$key] = $this->collProjectRoles->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collObjProjects) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'objProjects';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'obj_projects';
                        break;
                    default:
                        $key = 'ObjProjects';
                }

                $result[$key] = $this->collObjProjects->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collObjSubprojects) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'objSubprojects';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'obj_subprojects';
                        break;
                    default:
                        $key = 'ObjSubprojects';
                }

                $result[$key] = $this->collObjSubprojects->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collObjGroups) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'objGroups';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'obj_groups';
                        break;
                    default:
                        $key = 'ObjGroups';
                }

                $result[$key] = $this->collObjGroups->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
            if (null !== $this->collObjStages) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'objStages';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'obj_stages';
                        break;
                    default:
                        $key = 'ObjStages';
                }

                $result[$key] = $this->collObjStages->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collObjStageWorks) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'objStageWorks';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'obj_stage_works';
                        break;
                    default:
                        $key = 'ObjStageWorks';
                }

                $result[$key] = $this->collObjStageWorks->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collObjStageMaterials) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'objStageMaterials';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'obj_stage_materials';
                        break;
                    default:
                        $key = 'ObjStageMaterials';
                }

                $result[$key] = $this->collObjStageMaterials->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collObjStageTechnics) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'objStageTechnics';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'obj_stage_technics';
                        break;
                    default:
                        $key = 'ObjStageTechnics';
                }

                $result[$key] = $this->collObjStageTechnics->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
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
            if (null !== $this->collVolWorkMaterials) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'volWorkMaterials';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'vol_work_materials';
                        break;
                    default:
                        $key = 'VolWorkMaterials';
                }

                $result[$key] = $this->collVolWorkMaterials->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collVolWorkTechnics) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'volWorkTechnics';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'vol_work_technics';
                        break;
                    default:
                        $key = 'VolWorkTechnics';
                }

                $result[$key] = $this->collVolWorkTechnics->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = UsersTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setPhone($value);
                break;
            case 3:
                $this->setPassword($value);
                break;
            case 4:
                $this->setUsername($value);
                break;
            case 5:
                $this->setStatus($value);
                break;
            case 6:
                $this->setRoleId($value);
                break;
            case 7:
                $this->setVerified($value);
                break;
            case 8:
                $this->setResettable($value);
                break;
            case 9:
                $this->setRolesMask($value);
                break;
            case 10:
                $this->setRegistered($value);
                break;
            case 11:
                $this->setLastLogin($value);
                break;
            case 12:
                $this->setForceLogout($value);
                break;
            case 13:
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
        $keys = UsersTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setEmail($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setPhone($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setPassword($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setUsername($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setStatus($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setRoleId($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setVerified($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setResettable($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setRolesMask($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setRegistered($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setLastLogin($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setForceLogout($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setIsAvailable($arr[$keys[13]]);
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
        $criteria = new Criteria(UsersTableMap::DATABASE_NAME);

        if ($this->isColumnModified(UsersTableMap::COL_ID)) {
            $criteria->add(UsersTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(UsersTableMap::COL_EMAIL)) {
            $criteria->add(UsersTableMap::COL_EMAIL, $this->email);
        }
        if ($this->isColumnModified(UsersTableMap::COL_PHONE)) {
            $criteria->add(UsersTableMap::COL_PHONE, $this->phone);
        }
        if ($this->isColumnModified(UsersTableMap::COL_PASSWORD)) {
            $criteria->add(UsersTableMap::COL_PASSWORD, $this->password);
        }
        if ($this->isColumnModified(UsersTableMap::COL_USERNAME)) {
            $criteria->add(UsersTableMap::COL_USERNAME, $this->username);
        }
        if ($this->isColumnModified(UsersTableMap::COL_STATUS)) {
            $criteria->add(UsersTableMap::COL_STATUS, $this->status);
        }
        if ($this->isColumnModified(UsersTableMap::COL_ROLE_ID)) {
            $criteria->add(UsersTableMap::COL_ROLE_ID, $this->role_id);
        }
        if ($this->isColumnModified(UsersTableMap::COL_VERIFIED)) {
            $criteria->add(UsersTableMap::COL_VERIFIED, $this->verified);
        }
        if ($this->isColumnModified(UsersTableMap::COL_RESETTABLE)) {
            $criteria->add(UsersTableMap::COL_RESETTABLE, $this->resettable);
        }
        if ($this->isColumnModified(UsersTableMap::COL_ROLES_MASK)) {
            $criteria->add(UsersTableMap::COL_ROLES_MASK, $this->roles_mask);
        }
        if ($this->isColumnModified(UsersTableMap::COL_REGISTERED)) {
            $criteria->add(UsersTableMap::COL_REGISTERED, $this->registered);
        }
        if ($this->isColumnModified(UsersTableMap::COL_LAST_LOGIN)) {
            $criteria->add(UsersTableMap::COL_LAST_LOGIN, $this->last_login);
        }
        if ($this->isColumnModified(UsersTableMap::COL_FORCE_LOGOUT)) {
            $criteria->add(UsersTableMap::COL_FORCE_LOGOUT, $this->force_logout);
        }
        if ($this->isColumnModified(UsersTableMap::COL_IS_AVAILABLE)) {
            $criteria->add(UsersTableMap::COL_IS_AVAILABLE, $this->is_available);
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
        $criteria = ChildUsersQuery::create();
        $criteria->add(UsersTableMap::COL_ID, $this->id);

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
     * @param object $copyObj An object of \DB\Users (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setEmail($this->getEmail());
        $copyObj->setPhone($this->getPhone());
        $copyObj->setPassword($this->getPassword());
        $copyObj->setUsername($this->getUsername());
        $copyObj->setStatus($this->getStatus());
        $copyObj->setRoleId($this->getRoleId());
        $copyObj->setVerified($this->getVerified());
        $copyObj->setResettable($this->getResettable());
        $copyObj->setRolesMask($this->getRolesMask());
        $copyObj->setRegistered($this->getRegistered());
        $copyObj->setLastLogin($this->getLastLogin());
        $copyObj->setForceLogout($this->getForceLogout());
        $copyObj->setIsAvailable($this->getIsAvailable());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getProjectRoles() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addProjectRole($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getObjProjects() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addObjProject($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getObjSubprojects() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addObjSubproject($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getObjGroups() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addObjGroup($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getObjHouses() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addObjHouse($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getObjStages() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addObjStage($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getObjStageWorks() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addObjStageWork($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getObjStageMaterials() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addObjStageMaterial($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getObjStageTechnics() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addObjStageTechnic($relObj->copy($deepCopy));
                }
            }

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

            foreach ($this->getVolWorkMaterials() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addVolWorkMaterial($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getVolWorkTechnics() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addVolWorkTechnic($relObj->copy($deepCopy));
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
     * @return \DB\Users Clone of current object.
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
     * Declares an association between this object and a ChildUserRole object.
     *
     * @param ChildUserRole|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setUserRole(ChildUserRole $v = null)
    {
        if ($v === null) {
            $this->setRoleId(NULL);
        } else {
            $this->setRoleId($v->getId());
        }

        $this->aUserRole = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildUserRole object, it will not be re-added.
        if ($v !== null) {
            $v->addUsers($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildUserRole object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildUserRole|null The associated ChildUserRole object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getUserRole(?ConnectionInterface $con = null)
    {
        if ($this->aUserRole === null && ($this->role_id != 0)) {
            $this->aUserRole = ChildUserRoleQuery::create()->findPk($this->role_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aUserRole->addUserss($this);
             */
        }

        return $this->aUserRole;
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
        if ('ProjectRole' === $relationName) {
            $this->initProjectRoles();
            return;
        }
        if ('ObjProject' === $relationName) {
            $this->initObjProjects();
            return;
        }
        if ('ObjSubproject' === $relationName) {
            $this->initObjSubprojects();
            return;
        }
        if ('ObjGroup' === $relationName) {
            $this->initObjGroups();
            return;
        }
        if ('ObjHouse' === $relationName) {
            $this->initObjHouses();
            return;
        }
        if ('ObjStage' === $relationName) {
            $this->initObjStages();
            return;
        }
        if ('ObjStageWork' === $relationName) {
            $this->initObjStageWorks();
            return;
        }
        if ('ObjStageMaterial' === $relationName) {
            $this->initObjStageMaterials();
            return;
        }
        if ('ObjStageTechnic' === $relationName) {
            $this->initObjStageTechnics();
            return;
        }
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
        if ('VolWorkMaterial' === $relationName) {
            $this->initVolWorkMaterials();
            return;
        }
        if ('VolWorkTechnic' === $relationName) {
            $this->initVolWorkTechnics();
            return;
        }
    }

    /**
     * Clears out the collProjectRoles collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addProjectRoles()
     */
    public function clearProjectRoles()
    {
        $this->collProjectRoles = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collProjectRoles collection loaded partially.
     *
     * @return void
     */
    public function resetPartialProjectRoles($v = true): void
    {
        $this->collProjectRolesPartial = $v;
    }

    /**
     * Initializes the collProjectRoles collection.
     *
     * By default this just sets the collProjectRoles collection to an empty array (like clearcollProjectRoles());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initProjectRoles(bool $overrideExisting = true): void
    {
        if (null !== $this->collProjectRoles && !$overrideExisting) {
            return;
        }

        $collectionClassName = ProjectRoleTableMap::getTableMap()->getCollectionClassName();

        $this->collProjectRoles = new $collectionClassName;
        $this->collProjectRoles->setModel('\DB\ProjectRole');
    }

    /**
     * Gets an array of ChildProjectRole objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUsers is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildProjectRole[] List of ChildProjectRole objects
     * @phpstan-return ObjectCollection&\Traversable<ChildProjectRole> List of ChildProjectRole objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getProjectRoles(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collProjectRolesPartial && !$this->isNew();
        if (null === $this->collProjectRoles || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collProjectRoles) {
                    $this->initProjectRoles();
                } else {
                    $collectionClassName = ProjectRoleTableMap::getTableMap()->getCollectionClassName();

                    $collProjectRoles = new $collectionClassName;
                    $collProjectRoles->setModel('\DB\ProjectRole');

                    return $collProjectRoles;
                }
            } else {
                $collProjectRoles = ChildProjectRoleQuery::create(null, $criteria)
                    ->filterByUsers($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collProjectRolesPartial && count($collProjectRoles)) {
                        $this->initProjectRoles(false);

                        foreach ($collProjectRoles as $obj) {
                            if (false == $this->collProjectRoles->contains($obj)) {
                                $this->collProjectRoles->append($obj);
                            }
                        }

                        $this->collProjectRolesPartial = true;
                    }

                    return $collProjectRoles;
                }

                if ($partial && $this->collProjectRoles) {
                    foreach ($this->collProjectRoles as $obj) {
                        if ($obj->isNew()) {
                            $collProjectRoles[] = $obj;
                        }
                    }
                }

                $this->collProjectRoles = $collProjectRoles;
                $this->collProjectRolesPartial = false;
            }
        }

        return $this->collProjectRoles;
    }

    /**
     * Sets a collection of ChildProjectRole objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $projectRoles A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setProjectRoles(Collection $projectRoles, ?ConnectionInterface $con = null)
    {
        /** @var ChildProjectRole[] $projectRolesToDelete */
        $projectRolesToDelete = $this->getProjectRoles(new Criteria(), $con)->diff($projectRoles);


        $this->projectRolesScheduledForDeletion = $projectRolesToDelete;

        foreach ($projectRolesToDelete as $projectRoleRemoved) {
            $projectRoleRemoved->setUsers(null);
        }

        $this->collProjectRoles = null;
        foreach ($projectRoles as $projectRole) {
            $this->addProjectRole($projectRole);
        }

        $this->collProjectRoles = $projectRoles;
        $this->collProjectRolesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ProjectRole objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related ProjectRole objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countProjectRoles(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collProjectRolesPartial && !$this->isNew();
        if (null === $this->collProjectRoles || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collProjectRoles) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getProjectRoles());
            }

            $query = ChildProjectRoleQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUsers($this)
                ->count($con);
        }

        return count($this->collProjectRoles);
    }

    /**
     * Method called to associate a ChildProjectRole object to this object
     * through the ChildProjectRole foreign key attribute.
     *
     * @param ChildProjectRole $l ChildProjectRole
     * @return $this The current object (for fluent API support)
     */
    public function addProjectRole(ChildProjectRole $l)
    {
        if ($this->collProjectRoles === null) {
            $this->initProjectRoles();
            $this->collProjectRolesPartial = true;
        }

        if (!$this->collProjectRoles->contains($l)) {
            $this->doAddProjectRole($l);

            if ($this->projectRolesScheduledForDeletion and $this->projectRolesScheduledForDeletion->contains($l)) {
                $this->projectRolesScheduledForDeletion->remove($this->projectRolesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildProjectRole $projectRole The ChildProjectRole object to add.
     */
    protected function doAddProjectRole(ChildProjectRole $projectRole): void
    {
        $this->collProjectRoles[]= $projectRole;
        $projectRole->setUsers($this);
    }

    /**
     * @param ChildProjectRole $projectRole The ChildProjectRole object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeProjectRole(ChildProjectRole $projectRole)
    {
        if ($this->getProjectRoles()->contains($projectRole)) {
            $pos = $this->collProjectRoles->search($projectRole);
            $this->collProjectRoles->remove($pos);
            if (null === $this->projectRolesScheduledForDeletion) {
                $this->projectRolesScheduledForDeletion = clone $this->collProjectRoles;
                $this->projectRolesScheduledForDeletion->clear();
            }
            $this->projectRolesScheduledForDeletion[]= clone $projectRole;
            $projectRole->setUsers(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Users is new, it will return
     * an empty collection; or if this Users has previously
     * been saved, it will retrieve related ProjectRoles from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Users.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildProjectRole[] List of ChildProjectRole objects
     * @phpstan-return ObjectCollection&\Traversable<ChildProjectRole}> List of ChildProjectRole objects
     */
    public function getProjectRolesJoinObjProject(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildProjectRoleQuery::create(null, $criteria);
        $query->joinWith('ObjProject', $joinBehavior);

        return $this->getProjectRoles($query, $con);
    }

    /**
     * Clears out the collObjProjects collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addObjProjects()
     */
    public function clearObjProjects()
    {
        $this->collObjProjects = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collObjProjects collection loaded partially.
     *
     * @return void
     */
    public function resetPartialObjProjects($v = true): void
    {
        $this->collObjProjectsPartial = $v;
    }

    /**
     * Initializes the collObjProjects collection.
     *
     * By default this just sets the collObjProjects collection to an empty array (like clearcollObjProjects());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initObjProjects(bool $overrideExisting = true): void
    {
        if (null !== $this->collObjProjects && !$overrideExisting) {
            return;
        }

        $collectionClassName = ObjProjectTableMap::getTableMap()->getCollectionClassName();

        $this->collObjProjects = new $collectionClassName;
        $this->collObjProjects->setModel('\DB\ObjProject');
    }

    /**
     * Gets an array of ChildObjProject objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUsers is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildObjProject[] List of ChildObjProject objects
     * @phpstan-return ObjectCollection&\Traversable<ChildObjProject> List of ChildObjProject objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getObjProjects(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collObjProjectsPartial && !$this->isNew();
        if (null === $this->collObjProjects || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collObjProjects) {
                    $this->initObjProjects();
                } else {
                    $collectionClassName = ObjProjectTableMap::getTableMap()->getCollectionClassName();

                    $collObjProjects = new $collectionClassName;
                    $collObjProjects->setModel('\DB\ObjProject');

                    return $collObjProjects;
                }
            } else {
                $collObjProjects = ChildObjProjectQuery::create(null, $criteria)
                    ->filterByUsers($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collObjProjectsPartial && count($collObjProjects)) {
                        $this->initObjProjects(false);

                        foreach ($collObjProjects as $obj) {
                            if (false == $this->collObjProjects->contains($obj)) {
                                $this->collObjProjects->append($obj);
                            }
                        }

                        $this->collObjProjectsPartial = true;
                    }

                    return $collObjProjects;
                }

                if ($partial && $this->collObjProjects) {
                    foreach ($this->collObjProjects as $obj) {
                        if ($obj->isNew()) {
                            $collObjProjects[] = $obj;
                        }
                    }
                }

                $this->collObjProjects = $collObjProjects;
                $this->collObjProjectsPartial = false;
            }
        }

        return $this->collObjProjects;
    }

    /**
     * Sets a collection of ChildObjProject objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $objProjects A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setObjProjects(Collection $objProjects, ?ConnectionInterface $con = null)
    {
        /** @var ChildObjProject[] $objProjectsToDelete */
        $objProjectsToDelete = $this->getObjProjects(new Criteria(), $con)->diff($objProjects);


        $this->objProjectsScheduledForDeletion = $objProjectsToDelete;

        foreach ($objProjectsToDelete as $objProjectRemoved) {
            $objProjectRemoved->setUsers(null);
        }

        $this->collObjProjects = null;
        foreach ($objProjects as $objProject) {
            $this->addObjProject($objProject);
        }

        $this->collObjProjects = $objProjects;
        $this->collObjProjectsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ObjProject objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related ObjProject objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countObjProjects(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collObjProjectsPartial && !$this->isNew();
        if (null === $this->collObjProjects || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collObjProjects) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getObjProjects());
            }

            $query = ChildObjProjectQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUsers($this)
                ->count($con);
        }

        return count($this->collObjProjects);
    }

    /**
     * Method called to associate a ChildObjProject object to this object
     * through the ChildObjProject foreign key attribute.
     *
     * @param ChildObjProject $l ChildObjProject
     * @return $this The current object (for fluent API support)
     */
    public function addObjProject(ChildObjProject $l)
    {
        if ($this->collObjProjects === null) {
            $this->initObjProjects();
            $this->collObjProjectsPartial = true;
        }

        if (!$this->collObjProjects->contains($l)) {
            $this->doAddObjProject($l);

            if ($this->objProjectsScheduledForDeletion and $this->objProjectsScheduledForDeletion->contains($l)) {
                $this->objProjectsScheduledForDeletion->remove($this->objProjectsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildObjProject $objProject The ChildObjProject object to add.
     */
    protected function doAddObjProject(ChildObjProject $objProject): void
    {
        $this->collObjProjects[]= $objProject;
        $objProject->setUsers($this);
    }

    /**
     * @param ChildObjProject $objProject The ChildObjProject object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeObjProject(ChildObjProject $objProject)
    {
        if ($this->getObjProjects()->contains($objProject)) {
            $pos = $this->collObjProjects->search($objProject);
            $this->collObjProjects->remove($pos);
            if (null === $this->objProjectsScheduledForDeletion) {
                $this->objProjectsScheduledForDeletion = clone $this->collObjProjects;
                $this->objProjectsScheduledForDeletion->clear();
            }
            $this->objProjectsScheduledForDeletion[]= clone $objProject;
            $objProject->setUsers(null);
        }

        return $this;
    }

    /**
     * Clears out the collObjSubprojects collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addObjSubprojects()
     */
    public function clearObjSubprojects()
    {
        $this->collObjSubprojects = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collObjSubprojects collection loaded partially.
     *
     * @return void
     */
    public function resetPartialObjSubprojects($v = true): void
    {
        $this->collObjSubprojectsPartial = $v;
    }

    /**
     * Initializes the collObjSubprojects collection.
     *
     * By default this just sets the collObjSubprojects collection to an empty array (like clearcollObjSubprojects());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initObjSubprojects(bool $overrideExisting = true): void
    {
        if (null !== $this->collObjSubprojects && !$overrideExisting) {
            return;
        }

        $collectionClassName = ObjSubprojectTableMap::getTableMap()->getCollectionClassName();

        $this->collObjSubprojects = new $collectionClassName;
        $this->collObjSubprojects->setModel('\DB\ObjSubproject');
    }

    /**
     * Gets an array of ChildObjSubproject objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUsers is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildObjSubproject[] List of ChildObjSubproject objects
     * @phpstan-return ObjectCollection&\Traversable<ChildObjSubproject> List of ChildObjSubproject objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getObjSubprojects(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collObjSubprojectsPartial && !$this->isNew();
        if (null === $this->collObjSubprojects || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collObjSubprojects) {
                    $this->initObjSubprojects();
                } else {
                    $collectionClassName = ObjSubprojectTableMap::getTableMap()->getCollectionClassName();

                    $collObjSubprojects = new $collectionClassName;
                    $collObjSubprojects->setModel('\DB\ObjSubproject');

                    return $collObjSubprojects;
                }
            } else {
                $collObjSubprojects = ChildObjSubprojectQuery::create(null, $criteria)
                    ->filterByUsers($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collObjSubprojectsPartial && count($collObjSubprojects)) {
                        $this->initObjSubprojects(false);

                        foreach ($collObjSubprojects as $obj) {
                            if (false == $this->collObjSubprojects->contains($obj)) {
                                $this->collObjSubprojects->append($obj);
                            }
                        }

                        $this->collObjSubprojectsPartial = true;
                    }

                    return $collObjSubprojects;
                }

                if ($partial && $this->collObjSubprojects) {
                    foreach ($this->collObjSubprojects as $obj) {
                        if ($obj->isNew()) {
                            $collObjSubprojects[] = $obj;
                        }
                    }
                }

                $this->collObjSubprojects = $collObjSubprojects;
                $this->collObjSubprojectsPartial = false;
            }
        }

        return $this->collObjSubprojects;
    }

    /**
     * Sets a collection of ChildObjSubproject objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $objSubprojects A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setObjSubprojects(Collection $objSubprojects, ?ConnectionInterface $con = null)
    {
        /** @var ChildObjSubproject[] $objSubprojectsToDelete */
        $objSubprojectsToDelete = $this->getObjSubprojects(new Criteria(), $con)->diff($objSubprojects);


        $this->objSubprojectsScheduledForDeletion = $objSubprojectsToDelete;

        foreach ($objSubprojectsToDelete as $objSubprojectRemoved) {
            $objSubprojectRemoved->setUsers(null);
        }

        $this->collObjSubprojects = null;
        foreach ($objSubprojects as $objSubproject) {
            $this->addObjSubproject($objSubproject);
        }

        $this->collObjSubprojects = $objSubprojects;
        $this->collObjSubprojectsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ObjSubproject objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related ObjSubproject objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countObjSubprojects(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collObjSubprojectsPartial && !$this->isNew();
        if (null === $this->collObjSubprojects || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collObjSubprojects) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getObjSubprojects());
            }

            $query = ChildObjSubprojectQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUsers($this)
                ->count($con);
        }

        return count($this->collObjSubprojects);
    }

    /**
     * Method called to associate a ChildObjSubproject object to this object
     * through the ChildObjSubproject foreign key attribute.
     *
     * @param ChildObjSubproject $l ChildObjSubproject
     * @return $this The current object (for fluent API support)
     */
    public function addObjSubproject(ChildObjSubproject $l)
    {
        if ($this->collObjSubprojects === null) {
            $this->initObjSubprojects();
            $this->collObjSubprojectsPartial = true;
        }

        if (!$this->collObjSubprojects->contains($l)) {
            $this->doAddObjSubproject($l);

            if ($this->objSubprojectsScheduledForDeletion and $this->objSubprojectsScheduledForDeletion->contains($l)) {
                $this->objSubprojectsScheduledForDeletion->remove($this->objSubprojectsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildObjSubproject $objSubproject The ChildObjSubproject object to add.
     */
    protected function doAddObjSubproject(ChildObjSubproject $objSubproject): void
    {
        $this->collObjSubprojects[]= $objSubproject;
        $objSubproject->setUsers($this);
    }

    /**
     * @param ChildObjSubproject $objSubproject The ChildObjSubproject object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeObjSubproject(ChildObjSubproject $objSubproject)
    {
        if ($this->getObjSubprojects()->contains($objSubproject)) {
            $pos = $this->collObjSubprojects->search($objSubproject);
            $this->collObjSubprojects->remove($pos);
            if (null === $this->objSubprojectsScheduledForDeletion) {
                $this->objSubprojectsScheduledForDeletion = clone $this->collObjSubprojects;
                $this->objSubprojectsScheduledForDeletion->clear();
            }
            $this->objSubprojectsScheduledForDeletion[]= clone $objSubproject;
            $objSubproject->setUsers(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Users is new, it will return
     * an empty collection; or if this Users has previously
     * been saved, it will retrieve related ObjSubprojects from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Users.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildObjSubproject[] List of ChildObjSubproject objects
     * @phpstan-return ObjectCollection&\Traversable<ChildObjSubproject}> List of ChildObjSubproject objects
     */
    public function getObjSubprojectsJoinObjProject(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildObjSubprojectQuery::create(null, $criteria);
        $query->joinWith('ObjProject', $joinBehavior);

        return $this->getObjSubprojects($query, $con);
    }

    /**
     * Clears out the collObjGroups collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addObjGroups()
     */
    public function clearObjGroups()
    {
        $this->collObjGroups = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collObjGroups collection loaded partially.
     *
     * @return void
     */
    public function resetPartialObjGroups($v = true): void
    {
        $this->collObjGroupsPartial = $v;
    }

    /**
     * Initializes the collObjGroups collection.
     *
     * By default this just sets the collObjGroups collection to an empty array (like clearcollObjGroups());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initObjGroups(bool $overrideExisting = true): void
    {
        if (null !== $this->collObjGroups && !$overrideExisting) {
            return;
        }

        $collectionClassName = ObjGroupTableMap::getTableMap()->getCollectionClassName();

        $this->collObjGroups = new $collectionClassName;
        $this->collObjGroups->setModel('\DB\ObjGroup');
    }

    /**
     * Gets an array of ChildObjGroup objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUsers is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildObjGroup[] List of ChildObjGroup objects
     * @phpstan-return ObjectCollection&\Traversable<ChildObjGroup> List of ChildObjGroup objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getObjGroups(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collObjGroupsPartial && !$this->isNew();
        if (null === $this->collObjGroups || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collObjGroups) {
                    $this->initObjGroups();
                } else {
                    $collectionClassName = ObjGroupTableMap::getTableMap()->getCollectionClassName();

                    $collObjGroups = new $collectionClassName;
                    $collObjGroups->setModel('\DB\ObjGroup');

                    return $collObjGroups;
                }
            } else {
                $collObjGroups = ChildObjGroupQuery::create(null, $criteria)
                    ->filterByUsers($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collObjGroupsPartial && count($collObjGroups)) {
                        $this->initObjGroups(false);

                        foreach ($collObjGroups as $obj) {
                            if (false == $this->collObjGroups->contains($obj)) {
                                $this->collObjGroups->append($obj);
                            }
                        }

                        $this->collObjGroupsPartial = true;
                    }

                    return $collObjGroups;
                }

                if ($partial && $this->collObjGroups) {
                    foreach ($this->collObjGroups as $obj) {
                        if ($obj->isNew()) {
                            $collObjGroups[] = $obj;
                        }
                    }
                }

                $this->collObjGroups = $collObjGroups;
                $this->collObjGroupsPartial = false;
            }
        }

        return $this->collObjGroups;
    }

    /**
     * Sets a collection of ChildObjGroup objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $objGroups A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setObjGroups(Collection $objGroups, ?ConnectionInterface $con = null)
    {
        /** @var ChildObjGroup[] $objGroupsToDelete */
        $objGroupsToDelete = $this->getObjGroups(new Criteria(), $con)->diff($objGroups);


        $this->objGroupsScheduledForDeletion = $objGroupsToDelete;

        foreach ($objGroupsToDelete as $objGroupRemoved) {
            $objGroupRemoved->setUsers(null);
        }

        $this->collObjGroups = null;
        foreach ($objGroups as $objGroup) {
            $this->addObjGroup($objGroup);
        }

        $this->collObjGroups = $objGroups;
        $this->collObjGroupsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ObjGroup objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related ObjGroup objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countObjGroups(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collObjGroupsPartial && !$this->isNew();
        if (null === $this->collObjGroups || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collObjGroups) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getObjGroups());
            }

            $query = ChildObjGroupQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUsers($this)
                ->count($con);
        }

        return count($this->collObjGroups);
    }

    /**
     * Method called to associate a ChildObjGroup object to this object
     * through the ChildObjGroup foreign key attribute.
     *
     * @param ChildObjGroup $l ChildObjGroup
     * @return $this The current object (for fluent API support)
     */
    public function addObjGroup(ChildObjGroup $l)
    {
        if ($this->collObjGroups === null) {
            $this->initObjGroups();
            $this->collObjGroupsPartial = true;
        }

        if (!$this->collObjGroups->contains($l)) {
            $this->doAddObjGroup($l);

            if ($this->objGroupsScheduledForDeletion and $this->objGroupsScheduledForDeletion->contains($l)) {
                $this->objGroupsScheduledForDeletion->remove($this->objGroupsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildObjGroup $objGroup The ChildObjGroup object to add.
     */
    protected function doAddObjGroup(ChildObjGroup $objGroup): void
    {
        $this->collObjGroups[]= $objGroup;
        $objGroup->setUsers($this);
    }

    /**
     * @param ChildObjGroup $objGroup The ChildObjGroup object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeObjGroup(ChildObjGroup $objGroup)
    {
        if ($this->getObjGroups()->contains($objGroup)) {
            $pos = $this->collObjGroups->search($objGroup);
            $this->collObjGroups->remove($pos);
            if (null === $this->objGroupsScheduledForDeletion) {
                $this->objGroupsScheduledForDeletion = clone $this->collObjGroups;
                $this->objGroupsScheduledForDeletion->clear();
            }
            $this->objGroupsScheduledForDeletion[]= clone $objGroup;
            $objGroup->setUsers(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Users is new, it will return
     * an empty collection; or if this Users has previously
     * been saved, it will retrieve related ObjGroups from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Users.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildObjGroup[] List of ChildObjGroup objects
     * @phpstan-return ObjectCollection&\Traversable<ChildObjGroup}> List of ChildObjGroup objects
     */
    public function getObjGroupsJoinObjSubproject(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildObjGroupQuery::create(null, $criteria);
        $query->joinWith('ObjSubproject', $joinBehavior);

        return $this->getObjGroups($query, $con);
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
     * If this ChildUsers is new, it will return
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
                    ->filterByUsers($this)
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
            $objHouseRemoved->setUsers(null);
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
                ->filterByUsers($this)
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
        $objHouse->setUsers($this);
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
            $objHouse->setUsers(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Users is new, it will return
     * an empty collection; or if this Users has previously
     * been saved, it will retrieve related ObjHouses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Users.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildObjHouse[] List of ChildObjHouse objects
     * @phpstan-return ObjectCollection&\Traversable<ChildObjHouse}> List of ChildObjHouse objects
     */
    public function getObjHousesJoinObjGroup(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildObjHouseQuery::create(null, $criteria);
        $query->joinWith('ObjGroup', $joinBehavior);

        return $this->getObjHouses($query, $con);
    }

    /**
     * Clears out the collObjStages collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addObjStages()
     */
    public function clearObjStages()
    {
        $this->collObjStages = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collObjStages collection loaded partially.
     *
     * @return void
     */
    public function resetPartialObjStages($v = true): void
    {
        $this->collObjStagesPartial = $v;
    }

    /**
     * Initializes the collObjStages collection.
     *
     * By default this just sets the collObjStages collection to an empty array (like clearcollObjStages());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initObjStages(bool $overrideExisting = true): void
    {
        if (null !== $this->collObjStages && !$overrideExisting) {
            return;
        }

        $collectionClassName = ObjStageTableMap::getTableMap()->getCollectionClassName();

        $this->collObjStages = new $collectionClassName;
        $this->collObjStages->setModel('\DB\ObjStage');
    }

    /**
     * Gets an array of ChildObjStage objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUsers is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildObjStage[] List of ChildObjStage objects
     * @phpstan-return ObjectCollection&\Traversable<ChildObjStage> List of ChildObjStage objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getObjStages(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collObjStagesPartial && !$this->isNew();
        if (null === $this->collObjStages || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collObjStages) {
                    $this->initObjStages();
                } else {
                    $collectionClassName = ObjStageTableMap::getTableMap()->getCollectionClassName();

                    $collObjStages = new $collectionClassName;
                    $collObjStages->setModel('\DB\ObjStage');

                    return $collObjStages;
                }
            } else {
                $collObjStages = ChildObjStageQuery::create(null, $criteria)
                    ->filterByUsers($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collObjStagesPartial && count($collObjStages)) {
                        $this->initObjStages(false);

                        foreach ($collObjStages as $obj) {
                            if (false == $this->collObjStages->contains($obj)) {
                                $this->collObjStages->append($obj);
                            }
                        }

                        $this->collObjStagesPartial = true;
                    }

                    return $collObjStages;
                }

                if ($partial && $this->collObjStages) {
                    foreach ($this->collObjStages as $obj) {
                        if ($obj->isNew()) {
                            $collObjStages[] = $obj;
                        }
                    }
                }

                $this->collObjStages = $collObjStages;
                $this->collObjStagesPartial = false;
            }
        }

        return $this->collObjStages;
    }

    /**
     * Sets a collection of ChildObjStage objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $objStages A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setObjStages(Collection $objStages, ?ConnectionInterface $con = null)
    {
        /** @var ChildObjStage[] $objStagesToDelete */
        $objStagesToDelete = $this->getObjStages(new Criteria(), $con)->diff($objStages);


        $this->objStagesScheduledForDeletion = $objStagesToDelete;

        foreach ($objStagesToDelete as $objStageRemoved) {
            $objStageRemoved->setUsers(null);
        }

        $this->collObjStages = null;
        foreach ($objStages as $objStage) {
            $this->addObjStage($objStage);
        }

        $this->collObjStages = $objStages;
        $this->collObjStagesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ObjStage objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related ObjStage objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countObjStages(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collObjStagesPartial && !$this->isNew();
        if (null === $this->collObjStages || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collObjStages) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getObjStages());
            }

            $query = ChildObjStageQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUsers($this)
                ->count($con);
        }

        return count($this->collObjStages);
    }

    /**
     * Method called to associate a ChildObjStage object to this object
     * through the ChildObjStage foreign key attribute.
     *
     * @param ChildObjStage $l ChildObjStage
     * @return $this The current object (for fluent API support)
     */
    public function addObjStage(ChildObjStage $l)
    {
        if ($this->collObjStages === null) {
            $this->initObjStages();
            $this->collObjStagesPartial = true;
        }

        if (!$this->collObjStages->contains($l)) {
            $this->doAddObjStage($l);

            if ($this->objStagesScheduledForDeletion and $this->objStagesScheduledForDeletion->contains($l)) {
                $this->objStagesScheduledForDeletion->remove($this->objStagesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildObjStage $objStage The ChildObjStage object to add.
     */
    protected function doAddObjStage(ChildObjStage $objStage): void
    {
        $this->collObjStages[]= $objStage;
        $objStage->setUsers($this);
    }

    /**
     * @param ChildObjStage $objStage The ChildObjStage object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeObjStage(ChildObjStage $objStage)
    {
        if ($this->getObjStages()->contains($objStage)) {
            $pos = $this->collObjStages->search($objStage);
            $this->collObjStages->remove($pos);
            if (null === $this->objStagesScheduledForDeletion) {
                $this->objStagesScheduledForDeletion = clone $this->collObjStages;
                $this->objStagesScheduledForDeletion->clear();
            }
            $this->objStagesScheduledForDeletion[]= clone $objStage;
            $objStage->setUsers(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Users is new, it will return
     * an empty collection; or if this Users has previously
     * been saved, it will retrieve related ObjStages from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Users.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildObjStage[] List of ChildObjStage objects
     * @phpstan-return ObjectCollection&\Traversable<ChildObjStage}> List of ChildObjStage objects
     */
    public function getObjStagesJoinObjHouse(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildObjStageQuery::create(null, $criteria);
        $query->joinWith('ObjHouse', $joinBehavior);

        return $this->getObjStages($query, $con);
    }

    /**
     * Clears out the collObjStageWorks collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addObjStageWorks()
     */
    public function clearObjStageWorks()
    {
        $this->collObjStageWorks = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collObjStageWorks collection loaded partially.
     *
     * @return void
     */
    public function resetPartialObjStageWorks($v = true): void
    {
        $this->collObjStageWorksPartial = $v;
    }

    /**
     * Initializes the collObjStageWorks collection.
     *
     * By default this just sets the collObjStageWorks collection to an empty array (like clearcollObjStageWorks());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initObjStageWorks(bool $overrideExisting = true): void
    {
        if (null !== $this->collObjStageWorks && !$overrideExisting) {
            return;
        }

        $collectionClassName = ObjStageWorkTableMap::getTableMap()->getCollectionClassName();

        $this->collObjStageWorks = new $collectionClassName;
        $this->collObjStageWorks->setModel('\DB\ObjStageWork');
    }

    /**
     * Gets an array of ChildObjStageWork objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUsers is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildObjStageWork[] List of ChildObjStageWork objects
     * @phpstan-return ObjectCollection&\Traversable<ChildObjStageWork> List of ChildObjStageWork objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getObjStageWorks(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collObjStageWorksPartial && !$this->isNew();
        if (null === $this->collObjStageWorks || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collObjStageWorks) {
                    $this->initObjStageWorks();
                } else {
                    $collectionClassName = ObjStageWorkTableMap::getTableMap()->getCollectionClassName();

                    $collObjStageWorks = new $collectionClassName;
                    $collObjStageWorks->setModel('\DB\ObjStageWork');

                    return $collObjStageWorks;
                }
            } else {
                $collObjStageWorks = ChildObjStageWorkQuery::create(null, $criteria)
                    ->filterByUsers($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collObjStageWorksPartial && count($collObjStageWorks)) {
                        $this->initObjStageWorks(false);

                        foreach ($collObjStageWorks as $obj) {
                            if (false == $this->collObjStageWorks->contains($obj)) {
                                $this->collObjStageWorks->append($obj);
                            }
                        }

                        $this->collObjStageWorksPartial = true;
                    }

                    return $collObjStageWorks;
                }

                if ($partial && $this->collObjStageWorks) {
                    foreach ($this->collObjStageWorks as $obj) {
                        if ($obj->isNew()) {
                            $collObjStageWorks[] = $obj;
                        }
                    }
                }

                $this->collObjStageWorks = $collObjStageWorks;
                $this->collObjStageWorksPartial = false;
            }
        }

        return $this->collObjStageWorks;
    }

    /**
     * Sets a collection of ChildObjStageWork objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $objStageWorks A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setObjStageWorks(Collection $objStageWorks, ?ConnectionInterface $con = null)
    {
        /** @var ChildObjStageWork[] $objStageWorksToDelete */
        $objStageWorksToDelete = $this->getObjStageWorks(new Criteria(), $con)->diff($objStageWorks);


        $this->objStageWorksScheduledForDeletion = $objStageWorksToDelete;

        foreach ($objStageWorksToDelete as $objStageWorkRemoved) {
            $objStageWorkRemoved->setUsers(null);
        }

        $this->collObjStageWorks = null;
        foreach ($objStageWorks as $objStageWork) {
            $this->addObjStageWork($objStageWork);
        }

        $this->collObjStageWorks = $objStageWorks;
        $this->collObjStageWorksPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ObjStageWork objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related ObjStageWork objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countObjStageWorks(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collObjStageWorksPartial && !$this->isNew();
        if (null === $this->collObjStageWorks || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collObjStageWorks) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getObjStageWorks());
            }

            $query = ChildObjStageWorkQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUsers($this)
                ->count($con);
        }

        return count($this->collObjStageWorks);
    }

    /**
     * Method called to associate a ChildObjStageWork object to this object
     * through the ChildObjStageWork foreign key attribute.
     *
     * @param ChildObjStageWork $l ChildObjStageWork
     * @return $this The current object (for fluent API support)
     */
    public function addObjStageWork(ChildObjStageWork $l)
    {
        if ($this->collObjStageWorks === null) {
            $this->initObjStageWorks();
            $this->collObjStageWorksPartial = true;
        }

        if (!$this->collObjStageWorks->contains($l)) {
            $this->doAddObjStageWork($l);

            if ($this->objStageWorksScheduledForDeletion and $this->objStageWorksScheduledForDeletion->contains($l)) {
                $this->objStageWorksScheduledForDeletion->remove($this->objStageWorksScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildObjStageWork $objStageWork The ChildObjStageWork object to add.
     */
    protected function doAddObjStageWork(ChildObjStageWork $objStageWork): void
    {
        $this->collObjStageWorks[]= $objStageWork;
        $objStageWork->setUsers($this);
    }

    /**
     * @param ChildObjStageWork $objStageWork The ChildObjStageWork object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeObjStageWork(ChildObjStageWork $objStageWork)
    {
        if ($this->getObjStageWorks()->contains($objStageWork)) {
            $pos = $this->collObjStageWorks->search($objStageWork);
            $this->collObjStageWorks->remove($pos);
            if (null === $this->objStageWorksScheduledForDeletion) {
                $this->objStageWorksScheduledForDeletion = clone $this->collObjStageWorks;
                $this->objStageWorksScheduledForDeletion->clear();
            }
            $this->objStageWorksScheduledForDeletion[]= clone $objStageWork;
            $objStageWork->setUsers(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Users is new, it will return
     * an empty collection; or if this Users has previously
     * been saved, it will retrieve related ObjStageWorks from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Users.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildObjStageWork[] List of ChildObjStageWork objects
     * @phpstan-return ObjectCollection&\Traversable<ChildObjStageWork}> List of ChildObjStageWork objects
     */
    public function getObjStageWorksJoinVolWork(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildObjStageWorkQuery::create(null, $criteria);
        $query->joinWith('VolWork', $joinBehavior);

        return $this->getObjStageWorks($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Users is new, it will return
     * an empty collection; or if this Users has previously
     * been saved, it will retrieve related ObjStageWorks from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Users.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildObjStageWork[] List of ChildObjStageWork objects
     * @phpstan-return ObjectCollection&\Traversable<ChildObjStageWork}> List of ChildObjStageWork objects
     */
    public function getObjStageWorksJoinObjStage(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildObjStageWorkQuery::create(null, $criteria);
        $query->joinWith('ObjStage', $joinBehavior);

        return $this->getObjStageWorks($query, $con);
    }

    /**
     * Clears out the collObjStageMaterials collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addObjStageMaterials()
     */
    public function clearObjStageMaterials()
    {
        $this->collObjStageMaterials = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collObjStageMaterials collection loaded partially.
     *
     * @return void
     */
    public function resetPartialObjStageMaterials($v = true): void
    {
        $this->collObjStageMaterialsPartial = $v;
    }

    /**
     * Initializes the collObjStageMaterials collection.
     *
     * By default this just sets the collObjStageMaterials collection to an empty array (like clearcollObjStageMaterials());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initObjStageMaterials(bool $overrideExisting = true): void
    {
        if (null !== $this->collObjStageMaterials && !$overrideExisting) {
            return;
        }

        $collectionClassName = ObjStageMaterialTableMap::getTableMap()->getCollectionClassName();

        $this->collObjStageMaterials = new $collectionClassName;
        $this->collObjStageMaterials->setModel('\DB\ObjStageMaterial');
    }

    /**
     * Gets an array of ChildObjStageMaterial objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUsers is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildObjStageMaterial[] List of ChildObjStageMaterial objects
     * @phpstan-return ObjectCollection&\Traversable<ChildObjStageMaterial> List of ChildObjStageMaterial objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getObjStageMaterials(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collObjStageMaterialsPartial && !$this->isNew();
        if (null === $this->collObjStageMaterials || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collObjStageMaterials) {
                    $this->initObjStageMaterials();
                } else {
                    $collectionClassName = ObjStageMaterialTableMap::getTableMap()->getCollectionClassName();

                    $collObjStageMaterials = new $collectionClassName;
                    $collObjStageMaterials->setModel('\DB\ObjStageMaterial');

                    return $collObjStageMaterials;
                }
            } else {
                $collObjStageMaterials = ChildObjStageMaterialQuery::create(null, $criteria)
                    ->filterByUsers($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collObjStageMaterialsPartial && count($collObjStageMaterials)) {
                        $this->initObjStageMaterials(false);

                        foreach ($collObjStageMaterials as $obj) {
                            if (false == $this->collObjStageMaterials->contains($obj)) {
                                $this->collObjStageMaterials->append($obj);
                            }
                        }

                        $this->collObjStageMaterialsPartial = true;
                    }

                    return $collObjStageMaterials;
                }

                if ($partial && $this->collObjStageMaterials) {
                    foreach ($this->collObjStageMaterials as $obj) {
                        if ($obj->isNew()) {
                            $collObjStageMaterials[] = $obj;
                        }
                    }
                }

                $this->collObjStageMaterials = $collObjStageMaterials;
                $this->collObjStageMaterialsPartial = false;
            }
        }

        return $this->collObjStageMaterials;
    }

    /**
     * Sets a collection of ChildObjStageMaterial objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $objStageMaterials A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setObjStageMaterials(Collection $objStageMaterials, ?ConnectionInterface $con = null)
    {
        /** @var ChildObjStageMaterial[] $objStageMaterialsToDelete */
        $objStageMaterialsToDelete = $this->getObjStageMaterials(new Criteria(), $con)->diff($objStageMaterials);


        $this->objStageMaterialsScheduledForDeletion = $objStageMaterialsToDelete;

        foreach ($objStageMaterialsToDelete as $objStageMaterialRemoved) {
            $objStageMaterialRemoved->setUsers(null);
        }

        $this->collObjStageMaterials = null;
        foreach ($objStageMaterials as $objStageMaterial) {
            $this->addObjStageMaterial($objStageMaterial);
        }

        $this->collObjStageMaterials = $objStageMaterials;
        $this->collObjStageMaterialsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ObjStageMaterial objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related ObjStageMaterial objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countObjStageMaterials(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collObjStageMaterialsPartial && !$this->isNew();
        if (null === $this->collObjStageMaterials || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collObjStageMaterials) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getObjStageMaterials());
            }

            $query = ChildObjStageMaterialQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUsers($this)
                ->count($con);
        }

        return count($this->collObjStageMaterials);
    }

    /**
     * Method called to associate a ChildObjStageMaterial object to this object
     * through the ChildObjStageMaterial foreign key attribute.
     *
     * @param ChildObjStageMaterial $l ChildObjStageMaterial
     * @return $this The current object (for fluent API support)
     */
    public function addObjStageMaterial(ChildObjStageMaterial $l)
    {
        if ($this->collObjStageMaterials === null) {
            $this->initObjStageMaterials();
            $this->collObjStageMaterialsPartial = true;
        }

        if (!$this->collObjStageMaterials->contains($l)) {
            $this->doAddObjStageMaterial($l);

            if ($this->objStageMaterialsScheduledForDeletion and $this->objStageMaterialsScheduledForDeletion->contains($l)) {
                $this->objStageMaterialsScheduledForDeletion->remove($this->objStageMaterialsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildObjStageMaterial $objStageMaterial The ChildObjStageMaterial object to add.
     */
    protected function doAddObjStageMaterial(ChildObjStageMaterial $objStageMaterial): void
    {
        $this->collObjStageMaterials[]= $objStageMaterial;
        $objStageMaterial->setUsers($this);
    }

    /**
     * @param ChildObjStageMaterial $objStageMaterial The ChildObjStageMaterial object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeObjStageMaterial(ChildObjStageMaterial $objStageMaterial)
    {
        if ($this->getObjStageMaterials()->contains($objStageMaterial)) {
            $pos = $this->collObjStageMaterials->search($objStageMaterial);
            $this->collObjStageMaterials->remove($pos);
            if (null === $this->objStageMaterialsScheduledForDeletion) {
                $this->objStageMaterialsScheduledForDeletion = clone $this->collObjStageMaterials;
                $this->objStageMaterialsScheduledForDeletion->clear();
            }
            $this->objStageMaterialsScheduledForDeletion[]= clone $objStageMaterial;
            $objStageMaterial->setUsers(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Users is new, it will return
     * an empty collection; or if this Users has previously
     * been saved, it will retrieve related ObjStageMaterials from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Users.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildObjStageMaterial[] List of ChildObjStageMaterial objects
     * @phpstan-return ObjectCollection&\Traversable<ChildObjStageMaterial}> List of ChildObjStageMaterial objects
     */
    public function getObjStageMaterialsJoinVolMaterial(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildObjStageMaterialQuery::create(null, $criteria);
        $query->joinWith('VolMaterial', $joinBehavior);

        return $this->getObjStageMaterials($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Users is new, it will return
     * an empty collection; or if this Users has previously
     * been saved, it will retrieve related ObjStageMaterials from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Users.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildObjStageMaterial[] List of ChildObjStageMaterial objects
     * @phpstan-return ObjectCollection&\Traversable<ChildObjStageMaterial}> List of ChildObjStageMaterial objects
     */
    public function getObjStageMaterialsJoinObjStageWork(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildObjStageMaterialQuery::create(null, $criteria);
        $query->joinWith('ObjStageWork', $joinBehavior);

        return $this->getObjStageMaterials($query, $con);
    }

    /**
     * Clears out the collObjStageTechnics collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addObjStageTechnics()
     */
    public function clearObjStageTechnics()
    {
        $this->collObjStageTechnics = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collObjStageTechnics collection loaded partially.
     *
     * @return void
     */
    public function resetPartialObjStageTechnics($v = true): void
    {
        $this->collObjStageTechnicsPartial = $v;
    }

    /**
     * Initializes the collObjStageTechnics collection.
     *
     * By default this just sets the collObjStageTechnics collection to an empty array (like clearcollObjStageTechnics());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initObjStageTechnics(bool $overrideExisting = true): void
    {
        if (null !== $this->collObjStageTechnics && !$overrideExisting) {
            return;
        }

        $collectionClassName = ObjStageTechnicTableMap::getTableMap()->getCollectionClassName();

        $this->collObjStageTechnics = new $collectionClassName;
        $this->collObjStageTechnics->setModel('\DB\ObjStageTechnic');
    }

    /**
     * Gets an array of ChildObjStageTechnic objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUsers is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildObjStageTechnic[] List of ChildObjStageTechnic objects
     * @phpstan-return ObjectCollection&\Traversable<ChildObjStageTechnic> List of ChildObjStageTechnic objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getObjStageTechnics(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collObjStageTechnicsPartial && !$this->isNew();
        if (null === $this->collObjStageTechnics || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collObjStageTechnics) {
                    $this->initObjStageTechnics();
                } else {
                    $collectionClassName = ObjStageTechnicTableMap::getTableMap()->getCollectionClassName();

                    $collObjStageTechnics = new $collectionClassName;
                    $collObjStageTechnics->setModel('\DB\ObjStageTechnic');

                    return $collObjStageTechnics;
                }
            } else {
                $collObjStageTechnics = ChildObjStageTechnicQuery::create(null, $criteria)
                    ->filterByUsers($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collObjStageTechnicsPartial && count($collObjStageTechnics)) {
                        $this->initObjStageTechnics(false);

                        foreach ($collObjStageTechnics as $obj) {
                            if (false == $this->collObjStageTechnics->contains($obj)) {
                                $this->collObjStageTechnics->append($obj);
                            }
                        }

                        $this->collObjStageTechnicsPartial = true;
                    }

                    return $collObjStageTechnics;
                }

                if ($partial && $this->collObjStageTechnics) {
                    foreach ($this->collObjStageTechnics as $obj) {
                        if ($obj->isNew()) {
                            $collObjStageTechnics[] = $obj;
                        }
                    }
                }

                $this->collObjStageTechnics = $collObjStageTechnics;
                $this->collObjStageTechnicsPartial = false;
            }
        }

        return $this->collObjStageTechnics;
    }

    /**
     * Sets a collection of ChildObjStageTechnic objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $objStageTechnics A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setObjStageTechnics(Collection $objStageTechnics, ?ConnectionInterface $con = null)
    {
        /** @var ChildObjStageTechnic[] $objStageTechnicsToDelete */
        $objStageTechnicsToDelete = $this->getObjStageTechnics(new Criteria(), $con)->diff($objStageTechnics);


        $this->objStageTechnicsScheduledForDeletion = $objStageTechnicsToDelete;

        foreach ($objStageTechnicsToDelete as $objStageTechnicRemoved) {
            $objStageTechnicRemoved->setUsers(null);
        }

        $this->collObjStageTechnics = null;
        foreach ($objStageTechnics as $objStageTechnic) {
            $this->addObjStageTechnic($objStageTechnic);
        }

        $this->collObjStageTechnics = $objStageTechnics;
        $this->collObjStageTechnicsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ObjStageTechnic objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related ObjStageTechnic objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countObjStageTechnics(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collObjStageTechnicsPartial && !$this->isNew();
        if (null === $this->collObjStageTechnics || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collObjStageTechnics) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getObjStageTechnics());
            }

            $query = ChildObjStageTechnicQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUsers($this)
                ->count($con);
        }

        return count($this->collObjStageTechnics);
    }

    /**
     * Method called to associate a ChildObjStageTechnic object to this object
     * through the ChildObjStageTechnic foreign key attribute.
     *
     * @param ChildObjStageTechnic $l ChildObjStageTechnic
     * @return $this The current object (for fluent API support)
     */
    public function addObjStageTechnic(ChildObjStageTechnic $l)
    {
        if ($this->collObjStageTechnics === null) {
            $this->initObjStageTechnics();
            $this->collObjStageTechnicsPartial = true;
        }

        if (!$this->collObjStageTechnics->contains($l)) {
            $this->doAddObjStageTechnic($l);

            if ($this->objStageTechnicsScheduledForDeletion and $this->objStageTechnicsScheduledForDeletion->contains($l)) {
                $this->objStageTechnicsScheduledForDeletion->remove($this->objStageTechnicsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildObjStageTechnic $objStageTechnic The ChildObjStageTechnic object to add.
     */
    protected function doAddObjStageTechnic(ChildObjStageTechnic $objStageTechnic): void
    {
        $this->collObjStageTechnics[]= $objStageTechnic;
        $objStageTechnic->setUsers($this);
    }

    /**
     * @param ChildObjStageTechnic $objStageTechnic The ChildObjStageTechnic object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeObjStageTechnic(ChildObjStageTechnic $objStageTechnic)
    {
        if ($this->getObjStageTechnics()->contains($objStageTechnic)) {
            $pos = $this->collObjStageTechnics->search($objStageTechnic);
            $this->collObjStageTechnics->remove($pos);
            if (null === $this->objStageTechnicsScheduledForDeletion) {
                $this->objStageTechnicsScheduledForDeletion = clone $this->collObjStageTechnics;
                $this->objStageTechnicsScheduledForDeletion->clear();
            }
            $this->objStageTechnicsScheduledForDeletion[]= clone $objStageTechnic;
            $objStageTechnic->setUsers(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Users is new, it will return
     * an empty collection; or if this Users has previously
     * been saved, it will retrieve related ObjStageTechnics from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Users.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildObjStageTechnic[] List of ChildObjStageTechnic objects
     * @phpstan-return ObjectCollection&\Traversable<ChildObjStageTechnic}> List of ChildObjStageTechnic objects
     */
    public function getObjStageTechnicsJoinObjStageWork(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildObjStageTechnicQuery::create(null, $criteria);
        $query->joinWith('ObjStageWork', $joinBehavior);

        return $this->getObjStageTechnics($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Users is new, it will return
     * an empty collection; or if this Users has previously
     * been saved, it will retrieve related ObjStageTechnics from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Users.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildObjStageTechnic[] List of ChildObjStageTechnic objects
     * @phpstan-return ObjectCollection&\Traversable<ChildObjStageTechnic}> List of ChildObjStageTechnic objects
     */
    public function getObjStageTechnicsJoinVolTechnic(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildObjStageTechnicQuery::create(null, $criteria);
        $query->joinWith('VolTechnic', $joinBehavior);

        return $this->getObjStageTechnics($query, $con);
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
     * If this ChildUsers is new, it will return
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
                    ->filterByUsers($this)
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
            $volMaterialRemoved->setUsers(null);
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
                ->filterByUsers($this)
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
        $volMaterial->setUsers($this);
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
            $volMaterial->setUsers(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Users is new, it will return
     * an empty collection; or if this Users has previously
     * been saved, it will retrieve related VolMaterials from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Users.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildVolMaterial[] List of ChildVolMaterial objects
     * @phpstan-return ObjectCollection&\Traversable<ChildVolMaterial}> List of ChildVolMaterial objects
     */
    public function getVolMaterialsJoinVolUnit(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildVolMaterialQuery::create(null, $criteria);
        $query->joinWith('VolUnit', $joinBehavior);

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
     * If this ChildUsers is new, it will return
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
                    ->filterByUsers($this)
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
            $volTechnicRemoved->setUsers(null);
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
                ->filterByUsers($this)
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
        $volTechnic->setUsers($this);
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
            $volTechnic->setUsers(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Users is new, it will return
     * an empty collection; or if this Users has previously
     * been saved, it will retrieve related VolTechnics from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Users.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildVolTechnic[] List of ChildVolTechnic objects
     * @phpstan-return ObjectCollection&\Traversable<ChildVolTechnic}> List of ChildVolTechnic objects
     */
    public function getVolTechnicsJoinVolUnit(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildVolTechnicQuery::create(null, $criteria);
        $query->joinWith('VolUnit', $joinBehavior);

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
     * If this ChildUsers is new, it will return
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
                    ->filterByUsers($this)
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
            $volWorkRemoved->setUsers(null);
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
                ->filterByUsers($this)
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
        $volWork->setUsers($this);
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
            $volWork->setUsers(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Users is new, it will return
     * an empty collection; or if this Users has previously
     * been saved, it will retrieve related VolWorks from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Users.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildVolWork[] List of ChildVolWork objects
     * @phpstan-return ObjectCollection&\Traversable<ChildVolWork}> List of ChildVolWork objects
     */
    public function getVolWorksJoinVolUnit(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildVolWorkQuery::create(null, $criteria);
        $query->joinWith('VolUnit', $joinBehavior);

        return $this->getVolWorks($query, $con);
    }

    /**
     * Clears out the collVolWorkMaterials collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addVolWorkMaterials()
     */
    public function clearVolWorkMaterials()
    {
        $this->collVolWorkMaterials = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collVolWorkMaterials collection loaded partially.
     *
     * @return void
     */
    public function resetPartialVolWorkMaterials($v = true): void
    {
        $this->collVolWorkMaterialsPartial = $v;
    }

    /**
     * Initializes the collVolWorkMaterials collection.
     *
     * By default this just sets the collVolWorkMaterials collection to an empty array (like clearcollVolWorkMaterials());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initVolWorkMaterials(bool $overrideExisting = true): void
    {
        if (null !== $this->collVolWorkMaterials && !$overrideExisting) {
            return;
        }

        $collectionClassName = VolWorkMaterialTableMap::getTableMap()->getCollectionClassName();

        $this->collVolWorkMaterials = new $collectionClassName;
        $this->collVolWorkMaterials->setModel('\DB\VolWorkMaterial');
    }

    /**
     * Gets an array of ChildVolWorkMaterial objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUsers is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildVolWorkMaterial[] List of ChildVolWorkMaterial objects
     * @phpstan-return ObjectCollection&\Traversable<ChildVolWorkMaterial> List of ChildVolWorkMaterial objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getVolWorkMaterials(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collVolWorkMaterialsPartial && !$this->isNew();
        if (null === $this->collVolWorkMaterials || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collVolWorkMaterials) {
                    $this->initVolWorkMaterials();
                } else {
                    $collectionClassName = VolWorkMaterialTableMap::getTableMap()->getCollectionClassName();

                    $collVolWorkMaterials = new $collectionClassName;
                    $collVolWorkMaterials->setModel('\DB\VolWorkMaterial');

                    return $collVolWorkMaterials;
                }
            } else {
                $collVolWorkMaterials = ChildVolWorkMaterialQuery::create(null, $criteria)
                    ->filterByUsers($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collVolWorkMaterialsPartial && count($collVolWorkMaterials)) {
                        $this->initVolWorkMaterials(false);

                        foreach ($collVolWorkMaterials as $obj) {
                            if (false == $this->collVolWorkMaterials->contains($obj)) {
                                $this->collVolWorkMaterials->append($obj);
                            }
                        }

                        $this->collVolWorkMaterialsPartial = true;
                    }

                    return $collVolWorkMaterials;
                }

                if ($partial && $this->collVolWorkMaterials) {
                    foreach ($this->collVolWorkMaterials as $obj) {
                        if ($obj->isNew()) {
                            $collVolWorkMaterials[] = $obj;
                        }
                    }
                }

                $this->collVolWorkMaterials = $collVolWorkMaterials;
                $this->collVolWorkMaterialsPartial = false;
            }
        }

        return $this->collVolWorkMaterials;
    }

    /**
     * Sets a collection of ChildVolWorkMaterial objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $volWorkMaterials A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setVolWorkMaterials(Collection $volWorkMaterials, ?ConnectionInterface $con = null)
    {
        /** @var ChildVolWorkMaterial[] $volWorkMaterialsToDelete */
        $volWorkMaterialsToDelete = $this->getVolWorkMaterials(new Criteria(), $con)->diff($volWorkMaterials);


        $this->volWorkMaterialsScheduledForDeletion = $volWorkMaterialsToDelete;

        foreach ($volWorkMaterialsToDelete as $volWorkMaterialRemoved) {
            $volWorkMaterialRemoved->setUsers(null);
        }

        $this->collVolWorkMaterials = null;
        foreach ($volWorkMaterials as $volWorkMaterial) {
            $this->addVolWorkMaterial($volWorkMaterial);
        }

        $this->collVolWorkMaterials = $volWorkMaterials;
        $this->collVolWorkMaterialsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related VolWorkMaterial objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related VolWorkMaterial objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countVolWorkMaterials(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collVolWorkMaterialsPartial && !$this->isNew();
        if (null === $this->collVolWorkMaterials || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collVolWorkMaterials) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getVolWorkMaterials());
            }

            $query = ChildVolWorkMaterialQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUsers($this)
                ->count($con);
        }

        return count($this->collVolWorkMaterials);
    }

    /**
     * Method called to associate a ChildVolWorkMaterial object to this object
     * through the ChildVolWorkMaterial foreign key attribute.
     *
     * @param ChildVolWorkMaterial $l ChildVolWorkMaterial
     * @return $this The current object (for fluent API support)
     */
    public function addVolWorkMaterial(ChildVolWorkMaterial $l)
    {
        if ($this->collVolWorkMaterials === null) {
            $this->initVolWorkMaterials();
            $this->collVolWorkMaterialsPartial = true;
        }

        if (!$this->collVolWorkMaterials->contains($l)) {
            $this->doAddVolWorkMaterial($l);

            if ($this->volWorkMaterialsScheduledForDeletion and $this->volWorkMaterialsScheduledForDeletion->contains($l)) {
                $this->volWorkMaterialsScheduledForDeletion->remove($this->volWorkMaterialsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildVolWorkMaterial $volWorkMaterial The ChildVolWorkMaterial object to add.
     */
    protected function doAddVolWorkMaterial(ChildVolWorkMaterial $volWorkMaterial): void
    {
        $this->collVolWorkMaterials[]= $volWorkMaterial;
        $volWorkMaterial->setUsers($this);
    }

    /**
     * @param ChildVolWorkMaterial $volWorkMaterial The ChildVolWorkMaterial object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeVolWorkMaterial(ChildVolWorkMaterial $volWorkMaterial)
    {
        if ($this->getVolWorkMaterials()->contains($volWorkMaterial)) {
            $pos = $this->collVolWorkMaterials->search($volWorkMaterial);
            $this->collVolWorkMaterials->remove($pos);
            if (null === $this->volWorkMaterialsScheduledForDeletion) {
                $this->volWorkMaterialsScheduledForDeletion = clone $this->collVolWorkMaterials;
                $this->volWorkMaterialsScheduledForDeletion->clear();
            }
            $this->volWorkMaterialsScheduledForDeletion[]= clone $volWorkMaterial;
            $volWorkMaterial->setUsers(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Users is new, it will return
     * an empty collection; or if this Users has previously
     * been saved, it will retrieve related VolWorkMaterials from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Users.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildVolWorkMaterial[] List of ChildVolWorkMaterial objects
     * @phpstan-return ObjectCollection&\Traversable<ChildVolWorkMaterial}> List of ChildVolWorkMaterial objects
     */
    public function getVolWorkMaterialsJoinVolWork(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildVolWorkMaterialQuery::create(null, $criteria);
        $query->joinWith('VolWork', $joinBehavior);

        return $this->getVolWorkMaterials($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Users is new, it will return
     * an empty collection; or if this Users has previously
     * been saved, it will retrieve related VolWorkMaterials from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Users.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildVolWorkMaterial[] List of ChildVolWorkMaterial objects
     * @phpstan-return ObjectCollection&\Traversable<ChildVolWorkMaterial}> List of ChildVolWorkMaterial objects
     */
    public function getVolWorkMaterialsJoinVolMaterial(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildVolWorkMaterialQuery::create(null, $criteria);
        $query->joinWith('VolMaterial', $joinBehavior);

        return $this->getVolWorkMaterials($query, $con);
    }

    /**
     * Clears out the collVolWorkTechnics collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addVolWorkTechnics()
     */
    public function clearVolWorkTechnics()
    {
        $this->collVolWorkTechnics = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collVolWorkTechnics collection loaded partially.
     *
     * @return void
     */
    public function resetPartialVolWorkTechnics($v = true): void
    {
        $this->collVolWorkTechnicsPartial = $v;
    }

    /**
     * Initializes the collVolWorkTechnics collection.
     *
     * By default this just sets the collVolWorkTechnics collection to an empty array (like clearcollVolWorkTechnics());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initVolWorkTechnics(bool $overrideExisting = true): void
    {
        if (null !== $this->collVolWorkTechnics && !$overrideExisting) {
            return;
        }

        $collectionClassName = VolWorkTechnicTableMap::getTableMap()->getCollectionClassName();

        $this->collVolWorkTechnics = new $collectionClassName;
        $this->collVolWorkTechnics->setModel('\DB\VolWorkTechnic');
    }

    /**
     * Gets an array of ChildVolWorkTechnic objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUsers is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildVolWorkTechnic[] List of ChildVolWorkTechnic objects
     * @phpstan-return ObjectCollection&\Traversable<ChildVolWorkTechnic> List of ChildVolWorkTechnic objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getVolWorkTechnics(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collVolWorkTechnicsPartial && !$this->isNew();
        if (null === $this->collVolWorkTechnics || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collVolWorkTechnics) {
                    $this->initVolWorkTechnics();
                } else {
                    $collectionClassName = VolWorkTechnicTableMap::getTableMap()->getCollectionClassName();

                    $collVolWorkTechnics = new $collectionClassName;
                    $collVolWorkTechnics->setModel('\DB\VolWorkTechnic');

                    return $collVolWorkTechnics;
                }
            } else {
                $collVolWorkTechnics = ChildVolWorkTechnicQuery::create(null, $criteria)
                    ->filterByUsers($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collVolWorkTechnicsPartial && count($collVolWorkTechnics)) {
                        $this->initVolWorkTechnics(false);

                        foreach ($collVolWorkTechnics as $obj) {
                            if (false == $this->collVolWorkTechnics->contains($obj)) {
                                $this->collVolWorkTechnics->append($obj);
                            }
                        }

                        $this->collVolWorkTechnicsPartial = true;
                    }

                    return $collVolWorkTechnics;
                }

                if ($partial && $this->collVolWorkTechnics) {
                    foreach ($this->collVolWorkTechnics as $obj) {
                        if ($obj->isNew()) {
                            $collVolWorkTechnics[] = $obj;
                        }
                    }
                }

                $this->collVolWorkTechnics = $collVolWorkTechnics;
                $this->collVolWorkTechnicsPartial = false;
            }
        }

        return $this->collVolWorkTechnics;
    }

    /**
     * Sets a collection of ChildVolWorkTechnic objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $volWorkTechnics A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setVolWorkTechnics(Collection $volWorkTechnics, ?ConnectionInterface $con = null)
    {
        /** @var ChildVolWorkTechnic[] $volWorkTechnicsToDelete */
        $volWorkTechnicsToDelete = $this->getVolWorkTechnics(new Criteria(), $con)->diff($volWorkTechnics);


        $this->volWorkTechnicsScheduledForDeletion = $volWorkTechnicsToDelete;

        foreach ($volWorkTechnicsToDelete as $volWorkTechnicRemoved) {
            $volWorkTechnicRemoved->setUsers(null);
        }

        $this->collVolWorkTechnics = null;
        foreach ($volWorkTechnics as $volWorkTechnic) {
            $this->addVolWorkTechnic($volWorkTechnic);
        }

        $this->collVolWorkTechnics = $volWorkTechnics;
        $this->collVolWorkTechnicsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related VolWorkTechnic objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related VolWorkTechnic objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countVolWorkTechnics(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collVolWorkTechnicsPartial && !$this->isNew();
        if (null === $this->collVolWorkTechnics || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collVolWorkTechnics) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getVolWorkTechnics());
            }

            $query = ChildVolWorkTechnicQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUsers($this)
                ->count($con);
        }

        return count($this->collVolWorkTechnics);
    }

    /**
     * Method called to associate a ChildVolWorkTechnic object to this object
     * through the ChildVolWorkTechnic foreign key attribute.
     *
     * @param ChildVolWorkTechnic $l ChildVolWorkTechnic
     * @return $this The current object (for fluent API support)
     */
    public function addVolWorkTechnic(ChildVolWorkTechnic $l)
    {
        if ($this->collVolWorkTechnics === null) {
            $this->initVolWorkTechnics();
            $this->collVolWorkTechnicsPartial = true;
        }

        if (!$this->collVolWorkTechnics->contains($l)) {
            $this->doAddVolWorkTechnic($l);

            if ($this->volWorkTechnicsScheduledForDeletion and $this->volWorkTechnicsScheduledForDeletion->contains($l)) {
                $this->volWorkTechnicsScheduledForDeletion->remove($this->volWorkTechnicsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildVolWorkTechnic $volWorkTechnic The ChildVolWorkTechnic object to add.
     */
    protected function doAddVolWorkTechnic(ChildVolWorkTechnic $volWorkTechnic): void
    {
        $this->collVolWorkTechnics[]= $volWorkTechnic;
        $volWorkTechnic->setUsers($this);
    }

    /**
     * @param ChildVolWorkTechnic $volWorkTechnic The ChildVolWorkTechnic object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeVolWorkTechnic(ChildVolWorkTechnic $volWorkTechnic)
    {
        if ($this->getVolWorkTechnics()->contains($volWorkTechnic)) {
            $pos = $this->collVolWorkTechnics->search($volWorkTechnic);
            $this->collVolWorkTechnics->remove($pos);
            if (null === $this->volWorkTechnicsScheduledForDeletion) {
                $this->volWorkTechnicsScheduledForDeletion = clone $this->collVolWorkTechnics;
                $this->volWorkTechnicsScheduledForDeletion->clear();
            }
            $this->volWorkTechnicsScheduledForDeletion[]= clone $volWorkTechnic;
            $volWorkTechnic->setUsers(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Users is new, it will return
     * an empty collection; or if this Users has previously
     * been saved, it will retrieve related VolWorkTechnics from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Users.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildVolWorkTechnic[] List of ChildVolWorkTechnic objects
     * @phpstan-return ObjectCollection&\Traversable<ChildVolWorkTechnic}> List of ChildVolWorkTechnic objects
     */
    public function getVolWorkTechnicsJoinVolWork(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildVolWorkTechnicQuery::create(null, $criteria);
        $query->joinWith('VolWork', $joinBehavior);

        return $this->getVolWorkTechnics($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Users is new, it will return
     * an empty collection; or if this Users has previously
     * been saved, it will retrieve related VolWorkTechnics from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Users.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildVolWorkTechnic[] List of ChildVolWorkTechnic objects
     * @phpstan-return ObjectCollection&\Traversable<ChildVolWorkTechnic}> List of ChildVolWorkTechnic objects
     */
    public function getVolWorkTechnicsJoinVolTechnic(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildVolWorkTechnicQuery::create(null, $criteria);
        $query->joinWith('VolTechnic', $joinBehavior);

        return $this->getVolWorkTechnics($query, $con);
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
        if (null !== $this->aUserRole) {
            $this->aUserRole->removeUsers($this);
        }
        $this->id = null;
        $this->email = null;
        $this->phone = null;
        $this->password = null;
        $this->username = null;
        $this->status = null;
        $this->role_id = null;
        $this->verified = null;
        $this->resettable = null;
        $this->roles_mask = null;
        $this->registered = null;
        $this->last_login = null;
        $this->force_logout = null;
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
            if ($this->collProjectRoles) {
                foreach ($this->collProjectRoles as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collObjProjects) {
                foreach ($this->collObjProjects as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collObjSubprojects) {
                foreach ($this->collObjSubprojects as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collObjGroups) {
                foreach ($this->collObjGroups as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collObjHouses) {
                foreach ($this->collObjHouses as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collObjStages) {
                foreach ($this->collObjStages as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collObjStageWorks) {
                foreach ($this->collObjStageWorks as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collObjStageMaterials) {
                foreach ($this->collObjStageMaterials as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collObjStageTechnics) {
                foreach ($this->collObjStageTechnics as $o) {
                    $o->clearAllReferences($deep);
                }
            }
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
            if ($this->collVolWorkMaterials) {
                foreach ($this->collVolWorkMaterials as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collVolWorkTechnics) {
                foreach ($this->collVolWorkTechnics as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collProjectRoles = null;
        $this->collObjProjects = null;
        $this->collObjSubprojects = null;
        $this->collObjGroups = null;
        $this->collObjHouses = null;
        $this->collObjStages = null;
        $this->collObjStageWorks = null;
        $this->collObjStageMaterials = null;
        $this->collObjStageTechnics = null;
        $this->collVolMaterials = null;
        $this->collVolTechnics = null;
        $this->collVolWorks = null;
        $this->collVolWorkMaterials = null;
        $this->collVolWorkTechnics = null;
        $this->aUserRole = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(UsersTableMap::DEFAULT_STRING_FORMAT);
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
