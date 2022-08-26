<?php
namespace wipe\inc\v1\objects\interface;

interface ObjectInterface {
    public function add();

    public function update();

    public function delete();

    public function search();

    public function select();
}

