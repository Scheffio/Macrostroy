<?php
// Добавление и редактирвоание роли проекта.

use inc\artemy\v1\json_output\JsonOutput;
use inc\artemy\v1\request\Request;
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

    ProjectRole::getByMinimumData(lvl: $lvl, objectId: $objectId, userId: $userId)
                ->setIsCrud($isCrud)
                ->addOrUpdate();

    JsonOutput::success();
} catch (Exception $e) {
    JsonOutput::error($e->getMessage());
}