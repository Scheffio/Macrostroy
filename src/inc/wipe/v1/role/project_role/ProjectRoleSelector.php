<?php

namespace wipe\inc\v1\role\project_role;

use DB\Map\UserRoleTableMap;
use DB\Map\UsersTableMap;
use DB\UsersQuery;
use Propel\Runtime\Exception\PropelException;
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

    private static function getParentsQuery()
    {
        return  ObjProjectQuery::create()
            ->distinct()
            ->select(['projectId', 'subprojectId', 'groupId', 'houseId','stageId'])
            ->withColumn(self::getIfByLvl($lvl, eLvlObjInt::PROJECT->value, ObjProjectTableMap::COL_ID), 'projectId')
            ->withColumn(self::getIfByLvl($lvl, eLvlObjInt::SUBPROJECT->value, ObjSubprojectTableMap::COL_ID), 'subprojectId')
            ->withColumn(self::getIfByLvl($lvl, eLvlObjInt::GROUP->value, ObjGroupTableMap::COL_ID), 'groupId')
            ->withColumn(self::getIfByLvl($lvl, eLvlObjInt::HOUSE->value, ObjHouseTableMap::COL_ID), 'houseId')
            ->withColumn(self::getIfByLvl($lvl, eLvlObjInt::STAGE->value, ObjStageTableMap::COL_ID), 'stageId')
            ->useObjSubprojectQuery(joinType: Criteria::LEFT_JOIN)
            ->useObjGroupQuery(joinType: Criteria::LEFT_JOIN)
            ->useObjHouseQuery(joinType: Criteria::LEFT_JOIN)
            ->leftJoinObjStage()
            ->endUse()
            ->endUse()
            ->endUse();
    }

    private static function getProjectRolesQuery(array &$where, ?int $userId = null)
    {

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