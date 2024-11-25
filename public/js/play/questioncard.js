



const getQuestion = (question, answers) => {
    switch (question.type) {
        case 'Multiple Choice':
            return getMultipleChoice(question, answers);
        case 'True or False':
            return getTrueOrFalse(question, answers);
        case 'Identification':
            return getIdentification(question);
        default:
            return getMultipleChoice(question, answers);
    }
};

const getMultipleChoice = (question, answers) => {
    const options = answers.map(
        (answer) => `<button class="btn btn-lg btn-primary answer">${answer.text}</button>`
    ).join('');

    return `
        <div class="question-box mt-3 text-center">
            <span>${question.text}</span>
        </div>
        <div class="answer-box mt-3 d-flex flex-column gap-2">
            ${options}
        </div>
    `;
};

const getTrueOrFalse = (question) => {
    return `
        <div class="question-box mt-3 text-center">
            <span>${question.text}</span>
        </div>
        <div class="answer-box mt-3 d-flex flex-column gap-2">
            <button class="btn btn-lg btn-option btn-success answer">True</button>
            <button class="btn btn-lg btn-option btn-warning answer">False</button>
        </div>
    `;
};

const getIdentification = (question) => {
    return `
        <div class="question-box mt-3 text-center">
            <span>${question.text}</span>
        </div>
        <div class="answer-box mt-3 d-flex flex-column gap-2">
            <textarea class="form-control form-control-lg answer" placeholder="Enter your answer here"></textarea>
            <button class="btn btn-lg btn-success btn-submit">Submit</button>
        </div>
    `;
};




export {
    getQuestion,
    getMultipleChoice,
    getTrueOrFalse,
    getIdentification,
};
