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

const numberInput = document.querySelector('.modal-body__number > input')
const numberField = document.querySelector('.modal-body__number')

const emailInput = document.querySelector('.modal-body__email > input')
const emailField = document.querySelector('.modal-body__email')

nameField.addEventListener('click', () => {
    if(nameInput.value != '') {
        nameInput.focus()
        return
    }else {
        nameInput.focus()
    }

})

nameField.addEventListener('click', () => {if(nameInput.value != '') nameInput.focus()})
numberField.addEventListener('click', () => {if(nameInput.value != '') nameInput.focus()})
nameField.addEventListener('click', () => {if(nameInput.value != '') nameInput.focus()})

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


titleChecker.resetClasses()
titleChecker.checkTitle(document.title)
window.location = "#users"