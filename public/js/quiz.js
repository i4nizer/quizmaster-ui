

const addQuiz = (id, title, description) => {

    const quizListItem = `
        <div class="quiz-list-item d-flex flex-column gap-1 border rounded p-2">
            <input class="id" type="hidden" name="id" value="${id}">
            <input class="title border-0 rounded w-100 p-2" type="text" name="title" value="${title}">
            <textarea class="description w-100 border-0 rounded p-2" rows="1" name="description" placeholder="Quiz Description">${description}</textarea>
            <div class="d-flex justify-content-end">
                <button class="btn btn-danger btn-delete">Delete</button>
            </div>
        </div>
    `

    $('#quiz-list').append(quizListItem)
}





$(async () => {

    // Load quizzes
    await fetch('/home/quiz')
        .then(res => res.json())
        .then(data => data.forEach(q => addQuiz(q.id, q.title, q.description)))
        .catch(err => console.log(err))

    // Handle quiz post request
    $('#quiz-create-form').on('submit', async (e) => {
        e.preventDefault()

        // Send quiz data
        await fetch('/home/quiz', { method: 'POST', body: new FormData(e.target) })
            .then(res => res.json())
            .then(data => addQuiz(data.id, data.title, data.description))
            .catch(err => console.log(err))
    })

    // Handle delete button click
    $('#quiz-list').on('click', '.btn-delete', async (event) => {
        
        // Get data
        const quizListItem = $(event.target).parent().parent()
        const quizId = quizListItem.children('.id').val();

        // Send for deletion
        await fetch('/home/quiz', { method: 'DELETE', headers: { 'Content-Type': 'application/json' }, body: JSON.stringify({ id: quizId }) })
            .then(res => res.text())
            .then(data => console.log(data))
            .catch(err => console.log(err))
        
        quizListItem.remove()
    });

    // Handle changes to the title or description in dynamically added elements
    $('#quiz-list').on('change', '.title, .description', async (event) => {
        
        // Get data
        const quizListItem = $(event.target).parent()
        const data = {
            id: quizListItem.children('.id').val(),
            title: quizListItem.children('.title').val(),
            description: quizListItem.children('.description').val()
        }

        // Send changes
        await fetch('/home/quiz', { method: 'PATCH', headers: { 'Content-Type': 'application/json' }, body: JSON.stringify(data) })
            .then(res => res.json())
            .then(data => console.log(data))
            .catch(err => console.log(err))
    })

})