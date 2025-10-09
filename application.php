<?php
require './includes/user_check_session.php';
$page = 'Applications';
require './includes/partial.head.php';
?>

<style>
:root {
  --primary-color: #198754;
  --primary-light: #f0f9f4;
  --primary-dark: #146c43;
  --secondary-color: #6c757d;
  --success-color: #198754;
  --warning-color: #ffc107;
  --danger-color: #dc3545;
  --info-color: #0dcaf0;
  --text-dark: #495057;
  --text-light: #6c757d;
  --border-color: #e9ecef;
  --bg-light: #f8f9fa;
  --bg-lighter: #fdfdfd;
  --shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
  --shadow-hover: 0 2px 8px rgba(0, 0, 0, 0.12);
  --transition: all 0.2s ease;
  --border-radius: 8px;
}

body {
  font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
  color: var(--text-dark);
  background-color: #fafbfc;
  line-height: 1.5;
  font-weight: 400;
}

/* Preloader */
.preloader {
  background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
}

/* Breadcrumb */
.breadcrumb {
  background-color: transparent;
  padding: 0.5rem 0;
  margin-bottom: 0;
  font-size: 0.875rem;
}

.breadcrumb-item a {
  color: var(--primary-color);
  text-decoration: none;
  transition: var(--transition);
  font-weight: 400;
}

.breadcrumb-item a:hover {
  color: var(--primary-dark);
  text-decoration: underline;
}

.breadcrumb-item.active {
  color: var(--text-light);
  font-weight: 400;
}

/* Card Improvements */
.card {
  border: 1px solid var(--border-color);
  border-radius: var(--border-radius);
  box-shadow: var(--shadow);
  margin-bottom: 1.5rem;
  transition: var(--transition);
  overflow: hidden;
  background: white;
}

.card:hover {
  box-shadow: var(--shadow-hover);
}

.card-header {
  border-bottom: 1px solid var(--border-color);
  border-radius: var(--border-radius) var(--border-radius) 0 0 !important;
  padding: 1.25rem 1.5rem;
  background: white;
}

.card-header h3 {
  margin: 0;
  font-weight: 600;
  color: var(--text-dark);
  font-size: 1.25rem;
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

.card-header h3:before {
  content: "📋";
  font-size: 1.1rem;
  opacity: 0.8;
}

.card-body {
  padding: 1.5rem;
}

/* Table Improvements */
.table {
  border-collapse: separate;
  border-spacing: 0;
  width: 100%;
  margin-bottom: 0;
  border-radius: var(--border-radius);
  overflow: hidden;
  font-size: 0.875rem;
}

.table thead th {
  background: var(--bg-light);
  border-bottom: 1px solid var(--border-color);
  font-weight: 600;
  padding: 0.875rem 0.75rem;
  color: var(--text-dark);
  position: sticky;
  top: 0;
  z-index: 10;
  font-size: 0.8rem;
  text-transform: none;
  letter-spacing: 0;
}

.table tbody td {
  padding: 0.875rem 0.75rem;
  vertical-align: middle;
  border-bottom: 1px solid var(--border-color);
  transition: var(--transition);
  font-weight: 400;
}

.table tbody tr {
  transition: var(--transition);
}

.table tbody tr:hover {
  background-color: var(--primary-light);
}

.table tbody tr:last-child td {
  border-bottom: none;
}

/* Badge Improvements */
.badge {
  font-weight: 500;
  padding: 0.4rem 0.75rem;
  border-radius: 4px;
  font-size: 0.75rem;
  letter-spacing: 0;
  box-shadow: none;
  border: 1px solid transparent;
}

.badge-warning {
  background-color: #fff3cd;
  color: #856404;
  border-color: #ffeaa7;
}

.badge-success {
  background-color: #d1e7dd;
  color: #0f5132;
  border-color: #a3cfbb;
}

.badge-danger {
  background-color: #f8d7da;
  color: #721c24;
  border-color: #f1aeb5;
}

.badge-primary {
  background-color: #cfe2ff;
  color: #084298;
  border-color: #9ec5fe;
}

/* Status indicators */
.status-indicator {
  display: inline-flex;
  align-items: center;
  gap: 0.375rem;
  font-weight: 500;
}

.status-indicator i {
  font-size: 0.7rem;
}

/* Empty state */
.empty-state {
  text-align: center;
  padding: 2.5rem 1.5rem;
  color: var(--text-light);
}

.empty-state i {
  font-size: 3rem;
  margin-bottom: 1rem;
  color: #dee2e6;
  opacity: 0.6;
}

.empty-state h4 {
  color: var(--text-light);
  margin-bottom: 0.75rem;
  font-weight: 500;
  font-size: 1.25rem;
}

.empty-state p {
  font-size: 0.95rem;
  margin-bottom: 1.5rem;
  max-width: 400px;
  margin-left: auto;
  margin-right: auto;
  font-weight: 400;
}

/* Button improvements */
.buttons-columnVisibility {
  border-radius: 4px !important;
  transition: var(--transition) !important;
  font-weight: 500;
  padding: 0.375rem 0.75rem !important;
  border: 1px solid var(--border-color) !important;
  margin: 0.125rem !important;
  font-size: 0.8rem;
}

.buttons-columnVisibility.active {
  background-color: var(--primary-color) !important;
  border-color: var(--primary-color) !important;
  color: white !important;
}

.buttons-columnVisibility:hover:not(.active) {
  background-color: var(--bg-light) !important;
}

/* Content header spacing */
.content-header {
  margin-bottom: 1.5rem;
  padding-top: 1rem;
}

.content-header h1 {
  font-weight: 600;
  color: var(--text-dark);
  font-size: 1.75rem;
  margin-bottom: 0.25rem;
  display: flex;
  align-items: center;
  gap: 0.75rem;
}

.content-header h1:before {
  content: "🎓";
  font-size: 1.5rem;
  opacity: 0.8;
}

.content-header .text-muted {
  font-size: 0.95rem;
  font-weight: 400;
}

/* Application summary */
.application-summary {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 1rem;
  margin-bottom: 2rem;
}

.summary-card {
  background: white;
  border-radius: var(--border-radius);
  padding: 1.5rem;
  box-shadow: var(--shadow);
  text-align: center;
  border-top: 3px solid var(--primary-color);
  transition: var(--transition);
  border: 1px solid var(--border-color);
}

.summary-card:hover {
  box-shadow: var(--shadow-hover);
}

.summary-card:nth-child(1) { border-top-color: #6c757d; }
.summary-card:nth-child(2) { border-top-color: #ffc107; }
.summary-card:nth-child(3) { border-top-color: #198754; }
.summary-card:nth-child(4) { border-top-color: #dc3545; }

.summary-count {
  font-size: 2rem;
  font-weight: 600;
  color: var(--text-dark);
  margin-bottom: 0.25rem;
  line-height: 1;
}

.summary-label {
  color: var(--text-light);
  font-size: 0.85rem;
  font-weight: 500;
  text-transform: uppercase;
  letter-spacing: 0.3px;
}

/* Amount formatting */
.amount {
  font-weight: 500;
  color: var(--primary-dark);
  font-size: 0.9rem;
}

/* DataTable customizations - COMPLETELY FIXED SHOW ENTRIES */
.dataTables_wrapper {
  padding: 0;
}

.dataTables_wrapper .dataTables_filter {
  margin-bottom: 1rem;
}

.dataTables_wrapper .dataTables_filter input {
  border-radius: 4px;
  padding: 0.5rem 0.75rem;
  border: 1px solid var(--border-color);
  transition: var(--transition);
  font-size: 0.875rem;
}

.dataTables_wrapper .dataTables_filter input:focus {
  border-color: var(--primary-color);
  box-shadow: 0 0 0 2px rgba(25, 135, 84, 0.1);
  outline: none;
}

/* COMPLETELY FIXED: Show Entries - Full visibility */
.dataTables_wrapper .dataTables_length {
  margin-bottom: 1rem;
  padding: 0.5rem 0;
}

.dataTables_wrapper .dataTables_length label {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  margin-bottom: 0;
  font-weight: 500;
  color: var(--text-dark);
  font-size: 0.875rem;
  white-space: nowrap;
  flex-wrap: nowrap;
  min-width: 200px; /* Ensure enough space for full text */
}

.dataTables_wrapper .dataTables_length select {
  border-radius: 4px;
  padding: 0.5rem 0.75rem;
  border: 1px solid var(--border-color);
  transition: var(--transition);
  font-size: 0.875rem;
  min-width: 80px;
  margin: 0 0.5rem;
  height: 38px; /* Fixed height for consistency */
}

.dataTables_wrapper .dataTables_length select:focus {
  border-color: var(--primary-color);
  outline: none;
  box-shadow: 0 0 0 2px rgba(25, 135, 84, 0.1);
}

/* Improved DataTable layout */
.dataTables_wrapper .row {
  margin-bottom: 1rem;
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  justify-content: space-between;
}

.dataTables_wrapper .dataTables_info {
  padding-top: 0.75rem;
  font-size: 0.875rem;
  color: var(--text-light);
  white-space: nowrap;
}

.dataTables_wrapper .dataTables_paginate {
  padding-top: 0.75rem;
}

.dataTables_wrapper .dataTables_paginate .paginate_button {
  border-radius: 4px !important;
  margin: 0 0.125rem;
  transition: var(--transition) !important;
  font-size: 0.8rem;
  padding: 0.375rem 0.75rem !important;
}

.dataTables_wrapper .dataTables_paginate .paginate_button.current {
  background: var(--primary-color) !important;
  border-color: var(--primary-color) !important;
  color: white !important;
}

.dataTables_wrapper .dataTables_paginate .paginate_button:hover:not(.disabled) {
  background: var(--primary-light) !important;
  border-color: var(--primary-color) !important;
  color: var(--primary-dark) !important;
}

/* Responsive improvements */
@media (max-width: 768px) {
  .content-header h1 {
    font-size: 1.5rem;
  }
  
  .card-header {
    padding: 1rem;
  }
  
  .card-body {
    padding: 1rem;
  }
  
  .application-summary {
    grid-template-columns: 1fr;
    gap: 0.75rem;
  }
  
  .table-responsive {
    border-radius: var(--border-radius);
    border: 1px solid var(--border-color);
  }
  
  /* Improved mobile layout for DataTables */
  .dataTables_wrapper .dataTables_length,
  .dataTables_wrapper .dataTables_filter {
    margin-bottom: 0.75rem;
    width: 100%;
  }
  
  .dataTables_wrapper .dataTables_length label,
  .dataTables_wrapper .dataTables_filter label {
    flex-direction: row;
    align-items: center;
    gap: 0.5rem;
    white-space: nowrap;
    min-width: auto;
    width: 100%;
    justify-content: flex-start;
  }
  
  .dataTables_wrapper .dataTables_length select {
    margin: 0 0.5rem;
    flex-shrink: 0;
  }
  
  /* Ensure full visibility on mobile */
  .dataTables_wrapper .row > .col-sm-12:first-child {
    display: flex;
    justify-content: flex-start;
    width: 100%;
  }
  
  .dataTables_wrapper .row > .col-sm-12:last-child {
    display: flex;
    justify-content: flex-end;
    width: 100%;
  }
}

/* Extra small devices */
@media (max-width: 480px) {
  .dataTables_wrapper .dataTables_length label {
    font-size: 0.8rem;
    gap: 0.25rem;
  }
  
  .dataTables_wrapper .dataTables_length select {
    min-width: 60px;
    padding: 0.4rem 0.5rem;
    margin: 0 0.25rem;
    height: 34px;
  }
  
  /* Ensure text doesn't get cut off */
  .dataTables_wrapper .dataTables_length {
    overflow: visible;
  }
}

/* Font weights normalization */
.font-weight-medium {
  font-weight: 500 !important;
}

.font-weight-bold {
  font-weight: 600 !important;
}

/* Text truncation */
.text-truncate {
  max-width: 200px;
}

/* Focus states for accessibility */
.btn:focus, .form-control:focus, .paginate_button:focus {
  outline: 2px solid var(--primary-color);
  outline-offset: 1px;
}

/* Status color coding in table */
.table tbody tr[data-status="pending"] { border-left: 2px solid #ffc107; }
.table tbody tr[data-status="approved"] { border-left: 2px solid #198754; }
.table tbody tr[data-status="declined"] { border-left: 2px solid #dc3545; }
.table tbody tr[data-status="submitted"] { border-left: 2px solid #0d6efd; }

/* Muted text for less important information */
.text-muted {
  color: #6c757d !important;
  font-weight: 400;
}

/* Subtle hover effects */
.btn {
  font-weight: 500;
}

/* Reduced boldness in table headers */
.table thead th {
  font-weight: 600;
}

/* Lighter card titles */
.card-title {
  font-weight: 600;
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
    <!-- Content Header -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-3 align-items-center">
          <div class="col-sm-6">
            <h1>My Applications</h1>
            <p class="text-muted mb-0">Track and manage your scholarship applications</p>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <a href="index.php">Home</a>
              </li>
              <li class="breadcrumb-item active">Applications</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Application Summary -->
        <?php
        // Get application counts for summary
        $pending_count = 0;
        $approved_count = 0;
        $declined_count = 0;
        $submitted_count = 0;
        
        $count_stmt = $pdo->query(
          "SELECT approved, COUNT(*) as count FROM user_application 
           WHERE user_id = '$_SESSION[$session_user_id]' 
           GROUP BY approved"
        );
        
        while ($count_row = $count_stmt->fetch(PDO::FETCH_OBJ)) {
          if ($count_row->approved == '3') {
            $pending_count = $count_row->count;
          } elseif ($count_row->approved == '1') {
            $approved_count = $count_row->count;
          } elseif ($count_row->approved == '2') {
            $declined_count = $count_row->count;
          } else {
            $submitted_count = $count_row->count;
          }
        }
        
        $total_count = $pending_count + $approved_count + $declined_count + $submitted_count;
        ?>
        
        <div class="application-summary">
          <div class="summary-card">
            <div class="summary-count"><?= $total_count ?></div>
            <div class="summary-label">Total Applications</div>
          </div>
          <div class="summary-card">
            <div class="summary-count"><?= $pending_count ?></div>
            <div class="summary-label">Pending Review</div>
          </div>
          <div class="summary-card">
            <div class="summary-count"><?= $approved_count ?></div>
            <div class="summary-label">Approved</div>
          </div>
          <div class="summary-card">
            <div class="summary-count"><?= $declined_count ?></div>
            <div class="summary-label">Declined</div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title mb-0">Application History</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive">
                  <table id="applicationTable" class="table table-hover">
                    <thead>
                      <tr>
                        <th>Scholarship Type</th>
                        <th>Description</th>
                        <th>Amount</th>
                        <th>Applicant Name</th>
                        <th>Date Applied</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $stmt = $pdo->query(
                        "SELECT s.scholarship_id, s.scholarship_type, s.amount, s.description, 
                         ua.b_fname, ua.b_mname, ua.b_lname, ua.b_ext_name, 
                         ua.approved, DATE_FORMAT(ua.date_applied, '%M %d, %Y') as Date_Applied 
                         FROM user_application AS ua 
                         INNER JOIN scholarship AS s ON ua.scholarship_id = s.scholarship_id 
                         INNER JOIN user AS u ON ua.user_id = u.user_id  
                         WHERE u.user_id = '$_SESSION[$session_user_id]' 
                         GROUP BY ua.application_id 
                         ORDER BY ua.application_id DESC"
                      );
                      
                      if ($stmt->rowCount() > 0) {
                        while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                          $full_name = trim("{$row->b_fname} {$row->b_mname} {$row->b_lname} {$row->b_ext_name}");
                          $status_class = '';
                          if ($row->approved == '3') $status_class = 'pending';
                          elseif ($row->approved == '1') $status_class = 'approved';
                          elseif ($row->approved == '2') $status_class = 'declined';
                          else $status_class = 'submitted';
                      ?>
                        <tr data-status="<?= $status_class ?>">
                          <td class="font-weight-medium"><?= htmlspecialchars($row->scholarship_type) ?></td>
                          <td class="text-truncate" title="<?= htmlspecialchars($row->description) ?>">
                            <?= htmlspecialchars($row->description) ?>
                          </td>
                          <td class="amount">&#8369;<?= number_format($row->amount, 2) ?></td>
                          <td><?= htmlspecialchars($full_name) ?></td>
                          <td>
                            <span class="text-muted"><?= htmlspecialchars($row->Date_Applied) ?></span>
                          </td>
                          <td>
                            <?php 
                            if ($row->approved == '3') {
                              echo "<span class='badge badge-warning status-indicator'><i class='fas fa-spinner fa-spin'></i> Pending</span>";
                            } elseif ($row->approved == '1') {
                              echo "<span class='badge badge-success status-indicator'><i class='fas fa-thumbs-up'></i> Approved</span>";
                            } else if($row->approved == '2') {
                              echo "<span class='badge badge-danger status-indicator'><i class='fas fa-thumbs-down'></i> Declined</span>";
                            } else {
                              echo "<span class='badge badge-primary status-indicator'><i class='fas fa-paper-plane'></i> Submitted</span>";
                            } 
                            ?>
                          </td>
                        </tr>
                      <?php 
                        }
                      } else { 
                      ?>
                        <tr>
                          <td colspan="6">
                            <div class="empty-state">
                              <i class="fas fa-file-alt"></i>
                              <h4>No Applications Found</h4>
                              <p class="text-muted">You haven't submitted any scholarship applications yet.</p>
                              
                            </div>
                          </td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
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
  <!-- /.content-wrapper -->
  
  <?php include_once 'includes/footer.php'; ?>
</div>
<!-- ./wrapper -->

<?php require './includes/partial.script-imports.php'; ?>
<script>
$(function() {
  // Initialize DataTable with cleaner options
  const table = $("#applicationTable").DataTable({
    "responsive": true,
    "lengthChange": true,
    "autoWidth": false,
    "pageLength": 10,
    "stateSave": true,
    "dom": '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>rt<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
    "buttons": [
      {
        extend: 'colvis',
        text: '<i class="fas fa-columns mr-1"></i> Columns',
        className: 'btn-light buttons-columnVisibility'
      }
    ],
    "language": {
      "emptyTable": "No application records available",
      "info": "Showing _START_ to _END_ of _TOTAL_ applications",
      "infoEmpty": "Showing 0 to 0 of 0 applications",
      "infoFiltered": "(filtered from _MAX_ total applications)",
      "search": "Search:",
      "lengthMenu": "Show _MENU_ entries",
      "paginate": {
        "first": "First",
        "last": "Last",
        "next": "Next",
        "previous": "Previous"
      }
    },
    "order": [[4, "desc"]],
    "drawCallback": function(settings) {
      updateColumnVisibilityColors();
    }
  });
  
  // Update column visibility button colors
  function updateColumnVisibilityColors(){
    $('.buttons-columnVisibility').each(function(){
      if ($(this).hasClass('active')) {
        $(this).css({
          'background-color':'#198754',
          'color':'#fff',
          'border-color': '#198754'
        });
      } else {
        $(this).css({
          'background-color':'',
          'color':'',
          'border-color': ''
        });
      }
    });
  }
  
  // Add tooltips
  $('[title]').tooltip();
  
  // Auto-update button colors
  setInterval(updateColumnVisibilityColors, 500);
});
</script>

</body>
</html>