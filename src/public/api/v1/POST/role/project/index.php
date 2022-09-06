<?php
// Добавление и редактирвоание роли проекта.

use inc\artemy\v1\json_output\JsonOutput;
use inc\artemy\v1\request\Request;
use Propel\Runtime\Exception\PropelException;
use wipe\inc\v1\access_lvl\exception\InvalidAccessLvlIntException;
use wipe\inc\v1\access_lvl\exception\InvalidAccessLvlStrException;
use wipe\inc\v1\objects\exception\IncorrectStatusException;
use wipe\inc\v1\objects\exception\NoFindObjectException;
use wipe\inc\v1\objects\exception\ObjectIsNotEditableException;
use wipe\inc\v1\objects\Objects;
use wipe\inc\v1\role\project_role\exception\IncorrectLvlException;
use wipe\inc\v1\role\project_role\exception\NoProjectRoleFoundException;
use wipe\inc\v1\role\project_role\ProjectRole;
use wipe\inc\v1\role\user_role\exception\NoAccessManageUsersException;
use wipe\inc\v1\role\user_role\UserRole;

$request = new Request();

try {
    UserRole::getByUserId()->isManageUsersOrThrow();
    $request->checkRequestVariablesOrError('lvl', 'is_crud', 'object_id', 'user_id');

    $lvl = $request->getRequest('lvl');
    $isCrud = $request->getRequest('is_crud');
    $userId = $request->getRequest('user_id');
    $objectId = $request->getRequest('object_id');

    // ID проекта, с проверкой, что таблица доступна для редактирования, т.е. статус равен "В процессе".
    $projectId = Objects::getObject(id: $objectId, lvl: $lvl)
                ->isEditableOrThrow()
                ->getProjectIdObjOrThrow();

    ProjectRole::getDefault()
                ->setAccessLvl($lvl)
                ->setIsCrud($lvl)
                ->setObjectId($objectId)
                ->setProjectId($projectId)
                ->setUserId($userId)
                ->addOrUpdate();

    JsonOutput::success();
} catch (NoProjectRoleFoundException $e) {
    JsonOutput::error('Роль проекта не была найдена');
} catch (InvalidAccessLvlIntException $e) {
    JsonOutput::error('Некорретный номер доступа');
} catch (InvalidAccessLvlStrException $e) {
    JsonOutput::error('Некорретное наименование уровня одступа');
} catch (NoFindObjectException $e) {
    JsonOutput::error('Объект не был найден');
} catch (IncorrectLvlException $e) {
    JsonOutput::error('Некорретный уровень доступа');
} catch (ObjectIsNotEditableException $e) {
    JsonOutput::error('Объект не доступен для редактирования');
} catch (IncorrectStatusException $e) {
    JsonOutput::error('Некорретный статус объекта');
} catch (NoAccessManageUsersException $e) {
} catch (PropelException|Exception $e) {
    JsonOutput::error($e->getMessage());
}