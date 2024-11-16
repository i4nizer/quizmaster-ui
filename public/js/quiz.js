$(async () => {

    // CREATE a Quiz Item
    const addQuizItem = (id, title, description) => {

        // Craft Element
        const quizItem = `
            <div class="quiz-item d-flex flex-column gap-1 border rounded p-2">
                <input class="id" type="hidden" name="id" value="${id}">
                <input class="title border-0 rounded w-100 p-2" type="text" name="title" value="${title}">
                <textarea class="description w-100 border-0 rounded p-2" rows="1" name="description" placeholder="Quiz Description">${description}</textarea>
                <div class="d-flex justify-content-end">
                    <button class="btn btn-danger btn-delete">Delete</button>
                </div>
            </div>
        `

        // Get List and Append
        $('#quiz-list').append(quizItem)
    }


    // RETRIEVE Quizzes
    await fetch('/user/quiz')
        .then(res => res.json())
        .then(data => data.forEach(q => addQuizItem(q.id, q.title, q.description)))
        .catch(err => console.log(err))

    
    // UPDATE Quiz when Changed
    $('#quiz-list').on('change', '.title, .description', async (event) => {

        // Get Data
        const quizListItem = $(event.target).parent()
        const data = {
            id: quizListItem.children('.id').val(),
            title: quizListItem.children('.title').val(),
            description: quizListItem.children('.description').val()
        }
        
        // Craft Request
        const req = {
            method: 'PATCH',
            body: JSON.stringify(data)
        }

        // Send Changes
        await fetch('/user/quiz', req)
            .then(res => res.text())
            .then(data => console.log(data))
            .catch(err => console.log(err))
    })

    
    // DELETE quiz from list and req
    $('#quiz-list').on('click', '.btn-delete', async (event) => {

        // Get Data
        const quizListItem = $(event.target).parent().parent()
        const quizId = quizListItem.children('.id').val();
        const req = {
            method: 'DELETE',
            body: JSON.stringify({
                id: quizId
            })
        }

        // Send for Deletion
        await fetch('/user/quiz', req)
            .then(res => res.text())
            .then(data => console.log(data))
            .catch(err => console.log(err))

        // Remove in DOM
        quizListItem.remove()
    });

    
    // HANDLE Catch Form Submit
    $('#quiz-form').on('submit', async (e) => {
        
        // Avoid page reload
        e.preventDefault()

        // Craft data
        const req = { method: 'POST', body: new FormData(e.target) }

        // Post Data
        await fetch('/user/quiz', req)
            .then(res => res.json())
            .then(data => addQuizItem(data.id, data.title, data.description))
            .catch(err => console.log(err))
    })


})