<?php

namespace wipe\inc\v1\objects\children;

use ext\DB;
use ext\ObjHouse as ExtObjHouse;
use Propel\Runtime\Exception\PropelException;
use wipe\inc\v1\objects\exception\IncorrectStatusException;
use wipe\inc\v1\objects\exception\NoFindObjectException;
use wipe\inc\v1\objects\interface\iObject;
use wipe\inc\v1\objects\Objects;
use wipe\inc\v1\role\project_role\exception\IncorrectLvlException;
use wipe\inc\v1\role\project_role\exception\NoProjectFoundException;

class House extends Objects implements iObject
{
    /** @var int|null Уровень доступа. */
    protected ?int $lvl = 4;

    /** @var int|null ID подпроекта. */
    private ?int $groupId = null;

    /**
     * @param int|null $id ID группы.
     * @throws IncorrectLvlException
     * @throws NoProjectFoundException
     */
    function __construct(?int $id = null)
    {
        $this->setId($id);

        if ($id === null) $this->applyByDefaultValues();
        else $this->applyDefaultValuesById();
    }

    #region Apply Default Values Functions
    /**
     * Заполнение свойств класса, используя ID дома.
     * @return void
     * @throws IncorrectLvlException
     * @throws NoProjectFoundException
     */
    public function applyDefaultValuesById(): void
    {
        if ($this->object === null) {
            $this->object = $this->getObjByLvlAndIdOrThrow();
            $this->object = DB::getExtObjHouse($this->object);
            $this->applyDefaultValuesByObj();
        }
    }
    #endregion

    #region Getter And Setter Default Values Functions
    /** @return int|null ID группы. */
    public function getGroupId(): ?int
    {
        return $this->groupId;
    }

    /**
     * Присваивание свойству класса ID группы.
     * @param int|null $id ID группы.
     * @return House
     */
    public function setGroupId(?int $id): House
    {
        if ($id !== null && $this->groupId !== $id) {
            $this->groupId = $id;
        }

        return $this;
    }

    /**
     * @param ExtObjHouse|null $obj Объект группы.
     * @param bool $flag Необходимо ли обновлять свойства класса в соответсвие с знаениями объекта.
     * @return House
     */
    public function setObj(?ExtObjHouse $obj = null, bool $flag = false): House
    {
        if ($obj !== null && $this->object->getId() !== $obj->getId()) {
            $this->object = $obj;

            if ($flag) {
                $this->applyDefaultValuesByObj();
            }
        }

        return $this;
    }
    #endregion

    #region CRUD functions
    /**
     * Создать дома.
     * @return House
     * @throws PropelException
     */
    public function add(): House
    {
        $this->object = new ExtObjHouse();
        $this->setUpdateObjByCurrentValues();
        $this->object->setGroupId($this->groupId);
        $this->object->save();

        return $this;
    }

    /**
     * Редактирование дома.
     * @return House
     * @throws IncorrectLvlException
     * @throws NoProjectFoundException
     * @throws PropelException
     * @throws NoFindObjectException
     */
    public function update(): House
    {
        $this->object = $this->getObjByLvlAndIdOrThrow();
        $this->object = DB::getExtObjHouse($this->object);
        $this->updateByObj();

        return $this;
    }

    /**
     * Редактирование дома по объекту.
     * @return House
     * @throws NoFindObjectException
     * @throws PropelException
     */
    public function updateByObj(): House
    {
        if ($this->object === null) throw new NoFindObjectException();

        $this->setUpdateObjByCurrentValues();

        if ($this->groupId) {
            $this->object->setGroupId($this->groupId);
        }

        $this->object->save();

        return $this;
    }

    /**
     * Удаление дома.
     * @return House
     * @throws IncorrectLvlException
     * @throws NoFindObjectException
     * @throws NoProjectFoundException
     * @throws PropelException
     * @throws IncorrectStatusException
     */
    public function delete(): House
    {
        $this->object = $this->getObjByLvlAndIdOrThrow();
        $this->object = DB::getExtObjHouse($this->object);
        $this->deleteByObj();

        return $this;
    }

    /**
     * Удаление дома по объекту.
     * @return House
     * @throws IncorrectStatusException
     * @throws NoFindObjectException
     * @throws PropelException
     */
    public function deleteByObj(): House
    {
        if ($this->object === null) throw new NoFindObjectException();

        $this->setStatus($this::ATTRIBUTE_STATUS_DELETED)->updateByObj();

        return $this;
    }
    #endregion
}