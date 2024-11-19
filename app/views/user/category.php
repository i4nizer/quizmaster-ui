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
                <div class="card-header d-flex justify-content-between align-items-start">
                    <div class="question-box w-75 d-flex gap-1">
                        <input class="id" type="hidden" name="id">
                        <input class="number bg-light border rounded p-2" style="width: 80px; height: fit-content;" type="number" min="1" name="number" placeholder="1">
                        <textarea class="text bg-light w-100 border rounded p-2" name="text" rows="1" placeholder="Question"></textarea>
                    </div>
                    <div class="action-box">
                        <button class="btn btn-secondary" title="Move question down"><i class="bi bi-arrow-down"></i></button>
                        <button class="btn btn-primary" title="Move question up"><i class="bi bi-arrow-up"></i></button>
                        <button class="btn btn-danger" title="Remove question"><i class="bi bi-x"></i></button>
                    </div>
                </div>
                <div class="answer-list card-body p-2 d-flex flex-column gap-2">

                    <!-- Correct Answers Here -->
                    <div class="answer-item d-flex gap-2">
                        <input class="answer p-2 w-100 border rounded" type="text" name="answer" placeholder="Answer">
                        <button class="btn btn-danger" title="Remove answer"><i class="bi bi-x"></i></button>
                    </div>
                    <div class="answer-item d-flex gap-2">
                        <input class="answer p-2 w-100 border rounded" type="text" name="answer" placeholder="Answer">
                        <button class="btn btn-danger" title="Remove answer"><i class="bi bi-x"></i></button>
                    </div>

                    <!-- Correct Answer Form -->
                    <div class="pre-answer-item d-flex gap-2 mt-2">
                        <input class="answer p-2 w-100 border rounded" type="text" name="answer" placeholder="Correct answer">
                        <button class="btn btn-success" title="Add answer"><i class="bi bi-plus"></i></button>
                    </div>

                </div>
            </div>

            <!-- Question Form -->
            <div id="pre-question-item" class="pre-question-item card w-100 mt-2">
                <div class="card-header d-flex justify-content-between align-items-start">
                    <div class="question-box w-75 d-flex gap-1">
                        <input class="number bg-light border rounded p-2" style="width: 80px; height: fit-content;" type="number" min="1" name="number" placeholder="1">
                        <textarea class="text bg-light w-100 border rounded p-2" name="text" rows="1" placeholder="Question"></textarea>
                    </div>
                    <div class="action-box">
                        <button class="btn btn-success">Add</button>
                    </div>
                </div>
                <div class="answer-list card-body p-2 d-flex flex-column gap-2">

                    <!-- Correct Answers Here -->


                    <!-- Correct Answers Form -->
                    <div class="pre-answer-item d-flex gap-2 mt-2">
                        <input class="answer p-2 w-100 border rounded" type="text" name="answer" placeholder="Correct answer">
                        <button class="btn btn-success" title="Add answer"><i class="bi bi-plus"></i></button>
                    </div>

                </div>
            </div>

        </div>


    </main>

    <script defer src="<?= base_url() ?>public/js/category.js"></script>

</body>

</html>