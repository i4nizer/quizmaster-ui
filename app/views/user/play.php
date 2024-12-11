<?php defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed'); ?>

<?php include APP_DIR . 'views/templates/head.php'; ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

<body class="h-100">
    <main class="container-fluid m-0 h-100 d-flex flex-column justify-content-between gap-3">

        <!-- Header -->
        <div class="row">
            <div class="col-12 border-bottom">
                <div class="header toolbox p-3 d-flex justify-content-between align-items-center">
                    <span class="fs-1 fw-bold mx-3">Quiz: <?= $quiz["title"] ?></span>
                    <div class="actions">
                        <button class="btn btn-lg btn-danger btn-reset-quiz fs-2" title="Restart"><i class="bi bi-arrow-clockwise"></i></button>
                        <a href="/user/quizzes" class="btn btn-lg btn-primary fs-2" title="Save & Exit"><i class="bi bi-box-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="row gy-3 d-flex justify-content-center content">
            <!-- Image Card -->
            <div class="col-10 col-lg-5 d-flex justify-content-center align-items-center">
                <div class="card imagecard p-2 d-flex flex-column justify-content-center align-items-center gap-2" style="width: 100%; min-height: 400px;">
                    <img class="image-preview w-75 py-5" src="" alt="">
                </div>
            </div>

            <!-- Question Card -->
            <div class="col-10 col-lg-5">
                <div class="card questioncard h-100">
                    <div class="card-body p-4 fs-2 fw-bold w-100 h-100 d-flex flex-column justify-content-center align-items-center">
                        <span>No Questions</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="row">
            <div class="col-12 p-3 footer toolbox border-top d-flex flex-wrap align-items-center justify-content-between">
                <span style="min-width: fit-content;" class="fs-2 fw-bold mx-3 question-number">Question 0 of 0</span>
                <span style="min-width: fit-content;" class="fs-2 fw-bold mx-3 question-type">Type: </span>
                <span style="min-width: fit-content;" class="fs-2 fw-bold mx-3 quiz-score">Score: 0</span>
            </div>
        </div>
    </main>

    <script type="module" src="<?= base_url() ?>public/js/play/handler.js"></script>
</body>

</html>