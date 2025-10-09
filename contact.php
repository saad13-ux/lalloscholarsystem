<?php session_start(); ?>
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

  <link href="resources/css/style.css" rel="stylesheet">
</head>

<script src="./resources/js/sweetalert.js"></script>
<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center">
      <img src="resources/images/lgulallo.png" height="50" width="50" style="margin-top: 5px;"> &nbsp;&nbsp;
      <h1 class="logo me-auto"><a href="contact.php">LGU LAL-LO</a></h1>

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
          <li><a href="contact.php" class="active"><span>Contact</span></a></li>

          <?php if (isset($_SESSION['user_id'])): ?>
            <!-- If user is logged in -->
            <li><a href="dashboard.php"><span>Dashboard</span></a></li>
            <li><a href="#" class="getstarted" data-bs-toggle="modal" data-bs-target="#logoutModal">Logout</a></li>
          <?php else: ?>
            <!-- If user is not logged in -->
            <li><a href="login.php"><span>Login</span></a></li>
            <li><a href="registrationform.php" class="getstarted">Apply Now</a></li>
          <?php endif; ?>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->
    </div>
  </header><!-- End Header -->

  <main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">
        <div class="d-flex justify-content-between align-items-center">
          <h2></h2>
          <ol>
            <li><a href="index.php">Home</a></li>
            <li>Contact</li>
          </ol>
        </div>
      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container-fluid">
        <div class="row">
          <!-- Google Map + Info -->
          <div class="col offset-md-1 col-md-4 col-sm-12">
            <iframe 
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3825.630718203683!2d121.6628504!3d18.2001467!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3386005cd5b78b43%3A0x4aa0d502f7f1514f!2sLal-lo%20Municipal%20Hall!5e0!3m2!1sen!2sph!4v1720709876543!5m2!1sen!2sph" 
              width="100%" height="270" style="border:0;" allowfullscreen="" loading="lazy"></iframe>

            <div class="info mt-3">
              <div class="address">
                <i class="bi bi-geo-alt"></i>
                <h4>Location:</h4>
                <p>P. Dupaya Street, Centro, Lal-lo, Philippines, 3509</p>
              </div>
              <div class="email">
                <i class="bi bi-envelope"></i>
                <h4>Email:</h4>
                <p>lgulallo1581@gmail.com</p>
              </div>
              <div class="phone">
                <i class="bi bi-phone"></i>
                <h4>Call:</h4>
                <p>0966 710 4073</p>
              </div>
            </div>
          </div>

          <!-- Feedback Form -->
          <div class="col offset-md-1 col-md-4 col-sm-12">
            <h2>Send a Feedback</h2>
            <hr>
            <form action="actions/action.send-feedback.php" method="POST" name="myForm" enctype="multipart/form-data" onsubmit="return checkForm(this)">
              <div class="form-group mt-3">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Your full name">
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" name="email" id="email" placeholder="Your email">
              </div>
              <div class="form-group">
                <label for="subject">Subject</label>
                <input type="text" class="form-control" name="subject" id="subject" placeholder="What is this about...">
              </div>
              <div class="form-group mb-3">
                <label for="body">Body</label>
                <textarea class="form-control" name="body" rows="5" id="body" placeholder="Tell us what you think..."></textarea>
              </div>
              <div class="card-footer d-flex justify-content-end">
                <input type="submit" class="btn btn-lg btn-primary" id="send_feedback" name="send_feedback" value="Send Feedback">
              </div>
            </form>
          </div>
        </div>
      </div>
    </section><!-- End Contact Section -->
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row gy-4">
          <!-- About -->
          <div class="col-lg-3 col-md-6 footer-info">
            <img src="resources/images/lgulallo.png" height="40" alt="Lallo Logo">
            <p class="mt-3">Empowering youth through accessible and transparent scholarship systems for a better future.</p>
            <div class="social-links mt-3">
              <a href="https://www.facebook.com/LguLalloCagayan/" class="facebook" target="_blank">
                <i class="bi bi-facebook"></i> LGU LALLO
              </a>
            </div>
          </div>
          <!-- Quick Links -->
          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Quick Links</h4>
            <ul>
              <li><i class="bi bi-chevron-right"></i> <a href="index.php">Home</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="profile.php">Profile</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="scholarship.php">Programs</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="contact.php">Contact</a></li>
            </ul>
          </div>
          <!-- Contact Info -->
          <div class="col-lg-3 col-md-6 footer-contact">
            <h4>Contact Us</h4>
            <p>
              P. Dupaya Street, Centro,<br>
              Lal-lo, Philippines, 3509<br><br>
              <strong>Email:</strong> lgulallo1581@gmail.com<br>
              <strong>Phone:</strong> 0966 710 4073<br>
            </p>
          </div>
          <!-- Logo -->
          <div class="col-lg-3 col-md-6 footer-info text-center">
            <img src="resources/images/evenbrighter.png" alt="LGU Lallo Logo" class="footer-logo">
          </div>
        </div>
      </div>
    </div>
    <div class="copyright">
      &copy; Copyright <strong><span>Scholarship</span></strong>. All Rights Reserved
    </div>
  </footer>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Logout Confirmation Modal -->
  <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content rounded-3 shadow">
        <div class="modal-header">
          <h5 class="modal-title" id="logoutModalLabel">Confirm Logout</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center">
          Are you sure you want to log out?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Vendor JS Files -->
  <script src="resources/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Template Main JS File -->
  <script src="resources/js/main.js"></script>

  <script type="text/javascript">
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

      if (document.myForm.name.value=="") {
        Toast.fire({ icon: 'warning', title: 'Please Provide Name' });
        document.myForm.name.focus();
        return false;
      }
      if (document.myForm.email.value=="") {
        Toast.fire({ icon: 'warning', title: 'Please Provide Email' });
        document.myForm.email.focus();
        return false;
      }
      if (document.myForm.subject.value=="") {
        Toast.fire({ icon: 'warning', title: 'Please Provide Subject' });
        document.myForm.subject.focus();
        return false;
      }
      if (document.myForm.body.value=="") {
        Toast.fire({ icon: 'warning', title: 'Please Provide Body' });
        document.myForm.body.focus();
        return false;
      }
    }
  </script>

</body>
<?php require 'includes/sweet-alert-toast.php'; ?>
</html>
