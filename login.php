<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Scholarship</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="resources/images/lgulallo.png" rel="icon">
  <link href="resources/images/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="resources/plugins/animate.css/animate.min.css" rel="stylesheet">
  <link href="resources/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="resources/plugins/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="resources/css/login.css" rel="stylesheet">
  <link href="resources/css/style.css" rel="stylesheet">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="./resources/js/sweetalert.js"></script>

  <style>
    :root {
      --primary-color: #10b981;
      --primary-dark: #0da271;
      --secondary-color: #059669;
    }

    .form-group .err {
      color: yellow;
    }

    .getstarted {
      background: blue;
    }

    .swal-wide {
      width: 300px !important;
    }

    /* Enhanced Login Section - FIXED POSITIONING */
    .login-section {
      
      background: linear-gradient(135deg, rgba(5, 73, 51, 0.4), rgba(0, 75, 51, 0.28)), url('resources/images/lallol.jpg') no-repeat center center fixed;
      background-size: cover;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 100px 20px 20px 20px; /* Added top padding for header */
      margin: 0;
    }

    .login-container {
      width: 100%;
      max-width: 450px;
      margin-top: 0; /* Remove any top margin */
    }

    .login-card {
      background: rgba(255, 255, 255, 0.95);
      border-radius: 16px;
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
      overflow: hidden;
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.25);
    }

    .login-header {
      background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
      padding: 30px 20px;
      text-align: center;
      border-bottom: none;
      position: relative;
      overflow: hidden;
    }

    .login-header::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: linear-gradient(45deg, transparent 30%, rgba(255,255,255,0.1) 50%, transparent 70%);
      animation: shimmer 3s infinite linear;
    }

    .login-header img {
      width: 80px;
      height: 80px;
      margin-bottom: 15px;
      border-radius: 50%;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
      border: 3px solid rgba(255, 255, 255, 0.4);
      position: relative;
      z-index: 1;
    }

    .login-header h2 {
      color: white;
      font-size: 1.8rem;
      font-weight: 700;
      margin: 0;
      text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
      position: relative;
      z-index: 1;
    }

    .login-body {
      padding: 30px;
    }

    .form-group {
      margin-bottom: 20px;
      position: relative;
    }

    .form-input {
      width: 100%;
      height: 50px;
      border-radius: 10px;
      border: 2px solid #e9ecef;
      padding: 10px 45px 10px 45px;
      font-size: 1rem;
      transition: all 0.3s ease;
      box-sizing: border-box;
    }

    .form-input:focus {
      border-color: var(--primary-color);
      box-shadow: 0 0 0 0.2rem rgba(16, 185, 129, 0.25);
      outline: none;
    }

    .input-icon {
      position: absolute;
      left: 15px;
      top: 50%;
      transform: translateY(-50%);
      color: #6c757d;
      font-size: 1.2rem;
      z-index: 2;
    }

    .toggle-password {
      position: absolute;
      right: 15px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
      background: none;
      border: none;
      color: #6c757d;
      font-size: 1.2rem;
      transition: color 0.3s ease;
      z-index: 2;
    }

    .toggle-password:hover {
      color: var(--primary-color);
    }

    .btn-login {
      background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
      border: none;
      border-radius: 10px;
      height: 50px;
      font-size: 1.1rem;
      font-weight: 600;
      letter-spacing: 0.5px;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
      width: 100%;
      color: white;
      cursor: pointer;
    }

    .btn-login:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
      background: linear-gradient(135deg, var(--primary-dark), var(--secondary-color));
    }

    .btn-login:active {
      transform: translateY(0);
    }

    .login-links {
      text-align: center;
      margin-top: 20px;
    }

    .login-links a {
      color: var(--primary-color);
      text-decoration: none;
      font-size: 0.9rem;
      transition: color 0.3s ease;
      font-weight: 500;
    }

    .login-links a:hover {
      color: var(--secondary-color);
      text-decoration: underline;
    }

    @keyframes shimmer {
      0% { transform: translateX(-100%); }
      100% { transform: translateX(100%); }
    }

    @media (max-width: 576px) {
      .login-container {
        max-width: 100%;
      }
      
      .login-body {
        padding: 25px 20px;
      }
      
      .login-header h2 {
        font-size: 1.5rem;
      }
      
      .login-section {
        padding: 80px 15px 15px 15px;
      }
    }

    /* SIMPLIFIED FIX FOR HEADER OVERLAP */
    body {
      padding-top: 70px; /* Reduced padding */
    }

    .login-section {
      min-height: calc(100vh - 70px);
      padding-top: 30px; /* Additional top padding */
    }
  </style>
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center">
      <img src="resources/images/lgulallo.png" height="50" width="50" style="margin-top: 5px;"> &nbsp;&nbsp;
      <h1 class="logo me-auto"><a href="login.php">LGU LAL-LO</a></h1>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="index.php"><span>Home</span></a></li>
          <li><a href="scholarship.php">Assistance</a></li>
          <li class="dropdown"><a href="#"><span>About</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="profile.php">Profile</a></li>
              <li><a href="history.php">History</a></li>
              <li><a href="vision.php">Vision | Mission</a></li>
            </ul>
          </li>
          <li><a href="contact.php"><span>Contact</span></a></li>
          <li><a href="login.php" class="active"><span>Login</span></a></li>
          <li><a href="registrationform.php" class="getstarted">Apply Now</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->
    </div>
  </header><!-- End Header -->

  <section class="login-section">
    <div class="login-container">
      <div class="login-card">
        <div class="login-header">
          <img src="resources/images/lgulallo.png" alt="LGU Lallo Logo">
          <h2><i class="bi bi-person-check-fill mr-2"></i>USER LOGIN</h2>
        </div>
        <div class="login-body">
          <?php require 'includes/sweet-alert-toast.php'; ?>
          
          <form action="actions/action.login.php" method="POST" name="myForm" enctype="multipart/form-data" onsubmit="return checkForm(this);">
            <div class="form-group">
              <i class="bi bi-person-fill input-icon"></i>
              <input type="text" class="form-input" placeholder="Username" name="username" id="username" required>
            </div>
            
            <div class="form-group">
              <i class="bi bi-lock-fill input-icon"></i>
              <input type="password" class="form-input" placeholder="Password" name="password" id="password" required>
              <i class="bi bi-eye toggle-password" id="togglePassword"></i>
            </div>

            <input type="hidden" name="status" id="status" value="1">
            
            <div class="form-group">
              <button type="submit" class="btn-login" name="login_user" id="name">
                Sign In
              </button>
            </div>
          </form>

          <div class="login-links">
            <div style="margin-bottom: 10px;">
              Don't have an account? <a href="registrationform.php">Sign up now</a>
            </div>
            <div>
              Forgot Password? <a href="forgot-password.php">Click here</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script>
    // Password toggle functionality
    document.getElementById('togglePassword').addEventListener('click', function () {
      var passwordField = document.getElementById('password');
      var icon = this;
      if (passwordField.type === "password") {
        passwordField.type = "text";
        icon.classList.remove('bi-eye');
        icon.classList.add('bi-eye-slash');
      } else {
        passwordField.type = "password";
        icon.classList.remove('bi-eye-slash');
        icon.classList.add('bi-eye');
      }
    });

    // Initialize SweetAlert Toast
    var Toast = Swal.mixin({
      toast: true,
      position: "top",
      showConfirmButton: false,
      timer: 3000,
    });

    // Form validation function
    function checkForm(form) {
      var username = document.getElementById('username').value;
      var password = document.getElementById('password').value;
     
      if (username === "") {
        Toast.fire({
          icon: 'warning',
          title: 'Please Provide Username'
        });
        document.getElementById('username').focus();
        return false;
      }

      if (password === "") {
        Toast.fire({
          icon: 'warning',
          title: 'Please Provide Password'
        });
        document.getElementById('password').focus();
        return false;
      }
      
      return true;
    }

    // jQuery click handler
    $(document).ready(function() {
      $('#name').on('click', function(e) {
        return checkForm(this);
      });
      
      // Auto-focus on username field
      $('#username').focus();
    });
  </script>

  <!-- Vendor JS Files -->
  <script src="resources/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Template Main JS File -->
  <script src="resources/js/main.js"></script>

</body>
</html>