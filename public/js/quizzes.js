



const quizcard = $(".quizcard")
const quizform = quizcard.find("form.quizform")    



const onQuizCreate = async (e) => {

    e.preventDefault()
    
    const form = $(e.target)
    const data = {
        title: form.find("input[name='title']").val(),
        description: form.find("textarea[name='description']").val(),
        visibility: form.find("select[name='visibility']").val(),
    }
    const req = { method: "POST", body: JSON.stringify(data) }
    
    await fetch('/user/quiz', req)
        .then(res => res.json())
        .then(data => location.assign(`/user/quizzes/${data.id}`))
        .catch(err => console.log(err))
}

const onCopyLink = (e) => {

    e.preventDefault()
    
    const link = location.protocol + "//" + location.hostname + $(e.target).attr('href')
    navigator.clipboard.writeText(link)
    alert(`Link copied to clipboard: ${link}`)
}

const onQuizDelete = async (e) => {

    const quizcard = $(e.target).parent().parent()
    const quizId = quizcard.find("input[name='id']").val()
    
    const data = { id: quizId }
    const req = { method: "DELETE", body: JSON.stringify(data) }

    await fetch('/user/quiz', req)
        .then(() => quizcard.remove())
        .then(() => console.log("Quiz removed successfully."))
        .catch(err => console.log(err))
}







quizform.on('submit', onQuizCreate)
quizcard.find('.btn-delete').click(onQuizDelete)
quizcard.find('.btn-copy-link').click(onCopyLink)