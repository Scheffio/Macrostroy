<?php
//Вывод пользователей.

use DB\Base\UsersQuery;
use DB\Map\ProjectRoleTableMap;
use DB\Map\RoleTableMap;
use DB\Map\UsersTableMap;
use inc\artemy\v1\request\Request;
use wipe\inc\v1\role\project_role\ProjectRole;
use wipe\inc\v1\role\user_role\UserRole;
use inc\artemy\v1\json_output\JsonOutput;
use Propel\Runtime\Exception\PropelException;

try {
    UserRole::getByUserId()->isManageUsersOrThrow();

    if (empty($_GET)) {
        JsonOutput::success(
            UsersQuery::create()
                ->select(['id', 'username'])
                ->find()
                ->getData()
        );
    }

    $request = new Request();
    $object_id = $request->getQueryOrThrow('object_id');
    $project_id = $request->getQueryOrThrow('project_id');
    $lvl = ProjectRole::getDefault()->setLvl($request->getQueryOrThrow('lvl'))->getLvl();

    $users = UsersQuery::create()
                ->select([
                    UsersTableMap::COL_ID,
                    UsersTableMap::COL_USERNAME,
                    RoleTableMap::COL_MANAGE_USERS,
                    ProjectRoleTableMap::COL_IS_CRUD
                ])
                ->leftJoinRole()
                ->leftJoinProjectRole()
                ->find()
                ->getData();

//    $users = array_map(function ($value) {
//        return [
//            'id' => $value['users.id'],
//            'name' => $value['users.username'],
//            'isAdmin' => (bool)$value['users.manage_users'],
//            'isCrud' => $value['users.is_crud'] === null ?
//                        $value['users.is_crud'] :
//                        (bool)$value['users.is_crud'],
//        ];
//    }, $users);

    JsonOutput::success($users);
} catch (PropelException|Exception $e) {
    JsonOutput::error($e->getMessage());
}