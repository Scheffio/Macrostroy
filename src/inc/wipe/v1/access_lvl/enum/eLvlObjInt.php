<?php
namespace wipe\inc\v1\access_lvl\enum;

enum eLvlObjInt: int
{
    case PROJECT = 1;
    case SUBPROJECT = 2;
    case GROUP = 3;
    case HOUSE = 4;
    case STAGE = 5;
}
