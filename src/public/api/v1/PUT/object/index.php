<?php
// Редактирование объектов.

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
    $id = $request->getRequestOrThrow('id');
    $lvl = $request->getRequestOrThrow('lvl');
    $lvl = AccessLvl::getLvlIntObj($lvl);

    // ID проекта, с проверкой, что таблица доступна для редактирования, т.е. статус равен "В процессе".
    $projectId = Objects::getObject(id: $id, lvl: $lvl)
        ->isEditableOrThrow()
        ->getProjectIdObjOrThrow();

    if (!AuthUserRole::isAccessManageUsers() &&
        !AuthUserRole::isAccessManageObjects() &&
        !ProjectRole::isAccessCrudObj($lvl, $projectId, $id, AuthUserRole::getUserId())
    ) {
        throw new AccessDeniedException('Недостаточно прав для редактирования объекта');
    }

    $name = $request->getRequest('name');
    $status = $request->getRequest('status');
    $isPublic = $request->getRequest('is_public');
    $isAvailable = $request->getRequest('is_available');

    switch ($lvl) {
        case eLvlObjInt::PROJECT->value:
            Objects::getProject($id)
                ->setObjDefaultValues(
                    id: $id,
                    name: $name,
                    status: $status,
                    isPublic: $isPublic,
                    isAvailable: $isAvailable,
                )
                ->update();
            break;
        case eLvlObjInt::SUBPROJECT->value:
            Objects::getSubproject($id)
                ->setObjDefaultValues(
                    id: $id,
                    name: $name,
                    status: $status,
                    isPublic: $isPublic,
                    isAvailable: $isAvailable,
                )
                ->update();
            break;
        case eLvlObjInt::GROUP->value:
            Objects::getGroup($id)
                ->setObjDefaultValues(
                    id: $id,
                    name: $name,
                    status: $status,
                    isPublic: $isPublic,
                    isAvailable: $isAvailable,
                )
                ->update();
            break;
        case eLvlObjInt::HOUSE->value:
            Objects::getHouse($id)
                ->setObjDefaultValues(
                    id: $id,
                    name: $name,
                    status: $status,
                    isPublic: $isPublic,
                    isAvailable: $isAvailable,
                )
                ->update();
            break;
        case eLvlObjInt::STAGE->value:
            Objects::getStage($id)
                ->setObjDefaultValues(
                    id: $id,
                    name: $name,
                    status: $status,
                    isPublic: $isPublic,
                    isAvailable: $isAvailable,
                )
                ->update();
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
} catch (NoRoleFoundException $e) {
    JsonOutput::error('Некорректная роль');
} catch (NoUserFoundException $e) {
    JsonOutput::error('Неизвестный пользователь');
} catch (ObjectIsNotEditableException $e) {
    JsonOutput::error('Объект недоступен для редактирования');
}