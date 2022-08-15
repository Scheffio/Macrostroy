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
    <title>Estimin - Главная</title>
    <?php require __DIR__ . "/../../../inc/timur/header-styles.php" ?>
</head>

<body>
    <!-- HEADER -->
    <?php require __DIR__ . "/../../../inc/timur/header.php"; ?>
    <!-- ================= -->
    <div class="wrap">
        <div class="tabs-controller">
            <div class="tabs-controller__tab-anchor">
                <a href="#1-tab-element" class="tab-anchor__anchor-name selected">ЖК</a>
            </div>
            <div class="tabs-controller__tab-anchor">
                <a href="#2-tab-element" class="tab-anchor__anchor-name">Города</a>
            </div>
            <div class="tabs-controller__tab-anchor">
                <a href="#3-tab-element" class="tab-anchor__anchor-name">Дома</a>
            </div>
            <div class="tabs-controller__tab-anchor">
                <a href="#4-tab-element" class="tab-anchor__anchor-name">Этапы</a>
            </div>
        </div>
        <div class="tabs-container">
            <div id="1-tab-element" class="tabs_container__tab-element">
                <div class="tab-header">
                    <div class="tab-header__element">
                        <div class="sorter">
                            <img src="../../static/sorter_icons/sorter-default.svg" alt="Кнопка сортировки по убыванию">
                            <img src="../../static/sorter_icons/sorter-default.svg" alt="Кнопка сортировки по возрастанию">
                        </div>
                        <p>Название</p>
                    </div>
                    <div class="tab-header__element">
                        <div class="sorter">
                            <img src="../../static/sorter_icons/sorter-default.svg" alt="Кнопка сортировки по убыванию">
                            <img src="../../static/sorter_icons/sorter-default.svg" alt="Кнопка сортировки по возрастанию">
                        </div>
                        <p>Статус</p>
                    </div>
                    <div class="tab-header__element">
                        <div class="sorter">
                            <img src="../../static/sorter_icons/sorter-default.svg" alt="Кнопка сортировки по убыванию">
                            <img src="../../static/sorter_icons/sorter-default.svg" alt="Кнопка сортировки по возрастанию">
                        </div>
                        <p>Доступ</p>
                    </div>
                    <div class="tab-header__element">
                        <div class="sorter">
                            <img src="../../static/sorter_icons/sorter-default.svg" alt="Кнопка сортировки по убыванию">
                            <img src="../../static/sorter_icons/sorter-default.svg" alt="Кнопка сортировки по возрастанию">
                        </div>
                        <p>Последнее изменение</p>
                    </div>
                    <div class="tab-header__element">
                        <div class="sorter">
                            <img src="../../static/sorter_icons/sorter-default.svg" alt="Кнопка сортировки по убыванию">
                            <img src="../../static/sorter_icons/sorter-default.svg" alt="Кнопка сортировки по возрастанию">
                        </div>
                        <p>Общая стоимость</p>
                    </div>
                </div>
            </div>
            <div id="2-tab-element" class="tabs_container__tab-element">
                <p>test2</p>
            </div>
            <div id="3-tab-element" class="tabs_container__tab-element">
                <p>test 3</p>
            </div>
            <div id="4-tab-element" class="tabs_container__tab-element">
                <p>test 4</p>
            </div>
        </div>
    </div>
    <script src="js/script.js"></script>
</body>

</html>