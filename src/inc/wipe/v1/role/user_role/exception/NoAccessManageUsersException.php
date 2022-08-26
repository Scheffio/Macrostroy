<?php
namespace wipe\inc\v1\role\user_role\exception;

class NoAccessManageUsersException extends \Exception
{
    protected $message = 'No access to manage users';
}