<?php

use inc\artemy\v1\json_output\JsonOutput;
use wipe\inc\v1\objects\Objects;
use wipe\inc\v1\role\project_role\enum\eLvlInt;
use wipe\inc\v1\role\project_role\exception\IncorrectLvlException;

try {
//    JsonOutput::success(
//        Objects::getProjectIdByLvlAndId(
//            objectId: 1,
//            lvl: eLvlInt::PROJECT->value
//        )
//    );

//    $s = new \ext\ObjSubproject();
//    $s->setName('NewSubproject2')
//    ->setProjectId(1);
//    $s->save();

} catch (IncorrectLvlException $e) {
    JsonOutput::error([
        'getMessage' => $e->getMessage(),
        'getLine' => $e->getLine(),
        'getFile' => $e->getFile()
    ]);
}