<?php

namespace wipe\inc\v1\role\project_role\exception;

class NoAccessCopyDeletedObjectException extends \Exception
{
    protected $message = 'No access to copy a deleted object';
}