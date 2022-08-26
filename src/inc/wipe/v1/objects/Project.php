<?php
namespace wipe\inc\v1\objects;

use DB\Base\ProjectQuery;
use DB\Map\ProjectTableMap;
use Propel\Runtime\Exception\PropelException;
use wipe\inc\v1\objects\exception\NoFindObjectException;
use wipe\inc\v1\objects\interface\ObjectInterface;
use \DB\Project AS DbProject;
use DB\Base\Project as BaseProject;
use wipe\inc\v1\role\project_role\exception\NoProjectFoundException;

class Project extends Objects implements ObjectInterface
{
    private ?BaseProject $projectObj = null;

    /**
     * @param int|null $id ID проекта.
     * @throws NoFindObjectException
     */
    function __construct(?int $id = null)
    {
        $this->setId($id);

        if ($this->id !== null) {
            $this->applyDefaultValuesById();
        }
    }

    #region Apply Default Values Functions
    /**
     * Получить объект класса через статический метод, используя ID проекта.
     * Заполнение свойств класса, используя ID проекта.
     * @throws NoFindObjectException
     */
    public function applyDefaultValuesById(): void
    {
        $this->projectObj = ProjectQuery::create()->findPk($this->id)
                            ?? throw new NoFindObjectException();
        $this->applyDefaultValuesByObj($this->projectObj);
    }
    #endregion

    #region Getter And Setter Default Values
    /** @return BaseProject|null Объект проекта. */
    public function getProjectObj(): ?BaseProject
    {
        return $this->projectObj;
    }

    /**
     * Присваивание свойству класса объект проекта.
     * @param BaseProject|null $projectObj Объект проекта.
     * @return Project
     */
    public function setProjectObj(?BaseProject $projectObj): Project
    {
        if ($projectObj !== null &&
            $this->projectObj->getId() === $projectObj->getId()) {
            return $this;
        }

        $this->projectObj = $projectObj;

        return $this;
    }
    #endregion

    #region CRUD User Role Functions
    /**
     * @return Project
     * @throws PropelException
     */
    public function add(): Project
    {
        $this->projectObj = new DbProject();
        $this->projectObj
            ->setName($this->name)
            ->setStatus($this->status)
            ->setIsAvailable($this->is_available)
            ->save();

        $this->id = $this->projectObj->getId();

        return $this;
    }

    /**
     * @return Project
     * @throws NoProjectFoundException
     */
    public function update(): Project
    {
        $this->projectObj = ProjectQuery::create()
                                ->where(ProjectTableMap::COL_STATUS . '!=?', $this::ATTRIBUTE_STATUS_DELETED)
                                ->findPk($this->id) ??
                                throw new NoProjectFoundException();

        if ($this->name) $this->projectObj->setName($this->name);
        if ($this->status) $this->projectObj->setStatus($this->status);
        if ($this->is_available) $this->projectObj->setIsAvailable($this->is_available);

        return $this;
    }

    public function updateByObj(): Project
    {
        return $this;
    }

    public function delete(): Project
    {
        return $this;
    }

    public function deleteByObj(): Project
    {
        return $this;
    }
    #endregion
}

