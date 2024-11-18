$(async () => {

    // APPEND a Quiz Item
    const addQuizItem = (id, title, description) => {

        // Craft Element
        const quizItem = `
            <div class="quiz-item d-flex flex-column gap-1 border rounded p-2">
                <input class="id" type="hidden" name="id" value="${id}">
                <div class="title-box d-flex gap-2">
                    <input class="title border rounded w-100 p-2" type="text" name="title" value="${title}">
                    <a class="btn btn-primary btn-open" href="/index.php/user/quizzes/quiz/${id}">Open</a>
                    <button class="btn btn-danger btn-delete">Delete</button>
                </div>
                <textarea style="display: none" class="description w-100 border rounded p-2" rows="1" name="description" placeholder="Quiz Description">${description}</textarea>
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
    $('#quiz-list').on('change', '.quiz-item .title, .quiz-item .description', async (event) => {

        // Get the Quiz Item
        const quizListItem = $(event.target).closest('.quiz-item')
        
        // Access id, title, description
        const data = {
            id: quizListItem.find('.id').val(),
            title: quizListItem.find('.title').val(),
            description: quizListItem.find('.description').val(),
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
    
    // QuizItem.Hover: Slide Down and Show Textarea
    $('#quiz-list').hover(() => {

        // Show description on hover
        $('.quiz-item').mouseenter((event) => $(event.target).find('.description').fadeIn(500) )
        
        // Hide description on hover
        $('.quiz-item').mouseleave((event) => $(event.target).find('.description').stop().hide() )

    })
    
    // HANDLE quiz creation
    $('#quiz-form').on('submit', async (e) => {
        
        // Avoid page reload
        e.preventDefault()

        // Craft data
        const req = { method: 'POST', body: new FormData(e.target) }

        // Post Data
        await fetch('/user/quiz', req)
            .then(res => res.json())
            .then(data => addQuizItem(data.id, data.title, data.description))
            .then(() => console.log('Quiz created successfully.'))
            .catch(err => console.log(err))
    })


})