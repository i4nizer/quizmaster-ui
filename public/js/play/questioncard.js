



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
        (answer) => `
            <button class="btn btn-lg btn-option" onclick="selectAnswer('${answer.text}')">
                ${answer.text}
            </button>
        `
    ).join('');

    return `
        <div class="question-container">
            <p>${question.text}</p>
            <div class="options-container">
                ${options}
            </div>
        </div>
    `;
};

const getTrueOrFalse = (question) => {
    return `
        <div class="question-container">
            <p>${question.text}</p>
            <div class="options-container">
                <button class="btn btn-lg btn-option" onclick="selectAnswer('True')">True</button>
                <button class="btn btn-lg btn-option" onclick="selectAnswer('False')">False</button>
            </div>
        </div>
    `;
};

const getIdentification = (question) => {
    return `
        <div class="question-container">
            <p>${question.text}</p>
            <textarea class="form-control form-control-lg" placeholder="Enter your answer here"></textarea>
            <button class="btn btn-lg btn-submit" onclick="submitAnswer()">Submit</button>
        </div>
    `;
};





export {
    getQuestion,
    getMultipleChoice,
    getTrueOrFalse,
    getIdentification,
};
