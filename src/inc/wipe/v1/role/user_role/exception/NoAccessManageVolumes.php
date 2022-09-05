<?php
namespace wipe\inc\v1\role\user_role\exception;

class NoAccessManageVolumes extends \Exception
{
    protected $message = 'No access to manage volumes';
}