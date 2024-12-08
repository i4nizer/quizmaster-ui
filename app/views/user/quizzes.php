<?php defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed'); ?>

<?php include APP_DIR . 'views/templates/head.php'; ?>

<body>

    <?php include APP_DIR . 'views/templates/sidenav.php'; ?>

    <main class="p-5 h-100" style="margin-left: 100px;">

        <div class="row gy-3">
            <div class="col-12">
                <h1>Challenge Their Minds!</h1>
            </div>

            <!-- Quiz Form -->
            <div class="col-12 col-lg-6 col-xxl-4">
                <div id="quizform" class="card quizcard h-auto">
                    <div class="card-header fs-2 px-5 py-3 bg-success text-white">Create Your Own!</div>
                    <form class="card-body quizform p-5 d-flex flex-column">
                        <div class="form-group">
                            <label for="title" class="fs-3">Title</label>
                            <input type="text" class="form-control form-control-lg fs-4" id="title" placeholder="Enter title" name="title" required>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <div class="form-group mt-3">
                            <label for="description" class="fs-3">Description</label>
                            <textarea class="form-control fs-4" rows="5" id="description" placeholder="Enter description" name="description"></textarea>
                        </div>
                        <div class="form-group mt-3">
                            <label for="visibility" class="fs-3">Visibility</label>
                            <select class="form-control form-control-lg fs-4" name="visibility" id="visibility">
                                <option value="Public">Public (Anyone can see and answer your quiz.)</option>
                                <option value="Unlisted">Unlisted (Only those who have a link to this quiz.)</option>
                                <option value="Private">Private (Only you can access this quiz.)</option>
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <label for="category" class="fs-3">Category</label>
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
                        <button class="btn btn-lg btn-success mt-3 fs-4 px-4 align-self-end" style="width: fit-content;">Create Quiz</button>
                    </form>
                </div>
            </div>

        </div>

        <div class="row">
            <hr class="my-5">
        </div>

        <div class="row gy-3">
            <div id="user-quizzes" class="col-12">
                <h1>Your Quizzes</h1>
            </div>

            <!-- Quiz Cards -->
            <?php foreach ($user_quizzes as $quiz): ?>
                <div class="col-12 col-lg-6 col-xxl-4">
                    <div class="card quizcard h-auto" style="height: fit-content;">
                        <div class="card-header fs-3 px-5 py-3 bg-primary text-white"><?= $quiz["title"] ?></div>
                        <div class="card-body">
                            <input type="hidden" name="id" value="<?= $quiz["id"] ?>">
                            <div class="img-box w-100 py-4 text-center">
                                <img class="w-75" src="<?= '/' . ($quiz["image"] ?? '') ?>" alt="">
                            </div>
                            <p class="my-2 fs-4 text-center">(<?= $quiz["category"] ?>)</p>
                            <p class="my-2 fs-3"><?= $quiz["description"] ?></p>
                            <a href="/user/play/<?= $quiz["id"] ?>" class="btn btn-lg btn-outline-success fs-2" title="Play"><i class="bi bi-play-fill"></i></a>
                            <a href="/user/play/<?= $quiz["id"] ?>" class="btn btn-lg btn-outline-secondary btn-copy-link fs-2" title="Copy Link"><i class="bi bi-link-45deg"></i></a>
                            <a href="/user/quizzes/<?= $quiz["id"] ?>" class="btn btn-lg btn-outline-primary fs-2" title="Edit"><i class="bi bi-pencil"></i></a>
                            <button class="btn btn-lg btn-outline-danger btn-delete fs-2" title="Delete"><i class="bi bi-trash"></i></button>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>

            <!-- If No Quizzes Yet -->
            <?php if (!$user_quizzes): ?>
                <div class="col-12 text-center">
                    <span class="fs-2 text-secondary">You Don't Have Quizzes Yet, <a href="#quizform">Create One!</a></span>
                </div>
            <?php endif ?>

        </div>

        <div class="row">
            <hr class="my-5">
        </div>

        <div class="row gy-3">
            <div class="col-12">
                <h1>Conquer Quizzes!</h1>
            </div>

            <div class="col-12 mb-5 px-5 public-quiz-filter">
                <div class="form-group mt-3">
                    <label for="category" class="fs-3">Filter by Category</label>
                    <select class="form-control form-control-lg fs-4" name="category" id="category">
                        <option value="All">All</option>
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

            <div class="col-12 public-quizzes-list">

                <!-- List of Public Quizzes -->

            </div>

        </div>

    </main>

    <script type="module" src="<?= base_url() ?>public/js/quizzes/handler.js"></script>

</body>

</html>