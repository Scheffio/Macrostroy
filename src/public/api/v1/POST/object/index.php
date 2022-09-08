<?php
// Добавление объектов.

use inc\artemy\v1\request\Request;
use inc\artemy\v1\json_output\JsonOutput;
use Propel\Runtime\Exception\PropelException;
use wipe\inc\v1\access_lvl\AccessLvl;
use wipe\inc\v1\access_lvl\enum\eLvlObjInt;
use wipe\inc\v1\access_lvl\exception\InvalidAccessLvlIntException;
use wipe\inc\v1\access_lvl\exception\InvalidAccessLvlStrException;
use wipe\inc\v1\objects\exception\AccessDeniedException;
use wipe\inc\v1\objects\exception\IncorrectStatusException;
use wipe\inc\v1\objects\exception\NoFindObjectException;
use wipe\inc\v1\objects\exception\ObjectIsNotEditableException;
use wipe\inc\v1\objects\Objects;
use wipe\inc\v1\role\project_role\exception\IncorrectLvlException;
use wipe\inc\v1\role\project_role\ProjectRole;
use wipe\inc\v1\role\user_role\AuthUserRole;
use wipe\inc\v1\role\user_role\exception\NoRoleFoundException;
use wipe\inc\v1\role\user_role\exception\NoUserFoundException;
use wipe\inc\v1\role\user_role\UserRole;

$request = new Request();

try {
    $lvl = $request->getRequestOrThrow('lvl');
    $lvl = AccessLvl::getLvlIntObj($lvl);

    $parentId = $lvl !== eLvlObjInt::PROJECT->value ? $request->getRequestOrThrow('parent_id') : 1;
    $parentLvl = AccessLvl::getPreLvlIntObj($lvl);

    // ID проекта, с проверкой, что таблица доступна для редактирования, т.е. статус равен "В процессе".
    $projectId = Objects::getObject(id: $parentId, lvl: $parentLvl)
                ->isEditableOrThrow()
                ->getProjectIdObjOrThrow();

    if (!AuthUserRole::isAccessManageUsers() &&
        !AuthUserRole::isAccessManageObjects() &&
        ProjectRole::isAccessCrudObj($parentLvl, $projectId, $parentId, AuthUserRole::getUserId())) {
        throw new AccessDeniedException('Недостаточно прав для добавления объекта');
    }

    $request->checkRequestVariablesOrError('name', 'status', 'is_public');

    $name = $request->getRequest('name');
    $status = $request->getRequest('status');
    $isPublic = $request->getRequest('is_public');

    switch ($lvl) {
        case eLvlObjInt::PROJECT->value:
            Objects::getProject()
                ->setObjDefaultValues(
                    name: $name,
                    status: $status,
                    isPublic: $isPublic
                )
                ->add();
            break;
        case eLvlObjInt::SUBPROJECT->value:
            Objects::getSubproject()
                ->setObjDefaultValues(
                    name: $name,
                    status: $status,
                    isPublic: $isPublic
                )
                ->setProjectId($parentId)
                ->add();
            break;
        case eLvlObjInt::GROUP->value:
            Objects::getGroup()
                ->setObjDefaultValues(
                    name: $name,
                    status: $status,
                    isPublic: $isPublic
                )
                ->setSubprojectId($parentId)
                ->add();
            break;
        case eLvlObjInt::HOUSE->value:
            Objects::getHouse()
                ->setObjDefaultValues(
                    name: $name,
                    status: $status,
                    isPublic: $isPublic
                )
                ->setGroupId($parentId)
                ->add();
            break;
        case eLvlObjInt::STAGE->value:
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
} catch (InvalidAccessLvlIntException|IncorrectLvlException $e) {
    JsonOutput::error('Некорретный номер уровня доступа');
} catch (InvalidAccessLvlStrException $e) {
    JsonOutput::error('Некорректное наименование уровня доступа');
} catch (IncorrectStatusException $e) {
    JsonOutput::error('Некорретный статус объекта');
} catch (NoFindObjectException $e) {
    JsonOutput::error('Объект не был найден');
} catch (PropelException|AccessDeniedException $e) {
    JsonOutput::error($e->getMessage());
} catch (ObjectIsNotEditableException $e) {
    JsonOutput::error('Объект недоступен для редактирования');
} catch (NoRoleFoundException $e) {
    JsonOutput::error('Некорректная роль');
} catch (NoUserFoundException $e) {
    JsonOutput::error('Неизвестный пользователь');
}