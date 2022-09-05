<?php
namespace wipe\inc\v1\objects\exception;

class ObjectIsDeletedException extends \Exception
{
    protected $message = 'Object is deleted';
}