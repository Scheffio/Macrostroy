<?php

namespace wipe\inc\v1\role\project_role;

use DB\UsersQuery;

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
    private static function getUsersQuery(?int $userId = null)
    {
        $i = UsersQuery::create();

        if ($userId) {
            $i->filterById($userId);
        }

        return $i;
    }

    private static function getProjectRolesQuery(array &$where, ?int $userId = null)
    {

    }
    #endregion

    private static function getParentsForObj()
    {

    }

    private static function getParentsForLvl()
    {

    }
}