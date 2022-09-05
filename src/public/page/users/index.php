<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estimin - Пользователи</title>
    <?php require __DIR__ . "/../../../inc/timur/header-styles.php" ?>
</head>

<body>
    <!-- HEADER -->
    <?php require __DIR__ . "/../../../inc/timur/header.php"; ?>
    <!-- ================= -->
    <div class="wrap">
        <div class="tabs-controller">
            <div class="tabs-controller__tab-anchor">
                <a href="#users" class="tab-anchor__anchor-name selected">Пользователи</a>
            </div>
            <div class="tabs-controller__tab-anchor">
                <a href="#roles" class="tab-anchor__anchor-name">Роли</a>
            </div>
        </div>
        <div class="tabs-container">
            <div id="users" class="tabs-container__tab-element">
                <div class="tab-header">
                    <div class="search-bar">
                        <div class="search-bar__input-wrap">
                            <input type="text" placeholder="Введите имя пользователя для редактирования">
                        </div>
                    </div>
                </div>
                <p class="info">Нажмите на пользователя для редактирования.</p>
                <div class="users__list">
                </div>
            </div>
            <div id="roles" class="tabs-container__tab-element">
                <div class="grid">
                    <div class="grid__header">
                        <div class="header__element">
                            <div class="sorter">
                                <img src="../../static/icons/sorter/sorter-default.svg"
                                    alt="Кнопка сортировки по убыванию">
                                <img src="../../static/icons/sorter/sorter-default.svg"
                                    alt="Кнопка сортировки по возрастанию">
                            </div>
                            <p>Название</p>
                        </div>
                        <div class="header__element">
                            <div class="sorter">
                                <img src="../../static/icons/sorter/sorter-default.svg"
                                    alt="Кнопка сортировки по убыванию">
                                <img src="../../static/icons/sorter/sorter-default.svg"
                                    alt="Кнопка сортировки по возрастанию">
                            </div>
                            <p>Статус</p>
                        </div>
                        <div class="header__element">
                            <div class="sorter">
                                <img src="../../static/icons/sorter/sorter-default.svg"
                                    alt="Кнопка сортировки по убыванию">
                                <img src="../../static/icons/sorter/sorter-default.svg"
                                    alt="Кнопка сортировки по возрастанию">
                            </div>
                            <p>Доступ</p>
                        </div>
                        <div class="header__element">
                            <div class="sorter">
                                <img src="../../static/icons/sorter/sorter-default.svg"
                                    alt="Кнопка сортировки по убыванию">
                                <img src="../../static/icons/sorter/sorter-default.svg"
                                    alt="Кнопка сортировки по возрастанию">
                            </div>
                            <p>Последнее изменение</p>
                        </div>
                        <div class="header__element">
                            <div class="sorter">
                                <img src="../../static/icons/sorter/sorter-default.svg"
                                    alt="Кнопка сортировки по убыванию">
                                <img src="../../static/icons/sorter/sorter-default.svg"
                                    alt="Кнопка сортировки по возрастанию">
                            </div>
                            <p>Общая стоимость</p>
                        </div>
                    </div>
                    <div class="grid__body">

                    </div>
                </div>
            </div>
        </div>
        <div class="add-project">
            <button class="add-project__button" onclick="modalSystem.show('add')"><span class="add"></span>Добавить</button>
        </div>
    </div>
    <div class="modal">
        <div class="modal-wrap">
            <div class="add-user">
                <div class="modal-header">
                    <p>Добавить пользователя</p>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer"></div>
            </div>
            <div class="delete-user">
                <div class="modal-header">
                    <p>Удаление пользователя</p>
                </div>
                <div class="modal-body">
                    <p>Вы действительно хотите удалить пользователя «<span class="username-span"></span>»</p>
                    <p>Предупреждаем, это действие не возможно отменить!</p>
                </div>
                <div class="modal-footer">
                    <button onclick="">Удалить</button>
                    <button onclick="modalSystem.hide()">Отмена</button>
                </div>
            </div>
            <div class="info-user">
                <div class="modal-header">
                    <p>Информация о «<span class="username-span"></span>»</p>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer"></div>
            </div>
            <div class="edit-user">
                <div class="modal-header">
                    <p>Редактирование пользователя «<span class="username-span"></span>»</p>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>
    <script src="../../static/js/main.js"></script>
    <script src="js/script.js"></script>
</body>

</html>