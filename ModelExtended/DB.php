<?php

namespace ext;

use DB\Base\ObjGroupQuery;
use DB\Base\ObjHouseQuery;
use DB\Base\ObjStageMaterialQuery;
use DB\Base\ObjStageQuery;
use DB\Base\ObjStageTechnicQuery;
use DB\Base\ObjStageWorkQuery;
use DB\Base\ObjSubprojectQuery;

use DB\UserRole as DbUserRole;
use DB\ProjectRole as DbProjectRole;
use DB\ObjProject as DbObjProject;
use DB\ObjSubproject as DbObjSubproject;
use DB\ObjGroup as DbObjGroup;
use DB\ObjHouse as DbObjHouse;
use DB\ObjStage as DbObjStage;
use DB\ObjStageWork as DbObjStageWork;
use DB\ObjStageMaterial as DbObjStageMaterial;
use DB\ObjStageTechnic as DbObjStageTechnic;
use DB\VolWork as DbVolWork;
use DB\VolTechnic as DbVolTechnic;
use DB\VolMaterial as DbVolMaterial;

use DB\Base\UserRole as BaseUserRole;
use DB\Base\ProjectRole as BaseProjectRole;
use DB\Base\ObjProject as BaseObjProject;
use DB\Base\ObjSubproject as BaseObjSubproject;
use DB\Base\ObjGroup as BaseObjGroup;
use DB\Base\ObjHouse as BaseObjHouse;
use DB\Base\ObjStage as BaseObjStage;
use DB\Base\ObjStageWork as BaseObjStageWork;
use DB\Base\ObjStageMaterial as BaseObjStageMaterial;
use DB\Base\ObjStageTechnic as BaseObjStageTechnic;
use DB\Base\VolWork as BaseVolWork;
use DB\Base\VolTechnic as BaseVolTechnic;
use DB\Base\VolMaterial as BaseVolMaterial;

use wipe\inc\v1\objects\Objects;
use InvalidArgumentException;
use Propel\Runtime\Exception\PropelException;

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

    #region getExtRole
    public static function getExtUserRole(BaseUserRole|DbUserRole $obj): UserRole
    {
        return self::cast($obj, UserRole::class);
    }

    public static function getExtProjectRole(BaseProjectRole|DbProjectRole $obj): ProjectRole
    {
        return self::cast($obj, ProjectRole::class);
    }
    #endregion

    #region getExtObj
    public static function getExtObjProject(BaseObjProject|DbObjProject $obj): ObjProject
    {
        return self::cast($obj, ObjProject::class);
    }

    public static function getExtObjSubproject(BaseObjSubproject|DbObjSubproject $obj): ObjSubproject
    {
        return self::cast($obj, ObjSubproject::class);
    }

    public static function getExtObjGroup(BaseObjGroup|DbObjGroup $obj): ObjGroup
    {
        return self::cast($obj, ObjGroup::class);
    }

    public static function getExtObjHouse(BaseObjHouse|DbObjHouse $obj): ObjHouse
    {
        return self::cast($obj, ObjHouse::class);
    }

    public static function getExtObjStage(BaseObjStage|DbObjStage $obj): ObjStage
    {
        return self::cast($obj, ObjStage::class);
    }

    public static function getExtObjStageWork(BaseObjStageWork|DbObjStageWork $obj): ObjStageWork
    {
        return self::cast($obj, ObjStageWork::class);
    }

    public static function getExtObjStageMaterial(BaseObjStageMaterial|DbObjStageMaterial $obj): ObjStageMaterial
    {
        return self::cast($obj, ObjStageMaterial::class);
    }

    public static function getExtObjStageTechnic(BaseObjStageTechnic|DbObjStageTechnic $obj): ObjStageTechnic
    {
        return self::cast($obj, ObjStageTechnic::class);
    }
    #endregion

    #region deleteExtObj
    /**
     * Удаление дочерних элементов проекта.
     * @param int $id ID проекта.
     * @return void
     * @throws PropelException
     */
    public static function deleteProjectChildren(int $id): void
    {
        $i = ObjSubprojectQuery::create()->filterByProjectId($id)->find();

        foreach ($i as &$item) {
            $item = self::getExtObjSubproject($item);
            $item->setStatus(Objects::ATTRIBUTE_STATUS_DELETED)->save();
        }
    }

    /**
     * Удаление дочерних элементов подпроекта.
     * @param int $id ID подпроекта.
     * @return void
     * @throws PropelException
     */
    public static function deleteSubprojectChildren(int $id): void
    {
        $i = ObjGroupQuery::create()->filterBySubprojectId($id)->find();

        foreach ($i as &$item) {
            $item = self::getExtObjGroup($item);
            $item->setStatus(Objects::ATTRIBUTE_STATUS_DELETED)->save();
        }
    }

    /**
     * Удаление дочерних элементов группы.
     * @param int $id ID группы.
     * @return void
     * @throws PropelException
     */
    public static function deleteGroupChildren(int $id): void
    {
        $i = ObjHouseQuery::create()->filterByGroupId($id)->find();

        foreach ($i as &$item) {
            $item = self::getExtObjHouse($item);
            $item->setStatus(Objects::ATTRIBUTE_STATUS_DELETED)->save();
        }
    }

    /**
     * Удаление дочерних элементов дома.
     * @param int $id ID дома.
     * @return void
     * @throws PropelException
     */
    public static function deleteHouseChildren(int $id): void
    {
        $i = ObjStageQuery::create()->filterByHouseId($id)->find();

        foreach ($i as &$item) {
            $item = self::getExtObjStage($item);
            $item->setStatus(Objects::ATTRIBUTE_STATUS_DELETED)->save();
        }
    }

    /**
     * Удаление дочерних элементов этапа.
     * @param int $id ID этапа.
     * @return void
     * @throws PropelException
     */
    public static function deleteStageChildren(int $id): void
    {
        $i = ObjStageWorkQuery::create()->findByStageId($id);

        foreach ($i as &$item) {
            $item = self::getExtObjStageWork($item);
            $item->setIsAvailable(false)->save();
        }
    }

    /**
     * Удаление дочерних элементов работы этапа (материалы).
     * @param int $id ID работы этапа.
     * @return void
     * @throws PropelException
     */
    public static function deleteChildStageMaterials(int $id): void
    {
        $i = ObjStageMaterialQuery::create()->findByStageWorkId($id);

        foreach ($i as &$item) {
            $item = self::getExtObjStageMaterial($item);
            $item->setIsAvailable(false)->save();
        }
    }

    /**
     * Удаление дочерних элементов работы этапа (техника).
     * @param int $id ID работы этапа.
     * @return void
     * @throws PropelException
     */
    public static function deleteChildStageTechnics(int $id): void
    {
        $i = ObjStageTechnicQuery::create()->findByStageWorkId($id);

        foreach ($i as &$item) {
            $item = self::getExtObjStageTechnic($item);
            $item->setIsAvailable(false)->save();
        }
    }
    #endregion

    #region getExtVol
    public static function getExtVolMaterial(BaseVolMaterial|DbVolMaterial $obj): VolMaterial
    {
        return self::cast($obj, VolMaterial::class);
    }

    public static function getExtVolTechnic(BaseVolTechnic|DbVolTechnic $obj): VolTechnic
    {
        return self::cast($obj, VolTechnic::class);
    }

    public static function getExtVolWork(BaseVolWork|DbVolWork $obj): VolWork
    {
        return self::cast($obj, VolWork::class);
    }
    #endregion
}