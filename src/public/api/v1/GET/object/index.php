<?php
// Вывод объекта(-ов).

use inc\artemy\v1\json_output\JsonOutput;
use inc\artemy\v1\request\Request;
use wipe\inc\v1\objects\Objects;
use wipe\inc\v1\role\project_role\ProjectRole;
use wipe\inc\v1\role\project_role\ProjectRoleSelector;
use wipe\inc\v1\role\user_role\AuthUserRole;
use wipe\inc\v1\role\user_role\exception\NoRoleFoundException;
use wipe\inc\v1\role\user_role\exception\NoUserFoundException;

$request = new Request();

try {
    $lvl = $request->getQueryOrThrow('lvl');
    $parentId = $request->getQuery('parent_id') ?? 0;
    $limit = $request->getQuery('limit') ?? 10;
    $limitFrom = $request->getQuery('limit_from') ?? 0;

    JsonOutput::success(
        ProjectRoleSelector::getAuthUserCrudForLvl($lvl, $parentId, $limit, $limitFrom)
    );

//    ProjectRoleSelector::getUsersCrudForObj($lvl, $parentId);


//    JsonOutput::success(
//        Objects::getObjectsByLvl(
//            lvl: $lvl,
//            parentId: $parentId,
//            userId: AuthUserRole::getUserId(),
//            limit: $limit,
//            limitFrom: $limitFrom,
//        )
//    );
} catch (NoRoleFoundException $e) {
    JsonOutput::error('Неизвестная роль');
} catch (NoUserFoundException $e) {
    JsonOutput::error('Неизвестный пользователь');
} catch (\Propel\Runtime\Exception\PropelException $e) {
    JsonOutput::error($e->getMessage());
}