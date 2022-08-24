<?php

namespace wipe\inc\v1\role\project_role;

use DB\RoleQuery;
use Exception;
use DB\Base\ProjectRole as BaseProjectRole;
use wipe\inc\v1\role\user_role\UserRole;

class ProjectRole
{
    /** @var int Номер уровня доступа - проект. */
    public const ATTRIBUTE_LVL_INT_PROJECT = 1;

    /** @var int Номер уровня доступа - подпроект. */
    public const ATTRIBUTE_LVL_INT_SUBPROJECT = 2;

    /** @var int Номер уровня доступа - группа. */
    public const ATTRIBUTE_LVL_INT_GROUP = 3;

    /** @var int Номер уровня доступа - дом. */
    public const ATTRIBUTE_LVL_INT_HOUSE = 4;

    /** @var int Номер уровня доступа - этап. */
    public const ATTRIBUTE_LVL_INT_STAGE = 5;

    /** @var string Наименование уровня доступа - проект. */
    public const ATTRIBUTE_LVL_STR_PROJECT = 'project';

    /** @var string Наименование уровня доступа - подпроект. */
    public const ATTRIBUTE_LVL_STR_SUBPROJECT = 'subproject';

    /** @var string Наименование уровня доступа - группа. */
    public const ATTRIBUTE_LVL_STR_GROUP = 'group';

    /** @var string Наименование уровня доступа - дом. */
    public const ATTRIBUTE_LVL_STR_HOUSE = 'house';

    /** @var string Наименование уровня доступа - этап. */
    public const ATTRIBUTE_LVL_STR_STAGE = 'stage';

    /** @var int|null ID роли проекта. */
    private ?int $roleId = null;

    /** @var BaseProjectRole|null Объект роли проекта.  */
    private ?BaseProjectRole $roleObj = null;

    /** @var int|null Номер уровня доступа. */
    private ?int $lvl = null;

    /** @var string|null Наименование уровня доступа. */
    private ?string $lvlName = null;

    /** @var bool|null Разрешен ли CRUD объекта. */
    private ?bool $isCrud = null;

    /** @var int|null ID проекта. */
    private ?int $projectId = null;

    /** @var int|null ID объекта (проект, подпроект, группа, дом, этап). */
    private ?int $objectId = null;

    /** @var int|null ID пользователя. */
    private ?int $userId = null;

    /** @var UserRole|null Роль пользователя. */
    private ?UserRole $userRole = null;

    /**
     * @param int|null $roleId ID роли проекта.
     * @param int|null $userId ID пользователя.
     * @throws Exception
     */
    function __construct(?int $roleId = null, ?int $userId = null)
    {
        if ($roleId && $userId) {
            $this->roleId = $roleId;
            $this->applyDefaultValuesByRoleId();
            $this->userId = $userId;
            $this->applyDefaultValuesByUserId();
        }
        elseif ($roleId) {
            $this->roleId = $roleId;
            $this->applyDefaultValuesByRoleId();
        }
        elseif ($userId) {
            $this->userId = $userId;
            $this->applyDefaultValuesByUserId();
        }
    }

    #region Apply Default Values Functions
    /**
     * Заполнение свойств класса, используя ID роли проекта.
     * @throws Exception
     */
    private function applyDefaultValuesByRoleId(): void
    {
        $this->roleObj = RoleQuery::create()->findPk($this->roleId) ??
                         throw new Exception('No project role found');
        $this->roleId = $this->roleObj->getId();
        $this->isCrud = $this->roleObj->getIsCrud();
        $this->setLvlByNum($this->roleObj->getLvl());
        $this->objectId = $this->roleObj->getObjectId();
        $this->userId = $this->roleObj->getUserId();
    }

    /**
     * Заполнение свойств класса, используя ID польователя.
     * @throws Exception
     */
    private function applyDefaultValuesByUserId(): void
    {
        $this->userRole = new UserRole(userId: $this->userId);
    }
    #endregion

    #region Access Control Functions
    /** @return bool|null Разрешен ли CRUD объекта. */
    public function isAccessCrud(): ?bool
    {
        return $this->isCrud;
    }

    /**
     * @return bool CRUD объекта разрешен, иначе ошибка.
     * @throws Exception
     */
    public function isAccessCrudOrThrow(): bool
    {
        return $this->isCrud ?: throw new Exception('No access to CRUD the object');
    }

    /**
     * Равносилен ли CRUD пользователя NULL.
     * Т.е. пользователю еще не назначали роль для данного проекта.
     * @throws Exception
     */
    public function isNullCrud(): bool
    {
        return $this->isCrud === null;
    }
    #endregion

    #region Getter Default Values Functions
    /** @return int|null ID роли проекта. */
    public function getRoleId(): ?int
    {
        return $this->roleId;
    }

    /** @return int|null Номер уровня доступа. */
    public function getLvl(): ?int
    {
        return $this->lvl;
    }

    /** @return string|null Наименование уровня доступа. */
    public function getLvlName(): ?string
    {
        return $this->lvlName;
    }

    /** @return string|null Наименование уровня доступа но его номеру. */
    public function getLvlNameByNum(): ?string
    {
        return match ($this->lvl) {
            $this::ATTRIBUTE_LVL_INT_PROJECT => $this::ATTRIBUTE_LVL_STR_PROJECT,
            $this::ATTRIBUTE_LVL_INT_SUBPROJECT => $this::ATTRIBUTE_LVL_STR_SUBPROJECT,
            $this::ATTRIBUTE_LVL_INT_GROUP => $this::ATTRIBUTE_LVL_STR_GROUP,
            $this::ATTRIBUTE_LVL_INT_HOUSE => $this::ATTRIBUTE_LVL_STR_HOUSE,
            $this::ATTRIBUTE_LVL_INT_STAGE => $this::ATTRIBUTE_LVL_STR_STAGE,
            default => null
        };
    }

    /** @return int|null Номер уровня доступа но его наименованию. */
    public function getLvlNumByName(): ?int
    {
        return match ($this->lvlName) {
            $this::ATTRIBUTE_LVL_STR_PROJECT => $this::ATTRIBUTE_LVL_INT_PROJECT,
            $this::ATTRIBUTE_LVL_STR_SUBPROJECT => $this::ATTRIBUTE_LVL_INT_SUBPROJECT,
            $this::ATTRIBUTE_LVL_STR_GROUP => $this::ATTRIBUTE_LVL_INT_GROUP,
            $this::ATTRIBUTE_LVL_STR_HOUSE => $this::ATTRIBUTE_LVL_INT_HOUSE,
            $this::ATTRIBUTE_LVL_STR_STAGE => $this::ATTRIBUTE_LVL_INT_STAGE,
            default => null
        };
    }

    /** @return int|null ID проекта. */
    public function getProjectId(): ?int
    {
        return $this->projectId;
    }

    /** @return int|null ID объекта (проект, подпроект, группа, дом, этап). */
    public function getObjectId(): ?int
    {
        return $this->objectId;
    }

    /** @return int|null ID пользователя. */
    public function getUserId(): ?int
    {
        return $this->userId;
    }

    /** @return UserRole|null Основная роль пользователя. */
    public function getUserRole(): ?UserRole
    {
        return $this->userRole;
    }

    /** @return BaseProjectRole|null Объект роли проекта. */
    public function getRoleObj(): ?BaseProjectRole
    {
        return $this->roleObj;
    }
    #endregion Functions

    #region Setter Default Values Functions
    /**
     * @param int $userId ID пользователя.
     * @param bool $flag Необходимо ли обновлять свойства пользователя, в соответствие с ID пользователя.
     * @return ProjectRole
     * @throws Exception
     */
    public function setUserId(int $userId, bool $flag = false): ProjectRole
    {
        if ($this->userId !== $userId) {
            $this->userId = $userId;
            $this->applyDefaultValuesByUserId();
        }

        return $this;
    }

    /**
     * @param int $objectId ID объекта (проект, подпроект, группа, дом, этап).
     * @return ProjectRole
     */
    public function setObjectId(int $objectId): ProjectRole
    {
        if ($this->objectId !== $objectId) {
            $this->objectId = $objectId;
        }

        return $this;
    }

    /**
     * @param int $projectId ID проекта.
     * @return ProjectRole
     */
    public function setProjectId(int $projectId): ProjectRole
    {
        if ($this->projectId !== $projectId) {
            $this->projectId = $projectId;
        }

        return $this;
    }

    /**
     * @param bool $isCrud Разрешен ли CRUD объекта.
     * @return ProjectRole
     */
    public function setIsCrud(bool $isCrud): ProjectRole
    {
        if ($this->isCrud !== $isCrud && !$this->userRole) {
            $this->isCrud = $isCrud;
        } elseif ($this->isCrud !== $isCrud && $this->userRole) {
            
        }

        return $this;
    }

    /**
     * Используется для установки уровня доступа ($lvl, $lvlName), либо по номеру, либо по наименованию.
     * @param int|string $lvl Уровень доступа.
     * @return ProjectRole
     * @throws Exception
     */
    public function setLvl(int|string $lvl): ProjectRole
    {
        return  is_int($lvl)
                ? $this->setLvlByNum($lvl)
                : $this->setLvlByName($lvl);
    }

    /**
     * Испольвуется для установки уровня доступа ($lvl, $lvlName) по номеру.
     * @param int $lvlNum Номер уровня доступа (ATTRIBUTE_LVL_INT_).
     * @return ProjectRole
     * @throws Exception
     */
    public function setLvlByNum(int $lvlNum): ProjectRole
    {
        if ($this->lvl !== $lvlNum) {
            $this->lvl = $lvlNum;
            $this->setLvlNameByInt($lvlNum);
        }

        return $this;
    }

    /**
     * Испольвуется для установки уровня доступа ($lvl, $lvlName) по наименованию.
     * @param string $lvlName Наименование уровня доступа.
     * @return ProjectRole
     * @throws Exception
     */
    public function setLvlByName(string $lvlName): ProjectRole
    {
        if ($this->lvlName !== $lvlName) {
            $this->lvlName = $lvlName;
            $this->setLvlByStr($lvlName);
        }

        return  $this;
    }

    /**
     * Испольвуется для установки уровня доступа ($lvl) по наименованию.
     * @param string $lvlName Наименование уровня доступа (ATTRIBUTE_LVL_STR_).
     * @return ProjectRole
     * @throws Exception
     */
    public function setLvlByStr(string $lvlName): ProjectRole
    {
        $this->lvl = match ($lvlName) {
            $this::ATTRIBUTE_LVL_STR_PROJECT => $this::ATTRIBUTE_LVL_INT_PROJECT,
            $this::ATTRIBUTE_LVL_STR_SUBPROJECT => $this::ATTRIBUTE_LVL_INT_SUBPROJECT,
            $this::ATTRIBUTE_LVL_STR_GROUP => $this::ATTRIBUTE_LVL_INT_GROUP,
            $this::ATTRIBUTE_LVL_STR_HOUSE => $this::ATTRIBUTE_LVL_INT_HOUSE,
            $this::ATTRIBUTE_LVL_STR_STAGE => $this::ATTRIBUTE_LVL_INT_STAGE,
            default => throw new Exception('Incorrect level value'),
        };

        return $this;
    }

    /**
     * Испольвуется для установки уровня доступа ($lvlName) по номеру.
     * @param int $lvlNum Номер уровня доступа.
     * @return ProjectRole
     * @throws Exception
     */
    public function setLvlNameByInt(int $lvlNum): ProjectRole
    {
        $this->lvlName = match ($lvlNum) {
            $this::ATTRIBUTE_LVL_INT_PROJECT => $this::ATTRIBUTE_LVL_STR_PROJECT,
            $this::ATTRIBUTE_LVL_INT_SUBPROJECT => $this::ATTRIBUTE_LVL_STR_SUBPROJECT,
            $this::ATTRIBUTE_LVL_INT_GROUP => $this::ATTRIBUTE_LVL_STR_GROUP,
            $this::ATTRIBUTE_LVL_INT_HOUSE => $this::ATTRIBUTE_LVL_STR_HOUSE,
            $this::ATTRIBUTE_LVL_INT_STAGE => $this::ATTRIBUTE_LVL_STR_STAGE,
            default => throw new Exception('Incorrect level value'),
        };

        return $this;
    }

    /**
     * @param int $roleId ID роли проекта.
     * @return ProjectRole
     */
    public function setRoleId(int $roleId): ProjectRole
    {
        if ($this->roleId !== $roleId) {
            $this->roleId = $roleId;
        }

        return $this;
    }

    /**
     * @param UserRole $userRole Роль пользователя.
     * @return ProjectRole
     */
    public function setUserRole(UserRole $userRole): ProjectRole
    {
        if ($this->userRole->getRoleId() !== $userRole->getRoleId()) {
            $this->userRole = $userRole;
        }

        return $this;
    }

    /**
     * @param BaseProjectRole $projectRole Объект роли проекта.
     * @return ProjectRole
     */
    public function setProjectRole(BaseProjectRole $projectRole): ProjectRole
    {
        if ($this->roleObj->getId() !== $projectRole->getId()) {
            $this->roleObj = $projectRole;
        }

        return $this;
    }
    #endregion
}