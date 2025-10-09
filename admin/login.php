<?php
require './actions/action.login.php';
if ($_SESSION[$session_username] ?? false) {
    header('location: dashboard.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Scholarship | Admin Log in</title>
    <link href="../resources/images/lgulallo.png" rel="icon">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="../resources/js/sweetalert.js"></script>
    <style>
        :root {
            --primary-color: #10b981;
            --primary-dark: #0da271;
            --secondary-color: #059669;
        }
        
        body {
            font-family: 'Source Sans Pro', sans-serif;
            background: linear-gradient(135deg,rgba(5, 73, 51, 0.4), rgba(0, 75, 51, 0.28)), url('../resources/images/lallol.jpg') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            margin: 0;
        }
        
        .login-box {
            width: 100%;
            max-width: 400px;
        }
        
        .login-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 16px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.25);
        }
        
        .card-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            padding: 30px 20px 20px;
            text-align: center;
            border-bottom: none;
            position: relative;
            overflow: hidden;
        }
        
        .card-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, transparent 30%, rgba(255,255,255,0.1) 50%, transparent 70%);
            animation: shimmer 3s infinite linear;
        }
        
        .card-header img {
            width: 80px;
            height: 80px;
            margin-bottom: 15px;
            border-radius: 50%;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
            border: 3px solid rgba(255, 255, 255, 0.4);
            position: relative;
            z-index: 1;
        }
        
        .card-header h1 {
            color: white;
            font-size: 1.8rem;
            font-weight: 700;
            margin: 0;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            position: relative;
            z-index: 1;
        }
        
        .card-body {
            padding: 30px;
        }
        
        .login-box-msg {
            text-align: center;
            color: #212529;
            margin-bottom: 25px;
            font-size: 1rem;
            font-weight: 400;
        }
        
        .input-group {
            margin-bottom: 20px;
        }
        
        .form-control {
            height: 50px;
            border-radius: 10px;
            border: 2px solid #e9ecef;
            padding: 10px 15px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(16, 185, 129, 0.25);
        }
        
        .input-group-text {
            background: white;
            border: 2px solid #e9ecef;
            border-left: none;
            border-radius: 0 10px 10px 0;
        }
        
        .input-group-prepend .input-group-text {
            border-right: none;
            border-radius: 10px 0 0 10px;
        }
        
        .toggle-password {
            background: white !important;
            border: 2px solid #e9ecef !important;
            border-left: none !important;
            border-radius: 0 10px 10px 0;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .toggle-password:hover {
            background: #f8f9fa !important;
        }
        
        .toggle-password .fas {
            color: #6c757d !important;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border: none;
            border-radius: 10px;
            height: 50px;
            font-size: 1.1rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
            position: relative;
            overflow: hidden;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
            background: linear-gradient(135deg, var(--primary-dark), var(--secondary-color));
        }
        
        .btn-primary:active {
            transform: translateY(0);
        }
        
        .icheck-primary input[type="checkbox"]:checked + label::before {
            background-color: var(--primary-color);
            border-color: var(--primary-dark);
        }
        
        .forgot-password {
            text-align: center;
            margin-top: 20px;
        }
        
        .forgot-password a {
            color: var(--primary-color);
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s ease;
            font-weight: 500;
        }
        
        .forgot-password a:hover {
            color: var(--secondary-color);
            text-decoration: underline;
        }
        
        @keyframes shimmer {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }
        
        .swal-wide {
            width: 300px !important;
        }
        
        @media (max-width: 576px) {
            .login-box {
                max-width: 100%;
            }
            
            .card-body {
                padding: 25px 20px;
            }
        }
    </style>
</head>

<body class="hold-transition login-page">

    <div class="login-box">
        <div class="login-card card">
            <div class="card-header">
                <img src="../resources/images/lgulallo.png" alt="LGU Lallo Logo">
                <h1><i class="fas fa-user-shield mr-2"></i>ADMIN LOGIN</h1>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>
                <?php require './includes/alert_error_success.php'; ?>
                
                <!-- EXACT SAME FORM STRUCTURE AS ORIGINAL -->
                <form action="#" method="post" name="myForm" enctype="multipart/form-data" onsubmit="return checkForm(this);">
                    <div class="input-group mb-3">
                        <input type="text" name="username" id="username" class="form-control" placeholder="Username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text toggle-password" id="togglePassword" style="cursor: pointer;">
                                <span class="fas fa-eye"></span>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <div class="col-4">
                            <!-- EXACT SAME BUTTON NAME AND ID -->
                            <button type="submit" name="login_admin" id="name" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                    </div>
                </form>

                <div class="forgot-password">
                    <a href="forgot-password.php">Forgot password? Click here</a>
                </div>
            </div>
        </div>
    </div>

    <?php require '../includes/sweet-alert-toast.php'; ?>

    <!-- EXACT SAME JAVASCRIPT AS ORIGINAL -->
    <script type="text/javascript">
        var Toast = Swal.mixin({
            toast: true,
            position: "top",
            showConfirmButton: false,
            timer: 3000,
        });

        $(document).on('click', '#name', function () {
            var username = $('#username').val();
            var password = $('#password').val();
        
            if (username === "") {
                Toast.fire({
                    icon: 'warning',
                    title: 'Please Provide Username'
                });
                return false;
            }
            if (password === "") {
                Toast.fire({
                    icon: 'warning',
                    title: 'Please Provide Password'
                });
                return false;
            }
        });

        // toggle password
        document.getElementById('togglePassword').addEventListener('click', function () {
            var passwordField = document.getElementById('password');
            var icon = this.querySelector('span');
            if (passwordField.type === "password") {
                passwordField.type = "text";
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = "password";
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    </script>

    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>

</body>
</html>