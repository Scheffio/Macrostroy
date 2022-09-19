<?php
// Вывод объекта(-ов).

use inc\artemy\v1\json_output\JsonOutput;
use inc\artemy\v1\request\Request;
use Propel\Runtime\Exception\PropelException;
use wipe\inc\v1\access_lvl\AccessLvl;
use wipe\inc\v1\access_lvl\enum\eLvlObjInt;
use wipe\inc\v1\access_lvl\exception\InvalidAccessLvlIntException;
use wipe\inc\v1\role\project_role\exception\IncorrectLvlException;
use wipe\inc\v1\role\project_role\ProjectRoleSelector;
use wipe\inc\v1\role\user_role\exception\NoRoleFoundException;
use wipe\inc\v1\role\user_role\exception\NoUserFoundException;

$request = new Request();

try {
    $lvl = $request->getQueryOrThrow('lvl');
    $lvl = AccessLvl::getLvlIntObj($lvl);

    if ($lvl === eLvlObjInt::PROJECT->value) $parentId = $request->getQuery('parent_id') ?? 0;
    else $parentId = $request->getQueryOrThrow('parent_id');

    $limit = $request->getQuery('limit') ?? 10;
    $limitFrom = $request->getQuery('limit_from') ?? 0;

    JsonOutput::success(
        ProjectRoleSelector::getAuthUserCrudForLvl($lvl, $parentId, $limit, $limitFrom)
    );
} catch (NoRoleFoundException $e) {
    JsonOutput::error('Неизвестная роль');
} catch (NoUserFoundException $e) {
    JsonOutput::error('Неизвестный пользователь');
} catch (PropelException $e) {
    JsonOutput::error($e->getMessage());
} catch (InvalidAccessLvlIntException $e) {
    JsonOutput::error('Некорректный номер уровня доступа');
} catch (IncorrectLvlException $e) {
    JsonOutput::error('Некорректный уровень доступа');
}