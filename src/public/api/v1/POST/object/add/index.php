<?php
// Добавление объектов.

use inc\artemy\v1\request\Request;
use inc\artemy\v1\json_output\JsonOutput;

$request = new Request();

try {
//    objectName
} catch (Exception $e) {
    JsonOutput::success($e->getMessage());
}
