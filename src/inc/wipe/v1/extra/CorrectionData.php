<?php
namespace wipe\inc\v1\extra;

class CorrectionData
{
    const ATTRIBUTE_ARRAY_MODE_NUMERIC = 0;
    const ATTRIBUTE_ARRAY_MODE_STRING = 1;
    const ATTRIBUTE_ARRAY_MODE_SIMPLE = 2;
    const ATTRIBUTE_ARRAY_MODE_ASSOCIABLE = 3;
    const ATTRIBUTE_ARRAY_MODE_MULTIVARIATE = 4;

    public static function arrayType(array $arr, int $ATTRIBUTE_ARRAY_MODE_ = self::ATTRIBUTE_ARRAY_MODE_ASSOCIABLE)
    {
        return match($ATTRIBUTE_ARRAY_MODE_)
        {
            self::ATTRIBUTE_ARRAY_MODE_NUMERIC => empty(array_filter($arr, fn($e) => !is_int($e))),
            self::ATTRIBUTE_ARRAY_MODE_STRING => empty(array_filter($arr, fn($e) => !is_string($e))),
            self::ATTRIBUTE_ARRAY_MODE_SIMPLE => array_keys($arr) === range(0, count($arr) - 1) && empty(array_filter($arr, fn($e) => !is_array($e) && !is_object($e))),
            self::ATTRIBUTE_ARRAY_MODE_ASSOCIABLE => array_keys($arr) !== range(0, count($arr) - 1),
            self::ATTRIBUTE_ARRAY_MODE_MULTIVARIATE => empty(array_filter($arr, fn($e) => !is_array($e))),
            default => false
        };
    }

    public static function propelArray(array $result) : array
    {
        $arr = [];

        foreach ($result as $key=>$value) {
            $key = explode('.', $key);
            $arr[$key[0]][$key[1]] = $value;
        }

        return $arr;
    }
}