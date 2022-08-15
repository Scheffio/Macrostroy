<?php

namespace inc\artemy\v1\http_response_code_handler;

class ResponseCodeHandler
{
    public static function setCode(HTTPResponse $code)
    {
        http_response_code($code->value);
    }
}