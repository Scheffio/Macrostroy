<?php
$request = new \inc\artemy\v1\request\Request();
$request->checkRequestVariablesStrictOrError("selector", "token", "password");
