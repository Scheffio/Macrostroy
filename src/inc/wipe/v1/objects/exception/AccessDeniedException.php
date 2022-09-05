<?php
namespace wipe\inc\v1\objects\exception;

class AccessDeniedException extends \Exception
{
    protected $message = 'Access denied';
}