<?php defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed'); ?>

<?php include APP_DIR . 'views/templates/head.php'; ?>

<body class="h-100">

    <main class="container-fluid m-0 h-100 d-flex flex-column justify-content-between gap-3">

        <!-- Header -->
        <div class="row">
            <div class="col-12 border-bottom">
                <div class="header toolbox p-3 d-flex justify-content-between align-items-center">
                    <span class="fs-1 fw-bold mx-3">Quizmaster</span>
                    <div class="actions">
                        <a href="/user/play/<?= $quiz["id"] ?>" class="btn btn-lg fs-2 bg-success text-white" title="Play"><i class="bi bi-play-fill"></i></a>
                        <a href="/user/quizzes" class="btn btn-lg btn-primary fs-2" title="Done"><i class="bi bi-check"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="row gy-3 d-flex justify-content-center">
            <!-- Image Card -->
            <div class="col-10 col-lg-5 d-flex justify-content-center align-items-center">
                <div class="card imagecard p-2 d-flex flex-column justify-content-center align-items-center gap-2" style="width: 100%; min-height: 400px;">
                    <img class="image-preview w-75 py-5" src="" alt="">
                    <div class="card-actions d-flex align-items-center gap-2">
                        <button class="btn btn-danger image-remove-btn fs-2"><i class="bi bi-trash"></i></button>
                        <label class="btn btn-lg bg-success text-white fs-3 px-4" for="image-input" style="width: fit-content;">
                            <input class="d-none image-input" type="file" accept="image/*" name="image" id="image-input">
                            <span>Set Image</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Quiz Card -->
            <div class="col-12 col-lg-5">
                <div class="card quizcard h-100">
                    <div class="card-header fs-2 px-5 py-3 bg-success text-white">Quiz Card</div>
                    <div class="card-body d-flex flex-column fs-5 p-5">
                        <input type="hidden" name="id" value="<?= $quiz["id"] ?>">
                        <div class="form-group">
                            <label class="fs-3" for="title">Title</label>
                            <input type="text" class="form-control form-control-lg fs-4" id="title" placeholder="Enter title" value="<?= $quiz["title"] ?>" name="title" required>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <div class="form-group mt-3">
                            <label class="fs-3" for="description">Description</label>
                            <textarea class="form-control fs-4" rows="5" id="description" placeholder="Enter description" name="description"><?= $quiz["description"] ?></textarea>
                        </div>
                        <div class="form-group mt-3">
                            <label class="fs-3" for="visibility">Visibility</label>
                            <select class="form-control form-control-lg fs-4" name="visibility" id="visibility">
                                <option value="Public">Public (Anyone can see and answer your quiz.)</option>
                                <option value="Unlisted">Unlisted (Only those who have a link to this quiz.)</option>
                                <option value="Private">Private (Only you can access this quiz.)</option>
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <label class="fs-3" for="category">Category</label>
                            <select class="form-control form-control-lg fs-4" name="category" id="category">
                                <option value="Fun">Fun</option>
                                <option value="Pop Culture">Pop Culture</option>
                                <option value="Movies and TV Shows">Movies and TV Shows</option>
                                <option value="Music">Music</option>
                                <option value="Fashion and Luxury Brands">Fashion and Luxury Brands</option>
                                <option value="Gaming">Gaming</option>
                                <option value="Historical Events">Historical Events</option>
                                <option value="Nature and Science">Nature and Science</option>
                                <option value="Social Media and Influencers">Social Media and Influencers</option>
                                <option value="Nostalgia">Nostalgia</option>
                                <option value="Myths and Legends">Myths and Legends</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="row">
            <ul class="col-12 pagination pagination-lg justify-content-center m-0">
                <li class="page-item prev"><a class="page-link">Prev</a></li>
                <li class="page-item active"><a class="page-link" href="/user/quizzes/<?= $quiz["id"] ?>">Quiz</a></li>
                <li class="page-item next"><a class="page-link">Next</a></li>
            </ul>
        </div>

        <!-- Footer -->
        <div class="row">
            <div class="col-12 p-5 py-3 footer toolbox border-top d-flex flex-wrap align-items-center justify-content-center gap-3">
                <button name="Multiple Choice" class="btn btn-lg btn-success fs-4" style="min-width: fit-content;">Add Multiple Choice Question</button>
                <button name="True or False" class="btn btn-lg btn-warning fs-4" style="min-width: fit-content;">Add True or False Question</button>
                <button name="Identification" class="btn btn-lg btn-danger fs-4" style="min-width: fit-content;">Add Identification Question</button>
            </div>
        </div>
    </main>

    <script type="module" src="<?= base_url() ?>public/js/quiz/pagination.js"></script>

</body>

</html>