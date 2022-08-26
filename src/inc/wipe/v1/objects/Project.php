<?php
namespace wipe\inc\v1\objects;

use DB\Base\ProjectQuery;
use wipe\inc\v1\objects\exception\NoFindObjectException;
use wipe\inc\v1\objects\Objects;
use wipe\inc\v1\objects\interface\ObjectInterface;
use DB\Base\Project as BaseProject;

class Project extends Objects implements ObjectInterface
{
    private ?BaseProject $projectObj = null;

    function __construct()
    {

    }

    #region Apply Default Values Functions
    /**
     * Заполнение свойств класса по умолчанию.
     * @return void
     */
    protected function applyByDefaultValues(): void
    {
        $this->status = $this::ATTRIBUTE_STATUS_IN_PROCESS;
        $this->is_available = $this::ATTRIBUTE_IS_AVAILABLE_OPEN_ACCESS;
    }

    /**
     * Заполнение свойств класса, используя объект.
     * @param BaseProject|BaseSubproject|BaseGroup|BaseHouse|BaseStage $obj
     * @return void
     */
    protected function applyDefaultValuesByObj(BaseProject|BaseSubproject|BaseGroup|BaseHouse|BaseStage &$obj): void
    {
        $this->name = $obj->getName();
        $this->status = $obj->getStatus();
        $this->is_available = $obj->getIsAvailable();
    }
    #endregion
    /**
     * Заполнение свойств класса, используя ID проекта.
     * @throws NoFindObjectException
     */
    public function applyDefaultValuesById(): void
    {
        $this->projectObj = ProjectQuery::create()->findPk($this->id)
                            ?? throw new NoFindObjectException();
        $this->applyDefaultValuesByObj($this->projectObj);
    }

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

    public function add(): Project
    {
        return $this;
    }

    public function update(): Project
    {
        return $this;
    }

    public function delete(): Project
    {
        return $this;
    }

    public function search(): Project
    {
        return $this;
    }

    public function select(): Project
    {
        return $this;
    }
}

