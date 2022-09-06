<?php

namespace wipe\inc\v1\role\project_role;

use DB\Base\UsersQuery;
use DB\Map\ProjectRoleTableMap;
use DB\Map\UserRoleTableMap;
use DB\Map\UsersTableMap;
use Exception;
use DB\Base\ProjectRoleQuery;
use DB\Base\ProjectRole as BaseProjectRole;
use Propel\Runtime\Exception\PropelException;
use wipe\inc\v1\access_lvl\AccessLvl;
use wipe\inc\v1\access_lvl\exception\InvalidAccessLvlIntException;
use wipe\inc\v1\access_lvl\exception\InvalidAccessLvlStrException;
use wipe\inc\v1\role\project_role\enum\eLvlInt;
use wipe\inc\v1\role\project_role\enum\eLvlStr;
use wipe\inc\v1\role\project_role\exception\IncorrectLvlException;
use wipe\inc\v1\role\project_role\exception\NoAccessCrudException;
use wipe\inc\v1\role\project_role\exception\NoProjectFoundException;
use wipe\inc\v1\role\user_role\exception\NoRoleFoundException;
use wipe\inc\v1\role\user_role\exception\NoUserFoundException;
use wipe\inc\v1\role\user_role\UserRole;
use ext\DB;
use ext\ProjectRole as ExtProjectRole;

class ProjectRole
{
    /** @var int|null ID роли проекта. */
    private ?int $roleId = null;

    /** @var ExtProjectRole|BaseProjectRole|null Объект роли проекта.  */
    private null|ExtProjectRole|BaseProjectRole $roleObj = null;

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
     * @throws IncorrectLvlException
     * @throws NoRoleFoundException
     * @throws NoUserFoundException
     */
    function __construct(
        ?int $roleId = null,
        ?int $userId = null,
        int|string $lvl = 1,
        ?int $objectId = null,
        ?int $projectId = null,
        bool $search = false)
    {
        $this->roleId = $roleId;
        $this->userId = $userId;
        $this->objectId = $objectId;
        $this->projectId = $projectId;
        $this->setLvl($lvl);

        if ($search) {
            $this->applyDefaultValuesBySearch();
        }
    }

    #region Apply Default Values Functions
    /**
     * Заполнение свойств класса, используя поиск по переданным первоначально значениям.
     * @return void
     * @throws IncorrectLvlException
     * @throws NoRoleFoundException
     * @throws NoUserFoundException
     */
    private function applyDefaultValuesBySearch(): void
    {
        $role = ProjectRoleQuery::create();

        if ($this->roleId) $role->filterById($this->roleId);
        if ($this->userId) $role->filterByUserId($this->userId);
        if ($this->lvl) $role->filterByLvl($this->lvl);
        if ($this->objectId) $role->filterByObjectId($this->objectId);
        if ($this->projectId) $role->filterByProjectId($this->projectId);

        $role = $role->findOne();

        if ($role !== null) {
            $this->roleId = $role->getId();
            $this->roleObj = DB::getExtProjectRole($role);
            $this->applyDefaultValuesByRoleObj();
        }
    }

    /**
     * Заполнение свойств класса, используя ID роли проекта.
     * @return void
     * @throws IncorrectLvlException
     * @throws NoProjectFoundException
     * @throws NoRoleFoundException
     * @throws NoUserFoundException
     */
    private function applyDefaultValuesByRoleId(): void
    {
        $this->roleObj = ProjectRoleQuery::create()->findPk($this->roleId) ??
                         throw new NoProjectFoundException();
        $this->roleObj = DB::getExtProjectRole($this->roleObj);
        $this->applyDefaultValuesByRoleObj();
    }

    /**
     * Заполнение свойств класса, используя объект роли проекта.
     * @return void
     * @throws IncorrectLvlException
     * @throws NoRoleFoundException
     * @throws NoUserFoundException
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
     * @return void
     * @throws NoRoleFoundException
     * @throws NoUserFoundException
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
     * @return bool CRUD объекта разрешен, иначе - ошибка.
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
     * @throws InvalidAccessLvlIntException
     */
    public function getLvlNameByNum(): string
    {
        return AccessLvl::getAccessLvlStrObjByInt($this->lvl);
    }

    /**
     * @return int Номер уровня доступа по его наименованию.
     * @throws InvalidAccessLvlStrException
     */
    public function getLvlNumByName(): int
    {
        return AccessLvl::getAccessLvlIntObjByStr($this->lvlName);
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
     * @param int|string|eLvlInt|eLvlStr $lvl Уровень доступа.
     * @return ProjectRole
     * @throws IncorrectLvlException
     */
    public function setLvl(int|string|eLvlInt|eLvlStr $lvl): ProjectRole
    {
        if (!is_int($lvl) && !is_string($lvl)) {
            $lvl = $lvl->value;
        }

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

    #region Static Select Functions
    /**
     * Вовзвращает массив данных о пользователях для страниц "Управление доступом".
     * @param int $lvl Уровень доступа.
     * @param int $projectId ID проекта.
     * @return array
     * @throws PropelException
     */
    public static function getCrudUsersObject(int $lvl, int $projectId): array
    {
        return  self::formArrayWithUserCrud(
                    self::mergingUserDataById(
                        self::getUsersOnQuery($lvl, $projectId)
                    )
                );
    }

    /**
     * @param int $lvl Уровень доступа.
     * @param int $projectId ID проекта.
     * @return array
     * @throws PropelException
     */
    private static function getUsersOnQuery(int $lvl, int $projectId): array
    {
        return  UsersQuery::create()
                ->select([
                    UsersTableMap::COL_ID,
                    UsersTableMap::COL_USERNAME,
                    UserRoleTableMap::COL_MANAGE_USERS,
                    UserRoleTableMap::COL_OBJECT_VIEWER,
                    UserRoleTableMap::COL_MANAGE_OBJECTS,
                    ProjectRoleTableMap::COL_IS_CRUD,
                    ProjectRoleTableMap::COL_LVL,
                    ProjectRoleTableMap::COL_OBJECT_ID,
                    ProjectRoleTableMap::COL_PROJECT_ID,
                ])
                ->leftJoinUserRole()
                ->leftJoinProjectRole()
                ->addJoinCondition(
                    name: 'ProjectRole',
                    clause: ProjectRoleTableMap::COL_PROJECT_ID.'=?',
                    value: $projectId
                )
                ->filterByIsAvailable(1)
                ->where(ProjectRoleTableMap::COL_LVL . '<=?', $lvl)
                ->_or()
                ->where(ProjectRoleTableMap::COL_LVL . ' IS NULL')
                ->find()
                ->getData();
    }

    /**
     * Объединение данных пользователя по его ID.
     * @param array $users массив данных пользователей.
     * @return array
     */
    private static function mergingUserDataById(array $users): array
    {
        $result = [];

        foreach ($users as $user) {
            $userId = $user['users.id'];

            if (!array_key_exists($userId, $result)) {
                $result[$userId] = [
                    'user' => [
                        'id' => $user['users.id'],
                        'name' => $user['users.username'],
                        'manageUsers' => (bool) $user['user_role.manage_users'],
                        'objectViewer' => (bool) $user['user_role.object_viewer'],
                        'manageObjects' => (bool) $user['user_role.manage_objects'],
                    ],
                    'crud' => []
                ];
            }


            $result[$userId]['crud'][] = [
                'lvl' => $user['project_role.lvl'],
                'isCrud' => $user['project_role.is_crud'],
                'object_id' => $user['project_role.object_id'],
            ];

        }

        return $result;
    }

    /**
     * Формирование массива с пользователями для вывода на странице "Управение достуа".
     * @param array $users Массив данных о пользователе, после фукции self::mergingUserDataById.
     * @return array
     */
    private static function formArrayWithUserCrud(array $users): array
    {
        foreach ($users as &$user) {
            if ($user['user']['manageUsers']) {
                $isCrud = true;
                $isAdmin = true;
            } else {
                $isAdmin = false;
                $isCrud = array_pop($user['crud'])['isCrud'];

                if (is_int($isCrud)) $isCrud = (bool)$isCrud;
                elseif ($user['user']['manageObjects']) $isCrud = true;
                elseif ($user['user']['objectViewer']) $isCrud = false;
            }

            $user = [
                'id' => $user['user']['id'],
                'name' => $user['user']['name'],
                'isCrud' => $isCrud,
                'isAdmin' => $isAdmin,
            ];
        }

        return array_values($users);
    }
    #endregion

    #region CRUD Functions
    /**
     * Назначение знечений с проверкой на их наличие, для свойства класса $roleObj.
     * @param ExtProjectRole|BaseProjectRole $object
     * @return void
     */
    private function extracted(ExtProjectRole|BaseProjectRole $object): void
    {
        if ($this->lvl) $object->setLvl($this->lvl);
        if ($this->isCrud !== null) $object->setIsCrud($this->isCrud);
        if ($this->userId !== null) $object->setUserId($this->userId);
        if ($this->objectId !== null) $object->setObjectId($this->objectId);
        if ($this->projectId !== null) $object->setProjectId($this->projectId);
    }

    /**
     * Поиск и заполнение свойств класса, в соотвествие с ранее переданными данными, иначе ошибка.
     * @return ProjectRole
     * @throws IncorrectLvlException
     * @throws NoProjectFoundException
     * @throws NoRoleFoundException
     * @throws NoUserFoundException
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
        $role = new ExtProjectRole();

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
                $this->roleObj = DB::getExtProjectRole($this->roleObj);
            }

            $this->extracted($this->roleObj);
            $this->roleObj->save();
        }

        return $this;
    }
    #endregion
}