<?php defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed'); ?>

<?php include APP_DIR . 'views/templates/head.php'; ?>

<body style="height: 100dvh;">

    <main class="p-5 m-0 h-100 d-flex flex-column justify-content-between gap-3">

        <div class="header toolbox w-100 p-3 bg-green-darken-2 rounded text-white d-flex justify-content-between align-items-center">
            <span class="fs-2 fw-bold mx-3">Quiz: <?= $quiz["title"] ?></span>
            <div class="actions">
                <button class="btn btn-lg btn-danger btn-reset-quiz" title="Restart">Restart</button>
                <a href="/index.php/user/quizzes" class="btn btn-lg btn-primary">Save & Exit</a>
            </div>
        </div>

        <div class="content rounded d-flex flex-wrap justify-content-center align-items-center gap-3" style="width: 100%; height: 100%;">

            <div class="card imagecard p-2 d-flex justify-content-center align-items-center gap-2" style="width: 400px; min-height: 400px;">
                <img class="image-preview w-100" src="" alt="">
            </div>

            <div class="card questioncard" style="width: max(400px, calc(100% - 1rem - 400px)); min-height: 400px;">
                <div class="card-body p-4 fs-2 fw-bold w-100 h-100 d-flex flex-column justify-content-center align-items-center">
                    <span>No Questions</span>
                </div>
            </div>

        </div>

        <div class="footer toolbox w-100 p-3 bg-green-darken-2 rounded text-white d-flex align-items-center">
            <span class="fs-2 fw-bold mx-3 question-number">Question 0 of 0</span>
            <span class="fs-2 fw-bold mx-3 question-type">Type: </span>
            <span class="fs-2 fw-bold mx-3 quiz-score">Score: 0</span>
        </div>

    </main>

    <script type="module" src="<?= base_url() ?>public/js/play/handler.js"></script>

</body>

</html>