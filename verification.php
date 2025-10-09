<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Email Verification</title>
    <link href="resources/images/lgulallo.png" rel="icon">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="resources/js/sweetalert.js"></script>
    
    <style>
        :root {
            --primary-color: #10b981;
            --primary-dark: #0da271;
            --secondary-color: #059669;
        }
        
        body {
            font-family: 'Source Sans Pro', sans-serif;
            background: linear-gradient(135deg, rgba(5, 73, 51, 0.4), rgba(0, 75, 51, 0.28)), url('resources/images/lallol.jpg') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            margin: 0;
            position: relative;
        }
        
        .login-box {
            width: 100%;
            max-width: 400px;
            display: none;
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
            line-height: 1.5;
        }
        
        .input-group {
            margin-bottom: 25px;
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
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
            background: linear-gradient(135deg, var(--primary-dark), var(--secondary-color));
        }
        
        .back-to-login {
            text-align: center;
            margin-top: 25px;
        }
        
        .back-to-login a {
            color: var(--primary-color);
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s ease;
            font-weight: 500;
        }
        
        .back-to-login a:hover {
            color: var(--secondary-color);
            text-decoration: underline;
        }
        
        .instruction-text {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.2);
            border-radius: 8px;
            padding: 12px 15px;
            margin-bottom: 20px;
            font-size: 0.85rem;
            color: var(--secondary-color);
            text-align: center;
        }
        
        #openFormButton {
            background:green;
            border: none;
            border-radius: 12px;
            padding: 16px 32px;
            font-size: 1.2rem;
            font-weight: 600;
            color: white;
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.4);
            transition: all 0.3s ease;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        
        #openFormButton:hover {
            transform: translate(-50%, -50%) translateY(-3px);
            box-shadow: 0 12px 30px rgba(16, 185, 129, 0.5);
            background: linear-gradient(135deg, var(--primary-dark), var(--secondary-color));
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
            
            #openFormButton {
                padding: 14px 28px;
                font-size: 1.1rem;
            }
        }
    </style>
</head>

<body class="hold-transition login-page">
    <!-- Open Form Button -->
    <button class="btn btn-primary" id="openFormButton">
        <i class="fas fa-envelope mr-2"></i>Open Verification
    </button>

    <!-- Verification Form -->
    <div class="login-box">
        <div class="login-card card">
            <div class="card-header">
                <img src="resources/images/lgulallo.png" alt="LGU Lallo Logo">
                <h1><i class="fas fa-envelope mr-2"></i>EMAIL VERIFICATION</h1>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Enter the code sent to your email to verify your account.</p>
                
                <div class="instruction-text">
                    <i class="fas fa-shield-alt"></i>
                    Check your email for the verification code
                </div>
                
                <span id="alert">
                    <?php require 'includes/alert_error_success.php'; ?>
                </span>
                
                <form action="actions/action.verify_email.php" method="post">
                    <div class="input-group mb-3">
                        <input type="text" name="email_vcode" class="form-control" placeholder="Enter verification code..." required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-key"></span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" name="verify_email" class="btn btn-primary btn-block">
                                <i class="fas fa-check-circle mr-2"></i>Verify Account
                            </button>
                        </div>
                    </div>
                </form>
                
                <div class="back-to-login">
                    <a href="logout.php">
                        <i class="fas fa-sign-out-alt mr-1"></i>Logout
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            var openFormButton = document.getElementById('openFormButton');
            var loginBox = document.querySelector('.login-box');

            openFormButton.addEventListener('click', function(e) {
                e.preventDefault();
                loginBox.style.display = 'block';
                openFormButton.style.display = 'none';
            });
        });

        // Initialize Toast
        var Toast = Swal.mixin({
            toast: true,
            position: "top",
            showConfirmButton: false,
            timer: 3000,
        });
    </script>

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
</body>

<?php require 'includes/sweet-alert-toast.php'; ?>
</html>