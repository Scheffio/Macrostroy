<?php

namespace inc\artemy\v1\json_request;

use inc\artemy\v1\json_output\JsonOutput;

class JsonRequest
{
    public static array $body;

    public static function read()
    {
//        if (!isset($_SERVER["CONTENT_TYPE"]) or $_SERVER["CONTENT_TYPE"] !== "application/json") {
//            JsonOutput::error("Client request content type should be 'application/json'");
//        }
        if (!isset(self::$body)) {
            $body = json_decode(file_get_contents('php://input'), true);

            if ($body === null) $body = array();
            else if (!is_array($body)) JsonOutput::error("Client request data is not an array");

            self::$body = $body + $_GET;
        }

        return self::$body;
    }

    public static function get(string $name)
    {
        return isset(self::read()[$name]) ? self::read()[$name] : null;
    }

    public static function getOrThrow(string $name)
    {
        return isset(self::read()[$name]) ? self::read()[$name] : JsonOutput::error("Client did not sent required variable - [$name]");
    }
}