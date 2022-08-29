<?php
namespace wipe\inc\v1\objects;

use DB\Base\ProjectQuery;
use DB\Base\SubprojectQuery;
use DB\Map\ProjectTableMap;
use Propel\Runtime\Exception\PropelException;
use wipe\inc\v1\objects\exception\IncorrectStatusException;
use wipe\inc\v1\objects\exception\NoFindObjectException;
use \DB\Project AS DbProject;
use DB\Base\Subproject as BaseSubproject;
use wipe\inc\v1\objects\interface\iObject;
use wipe\inc\v1\role\project_role\exception\NoProjectFoundException;

class Subproject extends Objects implements iObject
{
    private ?int $projectId = null;
    private ?Project $projectObj = null;
    private ?BaseSubproject $subprojectObj = null;

    /**
     * @param int|null $projectId ID проекта.
     * @param int|null $subprojectId ID подпроекта.
     * @throws NoFindObjectException
     */
    function __construct(?int $projectId = null, ?int $subprojectId = null)
    {
        if ($subprojectId) {
            $this->setId($subprojectId);
            $this->applyDefaultValuesById();
        } elseif ($projectId) {
            $this->projectId = $projectId;
            $this->applyDefaultValuesByProjectId();
        }
    }
    #region Apply Default Values Functions
    /**
     * Получить объект класса через статический метод, используя ID проекта.
     * @return void
     * @throws NoFindObjectException
     */
    public function applyDefaultValuesByProjectId(): void
    {
        if ($this->projectObj === null) {
            $this->projectObj = new Project($this->projectId);
        }
    }

    /**
     * Получить объект класса через статический метод, используя ID подпроекта.
     * Заполнение свойств класса, используя ID проекта.
     * @throws NoFindObjectException
     */
    public function applyDefaultValuesById(): void
    {
        if ($this->subprojectObj === null) {
            $this->subprojectObj =  SubprojectQuery::create()->findPk($this->id)
                                    ?? throw new NoFindObjectException();
            $this->applyDefaultValuesByObj($this->subprojectObj);
        }
    }
    #endregion

    #region Getter Default Values Functions
    /** @return BaseSubproject|null Объект подпроекта. */
    public function getSubprojectObj(): ?BaseSubproject
    {
        return $this->subprojectObj;
    }

    /** @return int|null ID проекта. */
    public function getProjectId(): ?int
    {
        return $this->projectId;
    }

    /** @return Project|null Объект пректа. */
    public function getProjectObj(): ?Project
    {
        return $this->projectObj;
    }
    #endregion

    #region Setter Default Values Functions
    /**
     * Присваивание свойству класса объект подпроекта.
     * И заполняется остальны свойства в соответсвие с значениями переданного объекта.
     * @param BaseSubproject|null $subprojectObj Объект подпроекта.
     * @return Subproject
     */
    public function setSubprojectObj(?BaseSubproject $subprojectObj): Subproject
    {
        if ($subprojectObj !== null &&
            $this->subprojectObj->getId() === $subprojectObj->getId()) {
            return $this;
        }

        $this->subprojectObj = $subprojectObj;
        $this->applyDefaultValuesByObj($this->subprojectObj);

        return $this;
    }

    
    #endregion

    #region CRUD User Role Functions
    /**
     * Создание проекта.
     * @return Project
     * @throws PropelException
     */
    public function add(): Project
    {
        $this->projectObj = new DbProject();
        $this->projectObj
            ->setName($this->name)
            ->setStatus($this->status)
            ->setIsAvailable($this->isAvailable)
            ->save();

        $this->id = $this->projectObj->getId();

        return $this;
    }

    /**
     * Редактирование проекта.
     * @return Project
     * @throws NoProjectFoundException
     * @throws PropelException
     */
    public function update(): Project
    {
        $this->projectObj = $this->getSearchByIdOrThrow(ProjectQuery::create(), ProjectTableMap::COL_STATUS);
        $this->setUpdateByDefaultValues($this->projectObj);
        $this->projectObj->save();

        return $this;
    }

    /**
     * Редактирование или создание проекта.
     * @return Project
     * @throws PropelException
     */
    public function updateOrCreate(): Project
    {
        $query = $this->getFilterNoDeletedStatusQuery(ProjectQuery::create(), ProjectTableMap::COL_STATUS);
        $this->setFilterByDefaultValues($query);
        $this->projectObj = $query->findOneOrCreate();

        $this->setUpdateByDefaultValues($this->projectObj);
        $this->projectObj->save();

        return $this;
    }

    /**
     * Редактирование проекта по объекту.
     * @return Project
     * @throws NoProjectFoundException
     * @throws PropelException
     */
    public function updateByObj(): Project
    {
        if ($this->projectObj === null) throw new NoProjectFoundException();

        $this->setUpdateByDefaultValues($this->projectObj);
        $this->projectObj->save();

        return $this;
    }

    /**
     * Удаление проекта.
     * @return Project
     * @throws NoProjectFoundException
     * @throws IncorrectStatusException
     * @throws PropelException
     */
    public function delete(): Project
    {
        $this->projectObj = $this->getSearchByIdOrThrow(ProjectQuery::create(), ProjectTableMap::COL_STATUS);
        $this->setStatus($this::ATTRIBUTE_STATUS_DELETED)->updateByObj();

        return $this;
    }

    /**
     * Удаление проекта по объекту.
     * @return Project
     * @throws NoProjectFoundException
     * @throws PropelException
     * @throws IncorrectStatusException
     */
    public function deleteByObj(): Project
    {
        if ($this->projectObj === null) throw new NoProjectFoundException();

        $this->setStatus($this::ATTRIBUTE_STATUS_DELETED)->updateByObj();

        return $this;
    }
    #endregion
}

