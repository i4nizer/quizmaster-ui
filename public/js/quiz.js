$(async () => {

    // Init IDs
    const url = window.location.href
    const qmatch = url.match(/quiz\/(\d+)/)
    const quizId = qmatch ? qmatch[1] : null


    // ----------------------------------------------------------------------------------------

    // SET quiz details
    const setQuizDetails = (title, description) => {

        // Ref qdetails
        const quizDetails = $('.quiz-details')

        // Assign texts
        quizDetails.find('.title').text(title)
        quizDetails.find('.description').text(description)
    }

    // GET Quiz Details
    await fetch(`/user/quiz/${quizId}`)
        .then(res => res.json())
        .then(data => setQuizDetails(data.title, data.description))
        .catch(err => console.log(err))


    // ----------------------------------------------------------------------------------------


    // Init Category Form quiz ID
    $('.category-form').find('.quiz_id').val(quizId)

    // APPEND category item
    const addCategoryItem = (catId, quizId, name, description) => {

        // Craft category item
        const catItem = `
            <div class="category-item p-2 border rounded d-flex flex-column gap-2">
                <input class="id" type="hidden" name="id" value="${catId}">
                <div class="name-box d-flex align-items-center gap-2">
                    <input class="name p-2 border rounded w-100" type="text" name="name" value="${name}">
                    <a class="btn btn-primary" href="/user/quizzes/quiz/${quizId}/category/${catId}">Open</a>
                    <button class="btn btn-danger">Delete</button>
                </div>
                <textarea class="description w-100 border rounded p-2" rows="5" name="description">${description}</textarea>
            </div>
        `

        // Add to list
        $('.category-list').append(catItem)
    }

    // HANDLE category form for CREATE
    $('.category-form').on('submit', async (e) => {

        // avoid reload
        e.preventDefault()

        // Craft Request
        const req = { method: 'POST', body: new FormData(e.target) }

        // Send
        await fetch('/user/quiz/category', req)
            .then(res => res.json())
            .then(data => addCategoryItem(data.id, data.quiz_id, data.name, data.description))
            .then(() => e.target.reset())
            .catch(err => console.log(err))
            .finally(() => console.log('Category created successfully.'))
    })


    // ----------------------------------------------------------------------------------------

    
    // RETRIEVE category list
    await fetch(`/user/quiz/${quizId}/category`)
        .then(res => res.json())
        .then(data => data.forEach(c => addCategoryItem(c.id, c.quiz_id, c.name, c.description)))
        .catch(err => console.log(err))

    // UPDATE 
    $('.category-list').on('change', '.category-item .id, .category-item .name, .category-item .description', async (e) => {

        // Get category-item
        const catItem = $(e.target).closest('.category-item')

        // Get data
        const data = {
            id: catItem.find('.id').val(),
            quiz_id: quizId,
            name: catItem.find('.name').val(),
            description: catItem.find('.description').val(),
        }

        // Craft request
        const req = { method: 'PATCH', body: JSON.stringify(data) }

        // Send update
        await fetch('/user/quiz/category', req)
            .then(res => res.text())
            .then(data => console.log(data))
            .catch(err => console.log(err))
    })

    // DELETE
    $('.category-list').on('click', '.category-item .btn-danger', async (e) => {

        // Reference category item
        const catItem = $(e.target).closest('.category-item')

        // Get data
        const data = {
            id: catItem.find('.id').val(),
            quiz_id: quizId,
        }

        // Craft request
        const req = { method: 'DELETE', body: JSON.stringify(data) }
        
        // Send update
        await fetch('/user/quiz/category', req)
            .then(res => res.text())
            .then(data => console.log(data))
            .then(() => catItem.remove())
            .catch(err => console.log(err))
    })


})