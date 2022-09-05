<?php

use inc\artemy\v1\json_output\JsonOutput;

$request = new \inc\artemy\v1\request\Request();

$file = \DB\StaticFileQuery::create()->findOneByUrl($request->getQueryOrThrow("path"));

if ($file === null) JsonOutput::error("File not found");

header('Content-Description: File Transfer');
header('Content-Disposition: attachment; filename=' . "file.file");
header('Content-Transfer-Encoding: binary');

echo stream_get_contents($file->getFile());