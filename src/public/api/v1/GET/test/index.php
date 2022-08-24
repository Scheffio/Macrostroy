<?php

$user = \DB\Base\UsersQuery::create()->findPk(1);
$user->setRoleId(1);
$user->save();

echo "YES!";