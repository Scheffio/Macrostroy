<?php
namespace wipe\inc\v1\role\project_role\exception;

class NoAccessCrudException extends \Exception
{
    protected $message = 'No access to CRUD the object';
}