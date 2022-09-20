<?php

namespace wipe\inc\v1\objects\exception;

class NoAccessEditStatusException extends \Exception
{
    protected $message = 'No access to edit status';
}