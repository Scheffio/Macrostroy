<?php

namespace wipe\inc\v1\role\project_role;

use Exception;
use DB\RoleQuery;
use DB\Base\ProjectRoleQuery;
use DB\ProjectRole as DbProjectRole;
use DB\ProjectRoleQuery as DbProjectRoleQuery;
use DB\Base\ProjectRole as BaseProjectRole;
use inc\artemy\v1\json_output\JsonOutput;
use JetBrains\PhpStorm\NoReturn;
use Propel\Runtime\Exception\PropelException;
use wipe\inc\v1\role\project_role\exception\IncorrectLvlException;
use wipe\inc\v1\role\project_role\exception\NoAccessCrudException;
use wipe\inc\v1\role\project_role\exception\NoProjectFoundException;
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

    /** @var int Номер уровня доступа. */
    private int $lvl = 1;

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
     * @param int|string $lvl Номер уровня доступа.
     * @param int|null $objectId ID объекта (проект, подпроект, группа, дом, этап).
     * @param bool $search Нужно ли искать ранее созданную запись с переданными параметрами.
     * @throws Exception
     */
    function __construct(
        ?int $roleId = null,
        ?int $userId = null,
        int|string $lvl = 1,
        ?int $objectId = null,
        bool $search = false)
    {
        $this->roleId = $roleId;
        $this->userId = $userId;
        $this->objectId = $objectId;
        $this->setLvl($lvl);

        if ($search) {
            $this->applyDefaultValuesBySearch();
        }
    }

    #region Apply Default Values Functions
    /**
     * Заполнение свойств класса, используя поиск по переданным первоначально значениям.
     * @return void
     * @throws Exception
     */
    private function applyDefaultValuesBySearch(): void
    {
        $role = ProjectRoleQuery::create();

        if ($this->roleId) $role->filterById($this->roleId);
        if ($this->userId) $role->filterByUserId($this->userId);
        if ($this->lvl) $role->filterByLvl($this->lvl);
        if ($this->objectId) $role->filterByObjectId($this->objectId);
        $role = $role->findOne();

        if ($role !== null) {
            $this->roleObj = $role;
            $this->roleId = $role->getId();
            $this->applyDefaultValuesByRoleObj();
        }
    }

    /**
     * Заполнение свойств класса, используя ID роли проекта.
     * @return void
     * @throws NoProjectFoundException
     * @throws Exception
     */
    private function applyDefaultValuesByRoleId(): void
    {
        $this->roleObj = RoleQuery::create()->findPk($this->roleId) ??
                         throw new NoProjectFoundException();
        $this->applyDefaultValuesByRoleObj();
    }

    /**
     * Заполнение свойств класса, используя объект роли проекта.
     * @throws Exception
     */

    /**
     * @return void
     * @throws Exception
     */
    private function applyDefaultValuesByRoleObj(): void
    {
        $this->isCrud = $this->roleObj->getIsCrud();
        $this->setLvlByNum($this->roleObj->getLvl());
        $this->objectId = $this->roleObj->getObjectId();
        $this->userId = $this->roleObj->getUserId();
        $this->applyDefaultValuesByUserId();
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
     * @throws NoAccessCrudException
     */
    public function isAccessCrudOrThrow(): bool
    {
        return $this->isCrud ?: throw new NoAccessCrudException();
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

    /**
     * @return string Наименование уровня доступа но его номеру.
     * @throws IncorrectLvlException
     */
    public function getLvlNameByNum(): string
    {
        return match ($this->lvl) {
            $this::ATTRIBUTE_LVL_INT_PROJECT => $this::ATTRIBUTE_LVL_STR_PROJECT,
            $this::ATTRIBUTE_LVL_INT_SUBPROJECT => $this::ATTRIBUTE_LVL_STR_SUBPROJECT,
            $this::ATTRIBUTE_LVL_INT_GROUP => $this::ATTRIBUTE_LVL_STR_GROUP,
            $this::ATTRIBUTE_LVL_INT_HOUSE => $this::ATTRIBUTE_LVL_STR_HOUSE,
            $this::ATTRIBUTE_LVL_INT_STAGE => $this::ATTRIBUTE_LVL_STR_STAGE,
            default => throw new IncorrectLvlException()
        };
    }

    /**
     * @return int Номер уровня доступа по его наименованию.
     * @throws IncorrectLvlException
     */
    public function getLvlNumByName(): int
    {
        return match ($this->lvlName) {
            $this::ATTRIBUTE_LVL_STR_PROJECT => $this::ATTRIBUTE_LVL_INT_PROJECT,
            $this::ATTRIBUTE_LVL_STR_SUBPROJECT => $this::ATTRIBUTE_LVL_INT_SUBPROJECT,
            $this::ATTRIBUTE_LVL_STR_GROUP => $this::ATTRIBUTE_LVL_INT_GROUP,
            $this::ATTRIBUTE_LVL_STR_HOUSE => $this::ATTRIBUTE_LVL_INT_HOUSE,
            $this::ATTRIBUTE_LVL_STR_STAGE => $this::ATTRIBUTE_LVL_INT_STAGE,
            default => throw new IncorrectLvlException()
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

            if ($flag) {
                $this->applyDefaultValuesByUserId();
            }
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
     * @param bool|null $isCrud Разрешен ли CRUD объекта.
     * @return ProjectRole
     */
    public function setIsCrud(?bool $isCrud): ProjectRole
    {
        if ($this->isCrud !== $isCrud) {
            $this->isCrud = $isCrud;
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
     * @throws IncorrectLvlException
     */
    public function setLvlByNum(int $lvlNum): ProjectRole
    {
        if ($this->lvl !== $lvlNum) {
            $this->lvl = $lvlNum;
            $this->setLvlNameByInt();
        }

        return $this;
    }

    /**
     * Испольвуется для установки уровня доступа ($lvl, $lvlName) по наименованию.
     * @param string $lvlName Наименование уровня доступа.
     * @return ProjectRole
     * @throws IncorrectLvlException
     */
    public function setLvlByName(string $lvlName): ProjectRole
    {
        if ($this->lvlName !== $lvlName) {
            $this->lvlName = $lvlName;
            $this->setLvlByStr();
        }

        return  $this;
    }

    /**
     * Испольвуется для установки уровня доступа ($lvl) по наименованию.
     * @return ProjectRole
     * @throws IncorrectLvlException
     */
    public function setLvlByStr(): ProjectRole
    {
        $this->lvl = $this->getLvlNumByName();

        return $this;
    }

    /**
     * Испольвуется для установки уровня доступа ($lvlName) по номеру.
     * @return ProjectRole
     * @throws IncorrectLvlException
     */
    public function setLvlNameByInt(): ProjectRole
    {
        $this->lvlName = $this->getLvlNameByNum();

        return $this;
    }

    /**
     * @param int $roleId ID роли проекта.
     * @param bool $flag Необходимо ли обновлять свойства роли проекта, в соответствие с ID роли.
     * @return ProjectRole
     * @throws Exception
     */
    public function setRoleId(int $roleId, bool $flag = false): ProjectRole
    {
        if ($this->roleId !== $roleId) {
            $this->roleId = $roleId;

            if ($flag) {
                $this->applyDefaultValuesByRoleId();
            }
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
     * @param bool $flag Необходимо ли обновлять свойства роли проекта, в соответствие с переданным объектом.
     * @return ProjectRole
     * @throws Exception
     */
    public function setProjectRole(BaseProjectRole $projectRole, bool $flag = false): ProjectRole
    {
        if ($this->roleObj->getId() !== $projectRole->getId()) {
            $this->roleObj = $projectRole;

            if ($flag) {
                $this->applyDefaultValuesByRoleObj();
            }
        }

        return $this;
    }
    #endregion

    #region Static Getter Functions
    /**
     * Получить объект класса через статический метод, используя ID роли проекта.
     * @param int $projectRoleId ID роли проекта.
     * @return ProjectRole
     * @throws Exception
     */
    public static function getByProjectRoleId(int $projectRoleId): ProjectRole
    {
        return new ProjectRole(roleId: $projectRoleId, search: true);
    }

    /**
     * Получить объект класса через статический метод, используя минимально необъодимые данные для поиска.
     * @param int|string $lvl Уровень достпа.
     * @param int $objectId ID объекта (проект, подпроект, группа, дом, этап).
     * @param int $userId ID пользователя.
     * @return ProjectRole
     * @throws Exception
     */
    public static function getByMinimumData(int|string $lvl, int $objectId, int $userId): ProjectRole
    {
        return new ProjectRole(userId: $userId, lvl: $lvl, objectId: $objectId, search: true);
    }

    /**
     * Получить объект класса через статический метод с свойствами по умолчанию.
     * Т.е. свойства класса выставлены по умолчанию в соответсвенно с БД или равны NULL.
     * @return ProjectRole
     * @throws Exception
     */
    public static function getDefault(): ProjectRole
    {
        return new ProjectRole();
    }
    #endregion

    #region CRUD Functions
    /**
     * Назначение знечений с проверкой на их наличие, для свойства класса $roleObj.
     * @param BaseProjectRole $object
     * @return void
     */
    private function extracted(BaseProjectRole &$object): void
    {
        if ($this->lvl) $object->setLvl($this->lvl);
        if ($this->isCrud !== null) $object->setIsCrud($this->isCrud);
        if ($this->userId !== null) $object->setUserId($this->userId);
        if ($this->objectId !== null) $object->setObjectId($this->objectId);
    }

    /**
     * Поиск и заполнение свойств класса, в соотвествие с ранее переданными данными, иначе ошибка.
     * @return ProjectRole
     * @throws NoProjectFoundException
     */
    public function searchOrThrow(): ProjectRole
    {
        if ($this->roleId) $this->applyDefaultValuesByRoleId();
        else $this->applyDefaultValuesBySearch();

        if (!$this->roleObj) throw new NoProjectFoundException();

        return $this;
    }

    /**
     * Добавление новой роли в проект.
     * @throws PropelException
     */
    public function add(): ProjectRole
    {
        $role = new DbProjectRole();

        $role
            ->setLvl($this->lvl)
            ->setIsCrud($this->isCrud)
            ->setUserId($this->userId)
            ->setObjectId($this->objectId)
            ->save();

        $this->roleId = $role->getId();

        return $this;
    }

    /**
     * Обновление роли проекта.
     * @throws Exception
     */
    public function update(): ProjectRole
    {
        if (!$this->roleObj) $this->searchOrThrow();

        $this->extracted($this->roleObj);
        $this->roleObj->save();

        return $this;
    }

    /**
     * Удаление роли проекта.
     * @throws Exception
     */
    public function delete(): ProjectRole
    {
        if (!$this->roleObj) $this->searchOrThrow();

        $this->roleObj->delete();

        return $this;
    }

    /**
     * Добавление или обновление роли проекта.
     * @throws PropelException
     * @throws Exception
     */
    public function addOrUpdate(): ProjectRole
    {
        if ($this->isCrud === null) {
            $this->delete();
        }
        else {
            if (!$this->roleObj) {
                $this->roleObj = ProjectRoleQuery::create()
                    ->filterByLvl($this->lvl)
                    ->filterByUserId($this->userId)
                    ->filterByObjectId($this->objectId)
                    ->findOneOrCreate();
            }

            $this->extracted($this->roleObj);
            $this->roleObj->save();
        }

        return $this;
    }
    #endregion
}