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

})