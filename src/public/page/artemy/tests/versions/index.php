<?php
$unit = \DB\UnitQuery::create()->findOneById(14);
$ver = $unit->getOneVersion(3);
var_dump($ver->getName());

var_dump($ver->getVersion());