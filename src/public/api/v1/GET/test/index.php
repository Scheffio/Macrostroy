<?php

try {
    $unit = new \DB\Unit();
    $unit->setName('kg')->save();
} catch (\Propel\Runtime\Exception\PropelException $e) {
    \inc\artemy\v1\json_output\JsonOutput::error([$e->getMessage(), $e->getLine()]);
}

echo "Unit id:" . $unit->getId() . " 💩 " . "\n";

try {
    $material = new \DB\Material();
    $material
        ->setName('block')
        ->setPrice('1000.00')
        ->setUnitId( $unit->getId() )
        ->save();
} catch (\Propel\Runtime\Exception\PropelException $e) {
    \inc\artemy\v1\json_output\JsonOutput::error([$e->getMessage(), $e->getLine()]);
}


//die( json_encode(\inc\artemy\v1\auth\Auth::getUserOrThrow()->getEmail() ) );

//use DB\Unit;
//use Propel\Runtime\Exception\PropelException;

//$unit = new Unit();
//\inc\artemy\v1\auth\Auth::getUserOrThrow()->id();
//$unit = \DB\Base\UnitQuery::create()->findPk(1);
//echo 'ID:' . $unit->getId();

//try {
//    $unit
//        ->setName('unit-test2')
//        ->save();
//    echo "
//    Version: {$unit->getVersion()} 💩
//    Create by: {$unit->getVersionCreatedAt()->format('Y-m-d H:i:s')} 💩
//    User id: 💩
//    ";
//
//    $unit
//        ->setName('unit-test2')
//        ->save();
//
//    echo "
//    Version: {$unit->getVersion()} 💩
//    Create by: {$unit->getVersionCreatedAt()->format('Y-m-d H:i:s')} 💩
//    User id: 💩
//    ";
//} catch (PropelException $e) {
//    echo "\n\n" . $e->getMessage() . " 🤬";
//}
//
//echo "\n\nKill all man 😇";
//die();