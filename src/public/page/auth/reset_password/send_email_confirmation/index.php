<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="scss/style.css">
    <title>Estimin</title>
</head>

<body>
    <div class="wrap">
        <div class="logos">
            <img src="../../../../static/auth/logos/logo.svg" alt="Логотип-иконка">
            <img src="../../../../static/auth/logos/text-logo.svg" alt="Логотип текстовый">
        </div>
        <div class="title">
            <p>Восстановление пароля</p>
            <p>Успешно!</p>
            <div class="subtitle">
                <p>Для того, чтобы восстановить пароль, пожалуйста, введите почту и перейдите по ссылке, отправленной Вам в сообщении.</p>
                <p>На вашу почту было отправленно сообщение с ссылкой для восстановление пароля. Пожалуйста, пройдите по ссылке и измените свой пароль.</p>
            </div>
        </div>
        <form class="form">
            <input type="email" class="form__input login" placeholder="Введите почту">
            <div class="action-buttons">
                <button class="action-buttons__login-button">Отправить</button>
                <a href="/auth" class="action-buttons__forget-password-button">Авторизироваться</a>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="js/script.js"></script>
</body>

</html>