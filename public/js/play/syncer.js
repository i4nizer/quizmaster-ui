import { attachResponses, questions, responses } from "./data.js"






const createResponse = async (data) => {

    const req = { method: 'POST', body: JSON.stringify(data) }
    const res = await fetch('/user/quiz/response', req)
    let payload = null

    if (res.status < 300) {
        const data = await res.json()
        responses.push(data)
        payload = data
        
        const index = questions.findIndex(q => q.id == data.question_id)
        if (index != -1) {

            questions[index].response = data
            console.log('Response created successfully.')
        }
    }
    else console.log(await res.text())

    return payload
}

const deleteAllResponse = async (data) => {

    const req = { method: 'DELETE', body: JSON.stringify(data) }
    const res = await fetch('/user/quiz/response', req)
    let payload = null

    if (res.status < 300) {
        const data = await res.json()
        payload = data

        responses.length = 0
        attachResponses()
        console.log('Responses deleted successfully.')
    }
    else console.log(await res.text())

    return payload
}




export { createResponse, deleteAllResponse }