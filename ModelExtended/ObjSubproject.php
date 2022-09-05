<?php
namespace ext;

use inc\artemy\v1\auth\Auth;
use Propel\Runtime\Connection\ConnectionInterface;

class ObjSubproject extends \DB\ObjSubproject
{
    public function preInsert(?ConnectionInterface $con = null): bool
    {
        $this->setVersionCreatedBy(Auth::getUser()->id());
        $this->setVersionComment('insert');

        return true;
    }

    public function preUpdate(?ConnectionInterface $con = null): bool
    {
        $this->setVersionCreatedBy(Auth::getUser()->id());

        if ($this->status === 'deleted') {
            $this->setVersionComment('delete');
            $this->setIsPublic(false);
            $this->setIsAvailable(false);
        } else $this->setVersionComment('update');

        return true;
    }
}