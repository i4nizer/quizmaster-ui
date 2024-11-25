<?php defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed'); ?>

<?php include APP_DIR . 'views/templates/head.php'; ?>

<body style="height: 100dvh;">

    <main class="p-5 m-0 h-100 d-flex flex-column justify-content-between gap-3">

        <div class="header w-100 p-3 bg-green-darken-2 rounded text-white d-flex justify-content-between align-items-center">
            <span class="fs-2 fw-bold mx-3">Quiz: <?= $quiz["title"] ?></span>
            <div class="actions">
                <a href="/index.php/user/quizzes" class="btn btn-lg btn-primary">Done</a>
                <a href="/user/play/<?= $quiz["id"] ?>" class="btn btn-lg bg-green-accent-4 text-white" title="Play"><i class="bi bi-eye-fill"></i></a>
            </div>
        </div>

        <div class="content rounded d-flex flex-wrap justify-content-center align-items-center gap-3" style="width: 100%; height: 100%;">

            <div class="card imagecard p-2 d-flex justify-content-center align-items-center gap-2" style="width: 400px; min-height: 400px;">
                <img class="image-preview w-100" src="<?php if ($questions[0]) echo "/" . $questions[0]["image"] ?>" alt="">
            </div>

            <div class="card quizcard" style="width: clamp(400px, calc(100% - 1rem - 400px), 600px);">
                <div class="card-header fs-4 bg-green text-white">Quiz Card</div>
                <div class="card-body d-flex flex-column fs-5">
                    <?php if ($questions[0]): ?>
                        
                    <?php elseif (1) :?>
                        
                    <?php endif ?>
                </div>
            </div>

        </div>

        <ul class="pagination pagination-lg align-self-center m-0">
            <li class="page-item prev"><a class="page-link">Prev</a></li>
            <li class="page-item active"><a class="page-link" href="/index.php/user/quizzes/<?= $quiz["id"] ?>">Quiz</a></li>
            <li class="page-item next"><a class="page-link">Next</a></li>
        </ul>

    </main>

    <script type="module" src="<?= base_url() ?>public/js/play/pagination.js"></script>

</body>

</html>