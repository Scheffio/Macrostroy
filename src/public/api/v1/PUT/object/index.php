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
use wipe\inc\v1\role\project_role\ProjectRoleSelector;
use wipe\inc\v1\role\user_role\AuthUserRole;
use wipe\inc\v1\role\user_role\exception\NoRoleFoundException;
use wipe\inc\v1\role\user_role\exception\NoUserFoundException;

$request = new Request();

try {
    $id = $request->getRequestOrThrow('id');
    $lvl = $request->getRequestOrThrow('lvl');
    $lvl = AccessLvl::getLvlIntObj($lvl);

    // Проверка, что таблица доступна для редактирования, т.е. статус равен "В процессе".
    Objects::getObject(id: $id, lvl: $lvl)->isEditableOrThrow();

    if (!AuthUserRole::isAccessManageUsers() &&
        !AuthUserRole::isAccessManageObjects() &&
        !ProjectRoleSelector::isAccessCrudAuthUserByObj(lvl: $lvl, objId: $id)
    ) {
        throw new AccessDeniedException('Недостаточно прав для редактирования объекта');
    }

    $name = $request->getRequest('name');
    $status = $request->getRequest('status');
    $isPublic = $request->getRequest('is_public');

    switch ($lvl) {
        case eLvlObjInt::PROJECT->value:
            Objects::getProject($id)
                ->setObjDefaultValues(
                    id: $id,
                    name: $name,
                    status: $status,
                    isPublic: $isPublic,
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
                )
                ->update();
            break;
        default: throw new IncorrectLvlException();
    }

    JsonOutput::success();
} catch (AccessDeniedException|PropelException $e) {
    JsonOutput::error($e->getMessage());
} catch (NoFindObjectException $e) {
    JsonOutput::error('Некорректный объект');
} catch (IncorrectLvlException $e) {
    JsonOutput::error('Некорректный уровень доступа');
} catch (IncorrectStatusException $e) {
    JsonOutput::error('Некорректный статус объекта');
} catch (InvalidAccessLvlIntException $e) {
    JsonOutput::error('Некорректный номер уровня доступа');
} catch (NoRoleFoundException $e) {
    JsonOutput::error('Некорректная роль');
} catch (NoUserFoundException $e) {
    JsonOutput::error('Неизвестный пользователь');
} catch (InvalidAccessLvlStrException $e) {
    JsonOutput::error('Некорректное наименование уровня доступа');
} catch (ObjectIsNotEditableException $e) {
    JsonOutput::error('Объект недоступен для редактирования');
}
