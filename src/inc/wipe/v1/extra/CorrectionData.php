<?php
namespace wipe\inc\v1\extra;

use Delight\Db\Throwable\Error;

class CorrectionData
{
    const ATTRIBUTE_ARRAY_TYPE_NUMERIC = 0;
    const ATTRIBUTE_ARRAY_TYPE_STRING = 1;
    const ATTRIBUTE_ARRAY_TYPE_SIMPLE = 2;
    const ATTRIBUTE_ARRAY_TYPE_ASSOC = 3;
    const ATTRIBUTE_ARRAY_TYPE_MULTIVARIATE = 4;

    public static function isArrayType(array $arr, int $ATTRIBUTE_ARRAY_TYPE_): bool
    {
        return match($ATTRIBUTE_ARRAY_TYPE_)
        {
            self::ATTRIBUTE_ARRAY_TYPE_NUMERIC => empty(array_filter($arr, fn($e) => !is_int($e))),
            self::ATTRIBUTE_ARRAY_TYPE_STRING => empty(array_filter($arr, fn($e) => !is_string($e))),
            self::ATTRIBUTE_ARRAY_TYPE_SIMPLE => array_keys($arr) === range(0, count($arr) - 1) &&
                                                 empty(array_filter($arr, fn($e) => !is_array($e) && !is_object($e))),
            self::ATTRIBUTE_ARRAY_TYPE_ASSOC => array_keys($arr) !== range(0, count($arr) - 1),
            self::ATTRIBUTE_ARRAY_TYPE_MULTIVARIATE => empty(array_filter($arr, fn($e) => !is_array($e))),
            default => false
        };
    }

    /**
     * @throws Error
     */
    public static function propelArray(array $result) : array
    {
        $newResult = [];

        if (self::isArrayType($result, self::ATTRIBUTE_ARRAY_TYPE_MULTIVARIATE)) {
            foreach ($result as $elem) {
                $newResult[] = self::propelArray($elem);
            }
        } elseif (self::isArrayType($result, self::ATTRIBUTE_ARRAY_TYPE_ASSOC)) {
            foreach ($result as $key=>$value) {
                $key = explode('.', $key);
                $newResult[$key[0]][$key[1]] = $value;
            }
        } else throw new Error('Incorrect format propel array');


        return $newResult;
    }
}