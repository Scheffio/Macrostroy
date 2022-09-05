<?php

namespace wipe\inc\v1\access_lvl;

use wipe\inc\v1\access_lvl\enum\eLvlObjInt;
use wipe\inc\v1\access_lvl\enum\eLvlObjStr;
use wipe\inc\v1\access_lvl\exception\InvalidAccessLvlIntException;
use wipe\inc\v1\access_lvl\exception\InvalidAccessLvlStrException;

class AccessLvl
{
    #region Access Lvl Obj
    /**
     * @param int $lvl Номер уровня доступа.
     * @return string Наименование уровня доступа но его номеру.
     * @throws InvalidAccessLvlIntException
     */
    public static function getAccessLvlStrObj(int $lvl): string
    {
        return match ($lvl) {
            eLvlObjInt::PROJECT->value => eLvlObjStr::PROJECT->value,
            eLvlObjInt::SUBPROJECT->value => eLvlObjStr::SUBPROJECT->value,
            eLvlObjInt::GROUP->value => eLvlObjStr::GROUP->value,
            eLvlObjInt::HOUSE->value => eLvlObjStr::HOUSE->value,
            eLvlObjInt::STAGE->value => eLvlObjStr::STAGE->value,
            default => throw new InvalidAccessLvlIntException()
        };
    }

    /**
     * @param string $lvl Наименование уровня доступа.
     * @return int Номер уровня доступа по его наименованию.
     * @throws InvalidAccessLvlStrException
     */
    public static function getAccessLvlIntObj(string $lvl): int
    {
        return match ($lvl) {
            eLvlObjStr::PROJECT->value => eLvlObjInt::PROJECT->value,
            eLvlObjStr::SUBPROJECT->value => eLvlObjInt::SUBPROJECT->value,
            eLvlObjStr::GROUP->value => eLvlObjInt::GROUP->value,
            eLvlObjStr::HOUSE->value => eLvlObjInt::HOUSE->value,
            eLvlObjStr::STAGE->value => eLvlObjInt::STAGE->value,
            default => throw new InvalidAccessLvlStrException()
        };
    }

    public static function checkLvl
    #endregion
}