<?php

namespace wipe\inc\v1\role\project_role;

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

class ProjectRoleSelector
{
    public static function getUsersCrudForObj()
    {

    }

    public static function getAuthUserCrudForObj()
    {

    }

    public static function getAuthUserCrudForLvl()
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
            ->leftJoinProjectRole();

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
            ->select([
                $lvl >= eLvlObjInt::PROJECT->value ? ObjProjectTableMap::COL_ID : null,
                $lvl >= eLvlObjInt::SUBPROJECT->value ? ObjSubprojectTableMap::COL_ID : null,
                $lvl >= eLvlObjInt::GROUP->value ? ObjGroupTableMap::COL_ID : null,
                $lvl >= eLvlObjInt::HOUSE->value ? ObjHouseTableMap::COL_ID : null,
                $lvl >= eLvlObjInt::STAGE->value ? ObjStageTableMap::COL_ID : null,
            ])
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

    private static function getProjectRolesQuery(array &$where, ?int $userId = null)
    {
        $i = ProjectRoleQuery::create()
            ->select([
                ProjectRoleTableMap::COL_LVL,
                ProjectRoleTableMap::COL_IS_CRUD,
                ProjectRoleTableMap::COL_OBJECT_ID
            ]);

        if ($userId) {
            $i->filterByUserId($userId);
        }

        if ($where) {
            foreach ($where as $item) {
                $i->_or()
                    ->condition('', $item[0])
                    ->condition('', $item[1])
            }
        }
    }
    #endregion

    #region Getter Function
    /**
     * Возвращает данные об авторизированном пользователе.
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

    private static function getParentsForObj()
    {

    }

    private static function getParentsForLvl()
    {

    }
    #endregion
}