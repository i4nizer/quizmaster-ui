import { quiz, questions, responses } from "./data.js";
import { getQuestion } from "./questioncard.js";
import { createResponse, deleteAllResponse } from "./syncer.js";





let question = {}
const questionCard = $('.questioncard')
const questionCardBody = questionCard.find('.card-body')

const headerToolbox = $('.header.toolbox')
const footerToolbox = $('.footer.toolbox')

const imageCard = $('.imagecard')
const imagePreview = imageCard.find('img')



const shuffleArray = (array) => {
  for (let i = array.length - 1; i > 0; i--) {
    const j = Math.floor(Math.random() * (i + 1)); // Random index from 0 to i
    [array[i], array[j]] = [array[j], array[i]];  // Swap elements
  }
  return array;
}

const loadQuestion = async () => {

    // find last unanswered question
    const index = questions.findIndex(q => q.response == null)
    
    // all answered, all done
    if (index == -1) {
        onQuizDone()
        // alert(`You're all done in this quiz.`)
        return
    }

    // continue
    question = questions[index]
    imagePreview.attr('src', question.image ? ("/" + question.image) : '');

    // load question
    const html = getQuestion(question, shuffleArray(question.answers))
    questionCardBody.html(html)

    updateStatus()
}

const updateStatus = () => {

    footerToolbox.find('.question-number').text(`Question: ${responses.length + 1} of ${questions.length}`)
    footerToolbox.find('.question-type').text(`Type: ${question.type}`)
    footerToolbox.find('.quiz-score').text(`Score: ${responses.filter(r => r.correct).length}`)

}

const onAnswer = async (e) => {

    if (e.target.tagName !== 'BUTTON') return;
    const btn = $(e.target)

    // Get correct answer for the question
    const correctAns = question.answers.find(a => a.correct)

    const response = {
        quiz_id: quiz.id,
        question_id: question.id,
        answer: '',
        correct: false
    }

    // Get the answer based on question type
    switch (question.type) {
        case 'Multiple Choice':
            response.answer = btn.text()
            response.correct = response.answer == correctAns.text
            break;
        case 'True or False':
            response.answer = btn.text()
            response.correct = response.answer == correctAns.text
            break;
        case 'Identification':
            response.answer = questionCardBody.find('.answer').val()
            response.correct = response.answer.trim() == correctAns.text.trim()
            break;
    }

    // TODO: -------- Make effects here
    if (response.correct) alert('Correct!');
    else alert('Wrong!');

    // POST the response
    response.correct = Number(response.correct)
    await createResponse(response).catch(err => console.log(err))

    await loadQuestion().catch(err => console.log(err))
}

const onQuizDone = async () => {

    const correctAnswers = responses.filter(r => r.correct).length

    const html = `
        <span>Congratulations!!!</span>
        <span>You scored ${correctAnswers}/${questions.length}.</span>
    `

    questionCardBody.html(html)
    imageCard.removeClass('d-flex').addClass('d-none')
}

const onQuizReset = async (e) => {
    
    const len = questions.length
    if (len == 0 || (len > 0 && question.id && question.id == questions[0].id)) return;

    const data = { quiz_id: quiz.id }

    await deleteAllResponse(data)
    await loadQuestion()

    imageCard.removeClass('d-none').addClass('d-flex')
}





await loadQuestion()
questionCardBody.on('click', 'button', onAnswer)
headerToolbox.find('.btn-reset-quiz').click(onQuizReset)