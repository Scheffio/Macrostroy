<?php
// Удаление объектов.

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
use wipe\inc\v1\objects\exception\ObjectIsDeletedException;
use wipe\inc\v1\objects\Objects;
use wipe\inc\v1\role\project_role\exception\IncorrectLvlException;
use wipe\inc\v1\role\project_role\ProjectRoleSelector;
use wipe\inc\v1\role\user_role\AuthUserRole;
use wipe\inc\v1\role\user_role\exception\NoRoleFoundException;
use wipe\inc\v1\role\user_role\exception\NoUserFoundException;
use wipe\inc\v1\role\user_role\UserRole;

$user = new UserRole();
$request = new Request();

try {
    $id = $request->getQueryOrThrow('id');
    $lvl = $request->getQueryOrThrow('lvl');
    $lvl = AccessLvl::getLvlIntObj($lvl);

    //Проверка доступа на удаление, т.е. статус не равен "Удален".
    Objects::getObject(id: $id, lvl: $lvl)->isNotDeletedTableOrThrow();

    if (!AuthUserRole::isAccessManageUsers() &&
        !AuthUserRole::isAccessManageObjects() &&
        !ProjectRoleSelector::isAccessCrudAuthUserByObj(lvl: $lvl, objId: $id)
    ) {
        throw new AccessDeniedException('Недостаточно прав для редактирования объекта');
    }

    Objects::deleteObj(
        id: $id,
        lvl: $lvl
    );

    JsonOutput::success();
} catch (InvalidAccessLvlIntException|IncorrectLvlException $e) {
    JsonOutput::error('Некорректный номер уровня доступа');
} catch (InvalidAccessLvlStrException $e) {
    JsonOutput::error('Некорректное наименование уровня доступа');
} catch (IncorrectStatusException $e) {
    JsonOutput::error('Некорректный статус объекта');
} catch (NoFindObjectException $e) {
    JsonOutput::error('Неизвестный объект');
} catch (PropelException|AccessDeniedException $e) {
    JsonOutput::error($e->getMessage());
} catch (NoRoleFoundException $e) {
    JsonOutput::error('Некорректная роль');
} catch (NoUserFoundException $e) {
    JsonOutput::error('Неизвестный пользователь');
} catch (ObjectIsDeletedException $e) {
    JsonOutput::error('Объект недоступен для удаления');
}