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

$request = new Request();

try {
    $lvl = $request->getRequestOrThrow('lvl');
    $lvl = AccessLvl::getLvlIntObj($lvl);

    $flag = false;
    $parentId = null;
    $parentLvl = null;
    $projectId = null;

    if ($lvl !== eLvlObjInt::PROJECT->value) {
        $parentId = $request->getRequestOrThrow('parent_id');
        $parentLvl = AccessLvl::getPreLvlIntObj($lvl);

        // ID проекта, с проверкой, что таблица доступна для редактирования, т.е. статус равен "В процессе".
        $projectId = Objects::getObject(id: $parentId, lvl: $parentLvl)
                    ->isEditableOrThrow()
                    ->getProjectIdObjOrThrow();

        $flag = ProjectRole::isAccessCrudObj(
            lvl: $parentLvl,
            projectId: $projectId,
            userId: AuthUserRole::getUserId(),
            objId: $parentId
        );
    }

    if (!AuthUserRole::isAccessManageUsers() &&
        !AuthUserRole::isAccessManageObjects() &&
        !$flag) {
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
    JsonOutput::error('Некорректный номер уровня доступа');
} catch (InvalidAccessLvlStrException $e) {
    JsonOutput::error('Некорректное наименование уровня доступа');
} catch (IncorrectStatusException $e) {
    JsonOutput::error('Некорректный статус объекта');
} catch (NoFindObjectException $e) {
    JsonOutput::error('Некорректный объект');
} catch (PropelException|AccessDeniedException $e) {
    JsonOutput::error($e->getMessage());
} catch (ObjectIsNotEditableException $e) {
    JsonOutput::error('Объект недоступен для редактирования');
} catch (NoRoleFoundException $e) {
    JsonOutput::error('Некорректная роль');
} catch (NoUserFoundException $e) {
    JsonOutput::error('Неизвестный пользователь');
}