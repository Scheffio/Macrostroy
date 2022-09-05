<?php
// Добавление объектов.

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
    if (!$user->isManageUsers() && !$user->isManageObjects()) {
        throw new AccessDeniedException('Недостаточно прав для добавления объекта');
    }

    $request->checkRequestVariablesOrError('lvl', 'name', 'status', 'is_public');

    $lvl = $request->getRequest('lvl');
    $name = $request->getRequest('name');
    $status = $request->getRequest('status');
    $isPublic = $request->getRequest('is_public');
    $parentId = null;

    if (is_string($lvl)) $lvl = ProjectRole::getLvlByStr($lvl);
    if ($lvl !== eLvlInt::PROJECT->value) $parentId = $request->getRequestOrThrow('parent_id');

    switch ($lvl) {
        // Проект
        case eLvlInt::PROJECT->value:
            Objects::getProject()
                ->setObjDefaultValues(
                    name: $name,
                    status: $status,
                    isPublic: $isPublic
                )
                ->add();
            break;
        // Подпроект
        case eLvlInt::SUBPROJECT->value:
            Objects::getSubproject()
                ->setObjDefaultValues(
                    name: $name,
                    status: $status,
                    isPublic: $isPublic
                )
                ->setProjectId($parentId)
                ->add();
            break;
        // Группа
        case eLvlInt::GROUP->value:
            Objects::getGroup()
                ->setObjDefaultValues(
                    name: $name,
                    status: $status,
                    isPublic: $isPublic
                )
                ->setSubprojectId($parentId)
                ->add();
            break;
        // Дом
        case eLvlInt::HOUSE->value:
            Objects::getHouse()
                ->setObjDefaultValues(
                    name: $name,
                    status: $status,
                    isPublic: $isPublic
                )
                ->setGroupId($parentId)
                ->add();
            break;
        // Этап
        case eLvlInt::STAGE->value:
            Objects::getStage()
                ->setObjDefaultValues(
                    name: $name,
                    status: $status,
                    isPublic: $isPublic
                )
                ->setHouseId($parentId)
                ->add();
            break;
        default: throw new IncorrectLvlException();
    }

    JsonOutput::success();
} catch (Exception $e) {
    JsonOutput::error($e->getMessage());
}
