<?php include APP_DIR . 'views/templates/head.php'; ?>

<body>
    <?php include APP_DIR . 'views/templates/header.php'; ?>
    <?php include APP_DIR . 'views/templates/drawer.php'; ?>

    <main class="p-5 m-0 d-flex flex-wrap justify-content-center gap-2">

        <!-- Breadcrumbs -->
        <nav class="w-75 p-2 pb-0 rounded" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="page"><a href="/index.php/user/quizzes">Quizzes</a></li>
                <li class="breadcrumb-item" aria-current="page"><a class="quiz" href="#">Quiz</a></li>
                <li class="breadcrumb-item active" aria-current="page">Category</li>
            </ol>
        </nav>

        <!-- Category Info -->
        <div class="card w-75">
            <div class="card-header">Category</div>
            <div class="card-body d-flex flex-column gap-2">

                <!-- Category Details -->
                <?php include APP_DIR . 'views/templates/category/category_details.php' ?>

            </div>
        </div>

        <!-- Question Creation -->
        <div class="card w-25">
            <div class="card-header">Make Challenging Questions</div>
            <div class="card-body d-flex flex-column gap-2">

                <!-- Question Form -->
                <?php include APP_DIR . 'views/templates/question/question_form.php' ?>

            </div>
        </div>

        <!-- Question Lists -->
        <div class="card w-50">
            <div class="card-header">Questions</div>
            <div class="card-body d-flex flex-column gap-2">

                <!-- Question List -->


            </div>
        </div>


    </main>

    <script defer src="<?= base_url() ?>public/js/category.js"></script>

</body>

</html>