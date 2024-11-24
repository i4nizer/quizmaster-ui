<?php defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed'); ?>

<?php include APP_DIR . 'views/templates/head.php'; ?>

<body>
    <?php include APP_DIR . 'views/templates/sidenav.php'; ?>

    <main class="p-5 h-100" style="margin-left: 100px;">

        <div class="header mb-3">
            <span class="fs-1">Quizzes You've Made</span>
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

            <?php foreach ($quizzes as $quiz): ?>

                <div class="card quizcard w-25">
                    <div class="card-header fs-4 bg-green text-white"><?= $quiz["title"] ?></div>
                    <div class="card-body">
                        <input type="hidden" name="id" value="<?= $quiz["id"] ?>">
                        <img class="w-100" src="<?= '/' . ($quiz["image"] ?? '') ?>" alt="">
                        <p><?= $quiz["description"] ?></p>
                        <a href="/user/quizzes/<?= $quiz["id"] ?>" class="btn btn-outline-success">Edit</a>
                        <a href="#" class="btn btn-outline-primary">Preview</a>
                        <a href="#" class="btn btn-outline-danger btn-delete">Delete</a>
                    </div>
                </div>

            <?php endforeach ?>


        </div>

    </main>

    <script type="module">
        $(() => {

            $(".quizcard")
                .find('.btn-delete')
                .click(async (e) => {

                    const quizcard = $(e.target).parent().parent()
                    const quizId = quizcard.find("input[name='id']").val()
                    const req = { method: "DELETE", body: JSON.stringify({ id: quizId }) }

                    await fetch('/user/quiz', req)
                        .then(() => quizcard.remove())
                        .then(() => console.log("Quiz removed successfully."))
                        .catch(err => console.log(err))
                })

        })
    </script>

</body>

</html>