<?php
use DB\Base\ProjectRoleQuery;
use DB\Base\UsersQuery;
use DB\Map\ProjectRoleTableMap;
use DB\Map\RoleTableMap;
use DB\Map\UsersTableMap;
use inc\artemy\v1\request\Request;
use Propel\Runtime\ActiveQuery\Criteria;
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
    $objectId = $request->getQueryOrThrow('object_id');
    $lvl = ProjectRole::getDefault()->setLvl($request->getQueryOrThrow('lvl'))->getLvl();

    $users = UsersQuery::create()
                ->select([
                    UsersTableMap::COL_ID,
                    UsersTableMap::COL_USERNAME,
                    RoleTableMap::COL_MANAGE_USERS,
                    ProjectRoleTableMap::COL_IS_CRUD,
                ])
                ->leftJoinRole()
                ->leftJoinProjectRole(ProjectRoleTableMap::TABLE_NAME)
                ->addJoinCondition(name: ProjectRoleTableMap::TABLE_NAME, clause: ProjectRoleTableMap::COL_LVL.'=?', value: $lvl)
                ->addJoinCondition(name: ProjectRoleTableMap::TABLE_NAME, clause: ProjectRoleTableMap::COL_OBJECT_ID.'=?', value: $objectId)
                ->find()
                ->getData();

    JsonOutput::success($users);
} catch (PropelException|Exception $e) {
    JsonOutput::error($e->getMessage());
}