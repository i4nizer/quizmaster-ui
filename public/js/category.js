$(async () => {

    // Init IDs
    const url = window.location.href
    const qmatch = url.match(/quiz\/(\d+)/)
    const cmatch = url.match(/category\/(\d+)/)
    const quizId = qmatch ? qmatch[1] : null
    const catId = cmatch ? cmatch[1] : null

    // Init breadcrumbs
    $('.breadcrumb .quiz').attr('href', `/index.php/user/quizzes/quiz/${quizId}`)


    // ----------------------------------------------------------------------------------------
    // Concern: Assigning Category Details


    // SET category details
    const setCatDetails = (name, description) => {

        // Ref qdetails
        const quizDetails = $('.category-details')

        // Assign texts
        quizDetails.find('.name').text(name)
        quizDetails.find('.description').text(description)
    }

    // GET Quiz Details
    await fetch(`/user/quiz/${quizId}/category/${catId}`)
        .then(res => res.json())
        .then(data => setCatDetails(data.name, data.description))
        .catch(err => console.log(err))
    
    
    // ----------------------------------------------------------------------------------------
    // Concern: Question Form (pre-question-item)


    // Ref
    const questionList = $('.question-list')
    const preQuestionItem = $('.pre-question-item')

    // STORAGE of Current Question being Crafted
    const preQuestion = {
        number: 1,
        text: '',
        type: 'Identification',
        answers: []
    }

    // APPEND answer item to its pre question form
    preQuestionItem.on('click', '.pre-answer-item .btn-success', (e) => {

        // Ref
        const addBtn = $(e.target)
        const answer = addBtn.parent().find('.answer')
        const answerList = addBtn.closest('.answer-list')

        // Get value and validate
        const value = answer.val()
        if (!value) return answer.focus();

        // Add answer to preQuestion answer array
        preQuestion.answers.push(value)

        // Craft answer item
        const answerItem = `
            <div class="answer-item d-flex gap-2">
                <input class="answer p-2 w-100 border rounded" type="text" name="answer" placeholder="Answer" value="${value}">
                <button class="btn btn-danger" title="Remove answer"><i class="bi bi-x"></i></button>
            </div>
        `
        
        // Add to the current question answer list
        answerList.prepend(answerItem)
        
        // Reset
        answer.val('')
        answer.focus()
    })

    // REMOVE answer item of pre question form
    preQuestionItem.on('click', '.answer-item .btn-danger', (e) => {

        // Ref
        const delBtn = $(e.target)
        const answerItem = delBtn.parent()
        const answer = answerItem.find('.answer')

        // Get value and validate
        const value = answer.val()
        if (!value) return;

        // Remove answer from preQuestion answer array
        preQuestion.answers = preQuestion.answers.filter(a => a !== value)

        // Remove from DOM
        answerItem.remove()
    })

    // SYNC Question Item
    preQuestionItem.find('.question-box .number').on('change', (e) => preQuestion.number = $(e.target).val())
    preQuestionItem.find('.question-box .text').on('change', (e) => preQuestion.text = $(e.target).val())

    // PREPEND Answer Items
    const addAnswerItems = (questionId, answers) => {

        // Find that specific question item
        const questionItem = $(`.question-item .question-box .id[value="${questionId}"]`).closest('.question-item')

        // Ref its answer list
        const answerList = questionItem.find('.answer-list')

        // Loop through answers
        for (const ans of answers) {

            // Craft answer item
            const answerItem = `
                <div class="answer-item d-flex gap-2">
                    <input class="id" type="hidden" name="id" value="${ans.id}">
                    <input class="answer p-2 w-100 border rounded" type="text" name="answer" placeholder="Answer" value="${ans.text}">
                    <button class="btn btn-danger" title="Remove answer"><i class="bi bi-x"></i></button>
                </div>
            `

            // preprend it
            answerList.preprend(answerItem)
        }

        // return answers for re-use
        return answers
    }

    // PREPEND Question Item
    const addQuestionItem = (question) => {

        // Craft New Question Item
        const questionItem = `
            <div class="question-item card w-100">
                <div class="card-header d-flex justify-content-between align-items-start">
                    <div class="question-box w-75 d-flex gap-1">
                        <input class="id" type="hidden" name="id" value="${question.id}">
                        <input class="number bg-light border rounded p-2" style="width: 80px; height: fit-content;" type="number" min="1" name="number" placeholder="1" value="${question.number}">
                        <textarea class="text bg-light w-100 border rounded p-2" name="text" rows="1" placeholder="Question">${question.text}</textarea>
                    </div>
                    <div class="action-box">
                        <button class="btn btn-secondary" title="Move question down"><i class="bi bi-arrow-down"></i></button>
                        <button class="btn btn-primary" title="Move question up"><i class="bi bi-arrow-up"></i></button>
                        <button class="btn btn-danger" title="Remove question"><i class="bi bi-x"></i></button>
                    </div>
                </div>
                <div class="answer-list card-body p-2 d-flex flex-column gap-2">

                    <!-- Correct Answers Here -->
                    
                    <!-- Correct Answer Form -->
                    <div class="pre-answer-item d-flex gap-2 mt-2">
                        <input class="answer p-2 w-100 border rounded" type="text" name="answer" placeholder="Correct answer">
                        <button class="btn btn-success" title="Add answer"><i class="bi bi-plus"></i></button>
                    </div>
            
                </div>
            </div>
        `

        // Add the question item to the question list
        questionList.prepend(questionItem)

        // Return question for re-use
        return question
    }

    // POST Question Item
    preQuestionItem.find('.action-box .btn-success').click(async (e) => {

        // Ref
        const addBtn = $(e.target)
        const number = preQuestionItem.find('.question-box .number')
        const text = preQuestionItem.find('.question-box .text')
        const answerList = preQuestionItem.find('.answer-list')

        // Get Data
        let question = {
            quiz_id: quizId,
            category_id: catId,
            number: preQuestion.number,
            text: preQuestion.text,
            type: preQuestion.type,
        }

        // Craft Req for Question and Answer Insert
        const req = {
            question: { method: 'POST', body: JSON.stringify(question) },
            answer: { method: 'POST', body: JSON.stringify(preQuestion.answers) },
        }

        // POST question
        await fetch(`/user/quiz/category/question`, req.question)
            .then(res => res.json())
            .then(data => question = addQuestionItem(data))
            .then(() => console.log('Question added successfully.'))
            .catch(err => console.log(err))
        
        // POST answers
        await fetch(`/user/quiz/category/question/answer`, req.answer)
            .then(res => res.json())
            .then(data => addAnswerItems(question.id, data))
            .then(() => console.log('Answers added successfully.'))
            .catch(err => console.log(err))

        // Now reset it
        text.val('')
        number.val('')
        answerList.find('.answer-item').remove()
        preQuestion.answers = []
    })
    

    // ----------------------------------------------------------------------------------------
    // Concern: Managing Question Items And Their Requests


    // HANDLE





    // ----------------------------------------------------------------------------------------

})