import { questions, quiz } from "./data.js"




const updateQuiz = async (data) => {

    const req = { method: 'PATCH', body: JSON.stringify(data) }
    const res = await fetch('/user/quiz', req)
    let payload = null

    if (res.status < 300) {
        const data = await res.json()
        payload = data
        
        quiz.id = data.id
        quiz.title = data.title
        quiz.description = data.description
        quiz.visibility = data.visibility
        quiz.image = data.image

        console.log('Quiz updated successfully.')
    }
    else console.log(await res.text())

    return payload
}

const uploadQuiz = async (id, file) => {

    const formData = new FormData()
    formData.append('id', id)
    formData.append('file', file)

    const req = { method: 'POST', body: formData }
    const res = await fetch('/user/quiz/upload', req)
    let payload = null

    if (res.status < 300) {
        const data = await res.json()
        payload = data

        quiz.id = data.id
        quiz.title = data.title
        quiz.description = data.description
        quiz.visibility = data.visibility
        quiz.image = data.image

        console.log('Quiz image uploaded successfully.')
    }
    else console.log(await res.text())

    return payload
}

const unloadQuiz = async (data) => {

    const req = { method: "DELETE", body: JSON.stringify(data) }
    const res = await fetch('/user/quiz/upload', req)
    let payload = null

    if (res.status < 300) {
        const data = await res.json()
        payload = data

        quiz.image = ''
        console.log('Quiz image removed successfully.')
    }
    else console.log(await res.text())

    return payload
}



const createQuestion = async (data) => {

    const req = { method: 'POST', body: JSON.stringify(data) }

    const res = await fetch('/user/quiz/question', req)
    let payload = null

    if (res.status < 300) {
        const data = await res.json()
        data.answers = []
        payload = data

        questions.push(data)
        console.log('Question created successfully.')
    }
    else console.log(await res.text())

    return payload
}

const updateQuestion = async (data) => {

    const req = { method: 'PATCH', body: JSON.stringify(data) }
    const res = await fetch('/user/quiz/question', req)
    let payload = null

    if (res.status < 300) {
        const data = await res.json()
        payload = data
        
        const index = questions.findIndex(q => q.id == data.id)
        if (index !== -1) {
            const answers = questions[index].answers
            questions[index] = data
            questions[index].answers = answers
            
            payload = questions[index]
            console.log('Question updated successfully.')
        }
    }
    else console.log(await res.text())

    return payload
}

const uploadQuestion = async (id, file) => {

    const formData = new FormData()
    formData.append('id', id)
    formData.append('file', file)

    const req = { method: 'POST', body: formData }
    const res = await fetch('/user/quiz/question/upload', req)
    let payload = null

    if (res.status < 300) {
        const data = await res.json()
        payload = data

        const index = questions.findIndex(q => q.id == data.id)
        if (index !== -1) {
            questions[index] = data
            console.log('Question image uploaded successfully.')
        }
    }
    else console.log(await res.text())

    return payload
}

const unloadQuestion = async (data) => {

    const req = { method: "DELETE", body: JSON.stringify(data) }
    const res = await fetch('/user/quiz/question/upload', req)
    let payload = null

    if (res.status < 300) {
        const data = await res.json()
        payload = data

        const index = questions.findIndex(q => q.id == data.id)
        if (index !== -1) {
            questions[index].image = ""
            console.log('Question image removed successfully.')
        }
    }
    else console.log(await res.text())

    return payload
}

const deleteQuestion = async (data) => {

    const req = { method: 'DELETE', body: JSON.stringify(data) }
    const res = await fetch('/user/quiz/question', req)
    let payload = null

    if (res.status < 300) {
        const data = await res.json()
        payload = data

        const index = questions.findIndex(q => q.id == data.id)
        if (index !== -1) {
            questions.splice(index, 1)
            console.log('Question deleted successfully.')
        }
    }
    else console.log(await res.text())

    return payload
}



const createAnswer = async (data) => {

    const req = { method: 'POST', body: JSON.stringify(data) }
    const res = await fetch('/user/quiz/question/answer', req)
    let payload = null

    if (res.status < 300) {

        const ans = await res.json()
        payload = ans

        const qindex = questions.findIndex(q => q.id == ans.question_id)
        if (qindex !== -1) {
            questions[qindex].answers.push(ans)
            console.log("Answer created successfully.")
        }
    }
    else console.log(await res.text())

    return payload
}

const updateAnswer = async (data) => {

    const req = { method: 'PATCH', body: JSON.stringify(data) }
    const res = await fetch('/user/quiz/question/answer', req)
    let payload = null

    if (res.status < 300) {
        const ans = await res.json()
        payload = ans
        
        const qindex = questions.findIndex(q => q.id == data.question_id)
        if (qindex !== -1) {
            
            const aindex = questions[qindex].answers.findIndex(a => a.id == data.id)
            if (aindex !== -1) {
                
                questions[qindex].answers[aindex] = ans
                console.log('Answer updated successfully.')
            }
        }
    }   
    else console.log(await res.text())

    return payload
}





export {
    updateQuiz,
    uploadQuiz,
    unloadQuiz,
    createQuestion,
    updateQuestion,
    uploadQuestion,
    unloadQuestion,
    deleteQuestion,
    createAnswer,
    updateAnswer
}