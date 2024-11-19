$(async () => {

    // Init IDs
    const url = window.location.href
    const qmatch = url.match(/quiz\/(\d+)/)
    const cmatch = url.match(/category\/(\d+)/)
    const quizId = qmatch ? qmatch[1] : null
    const catId = cmatch ? cmatch[1] : null

    // Init Form IDs
    const questionForm = $('.question-form')
    questionForm.find('.quiz_id').val(quizId)
    questionForm.find('.category_id').val(catId)

    // Init breadcrumbs
    $('.breadcrumb .quiz').attr('href', `/index.php/user/quizzes/quiz/${quizId}`)


    // ----------------------------------------------------------------------------------------


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

    // APPEND a question item
    const addQuestionItem = (id, quizId, catId, number, text, type) => {

        // Craft question item
        const questionItem = `

        `

        // Ref question list and append
        $('.question-list')
    }

    // HANDLE form to CREATE a question
    questionForm.on('submit', async (e) => {

        // Avoid reload
        e.preventDefault()

        // Craft request
        const req = { method: 'POST', body: new FormData(e.target) }

        // Send
        await fetch('/user/quiz/category/question', req)
            .then(res => res.text())
            .then(data => console.log(data))
            // .then(res => res.json())
            // .then(data => console.log(data))
            .catch(err => console.log(err))

    })

})