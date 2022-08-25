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

    foreach ($users as &$user) {
        $user = [
            'id' => $user['users.id'],
            'name' => $user['users.username'],
            'isAdmin' => (bool)$user['role.manage_users'],
            'isCrud' => is_null($user['project_role.is_crud']) ?
                        $user['project_role.is_crud'] :
                        (bool)$user['project_role.is_crud'],
        ];
    };

    JsonOutput::success($users);
} catch (PropelException|Exception $e) {
    JsonOutput::error($e->getMessage());
}