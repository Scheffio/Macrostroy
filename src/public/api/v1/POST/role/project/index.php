<?php
// Добавить роль к проекту.

use inc\artemy\v1\json_output\JsonOutput;
use inc\artemy\v1\request\Request;
use wipe\inc\v1\role\project_role\ProjectRole;

$request = new Request();


try {
    $request->checkRequestVariablesOrError('lvl', 'is_crud', 'project_id', 'object_id', 'user_id');

    $lvl = $request->getRequest('lvl');
    $isCrud = $request->getRequest('is_crud');
    $user_id = $request->getRequest('user_id');
    $objectId = $request->getRequest('object_id');
    $projectId = $request->getRequest('project_id');

    JsonOutput::success(

    );
} catch (Exception $e) {
    JsonOutput::error($e);
}