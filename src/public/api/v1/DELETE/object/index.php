<?php
// Удаление объектов.

use inc\artemy\v1\request\Request;
use inc\artemy\v1\json_output\JsonOutput;
use wipe\inc\v1\objects\exception\AccessDeniedException;
use wipe\inc\v1\objects\Objects;
use wipe\inc\v1\role\project_role\enum\eLvlInt;
use wipe\inc\v1\role\project_role\exception\IncorrectLvlException;
use wipe\inc\v1\role\project_role\ProjectRole;
use wipe\inc\v1\role\user_role\UserRole;

$user = new UserRole();
$request = new Request();

try {
    $id = $request->getQueryOrThrow('id');
    $lvl = $request->getQueryOrThrow('lvl');

    if (!$user->isManageUsers() &&
        !$user->isManageObjects() &&
        !ProjectRole::getByMinimumData(lvl: $lvl, objectId: $id, userId: $user->getUserId())->isAccessCrud()) {
        throw new AccessDeniedException('Недостаточно прав для удаления объекта');
    }

    if (is_string($lvl)) {
        $lvl = ProjectRole::getLvlByStr($lvl);
    }

    switch ($lvl) {
        // Проект
        case eLvlInt::PROJECT->value: Objects::getProject($id)->deleteByObj(); break;
        // Подпроект
        case eLvlInt::SUBPROJECT->value: Objects::getSubproject($id)->deleteByObj(); break;
        // Группа
        case eLvlInt::GROUP->value: Objects::getGroup($id)->deleteByObj(); break;
        // Дом
        case eLvlInt::HOUSE->value: Objects::getHouse($id)->deleteByObj(); break;
        // Этап
        case eLvlInt::STAGE->value: Objects::getStage($id)->deleteByObj(); break;

        default: throw new IncorrectLvlException();
    }

    JsonOutput::success();
} catch (Exception $e) {
    JsonOutput::success([
        'getMessage'=>$e->getMessage(),
        'getLine'=>$e->getLine(),
        'getFile'=>$e->getFile()
    ]);
}
