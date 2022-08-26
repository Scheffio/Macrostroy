<?php
namespace wipe\inc\v1\objects\projects;

use DB\Base\ProjectQuery;
use wipe\inc\v1\objects\exception\NoFindObjectException;
use wipe\inc\v1\objects\Objects;
use wipe\inc\v1\objects\interface\ObjectInterface;
use DB\Base\Project as BaseProject;

class Project extends Objects implements ObjectInterface
{
    private ?BaseProject $projectObj = null;

    /**
     * Заполнение свойств класса, используя ID роли.
     * @throws NoFindObjectException
     */
    public function applyDefaultValuesById(): void
    {
        $this->projectObj = ProjectQuery::create()->findPk($this->id)
                            ?? throw new NoFindObjectException();
        $this->applyDefaultValuesByObj();
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

