<?php
// Вывод объекта(-ов).

use inc\artemy\v1\json_output\JsonOutput;
use wipe\inc\v1\objects\Objects;
use wipe\inc\v1\role\user_role\AuthUserRole;
use wipe\inc\v1\role\user_role\exception\NoRoleFoundException;
use wipe\inc\v1\role\user_role\exception\NoUserFoundException;

try {
    $stageId = 3;

    $unit = new \DB\VolUnit();
    $unit->setName('test')->save();
    $unitId = $unit->getId();

    $material = new \ext\VolMaterial();
    $material->setName('TestMaterial')->setPrice(100)->setUnitId($unitId)->save();
    $materialId = $material->getId();

    $technic = new \ext\VolTechnic();
    $technic->setName('TestTechnic')->setPrice(100)->setUnitId($unitId)->save();
    $technicId = $technic->getId();

    $work = new \ext\VolTechnic();
    $work->setName('TestWork')->setPrice(100)->setUnitId($unitId)->save();
    $workId = $work->getId();

    $workMaterial = new \DB\VolWorkMaterial();

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
    JsonOutput::error('Неизвестная роль');
} catch (NoUserFoundException $e) {
    JsonOutput::error('Неизвестный пользователь');
} catch (\Propel\Runtime\Exception\PropelException $e) {
    JsonOutput::error($e->getMessage());
}