<?php
namespace wipe\inc\v1\objects\children;

use ext\DB;
use ext\ObjStage as ExtObjStage;
use Propel\Runtime\Exception\PropelException;
use wipe\inc\v1\objects\exception\IncorrectStatusException;
use wipe\inc\v1\objects\exception\NoFindObjectException;
use wipe\inc\v1\objects\interface\iObject;
use wipe\inc\v1\objects\Objects;
use wipe\inc\v1\role\project_role\exception\IncorrectLvlException;

class Stage extends Objects implements iObject
{
    /** @var int|null Уровень доступа. */
    protected ?int $lvlInt = 5;

    /** @var int|null ID подпроекта. */
    private ?int $houseId = null;

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
            $this->object = DB::getExtObjStage($this->object);
            $this->applyByObj();
        }
    }
    #endregion

    #region Getter And Setter Default Values Functions
    /** @return int|null ID группы. */
    public function getHouseId(): ?int
    {
        return $this->houseId;
    }

    /**
     * Получить объект дома, которому принадлежит этапа.
     * @return House
     * @throws IncorrectLvlException
     * @throws NoFindObjectException
     */
    public function getGroupObj(): House
    {
        return $this->houseId ? parent::getHouse($this->houseId) : throw new NoFindObjectException();
    }

    /**
     * Присваивание свойству класса ID дома.
     * @param int|null $id ID дома.
     * @return Stage
     */
    public function setHouseId(?int $id): Stage
    {
        if ($id !== null && $this->houseId !== $id) {
            $this->houseId = $id;
        }

        return $this;
    }

    /**
     * @param ExtObjStage|null $obj Объект группы.
     * @return Stage
     */
    public function setObj(?ExtObjStage $obj = null): Stage
    {
        if ($obj !== null && $this->object->getId() !== $obj->getId()) {
            $this->object = $obj;
        }

        return $this;
    }

    /**
     * Присваивает свойтву класса объект этапа и заполняет остальные значения.
     * @param ExtObjStage $obj Объект группы.
     * @return Stage
     * @throws NoFindObjectException
     */
    public function setObjAndApply(ExtObjStage $obj): Stage
    {
        $this->setObj($obj)->applyByObj();

        return $this;
    }
    #endregion

    #region CRUD functions
    /**
     * Создать этапа.
     * @return Stage
     * @throws PropelException
     */
    public function add(): Stage
    {
        $this->object = new ExtObjStage();
        $this->setUpdateObjByCurrentValues();
        $this->object->setHouseId($this->houseId);
        $this->object->save();

        return $this;
    }

    /**
     * Редактирование этапа.
     * @return Stage
     * @throws IncorrectLvlException
     * @throws NoFindObjectException
     * @throws PropelException
     */
    public function update(): Stage
    {
        $this->object = $this->getObjByIdOrThrow();
        $this->object = DB::getExtObjStage($this->object);
        $this->updateByObj();

        return $this;
    }

    /**
     * Редактирование этапа по объекту.
     * @return Stage
     * @throws NoFindObjectException
     * @throws PropelException
     */
    public function updateByObj(): Stage
    {
        if ($this->object === null) throw new NoFindObjectException();

        $this->setUpdateObjByCurrentValues();

        if ($this->houseId) {
            $this->object->setHouseId($this->houseId);
        }

        $this->object->save();

        return $this;
    }

    /**
     * Удаление этапа.
     * @return Stage
     * @throws IncorrectLvlException
     * @throws NoFindObjectException
     * @throws PropelException
     * @throws IncorrectStatusException
     */
    public function delete(): Stage
    {
        $this->object = $this->getObjByIdOrThrow();
        $this->object = DB::getExtObjStage($this->object);
        $this->deleteByObj();

        return $this;
    }

    /**
     * Удаление этапа по объекту.
     * @return Stage
     * @throws IncorrectStatusException
     * @throws NoFindObjectException
     * @throws PropelException
     */
    public function deleteByObj(): Stage
    {
        if ($this->object === null) throw new NoFindObjectException();

        $this->setStatus($this::ATTRIBUTE_STATUS_DELETED)->updateByObj();

        return $this;
    }
    #endregion
}