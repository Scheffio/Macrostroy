<?php
namespace wipe\inc\v1\role\project_role;

use DB\Base\ObjProjectQuery;
use DB\Base\ObjStageQuery;
use DB\Base\ProjectRoleQuery;
use DB\Base\UsersQuery;
use DB\Map\ObjGroupTableMap;
use DB\Map\ObjHouseTableMap;
use DB\Map\ObjProjectTableMap;
use DB\Map\ObjStageTableMap;
use DB\Map\ObjSubprojectTableMap;
use DB\Map\ProjectRoleTableMap;
use DB\Map\UserRoleTableMap;
use DB\Map\UsersTableMap;
use DB\UsersQuery as DbUsersQuery;
use DB\ObjProjectQuery as DbObjProjectQuery;
use ext\DB;
use ext\ProjectRole as ExtProjectRole;
use DB\Base\ProjectRole as BaseProjectRole;
use DB\ObjGroup as DbObjGroup;
use DB\ObjHouse as DbObjHouse;
use DB\ObjStage as DbObjStage;
use DB\ObjStageWork as DbObjStageWork;
use DB\ObjSubproject as DbObjSubproject;
use inc\artemy\v1\json_output\JsonOutput;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\Exception\PropelException;
use wipe\inc\v1\access_lvl\AccessLvl;
use wipe\inc\v1\access_lvl\enum\eLvlObjInt;
use wipe\inc\v1\access_lvl\enum\eLvlObjStr;
use wipe\inc\v1\access_lvl\exception\InvalidAccessLvlIntException;
use wipe\inc\v1\access_lvl\exception\InvalidAccessLvlStrException;
use wipe\inc\v1\objects\Objects;
use wipe\inc\v1\role\project_role\exception\IncorrectLvlException;
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
    /**
     * Разрешен ли пользователю CRUD.
     * @param int $lvl Номер уровня доступа.
     * @param int $projectId ID проекта.
     * @param int $objId ID объекта.
     * @param int $userId ID пользователя.
     * @return bool
     * @throws IncorrectLvlException
     * @throws PropelException
     */
    public static function isAccessCrudObj(int $lvl, int $projectId, int $userId, ?int $objId = null): bool
    {
        return self::getCrudUsersByObject($lvl, $projectId, $objId, $userId)[0]['isCrud'] ?? false;
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

    #region Static Select Get CRUD Users Object
    /**
     * Возвращает массив разрешений пользователей.
     * @param int $lvl Номер уровня доступа.
     * @param int $projectId ID проекта.
     * @param int|null $objId ID объекта.
     * @param int|null $userId ID пользователя.
     * @return array
     * @throws IncorrectLvlException
     * @throws PropelException
     */
    public static function getCrudUsersByObject(int $lvl, int $projectId, ?int $objId = null, ?int $userId = null): array
    {
        $parents = null;

        if ($objId) {
            $parents = self::getParentsId($lvl, $objId);
        }

        $users = self::getUsersQuery($lvl, $projectId, $userId)->find()->getData();

        if ($users) {
            self::formingUsersDataById($users);
            self::filterUsersCrudByLvl($lvl, $users);

            if ($parents) {
                self::filterUsersCrudDataByParents($parents, $users);
            }

            self::formingUsersCrud($users);
        }

        return $users;
    }

    /**
     * Получить запрос на вывод пользователей.
     * @param int $lvl Номер уровня доступа.
     * @param int $projectId ID проекта.
     * @param int|null $userId ID пользователя.
     * @return DbUsersQuery
     * @throws PropelException
     */
    private static function getUsersQuery(int $lvl, int $projectId, ?int $userId = null): DbUsersQuery
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

    /**
     * Возвращает массив ID родителей объекта.
     * @param int $lvl Номер уровня доступа.
     * @param int $objId ID объекта.
     * @return array
     * @throws IncorrectLvlException
     * @throws PropelException
     */
    private static function getParentsId(int $lvl, int $objId): array
    {
        $colName = Objects::getColIdByLvl($lvl);
        $obj = DbObjProjectQuery::create()
                ->select([
                    ObjProjectTableMap::COL_ID,
                    ObjSubprojectTableMap::COL_ID,
                    ObjGroupTableMap::COL_ID,
                    ObjHouseTableMap::COL_ID,
                    ObjStageTableMap::COL_ID,
                ])
                ->useObjSubprojectQuery(joinType: Criteria::LEFT_JOIN)
                    ->useObjGroupQuery(joinType: Criteria::LEFT_JOIN)
                        ->useObjHouseQuery(joinType: Criteria::LEFT_JOIN)
                            ->leftJoinObjStage()
                        ->endUse()
                    ->endUse()
                ->endUse()
                ->where($colName.'=?', $objId)
                ->findOne();

        return [
            ObjProjectTableMap::COL_ID => &$obj[ObjProjectTableMap::COL_ID],
            ObjSubprojectTableMap::COL_ID => &$obj[ObjSubprojectTableMap::COL_ID],
            ObjGroupTableMap::COL_ID => &$obj[ObjGroupTableMap::COL_ID],
            ObjHouseTableMap::COL_ID => &$obj[ObjHouseTableMap::COL_ID],
            ObjStageTableMap::COL_ID => &$obj[ObjStageTableMap::COL_ID],
        ];
    }

    /**
     * Формирование данных о пользователе и его разрешениях.
     * @param array $users Массив данных пользователей.
     * @return void
     */
    private static function formingUsersDataById(array &$users): void
    {
        foreach ($users as &$user) {
            $user['crud'] = [];

            if ($user['lvl'] === null) self::formingUserCrudIsNull($user);
            else self::formingUserCrud($user);

            self::formingUserData($user, $user['crud']);
        }
    }

    /**
     * Формирование основных данных о пользователе.
     * @param array $user Массив пользователя.
     * @param array $crud Массив CRUD пользователя.
     * @return void
     */
    private static function formingUserData(array &$user, array &$crud): void
    {
        $user = [
            'user' => [
                'id' => $user['users.id'],
                'name' => $user['users.username'],
                'manageUsers' => (bool) $user['user_role.manage_users'],
                'objectViewer' => (bool) $user['user_role.object_viewer'],
                'manageObjects' => (bool) $user['user_role.manage_objects'],
            ],
            'crud' => $crud
        ];
    }

    /**
     * Формирование CRUD данных о пользователе.
     * @param array $user Массив пользователя.
     * @return void
     */
    private static function formingUserCrud(array &$user): void
    {
        $arrLvl = explode(',', $user['lvl']);
        $arrCrud = explode(',', $user['is_crud']);
        $arrObj = explode(',', $user['object_id']);

        for ($i = 0; $i < count($arrLvl); $i++) {
            $user['crud'][] = [
                'lvl' => (int)$arrLvl[$i],
                'isCrud' => (bool)$arrCrud[$i],
                'object_id' => (int)$arrObj[$i],
            ];
        }
    }

    /**
     * Формирование пустого CRUD пользователя.
     * @param array $user Массив пользователя.
     * @return void
     */
    private static function formingUserCrudIsNull(array &$user): void
    {
        $user['crud'] = [
            'lvl' => null,
            'isCrud' => null,
            'object_id' => null,
        ];
    }

    /**
     * Формирование разрешений пользователей.
     * @param array $users Массив полльзователей.
     * @return void
     */
    private static function formingUsersCrud(array &$users): void
    {
        foreach ($users as &$user) {
            $user = [
                'id' => $user['user']['id'],
                'name' => $user['user']['name'],
                'isCrud' => self::getIsCrudByArray(
                    userCrud: $user['crud'],
                    isAccessManageUsers: $user['user']['manageUsers'],
                    isAccessManageObjects: $user['user']['manageObjects'],
                    isAccessObjectViewer: $user['user']['objectViewer']
                ),
                'isAdmin' => $user['user']['manageUsers']
            ];
        }
    }

    /**
     * Фильстрация массива CRUD разрешений пользователей по номеру уровня доступа.
     * @param int $lvl Номер уровня доступа.
     * @param array $users Массив данных о пользователя.
     * @return void
     */
    private static function filterUsersCrudByLvl(int &$lvl, array &$users): void
    {
        foreach ($users as &$user) {
            $crud =& $user['crud'];

            if (!self::isAssociateCrud($crud)) {
                $count = count($crud);

                for ($i = 0; $i < $count; $i++) {
                    if ($crud[$i]['lvl'] === null) continue;
                    if ($crud[$i]['lvl'] > $lvl) unset($crud[$i]);
                }

                $crud = array_values($user['crud']);
            } elseif ($crud['lvl'] !== null && $crud['lvl'] > $lvl) unset($crud);

            if (!$user['crud']) self::formingUserCrudIsNull($user);
        }
    }

    /**
     * Фильстрация массива CRUD разрешений пользователей по родителям.
     * @param array $parents Массив родительски ID.
     * @param array $users Массив пользователей.
     * @return void
     * @throws IncorrectLvlException
     */
    private static function filterUsersCrudDataByParents(array &$parents, array &$users): void
    {
        foreach ($users as &$user) {
            $crud =& $user['crud'];

            if (!self::isAssociateCrud($crud)) {
                $count = count($crud);

                for ($i = 0; $i < $count; $i++) {
                    $colName = Objects::getColIdByLvl($crud[$i]['lvl']);

                    if ($crud[$i]['object_id'] !== $parents[$colName]) unset($crud[$i]);
                }

                $crud = array_values($user['crud']);
            } elseif ($crud['lvl'] !== null) {
                $colName = Objects::getColIdByLvl($crud['lvl']);

                if ($crud['object_id'] !== $parents[$colName]) unset($crud);
            }

            if (!$user['crud']) self::formingUserCrudIsNull($user);
        }
    }

    /**
     * Проверка, что массив CRUD разрешений пользователя - ассоциативный.
     * @param array $crud Массив CRUD разрешений пользователя.
     * @return bool
     */
    private static function isAssociateCrud(array &$crud): bool
    {
        return array_keys($crud) !== range(0, count($crud) - 1);
    }

    /**
     * Разрешен ли пользователю CRUD.
     * @param array $userCrud Массив CRUD разрешений пользователя.
     * @param bool $isAccessManageUsers Разрешено ли управление пользователя.
     * @param bool $isAccessManageObjects Разрешено ли управление объектами.
     * @param bool $isAccessObjectViewer Разрешен ли просмотр объектов.
     * @return bool
     */
    private static function getIsCrudByArray(
        array $userCrud,
        bool $isAccessManageUsers,
        bool $isAccessManageObjects,
        bool $isAccessObjectViewer
    ): ?bool
    {
        if ($isAccessManageUsers) return true;

        if (!self::isAssociateCrud($userCrud)) {
            $userCrud = array_replace($userCrud);

            foreach ($userCrud as $crud) {
                if ($crud['isCrud'] !== null) {
                    return $crud['isCrud'];
                }
            }
        } elseif ($userCrud['isCrud'] !== null) {
            return $userCrud['isCrud'];
        }

        if ($isAccessManageObjects) return true;
        if ($isAccessObjectViewer) return false;

        return null;
    }
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