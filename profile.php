
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
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|Raleway:300,400,500,600,700|Poppins:300,400,500,600,700" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="resources/plugins/animate.css/animate.min.css" rel="stylesheet">
  <link href="resources/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="resources/plugins/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="resources/plugins/remixicon/remixicon.css" rel="stylesheet">

  <!-- Custom CSS -->
<style>
  /* Section title */
.section-title {
  margin-bottom: 10px;
}
.section-title h2 {
  font-size: 28px;
  font-weight: 700;
  color: #0a8c3e;
  margin-bottom: 10px;
  border: none;
}
.section-title h2::after,
.section-title h2::before {
  content: none !important;
}
.section-title p {
  font-size: 16px;
  color: #6c757d;
  margin-bottom: 30px;
}

/* Barangay badges */
.barangay-list h4 {
  font-size: 18px;
  color: #0a8c3e;
  margin-bottom: 10px;
  margin-top: 20px;
  font-weight: 600;
}
.barangay-list .badge {
  background-color: #e6f6f1;
  color: #0a8c3e;
  font-size: 13px;
  padding: 6px 10px;
  border-radius: 12px;
  display: inline-block;
  margin: 4px;
  font-weight: 500;
  box-shadow: inset 0 0 0 1px #cceae0;
}

/* Stat cards and accordion consistent rounded shapes */
.stat-card, .accordion-item {
  background: #fff;
  border: 1px solid #e0e0e0;
  border-radius: 12px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.08);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  padding: 20px;
  text-align: center;
}
.stat-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 16px rgba(0,0,0,0.12);
}
.stat-card i {
  font-size: 24px;
  color: #10b981;
  margin-bottom: 8px;
}
.stat-card h5 {
  font-size: 18px;
  margin-bottom: 4px;
}
.stat-card p {
  color: #6b7280;
  font-size: 14px;
}
/* Person in Charge Section Enhancements */
#person-in-charge {
  background: #f7fbf9; /* very light green background */
}

.section-title h2 {
  font-size: 28px;
  font-weight: 700;
  color: #0a8c3e;
  margin-bottom: 10px;
}
.section-title .underline {
  width: 60px;
  height: 4px;
  background: #0a8c3e;
  border-radius: 2px;
}
.section-title p {
  font-size: 16px;
  color: #6c757d;
  margin-bottom: 30px;
}

.person-card {
  background: #fff;
  border-radius: 12px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.08);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.person-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 16px rgba(0,0,0,0.12);
}

.person-img img {
  width: 160px;
  height: 160px;
  object-fit: cover;
  border-radius: 50%;
  border: 4px solid #e6f6f1;
  box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

/* Smooth fade-in on scroll (optional but nice) */
.animate__animated.animate__fadeInUp {
  animation-duration: 1s;
}

/* Mobile adjustments */
@media (max-width: 576px) {
  .person-card {
    padding: 20px;
  }
  .person-img img {
    width: 180px;
    height: 180px;
  }
}

/* Responsive flex layout for person card */
@media (min-width: 768px) {
  .person-card .row {
    display: flex;
    align-items: center;
  }

  .person-card .person-img {
    text-align: left;
  }

  .person-card .person-info {
    text-align: left;
  }
}

@media (max-width: 767px) {
  .person-card .person-img {
    text-align: center;
    margin-bottom: 1rem;
  }

  .person-card .person-info {
    text-align: center;
  }
}


/* FAQ section background & spacing */
#faq {
  background: #f7fbf9; /* very light green, matching person in charge */
}

/* Remove decorative underline completely */
.section-title .underline {
  display: none;
}


/* Accordion styling */
.accordion-item {
  border: none;
  border-radius: 12px !important;
  margin-bottom: 10px;
  box-shadow: 0 2px 6px rgba(0,0,0,0.05);
  background: #fff;
}
.accordion-button {
  border-radius: 12px !important;
  font-weight: 500;
  color: #333;
}
.accordion-button:not(.collapsed) {
  background-color: #e6f6f1;
  color: #0a8c3e;
  box-shadow: none;
}
.accordion-button::after {
  background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='%230a8c3e' viewBox='0 0 16 16'%3e%3cpath fill-rule='evenodd' d='M1.5 3.5a.5.5 0 0 1 .832-.374L8 8.293l5.668-5.167a.5.5 0 0 1 .664.748l-6 5.5a.5.5 0 0 1-.664 0l-6-5.5a.5.5 0 0 1-.168-.374z'/%3e%3c/svg%3e");
}
.accordion-body {
  font-size: 14px;
  color: #555;
}

/* Hover effect for button text */
.accordion-button:hover {
  color: #066d2e;
}

/* Responsive spacing */
@media (max-width: 576px) {
  .accordion-button {
    font-size: 14px;
    padding: 0.75rem 1rem;
  }
}

</style>


  
  <link href="resources/css/style.css" rel="stylesheet">
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
              <li><a href="profile.php"class="active"><span>Profile</span></a></li>
              <li><a href="history.php">History</a></li>
              <li><a href="vision.php">Vision | Mission</a></li>
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
        <li>Profile</li>
      </ol>
    </div>
  </div>
</section><!-- End Breadcrumbs -->

<!-- ======= About/Profile Section ======= -->
<section id="about" class="about">
  <div class="container">
    <div class="row align-items-center">

      <div class="col-lg-4 text-center mb-4 mb-lg-0 animate__animated animate__fadeInLeft">
        <img src="resources/images/lalloshines.jpg" alt="Lal-lo Shines Logo" class="img-fluid rounded shadow-sm">
      </div>

      <div class="col-lg-8 animate__animated animate__fadeInRight">
        <div class="section-title">
          <h2>About Lal-lo</h2>
          <br>
          <p>
            Lal-lo is a coastal municipality in the province of Cagayan. It has a land area of 702.80 square kilometers and a population of 48,733 as of the 2020 census. Historically, Lal-lo was one of the original four cities established by the Spanish in the Philippines.
          </p>
        </div>

        <div class="stats-cards row mt-4">
          <div class="col-md-4 mb-3">
            <div class="stat-card">
              <i class="bi bi-geo-alt-fill"></i>
              <h5>702.80 sq km</h5>
              <p>Land Area</p>
            </div>
          </div>
          <div class="col-md-4 mb-3">
            <div class="stat-card">
              <i class="bi bi-people-fill"></i>
              <h5>48,733</h5>
              <p>Population (2020)</p>
            </div>
          </div>
          <div class="col-md-4 mb-3">
            <div class="stat-card">
              <i class="bi bi-building"></i>
              <h5>35</h5>
              <p>Barangays</p>
            </div>
          </div>
        </div>

        <div class="barangay-list mt-4">
          <h4>Barangays:</h4>
          <span class="badge">Abagao</span>
          <span class="badge">Alaguia</span>
          <span class="badge">Bagumbayan</span>
          <span class="badge">Bangag</span>
          <span class="badge">Bical</span>
          <span class="badge">Bicud</span>
          <span class="badge">Binag</span>
          <span class="badge">Cabayabasan</span>
          <span class="badge">Cagoran</span>
          <span class="badge">Cambong</span>
          <span class="badge">Catayauan</span>
          <span class="badge">Catugan</span>
          <span class="badge">Centro</span>
          <span class="badge">Cullit</span>
          <span class="badge">Dagupan</span>
          <span class="badge">Dalaya</span>
          <span class="badge">Fabrica</span>
          <span class="badge">Fusina</span>
          <span class="badge">Jurisdiction</span>
          <span class="badge">Lalafugan</span>
          <span class="badge">Logac</span>
          <span class="badge">Magallungon</span>
          <span class="badge">Magapit</span>
          <span class="badge">Malanao</span>
          <span class="badge">Maxingal</span>
          <span class="badge">Naguilian</span>
          <span class="badge">Paranum</span>
          <span class="badge">Rosario</span>
          <span class="badge">San Antonio</span>
          <span class="badge">San Jose</span>
          <span class="badge">San Juan</span>
          <span class="badge">San Lorenzo</span>
          <span class="badge">San Mariano</span>
          <span class="badge">Santa Maria</span>
          <span class="badge">Tucalana</span>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- End About Section -->
<!-- Meet the Person in Charge -->
<section id="person-in-charge" class="py-5" style="background-color: #f0fdf5;">
  <div class="container">
    <h2 class="fw-bold text-center">Meet the Person in Charge</h2>
    <p class="text-muted text-center mb-5">
      Guiding the Scholarship Assistance Tracking System with dedication and vision.
    </p>

    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="card p-4 shadow-sm border-0">
          <div class="row align-items-center">
           
            <div class="col-md-4 text-center mb-4 mb-md-0">
              <img src="resources/images/lydo.jpg" alt="Renier Sinco" class="rounded-circle" width="140" height="140">
            </div>

            <!-- Content -->
            <div class="col-md-8 text-md-start text-center">
              <h4 class="fw-bold mb-1">Renier Sinco</h4>
              <p class="text-success fw-bold mb-3">Local Youth Development Officer (LYDO)</p>

              <p class="fst-italic text-muted">
                "Committed to ensuring transparent and accessible scholarship opportunities for the youth of Lal-lo. Every student deserves the chance to pursue their dreams through education."
              </p>

             

              

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>



<!-- ======= FAQ Section ======= -->
<section id="faq" class="faq py-5">
  <div class="container">
    <div class="section-title text-center mb-4">
      <h2>FAQS</h2>
      <div class="underline mx-auto mb-3"></div>
      <p>Quick answers to help you navigate the scholarship process.</p>
    </div>

    <div class="accordion" id="faqAccordion">
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
            <i class="bi bi-question-circle me-2 text-success"></i> Who can apply for the scholarship?
          </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
          data-bs-parent="#faqAccordion">
          <div class="accordion-body">
            Eligible students from Lal-lo municipality who meet the criteria. 
          </div>
        </div>
      </div>

      <div class="accordion-item">
        <h2 class="accordion-header" id="headingTwo">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            <i class="bi bi-file-earmark-text me-2 text-success"></i> What documents are required?
          </button>
        </h2>
        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
          data-bs-parent="#faqAccordion">
          <div class="accordion-body">
            For incoming 1st Year Form 137, Enrollment Form/Assesment Form , Certificate of Good Moral, and certificate of indigency.
             
          </div>
        </div>
      </div>

      <div class="accordion-item">
        <h2 class="accordion-header" id="headingThree">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
            <i class="bi bi-calendar-event me-2 text-success"></i> When is the application deadline?
          </button>
        </h2>
        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
          data-bs-parent="#faqAccordion">
          <div class="accordion-body">
            Deadlines are announced annually; please check the official LGU Lal-lo website or Facebook page.
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- End FAQ Section -->

<!-- ======= Still Have Questions Section ======= -->
<section id="contact-cta" class="py-5" style="background-color: #eafaf2;">
  <div class="container text-center">
    <h2 class="fw-bold mb-2">Still Have Questions?</h2>
    <p class="text-muted mb-5">
      Don’t worry! Our team is ready to help you with any concerns or clarifications about the scholarship.
    </p>

    <div class="card mx-auto shadow-sm p-4" style="max-width: 700px; border-radius: 1rem;">
      <div class="row align-items-center">
        <div class="col-md-4 text-center">
          <img src="resources/images/info.png" alt="Need Help" class="img-fluid" style="max-width: 100px;">
        </div>
        <div class="col-md-8 text-md-start text-center mt-3 mt-md-0">
          <h5 class="fw-bold mb-1">Let’s Talk!</h5>
          <p class="text-muted mb-3">Reach out through our contact page or visit our office for assistance.</p>
          <a href="contact.php" class="btn btn-success me-2 px-4">Contact Us</a>
          <a href="contact.php" class="btn btn-outline-success px-4">Visit Office</a>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- End Still Have Questions Section -->




<!-- ======= Footer ======= -->
<footer id="footer">
  <div class="footer-top">
    <div class="container">
      <div class="row gy-4">

        <!-- About -->
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
