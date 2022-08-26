<?php
namespace wipe\inc\v1\objects;

use DB\Base\Groups as BaseGroup;
use DB\Base\Project as BaseProject;
use DB\Base\Subproject as BaseSubproject;

class Objects
{
    protected ?int $id = null;
    protected ?string $name = null;
    protected ?string $status = null;
    protected ?bool $is_available = null;

    protected function applyByObj(BaseProject|BaseSubproject|BaseGroup| &$obj): void
    {

    }
}