import { activateLink } from "../sidenav.js";
import { ctx, options } from "./chart.js";
import { quizzes, responses } from "./data.js";



// Get Data and Labels
const getDataLabels = () => {
    const data = []
    const labels = []

    // Group responses based on quizId
    for (const quiz of quizzes) {

        // no questions yet
        if (quiz.questions.length == 0) continue;

        // get responses of this quiz
        const quizRes = responses.filter(r => r.quiz_id == quiz.id)

        // total it
        let total = 0
        quizRes.forEach(r => total += r.correct)

        // set meta
        labels.push(quiz.created_at)
        data.push(total)
    }

    return { data, labels }
}

// Create the chart
const createChart = () => {
    
    const { data, labels } = getDataLabels()

    const chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Quiz Score Over Time',
                data: data,
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderWidth: 2,
                tension: 0.4
            }]
        },
        options,
    })

    
}

const onEditProfile = async (e) => {

    // avoid reload
    e.preventDefault()

    // ref form
    const form = new FormData(e.target)
    const username = form.get('username')

    // send request
    const req = { method: 'PATCH', body: JSON.stringify({ username }) }
    const res = await fetch(`/user`, req)

    if (res.status < 300) {
        const data = await res.json()

        // ref & set username
        $('.username').text(data.username)
        console.log('Profile updated successfully.')

        // close modal
        $('.modal').find('.btn-close').click()
    }
    else console.log('Failed to update profile.')
}

const loadQuizSnapshot = () => {

    // Completed
    let completed = 0;
    for (const quiz of quizzes) {
        const questCount = quiz.questions.length
        if (questCount == 0) continue;

        const resCount = responses.filter(r => r.quiz_id == quiz.id).length
        completed += questCount == resCount;
    }

    // Accuracy & Score Acquired
    const resCount = responses.length
    const correctCount = responses.filter(r => r.correct).length
    const accuracy = resCount == 0 || correctCount == 0 ? 0 : (correctCount / resCount) * 100;

    // ref
    const quizSnapshotEl = $('.quiz-snapshot')
    const completedEl = quizSnapshotEl.find('.completed')
    const accuracyEl = quizSnapshotEl.find('.accuracy')
    const scoreAcquiredEl = quizSnapshotEl.find('.score-acquired')

    // set
    completedEl.text(`${completed}`)
    accuracyEl.text(`${accuracy}%`)
    scoreAcquiredEl.text(`${correctCount}`)
}




// Activate Profile
activateLink('Profile')

// Show quiz snapshot
loadQuizSnapshot()

// Add event
$('.edit-profile-form').submit(onEditProfile)

// Show Chart
createChart()