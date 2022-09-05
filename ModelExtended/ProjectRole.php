<?php

namespace ext;

use Exception;
use Propel\Runtime\Connection\ConnectionInterface;
use wipe\inc\v1\role\user_role\UserRole;

class ProjectRole extends \DB\ProjectRole
{
    /**
     * @throws Exception
     */
    public function preInsert(?ConnectionInterface $con = null): bool
    {
        if (UserRole::getByUserId($this->user_id)->isManageUsers()) {
            throw new Exception('Unable to edit administrator access');
        }

        return true;
    }
}