const usersList = document.querySelector('.users__list')
fetch(`/api/v1/users`).then((elem) => {
    return elem.json()
}).then((json) => {
    json.data.forEach((elem) => {
        usersList.appendChild(userGenerator.createElement('div', 'users__user-field', '', `<p data-id="${elem.id}">${elem.username}</p>`)).appendChild(userGenerator.createElement('div', 'users__close-btn', '', ''))
    })
})

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

const userDeleteBtn = document.querySelectorAll('.users__close-btn').forEach((elem) => {elem.addEventListener('click', () => {console.log(1);})})
const modal = document.querySelector('.modal')

const modalSystem = {
    modalWrap: document.querySelector('.modal-wrap'),
    addRoleWindow: document.querySelector('.add-role'),
    deleteRoleWindow: document.querySelector('.delete-role'),
    saveRoleWindow: document.querySelector('.save-role'),
    body: document.querySelector('body'),
    fixateBackground() {
        this.body.classList.toggle("fixated")
    },
    reset() {
        this.addRoleWindow.classList.remove('opened')
        this.deleteRoleWindow.classList.remove('opened')
        this.saveRoleWindow.classList.remove('opened')
    },
    show(type) {
        this.reset()
        modal.classList.add('opened')
        setTimeout(() => {
            this.modalWrap.classList.add('opened')
        }, 300);
        this.fixateBackground()
        if(type == 'delete') {
            this.deleteRoleWindow.classList.add('opened')
        }
        if(type == 'add') {
            this.addRoleWindow.classList.add('opened')
        }
        if(type == 'save') {
            this.saveRoleWindow.classList.add('opened')
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
    if(e.target == modal) modalSystem.hide()
})

document.addEventListener('keydown', (e) => {
    if(e.keyCode === 27) modalSystem.hide()
})

const nameInput = document.querySelector('.modal-body__name > input')
const nameField = document.querySelector('.modal-body__name')

const emailInput = document.querySelector('.modal-body__email > input')
const emailField = document.querySelector('.modal-body__email')

nameField.addEventListener('click', () => {nameInput.focus()})
emailField.addEventListener('click', () => {emailInput.focus()})

nameInput.addEventListener('focus', () => {
    if(nameInput.value != '') {
        return
    }else {
        nameField.classList.toggle("focused")
    }
})
nameInput.addEventListener('blur', () => {
    if(nameInput.value != "") {
        return
    }else {
        nameField.classList.toggle("focused")
    }
})

emailInput.addEventListener('focus', () => {
    if(emailInput.value != '') {
        return
    }else {
        emailField.classList.toggle("focused")
    }
})
emailInput.addEventListener('blur', () => {
    if(emailInput.value != "") {
        return
    }else {
        emailField.classList.toggle("focused")
    }
})

document.querySelectorAll('.uncheckable').forEach((elem) => {
    elem.addEventListener('dblclick', () => {
        elem.checked = false
    })
})

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
        const select = document.querySelector('.modal-body__role > select')        
        fetch(`/api/v1/roles`).then((elem) => {
            return elem.json()
        }).then((json) => {
            json.data.forEach((roles) => {
                let option = document.createElement('option')
                option.dataset.id = roles.id
                option.value = roles.name
                option.textContent = roles.name
                select.appendChild(option)
                document.querySelector('.roles').appendChild(userGenerator.createElement('div', 'users__user-field', '', `<p data-id="${roles.id}">${roles.name}</p>`))
            })
            
            const selectableUsers = {
                roles: document.querySelectorAll('.roles > .users__user-field'),
                click(elem) {
                    this.currentRoleId = elem.children[0].dataset.id
                    this.reset()
                    elem.classList.toggle('selected')
                    parsePermissions(this.currentRoleId, elem)
                    rolesControl.saveRolePermissions(this.currentRoleId)
                },
                reset() {
                    document.querySelectorAll('.permission__checkbox > * > *').forEach((elem) => {
                        if(elem.tagName === 'INPUT') {
                            elem.checked = false
                        }
                    })
                    this.roles.forEach((elem) => {
                        elem.classList.remove('selected')
                    })
                }
            }
            
            selectableUsers.click(document.querySelector('.roles').children[1])
            
            document.querySelectorAll('.roles > .users__user-field').forEach((elem) => {
                elem.addEventListener('click', () => {
                    selectableUsers.click(elem)
                })
            })
        })
    },
    saveRolePermissions(id) {
        let view_PERM, objectsAll_PERM, objectsExact_PERM, volumesAll_PERM, volumesExact_PERM, history_PERM
        document.querySelectorAll('.permission__checkbox > * > *').forEach((elem) => {
            if(elem.tagName === "INPUT") {
                elem.addEventListener('click', () => {
                    let inputId = elem.getAttribute("id");
                    if(inputId === "watch") {
                        
                    }
                })
            }
        })
    },
}



function parsePermissions(id, elem) {
    fetch(`/api/v1/role?role_id=${id}`).then((elem) => {
        return elem.json()
    }).then((json) => {
        if(json.status === "success") {
            document.querySelector('.no-access-window').classList.remove('show')
            document.querySelector('.wrap').classList.remove('no-access')
                if(elem.children[0].dataset.id == json.data.id) {
                    let parameter = json.data
                    if(parameter.object_viewer) {
                        rolesControl.watchobjectsCheckbox.checked = true
                    } 
                    if(parameter.manage_history) {
                        rolesControl.versionControlCheckbox.checked = true
                    } 
                    if(parameter.manage_objects) {
                        rolesControl.objectCrudAllCheckbox.checked = true
                        rolesControl.objectCrudExactCheckbox.checked = false
                    } 
                    if(!parameter.manage_objects) {
                        rolesControl.objectCrudAllCheckbox.checked = false
                        rolesControl.objectCrudExactCheckbox.checked = true
                    } 
                    if(parameter.manage_volumes) {
                        rolesControl.volumeCrudAllCheckbox.checked = true
                        rolesControl.volumeCrudExactCheckbox.checked = false
                    } 
                    if(!parameter.manage_volumes) {
                        rolesControl.volumeCrudAllCheckbox.checked = false
                        rolesControl.volumeCrudExactCheckbox.checked = true
                    }
                    if(parameter.object_viewer && parameter.manage_history && parameter.manage_objects && parameter.manage_volumes && parameter.manage_users) {
                        rolesControl.adminCheckbox.checked = true
                    }
                }
            }else {
                if(json.error_message == 'Недостаточно прав') {
                    document.querySelector('.no-access-window').classList.add('show')
                    document.querySelector('.wrap').classList.add('no-access')
                }
            }
        })
    }
    
    function resetInputs() {
        document.querySelector('.modal-body > input').forEach((elem) => {
            elem.value = ''
        })
    }

    function addUser() {
        const username = document.querySelector(".modal-body__name > input")
        const email = document.querySelector('.modal-body__email > input')
        const select = document.querySelector('.modal-body__role > select')
        
        fetch("/api/v1/admin/create_account", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({user_email: email.value, user_nickname: username.value, user_role_id: select[select.selectedIndex].dataset.id})
        })
        .then(function(res) {
            return res.json();
        })
        .then(function(json) {
            if(json.status === 'error') {
                if(json.error_message === 'Недостаточно прав') {
                    alert(json.error_message)
                }else if (json.error_message === 'Роль не была найдена') {
                    alert(json.error_message)
                }else if (json.error_message === 'Пользователь не найден') {
                    alert(json.error_message)
                }
            }else {
                resetInputs()
                modalSystem.hide()
            }
        })
    }

titleChecker.resetClasses()
titleChecker.checkTitle(document.title)
window.location = "#roles"
rolesControl.parseRoles()
