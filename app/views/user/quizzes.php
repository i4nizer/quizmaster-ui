<?php include APP_DIR . 'views/templates/head.php'; ?>

<body>
    <?php include APP_DIR . 'views/templates/header.php'; ?>
    <?php include APP_DIR . 'views/templates/drawer.php'; ?>

    <main class="p-5 m-0 d-flex flex-wrap justify-content-center gap-4">

        <!-- All Categories in System-->
        <div class="card w-25">
            <div class="card-header">Categories</div>
            <div class="card-body d-flex flex-column">

                <!-- Category List -->
                <?php include APP_DIR . 'views/templates/category/category_list.php' ?>

            </div>
        </div>

        <!-- Quizzes User Created -->
        <div class="card w-50">
            <div class="card-header">Quizzes</div>
            <div class="card-body d-flex flex-column ">

                <!-- Quiz Creation Form -->
                <?php include APP_DIR . 'views/templates/quiz/quiz_form.php'; ?>

                <!-- Quiz List -->
                <?php include APP_DIR . 'views/templates/quiz/quiz_list.php'; ?>

            </div>
        </div>

    </main>

<body>
    
</html>