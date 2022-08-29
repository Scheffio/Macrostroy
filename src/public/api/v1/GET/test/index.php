<?php

use inc\artemy\v1\json_output\JsonOutput;
use wipe\inc\v1\objects\Objects;

JsonOutput::success(
    Objects::getProjectId(1, 1)
);