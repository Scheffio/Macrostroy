<?php
// Редактирование объектов.

use inc\artemy\v1\request\Request;
use inc\artemy\v1\json_output\JsonOutput;
use wipe\inc\v1\objects\exception\AccessDeniedException;
use wipe\inc\v1\objects\Objects;
use wipe\inc\v1\role\project_role\enum\eLvlInt;
use wipe\inc\v1\role\project_role\exception\IncorrectLvlException;
use wipe\inc\v1\role\project_role\ProjectRole;
use wipe\inc\v1\role\user_role\UserRole;

$user = new UserRole();
$request = new Request();

try {
    $id = $request->getRequestOrThrow('id');
    $lvl = $request->getRequestOrThrow('lvl');

    if (!$user->isManageUsers() &&
        !$user->isManageObjects() &&
        !ProjectRole::getByMinimumData(lvl: $lvl, objectId: $id, userId: $user->getUserId())->isAccessCrud()) {
        throw new AccessDeniedException('Недостаточно прав для редактирования объекта');
    }

    if (is_string($lvl)) {
        $lvl = ProjectRole::getLvlByStr($lvl);
    }

    $name = $request->getRequest('name');
    $status = $request->getRequest('status');
    $isPublic = $request->getRequest('is_public');
    $isAvailable = $request->getRequest('is_available');

    switch ($lvl) {
        // Проект
        case eLvlInt::PROJECT->value:
            Objects::getProject($id)
                ->setName($name)
                ->setStatus($status)
                ->setIsPublic($isPublic)
                ->setIsAvailable($isAvailable)
                ->updateByObj();
            break;
        // Подпроект
        case eLvlInt::SUBPROJECT->value:
            Objects::getSubproject($id)
                ->setName($name)
                ->setStatus($status)
                ->setIsPublic($isPublic)
                ->setIsAvailable($isAvailable)
                ->updateByObj();
            break;
        // Группа
        case eLvlInt::GROUP->value:
            break;
        // Дом
        case eLvlInt::HOUSE->value:
            break;
        // Этап
        case eLvlInt::STAGE->value:
            break;
        default: throw new IncorrectLvlException();
    }

    JsonOutput::success();
} catch (Exception $e) {
    JsonOutput::success($e->getMessage());
}

//function setPropertiesForObject