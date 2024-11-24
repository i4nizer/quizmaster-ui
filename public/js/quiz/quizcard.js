




const getQuiz = (quiz) => {

    const html = `
        <input type="hidden" name="id" value="${quiz.id}">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control form-control-lg" id="title" placeholder="Enter title" name="title" value="${quiz.title}" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>
        <div class="form-group mt-3">
            <label for="description">Description</label>
            <textarea class="form-control fs-5" rows="5" id="description" placeholder="Enter description" name="description">${quiz.description}</textarea>
        </div>
        <div class="form-group mt-3">
            <label for="visibility">Visibility</label>
            <select class="form-control form-control-lg" name="visibility" id="visibility">
                <option value="Public" ${quiz.visibility === "Public" ? 'selected':''}>Public (Anyone can see and answer your quiz.)</option>
                <option value="Unlisted" ${quiz.visibility === "Unlisted" ? 'selected':''}>Unlisted (Only those who have a link to this quiz.)</option>
                <option value="Private" ${quiz.visibility === "Private" ? 'selected':''}>Private (Only you can access this quiz.)</option>
            </select>
        </div>
    `

    return html
}

const getQuestion = (question, answers) => {
    
    switch (question.type) {
        case 'Multiple Choice':
            return getMutipleChoice(question, answers)
        case 'True or False':
            return getTrueOrFalse(question, answers)
        case 'Identification':
            return getIdentification(question, answers)
    
        default:
            return getMutipleChoice(question, answers)
    }
    
}
    
const getMutipleChoice = (question, answers) => {

    const correct = answers.filter(a => a.correct)
    const incorrect = answers.filter(a => !a.correct)

    let mutipleChoice = `
        <input type="hidden" name="id" value="${question.id}">
        <div class="form-group">
            <label for="text">Question</label>
            <input type="text" class="form-control form-control-lg" id="text" placeholder="Enter question" name="text" value="${question.text}" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>
        <div class="form-group mt-3">
            <label for="answer">Correct Answer</label>
            <input type="text" class="form-control form-control-lg" id="answer" placeholder="Enter correct answer" name="answer-${correct.at(0).id}" value="${correct.at(0).text}" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>
        <div class="form-group mt-3">
            <label>False Answer</label>
    `
        
    for (const ans of incorrect) {
        mutipleChoice += `<input type="text" class="form-control form-control-lg mt-1" placeholder="Enter false answer" name="answer-${ans.id}" value="${ans.text}" required>`
    }

    mutipleChoice += `
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>
        <button type="reset" class="btn btn-lg btn-danger btn-delete mt-3 align-self-end" style="width: fit-content;">Delete</button>
    `
    return mutipleChoice
}

const getTrueOrFalse = (question, answers) => {

    const correct = answers.filter(a => a.correct)
    const incorrect = answers.filter(a => !a.correct)

    const trueOrFalse = `
        <input type="hidden" name="id" value="${question.id}">
        <div class="form-group">
            <label for="text">Question</label>
            <input type="text" class="form-control form-control-lg" id="text" placeholder="Enter question" name="text" value="${question.text}" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>
        <div class="form-group mt-3">
            <label for="answer">True or False?</label>
            <select class="form-control form-control-lg" name="answer-${correct.at(0).id}" id="answer">
                <option value="True" ${correct.at(0).text === 'True' ? 'selected':''}>True</option>
                <option value="False" ${correct.at(0).text === 'True' ? '':'selected'}>False</option>
            </select>
        </div>
        <button type="reset" class="btn btn-lg btn-danger btn-delete mt-3 align-self-end" style="width: fit-content;">Delete</button>
    `

    return trueOrFalse
}

const getIdentification = (question, answers) => {

    const correct = answers.filter(a => a.correct)
    const incorrect = answers.filter(a => !a.correct)

    const identification = `
        <input type="hidden" name="id" value="${question.id}">
        <div class="form-group">
            <label for="text">Question</label>
            <input type="text" class="form-control form-control-lg" id="text" placeholder="Enter question" name="text" value="${question.text}" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>
        <div class="form-group mt-3">
            <label for="answer">Correct Answer</label>
            <textarea class="form-control fs-5" rows="5" id="answer" name="answer-${correct.at(0).id}" placeholder="Enter correct answer">${correct.at(0).text}</textarea>
        </div>
        <button type="reset" class="btn btn-lg btn-danger btn-delete mt-3 align-self-end" style="width: fit-content;">Delete</button>
    `

    return identification
}





export {
    getQuiz,
    getQuestion,
    getMutipleChoice,
    getTrueOrFalse,
    getIdentification,
}