<?php defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed'); ?>

<?php include APP_DIR . 'views/templates/head.php'; ?>

<body class="h-100">

    <main class="container-fluid h-100 d-flex justify-content-center align-items-center">

        <div class="col-10 col-md-8 col-lg-6 col-xxl-4">

            <div class="card">
                <div class="card-header fs-2 px-5 py-3 bg-success text-white">Register</div>
                <form class="card-body p-5 d-flex flex-column" id="regForm" method="POST" action="<?= site_url('auth/register'); ?>">

                    <?php flash_alert(); ?>
                    <?php csrf_field(); ?>
                    <!-- Username -->
                    <div class="mb-3">
                        <label for="username" class="fs-3">Username</label>
                        <input id="username" type="text" class="form-control form-control-lg fs-4" name="username" required minlength="3" maxlength="20" pattern="[A-Za-z0-9_]+">
                        <div class="invalid-feedback">Must be 3-20 characters, letters, numbers, or underscores.</div>
                    </div>
                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="fs-3">Email Address</label>
                        <input id="email" type="email" class="form-control form-control-lg fs-4" name="email" required>
                        <div class="invalid-feedback">Please provide a valid email address.</div>
                    </div>
                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="fs-3">Password</label>
                        <input id="password" type="password" class="form-control form-control-lg fs-4" name="password" required minlength="8">
                        <div class="invalid-feedback">Password must be at least 8 characters long.</div>
                    </div>
                    <!-- Confirm Password -->
                    <div class="mb-3">
                        <label for="password_confirmation" class="fs-3">Confirm Password</label>
                        <input id="password_confirmation" type="password" class="form-control form-control-lg fs-4" name="password_confirmation" required minlength="8">
                        <div class="invalid-feedback">Please confirm your password.</div>
                    </div>
                    <!-- Links -->
                    <div class="mb-3 px-2 d-flex justify-content-between fs-5">
                        <a href="<?= site_url('auth/password-reset'); ?>" class="text-decoration-none">Forgot Password?</a>
                        <span>Already have an account? <a href="/auth/login" class="register-link">Login</a></span>
                    </div>
                    <!-- Submit -->
                    <div class="my-3">
                        <button type="submit" class="btn btn-lg btn-success w-100 py-3 fs-4">Register</button>
                    </div>
                </form>

            </div>

        </div>

    </main>

</body>

</html>