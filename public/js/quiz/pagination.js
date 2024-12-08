import { questions } from "./data.js"
import { onQuestionActive, onQuizActive } from "./handler.js"





let currentPage = 0
const pages = []

const pagination = $('.pagination')
const prev = pagination.find('.page-item.prev')
const next = pagination.find('.page-item.next')



const render = () => {
    pagination.find('.page-item').not('.prev, .next').remove()

    for (const [index, page] of pages.entries()) {
        const active = index === currentPage
        const state = active ? 'active' : ''

        const pageItem = `<li class="page-item ${state}"><a class="page-link">${page.text}</a></li>`
        pagination.find('.next').before(pageItem)

        if (active && typeof page.onactive === 'function') page.onactive()
    }

    const disable = pages.length <= 1
    prev.toggleClass('disabled', disable || currentPage <= 0)
    next.toggleClass('disabled', disable || currentPage >= pages.length - 1)
}

const move = (steps) => {
    const result = currentPage + steps
    const valid = result >= 0 && result <= pages.length - 1
    if (valid) currentPage = result
    
    localStorage.setItem('current-page', currentPage)
}

const click = (e) => {
    const btn = e.target
    const text = $(btn).text()
    
    if (text === 'Prev') move(-1)
    else if (text === 'Next') move(1)
    else {
        const index = pages.findIndex(p => p.text === text)
        if (index === -1) return;

        const delta = index - currentPage
        move(delta)
    }

    render()
}







const init = async () => {
    
    pages.length = 0
    pages.push({ text: 'Quiz', onactive: onQuizActive })

    for (const [i, q] of questions.entries()) {

        pages.push({ text: `${i+1}`, onactive: () => onQuestionActive(q, q.answers) })

    }

    currentPage = currentPage > pages.length - 1 ? 0 : currentPage
    render()
    pagination.click(click)
}






await init()
export { currentPage, pages, init, render, move }