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
        body, html {
            height: 100%;
            margin: 0;
            background-color: #e0f2f1; /* light green background */
            font-family: 'Nunito', sans-serif;
            overflow: hidden; /* Prevent scrolling */
        }
        .main-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Full viewport height */
        }
        .content-container {
            display: flex;
            align-items: center;
        }
        .logo-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-right: 40px; /* space between logo and form */
        }
        .logo-img {
            max-width: 200px;
        }
        .card {
            background-color: #ffffff;
            border: 1px solid #1b5e20; /* Dark green border */
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(27, 94, 32, 0.1);
        }
        .card-header {
            font-size: 28px;
            font-weight: bold;
            color: #1b5e20; /* Dark green */
            text-align: center;
        }
        .btn-primary {
            background-color: #388e3c; /* Green matching logo */
            border: none;
            font-weight: bold;
        }
        .register-link {
            color: #1b5e20; /* Dark green */
        }
    </style>
</head>
<body>
    <?php include APP_DIR.'views/templates/nav_auth.php'; ?>

    <main class="main-container">
        <!-- Content Container with Logo and Form -->
        <div class="content-container">
            <!-- Logo Container -->
            <div class="logo-container">
                <img src="<?=base_url();?>public/images/logo.png" alt="QuizMaster Logo" class="logo-img">
            </div>

            <!-- Login Form Container -->
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
                                <div class="invalid-feedback" id="emailError">Please enter a valid email address.</div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input id="password" type="password" class="form-control" name="password" minlength="8" required autocomplete="current-password">
                                <div class="invalid-feedback" id="passwordError">Password is required and should be at least 8 characters long.</div>
                            </div>
                            
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Play Now</button>
                            </div>
                            
                            <div class="text-center mt-3">
                                <a href="<?=site_url('auth/password-reset');?>" class="text-decoration-none">Forgot Password?</a>
                            </div>

                            <div class="text-center mt-3">
                                <span>Don't have an account? </span>
                                <a href="register" class="register-link">Register</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    <!-- Bootstrap Bundle with Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
