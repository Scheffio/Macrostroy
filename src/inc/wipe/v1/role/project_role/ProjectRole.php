<?php

namespace wipe\inc\v1\role\project_role;

use PHPMailer\PHPMailer\Exception;
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

    /** @var int|null Номер уровня доступа. */
    private ?int $lvl = null;

    /** @var string|null Наименование уровня доступа. */
    private ?string $lvlName = null;

    /** @var bool|null Разрешен ли CRUD объекта. */
    private bool $isCrud = false;

    /** @var int|null ID проекта. */
    private ?int $projectId = null;

    /** @var int|null ID объекта (проект, подпроект, группа, дом, этап). */
    private ?int $objectId = null;

    /** @var int|null ID пользователя. */
    private ?int $userId = null;

    /** @var UserRole|null Роль пользователя. */
    private ?UserRole $userRole = null;

    #region Access Control Functions

    /** @return bool Разрешен ли CRUD объекта. */
    public function isAccessCrud(): bool
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
    #endregion Functions

    #region Setter Default Values Functions
    /**
     * @param int $userId ID пользователя.
     * @return ProjectRole
     */
    public function setUserId(int $userId): ProjectRole
    {
        if ($this->userId !== $userId) {
            $this->userId = $userId;
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
        if ($this->isCrud !== $isCrud) {
            $this->isCrud = $isCrud;
        }

        return $this;
    }

    /**
     * @param int|string $lvl Уровень доступа.
     * @return ProjectRole
     */
    public function setLvl(int|string $lvl): ProjectRole
    {
        return  is_int($lvl)
                ? $this->setLvlByNum($lvl)
                : $this->setLvlByName($lvl);
    }

    /**
     * @param int $lvlNum Номер уровня доступа (ATTRIBUTE_LVL_INT_).
     * @return ProjectRole
     */
    public function setLvlByNum(int $lvlNum): ProjectRole
    {
        if ($this->lvl !== $lvlNum) {
            $this->lvl = $lvlNum;
        }

        return $this;
    }

    /**
     * @param string $lvlName Наименование уровня доступа (ATTRIBUTE_LVL_STR_).
     * @return ProjectRole
     */
    public function setLvlByName(string $lvlName): ProjectRole
    {
        if ($this->lvl !== $lvlName) {
            $this->lvl = $lvlName;
        }

        return $this;
    }

    /**
     * @param int $roleId ID роли проекта.
     * @return ProjectRole
     */
    public function setRoleId(int $roleId): ProjectRole
    {
        if ($this->roleId)
        return $this;
    }

    /**
     * @param UserRole|null $userRole Роль пользователя.
     * @return ProjectRole
     */
    public function setUserRole(?UserRole $userRole): ProjectRole
    {
        $this->userRole = $userRole;
        return $this;
    }
    #endregion
}