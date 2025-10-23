<?php
require './includes/check_session.php';

$remove_badge_sql = "UPDATE user SET badge_notified_admin=1 WHERE badge_notified_admin=0;";
$remove_badge_result = $pdo->query($remove_badge_sql);

$remove_notif_sql = "UPDATE admin_notification SET status=1 WHERE type=2;";
$remove_notif_result = $pdo->query($remove_notif_sql);

$page = 'Accounts';

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

.card-header h3 {
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
  padding: 6px 12px;
}

.btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.btn-outline-danger {
  color: var(--danger-color);
  border-color: var(--danger-color);
}

.btn-outline-danger:hover {
  background-color: var(--danger-color);
  border-color: var(--danger-color);
  color: white;
}

.btn-success {
  background-color: var(--success-color);
  border-color: var(--success-color);
}

.btn-danger {
  background-color: var(--danger-color);
  border-color: var(--danger-color);
}

.status-toggle {
  min-width: 100px;
}

.profile-img {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  object-fit: cover;
  border: 2px solid #e9ecef;
  transition: all 0.3s ease;
}

.profile-img:hover {
  border-color: var(--primary-color);
  transform: scale(1.05);
}

.dropdown-menu {
  min-width: 150px;
  border-radius: 8px;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
  border: none;
}

.dropdown-item {
  padding: 8px 15px;
  border-radius: 5px;
 
  width: auto;

}

.dropdown-item:hover {
  background-color: #f8f9fa;
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
  .table-responsive {
    font-size: 0.875rem;
  }
  
  .btn {
    padding: 4px 8px;
    font-size: 0.875rem;
  }
  
  .profile-img {
    width: 40px;
    height: 40px;
  }
}

/* Table row animations */
.table tbody tr {
  transition: all 0.3s ease;
}

/* Stats cards */
.stats-card {
  background: white;
  border-radius: 10px;
  padding: 20px;
  box-shadow: var(--card-shadow);
  border-left: 4px solid var(--primary-color);
  margin-bottom: 20px;
}

.stats-card h5 {
  color: var(--dark-color);
  font-weight: 600;
  margin-bottom: 5px;
}

.stats-card .count {
  font-size: 2rem;
  font-weight: 700;
  color: var(--primary-color);
}

/* Action buttons container */
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

/* Empty state styling */
.dataTables_empty {
  padding: 40px !important;
  text-align: center;
  color: #6c757d;
}

.dataTables_empty:before {
  content: "👤";
  font-size: 2rem;
  display: block;
  margin-bottom: 10px;
}

/* Search inputs in table footer */
tfoot input {
  width: 100% !important;
  padding: 5px;
  border-radius: 4px;
  border: 1px solid #ddd;
}

/* Custom checkbox for column visibility */
.buttons-columnVisibility.active {
  background-color: var(--success-color) !important;
  color: white !important;
  border-color: var(--success-color) !important;
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
    transition: var(--transition);
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
}
</style>

<script>
$(document).ready(function(){
  // Initialize DataTable with enhanced options
  var table = $('#accountsTable').DataTable({
    responsive: true,
    lengthChange: true,
    autoWidth: false,
    pageLength: 10,
    order: [[14, 'desc']], // Default sort by date created
    language: {
      search: "Search accounts:",
      lengthMenu: "Show _MENU_ accounts",
      info: "Showing _START_ to _END_ of _TOTAL_ accounts",
      infoEmpty: "No accounts available",
      infoFiltered: "(filtered from _MAX_ total accounts)",
      paginate: {
        first: "First",
        last: "Last",
        next: "Next",
        previous: "Previous"
      }
    },
    dom: '<"row"<"col-sm-12 col-md-6"B><"col-sm-12 col-md-6"f>>' +
         '<"row"<"col-sm-12"tr>>' +
         '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
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
    ]
  });

  // Apply custom styling to buttons after table initialization
  table.buttons().container().appendTo('#accountsTable_wrapper .col-md-6:eq(0)');
  
  // Update column visibility button colors
  function updateColumnVisibilityColors() {
    $('.buttons-columnVisibility').each(function() {
      if ($(this).hasClass('active')) {
        $(this).css({
          'background-color': '#27ae60',
          'color': '#fff',
          'border-color': '#27ae60'
        });
      } else {
        $(this).css({
          'background-color': '',
          'color': '',
          'border-color': ''
        });
      }
    });
  }

  // Update button colors on page load and when column visibility changes
  updateColumnVisibilityColors();
  
  // Add event listener for column visibility changes
  table.on('column-visibility', function() {
    setTimeout(updateColumnVisibilityColors, 100);
  });
});

function delete_user(id) {
  $('#delete_user_id').val(id);
}
</script>

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
        include_once './components/deleteModal_account.php';
        ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0"><i class="fas fa-users mr-2"></i>Accounts</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                                <li class="breadcrumb-item active">Accounts</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                   <!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <?php
                $totalStmt = $pdo->query("SELECT COUNT(*) as total FROM user WHERE registration_complete = 1");
                $total = $totalStmt->fetch(PDO::FETCH_OBJ);
                ?>
                <h3><?= $total->total ?></h3>
                <p>Total Accounts</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <?php
                $activeStmt = $pdo->query("SELECT COUNT(*) as active FROM user WHERE registration_complete = 1 AND blocked = 0");
                $active = $activeStmt->fetch(PDO::FETCH_OBJ);
                ?>
                <h3><?= $active->active ?></h3>
                <p>Active Accounts</p>
            </div>
            <div class="icon">
                <i class="fas fa-check-circle"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <?php
                $blockedStmt = $pdo->query("SELECT COUNT(*) as blocked FROM user WHERE registration_complete = 1 AND blocked = 1");
                $blocked = $blockedStmt->fetch(PDO::FETCH_OBJ);
                ?>
                <h3><?= $blocked->blocked ?></h3>
                <p>Blocked Accounts</p>
            </div>
            <div class="icon">
                <i class="fas fa-ban"></i>
            </div>
        </div>
    </div>
   
</div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fas fa-user-cog mr-2"></i>Registered User Accounts</h3>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="accountsTable" class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Profile</th>
                                                    <th>Status</th>
                                                    <th>Username</th>
                                                    <th>Email</th>
                                                    <th>First Name</th>
                                                    <th>Middle Name</th>
                                                    <th>Last Name</th>
                                                    <th>Extension</th>
                                                    <th>Gender</th>
                                                    <th>Mobile</th>
                                                    <th>Civil Status</th>
                                                    <th>Nationality</th>
                                                    <th>Religion</th>
                                                    <th>Date Updated</th>
                                                    <th>Date Created</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $result = $pdo->query("DELETE FROM user WHERE dt_created < NOW() - INTERVAL 3 DAY AND email_verified = 0");
                                                if ($result->rowCount() > 0) {
                                                    $_SESSION['success'] = $result->rowCount().' deleted unverified users today.';
                                                }

                                                $stmt = $pdo->query("SELECT * FROM user WHERE registration_complete = 1 ORDER BY user_id DESC;");
                                                while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                                                    $imagePath = "../resources/profile/" . $row->image_filename;
                                                    $defaultImagePath = "../resources/profile/user.png";
                                                    $profileImage = file_exists($imagePath) ? $imagePath : $defaultImagePath;
                                                ?>
                                                    <tr>
                                                        <td>
                                                            <img src="<?= $profileImage ?>" class="profile-img" alt="Profile Image">
                                                        </td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <?php if ($row->blocked == 0) { ?>
                                                                    <button class="btn btn-success btn-sm dropdown-toggle status-toggle" type="button" data-toggle="dropdown">
                                                                        <i class="fas fa-check-circle mr-1"></i> Active
                                                                    </button>
                                                                    <div class="dropdown-menu">
                                                                        <a href="actions/update_blocked_status.php?userId=<?= $row->user_id ?>&blocked=1&username=<?= $row->username ?>" 
                                                                           class="dropdown-item text-danger" 
                                                                           onclick="return confirm('Are you sure you want to disable this account?')">
                                                                            <i class="fas fa-ban mr-1"></i> Disable Account
                                                                        </a>
                                                                    </div>
                                                                <?php } else { ?>
                                                                    <button class="btn btn-danger btn-sm dropdown-toggle status-toggle" type="button" data-toggle="dropdown">
                                                                        <i class="fas fa-ban mr-1"></i> Disabled
                                                                    </button>
                                                                    <div class="dropdown-menu">
                                                                        <a href="actions/update_blocked_status.php?userId=<?= $row->user_id ?>&blocked=0&username=<?= $row->username ?>" 
                                                                           class="dropdown-item text-success"
                                                                           onclick="return confirm('Are you sure you want to enable this account?')">
                                                                            <i class="fas fa-check-circle mr-1"></i> Enable Account
                                                                        </a>
                                                                    </div>
                                                                <?php } ?>
                                                            </div>
                                                        </td>
                                                        <td><strong><?= $row->username ?></strong></td>
                                                        <td><?= $row->email ?></td>
                                                        <td><?= $row->first_name ?></td>
                                                        <td><?= $row->middle_name ?></td>
                                                        <td><?= $row->last_name ?></td>
                                                        <td><?= $row->ext_name ?: 'N/A' ?></td>
                                                        <td><?= $row->gender ?></td>
                                                        <td><?= $row->mobile_no ?></td>
                                                        <td><?= $row->civil_status ?></td>
                                                        <td><?= $row->nationality ?></td>
                                                        <td><?= $row->religion ?></td>
                                                        <td><?= date('M d, Y', strtotime($row->dt_updated)) ?></td>
                                                        <td><?= date('M d, Y', strtotime($row->dt_created)) ?></td>
                                                        <td>
                                                            <div class="action-buttons">
                                                                <button class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#deleteUser" 
                                                                        onclick="delete_user('<?= $row->user_id ?>');"
                                                                        title="Delete Account">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
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

    <?php
    require './includes/partial.script-imports.php';
    ?>
</body>
</html>