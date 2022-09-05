<?php
namespace wipe\inc\v1\objects\children;

use ext\DB;
use ext\ObjSubproject as ExtObjSubproject;
use Propel\Runtime\Exception\PropelException;
use wipe\inc\v1\objects\exception\IncorrectStatusException;
use wipe\inc\v1\objects\exception\NoFindObjectException;
use wipe\inc\v1\objects\interface\iObject;
use wipe\inc\v1\objects\Objects;
use wipe\inc\v1\role\project_role\exception\IncorrectLvlException;
use wipe\inc\v1\role\project_role\exception\NoProjectFoundException;

class Subproject extends Objects implements iObject
{
    /** @var int|null Уровень доступа. */
    protected ?int $lvl = 2;

    /** @var int|null ID проекта. */
    private ?int $projectId = null;

    /**
     * @param int|null $id ID подпроекта.
     * @throws IncorrectLvlException
     * @throws NoFindObjectException
     */
    function __construct(?int $id = null)
    {
        $this->setId($id);

        if ($id === null) $this->applyByDefaultValues();
        else $this->applyDefaultValuesById();
    }

    #region Apply Default Values Functions
    /**
     * Заполнение свойств класса, используя ID подпроекта.
     * @return void
     * @throws IncorrectLvlException
     * @throws NoFindObjectException
     */
    public function applyDefaultValuesById(): void
    {
        if ($this->object === null) {
            $this->object = $this->getObjByLvlAndIdOrThrow();
            $this->object = DB::getExtObjSubproject($this->object);
            $this->applyDefaultValuesByObj();
        }
    }
    #endregion

    #region Getter And Setter Default Values Functions
    /** @return int|null ID проекта. */
    public function getProjectId(): ?int
    {
        return $this->projectId;
    }

    /**
     * Присваивание свойству класса ID проекта.
     * @param int|null $id ID проекта.
     * @return Subproject
     */
    public function setProjectId(?int $id): Subproject
    {
        if ($id !== null && $this->projectId !== $id) {
            $this->projectId = $id;
        }

        return $this;
    }

    /**
     * @param ExtObjSubproject|null $obj Объект подпроекта.
     * @param bool $flag Необходимо ли обновлять свойства класса в соответсвие с знаениями объекта.
     * @return Subproject
     */
    public function setObj(?ExtObjSubproject $obj = null, bool $flag = false): Subproject
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
     * Создать подпроект.
     * @return Subproject
     * @throws PropelException
     */
    public function add(): Subproject
    {
        $this->object = new ExtObjSubproject();
        $this->setUpdateObjByCurrentValues();
        $this->object->setProjectId($this->projectId);
        $this->object->save();

        return $this;
    }

    /**
     * Редактирование подпроекта.
     * @return Subproject
     * @throws IncorrectLvlException
     * @throws NoProjectFoundException
     * @throws PropelException
     * @throws NoFindObjectException
     */
    public function update(): Subproject
    {
        $this->object = $this->getObjByLvlAndIdOrThrow();
        $this->object = DB::getExtObjSubproject($this->object);
        $this->updateByObj();

        return $this;
    }

    /**
     * Редактирование подпроекта по объекту.
     * @return Subproject
     * @throws NoFindObjectException
     * @throws PropelException
     */
    public function updateByObj(): Subproject
    {
        if ($this->object === null) throw new NoFindObjectException();

        $this->setUpdateObjByCurrentValues();

        if ($this->projectId) {
            $this->object->setProjectId($this->projectId);
        }

        $this->object->save();

        return $this;
    }

    /**
     * Удаление подпроекта.
     * @return Subproject
     * @throws IncorrectLvlException
     * @throws NoFindObjectException
     * @throws NoProjectFoundException
     * @throws PropelException
     * @throws IncorrectStatusException
     */
    public function delete(): Subproject
    {
        $this->object = $this->getObjByLvlAndIdOrThrow();
        $this->object = DB::getExtObjSubproject($this->object);
        $this->deleteByObj();

        return $this;
    }

    /**
     * Удаление подпроекта по объекту.
     * @return Subproject
     * @throws IncorrectStatusException
     * @throws NoFindObjectException
     * @throws PropelException
     */
    public function deleteByObj(): Subproject
    {
        if ($this->object === null) throw new NoFindObjectException();

        $this->setStatus($this::ATTRIBUTE_STATUS_DELETED)->updateByObj();

        return $this;
    }
    #endregion
}