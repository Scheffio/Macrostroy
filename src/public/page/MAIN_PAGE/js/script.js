// Title checker
const menu_elements = document.querySelectorAll('.menu__element')

const titleChecker = {
    resetClasses() {
        menu_elements.forEach((element) => element.classList.remove('selected'))
    },
    checkTitle(element) {
        if (element.indexOf('-') >= 0) {
            let menuElement = element.slice(element.indexOf('-') + 2)
            menu_elements.forEach((element) => {
                if (element.textContent === menuElement) {
                    element.classList.add('selected')
                }
            })
        } else {
            console.log('You have a title error. Please, check the Title Checker.');
        }
    }
}

// ==================

// Anchor Checker
const anchors = document.querySelectorAll('.tabs-controller__tab-anchor')

const anchorCheker = {
    anchorReset() {
        anchors.forEach((anchor) => {
            anchor.children[0].classList.remove('selected')
            anchor.style.order = 0
        })
    },
    anchorCheck(anchor) {
        if (!anchor.children[0].classList.contains('selected')) {
            this.anchorReset()
            anchor.style.order = -1
            anchor.children[0].classList.add('selected')
        }
    }
}

anchors.forEach((elem) => {
    elem.addEventListener('click', () => {
        anchorCheker.anchorCheck(elem)
    })
})
// =====================

// Table Generator

const whereToCreate = document.querySelector('.tabs_container__tab-element')
const colums = 5

const table = {
    createElement(element, elementClass, elementContent) {
        let create = document.createElement(`${element}`)
        if(elementClass != '') {
            create.classList.add(`${elementClass}`)
        }
        if(elementContent != '') {
            create.innerHTML = elementContent
        }
        return create
    },
    generate(rows) {
        for(let i = 0; i < rows; i++) {
            let row = this.createElement('div','grid-row','')
            for(let i = 0; i < colums; i++) {
                let column = this.createElement('div','grid-column', `${i}`)
                row.appendChild(column)
            }
            whereToCreate.appendChild(row)
        }
    }
}

// ======================

// Default page loader

function PageLoader(page) {
    history.pushState('','', page)
}

// ======================

titleChecker.resetClasses()
titleChecker.checkTitle(document.title)
table.generate(15)
PageLoader("#1-tab-element")


