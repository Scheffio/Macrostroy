<?php
if (empty($_GET["selector"]) or empty($_GET["token"])) header("Location: /auth");
$user = \DB\UsersConfirmationsQuery::create()->findOneBySelector($_GET["selector"]);
if ($user === null) header("Location: /auth");
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Estimin</title>
</head>
<body>
<h1>Добро пожаловать.</h1>
<h1>Создание аккаунта для почты <?= $user->getEmail() ?></h1>
<form action="">
    <label>
        пароль:
        <input type="password" required>
    </label>
    <br>
    <label>
        повторить пароль:
        <input type="password" required>
    </label>
    <br>
    <input type="submit">
</form>
</body>
</html>