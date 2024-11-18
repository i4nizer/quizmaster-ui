<?php include APP_DIR . 'views/templates/head.php'; ?>

<body>
    <div id="app">
        <?php include APP_DIR . 'views/templates/header.php'; ?>
        <?php include APP_DIR . 'views/templates/drawer.php'; ?>
        <main class="mt-3 pt-3">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">Profile</div>
                            <div class="card-body">

                                <!-- Profile Image -->
                                <!-- <img src="https://img/profile" alt="Profile Picture" class="profile-img mb-3"> -->

                                <!-- User Details -->
                                <h2 class="mb-0">John Doe</h2>
                                <p class="text-muted">@johndoe</p>

                                <!-- Contact Information -->
                                <p>Email: johndoe@example.com</p>
                                <p>Joined: January 2023</p>

                                <!-- Social Icons -->
                                <div class="social-icons">
                                    <a href="#" target="_blank"><i class="bi bi-twitter"></i></a>
                                    <a href="#" target="_blank"><i class="bi bi-linkedin"></i></a>
                                    <a href="#" target="_blank"><i class="bi bi-github"></i></a>
                                </div>

                                <!-- Action Buttons -->
                                <div class="d-flex justify-content-center mt-4">
                                    <button class="btn btn-primary me-2">Follow</button>
                                    <button class="btn btn-outline-secondary">Message</button>
                                </div>
                            </div>
                        </div>

                        <!-- Quizzes User Created -->
                        <div class="card mt-3">
                            <div class="card-header">Your Quizzes</div>
                            <div class="card-body d-flex flex-column ">

                                <!-- Quiz Creation Form -->
                                <?php include APP_DIR . 'views/templates/quiz/create_form.php'; ?>

                                <!-- Quiz List -->
                                <?php include APP_DIR . 'views/templates/quiz/quiz_list.php'; ?>

                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-header">Your Rank</div>
                            <div class="card-body">
                                Your rank in the leaderboards
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="<?= base_url(); ?>public/js/quiz.js"></script>

</body>

</html>