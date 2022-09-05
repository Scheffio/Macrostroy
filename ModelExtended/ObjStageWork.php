<?php
namespace ext;

use inc\artemy\v1\auth\Auth;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

class ObjStageWork extends \DB\ObjStageWork
{
    public function preInsert(?ConnectionInterface $con = null): bool
    {
        $this->setVersionCreatedBy(Auth::getUser()->id());
        $this->setVersionComment('insert');

        return true;
    }

    /**
     * @param ConnectionInterface|null $con
     * @return bool
     * @throws PropelException
     */
    public function preUpdate(?ConnectionInterface $con = null): bool
    {
        $this->setVersionCreatedBy(Auth::getUser()->id());

        if ($this->is_available === true) $this->setVersionComment('update');
        else {
            $this->setVersionComment('delete');
            $this->setIsAvailable(false);
            DB::deleteChildStageMaterials($this->getId());
            DB::deleteChildStageTechnics($this->getId());
        }

        return true;
    }
}