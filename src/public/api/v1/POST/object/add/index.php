<?php
// Добавление объектов.

use inc\artemy\v1\request\Request;
use inc\artemy\v1\json_output\JsonOutput;
use wipe\inc\v1\role\project_role\exception\IncorrectLvlException;
use wipe\inc\v1\role\project_role\ProjectRole;
use wipe\inc\v1\role\user_role\UserRole;

$user = new UserRole();
$request = new Request();

try {
    if ($user->isManageUsers() && $user->isManageObjects()) {
        throw new \wipe\inc\v1\objects\exception\AccessDeniedException();
    }


//    UserRole::getByUserId()->isManageUsersOrThrow();
    $lvl = $request->getRequestOrThrow('lvl');

    switch ($lvl) {
        case ProjectRole::ATTRIBUTE_LVL_STR_PROJECT: break;
        default: throw new IncorrectLvlException();
    }

    JsonOutput::success();
} catch (Exception $e) {
    JsonOutput::success($e->getMessage());
}
