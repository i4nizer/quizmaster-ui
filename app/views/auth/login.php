<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>QuizMaster - Login</title>
    <link rel="icon" type="image/png" href="<?=base_url();?>public/img/favicon.ico"/>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet">
    
    <!-- Custom Styles -->
    <link href="<?=base_url();?>public/css/main.css" rel="stylesheet">
    <link href="<?=base_url();?>public/css/style.css" rel="stylesheet">
    <style>
        body {
            background: url('<?=base_url();?>public/img/quiz-background.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Nunito', sans-serif;
        }
        .card {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            font-size: 28px;
            font-weight: bold;
            color: #ff9800;
            text-align: center;
        }
        .btn-primary {
            background-color: #ff9800;
            border: none;
            font-weight: bold;
        }
        .btn-primary:hover {
            background-color: #e68900;
        }
        .invalid-feedback {
            display: block;
            color: #dc3545;
        }
    </style>
</head>
<body>
    <?php include APP_DIR.'views/templates/nav_auth.php'; ?>

    <main class="py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card p-4">
                        <div class="card-header">Welcome to QuizMaster</div>
                        <div class="card-body">
                            <?php flash_alert(); ?>
                            <form id="logForm" method="POST" action="<?=site_url('auth/login');?>">
                                <?php csrf_field(); ?>
                                
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email Address</label>
                                    <?php $LAVA =& lava_instance(); ?>
                                    <input id="email" type="email" class="form-control <?=$LAVA->session->flashdata('is_invalid');?>" name="email" required autocomplete="email" autofocus>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input id="password" type="password" class="form-control" name="password" minlength="8" required autocomplete="current-password">
                                </div>
                                
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary">Play Now</button>
                                </div>
                                
                                <div class="text-center mt-3">
                                    <a href="<?=site_url('auth/password-reset');?>" class="text-decoration-none">Forgot Password?</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    <!-- Bootstrap Bundle with Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.getElementById("logForm");
            form.addEventListener("submit", function(event) {
                const email = document.getElementById("email");
                const password = document.getElementById("password");
                let isValid = true;

                // Email Validation
                if (!email.value) {
                    email.classList.add("is-invalid");
                    isValid = false;
                } else {
                    email.classList.remove("is-invalid");
                }

                // Password Validation
                if (password.value.length < 8) {
                    password.classList.add("is-invalid");
                    isValid = false;
                } else {
                    password.classList.remove("is-invalid");
                }

                if (!isValid) {
                    event.preventDefault();  // Stop form from submitting if validation fails
                }
            });
        });
    </script>
</body>
</html>
