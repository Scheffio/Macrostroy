<?php

use inc\artemy\v1\json_output\JsonOutput;
use wipe\inc\v1\objects\Objects;

try {
    JsonOutput::success(
        Objects::getProjectId(1, 1)
    );
} catch (Exception $e) {
    JsonOutput::error([
        'message' => $e->getMessage(),
        'line' => $e->getLine(),
    ]);
}