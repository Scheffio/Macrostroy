const userGenerator = {
    createElement(element, elementClass, elementModificator, elementContent) {
        let create = document.createElement(`${element}`)
        if (elementClass != '' && elementModificator != '') {
            create.classList.add(`${elementClass}`)
            create.classList.add(`${elementModificator}`)
        } else if (elementClass != '') {
            create.classList.add(`${elementClass}`)
        }
        if (elementContent != '') {
            create.innerHTML = elementContent
        }
        return create
        // элементо-генератор
    }
}

// ==================

const userDeleteBtn = document.querySelectorAll('.users__close-btn').forEach((elem) => {
    elem.addEventListener('click', () => {
        console.log(1);
    })
})
const modal = document.querySelector('.modal')

const modalSystem = {
    modalWrap: document.querySelector('.modal-wrap'),
    addRoleWindow: document.querySelector('.modal > .modal-wrap > .add-role'),
    deleteRoleWindow: document.querySelector('.modal > .modal-wrap > .delete-role'),
    deleteUserWindow: document.querySelector('.modal > .modal-wrap > .delete-user'),
    addUserWindow: document.querySelector('.modal > .modal-wrap > .add-user'),
    editUserWindow: document.querySelector('.modal > .modal-wrap > .edit-user'),
    body: document.querySelector('body'),
    fixateBackground() {
        this.body.classList.toggle("fixated")
    },
    reset() {
        document.querySelectorAll('.modal-wrap > *').forEach((elem) => {
            elem.classList.remove('opened')
        })
        this.modalWrap.classList.remove('roles')
    },
    show(type) {
        this.reset()
        modal.classList.add('opened')
        setTimeout(() => {
            this.modalWrap.classList.add('opened')
        }, 300);
        this.fixateBackground()
        if (type == 'delete-role') {
            this.deleteRoleWindow.classList.add('opened')
            this.modalWrap.classList.add('roles')
        }
        if (type == 'add-role') {
            this.modalWrap.classList.add('roles')
            this.addRoleWindow.classList.add('opened')
        }
        if (type == 'add-user') {
            this.addUserWindow.classList.add('opened')
        }
        if (type == 'delete-user') {
            this.modalWrap.classList.add('roles')
            this.deleteUserWindow.classList.add('opened')
        }
        if (type == 'edit-user') {
            this.modalWrap.classList.add('roles')
            this.editUserWindow.classList.add('opened')
        }
    },
    hide() {
        modal.classList.toggle('closed')
        this.modalWrap.classList.toggle('closed')
        setTimeout(() => {
            modal.classList.remove('closed')
            modal.classList.remove('opened')
            this.modalWrap.classList.remove('closed')
            this.modalWrap.classList.remove('opened')
        }, 600);
        this.fixateBackground()
    }
}

modal.addEventListener('click', (e) => {
    if (e.target == modal) modalSystem.hide()
})

document.addEventListener('keydown', (e) => {
    if (e.keyCode === 27) modalSystem.hide()
})

const nameInput = document.querySelectorAll('.modal-body__name > input')
const nameField = document.querySelectorAll('.modal-body__name')

const emailInput = document.querySelectorAll('.modal-body__email > input')
const emailField = document.querySelectorAll('.modal-body__email')

const roleNameInput = document.querySelector('.modal-body__role-name > input')
const roleNameField = document.querySelector('.modal-body__role-name')


nameField.forEach((elem) => {
    elem.addEventListener('click', () => {
        elem.children[0].focus()
    })
})

emailField.forEach((elem) => {
    elem.addEventListener('click', () => {
        elem.children[0].focus()
    })
})

roleNameField.addEventListener('click', () => {
    roleNameInput.focus()
})

nameInput.forEach((elem) => {
    elem.addEventListener('focus', () => {
        elem.value != '' ? null : elem.closest('.modal-body__name').classList.toggle('focused')
    }) 
    elem.addEventListener('blur', () => {
        elem.value != '' ? null : elem.closest('.modal-body__name').classList.toggle('focused')
    })
})

emailInput.forEach((elem) => {
    elem.addEventListener('focus', () => {
        elem.value != '' ? null : elem.closest('.modal-body__email').classList.toggle('focused')
    }) 
    elem.addEventListener('blur', () => {
        elem.value != '' ? null : elem.closest('.modal-body__email').classList.toggle('focused')
    })
})


roleNameInput.addEventListener('focus', () => {
    roleNameInput.value != '' ? null : roleNameField.classList.toggle('focused')
})
roleNameInput.addEventListener('blur', () => {
    roleNameInput.value != '' ? null : roleNameField.classList.toggle('focused')
})

document.querySelectorAll('.uncheckable').forEach((elem) => {
    elem.addEventListener('dblclick', () => {
        elem.checked = false
    })
})

let url = new URL(document.location.href)
const rolesControl = {
    adminCheckbox: document.querySelector('.admin > input'),
    objectCrudAllCheckbox: document.querySelector('.object-crud-checkboxes > input:nth-child(1)'),
    objectCrudExactCheckbox: document.querySelector('.object-crud-checkboxes > input:nth-child(2)'),
    volumeCrudAllCheckbox: document.querySelector('.volume-crud-checkboxes > input:nth-child(1)'),
    volumeCrudExactCheckbox: document.querySelector('.volume-crud-checkboxes > input:nth-child(2)'),
    versionControlCheckbox: document.querySelector('.version-control > input'),
    watchobjectsCheckbox: document.querySelector('.watch > input'),
    currentRoleId: 0,
    parseRoles() {
        const select = document.querySelectorAll('.modal-body__role > select')
        fetch(`/api/v1/roles`).then((elem) => {
            return elem.json()
        }).then((json) => {
            this.clearRoles()
            json.data.forEach((roles) => {
                
                document.querySelector('.roles').appendChild(userGenerator.createElement('div', 'users__user-field', '', `<p data-id="${roles.id}">${roles.name}</p>`))
            })
            select.forEach((elem) => {
                json.data.forEach((roles) => {
                    let option = document.createElement('option')
                    option.dataset.id = roles.id
                    option.value = roles.name
                    option.textContent = roles.name
                    elem.appendChild(option)
                })
            })

            const selectableUsers = {
                roles: document.querySelectorAll('.roles > .users__user-field'),
                click(elem) {
                    this.currentRoleId = elem.children[0].dataset.id
                    this.reset()
                    elem.classList.toggle('selected')
                    parsePermissions(this.currentRoleId, elem)
                    url.searchParams.set('q', this.currentRoleId)
                },
                reset() {
                    document.querySelectorAll('.permission__checkbox > * > *').forEach((elem) => {
                        if (elem.tagName === 'INPUT') {
                            elem.checked = false
                        }
                    })
                    this.roles.forEach((elem) => {
                        elem.classList.remove('selected')
                    })
                }
            }

            selectableUsers.click(document.querySelector('.roles').children[0])

            document.querySelectorAll('.roles > .users__user-field').forEach((elem) => {
                elem.addEventListener('click', () => {
                    selectableUsers.click(elem)
                })
            })
        })
    },
    saveRolePermissions() {
        let admin_PERM, objectCrud_PERM, volumeCrud_PERM, history_PERM, watch_PERM
        this.watchobjectsCheckbox.checked ? watch_PERM = true : watch_PERM = false
        this.objectCrudAllCheckbox.checked ? objectCrud_PERM = true : objectCrud_PERM = false
        this.objectCrudExactCheckbox.checked ? objectCrud_PERM = false : objectCrud_PERM = true
        this.volumeCrudAllCheckbox.checked ? volumeCrud_PERM = true : volumeCrud_PERM = false
        this.volumeCrudExactCheckbox.checked ? volumeCrud_PERM = false : volumeCrud_PERM = true
        this.versionControlCheckbox.checked ? history_PERM = true : history_PERM = false
        this.adminCheckbox.checked ? (admin_PERM = true, objectCrud_PERM = true, volumeCrud_PERM = true, history_PERM = true, watch_PERM = true) : admin_PERM = false

        fetch(`/api/v1/role?role_id=${url.searchParams.get('q')}&object_viewer=${watch_PERM}&manage_objects=${objectCrud_PERM}&manage_volumes=${volumeCrud_PERM}&manage_history=${history_PERM}&manage_users=${admin_PERM}`, {
            method: 'PUT'
        })
    },
    deleteRole() {
        fetch(`/api/v1/role?role_id=${url.searchParams.get('q')}`, {
            method: 'DELETE'
        }).then(function (res) {
            return res.json()
        }).then(function () {
            modalSystem.hide()
            rolesControl.parseRoles()
        })
    },
    addRole() {
        // document.querySelector('.test').closest('div').previousElementSibling.children[0].children[0].value
        fetch(`/api/v1/role/add`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    role_name: document.querySelector('.role-name').value
                })
            })
            .then(function (res) {
                return res.json();
            })
            .then(function () {
                modalSystem.hide()
                rolesControl.parseRoles()
            })
    },
    clearRoles() {
        document.querySelector('.roles').innerHTML = ''
        document.querySelectorAll('.modal-body__role > select').forEach((elem) => {
            elem.innerHTML = ""
        })
    }
}

function parsePermissions(id, elem) {
    fetch(`/api/v1/role?role_id=${id}`).then((elem) => {
        return elem.json()
    }).then((json) => {
        if (json.status === "success") {
            document.querySelector('.no-access-window').classList.remove('show')
            document.querySelector('.wrap').classList.remove('no-access')
            if (elem.children[0].dataset.id == json.data.id) {
                let parameter = json.data
                if (parameter.object_viewer) {
                    rolesControl.watchobjectsCheckbox.checked = true
                }
                if (parameter.manage_history) {
                    rolesControl.versionControlCheckbox.checked = true
                }
                if (parameter.manage_objects) {
                    rolesControl.objectCrudAllCheckbox.checked = true
                    rolesControl.objectCrudExactCheckbox.checked = false
                }
                if (!parameter.manage_objects) {
                    rolesControl.objectCrudAllCheckbox.checked = false
                    rolesControl.objectCrudExactCheckbox.checked = true
                }
                if (parameter.manage_volumes) {
                    rolesControl.volumeCrudAllCheckbox.checked = true
                    rolesControl.volumeCrudExactCheckbox.checked = false
                }
                if (!parameter.manage_volumes) {
                    rolesControl.volumeCrudAllCheckbox.checked = false
                    rolesControl.volumeCrudExactCheckbox.checked = true
                }
                if (parameter.object_viewer && parameter.manage_history && parameter.manage_objects && parameter.manage_volumes && parameter.manage_users) {
                    rolesControl.adminCheckbox.checked = true
                }
            }
        } else {
            if (json.error_message == 'Недостаточно прав') {
                document.querySelector('.no-access-window').classList.add('show')
                document.querySelector('.wrap').classList.add('no-access')
            }
        }
    })
}

const userControl = {
    usersList: document.querySelector('.users__list'),
    addUser() {
        const username = document.querySelector(".modal-body__name > input")
        const email = document.querySelector('.modal-body__email > input')
        const select = document.querySelector('.modal-body__role > select')

        fetch("/api/v1/admin/create_account", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    user_email: email.value,
                    user_nickname: username.value,
                    user_role_id: select[select.selectedIndex].dataset.id
                })
            })
            .then(function (res) {
                return res.json()
            })
            .then(function (json) {
                if (json.status === 'error') {
                    if (json.error_message === 'Недостаточно прав') {
                        alert(json.error_message)
                    } else if (json.error_message === 'Роль не была найдена') {
                        alert(json.error_message)
                    } else if (json.error_message === 'Пользователь не найден') {
                        alert(json.error_message)
                    }
                } else {
                    resetInputs()
                    modalSystem.hide()
                }
            })
    },
    resetInputs() {
        document.querySelector('.modal-body > input').forEach((elem) => {
            elem.value = ''
        })
    },
    deleteUser() {
        fetch('/api/v1/user', {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                user_id: Number(url.searchParams.get('id'))
            })
        }).then(function (res) {
            return res.json()
        }).then(function (json) {
            if (json.status === 'error') {
                alert(json.error_message)
            } else {
                modalSystem.hide()
                userControl.parseUsers()
            }
        })
    },
    parseUsers() {
        fetch(`/api/v1/users`).then((elem) => {
            return elem.json()
        }).then((json) => {
            this.resetUsers()
            json.data.forEach((elem) => {
                this.usersList.appendChild(userGenerator.createElement('div', 'users__user-field', '', `<p id="user-field__username" data-id="${elem.id}">${elem.username}</p>`)).appendChild(userGenerator.createElement('div', 'users__close-btn', '', ''))
            })
            document.querySelectorAll('.users__user-field').forEach((elem) => {
                elem.addEventListener('click', () => {
                    modalSystem.show('edit-user')
                })
            })
            document.querySelectorAll('.users__close-btn').forEach((elem) => {
                elem.addEventListener('click', () => {
                    modalSystem.show('delete-user')
                    document.querySelector('.delete-user > * > * > .username-span').textContent = elem.previousElementSibling.textContent
                    url.searchParams.set('id', elem.previousElementSibling.dataset.id)
                })
            })
        })
    },
    resetUsers() {
        this.usersList.innerHTML = ''
    }
}

window.onhashchange = () => {
    const addButton = document.querySelector('.add__button')
    if (window.location.hash == "#users") {
        addButton.setAttribute('onclick', `modalSystem.show('add-user')`)
        document.querySelector('.actions > .delete').classList.remove('roles-page')
    } else {
        document.querySelector('.actions > .delete').classList.add('roles-page')
        addButton.setAttribute('onclick', `modalSystem.show('add-role')`)
    }
}

titleChecker.resetClasses()
titleChecker.checkTitle(document.title)
window.location = "#users"
rolesControl.parseRoles()
userControl.parseUsers()