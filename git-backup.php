<?php
$connection = ssh2_connect('151.248.116.95');
if ($connection === false) {
    die("Connection error");
}
ssh2_auth_password($connection, 'root', '4iM:@WEzPwJP');

$stream = ssh2_exec($connection, 'whoami');

echo stream_get_contents($stream);