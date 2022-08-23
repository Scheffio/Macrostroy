fetch("/api/v1/users", {
    method: 'GET',
    headers: {
        'Content-Type': 'application/json'
      }
})
.then(function(res) {
    return res.json();
})
.then(function(json) {
    json.data.forEach((elem) => {
        Object.values(elem).forEach((item) => {
            if(item != "" && typeof item == "string") {
                document.querySelector('.users__list').appendChild(users.createElement('div', 'users__user-field', '', `<p>${item}</p>`))
            }
        })
    })
})

// Transfer project name
function setItemName() {
    if(localStorage.getItem('item-name')) {
        document.querySelector('.tab-anchor__anchor-name').textContent = `Управление доступом к проекту «${localStorage.getItem('item-name')}»`
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

document.querySelectorAll('.users__user-field').forEach((elem) => {elem.addEventListener('click', () => {selectableUsers.click(elem)})})
// ===================

// parse users 

const users = {
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


// ===================

titleChecker.resetClasses()
titleChecker.checkTitle(document.title)
setItemName()