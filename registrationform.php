<?php
session_start();
// require 'includes/check_session.php';
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
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>

  <script src="plugins/jquery/jquery.min.js"></script>
  <script src="./resources/js/sweetalert.js"></script>

  <style>
    :root {
      --primary-color: #10b981;
      --primary-dark: #0da271;
      --secondary-color: #059669;
    }

    .getstarted {
      background: blue;
    }

    .swal-wide {
      width: 300px !important;
    }

    /* Enhanced Registration Section */
    .registration-section {
     background: linear-gradient(135deg, rgba(5, 73, 51, 0.4), rgba(0, 75, 51, 0.28)), url('resources/images/lallol.jpg') no-repeat center center fixed;
      background-size: cover;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 100px 20px 20px 20px;
      margin: 0;
    }

    .registration-container {
      width: 100%;
      max-width: 500px;
    }

    .registration-card {
      background: rgba(255, 255, 255, 0.95);
      border-radius: 16px;
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
      overflow: hidden;
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.25);
    }

    .registration-header {
      background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
      padding: 25px 20px;
      text-align: center;
      border-bottom: none;
      position: relative;
      overflow: hidden;
    }

    .registration-header::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: linear-gradient(45deg, transparent 30%, rgba(255,255,255,0.1) 50%, transparent 70%);
      animation: shimmer 3s infinite linear;
    }

    .registration-header img {
      width: 70px;
      height: 70px;
      margin-bottom: 10px;
      border-radius: 50%;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
      border: 3px solid rgba(255, 255, 255, 0.4);
      position: relative;
      z-index: 1;
    }

    .registration-header h2 {
      color: white;
      font-size: 1.6rem;
      font-weight: 700;
      margin: 0;
      text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
      position: relative;
      z-index: 1;
    }

    .registration-body {
      padding: 25px;
    }

    .form-group {
      margin-bottom: 15px;
      position: relative;
    }

    .form-input {
      width: 100%;
      height: 45px;
      border-radius: 8px;
      border: 2px solid #e9ecef;
      padding: 10px 40px 10px 40px;
      font-size: 0.9rem;
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
      left: 12px;
      top: 50%;
      transform: translateY(-50%);
      color: #6c757d;
      font-size: 1.1rem;
      z-index: 2;
    }

    .toggle-password {
      position: absolute;
      right: 12px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
      background: none;
      border: none;
      color: #6c757d;
      font-size: 1.1rem;
      transition: color 0.3s ease;
      z-index: 2;
    }

    .toggle-password:hover {
      color: var(--primary-color);
    }

    .btn-register {
      background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
      border: none;
      border-radius: 8px;
      height: 45px;
      font-size: 1rem;
      font-weight: 600;
      letter-spacing: 0.5px;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
      width: 100%;
      color: white;
      cursor: pointer;
      margin-top: 10px;
    }

    .btn-register:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
      background: linear-gradient(135deg, var(--primary-dark), var(--secondary-color));
    }

    .btn-register:active {
      transform: translateY(0);
    }

    .login-link {
      text-align: center;
      margin-top: 20px;
    }

    .login-link a {
      color: var(--primary-color);
      text-decoration: none;
      font-size: 0.9rem;
      transition: color 0.3s ease;
      font-weight: 500;
    }

    .login-link a:hover {
      color: var(--secondary-color);
      text-decoration: underline;
    }

    .password-requirements {
      background: rgba(16, 185, 129, 0.1);
      border: 1px solid rgba(16, 185, 129, 0.2);
      border-radius: 8px;
      padding: 12px 15px;
      margin-bottom: 15px;
      font-size: 0.8rem;
      color: var(--secondary-color);
    }

    .password-requirements ul {
      margin: 5px 0;
      padding-left: 20px;
    }

    .password-requirements li {
      margin-bottom: 3px;
    }

    @keyframes shimmer {
      0% { transform: translateX(-100%); }
      100% { transform: translateX(100%); }
    }

    @media (max-width: 576px) {
      .registration-container {
        max-width: 100%;
      }
      
      .registration-body {
        padding: 20px 15px;
      }
      
      .registration-header h2 {
        font-size: 1.4rem;
      }
      
      .registration-section {
        padding: 80px 15px 15px 15px;
      }
    }

    /* Fix for header overlap */
    body {
      padding-top: 70px;
    }

    .registration-section {
      min-height: calc(100vh - 70px);
    }

    /* Custom toast height */
    .custom-toast-height {
      height: 80px;
      line-height: 80px;
    }
  </style>
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center">
      <img src="resources/images/lgulallo.png" height="50" width="50" style="margin-top: 5px;"> &nbsp;&nbsp;
      <h1 class="logo me-auto"><a href="registrationForm.php">LGU LAL-LO</a></h1>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="index.php"><span>Home</span></a></li>
          <li><a href="scholarship.php"><span>Assistance</span></a></li>
          <li class="dropdown"><a href="#"><span>About</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="profile.php">Profile</a></li>
              <li><a href="history.php">History</a></li>
              <li><a href="vision.php">Vision | Mission</a></li>
            </ul>
          </li>
          <li><a href="contact.php"><span>Contact</span></a></li>
          <li><a href="login.php"><span>Login</span></a></li>
          <li><a href="registrationform.php" class="getstarted">Apply Now</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->
    </div>
  </header><!-- End Header -->

  <section class="registration-section">
    <div class="registration-container">
      <div class="registration-card">
        <div class="registration-header">
          <img src="resources/images/lgulallo.png" alt="LGU Lallo Logo">
          <h2><i class="bi bi-person-plus-fill mr-2"></i>CREATE ACCOUNT</h2>
        </div>
        <div class="registration-body">
          <?php require 'includes/sweet-alert-toast.php'; ?>
          
          <div class="password-requirements">
            <strong>Password Requirements:</strong>
            <ul>
              <li>Contains uppercase & lowercase letters</li>
              <li>Includes numbers and special characters</li>
            </ul>
          </div>

          <!-- EXACT SAME FORM STRUCTURE WITH ORIGINAL FUNCTIONALITY -->
          <form id="registration-form" target="frame" action="#" method="POST" name="myForm" enctype="multipart/form-data" onsubmit="return checkForm(this);">
            <div class="form-group">
              <i class="bi bi-person-fill input-icon"></i>
              <input type="text" class="form-input" placeholder="Username" id="username" name="username">
            </div>

            <div class="form-group">
              <i class="bi bi-lock-fill input-icon"></i>
              <input type="password" class="form-input" placeholder="Password" id="password" name="password">
              <i class="bi bi-eye-slash toggle-password" data-target="#password"></i>
            </div>

            <div class="form-group">
              <i class="bi bi-key-fill input-icon"></i>
              <input type="password" class="form-input" placeholder="Confirm Password" id="Npassword" name="Npassword">
              <i class="bi bi-eye-slash toggle-password" data-target="#Npassword"></i>
            </div>

            <div class="form-group">
              <i class="bi bi-envelope-fill input-icon"></i>
              <input type="email" class="form-input" placeholder="Email" id="email" name="email">
            </div>

            <div class="form-group">
              <i class="bi bi-person-badge-fill input-icon"></i>
              <input type="text" class="form-input" placeholder="First Name" id="first_name" name="first_name">
            </div>

            <div class="form-group">
              <i class="bi bi-person-badge-fill input-icon"></i>
              <input type="text" class="form-input" placeholder="Last Name" id="last_name" name="last_name">
            </div>

            <input type="hidden" name="status" id="status" value="1">
            
            <div class="form-group">
              <!-- EXACT SAME BUTTON WITH ORIGINAL ONCLICK -->
              <button type="submit" class="btn-register" id="sign" name="sign" onclick="return checkForm(this);">
                SIGN UP
              </button>
            </div>
          </form>

          <div class="login-link">
            Already have an account? <a href="login.php">Login</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- EXACT SAME JAVASCRIPT AS ORIGINAL -->
  <script>
    // Password toggle functionality - EXACT SAME AS ORIGINAL
    $(document).on('click', '.toggle-password', function() {
      let target = $($(this).data('target'));
      let type = target.attr('type') === 'password' ? 'text' : 'password';
      target.attr('type', type);
      $(this).toggleClass('bi-eye bi-eye-slash');
    });

    // Form submission handler - EXACT SAME AS ORIGINAL
    $(document).ready(function() {
      $("form").submit(function(event) {
        event.preventDefault();
        var username = $("#username").val();
        var password = $("#password").val();
        var Npassword = $("#Npassword").val();
        var email = $("#email").val();
        var first_name = $("#first_name").val();
        var last_name = $("#last_name").val();
        var sign = $("#sign").val();

        var Toast = Swal.mixin({
          toast: true,
          position: "top",
          showConfirmButton: false,
          timer: 3000,
        });

        $.post("actions/action.user.php", {
          username: username,
          password: password,
          Npassword: Npassword,
          email: email,
          first_name: first_name,
          last_name: last_name,
          sign: sign
        })
        .done(function(response) {
          var data = JSON.parse(response);
          if (data.success) {
            Toast.fire({
              icon: 'success',
              title: data.success
            });
            setTimeout(() => {
              window.location.href = 'login.php';
            }, 1500);
          } else if (data.error) {
            Toast.fire({
              icon: 'error',
              title: data.error
            });
          }
        });
      });
    });

    // Form validation function - EXACT SAME AS ORIGINAL
    function checkForm(form) {
      var Toast = Swal.mixin({
        toast: true,
        position: "top",
        showConfirmButton: false,
        timer: 3000,
        customClass: {
          content: 'text-center',
          heightAuto: 'custom-toast-height'
        }
      });

      if (document.myForm.username.value=="") {
        Toast.fire({
          icon: 'warning',
          title: 'Please Provide Username'
        });
        document.myForm.username.focus();
        return false;
      }

      if (document.myForm.password.value=="") {
        Toast.fire({
          icon: 'warning',
          title: 'Please Provide Password'
        });
        document.myForm.password.focus();
        return false;
      }

      if (document.myForm.password.value < 6) {
        Toast.fire({
          icon: 'warning',
          title: 'Password must be at least 6 characters long'
        });
        document.myForm.password.focus();
        return false;
      }

      if (document.myForm.password.value != "" && document.myForm.Npassword.value != document.myForm.password.value) {
        Toast.fire({
          icon: 'warning',
          title: 'Password Not Matched'
        });
        document.myForm.Npassword.focus();
        return false;
      }
      
      var emailID=document.myForm.email.value;
      atpos=emailID.indexOf("@");
      dotpos=emailID.lastIndexOf(".");
      if (atpos<1 || (dotpos - atpos<2)) {
        Toast.fire({
          icon: 'warning',
          title: 'Please Enter Correct Email ID.'
        });
        document.myForm.email.focus();
        return false;
      }

      if (document.myForm.first_name.value=="") {
        Toast.fire({
          icon: 'warning',
          title: 'Please Provide First Name'
        });
        document.myForm.first_name.focus();
        return false;
      }

      if (document.myForm.last_name.value=="") {
        Toast.fire({
          icon: 'warning',
          title: 'Please Provide Last Name'
        });
        document.myForm.last_name.focus();
        return false;
      }
      
      re = /[0-9]/;
      if (!re.test(document.myForm.password.value)) {
        Toast.fire({
          icon: 'warning',
          title: 'Password Must Contain Atleast One Number.'
        });
        document.myForm.password.focus();
        return false;
      }

      re = /[A-Z]/;
      if (!re.test(document.myForm.password.value)){
        Toast.fire({
          icon: 'warning',
          title: 'Password Must Contain Atleast One Uppercase Letter.'
        });
        document.myForm.password.focus();
        return false;
      }

      re = /[a-z]/;
      if (!re.test(document.myForm.password.value)) {
        Toast.fire({
          icon: 'warning',
          title: 'Password Must Contain Atleast One Lowercase Letter.'
        });
        document.myForm.password.focus();
        return false;
      }

      re = /[@#$&*_+,./]/;
      if(!re.test(document.myForm.password.value)){
        Toast.fire({
          icon: 'warning',
          title: 'Password Must Contain Atleast One Special Characters.'
        });
        document.myForm.password.focus();
        return false;
      }
    }
  </script>

  <!-- Vendor JS Files -->
  <script src="resources/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Template Main JS File -->
  <script src="resources/js/main.js"></script>

</body>
</html>