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
                <div class="content">
                    <div class="users">
                        <div class="search-bar">
                            <div class="search-bar__input-wrap">
                                <input type="text" placeholder="Введите имя пользователя">
                            </div>
                        </div>
                        <div class="users__list roles">
                        </div>
                    </div>
                    <div class="permissions">
                        <div class="permission">
                            <div class="permission__checkbox">
                                <div class="all">
                                    <input type="radio" name="access-radio" id="all">
                                    <label for="all">Все разрешения</label>
                                </div>
                            </div>
                            <p class="permission__description">Пользователь с таким разрешением имеет доступ ко всем
                                CRUD -
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
                            <p class="permission__description">Пользователь с таким разрешением имеет доступ к просмотру
                                этого
                                раздела.</p>
                        </div>
                        <p class="admin-alert">Этот пользователь является администратором, Вы не можете редактировать
                            его разрешения.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="add-project">
            <button class="add-project__button" onclick="modalSystem.show('add')"><span
                    class="add"></span>Добавить</button>
        </div>
    </div>
    <div class="modal">
        <div class="modal-wrap">
            <div class="add-user">
                <span onclick="modalSystem.hide()"></span>
                <div class="modal-header">
                    <p>Добавить пользователя</p>
                </div>
                <div class="modal-body">
                    <div class="modal-body__name">
                        <input type="text">
                    </div>
                    <div class="modal-body__email">
                        <input type="email">
                    </div>
                    <div class="modal-body__role">
                        <select>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button onclick="addUser()">Добавить</button>
                </div>
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