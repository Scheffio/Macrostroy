<?php
namespace wipe\inc\v1\objects\interface;

use DB\Base\Project as BaseProject;

interface ObjectInterface {
    public function applyDefaultValuesById();

    public function add();

    public function update();

    public function updateOrCreate();

    public function updateByObj();

    public function delete();

    public function deleteByObj();
}

