import { activateLink } from "../sidenav.js"
import { getQuizCard, publicQuizzes } from "./data.js"





const quizcard = $(".quizcard")
const quizform = quizcard.find("form.quizform")    



const onQuizCreate = async (e) => {

    e.preventDefault()
    
    const form = $(e.target)
    const data = {
        title: form.find("input[name='title']").val(),
        description: form.find("textarea[name='description']").val(),
        visibility: form.find("select[name='visibility']").val(),
        category: form.find("select[name='category']").val(),
    }
    const req = { method: "POST", body: JSON.stringify(data) }
    
    await fetch('/user/quiz', req)
        .then(res => res.json())
        .then(data => location.assign(`/user/quizzes/${data.id}`))
        .catch(err => console.log(err))
}

const onCopyLink = (e) => {

    e.preventDefault()
    
    const link = $(e.target).attr('href')
    navigator.clipboard.writeText(link)
    alert(`Link copied to clipboard: ${link}`)
}

const onQuizDelete = async (e) => {

    const quizcard = $(e.target).parent().parent().parent()
    const quizId = quizcard.find("input[name='id']").val()

    const data = { id: quizId }
    const req = { method: "DELETE", body: JSON.stringify(data) }

    await fetch('/user/quiz', req)
        .then(() => quizcard.remove())
        .then(() => console.log("Quiz removed successfully."))
        .then(() => $(`input[name="id"][value="${quizId}"]`).closest('.quizcard').remove())
        .catch(err => console.log(err))
}

const listPublicQuizzes = (category = 'All') => {

    // ref 
    const publicQuizzesList = $('.public-quizzes-list');
    publicQuizzesList.html('')

    // filter
    const quizzes = category == 'All' ? publicQuizzes : publicQuizzes.filter(q => q.category == category)

    // list quizzes
    for (let i = 0; i < quizzes.length; i += 2) {

        const html = `
            <div class="row">
                ${quizzes[i] ? getQuizCard(quizzes[i]) : ''}
                ${quizzes[i + 1] ? getQuizCard(quizzes[i + 1]) : ''}
            </div>
        `

        publicQuizzesList.append(html)
    }

}

const onPublicQuizFilterChange = (e) => {

    // filter by category
    const category = $(e.target).val()

    listPublicQuizzes(category)

}





// Activate Quizzes
activateLink('Quizzes')

quizform.on('submit', onQuizCreate)
quizcard.find('.btn-delete').click(onQuizDelete)
quizcard.find('.btn-copy-link').click(onCopyLink)

listPublicQuizzes()
$('.public-quiz-filter').on('change', onPublicQuizFilterChange)