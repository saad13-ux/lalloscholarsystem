<?php
require './includes/check_session.php';

$page = 'Payroll Report';
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
}

.card {
  border-radius: 10px;
  box-shadow: var(--card-shadow);
  border: none;
}

.card-header {
  background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
  color: white;
  border-radius: 10px 10px 0 0 !important;
  padding: 15px 20px;
}

.card-header h5 {
  margin: 0;
  font-weight: 600;
}

.table {
  border-collapse: separate;
  border-spacing: 0;
}

.table thead th {
  background-color: #f8f9fa;
  border-bottom: 2px solid #dee2e6;
  font-weight: 600;
  color: var(--dark-color);
  padding: 12px 15px;
}

.table tbody td {
  padding: 12px 15px;
  vertical-align: middle;
  border-bottom: 1px solid #e9ecef;
}

.table-hover tbody tr:hover {
  background-color: rgba(52, 152, 219, 0.05);
  transform: translateY(-1px);
  transition: all 0.2s ease;
}

.badge {
  font-size: 0.75rem;
  padding: 5px 10px;
  border-radius: 50px;
  font-weight: 500;
}

.btn {
  border-radius: 6px;
  font-weight: 500;
  transition: all 0.2s ease;
  padding: 8px 16px;
}

.btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.btn-primary {
  background: var(--primary-color);
  border: none;
}

.btn-danger {
  background: linear-gradient(135deg, var(--danger-color), #c0392b);
  border: none;
}

.filter-section {
  background-color: #f8f9fa;
  border-radius: 8px;
  padding: 15px;
  margin-bottom: 20px;
  border-left: 4px solid var(--primary-color);
}

.filter-section label {
  font-weight: 600;
  color: var(--dark-color);
  margin-bottom: 5px;
}

.dataTables_wrapper .dataTables_filter input {
  border-radius: 6px;
  padding: 6px 12px;
  border: 1px solid #ced4da;
}

.dataTables_wrapper .dataTables_length select {
  border-radius: 6px;
  padding: 6px;
  border: 1px solid #ced4da;
}

.dt-buttons .btn {
  margin-right: 5px;
  margin-bottom: 5px;
}

.status-badge {
  display: inline-flex;
  align-items: center;
  gap: 5px;
}

.status-badge i {
  font-size: 0.8rem;
}

.action-buttons {
  display: flex;
  gap: 8px;
  justify-content: center;
}

.action-buttons .btn {
  flex: 1;
  max-width: 80px;
  text-align: center;
}

/* Custom scrollbar for table */
.table-responsive::-webkit-scrollbar {
  height: 8px;
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

/* Preloader animation */
.preloader {
  background: linear-gradient(rgba(0,0,0,0.7),rgba(0,0,0,0.7)), url('../resources/images/lallol.jpg') no-repeat;
  background-size: cover;
  background-position: center;
}

.preloader img {
  animation: pulse 2s infinite;
}

@keyframes pulse {
  0% { transform: scale(1); }
  50% { transform: scale(1.05); }
  100% { transform: scale(1); }
}

/* Responsive adjustments */
@media (max-width: 768px) {
  .filter-section .d-flex {
    flex-direction: column;
  }
  
  .filter-section .d-flex > div {
    width: 100%;
    margin-bottom: 10px;
  }
  
  .action-buttons {
    flex-direction: column;
    gap: 5px;
  }
  
  .action-buttons .btn {
    max-width: 100%;
  }
}

/* Custom checkbox for column visibility */
.buttons-columnVisibility.active {
  background-color: var(--success-color) !important;
  color: white !important;
  border-color: var(--success-color) !important;
}

/* Table row animations */
.table tbody tr {
  transition: all 0.3s ease;
}

/* Empty state styling */
.dataTables_empty {
  padding: 40px !important;
  text-align: center;
  color: #6c757d;
}

.dataTables_empty:before {
  content: "📋";
  font-size: 2rem;
  display: block;
  margin-bottom: 10px;
}

/* Date range picker customization */
.daterangepicker {
  border-radius: 8px;
  box-shadow: var(--hover-shadow);
}

.daterangepicker td.active, .daterangepicker td.active:hover {
  background-color: var(--primary-color);
}



/* Print form styling */
.print-form-container {
  background: linear-gradient(135deg, #f8f9fa, #e9ecef);
  border-radius: 10px;
  padding: 20px;
  border: 1px solid #dee2e6;
  box-shadow: var(--card-shadow);
}

.print-form-container .form-label {
  font-weight: 600;
  color: var(--dark-color);
  margin-bottom: 8px;
  font-size: 0.9rem;
}

.print-form-container .form-control,
.print-form-container .form-select {
  border-radius: 8px;
  border: 1px solid #ced4da;
  padding: 10px 12px;
  transition: all 0.3s ease;
}

.print-form-container .form-control:focus,
.print-form-container .form-select:focus {
  border-color: var(--primary-color);
  box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
}

.print-form-container .input-group {
  margin-bottom: 0;
}

.print-form-container .btn-primary {
  background: linear-gradient(135deg, var(--primary-color), #2980b9);
  border: none;
  padding: 10px 20px;
  font-weight: 600;
  border-radius: 8px;
}

.print-form-container .btn-primary:hover {
  background: linear-gradient(135deg, #2980b9, var(--primary-color));
  transform: translateY(-2px);
}

/* Filter container styling */
.filter-container {
  background: #f8f9fa;
  padding: 15px;
  border-radius: 8px;
  margin-bottom: 20px;
}

.filter-container .form-label {
  font-weight: 600;
  margin-bottom: 5px;
  color: var(--dark-color);
}

.filter-container .form-select {
  border-radius: 6px;
  padding: 8px 12px;
}

/* Statistics Cards */
.small-box {
    border-radius: 10px;
    box-shadow: var(--card-shadow);
    position: relative;
    overflow: hidden;
    margin-bottom: 20px;
    color: white;
}

.small-box .icon {
    position: absolute;
    top: 10px;
    right: 10px;
    z-index: 0;
    font-size: 70px;
    color: rgba(255,255,255,0.15);
    transition: all 0.3s ease;
}

.small-box:hover .icon {
    transform: scale(1.1);
}

.small-box .inner {
    padding: 20px;
    position: relative;
    z-index: 1;
}

.small-box .inner h3 {
    font-size: 2.2rem;
    font-weight: 700;
    margin: 0 0 10px 0;
    color: white;
}

.small-box .inner p {
    font-size: 1rem;
    margin: 0;
    color: rgba(255,255,255,0.8);
}

/* Background colors for small boxes */
.bg-info {
    background: linear-gradient(135deg, #17a2b8, #138496) !important;
}

.bg-success {
    background: linear-gradient(135deg, #28a745, #218838) !important;
}

.bg-danger {
    background: linear-gradient(135deg, #dc3545, #c82333) !important;
}

.bg-warning {
    background: linear-gradient(135deg, #ffc107, #e0a800) !important;
}

/* Hover effects */
.small-box:hover {
    transform: translateY(-5px);
    box-shadow: var(--hover-shadow);
    transition: all 0.3s ease;
}

/* Print Form Grid Layout */
.print-form-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 15px;
    align-items: end;
}

@media (max-width: 768px) {
    .print-form-grid {
        grid-template-columns: 1fr;
        gap: 10px;
    }
}

/* Form Group Styling */
.form-group {
    margin-bottom: 0;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: 600;
    color: var(--dark-color);
}

/* Stats card styling */
.stats-card {
    margin-bottom: 20px;
}
</style>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

    <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="../resources/images/lgulallo.png" alt="Logo" height="100" width="100" >
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
                            <h1 class="m-0">Payroll</h1>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item">
                                    <a href="dashboard.php">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Payroll Report</li>
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
                    <div class="row ">
                        <div class="col w-100 d-flex justify-content-end mb-3">
                            <form action="actions/action.filter-report.php" method="post">
                                <div class="d-flex">
                                    <div class="input-group mr-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-clock"></i></span>
                                        </div>
                                        <input type="text" class="form-control float-right" id="date_range" name="date_range">
                                    </div>
                                    <button type="submit" class="btn btn-primary input-group-text" name="filter_report"> 
                                        <i class="fa fa-filter mr-1" aria-hidden="true"></i> Filter
                                    </button>
                                    &nbsp;
                                    <button type="submit" class="btn btn-danger input-group-text" name="reset"> 
                                        <i class="fa fa-recycle mr-1" aria-hidden="true"></i> Reset
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php
                    if (isset($_GET['start_date']) && isset($_GET['end_date'])) {
                        $start_date = $_GET['start_date'];
                        $end_date = $_GET['end_date'];
                       $sql = "SELECT a.application_id, 
               concat(a.b_fname, ' ', a.b_lname) as b_name, 
               DATE_FORMAT(a.claim_date, '%M %d, %Y') as date_claimed,  
               s.scholarship_type, 
               s.amount, 
               a.barangay, 
               a.school_name,
               a.claim_date, 
               a.claimed 
        FROM user_application as a 
        INNER JOIN scholarship as s 
            ON s.scholarship_id = a.scholarship_id 
        WHERE a.approved = 1 
          AND a.claim_date BETWEEN :start_date AND :end_date  
        ORDER BY a.barangay ASC, b_name ASC";
$qry = $pdo->prepare($sql);
$params = allowOnly($_GET, ['start_date', 'end_date']);
$qry->execute($params);

                    } else {
                            $qry = $pdo->query("SELECT a.application_id, 
                           concat(a.b_fname, ' ', a.b_lname) as b_name, 
                           DATE_FORMAT(a.claim_date, '%M %d, %Y') as date_claimed,  
                           s.scholarship_type, 
                           s.amount, 
                           a.barangay, 
                           a.school_name,
                           a.claim_date, 
                           a.claimed 
                    FROM user_application as a 
                    INNER JOIN scholarship as s 
                        ON s.scholarship_id = a.scholarship_id 
                    WHERE a.approved = 1 
                      AND a.claim_date IS NOT NULL 
                    ORDER BY a.barangay ASC, b_name ASC");
                    } 

                    // Get school statistics
                    $schoolStats = $pdo->query("
                        SELECT 
                            school_name,
                            COUNT(*) as total_applicants,
                            SUM(s.amount) as total_amount
                        FROM user_application as a 
                        INNER JOIN scholarship as s 
                            ON s.scholarship_id = a.scholarship_id 
                        WHERE a.approved = 1 
                          AND a.claim_date IS NOT NULL
                          AND a.school_name IS NOT NULL
                          AND a.school_name != ''
                        GROUP BY school_name 
                        ORDER BY total_applicants DESC
                    ")->fetchAll(PDO::FETCH_ASSOC);

                    // Get overall statistics
                    $overallStats = $pdo->query("
                        SELECT 
                            COUNT(DISTINCT school_name) as total_schools,
                            COUNT(*) as total_applicants,
                            SUM(s.amount) as total_amount
                        FROM user_application as a 
                        INNER JOIN scholarship as s 
                            ON s.scholarship_id = a.scholarship_id 
                        WHERE a.approved = 1 
                          AND a.claim_date IS NOT NULL
                          AND a.school_name IS NOT NULL
                          AND a.school_name != ''
                    ")->fetch(PDO::FETCH_ASSOC);
                    ?>
                    
                   <!-- Statistics Section -->
<div class="row mb-4">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info stats-card">
            <div class="inner">
                <h3><?= $overallStats['total_schools'] ?? 0 ?></h3>
                <p>Total Schools/Campuses</p>
            </div>
            <div class="icon">
                <i class="fas fa-university"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success stats-card">
            <div class="inner">
                <h3><?= $overallStats['total_applicants'] ?? 0 ?></h3>
                <p>Total Applicants</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning stats-card">
            <div class="inner">
                <h3>₱<?= number_format($overallStats['total_amount'] ?? 0, 2) ?></h3>
                <p>Total Amount</p>
            </div>
            <div class="icon">
                <i class="fas fa-money-bill-wave"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger stats-card">
            <div class="inner">
                <h3><?= count($schoolStats) ?></h3>
                <p>Schools with Applicants</p>
            </div>
            <div class="icon">
                <i class="fas fa-school"></i>
            </div>
        </div>
    </div>
</div>

                    <!-- School Statistics Table -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0"><i class="fas fa-university mr-2"></i>School/Campus Statistics</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>School/Campus</th>
                                                    <th>Total Applicants</th>
                                                    <th>Total Amount</th>
      
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach($schoolStats as $school): ?>
                                                <tr>
                                                    <td><strong><?= $school['school_name'] ?></strong></td>
                                                    <td><?= $school['total_applicants'] ?></td>
                                                    <td>₱<?= number_format($school['total_amount'], 2) ?></td>
                                                   
                                                </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
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
                                        <i class="fas fa-table mr-2" aria-hidden="true"></i>
                                        <h5 class="mb-0">List of Educational Grants</h5>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <!-- Improved Print Form Section -->
                                    <div class="print-form-container mb-4">
                                        <h6 class="mb-3"><i class="fas fa-print mr-2"></i>Generate Payroll Report</h6>
                                        <form action="actions/action.print-report.php" method="post" onsubmit="return validatePrintForm();">
                                            <input type="hidden" name="start_date" value="<?= $start_date ?? '' ?>">
                                            <input type="hidden" name="end_date" value="<?= $end_date ?? '' ?>">
                                            
                                            <div class="print-form-grid">
                                                <!-- Scholarship Type -->
                                                <div class="form-group">
                                                    <label for="scholarship_type" class="form-label">Scholarship Type *</label>
                                                    <select name="scholarship_type" id="scholarship_type" class="form-select" required>
                                                        <option value="">-- Select Scholarship --</option>
                                                        <?php
                                                        $scholarshipList = $pdo->query("SELECT DISTINCT scholarship_type FROM scholarship ORDER BY scholarship_type ASC");
                                                        while ($s = $scholarshipList->fetch(PDO::FETCH_ASSOC)) {
                                                            $selected = ($scholarship_type ?? '') == $s['scholarship_type'] ? 'selected' : '';
                                                            echo "<option value='{$s['scholarship_type']}' $selected>{$s['scholarship_type']}</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>

                                                <!-- Barangay Filter -->
                                                <div class="form-group">
                                                    <label for="barangay" class="form-label">Barangay</label>
                                                    <select name="barangay" id="barangay" class="form-select">
                                                        <option value="">-- All Barangays --</option>
                                                        <?php
                                                        $barangayList = $pdo->query("SELECT DISTINCT barangay FROM user_application ORDER BY barangay ASC");
                                                        while ($b = $barangayList->fetch(PDO::FETCH_ASSOC)) {
                                                            echo "<option value='{$b['barangay']}'>{$b['barangay']}</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>

                                                <!-- Semester Filter -->
                                                <div class="form-group">
                                                    <label for="semester" class="form-label">Semester</label>
                                                    <select name="semester" id="semester" class="form-select">
                                                        <option value="">-- All Semesters --</option>
                                                        <option value="1st Semester">1st Semester</option>
                                                        <option value="2nd Semester">2nd Semester</option>
                                                      
                                                    </select>
                                                </div>

                                                <!-- Generate Button -->
                                                <div class="form-group">
                                                    <label class="form-label" style="visibility: hidden;">Generate</label>
                                                    <button type="submit" class="btn btn-primary w-100" name="print_report">
                                                        <i class="fas fa-print mr-2"></i> Generate Report
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <table id="applicationTable" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Scholarship Type</th>
                                                <th>Name</th>
                                                <th>Barangay</th>
                                                <th>School Name</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            while ($row = $qry->fetch(PDO::FETCH_ASSOC)) {
                                            ?>
                                                <tr>
                                                    <td><?= $row['scholarship_type'] ?></td>
                                                    <td><?= $row['b_name'] ?></td>
                                                    <td><?= $row['barangay'] ?></td>
                                                    <td><?= $row['school_name'] ?? 'N/A' ?></td>
                                                    <td>
                                                        <?= is_numeric($row['amount']) ? '&#8369;' . number_format($row['amount'], 2) : $row['amount'] ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>

        <!-- Modal for Payroll -->
        <div class="modal fade" id="payrollModal" tabindex="-1" role="dialog" aria-labelledby="payrollModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="payrollModalLabel">Payroll - <span id="scholarshipTitle"></span></h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p><b>Total Beneficiaries:</b> <span id="beneficiaryCount"></span></p>
                <table id="payrollTable" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Barangay</th>
                      <th>School Name</th>
                      <th>Amount</th>
                    </tr>
                  </thead>
                  <tbody></tbody>
                </table>
              </div>
              <div class="modal-footer">
                <form id="printPayrollForm" method="POST" action="actions/action.print-report.php" target="_blank">
                    <input type="hidden" name="print_report" value="1">
                    <input type="hidden" name="scholarship_type" id="payrollScholarshipType">
                    <input type="hidden" name="start_date" id="payrollStartDate">
                    <input type="hidden" name="end_date" id="payrollEndDate">
                    <button type="submit" class="btn btn-primary">Print Payroll</button>
                </form>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

        <!-- /.content-wrapper -->
        <?php include './components/announcementModal.php'; ?>
        <?php include_once 'includes/footer.php'; ?>
    </div>
    <!-- ./wrapper -->

    <?php
    require './includes/partial.script-imports.php';
    ?>
    <script>
    $(function() {
        var table = $("#applicationTable").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "pageLength": 10,
            "order": [[2, 'asc'], [1, 'asc']], // Sort: Barangay → Name
            "rowGroup": {
                dataSrc: 2 // Group by Barangay
            },
            "language": {
              "search": "Search records:",
              "lengthMenu": "Show _MENU_ records",
              "info": "Showing _START_ to _END_ of _TOTAL_ records",
              "infoEmpty": "No records available",
              "infoFiltered": "(filtered from _MAX_ total records)",
              "paginate": {
                "first": "First",
                "last": "Last",
                "next": "Next",
                "previous": "Previous"
              }
            },
            "dom": '<"row"<"col-sm-12 col-md-6"B><"col-sm-12 col-md-6"f>>' +
                   '<"row"<"col-sm-12"tr>>' +
                   '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
            "buttons": [
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
            initComplete: function () {
                var api = this.api();

                // Create a container for filters (Bootstrap flexbox for spacing)
                var filterContainer = $('<div class="filter-container d-flex flex-wrap gap-3 mb-3"></div>')
                    .prependTo('#applicationTable_wrapper .dataTables_wrapper');

                // ✅ Barangay filter dropdown (column index 2)
                api.columns(2).every(function () {
                    var column = this;
                    var select = $(`
                        <div class="flex-fill">
                          <label class="form-label">Barangay</label>
                          <select class="form-select form-select-sm">
                              <option value="">All Barangays</option>
                          </select>
                        </div>
                    `).appendTo(filterContainer);

                    var dropdown = select.find('select');
                    dropdown.on('change', function () {
                        var val = $.fn.dataTable.util.escapeRegex($(this).val());
                        column.search(val ? '^' + val + '$' : '', true, false).draw();
                        updateRealTimeStats();
                    });

                    column.data().unique().sort().each(function (d) {
                        dropdown.append('<option value="' + d + '">' + d + '</option>');
                    });
                });

                // ✅ Scholarship filter dropdown (column index 0)
                api.columns(0).every(function () {
                    var column = this;
                    var select = $(`
                        <div class="flex-fill">
                          <label class="form-label">Scholarship</label>
                          <select class="form-select form-select-sm">
                              <option value="">All Scholarships</option>
                          </select>
                        </div>
                    `).appendTo(filterContainer);

                    var dropdown = select.find('select');
                    dropdown.on('change', function () {
                        var val = $.fn.dataTable.util.escapeRegex($(this).val());
                        column.search(val ? '^' + val + '$' : '', true, false).draw();
                        updateRealTimeStats();
                    });

                    column.data().unique().sort().each(function (d) {
                        dropdown.append('<option value="' + d + '">' + d + '</option>');
                    });
                });

                // ✅ School Name filter dropdown (column index 3)
                api.columns(3).every(function () {
                    var column = this;
                    var select = $(`
                        <div class="flex-fill">
                          <label class="form-label">School/Campus</label>
                          <select class="form-select form-select-sm">
                              <option value="">All Schools</option>
                          </select>
                        </div>
                    `).appendTo(filterContainer);

                    var dropdown = select.find('select');
                    dropdown.on('change', function () {
                        var val = $.fn.dataTable.util.escapeRegex($(this).val());
                        column.search(val ? '^' + val + '$' : '', true, false).draw();
                        updateRealTimeStats();
                    });

                    column.data().unique().sort().each(function (d) {
                        if (d && d.trim() !== '') { // Only add non-empty values
                            dropdown.append('<option value="' + d + '">' + d + '</option>');
                        }
                    });
                });

                // Add real-time statistics update
                function updateRealTimeStats() {
                    var data = table.rows({ filter: 'applied' }).data();
                    var totalApplicants = data.count();
                    var totalAmount = 0;
                    var schools = new Set();
                    
                    data.each(function (row) {
                        var amountStr = row[4].toString().replace('₱', '').replace(/,/g, '');
                        var amount = parseFloat(amountStr) || 0;
                        totalAmount += amount;
                        schools.add(row[3]); // School name
                    });

                    // Update the main statistics cards
                    $('.stats-card:eq(0) h3').text(schools.size);
                    $('.stats-card:eq(1) h3').text(totalApplicants);
                    $('.stats-card:eq(2) h3').text('₱' + totalAmount.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
                    $('.stats-card:eq(3) h3').text(schools.size);
                }

                // Update stats when table is drawn
                table.on('draw', function () {
                    updateRealTimeStats();
                });

                // Initialize stats
                updateRealTimeStats();
            }
        });

        table.buttons()
            .container()
            .appendTo('#applicationTable_wrapper .col-md-6:eq(0)'); // ⬅️ keep buttons on the left

        $('#applicationTable tbody').on('click', 'td:first-child', function() {
            var scholarshipType = $(this).text();

            // Filter rows by scholarship type
            var filteredRows = table.rows().data().toArray().filter(row => row[0] === scholarshipType);

            // Update modal title + count
            $('#scholarshipTitle').text(scholarshipType);
            $('#beneficiaryCount').text(filteredRows.length);

            // Populate modal table
            var tbody = $('#payrollTable tbody');
            tbody.empty();
            filteredRows.forEach(row => {
                tbody.append(`
                    <tr>
                        <td>${row[1]}</td>
                        <td>${row[2]}</td>
                        <td>${row[3]}</td>
                        <td>${row[4].toString().includes('₱') ? row[4] : '₱' + parseFloat(row[4]).toLocaleString()}</td>
                    </tr>
                `);
            });

            // ✅ Update hidden inputs for the print form
            $('#payrollScholarshipType').val(scholarshipType);
            $('#payrollStartDate').val("<?= $start_date ?? '' ?>");
            $('#payrollEndDate').val("<?= $end_date ?? '' ?>");

            // Show modal
            $('#payrollModal').modal('show');
        });

        // ✅ Reset filter button
        $('<button class="btn btn-secondary ml-2">Show All</button>')
            .appendTo('#applicationTable_wrapper .col-md-6:eq(0)')
            .on('click', function() {
                table.search('').columns().search('').draw();
            });
    });

    $(document).ready(function() {
        //Date range picker with time picker
        $('#date_range').daterangepicker({
            locale: {
                format: 'MM/DD/YYYY hh:mm A'
            }
        });

        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true
        });
    });

    $('.scholarship-type').on('click', function () {
        var scholarshipType = $(this).data('type');
        
        // Set modal title
        $('#payrollScholarshipType').val(scholarshipType);
        $('#payrollStartDate').val($('#start_date').val());
        $('#payrollEndDate').val($('#end_date').val());
        
        // Then show the modal as usual
        $('#payrollModal').modal('show');
    });

    function validatePrintForm() {
        let scholarshipType = document.getElementById("scholarship_type").value;
        if (scholarshipType === "") {
            alert("⚠️ Please select a scholarship type before printing the payroll.");
            return false;
        }
        return true;
    }

    $(document).ready(function(){
      function updateColumnVisibilityColors(){
        $('.buttons-columnVisibility').each(function(){
          if ($(this).hasClass('active')) {
            $(this).css({
              'background-color':'#198754',
              'color':'#fff'
            });
          } else {
            $(this).css({
              'background-color':'',
              'color':''
            });
          }
        });
      }

      // Start interval when page loads; keeps checking
      setInterval(updateColumnVisibilityColors, 200);
    });
    </script>
</body>
</html>