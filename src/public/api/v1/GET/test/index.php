<?php

try {
    $projectRole = \DB\Base\ProjectRoleQuery::create()->findPk(1);
    $projectRole->setIsCrud(false);
    $projectRole->save();
} catch (\Propel\Runtime\Exception\PropelException $e) {
    \inc\artemy\v1\json_output\JsonOutput::success($e->getMessage());
}