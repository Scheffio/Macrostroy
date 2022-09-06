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

class House extends Objects implements iObject
{
    /** @var int|null Уровень доступа. */
    protected ?int $lvl = 4;

    /** @var int|null ID подпроекта. */
    private ?int $groupId = null;

    /**
     * @param int|null $id ID группы.
     * @throws IncorrectLvlException
     * @throws NoFindObjectException
     */
    function __construct(?int $id = null)
    {
        $this->setId($id);

        if ($id === null) $this->applyDefault();
        else $this->applyById();
    }

    #region Apply Default Values Functions
    /**
     * Заполнение свойств класса, используя ID дома.
     * @return void
     * @throws IncorrectLvlException
     * @throws NoFindObjectException
     */
    public function applyById(): void
    {
        if ($this->object === null) {
            $this->object = $this->getObjByIdOrThrow();
            $this->object = DB::getExtObjHouse($this->object);
            $this->applyByObj();
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
     * Получить объект группы, которой принадлежит дом.
     * @return Group
     * @throws IncorrectLvlException
     * @throws NoFindObjectException
     */
    public function getGroupObj(): Group
    {
        return $this->groupId ? parent::getGroup($this->groupId) : throw new NoFindObjectException();
    }

    /**
     * @param ExtObjHouse|null $obj Объект группы.
     * @return House
     */
    public function setObj(?ExtObjHouse $obj = null): House
    {
        if ($obj !== null && $this->object->getId() !== $obj->getId()) {
            $this->object = $obj;
        }

        return $this;
    }

    /**
     * Присваивает свойтву класса объект группы и заполняет остальные значения.
     * @param ExtObjHouse $obj Объект группы.
     * @return House
     * @throws NoFindObjectException
     */
    public function setObjAndApply(ExtObjHouse $obj): House
    {
        $this->setObj($obj)->applyByObj();

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
     * @throws NoFindObjectException
     * @throws PropelException
     */
    public function update(): House
    {
        $this->object = $this->getObjByIdOrThrow();
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
     * @throws PropelException
     * @throws IncorrectStatusException
     */
    public function delete(): House
    {
        $this->object = $this->getObjByIdOrThrow();
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