<?php
// Редактирование объектов.

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
    if (!$user->isManageUsers() && !$user->isManageObjects()) {
        throw new AccessDeniedException('Недостаточно прав для добавления объекта');
    }

    $id = $request->getRequestOrThrow('id');
    $lvl = $request->getRequestOrThrow('lvl');
    $name = $request->getRequest('name');
    $status = $request->getRequest('status');
    $isAvailable = $request->getRequest('is_available');

    if (is_int($lvl)) {
        $lvl = ProjectRole::getLvlNameByInt($lvl);
    }

    switch ($lvl) {
        case ProjectRole::ATTRIBUTE_LVL_STR_PROJECT:
            Objects::getProject($id)
                ->setName($name)
                ->setStatus($status)
                ->setIsAvailable($isAvailable)
                ->updateByObj();
            break;
        default: throw new IncorrectLvlException();
    }

    JsonOutput::success();
} catch (Exception $e) {
    JsonOutput::success($e->getMessage());
}
