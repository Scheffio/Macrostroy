<?php
namespace ext;

use DB\Base\UsersQuery;
use InvalidArgumentException;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

class UserRole extends \DB\UserRole
{
    /**
     * @throws PropelException
     */
    public function preDelete(?ConnectionInterface $con = null): bool
    {
        $users = UsersQuery::create()->findByRoleId($this->id);

        foreach ($users as $user) {
            $user->setRoleId(1)->save();
        }

        return true;
    }
}