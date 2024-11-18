<?php include APP_DIR . 'views/templates/head.php'; ?>

<body>
    <?php include APP_DIR . 'views/templates/header.php'; ?>
    <?php include APP_DIR . 'views/templates/drawer.php'; ?>

    <main class="p-5 m-0 d-flex flex-wrap justify-content-center gap-2">

        <!-- Breadcrumbs -->
        <nav class="w-75 p-2 pb-0 rounded" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="page"><a href="/index.php/user/quizzes">Quizzes</a></li>
                <li class="breadcrumb-item active" aria-current="page">Quiz</li>
            </ol>
        </nav>

        <!-- Quiz Card -->
        <div class="card w-75">
            <div class="card-header">Quiz</div>
            <div class="card-body d-flex flex-column gap-2">

                <!-- Quiz Details (UPDATABLE) -->
                <?php include APP_DIR . 'views/templates/quiz/quiz_details.php' ?>

                <!-- Quiz Internal Statistics -->
                <!-- Counts of Categories; Questions; Answers; -->

                <!-- Quiz Feedback Statistics -->
                <!-- Counts of Responses; Correct to Wrong Ratio; Highest Score; -->

                <!-- Quiz Actions -->
                <!-- COPY LINK, OPEN/CLOSE, RESULTS(LINK) -->

            </div>
        </div>

        <!-- Category Form Card for Creation -->
        <div class="card w-25">
            <div class="card-header">Group Questions Into Categories</div>
            <div class="card-body d-flex flex-column gap-2">

                <!-- Category Form -->
                <?php include APP_DIR . 'views/templates/category/category_form.php' ?>

            </div>
        </div>

        <!-- Category List of Current Quiz -->
        <div class="card w-50">
            <div class="card-header">List of Categories</div>
            <div class="card-body d-flex flex-column gap-2">

                <!-- Category List -->
                <?php include APP_DIR . 'views/templates/category/category_list.php' ?>

            </div>
        </div>

    </main>

    <script defer src="<?= base_url() ?>public/js/quiz.js"></script>

</body>

</html>