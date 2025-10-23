<?php
include './includes/pdo_conn.php';
include './includes/session_variables.php';

$page = 'Status';
require './includes/partial.head.php';
?>

<style>
:root {
  --primary-color: #198754;
  --primary-light: #e9f7ef;
  --primary-dark: #146c43;
  --text-dark: #343a40;
  --text-light: #6c757d;
  --border-color: #dee2e6;
  --bg-light: #f8f9fa;
  --shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
  --transition: all 0.3s ease;
}

body {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  color: var(--text-dark);
  background-color: #f5f7fa;
}

/* Preloader */
.preloader {
  background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
}

/* Breadcrumb */
.breadcrumb {
  background-color: transparent;
  padding: 0;
  margin-bottom: 0;
}

.breadcrumb-item a {
  color: var(--primary-color);
  text-decoration: none;
  transition: var(--transition);
}

.breadcrumb-item a:hover {
  color: var(--primary-dark);
  text-decoration: underline;
}

/* Card Improvements */
.card {
  border: none;
  border-radius: 12px;
  box-shadow: var(--shadow);
  margin-bottom: 24px;
  transition: var(--transition);
  overflow: hidden;
}

.card:hover {
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.12);
  transform: translateY(-2px);
}

.card-header {
  border-bottom: 1px solid var(--border-color);
  border-radius: 12px 12px 0 0 !important;
  padding: 16px 20px;
  background-color: white;
  font-weight: 600;
  font-size: 1.1rem;
  color: var(--primary-dark);
}

/* Progress Chart */
.chart-container {
  position: relative;
  width: 200px;
  height: 200px;
  margin: 0 auto;
}

.chart-center-text {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  text-align: center;
  width: 100%;
}

.chart-status {
  font-size: 1.1rem;
  font-weight: 700;
  display: block;
  line-height: 1.3;
  text-align: center;
}

/* Status Colors */
.status-submitted { color: #17a2b8; }
.status-pending { color: #ffc107; }
.status-approved { color: #28a745; }
.status-declined { color: #dc3545; }
.status-completed { color: #198754; }
.status-not-completed { color: #6c757d; }

/* Timeline Improvements - FIXED */
.timeline {
  position: relative;
  padding: 20px 0;
  list-style: none;
  margin: 0;
}

.timeline:before {
  content: ' ';
  position: absolute;
  top: 0;
  bottom: 0;
  left: 25px;
  width: 3px;
  background-color: var(--border-color);
}

.timeline > li {
  position: relative;
  margin-bottom: 30px;
  padding-left: 60px;
}

.timeline > li:last-child {
  margin-bottom: 0;
}

.timeline-badge {
  position: absolute;
  left: 0;
  width: 50px;
  height: 50px;
  border-radius: 50%;
  text-align: center;
  font-size: 1.2em;
  line-height: 50px;
  color: #fff;
  z-index: 100;
  box-shadow: 0 2px 5px rgba(0,0,0,0.2);
}

.timeline-badge.info { background-color: #17a2b8; }
.timeline-badge.warning { background-color: #ffc107; }
.timeline-badge.success { background-color: #28a745; }
.timeline-badge.danger { background-color: #dc3545; }
.timeline-badge.secondary { background-color: #6c757d; }

.timeline-panel {
  position: relative;
  width: 100%;
  padding: 20px;
  border-radius: 10px;
  background: white;
  box-shadow: var(--shadow);
  transition: var(--transition);
  margin-bottom: 10px;
}

.timeline-panel:hover {
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.timeline-heading h4 {
  margin-top: 0;
  color: var(--primary-dark);
  font-weight: 600;
  font-size: 1.1rem;
}

.timeline-heading .text-muted {
  font-size: 0.85rem;
}

.timeline-body p {
  margin-bottom: 0;
  line-height: 1.6;
  font-size: 0.95rem;
}

/* Details/Spoiler Styling */
details {
  margin-top: 15px;
  border-radius: 8px;
  overflow: hidden;
}

summary {
  padding: 12px 16px;
  background-color: var(--bg-light);
  cursor: pointer;
  font-weight: 500;
  transition: var(--transition);
  border-radius: 8px;
  list-style: none;
  position: relative;
  font-size: 0.95rem;
  text-align: center;
}

summary::-webkit-details-marker {
  display: none;
}

summary:after {
  content: '▼';
  position: absolute;
  right: 16px;
  font-weight: bold;
  transition: var(--transition);
  font-size: 0.8rem;
}

details[open] summary:after {
  transform: rotate(180deg);
}

summary:hover {
  background-color: var(--primary-light);
}

/* Empty State */
.empty-state {
  text-align: center;
  padding: 60px 20px;
  color: var(--text-light);
  background: white;
  border-radius: 12px;
  box-shadow: var(--shadow);
}

.empty-state i {
  font-size: 4rem;
  margin-bottom: 20px;
  color: #ced4da;
}

.empty-state h3 {
  font-weight: 500;
  margin-bottom: 10px;
  color: var(--text-dark);
}

/* Application Status Summary */
.status-summary {
  background: white;
  border-radius: 12px;
  padding: 20px;
  margin-bottom: 24px;
  box-shadow: var(--shadow);
}

.status-summary h3 {
  color: var(--primary-dark);
  margin-bottom: 15px;
  font-weight: 600;
}

.status-item {
  display: flex;
  align-items: center;
  padding: 10px 0;
  border-bottom: 1px solid var(--border-color);
}

.status-item:last-child {
  border-bottom: none;
}

.status-color {
  width: 12px;
  height: 12px;
  border-radius: 50%;
  margin-right: 10px;
}

.status-color.submitted { background-color: #17a2b8; }
.status-color.pending { background-color: #ffc107; }
.status-color.approved { background-color: #28a745; }
.status-color.declined { background-color: #dc3545; }
.status-color.completed { background-color: #198754; }
.status-color.not-completed { background-color: #6c757d; }

/* Responsive improvements */
@media (max-width: 768px) {
  .timeline:before {
    left: 20px;
  }
  
  .timeline > li {
    padding-left: 50px;
  }
  
  .timeline-badge {
    width: 40px;
    height: 40px;
    line-height: 40px;
    font-size: 1em;
  }
  
  .chart-container {
    width: 180px;
    height: 180px;
  }
  
  .timeline-panel {
    padding: 15px;
  }
}

/* Page Header */
.content-header h1 {
  color: var(--text-dark);
  font-weight: 600;
  margin-bottom: 5px;
}

.content-header p {
  color: var(--text-light);
  font-size: 1rem;
}

/* Animation for new status updates */
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(10px); }
  to { opacity: 1; transform: translateY(0); }
}

.status-update {
  animation: fadeIn 0.5s ease;
}
</style>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="resources/images/lgulallo.png" alt="Logo" height="100" width="100">
        </div>

        <?php
        include_once 'includes/topNav.php';
        include_once 'includes/sideNav.php';
        ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <h1 class="m-0">Application Status</h1>
                            <p class="text-muted mb-0">Track the progress of your scholarship applications</p>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item">
                                    <a href="index.php">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Status</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Status Summary -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="status-summary">
                                <h3>Application Status Guide</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="status-item">
                                            <div class="status-color submitted"></div>
                                            <div>
                                                <strong>Submitted</strong>
                                                <small class="d-block text-muted">Application received and under initial review</small>
                                            </div>
                                        </div>
                                        <div class="status-item">
                                            <div class="status-color pending"></div>
                                            <div>
                                                <strong>Pending</strong>
                                                <small class="d-block text-muted">Application is being processed</small>
                                            </div>
                                        </div>
                                        <div class="status-item">
                                            <div class="status-color approved"></div>
                                            <div>
                                                <strong>Approved</strong>
                                                <small class="d-block text-muted">Application approved, waiting for claim date announcement</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="status-item">
                                            <div class="status-color declined"></div>
                                            <div>
                                                <strong>Declined</strong>
                                                <small class="d-block text-muted">Application was not approved</small>
                                            </div>
                                        </div>
                                        <div class="status-item">
                                            <div class="status-color completed"></div>
                                            <div>
                                                <strong>Completed</strong>
                                                <small class="d-block text-muted">Scholarship successfully claimed</small>
                                            </div>
                                        </div>
                                        <div class="status-item">
                                            <div class="status-color not-completed"></div>
                                            <div>
                                                <strong>Not Completed</strong>
                                                <small class="d-block text-muted">Application process not finished</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Application Cards -->
                    <div class="row">
                        <?php
                        $i = 1;
                        // Safely get user_id from session using your defined session variables
                        $current_user_id = null;
                        
                        // Check if session variables are defined and exist in $_SESSION
                        if (isset($session_user_id) && isset($_SESSION[$session_user_id])) {
                            $current_user_id = $_SESSION[$session_user_id];
                        }
                        
                        if ($current_user_id) {
                            $stmt = $pdo->prepare(
                                "SELECT * FROM user_application AS ua 
                                INNER JOIN scholarship AS s ON ua.scholarship_id = s.scholarship_id 
                                INNER JOIN user AS u ON ua.user_id = u.user_id  
                                WHERE u.user_id = :user_id 
                                ORDER BY ua.application_id DESC"
                            );
                            $stmt->bindParam(':user_id', $current_user_id);
                            $stmt->execute();
                            
                            if ($stmt->rowCount() > 0) {
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    $timestamp = strtotime($row['date_applied']);
                                    $formattedDate = date('F d, Y h:i A', $timestamp);

                                    $timestampapproved = strtotime($row['approved_datetime']);
                                    $formattedDateapproved = date('F d, Y h:i A', $timestampapproved);

                                    $timestampdeclined = strtotime($row['declined_datetime']);
                                    $formattedDatedeclined = date('F d, Y h:i A', $timestampdeclined);

                                    $timestampongoing = strtotime($row['ongoing_datetime']);
                                    $formattedDateongoing = date('F d, Y h:i A', $timestampongoing);

                                    $timestampclaimed = strtotime($row['claimed_datetime']);
                                    $formattedDateclaimed = date('F d, Y h:i A', $timestampclaimed);

                                    $progressStatus = '';
                                    $percentage = 0;
                                    $statusClass = '';

                                    if ($row['approved'] == '3') {
                                        $progressStatus = 'PENDING';
                                        $percentage = 50;
                                        $statusClass = 'status-pending';
                                    } else if ($row['approved'] == '1') {
                                        if ($row['claimed'] == '1') {
                                            $progressStatus = 'COMPLETED';
                                            $percentage = 100;
                                            $statusClass = 'status-completed';
                                        } else {
                                            $progressStatus = 'APPROVED';
                                            $percentage = 75;
                                            $statusClass = 'status-approved';
                                        }
                                    } else if ($row['approved'] == '2') {
                                        $progressStatus = 'DECLINED';
                                        $percentage = 0;
                                        $statusClass = 'status-declined';
                                    } else {
                                        $progressStatus = 'SUBMITTED';
                                        $percentage = 25;
                                        $statusClass = 'status-submitted';
                                    }
                        ?>
                        <div class="col-md-4">
                            <div class="card status-update">
                                <div class="card-header"><?= htmlspecialchars($row['scholarship_type']) ?> Progress</div>
                                <div class="card-body">
                                    <div class="chart-container">
                                        <canvas id="progress_chart_<?php echo $i; ?>" width="200" height="200"></canvas>
                                        <div class="chart-center-text">
                                            <span class="chart-status <?= $statusClass ?>"><?= $progressStatus ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <details>
                                        <summary>View Application Timeline</summary>
                                        <?php if ($row['approved'] == '0') { ?>
                                            <ul class="timeline">
                                                <li>
                                                  <div class="timeline-badge info"><i class="fa fa-paper-plane"></i></div>
                                                  <div class="timeline-panel">
                                                    <div class="timeline-heading">
                                                      <h4 class="timeline-title">SUBMITTED</h4>
                                                      <p><small class="text-muted"><i class="fa fa-calendar"></i> <?= $formattedDate ?></small></p>
                                                    </div>
                                                    <div class="timeline-body">
                                                      <p>Congratulations! Your scholarship application has been submitted and is awaiting review.</p>
                                                    </div>
                                                  </div>
                                                </li>
                                            </ul>
                                        <?php } elseif ($row['approved'] == '3'){?>
                                            <ul class="timeline">
                                                <li>
                                                  <div class="timeline-badge info"><i class="fa fa-paper-plane"></i></div>
                                                  <div class="timeline-panel">
                                                    <div class="timeline-heading">
                                                      <h4 class="timeline-title">SUBMITTED</h4>
                                                      <p><small class="text-muted"><i class="fa fa-clock"></i> <?= $formattedDate ?></small></p>
                                                    </div>
                                                    <div class="timeline-body">
                                                      <p>Your application has been submitted successfully.</p>
                                                    </div>
                                                  </div>
                                                </li>
                                                <li>
                                                  <div class="timeline-badge warning"><i class="fa fa-commenting"></i></div>
                                                  <div class="timeline-panel">
                                                    <div class="timeline-heading">
                                                      <h4 class="timeline-title">PENDING</h4>
                                                      <p><small class="text-muted"><i class="fa fa-calendar"></i> <?= $formattedDateongoing ?></small></p>
                                                    </div>
                                                    <div class="timeline-body">
                                                      <p>Your application is currently under review.</p>
                                                    </div>
                                                  </div>
                                                </li>
                                            </ul>
                                        <?php } else { ?>
                                            <?php if ($row['approved'] == '2') { ?>
                                                <?php if ($row['claimed'] == '0') { ?>
                                                    <ul class="timeline">
                                                        <li>
                                                            <div class="timeline-badge info"><i class="fa fa-paper-plane"></i></div>
                                                            <div class="timeline-panel">
                                                                <div class="timeline-heading">
                                                                    <h4 class="timeline-title">SUBMITTED</h4>
                                                                    <p><small class="text-muted"><i class="fa fa-clock"></i> <?= $formattedDate ?></small></p>
                                                                </div>
                                                                <div class="timeline-body">
                                                                    <p>Your application was successfully submitted.</p>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="timeline-badge warning"><i class="fa fa-commenting"></i></div>
                                                            <div class="timeline-panel">
                                                                <div class="timeline-heading">
                                                                    <h4 class="timeline-title">PENDING</h4>
                                                                    <p><small class="text-muted"><i class="fa fa-calendar"></i> <?= $formattedDateongoing ?></small></p>
                                                                </div>
                                                                <div class="timeline-body">
                                                                    <p>Your application was reviewed by our committee.</p>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="timeline-badge danger"><i class="fa fa-thumbs-down"></i></div>
                                                            <div class="timeline-panel">
                                                                <div class="timeline-heading">
                                                                    <h4 class="timeline-title">DECLINED</h4>
                                                                    <p><small class="text-muted"><i class="fa fa-calendar"></i> <?= $formattedDatedeclined ?></small></p>
                                                                </div>
                                                                <div class="timeline-body">
                                                                    <p> Hello, Once again, we thank you for your time and interest in applying with us. Unfortunately, we have decided not to move forward with your application at this time. However, we have a great suggestion on how you can still apply. Try reading other application program and apply now.
You can learn more about on our website. All the best, Lal-lo Shines Even Brighter</p>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="timeline-badge secondary"><i class="fa fa-times"></i></div>
                                                            <div class="timeline-panel">
                                                                <div class="timeline-heading">
                                                                    <h4 class="timeline-title">NOT COMPLETED</h4>
                                                                    <p><small class="text-muted"><i class="fa fa-calendar"></i> <?= $formattedDatedeclined ?></small></p>
                                                                </div>
                                                                <div class="timeline-body">
                                                                    <p>Sorry, To inform you that your application for scholarship assistance has been declined cannot proceed the process.</p>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                <?php } else { ?>
                                                    <ul class="timeline">
                                                        <li>
                                                            <div class="timeline-badge info"><i class="fa fa-paper-plane"></i></div>
                                                            <div class="timeline-panel">
                                                                <div class="timeline-heading">
                                                                    <h4 class="timeline-title">SUBMITTED</h4>
                                                                    <p><small class="text-muted"><i class="fa fa-clock"></i> <?= $formattedDate ?></small></p>
                                                                </div>
                                                                <div class="timeline-body">
                                                                    <p>Your application was successfully submitted.</p>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="timeline-badge warning"><i class="fa fa-commenting"></i></div>
                                                            <div class="timeline-panel">
                                                                <div class="timeline-heading">
                                                                    <h4 class="timeline-title">PENDING</h4>
                                                                    <p><small class="text-muted"><i class="fa fa-calendar"></i> <?= $formattedDateongoing ?></small></p>
                                                                </div>
                                                                <div class="timeline-body">
                                                                    <p>Your application was reviewed by our committee.</p>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="timeline-badge danger"><i class="fa fa-thumbs-down"></i></div>
                                                            <div class="timeline-panel">
                                                                <div class="timeline-heading">
                                                                    <h4 class="timeline-title">DECLINED</h4>
                                                                    <p><small class="text-muted"><i class="fa fa-calendar"></i> <?= $formattedDatedeclined ?></small></p>
                                                                </div>
                                                                <div class="timeline-body">
                                                                    <p>Unfortunately, we have decided not to move forward with your application at this time.</p>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                <?php } ?>
                                            <?php } elseif ($row['approved'] == '1') { ?>
                                                <?php if ($row['claimed'] == '1') { ?>
                                                    <ul class="timeline">
                                                        <li>
                                                            <div class="timeline-badge info"><i class="fa fa-paper-plane"></i></div>
                                                            <div class="timeline-panel">
                                                                <div class="timeline-heading">
                                                                    <h4 class="timeline-title">SUBMITTED</h4>
                                                                    <p><small class="text-muted"><i class="fa fa-clock"></i> <?= $formattedDate ?></small></p>
                                                                </div>
                                                                <div class="timeline-body">
                                                                    <p>Your application was successfully submitted.</p>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="timeline-badge warning"><i class="fa fa-commenting"></i></div>
                                                            <div class="timeline-panel">
                                                                <div class="timeline-heading">
                                                                    <h4 class="timeline-title">PENDING</h4>
                                                                    <p><small class="text-muted"><i class="fa fa-calendar"></i> <?= $formattedDateongoing ?></small></p>
                                                                </div>
                                                                <div class="timeline-body">
                                                                    <p>Your application was reviewed by our committee.</p>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="timeline-badge success"><i class="fa fa-thumbs-up"></i></div>
                                                            <div class="timeline-panel">
                                                                <div class="timeline-heading">
                                                                    <h4 class="timeline-title">APPROVED</h4>
                                                                    <p><small class="text-muted"><i class="fa fa-calendar"></i> <?= $formattedDateapproved ?></small></p>
                                                                </div>
                                                                <div class="timeline-body">
                                                                    <p>Congratulations! Your scholarship application has been approved.</p>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="timeline-badge success"><i class="fa fa-check"></i></div>
                                                            <div class="timeline-panel">
                                                                <div class="timeline-heading">
                                                                    <h4 class="timeline-title">COMPLETED</h4>
                                                                    <p><small class="text-muted"><i class="fa fa-calendar"></i> <?= $formattedDateclaimed ?></small></p>
                                                                </div>
                                                                <div class="timeline-body">
                                                                    <p>Your scholarship has been successfully claimed. Check the announcement section for the announced claim date . Congratulations!</p>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                <?php } else { ?>
                                                    <ul class="timeline">
                                                        <li>
                                                            <div class="timeline-badge info"><i class="fa fa-paper-plane"></i></div>
                                                            <div class="timeline-panel">
                                                                <div class="timeline-heading">
                                                                    <h4 class="timeline-title">SUBMITTED</h4>
                                                                    <p><small class="text-muted"><i class="fa fa-clock"></i> <?= $formattedDate ?></small></p>
                                                                </div>
                                                                <div class="timeline-body">
                                                                    <p>Your application was successfully submitted.</p>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="timeline-badge warning"><i class="fa fa-commenting"></i></div>
                                                            <div class="timeline-panel">
                                                                <div class="timeline-heading">
                                                                    <h4 class="timeline-title">PENDING</h4>
                                                                    <p><small class="text-muted"><i class="fa fa-calendar"></i> <?= $formattedDateongoing ?></small></p>
                                                                </div>
                                                                <div class="timeline-body">
                                                                    <p>Your application was reviewed by our committee.</p>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="timeline-badge success"><i class="fa fa-thumbs-up"></i></div>
                                                            <div class="timeline-panel">
                                                                <div class="timeline-heading">
                                                                    <h4 class="timeline-title">APPROVED</h4>
                                                                    <p><small class="text-muted"><i class="fa fa-calendar"></i> <?= $formattedDateapproved ?></small></p>
                                                                </div>
                                                                <div class="timeline-body">
                                                                    <p>Congratulations! Your scholarship has been approved. Please wait for the announcement of the claim date.</p>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="timeline-badge secondary"><i class="fa fa-question-circle"></i></div>
                                                            <div class="timeline-panel">
                                                                <div class="timeline-heading">
                                                                    <h4 class="timeline-title">NOT COMPLETED</h4>
                                                                    <p><small class="text-muted"><i class="fa fa-calendar"></i> <?= $formattedDateapproved ?></small></p>
                                                                </div>
                                                                <div class="timeline-body">
                                                                    <p>Your scholarship has not been claimed yet. Please wait for the claim date announcement.</p>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } ?>
                                    </details>
                                </div>
                            </div>

                            <script>
                                $(document).ready(function() {
                                    var progressChart<?php echo $i; ?> = new Chart(document.getElementById('progress_chart_<?php echo $i; ?>'), {
                                        type: 'doughnut',
                                        data: {
                                            labels: ['Progress'],
                                            datasets: [{
                                                data: [<?php echo $percentage; ?>, <?php echo 100 - $percentage; ?>],
                                                backgroundColor: [
                                                    <?php 
                                                        if ($percentage == 25) {
                                                            echo "'#17a2b8', '#e0e0e0'";
                                                        } elseif ($percentage == 50) {
                                                            echo "'#ffc107', '#e0e0e0'";
                                                        } elseif ($percentage == 75) {
                                                            echo "'#28a745', '#e0e0e0'";
                                                        } elseif ($percentage == 100) {
                                                            echo "'#198754', '#e0e0e0'";
                                                        } else {
                                                            echo "'#dc3545', '#e0e0e0'";
                                                        }
                                                    ?>
                                                ],
                                                borderColor: [
                                                    '#ffffff',
                                                    '#ffffff'
                                                ],
                                                borderWidth: 1
                                            }]
                                        },
                                        options: {
                                            cutoutPercentage: 70,
                                            rotation: -0.5 * Math.PI,
                                            responsive: true,
                                            legend: {
                                                display: false
                                            },
                                            tooltips: {
                                                enabled: false
                                            }
                                        }
                                    });
                                });
                            </script>
                        </div>
                        <?php
                                $i++;
                            }
                        } else {
                            ?>
                            <div class="col-12">
                                <div class="empty-state">
                                    <i class="fas fa-file-alt"></i>
                                    <h3>No Applications Found</h3>
                                    <p class="mb-4">You haven't submitted any scholarship applications yet.</p>
                                </div>
                            </div>
                            <?php 
                        } 
                        } else {
                            ?>
                            <div class="col-12">
                                <div class="empty-state">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    <h3>Session Expired</h3>
                                    <p class="mb-4">Please log in to view your application status.</p>
                                </div>
                            </div>
                            <?php 
                        }
                        ?>
                    </div>
                </div>
            </section>
        </div>

        <?php include_once 'includes/footer.php'; ?>
    </div>

    <?php require './includes/partial.script-imports.php'; ?>
</body>
</html>