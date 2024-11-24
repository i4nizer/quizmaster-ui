<?php defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed'); ?>

<?php include APP_DIR . 'views/templates/head.php'; ?>

<body>
    <?php include APP_DIR . 'views/templates/sidenav.php'; ?>

    <main class="p-5 h-100" style="margin-left: 100px;">

        <div class="header mb-3">
            <span class="fs-1">Quizzes by Quizmaster</span>
        </div>

        <div class="content h-100 d-flex flex-wrap gap-2">

            <div class="card" style="width: 300px;">
                <div class="card-header fs-4 bg-green text-white">Steps</div>
                <div class="card-body">
                    <span class="fs-5">Create a quiz in 3 easy steps.</span>
                    <ol class="fs-6 mt-2">
                        <li>Fill a the <a href="#quizcard">QuizCard</a>.</li>
                        <li>Next save it.</li>
                        <li>Enjoy.</li>
                    </ol>
                </div>
            </div>

            <div class="card w-25">
                <div class="card-header fs-4 bg-green text-white">Create Your Own!</div>
                <div class="card-body">
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Non nemo reprehenderit corporis fuga laudantium ipsum facilis quidem consequatur necessitatibus earum sint, obcaecati recusandae, ab quod suscipit deleniti laboriosam dolorem magnam.</p>
                    <a class="btn-lg border-0 bg-green-accent-4 text-center text-white text-decoration-none" href="/index.php/user/quizzes/-1">Create Quiz</a>
                </div>
            </div>



        </div>

    </main>

</body>

</html>