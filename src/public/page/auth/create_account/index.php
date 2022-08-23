<?php
if (empty($_GET["selector"]) or empty($_GET["token"])) header("Location: /");
$user = \DB\UsersRememberedQuery::create()->select("id")->findOneByArray(['selector' => $_GET["selector"], 'token' =>
    $_GET["token"]]);
var_dump($user);
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>Создание аккаунта для почты $email$</h1>
<form action="">
    <label>
        <input type="password" required>
    </label>
    <label>
        <input type="password" required>
    </label>
</form>
</body>
</html>