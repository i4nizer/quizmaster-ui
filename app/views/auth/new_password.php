<?php defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed'); ?>

<?php include APP_DIR . 'views/templates/head.php'; ?>

<body class="h-100">

    <main class="container-fluid h-100 d-flex justify-content-center align-items-center">

        <div class="col-10 col-md-8 col-lg-6 col-xxl-4">

            <div class="card">
                <div class="card-header fs-2 px-5 py-3 bg-success text-white d-flex justify-content-between align-items-center">
                    <span>Login</span>
                    <div class="card-actions">
                        <a class="text-white" href="/auth/register" title="Register"><i class="bi bi-person-plus-fill"></i></a>
                        <a class="text-white mx-2" href="/auth/login" title="Login"><i class="bi bi-box-arrow-in-right"></i></a>
                    </div>
                </div>
                <span class="valid-feedback" role="alert">
                    <strong>Note: Password must be at least 8 characters and contains one of this special characters (!@£$%^&*-_+=?), number, uppercase and lowercase letters.</strong>
                </span>
                <?php flash_alert(); ?>
                <form class="card-body p-5 d-flex flex-column" id="myForm" action="<?= site_url('auth/set-new-password'); ?>" method="post">
                    <?php csrf_field(); ?>
                    <input type="hidden" name="token" value="<?php !empty($_GET['token']) && print $_GET['token']; ?>">
                    <div class="mb-3">
                        <label for="password" class="fs-3">New Password</label>
                        <input id="password" type="password" class="form-control form-control-lg fs-3" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="fs-3">Confirm New Password</label>
                        <input id="re_password" type="password" class="form-control form-control-lg fs-3" name="re_password" required>
                    </div>
                    <div class="my-3">
                        <button type="submit" class="btn btn-lg btn-success w-100 py-3 fs-4">Proceed</button>
                    </div>
                </form>
            </div>

        </div>

    </main>

</body>

</html>