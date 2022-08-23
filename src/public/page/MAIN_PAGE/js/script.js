// Anchor Checker
const anchors = document.querySelectorAll('.tabs-controller__tab-anchor')

const anchorCheker = {
    anchorReset() {
        // обнулятор якорей
        anchors.forEach((anchor) => {
            anchor.children[0].classList.remove('selected')
            anchor.style.order = 0
        })
    },
    anchorCheck(anchor) {
        // чекер якорей
        if (!anchor.children[0].classList.contains('selected')) {
            // Если у ребёнка внутри якоря нету класса | этого 
            // то мы ему даём класс и выталкиваем на первое место
            this.anchorReset()
            anchor.style.order = -1
            anchor.children[0].classList.add('selected')
        }
    }
}

anchors.forEach((elem) => {
    elem.addEventListener('click', () => {
        anchorCheker.anchorCheck(elem)
        // вешаем эту жесть на все якори
    })
})
// =====================

// Table Generator

const whereToCreate = document.querySelectorAll('.tabs_container__tab-element')

const table = {
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
    },
    generate(rows) {
        for (let i = 0; i < rows; i++) {
            let row = this.createElement('div', 'grid-row', '', '')
            let name = this.createElement('div', 'grid-column', 'name', "<p>Калининград</p>")
            let status = this.createElement('div', 'grid-column', 'status', '<p>В процессе</p>')
            let access = this.createElement('div', 'grid-column', 'access', '<p>Открытый</p>')
            let lastChange = this.createElement('div', 'grid-column', 'lastChange', '<p>Иван</p>')
            let price = this.createElement('div', 'grid-column', 'price', '<p>200 000 000 руб.</p>')

            // Создаём, а затем притягиваем элементы внутрь блока

            row.append(name, status, access, lastChange, price)
            return row
        }
    }
}


// ======================

// Sorter Buttons 

const sorter = {
    sorters: document.querySelectorAll('.sorter > img'),
    defaultPath: "../../static/icons/sorter/sorter-default.svg",
    clickedPath: "../../static/icons/sorter/sorter-clicked.svg",
    // задаю пути и элементы
    reset() {
        this.sorters.forEach((sorter) => {
            sorter.classList.remove('selected')
            sorter.src = this.defaultPath
            // ты знаешь что это
        })
    },
    SorterClick(sorter) {
        this.reset()
        sorter.classList.add('selected')
        sorter.src = this.clickedPath
        //  ага
    }
}

document.querySelectorAll('.sorter > img').forEach((elem) => elem.addEventListener('click', (elem) => {
    sorter.SorterClick(elem.path[0])
}))
document.querySelectorAll('.sorter > img').forEach((elem) => {
    elem.addEventListener('dblclick', () => {
        sorter.reset()
    })
})

// =======================

// Status color checker

const ColorChecker = {
    reset() {
        document.querySelectorAll('.status').forEach((statusElements) => {
            statusElements.classList.remove('active', 'closed', 'deleted')
        })
    },
    NameChecker() {
        document.querySelectorAll('.status').forEach((statusElements) => {
            if (statusElements.children[0].textContent == "В процессе") {
                statusElements.classList.add('active')
                statusElements.classList.remove('closed')
                statusElements.classList.remove('stoped')
                statusElements.classList.remove('deleted')
            } else if (statusElements.children[0].textContent == "Завершён") {
                statusElements.classList.add('closed')
                statusElements.classList.remove('active')
                statusElements.classList.remove('stoped')
                statusElements.classList.remove('deleted')
            } else if (statusElements.children[0].textContent == "Заморожен") {
                statusElements.classList.add('stoped')
                statusElements.classList.remove('active')
                statusElements.classList.remove('deleted')
                statusElements.classList.remove('closed')
            } else if (statusElements.children[0].textContent == "Удалён") {
                statusElements.classList.add('deleted')
                statusElements.classList.remove('active')
                statusElements.classList.remove('stoped')
                statusElements.classList.remove('closed')
            }
        })
    }
}

// ColorChecker.keywords.forEach((elem) => {
//     Object.keys(elem).forEach((item) => console.log(elem[item]))
// })


// ========================

// Default page loader

function PageLoader(page, ammountOfRows) {
    history.pushState('', '', page)
    for(let i = 0; i < ammountOfRows; i++) {
        document.querySelector(page).append(table.generate(ammountOfRows))
    }
    ColorChecker.NameChecker()
}

function UrlSplitter(){
    let url = document.URL
    return url.slice(url.indexOf("#"))
}

window.addEventListener('hashchange', () => {
    PageLoader(UrlSplitter(), 3)
})

// ======================

// Custom Context Menu System
// Next CCM
const whereToSummon = document.querySelector('.tabs-container')

whereToSummon.addEventListener('contextmenu', (e) => {
    e.preventDefault()

})

const CCM = {
    contextMenu: document.querySelector('.context-menu'),
    listOfItems: document.querySelector('.context-menu').children[0],
    table: document.querySelector('.tabs_container__tab-element'),
    menuState: 0,
    opened: "opened",
    clickableElementClass: "grid-row",
    rowInFocus: '',
    statusToRestore: '',
    accessTypeToRestore: '',
    getClick(elem) {
        this.setPosition(elem)
        this.isInsideElement(elem, this.clickableElementClass) ? this.showMenu("show") : this.showMenu("hide")
    },
    isInsideElement(elem, clickableElementClass) {
        let element = elem.srcElement || elem.target
        if(element.classList.contains(clickableElementClass)) {
            this.rowInFocus = element
            return element
        }else {
            while( element = element.parentNode) {
                if(element.classList && element.classList.contains(clickableElementClass)) {
                    this.rowInFocus = element
                    return element
                }
            }
        }
    },
    showMenu(condition) {
        if (condition == "show") {
            this.menuState = 1
            this.contextMenu.classList.add(this.opened)
            if(localStorage.getItem("copy")) {
                console.log(this.listOfItems.children[1]);
                this.listOfItems.children[1].classList.add('disabled')
                this.listOfItems.children[2].classList.remove('disabled')
            }
            for(let i = 0; i < this.rowInFocus.children.length; i++) {
                if(this.rowInFocus.children[i].classList.contains('access')) {
                    if(this.rowInFocus.children[i].textContent == 'Открытый') {
                        this.listOfItems.children[5].innerHTML = "<a>Сделать приватным</a>"
                    }else {
                        this.listOfItems.children[5].innerHTML = "<a>Сделать открытым</a>"
                    }
                }
                if(this.rowInFocus.children[i].classList.contains("status")) {
                    if(this.rowInFocus.children[i].textContent == 'Удалён') {
                        this.listOfItems.children[9].innerHTML = "<a>Восстановать</a>"
                    }else {
                        this.listOfItems.children[9].innerHTML = "<a>Удалить</a>"
                    }
                }
            }
        }else {
            this.menuState = 0
            this.contextMenu.classList.remove(this.opened)
        }
    },
    setPosition(e) {
        let posX = 0
        let posY = 0

        if(e) {
            posX = e.pageX + 20
            posY = e.pageY - 50

            this.contextMenu.style.top = `${posY}px`
            this.contextMenu.style.left = `${posX}px`
        }
    },
    contextMenu_open(elementRow) {
        console.log(elementRow);
    },
    contextMenu_copy(elementRow) {
        if(this.listOfItems.children[1].classList.contains('disabled')) {
            console.log("disabled");
            return
        } else {
            localStorage.setItem("copy", elementRow.innerHTML)
        }
    },
    contextMenu_paste() {
        if(localStorage.getItem("copy")) {
            let ItemToPaste = localStorage.getItem("copy")
            // Make an addable row

            let gridRow = document.createElement('div')
            gridRow.classList.add('grid-row')
            gridRow.innerHTML += ItemToPaste
            this.table.appendChild(gridRow)

            // ================

            localStorage.removeItem("copy")
            this.listOfItems.children[1].classList.remove('disabled')
            this.listOfItems.children[2].classList.add('disabled')

        }else {
            return
        }
    },
    contextMenu_add() {
        modalSystem.showModalWindow()
    },
    contextMenu_changeStatus(statusType, elementRow) {
        for(let i = 0; i < elementRow.children.length; i++) {
            if(elementRow.children[i].classList.contains("status")) {
                elementRow.children[i].innerHTML = `<p>${statusType.children[0].textContent}</p>`
            }
        }
        ColorChecker.NameChecker()
    },
    contextMenu_private(elementRow) {
        for(let i = 0; i < elementRow.children.length; i++) {
            if(elementRow.children[i].classList.contains("access")) {
                if(elementRow.children[i].textContent == 'Открытый') {
                    elementRow.children[i].innerHTML = "<p>Приватный</p>"
                }else {
                    elementRow.children[i].innerHTML = "<p>Открытый</p>"
                }
            }
        }
    },
    contextMenu_accessControl(elementRow) {
        localStorage.setItem('item-name', elementRow.children[0].textContent)
    },
    contextMenu_makeEstimate() {

    },
    contextMenu_about() {

    },
    contextMenu_delete() {

    }
}

// Анимация инпута с именем
const nameInput = document.querySelector('.modal-body__name > input')
const nameField = document.querySelector('.modal-body__name')

nameField.addEventListener('click', (e) => {
    if(nameInput.value != '') {
        nameInput.focus()
        return
    }else {
        nameInput.focus()
    }

})

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

// ======================

// Модальное окно

const modal = document.querySelector('.modal')
const modalContent = document.querySelector('.modal-wrap')
const body = document.querySelector('body')

const modalSystem = {
    fixateBackground() {
        body.classList.toggle("fixated")
    },
    showModalWindow() {
        modal.classList.toggle('opened')
        setTimeout(() => {
            modalContent.classList.toggle('opened')
        }, 300);
        this.fixateBackground()
    },
    hideModalWindow() {
        modal.classList.toggle('closed')
        modalContent.classList.toggle('closed')
        setTimeout(() => {
            modal.classList.remove('closed')
            modal.classList.remove('opened')
            modalContent.classList.remove('closed')
            modalContent.classList.remove('opened')
        }, 600);
        this.fixateBackground()
    }
}


modal.addEventListener('click', (e) => {
    if(e.target == modal) modalSystem.hideModalWindow()
})

// ======================

document.addEventListener('mouseup', (e) => {e.button === 0 ? CCM.showMenu("hide") : 0})
document.addEventListener('keyup', (e) => {e.key === "Escape" ? CCM.showMenu("hide") : 0})
document.addEventListener('contextmenu', (elem) => {CCM.getClick(elem)})

// ======================


// Это производственные мелочи
PageLoader("#cities", 3)
titleChecker.resetClasses()
titleChecker.checkTitle(document.title)
table.generate(3)
ColorChecker.NameChecker()