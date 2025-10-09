<?php
session_start();
?>

<?php
include './includes/pdo_conn.php';
include './includes/session_variables.php';
if (!$_SESSION[$session_reg_complete]) {
    header('location: complete_registration.php');
    exit();
}
$page = "Dashboard";
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
}

.card:hover {
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.12);
}

.card-header {
  border-bottom: 1px solid var(--border-color);
  border-radius: 12px 12px 0 0 !important;
  padding: 16px 20px;
  background-color: white;
}

.card-header.bg-success {
  background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%) !important;
  border-bottom: none;
}

/* Table Improvements */
.table {
  border-collapse: separate;
  border-spacing: 0;
  width: 100%;
}

.table thead th {
  background-color: var(--bg-light);
  border-bottom: 2px solid var(--border-color);
  font-weight: 600;
  padding: 14px 12px;
  color: var(--text-dark);
}

.table tbody td {
  padding: 12px;
  vertical-align: middle;
  border-bottom: 1px solid var(--border-color);
}

.table tbody tr {
  transition: var(--transition);
}

.table tbody tr:hover {
  background-color: var(--primary-light);
}

/* Badge Improvements */
.badge {
  font-weight: 500;
  padding: 6px 10px;
  border-radius: 6px;
}

.badge-warning {
  background-color: #fff3cd;
  color: #856404;
}

.badge-success {
  background-color: #d1e7dd;
  color: #0f5132;
}

/* Announcement Cards */
.announcement-item {
  background-color: white;
  border: 1px solid var(--border-color);
  border-radius: 10px;
  transition: var(--transition);
  margin-bottom: 16px;
}

.announcement-item:hover {
  transform: translateY(-3px);
  box-shadow: var(--shadow);
  border-color: var(--primary-color);
}

.announcement-item:last-child {
  margin-bottom: 0;
}

.announcement-header {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  margin-bottom: 8px;
}

.announcement-title {
  font-weight: 600;
  color: var(--primary-dark);
  margin-bottom: 0;
  font-size: 1.05rem;
}

.announcement-date {
  color: var(--text-light);
  font-size: 0.85rem;
  white-space: nowrap;
  margin-left: 10px;
}

.announcement-message {
  color: var(--text-dark);
  line-height: 1.6;
  margin-bottom: 8px;
}

.announcement-expiry {
  color: var(--text-light);
  font-size: 0.85rem;
  font-style: italic;
}

/* Status indicators */
.status-indicator {
  display: inline-flex;
  align-items: center;
  gap: 6px;
}

.status-indicator i {
  font-size: 0.9rem;
}

/* Empty state */
.empty-state {
  text-align: center;
  padding: 40px 20px;
  color: var(--text-light);
}

.empty-state i {
  font-size: 3rem;
  margin-bottom: 16px;
  color: #ced4da;
}

/* Responsive improvements */
@media (max-width: 768px) {
  .announcement-header {
    flex-direction: column;
    align-items: flex-start;
  }
  
  .announcement-date {
    margin-left: 0;
    margin-top: 4px;
  }
  
  .table-responsive {
    border-radius: 10px;
    border: 1px solid var(--border-color);
  }
  
  .card-body {
    padding: 16px;
  }
}

/* Button improvements */
.buttons-columnVisibility {
  border-radius: 6px !important;
  transition: var(--transition) !important;
}

.buttons-columnVisibility.active {
  background-color: var(--primary-color) !important;
  border-color: var(--primary-color) !important;
}

/* Content header spacing */
.content-header {
  margin-bottom: 20px;
}

/* Animation for new announcements */
@keyframes highlight {
  0% { background-color: rgba(25, 135, 84, 0.1); }
  100% { background-color: transparent; }
}

.new-announcement {
  animation: highlight 2s ease;
}
</style>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="resources/images/lgulallo.png" alt="Logo" height="100" width="100" >
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
        <div class="row mb-4">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Announcements</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <a href="index.php">Home</a>
              </li>
              <li class="breadcrumb-item active">Announcements</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <!-- /.content-header -->

    <section class="content">
      <div class="container-fluid">
        <!-- Application Status Card -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title mb-0">Your Scholarship Applications</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="applicationTable" class="table table-hover">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Scholarship Type</th>
                        <th>Scholarship Amount</th>
                        <th>Claimed Date</th>
                        <th>Status</th>
                        <th>Remarks</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $announcement_sql = "SELECT *, 
                                              concat(a.b_fname, ' ', a.b_lname) as b_name, 
                                              DATE_FORMAT(a.claim_date, '%M %d, %Y') as date_claim 
                                            FROM user_application as a 
                                            INNER JOIN scholarship as s 
                                              ON a.scholarship_id = s.scholarship_id 
                                            WHERE a.approved = 1 
                                              AND a.claim_date IS NOT NULL 
                                              AND a.user_id = '$_SESSION[$session_user_id]'
                                            ORDER BY a.application_id DESC";
                        $announcement_qry = $pdo->query($announcement_sql);
                        
                        if ($announcement_qry->rowCount() > 0) {
                          while ($row = $announcement_qry->fetch(PDO::FETCH_ASSOC)) {
                      ?>
                      <tr>
                        <td class="font-weight-medium"><?= htmlspecialchars($row['b_name']) ?></td>
                        <td><?= htmlspecialchars($row['scholarship_type']) ?></td>
                        <td class="font-weight-medium"><?= htmlspecialchars($row['amount']) ?></td>
                        <td><?= htmlspecialchars($row['date_claim']) ?></td>
                        <td>
                          <?php if ($row['claimed'] == '0') {
                            echo "<span class='badge badge-warning status-indicator'><i class='fa fa-spinner fa-spin'></i> Not Claimed</span>";
                          } else {
                            echo "<span class='badge badge-success status-indicator'><i class='fa fa-check'></i> Claimed</span>";
                          } ?>
                        </td>
                        <td>
                          <?php 
                            if (!empty($row['remarks'])) {
                              echo "<div class='alert alert-info p-2 mb-0 small'>" . nl2br(htmlspecialchars($row['remarks'])) . "</div>";
                            } else {
                              echo "<span class='text-muted'>No remarks yet</span>";
                            }
                          ?>
                        </td>
                      </tr>
                      <?php 
                          }
                        } else { 
                      ?>
                      <tr>
                        <td colspan="6" class="text-center py-4">
                          <div class="empty-state">
                            <i class="fas fa-inbox"></i>
                            <p class="mb-0">No application records found.</p>
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
        </div>

        <!-- Announcements Card -->
        <div class="row">
          <div class="col-12">
            <div class="card shadow-sm">
              <div class="card-header bg-success text-white d-flex align-items-center">
                <i class="fas fa-bullhorn mr-2"></i>
                <span class="font-weight-bold">Latest Announcements</span>
              </div>
              <div class="card-body p-4">
                <?php
                  $today = date('Y-m-d');
                  $stmt = $pdo->prepare("SELECT * FROM general_announcements 
                                         WHERE expires_at IS NULL OR expires_at >= ?
                                         ORDER BY created_at DESC LIMIT 5");
                  $stmt->execute([$today]);

                  if ($stmt->rowCount() > 0) {
                    while ($a = $stmt->fetch(PDO::FETCH_ASSOC)) {
                      $title = htmlspecialchars($a['title']);
                      $message = nl2br(htmlspecialchars($a['message']));
                      $created = date("M d, Y", strtotime($a['created_at']));
                      $expires = $a['expires_at'] ? date("M d, Y", strtotime($a['expires_at'])) : 'No expiry';
                      $isNew = (strtotime($a['created_at']) > strtotime('-3 days'));
                ?>
                <div class="announcement-item p-3 <?= $isNew ? 'new-announcement' : '' ?>">
                  <div class="announcement-header">
                    <h6 class="announcement-title"><?= $title ?></h6>
                    <small class="announcement-date"><?= $created ?></small>
                  </div>
                  <div class="announcement-message"><?= $message ?></div>
                  <?php if($a['expires_at']) { ?>
                    <small class="announcement-expiry">Expires on: <?= $expires ?></small>
                  <?php } ?>
                </div>
                <?php
                    }
                  } else {
                ?>
                <div class="empty-state">
                  <i class="fas fa-bullhorn"></i>
                  <p class="mb-0">No announcements at the moment.</p>
                </div>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
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
  $("#applicationTable")
    .DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "buttons": ["colvis"],
      "language": {
        "emptyTable": "No application records available",
        "info": "Showing _START_ to _END_ of _TOTAL_ entries",
        "infoEmpty": "Showing 0 to 0 of 0 entries",
        "infoFiltered": "(filtered from _MAX_ total entries)",
        "search": "Search:"
      }
    })
    .buttons()
    .container()
    .appendTo('#applicationTable_wrapper .col-md-6:eq(0)');
    
  // Update column visibility button colors
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
  
  // Initial call and set interval
  updateColumnVisibilityColors();
  setInterval(updateColumnVisibilityColors, 200);
});
</script>

</body>
</html>