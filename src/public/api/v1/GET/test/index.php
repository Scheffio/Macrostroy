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
                ->leftJoinRole()
                ->leftJoinProjectRole()
                ->addJoinCondition(name: ProjectRoleTableMap::COL_OBJECT_ID, clause: ProjectRoleTableMap::TABLE_NAME, value: $objectId)
                ->toString();

    JsonOutput::success($users);
} catch (PropelException|Exception $e) {
    JsonOutput::error($e->getMessage());
}