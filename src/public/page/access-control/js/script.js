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
    
    usersList.children[0].classList.add('selected')

    const selectableUsers = {
        users: document.querySelectorAll('.users__user-field'),
        click(elem) {
            this.reset()
            elem.classList.toggle('selected')
            for(let i = 0; i < json.data.length; i++) {
                usersList.childNodes.forEach((elem) => {
                    if(elem.tagName == 'DIV') {
                        if(json.data[i].id == elem.children[0].dataset.id) {
                            console.log(`Айди для поиска = ${json.data[i].id} | найденый элемент = ` + elem.children[0]);
                            if(json.data[i].isCrud == true || json.data[i].isAdmin == true) {
                                crudCheckbox.checked = true
                            }else if(json.data[i].isCrud == false) {
                                watchCheckbox.checked = true
                            }
                        }
                    }
                })
            }
        },
        reset() {
            this.users.forEach((elem) => {
                elem.classList.remove('selected')
            })
        }
    }

    document.querySelectorAll('.users__user-field').forEach((elem) => {elem.addEventListener('click', () => {selectableUsers.click(elem)})})

    // usersList.childNodes.forEach((elem) => {
    //     if(elem.tagName == 'DIV') {
    //         if(elem.classList.contains('selected')) {
    //             if(json.data[0].id == elem.children[0].dataset.id) {
    //                 if(json)
    //             }
    //         }
    //     }
    // })
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
