<?php

use inc\artemy\v1\json_output\JsonOutput;
use inc\artemy\v1\request\Request;

$request = new Request();

$request->checkRequestVariablesStrictOrError("file_name", "content_type", "file");

$file = new \DB\StaticFile();
$file->setFile($request->getRequest("file"))
    ->setContentType($request->getRequest("content_type"))
    ->setFileName($request->getRequest("file_name"))
    ->setUrl($request->getRequest("url"))
    ->save();

JsonOutput::success([
                        "url" => $_SERVER["SERVER_NAME"] . "/api/v1/static?file=" . $file->getUrl()
                    ]);