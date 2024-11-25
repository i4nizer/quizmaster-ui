<?php defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed'); ?>

<?php include APP_DIR . 'views/templates/head.php'; ?>

<body>
    <?php include APP_DIR . 'views/templates/sidenav.php'; ?>

    <main class="p-5 h-100" style="margin-left: 100px;">

        <div class="header mb-3">
            <span class="fs-1">Quizzes You've Made</span>
        </div>

        <div class="content h-100 d-flex flex-wrap gap-3">

            <div class="card quizcard w-25">
                <div class="card-header fs-4 bg-green text-white">Create Your Own!</div>
                <form class="card-body quizform">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control form-control-lg" id="title" placeholder="Enter title" name="title" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                    <div class="form-group mt-3">
                        <label for="description">Description</label>
                        <textarea class="form-control fs-5" rows="5" id="description" placeholder="Enter description" name="description"></textarea>
                    </div>
                    <div class="form-group mt-3">
                        <label for="visibility">Visibility</label>
                        <select class="form-control form-control-lg" name="visibility" id="visibility">
                            <option value="Public">Public (Anyone can see and answer your quiz.)</option>
                            <option value="Unlisted">Unlisted (Only those who have a link to this quiz.)</option>
                            <option value="Private">Private (Only you can access this quiz.)</option>
                        </select>
                    </div>
                    <button class="btn-lg mt-3 border-0 bg-green-accent-4 text-center text-white text-decoration-none">Create Quiz</button>
                </form>
            </div>

            <?php foreach ($quizzes as $quiz): ?>

                <div class="card quizcard w-25" style="height: fit-content;">
                    <div class="card-header fs-4 bg-green text-white"><?= $quiz["title"] ?></div>
                    <div class="card-body">
                        <input type="hidden" name="id" value="<?= $quiz["id"] ?>">
                        <img class="w-100" src="<?= '/' . ($quiz["image"] ?? '') ?>" alt="">
                        <p class="my-2"><?= $quiz["description"] ?></p>
                        <a href="/user/play/<?= $quiz["id"] ?>" class="btn btn-lg btn-outline-success" title="Play"><i class="bi bi-eye-fill"></i></a>
                        <button class="btn btn-lg btn-outline-secondary btn-copy-link" title="Copy Link"><i class="bi bi-link-45deg"></i></button>
                        <a href="/user/quizzes/<?= $quiz["id"] ?>" class="btn btn-lg btn-outline-primary" title="Edit"><i class="bi bi-pencil"></i></a>
                        <button class="btn btn-lg btn-outline-danger btn-delete" title="Delete"><i class="bi bi-trash"></i></button>
                    </div>
                </div>

            <?php endforeach ?>

        </div>

    </main>

    <script type="module" src="<?= base_url() ?>public/js/quizzes.js"></script>

</body>

</html>