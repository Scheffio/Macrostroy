<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script defer src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="change_password/scss/style.css">
    <title>Estimin</title>
</head>

<body>
    <div class="wrap">
        <div class="logos">
            <img src="../../../../static/auth/logos/logo.svg" alt="Логотип-иконка">
            <img src="../../../../static/auth/logos/text-logo.svg" alt="Логотип текстовый">
        </div>
        <div class="title">
            <p>Смена пароля</p>
        </div>
        <div class="subtitle">
            <p>Пожалуйста, введите новый пароль.</p>
        </div>
        <form class="form">
            <label>
                <input type="password" class="form__input login" placeholder="Введите новый пароль">
            </label>
            <label>
                <input type="password" class="form__input pass" placeholder="Повторите новый пароль">
            </label>
            <div class="action-buttons">
                <button class="action-buttons__login-button">Сохранить</button>
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
    <script src="js/script.js"></script>
</body>

</html>