<?php
namespace wipe\inc\v1\role\user_role\exception;

class NoAccessManageHistoryException extends \Exception
{
    protected $message = 'No access to manage history';
}