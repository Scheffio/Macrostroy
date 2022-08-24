<?php
// Добавить роль к проекту.

use inc\artemy\v1\request\Request;

$request = new Request();

$request->checkRequestVariablesOrError(
    'lvl', 'is_crud', 'project_id', 'object_id', 'manage_history', 'manage_users'
);