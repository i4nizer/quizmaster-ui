<?php include APP_DIR . 'views/templates/head.php'; ?>

<body>
    <?php include APP_DIR . 'views/templates/header.php'; ?>
    <?php include APP_DIR . 'views/templates/drawer.php'; ?>

    <main class="p-5 m-0 d-flex flex-wrap justify-content-center gap-2">

        <!-- Questions Of The Loaded Quiz -->
        <div id="questions" class="card w-75">
            <div class="card-header">Create Tough Questions</div>
            <div class="card-body d-flex flex-column gap-2">

                <!-- Quiz Details -->
                <?php include APP_DIR . 'views/templates/quiz/quiz_details.php' ?>

                <!-- Category Form -->
                <?php include APP_DIR . 'views/templates/category/category_form.php' ?>

                <!-- Question Category -->
                <?php include APP_DIR . 'views/templates/category/category_select.php' ?>

                <!-- Question List -->
                <?php include APP_DIR . 'views/templates/question/question_list.php' ?>

            </div>
        </div>

    </main>

    <body>

        </html>