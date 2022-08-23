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