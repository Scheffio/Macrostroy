<?php

namespace wipe\inc\v1\trash;

use DB\Base\ObjProjectQuery;
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
use DB\ProjectRoleQuery;
use DB\UserRoleQuery;
use DB\UsersQuery;
use DB\VolMaterialQuery;
use DB\VolTechnicQuery;
use DB\VolWorkMaterialQuery;
use DB\VolWorkQuery;
use DB\VolWorkTechnicQuery;
use Illuminate\Support\Js;
use inc\artemy\v1\json_output\JsonOutput;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\Exception\PropelException;
use wipe\inc\v1\access_lvl\AccessLvl;
use wipe\inc\v1\access_lvl\enum\eLvlObjInt;
use wipe\inc\v1\access_lvl\exception\InvalidAccessLvlIntException;
use wipe\inc\v1\objects\Objects;
use wipe\inc\v1\role\project_role\exception\IncorrectLvlException;
use wipe\inc\v1\role\user_role\AuthUserRole;
use wipe\inc\v1\role\user_role\exception\NoRoleFoundException;
use wipe\inc\v1\role\user_role\exception\NoUserFoundException;

class ProjectRoleSelectorV1
{
    public static function getUsersCrudForObj(int &$lvl, int &$objId, ?int $userId = null)
    {
        $users = self::getUsersData($userId);
        $parents = self::getParentsForObj($lvl, $objId);
        $conditions = self::formingConditionByParents($parents);
        $accesses = self::getProjectRoles($conditions, $userId);

        JsonOutput::success([
            '$users' => $users,
            '$parents' => $parents,
            '$conditions' => $conditions,
            '$accesses' => $accesses,
        ]);
    }

    public static function getAuthUserCrudForObj(int &$lvl, int &$objId)
    {

    }

    public static function getAuthUserCrudForLvl(int &$lvl, int &$parentId)
    {

    }

    #region Getter Query Functions
    /**
     * Запрос на вывод данных пользователя(-ей).
     * @param int|null $userId ID пользователя.
     * @return UsersQuery
     * @throws PropelException
     */
    private static function getUsersQuery(?int $userId = null): UsersQuery
    {
        $i = UsersQuery::create()
            ->select([
                UsersTableMap::COL_ID,
                UsersTableMap::COL_USERNAME,
                UserRoleTableMap::COL_MANAGE_USERS,
                UserRoleTableMap::COL_OBJECT_VIEWER,
                UserRoleTableMap::COL_MANAGE_OBJECTS,
                UserRoleTableMap::COL_MANAGE_VOLUMES,
                UserRoleTableMap::COL_MANAGE_HISTORY,
            ])
            ->leftJoinUserRole()
            ->orderByUsername();

        if ($userId) {
            $i->filterById($userId);
        }

        return $i;
    }

    /**
     * Запрос на вывод IDs родителей объекта/уровня, без условий.
     * @param int $lvl Уровень доступа.
     * @return ObjGroupQuery|ObjGroupVersionQuery|ObjHouseQuery|\DB\ObjProjectQuery|ObjStageMaterialQuery|ObjStageQuery|ObjStageTechnicQuery|ObjStageVersionQuery|ObjStageWorkQuery|ObjSubprojectQuery|ProjectRoleQuery|UserRoleQuery|UsersQuery|VolMaterialQuery|VolTechnicQuery|VolWorkMaterialQuery|VolWorkQuery|VolWorkTechnicQuery
     * @throws PropelException
     */
    private static function getParentsQuery(int $lvl): UsersQuery|ObjGroupQuery|VolMaterialQuery|ObjGroupVersionQuery|VolWorkMaterialQuery|\DB\ObjProjectQuery|ObjStageQuery|ObjStageTechnicQuery|UserRoleQuery|VolWorkQuery|ProjectRoleQuery|ObjSubprojectQuery|ObjHouseQuery|ObjStageMaterialQuery|ObjStageVersionQuery|VolTechnicQuery|VolWorkTechnicQuery|ObjStageWorkQuery
    {
        return ObjProjectQuery::create()
            ->distinct()
            ->select(array_merge(
                [ObjProjectTableMap::COL_ID],
                ($lvl >= eLvlObjInt::SUBPROJECT->value ? [ObjSubprojectTableMap::COL_ID] : []),
                ($lvl >= eLvlObjInt::GROUP->value ? [ObjGroupTableMap::COL_ID] : []),
                ($lvl >= eLvlObjInt::HOUSE->value ? [ObjHouseTableMap::COL_ID] : []),
                ($lvl >= eLvlObjInt::STAGE->value ? [ObjStageTableMap::COL_ID] : []),
            ))
            ->useObjSubprojectQuery(joinType: Criteria::LEFT_JOIN)
            ->useObjGroupQuery(joinType: Criteria::LEFT_JOIN)
            ->useObjHouseQuery(joinType: Criteria::LEFT_JOIN)
            ->leftJoinObjStage()
            ->endUse()
            ->endUse()
            ->endUse();
    }

    /**
     * Запрос на вывод IDs родителей объекта.
     * @param int $lvl Уровень досиупа.
     * @param int $objId ID родителя объекта.
     * @return UsersQuery|ObjGroupQuery|VolMaterialQuery|ObjGroupVersionQuery|VolWorkMaterialQuery|\DB\ObjProjectQuery|ObjStageQuery|ObjStageTechnicQuery|UserRoleQuery|VolWorkQuery|ProjectRoleQuery|ObjSubprojectQuery|ObjHouseQuery|ObjStageMaterialQuery|ObjStageVersionQuery|VolTechnicQuery|VolWorkTechnicQuery|ObjStageWorkQuery
     * @throws IncorrectLvlException
     * @throws PropelException
     */
    private static function getParentsQueryForObj(int $lvl, int $objId): UsersQuery|ObjGroupQuery|VolMaterialQuery|ObjGroupVersionQuery|VolWorkMaterialQuery|\DB\ObjProjectQuery|ObjStageQuery|ObjStageTechnicQuery|UserRoleQuery|VolWorkQuery|ProjectRoleQuery|ObjSubprojectQuery|ObjHouseQuery|ObjStageMaterialQuery|ObjStageVersionQuery|VolTechnicQuery|VolWorkTechnicQuery|ObjStageWorkQuery
    {
        $i = self::getParentsQuery($lvl);

        if ($objId) {
            $colId = Objects::getColIdByLvl($lvl);
            $i->where($colId . '=?', $objId);
        }

        return $i;
    }

    /**
     * Запрос на вывод IDs родителей уровня.
     * @param int $lvl Уровень досиупа.
     * @param int $parentId ID родителя объекта.
     * @return UsersQuery|ObjGroupQuery|VolMaterialQuery|ObjGroupVersionQuery|VolWorkMaterialQuery|\DB\ObjProjectQuery|ObjStageQuery|ObjStageTechnicQuery|UserRoleQuery|VolWorkQuery|ProjectRoleQuery|ObjSubprojectQuery|ObjHouseQuery|ObjStageMaterialQuery|ObjStageVersionQuery|VolTechnicQuery|VolWorkTechnicQuery|ObjStageWorkQuery
     * @throws InvalidAccessLvlIntException
     * @throws PropelException
     * @throws IncorrectLvlException
     */
    private static function getParentsQueryForLvl(int $lvl, int $parentId): UsersQuery|ObjGroupQuery|VolMaterialQuery|ObjGroupVersionQuery|VolWorkMaterialQuery|\DB\ObjProjectQuery|ObjStageQuery|ObjStageTechnicQuery|UserRoleQuery|VolWorkQuery|ProjectRoleQuery|ObjSubprojectQuery|ObjHouseQuery|ObjStageMaterialQuery|ObjStageVersionQuery|VolTechnicQuery|VolWorkTechnicQuery|ObjStageWorkQuery
    {
        $i = self::getParentsQuery($lvl);

        if ($parentId) {
            $preLvl = AccessLvl::getPreLvlIntObj($lvl);
            $colId = Objects::getColIdByLvl($preLvl);
            $i->where($colId . '=?', $parentId);
        }

        return $i;
    }

    /**
     * Запрос на вывод роле проекта.
     * @param array $where Массив условий.
     * @param int|null $userId ID пользователя.
     * @return ProjectRoleQuery|Criteria
     * @throws PropelException
     */
    private static function getProjectRolesQuery(array $conditions, ?int $userId = null): ProjectRoleQuery|Criteria
    {
        $i = ProjectRoleQuery::create()
            ->select([
                ProjectRoleTableMap::COL_LVL,
                ProjectRoleTableMap::COL_IS_CRUD,
                ProjectRoleTableMap::COL_OBJECT_ID,
                ProjectRoleTableMap::COL_USER_ID,
            ]);

        if ($conditions) {
            foreach ($conditions as $key=>$value) {
                $i->_or()
                    ->condition("{$key}1", ProjectRoleTableMap::COL_LVL . '=?', $value[ProjectRoleTableMap::COL_LVL])
                    ->condition("{$key}2", ProjectRoleTableMap::COL_OBJECT_ID . '=?', $value[ProjectRoleTableMap::COL_OBJECT_ID])
                    ->where(["{$key}1", "{$key}2"], Criteria::LOGICAL_AND);
            }
        }

        if ($userId) {
            $i->filterByUserId($userId);
        }

        return $i;
    }
    #endregion

    #region Getter Function
    /**
     * Массив данных об авторизированном пользователе.
     * @return array
     * @throws NoRoleFoundException
     * @throws NoUserFoundException
     */
    private static function getAuthUserData(): array
    {
        return [
            UsersTableMap::COL_ID => AuthUserRole::getUserId(),
            UsersTableMap::COL_USERNAME => AuthUserRole::getUserName(),
            UserRoleTableMap::COL_MANAGE_USERS => AuthUserRole::isAccessManageUsers(),
            UserRoleTableMap::COL_OBJECT_VIEWER => AuthUserRole::isAccessObjectViewer(),
            UserRoleTableMap::COL_MANAGE_OBJECTS => AuthUserRole::isAccessManageObjects(),
            UserRoleTableMap::COL_MANAGE_VOLUMES => AuthUserRole::isAccessManageVolumes(),
            UserRoleTableMap::COL_MANAGE_HISTORY => AuthUserRole::isAccessManageHistory(),
        ];
    }

    /**
     * Массив данных о пользователях.
     * @param int|null $userId ID пользователя.
     * @return array
     * @throws PropelException
     */
    private static function getUsersData(?int $userId = null): array
    {
        return self::getUsersQuery($userId)->find()->getData();
    }

    /**
     * Массив IDs родителей объекта.
     * @param int $lvl Уровень доступа.
     * @param int $objId ID объекта.
     * @return array
     * @throws IncorrectLvlException
     * @throws PropelException
     */
    private static function getParentsForObj(int $lvl, int $objId)
    {
        return (array)self::getParentsQueryForObj($lvl, $objId)->findOne();
    }

    /**
     * Массив IDs родителей уровня.
     * @param int $lvl Уровень доступа.
     * @param int $parentId ID родительсткого объекта.
     * @return array
     * @throws IncorrectLvlException
     * @throws InvalidAccessLvlIntException
     * @throws PropelException
     */
    private static function getParentsForLvl(int $lvl, int $parentId)
    {
        return self::getParentsQueryForLvl($lvl, $parentId)->find()->getData();
    }

    /**
     * Массив роле проекта.
     * @param array $conditions Массив условий.
     * @param int|null $userId ID пользователя.
     * @return array
     * @throws PropelException
     */
    private static function getProjectRoles(array &$conditions, ?int $userId = null)
    {
        return self::getProjectRolesQuery($conditions, $userId)->find()->getData();
    }
    #endregion

    #regions Access Functions

    #endregion

    #region Forming Functions
    /**
     * Формирование данных условий для вывода ролей проекта по IDs родителей.
     * @param array $parents Массив IDs родителей.
     * @return array
     * @throws InvalidAccessLvlIntException
     */
    private static function formingConditionByParents(array &$parents): array
    {
        $i = [];

        foreach ($parents as $key=>&$value) {
            $i[$key] = [
                ProjectRoleTableMap::COL_LVL => AccessLvl::getLvlIntObjByColId($key),
                ProjectRoleTableMap::COL_OBJECT_ID => $value,
            ];
        }

        return $i;
    }

    private static function mergeCrudByUser(array $crud, array $users)
    {
        foreach ($users as $user) {
            $user['crud'] = [
                ProjectRoleTableMap::COL_LVL => null,
                ProjectRoleTableMap::COL_IS_CRUD => null,
                ProjectRoleTableMap::COL_OBJECT_ID => null,
            ];

            foreach ($crud as $access) {
                if ($access[ProjectRoleTableMap::COL_USER_ID] !== $user[UsersTableMap::COL_ID]) continue;

                if ($user['crud'][ProjectRoleTableMap::COL_LVL] < $crud[ProjectRoleTableMap::COL_LVL] &&
                    $user['crud'][ProjectRoleTableMap::COL_OBJECT_ID] !== $crud[ProjectRoleTableMap::COL_OBJECT_ID]) {

                }
            }
        }
    }
    #endregion
}