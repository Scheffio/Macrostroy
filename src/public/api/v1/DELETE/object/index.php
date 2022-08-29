<?php
// Удаление объектов.

use inc\artemy\v1\request\Request;
use inc\artemy\v1\json_output\JsonOutput;
use wipe\inc\v1\objects\exception\AccessDeniedException;
use wipe\inc\v1\objects\Objects;
use wipe\inc\v1\role\project_role\exception\IncorrectLvlException;
use wipe\inc\v1\role\project_role\ProjectRole;
use wipe\inc\v1\role\user_role\UserRole;

$user = new UserRole();
$request = new Request();

try {
    $id = $request->getQueryOrThrow('id');
    $lvl = $request->getQueryOrThrow('lvl');

    if (!$user->isManageUsers() &&
        !$user->isManageObjects() &&
        !ProjectRole::getByMinimumData(lvl: $lvl, objectId: $id, userId: $user->getUserId())->isAccessCrud()) {
        throw new AccessDeniedException('Недостаточно прав для добавления объекта');
    }

    if (is_int($lvl)) {
        $lvl = ProjectRole::getLvlNameByInt($lvl);
    }

    switch ($lvl) {
        // Проект
        case ProjectRole::ATTRIBUTE_LVL_STR_PROJECT: Objects::getProject($id)->deleteByObj(); break;
        default: throw new IncorrectLvlException();
    }

    JsonOutput::success();
} catch (Exception $e) {
    JsonOutput::success($e->getMessage());
}