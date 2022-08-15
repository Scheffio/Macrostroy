<?php
declare(strict_types=1);

use inc\artemy\v1\auth\Auth;
use inc\artemy\v1\development_mode\DevelopmentMode;
use inc\artemy\v1\json_output\JsonOutput;
use inc\artemy\v1\mime_type\MimeType;
use inc\artemy\v1\output\FileNotFoundException;
use inc\artemy\v1\output\MethodNotImplementedException;
use inc\artemy\v1\output\Output;
use inc\artemy\v1\request_body_parser\RequestBodyParser;
use inc\artemy\v1\router\Router;
use inc\artemy\v1\router\RouterParser;

require "vendor/autoload.php";
require "generated-conf/config.php";

DevelopmentMode::on();
setlocale(LC_ALL, 'ru_RU', 'ru_RU.UTF-8', 'ru', 'russian');

$_POST = RequestBodyParser::singleton()->getRequest();
$_FILES = RequestBodyParser::singleton()->getFiles();
$_REQUEST += $_POST;

//подключение статических файлов
if (Router::isStatic()) {
    try {
        Output::outputStatic();
        MimeType::setContentTypeHeader(MimeType::getMimeType(RouterParser::getFile()));
    } catch (FileNotFoundException $e) {
        Output::outputError404();
    }
}

if (Router::isPage() and !Auth::getUser()->isLoggedIn() and RouterParser::getFirstUrlCatalog() !== "auth") {
    header("Location: /auth");
    die();
}

//подключение API страницы
if (Router::isApi()) {
    try {
        Output::outputApi();
    } catch (FileNotFoundException $e) {
        Output::outputError404();
    } catch (MethodNotImplementedException $e) {
        Output::outputError501();
    } catch (Error $e) {
        if (DevelopmentMode::isActive()) {
            JsonOutput::error($e->getMessage(), \inc\artemy\v1\http_response_code_handler\HTTPResponse::INTERNAL_SERVER_ERROR);
        } else {
            JsonOutput::error("internal Server Error",
                              \inc\artemy\v1\http_response_code_handler\HTTPResponse::INTERNAL_SERVER_ERROR);
        }
    }
}

//подключение клиентской страницы
if (Router::isPage()) {
    try {
        Output::outputPage();
    } catch (FileNotFoundException $e) {
        Output::outputError404();
    }
}

//секурити чек
ob_clean();
ob_start();
echo "этого не должно быть видно!!!";
ob_end_flush();