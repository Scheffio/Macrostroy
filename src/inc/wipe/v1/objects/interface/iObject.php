<?php
namespace wipe\inc\v1\objects\interface;

interface iObject {
    public function applyById();

    public function add();

    public function update();

    public function updateByObj();

    public function delete();

    public function deleteByObj();
}

