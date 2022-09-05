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
use wipe\inc\v1\role\project_role\exception\NoProjectFoundException;

class Project extends Objects implements iObject
{
    /** @var int|null Уровень доступа. */
    protected ?int $lvl = 1;

    /**
     * @param int|null $id ID проекта.
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
     * Заполнение свойств класса, используя ID проекта.
     * @return void
     * @throws IncorrectLvlException
     * @throws NoProjectFoundException
     */
    public function applyDefaultValuesById(): void
    {
        if ($this->object === null) {
            $this->object = $this->getObjByLvlAndIdOrThrow();
            $this->object = DB::getExtObjProject($this->object);
            $this->applyDefaultValuesByObj();
        }
    }
    #endregion

    #region Setter Functions
    /**
     * @param ExtObjProject|null $obj Объект проекта.
     * @param bool $flag Необходимо ли обновлять свойства класса в соответсвие с знаениями объекта.
     * @return Project
     */
    public function setObj(?ExtObjProject $obj = null, bool $flag = false): Project
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
     * @throws NoProjectFoundException
     * @throws PropelException
     */
    public function update(): Project
    {
        $this->object = $this->getObjByLvlAndIdOrThrow();
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
     * @throws NoProjectFoundException
     * @throws PropelException
     * @throws IncorrectStatusException
     */
    public function delete(): Project
    {
        $this->object = $this->getObjByLvlAndIdOrThrow();
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