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
    <title>Estimin - История</title>
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
        <div class="grid">
            <div class="grid__header">
                <div class="header__element">
                    <div class="sorter">
                        <img src="../../static/icons/sorter/sorter-default.svg" alt="Кнопка сортировки по убыванию">
                        <img src="../../static/icons/sorter/sorter-default.svg" alt="Кнопка сортировки по возрастанию">
                    </div>
                    <p>Название</p>
                </div>
                <div class="header__element">
                    <div class="sorter">
                        <img src="../../static/icons/sorter/sorter-default.svg" alt="Кнопка сортировки по убыванию">
                        <img src="../../static/icons/sorter/sorter-default.svg" alt="Кнопка сортировки по возрастанию">
                    </div>
                    <p>Дата</p>
                </div>
                <div class="header__element">
                    <div class="sorter">
                        <img src="../../static/icons/sorter/sorter-default.svg" alt="Кнопка сортировки по убыванию">
                        <img src="../../static/icons/sorter/sorter-default.svg" alt="Кнопка сортировки по возрастанию">
                    </div>
                    <p>Имя пользователя</p>
                </div>
                <div class="header__element">
                    <div class="sorter">
                        <img src="../../static/icons/sorter/sorter-default.svg" alt="Кнопка сортировки по убыванию">
                        <img src="../../static/icons/sorter/sorter-default.svg" alt="Кнопка сортировки по возрастанию">
                    </div>
                    <p>Старое значение</p>
                </div>
                <div class="header__element">
                    <div class="sorter">
                        <img src="../../static/icons/sorter/sorter-default.svg" alt="Кнопка сортировки по убыванию">
                        <img src="../../static/icons/sorter/sorter-default.svg" alt="Кнопка сортировки по возрастанию">
                    </div>
                    <p>Новое значение</p>
                </div>
                <div class="blank"></div>
            </div>
            <div class="grid__body">

            </div>
        </div>
        <p class="history-duration-alert">Срок существования действия в истории - 3 месяца</p>
    </div>

    <script src="../../static/js/main.js"></script> 
    <script src="js/script.js"></script>
</body>

</html>