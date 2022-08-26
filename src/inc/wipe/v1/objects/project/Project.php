<?php
namespace wipe\inc\v1\objects\projects;

use wipe\inc\v1\objects\interface\ObjectInterface;

class Project implements ObjectInterface
{
    private $projectObj = null;

    /**
     * @return null
     */
    public function getProjectObj()
    {
        return $this->projectObj;
    }

    /**
     * @param null $projectObj
     */
    public function setProjectObj($projectObj): void
    {
        $this->projectObj = $projectObj;
    }



    public function add(): Project
    {
        return $this;
    }

    public function update()
    {

    }

    public function delete()
    {

    }

    public function search()
    {

    }

    public function select()
    {

    }
}

