const usersList = document.querySelector('.users__list')

let url = new URL('https://artemy.net/api/v1/users')

fetch(url).then((elem) => {
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
    addUserWindow: document.querySelector('.add-user'),
    deleteUserWindow: document.querySelector('.delete-user'),
    infoUserWindow: document.querySelector('.info-user'),
    editUserWindow: document.querySelector('.edit-user'),
    body: document.querySelector('body'),
    fixateBackground() {
        this.body.classList.toggle("fixated")
    },
    reset() {
        this.addUserWindow.classList.remove('opened')
        this.deleteUserWindow.classList.remove('opened')
        this.infoUserWindow.classList.remove('opened')
        this.editUserWindow.classList.remove('opened')
    },
    show(type) {
        this.reset()
        modal.classList.add('opened')
        setTimeout(() => {
            this.modalWrap.classList.add('opened')
        }, 300);
        this.fixateBackground()
        if(type == 'delete') {
            this.deleteUserWindow.classList.add('opened')
        }
        if(type == 'info') {
            this.infoUserWindow.classList.add('opened')
        }
        if(type == 'add') {
            this.addUserWindow.classList.add('opened')
        }
        if(type == 'edit') {
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

function resetInputs() {
    document.querySelector('.modal-body > input').forEach((elem) => {
        elem.value = ''
    })
}

const selectableUsers = {
    roles: document.querySelectorAll('.roles > .users__user-field'),
    click(elem) {
        this.reset()
        elem.classList.add('selected')
    },
    reset() {
        this.roles.forEach((elem) => {
            elem.classList.remove('selected')
        })
    }
}

function parseRoles() {
    const select = document.querySelector('.modal-body__role > select')
    let url = new URL('https://artemy.net/api/v1/roles')

    fetch(url).then((elem) => {
        return elem.json()
    }).then((json) => {
        json.data.forEach((roles) => {
            let option = document.createElement('option')
            option.dataset.id = roles.id
            option.value = roles.name
            option.textContent = roles.name
            select.appendChild(option)
            document.querySelector('.roles').appendChild(userGenerator.createElement('div', 'users__user-field', '', `<p data-id="${roles.id}">${roles.name}</p>`).addEventListener('click', selectableUsers.click(this)))
        })
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
parseRoles()
