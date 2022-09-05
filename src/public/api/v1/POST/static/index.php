<?php

use inc\artemy\v1\json_output\JsonOutput;
use inc\artemy\v1\request\Request;

$request = new Request();

$request->checkRequestVariablesStrictOrError("file");

$file = new \DB\StaticFile();

$file->setFile(file_get_contents($_FILES["file"]["tmp_name"]))
    ->setContentType($_FILES["file"]["server_computed_type"])
    ->setFileName($_FILES["file"]["name"])
    ->save();



JsonOutput::success([
                        "url" => $_SERVER["SERVER_NAME"] . "/api/v1/static?file=" . $file->getUrl()
                    ]);