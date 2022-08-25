<?php
//Вывод пользователей.

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
    $projectId = $request->getQueryOrThrow('project_id');
    $lvl = ProjectRole::getDefault()->setLvl($request->getQueryOrThrow('lvl'))->getLvl();

    $projectRoleAlias = 'project_role_alis';
    $projectRole = ProjectRoleQuery::create()
                    ->addSelfSelectColumns()
                    ->filterByLvl($lvl)
                    ->filterByObjectId($objectId)
                    ->filterByProjectId($projectId);

    $users = UsersQuery::create()

        ->addSelectQuery($projectRole,"a")
        ->addAlias("b", UsersTableMap::COL_ID)
        ->addJoin('a.user_id','b', Criteria::LEFT_JOIN)
//        ->leftJoinRole()
//        ->withColumn(ProjectRoleTableMap::COL_USER_ID)
//        ->addSelectQuery($projectRole, $projectRoleAlias)
//        ->addJoin(UsersTableMap::COL_ID, $projectRoleAlias.'.user_id', Criteria::LEFT_JOIN)
//        ->toString();
        ->find()
        ->getData();

//    $users = UsersQuery::create()
//                ->select([
//                    UsersTableMap::COL_ID,
//                    UsersTableMap::COL_USERNAME,
//                    RoleTableMap::COL_MANAGE_USERS,
//                    ProjectRoleTableMap::COL_IS_CRUD,
//                ])
//                ->leftJoinRole()
//                ->addSelectQuery()
//                ->useProjectRoleQuery('project_role', 'inner join')
//                    ->filterByLvl($lvl)
//                    ->filterByObjectId($objectId)
//                    ->filterByProjectId($projectId)
//                ->endUse()
//                ->find()
//                ->getData();

//    foreach ($users as &$user) {
//        $isAdmin = (bool)$user['role.manage_users'];
//
//        if ($isAdmin) $isCrud = true;
//        else {
//            $isCrud = $user['project_role.is_crud'];
//            if (is_int($isCrud)) $isCrud = (bool)$isCrud;
//        }
//
//        $user = [
//            'id' => $user['users.id'],
//            'name' => $user['users.username'],
//            'isCrud' => $isCrud,
//            'isAdmin' => $isAdmin,
//        ];
//    };

    JsonOutput::success($users);
} catch (PropelException|Exception $e) {
    JsonOutput::error($e->getMessage());
}