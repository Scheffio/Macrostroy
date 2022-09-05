<?php
namespace wipe\inc\v1\role\user_role\exception;

class NoAccessManageObjectsException extends \Exception
{
    protected $message = 'No access to manage objects';
}