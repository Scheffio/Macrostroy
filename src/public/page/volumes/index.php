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
    <?php require __DIR__ . "/../../../inc/timur/header-styles.php" ?>
    <title>Estimin - Главная</title>
</head>

<body class="body">
    <!-- HEADER -->
    <?php require __DIR__ . "/../../../inc/timur/header.php" ?>
    <!-- ================= -->
    <div class="wrap">
        <div class="tabs-controller">
            <div class="tabs-controller__tab-anchor">
                <a href="#works" class="tab-anchor__anchor-name selected">Работы</a>
            </div>
            <div class="tabs-controller__tab-anchor">
                <a href="#materials" class="tab-anchor__anchor-name">Материалы</a>
            </div>
            <div class="tabs-controller__tab-anchor">
                <a href="#technics" class="tab-anchor__anchor-name">Техника</a>
            </div>
            <div class="tabs-controller__tab-anchor">
                <a href="#units" class="tab-anchor__anchor-name">Единицы измерения</a>
            </div>
        </div>
        <div class="tabs-container">
            <div id="works" class="tabs-container__tab-element">
                
            </div>
            <div id="materials" class="tabs-container__tab-element">
                
            </div>
            <div id="technics" class="tabs-container__tab-element">
                
            </div>
            <div id="units" class="tabs-container__tab-element">
                
            </div>
        </div>
        <div class="add-project">
            <button class="add-project__button" onclick="modalSystem.showModalWindow()"><span
                    class="plus"></span>Добавить</button>
        </div>
    </div>
    <nav class="context-menu">
        <ul class="context-menu__items">
            <li class="context-menu__item open" onclick="CCM.contextMenu_open(CCM.rowInFocus)">
                <a>Открыть</a>
            </li>
            <li class="context-menu__item copy" onclick="CCM.contextMenu_copy(CCM.rowInFocus)">
                <a>Копировать</a>
            </li>
            <li class="context-menu__item disabled paste" onclick="CCM.contextMenu_paste()">
                <a>Вставить</a>
            </li>
            <li class="context-menu__item add" onclick="CCM.contextMenu_add()">
                <a>Добавить</a>
            </li>
            <li class="context-menu__item status-submenu change-status">
                <a href="#cities">Изменить статус</a>
                <ul class="status-context-sub-menu">
                    <li class="status-context-sub-menu__item"
                        onclick="CCM.contextMenu_changeStatus(this, CCM.rowInFocus)">
                        <a>В процессе</a>
                    </li>
                    <li class="status-context-sub-menu__item"
                        onclick="CCM.contextMenu_changeStatus(this, CCM.rowInFocus)">
                        <a>Завершён</a>
                    </li>
                </ul>
            </li>
            <li class="context-menu__item private" onclick="CCM.contextMenu_private(CCM.rowInFocus)">
                <a>Сделать приватным</a>
            </li>
            <li class="context-menu__item access-control" onclick="CCM.contextMenu_accessControl(CCM.rowInFocus)">
                <a href="../access-control">Управление доступом</a>
            </li>
            <li class="context-menu__item make-estimate">
                <a>Сформировать смету</a>
            </li>
            <li class="context-menu__item about">
                <a href="../action-history">История действий</a>
            </li>
            <li class="context-menu__item delete" onclick="CCM.contextMenu_delete(CCM.rowInFocus)">
                <a>Удалить</a>
            </li>
        </ul>
    </nav>
    <div class="modal">
        <div class="modal-wrap">
            <span onclick="modalSystem.hideModalWindow()"></span>
            <div class="modal-header">
                <p class="title">Добавить проект</p>
            </div>
            <div class="modal-body">
                <form>
                    <div class="modal-body__name">
                        <input type="text">
                    </div>
                    <div class="modal-body__status">
                        <select>
                            <option value="В процессе">В процессе</option>
                            <option value="Завершён">Завершён</option>
                        </select>
                    </div>
                    <div class="modal-body__access">
                        <label for="access">Доступ</label>
                        <div class="checkboxes">
                            <div class="public">
                                <input type="radio" name="access-radio" id="public">
                                <label for="public">Открытый</label>
                            </div>
                            <div class="private">
                                <input type="radio" name="access-radio" id="private">
                                <label for="private">Публичный</label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button>Добавить</button>
            </div>
        </div>
    </div>
    <script src="../../static/js/main.js"></script>
    <script src="js/script.js"></script>
</body>

</html>