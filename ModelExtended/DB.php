<?php

namespace ext;

use DB\Base\ProjectRoleQuery;
use InvalidArgumentException;
use DB\Base\UserRole as BaseUserRole;
use DB\Base\ProjectRole as BaseProjectRole;
use DB\Base\ObjProject as BaseObjProject;
use DB\Base\ObjSubproject as BaseObjSubproject;
use DB\Base\ObjGroup as BaseObjGroup;
use DB\Base\ObjHouse as BaseObjHouse;
use DB\Base\ObjStage as BaseObjStage;
use DB\Base\VolWork as BaseVolWork;
use DB\Base\VolTechnic as BaseVolTechnic;
use DB\Base\VolMaterial as BaseVolMaterial;

class DB
{
    public static function cast(object $object, string $class)
    {
        if (!class_exists($class)) {
            throw new InvalidArgumentException(sprintf('Unknown class: %s.', $class));
        }

        if (!is_subclass_of($class, get_class($object))) {
            throw new InvalidArgumentException(sprintf(
                '%s is not a descendant of $object class: %s.',
                $class, get_class($object)
            ));
        }
        return unserialize(
            preg_replace(
                '/^O:\d+:"[^"]++"/',
                'O:'.strlen($class).':"'.$class.'"',
                serialize($object)
            )
        );
    }

    #region ExtRole
    public static function getExtUserRole(BaseUserRole $obj): UserRole
    {
        return self::cast($obj, UserRole::class);
    }

    public static function getExtProjectRole(BaseProjectRole $obj): ProjectRole
    {
        return self::cast($obj, ProjectRole::class);
    }
    #endregion

    #region ExtObj
    public static function getExtObjProject(BaseObjProject $obj): ObjProject
    {
        return self::cast($obj, ObjProject::class);
    }

    public static function getExtObjSubproject(BaseObjSubproject $obj): ObjSubproject
    {
        return self::cast($obj, ObjSubproject::class);
    }

    public static function getExtObjGroup(BaseObjGroup $obj): ObjGroup
    {
        return self::cast($obj, ObjGroup::class);
    }

    public static function getExtObjHouse(BaseObjHouse $obj): ObjHouse
    {
        return self::cast($obj, ObjHouse::class);
    }

    public static function getExtObjStage(BaseObjStage $obj): ObjStage
    {
        return self::cast($obj, ObjStage::class);
    }

    public static function deleteProjectChildren(int $id): void
    {
        $i = ProjectRoleQuery::create()->filterByProjectId($id)->find();

        foreach ($i as &$item) {
            $item = self::getExtObjSubproject($item);
            $item->setStatus()
        }
    }
    #endregion

    #region ExtVol
    public static function getExtVolMaterial(BaseVolMaterial $obj): VolMaterial
    {
        return self::cast($obj, VolMaterial::class);
    }

    public static function getExtVolTechnic(BaseVolTechnic $obj): VolTechnic
    {
        return self::cast($obj, VolTechnic::class);
    }

    public static function getExtVolWork(BaseVolWork $obj): VolWork
    {
        return self::cast($obj, VolWork::class);
    }
    #endregion
}