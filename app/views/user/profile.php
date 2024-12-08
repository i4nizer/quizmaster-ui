<?php defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed'); ?>

<?php include APP_DIR . 'views/templates/head.php'; ?>

<body>
    <?php include APP_DIR . 'views/templates/sidenav.php'; ?>

    <main class="py-5 h-100" style="margin-left: 100px;">
        <div class="content px-5 h-100">
            <div class="row gy-3">
                <!-- Edit Profile Modal -->
                <div class="modal fade" id="edit-profile-modal" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header px-4">
                                <span class="modal-title fs-3">Edit Profile</span>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-4">
                                <form class="edit-profile-form d-flex flex-column gap-3">
                                    <div class="fs-4">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" class="form-control fs-4" id="username" name="username" placeholder="Enter your username" value="<?= $user['username'] ?>" required>
                                    </div>
                                    <button type="submit" class="btn btn-lg btn-primary align-self-end fs-4 w-25">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Show Username and Gmail Here -->
                <div class="col-12">
                    <div class="card px-5 py-3 w-100">
                        <div class="card-body d-flex gap-5 align-items-center">
                            <div class="card-text text-primary" style="font-size: 5rem;">
                                <i class="bi bi-person-circle"></i>
                            </div>
                            <div class="card-text w-100 d-flex flex-column justify-content-center">
                                <span class="fs-1 username"><?= $user['username'] ?></span>
                                <span class="fs-4"><?= $user['email'] ?></span>
                            </div>
                            <button class="btn px-4 fs-3 btn-lg btn-primary btn-profile-edit" data-bs-toggle="modal" data-bs-target="#edit-profile-modal">Edit</button>
                        </div>
                    </div>
                </div>

                <!-- Links to Create Quiz & Manage Quizzes -->
                <div class="col-12 col-lg-6">
                    <div class="card h-100">
                        <div class="card-body p-5 d-flex justify-content-between gap-3">
                            <div class="card-text w-50">
                                <div class="card-text d-flex align-items-center px-2 gap-2">
                                    <span class="text-success" style="font-size: 4rem;"><i class="bi bi-lightbulb"></i></span>
                                    <div class="card-text fs-3 text-center">Create Quizzes</div>
                                </div>
                                <a class="btn btn-lg btn-success fs-4 px-4 w-100" href="/user/quizzes#quizform">Create</a>
                            </div>
                            <div class="card-text w-50">
                                <div class="card-text d-flex align-items-center px-2 gap-2">
                                    <span class="text-info" style="font-size: 4rem;"><i class="bi bi-dice-3"></i></span>
                                    <div class="card-text fs-3 text-center">Manage Quizzes</div>
                                </div>
                                <a class="btn btn-lg btn-info fs-4 px-4 w-100" href="/user/quizzes#user-quizzes">Manage</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quiz Statistics -->
                <div class="col-12 col-lg-6">
                    <div class="card h-100">
                        <div class="card-body quiz-snapshot fs-4 p-5">
                            <div class="card-title fs-3 fw-bold">Quiz Snapshot</div>
                            <div class="card-text d-flex justify-content-between px-3">
                                <span>Completed:</span>
                                <span class="completed">0</span>
                            </div>
                            <div class="card-text d-flex justify-content-between px-3">
                                <span>Accuracy:</span>
                                <span class="accuracy">0%</span>
                            </div>
                            <div class="card-text d-flex justify-content-between px-3">
                                <span>Score Acquired:</span>
                                <span class="score-acquired">0</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- A Chart of Activity -->
                <div class="col-12">
                    <div class="card w-100">
                        <div class="card-body p-5">
                            <div class="card-text fs-3 fw-bold">Quiz Score Trend</div>
                            <div class="card-text mt-3">
                                <canvas id="quiz-score-trend"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="module" src="<?= base_url() ?>public/js/profile/handler.js"></script>


</body>

</html>