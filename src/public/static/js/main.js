// Anchor Checker
const anchors = document.querySelectorAll('.tabs-controller__tab-anchor')

const anchorChecker = {
    anchorReset() {
        // обнулятор якорей
        anchors.forEach((anchor) => {
            anchor.children[0].classList.remove('selected')
            anchor.style.order = 0
        })
    },
    anchorCheck(anchor, target) {
        // чекер якорей
        if(anchor != '') {
            if (!anchor.children[0].classList.contains('selected')) {
                // Если у ребёнка внутри якоря нету класса | этого 
                // то мы ему даём класс и выталкиваем на первое место
                this.anchorReset()
                anchor.style.order = -1
                anchor.children[0].classList.add('selected')
            }
        }

        if(target != '') {
            anchors.forEach((elem) => {
                if(elem.children[0].textContent == target) {
                    this.anchorReset()
                    elem.style.order = -1
                    elem.children[0].classList.add('selected')
                }
            })
        }
    }
}

anchors.forEach((elem) => {
    elem.addEventListener('click', () => {
        anchorChecker.anchorCheck(elem)
        // вешаем эту жесть на все якори
    })
})
// =====================
// Title checker
const menu_elements = document.querySelectorAll('.menu__element')

const titleChecker = {
    resetClasses() {
        // Эта штука делает ресет всех классов, чтобы обнулить всё
        menu_elements.forEach((element) => element.classList.remove('selected'))
    },
    checkTitle(element) {
        // чекер тайтла окна
        if (element.indexOf('-') >= 0) {
            // находим дефис? всё ок, страница готова для обработки
            let menuElement = element.slice(element.indexOf('-') + 2)
            // вырезаем слово после дефиса
            menu_elements.forEach((element) => {
                if (element.textContent === menuElement) {
                    element.classList.add('selected')
                    // ищем есть ли такой элемент в меню, есть - кидаем стиль
                }
            })
        } else {
            // еррор
            console.log('You have a title error. Please, check the Title Checker.');
        }
    }
}
// ==================

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

// ========================

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

