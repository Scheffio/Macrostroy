<?php
// Вывод объекта(-ов).

use inc\artemy\v1\json_output\JsonOutput;
use wipe\inc\v1\objects\Objects;
use wipe\inc\v1\role\user_role\AuthUserRole;
use wipe\inc\v1\role\user_role\exception\NoRoleFoundException;
use wipe\inc\v1\role\user_role\exception\NoUserFoundException;

try {
    JsonOutput::success(
        Objects::getObjectsByLvl(
            lvl: 1,
            parentId: 0,
            parentLvl: 1,
            projectId: 0,
            useId: AuthUserRole::getUserId(),
            limit: 10,
            limitFrom: 0,
            isAccessManageUsers: AuthUserRole::isAccessManageUsers(),
            isAccessManageObjects: AuthUserRole::isAccessManageObjects(),
            isAccessObjectViewer: AuthUserRole::isAccessObjectViewer(),
        )
    );
} catch (NoRoleFoundException $e) {
    JsonOutput::success('Неизвестная роль');
} catch (NoUserFoundException $e) {
    JsonOutput::success('Неизвестный пользователь');
}