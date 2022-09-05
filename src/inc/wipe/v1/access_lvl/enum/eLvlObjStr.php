<?php
namespace wipe\inc\v1\access_lvl\enum;

enum eLvlObjStr: string
{
    case PROJECT = 'project';
    case SUBPROJECT = 'subproject';
    case GROUP = 'group';
    case HOUSE = 'house';
    case STAGE = 'stage';
}
