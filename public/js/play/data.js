import { quiz, questions, loadQuiz, loadQuestions, loadAnswers } from "../quiz/data.js"




const url = location.href
const match = url.match(/\/play\/(\d+)/);
quiz.id = match ? match[1] : null

const responses = []



const attachResponses = () => {
    
    for (const [index, question] of questions.entries()) {
        const rindex = responses.findIndex(r => r.question_id == question.id)
        questions[index].response = rindex != -1 ? responses[rindex] : null
    }
}

const loadResponses = async () => {
    const res = await fetch(`/user/quiz/${quiz.id}/response`)
    let payload = null

    if (res.status < 300) {
        const data = await res.json()
        payload = data
        
        responses.push(...data)
        attachResponses()
    }

    return payload
}

const loadData = async () => {
    await loadQuiz()
        .catch(err => console.log(err))
    
    await loadQuestions()
        .catch(err => console.log(err))
    
    await loadResponses()
        .then(() => console.log('Responses data loaded.'))
        .catch(err => console.log(err))
    
    await loadAnswers()
        .catch(err => console.log(err))
    
    return { quiz, questions, responses, answers: questions.map(q => q.answers) }
}




await loadData()
export { quiz, questions, responses, loadQuiz, loadQuestions, loadResponses, attachResponses, loadAnswers }