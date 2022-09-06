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
use wipe\inc\v1\objects\Objects;
use wipe\inc\v1\role\project_role\exception\IncorrectLvlException;
use wipe\inc\v1\role\project_role\exception\NoProjectRoleFoundException;
use wipe\inc\v1\role\project_role\ProjectRole;
use wipe\inc\v1\role\user_role\UserRole;

$user = new UserRole();
$request = new Request();

try {
    $id = $request->getQueryOrThrow('id');
    $lvl = $request->getQueryOrThrow('lvl');
    $lvl = AccessLvl::getLvlIntObj($lvl);

    if (
        !$user->isManageUsers() &&
        !$user->isManageObjects() &&
        !ProjectRole::getBySearch($lvl, $id, $user->getUserId())->isAccessCrud()
    ) {
        throw new AccessDeniedException('Недостаточно прав для редактирования объекта');
    }

    switch ($lvl) {
        case eLvlObjInt::PROJECT->value: Objects::getProject($id)->delete(); break;
        case eLvlObjInt::SUBPROJECT->value: Objects::getSubproject($id)->delete(); break;
        case eLvlObjInt::GROUP->value: Objects::getGroup($id)->delete(); break;
        case eLvlObjInt::HOUSE->value: Objects::getHouse($id)->delete(); break;
        case eLvlObjInt::STAGE->value: Objects::getStage($id)->delete(); break;

        default: throw new IncorrectLvlException();
    }

    JsonOutput::success();
} catch (InvalidAccessLvlIntException|IncorrectLvlException $e) {
    JsonOutput::error('Некорретный номер уровня доступа');
} catch (InvalidAccessLvlStrException $e) {
    JsonOutput::error('Некорректное наименование уровня доступа');
} catch (NoProjectRoleFoundException $e) {
    JsonOutput::error('Роль проекта не была найдена');
} catch (IncorrectStatusException $e) {
    JsonOutput::error('Некорретный статус объекта');
} catch (NoFindObjectException $e) {
    JsonOutput::error('Объект не был найден');
} catch (PropelException|AccessDeniedException $e) {
    JsonOutput::error($e->getMessage());
}