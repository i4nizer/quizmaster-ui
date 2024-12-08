



// ref
const ctx = document.getElementById('quiz-score-trend').getContext('2d')


// opts
const options = {
    responsive: true,
    plugins: {
        legend: {
            display: true,
            position: 'top'
        },
        tooltip: {
            enabled: true
        },
        title: {
            display: true,
            text: 'Score Over Time',
            font: {
                size: 18,
                weight: 'bold',
            },
            padding: {
                top: 10,
                bottom: 20,
            },
            color: 'black'
        },
    },
    scales: {
        x: {
            title: {
                display: true,
                text: 'Date'
            }
        },
        y: {
            beginAtZero: true,
            title: {
                display: true,
                text: 'Score'
            }
        }
    }
}




export { ctx, options }