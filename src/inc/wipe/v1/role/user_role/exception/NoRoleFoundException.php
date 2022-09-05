<?php
namespace wipe\inc\v1\role\user_role\exception;

class NoRoleFoundException extends \Exception
{
    protected $message = 'No role found';
}