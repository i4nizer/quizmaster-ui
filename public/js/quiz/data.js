




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
    const rescpy = res.clone()

    if (res.status < 300) {
        const data = await res.json()
        
        quiz.id = data.id
        quiz.title = data.title
        quiz.description = data.description
        quiz.visibility = data.visibility
        quiz.image = data.image
    }

    return rescpy
}

const loadQuestions = async () => {
    const res = await fetch(`/user/quiz/${quiz.id}/question`)
    const rescpy = res.clone()

    if (res.status < 300) {
        const data = await res.json()
        questions.push(...data)
    }

    return rescpy
}

const loadAnswers = async () => {
    const responses = []

    for (const question of questions) {
        const res = await fetch(`/user/quiz/question/${question?.id}/answer`)
        responses.push(res.clone())
        
        question.answers = await res.json()
    }

    return responses
}

const loadImages = async () => {
    
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