<?php

namespace wipe\inc\v1\role\project_role\exception;

class NoAccessCopyObjectException extends \Exception
{
    protected $message = 'No access to copy a deleted object';
}