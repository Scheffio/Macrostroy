// Переменные
const enter = document.querySelector('.action-buttons__login-button')
const popUpAlert = document.querySelector('.pop_up')
const inputs = document.querySelectorAll('.form__input')
const ol = document.querySelector('.pop_up__ol')
// ------------------------------------

// Система изменения цвета инпута во время фокуса
inputs.forEach((input) => {
    input.addEventListener('focus', () => {
        input.classList.toggle('typing')
        inputs.forEach((elem) => {
            elem.classList.remove('error')
        })
        popUp("hide")
        setTimeout(() => {
            ol.innerHTML = ''
        }, 300);
    })
    input.addEventListener('blur', () => {
        input.classList.toggle('typing')
    })
})
// ------------------------------------

// Инструмент для вызова поп-апа
function popUp(todo) {
    if (todo === "show") {
        $('.pop_up').fadeIn(300)
    } else if (todo === "hide") {
        $('.pop_up').fadeOut(300)

    } else {
        console.log("Ошибка в команде")
    }
}

// ------------------------------------

// Генератор ошибок, который принимает саму ошибку и выписывает её в поп-ап
function generateError(errorDescription) {
    if(ol.textContent.indexOf(errorDescription) >= 0) {
        return
    }else {
        let li = document.createElement('li')
        li.textContent = errorDescription
        ol.appendChild(li)
    }
}

enter.addEventListener('click', (e) => {
    e.preventDefault()
    let login = document.querySelector('.login')
    let pass = document.querySelector('.pass')

    let loginPosX = login.getBoundingClientRect().left + login.getBoundingClientRect().width + 20
    let loginPosY = login.getBoundingClientRect().top

    let passPosX = pass.getBoundingClientRect().left + pass.getBoundingClientRect().width + 20
    let passPosY = pass.getBoundingClientRect().top

    if (login.value === '' && pass.value === '') {
        login.classList.add('error')
        pass.classList.add('error')
        popUpAlert.style.left = loginPosX + 'px'
        popUpAlert.style.top = loginPosY + 'px'
        popUp("show")
        generateError('Пожалуйста, заполните все поля!')
    } else if (pass.value === '') {
        pass.classList.add('error')
        popUpAlert.style.left = passPosX + 'px'
        popUpAlert.style.top = passPosY + 'px'
        popUp("show")
        generateError('Пожалуйста, заполните поле пароля, прежде чем войти.')
    } else if (login.value === '') {
        login.classList.add('error')
        popUpAlert.style.left = loginPosX + 'px'
        popUpAlert.style.top = loginPosY + 'px'
        popUp("show")
        generateError('Пожалуйста, заполните поле почты, прежде чем войти.')
    } else {
        let mailPattern = /^[\w-\.]+@[\w-]+\.[a-z]{2,4}$/i;
        if(mailPattern.test(login.value)) {
            fetch("/api/v1/login", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                  },
                  body: JSON.stringify({user_email: login.value, user_password: pass.value})
            })
            .then(function(res) {
                return res.json();
            })
            .then(function(json) {
                if(json.status === 'error') {
                    if(json.error_message === 'Пользователь с такой почтой не найден. Пожалуйста, проверьте правильность написания почты.') {
                        popUpAlert.style.left = loginPosX + 'px'
                        popUpAlert.style.top = loginPosY + 'px'
                    }else if (json.error_message === 'Неправильно введён пароль. Пожалуйста, проверьте правильность написания пароля.') {
                        popUpAlert.style.left = passPosX + 'px'
                        popUpAlert.style.top = passPosY + 'px'
                    }
                    login.classList.toggle('error')
                    pass.classList.toggle('error')
                    popUp('show')
                    generateError(json.error_message)
                }else {
                    window.location.href = "/";
                }
            })
        }else {
            login.classList.toggle('error')
            popUpAlert.style.left = loginPosX + 'px'
            popUpAlert.style.top = loginPosY + 'px'
            popUp('show')
            generateError("Неправильно введена почта. Пожалуйста, проверьте наличие специальных символов.")
        }
    }
})

window.onresize = () => {
    console.log(windowHeight);
    if(windowHeight < 900) {

    }
}