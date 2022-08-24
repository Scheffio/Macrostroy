<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="180x180" href="../auth/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../auth/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../auth/favicon-16x16.png">
    <link rel="manifest" href="../auth/site.webmanifest">
    <link rel="mask-icon" href="../auth/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#00aba9">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="style.css">
    <title>Estimin - Главная</title>
    <?php require __DIR__ . "/../../../inc/timur/header-styles.php" ?>
</head>

<body class="body">
    <!-- HEADER -->
    <?php require __DIR__ . "/../../../inc/timur/header.php" ?>
    <!-- ================= -->
    <div class="wrap">
        <div class="title">
            <p>История действий</p>
            <a href="../MAIN_PAGE/" class="back">Назад</a>
        </div>
        <div class="content">
            <div class="users">
                <div class="search-bar">
                    <div class="search-bar__input-wrap">
                        <input type="text" placeholder="Введите имя пользователя">
                    </div>
                </div>
                <div class="users__list">
                    
                </div>
            </div>
            <div class="permissions">
                <div class="permission">
                    <div class="permission__checkbox">
                        <div class="all">
                            <input type="radio" name="access-radio" id="public">
                            <label for="public">Все разрешения</label>
                        </div>
                    </div>
                    <p class="permission__description">Пользователь с таким разрешением имеет доступ ко всем CRUD -
                        опциям.</p>
                </div>
                <div class="underline"></div>
                <div class="permission">
                    <div class="permission__checkbox">
                        <div class="watch">
                            <input type="radio" name="access-radio" id="watch">
                            <label for="watch">Просмотр</label>
                        </div>
                    </div>
                    <p class="permission__description">Пользователь с таким разрешением имеет доступ к просмотру этого
                        раздела.</p>
                </div>
            </div>
        </div>
    </div>

    <script src="../../static/js/main.js"></script>
    <script src="js/script.js"></script>
</body>

</html>