<?php
// Always start the session at the very top
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

  <link href="resources/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Sailor - v4.9.1
  * Template URL: https://bootstrapmade.com/sailor-free-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

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
              <li><a href="vision.php"class="active"> <span>Vision | Mission</span></a></li>
            </ul>
          </li>
          <li><a href="contact.php">Contact</a></li>

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


  <!-- ======= Breadcrumbs ======= -->
  <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2></h2>
          <ol>
            <li><a href="index.php">Home</a></li>
            <li>About</li>
            <li>Vision |Mission </li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

<!-- ======= Vision & Mission Section ======= -->
<section id="vision-mission" class="vision-mission-section">
  <div class="container">
    <div class="section-title text-center">
      <h2>VISION & MISSION</h2>
      <p>Our guiding purpose and promise for the people of Lal-lo</p>
    </div>
    <div class="row align-items-center">
      <div class="col-lg-6 mb-4 mb-lg-0 animate__animated animate__fadeInLeft">
        <img src="resources/images/laloq.jpg" alt="Lal-lo Shines" class="vm-image">
        
      </div>
      <div class="col-lg-6 animate__animated animate__fadeInUp">
        <div class="vm-card">
          <h4 class="vm-heading"><i class="bi bi-eye-fill"></i> Vision</h4>
          <p class="vm-text">"Lal-lo (City of Nueva Segovia, 1595), eco-tourism destination and hub od commerce and trade in the North.
        Where empowered and God-loving citizenry live under an atmosphere of peace, prosperity ans sustainable,
      ecologically-based environment, guided by a dynamic, transparent and committed leadership."</p>
          <h4 class="vm-heading mt-4"><i class="bi bi-bullseye"></i> Mission</h4>
          <p class="vm-text"> - Formulate appropriate LGU development investment plans, reorient existing land use and town plan,
                and enact compatible zoning ordinances supportive of initiatives to sustain development of the town as a center point of customer trade and commerce, including eco-tourism of the province;
              <br>
               <br>
                - Enhance productive capability of manpower resources thru sustained human resource training programs on employable technical skills, package of technologies for crop/livestock farming system, and entrepreneurable livelihood skills thru family-based approach;
                 <br>
                  <br>
                - Develop local resources in order to ensure sufficiency in food production and efficiency in the delivery of basic services;
                <br>
                 <br>
                 - Provide the requisite infrastructure for sustainable growth and development;
                  <br>
                   <br>
                  - Judiciously protect , conserve and rehabilitate the reaming physical and natural resourcesof Lal-lo and to encourage the development of industries that will serve the needs of its constituents. </p>
         </div>
      </div>
    </div>
  </div>
</section>
<!-- End Vision & Mission Section -->




 
  <footer id="footer">
  <div class="footer-top">
    <div class="container">
      <div class="row gy-4">

         <div class="col-lg-3 col-md-6 footer-info">
  <img src="resources/images/lgulallo.png" height="40" alt="Lallo Logo">
  <p class="mt-3">
    Empowering youth through accessible and transparent scholarship systems for a better future.
  </p>
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

       <!-- Logo Only (Bigger) -->
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

</body>

</html>