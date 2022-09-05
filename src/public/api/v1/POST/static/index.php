<?php

$request = new \inc\artemy\v1\request\Request();

$request->checkRequestVariablesStrictOrError("file_name", "content_type", "file");

$file = new \DB\StaticFile();
$file->setFile($request->getRequest("file"))
    ->setContentType($request->getRequest("content_type"))
    ->setFileName($request->getRequest("file_name"))
    ->setUrl($request->getRequest("url"))
    ->save();