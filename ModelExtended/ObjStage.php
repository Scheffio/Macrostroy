<?php
namespace ext;

use inc\artemy\v1\auth\Auth;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

class ObjStage extends \DB\ObjStage
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

        if ($this->status === 'deleted') {
            $this->setVersionComment('delete');
            $this->setIsPublic(false);
            $this->setIsAvailable(false);
            DB::deleteStageChildren($this->getId());
        } else $this->setVersionComment('update');

        return true;
    }
}