<?php
namespace wipe\inc\v1\objects\children;

use ext\DB;
use ext\ObjProject as ExtObjProject;
use Propel\Runtime\Exception\PropelException;
use wipe\inc\v1\objects\exception\IncorrectStatusException;
use wipe\inc\v1\objects\exception\NoFindObjectException;
use wipe\inc\v1\objects\interface\iObject;
use wipe\inc\v1\objects\Objects;
use wipe\inc\v1\role\project_role\exception\IncorrectLvlException;

class Project extends Objects implements iObject
{
    /** @var int|null Уровень доступа. */
    protected ?int $lvlInt = 1;

    /**
     * @param int|null $id ID проекта.
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
     * Заполнение свойств класса, используя ID проекта.
     * @return void
     * @throws IncorrectLvlException
     * @throws NoFindObjectException
     */
    public function applyById(): void
    {
        if ($this->object === null) {
            $this->object = $this->getObjByIdOrThrow();
            $this->object = DB::getExtObjProject($this->object);
            $this->applyByObj();
        }
    }
    #endregion

    #region Setter Functions
    /**
     * @param ExtObjProject|null $obj Объект проекта.
     * @return Project
     */
    public function setObj(?ExtObjProject $obj = null): Project
    {
        if ($obj !== null && $this->object->getId() !== $obj->getId()) {
            $this->object = $obj;
        }

        return $this;
    }

    /**
     * Присваивает свойтву класса объект проекта и заполняет остальные значения.
     * @param ExtObjProject $obj Объект проекта.
     * @return $this
     * @throws NoFindObjectException
     */
    public function setObjAndApply(ExtObjProject $obj): Project
    {
        $this->setObj($obj)->applyByObj();

        return $this;
    }
    #endregion

    #region CRUD functions
    /**
     * Создать проект.
     * @return Project
     * @throws PropelException
     */
    public function add(): Project
    {
        $this->object = new ExtObjProject();
        $this->setUpdateObjByCurrentValues();
        $this->object->save();

        return $this;
    }

    /**
     * Редактирование проекта.
     * @return Project
     * @throws IncorrectLvlException
     * @throws NoFindObjectException
     * @throws PropelException
     */
    public function update(): Project
    {
        $this->object = $this->getObjByIdOrThrow();
        $this->object = DB::getExtObjProject($this->object);
        $this->updateByObj();

        return $this;
    }

    /**
     * Редактирование проекта по объекту.
     * @return Project
     * @throws NoFindObjectException
     * @throws PropelException
     */
    public function updateByObj(): Project
    {
        if ($this->object === null) throw new NoFindObjectException();

        $this->setUpdateObjByCurrentValues();
        $this->object->save();

        return $this;
    }

    /**
     * Удаление проекта.
     * @return Project
     * @throws IncorrectLvlException
     * @throws NoFindObjectException
     * @throws PropelException
     * @throws IncorrectStatusException
     */
    public function delete(): Project
    {
        $this->object = $this->getObjByIdOrThrow();
        $this->object = DB::getExtObjProject($this->object);
        $this->deleteByObj();

        return $this;
    }

    /**
     * Удаление проекта по объекту.
     * @return Project
     * @throws IncorrectStatusException
     * @throws NoFindObjectException
     * @throws PropelException
     */
    public function deleteByObj(): Project
    {
        if ($this->object === null) throw new NoFindObjectException();

        $this->setStatus($this::ATTRIBUTE_STATUS_DELETED)->updateByObj();

        return $this;
    }
    #endregion
}