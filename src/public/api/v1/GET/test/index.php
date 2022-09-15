<?php

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
use DB\ObjProjectQuery as DbObjProjectQuery;
use DB\UsersQuery as DbUsersQuery;
use inc\artemy\v1\json_output\JsonOutput;
use inc\artemy\v1\request\Request;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\Exception\PropelException;
use wipe\inc\v1\access_lvl\AccessLvl;
use wipe\inc\v1\access_lvl\enum\eLvlObjInt;
use wipe\inc\v1\access_lvl\exception\InvalidAccessLvlIntException;
use wipe\inc\v1\objects\Objects;
use wipe\inc\v1\role\project_role\exception\IncorrectLvlException;
use wipe\inc\v1\role\user_role\AuthUserRole;

$request = new Request();

try {
    $lvl = $request->getQueryOrThrow('lvl');
    $objId = $request->getQueryOrThrow('object_id');

    $parents =  Selector::getParentsForObj($lvl, $objId);
                Selector::formingParentsAsIf($parents);
    $users = Selector::getUsersCrud($parents);

    JsonOutput::success(
        Selector::formingUsers($users)
    );

} catch (Exception $e) {
    JsonOutput::error($e->getMessage());
}

class Selector
{
    public static function getParentsForObj(int &$lvl, int &$objId): array
    {
        $query = ObjProjectQuery::create()
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
                ->endUse();

        if ($objId) {
            $colId = Objects::getColIdByLvl($lvl);
            $query->where($colId . '=?', $objId);
        }

        $query = $query->findOne();

        return is_array($query) ? array_slice($query, 0, $lvl) : [];
    }

    public static function getUsersCrud(string &$if): array
    {
        return  UsersQuery::create()
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
                ->find()
                ->getData();
    }

    private static function isCrud(null|int|bool &$crud, array &$user): ?bool
    {
        if ($user[UserRoleTableMap::COL_MANAGE_USERS]) return true;
        if ($crud !== null) return (bool)$crud;
        if ($user[UserRoleTableMap::COL_MANAGE_OBJECTS]) return true;
        if ($user[UserRoleTableMap::COL_OBJECT_VIEWER]) return false;

        return null;
    }

    public static function replaceValueInIf(string $if, string $true): string
    {
        return str_replace('true', $true, $if);
    }

    public static function formingParentsAsIf(array &$parents): void
    {
        foreach ($parents as $key=>&$value) {
            $lvl = AccessLvl::getLvlIntObjByColId($key);
            $wLvl = ProjectRoleTableMap::COL_LVL . '=' . $lvl;
            $wObjId = ProjectRoleTableMap::COL_OBJECT_ID . '=' . $value;
            $value = [$wLvl, $wObjId];
        }

        foreach ($parents as &$parent) {
            $parent = "($parent[0] AND $parent[1])";
        }

        $parents = 'IF(' . join(' OR ', $parents) . ', true, NULL)';
    }

    public static function formingUsers(array &$users): array
    {
        $result = [];

        foreach ($users as &$user) {
            $id =& $user[UsersTableMap::COL_ID];
            $flag = array_key_exists($id, $result);

            if ($flag && $result[$id]['lvl'] !== null) continue;
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
}