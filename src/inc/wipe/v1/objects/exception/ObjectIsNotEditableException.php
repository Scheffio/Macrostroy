<?php
namespace wipe\inc\v1\objects\exception;

class ObjectIsNotEditableException extends \Exception
{
    protected $message = 'Object is not editable';
}