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
</head>

<style>
  /* Scholarship Programs Section */
.scholarship-programs {
  padding: 80px 0;
  background-color: #f8faf9;
}

.section-header {
  text-align: center;
  margin-bottom: 50px;
}

.section-header h1 {
  font-size: 36px;
  font-weight: 800;
  color: #0a3b19;
  margin-bottom: 10px;
  text-transform: uppercase;
}

.subtitle {
  font-size: 18px;
  font-weight: 500;
  color: #4a6b5b;
  letter-spacing: 1px;
}

.program-content {
  display: flex;
  gap: 40px;
  align-items: center;
}

.history-section {
  flex: 1;
}

.text-content h2 {
  font-size: 28px;
  color: #0a8c3e;
  margin-bottom: 25px;
  position: relative;
  padding-bottom: 10px;
}

.text-content h2::after {
  content: '';
  position: absolute;
  left: 0;
  bottom: 0;
  width: 60px;
  height: 3px;
  background: linear-gradient(90deg, #0a8c3e, #6fd649);
}

.text-content p {
  font-size: 16px;
  line-height: 1.8;
  color: #333;
  margin-bottom: 20px;
}

.highlight-box {
  background-color: #f0f8f3;
  border-left: 4px solid #0a8c3e;
  padding: 25px;
  margin: 30px 0;
  border-radius: 0 8px 8px 0;
  position: relative;
}

.quote-icon {
  position: absolute;
  top: 15px;
  left: 15px;
  font-size: 42px;
  font-weight: 700;
  color: rgba(10, 140, 62, 0.2);
  line-height: 1;
}

.highlight-text {
  font-style: italic;
  color: #0a3b19;
  font-weight: 500;
  font-size: 17px;
  padding-left: 20px;
  margin: 0;
}

.stats-section {
  display: flex;
  gap: 20px;
  margin-top: 40px;
}

.stat-card {
  flex: 1;
  background: white;
  padding: 25px 20px;
  border-radius: 8px;
  text-align: center;
  box-shadow: 0 5px 15px rgba(0,0,0,0.05);
  transition: all 0.3s ease;
}

.stat-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 25px rgba(0,0,0,0.1);
}

.stat-value {
  font-size: 28px;
  font-weight: 700;
  color: #0a8c3e;
  margin-bottom: 5px;
}

.stat-label {
  font-size: 15px;
  color: #555;
  font-weight: 500;
}

.scholars-image {
  flex: 1;
  position: relative;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 15px 30px rgba(0,0,0,0.1);
}

.featured-image {
  width: 100%;
  height: auto;
  display: block;
  transition: transform 0.5s ease;
}

.scholars-image:hover .featured-image {
  transform: scale(1.03);
}

.image-caption {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  background: rgba(0,0,0,0.7);
  color: white;
  padding: 15px;
  font-size: 15px;
  text-align: center;
}

/* Responsive Design */
@media (max-width: 992px) {
  .program-content {
    flex-direction: column;
  }
  
  .scholars-image {
    width: 100%;
    margin-top: 40px;
  }
  
  .stats-section {
    justify-content: center;
  }
}

@media (max-width: 768px) {
  .section-header h1 {
    font-size: 30px;
  }
  
  .subtitle {
    font-size: 16px;
  }
  
  .text-content h2 {
    font-size: 24px;
  }
  
  .stat-card {
    padding: 20px 15px;
  }
  
  .stat-value {
    font-size: 24px;
  }
}

@media (max-width: 576px) {
  .stats-section {
    flex-direction: column;
    gap: 15px;
  }
  
  .highlight-box {
    padding: 20px 15px 20px 25px;
  }
  
  .quote-icon {
    font-size: 36px;
  }
}
</style>
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
              <li><a href="history.php"class="active"><span>History</span></a></li>
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
          <li>History</li>
        </ol>
      </div>
    </div>
  </section><!-- End Breadcrumbs -->

<section id="about" class="about">
  <div class="container">
    <div class="section-title text-center">
      <h2>HISTORY OF LAL-LO</h2>
      <p>Discover the rich past of our municipality</p>
    </div>
    <div class="row content align-items-center">
      <div class="col-lg-6 animate__animated animate__fadeInLeft">
        <img src="resources/images/lal.jpg" alt="Lal-lo Shines Logo" class="history-image">
      </div>
      <div class="col-lg-6 animate__animated animate__fadeInUp">
        <div class="history-card">
          <p>
            Lal-lo, officially the Municipality of Lal-Lo (Ibanag: Ili nat Lal-lo; Ilocano: Ili ti Lal-lo; Tagalog: Bayan ng Lal-lo), is a 1st class municipality in the province of Cagayan, Philippines. According to the 2015 census, it has a population of 44,506 people. During the Spanish colonial period, Lal-lo was known as Ciudad de Nueva Segovia and was the seat of the Diocese of Nueva Segovia before it was moved to Vigan in Ilocos Sur.
          </p>
          <p>
            The Municipality of Lal-lo is one of the first four cities in the Philippines. Others are Cebu (1565); Manila (1571); and Naga (1575). Lal-lo (formerly named Nueva Segovia) for a time enjoyed the lavish gifts of the Papal Throne. It was named Nueva Segovia by Juan Pablo Carreon in 1581. It was visited by Juan Salcedo in 1572 and Luis Perez Dasmariñas in 1592. Because of its navigable river, it was chosen the capital of Cagayan Valley.
          </p>
          <p>
            It was also the seat of the Diocese created by Pope Clement VIII on August 15, 1595, until the seat was transferred to Vigan, Ilocos Sur in 1755. It was the capital of Cagayan up to 1839 when the Provincial Government was moved to Tuguegarao. Miguel Buenavides, O. P., a very famous personage among the missionaries at that time, was elected bishop to the diocesan home in Nueva Segovia. He later founded the University of Santo Tomas.
          </p>
          <p>
            <b>Lal-lo means "twisting two strands to make a rope", or may also refer to the strong river current as it is located along the Cagayan River, the longest and largest river in the Philippines.</b>
          </p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ======= Scholarship Programs Section ======= -->
<section id="scholarship-programs" class="scholarship-programs">
  <div class="container">
    <div class="section-header">
      <h1>EDUCATIONAL ASSISTANCE</h1>
      <p class="subtitle">COMPREHENSIVE EDUCATIONAL SUPPORT FOR THE YOUTH OF LAL-LO</p>
    </div>

    <div class="program-content">
      <div class="history-section">
        <div class="text-content">
          <h2>History of Nueva Segovia Educational Assistance Program</h2>
          <p>The <strong>Nueva Segovia Educational Assistance Program (NSEAP)</strong> is a program providing educatinal assistance in the municipality of Lal-lo Cagayan</p>
          
         
          
          <div class="highlight-box">
            <div class="quote-icon">"</div>
            <p class="highlight-text"> Ang pag-aaral o edukasyon ay pamanang hindi makukuha o maaagaw ninuman, ang kaunting tulong na ito
          ay malaking ambag o bagay na iyan sa inyong pag-aaral kung iuukol niyo ito sa tamang pamamaraan </p>
          </div>
        </div>
        
        <div class="stats-section">
          <div class="stat-card">
            <div class="stat-value">2020</div>
            <div class="stat-label">Program Started</div>
          </div>
          <div class="stat-card">
            <div class="stat-value">550+</div>
            <div class="stat-label">Beneficiaries</div>
          </div>
        </div>
      </div>
      
      <div class="scholars-image">
        <img src="resources/images/scholar5.jpg" alt="NSEAP scholars attending classes" class="featured-image">
        <div class="image-caption">Nueva Segovia Educational Assistance Program Scholars </div>
      </div>
    </div>
  </div>
</section>




  <!-- ======= Footer ======= -->
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
          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Quick Links</h4>
            <ul>
              <li><i class="bi bi-chevron-right"></i> <a href="index.php">Home</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="profile.php">Profile</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="scholarship.php">Programs</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="contact.php">Contact</a></li>
            </ul>
          </div>

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
  </footer><!-- End Footer -->

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
  <script src="resources/js/main.js"></script>

</body>

</html>
