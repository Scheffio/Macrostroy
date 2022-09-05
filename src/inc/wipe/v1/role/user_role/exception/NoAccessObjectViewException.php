<?php
namespace wipe\inc\v1\role\user_role\exception;

class NoAccessObjectViewException extends \Exception
{
    protected $message = 'No access to object view';
}