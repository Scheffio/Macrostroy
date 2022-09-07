<?php
namespace wipe\inc\v1\role\user_role\exception;

class NoAccessManageVolumesException extends \Exception
{
    protected $message = 'No access to manage volumes';
}