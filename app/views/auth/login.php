<?php defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed'); ?>

<?php include APP_DIR . 'views/templates/head.php'; ?>

<body class="h-100">

    <main class="container-fluid h-100 d-flex justify-content-center align-items-center">

        <!-- Login Form Container -->
        <div class="col-10 col-md-8 col-lg-6 col-xxl-4">

            <div class="card h-auto">
                <div class="card-header fs-2 px-5 py-3 bg-success text-white">Welcome to QuizMaster</div>

                <?= flash_alert() ?>
                <form class="card-body p-5 d-flex flex-column" id="logForm" method="POST" action="<?= site_url('auth/login'); ?>">

                    <?php csrf_field(); ?>

                    <div class="mb-3">
                        <label for="email" class="form-label fs-3">Email Address</label>
                        <?php $LAVA = &lava_instance(); ?>
                        <input id="email" type="email" class="form-control <?= $LAVA->session->flashdata('is_invalid'); ?> form-control-lg fs-3" name="email" required autocomplete="email" autofocus>
                        <div class="invalid-feedback" id="emailError">Please enter a valid email address.</div>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fs-3">Password</label>
                        <input id="password" type="password" class="form-control form-control-lg fs-4" name="password" minlength="8" required autocomplete="current-password">
                        <div class="invalid-feedback" id="passwordError">Password is required and should be at least 8 characters long.</div>
                    </div>

                    <div class="mb-3 px-2 d-flex justify-content-between fs-5">
                        <a href="<?= site_url('auth/password-reset'); ?>" class="text-decoration-none">Forgot Password?</a>
                        <span>Don't have an account? <a href="/auth/register" class="register-link">Register</a></span>
                    </div>

                    <div class="my-3">
                        <button type="submit" class="btn btn-lg btn-success w-100 py-3 fs-4">Play Now</button>
                    </div>

                </form>
            </div>

        </div>

    </main>

</body>

</html>