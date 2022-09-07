<?php
// Редактирование роли.

use inc\artemy\v1\json_output\JsonOutput;
use inc\artemy\v1\request\Request;
use Propel\Runtime\Exception\PropelException;
use wipe\inc\v1\role\user_role\exception\NoAccessManageUsersException;
use wipe\inc\v1\role\user_role\exception\NoRoleFoundException;
use wipe\inc\v1\role\user_role\exception\NoRoleObjectException;
use wipe\inc\v1\role\user_role\UserRole;

$user = new UserRole();
$request = new Request();



//try {
//    $user->isManageUsersOrThrow();
//
//    $user
//        ->setRoleId($request->getQueryOrThrow('role_id'))
//        ->setRoleName($request->getQuery('role_name'))
//        ->setObjectViewer($request->getQuery('object_viewer'))
//        ->setManageObjects($request->getQuery('manage_objects'))
//        ->setManageVolumes($request->getQuery('manage_volumes'))
//        ->setManageHistory($request->getQuery('manage_history'))
//        ->setManageUsers($request->getQuery('manage_users'))
//        ->update();
//
//    JsonOutput::success();
//} catch (PropelException|Error $e) {
//    JsonOutput::error($e->getMessage());
//} catch (NoAccessManageUsersException|NoRoleFoundException|NoRoleObjectException $e) {
//    JsonOutput::error($e->getMessage());
//}