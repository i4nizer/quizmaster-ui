<?php defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed'); ?>

<?php include APP_DIR . 'views/templates/head.php'; ?>

<body class="h-100">

    <main class="container-fluid h-100 d-flex justify-content-center align-items-center">

        <div class="col-10 col-md-8 col-lg-6 col-xxl-4">

            <div class="card">
                <div class="card-header fs-2 px-5 py-3 bg-success text-white d-flex justify-content-between align-items-center">
                    <span>Reset Password</span>
                    <div class="card-actions">
                        <a class="text-white" href="/auth/register" title="Register"><i class="bi bi-person-plus-fill"></i></a>
                        <a class="text-white mx-2" href="/auth/login" title="Login"><i class="bi bi-box-arrow-in-right"></i></a>
                    </div>
                </div>
                <form class="card-body p-5 d-flex flex-column" method="POST" action="<?= site_url('auth/password-reset'); ?>">
                    <?php csrf_field(); ?>
                    <div class="mb-3">
                        <label for="email" class="fs-3">Email Address</label>
                        <?php $LAVA = &lava_instance(); ?>
                        <input id="email" type="email" class="form-control form-control-lg fs-4 <?= $LAVA->session->flashdata('alert'); ?>" name="email" required>
                        <span class="invalid-feedback" role="alert"><strong>We can't find a user with that email address.</strong></span>
                        <span class="valid-feedback" role="alert"><strong>Reset password link was sent to your email.</strong></span>
                    </div>
                    <div class="my-3">
                        <button type="submit" class="btn btn-lg btn-success w-100 py-3 fs-4">Send Password Reset Link</button>
                    </div>
                </form>
            </div>

        </div>

    </main>

</body>

</html>