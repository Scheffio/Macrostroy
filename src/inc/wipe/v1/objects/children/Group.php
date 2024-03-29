<?php
namespace wipe\inc\v1\objects\children;

use ext\DB;
use ext\ObjGroup as ExtObjGroup;
use Propel\Runtime\Exception\PropelException;
use wipe\inc\v1\objects\exception\IncorrectStatusException;
use wipe\inc\v1\objects\exception\NoFindObjectException;
use wipe\inc\v1\objects\interface\iObject;
use wipe\inc\v1\objects\Objects;
use wipe\inc\v1\role\project_role\exception\IncorrectLvlException;

class Group extends Objects implements iObject
{
    /** @var int|null Уровень доступа. */
    protected ?int $lvlInt = 3;

    /** @var int|null ID подпроекта. */
    private ?int $subprojectId = null;

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
     * Заполнение свойств класса, используя ID группы.
     * @return void
     * @throws IncorrectLvlException
     * @throws NoFindObjectException
     */
    public function applyById(): void
    {
        if ($this->object === null) {
            $this->object = $this->getObjByIdOrThrow();
            $this->object = DB::getExtObjGroup($this->object);
            $this->applyByObj();
        }
    }
    #endregion

    #region Getter And Setter Default Values Functions
    /** @return int|null ID подпроекта. */
    public function getSubprojectId(): ?int
    {
        return $this->subprojectId;
    }

    /**
     * Получить объект подпроекта, которому принадлежит группа.
     * @return Subproject
     * @throws IncorrectLvlException
     * @throws NoFindObjectException
     */
    public function getSubprojectObj(): Subproject
    {
        return $this->subprojectId ? parent::getSubproject($this->subprojectId) : throw new NoFindObjectException();
    }

    /**
     * Присваивание свойству класса ID подпроекта.
     * @param int|null $id ID подпроекта.
     * @return Group
     */
    public function setSubprojectId(?int $id):  Group
    {
        if ($id !== null && $this->subprojectId !== $id) {
            $this->subprojectId = $id;
        }

        return $this;
    }

    /**
     * @param ExtObjGroup|null $obj Объект группы.
     * @return Group
     */
    public function setObj(?ExtObjGroup $obj = null): Group
    {
        if ($obj !== null && $this->object->getId() !== $obj->getId()) {
            $this->object = $obj;
        }

        return $this;
    }

    /**
     * Присваивает свойтву класса объект группы и заполняет остальные значения.
     * @param ExtObjGroup $obj Объект группы.
     * @return Group
     * @throws NoFindObjectException
     */
    public function setObjAndApply(ExtObjGroup $obj): Group
    {
        $this->setObj($obj)->applyByObj();

        return $this;
    }
    #endregion

    #region CRUD functions
    /**
     * Создать группы.
     * @return Group
     * @throws PropelException
     */
    public function add(): Group
    {
        $this->object = new ExtObjGroup();
        $this->setUpdateObjByCurrentValues();
        $this->object->setSubprojectId($this->subprojectId);
        $this->object->save();

        return $this;
    }

    /**
     * Редактирование группы.
     * @return Group
     * @throws IncorrectLvlException
     * @throws NoFindObjectException
     * @throws PropelException
     */
    public function update(): Group
    {
        $this->object = $this->getObjByIdOrThrow();
        $this->object = DB::getExtObjGroup($this->object);
        $this->updateByObj();

        return $this;
    }

    /**
     * Редактирование группы по объекту.
     * @return Group
     * @throws NoFindObjectException
     * @throws PropelException
     */
    public function updateByObj(): Group
    {
        if ($this->object === null) throw new NoFindObjectException();

        $this->setUpdateObjByCurrentValues();

        if ($this->subprojectId) {
            $this->object->setSubprojectId($this->subprojectId);
        }

        $this->object->save();

        return $this;
    }

    /**
     * Удаление группы.
     * @return Group
     * @throws IncorrectLvlException
     * @throws NoFindObjectException
     * @throws PropelException
     * @throws IncorrectStatusException
     */
    public function delete(): Group
    {
        $this->object = $this->getObjByIdOrThrow();
        $this->object = DB::getExtObjGroup($this->object);
        $this->deleteByObj();

        return $this;
    }

    /**
     * Удаление группы по объекту.
     * @return Group
     * @throws IncorrectStatusException
     * @throws NoFindObjectException
     * @throws PropelException
     */
    public function deleteByObj(): Group
    {
        if ($this->object === null) throw new NoFindObjectException();

        $this->setStatus($this::ATTRIBUTE_STATUS_DELETED)->updateByObj();

        return $this;
    }
    #endregion
}