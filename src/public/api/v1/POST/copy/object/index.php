<?php
// Копирование объекта.

use inc\artemy\v1\json_output\JsonOutput;
use inc\artemy\v1\request\Request;
use Propel\Runtime\Exception\PropelException;
use wipe\inc\v1\access_lvl\AccessLvl;
use wipe\inc\v1\access_lvl\exception\InvalidAccessLvlIntException;
use wipe\inc\v1\access_lvl\exception\InvalidAccessLvlStrException;
use wipe\inc\v1\objects\exception\IncorrectStatusException;
use wipe\inc\v1\objects\exception\ObjectIsNotEditableException;
use wipe\inc\v1\objects\Objects;
use wipe\inc\v1\role\project_role\exception\IncorrectLvlException;
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
        // Проверка, что объект доступен для редактирования, т.е. статус равен "В процессе".
        Objects::getObject(id: $id, lvl: $lvl)->isEditableOrThrow();


    }

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
} catch (ObjectIsNotEditableException $e) {
    JsonOutput::error('Объект недоступен для редактирования');
}