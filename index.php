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
  <link href="resources/images/lgulallo.png" rel="icon">
  <link href="resources/images/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans|Raleway|Poppins" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="resources/plugins/animate.css/animate.min.css" rel="stylesheet">
  <link href="resources/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="resources/plugins/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="resources/css/style.css" rel="stylesheet">



  <style>
    .features {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      padding: 60px 20px;
      background: #f8f9fa;
      gap: 20px;
    }
    .feature-card {
      text-align: center;
      padding: 30px;
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      width: 280px;
    }
    .feature-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
    }
    .feature-card img {
      width: 60px;
      margin-bottom: 15px;
    }
   
    .stats-section {
    background: #eef1f6;
    padding: 60px 20px;
    text-align: center;
  }

  .stats-title {
    font-size: 2rem;
    font-weight: 600;
    color: #2b4b3f;
    margin-bottom: 40px;
  }

  .stats-card {
    background: #fff;
    border-radius: 12px;
    padding: 30px 20px;
    margin-bottom: 20px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .stats-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 24px rgba(0,0,0,0.15);
  }

  .counter {
    font-size: 48px;
    font-weight: bold;
    color: #1d4d3f;
    margin-bottom: 10px;
  }

  .stats-card p {
    font-size: 1.1rem;
    color: #555;
    margin: 0;
  }

  /* Reveal effect */
  .reveal {
    opacity: 0;
    transform: translateY(30px);
    transition: all 0.8s ease-in-out;
  }
  .reveal.active {
    opacity: 1;
    transform: translateY(0);
  }

/* How to Apply Section */
.apply-section {
  background-color: #f8f9fa;
  padding: 5rem 0;
  position: relative;
  overflow: hidden;
}

.section-title {
  font-size: 2.5rem;
  font-weight: 700;
  color: #212529;
  margin-bottom: 1rem;
}

.section-subtitle {
  font-size: 1.1rem;
  color: #6c757d;
  max-width: 600px;
  line-height: 1.6;
}

.steps-container {
  position: relative;
  padding: 2rem 0;
}

.steps-connector {
  position: absolute;
  top: 50%;
  left: 0;
  right: 0;
  height: 3px;
  background: linear-gradient(90deg, rgba(58,123,213,0.2), rgba(0,210,255,0.2));
  z-index: 1;
  transform: translateY(-50%);
}

.apply-step {
  background-color: white;
  border-radius: 12px;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
  text-align: center;
  padding: 2rem 1.5rem;
  transition: all 0.3s ease;
  height: 100%;
  position: relative;
  z-index: 2;
  border: 1px solid rgba(0, 0, 0, 0.03);
}

.apply-step:hover {
  transform: translateY(-8px);
  box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
}

.step-number {
  position: absolute;
  top: -15px;
  left: 50%;
  transform: translateX(-50%);
  width: 30px;
  height: 30px;
  background: linear-gradient(135deg, #239b57ff, #48bd48ff);
  color: white;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: bold;
  font-size: 0.9rem;
  box-shadow: 0 3px 10px rgba(58, 213, 104, 0.3);
}

.step-icon-container {
  width: 80px;
  height: 80px;
  margin: 0 auto 1.5rem;
  display: flex;
  align-items: center;
  justify-content: center;
  background: linear-gradient(135deg, rgba(58,123,213,0.1), rgba(0,210,255,0.1));
  border-radius: 50%;
  padding: 1rem;
}

.step-icon {
  width: 40px !important;
  height: 40px !important;
  object-fit: contain;
}

.step-content h4 {
  font-size: 1.25rem;
  font-weight: 600;
  margin-bottom: 0.75rem;
  color: #212529;
}

.step-content p {
  font-size: 0.95rem;
  color: #6c757d;
  line-height: 1.5;
  margin-bottom: 0;
}

.apply-cta {
  background: linear-gradient(135deg, #39f167ff, #06831dff);
  border: none;
  padding: 0.75rem 2rem;
  font-weight: 500;
  border-radius: 50px;
  box-shadow: 0 5px 15px rgba(3, 126, 21, 0.3);
  transition: all 0.3s ease;
}

.apply-cta:hover {
  transform: translateY(-3px);
  box-shadow: 0 8px 20px rgba(3, 158, 70, 0.73);
}

/* Responsive Styles */
@media (max-width: 992px) {
  .steps-connector {
    display: none;
  }
  
  .apply-step {
    margin-bottom: 2rem;
  }
}

@media (max-width: 768px) {
  .section-title {
    font-size: 2rem;
  }
  
  .section-subtitle {
    font-size: 1rem;
  }
  
  .step-icon-container {
    width: 70px;
    height: 70px;
  }
  
  .step-icon {
    width: 35px !important;
    height: 35px !important;
  }
}

@media (max-width: 576px) {
  .apply-section {
    padding: 3rem 0;
  }
  
  .section-title {
    font-size: 1.75rem;
  }
  
  .apply-step {
    padding: 1.5rem 1rem;
    max-width: 300px;
    margin: 0 auto 1.5rem;
  }
  
  .step-content h4 {
    font-size: 1.1rem;
  }
  
  .step-content p {
    font-size: 0.9rem;
  }
  
  .apply-cta {
    padding: 0.6rem 1.5rem;
    font-size: 0.95rem;
  }
}
  </style>
</head>

<body>

    <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center">
      <img src="resources/images/lgulallo.png" height="50" width="50" style="margin-top: 5px;"> &nbsp;&nbsp;
      <h1 class="logo me-auto"><a href="index.php">LGU LAL-LO </a></h1>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="index.php" class="active"><span>Home</span></a></li>
          <li><a href="scholarship.php">Assistance</a></li>
          <li class="dropdown"><a href="#"><span>About</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="profile.php">Profile</a></li>
              <li><a href="history.php">History</a></li>
              <li><a href="vision.php">Vision | Mission</a></li>
            </ul>
          </li>
          <li><a href="contact.php"><span>Contact</span></a></li>

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
      </nav>
    </div>
  </header>



  

  <!-- ======= Hero Section ======= -->
  <section id="hero">
  <div id="heroCarousel" data-bs-interval="7000" class="carousel slide carousel-fade" data-bs-ride="carousel">

    <div class="carousel-indicators" id="hero-carousel-indicators">
      <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>

    <div class="carousel-inner">

      <!-- Slide 1 -->
      <div class="carousel-item active" style="background-image: url('resources/images/lallol.jpg');">
        <div class="carousel-container d-flex align-items-center justify-content-center">
          <div class="container text-center">
            <h1 class="display-4 fw-bold text-white animate__animated animate__fadeInDown">Welcome to LGU LAL-LO Scholarship Assistance Tracking System </h1>
            <p class="lead text-white animate__animated animate__fadeInUp mt-3">Empowering students through a secure and accessible system.</p>
            <a href="registrationform.php" class="btn btn-lg btn-success mt-4 animate__animated animate__fadeInUp">Apply Now</a>
          </div>
        </div>
      </div>

      <!-- Slide 2 -->
      <div class="carousel-item" style="background-image: url('resources/images/back.png');">
        <div class="carousel-container d-flex align-items-center justify-content-center">
          <div class="container text-center">
            <h1 class="display-4 fw-bold text-white animate__animated animate__fadeInDown">Transparent & Fair Selection</h1>
            <p class="lead text-white animate__animated animate__fadeInUp mt-3">Track your progress and stay informed in real-time.</p>
            <a href="scholarship.php" class="btn btn-outline-light btn-lg mt-4 animate__animated animate__fadeInUp">Learn More</a>
          </div>
        </div>
      </div>

      <!-- Slide 3 -->
      <div class="carousel-item" style="background-image: url('resources/images/back1.jpg');">
        <div class="carousel-container d-flex align-items-center justify-content-center">
          <div class="container text-center">
            <h1 class="display-4 fw-bold text-white animate__animated animate__fadeInDown">Built for Students</h1>
            <p class="lead text-white animate__animated animate__fadeInUp mt-3">Modern design, mobile-ready, and simple to use.</p>
           <a href="#features" class="btn btn-outline-light btn-lg mt-4 animate__animated animate__fadeInUp">Explore Features</a>
          </div>
        </div>
      </div>

    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>

    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>

  </div>
</section>
<section class="achievements-news-section">
  <div class="container">
    <h2 class="section-title text-center mb-4 animate__animated animate__fadeInUp">Achievements</h2>
    <p class="text-center mb-5 animate__animated animate__fadeInUp">
      Discover how our scholarship programs make a real difference.
    </p>
    <div class="row gy-4">

      <div class="col-lg-4 col-md-6">
        <div class="news-card animate__animated animate__fadeInUp">
          <img src="resources/images/nseap01.jpg" alt="NSEAP Payout" class="img-fluid">
          <div class="news-content">
            <h4 class="news-title">TINANGGAP NG MAHIGIT 500 ESTUDYANTE ANG TULONG MULA NSEAP</h4>
            <p class="news-text">Sa kanyang talumpati, binigyang diin ni Mayor Pascual ang kahalagahan ng edukasyon. Umaasa rin aniya ang kanyang administrasyon na sa pamamagitan ng ganitong programa ay mas marami pang matulungang mag-aaral dito sa bayan. </p>
            <a href="https://www.facebook.com/LguLalloCagayan/posts/pfbid0pZouh6hgzSwBZeYg5oMjhQNbHUdwhzwkjGnvjA6uzjp424CM4JTWJexdHVAFkFfwl" target="_blank" class="read-more">Read More</a>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-6">
        <div class="news-card animate__animated animate__fadeInUp animate__delay-1s">
          <img src="resources/images/lallopayout.jpg" alt="Educational Assistance" class="img-fluid">
          <div class="news-content">
            <h4 class="news-title">LGU LAL-LO Assists 550 Students Through NSEAP</h4>
            <p class="news-text">Mayor Pascual and Vice Mayor Olive Pascual express continued support for scholarship programs, benefiting Lal-loqueno students.</p>
            <a href="https://www.facebook.com/LguLalloCagayan/posts/pfbid0qDhoDigBcnnfvPTYuVsYgJD9avNLAgtgqSGB8CxoLfd9VPsuTemg3n2pZqd3LYHNl" target="_blank" class="read-more">Read More</a>
          </div>
        </div>
      </div>

     <div class="col-lg-4 col-md-6">
        <div class="news-card animate__animated animate__fadeInUp animate__delay-1s">
          <img src="resources/images/news3.jpg" alt="Educational Assistance" class="img-fluid">
          <div class="news-content">
            <h4 class="news-title">LGU LAL-LO AWARDS FINANCIAL SUPPORT TO TOP STUDENTS, NSEAP BENEFICIARIES</h4>
            <p class="news-text">The Local Government Unit (LGU) of Lal-lo, initiated by Mayor Florante “Anteng” C. Pascual, CPA, awarded financial assistance to Latin honor recipients of the Nueva Segovia Educational Assistance Program (NSEAP) and Special Program for Employment of Students (SPES) beneficiaries</p>
            <a href="https://www.facebook.com/LguLalloCagayan/posts/pfbid05maAVRh6EoLt28o48ahu1ueBLApCpQz3sc7iHfvmj1L6FZbPK3xz5Y8R8UTjPtidl" target="_blank" class="read-more">Read More</a>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>



<section class="objectives-grid-section">
  <div class="container">
    <h2 class="section-title animate__animated animate__fadeInDown">Our Objectives</h2>

    <div class="objectives-grid">

      <div class="objective-item animate__animated animate__fadeInUp animate__delay-1s">
        <img src="resources/images/portal.png" alt="Scholarship Portal Icon">
        <div class="objective-text">
          <h4>Empower Students</h4>
          <p>Provide students with an intuitive, mobile-friendly platform for applying, tracking, and managing scholarships.</p>
        </div>
      </div>

      <div class="objective-item animate__animated animate__fadeInUp animate__delay-2s">
        <img src="resources/images/work.png" alt="Workflow Icon">
        <div class="objective-text">
          <h4>Simplify Workflow</h4>
          <p>Streamline application screening, eligibility checks, and reviewer coordination to save time and reduce workload.</p>
        </div>
      </div>

      <div class="objective-item animate__animated animate__fadeInUp animate__delay-3s">
        <img src="resources/images/impact.png" alt="Impact Icon">
        <div class="objective-text">
          <h4>Maximize Impact</h4>
          <p>Ensure transparency and fairness while helping more scholars through data-driven tracking and streamlined processes.</p>
        </div>
      </div>

    </div>
  </div>
</section>

<section id="features" class="features reveal">
  <div class="container text-center">
    <h2 class="section-title animate__animated animate__fadeInDown">Key Features</h2>


    <div class="row justify-content-center gy-4 gx-4 mt-4">

      <div class="col-lg-4 col-md-6 d-flex justify-content-center">
        <div class="feature-card animate__animated animate__fadeInUp">
          <img src="resources/images/copywriting.png" alt="Easy Application Icon">
          <h3>Easy Application</h3>
          <p>Apply online in just a few steps using a student-friendly interface.</p>
        </div>
      </div>

      <div class="col-lg-4 col-md-6 d-flex justify-content-center">
        <div class="feature-card animate__animated animate__fadeInUp animate__delay-1s">
          <img src="resources/images/bar-chart.png" alt="Real-Time Tracking Icon">
          <h3>Real-Time Tracking</h3>
          <p>Track your application status.</p>
        </div>
      </div>

      <div class="col-lg-4 col-md-6 d-flex justify-content-center">
        <div class="feature-card animate__animated animate__fadeInUp animate__delay-2s">
          <img src="resources/images/mail.png" alt="Feedback Icon">
          <h3>Feedback Support</h3>
          <p>Need help? Reach out anytime and get support from our team.</p>
        </div>
      </div>

      <div class="col-lg-4 col-md-6 d-flex justify-content-center">
        <div class="feature-card animate__animated animate__fadeInUp animate__delay-3s">
          <img src="resources/images/account.png" alt="Security Icon">
          <h3>Secure Account</h3>
          <p>Protect your personal information with encrypted and secure access.</p>
        </div>
      </div>

      <div class="col-lg-4 col-md-6 d-flex justify-content-center">
        <div class="feature-card animate__animated animate__fadeInUp animate__delay-4s">
          <img src="resources/images/compliant.png" alt="Report Icon">
          <h3>Private Document Storage </h3>
          <p>Uploaded files are securely stored and only viewable by authorized staff.</p>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ======= How to Apply Section ======= -->
<section class="apply-section py-5" id="how-to-apply">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="section-title animate__animated animate__fadeInDown">How to Apply</h2>
      <p class="section-subtitle mx-auto">Follow these simple steps to complete your scholarship application</p>
    </div>

    <div class="steps-container">
      <div class="row justify-content-center g-4">
        <!-- Step 1 -->
        <div class="col-lg-3 col-md-6">
          <div class="apply-step animate__animated animate__fadeInUp animate__delay-1s">
            <div class="step-number">1</div>
            <div class="step-icon-container">
              <img src="resources/images/contract.png" alt="Sign Up" class="step-icon" loading="lazy">
            </div>
            <div class="step-content">
              <h4>Create Account</h4>
              <p>Register with your valid information to begin the process</p>
            </div>
          </div>
        </div>

        <!-- Step 2 -->
        <div class="col-lg-3 col-md-6">
          <div class="apply-step animate__animated animate__fadeInUp animate__delay-2s">
            <div class="step-number">2</div>
            <div class="step-icon-container">
              <img src="resources/images/requirement.png" alt="Upload Requirements" class="step-icon" loading="lazy">
            </div>
            <div class="step-content">
              <h4>Submit Documents</h4>
              <p>Upload all required documents for verification</p>
            </div>
          </div>
        </div>

        <!-- Step 3 -->
        <div class="col-lg-3 col-md-6">
          <div class="apply-step animate__animated animate__fadeInUp animate__delay-3s">
            <div class="step-number">3</div>
            <div class="step-icon-container">
              <img src="resources/images/file.png" alt="Wait for Evaluation" class="step-icon" loading="lazy">
            </div>
            <div class="step-content">
              <h4>Application Review</h4>
              <p>Our team will carefully evaluate your submission</p>
            </div>
          </div>
        </div>

        <!-- Step 4 -->
        <div class="col-lg-3 col-md-6">
          <div class="apply-step animate__animated animate__fadeInUp animate__delay-4s">
            <div class="step-number">4</div>
            <div class="step-icon-container">
              <img src="resources/images/fireworks.png" alt="Get Approved" class="step-icon" loading="lazy">
            </div>
            <div class="step-content">
              <h4>Receive Approval</h4>
              <p>Get notified about your scholarship status</p>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Connecting line for visual flow -->
      <div class="steps-connector"></div>
    </div>
    
    <!-- CTA Button -->
    <div class="text-center mt-5 animate__animated animate__fadeIn">
      <a href="scholarship.php" class="btn btn-primary btn-lg apply-cta">
        Start Your Application
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" class="ms-2">
          <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
        </svg>
      </a>
    </div>
  </div>
</section>


<!-- ======= Statistics Section ======= -->
<section class="stats-section reveal">
  <div class="container">
    <h2 class="stats-title">Our Impact</h2>
    <div class="row justify-content-center">
      
      <div class="col-6 col-md-4">
        <div class="stats-card animate__animated animate__fadeInUp">
          <h3 class="counter">550+</h3>
          <p>Scholars Assisted</p>
        </div>
      </div>
      
      <div class="col-6 col-md-4">
        <div class="stats-card animate__animated animate__fadeInUp animate__delay-1s">
          <h3 class="counter">1000+</h3>
          <p>Total Aid Distributed</p>
        </div>
      </div>
      
    </div>
  </div>
</section>



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

<!-- ===== Logout Confirmation Modal ===== -->
  <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content rounded-3 shadow">
        <div class="modal-header">
          <h5 class="modal-title" id="logoutModalLabel">Confirm Logout</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Are you sure you want to log out?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>
      </div>
    </div>
  </div>


  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="resources/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="resources/js/main.js"></script>

  <!-- Reveal Animation Script -->
  <script>
    window.addEventListener('scroll', () => {
      document.querySelectorAll('.reveal').forEach(el => {
        const top = el.getBoundingClientRect().top;
        const windowHeight = window.innerHeight;
        if (top < windowHeight - 100) {
          el.classList.add('active');
        }
      });
    });
  </script>

<script>
window.addEventListener('scroll', () => {
  document.querySelectorAll('.reveal').forEach(el => {
    const top = el.getBoundingClientRect().top;
    const windowHeight = window.innerHeight;
    if (top < windowHeight - 100) {
      el.classList.add('active');
    }
  });
});
</script>








</body>

</html>
