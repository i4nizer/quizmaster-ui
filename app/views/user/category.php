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

        <!-- Question Items Here -->
        <div class="question-list w-75 d-flex flex-column gap-2">
            
            <div class="question-item card w-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="question-box w-75">
                        <input class="number bg-light border rounded p-2" style="" type="number" name="number">
                        <input class="text bg-light w-50 border rounded p-2" type="text" name="text">
                    </div>
                    <div class="move-box">
                        <button class="btn btn-secondary"><i class="bi bi-arrow-down"></i></button>
                        <button class="btn btn-primary"><i class="bi bi-arrow-up"></i></button>
                    </div>
                </div>
                <div class="answer-list card-body p-2 d-flex flex-column">

                    <!-- Correct Answers Here -->

                </div>
            </div>

        </div>


    </main>

    <script defer src="<?= base_url() ?>public/js/category.js"></script>

</body>

</html>