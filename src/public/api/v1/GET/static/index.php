<?php

use inc\artemy\v1\json_output\JsonOutput;

$request = new \inc\artemy\v1\request\Request();

$file = \DB\StaticFileQuery::create()->findOneByUrl($request->getQueryOrThrow("file"));

if ($file === null) JsonOutput::error("File not found");

if (!str_starts_with($file->getContentType(), "image/")) header("Content-Type: ");

header('Content-Type: ') . $file->getContentType();
header('Content-Transfer-Encoding: binary');
if (!empty($request->getQuery("download"))) header('Content-Disposition: attachment; filename=' . "file.file");

echo stream_get_contents($file->getFile());