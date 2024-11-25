import { questions, quiz } from "./data.js"
import { currentPage, init, move, pages, render } from "./pagination.js"
import { getQuestion, getQuiz } from "./quizcard.js"
import { createAnswer, createQuestion, deleteQuestion, unloadQuestion, unloadQuiz, updateAnswer, updateQuestion, updateQuiz, uploadQuestion, uploadQuiz } from "./syncer.js"





const imageCard = $('.imagecard')
const imageInput = imageCard.find('.image-input')
const imagePreview = imageCard.find('.image-preview')
const imageRemoveBtn = imageCard.find('.image-remove-btn')

const quizCardBody = $('.quizcard .card-body')
const footerToolbox = $('.footer.toolbox')



const onQuizActive = () => {

    const html = getQuiz(quiz)
    quizCardBody.html(html)
    imagePreview.attr('src', quiz.image ? ("/" + quiz.image) : '')

}

const onQuestionActive = (question, answers) => {

    const html = getQuestion(question, answers)
    quizCardBody.html(html)
    imagePreview.attr('src', question.image ? ("/" + question.image) : '')

}

const onQuizCardChange = async (e) => {

    const inputs = quizCardBody.find(":input").not(":button")
    const isQuiz = pages.at(currentPage).text === 'Quiz'

    const data = {}
    inputs.each((i, el) => data[el.name] = el.value)
    
    const tname = e.target.name

    // Quiz
    if (isQuiz) {
        await updateQuiz(data).catch(err => console.log(err))
    }
    else {
        // Answer
        if (tname.includes('answer')) {
            
            const match = tname.match(/\d+$/);
            const answerId = match ? Number(match[0]) : null;

            const update = { id: answerId, question_id: data.id, text: e.target.value }
            await updateAnswer(update).catch(err => console.log(err))
        }
        // Question
        else {

            const update = { id: data.id, text: data.text }
            await updateQuestion(update).catch(err => console.log(err))
        }
    }
}

const onAddQuestion = async (e) => {

    if (e.target.tagName != "BUTTON") return;

    // Create data
    const elem = $(e.target)
    
    const question = {
        quiz_id: quiz.id,
        type: elem.attr('name'),
        number: Number(questions.length > 0 ? questions.at(-1).number : 0) + 1,
        text: '',
    }
    
    // Send request
    const payload = await createQuestion(question)
    if (!payload) return;

    // Generate answers
    const answers = []

    switch (question.type) {
        case "Multiple Choice":
            for (let i = 0; i < 4; i++) {
                const data = { question_id: payload.id, text: '', correct: i == 0 ? 1 : 0 }
                answers.push(await createAnswer(data))
            }
            break;
        case "True or False":
            answers.push(await createAnswer({ question_id: payload.id, text: 'True', correct: true }))
            break;
        case "Identification":
            answers.push(await createAnswer({ question_id: payload.id, text: '', correct: true }))
            break;
    }

    // Re-init pagination to add the new items
    init()

    // Focus on that quiz
    const delta = pages.length - currentPage - 1
    move(delta)
    render()
}

const onDeleteQuestion = async (e) => {
    
    const target = $(e.target)
    if (target.tagName != 'BUTTON' && !target.hasClass('btn-delete')) return;

    const idInput = target.closest('.card-body').find('input[name="id"]')
    const data = { id: idInput.val() }

    await deleteQuestion(data)

    init()
    const delta = pages.length - currentPage - 1
    move(delta)
    render()
}

const onImageChange = async (e) => {

    const isQuiz = pages.at(currentPage).text === 'Quiz'
    const file = e.target.files[0]
    if (!file) return;
    
    
    if (isQuiz) {
        
        await uploadQuiz(quiz.id, file)
            .then(quiz => imagePreview.attr('src', "/" + quiz.image))
            .catch(err => console.log(err))
    }
    else {
        
        const questionId = quizCardBody.find('input[name="id"]').val();
        
        await uploadQuestion(questionId, file)
            .then(question => imagePreview.attr('src', "/" + question.image))
            .catch(err => console.log(err))
    }
}

const onImageRemove = async (e) => {

    const isQuiz = pages.at(currentPage).text === 'Quiz'


    if (isQuiz) await unloadQuiz({ id: quiz.id }).catch(err => console.log(err))
    else {
        
        const questionId = quizCardBody.find('input[name="id"]').val();

        await unloadQuestion({ id: questionId }).catch(err => console.log(err))
    }

    imagePreview.attr('src', '')
    imageInput.val('')
}





imageInput.on('change', onImageChange)
imageRemoveBtn.on('click', onImageRemove)

quizCardBody.on('change', onQuizCardChange)
footerToolbox.on('click', onAddQuestion)
quizCardBody.on('click', '', onDeleteQuestion)

export { onQuizActive, onQuestionActive }