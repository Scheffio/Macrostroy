<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
    <link rel="manifest" href="site.webmanifest">
    <link rel="mask-icon" href="safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#00aba9">
    <meta name="theme-color" content="#ffffff">
    <script defer src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Estimin</title>
</head>

<body>
<div class="wrap">
    <div class="logos">
        <img src="../../static/auth/logos/logo.svg" alt="Логотип-иконка">
        <img src="../../static/auth/logos/text-logo.svg" alt="Логотип текстовый">
    </div>
    <div class="title">
        <p>Авторизация</p>
    </div>
    <form class="form">
        <label>
            <input type="email" class="form__input login" placeholder="Введите почту">
        </label>
        <label>
            <input type="password" class="form__input pass" placeholder="Введите пароль">
        </label>
        <div class="action-buttons">
            <button class="action-buttons__login-button">Войти</button>
            <a href="reset_password/send_email_confirmation/index.php" class="action-buttons__forget-password-button">Забыли пароль?</a>
        </div>
    </form>
</div>
<div class="pop_up">
    <div class="pop_up__body">
        <div class="pop_up__title">
            <h1>Внимание</h1>
            <h2>Произошла ошибка!</h2>
        </div>
        <div class="pop_up__text">
            <ol class="pop_up__ol">
            </ol>
        </div>
    </div>
</div>
</body>

</html>