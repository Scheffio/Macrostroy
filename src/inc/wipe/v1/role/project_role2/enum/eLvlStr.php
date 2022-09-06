<?php
namespace wipe\inc\v1\role\project_role\enum;

enum eLvlStr: string
{
    case PROJECT = 'project';
    case SUBPROJECT = 'subproject';
    case GROUP = 'group';
    case HOUSE = 'house';
    case STAGE = 'stage';
}
