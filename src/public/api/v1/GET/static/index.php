<?php

use inc\artemy\v1\json_output\JsonOutput;

$request = new \inc\artemy\v1\request\Request();

$file = \DB\StaticFileQuery::create()->findOneByUrl($request->getQueryOrThrow("file"));

if ($file === null) die(404);

if (str_starts_with($file->getContentType(), "image/")) {
    //если картинка - присвоить content type
    header('Content-Type: ') . $file->getContentType();
} else {
    header("Content-Type: text/plain");
}
header('Content-Transfer-Encoding: binary');
{
    try {
        $ext = \inc\artemy\v1\mime_type\MimeType::mime2ext($file->getContentType(), ".");
    } catch (Exception) {
        $ext = "";
    }
    if (!empty($request->getQuery("download"))) header('Content-Disposition: attachment; filename=' . "file" . $ext);
}

echo stream_get_contents($file->getFile());