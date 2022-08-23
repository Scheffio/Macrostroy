<?php

namespace wipe\inc\v1\extra;

class CorrectingData
{
    public static function propelArray(array $result) : array
    {
        $arr = [];

        foreach ($result as $key=>$value) {
            $key = explode('.', $key);
            $arr[$key[0]][$key[1]] = $value;
        }

        return $arr;
    }

    public static function propelUser(array $result): array
    {

    }
}