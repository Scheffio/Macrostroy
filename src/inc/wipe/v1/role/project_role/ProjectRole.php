<?php
namespace wipe\inc\v1\role\project_role;

use DB\Base\ObjProjectQuery;
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
use DB\ObjGroupQuery;
use DB\ObjGroupVersionQuery;
use DB\ObjHouseQuery;
use DB\ObjStageMaterialQuery;
use DB\ObjStageQuery;
use DB\ObjStageTechnicQuery;
use DB\ObjStageVersionQuery;
use DB\ObjStageWorkQuery;
use DB\ObjSubprojectQuery;
use DB\UserRoleQuery;
use DB\UsersQuery as DbUsersQuery;
use DB\ObjProjectQuery as DbObjProjectQuery;
use DB\VolMaterialQuery;
use DB\VolTechnicQuery;
use DB\VolWorkMaterialQuery;
use DB\VolWorkQuery;
use DB\VolWorkTechnicQuery;
use ext\DB;
use ext\ProjectRole as ExtProjectRole;
use DB\Base\ProjectRole as BaseProjectRole;
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
use wipe\inc\v1\role\user_role\AuthUserRole;
use wipe\inc\v1\role\user_role\exception\NoUserFoundException;

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
     * Разрешен ли пользователю CRUD по объекту.
     * @param int $lvl Номер уровня доступа.
     * @param int $userId ID пользователя.
     * @param int|null $objId ID объекта.
     * @return bool
     * @throws IncorrectLvlException
     * @throws InvalidAccessLvlIntException
     * @throws PropelException
     */
    public static function isAccessCrudObj(int $lvl, int $userId, ?int $objId = null): bool
    {
        return self::getCrudUsersByObj($lvl, $objId, $userId)[0]['isCrud'] ?? false;
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

    public static function getAuthUserCrudByLvl(int &$lvl, int &$parentId): array
    {
        $userId = 17;




        $parents = self::getParentsForLvl($lvl, $parentId);
//        self::formingParentsAsCondition($parents);

        JsonOutput::success($parents);

//        $parents = self::getParentsForObj($lvl, $objId);
//        self::formingParentsAsCondition($parents);
//
//        $if = self::formingParentsAsIf($parents);
//        $users = self::getUsersCrud($if, $userId);

//        $parents = self::getParentsForObj($lvl, $objId);
//        $if = self::formingParentsAsIf($parents);
//        $users = self::getUsersCrud($if, $userId);

//        JsonOutput::success($users);

        return [];
    }

    public static function getUserCrudById(int &$lvl, int &$userId, ?int &$projectId): array
    {
//        $user = self::getUsersQuery($lvl, $projectId, $userId)->find()->getData();
//
//        if ($user) {
//            self::formingUsersDataById($user);
//            self::filterUsersCrudByLvl($lvl, $user);
//        } else throw new NoUserFoundException();
//
//        return $user[0];

        return [];
    }

    private static function getCrudByLvl(int $lvl, int $userId, array $parents)
    {
//        $query = ProjectRoleQuery::create()
//                ->select([
//                    ProjectRoleTableMap::COL_LVL,
//                    ProjectRoleTableMap::COL_IS_CRUD,
//                    ProjectRoleTableMap::COL_OBJECT_ID,
//                ])
//                ->where(ProjectRoleTableMap::COL_LVL . '>=?', $lvl);
//
//        if ($parentId) {
//
//        }
    }
    #endregion

    #region Static Select CRUD Users Object
    /**
     * Возвращает массив разрешений пользователей.
     * @param int $lvl Уроыень доступа.
     * @param int|null $objId ID объекта.
     * @param int|null $userId ID пользователя.
     * @return array
     * @throws IncorrectLvlException
     * @throws InvalidAccessLvlIntException
     * @throws PropelException
     */
    public static function getCrudUsersByObj(int &$lvl, ?int $objId = null, ?int $userId = null): array
    {
        $parents = self::getParentsForObj($lvl, $objId);
        self::formingParentsAsCondition($parents);

        $if = self::formingParentsAsIf($parents);
        $users = self::getUsersCrud($if, $userId);

        return self::formingUsers($users);
    }

    /**
     * Взвращает массив IDs родителей объекта.
     * @param int $lvl Уровень доступа.
     * @param int $objId ID объекта.
     * @return array
     * @throws IncorrectLvlException
     * @throws PropelException
     */
    private static function getParentsForObj(int &$lvl, int &$objId): array
    {
        $query = self::getParentsQuery($lvl);

        if ($objId) {
            $colId = Objects::getColIdByLvl($lvl);
            $query->where($colId . '=?', $objId);
        }

        $query = $query->findOne();

        return self::formingParentsResult($lvl, $query);
    }

    /**
     * Возвращает массив IDs родителей уровня.
     * @param int $lvl Уровень доступа.
     * @param int $parentId ID родителя.
     * @return array
     * @throws IncorrectLvlException
     * @throws InvalidAccessLvlIntException
     * @throws PropelException
     */
    private static function getParentsForLvl(int &$lvl, int &$parentId): array
    {
        $query = self::getParentsQuery($lvl);

        if ($parentId) {
            $preLvl = AccessLvl::getPreLvlIntObj($lvl);
            $colId = Objects::getColIdByLvl($preLvl);
            $query->where($colId . '=?', $parentId);
        }

        $query = $query->find()->getData();

        return self::formingParentsResult($lvl, $query);
    }

    /**
     * Возвращает запрос на вывод IDs родителей объекта(уровня), без условия.
     * @return ObjGroupQuery|ObjGroupVersionQuery|ObjHouseQuery|DbObjProjectQuery|ObjStageMaterialQuery|ObjStageQuery|ObjStageTechnicQuery|ObjStageVersionQuery|ObjStageWorkQuery|ObjSubprojectQuery|\DB\ProjectRoleQuery|UserRoleQuery|DbUsersQuery|VolMaterialQuery|VolTechnicQuery|VolWorkMaterialQuery|VolWorkQuery|VolWorkTechnicQuery
     * @throws PropelException
     */
    private static function getParentsQuery(int $lvl): ObjGroupQuery|ObjGroupVersionQuery|ObjHouseQuery|DbObjProjectQuery|ObjStageMaterialQuery|ObjStageQuery|ObjStageTechnicQuery|ObjStageVersionQuery|ObjStageWorkQuery|ObjSubprojectQuery|\DB\ProjectRoleQuery|UserRoleQuery|DbUsersQuery|VolMaterialQuery|VolTechnicQuery|VolWorkMaterialQuery|VolWorkQuery|VolWorkTechnicQuery
    {
        return  ObjProjectQuery::create()
//                ->select([
//                    ObjProjectTableMap::COL_ID,
//                    ObjSubprojectTableMap::COL_ID,
//                    ObjGroupTableMap::COL_ID,
//                    ObjHouseTableMap::COL_ID,
//                    ObjStageTableMap::COL_ID,
//                ])
                ->withColumn( 'IF(' . $lvl . '>=' . eLvlObjInt::PROJECT->value . ',' . ObjProjectTableMap::COL_ID . ',0)', ObjProjectTableMap::COL_ID)
                ->useObjSubprojectQuery(joinType: Criteria::LEFT_JOIN)
                    ->useObjGroupQuery(joinType: Criteria::LEFT_JOIN)
                        ->useObjHouseQuery(joinType: Criteria::LEFT_JOIN)
                            ->leftJoinObjStage()
                        ->endUse()
                    ->endUse()
                ->endUse();
    }

    /**
     * Возвращает массив пользователей, с их разрешениями на объект, соблюдая переданное условие.
     * @param string $if Строка условия.
     * @param int|null $userId ID польозвателя.
     * @return array
     * @throws PropelException
     */
    private static function getUsersCrud(string &$if, ?int $userId = null): array
    {
        $query = UsersQuery::create()
            ->distinct()
            ->select([
                UsersTableMap::COL_ID,
                UsersTableMap::COL_USERNAME,
                UserRoleTableMap::COL_MANAGE_USERS,
                UserRoleTableMap::COL_OBJECT_VIEWER,
                UserRoleTableMap::COL_MANAGE_OBJECTS,
                UserRoleTableMap::COL_MANAGE_VOLUMES,
                UserRoleTableMap::COL_MANAGE_HISTORY,
            ])
            ->withColumn(self::replaceValueInIf($if, ProjectRoleTableMap::COL_LVL), 'lvl')
            ->withColumn(self::replaceValueInIf($if, ProjectRoleTableMap::COL_IS_CRUD), 'isCrud')
            ->withColumn(self::replaceValueInIf($if, ProjectRoleTableMap::COL_OBJECT_ID), 'objId')
            ->leftJoinUserRole()
            ->leftJoinProjectRole()
            ->orderByUsername(Criteria::ASC);

        if ($userId) {
            $query->filterById($userId);
        }

        return $query->find()->getData();
    }

    /**
     * Разрешен ли CRUD объекта для пользователя.
     * @param int|bool|null $crud Разрешение пользователя на объект.
     * @param array $user Данные о пользователе.
     * @return bool|null
     */
    private static function isCrud(null|int|bool &$crud, array &$user): ?bool
    {
        if ($user[UserRoleTableMap::COL_MANAGE_USERS]) return true;
        if ($crud !== null) return (bool)$crud;
        if ($user[UserRoleTableMap::COL_MANAGE_OBJECTS]) return true;
        if ($user[UserRoleTableMap::COL_OBJECT_VIEWER]) return false;

        return null;
    }

    /**
     * Возвращает строку, с замененным значением при true условия.
     * @param string $if Строка с условием для вывода.
     * @param string $true Значение, которое выводится при true условия.
     * @return string
     */
    private static function replaceValueInIf(string $if, string $true): string
    {
        return str_replace('true', $true, $if);
    }

    /**
     * Корректирование массива данных IDs родителей объекта (уровня).
     * @param int $lvl Уровень доступа.
     * @param array|null $result Результат запроса.
     * @return array
     */
    private static function formingParentsResult(int &$lvl, null|array &$result): array
    {
        if ($result) {
            if (array_key_exists(ObjProjectTableMap::COL_ID, $result)) {
                return array_slice($result, 0, $lvl);
            } else {
                foreach ($result as &$item) {
                    $item = self::formingParentsResult($lvl, $item);
                }
            }
        }

        return $result ?? [];
    }

    /**
     * Формирование массива IDs родителей объекта, в качестве условий.
     * @param array $parents Массив IDs родителей объекта.
     * @return void
     * @throws InvalidAccessLvlIntException
     */
    private static function formingParentsAsCondition(array &$parents): void
    {
        foreach ($parents as $key=>&$value) {
            $lvl = AccessLvl::getLvlIntObjByColId($key);
            $wLvl = ProjectRoleTableMap::COL_LVL . '=' . $lvl;
            $wObjId = ProjectRoleTableMap::COL_OBJECT_ID . '=' . $value;
            $value = [$wLvl, $wObjId];
        }
    }

    /**
     * Формирование массива IDs родителей объекта, в качестве условий по уровню и ID объекта для таблицы ролей проекта.
     * @param array $parents Массив IDs родителей объекта.
     * @return string
     */
    private static function formingParentsAsIf(array $parents): string
    {
        foreach ($parents as &$parent) {
            $parent = "($parent[0] AND $parent[1])";
        }

        return 'IF(' . join(' OR ', $parents) . ', true, NULL)';
    }

    /**
     * Форирование массива пользователей.
     * @param array $users Массив пользователей.
     * @return array
     */
    private static function formingUsers(array &$users): array
    {
        $result = [];

        foreach ($users as &$user) {
            $id =& $user[UsersTableMap::COL_ID];
            $flag = array_key_exists($id, $result);

            if ($flag &&
                $result[$id]['lvl'] !== null &&
                $result[$id]['lvl'] > (int)$user['lvl']) continue;
            elseif (!$flag) $result[$id] =& $user;
            else {
                $result[$id]['lvl'] =& $user['lvl'];
                $result[$id]['isCrud'] =& $user['isCrud'];
                $result[$id]['objId'] =& $user['objId'];
            }
        }

        foreach ($result as &$item) {
            $item = [
                'id' => $item[UsersTableMap::COL_ID],
                'name' => $item[UsersTableMap::COL_USERNAME],
                'isCrud' => self::isCrud($item['isCrud'], $item),
                'isAdmin' => (bool)$item[UserRoleTableMap::COL_MANAGE_USERS]
            ];
        }

        return array_values($result);
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