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
                                <div class="admin">
                                    <input type="radio" class="uncheckable" name="access-radio" id="all">
                                    <label for="all">Администратор</label>
                                </div>
                            </div>
                            <p class="permission__description">Пользователь с таким параметром имеет доступ ко всему
                                функционалу. А также создавать и редактировать учётные записи пользователей.
                            </p>
                        </div>
                        <div class="underline"></div>
                        <div class="permission">
                            <div class="permission__checkbox">
                                <div class="object-crud">
                                    <div class="object-crud-checkboxes">
                                        <input type="radio" name="object-crud-radio" id="object-crud">
                                        <input type="radio" name="object-crud-radio" id="object-crud">
                                        <div class="checkbox-titles">
                                            <span>Все</span>
                                            <span>Отдельно</span>
                                        </div>
                                        <label for="object-crud">CRUD объектов</label>
                                    </div>
                                </div>
                            </div>
                            <p class="permission__description">Возможность создавать, редактировать, удалять, копировать
                                объекты.</p>
                        </div>
                        <div class="permission">
                            <div class="permission__checkbox">
                                <div class="volume-crud">
                                    <div class="volume-crud-checkboxes">
                                        <input type="radio" name="volume-crud-radio" id="volume-crud">
                                        <input type="radio" name="volume-crud-radio" id="volume-crud">
                                        <div class="checkbox-titles">
                                            <span>Все</span>
                                            <span>Отдельно</span>
                                        </div>
                                        <label for="volume-crud">CRUD объёмов</label>
                                    </div>
                                </div>
                            </div>
                            <p class="permission__description">Возможность создавать, редактировать, удалять, копировать
                                работы, материалы, технику в объемах. Так же, импортировать их из формата xls,
                                формировать графики изменения цен.</p>
                        </div>
                        <div class="permission">
                            <div class="permission__checkbox">
                                <div class="version-control">
                                    <input type="radio" class="uncheckable" name="version-control-radio" id="version-control">
                                    <label for="version-control">Управление версиями</label>
                                </div>
                            </div>
                            <p class="permission__description">Возможность возвращать содержание объектов к предыдущим
                                версиям.</p>
                        </div>
                        <div class="permission">
                            <div class="permission__checkbox">
                                <div class="watch">
                                    <input type="checkbox" onclick="rolesControl.saveRolePermissions('watch', this)" class="uncheckable" name="watch-radio" id="watch">
                                    <label for="watch">Просмотр объектов</label>
                                </div>
                            </div>
                            <p class="permission__description">Возможность просматривать объекты, и формировать сметы по
                                ним.</p>
                        </div>
                        <p class="explanation">*Отдельно - для каждого объекта можно дать доступ отдельному
                            пользователю. Это редактируется внутри настроект объекта.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="actions">
            <div class="add-role">
                <button class="add-role__button" onclick="modalSystem.show('add')"><span
                        class="add"></span>Добавить</button>
            </div>
            <div class="delete-role">
                <button class="delete-role__button" onclick="modalSystem.show('delete')"><span
                        class="delete"></span>Удалить</button>
            </div>
        </div>
    </div>
    <div class="no-access-window">
        <p>К сожалению, у вас нет доступа к этой странице. Попробуйте запросить доступ у Администратора.</p>
        <a href="/">На главную</a>
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
            <div class="save-role">
                <div class="modal-header">
                    Сохранение
                </div>
                <div class="modal-body">
                    У вас есть не сохранённые изменения. Желаете сохранить изменения и продолжить?
                </div>
                <div class="modal-footer">
                    <button>Отмена</button>
                    <button>Сохранить</button>
                </div>
            </div>
            <div class="add-role">
                <div class="modal-header"></div>
                <div class="modal-body"></div>
                <div class="modal-footer"></div>
            </div>
            <div class="delete-role">
                <div class="modal-header"></div>
                <div class="modal-body"></div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>
    <script src="../../static/js/main.js"></script>
    <script src="js/script.js"></script>
</body>

</html>