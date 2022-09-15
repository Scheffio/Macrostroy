<?php

namespace wipe\inc\v1\access_lvl;

use DB\Map\ObjGroupTableMap;
use DB\Map\ObjHouseTableMap;
use DB\Map\ObjProjectTableMap;
use DB\Map\ObjStageTableMap;
use DB\Map\ObjSubprojectTableMap;
use wipe\inc\v1\access_lvl\enum\eLvlObjInt;
use wipe\inc\v1\access_lvl\enum\eLvlObjStr;
use wipe\inc\v1\access_lvl\enum\eLvlVolInt;
use wipe\inc\v1\access_lvl\enum\eLvlVolStr;
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
    public static function getAccessLvlStrObjByInt(int $lvl): string
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
    public static function getAccessLvlIntObjByStr(string $lvl): int
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

    /**
     * Проверка, что переданное число является номером уровня доступа объекта.
     * @param int $lvl Уровень доступа.
     * @return bool
     */
    public static function isAccessLvlIntObj(int $lvl): bool
    {
        return in_array($lvl, [
            eLvlObjInt::PROJECT->value,
            eLvlObjInt::SUBPROJECT->value,
            eLvlObjInt::GROUP->value,
            eLvlObjInt::HOUSE->value,
            eLvlObjInt::STAGE->value,
        ]);
    }

    /**
     * Проверка, что переданная строка является наименованием уровня доступа объекта.
     * @param string $lvl Уровень доступа.
     * @return bool
     */
    public static function isAccessLvlStrObj(string $lvl): bool
    {
        return in_array($lvl, [
            eLvlObjStr::PROJECT->value,
            eLvlObjStr::SUBPROJECT->value,
            eLvlObjStr::GROUP->value,
            eLvlObjStr::HOUSE->value,
            eLvlObjStr::STAGE->value,
        ]);
    }

    /**
     * Проверка, что переданное число является номером уровня доступа объекта, иначе - ошибка.
     * @param int $lvl Уровень доступа.
     * @return bool
     * @throws InvalidAccessLvlIntException
     */
    public static function isAccessLvlIntObjOrThrow(int $lvl): int
    {
        return self::isAccessLvlIntObj($lvl) ? $lvl : throw new InvalidAccessLvlIntException();
    }

    /**
     * Проверка, что переданная строка является наименованием уровня доступа объекта, иначе - ошибка.
     * @param string $lvl Уровень доступа.
     * @return bool
     * @throws InvalidAccessLvlIntException
     */
    public static function isAccessLvlStrObjOrThrow(string $lvl): string
    {
        return self::isAccessLvlStrObj($lvl) ? $lvl : throw new InvalidAccessLvlIntException();
    }

    /**
     * Возвращает номер уровня доступа, с ошибкой при некорректном зачении.
     * @param int|string $lvl Уровень доступа.
     * @return int Номер уровня доступа.
     * @throws InvalidAccessLvlIntException
     * @throws InvalidAccessLvlStrException
     */
    public static function getLvlIntObj(int|string $lvl): int
    {
        return is_string($lvl) ? self::getAccessLvlIntObjByStr($lvl) : self::isAccessLvlIntObjOrThrow($lvl);
    }

    /**
     * @param int $lvl Номер уровня доступа.
     * @return int Номер предыдещего уровня (родителя).
     * @throws InvalidAccessLvlIntException
     */
    public static function getPreLvlIntObj(int $lvl): int
    {
        return match ($lvl) {
            eLvlObjInt::PROJECT->value,
            eLvlObjInt::SUBPROJECT->value => eLvlObjInt::PROJECT->value,
            eLvlObjInt::GROUP->value => eLvlObjInt::SUBPROJECT->value,
            eLvlObjInt::HOUSE->value => eLvlObjInt::GROUP->value,
            eLvlObjInt::STAGE->value => eLvlObjInt::HOUSE->value,
            default => throw new InvalidAccessLvlIntException()
        };
    }

    /**
     * Возвращает номер уровня доступа объекта, используя наименование ID атрибута таблицы.
     * @param string $colId Наименование ID атрибута таблицы (MapTable).
     * @return int
     * @throws InvalidAccessLvlIntException
     */
    public static function getLvlIntObjByColId(string $colId): int
    {
        return match ($colId) {
            ObjProjectTableMap::COL_ID => eLvlObjInt::PROJECT->value,
            ObjSubprojectTableMap::COL_ID => eLvlObjInt::SUBPROJECT->value,
            ObjGroupTableMap::COL_ID => eLvlObjInt::GROUP->value,
            ObjHouseTableMap::COL_ID => eLvlObjInt::HOUSE->value,
            ObjStageTableMap::COL_ID => eLvlObjInt::STAGE->value,
            default => throw new InvalidAccessLvlIntException()
        };
    }
    #endregion

    #region Access Lvl Vol
    /**
     * @param int $lvl Номер уровня доступа.
     * @return string Наименование уровня доступа но его номеру.
     * @throws InvalidAccessLvlIntException
     */
    public static function getAccessLvlStrVolByInt(int $lvl): string
    {
        return match ($lvl) {
            eLvlVolInt::WORK->value => eLvlVolStr::WORK->value,
            eLvlVolInt::TECHNIC->value => eLvlVolStr::TECHNIC->value,
            eLvlVolInt::MATERIAL->value => eLvlVolStr::MATERIAL->value,
            default => throw new InvalidAccessLvlIntException()
        };
    }

    /**
     * @param string $lvl Наименование уровня доступа.
     * @return int Номер уровня доступа по его наименованию.
     * @throws InvalidAccessLvlStrException
     */
    public static function getAccessLvlIntVolByStr(string $lvl): int
    {
        return match ($lvl) {
            eLvlVolStr::WORK->value => eLvlVolInt::WORK->value,
            eLvlVolStr::TECHNIC->value => eLvlVolInt::TECHNIC->value,
            eLvlVolStr::MATERIAL->value => eLvlVolInt::MATERIAL->value,
            default => throw new InvalidAccessLvlStrException()
        };
    }

    /**
     * Проверка, что переданное число является номером уровня доступа объекта.
     * @param int $lvl Уровень доступа.
     * @return bool
     */
    public static function isAccessLvlIntVol(int $lvl): bool
    {
        return in_array($lvl, [
            eLvlVolInt::WORK->value,
            eLvlVolInt::TECHNIC->value,
            eLvlVolInt::MATERIAL->value,
        ]);
    }

    /**
     * Проверка, что переданная строка является наименованием уровня доступа объекта.
     * @param string $lvl Уровень доступа.
     * @return bool
     */
    public static function isAccessLvlStrVol(string $lvl): bool
    {
        return in_array($lvl, [
            eLvlVolStr::WORK->value,
            eLvlVolStr::TECHNIC->value,
            eLvlVolStr::MATERIAL->value,
        ]);
    }

    /**
     * Проверка, что переданное число является номером уровня доступа объекта, иначе - ошибка.
     * @param int $lvl Уровень доступа.
     * @return bool
     * @throws InvalidAccessLvlIntException
     */
    public static function isAccessLvlIntVolOrThrow(int $lvl): bool
    {
        return self::isAccessLvlIntVol($lvl) ?: throw new InvalidAccessLvlIntException();
    }

    /**
     * Проверка, что переданная строка является наименованием уровня доступа объекта, иначе - ошибка.
     * @param string $lvl Уровень доступа.
     * @return bool
     * @throws InvalidAccessLvlIntException
     */
    public static function isAccessLvlStrVolOrThrow(string $lvl): bool
    {
        return self::isAccessLvlStrVol($lvl) ?: throw new InvalidAccessLvlIntException();
    }

    /**
     * Возвращает номер уровня доступа, с ошибкой при некорректном зачении.
     * @param int|string $lvl Уровень доступа.
     * @return int Номер уровня доступа.
     * @throws InvalidAccessLvlIntException
     * @throws InvalidAccessLvlStrException
     */
    public static function getLvlIntVol(int|string $lvl): int
    {
        return is_string($lvl) ? self::getAccessLvlIntVolByStr($lvl) : self::isAccessLvlIntVolOrThrow($lvl);
    }
    #endregion
}