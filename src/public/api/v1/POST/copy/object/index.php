<?php
// Копирование объекта.

use inc\artemy\v1\json_output\JsonOutput;
use inc\artemy\v1\request\Request;
use Propel\Runtime\Exception\PropelException;
use wipe\inc\v1\access_lvl\AccessLvl;
use wipe\inc\v1\access_lvl\exception\InvalidAccessLvlIntException;
use wipe\inc\v1\access_lvl\exception\InvalidAccessLvlStrException;
use wipe\inc\v1\objects\exception\IncorrectStatusException;
use wipe\inc\v1\objects\exception\ObjectIsDeletedException;
use wipe\inc\v1\objects\exception\ObjectIsNotEditableException;
use wipe\inc\v1\objects\Objects;
use wipe\inc\v1\role\project_role\exception\IncorrectLvlException;
use wipe\inc\v1\role\project_role\exception\NoAccessCopyObjectException;
use wipe\inc\v1\role\project_role\ProjectRoleSelector;
use wipe\inc\v1\role\user_role\AuthUserRole;
use wipe\inc\v1\role\user_role\exception\NoRoleFoundException;
use wipe\inc\v1\role\user_role\exception\NoUserFoundException;

/**
 * - Только при CRUD к конкретному объекту.
 * - Ошибка если не админ, а объект удален.
 */

$request = new Request();

try {
    $request->checkRequestVariablesOrError('id', 'lvl');

    $id = $request->getRequest('id');
    $lvl = $request->getRequest('lvl');
    $lvl = AccessLvl::getLvlIntObj($lvl);

    if (AuthUserRole::isAccessManageUsers() === false) {
        // Проверка, что у пользователя есть CRUD к объекту.
        ProjectRoleSelector::isAccessCrudAuthUserByObjOrThrow(lvl: $lvl, objId: $id);
        // Проверка, что объект не удален.
        Objects::getObject(id: $id, lvl: $lvl)->isNotDeletedTableOrThrow();
    }

    Objects::copyObj($lvl, $id);

    JsonOutput::success();
} catch (PropelException $e) {
    JsonOutput::error($e->getMessage());
} catch (InvalidAccessLvlIntException $e) {
    JsonOutput::error('Некорректный номер уровня доступа');
} catch (InvalidAccessLvlStrException $e) {
    JsonOutput::error('Некорректное наименование уровня доступа');
} catch (IncorrectLvlException $e) {
    JsonOutput::error('Некорректный уровень доступа');
} catch (NoRoleFoundException $e) {
    JsonOutput::error('Некорректная роль');
} catch (NoUserFoundException $e) {
    JsonOutput::error('Неизвестный пользователь');
} catch (IncorrectStatusException $e) {
    JsonOutput::error('Некорректный статус объекта');
} catch (NoAccessCopyObjectException $e) {
    JsonOutput::error('Недостаточно прав для копирования объекта');
} catch (ObjectIsDeletedException $e) {
    JsonOutput::error('Недостаточно прав для копирования удаленного объекта');
}