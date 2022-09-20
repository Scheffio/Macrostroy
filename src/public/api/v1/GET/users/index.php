<?php
namespace wipe\api\v1\get\users;
//Вывод пользователей.

use DB\Base\UsersQuery;
use inc\artemy\v1\request\Request;
use wipe\inc\v1\access_lvl\AccessLvl;
use wipe\inc\v1\access_lvl\exception\InvalidAccessLvlIntException;
use wipe\inc\v1\access_lvl\exception\InvalidAccessLvlStrException;
use wipe\inc\v1\role\project_role\exception\IncorrectLvlException;
use wipe\inc\v1\role\project_role\ProjectRoleSelector;
use wipe\inc\v1\role\user_role\AuthUserRole;
use wipe\inc\v1\role\user_role\exception\NoAccessManageUsersException;
use wipe\inc\v1\role\user_role\exception\NoRoleFoundException;
use wipe\inc\v1\role\user_role\exception\NoUserFoundException;
use inc\artemy\v1\json_output\JsonOutput;
use Propel\Runtime\Exception\PropelException;

try {
    AuthUserRole::isAccessManageUsersOrThrow();

    if (empty($_GET)) {
        JsonOutput::success(
            UsersQuery::create()
                ->select(['id', 'username'])
                ->orderByUsername()
                ->find()
                ->getData()
        );
    }

    $request = new Request();
    $objId = $request->getQueryOrThrow('object_id');
    $lvl = $request->getQueryOrThrow('lvl');
    $lvl = AccessLvl::getLvlIntObj($lvl);

    JsonOutput::success(
        ProjectRoleSelector::getUsersCrudForObj($lvl, $objId)
    );
} catch (NoAccessManageUsersException) {
    JsonOutput::error('Недостаточно прав');
} catch (NoRoleFoundException) {
    JsonOutput::error('Некорректная роль');
} catch (NoUserFoundException) {
    JsonOutput::error('Неизвестный пользователь');
} catch (InvalidAccessLvlIntException) {
    JsonOutput::error('Некорректный номер уровя доступа');
} catch (InvalidAccessLvlStrException) {
    JsonOutput::error('Некорректное наименование урвня доступа');
}  catch (IncorrectLvlException) {
    JsonOutput::error('Некорректный уровень доступа');
} catch (PropelException $e) {
    JsonOutput::error($e->getMessage());
}