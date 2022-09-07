<?php
namespace wipe\api\v1\get\users;
//Вывод пользователей.

use DB\Base\UsersQuery;
use DB\Map\ProjectRoleTableMap;
use DB\Map\UserRoleTableMap;
use DB\Map\UsersTableMap;
use Delight\Auth\Auth;
use Illuminate\Support\Js;
use inc\artemy\v1\request\Request;
use Propel\Runtime\ActiveQuery\Criteria;
use Symfony\Component\Validator\Constraints\Json;
use wipe\inc\v1\access_lvl\AccessLvl;
use wipe\inc\v1\access_lvl\exception\InvalidAccessLvlIntException;
use wipe\inc\v1\access_lvl\exception\InvalidAccessLvlStrException;
use wipe\inc\v1\objects\exception\NoFindObjectException;
use wipe\inc\v1\objects\Objects;
use wipe\inc\v1\role\project_role\exception\IncorrectLvlException;
use wipe\inc\v1\role\project_role\ProjectRole;
use wipe\inc\v1\role\user_role\AuthUserRole;
use wipe\inc\v1\role\user_role\exception\NoAccessManageUsersException;
use wipe\inc\v1\role\user_role\exception\NoRoleFoundException;
use wipe\inc\v1\role\user_role\exception\NoUserFoundException;
use wipe\inc\v1\role\user_role\UserRole;
use inc\artemy\v1\json_output\JsonOutput;
use Propel\Runtime\Exception\PropelException;

try {
    AuthUserRole::isAccessManageUsersOrThrow();

    if (empty($_GET)) {
        JsonOutput::success(
            UsersQuery::create()
                ->select(['id', 'username'])
                ->find()
                ->getData()
        );
    }

    $request = new Request();
    $objectId = $request->getQueryOrThrow('object_id');
    $lvl = $request->getQueryOrThrow('lvl');
    $lvl = AccessLvl::getLvlIntObj($lvl);

    $projectId = Objects::getProjectIdByChildOrThrow($objectId, $lvl);

    JsonOutput::success(
        ProjectRole::getCrudUsersObject($lvl, $projectId)
    );
} catch (NoAccessManageUsersException $e) {
    JsonOutput::error('Недостаточно прав');
} catch (NoRoleFoundException $e) {
    JsonOutput::error('Роль не была найдена');
} catch (NoUserFoundException $e) {
    JsonOutput::error('Пользователь не найден');
} catch (InvalidAccessLvlIntException $e) {
    JsonOutput::error('Некорретный номер уровя доступа');
} catch (InvalidAccessLvlStrException $e) {
    JsonOutput::error('Некорретное наименование урвня доступа');
}  catch (IncorrectLvlException $e) {
    JsonOutput::error('Некорректный уровень доступа');
} catch (NoFindObjectException $e) {
        JsonOutput::error('Объект не был найден');
} catch (PropelException $e) {
    JsonOutput::error($e->getMessage());
}