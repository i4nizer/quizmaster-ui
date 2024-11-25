<?php defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed'); ?>

<?php include APP_DIR . 'views/templates/head.php'; ?>

<body class="h-100">

    <main class="p-5 m-0 h-100 d-flex flex-column justify-content-between gap-3">

        <div class="header toolbox w-100 p-3 bg-green-darken-2 rounded text-white d-flex justify-content-between align-items-center">
            <span class="fs-2 fw-bold mx-3">Quizmaster</span>
            <div class="actions">
                <a href="/index.php/user/quizzes" class="btn btn-lg btn-primary">Done</a>
                <a href="/user/play/<?= $quiz["id"] ?>" class="btn btn-lg bg-green-accent-4 text-white" title="Play"><i class="bi bi-eye-fill"></i></a>
            </div>
        </div>

        <div class="content rounded d-flex flex-wrap justify-content-center align-items-center gap-3" style="width: 100%; height: 100%;">

            <div class="card imagecard p-2 d-flex justify-content-center align-items-center gap-2" style="width: 400px; min-height: 400px;">
                <img class="image-preview w-100" src="" alt="">
                <div class="card-actions d-flex align-items-center gap-2">
                    <button class="btn btn-danger image-remove-btn fs-4"><i class="bi bi-trash"></i></button>
                    <label class="btn btn-lg bg-green text-white" for="image-input" style="width: fit-content;">
                        <input class="d-none image-input" type="file" accept="image/*" name="image" id="image-input">
                        <span>Set Image</span>
                    </label>
                </div>
            </div>

            <div class="card quizcard" style="width: clamp(400px, calc(100% - 1rem - 400px), 600px);">
                <div class="card-header fs-4 bg-green text-white">Quiz Card</div>
                <div class="card-body d-flex flex-column fs-5">
                    <input type="hidden" name="id" value="<?= $quiz["id"] ?>">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control form-control-lg" id="title" placeholder="Enter title" value="<?= $quiz["title"] ?>" name="title" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                    <div class="form-group mt-3">
                        <label for="description">Description</label>
                        <textarea class="form-control fs-5" rows="5" id="description" placeholder="Enter description" name="description"><?= $quiz["description"] ?></textarea>
                    </div>
                    <div class="form-group mt-3">
                        <label for="visibility">Visibility</label>
                        <select class="form-control form-control-lg" name="visibility" id="visibility" value="<?= $quiz["visibility"] ?>">
                            <option value="Public">Public (Anyone can see and answer your quiz.)</option>
                            <option value="Unlisted">Unlisted (Only those who have a link to this quiz.)</option>
                            <option value="Private">Private (Only you can access this quiz.)</option>
                        </select>
                    </div>
                </div>
            </div>

        </div>

        <ul class="pagination pagination-lg align-self-center m-0">
            <li class="page-item prev"><a class="page-link">Prev</a></li>
            <li class="page-item active"><a class="page-link" href="/index.php/user/quizzes/<?= $quiz["id"] ?>">Quiz</a></li>
            <li class="page-item next"><a class="page-link">Next</a></li>
        </ul>

        <div class="footer toolbox border w-100 p-3 rounded text-white d-flex align-items-center gap-3">
            <button name="Multiple Choice" class="btn btn-lg btn-success">Add Multiple Choice Question</button>
            <button name="True or False" class="btn btn-lg btn-warning">Add True or False Question</button>
            <button name="Identification" class="btn btn-lg btn-danger">Add Identification Question</button>
        </div>

    </main>

    <script type="module" src="<?= base_url() ?>public/js/quiz/pagination.js"></script>

</body>

</html>