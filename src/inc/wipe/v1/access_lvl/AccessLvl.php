<?php

namespace wipe\inc\v1\access_lvl;

class AccessLvl
{
    /**
     * @param int $lvl Номер уровня доступа.
     * @return string Наименование уровня доступа но его номеру.
     * @throws IncorrectLvlException
     */
    public static function getLvlNameByInt(int $lvl): string
    {
        return match ($lvl) {
            eLvlInt::PROJECT->value => eLvlStr::PROJECT->value,
            eLvlInt::SUBPROJECT->value => eLvlStr::SUBPROJECT->value,
            eLvlInt::GROUP->value => eLvlStr::GROUP->value,
            eLvlInt::HOUSE->value => eLvlStr::HOUSE->value,
            eLvlInt::STAGE->value => eLvlStr::STAGE->value,
            default => throw new IncorrectLvlException()
        };
    }

    /**
     * @param string $lvl Наименование уровня доступа.
     * @return int Номер уровня доступа по его наименованию.
     * @throws IncorrectLvlException
     */
    public static function getLvlByStr(string $lvl): int
    {
        return match ($lvl) {
            eLvlStr::PROJECT->value => eLvlInt::PROJECT->value,
            eLvlStr::SUBPROJECT->value => eLvlInt::SUBPROJECT->value,
            eLvlStr::GROUP->value => eLvlInt::GROUP->value,
            eLvlStr::HOUSE->value => eLvlInt::HOUSE->value,
            eLvlStr::STAGE->value => eLvlInt::STAGE->value,
            default => throw new IncorrectLvlException()
        };
    }
}