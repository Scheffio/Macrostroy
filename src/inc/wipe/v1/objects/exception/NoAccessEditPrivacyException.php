<?php

namespace wipe\inc\v1\objects\exception;

class NoAccessEditPrivacyException extends \Exception
{
    protected $message = 'No access to edit privacy';
}