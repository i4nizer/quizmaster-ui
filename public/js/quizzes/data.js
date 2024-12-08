



/** Public Quizzes Only */
const publicQuizzes = []



/** Loads Public Quizzes */
const loadPublicQuizzes = async () => {
    const res = await fetch(`/user/quiz/public`)
    let payload = null
    
    if (res.status < 300) {
        const data = await res.json()
        payload = data

        publicQuizzes.push(...data)
    }

    return payload
}

const loadData = async () => {
    
    await loadPublicQuizzes()
        .then(() => console.log('Public Quizzes data loaded.'))
        .catch(err => console.log(err))

}

const getQuizCard = (quiz) => {
    const html = `
        <div class="col-12 col-lg-6 col-xxl-4">
            <div class="card quizcard h-auto" style="height: fit-content;">
                <div class="card-header fs-3 px-5 py-3 bg-primary text-white">${quiz.title}</div>
                <div class="card-body">
                    <input type="hidden" name="id" value="${quiz.id}">
                    <div class="img-box w-100 py-4 text-center">
                        <img class="w-75" src="${quiz.image ? ('/' + quiz.image) : ''}" alt="">
                    </div>
                    <p class="my-2 fs-4 text-center">(${quiz.category})</p>
                    <p class="my-2 fs-3">${quiz.description}</p>
                    <a href="/user/play/${quiz.id}" class="btn btn-lg btn-outline-success fs-2" title="Play"><i class="bi bi-play-fill"></i></a>
                    <a href="/user/play/${quiz.id}" class="btn btn-lg btn-outline-secondary btn-copy-link fs-2" title="Copy Link"><i class="bi bi-link-45deg"></i></a>
                </div>
            </div>
        </div>
    `
    return html
}



await loadData()
export { publicQuizzes, loadPublicQuizzes, loadData, getQuizCard }