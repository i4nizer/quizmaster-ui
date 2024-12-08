



const quizzes = []
const responses = []



const loadQuizzes = async () => {
    const res = await fetch(`/user/quiz`)
    let payload = null
    
    if (res.status < 300) {
        const data = await res.json()
        payload = data

        quizzes.push(...data)
    }

    return payload
}

const loadQuestions = async () => {
    for (const [index, quiz] of quizzes.entries()) {
        const res = await fetch(`/user/quiz/${quiz.id}/question`)
        quizzes[index].questions = await res.json() ?? []
    }

    return quizzes.map(q => q.questions)
}

const loadResponses = async () => {
    const res = await fetch(`/user/quiz/response`)
    let payload = null

    if (res.status < 300) {
        const data = await res.json()
        payload = data

        responses.push(...data)
    }

    return payload
}

const loadData = async () => {
    
    await loadQuizzes()
        .then(() => console.log('Quizzes data loaded.'))
        .catch(err => console.log(err))
    
    await loadQuestions()
        .then(() => console.log('Questions data loaded.'))
        .catch(err => console.log(err))
    
    await loadResponses()
        .then(() => console.log('Responses data loaded.'))
        .catch(err => console.log(err))
    
}



await loadData()
export { quizzes, responses, loadQuizzes, loadQuestions, loadResponses, loadData }