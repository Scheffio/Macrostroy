<?php

use inc\artemy\v1\json_output\JsonOutput;
use wipe\inc\v1\role\user_role\UserRole;

try {
    UserRole::getByUserId()->isManageUsersOrThrow();
} catch (Exception $e) {
    JsonOutput::error("Нет прав удаление пользователя");
}

