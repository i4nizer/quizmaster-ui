<?php defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed'); ?>

<?php include APP_DIR . 'views/templates/head.php'; ?>

<body>

    <?php include APP_DIR . 'views/templates/sidenav.php'; ?>

    <main class="p-5 h-100" style="margin-left: 100px;">

        <div class="row gy-3 user-quizzes-row">
            <div id="user-quizzes" class="col-12">
                <h1>Recently Answered Quizzes</h1>
            </div>

            <!-- Quiz Cards -->
            <?php foreach ($quizzes as $quiz): ?>
                <div class="col-12 col-lg-6 col-xxl-4">
                    <div class="card quizcard h-auto" style="height: fit-content;">
                        <div class="card-header fs-3 px-5 py-3 bg-primary text-white"><?= $quiz["title"] ?></div>
                        <div class="card-body">
                            <input type="hidden" name="id" value="<?= $quiz["id"] ?>">
                            <div class="img-box w-100 py-4 text-center">
                                <img class="w-75" src="<?= '/' . ($quiz["image"] ?? '') ?>" alt="">
                            </div>
                            <p class="my-2 fs-4 text-center">(<?= $quiz["category"] ?>)</p>
                            <p class="my-2 fs-3"><?= $quiz["description"] ?></p>
                            <a href="/user/play/<?= $quiz["id"] ?>" class="btn btn-lg btn-outline-success fs-2" title="Play"><i class="bi bi-play-fill"></i></a>
                            <a href="/user/play/<?= $quiz["id"] ?>" class="btn btn-lg btn-outline-secondary btn-copy-link fs-2" title="Copy Link"><i class="bi bi-link-45deg"></i></a>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>

            <!-- If No Quizzes Yet -->
            <?php if (!$quizzes): ?>
                <div class="col-12 text-center user-quizzes-empty">
                    <span class="fs-2 text-secondary">You Haven't Participated Any Quizzes Yet, <a href="/user/quizzes#public-quizzes-list">Try One!</a></span>
                </div>
            <?php endif ?>

        </div>

    </main>

    <script type="module">
        import {
            activateLink
        } from '/public/js/sidenav.js'
        activateLink('Recent')
    </script>

</body>

</html>