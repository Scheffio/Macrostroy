<?php
// Редактирование объектов.

use inc\artemy\v1\request\Request;
use inc\artemy\v1\json_output\JsonOutput;
use wipe\inc\v1\access_lvl\AccessLvl;
use wipe\inc\v1\access_lvl\enum\eLvlObjInt;
use wipe\inc\v1\access_lvl\exception\InvalidAccessLvlIntException;
use wipe\inc\v1\objects\exception\AccessDeniedException;
use wipe\inc\v1\objects\Objects;
use wipe\inc\v1\role\project_role\exception\IncorrectLvlException;
use wipe\inc\v1\role\project_role\ProjectRole;
use wipe\inc\v1\role\user_role\UserRole;

$user = new UserRole();
$request = new Request();

try {
    $id = $request->getRequestOrThrow('id');
    $lvl = $request->getRequestOrThrow('lvl');

    if (
        !$user->isManageUsers() &&
        !$user->isManageObjects() &&
        !ProjectRole::getBySearch($lvl, $id, $user->getUserId())->isAccessCrud()
    ) {
        throw new AccessDeniedException('Недостаточно прав для редактирования объекта');
    }

    $lvl = AccessLvl::getLvlIntObj($lvl);
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
    JsonOutput::error('Некорретный номер уровня доступа');
} catch (\wipe\inc\v1\access_lvl\exception\InvalidAccessLvlStrException $e) {
    JsonOutput::error('Некорректное наименование уровня доступа');
} catch (\wipe\inc\v1\role\project_role\exception\NoProjectRoleFoundException $e) {
    JsonOutput::error('Роль проекта не была найдена');
} catch (\wipe\inc\v1\objects\exception\IncorrectStatusException $e) {
    JsonOutput::error('Некорретный статус объекта');
} catch (\Propel\Runtime\Exception\PropelException $e) {
    JsonOutput::error($e->getMessage());
} catch (\wipe\inc\v1\objects\exception\NoFindObjectException $e) {
    JsonOutput::error('Объект не блы найден');
}