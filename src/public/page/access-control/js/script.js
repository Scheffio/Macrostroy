const usersList = document.querySelector('.users__list')
const crudCheckbox = document.querySelector('#all')
const watchCheckbox = document.querySelector('#watch')

let url = new URL('https://artemy.net/api/v1/users')
let obj = {
    lvl: 1,
    object_id: 1
}
url.search = new URLSearchParams(obj).toString()

fetch(url).then((elem) => {
    return elem.json()
}).then((json) => {
    json.data.forEach((elem) => {
        usersList.appendChild(userGenerator.createElement('div', 'users__user-field', '', `<p data-id="${elem.id}">${elem.name}</p>`))
    })
    
    const selectableUsers = {
        users: document.querySelectorAll('.users__user-field'),
        click(elem) {
            this.reset()
            elem.classList.toggle('selected')
            for(let i = 0; i < json.data.length; i++) {
                if(elem.children[0].dataset.id == json.data[i].id) {
                    if (json.data[i].isAdmin) {
                        document.querySelectorAll('.permission').forEach((elem) => {
                            elem.classList.add('disabled')
                            if(elem.classList.contains('disabled')) {
                                crudCheckbox.setAttribute('disabled', true)
                                watchCheckbox.setAttribute('disabled', true)
                                document.querySelector('.admin-alert').classList.add("enabled")
                            }
                        })
                    }else {
                        document.querySelectorAll('.permission').forEach((elem) => {
                            elem.classList.remove('disabled')
                            if(!elem.classList.contains('disabled')) {
                                crudCheckbox.removeAttribute('disabled')
                                watchCheckbox.removeAttribute('disabled')
                                document.querySelector('.admin-alert').classList.remove("enabled")
                            }
                        })
                    }
                    if(json.data[i].isCrud || json.data[i].isAdmin) {
                        crudCheckbox.checked = true
                    }else if (json.data[i].isCrud == false) {
                        watchCheckbox.checked = true
                    }else if(json.data[i].isCrud == null) {
                        crudCheckbox.checked = false
                        watchCheckbox.checked = false
                    }
                }
            }
        },
        reset() {
            this.users.forEach((elem) => {
                elem.classList.remove('selected')
            })
        }
    }

    
    
    selectableUsers.click(usersList.children[0])
    document.querySelectorAll('.users__user-field').forEach((elem) => {elem.addEventListener('click', () => {selectableUsers.click(elem)})})
})


// Transfer project name
function setItemName() {
    if (localStorage.getItem('item-name')) {
        document.querySelector('.title > p').textContent = `Управление доступом к проекту «${localStorage.getItem('item-name')}»`
    }
}
// ===================

// Uncheck checkboxes

const checkboxes = document.querySelectorAll('.permission__checkbox > *')

checkboxes.forEach((elem) => {
    elem.addEventListener('dblclick', () => {
        elem.children[0].checked = false
    })
})

// ===================

// Make fields clicked

const selectableUsers = {
    users: document.querySelectorAll('.users__user-field'),
    click(elem) {
        this.reset()
        elem.classList.toggle('selected')
    },
    reset() {
        this.users.forEach((elem) => {
            elem.classList.remove('selected')
        })
    }
}

document.querySelectorAll('.users__user-field').forEach((elem) => {
    elem.addEventListener('click', () => {
        selectableUsers.click(elem)
    })
})
// ===================

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

setItemName()
