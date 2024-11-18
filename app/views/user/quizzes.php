<?php include APP_DIR . 'views/templates/head.php'; ?>

<body>
    <?php include APP_DIR . 'views/templates/header.php'; ?>
    <?php include APP_DIR . 'views/templates/drawer.php'; ?>

    <main class="p-5 m-0 d-flex flex-wrap justify-content-center gap-2">

        <!-- Quiz Creation Form -->
        <div class="card w-25">
            <div class="card-header">Start Twisting Minds</div>
            <div class="card-body">

                <!-- Quiz Form -->
                <?php include APP_DIR . 'views/templates/quiz/quiz_form.php'; ?>

            </div>
        </div>

        <!-- Quizzes User Created -->
        <div class="card w-50">
            <div class="card-header">Keep Making Quizzes</div>
            <div class="card-body">

                <!-- Quiz List -->
                <?php include APP_DIR . 'views/templates/quiz/quiz_list.php'; ?>

            </div>
        </div>

    </main>

    <script defer src="<?= base_url() ?>public/js/quizzes.js"></script>

</body>

</html>