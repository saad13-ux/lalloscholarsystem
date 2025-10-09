<?php
session_start();
include('includes/pdo_conn.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Scholarship Assistance | LGU Lal-lo</title>
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

  <style>
    :root {
      --primary-color: #1e6b52;
      --primary-dark: #15533d;
      --primary-light: #2a9d78;
      --accent-color: #f9a826;
      --light-bg: #f8f9fa;
      --dark-text: #2f3e4e;
      --light-text: #6c757d;
      --white: #ffffff;
    }

    body {
      background-color: var(--light-bg);
      font-family: "Poppins", sans-serif;
      color: var(--dark-text);
      line-height: 1.6;
    }

    

    /* Scholarship Cards */
    .scholarship-section {
      padding: 60px 0;
    }

    .section-title {
      text-align: center;
      margin-bottom: 40px;
    }

    .section-title h2 {
      color: var(--primary-color);
      font-weight: 700;
      margin-bottom: 15px;
    }

    .section-title p {
      color: var(--light-text);
      max-width: 700px;
      margin: 0 auto;
    }

    .card {
      border: none;
      border-radius: 12px;
      overflow: hidden;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      height: 100%;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    }

    .card:hover {
      transform: translateY(-10px);
      box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
    }

    .card-img-container {
      height: 200px;
      overflow: hidden;
      background-color: #f1f1f1;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .card-img-top {
      width: 100%;
      height: 100%;
      object-fit: contain;
      object-position: center;
      background-color: #f8f9fa;
    }

    .card-body {
      padding: 25px;
    }

    .card-title {
      color: var(--primary-color);
      font-weight: 700;
      margin-bottom: 10px;
    }

    .amount {
      color: var(--primary-light);
      font-weight: 600;
      font-size: 1.2rem;
      margin-bottom: 15px;
    }

    .badge {
      font-size: 0.75rem;
      font-weight: 500;
      padding: 6px 10px;
      border-radius: 4px;
    }

    .badge-primary {
      background-color: var(--primary-color);
      color: white;
    }

    .badge-warning {
      background-color: var(--accent-color);
      color: var(--dark-text);
    }

    .requirements-list {
      padding-left: 20px;
      margin-bottom: 15px;
    }

    .requirements-list li {
      margin-bottom: 5px;
      color: var(--light-text);
    }

    .countdown {
      background-color: rgba(249, 168, 38, 0.1);
      padding: 10px;
      border-radius: 6px;
      margin-bottom: 15px;
    }

    .countdown-text {
      color: var(--dark-text);
      font-weight: 600;
      font-size: 0.9rem;
    }

    .btn-apply {
      background-color: var(--primary-color);
      color: white;
      border: none;
      border-radius: 30px;
      padding: 10px 20px;
      font-weight: 600;
      width: 100%;
      transition: all 0.3s ease;
    }

    .btn-apply:hover {
      background-color: var(--primary-light);
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(30, 107, 82, 0.3);
    }


    /* Modal */
    .modal-content {
      border-radius: 12px;
      border: none;
    }

    .modal-header {
      border-bottom: 1px solid #e9ecef;
    }

    .btn-danger {
      background-color: #dc3545;
      border: none;
    }

    /* Empty State */
    .empty-state {
      text-align: center;
      padding: 60px 20px;
    }

    .empty-state i {
      font-size: 4rem;
      color: var(--light-text);
      margin-bottom: 20px;
    }

    .empty-state h3 {
      color: var(--dark-text);
      margin-bottom: 15px;
    }

    .empty-state p {
      color: var(--light-text);
      max-width: 500px;
      margin: 0 auto 25px;
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
          <li><a href="index.php"><span>Home</span></a></li>
          <li><a href="scholarship.php" class="active"><span>Assistance</span></a></li>
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
  </header><!-- End Header -->

  <!-- ======= Breadcrumbs ======= -->
  <section id="breadcrumbs" class="breadcrumbs">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center">
        <h2>Scholarship Assistance</h2>
        <ol>
          <li><a href="index.php">Home</a></li>
          <li>Assistance</li>
        </ol>
      </div>
    </div>
  </section><!-- End Breadcrumbs -->

  <!-- ======= Scholarship Section ======= -->
  <section id="scholarship" class="scholarship-section">
    <div class="container">
      <div class="section-title">
        <h2>Available Scholarships</h2>
        <p>Explore our current scholarship opportunities. Apply now and take the first step towards your educational goals.</p>
      </div>

      <div class="row g-4">
        <?php
        $sql = "SELECT s.scholarship_id, s.scholarship_type, s.image_filename, s.amount, s.description, s.start_date, s.end_date,
                GROUP_CONCAT(rd.requirement_name SEPARATOR ', ') AS concatenated_value
                FROM scholarship AS s
                INNER JOIN requirement_data AS rd ON s.scholarship_id = rd.scholarship_id
                WHERE s.end_date >= NOW()
                GROUP BY s.scholarship_id
                ORDER BY s.scholarship_id DESC;";
        $result = $pdo->query($sql);
        $scholarshipCount = $result->rowCount();

        if ($scholarshipCount > 0) {
          while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $formattedDate = date('F d, Y h:i:s A', strtotime($row['end_date']));
            $imagePath = "resources/image/" . $row['image_filename'];
            $defaultImagePath = "resources/image/default.jpg";
        ?>
            <div class="col-lg-4 col-md-6 col-sm-12">
              <div class="card shadow-sm h-100">
                <div class="card-img-container">
                  <img src="<?= file_exists($imagePath) ? $imagePath : $defaultImagePath ?>" class="card-img-top" alt="<?= $row['scholarship_type']; ?>">
                </div>
                <div class="card-body">
                  <h5 class="card-title"><?= $row['scholarship_type']; ?></h5>
                  <div class="amount">₱<?= number_format($row['amount']); ?></div>
                  
                  <div class="mb-3">
                    <span class="badge badge-primary">Description</span>
                    <p class="small mt-2"><?= $row['description']; ?></p>
                  </div>
                  
                  <div class="mb-3">
                    <span class="badge badge-primary">Requirements</span>
                    <ul class="requirements-list mt-2">
                      <?php foreach (explode(',', $row['concatenated_value']) as $value) {
                        echo "<li>$value</li>";
                      } ?>
                    </ul>
                  </div>
                  
                  <div class="countdown mb-3">
                    <span class="badge badge-warning">End Date: <?= $formattedDate; ?></span>
                    <div class="countdown-text mt-2" id="countdown<?= $row['scholarship_id']; ?>"></div>
                  </div>
                  
                  <a href="login.php" class="btn btn-apply">Apply Now</a>
                </div>
              </div>
            </div>

            <script>
              (function() {
                let endDate = new Date("<?= $formattedDate ?>").getTime();
                let countdownId = "countdown<?= $row['scholarship_id']; ?>";

                setInterval(function() {
                  let now = new Date().getTime();
                  let diff = endDate - now;

                  if (diff < 0) {
                    document.getElementById(countdownId).innerHTML = "<span class='text-danger'>Application Closed</span>";
                    return;
                  }

                  let days = Math.floor(diff / (1000 * 60 * 60 * 24));
                  let hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                  let minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                  let seconds = Math.floor((diff % (1000 * 60)) / 1000);

                  document.getElementById(countdownId).innerHTML = 
                    "<strong>Remaining:</strong> " + days + "d " + hours + "h " + minutes + "m " + seconds + "s";
                }, 1000);
              })();
            </script>
          <?php }
        } else { ?>
          <div class="col-12">
            <div class="empty-state">
              <i class="bi bi-info-circle"></i>
              <h3>No Scholarships Available</h3>
              <p>There are currently no active scholarship programs. Please check back later for new opportunities.</p>
              <a href="index.php" class="btn btn-apply" style="width: auto;">Return to Home</a>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
  </section><!-- End Scholarship Section -->

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

  <!-- Template Main JS File -->
  <script src="resources/js/main.js"></script>

</body>

</html>