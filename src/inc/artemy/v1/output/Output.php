<?php

namespace inc\artemy\v1\output;

use Delight\Db\Throwable\Error;
use DOMDocument;
use inc\artemy\v1\development_mode\DevelopmentMode;
use inc\artemy\v1\http_response_code_handler\HTTPResponse;
use inc\artemy\v1\json_output\JsonOutput;
use inc\artemy\v1\mime_type\MimeType;
use inc\artemy\v1\router\Router;
use inc\artemy\v1\router\RouterParser;
use JetBrains\PhpStorm\NoReturn;

class Output
{

    /**
     * @throws FileNotFoundException
     * @throws MethodNotImplementedException
     */
    public static function outputApi(): void
    {
        MimeType::setContentTypeHeader("application/json");

        //Ссылка клиента
        $path = RouterParser::getPath();

        //запрашиваемая версия API
        $api_version = (function () use ($path) {
            if (empty($path[2]) or !str_starts_with($path[2], "v") or !is_numeric(substr($path[2], 1))) {
                JsonOutput::error("Ошибка версии API в запросе. Пример: /api/v1/test");
            }

            if (!is_dir(__DIR__ . "/../../../../public/api/") . $path[2]) {

                $versions = array_filter(scandir(__DIR__ . "/../../../../public/api/", 1), function ($var) {
                    if ($var === "." or $var === "..") {
                        return false;
                    }
                    if (!is_dir(__DIR__ . "/../../../../public/api/" . $var)) {
                        return false;
                    }

                    return true;
                });

                if (!in_array($path[2], $versions)) {
                    if (DevelopmentMode::isActive()) {
                        JsonOutput::error("Версия --> " . $path[2] . " <-- отсутствует на сервере. Доступные версии - " .
                                          implode(", ", $versions));
                    } else {
                        JsonOutput::error("Версия --> " . $path[2] . " <-- отсутствует на сервере");
                    }
                }
            }

            return $path[2];
        })();

        //запрашиваемый метод
        $api_method = (function () use ($api_version) {
            $method = strtoupper($_SERVER["REQUEST_METHOD"]);
            $isMethodImplemented =
                is_dir(
                    RouterParser::getInternalRootPath()
                    . DIRECTORY_SEPARATOR
                    . "api"
                    . DIRECTORY_SEPARATOR
                    . $api_version
                    . DIRECTORY_SEPARATOR
                    . $method);

            if (!$isMethodImplemented) throw new MethodNotImplementedException();
            return $method;
        })();

        $api_path = (function () {
            $path = RouterParser::getPath();
            return implode("/", array_slice($path, 2));
        })();

        self::outputOrThrow(
            RouterParser::getInternalRootPath()
            . "api"
            . DIRECTORY_SEPARATOR
            . $api_version
            . DIRECTORY_SEPARATOR
            . $api_method
            . DIRECTORY_SEPARATOR
            . $api_path
            . DIRECTORY_SEPARATOR
            . "index.php"
        );
    }

    /**
     * @throws FileNotFoundException
     */
    public static function outputPage(): void
    {
        $isMainPage = RouterParser::getFirstUrlCatalog() === null;
        $filename = RouterParser::getFile() ?? "index.php";
        if ($isMainPage) {
            $path =
                RouterParser::getInternalRootPath()
                . "page"
                . DIRECTORY_SEPARATOR
                . "MAIN_PAGE"
                . DIRECTORY_SEPARATOR;
        } else {
            $path =
                RouterParser::getInternalRootPath()
                . "page"
                . DIRECTORY_SEPARATOR
                . implode(DIRECTORY_SEPARATOR, RouterParser::getPath())
                . (RouterParser::getFirstUrlCatalog() === null ? "" : DIRECTORY_SEPARATOR);

        }

        self::outputOrThrow($path . $filename);
    }

    /**
     * @throws FileNotFoundException
     */
    public static function outputStatic(): void
    {
        $path = self::getOutputStaticPath();
        self::outputOrThrow($path);
    }

    /**
     * @throws FileNotFoundException
     */
    public static function getOutputStaticPath(): ?string
    {
        //запрашиваемый URL путь пользователя
        $array = RouterParser::getPath();
        if (RouterParser::getFile() !== null) {
            $array[] = RouterParser::getFile();
        }

        //запрашиваемый файл пользователя
        $user_requested_file = array_pop($array);
        $path = RouterParser::getInternalRootPath()
                . implode(DIRECTORY_SEPARATOR, $array);

        if (!is_dir($path)) throw new FileNotFoundException();
        $scan = array_diff(scandir($path), array('..', '.'));

        //проверка на совпадение начала названия файла по всей папке
        foreach ($scan as $file) {
            if (is_file($path . DIRECTORY_SEPARATOR . $file) and str_starts_with($file, $user_requested_file)) {
                return $path
                       . DIRECTORY_SEPARATOR
                       . $file;
            }
        }

        return null;
    }

    /**
     * @throws FileNotFoundException
     * @throws Error
     */
    public static function outputOrThrow($filename): void
    {
//        var_dump($filename);
        if ($filename === null or !file_exists($filename)) throw new FileNotFoundException("Не удалось найти файл {$filename}", 404);


        //является ли запрос API
        if (Router::isApi()) {
            //присвоение типа контента как "application/json"
            $mimeType = "application/json";
        } else {
            //иначе определения типа контента через расширение файла
            $extension = pathinfo($filename, PATHINFO_EXTENSION);
            $mimeType = MimeType::getMimeType($extension);
        }

        //присвоение типа контента
        MimeType::setContentTypeHeader($mimeType);


        //автоматическое добавление JS и CSS в <head> если файлы в той же папке
        if (Router::isPage() and str_ends_with($filename, "index.php")) {

            //чтение файла
            ob_start();
            require $filename;
            $result = ob_get_clean();

            //если файл пустой, то выходим (предотвращение ошибки при попытке парсинга пустого файла)
            if ($result === "") {
                die("");
            }

            //поиск в файле <head> тега
            $doc = new DOMDocument();
            libxml_use_internal_errors(true);
            $doc->loadHTML($result);
            libxml_clear_errors();
            $head_tag = $doc->getElementsByTagName("head")->item(0);

            if ($head_tag === null) {
                require $filename;
                die(200);
            }
//            var_dump("test");
            $template = $doc->createDocumentFragment();

            //-9 because "index.php" is 9 symbols
            $path = substr($filename, 0, -9);
            $string_to_append = "";
//            $string_to_append = "<script src=\"script.js\" type='module'></script>";

            $isMainPage = RouterParser::getFirstUrlCatalog() === null;
            $base =
                htmlspecialchars("/"
                                 . implode(DIRECTORY_SEPARATOR, RouterParser::getPath())
                                 . ($isMainPage ? ("MAIN_PAGE" . "/") : "")
                                 . (RouterParser::getFirstUrlCatalog() === null ? "" : "/"));
//            var_dump($base);

            $string_to_append .= "    <base href='$base'></base>";

            if (file_exists($path . "style.css")) {
                $string_to_append .= "    <link rel='stylesheet' href='style.css'></link>";
            }

            $is_script_exists = file_exists($path . "script.js");
            $is_script_module_exists = file_exists($path . "script_module.js");

            if ($is_script_exists or $is_script_module_exists) {
                $string_to_append .= "    <script defer='1'
  src=\"https://code.jquery.com/jquery-3.6.0.js\"
  integrity=\"sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=\"
  crossorigin=\"anonymous\"></script>";
            }

            if ($is_script_exists) {
                $string_to_append .= "    <script defer='1' src=\"script.js\"></script>";
            }

            if ($is_script_module_exists) {
                $string_to_append .= "    <script defer='1' src=\"script_module.js\" type='module'></script>";
            }


            $template->appendXML($string_to_append);
            $head_tag->appendChild($template);

            echo $doc->saveHTML();
            die();
        } elseif (str_starts_with($mimeType, "image/")) {
            readfile($filename);
            die();
        }

        if (Router::isStatic() and str_starts_with($mimeType, "image/")) {
            readfile($filename);
            die();
        }


        require $filename;
        die();
    }

    #[NoReturn] public static function outputError404()
    {
        http_response_code(404);

        if (Router::isApi()) {
            JsonOutput::error("Запрашиваемый путь к API не найден", HTTPResponse::NOT_FOUND);

        } else {
            require(
                RouterParser::getInternalRootPath()
                . "page"
                . DIRECTORY_SEPARATOR
                . "404"
                . DIRECTORY_SEPARATOR
                . "index.php"
            );

            die(404);
        }
    }

    #[NoReturn] public static function outputError501()
    {
        http_response_code(501);

        JsonOutput::error("Метод {$_SERVER["REQUEST_METHOD"]} не имплементирован.");
    }
}