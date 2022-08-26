const usersList = document.querySelector('.users__list')

let url = new URL('https://artemy.net/api/v1/users')
let obj = {
    lvl: 1,
    object_id: 1
}
url.search = new URLSearchParams(obj).toString()

fetch(url).then((elem) => {
    return elem.json()
}).then((json) => {
    let allusers = json.data
    json.data.forEach((elem) => {
        Object.values(elem).forEach((item, i) => {
            if (item != "" && typeof item == "string") {
                usersList.appendChild(userGenerator.createElement('div', 'users__user-field', '', `<p data-id="${i - 1}">${item}</p>`))
            }
        })
    })

    usersList.children[0].classList.add('selected')

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

    document.querySelectorAll('.users__user-field').forEach((elem) => {elem.addEventListener('click', () => {selectableUsers.click(elem)})})

    usersList.childNodes.forEach((elem) => {
        if(elem != ' ') {
            console.log(elem);
        }
    })

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
