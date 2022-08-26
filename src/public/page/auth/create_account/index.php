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
    <div class="wrap">
        <h1>Добро пожаловать.</h1>
        <h2>Для создания аккаунта к почте <?= $user->getEmail() ?>, пожалуйста, введите пароль.</h2>
        <form action="" class="form">
            <label>
                <input type="password" required class="form__input" placeholder="Введите пароль">
            </label>
            <label>
                <input type="password" required class="form__input" placeholder="Повторите пароль">
            </label>
            <input type="submit" class="login-button">
        </form>
    </div>
</body>

</html>