<?php
namespace wipe\inc\v1\role\project_role;

use DB\Base\ProjectRoleQuery;
use DB\Base\UsersQuery;
use DB\Map\ProjectRoleTableMap;
use DB\Map\UserRoleTableMap;
use DB\Map\UsersTableMap;
use ext\DB;
use ext\ProjectRole as ExtProjectRole;
use DB\Base\ProjectRole as BaseProjectRole;
use inc\artemy\v1\json_output\JsonOutput;
use Propel\Runtime\Exception\PropelException;
use wipe\inc\v1\access_lvl\AccessLvl;
use wipe\inc\v1\access_lvl\enum\eLvlObjInt;
use wipe\inc\v1\access_lvl\enum\eLvlObjStr;
use wipe\inc\v1\access_lvl\exception\InvalidAccessLvlIntException;
use wipe\inc\v1\access_lvl\exception\InvalidAccessLvlStrException;
use wipe\inc\v1\role\project_role\exception\NoAccessCrudException;
use wipe\inc\v1\role\project_role\exception\NoProjectRoleFoundException;

class ProjectRole
{
    /** @var int|null ID роли проекта. */
    private ?int $projectRoleId = null;

    /** @var mixed Объект роли проекта.  */
    private null|ExtProjectRole|BaseProjectRole $projectRoleObj = null;

    /** @var int|null Номер уровня доступа. */
    private ?int $lvlInt = null;

    /** @var string|null Наименование уровня доступа. */
    private ?string $lvlStr = null;

    /** @var bool|null Разрешен ли CRUD объекта. */
    private ?bool $isAccessCrud = null;

    /** @var int|null ID проекта. */
    private ?int $projectId = null;

    /** @var int|null ID объекта (проект, подпроект, группа, дом, этап). */
    private ?int $objectId = null;

    /** @var int|null ID пользователя. */
    private ?int $userId = null;

    /**
     * @param int|null $projectRoleId ID роли проекта.
     * @throws InvalidAccessLvlIntException
     * @throws NoProjectRoleFoundException
     */
    function __construct(?int $projectRoleId = null)
    {
        if ($projectRoleId) {
            $this->applyByProjectRoleId();
        } else {
            $this->applyDefault();
        }
    }

    #region Apply Default Values Functions
    /**
     * Заполнить свойства класса по умолчанию.
     * @return void
     */
    public function applyDefault(): void
    {
        $this->lvlInt = eLvlObjInt::PROJECT->value;
        $this->lvlStr = eLvlObjStr::PROJECT->value;
    }

    /**
     * Заполнить свойства класса по ID роли проекта.
     * @return void
     * @throws InvalidAccessLvlIntException
     * @throws NoProjectRoleFoundException
     */
    public function applyByProjectRoleId(): void
    {
        $this->projectRoleObj = ProjectRoleQuery::create()->findPk($this->projectRoleId)
                                ?? throw new NoProjectRoleFoundException();
        $this->projectRoleObj = DB::getExtProjectRole($this->projectRoleObj);
        $this->applyByProjectRoleObj();
    }

    /**
     * Заполнение свойств класса по объекту роли проекта.
     * @return void
     * @throws InvalidAccessLvlIntException
     */
    public function applyByProjectRoleObj(): void
    {
        $this->isAccessCrud = $this->projectRoleObj->getIsCrud();
        $this->objectId = $this->projectRoleObj->getObjectId();
        $this->userId = $this->projectRoleObj->getUserId();
        $this->setAccessLvlByInt($this->projectRoleObj->getLvl());
    }
    #endregion

    #region Access Control Functions
    /** @return bool Разрешен ли CRUD объекта. */
    public function isAccessCrud(): bool
    {
        return !!$this->isAccessCrud;
    }

    /**
     * CRUD объекта разрешен, иначе - ошибка.
     * @return ProjectRole
     * @throws NoAccessCrudException
     */
    public function isAccessCrudOrThrow(): ProjectRole
    {
        return $this->isAccessCrud ? $this : throw new NoAccessCrudException();
    }

    /**
     * Равносилен ли CRUD пользователя NULL.
     * Т.е. пользователю еще не назначали роль для данного проекта.
     * @return bool
     */
    public function isNullCrud(): bool
    {
        return $this->isAccessCrud === null;
    }

    /**
     * Равносилен ли CRUD пользователя NULL, иначе - ошибка.
     * Т.е. пользователю еще не назначали роль для данного проекта.
     * @return ProjectRole
     * @throws NoAccessCrudException
     */
    public function isNullCrudOrThrow(): ProjectRole
    {
        return $this->isAccessCrud === null ? $this : throw new NoAccessCrudException();
    }
    #endregion

    #region Static Access Control Functions

    public static function isAccessCrudByLvl(int $lvl, int $projectId, int $userId)
    {
        return UsersQuery::create()
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
            ->where(ProjectRoleTableMap::COL_LVL . ' IS NULL')->toString();

//        return self::formArrayWithUserCrud(
//            self::mergingUserDataById(
//                self::getUsersOnQuery($lvl, $projectId, $userId)
//            )
//        )[0]['isCrud'] ?? false;
    }
    #endregion

    #region Getter Functions
    /** @return int|null ID роли проекта. */
    public function getProjectRoleId(): ?int
    {
        return $this->projectRoleId;
    }

    /** @return ExtProjectRole|BaseProjectRole|null Объект роли проекта. */
    public function getProjectRoleObj(): null|ExtProjectRole|BaseProjectRole
    {
        return $this->projectRoleObj;
    }

    /** @return int|null Номер уровня доступа. */
    public function getLvlInt(): ?int
    {
        return $this->lvlInt;
    }

    /** @return string|null Наименование уровня доступа. */
    public function getLvlStr(): ?string
    {
        return $this->lvlStr;
    }

    /**
     * @return string Наименование уровня доступа но его номеру.
     * @throws InvalidAccessLvlIntException
     */
    public function getLvlStrByInt(): string
    {
        return AccessLvl::getAccessLvlStrObjByInt($this->lvlInt);
    }

    /**
     * @return int Номер уровня доступа по его наименованию.
     * @throws InvalidAccessLvlStrException
     */
    public function getLvlNumByName(): int
    {
        return AccessLvl::getAccessLvlIntObjByStr($this->lvlStr);
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
    #endregion

    #region Static Getter Functions
    /**
     * Получить объект класса через статический метод, используя ID роли проекта.
     * @param int $id ID роли проекта.
     * @return ProjectRole
     * @throws InvalidAccessLvlIntException
     * @throws NoProjectRoleFoundException
     */
    public static function getByProjectRoleId(int $id): ProjectRole
    {
        return new ProjectRole($id);
    }

    /**
     * Получить объект класса через статический метод, используя минимальные данные для поиска в БД.
     * @param int|string|eLvlObjInt|eLvlObjStr $lvl Уровень доступа.
     * @param int $objectId ID объекта.
     * @param int $userId ID пользователя.
     * @return ProjectRole
     * @throws InvalidAccessLvlIntException
     * @throws InvalidAccessLvlStrException
     * @throws NoProjectRoleFoundException
     */
    public static function getBySearch(int|string|eLvlObjInt|eLvlObjStr $lvl, int $objectId, int $userId): ProjectRole
    {
        $lvl = is_object($lvl) ? $lvl->value : AccessLvl::getLvlIntObj($lvl);

        $p = new ProjectRole();
        $p->searchOrThrow($lvl, $objectId, $userId)->applyByProjectRoleObj();

        return $p;
    }

    /**
     * Получить объект класса через статический метод со значениями по умолчанию.
     * @return ProjectRole
     */
    public static function getDefault(): ProjectRole
    {
        return new ProjectRole();
    }
    #endregion

    #region Static Select Functions
    public static function getUsersByQuery(int $lvl, int $projectId, ?int $userId = null): array
    {
        return self::getUsersQuery($lvl, $projectId, $userId)->find()->getData();
    }

    /**
     * @param int $lvl Номер уровня доступа.
     * @param int $projectId ID проекта.
     * @param int|null $userId ID пользователя.
     * @return \DB\UsersQuery
     * @throws PropelException
     */
    private static function getUsersQuery(int $lvl, int $projectId, ?int $userId = null): \DB\UsersQuery
    {
        $query = UsersQuery::create()
                ->select([
                    UsersTableMap::COL_ID,
                    UsersTableMap::COL_USERNAME,
                    UserRoleTableMap::COL_MANAGE_USERS,
                    UserRoleTableMap::COL_OBJECT_VIEWER,
                    UserRoleTableMap::COL_MANAGE_OBJECTS,
                ])
                ->withColumn('GROUP_CONCAT(project_role.is_crud)', 'is_crud')
                ->withColumn('GROUP_CONCAT(project_role.lvl)', 'lvl')
                ->withColumn('GROUP_CONCAT(project_role.object_id)', 'object_id')
                ->withColumn('GROUP_CONCAT(project_role.project_id)', 'project_id')
                ->groupById()
                ->leftJoinUserRole()
                ->leftJoinProjectRole()
                ->addJoinCondition(
                    name: 'ProjectRole',
                    clause: ProjectRoleTableMap::COL_PROJECT_ID.'=?',
                    value: $projectId
                )
                ->filterByIsAvailable(1);

        if ($userId) {
            $query->filterById($userId);
        }

        return $query;
    }
    #endregion

    #region Static Select Functions
//    /**
//     * Вовзвращает массив данных о пользователях для страниц "Управление доступом".
//     * @param int $lvl Уровень доступа.
//     * @param int $projectId ID проекта.
//     * @return array
//     * @throws PropelException
//     */
//    public static function getCrudUsersObject(int $lvl, int $projectId): array
//    {
//        return self::formArrayWithUserCrud(
//            self::mergingUserDataById(
//                self::getUsersOnQuery($lvl, $projectId)
//            )
//        );
//    }
//
//    /**
//     * @param int $lvl Уровень доступа.
//     * @param int $projectId ID проекта.
//     * @param int|null $userId ID пользователя.
//     * @return array
//     * @throws PropelException
//     */
//    private static function getUsersOnQuery(int $lvl, int $projectId, ?int $userId = null): array
//    {
//        $q = UsersQuery::create()
//            ->select([
//                UsersTableMap::COL_ID,
//                UsersTableMap::COL_USERNAME,
//                UserRoleTableMap::COL_MANAGE_USERS,
//                UserRoleTableMap::COL_OBJECT_VIEWER,
//                UserRoleTableMap::COL_MANAGE_OBJECTS,
//                ProjectRoleTableMap::COL_IS_CRUD,
//                ProjectRoleTableMap::COL_LVL,
//                ProjectRoleTableMap::COL_OBJECT_ID,
//                ProjectRoleTableMap::COL_PROJECT_ID,
//            ])
//            ->leftJoinUserRole()
//            ->leftJoinProjectRole()
//            ->addJoinCondition(
//                name: 'ProjectRole',
//                clause: ProjectRoleTableMap::COL_PROJECT_ID.'=?',
//                value: $projectId
//            )
//            ->filterByIsAvailable(1)
//            ->where(ProjectRoleTableMap::COL_LVL . '<=?', $lvl)
//            ->_or()
//            ->where(ProjectRoleTableMap::COL_LVL . ' IS NULL');
//
//        if ($userId) {
//            $q->filterById($userId);
//        }
//
//        return $q->find()->getData();
//    }
//
//    /**
//     * Объединение данных пользователя по его ID.
//     * @param array $users массив данных пользователей.
//     * @return array
//     */
//    private static function mergingUserDataById(array $users): array
//    {
//        $result = [];
//
//        foreach ($users as $user) {
//            $userId = $user['users.id'];
//
//            if (!array_key_exists($userId, $result)) {
//                $result[$userId] = [
//                    'user' => [
//                        'id' => $user['users.id'],
//                        'name' => $user['users.username'],
//                        'manageUsers' => (bool) $user['user_role.manage_users'],
//                        'objectViewer' => (bool) $user['user_role.object_viewer'],
//                        'manageObjects' => (bool) $user['user_role.manage_objects'],
//                    ],
//                    'crud' => []
//                ];
//            }
//
//
//            $result[$userId]['crud'][] = [
//                'lvl' => $user['project_role.lvl'],
//                'isCrud' => $user['project_role.is_crud'],
//                'object_id' => $user['project_role.object_id'],
//            ];
//
//        }
//
//        return $result;
//    }
//
//    /**
//     * Формирование массива с пользователями для вывода на странице "Управение достуа".
//     * @param array $users Массив данных о пользователе, после фукции self::mergingUserDataById.
//     * @return array
//     */
//    private static function formArrayWithUserCrud(array $users): array
//    {
//        foreach ($users as &$user) {
//            if ($user['user']['manageUsers']) {
//                $isCrud = true;
//                $isAdmin = true;
//            } else {
//                $isAdmin = false;
//                $isCrud = self::getIsCrudByArray(
//                    userCrud: $user['crud'],
//                    isAccessManageObjects: $user['user']['manageObjects'],
//                    isAccessObjectViewer: $user['user']['objectViewer']
//                );
//            }
//
//            $user = [
//                'id' => $user['user']['id'],
//                'name' => $user['user']['name'],
//                'isCrud' => $isCrud,
//                'isAdmin' => $isAdmin,
//            ];
//        }
//
//        return array_values($users);
//    }
//
//    private static function getIsCrudByArray(
//        array $userCrud,
//        bool $isAccessManageObjects,
//        bool $isAccessObjectViewer
//    ): bool
//    {
//        $userCrud = array_replace($userCrud);
//
//        foreach ($userCrud as $crud) {
//            if (is_int($crud['isCrud'])) {
//                return (bool)$crud['isCrud'];
//            }
//        }
//
//        if ($isAccessObjectViewer) return false;
//        if ($isAccessManageObjects) return true;
//
//        return false;
//    }
    #endregion

    #region Setter Functions
    /**
     * Поиск и присваивание свойству класса объект роли проекта ($projectRoleObj).
     * @param int $lvl Уровень доступа.
     * @param int $objectId ID объекта.
     * @param int $userId ID пользователя.
     * @return ProjectRole
     */
    public function search(int $lvl, int $objectId, int $userId): ProjectRole
    {
        $this->projectRoleObj = ProjectRoleQuery::create()
            ->filterByLvl($lvl)
            ->filterByObjectId($objectId)
            ->filterByUserId($userId)
            ->findOne();

        return $this;
    }

    /**
     * Поиск и присваивание свойству класса объект роли проекта ($projectRoleObj), при отсутвие записи в БД - ошибка.
     * @param int $lvl Уровень доступа.
     * @param int $objectId ID объекта.
     * @param int $userId ID пользователя.
     * @return ProjectRole
     * @throws NoProjectRoleFoundException
     */
    public function searchOrThrow(int $lvl, int $objectId, int $userId): ProjectRole
    {
        $this->search($lvl, $objectId, $userId)
            ->getProjectRoleObj() ??
            throw new NoProjectRoleFoundException();

        return $this;
    }

    /**
     * Поиск по ID и присваивание свойству класса объект роли проекта ($projectRoleObj).
     * @return ProjectRole
     */
    public function searchByProjectRoleId(): ProjectRole
    {
        $this->projectRoleObj = ProjectRoleQuery::create()->findPk($this->projectRoleId);
        $this->projectRoleObj = DB::getExtProjectRole($this->getProjectRoleObj());

        return $this;
    }

    /**
     * Поиск по ID и присваивание свойству класса объект роли проекта ($projectRoleObj), при отсутвие записи в БД - ошибка.
     * @return ProjectRole
     * @throws NoProjectRoleFoundException
     */
    public function searchByProjectRoleIdOrThrow(): ProjectRole
    {
        $this->searchByProjectRoleId()->getProjectId() ?? throw new NoProjectRoleFoundException();

        return $this;
    }

    /**
     * @param int $userId ID пользователя.
     * @return $this
     */
    public function setUserId(int $userId): ProjectRole
    {
        if ($userId !== $this->userId) {
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
     * Устонавливает свойства класса ID роли проекта с заполнением остальных свойств.
     * Т.е., используя ID роли проекта заполняются такие свойства как:
     * $projectId, $projectRoleObj, $lvlInt ,$lvlStr ,$isAccessCrud ,$projectId ,$objectId ,$userId.
     * @param int $projectId ID проекта.
     * @return ProjectRole
     * @throws InvalidAccessLvlIntException
     * @throws NoProjectRoleFoundException
     */
    public function setProjectIdAndApply(int $projectId): ProjectRole
    {
        $this->setProjectId($projectId)->applyByProjectRoleId();
        return $this;
    }

    /**
     * @param ExtProjectRole|BaseProjectRole $obj Объект роли проекта.
     * @return ProjectRole
     */
    public function setProjectRoleObj(ExtProjectRole|BaseProjectRole $obj): ProjectRole
    {
        if ($this->projectRoleObj->getId() !== $obj->getId()) {
            if (get_class($obj) !== ExtProjectRole::class) {
                $obj = DB::getExtProjectRole($obj);
            }

            $this->projectRoleObj = $obj;
        }

        return $this;
    }

    /**
     * Устонавливает свойства класса Obj роли проекта с заполнением остальных свойств.
     * Т.е., используя ID роли проекта заполняются такие свойства как:
     * $projectId, $projectRoleObj, $lvlInt ,$lvlStr ,$isAccessCrud ,$projectId ,$objectId ,$userId.
     * @param ExtProjectRole|BaseProjectRole $obj Объект роли проекта.
     * @return $this
     * @throws InvalidAccessLvlIntException
     */
    public function setProjectRoleObjAndApply(ExtProjectRole|BaseProjectRole $obj): ProjectRole
    {
        $this->setProjectRoleObj($obj)->applyByProjectRoleObj();
        return $this;
    }

    /**
     * @param bool|null $isCrud Разрешен ли CRUD объекта.
     * @return ProjectRole
     */
    public function setIsCrud(?bool $isCrud): ProjectRole
    {
        if ($this->isAccessCrud !== $isCrud) {
            $this->isAccessCrud = $isCrud;
        }

        return $this;
    }

    /**
     * Устонавливает номер и наименование уровня доступа.
     * @param int|string|eLvlObjInt|eLvlObjStr $lvl Уровень доступа.
     * @return ProjectRole
     * @throws InvalidAccessLvlIntException
     * @throws InvalidAccessLvlStrException
     */
    public function setAccessLvl(int|string|eLvlObjInt|eLvlObjStr $lvl): ProjectRole
    {
        if (is_object($lvl)) {
            $lvl = $lvl->value;
        }

        return  is_int($lvl)
            ? $this->setAccessLvlByInt($lvl)
            : $this->setAccessLvlByStr($lvl);
    }

    /**
     * Устонавливает номер и наименование уровня доступа по номеру.
     * @param int $lvl Номер уровня доступа.
     * @return ProjectRole
     * @throws InvalidAccessLvlIntException
     */
    public function setAccessLvlByInt(int $lvl): ProjectRole
    {
        if ($lvl !== $this->lvlInt && AccessLvl::isAccessLvlIntObj($lvl)) {
            $this->lvlInt = $lvl;
            $this->lvlStr = AccessLvl::getAccessLvlStrObjByInt($lvl);
        }

        return $this;
    }

    /**
     * Устонавливает номер и наименование уровня доступа по наименованию.
     * @param string $lvl Наименование уровня доступа.
     * @return ProjectRole
     * @throws InvalidAccessLvlStrException
     */
    public function setAccessLvlByStr(string $lvl): ProjectRole
    {
        if ($this->lvlStr !== $lvl && AccessLvl::isAccessLvlStrObj($lvl)) {
            $this->lvlStr = $lvl;
            $this->lvlInt = AccessLvl::getAccessLvlIntObjByStr($lvl);
        }

        return  $this;
    }
    #endregion

    #region CRUD Functions
    /**
     * Добавление новой роли в проект.
     * @throws PropelException
     */
    public function add(): ProjectRole
    {
        $role = new ExtProjectRole();

        $role
            ->setLvl($this->lvlInt)
            ->setIsCrud($this->isAccessCrud)
            ->setUserId($this->userId)
            ->setObjectId($this->objectId)
            ->save();

        $this->projectRoleId = $role->getId();

        return $this;
    }

    /**
     * Обновление роли проекта.
     * @return ProjectRole
     * @throws NoProjectRoleFoundException
     * @throws PropelException
     */
    public function update(): ProjectRole
    {
        if ($this->projectRoleId) $this->searchByProjectRoleIdOrThrow();
        else $this->searchOrThrow($this->lvlInt, $this->objectId, $this->userId);

        $this->updateByObj();

        return $this;
    }

    /**
     * Обновление роли проекта по объекту.
     * @return ProjectRole
     * @throws NoProjectRoleFoundException
     * @throws PropelException
     */
    public function updateByObj(): ProjectRole
    {
        if ($this->projectRoleObj === null) throw new NoProjectRoleFoundException();
        if ($this->lvlInt !== null) $this->projectRoleObj->setLvl($this->lvlInt);
        if ($this->isAccessCrud !== null) $this->projectRoleObj->setIsCrud($this->isAccessCrud);
        if ($this->objectId !== null) $this->projectRoleObj->setObjectId($this->objectId);
        if ($this->projectId !== null) $this->projectRoleObj->setProjectId($this->projectId);
        if ($this->userId !== null) $this->projectRoleObj->setUserId($this->userId);

        $this->projectRoleObj->save();

        return $this;
    }

    /**
     * Добавление или обновление роли проекта.
     * @return ProjectRole
     * @throws NoProjectRoleFoundException
     * @throws PropelException
     */
    public function addOrUpdate(): ProjectRole
    {
        if ($this->isAccessCrud === null) {
            $this->delete();
        } else {
            $this->projectRoleObj = ProjectRoleQuery::create()
                                    ->filterByLvl($this->lvlInt)
                                    ->filterByUserId($this->userId)
                                    ->filterByObjectId($this->objectId)
                                    ->findOneOrCreate();
            $this->projectRoleObj = DB::getExtProjectRole($this->projectRoleObj);
        }

        return $this->updateByObj();
    }

    /**
     * Удаление роли проекта.
     * @return ProjectRole
     * @throws NoProjectRoleFoundException
     * @throws PropelException
     */
    public function delete(): ProjectRole
    {
        if ($this->projectRoleId) $this->searchByProjectRoleIdOrThrow();
        else $this->searchOrThrow($this->lvlInt, $this->objectId, $this->userId);

        $this->deleteByObj();

        return $this;
    }

    /**
     * Удаление роли проекта по объекту.
     * @return ProjectRole
     * @throws PropelException
     */
    public function deleteByObj(): ProjectRole
    {
        $this->projectRoleObj->delete();
        return $this;
    }
    #endregion
}