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
            lvl: 2,
            parentId: 1,
            userId: 17,
            limit: 10,
            limitFrom: 0,
        )
    );
} catch (NoRoleFoundException $e) {
    JsonOutput::error('Неизвестная роль');
} catch (NoUserFoundException $e) {
    JsonOutput::error('Неизвестный пользователь');
} catch (\Propel\Runtime\Exception\PropelException $e) {
    JsonOutput::error($e->getMessage());
}``