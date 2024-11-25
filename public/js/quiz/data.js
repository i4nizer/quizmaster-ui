




const url = location.href
const match = url.match(/\/quizzes\/(\d+)/);



const quiz = {
    id: match ? match[1] : null,
    title: '',
    description: '',
    visibility: 'Public',
    image: '',
}

const questions = []



const loadQuiz = async () => {
    const res = await fetch(`/user/quiz/${quiz.id}`)
    let payload = null

    if (res.status < 300) {
        const data = await res.json()
        payload = data
        
        quiz.id = data.id
        quiz.title = data.title
        quiz.description = data.description
        quiz.visibility = data.visibility
        quiz.image = data.image
    }

    return payload
}

const loadQuestions = async () => {
    const res = await fetch(`/user/quiz/${quiz.id}/question`)
    let payload

    if (res.status < 300) {
        const data = await res.json()
        payload = data
        questions.push(...data)
    }

    return payload
}

const loadAnswers = async () => {
    const payload = []

    for (const question of questions) {
        const res = await fetch(`/user/quiz/question/${question?.id}/answer`)
        
        question.answers = await res.json() ?? []
        payload.push(question.answers)
    }

    return payload
}

const loadData = async () => {
    await loadQuiz()
        .then(() => console.log('Quiz data loaded.'))
        .catch(err => console.log(err))
    
    await loadQuestions()
        .then(() => console.log('Questions data loaded.'))
        .catch(err => console.log(err))
    
    await loadAnswers()
        .then(() => console.log('Answers data loaded.'))
        .catch(err => console.log(err))
    
    return { quiz, questions, answers: questions.map(q => q.answers) }
}




await loadData()
export { quiz, questions, loadQuiz, loadQuestions, loadAnswers, loadData }