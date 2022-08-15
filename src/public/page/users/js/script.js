// Title checker
const menu_elements = document.querySelectorAll('.menu__element')

const titleChecker = {
    resetClasses() {
        menu_elements.forEach((element) => element.classList.remove('selected'))
    },
    checkTitle(element) {
        if(element.indexOf('-') >= 0) {
            let menuElement = element.slice(element.indexOf('-') + 2) 
            menu_elements.forEach((element) => {
                if(element.textContent === menuElement) {
                    element.classList.add('selected')
                }
            })
        }
    }
}

window.onload = () => {
    titleChecker.resetClasses()
    titleChecker.checkTitle(document.title)
}


// ==================