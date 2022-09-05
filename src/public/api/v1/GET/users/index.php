<?php
namespace wipe\api\v1\get\users;
//Вывод пользователей.

use DB\Base\UsersQuery;
use DB\Map\ProjectRoleTableMap;
use DB\Map\UserRoleTableMap;
use DB\Map\UsersTableMap;
use Delight\Auth\Auth;
use inc\artemy\v1\request\Request;
use Propel\Runtime\ActiveQuery\Criteria;
use wipe\inc\v1\objects\Objects;
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
    $lvl = $request->getQueryOrThrow('lvl');

    if (is_string($lvl)) $lvl = ProjectRole::getLvlByStr($lvl);

    $projectId = Objects::getProjectIdByChildOrThrow($objectId, $lvl);

    JsonOutput::success(ProjectRole::getCrudUsersObject($lvl, $projectId));
} catch (PropelException|\Exception $e) {
    JsonOutput::error($e->getMessage());
}