<?php
namespace wipe\inc\v1\role\user_role\exception;

class NoUserFoundException extends \Exception
{
    protected $message = 'No user found';
}