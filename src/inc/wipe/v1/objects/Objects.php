<?php
namespace wipe\inc\v1\objects;

use DB\Base\Project as BaseProject;

class Objects
{
    protected ?int $id = null;
    protected ?string $name = null;
    protected ?string $status = null;
    protected ?bool $is_available = null;

    protected function applyByObj(BaseProject&$obj): void
    {

    }
}