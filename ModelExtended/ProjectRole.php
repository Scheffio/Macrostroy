<?php

namespace ext;

use Exception;
use inc\artemy\v1\json_output\JsonOutput;
use Propel\Runtime\Connection\ConnectionInterface;
use wipe\inc\v1\role\user_role\UserRole;

class ProjectRole extends \DB\ProjectRole
{
    /**
     * @throws Exception
     */
    public function preInsert(?ConnectionInterface $con = null): bool
    {
        JsonOutput::success([
            $this->user_id,
            UserRole::getByUserId($this->user_id)->getUserId()
        ]);
        if (UserRole::getByUserId($this->user_id)->isManageUsers()) {
            throw new Exception('Unable to edit administrator access');
        }

        return true;
    }
}