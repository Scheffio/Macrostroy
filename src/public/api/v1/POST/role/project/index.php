<?php
// Добавление и редактирвоание роли проекта.

use inc\artemy\v1\json_output\JsonOutput;
use inc\artemy\v1\request\Request;
use wipe\inc\v1\objects\Objects;
use wipe\inc\v1\role\project_role\ProjectRole;
use wipe\inc\v1\role\user_role\UserRole;

$request = new Request();

try {
    UserRole::getByUserId()->isManageUsersOrThrow();
    $request->checkRequestVariablesOrError('lvl', 'is_crud', 'object_id', 'user_id');

    $lvl = $request->getRequest('lvl');
    $isCrud = $request->getRequest('is_crud');
    $userId = $request->getRequest('user_id');
    $objectId = $request->getRequest('object_id');

    Objects::getObject(id: $objectId, lvl: $lvl)->isEditableOrThrow();
    $projectId = Objects::getProjectIdByChildOrThrow($lvl, $objectId);

    ProjectRole::getDefault()
                ->setAccessLvl($lvl)
                ->setIsCrud($lvl)
                ->setObjectId($objectId)
                ->setProjectId($projectId)
                ->addOrUpdate();

    JsonOutput::success();
} catch (Exception $e) {
    JsonOutput::error($e->getMessage());
}