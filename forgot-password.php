<?php
require 'actions/action.forgot-pass.php'
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Scholarship | Forgot Password</title>
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
  <script src="./resources/js/sweetalert.js"></script>
  
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
    
    .instruction-text i {
      margin-right: 8px;
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
        <img src="resources/images/lgulallo.png" alt="LGU Lallo Logo">
        <h1><i class="fas fa-key mr-2"></i>FORGOT PASSWORD</h1>
      </div>
      <div class="card-body">
        <p class="login-box-msg">You forgot your password? Here you can easily set a new password.</p>
        
        <div class="instruction-text">
          <i class="fas fa-info-circle"></i>
          Enter your email to receive password reset instructions
        </div>
        
        <?php require 'includes/alert_error_success.php'?>
        
        <!-- EXACT SAME FORM STRUCTURE AS ORIGINAL -->
        <form action="#" method="post" name="myForm" enctype="multipart/form-data" onsubmit="return checkForm(this);">
          <div class="input-group mb-3">
            <input type="email" name="email" id="email" class="form-control" placeholder="Email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <!-- EXACT SAME BUTTON WITH ORIGINAL ONCLICK -->
              <button type="submit" class="btn btn-primary btn-block" onclick="return checkForm(this);">Request new password</button>
            </div>
          </div>
        </form>
        
        <div class="back-to-login">
          Remember account?
          <a href="login.php">Login</a>
        </div>
      </div>
    </div>
  </div>

  <!-- EXACT SAME JAVASCRIPT AS ORIGINAL -->
  <script type="text/javascript">
    function checkForm(form) {
      var emailID=document.myForm.email.value;
      atpos=emailID.indexOf("@");
      dotpos=emailID.lastIndexOf(".");
      if (atpos<1 || (dotpos - atpos<2)) {
        Toast.fire({
          icon: 'error',
          title: 'Please enter correct email id..'
        });
        document.myForm.email.focus();
        return false;
      }
    }
  </script>

  <script>
    // Add some minor UX enhancements without changing functionality
    $(document).ready(function() {
      // Focus on email field when page loads
      $('#email').focus();
      
      // Add enter key submission
      $('#email').keypress(function(e) {
        if (e.which === 13) {
          $('form').submit();
        }
      });
    });
    
    // Initialize Toast (same as your original)
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
</html>