<?php
require './includes/check_session.php';

$remove_badge_sql = "UPDATE user_application SET badge_notified_admin=1 WHERE badge_notified_admin=0;";
$remove_badge_result = $pdo->query($remove_badge_sql);

$remove_notif_sql = "UPDATE admin_notification SET status=1 WHERE type=1;";
$remove_notif_result = $pdo->query($remove_notif_sql);

$page = 'Applications';
require './includes/partial.head.php';
?>

<style>
:root {
  --primary-color: #3498db;
  --secondary-color: #2c3e50;
  --success-color: #27ae60;
  --warning-color: #f39c12;
  --danger-color: #e74c3c;
  --light-color: #ecf0f1;
  --dark-color: #2c3e50;
  --card-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  --hover-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
  --transition: all 0.3s ease;
}

.card {
  border-radius: 12px;
  box-shadow: var(--card-shadow);
  border: none;
  transition: var(--transition);
}

.card:hover {
  box-shadow: var(--hover-shadow);
}

.card-header {
  background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
  color: white;
  border-radius: 12px 12px 0 0 !important;
  padding: 20px;
}

.card-header h3 {
  margin: 0;
  font-weight: 600;
  display: flex;
  align-items: center;
  gap: 10px;
}

.table {
  border-collapse: separate;
  border-spacing: 0;
  margin: 0;
}

.table thead th {
  background: linear-gradient(135deg, #f8f9fa, #e9ecef);
  border-bottom: 2px solid #dee2e6;
  font-weight: 700;
  color: var(--dark-color);
  padding: 15px 12px;
  position: sticky;
  top: 0;
  z-index: 10;
}

.table tbody td {
  padding: 15px 12px;
  vertical-align: middle;
  border-bottom: 1px solid #e9ecef;
  transition: var(--transition);
}

.table-hover tbody tr:hover {
  background-color: rgba(52, 152, 219, 0.08);
  transform: translateY(-1px);
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

/* Status badges */
.badge {
  font-size: 0.75rem;
  padding: 6px 12px;
  border-radius: 50px;
  font-weight: 600;
  display: inline-flex;
  align-items: center;
  gap: 4px;
}

.badge-warning {
  background: linear-gradient(135deg, #f39c12, #e67e22);
}

.badge-success {
  background: linear-gradient(135deg, #27ae60, #219653);
}

.badge-danger {
  background: linear-gradient(135deg, #e74c3c, #c0392b);
}

.badge-primary {
  background: linear-gradient(135deg, #3498db, #2980b9);
}

/* Action buttons */
.btn {
  border-radius: 8px;
  font-weight: 500;
  transition: var(--transition);
  padding: 8px 16px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 6px;
  border: none;
}

.btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.btn-outline-success {
  border: 2px solid #27ae60;
  color: #27ae60;
  background: transparent;
}

.btn-outline-success:hover {
  background: #27ae60;
  color: white;
  border-color: #27ae60;
}

/* Action buttons container */
.action-buttons {
  display: flex;
  gap: 8px;
  justify-content: center;
  flex-wrap: wrap;
}

.action-buttons .btn {
  min-width: 44px;
  height: 44px;
  border-radius: 10px;
}

/* Preloader */
.preloader {
  background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('../resources/images/lallol.jpg') no-repeat;
  background-size: cover;
  background-position: center;
  background-attachment: fixed;
}

.preloader img {
  animation: pulse 2s infinite;
}

@keyframes pulse {
  0% { transform: scale(1); opacity: 1; }
  50% { transform: scale(1.05); opacity: 0.8; }
  100% { transform: scale(1); opacity: 1; }
}

/* Table responsive improvements */
.table-responsive {
  border-radius: 10px;
  overflow: hidden;
}

.table-responsive::-webkit-scrollbar {
  height: 8px;
  width: 8px;
}

.table-responsive::-webkit-scrollbar-track {
  background: #f1f1f1;
  border-radius: 10px;
}

.table-responsive::-webkit-scrollbar-thumb {
  background: var(--primary-color);
  border-radius: 10px;
}

.table-responsive::-webkit-scrollbar-thumb:hover {
  background: var(--secondary-color);
}

/* Empty state styling */
.dataTables_empty {
  padding: 60px 20px !important;
  text-align: center;
  color: #6c757d;
  font-style: italic;
  background: #f8f9fa;
}

.dataTables_empty:before {
  content: "📋";
  font-size: 3rem;
  display: block;
  margin-bottom: 15px;
  opacity: 0.5;
}

/* Filter section */
.filter-section {
  background: linear-gradient(135deg, #f8f9fa, #e9ecef);
  border-radius: 10px;
  padding: 20px;
  margin-bottom: 25px;
  border-left: 4px solid var(--primary-color);
}

/* Column visibility button styling */
.buttons-columnVisibility.active {
  background: linear-gradient(135deg, #27ae60, #219653) !important;
  color: white !important;
  border-color: #27ae60 !important;
}

.buttons-columnVisibility.active:hover {
  background: linear-gradient(135deg, #219653, #1e8449) !important;
  color: white !important;
}

/* Status indicator for pending applications */
.status-indicator {
  width: 8px;
  height: 8px;
  border-radius: 50%;
  background: #f39c12;
  display: inline-block;
  margin-right: 8px;
  animation: pulse 2s infinite;
}

.pending-row {
  background: linear-gradient(90deg, rgba(243, 156, 18, 0.05) 0%, transparent 100%);
  border-left: 4px solid #f39c12;
}

/* Loading animation */
.loading {
  position: relative;
  overflow: hidden;
}

.loading::after {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
  animation: loading 1.5s infinite;
}

@keyframes loading {
  0% { left: -100%; }
  100% { left: 100%; }
}

/* Responsive adjustments */
@media (max-width: 768px) {
  .action-buttons {
    flex-direction: column;
    gap: 5px;
  }
  
  .action-buttons .btn {
    width: 100%;
    justify-content: center;
  }
  
  .table thead th,
  .table tbody td {
    padding: 10px 8px;
    font-size: 0.9rem;
  }
  
  .card-header {
    padding: 15px;
  }
  
  .card-header h3 {
    font-size: 1.1rem;
  }
}

/* Hover effects for table rows */
.table tbody tr {
  transition: all 0.3s ease;
  cursor: pointer;
}

.table tbody tr:hover {
  background: linear-gradient(90deg, rgba(52, 152, 219, 0.08) 0%, transparent 100%);
}

/* Custom badge animations */
.badge {
  position: relative;
  overflow: hidden;
}

.badge::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
  transition: left 0.5s;
}

.badge:hover::before {
  left: 100%;
}

/* Footer styling */
.table tfoot th {
  background: #f8f9fa;
  font-weight: 600;
  padding: 12px;
}

/* DataTables customizations */
.dataTables_wrapper .dataTables_filter input {
  border-radius: 8px;
  padding: 8px 12px;
  border: 2px solid #e9ecef;
  transition: var(--transition);
}

.dataTables_wrapper .dataTables_filter input:focus {
  border-color: var(--primary-color);
  box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
}

.dataTables_wrapper .dataTables_length select {
  border-radius: 8px;
  padding: 6px;
  border: 2px solid #e9ecef;
}

/* Button group styling */
.dt-buttons .btn {
  margin: 2px;
  border-radius: 8px;
}

/* Success message */
.alert-success {
  border-radius: 10px;
  border: none;
  background: linear-gradient(135deg, #d4edda, #c3e6cb);
  color: #155724;
  border-left: 4px solid #28a745;
}



/* Statistics Cards */
.small-box {
  border-radius: 10px;
  box-shadow: var(--card-shadow);
  position: relative;
  overflow: hidden;
}

.small-box .icon {
  position: absolute;
  top: 10px;
  right: 10px;
  z-index: 0;
  font-size: 70px;
  color: rgba(255,255,255,0.15);
  transition: var(--transition);
}

.small-box:hover .icon {
  transform: scale(1.1);
}

.small-box .inner h3 {
  font-size: 2.2rem;
  font-weight: 700;
  margin: 0 0 10px 0;
}

.small-box .inner p {
  font-size: 1rem;
  margin: 0;
}

/* Filter controls */
.filter-controls {
  display: flex;
  gap: 15px;
  flex-wrap: wrap;
  align-items: end;
}

.filter-controls .form-group {
  margin-bottom: 0;
}

.filter-controls label {
  font-weight: 600;
  margin-bottom: 5px;
  color: var(--dark-color);
}

.filter-controls .form-control {
  border-radius: 8px;
  border: 2px solid #e9ecef;
  transition: var(--transition);
  min-width: 200px;
}

.filter-controls .form-control:focus {
  border-color: var(--primary-color);
  box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
}
</style>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="../resources/images/lgulallo.png" alt="Logo" height="100" width="100">
        </div>

        <?php
        // include Top Navigation Bar
        include_once 'includes/topNav.php';
        // include Side Navigation Bar
        include_once 'includes/sideNav.php';
        ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Applications</h1>
                            <p class="text-muted mb-0">Manage and review scholarship applications</p>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item">
                                    <a href="dashboard.php">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Applications</li>
                            </ol>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

                        <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Statistics Cards -->
                    <div class="row mb-4">
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <?php
                                    $total_applications = $pdo->query("SELECT COUNT(*) as total FROM user_application")->fetch(PDO::FETCH_ASSOC)['total'];
                                    ?>
                                    <h3><?= $total_applications ?></h3>
                                    <p>Total Applications</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-file-alt"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-6">
                            <div class="small-box bg-primary">
                                <div class="inner">
                                    <?php
                                    $submitted_applications = $pdo->query("SELECT COUNT(*) as submitted FROM user_application WHERE approved = '0'")->fetch(PDO::FETCH_ASSOC)['submitted'];
                                    ?>
                                    <h3><?= $submitted_applications ?></h3>
                                    <p>Submitted</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-paper-plane"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-6">
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <?php
                                    $pending_applications = $pdo->query("SELECT COUNT(*) as pending FROM user_application WHERE approved = '3'")->fetch(PDO::FETCH_ASSOC)['pending'];
                                    ?>
                                    <h3><?= $pending_applications ?></h3>
                                    <p>Pending Review</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-clock"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-6">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <?php
                                    $approved_applications = $pdo->query("SELECT COUNT(*) as approved FROM user_application WHERE approved = '1'")->fetch(PDO::FETCH_ASSOC)['approved'];
                                    ?>
                                    <h3><?= $approved_applications ?></h3>
                                    <p>Approved</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-6">
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <?php
                                    $declined_applications = $pdo->query("SELECT COUNT(*) as declined FROM user_application WHERE approved = '2'")->fetch(PDO::FETCH_ASSOC)['declined'];
                                    ?>
                                    <h3><?= $declined_applications ?></h3>
                                    <p>Declined</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-times-circle"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Scholarship Type Statistics -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0"><i class="fas fa-chart-pie mr-2"></i>Applications by Scholarship Type</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <?php
                                        $scholarship_stats = $pdo->query("
                                            SELECT s.scholarship_type, COUNT(ua.application_id) as count 
                                            FROM scholarship s 
                                            LEFT JOIN user_application ua ON s.scholarship_id = ua.scholarship_id 
                                            GROUP BY s.scholarship_type
                                            ORDER BY count DESC
                                        ")->fetchAll(PDO::FETCH_ASSOC);
                                        
                                        foreach($scholarship_stats as $stat):
                                            $percentage = $total_applications > 0 ? round(($stat['count'] / $total_applications) * 100, 1) : 0;
                                        ?>
                                        <div class="col-md-3 col-sm-6 mb-3">
                                            <div class="info-box bg-light">
                                                <span class="info-box-icon bg-primary"><i class="fas fa-award"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text"><?= $stat['scholarship_type'] ?></span>
                                                    <span class="info-box-number"><?= $stat['count'] ?> applications</span>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-primary" style="width: <?= $percentage ?>%"></div>
                                                    </div>
                                                    <span class="progress-description">
                                                        <?= $percentage ?>% of total
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-file-alt mr-2"></i>
                                        <h3 class="mb-0">Application List</h3>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="filter-section mb-4">
                                        <div class="filter-controls">
                                            <div class="form-group">
                                                <label for="scholarshipFilter">Filter by Scholarship Type:</label>
                                                <select id="scholarshipFilter" class="form-control">
                                                    <option value="">All Scholarship Types</option>
                                                    <?php
                                                    $scholarship_types = $pdo->query("SELECT DISTINCT scholarship_type FROM scholarship ORDER BY scholarship_type")->fetchAll(PDO::FETCH_COLUMN);
                                                    foreach($scholarship_types as $type):
                                                    ?>
                                                    <option value="<?= $type ?>"><?= $type ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="barangayFilter">Filter by Barangay:</label>
                                                <select id="barangayFilter" class="form-control">
                                                    <option value="">All Barangays</option>
                                                    <?php
                                                    $barangays = $pdo->query("SELECT DISTINCT barangay FROM user_application WHERE barangay IS NOT NULL AND barangay != '' ORDER BY barangay")->fetchAll(PDO::FETCH_COLUMN);
                                                    foreach($barangays as $barangay):
                                                    ?>
                                                    <option value="<?= $barangay ?>"><?= $barangay ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="statusFilter">Filter by Status:</label>
                                                <select id="statusFilter" class="form-control">
                                                    <option value="">All Statuses</option>
                                                    <option value="0">Submitted</option>
                                                    <option value="3">Pending</option>
                                                    <option value="1">Approved</option>
                                                    <option value="2">Declined</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="table-responsive">
                                        <table id="applicationTable" class="table table-bordered table-hover w-100">
                                            <thead>
                                                <tr>
                                                    <th>Type</th>
                                                    <th>Name</th>
                                                    <th>Date Applied</th>
                                                    <th>Scholarship Type</th>
                                                    <th>Barangay</th>
                                                    <th>School Year</th>
                                                    <th>Status</th>
                                                    <th width="120px">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $qry = $pdo->query("SELECT s.scholarship_type, s.amount, us.*, DATE_FORMAT(us.date_applied, '%M %d, %Y') as Date_Applied, DATE_FORMAT(us.b_dob, '%M %d, %Y') as b_dob, CONCAT( us.b_lname ,' ',us.b_fname, ' ', us.b_mname,' ', us.b_ext_name) as name, 
                                                us.barangay, us.school_name, us.school_year, us.year_level, us.semester, us.municipality, us.province, us.type, us.mobile_number, us.b_gender, us.b_civil_status, us.nationality, us.region, u.highest_education, u.skill_occupation FROM user_application as us 
                                                INNER JOIN user as u on us.user_id = u.user_id INNER JOIN scholarship as s ON s.scholarship_id = us.scholarship_id ORDER BY us.application_id DESC");

                                                while ($row = $qry->fetch(PDO::FETCH_OBJ)) {
                                                    $status_class = $row->approved == '3' ? 'pending-row' : '';
                                                ?>
                                                    <tr class="<?= $status_class ?>">
                                                        <td><?= strtoupper($row->type) ?></td>
                                                        <td class="font-weight-bold"><?= $row->name ?></td>
                                                        <td>
                                                            <span class="text-primary font-weight-bold">
                                                                <?= $row->Date_Applied ?>
                                                            </span>
                                                        </td>
                                                        <td><?= $row->scholarship_type ?></td>
                                                        <td><?= $row->barangay ?></td>
                                                        <td><?= $row->school_year ?></td>

                                                        <td>
                                                            <?php if ($row->approved == '3') {
                                                                echo "<span class='badge badge-warning'><i class='fa fa-spinner' aria-hidden='true'></i> Pending</span>";
                                                            } elseif ($row->approved == '1') {
                                                                echo "<span class='badge badge-success'><i class='fa fa-thumbs-up' aria-hidden='true'></i> Approved</span>";
                                                            } else if($row->approved == '2') {
                                                                echo "<span class='badge badge-danger'><i class='fa fa-thumbs-down' aria-hidden='true'></i> Declined</span>";
                                                            } else {
                                                                echo "<span class='badge badge-primary'><i class='fa fa-paper-plane' aria-hidden='true'></i> Submitted</span>";
                                                            };  ?>
                                                        </td>

                                                        <td>
                                                            <div class="action-buttons">
                                                                <?php
                                                                if ($row->approved == 0) {
                                                                ?>
                                                                    <acronym title="View Application">
                                                                        <a class="btn btn-outline-success" data-toggle="modal" data-target="#viewApplication" 
                                                                           onclick="getApplication('<?= $row->application_id ?>',
                                                                        '<?= $row->Date_Applied ?>', '<?= $row->name ?>', '<?= $row->b_gender ?>', '<?= $row->b_dob ?>', '<?= $row->b_pob ?>', '<?= $row->b_monthly_income ?>', `<?= $row->scholarship_type ?>`, '<?= $row->amount ?>', '<?= $row->barangay ?>', '<?= $row->municipality ?>','<?= $row->province ?>','<?= $row->school_name ?>',  '<?= $row->school_year ?>', '<?= $row->year_level ?>', '<?= $row->semester ?>' , '<?= $row->mobile_number ?>', '<?= $row->religion ?>', '<?= $row->nationality ?>', '<?= $row->b_civil_status ?>', '<?= $row->highest_education ?>', '<?= $row->skill_occupation ?>');">
                                                                            <i class="far fa-eye"></i>
                                                                        </a>
                                                                    </acronym>
                                                                <?php } else { ?>
                                                                    <acronym title="View Application">
                                                                        <a class="btn btn-outline-success" data-toggle="modal" data-target="#viewApplication" 
                                                                           onclick="getApplication('<?= $row->application_id ?>',
                                                                        '<?= $row->Date_Applied ?>', '<?= $row->name ?>', '<?= $row->b_gender ?>', '<?= $row->b_dob ?>', '<?= $row->b_pob ?>', '<?= $row->b_monthly_income ?>', `<?= $row->scholarship_type ?>`, '<?= $row->amount ?>', '<?= $row->barangay ?>', '<?= $row->municipality ?>','<?= $row->province ?>','<?= $row->school_name ?>',  '<?= $row->school_year ?>', '<?= $row->year_level ?>', '<?= $row->semester ?>' , '<?= $row->mobile_number ?>', '<?= $row->religion ?>', '<?= $row->nationality ?>', '<?= $row->b_civil_status ?>', '<?= $row->highest_education ?>', '<?= $row->skill_occupation ?>');">
                                                                            <i class="far fa-eye"></i>
                                                                        </a>
                                                                    </acronym>
                                                                <?php } ?>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                           
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <?php include_once 'includes/footer.php'; ?>
    </div>

    <?php require './includes/partial.script-imports.php'; ?>
    <?php require 'components/viewModal_application.php' ?>
    
    <script>


      // Add this function for loading uploaded files
function loadUploadedFiles(applicationId) {
    console.log("DEBUG: Loading files for application_id:", applicationId);
    
    $.ajax({
        url: '../admin/components/viewModal_application_links.php',
        type: 'POST',
        data: { 
            application_id: applicationId,
            _cache: new Date().getTime()
        },
        cache: false,
        success: function(response) {
            console.log("DEBUG: AJAX response received for app_id:", applicationId);
            $('#uploadedFilesContainer').html(response);
        },
        error: function(xhr, status, error) {
            console.log("DEBUG: AJAX error:", error);
        }
    });
}

// Add modal event listener - ADD THIS TO YOUR EXISTING $(document).ready(function()
$('#viewApplication').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var applicationId = button.data('application-id');
    console.log("DEBUG: Modal opening with application_id:", applicationId);
    
    if (applicationId) {
        loadUploadedFiles(applicationId);
    }
});
    $(document).ready(function() {
        // Initialize DataTable with enhanced features
        var table = $('#applicationTable').DataTable({
            responsive: true,
            lengthChange: true,
            autoWidth: false,
            pageLength: 25,
            language: {
                search: "Search applications:",
                lengthMenu: "Show _MENU_ entries",
                info: "Showing _START_ to _END_ of _TOTAL_ applications",
                infoEmpty: "No applications available",
                infoFiltered: "(filtered from _MAX_ total entries)",
                paginate: {
                    first: "First",
                    last: "Last",
                    next: "Next",
                    previous: "Previous"
                }
            },
            buttons: [
                {
                    extend: 'copy',
                    className: 'btn btn-light',
                    text: '<i class="fas fa-copy"></i> Copy'
                },
                {
                    extend: 'csv',
                    className: 'btn btn-light',
                    text: '<i class="fas fa-file-csv"></i> CSV'
                },
                {
                    extend: 'excel',
                    className: 'btn btn-light',
                    text: '<i class="fas fa-file-excel"></i> Excel'
                },
                {
                    extend: 'pdf',
                    className: 'btn btn-light',
                    text: '<i class="fas fa-file-pdf"></i> PDF'
                },
                {
                    extend: 'print',
                    className: 'btn btn-light',
                    text: '<i class="fas fa-print"></i> Print'
                },
                {
                    extend: 'colvis',
                    className: 'btn btn-light',
                    text: '<i class="fas fa-columns"></i> Columns'
                }
            ],
            dom: '<"row"<"col-sm-12 col-md-6"B><"col-sm-12 col-md-6"f>>' +
                 '<"row"<"col-sm-12"tr>>' +
                 '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
            initComplete: function () {
                this.api().buttons().container().appendTo('#applicationTable_wrapper .col-md-6:eq(0)');
                updateColumnVisibilityColors();
                
                // Scholarship Type Filter
                this.api().columns(3).every(function () {
                    var column = this;
                    var select = $('#scholarshipFilter');
                    
                    select.on('change', function () {
                        var val = $.fn.dataTable.util.escapeRegex($(this).val());
                        column.search(val ? '^' + val + '$' : '', true, false).draw();
                    });
                });
                
                // Barangay Filter
                this.api().columns(4).every(function () {
                    var column = this;
                    var select = $('#barangayFilter');
                    
                    select.on('change', function () {
                        var val = $.fn.dataTable.util.escapeRegex($(this).val());
                        column.search(val ? '^' + val + '$' : '', true, false).draw();
                    });
                });
                
                // Status Filter
this.api().columns(6).every(function () {
    var column = this;
    var select = $('#statusFilter');
    
    select.on('change', function () {
        var val = $(this).val();
        
        if (val === '') {
            // Show all rows if no filter selected
            column.search('', true, false).draw();
            return;
        }
        
        // Custom search function to match status values
        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                var statusValue = val;
                var cellContent = data[6]; // Status column is index 6
                
                // Map status values to their corresponding badge classes/text
                var statusMap = {
                    '0': ['badge-primary', 'Submitted'],
                    '3': ['badge-warning', 'Pending'], 
                    '1': ['badge-success', 'Approved'],
                    '2': ['badge-danger', 'Declined']
                };
                
                if (statusMap[statusValue]) {
                    var badgeClass = statusMap[statusValue][0];
                    var statusText = statusMap[statusValue][1];
                    
                    // Check if the cell contains the badge class for this status
                    return cellContent.indexOf(badgeClass) !== -1 || 
                           cellContent.indexOf(statusText) !== -1;
                }
                
                return false;
            }
        );
        
        table.draw();
        
        // Remove the custom search function after drawing
        $.fn.dataTable.ext.search.pop();
    });
});
            }
        });

        // Update column visibility colors
        function updateColumnVisibilityColors() {
            $('.buttons-columnVisibility').each(function(){
                if ($(this).hasClass('active')) {
                    $(this).css({
                        'background': 'linear-gradient(135deg, #27ae60, #219653)',
                        'color': '#fff',
                        'border-color': '#27ae60'
                    });
                } else {
                    $(this).css({
                        'background': '',
                        'color': '',
                        'border-color': ''
                    });
                }
            });
        }

        // Update colors when column visibility changes
        table.on('column-visibility', function() {
            setTimeout(updateColumnVisibilityColors, 100);
        });

        // Update on button click
        $(document).on('click', '.buttons-columnVisibility', function() {
            setTimeout(updateColumnVisibilityColors, 100);
        });

        // Initialize tooltips
        $('[data-toggle="tooltip"]').tooltip();

        // Auto-refresh colors every 200ms (fallback)
        setInterval(updateColumnVisibilityColors, 200);
    });

    // Add smooth scrolling to top when paginating
    $('#applicationTable').on('page.dt', function() {
        $('html, body').animate({
            scrollTop: $('.dataTables_wrapper').offset().top - 20
        }, 500);
    });
    </script>
</body>
</html>