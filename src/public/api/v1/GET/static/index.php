<?php

$request = new \inc\artemy\v1\request\Request();

$file = new \DB\StaticFile();
$file->setFile("123")
    ->setContentType("123")
    ->setFileName("123")
    ->setUrl("qqq")
    ->save();