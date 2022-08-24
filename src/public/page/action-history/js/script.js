const whereToCreate = document.querySelector('.grid__body')

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
            let name = this.createElement('div', 'grid-column', 'name', "<p>Изменение цены работы</p>")
            let date = this.createElement('div', 'grid-column', 'date', '<p>17.07.2022 13:06</p>')
            let user = this.createElement('div', 'grid-column', 'user', '<p>Шохруз</p>')
            let lastValue = this.createElement('div', 'grid-column', 'lastValue', '<p>100</p>')
            let newValue = this.createElement('div', 'grid-column', 'newValue', '<p>200</p>')
            let cancel = this.createElement('div', 'grid-column', 'cancel', '<a>Отмена</a>')

            // Создаём, а затем притягиваем элементы внутрь блока

            row.append(name, date, user, lastValue, newValue, cancel)
            return row
        }
    }
}

function historyLoader(ammountOfRows) {
    for(let i = 0; i < ammountOfRows; i++) {
        whereToCreate.appendChild(table.generate(ammountOfRows))
    }
    ColorChecker.NameChecker()
}

historyLoader(5)

titleChecker.resetClasses()
titleChecker.checkTitle(document.title)

