<?php


namespace inc\artemy\v1\request;

use inc\artemy\v1\data_type_parser\DataTypeParser;
use inc\artemy\v1\development_mode\DevelopmentMode;
use inc\artemy\v1\json_output\JsonOutput;
use JetBrains\PhpStorm\Deprecated;
use JetBrains\PhpStorm\ExpectedValues;
use JetBrains\PhpStorm\Immutable;
use Symfony\Component\Translation\Dumper\IniFileDumper;
use const FILTER_SANITIZE_SPECIAL_CHARS;

#[Immutable]
/**
 * Усовершенствованный механизм получения HTTP методов
 */
class Request
{
    /**
     * Имя метода
     */
    private static string|null $method_name;

    /**
     * Массив с мета данными (метод GET)
     */
    private static array $get_body;

    /**
     * Массив с телом данных дополнительного метода, выбранного клиентом
     */
    public static array $method_body;

    const PARSE_NONE = 1;
    const PARSE_VALUES = 2;

    public function __construct(#[ExpectedValues(self::PARSE_VALUES, self::PARSE_NONE)] $flag = self::PARSE_VALUES)
    {
        self::$method_name = filter_var(empty($_SERVER["REQUEST_METHOD"]) ? null : $_SERVER["REQUEST_METHOD"],
                                        FILTER_SANITIZE_SPECIAL_CHARS);

        self::$get_body = array_map(function ($value) {
            return filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS);
        }, $_GET);

        if (!empty(self::$get_body) and str_ends_with(self::$get_body[array_key_last(self::$get_body)], "/")) {
            self::$get_body[array_key_last(self::$get_body)] = substr(self::$get_body[array_key_last(self::$get_body)], 0, -1);
        }

        self::$method_body = $_POST;

        if ($flag === self::PARSE_VALUES) {
            self::$get_body = DataTypeParser::parse(self::$get_body);
            self::$method_body = DataTypeParser::parse(self::$method_body);
        }

        self::$method_body = self::$method_body + $_FILES;
    }

    /**
     * Возвращает название отправленного метода.
     * Если метод не был отправлен - возвращает "GET"
     */
    public function getMethodName(): string|null
    {
        return self::$method_name;
    }

    public function checkRequestVariables(...$variables): bool
    {
        $missingVariables = array();
        foreach ($variables as $variable) {
            if (!array_key_exists($variable, self::$method_body)) {
                $missingVariables[] = $variable;
            }

        }

        if (!empty($missingVariables)) {
            return false;
        }

        return true;
    }

    /**
     * Проверяет на наличие всех переменных в теле метода.
     */
    public function checkRequestVariablesOrError(...$variables): bool
    {
        $missingVariables = array();
        foreach ($variables as $variable) {
            if (!array_key_exists($variable, self::$method_body)) {
                $missingVariables[] = $variable;
            }

        }

        if (!empty($missingVariables)) {
            if (DevelopmentMode::isActive()) {
                JsonOutput::wrongRequest("BAD REQUEST 400. Missing this variables: [" . implode(", ", $missingVariables) . "]");
            } else {
                JsonOutput::wrongRequest();
            }
        }

        return true;
    }

    public function checkRequestVariablesStrictOrError(...$variables): bool
    {
        $missingVariables = array();
        foreach ($variables as $variable) {
            if (empty(self::$method_body[$variable])) {
                $missingVariables[] = $variable;
            }

        }

        if (!empty($missingVariables)) {
            if (DevelopmentMode::isActive()) {
                JsonOutput::wrongRequest("BAD REQUEST 400. Missing this variables: [" . implode(", ", $missingVariables) . "]");
            } else {
                JsonOutput::wrongRequest();
            }
        }

        return true;
    }

    /**
     * Получение значения с помощью ключа из переданного
     * метода из тела запроса.
     * @param string $key
     * @return mixed|null
     */
    public function getRequest(string $key): mixed
    {
        if (isset(self::$method_body[$key])) {
            return self::$method_body[$key];
        }

        return null;
    }

    /**
     * По какой-то там расширенной REST API конвенции разрешено
     * дополнительно передавать Meta метод GET в строке запроса
     * даже если другой метод существует в теле запроса.
     * @param string $key
     * @return mixed|null
     */
    public function getQuery(string $key): mixed
    {
        if (isset(self::$get_body[$key])) {
            return self::$get_body[$key];
        }

        return null;
    }

    /**
     * @param string $key
     * @return mixed|null
     * @see Request::getData()
     *      или выкидывание ошибки
     */
    public function getRequestOrThrow(string $key): mixed
    {
        if (isset(self::$method_body[$key])) {
            return self::$method_body[$key];
        }

        JsonOutput::wrongRequest("BAD REQUEST 400. Missing this variable: [$key]");
    }

    /**
     * @param string $key
     * @return mixed|null
     * @see Request::getMeta()
     *      или выкидывание ошибки
     */
    public function getQueryOrThrow(string $key): mixed
    {
        if (isset(self::$get_body[$key])) {
            return self::$get_body[$key];
        }

        JsonOutput::wrongRequest("BAD REQUEST 400. Missing this variable: [$key]");
    }

    public static function getArray() :array
    {
        return self::$method_body + self::$get_body;
    }

    public function isManageUsersOrThrow(string $string)
    {
    }
}